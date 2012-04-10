<?php

/* 
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * A class representing site members
 * 
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id: MEMBER.php 1616 2012-01-08 09:48:15Z sakamocchi $
 */
class Member
{
	// 1 when authenticated, 0 when not
	public $loggedin = 0;
	public $password;		// not the actual password, but rather a MD5 hash
	private $algorism = 'md5';
	
	public $cookiekey;		// value that should also be in the client cookie to allow authentication
	private $cookie_salt = FALSE;
	
	// member info
	public $id = -1;
	public $realname;
	public $displayname;
	public $email;
	public $url;
	public $admin = 0;			// (either 0 or 1)
	public $canlogin = 0;		// (either 0 or 1)
	public $notes;
	public $autosave = 1;		// if the member use the autosave draft function
	private $locale = '';
	
	/**
	 * Member::__construct()
	 * Constructor for a member object
	 * 
	 * @param	Void
	 * @return	Void
	 * 
	 */
	public function __construct()
	{
		return;
	}
	
	/**
	 * Member::createFromName()
	 * Create a member object for a given displayname
	 * 
	 * @static
	 * @param	String	$displayname	login name
	 * @return	Object	member object
	 * 
	 */
	public static function &createFromName($displayname)
	{
		$mem = new Member();
		$mem->readFromName($displayname);
		return $mem;
	}
	
	/**
	 * Member::createFromID()
	 * Create a member object for a given ID
	 * 
	 * @static
	 * @param	Integer	$id	id for member
	 */
	public static function &createFromID($id)
	{
		$mem = new Member();
		$mem->readFromID($id);
		return $mem;
	}
	
	/**
	 * Member::readFromName()
	 * Read member table in database
	 * 
	 * @param	String	$displayname	login name
	 * @return	Object	SQL resource
	 * 
	 */
	public function readFromName($displayname)
	{
		return $this->read("mname='".sql_real_escape_string($displayname)."'");
	}
	
	/**
	 * Member::readFromID()
	 * Read member table in database
	 * 
	 * @param	Integer	$id	id for member
	 * @return	Object	SQL resource
	 * 
	 */
	public function readFromID($id)
	{
		return $this->read("mnumber=" . intval($id));
	}
	
	/**
	 * Member::hash()
	 * hash the target string
	 * 
	 * @param	String	$string	target string
	 * @return	Void	hashed string
	 */
	public function hash($string)
	{
		switch ( $this->algorism )
		{
			case 'md5':
			default:
				$string = md5($string);
		}
		return $string;
	}
	
	/**
	 * Member::set_cookie_salt()
	 * 
	 * @param	integer	$key	secureCookieKey value
	 * @return	void
	 * 
	 */
	private function set_cookie_salt($key = 0)
	{
		if ( !$key )
		{
			$key = 24;
		}
		
		switch( $key )
		{
			case 8:
				$this->cookie_salt = preg_replace('/\.[0-9]+\.[0-9]+\.[0-9]+$/', '', serverVar('REMOTE_ADDR'));
				break;
			case 16:
				$this->cookie_salt = preg_replace('/\.[0-9]+\.[0-9]+$/', '', serverVar('REMOTE_ADDR'));
				break;
			case 24:
				$this->cookie_salt = preg_replace('/\.[0-9]+$/', '', serverVar('REMOTE_ADDR'));
				break;
			case 32:
				$this->cookie_salt = serverVar('REMOTE_ADDR');
				break;
			default:
				$this->cookie_salt = 'none';
		}
		return;
	}
	
