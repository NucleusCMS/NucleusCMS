<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * The code for the Nucleus admin area   
  *
  * $Id$
  */
 
class ADMIN {

	// action currently being executed ($action=xxxx -> action_xxxx method)
	var $action;

	function ADMIN() {

	}
	
	/**
	  * Executes an action
	  *
	  * @param $action
	  *		action to be performed
	  */
	function action($action) {
		// list of action aliases
		$alias = array(
			'login' => 'overview',
			'' => 'overview'
		);

		if ($alias[$action])
			$action = $alias[$action];

		$methodName = 'action_' . $action;
		
		$this->action = $action;

		if (method_exists($this, $methodName))
			call_user_func(array(&$this, $methodName));
		else
			$this->error(_BADACTION . " ($action)");
		
	}


	function action_showlogin() {
		global $error;
		$this->action_login($error);
	}

	function action_login($msg = '', $passvars = 1) {
		global $member;
		
		// skip to overview when allowed
		if ($member->isLoggedIn() && $member->canLogin()) {
			$this->action_overview();
			exit;
		}
			
		$this->pagehead();
		
		echo '<h2>', _LOGIN ,'</h2>';
		if ($msg) echo _MESSAGE , ': ', $msg;
		?>
		
		<form action="index.php" method="post"><p>
		<?php echo _LOGIN_NAME?>: <br /><input name="login"  tabindex="10" />
		<br />
		<?php echo _LOGIN_PASSWORD?>: <br /><input name="password"  tabindex="20" type="password" />
		<br />
		<input name="action" value="login" type="hidden" />
		<br />
		<input type="submit" value="<?php echo _LOGIN?>" tabindex="30" />
		<br />
		<small>
			<input type="checkbox" value="1" name="shared" tabindex="40" id="shared" /><label for="shared"><?php echo _LOGIN_SHARED?></label>
			<br /><a href="forgotpassword.html"><?php echo _LOGIN_FORGOT?></a>
		</small>
		<?php			// pass through vars
			
			$oldaction = postVar('oldaction');
			if (  ($oldaction != 'logout')  && ($oldaction != 'login')  && $passvars ) {
				passRequestVars();
			}

			
		?>
		</p></form>
		<?php		$this->pagefoot();
	}


	/**
	  * provides a screen with the overview of the actions available
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
				echo '<p><a href="index.php?action=overview&amp;showall=yes">Show all blogs</a></p>';
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
	
	// returns a link to a weblog (takes BLOG object as parameter)
	function bloglink(&$blog) {
		return '<a href="'.htmlspecialchars($blog->getURL()).'" title="'._BLOGLIST_TT_VISIT.'">'.$blog->getName() .'</a>';
	}
	
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
	
	function action_itemlist($blogid = '') {
		global $member, $manager;
		
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
		else
			$amount = 10;	
		
		$search = postVar('search');	// search through items
			
		$query =  'SELECT bshortname, cname, mname, ititle, ibody, inumber, idraft, itime'
		       . ' FROM ' . sql_table('item') . ', ' . sql_table('blog') . ', ' . sql_table('member') . ', ' . sql_table('category')
		       . ' WHERE iblog=bnumber and iauthor=mnumber and icat=catid and iblog=' . $blogid;
		
		if ($search) 
			$query .= ' and ((ititle LIKE "%' . addslashes($search) . '%") or (ibody LIKE "%' . addslashes($search) . '%") or (imore LIKE "%' . addslashes($search) . '%"))';			
			
		// non-blog-admins can only edit/delete their own items
		if (!$member->blogAdminRights($blogid)) 
			$query .= ' and iauthor=' . $member->getID();

				
		$query .= ' ORDER BY itime DESC'
		        . " LIMIT $start,$amount";
		
		$template['content'] = 'itemlist';
		$template['now'] = $blog->getCorrectTime(time());


		$navList = new NAVLIST('itemlist', $start, $amount, 0, 1000, $blogid, $search, 0);
		$navList->showBatchList('item',$query,'table',$template);

		
		$this->pagefoot();
	}
	
	
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
		echo '<p>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b></p>';
		echo '<ul>';
		

		// walk over all itemids and perform action
		foreach ($selected as $itemid) {
			$itemid = intval($itemid);
			echo '<li>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b> ',_BATCH_ONITEM,' <b>', $itemid, '</b>...';

			// perform action, display errors if needed
			switch($action) {
				case 'delete':
					$error = $this->deleteOneItem($itemid);
					break;
				case 'move':
					$error = $this->moveOneItem($itemid, $destCatid);
					break;
				default:
					$error = _BATCH_UNKNOWN . $action;
			}

			echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
			echo '</li>';
		}
		
		echo '</ul>';
		echo '<b>',_BATCH_DONE,'</b>';
		
		$this->pagefoot();

		
	}
	
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
		echo '<p>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b></p>';
		echo '<ul>';
		
		// walk over all itemids and perform action
		foreach ($selected as $commentid) {
			$commentid = intval($commentid);
			echo '<li>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b> ',_BATCH_ONCOMMENT,' <b>', $commentid, '</b>...';

			// perform action, display errors if needed
			switch($action) {
				case 'delete':
					$error = $this->deleteOneComment($commentid);
					break;
				default:
					$error = _BATCH_UNKNOWN . $action;
			}

			echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
			echo '</li>';
		}
		
		echo '</ul>';
		echo '<b>',_BATCH_DONE,'</b>';
		
		$this->pagefoot();

		
	}

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
		echo '<p>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b></p>';
		echo '<ul>';
		
		// walk over all itemids and perform action
		foreach ($selected as $memberid) {
			$memberid = intval($memberid);
			echo '<li>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b> ',_BATCH_ONMEMBER,' <b>', $memberid, '</b>...';

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
					if (mysql_num_rows($r) < 2)
						$error = _ERROR_ATLEASTONEADMIN;
					else
						sql_query('UPDATE ' . sql_table('member') .' SET madmin=0 WHERE mnumber='.$memberid);
					break;
				default:
					$error = _BATCH_UNKNOWN . $action;
			}

			echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
			echo '</li>';
		}
		
		echo '</ul>';
		echo '<b>',_BATCH_DONE,'</b>';
		
		$this->pagefoot();

		
	}	
	

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
		echo '<p>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b></p>';
		echo '<ul>';
		
		// walk over all itemids and perform action
		foreach ($selected as $memberid) {
			$memberid = intval($memberid);
			echo '<li>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b> ',_BATCH_ONTEAM,' <b>', $memberid, '</b>...';

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
					if (mysql_num_rows($r) < 2)
						$error = _ERROR_ATLEASTONEBLOGADMIN;
					else
						sql_query('UPDATE '.sql_table('team').' SET tadmin=0 WHERE tblog='.$blogid.' and tmember='.$memberid);
					break;
				default:
					$error = _BATCH_UNKNOWN . $action;
			}

			echo '<b>',($error ? $error : _BATCH_SUCCESS),'</b>';
			echo '</li>';
		}
		
		echo '</ul>';
		echo '<b>',_BATCH_DONE,'</b>';
		
		$this->pagefoot();

		
	}	


	
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
		echo '<p>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b></p>';
		echo '<ul>';
		
		// walk over all itemids and perform action
		foreach ($selected as $catid) {
			$catid = intval($catid);
			echo '<li>',_BATCH_EXECUTING,' <b>',htmlspecialchars($action),'</b> ',_BATCH_ONCATEGORY,' <b>', $catid, '</b>...';

			// perform action, display errors if needed
			switch($action) {
				case 'delete':
					$error = $this->deleteOneCategory($catid);
					break;
				case 'move':
					$error = $this->moveOneCategory($catid, $destBlogId);
					break;
				default:
					$error = _BATCH_UNKNOWN . $action;
			}

			echo '<b>',($error ? 'Error: '.$error : _BATCH_SUCCESS),'</b>';
			echo '</li>';
		}
		
		echo '</ul>';
		echo '<b>',_BATCH_DONE,'</b>';
		
		$this->pagefoot();
		
	}
	
	function batchMoveSelectDestination($type, $ids) {
		$this->pagehead();
		?>
		<h2><?php echo _MOVE_TITLE?></h2>
		<form method="post" action="index.php"><div>

			<input type="hidden" name="action" value="batch<?php echo $type?>" />
			<input type="hidden" name="batchaction" value="move" />
			<?php				// insert selected item numbers
				$idx = 0;
				foreach ($ids as $id)
					echo '<input type="hidden" name="batch[',($idx++),']" value="',intval($id),'" />';
			
				// show blog/category selection list
				$this->selectBlogCategory('destcatid');
			
			?>
			
			
			<input type="submit" value="<?php echo _MOVE_BTN?>" onclick="return checkSubmit();" />

		</div></form>
		<?php		$this->pagefoot();
		exit;
	}
	
	function batchMoveCategorySelectDestination($type, $ids) {
		$this->pagehead();
		?>
		<h2><?php echo _MOVECAT_TITLE?></h2>
		<form method="post" action="index.php"><div>

			<input type="hidden" name="action" value="batch<?php echo $type?>" />
			<input type="hidden" name="batchaction" value="move" />
			<?php				// insert selected item numbers
				$idx = 0;
				foreach ($ids as $id)
					echo '<input type="hidden" name="batch[',($idx++),']" value="',intval($id),'" />';
			
				// show blog/category selection list
				$this->selectBlog('destblogid');
			
			?>
			
			
			<input type="submit" value="<?php echo _MOVECAT_BTN?>" onclick="return checkSubmit();" />

		</div></form>
		<?php		$this->pagefoot();
		exit;
	}
	
	function batchAskDeleteConfirmation($type, $ids) {
		$this->pagehead();
		?>
		<h2><?php echo _BATCH_DELETE_CONFIRM?></h2>
		<form method="post" action="index.php"><div>

			<input type="hidden" name="action" value="batch<?php echo $type?>" />
			<input type="hidden" name="batchaction" value="delete" />
			<input type="hidden" name="confirmation" value="yes" />			
			<?php				// insert selected item numbers
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
		<?php		$this->pagefoot();
		exit;
	}
	
	
	/**
	  * Inserts a HTML select element with choices for all categories to which the current
	  * member has access
	  */
	function selectBlogCategory($name, $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1) {
		ADMIN::selectBlog($name, 'category', $selected, $tabindex, $showNewCat, $iForcedBlogInclude);
	}
	
