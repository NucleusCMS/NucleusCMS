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
 */

/*
 * The code for the Nucleus admin area
 */

if ( ! function_exists('requestVar')) {
    exit;
}
require_once __DIR__ . '/showlist.php';

/**
 * Builds the admin area and executes admin actions
 */
class ADMIN
{
    /**
     * @var string $action action currently being executed ($action=xxxx -> action_xxxx method)
     */
    public $action;
    public array $extrahead            = [];
    public array $system_info_messages = []; // [0] warn notice error , [1] msg
    public string $upgrade_message     = '';
    public const default_admin_css     = 'contemporary';

    /**
     * Class constructor
     */
    public function __construct()
    {
        global $member;

        // Note: Even if the user is not logged in, it will come in here

        if (isset($member) && is_object($member) && $member->isLoggedIn() && 32 == strlen($member->getPassword())) {
            $this->system_info_messages[] = ["normal", '古い暗号化でパスワードが保存されています。安全のためパスワードを変更してください。'];
        }

        //$this->check_admin_vars();
        $this->checkSecurityRisk();
        //$this->initCheckUpgarde();
        // todo: write code and wait for debugging
    }

    private function check_admin_vars()
    {
        // todo: write code and wait for debugging
    }

    private function initCheckUpgarde()
    {
        // todo: write code and wait for debugging
    }

    public static function checkInvalidBrowser()
    {
        // todo: write code and wait for debugging
    }

    /**
     * Executes an action
     *
     * @param string $action action to be performed
     */
    public function action($action)
    {
        global $manager;

        self::checkInvalidBrowser();

        // list of action aliases
        $alias = [
            'login' => 'overview',
            ''      => 'overview',
        ];

        if (isset($alias[$action])) {
            $action = $alias[$action];
        }

        $methodName = 'action_' . $action;

        $this->action = strtolower($action);

        // check ticket. All actions need a ticket, unless they are considered to be safe (a safe action
        // is an action that requires user interaction before something is actually done)
        // all safe actions are in this array:
        $aActionsNotToCheck = [
            'actionlog',
            'activate',
            'backupoverview',
            'banlist',
            'banlistdelete',
            'banlistnew',
            'banlistnewfromitem',
            'blogcommentlist',
            'blogsettings',
            'bookmarklet',
            'browseowncomments',
            'browseownitems',
            'categorydelete',
            'categoryedit',
            'commentdelete',
            'commentedit',
            'createitem',
            'createnewlog',
            'deleteblog',
            'editmembersettings',
            'itemcommentlist',
            'itemdelete',
            'itemedit',
            'itemlist',
            'itemmove',
            'login',
            'lost_pwd',
            'manage',
            'manageteam',
            'memberdelete',
            'memberedit',
            'memberhalt',
            'memberpasswordchange',
            'optimizeoverview',
            'overview',
            'plugindelete',
            'pluginhelp',
            'pluginlist',
            'pluginoptions',
            'settingsedit',
            'showlogin',
            'skinchangestype',
            'skindelete',
            'skinedit',
            'skinedittype',
            'skinieoverview',
            'skinoverview',
            'skinremovetype',
            'systemlog',
            'systemoverview',
            'teamdelete',
            'templatedelete',
            'templateedit',
            'templateoverview',
            'usermanagement',
        ];

        if ( ! in_array($this->action, $aActionsNotToCheck)) {
            if ( ! $manager->checkTicket()) {
                $this->error(_ERROR_BADTICKET);
            }
        }

        if (method_exists($this, $methodName)) {
            call_user_func([$this, $methodName]);
        } else {
            $this->error(_BADACTION . hsc(" ({$action})"));
        }
    }

    /**
     * @todo document this
     */
    public function action_showlogin()
    {
        global $error;
        $this->action_login($error);
    }

    /**
     * @todo document this
     */
    public function action_login($msg = '', $passvars = 1)
    {
        global $member;

        if ( ! isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            header('HTTP/1.0 404 Not Found');
            exit;
        }

        // skip to overview when allowed
        if ($member->isLoggedIn() && $member->canLogin()) {
            $this->action_overview();
            exit;
        }

        $this->pagehead();

        $oldaction = postVar('oldaction');

        $params = [
            'msg'             => $msg ? sprintf('%s: %s', _MESSAGE, escapeHTML($msg)) : '',
            'passRequestVars' => ('logout' != $oldaction && 'login' != $oldaction && $passvars), // pass through vars
        ];

        echo \parseBlade('admin.action_showlogin', $params), "\n";

        $this->pagefoot();
    }

    /**
     * provides a screen with the overview of the actions available
     *
     * @todo document parameter
     */
    public function action_overview($msg = '')
    {
        global $member;

        $this->pagehead();

        if ($msg) {
            echo _MESSAGE , ': ', $msg;
        }

        /* ---- add items ---- */
        echo '<h2>' . _OVERVIEW_YRBLOGS . '</h2>';

        $isShowAll = 'yes' === requestVar('showall');

        $ph = [];
        if ($isShowAll && $member->isAdmin()) {
            // Super-Admins have access to all blogs! (no add item support though)
            $query = 'SELECT bnumber, bname, 1 as tadmin, burl, bshortname';
            $query .= ' FROM [@prefix@]blog ORDER BY bname';
        } else {
            $query = 'SELECT bnumber, bname, tadmin, burl, bshortname';
            $query .= ' FROM [@prefix@]blog, [@prefix@]team';
            $query .= ' WHERE tblog=bnumber and tmember=[@tmember@] ORDER BY bname';
            $ph['tmember'] = $member->getID();
        }
        $query                  = parseQuery($query, $ph);
        $template['content']    = 'bloglist';
        $template['superadmin'] = $member->isAdmin();
        echo '<div>';
        $amount = showlist_by_query($query, 'table', $template);
        echo '</div>';

        if ( ! $isShowAll && $member->isAdmin()) {
            $total = quickQuery(parseQuery('SELECT COUNT(*) as result FROM [@prefix@]blog'));
            if ($total > $amount) {
                echo sprintf('<p><a href="index.php?action=overview&amp;showall=yes">%s</a></p>', _OVERVIEW_SHOWALL);
            }
        }

        if (0 == $amount) {
            echo _OVERVIEW_NOBLOGS;
        }

        if (0 != $amount) {
            echo sprintf('<h2>%s</h2>', _OVERVIEW_YRDRAFTS);

            // Todo display author
            $query = parseQuery(
                'SELECT bnumber, count(*), sum(iauthor=[@iauthor@]) FROM [@prefix@]item, [@prefix@]blog WHERE iblog=bnumber AND idraft=1 GROUP BY bnumber ORDER BY bnumber ASC',
                ['iauthor' => $member->getID()]
            );

            $items = [];
            $rs    = sql_query($query);
            if ($rs) {
                while ($row = sql_fetch_row($rs)) {
                    $items[] = array_merge($row);
                }
                sql_free_result($rs);
            }

            $has_hidden_items = 0;
            $amountdrafts     = 0;
            $showall          = ('yes' == requestVar('showall') && $member->isAdmin());

            foreach ($items as $item) {
                // blogid  sum(item)  sum(item which belong to current user)
                $current_bid          = (int) $item[0];
                $count_blog_items     = (int) $item[1];
                $count_current_author = (int) $item[2];

                if ($member->isAdmin() && ($count_blog_items != $count_current_author)) {
                    $has_hidden_items++;
                }

                // Check user have a item
                if ( ! $showall && 0 == $count_current_author) {
                    continue;
                }

                // Todo: showall : Display whether the item belongs to
                $ct      = ($showall ? $count_blog_items : $count_current_author);
                $div_out = ($ct > 5);
                if ($div_out) {
                    echo '<div style="width: 100%; height: 150px; overflow: auto;">';
                }

                $ph['iblog'] = $current_bid;
                $query       = 'SELECT ititle, inumber, bshortname FROM [@prefix@]item, [@prefix@]blog';
                $query .= ' WHERE';
                if ($showall) {
                    $ph['iauthor'] = $member->getID();
                    $query .= ' iauthor=[@iauthor@] AND';
                }
                $query .= ' iblog=bnumber AND iblog=[@iblog@] AND idraft=1 ORDER BY inumber DESC';
                $query               = parseQuery($query, $ph);
                $template['content'] = 'draftlist';
                $amountdrafts += showlist_by_query($query, 'table', $template);

                if ($div_out) {
                    echo '</div>';
                }
            }
            if (0 == $amountdrafts) {
                echo _OVERVIEW_NODRAFTS;
            }

            if ($has_hidden_items && ! $isShowAll && $member->isAdmin()) {
                echo '<p><a href="index.php?action=overview&amp;showall=yes">' . _OVERVIEW_SHOWALL . '</a></p>';
            }
        }

        /* ---- user settings ---- */
        echo '<h2>' . _OVERVIEW_YRSETTINGS . '</h2>';
        echo '<ul>';
        echo sprintf('<li><a href="index.php?action=browseownitems">%s</a></li>', _OVERVIEW_BROWSEITEMS);
        echo sprintf('<li><a href="index.php?action=browseowncomments">%s</a></li>', _OVERVIEW_BROWSECOMM);
        echo sprintf('<li><a href="index.php?action=editmembersettings">%s</a></li>', _OVERVIEW_EDITSETTINGS);
        echo sprintf('<li><a href="index.php?action=memberpasswordchange">%s</a></li>', _OVERVIEW_USER_PASSWORD);
        echo '</ul>';

        /* ---- general settings ---- */
        if ($member->isAdmin()) {
            echo sprintf('<h2>%s</h2>', _OVERVIEW_MANAGEMENT);
            echo '<ul>';
            echo sprintf('<li><a href="index.php?action=manage">%s</a></li>', _OVERVIEW_MANAGE);
            echo '</ul>';
        }

        $this->pagefoot();
    }

    /**
     * Returns a link to a weblog
     *
     * @param object BLOG
     */
    public function bloglink(&$blog)
    {
        if (empty($blog) || ! is_object($blog)) {
            return '';
        }
        return sprintf(
            '<a href="%s" title="%s">%s</a>',
            hsc($blog->getRealURL()),
            _BLOGLIST_TT_VISIT,
            hsc($blog->getName())
        );
    }