	/**
	 * Member::login()
	 * Tries to login as a given user.
	 * Returns true when succeeded, returns false when failed
	 * 3.40 adds CustomLogin event
	 * 
	 * @param	String	$login	login name for member
	 * @param	String	$password	password for member
	 * @param	Integer	$shared	whether the user agent is shared or not
	 * 
	 */
	public function login($login, $password, $shared=1)
	{
		global $CONF, $errormessage, $manager;
		
		/* TODO: validation for $login, $password, $shared */
		if ( $login == '' || $password == '' )
		{
			return 0;
		}
		/* limiting the length of password to avoid hash collision */
		$password=i18n::substr($password, 0, 40);
		
		/* 
		 * generate cookie salt from secure cookie key settings
		* (either 'none', 0, 8, 16, 24, or 32)
		*/
		if ( !$this->cookie_salt )
		{
			$salt = 0;
			if ( array_key_exists('secureCookieKey', $CONF) )
			{
				$salt = $CONF['secureCookieKey'];
			}
			$this->set_cookie_salt($salt);
		}
		
		$success = 0;
		$allowlocal = 1;
		$manager->notify('CustomLogin', array('login' => &$login, 'password'=>&$password, 'success'=>&$success, 'allowlocal'=>&$allowlocal));
		
		$this->loggedin = 0;
		if ( $success )
		{
			$this->loggedin = ( $this->readFromName($login) );
		}
		elseif ( $allowlocal )
		{
			$this->loggedin = ( $this->readFromName($login) && $this->checkPassword($password) );
		}
		
		/* login failed */
		if ( !$this->loggedin )
		{
			$trimlogin = trim($login);
			if ( empty($trimlogin) )
			{
				$errormessage = "Please enter a username.";
			}
			else
			{
				$errormessage = 'Login failed for ' . $login;
			}
			$manager->notify('LoginFailed', array('username' => $login) );
			ActionLog::add(INFO, $errormessage);
		}
		/* login success */
		else
		{
			/* For lower compatibility */
			if ( strlen($this->password) === 32 )
			{
				$this->password = $this->hash($password);
			}
			
			$this->newCookieKey();
			$this->setCookies($shared);
			
			if ( $this->cookie_salt !== 'none' )
			{
				/* secure cookie key */
				$this->setCookieKey($this->hash($this->getCookieKey() . $this->cookie_salt));
				$this->write();
			}
			
			$errormessage = '';
			$manager->notify('LoginSuccess', array('member' => &$member, 'username' => $login) );
			ActionLog::add(INFO, "Login successful for $login (sharedpc=$shared)");
		}
		
		return $this->loggedin;
	}
	
	/**
	 * Member::cookielogin()
	 * Login using cookie key
	 * 
	 * @param	String	$login	not used
	 * @param	String	$cookiekey	not used
	 * @return	Boolean	login or not
	 */
	public function cookielogin($login='', $cookiekey='')
	{
		global $CONF, $manager;
		
		if ( !headers_sent() && cookieVar("{$CONF['CookiePrefix']}user") )
		{
			/* Cookie Authentication */
			$ck = cookieVar("{$CONF['CookiePrefix']}loginkey");
				
			/* TODO: validation for each cookie values */
			 	
			/* limiting the length of password to avoid hash collision */
			$ck = i18n::substr($ck,0,32);
				
			/* 
			 * generate cookie salt from secure cookie key settings
			* (either 'none', 0, 8, 16, 24, or 32)
			*/
			if ( !$this->cookie_salt )
			{
				$salt = 0;
				if ( array_key_exists('secureCookieKey', $CONF) )
				{
					$salt = $CONF['secureCookieKey'];
				}
				$this->set_cookie_salt($salt);
			}
			
			if ( $this->cookie_salt !== 'none' )
			{
				$ck = $this->hash($ck . $this->cookie_salt);
			}
			$this->loggedin = ( $this->readFromName(cookieVar("{$CONF['CookiePrefix']}user")) && $this->checkCookieKey($ck) );
			unset($ck);
				
			/* renew cookies when not on a shared computer */
			if ( $this->loggedin && (cookieVar($CONF['CookiePrefix'] . 'sharedpc') != 1) )
			{
				$this->setCookieKey(cookieVar("{$CONF['CookiePrefix']}loginkey"));
				$this->setCookies();
			}
		}
		return $this->loggedin;
	}
	