	/**
	  * Inserts a HTML select element with choices for all blogs to which the user has access
	  *		mode = 'blog' => shows blognames and values are blogids
	  *		mode = 'category' => show category names and values are catids
	  *
	  * @param $iForcedBlogInclude
	  *		ID of a blog that always needs to be included, without checking if the member is on the blog team (-1 = none)
	  */
	function selectBlog($name, $mode='blog', $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1) {
		global $member, $CONF;
		
		// 0. get IDs of blogs to which member can post items (+ forced blog)
		$aBlogIds = array();
		if ($iForcedBlogInclude != -1)
			$aBlogIds[] = intval($iForcedBlogInclude);

		if (($member->isAdmin()) && ($CONF['ShowAllBlogs'])) 
			$queryBlogs =  'SELECT bnumber FROM '.sql_table('blog').' ORDER BY bname';
		else
			$queryBlogs =  'SELECT bnumber FROM '.sql_table('blog').', '.sql_table('team').' WHERE tblog=bnumber and tmember=' . $member->getID();		
		$rblogids = sql_query($queryBlogs);
		while ($o = mysql_fetch_object($rblogids))
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
			if (mysql_num_rows($blogs) > 1)
				$multipleBlogs = 1;

			while ($oBlog = mysql_fetch_object($blogs)) {
				if ($multipleBlogs)
					echo '<optgroup label="',htmlspecialchars($oBlog->bname),'">';

				// show selection to create new category when allowed/wanted
				if ($showNewCat) {
					// check if allowed to do so
					if ($member->blogAdminRights($oBlog->bnumber))
						echo '<option value="newcat-',$oBlog->bnumber,'">',_ADD_NEWCAT,'</option>';
				}

				// 2. for each category in that blog
				$categories = sql_query('SELECT cname, catid FROM '.sql_table('category').' WHERE cblog=' . $oBlog->bnumber . ' ORDER BY cname ASC');
				while ($oCat = mysql_fetch_object($categories)) {
					if ($oCat->catid == $selected)
						$selectText = ' selected="selected" ';
					else
						$selectText = '';
					echo '<option value="',$oCat->catid,'" ', $selectText,'>',htmlspecialchars($oCat->cname),'</option>';
				}

				if ($multipleBlogs)
					echo '</optgroup>';
			}
		} else {
			// blog mode
			while ($oBlog = mysql_fetch_object($blogs)) {
				echo '<option value="',$oBlog->bnumber,'"';
				if ($oBlog->bnumber == $selected)
					echo ' selected="selected"';
				echo'>',htmlspecialchars($oBlog->bname),'</option>';			
			}
		}
		echo '</select>';
		
	}
	
	function action_browseownitems() {
		global $member;
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';		
		echo '<h2>' . _ITEMLIST_YOUR. '</h2>';
		
		// start index
		if (postVar('start'))
			$start = postVar('start');
		else
			$start = 0; 	
			
		// amount of items to show
		if (postVar('amount'))
			$amount = postVar('amount');
		else
			$amount = 10;	
		
		$search = postVar('search');	// search through items
			
		$query =  'SELECT bshortname, cname, mname, ititle, ibody, idraft, inumber, itime'
		       . ' FROM '.sql_table('item').', '.sql_table('blog') . ', '.sql_table('member') . ', '.sql_table('category')
		       . ' WHERE iauthor='. $member->getID() .' and iauthor=mnumber and iblog=bnumber and icat=catid';
		
		if ($search) 
			$query .= ' and ((ititle LIKE "%' . addslashes($search) . '%") or (ibody LIKE "%' . addslashes($search) . '%") or (imore LIKE "%' . addslashes($search) . '%"))';
			
		$query .= ' ORDER BY itime DESC'
		        . " LIMIT $start,$amount";
		
		$template['content'] = 'itemlist';
		$template['now'] = time();

		$navList = new NAVLIST('browseownitems', $start, $amount, 0, 1000, $blogid, $search, 0);
		$navList->showBatchList('item',$query,'table',$template);

		$this->pagefoot();		
		
	}
	
	/**
	  * Show all the comments for a given item
	  */
	function action_itemcommentlist($itemid = '') {
		global $member;
		
		if ($itemid == '')
			$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		$blogid = getBlogIdFromItemId($itemid);
	
		$this->pagehead();
		
		// start index
		if (postVar('start'))
			$start = postVar('start');
		else
			$start = 0; 	
			
		// amount of items to show
		if (postVar('amount'))
			$amount = postVar('amount');
		else
			$amount = 10;	
		
		$search = postVar('search');	
		
		echo '<p>(<a href="index.php?action=itemlist&amp;blogid=',$blogid,'">',_BACKTOOVERVIEW,'</a>)</p>';
		echo '<h2>',_COMMENTS,'</h2>';
		
		$query =  'SELECT cbody, cuser, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE citem=' . $itemid;

		if ($search) 
			$query .= ' and cbody LIKE "%' . addslashes($search) . '%"';

		$query .= ' ORDER BY ctime ASC'
		        . " LIMIT $start,$amount";

		$template['content'] = 'commentlist';
		$template['canAddBan'] = $member->blogAdminRights(getBlogIDFromItemID($itemid));

		$navList = new NAVLIST('itemcommentlist', $start, $amount, 0, 1000, 0, $search, $itemid);
		$navList->showBatchList('comment',$query,'table',$template,_NOCOMMENTS);
		
		$this->pagefoot();
	}
	
	/**
	  * Browse own comments
	  */
	function action_browseowncomments() {
		global $member;
		
		// start index
		if (postVar('start'))
			$start = postVar('start');
		else
			$start = 0; 	
			
		// amount of items to show
		if (postVar('amount'))
			$amount = postVar('amount');
		else
			$amount = 10;	
		
		$search = postVar('search');			


		$query =  'SELECT cbody, cuser, cmail, mname, ctime, chost, cnumber, cip, citem FROM '.sql_table('comment').' LEFT OUTER JOIN '.sql_table('member').' ON mnumber=cmember WHERE cmember=' . $member->getID();

		if ($search) 
			$query .= ' and cbody LIKE "%' . addslashes($search) . '%"';

		$query .= ' ORDER BY ctime DESC'
		        . " LIMIT $start,$amount";
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';		
		echo '<h2>', _COMMENTS_YOUR ,'</h2>';
	
		$template['content'] = 'commentlist';
		$template['canAddBan'] = 0;	// doesn't make sense to allow banning yourself
		
		$navList = new NAVLIST('browseowncomments', $start, $amount, 0, 1000, 0, $search, 0);
		$navList->showBatchList('comment',$query,'table',$template,_NOCOMMENTS_YOUR);
	
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
	
	function action_itemedit() {
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		$item =& $manager->getItem($itemid,1,1);
		$blog =& $manager->getBlog(getBlogIDFromItemID($itemid));
		
		$manager->notify('PrepareItemForEdit', array('item' => &$item));
		
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
				
		$body 	= postVar('body');
		$title 	= postVar('title');
		$more 	= postVar('more');
		$closed = intPostVar('closed');

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
		switch ($actiontype) {
			case 'adddraft':
				$publish = 0;
				$wasdraft = 1;
				$timestamp = 0;
				break;
			case 'addfuture':
				$wasdraft = 1;
				$publish = 1;
			 	$timestamp = mktime(postVar('hour'), postVar('minutes'), 0, postVar('month'), postVar('day'), postVar('year'));
				break;
			case 'addnow':
				$wasdraft = 1;
				$publish = 1;
				$timestamp = 0;
				break;
			case 'changedate':
				$timestamp = mktime(postVar('hour'), postVar('minutes'), 0, postVar('month'), postVar('day'), postVar('year'));
				$publish = 1;
				$wasdraft = 0;
				break;
			case 'edit':
			default:
				$publish = 1;
				$wasdraft = 0;
				$timestamp = 0;
		}
		
		// edit the item for real
		ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);
		
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
	
	function action_itemdelete() {
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or $this->disallow();
		
		if (!$manager->existsItem($itemid,1,1))
			$this->error(_ERROR_NOSUCHITEM);
			
		$item =& $manager->getItem($itemid,1,1);
		$title = htmlspecialchars(strip_tags($item['title']));
		$body = strip_tags($item['body']);
		$body = htmlspecialchars(shorten($body,300,'...'));
		
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
				<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
				<input type="submit" value="<?php echo _DELETE_CONFIRM_BTN?>"  tabindex="10" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
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
	
	// deletes one item and returns error if something goes wrong
	function deleteOneItem($itemid) {
		global $member, $manager;
		
		// only allow if user is allowed to alter item (also checks if itemid exists)
		if (!$member->canAlterItem($itemid))
			return _ERROR_DISALLOWED;
		
		$manager->loadClass('ITEM');
		ITEM::delete($itemid);
	}

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
				
				<?php $this->selectBlogCategory('catid',$item['catid'],10,1);?>
				
				<input type="submit" value="<?php echo _MOVE_BTN?>" tabindex="10000" onclick="return checkSubmit();" />
			</div></form>
		<?php		
		$this->pagefoot();
	}

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

		ITEM::move($itemid, $catid);		
		
		if ($catid != intRequestVar('catid'))
			$this->action_categoryedit($catid, $blog->getID());
		else
			$this->action_itemlist(getBlogIDFromCatID($catid));		
	}
	
	/**
	  * Moves one item to a given category (category existance should be checked by caller)
	  * errors are returned
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
		global $member, $manager, $CONF;
		 
		$manager->loadClass('ITEM');

		$result = ITEM::createFromRequest();
		
		if ($result['status'] == 'error')
			$this->error($result['message']);
		
		$blogid = getBlogIDFromItemID($result['itemid']);
		$blog =& $manager->getBlog($blogid);

		if ($result['status'] == 'newcategory')
			$this->action_categoryedit(
				$result['catid'],
				$blogid, 
				$blog->pingUserland() ? $CONF['AdminURL'] . 'index.php?action=sendping&blogid=' . intval($blogid) : ''
			);
		elseif ((postVar('actiontype') == 'addnow') && $blog->pingUserland())
			$this->action_sendping($blogid);
		else
			$this->action_itemlist($blogid);
	}
	
	/**
	  * Shows a window that says we're about to ping weblogs.com.
	  * immediately refresh to the real pinging page, which will 
	  * show an error, or redirect to the blog.
	  *
	  * @param $blogid ID of blog for which ping needs to be sent out
	  */
	function action_sendping($blogid = -1) {
		global $member;
		
		if ($blogid == -1)
			$blogid = intRequestVar('blogid');
		
		$member->isLoggedIn() or $this->disallow();
		
		$this->pagehead('<meta http-equiv="refresh" content="1; url=index.php?action=rawping&amp;blogid=' . $blogid . '" />');
		?>		
		<h2>Site Updated, Now pinging weblogs.com</h2>

		<p>
			Pinging weblogs.com! This can a while...
			<br />
			When the ping is complete (and successfull), your weblog will show up in the weblogs.com updates list.
		</p>
		
		<p>
			If you aren't automatically passed through, <a href="index.php?action=rawping&amp;blogid=<?php echo $blogid?>">try again</a>
		</p>
		<?php		$this->pagefoot();
	}
	
	// ping to Weblogs.com
	// sends the real ping (can take up to 10 seconds!)
	function action_rawping() {
		global $manager;
		// TODO: checks?
				
		$blogid = intRequestVar('blogid');
		$blog =& $manager->getBlog($blogid);
		
		$result = $blog->sendUserlandPing();
		
		$this->pagehead();
		
		?>
		
		<h2>Ping Results</h2>
		
		<p>The following message was returned by weblogs.com:</p>
		
		<div class='note'><?php echo  $result ?></div>
		
		<ul>
			<li><a href="index.php?action=itemlist&amp;blogid=<?php echo $blog->getID()?>">View list of recent items for <?php echo htmlspecialchars($blog->getName())?></a></li>
			<li><a href="<?php echo $blog->getURL()?>">Visit your own site</a></li>
		</ul>
		
		<?php		$this->pagefoot();
	}
	
	/** 
	  * Allows to edit previously made comments
	  */
	function action_commentedit() {
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		
		$member->canAlterComment($commentid) or $this->disallow();

		$comment = COMMENT::getComment($commentid);
		
		$manager->notify('PrepareCommentForEdit',array('comment' => &$comment));

		// change <br /> to \n
		$comment['body'] = str_replace('<br />','',$comment['body']);
		
		$comment['body'] = eregi_replace("<a href=['\"]([^'\"]+)['\"]>[^<]*</a>","\\1",$comment['body']);
		
		$this->pagehead();
		
		?>
		<h2><?php echo _EDITC_TITLE?></h2>
		
		<form action="index.php" method="post"><div>
		
		<input type="hidden" name="action" value="commentupdate" />
		<input type="hidden" name="commentid" value="<?php echo  $commentid; ?>" />
		<table><tr>
			<th colspan="2"><?php echo _EDITC_TITLE?></th>
		</tr><tr>
			<td><?php echo _EDITC_WHO?></td>
			<td>
			<?php				if ($comment['member']) 
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
		</tr><tr>
			<td><?php echo _EDITC_TEXT?></td>
			<td>
				<textarea name="body" tabindex="10" rows="10" cols="50"><?php					// htmlspecialchars not needed (things should be escaped already)
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
	
	function action_commentupdate() {
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		
		$member->canAlterComment($commentid) or $this->disallow();
		
		$body = postVar('body');
		
		// intercept words that are too long
		if (eregi("[a-zA-Z0-9|\.,;:!\?=\/\\]{90,90}",$body) != false) 
			$this->error(_ERROR_COMMENT_LONGWORD);

		// check length
		if (strlen($body)<3)
			$this->error(_ERROR_COMMENT_NOCOMMENT);
		if (strlen($body)>5000)
			$this->error(_ERROR_COMMENT_TOOLONG);
		
		
		// prepare body
		$body = COMMENT::prepareBody($body);
		
		// call plugins
		$manager->notify('PreUpdateComment',array('body' => &$body));
		
		$query =  'UPDATE '.sql_table('comment')
		       . " SET cbody='" .addslashes($body). "'"
		       . " WHERE cnumber=" . $commentid;
		sql_query($query);
		
		// get itemid
		$res = sql_query('SELECT citem FROM '.sql_table('comment').' WHERE cnumber=' . $commentid);
		$o = mysql_fetch_object($res);
		$itemid = $o->citem;
		
		if ($member->canAlterItem($itemid))
			$this->action_itemcommentlist($itemid); 
		else
			$this->action_browseowncomments();
	
	}
	
	function action_commentdelete() {
		global $member;
		
		$commentid = intRequestVar('commentid');
		
		$member->canAlterComment($commentid) or $this->disallow();

		$comment = COMMENT::getComment($commentid);

		$body = strip_tags($comment['body']);
		$body = htmlspecialchars(shorten($body, 300, '...'));
		
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
				<input type="hidden" name="commentid" value="<?php echo  $commentid; ?>" />
				<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
	function action_commentdeleteconfirm() {
		global $member;
		
		$commentid = intRequestVar('commentid');
		
		// get item id first
		$res = sql_query('SELECT citem FROM '.sql_table('comment') .' WHERE cnumber=' . $commentid);
		$o = mysql_fetch_object($res);
		$itemid = $o->citem;

		$error = $this->deleteOneComment($commentid);
		if ($error)
			$this->doError($error);
			
		if ($member->canAlterItem($itemid))
			$this->action_itemcommentlist($itemid); 
		else
			$this->action_browseowncomments();
	}
	
	function deleteOneComment($commentid) {
		global $member, $manager;
		
		$commentid = intval($commentid);
		
		if (!$member->canAlterComment($commentid))
			return _ERROR_DISALLOWED;
			
		$manager->notify('PreDeleteComment', array('commentid' => $commentid));
				
		// delete the comments associated with the item
		$query = 'DELETE FROM '.sql_table('comment').' WHERE cnumber=' . $commentid;
		sql_query($query);
		
		$manager->notify('PostDeleteComment', array('commentid' => $commentid));		
		
		return '';
	}
	
	/**
	  * Usermanagement main
	  */
	function action_usermanagement() {
		global $member;
		
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
		
		$batch = new BATCH('member');
		$batch->showlist($query,'table',$template);

		echo '<h3>' . _MEMBERS_NEW .'</h3>';
		?>
			<form method="post" action="index.php"><div>
			
			<input type="hidden" name="action" value="memberadd" />
			
			<table>
			<tr>
				<th colspan="2"><?php echo _MEMBERS_NEW?></th>
			</tr><tr>
				<td><?php echo _MEMBERS_DISPLAY?> <?php help('shortnames');?>
				    <br /><small>(This is the name used to logon)</small>
				</td>
				<td><input tabindex="10010" name="name" size="16" maxlength="16" /></td>
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
		<form method="post" action="index.php"><div>
		
		<input type="hidden" name="action" value="changemembersettings" />
		<input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
		<table><tr>
			<th colspan="2"><?php echo _MEMBERS_EDIT?></th>
		</tr><tr>
			<td><?php echo _MEMBERS_DISPLAY?> <?php help('shortnames');?>
			    <br /><small><?php echo _MEMBERS_DISPLAY_INFO?></small>
			</td>
			<td>
			<?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
				<input name="name" tabindex="10" maxlength="16" size="16" value="<?php echo  htmlspecialchars($mem->getDisplayName()); ?>" />
			<?php } else {
				echo htmlspecialchars($member->getDisplayName());
			   }
			?>
			</td>
		</tr><tr>
			<td><?php echo _MEMBERS_REALNAME?></td>
			<td><input name="realname" tabindex="20" maxlength="60" size="40" value="<?php echo  htmlspecialchars($mem->getRealName()); ?>" /></td>
		</tr><tr>		
		<?php if ($CONF['AllowLoginEdit'] || $member->isAdmin()) { ?>
			<td><?php echo _MEMBERS_PWD?></td>
			<td><input type="password" tabindex="30" maxlength="40" size="16" name="password" /></td>
		<?php } ?>
		</tr><tr>
			<td><?php echo _MEMBERS_REPPWD?></td>
			<td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" /></td>
		</tr><tr>
			<td><?php echo _MEMBERS_EMAIL?>
			    <br /><small><?php echo _MEMBERS_EMAIL_EDIT?></small>
			</td>
			<td><input name="email" tabindex="40" size="40" maxlength="60" value="<?php echo  htmlspecialchars($mem->getEmail()); ?>" /></td>
		</tr><tr>
			<td><?php echo _MEMBERS_URL?></td>
			<td><input name="url" tabindex="50" size="40" maxlength="100" value="<?php echo  htmlspecialchars($mem->getURL()); ?>" /></td>			
		<?php // only allow to change this by super-admins
		   // we don't want normal users to 'upgrade' themselves to super-admins, do we? ;-)
		   if ($member->isAdmin()) : 
		?>
			</tr><tr>
				<td><?php echo _MEMBERS_SUPERADMIN?> <?php help('superadmin'); ?></td>
				<td><?php $this->input_yesno('admin',$mem->isAdmin(),60); ?></td>	
			</tr><tr>
				<td><?php echo _MEMBERS_CANLOGIN?> <?php help('canlogin'); ?></td>
				<td><?php $this->input_yesno('canlogin',$mem->canLogin(),70); ?></td>
		<?php endif; ?>
		</tr><tr>
			<td><?php echo _MEMBERS_NOTES?></td>
			<td><input name="notes" tabindex="80" size="40" maxlength="100" value="<?php echo  htmlspecialchars($mem->getNotes()); ?>" /></td>			
		</tr><tr>		
			<td><?php echo _MEMBERS_DEFLANG?> <?php help('language'); ?>
			</td>
			<td>
			
				<select name="deflang" tabindex="85">
					<option value=""><?php echo _MEMBERS_USESITELANG?></option>
				<?php				// show a dropdown list of all available languages
				global $DIR_LANG;
				$dirhandle = opendir($DIR_LANG);
				while ($filename = readdir($dirhandle)) {
					if (ereg("^(.*)\.php$",$filename,$matches)) {
						$name = $matches[1];
						echo "<option value='$name'";
						if ($name == $mem->getLanguage())
							echo " selected='selected'";
						echo ">$name</option>";
					}
				}
				closedir($dirhandle);

				?>
				</select>			
			
			</td>
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
		
			$manager->notify(
				'MemberSettingsFormExtras', 	
				array(
					'member' => &$mem
				)
			);
			
		$this->pagefoot();
	}
	
	
	function action_changemembersettings() {
		global $member, $CONF, $manager;
		
		$memberid = intRequestVar('memberid');
		
		// check if allowed
		($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();
		
		$name			= trim(postVar('name'));
		$realname		= trim(postVar('realname'));
		$password		= postVar('password');
		$repeatpassword	= postVar('repeatpassword');		
		$email			= postVar('email');
		$url			= postVar('url');

		// Sometimes user didn't prefix the URL with http://, this cause a malformed URL. Let's fix it.
		if (!eregi("^https?://", $url))
			$url = "http://".$url;

		$admin			= postVar('admin');
		$canlogin		= postVar('canlogin');
		$notes			= postVar('notes');
		$deflang		= postVar('deflang');
		
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
		}
		
		if (!isValidMailAddress($email))
			$this->error(_ERROR_BADEMAILADDRESS);

	
		if (!$realname)
			$this->error(_ERROR_REALNAMEMISSING);
			
		if (($deflang != '') && (!checkLanguage($deflang))) 
			$this->error(_ERROR_NOSUCHLANGUAGE);
		
		// only allow taking away super-admin privileges when there are other super-admins
		// left
		if (    (!$admin && $mem->isAdmin())
		     || (!$canlogin && $mem->isAdmin() && $mem->canLogin())
		   )
		{
			$r = sql_query('SELECT * FROM '.sql_table('member').' WHERE madmin=1 and mcanlogin=1');
			if (mysql_num_rows($r) < 2)
				$this->error(_ERROR_ATLEASTONEADMIN);
		}
		
		if ($CONF['AllowLoginEdit'] || $member->isAdmin()) {
			$mem->setDisplayName($name);
			if ($password) 
				$mem->setPassword($password);
		}

		if ($newpass)
			$mem->setPassword($password);
		
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

	
		$mem->write();
		
		// if email changed, generate new password
		if ($oldEmail != $mem->getEmail())
		{
			$mem->sendActivationLink('addresschange', $oldEmail);
			// logout member
			$mem->newCookieKey();
			$mem->logout();	
		}
		
		
		// store plugin options
		$aOptions = requestArray('plugoption');
		NucleusPlugin::_applyPluginOptions($aOptions);
		$manager->notify('PostPluginOptionsUpdate',array('context' => 'member', 'memberid' => $memberid, 'member' => &$mem));		
		
		// if new password was generated, send out mail message and logout
		if ($newpass) 
			$mem->sendPassword($password);

		if (  ( $mem->getID() == $member->getID() ) 
		   && ( $newpass || ( $mem->getDisplayName() != $member->getDisplayName() ) )
		   ) {
		    $mem->newCookieKey();
			$member->logout();
			$this->action_login(_MSG_LOGINAGAIN, 0);
		} else {
			$this->action_overview(_MSG_SETTINGSCHANGED);
		}
	}
	
	function action_memberadd() {
		global $member;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		if (postVar('password') != postVar('repeatpassword'))
			$this->error(_ERROR_PASSWORDMISMATCH);
		if (strlen(postVar('password')) < 6)  
			$this->error(_ERROR_PASSWORDTOOSHORT);
		
		$res = MEMBER::create(postVar('name'), postVar('realname'), postVar('password'), postVar('email'), postVar('url'), postVar('admin'), postVar('canlogin'), postVar('notes'));	
		if ($res != 1)
			$this->error($res);
		
		$this->action_usermanagement();		
	}
	
	/**
	 * Account activation
	 *
	 * @author dekarma
	 */
	function action_activate() {
		
		$key = getVar('key');
		
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
			'memberName' => htmlspecialchars($mem->getDisplayName())
		);
		$title = TEMPLATE::fill($title, $aVars);
		$text = TEMPLATE::fill($text, $aVars);

		$this->pagehead();
		
			echo '<h2>' , $title, '</h2>';
			echo '<p>' , $text, '</p>';
			
			if ($bNeedsPasswordChange)
			{
				?>			
					<div><form action="index.php" method="post">

						<input type="hidden" name="action" value="activatesetpwd" />
						<input type="hidden" name="key" value="<?php echo htmlspecialchars($key) ?>" />

						<table><tr>
							<td><?php echo _MEMBERS_PWD?></td>
							<td><input type="password" tabindex="30" maxlength="40" size="16" name="password" /></td>
						</tr><tr>
							<td><?php echo _MEMBERS_REPPWD?></td>
							<td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" /></td>
						</tr><tr>
							<td><?php echo _MEMBERS_SETPWD ?></td>
							<td><input type='submit' value='<?php echo _MEMBERS_SETPWD_BTN ?>' /></td>		
						</tr></table>

					</form></div>

				<?php
				
				// TODO: plugin hooks!
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
			$this->error(_ERROR_ACTIVATE);
			
		$mem = MEMBER::createFromId($info->vmember);
		
		if (!$mem)
			$this->error(_ERROR_ACTIVATE);
		
		$password 		= postVar('password');
		$repeatpassword	= postVar('repeatpassword');
		
		if ($password != $repeatpassword)
			$this->error(_ERROR_PASSWORDMISMATCH);

		if ($password && (strlen($password) < 6))
			$this->error(_ERROR_PASSWORDTOOSHORT);
		
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
		global $member;
		
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
		
		$batch = new BATCH('team');
		$batch->showlist($query, 'table', $template);

		?>
			<h3><?php echo _TEAM_ADDNEW?></h3>

			<form method='post' action='index.php'><div>
			
			<input type='hidden' name='action' value='teamaddmember' />
			<input type='hidden' name='blogid' value='<?php echo  $blogid; ?>' />

			<table><tr>
				<td><?php echo _TEAM_CHOOSEMEMBER?></td>
				<td><?php					// TODO: try to make it so only non-team-members are listed
					$query =  'SELECT mname as text, mnumber as value'
					       . ' FROM '.sql_table('member');

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
	  * Add member tot tram
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
			
			<p><?php echo _CONFIRMTXT_TEAM1?><b><?php echo  $teammem->getDisplayName() ?></b><?php echo _CONFIRMTXT_TEAM2?><b><?php echo  htmlspecialchars(strip_tags($blog->getName())) ?></b>
			</p>
			
			
			<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="teamdeleteconfirm" />
			<input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
			<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
			<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
	function action_teamdeleteconfirm() {
		global $member;
		
		$memberid = intRequestVar('memberid');
		$blogid = intRequestVar('blogid');

		$error = $this->deleteOneTeamMember($blogid, $memberid);
		
		
		$this->action_manageteam();
	}
	
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
		
		$manager->notify('PreDeleteTeamMember', array('member' => &$mem, 'blogid' => $blogid));				
		
		if ($tmem->isBlogAdmin($blogid)) {
			// check if there are more blog members left and at least one admin
			// (check for at least two admins before deletion)
			$query = 'SELECT * FROM '.sql_table('team') . ' WHERE tblog='.$blogid.' and tadmin=1';
			$r = sql_query($query);
			if (mysql_num_rows($r) < 2)
				return _ERROR_ATLEASTONEBLOGADMIN;
		}
		
		$query = 'DELETE FROM '.sql_table('team')." WHERE tblog=$blogid and tmember=$memberid";
		sql_query($query);
		
		$manager->notify('PostDeleteTeamMember', array('member' => &$mem, 'blogid' => $blogid));						
		
		return '';
	}
	
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
			if (mysql_num_rows($r) == 1)
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
		
		<p>Members currently on your team: 
		<?php
			$res = sql_query('SELECT mname, mrealname FROM ' . sql_table('member') . ',' . sql_table('team') . ' WHERE mnumber=tmember AND tblog=' . intval($blogid));
			$aMemberNames = array();
			while ($o = mysql_fetch_object($res))
				array_push($aMemberNames, htmlspecialchars($o->mname) . ' (' . htmlspecialchars($o->mrealname). ')');
			echo implode(',', $aMemberNames);
		?>
		</p>
		
		

		<p>
		<a href="index.php?action=manageteam&amp;blogid=<?php echo $blogid?>"><?php echo _EBLOG_TEAM_TEXT?></a>
		</p>

		<h3><?php echo _EBLOG_SETTINGS_TITLE?></h3>
		
		<form method="post" action="index.php"><div>
		
		<input type="hidden" name="action" value="blogsettingsupdate" />
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<table><tr>
			<td><?php echo _EBLOG_NAME?></td>
			<td><input name="name" tabindex="10" size="40" maxlength="60" value="<?php echo  htmlspecialchars($blog->getName()) ?>" /></td>
		</tr><tr>
			<td><?php echo _EBLOG_SHORTNAME?> <?php help('shortblogname'); ?>
				<?php echo _EBLOG_SHORTNAME_EXTRA?>
			</td>
			<td><input name="shortname" tabindex="20" maxlength="15" size="15" value="<?php echo  htmlspecialchars($blog->getShortName()) ?>" /></td>
		</tr><tr>
			<td><?php echo _EBLOG_DESC?></td>
			<td><input name="desc" tabindex="30" maxlength="200" size="40" value="<?php echo  htmlspecialchars($blog->getDescription()) ?>" /></td>
		</tr><tr>
			<td><?php echo _EBLOG_URL?></td>
			<td><input name="url" tabindex="40" size="40" maxlength="100" value="<?php echo  htmlspecialchars($blog->getURL()) ?>" /></td>
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
			<td><?php echo _EBLOG_NOTIFY?> <?php help('blognotify'); ?></td>
			<td><input name="notify" tabindex="80" maxlength="60" size="40" value="<?php echo  htmlspecialchars($blog->getNotifyAddress()); ?>" /></td>
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
			<td><?php echo _EBLOG_PING?> <?php help('pinguserland'); ?></td>
			<td><?php $this->input_yesno('pinguserland',$blog->pingUserland(),85); ?></td>				
		</tr><tr>		
			<td><?php echo _EBLOG_MAXCOMMENTS?> <?php help('blogmaxcomments'); ?></td>
			<td><input name="maxcomments" tabindex="90" size="3" value="<?php echo  htmlspecialchars($blog->getMaxComments()); ?>" /></td>
		</tr><tr>
			<td><?php echo _EBLOG_UPDATE?> <?php help('blogupdatefile'); ?></td>
			<td><input name="update" tabindex="100" size="40" maxlength="60" value="<?php echo  htmlspecialchars($blog->getUpdateFile()) ?>" /></td>
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
			<td><input name="timeoffset" tabindex="120" size="3" value="<?php echo  htmlspecialchars($blog->getTimeOffset()); ?>" /></td>			
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
		
		$batch = new BATCH('category');
		$batch->showlist($query,'table',$template);
		
		?>

		
		<form action="index.php" method="post"><div>
		<input name="action" value="categorynew" type="hidden" />
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
		
		 	$manager->notify(
				'BlogSettingsFormExtras', 	
				array(
					'blog' => &$blog
				)
			);
		
		$this->pagefoot();
	}
	
	function action_categorynew() {
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$cname = postVar('cname');
		$cdesc = postVar('cdesc');
		
		if (!isValidCategoryName($cname))
			$this->error(_ERROR_BADCATEGORYNAME);
			
		$query = 'SELECT * FROM '.sql_table('category') . ' WHERE cname=\'' . addslashes($cname).'\' and cblog=' . intval($blogid);
		$res = sql_query($query);
		if (mysql_num_rows($res) > 0)
			$this->error(_ERROR_DUPCATEGORYNAME);
			
		$blog 		=& $manager->getBlog($blogid);
		$newCatID	=  $blog->createNewCategory($cname, $cdesc);
		
		$this->action_blogsettings();
	}
	
	
	function action_categoryedit($catid = '', $blogid = '', $desturl = '') {
		global $member;
		
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
		$obj = mysql_fetch_object($res);

		$cname = $obj->cname;
		$cdesc = $obj->cdesc;

		$extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
		$this->pagehead($extrahead);

		?>
		<h2><?php echo _EBLOG_CAT_UPDATE?> '<?php echo htmlspecialchars($cname)?>'</h2>
		<form method='post' action='index.php'><div>
		<input name="blogid" type="hidden" value="<?php echo $blogid?>" />
		<input name="catid" type="hidden" value="<?php echo $catid?>" />			
		<input name="desturl" type="hidden" value="<?php echo htmlspecialchars($desturl) ?>" />					
		<input name="action" type="hidden" value="categoryupdate" />		
		
		<table><tr>
			<th colspan="2"><?php echo _EBLOG_CAT_UPDATE ?></th>
		</tr><tr>
			<td><?php echo _EBLOG_CAT_NAME?></td>
			<td><input type="text" name="cname" value="<?php echo htmlspecialchars($cname)?>" size="40" maxlength="40" /></td>
		</tr><tr>
			<td><?php echo _EBLOG_CAT_DESC?></td>
			<td><input type="text" name="cdesc" value="<?php echo htmlspecialchars($cdesc)?>" size="40" maxlength="200" /></td>
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
			
		$query = 'SELECT * FROM '.sql_table('category').' WHERE cname=\'' . addslashes($cname).'\' and cblog=' . intval($blogid) . " and not(catid=$catid)";
		$res = sql_query($query);
		if (mysql_num_rows($res) > 0)
			$this->error(_ERROR_DUPCATEGORYNAME);
			
		$query =  'UPDATE '.sql_table('category').' SET'
			   . " cname='" . addslashes($cname) . "',"
			   . " cdesc='" . addslashes($cdesc) . "'"			   
			   . " WHERE catid=" . $catid;
			   
		sql_query($query);
		
		// store plugin options
		$aOptions = requestArray('plugoption');
		NucleusPlugin::_applyPluginOptions($aOptions);
		$manager->notify('PostPluginOptionsUpdate',array('context' => 'category', 'catid' => $catid));		

		
		if ($desturl) {
			header('Location: ' . $desturl);
			exit;
		} else {
			$this->action_blogsettings();
		}
	}

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
		if (mysql_num_rows($res) == 1)
			$this->error(_ERROR_DELETELASTCATEGORY);
		
		
		$this->pagehead();
		?>
			<h2><?php echo _DELETE_CONFIRM?></h2>
			
			<div>
			<?php echo _CONFIRMTXT_CATEGORY?><b><?php echo  $blog->getCategoryName($catid)?></b>
			</div>
			
			<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="categorydeleteconfirm" />
			<input type="hidden" name="blogid" value="<?php echo $blogid?>" />
			<input type="hidden" name="catid" value="<?php echo $catid?>" />						
			<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
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

	function deleteOneCategory($catid) {
		global $manager, $member;
		
		$catid = intval($catid);
		
		$manager->notify('PreDeleteCategory', array('catid' => $catid));		

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
		if (mysql_num_rows($res) == 1)
			return _ERROR_DELETELASTCATEGORY;
			
		// change category for all items to the default category
		$query = 'UPDATE '.sql_table('item')." SET icat=$destcatid WHERE icat=$catid";
		sql_query($query);
		
		// delete all associated plugin options
		NucleusPlugin::_deleteOptionValues('category', $catid);
		
		// delete category
		$query = 'DELETE FROM '.sql_table('category').' WHERE catid=' .$catid;
		sql_query($query);
		
		$manager->notify('PostDeleteCategory', array('catid' => $catid));				

	}
	
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
			
		$manager->notify(
			'PreMoveCategory',
			array(
				'catid' => &$catid,
				'sourceblog' => &$blog,
				'destblog' => &$destblog
			)
		);
		
		// update comments table (cblog)
		$query = 'SELECT inumber FROM '.sql_table('item').' WHERE icat='.$catid;
		$items = sql_query($query);
		while ($oItem = mysql_fetch_object($items)) {
			sql_query('UPDATE '.sql_table('comment').' SET cblog='.$destblogid.' WHERE citem='.$oItem->inumber);
		}

		// update items (iblog)
		$query = 'UPDATE '.sql_table('item').' SET iblog='.$destblogid.' WHERE icat='.$catid;
		sql_query($query);

		// move category 
		$query = 'UPDATE '.sql_table('category').' SET cblog='.$destblogid.' WHERE catid='.$catid;
		sql_query($query);

		$manager->notify(
			'PostMoveCategory',
			array(
				'catid' => &$catid,
				'sourceblog' => &$blog,
				'destblog' => $destblog
			)
		);		
		
	}

	function action_blogsettingsupdate() {
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		$notify			= trim(postVar('notify'));
		$shortname		= trim(postVar('shortname'));
		$updatefile		= trim(postVar('update'));
		
		$notifyComment	= intPostVar('notifyComment');
		$notifyVote		= intPostVar('notifyVote');
		$notifyNewItem	= intPostVar('notifyNewItem');		
		
		if ($notifyComment == 0)	$notifyComment = 1;
		if ($notifyVote == 0)		$notifyVote = 1;		
		if ($notifyNewItem == 0)	$notifyNewItem = 1;		
		
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
		$blog->setPingUserland(postVar('pinguserland'));
		$blog->setConvertBreaks(intPostVar('convertbreaks'));
		$blog->setAllowPastPosting(intPostVar('allowpastposting'));		
		$blog->setDefaultCategory(intPostVar('defcat'));
		$blog->setSearchable(intPostVar('searchable'));

		$blog->writeSettings();
		
		// store plugin options
		$aOptions = requestArray('plugoption');
		NucleusPlugin::_applyPluginOptions($aOptions);
		$manager->notify('PostPluginOptionsUpdate',array('context' => 'blog', 'blogid' => $blogid, 'blog' => &$blog));		
		
		
		$this->action_overview(_MSG_SETTINGSCHANGED);
	}
	
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
			<?php echo _CONFIRMTXT_BLOG?><b><?php echo  htmlspecialchars($blog->getName())?></b>
			</div>
			
			<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="deleteblogconfirm" />
			<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
			<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
	function action_deleteblogconfirm() {
		global $member, $CONF, $manager;
		
		$blogid = intRequestVar('blogid');		
		
		$manager->notify('PreDeleteBlog', array('blogid' => $blogid));				
		
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
		
		$manager->notify('PostDeleteBlog', array('blogid' => $blogid));						
		
		$this->action_overview(_DELETED_BLOG);
	}
	
	function action_memberdelete() {
		global $member;
		
		$memberid = intRequestVar('memberid');
	
		($member->getID() == $memberid) or $member->isAdmin() or $this->disallow();
		
		$mem = MEMBER::createFromID($memberid);
		
		$this->pagehead();
		?>
			<h2><?php echo _DELETE_CONFIRM?></h2>
			
			<p><?php echo _CONFIRMTXT_MEMBER?><b><?php echo  $mem->getDisplayName() ?></b>
			</p>
			
			<p>
			Please note that media files will <b>NOT</b> be deleted. (At least not in this Nucleus version)
			</p>
			
			<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="memberdeleteconfirm" />
			<input type="hidden" name="memberid" value="<?php echo  $memberid; ?>" />
			<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}
	
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
	
	// (static)	
	function deleteOneMember($memberid) {
		global $manager;
		
		$memberid = intval($memberid);
		$mem = MEMBER::createFromID($memberid);
		
		if (!$mem->canBeDeleted()) 
			return _ERROR_DELETEMEMBER;	

		$manager->notify('PreDeleteMember', array('member' => &$mem));				
		
		$query = 'DELETE FROM '.sql_table('member').' WHERE mnumber='.$memberid;
		sql_query($query);

		$query = 'DELETE FROM '.sql_table('team').' WHERE tmember='.$memberid;
		sql_query($query);	
		
		$query = 'DELETE FROM '.sql_table('activation').' WHERE vmember='.$memberid;
		sql_query($query);			
		
		// delete all associated plugin options
		NucleusPlugin::_deleteOptionValues('member', $memberid);
		
		$manager->notify('PostDeleteMember', array('member' => &$mem));						
		
		return '';
	}
	
	function action_createnewlog() {
		global $member, $CONF;
		
		// Only Super-Admins can do this
		$member->isAdmin() or $this->disallow();
		
		$this->pagehead();

		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';
		?>
		<h2><?php echo _EBLOG_CREATE_TITLE?></h2>
		
		<h3>Some information</h3>
		
		<p>Before you start, here's some <strong>important information</strong></p>
		
		<p>After you've created a new weblog, you'll need to perform some actions to make your blog accessible. There are two possibilities:</p>
		
		<ol>
			<li><strong>Simple:</strong> Create a copy of <code>index.php</code> and modify it to display your new weblog. Further instructions on how to do this will be provided after you've submitted this first form.</li>
			<li><strong>Advanced:</strong> Insert the blog content into your current skins using skinvars like <code>otherblog</code>. This way, you can place multiple blogs on the same page.</li>
		</ol>
		
		<h3>Create Weblog</h3>
		
		<p>
		<?php echo _EBLOG_CREATE_TEXT?>
		</p>
		
		<form method="post" action="index.php"><div>
		
		<input type="hidden" name="action" value="addnewlog" />
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
					$template['selected'] = $CONF['BaseSkin'];	// set default selected skin to be globally defined base skin
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
			    <?php help('blogadmin'); ?>
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
	
	function action_addnewlog() {
		global $member, $manager, $CONF;
		
		// Only Super-Admins can do this
		$member->isAdmin() or $this->disallow();
		
		$bname			= trim(postVar('name'));
		$bshortname		= trim(postVar('shortname'));
		$btimeoffset	= postVar('timeoffset');
		$bdesc			= trim(postVar('desc'));
		$bdefskin		= postVar('defskin');
		
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
				'description' => &$bdescription,
				'defaultskin' => &$bdefskin
			)
		);


		// add slashes for sql queries
		$bname = 		addslashes($bname);
		$bshortname = 	addslashes($bshortname);
		$btimeoffset = 	addslashes($btimeoffset);
		$bdesc = 		addslashes($bdesc);
		$bdefskin = 	addslashes($bdefskin);
		
		// create blog
		$query = 'INSERT INTO '.sql_table('blog')." (bname, bshortname, bdesc, btimeoffset, bdefskin) VALUES ('$bname', '$bshortname', '$bdesc', '$btimeoffset', '$bdefskin')";
		sql_query($query);
		$blogid	= mysql_insert_id();
		$blog	=& $manager->getBlog($blogid);
		
		// create new category
		sql_query('INSERT INTO '.sql_table('category')." (cblog, cname, cdesc) VALUES ($blogid, 'General','Items that do not fit in other categories')");
		$catid = mysql_insert_id();

		// set as default category
		$blog->setDefaultCategory($catid);
		$blog->writeSettings();
	
		// create team member	
		$memberid = $member->getID();
		$query = 'INSERT INTO '.sql_table('team')." (tmember, tblog, tadmin) VALUES ($memberid, $blogid, 1)";
		sql_query($query);
	

		$blog->additem($blog->getDefaultCategory(),'First Item','This is the first item in your weblog. Feel free to delete it.','',$blogid, $memberid,$blog->getCorrectTime(),0,0,0);
		
		$manager->notify(
			'PostAddBlog',
			array(
				'blog' => &$blog
			)
		);
		
		$manager->notify(
			'PostAddCategory',
			array(
				'catid' => $catid
			)
		);
		
		$this->pagehead();
		?>
		<h2>New weblog created</h2>
		
		<p>Your new weblog (<?php echo htmlspecialchars($bname)?>) has been created. To continue, choose the way you'll want to make it viewable:</p>
		
		<ol>
			<li><a href="#index_php">Easiest: A copy of <code><?php echo htmlspecialchars($bshortname)?>.php</code></a></li>
			<li><a href="#skins">Advanced: Call the weblog from existing skins</a></li>			
		</ol>
		
		<h3><a id="index_php">Method 1: Create an extra <code><?php echo htmlspecialchars($bshortname)?>.php</code> file</a></h3>
		
		<p>Create a file called <code><?php echo htmlspecialchars($bshortname)?>.php</code>, and copy-paste the following code into it:</p>
