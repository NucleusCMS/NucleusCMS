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
 * The code for the Nucleus admin area
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$

 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/showlist.php';

/**
 * Builds the admin area and executes admin actions
 */
class ADMIN {

    /**
     * @var string $action action currently being executed ($action=xxxx -> action_xxxx method)
     */
    var $action;

    /**
     * Class constructor
     */
    function ADMIN() {

    }

    /**
     * Executes an action
     *
     * @param string $action action to be performed
     */
    function action($action) {
        global $CONF, $manager;

        // list of action aliases
        $alias = array(
            'login' => 'overview',
            '' => 'overview'
        );

        if (isset($alias[$action]))
            $action = $alias[$action];

        $methodName = 'action_' . $action;

        $this->action = strtolower($action);

        // check ticket. All actions need a ticket, unless they are considered to be safe (a safe action
        // is an action that requires user interaction before something is actually done)
        // all safe actions are in this array:
        $aActionsNotToCheck = array(
            'showlogin',
            'login',
            'overview',
            'itemlist',
            'blogcommentlist',
            'bookmarklet',
            'blogsettings',
            'banlist',
            'deleteblog',
            'editmembersettings',
            'browseownitems',
            'browseowncomments',
            'createitem',
            'itemedit',
            'itemmove',
            'categoryedit',
            'categorydelete',
            'manage',
            'actionlog',
            'settingsedit',
            'backupoverview',
            'pluginlist',
            'createnewlog',
            'usermanagement',
            'skinoverview',
            'templateoverview',
            'skinieoverview',
            'itemcommentlist',
            'commentedit',
            'commentdelete',
            'banlistnewfromitem',
            'banlistdelete',
            'itemdelete',
            'manageteam',
            'teamdelete',
            'banlistnew',
            'memberedit',
            'memberdelete',
            'pluginhelp',
            'pluginoptions',
            'plugindelete',
            'skinedittype',
            'skinremovetype',
            'skindelete',
            'skinedit',
            'templateedit',
            'templatedelete',
            'activate',
            'systemoverview'
        );
/*
        // the rest of the actions needs to be checked
        $aActionsToCheck = array('additem', 'itemupdate', 'itemmoveto', 'categoryupdate', 'categorydeleteconfirm', 'itemdeleteconfirm', 'commentdeleteconfirm', 'teamdeleteconfirm', 'memberdeleteconfirm', 'templatedeleteconfirm', 'skindeleteconfirm', 'banlistdeleteconfirm', 'plugindeleteconfirm', 'batchitem', 'batchcomment', 'batchmember', 'batchcategory', 'batchteam', 'regfile', 'commentupdate', 'banlistadd', 'changemembersettings', 'clearactionlog', 'settingsupdate', 'blogsettingsupdate', 'categorynew', 'teamchangeadmin', 'teamaddmember', 'memberadd', 'addnewlog', 'addnewlog2', 'backupcreate', 'backuprestore', 'pluginup', 'plugindown', 'pluginupdate', 'pluginadd', 'pluginoptionsupdate', 'skinupdate', 'skinclone', 'skineditgeneral', 'templateclone', 'templatenew', 'templateupdate', 'skinieimport', 'skinieexport', 'skiniedoimport', 'skinnew', 'deleteblogconfirm', 'activatesetpwd');
*/
        if (!in_array($this->action, $aActionsNotToCheck))
        {
            if (!$manager->checkTicket())
                $this->error(_ERROR_BADTICKET);
        }

        if (method_exists($this, $methodName))
            call_user_func(array($this, $methodName));
        else
            $this->error(_BADACTION . hsc(" ($action)"));

    }

    /**
     * @todo document this
     */
    function action_showlogin() {
        global $error;
        $this->action_login($error);
    }

    /**
     * @todo document this
     */
    function action_login($msg = '', $passvars = 1) {
        global $member;

        // skip to overview when allowed
        if ($member->isLoggedIn() && $member->canLogin()) {
            $this->action_overview();
            exit;
        }

        $this->pagehead();

        echo '<h2>', _LOGIN ,'</h2>';
        if ($msg) echo _MESSAGE , ': ', hsc($msg);
        ?>

        <form action="index.php" method="post"><p>
        <?php echo _LOGIN_NAME; ?> <br /><input name="login"  tabindex="10" />
        <br />
        <?php echo _LOGIN_PASSWORD; ?> <br /><input name="password"  tabindex="20" type="password" />
        <br />
        <input name="action" value="login" type="hidden" />
        <br />
        <input type="submit" value="<?php echo _LOGIN?>" tabindex="30" />
        <br />
        <small>
            <input type="checkbox" value="1" name="shared" tabindex="40" id="shared" /><label for="shared"><?php echo _LOGIN_SHARED?></label>
            <br /><a href="forgotpassword.html"><?php echo _LOGIN_FORGOT?></a>
        </small>
        <?php           // pass through vars

            $oldaction = postVar('oldaction');
            if (  ($oldaction != 'logout')  && ($oldaction != 'login')  && $passvars ) {
                passRequestVars();
            }


        ?>
        </p></form>
        <?php       $this->pagefoot();
    }


    /**
     * provides a screen with the overview of the actions available
     * @todo document parameter
     */
    function action_overview($msg = '') {
        global $member;

        $this->pagehead();

        if ($msg)
            echo _MESSAGE , ': ', $msg;

        /* ---- add items ---- */
        echo '<h2>' . _OVERVIEW_YRBLOGS . '</h2>';

        $showAll = requestVar('showall');

        if (($member->isAdmin()) && ($showAll == 'yes')) {
            // Super-Admins have access to all blogs! (no add item support though)
            $query =  'SELECT bnumber, bname, 1 as tadmin, burl, bshortname'
                   . ' FROM ' . sql_table('blog')
                   . ' ORDER BY bname';
        } else {
            $query =  'SELECT bnumber, bname, tadmin, burl, bshortname'
                   . ' FROM ' . sql_table('blog') . ', ' . sql_table('team')
                   . ' WHERE tblog=bnumber and tmember=' . $member->getID()
                   . ' ORDER BY bname';
        }
        $template['content'] = 'bloglist';
        $template['superadmin'] = $member->isAdmin();
        $amount = showlist($query,'table',$template);

        if (($showAll != 'yes') && ($member->isAdmin())) {
            $total = quickQuery('SELECT COUNT(*) as result FROM ' . sql_table('blog'));
            if ($total > $amount)
                echo '<p><a href="index.php?action=overview&amp;showall=yes">' . _OVERVIEW_SHOWALL . '</a></p>';
        }

        if ($amount == 0)
            echo _OVERVIEW_NOBLOGS;

        if ($amount != 0) {
            echo '<h2>' . _OVERVIEW_YRDRAFTS . '</h2>';
            $query =  'SELECT ititle, inumber, bshortname'
                   . ' FROM ' . sql_table('item'). ', ' . sql_table('blog')
                   . ' WHERE iauthor='.$member->getID().' and iblog=bnumber and idraft=1';
            $template['content'] = 'draftlist';
            $amountdrafts = showlist($query, 'table', $template);
            if ($amountdrafts == 0)
                echo _OVERVIEW_NODRAFTS;
        }
				
		if ($amount != 0) {
			$yrBlogs = $member->getAdminBlogs();
			if ($showAll != 'yes') {
				$admBlogs = array();
				foreach ($yrBlogs as $value) {
					if ($member->isBlogAdmin(intval($value))) {
						$admBlogs[] = intval($value);
					}
				}
				$yrBlogs = $admBlogs;
			}
			
			if (count($yrBlogs) > 0) {
				echo '<h2>' . _OVERVIEW_OTHER_DRAFTS . '</h2>';
				$query =  'SELECT ititle, inumber, bshortname, mname'
					   . ' FROM ' . sql_table('item'). ', ' . sql_table('blog'). ', ' . sql_table('member')
					   . ' WHERE iauthor<>'.$member->getID().' and iblog IN ('.implode(",",$yrBlogs).') and iblog=bnumber and iauthor=mnumber and idraft=1'
					   . ' ORDER BY iblog ASC';
				$template['content'] = 'otherdraftlist';
				$amountdrafts = showlist($query, 'table', $template);
				if ($amountdrafts == 0)
					echo _OVERVIEW_NODRAFTS;
			}
        }

        /* ---- user settings ---- */
        echo '<h2>' . _OVERVIEW_YRSETTINGS . '</h2>';
        echo '<ul>';
        echo '<li><a href="index.php?action=editmembersettings">' . _OVERVIEW_EDITSETTINGS. '</a></li>';
        echo '<li><a href="index.php?action=browseownitems">' . _OVERVIEW_BROWSEITEMS.'</a></li>';
        echo '<li><a href="index.php?action=browseowncomments">'._OVERVIEW_BROWSECOMM.'</a></li>';
        echo '</ul>';

        /* ---- general settings ---- */
        if ($member->isAdmin()) {
            echo '<h2>' . _OVERVIEW_MANAGEMENT. '</h2>';
            echo '<ul>';
            echo '<li><a href="index.php?action=manage">',_OVERVIEW_MANAGE,'</a></li>';
            echo '</ul>';
        }


        $this->pagefoot();
    }

    /**
     * Returns a link to a weblog
     * @param object BLOG
     */
    function bloglink(&$blog) {
        return '<a href="'.hsc($blog->getURL()).'" title="'._BLOGLIST_TT_VISIT.'">'. hsc( $blog->getName() ) .'</a>';
    }