	/**
	 * Member::logout()
	 * logout and expire cookie
	 * 
	 * @param	Void
	 * @return	Void
	 */
	public function logout()
	{
		global $CONF, $manager;
		
		if ( !headers_sent() && cookieVar("{$CONF['CookiePrefix']}user") )
		{
			/* remove cookies on logout */
			setcookie("{$CONF['CookiePrefix']}user", '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
			setcookie("{$CONF['CookiePrefix']}loginkey", '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
			$manager->notify('Logout', array('username' => cookieVar("{$CONF['CookiePrefix']}user") ) );
		}
		
		$this->loggedin = 0;
		return;
	}
	
	/**
	 * Member::isLoggedIn()
	 * return member is loggedin or not
	 * 
	 * @param	Void
	 * @return	Void
	 */
	public function isLoggedIn()
	{
		return $this->loggedin;
	}
	
	/**
	 * MEMBER:read()
	 * Read member information from the database
	 * 
	 * @param	String	$where	where statement
	 * @return	Resource	SQL resource
	 * 
	 */
	public function read($where)
	{
		// read info
		$query =  'SELECT * FROM '.sql_table('member') . ' WHERE ' . $where;
		
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		
		$this->setRealName($obj->mrealname);
		$this->setEmail($obj->memail);
		$this->password = $obj->mpassword;
		$this->setCookieKey($obj->mcookiekey);
		$this->setURL($obj->murl);
		$this->setDisplayName($obj->mname);
		$this->setAdmin($obj->madmin);
		$this->id = $obj->mnumber;
		$this->setCanLogin($obj->mcanlogin);
		$this->setNotes($obj->mnotes);
		$this->setLocale($obj->mlocale);
		$this->setAutosave($obj->mautosave);
		
		return sql_num_rows($res);
	}
	
	/**
	 * Member::isBlogAdmin()
	 * Returns true if member is an admin for the given blog
	 * (returns false if not a team member)
	 * 
	 * @param	Integer	$blogid	weblog id
	 * @return	Integer	weblog admin or not
	 * 
	 */
	public function isBlogAdmin($blogid)
	{
		$query = 'SELECT tadmin FROM '.sql_table('team').' WHERE'
		. ' tblog=' . intval($blogid)
		. ' and tmember='. $this->getID();
		$res = sql_query($query);
		if ( sql_num_rows($res) == 0 )
			return 0;
		else
			return ( sql_result($res,0,0) == 1 );
	}
	
	/**
	 * Member::blogAdminRights()
	 * 
	 * @param	integer	$blogid	ID of target weblog
	 * @return	boolean	whether to have admin rights to the weblog or not
	 * 
	 */
	public function blogAdminRights($blogid)
	{
		return ($this->isAdmin() || $this->isBlogAdmin($blogid));
	}
	
	/**
	 * Member::teamRights()
	 * 
	 * @param	integer	$blogid	ID of target weblog
	 * @return	boolean	whether to have admin right to the weblog or not
	 * 
	 */
	public function teamRights($blogid)
	{
		return ($this->isAdmin() || $this->isTeamMember($blogid));
	}
	
	/**
	 * Member::isTeamMember()
	 * Returns true if this member is a team member of the given blog
	 * 
	 * @param	integer	$blogid	ID of target weblog
	 * @return	boolean	whether to join the weblog or not
	 * 
	 */
	public function isTeamMember($blogid)
	{
		$query = 'SELECT * FROM '.sql_table('team').' WHERE'
			   . ' tblog=' . intval($blogid)
			   . ' and tmember='. $this->getID();
		$res = sql_query($query);
		return (sql_num_rows($res) != 0);
	}
	
	/**
	 * Member::canAddItem()
	 * 
	 * @param	integer	$catid	ID of target category
	 * @return	boolean	whether to be able to add items to the category or not
	 * 
	 */
	public function canAddItem($catid)
	{
		global $manager;
		
		// if this is a 'newcat' style newcat
		// no blog admin of destination blog -> NOK
		// blog admin of destination blog -> OK
		if ( strstr($catid,'newcat') )
		{
			// get blogid
			list($blogid) = sscanf($catid,"newcat-%d");
			return $this->blogAdminRights($blogid);
		}
		
		// category does not exist -> NOK
		if ( !$manager->existsCategory($catid) )
		{
			return 0;
		}
		
		$blogid = getBlogIDFromCatID($catid);
		
		// no team rights for blog -> NOK
		if (!$this->teamRights($blogid))
		{
			return 0;
		}
		
		// all other cases: OK
		return 1;
	}
	
	/**
	 * Member::canAlterComment()
	 * Returns true if this member can edit/delete a commentitem. This can be in the
	 * following cases:
	 *	  - member is a super-admin
	 *   - member is the author of the comment
	 *   - member is admin of the blog associated with the comment
	 *   - member is author of the item associated with the comment
	 * 
	 * @param	integer	$commentid	ID of target comment
	 * @return	boolean	delete/edit the comment or not
	 * 
	 */
	public function canAlterComment($commentid)
	{
		if ( $this->isAdmin() )
		{
			return 1;
		}
		
		$query =  'SELECT citem as itemid, iblog as blogid, cmember as cauthor, iauthor'
			   . ' FROM '.sql_table('comment') .', '.sql_table('item').', '.sql_table('blog')
			   . ' WHERE citem=inumber and iblog=bnumber and cnumber=' . intval($commentid);
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		
		return ($obj->cauthor == $this->getID()) or $this->isBlogAdmin($obj->blogid) or ($obj->iauthor == $this->getID());
	}
	
	/**
	 * Member::canAlterItem()
	 * Returns true if this member can edit/delete an item. This is true in the following
	 * cases: - member is a super-admin
	 *	       - member is the author of the item
	 *        - member is admin of the the associated blog
	 * 
	 * @param	integer	$itemid	ID of target item
	 * @return	boolean	delete/edit the item or not
	 * 
	 */
	public function canAlterItem($itemid)
	{
		if ($this->isAdmin()) return 1;
		
		$query =  'SELECT iblog, iauthor FROM '.sql_table('item').' WHERE inumber=' . intval($itemid);
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return ($obj->iauthor == $this->getID()) or $this->isBlogAdmin($obj->iblog);
	}
	
	/**
	 * Member::canBeDeleted()
	 * Return true if member can be deleted. This means that there are no items posted by the member left
	 * 
	 * @param	void
	 * @return	boolean	whether there is no items or exists
	 * 
	 */
	public function canBeDeleted()
	{
		$res = sql_query('SELECT * FROM '.sql_table('item').' WHERE iauthor=' . $this->getID());
		return ( sql_num_rows($res) == 0 );
	}
	
	/**
	 * Member::canUpdateItem()
	 * returns true if this member can move/update an item to a given category,
	 * false if not (see comments fot the tests that are executed)
	 * 
	 * @param	integer	$itemid
	 * @param	string	$newcat (can also be of form 'newcat-x' with x=blogid)
	 * @return	boolean	whether being able to update the item or not
	 * 
	 */
	public function canUpdateItem($itemid, $newcat)
	{
		global $manager;
		
		// item does not exists -> NOK
		if ( !$manager->existsItem($itemid,1,1) )
		{
			return 0;
		}
		
		// cannot alter item -> NOK
		if (!$this->canAlterItem($itemid))
		{
			return 0;
		}
		
		// if this is a 'newcat' style newcat
		// no blog admin of destination blog -> NOK
		// blog admin of destination blog -> OK
		if (strstr($newcat,'newcat'))
		{
			// get blogid
			list($blogid) = sscanf($newcat,'newcat-%d');
			return $this->blogAdminRights($blogid);
		}
		
		// category does not exist -> NOK
		if (!$manager->existsCategory($newcat))
		{
			return 0;
		}
		
		// get item
		$item =& $manager->getItem($itemid,1,1);
		
		// old catid = new catid -> OK
		if ($item['catid'] == $newcat)
		{
			return 1;
		}
		
		// not a valid category -> NOK
		$validCat = quickQuery('SELECT COUNT(*) AS result FROM '.sql_table('category').' WHERE catid='.intval($newcat));
		if ( !$validCat )
		{
			return 0;
		}
		
		// get destination blog
		$source_blogid = getBlogIDFromItemID($itemid);
		$dest_blogid = getBlogIDFromCatID($newcat);
		
		// not a team member of destination blog -> NOK
		if ( !$this->teamRights($dest_blogid) )
		{
			return 0;
		}
		
		// if member is author of item -> OK
		if ( $item['authorid'] == $this->getID() )
		{
			return 1;
		}
		
		// if member has admin rights on both blogs: OK
		if ( ($this->blogAdminRights($dest_blogid)) && ($this->blogAdminRights($source_blogid)) )
		{
			return 1;
		}
		
		// all other cases: NOK
		return 0;
	}
	
	/**
	 * Member::setCookies()
	 * Sets the cookies for the member
	 * 
	 * @param boolean	$shared	set this to 1 when using a shared computer. Cookies will expire
	 *				at the end of the session in this case.
	 * @return	void
	 * 
	 */
	public function setCookies($shared = 0)
	{
		global $CONF;
		
		if ( $CONF['SessionCookie'] || $shared )
		{
			$lifetime = 0;
		}
		else
		{
			$lifetime = time()+2592000;
		}
		
		setcookie($CONF['CookiePrefix'] . 'user', $this->getDisplayName(), $lifetime, $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
		setcookie($CONF['CookiePrefix'] . 'loginkey', $this->getCookieKey(), $lifetime, $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
		
		// make sure cookies on shared pcs don't get renewed
		if ( $shared )
		{
			setcookie($CONF['CookiePrefix'] .'sharedpc', '1',$lifetime,$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
		}
		return;
	}
	
	/**
	 * Member::sendActivationLink()
	 * Send activation mail
	 * 
	 * @param	string	$type	activation type
	 * @param	string	$extra	extra info
	 * @return	void
	 */
	public function sendActivationLink($type, $extra='')
	{
		global $CONF;
		
		if ( !isset($CONF['ActivationDays']) )
		{
			$CONF['ActivationDays'] = 2;
		}
		
		// generate key and URL
		$key = $this->generateActivationEntry($type, $extra);
		$url = $CONF['AdminURL'] . 'index.php?action=activate&key=' . $key;
		
		// choose text to use in mail
		switch ( $type )
		{
			case 'register':
				$message = _ACTIVATE_REGISTER_MAIL;
				$subject = _ACTIVATE_REGISTER_MAILTITLE;
				break;
			case 'forgot':
				$message = _ACTIVATE_FORGOT_MAIL;
				$subject = _ACTIVATE_FORGOT_MAILTITLE;
				break;
			case 'addresschange':
				$message = _ACTIVATE_CHANGE_MAIL;
				$subject = _ACTIVATE_CHANGE_MAILTITLE;
				break;
			default;
		}
		
		// fill out variables in text
		$aVars = array(
			'siteName' => $CONF['SiteName'],
			'siteUrl' => $CONF['IndexURL'],
			'memberName' => $this->getDisplayName(),
			'activationUrl' => $url,
			'activationDays' => $CONF['ActivationDays']
		);
		
		$message = Template::fill($message, $aVars);
		$subject = Template::fill($subject, $aVars);
		
		// send mail
		NOTIFICATION::mail($this->getEmail(), $subject ,$message, $CONF['AdminEmail'], i18n::get_current_charset());
		
		ActionLog::add(INFO, _ACTIONLOG_ACTIVATIONLINK . ' (' . $this->getDisplayName() . ' / type: ' . $type . ')');
		return;
	}
	
	/**
	 * Member::getAdminBlogs()
	 * Returns an array of all blogids for which member has admin rights
	 * 
	 * @param	void
	 * @return	array	weblog IDs in which this member has admin rights
	 * 
	 */
	public function getAdminBlogs()
	{
		$blogs = array();
		
		if ($this->isAdmin())
		{
			$query = 'SELECT bnumber as blogid from '.sql_table('blog');
		}
		else
		{
			$query = 'SELECT tblog as blogid from '.sql_table('team').' where tadmin=1 and tmember=' . $this->getID();
		}
		
		$res = sql_query($query);
		if ( sql_num_rows($res) > 0 )
		{
			while ( $obj = sql_fetch_object($res) )
			{
				array_push($blogs, $obj->blogid);
			}
		}
		return $blogs;
	}
	
	/**
	 * Member::getTeamBlogs()
	 * Returns an array of all blogids for which member has team rights
	 * 
	 * @param	boolean	$incAdmin	whether checking weblog admin rights or not
	 * @return	array	weblog IDs in which this member join
	 * 
	 */
	public function getTeamBlogs($incAdmin = 1)
	{
		$incAdmin = intval($incAdmin);
		$blogs = array();
		
		if ( $this->isAdmin() && $incAdmin )
		{
			$query = 'SELECT bnumber as blogid from '.sql_table('blog');
		}
		else
		{
			$query = 'SELECT tblog as blogid from '.sql_table('team').' where tmember=' . $this->getID();
		}
		
		$res = sql_query($query);
		if ( sql_num_rows($res) > 0 )
		{
			while ( $obj = sql_fetch_object($res) )
			{
				array_push($blogs, $obj->blogid);
			}
		}
		return $blogs;
	}
	
	/**
	 * Member::getNotifyFromMailAddress()
	 * 
	 * Returns an email address from which notification of commenting/karma voting can
	 * be sent. A suggestion can be given for when the member is not logged in
	 * 
	 * @param	String	$suggest
	 * @return	String	mail address or suggestion
	 */
	public function getNotifyFromMailAddress($suggest = "")
	{
		global $CONF;
		if ( $this->isLoggedIn() )
		{
			return $this->getDisplayName() . " <" . $this->getEmail() . ">";
		}
		else if ( NOTIFICATION::address_validation($suggest) )
		{
			return $suggest;
		}
		return $CONF['AdminEmail'];
	}
	
	/**
	 * Member::write()
	 * Write data to database
	 * 
	 * @param	void
	 * @return	void
	 * 
	 */
	public function write()
	{
		$query =  'UPDATE '.sql_table('member')
		        . " SET mname='" . sql_real_escape_string($this->displayname) . "', "
		           . "mrealname='". sql_real_escape_string($this->realname) . "', "
		           . "mpassword='". sql_real_escape_string($this->password) . "', "
		           . "mcookiekey='". sql_real_escape_string($this->cookiekey) . "', "
		           . "murl='" . sql_real_escape_string($this->url) . "', "
		           . "memail='" . sql_real_escape_string($this->email) . "', "
		           . "madmin=" . intval($this->admin) . ", "
		           . "mnotes='" . sql_real_escape_string($this->notes) . "', "
		           . "mcanlogin=" . intval($this->canlogin) . ", "
		           . "mlocale='" . sql_real_escape_string($this->locale) . "', "
		           . "mautosave=" . intval($this->autosave) . " "
		        . "WHERE mnumber=" . intval($this->id);
		sql_query($query);
		return;
	}
	
	public function checkCookieKey($key)
	{
		return ( ($key != '') && ( $key == $this->getCookieKey() ) );
	}
	
	public function checkPassword($pw)
	{
		/* for lower compatibility (md5) */
		if ( strlen($this->password) === 32 )
		{
			return (md5($pw) == $this->password);
		}
		return ($this->hash($pw) == $this->password);
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
		$this->password = $this->hash($pwd);
	}
	
	public function getCookieKey()
	{
		return $this->cookiekey;
	}
	
	/**
	 * Member::newCookieKey()
	 * Generate new cookiekey, save it, and return it
	 * 
	 * @param	void
	 * @return	void
	 * 
	 */
	public function newCookieKey()
	{
		mt_srand( (double) microtime() * 1000000);
		$this->cookiekey = $this->hash(uniqid(mt_rand()));
		$this->write();
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
	
	public function getLocale()
	{
		return $this->locale;
	}
	
	public function setLocale($locale)
	{
		if ( !preg_match('#^(.+)_(.+)_(.+)$#', $locale)
		 && ($locale = i18n::convert_old_language_file_name_to_locale($locale)) === FALSE )
		{
			$locale = '';
		}
		$this->locale = $locale;
		return;
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
		$this->admin = $val;
	}
	
	public function canLogin()
	{
		return $this->canlogin;
	}
	
	public function setCanLogin($val)
	{
		$this->canlogin = $val;
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
		$this->autosave = $val;
		return;
	}
	
	/**
	 * Member::getID()
	 * 
	 * @param	void
	 * @return	integer	id of this member object
	 * 
	 */
	public function getID()
	{
		return $this->id;
	}
	
	/**
	 * Member::exists()
	 * Returns true if there is a member with the given login name
	 * 
	 * @static
	 * @param	string	$name	target name
	 * @return	boolean	whether target name exists or not
	 */
	public static function exists($name)
	{
		$r = sql_query('select * FROM '.sql_table('member')." WHERE mname='".sql_real_escape_string($name)."'");
		return ( sql_num_rows($r) != 0 );
	}
	
	/**
	 * Member::existsID()
	 * Returns true if there is a member with the given ID
	 * 
	 * @static
	 * @param	integer	$id	target id
	 * @return	boolean	whether target id exists or not
	 * 
	 */
	public static function existsID($id)
	{
		$r = sql_query('select * FROM '.sql_table('member')." WHERE mnumber='".intval($id)."'");
		return (sql_num_rows($r) != 0);
	}
	
	/**
	 * Member::isNameProtected()
	 *  Checks if a username is protected.
	 *  If so, it can not be used on anonymous comments
	 * 
	 * @param	string	$name	target name
	 * @return	boolean	whether the name exists or not
	 * 
	 */
	public function isNameProtected($name)
	{
		// extract name
		$name = strip_tags($name);
		$name = trim($name);
		return self::exists($name);
	}
	
	/**
	 * Member::create()
	 * Adds a new member
	 * 
	 * @static
	 * @param	String	$name
	 * @param	String	$realname
	 * @param	String	$password
	 * @param	String	$email
	 * @param	String	$url
	 * @param	String	$admin
	 * @param	String	$canlogin
	 * @param	String	$notes
	 * @return	String	1 if success, others if fail
	 */
	static public function create($name, $realname, $password, $email, $url, $admin, $canlogin, $notes)
	{
		if ( !NOTIFICATION::address_validation($email) )
		{
			return _ERROR_BADMAILADDRESS;
		}
		
		/* TODO: this method should be in MEMBER class, not globalfunctions */
		if ( !isValidDisplayName($name) )
		{
			return _ERROR_BADNAME;
		}
		
		if ( self::exists($name) )
		{
			return _ERROR_NICKNAMEINUSE;
		}
		
		if ( !$realname )
		{
			return _ERROR_REALNAMEMISSING;
		}
		
		/* TODO: check the number of characters */
		if ( !$password )
		{
			return _ERROR_PASSWORDMISSING;
		}
		
		/* 
		 *  begin if: sometimes user didn't prefix the URL with http:// or https://,
		 *  this cause a malformed URL. Let's fix it.
		 */
		
		if ( !preg_match('#^https?://#', $url) )
		{
			$url = 'http://' . $url;
		}
		
		$name		= sql_real_escape_string($name);
		$realname	= sql_real_escape_string($realname);
		/* NOTE: hashed password is automatically updated if the length is 32 bytes when logging in */
		$password	= sql_real_escape_string(md5($password));
		$email		= sql_real_escape_string($email);
		$url		= sql_real_escape_string($url);
		$admin		= (integer) $admin;
		$canlogin	= (integer) $canlogin;
		$notes		= sql_real_escape_string($notes);
		
		$query = "INSERT INTO %s"
		       . " (MNAME,MREALNAME,MPASSWORD,MEMAIL,MURL, MADMIN, MCANLOGIN, MNOTES)"
		       . " VALUES ('%s','%s','%s','%s','%s',%d, %d, '%s')";
		$query = sprintf($query, sql_table(member), $name, $realname, $password, $email, $url, $admin, $canlogin, $notes);
		sql_query($query);
		
		ActionLog::add(INFO, _ACTIONLOG_NEWMEMBER . ' ' . $name);
		
		return 1;
	}
	
	/**
	 * Member::getActivationInfo()
	 * Returns activation info for a certain key (an object with properties vkey, vmember, ...)
	 * 
	 * @static
	 * @param	string	$key	activation key
	 * @return	mixed	return 0 if failed, else return activation table object
	 * 
	 */
	public static function getActivationInfo($key)
	{
		$query = 'SELECT * FROM ' . sql_table('activation') . ' WHERE vkey=\'' . sql_real_escape_string($key). '\'';
		$res = sql_query($query);
		
		if ( !$res || (sql_num_rows($res) == 0) )
		{
			return 0;
		}
		return sql_fetch_object($res);
	}
	
	/**
	 * Member::generateActivationEntry()
	 * Creates an account activation key
	 * addresschange -> old email address
	 * 
	 * @param	string	$type	one of the following values (determines what to do when activation expires)
	 * 				'register'	(new member registration)
	 * 				'forgot'	(forgotton password)
	 * 				'addresschange'	(member address has changed)
	 * @param	string	$extra	extra info (needed when validation link expires)
	 * @return	string	activation key
	 */
	public function generateActivationEntry($type, $extra = '')
	{
		// clean up old entries
		$this->cleanupActivationTable();
		
		// kill any existing entries for the current member (delete is ok)
		// (only one outstanding activation key can be present for a member)
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vmember=' . intval($this->getID()));
		
		// indicates if the member can log in while the link is active
		$canLoginWhileActive = false;
		switch ( $type )
		{
			case 'forgot':
				$canLoginWhileActive = true;
				break;
			case 'register':
				break;
			case 'addresschange':
				$extra = $extra . '/' . ( $this->canLogin() ? '1' : '0' );
				break;
		}
		
		$ok = false;
		while ( !$ok )
		{
			// generate a random key
			srand((double)microtime()*1000000);
			$key = $this->hash(uniqid(rand(), true));
			
			// attempt to add entry in database
			// add in database as non-active
			$query = 'INSERT INTO ' . sql_table('activation'). ' (vkey, vtime, vmember, vtype, vextra) ';
			$query .= 'VALUES (\'' . sql_real_escape_string($key). '\', \'' . date('Y-m-d H:i:s',time()) . '\', \'' . intval($this->getID()). '\', \'' . sql_real_escape_string($type). '\', \'' . sql_real_escape_string($extra). '\')';
			if ( sql_query($query) )
				$ok = true;
		}
		
		// mark member as not allowed to log in
		if ( !$canLoginWhileActive )
		{
			$this->setCanLogin(0);
			$this->write();
		}
		
		// return the key
		return $key;
	}
	
	/**
	 * Member::activate()
	 * Inidicates that an activation link has been clicked and any forms displayed
	 * there have been successfully filled out.
	 * 
	 * @param	string	$key	activation key
	 * @return	boolean
	 * 
	 */
	public function activate($key)
	{
		// get activate info
		$info = self::getActivationInfo($key);
		
		// no active key
		if ( !$info )
		{
			return false;
		}
		
		switch ( $info->vtype )
		{
			case 'forgot':
				// nothing to do
				break;
			case 'register':
				// set canlogin value
				global $CONF;
				sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($CONF['NewMemberCanLogon']). ' WHERE mnumber=' . intval($info->vmember));
				break;
			case 'addresschange':
				// reset old 'canlogin' value
				list($oldEmail, $oldCanLogin) = preg_split('#/#', $info->vextra);
				sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($oldCanLogin). ' WHERE mnumber=' . intval($info->vmember));
				break;
		}
		
		// delete from activation table
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vkey=\'' . sql_real_escape_string($key) . '\'');
		
		// success!
		return true;
	}
	
	/**
	 * Member::cleanupActivationTable()
	 * Cleans up entries in the activation table. All entries older than 2 days are removed.
	 * (static)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function cleanupActivationTable()
	{
		$actdays = 2;
		if ( isset($CONF['ActivationDays']) && intval($CONF['ActivationDays']) > 0 )
		{
			$actdays = intval($CONF['ActivationDays']);
		}
		else
		{
			$CONF['ActivationDays'] = 2;
		}
		$boundary = time() - (60 * 60 * 24 * $actdays);
		
		// 1. walk over all entries, and see if special actions need to be performed
		$res = sql_query('SELECT * FROM ' . sql_table('activation') . ' WHERE vtime < \'' . date('Y-m-d H:i:s',$boundary) . '\'');
		
		while ( $o = sql_fetch_object($res) )
		{
			switch ( $o->vtype )
			{
				case 'register':
					// delete all information about this site member. registration is undone because there was
					// no timely activation
					include_once($DIR_LIBS . 'ADMIN.php');
					Admin::deleteOneMember(intval($o->vmember));
					break;
				case 'addresschange':
					// revert the e-mail address of the member back to old address
					list($oldEmail, $oldCanLogin) = preg_split('#/#', $o->vextra);
					sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($oldCanLogin). ', memail=\'' . sql_real_escape_string($oldEmail). '\' WHERE mnumber=' . intval($o->vmember));
					break;
				case 'forgot':
					// delete the activation link and ignore. member can request a new password using the
					// forgot password link
					break;
			}
		}
		
		// 2. delete activation entries for real
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vtime < \'' . date('Y-m-d H:i:s',$boundary) . '\'');
		return;
	}
	
	/**
	 * Member::$language
	 * 
	 * @obsolete
	 * @param	void
	 * @return	void
	 * 
	 */
	public $language = '';
	/**
	 * Member::getLanguage()
	 * 
	 * @obsolete
	 * @param	void
	 * @return	void
	 * 
	 */
	public function getLanguage()
	{
		if ( ($language = i18n::convert_locale_to_old_language_file_name($this->locale)) === FALSE )
		{
			$language = '';
		}
		return $language;
	}
}