<pre><code>&lt;?php

$CONF['Self'] = '<b><?php echo htmlspecialchars($bshortname)?>.php</b>';

include('<i>./config.php</i>');

selectBlog('<b><?php echo htmlspecialchars($bshortname)?></b>');
selector();

?&gt;</code></pre>

		<p>Upload the file next to your existing <code>index.php</code> file, and you should be all set.</p>
		
		<p>To finish the weblog creation process, please fill out the final URL for your weblog (the proposed value is a <em>guess</em>, don't take it for granted):</p>
		
		<form action="index.php" method="post"><div>
			<input type="hidden" name="action" value="addnewlog2" />		
			<input type="hidden" name="blogid" value="<?php echo intval($blogid)?>" />						
			<table><tr>
				<td><?php echo _EBLOG_URL?></td>
				<td><input name="url" maxlength="100" size="40" value="<?php echo htmlspecialchars($CONF['IndexURL'].$bshortname.'.php')?>" /></td>
			</tr><tr>
				<td><?php echo _EBLOG_CREATE?></td>
				<td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
			</tr></table>
		</div></form>
		
		<h3><a id="skins">Method 2: Call the weblog from existing skins</a></h3>

		<p>To finish the weblog creation process, simply please fill out the final URL for your weblog: (might be the same as another already existing weblog)</p>
		
		<form action="index.php" method="post"><div>
			<input type="hidden" name="action" value="addnewlog2" />
			<input type="hidden" name="blogid" value="<?php echo intval($blogid)?>" />			
			<table><tr>
				<td><?php echo _EBLOG_URL?></td>
				<td><input name="url" maxlength="100" size="40" /></td>
			</tr><tr>
				<td><?php echo _EBLOG_CREATE?></td>
				<td><input type="submit" value="<?php echo _EBLOG_CREATE_BTN?>" onclick="return checkSubmit();" /></td>
			</tr></table>
		</div></form>
		
		<?php		$this->pagefoot();		
		
	}
	
	function action_addnewlog2() {
		global $member, $manager;
		
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$burl	= requestVar('url');
		$blogid	= intRequestVar('blogid');
		
		$blog =& $manager->getBlog($blogid);		
		$blog->setURL(trim($burl));
		$blog->writeSettings();		
		
		$this->action_overview(_MSG_NEWBLOG);
	}

	function action_skinieoverview() {
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or $this->disallow();

		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';		
		
	?>
		<h2><?php echo _SKINIE_TITLE_IMPORT?></h2>	
			
				<p><label for="skinie_import_local"><?php echo _SKINIE_LOCAL?></label>
				<?php					global $DIR_SKINS;

					$candidates = SKINIMPORT::searchForCandidates($DIR_SKINS);

					if (sizeof($candidates) > 0) {
						?>
							<form method="post" action="index.php"><div>
								<input type="hidden" name="action" value="skinieimport" />
								<input type="hidden" name="mode" value="file" />
								<select name="skinfile" id="skinie_import_local">
								<?php									foreach ($candidates as $skinname => $skinfile) {
										$html = htmlspecialchars($skinfile);
										echo '<option value="',$html,'">',$skinname,'</option>';
									}
								?>
								</select>
								<input type="submit" value="<?php echo _SKINIE_BTN_IMPORT?>" />
							</div></form>
						<?php					} else {
						echo _SKINIE_NOCANDIDATES;
					}
				?>
				</p>
				
				<p><em><?php echo _OR?></em></p>
				
				<form method="post" action="index.php"><p>
					<input type="hidden" name="action" value="skinieimport" />
					<input type="hidden" name="mode" value="url" />					
					<label for="skinie_import_url"><?php echo _SKINIE_FROMURL?></label>
					<input type="text" name="skinfile" id="skinie_import_url" size="60" value="http://" />
					<input type="submit" value="<?php echo _SKINIE_BTN_IMPORT?>" />
				</p></form>

	
		<h2><?php echo _SKINIE_TITLE_EXPORT?></h2>
		<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="skinieexport" />
			
			<p><?php echo _SKINIE_EXPORT_INTRO?></p>
			
			<table><tr>
				<th colspan="2"><?php echo _SKINIE_EXPORT_SKINS?></th>
			</tr><tr>
	<?php		// show list of skins
		$res = sql_query('SELECT * FROM '.sql_table('skin_desc'));
		while ($skinObj = mysql_fetch_object($res)) {
			$id = 'skinexp' . $skinObj->sdnumber;
			echo '<td><input type="checkbox" name="skin[',$skinObj->sdnumber,']"  id="',$id,'" />';
			echo '<label for="',$id,'">',htmlspecialchars($skinObj->sdname),'</label></td>';
			echo '<td>',htmlspecialchars($skinObj->sddesc),'</td>';			
			echo '</tr><tr>';
		}
		
		echo '<th colspan="2">',_SKINIE_EXPORT_TEMPLATES,'</th></tr><tr>';
		
		// show list of templates
		$res = sql_query('SELECT * FROM '.sql_table('template_desc'));
		while ($templateObj = mysql_fetch_object($res)) {
			$id = 'templateexp' . $templateObj->tdnumber;		
			echo '<td><input type="checkbox" name="template[',$templateObj->tdnumber,']" id="',$id,'" />';
			echo '<label for="',$id,'">',htmlspecialchars($templateObj->tdname),'</label></td>';
			echo '<td>',htmlspecialchars($templateObj->tddesc),'</td>';			
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
	
	function action_skinieimport() {
		global $member, $DIR_LIBS, $DIR_SKINS;
		
		$member->isAdmin() or $this->disallow();
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		$skinFileRaw= postVar('skinfile');
		$mode 		= postVar('mode');

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
		

		if ($error) $this->error($error);

		$this->pagehead();

		echo '<p><a href="index.php?action=skinieoverview">(',_BACK,')</a></p>';		
		?>
		<h2><?php echo _SKINIE_CONFIRM_TITLE?></h2>

		<ul>
			<li><p><strong><?php echo _SKINIE_INFO_GENERAL?></strong> <?php echo htmlspecialchars($importer->getInfo())?></p></li>
			<li><p><strong><?php echo _SKINIE_INFO_SKINS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames())?></p></li>
			<li><p><strong><?php echo _SKINIE_INFO_TEMPLATES?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames())?></p></li>
			<li><p><strong style="color: red;"><?php echo _SKINIE_INFO_SKINCLASH?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->checkSkinNameClashes())?></p></li>		
			<li><p><strong style="color: red;"><?php echo _SKINIE_INFO_TEMPLCLASH?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->checkTemplateNameClashes())?></p></li>
		</ul>

		<form method="post" action="index.php"><div>
			<input type="hidden" name="action" value="skiniedoimport" />
			<input type="hidden" name="skinfile" value="<?php echo htmlspecialchars(postVar('skinfile'))?>" />
			<input type="hidden" name="mode" value="<?php echo htmlspecialchars($mode)?>" />			
			<input type="submit" value="<?php echo _SKINIE_CONFIRM_IMPORT?>" />
			<br />
			<input type="checkbox" name="overwrite" value="1" id="cb_overwrite" /><label for="cb_overwrite"><?php echo _SKINIE_CONFIRM_OVERWRITE?></label>
		</div></form>


		<?php		
		$this->pagefoot();
	}
	
	function action_skiniedoimport() {
		global $member, $DIR_LIBS, $DIR_SKINS;
		
		$member->isAdmin() or $this->disallow();
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');

		$skinFileRaw= postVar('skinfile');
		$mode		= postVar('mode');

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
			<li><p><strong><?php echo _SKINIE_INFO_GENERAL?></strong> <?php echo htmlspecialchars($importer->getInfo())?></p></li>
			<li><p><strong><?php echo _SKINIE_INFO_IMPORTEDSKINS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getSkinNames())?></p></li>
			<li><p><strong><?php echo _SKINIE_INFO_IMPORTEDTEMPLS?></strong> <?php echo implode(' <em>'._AND.'</em> ',$importer->getTemplateNames())?></p></li>
		</ul>

	<?php		$this->pagefoot();

	}
	
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
	
	function action_templateoverview() {
		global $member;
		
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
	
	function action_templateedit($msg = '') {
		global $member;
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or $this->disallow();
		
		$extrahead = '<script type="text/javascript" src="javascript/templateEdit.js"></script>';
		$extrahead .= '<script type="text/javascript">setTemplateEditText("'.addslashes(_EDITTEMPLATE_EMPTY).'");</script>';

		$this->pagehead($extrahead);
		
		$templatename = TEMPLATE::getNameFromId($templateid);
		$templatedescription = TEMPLATE::getDesc($templateid);
		$template = TEMPLATE::read($templatename);
		
		?>
		<p>
		<a href="index.php?action=templateoverview">(<?php echo _TEMPLATE_BACK?>)</a>
		</p>

		<h2><?php echo _TEMPLATE_EDIT_TITLE?> '<?php echo  $templatename; ?>'</h2>
		
		<?php					if ($msg) echo "<p>"._MESSAGE.": $msg</p>";
		?>
		
		<p><?php echo _TEMPLATE_EDIT_MSG?></p>
		
		<form method="post" action="index.php">
		<div>
		
		<input type="hidden" name="action" value="templateupdate" />
		<input type="hidden" name="templateid" value="<?php echo  $templateid; ?>" />
		
		<table><tr>
			<th colspan="2"><?php echo _TEMPLATE_SETTINGS?></th>
		</tr><tr>
			<td><?php echo _TEMPLATE_NAME?> <?php help('shortnames');?></td>
			<td><input name="tname" tabindex="4" size="20" maxlength="20" value="<?php echo  htmlspecialchars($templatename) ?>" /></td>
		</tr><tr>
			<td><?php echo _TEMPLATE_DESC?></td>
			<td><input name="tdesc" tabindex="5" size="50" maxlength="200" value="<?php echo  htmlspecialchars($templatedescription) ?>" /></td>
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
			<th colspan="2"><?php echo _TEMPLATE_CATEGORYLIST?> <?php help('templatecategorylists'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_CATHEADER, 'CATLIST_HEADER', '', 160);		
	$this->_templateEditRow($template, _TEMPLATE_CATITEM, 'CATLIST_LISTITEM', '', 170);			
	$this->_templateEditRow($template, _TEMPLATE_CATFOOTER, 'CATLIST_FOOTER', '', 180);		
?>
		</tr><tr>
			<th colspan="2"><?php echo _TEMPLATE_DATETIME?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_DHEADER, 'DATE_HEADER', 'dateheads', 190);		
	$this->_templateEditRow($template, _TEMPLATE_DFOOTER, 'DATE_FOOTER', 'dateheads', 200);			
	$this->_templateEditRow($template, _TEMPLATE_DFORMAT, 'FORMAT_DATE', 'datetime', 210);		
	$this->_templateEditRow($template, _TEMPLATE_TFORMAT, 'FORMAT_TIME', 'datetime', 220);			
	$this->_templateEditRow($template, _TEMPLATE_LOCALE, 'LOCALE', 'locale', 230);		
?>
		</tr><tr>	
			<th colspan="2"><?php echo _TEMPLATE_IMAGE?> <?php help('templatepopups'); ?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_PCODE, 'POPUP_CODE', '', 240);		
	$this->_templateEditRow($template, _TEMPLATE_ICODE, 'IMAGE_CODE', '', 250);			
	$this->_templateEditRow($template, _TEMPLATE_MCODE, 'MEDIA_CODE', '', 260);		
