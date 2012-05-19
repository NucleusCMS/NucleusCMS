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
 * @version $Id: ADMIN.php 1661 2012-02-12 11:55:39Z sakamocchi $

 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/showlist.php';

/**
 * Builds the admin area and executes admin actions
 */
class Admin
{
	private $xml_version_info = '1.0';
	private $formal_public_identifier = '-//W3C//DTD XHTML 1.0 Strict//EN';
	private $system_identifier = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd';
	private $xhtml_namespace = 'http://www.w3.org/1999/xhtml';
	
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
        $aActionsToCheck = array('additem', 'itemupdate', 'itemmoveto', 'categoryupdate', 'categorydeleteconfirm', 'itemdeleteconfirm', 'commentdeleteconfirm', 'teamdeleteconfirm', 'memberdeleteconfirm', 'templatedeleteconfirm', 'skindeleteconfirm', 'banlistdeleteconfirm', 'plugindeleteconfirm', 'batchitem', 'batchcomment', 'batchmember', 'batchcategory', 'batchteam', 'commentupdate', 'banlistadd', 'changemembersettings', 'clearactionlog', 'settingsupdate', 'blogsettingsupdate', 'categorynew', 'teamchangeadmin', 'teamaddmember', 'memberadd', 'addnewlog', 'addnewlog2', 'backupcreate', 'backuprestore', 'pluginup', 'plugindown', 'pluginupdate', 'pluginadd', 'pluginoptionsupdate', 'skinupdate', 'skinclone', 'skineditgeneral', 'templateclone', 'templatenew', 'templateupdate', 'skinieimport', 'skinieexport', 'skiniedoimport', 'skinnew', 'deleteblogconfirm', 'activatesetpwd');
*/
        if (!in_array($this->action, $aActionsNotToCheck))
        {
            if (!$manager->checkTicket())
                $this->error(_ERROR_BADTICKET);
        }

        if (method_exists($this, $methodName))
            call_user_func(array(&$this, $methodName));
        else
            $this->error(_BADACTION . Entity::hsc(" ($action)"));

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
        if ($msg) echo _MESSAGE , ': ', Entity::hsc($msg);
        ?>

        <form action="index.php" method="post"><p>
        <?php echo _LOGIN_NAME; ?> <br /><input name="login"  tabindex="10" />
        <br />
        <?php echo _LOGIN_PASSWORD; ?> <br /><input name="password"  tabindex="20" type="password" />
        <br />
        <input name="action" value="login" type="hidden" />
        <br />
        <input type="submit" value="<?php echo _LOGIN ?>" tabindex="30" />
        <br />
        <small>
            <input type="checkbox" value="1" name="shared" tabindex="40" id="shared" /><label for="shared"><?php echo _LOGIN_SHARED ?></label>
            <br /><a href="forgotpassword.html"><?php echo _LOGIN_FORGOT ?></a>
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
            $total = DB::getValue('SELECT COUNT(*) as result FROM ' . sql_table('blog'));
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
        return '<a href="'.Entity::hsc($blog->getURL()).'" title="'._BLOGLIST_TT_VISIT.'">'. Entity::hsc( $blog->getName() ) .'</a>';
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
	 * Admin::action_itemlist()
	 * 
	 * @param	integer	$blogid	ID for weblog
	 * @return	void
	 */
	public function action_itemlist($blogid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $blogid == '' )
		{
			$blogid = intRequestVar('blogid');
		}
		
		$member->teamRights($blogid) or $member->isAdmin() or $this->disallow();
		
		$this->pagehead();
		$blog =& $manager->getBlog($blogid);
		
		echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
		echo '<h2>' . _ITEMLIST_BLOG . ' ' . $this->bloglink($blog) . '</h2>';
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		if ( $start == 0 )
		{
			echo '<p><a href="index.php?action=createitem&amp;blogid='.$blogid.'">' . _ITEMLIST_ADDNEW . "</a></p>\n";
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = intval($CONF['DefaultListSize']);
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$search = postVar('search');	// search through items
		
		$query = 'SELECT bshortname, cname, mname, ititle, ibody, inumber, idraft, itime'
		       . ' FROM ' . sql_table('item') . ', ' . sql_table('blog') . ', ' . sql_table('member') . ', ' . sql_table('category')
		       . ' WHERE iblog=bnumber and iauthor=mnumber and icat=catid and iblog=' . $blogid;
		
		if ( $search )
		{
			$query .= " AND ((ititle LIKE " . DB::quoteValue('%'.$search.'%') . ") OR (ibody LIKE " . DB::quoteValue('%'.$search.'%') . ") OR (imore LIKE " . DB::quoteValue('%'.$search.'%') . "))";
		}
		
		// non-blog-admins can only edit/delete their own items
		if ( !$member->blogAdminRights($blogid) )
		{
			$query .= ' and iauthor=' . $member->getID();
		}
		
		$query .= ' ORDER BY itime DESC'
		        . " LIMIT $start, $amount";
		
		$template['content'] = 'itemlist';
		$template['now'] = $blog->getCorrectTime(time());
		
		$manager->loadClass("ENCAPSULATE");
		$navList = new NavList('itemlist', $start, $amount, 0, 1000, $blogid, $search, 0);
		$navList->showBatchList('item',$query,'table',$template);
		
		$this->pagefoot();
		return;
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
        echo '<p>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b></p>';
        echo '<ul>';


        // walk over all itemids and perform action
        foreach ($selected as $itemid) {
            $itemid = intval($itemid);
            echo '<li>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b> ',_BATCH_ONITEM,' <b>', $itemid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneItem($itemid);
                    break;
                case 'move':
                    $error = $this->moveOneItem($itemid, $destCatid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . Entity::hsc($action);
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
        echo '<p>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $commentid) {
            $commentid = intval($commentid);
            echo '<li>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b> ',_BATCH_ONCOMMENT,' <b>', $commentid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneComment($commentid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . Entity::hsc($action);
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
        echo '<p>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = intval($memberid);
            echo '<li>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b> ',_BATCH_ONMEMBER,' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneMember($memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    DB::execute('UPDATE ' . sql_table('member') . ' SET madmin=1 WHERE mnumber='.$memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one super-admin
                    $r = DB::getResult('SELECT * FROM '.sql_table('member'). ' WHERE madmin=1 and mcanlogin=1');
                    if ($r->rowCount() < 2)
                        $error = _ERROR_ATLEASTONEADMIN;
                    else
                        DB::execute('UPDATE ' . sql_table('member') .' SET madmin=0 WHERE mnumber='.$memberid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . Entity::hsc($action);
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
        echo '<p>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $memberid) {
            $memberid = intval($memberid);
            echo '<li>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b> ',_BATCH_ONTEAM,' <b>', $memberid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneTeamMember($blogid, $memberid);
                    break;
                case 'setadmin':
                    // always succeeds
                    DB::execute('UPDATE '.sql_table('team').' SET tadmin=1 WHERE tblog='.$blogid.' and tmember='.$memberid);
                    $error = '';
                    break;
                case 'unsetadmin':
                    // there should always remain at least one admin
                    $r = DB::getResult('SELECT * FROM '.sql_table('team').' WHERE tadmin=1 and tblog='.$blogid);
                    if ($r->rowCount() < 2)
                        $error = _ERROR_ATLEASTONEBLOGADMIN;
                    else
                        DB::execute('UPDATE '.sql_table('team').' SET tadmin=0 WHERE tblog='.$blogid.' and tmember='.$memberid);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . Entity::hsc($action);
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
        echo '<p>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b></p>';
        echo '<ul>';

        // walk over all itemids and perform action
        foreach ($selected as $catid) {
            $catid = intval($catid);
            echo '<li>',_BATCH_EXECUTING,' <b>',Entity::hsc($action),'</b> ',_BATCH_ONCATEGORY,' <b>', $catid, '</b>...';

            // perform action, display errors if needed
            switch($action) {
                case 'delete':
                    $error = $this->deleteOneCategory($catid);
                    break;
                case 'move':
                    $error = $this->moveOneCategory($catid, $destBlogId);
                    break;
                default:
                    $error = _BATCH_UNKNOWN . Entity::hsc($action);
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
        <h2><?php echo _MOVE_TITLE ?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type ?>" />
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


            <input type="submit" value="<?php echo _MOVE_BTN ?>" onclick="return checkSubmit();" />

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
        <h2><?php echo _MOVECAT_TITLE ?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type ?>" />
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


            <input type="submit" value="<?php echo _MOVECAT_BTN ?>" onclick="return checkSubmit();" />

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
        <h2><?php echo _BATCH_DELETE_CONFIRM ?></h2>
        <form method="post" action="index.php"><div>

            <input type="hidden" name="action" value="batch<?php echo $type ?>" />
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

            <input type="submit" value="<?php echo _BATCH_DELETE_CONFIRM_BTN ?>" onclick="return checkSubmit();" />

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
        Admin::selectBlog($name, 'category', $selected, $tabindex, $showNewCat, $iForcedBlogInclude);
    }

	/**
	 * Admin::selectBlog()
	 * Inserts a HTML select element with choices for all blogs to which the user has access
	 *  mode = 'blog' => shows blognames and values are blogids
	 *  mode = 'category' => show category names and values are catids
	 * 
	 * @param	string	$name				name of 
	 * @param	string	$mode				blog/category
	 * @param	integer	$selected			category ID to be selected
	 * @param	integer	$tabindex			tab index value
	 * @param	integer	$showNewCat			show category to newly be created
	 * @param	integer	$iForcedBlogInclude	ID of a blog that always needs to be included,
	 * 						without checking if the member is on the blog team (-1 = none)
	 * @return	void
	 */
	public function selectBlog($name, $mode='blog', $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1)
	{
		global $member, $CONF;
		
		// 0. get IDs of blogs to which member can post items (+ forced blog)
		$aBlogIds = array();
		if ( $iForcedBlogInclude != -1 )
		{
			$aBlogIds[] = intval($iForcedBlogInclude);
		}
		
		if ( !$member->isAdmin() || !array_key_exists('ShowAllBlogs', $CONF) || !$CONF['ShowAllBlogs'] )
		{
			$query = "SELECT bnumber FROM %s,%s WHERE tblog=bnumber and tmember=%d;";
			$query = sprintf($query, sql_table('blog'), sql_table('team'), (integer) $member->getID());
		}
		else
		{
			$query = "SELECT bnumber FROM %s ORDER BY bname;";
			$query = sprintf($query, sql_table('blog'));
		}
		
		$rblogids = DB::getResult($query);
		foreach ( $rblogids as $row )
		{
			if ( $row['bnumber'] != $iForcedBlogInclude )
			{
				$aBlogIds[] = (integer) $row['bnumber'];
			}
		}
		if ( count($aBlogIds) == 0 )
		{
			return;
		}
		
		echo "<select name=\"{$name}\" tabindex=\"{$tabindex}\">\n";
		
		// 1. select blogs (we'll create optiongroups)
		// (only select those blogs that have the user on the team)
		$query = "SELECT bnumber, bname FROM %s WHERE bnumber in (%s) ORDER BY bname;";
		$query = sprintf($query, sql_table('blog'), implode(',',$aBlogIds));
		$blogs = DB::getResult($query);
		
		if ( $mode == 'category' )
		{
			$multipleBlogs = ($blogs->rowCount() > 1);
			
			foreach ( $blogs as $row )
			{
				if ( $multipleBlogs )
				{
					echo '<optgroup label="' . Entity::hsc($row['bname']) . '">' . "\n";
				}
				
				// show selection to create new category when allowed/wanted
				if ( $showNewCat )
				{
					// check if allowed to do so
					if ( $member->blogAdminRights($row['bnumber']) )
					{
						echo "<option value=\"newcat-{$row['bnumber']}\">" . _ADD_NEWCAT . "</option>\n";
					}
				}
				
				// 2. for each category in that blog
				$query = "SELECT cname, catid FROM %s WHERE cblog=%d ORDER BY cname ASC;";
				$query = sprintf($query, sql_table('category'), (integer) $row['bnumber']);
				$categories = DB::getResult($query);
				foreach ( $categories as $cat )
				{
					if ( $cat['catid'] != $selected )
					{
					echo "<option value=\"{$cat['catid']}\" {$selectText} >" . Entity::hsc($cat['cname']) . "</option>\n";
					}
					else
					{
					echo "<option value=\"{$cat['catid']}\" selected=\"selected\" >" . Entity::hsc($cat['cname']) . "</option>\n";
					}
				}
				
				if ( $multipleBlogs )
				{
					echo "</optgroup>\n";
				}
			}
		}
		else
		{
			// blog mode
			foreach ( $blogs as $row )
			{
				if ( $row['bnumber'] != $selected )
				{
					echo "<option value=\"{$row['bnumber']}\">" . Entity::hsc($row['bname']) . "</option>\n";
				}
				else
				{
					echo "<option value=\"{$row['bnumber']}\" selected=\"selected\">" . Entity::hsc($row['bname']) . "</option>\n";
				}
			}
		}
		echo "</select>\n";
		return;
	}
	
	/**
	 * Admin::action_browseownitems()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_browseownitems()
	{
		global $member, $manager, $CONF;
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(' . _BACKHOME . ")</a></p>\n";
		echo '<h2>' . _ITEMLIST_YOUR . "</h2>\n";
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = (integer) $CONF['DefaultListSize'];
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$search = postVar('search');	// search through items
		
		$query = 'SELECT bshortname, cname, mname, ititle, ibody, idraft, inumber, itime'
		       . ' FROM '.sql_table('item').', '.sql_table('blog') . ', '.sql_table('member') . ', '.sql_table('category')
		       . ' WHERE iauthor='. $member->getID() .' and iauthor=mnumber and iblog=bnumber and icat=catid';
		
		if ( $search )
		{
			$query .= " and ((ititle LIKE " . DB::quoteValue('%'.$search.'%') . ") or (ibody LIKE " . DB::quoteValue('%'.$search.'%') . ") or (imore LIKE " . DB::quoteValue('%'.$search.'%') . "))";
		}
		
		$query .= ' ORDER BY itime DESC'
		        . " LIMIT $start, $amount";
		
		$template['content'] = 'itemlist';
		$template['now'] = time();
		
		$manager->loadClass("ENCAPSULATE");
		$navList = new NavList('browseownitems', $start, $amount, 0, 1000, /*$blogid*/ 0, $search, 0);
		$navList->showBatchList('item',$query,'table',$template);
		
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_itemcommentlist()
	 * 
	 * Show all the comments for a given item
	 * @param	integer	$itemid	ID for item
	 * @return	void
	 */
	public function action_itemcommentlist($itemid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $itemid == '' )
		{
			$itemid = intRequestVar('itemid');
		}
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		$blogid = getBlogIdFromItemId($itemid);
		
		$this->pagehead();
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = (integer) $CONF['DefaultListSize'];
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$search = postVar('search');
		
		echo '<p>(<a href="index.php?action=itemlist&amp;blogid=' . $blogid . '">' . _BACKTOOVERVIEW . "</a>)</p>\n";
		echo '<h2>',_COMMENTS,'</h2>';
		
		$query = 'SELECT cbody, cuser, cmail, cemail, mname, ctime, chost, cnumber, cip, citem FROM ' . sql_table('comment') . ' LEFT OUTER JOIN ' . sql_table('member') . ' ON mnumber = cmember WHERE citem = ' . $itemid;
		
		if ( $search )
		{
			$query .= " and cbody LIKE " . DB::quoteValue('%'.$search.'%');
		}
		
		$query .= ' ORDER BY ctime ASC'
		        . " LIMIT $start,$amount";
		
		$template['content'] = 'commentlist';
		$template['canAddBan'] = $member->blogAdminRights(getBlogIDFromItemID($itemid));
		
		$manager->loadClass("ENCAPSULATE");
		$navList = new NavList('itemcommentlist', $start, $amount, 0, 1000, 0, $search, $itemid);
		$navList->showBatchList('comment',$query,'table',$template,_NOCOMMENTS);
		
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_browseowncomments()
	 * Browse own comments
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_browseowncomments()
	{
		global $member, $manager, $CONF;
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = intval($CONF['DefaultListSize']);
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$search = postVar('search');
		
		$query =  'SELECT cbody, cuser, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE cmember=' . $member->getID();
		
		if ( $search )
		{
			$query .= " and cbody LIKE " . DB::quoteValue('%'.$search.'%');
		}
		
		$query .= ' ORDER BY ctime DESC'
		        . " LIMIT $start,$amount";
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(' . _BACKHOME . ")</a></p>\n";
		echo '<h2>' . _COMMENTS_YOUR . "</h2>\n";
		
		$template['content'] = 'commentlist';
		$template['canAddBan'] = 0; // doesn't make sense to allow banning yourself
		
		$manager->loadClass("ENCAPSULATE");
		$navList = new NavList('browseowncomments', $start, $amount, 0, 1000, 0, $search, 0);
		$navList->showBatchList('comment',$query,'table',$template,_NOCOMMENTS_YOUR);
		
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_blogcommentlist()
	 * 
	 * Browse all comments for a weblog
	 * @param	integer	$blogid	ID for weblog
	 * @return	void
	 */
	function action_blogcommentlist($blogid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $blogid == '' )
		{
			$blogid = intRequestVar('blogid');
		}
		else
		{
			$blogid = intval($blogid);
		}
		
		$member->teamRights($blogid) or $member->isAdmin() or $this->disallow();
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = intval($CONF['DefaultListSize']);
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$search = postVar('search');		// search through comments
		
		$query =  'SELECT cbody, cuser, cemail, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE cblog=' . intval($blogid);
		
		if ( $search != '' )
		{
			$query .= " and cbody LIKE " . DB::quoteValue('%'.$search.'%');
		}
		
		$query .= ' ORDER BY ctime DESC'
		        . " LIMIT $start,$amount";
		
		$blog =& $manager->getBlog($blogid);
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(' . _BACKHOME . ")</a></p>\n";
		echo '<h2>', _COMMENTS_BLOG , ' ' , $this->bloglink($blog), '</h2>';
		
		$template['content'] = 'commentlist';
		$template['canAddBan'] = $member->blogAdminRights($blogid);
		
		$manager->loadClass("ENCAPSULATE");
		$navList = new NavList('blogcommentlist', $start, $amount, 0, 1000, $blogid, $search, 0);
		$navList->showBatchList('comment',$query,'table',$template, _NOCOMMENTS_BLOG);
		
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_createitem()
	 * Provide a page to item a new item to the given blog
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_createitem()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->teamRights($blogid) or $this->disallow();
		
		$memberid = $member->getID();
		
		$blog =& $manager->getBlog($blogid);
		
		// generate the add-item form
		$handler = new PageFactory($blog);
		
		$contents = $handler->getTemplateFor('admin', 'add');
		$manager->notify('PreAddItemForm', array('contents' => &$contents, 'blog' => &$blog));
		
		$parser = new Parser($handler);
		
		$this->pagehead();
		$parser->parse($contents);
		$this->pagefoot();
		
		return;
	}
	
	/**
	 * Admin::action_itemedit()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_itemedit()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		$variables =& $manager->getItem($itemid, 1, 1);
		$blog =& $manager->getBlog(getBlogIDFromItemID($itemid));
		
		$manager->notify('PrepareItemForEdit', array('item' => &$variables));
		
		if ( $blog->convertBreaks() )
		{
			$variables['body'] = removeBreaks($variables['body']);
			$variables['more'] = removeBreaks($variables['more']);
		}
		
		// form to edit blog items
		$handler = new PageFactory($blog);
		$handler->setVariables($variables);
		
		$content = $handler->getTemplateFor('admin', 'edit');
		
		$parser = new Parser($handler);
		
		$this->pagehead();
		$parser->parse($content);
		$this->pagefoot();
		return;
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
        if ( i18n::strpos($catid,'newcat') === 0 ) {
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
        Item::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);

        $this->updateFuturePosted($blogid);

        if ($draftid > 0) {
            // delete permission is checked inside Item::delete()
            Item::delete($draftid);
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
	 * Admin::action_itemdelete()
	 * Delete item
	 * 
	 * @param	Void
	 * @return	Void
	 */
	function action_itemdelete()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		if ( !$manager->existsItem($itemid,1,1) )
		{
			$this->error(_ERROR_NOSUCHITEM);
		}
		
		$item =& $manager->getItem($itemid,1,1);
		$title = Entity::hsc(strip_tags($item['title']));
		$body = strip_tags($item['body']);
		$body = Entity::hsc(Entity::shorten($body,300,'...'));
		
		$this->pagehead();
		echo '<h2>' . _DELETE_CONFIRM . "</h2>\n";
		echo '<p>' . _CONFIRMTXT_ITEM . "</p>\n";
		echo "<div class=\"note\">\n";
		echo "<b>{$title}</b>\n";
		echo "<br />\n";
		echo "{$body}\n";
		echo "</div>\n";
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"itemdeleteconfirm\" />\n";
		echo $manager->addTicketHidden() . "\n";
		echo "<input type=\"hidden\" name=\"itemid\" value=\"{$itemid}\" />\n";
		echo '<input type="submit" value="' . _DELETE_CONFIRM_BTN . "\"  tabindex=\"10\" />\n";
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		return;
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
        Item::delete($itemid);

        // update blog's futureposted
        $this->updateFuturePosted($blogid);
    }

	/**
	 * Admin::updateFuturePosted()
	 * Update a blog's future posted flag
	 * 
	 * @param integer $blogid
	 * @return	void
	 * 
	 */
	function updateFuturePosted($blogid)
	{
		global $manager;
		
		$blog =& $manager->getBlog($blogid);
		$currenttime = $blog->getCorrectTime(time());
		
		$query = "SELECT * FROM %s WHERE iblog=%d AND iposted=0 AND itime>%s";
		$query = sprintf($query, sql_table('item'), (integer) $blogid, DB::formatDateTime($currenttime));
		$result = DB::getResult($query);
		
		if ( $result->rowCount() > 0 )
		{
				$blog->setFuturePost();
		}
		else
		{
				$blog->clearFuturePost();
		}
		return;
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
            <h2><?php echo _MOVE_TITLE ?></h2>
            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="itemmoveto" />
                <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />

                <?php

                    $manager->addTicketHidden();
                    $this->selectBlogCategory('catid',$item['catid'],10,1);
                ?>

                <input type="submit" value="<?php echo _MOVE_BTN ?>" tabindex="10000" onclick="return checkSubmit();" />
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
        if ( i18n::strpos($catid,'newcat') === 0 ) {
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

        Item::move($itemid, $catid);

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

        Item::move($itemid, $destCatid);
    }

    /**
     * Adds a item to the chosen blog
     */
    function action_additem() {
        global $manager, $CONF;

        $manager->loadClass('ITEM');

        $result = Item::createFromRequest();

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
            call_user_func(array(&$this, $methodName), $blogid);
        }
    }

	/**
	 * Allows to edit previously made comments
	 **/
	function action_commentedit() {

		global $member, $manager;

		$commentid = intRequestVar('commentid');

		$member->canAlterComment($commentid) or $this->disallow();

		$comment = Comment::getComment($commentid);

		$manager->notify('PrepareCommentForEdit', array('comment' => &$comment) );

		// change <br /> to \n
		$comment['body'] = str_replace('<br />', '', $comment['body']);

		// replaced eregi_replace() below with preg_replace(). ereg* functions are deprecated in PHP 5.3.0
		/* original eregi_replace: eregi_replace("<a href=['\"]([^'\"]+)['\"]( rel=\"nofollow\") ?>[^<]*</a>", "\\1", $comment['body']) */

        $comment['body'] = preg_replace("#<a href=['\"]([^'\"]+)['\"]( rel=\"nofollow\") ?>[^<]*</a>#i", "\\1", $comment['body']);

        $this->pagehead();

        ?>
        <h2><?php echo _EDITC_TITLE ?></h2>

        <form action="index.php" method="post"><div>

        <input type="hidden" name="action" value="commentupdate" />
        <?php $manager->addTicketHidden(); ?>
        <input type="hidden" name="commentid" value="<?php echo  $commentid; ?>" />
        <table><tr>
            <th colspan="2"><?php echo _EDITC_TITLE ?></th>
        </tr><tr>
            <td><?php echo _EDITC_WHO ?></td>
            <td>
            <?php               if ($comment['member'])
                    echo $comment['member'] . " (" . _EDITC_MEMBER . ")";
                else
                    echo $comment['user'] . " (" . _EDITC_NONMEMBER . ")";
            ?>
            </td>
        </tr><tr>
            <td><?php echo _EDITC_WHEN ?></td>
            <td><?php echo  date("Y-m-d @ H:i",$comment['timestamp']); ?></td>
        </tr><tr>
            <td><?php echo _EDITC_HOST ?></td>
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
            <td><?php echo _EDITC_TEXT ?></td>
            <td>
                <textarea name="body" tabindex="10" rows="10" cols="50"><?php                   // htmlspecialchars not needed (things should be escaped already)
                    echo $comment['body'];
                ?></textarea>
            </td>
        </tr><tr>
            <td><?php echo _EDITC_EDIT ?></td>
            <td><input type="submit"  tabindex="20" value="<?php echo _EDITC_EDIT ?>" onclick="return checkSubmit();" /></td>
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
		if (i18n::strlen($body) < 3)
		{
			$this->error(_ERROR_COMMENT_NOCOMMENT);
		}

		if (i18n::strlen($body) > 5000)
		{
			$this->error(_ERROR_COMMENT_TOOLONG);
		}

		// prepare body
		$body = Comment::prepareBody($body);

		// call plugins
		$manager->notify('PreUpdateComment',array('body' => &$body));

		$query = 'UPDATE ' . sql_table('comment')
			. ' SET cmail = ' . DB::quoteValue($url) . ', cemail = ' . DB::quoteValue($email) . ', cbody = ' . DB::quoteValue($body)
			. ' WHERE cnumber = ' . $commentid;
		DB::execute($query);

		// get itemid
		$res = DB::getValue('SELECT citem FROM '.sql_table('comment').' WHERE cnumber=' . $commentid);
		$itemid = $res;

 		if ($member->canAlterItem($itemid))
			$this->action_itemcommentlist($itemid);
		else
			$this->action_browseowncomments();

    }
	
	/**
	 * Admin::action_commentdelete()
	 * Update comment
	 * 
	 * @param	Void
	 * @return	Void
	 */
	function action_commentdelete()
	{
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		$member->canAlterComment($commentid) or $this->disallow();
		$comment = Comment::getComment($commentid);
		
		$body = strip_tags($comment['body']);
		$body = Entity::hsc(Entity::shorten($body, 300, '...'));
		
		if ( $comment['member'] )
		{
			$author = $comment['member'];
		}
		else
		{
			$author = $comment['user'];
		}
		
		$this->pagehead();
		
		echo '<h2>' . _DELETE_CONFIRM . "</h2>\n";
		echo '<p>' . _CONFIRMTXT_COMMENT . "</p>\n";
		echo "<div class=\"note\">\n";
		echo '<b>' . _EDITC_WHO . ":</b>{$author}<br />\n";
		echo '<b>' . _EDITC_TEXT . ":</b>{$body}\n";
		echo "</div>\n";
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"commentdeleteconfirm\" />\n";
		echo $manager->addTicketHidden() . "\n";
		echo "<input type=\"hidden\" name=\"commentid\" value=\"{$commentid}\" />\n";
		echo '<input type="submit" tabindex="10" value="'. _DELETE_CONFIRM_BTN . "\" />\n";
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		return;
	}
	
    /**
     * @todo document this
     */
    function action_commentdeleteconfirm() {
        global $member;

        $commentid = intRequestVar('commentid');

        // get item id first
        $res = DB::getValue('SELECT citem FROM '.sql_table('comment') .' WHERE cnumber=' . $commentid);
        $itemid = $res;

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

        $manager->notify('PreDeleteComment', array('commentid' => $commentid));

        // delete the comments associated with the item
        $query = 'DELETE FROM '.sql_table('comment').' WHERE cnumber=' . $commentid;
        DB::execute($query);

        $manager->notify('PostDeleteComment', array('commentid' => $commentid));

        return '';
    }

	/**
	 * Admin::action_usermanagement()
	 * 
	 * Usermanagement main
	 * @param	void
	 * @return	void
	 */
	public function action_usermanagement()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=manage">(' . _BACKTOMANAGE . ")</a></p>\n";
		
		echo '<h2>' . _MEMBERS_TITLE . "</h2>\n";
		
		echo '<h3>' . _MEMBERS_CURRENT . "</h3>\n";
		
		// show list of members with actions
		$query =  'SELECT * FROM '.sql_table('member');
		$template['content'] = 'memberlist';
		$template['tabindex'] = 10;
		
		$manager->loadClass("ENCAPSULATE");
		$batch = new Batch('member');
		$batch->showlist($query,'table',$template);
		
		echo '<h3>' . _MEMBERS_NEW .'</h3>';
		echo "<form method=\"post\" action=\"index.php\" name=\"memberedit\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"memberadd\" />\n";
		$manager->addTicketHidden();
		
		echo '<table frame="box" rules="rules" summary="' . _MEMBERS_NEW . '">' ."\n";
		echo "<tr>\n";
		echo '<th colspan="2">' . _MEMBERS_NEW . "</th>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_DISPLAY;
		help('shortnames');
		echo '<br />';
		echo '<small>' . _MEMBERS_DISPLAY_INFO . '</small>';
		echo "</td>\n";
		echo "<td><input tabindex=\"10010\" name=\"name\" size=\"32\" maxlength=\"32\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_REALNAME . "</td>\n";
		echo "<td><input name=\"realname\" tabindex=\"10020\" size=\"40\" maxlength=\"60\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_PWD . "</td>\n";
		echo "<td><input name=\"password\" tabindex=\"10030\" size=\"16\" maxlength=\"40\" type=\"password\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_REPPWD . "</td>\n";
		echo "<td><input name=\"repeatpassword\" tabindex=\"10035\" size=\"16\" maxlength=\"40\" type=\"password\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_EMAIL . "</td>\n";
		echo "<td><input name=\"email\" tabindex=\"10040\" size=\"40\" maxlength=\"60\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_URL . "</td>\n";
		echo "<td><input name=\"url\" tabindex=\"10050\" size=\"40\" maxlength=\"100\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_SUPERADMIN;
		help('superadmin');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('admin',0,10060);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_CANLOGIN;
		help('canlogin');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('canlogin',1,10070);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_NOTES . "</td>\n";
		echo "<td><input name=\"notes\" maxlength=\"100\" size=\"40\" tabindex=\"10080\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _MEMBERS_NEW . "</td>\n";
		echo '<td><input type="submit" value="' . _MEMBERS_NEW_BTN . '" tabindex="10090" onclick="return checkSubmit();" />' . "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		return;
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
		{
			$memberid = $member->getID();
		}
		
		// check if allowed
		($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();
		
		$extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
		$this->pagehead($extrahead);
		
		// show message to go back to member overview (only for admins)
		if ($member->isAdmin())
		{
			echo '<a href="index.php?action=usermanagement">(' ._MEMBERS_BACKTOOVERVIEW. ')</a>';
		}
		else
		{
			echo '<a href="index.php?action=overview">(' ._BACKHOME. ')</a>';
		}
		echo '<h2>' . _MEMBERS_EDIT . '</h2>';
		
		$mem =& $manager->getMember($memberid);
		?>
		<form method="post" action="index.php" name="memberedit"><div>
		
		<input type="hidden" name="action" value="changemembersettings" />
		<input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
		<?php $manager->addTicketHidden() ?>
		
		<table><tr>
			<th colspan="2"><?php echo _MEMBERS_EDIT ?></th>
		</tr><tr>
			<td><?php echo _MEMBERS_DISPLAY ?> <?php help('shortnames'); ?>
				<br /><small><?php echo _MEMBERS_DISPLAY_INFO ?></small>
			</td>
			<td>
			<?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
				<input name="name" tabindex="10" maxlength="32" size="32" value="<?php echo  Entity::hsc($mem->getDisplayName()); ?>" />
			<?php } else {
				echo Entity::hsc($member->getDisplayName());
			   }
			?>
			</td>
		</tr><tr>
			<td><?php echo _MEMBERS_REALNAME ?></td>
			<td><input name="realname" tabindex="20" maxlength="60" size="40" value="<?php echo  Entity::hsc($mem->getRealName()); ?>" /></td>
		</tr><tr>
		<?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
			<td><?php echo _MEMBERS_PWD ?></td>
			<td><input type="password" tabindex="30" maxlength="40" size="16" name="password" /></td>
		</tr><tr>
			<td><?php echo _MEMBERS_REPPWD ?></td>
			<td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" /></td>
		<?php } ?>
		</tr><tr>
			<td><?php echo _MEMBERS_EMAIL ?>
				<br /><small><?php echo _MEMBERS_EMAIL_EDIT ?></small>
			</td>
			<td><input name="email" tabindex="40" size="40" maxlength="60" value="<?php echo  Entity::hsc($mem->getEmail()); ?>" /></td>
		</tr><tr>
			<td><?php echo _MEMBERS_URL ?></td>
			<td><input name="url" tabindex="50" size="40" maxlength="100" value="<?php echo  Entity::hsc($mem->getURL()); ?>" /></td>
		<?php // only allow to change this by super-admins
		   // we don't want normal users to 'upgrade' themselves to super-admins, do we? ;-)
		   if ($member->isAdmin()) {
		?>
			</tr><tr>
				<td><?php echo _MEMBERS_SUPERADMIN ?> <?php help('superadmin'); ?></td>
				<td><?php $this->input_yesno('admin',$mem->isAdmin(),60); ?></td>
			</tr><tr>
				<td><?php echo _MEMBERS_CANLOGIN ?> <?php help('canlogin'); ?></td>
				<td><?php $this->input_yesno('canlogin',$mem->canLogin(),70,1,0,_YES,_NO,$mem->isAdmin()); ?></td>
		<?php } ?>
		</tr><tr>
			<td><?php echo _MEMBERS_NOTES ?></td>
			<td><input name="notes" tabindex="80" size="40" maxlength="100" value="<?php echo  Entity::hsc($mem->getNotes()); ?>" /></td>
		</tr><tr>
			<td><?php echo _MEMBERS_LOCALE ?> <?php help('locale'); ?>
			</td>
			<td>
			
				<select name="locale" tabindex="85">
				<?php
				$locales = i18n::get_available_locale_list();
				if ( !$mem->getLocale() || !in_array($mem->getLocale(), $locales) )
				{
					echo "<option value=\"\" selected=\"selected\">" . Entity::hsc(_MEMBERS_USESITELANG) . "</option>\n";
				}
				else
				{
					echo "<option value=\"\">" . Entity::hsc(_MEMBERS_USESITELANG) . "</option>\n";
				}
				
				foreach( $locales as $locale )
				{
					if( $locale == $mem->getLocale() )
					{
						echo "<option value=\"{$locale}\" selected=\"selected\">{$locale}</option>\n";
					}
					else
					{
						echo "<option value=\"{$locale}\">{$locale}</option>\n";
					}
				}
				?>
				</select>
				
			</td>
		</tr>
		<tr>
			<td><?php echo _MEMBERS_USEAUTOSAVE ?> <?php help('autosave'); ?></td>
			<td><?php $this->input_yesno('autosave', $mem->getAutosave(), 87); ?></td>
		</tr>
		<?php
			// plugin options
			$this->_insertPluginOptions('member',$memberid);
		?>
		<tr>
			<th colspan="2"><?php echo _MEMBERS_EDIT ?></th>
		</tr><tr>
			<td><?php echo _MEMBERS_EDIT ?></td>
			<td><input type="submit" tabindex="90" value="<?php echo _MEMBERS_EDIT_BTN ?>" onclick="return checkSubmit();" /></td>
		</tr></table>
		
		</div></form>
		
		<?php
			echo '<h3>',_PLUGINS_EXTRA,'</h3>';
			
			$manager->notify(
				'MemberSettingsFormExtras',
				array(
					'member' => &$mem
				)
			);
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
        $locale        = postVar('locale');

        $mem =& $manager->getMember($memberid);

        if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {

            if (!isValidDisplayName($name))
                $this->error(_ERROR_BADNAME);

            if (($name != $mem->getDisplayName()) && Member::exists($name))
                $this->error(_ERROR_NICKNAMEINUSE);

            if ($password != $repeatpassword)
                $this->error(_ERROR_PASSWORDMISMATCH);

            if ($password && (i18n::strlen($password) < 6))
                $this->error(_ERROR_PASSWORDTOOSHORT);
                
            if ($password) {
				$pwdvalid = true;
				$pwderror = '';
				$manager->notify('PrePasswordSet',array('password' => $password, 'errormessage' => &$pwderror, 'valid' => &$pwdvalid));
				if (!$pwdvalid) {
					$this->error($pwderror);
				}
			}
		}
		
		if ( !NOTIFICATION::address_validation($email) )
		{
			$this->error(_ERROR_BADMAILADDRESS);
		}
		if ( !$realname )
		{
			$this->error(_ERROR_REALNAMEMISSING);
		}
        if ( ($locale != '') && (!in_array($locale, i18n::get_available_locale_list())) )
            $this->error(_ERROR_NOSUCHTRANSLATION);

        // check if there will remain at least one site member with both the logon and admin rights
        // (check occurs when taking away one of these rights from such a member)
        if (    (!$admin && $mem->isAdmin() && $mem->canLogin())
             || (!$canlogin && $mem->isAdmin() && $mem->canLogin())
           )
        {
            $r = DB::getResult('SELECT * FROM '.sql_table('member').' WHERE madmin=1 and mcanlogin=1');
            if ($r->rowCount() < 2)
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
        $mem->setLocale($locale);


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
        NucleusPlugin::apply_plugin_options($aOptions);
        $manager->notify('PostPluginOptionsUpdate',array('context' => 'member', 'memberid' => $memberid, 'member' => &$mem));

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
	 * Admin::action_memberadd()
	 * 
	 * @param	void
	 * @return	void
	 * 
	*/
	function action_memberadd()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		if ( postVar('password') != postVar('repeatpassword') )
		{
			$this->error(_ERROR_PASSWORDMISMATCH);
		}
		
		if ( i18n::strlen(postVar('password')) < 6 )
		{
			$this->error(_ERROR_PASSWORDTOOSHORT);
		}
		
		$res = Member::create(postVar('name'), postVar('realname'), postVar('password'), postVar('email'), postVar('url'), postVar('admin'), postVar('canlogin'), postVar('notes'));
		if ( $res != 1 )
		{
			$this->error($res);
		}
		
		// fire PostRegister event
		$newmem = new Member();
		$newmem->readFromName(postVar('name'));
		$manager->notify('PostRegister',array('member' => &$newmem));
		
		$this->action_usermanagement();
		return;
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
        Member::cleanupActivationTable();

        // get activation info
        $info = Member::getActivationInfo($key);

        if (!$info)
            $this->error(_ERROR_ACTIVATE);

        $mem =& $manager->getMember($info['vmember']);

        if (!$mem)
            $this->error(_ERROR_ACTIVATE);

        $text = '';
        $title = '';
        $bNeedsPasswordChange = true;

        switch ($info['vtype'])
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
                Member::activate($key);
                break;
        }

        $aVars = array(
            'memberName' => Entity::hsc($mem->getDisplayName())
        );
        $title = Template::fill($title, $aVars);
        $text = Template::fill($text, $aVars);

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
                        <input type="hidden" name="key" value="<?php echo Entity::hsc($key) ?>" />

                        <table><tr>
                            <td><?php echo _MEMBERS_PWD ?></td>
                            <td><input type="password" maxlength="40" size="16" name="password" /></td>
                        </tr><tr>
                            <td><?php echo _MEMBERS_REPPWD ?></td>
                            <td><input type="password" maxlength="40" size="16" name="repeatpassword" /></td>
                        <?php

                            global $manager;
                            $manager->notify('FormExtra', array('type' => 'activation', 'member' => $mem));

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
    function action_activatesetpwd()
    {
		global $manager;
        $key = postVar('key');

        // clean up old activation keys
        Member::cleanupActivationTable();

        // get activation info
        $info = Member::getActivationInfo($key);

        if (!$info || ($info['type'] == 'addresschange'))
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);

        $mem =& $manager->getMember($info['vmember']);

        if (!$mem)
            return $this->_showActivationPage($key, _ERROR_ACTIVATE);

        $password       = postVar('password');
        $repeatpassword = postVar('repeatpassword');

        if ($password != $repeatpassword)
            return $this->_showActivationPage($key, _ERROR_PASSWORDMISMATCH);

        if ($password && (i18n::strlen($password) < 6))
            return $this->_showActivationPage($key, _ERROR_PASSWORDTOOSHORT);
            
        if ($password) {
			$pwdvalid = true;
			$pwderror = '';
			global $manager;
			$manager->notify('PrePasswordSet',array('password' => $password, 'errormessage' => &$pwderror, 'valid' => &$pwdvalid));
			if (!$pwdvalid) {
				return $this->_showActivationPage($key,$pwderror);
			}
		}

        $error = '';
        
        $manager->notify('ValidateForm', array('type' => 'activation', 'member' => $mem, 'error' => &$error));
        if ($error != '')
            return $this->_showActivationPage($key, $error);


        // set password
        $mem->setPassword($password);
        $mem->write();

        // do the activation
        Member::activate($key);

        $this->pagehead();
            echo '<h2>',_ACTIVATE_SUCCESS_TITLE,'</h2>';
            echo '<p>',_ACTIVATE_SUCCESS_TEXT,'</p>';
        $this->pagefoot();
    }

	/**
	 * Admin::action_manageteam()
	 * 
	 * Manage team
	 * @param	void
	 * @return	void
	 */
	public function action_manageteam()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$this->pagehead();
		
		echo "<p><a href='index.php?action=blogsettings&amp;blogid=$blogid'>(" . _BACK_TO_BLOGSETTINGS . ")</a></p>\n";
		
		echo '<h2>' . _TEAM_TITLE . getBlogNameFromID($blogid) . "</h2>\n";
		
		echo '<h3>' . _TEAM_CURRENT . "</h3>\n";
		
		$query = 'SELECT tblog, tmember, mname, mrealname, memail, tadmin'
		       . ' FROM '.sql_table('member').', '.sql_table('team')
		       . ' WHERE tmember=mnumber and tblog=' . $blogid;
		
		$template['content'] = 'teamlist';
		$template['tabindex'] = 10;
		
		$manager->loadClass("ENCAPSULATE");
		$batch = new Batch('team');
		$batch->showlist($query, 'table', $template);
		
		echo '<h3>' . _TEAM_ADDNEW . "</h3>\n";
			
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		
		echo "<input type=\"hidden\" name=\"action\" value=\"teamaddmember\" />\n";
		echo "<input type=\"hidden\" name=\"blogid\" value=\"{$blogid}\" />\n";
		$manager->addTicketHidden();
			
		echo '<table frame="box" rules="all" summary="' . _TEAM_ADDNEW . '">' . "\n";
		echo "<tr>\n";
		echo '<td>' . _TEAM_CHOOSEMEMBER . "</td>\n";
		
		// TODO: try to make it so only non-team-members are listed
		echo "<td>\n";
		
		$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');
		$template['name'] = 'memberid';
		$template['tabindex'] = 10000;
		showlist($query,'select',$template);
		
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _TEAM_ADMIN;
		help('teamadmin');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('admin',0,10020);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _TEAM_ADD . "</td>\n";
		echo '<td><input type="submit" value="' . _TEAM_ADD_BTN . '" tabindex="10030" />' . "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		
		echo "</div>\n";
		echo "</form>\n";
		
		$this->pagefoot();
		return;
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

        $teammem =& $manager->getMember($memberid);
        $blog =& $manager->getBlog($blogid);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p><?php echo _CONFIRMTXT_TEAM1 ?><b><?php echo  Entity::hsc($teammem->getDisplayName()) ?></b><?php echo _CONFIRMTXT_TEAM2 ?><b><?php echo  Entity::hsc(strip_tags($blog->getName())) ?></b>
            </p>


            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="teamdeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
            <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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
        $tmem =& $manager->getMember($memberid);

        $manager->notify('PreDeleteTeamMember', array('member' => &$tmem, 'blogid' => $blogid));

        if ($tmem->isBlogAdmin($blogid)) {
            // check if there are more blog members left and at least one admin
            // (check for at least two admins before deletion)
            $query = 'SELECT * FROM '.sql_table('team') . ' WHERE tblog='.$blogid.' and tadmin=1';
            $r = DB::getResult($query);
            if ($r->rowCount() < 2)
                return _ERROR_ATLEASTONEBLOGADMIN;
        }

        $query = 'DELETE FROM '.sql_table('team')." WHERE tblog=$blogid and tmember=$memberid";
        DB::execute($query);

        $manager->notify('PostDeleteTeamMember', array('member' => &$tmem, 'blogid' => $blogid));

        return '';
    }

    /**
     * @todo document this
     */
    function action_teamchangeadmin() {
        global $manager, $member;

        $blogid = intRequestVar('blogid');
        $memberid = intRequestVar('memberid');

        // check if allowed
        $member->blogAdminRights($blogid) or $this->disallow();

        $mem =& $manager->getMember($memberid);

        // don't allow when there is only one admin at this moment
        if ($mem->isBlogAdmin($blogid)) {
            $r = DB::getResult('SELECT * FROM '.sql_table('team') . " WHERE tblog=$blogid and tadmin=1");
            if ($r->rowCount() == 1)
                $this->error(_ERROR_ATLEASTONEBLOGADMIN);
        }

        if ($mem->isBlogAdmin($blogid))
            $newval = 0;
        else
            $newval = 1;

        $query = 'UPDATE '.sql_table('team') ." SET tadmin=$newval WHERE tblog=$blogid and tmember=$memberid";
        DB::execute($query);

        // only show manageteam if member did not change its own admin privileges
        if ($member->isBlogAdmin($blogid))
            $this->action_manageteam();
        else
            $this->action_overview(_MSG_ADMINCHANGED);
    }
	
	/**
	 * Admin::action_blogsettings()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_blogsettings()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		$extrahead = "<script type=\"text/javascript\" src=\"javascript/numbercheck.js\"></script>\n";
		$this->pagehead($extrahead);
		
		echo '<p><a href="index.php?action=overview">(' . _BACKHOME . ")</a></p>\n";
		echo '<h2>' . _EBLOG_TITLE . ": '{$this->bloglink($blog)}'</h2>\n";
		
		echo '<h3>' . _EBLOG_TEAM_TITLE . "</h3>\n";
		
		echo '<p>' . _EBLOG_CURRENT_TEAM_MEMBER;
		
		$query = "SELECT mname, mrealname FROM %s, %s WHERE mnumber=tmember AND tblog=%d;";
		$query = sprintf($query, sql_table('member'), sql_table('team'), (integer) $blogid);
		$res = DB::getResult($query);
		$aMemberNames = array();
		foreach ( $res as $row )
		{
			$aMemberNames[] = Entity::hsc($row['mname']) . ' (' . Entity::hsc($row['mrealname']). ')';
		}
		echo implode(',', $aMemberNames);
			
		echo "</p>\n";
		echo '<p>';
		echo '<a href="index.php?action=manageteam&amp;blogid=' . $blogid . '">' . _EBLOG_TEAM_TEXT . '</a>';
		echo "</p>\n";
		
		echo '<h3>' . _EBLOG_SETTINGS_TITLE . "</h3>\n";
		
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		
		echo "<input type=\"hidden\" name=\"action\" value=\"blogsettingsupdate\" />\n";
		$manager->addTicketHidden() . "\n";
		echo "<input type=\"hidden\" name=\"blogid\" value=\"{$blogid}\" />\n";
		
		echo '<table frame="box" rules="all" summary="' . _EBLOG_SETTINGS_TITLE . '">' . "\n";
		echo "<tfoot>\n";
		echo "<tr>\n";
		echo '<th colspan="2">' . _EBLOG_CHANGE . "</th>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_CHANGE . "</td>\n";
		echo '<td><input type="submit" tabindex="130" value="' . _EBLOG_CHANGE_BTN . '" onclick="return checkSubmit();" />' . "</td>\n";
		echo "</tr>\n";
		echo "</tfoot>\n";
		echo "<tbody>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_NAME . "</td>\n";
		echo '<td><input name="name" tabindex="10" size="40" maxlength="60" value="' . Entity::hsc($blog->getName()) . '" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_SHORTNAME;
		help('shortblogname');
		echo _EBLOG_SHORTNAME_EXTRA;
		echo "</td>\n";
		echo '<td><input name="shortname" tabindex="20" maxlength="15" size="15" value="' . Entity::hsc($blog->getShortName()) .'" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_DESC . "</td>\n";
		echo '<td><input name="desc" tabindex="30" maxlength="200" size="40" value="' . Entity::hsc($blog->getDescription()) . '" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_URL . "</td>\n";
		echo '<td><input name="url" tabindex="40" size="40" maxlength="100" value="' . Entity::hsc($blog->getURL()) . '" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_DEFSKIN;
		help('blogdefaultskin');
		echo "</td>\n";
		echo "<td>\n";
		
		$query = 'SELECT sdname as text, sdnumber as value FROM ' . sql_table('skin_desc');
		$template['name'] = 'defskin';
		$template['selected'] = $blog->getDefaultSkin();
		$template['tabindex'] = 50;
		showlist($query, 'select', $template);
		
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_LINEBREAKS;
		help('convertbreaks');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('convertbreaks',$blog->convertBreaks(),55);
		echo "</td>\n";
		echo "</tr>\n";
		
		echo "<tr>\n";
		echo '<td>' . _EBLOG_ALLOWPASTPOSTING;
		help('allowpastposting');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('allowpastposting',$blog->allowPastPosting(),57);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_DISABLECOMMENTS;
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('comments', $blog->commentsEnabled(), 60);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_ANONYMOUS . "</td>\n";
		echo '<td>';
		$this->input_yesno('public',$blog->isPublic(),70);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_REQUIREDEMAIL . "</td>\n";
		echo '<td>';
		$this->input_yesno('reqemail', $blog->emailRequired(),72);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_NOTIFY;
		help('blognotify');
		echo "</td>\n";
		echo '<td><input name="notify" tabindex="80" maxlength="128" size="40" value="' . Entity::hsc($blog->getNotifyAddress()) . '" />' . "</td>\n";
		echo "</tr>\n";
		
		echo "<tr>\n";
		echo '<td>' . _EBLOG_NOTIFY_ON . "</td>\n";
		echo "<td>\n";
		
		if ( !$blog->notifyOnComment() )
		{
			echo "<input name=\"notifyComment\" value=\"3\" type=\"checkbox\" tabindex=\"81\" id=\"notifyComment\" />\n";
		}
		else
		{
			echo "<input name=\"notifyComment\" value=\"3\" type=\"checkbox\" tabindex=\"81\" id=\"notifyComment\" checked=\"checked\"/>\n";
		}
		echo '<label for="notifyComment">' . _EBLOG_NOTIFY_COMMENT . "</label><br />\n";
		
		if ( !$blog->notifyOnVote() )
		{
			echo "<input name=\"notifyVote\" value=\"5\" type=\"checkbox\" tabindex=\"82\" id=\"notifyVote\" />\n";
		}
		else
		{
			echo "<input name=\"notifyVote\" value=\"5\" type=\"checkbox\" tabindex=\"82\" id=\"notifyVote\" checked=\"checked\" />\n";
		}
		
		echo '<label for="notifyVote">' . _EBLOG_NOTIFY_KARMA . "</label><br />\n";
		
		if ( !$blog->notifyOnNewItem() )
		{
			echo "<input name=\"notifyNewItem\" value=\"7\" type=\"checkbox\" tabindex=\"83\" id=\"notifyNewItem\" />\n";
		
		}
		else
		{
			echo "<input name=\"notifyNewItem\" value=\"7\" type=\"checkbox\" tabindex=\"83\" id=\"notifyNewItem\" checked=\"checked\" />\n";
		}
		
		echo '<label for="notifyNewItem">' . _EBLOG_NOTIFY_ITEM . "</label>\n";
		
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_MAXCOMMENTS;
		help('blogmaxcomments');
		echo "</td>\n";
		echo '<td><input name="maxcomments" tabindex="90" size="3" value="' . Entity::hsc($blog->getMaxComments()) . '" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_UPDATE;
		help('blogupdatefile');
		echo "</td>\n";
		echo '<td><input name="update" tabindex="100" size="40" maxlength="60" value="' . Entity::hsc($blog->getUpdateFile()) .'" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_DEFCAT . "</td>\n";
		echo "<td>\n";
		$query =  "SELECT cname as text, catid as value FROM %s WHERE cblog=%d;";
		$query = sprintf($query, sql_table('category'), (integer) $blog->getID());
		$template['name'] = 'defcat';
		$template['selected'] = $blog->getDefaultCategory();
		$template['tabindex'] = 110;
		showlist($query, 'select', $template);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_OFFSET;
		help('blogtimeoffset');
		echo "<br />\n";
		echo _EBLOG_STIME;
		echo ' <b>' . i18n::formatted_datetime('%H:%M', time()) . '</b><br />';
		echo _EBLOG_BTIME;
		echo '<b>' . i18n::formatted_datetime('%H:%M', $blog->getCorrectTime()) . '</b>';
		echo "</td>\n";
		echo '<td><input name="timeoffset" tabindex="120" size="3" value="' . Entity::hsc($blog->getTimeOffset()) .'" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_SEARCH;
		help('blogsearchable');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('searchable', $blog->getSearchable(), 122);
		echo "</td>\n";
		echo "</tr>\n";
		
		// plugin options
		$this->_insertPluginOptions('blog', $blogid);
		
		echo "</tbody>\n";
		echo "</table>\n";
		
		echo "</div>\n";
		echo "</form>\n";
		
		echo '<h3>' . _EBLOG_CAT_TITLE . "</h3>\n";
		
		$query = 'SELECT * FROM '.sql_table('category').' WHERE cblog='.$blog->getID().' ORDER BY cname';
		$template['content'] = 'categorylist';
		$template['tabindex'] = 200;
		
		$manager->loadClass("ENCAPSULATE");
		$batch = new Batch('category');
		$batch->showlist($query,'table',$template);
		
		echo "<form action=\"index.php\" method=\"post\">\n";
		echo "<div>\n";
		echo "<input name=\"action\" value=\"categorynew\" type=\"hidden\" />\n";
		$manager->addTicketHidden() . "\n";
		echo "<input name=\"blogid\" value=\"{$blog->getID()}\" type=\"hidden\" />\n";
		
		echo '<table frame="box" rules="all" summary="' . _EBLOG_CAT_CREATE . '">' . "\n";
		echo "<thead>\n";
		echo "<tr>\n";
		echo '<th colspan="2">' . _EBLOG_CAT_CREATE . "</th>\n";
		echo "</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_CAT_NAME . "</td>\n";
		echo "<td><input name=\"cname\" size=\"40\" maxlength=\"40\" tabindex=\"300\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_CAT_DESC . "</td>\n";
		echo "<td><input name=\"cdesc\" size=\"40\" maxlength=\"200\" tabindex=\"310\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _EBLOG_CAT_CREATE . "</td>\n";
		echo '<td><input type="submit" value="' . _EBLOG_CAT_CREATE . '" tabindex="320" />' . "</td>\n";
		echo "</tr>\n";
		echo "</tbody>\n";
		echo "</table>\n";
		echo "</div>\n";
		echo "</form>\n";
		
		echo '<h3>' . _PLUGINS_EXTRA . "</h3>\n";
		$manager->notify('BlogSettingsFormExtras', array('blog' => &$blog));
		
		$this->pagefoot();
		return;
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

        $query = 'SELECT * FROM '.sql_table('category') . ' WHERE cname=' . DB::quoteValue($cname).' and cblog=' . intval($blogid);
        $res = DB::getResult($query);
        if ($res->rowCount() > 0)
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

        $res = DB::getRow('SELECT * FROM '.sql_table('category')." WHERE cblog=$blogid AND catid=$catid");

        $cname = $res['cname'];
        $cdesc = $res['cdesc'];

        $extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
        $this->pagehead($extrahead);

        echo "<p><a href='index.php?action=blogsettings&amp;blogid=$blogid'>(",_BACK_TO_BLOGSETTINGS,")</a></p>";

        ?>
        <h2><?php echo _EBLOG_CAT_UPDATE ?> '<?php echo Entity::hsc($cname) ?>'</h2>
        <form method='post' action='index.php'><div>
        <input name="blogid" type="hidden" value="<?php echo $blogid ?>" />
        <input name="catid" type="hidden" value="<?php echo $catid ?>" />
        <input name="desturl" type="hidden" value="<?php echo Entity::hsc($desturl) ?>" />
        <input name="action" type="hidden" value="categoryupdate" />
        <?php $manager->addTicketHidden(); ?>

        <table><tr>
            <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_NAME ?></td>
            <td><input type="text" name="cname" value="<?php echo Entity::hsc($cname) ?>" size="40" maxlength="40" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_DESC ?></td>
            <td><input type="text" name="cdesc" value="<?php echo Entity::hsc($cdesc) ?>" size="40" maxlength="200" /></td>
        </tr>
        <?php
            // insert plugin options
            $this->_insertPluginOptions('category',$catid);
        ?>
        <tr>
            <th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _EBLOG_CAT_UPDATE ?></td>
            <td><input type="submit" value="<?php echo _EBLOG_CAT_UPDATE_BTN ?>" /></td>
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

        $query = 'SELECT * FROM '.sql_table('category').' WHERE cname=' . DB::quoteValue($cname).' and cblog=' . intval($blogid) . " and not(catid=$catid)";
        $res = DB::getResult($query);
        if ($res->rowCount() > 0)
            $this->error(_ERROR_DUPCATEGORYNAME);

        $query =  'UPDATE '.sql_table('category').' SET'
               . ' cname=' . DB::quoteValue($cname) . ','
               . ' cdesc=' . DB::quoteValue($cdesc)
               . ' WHERE catid=' . $catid;

        DB::execute($query);

        // store plugin options
        $aOptions = requestArray('plugoption');
        NucleusPlugin::apply_plugin_options($aOptions);
        $manager->notify('PostPluginOptionsUpdate',array('context' => 'category', 'catid' => $catid));


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
        $res = DB::getResult($query);
        if ($res->rowCount() == 1)
            $this->error(_ERROR_DELETELASTCATEGORY);


        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <div>
            <?php echo _CONFIRMTXT_CATEGORY ?><b><?php echo  Entity::hsc($blog->getCategoryName($catid)) ?></b>
            </div>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="categorydeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo $blogid ?>" />
            <input type="hidden" name="catid" value="<?php echo $catid ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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
	 * Admin::deleteOneCategory()
	 * Delete a category by its id
	 * 
	 * @param	String	$catid	category id for deleting
	 * @return	Void
	 */
	function deleteOneCategory($catid)
	{
		global $manager, $member;
		
		$catid = intval($catid);
		$blogid = getBlogIDFromCatID($catid);
		
		if ( !$member->blogAdminRights($blogid) )
		{
			return ERROR_DISALLOWED;
		}
		
		// get blog
		$blog =& $manager->getBlog($blogid);
		
		// check if the category is valid
		if ( !$blog || !$blog->isValidCategory($catid) )
		{
			return _ERROR_NOSUCHCATEGORY;
		}
		
		$destcatid = $blog->getDefaultCategory();
		
		// don't allow deletion of default category
		if ( $blog->getDefaultCategory() == $catid )
		{
			return _ERROR_DELETEDEFCATEGORY;
		}
		
		// check if catid is the only category left for blogid
		$query = 'SELECT catid FROM '.sql_table('category').' WHERE cblog=' . $blogid;
		$res = DB::getResult($query);
		if ( $res->rowCount() == 1 )
		{
			return _ERROR_DELETELASTCATEGORY;
		}
		
		$manager->notify('PreDeleteCategory', array('catid' => $catid));
		
		// change category for all items to the default category
		$query = 'UPDATE '.sql_table('item')." SET icat=$destcatid WHERE icat=$catid";
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('category', $catid);
		
		// delete category
		$query = 'DELETE FROM '.sql_table('category').' WHERE catid=' .$catid;
		DB::execute($query);
		
		$manager->notify('PostDeleteCategory', array('catid' => $catid));
		return;
	}
	
	/**
	 * Admin::action_blogsettingsupdate
	 * Updating blog settings
	 * 
	 * @param	Void
	 * @return	Void
	 */
	function action_blogsettingsupdate()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		$notify_address	= trim(postVar('notify'));
		$shortname	 	= trim(postVar('shortname'));
		$updatefile	= trim(postVar('update'));
		
		$notifyComment	= intPostVar('notifyComment');
		$notifyVote		= intPostVar('notifyVote');
		$notifyNewItem	= intPostVar('notifyNewItem');
		
		if ( $notifyComment == 0 )
		{
			$notifyComment = 1;
		}
		if ( $notifyVote == 0 )
		{
			$notifyVote = 1;
		}
		if ( $notifyNewItem == 0 )
		{
			$notifyNewItem = 1;
		}
		$notifyType = $notifyComment * $notifyVote * $notifyNewItem;
		
		if ( $notify_address && !NOTIFICATION::address_validation($notify_address) )
		{
			$this->error(_ERROR_BADNOTIFY);
		}
		
		if ( !isValidShortName($shortname) )
		{
			$this->error(_ERROR_BADSHORTBLOGNAME);
		}
		
		if ( ($blog->getShortName() != $shortname) && $manager->existsBlog($shortname) )
		{
			$this->error(_ERROR_DUPSHORTBLOGNAME);
		}
		// check if update file is writable
		if ( $updatefile && !is_writeable($updatefile) )
		{
			$this->error(_ERROR_UPDATEFILE);
		}
		
		$blog->setName(trim(postVar('name')));
		$blog->setShortName($shortname);
		$blog->setNotifyAddress($notify_address);
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
		NucleusPlugin::apply_plugin_options($aOptions);
		$manager->notify('PostPluginOptionsUpdate',array('context' => 'blog', 'blogid' => $blogid, 'blog' => &$blog));
		
		$this->action_overview(_MSG_SETTINGSCHANGED);
		return;
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
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p><?php echo _WARNINGTXT_BLOGDEL ?>
            </p>

            <div>
            <?php echo _CONFIRMTXT_BLOG ?><b><?php echo  Entity::hsc($blog->getName()) ?></b>
            </div>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="deleteblogconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
            </div></form>
        <?php
        $this->pagefoot();
    }
	
	/**
	 * Admin::action_deleteblogconfirm()
	 * Delete Blog
	 * 
	 * @param	Void
	 * @return	Void
	 */
	function action_deleteblogconfirm()
	{
		global $member, $CONF, $manager;
		
		$blogid = intRequestVar('blogid');
		$manager->notify('PreDeleteBlog', array('blogid' => $blogid));
		$member->blogAdminRights($blogid) or $this->disallow();
		
		// check if blog is default blog
		if ( $CONF['DefaultBlog'] == $blogid )
		{
			$this->error(_ERROR_DELDEFBLOG);
		}
		
		// delete all comments
		$query = 'DELETE FROM '.sql_table('comment').' WHERE cblog='.$blogid;
		DB::execute($query);
		
		// delete all items
		$query = 'DELETE FROM '.sql_table('item').' WHERE iblog='.$blogid;
		DB::execute($query);
		
		// delete all team members
		$query = 'DELETE FROM '.sql_table('team').' WHERE tblog='.$blogid;
		DB::execute($query);
		
		// delete all bans
		$query = 'DELETE FROM '.sql_table('ban').' WHERE blogid='.$blogid;
		DB::execute($query);
		
		// delete all categories
		$query = 'DELETE FROM '.sql_table('category').' WHERE cblog='.$blogid;
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('blog', $blogid);
		
		// delete the blog itself
		$query = 'DELETE FROM '.sql_table('blog').' WHERE bnumber='.$blogid;
		DB::execute($query);
		
		$manager->notify('PostDeleteBlog', array('blogid' => $blogid));
		
		$this->action_overview(_DELETED_BLOG);
		return;
	}
	
    /**
     * @todo document this
     */
    function action_memberdelete() {
        global $member, $manager;

        $memberid = intRequestVar('memberid');

        ($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();

        $mem =& $manager->getMember($memberid);

        $this->pagehead();
        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p><?php echo _CONFIRMTXT_MEMBER ?><b><?php echo Entity::hsc($mem->getDisplayName()) ?></b>
            </p>

            <p>
            <?php echo _WARNINGTXT_NOTDELMEDIAFILES ?>
            </p>

            <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="memberdeleteconfirm" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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
	 * Admin::deleteOneMember()
	 * Delete a member by id
	 * 
	 * @static
	 * @params	Integer	$memberid	member id
	 * @return	String	null string or error messages
	 */
	function deleteOneMember($memberid)
	{
		global $manager;
		
		$memberid = intval($memberid);
		$mem =& $manager->getMember($memberid);
		
		if ( !$mem->canBeDeleted() )
		{
			return _ERROR_DELETEMEMBER;
		}
		
		$manager->notify('PreDeleteMember', array('member' => &$mem));
		
		/* unlink comments from memberid */
		if ( $memberid )
		{
			$query = "UPDATE %s SET cmember=0, cuser=%s WHERE cmember=%d";
			$query = sprintf($query, sql_table('comment'), DB::quoteValue($mem->getDisplayName()), $memberid);
			DB::execute($query);
		}
		
		$query = 'DELETE FROM '.sql_table('member').' WHERE mnumber='.$memberid;
		DB::execute($query);
		
		$query = 'DELETE FROM '.sql_table('team').' WHERE tmember='.$memberid;
		DB::execute($query);
		
		$query = 'DELETE FROM '.sql_table('activation').' WHERE vmember='.$memberid;
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('member', $memberid);
		
		$manager->notify('PostDeleteMember', array('member' => &$mem));
		
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
        <h2><?php echo _EBLOG_CREATE_TITLE ?></h2>

        <h3><?php echo _ADMIN_NOTABILIA ?></h3>

        <p><?php echo _ADMIN_PLEASE_READ ?></p>

        <p><?php echo _ADMIN_HOW_TO_ACCESS ?></p>

        <ol>
            <li><?php echo _ADMIN_SIMPLE_WAY ?></li>
            <li><?php echo _ADMIN_ADVANCED_WAY ?></li>
        </ol>

        <h3><?php echo _ADMIN_HOW_TO_CREATE ?></h3>

        <p>
        <?php echo _EBLOG_CREATE_TEXT ?>
        </p>

        <form method="post" action="index.php"><div>

        <input type="hidden" name="action" value="addnewlog" />
        <?php $manager->addTicketHidden() ?>


        <table><tr>
            <td><?php echo _EBLOG_NAME ?></td>
            <td><input name="name" tabindex="10" size="40" maxlength="60" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_SHORTNAME ?>
                <?php help('shortblogname'); ?>
            </td>
            <td><input name="shortname" tabindex="20" maxlength="15" size="15" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DESC ?></td>
            <td><input name="desc" tabindex="30" maxlength="200" size="40" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_DEFSKIN ?>
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
            <td><?php echo _EBLOG_OFFSET ?>
                <?php help('blogtimeoffset'); ?>
                <br /><?php echo _EBLOG_STIME ?> <b><?php echo i18n::formatted_datetime('%H:%M',time()); ?></b>
            </td>
            <td><input name="timeoffset" tabindex="110" size="3" value="0" /></td>
        </tr><tr>
            <td><?php echo _EBLOG_ADMIN ?>
                <?php help('teamadmin'); ?>
            </td>
            <td><?php echo _EBLOG_ADMIN_MSG ?></td>
        </tr><tr>
            <td><?php echo _EBLOG_CREATE ?></td>
            <td><input type="submit" tabindex="120" value="<?php echo _EBLOG_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
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

        $manager->notify(
            'PreAddBlog',
            array(
                'name' => &$bname,
                'shortname' => &$bshortname,
                'timeoffset' => &$btimeoffset,
                'description' => &$bdesc,
                'defaultskin' => &$bdefskin
            )
        );


        // create blog
		$query = sprintf('INSERT INTO %s (bname, bshortname, bdesc, btimeoffset, bdefskin) VALUES (%s, %s, %s, %s, %s)',
			sql_table('blog'),
			DB::quoteValue($bname),
			DB::quoteValue($bshortname),
			DB::quoteValue($bdesc),
			DB::quoteValue($btimeoffset),
			DB::quoteValue($bdefskin)
		);
        DB::execute($query);
        $blogid = DB::getInsertId();
        $blog   =& $manager->getBlog($blogid);

        // create new category
        $catdefname = (defined('_EBLOGDEFAULTCATEGORY_NAME') ? _EBLOGDEFAULTCATEGORY_NAME : 'General');
        $catdefdesc = (defined('_EBLOGDEFAULTCATEGORY_DESC') ? _EBLOGDEFAULTCATEGORY_DESC : 'Items that do not fit in other categories');
		$query = sprintf('INSERT INTO %s (cblog, cname, cdesc) VALUES (%d, %s, %s)',
			sql_table('category'),
			$blogid,
			DB::quoteValue($catdefname),
			DB::quoteValue($catdefdesc)
		);
        DB::execute($query);
        $catid = DB::getInsertId();

        // set as default category
        $blog->setDefaultCategory($catid);
        $blog->writeSettings();

        // create team member
        $memberid = $member->getID();
        $query = sprintf('INSERT INTO %s (tmember, tblog, tadmin) VALUES (%d, %d, 1)', sql_table('team'), $memberid, $blogid);
        DB::execute($query);

        $itemdeftitle = (defined('_EBLOG_FIRSTITEM_TITLE') ? _EBLOG_FIRSTITEM_TITLE : 'First Item');
        $itemdefbody = (defined('_EBLOG_FIRSTITEM_BODY') ? _EBLOG_FIRSTITEM_BODY : 'This is the first item in your weblog. Feel free to delete it.');

        $blog->additem($blog->getDefaultCategory(),$itemdeftitle,$itemdefbody,'',$blogid, $memberid,$blog->getCorrectTime(),0,0,0);

        
        $manager->notify(
            'PostAddBlog',
            array(
                'blog' => &$blog
            )
        );

        $manager->notify(
            'PostAddCategory',
            array(
                'blog' => &$blog,
                'name' => _EBLOGDEFAULTCATEGORY_NAME,
                'description' => _EBLOGDEFAULTCATEGORY_DESC,
                'catid' => $catid
            )
        );

        $this->pagehead();
        ?>
        <h2><?php echo _BLOGCREATED_TITLE ?></h2>

        <p><?php echo sprintf(_BLOGCREATED_ADDEDTXT, Entity::hsc($bname)) ?></p>

        <ol>
            <li><a href="#index_php"><?php echo sprintf(_BLOGCREATED_SIMPLEWAY, Entity::hsc($bshortname)) ?></a></li>
            <li><a href="#skins"><?php echo _BLOGCREATED_ADVANCEDWAY ?></a></li>
        </ol>

        <h3><a id="index_php"><?php echo sprintf(_BLOGCREATED_SIMPLEDESC1, Entity::hsc($bshortname)) ?></a></h3>

        <p><?php echo sprintf(_BLOGCREATED_SIMPLEDESC2, Entity::hsc($bshortname)) ?></p>
<pre><code>&lt;?php

$CONF['Self'] = '<b><?php echo Entity::hsc($bshortname) ?>.php</b>';

include('<i>./config.php</i>');

selectBlog('<b><?php echo Entity::hsc($bshortname) ?></b>');
selector();

?&gt;</code></pre>

        <p><?php echo _BLOGCREATED_SIMPLEDESC3 ?></p>

        <p><?php echo _BLOGCREATED_SIMPLEDESC4 ?></p>

        <form action="index.php" method="post"><div>
            <input type="hidden" name="action" value="addnewlog2" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo intval($blogid) ?>" />
            <table><tr>
                <td><?php echo _EBLOG_URL ?></td>
                <td><input name="url" maxlength="100" size="40" value="<?php echo Entity::hsc($CONF['IndexURL'].$bshortname.'.php') ?>" /></td>
            </tr><tr>
                <td><?php echo _EBLOG_CREATE ?></td>
                <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
            </tr></table>
        </div></form>

        <h3><a id="skins"><?php echo _BLOGCREATED_ADVANCEDWAY2 ?></a></h3>

        <p><?php echo _BLOGCREATED_ADVANCEDWAY3 ?></p>

        <form action="index.php" method="post"><div>
            <input type="hidden" name="action" value="addnewlog2" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="blogid" value="<?php echo intval($blogid) ?>" />
            <table><tr>
                <td><?php echo _EBLOG_URL ?></td>
                <td><input name="url" maxlength="100" size="40" /></td>
            </tr><tr>
                <td><?php echo _EBLOG_CREATE ?></td>
                <td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
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
        <h2><?php echo _SKINIE_TITLE_IMPORT ?></h2>

                <p><label for="skinie_import_local"><?php echo _SKINIE_LOCAL ?></label>
                <?php                   global $DIR_SKINS;

                    $candidates = SkinImport::searchForCandidates($DIR_SKINS);

                    if (sizeof($candidates) > 0) {
                        ?>
                            <form method="post" action="index.php"><div>
                                <input type="hidden" name="action" value="skinieimport" />
                                <?php $manager->addTicketHidden() ?>
                                <input type="hidden" name="mode" value="file" />
                                <select name="skinfile" id="skinie_import_local">
                                <?php                                   foreach ($candidates as $skinname => $skinfile) {
                                        $html = Entity::hsc($skinfile);
                                        echo '<option value="',$html,'">',$skinname,'</option>';
                                    }
                                ?>
                                </select>
                                <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT ?>" />
                            </div></form>
                        <?php                   } else {
                        echo _SKINIE_NOCANDIDATES;
                    }
                ?>
                </p>

                <p><em><?php echo _OR ?></em></p>

                <form method="post" action="index.php"><p>
                    <?php $manager->addTicketHidden() ?>
                    <input type="hidden" name="action" value="skinieimport" />
                    <input type="hidden" name="mode" value="url" />
                    <label for="skinie_import_url"><?php echo _SKINIE_FROMURL ?></label>
                    <input type="text" name="skinfile" id="skinie_import_url" size="60" value="http://" />
                    <input type="submit" value="<?php echo _SKINIE_BTN_IMPORT ?>" />
                </p></form>


        <h2><?php echo _SKINIE_TITLE_EXPORT ?></h2>
        <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="skinieexport" />
            <?php $manager->addTicketHidden() ?>

            <p><?php echo _SKINIE_EXPORT_INTRO ?></p>

            <table><tr>
                <th colspan="2"><?php echo _SKINIE_EXPORT_SKINS ?></th>
            </tr><tr>
    <?php       // show list of skins
        $res = DB::getResult('SELECT * FROM '.sql_table('skin_desc'));
        foreach ( $res as $row) {
            $id = 'skinexp' . $row['sdnumber'];
            echo '<td><input type="checkbox" name="skin[',$row['sdnumber'],']"  id="',$id,'" />';
            echo '<label for="',$id,'">',Entity::hsc($row['sdname']),'</label></td>';
            echo '<td>',Entity::hsc($row['sddesc']),'</td>';
            echo '</tr><tr>';
        }

        echo '<th colspan="2">',_SKINIE_EXPORT_TEMPLATES,'</th></tr><tr>';

        // show list of templates
        $res = DB::getResult('SELECT * FROM '.sql_table('template_desc'));
        foreach ( $res as $row ) {
            $id = 'templateexp' . $row['tdnumber'];
            echo '<td><input type="checkbox" name="template[',$row['tdnumber'],']" id="',$id,'" />';
            echo '<label for="',$id,'">',Entity::hsc($row['tdname']),'</label></td>';
            echo '<td>',Entity::hsc($row['tddesc']),'</td>';
            echo '</tr><tr>';
        }

    ?>
                <th colspan="2"><?php echo _SKINIE_EXPORT_EXTRA ?></th>
            </tr><tr>
                <td colspan="2"><textarea cols="40" rows="5" name="info"></textarea></td>
            </tr><tr>
                <th colspan="2"><?php echo _SKINIE_TITLE_EXPORT ?></th>
            </tr><tr>
                <td colspan="2"><input type="submit" value="<?php echo _SKINIE_BTN_EXPORT ?>" /></td>
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

        $importer = new SkinImport();

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
        <h2><?php echo _SKINIE_CONFIRM_TITLE ?></h2>

        <ul>
            <li><p><strong><?php echo _SKINIE_INFO_GENERAL ?></strong> <?php echo Entity::hsc($importer->getInfo()) ?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_SKINS ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames()) ?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_TEMPLATES ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames()) ?></p></li>
            <?php
                if ($hasNameClashes)
                {
            ?>
            <li><p><strong style="color: red;"><?php echo _SKINIE_INFO_SKINCLASH ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$skinNameClashes) ?></p></li>
            <li><p><strong style="color: red;"><?php echo _SKINIE_INFO_TEMPLCLASH ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$templateNameClashes) ?></p></li>
            <?php
                } // if (hasNameClashes)
            ?>
        </ul>

