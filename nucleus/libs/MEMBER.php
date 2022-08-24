<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * A class representing site members
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class MEMBER
{
    // 1 when authenticated, 0 when not
    public $loggedin = 0;
    public $password;        // not the actual password, but rather a MD5 hash

    public $cookiekey;        // value that should also be in the client cookie to allow authentication

    // member info
    public $id = -1;
    public $realname;
    public $displayname;
    public $email;
    public $url;
    public $language = '';        // name of the language file to use (e.g. 'english' -> english.php)
    public $admin    = 0;            // (either 0 or 1)
    public $canlogin = 0;        // (either 0 or 1)
    public $notes;
    public $autosave = 1;        // if the member use the autosave draft function

    private $hasher;
    private $halt = 0;

    /**
     * Constructor for a member object
     */
    public function __construct()
    {
        global $DIR_LIBS;
        include_once("{$DIR_LIBS}phpass.class.inc.php");
        $this->hasher = new PasswordHash();
    }

    private function init_member()
    {
        $this->loggedin = 0;
        unset($this->password); // not the actual password, but rather a MD5 hash
        unset($this->cookiekey); // value that should also be in the client cookie to allow authentication
        $this->id = -1;
        unset($this->realname);
        unset($this->displayname);
        unset($this->email);
        unset($this->url);
        $this->language = '';       // name of the language file to use (e.g. 'english' -> english.php)
        $this->admin    = 0;           // (either 0 or 1)
        $this->canlogin = 0;        // (either 0 or 1)
        unset($this->notes);
        $this->autosave = 1;        // if the member use the autosave draft function
        $this->halt     = 0;
    }

    /**
     * Create a member object for a given displayname
     *
     * @static
     */
    public static function &createFromName($displayname)
    {
        $mem = new MEMBER();
        $mem->readFromName($displayname);

        return $mem;
    }

    /**
     * Create a member object for a given ID
     *
     * @static
     */
    public static function &createFromID($id)
    {
        $mem = new MEMBER();
        $mem->readFromID($id);

        return $mem;
    }

    public function readFromName($displayname)
    {
        return $this->read(sprintf(
            "mname='%s'",
            sql_real_escape_string($displayname)
        ));
    }

    public function readFromID($id)
    {
        return $this->read('mnumber=' . (int)$id);
    }

    /**
     * Tries to login as a given user.
     * Returns true when succeeded, returns false when failed
     * 3.40 adds CustomLogin event
     */
    public function login($formv_username, $formv_password)
    {
        global $manager;

        $this->loggedin = 0;
        $success        = 0;
        $allowlocal     = 1;

        $param = array(
            'login'      => &$formv_username,
            'password'   => &$formv_password,
            'success'    => &$success,
            'allowlocal' => &$allowlocal
        );
        $manager->notify('CustomLogin', $param);

        if ('' === $formv_username || 32 < strlen($formv_username)) { // mname varchar(32)
            $this->loggedin = 0;
            return 0;
        }

        if ($success && $this->readFromName($formv_username)) {
            $this->loggedin = 1;
        } elseif (!$success && $allowlocal) {
            if ('' === $formv_password || 40 < strlen($formv_password)) { // avoid md5 collision by using a long key
                $this->loggedin = 0;
                return 0;
            }
            $userInfo     = $this->readFromName($formv_username);
            $dbv_password = $this->getPassword();

            if (!$userInfo) {
                $this->loggedin = 0;
            } elseif (!$this->password_verify(
                $formv_password,
                $dbv_password
            )) {
                $this->loggedin = 0;
            } else {
                $this->loggedin = 1;
            }
        } else {
            $this->loggedin = 0;
        }

        return $this->loggedin;
    }

    /**
     * Login using cookie key
     */
    public function cookielogin($username, $cookiekey)
    {
        $this->loggedin = 0;

        if (!$this->readFromName($username)) {
            return 0;
        }
        if (!$this->checkCookieKey($cookiekey)) {
            return 0;
        }
        $this->loggedin = 1;

        return 1;
    }

    public function logout()
    {
        $this->loggedin = 0;
    }

    public function isLoggedIn()
    {
        return $this->loggedin;
    }

    public function isHalt()
    {
        return $this->halt;
    }

    /**
     * Read member information from the database
     */
    public function read($where)
    {
        // read info
        $query = sprintf(
            'SELECT * FROM %s WHERE %s',
            sql_table('member'),
            $where
        );

        $res = sql_query($query);
        if ($res && ($obj = sql_fetch_object($res))) {
            $this->setRealName($obj->mrealname);
            $this->setEmail($obj->memail);
            $this->password = $obj->mpassword;
            $this->setCookieKey($obj->mcookiekey);
            $this->setURL($obj->murl);
            $this->setDisplayName($obj->mname);
            $this->setAdmin($obj->madmin);
            $this->id = (int) $obj->mnumber;
            $this->setCanLogin($obj->mcanlogin);
            $this->setNotes($obj->mnotes);
            $this->setLanguage($obj->deflang);
            $this->setAutosave($obj->mautosave);

            $this->halt = (isset($obj->mhalt) && ((int) $obj->mhalt)) ? 1 : 0;

            if ($this->halt) {
                return 0;
            }

            return 1;
        }

        return 0; // not found or removed user
    }

    /**
     * Returns true if member is an admin for the given blog
     * (returns false if not a team member)
     */
    public function isBlogAdmin($blogid)
    {
        $query = sprintf(
            'SELECT count(*) AS result FROM %s WHERE tblog=%d and tmember=%d AND tadmin=1 LIMIT 1',
            sql_table('team'),
            (int)$blogid,
            $this->getID()
        );

        return (int)quickQuery($query) > 0;
    }

    public function blogAdminRights($blogid)
    {
        return ($this->isAdmin() || $this->isBlogAdmin($blogid));
    }

    public function teamRights($blogid)
    {
        return ($this->isAdmin() || $this->isTeamMember($blogid));
    }

    /**
     * Returns true if this member is a team member of the given blog
     */
    public function isTeamMember($blogid)
    {
        $query = sprintf(
            'SELECT count(*) AS result FROM %s WHERE tblog=%d AND tmember=%d LIMIT 1',
            sql_table('team'),
            (int)$blogid,
            $this->getID()
        );

        return (int)quickQuery($query) > 0;
    }

    public function canAddItem($catid)
    {
        global $manager;

        // if this is a 'newcat' style newcat
        // no blog admin of destination blog -> NOK
        // blog admin of destination blog -> OK
        if (str_contains($catid, 'newcat')) {
            // get blogid
            list($blogid) = sscanf($catid, "newcat-%d");

            return $this->blogAdminRights($blogid);
        }

        // category does not exist -> NOK
        if (!$manager->existsCategory($catid)) {
            return 0;
        }

        $blogid = getBlogIDFromCatID($catid);

        // no team rights for blog -> NOK
        if (!$this->teamRights($blogid)) {
            return 0;
        }

        // all other cases: OK
        return 1;
    }

    /**
     * Returns true if this member can edit/delete a commentitem. This can be
     * in the following cases:
     *      - member is a super-admin
     *   - member is the author of the comment
     *   - member is admin of the blog associated with the comment
     *   - member is author of the item associated with the comment
     */
    public function canAlterComment($commentid)
    {
        if ($this->isAdmin()) {
            return 1;
        }

        $query = sprintf(
            'SELECT citem as itemid, iblog as blogid, cmember as cauthor, iauthor FROM %s, %s, %s
             WHERE citem=inumber and iblog=bnumber and cnumber=%d',
            sql_table('comment'),
            sql_table('item'),
            sql_table('blog'),
            (int)$commentid
        );
        $res = sql_query($query);
        $obj = sql_fetch_object($res);

        return ($obj->cauthor == $this->getID())
                or $this->isBlogAdmin($obj->blogid)
                or ($obj->iauthor == $this->getID());
    }

    /**
     * Returns true if this member can edit/delete an item. This is true in the
     * following cases: - member is a super-admin
     *           - member is the author of the item
     *        - member is admin of the the associated blog
     */
    public function canAlterItem($itemid)
    {
        if ($this->isAdmin()) {
            return 1;
        }

        $query = sprintf(
            'SELECT iblog, iauthor FROM %s WHERE inumber=%d',
            sql_table('item'),
            (int)$itemid
        );
        $res = sql_query($query);
        if ($res && ($obj = sql_fetch_object($res)) && is_object($obj)) {
            return ($obj->iauthor == $this->getID())
                    or $this->isBlogAdmin($obj->iblog);
        }

        return false;
    }

    /**
     * Return true if member can be deleted. This means that there are no items
     * posted by the member left
     */
    public function canBeDeleted()
    {
        $sql = sprintf(
            'SELECT count(*) AS result FROM %s WHERE iauthor=%d LIMIT 1',
            sql_table('item'),
            $this->getID()
        );

        return ((int)quickQuery($sql) == 0);
    }

    public function getTotalPosts()
    {
        $res = sql_query(sprintf(
            'SELECT count(*) FROM %s WHERE iauthor=%d',
            sql_table('item'),
            $this->getID()
        ));

        return (int)sql_result($res, 0, 0);
    }

    public function getTotalComments()
    {
        $sql = sprintf(
            'SELECT count(*) FROM %s WHERE cmember=%d',
            sql_table('comment'),
            $this->getID()
        );
        $res = sql_query($sql);

        return (int)sql_result($res, 0, 0);
    }

    /**
     * returns true if this member can move/update an item to a given category,
     * false if not (see comments fot the tests that are executed)
     *
     * @param itemid
     * @param newcat (can also be of form 'newcat-x' with x=blogid)
     */
    public function canUpdateItem($itemid, $newcat)
    {
        global $manager;

        // item does not exists -> NOK
        if (!$manager->existsItem($itemid, 1, 1)) {
            return 0;
        }

        // cannot alter item -> NOK
        if (!$this->canAlterItem($itemid)) {
            return 0;
        }

        // if this is a 'newcat' style newcat
        // no blog admin of destination blog -> NOK
        // blog admin of destination blog -> OK
        if (str_contains($newcat, 'newcat')) {
            // get blogid
            list($blogid) = sscanf($newcat, 'newcat-%d');

            return $this->blogAdminRights($blogid);
        }

        // category does not exist -> NOK
        if (!$manager->existsCategory($newcat)) {
            return 0;
        }

        // get item
        $item = & $manager->getItem($itemid, 1, 1);

        // old catid = new catid -> OK
        if ($item['catid'] == $newcat) {
            return 1;
        }

        // not a valid category -> NOK
        $validCat = quickQuery(sprintf(
            'SELECT COUNT(*) AS result FROM %s WHERE catid=%d',
            sql_table('category'),
            (int)$newcat
        ));
        if (!$validCat) {
            return 0;
        }

        // get destination blog
        $source_blogid = getBlogIDFromItemID($itemid);
        $dest_blogid   = getBlogIDFromCatID($newcat);

        // not a team member of destination blog -> NOK
        if (!$this->teamRights($dest_blogid)) {
            return 0;
        }

        // if member is author of item -> OK
        if ($item['authorid'] == $this->getID()) {
            return 1;
        }

        // if member has admin rights on both blogs: OK
        if (($this->blogAdminRights($dest_blogid))
            && ($this->blogAdminRights($source_blogid))) {
            return 1;
        }

        // all other cases: NOK
        return 0;
    }

    /**
     * Sets the cookies for the member
     *
     * @param shared
     *        set this to 1 when using a shared computer. Cookies will expire
     *        at the end of the session in this case.
     */
    public function setCookies($shared = 0)
    {
        global $CONF;

        if ($CONF['SessionCookie'] || $shared) {
            $lifetime = 0;
        } else {
            $lifetime = (time() + 2592000);
        }

        setcookie(
            $CONF['CookiePrefix'] . 'user',
            $this->getDisplayName(),
            $lifetime,
            $CONF['CookiePath'],
            $CONF['CookieDomain'],
            $CONF['CookieSecure']
        );
        setcookie(
            $CONF['CookiePrefix'] . 'loginkey',
            $this->getCookieKey(),
            $lifetime,
            $CONF['CookiePath'],
            $CONF['CookieDomain'],
            $CONF['CookieSecure']
        );

        // make sure cookies on shared pcs don't get renewed
        if ($shared) {
            setcookie(
                $CONF['CookiePrefix'] . 'sharedpc',
                '1',
                $lifetime,
                $CONF['CookiePath'],
                $CONF['CookieDomain'],
                $CONF['CookieSecure']
            );
        }
    }

    public function sendActivationLink($type, $extra = '')
    {
        global $CONF;

        if (!isset($CONF['ActivationDays'])) {
            $CONF['ActivationDays'] = 2;
        }

        // generate key and URL
        $key = $this->generateActivationEntry($type, $extra);
        $url = $CONF['AdminURL'] . 'index.php?action=activate&key=' . $key;

        // choose text to use in mail
        switch ($type) {
            case 'register':
                $message = _ACTIVATE_REGISTER_MAIL;
                $title   = _ACTIVATE_REGISTER_MAILTITLE;
                break;
            case 'forgot':
                $message = _ACTIVATE_FORGOT_MAIL;
                $title   = _ACTIVATE_FORGOT_MAILTITLE;
                break;
            case 'addresschange':
                $message = _ACTIVATE_CHANGE_MAIL;
                $title   = _ACTIVATE_CHANGE_MAILTITLE;
                break;
            default:
        }

        // fill out variables in text

        $aVars = array(
            'siteName'       => $CONF['SiteName'],
            'siteUrl'        => $CONF['IndexURL'],
            'memberName'     => $this->getDisplayName(),
            'activationUrl'  => $url,
            'activationDays' => $CONF['ActivationDays']
        );

        $message = TEMPLATE::fill($message, $aVars);
        $title   = TEMPLATE::fill($title, $aVars);

        // send mail

        @Utils::mail(
            $this->getEmail(),
            $title,
            $message,
            'From: ' . $CONF['AdminEmail']
        );

        ACTIONLOG::add(
            INFO,
            _ACTIONLOG_ACTIVATIONLINK . ' (' . $this->getDisplayName() . ' / type: ' . $type . ')'
        );
    }

    /**
     * Returns an array of all blogids for which member has admin rights
     */
    public function getAdminBlogs()
    {
        $blogs = array();

        if ($this->isAdmin()) {
            $query = sprintf(
                'SELECT bnumber as blogid from %s',
                sql_table('blog')
            );
        } else {
            $query = sprintf(
                "SELECT tblog as blogid from %s where tadmin=1 and tmember=%d",
                sql_table('team'),
                $this->getID()
            );
        }

        $res = sql_query($query);
        if (!empty($res)) {
            while ($obj = sql_fetch_object($res)) {
                $blogs[] = $obj->blogid;
            }
        }

        return $blogs;
    }

    /**
     * Returns an array of all blogids for which member has team rights
     */
    public function getTeamBlogs($incAdmin = 1)
    {
        $incAdmin = (int)$incAdmin;
        $blogs    = array();

        if ($this->isAdmin() && $incAdmin) {
            $query = sprintf(
                'SELECT bnumber as blogid from %s',
                sql_table('blog')
            );
        } else {
            $query = sprintf(
                "SELECT tblog as blogid from %s where tmember=%d",
                sql_table('team'),
                $this->getID()
            );
        }

        $res = sql_query($query);
        if (!empty($res)) {
            while ($obj = sql_fetch_object($res)) {
                $blogs[] = $obj->blogid;
            }
        }

        return $blogs;
    }

    /**
     * Returns an email address from which notification of commenting/karma
     * voting can be sent. A suggestion can be given for when the member is not
     * logged in
     */
    public function getNotifyFromMailAddress($suggest = "")
    {
        global $CONF;

        if ($this->isLoggedIn()) {
            return sprintf(
                '%s <%s>',
                $this->getDisplayName(),
                $this->getEmail()
            );
        }

        if (isValidMailAddress($suggest)) {
            return $suggest;
        }

        return $CONF['AdminEmail'];
    }

    /**
     * Write data to database
     */
    public function write()
    {
        $query = sprintf(
            "UPDATE %s SET mname='%s',mrealname='%s',mpassword='%s',mcookiekey='%s',murl='%s',memail='%s',madmin=%d,mnotes='%s',mcanlogin=%d,deflang='%s',mautosave=%d ,mhalt=%d WHERE mnumber=%d",
            sql_table('member'),
            sql_real_escape_string($this->getDisplayName()),
            sql_real_escape_string($this->getRealName()),
            sql_real_escape_string($this->getPassword()),
            sql_real_escape_string($this->getCookieKey()),
            sql_real_escape_string($this->getURL()),
            sql_real_escape_string($this->getEmail()),
            $this->isAdmin(),
            sql_real_escape_string($this->getNotes()),
            $this->canLogin(),
            sql_real_escape_string($this->getLanguage()),
            (int)$this->getAutosave(),
            (int)$this->halt,
            $this->getID()
        );
        sql_query($query);
    }

    public function writeCookieKey()
    {
        $query = sprintf(
            "UPDATE %s SET mcookiekey='%s' WHERE mnumber=%d",
            sql_table('member'),
            sql_real_escape_string($this->getCookieKey()),
            $this->getID()
        );
        sql_query($query);
    }

    public function checkCookieKey($key)
    {
        return (($key != '') && ($key == $this->getCookieKey()));
    }

    public function password_verify($formv_password, $hash)
    {
        if (isset($this->halt) && ($this->halt)) {
            return false;
        }

        global $CONF;

        if (str_contains($hash, '$')) {
            $rs = $this->hasher->CheckPassword($formv_password, $hash);
        } else {
            $rs = (md5($formv_password) === $hash);
            if ($CONF['DatabaseVersion'] < 370) {
                return $rs;
            }

            if ($rs) {
                $mnumber = $this->getID();
                if (!$mnumber) {
                    return false;
                }

                $this->setPassword($formv_password);
                $password_hash = $this->getPassword();

                $param[] = sql_table('member');
                $param[] = sql_real_escape_string($password_hash);
                $param[] = intval($mnumber);
                $query   = vsprintf("UPDATE %s SET mpassword='%s' WHERE mnumber=%s", $param);
                $rs      = sql_query($query);
            } else {
                $rs = false;
            }
        }

        return $rs;
    }

    public function checkPassword($pw)
    {
        if (str_contains($this->getPassword(), '$')) {
            return $this->hasher->CheckPassword($pw, $this->getPassword());
        } else {
            return md5($pw) === $this->getPassword();
        }
    }

    public function getRealName()
    {
        return $this->realname;
    }

    public function setRealName($name)
    {
        $this->realname = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($pwd)
    {
        if (! self::checkIfValidPasswordCharacters($pwd)) {
            return false;
        }
        $this->password = $this->hasher->HashPassword($pwd);

        return true;
    }

    public function setHalt($halt)
    {
        $this->halt = $halt ? 1 : 0;
    }

    public function getCookieKey()
    {
        return $this->cookiekey;
    }

    /**
     * Generate new cookiekey, save it, and return it
     */
    public function newCookieKey()
    {
        mt_srand((float)microtime() * 1000000);
        $this->cookiekey = md5(uniqid(mt_rand(), true));
        $this->writeCookieKey();

        return $this->cookiekey;
    }

    public function setCookieKey($val)
    {
        $this->cookiekey = $val;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function setURL($site)
    {
        $this->url = $site;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($lang)
    {
        $this->language = $lang;
    }

    public function setDisplayName($nick)
    {
        $this->displayname = $nick;
    }

    public function getDisplayName()
    {
        return $this->displayname;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($val)
    {
        $this->admin = (int) $val;
    }

    public function canLogin()
    {
        return $this->canlogin;
    }

    public function setCanLogin($val)
    {
        $this->canlogin = (int) $val;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($val)
    {
        $this->notes = $val;
    }

    public function getAutosave()
    {
        return $this->autosave;
    }

    public function setAutosave($val)
    {
        $this->autosave = (int) $val;
    }

    public function getID()
    {
        return $this->id;
    }

    /**
     * Returns true if there is a member with the given login name
     *
     * @static
     */
    public static function exists($name)
    {
        $sql = sprintf(
            "SELECT count(*) AS result FROM %s WHERE mname='%s' LIMIT 1",
            sql_table('member'),
            sql_real_escape_string($name)
        );

        return ((int)quickQuery($sql) > 0);
    }

    /**
     * Returns true if there is a member with the given ID
     *
     * @static
     */
    public static function existsID($id)
    {
        $sql = sprintf(
            "SELECT count(*) AS result FROM %s WHERE mnumber='%d' LIMIT 1",
            sql_table('member'),
            (int)$id
        );

        return ((int)quickQuery($sql) > 0);
    }

    /**
     *  Checks if a username is protected.
     *  If so, it can not be used on anonymous comments
     */
    public function isNameProtected($name)
    {
        // extract name
        $name = strip_tags($name);
        $name = trim($name);

        return MEMBER::exists($name);
    }

    /**
     * Adds a new member
     *
     * @static
     */
    public static function create(
        $name,
        $realname,
        $password,
        $email,
        $url,
        $admin,
        $canlogin,
        $notes
    ) {
        if (!isValidMailAddress($email)) {
            return _ERROR_BADMAILADDRESS;
        }
        if (!isValidDisplayName($name)) {
            return _ERROR_BADNAME;
        }
        if (MEMBER::exists($name)) {
            return _ERROR_NICKNAMEINUSE;
        }
        if (!$realname) {
            return _ERROR_REALNAMEMISSING;
        }
        if (!$password) {
            return _ERROR_PASSWORDMISSING;
        }
        if (strlen($password) < 6) {
            return _ERROR_PASSWORDTOOSHORT;
        }
        if (! self::checkIfValidPasswordCharacters($password)) {
            return ERROR_PASSWORD_INVALID_CHARACTERS;
        }

        $obj = new MEMBER();
        $obj->setPassword($password);

        // begin if: sometimes user didn't prefix the URL with http:// or https://, this cause a malformed URL. Let's fix it.
        if (!preg_match('#^https?://#', $url)) {
            $url = 'http://' . $url;
        } // end if

        $name     = sql_real_escape_string($name);
        $realname = sql_real_escape_string($realname);
        $password = sql_real_escape_string($obj->getPassword());
        $email    = sql_real_escape_string($email);
        $url      = sql_real_escape_string($url);
        $admin    = (int)$admin;
        $canlogin = (int)$canlogin;
        $notes    = sql_real_escape_string($notes);

        if (($admin) && !($canlogin)) {
            return _ERROR;
        }

        $query = sprintf(
            "INSERT INTO %s (MNAME,MREALNAME,MPASSWORD,MEMAIL,MURL,MADMIN,MCANLOGIN,MNOTES)
             VALUES ('%s','%s','%s','%s','%s',%d, %d,'%s')",
            sql_table('member'),
            $name,
            $realname,
            $password,
            $email,
            $url,
            $admin,
            $canlogin,
            $notes
        );
        sql_query($query);

        ACTIONLOG::add(INFO, _ACTIONLOG_NEWMEMBER . ' ' . $name);

        return 1;
    }

    /**
     * Returns activation info for a certain key (an object with properties
     * vkey, vmember, ...)
     * (static)
     *
     * @author karma
     */
    public static function getActivationInfo($key)
    {
        $query = sprintf(
            "SELECT * FROM %s WHERE vkey='%s'",
            sql_table('activation'),
            sql_real_escape_string($key)
        );
        $res = sql_query($query);

        if ($res && ($obj = sql_fetch_object($res))) {
            return $obj;
        }

        return 0;
    }

    /**
     * Creates an account activation key
     *
     * @param $type     one of the following values (determines what to do when
     *                  activation expires)
     *                  'register' (new member registration)
     *                  'forgot' (forgotton password)
     *                  'addresschange' (member address has changed)
     * @param $extra    extra info (needed when validation link expires)
     *                  addresschange -> old email address
     *
     * @author dekarma
     */
    public function generateActivationEntry($type, $extra = '')
    {
        // clean up old entries
        $this->cleanupActivationTable();

        // kill any existing entries for the current member (delete is ok)
        // (only one outstanding activation key can be present for a member)
        sql_query(sprintf(
            'DELETE FROM %s WHERE vmember=%d',
            sql_table('activation'),
            (int)$this->getID()
        ));

        $canLoginWhileActive = false; // indicates if the member can log in while the link is active
        switch ($type) {
            case 'forgot':
                $canLoginWhileActive = true;
                break;
            case 'register':
                break;
            case 'addresschange':
                $extra = $extra . '/' . ($this->canLogin() ? '1' : '0');
                break;
        }

        $ok = false;
        while (!$ok) {
            // generate a random key
            mt_srand((float)microtime() * 1000000);
            $key = md5(uniqid(mt_rand(), true));

            // attempt to add entry in database
            // add in database as non-active
            $query = sprintf(
                "INSERT INTO %s (vkey, vtime, vmember, vtype, vextra)
                 VALUES ('%s', '%s', '%d', '%s', '%s')",
                sql_table('activation'),
                sql_real_escape_string($key),
                date('Y-m-d H:i:s'),
                (int)$this->getID(),
                sql_real_escape_string($type),
                sql_real_escape_string($extra)
            );
            if (sql_query($query)) {
                $ok = true;
            }
        }

        // mark member as not allowed to log in
        if (!$canLoginWhileActive) {
            $this->setCanLogin(0);
            $this->write();
        }

        // return the key
        return $key;
    }

    /**
     * Inidicates that an activation link has been clicked and any forms
     * displayed there have been successfully filled out.
     *
     * @author dekarma
     */
    public static function activate($key)
    {
        // get activate info
        $info = MEMBER::getActivationInfo($key);

        // no active key
        if (!$info) {
            return false;
        }

        switch ($info->vtype) {
            case 'forgot':
                // nothing to do
                break;
            case 'register':
                // set canlogin value
                global $CONF;
                sql_query(sprintf(
                    'UPDATE %s SET mcanlogin=%d WHERE mnumber=%d',
                    sql_table('member'),
                    (int)$CONF['NewMemberCanLogon'],
                    (int)$info->vmember
                ));
                break;
            case 'addresschange':
                // reset old 'canlogin' value
                list($oldEmail, $oldCanLogin) = explode('/', $info->vextra);
                sql_query(sprintf(
                    'UPDATE %s SET mcanlogin=%d WHERE mnumber=%d',
                    sql_table('member'),
                    (int)$oldCanLogin,
                    (int)$info->vmember
                ));
                break;
        }

        // delete from activation table
        sql_query(sprintf(
            "DELETE FROM %s WHERE vkey='%s'",
            sql_table('activation'),
            sql_real_escape_string($key)
        ));

        // success!
        return true;
    }

    /**
     * Cleans up entries in the activation table. All entries older than 2 days
     * are removed.
     * (static)
     *
     * @author dekarma
     */
    public static function cleanupActivationTable()
    {
        global $CONF, $DIR_LIBS;

        $actdays = 2;
        if (isset($CONF['ActivationDays'])
            && (int)$CONF['ActivationDays'] > 0) {
            $actdays = (int)$CONF['ActivationDays'];
        } else {
            $CONF['ActivationDays'] = 2;
        }
        $boundary = time() - (60 * 60 * 24 * $actdays);

        // 1. walk over all entries, and see if special actions need to be performed
        $res = sql_query(sprintf(
            "SELECT * FROM %s WHERE vtime < '%s'",
            sql_table('activation'),
            date('Y-m-d H:i:s', $boundary)
        ));

        if ($res) {
            while ($o = sql_fetch_object($res)) {
                switch ($o->vtype) {
                    case 'register':
                        // delete all information about this site member. registration is undone because there was
                        // no timely activation
                        include_once($DIR_LIBS . 'ADMIN.php');
                        ADMIN::deleteOneMember((int)$o->vmember);
                        break;
                    case 'addresschange':
                        // revert the e-mail address of the member back to old address
                        list($oldEmail, $oldCanLogin) = explode(
                            '/',
                            $o->vextra
                        );
                        sql_query(sprintf(
                            "UPDATE %s SET mcanlogin=%d, memail='%s' WHERE mnumber=%d",
                            sql_table('member'),
                            (int)$oldCanLogin,
                            sql_real_escape_string($oldEmail),
                            (int)$o->vmember
                        ));
                        break;
                    case 'forgot':
                        // delete the activation link and ignore. member can request a new password using the
                        // forgot password link
                        break;
                }
            }
        }

        // 2. delete activation entries for real
        sql_query(sprintf(
            "DELETE FROM %s WHERE vtime < '%s'",
            sql_table('activation'),
            date('Y-m-d H:i:s', $boundary)
        ));
    }

    public static function checkIfValidPasswordCharacters($password)
    {
        // check Characters
        // 0x21-0x7e : 0-9 a-z A-Z ! " # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \ ] ^ _ ` { | } ~
        return preg_match('/^[\x21-\x7e]{6,}$/', $password);
    }
}