?>
		</tr><tr>
			<th colspan="2"><?php echo _TEMPLATE_SEARCH?></th>
<?php	$this->_templateEditRow($template, _TEMPLATE_SHIGHLIGHT, 'SEARCH_HIGHLIGHT', 'highlight',270);		
	$this->_templateEditRow($template, _TEMPLATE_SNOTFOUND, 'SEARCH_NOTHINGFOUND', 'nothingfound',280);		
?>			
		</tr><tr>
			<th colspan="2"><?php echo _TEMPLATE_UPDATE?></th>
		</tr><tr>
			<td><?php echo _TEMPLATE_UPDATE?></td>
			<td>
				<input type="submit" tabindex="290" value="<?php echo _TEMPLATE_UPDATE_BTN?>" onclick="return checkSubmit();" />
				<input type="reset" tabindex="300" value="<?php echo _TEMPLATE_RESET_BTN?>" />
			</td>
		</tr></table>
		
		</div>
		</form>
		<?php	
		$this->pagefoot();
	}
	
	function _templateEditRow(&$template, $description, $name, $help = '', $tabindex = 0, $big = 0) {
		static $count = 1;
	?>
		</tr><tr>	
			<td><?php echo $description?> <?php if ($help) help('template'.$help); ?></td>
			<td id="td<?php echo $count?>"><textarea class="templateedit" name="<?php echo $name?>" tabindex="<?php echo $tabindex?>" cols="50" rows="<?php echo $big?10:5?>" id="textarea<?php echo $count?>"><?php echo  htmlspecialchars($template[$name]); ?></textarea></td>
	<?php		$count++;
	}
	
	function action_templateupdate() {
		global $member;
		
		$templateid = intRequestVar('templateid');		

		$member->isAdmin() or $this->disallow();
		
		$name = postVar('tname');
		$desc = postVar('tdesc');
		
		if (!isValidTemplateName($name))
			$this->error(_ERROR_BADTEMPLATENAME);
		
		if ((TEMPLATE::getNameFromId($templateid) != $name) && TEMPLATE::exists($name))
			$this->error(_ERROR_DUPTEMPLATENAME);
				

		$name = addslashes($name);
		$desc = addslashes($desc);
		
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
		
		
		// jump back to template edit
		$this->action_templateedit(_TEMPLATE_UPDATED);
	
	}	

	function addToTemplate($id, $partname, $content) {
		$partname = addslashes($partname);
		$content = addslashes($content);	
		
		$id = intval($id);
		
		// don't add empty parts:
		if (!trim($content)) return -1;
		
		$query = 'INSERT INTO '.sql_table('template')." (tdesc, tpartname, tcontent) "
		       . "VALUES ($id, '$partname', '$content')";
		mysql_query($query) or die("Query error: " . mysql_error());
		return mysql_insert_id();
	}	
	
	function action_templatedelete() {
		global $member;
		
		$member->isAdmin() or $this->disallow();
		
		$templateid = intRequestVar('templateid');
		// TODO: check if template can be deleted
		
		$this->pagehead();
		
		$name = TEMPLATE::getNameFromId($templateid);
		$desc = TEMPLATE::getDesc($templateid);
		
		?>
			<h2><?php echo _DELETE_CONFIRM?></h2>
			
			<p>
			<?php echo _CONFIRMTXT_TEMPLATE?><b><?php echo $name?></b> (<?php echo  htmlspecialchars($desc) ?>)
			</p>
			
			<form method="post" action="index.php"><div>
				<input type="hidden" name="action" value="templatedeleteconfirm" />
				<input type="hidden" name="templateid" value="<?php echo  $templateid ?>" />
				<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}	
	
	function action_templatedeleteconfirm() {
		global $member, $manager;
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or $this->disallow();
		
		$manager->notify('PreDeleteTemplate', array('templateid' => $templateid));
		
		// 1. delete description
		sql_query('DELETE FROM '.sql_table('template_desc').' WHERE tdnumber=' . $templateid);
		
		// 2. delete parts
		sql_query('DELETE FROM '.sql_table('template').' WHERE tdesc=' . $templateid);
		
		$manager->notify('PostDeleteTemplate', array('templateid' => $templateid));		
		
		$this->action_templateoverview();
	}	
	
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
		while ($o = mysql_fetch_object($res)) {
			$this->addToTemplate($newid, $o->tpartname, $o->tcontent);
		}

		$this->action_templateoverview();
	}
	
	function action_skinoverview() {
		global $member;
		
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

	function action_skinedit() {
		global $member;
		
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
		
		<h3><?php echo _SKIN_GENSETTINGS_TITLE?></h3>
		<form method="post" action="index.php">
		<div>
		
		<input type="hidden" name="action" value="skineditgeneral" />
		<input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
		<table><tr>
			<td><?php echo _SKIN_NAME?> <?php help('shortnames');?></td>
			<td><input name="name" tabindex="90" value="<?php echo  htmlspecialchars($skin->getName()) ?>" maxlength="20" size="20" /></td>
		</tr><tr>
			<td><?php echo _SKIN_DESC?></td>
			<td><input name="desc" tabindex="100" value="<?php echo  htmlspecialchars($skin->getDescription()) ?>" maxlength="200" size="50" /></td>
		</tr><tr>
			<td><?php echo _SKIN_TYPE?></td>
			<td><input name="type" tabindex="110" value="<?php echo  htmlspecialchars($skin->getContentType()) ?>" maxlength="40" size="20" /></td>
		</tr><tr>
			<td><?php echo _SKIN_INCLUDE_MODE?> <?php help('includemode')?></td>
			<td><?php $this->input_yesno('inc_mode',$skin->getIncludeMode(),120,'skindir','normal',_PARSER_INCMODE_SKINDIR,_PARSER_INCMODE_NORMAL);?></td>
		</tr><tr>		
			<td><?php echo _SKIN_INCLUDE_PREFIX?> <?php help('includeprefix')?></td>
			<td><input name="inc_prefix" tabindex="130" value="<?php echo  htmlspecialchars($skin->getIncludePrefix()) ?>" maxlength="40" size="20" /></td>
		</tr><tr>		
			<td><?php echo _SKIN_CHANGE?></td>
			<td><input type="submit" tabindex="140" value="<?php echo _SKIN_CHANGE_BTN?>" onclick="return checkSubmit();" /></td>
		</tr></table>
		
		</div>
		</form>
		
		
		<?php		$this->pagefoot();
	}
	
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
	
	function action_skinedittype($msg = '') {
		global $member;
		
		$skinid = intRequestVar('skinid');
		$type = requestVar('type');
		
		$member->isAdmin() or $this->disallow();
		
		$skin = new SKIN($skinid);
		
		$friendlyNames = SKIN::getFriendlyNames();
		
		$this->pagehead();
		?>
		<p>(<a href="index.php?action=skinoverview"><?php echo _SKIN_GOBACK?></a>)</p>
		
		<h2><?php echo _SKIN_EDITPART_TITLE?> '<?php echo  $skin->getName() ?>': <?php echo  $friendlyNames[$type] ?></h2>
		
		<?php			if ($msg) echo "<p>"._MESSAGE.": $msg</p>";
		?>
		
		
		<form method="post" action="index.php">
		<div>
		
		<input type="hidden" name="action" value="skinupdate" />
		<input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
		<input type="hidden" name="type" value="<?php echo  $type ?>" />
		
		<input type="submit" value="<?php echo _SKIN_UPDATE_BTN?>" onclick="return checkSubmit();" />
		<input type="reset" value="<?php echo _SKIN_RESET_BTN?>" />
		(skin type: <?php echo  $friendlyNames[$type] ?>)
		<?php help('skinpart' . $type);?>
		<br />
		
		<textarea class="skinedit" tabindex="10" rows="20" cols="80" name="content"><?php echo  htmlspecialchars($skin->getContent($type)) ?></textarea>
		
		<br />
		<input type="submit" tabindex="20" value="<?php echo _SKIN_UPDATE_BTN?>" onclick="return checkSubmit();" />
		<input type="reset" value="<?php echo _SKIN_RESET_BTN?>" />
		(skin type: <?php echo  $friendlyNames[$type] ?>)
		
		<br /><br />
		<?php echo _SKIN_ALLOWEDVARS?> 
		<?php			$actions = SKIN::getAllowedActionsForType($type);

			sort($actions);
			
			while ($current = array_shift($actions)) {
				// skip deprecated vars
				if ($current == 'ifcat') continue;
				if ($current == 'imagetext') continue;
				if ($current == 'vars') continue;
				
				echo helplink('skinvar-' . $current) . "$current</a>";
				if (count($actions) != 0) echo ", ";
			}
		?>
		<br /><br />
		Short blog names:
		<?php			$query = 'SELECT bshortname, bname FROM '.sql_table('blog');
			showlist($query,'table',array('content'=>'shortblognames'));
		?>

		<br />
		Template names:
		<?php			$query = 'SELECT tdname as name, tddesc as description FROM '.sql_table('template_desc');
			showlist($query,'table',array('content'=>'shortnames'));
		?>

		
		</div>
		</form>
		
		
		<?php		$this->pagefoot();	
	}
	
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
	
	function action_skindelete() {
		global $member, $CONF;
		
		$skinid = intRequestVar('skinid');
		
		$member->isAdmin() or $this->disallow();
		
		// don't allow default skin to be deleted
		if ($skinid == $CONF['BaseSkin'])
			$this->error(_ERROR_DEFAULTSKIN);
			
		// don't allow deletion of default skins for blogs
		$query = 'SELECT bname FROM '.sql_table('blog').' WHERE bdefskin=' . $skinid;
		$r = sql_query($query);
		if ($o = mysql_fetch_object($r))
			$this->error(_ERROR_SKINDEFDELETE . $o->bname);
		
		$this->pagehead();
		
		$skin = new SKIN($skinid);
		$name = $skin->getName();
		$desc = $skin->getDescription();
		
		?>
			<h2><?php echo _DELETE_CONFIRM?></h2>
			
			<p>
				<?php echo _CONFIRMTXT_SKIN?><b><?php echo  $name ?></b> (<?php echo  htmlspecialchars($desc)?>)
			</p>
			
			<form method="post" action="index.php"><div>
				<input type="hidden" name="action" value="skindeleteconfirm" />
				<input type="hidden" name="skinid" value="<?php echo  $skinid ?>" />
				<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		
		$this->pagefoot();
	}	
	
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
		if ($o = mysql_fetch_object($r))
			$this->error(_ERROR_SKINDEFDELETE .$o->bname);		
		
		$manager->notify('PreDeleteSkin', array('skinid' => $skinid));	
		
		// 1. delete description
		sql_query('DELETE FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $skinid);
		
		// 2. delete parts
		sql_query('DELETE FROM '.sql_table('skin').' WHERE sdesc=' . $skinid);
		
		$manager->notify('PostDeleteSkin', array('skinid' => $skinid));			
		
		$this->action_skinoverview();
	}
	
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
		$this->skinclonetype($skin, $newid, 'index');
		$this->skinclonetype($skin, $newid, 'item');
		$this->skinclonetype($skin, $newid, 'archivelist');
		$this->skinclonetype($skin, $newid, 'archive');
		$this->skinclonetype($skin, $newid, 'search');
		$this->skinclonetype($skin, $newid, 'error');
		$this->skinclonetype($skin, $newid, 'member');
		$this->skinclonetype($skin, $newid, 'imagepopup');
		
		$this->action_skinoverview();
		
	}
	
	function skinclonetype($skin, $newid, $type) {
		$newid = intval($newid);
		$content = $skin->getContent($type);
		if ($content) {
			$query = 'INSERT INTO '.sql_table('skin')." (sdesc, scontent, stype) VALUES ($newid,'". addslashes($content)."', '". addslashes($type)."')";
			sql_query($query);
		}
	}
	
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
			<td><input name="AdminEmail" tabindex="10010" size="40" value="<?php echo  htmlspecialchars($CONF['AdminEmail']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SITENAME?></td>
			<td><input name="SiteName" tabindex="10020" size="40" value="<?php echo  htmlspecialchars($CONF['SiteName']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SITEURL?></td>
			<td><input name="IndexURL" tabindex="10030" size="40" value="<?php echo  htmlspecialchars($CONF['IndexURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ADMINURL?></td>
			<td><input name="AdminURL" tabindex="10040" size="40" value="<?php echo  htmlspecialchars($CONF['AdminURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_PLUGINURL?> <?php help('pluginurl');?></td>
			<td><input name="PluginURL" tabindex="10045" size="40" value="<?php echo  htmlspecialchars($CONF['PluginURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_SKINSURL?> <?php help('skinsurl');?></td>
			<td><input name="SkinsURL" tabindex="10046" size="40" value="<?php echo  htmlspecialchars($CONF['SkinsURL']) ?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ACTIONSURL?> <?php help('actionurl');?></td>
			<td><input name="ActionURL" tabindex="10047" size="40" value="<?php echo  htmlspecialchars($CONF['ActionURL']) ?>" /></td>
		</tr><tr>		
			<td><?php echo _SETTINGS_LANGUAGE?> <?php help('language'); ?>
			</td>
			<td>
			
				<select name="Language" tabindex="10050">
				<?php				// show a dropdown list of all available languages
				global $DIR_LANG;
				$dirhandle = opendir($DIR_LANG);
				while ($filename = readdir($dirhandle)) {
					if (ereg("^(.*)\.php$",$filename,$matches)) {
						$name = $matches[1];
						echo "<option value='$name'";
						if ($name == $CONF['Language'])
							echo " selected='selected'";
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
			    URL: <input name="DisableSiteURL" tabindex="10070" size="40" value="<?php echo  htmlspecialchars($CONF['DisableSiteURL'])?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_DIRS?></td>
			<td><?php echo  htmlspecialchars($DIR_NUCLEUS) ?>
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
			<?php					$extra = ($CONF['DisableJsTools'] == 1) ? 'selected="selected"' : ''; 
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
			<th colspan="2"><?php echo _SETTINGS_MEDIA?> <?php help('media'); ?></th>
		</tr><tr>
			<td><?php echo _SETTINGS_MEDIADIR?></td>
			<td><?php echo  htmlspecialchars($DIR_MEDIA) ?>
			    <i><?php echo _SETTINGS_SEECONFIGPHP?></i>
			    <?php			    	if (!is_dir($DIR_MEDIA))
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
			    <input name="MediaURL" tabindex="10080" size="40" value="<?php echo  htmlspecialchars($CONF['MediaURL']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_ALLOWUPLOAD?></td>
			<td><?php $this->input_yesno('AllowUpload',$CONF['AllowUpload'],10090); ?></td>
		</tr><tr>
			<td><?php echo _SETTINGS_ALLOWUPLOADTYPES?></td>
			<td>
			    <input name="AllowedTypes" tabindex="10100" size="40" value="<?php echo  htmlspecialchars($CONF['AllowedTypes']) ?>" />
			</td>
		</tr><tr>
			<td><?php echo _SETTINGS_MAXUPLOADSIZE?></td>
			<td>
			    <input name="MaxUploadSize" tabindex="10105" size="40" value="<?php echo  htmlspecialchars($CONF['MaxUploadSize']) ?>" />
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
			<td><?php echo _SETTINGS_COOKIEDOMAIN?></td>
			<td><input name="CookieDomain" tabindex="10160" size="40" value="<?php echo  htmlspecialchars($CONF['CookieDomain'])?>" /></td>
		</tr><tr>
			<td><?php echo _SETTINGS_COOKIEPATH?></td>
			<td><input name="CookiePath" tabindex="10170" size="40" value="<?php echo  htmlspecialchars($CONF['CookiePath'])?>" /></td>
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
		
			$manager->notify(
				'GeneralSettingsFormExtras', 	
				array()
			);
		
		$this->pagefoot();
	}
	
	function action_settingsupdate() {
		global $member, $CONF;
		
		$member->isAdmin() or $this->disallow();
		
		// check if email address for admin is valid
		if (!isValidMailAddress(postVar('AdminEmail')))
			$this->error(_ERROR_BADMAILADDRESS);

		
		// save settings	
		$this->updateConfig('DefaultBlog',		postVar('DefaultBlog'));	
		$this->updateConfig('BaseSkin',			postVar('BaseSkin'));			
		$this->updateConfig('IndexURL',			postVar('IndexURL'));	
		$this->updateConfig('AdminURL',			postVar('AdminURL'));
		$this->updateConfig('PluginURL',		postVar('PluginURL'));		
		$this->updateConfig('SkinsURL',			postVar('SkinsURL'));				
		$this->updateConfig('ActionURL',		postVar('ActionURL'));						
		$this->updateConfig('Language',			postVar('Language'));	
		$this->updateConfig('AdminEmail',		postVar('AdminEmail'));	
		$this->updateConfig('SessionCookie',	postVar('SessionCookie'));	
		$this->updateConfig('AllowMemberCreate',postVar('AllowMemberCreate'));	
		$this->updateConfig('AllowMemberMail',	postVar('AllowMemberMail'));	
		$this->updateConfig('NonmemberMail',	postVar('NonmemberMail'));			
		$this->updateConfig('ProtectMemNames',	postVar('ProtectMemNames'));					
		$this->updateConfig('SiteName',			postVar('SiteName'));	
		$this->updateConfig('NewMemberCanLogon',postVar('NewMemberCanLogon'));
		$this->updateConfig('DisableSite',		postVar('DisableSite'));
		$this->updateConfig('DisableSiteURL',	postVar('DisableSiteURL'));
		$this->updateConfig('LastVisit',		postVar('LastVisit'));
		$this->updateConfig('MediaURL',			postVar('MediaURL'));
		$this->updateConfig('AllowedTypes',		postVar('AllowedTypes'));
		$this->updateConfig('AllowUpload',		postVar('AllowUpload'));
		$this->updateConfig('MaxUploadSize',	postVar('MaxUploadSize'));
		$this->updateConfig('MediaPrefix',		postVar('MediaPrefix'));		
		$this->updateConfig('AllowLoginEdit',	postVar('AllowLoginEdit'));
		$this->updateConfig('DisableJsTools',	postVar('DisableJsTools'));		
		$this->updateConfig('CookieDomain',		postVar('CookieDomain'));
		$this->updateConfig('CookiePath',		postVar('CookiePath'));
		$this->updateConfig('CookieSecure',		postVar('CookieSecure'));
		$this->updateConfig('URLMode',			postVar('URLMode'));		
		
		// load new config and redirect (this way, the new language will be used is necessary)
		getConfig();
		header('Location: ' . $CONF['AdminURL'] . '?action=manage');
		exit;
	
	}
	
	
	function updateConfig($name, $val) {
		$name = addslashes($name);
		$val = trim(addslashes($val));
		
		$query = 'UPDATE '.sql_table('config')
		       . " SET value='$val'"
		       . " WHERE name='$name'";

		mysql_query($query) or die("Query error: " . mysql_error());
		return mysql_insert_id();
	}
	
	/**
	  * Error message
	  */
	function error($msg) {
		$this->pagehead();
		?>
		<h2>Error!</h2>
		<?php		echo $msg;
		echo "<br />";
		echo "<a href='index.php' onclick='history.back()'>"._BACK."</a>";
		$this->pagefoot();
		exit;
	}
	
	function disallow() {
		ACTIONLOG::add(WARNING, _ACTIONLOG_DISALLOWED . serverVar('REQUEST_URI'));
		
		$this->error(_ERROR_DISALLOWED);
	}
	
	
	function pagehead($extrahead = '') {
		global $member, $nucleus, $CONF, $manager;
		
		$manager->notify(
			'AdminPrePageHead',
			array(
				'extrahead' => &$extrahead,
				'action' => $this->action
			)
		);
		
		$baseUrl = htmlspecialchars($CONF['AdminURL']);

		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title><?php echo htmlspecialchars($CONF['SiteName'])?> - Admin</title>		
			<link rel="stylesheet" title="Nucleus Admin Default" type="text/css" href="<?php echo $baseUrl?>styles/admin.css" />
			<link rel="stylesheet" title="Nucleus Admin Default" type="text/css" 
			href="<?php echo $baseUrl?>styles/addedit.css" />
			
			<script type="text/javascript" src="<?php echo $baseUrl?>javascript/edit.js"></script>
			<script type="text/javascript" src="<?php echo $baseUrl?>javascript/admin.js"></script>
			<script type="text/javascript" src="<?php echo $baseUrl?>javascript/compatibility.js"></script>

      <meta http-equiv='Pragma' content='no-cache' />
      <meta http-equiv='Cache-Control' content='no-cache, must-revalidate' />
      <meta http-equiv='Expires' content='-1' />

			<?php echo $extrahead?>
		</head>
		<body>
		<div class="header">
		<h1><?php echo htmlspecialchars($CONF['SiteName'])?></h1>
		</div>
		<div id="container">
		<div id="content">
		<div class="loginname">
		<?php			if ($member->isLoggedIn()) 
				echo _LOGGEDINAS . ' ' . $member->getDisplayName()
				    ." - <a href='index.php?action=logout'>" . _LOGOUT. "</a>"
				    . "<br /><a href='index.php?action=overview'>" . _ADMINHOME . "</a> - ";
			else 
				echo '<a href="index.php?action=showlogin" title="Log in">' , _NOTLOGGEDIN , '</a> <br />';

			echo "<a href='".$CONF['IndexURL']."'>"._YOURSITE."</a>";
		?> 
		<br />(Nucleus <?php echo  $nucleus['version'] ?>)
		</div>
		<?php	}
	
	function pagefoot() {
		global $action, $member, $manager;
		
		$manager->notify(
			'AdminPrePageFoot',
			array(
				'action' => $this->action
			)
		);		
		
		if ($member->isLoggedIn() && ($action != 'showlogin')) {
			?>
			<h2><?php echo  _LOGOUT ?></h2>
			<ul>
				<li><a href="index.php?action=overview"><?php echo  _BACKHOME?></a></li>
				<li><a href='index.php?action=logout'><?php echo  _LOGOUT?></a></li>
			</ul>
			<?php		}
		?>
			<div class="foot">
				<a href="http://nucleuscms.org/">Nucleus</a> &copy; 2002-2004 The Nucleus Group
				-
				<a href="http://nucleuscms.org/donate.php">Donate!</a>
			</div>		
			
			</div><!-- content -->
			
			<div id="quickmenu">
	
				<?php				// ---- user settings ---- 
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
					echo '<li><a href="index.php?action=editmembersettings">',_QMENU_USER_SETTINGS,'</a></li>';
					echo '<li><a href="index.php?action=browseownitems">',_QMENU_USER_ITEMS,'</a></li>';
					echo '<li><a href="index.php?action=browseowncomments">',_QMENU_USER_COMMENTS,'</a></li>';
					echo '</ul>';




					// ---- general settings ---- 
					if ($member->isAdmin()) {

						echo '<h2>',_QMENU_MANAGE,'</h2>';

						echo '<ul>';
						echo '<li><a href="index.php?action=actionlog">',_QMENU_MANAGE_LOG,'</a></li>';		
						echo '<li><a href="index.php?action=settingsedit">',_QMENU_MANAGE_SETTINGS,'</a></li>';
						echo '<li><a href="index.php?action=usermanagement">',_QMENU_MANAGE_MEMBERS,'</a></li>';		
						echo '<li><a href="index.php?action=createnewlog">',_QMENU_MANAGE_NEWBLOG,'</a></li>';											
						echo '<li><a href="index.php?action=backupoverview">',_QMENU_MANAGE_BACKUPS,'</a></li>';			
						echo '<li><a href="index.php?action=pluginlist">',_QMENU_MANAGE_PLUGINS,'</a></li>';			
						echo '</ul>';

						echo '<h2>',_QMENU_LAYOUT,'</h2>';
						echo '<ul>';
						echo '<li><a href="index.php?action=skinoverview">',_QMENU_LAYOUT_SKINS,'</a></li>';
						echo '<li><a href="index.php?action=templateoverview">',_QMENU_LAYOUT_TEMPL,'</a></li>';
						echo '<li><a href="index.php?action=skinieoverview">',_QMENU_LAYOUT_IEXPORT,'</a></li>';		
						echo '</ul>';

					}
					
					$aPluginExtras = array();
					$manager->notify(
						'QuickMenu',
						array(
							'options' => &$aPluginExtras
						)
					);
					if (count($aPluginExtras) > 0)
					{
						echo '<h2>_QMENU_PLUGINS</h2>';
						echo '<ul>';
						foreach ($aPluginExtras as $aInfo)
						{
							echo '<li><a href="'.htmlspecialchars($aInfo['url']).'" title="'.htmlspecialchars($aInfo['tooltip']).'">'.htmlspecialchars($aInfo['title']).'</a></li>';
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
 			</div>
			
		
			</body>
			</html>
		<?php	}
	
	
	function action_regfile() {
		global $member, $CONF;
		
		$blogid = intRequestVar('blogid');
		
		$member->teamRights($blogid) or $this->disallow();
		
		// header-code stolen from phpMyAdmin
		// REGEDIT and bookmarklet code stolen from GreyMatter

		header('Content-Type: application/octetstream');
		header('Content-Disposition: filename="nucleus.reg"');
		header('Pragma: no-cache');
		header('Expires: 0');		
		
		echo "REGEDIT4\n";
		echo "[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\Post To &Nucleus (".getBlogNameFromID($blogid).")]\n";
		echo '@="' . $CONF['AdminURL'] . "bookmarklet.php?action=contextmenucode&blogid=".intval($blogid)."\"\n";
		echo '"contexts"=hex:31';		
	}
	
	function action_bookmarklet() {
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->teamRights($blogid) or $this->disallow();
		
		$blog =& $manager->getBlog($blogid);
		$bm = getBookmarklet($blogid);
		
		$this->pagehead();

		echo '<p><a href="index.php?action=overview">(',_BACKHOME,')</a></p>';
		
		?>
		
		<h2>Bookmarklet<!-- and Right Click Menu --></h2>
		
		<p>
		Bookmarklets allow adding items to your weblog with just one single click. After installing these bookmarklets, you'll be able to click the 'add to weblog' button on your browser toolbar, and a Nucleus add-item window will popup, containing the link and title of the page you were visiting, plus any text you might have selected.
		</p>
		
		<h3>Bookmarklet</h3>
		<p>
			You can drag the following link to your favorites, or your browsers toolbar: <small>(if you want to test the bookmarklet first, click the link)</small>
			<br />
			<br />
			<a href="<?php echo htmlspecialchars($bm)?>">Add to <?php echo $blog->getShortName()?></a> (Nearly all browsers)
		</p>
		
		<h3>Right Click Menu Access (IE &amp; Windows)</h3>
		<p>
			Or you can install the <a href="index.php?action=regfile&amp;blogid=<?php echo $blogid?>">right click menu item</a> (choose 'open file' and add to registry)
		</p>
		
		<p>
			You'll have to restart Internet Explorer before the option shows up in the context menus.
		</p>
		
		<h3>Uninstalling</h3>
		<p>
			For the bookmarklet, you can just delete it.
		</p>
		
		<p>
			For the right click menu item, follow the procedure listed below:
		</p>
		
		<ol>
			<li>Select "Run..." from the Start Menu</li>
			<li>Type: "regedit"</li>
			<li>Click the "OK" button</li>
			<li>Search for "\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" in the tree</li>
			<li>Delete the "add to weblog" item</li>				
		</ol>

		<?php
		$this->pagefoot();
		
	}


	function action_actionlog() {
		global $member;
		
		$member->isAdmin() or $this->disallow();
		
		$this->pagehead();
		
		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';		
		
		?>
			<h2><?php echo _ACTIONLOG_CLEAR_TITLE?></h2>
			<p><a href="index.php?action=clearactionlog"><?php echo _ACTIONLOG_CLEAR_TEXT?></a></p>
		<?php
		echo '<h2>' . _ACTIONLOG_TITLE . '</h2>';
		
		$query =  'SELECT * FROM '.sql_table('actionlog').' ORDER BY timestamp DESC';
		$template['content'] = 'actionlist';
		$amount = showlist($query,'table',$template);
		
		$this->pagefoot();

	}


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


	function action_banlistdelete() {
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');		
		$iprange = requestVar('iprange');		
		
		$member->blogAdminRights($blogid) or $this->disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		$this->pagehead();
		?>
			<h2><?php echo _BAN_REMOVE_TITLE?></h2>
			
			<form method="post" action="index.php">
			
			<h3><?php echo _BAN_IPRANGE?></h3>
			
			<p>
				<?php echo _CONFIRMTXT_BAN?> <?php echo $iprange?>
				<input name="iprange" type="hidden" value="<?php echo htmlspecialchars($iprange)?>" />
			</p>
			
			<h3><?php echo _BAN_BLOGS?></h3>
			
			<div>
				<input type="hidden" name="blogid" value="<?php echo $blogid?>" />
				<input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">Only blog '<?php echo htmlspecialchars($blog->getName())?>'</label>
				<br />
				<input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS?></label>
			</div>
			
			<h3><?php echo _BAN_DELETE_TITLE?></h3>
			
			<div>
				<input type="hidden" name="action" value="banlistdeleteconfirm" />
				<input type="submit" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div>
			
			</form>
		<?php		
		$this->pagefoot();
	}

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
			echo "<li>" . htmlspecialchars($b->getName()). "</li>";
		}
		echo "</ul>";
		
		$this->pagefoot();

	}
	
	function action_banlistnewfromitem() {
		$this->action_banlistnew(getBlogIDFromItemID(intRequestVar('itemid')));
	}
	
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
		<b>An example</b>: "134.58.253.193" will only block one computer, while "134.58.253" will block 256 IP addresses, including the one from the first example.
		</div>
		
		<div>
		<?php			if ($ip) { 
		?>
			<input name="iprange" type="radio" value="<?php echo htmlspecialchars($ip)?>" checked="checked" id="ip_fixed" /><label for="ip_fixed"><?php echo htmlspecialchars($ip)?></label>
			<br />
			<input name="iprange" type="radio" value="custom" id="ip_custom" /><label for="ip_custom">Custom: </label><input name='customiprange' value='<?php echo htmlspecialchars($ip)?>' maxlength='15' size='15' />
		<?php	} else {
				echo "<input name='iprange' value='custom' type='hidden' />";
				echo "<input name='customiprange' value='' maxlength='15' size='15' />";
			}
		?>
		</div>
		
		<h3><?php echo _BAN_BLOGS?></h3>

		<p><?php echo _BAN_BLOGS_TEXT?></p>

		<div>		
			<input type="hidden" name="blogid" value="<?php echo $blogid?>" />
			<input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">'<?php echo htmlspecialchars($blog->getName())?>'</label>
			<br />
			<input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all"><?php echo _BAN_ALLBLOGS?></label>
		</div>
		
		<h3><?php echo _BAN_REASON_TITLE?></h3>

		<p><?php echo _BAN_REASON_TEXT?></p>
		
		<div><textarea name="reason" cols="40" rows="5"></textarea></div>

		<h3><?php echo _BAN_ADD_TITLE?></h3>
		
		<div>
			<input name="action" type="hidden" value="banlistadd" />
			<input type="submit" value="<?php echo _BAN_ADD_BTN?>" />
		</div>
		
		</form>
		
		<?php		$this->pagefoot();
	}
	
	function action_banlistadd() {
		global $member;
		
		$blogid = 		intPostVar('blogid');
		$allblogs = 	postVar('allblogs');
		$iprange = 		postVar('iprange');
		if ($iprange == "custom")
			$iprange = postVar('customiprange');
		$reason = 		postVar('reason');
		
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
	
	function action_clearactionlog() {
		global $member;
		
		$member->isAdmin() or $this->disallow();
		
		ACTIONLOG::clear();
		
		$this->action_manage(_MSG_ACTIONLOGCLEARED);
	}
	
	function action_backupoverview() {
		global $member;
		
		$member->isAdmin() or $this->disallow();
		
		$this->pagehead();

		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';				
		?>
		<h2><?php echo _BACKUPS_TITLE?></h2>
		
		<h3><?php echo _BACKUP_TITLE?></h3>
		
		<p><?php echo _BACKUP_INTRO?></p>
		
		<form method="post" action="index.php"><p>
		<input type="hidden" name="action" value="backupcreate" />

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
			<input name="backup_file" type="file" tabindex="30" />
			<br /><br />
			<input type="submit" value="<?php echo _RESTORE_BTN?>" tabindex="40" />		
			<br /><input type="checkbox" name="letsgo" value="1" id="letsgo" tabindex="50" /><label for="letsgo"><?php echo _RESTORE_IMSURE?></label>
			<br /><?php echo _RESTORE_WARNING?>
		</p></form>

		<?php		$this->pagefoot();
	}

	function action_backupcreate() {
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or $this->disallow();

		// use compression ?
		$useGzip = intval(postVar('gzip'));
		
		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit 
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		do_backup($useGzip);
		exit;
	}


	function action_backuprestore() {
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or $this->disallow();
		
		if (intPostVar('letsgo') != 1)
			$this->error(_ERROR_BACKUP_NOTSURE);

		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit 
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		$message = do_restore();
		if ($message != '')
			$this->error($message);
			
		$this->pagehead();
		?>
		<h2><?php echo _RESTORE_COMPLETE?></h2>
		<?php		$this->pagefoot();

	}
	

	function action_pluginlist() {
		global $member;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
	
		$this->pagehead();
		
		echo '<p><a href="index.php?action=manage">(',_BACKTOMANAGE,')</a></p>';		
		
		echo '<h2>' , _PLUGS_TITLE_MANAGE , ' ', help('plugins'), '</h2>';
		
		echo '<h3>' , _PLUGS_TITLE_INSTALLED , '</h3>';
		
		
		$query =  'SELECT * FROM '.sql_table('plugin').' ORDER BY porder ASC';

		$template['content'] = 'pluginlist';
		$template['tabindex'] = 10;
		showlist($query, 'table', $template);
	
		?>
			<h3><?php echo _PLUGS_TITLE_UPDATE?></h3>
			
			<p><?php echo _PLUGS_TEXT_UPDATE?></p>
			
			<form method="post" action="index.php"><div>
				<input type="hidden" name="action" value="pluginupdate" />
				<input type="submit" value="<?php echo _PLUGS_BTN_UPDATE ?>" tabindex="20" />
			</div></form>
			
			<h3><?php echo _PLUGS_TITLE_NEW?></h3>

			<?php				// find a list of possibly non-installed plugins
				$candidates = array();
				global $DIR_PLUGINS;
				$dirhandle = opendir($DIR_PLUGINS);
				while ($filename = readdir($dirhandle)) {
					if (ereg('^NP_(.*)\.php$',$filename,$matches)) {
						$name = $matches[1];
						// only show in list when not yet installed
						if (mysql_num_rows(sql_query('SELECT * FROM '.sql_table('plugin').' WHERE pfile="NP_'.addslashes($name).'"')) == 0)
							array_push($candidates,$name);
					}
				}
				closedir($dirhandle);
				
				if (sizeof($candidates) > 0) {
			?>

			<p><?php echo _PLUGS_ADD_TEXT?></p>
			

			<form method='post' action='index.php'><div>
				<input type='hidden' name='action' value='pluginadd' />
				<select name="filename" tabindex="30">
				<?php					foreach($candidates as $name)
						echo '<option value="NP_',$name,'">',htmlspecialchars($name),'</option>';
				?>
				</select>
				<input type='submit' tabindex="40" value='<?php echo _PLUGS_BTN_INSTALL?>' />
			</div></form>

		<?php			} else {	// sizeof(candidates) == 0
				echo '<p>',_PLUGS_NOCANDIDATES,'</p>';
			}
		
		$this->pagefoot();
	}
	
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
		
		echo '<h2>',_PLUGS_HELP_TITLE,': ',htmlspecialchars($plugName),'</h2>';
		
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
	
	
	function action_pluginadd() {
		global $member, $manager, $DIR_PLUGINS;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$name = postVar('filename');
		
		if ($manager->pluginInstalled($name))
			$this->error(_ERROR_DUPPLUGIN);
		if (!checkPlugin($name))
			$this->error(_ERROR_PLUGFILEERROR . ' (' . $name . ')');
		
		// get number of currently installed plugins
		$numCurrent = mysql_num_rows(sql_query('SELECT * FROM '.sql_table('plugin')));

		// plugin will be added as last one in the list
		$newOrder = $numCurrent + 1;
		
		$manager->notify(
			'PreAddPlugin',
			array(
				'file' => &$name
			)
		);
		
		// do this before calling getPlugin (in case the plugin id is used there)
		$query = 'INSERT INTO '.sql_table('plugin').' (porder, pfile) VALUES ('.$newOrder.',"'.addslashes($name).'")';
		sql_query($query);
		$iPid = mysql_insert_id();

		$manager->clearCachedInfo('installedPlugins');

		// call the install method of the plugin
		$plugin =& $manager->getPlugin($name);
		
		if (!$plugin)
		{
			sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE pid='. intval($iPid));
			$manager->clearCachedInfo('installedPlugins');
			$this->error('Plugin could not be loaded, or does not support certain features that are required for it to run on your Nucleus installation (you might want to check the <a href="?action=actionlog">actionlog</a> for more info)');
		}
		
		// check if plugin needs a newer Nucleus version
		if (getNucleusVersion() < $plugin->getMinNucleusVersion())
		{
			// uninstall plugin again...
			$this->deleteOnePlugin($plugin->getID());
			
			// ...and show error
			$this->error(_ERROR_NUCLEUSVERSIONREQ . $plugin->getMinNucleusVersion());
		}
		
		// check if plugin needs a newer Nucleus version
		if ((getNucleusVersion() == $plugin->getMinNucleusVersion()) && (getNucleusPatchLevel() < $plugin->getMinNucleusPatchLevel()))
		{
			// uninstall plugin again...
			$this->deleteOnePlugin($plugin->getID());
			
			// ...and show error
			$this->error(_ERROR_NUCLEUSVERSIONREQ . $plugin->getMinNucleusVersion() . ' patch ' . $plugin->getMinNucleusPatchLevel());
		}
		
		$plugin->install();
		
		$manager->notify(
			'PostAddPlugin',
			array(
				'plugin' => &$plugin
			)
		);		
		
		// update all events
		$this->action_pluginupdate();
	}
	
	function action_pluginupdate() {
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		// delete everything from plugin_events
		sql_query('DELETE FROM '.sql_table('plugin_event'));
		
		// loop over all installed plugins
		$res = sql_query('SELECT pid, pfile FROM '.sql_table('plugin'));
		while($o = mysql_fetch_object($res)) {
			$pid = $o->pid;
			$plug =& $manager->getPlugin($o->pfile);
			if ($plug)
			{
				$eventList = $plug->getEventList();
				foreach ($eventList as $eventName) 
					sql_query('INSERT INTO '.sql_table('plugin_event').' (pid, event) VALUES ('.$pid.', \''.addslashes($eventName).'\')');
			}
		}
		
		$this->action_pluginlist();
	}
	
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
			<input type="hidden" name="action" value="plugindeleteconfirm" />
			<input type="hidden" name="plugid" value="<?php echo $pid; ?>" />
			<input type="submit" tabindex="10" value="<?php echo _DELETE_CONFIRM_BTN?>" />
			</div></form>
		<?php		$this->pagefoot();
	}
	
	function action_plugindeleteconfirm() {
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$pid = intPostVar('plugid');
		
		$error = $this->deleteOnePlugin($pid, 1);
		if ($error) {
			$this->error($error);
		}

		$this->action_pluginlist();
	}
	
	function deleteOnePlugin($pid, $callUninstall = 0) {
		global $manager;
		
		$pid = intval($pid);
		
		if (!$manager->pidInstalled($pid))
			return _ERROR_NOSUCHPLUGIN;
			
		// call the unInstall method of the plugin
		if ($callUninstall) {
			$name = quickQuery('SELECT pfile as result FROM '.sql_table('plugin').' WHERE pid='.$pid);
			$plugin =& $manager->getPlugin($name);
			if ($plugin) $plugin->unInstall();
		}

		$manager->notify('PreDeletePlugin', array('plugid' => $pid));	
		
		// delete all subscriptions
		sql_query('DELETE FROM '.sql_table('plugin_event').' WHERE pid=' . $pid);
		
		// delete all options
		// get OIDs from plugin_option_desc
		$res = sql_query('SELECT oid FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
		$aOIDs = array();
		while ($o = mysql_fetch_object($res)) {
			array_push($aOIDs, $o->oid);
		}
		
		// delete from plugin_option and plugin_option_desc
		sql_query('DELETE FROM '.sql_table('plugin_option_desc').' WHERE opid=' . $pid);
		if (count($aOIDs) > 0)
			sql_query('DELETE FROM '.sql_table('plugin_option').' WHERE oid in ('.implode(',',$aOIDs).')');		
		
		// update order numbers
		$o = mysql_fetch_object(sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid=' . $pid));
		sql_query('UPDATE '.sql_table('plugin').' SET porder=(porder - 1) WHERE porder>'.$o->porder);
		
		// delete row
		sql_query('DELETE FROM '.sql_table('plugin').' WHERE pid='.$pid);
		
		$manager->clearCachedInfo('installedPlugins');
		$manager->notify('PostDeletePlugin', array('plugid' => $pid));			
		
		return '';
	}
	
	function action_pluginup() {
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$plugid = intGetVar('plugid');

		if (!$manager->pidInstalled($plugid))
			$this->error(_ERROR_NOSUCHPLUGIN);
			
		// 1. get old order number
		$o = mysql_fetch_object(sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid));
		$oldOrder = $o->porder;
				
		// 2. calculate new order number
		$newOrder = ($oldOrder > 1) ? ($oldOrder - 1) : 1;
		
		// 3. update plug numbers
		sql_query('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);		
		sql_query('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);		
		
		$this->action_pluginlist();
	}

	function action_plugindown() {
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$plugid = intGetVar('plugid');
		if (!$manager->pidInstalled($plugid))
			$this->error(_ERROR_NOSUCHPLUGIN);
			
		// 1. get old order number
		$o = mysql_fetch_object(sql_query('SELECT porder FROM '.sql_table('plugin').' WHERE pid='.$plugid));
		$oldOrder = $o->porder;
		
		$maxOrder = mysql_num_rows(sql_query('SELECT * FROM '.sql_table('plugin')));
				
		// 2. calculate new order number
		$newOrder = ($oldOrder < $maxOrder) ? ($oldOrder + 1) : $maxOrder;
		
		// 3. update plug numbers
		sql_query('UPDATE '.sql_table('plugin').' SET porder='.$oldOrder.' WHERE porder='.$newOrder);		
		sql_query('UPDATE '.sql_table('plugin').' SET porder='.$newOrder.' WHERE pid='.$plugid);		
		
		$this->action_pluginlist();
	}
	
	function action_pluginoptions($message = '') {
		global $member, $manager;

		// check if allowed
		$member->isAdmin() or $this->disallow();
		
		$pid = intRequestVar('plugid');
		if (!$manager->pidInstalled($pid))
			$this->error(_ERROR_NOSUCHPLUGIN);

		$extrahead = '<script type="text/javascript" src="javascript/numbercheck.js"></script>';
		$this->pagehead($extrahead);

		?>
			<p><a href="index.php?action=pluginlist">(<?php echo _PLUGS_BACK?>)</a></p>
			
			<h2>Options for <?php echo htmlspecialchars(getPluginNameFromPid($pid))?></h2>

			<?php if  ($message) echo $message?>

			<form action="index.php" method="post">
			<div>
				<input type="hidden" name="action" value="pluginoptionsupdate" />
				<input type="hidden" name="plugid" value="<?php echo $pid?>" />				
		<?php		

		$aOptions = array(); 
		$aOIDs = array();
		$query = 'SELECT * FROM ' . sql_table('plugin_option_desc') . ' WHERE ocontext=\'global\' and opid=' . $pid . ' ORDER BY oid ASC';
		$r = sql_query($query);
		while ($o = mysql_fetch_object($r)) {
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
			while ($o = mysql_fetch_object($r)) 
				$aOptions[$o->oid]['value'] = $o->ovalue;
		}
		
		// call plugins
		$manager->notify('PrePluginOptionsEdit',array('context' => 'global', 'plugid' => $pid, 'options'=>&$aOptions));
		
		$template['content'] = 'plugoptionlist';
		$amount = showlist($aOptions,'table',$template);
		if ($amount == 0)
			echo '<p>',_ERROR_NOPLUGOPTIONS,'</p>';
		
		?>
			</div>
			</form>
		<?php		$this->pagefoot();
		
		
		
	}
	
	function action_pluginoptionsupdate() {
		global $member, $manager;

		// check if allowed
		$member->isAdmin() or $this->disallow();

		$pid = intRequestVar('plugid');
		if (!$manager->pidInstalled($pid))
			$this->error(_ERROR_NOSUCHPLUGIN);
			
		$aOptions = requestArray('plugoption');
		NucleusPlugin::_applyPluginOptions($aOptions);

		$manager->notify('PostPluginOptionsUpdate',array('context' => 'global', 'plugid' => $pid));		
		
		$this->action_pluginoptions(_PLUGS_OPTIONS_UPDATED);
	}
	
	/**
	  * @static
	  */
	function _insertPluginOptions($context, $contextid = 0) {
		// get all current values for this contextid 
		// (note: this might contain doubles for overlapping contextids)
		$aIdToValue = array();
		$res = sql_query('SELECT oid, ovalue FROM ' . sql_table('plugin_option') . ' WHERE ocontextid=' . intval($contextid));
		while ($o = mysql_fetch_object($res)) {
			$aIdToValue[$o->oid] = $o->ovalue;
		}
		
		// get list of oids per pid
		$query = 'SELECT * FROM ' . sql_table('plugin_option_desc') . ',' . sql_table('plugin')
			   . ' WHERE opid=pid and ocontext=\''.addslashes($context).'\' ORDER BY porder, oid ASC';
		$res = sql_query($query);
		$aOptions = array();
		while ($o = mysql_fetch_object($res)) {
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
		$manager->notify('PrePluginOptionsEdit',array('context' => $context, 'contextid' => $contextid, 'options'=>&$aOptions));
	
		
		$iPrevPid = -1;
		foreach ($aOptions as $aOption) {

			// new plugin?
			if ($iPrevPid != $aOption['pid']) {
				$iPrevPid = $aOption['pid'];

				echo '<tr><th colspan="2">Options for ', htmlspecialchars($aOption['pfile']),'</th></tr>';
			}
				
			echo '<tr>';
			listplug_plugOptionRow($aOption);
			echo '</tr>';
	
		}

	
	}
	
	/* helper functions to create option forms etc. */
	function input_yesno($name, $checkedval,$tabindex = 0, $value1 = 1, $value2 = 0, $yesval = _YES, $noval = _NO) {
		$id = htmlspecialchars($name);
		$id = str_replace('[','-',$id);
		$id = str_replace(']','-',$id);		
		$id1 = $id . htmlspecialchars($value1);
		$id2 = $id . htmlspecialchars($value2);
		
		echo '<input type="radio" name="', htmlspecialchars($name),'" value="', htmlspecialchars($value1),'" ';
			if ($checkedval == $value1)
				echo "tabindex='$tabindex' checked='checked'";
			echo ' id="'.$id1.'" /><label for="'.$id1.'">' . $yesval . '</label>';
		echo ' ';
		echo '<input type="radio" name="', htmlspecialchars($name),'" value="', htmlspecialchars($value2),'" ';
			if ($checkedval != $value1)
				echo "tabindex='$tabindex' checked='checked'";				
			echo ' id="'.$id2.'" /><label for="'.$id2.'">' . $noval . '</label>';
	}


	
} // class ADMIN

class ENCAPSULATE {
	/** 
	  * Uses $call to call a function using parameters $params
	  * This function should return the amount of entries shown.
	  * When entries are show, batch operation handlers are shown too.
	  * When no entries were shown, $errormsg is used to display an error
	  *
	  * Passes on the amount of results found (for further encapsulation)
	  */
	function doEncapsulate($call, $params, $errorMessage = 'No entries') {
		// start output buffering
		ob_start();

		$nbOfRows = call_user_func_array($call, $params);

		// get list contents and stop buffering
		$list = ob_get_contents();
		ob_end_clean();
		
		if ($nbOfRows > 0) {
			$this->showHead();
			echo $list;
			$this->showFoot();
		} else {
			echo $errorMessage;
		}

		return $nbOfRows;
	}
}


/**
  * A class used to encapsulate a list of some sort inside next/prev buttons
  */
class NAVLIST extends ENCAPSULATE {

	function NAVLIST($action, $start, $amount, $minamount, $maxamount, $blogid, $search, $itemid) {
		$this->action = $action;
		$this->start = $start;
		$this->amount = $amount;
		$this->minamount = $minamount;
		$this->maxamount = $maxamount;
		$this->blogid = $blogid;
		$this->search = $search;
		$this->itemid = $itemid;
	}
	
	function showBatchList($batchtype, $query, $type, $template, $errorMessage = _LISTS_NOMORE) {
		$batch = new BATCH($batchtype);

		$this->doEncapsulate(
				array(&$batch, 'showlist'),
				array(&$query, $type, $template),
				$errorMessage
		);
	
	}

	
	function showHead() {
		$this->showNavigation();
	}
	function showFoot() {
		$this->showNavigation();
	}
	
	/**
	  * Displays a next/prev bar for long tables
	  */
	function showNavigation() {
		$action = $this->action;
		$start = $this->start;
		$amount = $this->amount;
		$minamount = $this->minamount;
		$maxamount = $this->maxamount;
		$blogid = $this->blogid;
		$search = $this->search;
		$itemid = $this->itemid;
		
		$prev = $start - $amount;
		if ($prev < $minamount) $prev=$minamount;

		// maxamount not used yet
	//	if ($start + $amount <= $maxamount)
			$next = $start + $amount;
	//	else
	//		$next = $start;

	?>
	<table class="navigation">
	<tr><td>
		<form method="post" action="index.php"><div>
		<input type="submit" value="&lt;&lt; <?php echo  _LISTS_PREV?>" />	
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />	
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="hidden" name="start" value="<?php echo  $prev; ?>" />
		</div></form>
	</td><td>
		<form method="post" action="index.php"><div>
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />		
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input name="amount" size="3" value="<?php echo  $amount; ?>" /> <?php echo _LISTS_PERPAGE?> 
		<input type="hidden" name="start" value="<?php echo  $start; ?>" />
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="submit" value="&gt; <?php echo _LISTS_CHANGE?>" />	
		</div></form>
	</td><td>	
		<form method="post" action="index.php"><div>
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />		
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="start" value="0" />
		<input type="text" name="search" value="<?php echo  $search; ?>" size="7" />
		<input type="submit" value="&gt; <?php echo  _LISTS_SEARCH?>" />	
		</div></form>
	</td><td>	
		<form method="post" action="index.php"><div>
		<input type="submit" value="<?php echo _LISTS_NEXT?> &gt; &gt;" />	
		<input type="hidden" name="search" value="<?php echo  $search; ?>" />
		<input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />		
		<input type="hidden" name="action" value="<?php echo  $action; ?>" />
		<input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
		<input type="hidden" name="start" value="<?php echo  $next; ?>" />
		</div></form>	
	</td></tr>
	</table>
	<?php	}


}

/**
 * A class used to encapsulate a list of some sort in a batch selection 
 */
class BATCH extends ENCAPSULATE {
	function BATCH($type) {
		$this->type = $type;
	}
	
	function showHead() {
		?>
			<form method="post" action="index.php">
		<?php
// TODO: get a list op operations above the list too 
// (be careful not to use the same names for the select...)
//		$this->showOperationList();		
	}

	function showFoot() {
		$this->showOperationList();
		?>
			</form>
		<?php	}

	function showOperationList() {
		?>
		<div class="batchoperations">
			<?php echo _BATCH_WITH_SEL ?>
			<select name="batchaction">
			<?php				$options = array();
				switch($this->type) {
					case 'item':
						$options = array(
							'delete'	=> _BATCH_ITEM_DELETE,
							'move'		=> _BATCH_ITEM_MOVE
						);
						break;
					case 'member': 
						$options = array(
							'delete'	=> _BATCH_MEMBER_DELETE,
							'setadmin'	=> _BATCH_MEMBER_SET_ADM,
							'unsetadmin' => _BATCH_MEMBER_UNSET_ADM
						);
						break;
					case 'team':
						$options = array(
							'delete' 	=> _BATCH_TEAM_DELETE,
							'setadmin'	=> _BATCH_TEAM_SET_ADM,
							'unsetadmin' => _BATCH_TEAM_UNSET_ADM,
						);
						break;
					case 'category':
						$options = array(
							'delete'	=> _BATCH_CAT_DELETE,
							'move'		=> _BATCH_CAT_MOVE,
						);
						break;
					case 'comment':
						$options = array(
							'delete'	=> _BATCH_COMMENT_DELETE,
						);
					break;
				}
				foreach ($options as $option => $label) {
					echo '<option value="',$option,'">',$label,'</option>';
				}
			?>
			</select>
			<input type="hidden" name="action" value="batch<?php echo $this->type?>" />
			<?php				// add hidden fields for 'team' and 'comment' batchlists
				if ($this->type == 'team') 
				{
					echo '<input type="hidden" name="blogid" value="',intRequestVar('blogid'),'" />';
				}
				if ($this->type == 'comment') 
				{
					echo '<input type="hidden" name="itemid" value="',intRequestVar('itemid'),'" />';
				}
				
				echo '<input type="submit" value="',_BATCH_EXEC,'" />';
			?>(
			 <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(1); "><?php echo _BATCH_SELECTALL?></a> -
			 <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(0); "><?php echo _BATCH_DESELECTALL?></a>
			)
		</div>
		<?php	}
	
	// shortcut :)
	function showList($query, $type, $template, $errorMessage = _LISTS_NOMORE) {
		return $this->doEncapsulate(	'showlist',
									array($query, $type, $template),
									$errorMessage
								);
	}

}



// can take either an array of objects, or an SQL query
function showlist($query, $type, $template) {

	if (is_array($query)) {
		if (sizeof($query) == 0)
			return 0;

		call_user_func('listplug_' . $type, $template, 'HEAD');

		foreach ($query as $currentObj) {
			$template['current'] = $currentObj;
			call_user_func('listplug_' . $type, $template, 'BODY');
		}
		
		call_user_func('listplug_' . $type, $template, 'FOOT');
		
		return sizeof($query);
			
	} else {
		$res = sql_query($query);

		// don't do anything if there are no results
		$numrows = mysql_num_rows($res);
		if ($numrows == 0)
			return 0;

		call_user_func('listplug_' . $type, $template, 'HEAD');

		while($template['current'] = mysql_fetch_object($res)) 
			call_user_func('listplug_' . $type, $template, 'BODY');

		call_user_func('listplug_' . $type, $template, 'FOOT');

		mysql_free_result($res);

		// return amount of results
		return $numrows;
	}
}

function listplug_select($template, $type) {
	switch($type) {
		case 'HEAD':
			echo '<select name="'.$template['name'].'" tabindex="'.$template['tabindex'].'" '.$template['javascript'].'>';
			
			// add extra row if needed
			if ($template['extra']) {
				echo '<option value="',$template['extraval'],'">',$template['extra'],'</option>';
			}
			
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<option value="' . htmlspecialchars($current->value) . '"';
			if ($template['selected'] == $current->value)
				echo ' selected="selected" ';
			if ($template['shorten'] > 0) {
				echo ' title="'. htmlspecialchars($current->text).'"';
				$current->text = shorten($current->text, $template['shorten'], $template['shortenel']);
			}
			echo '>' . htmlspecialchars($current->text) . '</option>';
			break;
		case 'FOOT':
			echo '</select>';
			break;
	}
}

function listplug_table($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<table>";
			echo "<thead><tr>";
			// print head
			call_user_func("listplug_table_" . $template['content'] , $template, 'HEAD');
			echo "</tr></thead><tbody>";
			break;
		case 'BODY':
			// print tabletype specific thingies
			echo "<tr onmouseover='focusRow(this);' onmouseout='blurRow(this);'>";
			call_user_func("listplug_table_" . $template['content'] , $template,  'BODY');
			echo "</tr>";
			break;
		case 'FOOT':
			call_user_func("listplug_table_" . $template['content'] , $template,  'FOOT');		
			echo "</tbody></table>";
			break;
	}
}

function listplug_table_memberlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo '<th>' . _LIST_MEMBER_NAME . '</th><th>' . _LIST_MEMBER_RNAME . '</th><th>' . _LIST_MEMBER_URL . '</th><th>' . _LIST_MEMBER_ADMIN;
			help('superadmin'); 
			echo "</th><th>" . _LIST_MEMBER_LOGIN;
			help('canlogin');
			echo "</th><th colspan='2'>" . _LISTS_ACTIONS. "</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo '<td>';
			$id = listplug_nextBatchId();			
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->mnumber,'" />';
			echo '<label for="batch',$id,'">';
			echo "<a href='mailto:$current->memail' tabindex='".$template['tabindex']."'>$current->mname</a>";
			echo '</label>';
			echo '</td>';
			echo "<td>$current->mrealname</td>";
			echo "<td><a href='$current->murl' tabindex='".$template['tabindex']."'>$current->murl</a></td>";
			echo "<td>$current->madmin</td>";
			echo "<td>$current->mcanlogin</td>";
			echo "<td><a href='index.php?action=memberedit&amp;memberid=$current->mnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=memberdelete&amp;memberid=$current->mnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";			
			break;
	}
}