        <form method="post" action="index.php"><div>
            <input type="hidden" name="action" value="skiniedoimport" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="skinfile" value="<?php echo Entity::hsc(postVar('skinfile')) ?>" />
            <input type="hidden" name="mode" value="<?php echo Entity::hsc($mode) ?>" />
            <input type="submit" value="<?php echo _SKINIE_CONFIRM_IMPORT ?>" />
            <?php
                if ($hasNameClashes)
                {
            ?>
            <br />
            <input type="checkbox" name="overwrite" value="1" id="cb_overwrite" /><label for="cb_overwrite"><?php echo _SKINIE_CONFIRM_OVERWRITE ?></label>
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

        $importer = new SkinImport();

        $error = $importer->readFile($skinFile);

        if ($error)
            $this->error($error);

        $error = $importer->writeToDatabase($allowOverwrite);

        if ($error)
            $this->error($error);

        $this->pagehead();

        echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
    ?>
        <h2><?php echo _SKINIE_DONE ?></h2>

        <ul>
            <li><p><strong><?php echo _SKINIE_INFO_GENERAL ?></strong> <?php echo Entity::hsc($importer->getInfo()) ?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_IMPORTEDSKINS ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames()) ?></p></li>
            <li><p><strong><?php echo _SKINIE_INFO_IMPORTEDTEMPLS ?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames()) ?></p></li>
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

        $exporter = new SkinExport();
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
            <td><?php echo _TEMPLATE_NAME ?> <?php help('shortnames'); ?></td>
            <td><input name="name" tabindex="10010" maxlength="20" size="20" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_DESC ?></td>
            <td><input name="desc" tabindex="10020" maxlength="200" size="50" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_CREATE ?></td>
            <td><input type="submit" tabindex="10030" value="<?php echo _TEMPLATE_CREATE_BTN ?>" onclick="return checkSubmit();" /></td>
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
        $extrahead .= '<script type="text/javascript">setTemplateEditText('.DB::quoteValue(_EDITTEMPLATE_EMPTY).');</script>';

        $this->pagehead($extrahead);

        $templatename = Template::getNameFromId($templateid);
        $templatedescription = Template::getDesc($templateid);
        $template =& $manager->getTemplate($templatename);

        ?>
        <p>
        <a href="index.php?action=templateoverview">(<?php echo _TEMPLATE_BACK ?>)</a>
        </p>

        <h2><?php echo _TEMPLATE_EDIT_TITLE ?> '<?php echo  Entity::hsc($templatename); ?>'</h2>

        <?php                   if ($msg) echo "<p>"._MESSAGE.": $msg</p>";
        ?>

        <p><?php echo _TEMPLATE_EDIT_MSG ?></p>

        <form method="post" action="index.php">
        <div>

        <input type="hidden" name="action" value="templateupdate" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="templateid" value="<?php echo  $templateid; ?>" />

        <table><tr>
            <th colspan="2"><?php echo _TEMPLATE_SETTINGS ?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_NAME ?> <?php help('shortnames'); ?></td>
            <td><input name="tname" tabindex="4" size="20" maxlength="20" value="<?php echo  Entity::hsc($templatename) ?>" /></td>
        </tr><tr>
            <td><?php echo _TEMPLATE_DESC ?></td>
            <td><input name="tdesc" tabindex="5" size="50" maxlength="200" value="<?php echo  Entity::hsc($templatedescription) ?>" /></td>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_UPDATE ?></td>
            <td>
                <input type="submit" tabindex="6" value="<?php echo _TEMPLATE_UPDATE_BTN ?>" onclick="return checkSubmit();" />
                <input type="reset" tabindex="7" value="<?php echo _TEMPLATE_RESET_BTN ?>" />
            </td>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_ITEMS ?> <?php help('templateitems'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_ITEMHEADER, 'ITEM_HEADER', '', 8);
    $this->_templateEditRow($template, _TEMPLATE_ITEMBODY, 'ITEM', '', 9, 1);
    $this->_templateEditRow($template, _TEMPLATE_ITEMFOOTER, 'ITEM_FOOTER', '', 10);
    $this->_templateEditRow($template, _TEMPLATE_MORELINK, 'MORELINK', 'morelink', 20);
    $this->_templateEditRow($template, _TEMPLATE_EDITLINK, 'EDITLINK', 'editlink', 25);
    $this->_templateEditRow($template, _TEMPLATE_NEW, 'NEW', 'new', 30);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_ANY ?> <?php help('templatecomments'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CHEADER, 'COMMENTS_HEADER', 'commentheaders', 40);
    $this->_templateEditRow($template, _TEMPLATE_CBODY, 'COMMENTS_BODY', 'commentbody', 50, 1);
    $this->_templateEditRow($template, _TEMPLATE_CFOOTER, 'COMMENTS_FOOTER', 'commentheaders', 60);
    $this->_templateEditRow($template, _TEMPLATE_CONE, 'COMMENTS_ONE', 'commentwords', 70);
    $this->_templateEditRow($template, _TEMPLATE_CMANY, 'COMMENTS_MANY', 'commentwords', 80);
    $this->_templateEditRow($template, _TEMPLATE_CMORE, 'COMMENTS_CONTINUED', 'commentcontinued', 90);
    $this->_templateEditRow($template, _TEMPLATE_CMEXTRA, 'COMMENTS_AUTH', 'memberextra', 100);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_NONE ?> <?php help('templatecomments'); ?></th>