    /**
     * @todo document this
     */
    function action_manage($msg = '') {
        global $member;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';

        if ($msg)
            echo '<p>' , _MESSAGE , ': ', $msg , '</p>';


        echo '<h2>' . _MANAGE_GENERAL. '</h2>';

        echo '<ul>';
        echo '<li><a href="index.php?action=createnewlog">'._OVERVIEW_NEWLOG.'</a></li>';
        echo '<li><a href="index.php?action=settingsedit">'._OVERVIEW_SETTINGS.'</a></li>';
        echo '<li><a href="index.php?action=usermanagement">'._OVERVIEW_MEMBERS.'</a></li>';
        echo '<li><a href="index.php?action=actionlog">'._OVERVIEW_VIEWLOG.'</a></li>';
        echo '</ul>';

        echo '<h2>' . _MANAGE_SKINS . '</h2>';
        echo '<ul>';
        echo '<li><a href="index.php?action=skinoverview">'._OVERVIEW_SKINS.'</a></li>';
        echo '<li><a href="index.php?action=templateoverview">'._OVERVIEW_TEMPLATES.'</a></li>';
        echo '<li><a href="index.php?action=skinieoverview">'._OVERVIEW_SKINIMPORT.'</a></li>';
        echo '</ul>';

        echo '<h2>' . _MANAGE_EXTRA . '</h2>';
        echo '<ul>';
        echo '<li><a href="index.php?action=backupoverview">'._OVERVIEW_BACKUP.'</a></li>';
        echo '<li><a href="index.php?action=pluginlist">'._OVERVIEW_PLUGINS.'</a></li>';
        echo '</ul>';

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_itemlist($blogid = '') {
        global $member, $manager, $CONF;

        if ($blogid == '')
            $blogid = intRequestVar('blogid');

        $member->teamRights($blogid) or $member->isAdmin() or $this->disallow();

        $this->pagehead();
        $blog =& $manager->getBlog($blogid);

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
        echo '<h2>' . _ITEMLIST_BLOG . ' ' . $this->bloglink($blog) . '</h2>';

        // start index
        if (postVar('start'))
            $start = intPostVar('start');
        else
            $start = 0;

        if ($start == 0)
            echo '<p><a href="index.php?action=createitem&amp;blogid='.$blogid.'">',_ITEMLIST_ADDNEW,'</a></p>';

        // amount of items to show
        if (postVar('amount'))
            $amount = intPostVar('amount');
        else {
            $amount = intval($CONF['DefaultListSize']);
            if ($amount < 1)
                $amount = 10;
        }

        $search = postVar('search');    // search through items

        $query =  'SELECT bshortname, cname, mname, ititle, ibody, inumber, idraft, itime'
               . ' FROM ' . sql_table('item') . ', ' . sql_table('blog') . ', ' . sql_table('member') . ', ' . sql_table('category')
               . ' WHERE iblog=bnumber and iauthor=mnumber and icat=catid and iblog=' . $blogid;

        if ($search)
            $query .= ' and ((ititle LIKE "%' . sql_real_escape_string($search) . '%") or (ibody LIKE "%' . sql_real_escape_string($search) . '%") or (imore LIKE "%' . sql_real_escape_string($search) . '%"))';

        // non-blog-admins can only edit/delete their own items
        if (!$member->blogAdminRights($blogid))
            $query .= ' and iauthor=' . $member->getID();


        $query .= ' ORDER BY itime DESC'
                . " LIMIT $start,$amount";

        $template['content'] = 'itemlist';
        $template['now'] = $blog->getCorrectTime(time());

        $manager->loadClass("ENCAPSULATE");
        $navList = new NAVLIST('itemlist', $start, $amount, 0, 1000, $blogid, $search, 0);
        $navList->showBatchList('item', $query, 'table', $template);


        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_batchitem() {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action = requestVar('batchaction');

        // Show error when no items were selected
        if (!is_array($selected) || sizeof($selected) == 0)
            $this->error(_BATCH_NOSELECTION);

        // On move: when no destination blog/category chosen, show choice now
        $destCatid = intRequestVar('destcatid');
        if (($action == 'move') && (!$manager->existsCategory($destCatid)))
            $this->batchMoveSelectDestination('item',$selected);

        // On delete: check if confirmation has been given
        if (($action == 'delete') && (requestVar('confirmation') != 'yes'))
            $this->batchAskDeleteConfirmation('item',$selected);

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACKHOME,')</a>';
        echo '<h2>',_BATCH_ITEMS,'</h2>';
        echo '<p>',_BATCH_EXECUTING,' <b>',hsc($action),'</b></p>';
        echo '<ul>';


        // walk over all itemids and perform action
        foreach ($selected as $itemid) {
            $itemid = intval($itemid);
            echo '<li>',_BATCH_EXECUTING,' <b>',hsc($action),'</b> ',_BATCH_ONITEM,' <b>', $itemid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneItem($itemid);
                    break;
                case 'move':
                    $error = $this->moveOneItem($itemid, $destCatid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>',_BATCH_DONE,'</b>';

        $this->pagefoot();


    }

    /**
     * @todo document this
     */
    function action_batchcomment() {
        global $member;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action = requestVar('batchaction');

        // Show error when no items were selected
        if (!is_array($selected) || sizeof($selected) == 0)
            $this->error(_BATCH_NOSELECTION);

        // On delete: check if confirmation has been given
        if (($action == 'delete') && (requestVar('confirmation') != 'yes'))
            $this->batchAskDeleteConfirmation('comment',$selected);

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACKHOME,')</a>';
        echo '<h2>',_BATCH_COMMENTS,'</h2>';
        echo '<p>',_BATCH_EXECUTING,' <b>',hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $commentid) {
            $commentid = intval($commentid);
            echo '<li>',_BATCH_EXECUTING,' <b>',hsc($action),'</b> ',_BATCH_ONCOMMENT,' <b>', $commentid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneComment($commentid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>',_BATCH_DONE,'</b>';

        $this->pagefoot();


    }

    /**
     * @todo document this
     */
    function action_batchmember() {
        global $member;

        // check if logged in and admin
        ($member->isLoggedIn() && $member->isAdmin()) or $this->disallow();

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action = requestVar('batchaction');

        // Show error when no members selected
        if (!is_array($selected) || sizeof($selected) == 0)
            $this->error(_BATCH_NOSELECTION);

        // On delete: check if confirmation has been given
        if (($action == 'delete') && (requestVar('confirmation') != 'yes'))
            $this->batchAskDeleteConfirmation('member',$selected);

        $this->pagehead();

        echo '<a href="index.php?action=usermanagement">(',_MEMBERS_BACKTOOVERVIEW,')</a>';
        echo '<h2>',_BATCH_MEMBERS,'</h2>';
        echo '<p>',_BATCH_EXECUTING,' <b>',hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = intval($memberid);
            echo '<li>',_BATCH_EXECUTING,' <b>',hsc($action),'</b> ',_BATCH_ONMEMBER,' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneMember($memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    sql_query('UPDATE ' . sql_table('member') . ' SET madmin=1 WHERE mnumber='.$memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one super-admin
                    $r = sql_query('SELECT * FROM '.sql_table('member'). ' WHERE madmin=1 and mcanlogin=1');
                    if (sql_num_rows($r) < 2)
                        $error = _ERROR_ATLEASTONEADMIN;
                    else
                        sql_query('UPDATE ' . sql_table('member') .' SET madmin=0 WHERE mnumber='.$memberid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>',_BATCH_DONE,'</b>';

        $this->pagefoot();


    }

    /**
     * @todo document this
     */
    function action_batchteam() {
        global $member;

        $blogid = intRequestVar('blogid');

        // check if logged in and admin
        ($member->isLoggedIn() && $member->blogAdminRights($blogid)) or $this->disallow();

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action = requestVar('batchaction');

        // Show error when no members selected
        if (!is_array($selected) || sizeof($selected) == 0)
            $this->error(_BATCH_NOSELECTION);

        // On delete: check if confirmation has been given
        if (($action == 'delete') && (requestVar('confirmation') != 'yes'))
            $this->batchAskDeleteConfirmation('team',$selected);

        $this->pagehead();

        echo '<p><a href="index.php?action=manageteam&amp;blogid=',$blogid,'">(',_BACK,')</a></p>';

        echo '<h2>',_BATCH_TEAM,'</h2>';
        echo '<p>',_BATCH_EXECUTING,' <b>',hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = intval($memberid);
            echo '<li>',_BATCH_EXECUTING,' <b>',hsc($action),'</b> ',_BATCH_ONTEAM,' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneTeamMember($blogid, $memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    sql_query('UPDATE '.sql_table('team').' SET tadmin=1 WHERE tblog='.$blogid.' and tmember='.$memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one admin
                    $r = sql_query('SELECT * FROM '.sql_table('team').' WHERE tadmin=1 and tblog='.$blogid);
                    if (sql_num_rows($r) < 2)
                        $error = _ERROR_ATLEASTONEBLOGADMIN;
                    else
                        sql_query('UPDATE '.sql_table('team').' SET tadmin=0 WHERE tblog='.$blogid.' and tmember='.$memberid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>',_BATCH_DONE,'</b>';

        $this->pagefoot();


    }

    /**
     * @todo document this
     */
    function action_batchcategory() {
        global $member, $manager;

        // check if logged in
        $member->isLoggedIn() or $this->disallow();

        // more precise check will be done for each performed operation

        // get array of itemids from request
        $selected = requestIntArray('batch');
        $action = requestVar('batchaction');

        // Show error when no items were selected
        if (!is_array($selected) || sizeof($selected) == 0)
            $this->error(_BATCH_NOSELECTION);

        // On move: when no destination blog chosen, show choice now
        $destBlogId = intRequestVar('destblogid');
        if (($action == 'move') && (!$manager->existsBlogID($destBlogId)))
            $this->batchMoveCategorySelectDestination('category',$selected);

        // On delete: check if confirmation has been given
        if (($action == 'delete') && (requestVar('confirmation') != 'yes'))
            $this->batchAskDeleteConfirmation('category',$selected);

        $this->pagehead();

        echo '<a href="index.php?action=overview">(',_BACKHOME,')</a>';
        echo '<h2>',BATCH_CATEGORIES,'</h2>';
        echo '<p>',_BATCH_EXECUTING,' <b>',hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $catid) {
            $catid = intval($catid);
            echo '<li>',_BATCH_EXECUTING,' <b>',hsc($action),'</b> ',_BATCH_ONCATEGORY,' <b>', $catid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneCategory($catid);
                    break;
                case 'move':
                    $error = $this->moveOneCategory($catid, $destBlogId);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . hsc($action);
            }

            echo '<b>',($error ? _ERROR . ': '.$error : _BATCH_SUCCESS),'</b>';
            echo '</li>';
        }

        echo '</ul>';
        echo '<b>',_BATCH_DONE,'</b>';

        $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function batchMoveSelectDestination($type, $ids) {
        global $manager;
        $this->pagehead();
        ?>
        <h2><?php echo _MOVE_TITLE?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type?>" />
            <input type="hidden" name="batchaction" value="move" />
            <?php
                $manager->addTicketHidden();

                // insert selected item numbers
                $idx = 0;
                foreach ($ids as $id)
                    echo '<input type="hidden" name="batch[',($idx++),']" value="',intval($id),'" />';

                // show blog/category selection list
                $this->selectBlogCategory('destcatid');

            ?>


            <input type="submit" value="<?php echo _MOVE_BTN?>" onclick="return checkSubmit();" />

        </div></form>
        <?php       $this->pagefoot();
        exit;
    }

    /**
     * @todo document this
     */
    function batchMoveCategorySelectDestination($type, $ids) {
        global $manager;
        $this->pagehead();
        ?>
        <h2><?php echo _MOVECAT_TITLE?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type?>" />
            <input type="hidden" name="batchaction" value="move" />
            <?php
                $manager->addTicketHidden();

                // insert selected item numbers
                $idx = 0;
                foreach ($ids as $id)
                    echo '<input type="hidden" name="batch[',($idx++),']" value="',intval($id),'" />';

                // show blog/category selection list
                $this->selectBlog('destblogid');

            ?>


            <input type="submit" value="<?php echo _MOVECAT_BTN?>" onclick="return checkSubmit();" />

        </div></form>
        <?php       $this->pagefoot();
        exit;
    }

    /**
     * @todo document this
     */
    function batchAskDeleteConfirmation($type, $ids) {
        global $manager;

        $this->pagehead();
        ?>
        <h2><?php echo _BATCH_DELETE_CONFIRM?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type?>" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="batchaction" value="delete" />
            <input type="hidden" name="confirmation" value="yes" />
            <?php               // insert selected item numbers
                $idx = 0;
                foreach ($ids as $id)
                    echo '<input type="hidden" name="batch[',($idx++),']" value="',intval($id),'" />';

                // add hidden vars for team & comment
                if ($type == 'team')
                {
                    echo '<input type="hidden" name="blogid" value="',intRequestVar('blogid'),'" />';
                }
                if ($type == 'comment')
                {
                    echo '<input type="hidden" name="itemid" value="',intRequestVar('itemid'),'" />';
                }

            ?>

            <input type="submit" value="<?php echo _BATCH_DELETE_CONFIRM_BTN?>" onclick="return checkSubmit();" />

        </div></form>
        <?php       $this->pagefoot();
        exit;
    }


    /**
     * Inserts a HTML select element with choices for all categories to which the current
     * member has access
     * @see function selectBlog
     */
    function selectBlogCategory($name, $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1) {
        ADMIN::selectBlog($name, 'category', $selected, $tabindex, $showNewCat, $iForcedBlogInclude);
    }

    /**
     * Inserts a HTML select element with choices for all blogs to which the user has access
     *      mode = 'blog' => shows blognames and values are blogids
     *      mode = 'category' => show category names and values are catids
     *
     * @param $iForcedBlogInclude
     *      ID of a blog that always needs to be included, without checking if the
     *      member is on the blog team (-1 = none)
     * @todo document parameters
     */
    function selectBlog($name, $mode='blog', $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1) {
        global $member, $CONF;

        // 0. get IDs of blogs to which member can post items (+ forced blog)
        $aBlogIds = array();
        if ($iForcedBlogInclude != -1)
            $aBlogIds[] = intval($iForcedBlogInclude);

        if (($member->isAdmin()) && (array_key_exists('ShowAllBlogs', $CONF) && $CONF['ShowAllBlogs']))
            $queryBlogs =  'SELECT bnumber FROM '.sql_table('blog').' ORDER BY bname';
        else
            $queryBlogs =  'SELECT bnumber FROM '.sql_table('blog').', '.sql_table('team').' WHERE tblog=bnumber and tmember=' . $member->getID();
        $rblogids = sql_query($queryBlogs);
        while ($o = sql_fetch_object($rblogids))
            if ($o->bnumber != $iForcedBlogInclude)
                $aBlogIds[] = intval($o->bnumber);

        if (count($aBlogIds) == 0)
            return;

        echo '<select name="',$name,'" tabindex="',$tabindex,'">';

        // 1. select blogs (we'll create optiongroups)
        // (only select those blogs that have the user on the team)
        $queryBlogs =  'SELECT bnumber, bname FROM '.sql_table('blog').' WHERE bnumber in ('.implode(',',$aBlogIds).') ORDER BY bname';
        $blogs = sql_query($queryBlogs);
        if ($mode == 'category') {
            if (sql_num_rows($blogs) > 1)
                $multipleBlogs = 1;
            else
              $multipleBlogs = 0;

            while ($oBlog = sql_fetch_object($blogs)) {
                if ($multipleBlogs)
                    echo '<optgroup label="',hsc($oBlog->bname),'">';

                // show selection to create new category when allowed/wanted
                if ($showNewCat) {
                    // check if allowed to do so
                    if ($member->blogAdminRights($oBlog->bnumber))
                        echo '<option value="newcat-',$oBlog->bnumber,'">',_ADD_NEWCAT,'</option>';
                }

                // 2. for each category in that blog
                $categories = sql_query('SELECT cname, catid FROM '.sql_table('category').' WHERE cblog=' . $oBlog->bnumber . ' ORDER BY cname ASC');
                while ($oCat = sql_fetch_object($categories)) {
                    if ($oCat->catid == $selected)
                        $selectText = ' selected="selected" ';
                    else
                        $selectText = '';
                    echo '<option value="',$oCat->catid,'" ', $selectText,'>',hsc($oCat->cname),'</option>';
                }

                if ($multipleBlogs)
                    echo '</optgroup>';
            }
        } else {
            // blog mode
            while ($oBlog = sql_fetch_object($blogs)) {
                echo '<option value="',$oBlog->bnumber,'"';
                if ($oBlog->bnumber == $selected)
                    echo ' selected="selected"';
                echo'>',hsc($oBlog->bname),'</option>';
            }
        }
        echo '</select>';

    }

    /**
     * @todo document this
     */
    function action_browseownitems() {
        global $member, $manager, $CONF;

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
        echo '<h2>' . _ITEMLIST_YOUR. '</h2>';

        // start index
        if (postVar('start'))
            $start = intPostVar('start');
        else
            $start = 0;

        // amount of items to show
        if (postVar('amount'))
            $amount = intPostVar('amount');
        else {
            $amount = intval($CONF['DefaultListSize']);
            if ($amount < 1)
                $amount = 10;
        }

        $search = postVar('search');    // search through items

        $query =  'SELECT bshortname, cname, mname, ititle, ibody, idraft, inumber, itime'
               . ' FROM '.sql_table('item').', '.sql_table('blog') . ', '.sql_table('member') . ', '.sql_table('category')
               . ' WHERE iauthor='. $member->getID() .' and iauthor=mnumber and iblog=bnumber and icat=catid';

        if ($search)
            $query .= ' and ((ititle LIKE "%' . sql_real_escape_string($search) . '%") or (ibody LIKE "%' . sql_real_escape_string($search) . '%") or (imore LIKE "%' . sql_real_escape_string($search) . '%"))';

        $query .= ' ORDER BY itime DESC'
                . " LIMIT $start,$amount";

        $template['content'] = 'itemlist';
        $template['now'] = time();

        $manager->loadClass("ENCAPSULATE");
        $navList = new NAVLIST('browseownitems', $start, $amount, 0, 1000, /*$blogid*/ 0, $search, 0);
        $navList->showBatchList('item', $query, 'table', $template);

        $this->pagefoot();

    }

    /**
     * Show all the comments for a given item
     * @param int $itemid
     */
    function action_itemcommentlist($itemid = '') {
        global $member, $manager, $CONF;

        if ($itemid == '')
            $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $blogid = getBlogIdFromItemId($itemid);

        $this->pagehead();

        // start index
        if (postVar('start'))
            $start = intPostVar('start');
        else
            $start = 0;

        // amount of items to show
        if (postVar('amount'))
            $amount = intPostVar('amount');
        else {
            $amount = intval($CONF['DefaultListSize']);
            if ($amount < 1)
                $amount = 10;
        }

        $search = postVar('search');

        echo '<p>(<a href="index.php?action=itemlist&amp;blogid=',$blogid,'">',_BACKTOOVERVIEW,'</a>)</p>';
        echo '<h2>',_COMMENTS,'</h2>';

        $query = 'SELECT cbody, cuser, cmail, cemail, mname, ctime, chost, cnumber, cip, citem FROM ' . sql_table('comment') . ' LEFT OUTER JOIN ' . sql_table('member') . ' ON mnumber = cmember WHERE citem = ' . $itemid;

        if ($search)
            $query .= ' and cbody LIKE "%' . sql_real_escape_string($search) . '%"';

        $query .= ' ORDER BY ctime ASC'
                . " LIMIT $start,$amount";

        $template['content'] = 'commentlist';
        $template['canAddBan'] = $member->blogAdminRights(getBlogIDFromItemID($itemid));

        $manager->loadClass("ENCAPSULATE");
        $navList = new NAVLIST('itemcommentlist', $start, $amount, 0, 1000, 0, $search, $itemid);
        $navList->showBatchList('comment', $query, 'table', $template, _NOCOMMENTS);

        $this->pagefoot();
    }

    /**
     * Browse own comments
     */
    function action_browseowncomments() {
        global $member, $manager, $CONF;

        // start index
        if (postVar('start'))
            $start = intPostVar('start');
        else
            $start = 0;

        // amount of items to show
        if (postVar('amount'))
            $amount = intPostVar('amount');
        else {
            $amount = intval($CONF['DefaultListSize']);
            if ($amount < 1)
                $amount = 10;
        }

        $search = postVar('search');


        $query =  'SELECT cbody, cuser, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE cmember=' . $member->getID();

        if ($search)
            $query .= ' and cbody LIKE "%' . sql_real_escape_string($search) . '%"';

        $query .= ' ORDER BY ctime DESC'
                . " LIMIT $start,$amount";

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
        echo '<h2>', _COMMENTS_YOUR ,'</h2>';

        $template['content'] = 'commentlist';
        $template['canAddBan'] = 0; // doesn't make sense to allow banning yourself

        $manager->loadClass("ENCAPSULATE");
        $navList = new NAVLIST('browseowncomments', $start, $amount, 0, 1000, 0, $search, 0);
        $navList->showBatchList('comment', $query, 'table', $template, _NOCOMMENTS_YOUR);

        $this->pagefoot();
    }

    /**
     * Browse all comments for a weblog
     * @param int $blogid
     */
    function action_blogcommentlist($blogid = '')
    {
        global $member, $manager, $CONF;

        if ($blogid == '')
            $blogid = intRequestVar('blogid');
        else
            $blogid = intval($blogid);

        $member->teamRights($blogid) or $member->isAdmin() or $this->disallow();

        // start index
        if (postVar('start'))
            $start = intPostVar('start');
        else
            $start = 0;

        // amount of items to show
        if (postVar('amount'))
            $amount = intPostVar('amount');
        else {
            $amount = intval($CONF['DefaultListSize']);
            if ($amount < 1)
                $amount = 10;
        }

        $search = postVar('search');        // search through comments


        $query =  'SELECT cbody, cuser, cemail, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE cblog=' . intval($blogid);

        if ($search != '')
            $query .= ' and cbody LIKE "%' . sql_real_escape_string($search) . '%"';


        $query .= ' ORDER BY ctime DESC'
                . " LIMIT $start,$amount";


        $blog =& $manager->getBlog($blogid);

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
        echo '<h2>', _COMMENTS_BLOG , ' ' , $this->bloglink($blog), '</h2>';

        $template['content'] = 'commentlist';
        $template['canAddBan'] = $member->blogAdminRights($blogid);

        $manager->loadClass("ENCAPSULATE");
        $navList = new NAVLIST('blogcommentlist', $start, $amount, 0, 1000, $blogid, $search, 0);
        $navList->showBatchList('comment', $query, 'table', $template, _NOCOMMENTS_BLOG);

        $this->pagefoot();
    }

    /**
     * Provide a page to item a new item to the given blog
     */
    function action_createitem() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->teamRights($blogid) or $this->disallow();

        $memberid = $member->getID();

        $blog =& $manager->getBlog($blogid);

        $this->pagehead();

        // generate the add-item form
        $formfactory = new PAGEFACTORY($blogid);
        $formfactory->createAddForm('admin');

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_itemedit() {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $item =& $manager->getItem($itemid,1,1);
        $blog =& $manager->getBlog(getBlogIDFromItemID($itemid));

        $data = array('item' => &$item);
        $manager->notify('PrepareItemForEdit', $data);

        if ($blog->convertBreaks()) {
            $item['body'] = removeBreaks($item['body']);
            $item['more'] = removeBreaks($item['more']);
        }

        // form to edit blog items
        $this->pagehead();
        $formfactory = new PAGEFACTORY($blog->getID());
        $formfactory->createEditForm('admin',$item);
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_itemupdate() {
        global $member, $manager, $CONF;

        $itemid = intRequestVar('itemid');
        $catid = postVar('catid');

        // only allow if user is allowed to alter item
        $member->canUpdateItem($itemid, $catid) or $this->disallow();

        $actiontype = postVar('actiontype');

        // delete actions are handled by itemdelete (which has confirmation)
        if ($actiontype == 'delete') {
            $this->action_itemdelete();
            return;
        }

        $body   = postVar('body');
        $title  = postVar('title');
        $more   = postVar('more');
        $closed = intPostVar('closed');
        $draftid = intPostVar('draftid');

        // default action = add now
        if (!$actiontype)
            $actiontype='addnow';

        // create new category if needed
        if (strstr($catid,'newcat')) {
            // get blogid
            list($blogid) = sscanf($catid,"newcat-%d");

            // create
            $blog =& $manager->getBlog($blogid);
            $catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if (!$catid)
                $this->doError(_ERROR_CATCREATEFAIL);
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
        $blogid =  getBlogIDFromItemID($itemid);
        $blog   =& $manager->getBlog($blogid);

        $wasdrafts = array('adddraft', 'addfuture', 'addnow');
        $wasdraft  = in_array($actiontype, $wasdrafts) ? 1 : 0;
        $publish   = ($actiontype != 'adddraft' && $actiontype != 'backtodrafts') ? 1 : 0;
        if ($actiontype == 'addfuture' || $actiontype == 'changedate') {
            $timestamp = mktime(intPostVar('hour'), intPostVar('minutes'), 0, intPostVar('month'), intPostVar('day'), intPostVar('year'));
        } else {
            $timestamp =0;
        }

        // edit the item for real
        ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);

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
            // TODO: set start item correctly for itemlist
            $this->action_itemlist(getBlogIDFromItemID($itemid));
        }
    }

    /**
     * @todo document this
     */
    function action_itemdelete() {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        if (!$manager->existsItem($itemid,1,1))
            $this->error(_ERROR_NOSUCHITEM);

        $item =& $manager->getItem($itemid,1,1);
        $title = hsc(strip_tags($item['title']));
        $body = strip_tags($item['body']);
        $body = hsc(shorten($body,300,'...'));

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _CONFIRMTXT_ITEM?></p>

            <div class="note">
                <b>"<?php echo  $title ?>"</b>
                <br />
                <?php echo $body?>
            </div>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="itemdeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
                <input type="submit" value="<?php echo _DELETE_CONFIRM_BTN?>"  tabindex="10" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_itemdeleteconfirm() {
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
     * @param int $itemid
     */
    function deleteOneItem($itemid) {
        global $member, $manager;

        // only allow if user is allowed to alter item (also checks if itemid exists)
        if (!$member->canAlterItem($itemid))
            return _ERROR_DISALLOWED;

        // need to get blogid before the item is deleted
        $blogid = getBlogIDFromItemId($itemid);

        $manager->loadClass('ITEM');
        ITEM::delete($itemid);

        // update blog's futureposted
        $this->updateFuturePosted($blogid);
    }

    /**
     * Update a blog's future posted flag
     * @param int $blogid
     */
    function updateFuturePosted($blogid) {
        global $manager;

        $blog =& $manager->getBlog($blogid);
        $currenttime = $blog->getCorrectTime(time());
        $result = sql_query("SELECT * FROM ".sql_table('item').
            " WHERE iblog='".$blogid."' AND iposted=0 AND itime>".mysqldate($currenttime));
        if (sql_num_rows($result) > 0) {
                $blog->setFuturePost();
        }
        else {
                $blog->clearFuturePost();
        }
    }

    /**
     * @todo document this
     */
    function action_itemmove() {
        global $member, $manager;

        $itemid = intRequestVar('itemid');

        // only allow if user is allowed to alter item
        $member->canAlterItem($itemid) or $this->disallow();

        $item =& $manager->getItem($itemid,1,1);

        $this->pagehead();
        ?>
            <h2><?php echo _MOVE_TITLE?></h2>
            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="itemmoveto" />
                <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />

                <?php

                    $manager->addTicketHidden();
                    $this->selectBlogCategory('catid',$item['catid'],10,1);
                ?>

                <input type="submit" value="<?php echo _MOVE_BTN?>" tabindex="10000" onclick="return checkSubmit();" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_itemmoveto() {
        global $member, $manager;

        $itemid = intRequestVar('itemid');
        $catid = requestVar('catid');

        // create new category if needed
        if (strstr($catid,'newcat')) {
            // get blogid
            list($blogid) = sscanf($catid,'newcat-%d');

            // create
            $blog =& $manager->getBlog($blogid);
            $catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if (!$catid)
                $this->doError(_ERROR_CATCREATEFAIL);
        }

        // only allow if user is allowed to alter item
        $member->canUpdateItem($itemid, $catid) or $this->disallow();

        $old_blogid = getBlogIDFromItemId($itemid);

        ITEM::move($itemid, $catid);

        // set the futurePosted flag on the blog
        $this->updateFuturePosted(getBlogIDFromItemId($itemid));

        // reset the futurePosted in case the item is moved from one blog to another
        $this->updateFuturePosted($old_blogid);

        if ($catid != intRequestVar('catid'))
            $this->action_categoryedit($catid, $blog->getID());
        else
            $this->action_itemlist(getBlogIDFromCatID($catid));
    }

    /**
     * Moves one item to a given category (category existance should be checked by caller)
     * errors are returned
     * @param int $itemid
     * @param int $destCatid category ID to which the item will be moved
     */
    function moveOneItem($itemid, $destCatid) {
        global $member;

        // only allow if user is allowed to move item
        if (!$member->canUpdateItem($itemid, $destCatid))
            return _ERROR_DISALLOWED;

        ITEM::move($itemid, $destCatid);
    }

    /**
     * Adds a item to the chosen blog
     */
    function action_additem() {
        global $manager, $CONF;

        $manager->loadClass('ITEM');

        $result = ITEM::createFromRequest();

        if ($result['status'] == 'error')
            $this->error($result['message']);

        $blogid = getBlogIDFromItemID($result['itemid']);
        $blog =& $manager->getBlog($blogid);
        $btimestamp = $blog->getCorrectTime();
        $item       = $manager->getItem(intval($result['itemid']), 1, 1);

        if ($result['status'] == 'newcategory') {
            $distURI = $manager->addTicketToUrl($CONF['AdminURL'] . 'index.php?action=itemList&blogid=' . intval($blogid));
            $this->action_categoryedit($result['catid'], $blogid, $distURI);
        } else {
            $methodName = 'action_itemList';
            call_user_func(array($this, $methodName), $blogid);
        }
    }

	/**
	 * Allows to edit previously made comments
	 **/
	function action_commentedit() {

		global $member, $manager;

		$commentid = intRequestVar('commentid');

		$member->canAlterComment($commentid) or $this->disallow();

		$comment = COMMENT::getComment($commentid);

		$data = array('comment' => &$comment);
		$manager->notify('PrepareCommentForEdit', $data);

		// change <br /> to \n
		$comment['body'] = str_replace('<br />', '', $comment['body']);

		// replaced eregi_replace() below with preg_replace(). ereg* functions are deprecated in PHP 5.3.0
		/* original eregi_replace: eregi_replace("<a href=['\"]([^'\"]+)['\"]( rel=\"nofollow\")?>[^<]*</a>", "\\1", $comment['body']) */

        $comment['body'] = preg_replace("#<a href=['\"]([^'\"]+)['\"]( rel=\"nofollow\")?>[^<]*</a>#i", "\\1", $comment['body']);

        $this->pagehead();

        ?>
        <h2><?php echo _EDITC_TITLE?></h2>

        <form action="index.php" method="post"><div>

        <input type="hidden" name="action" value="commentupdate" />
        <?php $manager->addTicketHidden(); ?>
        <input type="hidden" name="commentid" value="<?php echo  $commentid; ?>" />
        <table><tr>
            <th colspan="2"><?php echo _EDITC_TITLE?></th>
        </tr><tr>
            <td><?php echo _EDITC_WHO?></td>
            <td>
            <?php               if ($comment['member'])
                    echo $comment['member'] . " (" . _EDITC_MEMBER . ")";
                else
                    echo $comment['user'] . " (" . _EDITC_NONMEMBER . ")";
            ?>
            </td>
        </tr><tr>
            <td><?php echo _EDITC_WHEN?></td>
            <td><?php echo  date("Y-m-d @ H:i",$comment['timestamp']); ?></td>
        </tr><tr>
            <td><?php echo _EDITC_HOST?></td>
            <td><?php echo  $comment['host']; ?></td>
        </tr>
        <tr>
            <td><?php echo _EDITC_URL; ?></td>
            <td><input type="text" name="url" size="30" tabindex="6" value="<?php echo $comment['userid']; ?>" /></td>
        </tr>
        <tr>
            <td><?php echo _EDITC_EMAIL; ?></td>
            <td><input type="text" name="email" size="30" tabindex="8" value="<?php echo $comment['email']; ?>" /></td>
        </tr>
        <tr>
            <td><?php echo _EDITC_TEXT?></td>
            <td>
                <textarea name="body" tabindex="10" rows="10" cols="50"><?php                   // htmlspecialchars not needed (things should be escaped already)
                    echo $comment['body'];
                ?></textarea>
            </td>
        </tr><tr>
            <td><?php echo _EDITC_EDIT?></td>
            <td><input type="submit"  tabindex="20" value="<?php echo _EDITC_EDIT?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_commentupdate() {
        global $member, $manager;

        $commentid = intRequestVar('commentid');

        $member->canAlterComment($commentid) or $this->disallow();

        $url = postVar('url');
        $email = postVar('email');
        $body = postVar('body');

		# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
		# original eregi: eregi("[a-zA-Z0-9|\.,;:!\?=\/\\]{90,90}", $body) != FALSE
		# important note that '\' must be matched with '\\\\' in preg* expressions

		// intercept words that are too long
		if (preg_match('#[a-zA-Z0-9|\.,;:!\?=\/\\\\]{90,90}#', $body) != FALSE)
		{
			$this->error(_ERROR_COMMENT_LONGWORD);
		}

		// check length
		if (strlen($body) < 3)
		{
			$this->error(_ERROR_COMMENT_NOCOMMENT);
		}

		if (strlen($body) > 5000)
		{
			$this->error(_ERROR_COMMENT_TOOLONG);
		}

        // prepare body
        $body = COMMENT::prepareBody($body);

        // call plugins
        $data = array('body' => &$body);
        $manager->notify('PreUpdateComment', $data);

        $query = 'UPDATE ' . sql_table('comment')
               . " SET cmail = '" . sql_real_escape_string($url) . "', cemail = '" . sql_real_escape_string($email) . "', cbody = '" . sql_real_escape_string($body) . "'"
               . " WHERE cnumber = " . $commentid;
        sql_query($query);

        // get itemid
        $res = sql_query('SELECT citem FROM '.sql_table('comment').' WHERE cnumber=' . $commentid);
        $o = sql_fetch_object($res);
        $itemid = $o->citem;

        if ($member->canAlterItem($itemid))
            $this->action_itemcommentlist($itemid);
        else
            $this->action_browseowncomments();

    }

    /**
     * @todo document this
     */
    function action_commentdelete() {
        global $member, $manager;

        $commentid = intRequestVar('commentid');

        $member->canAlterComment($commentid) or $this->disallow();

        $comment = COMMENT::getComment($commentid);

        $body = strip_tags($comment['body']);
        $body = hsc(shorten($body, 300, '...'));

        if ($comment['member'])
            $author = $comment['member'];
        else
            $author = $comment['user'];

        $this->pagehead();
        ?>

            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _CONFIRMTXT_COMMENT?></p>

            <div class="note">
            <b><?php echo _EDITC_WHO?>:</b> <?php echo  $author ?>
            <br />
            <b><?php echo _EDITC_TEXT?>:</b> <?php echo  $body ?>
            </div>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="commentdeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="commentid" value="<?php echo  $commentid; ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_commentdeleteconfirm() {
        global $member;

        $commentid = intRequestVar('commentid');

        // get item id first
        $res = sql_query('SELECT citem FROM '.sql_table('comment') .' WHERE cnumber=' . $commentid);
        $o = sql_fetch_object($res);
        $itemid = $o->citem;

        $error = $this->deleteOneComment($commentid);
        if ($error)
            $this->doError($error);

        if ($member->canAlterItem($itemid))
            $this->action_itemcommentlist($itemid);
        else
            $this->action_browseowncomments();
    }

    /**
     * @todo document this
     */
    function deleteOneComment($commentid) {
        global $member, $manager;

        $commentid = intval($commentid);

        if (!$member->canAlterComment($commentid))
            return _ERROR_DISALLOWED;

        $data = array('commentid' => $commentid);
        $manager->notify('PreDeleteComment', $data);

        // delete the comments associated with the item
        $query = 'DELETE FROM '.sql_table('comment').' WHERE cnumber=' . $commentid;
        sql_query($query);

        $data = array('commentid' => $commentid);
        $manager->notify('PostDeleteComment', $data);

        return '';
    }

    /**
     * Usermanagement main
     */
    function action_usermanagement() {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

        echo '<h2>' . _MEMBERS_TITLE .'</h2>';

        echo '<h3>' . _MEMBERS_CURRENT .'</h3>';

        // show list of members with actions
        $query =  'SELECT *'
               . ' FROM '.sql_table('member');
        $template['content'] = 'memberlist';
        $template['tabindex'] = 10;

        $manager->loadClass("ENCAPSULATE");
        $batch = new BATCH('member');
        $batch->showlist($query,'table',$template);

        echo '<h3>' . _MEMBERS_NEW .'</h3>';
        ?>
            <form method="post" action="index.php" name="memberedit"><div>

            <input type="hidden" name="action" value="memberadd" />
            <?php $manager->addTicketHidden() ?>

            <table>
            <tr>
                <th colspan="2"><?php echo _MEMBERS_NEW?></th>
            </tr><tr>
                <td><?php echo _MEMBERS_DISPLAY?> <?php help('shortnames');?>
                <br /><small><?php echo _MEMBERS_DISPLAY_INFO?></small>
                </td>
                <td><input tabindex="10010" name="name" size="32" maxlength="32" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_REALNAME?></td>
                <td><input name="realname" tabindex="10020" size="40" maxlength="60" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_PWD?></td>
                <td><input name="password" tabindex="10030" size="16" maxlength="40" type="password" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_REPPWD?></td>
                <td><input name="repeatpassword" tabindex="10035" size="16" maxlength="40" type="password" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_EMAIL?></td>
                <td><input name="email" tabindex="10040" size="40" maxlength="60" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_URL?></td>
                <td><input name="url" tabindex="10050" size="40" maxlength="100" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_SUPERADMIN?> <?php help('superadmin'); ?></td>
                <td><?php $this->input_yesno('admin',0,10060); ?> </td>
            </tr><tr>
                <td><?php echo _MEMBERS_CANLOGIN?> <?php help('canlogin'); ?></td>
                <td><?php $this->input_yesno('canlogin',1,10070); ?></td>
            </tr><tr>
                <td><?php echo _MEMBERS_NOTES?></td>
                <td><input name="notes" maxlength="100" size="40" tabindex="10080" /></td>
            </tr><tr>
                <td><?php echo _MEMBERS_NEW?></td>
                <td><input type="submit" value="<?php echo _MEMBERS_NEW_BTN?>" tabindex="10090" onclick="return checkSubmit();" /></td>
            </tr></table>

            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * Edit member settings
     */
    function action_memberedit() {
        $this->action_editmembersettings(intRequestVar('memberid'));
    }

    /**
     * @todo document this
     */
    function action_editmembersettings($memberid = '') {
        global $member, $manager, $CONF;

        if ($memberid == '')
            $memberid = $member->getID();

        // check if allowed
        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        // show message to go back to member overview (only for admins)
        if ($member->isAdmin())
            echo '<a href="index.php?action=usermanagement">(' ._MEMBERS_BACKTOOVERVIEW. ')</a>';
        else
            echo '<a href="index.php?action=overview">(' ._BACKHOME. ')</a>';

        echo '<h2>' . _MEMBERS_EDIT . '</h2>';

        $mem = MEMBER::createFromID($memberid);

        ?>
        <form method="post" action="index.php" name="memberedit"><div>

        <input type="hidden" name="action" value="changemembersettings" />
        <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
        <?php $manager->addTicketHidden() ?>

        <table><tr>
            <th colspan="2"><?php echo _MEMBERS_EDIT?></th>
        </tr><tr>
            <td><?php echo _MEMBERS_DISPLAY?> <?php help('shortnames');?>
                <br /><small><?php echo _MEMBERS_DISPLAY_INFO?></small>
            </td>
            <td>
            <?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
                <input name="name" tabindex="10" maxlength="32" size="32" value="<?php echo  hsc($mem->getDisplayName()); ?>" />
            <?php } else {
                echo hsc($member->getDisplayName());
               }
            ?>
            </td>
        </tr><tr>
            <td><?php echo _MEMBERS_REALNAME?></td>
            <td><input name="realname" tabindex="20" maxlength="60" size="40" value="<?php echo  hsc($mem->getRealName()); ?>" /></td>
        </tr><tr>
        <?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
            <td><?php echo _MEMBERS_PWD?></td>
            <td><input type="password" tabindex="30" maxlength="40" size="16" name="password" /></td>
        </tr><tr>
            <td><?php echo _MEMBERS_REPPWD?></td>
            <td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" /></td>
        <?php } ?>
        </tr><tr>
            <td><?php echo _MEMBERS_EMAIL?>
                <br /><small><?php echo _MEMBERS_EMAIL_EDIT?></small>
            </td>
            <td><input name="email" tabindex="40" size="40" maxlength="60" value="<?php echo  hsc($mem->getEmail()); ?>" /></td>
        </tr><tr>
            <td><?php echo _MEMBERS_URL?></td>
            <td><input name="url" tabindex="50" size="40" maxlength="100" value="<?php echo  hsc($mem->getURL()); ?>" /></td>
        <?php // only allow to change this by super-admins
           // we don't want normal users to 'upgrade' themselves to super-admins, do we? ;-)
           if ($member->isAdmin()) {
        ?>
            </tr><tr>
                <td><?php echo _MEMBERS_SUPERADMIN?> <?php help('superadmin'); ?></td>
                <td><?php $this->input_yesno('admin',$mem->isAdmin(),60); ?></td>
            </tr><tr>
                <td><?php echo _MEMBERS_CANLOGIN?> <?php help('canlogin'); ?></td>
                <td><?php $this->input_yesno('canlogin',$mem->canLogin(),70,1,0,_YES,_NO,$mem->isAdmin()); ?></td>
        <?php } ?>
        </tr><tr>
            <td><?php echo _MEMBERS_NOTES?></td>
            <td><input name="notes" tabindex="80" size="40" maxlength="100" value="<?php echo  hsc($mem->getNotes()); ?>" /></td>
        </tr><tr>
            <td><?php echo _MEMBERS_DEFLANG?> <?php help('language'); ?>
            </td>
            <td>

                <select name="deflang" tabindex="85">
                    <option value=""><?php echo _MEMBERS_USESITELANG?></option>
                <?php               // show a dropdown list of all available languages
                global $DIR_LANG;
                $dirhandle = opendir($DIR_LANG);

				while ($filename = readdir($dirhandle))
				{

					# replaced ereg() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
					# original ereg: ereg("^(.*)\.php$", $filename, $matches)

					if (preg_match('#^(.*)\.php$#', $filename, $matches) )
					{

						$name = $matches[1];
						echo "<option value=\"$name\"";

						if ($name == $mem->getLanguage() )
						{
							echo " selected=\"selected\"";
						}

						echo ">$name</option>";

					}

				}

				closedir($dirhandle);

				?>
				</select>

            </td>
        </tr>
        <tr>
            <td><?php echo _MEMBERS_USEAUTOSAVE?> <?php help('autosave'); ?></td>
            <td><?php $this->input_yesno('autosave', $mem->getAutosave(), 87); ?></td>
        </tr>
        <?php
            // plugin options
            $this->_insertPluginOptions('member',$memberid);
        ?>
        <tr>
            <th colspan="2"><?php echo _MEMBERS_EDIT ?></th>
        </tr><tr>
            <td><?php echo _MEMBERS_EDIT?></td>
            <td><input type="submit" tabindex="90" value="<?php echo _MEMBERS_EDIT_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div></form>

        <?php
            echo '<h3>',_PLUGINS_EXTRA,'</h3>';

            $data = array('member' => &$mem);
            $manager->notify('MemberSettingsFormExtras', $data);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_changemembersettings() {
        global $member, $CONF, $manager;

        $memberid = intRequestVar('memberid');

        // check if allowed
        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $name           = trim(strip_tags(postVar('name')));
        $realname       = trim(strip_tags(postVar('realname')));
        $password       = postVar('password');
        $repeatpassword = postVar('repeatpassword');
        $email          = strip_tags(postVar('email'));
        $url            = strip_tags(postVar('url'));

		# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
		# original eregi: !eregi("^https?://", $url)

		// begin if: sometimes user didn't prefix the URL with http:// or https://, this cause a malformed URL. Let's fix it.
		if (!preg_match('#^https?://#', $url) )
		{
			$url = 'http://' . $url;
		}

        $admin          = postVar('admin');
        $canlogin       = postVar('canlogin');
        $notes          = strip_tags(postVar('notes'));
        $deflang        = postVar('deflang');

        $mem = MEMBER::createFromID($memberid);

        if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {

            if (!isValidDisplayName($name))
                $this->error(_ERROR_BADNAME);

            if (($name != $mem->getDisplayName()) && MEMBER::exists($name))
                $this->error(_ERROR_NICKNAMEINUSE);

            if ($password != $repeatpassword)
                $this->error(_ERROR_PASSWORDMISMATCH);

            if ($password && (strlen($password) < 6))
                $this->error(_ERROR_PASSWORDTOOSHORT);
                
            if ($password) {
				$pwdvalid = true;
				$pwderror = '';
				$data = array('password' => $password, 'errormessage' => &$pwderror, 'valid' => &$pwdvalid);
				$manager->notify('PrePasswordSet', $data);
				if (!$pwdvalid) {
					$this->error($pwderror);
				}
			}
        }

        if (!isValidMailAddress($email))
            $this->error(_ERROR_BADMAILADDRESS);


        if (!$realname)
            $this->error(_ERROR_REALNAMEMISSING);

        if (($deflang != '') && (!checkLanguage($deflang)))
            $this->error(_ERROR_NOSUCHLANGUAGE);

        // check if there will remain at least one site member with both the logon and admin rights
        // (check occurs when taking away one of these rights from such a member)
        if (    (!$admin && $mem->isAdmin() && $mem->canLogin())
             || (!$canlogin && $mem->isAdmin() && $mem->canLogin())
           )
        {
            $r = sql_query('SELECT * FROM '.sql_table('member').' WHERE madmin=1 and mcanlogin=1');
            if (sql_num_rows($r) < 2)
                $this->error(_ERROR_ATLEASTONEADMIN);
        }

        if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {
            $mem->setDisplayName($name);
            if ($password)
                $mem->setPassword($password);
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
        }

        $autosave = postVar ('autosave');
        $mem->setAutosave($autosave);

        $mem->write();

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $data = array('context' => 'member', 'memberid' => $memberid, 'member' => &$mem);
        $manager->notify('PostPluginOptionsUpdate', $data);

        // if email changed, generate new password
        if ($oldEmail != $mem->getEmail())
        {
            $mem->sendActivationLink('addresschange', $oldEmail);
            // logout member
            $mem->newCookieKey();

            // only log out if the member being edited is the current member.
            if ($member->getID() == $memberid)
                $member->logout();
            $this->action_login(_MSG_ACTIVATION_SENT, 0);
            return;
        }


        if (  ( $mem->getID() == $member->getID() )
           && ( $mem->getDisplayName() != $member->getDisplayName() )
           ) {
            $mem->newCookieKey();
            $member->logout();
            $this->action_login(_MSG_LOGINAGAIN, 0);
        } else {
            $this->action_overview(_MSG_SETTINGSCHANGED);
        }
    }

    /**
     * @todo document this
     */
    function action_memberadd() {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        if (postVar('password') != postVar('repeatpassword'))
            $this->error(_ERROR_PASSWORDMISMATCH);
        if (strlen(postVar('password')) < 6)
            $this->error(_ERROR_PASSWORDTOOSHORT);

        $res = MEMBER::create(postVar('name'), postVar('realname'), postVar('password'), postVar('email'), postVar('url'), postVar('admin'), postVar('canlogin'), postVar('notes'));
        if ($res != 1)
            $this->error($res);

        // fire PostRegister event
        $newmem = new MEMBER();
        $newmem->readFromName(postVar('name'));
        $data = array('member' => &$newmem);
        $manager->notify('PostRegister', $data);

        $this->action_usermanagement();
    }

    /**
     * Account activation
     *
     * @author dekarma
     */
    function action_activate() {

        $key = getVar('key');
        $this->_showActivationPage($key);
    }

    /**
     * @todo document this
     */
    function _showActivationPage($key, $message = '')
    {
        global $manager;

        // clean up old activation keys
        MEMBER::cleanupActivationTable();

        // get activation info
        $info = MEMBER::getActivationInfo($key);

        if (!$info)
            $this->error(_ERROR_ACTIVATE);

        $mem = MEMBER::createFromId($info->vmember);

        if (!$mem)
            $this->error(_ERROR_ACTIVATE);

        $text = '';
        $title = '';
        $bNeedsPasswordChange = true;

        switch ($info->vtype)
        {
            case 'forgot':
                $title = _ACTIVATE_FORGOT_TITLE;
                $text = _ACTIVATE_FORGOT_TEXT;
                break;
            case 'register':
                $title = _ACTIVATE_REGISTER_TITLE;
                $text = _ACTIVATE_REGISTER_TEXT;
                break;
            case 'addresschange':
                $title = _ACTIVATE_CHANGE_TITLE;
                $text = _ACTIVATE_CHANGE_TEXT;
                $bNeedsPasswordChange = false;
                MEMBER::activate($key);
                break;
        }

        $aVars = array(
            'memberName' => hsc($mem->getDisplayName())
        );
        $title = TEMPLATE::fill($title, $aVars);
        $text = TEMPLATE::fill($text, $aVars);

        $this->pagehead();

            echo '<h2>' , $title, '</h2>';
            echo '<p>' , $text, '</p>';

            if ($message != '')
            {
                echo '<p class="error">',$message,'</p>';
            }

            if ($bNeedsPasswordChange)
            {
                ?>
                    <div><form action="index.php" method="post">

                        <input type="hidden" name="action" value="activatesetpwd" />
                        <?php $manager->addTicketHidden() ?>
                        <input type="hidden" name="key" value="<?php echo hsc($key) ?>" />

                        <table><tr>
                            <td><?php echo _MEMBERS_PWD?></td>
                            <td><input type="password" maxlength="40" size="16" name="password" /></td>
                        </tr><tr>
                            <td><?php echo _MEMBERS_REPPWD?></td>
                            <td><input type="password" maxlength="40" size="16" name="repeatpassword" /></td>
                        <?php

                            global $manager;
                            $data = array('type' => 'activation', 'member' => $mem);
                            $manager->notify('FormExtra', $data);

                        ?>
                        </tr><tr>
                            <td><?php echo _MEMBERS_SETPWD ?></td>
                            <td><input type='submit' value='<?php echo _MEMBERS_SETPWD_BTN ?>' /></td>
                        </tr></table>


                    </form></div>

                <?php

            }

        $this->pagefoot();

    }

    /**
     * Account activation - set password part
     *
     * @author dekarma
     */
    function action_activatesetpwd() {

        $key = postVar('key');

        // clean up old activation keys
        MEMBER::cleanupActivationTable();

        // get activation info
        $info = MEMBER::getActivationInfo($key);

        if (!$info || ($info->type == 'addresschange'))
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);

        $mem = MEMBER::createFromId($info->vmember);

        if (!$mem)
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);

        $password       = postVar('password');
        $repeatpassword = postVar('repeatpassword');

        if ($password != $repeatpassword)
            return $this->_showActivationPage($key, _ERROR_PASSWORDMISMATCH);

        if ($password && (strlen($password) < 6))
            return $this->_showActivationPage($key, _ERROR_PASSWORDTOOSHORT);
            
        if ($password) {
			$pwdvalid = true;
			$pwderror = '';
			global $manager;
			$data = array('password' => $password, 'errormessage' => &$pwderror, 'valid' => &$pwdvalid);
			$manager->notify('PrePasswordSet', $data);
			if (!$pwdvalid) {
				return $this->_showActivationPage($key,$pwderror);
			}
		}

        $error = '';
        $data = array('type' => 'activation', 'member' => $mem, 'error' => &$error);
        $manager->notify('ValidateForm', $data);
        if ($error != '')
            return $this->_showActivationPage($key, $error);


        // set password
        $mem->setPassword($password);
        $mem->write();

        // do the activation
        MEMBER::activate($key);

        $this->pagehead();
            echo '<h2>',_ACTIVATE_SUCCESS_TITLE,'</h2>';
            echo '<p>',_ACTIVATE_SUCCESS_TEXT,'</p>';
        $this->pagefoot();
    }

    /**
     * Manage team
     */
    function action_manageteam() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $this->pagehead();

        echo "<p><a href='index.php?action=blogsettings&amp;blogid=$blogid'>(",_BACK_TO_BLOGSETTINGS,")</a></p>";

        echo '<h2>' . _TEAM_TITLE . getBlogNameFromID($blogid) . '</h2>';

        echo '<h3>' . _TEAM_CURRENT . '</h3>';



        $query =  'SELECT tblog, tmember, mname, mrealname, memail, tadmin'
               . ' FROM '.sql_table('member').', '.sql_table('team')
               . ' WHERE tmember=mnumber and tblog=' . $blogid;

        $template['content'] = 'teamlist';
        $template['tabindex'] = 10;

        $manager->loadClass("ENCAPSULATE");
        $batch = new BATCH('team');
        $batch->showlist($query, 'table', $template);

        ?>
            <h3><?php echo _TEAM_ADDNEW?></h3>

            <form method='post' action='index.php'><div>

            <input type='hidden' name='action' value='teamaddmember' />
            <input type='hidden' name='blogid' value='<?php echo  $blogid; ?>' />
            <?php $manager->addTicketHidden() ?>

            <table><tr>
                <td><?php echo _TEAM_CHOOSEMEMBER?></td>
                <td><?php                   // TODO: try to make it so only non-team-members are listed
                    // From https://github.com/Lord-Matt-NucleusCMS-Stuff/lmnucleuscms/commit/3b4e236449a2212ff2440f8654197a9c01667166#diff-34cb57d57a38d46e6406db82a324c224R2337
                    $query = "SELECT mname as text, mnumber as value FROM %s WHERE mnumber NOT IN (SELECT tmember FROM %s WHERE tblog='%s')";
                    $query = sprintf($query, sql_table('member'),sql_table('team'),$blogid);

                    $template['name'] = 'memberid';
                    $template['tabindex'] = 10000;
                    showlist($query,'select',$template);
                ?></td>
            </tr><tr>
                <td><?php echo _TEAM_ADMIN?><?php help('teamadmin'); ?></td>
                <td><?php $this->input_yesno('admin',0,10020); ?></td>
            </tr><tr>
                <td><?php echo _TEAM_ADD?></td>
                <td><input type='submit' value='<?php echo _TEAM_ADD_BTN?>' tabindex="10030" /></td>
            </tr></table>

            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * Add member to team
     */
    function action_teamaddmember() {
        global $member, $manager;

        $memberid = intPostVar('memberid');
        $blogid = intPostVar('blogid');
        $admin = intPostVar('admin');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);
        if (!$blog->addTeamMember($memberid, $admin))
            $this->error(_ERROR_ALREADYONTEAM);

        $this->action_manageteam();

    }

    /**
     * @todo document this
     */
    function action_teamdelete() {
        global $member, $manager;

        $memberid = intRequestVar('memberid');
        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $teammem = MEMBER::createFromID($memberid);
        $blog =& $manager->getBlog($blogid);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _CONFIRMTXT_TEAM1?><b><?php echo  hsc($teammem->getDisplayName()) ?></b><?php echo _CONFIRMTXT_TEAM2?><b><?php echo  hsc(strip_tags($blog->getName())) ?></b>
            </p>


            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="teamdeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
            <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_teamdeleteconfirm() {
        global $member;

        $memberid = intRequestVar('memberid');
        $blogid = intRequestVar('blogid');

        $error = $this->deleteOneTeamMember($blogid, $memberid);
        if ($error)
            $this->error($error);


        $this->action_manageteam();
    }

    /**
     * @todo document this
     */
    function deleteOneTeamMember($blogid, $memberid) {
        global $member, $manager;

        $blogid = intval($blogid);
        $memberid = intval($memberid);

        // check if allowed
        if (!$member->blogAdminRights($blogid))
            return _ERROR_DISALLOWED;

        // check if: - there remains at least one blog admin
        //           - (there remains at least one team member)
        $tmem = MEMBER::createFromID($memberid);

        $data = array('member' => &$tmem, 'blogid' => $blogid);
        $manager->notify('PreDeleteTeamMember', $data);

        if ($tmem->isBlogAdmin($blogid)) {
            // check if there are more blog members left and at least one admin
            // (check for at least two admins before deletion)
            $query = 'SELECT * FROM '.sql_table('team') . ' WHERE tblog='.$blogid.' and tadmin=1';
            $r = sql_query($query);
            if (sql_num_rows($r) < 2)
                return _ERROR_ATLEASTONEBLOGADMIN;
        }

        $query = 'DELETE FROM '.sql_table('team')." WHERE tblog=$blogid and tmember=$memberid";
        sql_query($query);

        $data = array('member' => &$tmem, 'blogid' => $blogid);
        $manager->notify('PostDeleteTeamMember', $data);

        return '';
    }

    /**
     * @todo document this
     */
    function action_teamchangeadmin() {
        global $member;

        $blogid = intRequestVar('blogid');
        $memberid = intRequestVar('memberid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $mem = MEMBER::createFromID($memberid);

        // don't allow when there is only one admin at this moment
        if ($mem->isBlogAdmin($blogid)) {
            $r = sql_query('SELECT * FROM '.sql_table('team') . " WHERE tblog=$blogid and tadmin=1");
            if (sql_num_rows($r) == 1)
                $this->error(_ERROR_ATLEASTONEBLOGADMIN);
        }

        if ($mem->isBlogAdmin($blogid))
            $newval = 0;
        else
            $newval = 1;

        $query = 'UPDATE '.sql_table('team') ." SET tadmin=$newval WHERE tblog=$blogid and tmember=$memberid";
        sql_query($query);

        // only show manageteam if member did not change its own admin privileges
        if ($member->isBlogAdmin($blogid))
            $this->action_manageteam();
        else
            $this->action_overview(_MSG_ADMINCHANGED);
    }

    /**
     * @todo document this
     */
    function action_blogsettings() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
        ?>
        <h2><?php echo _EBLOG_TITLE?>: '<?php echo $this->bloglink($blog)?>'</h2>

        <h3><?php echo _EBLOG_TEAM_TITLE?></h3>

        <p><?php echo _EBLOG_CURRENT_TEAM_MEMBER; ?>
        <?php
            $res = sql_query('SELECT mname, mrealname FROM ' . sql_table('member') . ',' . sql_table('team') . ' WHERE mnumber=tmember AND tblog=' . intval($blogid));
            $aMemberNames = array();
            while ($o = sql_fetch_object($res))
                array_push($aMemberNames, hsc($o->mname) . ' (' . hsc($o->mrealname). ')');
            echo implode(',', $aMemberNames);
        ?>
        </p>



        <p>
        <a href="index.php?action=manageteam&amp;blogid=<?php echo $blogid?>"><?php echo _EBLOG_TEAM_TEXT?></a>
        </p>

        <h3><?php echo _EBLOG_SETTINGS_TITLE?></h3>

        <form method="post" action="index.php"><div>

        <input type="hidden" name="action" value="blogsettingsupdate" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
        <table><tr>
            <td><?php echo _EBLOG_NAME?></td>
            <td><input name="name" tabindex="10" size="40" maxlength="60" value="<?php echo  hsc($blog->getName()) ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_SHORTNAME?> <?php help('shortblogname'); ?>
                <?php echo _EBLOG_SHORTNAME_EXTRA?>
            </td>
            <td><input name="shortname" tabindex="20" maxlength="15" size="15" value="<?php echo  hsc($blog->getShortName()) ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DESC?></td>
            <td><input name="desc" tabindex="30" maxlength="200" size="40" value="<?php echo  hsc($blog->getDescription()) ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_URL?></td>
            <td><input name="url" tabindex="40" size="40" maxlength="100" value="<?php echo  hsc($blog->getURL()) ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DEFSKIN?>
                <?php help('blogdefaultskin'); ?>
            </td>
            <td>
                <?php
                    $query =  'SELECT sdname as text, sdnumber as value'
                           . ' FROM '.sql_table('skin_desc');
                    $template['name'] = 'defskin';
                    $template['selected'] = $blog->getDefaultSkin();
                    $template['tabindex'] = 50;
                    showlist($query,'select',$template);
                ?>

            </td>
        </tr><tr>
            <td><?php echo _EBLOG_LINEBREAKS?> <?php help('convertbreaks'); ?>
            </td>
            <td><?php $this->input_yesno('convertbreaks',$blog->convertBreaks(),55); ?></td>
        </tr><tr>
            <td><?php echo _EBLOG_ALLOWPASTPOSTING?> <?php help('allowpastposting'); ?>
            </td>
            <td><?php $this->input_yesno('allowpastposting',$blog->allowPastPosting(),57); ?></td>
        </tr><tr>
            <td><?php echo _EBLOG_DISABLECOMMENTS?>
            </td>
            <td><?php $this->input_yesno('comments',$blog->commentsEnabled(),60); ?></td>
        </tr><tr>
            <td><?php echo _EBLOG_ANONYMOUS?>
            </td>
            <td><?php $this->input_yesno('public',$blog->isPublic(),70); ?></td>
        </tr><tr>
    <td><?php echo _EBLOG_REQUIREDEMAIL?>
         </td>
         <td><?php $this->input_yesno('reqemail',$blog->emailRequired(),72); ?></td>
      </tr><tr>
            <td><?php echo _EBLOG_NOTIFY?> <?php help('blognotify'); ?></td>
            <td><input name="notify" tabindex="80" maxlength="128" size="40" value="<?php echo  hsc($blog->getNotifyAddress()); ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_NOTIFY_ON?></td>
            <td>
                <input name="notifyComment" value="3" type="checkbox" tabindex="81" id="notifyComment"
                    <?php if  ($blog->notifyOnComment()) echo "checked='checked'" ?>
                /><label for="notifyComment"><?php echo _EBLOG_NOTIFY_COMMENT?></label>
                <br />
                <input name="notifyVote" value="5" type="checkbox" tabindex="82" id="notifyVote"
                    <?php if  ($blog->notifyOnVote()) echo "checked='checked'" ?>
                /><label for="notifyVote"><?php echo _EBLOG_NOTIFY_KARMA?></label>
                <br />
                <input name="notifyNewItem" value="7" type="checkbox" tabindex="83" id="notifyNewItem"
                    <?php if  ($blog->notifyOnNewItem()) echo "checked='checked'" ?>
                /><label for="notifyNewItem"><?php echo _EBLOG_NOTIFY_ITEM?></label>
            </td>
        </tr><tr>
            <td><?php echo _EBLOG_MAXCOMMENTS?> <?php help('blogmaxcomments'); ?></td>
            <td><input name="maxcomments" tabindex="90" size="3" value="<?php echo  hsc($blog->getMaxComments()); ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_UPDATE?> <?php help('blogupdatefile'); ?></td>
            <td><input name="update" tabindex="100" size="40" maxlength="60" value="<?php echo  hsc($blog->getUpdateFile()) ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DEFCAT?></td>
            <td>
                <?php
                    $query =  'SELECT cname as text, catid as value'
                           . ' FROM '.sql_table('category')
                           . ' WHERE cblog=' . $blog->getID();
                    $template['name'] = 'defcat';
                    $template['selected'] = $blog->getDefaultCategory();
                    $template['tabindex'] = 110;
                    showlist($query,'select',$template);
                ?>
            </td>
        </tr><tr>
            <td><?php echo _EBLOG_OFFSET?> <?php help('blogtimeoffset'); ?>
                <br /><?php echo _EBLOG_STIME?> <b><?php echo  strftime("%H:%M",time()); ?></b>
                <br /><?php echo _EBLOG_BTIME?> <b><?php echo  strftime("%H:%M",$blog->getCorrectTime()); ?></b>
                </td>
            <td><input name="timeoffset" tabindex="120" size="3" value="<?php echo  hsc($blog->getTimeOffset()); ?>" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_SEARCH?> <?php help('blogsearchable'); ?></td>
            <td><?php $this->input_yesno('searchable',$blog->getSearchable(),122); ?></td>
        </tr>
        <?php
            // plugin options
            $this->_insertPluginOptions('blog',$blogid);
        ?>
        <tr>
            <th colspan="2"><?php echo _EBLOG_CHANGE?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CHANGE?></td>
            <td><input type="submit" tabindex="130" value="<?php echo _EBLOG_CHANGE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div></form>

        <h3><?php echo _EBLOG_CAT_TITLE?></h3>


        <?php
        $query = 'SELECT * FROM '.sql_table('category').' WHERE cblog='.$blog->getID().' ORDER BY cname';
        $template['content'] = 'categorylist';
        $template['tabindex'] = 200;

        $manager->loadClass("ENCAPSULATE");
        $batch = new BATCH('category');
        $batch->showlist($query,'table',$template);

        ?>


        <form action="index.php" method="post"><div>
        <input name="action" value="categorynew" type="hidden" />
        <?php $manager->addTicketHidden() ?>
        <input name="blogid" value="<?php echo $blog->getID()?>" type="hidden" />

        <table><tr>
            <th colspan="2"><?php echo _EBLOG_CAT_CREATE?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_NAME?></td>
            <td><input name="cname" size="40" maxlength="40" tabindex="300" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_DESC?></td>
            <td><input name="cdesc" size="40" maxlength="200" tabindex="310" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_CREATE?></td>
            <td><input type="submit" value="<?php echo _EBLOG_CAT_CREATE?>" tabindex="320" /></td>
        </tr></table>

        </div></form>

        <?php

            echo '<h3>',_PLUGINS_EXTRA,'</h3>';

            $data = array('blog' => &$blog);
            $manager->notify('BlogSettingsFormExtras', $data);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_categorynew() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $cname = postVar('cname');
        $cdesc = postVar('cdesc');

        if (!isValidCategoryName($cname))
            $this->error(_ERROR_BADCATEGORYNAME);

        $query = 'SELECT * FROM '.sql_table('category') . ' WHERE cname=\'' . sql_real_escape_string($cname).'\' and cblog=' . intval($blogid);
        $res = sql_query($query);
        if (sql_num_rows($res) > 0)
            $this->error(_ERROR_DUPCATEGORYNAME);

        $blog       =& $manager->getBlog($blogid);
        $newCatID   =  $blog->createNewCategory($cname, $cdesc);

        $this->action_blogsettings();
    }

    /**
     * @todo document this
     */
    function action_categoryedit($catid = '', $blogid = '', $desturl = '') {
        global $member, $manager;

        if ($blogid == '')
            $blogid = intGetVar('blogid');
        else
            $blogid = intval($blogid);
        if ($catid == '')
            $catid = intGetVar('catid');
        else
            $catid = intval($catid);

        $member->blogAdminRights($blogid) or $this->disallow();

        $res = sql_query('SELECT * FROM '.sql_table('category')." WHERE cblog=$blogid AND catid=$catid");
        $obj = sql_fetch_object($res);

        $cname = $obj->cname;
        $cdesc = $obj->cdesc;

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        echo "<p><a href='index.php?action=blogsettings&amp;blogid=$blogid'>(",_BACK_TO_BLOGSETTINGS,")</a></p>";

        ?>
        <h2><?php echo _EBLOG_CAT_UPDATE?> '<?php echo hsc($cname)?>'</h2>
        <form method='post' action='index.php'><div>
        <input name="blogid" type="hidden" value="<?php echo $blogid?>" />
        <input name="catid" type="hidden" value="<?php echo $catid?>" />
        <input name="desturl" type="hidden" value="<?php echo hsc($desturl) ?>" />
        <input name="action" type="hidden" value="categoryupdate" />
        <?php $manager->addTicketHidden(); ?>

        <table><tr>
            <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_NAME?></td>
            <td><input type="text" name="cname" value="<?php echo hsc($cname)?>" size="40" maxlength="40" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_DESC?></td>
            <td><input type="text" name="cdesc" value="<?php echo hsc($cdesc)?>" size="40" maxlength="200" /></td>
        </tr>
        <?php
            // insert plugin options
            $this->_insertPluginOptions('category',$catid);
        ?>
        <tr>
            <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_UPDATE?></td>
            <td><input type="submit" value="<?php echo _EBLOG_CAT_UPDATE_BTN?>" /></td>
        </tr></table>

        </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_categoryupdate() {
        global $member, $manager;

        $blogid = intPostVar('blogid');
        $catid = intPostVar('catid');
        $cname = postVar('cname');
        $cdesc = postVar('cdesc');
        $desturl = postVar('desturl');

        $member->blogAdminRights($blogid) or $this->disallow();

        if (!isValidCategoryName($cname))
            $this->error(_ERROR_BADCATEGORYNAME);

        $query = 'SELECT * FROM '.sql_table('category').' WHERE cname=\'' . sql_real_escape_string($cname).'\' and cblog=' . intval($blogid) . " and not(catid=$catid)";
        $res = sql_query($query);
        if (sql_num_rows($res) > 0)
            $this->error(_ERROR_DUPCATEGORYNAME);

        $query =  'UPDATE '.sql_table('category').' SET'
               . " cname='" . sql_real_escape_string($cname) . "',"
               . " cdesc='" . sql_real_escape_string($cdesc) . "'"
               . " WHERE catid=" . $catid;

        sql_query($query);

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $data = array('context' => 'category', 'catid' => $catid);
        $manager->notify('PostPluginOptionsUpdate', $data);


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
    function action_categorydelete() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');
        $catid = intRequestVar('catid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);

        // check if the category is valid
        if (!$blog->isValidCategory($catid))
            $this->error(_ERROR_NOSUCHCATEGORY);

        // don't allow deletion of default category
        if ($blog->getDefaultCategory() == $catid)
            $this->error(_ERROR_DELETEDEFCATEGORY);

        // check if catid is the only category left for blogid
        $query = 'SELECT catid FROM '.sql_table('category').' WHERE cblog=' . $blogid;
        $res = sql_query($query);
        if (sql_num_rows($res) == 1)
            $this->error(_ERROR_DELETELASTCATEGORY);


        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <div>
            <?php echo _CONFIRMTXT_CATEGORY?><b><?php echo  hsc($blog->getCategoryName($catid))?></b>
            </div>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="categorydeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo $blogid?>" />
            <input type="hidden" name="catid" value="<?php echo $catid?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_categorydeleteconfirm() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');
        $catid = intRequestVar('catid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $error = $this->deleteOneCategory($catid);
        if ($error)
            $this->error($error);

        $this->action_blogsettings();
    }

    /**
     * @todo document this
     */
    function deleteOneCategory($catid) {
        global $manager, $member;

        $catid = intval($catid);

        $blogid = getBlogIDFromCatID($catid);

        if (!$member->blogAdminRights($blogid))
            return ERROR_DISALLOWED;

        // get blog
        $blog =& $manager->getBlog($blogid);

        // check if the category is valid
        if (!$blog || !$blog->isValidCategory($catid))
            return _ERROR_NOSUCHCATEGORY;

        $destcatid = $blog->getDefaultCategory();

        // don't allow deletion of default category
        if ($blog->getDefaultCategory() == $catid)
            return _ERROR_DELETEDEFCATEGORY;

        // check if catid is the only category left for blogid
        $query = 'SELECT catid FROM '.sql_table('category').' WHERE cblog=' . $blogid;
        $res = sql_query($query);
        if (sql_num_rows($res) == 1)
            return _ERROR_DELETELASTCATEGORY;

        $data = array('catid' => $catid);
        $manager->notify('PreDeleteCategory', $data);

        // change category for all items to the default category
        $query = 'UPDATE '.sql_table('item')." SET icat=$destcatid WHERE icat=$catid";
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('category', $catid);

        // delete category
        $query = 'DELETE FROM '.sql_table('category').' WHERE catid=' .$catid;
        sql_query($query);

        $data = array('catid' => $catid);
        $manager->notify('PostDeleteCategory', $data);

    }

    /**
     * @todo document this
     */
    function moveOneCategory($catid, $destblogid) {
        global $manager, $member;

        $catid = intval($catid);
        $destblogid = intval($destblogid);

        $blogid = getBlogIDFromCatID($catid);

        // mover should have admin rights on both blogs
        if (!$member->blogAdminRights($blogid))
            return _ERROR_DISALLOWED;
        if (!$member->blogAdminRights($destblogid))
            return _ERROR_DISALLOWED;

        // cannot move to self
        if ($blogid == $destblogid)
            return _ERROR_MOVETOSELF;

        // get blogs
        $blog =& $manager->getBlog($blogid);
        $destblog =& $manager->getBlog($destblogid);

        // check if the category is valid
        if (!$blog || !$blog->isValidCategory($catid))
            return _ERROR_NOSUCHCATEGORY;

        // don't allow default category to be moved
        if ($blog->getDefaultCategory() == $catid)
            return _ERROR_MOVEDEFCATEGORY;

        $data = array(
            'catid' => &$catid,
            'sourceblog' => &$blog,
            'destblog' => &$destblog
        );
        $manager->notify('PreMoveCategory', $data);

        // update comments table (cblog)
        $query = 'SELECT inumber FROM '.sql_table('item').' WHERE icat='.$catid;
        $items = sql_query($query);
        while ($oItem = sql_fetch_object($items)) {
            sql_query('UPDATE '.sql_table('comment').' SET cblog='.$destblogid.' WHERE citem='.$oItem->inumber);
        }

        // update items (iblog)
        $query = 'UPDATE '.sql_table('item').' SET iblog='.$destblogid.' WHERE icat='.$catid;
        sql_query($query);

        // move category
        $query = 'UPDATE '.sql_table('category').' SET cblog='.$destblogid.' WHERE catid='.$catid;
        sql_query($query);

        $data = array(
            'catid' => &$catid,
            'sourceblog' => &$blog,
            'destblog' => $destblog
        );
        $manager->notify('PostMoveCategory', $data);

    }

    /**
     * @todo document this
     */
    function action_blogsettingsupdate() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);

        $notify         = trim(postVar('notify'));
        $shortname      = trim(postVar('shortname'));
        $updatefile     = trim(postVar('update'));

        $notifyComment  = intPostVar('notifyComment');
        $notifyVote     = intPostVar('notifyVote');
        $notifyNewItem  = intPostVar('notifyNewItem');

        if ($notifyComment == 0)    $notifyComment = 1;
        if ($notifyVote == 0)       $notifyVote = 1;
        if ($notifyNewItem == 0)    $notifyNewItem = 1;

        $notifyType = $notifyComment * $notifyVote * $notifyNewItem;


        if ($notify) {
            $not = new NOTIFICATION($notify);
            if (!$not->validAddresses())
                $this->error(_ERROR_BADNOTIFY);

        }

        if (!isValidShortName($shortname))
            $this->error(_ERROR_BADSHORTBLOGNAME);

        if (($blog->getShortName() != $shortname) && $manager->existsBlog($shortname))
            $this->error(_ERROR_DUPSHORTBLOGNAME);

        // check if update file is writable
        if ($updatefile && !is_writeable($updatefile))
            $this->error(_ERROR_UPDATEFILE);

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

        $blog->writeSettings();

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $data = array('context' => 'blog', 'blogid' => $blogid, 'blog' => &$blog);
        $manager->notify('PostPluginOptionsUpdate', $data);


        $this->action_overview(_MSG_SETTINGSCHANGED);
    }

    /**
     * @todo document this
     */
    function action_deleteblog() {
        global $member, $CONF, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        // check if blog is default blog
        if ($CONF['DefaultBlog'] == $blogid)
            $this->error(_ERROR_DELDEFBLOG);

        $blog =& $manager->getBlog($blogid);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _WARNINGTXT_BLOGDEL?>
            </p>

            <div>
            <?php echo _CONFIRMTXT_BLOG?><b><?php echo  hsc($blog->getName())?></b>
            </div>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="deleteblogconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_deleteblogconfirm() {
        global $member, $CONF, $manager;

        $blogid = intRequestVar('blogid');

        $data = array('blogid' => $blogid);
        $manager->notify('PreDeleteBlog', $data);

        $member->blogAdminRights($blogid) or $this->disallow();

        // check if blog is default blog
        if ($CONF['DefaultBlog'] == $blogid)
            $this->error(_ERROR_DELDEFBLOG);

        // delete all comments
        $query = 'DELETE FROM '.sql_table('comment').' WHERE cblog='.$blogid;
        sql_query($query);

        // delete all items
        $query = 'DELETE FROM '.sql_table('item').' WHERE iblog='.$blogid;
        sql_query($query);

        // delete all team members
        $query = 'DELETE FROM '.sql_table('team').' WHERE tblog='.$blogid;
        sql_query($query);

        // delete all bans
        $query = 'DELETE FROM '.sql_table('ban').' WHERE blogid='.$blogid;
        sql_query($query);

        // delete all categories
        $query = 'DELETE FROM '.sql_table('category').' WHERE cblog='.$blogid;
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('blog', $blogid);

        // delete the blog itself
        $query = 'DELETE FROM '.sql_table('blog').' WHERE bnumber='.$blogid;
        sql_query($query);

        $data = array('blogid' => $blogid);
        $manager->notify('PostDeleteBlog', $data);

        $this->action_overview(_DELETED_BLOG);
    }

    /**
     * @todo document this
     */
    function action_memberdelete() {
        global $member, $manager;

        $memberid = intRequestVar('memberid');

        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $mem = MEMBER::createFromID($memberid);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _CONFIRMTXT_MEMBER?><b><?php echo hsc($mem->getDisplayName()) ?></b>
            </p>

            <p>
            <?php echo _WARNINGTXT_NOTDELMEDIAFILES ?>
            </p>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="memberdeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_memberdeleteconfirm() {
        global $member;

        $memberid = intRequestVar('memberid');

        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $error = $this->deleteOneMember($memberid);
        if ($error)
            $this->error($error);

        if ($member->isAdmin())
            $this->action_usermanagement();
        else
            $this->action_overview(_DELETED_MEMBER);
    }

    /**
     * @static
     * @todo document this
     */
    function deleteOneMember($memberid) {
        global $manager;

        $memberid = intval($memberid);
        $mem = MEMBER::createFromID($memberid);

        if (!$mem->canBeDeleted())
            return _ERROR_DELETEMEMBER;

        $data = array('member' => &$mem);
        $manager->notify('PreDeleteMember', $data);

        /* unlink comments from memberid */
        if ($memberid) {
            $query = 'UPDATE ' . sql_table('comment') . ' SET cmember="0", cuser="'. sql_real_escape_string($mem->getDisplayName())
                        .'" WHERE cmember='.$memberid;
            sql_query($query);
        }

        $query = 'DELETE FROM '.sql_table('member').' WHERE mnumber='.$memberid;
        sql_query($query);

        $query = 'DELETE FROM '.sql_table('team').' WHERE tmember='.$memberid;
        sql_query($query);

        $query = 'DELETE FROM '.sql_table('activation').' WHERE vmember='.$memberid;
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('member', $memberid);

        $data = array('member' => &$mem);
        $manager->notify('PostDeleteMember', $data);

        return '';
    }

    /**
     * @todo document this
     */
    function action_createnewlog() {
        global $member, $CONF, $manager;

        // Only Super-Admins can do this
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
        ?>
        <h2><?php echo _EBLOG_CREATE_TITLE?></h2>

        <h3><?php echo _ADMIN_NOTABILIA ?></h3>

        <p><?php echo _ADMIN_PLEASE_READ ?></p>

        <p><?php echo _ADMIN_HOW_TO_ACCESS ?></p>

        <ol>
            <li><?php echo _ADMIN_SIMPLE_WAY ?></li>
            <li><?php echo _ADMIN_ADVANCED_WAY ?></li>
        </ol>

        <h3><?php echo _ADMIN_HOW_TO_CREATE ?></h3>

        <p>
        <?php echo _EBLOG_CREATE_TEXT?>
        </p>

        <form method="post" action="index.php"><div>

        <input type="hidden" name="action" value="addnewlog" />
        <?php $manager->addTicketHidden() ?>


        <table><tr>
            <td><?php echo _EBLOG_NAME?></td>
            <td><input name="name" tabindex="10" size="40" maxlength="60" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_SHORTNAME?>
                <?php help('shortblogname'); ?>
            </td>
            <td><input name="shortname" tabindex="20" maxlength="15" size="15" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DESC?></td>
            <td><input name="desc" tabindex="30" maxlength="200" size="40" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DEFSKIN?>
                <?php help('blogdefaultskin'); ?>
            </td>
            <td>
                <?php
                    $query =  'SELECT sdname as text, sdnumber as value'
                           . ' FROM '.sql_table('skin_desc');
                    $template['name'] = 'defskin';
                    $template['tabindex'] = 50;
                    $template['selected'] = $CONF['BaseSkin'];  // set default selected skin to be globally defined base skin
                    showlist($query,'select',$template);
                ?>
            </td>
        </tr><tr>
            <td><?php echo _EBLOG_OFFSET?>
                <?php help('blogtimeoffset'); ?>
                <br /><?php echo _EBLOG_STIME?> <b><?php echo  strftime("%H:%M",time()); ?></b>
            </td>
            <td><input name="timeoffset" tabindex="110" size="3" value="0" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_ADMIN?>
                <?php help('teamadmin'); ?>
            </td>
            <td><?php echo _EBLOG_ADMIN_MSG?></td>
        </tr><tr>
            <td><?php echo _EBLOG_CREATE?></td>
            <td><input type="submit" tabindex="120" value="<?php echo _EBLOG_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_addnewlog() {
        global $member, $manager, $CONF;

        // Only Super-Admins can do this
        $member->isAdmin() or $this->disallow();

        $bname          = trim(postVar('name'));
        $bshortname     = trim(postVar('shortname'));
        $btimeoffset    = postVar('timeoffset');
        $bdesc          = trim(postVar('desc'));
        $bdefskin       = postVar('defskin');

        if (!isValidShortName($bshortname))
            $this->error(_ERROR_BADSHORTBLOGNAME);

        if ($manager->existsBlog($bshortname))
            $this->error(_ERROR_DUPSHORTBLOGNAME);

		$data = array(
			'name'			=> &$bname,
			'shortname'		=> &$bshortname,
			'timeoffset'	=> &$btimeoffset,
			'description'	=> &$bdesc,
			'defaultskin'	=> &$bdefskin
		);
		$manager->notify('PreAddBlog', $data);


        // add slashes for sql queries
        $bname =        sql_real_escape_string($bname);
        $bshortname =   sql_real_escape_string($bshortname);
        $btimeoffset =  sql_real_escape_string($btimeoffset);
        $bdesc =        sql_real_escape_string($bdesc);
        $bdefskin =     sql_real_escape_string($bdefskin);

        // create blog
        $query = 'INSERT INTO '.sql_table('blog')." (bname, bshortname, bdesc, btimeoffset, bdefskin) VALUES ('$bname', '$bshortname', '$bdesc', '$btimeoffset', '$bdefskin')";
        sql_query($query);
        $blogid = sql_insert_id();
        $blog   =& $manager->getBlog($blogid);

        // create new category
        $catdefname = (defined('_EBLOGDEFAULTCATEGORY_NAME') ? _EBLOGDEFAULTCATEGORY_NAME : 'General');
        $catdefdesc = (defined('_EBLOGDEFAULTCATEGORY_DESC') ? _EBLOGDEFAULTCATEGORY_DESC : 'Items that do not fit in other categories');
        $sql = 'INSERT INTO %s (cblog, cname, cdesc) VALUES (%d, "%s", "%s")';
        sql_query(sprintf($sql, sql_table('category'), $blogid, $catdefname, $catdefdesc));
//		sql_query(sprintf($sql, sql_table('category'), $blogid, _EBLOGDEFAULTCATEGORY_NAME, _EBLOGDEFAULTCATEGORY_DESC));
//		sql_query('INSERT INTO '.sql_table('category')." (cblog, cname, cdesc) VALUES ($blogid, _EBLOGDEFAULTCATEGORY_NAME, _EBLOGDEFAULTCATEGORY_DESC)");
        $catid = sql_insert_id();

        // set as default category
        $blog->setDefaultCategory($catid);
        $blog->writeSettings();

        // create team member
        $memberid = $member->getID();
        $query = 'INSERT INTO '.sql_table('team')." (tmember, tblog, tadmin) VALUES ($memberid, $blogid, 1)";
        sql_query($query);

        $itemdeftitle = (defined('_EBLOG_FIRSTITEM_TITLE') ? _EBLOG_FIRSTITEM_TITLE : 'First Item');
        $itemdefbody = (defined('_EBLOG_FIRSTITEM_BODY') ? _EBLOG_FIRSTITEM_BODY : 'This is the first item in your weblog. Feel free to delete it.');

        $blog->additem($blog->getDefaultCategory(),$itemdeftitle,$itemdefbody,'',$blogid, $memberid,$blog->getCorrectTime(),0,0,0);
        //$blog->additem($blog->getDefaultCategory(),_EBLOG_FIRSTITEM_TITLE,_EBLOG_FIRSTITEM_BODY,'',$blogid, $memberid,$blog->getCorrectTime(),0,0,0);

		$data = array(
			'blog' => &$blog
		);
		$manager->notify('PostAddBlog', $data);
		
		$data = array(
			'blog'			=> &$blog,
			'name'			=> _EBLOGDEFAULTCATEGORY_NAME,
			'description'	=> _EBLOGDEFAULTCATEGORY_DESC,
			'catid'			=> $catid
		);
		$manager->notify('PostAddCategory', $data);

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

$CONF['Self'] = '<b><?php echo hsc($bshortname)?>.php</b>';

include('<i>./config.php</i>');

selectBlog('<b><?php echo hsc($bshortname)?></b>');
selector();

?&gt;</code></pre>

        <p><?php echo _BLOGCREATED_SIMPLEDESC3 ?></p>

        <p><?php echo _BLOGCREATED_SIMPLEDESC4 ?></p>

        <form action="index.php" method="post"><div>
            <input type="hidden" name="action" value="addnewlog2" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo intval($blogid)?>" />
            <table><tr>
                <td><?php echo _EBLOG_URL?></td>
                <td><input name="url" maxlength="100" size="40" value="<?php echo hsc($CONF['IndexURL'].$bshortname.'.php')?>" /></td>
            </tr><tr>
                <td><?php echo _EBLOG_CREATE?></td>
                <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
            </tr></table>
        </div></form>

        <h3><a id="skins"><?php echo _BLOGCREATED_ADVANCEDWAY2 ?></a></h3>

        <p><?php echo _BLOGCREATED_ADVANCEDWAY3 ?></p>

        <form action="index.php" method="post"><div>
            <input type="hidden" name="action" value="addnewlog2" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo intval($blogid)?>" />
            <table><tr>
                <td><?php echo _EBLOG_URL?></td>
                <td><input name="url" maxlength="100" size="40" /></td>
            </tr><tr>
                <td><?php echo _EBLOG_CREATE?></td>
                <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
            </tr></table>
        </div></form>

        <?php       $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_addnewlog2() {
        global $member, $manager;

        $member->blogAdminRights($blogid) or $this->disallow();

        $burl   = requestVar('url');
        $blogid = intRequestVar('blogid');

        $blog =& $manager->getBlog($blogid);
        $blog->setURL(trim($burl));
        $blog->writeSettings();

        $this->action_overview(_MSG_NEWBLOG);
    }

    /**
     * @todo document this
     */
    function action_skinieoverview() {
        global $member, $DIR_LIBS, $manager;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

    ?>
        <h2><?php echo _SKINIE_TITLE_IMPORT?></h2>

                <p><label for="skinie_import_local"><?php echo _SKINIE_LOCAL?></label>
                <?php                   global $DIR_SKINS;

                    $candidates = SKINIMPORT::searchForCandidates($DIR_SKINS);

                    if (sizeof($candidates) > 0) {
                        ?>
                            <form method="post" action="index.php"><div>
                                <input type="hidden" name="action" value="skinieimport" />
                                <?php $manager->addTicketHidden() ?>
                                <input type="hidden" name="mode" value="file" />
                                <select name="skinfile" id="skinie_import_local">
                                <?php                                   foreach ($candidates as $skinname => $skinfile) {
                                        $html = hsc($skinfile);
                                        echo '<option value="',$html,'">',$skinname,'</option>';
                                    }
                                ?>
                                </select>
                                <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT?>" />
                            </div></form>
                        <?php                   } else {
                        echo _SKINIE_NOCANDIDATES;
                    }
                ?>
                </p>

                <p><em><?php echo _OR?></em></p>

                <form method="post" action="index.php"><p>
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="action" value="skinieimport" />
                    <input type="hidden" name="mode" value="url" />
                    <label for="skinie_import_url"><?php echo _SKINIE_FROMURL?></label>
                    <input type="text" name="skinfile" id="skinie_import_url" size="60" value="http://" />
                    <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT?>" />
                </p></form>


        <h2><?php echo _SKINIE_TITLE_EXPORT?></h2>
        <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="skinieexport" />
            <?php $manager->addTicketHidden() ?>

            <p><?php echo _SKINIE_EXPORT_INTRO?></p>

            <table><tr>
                <th colspan="2"><?php echo _SKINIE_EXPORT_SKINS?></th>
            </tr><tr>
    <?php       // show list of skins
        $res = sql_query('SELECT * FROM '.sql_table('skin_desc'));
        while ($skinObj = sql_fetch_object($res)) {
            $id = 'skinexp' . $skinObj->sdnumber;
            echo '<td><input type="checkbox" name="skin[',$skinObj->sdnumber,']"  id="',$id,'" />';
            echo '<label for="',$id,'">',hsc($skinObj->sdname),'</label></td>';
            echo '<td>',hsc($skinObj->sddesc),'</td>';
            echo '</tr><tr>';
        }

        echo '<th colspan="2">',_SKINIE_EXPORT_TEMPLATES,'</th></tr><tr>';

        // show list of templates
        $res = sql_query('SELECT * FROM '.sql_table('template_desc'));
        while ($templateObj = sql_fetch_object($res)) {
            $id = 'templateexp' . $templateObj->tdnumber;
            echo '<td><input type="checkbox" name="template[',$templateObj->tdnumber,']" id="',$id,'" />';
            echo '<label for="',$id,'">',hsc($templateObj->tdname),'</label></td>';
            echo '<td>',hsc($templateObj->tddesc),'</td>';
            echo '</tr><tr>';
        }

    ?>
                <th colspan="2"><?php echo _SKINIE_EXPORT_EXTRA?></th>
            </tr><tr>
                <td colspan="2"><textarea cols="40" rows="5" name="info"></textarea></td>
            </tr><tr>
                <th colspan="2"><?php echo _SKINIE_TITLE_EXPORT?></th>
            </tr><tr>
                <td colspan="2"><input type="submit" value="<?php echo _SKINIE_BTN_EXPORT?>" /></td>
            </tr></table>
        </div></form>

    <?php
        $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_skinieimport() {
        global $member, $DIR_LIBS, $DIR_SKINS, $manager;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $skinFileRaw= postVar('skinfile');
        $mode       = postVar('mode');

        $importer = new SKINIMPORT();

        // get full filename
        if ($mode == 'file')
        {
            $skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';

            // backwards compatibilty (in v2.0, exports were saved as skindata.xml)
            if (!file_exists($skinFile))
                $skinFile = $DIR_SKINS . $skinFileRaw . '/skindata.xml';
        } else {
            $skinFile = $skinFileRaw;
        }

        // read only metadata
        $error = $importer->readFile($skinFile, 1);

        // clashes
        $skinNameClashes = $importer->checkSkinNameClashes();
        $templateNameClashes = $importer->checkTemplateNameClashes();
        $hasNameClashes = (count($skinNameClashes) > 0) || (count($templateNameClashes) > 0);

        if ($error) $this->error($error);

        $this->pagehead();

        echo '<p><a href="index.php?action=skinieoverview">(',_BACK,')</a></p>';
        ?>
        <h2><?php echo _SKINIE_CONFIRM_TITLE?></h2>

        <ul>
            <li><p><strong><?php echo _SKINIE_INFO_GENERAL?></strong> <?php echo hsc($importer->getInfo())?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_SKINS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames())?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_TEMPLATES?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames())?></p></li>
            <?php
                if ($hasNameClashes)
                {
            ?>
            <li><p><strong style="color: red;"><?php echo _SKINIE_INFO_SKINCLASH?></strong> <?php echo implode(' <em>'._AND.'</em> ',$skinNameClashes)?></p></li>
            <li><p><strong style="color: red;"><?php echo _SKINIE_INFO_TEMPLCLASH?></strong> <?php echo implode(' <em>'._AND.'</em> ',$templateNameClashes)?></p></li>
            <?php
                } // if (hasNameClashes)
            ?>
        </ul>

        <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="skiniedoimport" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="skinfile" value="<?php echo hsc(postVar('skinfile'))?>" />
            <input type="hidden" name="mode" value="<?php echo hsc($mode)?>" />
            <input type="submit" value="<?php echo _SKINIE_CONFIRM_IMPORT?>" />
            <?php
                if ($hasNameClashes)
                {
            ?>
            <br />
            <input type="checkbox" name="overwrite" value="1" id="cb_overwrite" /><label for="cb_overwrite"><?php echo _SKINIE_CONFIRM_OVERWRITE?></label>
            <?php
                } // if (hasNameClashes)
            ?>
        </div></form>


        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skiniedoimport() {
        global $member, $DIR_LIBS, $DIR_SKINS;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $skinFileRaw= postVar('skinfile');
        $mode       = postVar('mode');

        $allowOverwrite = intPostVar('overwrite');

        // get full filename
        if ($mode == 'file')
        {
            $skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';

            // backwards compatibilty (in v2.0, exports were saved as skindata.xml)
            if (!file_exists($skinFile))
                $skinFile = $DIR_SKINS . $skinFileRaw . '/skindata.xml';

        } else {
            $skinFile = $skinFileRaw;
        }

        $importer = new SKINIMPORT();

        $error = $importer->readFile($skinFile);

        if ($error)
            $this->error($error);

        $error = $importer->writeToDatabase($allowOverwrite);

        if ($error)
            $this->error($error);

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
    ?>
        <h2><?php echo _SKINIE_DONE?></h2>

        <ul>
            <li><p><strong><?php echo _SKINIE_INFO_GENERAL?></strong> <?php echo hsc($importer->getInfo())?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_IMPORTEDSKINS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames())?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_IMPORTEDTEMPLS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames())?></p></li>
        </ul>

    <?php       $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_skinieexport() {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        // load skinie class
        include_once($DIR_LIBS . 'skinie.php');

        $aSkins = requestIntArray('skin');
        $aTemplates = requestIntArray('template');

        if (!is_array($aTemplates)) $aTemplates = array();
        if (!is_array($aSkins)) $aSkins = array();

        $skinList = array_keys($aSkins);
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
    function action_templateoverview() {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

        echo '<h2>' . _TEMPLATE_TITLE . '</h2>';
        echo '<h3>' . _TEMPLATE_AVAILABLE_TITLE . '</h3>';

        $query = 'SELECT * FROM '.sql_table('template_desc').' ORDER BY tdname';
        $template['content'] = 'templatelist';
        $template['tabindex'] = 10;
        showlist($query,'table',$template);

        echo '<h3>' . _TEMPLATE_NEW_TITLE . '</h3>';

        ?>
        <form method="post" action="index.php"><div>

        <input name="action" value="templatenew" type="hidden" />
        <?php $manager->addTicketHidden() ?>
        <table><tr>
            <td><?php echo _TEMPLATE_NAME?> <?php help('shortnames');?></td>
            <td><input name="name" tabindex="10010" maxlength="20" size="20" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_DESC?></td>
            <td><input name="desc" tabindex="10020" maxlength="200" size="50" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_CREATE?></td>
            <td><input type="submit" tabindex="10030" value="<?php echo _TEMPLATE_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div></form>

        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_templateedit($msg = '') {
        global $member, $manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        $extrahead = '<script type="text/javascript" src="javascript/templateEdit.js"></script>';
        $extrahead .= '<script type="text/javascript">setTemplateEditText("'.sql_real_escape_string(_EDITTEMPLATE_EMPTY).'");</script>';

        $this->pagehead($extrahead);

        $templatename = TEMPLATE::getNameFromId($templateid);
        $templatedescription = TEMPLATE::getDesc($templateid);
        $template =& $manager->getTemplate($templatename);

        ?>
        <p>
        <a href="index.php?action=templateoverview">(<?php echo _TEMPLATE_BACK?>)</a>
        </p>

        <h2><?php echo _TEMPLATE_EDIT_TITLE?> '<?php echo  hsc($templatename); ?>'</h2>

        <?php                   if ($msg) echo "<p>"._MESSAGE.": $msg</p>";
        ?>

        <p><?php echo _TEMPLATE_EDIT_MSG?></p>

        <form method="post" action="index.php">
        <div>

        <input type="hidden" name="action" value="templateupdate" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="templateid" value="<?php echo  $templateid; ?>" />

        <table><tr>
            <th colspan="2"><?php echo _TEMPLATE_SETTINGS?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_NAME?> <?php help('shortnames');?></td>
            <td><input name="tname" tabindex="4" size="20" maxlength="20" value="<?php echo  hsc($templatename) ?>" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_DESC?></td>
            <td><input name="tdesc" tabindex="5" size="50" maxlength="200" value="<?php echo  hsc($templatedescription) ?>" /></td>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_UPDATE?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_UPDATE?></td>
            <td>
                <input type="submit" tabindex="6" value="<?php echo _TEMPLATE_UPDATE_BTN?>" onclick="return checkSubmit();" />
                <input type="reset" tabindex="7" value="<?php echo _TEMPLATE_RESET_BTN?>" />
            </td>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_ITEMS?> <?php help('templateitems'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_ITEMHEADER, 'ITEM_HEADER', '', 8);
    $this->_templateEditRow($template, _TEMPLATE_ITEMBODY, 'ITEM', '', 9, 1);
    $this->_templateEditRow($template, _TEMPLATE_ITEMFOOTER, 'ITEM_FOOTER', '', 10);
    $this->_templateEditRow($template, _TEMPLATE_MORELINK, 'MORELINK', 'morelink', 20);
    $this->_templateEditRow($template, _TEMPLATE_EDITLINK, 'EDITLINK', 'editlink', 25);
    $this->_templateEditRow($template, _TEMPLATE_NEW, 'NEW', 'new', 30);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_ANY?> <?php help('templatecomments'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CHEADER, 'COMMENTS_HEADER', 'commentheaders', 40);
    $this->_templateEditRow($template, _TEMPLATE_CBODY, 'COMMENTS_BODY', 'commentbody', 50, 1);
    $this->_templateEditRow($template, _TEMPLATE_CFOOTER, 'COMMENTS_FOOTER', 'commentheaders', 60);
    $this->_templateEditRow($template, _TEMPLATE_CONE, 'COMMENTS_ONE', 'commentwords', 70);
    $this->_templateEditRow($template, _TEMPLATE_CMANY, 'COMMENTS_MANY', 'commentwords', 80);
    $this->_templateEditRow($template, _TEMPLATE_CMORE, 'COMMENTS_CONTINUED', 'commentcontinued', 90);
    $this->_templateEditRow($template, _TEMPLATE_CMEXTRA, 'COMMENTS_AUTH', 'memberextra', 100);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_NONE?> <?php help('templatecomments'); ?></th>
<?php
    $this->_templateEditRow($template, _TEMPLATE_CNONE, 'COMMENTS_NONE', '', 110);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_TOOMUCH?> <?php help('templatecomments'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CTOOMUCH, 'COMMENTS_TOOMUCH', '', 120);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_ARCHIVELIST?> <?php help('templatearchivelists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_AHEADER, 'ARCHIVELIST_HEADER', '', 130);
    $this->_templateEditRow($template, _TEMPLATE_AITEM, 'ARCHIVELIST_LISTITEM', '', 140);
    $this->_templateEditRow($template, _TEMPLATE_AFOOTER, 'ARCHIVELIST_FOOTER', '', 150);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_BLOGLIST?> <?php help('templatebloglists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_BLOGHEADER, 'BLOGLIST_HEADER', '', 160);
    $this->_templateEditRow($template, _TEMPLATE_BLOGITEM, 'BLOGLIST_LISTITEM', '', 170);
    $this->_templateEditRow($template, _TEMPLATE_BLOGFOOTER, 'BLOGLIST_FOOTER', '', 180);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_CATEGORYLIST?> <?php help('templatecategorylists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CATHEADER, 'CATLIST_HEADER', '', 190);
    $this->_templateEditRow($template, _TEMPLATE_CATITEM, 'CATLIST_LISTITEM', '', 200);
    $this->_templateEditRow($template, _TEMPLATE_CATFOOTER, 'CATLIST_FOOTER', '', 210);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_DATETIME?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_DHEADER, 'DATE_HEADER', 'dateheads', 220);
    $this->_templateEditRow($template, _TEMPLATE_DFOOTER, 'DATE_FOOTER', 'dateheads', 230);
    $this->_templateEditRow($template, _TEMPLATE_DFORMAT, 'FORMAT_DATE', 'datetime', 240);
    $this->_templateEditRow($template, _TEMPLATE_TFORMAT, 'FORMAT_TIME', 'datetime', 250);
    $this->_templateEditRow($template, _TEMPLATE_LOCALE, 'LOCALE', 'locale', 260);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_IMAGE?> <?php help('templatepopups'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_PCODE, 'POPUP_CODE', '', 270);
    $this->_templateEditRow($template, _TEMPLATE_ICODE, 'IMAGE_CODE', '', 280);
    $this->_templateEditRow($template, _TEMPLATE_MCODE, 'MEDIA_CODE', '', 290);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_SEARCH?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_SHIGHLIGHT, 'SEARCH_HIGHLIGHT', 'highlight',300);
    $this->_templateEditRow($template, _TEMPLATE_SNOTFOUND, 'SEARCH_NOTHINGFOUND', 'nothingfound',310);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_PLUGIN_FIELDS?></th>
<?php
        $tab = 600;
        $pluginfields = array();
		
		$data = array('fields'=>&$pluginfields);
		$manager->notify('TemplateExtraFields', $data);

        foreach ($pluginfields as $pfkey=>$pfvalue) {
            echo "</tr><tr>\n";
            echo '<th colspan="2">'.htmlentities($pfkey,ENT_QUOTES,_CHARSET)."</th>\n";
            foreach ($pfvalue as $pffield=>$pfdesc) {
                $this->_templateEditRow($template, $pfdesc, $pffield, '',++$tab,0);
            }
        }
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_UPDATE?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_UPDATE?></td>
            <td>
                <input type="submit" tabindex="800" value="<?php echo _TEMPLATE_UPDATE_BTN?>" onclick="return checkSubmit();" />
                <input type="reset" tabindex="810" value="<?php echo _TEMPLATE_RESET_BTN?>" />
            </td>
        </tr></table>

        </div>
        </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function _templateEditRow(&$template, $description, $name, $help = '', $tabindex = 0, $big = 0) {
        static $count = 1;
        if (!isset($template[$name])) $template[$name] = '';
    ?>
        </tr><tr>
            <td><?php echo $description?> <?php if ($help) help('template'.$help); ?></td>
            <td id="td<?php echo $count?>"><textarea class="templateedit" name="<?php echo $name?>" tabindex="<?php echo $tabindex?>" cols="50" rows="<?php echo $big?10:5?>" id="textarea<?php echo $count?>"><?php echo  hsc($template[$name]); ?></textarea></td>
    <?php       $count++;
    }

    /**
     * @todo document this
     */
    function action_templateupdate() {
        global $member,$manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

        $name = postVar('tname');
        $desc = postVar('tdesc');

        if (!isValidTemplateName($name))
            $this->error(_ERROR_BADTEMPLATENAME);

        if ((TEMPLATE::getNameFromId($templateid) != $name) && TEMPLATE::exists($name))
            $this->error(_ERROR_DUPTEMPLATENAME);


        $name = sql_real_escape_string($name);
        $desc = sql_real_escape_string($desc);

        // 1. Remove all template parts
        $query = 'DELETE FROM '.sql_table('template').' WHERE tdesc=' . $templateid;
        sql_query($query);

        // 2. Update description
        $query =  'UPDATE '.sql_table('template_desc').' SET'
               . " tdname='" . $name . "',"
               . " tddesc='" . $desc . "'"
               . " WHERE tdnumber=" . $templateid;
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

        $pluginfields = array();
		
		$data = array('fields'=>&$pluginfields);
		$manager->notify('TemplateExtraFields', $data);
        foreach ($pluginfields as $pfkey=>$pfvalue) {
            foreach ($pfvalue as $pffield=>$pfdesc) {
                $this->addToTemplate($templateid, $pffield, postVar($pffield));
            }
        }

        // jump back to template edit
        $this->action_templateedit(_TEMPLATE_UPDATED);

    }

    /**
     * @todo document this
     */
    function addToTemplate($id, $partname, $content) {
        $partname = sql_real_escape_string($partname);
        $content = sql_real_escape_string($content);

        $id = intval($id);

        // don't add empty parts:
        if (!trim($content)) return -1;

        $query = 'INSERT INTO '.sql_table('template')." (tdesc, tpartname, tcontent) "
               . "VALUES ($id, '$partname', '$content')";
        sql_query($query) or exit(_ADMIN_SQLDIE_QUERYERROR . sql_error());
        return sql_insert_id();
    }

    /**
     * @todo document this
     */
    function action_templatedelete() {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $templateid = intRequestVar('templateid');
        // TODO: check if template can be deleted

        $this->pagehead();

        $name = TEMPLATE::getNameFromId($templateid);
        $desc = TEMPLATE::getDesc($templateid);

        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p>
            <?php echo _CONFIRMTXT_TEMPLATE?><b><?php echo hsc($name)?></b> (<?php echo  hsc($desc) ?>)
            </p>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="templatedeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="templateid" value="<?php echo  $templateid ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_templatedeleteconfirm() {
        global $member, $manager;

        $templateid = intRequestVar('templateid');

        $member->isAdmin() or $this->disallow();

		$data = array('templateid' => $templateid);
		$manager->notify('PreDeleteTemplate', $data);

        // 1. delete description
        sql_query('DELETE FROM '.sql_table('template_desc').' WHERE tdnumber=' . $templateid);

        // 2. delete parts
        sql_query('DELETE FROM '.sql_table('template').' WHERE tdesc=' . $templateid);

		$data = array('templateid' => $templateid);
		$manager->notify('PostDeleteTemplate', $data);

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    function action_templatenew() {
        global $member;

        $member->isAdmin() or $this->disallow();

        $name = postVar('name');
        $desc = postVar('desc');

        if (!isValidTemplateName($name))
            $this->error(_ERROR_BADTEMPLATENAME);

        if (TEMPLATE::exists($name))
            $this->error(_ERROR_DUPTEMPLATENAME);

        $newTemplateId = TEMPLATE::createNew($name, $desc);

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    function action_templateclone() {
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
            while (TEMPLATE::exists($name . $i))
                $i++;
            $name .= $i;
        }

        $newid = TEMPLATE::createNew($name, $desc);

        // 3. create clone
        // go through parts of old template and add them to the new one
        $res = sql_query('SELECT tpartname, tcontent FROM '.sql_table('template').' WHERE tdesc=' . $templateid);
        while ($o = sql_fetch_object($res)) {
            $this->addToTemplate($newid, $o->tpartname, $o->tcontent);
        }

        $this->action_templateoverview();
    }

    /**
     * @todo document this
     */
    function action_skinoverview() {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

        echo '<h2>' . _SKIN_EDIT_TITLE . '</h2>';

        echo '<h3>' . _SKIN_AVAILABLE_TITLE . '</h3>';

        $query = 'SELECT * FROM '.sql_table('skin_desc').' ORDER BY sdname';
        $template['content'] = 'skinlist';
        $template['tabindex'] = 10;
        showlist($query,'table',$template);

        echo '<h3>' . _SKIN_NEW_TITLE . '</h3>';

        ?>
        <form method="post" action="index.php">
        <div>

        <input name="action" value="skinnew" type="hidden" />
        <?php $manager->addTicketHidden() ?>
        <table><tr>
            <td><?php echo _SKIN_NAME?> <?php help('shortnames');?></td>
            <td><input name="name" tabindex="10010" maxlength="20" size="20" /></td>
        </tr><tr>
            <td><?php echo _SKIN_DESC?></td>
            <td><input name="desc" tabindex="10020" maxlength="200" size="50" /></td>
        </tr><tr>
            <td><?php echo _SKIN_CREATE?></td>
            <td><input type="submit" tabindex="10030" value="<?php echo _SKIN_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div>
        </form>

        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skinnew() {
        global $member;

        $member->isAdmin() or $this->disallow();

        $name = trim(postVar('name'));
        $desc = trim(postVar('desc'));

        if (!isValidSkinName($name))
            $this->error(_ERROR_BADSKINNAME);

        if (SKIN::exists($name))
            $this->error(_ERROR_DUPSKINNAME);

        $newId = SKIN::createNew($name, $desc);

        $this->action_skinoverview();
    }

    /**
     * @todo document this
     */
    function action_skinedit() {
        global $member, $manager;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        $skin = new SKIN($skinid);

        $this->pagehead();
        ?>
        <p>
            <a href="index.php?action=skinoverview">(<?php echo _SKIN_BACK?>)</a>
        </p>
        <h2><?php echo _SKIN_EDITONE_TITLE?> '<?php echo  $skin->getName() ?>'</h2>

        <h3><?php echo _SKIN_PARTS_TITLE?></h3>
        <?php echo _SKIN_PARTS_MSG?>
        <ul>
            <li><a tabindex="10" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=index"><?php echo _SKIN_PART_MAIN?></a> <?php help('skinpartindex')?></li>
            <li><a tabindex="20" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=item"><?php echo _SKIN_PART_ITEM?></a> <?php help('skinpartitem')?></li>
            <li><a tabindex="30" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=archivelist"><?php echo _SKIN_PART_ALIST?></a> <?php help('skinpartarchivelist')?></li>
            <li><a tabindex="40" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=archive"><?php echo _SKIN_PART_ARCHIVE?></a> <?php help('skinpartarchive')?></li>
            <li><a tabindex="50" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=search"><?php echo _SKIN_PART_SEARCH?></a> <?php help('skinpartsearch')?></li>
            <li><a tabindex="60" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=error"><?php echo _SKIN_PART_ERROR?></a> <?php help('skinparterror')?></li>
            <li><a tabindex="70" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=member"><?php echo _SKIN_PART_MEMBER?></a> <?php help('skinpartmember')?></li>
            <li><a tabindex="75" href="index.php?action=skinedittype&amp;skinid=<?php echo  $skinid ?>&amp;type=imagepopup"><?php echo _SKIN_PART_POPUP?></a> <?php help('skinpartimagepopup')?></li>
        </ul>

        <?php

        $query = "SELECT stype FROM " . sql_table('skin') . " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member') and sdesc = " . $skinid;
        $res = sql_query($query);

        echo '<h3>' . _SKIN_PARTS_SPECIAL . '</h3>';
        echo '<form method="get" action="index.php">' . "\r\n";
        echo '<input type="hidden" name="action" value="skinedittype" />' . "\r\n";
        echo '<input type="hidden" name="skinid" value="' . $skinid . '" />' . "\r\n";
        echo '<input name="type" tabindex="89" size="20" maxlength="20" />' . "\r\n";
        echo '<input type="submit" tabindex="140" value="' . _SKIN_CREATE . '" onclick="return checkSubmit();" />' . "\r\n";
        echo '</form>' . "\r\n";

        if ($res && sql_num_rows($res) > 0) {
            echo '<ul>';
            $tabstart = 75;

            while ($row = sql_fetch_assoc($res)) {
                echo '<li><a tabindex="' . ($tabstart++) . '" href="index.php?action=skinedittype&amp;skinid=' . $skinid . '&amp;type=' . hsc(strtolower($row['stype'])) . '">' . hsc(ucfirst($row['stype'])) . '</a> (<a tabindex="' . ($tabstart++) . '" href="index.php?action=skinremovetype&amp;skinid=' . $skinid . '&amp;type=' . hsc(strtolower($row['stype'])) . '">remove</a>)</li>';
            }

            echo '</ul>';
        }

        ?>

        <h3><?php echo _SKIN_GENSETTINGS_TITLE; ?></h3>
        <form method="post" action="index.php">
        <div>

        <input type="hidden" name="action" value="skineditgeneral" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
        <table><tr>
            <td><?php echo _SKIN_NAME?> <?php help('shortnames');?></td>
            <td><input name="name" tabindex="90" value="<?php echo  hsc($skin->getName()) ?>" maxlength="20" size="20" /></td>
        </tr><tr>
            <td><?php echo _SKIN_DESC?></td>
            <td><input name="desc" tabindex="100" value="<?php echo  hsc($skin->getDescription()) ?>" maxlength="200" size="50" /></td>
        </tr><tr>
            <td><?php echo _SKIN_TYPE?></td>
            <td><input name="type" tabindex="110" value="<?php echo  hsc($skin->getContentType()) ?>" maxlength="40" size="20" /></td>
        </tr><tr>
            <td><?php echo _SKIN_INCLUDE_MODE?> <?php help('includemode')?></td>
            <td><?php $this->input_yesno('inc_mode',$skin->getIncludeMode(),120,'skindir','normal',_PARSER_INCMODE_SKINDIR,_PARSER_INCMODE_NORMAL);?></td>
        </tr><tr>
            <td><?php echo _SKIN_INCLUDE_PREFIX?> <?php help('includeprefix')?></td>
            <td><input name="inc_prefix" tabindex="130" value="<?php echo  hsc($skin->getIncludePrefix()) ?>" maxlength="40" size="20" /></td>
        </tr><tr>
            <td><?php echo _SKIN_CHANGE?></td>
            <td><input type="submit" tabindex="140" value="<?php echo _SKIN_CHANGE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div>
        </form>


        <?php       $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skineditgeneral() {
        global $member;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        $name = postVar('name');
        $desc = postVar('desc');
        $type = postVar('type');
        $inc_mode = postVar('inc_mode');
        $inc_prefix = postVar('inc_prefix');

        $skin = new SKIN($skinid);

        // 1. Some checks
        if (!isValidSkinName($name))
            $this->error(_ERROR_BADSKINNAME);

        if (($skin->getName() != $name) && SKIN::exists($name))
            $this->error(_ERROR_DUPSKINNAME);

        if (!$type) $type = 'text/html';
        if (!$inc_mode) $inc_mode = 'normal';

        // 2. Update description
        $skin->updateGeneralInfo($name, $desc, $type, $inc_mode, $inc_prefix);

        $this->action_skinedit();

    }

    /**
     * @todo document this
     */
    function action_skinedittype($msg = '') {
        global $member, $manager;

        $skinid = intRequestVar('skinid');
        $type = requestVar('type');

        $member->isAdmin() or $this->disallow();

        $type = trim($type);
        $type = strtolower($type);

        if (!isValidShortName($type)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
        }

        $skin = new SKIN($skinid);

        $friendlyNames = SKIN::getFriendlyNames();

        $this->pagehead();
        ?>
        <p>(<a href="index.php?action=skinoverview"><?php echo _SKIN_GOBACK?></a>)</p>

        <h2><?php echo _SKIN_EDITPART_TITLE?> '<?php echo hsc($skin->getName()) ?>': <?php echo hsc(isset($friendlyNames[$type]) ? $friendlyNames[$type] : ucfirst($type)); ?></h2>

        <?php           if ($msg) echo "<p>"._MESSAGE.": $msg</p>";
        ?>


        <form method="post" action="index.php">
        <div>

        <input type="hidden" name="action" value="skinupdate" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
        <input type="hidden" name="type" value="<?php echo  $type ?>" />

        <input type="submit" value="<?php echo _SKIN_UPDATE_BTN?>" onclick="return checkSubmit();" />
        <input type="reset" value="<?php echo _SKIN_RESET_BTN?>" />
        (skin type: <?php echo hsc(isset($friendlyNames[$type]) ? $friendlyNames[$type] : ucfirst($type)); ?>)
        <?php if (in_array($type, array('index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'))) {
            help('skinpart' . $type);
        } else {
            help('skinpartspecial');
        }?>
        <br />

        <textarea class="skinedit" tabindex="10" rows="20" cols="80" name="content"><?php echo  hsc($skin->getContent($type)) ?></textarea>

        <br />
        <input type="submit" tabindex="20" value="<?php echo _SKIN_UPDATE_BTN?>" onclick="return checkSubmit();" />
        <input type="reset" value="<?php echo _SKIN_RESET_BTN?>" />
        (skin type: <?php echo hsc(isset($friendlyNames[$type]) ? $friendlyNames[$type] : ucfirst($type)); ?>)

        <br /><br />
        <?php echo _SKIN_ALLOWEDVARS?>
        <?php           $actions = SKIN::getAllowedActionsForType($type);

            sort($actions);

            while ($current = array_shift($actions)) {
                // skip deprecated vars
                if ($current == 'ifcat') continue;
                if ($current == 'imagetext') continue;
                if ($current == 'vars') continue;

                echo helplink('skinvar-' . $current) . "$current</a>";
                if (count($actions) != 0) echo ", ";
            }
        echo '<br /><br />' . _SKINEDIT_ALLOWEDBLOGS;
        $query = 'SELECT bshortname, bname FROM '.sql_table('blog');
        showlist($query,'table',array('content'=>'shortblognames'));
        echo '<br />' . _SKINEDIT_ALLOWEDTEMPLATESS;
        $query = 'SELECT tdname as name, tddesc as description FROM '.sql_table('template_desc');
        showlist($query,'table',array('content'=>'shortnames'));
        echo '</div></form>';
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skinupdate() {
        global $member;

        $skinid = intRequestVar('skinid');
        $content = trim(postVar('content'));
        $type = postVar('type');

        $member->isAdmin() or $this->disallow();

        $skin = new SKIN($skinid);
        $skin->update($type, $content);

        $this->action_skinedittype(_SKIN_UPDATED);
    }

    /**
     * @todo document this
     */
    function action_skindelete() {
        global $member, $manager, $CONF;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // don't allow default skin to be deleted
        if ($skinid == $CONF['BaseSkin'])
            $this->error(_ERROR_DEFAULTSKIN);

        // don't allow deletion of default skins for blogs
        $query = 'SELECT bname FROM '.sql_table('blog').' WHERE bdefskin=' . $skinid;
        $r = sql_query($query);
        if ($o = sql_fetch_object($r))
            $this->error(_ERROR_SKINDEFDELETE . hsc($o->bname));

        $this->pagehead();

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p>
                <?php echo _CONFIRMTXT_SKIN?><b><?php echo hsc($name) ?></b> (<?php echo  hsc($desc)?>)
            </p>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="skindeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skindeleteconfirm() {
        global $member, $CONF, $manager;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // don't allow default skin to be deleted
        if ($skinid == $CONF['BaseSkin'])
            $this->error(_ERROR_DEFAULTSKIN);

        // don't allow deletion of default skins for blogs
        $query = 'SELECT bname FROM '.sql_table('blog').' WHERE bdefskin=' . $skinid;
        $r = sql_query($query);
        if ($o = sql_fetch_object($r))
            $this->error(_ERROR_SKINDEFDELETE .$o->bname);

		$data = array('skinid' => $skinid);
		$manager->notify('PreDeleteSkin', $data);

        // 1. delete description
        sql_query('DELETE FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $skinid);

        // 2. delete parts
        sql_query('DELETE FROM '.sql_table('skin').' WHERE sdesc=' . $skinid);

		$data = array('skinid' => $skinid);
		$manager->notify('PostDeleteSkin', $data);

        $this->action_skinoverview();
    }

    /**
     * @todo document this
     */
    function action_skinremovetype() {
        global $member, $manager, $CONF;

        $skinid = intRequestVar('skinid');
        $skintype = requestVar('type');

        if (!isValidShortName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

        $member->isAdmin() or $this->disallow();

        // don't allow default skinparts to be deleted
        if (in_array($skintype, array('index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'))) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

        $this->pagehead();

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p>
                <?php echo _CONFIRMTXT_SKIN_PARTS_SPECIAL; ?> <b><?php echo hsc($skintype); ?> (<?php echo hsc($name); ?>)</b> (<?php echo  hsc($desc)?>)
            </p>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="skinremovetypeconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="skinid" value="<?php echo $skinid; ?>" />
                <input type="hidden" name="type" value="<?php echo hsc($skintype); ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_skinremovetypeconfirm() {
        global $member, $CONF, $manager;

        $skinid = intRequestVar('skinid');
        $skintype = requestVar('type');

        if (!isValidShortName($skintype)) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

        $member->isAdmin() or $this->disallow();

        // don't allow default skinparts to be deleted
        if (in_array($skintype, array('index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'))) {
            $this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
        }

		$data = array('skinid' => $skinid, 'skintype' => $skintype);
		$manager->notify('PreDeleteSkinPart', $data);

        // delete part
        sql_query('DELETE FROM '.sql_table('skin').' WHERE sdesc=' . $skinid . ' AND stype=\'' . $skintype . '\'');

		$data = array('skinid' => $skinid, 'skintype' => $skintype);
		$manager->notify('PostDeleteSkinPart', $data);

        $this->action_skinedit();
    }

    /**
     * @todo document this
     */
    function action_skinclone() {
        global $member;

        $skinid = intRequestVar('skinid');

        $member->isAdmin() or $this->disallow();

        // 1. read skin to clone
        $skin = new SKIN($skinid);

        $name = "clone_" . $skin->getName();

        // if a skin with that name already exists:
        if (SKIN::exists($name)) {
            $i = 1;
            while (SKIN::exists($name . $i))
                $i++;
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

        $query = "SELECT stype FROM " . sql_table('skin') . " WHERE sdesc = " . $skinid;
        $res = sql_query($query);
        while ($row = sql_fetch_assoc($res)) {
            $this->skinclonetype($skin, $newid, $row['stype']);
        }

        $this->action_skinoverview();

    }

    /**
     * @todo document this
     */
    function skinclonetype($skin, $newid, $type) {
        $newid = intval($newid);
        $content = $skin->getContent($type);
        if ($content) {
            $query = 'INSERT INTO '.sql_table('skin')." (sdesc, scontent, stype) VALUES ($newid,'". sql_real_escape_string($content)."', '". sql_real_escape_string($type)."')";
            sql_query($query);
        }
    }

    /**
     * @todo document this
     */
    function action_settingsedit() {
        global $member, $manager, $CONF, $DIR_NUCLEUS, $DIR_MEDIA;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
        ?>

        <h2><?php echo _SETTINGS_TITLE?></h2>

        <form action="index.php" method="post">
        <div>

        <input type="hidden" name="action" value="settingsupdate" />
        <?php $manager->addTicketHidden() ?>

        <table><tr>
            <th colspan="2"><?php echo _SETTINGS_SUB_GENERAL?></th>
        </tr><tr>
            <td><?php echo _SETTINGS_DEFBLOG?> <?php help('defaultblog'); ?></td>
            <td>
                <?php
                    $query =  'SELECT bname as text, bnumber as value'
                           . ' FROM '.sql_table('blog');
                    $template['name'] = 'DefaultBlog';
                    $template['selected'] = $CONF['DefaultBlog'];
                    $template['tabindex'] = 10;
                    showlist($query,'select',$template);
                ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_BASESKIN?> <?php help('baseskin'); ?></td>
            <td>
                <?php
                    $query =  'SELECT sdname as text, sdnumber as value'
                           . ' FROM '.sql_table('skin_desc');
                    $template['name'] = 'BaseSkin';
                    $template['selected'] = $CONF['BaseSkin'];
                    $template['tabindex'] = 1;
                    showlist($query,'select',$template);
                ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_ADMINMAIL?></td>
            <td><input name="AdminEmail" tabindex="10010" size="40" value="<?php echo  hsc($CONF['AdminEmail']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_SITENAME?></td>
            <td><input name="SiteName" tabindex="10020" size="40" value="<?php echo  hsc($CONF['SiteName']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_SITEURL?></td>
            <td><input name="IndexURL" tabindex="10030" size="40" value="<?php echo  hsc($CONF['IndexURL']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_ADMINURL?></td>
            <td><input name="AdminURL" tabindex="10040" size="40" value="<?php echo  hsc($CONF['AdminURL']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_PLUGINURL?> <?php help('pluginurl');?></td>
            <td><input name="PluginURL" tabindex="10045" size="40" value="<?php echo  hsc($CONF['PluginURL']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_SKINSURL?> <?php help('skinsurl');?></td>
            <td><input name="SkinsURL" tabindex="10046" size="40" value="<?php echo  hsc($CONF['SkinsURL']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_ACTIONSURL?> <?php help('actionurl');?></td>
            <td><input name="ActionURL" tabindex="10047" size="40" value="<?php echo  hsc($CONF['ActionURL']) ?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_LANGUAGE?> <?php help('language'); ?>
            </td>
            <td>

                <select name="Language" tabindex="10050">
                <?php               // show a dropdown list of all available languages
                global $DIR_LANG;
                $dirhandle = opendir($DIR_LANG);

				while ($filename = readdir($dirhandle) )
				{

					# replaced ereg() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
					# original ereg: ereg("^(.*)\.php$",$filename,$matches)

					if (preg_match('#^(.*)\.php$#', $filename, $matches) )
					{

						$name = $matches[1];
						echo "<option value=\"$name\"";

						if ($name == $CONF['Language'])
						{
							echo " selected=\"selected\"";
						}

						echo ">$name</option>";

					}

				}

				closedir($dirhandle);

				?>
				</select>

            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_DISABLESITE?> <?php help('disablesite'); ?>
            </td>
            <td><?php $this->input_yesno('DisableSite',$CONF['DisableSite'],10060); ?>
                    <br />
                <?php echo _SETTINGS_DISABLESITEURL ?> <input name="DisableSiteURL" tabindex="10070" size="40" value="<?php echo  hsc($CONF['DisableSiteURL'])?>" />
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_DIRS?></td>
            <td><?php echo  hsc($DIR_NUCLEUS) ?>
                <i><?php echo _SETTINGS_SEECONFIGPHP?></i></td>
        </tr><tr>
            <td><?php echo _SETTINGS_DBLOGIN?></td>
            <td><i><?php echo _SETTINGS_SEECONFIGPHP?></i></td>
        </tr><tr>
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
            <td><?php /* $this->input_yesno('DisableJsTools',$CONF['DisableJsTools'],10075); */?>
                <select name="DisableJsTools" tabindex="10075">
            <?php                   $extra = ($CONF['DisableJsTools'] == 1) ? 'selected="selected"' : '';
                    echo "<option $extra value='1'>",_SETTINGS_JSTOOLBAR_NONE,"</option>";
                    $extra = ($CONF['DisableJsTools'] == 2) ? 'selected="selected"' : '';
                    echo "<option $extra value='2'>",_SETTINGS_JSTOOLBAR_SIMPLE,"</option>";
                    $extra = ($CONF['DisableJsTools'] == 0) ? 'selected="selected"' : '';
                    echo "<option $extra value='0'>",_SETTINGS_JSTOOLBAR_FULL,"</option>";
            ?>
                </select>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_URLMODE?> <?php help('urlmode');?></td>
                       <td><?php

                       $this->input_yesno('URLMode',$CONF['URLMode'],10077,
                              'normal','pathinfo',_SETTINGS_URLMODE_NORMAL,_SETTINGS_URLMODE_PATHINFO);

                       echo ' ', _SETTINGS_URLMODE_HELP;

                             ?>

                       </td>
        </tr><tr>
            <td><?php echo _SETTINGS_DEBUGVARS?> <?php help('debugvars');?></td>
                       <td><?php

                        $this->input_yesno('DebugVars',$CONF['DebugVars'],10078);

                             ?>

                       </td>
        </tr><tr>
            <td><?php echo _SETTINGS_DEFAULTLISTSIZE?> <?php help('defaultlistsize');?></td>
            <td>
            <?php
                if (!array_key_exists('DefaultListSize',$CONF)) {
                    sql_query("INSERT INTO ".sql_table('config')." VALUES ('DefaultListSize', '10')");
                    $CONF['DefaultListSize'] = 10;
                }
            ?>
                <input name="DefaultListSize" tabindex="10079" size="40" value="<?php echo  hsc((intval($CONF['DefaultListSize']) < 1 ? '10' : $CONF['DefaultListSize'])) ?>" />
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_ADMINCSS?> 
            </td>
            <td>

                <select name="AdminCSS" tabindex="10080">
                <?php               // show a dropdown list of all available admin css files
                global $DIR_NUCLEUS;
				
                $dirhandle = opendir($DIR_NUCLEUS."styles/");

				while ($filename = readdir($dirhandle) )
				{

					# replaced ereg() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
					# original ereg: ereg("^(.*)\.php$",$filename,$matches)

					if (preg_match('#^admin_(.*)\.css$#', $filename, $matches) )
					{

						$name = $matches[1];
						echo "<option value=\"$name\"";

						if ($name == $CONF['AdminCSS'])
						{
							echo " selected=\"selected\"";
						}

						echo ">$name</option>";

					}

				}

				closedir($dirhandle);

				?>
				</select>

            </td>
        </tr><tr>
            <th colspan="2"><?php echo _SETTINGS_MEDIA?> <?php help('media'); ?></th>
        </tr><tr>
            <td><?php echo _SETTINGS_MEDIADIR?></td>
            <td><?php echo  hsc($DIR_MEDIA) ?>
                <i><?php echo _SETTINGS_SEECONFIGPHP?></i>
                <?php                   if (!is_dir($DIR_MEDIA))
                        echo "<br /><b>" . _WARNING_NOTADIR . "</b>";
                    if (!is_readable($DIR_MEDIA))
                        echo "<br /><b>" . _WARNING_NOTREADABLE . "</b>";
                    if (!is_writeable($DIR_MEDIA))
                        echo "<br /><b>" . _WARNING_NOTWRITABLE . "</b>";
                ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_MEDIAURL?></td>
            <td>
                <input name="MediaURL" tabindex="10090" size="40" value="<?php echo  hsc($CONF['MediaURL']) ?>" />
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_ALLOWUPLOAD?></td>
            <td><?php $this->input_yesno('AllowUpload',$CONF['AllowUpload'],10090); ?></td>
        </tr><tr>
            <td><?php echo _SETTINGS_ALLOWUPLOADTYPES?></td>
            <td>
                <input name="AllowedTypes" tabindex="10100" size="40" value="<?php echo  hsc($CONF['AllowedTypes']) ?>" />
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_MAXUPLOADSIZE?></td>
            <td>
                <input name="MaxUploadSize" tabindex="10105" size="40" value="<?php echo  hsc($CONF['MaxUploadSize']) ?>" />
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_MEDIAPREFIX?></td>
            <td><?php $this->input_yesno('MediaPrefix',$CONF['MediaPrefix'],10110); ?></td>

        </tr><tr>
            <th colspan="2"><?php echo _SETTINGS_MEMBERS?></th>
        </tr><tr>
            <td><?php echo _SETTINGS_CHANGELOGIN?></td>
            <td><?php $this->input_yesno('AllowLoginEdit',$CONF['AllowLoginEdit'],10120); ?></td>
        </tr><tr>
            <td><?php echo _SETTINGS_ALLOWCREATE?>
                <?php help('allowaccountcreation'); ?>
            </td>
            <td><?php $this->input_yesno('AllowMemberCreate',$CONF['AllowMemberCreate'],10130); ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_NEWLOGIN?> <?php help('allownewmemberlogin'); ?>
                <br /><?php echo _SETTINGS_NEWLOGIN2?>
            </td>
            <td><?php $this->input_yesno('NewMemberCanLogon',$CONF['NewMemberCanLogon'],10140); ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_MEMBERMSGS?>
                <?php help('messageservice'); ?>
            </td>
            <td><?php $this->input_yesno('AllowMemberMail',$CONF['AllowMemberMail'],10150); ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_NONMEMBERMSGS?>
                <?php help('messageservice'); ?>
            </td>
            <td><?php $this->input_yesno('NonmemberMail',$CONF['NonmemberMail'],10155); ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_PROTECTMEMNAMES?>
                <?php help('protectmemnames'); ?>
            </td>
            <td><?php $this->input_yesno('ProtectMemNames',$CONF['ProtectMemNames'],10156); ?>
            </td>



        </tr><tr>
            <th colspan="2"><?php echo _SETTINGS_COOKIES_TITLE?> <?php help('cookies'); ?></th>
        </tr><tr>
            <td><?php echo _SETTINGS_COOKIEPREFIX?></td>
            <td><input name="CookiePrefix" tabindex="10159" size="40" value="<?php echo  hsc($CONF['CookiePrefix'])?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_COOKIEDOMAIN?></td>
            <td><input name="CookieDomain" tabindex="10160" size="40" value="<?php echo  hsc($CONF['CookieDomain'])?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_COOKIEPATH?></td>
            <td><input name="CookiePath" tabindex="10170" size="40" value="<?php echo  hsc($CONF['CookiePath'])?>" /></td>
        </tr><tr>
            <td><?php echo _SETTINGS_COOKIESECURE?></td>
            <td><?php $this->input_yesno('CookieSecure',$CONF['CookieSecure'],10180); ?></td>
        </tr><tr>
            <td><?php echo _SETTINGS_COOKIELIFE?></td>
            <td><?php $this->input_yesno('SessionCookie',$CONF['SessionCookie'],10190,
                              1,0,_SETTINGS_COOKIESESSION,_SETTINGS_COOKIEMONTH); ?>
            </td>
        </tr><tr>
            <td><?php echo _SETTINGS_LASTVISIT?></td>
            <td><?php $this->input_yesno('LastVisit',$CONF['LastVisit'],10200); ?></td>



        </tr><tr>
            <th colspan="2"><?php echo _SETTINGS_UPDATE?></th>
        </tr><tr>
            <td><?php echo _SETTINGS_UPDATE?></td>
            <td><input type="submit" tabindex="10210" value="<?php echo _SETTINGS_UPDATE_BTN?>" onclick="return checkSubmit();" /></td>
        </tr></table>

        </div>
        </form>

        <?php
            echo '<h2>',_PLUGINS_EXTRA,'</h2>';

		$data = array();
		$manager->notify('GeneralSettingsFormExtras', $data);

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_settingsupdate() {
        global $member, $CONF;

        $member->isAdmin() or $this->disallow();

        // check if email address for admin is valid
        if (!isValidMailAddress(postVar('AdminEmail')))
            $this->error(_ERROR_BADMAILADDRESS);


        // save settings
        $this->updateConfig('DefaultBlog',      postVar('DefaultBlog'));
        $this->updateConfig('BaseSkin',         postVar('BaseSkin'));
        $this->updateConfig('IndexURL',         postVar('IndexURL'));
        $this->updateConfig('AdminURL',         postVar('AdminURL'));
        $this->updateConfig('PluginURL',        postVar('PluginURL'));
        $this->updateConfig('SkinsURL',         postVar('SkinsURL'));
        $this->updateConfig('ActionURL',        postVar('ActionURL'));
        $this->updateConfig('Language',         postVar('Language'));
        $this->updateConfig('AdminEmail',       postVar('AdminEmail'));
        $this->updateConfig('SessionCookie',    postVar('SessionCookie'));
        $this->updateConfig('AllowMemberCreate',postVar('AllowMemberCreate'));
        $this->updateConfig('AllowMemberMail',  postVar('AllowMemberMail'));
        $this->updateConfig('NonmemberMail',    postVar('NonmemberMail'));
        $this->updateConfig('ProtectMemNames',  postVar('ProtectMemNames'));
        $this->updateConfig('SiteName',         postVar('SiteName'));
        $this->updateConfig('NewMemberCanLogon',postVar('NewMemberCanLogon'));
        $this->updateConfig('DisableSite',      postVar('DisableSite'));
        $this->updateConfig('DisableSiteURL',   postVar('DisableSiteURL'));
        $this->updateConfig('LastVisit',        postVar('LastVisit'));
        $this->updateConfig('MediaURL',         postVar('MediaURL'));
        $this->updateConfig('AllowedTypes',     postVar('AllowedTypes'));
        $this->updateConfig('AllowUpload',      postVar('AllowUpload'));
        $this->updateConfig('MaxUploadSize',    postVar('MaxUploadSize'));
        $this->updateConfig('MediaPrefix',      postVar('MediaPrefix'));
        $this->updateConfig('AllowLoginEdit',   postVar('AllowLoginEdit'));
        $this->updateConfig('DisableJsTools',   postVar('DisableJsTools'));
        $this->updateConfig('CookieDomain',     postVar('CookieDomain'));
        $this->updateConfig('CookiePath',       postVar('CookiePath'));
        $this->updateConfig('CookieSecure',     postVar('CookieSecure'));
        $this->updateConfig('URLMode',          postVar('URLMode'));
        $this->updateConfig('CookiePrefix',     postVar('CookiePrefix'));
        $this->updateConfig('DebugVars',            postVar('DebugVars'));
        $this->updateConfig('DefaultListSize',          postVar('DefaultListSize'));
		$this->updateConfig('AdminCSS',          postVar('AdminCSS'));

        // load new config and redirect (this way, the new language will be used is necessary)
        // note that when changing cookie settings, this redirect might cause the user
        // to have to log in again.
        getConfig();
        redirect($CONF['AdminURL'] . '?action=manage');
        exit;

    }

    /**
     *  Give an overview over the used system
     */
    function action_systemoverview() {
        global $member, $nucleus, $CONF;

        $this->pagehead();

        echo '<h2>' . _ADMIN_SYSTEMOVERVIEW_HEADING . "</h2>\n";

        if ($member->isLoggedIn() && $member->isAdmin()) {

            // Information about the used PHP and MySQL installation
            echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL . "</h3>\n";

            // Version of PHP MySQL
            echo "<table>\n";
            echo "\t<tr>\n";
            echo "\t\t" . '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_VERSIONS . "</th>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . _ADMIN_SYSTEMOVERVIEW_PHPVERSION . "</td>\n";
            echo "\t\t" . '<td>' . phpversion() . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td>' . _ADMIN_SYSTEMOVERVIEW_MYSQLVERSION . "</td>\n";
            echo "\t\t" . '<td>' . sql_get_server_info() . ' (' . sql_get_client_info() . ')' . "</td>\n";
            echo "\t</tr>";
            echo "</table>\n";

            // Important PHP settings
            echo "<table>\n";
            echo "\t<tr>\n";
            echo "\t\t" . '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_SETTINGS . "</th>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">magic_quotes_gpc' . "</td>\n";
            $mqg = get_magic_quotes_gpc() ? 'On' : 'Off';
            echo "\t\t" . '<td>' . $mqg . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td>magic_quotes_runtime' . "</td>\n";
            $mqr = get_magic_quotes_runtime() ? 'On' : 'Off';
            echo "\t\t" . '<td>' . $mqr . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td>register_globals' . "</td>\n";
            $rg = ini_get('register_globals') ? 'On' : 'Off';
            echo "\t\t" . '<td>' . $rg . "</td>\n";
            echo "\t</tr>";
            echo "</table>\n";

            // Information about GD library
            $gdinfo = gd_info();
            echo "<table>\n";
            echo "\t<tr>";
            echo "\t\t" . '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_GDLIBRALY . "</th>\n";
            echo "\t</tr>\n";
            foreach ($gdinfo as $key=>$value) {
                if (is_bool($value)) {
                    $value = $value ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE;
                } else {
                    $value = hsc($value);
                }
                echo "\t<tr>";
                echo "\t\t" . '<td width="50%">' . $key . "</td>\n";
                echo "\t\t" . '<td>' . $value . "</td>\n";
                echo "\t</tr>\n";
            }
            echo "</table>\n";

            // Check if special modules are loaded
            ob_start();
            phpinfo(INFO_MODULES);
            $im = ob_get_contents();
            ob_clean();
            echo "<table>\n";
            echo "\t<tr>";
            echo "\t\t" . '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_MODULES . "</th>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">mod_rewrite' . "</td>\n";
            $modrewrite = (strstr($im, 'mod_rewrite') != '') ?
                        _ADMIN_SYSTEMOVERVIEW_ENABLE :
                        _ADMIN_SYSTEMOVERVIEW_DISABLE;
            echo "\t\t" . '<td>' . $modrewrite . "</td>\n";
            echo "\t</tr>\n";
            echo "</table>\n";

            // Information about the used Nucleus CMS
            echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM . "</h3>\n";
            global $nucleus;
            $nv = getNucleusVersion() / 100 . '(' . $nucleus['version'] . ')';
            $np = getNucleusPatchLevel();
            echo "<table>\n";
            echo "\t<tr>";
            echo "\t\t" . '<th colspan="2">Nucleus CMS' . "</th>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION . "</td>\n";
            echo "\t\t" . '<td>' . $nv . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL . "</td>\n";
            echo "\t\t" . '<td>' . $np . "</td>\n";
            echo "\t</tr>\n";
            echo "</table>\n";

            // Important settings of the installation
            echo "<table>\n";
            echo "\t<tr>";
            echo "\t\t" . '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS . "</th>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . '$CONF[' . "'Self']</td>\n";
            echo "\t\t" . '<td>' . $CONF['Self'] . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . '$CONF[' . "'ItemURL']</td>\n";
            echo "\t\t" . '<td>' . $CONF['ItemURL'] . "</td>\n";
            echo "\t</tr><tr>\n";
            echo "\t\t" . '<td width="50%">' . '$CONF[' . "'alertOnHeadersSent']</td>\n";
            $ohs = $CONF['alertOnHeadersSent'] ?
                        _ADMIN_SYSTEMOVERVIEW_ENABLE :
                        _ADMIN_SYSTEMOVERVIEW_DISABLE;
            echo "\t\t" . '<td>' . $ohs . "</td>\n";
            echo "\t</tr>\n";
            echo "</table>\n";

            // Link to the online version test at the Nucleus CMS website
            echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK . "</h3>\n";
            if ($nucleus['codename'] != '') {
                $codenamestring = ' &quot;' . $nucleus['codename'] . '&quot;';
            } else {
                $codenamestring = '';
            }
            echo _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT;
            $checkURL = sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
            echo '<a href="' . $checkURL . '" title="' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE . '">';
            echo 'Nucleus CMS ' . $nv . $codenamestring;
            echo '</a>';
        //echo '<br />';
        }
        else {
            echo _ADMIN_SYSTEMOVERVIEW_NOT_ADMIN;
        }

        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function updateConfig($name, $val) {
        $name = sql_real_escape_string($name);
        $val = trim(sql_real_escape_string($val));

        $query = 'UPDATE '.sql_table('config')
               . " SET value='$val'"
               . " WHERE name='$name'";

        sql_query($query) or die("Query error: " . sql_error());
        return sql_insert_id();
    }

    /**
     * Error message
     * @param string $msg message that will be shown
     */
    function error($msg) {
        $this->pagehead();
        ?>
        <h2>Error!</h2>
        <?php       echo $msg;
        echo "<br />";
        echo "<a href='index.php' onclick='history.back()'>"._BACK."</a>";
        $this->pagefoot();
        exit;
    }

    /**
     * @todo document this
     */
    function disallow() {
        ACTIONLOG::add(WARNING, _ACTIONLOG_DISALLOWED . serverVar('REQUEST_URI'));

        $this->error(_ERROR_DISALLOWED);
    }

    /**
     * @todo document this
     */
    function pagehead($extrahead = '') {
        global $member, $nucleus, $CONF, $manager;

		$data = array(
			'extrahead'	=> &$extrahead,
			'action'	=> $this->action
		);
		$manager->notify('AdminPrePageHead', $data);

        $baseUrl = hsc($CONF['AdminURL']);
		if (!array_key_exists('AdminCSS',$CONF)) 
		{
			sql_query("INSERT INTO ".sql_table('config')." VALUES ('AdminCSS', 'original')");
			$CONF['AdminCSS'] = 'original';
		}

        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET ?>" />
            <meta name="robots" content="noindex, nofollow" />
            <title><?php echo hsc($CONF['SiteName'])?> - Admin</title>
            <link rel="stylesheet" title="Nucleus Admin Default" type="text/css" href="<?php echo $baseUrl?>styles/admin_<?php echo $CONF["AdminCSS"]?>.css" />
            <link rel="stylesheet" title="Nucleus Admin Default" type="text/css"
            href="<?php echo $baseUrl?>styles/addedit.css" />

            <script type="text/javascript" src="<?php echo $baseUrl?>javascript/edit.js"></script>
            <script type="text/javascript" src="<?php echo $baseUrl?>javascript/admin.js"></script>
            <script type="text/javascript" src="<?php echo $baseUrl?>javascript/compatibility.js"></script>

      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
      <meta http-equiv="Expires" content="-1" />

            <?php echo $extrahead?>
        </head>
        <body>
        <div id="adminwrapper">
        <div class="header">
        <h1><?php echo hsc($CONF['SiteName'])?></h1>
        </div>
        <div id="container">
        <div id="content">
        <div class="loginname">
        <?php           if ($member->isLoggedIn())
                echo _LOGGEDINAS . ' ' . $member->getDisplayName()
                    ." - <a href='index.php?action=logout'>" . _LOGOUT. "</a>"
                    . "<br /><a href='index.php?action=overview'>" . _ADMINHOME . "</a> - ";
            else
                echo '<a href="index.php?action=showlogin" title="Log in">' , _NOTLOGGEDIN , '</a> <br />';

            echo "<a href='".$CONF['IndexURL']."'>"._YOURSITE."</a>";

            echo '<br />(';

            $codenamestring = ($nucleus['codename']!='')? ' &quot;'.$nucleus['codename'].'&quot;':'';

            if ($member->isLoggedIn() && $member->isAdmin()) {
                $checkURL = sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
                echo '<a href="' . $checkURL . '" title="' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE . '">Nucleus CMS ' . $nucleus['version'] . $codenamestring . '</a>';
                $newestVersion = getLatestVersion();
                $newestCompare = str_replace('/','.',$newestVersion);
                $newestCompare = floatval($newestCompare);
                $newestCompare = sprintf('%04.2f', $newestCompare);
                $currentVersion = str_replace(array('/','v'),array('.',''),$nucleus['version']);
                $currentVersion = sprintf('%04.2f', $currentVersion);
                if ($newestVersion && version_compare($newestCompare,$currentVersion) > 0) {
                    echo '<br /><a style="color:red" href="http://nucleuscms.org/upgrade.php" title="'._ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE.'">'._ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT.$newestVersion.'</a>';
                }
            } else {
                echo 'Nucleus CMS ' . $nucleus['version'] . $codenamestring;
            }
            echo ')';
        echo '</div>';
    }

    /**
     * @todo document this
     */
    function pagefoot() {
        global $action, $member, $manager;

		$data = array(
			'action' => $this->action
		);
		$manager->notify('AdminPrePageFoot', $data);

        if ($member->isLoggedIn() && ($action != 'showlogin')) {
            ?>
            <h2><?php echo  _LOGOUT ?></h2>
            <ul>
                <li><a href="index.php?action=overview"><?php echo  _BACKHOME?></a></li>
                <li><a href='index.php?action=logout'><?php echo  _LOGOUT?></a></li>
            </ul>
            <?php       }
        ?>
            <div class="foot">
                <a href="<?php echo _ADMINPAGEFOOT_OFFICIALURL ?>">Nucleus CMS</a> &copy; 2002-<?php echo date('Y') . ' ' . _ADMINPAGEFOOT_COPYRIGHT; ?>
                -
                <a href="<?php echo _ADMINPAGEFOOT_DONATEURL ?>"><?php echo _ADMINPAGEFOOT_DONATE ?></a>
            </div>

            </div><!-- content -->

            <div id="quickmenu">

                <?php               // ---- user settings ----
                if (($action != 'showlogin') && ($member->isLoggedIn())) {
                    echo '<ul>';
                    echo '<li><a href="index.php?action=overview">',_QMENU_HOME,'</a></li>';
                    echo '</ul>';

                    echo '<h2>',_QMENU_ADD,'</h2>';
                    echo '<form method="get" action="index.php"><div>';
                    echo '<input type="hidden" name="action" value="createitem" />';

                        $showAll = requestVar('showall');
                        if (($member->isAdmin()) && ($showAll == 'yes')) {
                            // Super-Admins have access to all blogs! (no add item support though)
                            $query =  'SELECT bnumber as value, bname as text'
                                   . ' FROM ' . sql_table('blog')
                                   . ' ORDER BY bname';
                        } else {
                            $query =  'SELECT bnumber as value, bname as text'
                                   . ' FROM ' . sql_table('blog') . ', ' . sql_table('team')
                                   . ' WHERE tblog=bnumber and tmember=' . $member->getID()
                                   . ' ORDER BY bname';
                        }
                        $template['name'] = 'blogid';
                        $template['tabindex'] = 15000;
                        $template['extra'] = _QMENU_ADD_SELECT;
                        $template['selected'] = -1;
                        $template['shorten'] = 10;
                        $template['shortenel'] = '';
                        $template['javascript'] = 'onchange="return form.submit()"';
                        showlist($query,'select',$template);

                    echo '</div></form>';

                    echo '<h2>' . $member->getDisplayName(). '</h2>';
                    echo '<ul>';
                    echo '<li><a href="index.php?action=editmembersettings">' . _QMENU_USER_SETTINGS . '</a></li>';
                    echo '<li><a href="index.php?action=browseownitems">' . _QMENU_USER_ITEMS . '</a></li>';
                    echo '<li><a href="index.php?action=browseowncomments">' . _QMENU_USER_COMMENTS . '</a></li>';
                    echo '</ul>';




                    // ---- general settings ----
                    if ($member->isAdmin()) {

                        echo '<h2>',_QMENU_MANAGE,'</h2>';

                        echo '<ul>';
                        echo '<li><a href="index.php?action=actionlog">' . _QMENU_MANAGE_LOG . '</a></li>';
                        echo '<li><a href="index.php?action=settingsedit">' . _QMENU_MANAGE_SETTINGS . '</a></li>';
                        echo '<li><a href="index.php?action=systemoverview">' . _QMENU_MANAGE_SYSTEM . '</a></li>';
                        echo '<li><a href="index.php?action=usermanagement">' . _QMENU_MANAGE_MEMBERS . '</a></li>';
                        echo '<li><a href="index.php?action=createnewlog">' . _QMENU_MANAGE_NEWBLOG . '</a></li>';
                        echo '<li><a href="index.php?action=backupoverview">' . _QMENU_MANAGE_BACKUPS . '</a></li>';
                        echo '<li><a href="index.php?action=pluginlist">' . _QMENU_MANAGE_PLUGINS . '</a></li>';
                        echo '</ul>';

                        echo '<h2>',_QMENU_LAYOUT,'</h2>';
                        echo '<ul>';
                        echo '<li><a href="index.php?action=skinoverview">' . _QMENU_LAYOUT_SKINS . '</a></li>';
                        echo '<li><a href="index.php?action=templateoverview">' . _QMENU_LAYOUT_TEMPL . '</a></li>';
                        echo '<li><a href="index.php?action=skinieoverview">' . _QMENU_LAYOUT_IEXPORT . '</a></li>';
                        echo '</ul>';

                    }

                    $aPluginExtras = array();
					$data = array(
						'options' => &$aPluginExtras
					);
					$manager->notify('QuickMenu', $data);
                    if (count($aPluginExtras) > 0)
                    {
                        echo '<h2>', _QMENU_PLUGINS, '</h2>';
                        echo '<ul>';
                        foreach ($aPluginExtras as $aInfo)
                        {
                            echo '<li><a href="'.hsc($aInfo['url']).'" title="'.hsc($aInfo['tooltip']).'">'.hsc($aInfo['title']).'</a></li>';
                        }
                        echo '</ul>';
                    }

                } else if (($action == 'activate') || ($action == 'activatesetpwd')) {

                    echo '<h2>', _QMENU_ACTIVATE, '</h2>', _QMENU_ACTIVATE_TEXT;
                } else {
                    // introduction text on login screen
                    echo '<h2>', _QMENU_INTRO, '</h2>', _QMENU_INTRO_TEXT;
                }
                ?>
            </div>

            <!-- content / quickmenu container -->
            <div class="clear"></div>    <!-- new -->
            </div>

            <!-- adminwrapper -->    <!-- new -->
            </div>     <!-- new -->
            </body> 
            </html>
        <?php   }

    /**
     * @todo document this
     */
    function action_regfile() {
        global $member, $CONF;

        $blogid = intRequestVar('blogid');

        $member->teamRights($blogid) or $this->disallow();

        // header-code stolen from phpMyAdmin
        // REGEDIT and bookmarklet code stolen from GreyMatter

        $sjisBlogName = sprintf(_WINREGFILE_TEXT, getBlogNameFromID($blogid));


        header('Content-Type: application/octetstream');
        header('Content-Disposition: filename="nucleus.reg"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "REGEDIT4\n";
        echo "[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\" . $sjisBlogName . "]\n";
        echo '@="' . $CONF['AdminURL'] . "bookmarklet.php?action=contextmenucode&blogid=".intval($blogid)."\"\n";
        echo '"contexts"=hex:31';
    }

    /**
     * @todo document this
     */
    function action_bookmarklet() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->teamRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);
        $bm = getBookmarklet($blogid);

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';

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
                $url = 'index.php?action=regfile&blogid=' . intval($blogid);
                $url = $manager->addTicketToUrl($url);
            ?>
            <?php echo _BOOKMARKLET_RIGHTTEXT1 . '<a href="' . hsc($url) . '">' . _BOOKMARKLET_RIGHTLABEL . '</a>' . _BOOKMARKLET_RIGHTTEXT2; ?>
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
    function action_actionlog() {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

        $url = $manager->addTicketToUrl('index.php?action=clearactionlog');

        ?>
            <h2><?php echo _ACTIONLOG_CLEAR_TITLE?></h2>
            <p><a href="<?php echo hsc($url)?>"><?php echo _ACTIONLOG_CLEAR_TEXT?></a></p>
        <?php
        echo '<h2>' . _ACTIONLOG_TITLE . '</h2>';

        $query =  'SELECT * FROM '.sql_table('actionlog').' ORDER BY timestamp DESC';
        $template['content'] = 'actionlist';
        $amount = showlist($query,'table',$template);

        $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_banlist() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);

        $this->pagehead();

        echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';

        echo '<h2>' . _BAN_TITLE . " '". $this->bloglink($blog) ."'</h2>";

        $query =  'SELECT * FROM '.sql_table('ban').' WHERE blogid='.$blogid.' ORDER BY iprange';
        $template['content'] = 'banlist';
        $amount = showlist($query,'table',$template);

        if ($amount == 0)
            echo _BAN_NONE;

        echo '<h2>'._BAN_NEW_TITLE.'</h2>';
        echo "<p><a href='index.php?action=banlistnew&amp;blogid=$blogid'>"._BAN_NEW_TEXT."</a></p>";


        $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_banlistdelete() {
        global $member, $manager;

        $blogid = intRequestVar('blogid');
        $iprange = requestVar('iprange');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);
        $banBlogName =  hsc($blog->getName());

        $this->pagehead();
        ?>
            <h2><?php echo _BAN_REMOVE_TITLE?></h2>

            <form method="post" action="index.php">

            <h3><?php echo _BAN_IPRANGE?></h3>

            <p>
                <?php echo _CONFIRMTXT_BAN?> <?php echo hsc($iprange) ?>
                <input name="iprange" type="hidden" value="<?php echo hsc($iprange)?>" />
            </p>

            <h3><?php echo _BAN_BLOGS?></h3>

            <div>
                <input type="hidden" name="blogid" value="<?php echo $blogid?>" />
                <input name="allblogs" type="radio" value="0" id="allblogs_one" />
                <label for="allblogs_one"><?php echo sprintf(_BAN_BANBLOGNAME, $banBlogName) ?></label>
                <br />
                <input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS?></label>
            </div>

            <h3><?php echo _BAN_DELETE_TITLE?></h3>

            <div>
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="action" value="banlistdeleteconfirm" />
                <input type="submit" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div>

            </form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_banlistdeleteconfirm() {
        global $member, $manager;

        $blogid = intPostVar('blogid');
        $allblogs = postVar('allblogs');
        $iprange = postVar('iprange');

        $member->blogAdminRights($blogid) or $this->disallow();

        $deleted = array();

        if (!$allblogs) {
            if (BAN::removeBan($blogid, $iprange))
                array_push($deleted, $blogid);
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            foreach ($adminblogs as $blogje) {
                if (BAN::removeBan($blogje, $iprange))
                    array_push($deleted, $blogje);
            }
        }

        if (sizeof($deleted) == 0)
            $this->error(_ERROR_DELETEBAN);

        $this->pagehead();

        echo '<a href="index.php?action=banlist&amp;blogid=',$blogid,'">(',_BACK,')</a>';
        echo '<h2>'._BAN_REMOVED_TITLE.'</h2>';
        echo "<p>"._BAN_REMOVED_TEXT."</p>";

        echo "<ul>";
        foreach ($deleted as $delblog) {
            $b =& $manager->getBlog($delblog);
            echo "<li>" . hsc($b->getName()). "</li>";
        }
        echo "</ul>";

        $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_banlistnewfromitem() {
        $this->action_banlistnew(getBlogIDFromItemID(intRequestVar('itemid')));
    }

    /**
     * @todo document this
     */
    function action_banlistnew($blogid = '') {
        global $member, $manager;

        if ($blogid == '')
            $blogid = intRequestVar('blogid');

        $ip = requestVar('ip');

        $member->blogAdminRights($blogid) or $this->disallow();

        $blog =& $manager->getBlog($blogid);

        $this->pagehead();
        ?>
        <h2><?php echo _BAN_ADD_TITLE?></h2>


        <form method="post" action="index.php">

        <h3><?php echo _BAN_IPRANGE?></h3>

        <p><?php echo _BAN_IPRANGE_TEXT?></p>

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

        <h3><?php echo _BAN_BLOGS?></h3>

        <p><?php echo _BAN_BLOGS_TEXT?></p>

        <div>
            <input type="hidden" name="blogid" value="<?php echo $blogid?>" />
            <input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">'<?php echo hsc($blog->getName())?>'</label>
            <br />
            <input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS?></label>
        </div>

        <h3><?php echo _BAN_REASON_TITLE?></h3>

        <p><?php echo _BAN_REASON_TEXT?></p>

        <div><textarea name="reason" cols="40" rows="5"></textarea></div>

        <h3><?php echo _BAN_ADD_TITLE?></h3>

        <div>
            <input name="action" type="hidden" value="banlistadd" />
            <?php $manager->addTicketHidden() ?>
            <input type="submit" value="<?php echo _BAN_ADD_BTN?>" />
        </div>

        </form>

        <?php       $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_banlistadd() {
        global $member;

        $blogid =       intPostVar('blogid');
        $allblogs =     postVar('allblogs');
        $iprange =      postVar('iprange');
        if ($iprange == "custom")
            $iprange = postVar('customiprange');
        $reason =       postVar('reason');

        $member->blogAdminRights($blogid) or $this->disallow();

        // TODO: check IP range validity

        if (!$allblogs) {
            if (!BAN::addBan($blogid, $iprange, $reason))
                $this->error(_ERROR_ADDBAN);
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            $failed = 0;
            foreach ($adminblogs as $blogje) {
                if (!BAN::addBan($blogje, $iprange, $reason))
                    $failed = 1;
            }
            if ($failed)
                $this->error(_ERROR_ADDBAN);
        }

        $this->action_banlist();

    }

    /**
     * @todo document this
     */
    function action_clearactionlog() {
        global $member;

        $member->isAdmin() or $this->disallow();

        ACTIONLOG::clear();

        $this->action_manage(_MSG_ACTIONLOGCLEARED);
    }

    /**
     * @todo document this
     */
    function action_backupoverview() {
        global $member, $manager;

        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
        ?>
        <h2><?php echo _BACKUPS_TITLE?></h2>

        <h3><?php echo _BACKUP_TITLE?></h3>

        <p><?php echo _BACKUP_INTRO?></p>

        <form method="post" action="index.php"><p>
        <input type="hidden" name="action" value="backupcreate" />
        <?php $manager->addTicketHidden() ?>

        <input type="radio" name="gzip" value="1" checked="checked" id="gzip_yes" tabindex="10" /><label for="gzip_yes"><?php echo _BACKUP_ZIP_YES?></label>
        <br />
        <input type="radio" name="gzip" value="0" id="gzip_no" tabindex="10" /><label for="gzip_no" ><?php echo _BACKUP_ZIP_NO?></label>
        <br /><br />
        <input type="submit" value="<?php echo _BACKUP_BTN?>" tabindex="20" />

        </p></form>

        <div class="note"><?php echo _BACKUP_NOTE?></div>


        <h3><?php echo _RESTORE_TITLE?></h3>

        <div class="note"><?php echo _RESTORE_NOTE?></div>

        <p><?php echo _RESTORE_INTRO?></p>

        <form method="post" action="index.php" enctype="multipart/form-data"><p>
            <input type="hidden" name="action" value="backuprestore" />
            <?php $manager->addTicketHidden() ?>
            <input name="backup_file" type="file" tabindex="30" />
            <br /><br />
            <input type="submit" value="<?php echo _RESTORE_BTN?>" tabindex="40" />
            <br /><input type="checkbox" name="letsgo" value="1" id="letsgo" tabindex="50" /><label for="letsgo"><?php echo _RESTORE_IMSURE?></label>
            <br /><?php echo _RESTORE_WARNING?>
        </p></form>

        <?php       $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_backupcreate() {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        // use compression ?
        $useGzip = intval(postVar('gzip'));

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
    function action_backuprestore() {
        global $member, $DIR_LIBS;

        $member->isAdmin() or $this->disallow();

        if (intPostVar('letsgo') != 1)
            $this->error(_ERROR_BACKUP_NOTSURE);

        include($DIR_LIBS . 'backup.php');

        // try to extend time limit
        // (creating/restoring dumps might take a while)
        @set_time_limit(1200);

        $bu = new Backup();
        $message = $bu->do_restore();
        if ($message != '')
            $this->error($message);

        $this->pagehead();
        ?>
        <h2><?php echo _RESTORE_COMPLETE?></h2>
        <?php       $this->pagefoot();

    }

    /**
     * @todo document this
     */
    function action_pluginlist() {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';

        echo '<h2>' , _PLUGS_TITLE_MANAGE , ' ', help('plugins'), '</h2>';

        echo '<h3>' , _PLUGS_TITLE_INSTALLED , ' &nbsp;&nbsp;<span style="font-size:smaller">', helplink('getplugins'), _PLUGS_TITLE_GETPLUGINS, '</a></span></h3>';


        $query =  'SELECT * FROM '.sql_table('plugin').' ORDER BY porder ASC';

        $template['content'] = 'pluginlist';
        $template['tabindex'] = 10;
        showlist($query, 'table', $template);

?>
			<h3><?php echo _PLUGS_TITLE_UPDATE?></h3>

			<p><?php echo _PLUGS_TEXT_UPDATE?></p>

			<form method="post" action="index.php"><div>
				<input type="hidden" name="action" value="pluginupdate" />
				<?php $manager->addTicketHidden() ?>
				<input type="submit" value="<?php echo _PLUGS_BTN_UPDATE ?>" tabindex="20" />
			</div></form>

			<h3><?php echo _PLUGS_TITLE_NEW?></h3>

<?php
		// find a list of possibly non-installed plugins
		$candidates = array();

		global $DIR_PLUGINS;

		$dirhandle = opendir($DIR_PLUGINS);

		while ($filename = readdir($dirhandle) )
		{

			# replaced ereg() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
			# original ereg: ereg('^NP_(.*)\.php$',$filename,$matches)

			if (preg_match('#^NP_(.*)\.php$#', $filename, $matches) )
			{

				$name = $matches[1];
				// only show in list when not yet installed
				$res = sql_query('SELECT * FROM ' . sql_table('plugin') . ' WHERE `pfile` = "NP_' . sql_real_escape_string($name) . '"');

				if (sql_num_rows($res) == 0)
				{
					array_push($candidates, $name);
				}

			}

		}

		closedir($dirhandle);

		if (sizeof($candidates) > 0)
		{
?>
			<p><?php echo _PLUGS_ADD_TEXT?></p>

			<form method='post' action='index.php'><div>
				<input type='hidden' name='action' value='pluginadd' />
				<?php $manager->addTicketHidden() ?>
				<select name="filename" tabindex="30">
<?php
			foreach($candidates as $name)
			{
				echo '<option value="NP_',$name,'">',hsc($name),'</option>';
			}
?>
				</select>
				<input type='submit' tabindex="40" value='<?php echo _PLUGS_BTN_INSTALL?>' />
			</div></form>

<?php
		}
		else
		{
			echo '<p>', _PLUGS_NOCANDIDATES, '</p>';
		}

		$this->pagefoot();

	}

    /**
     * @todo document this
     */
    function action_pluginhelp() {
        global $member, $manager, $DIR_PLUGINS, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');

        if (!$manager->pidInstalled($plugid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        $plugName = getPluginNameFromPid($plugid);

        $this->pagehead();

        echo '<p><a href="index.php?action=pluginlist">(',_PLUGS_BACK,')</a></p>';

        echo '<h2>',_PLUGS_HELP_TITLE,': ',hsc($plugName),'</h2>';

        $plug =& $manager->getPlugin($plugName);
        $cplugindir = $DIR_PLUGINS.$plug->getShortName() . '/';
        if(is_file("{$cplugindir}help.php"))
            $helpFile = "{$cplugindir}help.php";
        elseif(is_file("{$cplugindir}help.html"))
            $helpFile = "{$cplugindir}help.html";
        elseif(is_file("{$cplugindir}help/index.php"))
            $helpFile = "{$cplugindir}help/index.php";
        elseif(is_file("{$cplugindir}help/index.html"))
            $helpFile = "{$cplugindir}help/index.html";

        if ($plug->supportsFeature('HelpPage') > 0 && isset($helpFile)) {
            if(substr($helpFile,-4)==='.php') include_once($helpFile);
            else                              @readfile($helpFile);
        } else {
            echo '<p>Error: ', _ERROR_PLUGNOHELPFILE,'</p>';
            echo '<p><a href="index.php?action=pluginlist">(',_BACK,')</a></p>';
        }


        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_pluginadd() {
        global $member, $manager, $DIR_PLUGINS;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $name = postVar('filename');

        if ($manager->pluginInstalled($name))
            $this->error(_ERROR_DUPPLUGIN);
        if (!checkPlugin($name))
            $this->error(_ERROR_PLUGFILEERROR . ' (' . hsc($name) . ')');

        // get number of currently installed plugins
        $res = sql_query('SELECT * FROM '.sql_table('plugin'));
        $numCurrent = sql_num_rows($res);

        // plugin will be added as last one in the list
        $newOrder = $numCurrent + 1;

		$data = array(
			'file' => &$name
		);
		$manager->notify('PreAddPlugin', $data);

        // do this before calling getPlugin (in case the plugin id is used there)
        $query = 'INSERT INTO '.sql_table('plugin').' (porder, pfile) VALUES ('.$newOrder.',"'.sql_real_escape_string($name).'")';
        sql_query($query);
        $iPid = sql_insert_id();

        $manager->clearCachedInfo('installedPlugins');

        // Load the plugin for condition checking and instalation
        $plugin =& $manager->getPlugin($name);

        // check if it got loaded (could have failed)
        if (!$plugin)
        {
            sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE pid='. intval($iPid));
            $manager->clearCachedInfo('installedPlugins');
            $this->error(_ERROR_PLUGIN_LOAD);
        }

        // check if plugin needs a newer Nucleus version
        if (getNucleusVersion() < $plugin->getMinNucleusVersion())
        {
            // uninstall plugin again...
            $this->deleteOnePlugin($plugin->getID());

            // ...and show error
            $this->error(_ERROR_NUCLEUSVERSIONREQ . hsc($plugin->getMinNucleusVersion()));
        }

        // check if plugin needs a newer Nucleus version
        if ((getNucleusVersion() == $plugin->getMinNucleusVersion()) && (getNucleusPatchLevel() < $plugin->getMinNucleusPatchLevel()))
        {
            // uninstall plugin again...
            $this->deleteOnePlugin($plugin->getID());

            // ...and show error
            $this->error(_ERROR_NUCLEUSVERSIONREQ . hsc( $plugin->getMinNucleusVersion() . ' patch ' . $plugin->getMinNucleusPatchLevel() ) );
        }

        $pluginList = $plugin->getPluginDep();
        foreach ($pluginList as $pluginName)
        {

            $res = sql_query('SELECT * FROM '.sql_table('plugin') . ' WHERE pfile="' . $pluginName . '"');
            if (sql_num_rows($res) == 0)
            {
                // uninstall plugin again...
                $this->deleteOnePlugin($plugin->getID());

                $this->error(sprintf(_ERROR_INSREQPLUGIN, hsc($pluginName)));
            }
        }

        // call the install method of the plugin
        $plugin->install();

		$data = array(
			'plugin' => &$plugin
		);
		$manager->notify('PostAddPlugin', $data);

        // update all events
        $this->action_pluginupdate();
    }

    /**
     * @todo document this
     */
    function action_pluginupdate() {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        // delete everything from plugin_events
        sql_query('DELETE FROM '.sql_table('plugin_event'));

        // loop over all installed plugins
        $res = sql_query('SELECT pid, pfile FROM '.sql_table('plugin'));
        while($o = sql_fetch_object($res)) {
            $pid = $o->pid;
            $plug =& $manager->getPlugin($o->pfile);
            if ($plug)
            {
                $eventList = $plug->getEventList();
                foreach ($eventList as $eventName)
                    sql_query('INSERT INTO '.sql_table('plugin_event').' (pid, event) VALUES ('.$pid.', \''.sql_real_escape_string($eventName).'\')');
            }
        }

        redirect($CONF['AdminURL'] . '?action=pluginlist');
//		$this->action_pluginlist();
    }

    /**
     * @todo document this
     */
    function action_plugindelete() {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intGetVar('plugid');

        if (!$manager->pidInstalled($pid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM?></h2>

            <p><?php echo _CONFIRMTXT_PLUGIN?> <strong><?php echo getPluginNameFromPid($pid)?></strong>?</p>

            <form method="post" action="index.php"><div>
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="action" value="plugindeleteconfirm" />
            <input type="hidden" name="plugid" value="<?php echo $pid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }

    /**
     * @todo document this
     */
    function action_plugindeleteconfirm() {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intPostVar('plugid');

        $error = $this->deleteOnePlugin($pid, 1);
        if ($error) {
            $this->error($error);
        }

        redirect($CONF['AdminURL'] . '?action=pluginlist');
//		$this->action_pluginlist();
    }

    /**
     * @todo document this
     */
    function deleteOnePlugin($pid, $callUninstall = 0) {
        global $manager;

        $pid = intval($pid);

        if (!$manager->pidInstalled($pid))
            return _ERROR_NOSUCHPLUGIN;

        $name = quickQuery('SELECT pfile as result FROM '.sql_table('plugin').' WHERE pid='.$pid);

/*		// call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin =& $manager->getPlugin($name);
            if ($plugin) $plugin->unInstall();
        }*/

        // check dependency before delete
        $res = sql_query('SELECT pfile FROM '.sql_table('plugin'));
        while($o = sql_fetch_object($res)) {
            $plug =& $manager->getPlugin($o->pfile);
            if ($plug)
            {
                $depList = $plug->getPluginDep();
                foreach ($depList as $depName)
                {
                    if ($name == $depName)
                    {
                        return sprintf(_ERROR_DELREQPLUGIN, $o->pfile);
                    }
                }
            }
        }

		$data = array('plugid' => $pid);
		$manager->notify('PreDeletePlugin', $data);

        // call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin =& $manager->getPlugin($name);
            if ($plugin) $plugin->unInstall();
        }

        // delete all subscriptions
        sql_query('DELETE FROM '.sql_table('plugin_event').' WHERE pid=' . $pid);

        // delete all options
        // get OIDs from plugin_option_desc
        $res = sql_query('SELECT oid FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
        $aOIDs = array();
        while ($o = sql_fetch_object($res)) {
            array_push($aOIDs, $o->oid);
        }

        // delete from plugin_option and plugin_option_desc
        sql_query('DELETE FROM '.sql_table('plugin_option_desc').' WHERE opid=' . $pid);
        if (count($aOIDs) > 0)
            sql_query('DELETE FROM '.sql_table('plugin_option').' WHERE oid in ('.implode(',',$aOIDs).')');

        // update order numbers
        $res = sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid=' . $pid);
        $o = sql_fetch_object($res);
        sql_query('UPDATE '.sql_table('plugin').' SET porder=(porder - 1) WHERE porder>'.$o->porder);

        // delete row
        sql_query('DELETE FROM '.sql_table('plugin').' WHERE pid='.$pid);

        $manager->clearCachedInfo('installedPlugins');
		$data = array('plugid' => $pid);
		$manager->notify('PostDeletePlugin', $data);

        return '';
    }

    /**
     * @todo document this
     */
    function action_pluginup() {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');

        if (!$manager->pidInstalled($plugid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        // 1. get old order number
        $res = sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid);
        $o = sql_fetch_object($res);
        $oldOrder = $o->porder;

        // 2. calculate new order number
        $newOrder = ($oldOrder > 1) ? ($oldOrder - 1) : 1;

        // 3. update plug numbers
        sql_query('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);
        sql_query('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);

        //$this->action_pluginlist();
        // To avoid showing ticket in the URL, redirect to pluginlist, instead.
        redirect($CONF['AdminURL'] . '?action=pluginlist');
    }

    /**
     * @todo document this
     */
    function action_plugindown() {
        global $member, $manager, $CONF;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $plugid = intGetVar('plugid');
        if (!$manager->pidInstalled($plugid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        // 1. get old order number
        $res = sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid);
        $o = sql_fetch_object($res);
        $oldOrder = $o->porder;

        $res = sql_query('SELECT * FROM '.sql_table('plugin'));
        $maxOrder = sql_num_rows($res);

        // 2. calculate new order number
        $newOrder = ($oldOrder < $maxOrder) ? ($oldOrder + 1) : $maxOrder;

        // 3. update plug numbers
        sql_query('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);
        sql_query('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);

        //$this->action_pluginlist();
        // To avoid showing ticket in the URL, redirect to pluginlist, instead.
        redirect($CONF['AdminURL'] . '?action=pluginlist');
    }

    /**
     * @todo document this
     */
    function action_pluginoptions($message = '') {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intRequestVar('plugid');
        if (!$manager->pidInstalled($pid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $pluginName = hsc(getPluginNameFromPid($pid));
        $this->pagehead($extrahead);

        ?>
            <p><a href="index.php?action=pluginlist">(<?php echo _PLUGS_BACK?>)</a></p>

            <h2><?php echo sprintf(_PLUGIN_OPTIONS_TITLE, $pluginName) ?></h2>

            <?php if  ($message) echo $message?>

            <form action="index.php" method="post">
            <div>
                <input type="hidden" name="action" value="pluginoptionsupdate" />
                <input type="hidden" name="plugid" value="<?php echo $pid?>" />

        <?php

        $manager->addTicketHidden();

        $aOptions = array();
        $aOIDs = array();
        $query = 'SELECT * FROM ' . sql_table('plugin_option_desc') . ' WHERE ocontext=\'global\' and opid=' . $pid . ' ORDER BY oid ASC';
        $r = sql_query($query);
        while ($o = sql_fetch_object($r)) {
            array_push($aOIDs, $o->oid);
            $aOptions[$o->oid] = array(
                        'oid' => $o->oid,
                        'value' => $o->odef,
                        'name' => $o->oname,
                        'description' => $o->odesc,
                        'type' => $o->otype,
                        'typeinfo' => $o->oextra,
                        'contextid' => 0
            );
        }
        // fill out actual values
        if (count($aOIDs) > 0) {
            $r = sql_query('SELECT oid, ovalue FROM ' . sql_table('plugin_option') . ' WHERE oid in ('.implode(',',$aOIDs).')');
            while ($o = sql_fetch_object($r))
                $aOptions[$o->oid]['value'] = $o->ovalue;
        }

		// call plugins
		$data = array(
			'context'	=>  'global',
			'plugid'	=>  $pid,
			'options'	=> &$aOptions
		);
		$manager->notify('PrePluginOptionsEdit', $data);

        $template['content'] = 'plugoptionlist';
        $amount = showlist($aOptions,'table',$template);
        if ($amount == 0)
            echo '<p>',_ERROR_NOPLUGOPTIONS,'</p>';

        ?>
            </div>
            </form>
        <?php       $this->pagefoot();



    }

    /**
     * @todo document this
     */
    function action_pluginoptionsupdate() {
        global $member, $manager;

        // check if allowed
        $member->isAdmin() or $this->disallow();

        $pid = intRequestVar('plugid');
        if (!$manager->pidInstalled($pid))
            $this->error(_ERROR_NOSUCHPLUGIN);

        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);

		$data = array(
			'context'	=> 'global',
			'plugid'	=> $pid
		);
		$manager->notify('PostPluginOptionsUpdate', $data);

        $this->action_pluginoptions(_PLUGS_OPTIONS_UPDATED);
    }

    /**
     * @static
     * @todo document this
     */
    function _insertPluginOptions($context, $contextid = 0) {
        // get all current values for this contextid
        // (note: this might contain doubles for overlapping contextids)
        $aIdToValue = array();
        $res = sql_query('SELECT oid, ovalue FROM ' . sql_table('plugin_option') . ' WHERE ocontextid=' . intval($contextid));
        while ($o = sql_fetch_object($res)) {
            $aIdToValue[$o->oid] = $o->ovalue;
        }

        // get list of oids per pid
        $query = 'SELECT * FROM ' . sql_table('plugin_option_desc') . ',' . sql_table('plugin')
               . ' WHERE opid=pid and ocontext=\''.sql_real_escape_string($context).'\' ORDER BY porder, oid ASC';
        $res = sql_query($query);
        $aOptions = array();
        while ($o = sql_fetch_object($res)) {
            if (in_array($o->oid, array_keys($aIdToValue)))
                $value = $aIdToValue[$o->oid];
            else
                $value = $o->odef;

            array_push($aOptions, array(
                'pid' => $o->pid,
                'pfile' => $o->pfile,
                'oid' => $o->oid,
                'value' => $value,
                'name' => $o->oname,
                'description' => $o->odesc,
                'type' => $o->otype,
                'typeinfo' => $o->oextra,
                'contextid' => $contextid,
                'extra' => ''
            ));
        }

		global $manager;
		$data = array(
			'context'	=>  $context,
			'contextid'	=>  $contextid,
			'options'	=> &$aOptions
		);
		$manager->notify('PrePluginOptionsEdit', $data);


        $iPrevPid = -1;
        foreach ($aOptions as $aOption) {

            // new plugin?
            if ($iPrevPid != $aOption['pid']) {
                $iPrevPid = $aOption['pid'];
                if (!defined('_PLUGIN_OPTIONS_TITLE')) {
                    define('_PLUGIN_OPTIONS_TITLE', 'Options for %s');
                }
                echo '<tr><th colspan="2">'.sprintf(_PLUGIN_OPTIONS_TITLE, hsc($aOption['pfile'])).'</th></tr>';
            }

            $meta = NucleusPlugin::getOptionMeta($aOption['typeinfo']);
            if (@$meta['access'] != 'hidden') {
                echo '<tr>';
                listplug_plugOptionRow($aOption);
                echo '</tr>';
            }

        }


    }

    /**
     * Helper functions to create option forms etc.
     * @todo document parameters
     */
    function input_yesno($name, $checkedval,$tabindex = 0, $value1 = 1, $value2 = 0, $yesval = _YES, $noval = _NO, $isAdmin = 0) {
        $id = hsc($name);
        $id = str_replace('[','-',$id);
        $id = str_replace(']','-',$id);
        $id1 = $id . hsc($value1);
        $id2 = $id . hsc($value2);

        if ($name=="admin") {
            echo '<input onclick="selectCanLogin(true);" type="radio" name="', hsc($name),'" value="', hsc($value1),'" ';
        } else {
            echo '<input type="radio" name="', hsc($name),'" value="', hsc($value1),'" ';
        }

            if ($checkedval == $value1)
                echo "tabindex='$tabindex' checked='checked'";
            echo ' id="'.$id1.'" /><label for="'.$id1.'">' . $yesval . '</label>';
        echo ' ';
        if ($name=="admin") {
            echo '<input onclick="selectCanLogin(false);" type="radio" name="', hsc($name),'" value="', hsc($value2),'" ';
        } else {
            echo '<input type="radio" name="', hsc($name),'" value="', hsc($value2),'" ';
        }
            if ($checkedval != $value1)
                echo "tabindex='$tabindex' checked='checked'";
            if ($isAdmin && $name=="canlogin")
                echo ' disabled="disabled"';
            echo ' id="'.$id2.'" /><label for="'.$id2.'">' . $noval . '</label>';
    }

} // class ADMIN

?>