function listplug_table_teamlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LIST_MEMBER_NAME."</th><th>"._LIST_MEMBER_RNAME."</th><th>"._LIST_TEAM_ADMIN;
			help('teamadmin');
			echo "</th><th colspan='2'>"._LISTS_ACTIONS."</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
		
			echo '<td>';
			$id = listplug_nextBatchId();			
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->tmember,'" />';
			echo '<label for="batch',$id,'">';
			echo "<a href='mailto:$current->memail' tabindex='".$template['tabindex']."'>$current->mname</a>";
			echo '</label>';
			echo '</td>';
			echo "<td>$current->mrealname</td>";
			echo "<td>$current->tadmin</td>";
			echo "<td><a href='index.php?action=teamdelete&amp;memberid=$current->tmember&amp;blogid=$current->tblog' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";
			echo "<td><a href='index.php?action=teamchangeadmin&amp;memberid=$current->tmember&amp;blogid=$current->tblog' tabindex='".$template['tabindex']."'>"._LIST_TEAM_CHADMIN."</a></td>";			
			break;
	}
}
function encode_desc(&$data)
    {   $to_entities = get_html_translation_table(HTML_ENTITIES);
        $from_entities = array_flip($to_entities);
        $data = strtr($data,$from_entities);
        $data = strtr($data,$to_entities);
        return $data;
    }