<?php
    $this->_templateEditRow($template, _TEMPLATE_CNONE, 'COMMENTS_NONE', '', 110);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_COMMENTS_TOOMUCH ?> <?php help('templatecomments'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CTOOMUCH, 'COMMENTS_TOOMUCH', '', 120);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_ARCHIVELIST ?> <?php help('templatearchivelists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_AHEADER, 'ARCHIVELIST_HEADER', '', 130);
    $this->_templateEditRow($template, _TEMPLATE_AITEM, 'ARCHIVELIST_LISTITEM', '', 140);
    $this->_templateEditRow($template, _TEMPLATE_AFOOTER, 'ARCHIVELIST_FOOTER', '', 150);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_BLOGLIST ?> <?php help('templatebloglists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_BLOGHEADER, 'BLOGLIST_HEADER', '', 160);
    $this->_templateEditRow($template, _TEMPLATE_BLOGITEM, 'BLOGLIST_LISTITEM', '', 170);
    $this->_templateEditRow($template, _TEMPLATE_BLOGFOOTER, 'BLOGLIST_FOOTER', '', 180);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_CATEGORYLIST ?> <?php help('templatecategorylists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CATHEADER, 'CATLIST_HEADER', '', 190);
    $this->_templateEditRow($template, _TEMPLATE_CATITEM, 'CATLIST_LISTITEM', '', 200);
    $this->_templateEditRow($template, _TEMPLATE_CATFOOTER, 'CATLIST_FOOTER', '', 210);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_DATETIME ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_DHEADER, 'DATE_HEADER', 'dateheads', 220);
    $this->_templateEditRow($template, _TEMPLATE_DFOOTER, 'DATE_FOOTER', 'dateheads', 230);
    $this->_templateEditRow($template, _TEMPLATE_DFORMAT, 'FORMAT_DATE', 'datetime', 240);
    $this->_templateEditRow($template, _TEMPLATE_TFORMAT, 'FORMAT_TIME', 'datetime', 250);
    $this->_templateEditRow($template, _TEMPLATE_LOCALE, 'LOCALE', 'locale', 260);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_IMAGE ?> <?php help('templatepopups'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_PCODE, 'POPUP_CODE', '', 270);
    $this->_templateEditRow($template, _TEMPLATE_ICODE, 'IMAGE_CODE', '', 280);
    $this->_templateEditRow($template, _TEMPLATE_MCODE, 'MEDIA_CODE', '', 290);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_SEARCH ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_SHIGHLIGHT, 'SEARCH_HIGHLIGHT', 'highlight',300);
    $this->_templateEditRow($template, _TEMPLATE_SNOTFOUND, 'SEARCH_NOTHINGFOUND', 'nothingfound',310);
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_PLUGIN_FIELDS ?></th>
<?php
        $tab = 600;
        $pluginfields = array();
        $manager->notify('TemplateExtraFields',array('fields'=>&$pluginfields));

        foreach ($pluginfields as $pfkey=>$pfvalue) {
            echo "</tr><tr>\n";
            echo '<th colspan="2">' . Entity::hen($pfkey) . "</th>\n";
            foreach ($pfvalue as $pffield=>$pfdesc) {
                $this->_templateEditRow($template, $pfdesc, $pffield, '',++$tab,0);
            }
        }
?>
        </tr><tr>
            <th colspan="2"><?php echo _TEMPLATE_UPDATE ?></th>
        </tr><tr>
            <td><?php echo _TEMPLATE_UPDATE ?></td>
            <td>
                <input type="submit" tabindex="800" value="<?php echo _TEMPLATE_UPDATE_BTN ?>" onclick="return checkSubmit();" />
                <input type="reset" tabindex="810" value="<?php echo _TEMPLATE_RESET_BTN ?>" />
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
            <td><?php echo $description ?> <?php if ($help) help('template'.$help); ?></td>
            <td id="td<?php echo $count ?>"><textarea class="templateedit" name="<?php echo $name ?>" tabindex="<?php echo $tabindex ?>" cols="50" rows="<?php echo $big?10:5 ?>" id="textarea<?php echo $count ?>"><?php echo  Entity::hsc($template[$name]); ?></textarea></td>
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

        if ((Template::getNameFromId($templateid) != $name) && Template::exists($name))
            $this->error(_ERROR_DUPTEMPLATENAME);


        $name = DB::quoteValue($name);
        $desc = DB::quoteValue($desc);

        // 1. Remove all template parts
        $query = 'DELETE FROM '.sql_table('template').' WHERE tdesc=' . $templateid;
        DB::execute($query);

        // 2. Update description
        $query =  'UPDATE '.sql_table('template_desc').' SET'
               . ' tdname=' . $name . ','
               . ' tddesc=' . $desc
               . ' WHERE tdnumber=' . $templateid;
        DB::execute($query);

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
        $manager->notify('TemplateExtraFields',array('fields'=>&$pluginfields));
        foreach ($pluginfields as $pfkey=>$pfvalue) {
            foreach ($pfvalue as $pffield=>$pfdesc) {
                $this->addToTemplate($templateid, $pffield, postVar($pffield));
            }
        }

        // jump back to template edit
        $this->action_templateedit(_TEMPLATE_UPDATED);

    }

	/**
	 * Admin::addToTemplate()
	 * 
	 * @param	Integer	$id	ID for template
	 * @param	String	$partname	parts name
	 * @param	String	$content	template contents
	 * @return	Integer	record index
	 * 
	 */
	function addToTemplate($id, $partname, $content)
	{
		// don't add empty parts:
		if ( !trim($content) )
		{
			return -1;
		}
		
		$partname = DB::quoteValue($partname);
		$content = DB::quoteValue($content);
		
		$query = "INSERT INTO %s (tdesc, tpartname, tcontent) VALUES (%d, %s, %s)";
		$query = sprintf($query, sql_table('template'), (integer) $id, $partname, $content);
		if ( DB::execute($query) === FALSE )
		{
			$err = DB::getError();
			exit(_ADMIN_SQLDIE_QUERYERROR . $err[2]);
		}
		return DB::getInsertId();
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

        $name = Template::getNameFromId($templateid);
        $desc = Template::getDesc($templateid);

        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p>
            <?php echo _CONFIRMTXT_TEMPLATE ?><b><?php echo Entity::hsc($name) ?></b> (<?php echo  Entity::hsc($desc) ?>)
            </p>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="templatedeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="templateid" value="<?php echo  $templateid ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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

        $manager->notify('PreDeleteTemplate', array('templateid' => $templateid));

        // 1. delete description
        DB::execute('DELETE FROM '.sql_table('template_desc').' WHERE tdnumber=' . $templateid);

        // 2. delete parts
        DB::execute('DELETE FROM '.sql_table('template').' WHERE tdesc=' . $templateid);

        $manager->notify('PostDeleteTemplate', array('templateid' => $templateid));

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

        if (Template::exists($name))
            $this->error(_ERROR_DUPTEMPLATENAME);

        $newTemplateId = Template::createNew($name, $desc);

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
        $name = Template::getNameFromId($templateid);
        $desc = Template::getDesc($templateid);

        // 2. create desc thing
        $name = "cloned" . $name;

        // if a template with that name already exists:
        if (Template::exists($name)) {
            $i = 1;
            while (Template::exists($name . $i))
                $i++;
            $name .= $i;
        }

        $newid = Template::createNew($name, $desc);

        // 3. create clone
        // go through parts of old template and add them to the new one
        $res = DB::getResult('SELECT tpartname, tcontent FROM '.sql_table('template').' WHERE tdesc=' . $templateid);
        foreach ( $res as $row ) {
            $this->addToTemplate($newid, $row['tpartname'], $row['tcontent']);
        }

        $this->action_templateoverview();
    }
	
	/**
	 * Admin::action_skinoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_skinoverview()
	{
		global $member, $manager;
		
		$member->isAdmin() or $this->disallow();
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=manage">(' . _BACKTOMANAGE . ")</a></p>\n";
		echo '<h2>' . _SKIN_EDIT_TITLE . "</h2>\n";
		echo '<h3>' . _SKIN_AVAILABLE_TITLE . "</h3>\n";
		
		$query = 'SELECT * FROM '.sql_table('skin_desc').' ORDER BY sdname;';
		$template['content'] = 'skinlist';
		$template['tabindex'] = 10;
		
		showlist($query,'table',$template);
		
		echo '<h3>' . _SKIN_NEW_TITLE . "</h3>\n";
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		echo "<input name=\"action\" value=\"skinnew\" type=\"hidden\" />\n";
		
		$manager->addTicketHidden() . "\n";
		
		echo "<table frame=\"box\" rules=\"all\" summary=\"skinoverview\">\n";
		echo "<tr>\n";
		echo "<td>" . _SKIN_NAME;
		echo help('shortnames');
		echo "</td>\n";
		echo "<td><input name=\"name\" tabindex=\"10010\" maxlength=\"20\" size=\"20\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>" . _SKIN_DESC . "</td>\n";
		echo "<td><input name=\"desc\" tabindex=\"10020\" maxlength=\"200\" size=\"50\" /></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _SKIN_CREATE . "</td>\n";
		echo '<td><input type="submit" tabindex="10030" value="' . _SKIN_CREATE_BTN . '" onclick="return checkSubmit();" />' . "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		
		echo "</div>\n";
		echo "</form>\n";
		
		$this->pagefoot();
		return;
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

        if (Skin::exists($name))
            $this->error(_ERROR_DUPSKINNAME);

        $newId = Skin::createNew($name, $desc);

        $this->action_skinoverview();
    }

	/**
	 * Admin::action_skinedit()
	 * @param	void
	 * @return	void
	 */
	public function action_skinedit()
	{
		global $member, $manager;
		
		$skinid = intRequestVar('skinid');
		
		$member->isAdmin() or $this->disallow();
		
		$skin = new SKIN($skinid);
		$default_skin_types = $skin->getDefaultTypes();
		$available_skin_types = $skin->getAvailableTypes();
		
		$this->pagehead();
		
		echo "<p>";
		echo '( <a href="index.php?action=skinoverview">' . _SKIN_BACK . "</a> )";
		echo "</p>\n";
		echo '<h2>' . _SKIN_EDITONE_TITLE . $skin->getName() . "</h2>\n";
		
		echo '<h3>' . _SKIN_PARTS_TITLE . "</h3>\n";
		echo _SKIN_PARTS_MSG . "\n";
		echo "<ul>\n";
		
		$tabindex = 10;
		foreach ( $default_skin_types as $type => $friendly_name )
		{
			echo "<li>\n";
			echo "<a tabindex=\"{$tabindex}\" href=\"index.php?action=skinedittype&amp;skinid={$skinid}&amp;type={$type}\">";
			echo $friendly_name;
			echo "</a>\n";
			help("skinpart{$type}");
			echo "</li>\n";
			$tabindex++;
		}
		echo "</ul>\n";
		
		echo '<h3>' . _SKIN_PARTS_SPECIAL . '</h3>';
		echo "<form method=\"get\" action=\"index.php\">\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"skinedittype\" />\n";
		echo "<input type=\"hidden\" name=\"skinid\" value=\"{$skinid}\" />\n";
		echo "<input type=\"text\" name=\"type\" tabindex=\"89\" size=\"20\" maxlength=\"20\" />\n";
		echo '<input type="submit" tabindex="140" value="' . _SKIN_CREATE . "\" onclick=\"return checkSubmit();\" />\n";
		echo "</form>\n";
		
		/* NOTE: special skin parts has FALSE in its value */
		if ( in_array(FALSE, array_values($available_skin_types)) )
		{
			$tabstart = 75;
			
			echo '<ul>';
			foreach ( $available_skin_types as $type => $friendly_name )
			{
				if ( !$friendly_name )
				{
					$tabstart++;
					echo "<li>\n";
					echo "<a tabindex=\"{$tabstart}\" href=\"index.php?action=skinedittype&amp;skinid={$skinid}&amp;type=" . Entity::hsc(strtolower($type)) . '">';
					echo Entity::hsc(ucfirst($type));
					echo "</a>\n";
					$tabstart++;
					echo "(<a tabindex=\"{$tabstart}\" href=\"index.php?action=skinremovetype&amp;skinid={$skinid}&amp;type=" . Entity::hsc(strtolower($type)) . '">';
					echo _LISTS_DELETE;
					echo "</a>)\n";
					echo "</li>\n";
				}
			}
			echo '</ul>';
		}
		
		echo '<h3>' . _SKIN_GENSETTINGS_TITLE . "</h3>\n";
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"skineditgeneral\" />\n";
		$manager->addTicketHidden() . "\n";
		echo "<input type=\"hidden\" name=\"skinid\" value=\"{$skinid}\" />\n";
		
		echo '<table frame="box" rules="all" summary="' . _SKIN_GENSETTINGS_TITLE . '">' . "\n";
		echo "<tr>\n";
		echo '<td>';
		echo _SKIN_NAME;
		help('shortnames');
		echo "</td>\n";
		echo '<td><input type="text" name="name" tabindex="90" value="' . Entity::hsc($skin->getName()) . '" maxlength="20" size="20" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _SKIN_DESC . "</td>\n";
		echo '<td><input type="text" name="desc" tabindex="100" value="' . Entity::hsc($skin->getDescription()) . '" maxlength="200" size="50" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _SKIN_TYPE . "</td>\n";
		echo '<td><input type="text" name="type" tabindex="110" value="' . Entity::hsc($skin->getContentType()) . '" maxlength="40" size="20" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>';
		echo _SKIN_INCLUDE_MODE;
		help('includemode');
		echo "</td>\n";
		echo '<td>';
		$this->input_yesno('inc_mode', $skin->getIncludeMode(), 120, 'skindir', 'normal', _PARSER_INCMODE_SKINDIR, _PARSER_INCMODE_NORMAL);
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>';
		echo _SKIN_INCLUDE_PREFIX;
		help('includeprefix');
		echo "</td>\n";
		echo '<td><input type="text" name="inc_prefix" tabindex="130" value="' . Entity::hsc($skin->getIncludePrefix()) . '" maxlength="40" size="20" />' . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo '<td>' . _SKIN_CHANGE . "</td>\n";
		echo '<td><input type="submit" tabindex="140" value="' . _SKIN_CHANGE_BTN . '" onclick="return checkSubmit();" />' . "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		return;
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

        if (($skin->getName() != $name) && Skin::exists($name))
            $this->error(_ERROR_DUPSKINNAME);

        if (!$type) $type = 'text/html';
        if (!$inc_mode) $inc_mode = 'normal';

        // 2. Update description
        $skin->updateGeneralInfo($name, $desc, $type, $inc_mode, $inc_prefix);

        $this->action_skinedit();

    }

	/**
	 * Admin::action_skinedittype()
	 * 
	 * @param	string	$msg	message for pageheader
	 * @return	void
	 */
	public function action_skinedittype($msg = '')
	{
		global $member, $manager;
		
		$skinid = intRequestVar('skinid');
		$type = requestVar('type');
		
		$member->isAdmin() or $this->disallow();
		
		$type = trim($type);
		$type = strtolower($type);
		
		if ( !isValidShortName($type) )
		{
			$this->error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
		}
		
		$skin = new SKIN($skinid);
		$skin_types = $skin->getAvailableTypes();
		if ( !array_key_exists($type, $skin_types) || !$skin_types[$type] )
		{
			$friendlyName = ucfirst($type);
		}
		else
		{
			$friendlyName = $skin_types[$type];
		}
		
		$this->pagehead();
		
		echo '<p>(<a href="index.php?action=skinoverview">' . _SKIN_GOBACK . "</a>)</p>\n";
		
		echo '<h2>' . _SKIN_EDITPART_TITLE . " '" . Entity::hsc($skin->getName()) . "': " . Entity::hsc($friendlyName) . "</h2>\n";
		
		if ( $msg != '')
		{
			echo "<p>" . _MESSAGE . ": $msg</p>\n";
		}
		
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		
		echo "<input type=\"hidden\" name=\"action\" value=\"skinupdate\" />\n";
		$manager->addTicketHidden() . "\n";
		echo "<input type=\"hidden\" name=\"skinid\" value=\"{$skinid}\" />\n";
		echo "<input type=\"hidden\" name=\"type\" value=\"{$type}\" />\n";
		
		echo '<input type="submit" value="' . _SKIN_UPDATE_BTN . '" onclick="return checkSubmit();" />' . "\n";
		echo '<input type="reset" value="' . _SKIN_RESET_BTN . '" />' . "\n";
		echo '(skin type: ' . Entity::hsc($friendlyName) . ")\n";
		
		if ( !array_key_exists($type, $skin_types) || !$skin_types[$type] )
		{
			help('skinpartspecial');
		}
		else
		{
			help('skinpart' . $type);
		}
		echo "<br />\n";
		
		echo "<textarea class=\"skinedit\" tabindex=\"10\" rows=\"20\" cols=\"80\" name=\"content\">\n";
		echo Entity::hsc($skin->getContentFromDB($type)) . "\n";
		echo "</textarea>\n";
		
		echo "<br />\n";
		echo '<input type="submit" tabindex="20" value="' . _SKIN_UPDATE_BTN . '" onclick="return checkSubmit();" />' . "\n";
		echo '<input type="reset" value="' . _SKIN_RESET_BTN . '" />' . "\n";
		echo '(skin type: ' . Entity::hsc($friendlyName) . ")\n";
		
		echo "<br />\n";
		echo "<br />\n";
		echo _SKIN_ALLOWEDVARS;
		
		$actions = $skin->getAllowedActionsForType($type);
		
		sort($actions);
		
		while ( $current = array_shift($actions) )
		{
			// skip deprecated vars
			if ( in_array($current, array('ifcat', 'imagetext', 'vars')) )
			{
				continue;
			}
			
			echo helplink("skinvar-{$current}") . "{$current}</a>\n";
			
			if ( count($actions) != 0 )
			{
				echo ", ";
			}
		}
		
		echo "<br />\n";
		echo "<br />\n";
		echo _SKINEDIT_ALLOWEDBLOGS;
		
		$query = 'SELECT bshortname, bname FROM '.sql_table('blog');
		showlist($query, 'table', array('content'=>'shortblognames'));
		
		echo "<br />\n";
		echo _SKINEDIT_ALLOWEDTEMPLATESS;
		
		$query = 'SELECT tdname as name, tddesc as description FROM '.sql_table('template_desc');
		showlist($query, 'table', array('content'=>'shortnames'));
		
		echo "</div>\n";
		echo "</form>\n";
		
		$this->pagefoot();
		
		return;
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
        $r = DB::getValue($query);
        if ( $r )
            $this->error(_ERROR_SKINDEFDELETE . Entity::hsc($r));

        $this->pagehead();

        $skin = new SKIN($skinid);
        $name = $skin->getName();
        $desc = $skin->getDescription();

        ?>
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p>
                <?php echo _CONFIRMTXT_SKIN ?><b><?php echo Entity::hsc($name) ?></b> (<?php echo  Entity::hsc($desc) ?>)
            </p>

            <form method="post" action="index.php"><div>
                <input type="hidden" name="action" value="skindeleteconfirm" />
                <?php $manager->addTicketHidden() ?>
                <input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
                <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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
        $r = DB::getValue($query);
        if ($r)
            $this->error(_ERROR_SKINDEFDELETE .$r);

        $manager->notify('PreDeleteSkin', array('skinid' => $skinid));

        // 1. delete description
        DB::execute('DELETE FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $skinid);

        // 2. delete parts
        DB::execute('DELETE FROM '.sql_table('skin').' WHERE sdesc=' . $skinid);

        $manager->notify('PostDeleteSkin', array('skinid' => $skinid));

        $this->action_skinoverview();
    }
	
	/**
	 * Admin::action_skinremovetype()
	 *
	 * @param	void
	 * @return	void
	 */
	public function action_skinremovetype()
	{
		global $member, $manager, $CONF;
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		if ( !isValidShortName($skintype) )
		{
			$this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
		}
		
		$member->isAdmin() or $this->disallow();
		
		// don't allow default skinparts to be deleted
		$skin = new Skin($skinid);
		$default_skin_types = $skin->getDefaultTypes();
		if ( array_key_exists($skintype, $default_skin_types) )
		{
			$this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
		}
		
		$name = $skin->getName();
		$desc = $skin->getDescription();
		
		$this->pagehead();
		
		echo '<h2>' . _DELETE_CONFIRM . "</h2>\n";
		echo "<p>\n";
		echo _CONFIRMTXT_SKIN_PARTS_SPECIAL;
		echo Entity::hsc($skintype);
		echo  '(' . Entity::hsc($name) . ')</b>';
		echo ' (' . Entity::hsc($desc) . ')';
		echo "</p>\n";
		
		echo "<form method=\"post\" action=\"index.php\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"skinremovetypeconfirm\" />\n";
		$manager->addTicketHidden();
		echo "<input type=\"hidden\" name=\"skinid\" value=\"{$skinid}\" />\n";
		echo '<input type="hidden" name="type" value="' . Entity::hsc($skintype) . '" />' . "\n";
		echo '<input type="submit" tabindex="10" value="' . _DELETE_CONFIRM_BTN . '" />' . "\n";
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_skinremovetypeconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_skinremovetypeconfirm()
	{
		global $member, $CONF, $manager;
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		if ( !isValidShortName($skintype) )
		{
			$this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
		}
		
		$member->isAdmin() or $this->disallow();
		
		// don't allow default skinparts to be deleted
		$skin = new Skin($skinid);
		$default_skin_types = $skin->getDefaultTypes();
		if ( array_key_exists($skintype, $default_skin_types) )
		{
			$this->error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
		}
		
		$data = array(
			'skinid'	=> $skinid,
			'skintype'	=> $skintype
		);
		$manager->notify('PreDeleteSkinPart', $data);
		
		// delete part
		$query = "DELETE FROM %s WHERE sdesc=%d AND stype='%s';";
		$query = sprintf($query, sql_table('skin'), (integer) $skinid, $skintype);
		DB::execute($query);
		
		$data = array(
			'skinid'	=> $skinid,
			'skintype'	=> $skintype
		);
		$manager->notify('PostDeleteSkinPart', $data);
		
		$this->action_skinedit();
		return;
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
        if (Skin::exists($name)) {
            $i = 1;
            while (Skin::exists($name . $i))
                $i++;
            $name .= $i;
        }

        // 2. create skin desc
        $newid = Skin::createNew(
            $name,
            $skin->getDescription(),
            $skin->getContentType(),
            $skin->getIncludeMode(),
            $skin->getIncludePrefix()
        );
        
        $query = "SELECT stype FROM " . sql_table('skin') . " WHERE sdesc = " . $skinid;
        $res = DB::getResult($query);
        foreach ( $res as $row) {
            $this->skinclonetype($skin, $newid, $row['stype']);
        }

        $this->action_skinoverview();

    }

	/**
	 * Admin::skinclonetype()
	 * 
	 * @param	String	$skin	Skin object
	 * @param	Integer	$newid	ID for this clone
	 * @param	String	$type	type of skin
	 * @return	Void
	 */
	function skinclonetype($skin, $newid, $type)
	{
		$newid = intval($newid);
		$content = $skin->getContentFromDB($type);
		
		if ( $content )
		{
			$query = "INSERT INTO %s (sdesc, scontent, stype) VALUES (%d, '%s', '%s')";
			$query = sprintf($query, sql_table('skin'), (integer) $newid, $content, $type);
			DB::execute($query);
		}
		return;
	}
	
	/**
	 * Admin::action_settingsedit()
	 * 
	 * @param	Void
	 * @return	Void
	 */
	function action_settingsedit() {
		global $member, $manager, $CONF, $DIR_NUCLEUS, $DIR_MEDIA;

		$member->isAdmin() or $this->disallow();

		$this->pagehead();

		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
		?>

		<h2><?php echo _SETTINGS_TITLE ?></h2>

		<form action="index.php" method="post">
		<div>

		<input type="hidden" name="action" value="settingsupdate" />
		<?php $manager->addTicketHidden() ?>

		<table><tr>
			<th colspan="2"><?php echo _SETTINGS_SUB_GENERAL ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_DEFBLOG ?> <?php help('defaultblog'); ?></td>
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
			<td><?php echo _SETTINGS_BASESKIN ?> <?php help('baseskin'); ?></td>
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
			<td><?php echo _SETTINGS_ADMINMAIL ?></td>
			<td><input name="AdminEmail" tabindex="10010" size="40" value="<?php echo  Entity::hsc($CONF['AdminEmail']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SITENAME ?></td>
			<td><input name="SiteName" tabindex="10020" size="40" value="<?php echo  Entity::hsc($CONF['SiteName']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SITEURL ?></td>
			<td><input name="IndexURL" tabindex="10030" size="40" value="<?php echo  Entity::hsc($CONF['IndexURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ADMINURL ?></td>
			<td><input name="AdminURL" tabindex="10040" size="40" value="<?php echo  Entity::hsc($CONF['AdminURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_PLUGINURL ?> <?php help('pluginurl'); ?></td>
			<td><input name="PluginURL" tabindex="10045" size="40" value="<?php echo  Entity::hsc($CONF['PluginURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SKINSURL ?> <?php help('skinsurl'); ?></td>
			<td><input name="SkinsURL" tabindex="10046" size="40" value="<?php echo  Entity::hsc($CONF['SkinsURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ACTIONSURL ?> <?php help('actionurl'); ?></td>
			<td><input name="ActionURL" tabindex="10047" size="40" value="<?php echo  Entity::hsc($CONF['ActionURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_LOCALE ?> <?php help('locale'); ?>
			</td>
			<td>
				<select name="Locale" tabindex="10050">
			<?php
				$locales = i18n::get_available_locale_list();
				if ( !i18n::get_current_locale() || !in_array(i18n::get_current_locale(), $locales) )
				{
					echo "<option value=\"\" selected=\"selected\">en_Latn_US</option>\n";
				}
				else
				{
					echo "<option value=\"\">en_Latn_US</option>\n";
				}
				
				foreach ( $locales as $locale )
				{
					if ( $locale == 'en_Latn_US' )
					{
						continue;
					}
					if ( $locale == i18n::get_current_locale() )
					{
						echo "<option value=\"{$locale}\" selected=\"selected\">{$locale}</option>\n";
					}
					else
					{
						echo "<option value=\"{$locale}\">{$locale}</option>\n";
					}
				}
			?>
			</select>

			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_DISABLESITE ?> <?php help('disablesite'); ?>
			</td>
			<td><?php $this->input_yesno('DisableSite',$CONF['DisableSite'],10060); ?>
					<br />
				<?php echo _SETTINGS_DISABLESITEURL ?> <input name="DisableSiteURL" tabindex="10070" size="40" value="<?php echo  Entity::hsc($CONF['DisableSiteURL']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_DIRS ?></td>
			<td><?php echo  Entity::hsc($DIR_NUCLEUS) ?>
				<i><?php echo _SETTINGS_SEECONFIGPHP ?></i></td>
		</tr><tr>
			<td><?php echo _SETTINGS_DBLOGIN ?></td>
			<td><i><?php echo _SETTINGS_SEECONFIGPHP ?></i></td>
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
			<td><?php /* $this->input_yesno('DisableJsTools',$CONF['DisableJsTools'],10075); */ ?>
				<select name="DisableJsTools" tabindex="10075">
			<?php				   $extra = ($CONF['DisableJsTools'] == 1) ? 'selected="selected"' : '';
					echo "<option $extra value='1'>",_SETTINGS_JSTOOLBAR_NONE,"</option>";
					$extra = ($CONF['DisableJsTools'] == 2) ? 'selected="selected"' : '';
					echo "<option $extra value='2'>",_SETTINGS_JSTOOLBAR_SIMPLE,"</option>";
					$extra = ($CONF['DisableJsTools'] == 0) ? 'selected="selected"' : '';
					echo "<option $extra value='0'>",_SETTINGS_JSTOOLBAR_FULL,"</option>";
			?>
				</select>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_URLMODE ?> <?php help('urlmode'); ?></td>
					   <td><?php

					   $this->input_yesno('URLMode',$CONF['URLMode'],10077,
							  'normal','pathinfo',_SETTINGS_URLMODE_NORMAL,_SETTINGS_URLMODE_PATHINFO);

					   echo ' ', _SETTINGS_URLMODE_HELP;

							 ?>

					   </td>
		</tr><tr>
			<td><?php echo _SETTINGS_DEBUGVARS ?> <?php help('debugvars'); ?></td>
					   <td><?php

						$this->input_yesno('DebugVars',$CONF['DebugVars'],10078);

							 ?>

					   </td>
		</tr><tr>
			<td><?php echo _SETTINGS_DEFAULTLISTSIZE ?> <?php help('defaultlistsize'); ?></td>
			<td>
			<?php
				if (!array_key_exists('DefaultListSize',$CONF)) {
					DB::execute("INSERT INTO ".sql_table('config')." VALUES ('DefaultListSize', '10')");
					$CONF['DefaultListSize'] = 10;
				}
			?>
				<input name="DefaultListSize" tabindex="10079" size="40" value="<?php echo  Entity::hsc((intval($CONF['DefaultListSize']) < 1 ? '10' : $CONF['DefaultListSize'])) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_ADMINCSS ?> 
			</td>
			<td>

				<select name="AdminCSS" tabindex="10080">
				<?php			   // show a dropdown list of all available admin css files
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
			<th colspan="2"><?php echo _SETTINGS_MEDIA ?> <?php help('media'); ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_MEDIADIR ?></td>
			<td><?php echo  Entity::hsc($DIR_MEDIA) ?>
				<i><?php echo _SETTINGS_SEECONFIGPHP ?></i>
				<?php				   if (!is_dir($DIR_MEDIA))
						echo "<br /><b>" . _WARNING_NOTADIR . "</b>";
					if (!is_readable($DIR_MEDIA))
						echo "<br /><b>" . _WARNING_NOTREADABLE . "</b>";
					if (!is_writeable($DIR_MEDIA))
						echo "<br /><b>" . _WARNING_NOTWRITABLE . "</b>";
				?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_MEDIAURL ?></td>
			<td>
				<input name="MediaURL" tabindex="10090" size="40" value="<?php echo  Entity::hsc($CONF['MediaURL']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_ALLOWUPLOAD ?></td>
			<td><?php $this->input_yesno('AllowUpload',$CONF['AllowUpload'],10090); ?></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ALLOWUPLOADTYPES ?></td>
			<td>
				<input name="AllowedTypes" tabindex="10100" size="40" value="<?php echo  Entity::hsc($CONF['AllowedTypes']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_MAXUPLOADSIZE ?></td>
			<td>
				<input name="MaxUploadSize" tabindex="10105" size="40" value="<?php echo  Entity::hsc($CONF['MaxUploadSize']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_MEDIAPREFIX ?></td>
			<td><?php $this->input_yesno('MediaPrefix',$CONF['MediaPrefix'],10110); ?></td>

		</tr><tr>
			<th colspan="2"><?php echo _SETTINGS_MEMBERS ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_CHANGELOGIN ?></td>
			<td><?php $this->input_yesno('AllowLoginEdit',$CONF['AllowLoginEdit'],10120); ?></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ALLOWCREATE ?>
				<?php help('allowaccountcreation'); ?>
			</td>
			<td><?php $this->input_yesno('AllowMemberCreate',$CONF['AllowMemberCreate'],10130); ?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_NEWLOGIN ?> <?php help('allownewmemberlogin'); ?>
				<br /><?php echo _SETTINGS_NEWLOGIN2 ?>
			</td>
			<td><?php $this->input_yesno('NewMemberCanLogon',$CONF['NewMemberCanLogon'],10140); ?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_MEMBERMSGS ?>
				<?php help('messageservice'); ?>
			</td>
			<td><?php $this->input_yesno('AllowMemberMail',$CONF['AllowMemberMail'],10150); ?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_NONMEMBERMSGS ?>
				<?php help('messageservice'); ?>
			</td>
			<td><?php $this->input_yesno('NonmemberMail',$CONF['NonmemberMail'],10155); ?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_PROTECTMEMNAMES ?>
				<?php help('protectmemnames'); ?>
			</td>
			<td><?php $this->input_yesno('ProtectMemNames',$CONF['ProtectMemNames'],10156); ?>
			</td>



		</tr><tr>
			<th colspan="2"><?php echo _SETTINGS_COOKIES_TITLE ?> <?php help('cookies'); ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIEPREFIX ?></td>
			<td><input name="CookiePrefix" tabindex="10159" size="40" value="<?php echo  Entity::hsc($CONF['CookiePrefix']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIEDOMAIN ?></td>
			<td><input name="CookieDomain" tabindex="10160" size="40" value="<?php echo  Entity::hsc($CONF['CookieDomain']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIEPATH ?></td>
			<td><input name="CookiePath" tabindex="10170" size="40" value="<?php echo  Entity::hsc($CONF['CookiePath']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIESECURE ?></td>
			<td><?php $this->input_yesno('CookieSecure',$CONF['CookieSecure'],10180); ?></td>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIELIFE ?></td>
			<td><?php $this->input_yesno('SessionCookie',$CONF['SessionCookie'],10190,
							  1,0,_SETTINGS_COOKIESESSION,_SETTINGS_COOKIEMONTH); ?>
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_LASTVISIT ?></td>
			<td><?php $this->input_yesno('LastVisit',$CONF['LastVisit'],10200); ?></td>



		</tr><tr>
			<th colspan="2"><?php echo _SETTINGS_UPDATE ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_UPDATE ?></td>
			<td><input type="submit" tabindex="10210" value="<?php echo _SETTINGS_UPDATE_BTN ?>" onclick="return checkSubmit();" /></td>
		</tr></table>

		</div>
		</form>

		<?php
			echo '<h2>',_PLUGINS_EXTRA,'</h2>';

			$manager->notify(
				'GeneralSettingsFormExtras',
				array()
			);

		$this->pagefoot();
	}
	
	/**
	 * Admin::action_settingsupdate()
	 * Update $CONFIG and redirect
	 * 
	 * @param	void
	 * @return	void
	 */
	function action_settingsupdate() {
		global $member, $CONF;
		
		$member->isAdmin() or $this->disallow();
		
		// check if email address for admin is valid
		if ( !NOTIFICATION::address_validation(postVar('AdminEmail')) )
		{
			$this->error(_ERROR_BADMAILADDRESS);
		}
		
		// save settings
		$this->updateConfig('DefaultBlog',	  postVar('DefaultBlog'));
		$this->updateConfig('BaseSkin',		 postVar('BaseSkin'));
		$this->updateConfig('IndexURL',		 postVar('IndexURL'));
		$this->updateConfig('AdminURL',		 postVar('AdminURL'));
		$this->updateConfig('PluginURL',		postVar('PluginURL'));
		$this->updateConfig('SkinsURL',		 postVar('SkinsURL'));
		$this->updateConfig('ActionURL',		postVar('ActionURL'));
		$this->updateConfig('Locale',		   postVar('Locale'));
		$this->updateConfig('AdminEmail',	   postVar('AdminEmail'));
		$this->updateConfig('SessionCookie',	postVar('SessionCookie'));
		$this->updateConfig('AllowMemberCreate',postVar('AllowMemberCreate'));
		$this->updateConfig('AllowMemberMail',  postVar('AllowMemberMail'));
		$this->updateConfig('NonmemberMail',	postVar('NonmemberMail'));
		$this->updateConfig('ProtectMemNames',  postVar('ProtectMemNames'));
		$this->updateConfig('SiteName',		 postVar('SiteName'));
		$this->updateConfig('NewMemberCanLogon',postVar('NewMemberCanLogon'));
		$this->updateConfig('DisableSite',	  postVar('DisableSite'));
		$this->updateConfig('DisableSiteURL',   postVar('DisableSiteURL'));
		$this->updateConfig('LastVisit',		postVar('LastVisit'));
		$this->updateConfig('MediaURL',		 postVar('MediaURL'));
		$this->updateConfig('AllowedTypes',	 postVar('AllowedTypes'));
		$this->updateConfig('AllowUpload',	  postVar('AllowUpload'));
		$this->updateConfig('MaxUploadSize',	postVar('MaxUploadSize'));
		$this->updateConfig('MediaPrefix',	  postVar('MediaPrefix'));
		$this->updateConfig('AllowLoginEdit',   postVar('AllowLoginEdit'));
		$this->updateConfig('DisableJsTools',   postVar('DisableJsTools'));
		$this->updateConfig('CookieDomain',	 postVar('CookieDomain'));
		$this->updateConfig('CookiePath',	   postVar('CookiePath'));
		$this->updateConfig('CookieSecure',	 postVar('CookieSecure'));
		$this->updateConfig('URLMode',		  postVar('URLMode'));
		$this->updateConfig('CookiePrefix',	 postVar('CookiePrefix'));
		$this->updateConfig('DebugVars',			postVar('DebugVars'));
		$this->updateConfig('DefaultListSize',		  postVar('DefaultListSize'));
		$this->updateConfig('AdminCSS',		  postVar('AdminCSS'));
		
		// load new config and redirect (this way, the new locale will be used is necessary)
		// note that when changing cookie settings, this redirect might cause the user
		// to have to log in again.
		getConfig();
		redirect($CONF['AdminURL'] . '?action=manage');
		exit;
	}

	/**
	 * Admin::action_systemoverview()
	 * Output system overview
	 * 
	 * @param	void
	 * @return	void
	 */
	function action_systemoverview()
	{
		global $member, $nucleus, $CONF;
		
		$this->pagehead();
		
		echo '<h2>' . _ADMIN_SYSTEMOVERVIEW_HEADING . "</h2>\n";
		
		if ( $member->isLoggedIn() && $member->isAdmin() )
		{
			// Information about the used PHP and MySQL installation
			echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL . "</h3>\n\n";
			
			// Version of PHP MySQL
			echo '<table frame="box" rules="all" summary="' . _ADMIN_SYSTEMOVERVIEW_VERSIONS . "\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_VERSIONS . "</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			echo "<tr>\n";
			echo '<td>' . _ADMIN_SYSTEMOVERVIEW_PHPVERSION . "</td>\n";
			echo '<td>' . phpversion() . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>' . _ADMIN_SYSTEMOVERVIEW_MYSQLVERSION . "</td>\n";
			echo '<td>' . DB::getAttribute(PDO::ATTR_SERVER_VERSION) . ' (' . DB::getAttribute(PDO::ATTR_CLIENT_VERSION) . ')' . "</td>\n";
			echo "</tr>\n";
			echo "</tbody>\n";
			echo "</table>\n\n";
			
			// Important PHP settings
			echo '<table frame="box" rules="all" summary="' . _ADMIN_SYSTEMOVERVIEW_SETTINGS . "\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_SETTINGS . "</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			echo "<tr>\n";
			echo '<td>magic_quotes_gpc' . "</td>\n";
			$mqg = get_magic_quotes_gpc() ? 'On' : 'Off';
			echo '<td>' . $mqg . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>magic_quotes_runtime' . "</td>\n";
			$mqr = get_magic_quotes_runtime() ? 'On' : 'Off';
			echo '<td>' . $mqr . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>register_globals' . "</td>\n";
			$rg = ini_get('register_globals') ? 'On' : 'Off';
			echo '<td>' . $rg . "</td>\n";
			echo "</tr>\n";
			echo "</tbody>\n";
			echo "</table>\n\n";
			
			// Information about GD library
			$gdinfo = gd_info();
			echo '<table frame="box" rules="all" summary="' . _ADMIN_SYSTEMOVERVIEW_GDLIBRALY . "\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_GDLIBRALY . "</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			foreach ( $gdinfo as $key=>$value )
			{
				if ( is_bool($value) )
				{
					$value = $value ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE;
				}
				else
				{
					$value = Entity::hsc($value);
				}
				echo "<tr>\n";
				echo '<td>' . $key . "</td>\n";
				echo '<td>' . $value . "</td>\n";
				echo "</tr>\n";
			}
			echo "</tbody>\n";
			echo "</table>\n\n";

			// Check if special modules are loaded
			ob_start();
			phpinfo(INFO_MODULES);
			$im = ob_get_contents();
			ob_clean();
			echo '<table frame="box" rules="all" summary="' . _ADMIN_SYSTEMOVERVIEW_MODULES . "\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>";
			echo '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_MODULES . "</th>\n";
			echo "</tr>\n";
			echo "<tbody>\n";
			echo "<tr>\n";
			echo '<td>mod_rewrite' . "</td>\n";
			$modrewrite = (i18n::strpos($im, 'mod_rewrite') !== FALSE) ?
						_ADMIN_SYSTEMOVERVIEW_ENABLE :
						_ADMIN_SYSTEMOVERVIEW_DISABLE;
			echo '<td>' . $modrewrite . "</td>\n";
			echo "</tr>\n";
			echo "</tbody>\n";
			echo "</table>\n\n";

			// Information about the used Nucleus CMS
			echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM . "</h3>\n";
			global $nucleus;
			$nv = getNucleusVersion() / 100 . '(' . $nucleus['version'] . ')';
			$np = getNucleusPatchLevel();
			echo "<table frame=\"box\" rules=\"all\" summary=\"Nucleus CMS\" class=\"systemoverview\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo '<th colspan="2">Nucleus CMS' . "</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			echo "<tr>\n";
			echo '<td>' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION . "</td>\n";
			echo '<td>' . $nv . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL . "</td>\n";
			echo '<td>' . $np . "</td>\n";
			echo "</tr>\n";
			echo "</tbody>\n";
			echo "</table>\n\n";

			// Important settings of the installation
			echo '<table frame="box" rules="all" summary="' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS . "\" class=\"systemoverview\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo '<th colspan="2">' . _ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS . "</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			echo "<tr>\n";
			echo '<td>' . '$CONF[' . "'Self']</td>\n";
			echo '<td>' . $CONF['Self'] . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>' . '$CONF[' . "'ItemURL']</td>\n";
			echo '<td>' . $CONF['ItemURL'] . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo '<td>' . '$CONF[' . "'alertOnHeadersSent']</td>\n";
			$ohs = $CONF['alertOnHeadersSent'] ?
						_ADMIN_SYSTEMOVERVIEW_ENABLE :
						_ADMIN_SYSTEMOVERVIEW_DISABLE;
			echo '<td>' . $ohs . "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td>i18n::get_current_charset()</td>\n";
			echo '<td>' . i18n::get_current_charset() . "</td>\n";
			echo "</tr>\n";
			echo "</tbody>\n";
			echo "</table>\n\n";

			// Link to the online version test at the Nucleus CMS website
			echo '<h3>' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK . "</h3>\n";
			if ( $nucleus['codename'] != '')
			{
				$codenamestring = ' &quot;' . $nucleus['codename'] . '&quot;';
			}
			else
			{
				$codenamestring = '';
			}
			echo _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT;
			$checkURL = sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
			echo '<a href="' . $checkURL . '" title="' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE . '">';
			echo 'Nucleus CMS ' . $nv . $codenamestring;
			echo '</a>';
		}
		else
		{
			echo _ADMIN_SYSTEMOVERVIEW_NOT_ADMIN;
		}
		$this->pagefoot();
	}

	/**
	 * Admin::updateConfig()
	 * 
	 * @param	string	$name	
	 * @param	string	$val	
	 * @return	integer	return the ID in which the latest query posted
	 */
	function updateConfig($name, $val)
	{
		$name = DB::quoteValue($name);
		$val = DB::quoteValue(trim($val));
		
		$query = "UPDATE %s SET value=%s WHERE name=%s";
		$query = sprintf($query, sql_table('config'), $val, $name);
		if ( DB::execute($query) === FALSE )
		{
			$err = DB::getError();
			die("Query error: " . $err[2]);
		}
		return DB::getInsertId();
	}
	
	/**
	 * Error message
	 * @param string $msg message that will be shown
	 */
	function error($msg)
	{
		$this->pagehead();
		
		echo "<h2>Error!</h2>\n";
		echo $msg;
		echo "<br />\n";
		echo '<a href="index.php" onclick="history.back()">' . _BACK . "</a>\n";
		$this->pagefoot();
		exit;
	}
	
	/**
	 * Admin::disallow()
	 * add error log and show error page 
	 * 
	 * @param	void
	 * @return	void
	 */
	function disallow()
	{
		ActionLog::add(WARNING, _ACTIONLOG_DISALLOWED . serverVar('REQUEST_URI'));
		$this->error(_ERROR_DISALLOWED);
	}
	
	/**
	 * Admin::pagehead()
	 * Output admin page head
	 * 
	 * @param	void
	 * @return	void
	 */
	function pagehead($extrahead = '')
	{
		global $member, $nucleus, $CONF, $manager;
		
		$manager->notify(
			'AdminPrePageHead',
			array(
				'extrahead' => &$extrahead,
				'action' => $this->action));
		
		$baseUrl = Entity::hsc($CONF['AdminURL']);
		if ( !array_key_exists('AdminCSS',$CONF) )
		{
			DB::execute("INSERT INTO ".sql_table('config')." VALUES ('AdminCSS', 'original')");
			$CONF['AdminCSS'] = 'original';
		}
		
		/* HTTP 1.1 application for no caching */
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		
		$root_element = 'html';
		$charset = i18n::get_current_charset();
		$locale = preg_replace('#_#', '-', i18n::get_current_locale());
		
		echo "<?xml version=\"{$this->xml_version_info}\" encoding=\"{$charset}\" ?>\n";
		echo "<!DOCTYPE {$root_element} PUBLIC \"{$this->formal_public_identifier}\" \"{$this->system_identifier}\">\n";
		echo "<{$root_element} xmlns=\"{$this->xhtml_namespace}\" xml:lang=\"{$locale}\" lang=\"{$locale}\">\n";
		echo "<head>\n";
		echo '<title>' . Entity::hsc($CONF['SiteName']) . " - Admin</title>\n";
		echo "<link rel=\"stylesheet\" title=\"Nucleus Admin Default\" type=\"text/css\" href=\"{$baseUrl}styles/admin_{$CONF["AdminCSS"]}.css\" />\n";
		echo "<link rel=\"stylesheet\" title=\"Nucleus Admin Default\" type=\"text/css\" href=\"{$baseUrl}styles/addedit.css\" />\n";
		echo "<script type=\"text/javascript\" src=\"{$baseUrl}javascript/edit.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"{$baseUrl}javascript/admin.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"{$baseUrl}javascript/compatibility.js\"></script>\n";
		echo "{$extrahead}\n";
		echo "</head>\n\n";
		echo "<body>\n";
		echo "<div id=\"adminwrapper\">\n";
		echo "<div class=\"header\">\n";
		echo '<h1>' . Entity::hsc($CONF['SiteName']) . "</h1>\n";
		echo "</div>\n";
		echo "<div id=\"container\">\n";
		echo "<div id=\"content\">\n";
		echo "<div class=\"loginname\">\n";
		if ( $member->isLoggedIn() )
		{
			echo _LOGGEDINAS . ' ' . $member->getDisplayName() ." - <a href='index.php?action=logout'>" . _LOGOUT. "</a><br />\n";
			echo "<a href='index.php?action=overview'>" . _ADMINHOME . "</a> - ";
		}
		else
		{
			echo '<a href="index.php?action=showlogin" title="Log in">' . _NOTLOGGEDIN . "</a><br />\n";
		}
		echo "<a href='".$CONF['IndexURL']."'>"._YOURSITE."</a><br />\n";
		echo '(';
		
		if (array_key_exists('codename', $nucleus) && $nucleus['codename'] != '' )
		{
			$codenamestring = ' &quot;' . $nucleus['codename'].'&quot;';
		}
		else
		{
			$codenamestring = '';
		}
		
		if ( $member->isLoggedIn() && $member->isAdmin() )
		{
			$checkURL = sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
			echo '<a href="' . $checkURL . '" title="' . _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE . '">Nucleus CMS ' . $nucleus['version'] . $codenamestring . '</a>';
			
			$newestVersion = getLatestVersion();
			$newestCompare = str_replace('/','.',$newestVersion);
			$currentVersion = str_replace(array('/','v'),array('.',''),$nucleus['version']);
			if ( $newestVersion && version_compare($newestCompare, $currentVersion) > 0 )
			{
				echo "<br />\n";
				echo '<a style="color:red" href="http://nucleuscms.org/upgrade.php" title="' . _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE . '">';
				echo _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT . $newestVersion;
				echo "</a>";
			}
		}
		else
		{
			echo 'Nucleus CMS ' . $nucleus['version'] . $codenamestring;
		}
		echo ')';
		echo '</div>';
		return;
	}
	
	/**
	 * Admin::pagefoot()
	 * Output admin page foot include quickmenu
	 * 
	 * @param	void
	 * @return	void
	 */
	function pagefoot()
	{
		global $action, $member, $manager;
		
		$manager->notify(
			'AdminPrePageFoot',
			array('action' => $this->action)
		);
		
		if ( $member->isLoggedIn() && ($action != 'showlogin') )
		{
			echo '<h2>' . _LOGOUT . "</h2>\n";
			echo "<ul>\n";
			echo '<li><a href="index.php?action=overview">' . _BACKHOME . "</a></li>\n";
			echo '<li><a href="index.php?action=logout">' .  _LOGOUT . "</a></li>\n";
			echo "</ul>\n";
		}
		
		echo "<div class=\"foot\">\n";
		echo '<a href="' . _ADMINPAGEFOOT_OFFICIALURL . '">Nucleus CMS</a> &copy; 2002-' . date('Y') . ' ' . _ADMINPAGEFOOT_COPYRIGHT;
		echo '-';
		echo '<a href="' . _ADMINPAGEFOOT_DONATEURL . '">' . _ADMINPAGEFOOT_DONATE . "</a>\n";
		echo "</div>\n";
		
		echo "<!-- content -->\n";
		echo "<div id=\"quickmenu\">\n";
		
		if ( ($action != 'showlogin') && ($member->isLoggedIn()) )
		{
			echo "<ul>\n";
			echo '<li><a href="index.php?action=overview">' . _QMENU_HOME . "</a></li>\n";
			echo "</ul>\n";
			
			echo '<h2>' . _QMENU_ADD . "</h2>\n";
			echo "<form method=\"get\" action=\"index.php\">\n";
			echo "<p>\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"createitem\" />\n";
			
			$showAll = requestVar('showall');
			
			if ( ($member->isAdmin()) && ($showAll == 'yes') )
			{
				// Super-Admins have access to all blogs! (no add item support though)
				$query =  'SELECT bnumber as value, bname as text'
						. ' FROM ' . sql_table('blog')
						. ' ORDER BY bname';
			}
			else
			{
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
			
			echo "</p>\n";
			echo "</form>\n";
			
			echo "<h2>{$member->getDisplayName()}</h2>\n";
			echo "<ul>\n";
			echo '<li><a href="index.php?action=editmembersettings">' . _QMENU_USER_SETTINGS . "</a></li>\n";
			echo '<li><a href="index.php?action=browseownitems">' . _QMENU_USER_ITEMS . "</a></li>\n";
			echo '<li><a href="index.php?action=browseowncomments">' . _QMENU_USER_COMMENTS . "</a></li>\n";
			echo "</ul>\n";
			
			// ---- general settings ----
			if ( $member->isAdmin() )
			{
				echo '<h2>' . _QMENU_MANAGE . "</h2>\n";
				echo "<ul>\n";
				echo '<li><a href="index.php?action=actionlog">' . _QMENU_MANAGE_LOG . "</a></li>\n";
				echo '<li><a href="index.php?action=settingsedit">' . _QMENU_MANAGE_SETTINGS . "</a></li>\n";
				echo '<li><a href="index.php?action=systemoverview">' . _QMENU_MANAGE_SYSTEM . "</a></li>\n";
				echo '<li><a href="index.php?action=usermanagement">' . _QMENU_MANAGE_MEMBERS . "</a></li>\n";
				echo '<li><a href="index.php?action=createnewlog">' . _QMENU_MANAGE_NEWBLOG . "</a></li>\n";
				echo '<li><a href="index.php?action=backupoverview">' . _QMENU_MANAGE_BACKUPS . "</a></li>\n";
				echo '<li><a href="index.php?action=pluginlist">' . _QMENU_MANAGE_PLUGINS . "</a></li>\n";
				echo "</ul>\n";
				
				echo "<h2>" . _QMENU_LAYOUT . "</h2>\n";
				echo "<ul>\n";
				echo '<li><a href="index.php?action=skinoverview">' . _QMENU_LAYOUT_SKINS . "</a></li>\n";
				echo '<li><a href="index.php?action=templateoverview">' . _QMENU_LAYOUT_TEMPL . "</a></li>\n";
				echo '<li><a href="index.php?action=skinieoverview">' . _QMENU_LAYOUT_IEXPORT . "</a></li>\n";
				echo "</ul>\n";
			}
			
			$aPluginExtras = array();
			$manager->notify(
				'QuickMenu',
				array(
					'options' => &$aPluginExtras));
			
			if ( count($aPluginExtras) > 0 )
			{
				echo "<h2>" . _QMENU_PLUGINS . "</h2>\n";
				echo "<ul>\n";
				foreach ( $aPluginExtras as $aInfo )
				{
					echo '<li><a href="' . Entity::hsc($aInfo['url']) . '" title="' . Entity::hsc($aInfo['tooltip']) . '">' . Entity::hsc($aInfo['title']) . "</a></li>\n";
				}
				echo "</ul>\n";
			}
		}
		else if ( ($action == 'activate') || ($action == 'activatesetpwd') )
		{
		
			echo '<h2>' . _QMENU_ACTIVATE . '</h2>' . _QMENU_ACTIVATE_TEXT;
		}
		else
		{
			// introduction text on login screen
			echo '<h2>' . _QMENU_INTRO . '</h2>' . _QMENU_INTRO_TEXT;
		}
		
		echo "<!-- quickmenu -->\n";
		echo "</div>\n";
		
		echo "<!-- content -->\n";
		echo "</div>\n";
		
		echo "<!-- container -->\n";
		echo "</div>\n";
		
		echo "<!-- adminwrapper -->\n";
		echo "</div>\n";
		
		echo "</body>\n";
		echo "</html>\n";
		return;
	}
	
	/**
	 * Admin::action_bookmarklet()
	 * 
	 * @param	void
	 * @return	void
	 */
	public function action_bookmarklet()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		$member->teamRights($blogid) or $this->disallow();
		$blog =& $manager->getBlog($blogid);
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(' . _BACKHOME . ")</a></p>\n";
		
		echo '<h2>' . _BOOKMARKLET_TITLE . "</h2>\n";
		echo '<p>';
		echo _BOOKMARKLET_DESC1 . _BOOKMARKLET_DESC2 . _BOOKMARKLET_DESC3 . _BOOKMARKLET_DESC4 . _BOOKMARKLET_DESC5;
		echo "</p>\n";
		
		echo '<h3>' . _BOOKMARKLET_BOOKARKLET . "</h3>\n";
		echo '<p>';
		echo _BOOKMARKLET_BMARKTEXT . '<small>' . _BOOKMARKLET_BMARKTEST . '</small>';
		echo "</p>\n";
		echo '<p>';
		echo '<a href="javascript:' . rawurlencode(getBookmarklet($blogid)) . '">' . sprintf(_BOOKMARKLET_ANCHOR, Entity::hsc($blog->getName())) . '</a>';
		echo _BOOKMARKLET_BMARKFOLLOW;
		echo "</p>\n";
		
		$this->pagefoot();
		return;
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
            <h2><?php echo _ACTIONLOG_CLEAR_TITLE ?></h2>
            <p><a href="<?php echo Entity::hsc($url) ?>"><?php echo _ACTIONLOG_CLEAR_TEXT ?></a></p>
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
        $banBlogName =  Entity::hsc($blog->getName());

        $this->pagehead();
        ?>
            <h2><?php echo _BAN_REMOVE_TITLE ?></h2>

            <form method="post" action="index.php">

            <h3><?php echo _BAN_IPRANGE ?></h3>

            <p>
                <?php echo _CONFIRMTXT_BAN ?> <?php echo Entity::hsc($iprange) ?>
                <input name="iprange" type="hidden" value="<?php echo Entity::hsc($iprange) ?>" />
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
    function action_banlistdeleteconfirm() {
        global $member, $manager;

        $blogid = intPostVar('blogid');
        $allblogs = postVar('allblogs');
        $iprange = postVar('iprange');

        $member->blogAdminRights($blogid) or $this->disallow();

        $deleted = array();

        if (!$allblogs) {
            if (Ban::removeBan($blogid, $iprange))
                array_push($deleted, $blogid);
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            foreach ($adminblogs as $blogje) {
                if (Ban::removeBan($blogje, $iprange))
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
            echo "<li>" . Entity::hsc($b->getName()). "</li>";
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
            $iprangeVal = Entity::hsc($ip);
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
            <input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">'<?php echo Entity::hsc($blog->getName()) ?>'</label>
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
            if (!Ban::addBan($blogid, $iprange, $reason))
                $this->error(_ERROR_ADDBAN);
        } else {
            // get blogs fot which member has admin rights
            $adminblogs = $member->getAdminBlogs();
            $failed = 0;
            foreach ($adminblogs as $blogje) {
                if (!Ban::addBan($blogje, $iprange, $reason))
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

        ActionLog::clear();

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
        <h2><?php echo _BACKUPS_TITLE ?></h2>

        <h3><?php echo _BACKUP_TITLE ?></h3>

        <p><?php echo _BACKUP_INTRO ?></p>

        <form method="post" action="index.php"><p>
        <input type="hidden" name="action" value="backupcreate" />
        <?php $manager->addTicketHidden() ?>

        <input type="radio" name="gzip" value="1" checked="checked" id="gzip_yes" tabindex="10" /><label for="gzip_yes"><?php echo _BACKUP_ZIP_YES ?></label>
        <br />
        <input type="radio" name="gzip" value="0" id="gzip_no" tabindex="10" /><label for="gzip_no" ><?php echo _BACKUP_ZIP_NO ?></label>
        <br /><br />
        <input type="submit" value="<?php echo _BACKUP_BTN ?>" tabindex="20" />

        </p></form>

        <div class="note"><?php echo _BACKUP_NOTE ?></div>


        <h3><?php echo _RESTORE_TITLE ?></h3>

        <div class="note"><?php echo _RESTORE_NOTE ?></div>

        <p><?php echo _RESTORE_INTRO ?></p>

        <form method="post" action="index.php" enctype="multipart/form-data"><p>
            <input type="hidden" name="action" value="backuprestore" />
            <?php $manager->addTicketHidden() ?>
            <input name="backup_file" type="file" tabindex="30" />
            <br /><br />
            <input type="submit" value="<?php echo _RESTORE_BTN ?>" tabindex="40" />
            <br /><input type="checkbox" name="letsgo" value="1" id="letsgo" tabindex="50" /><label for="letsgo"><?php echo _RESTORE_IMSURE ?></label>
            <br /><?php echo _RESTORE_WARNING ?>
        </p></form>

        <?php       $this->pagefoot();
    }

	/**
	 * Admin::action_backupcreate()
	 * create file for backup
	 * 
	 * @param		void
	 * @return	void
	 * 
	 */
	function action_backupcreate()
	{
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or $this->disallow();
		
		// use compression ?
		$useGzip = (integer) postVar('gzip');
		
		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		Backup::do_backup($useGzip);
		exit;
	}
	
	/**
	 * Admin::action_backuprestore()
	 * restoring from uploaded file
	 * 
	 * @param		void
	 * @return	void
	 */
	function action_backuprestore()
	{
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or $this->disallow();
		
		if ( intPostVar('letsgo') != 1 )
		{
			$this->error(_ERROR_BACKUP_NOTSURE);
		}
		
		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		$message = Backup::do_restore();
		if ( $message != '' )
		{
			$this->error($message);
		}
		$this->pagehead();
		echo '<h2>' . _RESTORE_COMPLETE . "</h2>\n";
		$this->pagefoot();
		return;
	}
	
	/**
	 * Admin::action_pluginlist()
	 * output the list of installed plugins
	 * 
	 * @param	void
	 * @return	void
	 * 
	 */
	function action_pluginlist()
	{
		global $DIR_PLUGINS, $member, $manager;
		
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
		
		echo '<h3>' . _PLUGS_TITLE_UPDATE . "</h3>\n";
		echo '<p>' . _PLUGS_TEXT_UPDATE . "</p>\n";
		echo '<form method="post" action="index.php">' . "\n";
		echo "<div>\n";
		echo '<input type="hidden" name="action" value="pluginupdate" />' . "\n";
		$manager->addTicketHidden();
		echo '<input type="submit" value="' . _PLUGS_BTN_UPDATE . '" tabindex="20" />' . "\n";
		echo "</div>\n";
		echo "</form>\n";
		
		echo '<h3>' . _PLUGS_TITLE_NEW . "</h3>\n";
		
		// find a list of possibly non-installed plugins
		$candidates = array();
		$dirhandle = opendir($DIR_PLUGINS);
		
		while ( $filename = readdir($dirhandle) )
		{
			if ( preg_match('#^NP_(.*)\.php$#', $filename, $matches) )
			{
				$name = $matches[1];
				
				// only show in list when not yet installed
				$query = 'SELECT * FROM %s WHERE pfile = %s';
				$query = sprintf($query, sql_table('plugin'), DB::quoteValue('NP_'.$name));
				$res = DB::getResult($query);
				
				if ( $res->rowCount() == 0 )
				{
					array_push($candidates, $name);
				}
			}
		}
		
		closedir($dirhandle);
		
		if ( sizeof($candidates) > 0 )
		{
			echo '<p>' . _PLUGS_ADD_TEXT . "</p>\n";
			
			echo '<form method="post" action="index.php">' . "\n";
			echo "<div>\n";
			echo '<input type="hidden" name="action" value="pluginadd" />' . "\n";
			$manager->addTicketHidden();
			echo '<select name="filename" tabindex="30">' . "\n";
			
			foreach ( $candidates as $name )
			{
				echo '<option value="NP_',$name,'">',Entity::hsc($name),'</option>';
			}
			
			echo "</select>\n";
			echo '<input type="submit" tabindex="40" value="' . _PLUGS_BTN_INSTALL ."\" />\n";
			echo "</div>\n";
			echo "</form>\n";
		}
		else
		{
			echo '<p>', _PLUGS_NOCANDIDATES, '</p>';
		}
		
		$this->pagefoot();
		return;
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

        $plugName = $manager->getPluginNameFromPid($plugid);

        $this->pagehead();

        echo '<p><a href="index.php?action=pluginlist">(',_PLUGS_BACK,')</a></p>';

        echo '<h2>',_PLUGS_HELP_TITLE,': ',Entity::hsc($plugName),'</h2>';

        $plug =& $manager->getPlugin($plugName);
        $helpFile = $DIR_PLUGINS.$plug->getShortName().'/help.html';

        if (($plug->supportsFeature('HelpPage') > 0) && (@file_exists($helpFile))) {
            @readfile($helpFile);
        } else {
            echo '<p>Error: ', _ERROR_PLUGNOHELPFILE,'</p>';
            echo '<p><a href="index.php?action=pluginlist">(',_BACK,')</a></p>';
        }


        $this->pagefoot();
    }

	/**
	 * Admin::action_pluginadd()
	 * 
	 * @param	Void
	 * @return	Void
	 * 
	 */
	function action_pluginadd()
	{
		global $member, $manager, $DIR_PLUGINS;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$name = postVar('filename');
		
		if ( $manager->pluginInstalled($name) )
		{
			$this->error(_ERROR_DUPPLUGIN);
		}
		
		if ( !checkPlugin($name) )
		{
			$this->error(_ERROR_PLUGFILEERROR . ' (' . Entity::hsc($name) . ')');
		}
		
		// get number of currently installed plugins
		$res = DB::getResult('SELECT * FROM '.sql_table('plugin'));
		$numCurrent = $res->rowCount();
		
		// plugin will be added as last one in the list
		$newOrder = $numCurrent + 1;
		
		$manager->notify(
			'PreAddPlugin',
			array(
				'file' => &$name
			)
		);
		
		// do this before calling getPlugin (in case the plugin id is used there)
		$query = 'INSERT INTO '.sql_table('plugin').' (porder, pfile) VALUES ('.$newOrder.','.DB::quoteValue($name).')';
		DB::execute($query);
		$iPid = DB::getInsertId();
		
		$manager->clearCachedInfo('installedPlugins');
		
		// Load the plugin for condition checking and instalation
		$plugin =& $manager->getPlugin($name);
		
		// check if it got loaded (could have failed)
		if ( !$plugin )
		{
			DB::execute('DELETE FROM ' . sql_table('plugin') . ' WHERE pid='. intval($iPid));
			$manager->clearCachedInfo('installedPlugins');
			$this->error(_ERROR_PLUGIN_LOAD);
		}
		
		// check if plugin needs a newer Nucleus version
		if ( getNucleusVersion() < $plugin->getMinNucleusVersion() )
		{
			// uninstall plugin again...
			$this->deleteOnePlugin($plugin->getID());
			
			// ...and show error
			$this->error(_ERROR_NUCLEUSVERSIONREQ . Entity::hsc($plugin->getMinNucleusVersion()));
		}
		
		// check if plugin needs a newer Nucleus version
		if ( (getNucleusVersion() == $plugin->getMinNucleusVersion()) && (getNucleusPatchLevel() < $plugin->getMinNucleusPatchLevel()) )
		{
			// uninstall plugin again...
			$this->deleteOnePlugin($plugin->getID());
			
			// ...and show error
			$this->error(_ERROR_NUCLEUSVERSIONREQ . Entity::hsc( $plugin->getMinNucleusVersion() . ' patch ' . $plugin->getMinNucleusPatchLevel() ) );
		}
		
		$pluginList = $plugin->getPluginDep();
		foreach ( $pluginList as $pluginName )
		{
			$res = DB::getResult('SELECT * FROM '.sql_table('plugin') . ' WHERE pfile=' . DB::quoteValue($pluginName));
			if ($res->rowCount() == 0)
			{
				// uninstall plugin again...
				$this->deleteOnePlugin($plugin->getID());
				$this->error(sprintf(_ERROR_INSREQPLUGIN, Entity::hsc($pluginName)));
			}
		}
		
		// call the install method of the plugin
		$plugin->install();
		
		$manager->notify(
			'PostAddPlugin',
			array(
				'plugin' => &$plugin
			)
		);
		
		// update all events
		$this->action_pluginupdate();
		return;
	}
	
	/**
	 * ADMIN:action_pluginupdate():
	 * 
	 * @param	Void
	 * @return	Void
	 * 
	 */
	function action_pluginupdate()
	{
		global $member, $manager, $CONF;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		// delete everything from plugin_events
		DB::execute('DELETE FROM '.sql_table('plugin_event'));
		
		// loop over all installed plugins
		$res = DB::getResult('SELECT pid, pfile FROM '.sql_table('plugin'));
		foreach ( $res as $row )
		{
			$pid = $row['pid'];
			$plug =& $manager->getPlugin($row['pfile']);
			if ( $plug )
			{
				$eventList = $plug->getEventList();
				foreach ( $eventList as $eventName )
				{
					$query = "INSERT INTO %s (pid, event) VALUES (%d, %s)";
					$query = sprintf($query, sql_table('plugin_event'), (integer) $pid, DB::quoteValue($eventName));
					DB::execute($query);
				}
			}
		}
		redirect($CONF['AdminURL'] . '?action=pluginlist');
		return;
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
            <h2><?php echo _DELETE_CONFIRM ?></h2>

            <p><?php echo _CONFIRMTXT_PLUGIN ?> <strong><?php echo $manager->getPluginNameFromPid($pid) ?></strong>?</p>

            <form method="post" action="index.php"><div>
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="action" value="plugindeleteconfirm" />
            <input type="hidden" name="plugid" value="<?php echo $pid; ?>" />
            <input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN ?>" />
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

        $name = DB::getValue('SELECT pfile as result FROM '.sql_table('plugin').' WHERE pid='.$pid);

/*		// call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin =& $manager->getPlugin($name);
            if ($plugin) $plugin->unInstall();
        }*/

        // check dependency before delete
        $res = DB::getResult('SELECT pfile FROM '.sql_table('plugin'));
        foreach ( $res as $row ) {
            $plug =& $manager->getPlugin($row['pfile']);
            if ($plug)
            {
                $depList = $plug->getPluginDep();
                foreach ($depList as $depName)
                {
                    if ($name == $depName)
                    {
                        return sprintf(_ERROR_DELREQPLUGIN, $row['pfile']);
                    }
                }
            }
        }

        $manager->notify('PreDeletePlugin', array('plugid' => $pid));

        // call the unInstall method of the plugin
        if ($callUninstall) {
            $plugin =& $manager->getPlugin($name);
            if ($plugin) $plugin->unInstall();
        }

        // delete all subscriptions
        DB::execute('DELETE FROM '.sql_table('plugin_event').' WHERE pid=' . $pid);

        // delete all options
        // get OIDs from plugin_option_desc
        $res = DB::getResult('SELECT oid FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
        $aOIDs = array();
        foreach ( $res as $row ) {
            array_push($aOIDs, $row['oid']);
        }

        // delete from plugin_option and plugin_option_desc
        DB::execute('DELETE FROM '.sql_table('plugin_option_desc').' WHERE opid=' . $pid);
        if (count($aOIDs) > 0)
            DB::execute('DELETE FROM '.sql_table('plugin_option').' WHERE oid in ('.implode(',',$aOIDs).')');

        // update order numbers
        $res = DB::getValue('SELECT porder FROM '.sql_table('plugin').' WHERE pid=' . $pid);
        DB::execute('UPDATE '.sql_table('plugin').' SET porder=(porder - 1) WHERE porder>'.$res);

        // delete row
        DB::execute('DELETE FROM '.sql_table('plugin').' WHERE pid='.$pid);

        $manager->clearCachedInfo('installedPlugins');
        $manager->notify('PostDeletePlugin', array('plugid' => $pid));

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
        $oldOrder = DB::getValue('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid);

        // 2. calculate new order number
        $newOrder = ($oldOrder > 1) ? ($oldOrder - 1) : 1;

        // 3. update plug numbers
        DB::execute('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);
        DB::execute('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);

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
        $oldOrder = DB::getValue('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid);

        $res = DB::getResult('SELECT * FROM '.sql_table('plugin'));
        $maxOrder = $res->rowCount();

        // 2. calculate new order number
        $newOrder = ($oldOrder < $maxOrder) ? ($oldOrder + 1) : $maxOrder;

        // 3. update plug numbers
        DB::execute('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);
        DB::execute('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);

        //$this->action_pluginlist();
        // To avoid showing ticket in the URL, redirect to pluginlist, instead.
        redirect($CONF['AdminURL'] . '?action=pluginlist');
    }
	
	/**
	 * Admin::action_pluginoptions()
	 * 
	 * Output Plugin option page
	 * 
	 * @access	public
	 * @param	string $message	message when fallbacked
	 * @return	void
	 * 
	 */
	public function action_pluginoptions($message = '')
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$pid = (integer) requestVar('plugid');
		if ( !$manager->pidInstalled($pid) )
		{
			$this->error(_ERROR_NOSUCHPLUGIN);
		}
		
		$pname = $manager->getPluginNameFromPid($pid);
		
		/* NOTE: to include translation file */
		$manager->getPlugin($pname);
		
		$extrahead = "<script type=\"text/javascript\" src=\"javascript/numbercheck.js\"></script>\n";
		$this->pagehead($extrahead);
		echo '<p><a href="index.php?action=pluginlist">(' . _PLUGS_BACK . ")</a></p>\n";
		echo '<h2>' . sprintf(_PLUGIN_OPTIONS_TITLE, Entity::hsc($pname)) . "</h2>\n";
		
		if ( isset($message) )
		{
			echo $message;
		}
		
		echo "<form action=\"index.php\" method=\"post\">\n";
		echo "<div>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"pluginoptionsupdate\" />\n";
		echo "<input type=\"hidden\" name=\"plugid\" value=\"{$pid}\" />\n";
		$manager->addTicketHidden();
		
		$options = array();
		$query = "SELECT * FROM %s WHERE ocontext='global' and opid=%d ORDER BY oid ASC";
		$query = sprintf($query, sql_table('plugin_option_desc'), $pid);
		$result = DB::getResult($query);
		foreach ( $result as $row )
		{
			$options[$row['oid']] = array(
				'oid'		=> $row['oid'],
				'value'		=> $row['odef'],
				'name'		=> $row['oname'],
				'description' => $row['odesc'],
				'type'		=> $row['otype'],
				'typeinfo'	=> $row['oextra'],
				'contextid'	=> 0
			);
		}
		// fill out actual values
		if ( count($options) > 0 )
		{
			$query = "SELECT oid, ovalue FROM %s WHERE oid in (%s)";
			$query = sprintf($query, sql_table('plugin_option'), implode(',',array_keys($options)));
			$result = DB::getResult($query);
			foreach ( $result as $row )
			{
				$options[$row['oid']]['value'] = $row['ovalue'];
			}
		}
		
		// call plugins
		$data = array('context' => 'global', 'plugid' => $pid, 'options'=>&$options);
		$manager->notify('PrePluginOptionsEdit',$data);
		
		$template['content'] = 'plugoptionlist';
		$amount = showlist($options,'table', $template);
		if ( $amount == 0 )
		{
			echo '<p>',_ERROR_NOPLUGOPTIONS,'</p>';
		}
		echo "</div>\n";
		echo "</form>\n";
		$this->pagefoot();
		
		return;
	}
	
	/**
	 * Admin::action_pluginoptionsupdate()
	 * 
	 * Update plugin options and fallback to plugin option page
	 * 
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function action_pluginoptionsupdate()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$pid = (integer) requestVar('plugid');
		if ( !$manager->pidInstalled($pid) )
		{
			$this->error(_ERROR_NOSUCHPLUGIN);
		}
		
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions);
		
		$manager->notify('PostPluginOptionsUpdate',array('context' => 'global', 'plugid' => $pid));
		
		$this->action_pluginoptions(_PLUGS_OPTIONS_UPDATED);
		return;
	}
	
	/**
	 * Admin::_insertPluginOptions()
	 * 
	 * Output plugin option field
	 * 
	 * @access	public
	 * @param string	$context	plugin option context
	 * @param integer	$contextid	plugin option context id
	 * @return	void
	 */
	public function _insertPluginOptions($context, $contextid = 0)
	{
		global $manager;
		
		/* get current registered plugin option list in this context even if it's not used */
		$query = 'SELECT * FROM %s AS plugins, %s AS options LEFT OUTER JOIN %s AS added '
		       . 'ON ( options.oid=added.oid ) '
		       . 'WHERE plugins.pid=options.opid AND options.ocontext=%s AND added.ocontextid=%d '
		       . 'ORDER BY options.oid ASC';
		$query = sprintf($query, sql_table('plugin'), sql_table('plugin_option_desc'), sql_table('plugin_option'), DB::quoteValue($context), intval($contextid));
		
		$res = DB::getResult($query);
		
		$options = array();
		foreach ( $res as $row )
		{
			/* NOTE: to include translation file */
			$manager->getPlugin($row['pfile']);
			
			$options[] = array(
				'pid'		=> $row['pid'],
				'pfile'		=> $row['pfile'],
				'oid'		=> $row['oid'],
				'value'		=> ( !$row['ovalue'] ) ? $row['odef'] : $row['ovalue'],
				'name'		=> $row['oname'],
				'description' => $row['odesc'],
				'type'		=> $row['otype'],
				'typeinfo'	=> $row['oextra'],
				'contextid'	=> $contextid,
				'extra'		=> ''
			);
		}
		
		$manager->notify('PrePluginOptionsEdit',array('context' => $context, 'contextid' => $contextid, 'options'=>&$options));
		
		$iPrevPid = -1;
		foreach ( $options as $option)
		{
			// new plugin?
			if ( $iPrevPid != $option['pid'] )
			{
				$iPrevPid = $option['pid'];
				if ( !defined('_PLUGIN_OPTIONS_TITLE') )
				{
					define('_PLUGIN_OPTIONS_TITLE', 'Options for %s');
				}
				echo "<tr>\n";
				echo '<th colspan="2">' . sprintf(_PLUGIN_OPTIONS_TITLE, Entity::hsc($option['pfile'])) . "</th>\n";
				echo "</tr>\n";
			}
			
			$meta = NucleusPlugin::getOptionMeta($option['typeinfo']);
			if ( @$meta['access'] != 'hidden' )
			{
				echo '<tr>';
				listplug_plugOptionRow($option);
				echo '</tr>';
			}
		}
		return;
	}
	
	/**
	 * Admin::input_yesno()
	 * Output input elements with radio attribute for yes/no options
	 * 
	 * @param	string	$name	name attribute
	 * @param	string	$value_current	current value attribute
	 * @param	integer	$tabindex	tab index
	 * @param	string	$value_yes	value attribute for yes option
	 * @param	string	$value_no	value attribute for no option
	 * @param	string	$text_yes	child text element for yes option
	 * @param	string	$text_no	child text element for no option
	 * @param	boolean	$isAdmin	have admin right or not
	 * @return	void
	 */
	function input_yesno($name, $value_current, $tabindex = 0, $value_yes = 1, $value_no = 0, $text_yes = _YES, $text_no = _NO, $isAdmin = 0)
	{
		$id = preg_replace('#\[|\]#', '-', $name);
		$id_yes = $id . $value_yes;
		$id_no  = $id . $value_no;
		
		/* yes option */
		echo '<input type="radio" id="' . Entity::hsc($id_yes) . '" name="' . Entity::hsc($name) . '" value="' . Entity::hsc($value_yes) . '"';
		if ( $name=="admin" )
		{
			echo ' onclick="selectCanLogin(true);"';
		}
		if ( $value_current == $value_yes )
		{
			echo " tabindex='$tabindex' checked='checked'";
		}
		echo " />\n";
		echo '<label for="' . Entity::hsc($id_yes) . '">' . Entity::hsc($text_yes) . "</label>\n";
		
		/* no option */
		echo '<input type="radio" id="' . Entity::hsc($id_no) . '" name="' . Entity::hsc($name) . '" value="' . Entity::hsc($value_no) . '"';
		if ( $name=="admin" )
		{
			echo ' onclick="selectCanLogin(false);"';
		}
		if ( $value_current != $value_yes )
		{
			echo " tabindex='$tabindex' checked='checked'";
		}
		if ($isAdmin && $name=="canlogin")
		{
			echo ' disabled="disabled"';
		}
		echo " />\n";
		echo '<label for="' . Entity::hsc($id_no) . '">' . Entity::hsc($text_no) . "</label>\n";
		
		return;
	}
}