    /**
     * @todo document this
     */
    public function action_manage($msg = '')
    {
        global $member, $DB_DRIVER_NAME;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        $_MANAGE_LINKS_ITEMS = str_replace('<a ', '<a target="_blank"  ', _MANAGE_LINKS_ITEMS);
        // $image_tag = "<img src='images/globe.gif' width='13' height='13' style='vertical-align:middle; padding-right:4px;' />";
        // $_MANAGE_LINKS_ITEMS = preg_replace('#(<a[^>]+>)#s', '\\1'.$image_tag , $_MANAGE_LINKS_ITEMS);

        $params = [
           'msg'                 => $msg ? _MESSAGE . ': ' . $msg : '',
           'member'              => $member,
           'oAdmin'              => $this,
           'IsMysql'             => 'mysql' === $DB_DRIVER_NAME,
           '_MANAGE_LINKS_ITEMS' => $_MANAGE_LINKS_ITEMS,
        ];
        echo \parseBlade('admin.action_manage', $params), "\n";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_itemlist($blogid = '')
    {
        global $member, $manager, $CONF;

        if ( ! $blogid) {
            $blogid = intRequestVar('blogid');
        }

        if ( ! $member->teamRights($blogid)) {
            if ( ! $member->isAdmin()) {
                $this->disallow();
            }
        }

        $this->pagehead();
        $blog = &$manager->getBlog($blogid);

        echo '<p><a href="index.php?action=overview">(', _BACK_YR_HOME, ')</a></p>';
        printf('<h2>%s %s</h2>', _ITEMLIST_BLOG, $this->bloglink($blog));

        // start index
        if (postVar('start')) {
            $start = intPostVar('start');
        } else {
            $start = 0;
        }

        if (0 == $start) {
            printf('<p><a href="index.php?action=createitem&amp;blogid=%s">%s</a></p>', $blogid, _ITEMLIST_ADDNEW);
        }

        // amount of items to show
        if (postVar('amount')) {
            $amount = intPostVar('amount');
        } else {
            $amount = (int) $CONF['DefaultListSize'];
            if ($amount < 1) {
                $amount = 10;
            }
        }

        $search = postVar('search');    // search through items

        $query_view  = 'SELECT bshortname, cname, mname, ititle, ibody, inumber, idraft, itime, bnumber, catid';
        $ph['iblog'] = $blogid;
        $query       = parseQuery(' FROM [@prefix@]item, [@prefix@]blog, [@prefix@]member, [@prefix@]category'
            . ' WHERE iblog=bnumber and iauthor=mnumber and icat=catid and iblog=[@iblog@]', $ph);

        $request_catid = isset($_POST['catid']) ? max(0, (int) $_POST['catid']) : 0;
        if ($request_catid > 0) {
            //  @todo NP_MultipleCategories
            $query .= ' and icat= ' . $request_catid;
        }

        if (postVar('view_item_options')) {
            $v = (string) postVar('view_item_options');
            $query .= $this->getQueryFilterForItemlist01((int) $blogid, $v);
        }

        if ($search) {
            $ph['search'] = sql_quote_string('%' . $search . '%');
            $query .= parseQuery(' AND ( (ititle LIKE [@search@]) OR (ibody LIKE [@search@]) OR (imore LIKE [@search@]) )', $ph);
        }

        // non-blog-admins can only edit/delete their own items
        if ( ! $member->blogAdminRights($blogid)) {
            $query .= ' and iauthor=' . $member->getID();
        }

        $total = (int) quickQuery('SELECT COUNT(*) as result ' . $query);

        $query .= ' ORDER BY idraft ASC, itime DESC, inumber DESC'
            . " LIMIT {$start},{$amount}";

        $query_view .= $query;

        $template['content'] = 'itemlist';
        $template['now']     = $blog->getCorrectTime(time());

        $manager->loadClass("ENCAPSULATE");
        $navList        = new NAVLIST('itemlist', $start, $amount, 0, 1000, $blogid, $search, 0);
        $navList->total = $total;
        $navList->showBatchList('item', $query_view, 'table', $template);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_batchitem()
    {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action   = requestVar('batchaction');

        // Show error when no items were selected
        if ( ! is_array($selected) || 0 == count($selected)) {
            $this->error(_BATCH_NOSELECTION);
        }

        // On move: when no destination blog/category chosen, show choice now
        $destCatid = intRequestVar('destcatid');
        if (('move' == $action) && ( ! $manager->existsCategory($destCatid))) {
            $this->batchMoveSelectDestination('item', $selected);
        }

        // On delete: check if confirmation has been given
        if (('delete' == $action) && ('yes' != requestVar('confirmation'))) {
            $this->batchAskDeleteConfirmation('item', $selected);
        }

        //if ( in_array($action , ['draft', 'public', 'unpublic']) && (requestVar('confirmation') != 'yes'))
        //    $this->batchAskConfirmation('item', $selected, $action, constant( strtoupper('_BATCH_ITEM_'.$action)), _BATCH_CONFIRM);

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACK_YR_HOME,')</a>';
        echo '<h2>', _BATCH_ITEMS, '</h2>';
        echo '<p>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $itemid) {
            $itemid = (int) $itemid;
            echo '<li>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b> ', _BATCH_ONITEM, ' <b>', $itemid, '</b>...';

            // perform action, display errors if needed
            switch ($action) {
                case 'delete':
                    $error = $this->deleteOneItem($itemid);
                    break;
                case 'move':
                    $error = $this->moveOneItem($itemid, $destCatid);
                    break;
                    /*
                    case 'draft':
                        $error = $this->chageDraftOneItem($itemid, 1);
                        break;
                    case 'public':
                        $error = $this->chagePublicOneItem($itemid, 1);
                        break;
                    case 'unpublic':
                        $error = $this->chagePublicOneItem($itemid, 0);
                        break;
                    */
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>', ($error ? $error : _BATCH_SUCCESS), '</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>', _BATCH_DONE, '</b>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_batchcomment()
    {
        global $member;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action   = requestVar('batchaction');

        // Show error when no items were selected
        if ( ! is_array($selected) || 0 == count($selected)) {
            $this->error(_BATCH_NOSELECTION);
        }

        // On delete: check if confirmation has been given
        if (('delete' == $action) && ('yes' != requestVar('confirmation'))) {
            $this->batchAskDeleteConfirmation('comment', $selected);
        }

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACK_YR_HOME,')</a>';
        echo '<h2>', _BATCH_COMMENTS, '</h2>';
        echo '<p>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $commentid) {
            $commentid = (int) $commentid;
            echo '<li>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b> ', _BATCH_ONCOMMENT, ' <b>', $commentid, '</b>...';

            // perform action, display errors if needed
            switch ($action) {
                case 'delete':
                    $error = $this->deleteOneComment($commentid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>', ($error ? $error : _BATCH_SUCCESS), '</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>', _BATCH_DONE, '</b>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_batchmember()
    {
        global $member;

        // check if logged in and admin
        ($member->isLoggedIn() && $member->isAdmin()) or $this->disallow();

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action   = requestVar('batchaction');

        // Show error when no members selected
        if ( ! is_array($selected) || 0 == count($selected)) {
            $this->error(_BATCH_NOSELECTION);
        }

        // On delete: check if confirmation has been given
        if (('delete' == $action) && ('yes' != requestVar('confirmation'))) {
            $this->batchAskDeleteConfirmation('member', $selected);
        }

        $this->pagehead();

        echo '<a href="index.php?action=usermanagement">(', _MEMBERS_BACKTOOVERVIEW, ')</a>';
        echo '<h2>', _BATCH_MEMBERS, '</h2>';
        echo '<p>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = (int) $memberid;
            echo '<li>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b> ', _BATCH_ONMEMBER, ' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch ($action) {
                case 'delete':
                    $error = $this->deleteOneMember($memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    sql_query('UPDATE ' . sql_table('member') . ' SET madmin=1 WHERE mnumber=' . $memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one super-admin
                    $sql = sprintf('SELECT count(*) as result FROM %s WHERE madmin=1 and mcanlogin=1', sql_table('member'));
                    if ((int) quickQuery($sql) < 2) {
                        $error = _ERROR_ATLEASTONEADMIN;
                    } else {
                        sql_query(sprintf("UPDATE %s SET madmin=0 WHERE mnumber=%s", sql_table('member'), $memberid));
                        $error = '';
                    }
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>', ($error ? $error : _BATCH_SUCCESS), '</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>', _BATCH_DONE, '</b>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_batchteam()
    {
        global $member;

        $blogid = intRequestVar('blogid');

        // check if logged in and admin
        ($member->isLoggedIn() && $member->blogAdminRights($blogid)) or $this->disallow();

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action   = requestVar('batchaction');

        // Show error when no members selected
        if ( ! is_array($selected) || 0 == count($selected)) {
            $this->error(_BATCH_NOSELECTION);
        }

        // On delete: check if confirmation has been given
        if (('delete' == $action) && ('yes' != requestVar('confirmation'))) {
            $this->batchAskDeleteConfirmation('team', $selected);
        }

        $this->pagehead();

        echo '<p><a href="index.php?action=manageteam&amp;blogid=', $blogid, '">(', _BACK, ')</a></p>';

        echo '<h2>', _BATCH_TEAM, '</h2>';
        echo '<p>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = (int) $memberid;
            echo '<li>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b> ', _BATCH_ONTEAM, ' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch ($action) {
                case 'delete':
                    $error = $this->deleteOneTeamMember($blogid, $memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    sql_query('UPDATE ' . sql_table('team') . ' SET tadmin=1 WHERE tblog=' . $blogid . ' and tmember=' . $memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one admin
                    $sql = sprintf("SELECT count(*) as result FROM %s WHERE tadmin=1 and tblog=%s", sql_table('team'), $blogid);
                    if ((int) quickQuery($sql) < 2) {
                        $error = _ERROR_ATLEASTONEBLOGADMIN;
                    } else {
                        sql_query('UPDATE ' . sql_table('team') . ' SET tadmin=0 WHERE tblog=' . $blogid . ' and tmember=' . $memberid);
                    }
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>', ($error ? $error : _BATCH_SUCCESS), '</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>', _BATCH_DONE, '</b>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_batchcategory()
    {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action   = requestVar('batchaction');

        // Show error when no items were selected
        if ( ! is_array($selected) || 0 == count($selected)) {
            $this->error(_BATCH_NOSELECTION);
        }

        // On move: when no destination blog chosen, show choice now
        $destBlogId = intRequestVar('destblogid');
        if (('move' == $action) && ( ! $manager->existsBlogID($destBlogId))) {
            $this->batchMoveCategorySelectDestination('category', $selected);
        }

        // On delete: check if confirmation has been given
        if (('delete' == $action) && ('yes' != requestVar('confirmation'))) {
            $this->batchAskDeleteConfirmation('category', $selected);
        }

        if ('change_corder' == $action) {
            if ( ! isset($_POST['new_corder']) || ! is_numeric($_POST['new_corder'])) {
                $this->batchChangeCategorySelectOrder('category', $selected);
            }
        }

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACK_YR_HOME,')</a>';
        echo '<h2>', _BATCH_CATEGORIES, '</h2>';
        echo '<p>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $catid) {
            $catid = (int) $catid;
            echo '<li>', _BATCH_EXECUTING, ' <b>', hsc($action), '</b> ', _BATCH_ONCATEGORY, ' <b>', $catid, '</b>...';

            // perform action, display errors if needed
            switch ($action) {
                case 'delete':
                    $error = $this->deleteOneCategory($catid);
                    break;
                case 'move':
                    $error = $this->moveOneCategory($catid, $destBlogId);
                    break;
                case 'change_corder':
                    $new_corder = intRequestVar('new_corder');
                    $error      = $this->changeOneCategoryOrder($catid, $new_corder);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>', ($error ? _ERROR . ': ' . $error : _BATCH_SUCCESS), '</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>', _BATCH_DONE, '</b>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function batchMoveSelectDestination($type, $ids)
    {
        global $manager;
        $this->pagehead();
        ?>
        <h2><?php echo _MOVE_TITLE; ?></h2>
        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="batch<?php echo $type; ?>" />
                <input type="hidden" name="batchaction" value="move" />
                <?php
                $manager->addTicketHidden();

        // insert selected item numbers
        $idx = 0;
        foreach ($ids as $id) {
            echo '<input type="hidden" name="batch[', ($idx++), ']" value="', (int) $id, '" />';
        }

        // show blog/category selection list
        $this->selectBlogCategory('destcatid');

        ?>


                <input type="submit" value="<?php echo _MOVE_BTN; ?>" onclick="return checkSubmit();" />

            </div>
        </form>
        <?php $this->pagefoot();
        exit;
    }

    /**
     * @todo document this
     */
    public function batchMoveCategorySelectDestination($type, $ids)
    {
        global $manager;
        $this->pagehead();
        ?>
        <h2><?php echo _MOVECAT_TITLE; ?></h2>
        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="batch<?php echo $type; ?>" />
                <input type="hidden" name="batchaction" value="move" />
                <?php
                $manager->addTicketHidden();

        // insert selected item numbers
        $idx = 0;
        foreach ($ids as $id) {
            echo '<input type="hidden" name="batch[', ($idx++), ']" value="', (int) $id, '" />';
        }

        // show blog/category selection list
        $this->selectBlog('destblogid');

        ?>


                <input type="submit" value="<?php echo _MOVECAT_BTN ?>" onclick="return checkSubmit();" />

            </div>
        </form>
        <?php $this->pagefoot();
        exit;
    }

    public function batchChangeCategorySelectOrder($type, $ids)
    {
        global $manager, $member;

        $this->pagehead();

        if (isDebugMode()) {
            echo "<!-- " . __CLASS__ . '::' . __FUNCTION__ . "  -->\n";
            //var_dump($ids);
        }
        ?>
        <h2><?php echo _CAHANGE_CATEGORY_ORDER_TITLE ?></h2>
        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="batch<?php echo $type ?>" />
                <input type="hidden" name="batchaction" value="change_corder" />
                <?php
                $manager->addTicketHidden();

        // insert selected Category numbers
        $idx = 0;
        foreach ($ids as $id) {
            echo '<input type="hidden" name="batch[', ($idx++), ']" value="', (int) $id, '" />';
        }

        $def_oder = 100;
        if (isset($ids[0]) && ((int) $ids[0] > 0)) {
            $ids[0] = (int) $ids[0];
            // $manager->existsCategory
            $bid = getBlogIDFromCatID($ids[0]);
            if ($member->blogAdminRights($bid)) {
                $b        = $manager->getBlog($bid);
                $def_oder = $b->getCategoryOrder($ids[0]);
            }
        }
        echo sprintf('<input type="text" name="new_corder" value="%d" />', $def_oder);

        ?>
                <input type="submit" value="<?php echo _CAHANGE_CATEGORY_ORDER_BTN_TITLE ?>" onclick="return checkSubmit();" />

            </div>
        </form>
        <?php
        $s = '';

        if (isset($b)) {
            unset($b);
        }
        foreach ($ids as $id) {
            $bid = getBlogIDFromCatID($id);
            if ($member->blogAdminRights($bid)) {
                $b = $manager->getBlog($bid);

                $res = sql_query(sprintf("SELECT * FROM %s WHERE cblog=%s and catid=%s", sql_table('category'), $bid, (int) $id));
                $o   = sql_fetch_object($res);
                if (isset($o) && is_object($o)) {
                    $s .= sprintf(
                        '<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                        hsc($o->corder),
                        hsc($o->cname),
                        hsc($o->cdesc)
                    );
                    continue;
                }
                unset($b, $o);
            }
            $s .= sprintf('<tr><td>error</td><td>catid:%d</td><td></td></tr>', $id);
        }
        if ($s) {
            echo "<p>" . _CAHANGE_CATEGORY_ORDER_CONFIRM_DESC . "</p>\n";
            echo "<table>"
                . sprintf(
                    '<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                    hsc(_LISTS_ORDER),
                    hsc(_LISTS_NAME),
                    hsc(_LISTS_DESC)
                )
                . $s . "</table>\n";
        }

        $this->pagefoot();

        exit;
    }

    /**
     * @todo document this
     */
    public function batchAskDeleteConfirmation($type, $ids)
    {
        global $manager;

        $this->pagehead();
        ?>
        <h2><?php echo _BATCH_DELETE_CONFIRM; ?></h2>
        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="batch<?php echo $type; ?>" />
                <?php $manager->addTicketHidden(); ?>
                <input type="hidden" name="batchaction" value="delete" />
                <input type="hidden" name="confirmation" value="yes" />
                <?php
        // insert selected item numbers
        $idx = 0;
        foreach ($ids as $id) {
            echo '<input type="hidden" name="batch[', ($idx++), ']" value="', (int) $id, '" />';
        }

        // add hidden vars for team & comment
        if ('team' == $type) {
            echo '<input type="hidden" name="blogid" value="', intRequestVar('blogid'), '" />';
        }
        if ('comment' == $type) {
            echo '<input type="hidden" name="itemid" value="', intRequestVar('itemid'), '" />';
        }

        ?>
                <input type="submit" value="<?php echo _BATCH_DELETE_CONFIRM_BTN ?>" onclick="return checkSubmit(this);" />
            </div>
        </form>
        <?php
        $this->pagefoot();
        exit;
    }

    public function batchAskConfirmation($batchtype, $ids, $batchaction, $title, $title_confirm_btn)
    {
        global $manager;

        $this->pagehead();
        $type = $batchtype;
        ?>
        <h2><?php echo $title; ?></h2>
        <form method="post" action="index.php">
           <div>
                <input type="hidden" name="action" value="batch<?php echo $type; ?>" />
                <?php $manager->addTicketHidden(); ?>
                <input type="hidden" name="batchaction" value="<?php echo $batchaction; ?>" />
                <input type="hidden" name="confirmation" value="yes" />
                <?php
        // insert selected item numbers
        $idx = 0;
        foreach ($ids as $id) {
            echo '<input type="hidden" name="batch[', ($idx++), ']" value="', (int) $id, '" />';
        }

        // add hidden vars for team & comment
        if ('team' == $type) {
            echo '<input type="hidden" name="blogid" value="', intRequestVar('blogid'), '" />';
        }
        if ('comment' == $type) {
            echo '<input type="hidden" name="itemid" value="', intRequestVar('itemid'), '" />';
        }

        ?>
                <input type="submit" value="<?php echo $title_confirm_btn; ?>" onclick="return checkSubmit(this);" />
            </div>
        </form>
        <?php
        $this->pagefoot();
        exit;
    }

    /**
     * Inserts a HTML select element with choices for all categories to which
     * the current member has access
     *
     * @see function selectBlog
     */
    public static function selectBlogCategory($name, $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1)
    {
        ADMIN::selectBlog($name, 'category', $selected, $tabindex, $showNewCat, $iForcedBlogInclude);
    }

    /**
     * Inserts a HTML select element with choices for all blogs to which the
     * user has access mode = 'blog' => shows blognames and values are blogids
     * mode = 'category' => show category names and values are catids
     *
     * @param $iForcedBlogInclude
     *                            ID of a blog that always needs to be included, without checking if
     *                            the member is on the blog team (-1 = none)
     *
     * @todo document parameters
     */
    public static function selectBlog($name, $mode = 'blog', $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1)
    {
        global $member, $CONF;

        // 0. get IDs of blogs to which member can post items (+ forced blog)
        $aBlogIds = [];
        if (-1 != $iForcedBlogInclude) {
            $aBlogIds[] = (int) $iForcedBlogInclude;
        }

        if (($member->isAdmin()) && (array_key_exists('ShowAllBlogs', $CONF) && $CONF['ShowAllBlogs'])) {
            $queryBlogs = sprintf("SELECT bnumber FROM %s ORDER BY bname", sql_table('blog'));
        } else {
            $queryBlogs = sprintf("SELECT bnumber FROM %s, %s WHERE tblog=bnumber and tmember=%s", sql_table('blog'), sql_table('team'), $member->getID());
        }
        $rblogids = sql_query($queryBlogs);
        while ($o = sql_fetch_object($rblogids)) {
            if ($o->bnumber != $iForcedBlogInclude) {
                $aBlogIds[] = (int) $o->bnumber;
            }
        }

        if (0 == count($aBlogIds)) {
            return;
        }

        echo '<select name="', $name, '" tabindex="', $tabindex, '">';

        // 1. select blogs (we'll create optiongroups)
        // (only select those blogs that have the user on the team)
        $queryBlogs       = sprintf("%s WHERE bnumber in (%s) ORDER BY bname", sql_table('blog'), implode(',', $aBlogIds));
        $queryBlogs_count = sprintf("SELECT count(*) as result FROM %s", $queryBlogs);
        $queryBlogs       = sprintf("SELECT bnumber, bname FROM %s", $queryBlogs);
        $blogs            = sql_query($queryBlogs);
        if ('category' == $mode) {
            $multipleBlogs = (int) quickQuery($queryBlogs_count) > 1;

            while ($oBlog = sql_fetch_object($blogs)) {
                if ($multipleBlogs) {
                    echo '<optgroup label="', hsc($oBlog->bname), '">';
                }

                // show selection to create new category when allowed/wanted
                if ($showNewCat) {
                    // check if allowed to do so
                    if ($member->blogAdminRights($oBlog->bnumber)) {
                        echo '<option value="newcat-', $oBlog->bnumber, '">', _ADD_NEWCAT, '</option>';
                    }
                }

                // 2. for each category in that blog
                $categories = sql_query(sprintf("SELECT cname, catid FROM %s WHERE cblog=%s ORDER BY corder ASC, cname ASC", sql_table('category'), $oBlog->bnumber));
                while ($oCat = sql_fetch_object($categories)) {
                    if ($oCat->catid == $selected) {
                        $selectText = ' selected="selected" ';
                    } else {
                        $selectText = '';
                    }
                    echo '<option value="', $oCat->catid, '" ', $selectText, '>', hsc($oCat->cname), '</option>';
                }

                if ($multipleBlogs) {
                    echo '</optgroup>';
                }
            }
        } else {
            // blog mode
            while ($oBlog = sql_fetch_object($blogs)) {
                echo '<option value="', $oBlog->bnumber, '"';
                if ($oBlog->bnumber == $selected) {
                    echo ' selected="selected"';
                }
                echo '>', hsc($oBlog->bname), '</option>';
            }
        }
        echo '</select>';
    }

    /**
     * @todo document this
     */
    public function action_browseownitems()
    {
        global $member, $manager, $CONF;

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';
        echo '<h2>' . _ITEMLIST_YOUR . '</h2>';

        // start index
        if (postVar('start')) {
            $start = intPostVar('start');
        } else {
            $start = 0;
        }

        // amount of items to show
        if (postVar('amount')) {
            $amount = intPostVar('amount');
        } else {
            $amount = (int) $CONF['DefaultListSize'];
            if ($amount < 1) {
                $amount = 10;
            }
        }

        $search = postVar('search');    // search through items

        $query_view    = 'SELECT bshortname, cname, mname, ititle, ibody, idraft, inumber, itime';
        $ph['iauthor'] = $member->getID();
        $query         = parseQuery(' FROM [@prefix@]item, [@prefix@]blog, [@prefix@]member, [@prefix@]category'
            . ' WHERE iauthor=[@iauthor@] and iauthor=mnumber and iblog=bnumber and icat=catid', $ph);

        if (postVar('view_item_options')) {
            $v = (string) postVar('view_item_options');
            $query .= $this->getQueryFilterForItemlist01(0, $v);
        }

        $request_catid = isset($_POST['catid']) ? max(0, (int) $_POST['catid']) : 0;
        if ($request_catid > 0) {
            $query .= ' and icat= ' . $request_catid;
        }

        if ($search) {
            $ph           = [];
            $ph['search'] = sql_quote_string('%' . $search . '%');
            $query .= parseQuery(' and ((ititle LIKE [@search@]) or (ibody LIKE [@search@]) or (imore LIKE [@search@]))', $ph);
        }

        $total = (int) quickQuery('SELECT COUNT(*) as result ' . $query);

        $query .= ' ORDER BY idraft ASC, itime DESC, inumber DESC'
            . " LIMIT {$start},{$amount}";

        $query_view .= $query;

        $template['content'] = 'itemlist';
        $template['now']     = time();

        $manager->loadClass("ENCAPSULATE");
        $navList        = new NAVLIST('browseownitems', $start, $amount, 0, 1000, /*$blogid*/ 0, $search, 0);
        $navList->total = $total;
        $navList->showBatchList('item', $query_view, 'table', $template);

        $this->pagefoot();
    }

    /**
     * Show all the comments for a given item
     *
     * @param int $itemid
     */
    public function action_itemcommentlist($itemid = '')
    {
        global $member, $manager, $CONF;

        if ('' == $itemid) {
            $itemid = intRequestVar('itemid');
        }

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $blogid = getBlogIdFromItemId($itemid);

        $this->pagehead();

        // start index
        if (postVar('start')) {
            $start = intPostVar('start');
        } else {
            $start = 0;
        }

        // amount of items to show
        if (postVar('amount')) {
            $amount = intPostVar('amount');
        } else {
            $amount = (int) $CONF['DefaultListSize'];
            if ($amount < 1) {
                $amount = 10;
            }
        }

        echo sprintf(
            '<p>(<a href="index.php?action=itemlist&amp;blogid=%s">%s</a> | ' .
                '<a href="index.php?action=blogcommentlist&amp;blogid=%s">%s</a>)</p>',
            $blogid,
            hsc(_BACKTOOVERVIEW),
            $blogid,
            hsc(sprintf(_LIST_BACK_TO, _LIST_COMMENT_LIST_FOR_BLOG))
        );

        echo '<h2>', _LIST_COMMENT_LIST_FOR_ITEM, '</h2>';

        $item = &$manager->getItem($itemid, true, true);
        echo "<div>";
        echo _LIST_ITEM_CONTENT . ' : ';
        echo sprintf(
            "<a href='%s#c' title='%s'><img src='images/globe.gif' width='13' height='13' style='vertical-align:middle;' /></a> %s</div>",
            createItemLink($itemid),
            htmlentities(_LIST_COMMENT_VIEW_ITEM, ENT_COMPAT, _CHARSET),
            hsc(shorten($item["title"], 100, '...'))
        );
        echo sprintf(
            "<div style=' margin-left: 20px; padding: 5px'>%s</div>",
            hsc(shorten(strip_tags($item["body"]), 100, '...')) . '<br />'
        );

        $search = postVar('search');

        echo '<h2>', _COMMENTS, '</h2>';

        $query_view = 'SELECT cbody, cuser, cmail, cemail, mname, ctime, chost, cnumber, cip, citem';
        $query      = sprintf(" FROM %s LEFT OUTER JOIN %s ON mnumber = cmember WHERE citem = %d", sql_table('comment'), sql_table('member'), $itemid);

        if ($search) {
            $query .= ' and cbody LIKE ' . sql_quote_string('%' . $search . '%');
        }

        $total = (int) quickQuery('SELECT COUNT(*) as result ' . $query);

        $query .= ' ORDER BY ctime ASC'
            . " LIMIT {$start},{$amount}";

        $query_view .= $query;

        $template['content']   = 'commentlist';
        $template['canAddBan'] = $member->blogAdminRights(getBlogIDFromItemID($itemid));

        $manager->loadClass("ENCAPSULATE");
        $navList        = new NAVLIST('itemcommentlist', $start, $amount, 0, 1000, 0, $search, $itemid);
        $navList->total = $total;
        $navList->showBatchList('comment', $query_view, 'table', $template, _NOCOMMENTS);

        $this->pagefoot();
    }

    /**
     * Browse own comments
     */
    public function action_browseowncomments()
    {
        global $member, $manager, $CONF;

        // start index
        if (postVar('start')) {
            $start = intPostVar('start');
        } else {
            $start = 0;
        }

        // amount of items to show
        if (postVar('amount')) {
            $amount = intPostVar('amount');
        } else {
            $amount = (int) $CONF['DefaultListSize'];
            if ($amount < 1) {
                $amount = 10;
            }
        }

        $search = postVar('search');

        $ph['cmember'] = $member->getID();
        $query         = parseQuery(' FROM [@prefix@]comment LEFT OUTER JOIN [@prefix@]member ON mnumber=cmember WHERE cmember=[@cmember@]', $ph);

        if ($search) {
            $query .= ' and cbody LIKE ' . sql_quote_string('%' . $search . '%');
        }

        $total = (int) quickQuery('SELECT COUNT(*) as result ' . $query);

        $query .= ' ORDER BY ctime DESC'
            . " LIMIT {$start},{$amount}";

        $query_view = 'SELECT cbody, cuser, cmail, mname, ctime, chost, cnumber, cip, citem';
        $query_view .= $query;

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';
        echo '<h2>', _COMMENTS_YOUR, '</h2>';

        $template['content']   = 'commentlist';
        $template['canAddBan'] = 0; // doesn't make sense to allow banning yourself

        $manager->loadClass("ENCAPSULATE");
        $navList        = new NAVLIST('browseowncomments', $start, $amount, 0, 1000, 0, $search, 0);
        $navList->total = $total;
        $navList->showBatchList('comment', $query_view, 'table', $template, _NOCOMMENTS_YOUR);

        $this->pagefoot();
    }

    /**
     * Browse all comments for a weblog
     *
     * @param int $blogid
     */
    public function action_blogcommentlist($blogid = '')
    {
        global $member, $manager, $CONF;

        if ('' == $blogid) {
            $blogid = intRequestVar('blogid');
        } else {
            $blogid = (int) $blogid;
        }

        $member->teamRights($blogid) or $member->isAdmin() or $this->disallow();

        // start index
        if (postVar('start')) {
            $start = intPostVar('start');
        } else {
            $start = 0;
        }

        // amount of items to show
        if (postVar('amount')) {
            $amount = intPostVar('amount');
        } else {
            $amount = (int) $CONF['DefaultListSize'];
            if ($amount < 1) {
                $amount = 10;
            }
        }

        $search = postVar('search');        // search through comments

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';

        printf('<h2>%s</h2>', _LIST_COMMENT_LIST_FOR_BLOG);

        if ($member->isAdmin() || $member->isBlogAdmin($blogid)) {
            $query_view = 'SELECT cbody, cuser, cemail, cmail, mname, ctime, chost, cnumber, cip, citem';
            $query      = sprintf(" FROM %s LEFT OUTER JOIN %s ON mnumber=cmember", sql_table('comment'), sql_table('member'));
        } else {
            $query_view = 'SELECT cbody, cuser, cemail, cmail, mname, ctime, chost, cnumber, cip, citem, cmember, iauthor, 0 as is_badmin';
            $query      = sprintf(" FROM %s LEFT OUTER JOIN %s ON mnumber=cmember LEFT OUTER JOIN %s  ON citem=inumber ", sql_table('comment'), sql_table('member'), sql_table('item'));
        }
        $query .= ' WHERE cblog=' . (int) $blogid;

        if ('' != $search) {
            $query .= ' and cbody LIKE ' . sql_quote_string('%' . $search . '%');
        }

        $total = (int) quickQuery('SELECT COUNT(*) as result ' . $query);

        $query .= ' ORDER BY ctime DESC'
            . " LIMIT {$start},{$amount}";

        $query_view .= $query;

        $blog = &$manager->getBlog($blogid);

        echo '<h2>', _COMMENTS_BLOG, ' ', $this->bloglink($blog), '</h2>';

        $template['content']   = 'commentlist';
        $template['canAddBan'] = $member->blogAdminRights($blogid);

        $manager->loadClass("ENCAPSULATE");
        $navList        = new NAVLIST('blogcommentlist', $start, $amount, 0, 1000, $blogid, $search, 0);
        $navList->total = $total;
        $navList->showBatchList('comment', $query_view, 'table', $template, _NOCOMMENTS_BLOG);

        $this->pagefoot();
    }

    /**
     * Provide a page to item a new item to the given blog
     */
    public function action_createitem()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->teamRights($blogid) or $this->disallow();

        $memberid = $member->getID();

        $blog = &$manager->getBlog($blogid);

        $this->pagehead();

        // generate the add-item form
        $formfactory = new PAGEFACTORY($blogid);
        $formfactory->createAddForm('admin');

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_itemedit()
    {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $item = &$manager->getItemEx($itemid, 1, 1, 0);
        if (empty($item)) {
            $this->error(_ERROR_NOSUCHITEM);
        }
        $blog = &$manager->getBlog(getBlogIDFromItemID($itemid));

        $param = ['item' => &$item];
        $manager->notify('PrepareItemForEdit', $param);

        // deprecated ?
        if ($blog->convertBreaks() && ! CONF::asStr('wysiwyg', '')) {
            $item['body'] = removeBreaks($item['body']);
            $item['more'] = removeBreaks($item['more']);
        }

        // form to edit blog items
        $this->pagehead();
        $formfactory = new PAGEFACTORY($blog->getID());
        $formfactory->createEditForm('admin', $item);
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_itemupdate()
    {
        global $member, $manager, $CONF;

        $itemid = intRequestVar('itemid');
        $catid  = postVar('catid');

        // only allow if user is allowed to alter item
        $member->canUpdateItem($itemid, $catid) or $this->disallow();

        $actiontype = postVar('actiontype');

        // delete actions are handled by itemdelete (which has confirmation)
        if ('delete' == $actiontype) {
            $this->action_itemdelete();
            return;
        }

        $body    = postVar('body');
        $title   = postVar('title');
        $more    = postVar('more');
        $closed  = intPostVar('closed');
        $draftid = intPostVar('draftid');

        $act_state = postVar('act_state'); // unsafe value
        $ipublic   = ('public' == $act_state ? 1 : 0);
        $idraft    = ('draft' == $act_state ? 1 : 0);

        if ($idraft || 'adddraft' == $actiontype || 'backtodrafts' == $actiontype) {
            $actiontype = 'adddraft';
            $idraft     = 1;
            $ipublic    = 0;
        }

        $blog = $manager->getBlog($itemid);

        $update_options = ['extraColValue' => []];
        // value for public
        $update_options['extraColValue']['ipublic']                   = $ipublic;
        $update_options['extraColValue']['ipublic_enable_term_start'] = (intPostVar('public_enable_term_start') ? 1 : 0);
        $update_options['extraColValue']['ipublic_enable_term_end']   = (intPostVar('public_enable_term_end') ? 1 : 0);
        foreach (['start', 'end'] as $section) {
            /*
            *  MySQL retrieves and displays DATE values in 'YYYY-MM-DD' format. The supported range is '1000-01-01' to '9999-12-31'.
           *  TIMESTAMP has a range of '1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC.
             */
            $y  = min(9999, max(0, intPostVar('year_public_term_' . $section)));
            $mo = min(99, max(0, intPostVar('month_public_term_' . $section)));
            $d  = min(99, max(0, intPostVar('day_public_term_' . $section)));
            $h  = min(99, max(0, intPostVar('hour_public_term_' . $section)));
            $mi = min(99, max(0, intPostVar('minute_public_term_' . $section)));
            if ($y < 2000) {
                $y  = 2000;
                $mo = $d = 1;
                $h  = $mi = 0;
            }
            $update_options['extraColValue']['ipublic_term_' . $section] = sprintf("%04d-%02d-%02d %02d:%02d:00", $y, $mo, $d, $h, $mi);
        }

        // default action = add now
        if ( ! $actiontype) {
            $actiontype = 'addnow';
        }

        // create new category if needed
        if (strstr($catid, 'newcat')) {
            // get blogid
            [$blogid] = sscanf($catid, "newcat-%d");

            // create
            $blog  = &$manager->getBlog($blogid);
            $catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if ( ! $catid) {
                $this->doError(_ERROR_CATCREATEFAIL);
            }
        }

        /*
            set some variables based on actiontype

            actiontypes:
                draft items -> addnow, addfuture, adddraft, delete
                non-draft items -> edit, changedate, delete

            variables set:
                $timestamp: set to a nonzero value for future dates or date changes
                $wasdraft: set to 1 when the item used to be a draft item
                $publish: set to 1 when the edited item is not a draft
        */
        $blogid = getBlogIDFromItemID($itemid);
        $blog   = &$manager->getBlog($blogid);

        $wasdrafts = ['adddraft', 'addfuture', 'addnow'];
        $wasdraft  = in_array($actiontype, $wasdrafts) ? 1 : 0;
        $publish   = ('adddraft' != $actiontype && 'backtodrafts' != $actiontype) ? 1 : 0;
        if ('addfuture' == $actiontype || 'changedate' == $actiontype) {
            $timestamp = mktime(intPostVar('hour'), intPostVar('minutes'), 0, intPostVar('month'), intPostVar('day'), intPostVar('year'));
        } else {
            $timestamp = 0;
        }

        // edit the item for real
        ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp, $update_options);

        $this->updateFuturePosted($blogid);

        if ($draftid > 0) {
            // delete permission is checked inside ITEM::delete()
            ITEM::delete($draftid);
        }

        // show category edit window when we created a new category
        // ($catid will then be a new category ID, while postVar('catid') will be 'newcat-x')
        if ($catid != intPostVar('catid')) {
            $this->action_categoryedit(
                $catid,
                $blog->getID(),
                $CONF['AdminURL'] . 'index.php?action=itemlist&blogid=' . getBlogIDFromItemID($itemid)
            );
        } else {
            // page select : Page to display after saving the item
            $select_page_after_save = $member->getOption('item', 'select_page_after_save', '');
            switch ($select_page_after_save) {
                case 'back_home' :
                    $url_redirect = $CONF['AdminURL'] . '?action=overview';
                    break;
                case 'list' :
                    $url_redirect = $CONF['AdminURL'] . '?action=itemlist&blogid=' . $blogid;
                    break;
                case 'list_with_category' :
                    // list : Filter by the same category as item
                    $this->action_itemlist(getBlogIDFromItemID($itemid));
                    exit;
                    break;
                default:
                    $url_redirect = $CONF['AdminURL'] . '?action=itemedit&itemid=' . $itemid; // back to itemedit
                    break;
            }
            redirect($url_redirect);
            exit;
        }
    }

    /**
     * @todo document this
     */
    public function action_itemdelete()
    {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        if ( ! $manager->existsItem($itemid, 1, 1)) {
            $this->error(_ERROR_NOSUCHITEM);
        }

        $item  = &$manager->getItemEx($itemid, 1, 1, 0);
        $title = hsc(strip_tags($item['title']));
        $body  = strip_tags($item['body']);
        $body  = hsc(shorten($body, 300, '...'));

        $this->pagehead();
        ?>
        <h2><?php echo _DELETE_CONFIRM ?></h2>

        <p><?php echo _CONFIRMTXT_ITEM ?></p>

        <div>
            <div class="note">
                <b>"<?php echo  $title ?>"</b>
                <br />
                <?php echo $body ?>
            </div>
        </div>
        <div>
            <form method="post" action="index.php">
                <input type="hidden" name="action" value="itemdeleteconfirm" />
                <?php $manager->addTicketHidden(); ?>
                <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
                <div class="confirm">
                    <input type="submit" value="<?php echo _ADMIN_TEXT_BTN_EXECUTE ?>" tabindex="10" />
                </div>
            </form>
            <div class="confirm">
                <input type="button" onclick="history.back();" value="<?php echo _ADMIN_TEXT_BTN_CANCEL ?>">
            </div>
        </div>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_itemdeleteconfirm()
    {
        global $member;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        // get blogid first
        $blogid = getBlogIdFromItemId($itemid);

        // delete item (note: some checks will be performed twice)
        $this->deleteOneItem($itemid);

        $this->action_itemlist($blogid);
    }

    /**
     * Deletes one item and returns error if something goes wrong
     *
     * @param int $itemid
     */
    public function deleteOneItem($itemid)
    {
        global $member, $manager;

        // only allow if user is allowed to alter item (also checks if itemid exists)
        if ( ! $member->canAlterItem($itemid)) {
            return _ERROR_DISALLOWED;
        }

        // need to get blogid before the item is deleted
        $blogid = getBlogIDFromItemId($itemid);

        $manager->loadClass('ITEM');
        ITEM::delete($itemid);

        // update blog's futureposted
        $this->updateFuturePosted($blogid);
    }

    /**
     * Update a blog's future posted flag
     *
     * @param int $blogid
     */
    public function updateFuturePosted($blogid)
    {
        global $manager;

        $blog        = &$manager->getBlog($blogid);
        $currenttime = $blog->getCorrectTime(time());

        $result = sql_query(sprintf("SELECT count(*) FROM %s WHERE iblog='%d' AND iposted=0 AND itime>%s limit 1", sql_table('item'), $blogid, mysqldate($currenttime)));
        if ($result && ((int) sql_result($result) > 0)) {
            $blog->setFuturePost();
        } else {
            $blog->clearFuturePost();
        }
    }

    /**
     * @todo document this
     */
    public function action_itemmove()
    {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $item = &$manager->getItemEx($itemid, 1, 1, 0);

        $this->pagehead();
        ?>
        <h2><?php echo _MOVE_TITLE ?></h2>
        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="itemmoveto" />
                <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />

                <?php

                $manager->addTicketHidden();
        $this->selectBlogCategory('catid', $item['catid'], 10, 1);
        ?>

                <input type="submit" value="<?php echo _MOVE_BTN ?>" tabindex="10000" onclick="return checkSubmit();" />
            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    public function action_itemclone()
    {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        $itemid = intRequestVar('itemid');
        $member->canCloneItem($itemid) or $this->disallow();

        $idata = ITEM::getItemEx($itemid, 1, 1, 0);

        $this->pagehead();
        ?>
            <h2><?php echo _ADMIN_ITEMCLONE_TEXT1 ?></h2>

            <div><p><?php echo _ADMIN_ITEMCLONE_TEXT2 ?></p>
                <div class="note">
                    itemid: <b><?php echo  escapeHTML($idata['itemid'])?></b><br>
                    <?php echo _ADMIN_ITEMCLONE_TEXT_DATETIME ?>: <b><?php echo  escapeHTML($idata['itime'])?></b><br>
                    <?php echo _ADMIN_ITEMCLONE_TEXT_TITLE ?>: <b><?php echo  escapeHTML($idata['title'])?></b><br>
                    <?php echo _ADMIN_ITEMCLONE_TEXT_BODY ?>: <b><?php echo escapeHTML(shorten(strip_tags($idata['body']), 200, '...')); ?></b>
                </div>
            </div>

            <form method="post" action="index.php">
                <div>
                    <input type="hidden" name="action" value="itemcloneconfirm">
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>"><br>
                    <div  class="confirm">
                        <input type="submit" tabindex="10" value="<?php echo _ADMIN_ITEMCLONE_TEXT_EXECUTE ?>">
                    </div>
                </div>
            </form>
            <div class="confirm">
                <input type="button" onclick="history.back();" value="<?php echo _ADMIN_TEXT_BTN_CANCEL ?>">
            </div>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_itemcloneconfirm()
    {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        $itemid   = intRequestVar('itemid');
        $tbl_item = sql_table('item');

        // only allow if user have valid clone privileges
        $member->canCloneItem($itemid) or $this->disallow();

        // Todo: notify event, option
        //        ITEM::cloneItem($itemid);

        $dist    = 'ititle,ibody,imore,iblog,iauthor,itime,iclosed,idraft,ikarmapos,icat,ikarmaneg,iposted';
        $src     = "ititle,ibody,imore,iblog,iauthor,itime,iclosed,'1' AS idraft,ikarmapos,icat,ikarmaneg,iposted";
        $inumber = (int) $itemid;
        $query   = "INSERT INTO `{$tbl_item}` ({$dist}) SELECT {$src} FROM `{$tbl_item}` WHERE inumber={$inumber}";

        try {
            if (sql_query($query)) {
                $new_itemid = sql_insert_id();
                $this->doNotifyCloneItem($new_itemid);
            }
        } finally {
            // get blogid first
            $blogid = getBlogIdFromItemId($itemid);
            $this->action_itemlist($blogid);
        }
    }

    private function doNotifyCloneItem($itemid)
    {
        global $manager;
        // PostCloneItem
        //        $notify_data = array(
        //            'itemid'           => (int) $itemid,
        //            'is_same_category' => TRUE
        //        );
        //        $manager->notify('PostCloneItem', $notify_data);

        // PostAddItem
        $notify_data = [
            'itemid' => (int) $itemid,
        ];
        $manager->notify('PostAddItem', $notify_data);
    }

    /**
     * @todo document this
     */
    public function action_itemmoveto()
    {
        global $member, $manager;

        $itemid = intRequestVar('itemid');
        $catid  = requestVar('catid');

        // create new category if needed
        if (strstr($catid, 'newcat')) {
            // get blogid
            [$blogid] = sscanf($catid, 'newcat-%d');

            // create
            $blog  = &$manager->getBlog($blogid);
            $catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if ( ! $catid) {
                $this->doError(_ERROR_CATCREATEFAIL);
            }
        }

        // only allow if user is allowed to alter item
        $member->canUpdateItem($itemid, $catid) or $this->disallow();

        $old_blogid = getBlogIDFromItemId($itemid);

        ITEM::move($itemid, $catid);

        // set the futurePosted flag on the blog
        $this->updateFuturePosted(getBlogIDFromItemId($itemid));

        // reset the futurePosted in case the item is moved from one blog to another
        $this->updateFuturePosted($old_blogid);

        if ($catid != intRequestVar('catid')) {
            $this->action_categoryedit($catid, $blog->getID());
        } else {
            $this->action_itemlist(getBlogIDFromCatID($catid));
        }
    }

    /**
     * Moves one item to a given category (category existance should be checked
     * by caller) errors are returned
     *
     * @param int $itemid
     * @param int $destCatid category ID to which the item will be moved
     */
    public function moveOneItem($itemid, $destCatid)
    {
        global $member;

        // only allow if user is allowed to move item
        if ( ! $member->canUpdateItem($itemid, $destCatid)) {
            return _ERROR_DISALLOWED;
        }

        ITEM::move($itemid, $destCatid);
    }

    public function chageDraftOneItem($itemid, $draft = true)
    {
        global $member, $manager;

        // item does not exists -> NOK
        if ( ! $manager->existsItem($itemid, 1, 1)) {
            return _ERROR_DISALLOWED;
        }

        // cannot alter item -> NOK
        if ( ! $member->canAlterItem($itemid)) {
            return _ERROR_DISALLOWED;
        }

        $sql = sprintf("UPDATE `%s` SET idraft=1 , ipublic=0 WHERE inumber=%d", sql_table('item'), $itemid);
        sql_query($sql);
    }

    public function chagePublicOneItem($itemid, $public)
    {
        global $member, $manager;

        // item does not exists -> NOK
        if ( ! $manager->existsItem($itemid, 1, 1)) {
            return _ERROR_DISALLOWED;
        }

        // cannot alter item -> NOK
        if ( ! $member->canAlterItem($itemid)) {
            return _ERROR_DISALLOWED;
        }
        // ipublic idraft
        $sql = sprintf("UPDATE `%s` SET ipublic=%d ", sql_table('item'), ($public ? 1 : 0));
        $sql .= sprintf(" WHERE inumber=%d", $itemid);
        sql_query($sql);
    }

    /**
     * Adds a item to the chosen blog
     */
    public function action_additem()
    {
        global $manager, $CONF;

        $manager->loadClass('ITEM');

        $result = ITEM::createFromRequest();

        if ('error' == $result['status']) {
            $this->error($result['message']);
        } elseif ( ! isset($result['itemid']) || 0 == $result['itemid']) {
            $msg = sprintf('Unknown error occurred at Line[%d]: status[%s] itemid[%d] message[%s]', __LINE__, @$result['status'], @$result['itemid'], @$result['message']);
            $this->error($msg);
        }

        $blogid     = getBlogIDFromItemID($result['itemid']);
        $blog       = &$manager->getBlog($blogid);
        $btimestamp = $blog->getCorrectTime();
        $item       = $manager->getItemEx((int) $result['itemid'], 1, 1, 0);

        if ('newcategory' == $result['status']) {
            $distURI = $manager->addTicketToUrl($CONF['AdminURL'] . 'index.php?action=itemList&blogid=' . (int) $blogid);
            $this->action_categoryedit($result['catid'], $blogid, $distURI);
        } else {
            $methodName = 'action_itemList';
            call_user_func([$this, $methodName], $blogid);
        }
    }

    /**
     * Allows to edit previously made comments
     */
    public function action_commentedit()
    {
        global $member, $manager;

        $commentid = intRequestVar('commentid');

        $member->canAlterComment($commentid) or $this->disallow();

        $comment = COMMENT::getComment($commentid);

        $param = ['comment' => &$comment];
        $manager->notify('PrepareCommentForEdit', $param);

        // change <br /> to \n
        $comment['body'] = str_replace('<br />', '', $comment['body']);

        $comment['body'] = preg_replace('#<a href=[\'"]([^\'"]+)[\'"]( rel="nofollow")?>[^<]*</a>#i', "\\1", $comment['body']);

        $params = [
            'comment' => $comment,
            'date'    => date("Y-m-d @ H:i", $comment['timestamp']),
            'manager' => $manager,
        ];

        $this->pagehead();

        echo \parseBlade('admin.action_commentedit', $params), "\n";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_commentupdate()
    {
        global $member, $manager;

        $commentid = intRequestVar('commentid');

        $member->canAlterComment($commentid) or $this->disallow();

        $url   = postVar('url');
        $email = postVar('email');
        $body  = postVar('body');

        # important note that '\' must be matched with '\\\\' in preg* expressions
        // intercept words that are too long
        if (false != preg_match('#[a-zA-Z0-9|\.,;:!\?=\/\\\\]{90,90}#', $body)) {
            $this->error(_ERROR_COMMENT_LONGWORD);
        }

        // check length
        if (strlen($body) < 3) {
            $this->error(_ERROR_COMMENT_NOCOMMENT);
        }
        if (strlen($body) > 5000) {
            $this->error(_ERROR_COMMENT_TOOLONG);
        }

        // prepare body
        $body = COMMENT::prepareBody($body);

        // call plugins
        $param = ['body' => &$body];
        $manager->notify('PreUpdateComment', $param);

        $db_params = [
                ':cmail'   => $url,
                ':cemail'  => $email,
                ':cbody'   => $body,
                ':cnumber' => $commentid,
            ];
        $sql = sprintf('UPDATE `%s`', sql_table('comment'))
               . ' SET cmail = :cmail, cemail = :cemail, cbody = :cbody'
               . ' WHERE cnumber=:cnumber';
        sql_prepare_execute($sql, $db_params);

        // get itemid
        $sql = sprintf('SELECT citem FROM `%s`', sql_table('comment'))
             . ' WHERE cnumber=?';
        $res    = sql_prepare_execute($sql, [ $commentid ]);
        $o      = sql_fetch_object($res);
        $itemid = $o?->citem ?? false;

        if ($itemid && $member->canAlterItem($itemid)) {
            $this->action_itemcommentlist($itemid);
        } else {
            $this->action_browseowncomments();
        }
    }

    /**
     * @todo document this
     */
    public function action_commentdelete()
    {
        global $member, $manager;

        $commentid = intRequestVar('commentid');

        $member->canAlterComment($commentid) or $this->disallow();

        $comment = COMMENT::getComment($commentid);

        $body = strip_tags($comment['body']);
        $body = hsc(shorten($body, 300, '...'));

        if ($comment['member']) {
            $author = $comment['member'];
        } else {
            $author = $comment['user'];
        }
        $params = [
            'author'    => $author,
            'body'      => $body,
            'commentid' => $commentid,
            'manager'   => $manager,
        ];

        $this->pagehead();

        echo \parseBlade('admin.action_commentdelete', $params), "\n";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_commentdeleteconfirm()
    {
        global $member;

        $commentid = intRequestVar('commentid');

        // get item id first
        $res    = sql_query(sprintf("SELECT citem FROM %s WHERE cnumber=%s", sql_table('comment'), $commentid));
        $o      = sql_fetch_object($res);
        $itemid = $o->citem;

        $error = $this->deleteOneComment($commentid);
        if ($error) {
            $this->doError($error);
        }

        if ($member->canAlterItem($itemid)) {
            $this->action_itemcommentlist($itemid);
        } else {
            $this->action_browseowncomments();
        }
    }

    /**
     * @todo document this
     */
    public function deleteOneComment($commentid)
    {
        global $member, $manager;

        $commentid = (int) $commentid;

        if ( ! $member->canAlterComment($commentid)) {
            return _ERROR_DISALLOWED;
        }

        $param = ['commentid' => $commentid];
        $manager->notify('PreDeleteComment', $param);

        // delete the comments associated with the item
        $query = 'DELETE FROM ' . sql_table('comment') . ' WHERE cnumber=' . $commentid;
        sql_query($query);

        $param = ['commentid' => $commentid];
        $manager->notify('PostDeleteComment', $param);

        return '';
    }

    /**
     * Usermanagement main
     */
    public function action_usermanagement($msg = '')
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        if ($msg) {
            echo _MESSAGE, ': ', $msg;
        }

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        echo '<h2>' . _MEMBERS_TITLE . '</h2>';

        echo '<h3>' . _MEMBERS_CURRENT . '</h3>';

        $manager->loadClass('ENCAPSULATE');

        // show list of members with actions
        $batch                = new BATCH('member');
        $query                = parseQuery('SELECT * FROM [@prefix@]member');
        $template['content']  = 'memberlist';
        $template['tabindex'] = 10;
        $batch->showlist($query, 'table', $template);

        echo '<h3>' . _MEMBERS_NEW . '</h3>';
        ?>
        <form action="index.php" method="post" name="memberedit">
            <div>

                <input name="action" type="hidden" value="memberadd" />
                <?php $manager->addTicketHidden() ?>

                <table>
                    <tr>
                        <th colspan="2"><?php echo _MEMBERS_NEW ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_DISPLAY ?> <?php help('shortnames'); ?>
                            <br /><small><?php echo _MEMBERS_DISPLAY_INFO ?></small>
                        </td>
                        <td><input tabindex="10010" name="name" size="32" maxlength="32" required autocomplete="off" pattern="<?php echo $this->getInputPattern('member.name') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_REALNAME ?></td>
                        <td><input name="realname" tabindex="10020" size="40" maxlength="60" required autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_PWD ?>
                            <br /><small><?php echo _MEMBERS_PASSWORD_INFO ?> <?php help('password');?></small>
                        </td>
                        <td><input name="password" tabindex="10030" size="16" maxlength="40" type="password" required autocomplete="off"  pattern="<?php echo $this->getInputPattern('password_new') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_REPPWD ?></td>
                        <td><input name="repeatpassword" tabindex="10035" size="16" maxlength="40" type="password" required pattern="<?php echo $this->getInputPattern('password_new') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_EMAIL ?></td>
                        <td><input name="email" tabindex="10040" size="40" maxlength="60" required /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_URL ?></td>
                        <td><input name="url" tabindex="10050" size="40" maxlength="100" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_SUPERADMIN ?> <?php help('superadmin'); ?></td>
                        <td><?php $this->input_yesno('admin', 0, 10060); ?> </td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_CANLOGIN ?> <?php help('canlogin'); ?></td>
                        <td><?php $this->input_yesno('canlogin', 1, 10070); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_NOTES ?></td>
                        <td><input name="notes" maxlength="100" size="40" tabindex="10080" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_NEW ?></td>
                        <td><input type="submit" value="<?php echo _MEMBERS_NEW_BTN ?>" tabindex="10090" onclick="return checkSubmit();" /></td>
                    </tr>
                </table>

            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * Edit member settings
     */
    public function action_memberedit()
    {
        $this->action_editmembersettings(intRequestVar('memberid'));
    }

    private function getDislpayLanguageText($language)
    {
        global $DIR_LANG;
        $file = $DIR_LANG . 'language.json';
        if ((_CHARSET != 'UTF-8') | @ ! is_file($file) || ! function_exists('json_decode')) {
            return $language;
        }
        $j = json_decode(file_get_contents($file));
        if ($j && isset($j->$language) && (strlen((string) $j->$language) > 0)) {
            if (0 == strncasecmp($language, getLanguageName(), strlen($language))) {
                return (string) $j->$language;
            }
            return sprintf('%s - %s', $language, (string) $j->$language);
        }
        return $language;
    }

    /**
     * @todo document this
     */
    public function action_editmembersettings($memberid = '', $msg = '')
    {
        global $member, $manager, $CONF;

        if ('' == $memberid) {
            $memberid = $member->getID();
        }

        // check if allowed
        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);
        if ($msg) {
            echo _MESSAGE, ': ', $msg;
        }

        // show message to go back to member overview (only for admins)
        if ($member->isAdmin()) {
            echo '<a href="index.php?action=usermanagement">(' . _MEMBERS_BACKTOOVERVIEW . ')</a>';
        } else {
            echo '<a href="index.php?action=overview">(' ._BACK_YR_HOME. ')</a>';
        }

        echo '<h2>' . _MEMBERS_EDIT . '</h2>';

        $mem = MEMBER::createFromID($memberid);

        ?>
        <form method="post" action="index.php" name="memberedit">
            <div>

                <input type="hidden" name="action" value="changemembersettings" />
                <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
                <?php $manager->addTicketHidden() ?>

                <table>
                    <tr>
                        <th colspan="2"><?php echo _MEMBERS_EDIT ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_DISPLAY ?> <?php help('shortnames'); ?>
                            <br /><small><?php echo _MEMBERS_DISPLAY_INFO ?></small>
                        </td>
                        <td>
                            <?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
                                <input name="name" tabindex="10" maxlength="32" size="32" value="<?php echo  hsc($mem->getDisplayName()); ?>" required pattern="<?php echo $this->getInputPattern('member.name') ?>" />
                            <?php } else {
                                echo hsc($member->getDisplayName());
                            }
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_REALNAME ?></td>
                        <td><input name="realname" tabindex="20" maxlength="60" size="40" value="<?php echo  hsc($mem->getRealName()); ?>" required /></td>
                    </tr>
                    <?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
                        <tr>
                            <td><?php echo _MEMBERS_PWD ?>
                                <br /><small><?php echo _MEMBERS_PASSWORD_INFO ?> <?php help('password');?></small>
                                <input type="password" name="dummy" autocomplete="off" style="display:none;" />
                            </td>
                            <td><input type="password" tabindex="30" maxlength="40" size="16" name="password" autocomplete="off" pattern="<?php echo $this->getInputPattern('password') ?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo _MEMBERS_REPPWD ?></td>
                            <td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" autocomplete="off" pattern="<?php echo $this->getInputPattern('password') ?>" /></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td><?php echo _MEMBERS_EMAIL ?>
                            <br /><small><?php echo _MEMBERS_EMAIL_EDIT ?></small>
                        </td>
                        <td><input name="email" tabindex="40" size="40" maxlength="60" value="<?php echo  hsc($mem->getEmail()); ?>" required /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_URL ?></td>
                        <td><input name="url" tabindex="50" size="40" maxlength="100" value="<?php echo  hsc($mem->getURL()); ?>" /></td>
                        <?php // only allow to change this by super-admins
                        // we don't want normal users to 'upgrade' themselves to super-admins, do we? ;-)
                        if ($member->isAdmin()) {
                            ?>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_SUPERADMIN ?> <?php help('superadmin'); ?></td>
                        <td><?php $this->input_yesno('admin', $mem->isAdmin(), 60); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_CANLOGIN ?> <?php help('canlogin'); ?></td>
                        <td><?php $this->input_yesno('canlogin', $mem->canLogin(), 70, 1, 0, _YES, _NO, $mem->isAdmin()); ?></td>
                    </tr>
        <?php if ($member->isAdmin()) { ?>
                    <tr>
                        <td><?php echo _ADMIN_TEXT_UPDATENOTIFICATIONSANDDOWNLOADS ?></td>
                        <td><?php $this->input_yesno('enable_remote_update', (int) $mem->getOption('system', 'enable_remote_update', '1'), 70); ?></td>
                    </tr>
        <?php } ?>
                    <tr>
                        <td><?php echo _ADMIN_MEMBER_HALT_TITLE ?> <?php help('halt'); ?></td>
                        <td><?php if ($member->id != $mem->id) {
                            $this->input_yesno('halt', $mem->isHalt(), 70, 1, 0, _YES, _NO, $mem->isAdmin());
                        } ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_NOTES ?></td>
                        <td><input name="notes" tabindex="80" size="40" maxlength="100" value="<?php echo  hsc($mem->getNotes()); ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_DEFLANG ?> <?php help('language'); ?>
                        </td>
                        <td>

                            <select name="deflang" tabindex="85">
                                <option value=""><?php echo _MEMBERS_USESITELANG ?></option>
                                <?php               // show a dropdown list of all available languages
                            global $DIR_LANG, $DB_DRIVER_NAME;
        $dirhandle = opendir($DIR_LANG);
        while ($filename = readdir($dirhandle)) {
            $matches     = [];
            $sub_pattern = '((.*)-utf8)';
            if (preg_match('#^' . $sub_pattern . '\.php$#', $filename, $matches)) {
                $name          = $matches[2];
                $s_fullname    = $matches[1];
                $s_displaytext = hsc($this->getDislpayLanguageText($name));
                //if (!check_abalable_language_name($name))
                //    continue;
                echo sprintf('<option value="%s"', hsc($s_fullname));
                if ($s_fullname == $mem->getLanguage()) {
                    echo " selected=\"selected\"";
                }
                echo sprintf(">%s</option>", $s_displaytext);
            }
        }
        closedir($dirhandle);

        ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo _MEMBERS_USEAUTOSAVE ?> <?php help('autosave'); ?></td>
                        <td><?php $this->input_yesno('autosave', $mem->getAutosave(), 87); ?></td>
                    </tr>
                    <?php

        // Which page does current member want to select after saving the item?
        if (MEMBER::existOptionTable()) {
            $select_page_after_save = $member->getOption('item', 'select_page_after_save', '');
            printf("<tr><td>%s</td><td>\n", hsc(_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_TITLE));
            echo "<select name='select_page_after_save' tabindex='88'>";
            $v = [
                ''                   => hsc(_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_ITEM),
                'list'               => hsc(_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST),
                'list_with_category' => hsc(_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST_WITH_CATEGORY),
                'back_home'          => hsc(_BACKHOME),
            ];
            foreach ($v as $key => $value) {
                $op = $key === $select_page_after_save ? " selected='selected'" : '';
                printf("<option value='%s'%s>%s</option>", $key, $op, $value);
            }
            echo "</select>\n";
        }

                    // plugin options
                    $this->_insertPluginOptions('member', $memberid);
        ?>
                </table>
                <div><input type="submit" tabindex="90" value="<?php echo _MEMBERS_EDIT_BTN ?>" onclick="return checkSubmit();" /></div>
                <div style="display:none;">
                    <input type="password" name="dummy1" value="">
                    <input type="password" name="dummy2" value="">
                </div>
            </div>
        </form>
        <?php
        echo '<h3>', _PLUGINS_EXTRA, '</h3>';

        $param = ['member' => &$mem];
        $manager->notify('MemberSettingsFormExtras', $param);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_changemembersettings()
    {
        global $member, $CONF, $manager;

        $memberid = intRequestVar('memberid');

        // check if allowed
        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $name           = PostVar::asStrTrimedStriptags('name');
        $realname       = PostVar::asStrTrimedStriptags('realname');
        $password       = postVar::asStr('password');
        $repeatpassword = postVar::asStr('repeatpassword');
        $email          = PostVar::asStrTrimedStriptags('email');
        $url            = PostVar::asStrTrimedStriptags('url');

        // begin if: sometimes user didn't prefix the URL with http:// or https://, this cause a malformed URL. Let's fix it.
        if ( ! preg_match('#^https?://#', $url)) {
            $url = 'http://' . $url;
        }
        $admin    = postVar('admin');
        $canlogin = postVar('canlogin');
        $notes    = strip_tags(postVar('notes'));
        $deflang  = postVar('deflang');
        $mhalt    = intPostVar('halt');

        $mem = MEMBER::createFromID($memberid);

        if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {
            if ( ! isValidDisplayName($name)) {
                $this->error(_ERROR_BADNAME);
            }

            if (($name != $mem->getDisplayName()) && MEMBER::exists($name)) {
                $this->error(_ERROR_NICKNAMEINUSE);
            }

            // check password
            if ($password != $repeatpassword) {
                $this->error(_ERROR_PASSWORDMISMATCH);
            }

            if ($password && (strlen($password) < 6)) {
                $this->error(_ERROR_PASSWORDTOOSHORT);
            }

            if ('' !== $password && ! MEMBER::checkIfValidPasswordCharacters($password)) {
                $this->error(ERROR_PASSWORD_INVALID_CHARACTERS);
            }

            if ($password) {
                $pwdvalid = true;
                $pwderror = '';
                $param    = [
                    'password'     => $password,
                    'errormessage' => &$pwderror,
                    'valid'        => &$pwdvalid,
                ];
                $manager->notify('PrePasswordSet', $param);
                if ( ! $pwdvalid) {
                    $this->error($pwderror);
                }
            }
        }

        if ( ! isValidMailAddress($email)) {
            $this->error(_ERROR_BADMAILADDRESS);
        }

        if ('' === trim($realname)) {
            $this->error(_ERROR_REALNAMEMISSING);
        }

        if (('' != $deflang) && ( ! checkLanguage($deflang))) {
            $this->error(_ERROR_NOSUCHLANGUAGE . sprintf(' : <b>%s</b>', hsc($deflang)));
        }

        // check if there will remain at least one site member with both the logon and admin rights
        // (check occurs when taking away one of these rights from such a member)
        if (( ! $admin && $mem->isAdmin() && $mem->canLogin() && ( ! $mem->isHalt()))
            || ( ! $canlogin && $mem->isAdmin() && $mem->canLogin() && ( ! $mem->isHalt()))
            || ($mhalt && $mem->isAdmin() && $mem->canLogin() && ( ! $mem->isHalt()))
        ) {
            $r = sql_query(sprintf("SELECT count(*) FROM %s WHERE madmin=1 and mcanlogin=1", sql_table('member')));
            if ((int) sql_result($r) <= 1) {
                $this->error(_ERROR_ATLEASTONEADMIN);
            }
        }

        if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {
            $mem->setDisplayName($name);
            if ($password) {
                $mem->setPassword($password);
            }
        }

        $oldEmail = $mem->getEmail();

        $mem->setRealName($realname);
        $mem->setEmail($email);
        $mem->setURL($url);
        $mem->setNotes($notes);
        $mem->setLanguage($deflang);

        // only allow super-admins to make changes to the admin status
        if ($member->isAdmin()) {
            $mem->setAdmin($admin);
            $mem->setCanLogin($canlogin);
            if ($mem->id != $member->id) {
                $mem->setHalt($mhalt ? 1 : 0);
            }

            $v = PostVar::asBool('enable_remote_update', false) ? '1' : '0';
            $mem->updateOption('system', 'enable_remote_update', $v);
        }

        $autosave = postVar('autosave');
        $mem->setAutosave($autosave);

        $mem->write();

        // Which page does current member want to select after saving the item?
        if (MEMBER::existOptionTable()) {
            $select_page_after_save = (string) postVar('select_page_after_save');
            if ( ! in_array($select_page_after_save, ['','list','list_with_category','back_home'])) {
                $select_page_after_save = '';
            }
            $mem->updateOption('item', 'select_page_after_save', $select_page_after_save);
        }

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $param = [
            'context'  => 'member',
            'memberid' => $memberid,
            'member'   => &$mem,
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);

        // if email changed, generate new password
        if ($oldEmail != $mem->getEmail()) {
            if ( ! $mem->isHalt()) {
                // Send only if changed by the same user
                if ($member->getID() == $memberid) {
                    $mem->sendActivationLink('addresschange', $oldEmail);
                }
                // write to log
                $msg = sprintf(
                    "Email change: user[%d:%s] %s",
                    $memberid,
                    $mem->getDisplayName(),
                    $mem->getEmail()
                );
                ACTIONLOG::add(INFO, $msg);
            }
            // logout member
            $mem->newCookieKey();

            // only log out if the member being edited is the current member.
            if ($member->getID() == $memberid) {
                $member->logout();
            }
            $this->action_login(_MSG_ACTIVATION_SENT, 0);
            return;
        }

        if (
            ($mem->getID() == $member->getID())
            && ($mem->getDisplayName() != $member->getDisplayName())
        ) {
            $mem->newCookieKey();
            $member->logout();
            $this->action_login(_MSG_LOGINAGAIN, 0);
        } else {
            $select_page_after_save = $member->getOption('member', 'select_page_after_save', '');
            switch ($select_page_after_save) {
                case 'same_page' :
                    $this->action_editmembersettings($memberid, _MSG_SETTINGSCHANGED);
                    break;
                default:
                    $this->action_overview(_MSG_SETTINGSCHANGED);
                    break;
            }
        }
    }

    /**
     * @todo document this
     */
    public function action_memberadd()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        if (postVar('password') != postVar('repeatpassword')) {
            $this->error(_ERROR_PASSWORDMISMATCH);
        }
        if (strlen(postVar('password')) < 6) {
            $this->error(_ERROR_PASSWORDTOOSHORT);
        }

        $res = MEMBER::create(postVar('name'), postVar('realname'), postVar('password'), postVar('email'), postVar('url'), postVar('admin'), postVar('canlogin'), postVar('notes'));
        if (1 != $res) {
            $this->error($res);
        }

        // fire PostRegister event
        $newmem = new MEMBER();
        $newmem->readFromName(postVar('name'));
        $param = ['member' => &$newmem];
        $manager->notify('PostRegister', $param);

        $this->action_usermanagement();
    }

    /**
     * Account activation
     *
     * @author dekarma
     */
    public function action_activate()
    {
        $key = getVar('key');
        $this->_showActivationPage($key);
    }

    /**
     * @todo document this
     */
    public function _showActivationPage($key, $message = '')
    {
        global $manager;

        // clean up old activation keys
        MEMBER::cleanupActivationTable();

        // get activation info
        $info = MEMBER::getActivationInfo($key);

        if ( ! $info) {
            $this->error(_ERROR_ACTIVATE);
        }

        $mem = MEMBER::createFromId($info->vmember);

        if ( ! $mem || $mem->isHalt()) {
            $this->error(_ERROR_ACTIVATE);
        }

        $text                 = '';
        $title                = '';
        $bNeedsPasswordChange = true;

        switch ($info->vtype) {
            case 'forgot':
                $title = _ACTIVATE_FORGOT_TITLE;
                $text  = _ACTIVATE_FORGOT_TEXT;
                break;
            case 'register':
                $title = _ACTIVATE_REGISTER_TITLE;
                $text  = _ACTIVATE_REGISTER_TEXT;
                break;
            case 'addresschange':
                $title                = _ACTIVATE_CHANGE_TITLE;
                $text                 = _ACTIVATE_CHANGE_TEXT;
                $bNeedsPasswordChange = false;
                MEMBER::activate($key);
                break;
        }

        $aVars = [
            'memberName' => hsc($mem->getDisplayName()),
        ];
        $title = TEMPLATE::fill($title, $aVars);
        $text  = TEMPLATE::fill($text, $aVars);

        $params = [
           'manager' => $manager,
           //'oAdmin'            => $this,
           'mem'                  => $mem,
           'title'                => $title,
           'text'                 => $text,
           'message'              => $message,
           'bNeedsPasswordChange' => $bNeedsPasswordChange,
           'key'                  => $key,
           'pattern_password'     => $this->getInputPattern('password'),
        ];

        $this->pagehead();

        echo \parseBlade('admin.showactivationpage', $params), "\n";

        $this->pagefoot();
    }

    /**
     * Account activation - set password part
     *
     * @author dekarma
     */
    public function action_activatesetpwd()
    {
        $key = postVar('key');

        // clean up old activation keys
        MEMBER::cleanupActivationTable();

        // get activation info
        $info = MEMBER::getActivationInfo($key);

        if ( ! $info || ('addresschange' == $info->vtype)) {
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);
        }

        $mem = MEMBER::createFromId($info->vmember);

        if ( ! $mem || $mem->isHalt()) {
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);
        }

        $password       = (string) postVar('password');
        $repeatpassword = (string) postVar('repeatpassword');

        if ( ! trim($password) || (trim($password) != $password)) {
            return $this->_showActivationPage($key, _ERROR_PASSWORDMISSING);
        }

        if ($password != $repeatpassword) {
            return $this->_showActivationPage($key, _ERROR_PASSWORDMISMATCH);
        }

        if ($password && (strlen($password) < 6)) {
            return $this->_showActivationPage($key, _ERROR_PASSWORDTOOSHORT);
        }

        if ( ! MEMBER::checkIfValidPasswordCharacters($password)) {
            return $this->_showActivationPage($key, ERROR_PASSWORD_INVALID_CHARACTERS);
        }

        if ($password) {
            $pwdvalid = true;
            $pwderror = '';

            global $manager;
            $param = [
                'password'     => $password,
                'errormessage' => &$pwderror,
                'valid'        => &$pwdvalid,
            ];
            $manager->notify('PrePasswordSet', $param);

            if ( ! $pwdvalid) {
                return $this->_showActivationPage($key, $pwderror);
            }
        }

        $error = '';
        $param = [
            'type'   => 'activation',
            'member' => $mem,
            'error'  => &$error,
        ];
        $manager->notify('ValidateForm', $param);
        if ('' != $error) {
            return $this->_showActivationPage($key, $error);
        }

        // set password
        $mem->setPassword($password);
        $mem->write();

        // do the activation
        MEMBER::activate($key);

        $this->pagehead();
        echo '<h2>', _ACTIVATE_SUCCESS_TITLE, '</h2>';
        echo '<p>', _ACTIVATE_SUCCESS_TEXT, '</p>';
        $this->pagefoot();
    }

    /**
     * Manage team
     */
    public function action_manageteam()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $this->pagehead();

        echo "<p><a href='index.php?action=blogsettings&amp;blogid={$blogid}'>(", _BACK_TO_BLOGSETTINGS, ")</a></p>";

        echo '<h2>' . _TEAM_TITLE . hsc(getBlogNameFromID($blogid)) . '</h2>';

        echo '<h3>' . _TEAM_CURRENT . '</h3>';

        $query = sprintf("SELECT tblog, tmember, mname, mrealname, memail, tadmin FROM %s, %s WHERE tmember=mnumber and tblog=%s", sql_table('member'), sql_table('team'), $blogid);

        $template['content']  = 'teamlist';
        $template['tabindex'] = 10;

        $manager->loadClass("ENCAPSULATE");
        $batch = new BATCH('team');
        $batch->showList($query, 'table', $template);

        ?>
        <h3><?php echo _TEAM_ADDNEW ?></h3>
        <?php
        // TODO: try to make it so only non-team-members are listed
        // From https://github.com/Lord-Matt-NucleusCMS-Stuff/lmnucleuscms/commit/3b4e236449a2212ff2440f8654197a9c01667166#diff-34cb57d57a38d46e6406db82a324c224R2337
        $ph['tblog']            = $blogid;
        $from_where             = parseQuery(' FROM [@prefix@]member WHERE mnumber NOT IN (SELECT tmember FROM [@prefix@]team WHERE tblog=[@tblog@])', $ph);
        $query                  = "SELECT mname as text, mnumber as value" . $from_where;
        $count_non_team_members = (int) quickQuery("SELECT count(*) AS result " . $from_where);

        if (0 == $count_non_team_members) {
            echo _TEAM_NO_SELECTABLE_MEMBERS;
        } else {
            ?>
            <form method='post' action='index.php'>
                <div>

                    <input type='hidden' name='action' value='teamaddmember' />
                    <input type='hidden' name='blogid' value='<?php echo  $blogid; ?>' />
                    <?php $manager->addTicketHidden() ?>

                    <table>
                        <tr>
                            <td><?php echo _TEAM_CHOOSEMEMBER; ?></td>
                            <td><?php
                                $template['name'] = 'memberid';
            $template['tabindex']                 = 10000;
            showlist_by_query($query, 'select', $template);
            ?></td>
                        </tr>
                        <tr>
                            <td><?php echo _TEAM_ADMIN ?><?php help('teamadmin'); ?></td>
                            <td><?php $this->input_yesno('admin', 0, 10020); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo _TEAM_ADD ?></td>
                            <td><input type='submit' value='<?php echo _TEAM_ADD_BTN ?>' tabindex="10030" /></td>
                        </tr>
                    </table>

                </div>
            </form>
            <?php
        } // end $count_non_team_members > 0
        $this->pagefoot();
    }

    /**
     * Add member to team
     */
    public function action_teamaddmember()
    {
        global $member, $manager;

        $memberid = intPostVar('memberid');
        $blogid   = intPostVar('blogid');
        $admin    = intPostVar('admin');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);
        if ($member->existsID($memberid)) {
            if ( ! $blog->addTeamMember($memberid, $admin)) {
                $this->error(_ERROR_ALREADYONTEAM);
            }
        }

        $this->action_manageteam();
    }

    /**
     * @todo document this
     */
    public function action_teamdelete()
    {
        global $member, $manager;

        $memberid = intRequestVar('memberid');
        $blogid   = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $teammem = MEMBER::createFromID($memberid);
        $blog    = &$manager->getBlog($blogid);

        $this->pagehead();
        ?>
        <h2><?php echo _DELETE_CONFIRM ?></h2>

        <p><?php echo _CONFIRMTXT_TEAM1 ?><b><?php echo  hsc($teammem->getDisplayName()) ?></b><?php echo _CONFIRMTXT_TEAM2 ?><b><?php echo  hsc(strip_tags($blog->getName())) ?></b>
        </p>


        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="teamdeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
                <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_teamdeleteconfirm()
    {
        $memberid = intRequestVar('memberid');
        $blogid   = intRequestVar('blogid');

        $error = $this->deleteOneTeamMember($blogid, $memberid);
        if ($error) {
            $this->error($error);
        }

        $this->action_manageteam();
    }

    /**
     * @todo document this
     */
    public function deleteOneTeamMember($blogid, $memberid)
    {
        global $member, $manager;

        $blogid   = (int) $blogid;
        $memberid = (int) $memberid;

        // check if allowed
        if ( ! $member->blogAdminRights($blogid)) {
            return _ERROR_DISALLOWED;
        }

        // check if: - there remains at least one blog admin
        //           - (there remains at least one team member)
        $tmem = MEMBER::createFromID($memberid);

        $param = [
            'member' => &$tmem,
            'blogid' => $blogid,
        ];
        $manager->notify('PreDeleteTeamMember', $param);

        if ($tmem->isBlogAdmin($blogid)) {
            // check if there are more blog members left and at least one admin
            // (check for at least two admins before deletion)
            $query = sprintf("SELECT count(*) FROM %s WHERE tblog=%s and tadmin=1", sql_table('team'), $blogid);
            $r     = sql_query($query);
            if ($r && (int) sql_result($r) < 2) {
                return _ERROR_ATLEASTONEBLOGADMIN;
            }
        }

        $query = 'DELETE FROM ' . sql_table('team') . " WHERE tblog={$blogid} and tmember={$memberid}";
        sql_query($query);

        $param = [
            'member' => &$tmem,
            'blogid' => $blogid,
        ];
        $manager->notify('PostDeleteTeamMember', $param);

        return '';
    }

    /**
     * @todo document this
     */
    public function action_teamchangeadmin()
    {
        global $member;

        $blogid   = intRequestVar('blogid');
        $memberid = intRequestVar('memberid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $mem = MEMBER::createFromID($memberid);

        // don't allow when there is only one admin at this moment
        if ($mem->isBlogAdmin($blogid)) {
            $r = sql_query(sprintf("SELECT count(*) FROM %s WHERE tblog={$blogid} and tadmin=1", sql_table('team')));
            if (1 == (int) sql_result($r)) {
                $this->error(_ERROR_ATLEASTONEBLOGADMIN);
            }
        }

        if ($mem->isBlogAdmin($blogid)) {
            $newval = 0;
        } else {
            $newval = 1;
        }

        $query = 'UPDATE ' . sql_table('team') . " SET tadmin={$newval} WHERE tblog={$blogid} and tmember={$memberid}";
        sql_query($query);

        // only show manageteam if member did not change its own admin privileges
        if ($member->isBlogAdmin($blogid)) {
            $this->action_manageteam();
        } else {
            $this->action_overview(_MSG_ADMINCHANGED);
        }
    }

    /**
     * @todo document this
     */
    public function action_blogsettings($message = '')
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';
        ?>
        <h2><?php echo _EBLOG_TITLE ?>: '<?php echo $this->bloglink($blog) ?>'</h2>
        <?php if ($message) {
            echo sprintf('<div class="ok">%s</div>', $message);
        } ?>

        <h3><?php echo _EBLOG_TEAM_TITLE ?></h3>

        <p><?php echo _EBLOG_CURRENT_TEAM_MEMBER; ?>
            <?php
            $res      = sql_query(sprintf("SELECT mname, mrealname FROM %s,%s WHERE mnumber=tmember AND tblog=%s", sql_table('member'), sql_table('team'), (int) $blogid));
        $aMemberNames = [];
        if ($res) {
            while ($o = sql_fetch_object($res)) {
                $aMemberNames[] = hsc($o->mname) . ' (' . hsc($o->mrealname) . ')';
            }
        }
        echo implode(',', $aMemberNames);
        ?>
        </p>



        <div>
            <form action="index.php" method="GET">
                <input type="hidden" name="action" value="manageteam" />
                <input type="hidden" name="blogid" value="<?php echo $blogid; ?>" />
                <input type="submit" value="<?php echo _EBLOG_TEAM_TEXT; ?>" />
            </form>
        </div>

        <h3><?php echo _EBLOG_SETTINGS_TITLE ?></h3>

        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="blogsettingsupdate" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
                <table>
                    <tr>
                        <td><?php echo _EBLOG_NAME ?></td>
                        <td><input name="name" tabindex="10" size="40" maxlength="60" value="<?php echo  hsc($blog->getName()) ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_SHORTNAME ?> <?php help('shortblogname'); ?>
                            <?php echo _EBLOG_SHORTNAME_EXTRA ?>
                        </td>
                        <td><input name="shortname" tabindex="20" maxlength="15" size="15" value="<?php echo  hsc($blog->getShortName()) ?>" required autocomplete="off" pattern="<?php echo $this->getInputPattern('blog.name') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_DESC ?></td>
                        <td><input name="desc" tabindex="30" maxlength="200" value="<?php echo  hsc($blog->getDescription()) ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_URL ?></td>
                        <td><input name="url" tabindex="40" size="40" maxlength="100" value="<?php echo  hsc($blog->getURL()) ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_DEFSKIN ?>
                            <?php help('blogdefaultskin'); ?>
                        </td>
                        <td>
                            <?php
                        $query = sprintf("SELECT sdname as text, sdnumber as value FROM %s", sql_table('skin_desc'));
        $template['name']      = 'defskin';
        $template['selected']  = $blog->getDefaultSkin();
        $template['tabindex']  = 50;
        showlist_by_query($query, 'select', $template);
        ?>

                        </td>
                    </tr>
                    <?php
                    if ( ! $blog->existsSetting('bauthorvisible')
                        && ! sql_existTableColumnName(sql_table('blog'), 'bauthorvisible')
                    ) {
                        // Force Upgrade
                        BLOG::UpgardeAddColumnAuthorVisible();
                    }
        ?>
                    <tr>
                        <td><?php echo _EBLOG_VISIBLE_ITEM_AUTHOR; ?> <?php help('authorvisible'); ?>
                        </td>
                        <td><?php
            if ($blog->existsSetting('bauthorvisible') || sql_existTableColumnName(sql_table('blog'), 'bauthorvisible')) {
                $this->input_yesno('authorvisible', $blog->getAuthorVisible(), 53);
            } else {
                echo "Needs to upgrade column name `authorvisible`. please reload.";
            }
        ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_LINEBREAKS ?> <?php help('convertbreaks'); ?>
                        </td>
                        <td><?php $this->input_yesno('convertbreaks', $blog->convertBreaks(), 55); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_ALLOWPASTPOSTING ?> <?php help('allowpastposting'); ?>
                        </td>
                        <td><?php $this->input_yesno('allowpastposting', $blog->allowPastPosting(), 57); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_DISABLECOMMENTS ?>
                        </td>
                        <td><?php $this->input_yesno('comments', $blog->commentsEnabled(), 60); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_ANONYMOUS ?>
                        </td>
                        <td><?php $this->input_yesno('public', $blog->isPublic(), 70); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_REQUIREDEMAIL ?>
                        </td>
                        <td><?php $this->input_yesno('reqemail', $blog->emailRequired(), 72); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_NOTIFY ?> <?php help('blognotify'); ?></td>
                        <td><input name="notify" tabindex="80" maxlength="128" size="40" value="<?php echo  hsc($blog->getNotifyAddress()); ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_NOTIFY_ON ?></td>
                        <td>
                            <input name="notifyComment" value="3" type="checkbox" tabindex="81" id="notifyComment" <?php if ($blog->notifyOnComment()) {
                                echo "checked='checked'";
                            } ?> /><label for="notifyComment"><?php echo _EBLOG_NOTIFY_COMMENT ?></label>
                            <br />
                            <input name="notifyVote" value="5" type="checkbox" tabindex="82" id="notifyVote" <?php if ($blog->notifyOnVote()) {
                                echo "checked='checked'";
                            } ?> /><label for="notifyVote"><?php echo _EBLOG_NOTIFY_KARMA ?></label>
                            <br />
                            <input name="notifyNewItem" value="7" type="checkbox" tabindex="83" id="notifyNewItem" <?php if ($blog->notifyOnNewItem()) {
                                echo "checked='checked'";
                            } ?> /><label for="notifyNewItem"><?php echo _EBLOG_NOTIFY_ITEM ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_MAXCOMMENTS ?> <?php help('blogmaxcomments'); ?></td>
                        <td><input name="maxcomments" tabindex="90" size="3" value="<?php echo  hsc($blog->getMaxComments()); ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_UPDATE ?> <?php help('blogupdatefile'); ?></td>
                        <td><input name="update" tabindex="100" size="40" maxlength="60" value="<?php echo  hsc($blog->getUpdateFile()) ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_DEFCAT ?></td>
                        <td>
                            <?php
                            $query = sprintf("SELECT cname as text, catid as value FROM %s WHERE cblog=%s ORDER BY corder ASC , cname ASC ", sql_table('category'), $blog->getID());
        $template['name']          = 'defcat';
        $template['selected']      = $blog->getDefaultCategory();
        $template['tabindex']      = 110;
        showlist_by_query($query, 'select', $template);
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_OFFSET ?> <?php help('blogtimeoffset'); ?>
                            <br /><?php echo _EBLOG_STIME ?> <b><?php echo  date("H:i", time()); ?></b>
                            <br /><?php echo _EBLOG_BTIME ?> <b><?php echo  date("H:i", $blog->getCorrectTime()); ?></b>
                        </td>
                        <td><input name="timeoffset" tabindex="120" size="3" value="<?php echo  hsc($blog->getTimeOffset()); ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_SEARCH ?> <?php help('blogsearchable'); ?></td>
                        <td><?php $this->input_yesno('searchable', $blog->getSearchable(), 122); ?></td>
                    </tr>
                    <?php
                    // plugin options
                    $this->_insertPluginOptions('blog', $blogid);
        ?>
                </table>
                <div><input type="submit" tabindex="130" value="<?php echo _EBLOG_CHANGE_BTN ?>" onclick="return checkSubmit();" /></div>
            </div>
        </form>

        <h3><?php echo _EBLOG_CAT_TITLE ?></h3>


        <?php
        $query = sprintf("SELECT c.* , count(i.icat) as icount  FROM %s c   LEFT JOIN %s i    ON c . catid = i . icat  WHERE cblog=%s GROUP BY c . catid  ORDER BY c.corder ASC , c.cname ASC ", sql_table('category'), sql_table('item'), $blog->getID());

        $template['content']  = 'categorylist';
        $template['tabindex'] = 200;

        $manager->loadClass("ENCAPSULATE");
        $batch = new BATCH('category');
        $batch->showlist($query, 'table', $template);

        ?>


        <form action="index.php" method="post">
            <div>
                <input name="action" value="categorynew" type="hidden" />
                <?php $manager->addTicketHidden() ?>
                <input name="blogid" value="<?php echo $blog->getID(); ?>" type="hidden" />

                <table>
                    <tr>
                        <th colspan="2"><?php echo _EBLOG_CAT_CREATE ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_NAME ?></td>
                        <td><input name="cname" size="40" maxlength="40" tabindex="300" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_DESC ?></td>
                        <td><input name="cdesc" size="40" maxlength="200" tabindex="310" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_ORDER ?></td>
                        <td><input name="corder" size="40" maxlength="200" tabindex="320" value="100" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_CREATE ?></td>
                        <td><input type="submit" value="<?php echo _EBLOG_CAT_CREATE ?>" tabindex="320" /></td>
                    </tr>
                </table>

            </div>
        </form>

        <?php

        echo '<h3>', _PLUGINS_EXTRA, '</h3>';

        $param = ['blog' => &$blog];
        $manager->notify('BlogSettingsFormExtras', $param);
        echo '<h3>' . _BLOGLIST_BMLET . '</h3>';
        echo '<form action="index.php" method="GET">';
        echo '<input type="hidden" name="action" value="bookmarklet" />';
        echo sprintf('<input type="hidden" name="blogid" value="%s" />', $blogid);
        echo sprintf('<input type="submit" value="%s" />', _BLOGLIST_TT_BMLET);
        echo '</form>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_categorynew()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $cname = postVar('cname');
        $cdesc = postVar('cdesc');

        $corder = null;
        if (isset($_POST['corder'])) {
            $corder = &$_POST['corder'];
            if ((null !== $corder)
                && (is_numeric($corder))
            ) {
                $corder = (int) $corder;
            } else {
                $corder = null;
            }
        }

        if ( ! isValidCategoryName($cname)) {
            $this->error(_ERROR_BADCATEGORYNAME);
        }

        $query = sprintf("SELECT count(*) FROM %s WHERE cname=%s and cblog=%s", sql_table('category'), sql_quote_string($cname), (int) $blogid);
        $res   = sql_query($query);
        if ((int) sql_result($res) > 0) {
            $this->error(_ERROR_DUPCATEGORYNAME);
        }

        $blog     = &$manager->getBlog($blogid);
        $newCatID = $blog->createNewCategory($cname, $cdesc, $corder);

        $this->action_blogsettings();
    }

    /**
     * @todo document this
     */
    public function action_categoryedit($catid = '', $blogid = '', $desturl = '')
    {
        global $member, $manager;

        if ('' == $blogid) {
            $blogid = intGetVar('blogid');
        } else {
            $blogid = (int) $blogid;
        }
        if ('' == $catid) {
            $catid = intGetVar('catid');
        } else {
            $catid = (int) $catid;
        }

        $member->blogAdminRights($blogid) or $this->disallow();

        $res = sql_query(sprintf("SELECT * FROM %s WHERE cblog=%s AND catid=%s", sql_table('category'), $blogid, $catid));
        $obj = sql_fetch_object($res);

        $cname  = $obj->cname;
        $cdesc  = $obj->cdesc;
        $corder = $obj->corder;

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        echo "<p><a href='index.php?action=blogsettings&amp;blogid={$blogid}'>(", _BACK_TO_BLOGSETTINGS, ")</a></p>";

        ?>
        <h2><?php echo _EBLOG_CAT_UPDATE ?> '<?php echo hsc($cname) ?>'</h2>
        <form method='post' action='index.php'>
            <div>
                <input name="blogid" type="hidden" value="<?php echo $blogid ?>" />
                <input name="catid" type="hidden" value="<?php echo $catid ?>" />
                <input name="desturl" type="hidden" value="<?php echo hsc($desturl) ?>" />
                <input name="action" type="hidden" value="categoryupdate" />
                <?php $manager->addTicketHidden(); ?>

                <table>
                    <tr>
                        <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_NAME ?></td>
                        <td><input type="text" name="cname" value="<?php echo hsc($cname) ?>" size="40" maxlength="40" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_DESC ?></td>
                        <td><input type="text" name="cdesc" value="<?php echo hsc($cdesc) ?>" size="40" maxlength="200" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_ORDER ?></td>
                        <td><input type="text" name="corder" value="<?php echo hsc($corder) ?>" size="40" maxlength="200" /></td>
                    </tr>
                    <?php
                    // insert plugin options
                    $this->_insertPluginOptions('category', $catid);
        ?>
                    <tr>
                        <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CAT_UPDATE ?></td>
                        <td><input type="submit" value="<?php echo _EBLOG_CAT_UPDATE_BTN ?>" /></td>
                    </tr>
                </table>

            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_categoryupdate()
    {
        global $member, $manager;

        $blogid  = intPostVar('blogid');
        $catid   = intPostVar('catid');
        $cname   = postVar('cname');
        $cdesc   = postVar('cdesc');
        $desturl = postVar('desturl');

        $corder = null;
        if (isset($_POST['corder'])) {
            $corder = &$_POST['corder'];

            if ((null !== $corder) && is_numeric($corder)) {
                $corder = (int) $corder;
            } else {
                $corder = null;
            }
        }

        $member->blogAdminRights($blogid) or $this->disallow();

        if ( ! isValidCategoryName($cname)) {
            $this->error(_ERROR_BADCATEGORYNAME);
        }

        $ph['cname'] = sql_quote_string($cname);
        $ph['cdesc'] = sql_quote_string($cdesc);
        $ph['cblog'] = (int) $blogid;
        $ph['catid'] = $catid;
        $query       = parseQuery('SELECT count(*) FROM [@prefix@]category WHERE cname=[@cname@] AND cblog=[@cblog@] AND catid!=[@catid@]', $ph);
        $res         = sql_query($query);
        if ((int) sql_result($res) > 0) {
            $this->error(_ERROR_DUPCATEGORYNAME);
        }

        $query = parseQuery('UPDATE [@prefix@]category SET cname=[@cname@], cdesc=[@cdesc@]', $ph);

        if (null !== $corder) {
            $query .= sprintf(' , corder=%d', $corder);
        }

        $query .= " WHERE catid=" . $catid;
        sql_query($query);

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $param = [
            'context' => 'category',
            'catid'   => $catid,
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);

        if ($desturl) {
            redirect($desturl);
            exit;
        } else {
            $this->action_blogsettings();
        }
    }

    /**
     * @todo document this
     */
    public function action_categorydelete()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');
        $catid  = intRequestVar('catid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);

        // check if the category is valid
        if ( ! $blog->isValidCategory($catid)) {
            $this->error(_ERROR_NOSUCHCATEGORY);
        }

        // don't allow deletion of default category
        if ($blog->getDefaultCategory() == $catid) {
            $this->error(_ERROR_DELETEDEFCATEGORY);
        }

        // check if catid is the only category left for blogid
        $query = sprintf("SELECT count(*) FROM %s WHERE cblog=%s", sql_table('category'), $blogid);
        $res   = sql_query($query);
        if (1 == (int) sql_result($res)) {
            $this->error(_ERROR_DELETELASTCATEGORY);
        }

        $this->pagehead();
        ?>
        <h2><?php echo _DELETE_CONFIRM ?></h2>

        <div>
            <?php echo _CONFIRMTXT_CATEGORY ?><b><?php echo  hsc($blog->getCategoryName($catid)) ?></b>
        </div>

        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="categorydeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="blogid" value="<?php echo $blogid ?>" />
                <input type="hidden" name="catid" value="<?php echo $catid ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_categorydeleteconfirm()
    {
        global $member;

        $blogid = intRequestVar('blogid');
        $catid  = intRequestVar('catid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $error = $this->deleteOneCategory($catid);
        if ($error) {
            $this->error($error);
        }

        $this->action_blogsettings();
    }

    /**
     * @todo document this
     */
    public function deleteOneCategory($catid)
    {
        global $manager, $member;

        $catid = (int) $catid;

        $blogid = getBlogIDFromCatID($catid);

        if ( ! $member->blogAdminRights($blogid)) {
            return ERROR_DISALLOWED;
        }

        // get blog
        $blog = &$manager->getBlog($blogid);

        // check if the category is valid
        if ( ! $blog || ! $blog->isValidCategory($catid)) {
            return _ERROR_NOSUCHCATEGORY;
        }

        $destcatid = $blog->getDefaultCategory();

        // don't allow deletion of default category
        if ($blog->getDefaultCategory() == $catid) {
            return _ERROR_DELETEDEFCATEGORY;
        }

        // check if catid is the only category left for blogid
        $query = sprintf("SELECT count(*) FROM %s WHERE cblog=%s", sql_table('category'), $blogid);
        $res   = sql_query($query);
        if (1 == (int) sql_result($res)) {
            return _ERROR_DELETELASTCATEGORY;
        }

        $param = ['catid' => $catid];
        $manager->notify('PreDeleteCategory', $param);

        // change category for all items to the default category
        $query = 'UPDATE ' . sql_table('item') . " SET icat={$destcatid} WHERE icat={$catid}";
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('category', $catid);

        // delete category
        $query = 'DELETE FROM ' . sql_table('category') . ' WHERE catid=' . $catid;
        sql_query($query);

        $param = ['catid' => $catid];
        $manager->notify('PostDeleteCategory', $param);
    }

    /**
     * @todo document this
     */
    public function moveOneCategory($catid, $destblogid)
    {
        global $manager, $member;

        $catid      = (int) $catid;
        $destblogid = (int) $destblogid;

        $blogid = getBlogIDFromCatID($catid);

        // mover should have admin rights on both blogs
        if ( ! $member->blogAdminRights($blogid)) {
            return _ERROR_DISALLOWED;
        }
        if ( ! $member->blogAdminRights($destblogid)) {
            return _ERROR_DISALLOWED;
        }

        // cannot move to self
        if ($blogid == $destblogid) {
            return _ERROR_MOVETOSELF;
        }

        // get blogs
        $blog     = &$manager->getBlog($blogid);
        $destblog = &$manager->getBlog($destblogid);

        // check if the category is valid
        if ( ! $blog || ! $blog->isValidCategory($catid)) {
            return _ERROR_NOSUCHCATEGORY;
        }

        // don't allow default category to be moved
        if ($blog->getDefaultCategory() == $catid) {
            return _ERROR_MOVEDEFCATEGORY;
        }

        $param = [
            'catid'      => &$catid,
            'sourceblog' => &$blog,
            'destblog'   => &$destblog,
        ];
        $manager->notify('PreMoveCategory', $param);

        // update comments table (cblog)
        $query = sprintf("SELECT inumber FROM %s WHERE icat=%s", sql_table('item'), $catid);
        $items = sql_query($query);
        while ($oItem = sql_fetch_object($items)) {
            sql_query('UPDATE ' . sql_table('comment') . ' SET cblog=' . $destblogid . ' WHERE citem=' . $oItem->inumber);
        }

        // update items (iblog)
        $query = 'UPDATE ' . sql_table('item') . ' SET iblog=' . $destblogid . ' WHERE icat=' . $catid;
        sql_query($query);

        // move category
        $query = 'UPDATE ' . sql_table('category') . ' SET cblog=' . $destblogid . ' WHERE catid=' . $catid;
        sql_query($query);

        $param = [
            'catid'      => &$catid,
            'sourceblog' => &$blog,
            'destblog'   => $destblog,
        ];
        $manager->notify('PostMoveCategory', $param);
    }

    public function changeOneCategoryOrder($catid, $new_corder)
    {
        global $manager, $member;

        $catid      = (int) $catid;
        $new_corder = (int) $new_corder;

        $blogid = (int) getBlogIDFromCatID($catid);

        // mover should have admin rights on both blogs
        if ( ! $blogid || ! $member->blogAdminRights($blogid)) {
            return _ERROR_DISALLOWED;
        }

        // get blogs
        $blog = &$manager->getBlog($blogid);

        // check if the category is valid
        if ( ! $blog || ! $blog->isValidCategory($catid)) {
            return _ERROR_NOSUCHCATEGORY;
        }

        $old_corder = $blog->getCategoryOrder($catid);
        $param      = [
            'catid'      => $catid,
            'blog'       => $blog,
            'old_corder' => $old_corder,
            'new_corder' => &$new_corder,
        ];
        $manager->notify('PreChangeCategoryOrder', $param);

        // update category corder
        $query = 'UPDATE ' . sql_table('category')
            .  ' SET corder=' . (int) $new_corder
            . ' WHERE cblog=' . $blogid . ' AND catid=' . $catid;
        sql_query($query);

        $param = [
            'catid'      => $catid,
            'blog'       => $blog,
            'old_corder' => $old_corder,
            'new_corder' => $new_corder,
        ];
        $manager->notify('PostChangeCategoryOrder', $param);
    }

    /**
     * @todo document this
     */
    public function action_blogsettingsupdate()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);

        $notify     = trim(postVar('notify'));
        $shortname  = trim(postVar('shortname'));
        $updatefile = trim(postVar('update'));

        $notifyComment = intPostVar('notifyComment');
        $notifyVote    = intPostVar('notifyVote');
        $notifyNewItem = intPostVar('notifyNewItem');

        if (0 == $notifyComment) {
            $notifyComment = 1;
        }
        if (0 == $notifyVote) {
            $notifyVote = 1;
        }
        if (0 == $notifyNewItem) {
            $notifyNewItem = 1;
        }

        $notifyType = $notifyComment * $notifyVote * $notifyNewItem;

        if ($notify) {
            $not = new NOTIFICATION($notify);
            if ( ! $not->validAddresses()) {
                $this->error(_ERROR_BADNOTIFY);
            }
        }

        if ( ! isValidShortName($shortname)) {
            $this->error(_ERROR_BADSHORTBLOGNAME);
        }

        if (($blog->getShortName() != $shortname) && $manager->existsBlog($shortname)) {
            $this->error(_ERROR_DUPSHORTBLOGNAME);
        }

        // check if update file is writable
        if ($updatefile && ! is_writable($updatefile)) {
            $this->error(_ERROR_UPDATEFILE);
        }

        $blog->setName(trim(postVar('name')));
        $blog->setShortName($shortname);
        $blog->setNotifyAddress($notify);
        $blog->setNotifyType($notifyType);
        $blog->setMaxComments(postVar('maxcomments'));
        $blog->setCommentsEnabled(postVar('comments'));
        $blog->setTimeOffset(postVar('timeoffset'));
        $blog->setUpdateFile($updatefile);
        $blog->setURL(trim(postVar('url')));
        $blog->setDefaultSkin(intPostVar('defskin'));
        $blog->setDescription(trim(postVar('desc')));
        $blog->setPublic(postVar('public'));
        $blog->setConvertBreaks(intPostVar('convertbreaks'));
        $blog->setAllowPastPosting(intPostVar('allowpastposting'));
        $blog->setDefaultCategory(intPostVar('defcat'));
        $blog->setSearchable(intPostVar('searchable'));
        $blog->setEmailRequired(intPostVar('reqemail'));
        $blog->setAuthorvisible(intPostVar('authorvisible'));

        $blog->writeSettings();

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $param = [
            'context' => 'blog',
            'blogid'  => $blogid,
            'blog'    => &$blog,
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);

        //        $this->action_overview(_MSG_SETTINGSCHANGED);
        $this->action_blogsettings(_MSG_SETTINGSCHANGED);
    }

    /**
     * @todo document this
     */
    public function action_deleteblog()
    {
        global $member, $CONF, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        // check if blog is default blog
        if ($CONF['DefaultBlog'] == $blogid) {
            $this->error(_ERROR_DELDEFBLOG);
        }

        $blog = &$manager->getBlog($blogid);

        $this->pagehead();
        ?>
        <h2><?php echo _DELETE_CONFIRM ?></h2>

        <p><?php echo _WARNINGTXT_BLOGDEL ?>
        </p>

        <div>
            <?php echo _CONFIRMTXT_BLOG ?><b><?php echo  hsc($blog->getName()) ?></b>
        </div>

        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="deleteblogconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_deleteblogconfirm()
    {
        global $member, $CONF, $manager;

        $blogid = intRequestVar('blogid');

        $param = ['blogid' => $blogid];
        $manager->notify('PreDeleteBlog', $param);

        $member->blogAdminRights($blogid) or $this->disallow();

        // check if blog is default blog
        if ($CONF['DefaultBlog'] == $blogid) {
            $this->error(_ERROR_DELDEFBLOG);
        }

        // delete all comments
        $query = 'DELETE FROM ' . sql_table('comment') . ' WHERE cblog=' . $blogid;
        sql_query($query);

        // delete all items
        $query = 'DELETE FROM ' . sql_table('item') . ' WHERE iblog=' . $blogid;
        sql_query($query);

        // delete all team members
        $query = 'DELETE FROM ' . sql_table('team') . ' WHERE tblog=' . $blogid;
        sql_query($query);

        // delete all bans
        $query = 'DELETE FROM ' . sql_table('ban') . ' WHERE blogid=' . $blogid;
        sql_query($query);

        // delete all categories
        $query = 'DELETE FROM ' . sql_table('category') . ' WHERE cblog=' . $blogid;
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('blog', $blogid);

        // delete the blog itself
        $query = 'DELETE FROM ' . sql_table('blog') . ' WHERE bnumber=' . $blogid;
        sql_query($query);

        $param = ['blogid' => $blogid];
        $manager->notify('PostDeleteBlog', $param);

        $this->action_overview(_DELETED_BLOG);
    }

    /**
     * @todo document this
     */
    public function action_memberhalt()
    {
        global $member, $manager;

        $memberid = intRequestVar('memberid');

        if (($member->getID() == $memberid) || (1 != $member->isAdmin())) {
            $this->disallow();
            return;
        }
        //    $this->disallow();

        $mem = MEMBER::createFromID($memberid);

        $this->pagehead();

        $s = "<h2>" . _ADMIN_MEMBER_HALT_CONFIRM_TITLE . "</h2>\n";
        $s .= "<p>" . ($mem->isHalt() ? _ERROR_ADMIN_MEMBER_ALREADY_HALTED : _ADMIN_MEMBER_HALT_CONFIRM_TEXT) . "<br /><br />\n";

        $s .= sprintf("member number : <b>%s</b><br />\n", hsc($mem->getID()));
        $s .= sprintf("%s <b>%s</b><br />\n", _LOGIN_NAME, hsc($mem->getDisplayName()));
        $s .= "<br />\n";
        $s .= sprintf("%s <b>%s</b><br />\n", _MEMBERS_REALNAME, hsc($mem->getRealName()));
        $s .= sprintf(
            "%s : <b>%s</b><br />\n",
            _ADMIN_MEMBER_SUPERADMIN,
            hsc($mem->isAdmin() ? _YES : _NO, null)
        );

        $s .= sprintf(
            "%s : <b>%s</b><br />\n",
            _MEMBERS_CANLOGIN,
            hsc($mem->canLogin() ? _YES : _NO, null)
        );

        $s .= "</b></p>";
        echo $s;

        if ($mem->isHalt()) {
        } else {
            ?>
            <form method="post" action="index.php">
                <div>
                    <input type="hidden" name="action" value="memberhaltconfirm_execute" />
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
                    <input type="submit" tabindex="10" value="<?php echo _ADMIN_MEMBER_HALT_CONFIRM_DONE_BTN ?>" />
                </div>
            </form>
            <?php
        }
        $this->pagefoot();
    }

    public function action_memberhaltconfirm_execute()
    {
        global $member;

        $memberid = intRequestVar('memberid');

        if (($member->getID() == $memberid) || ( ! $member->isAdmin())) {
            $this->disallow();
            return;
        }

        $error = $this->haltOneMember($memberid);
        if ($error) {
            $this->error($error);
        }

        if ($member->isAdmin()) {
            $this->action_usermanagement();
        } else {
            $this->action_overview(_ADMIN_MEMBER_HALT_DONE);
        }
    }

    public function action_memberdelete()
    {
        global $member, $manager;

        $memberid = intRequestVar('memberid');

        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $mem = MEMBER::createFromID($memberid);

        $this->pagehead();

        echo    "<h2>" . _DELETE_CONFIRM . "</h2>";
        echo "<p>" . _CONFIRMTXT_MEMBER . "<br />\n<b>"
            . hsc($mem->getDisplayName()) . "</b></p>";

        $totalposts    = $mem->getTotalPosts();
        $totalcomments = $mem->getTotalComments();
        echo "<p>" . _NUMBER_OF_POST . " : <b>" . $totalposts . "</b></p>";
        echo "<p>" . _NUMBER_OF_COMMENT . " : <b>" . $totalcomments . "</b></p>";

        $canBeDeleted = $mem->canBeDeleted();
        echo "<p>" . _ADMIN_CAN_DELETE . " : <b>" . ($canBeDeleted ? _YES : _NO) . "</b></p>";

        echo "<p>" . _WARNINGTXT_NOTDELMEDIAFILES . "</p>";
        if ( ! $canBeDeleted) {
            echo "<p>" . _ERROR_DELETEMEMBER . "</p>";
        } else {
            ?>
            <form method="post" action="index.php">
                <div>
                    <input type="hidden" name="action" value="memberdeleteconfirm" />
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
                    <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                </div>
            </form>
            <?php
        }
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_memberdeleteconfirm()
    {
        global $member;

        $memberid = intRequestVar('memberid');

        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $error = $this->deleteOneMember($memberid);
        if ($error) {
            $this->error($error);
        }

        if ($member->isAdmin()) {
            $this->action_usermanagement();
        } else {
            $this->action_overview(_DELETED_MEMBER);
        }
    }

    /**
     * @static
     * @todo document this
     */
    public static function deleteOneMember($memberid)
    {
        global $manager;

        $memberid = (int) $memberid;
        $mem      = MEMBER::createFromID($memberid);

        if ( ! $mem->canBeDeleted()) {
            return _ERROR_DELETEMEMBER;
        }

        $param = ['member' => &$mem];
        $manager->notify('PreDeleteMember', $param);

        /* unlink comments from memberid */
        if ($memberid) {
            $query = sprintf(
                "UPDATE %s SET cmember=0, cuser=%s WHERE cmember=%d",
                sql_table('comment'),
                sql_quote_string($mem->getDisplayName()),
                $memberid
            );
            sql_query($query);
        }

        $query = 'DELETE FROM ' . sql_table('member') . ' WHERE mnumber=' . $memberid;
        sql_query($query);

        $query = 'DELETE FROM ' . sql_table('team') . ' WHERE tmember=' . $memberid;
        sql_query($query);

        $query = 'DELETE FROM ' . sql_table('activation') . ' WHERE vmember=' . $memberid;
        sql_query($query);

        // delete member_option
        if (MEMBER::existOptionTable()) {
            $query = 'DELETE FROM ' . sql_table('member_option') . ' WHERE omember=' . $memberid;
            sql_query($query);
        }

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('member', $memberid);

        $param = ['member' => &$mem];
        $manager->notify('PostDeleteMember', $param);

        return '';
    }

    public static function haltOneMember($memberid)
    {
        global $member;

        $memberid = (int) $memberid;
        if ( ! $memberid) {
            return '';
        }

        $mem = MEMBER::createFromID($memberid);

        if ($mem->isHalt()) {
            return _ERROR_ADMIN_MEMBER_ALREADY_HALTED;
        }

        if ($member->id == $mem->id) {
            return _ERROR_ADMIN_MEMBER_HALT_SELF;
        }

        //      $manager->notify('PreStopMember', array('member' => &$mem));

        /* stop member for memberid */
        $ph['mnumber'] = $memberid;
        $query         = 'UPDATE [@prefix@]member SET mhalt=1 WHERE mnumber=[@mnumber@]';
        ob_start();
        sql_query(parseQuery($query));
        $s = ob_get_clean();
        ob_end_clean();
        // ALTER TABLE nucleus_member ADD COLUMN mhalt INTEGER default 0 NOT NULL
        //      $manager->notify('PostStopMember', array('member' => &$mem));

        if ($s) {
            return $s;
        }

        return '';
    }

    /**
     * @todo document this
     */
    public function action_createnewlog()
    {
        global $member, $manager;

        // Only Super-Admins can do this
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        $params = [
           'manager'           => $manager,
           'oAdmin'            => $this,
           'pattern_blog_name' => $this->getInputPattern('blog.name'),
           'blog_offset'       => date("H:i", time()),
           'alert_text'        => escapeHTML(strip_tags(_EBLOG_SHORTNAME.' : '._EBLOG_SHORTNAME_EXTRA)),
        ];

        echo \parseBlade('admin.action_createnewlog', $params), "\n";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_addnewlog()
    {
        global $member, $manager, $CONF;

        // Only Super-Admins can do this
        $member->isAdmin() or $this->disallow();

        $bname       = trim(postVar('name'));
        $bshortname  = trim(postVar('shortname'));
        $btimeoffset = postVar('timeoffset');
        $bdesc       = trim(postVar('desc'));
        $bdefskin    = postVar('defskin');
        $bpublic     = intPostVar('public') ? '1' : '0';
        $bcomments   = intPostVar('comments') ? '1' : '0';
        $breqemail   = intPostVar('reqemail') ? '1' : '0';

        if ( ! isValidShortName($bshortname)) {
            $this->error(_ERROR_BADSHORTBLOGNAME);
        }

        if ($manager->existsBlog($bshortname)) {
            $this->error(_ERROR_DUPSHORTBLOGNAME);
        }

        $param = [
            'name'        => &$bname,
            'shortname'   => &$bshortname,
            'timeoffset'  => &$btimeoffset,
            'description' => &$bdesc,
            'defaultskin' => &$bdefskin,
        ];
        $manager->notify('PreAddBlog', $param);

        // add slashes for sql queries
        $bname       = sql_quote_string($bname);
        $bshortname  = sql_quote_string($bshortname);
        $btimeoffset = sql_quote_string($btimeoffset);
        $bdesc       = sql_quote_string($bdesc);
        $bdefskin    = sql_quote_string($bdefskin);

        // create blog
        $query = 'INSERT INTO ' . sql_table('blog')
            . " (bname, bshortname, bdesc, btimeoffset, bdefskin, bcomments, bpublic, breqemail)"
            . " VALUES ({$bname}, {$bshortname}, {$bdesc}, {$btimeoffset}, {$bdefskin}, {$bcomments}, {$bpublic}, {$breqemail})";
        sql_query($query);
        $blogid = sql_insert_id();
        $blog   = &$manager->getBlog($blogid);

        // create new category
        $catdefname = (defined('_EBLOGDEFAULTCATEGORY_NAME') ? _EBLOGDEFAULTCATEGORY_NAME : 'General');
        $catdefdesc = (defined('_EBLOGDEFAULTCATEGORY_DESC') ? _EBLOGDEFAULTCATEGORY_DESC : 'Items that do not fit in other categories');
        $sql        = sprintf(
            "INSERT INTO %s (cblog, cname, cdesc) VALUES (%d, %s, %s)",
            sql_table('category'),
            $blogid,
            sql_quote_string($catdefname),
            sql_quote_string($catdefdesc)
        );
        sql_query($sql);
        $catid = sql_insert_id();

        // set as default category
        $blog->setDefaultCategory($catid);
        $blog->writeSettings();

        // create team member
        $memberid = $member->getID();
        $query    = 'INSERT INTO ' . sql_table('team') . " (tmember, tblog, tadmin) VALUES ({$memberid}, {$blogid}, 1)";
        sql_query($query);

        $item_deftitle = (defined('_EBLOG_FIRSTITEM_TITLE') ? _EBLOG_FIRSTITEM_TITLE : 'First Item');
        $item_defbody  = (defined('_EBLOG_FIRSTITEM_BODY') ? _EBLOG_FIRSTITEM_BODY : 'This is the first item in your weblog. Feel free to delete it.');

        $new_itemid = $blog->additem($blog->getDefaultCategory(), $item_deftitle, $item_defbody, '', $blogid, $memberid, $blog->getCorrectTime(), 0, 0, 0);
        if ($new_itemid) {
            // change item comment closed : It prevents from unintended comment.
            sql_query(sprintf('UPDATE %s SET iclosed=1 WHERE inumber=%d', sql_table('item'), $new_itemid));
        }

        $param = [
            'blog' => &$blog,
        ];
        $manager->notify('PostAddBlog', $param);

        $param = [
            'blog'        => &$blog,
            'name'        => _EBLOGDEFAULTCATEGORY_NAME,
            'description' => _EBLOGDEFAULTCATEGORY_DESC,
            'catid'       => $catid,
        ];
        $manager->notify('PostAddCategory', $param);

        $this->pagehead();
        ?>
        <h2><?php echo _BLOGCREATED_TITLE ?></h2>

        <p><?php echo sprintf(_BLOGCREATED_ADDEDTXT, hsc($bname)) ?></p>

        <ol>
            <li><a href="#index_php"><?php echo sprintf(_BLOGCREATED_SIMPLEWAY, hsc($bshortname)) ?></a></li>
            <li><a href="#skins"><?php echo _BLOGCREATED_ADVANCEDWAY ?></a></li>
        </ol>

        <h3><a id="index_php"><?php echo sprintf(_BLOGCREATED_SIMPLEDESC1, hsc($bshortname)) ?></a></h3>

        <p><?php echo sprintf(_BLOGCREATED_SIMPLEDESC2, hsc($bshortname)) ?></p>
        <pre><code>&lt;?php
$CONF = array();
$CONF['Self'] = '<b><?php echo hsc($bshortname) ?>.php</b>';

include('<i>./config.php</i>');

selectBlog('<b><?php echo hsc($bshortname) ?></b>');
selector();

?&gt;</code></pre>

        <p><?php echo _BLOGCREATED_SIMPLEDESC3 ?></p>

        <p><?php echo _BLOGCREATED_SIMPLEDESC4 ?></p>

        <form action="index.php" method="post">
            <div>
                <input type="hidden" name="action" value="addnewlog2" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="blogid" value="<?php echo (int) $blogid ?>" />
                <table>
                    <tr>
                        <td><?php echo _EBLOG_URL ?></td>
                        <td><input name="url" maxlength="100" size="40" value="<?php echo hsc($CONF['IndexURL'] . $bshortname . '.php') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CREATE ?></td>
                        <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
                    </tr>
                </table>
            </div>
        </form>

        <h3><a id="skins"><?php echo _BLOGCREATED_ADVANCEDWAY2 ?></a></h3>

        <p><?php echo _BLOGCREATED_ADVANCEDWAY3 ?></p>

        <form action="index.php" method="post">
            <div>
                <input type="hidden" name="action" value="addnewlog2" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="blogid" value="<?php echo (int) $blogid ?>" />
                <table>
                    <tr>
                        <td><?php echo _EBLOG_URL ?></td>
                        <td><input name="url" maxlength="100" size="40" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _EBLOG_CREATE ?></td>
                        <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
                    </tr>
                </table>
            </div>
        </form>

        <?php $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_addnewlog2()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $burl = requestVar('url');

        $blog = &$manager->getBlog($blogid);
        $blog->setURL(trim($burl));
        $blog->writeSettings();

        $this->action_overview(_MSG_NEWBLOG);
    }

    /**
     * @todo document this
     */
    public function action_skinieoverview()
    {
        global $member, $DIR_LIBS, $manager;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        if (CONF::asInt('DatabaseVersion') < NUCLEUS_DATABASE_VERSION_ID) {
            printf('<p class="note">%s</p>', _ADMIN_TEXT_UPGRADE_REQUIRED);
            $this->pagefoot();
            return;
        }

        ?>
        <h2><?php echo _SKINIE_TITLE_IMPORT ?></h2>

        <div><label for="skinie_import_local"><?php echo _SKINIE_LOCAL ?></label>
            <?php global $DIR_SKINS;

        if ( ! @is_dir($DIR_SKINS) && ! @is_readable($DIR_SKINS)) {
            $candidates = false;
            if ( ! @is_dir($DIR_SKINS)) {
                printf('<p class="note">%s : $DIR_SKINS: %s</p>', _WARNING_NOTADIR, escapeHTML($DIR_SKINS));
            } elseif ( ! @is_readable($DIR_SKINS)) {
                printf('<p class="note">$DIR_SKINS: %s</p>', _WARNING_NOTREADABLE);
            }
        } else {
            $candidates = SKINIMPORT::searchForCandidates($DIR_SKINS);
        }

        if ( ! empty($candidates) && count($candidates) > 0) {
            ?>
                <form method="post" action="index.php">
                    <div>
                        <input type="hidden" name="action" value="skinieimport" />
                        <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="mode" value="file" />
                        <select name="skinfile" id="skinie_import_local">
                            <?php foreach ($candidates as $skinname => $skinfile) {
                                $html = hsc($skinfile);
                                echo '<option value="', $html, '">', $skinname, '</option>';
                            }
            ?>
                        </select>
                        <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT ?>" />
                    </div>
                </form>
            <?php                   } else {
                echo _SKINIE_NOCANDIDATES;
            }
        ?>
        </div>

        <p><em><?php echo _OR ?></em></p>

        <form method="post" action="index.php">
            <p>
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="action" value="skinieimport" />
                <input type="hidden" name="mode" value="url" />
                <label for="skinie_import_url"><?php echo _SKINIE_FROMURL ?></label>
                <input type="text" name="skinfile" id="skinie_import_url" size="60" value="http://" />
                <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT ?>" />
            </p>
        </form>


        <h2><?php echo _SKINIE_TITLE_EXPORT ?></h2>
        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="skinieexport" />
                <?php $manager->addTicketHidden() ?>

                <p><?php echo _SKINIE_EXPORT_INTRO ?></p>

                <table>
                    <tr>
                        <th colspan="2"><?php echo _SKINIE_EXPORT_SKINS ?></th>
                    </tr>
                    <tr>
                        <?php       // show list of skins
                    $res = sql_query(sprintf("SELECT * FROM %s ORDER BY sdname", sql_table('skin_desc')));
        while ($skinObj = sql_fetch_object($res)) {
            $id = 'skinexp' . $skinObj->sdnumber;
            echo '<td><input type="checkbox" name="skin[', $skinObj->sdnumber, ']"  id="', $id, '" />';
            echo '<label for="', $id, '">', hsc($skinObj->sdname), '</label></td>';
            echo '<td>', hsc($skinObj->sddesc), '</td>';
            echo '</tr><tr>';
        }

        echo '<th colspan="2">', _SKINIE_EXPORT_TEMPLATES, '</th></tr><tr>';

        // show list of templates
        $res = sql_query(sprintf("SELECT * FROM %s ORDER BY tdname", sql_table('template_desc')));
        while ($templateObj = sql_fetch_object($res)) {
            $id = 'templateexp' . $templateObj->tdnumber;
            echo '<td><input type="checkbox" name="template[', $templateObj->tdnumber, ']" id="', $id, '" />';
            echo '<label for="', $id, '">', hsc($templateObj->tdname), '</label></td>';
            echo '<td>', hsc($templateObj->tddesc), '</td>';
            echo '</tr><tr>';
        }

        ?>
                        <th colspan="2"><?php echo _SKINIE_EXPORT_EXTRA ?></th>
                    </tr>
                    <tr>
                        <td colspan="2"><textarea cols="40" rows="5" name="info"></textarea></td>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _SKINIE_TITLE_EXPORT ?></th>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="<?php echo _SKINIE_BTN_EXPORT ?>" /></td>
                    </tr>
                </table>
            </div>
        </form>

        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skinieimport()
    {
        global $member, $DIR_LIBS, $DIR_SKINS, $manager;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $skinFileRaw = postVar('skinfile');
        $mode        = postVar('mode');

        $importer = new SKINIMPORT();

        // get full filename
        if ('file' == $mode) {
            $skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';

            // backwards compatibilty (in v2.0, exports were saved as skindata.xml)
            if ( ! is_file($skinFile)) {
                $skinFile = $DIR_SKINS . $skinFileRaw . '/skindata.xml';
            }
        } else {
            $skinFile = $skinFileRaw;
        }

        // read only metadata
        $error = $importer->readFile($skinFile, 1);

        // clashes
        $skinNameClashes     = $importer->checkSkinNameClashes();
        $templateNameClashes = $importer->checkTemplateNameClashes();
        $hasNameClashes      = (count($skinNameClashes) > 0) || (count($templateNameClashes) > 0);

        if ($error) {
            $this->error($error);
        }

        $this->pagehead();

        echo '<p><a href="index.php?action=skinieoverview">(', _BACK, ')</a></p>';
        ?>
        <h2><?php echo _SKINIE_CONFIRM_TITLE ?></h2>

        <ul>
            <li>
                <p><strong><?php echo _SKINIE_INFO_GENERAL ?></strong> <?php echo hsc($importer->getInfo()) ?></p>
            </li>
            <li>
                <p><strong><?php echo _SKINIE_INFO_SKINS ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $importer->getSkinNames()) ?></p>
            </li>
            <li>
                <p><strong><?php echo _SKINIE_INFO_TEMPLATES ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $importer->getTemplateNames()) ?></p>
            </li>
            <?php
            if ($hasNameClashes) {
                ?>
                <li>
                    <p><strong style="color: red;"><?php echo _SKINIE_INFO_SKINCLASH ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $skinNameClashes) ?></p>
                </li>
                <li>
                    <p><strong style="color: red;"><?php echo _SKINIE_INFO_TEMPLCLASH ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $templateNameClashes) ?></p>
                </li>
                <?php
            } // if (hasNameClashes)
        ?>
        </ul>

        <form method="post" action="index.php">
            <div>
                <input type="hidden" name="action" value="skiniedoimport" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="skinfile" value="<?php echo hsc(postVar('skinfile')) ?>" />
                <input type="hidden" name="mode" value="<?php echo hsc($mode) ?>" />
                <input type="submit" value="<?php echo _SKINIE_CONFIRM_IMPORT ?>" />
                <?php
            if ($hasNameClashes) {
                ?>
                    <br />
                    <input type="checkbox" name="overwrite" value="1" id="cb_overwrite" /><label for="cb_overwrite"><?php echo _SKINIE_CONFIRM_OVERWRITE ?></label>
                    <?php
            } // if (hasNameClashes)
        ?>
            </div>
        </form>


        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skiniedoimport()
    {
        global $member, $DIR_LIBS, $DIR_SKINS;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $skinFileRaw = postVar('skinfile');
        $mode        = postVar('mode');

        $allowOverwrite = intPostVar('overwrite');

        // get full filename
        if ('file' == $mode) {
            $skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';

            // backwards compatibilty (in v2.0, exports were saved as skindata.xml)
            if ( ! is_file($skinFile)) {
                $skinFile = $DIR_SKINS . $skinFileRaw . '/skindata.xml';
            }
        } else {
            $skinFile = $skinFileRaw;
        }

        $importer = new SKINIMPORT();

        $error = $importer->readFile($skinFile);

        if ($error) {
            $this->error($error);
        }

        $error = $importer->writeToDatabase($allowOverwrite);

        if ($error) {
            $this->error($error);
        }

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';
        ?>
        <h2><?php echo _SKINIE_DONE ?></h2>

        <ul>
            <li>
                <p><strong><?php echo _SKINIE_INFO_GENERAL ?></strong> <?php echo hsc($importer->getInfo()) ?></p>
            </li>
            <li>
                <p><strong><?php echo _SKINIE_INFO_IMPORTEDSKINS ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $importer->getSkinNames()) ?></p>
            </li>
            <li>
                <p><strong><?php echo _SKINIE_INFO_IMPORTEDTEMPLS ?></strong> <?php echo implode(' <em>' . _AND . '</em> ', $importer->getTemplateNames()) ?></p>
            </li>
        </ul>

        <?php $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skinieexport()
    {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $aSkins     = requestIntArray('skin');
        $aTemplates = requestIntArray('template');

        if ( ! is_array($aTemplates)) {
            $aTemplates = [];
        }
        if ( ! is_array($aSkins)) {
            $aSkins = [];
        }

        $skinList     = array_keys($aSkins);
        $templateList = array_keys($aTemplates);

        $info = postVar('info');

        $exporter = new SKINEXPORT();
        foreach ($skinList as $skinId) {
            $exporter->addSkin($skinId);
        }
        foreach ($templateList as $templateId) {
            $exporter->addTemplate($templateId);
        }
        $exporter->setInfo($info);

        $exporter->export();
    }

    /**
     * @todo document this
     */
    public function action_templateoverview()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        echo '<h2>' . _TEMPLATE_TITLE . '</h2>';
        echo '<h3>' . _TEMPLATE_AVAILABLE_TITLE . '</h3>';

        $query                = sprintf("SELECT * FROM %s ORDER BY tdname", sql_table('template_desc'));
        $template['content']  = 'templatelist';
        $template['tabindex'] = 10;
        showlist_by_query($query, 'table', $template);

        echo '<h3>' . _TEMPLATE_NEW_TITLE . '</h3>';

        ?>
        <form method="post" action="index.php">
            <div>

                <input name="action" value="templatenew" type="hidden" />
                <?php $manager->addTicketHidden() ?>
                <table>
                    <tr>
                        <td><?php echo _TEMPLATE_NAME ?> <?php help('shortnames'); ?></td>
                        <td><input name="name" tabindex="10010" maxlength="20" size="20" required pattern="<?php echo $this->getInputPattern('template.name') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_DESC ?></td>
                        <td><input name="desc" tabindex="10020" maxlength="200" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_CREATE ?></td>
                        <td><input type="submit" tabindex="10030" value="<?php echo _TEMPLATE_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
                    </tr>
                </table>

            </div>
        </form>

        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_templateedit($msg = '')
    {
        global $member, $manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        $extrahead = '<script type="text/javascript" src="javascript/templateEdit.js"></script>';
        $extrahead .= sprintf('<script type="text/javascript">setTemplateEditText("%s");</script>', sql_real_escape_string(_EDITTEMPLATE_EMPTY));

        $this->pagehead($extrahead);

        $templatename        = TEMPLATE::getNameFromId($templateid);
        $templatedescription = TEMPLATE::getDesc($templateid);
        $template            = &$manager->getTemplate($templatename);

        ?>
        <p>
            <a href="index.php?action=templateoverview">(<?php echo _TEMPLATE_BACK ?>)</a>
        </p>

        <h2><?php echo _TEMPLATE_EDIT_TITLE ?> '<?php echo  hsc($templatename); ?>'</h2>

        <?php
        if ($msg) {
            echo sprintf('<p>%s: %s</p>', _MESSAGE, $msg);
        }
        ?>

        <p><?php echo _TEMPLATE_EDIT_MSG ?></p>

        <form method="post" action="index.php">
            <div>

                <input type="hidden" name="action" value="templateupdate" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="templateid" value="<?php echo  $templateid; ?>" />

                <table>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_SETTINGS ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_NAME ?> <?php help('shortnames'); ?></td>
                        <td><input name="tname" tabindex="4" size="20" maxlength="20" value="<?php echo  hsc($templatename) ?>" required pattern="<?php echo $this->getInputPattern('template.name') ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_DESC ?></td>
                        <td><input name="tdesc" tabindex="5" size="50" maxlength="200" value="<?php echo  hsc($templatedescription) ?>" /></td>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_UPDATE ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_UPDATE ?></td>
                        <td>
                            <input type="submit" tabindex="6" value="<?php echo _TEMPLATE_UPDATE_BTN ?>" onclick="return checkSubmit();" />
                            <input type="reset" tabindex="7" value="<?php echo _TEMPLATE_RESET_BTN ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_ITEMS ?> <?php help('templateitems'); ?></th>
                        <?php
                        $this->_templateEditRow($template, _TEMPLATE_ITEMHEADER, 'ITEM_HEADER', '', 8);
        $this->_templateEditRow($template, _TEMPLATE_ITEMBODY, 'ITEM', '', 9, 1);
        $this->_templateEditRow($template, _TEMPLATE_ITEMFOOTER, 'ITEM_FOOTER', '', 10);
        $this->_templateEditRow($template, _TEMPLATE_MORELINK, 'MORELINK', 'morelink', 20);
        $this->_templateEditRow($template, _TEMPLATE_EDITLINK, 'EDITLINK', 'editlink', 25);
        $this->_templateEditRow($template, _TEMPLATE_NEW, 'NEW', 'new', 30);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_COMMENTS_ANY ?> <?php help('templatecomments'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_CHEADER, 'COMMENTS_HEADER', 'commentheaders', 40);
        $this->_templateEditRow($template, _TEMPLATE_CBODY, 'COMMENTS_BODY', 'commentbody', 50, 1);
        $this->_templateEditRow($template, _TEMPLATE_CFOOTER, 'COMMENTS_FOOTER', 'commentheaders', 60);
        $this->_templateEditRow($template, _TEMPLATE_CONE, 'COMMENTS_ONE', 'commentwords', 70);
        $this->_templateEditRow($template, _TEMPLATE_CMANY, 'COMMENTS_MANY', 'commentwords', 80);
        $this->_templateEditRow($template, _TEMPLATE_CMORE, 'COMMENTS_CONTINUED', 'commentcontinued', 90);
        $this->_templateEditRow($template, _TEMPLATE_CMEXTRA, 'COMMENTS_AUTH', 'memberextra', 100);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_COMMENTS_NONE ?> <?php help('templatecomments'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_CNONE, 'COMMENTS_NONE', '', 110);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_COMMENTS_TOOMUCH ?> <?php help('templatecomments'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_CTOOMUCH, 'COMMENTS_TOOMUCH', '', 120);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_ARCHIVELIST ?> <?php help('templatearchivelists'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_AHEADER, 'ARCHIVELIST_HEADER', '', 130);
        $this->_templateEditRow($template, _TEMPLATE_AITEM, 'ARCHIVELIST_LISTITEM', '', 140);
        $this->_templateEditRow($template, _TEMPLATE_AFOOTER, 'ARCHIVELIST_FOOTER', '', 150);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_BLOGLIST ?> <?php help('templatebloglists'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_BLOGHEADER, 'BLOGLIST_HEADER', '', 160);
        $this->_templateEditRow($template, _TEMPLATE_BLOGITEM, 'BLOGLIST_LISTITEM', '', 170);
        $this->_templateEditRow($template, _TEMPLATE_BLOGFOOTER, 'BLOGLIST_FOOTER', '', 180);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_CATEGORYLIST ?> <?php help('templatecategorylists'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_CATHEADER, 'CATLIST_HEADER', '', 190);
        $this->_templateEditRow($template, _TEMPLATE_CATITEM, 'CATLIST_LISTITEM', '', 200);
        $this->_templateEditRow($template, _TEMPLATE_CATFOOTER, 'CATLIST_FOOTER', '', 210);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_DATETIME ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_DHEADER, 'DATE_HEADER', 'dateheads', 220);
        $this->_templateEditRow($template, _TEMPLATE_DFOOTER, 'DATE_FOOTER', 'dateheads', 230);
        $this->_templateEditRow($template, _TEMPLATE_DFORMAT, 'FORMAT_DATE', 'datetime', 240);
        $this->_templateEditRow($template, _TEMPLATE_TFORMAT, 'FORMAT_TIME', 'datetime', 250);
        $this->_templateEditRow($template, _TEMPLATE_LOCALE, 'LOCALE', 'locale', 260);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_IMAGE ?> <?php help('templatepopups'); ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_PCODE, 'POPUP_CODE', '', 270);
        $this->_templateEditRow($template, _TEMPLATE_ICODE, 'IMAGE_CODE', '', 280);
        $this->_templateEditRow($template, _TEMPLATE_MCODE, 'MEDIA_CODE', '', 290);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_SEARCH ?></th>
                        <?php
        $this->_templateEditRow($template, _TEMPLATE_SHIGHLIGHT, 'SEARCH_HIGHLIGHT', 'highlight', 300);
        $this->_templateEditRow($template, _TEMPLATE_SNOTFOUND, 'SEARCH_NOTHINGFOUND', 'nothingfound', 310);
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_PLUGIN_FIELDS ?></th>
                        <?php
        $tab          = 600;
        $pluginfields = [];
        $param        = ['fields' => &$pluginfields];
        $manager->notify('TemplateExtraFields', $param);

        foreach ($pluginfields as $pfkey => $pfvalue) {
            echo "</tr><tr>\n";
            echo '<th colspan="2">' . htmlentities($pfkey, ENT_QUOTES, _CHARSET) . "</th>\n";
            foreach ($pfvalue as $pffield => $pfdesc) {
                $this->_templateEditRow($template, $pfdesc, $pffield, '', ++$tab, 0);
            }
        }
        ?>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo _TEMPLATE_UPDATE ?></th>
                    </tr>
                    <tr>
                        <td><?php echo _TEMPLATE_UPDATE ?></td>
                        <td>
                            <input type="submit" tabindex="800" value="<?php echo _TEMPLATE_UPDATE_BTN ?>" onclick="return checkSubmit();" />
                            <input type="reset" tabindex="810" value="<?php echo _TEMPLATE_RESET_BTN ?>" />
                        </td>
                    </tr>
                </table>

            </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function _templateEditRow(&$template, $description, $name, $help = '', $tabindex = 0, $big = 0)
    {
        static $count = 1;
        if ( ! isset($template[$name])) {
            $template[$name] = '';
        }
        ?>
        </tr>
        <tr>
            <td><?php echo $description ?> <?php if ($help) {
                help('template' . $help);
            } ?></td>
            <td id="td<?php echo $count ?>"><textarea class="templateedit" name="<?php echo $name ?>" tabindex="<?php echo $tabindex ?>" cols="50" rows="<?php echo $big ? 10 : 5 ?>" id="textarea<?php echo $count ?>"><?php echo  hsc($template[$name]); ?></textarea></td>
        <?php $count++;
    }

    /**
     * @todo document this
     */
    public function action_templateupdate()
    {
        global $member, $manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        $name = postVar('tname');
        $desc = postVar('tdesc');

        if ( ! isValidTemplateName($name)) {
            $this->error(_ERROR_BADTEMPLATENAME);
        }

        if (TEMPLATE::getNameFromId($templateid) != $name && TEMPLATE::exists($name)) {
            $this->error(_ERROR_DUPTEMPLATENAME);
        }

        // 0. clear SqlCache
        $manager->clearCachedInfo('sql_fetch_object');

        // 1. Remove all template parts
        $query = parseQuery(
            'DELETE FROM [@prefix@]template WHERE tdesc=[@templateid@]',
            ['templateid' => $templateid]
        );
        sql_query($query);

        // 2. Update description
        $query = parseQuery(
            "UPDATE [@prefix@]template_desc SET tdname='[@tdname@]', tddesc='[@tddesc@]' WHERE tdnumber=[@tdnumber@]",
            [
                'tdname' => sql_real_escape_string($name), 'tddesc' => sql_real_escape_string($desc), 'tdnumber' => $templateid,
            ]
        );
        sql_query($query);

        // 3. Add non-empty template parts
        $this->addToTemplate($templateid, 'ITEM_HEADER', postVar('ITEM_HEADER'));
        $this->addToTemplate($templateid, 'ITEM', postVar('ITEM'));
        $this->addToTemplate($templateid, 'ITEM_FOOTER', postVar('ITEM_FOOTER'));
        $this->addToTemplate($templateid, 'MORELINK', postVar('MORELINK'));
        $this->addToTemplate($templateid, 'EDITLINK', postVar('EDITLINK'));
        $this->addToTemplate($templateid, 'NEW', postVar('NEW'));
        $this->addToTemplate($templateid, 'COMMENTS_HEADER', postVar('COMMENTS_HEADER'));
        $this->addToTemplate($templateid, 'COMMENTS_BODY', postVar('COMMENTS_BODY'));
        $this->addToTemplate($templateid, 'COMMENTS_FOOTER', postVar('COMMENTS_FOOTER'));
        $this->addToTemplate($templateid, 'COMMENTS_CONTINUED', postVar('COMMENTS_CONTINUED'));
        $this->addToTemplate($templateid, 'COMMENTS_TOOMUCH', postVar('COMMENTS_TOOMUCH'));
        $this->addToTemplate($templateid, 'COMMENTS_AUTH', postVar('COMMENTS_AUTH'));
        $this->addToTemplate($templateid, 'COMMENTS_ONE', postVar('COMMENTS_ONE'));
        $this->addToTemplate($templateid, 'COMMENTS_MANY', postVar('COMMENTS_MANY'));
        $this->addToTemplate($templateid, 'COMMENTS_NONE', postVar('COMMENTS_NONE'));
        $this->addToTemplate($templateid, 'ARCHIVELIST_HEADER', postVar('ARCHIVELIST_HEADER'));
        $this->addToTemplate($templateid, 'ARCHIVELIST_LISTITEM', postVar('ARCHIVELIST_LISTITEM'));
        $this->addToTemplate($templateid, 'ARCHIVELIST_FOOTER', postVar('ARCHIVELIST_FOOTER'));
        $this->addToTemplate($templateid, 'BLOGLIST_HEADER', postVar('BLOGLIST_HEADER'));
        $this->addToTemplate($templateid, 'BLOGLIST_LISTITEM', postVar('BLOGLIST_LISTITEM'));
        $this->addToTemplate($templateid, 'BLOGLIST_FOOTER', postVar('BLOGLIST_FOOTER'));
        $this->addToTemplate($templateid, 'CATLIST_HEADER', postVar('CATLIST_HEADER'));
        $this->addToTemplate($templateid, 'CATLIST_LISTITEM', postVar('CATLIST_LISTITEM'));
        $this->addToTemplate($templateid, 'CATLIST_FOOTER', postVar('CATLIST_FOOTER'));
        $this->addToTemplate($templateid, 'DATE_HEADER', postVar('DATE_HEADER'));
        $this->addToTemplate($templateid, 'DATE_FOOTER', postVar('DATE_FOOTER'));
        $this->addToTemplate($templateid, 'FORMAT_DATE', postVar('FORMAT_DATE'));
        $this->addToTemplate($templateid, 'FORMAT_TIME', postVar('FORMAT_TIME'));
        $this->addToTemplate($templateid, 'LOCALE', postVar('LOCALE'));
        $this->addToTemplate($templateid, 'SEARCH_HIGHLIGHT', postVar('SEARCH_HIGHLIGHT'));
        $this->addToTemplate($templateid, 'SEARCH_NOTHINGFOUND', postVar('SEARCH_NOTHINGFOUND'));
        $this->addToTemplate($templateid, 'POPUP_CODE', postVar('POPUP_CODE'));
        $this->addToTemplate($templateid, 'MEDIA_CODE', postVar('MEDIA_CODE'));
        $this->addToTemplate($templateid, 'IMAGE_CODE', postVar('IMAGE_CODE'));

        $pluginfields = [];
        $param        = ['fields' => &$pluginfields];
        $manager->notify('TemplateExtraFields', $param);
        foreach ($pluginfields as $pfkey => $pfvalue) {
            foreach ($pfvalue as $pffield => $pfdesc) {
                $this->addToTemplate($templateid, $pffield, postVar($pffield));
            }
        }

        // jump back to template edit
        $this->action_templateedit(_TEMPLATE_UPDATED);
    }

    /**
     * @todo document this
     */
    public function addToTemplate($id, $partname, $content)
    {
        $id = (int) $id;

        // don't add empty parts:
        if ( ! trim($content)) {
            return -1;
        }

        $partname = sql_quote_string($partname);
        $content  = sql_quote_string($content);

        $query = sprintf(
            'INSERT INTO %s (tdesc, tpartname, tcontent) VALUES (%s,%s,%s)',
            sql_table('template'),
            $id,
            $partname,
            $content
        );
        sql_query($query) or exit(_ADMIN_SQLDIE_QUERYERROR . sql_error());
        return sql_insert_id();
    }

    /**
     * @todo document this
     */
    public function action_templatedelete()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $templateid = intRequestVar('templateid');
        // TODO: check if template can be deleted

        $this->pagehead();

        $name = TEMPLATE::getNameFromId($templateid);
        $desc = TEMPLATE::getDesc($templateid);

        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p>
                <?php echo _CONFIRMTXT_TEMPLATE ?><b><?php echo hsc($name) ?></b> (<?php echo  hsc($desc) ?>)
            </p>

            <form method="post" action="index.php">
                <div>
                    <input type="hidden" name="action" value="templatedeleteconfirm" />
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="templateid" value="<?php echo  $templateid ?>" />
                    <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                </div>
            </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_templatedeleteconfirm()
    {
        global $member, $manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        $param = ['templateid' => $templateid];
        $manager->notify('PreDeleteTemplate', $param);

        // 1. delete description
        sql_query(sprintf(
            'DELETE FROM %s WHERE tdnumber=%s',
            sql_table('template_desc'),
            $templateid
        ));

        // 2. delete parts
        sql_query(sprintf(
            'DELETE FROM %s WHERE tdesc=%s',
            sql_table('template'),
            $templateid
        ));

        $param = ['templateid' => $templateid];
        $manager->notify('PostDeleteTemplate', $param);

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    public function action_templatenew()
    {
        global $member;

        $member->isAdmin() or $this->disallow();

        $name = postVar('name');
        $desc = postVar('desc');

        if ( ! isValidTemplateName($name)) {
            $this->error(_ERROR_BADTEMPLATENAME);
        }

        if (TEMPLATE::exists($name)) {
            $this->error(_ERROR_DUPTEMPLATENAME);
        }

        $newTemplateId = TEMPLATE::createNew($name, $desc);

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    public function action_templateclone()
    {
        global $member;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        // 1. read old template
        $name = TEMPLATE::getNameFromId($templateid);
        $desc = TEMPLATE::getDesc($templateid);

        // 2. create desc thing
        $name = "cloned" . $name;

        // if a template with that name already exists:
        if (TEMPLATE::exists($name)) {
            $i = 1;
            while (TEMPLATE::exists($name . $i)) {
                $i++;
            }
            $name .= $i;
        }

        $newid = TEMPLATE::createNew($name, $desc);

        // 3. create clone
        // go through parts of old template and add them to the new one
        $res = sql_query(sprintf(
            'SELECT tpartname, tcontent FROM %s WHERE tdesc=%s',
            sql_table('template'),
            $templateid
        ));
        while ($o = sql_fetch_object($res)) {
            $this->addToTemplate($newid, $o->tpartname, $o->tcontent);
        }

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    public function action_skinoverview()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        $params = [
           'manager'           => $manager,
           'pattern_skin_name' => $this->getInputPattern('skin.name'),
        ];
        echo \parseBlade('admin.action_skinoverview', $params), "\n";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skinnew()
    {
        global $member;

        $member->isAdmin() or $this->disallow();

        $name = trim(postVar('name'));
        $desc = trim(postVar('desc'));

        if ( ! isValidSkinName($name)) {
            $this->error(_ERROR_BADSKINNAME);
        }

        if (SKIN::exists($name)) {
            $this->error(_ERROR_DUPSKINNAME);
        }

        $newId = SKIN::createNew($name, $desc);

        $this->action_skinoverview();
    }

    /**
     * @todo document this
     */
    public function action_skinedit()
    {
        global $member, $manager;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        $skin = new SKIN($skinid);

        $this->pagehead();
        ?>
            <p>
                <a href="index.php?action=skinoverview">(<?php echo _SKIN_BACK ?>)</a>
            </p>
            <h2><?php echo _SKIN_EDITONE_TITLE ?> '<?php echo  $skin->getName() ?>'</h2>

            <h3><?php echo _SKIN_PARTS_TITLE ?></h3>
            <?php echo _SKIN_PARTS_MSG ?>
            <ul>
                <li><a tabindex="10" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=index"><?php echo _SKIN_PART_MAIN ?></a> <?php help('skinpartindex') ?></li>
                <li><a tabindex="20" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=item"><?php echo _SKIN_PART_ITEM ?></a> <?php help('skinpartitem') ?></li>
                <li><a tabindex="30" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=archivelist"><?php echo _SKIN_PART_ALIST ?></a> <?php help('skinpartarchivelist') ?></li>
                <li><a tabindex="40" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=archive"><?php echo _SKIN_PART_ARCHIVE ?></a> <?php help('skinpartarchive') ?></li>
                <li><a tabindex="50" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=search"><?php echo _SKIN_PART_SEARCH ?></a> <?php help('skinpartsearch') ?></li>
                <li><a tabindex="60" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=error"><?php echo _SKIN_PART_ERROR ?></a> <?php help('skinparterror') ?></li>
                <li><a tabindex="70" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=member"><?php echo _SKIN_PART_MEMBER ?></a> <?php help('skinpartmember') ?></li>
                <li><a tabindex="75" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=imagepopup"><?php echo _SKIN_PART_POPUP ?></a> <?php help('skinpartimagepopup') ?></li>
            </ul>

            <?php

            $has_spartstype = sql_existTableColumnName(sql_table('skin'), 'spartstype');
        $query              = sprintf("SELECT stype FROM %s WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member') and sdesc = %s", sql_table('skin'), $skinid);
        if ($has_spartstype) {
            $query .= " AND spartstype = 'parts'";
        }
        $res = sql_query($query);

        echo '<h3>' . _SKIN_PARTS_SPECIAL . ' ' . helpHtml('skinpartspecial') . '</h3>';
        echo '<form method="get" action="index.php">' . "\r\n";
        echo '<input type="hidden" name="action" value="skinedittype" />' . "\r\n";
        echo '<input type="hidden" name="skinid" value="' . $skinid . '" />' . "\r\n";
        echo '<input name="type" tabindex="89" size="20" maxlength="20" required pattern="'.$this->getInputPattern('skin.partspecial').'" />' . "\r\n";
        echo '<input type="submit" tabindex="140" value="' . _SKIN_CREATE . '" onclick="return checkSubmit();" />' . "\r\n";
        echo '</form>' . "\r\n";

        if ($res) {
            $tabstart = 75;
            $s        = '';
            while ($row = sql_fetch_assoc($res)) {
                $url_edit = sprintf(
                    "index.php?action=skinedittype&amp;skinid=%d&amp;type=%s",
                    $skinid,
                    hsc(strtolower($row['stype']))
                );
                $url_delete = sprintf(
                    "index.php?action=skinremovetype&amp;skinid=%d&amp;type=%s",
                    $skinid,
                    hsc(strtolower($row['stype']))
                );
                $url_change = sprintf(
                    "index.php?action=skinchangestype&amp;skinid=%d&amp;type=%s",
                    $skinid,
                    hsc(strtolower($row['stype']))
                );
                $s .= '<li>'
                    . sprintf('<a tabindex="%d" href="%s">%s</a>', ($tabstart++), $url_edit, escapeHTML($row['stype']))
                    . sprintf(' <a tabindex="%d" href="%s">(%s)</a>', ($tabstart++), $url_delete, escapeHTML(_LISTS_DELETE))
                    . sprintf(' <a tabindex="%d" href="%s">(%s)</a>', ($tabstart++), $url_change, escapeHTML(_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PAGE))
                    . '</li>';
            }
            if ($s) {
                echo '<ul>' . $s . '</ul>';
            }
        }

        echo '<h3>' . escapeHTML(_SKIN_PARTS_SPECIAL_PAGE) . ' ' . helpHtml('skinpartspecialpage') . '</h3>';
        echo '<form method="get" action="index.php">' . "\r\n";
        echo '<input type="hidden" name="action" value="skinedittype" />' . "\r\n";
        echo '<input type="hidden" name="skinid" value="' . $skinid . '" />' . "\r\n";
        echo '<input type="hidden" name="partstype" value="specialpage" />' . "\r\n";
        echo '<input name="type" tabindex="89" size="20" maxlength="20" required pattern="'.$this->getInputPattern('skin.partspecialpage').'" />' . "\r\n";
        echo '<input type="submit" tabindex="140" value="' . _SKIN_CREATE . '" onclick="return checkSubmit();" />' . "\r\n";
        echo '</form>' . "\r\n";

        $query = sprintf("SELECT stype FROM %s WHERE spartstype = 'specialpage' AND sdesc = %s", sql_table('skin'), $skinid);
        if ($has_spartstype) {
            $res = sql_query($query);
        }
        if ($has_spartstype && $res) {
            $s = '';
            while ($row = sql_fetch_assoc($res)) {
                $s .= '<li>';
                $s .= sprintf(
                    '<a tabindex="%d" href="index.php?action=skinedittype&amp;skinid=%d&amp;partstype=specialpage&amp;type=%s">%s</a>',
                    ($tabstart++),
                    $skinid,
                    hsc(strtolower($row['stype'])),
                    hsc($row['stype'])
                );
                $s .= sprintf(
                    ' (<a tabindex="%d" href="index.php?action=skinremovetype&amp;skinid=%d&amp;partstype=specialpage&amp;type=%s">%s</a>)',
                    ($tabstart++),
                    $skinid,
                    hsc(strtolower($row['stype'])),
                    escapeHTML(_LISTS_DELETE)
                );
                $s .= sprintf(
                    ' (<a tabindex="%d" href="index.php?action=skinchangestype&amp;skinid=%d&amp;partstype=specialpage&amp;type=%s">%s</a>)',
                    ($tabstart++),
                    $skinid,
                    hsc(strtolower($row['stype'])),
                    escapeHTML(_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PARTS)
                );
                $s .= '</li>';
            }
            if ($s) {
                echo '<ul>' . $s . '</ul>';
            }
        }

        ?>

            <h3><?php echo _SKIN_GENSETTINGS_TITLE; ?></h3>
            <form method="post" action="index.php">
                <div>

                    <input type="hidden" name="action" value="skineditgeneral" />
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
                    <table>
                        <tr>
                            <td><?php echo _SKIN_NAME ?> <?php help('shortnames'); ?></td>
                            <td><input name="name" tabindex="90" value="<?php echo  hsc($skin->getName()) ?>" maxlength="20" size="20" required pattern="<?php echo $this->getInputPattern('skin.name') ?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo _SKIN_DESC ?></td>
                            <td><input name="desc" tabindex="100" value="<?php echo  hsc($skin->getDescription()) ?>" maxlength="200" /></td>
                        </tr>
                        <tr>
                            <td><?php echo _SKIN_TYPE ?></td>
                            <td><input name="type" tabindex="110" value="<?php echo  hsc($skin->getContentType()) ?>" maxlength="40" size="20" /></td>
                        </tr>
                        <tr>
                            <td><?php echo _SKIN_INCLUDE_MODE ?> <?php help('includemode') ?></td>
                            <td><?php $this->input_yesno('inc_mode', $skin->getIncludeMode(), 120, 'skindir', 'normal', _PARSER_INCMODE_SKINDIR, _PARSER_INCMODE_NORMAL); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo _SKIN_INCLUDE_PREFIX ?> <?php help('includeprefix') ?></td>
                            <td><input name="inc_prefix" tabindex="130" value="<?php echo  hsc($skin->getIncludePrefix()) ?>" maxlength="40" size="20" /></td>
                        </tr>
                        <tr>
                            <td><?php echo _SKIN_CHANGE ?></td>
                            <td><input type="submit" tabindex="140" value="<?php echo _SKIN_CHANGE_BTN ?>" onclick="return checkSubmit();" /></td>
                        </tr>
                    </table>

                </div>
            </form>


        <?php $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skineditgeneral()
    {
        global $member;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        $name       = postVar('name');
        $desc       = postVar('desc');
        $type       = postVar('type');
        $inc_mode   = postVar('inc_mode');
        $inc_prefix = postVar('inc_prefix');

        $skin = new SKIN($skinid);

        // 1. Some checks
        if ( ! isValidSkinName($name)) {
            $this->error(_ERROR_BADSKINNAME);
        }

        if (($skin->getName() != $name) && SKIN::exists($name)) {
            $this->error(_ERROR_DUPSKINNAME);
        }

        if ( ! $type) {
            $type = 'text/html';
        }
        if ( ! $inc_mode) {
            $inc_mode = 'normal';
        }

        // 2. Update description
        $skin->updateGeneralInfo($name, $desc, $type, $inc_mode, $inc_prefix);

        $this->action_skinedit();
    }

    /**
     * @todo document this
     */
    public function action_skinedittype($msg = '')
    {
        global $member, $manager;

        if ( ! $member->isAdmin()) {
            $this->disallow();
        }

        $skinid     = intRequestVar('skinid');
        $type       = strtolower(trim(requestVar('type')));
        $spartstype = 'specialpage' == requestVar('partstype') ? 'specialpage' : 'parts';

        switch ($spartstype) {
            case 'specialpage':
                if ( ! isValidSkinSpecialPageName($type)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
                }
                break;
            default:
                if ( ! isValidSkinPartsName($type)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
                }
        }

        $skin = new SKIN($skinid);

        $friendlyNames = SKIN::getFriendlyNames();

        $this->pagehead();

        echo sprintf(
            '<p>(<a href="index.php?action=skinedit&skinid=%s">%s</a>)</p>',
            $skinid,
            escapeHTML(_SKIN_GOBACK)
        );

        switch ($spartstype) {
            case 'specialpage':
                echo sprintf(
                    "<h2>%s %s : %s</h2>",
                    escapeHTML(_SKIN_EDITPART_TITLE),
                    escapeHTML(_SKIN_PARTS_SPECIAL_PAGE),
                    escapeHTML($skin->getName())
                );
                break;
            default:
                echo sprintf(
                    "<h2>%s '%s': %s</h2>",
                    escapeHTML(_SKIN_EDITPART_TITLE),
                    escapeHTML($skin->getName()),
                    escapeHTML($friendlyNames[$type] ?? $type)
                );
        }

        if ($msg) {
            echo "<p>" . _MESSAGE . ": {$msg}</p>";
        }

        $form   = [];
        $form[] = '<form method="post" action="index.php">';
        $form[] = '<div style="text-align: left;">';
        $form[] = '<input type="hidden" name="action" value="skinupdate" />';
        $form[] = $manager->getHtmlInputTicketHidden();
        $form[] = sprintf('<input type="hidden" name="skinid" value="%s" />', $skinid);
        $form[] = sprintf('<input type="hidden" name="type" value="%s" />', $type);
        $form[] = sprintf('<input type="submit" value="%s" onclick="return checkSubmit();" />', escapeHTML(_SKIN_UPDATE_BTN));
        $form[] = sprintf('<input type="reset" value="%s" />', escapeHTML(_SKIN_RESET_BTN));

        switch ($spartstype) {
            case 'specialpage':
                $form[]   = '<input type="hidden" name="partstype" value="specialpage" />';
                $subtitle = sprintf('(skin type: specialpage : %s) %s', escapeHTML($type), helpHtml('skinpartspecialpage'));
                break;
            default:
                $form[]   = '<input type="hidden" name="partstype" value="parts" />';
                $subtitle = sprintf(
                    '(skin type: %s)',
                    hsc($friendlyNames[$type] ?? $type)
                );
                $types = ['index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'];
                if (in_array($type, $types)) {
                    $subtitle .= helpHtml('skinpart' . $type);
                } else {
                    $subtitle .= helpHtml('skinpartspecial');
                }
        }
        $form[] = " {$subtitle}";

        $form[] = sprintf('<textarea class="skinedit" tabindex="10" rows="20" cols="80" name="content">%s</textarea>', hsc($skin->getContent(
            $type,
            ['spartstype' => $spartstype]
        )));

        $form[] = '<br />';
        $form[] = '<br />';
        $form[] = sprintf('<input type="submit" tabindex="20" value="%s" onclick="return checkSubmit();" />', escapeHTML(_SKIN_UPDATE_BTN));
        $form[] = sprintf('<input type="reset" value="%s" />', escapeHTML(_SKIN_RESET_BTN));
        $form[] = " {$subtitle}";
        $form[] = '';
        $form[] = '';
        $form[] = '</div>';

        $form[] = '</form>';

        ?>
            <div style="width:100%;">
                <?php echo implode("", $form); ?>

                <br /><br />
                <?php echo _SKIN_ALLOWEDVARS ?>
                <?php $actions = SKIN::getAllowedActionsForType($type);

        sort($actions);

        while ($current = array_shift($actions)) {
            // skip deprecated vars
            if ('ifcat' === $current) {
                continue;
            }
            if ('imagetext' === $current) {
                continue;
            }
            if ('vars' === $current) {
                continue;
            }

            echo helplink('skinvar-' . $current) . "{$current}</a>";
            if (0 != count($actions)) {
                echo ", ";
            }
        }
        // edit link
        echo "<br /><br />\n";
        $tmp = sprintf("<%%parsedinclude(%s)%%>", $type)
            . '<%if(onteam)%><div  style="text-align:right">' . "\n"
            . sprintf(
                '<a href="<%%adminurl%%>index.php?action=skinedittype&skinid=%d&type=%s">%s</a>',
                $skinid,
                htmlentities($type, ENT_COMPAT, _CHARSET),
                hsc(_SKIN_EDITONE_TITLE  . '(' . $type . ')')
            )
            . "</div>\n<%endif%>";
        echo '<textarea rows="3" readonly onfocus="this.select()">'
            . hsc($tmp) . '</textarea>';
        // end edit link
        if ('specialpage' === $spartstype) {
            global $CONF;
            if ( ! isset($CONF['SpecialskinKey']) || '' === (string) $CONF['SpecialskinKey']) {
                $SpecialskinKey = 'special';
            } else {
                $SpecialskinKey = $CONF['SpecialskinKey'];
            }
            echo "<br /><br />\n";
            $tmp   = [];
            $tmp[] = sprintf('<a href="<%%blogurl%%>index.php?%s=%s">%s</a>', $SpecialskinKey, $type, $type);
            $tmp[] = sprintf('index.php?%s=%s', $SpecialskinKey, $type);
            $tmp[] = sprintf('/%s/%s', $SpecialskinKey, $type);
            foreach ($tmp as $tmp_s) {
                echo '<textarea rows="1" readonly onfocus="this.select()">'
                    . hsc($tmp_s) . '</textarea>';
            }
        }

        echo '<br /><br />' . _SKINEDIT_ALLOWEDBLOGS;
        $query = sprintf("SELECT bshortname, bname FROM %s", sql_table('blog'));
        showlist_by_query($query, 'table', ['content' => 'shortblognames']);
        echo '<br />' . _SKINEDIT_ALLOWEDTEMPLATESS;
        $query = sprintf("SELECT tdname as name, tddesc as description FROM %s", sql_table('template_desc'));
        showlist_by_query($query, 'table', ['content' => 'shortnames']);
        echo '</div>';
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skinupdate()
    {
        global $member;

        $skinid  = intRequestVar('skinid');
        $content = trim(postVar('content'));
        $type    = postVar('type');

        $spartstype = ('specialpage' === postVar('partstype') ? 'specialpage' : 'parts');

        $member->isAdmin() or $this->disallow();

        $skin = new SKIN($skinid);
        $skin->update($type, $content, ['spartstype' => $spartstype]);

        $this->action_skinedittype(_SKIN_UPDATED);
    }

    /**
     * @todo document this
     */
    public function action_skindelete()
    {
        global $member, $manager, $CONF;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // don't allow default skin to be deleted
        if ($skinid == $CONF['BaseSkin']) {
            $this->error(_ERROR_DEFAULTSKIN);
        }

        // don't allow deletion of default skins for blogs
        $query = sprintf("SELECT bname FROM %s WHERE bdefskin=%s", sql_table('blog'), $skinid);
        $r     = sql_query($query);
        if ($o = sql_fetch_object($r)) {
            $this->error(_ERROR_SKINDEFDELETE . hsc($o->bname));
        }

        $this->pagehead();

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
                <h2><?php echo _DELETE_CONFIRM ?></h2>

                <p>
            <?php echo _CONFIRMTXT_SKIN ?><b><?php echo hsc($name) ?></b> (<?php echo  hsc($desc) ?>)
                </p>

                <form method="post" action="index.php">
                    <div>
                        <input type="hidden" name="action" value="skindeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
                        <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                    </div>
                </form>
            <?php
            $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skindeleteconfirm()
    {
        global $member, $CONF, $manager;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // don't allow default skin to be deleted
        if ($skinid == $CONF['BaseSkin']) {
            $this->error(_ERROR_DEFAULTSKIN);
        }

        // don't allow deletion of default skins for blogs
        $query = sprintf("SELECT bname FROM %s WHERE bdefskin=%s", sql_table('blog'), $skinid);
        $r     = sql_query($query);
        if ($o = sql_fetch_object($r)) {
            $this->error(_ERROR_SKINDEFDELETE . $o->bname);
        }

        $param = ['skinid' => $skinid];
        $manager->notify('PreDeleteSkin', $param);

        // 1. delete description
        sql_query('DELETE FROM ' . sql_table('skin_desc') . ' WHERE sdnumber=' . $skinid);

        // 2. delete parts
        sql_query('DELETE FROM ' . sql_table('skin') . ' WHERE sdesc=' . $skinid);

        $param = ['skinid' => $skinid];
        $manager->notify('PostDeleteSkin', $param);

        $this->action_skinoverview();
    }

    /**
     * @todo document this
     */
    public function action_skinremovetype()
    {
        global $member, $manager;

        $skinid     = intRequestVar('skinid');
        $skintype   = requestVar('type');
        $spartstype = ('specialpage' == requestVar('partstype') ? 'specialpage' : 'parts');

        $confirm_title = _CONFIRMTXT_SKIN_PARTS_SPECIAL;
        switch ($spartstype) {
            case 'specialpage':
                $confirm_title = _CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE;
                if ( ! isValidSkinSpecialPageName($skintype)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
                }
                break;
            default:
                if ( ! isValidSkinPartsName($skintype)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
                }
        }

        $member->isAdmin() or $this->disallow();

        // don't allow default skinparts to be deleted
        if (('parts' == $spartstype) && in_array($skintype, ['index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'])) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

        $this->pagehead();

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
                <h2><?php echo _DELETE_CONFIRM ?></h2>

                <p>
            <?php echo $confirm_title; ?>
                </p>
                <p>
                    <b><?php echo escapeHTML($skintype); ?> (<?php echo escapeHTML($name); ?>)</b> (<?php echo  escapeHTML($desc) ?>)
                </p>

                <form method="post" action="index.php">
                    <div>
                        <input type="hidden" name="action" value="skinremovetypeconfirm" />
                <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="skinid" value="<?php echo $skinid; ?>" />
                        <input type="hidden" name="partstype" value="<?php echo $spartstype; ?>" />
                        <input type="hidden" name="type" value="<?php echo escapeHTML($skintype); ?>" />
                        <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                    </div>
                </form>
            <?php
            $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_skinremovetypeconfirm()
    {
        global $member, $manager;

        $skinid     = intRequestVar('skinid');
        $skintype   = requestVar('type');
        $spartstype = ('specialpage' == requestVar('partstype') ? 'specialpage' : 'parts');

        switch ($spartstype) {
            case 'specialpage':
                if ( ! isValidSkinSpecialPageName($skintype)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
                }
                break;
            default:
                if ( ! isValidSkinPartsName($skintype)) {
                    $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
                }
        }

        $member->isAdmin() or $this->disallow();

        // don't allow default skinparts to be deleted
        if (('parts' == $spartstype) && in_array($skintype, ['index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'])) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

        $notify_data = [
            'skinid'    => $skinid,
            'skintype'  => $skintype,
            'partstype' => $spartstype,
        ];
        $manager->notify('PreDeleteSkinPart', $notify_data);

        // delete part
        sql_query('DELETE FROM ' . sql_table('skin') . ' WHERE sdesc=' . $skinid . ' AND stype=\'' . $skintype . '\'');

        $notify_data = [
            'skinid'    => $skinid,
            'skintype'  => $skintype,
            'partstype' => $spartstype,
        ];
        $manager->notify('PostDeleteSkinPart', $notify_data);

        $this->action_skinedit();
    }

    public function action_skinchangestype()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $skinid     = intRequestVar('skinid');
        $skintype   = requestVar('type');  // parts name
        $spartstype = ('specialpage' == requestVar('partstype') ? 'specialpage' : 'parts');

        // don't allow default skinparts
        if (in_array($skintype, ['index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'])) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE);
        }

        if ( ! SKIN::existsSpecialNameEx($skinid, $skintype, $spartstype)) {
            $msg = ('parts' == $spartstype ? _ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST : _ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST);
            $this->error($msg . escapeHTML(' : ' . $skintype));
        }

        if ( ! isValidSkinSpecialPageName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE);
        }
        if ( ! isValidSkinPartsName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE);
        }

        if ('specialpage' == $spartstype) {
            $confirm_title = _CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE;
        } else {
            $confirm_title = _CONFIRMTXT_SKIN_PARTS_SPECIAL_STYPE_CHANGE;
        }

        $this->pagehead();

        $from = $spartstype;
        $to   = ('specialpage' != $spartstype ? 'specialpage' : 'parts');

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
                <h2><?php echo _ADMIN_TEXT_CHANGE_CONFIRM; ?></h2>

                <p>
            <?php echo $confirm_title; ?>
                </p>
                <p>
                    <b><?php echo escapeHTML($skintype); ?> (<?php echo escapeHTML($name); ?>)</b> (<?php echo  escapeHTML($desc) ?>)
                </p>
                <p>
                    from: <?php echo $from; ?>
                </p>
                <p>
                    to: <?php echo $to; ?>
                </p>

                <form method="post" action="index.php">
                    <div>
                        <input type="hidden" name="action" value="skinchangestypeconfirm" />
                <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="skinid" value="<?php echo $skinid; ?>" />
                        <input type="hidden" name="partstype" value="<?php echo $spartstype; ?>" />
                        <input type="hidden" name="type" value="<?php echo escapeHTML($skintype); ?>" />
                        <input type="hidden" name="partstype_to" value="<?php echo escapeHTML($to); ?>" />
                        <input type="submit" tabindex="10" value="<?php echo _ADMIN_TEXT_CHANGE ?>" />
                    </div>
                </form>
            <?php
            $this->pagefoot();
    }

    public function action_skinchangestypeconfirm()
    {
        global $member;

        $member->isAdmin() or $this->disallow();

        $skinid       = intRequestVar('skinid');
        $skintype     = requestVar('type'); // parts name
        $spartstype   = ('specialpage' == requestVar('partstype') ? 'specialpage' : 'parts');
        $partstype_to = ('specialpage' == requestVar('partstype_to') ? 'specialpage' : 'parts');

        // don't allow default skinparts
        if (in_array($skintype, ['index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'])) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE);
        }

        if ( ! SKIN::existsSpecialNameEx($skinid, $skintype, $spartstype)) {
            $msg = ('parts' == $spartstype ? _ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST : _ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST);
            $this->error($msg . escapeHTML(' : ' . $skintype));
        }

        if ( ! isValidSkinSpecialPageName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE);
        }
        if ( ! isValidSkinPartsName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE);
        }

        $sql = sprintf("UPDATE `%s` ", sql_table('skin'));
        $sql .= 'SET spartstype = ? WHERE sdesc=? AND stype=?';
        sql_prepare_execute($sql, [$partstype_to, $skinid, $skintype]);

        $this->action_skinedit();
    }

    /**
     * @todo document this
     */
    public function action_skinclone()
    {
        global $member;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // 1. read skin to clone
        $skin = new SKIN($skinid);

        $name = "clone_" . $skin->getName();

        // if a skin with that name already exists:
        if (SKIN::exists($name)) {
            $i = 1;
            while (SKIN::exists($name . $i)) {
                $i++;
            }
            $name .= $i;
        }

        // 2. create skin desc
        $newid = SKIN::createNew(
            $name,
            $skin->getDescription(),
            $skin->getContentType(),
            $skin->getIncludeMode(),
            $skin->getIncludePrefix()
        );

        // 3. clone
        /*
        $this->skinclonetype($skin, $newid, 'index');
        $this->skinclonetype($skin, $newid, 'item');
        $this->skinclonetype($skin, $newid, 'archivelist');
        $this->skinclonetype($skin, $newid, 'archive');
        $this->skinclonetype($skin, $newid, 'search');
        $this->skinclonetype($skin, $newid, 'error');
        $this->skinclonetype($skin, $newid, 'member');
        $this->skinclonetype($skin, $newid, 'imagepopup');
*/

        $query = sprintf("SELECT stype FROM %s WHERE sdesc = %s", sql_table('skin'), $skinid);
        $res   = sql_query($query);
        while ($row = sql_fetch_assoc($res)) {
            $this->skinclonetype($skin, $newid, $row['stype']);
        }

        $this->action_skinoverview();
    }

    /**
     * @todo document this
     */
    public function skinclonetype($skin, $newid, $type)
    {
        $newid   = (int) $newid;
        $content = $skin->getContent($type);
        if ($content) {
            $query = 'INSERT INTO ' . sql_table('skin') . " (sdesc, scontent, stype) VALUES ({$newid}," . sql_quote_string($content) . ', ' . sql_quote_string($type) . ')';
            sql_query($query);
        }
    }

    /**
     * @todo document this
     */
    public function action_settingsedit($message = '')
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';
        ?>

                <h2><?php echo _SETTINGS_TITLE ?></h2>
        <?php if ($message) {
            echo sprintf('<div class="ok">%s</div>', $message);
        } ?>

                <form action="index.php" method="post">
                    <div>

                        <input type="hidden" name="action" value="settingsupdate" />
                <?php
                        $manager->addTicketHidden();
        ?>

                        <table>
                            <?php
            // global settings
            $tabindex = 10;
        $this->parts_settingsedit_global($tabindex);

        // media
        $tabindex = 10090;
        $this->parts_settingsedit_media($tabindex);

        // member
        $tabindex = 10120;
        $this->parts_settingsedit_member($tabindex);

        // cookie
        $tabindex = 10159;
        $this->parts_settingsedit_cookie($tabindex);
        ?>
                        </table>
                        <div><input type="submit" tabindex="10210" value="<?php echo _SETTINGS_UPDATE_BTN ?>" onclick="return checkSubmit();" /></div>

                    </div>
                </form>

            <?php
            echo '<h2>', _PLUGINS_EXTRA, '</h2>';

        $param = [];
        $manager->notify('GeneralSettingsFormExtras', $param);

        $this->pagefoot();
    }

    private function parts_settingsedit_global(&$tabindex)
    {
        global $CONF, $DIR_NUCLEUS;
        ?>
                            <tr>
                                <th colspan="2"><?php echo _SETTINGS_SUB_GENERAL ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_DEFBLOG ?> <?php help('defaultblog'); ?></td>
                                <td>
                            <?php
        $query                = sprintf("SELECT bname as text, bnumber as value FROM %s", sql_table('blog'));
        $template['name']     = 'DefaultBlog';
        $template['selected'] = $CONF['DefaultBlog'];
        $template['tabindex'] = 10;
        showlist_by_query($query, 'select', $template);
        ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_BASESKIN ?> <?php help('baseskin'); ?></td>
                                <td>
                                    <?php
                $query        = sprintf("SELECT sdname as text, sdnumber as value FROM %s", sql_table('skin_desc'));
        $template['name']     = 'BaseSkin';
        $template['selected'] = $CONF['BaseSkin'];
        $template['tabindex'] = 1;
        showlist_by_query($query, 'select', $template);
        ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ADMINMAIL ?></td>
                                <td><input name="AdminEmail" tabindex="10010" size="40" value="<?php echo  hsc($CONF['AdminEmail']) ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_SITENAME ?></td>
                                <td><input name="SiteName" tabindex="10020" size="40" value="<?php echo  hsc($CONF['SiteName']) ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_SITEURL ?></td>
                                <td><input name="IndexURL" tabindex="10030" size="40" value="<?php echo  hsc($CONF['IndexURL']) ?>" pattern="^https?://.+/$" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ADMINURL ?></td>
                                <td><input name="AdminURL" tabindex="10040" size="40" value="<?php echo  hsc($CONF['AdminURL']) ?>" pattern="^https?://.+/$" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_PLUGINURL ?> <?php help('pluginurl'); ?></td>
                                <td><input name="PluginURL" tabindex="10045" size="40" value="<?php echo  hsc($CONF['PluginURL']) ?>" pattern="^https?://.+$" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_SKINSURL ?> <?php help('skinsurl'); ?></td>
                                <td><input name="SkinsURL" tabindex="10046" size="40" value="<?php echo  hsc($CONF['SkinsURL']) ?>" pattern="^https?://.+$" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ACTIONSURL ?> <?php help('actionurl'); ?></td>
                                <td><input name="ActionURL" tabindex="10047" size="40" value="<?php echo  hsc($CONF['ActionURL']) ?>" pattern="^https?://.+$" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_LANGUAGE ?> <?php help('language'); ?>
                                </td>
                                <td>

                                    <select name="Language" tabindex="10050">
                                <?php               // show a dropdown list of all available languages
                                global $DIR_LANG;
        $dirhandle = opendir($DIR_LANG);
        while ($filename = readdir($dirhandle)) {
            $matches     = [];
            $sub_pattern = '((.*)-utf8)';
            if (preg_match('#^' . $sub_pattern . '\.php$#', $filename, $matches)) {
                $name          = $matches[2];
                $s_fullname    = $matches[1];
                $s_displaytext = hsc($this->getDislpayLanguageText($name));
                //if (!check_abalable_language_name($name))
                //    continue;
                echo sprintf('<option value="%s"', hsc($s_fullname));
                if ($s_fullname == $CONF['Language']) {
                    echo " selected=\"selected\"";
                }
                echo sprintf(">%s</option>", $s_displaytext);
            }
        }
        closedir($dirhandle);

        ?>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_DISABLESITE ?> <?php help('disablesite'); ?>
                                </td>
                                <td><?php $this->input_yesno('DisableSite', $CONF['DisableSite'], 10060); ?>
                                    <br />
                                    <?php echo _SETTINGS_DISABLESITEURL ?> <input name="DisableSiteURL" tabindex="10070" size="40" value="<?php echo  hsc($CONF['DisableSiteURL']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_DIRS ?></td>
                                <td><?php echo  hsc($DIR_NUCLEUS) ?>
                                    <i><?php echo _SETTINGS_SEECONFIGPHP ?></i>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo _SETTINGS_DBLOGIN ?></td>
                                <td><i><?php echo _SETTINGS_SEECONFIGPHP ?></i></td>
                            </tr>

                            <tr>
                                <td>
                                    <?php
            echo _SETTINGS_JSTOOLBAR
            /* =_SETTINGS_DISABLEJS

                    I temporary changed the meaning of DisableJsTools, until I can find a good
                    way to select the javascript version to use

                    now, its:
                        0 : IE
                        1 : all javascript disabled
                        2 : 'simpler' javascript (for mozilla/opera/mac)
                */
        ?>
                                </td>
                                <td><?php /* $this->input_yesno('DisableJsTools',$CONF['DisableJsTools'],10075); */ ?>
                                    <select name="DisableJsTools" tabindex="10075">
                                <?php $extra = (1 == $CONF['DisableJsTools']) ? 'selected="selected"' : '';
        echo "<option {$extra} value='1'>", _SETTINGS_JSTOOLBAR_NONE, "</option>";
        $extra = (2 == $CONF['DisableJsTools']) ? 'selected="selected"' : '';
        echo "<option {$extra} value='2'>", _SETTINGS_JSTOOLBAR_SIMPLE, "</option>";
        $extra = (0 == $CONF['DisableJsTools']) ? 'selected="selected"' : '';
        echo "<option {$extra} value='0'>", _SETTINGS_JSTOOLBAR_FULL, "</option>";
        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_URLMODE ?> <?php help('urlmode'); ?></td>
                                <td><?php

        $this->input_yesno(
            'URLMode',
            $CONF['URLMode'],
            10077,
            'normal',
            'pathinfo',
            _SETTINGS_URLMODE_NORMAL,
            _SETTINGS_URLMODE_PATHINFO
        );

        echo ' ', _SETTINGS_URLMODE_HELP;

        ?>

                                </td>
                            </tr>

                            <tr>
                                <td><?php echo _SETTINGS_ENABLE_RSS . "( xml-rss2.php , rsd.php )"; ?></td>
                                <td><?php
                                $enable_rss = ! isset($CONF['DisableRSS']) || ! $CONF['DisableRSS'];
        $this->input_yesno('EnableRSS', $enable_rss, 10077);
        ?>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo _ADMIN_TEXT_ALLOW_PLUGINADMIN_OLD; ?></td>
                                <td><?php
        $this->input_yesno('ENABLE_PLUGIN_ADMIN_V1', CONF::asBool('ENABLE_PLUGIN_ADMIN_V1', true), 10077);
        ?>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo _ADMIN_TEXT_UPDATENOTIFICATIONSANDDOWNLOADS; ?></td>
                                <td><?php
        $this->input_yesno('ENABLE_PLUGIN_UPDATE_CHECK', CONF::asBool('ENABLE_PLUGIN_UPDATE_CHECK', false), 10077);
        ?>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo _SETTINGS_DEBUGVARS ?> <?php help('debugvars'); ?></td>
                                <td><?php

        $this->input_yesno('DebugVars', $CONF['DebugVars'], 10078);

        ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_DEFAULTLISTSIZE ?> <?php help('defaultlistsize'); ?></td>
                                <td>
                                    <?php
            if ( ! array_key_exists('DefaultListSize', $CONF)) {
                sql_query("INSERT INTO " . sql_table('config') . " VALUES ('DefaultListSize', '10')");
                $CONF['DefaultListSize'] = 10;
            }
        ?>
                                    <input type="number" name="DefaultListSize" tabindex="10079" size="10em"
                                           value="<?php echo  hsc(((int) $CONF['DefaultListSize'] < 1 ? '10' : $CONF['DefaultListSize'])) ?>"
                                           min="0" pattern="^[0-9]+$"
                                           />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ADMINCSS ?>
                                </td>
                                <td>
                                    <select name="AdminCSS" tabindex="10080">
                                <?php        // show a dropdown list of all available admin css files
                                global $DIR_NUCLEUS;
        $dirhandle = opendir($DIR_NUCLEUS . "styles/");
        while ($filename = readdir($dirhandle)) {
            if (preg_match('#^admin_(.*)\.css$#', $filename, $matches)) {
                $name = $matches[1];
                echo "<option value=\"{$name}\"";
                if ($name == $CONF['AdminCSS']) {
                    echo " selected=\"selected\"";
                }
                echo ">{$name}</option>";
            }
        }
        closedir($dirhandle);
        ?>
                                    </select>
                                </td>
                            </tr>

        <?php
        // Tidy
        $tabindex = 10081;
        $this->parts_settingsedit_global_tidy($tabindex);
    }

    private function parts_settingsedit_media(&$tabindex)
    {
        global $CONF, $DIR_MEDIA;
        ?>
                            <tr>
                                <th colspan="2"><?php echo _SETTINGS_MEDIA ?> <?php help('media'); ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_MEDIADIR ?></td>
                                <td><?php echo  hsc($DIR_MEDIA) ?>
                                    <i><?php echo _SETTINGS_SEECONFIGPHP ?></i>
                            <?php if ( ! is_dir($DIR_MEDIA)) {
                                echo "<br /><b>" . _WARNING_NOTADIR . "</b>";
                            }
        if ( ! is_readable($DIR_MEDIA)) {
            echo "<br /><b>" . _WARNING_NOTREADABLE . "</b>";
        }
        if ( ! is_writable($DIR_MEDIA)) {
            echo "<br /><b>" . _WARNING_NOTWRITABLE . "</b>";
        }
        ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_MEDIAURL ?></td>
                                <td>
                                    <input name="MediaURL" tabindex="10090" size="40" value="<?php echo  hsc($CONF['MediaURL']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ALLOWUPLOAD ?></td>
                                <td><?php $this->input_yesno('AllowUpload', $CONF['AllowUpload'], 10090); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ALLOWUPLOADTYPES ?></td>
                                <td>
                                    <input name="AllowedTypes" tabindex="10100" size="40" value="<?php echo  hsc($CONF['AllowedTypes']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_MAXUPLOADSIZE ?></td>
                                <td>
                                    <input name="MaxUploadSize" tabindex="10105" size="40" value="<?php echo  hsc($CONF['MaxUploadSize']) ?>" pattern="^[0-9]+$" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_MEDIAPREFIX ?></td>
                                <td><?php $this->input_yesno('MediaPrefix', $CONF['MediaPrefix'], 10110); ?></td>
                            </tr>
    <?php
    }

    private function parts_settingsedit_member(&$tabindex)
    {
        global $CONF;
        ?>
                            <tr>
                                <th colspan="2"><?php echo _SETTINGS_MEMBERS ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_CHANGELOGIN ?></td>
                                <td><?php $this->input_yesno('AllowLoginEdit', $CONF['AllowLoginEdit'], 10120); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_ALLOWCREATE ?>
                                    <?php help('allowaccountcreation'); ?>
                                </td>
                                <td><?php $this->input_yesno('AllowMemberCreate', $CONF['AllowMemberCreate'], 10130); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_NEWLOGIN ?> <?php help('allownewmemberlogin'); ?>
                                    <br /><?php echo _SETTINGS_NEWLOGIN2 ?>
                                </td>
                                <td><?php $this->input_yesno('NewMemberCanLogon', $CONF['NewMemberCanLogon'], 10140); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_MEMBERMSGS ?>
                                    <?php help('messageservice'); ?>
                                </td>
                                <td><?php $this->input_yesno('AllowMemberMail', $CONF['AllowMemberMail'], 10150); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_NONMEMBERMSGS ?>
                                    <?php help('messageservice'); ?>
                                </td>
                                <td><?php $this->input_yesno('NonmemberMail', $CONF['NonmemberMail'], 10155); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_PROTECTMEMNAMES ?>
                                    <?php help('protectmemnames'); ?>
                                </td>
                                <td><?php $this->input_yesno('ProtectMemNames', $CONF['ProtectMemNames'], 10156); ?>
                                </td>
                            </tr>
    <?php
    }
    private function parts_settingsedit_cookie(&$tabindex)
    {
        global $CONF;
        ?>
                            <tr>
                                <th colspan="2"><?php echo _SETTINGS_COOKIES_TITLE ?> <?php help('cookies'); ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_COOKIEPREFIX ?></td>
                                <td><input name="CookiePrefix" tabindex="10159" size="40" value="<?php echo  hsc($CONF['CookiePrefix']) ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_COOKIEDOMAIN ?></td>
                                <td><input name="CookieDomain" tabindex="10160" size="40" value="<?php echo  hsc($CONF['CookieDomain']) ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_COOKIEPATH ?></td>
                                <td><input name="CookiePath" tabindex="10170" size="40" value="<?php echo  hsc($CONF['CookiePath']) ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_COOKIESECURE ?></td>
                                <td><?php $this->input_yesno('CookieSecure', $CONF['CookieSecure'], 10180); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_COOKIELIFE ?></td>
                                <td><?php $this->input_yesno(
                                    'SessionCookie',
                                    $CONF['SessionCookie'],
                                    10190,
                                    1,
                                    0,
                                    _SETTINGS_COOKIESESSION,
                                    _SETTINGS_COOKIEMONTH
                                ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _SETTINGS_LASTVISIT ?></td>
                                <td><?php $this->input_yesno('LastVisit', $CONF['LastVisit'], 10200); ?></td>
                            </tr>
    <?php
    }

    private function parts_settingsedit_global_tidy(&$tabindex)
    {
        global $CONF;
        if (_CHARSET !== 'UTF-8'
        ) {
            return;
        }

        // ENABLE_TIDY
        $tidy_loaded = extension_loaded('tidy');
        $s_disable   = sprintf('[%s] ', _ADMIN_SYSTEMOVERVIEW_DISABLE);

        echo sprintf("<tr><td>%s</td><td>", _SETTINGS_TIDY_ENABLE);
        if ($tidy_loaded) {
            $this->input_yesno('tidy_enable', CONF::asInt('tidy_enable', 0), $tabindex++);
        } else {
            echo $s_disable;
        }
        echo "</td></tr>\n";

        if ( ! $tidy_loaded) {
            return;
        }

        $isTidy5 = (function_exists('tidy_get_release')
            && (strtotime(str_replace(['.'], '/', tidy_get_release())) >= strtotime('2015/06/30')));

        // ENABLE_TIDY_INDENT
        printf("<tr><td>%s</td><td>", _SETTINGS_TIDY_INDENT_ENABLE);
        $this->input_yesno('tidy_opt_config_indent_enable', CONF::asInt('tidy_opt_config_indent_enable', 0), $tabindex++);
        echo "</td></tr>\n";

        // _SETTINGS_TIDY_HIDE_COMMENT
        printf("<tr><td>%s</td><td>", _SETTINGS_TIDY_HIDE_COMMENT);
        $this->input_yesno('tidy_opt_config_hide_comment', CONF::asInt('tidy_opt_config_hide_comment', 0), $tabindex++);
        echo "</td></tr>\n";

        // _SETTINGS_TIDY_HIDE_COMMENT_ADMIN
        printf("<tr><td>%s</td><td>", _SETTINGS_TIDY_HIDE_COMMENT_ADMIN);
        $this->input_yesno('tidy_opt_config_hide_comment_admin', CONF::asInt('tidy_opt_config_hide_comment_admin', 0), $tabindex++);
        echo "</td></tr>\n";

        // doctype
        $doctypes    = [];
        $def_doctype = CONF::asStr('tidy_opt_config_doctype', 'auto');
        $doctypes[]  = ['value' => 'html5,strict', 'label' => 'Priority HTML5, HTML4(strict): depending on lib version'];
        if ($isTidy5) {
            $doctypes[] = ['value' => 'html5', 'label' => 'html5: HTML5'];
        } elseif ('html5' == $def_doctype) {
            $def_doctype = 'auto';
        }
        $doctypes[] = ['value' => 'strict', 'label' => 'strict: HTML4'];
        $doctypes[] = ['value' => 'auto', 'label' => 'auto: Automatic selection by html code : depending on lib version'];
        $doctypes[] = ['value' => 'omit', 'label' => 'omit'];

        echo "<tr><td>Tidy: doctype (blog)</td><td>\n";
        self::input_type_select('tidy_opt_config_doctype', $doctypes, $def_doctype, $tabindex++);
        echo "</td></tr>\n";

        // todo: make it customizable
        // tidy_opt_config_text
        $onclick = 'e = document.getElementById("tidy_config_sample"); if (e) { e.style.display = "block"; }';
        $styles  = 'min-height:3.5em; max-height:8.5em; min-width:10em; width: -moz-available;';
        printf(
            "<tr><td>Tidy: config (blog)<br /><br />[example] <span onclick='%s'>[+]</span><div id='tidy_config_sample' style='%s'>%s</div></td>\n",
            $onclick,
            'display: none',
            '<br>indent-spaces: 2<br>//language: ja<br>//indent-with-tabs: yes<br>//tab-size: 4'
        );
        printf(
            "<td><textarea name='tidy_opt_config_text' style='%s'>%s</textarea></td></tr>\n",
            $styles,
            CONF::asHsc('tidy_opt_config_text')
        );
    }

    private function checkConfigTable()
    {
        global $DB_DRIVER_NAME;
        if ('mysql' != $DB_DRIVER_NAME) {
            return;
        }
        $tablename = sql_table('config');
        $query     = sprintf("SHOW COLUMNS FROM `{$tablename}` LIKE 'name'");
        $res       = sql_query($query);
        if ($res && ($row = sql_fetch_assoc($res))
            && ! empty($row['Type']) && ('varchar(20)' == $row['Type'])
        ) {
            // force upgrade config table
            $query = <<<EOL
                ALTER TABLE `{$tablename}`
                MODIFY COLUMN `name` varchar(50)  NOT NULL default ''
EOL;
            sql_query($query);
        }
    }

    /**
     * @todo document this
     */
    public function action_settingsupdate()
    {
        global $member, $CONF;

        $member->isAdmin() or $this->disallow();

        // check if email address for admin is valid
        if ( ! isValidMailAddress(postVar('AdminEmail'))) {
            $this->error(_ERROR_BADMAILADDRESS);
        }

        $this->checkConfigTable();

        // save settings
        $this->updateConfig('DefaultBlog', postVar('DefaultBlog'));
        $this->updateConfig('BaseSkin', postVar('BaseSkin'));
        $this->updateConfig('IndexURL', rtrim(postVar('IndexURL'), '/') . '/');
        $this->updateConfig('AdminURL', rtrim(postVar('AdminURL'), '/') . '/');
        $this->updateConfig('PluginURL', trim(postVar('PluginURL')));
        $this->updateConfig('SkinsURL', trim(postVar('SkinsURL')));
        $this->updateConfig('ActionURL', trim(postVar('ActionURL')));
        $this->updateConfig('Language', postVar('Language'));
        $this->updateConfig('AdminEmail', trim(postVar('AdminEmail')));
        $this->updateConfig('SessionCookie', postVar('SessionCookie'));
        $this->updateConfig('AllowMemberCreate', postVar('AllowMemberCreate'));
        $this->updateConfig('AllowMemberMail', postVar('AllowMemberMail'));
        $this->updateConfig('NonmemberMail', postVar('NonmemberMail'));
        $this->updateConfig('ProtectMemNames', postVar('ProtectMemNames'));
        $this->updateConfig('SiteName', postVar('SiteName'));
        $this->updateConfig('NewMemberCanLogon', postVar('NewMemberCanLogon'));
        $this->updateConfig('DisableSite', postVar('DisableSite'));
        $this->updateConfig('DisableSiteURL', trim(postVar('DisableSiteURL')));
        $this->updateConfig('LastVisit', postVar('LastVisit'));
        $this->updateConfig('MediaURL', rtrim(postVar('MediaURL'), '/') . '/');
        $this->updateConfig('AllowedTypes', postVar('AllowedTypes'));
        $this->updateConfig('AllowUpload', postVar('AllowUpload'));
        $this->updateConfig('MaxUploadSize', postVar('MaxUploadSize'));
        $this->updateConfig('MediaPrefix', postVar('MediaPrefix'));
        $this->updateConfig('AllowLoginEdit', postVar('AllowLoginEdit'));
        $this->updateConfig('DisableJsTools', postVar('DisableJsTools'));
        $this->updateConfig('CookieDomain', trim(postVar('CookieDomain')));
        $this->updateConfig('CookiePath', trim(postVar('CookiePath')));
        $this->updateConfig('CookieSecure', postVar('CookieSecure'));
        $this->updateConfig('URLMode', postVar('URLMode'));
        $this->updateConfig('CookiePrefix', trim(postVar('CookiePrefix')));
        $this->updateConfig('DebugVars', postVar('DebugVars'));
        $this->updateConfig('DefaultListSize', postVar('DefaultListSize'));
        $this->updateConfig('AdminCSS', postVar('AdminCSS'));
        $this->updateOrInsertConfig('DisableRSS', (postVar('EnableRSS') ? '0' : '1'));
        $this->updateOrInsertConfig('ENABLE_PLUGIN_ADMIN_V1', PostVar::asBool('ENABLE_PLUGIN_ADMIN_V1') ? '1' : '0');
        $this->updateOrInsertConfig('ENABLE_PLUGIN_UPDATE_CHECK', PostVar::asBool('ENABLE_PLUGIN_UPDATE_CHECK') ? '1' : '0');
        if (extension_loaded('tidy')) {
            $this->updateOrInsertConfig('tidy_enable', (PostVar::asBool('tidy_enable') ? '1' : '0'));
            // doctype
            $doctype = PostVar::asStr('tidy_opt_config_doctype');
            if ( ! in_array($doctype, ['html5,strict','auto','html5','strict','omit'])) {
                // [25 March 2009] : auto, omit, strict, loose or <fpi> / strict(HTML4)
                // [2015/06/30 - ] : html5, omit, auto, strict, transitional, user
                $doctype = 'auto';
            }
            $this->updateOrInsertConfig('tidy_opt_config_doctype', $doctype);
            // indent
            $this->updateOrInsertConfig('tidy_opt_config_indent_enable', (PostVar::asBool('tidy_opt_config_indent_enable') ? '1' : '0'));
            // comment
            $this->updateOrInsertConfig('tidy_opt_config_hide_comment', (PostVar::asBool('tidy_opt_config_hide_comment') ? '1' : '0'));
            $this->updateOrInsertConfig('tidy_opt_config_hide_comment_admin', (PostVar::asBool('tidy_opt_config_hide_comment_admin') ? '1' : '0'));
            // config
            $this->updateOrInsertConfig('tidy_opt_config_text', PostVar::asStr('tidy_opt_config_text'));
        }

        // load new config and redirect (this way, the new language will be used is necessary)
        // note that when changing cookie settings, this redirect might cause the user
        // to have to log in again.
        getConfig();
        redirect($CONF['AdminURL'] . '?action=settingsedit');
        //        redirect($CONF['AdminURL'] . '?action=manage');
        exit;
    }

    /**
     *  Give an overview over the used system
     */
    public function action_systemoverview()
    {
        global $member, $manager, $CONF;
        global $DB_DRIVER_NAME;

        if (empty($member) || ! $member->isAdmin() || ! $member->isLoggedIn()) {
            $this->disallow();
        }

        $this->pagehead();
        printf("<h2>%s</h2>\n", _ADMIN_SYSTEMOVERVIEW_HEADING);

        if ($member->isLoggedIn() && $member->isAdmin()) {
            $checkURL = self::getVersionCheckWebPageURL();
            // output pagehead
            $blade_params = [
               'manager'          => $manager,
               'oAdmin'           => $this,
               'DB_DRIVER_NAME'   => $DB_DRIVER_NAME,
               'checkURL'         => $checkURL,
               'CONF'             => $CONF,
               'SiteName'         => CONF::asStr('SiteName'),
               'db_charset'       => 'mysql' === $DB_DRIVER_NAME ? getCollationFromDB(\sql_table('config'), 'name') : 'utf-8',
               'default_charset'  => ini_get('default_charset') ?? 'none',
               'MysqlEmulateInfo' => $this->getMysqlEmulateInfo(),
            ];
            echo \parseBlade('admin.action_systemoverview', $blade_params), "\n";
        } else {
            echo _ADMIN_SYSTEMOVERVIEW_NOT_ADMIN;
        }

        $this->pagefoot();
    }

    private function getMysqlEmulateInfo()
    {
        if ( ! defined('_EXT_MYSQL_EMULATE') || ( ! _EXT_MYSQL_EMULATE)) {
            return '';
        }

        $r     = ['', '', '', '']; // [defined , undefined, defined , undefined]
        $lists = [
            'connect', 'pconnect', 'close', 'select_db', 'query',
            'unbuffered_query', 'db_query', 'list_dbs', 'list_tables', 'list_fields',
            'list_processes', 'error', 'errno', 'affected_rows', 'insert_id',
            'result', 'num_rows', 'num_fields', 'fetch_row', 'fetch_array',
            'fetch_assoc', 'fetch_object', 'data_seek', 'fetch_lengths', 'fetch_field',
            'field_seek', 'free_result', 'field_name', 'field_table', 'field_len',
            'field_type', 'field_flags', 'escape_string', 'real_escape_string', 'stat',
            'thread_id', 'client_encoding', 'ping', 'get_client_info', 'get_host_info',
            'get_proto_info', 'get_server_info', 'info', 'set_charset', 'fieldname',
            'fieldtable', 'fieldlen', 'fieldtype', 'fieldflags', 'selectdb',
            'freeresult', 'numfields', 'numrows', 'listdbs', 'listtables',
            'listfields', 'db_name', 'dbname', 'tablename', 'table_name',
        ];

        foreach ($lists as $i) {
            $m = 'mysql_' . $i;
            $s = 'sql_'   . $i;
            if (function_exists($m)) {
                $r[0] .= $m . " , ";
            } else {
                if ( ! function_exists($s)) {
                    $r[1] .= $m . " , ";
                } else {
                    $r[1] .= "<b>{$m}</b> , ";
                }
            }
            if (function_exists($s)) {
                $r[2] .= $s . " , ";
            } else {
                $r[3] .= $s . " , ";
            }
        }

        $title = [
            'Emulated Mysql Functions (wrapper functions)',
            'sql Functions',
        ];
        $tpl = "<h3>%s</h3>\n<table><tr><td>defined</td><td>%s</td></tr><tr><td>undefined</td><td>%s</td></tr></table>";
        $res = '';
        for ($i = 1; $i >= 0; $i--) {
            $res .= sprintf(
                $tpl,
                $title[$i],
                $r[0 + $i * 2],
                $r[1 + $i * 2]
            );
        }
        return $res;
    }

    /**
     * @todo document this
     */
    public static function updateConfig($name, $val)
    {
        // name : $CONF is case sensitive

        $query = parseQuery(
            "UPDATE [@prefix@]config SET value='[@value:escape@]' WHERE name='[@name:escape@]'",
            ['value' => trim($val), 'name' => $name]
        );
        if ( ! sql_query($query)) {
            if ( ! defined('_ADMIN_SQLDIE_QUERYERROR')) {
                define('_ADMIN_SQLDIE_QUERYERROR', 'Query error: ');
            }
            exit(_ADMIN_SQLDIE_QUERYERROR . sql_error());
        }
        return sql_insert_id();
    }

    public static function updateOrInsertConfig($name, $value)
    {
        $sql = parseQuery('SELECT COUNT(*) AS result FROM `[@prefix@]config` WHERE name = ?');
        $res = sql_prepare_execute($sql, [(string) $name]);
        if ($res) {
            $row = sql_fetch_row($res);
            if ($row[0] > 0) {
                return self::updateConfig($name, $value);
            }
        }

        $sql = parseQuery("INSERT INTO `[@prefix@]config` (name, value) VALUES(?, ?)");
        $res = sql_prepare_execute($sql, [(string) $name, trim((string) $value)]);

        $res or exit((defined('_ADMIN_SQLDIE_QUERYERROR') ? _ADMIN_SQLDIE_QUERYERROR : "Query error: ") . sql_error());
        return sql_insert_id();
    }

    /**
     * Error message
     *
     * @param string $msg message that will be shown
     */
    public function error($msg)
    {
        $this->pagehead();
        echo  "<h2>Error!</h2>\n";
        echo $msg;
        echo "<br />";
        echo "<a href='index.php' onclick='history.back(); return false;'>" . _BACK . "</a>";
        $this->pagefoot();
        exit;
    }

    /**
     * @todo document this
     */
    public function disallow()
    {
        ACTIONLOG::add(WARNING, _ACTIONLOG_DISALLOWED . serverVar('REQUEST_URI'));

        $this->error(_ERROR_DISALLOWED);
    }

    public function add_extrahead($text)
    {
        //        if (strlen($text)>0)
        $this->extrahead[] = $text;
    }

    /**
     * @todo document this
     */
    public function pagehead($extrahead = '')
    {
        global $CONF, $manager, $DIR_NUCLEUS;

        @LoadCoreLanguage();

        checkOutputCompression("text/html");

        $param = [
            'extrahead' => &$extrahead,
            'action'    => $this->action,
        ];
        $manager->notify('AdminPrePageHead', $param);

        if (isset($this->extrahead) && count($this->extrahead) > 0) {
            $extrahead .= implode("\n", $this->extrahead);
        }

        $baseUrl = hsc($CONF['AdminURL']);
        if ( ! array_key_exists('AdminCSS', $CONF)) {
            $sql = sprintf("INSERT INTO `%s` VALUES ('AdminCSS', '%s')", sql_table('config'), self::default_admin_css);
            sql_query($sql);
            $CONF['AdminCSS'] = self::default_admin_css;
        }
        foreach ([$CONF['AdminCSS'], 'contemporary', 'original'] as $name) {
            $fname = $DIR_NUCLEUS . sprintf('styles/admin_%s.css', remove_all_directory_separator($name));
            if (@is_file($fname)) {
                if ($CONF['AdminCSS'] != $name) {
                    $CONF['AdminCSS'] = $name;
                }
                break;
            }
        }

        // Tidy
        if (_CHARSET === 'UTF-8'
            && CONF::asBool('tidy_enable', false)
            && extension_loaded('tidy')
        ) {
            /*
            //            tidy.default_config : [PHP_INI_SYSTEM] php.ini or httpd.conf
                        $tidy_config_path = ini_get('tidy.default_config');
                        if (!empty($tidy_config_path) && @is_file($tidy_config_path)) {
                            ob_start('ob_tidyhandler');
                        } else
             */
            if (ob_start()) {
                register_shutdown_function([$this, 'tidy_shutdown_end_obhandler'], ob_get_level());
            }
        }

        // output pagehead
        $blade_params = [
           'manager'   => $manager,
           'oAdmin'    => $this,
           'baseUrl'   => $baseUrl,
           'extrahead' => $extrahead,
           'AdminCSS'  => CONF::asStr('AdminCSS'),
           'SiteName'  => CONF::asStr('SiteName'),
        ];
        echo \parseBlade('admin.pagehead', $blade_params), "\n";
    }

    public function loginname()
    {
        global $member, $nucleus, $CONF;
        ?>
                                <div class="loginname">
                <?php
                $adminrooturi = ADMIN::getAdminRootURI();
        if ($member->isLoggedIn()) {
            echo _LOGGEDINAS . ' ' . $member->getDisplayName()
                . " - <a href='{$adminrooturi}index.php?action=logout'>" . _LOGOUT . "</a>"
                . "<br /><a href='{$adminrooturi}index.php?action=overview'>" . _USER_HOME . "</a> - ";
        } else {
            printf(
                '<a href="%sindex.php?action=showlogin" title="Log in">%s</a> <br />',
                $adminrooturi,
                _NOTLOGGEDIN
            );
        }

        echo sprintf('<a href="%s" target="_blank" rel="noreferrer">%s</a> | ', get_help_root_url(false), _HELP_TT);
        echo "<a href='" . $CONF['IndexURL'] . "'>" . _YOURSITE . "</a>";

        if ( ! empty(NUCLEUS_DEVELOP)) {
            printf('<br /><i>%s</i>', lnTextByName('_ADMIN_DEVELOP_VERSION'));
        }
        echo '<br />(';

        $versionstring = sprintf('%s %s', hsc(CORE_APPLICATION_NAME), CORE_APPLICATION_VERSION);
        if ($member->isLoggedIn() && $member->isAdmin()) {
            echo self::getAboutHtmlTag();
            $newestVersion = getLatestVersion();
            if ($newestVersion && nucleus_version_compare($newestVersion, NUCLEUS_VERSION, '>')) {
                echo '<br /><a style="color:red" href="http://nucleuscms.org/upgrade.php" title="' . _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE . '">' . _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT . $newestVersion . '</a>';
            }

            if ((int) $CONF['DatabaseVersion'] < CORE_APPLICATION_DATABASE_VERSION_ID) {
                echo sprintf(
                    ')<br />(<a style="color:red" href="%s">Current database is old(%d). Upgrade the core database</a>',
                    $CONF['IndexURL'] . '_upgrades/',
                    $CONF['DatabaseVersion']
                );
            }
        } else {
            echo $versionstring;
        }
        echo ')';
        echo '</div>';
    }

    /**
     * @todo document this
     */
    public function pagefoot()
    {
        global $manager;

        $notify_data = [
            'action' => $this->action,
        ];
        $manager->notify('AdminPrePageFoot', $notify_data);

        // output pagefoot
        $blade_params = [
           'manager'  => $manager,
           'oAdmin'   => $this,
           'year'     => date('Y'),
           'copy'     => _ADMINPAGEFOOT_COPYRIGHT,
           'app_copy' => defined('CORE_APPLICATION_COPYRIGHT') ? ' / ' . escapeHTML(CORE_APPLICATION_COPYRIGHT) : '',
        ];
        echo \parseBlade('admin.pagefoot', $blade_params);
    }

    public function quickmenu()
    {
        global $action, $member, $manager, $DB_DRIVER_NAME;

        $IsLoggedinMenu   = ('showlogin' !== $action) && ($member->isLoggedIn());
        $IsActivationMenu = $IsLoggedinMenu ? false : (('activate' == $action) || ('activatesetpwd' == $action));
        $IsIntroMenu      = ( ! $IsLoggedinMenu && ! $IsActivationMenu);

        $params = [
           'manager'          => $manager,
           'member'           => $member,
           'oAdmin'           => $this,
           'IsLoggedinMenu'   => $IsLoggedinMenu,
           'IsActivationMenu' => $IsActivationMenu,
           'IsIntroMenu'      => $IsIntroMenu,
           'IsMysql'          => 'mysql' === $DB_DRIVER_NAME,
        ];
        echo \parseBlade('admin.quickmenu', $params), "\n";
    }

    /**
     * @todo document this
     */
    public function action_regfile()
    {
        global $member, $CONF, $manager;

        $blogid = intRequestVar('blogid');

        $member->teamRights($blogid) or $this->disallow();

        if ( ! function_exists('mb_convert_encoding')) {
            $this->disallow();
        }

        if ( ! BLOG::existsID($blogid)) {
            $this->disallow();
        }

        $utf8BlogName = getBlogNameFromID($blogid);
        $utf8BlogName = str_replace('\\', '', $utf8BlogName); // remove registry path separator
        $utf8BlogName = str_replace(["\r", "\n"], '', $utf8BlogName); // remove cr lf
        $format       = _WINREGFILE_TEXT;
        $reg_key_name = sprintf($format, $utf8BlogName);

        $blog            = $manager->getBlog($blogid);
        $output_filename = sprintf("nucleus-%s.reg", str_replace('\\', '', $blog->getShortName()));

        $lines   = [];
        $lines[] = "Windows Registry Editor Version 5.00";
        $lines[] = "";
        $lines[] = "[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\" . $reg_key_name . "]";
        $url     = $CONF['AdminURL'] . "bookmarklet.php?action=contextmenucode&blogid=" . (int) $blogid;
        $lines[] = sprintf('@="%s"', $url);
        $lines[] = '"contexts"=hex:31';      // https://msdn.microsoft.com/ja-jp/library/aa753589(v=vs.85).aspx

        // UTF16-little endian
        $data = "\xFF\xFE" . mb_convert_encoding(implode("\r\n", $lines), 'UTF-16LE', 'UTF-8');

        header('Content-Type: application/octetstream');
        header(sprintf('Content-Disposition: filename="%s"', $output_filename));
        header(sprintf('Content-Length: %d', strlen($data)));
        header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
        header('Pragma: no-cache'); // HTTP/1.0
        header('Expires: Sun, 01 Jan 2017 00:00:00 GMT');   // Date in the past

        echo $data; // output data
        exit;
    }

    /**
     * @todo document this
     */
    public function action_bookmarklet()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->teamRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);
        $bm   = getBookmarklet($blogid);

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';

        ?>

                <h2><?php echo _BOOKMARKLET_TITLE ?></h2>

                <p>
        <?php echo _BOOKMARKLET_DESC1 . _BOOKMARKLET_DESC2 . _BOOKMARKLET_DESC3 . _BOOKMARKLET_DESC4 . _BOOKMARKLET_DESC5 ?>
                </p>

                <h3><?php echo _BOOKMARKLET_BOOKARKLET ?></h3>
                <p>
        <?php echo _BOOKMARKLET_BMARKTEXT ?><small><?php echo _BOOKMARKLET_BMARKTEST ?></small>
                    <br />
                    <br />
        <?php echo '<a href="' . hsc($bm) . '">' . sprintf(_BOOKMARKLET_ANCHOR, hsc($blog->getName())) . '</a>' . _BOOKMARKLET_BMARKFOLLOW; ?>
                </p>

                <h3><?php echo _BOOKMARKLET_RIGHTCLICK ?></h3>
                <p>
        <?php
                                    $url = 'index.php?action=regfile&blogid=' . (int) $blogid;
        $url                             = $manager->addTicketToUrl($url);
        ?><?php
if ('Japanese_Japan.932' == setlocale(LC_CTYPE, 0)) {
    $tmpurl = hsc($url, ENT_QUOTES, "SJIS");
} else {
    $tmpurl = hsc($url);
}
        echo _BOOKMARKLET_RIGHTTEXT1 . '<a href="' . $tmpurl . '">' . _BOOKMARKLET_RIGHTLABEL . '</a>' . _BOOKMARKLET_RIGHTTEXT2;
        ?>
                </p>

                <p>
                    <?php echo _BOOKMARKLET_RIGHTTEXT3 ?>
                </p>

                <h3><?php echo _BOOKMARKLET_UNINSTALLTT ?></h3>
                <p>
        <?php echo _BOOKMARKLET_DELETEBAR ?>
                </p>

                <p>
        <?php echo _BOOKMARKLET_DELETERIGHTT ?>
                </p>

                <ol>
                    <li><?php echo _BOOKMARKLET_DELETERIGHT1 ?></li>
                    <li><?php echo _BOOKMARKLET_DELETERIGHT2 ?></li>
                    <li><?php echo _BOOKMARKLET_DELETERIGHT3 ?></li>
                    <li><?php echo _BOOKMARKLET_DELETERIGHT4 ?></li>
                    <li><?php echo _BOOKMARKLET_DELETERIGHT5 ?></li>
                </ol>

            <?php

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_actionlog()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        $url = $manager->addTicketToUrl('index.php?action=clearactionlog');

        $ticket = $manager->getHtmlInputTicketHidden();
        $title  = _ACTIONLOG_CLEAR_TEXT;
        $form   = <<<EOL
<form action="index.php?action=clearactionlog" method="post">
{$ticket}
<input type="submit" value="{$title}">
</form>
EOL;
        echo sprintf('<h2>%s</h2>', _ACTIONLOG_CLEAR_TITLE);
        echo sprintf('<div>%s</div>', $form);

        echo '<h2>' . _ACTIONLOG_TITLE . '</h2>';

        // cut big message
        $colmessage = "CASE WHEN CHAR_LENGTH(`message`) < 2000 THEN `message`
                       ELSE CONCAT(SUBSTRING(`message`, 1, 2000), ' ...') END as 'message' ";
        $query = sprintf(
            "SELECT timestamp, %s FROM %s ORDER BY timestamp DESC",
            $colmessage,
            sql_table('actionlog')
        );
        $template['content'] = 'actionlist';
        $amount              = showlist_by_query($query, 'table', $template);

        if (SYSTEMLOG::checkWritable()) {
            echo '<h2>' . _SYSTEMLOG_TITLE . '</h2>';
            echo sprintf('<p><a href="index.php?action=systemlog">%s</a></p>', _SYSTEMLOG_TITLE);
        }

        $this->pagefoot();
    }

    public function action_systemlog()
    {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();
        if ( ! SYSTEMLOG::checkWritable()) {
            $this->disallow();
        }

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        $ticket = $manager->getHtmlInputTicketHidden();
        $title  = _SYSTEMLOG_CLEAR_TEXT;
        $form   = <<<EOL
<form action="index.php?action=clearsystemlog" method="post">
{$ticket}
<input type="submit" value="{$title}">
</form>
EOL;
        echo sprintf('<h2>%s</h2>', _SYSTEMLOG_CLEAR_TITLE);
        echo sprintf('<div>%s</div>', $form);

        echo '<h2>' . _SYSTEMLOG_TITLE . '</h2>';

        $query = sprintf("SELECT * FROM %s ORDER BY timestamp_utc DESC", sql_table('systemlog'));
        // Todo: seek
        // display first 20 entry. if want more info, make it plugin
        $query .= ' LIMIT 20';

        $template['content'] = 'systemloglist';
        $amount              = showlist_by_query($query, 'table', $template);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_banlist()
    {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACK_YR_HOME,')</a></p>';

        echo '<h2>' . _BAN_TITLE . " '" . $this->bloglink($blog) . "'</h2>";

        $query               = sprintf("SELECT * FROM %s WHERE blogid=%s ORDER BY iprange", sql_table('ban'), $blogid);
        $template['content'] = 'banlist';
        $amount              = showlist_by_query($query, 'table', $template);

        if (0 == $amount) {
            echo _BAN_NONE;
        }

        echo '<h2>' . _BAN_NEW_TITLE . '</h2>';
        echo "<p><a href='index.php?action=banlistnew&amp;blogid={$blogid}'>" . _BAN_NEW_TEXT . "</a></p>";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_banlistdelete()
    {
        global $member, $manager;

        $blogid  = intRequestVar('blogid');
        $iprange = requestVar('iprange');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog        = &$manager->getBlog($blogid);
        $banBlogName = hsc($blog->getName());

        $this->pagehead();
        ?>
                <h2><?php echo _BAN_REMOVE_TITLE ?></h2>

                <form method="post" action="index.php">

                    <h3><?php echo _BAN_IPRANGE ?></h3>

                    <p>
        <?php echo _CONFIRMTXT_BAN ?> <?php echo hsc($iprange) ?>
                        <input name="iprange" type="hidden" value="<?php echo hsc($iprange) ?>" />
                    </p>

                    <h3><?php echo _BAN_BLOGS ?></h3>

                    <div>
                        <input type="hidden" name="blogid" value="<?php echo $blogid ?>" />
                        <input name="allblogs" type="radio" value="0" id="allblogs_one" />
                        <label for="allblogs_one"><?php echo sprintf(_BAN_BANBLOGNAME, $banBlogName) ?></label>
                        <br />
                        <input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS ?></label>
                    </div>

                    <h3><?php echo _BAN_DELETE_TITLE ?></h3>

                    <div>
        <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="action" value="banlistdeleteconfirm" />
                        <input type="submit" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                    </div>

                </form>
            <?php
            $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_banlistdeleteconfirm()
    {
        global $member, $manager;

        $blogid   = intPostVar('blogid');
        $allblogs = postVar('allblogs');
        $iprange  = postVar('iprange');

        $member->blogAdminRights($blogid) or $this->disallow();

        $deleted = [];

        if ( ! $allblogs) {
            if (BAN::removeBan($blogid, $iprange)) {
                $deleted[] = $blogid;
            }
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            foreach ($adminblogs as $blogje) {
                if (BAN::removeBan($blogje, $iprange)) {
                    $deleted[] = $blogje;
                }
            }
        }

        if (0 == count($deleted)) {
            $this->error(_ERROR_DELETEBAN);
        }

        $this->pagehead();

        echo '<a href="index.php?action=banlist&amp;blogid=', $blogid, '">(', _BACK, ')</a>';
        echo '<h2>' . _BAN_REMOVED_TITLE . '</h2>';
        echo "<p>" . _BAN_REMOVED_TEXT . "</p>";

        echo "<ul>";
        foreach ($deleted as $delblog) {
            $b = &$manager->getBlog($delblog);
            echo "<li>" . hsc($b->getName()) . "</li>";
        }
        echo "</ul>";

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_banlistnewfromitem()
    {
        $this->action_banlistnew(getBlogIDFromItemID(intRequestVar('itemid')));
    }

    /**
     * @todo document this
     */
    public function action_banlistnew($blogid = '')
    {
        global $member, $manager;

        if ('' == $blogid) {
            $blogid = intRequestVar('blogid');
        }

        $ip = requestVar('ip');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog = &$manager->getBlog($blogid);

        $this->pagehead();
        ?>
                <h2><?php echo _BAN_ADD_TITLE ?></h2>


                <form method="post" action="index.php">

                    <h3><?php echo _BAN_IPRANGE ?></h3>

                    <p><?php echo _BAN_IPRANGE_TEXT ?></p>

                    <div class="note">
                        <strong><?php echo _BAN_EXAMPLE_TITLE ?></strong>
        <?php echo _BAN_EXAMPLE_TEXT ?>
                    </div>

                    <div>
        <?php
        if ($ip) {
            $iprangeVal = hsc($ip);
            ?>
                            <input name="iprange" type="radio" value="<?php echo $iprangeVal ?>" checked="checked" id="ip_fixed" />
                            <label for="ip_fixed"><?php echo $iprangeVal ?></label>
                            <br />
                            <input name="iprange" type="radio" value="custom" id="ip_custom" />
                            <label for="ip_custom"><?php echo _BAN_IP_CUSTOM ?></label>
                            <input name='customiprange' value='<?php echo $iprangeVal ?>' maxlength='15' size='15' />
                                        <?php
        } else {
            echo "<input name='iprange' value='custom' type='hidden' />";
            echo "<input name='customiprange' value='' maxlength='15' size='15' />";
        }
        ?>
                    </div>

                    <h3><?php echo _BAN_BLOGS ?></h3>

                    <p><?php echo _BAN_BLOGS_TEXT ?></p>

                    <div>
                        <input type="hidden" name="blogid" value="<?php echo $blogid ?>" />
                        <input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">'<?php echo hsc($blog->getName()) ?>'</label>
                        <br />
                        <input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS ?></label>
                    </div>

                    <h3><?php echo _BAN_REASON_TITLE ?></h3>

                    <p><?php echo _BAN_REASON_TEXT ?></p>

                    <div><textarea name="reason" cols="40" rows="5"></textarea></div>

                    <h3><?php echo _BAN_ADD_TITLE ?></h3>

                    <div>
                        <input name="action" type="hidden" value="banlistadd" />
                        <?php $manager->addTicketHidden() ?>
                        <input type="submit" value="<?php echo _BAN_ADD_BTN ?>" />
                    </div>

                </form>

            <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_banlistadd()
    {
        global $member;

        $blogid   = intPostVar('blogid');
        $allblogs = postVar('allblogs');
        $iprange  = postVar('iprange');
        if ("custom" == $iprange) {
            $iprange = postVar('customiprange');
        }
        $reason = postVar('reason');

        $member->blogAdminRights($blogid) or $this->disallow();

        // TODO: check IP range validity

        if ( ! $allblogs) {
            if ( ! BAN::addBan($blogid, $iprange, $reason)) {
                $this->error(_ERROR_ADDBAN);
            }
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            $failed     = 0;
            foreach ($adminblogs as $blogje) {
                if ( ! BAN::addBan($blogje, $iprange, $reason)) {
                    $failed = 1;
                }
            }
            if ($failed) {
                $this->error(_ERROR_ADDBAN);
            }
        }

        $this->action_banlist();
    }

    /**
     * @todo document this
     */
    public function action_clearactionlog()
    {
        global $member;

        if ( ! $member->isAdmin()
            || empty($_SERVER['REQUEST_METHOD'])
            || (0 != strcasecmp($_SERVER['REQUEST_METHOD'], 'post'))
        ) {
            $this->disallow();
        }

        ACTIONLOG::clear();

        $this->action_manage(_MSG_ACTIONLOGCLEARED);
    }

    public function action_clearsystemlog()
    {
        global $member;

        if ( ! $member->isAdmin() || empty($_SERVER['REQUEST_METHOD'])
            || (0 != strcasecmp($_SERVER['REQUEST_METHOD'], 'post'))
            || ! class_exists('SYSTEMLOG')
            || ! SYSTEMLOG::checkWritable()
        ) {
            $this->disallow();
        }

        SYSTEMLOG::clearAll();

        $this->action_manage(_MSG_SYSTEMLOGCLEARED);
    }

    /**
     * @todo document this
     */
    public function action_backupoverview()
    {
        global $member, $manager, $DB_DRIVER_NAME;

        $member->isAdmin() or $this->disallow();

        if ('mysql' != $DB_DRIVER_NAME) {
            $this->disallow();
        }

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';
        ?>
                <h2><?php echo _BACKUPS_TITLE ?></h2>

                <h3><?php echo _BACKUP_TITLE ?></h3>

                <p><?php echo _BACKUP_INTRO ?></p>

                <form method="post" action="index.php">
                    <p>
                        <input type="hidden" name="action" value="backupcreate" />
        <?php $manager->addTicketHidden() ?>

                        <input type="radio" name="gzip" value="1" checked="checked" id="gzip_yes" tabindex="10" /><label for="gzip_yes"><?php echo _BACKUP_ZIP_YES ?></label>
                        <br />
                        <input type="radio" name="gzip" value="0" id="gzip_no" tabindex="10" /><label for="gzip_no"><?php echo _BACKUP_ZIP_NO ?></label>
                        <br /><br />
                        <input type="submit" value="<?php echo _BACKUP_BTN ?>" tabindex="20" />

                    </p>
                </form>

                <div class="note"><?php echo _BACKUP_NOTE ?></div>


                <h3><?php echo _RESTORE_TITLE ?></h3>

                <div class="note"><?php echo _RESTORE_NOTE ?></div>

                <p><?php echo _RESTORE_INTRO ?></p>

                <form method="post" action="index.php" enctype="multipart/form-data">
                    <p>
                        <input type="hidden" name="action" value="backuprestore" />
        <?php $manager->addTicketHidden() ?>
                        <input name="backup_file" type="file" tabindex="30" />
                        <br /><br />
                        <input type="submit" value="<?php echo _RESTORE_BTN ?>" tabindex="40" />
                        <br /><input type="checkbox" name="letsgo" value="1" id="letsgo" tabindex="50" /><label for="letsgo"><?php echo _RESTORE_IMSURE ?></label>
                        <br /><?php echo _RESTORE_WARNING ?>
                    </p>
                </form>

            <?php $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_backupcreate()
    {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        // use compression ?
        $useGzip = (int) postVar('gzip');

        include($DIR_LIBS . 'backup.php');

        // try to extend time limit
        // (creating/restoring dumps might take a while)
        @set_time_limit(1200);

        $bu = new Backup();
        $bu->do_backup($useGzip);
        exit;
    }

    /**
     * @todo document this
     */
    public function action_backuprestore()
    {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        if (1 != intPostVar('letsgo')) {
            $this->error(_ERROR_BACKUP_NOTSURE);
        }

        include($DIR_LIBS . 'backup.php');

        // try to extend time limit
        // (creating/restoring dumps might take a while)
        @set_time_limit(1200);

        $bu      = new Backup();
        $message = $bu->do_restore();
        if ('' != $message) {
            $this->error($message);
        }

        $this->pagehead();
        ?>
                <h2><?php echo _RESTORE_COMPLETE ?></h2>
            <?php $this->pagefoot();
    }

    private function force_rename_plugin_dir()
    {
        global $DIR_PLUGINS;
        $path = @realpath($DIR_PLUGINS); // Since $DIR_PLUGINS is a user input value, it converts it to an absolute path
        if (empty($DIR_PLUGINS) || empty($path) || ! is_dir($path)) {
            return;
        }
        $path = str_replace('\\', '/', $path) . '/';

        // try force rename NP_Folder to shortname
        $a = glob("{$path}NP_*", GLOB_ONLYDIR);
        if ( ! empty($a)) {
            foreach ($a as $dirname) {
                $basename = basename($dirname);
                if (preg_match('#NP_([0-9a-zA-Z_]+)#', $basename, $m)
                   && ( ! @file_exists(dirname($dirname) . '/' . strtolower($m[1])))
                ) {
                    @rename($dirname, dirname($dirname) . '/' . strtolower($m[1]));
                }
            }
        }

        // try force move  NP_file into shortname
        $a = glob("{$path}NP_*.php");
        if (empty($a)) {
            return;
        }
        // check and force move to type2
        foreach ($a as $fullfilename) {
            if (@is_file($fullfilename) && preg_match('#^NP_(.+?)\.php$#', basename($fullfilename), $m)) {
                MANAGER::getPluginTypePathWithForceRename($m[1]);
            }
        }
    }

    public function action_settings_remote_update()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $member->updateOption('system', 'enable_remote_update', '0');
        redirect(CONF::asStr('AdminURL') . '?action=pluginlist');
    }

    /*
     * @todo document this
     */
    public function action_pluginlist()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        $this->force_rename_plugin_dir();

        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';

        echo '<h2>', _PLUGS_TITLE_MANAGE, ' ', help('plugins'), '</h2>';

        echo '<h3>', _PLUGS_TITLE_INSTALLED, ' &nbsp;&nbsp;<span style="font-size:smaller">', helplink('getplugins'), _PLUGS_TITLE_GETPLUGINS, '</a></span></h3>';

        $enable_remote_update = CONF::asBool('ENABLE_PLUGIN_UPDATE_CHECK') && (int) $member->getOption('system', 'enable_remote_update', '1');
        if ( ! class_exists('ZipArchive')) {
            printf('<div class="note" style="float: right">%s</div><br /><br />', 'Not Installed PHP:ZipArchive');
        } elseif ($enable_remote_update) {
            echo '<div style="float: right">';
            ?>       <form method="post" action="index.php">
                        <div>
                            <input type="hidden" name="action" value="settings_remote_update" />
                            <?php $manager->addTicketHidden() ?>
                            <input type="submit" value="<?php echo escapeHTML(_ADMIN_TEXT_DONOTUSEUPDATENOTIFICATIONSANDDOWNLOADS) ?>" tabindex="20" />
                        </div>
                    </form></div>
            <?php
        }

        $query = sprintf("SELECT * FROM %s ORDER BY porder ASC", sql_table('plugin'));

        $template['content']  = 'pluginlist';
        $template['tabindex'] = 10;
        showlist_by_query($query, 'table', $template);

        ?>
                <h3><?php echo _PLUGS_TITLE_UPDATE ?></h3>

                <p><?php echo _PLUGS_TEXT_UPDATE ?></p>

                <form method="post" action="index.php">
                    <div>
                        <input type="hidden" name="action" value="pluginupdate" />
                        <?php $manager->addTicketHidden() ?>
                        <input type="submit" value="<?php echo _PLUGS_BTN_UPDATE ?>" tabindex="20" />
                    </div>
                </form>

                <h3><?php echo _PLUGS_TITLE_NEW ?></h3>

        <?php
        $list_installed_PluginName = [];
        $sql                       = sprintf("SELECT pfile FROM %s ORDER BY pfile ASC", sql_table('plugin'));
        if ($res = sql_query($sql)) {
            while ($v = sql_fetch_array($res)) {
                $list_installed_PluginName[$v[0]] = strtolower($v[0]); // np_name
            }
        }
        // find a list of possibly non-installed plugins
        $candidates = [];
        global $DIR_PLUGINS;

        // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
        $status  = [];
        $plugins = getPluginListsFromDirName($DIR_PLUGINS, $status, true);
        //var_dump(__FUNCTION__, $status, $plugins);
        if ($status['result'] && count($plugins) > 0) {
            foreach ($plugins as $key => $value) {
                $name = $value['name'];
                // only show in list when not yet installed
                if ( ! in_array(strtolower('NP_' . $name), $list_installed_PluginName)) {
                    $candidates[] = $name;
                }
            }
        }

        if (count($candidates) > 0) {
            $options = [];
            foreach ($candidates as $name) {
                $np_name  = "NP_{$name}";
                $shorname = strtolower($name);
                $file     = "{$DIR_PLUGINS}{$shorname}/{$np_name}.php";
                $file1    = "{$DIR_PLUGINS}{$np_name}.php";
                if ( ! @is_file($file)) {
                    $file = $file1;
                }
                $isvalid = $manager->checkifValidPluginBeforeLoad($file);
                if ($isvalid) {
                    $options[] = sprintf('  <option value="NP_%s">%s</option>', $name, hsc($name));
                } else {
                    $options[] = sprintf('  <option value="NP_%s" disabled><red>[&#10060;]</red> %s</option>', $name, hsc($name));
                }
            }
            $options_tag = implode("\n  ", $options);

            echo "<p>" . _PLUGS_ADD_TEXT . "</p>\n";

            echo "<form method='post' action='index.php'><div>\n";
            echo "  <input type='hidden' name='action' value='pluginadd' />\n";
            echo "  " . $manager->getHtmlInputTicketHidden() . "\n";
            echo '  <select name="filename" tabindex="30">' . $options_tag . "</select>\n";
            echo sprintf("  <input type='submit' tabindex='40' value='%s' />\n", _PLUGS_BTN_INSTALL);
            echo "</div></form>\n";
        } else {
            echo '<p>', _PLUGS_NOCANDIDATES, '</p>';
        }

        if ($enable_remote_update && class_exists('ZipArchive')) {
            // リモートからダウンロード
            echo '<h3>' . _ADMIN_TEXT_REMOTE_DOWNLOAD . '</h3>';
            echo "<form method='post' action='index.php'><div>\n";
            echo "  <input type='hidden' name='action' value='plugindownload' />\n";
            echo "  " . $manager->getHtmlInputTicketHidden() . "\n";
            $options = [];
            foreach ($this->getSortedDownloadList($list_installed_PluginName) as $item) {
                $options[] = sprintf('  <option value="NP_%s">%s</option>', $item['name'], $item['icon'] . hsc($item['name']));
            }
            $options_tag = implode("\n  ", $options);
            echo '  <select name="pluginname" tabindex="30">' . $options_tag . "</select>\n";
            echo sprintf("  <input type='submit' tabindex='40' value='%s' />\n", _ADMIN_TEXT_DOWNLOAD_PL_FOLDER);
            echo "</div></form>\n";
        }

        echo "\n";
        $this->pagefoot();
    }

    private function getSortedDownloadList(&$lc_np_name_installedlist = null)
    {
        global $DIR_PLUGINS, $manager;
        $lists = [];
        // 💻: &#x1F4BB;
        // 📁: &#x1F4C1;
        foreach (self::getPickupDownloadList() as $i => $name) {
            $item = ['name' => $name, 'icon' => '', 'order0' => $i, 'state' => 0];
            if (in_array('np_'.strtolower($name), (array) $lc_np_name_installedlist)) {
                $item['icon']  = '[&#x1F4BB;] ';
                $item['state'] = 2;
                $fullfilename  = $DIR_PLUGINS.sprintf("%s/NP_%s.php", strtolower($name), $name);
                //if ( ! @is_file($fullfilename)) {
                if ( ! $manager->checkifValidPluginBeforeLoad($fullfilename)) {
                    $item['icon']  = '[&#x1F6A8;] ';
                    $item['state'] = 3;
                    //⚠️ - &#x26A0;
                    //🛑 - &#x1F6D1;
                    //🚨 - &#x1F6A8;
                }
            } elseif (@is_file($DIR_PLUGINS.sprintf("%s/NP_%s.php", strtolower($name), $name))) {
                $item['icon']  = '[&#x1F4C1;] ';
                $item['state'] = 1;
            }
            $lists[] = $item;
        }
        // sort
        uasort($lists, function ($a, $b) {
            $res = $a['order0'] > $b['order0'] ? 1 : -1;
            if ($a['state'] && $b['state']) {
                if ($a['state'] === $b['state']) {
                    return $res;
                }
                return $a['state'] > $b['state'] ? -1 : 1;
            }
            if ($a['state']) {
                return -1;
            }
            if ($b['state']) {
                return 1;
            }
            return $res;
        });
        return $lists;
    }

    public static function canRemoteDownload($name): bool
    {
        $lists = self::get_remote_plugin_list();

        if (str_starts_with(strtolower($name), 'np_')) {
            $lc_np_name = strtolower($name);
        } else {
            $lc_np_name = 'np_'.strtolower($name);
        }
        if (empty($lists) || ! isset($lists[$lc_np_name])) {
            return false;
        }
        $a = self::getDisallowDownloadList();
        foreach ($a as $v) {
            $lc = 'np_'.strtolower($v);
            if ($lc_np_name === $lc) {
                return false;
            }
        }
        return true;
    }

    public static function getPickupDownloadList()
    {
        $a = [
            'CKEditor',    // Editor
            'CustomURL',  // not work, broken
            'ExtraSkinJP',
            'ImpExp',     // not work, broken / Export to MT file
            'LinkCounter',
            'MultipleCategories',
            'StickyIt',
            'znBackupNeo', //'znMCList',
        ];
        $b = self::get_remote_plugin_list();
        $c = array_map(fn ($s) => 'np_'.strtolower($s), self::getDisallowDownloadList());
        if ( ! empty($b)) {
            foreach ($b as $lc_np_name => $item) {
                if ( ! in_array($lc_np_name, $c)
                        && isset($item['name'])
                        && preg_match('#^NP_(.+)$#', $item['name'], $m)
                        && ! in_array($m[1], $a)
                ) {
                    $a[] = $m[1];
                }
            }
        }

        return $a;
    }

    public static function getDisallowPluginList()
    {
        return [
           'Analyze',    // dangerous plugin, be seriously injured
        ];
    }

    public static function getDisallowDownloadList()
    {
        $list = [
           'TinyMCE',    // not work, broken
           'TinyMCE4',    // not work, broken
        ];
        $list = array_merge($list, self::getDisallowPluginList());
        sort($list);
        return $list;
    }

    public function action_plugindownload()
    {
        global $member;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $np_name = preg_replace('#[^0-9a-z_]+#i', '', PostVar::asStr('pluginname'));

        $allow = self::getPickupDownloadList();
        if ( ! preg_match('#^NP_(.+)$#', $np_name, $m)
            || ! self::canRemoteDownload($np_name)
//            || ! in_array($m[1], $allow)
            || in_array($m[1], self::getDisallowDownloadList())
        ) {
            redirect('?action=pluginlist');
        }

        // Download plugin
        $success = self::download_plugin($np_name);

        if ($success) {
            // check exists
            $sql = sprintf(
                'SELECT count(*) FROM `%s` WHERE lower(pfile) = %s',
                sql_table('plugin'),
                sql_quote_string(strtolower($np_name))
            );
            if ((int) quickQuery($sql)) {
                // update all events
                $this->action_pluginupdate();
            }
        }

        redirect('?action=pluginlist');
    }

    public static function download_plugin($np_name): bool
    {
        global $DIR_NUCLEUS, $DIR_PLUGINS;
        $np_name    = preg_replace('#[^0-9a-z_]+#i', '', $np_name);
        $lc_np_name = strtolower($np_name);
        $shortname  = substr($lc_np_name, 3);
        if ( ! class_exists('ZipArchive') || ! str_starts_with($np_name, 'NP_')
            || empty($shortname)
            || in_array(substr($np_name, 3), self::getDisallowPluginList())) {
            return false;
        }
        $extract_dir = $DIR_PLUGINS . $shortname;
        $cache_dir   = $DIR_NUCLEUS . 'cache';
        if ( ! @is_dir($DIR_PLUGINS) || ! @is_writable($DIR_PLUGINS)
            || ! @is_dir($cache_dir) || ! @is_writable($cache_dir)) {
            return false;
        }

        $branch = 'master';
        $lists  = self::get_remote_plugin_list();
        if ( ! empty($lists) && isset($lists[$lc_np_name]) && isset($lists[$lc_np_name]['default_branch'])) {
            $branch = $lists[$lc_np_name]['default_branch'] ?? 'master';
        }

        $options = [
            'useragent' => DEFAULT_USER_AGENT,
        ];
        $url        = sprintf('https://github.com/NucleusCMS/%s/archive/refs/heads/%s.zip', $np_name, $branch);
        $zip_memory = file_get_contents($url); //Utils::httpGet($url, $options);
        if (false === $zip_memory) {
            return false;
        }
        $tmpfile = tempnam($cache_dir, 'tmp');
        if (false === $tmpfile) {
            return false;
        }
        $result = false;
        try {
            if (false !== @file_put_contents($tmpfile, $zip_memory)) {
                $np_files = [];
                $zip      = new ZipArchive();
                if ($zip && true === $zip->open($tmpfile)) {
                    // check filename and rename
                    try {
                        $rm_list = [
                            '.editorconfig',
                        ];
                        // search NP_ file
                        for ($i = 0; $i < $zip->numFiles; $i++) {
                            $filename = $zip->getNameIndex($i);
                            if ("{$np_name}.php" === $filename || str_ends_with($filename, "/{$np_name}.php")) {
                                $np_files[] = $filename;
                            }
                        }
                        if (empty($np_files)) {
                            return false;
                        }
                        sort($np_files);
                        $path      = dirname($np_files[0]) . '/';
                        $childpath = $path . $shortname . '/';
                        // Remove Files , drop layer
                        $i = $zip->numFiles;
                        while ($i > 0) {
                            $i--;
                            $filename = $zip->getNameIndex($i);
                            if ( ! str_starts_with($filename, $path)) {
                                $zip->deleteIndex($i);
                            } elseif (str_starts_with($filename, $childpath)) {
                                $newname = substr($filename, strlen($childpath));
                                if ('' === $newname || in_array(basename($newname), $rm_list)) {
                                    $zip->deleteIndex($i);
                                } else {
                                    $zip->renameIndex($i, $newname);
                                }
                            } else {
                                $newname = substr($filename, strlen($path));
                                if ('' === $newname || in_array(basename($newname), $rm_list)) {
                                    $zip->deleteIndex($i);
                                } else {
                                    $zip->renameIndex($i, $newname);
                                }
                            }
                        }
                    } finally {
                        $zip->close();
                    }
                    if ( ! @is_dir($extract_dir)) {
                        // move type1 --> type2
                        $shortname = substr($lc_np_name, 3);
                        if (@is_file($DIR_PLUGINS . $np_name . '.php') || @is_dir($DIR_PLUGINS . $shortname)) {
                            if (@mkdir($extract_dir)) {
                                if (@is_file($DIR_PLUGINS . $np_name . '.php')) {
                                    @rename($DIR_PLUGINS . $np_name . '.php', "{$extract_dir}/{$np_name}.php");
                                }
                                if (@is_dir($DIR_PLUGINS . $shortname)) {
                                    @rename($DIR_PLUGINS . $shortname, "{$extract_dir}/{$shortname}");
                                }
                            }
                        }
                    }
                    if ( ! empty($np_files) && true === $zip->open($tmpfile)) {
                        try {
                            $success = @$zip->extractTo($extract_dir);
                            $result  = $success ? true : false;
                        } finally {
                            $zip->close();
                        }
                    }
                }
            }
        } finally {
            @unlink($tmpfile); // Delete tmp file
        }
        return $result;
    }

    /**
     * @todo document this
     */
    public function action_pluginhelp()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');

        if ( ! $manager->pidInstalled($plugid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        $plugName = getPluginNameFromPid($plugid);

        $this->pagehead();

        echo '<p><a href="index.php?action=pluginlist">(', _PLUGS_BACK, ')</a></p>';

        echo '<h2>', _PLUGS_HELP_TITLE, ': ', hsc($plugName), '</h2>';

        $plug       = &$manager->getPlugin($plugName);
        $cplugindir = $plug->getDirectory();
        if (is_file("{$cplugindir}help.php")) {
            $helpFile = "{$cplugindir}help.php";
        } elseif (is_file("{$cplugindir}help.html")) {
            $helpFile = "{$cplugindir}help.html";
        } else {
            // help folder
            $locale = ! defined('_LOCALE') ? 'en' : substr(strtolower(_LOCALE), 0, 2);
            foreach (['index.php', "help-{$locale}.md", 'help.md', 'help-en.md', 'index.html'] as $f) {
                if (is_file("{$cplugindir}help/{$f}")) {
                    $helpFile = "{$cplugindir}help/{$f}";
                    break;
                }
            }
        }

        if (($plug->supportsFeature('HelpPage') > 0) && isset($helpFile) && (@is_file($helpFile))) {
            if ('.php' === substr($helpFile, -4)) {
                include_once($helpFile);
            } elseif ('.md' === substr($helpFile, -3)) {
                $s = parseMarkdownFile($helpFile);
                if (false !== $s) {
                    echo $s;
                }
            } else {
                @readfile($helpFile);
            }
        } else {
            echo '<p>' . _ERROR . ': ', _ERROR_PLUGNOHELPFILE, '</p>';
            echo '<p><a href="index.php?action=pluginlist">(', _BACK, ')</a></p>';
        }

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_pluginadd()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $name = postVar('filename');

        if ($manager->pluginInstalled($name)) {
            $this->error(_ERROR_DUPPLUGIN);
        }
        if ( ! checkPlugin($name)) {
            $this->error(_ERROR_PLUGFILEERROR . ' (' . hsc($name) . ')');
        }

        // get number of currently installed plugins
        $res        = sql_query(sprintf("SELECT count(*) FROM %s", sql_table('plugin')));
        $numCurrent = (int) sql_result($res);

        // plugin will be added as last one in the list
        $newOrder = $numCurrent + 1;

        $param = [
            'file' => &$name,
        ];
        $manager->notify('PreAddPlugin', $param);

        // do this before calling getPlugin (in case the plugin id is used there)
        $query = sprintf(
            'INSERT INTO %s (porder, pfile) VALUES (%d, %s)',
            sql_table('plugin'),
            $newOrder,
            sql_quote_string($name)
        );
        sql_query($query);
        $iPid = sql_insert_id();

        $manager->clearCachedInfo('installedPlugins');

        // Load the plugin for condition checking and instalation
        $plugin = &$manager->getPlugin($name);

        // check if it got loaded (could have failed)
        if ( ! $plugin) {
            sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE pid=' . (int) $iPid);
            $manager->clearCachedInfo('installedPlugins');
            $this->error(_ERROR_PLUGIN_LOAD);
        }

        // check if plugin needs a newer Nucleus version
        if (getNucleusVersion() < $plugin->getMinNucleusVersion()) {
            // uninstall plugin again...
            $this->deleteOnePlugin($plugin->getID());

            // ...and show error
            $this->error(_ERROR_NUCLEUSVERSIONREQ . hsc($plugin->getMinNucleusVersion()));
        }

        // check if plugin needs a newer Nucleus version
        if ((getNucleusVersion() == $plugin->getMinNucleusVersion()) && (getNucleusPatchLevel() < $plugin->getMinNucleusPatchLevel())) {
            // uninstall plugin again...
            $this->deleteOnePlugin($plugin->getID());

            // ...and show error
            $this->error(_ERROR_NUCLEUSVERSIONREQ . hsc($plugin->getMinNucleusVersion() . ' patch ' . $plugin->getMinNucleusPatchLevel()));
        }

        $pluginList = $plugin->getPluginDep();
        foreach ($pluginList as $pluginName) {
            $res = sql_query(sprintf("SELECT count(*) FROM %s WHERE pfile='%s'", sql_table('plugin'), $pluginName));
            $ct  = (int) sql_result($res);
            if (0 == $ct) {
                // uninstall plugin again...
                $this->deleteOnePlugin($plugin->getID());

                $this->error(sprintf(_ERROR_INSREQPLUGIN, hsc($pluginName)));
            }
        }

        // call the install method of the plugin
        $plugin->install();

        $param = [
            'plugin' => &$plugin,
        ];
        $manager->notify('PostAddPlugin', $param);

        // update all events
        $this->action_pluginupdate();
    }

    /**
     * @todo document this
     */
    public function action_pluginupdate()
    {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        // delete everything from plugin_events
        sql_query(sprintf("DELETE FROM %s", sql_table('plugin_event')));

        // loop over all installed plugins
        $res = sql_query(sprintf("SELECT pid, pfile FROM %s", sql_table('plugin')));
        while ($o = sql_fetch_object($res)) {
            $pid  = $o->pid;
            $plug = &$manager->getPlugin($o->pfile);
            if ($plug) {
                $eventList = $plug->_getEventList();
                foreach ($eventList as $eventName) {
                    sql_query(sprintf("INSERT INTO %s (pid, event) VALUES (%s, %s)", sql_table('plugin_event'), $pid, sql_quote_string($eventName)));
                }
            }
        }
        $manager->_loadSubscriptions();
        $data = [];
        $manager->notify('PostUpdatePlugin', $data);

        redirect($CONF['AdminURL'] . '?action=pluginlist');
        //        $this->action_pluginlist();
    }

    /**
     * @todo document this
     */
    public function action_plugindelete()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intGetVar('plugid');

        if ( ! $manager->pidInstalled($pid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        $this->pagehead();
        ?>
                <h2><?php echo _DELETE_CONFIRM ?></h2>

                <p><?php echo _CONFIRMTXT_PLUGIN ?> <strong><?php echo getPluginNameFromPid($pid) ?></strong>?</p>

                <form method="post" action="index.php">
                    <div>
        <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="action" value="plugindeleteconfirm" />
                        <input type="hidden" name="plugid" value="<?php echo $pid; ?>" />
                        <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
                    </div>
                </form>
            <?php
            $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_plugindeleteconfirm()
    {
        global $member, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intPostVar('plugid');

        $error = $this->deleteOnePlugin($pid, 1);
        if ($error) {
            $this->error($error);
        }

        redirect($CONF['AdminURL'] . '?action=pluginlist');
        //        $this->action_pluginlist();
    }

    /**
     * @todo document this
     */
    public function deleteOnePlugin($pid, $callUninstall = 0)
    {
        global $manager;

        $pid = (int) $pid;

        if ( ! $manager->pidInstalled($pid)) {
            return _ERROR_NOSUCHPLUGIN;
        }

        $name = quickQuery(sprintf("SELECT pfile as result FROM %s WHERE pid=%s", sql_table('plugin'), $pid));

        /*        // call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin =& $manager->getPlugin($name);
            if ($plugin) $plugin->unInstall();
        }*/

        // check dependency before delete
        $res = sql_query(sprintf("SELECT pfile FROM %s", sql_table('plugin')));
        while ($o = sql_fetch_object($res)) {
            $plug = &$manager->getPlugin($o->pfile);
            if ($plug) {
                $depList = $plug->getPluginDep();
                foreach ($depList as $depName) {
                    if ($name == $depName) {
                        return sprintf(_ERROR_DELREQPLUGIN, $o->pfile);
                    }
                }
            }
        }

        $param = ['plugid' => $pid];
        $manager->notify('PreDeletePlugin', $param);

        // call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin = &$manager->getPlugin($name);
            if ($plugin) {
                $plugin->unInstall();
            }
        }

        // delete all subscriptions
        sql_query('DELETE FROM ' . sql_table('plugin_event') . ' WHERE pid=' . $pid);

        // delete all options
        // get OIDs from plugin_option_desc
        $res   = sql_query(sprintf("SELECT oid FROM %s WHERE opid=%s", sql_table('plugin_option_desc'), $pid));
        $aOIDs = [];
        while ($o = sql_fetch_object($res)) {
            $aOIDs[] = $o->oid;
        }

        // delete from plugin_option and plugin_option_desc
        sql_query('DELETE FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
        if (count($aOIDs) > 0) {
            sql_query('DELETE FROM ' . sql_table('plugin_option') . ' WHERE oid in (' . implode(',', $aOIDs) . ')');
        }

        // update order numbers
        $res = sql_query(sprintf("SELECT porder FROM %s WHERE pid=%s", sql_table('plugin'), $pid));
        $o   = sql_fetch_object($res);
        sql_query('UPDATE ' . sql_table('plugin') . ' SET porder=(porder - 1) WHERE porder>' . $o->porder);

        // delete row
        sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE pid=' . $pid);

        // delete cached_data
        if (CoreCachedData::existTable()) {
            sql_query(sprintf(
                "DELETE FROM `%s` WHERE `cd_type` = 'plugin_remote_latest_version' AND `cd_sub_id` = %d",
                sql_table('cached_data'),
                $pid
            ));
        }

        $manager->clearCachedInfo('installedPlugins');
        $param = ['plugid' => $pid];
        $manager->notify('PostDeletePlugin', $param);

        return '';
    }

    /**
     * @todo document this
     */
    public function action_pluginup()
    {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');

        if ( ! $manager->pidInstalled($plugid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        // 1. get old order number
        $res      = sql_query(sprintf("SELECT porder FROM %s WHERE pid=%s", sql_table('plugin'), $plugid));
        $o        = sql_fetch_object($res);
        $oldOrder = $o->porder;

        // 2. calculate new order number
        $newOrder = ($oldOrder > 1) ? ($oldOrder - 1) : 1;

        // 3. update plug numbers
        sql_query('UPDATE ' . sql_table('plugin') . ' SET porder=' . $oldOrder . ' WHERE porder=' . $newOrder);
        sql_query('UPDATE ' . sql_table('plugin') . ' SET porder=' . $newOrder . ' WHERE pid=' . $plugid);

        //$this->action_pluginlist();
        // To avoid showing ticket in the URL, redirect to pluginlist, instead.
        redirect($CONF['AdminURL'] . '?action=pluginlist');
    }

    /**
     * @todo document this
     */
    public function action_plugindown()
    {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');
        if ( ! $manager->pidInstalled($plugid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        // 1. get old order number
        $res      = sql_query(sprintf("SELECT porder FROM %s WHERE pid=%s", sql_table('plugin'), $plugid));
        $o        = sql_fetch_object($res);
        $oldOrder = $o->porder;

        $res      = sql_query(sprintf("SELECT count(*) FROM %s", sql_table('plugin')));
        $maxOrder = (int) sql_result($res);

        // 2. calculate new order number
        $newOrder = ($oldOrder < $maxOrder) ? ($oldOrder + 1) : $maxOrder;

        // 3. update plug numbers
        sql_query('UPDATE ' . sql_table('plugin') . ' SET porder=' . $oldOrder . ' WHERE porder=' . $newOrder);
        sql_query('UPDATE ' . sql_table('plugin') . ' SET porder=' . $newOrder . ' WHERE pid=' . $plugid);

        //$this->action_pluginlist();
        // To avoid showing ticket in the URL, redirect to pluginlist, instead.
        redirect($CONF['AdminURL'] . '?action=pluginlist');
    }

    /**
     * @todo document this
     */
    public function action_pluginadmin($message = '')
    {
        // NOTE: MARKER_PLUGINS_PLUGINADMIN_FUEATURE
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intRequestVar('plugid');
        if ( ! $manager->pidInstalled($pid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        //        $o_plugin = $manager->pidLoaded($pid);
        $o_plugin = $manager->getPluginFromPid($pid);
        if ( ! $o_plugin || ! is_object($o_plugin)) {
            $this->error(_ERROR_PLUGFILEERROR . $o_plugin);
        }
        //
        $plugin_admin_php_file = $o_plugin->getDirectory() . 'index.php';
        if ( ! @is_file($plugin_admin_php_file)
            || ! str_contains((string) @file_get_contents($plugin_admin_php_file), 'new PluginAdmin(')
        ) {
            $this->error(_ERROR_PLUGFILEERROR);
        }

        $url = $manager->addTicketToUrl('index.php?plugid=' . $pid . '&action=pluginadmin');
        if ( ! defined('ENABLE_PLUGIN_ADMIN_V2')) {
            define('ENABLE_PLUGIN_ADMIN_V2', true);
        }
        if (ENABLE_PLUGIN_ADMIN_V2) {
            define('PLUGIN_ADMIN_BASE_URL', $url);
            //            $this->pagehead();
            include_once($plugin_admin_php_file);
            //            $this->pagefoot();
        } else {
            // TODO: redirect old admin page or Error message
            $this->pagehead();
            echo "not implemented";
            $this->pagefoot();
        }
    }

    /**
     * @todo document this
     */
    public function action_pluginoptions($message = '')
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intRequestVar('plugid');
        if ( ! $manager->pidInstalled($pid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        $extrahead  = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $pluginName = hsc(getPluginNameFromPid($pid));
        $this->pagehead($extrahead);

        ?>
                <p><a href="index.php?action=pluginlist">(<?php echo _PLUGS_BACK ?>)</a></p>

                <h2><?php echo sprintf(_PLUGIN_OPTIONS_TITLE, $pluginName) ?></h2>

        <?php if ($message) {
            echo $message;
        } ?>

                <form action="index.php" method="post">
                    <div>
                        <input type="hidden" name="action" value="pluginoptionsupdate" />
                        <input type="hidden" name="plugid" value="<?php echo $pid ?>" />

                        <?php

                        $manager->addTicketHidden();

        $aOptions = [];
        $aOIDs    = [];
        $query    = sprintf("SELECT * FROM %s WHERE ocontext='global' and opid=%s ORDER BY oid ASC", sql_table('plugin_option_desc'), $pid);
        $r        = sql_query($query);
        while ($o = sql_fetch_object($r)) {
            $aOIDs[]           = $o->oid;
            $aOptions[$o->oid] = [
                'oid'         => $o->oid,
                'value'       => $o->odef,
                'name'        => $o->oname,
                'description' => $o->odesc,
                'type'        => $o->otype,
                'typeinfo'    => $o->oextra,
                'contextid'   => 0,
            ];
        }
        // fill out actual values
        if (count($aOIDs) > 0) {
            $r = sql_query(sprintf("SELECT oid, ovalue FROM %s WHERE oid in (%s)", sql_table('plugin_option'), implode(',', $aOIDs)));
            while ($o = sql_fetch_object($r)) {
                $aOptions[$o->oid]['value'] = $o->ovalue;
            }
        }

        // call plugins
        $param = [
        'context' => 'global',
        'plugid'  => $pid,
        'options' => &$aOptions,
        ];
        $manager->notify('PrePluginOptionsEdit', $param);

        $template['content'] = 'plugoptionlist';
        $amount              = showlist_by_array($aOptions, 'table', $template);
        if (0 == $amount) {
            echo '<p>', _ERROR_NOPLUGOPTIONS, '</p>';
        }

        ?>
                    </div>
                </form>
        <?php $this->pagefoot();
    }

    /**
     * @todo document this
     */
    public function action_pluginoptionsupdate()
    {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intRequestVar('plugid');
        if ( ! $manager->pidInstalled($pid)) {
            $this->error(_ERROR_NOSUCHPLUGIN);
        }

        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);

        $param = [
            'context' => 'global',
            'plugid'  => $pid,
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);

        $this->action_pluginoptions(_PLUGS_OPTIONS_UPDATED);
    }

    /**
     * @static
     * @todo document this
     */
    public static function _insertPluginOptions($context, $contextid = 0)
    {
        // get all current values for this contextid
        // (note: this might contain doubles for overlapping contextids)
        $aIdToValue = [];
        $res        = sql_query(sprintf("SELECT oid, ovalue FROM %s WHERE ocontextid=%s", sql_table('plugin_option'), (int) $contextid));
        while ($o = sql_fetch_object($res)) {
            $aIdToValue[$o->oid] = $o->ovalue;
        }

        // get list of oids per pid
        $query    = sprintf("SELECT * FROM %s,%s WHERE opid=pid and ocontext=%s ORDER BY porder, oid ASC", sql_table('plugin_option_desc'), sql_table('plugin'), sql_quote_string($context));
        $res      = sql_query($query);
        $aOptions = [];
        while ($o = sql_fetch_object($res)) {
            if (in_array($o->oid, array_keys($aIdToValue))) {
                $value = $aIdToValue[$o->oid];
            } else {
                $value = $o->odef;
            }

            $aOptions[] = [
                'pid'         => $o->pid,
                'pfile'       => $o->pfile,
                'oid'         => $o->oid,
                'value'       => $value,
                'name'        => $o->oname,
                'description' => $o->odesc,
                'type'        => $o->otype,
                'typeinfo'    => $o->oextra,
                'contextid'   => $contextid,
                'extra'       => '',
            ];
        }

        global $manager;
        $param = [
            'context'   => $context,
            'contextid' => $contextid,
            'options'   => &$aOptions,
        ];
        $manager->notify('PrePluginOptionsEdit', $param);

        $iPrevPid = -1;
        foreach ($aOptions as $aOption) {
            // new plugin?
            if ($iPrevPid != $aOption['pid']) {
                $iPrevPid = $aOption['pid'];
                if ( ! defined('_PLUGIN_OPTIONS_TITLE')) {
                    define('_PLUGIN_OPTIONS_TITLE', 'Options for %s');
                }
                echo '<tr><th colspan="2">' . sprintf(_PLUGIN_OPTIONS_TITLE, hsc($aOption['pfile'])) . '</th></tr>';
            }

            $meta = NucleusPlugin::getOptionMeta($aOption['typeinfo']);
            if ('hidden' != @$meta['access']) {
                echo '<tr>';
                listplug_plugOptionRow($aOption);
                echo '</tr>';
            }
        }
    }

    /**
     * Helper functions to create option forms etc.
     *
     * @todo document parameters
     */
    public static function input_yesno($name, $checkedval, $tabindex = 0, $value1 = 1, $value2 = 0, $yesval = _YES, $noval = _NO, $isAdmin = 0)
    {
        $id  = hsc($name);
        $id  = str_replace('[', '-', $id);
        $id  = str_replace(']', '-', $id);
        $id1 = $id . hsc($value1);
        $id2 = $id . hsc($value2);

        if ("admin" == $name) {
            echo '<input onclick="selectCanLogin(true);" type="radio" name="', hsc($name), '" value="', hsc($value1), '" ';
        } else {
            echo '<input type="radio" name="', hsc($name), '" value="', hsc($value1), '" ';
        }

        if ($checkedval == $value1) {
            echo "tabindex='{$tabindex}' checked='checked'";
        }
        echo ' id="' . $id1 . '" /><label for="' . $id1 . '">' . $yesval . '</label>';
        echo ' ';
        if ("admin" == $name) {
            echo '<input onclick="selectCanLogin(false);" type="radio" name="', hsc($name), '" value="', hsc($value2), '" ';
        } else {
            echo '<input type="radio" name="', hsc($name), '" value="', hsc($value2), '" ';
        }
        if ($checkedval != $value1) {
            echo "tabindex='{$tabindex}' checked='checked'";
        }
        if ($isAdmin && "canlogin" == $name) {
            echo ' disabled="disabled"';
        }
        echo ' id="' . $id2 . '" /><label for="' . $id2 . '">' . $noval . '</label>';
    }

    public static function html_build_attributes($attributes = [], $exclude_names = [])
    {
        $items = [];
        $ex    = [];
        if (empty($exclude_names) || ! is_array($exclude_names)) {
            $exclude_names = [];
        } else {
            foreach ($exclude_names as $v) {
                $ex[] = strtolower((string) $v);
            }
        }
        if (empty($attributes)) {
            return '';
        }
        if ( ! is_array($attributes)) {
            trigger_error('Error: Not string', E_USER_ERROR);
            return '';
        }
        foreach ($attributes as $k => $v) {
            $k = trim((string) $k);
            $v = (string) $v;
            if (0 === strlen($k) || in_array(strtolower($k), $ex)) {
                continue;
            }
            $items[] = sprintf("%s='%s'", $k, hsc($v));
        }
        return implode(', ', $items);
    }

    public static function input_type_select($name, $lists, $defalutval, $tabindex = 0, $attributes = [])
    {
        $lines    = [];
        $ex_attrs = ['name','value','selected'];
        if (0 !== (int) $tabindex) {
            $ex_attrs[] = 'tabindex';
        }
        $attr = self::html_build_attributes($attributes, $ex_attrs);
        if (0 !== (int) $tabindex) {
            $attr .= ('' !== $attr ? ', ' : '') . sprintf("tabindex='%d'", (int) $tabindex);
        }
        $lines[]  = sprintf("<select name='%s' %s>", $name, $attr);
        $selected = '';
        foreach ($lists as $v) {
            $value = (string) $v['value'];
            $label = (string) $v['label'];
            $attr  = isset($v['attribute']) ? self::html_build_attributes($attributes, ['name']) : '';
            if (null !== $defalutval
                && '' === $selected
                && $value === (string) $defalutval
            ) {
                $selected = " selected='selected'";
                $attr .= $selected;
            }
            $lines[] = sprintf("<option value='%s' %s>%s</option>", $value, $attr, hsc($label));
        }
        $lines[] = "</select>";
        echo implode("\n", $lines);
    }

    public function checkSecurityRisk()
    {
        global $CONF;

        if ( ! $CONF['alertOnSecurityRisk']) {
            return;
        }

        // check if files exist and generate an error if so
        $RiskFiles = [
            '../install.sql' => _ERRORS_INSTALLSQL,  // don't localized, old version
            '../install.php' => _ERRORS_INSTALLPHP,  // don't localized, old version
        ];
        $RiskDirs = [
            'convert'      => _ERRORS_CONVERTDIR,  // don't localized, old version
            '../install'   => _ERRORS_INSTALLDIR,  // current version
            '../_upgrades' => _ERRORS_UPGRADESDIR,  // current version
        ];
        $aFound = [];
        foreach ($RiskFiles as $fileName => $fileDesc) {
            if (@is_file($fileName)) {
                $aFound[] = $fileDesc;
            }
        }
        foreach ($RiskDirs as $fileName => $fileDesc) {
            if (@is_dir($fileName)) {
                $aFound[] = $fileDesc;
            }
        }
        if ( ! str_contains(str_replace('\\', '/', getcwd()), '/plugins/') && @is_writable('../config.php')) {
            $aFound[] = _ERRORS_CONFIGPHP;
        }

        if (count($aFound) <= 0) {
            return;
        }

        $title = _ERRORS_STARTUPERROR3;
        $msg   = _ERRORS_STARTUPERROR1 . implode('</li><li>', $aFound) . _ERRORS_STARTUPERROR2;
        // check core upgrade
        if ((int) $CONF['DatabaseVersion'] < CORE_APPLICATION_DATABASE_VERSION_ID) {
            $link_title = sprintf(_ADMIN_TEXT_CLICK_HERE_TO_UPGRADE, NUCLEUS_VERSION);
            $msg        = sprintf('<h2>%s</h2>', hsc(_ADMIN_TEXT_UPGRADE_REQUIRED)) .
                sprintf(
                    '<div><a style="color:red" href="%s">%s</a>(Current database %d)',
                    $CONF['IndexURL'] . '_upgrades/',
                    hsc($link_title),
                    $CONF['DatabaseVersion']
                )
                . '</div><br /><hr />' . $msg;
        }
        startUpError($msg, $title);
    }

    /**
     * @todo document this
     */
    public function action_optimizeoverview()
    {
        global $member, $DB_DRIVER_NAME;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();
        echo '<p><a href="index.php?action=manage">(', _BACKTOMANAGE, ')</a></p>';
        echo sprintf("<h2>%s</h2>\n", _ADMIN_DATABASE_OPTIMIZATION_REPAIR);

        if (isset($_POST['mode']) && isset($_POST['step'])) {
            if ('sqlite' == $DB_DRIVER_NAME && 'optimize' == PostVar('mode') && 'start' == PostVar('step')) {
                echo '<p><a href="index.php?action=optimizeoverview">' . _BACKTOOVERVIEW . '</a></p>';
                echo sprintf("%s %s : %s<br />\n", _ADMIN_OLD, _ADMIN_FILESIZE, $this->get_db_sqliteFileSizeText());
                $this->db_optimize_sqlite();
                echo sprintf("%s %s : %s<br />\n", _ADMIN_NEW, _ADMIN_FILESIZE, $this->get_db_sqliteFileSizeText());

                $this->pagefoot();
                return;
            }
        }

        if (in_array($DB_DRIVER_NAME, ['mysql', 'sqlite'])) {
            echo sprintf("<h3>%s</h3>\n", _ADMIN_TITLE_OPTIMIZE);

            if ('sqlite' == $DB_DRIVER_NAME) {
                echo _ADMIN_FILESIZE . " : " . $this->get_db_sqliteFileSizeText();
                $btn_title = _ADMIN_TITLE_OPTIMIZE;
                $s         = <<<EOD
        <form method="post" action="index.php"><p>
        <input type="hidden" name="action" value="optimizeoverview" />
        <input type="hidden" name="mode"   value="optimize" />
        <input type="hidden" name="step"   value="start" />
        <input type="submit" value="{$btn_title}" tabindex="20" />
        </p></form>
EOD;
                echo $s;
            } else {
                if ( ! $this->db_mysql_checktables(true)) {
                    echo sprintf("<p>%s</p>\n", hsc(_PROBLEMS_FOUND_ON_TABLE));
                } else {
                    $tables          = [];
                    $confirmOptimize = false;
                    $has_big         = false;
                    $warn_size       = 10 * \pow(10, 6); // 10 Mega Byte
                    $res             = sql_query(sprintf("SHOW TABLE STATUS LIKE '%s%%'", sql_table('')));
                    while ($res && ($row = sql_fetch_assoc($res)) && ! empty($row)) {
                        $tables[$row['Name']] = $row;
                        if ('InnoDB' != $row['Engine']) {
                            if ((int) $row['Data_free'] > 0) {
                                $confirmOptimize = true;
                            }
                            if ((int) $row['Data_free'] > $warn_size) { // 10*pow(10,6)
                                $has_big = true;
                            }
                        }
                    }
                    if ($confirmOptimize) {
                        if (isset($_POST['mode']) && isset($_POST['step'])
                            && 'optimize' == PostVar('mode') && 'start' == PostVar('step')
                        ) {
                            echo '<p><a href="index.php?action=optimizeoverview">' . _BACKTOOVERVIEW . '</a></p>';
                            if ($this->db_optimize_mysql()) {
                                echo sprintf("<p>%s</p>\n", hsc(_ADMIN_EXEC_TITLE_OPTIMIZE));
                            }
                            $this->pagefoot();
                            return;
                        }
                        if ($has_big) {
                            echo sprintf("<p style='color: #ff0000'>%s</p>\n", hsc(_ADMIN_PLEASE_OPTIMIZE));
                        }
                        echo sprintf("<p>%s</p>\n", hsc(_ADMIN_CONFIRM_TITLE_OPTIMIZE));
                        $btn_title = hsc(_ADMIN_BTN_TITLE_OPTIMIZE);
                        $s         = <<<EOD
        <form method="post" action="index.php"><p>
        <input type="hidden" name="action" value="optimizeoverview" />
        <input type="hidden" name="mode"   value="optimize" />
        <input type="hidden" name="step"   value="start" />
        <input type="submit" value="{$btn_title}" tabindex="20" />
        </p></form>
EOD;
                        echo $s;
                    }
                    echo "<table>";
                    echo sprintf(
                        "<tr><th>%s</th><th>%s</th><th>%s</th><th>Engine</th></tr>",
                        hsc(_ADMIN_TABLENAME),
                        hsc(_SIZE),
                        hsc(_OVERHEAD)
                    );
                    foreach ($tables as $key => $item) {
                        echo sprintf(
                            "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                            hsc($key),
                            hsc($item['Data_length']),
                            hsc($item['Data_free']),
                            hsc($item['Engine'])
                        );
                    }
                    echo "</table>";
                }
            }
        }

        if (in_array($DB_DRIVER_NAME, ['mysql'])) {
            echo sprintf("<h3>%s</h3>\n", _ADMIN_TITLE_REPAIR);
            $this->db_mysql_checktables();
        }

        $this->pagefoot();
    }

    private function db_mysql_checktables($checkonly = false)
    {
        global $DB_DRIVER_NAME;
        if ('mysql' != $DB_DRIVER_NAME) {
            return [];
        }
        $tables = [];
        $res    = sql_query(sprintf("SHOW TABLES LIKE '%s%%'", sql_table('')));
        while ($res && ($row = sql_fetch_array($res)) && ! empty($row)) {
            $tables[] = $row[0];
        }

        $items = [];
        if (count($tables)) {
            $sql = "CHECK TABLE `" . implode("`, `", $tables) . "`";
            $res = sql_query($sql);
            while ($res && ($row = sql_fetch_assoc($res)) && ! empty($row)) {
                if ('status' != $row['Msg_type']) {
                    continue;
                }
                if ('OK' != $row['Msg_text'] && 'Table is already up to date' != $row['Msg_text']) {
                    $items[$row['Table']] = $row;
                }
            }
        }

        if ($checkonly) {
            return 0 == count($items);
        }

        if (count($items) > 0) {
            if (isset($_POST['mode']) && isset($_POST['step'])
                && 'repaire' == PostVar('mode') && 'start' == PostVar('step')
            ) {
                echo "<p>" . hsc(_ADMIN_EXEC_TITLE_AUTO_REPAIR) . "</p>";
                echo '<p><a href="index.php?action=optimizeoverview">' . _BACKTOOVERVIEW . '</a></p>';
                // REPAIR   TABLE tablename1[, tablename2, ..]
                // result : Table  Op  Msg_type   Msg_text :  tablename   repair    status   OK
                $sql   = "REPAIR TABLE `" . implode("`, `", array_keys($items)) . "`";
                $res   = sql_query($sql);
                $items = [];
                while ($res && ($row = sql_fetch_assoc($res)) && ! empty($row)) {
                    $items[$row['Table']] = $row;
                }
            } else {
                echo "<p>" . hsc(_PROBLEMS_FOUND_ON_TABLE) . "</p>";
                echo "<p>" . hsc(_ADMIN_CONFIRM_TITLE_AUTO_REPAIR) . "</p>";
                $btn_title = hsc(_ADMIN_BTN_TITLE_AUTO_REPAIR);
                $s         = <<<EOD
        <form method="post" action="index.php"><p>
        <input type="hidden" name="action" value="optimizeoverview" />
        <input type="hidden" name="mode"   value="repaire" />
        <input type="hidden" name="step"   value="start" />
        <input type="submit" value="{$btn_title}" tabindex="20" />
        </p></form>
EOD;
                echo $s;
            }
            echo "<table>";
            echo sprintf("<tr><th>%s</th><th>%s</th></tr>", hsc(_ADMIN_TABLENAME), hsc(_MESSAGE));
            foreach ($items as $key => $item) {
                echo sprintf("<tr><td>%s</td><td>%s</td></tr>", hsc($key), hsc($item['Msg_text']));
            }
            echo "</table>";
        } else {
            echo hsc(_NO_PROBLEMS_FOUND);
        }
    }

    private function db_optimize_mysql()
    {
        global $DB_DRIVER_NAME;
        if ('mysql' != $DB_DRIVER_NAME) {
            return false;
        }

        $success = false;

        $tables    = [];
        $inotables = [];
        $res       = sql_query(sprintf("SHOW TABLE STATUS LIKE '%s%%'", sql_table('')));
        while ($res && ($row = sql_fetch_assoc($res)) && ! empty($row)) {
            if ((int) $row['Data_free'] > 0) {
                if ('InnoDB' == $row['Engine']) {
                    $inotables[] = $row['Name'];
                } else {
                    $tables[] = $row['Name'];
                }
            }
        }

        if (count($tables) > 0) {
            // OPTIMIZE TABLE tablename1[, tablename2, ..]
            // result : Table  Op  Msg_type   Msg_text :  tablename   optimize   status   OK
            $sql = "OPTIMIZE TABLE `" . implode("`, `", $tables) . "`";
            $res = sql_query($sql);
            echo "<table>";
            echo sprintf("<tr><th>%s</th><th>Msg_type</th><th>%s</th></tr>", hsc(_ADMIN_TABLENAME), hsc(_MESSAGE));
            while ($res && ($row = sql_fetch_assoc($res))) { // Table , Op , Msg_type , Msg_text
                echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", hsc($row['Table']), hsc($row['Msg_type']), hsc($row['Msg_text']));
            }
            echo "</table>";
            if ($res) {
                sql_free_result($res);
            }
            $success = true;
            //            echo sprintf('<div>%s</div>', hsc($sql));
        }
        if (count($inotables) > 0) {
            // InnoDB issue
            // Can not optimize manually;
            // Table does not support optimize, doing recreate + analyze instead
            //  x : ALTER TABLE tablename ENGINE='InnoDB';
            //            foreach($inotables as $tablename)
            //                sql_query(sprintf("ALTER TABLE %s ENGINE='InnoDB'", $tablename));
            echo sprintf('<p>InnoDB can not optimize manually</p>');
            echo '<ul>';
            foreach ($inotables as $tablename) {
                echo sprintf('<li>%s</li>', hsc($tablename));
            }
            echo '</ul>';
        }
        return $success;
    }

    private function db_optimize_sqlite()
    {
        global $DB_DRIVER_NAME;
        if ('sqlite' !== $DB_DRIVER_NAME) {
            return false;
        }
        sql_query('vacuum;');
    }

    private function get_db_sqliteFileSizeText()
    {
        global $DB_DRIVER_NAME, $DB_DATABASE;
        if ('sqlite' !== $DB_DRIVER_NAME) {
            return false;
        }
        clearstatcache();
        $size     = filesize($DB_DATABASE);
        $t        = ['', 'K', 'M', 'G', 'T'];
        $n        = min(4, ($size > 0 ? floor(log($size, 10) / 3) : 0));
        $sizetext = sprintf('%d %s', $size / \pow(10, $n * 3), $t[$n]);
        return sprintf("%s(%d) byte", $sizetext, $size);
    }

    public static function getQueryFilterForItemlist01($bid, $mode = 'all')
    {
        // $bid = 0 : all blog
        $v     = (string) $mode;
        $where = '';
        $t     = time(); // Nucleus does not save UTC time zone,  use blog settings time zone
        switch ($v) {
            //case 'all':
            //case 'draft':
            //    break;
            //default:
            case 'normal_term_end':
                if ($bid) {
                    if (is_object($bid)) {
                        $t = $bid->getCorrectTime();
                    } else {
                        global $manager;
                        $o = $manager->getBlog($bid);
                        if ($o) {
                            $t = $o->getCorrectTime();
                        }
                    }
                } else {
                    global $member, $manager;
                    $sql = sprintf('SELECT tblog as result FROM `%s` WHERE tmember=%d LIMIT 1', sql_table('team'), $member->getID());
                    $res = (int) (quickQuery($sql));
                    if ( ! $res) {
                        $sql = sprintf('SELECT bnumber as result FROM `%s` LIMIT 1', sql_table('blog'));
                    }
                    if ($res > 0) {
                        $o = $manager->getBlog($res);
                        if ($o) {
                            $t = $o->getCorrectTime();
                        }
                    }
                }

                break;
        }

        $common_public_filter              = "ipublic=1";
        $common_normal_filter              = "idraft=0 AND " . $common_public_filter;
        $common_normal_duringperiod_filter = $common_normal_filter
                        . sprintf(" AND itime <= %s", sqldate($t))
                        . ' AND ( ipublic_enable_term_start=0 OR'
                        . sprintf(' ( ipublic_enable_term_start=1 AND ipublic_term_start <= %s)', sqldate($t))
                        . '     )'
                        . ' AND ( ipublic_enable_term_end=0 OR'
                        . sprintf(' ( ipublic_enable_term_end=1 AND ipublic_term_end > %s)', sqldate($t))
                        . '     )';
        $common_nondraft_filter = "idraft=0";
        $common_draft_filter    = "idraft=1";
        $common_term_filter     = ['start' => [], 'end' => []];
        foreach (['start','end'] as $key) {
            // past  future
            // $common_term_filter['start'][0]
            $common_term_filter[$key][0]           = "ipublic_enable_term_{$key}=0 ";
            $common_term_filter[$key][1]           = [];
            $common_term_filter[$key][1]['future'] = "ipublic_enable_term_{$key}=1 "
                                                  . " AND ipublic_term_{$key} > " . sqldate($t);
            $common_term_filter[$key][1]['past'] = "ipublic_enable_term_{$key}=1 "
                                                  . " AND ipublic_term_{$key} <= " . sqldate($t);
        }
        $common_term_filter['future'] = sprintf(
            '((%s) OR (%s))',
            'itime > ' . sqldate($t),
            $common_term_filter['start'][1]['future']
        );
        $common_term_filter['past'] = sprintf(
            '((%s) AND (%s OR (%s)))',
            'itime <= ' . sqldate($t),
            $common_term_filter['start'][0],
            $common_term_filter['start'][1]['past']
        );
        $common_term_filter['expired'] = "ipublic_enable_term_end=1 "
                                        . " AND ipublic_term_end <= " . sqldate($t);
        $common_term_filter['invalid'] = '(ipublic_enable_term_start=1 '
                                        . ' AND ipublic_enable_term_end=1 '
                                        . ' AND ipublic_term_start>ipublic_term_end)';
        $common_normal_filter .= sprintf(" AND NOT (%s)", $common_term_filter['invalid']);
        if ( ! ITEM::existCol_ipublic()) {
            $common_normal_filter = "idraft=0";
            $common_draft_filter  = "idraft=1";
        }
        switch ($v) {
            case 'all':
                break;
            case 'public':
                $where .= 'ipublic=1';

                break;
            case 'non_public':
                $where .= 'ipublic=0';

                break;
            case 'non_draft':
                $where .= $common_nondraft_filter;

                break;
            case 'draft':
                $where .= $common_draft_filter;

                break;
            case 'normal': //  一般公開中(公開+下書きでない)
                $where .= sprintf(
                    "%s AND NOT(%s) AND NOT (%s)",
                    $common_normal_filter,
                    $common_term_filter['expired'],
                    $common_term_filter['future']
                );

                break;
            case 'draft_public':
                $where .= $common_draft_filter . ' AND ipublic=1';

                break;
            case 'draft_non_public':
                $where .= $common_draft_filter . ' AND ipublic=0';

                break;
            case 'normal_term': // 一般公開中(終了期限付き)
                $where .= sprintf(
                    "%s AND NOT(%s) AND NOT (%s)",
                    $common_normal_filter,
                    $common_term_filter['expired'],
                    $common_term_filter['future']
                );
                $where .= " AND ipublic_enable_term_end=1 ";

                break;
            case 'normal_term_future': // checked : 一般公開-開始前
                $where .= $common_normal_filter
                        . ' AND ' . $common_term_filter['future'];

                break;
            case 'normal_term_expired':  // 一般公開-期限切れ(公開+下書きでない+期限付き)
                $where .= $common_normal_filter
                        . ' AND ' . $common_term_filter['expired'];

                break;
            case 'non_draft_term_expired':   // 期限切れ(下書きでない+期限付き)
                $where .= $common_nondraft_filter
                        . ' AND ' . $common_term_filter['expired'];

                break;
            case 'non_public_publishable':  // 非公開-公開可能(下書きでない)')
                $where .= sprintf(
                    "(NOT(%s) AND %s AND NOT (%s))",
                    $common_public_filter,
                    $common_nondraft_filter,
                    $common_term_filter['expired']
                );

                break;
            case 'non_public_term_before': // '非公開-期限付き-開始前(下書きでない)'
                $where .= sprintf(
                    "(NOT(%s) AND %s AND NOT (%s) AND %s)",
                    $common_public_filter,
                    $common_nondraft_filter,
                    $common_term_filter['expired'],
                    $common_term_filter['future']
                );

                break;
            case 'non_public_term_during': // '非公開-期限付き-期間中(下書きでない)'
                $where .= sprintf(
                    "(NOT(%s) AND %s AND NOT (%s) AND NOT(%s))",
                    $common_public_filter,
                    $common_nondraft_filter,
                    $common_term_filter['expired'],
                    $common_term_filter['future']
                );

                break;
            case 'non_public_expired':     // '非公開-期限切れ(下書きでない)'
                $where .= sprintf(
                    "(NOT(%s) AND %s AND %s)",
                    $common_public_filter,
                    $common_nondraft_filter,
                    $common_term_filter['expired']
                );

                break;
            case 'term_invalid':
                $where .= $common_nondraft_filter
                        . ' AND ipublic_enable_term_start=1 '
                        . ' AND ipublic_enable_term_end=1 '
                        . ' AND ipublic_term_start>ipublic_term_end ';

                break;
            default: // invalid $mode
                $where .= '1=0'; //
                break;
        }

        if (empty($where)) {
            return '';
        }
        return sprintf(' AND( %s ) ', $where);
    }

    public static function get_remote_plugin_list()
    {
        static $cached = null;
        if ( ! function_exists('json_decode')) { // PHP 5 >= 5.2.0
            return false;
        }

        $expired_time = time() - 60 * 60 * 6; // cache expired time 6 hour

        if (false === $cached) {
            return false;
        }

        $col_type     = 'plugin_remote_list';
        $col_sub_type = 'json';
        $col_name     = 'github';

        if (null === $cached) {
            if ( ! CoreCachedData::existTable()) {
                $cached = false;
                return false;
            }
            $cached = CoreCachedData::getDataEx($col_type, $col_sub_type, 0, $col_name, $expired_time);
        }

        $http_options = ['connecttimeout' => 5, 'timeout' => 5];
        if (empty($cached) || ! isset($cached['expired']) || $cached['expired']) {
            $http_raw_options = array_merge($http_options, ['reply_response' => 1]);
            if ( ! is_array($cached)) {
                $cached = ['value' => ''];
            }
            $url = "https://api.github.com/users/NucleusCMS/repos?per_page=100";
            ini_set('user_agent', DEFAULT_USER_AGENT);
            $count   = 0;
            $data    = [];
            $nexturl = $url;
            while ($count < 100 && ($s = Utils::httpGet($nexturl, $http_raw_options))) {
                $count++;
                if ( ! is_array($s)) {
                    $s = ['body' => $s];
                }
                if (isset($s['header'])) {
                    if (false === stripos($s['header'], "\nContent-Type: application/json")) {
                        break;
                    }
                    // !preg_match('#HTTP.+? 200#i', $s['header'])
                }
                if ( ! empty($s['body']) && ('[' == substr(ltrim($s['body']), 0, 1))) {
                    $lists = json_decode($s['body'], true);
                    if ( ! empty($lists) && is_array($lists)) {
                        $data = array_merge($data, $lists);
                    }
                    // save cache folder
                    if (isDebugMode()) {
                        global $DIR_NUCLEUS;
                        $tmp = $DIR_NUCLEUS . 'cache/' . sprintf('tmp-github-plugin-page-%d', $count);
                        if (@is_dir(dirname($tmp))) {
                            @file_put_contents($tmp, $s['body']);
                        }
                    }
                }
                if ( ! isset($s['header']) || empty($s['header'])) {
                    break;
                }
                //                var_dump($s['header']);
                //  次のページの URL の後には rel="next" が続きます。
                // Link: <https://api.github.com/user/[0-9]+/repos?page=2>; rel="next"
                $pattern = '#repos\?.*?page=([0-9]+)>; rel="next"#i';
                $m       = [];
                if ( ! preg_match($pattern, $s['header'], $m)) {
                    break;
                }
                $nextpage = (int) $m[1];
                if (($count + 1) != $nextpage) {
                    break;
                }
                $nexturl = $url . '&page=' . $nextpage;
            }
            if ( ! empty($data)) {
                foreach ($data as $k => $v) {
                    if ( ! isset($v['name']) || ! preg_match('#^NP_#', $v['name'])) {
                        unset($data[$k]);
                    }
                }
            }
            if (empty($data)) {
                $cached = false;
                return false;
            }
            usort($data, fn ($a, $b) => strcasecmp($a['name'], $b['name']));

            $cached['list'] = [];
            foreach ($data as $value) {
                $name                  = strtolower($value['name']);
                $cached['list'][$name] = $value;
            }
            $cached['value'] = json_encode($data);
            CoreCachedData::setDataEx($col_type, $col_sub_type, 0, $col_name, $cached['value']);
        }

        if ( ! empty($cached['value']) && ! isset($cached['list'])) {
            $cached['list'] = [];
            $data           = json_decode($cached['value'], true);
            foreach ($data as $value) {
                $name                  = strtolower($value['name']);
                $cached['list'][$name] = $value;
            }
        }

        if ( ! empty($cached['list'])) {
            return $cached['list'];
        }
        return false;
    }

    public static function getRemotePluginVersion($NP_Name, $trim = false)
    {
        static $cached = [];

        if (false === $cached || ! function_exists('json_decode')) {
            return false;
        }

        $lc_name = strtolower($NP_Name);
        if (isset($cached[$lc_name])) {
            return $cached[$lc_name];
        }
        $expired_time = time() - 60 * 60 * 6; // cache expired time 6 hour

        $lists = self::get_remote_plugin_list();

        if (empty($lists)) {
            $cached = false;
            return false;
        }
        if ( ! isset($lists[$lc_name]) || (isset($cached[$lc_name]) && false === $cached[$lc_name])) {
            $cached[$lc_name] = false;
            return false;
        }

        $current_data = &$lists[$lc_name];
        $branch       = $current_data['default_branch'] ?? 'master';
        $rooturl      = "https://raw.githubusercontent.com/NucleusCMS/{$NP_Name}/{$branch}/";
        $url          = $rooturl . "{$NP_Name}.php";

        $retry_url     = false;
        $extra_pattern = false;

        switch ($lc_name) { // Workaround for unusual repositories
            case 'np_extraskinjp':
                $retry_url = $url;
                $url       = $rooturl . "plugins/{$NP_Name}.php";
                break;
        }

        $s = Utils::httpGet($url, ['connecttimeout' => 2, 'timeout' => 2]);
        if (empty($s) && ! empty($retry_url)) {
            $s = Utils::httpGet($retry_url, ['connecttimeout' => 2, 'timeout' => 2]);
        }
        if (empty($s)) {
            $s = file_get_contents($url);
        }

        $pattern0 = '\s*\([^"\']+?return\s+["\']([^"\']+?)["\']';
        $pattern1 = "/getVersion{$pattern0}/im";
        $pattern2 = "/getMinNucleusVersion{$pattern0}/im";

        if (preg_match('@^//\s+min-php-version\s*:\s*([0-9\.]+)@ms', $s, $m) && version_compare(PHP_VERSION, $m[1], '<')) {
            return false;
        }

        if (preg_match($pattern1, $s, $m) || ( ! empty($extra_pattern) && preg_match($extra_pattern, $s, $m))) {
            // Check plugin's min nucleus version
            /** @var TYPE_NAME $m2 */
            $m2 = [];
            if (preg_match($pattern2, $s, $m2) && ((int) $m2[1] > CORE_APPLICATION_VERSION_ID)) {
                return false;
            }
            if ($trim) {
                return preg_replace('#[^0-9\.\-\_]+.+?$#', '', $m[1]);
            }
            return $m[1];
        }
        return false;
    }

    public static function createActionLink($action_name, $params = '')
    {
        if (is_array($params)) {
            $p = (count($params) > 0 ? http_build_query($params) : '');
        } else {
            $p = (string) $params;
        }
        $p = ((strlen($p) > 0) ? "&" . $p : '');
        return sprintf('index.php?action=%s', $action_name) . $p;
    }

    public static function createActionLinkTag($action_name, $title, $params = '')
    {
        return sprintf('<a href="%s">%s</a>', self::createActionLink($action_name, $params), escapeHTML($title));
    }

    public function action_lost_pwd()
    {
        global $member;

        if ($member->isLoggedIn()) {
            if (headers_sent()) {
                $this->pagehead();
                echo _GFUNCTIONS_HEADERSALREADYSENT_TITLE;
                $this->pagefoot();
                exit;
            }
            redirect('index.php');
        }

        // show form

        $this->pagehead();

        echo \parseBlade('admin.action_lost_pwd', []), "\n";

        $this->pagefoot();

        exit;
    }

    public function checkToken()
    {
        global $member;
        if ( ! defined('_ERROR_INVALID_TOKEN')) {
            define('_ERROR_INVALID_TOKEN', 'ERROR: INVALID TOKEN');
        }
        if ( ! $member->matchToken()) {
            $this->error('_ERROR_INVALID_TOKEN');
        }
        return true;
    }

    private function action_memberpasswordchangeconfirm()
    {
        global $member, $manager;
        $memberid = intRequestVar('memberid');
        if (empty($member) || ! $member->isLoggedIn() || $member->isHalt()) {
            $this->disallow();
        }

        // check request user is same.
        if (($member->getID() !== $memberid) || ( ! $this->checkToken())) {
            $this->disallow();
        }

        $old_password       = (string) (postVar('currentpassword'));
        $new_password       = (string) (postVar('password'));
        $new_repeatpassword = (string) (postVar('repeatpassword'));

        // check current password
        if ( ! $member->checkPassword($old_password)) {
            $this->error(_ERROR_NOT_MATCH_CURRENT_PASSWORD . " {$old_password}");
        }

        // check new password
        if ($new_password !== $new_repeatpassword) {
            $this->error(_ERROR_PASSWORDMISMATCH);
        }

        if (empty($new_password) || strlen(trim($new_password)) < 6) {
            $this->error(_ERROR_PASSWORDTOOSHORT);
        }

        if (preg_match('/[ \s\t\n\r]/', $new_password)) {
            $this->error('ERROR: found space charactor.');
        }

        if ($new_password === $old_password) {
            $this->error(_ERROR_NO_CHANGED_PASSWORD);
        }

        // check Characters
        // 0x21-0x7e : 0-9 a-z A-Z ! " # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \ ] ^ _ ` { | } ~
        if ( ! preg_match('/^[\x21-\x7e]{6,}$/i', $new_password)) {
            $this->error(_MEMBERS_INVALID_PASSWORD_CHARACTERS);
        }

        $pwdvalid    = true;
        $pwderror    = '';
        $notify_data = [
                            'password'     => $new_password,
                            'errormessage' => &$pwderror,
                            'valid'        => &$pwdvalid,
                        ];
        $manager->notify('PrePasswordSet', $notify_data);
        if ( ! $pwdvalid) {
            $this->error($pwderror);
        }

        $member->setPassword($new_password);
        $sql = sprintf(
            "UPDATE `%s` SET mpassword=? WHERE mnumber=%d",
            sql_table('member'),
            $member->getID()
        );
        $res   = sql_prepare_execute($sql, [$member->getPassword()]);
        $error = "";
        if ( ! $res) {
            $error = "FAILED: UPDATE DB";
        }

        if ($error) {
            $this->error($error);
        }

        $this->action_overview(_MEMBERS_CHANGED_PASSWORD);
    }

    private function action_memberpasswordchange()
    {
        global $member, $manager;
        if (empty($member) || ! $member->isLoggedIn() || $member->isHalt()) {
            $this->disallow();
        }

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        $params = [
            'manager' => $manager,
            'member'  => $member,
        ];
        $params['pattern_password'] = $this->getInputPattern('password');

        // show message to go back to member overview (only for admins)
        if ($member->isAdmin()) {
            $params['back_text'] = _MEMBERS_BACKTOOVERVIEW;
            $params['back_uri']  = 'index.php?action=usermanagement';
        } else {
            $params['back_text'] = _BACK_USER_HOME;
            $params['back_uri']  = 'index.php?action=overview';
        }

        echo \parseBlade('admin.action_memberpasswordchange', $params), "\n";

        $this->pagefoot();
    }

    public function show_skinedittype_extralink($type, $spartstype, $skinobj, &$contentsData = null)
    {
        // todo: write code and wait for debugging
    }

    public static function getSQLFilterSearchWord($search_word)
    {
        // todo: write code and wait for debugging
    }

    public static function getSQLFilterSearchWordSingleCol($colname, $search_word)
    {
        // todo: write code and wait for debugging
    }

    public static function doTidy(&$data)
    {
        if ( ! extension_loaded('tidy') || _CHARSET !== 'UTF-8') {
            return;
        }

        $tidy_config            = tidy_get_default_config(false);
        $tidy_config['doctype'] = 'auto';

        //$tidy_config['indent-spaces']    = 4; // indent is space
        //$tidy_config['indent-with-tabs'] = 4; // indent is tab

        $tidy = new tidy();
        $tidy->parseString($data, $tidy_config, 'utf8');
        $tidy->cleanRepair();
        $data = (string) $tidy;
    }

    public function tidy_shutdown_end_obhandler($level)
    {
        $current_level = ob_get_level();
        if (0 === $current_level) {
            return;
        }
        $data = [];
        try {
            while ($level <= $current_level && 0 < $current_level) {
                $status = ob_get_status();
                if ('ob_gzhandler' === $status['name']) {
                    break;
                }
                $s = ob_get_clean();
                if (false !== $s && strlen($s) > 0) {
                    array_unshift($data, $s);
                }
                $current_level = ob_get_level();
            }
        } finally {
            if ( ! empty($data)) {
                $data = implode('', $data);
                try {
                    ADMIN::doTidy($data);
                } finally {
                    echo $data;
                }
            }
        }
    }

    public function getInputPattern($name)
    {
        $pattern = '';
        switch((string) $name) {
            case 'member.name': // echo $this->getInputPattern('member.name')
                // 英字 a～z、 A～Z 数字 0-9  空白（半角）を組み合わせた1～32文字です。ただし、名前の最初や最後に空白を付けることはできません。
                $pattern = '^([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9 ]{0,30}[a-zA-Z0-9])$';
                break;
            case 'blog.name':  // echo $this->getInputPattern('blog.name')
                // 英小文字 a～z 数字 0～9 を組み合わせた1～15文字です。空白は使用できません。
                $pattern = '^[a-z0-9]{1,15}$';
                break;
            case 'skin.name':      // echo $this->getInputPattern('skin.name')
            case 'template.name':  // echo $this->getInputPattern('template.name')
                // 英小文字 a～z 数字 0～9 記号 / を組み合わせた1～20文字です。空白は使用できません。
                // 記号 / は、最初と最後に使ってはいけません。　また連続した // も使えません。
                $pattern = '^([a-z0-9]|[a-z0-9][a-z0-9/]{0,18}[a-z0-9])$';
                break;
            case 'password':  // echo $this->getInputPattern('password')
                // パスワードは、半角英数記号を組み合わせた6～40文字で、大文字小文字は区別されます。
                // 英数字 a～z A～Z 0～9
                // 記号 ! &quot; # $ % &amp; &#039; ( ) * + , - . / : ; &lt; = &gt; ? @ [ \ ] ^ _ ` { | } ~
                $pattern = '^[\x21-\x7e]{0,40}$';
                break;
            case 'password_new':  // echo $this->getInputPattern('password_new')
                // パスワードは、半角英数記号を組み合わせた6～40文字で、大文字小文字は区別されます。
                // 英数字 a～z A～Z 0～9
                // 記号 ! &quot; # $ % &amp; &#039; ( ) * + , - . / : ; &lt; = &gt; ? @ [ \ ] ^ _ ` { | } ~
                $pattern = '^[\x21-\x7e]{6,40}$';
                break;
            case 'skin.partspecial': // isValidSkinPartsName($name)
                $pattern = 'a-z0-9_\-';
                //$pattern .= '\u3041-\u3093\u30A1-\u30F6\u30FC\u4E00-\u9FA0'; // 'ぁ-んァ-ヶー一-龠'
                $pattern = "^[{$pattern}]{1,20}$";
                break;
            case 'skin.partspecialpage': // isValidSkinSpecialPageName($name)
                $pattern = '^[^\?\/#]{1,20}$';
                break;
        }
        return $pattern;
    }

    public static function getVersionCheckWebPageURL(): string
    {
        if (CORE_APPLICATION_NAME !== 'Nucleus CMS') {
            return '';
        }
        $versioncheck_url = 'http://nucleuscms.org/version.php?v=%d&amp;pl=%d';
        return sprintf($versioncheck_url, getNucleusVersion(), getNucleusPatchLevel());
        //return sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
    }

    public static function getAppNameFullVersionText(): string
    {
        $version_text = sprintf('%s %s', CORE_APPLICATION_NAME, CORE_APPLICATION_VERSION);
        if (NUCLEUS_RELEASE_IDENTIFIER !== '') {
            $version_text .= ' ' . NUCLEUS_RELEASE_IDENTIFIER;
        }
        return strip_tags($version_text);
    }

    public static function getAboutHtmlTag(): string
    {
        $checkURL = self::getVersionCheckWebPageURL();
        if (empty($checkURL)) {
            return hsc(self::getAppNameFullVersionText());
        } else {
            return sprintf(
                '<a href="%s" title="%s" target="_blank" rel="noreferrer">%s</a>',
                $checkURL,
                hsc(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE),
                hsc(self::getAppNameFullVersionText())
            );
        }
    }

    public static function getTabIndex(?int $idx = null)
    {
        static $index = 0;
        if (null !== $idx) {
            $index = $idx;
        }
        return $index++;
    }

    public static function getAdminRootURI(): string
    {
        $url = CONF::asStrWithPathSlash('AdminURL', '/nucleus/');
        return parse_url($url, PHP_URL_PATH);
    }
} // class ADMIN