function listplug_table_pluginlist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD';
			echo '<th>'._LISTS_INFO.'</th><th>'._LISTS_DESC.'</th>';
			echo '<th>'._LISTS_ACTIONS.'</th>';
			break;
		case 'BODY';
			$current = $template['current'];
			
			$plug =& $manager->getPlugin($current->pfile);
			if ($plug) {
				echo '<td>';
					echo '<strong>' , $plug->getName() , '</strong><br />';
					echo _LIST_PLUGS_AUTHOR, ' ' , $plug->getAuthor() , '<br />';
					echo _LIST_PLUGS_VER, ' ' , $plug->getVersion() , '<br />';
					if ($plug->getURL())
					echo '<a href="',$plug->getURL(),'" tabindex="'.$template['tabindex'].'">',_LIST_PLUGS_SITE,'</a><br />';
				echo '</td>';
				echo '<td>';
					echo _LIST_PLUGS_DESC .'<br/>'. encode_desc($plug->getDescription());
					if (sizeof($plug->getEventList()) > 0)
						echo '<br /><br />',_LIST_PLUGS_SUBS,'<br />',implode($plug->getEventList(),', ');
				echo '</td>';
			} else {
				echo '<td colspan="2">Error: plugin file <b>',$current->pfile,'.php</b> could not be loaded, or it has been set inactive because it does not support some features (check the <a href="?action=actionlog">actionlog</a> for more info)</td>';
			}
			echo '<td>';
				echo "<a href='index.php?action=pluginup&amp;plugid=$current->pid' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_UP,"</a>";
				echo "<br /><a href='index.php?action=plugindown&amp;plugid=$current->pid' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_DOWN,"</a>";
				echo "<br /><a href='index.php?action=plugindelete&amp;plugid=$current->pid' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_UNINSTALL,"</a>";
				if ($plug && ($plug->hasAdminArea() > 0))
					echo "<br /><a href='".htmlspecialchars($plug->getAdminURL())."'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_ADMIN,"</a>";
				if ($plug && ($plug->supportsFeature('HelpPage') > 0))
					echo "<br /><a href='index.php?action=pluginhelp&amp;plugid=$current->pid'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_HELP,"</a>";
				if (quickQuery('SELECT COUNT(*) AS result FROM '.sql_table('plugin_option_desc').' WHERE ocontext=\'global\' and opid='.$current->pid) > 0)
					echo "<br /><a href='index.php?action=pluginoptions&amp;plugid=$current->pid'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_OPTIONS,"</a>";
			echo '</td>';
			break;
	}
}

function listplug_table_plugoptionlist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD';
			echo '<th>'._LISTS_INFO.'</th><th>'._LISTS_VALUE.'</th>';
			break;
		case 'BODY';
			$current = $template['current'];
			listplug_plugOptionRow($current);
			break;
		case 'FOOT':
			?>
			<tr>
				<th colspan="2"><?php echo _PLUGS_SAVE?></th>
			</tr><tr>
				<td><?php echo _PLUGS_SAVE?></td>
				<td><input type="submit" value="<?php echo _PLUGS_SAVE?>" /></td>
			</tr>
			<?php			break;
	}
}

function listplug_plugOptionRow($current) {
	$varname = 'plugoption['.$current['oid'].']['.$current['contextid'].']';

	echo '<td>',htmlspecialchars($current['description']?$current['description']:$current['name']),'</td>';
	echo '<td>';
	switch($current['type']) {
		case 'yesno':
			ADMIN::input_yesno($varname, $current['value'], 0, 'yes', 'no');
			break;
		case 'password':
			echo '<input type="password" size="40" maxlength="128" name="',htmlspecialchars($varname),'" value="',htmlspecialchars($current['value']),'" />';
			break;
		case 'select':
			echo '<select name="'.htmlspecialchars($varname).'">';
			$aOptions = NucleusPlugin::getOptionSelectValues($current['typeinfo']);
			$aOptions = explode('|', $aOptions);
			for ($i=0; $i<(count($aOptions)-1); $i+=2) {
				echo '<option value="'.htmlspecialchars($aOptions[$i+1]).'"';
				if ($aOptions[$i+1] == $current['value'])
					echo ' selected="selected"';
				echo '>'.htmlspecialchars($aOptions[$i]).'</option>';
			}
			echo '</select>';
			break;
		case 'textarea':
			$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
			echo '<textarea class="pluginoption" cols="30" rows="5" name="',htmlspecialchars($varname),'"';				
			if ($meta['access'] == 'readonly') {
				echo ' readonly="readonly"';
			}
			echo '>',htmlspecialchars($current['value']),'</textarea>';
			break;
		case 'text':
		default:
			$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
			echo '<input type="text" size="40" maxlength="128" name="',htmlspecialchars($varname),'" value="',htmlspecialchars($current['value']),'"';
			if ($meta['numerical'] == 'true') {
				echo ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
			}
			if ($meta['access'] == 'readonly') {
				echo ' readonly="readonly"';
			}
			echo ' />';
	}
	echo $current['extra'];
	echo '</td>';
}

function listplug_table_itemlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LIST_ITEM_INFO."</th><th>"._LIST_ITEM_CONTENT."</th><th colspan='1'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY';
			$current = $template['current'];
			$current->itime = strtotime($current->itime);	// string -> unix timestamp
			
			if ($current->idraft == 1) 
				$cssclass = "class='draft'";

			// (can't use offset time since offsets might vary between blogs)
			if ($current->itime > $template['now'])
				$cssclass = "class='future'";
			
			echo "<td $cssclass>",_LIST_ITEM_BLOG," $current->bshortname";
			echo "    <br />",_LIST_ITEM_CAT," $current->cname";			
			echo "    <br />",_LIST_ITEM_AUTHOR," $current->mname";
			echo "    <br />",_LIST_ITEM_DATE," " . date("Y-m-d",$current->itime);
			echo "<br />",_LIST_ITEM_TIME," " . date("H:i",$current->itime);
			echo "</td>";			
			echo "<td $cssclass>";
			
			$id = listplug_nextBatchId(); 
			
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->inumber,'" />';
			echo '<label for="batch',$id,'">';
			echo "<b>" . htmlspecialchars(strip_tags($current->ititle)) . "</b>";
			echo '</label>';
			echo "<br />";
			
			
			$current->ibody = strip_tags($current->ibody);
			$current->ibody = htmlspecialchars(shorten($current->ibody,300,'...'));
			
			echo "$current->ibody</td>";
			echo "<td $cssclass>";
			echo 	"<a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"._LISTS_EDIT."</a>";
			echo    "<br /><a href='index.php?action=itemcommentlist&amp;itemid=$current->inumber'>"._LISTS_COMMENTS."</a>";
			echo    "<br /><a href='index.php?action=itemmove&amp;itemid=$current->inumber'>"._LISTS_MOVE."</a>";			
			echo    "<br /><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"._LISTS_DELETE."</a>";			
			echo "</td>";
			break;
	}
}

// for batch operations: generates the index numbers for checkboxes
function listplug_nextBatchId() {
	static $id = 0;
	return $id++;
}

function listplug_table_commentlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LISTS_INFO."</th><th>"._LIST_COMMENT."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY';
			$current = $template['current'];
			$current->ctime = strtotime($current->ctime);	// string -> unix timestamp
			
			echo '<td>';
			echo date("Y-m-d@H:i",$current->ctime);
			echo '<br />';
			if ($current->mname)
				echo "$current->mname ", _LIST_COMMENT_MEMBER;
			else
				echo $current->cuser;
			echo '</td>';
			
			
			$current->cbody = strip_tags($current->cbody);
			$current->cbody = htmlspecialchars(shorten($current->cbody, 300, '...'));

			echo '<td>';
			$id = listplug_nextBatchId();			
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->cnumber,'" />';
			echo '<label for="batch',$id,'">';
			echo $current->cbody;
			echo '</label>';
			echo '</td>';
			
			echo "<td><a href='index.php?action=commentedit&amp;commentid=$current->cnumber'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=commentdelete&amp;commentid=$current->cnumber'>"._LISTS_DELETE."</a></td>";
			if ($template['canAddBan'])
				echo "<td><a href='index.php?action=banlistnewfromitem&amp;itemid=$current->citem&amp;ip=$current->cip' title='$current->chost'>"._LIST_COMMENT_BANIP."</a></td>";
			break;
	}
}


function listplug_table_bloglist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>" . _NAME . "</th><th colspan='6'>" ._LISTS_ACTIONS. "</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td title='blogid:$current->bnumber shortname:$current->bshortname'><a href='$current->burl'><img src='images/globe.gif' width='13' height='13' alt='". _BLOGLIST_TT_VISIT."' /></a> " . htmlspecialchars($current->bname) . "</td>";
			echo "<td><a href='index.php?action=createitem&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_ADD ."'>" . _BLOGLIST_ADD . "</a></td>";
			echo "<td><a href='index.php?action=itemlist&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_EDIT."'>". _BLOGLIST_EDIT."</a></td>";
			echo "<td><a href='index.php?action=bookmarklet&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_BMLET."'>". _BLOGLIST_BMLET . "</a></td>";

			if ($current->tadmin == 1) {
				echo "<td><a href='index.php?action=blogsettings&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_SETTINGS . "'>" ._BLOGLIST_SETTINGS. "</a></td>";
				echo "<td><a href='index.php?action=banlist&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_BANS. "'>". _BLOGLIST_BANS."</a></td>";
			}
			
			if ($template['superadmin']) {
				echo "<td><a href='index.php?action=deleteblog&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_DELETE."'>" ._BLOGLIST_DELETE. "</a></td>";
			}
			
		
		
			break;
	}
}

function listplug_table_shortblognames($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>" . _NAME . "</th><th>" . _NAME. "</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td>$current->bshortname</td>";
			echo "<td>" . htmlspecialchars($current->bname) . "</td>";
	
			break;
	}
}

function listplug_table_shortnames($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>" . _NAME . "</th><th>" . _LISTS_DESC. "</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td>$current->name</td>";
			echo "<td>" . htmlspecialchars($current->description) . "</td>";
	
			break;
	}
}


function listplug_table_categorylist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='2'>"._LISTS_ACTIONS."</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo '<td>';
			$id = listplug_nextBatchId();			
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->catid,'" />';
			echo '<label for="batch',$id,'">';
			echo htmlspecialchars($current->cname);
			echo '</label>';
			echo '</td>';
			
			echo '<td>', htmlspecialchars($current->cdesc), '</td>';
			echo "<td><a href='index.php?action=categorydelete&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";			
			echo "<td><a href='index.php?action=categoryedit&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";			
		
			break;
	}
}


function listplug_table_templatelist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td>" , htmlspecialchars($current->tdname), "</td>";
			echo "<td>" , htmlspecialchars($current->tddesc), "</td>";
			echo "<td><a href='index.php?action=templateedit&amp;templateid=$current->tdnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=templateclone&amp;templateid=$current->tdnumber' tabindex='".$template['tabindex']."'>"._LISTS_CLONE."</a></td>";
			echo "<td><a href='index.php?action=templatedelete&amp;templateid=$current->tdnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";			
		
			break;
	}
}

function listplug_table_skinlist($template, $type) {
	global $CONF, $DIR_SKINS;
	switch($type) {
		case 'HEAD';
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td>";
			if ($current->sdnumber == $CONF['BaseSkin']) {
				echo '<strong>',htmlspecialchars($current->sdname),'</strong>';
			} else {
				echo htmlspecialchars($current->sdname);
			}
			echo '<br /><br />';
			echo _LISTS_TYPE ,': ' , htmlspecialchars($current->sdtype);
			echo '<br />', _LIST_SKINS_INCMODE , ' ' , (($current->sdincmode=='skindir') ?_PARSER_INCMODE_SKINDIR:_PARSER_INCMODE_NORMAL);
			if ($current->sdincpref) echo '<br />' , _LIST_SKINS_INCPREFIX , ' ', $current->sdincpref;
			
			// add preview image when present
			if ($current->sdincpref && @file_exists($DIR_SKINS . $current->sdincpref . 'preview.png'))
			{
				echo '<br /><br />';
				
				$hasEnlargement = @file_exists($DIR_SKINS . $current->sdincpref . 'preview-large.png');
				if ($hasEnlargement)
					echo '<a href="',$CONF['SkinsURL'], $current->sdincpref,'preview-large.png" title="View larger">';
				
				echo '<img class="skinpreview" src="',$CONF['SkinsURL'], $current->sdincpref,'preview.png" width="100" height="75" alt="Preview for \'',htmlspecialchars($current->sdname),'\' skin" />';
				
				if ($hasEnlargement)
					echo '</a>';
					
				if (@file_exists($DIR_SKINS . $current->sdincpref . 'readme.html'))
				{
					echo '<br /><a href="',$CONF['SkinsURL'], $current->sdincpref,'readme.html" title="More info on the \'',htmlspecialchars($current->sdname),'\' skin">Readme</a>';
				}
					
					
			}
			
			echo "</td>";
			
						
			echo "<td>" , htmlspecialchars($current->sddesc);
				// show list of defined parts
				$r = sql_query('SELECT stype FROM '.sql_table('skin').' WHERE sdesc='.$current->sdnumber . ' ORDER BY stype');
				$types = array();
				while ($o = mysql_fetch_object($r))
					array_push($types,$o->stype);
				if (sizeof($types) > 0) {
					$friendlyNames = SKIN::getFriendlyNames();
					for ($i=0;$i<sizeof($types);$i++) {
						$type = $types[$i];
						$types[$i] = '<li>' . helpHtml('skinpart'.$type) . ' <a href="index.php?action=skinedittype&amp;skinid='.$current->sdnumber.'&amp;type='.$type.'" tabindex="'.$template['tabindex'].'">' . $friendlyNames[$type] . "</a></li>";
					}
					echo '<br /><br />',_LIST_SKINS_DEFINED,' <ul>',implode($types,'') ,'</ul>';
				}
			echo "</td>";
			echo "<td><a href='index.php?action=skinedit&amp;skinid=$current->sdnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=skinclone&amp;skinid=$current->sdnumber' tabindex='".$template['tabindex']."'>"._LISTS_CLONE."</a></td>";
			echo "<td><a href='index.php?action=skindelete&amp;skinid=$current->sdnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";
			
			break;
	}
}

function listplug_table_draftlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo "<th>"._LISTS_BLOG."</th><th>"._LISTS_TITLE."</th><th colspan='2'>"._LISTS_ACTIONS."</th>";		
			break;
		case 'BODY';
			$current = $template['current'];

			echo "<td>$current->bshortname</td>";			
			echo "<td>" . strip_tags($current->ititle) . "</td>";
			echo "<td><a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"._LISTS_DELETE."</a></td>";			
		
			break;
	}
}


function listplug_table_actionlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo '<th>'._LISTS_TIME.'</th><th>'._LIST_ACTION_MSG.'</th>';		
			break;
		case 'BODY';
			$current = $template['current'];
			
			echo "<td>$current->timestamp</td>";
			echo "<td>$current->message</td>";
		
			break;
	}
}

function listplug_table_banlist($template, $type) {
	switch($type) {
		case 'HEAD';
			echo '<th>'._LIST_BAN_IPRANGE.'</th><th>'. _LIST_BAN_REASON.'</th><th>'._LISTS_ACTIONS.'</th>';		
			break;
		case 'BODY';
			$current = $template['current'];
		
			echo "<td>$current->iprange</td>";
			echo "<td>" . htmlspecialchars($current->reason) . "</td>";
			echo "<td><a href='index.php?action=banlistdelete&amp;blogid=$current->blogid&amp;iprange=$current->iprange'>"._LISTS_DELETE."</a></td>";
			break;
	}
}

/**
 * Returns the Javascript code for a bookmarklet that works on most modern browsers
 *
 * @param blogid
 */
function getBookmarklet($blogid) {
	global $CONF;

	// normal
	$document = 'document';
	$bookmarkletline = "javascript:Q='';x=".$document.";y=window;if(x.selection){Q=x.selection.createRange().text;}else if(y.getSelection){Q=y.getSelection();}else if(x.getSelection){Q=x.getSelection();}wingm=window.open('";
	$bookmarkletline .= $CONF['AdminURL'] . "bookmarklet.php?blogid=$blogid";
	$bookmarkletline .="&logtext='+escape(Q)+'&loglink='+escape(x.location.href)+'&loglinktitle='+escape(x.title),'nucleusbm','scrollbars=yes,width=600,height=500,left=10,top=10,status=yes,resizable=yes');wingm.focus();";	

	return $bookmarkletline;
}


?>
