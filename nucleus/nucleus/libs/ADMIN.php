<?php
/**
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

class Admin
{
	static private $skin;
	
	static public $action;
	static public $aOptions;
	static public $blog;
	static public $contents;
	static public $extrahead;
	static public $headMess;
	static public $passvar;
	
	static private $skinless_actions = array(
		'plugindeleteconfirm',
		'pluginoptionsupdate',
		'blogsettingsupdate',
		'settingsupdate',
		'addnewlog2',
		'additem',
		'banlistnewfromitem',
		'itemdeleteconfirm',
		'itemupdate',
		'changemembersettings',
		'clearactionlog',
		'memberedit',
		'login',
		
		'skinremovetypeconfirm',
		'skinclone',
		'skindeleteconfirm',
		'skinnew',
		'skineditgeneral',
		'skinupdate',
		
		'skinieexport',
		
		'templateupdate',
		'templatedeleteconfirm',
		'templatenew',
		'templateclone',
		
		'adminskinremovetypeconfirm',
		'adminskinclone',
		'adminskindeleteconfirm',
		'adminskinnew',
		'adminskineditgeneral',
		'adminskinupdate',
		
		'adminskinieexport',
		
		'admintemplateupdate',
		'admintemplatedeleteconfirm',
		'admintemplatenew',
		'admintemplateclone'
	);
	
	static private $ticketless_actions = array(
		'showlogin',
		'login',
		'overview',
		'itemlist',
		'blogcommentlist',
		'bookmarklet',
		'blogsettings',
		'banlist',
		'createaccount',
		'deleteblog',
		'editmembersettings',
		'createaccount',
		'forgotpassword',
		'browseowncomments',
		'createitem',
		'browseownitems',
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
		
		'activate',
		'systemoverview',
		'activatesetpwd',
		
		'skinoverview',
		'skinclone',
		'skindelete',
		'skinedit',
		'skinedittype',
		'skinnew',
		'skinremovetype',
		
		'skinieoverview',
		
		'templateoverview',
		'templateclone',
		'templateedit',
		'templatedelete',
		
		'adminskinoverview',
		'adminskinclone',
		'adminskindelete',
		'adminskinedit',
		'adminskinedittype',
		'adminskinnew',
		'adminskinremovetype',
		
		'adminskinieoverview',
		
		'admintemplateoverview',
		'admintemplateclone',
		'admintemplateedit',
		'admintemplatedelete'
	);
	
	/**
	 * NOTE: This is for condition of admin/normal skin actions
	 */
	static public $adminskin_actions = array(
		/* ticketless */
		'adminskinoverview',
		'adminskinclone',
		'adminskindelete',
		'adminskinedit',
		'adminskinedittype',
		'adminskinnew',
		'adminskinremovetype',
		
		'adminskinieoverview',
		
		'admintemplateoverview',
		'admintemplateclone',
		'admintemplateedit',
		'admintemplatedelete',
		
		/* ticket needed */
		'adminskineditgeneral',
		'adminskinupdate',
		'adminskindeleteconfirm',
		'adminskinremovetypeconfirm',
		
		'adminskinieoverview',
		'adminskiniedoimport',
		'adminskinieexport',
		'adminskinieimport',
		
		'admintemplatenew',
		'admintemplatedeleteconfirm',
		'admintemplateupdate'
	);
	
	static public function initialize()
	{
		global $CONF, $manager, $member;
		
		/* NOTE: 1. decide which skinid to use */
		$skinid = $CONF['AdminSkin'];
		if ( $member->isLoggedIn() )
		{
			$memskin = $member->getAdminSkin();
			if ( $memskin && Skin::existsID($memskin))
			{
				$skinid = $memskin;
			}
		}
		
		/* NOTE: 2. make an instance of skin object */
		if ( !Skin::existsID($skinid) )
		{
			return FALSE;
		}
		
		/* NOTE: 3. initializing each members */
		self::$skin			=& $manager->getSkin($skinid, 'AdminActions', 'AdminSkin');
		self::$action		= '';
		self::$extrahead	= '';
		self::$passvar		= '';
		self::$headMess		= '';
		self::$aOptions		= '';
		return TRUE;
	}
	
	/**
	 * Admin::action()
	 * Executes an action
	 *
	 * @param	string	$action	action to be performed
	 * @return	void
	 */
	static public function action($action)
	{
		global $CONF, $manager, $member;
		
		/* 1. decide action name */
		$customAction = postvar('customaction');
		if ( empty($customAction) )
		{
			$alias = array(
				'login'	=> 'overview',
				''		=> 'overview',
			);
		}
		else
		{
			$alias = array(
				'login'	=> $customAction,
				''		=> $customAction
			);
		}
		if ( array_key_exists($action, $alias) && isset($alias[$action]) )
		{
			$action = $alias[$action];
		}
		$method_name = "action_{$action}";
		self::$action = strtolower($action);
		
		/* 2. check ticket-needed action */
		if ( !in_array(self::$action, self::$ticketless_actions) && !$manager->checkTicket() )
		{
			self::error(_ERROR_BADTICKET);
			return;
		}
		
		/* 3. parse according to the action */
		else if ( method_exists('Admin', $method_name) )
		{
			call_user_func(array(__CLASS__, $method_name));
			return;
		}
		/* 4. parse special admin skin */
		elseif ( in_array(self::$action, self::$skinless_actions) )
		{
			/* TODO: need to be implemented or not?
			self::action_parseSpecialskin();
			*/
		}
		else
		{
			self::error(_BADACTION . ENTITY::hsc($action));
			return;
		}
		
		return;
	}
	
	/**
	 * Action::action_showlogin()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_showlogin()
	{
		global $error;
		self::action_login($error);
		return;
	}
	
	/**
	 * Action::action_login()
	 * 
	 * @param	string	$msg		message for pageheader
	 * @param	integer	$passvars	???
	 */
	static private function action_login($msg = '', $passvars = 1)
	{
		global $member;
		
		// skip to overview when allowed
		if ( $member->isLoggedIn() && $member->canLogin() )
		{
			self::action_overview();
			return;
		}
		
		/* TODO: needless variable??? */
		self::$passvar = $passvars;
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		
		self::$skin->parse('showlogin');
	}
	
	/**
	 * Action::action_overview()
	 * provides a screen with the overview of the actions available
	 * 
	 * @param	string	$msg	message for pageheader
	 * @return	void
	 */
	static private function action_overview($msg = '')
	{
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		
		self::$skin->parse('overview');
		return;
	}
	
	/**
	 * Admin::action_manage()
	 * 
	 * @param	string	$msg	message for pageheader
	 * @retrn	void
	 */
	static private function action_manage($msg = '')
	{
		global $member;
		
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('manage');
		return;
	}
	
	/**
	 * Action::action_itemlist()
	 * 
	 * @param	integer	id for weblod
	 * @return	void
	 */
	static private function action_itemlist($blogid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $blogid == '' )
		{
			$blogid = intRequestVar('blogid');
		}
		
		$member->teamRights($blogid) or $member->isAdmin() or self::disallow();
		
		self::$skin->parse('itemlist');
		return;
	}
	
	/**
	 * Action::action_batchitem()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_batchitem()
	{
		global $member, $manager;
		
		$member->isLoggedIn() or self::disallow();
		
		$selected	= requestIntArray('batch');
		$action		= requestVar('batchaction');
		
		if ( !is_array($selected) || sizeof($selected) == 0 )
		{
			self::error(_BATCH_NOSELECTION);
			return;
		}
		
		// On move: when no destination blog/category chosen, show choice now
		$destCatid = intRequestVar('destcatid');
		if ( ($action == 'move') && (!$manager->existsCategory($destCatid)) )
		{
			self::batchMoveSelectDestination('item', $selected);
		}
		
		// On delete: check if confirmation has been given
		if ( ($action == 'delete') && (requestVar('confirmation') != 'yes') )
		{
			self::batchAskDeleteConfirmation('item', $selected);
		}
		
		self::$skin->parse('batchitem');
		return;
	}
	
	/**
	 * Action::action_batchcomment()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_batchcomment()
	{
		global $member;
		
		$member->isLoggedIn() or self::disallow();
		
		$selected	= requestIntArray('batch');
		$action		= requestVar('batchaction');
		
		// Show error when no items were selected
		if ( !is_array($selected) || sizeof($selected) == 0 )
		{
			self::error(_BATCH_NOSELECTION);
			return;
		}
		
		// On delete: check if confirmation has been given
		if ( ($action == 'delete') && (requestVar('confirmation') != 'yes') )
		{
			self::batchAskDeleteConfirmation('comment', $selected);
		}
		
		self::$skin->parse('batchcomment');
		return;
	}
	
	/**
	 * Admin::action_batchmember()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_batchmember()
	{
		global $member;
		
		($member->isLoggedIn() && $member->isAdmin()) or self::disallow();
		
		$selected	= requestIntArray('batch');
		$action		= requestVar('batchaction');
		
		// Show error when no members selected
		if ( !is_array($selected) || sizeof($selected) == 0 )
		{
			self::error(_BATCH_NOSELECTION);
			return;
		}
		
		// On delete: check if confirmation has been given
		if ( ($action == 'delete') && (requestVar('confirmation') != 'yes') )
		{
			self::batchAskDeleteConfirmation('member',$selected);
		}
		
		self::$skin->parse('batchmember');
		return;
	}
	
	/**
	 * Admin::action_batchteam()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_batchteam()
	{
		global $member;
		
		$blogid = intRequestVar('blogid');
		
		($member->isLoggedIn() && $member->blogAdminRights($blogid)) or self::disallow();
		
		$selected	= requestIntArray('batch');
		$action		= requestVar('batchaction');
		
		if ( !is_array($selected) || sizeof($selected) == 0 )
		{
			self::error(_BATCH_NOSELECTION);
			return;
		}
		
		// On delete: check if confirmation has been given
		if ( ($action == 'delete') && (requestVar('confirmation') != 'yes') )
		{
			self::batchAskDeleteConfirmation('team',$selected);
		}
		
		self::$skin->parse('batchteam');
		return;
	}
	
	/**
	 * Admin::action_batchcategory()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_batchcategory()
	{
		global $member, $manager;
		
		$member->isLoggedIn() or self::disallow();
		
		$selected	= requestIntArray('batch');
		$action		= requestVar('batchaction');
		
		if ( !is_array($selected) || sizeof($selected) == 0 )
		{
			self::error(_BATCH_NOSELECTION);
			return;
		}
		
		// On move: when no destination blog chosen, show choice now
		$destBlogId = intRequestVar('destblogid');
		if ( ($action == 'move') && (!$manager->existsBlogID($destBlogId)) )
		{
			self::batchMoveCategorySelectDestination('category', $selected);
		}
		
		// On delete: check if confirmation has been given
		if ( ($action == 'delete') && (requestVar('confirmation') != 'yes') )
		{
			self::batchAskDeleteConfirmation('category', $selected);
		}
		
		self::$skin->parse('batchcategory');
		return;
	}
	
	/**
	 * Admin::batchMoveSelectDestination()
	 * 
	 * @param	string	$type	type of batch action
	 * @param	integer	$ids	needless???
	 * @return	void
	 * 
	 * TODO: remove needless argument
	 */
	static private function batchMoveSelectDestination($type, $ids)
	{
		$_POST['batchmove'] = $type;
		self::$skin->parse('batchmove');
		return;
	}
	
	/**
	 * Admin::batchMoveCategorySelectDestination()
	 * 
	 * @param	string	$type	type of batch action
	 * @param	integer	$ids	needless???
	 * @return	void
	 * 
	 * TODO: remove needless argument
	 */
	static private function batchMoveCategorySelectDestination($type, $ids)
	{
		$_POST['batchmove'] = $type;
		global $manager;
		self::$skin->parse('batchmovecat');
		return;
	}
	
	/**
	 * Admin::batchAskDeleteConfirmation()
	 * 
	 * @param	string	$type	type of batch action
	 * @param	integer	$ids	needless???
	 * @return	void
	 * 
	 * TODO: remove needless argument
	 */
	static private function batchAskDeleteConfirmation($type, $ids)
	{
		self::$skin->parse('batchdelete');
		return;
	}
	
	/**
	 * Admin::action_browseownitems()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_browseownitems()
	{
		global $member, $manager, $CONF;
		
		self::$skin->parse('browseownitems');
		return;
	}
	
	/**
	 * Admin::action_itemcommentlist()
	 * Show all the comments for a given item
	 * 
	 * @param	integer	$itemid	ID for item
	 * @return	void
	 */
	static private function action_itemcommentlist($itemid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $itemid == '' )
		{
			$itemid = intRequestVar('itemid');
		}
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or self::disallow();
		
		$item =& $manager->getItem($itemid, 1, 1);
		$_REQUEST['itemid'] = $item['itemid'];
		$_REQUEST['blogid'] = $item['blogid'];
		
		self::$skin->parse('itemcommentlist');
		return;
	}
	
	/**
	 * Admin::action_browseowncomments()
	 * Browse own comments
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_browseowncomments()
	{
		self::$skin->parse('browseowncomments');
		return;
	}
	
	/**
	 * Admin::action_blogcommentlist()
	 * Browse all comments for a weblog
	 * 
	 * @param	integer	$blogid	ID for weblog
	 * @return	void
	 */
	static private function action_blogcommentlist($blogid = '')
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
		
		$member->teamRights($blogid) or $member->isAdmin() or self::disallow();
		
		/* TODO: we consider to use the other way insterad of this */
		$_REQUEST['blogid'] = $blogid;
		
		self::$skin->parse('blogcommentlist');
		return;
	}
	
	/**
	 * Admin::action_createaccount()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_createaccount()
	{
		global $CONF;
		
		if ( $CONF['AllowMemberCreate'] != 1 )
		{
			self::$skin->parse('createaccountdisable');
			return;
		}
		
		$name = '';
		$realname ='';
		$email = '';
		$url = '';
		
		$contents = array(
			'name'		=> '',
			'realname'	=> '',
			'email'		=> '',
			'url'		=> ''
		);
		
		if ( array_key_exists('showform', $_POST) && $_POST['showform'] == 1 )
		{
			$action = new Action();
			$message = $action->createAccount();
			if ( $message === 1 )
			{
				self::$headMess = $message;
				self::$skin->parse('createaccountsuccess');
				return;
			}
			
			/* TODO: validation */
			if ( array_key_exists('name', $_POST) )
			{
				$contents['name'] = $_POST['name'];
			}
			if ( array_key_exists('realname', $_POST) )
			{
				$contents['realname'] = $_POST['realname'];
			}
			if ( array_key_exists('email', $_POST) )
			{
				$contents['email'] = $_POST['email'];
			}
			if ( array_key_exists('url', $_POST) )
			{
				$contents['url'] = $_POST['url'];
			}
			
			self::$contents = $contents;
			
		}
		
		self::$skin->parse('createaccountinput');
		return;
	}
	
	/**
	 * Admin::action_createitem()
	 * Provide a page to item a new item to the given blog
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_createitem()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->teamRights($blogid) or self::disallow();
		
		$blog =& $manager->getBlog($blogid);
		$contents = array();
		
		$data = array(
			'blog'		=> &$blog,
			'contents'	=> &$contents
		);
		$manager->notify('PreAddItemForm', $data);
		
		if ( $blog->convertBreaks() )
		{
			if ( array_key_exists('body', $contents) && !empty($contents['body']) )
			{
				$contents['body'] = removeBreaks($contents['body']);
			}
			if ( array_key_exists('more', $contents) && !empty($contents['more']) )
			{
				$contents['more'] = removeBreaks($contents['more']);
			}
		}
		
		self::$blog = &$blog;
		self::$contents = &$contents;
		
		self::$skin->parse('createitem');
		return;
	}
	
	/**
	 * Admin::action_itemedit()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_itemedit()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or self::disallow();
		
		$item =& $manager->getItem($itemid, 1, 1);
		$blog =& $manager->getBlog($item['blogid']);
		$manager->notify('PrepareItemForEdit', array('blog'=> &$blog, 'item' => &$item));
		
		if ( $blog->convertBreaks() )
		{
			if ( array_key_exists('body', $item) && !empty($item['body']) )
			{
				$item['body'] = removeBreaks($item['body']);
			}
			if ( array_key_exists('more', $item) && !empty($item['more']) )
			{
				$item['more'] = removeBreaks($item['more']);
			}
		}
		
		self::$blog = &$blog;
		self::$contents = &$item;
		
		self::$skin->parse('itemedit');
		return;
	}
	
	/**
	 * Admin::action_itemupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_itemupdate()
	{
		global $member, $manager, $CONF;
		
		$itemid = intRequestVar('itemid');
		$catid  = postVar('catid');
		
		// only allow if user is allowed to alter item
		$member->canUpdateItem($itemid, $catid) or self::disallow();
		
		$actiontype = postVar('actiontype');
		
		// delete actions are handled by itemdelete (which has confirmation)
		if ( $actiontype == 'delete' )
		{
			self::action_itemdelete();
			return;
		}
		
		$body		= postVar('body');
		$title		= postVar('title');
		$more		= postVar('more');
		$closed		= intPostVar('closed');
		$draftid	= intPostVar('draftid');
		
		// default action = add now
		if ( !$actiontype )
		{
			$actiontype='addnow';
		}
		
		// create new category if needed
		if ( i18n::strpos($catid,'newcat') === 0 )
		{
			// get blogid
			list($blogid) = sscanf($catid,"newcat-%d");
			
			// create
			$blog =& $manager->getBlog($blogid);
			$catid = $blog->createNewCategory();
			
			// show error when sth goes wrong
			if ( !$catid )
			{
				self::doError(_ERROR_CATCREATEFAIL);
			}
		}
		
		/**
		 * set some variables based on actiontype
		 * 
		 * actiontypes:
		 * 	draft items -> addnow, addfuture, adddraft, delete
		 * 	non-draft items -> edit, changedate, delete
		 * 
		 * variables set:
		 * 	$timestamp: set to a nonzero value for future dates or date changes
		 * 	$wasdraft: set to 1 when the item used to be a draft item
		 * 	$publish: set to 1 when the edited item is not a draft
		 */
		$blogid =  getBlogIDFromItemID($itemid);
		$blog =& $manager->getBlog($blogid);
		
		$wasdrafts = array('adddraft', 'addfuture', 'addnow');
		$wasdraft  = in_array($actiontype, $wasdrafts) ? 1 : 0;
		$publish   = ($actiontype != 'adddraft' && $actiontype != 'backtodrafts') ? 1 : 0;
		if ( $actiontype == 'addfuture' || $actiontype == 'changedate' )
		{
			$timestamp = mktime(intPostVar('hour'), intPostVar('minutes'), 0, intPostVar('month'), intPostVar('day'), intPostVar('year'));
		}
		else
		{
			$timestamp =0;
		}
		
		// edit the item for real
		Item::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);
		
		self::updateFuturePosted($blogid);
		
		if ( $draftid > 0 )
		{
			// delete permission is checked inside Item::delete()
			Item::delete($draftid);
		}
		
		if ( $catid != intPostVar('catid') )
		{
			self::action_categoryedit(
				$catid,
				$blog->getID(),
				$CONF['AdminURL'] . 'index.php?action=itemlist&blogid=' . getBlogIDFromItemID($itemid)
			);
		}
		else
		{
			// TODO: set start item correctly for itemlist
			$item =& $manager->getitem($itemid, 1, 1);
			$query = "SELECT COUNT(*) FROM %s WHERE unix_timestamp(itime) <= '%s';";
			$query = sprintf($query, sql_table('item'), $item['timestamp']);
			$cnt  = DB::getValue($query);
			$_REQUEST['start'] = $cnt + 1;
			self::action_itemlist(getBlogIDFromItemID($itemid));
		}
		return;
	}
	
	/**
	 * Admin::action_itemdelete()
	 * Delete item
	 * 
	 * @param	Void
	 * @return	Void
	 */
	static private function action_itemdelete()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or self::disallow();
		
		if ( !$manager->existsItem($itemid,1,1) )
		{
			self::error(_ERROR_NOSUCHITEM);
			return;
		}
		
		self::$skin->parse('itemdelete');
		return;
	}
	
	/**
	 * Admin::action_itemdeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_itemdeleteconfirm()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		// only allow if user is allowed to alter item
		$member->canAlterItem($itemid) or self::disallow();
		
		// get item first
		$item =& $manager->getItem($itemid, 1, 1);
		
		// delete item (note: some checks will be performed twice)
		self::deleteOneItem($item['itemid']);
		
		self::action_itemlist($item['blogid']);
		return;
	}
	
	/**
	 * Admin::deleteOneItem()
	 * Deletes one item and returns error if something goes wrong
	 * 
	 * @param	integer	$itemid	ID for item
	 * @return	void
	 */
	static public function deleteOneItem($itemid)
	{
		global $member, $manager;
		
		// only allow if user is allowed to alter item (also checks if itemid exists)
		if ( !$member->canAlterItem($itemid) )
		{
			return _ERROR_DISALLOWED;
		}
		
		// need to get blogid before the item is deleted
		$item =& $manager->getItem($itemid, 1, 1);
		
		$manager->loadClass('ITEM');
		Item::delete($item['itemid']);
		
		// update blog's futureposted
		self::updateFuturePosted($item['itemid']);
		return;
	}
	
	/**
	 * Admin::updateFuturePosted()
	 * Update a blog's future posted flag
	 * 
	 * @param integer $blogid
	 * @return	void
	 */
	static private function updateFuturePosted($blogid)
	{
		global $manager;
		
		$blogid			=  intval($blogid);
		$blog			=& $manager->getBlog($blogid);
		$currenttime	=  $blog->getCorrectTime(time());
		
		$query = "SELECT * FROM %s WHERE iblog=%d AND iposted=0 AND itime>'%s'";
		$query = sprintf($query, sql_table('item'), (integer) $blogid, i18n::formatted_datetime('mysql', $currenttime));
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
	 * Admin::action_itemmove()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_itemmove()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		
		$member->canAlterItem($itemid) or self::disallow();
		
		self::$skin->parse('itemmove');
		return;
	}
	
	/**
	 * Admin::action_itemmoveto()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_itemmoveto()
	{
		global $member, $manager;
		
		$itemid = intRequestVar('itemid');
		$catid = requestVar('catid');
		
		// create new category if needed
		if ( i18n::strpos($catid,'newcat') === 0 )
		{
			// get blogid
			list($blogid) = sscanf($catid,'newcat-%d');
			
			// create
			$blog =& $manager->getBlog($blogid);
			$catid = $blog->createNewCategory();
			
			// show error when sth goes wrong
			if ( !$catid )
			{
				self::doError(_ERROR_CATCREATEFAIL);
			}
		}
		
		// only allow if user is allowed to alter item
		$member->canUpdateItem($itemid, $catid) or self::disallow();
		
		$old_blogid = getBlogIDFromItemId($itemid);
		
		Item::move($itemid, $catid);
		
		// set the futurePosted flag on the blog
		self::updateFuturePosted(getBlogIDFromItemId($itemid));
		
		// reset the futurePosted in case the item is moved from one blog to another
		self::updateFuturePosted($old_blogid);
		
		if ( $catid != intRequestVar('catid') )
		{
			self::action_categoryedit($catid, $blog->getID());
		}
		else
		{
			self::action_itemlist(getBlogIDFromCatID($catid));
		}
		return;
	}
	
	/**
	 * Admin::moveOneItem()
	 * Moves one item to a given category (category existance should be checked by caller)
	 * errors are returned
	 * 
	 * @param	integer	$itemid		ID for item
	 * @param	integer	$destCatid	ID for category to which the item will be moved
	 * @return	void
	 */
	static public function moveOneItem($itemid, $destCatid)
	{
		global $member;
		
		// only allow if user is allowed to move item
		if ( !$member->canUpdateItem($itemid, $destCatid) )
		{
			return _ERROR_DISALLOWED;
		}
		
		Item::move($itemid, $destCatid);
		return;
	}
	
	/**
	 * Admin::action_additem()
	 * Adds a item to the chosen blog
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_additem()
	{
		global $manager, $CONF;
		
		$manager->loadClass('ITEM');
		
		$result = Item::createFromRequest();
		
		if ( $result['status'] == 'error' )
		{
			self::error($result['message']);
			return;
		}
		
		$item =& $manager->getItem($result['itemid'], 0, 0);
		
		if ( $result['status'] == 'newcategory' )
		{
			$distURI = $manager->addTicketToUrl($CONF['AdminURL'] . 'index.php?action=itemList&blogid=' . $item['blogid']);
			self::action_categoryedit($result['catid'], $item['blogid'], $distURI);
		}
		else
		{
			$methodName = 'action_itemlist';
			self::action_itemlist($item['blogid']);
		}
		return;
	}
	
	/**
	 * Admin::action_commentedit()
	 * Allows to edit previously made comments
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_commentedit()
	{
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		
		$member->canAlterComment($commentid) or self::disallow();
		
		$comment = COMMENT::getComment($commentid);
		$manager->notify('PrepareCommentForEdit', array('comment' => &$comment));
		
		self::$contents = $comment;
		self::$skin->parse('commentedit');
		return;
	}
	
	/**
	 * Admin::action_commentupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_commentupdate()
	{
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		
		$member->canAlterComment($commentid) or self::disallow();
		
		$url	= postVar('url');
		$email	= postVar('email');
		$body	= postVar('body');
		
		// intercept words that are too long
		if (preg_match('#[a-zA-Z0-9|\.,;:!\?=\/\\\\]{90,90}#', $body) != FALSE)
		{
			self::error(_ERROR_COMMENT_LONGWORD);
			return;
		}
		
		// check length
		if ( i18n::strlen($body) < 3 )
		{
			self::error(_ERROR_COMMENT_NOCOMMENT);
			return;
		}
		
		if ( i18n::strlen($body) > 5000 )
		{
			self::error(_ERROR_COMMENT_TOOLONG);
			return;
		}
		
		// prepare body
		$body = Comment::prepareBody($body);
		
		// call plugins
		$data = array(
			'body' => &$body
		);
		$manager->notify('PreUpdateComment', $data);
		
		$query = "UPDATE %s SET cmail=%s, cemail=%s, cbody=%s WHERE cnumber=%d;";
		$query = sprintf($query, sql_table('comment'), DB::quoteValue($url), DB::quoteValue($email), DB::quoteValue($body), (integer) $commentid);
		DB::execute($query);
		
		// get itemid
		$query = "SELECT citem FROM %s WHERE cnumber=%d;";
		$query = sprintf($query, sql_table('comment'), (integer) $commentid);
		
		$itemid	= DB::getValue($query);
		
		if ( $member->canAlterItem($itemid) )
		{
			self::action_itemcommentlist($itemid);
		}
		else
		{
			self::action_browseowncomments();
		}
		return;
	}
	
	/**
	 * Admin::action_commentdelete()
	 * Update comment
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_commentdelete()
	{
		global $member, $manager;
		
		$commentid = intRequestVar('commentid');
		$member->canAlterComment($commentid) or self::disallow();
		
		self::$skin->parse('commentdelete');
		return;
	}
	
	/**
	 * Admin::action_commentdeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_commentdeleteconfirm()
	{
		global $member;
		
		$commentid = intRequestVar('commentid');
		
		// get item id first
		$query = "SELECT citem FROM %s WHERE cnumber=%d;";
		$query = sprintf($query, sql_table('comment'), (integer) $commentid);
		
		$itemid = DB::getValue($query);
		
		$error = self::deleteOneComment($commentid);
		if ( $error )
		{
			self::doError($error);
		}
		
		if ( $member->canAlterItem($itemid) )
		{
			self::action_itemcommentlist($itemid);
		}
		else
		{
			self::action_browseowncomments();
		}
		return;
	}
	
	/**
	 * Admin::deleteOneComment()
	 * 
	 * @param	integer	$commentid	ID for comment
	 * @return	void
	 */
	static public function deleteOneComment($commentid)
	{
		global $member, $manager;
		
		$commentid = (integer) $commentid;
		
		if ( !$member->canAlterComment($commentid) )
		{
			return _ERROR_DISALLOWED;
		}
		
		$data = array(
			'commentid' => $commentid
		);
		
		$manager->notify('PreDeleteComment', $data);
		
		// delete the comments associated with the item
		$query = "DELETE FROM %s WHERE cnumber=%d;";
		$query = sprintf($query, sql_table('comment'), (integer) $commentid);
		DB::execute($query);
		
		$data = array(
			'commentid' => $commentid
		);
		
		$manager->notify('PostDeleteComment', $data);
		
		return '';
	}
	
	/**
	 * Admin::action_usermanagement()
	 * Usermanagement main
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_usermanagement()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('usermanagement');
		return;
	}
	
	/**
	 * Admin::action_memberedit()
	 * Edit member settings
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_memberedit()
	{
		self::action_editmembersettings(intRequestVar('memberid'));
		return;
	}
	
	/**
	 * Admin::action_editmembersettings()
	 * 
	 * @param	integer	$memberid	ID for member
	 * @return	void
	 * 
	 */
	static private function action_editmembersettings($memberid = '')
	{
		global $member, $manager, $CONF;
		
		if ( $memberid == '' )
		{
			$memberid = $member->getID();
		}
		
		/* TODO: we should consider to use the other way insterad of this */
		$_REQUEST['memberid'] = $memberid;
		
		// check if allowed
		($member->getID() == $memberid) or $member->isAdmin() or self::disallow();
		
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/numbercheck.js)%>\"></script>\n";
		
		self::$skin->parse('editmembersettings');
		return;
	}
	
	/**
	 * Admin::action_changemembersettings()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_changemembersettings()
	{
		global $member, $CONF, $manager;
		
		$memberid = intRequestVar('memberid');
		
		// check if allowed
		($member->getID() == $memberid) or $member->isAdmin() or self::disallow();
		
		$name			= trim(strip_tags(postVar('name')));
		$realname		= trim(strip_tags(postVar('realname')));
		$password		= postVar('password');
		$repeatpassword	= postVar('repeatpassword');
		$email			= strip_tags(postVar('email'));
		$url			= strip_tags(postVar('url'));
		$adminskin		= intPostVar('adminskin');
		$bookmarklet	= intPostVar('bookmarklet');
		
		// begin if: sometimes user didn't prefix the URL with http:// or https://, this cause a malformed URL. Let's fix it.
		if ( !preg_match('#^https?://#', $url) )
		{
			$url = 'http://' . $url;
		}
		
		$admin		= postVar('admin');
		$canlogin	= postVar('canlogin');
		$notes		= strip_tags(postVar('notes'));
		$locale		= postVar('locale');
		
		$mem =& $manager->getMember($memberid);
		
		if ( $CONF['AllowLoginEdit'] || $member->isAdmin() )
		{
			if ( !isValidDisplayName($name) )
			{
				self::error(_ERROR_BADNAME);
				return;
			}
			
			if ( ($name != $mem->getDisplayName()) && Member::exists($name) )
			{
				self::error(_ERROR_NICKNAMEINUSE);
				return;
			}
			
			if ( $password != $repeatpassword )
			{
				self::error(_ERROR_PASSWORDMISMATCH);
				return;
			}
			
			if ( $password && (i18n::strlen($password) < 6) )
			{
				self::error(_ERROR_PASSWORDTOOSHORT);
				return;
			}
				
			if ( $password )
			{
				$pwdvalid = true;
				$pwderror = '';
				
				$data = array(
					'password'     => $password,
					'errormessage' => &$pwderror,
					'valid'        => &$pwdvalid
				);
				$manager->notify('PrePasswordSet', $data);
				
				if ( !$pwdvalid )
				{
					self::error($pwderror);
					return;
				}
			}
		}
		
		if ( !NOTIFICATION::address_validation($email) )
		{
			self::error(_ERROR_BADMAILADDRESS);
			return;
		}
		if ( !$realname )
		{
			self::error(_ERROR_REALNAMEMISSING);
			return;
		}
		if ( ($locale != '') && (!in_array($locale, i18n::get_available_locale_list())) )
		{
			self::error(_ERROR_NOSUCHTRANSLATION);
			return;
		}
		
		// check if there will remain at least one site member with both the logon and admin rights
		// (check occurs when taking away one of these rights from such a member)
		if (	(!$admin && $mem->isAdmin() && $mem->canLogin())
			||	(!$canlogin && $mem->isAdmin() && $mem->canLogin())
			)
		{
			$r = DB::getResult('SELECT * FROM '.sql_table('member').' WHERE madmin=1 and mcanlogin=1');
			if ( $r->rowCount() < 2 )
			{
				self::error(_ERROR_ATLEASTONEADMIN);
				return;
			}
		}
		
		if ( $CONF['AllowLoginEdit'] || $member->isAdmin() )
		{
			$mem->setDisplayName($name);
			if ( $password )
			{
				$mem->setPassword($password);
			}
		}
		
		$oldEmail = $mem->getEmail();
		
		$mem->setRealName($realname);
		$mem->setEmail($email);
		$mem->setURL($url);
		$mem->setNotes($notes);
		$mem->setLocale($locale);
		$mem->setAdminSkin($adminskin);
		$mem->setBookmarklet($bookmarklet);

		// only allow super-admins to make changes to the admin status
		if ( $member->isAdmin() )
		{
			$mem->setAdmin($admin);
			$mem->setCanLogin($canlogin);
		}
		
		$autosave = postVar('autosave');
		$mem->setAutosave($autosave);
		
		$mem->write();
		
		// store plugin options
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions);
		$data = array(
			'context'  => 'member',
			'memberid' => $memberid,
			'member'   => &$mem
		);
		$manager->notify('PostPluginOptionsUpdate', $data);
		
		// if email changed, generate new password
		if ( $oldEmail != $mem->getEmail() )
		{
			$mem->sendActivationLink('addresschange', $oldEmail);
			// logout member
			$mem->newCookieKey();
			
			// only log out if the member being edited is the current member.
			if ( $member->getID() == $memberid )
			{
				$member->logout();
			}
			self::action_login(_MSG_ACTIVATION_SENT, 0);
			return;
		}
		
		if ( ($mem->getID() == $member->getID())
			&& ($mem->getDisplayName() != $member->getDisplayName()) )
		{
			$mem->newCookieKey();
			$member->logout();
			self::action_login(_MSG_LOGINAGAIN, 0);
		}
		else
		{
			self::action_overview(_MSG_SETTINGSCHANGED);
		}
		return;
	}

	/**
	 * Admin::action_memberadd()
	 * 
	 * @param	void
	 * @return	void
	 * 
	 */
	static private function action_memberadd()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		if ( postVar('password') != postVar('repeatpassword') )
		{
			self::error(_ERROR_PASSWORDMISMATCH);
			return;
		}
		
		if ( i18n::strlen(postVar('password')) < 6 )
		{
			self::error(_ERROR_PASSWORDTOOSHORT);
			return;
		}
		
		$res = Member::create(
			postVar('name'),
			postVar('realname'),
			postVar('password'),
			postVar('email'),
			postVar('url'),
			postVar('admin'),
			postVar('canlogin'),
			postVar('notes')
		);
		
		if ( $res != 1 )
		{
			self::error($res);
			return;
		}
		
		// fire PostRegister event
		$newmem = new Member();
		$newmem->readFromName(postVar('name'));
		$data = array(
			'member' => &$newmem
		);
		$manager->notify('PostRegister', $data);
		
		self::action_usermanagement();
		return;
	}
	
	/**
	 * Admin::action_forgotpassword()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_forgotpassword()
	{
		self::$skin->parse('forgotpassword');
		return;
	}
	
	/**
	 * Admin::action_activate()
	 * Account activation
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_activate()
	{
		$key = getVar('key');
		self::showActivationPage($key);
		return;
	}
	
	/**
	 * Admin::showActivationPage()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function showActivationPage($key, $message = '')
	{
		global $manager;
		
		// clean up old activation keys
		Member::cleanupActivationTable();
		
		// get activation info
		$info = Member::getActivationInfo($key);
		
		if ( !$info )
		{
			self::error(_ERROR_ACTIVATE);
			return;
		}
		
		$mem =& $manager->getMember($info->vmember);
		
		if ( !$mem )
		{
			self::error(_ERROR_ACTIVATE);
			return;
		}
		
		/* TODO: we should consider to use the other way insterad of this */
		$_POST['ackey']					= $key;
		$_POST['bNeedsPasswordChange']	= TRUE;
		
		self::$headMess = $message;
		self::$skin->parse('activate');
		return;
	}
	
	/**
	 * Admin::action_activatesetpwd()
	 * Account activation - set password part
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_activatesetpwd()
	{
		global $manager;
		$key = postVar('key');
		
		// clean up old activation keys
		Member::cleanupActivationTable();
		
		// get activation info
		$info = Member::getActivationInfo($key);
		
		if ( !$info || ($info->type == 'addresschange') )
		{
			return self::showActivationPage($key, _ERROR_ACTIVATE);
		}
		
		$mem =& $manager->getMember($info->vmember);
		
		if ( !$mem )
		{
			return self::showActivationPage($key, _ERROR_ACTIVATE);
		}
		
		$password		= postVar('password');
		$repeatpassword	= postVar('repeatpassword');
		
		if ( $password != $repeatpassword )
		{
			return self::showActivationPage($key, _ERROR_PASSWORDMISMATCH);
		}
		
		if ( $password && (i18n::strlen($password) < 6) )
		{
			return self::showActivationPage($key, _ERROR_PASSWORDTOOSHORT);
		}
			
		if ( $password )
		{
			$pwdvalid = true;
			$pwderror = '';
			
			$data = array(
				'password'		=> $password,
				'errormessage'	=> &$pwderror,
				'valid'			=> &$pwdvalid
			);
			$manager->notify('PrePasswordSet', $data);
			if ( !$pwdvalid )
			{
				return self::showActivationPage($key,$pwderror);
			}
		}
		
		$error = '';
		
		$data = array(
			'type'   => 'activation',
			'member' => $mem,
			'error'  => &$error
		);
		$manager->notify('ValidateForm', $data);
		if ( $error != '' )
		{
			return self::showActivationPage($key, $error);
		}
		
		// set password
		$mem->setPassword($password);
		$mem->write();
		
		// do the activation
		Member::activate($key);
		
		self::$skin->parse('activatesetpwd');
		return;
	}
	
	/**
	 * Admin::action_manageteam()
	 * Manage team
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_manageteam()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or self::disallow();
		
		self::$skin->parse('manageteam');
		return;
	}
	
	/**
	 * Admin::action_teamaddmember()
	 * Add member to team
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_teamaddmember()
	{
		global $member, $manager;
		
		$memberid	= intPostVar('memberid');
		$blogid		= intPostVar('blogid');
		$admin		= intPostVar('admin');
		
		// check if allowed
		$member->blogAdminRights($blogid) or self::disallow();
		
		$blog =& $manager->getBlog($blogid);
		if ( !$blog->addTeamMember($memberid, $admin) )
		{
			self::error(_ERROR_ALREADYONTEAM);
			return;
		}
		
		self::action_manageteam();
		return;
	}
	
	/**
	 * Admin::action_teamdelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_teamdelete()
	{
		global $member, $manager;
		
		$memberid	= intRequestVar('memberid');
		$blogid		= intRequestVar('blogid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or self::disallow();
		
		$teammem =& $manager->getMember($memberid);
		$blog =& $manager->getBlog($blogid);
		
		self::$skin->parse('teamdelete');
		return;
	}
	
	/**
	 * Admin::action_teamdeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_teamdeleteconfirm()
	{
		global $member;
		
		$memberid = intRequestVar('memberid');
		$blogid = intRequestVar('blogid');
		
		$error = self::deleteOneTeamMember($blogid, $memberid);
		if ( $error )
		{
			self::error($error);
			return;
		}
		self::action_manageteam();
		return;
	}
	
	/**
	 * Admin::deleteOneTeamMember()
	 * 
	 * @param	void
	 * @return	void
	 */
	static public function deleteOneTeamMember($blogid, $memberid)
	{
		global $member, $manager;
		
		$blogid   = intval($blogid);
		$memberid = intval($memberid);
		
		// check if allowed
		if ( !$member->blogAdminRights($blogid) )
		{
			return _ERROR_DISALLOWED;
		}
		
		// check if: - there remains at least one blog admin
		//           - (there remains at least one team member)
		$tmem =& $manager->getMember($memberid);
		
		
		$data = array(
			'member' => &$tmem,
			'blogid' => $blogid
		);
		$manager->notify('PreDeleteTeamMember', $data);
		
		if ( $tmem->isBlogAdmin($blogid) )
		{
			/* TODO: why we did double check? */
			// check if there are more blog members left and at least one admin
			// (check for at least two admins before deletion)
			$query = "SELECT * FROM %s WHERE tblog=%d and tadmin=1;";
			$query = sprintf($query, sql_table('team'), (integer) $blogid);
			$r     = DB::getResult($query);
			if ( $r->rowCount() < 2 )
			{
				return _ERROR_ATLEASTONEBLOGADMIN;
			}
		}
		
		$query = "DELETE FROM %s WHERE tblog=%d AND tmember=%d;";
		$query = sprintf($query, sql_table('team'), (integer) $blogid, (integer) $memberid);
		DB::execute($query);
		
		$data = array(
			'member' => &$tmem,
			'blogid' => $blogid
		);
		$manager->notify('PostDeleteTeamMember', $data);
		
		return '';
	}
	
	/**
	 * Admin::action_teamchangeadmin()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_teamchangeadmin()
	{
		global $manager, $member;
		
		$blogid		= intRequestVar('blogid');
		$memberid	= intRequestVar('memberid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or self::disallow();
		
		$mem =& $manager->getMember($memberid);
		
		// don't allow when there is only one admin at this moment
		if ( $mem->isBlogAdmin($blogid) )
		{
			$query = "SELECT * FROM %s WHERE tblog=%d AND tadmin=1;";
			$query = sprintf($query, sql_table('team'), (integer) $blogid);
			$r = DB::getResult($query);
			if ( $r->rowCount() == 1 )
			{
				self::error(_ERROR_ATLEASTONEBLOGADMIN);
				return;
			}
		}
		
		if ( $mem->isBlogAdmin($blogid) )
		{
			$newval = 0;
		}
		else
		{
			$newval = 1;
		}
		
		$query = "UPDATE %s SET tadmin=%d WHERE tblog=%d and tmember=%d;";
		$query = sprintf($query, (integer) $blogid, (integer) $newval, (integer) $blogid, (integer) $memberid);
		DB::execute($query);
		
		// only show manageteam if member did not change its own admin privileges
		if ( $member->isBlogAdmin($blogid) )
		{
			self::action_manageteam();
		}
		else
		{
			self::action_overview(_MSG_ADMINCHANGED);
		}
		return;
	}
	
	/**
	 * Admin::action_blogsettings()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_blogsettings()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		// check if allowed
		$member->blogAdminRights($blogid) or self::disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/numbercheck.js)%>\"></script>\n";
		
		self::$skin->parse('blogsettings');
		return;
	}
	
	/**
	 * Admin::action_categorynew()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_categorynew()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$cname = postVar('cname');
		$cdesc = postVar('cdesc');
		
		if ( !isValidCategoryName($cname) )
		{
			self::error(_ERROR_BADCATEGORYNAME);
			return;
		}
		
		$query = "SELECT * FROM %s WHERE cname=%s AND cblog=%d;";
		$query = sprintf($query, sql_table('category'), DB::quoteValue($cname), (integer) $blogid);
		$res = DB::getResult($query);
		if ( $res->rowCount() > 0 )
		{
			self::error(_ERROR_DUPCATEGORYNAME);
			return;
		}
		
		$blog		=& $manager->getBlog($blogid);
		$newCatID	=  $blog->createNewCategory($cname, $cdesc);
		
		self::action_blogsettings();
		return;
	}
	
	/**
	 * Admin::action_categoryedit()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_categoryedit($catid = '', $blogid = '', $desturl = '')
	{
		global $member, $manager;
		
		if ( $blogid == '' )
		{
			$blogid = intGetVar('blogid');
		}
		else
		{
			$blogid = intval($blogid);
		}
		if ( $catid == '' )
		{
			$catid = intGetVar('catid');
		}
		else
		{
			$catid = intval($catid);
		}
		
		/* TODO: we should consider to use the other way insterad of this */
		$_REQUEST['blogid']		= $blogid;
		$_REQUEST['catid']		= $catid;
		$_REQUEST['desturl']	= $desturl;
		$member->blogAdminRights($blogid) or self::disallow();
		
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/numbercheck.js)%>\"></script>\n";
		
		self::$skin->parse('categoryedit');
		return;
	}
	
	/**
	 * Admin::action_categoryupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_categoryupdate()
	{
		global $member, $manager;
		
		$blogid		= intPostVar('blogid');
		$catid		= intPostVar('catid');
		$cname		= postVar('cname');
		$cdesc		= postVar('cdesc');
		$desturl	= postVar('desturl');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		if ( !isValidCategoryName($cname) )
		{
			self::error(_ERROR_BADCATEGORYNAME);
			return;
		}
		
		$query	= "SELECT * FROM %s WHERE cname=%s AND cblog=%d AND not(catid=%d);";
		$query	= sprintf($query, sql_table('category'), DB::quoteValue($cname), (integer) $blogid, (integer) $catid);
		$res	= DB::getResult($query);
		if ( $res->rowCount() > 0 )
		{
			self::error(_ERROR_DUPCATEGORYNAME);
			return;
		}
		
		$query =  "UPDATE %s SET cname=%s, cdesc=%s WHERE catid=%d;";
		$query = sprintf($query, sql_table('category'), DB::quoteValue($cname), DB::quoteValue($cdesc), (integer) $catid);
		DB::execute($query);
		
		// store plugin options
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions);
		$data = array(
			'context'	=> 'category',
			'catid'		=> $catid
		);
		$manager->notify('PostPluginOptionsUpdate', $data);
		
		if ( $desturl )
		{
			redirect($desturl);
			return;
		}
		
		self::action_blogsettings();
		
		return;
	}
	
	/**
	 * Admin::action_categorydelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_categorydelete()
	{
		global $member, $manager;
		
		$blogid	= intRequestVar('blogid');
		$catid	= intRequestVar('catid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		// check if the category is valid
		if ( !$blog->isValidCategory($catid) )
		{
			self::error(_ERROR_NOSUCHCATEGORY);
			return;
		}
		
		// don't allow deletion of default category
		if ( $blog->getDefaultCategory() == $catid )
		{
			self::error(_ERROR_DELETEDEFCATEGORY);
			return;
		}
		
		// check if catid is the only category left for blogid
		$query = "SELECT catid FROM %s WHERE cblog=%d;";
		$query = sprintf($query, sql_table('category'), $blogid);
		$res = DB::getResult($query);
		if ( $res->rowCount() == 1 )
		{
			self::error(_ERROR_DELETELASTCATEGORY);
			return;
		}
		
		self::$skin->parse('categorydelete');
		return;
	}
	
	/**
	 * Admin::action_categorydeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_categorydeleteconfirm()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		$catid  = intRequestVar('catid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$error = self::deleteOneCategory($catid);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::action_blogsettings();
		return;
	}
	
	/**
	 * Admin::deleteOneCategory()
	 * Delete a category by its id
	 * 
	 * @param	String	$catid	category id for deleting
	 * @return	Void
	 */
	static public function deleteOneCategory($catid)
	{
		global $manager, $member;
		
		$catid  = intval($catid);
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
		$query = "SELECT catid FROM %s WHERE cblog=%d;";
		$query = sprintf($query, sql_table('category'), (integer) $blogid);
		
		$res = DB::getResult($query);
		if ( $res->rowCount() == 1 )
		{
			return _ERROR_DELETELASTCATEGORY;
		}
		
		$data = array('catid' => $catid);
		$manager->notify('PreDeleteCategory', $data);
		
		// change category for all items to the default category
		$query = "UPDATE %s SET icat=%d WHERE icat=%d;";
		$query =sprintf($query, sql_table('item'), (integer) $destcatid, (integer) $catid);
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('category', (integer) $catid);
		
		// delete category
		$query = "DELETE FROM %s WHERE catid=%d;";
		$query = sprintf($query, sql_table('category'), (integer) $catid);
		DB::execute($query);
		
		$data = array('catid' => $catid);
		$manager->notify('PostDeleteCategory', $data);
		return;
	}
	
	/**
	 * Admin::moveOneCategory()
	 * Delete a category by its id
	 * 
	 * @param	int	$catid		category id for move
	 * @param	int	$destblogid	blog id for destination
	 * @return	void
	 */
	static public function moveOneCategory($catid, $destblogid)
	{
		global $manager, $member;
		$catid      = intval($catid);
		$destblogid = intval($destblogid);
		$blogid     = getBlogIDFromCatID($catid);
		// mover should have admin rights on both blogs
		if (!$member->blogAdminRights($blogid)) {
			return _ERROR_DISALLOWED;
		}
		if (!$member->blogAdminRights($destblogid)) {
			return _ERROR_DISALLOWED;
		}
		// cannot move to self
		if ($blogid == $destblogid) {
			return _ERROR_MOVETOSELF;
		}
		// get blogs
		$blog     =& $manager->getBlog($blogid);
		$destblog =& $manager->getBlog($destblogid);
		// check if the category is valid
		if (!$blog || !$blog->isValidCategory($catid)) {
			return _ERROR_NOSUCHCATEGORY;
		}
		// don't allow default category to be moved
		if ($blog->getDefaultCategory() == $catid) {
			return _ERROR_MOVEDEFCATEGORY;
		}
		$manager->notify(
				'PreMoveCategory',
				array(
						'catid'      => &$catid,
						'sourceblog' => &$blog,
						'destblog'   => &$destblog
				)
		);
		// update comments table (cblog)
		$query = 'SELECT '
		. '    inumber '
		. 'FROM '
		.      sql_table('item') . ' '
		. 'WHERE '
		. '    icat = %d';
		$items = sql_query(sprintf($query, $catid));
		while ($oItem = sql_fetch_object($items)) {
			$query = 'UPDATE '
			.      sql_table('comment') . ' '
			. 'SET '
			. '    cblog = %d' . ' '
			. 'WHERE '
			. '    citem = %d';
			sql_query(sprintf($query, $destblogid, $oItem->inumber));
		}
	
		// update items (iblog)
		$query = 'UPDATE '
		.      sql_table('item') . ' '
		. 'SET '
		. '    iblog = %d '
		. 'WHERE '
		. '    icat = %d';
		sql_query(sprintf($query, $destblogid, $catid));
	
		// move category
		$query = 'UPDATE '
		.      sql_table('category') . ' '
		. 'SET '
		. '    cblog = %d' . ' '
		. 'WHERE '
		. '    catid = %d';
		sql_query(sprintf($query, $destblogid, $catid));
		$manager->notify(
				'PostMoveCategory',
				array(
						'catid'      => &$catid,
						'sourceblog' => &$blog,
						'destblog'   => $destblog
				)
		);
		return;
	}

	/**
	 * Admin::action_blogsettingsupdate
	 * Updating blog settings
	 * 
	 * @param	Void
	 * @return	Void
	 */
	static private function action_blogsettingsupdate()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$blog =& $manager->getBlog($blogid);
		
		$notify_address	= trim(postVar('notify'));
		$shortname		= trim(postVar('shortname'));
		$updatefile		= trim(postVar('update'));
		
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
			self::error(_ERROR_BADNOTIFY);
			return;
		}
		
		if ( !isValidShortName($shortname) )
		{
			self::error(_ERROR_BADSHORTBLOGNAME);
			return;
		}
		
		if ( ($blog->getShortName() != $shortname) && $manager->existsBlog($shortname) )
		{
			self::error(_ERROR_DUPSHORTBLOGNAME);
			return;
		}
		// check if update file is writable
		if ( $updatefile && !is_writeable($updatefile) )
		{
			self::error(_ERROR_UPDATEFILE);
			return;
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
		
		$data = array(
			'context' => 'blog',
			'blogid'  => $blogid,
			'blog'    => &$blog
		);
		$manager->notify('PostPluginOptionsUpdate', $data);
		
		self::action_overview(_MSG_SETTINGSCHANGED);
		return;
	}
	
	/**
	 * Admin::action_deleteblog()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_deleteblog()
	{
		global $member, $CONF, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		// check if blog is default blog
		if ( $CONF['DefaultBlog'] == $blogid )
		{
			self::error(_ERROR_DELDEFBLOG);
			return;
		}
		
		$blog =& $manager->getBlog($blogid);
		
		self::$skin->parse('deleteblog');
		return;
	}
	
	/**
	 * Admin::action_deleteblogconfirm()
	 * Delete Blog
	 * 
	 * @param	Void
	 * @return	Void
	 */
	static private function action_deleteblogconfirm()
	{
		global $member, $CONF, $manager;
		
		$blogid = intRequestVar('blogid');
		
		$data = array('blogid' => $blogid);
		$manager->notify('PreDeleteBlog', $data);
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		// check if blog is default blog
		if ( $CONF['DefaultBlog'] == $blogid )
		{
			self::error(_ERROR_DELDEFBLOG);
			return;
		}
		
		// delete all comments
		$query = 'DELETE FROM ' . sql_table('comment') . ' WHERE cblog='.$blogid;
		DB::execute($query);
		
		// delete all items
		$query = 'DELETE FROM ' . sql_table('item') . ' WHERE iblog=' . $blogid;
		DB::execute($query);
		
		// delete all team members
		$query = 'DELETE FROM ' . sql_table('team') . ' WHERE tblog=' . $blogid;
		DB::execute($query);
		
		// delete all bans
		$query = 'DELETE FROM ' . sql_table('ban') . ' WHERE blogid=' . $blogid;
		DB::execute($query);
		
		// delete all categories
		$query = 'DELETE FROM ' . sql_table('category') . ' WHERE cblog=' . $blogid;
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('blog', $blogid);
		
		// delete the blog itself
		$query = 'DELETE FROM ' . sql_table('blog') . ' WHERE bnumber=' . $blogid;
		DB::execute($query);
		
		$data = array('blogid' => $blogid);
		$manager->notify('PostDeleteBlog', $data);
		
		self::action_overview(_DELETED_BLOG);
		return;
	}
	
	/**
	 * Admin::action_memberdelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_memberdelete()
	{
		global $member, $manager;
		
		$memberid = intRequestVar('memberid');
		
		($member->getID() == $memberid) or $member->isAdmin() or self::disallow();
		
		$mem =& $manager->getMember($memberid);
		
		self::$skin->parse('memberdelete');
		return;
	}
	
	/**
	 * Admin::action_memberdeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_memberdeleteconfirm()
	{
		global $member;
		
		$memberid = intRequestVar('memberid');
		
		($member->getID() == $memberid) or $member->isAdmin() or self::disallow();
		
		$error = self::deleteOneMember($memberid);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		if ( $member->isAdmin() )
		{
			self::action_usermanagement();
			return;
		}
		else
		{
			self::action_overview(_DELETED_MEMBER);
			return;
		}
		return;
	}
	
	/**
	 * Admin::deleteOneMember()
	 * Delete a member by id
	 * 
	 * @static
	 * @params	Integer	$memberid	member id
	 * @return	String	null string or error messages
	 */
	static public function deleteOneMember($memberid)
	{
		global $manager;
		
		$memberid = intval($memberid);
		$mem =& $manager->getMember($memberid);
		
		if ( !$mem->canBeDeleted() )
		{
			return _ERROR_DELETEMEMBER;
		}
		
		$data = array('member' => &$mem);
		$manager->notify('PreDeleteMember', $data);
		
		/* unlink comments from memberid */
		if ( $memberid )
		{
			$query = "UPDATE %s SET cmember=0, cuser=%s WHERE cmember=%d;";
			$query = sprintf($query, sql_table('comment'), DB::quoteValue($mem->getDisplayName()), $memberid);
			DB::execute($query);
		}
		
		$query = 'DELETE FROM ' . sql_table('member') . ' WHERE mnumber=' . $memberid;
		DB::execute($query);
		
		$query = 'DELETE FROM ' . sql_table('team') . ' WHERE tmember=' . $memberid;
		DB::execute($query);
		
		$query = 'DELETE FROM ' . sql_table('activation') . ' WHERE vmember=' . $memberid;
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('member', $memberid);
		
		$data = array('member' => &$mem);
		$manager->notify('PostDeleteMember', $data);
		
		return '';
	}
	
	/**
	 * Admin::action_createnewlog()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_createnewlog()
	{
		global $member, $CONF, $manager;
		
		// Only Super-Admins can do this
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('createnewlog');
		return;
	}
	
	/**
	 * Admin::action_addnewlog()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_addnewlog()
	{
		global $member, $manager, $CONF;
		
		// Only Super-Admins can do this
		$member->isAdmin() or self::disallow();
		
		$bname			= trim(postVar('name'));
		$bshortname		= trim(postVar('shortname'));
		$btimeoffset	= postVar('timeoffset');
		$bdesc			= trim(postVar('desc'));
		$bdefskin		= postVar('defskin');
		
		if ( !isValidShortName($bshortname) )
		{
			self::error(_ERROR_BADSHORTBLOGNAME);
			return;
		}
		
		if ( $manager->existsBlog($bshortname) )
		{
			self::error(_ERROR_DUPSHORTBLOGNAME);
			return;
		}
		
		$data = array(
			'name'        => &$bname,
			'shortname'   => &$bshortname,
			'timeoffset'  => &$btimeoffset,
			'description' => &$bdesc,
			'defaultskin' => &$bdefskin
		);
		$manager->notify('PreAddBlog', $data);
		
		// add slashes for sql queries
		$bname			= DB::quoteValue($bname);
		$bshortname		= DB::quoteValue($bshortname);
		$btimeoffset	= DB::quoteValue($btimeoffset);
		$bdesc			= DB::quoteValue($bdesc);
		$bdefskin		= DB::quoteValue($bdefskin);
		
		// create blog
		$query = "INSERT INTO %s (bname, bshortname, bdesc, btimeoffset, bdefskin) VALUES (%s, %s, %s, %s, %s);";
		$query = sprintf($query, sql_table('blog'), $bname, $bshortname, $bdesc, $btimeoffset, $bdefskin);
		DB::execute($query);
		
		$blogid = DB::getInsertId();
		$blog   =& $manager->getBlog($blogid);
		
		// create new category
		$catdefname = (!defined('_EBLOGDEFAULTCATEGORY_NAME') ? 'General' : _EBLOGDEFAULTCATEGORY_NAME);
		$catdefdesc = (!defined('_EBLOGDEFAULTCATEGORY_DESC') ? 'Items that do not fit in other categories' : _EBLOGDEFAULTCATEGORY_DESC);
		
		$query = 'INSERT INTO %s (cblog, cname, cdesc) VALUES (%d, %s, %s)';
		DB::execute(sprintf($query, sql_table('category'), (integer) $blogid, DB::quoteValue($catdefname), DB::quoteValue($catdefdesc)));
		$catid = DB::getInsertId();
		
		// set as default category
		$blog->setDefaultCategory($catid);
		$blog->writeSettings();
		
		// create team member
		$query = "INSERT INTO %s (tmember, tblog, tadmin) VALUES (%d, %d, 1);";
		$query = sprintf($query, sql_table('team'), (integer) $member->getID(), (integer) $blogid);
		DB::execute($query);
		
		$itemdeftitle = (defined('_EBLOG_FIRSTITEM_TITLE') ? _EBLOG_FIRSTITEM_TITLE : 'First Item');
		$itemdefbody  = (defined('_EBLOG_FIRSTITEM_BODY')  ? _EBLOG_FIRSTITEM_BODY  : 'This is the first item in your weblog. Feel free to delete it.');
		
		$blog->additem(
			$blog->getDefaultCategory(),
			$itemdeftitle,$itemdefbody,
			'',
			$blogid,
			$member->getID(),
			$blog->getCorrectTime(),
			0,
			0,
			0
		);
		
		$data = array('blog' => &$blog);
		$manager->notify('PostAddBlog', $data);
		
		$data = array(
			'blog'			=> &$blog,
			'name'			=> _EBLOGDEFAULTCATEGORY_NAME,
			'description'	=> _EBLOGDEFAULTCATEGORY_DESC,
			'catid'			=> $catid
		);
		$manager->notify('PostAddCategory', $data);
		
		/* TODO: we should consider to use the other way insterad of this */
		$_REQUEST['blogid'] = $blogid;
		$_REQUEST['catid']  = $catid;
		self::$skin->parse('addnewlog');
		return;
	}
	
	/**
	 * Admin::action_addnewlog2()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_addnewlog2()
	{
		global $member, $manager;
		$blogid = intRequestVar('blogid');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$burl = requestVar('url');
		
		$blog =& $manager->getBlog($blogid);
		$blog->setURL(trim($burl));
		$blog->writeSettings();
		
		self::action_overview(_MSG_NEWBLOG);
		return;
	}
	
	/**
	 * Admin::action_skinieoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinieoverview()
	{
		global $member, $DIR_LIBS, $manager;
		
		$member->isAdmin() or self::disallow();
		
		include_once($DIR_LIBS . 'skinie.php');
		
		self::$skin->parse('skinieoverview');
		return;
	}
	
	/**
	 * Admin::action_skinieimport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinieimport()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinFileRaw = postVar('skinfile');
		$mode = postVar('mode');
		
		$error = self::skinieimport($mode, $skinFileRaw);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::$skin->parse('skinieimport');
		return;
	}
	
	/**
	 * Admin::action_skiniedoimport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skiniedoimport()
	{
		global $member, $DIR_LIBS, $DIR_SKINS;
		
		$member->isAdmin() or self::disallow();
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		$mode = postVar('mode');
		$skinFileRaw = postVar('skinfile');
		$allowOverwrite = intPostVar('overwrite');
		
		$error = self::skiniedoimport($mode, $skinFileRaw, $allowOverwrite);
		if ( $error )
		{
			self::error($msg);
			return;
		}
		
		self::$skin->parse('skiniedoimport');
		return;
	}
	
	/**
	 * Admin::action_skinieexport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinieexport()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$aSkins = requestIntArray('skin');
		$aTemplates = requestIntArray('template');
		$info = postVar('info');
		
		self::skinieexport($aSkins, $aTemplates, $info);
		
		return;
	}
	
	/**
	 * Admin::action_templateoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templateoverview()
	{
		global $member, $manager;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('templateoverview');
		return;
	}
	
	/**
	 * Admin::action_templateedit()
	 * 
	 * @param	string	$msg	message for pageheader
	 * @return	void
	 */
	static private function action_templateedit($msg = '')
	{
		global $member, $manager;
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or self::disallow();
		
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(javascript/templateEdit.js)%>\"></script>\n";
		self::$extrahead .= "<script type=\"text/javascript\">setTemplateEditText('" . Entity::hsc(_EDITTEMPLATE_EMPTY) . "');</script>\n";
		
		self::$skin->parse('templateedit');
		return;
	}
	
	/**
	 * Admin::action_templateupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templateupdate()
	{
		global $member,$manager;
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or self::disallow();
		
		$name = postVar('tname');
		$desc = postVar('tdesc');
		
		if ( !isValidTemplateName($name) )
		{
			self::error(_ERROR_BADTEMPLATENAME);
			return;
		}
		
		if ( (Template::getNameFromId($templateid) != $name) && Template::exists($name) )
		{
			self::error(_ERROR_DUPTEMPLATENAME);
			return;
		}
		
		// 1. Remove all template parts
		$query = "DELETE FROM %s WHERE tdesc=%d;";
		$query = sprintf($query, sql_table('template'), (integer) $templateid);
		DB::execute($query);
		
		// 2. Update description
		$query = "UPDATE %s SET tdname=%s, tddesc=%s WHERE tdnumber=%d;";
		$query = sprintf($query, sql_table('template_desc'), DB::quoteValue($name), DB::quoteValue($desc), (integer) $templateid);
		DB::execute($query);
		
		// 3. Add non-empty template parts
		self::addToTemplate($templateid, 'ITEM_HEADER',			postVar('ITEM_HEADER'));
		self::addToTemplate($templateid, 'ITEM',				postVar('ITEM'));
		self::addToTemplate($templateid, 'ITEM_FOOTER',			postVar('ITEM_FOOTER'));
		self::addToTemplate($templateid, 'MORELINK',			postVar('MORELINK'));
		self::addToTemplate($templateid, 'EDITLINK',			postVar('EDITLINK'));
		self::addToTemplate($templateid, 'NEW',					postVar('NEW'));
		self::addToTemplate($templateid, 'COMMENTS_HEADER',		postVar('COMMENTS_HEADER'));
		self::addToTemplate($templateid, 'COMMENTS_BODY', 		postVar('COMMENTS_BODY'));
		self::addToTemplate($templateid, 'COMMENTS_FOOTER',		postVar('COMMENTS_FOOTER'));
		self::addToTemplate($templateid, 'COMMENTS_CONTINUED',	postVar('COMMENTS_CONTINUED'));
		self::addToTemplate($templateid, 'COMMENTS_TOOMUCH',	postVar('COMMENTS_TOOMUCH'));
		self::addToTemplate($templateid, 'COMMENTS_AUTH',		postVar('COMMENTS_AUTH'));
		self::addToTemplate($templateid, 'COMMENTS_ONE',		postVar('COMMENTS_ONE'));
		self::addToTemplate($templateid, 'COMMENTS_MANY',		postVar('COMMENTS_MANY'));
		self::addToTemplate($templateid, 'COMMENTS_NONE',		postVar('COMMENTS_NONE'));
		self::addToTemplate($templateid, 'ARCHIVELIST_HEADER',	postVar('ARCHIVELIST_HEADER'));
		self::addToTemplate($templateid, 'ARCHIVELIST_LISTITEM', postVar('ARCHIVELIST_LISTITEM'));
		self::addToTemplate($templateid, 'ARCHIVELIST_FOOTER',	postVar('ARCHIVELIST_FOOTER'));
		self::addToTemplate($templateid, 'BLOGLIST_HEADER',		postVar('BLOGLIST_HEADER'));
		self::addToTemplate($templateid, 'BLOGLIST_LISTITEM',	postVar('BLOGLIST_LISTITEM'));
		self::addToTemplate($templateid, 'BLOGLIST_FOOTER',		postVar('BLOGLIST_FOOTER'));
		self::addToTemplate($templateid, 'CATLIST_HEADER',		postVar('CATLIST_HEADER'));
		self::addToTemplate($templateid, 'CATLIST_LISTITEM',	postVar('CATLIST_LISTITEM'));
		self::addToTemplate($templateid, 'CATLIST_FOOTER',		postVar('CATLIST_FOOTER'));
		self::addToTemplate($templateid, 'DATE_HEADER',			postVar('DATE_HEADER'));
		self::addToTemplate($templateid, 'DATE_FOOTER',			postVar('DATE_FOOTER'));
		self::addToTemplate($templateid, 'FORMAT_DATE',			postVar('FORMAT_DATE'));
		self::addToTemplate($templateid, 'FORMAT_TIME',			postVar('FORMAT_TIME'));
		self::addToTemplate($templateid, 'SEARCH_HIGHLIGHT',	postVar('SEARCH_HIGHLIGHT'));
		self::addToTemplate($templateid, 'SEARCH_NOTHINGFOUND', postVar('SEARCH_NOTHINGFOUND'));
		self::addToTemplate($templateid, 'POPUP_CODE',			postVar('POPUP_CODE'));
		self::addToTemplate($templateid, 'MEDIA_CODE',			postVar('MEDIA_CODE'));
		self::addToTemplate($templateid, 'IMAGE_CODE',			postVar('IMAGE_CODE'));
		
		$data = array('fields' => array());
		$manager->notify('TemplateExtraFields', $data);
		foreach ( $data['fields'] as $pfkey=>$pfvalue )
		{
			foreach ( $pfvalue as $pffield => $pfdesc )
			{
				self::addToTemplate($templateid, $pffield, postVar($pffield));
			}
		}
		
		// jump back to template edit
		self::action_templateedit(_TEMPLATE_UPDATED);
		return;
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
	static private function addToTemplate($id, $partname, $content)
	{
		// don't add empty parts:
		if ( !trim($content) )
		{
			return -1;
		}
		
		$query = "INSERT INTO %s (tdesc, tpartname, tcontent) VALUES (%d, %s, %s);";
		$query = sprintf($query, sql_table('template'), (integer) $id, DB::quoteValue($partname), DB::quoteValue($content));
		if ( DB::execute($query) === FALSE )
		{
			$err = DB::getError();
			exit(_ADMIN_SQLDIE_QUERYERROR . $err[2]);
		}
		return DB::getInsertId();
	}
	
	/**
	 * Admin::action_templatedelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templatedelete()
	{
		global $member, $manager;
		
		$member->isAdmin() or self::disallow();
		
		$templateid = intRequestVar('templateid');
		// TODO: check if template can be deleted
		
		self::$skin->parse('templatedelete');
		return;
	}
	
	/**
	 * Admin::action_templatedeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templatedeleteconfirm()
	{
		global $member, $manager;
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or self::disallow();
		
		$data = array('templateid' => $templateid);
		$manager->notify('PreDeleteTemplate', $data);
		
		// 1. delete description
		DB::execute('DELETE FROM ' . sql_table('template_desc') . ' WHERE tdnumber=' . $templateid);
		
		// 2. delete parts
		DB::execute('DELETE FROM ' . sql_table('template') . ' WHERE tdesc=' . $templateid);
		
		
		$data = array('templateid' => $templateid);
		$manager->notify('PostDeleteTemplate', $data);
		
		self::action_templateoverview();
		return;
	}
	
	/**
	 * Admin::action_templatenew()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templatenew()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$name = postVar('name');
		$desc = postVar('desc');
		
		if ( !isValidTemplateName($name) )
		{
			self::error(_ERROR_BADTEMPLATENAME);
			return;
		}
		
		if ( Template::exists($name) )
		{
			self::error(_ERROR_DUPTEMPLATENAME);
			return;
		}
		
		$newTemplateId = Template::createNew($name, $desc);
		
		self::action_templateoverview();
		return;
	}
	
	/**
	 * Admin::action_templateclone()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_templateclone()
	{
		global $member;
		
		$templateid = intRequestVar('templateid');
		
		$member->isAdmin() or self::disallow();
		
		// 1. read old template
		$name = Template::getNameFromId($templateid);
		$desc = Template::getDesc($templateid);
		
		// 2. create desc thing
		$name = "cloned" . $name;
		
		// if a template with that name already exists:
		if ( Template::exists($name) )
		{
			$i = 1;
			while (Template::exists($name . $i))
			{
				$i++;
			}
			$name .= $i;
		}
		
		$newid = Template::createNew($name, $desc);
		
		// 3. create clone
		// go through parts of old template and add them to the new one
		$query = "SELECT tpartname, tcontent FROM %s WHERE tdesc=%d;";
		$query = sprintf($query, sql_table('template'), (integer) $templateid);
		
		$res = DB::getResult($query);
		foreach ( $res as $row)
		{
			self::addToTemplate($newid, $row['tpartname'], $row['tcontent']);
		}
		
		self::action_templateoverview();
		return;
	}
	
	/**
	 * Admin::action_admintemplateoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplateoverview()
	{
		global $member;
		$member->isAdmin() or self::disallow();
		self::$skin->parse('admntemplateoverview');
		return;
	}
	
	/**
	 * Admin::action_admintemplateedit()
	 * 
	 * @param	string	$msg	message for pageheader
	 * @return	void
	 */
	static private function action_admintemplateedit($msg = '')
	{
		global $member, $manager;
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		$member->isAdmin() or self::disallow();
		
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(javascript/templateEdit.js)%>\"></script>\n";
		self::$extrahead .= '<script type="text/javascript">setTemplateEditText("' . Entity::hsc(_EDITTEMPLATE_EMPTY) . '");</script>' . "\n";
		
		self::$skin->parse('admintemplateedit');
		return;
	}
	
	/**
	 * Admin::action_admintemplateupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplateupdate()
	{
		global $member, $manager;
		$templateid = intRequestVar('templateid');
		$member->isAdmin() or self::disallow();
		$name = postVar('tname');
		$desc = postVar('tdesc');
		
		if ( !isValidTemplateName($name) )
		{
			self::error(_ERROR_BADTEMPLATENAME);
			return;
		}
		
		if ( (Template::getNameFromId($templateid) != $name) && Template::exists($name) )
		{
			self::error(_ERROR_DUPTEMPLATENAME);
			return;
		}
		
		// 1. Remove all template parts
		$query = "DELETE FROM %s WHERE tdesc=%d;";
		$query = sprintf($query, sql_table('template'), (integer) $templateid);
		DB::execute($query);
		
		// 2. Update description
		$query = "UPDATE %s SET tdname=%s, tddesc=%s WHERE tdnumber=%d;";
		$query = sprintf($query, sql_table('template_desc'), DB::quoteValue($name), DB::quoteValue($desc), (integer) $templateid);
		DB::execute($query);
		
		// 3. Add non-empty template parts
		self::addToTemplate($templateid, 'NORMALSKINLIST_HEAD',						postVar('NORMALSKINLIST_HEAD'));
		self::addToTemplate($templateid, 'NORMALSKINLIST_BODY',						postVar('NORMALSKINLIST_BODY'));
		self::addToTemplate($templateid, 'NORMALSKINLIST_FOOT',						postVar('NORMALSKINLIST_FOOT'));
		self::addToTemplate($templateid, 'ADMIN_CUSTOMHELPLINK_ICON',				postVar('ADMIN_CUSTOMHELPLINK_ICON'));
		self::addToTemplate($templateid, 'ADMIN_CUSTOMHELPLINK_ANCHOR',				postVar('ADMIN_CUSTOMHELPLINK_ANCHOR'));
		self::addToTemplate($templateid, 'ADMIN_BLOGLINK',							postVar('ADMIN_BLOGLINK'));
		self::addToTemplate($templateid, 'ADMIN_BATCHLIST',							postVar('ADMIN_BATCHLIST'));
		self::addToTemplate($templateid, 'ACTIVATE_FORGOT_TITLE',					postVar('ACTIVATE_FORGOT_TITLE'));
		self::addToTemplate($templateid, 'ACTIVATE_FORGOT_TEXT',					postVar('ACTIVATE_FORGOT_TEXT'));
		self::addToTemplate($templateid, 'ACTIVATE_REGISTER_TITLE',					postVar('ACTIVATE_REGISTER_TITLE'));
		self::addToTemplate($templateid, 'ACTIVATE_REGISTER_TEXT',					postVar('ACTIVATE_REGISTER_TEXT'));
		self::addToTemplate($templateid, 'ACTIVATE_CHANGE_TITLE',					postVar('ACTIVATE_CHANGE_TITLE'));
		self::addToTemplate($templateid, 'ACTIVATE_CHANGE_TEXT',					postVar('ACTIVATE_CHANGE_TEXT'));
		self::addToTemplate($templateid, 'TEMPLATE_EDIT_EXPLUGNAME',				postVar('TEMPLATE_EDIT_EXPLUGNAME'));
		self::addToTemplate($templateid, 'TEMPLATE_EDIT_ROW_HEAD',					postVar('TEMPLATE_EDIT_ROW_HEAD'));
		self::addToTemplate($templateid, 'TEMPLATE_EDIT_ROW_TAIL',					postVar('TEMPLATE_EDIT_ROW_TAIL'));
		self::addToTemplate($templateid, 'SPECIALSKINLIST_HEAD',					postVar('SPECIALSKINLIST_HEAD'));
		self::addToTemplate($templateid, 'SPECIALSKINLIST_BODY',					postVar('SPECIALSKINLIST_BODY'));
		self::addToTemplate($templateid, 'SPECIALSKINLIST_FOOT',					postVar('SPECIALSKINLIST_FOOT'));
		self::addToTemplate($templateid, 'SYSTEMINFO_GDSETTINGS',					postVar('SYSTEMINFO_GDSETTINGS'));
		self::addToTemplate($templateid, 'BANLIST_DELETED_LIST',					postVar('BANLIST_DELETED_LIST'));
		self::addToTemplate($templateid, 'INSERT_PLUGOPTION_TITLE',					postVar('INSERT_PLUGOPTION_TITLE'));
		self::addToTemplate($templateid, 'INSERT_PLUGOPTION_BODY',					postVar('INSERT_PLUGOPTION_BODY'));
		self::addToTemplate($templateid, 'INPUTYESNO_TEMPLATE_ADMIN',				postVar('INPUTYESNO_TEMPLATE_ADMIN'));
		self::addToTemplate($templateid, 'INPUTYESNO_TEMPLATE_NORMAL',				postVar('INPUTYESNO_TEMPLATE_NORMAL'));
		self::addToTemplate($templateid, 'ADMIN_SPECIALSKINLIST_HEAD',				postVar('ADMIN_SPECIALSKINLIST_HEAD'));
		self::addToTemplate($templateid, 'ADMIN_SPECIALSKINLIST_BODY',				postVar('ADMIN_SPECIALSKINLIST_BODY'));
		self::addToTemplate($templateid, 'ADMIN_SPECIALSKINLIST_FOOT',				postVar('ADMIN_SPECIALSKINLIST_FOOT'));
		self::addToTemplate($templateid, 'SKINIE_EXPORT_LIST',						postVar('SKINIE_EXPORT_LIST'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_SELECT_HEAD',			postVar('SHOWLIST_LISTPLUG_SELECT_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_SELECT_BODY',			postVar('SHOWLIST_LISTPLUG_SELECT_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_SELECT_FOOT',			postVar('SHOWLIST_LISTPLUG_SELECT_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_HEAD',			postVar('SHOWLIST_LISTPLUG_TABLE_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BODY',			postVar('SHOWLIST_LISTPLUG_TABLE_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_FOOT',			postVar('SHOWLIST_LISTPLUG_TABLE_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_MEMBLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_MEMBLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_MEMBLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TEAMLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TEAMLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TEAMLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_GURL',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_GURL'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGEVENTLIST',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGEVENTLIST'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGNEDUPDATE',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGNEDUPDATE'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPEND',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPEND'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPREQ',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPREQ'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLISTFALSE',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLISTFALSE'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ACTN',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ACTN'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ADMN',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ADMN'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HELP',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HELP'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGOPTSETURL',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGOPTSETURL'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_POPTLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_POPTLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_POPTLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_POPTLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OYESNO',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OYESNO'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OPWORD',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OPWORD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEP',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEP'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEO',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEO'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEC',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEC'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OTAREA',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OTAREA'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLGOPT_OITEXT',	postVar('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OITEXT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_PLUGOPTN_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_PLUGOPTN_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_POPTLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_POPTLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ITEMLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ITEMLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ITEMLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CMNTLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CMNTLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CMNTLIST_ABAN',	postVar('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_ABAN'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CMNTLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM',	postVar('SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLIST_BD_SADM',	postVar('SHOWLIST_LISTPLUG_TABLE_BLIST_BD_SADM'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SHORTNAM_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SHORTNAM_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SHORTNAM_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CATELIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_CATELIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CATELIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_CATELIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_CATELIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_CATELIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TPLTLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TPLTLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_TPLTLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SKINLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_SKINLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SKINLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_SKINLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_SKINLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_SKINLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_DRFTLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_DRFTLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_DRFTLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ACTNLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ACTNLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_ACTNLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_FOOT'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_IBANLIST_HEAD',	postVar('SHOWLIST_LISTPLUG_TABLE_IBANLIST_HEAD'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_IBANLIST_BODY',	postVar('SHOWLIST_LISTPLUG_TABLE_IBANLIST_BODY'));
		self::addToTemplate($templateid, 'SHOWLIST_LISTPLUG_TABLE_IBANLIST_FOOT',	postVar('SHOWLIST_LISTPLUG_TABLE_IBANLIST_FOOT'));
		self::addToTemplate($templateid, 'PLUGIN_QUICKMENU_TITLE',					postVar('PLUGIN_QUICKMENU_TITLE'));
		self::addToTemplate($templateid, 'PLUGIN_QUICKMENU_HEAD',					postVar('PLUGIN_QUICKMENU_HEAD'));
		self::addToTemplate($templateid, 'PLUGIN_QUICKMENU_BODY',					postVar('PLUGIN_QUICKMENU_BODY'));
		self::addToTemplate($templateid, 'PLUGIN_QUICKMENU_FOOT',					postVar('PLUGIN_QUICKMENU_FOOT'));
		
		$data = array('fields' => array());
		$manager->notify('AdminTemplateExtraFields', $data);
		foreach ( $data['fields'] as $pfkey => $pfvalue )
		{
			foreach ( $pfvalue as $pffield => $pfdesc )
			{
				self::addToTemplate($templateid, $pffield, postVar($pffield));
			}
		}
		
		// jump back to template edit
		self::action_admintemplateedit(_TEMPLATE_UPDATED);
		return;
	}
	
	/**
	 * Admin::action_admintemplatedelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplatedelete()
	{
		global $member, $manager;
		$member->isAdmin() or self::disallow();
		
		// TODO: check if template can be deleted
		self::$skin->parse('admintemplatedelete');
		return;
	}
	
	/**
	 * Admin::action_admintemplatedeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplatedeleteconfirm()
	{
		global $member, $manager;
		
		$templateid = intRequestVar('templateid');
		$member->isAdmin() or self::disallow();
		
		$data = array('templateid' => $templateid);
		$manager->notify('PreDeleteAdminTemplate', $data);
		
		// 1. delete description
		$query = "DELETE FROM %s WHERE tdnumber=%s;";
		$query = sprintf($query, sql_table('template_desc'), (integer) $templateid);
		DB::execute($query);
		
		// 2. delete parts
		$query = "DELETE FROM %s WHERE tdesc=%d;";
		$query = sprintf($query, sql_table('template'), (integer) $templateid);
		DB::execute($query);
		
		$data = array('templateid' => $templateid);
		$manager->notify('PostDeleteAdminTemplate', $data);
		
		self::action_admintemplateoverview();
		return;
	}
	
	/**
	 * Admin::action_admintemplatenew()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplatenew()
	{
		global $member;
		$member->isAdmin() or self::disallow();
		$name = postVar('name');
		$desc = postVar('desc');
		
		if ( !isValidTemplateName($name) )
		{
			self::error(_ERROR_BADTEMPLATENAME);
			return;
		}
		else if ( !preg_match('#^admin/#', $name) )
		{
			self::error(_ERROR_BADADMINTEMPLATENAME);
			return;
		}
		else if ( Template::exists($name) )
		{
			self::error(_ERROR_DUPTEMPLATENAME);
			return;
		}
		
		$newTemplateId = Template::createNew($name, $desc);
		self::action_admintemplateoverview();
		return;
	}
	
	/**
	 * Admin::action_admintemplateclone()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_admintemplateclone()
	{
		global $member;
		$templateid = intRequestVar('templateid');
		$member->isAdmin() or self::disallow();
		
		// 1. read old template
		$name = Template::getNameFromId($templateid);
		$desc = Template::getDesc($templateid);
		
		// 2. create desc thing
		$name = $name . "cloned";
		
		// if a template with that name already exists:
		if ( Template::exists($name) )
		{
			$i = 1;
			while ( Template::exists($name . $i) )
			{
				$i++;
			}
			$name .= $i;
		}
		
		$newid = Template::createNew($name, $desc);
		
		// 3. create clone
		// go through parts of old template and add them to the new one
		$query = "SELECT tpartname, tcontent FROM %s WHERE tdesc=%d;";
		$query = sprintf($query, sql_table('template'), (integer) $templateid);
		
		$res = DB::getResult($query);
		foreach ( $res as $row )
		{
			self::addToTemplate($newid, $row['tpartname'], $row['tcontent']);
		}
		
		self::action_admintemplateoverview();
		return;
	}

	/**
	 * Admin::action_skinoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinoverview()
	{
		global $member, $manager;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('skinoverview');
		return;
	}
	
	/**
	 * Admin::action_skinnew()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinnew()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$name = trim(postVar('name'));
		$desc = trim(postVar('desc'));
		
		if ( !isValidSkinName($name) )
		{
			self::error(_ERROR_BADSKINNAME);
			return;
		}
		else if ( SKIN::exists($name) )
		{
			self::error(_ERROR_DUPSKINNAME);
			return;
		}
		
		SKIN::createNew($name, $desc);
		
		self::action_skinoverview();
		return;
	}
	
	/**
	 * Admin::action_skinedit()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinedit()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('skinedit');
		return;
	}
	
	/**
	 * Admin::action_skineditgeneral()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skineditgeneral()
	{
		global $member;
		
		$skinid = intRequestVar('skinid');
		
		$member->isAdmin() or self::disallow();
		
		$error = self::skineditgeneral($skinid);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::action_skinedit();
		return;
	}
	
	static private function action_skinedittype($msg = '')
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		
		$type = requestVar('type');
		$type = trim($type);
		$type = strtolower($type);
		
		if ( !isValidShortName($type) )
		{
			self::error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
			return;
		}
		
		self::$skin->parse('skinedittype');
		return;
	}
	
	/**
	 * Admin::action_skinupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinupdate()
	{
		global $manager, $member;
		
		$skinid = intRequestVar('skinid');
		$content = trim(postVar('content'));
		$type = postVar('type');
		
		$member->isAdmin() or self::disallow();
		
		$skin =& $manager->getSKIN($skinid);
		$skin->update($type, $content);
		
		self::action_skinedittype(_SKIN_UPDATED);
		return;
	}
	
	/**
	 * Admin::action_skindelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skindelete()
	{
		global $CONF, $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		// don't allow default skin to be deleted
		if ( $skinid == $CONF['BaseSkin'] )
		{
			self::error(_ERROR_DEFAULTSKIN);
			return;
		}
		
		// don't allow deletion of default skins for blogs
		$query = "SELECT bname FROM %s WHERE bdefskin=%d";
		$query = sprintf($query, sql_table('blog'), (integer) $skinid);
		
		$name = DB::getValue($query);
		if ( $name )
		{
			self::error(_ERROR_SKINDEFDELETE . Entity::hsc($name));
			return;
		}
		
		self::$skin->parse('skindelete');
		return;
	}
	
	/**
	 * Admin::action_skindeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skindeleteconfirm()
	{
		global $member, $CONF;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		// don't allow default skin to be deleted
		if ( $skinid == $CONF['BaseSkin'] )
		{
			self::error(_ERROR_DEFAULTSKIN);
			return;
		}
		
		// don't allow deletion of default skins for blogs
		$query = "SELECT bname FROM %s WHERE bdefskin=%d;";
		$query = sprintf($query, sql_table('blog'), (integer) $skinid);
		
		$name = DB::getValue($query);
		if ( $name )
				{
			self::error(_ERROR_SKINDEFDELETE . Entity::hsc($name));
			return;
		}
		
		self::skindeleteconfirm($skinid);
		
		self::action_skinoverview();
		return;
	}
	
	/**
	 * Admin::action_skinremovetype()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinremovetype()
	{
		global $member, $CONF;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		if ( !isValidShortName($skintype) )
		{
			self::error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
			return;
		}
		
		self::$skin->parse('skinremovetype');
		return;
	}
	
	/**
	 * Admin::action_skinremovetypeconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinremovetypeconfirm()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		$error = self::skinremovetypeconfirm($skinid, $skintype);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::action_skinedit();
		return;
	}
	
	/**
	 * Admin::action_skinclone()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_skinclone()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		self::skinclone($skinid);
		
		self::action_skinoverview();
		return;
	}
	
	/**
	 * Admin::action_adminskinoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinoverview()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('adminskinoverview');
		return;
	}
	
	/**
	 * Admin::action_adminskinnew()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinnew()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$name = trim(postVar('name'));
		$desc = trim(postVar('desc'));
		
		if ( !isValidSkinName($name) )
		{
			self::error(_ERROR_BADSKINNAME);
			return;
		}
		else if ( !preg_match('#^admin/#', $name) )
		{
			self::error(_ERROR_BADADMINSKINNAME);
			return;
		}
		else if ( Skin::exists($name) )
		{
			self::error(_ERROR_DUPSKINNAME);
			return;
		}
		
		Skin::createNew($name, $desc);
		
		self::action_adminskinoverview();
		return;
	}
	
	/**
	 * Admin::action_adminskinedit()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinedit()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('adminskinedit');
		
		return;
	}
	
	/**
	 * Admin::action_adminskineditgeneral()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskineditgeneral()
	{
		global $member;
		
		$skinid = intRequestVar('skinid');
		
		$member->isAdmin() or self::disallow();
		
		$error = self::skineditgeneral($skinid, 'AdminActions');
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::action_adminskinedit();
		return;
	}
	
	/**
	 * Admin::action_adminskinedittype()
	 * 
	 * @param	string	$msg	message for pageheader
	 * @return	void
	 */
	static private function action_adminskinedittype($msg = '')
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		if ( $msg )
		{
			self::$headMess = $msg;
		}
		$type = requestVar('type');
		$type = trim($type);
		$type = strtolower($type);
		
		if ( !isValidShortName($type) )
		{
			self::error(_ERROR_SKIN_PARTS_SPECIAL_FORMAT);
			return;
		}
		
		self::$skin->parse('adminskinedittype');
		return;
	}
	
	/**
	 * Admin::action_adminskinupdate()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinupdate()
	{
		global $manager, $member;
		
		$skinid = intRequestVar('skinid');
		$content = trim(postVar('content'));
		$type = postVar('type');
		
		$member->isAdmin() or self::disallow();
		
		$skin =& $manager->getSkin($skinid, 'AdminActions', 'AdminSkin');
		$skin->update($type, $content);
		
		self::action_adminskinedittype(_SKIN_UPDATED);
		return;
	}
	
	/**
	 * Admin::action_adminskindelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskindelete()
	{
		global $CONF, $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		// don't allow default skin to be deleted
		if ( $skinid == $CONF['AdminSkin'] || $skinid == $CONF['BookmarkletSkin'] )
		{
			self::error(_ERROR_DEFAULTSKIN);
			return;
		}
		
		/* don't allow if someone use it as a default*/
		$query = 'SELECT * FROM %s WHERE madminskin = %d or mbkmklt = %d;';
		$res = DB::getResult(sprintf($query, sql_table('member'), $skinid, $skinid));
		
		$members = array();
		while ( $row = $res->fetch() ) {
			$members[] = $row['mrealname'];
		}
		if ( count($members) )
		{
			self::error(_ERROR_SKINDEFDELETE . implode(' ' . _AND . ' ', $members));
			return;
		}
		
		self::$skin->parse('adminskindelete');
		return;
	}

	/**
	 * Admin::action_adminskindeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskindeleteconfirm()
	{
		global $member, $CONF;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		// don't allow default skin to be deleted
		if ( $skinid == $CONF['AdminSkin'] || $skinid == $CONF['BookmarkletSkin'] )
		{
			self::error(_ERROR_DEFAULTSKIN);
			return;
		}
		
		/* don't allow if someone use it as a default*/
		$query = 'SELECT * FROM %s WHERE madminskin = %d or mbkmklt = %d;';
		$res = DB::getResult(sprintf($query, sql_table('member'), $skinid, $skinid));
		
		$members = array();
		while ( $row = $res->fetch() ) {
			$members[] = $row['mrealname'];
		}
		if ( count($members) )
		{
			self::error(_ERROR_SKINDEFDELETE . implode(' ' . _AND . ' ', $members));
			return;
		}
		
		self::skindeleteconfirm($skinid);
		
		self::action_adminskinoverview();
		return;
	}
	
	/**
	 * Admin::action_adminskinremovetype()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinremovetype()
	{
		global $member, $CONF;

		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		if ( !isValidShortName($skintype) )
		{
			self::error(_ERROR_SKIN_PARTS_SPECIAL_DELETE);
			return;
		}
		
		self::$skin->parse('adminskinremovetype');
		return;
	}
	
	/**
	 * Admin::action_adminskinremovetypeconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinremovetypeconfirm()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		$skintype = requestVar('type');
		
		$error = self::skinremovetypeconfirm($skinid, $skintype);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		self::action_adminskinedit();
		return;
	}

	/**
	 * Admin::action_adminskinclone()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinclone()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinid = intRequestVar('skinid');
		
		self::skinclone($skinid, 'AdminActions');
		
		self::action_adminskinoverview();
		return;
	}
	
	/**
	 * Admin::action_adminskinieoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinieoverview()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('adminskinieoverview');
		return;
	}

	/**
	 * Admin::action_adminskinieimport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinieimport()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		$skinFileRaw = postVar('skinfile');
		$mode = postVar('mode');
		
		$error = self::skinieimport($mode, $skinFileRaw);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		if ( !is_object(self::$skin) )
		{
			self::action_adminskiniedoimport();
		}
		else
		{
			self::$skin->parse('adminskinieimport');
		}
		return;
	}
	
	/**
	 * Admin::action_adminskiniedoimport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskiniedoimport()
	{
		global $DIR_SKINS, $member;
		
		$member->isAdmin() or self::disallow();
		
		$mode = postVar('mode');
		$skinFileRaw = postVar('skinfile');
		$allowOverwrite	= intPostVar('overwrite');
		
		$error = self::skiniedoimport($mode, $skinFileRaw, $allowOverwrite);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		if ( !is_object(self::$skin) )
		{
			global $DIR_SKINS;
			$query	= "SELECT min(sdnumber) FROM %s WHERE sdname != 'admin/bookmarklet' AND sdname LIKE 'admin/%%'";
			$query	= sprintf($query, sql_table('skin_desc'));
			$res	= intval(DB::getValue($query));
			$query	= "UPDATE %s SET value = %d WHERE name = 'AdminSkin'";
			$query	= sprintf($query, sql_table('config'), $res);
			DB::execute($query);
			$skin	= new Skin(0, 'AdminActions', 'AdminSkin');
			$skin->parse('importAdmin', $DIR_SKINS . 'admin/defaultimporter.skn');
		}
		else
		{
			self::$skin->parse('adminskiniedoimport');
		}
		return;
	}

	/**
	 * Admin::action_adminskinieexport()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_adminskinieexport()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		// load skinie class
		$aSkins = requestIntArray('skin');
		$aTemplates = requestIntArray('template');
		$info = postVar('info');
		
		self::skinieexport($aSkins, $aTemplates, $info);
		
		return;
	}
	
	/**
	 * Admin::action_settingsedit()
	 * 
	 * @param	Void
	 * @return	Void
	 */
	static private function action_settingsedit()
	{
		global $member, $manager, $CONF, $DIR_NUCLEUS, $DIR_MEDIA;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('settingsedit');
		return;
	}
	
	/**
	 * Admin::action_settingsupdate()
	 * Update $CONFIG and redirect
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_settingsupdate()
	{
		global $member, $CONF;
		
		$member->isAdmin() or self::disallow();
		
		// check if email address for admin is valid
		if ( !NOTIFICATION::address_validation(postVar('AdminEmail')) )
		{
			self::error(_ERROR_BADMAILADDRESS);
			return;
		}
		
		// save settings
		self::updateConfig('DefaultBlog',		postVar('DefaultBlog'));
		self::updateConfig('BaseSkin',			postVar('BaseSkin'));
		self::updateConfig('IndexURL',			postVar('IndexURL'));
		self::updateConfig('AdminURL',			postVar('AdminURL'));
		self::updateConfig('PluginURL',			postVar('PluginURL'));
		self::updateConfig('SkinsURL',			postVar('SkinsURL'));
		self::updateConfig('ActionURL',			postVar('ActionURL'));
		self::updateConfig('Locale',			postVar('Locale'));
		self::updateConfig('AdminEmail',		postVar('AdminEmail'));
		self::updateConfig('SessionCookie',		postVar('SessionCookie'));
		self::updateConfig('AllowMemberCreate',	postVar('AllowMemberCreate'));
		self::updateConfig('AllowMemberMail',	postVar('AllowMemberMail'));
		self::updateConfig('NonmemberMail',		postVar('NonmemberMail'));
		self::updateConfig('ProtectMemNames',	postVar('ProtectMemNames'));
		self::updateConfig('SiteName',			postVar('SiteName'));
		self::updateConfig('NewMemberCanLogon',	postVar('NewMemberCanLogon'));
		self::updateConfig('DisableSite',		postVar('DisableSite'));
		self::updateConfig('DisableSiteURL',	postVar('DisableSiteURL'));
		self::updateConfig('LastVisit',			postVar('LastVisit'));
		self::updateConfig('MediaURL',			postVar('MediaURL'));
		self::updateConfig('AllowedTypes',		postVar('AllowedTypes'));
		self::updateConfig('AllowUpload',		postVar('AllowUpload'));
		self::updateConfig('MaxUploadSize',		postVar('MaxUploadSize'));
		self::updateConfig('MediaPrefix',		postVar('MediaPrefix'));
		self::updateConfig('AllowLoginEdit',	postVar('AllowLoginEdit'));
		self::updateConfig('DisableJsTools',	postVar('DisableJsTools'));
		self::updateConfig('CookieDomain',		postVar('CookieDomain'));
		self::updateConfig('CookiePath',		postVar('CookiePath'));
		self::updateConfig('CookieSecure',		postVar('CookieSecure'));
		self::updateConfig('URLMode',			postVar('URLMode'));
		self::updateConfig('CookiePrefix',		postVar('CookiePrefix'));
		self::updateConfig('DebugVars',			postVar('DebugVars'));
		self::updateConfig('DefaultListSize',	postVar('DefaultListSize'));
		self::updateConfig('AdminCSS',			postVar('AdminCSS'));
		self::updateConfig('AdminSkin',			postVar('adminskin'));
		self::updateConfig('BookmarkletSkin',	postVar('bookmarklet'));

		// load new config and redirect (this way, the new locale will be used is necessary)
		// note that when changing cookie settings, this redirect might cause the user
		// to have to log in again.
		getConfig();
		redirect($CONF['AdminURL'] . '?action=manage');
		return;
	}
	
	/**
	 * Admin::action_systemoverview()
	 * Output system overview
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_systemoverview()
	{
		self::$skin->parse('systemoverview');
		return;
	}
	
	/**
	 * Admin::updateConfig()
	 * 
	 * @param	string	$name	
	 * @param	string	$val	
	 * @return	integer	return the ID in which the latest query posted
	 */
	static private function updateConfig($name, $val)
	{
		$query = "UPDATE %s SET value=%s WHERE name=%s";
		$query = sprintf($query, sql_table('config'), DB::quoteValue($val), DB::quoteValue($name));
		if ( DB::execute($query) === FALSE )
		{
			$err = DB::getError();
			die(_ADMIN_SQLDIE_QUERYERROR . $err[2]);
		}
		return DB::getInsertId();
	}
	
	/**
	 * Admin::error()
	 * Error message
	 * 
	 * @param	string	$msg	message that will be shown
	 * @return	void
	 */
	static public function error($msg)
	{
		self::$headMess = $msg;
		self::$skin->parse('adminerrorpage');
		return;
	}
	
	/**
	 * Admin::disallow()
	 * add error log and show error page 
	 * 
	 * @param	void
	 * @return	void
	 */
	static public function disallow()
	{
		ActionLog::add(WARNING, _ACTIONLOG_DISALLOWED . serverVar('REQUEST_URI'));
		self::error(_ERROR_DISALLOWED);
		return;
	}

	/**
	 * Admin::action_PluginAdmin()
	 * Output pluginadmin
	 *
	 * @param	string	$skinContents
	 * @param	string	$extrahead
	 * @return	void
	 */
	static public function action_PluginAdmin($skinContents, $extrahead = '')
	{
		self::$extrahead .= $extrahead;
		self::$skin->parse('pluginadmin', $skinContents);
		return;
	}
	
	/**
	 * Admin::action_bookmarklet()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_bookmarklet()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		$member->teamRights($blogid) or self::disallow();
		
		self::$skin->parse('bookmarklet');
		return;
	}
	
	/**
	 * Admin::action_actionlog()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_actionlog()
	{
		global $member, $manager;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('actionlog');
		return;
	}
	
	/**
	 * Admin::action_banlist()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_banlist()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		$member->blogAdminRights($blogid) or self::disallow();
		
		self::$skin->parse('banlist');
		return;
	}
	
	/**
	 * Admin::action_banlistdelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_banlistdelete()
	{
		global $member, $manager;
		
		$blogid = intRequestVar('blogid');
		$member->blogAdminRights($blogid) or self::disallow();
		
		self::$skin->parse('banlistdelete');
		return;
	}
	
	/**
	 * Admin::action_banlistdeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_banlistdeleteconfirm()
	{
		global $member, $manager;
		
		$blogid		= intPostVar('blogid');
		$allblogs	= postVar('allblogs');
		$iprange	= postVar('iprange');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		$deleted = array();
		
		if ( !$allblogs )
		{
			if ( Ban::removeBan($blogid, $iprange) )
			{
				$deleted[] = $blogid;
			}
		}
		else
		{
			// get blogs fot which member has admin rights
			$adminblogs = $member->getAdminBlogs();
			foreach ($adminblogs as $blogje)
			{
				if ( Ban::removeBan($blogje, $iprange) )
				{
					$deleted[] = $blogje;
				}
			}
		}
		
		if ( sizeof($deleted) == 0 )
		{
			self::error(_ERROR_DELETEBAN);
			return;
		}
		
		/* TODO: we should use other ways */
		$_REQUEST['delblogs'] = $deleted;
		
		self::$skin->parse('banlistdeleteconfirm');
		return;
	}
	
	/**
	 * Admin::action_banlistnewfromitem()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_banlistnewfromitem()
	{
		global $manager;
		
		$itemid = intRequestVar('itemid');
		$item =& $manager->getItem($itemid, 1, 1);
		self::action_banlistnew($item['blogid']);
		return;
	}
	
	/**
	 * Admin::action_banlistnew()
	 * 
	 * @param	integer	$blogid	ID for weblog
	 * @return	void
	 */
	static private function action_banlistnew($blogid = '')
	{
		global $member, $manager;
		
		if ( $blogid == '' )
		{
			$blogid = intRequestVar('blogid');
		}
		
		$ip = requestVar('ip');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		/* TODO: we should consider to use the other way instead of this */
		$_REQUEST['blogid'] = $blogid;		
		
		self::$skin->parse('banlistnew');
		
		return;
	}

	/**
	 * Admin::action_banlistadd()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_banlistadd()
	{
		global $member;
		
		$blogid		= intPostVar('blogid');
		$allblogs	= postVar('allblogs');
		$iprange	= postVar('iprange');
		
		if ( $iprange == "custom" )
		{
			$iprange = postVar('customiprange');
		}
		$reason   = postVar('reason');
		
		$member->blogAdminRights($blogid) or self::disallow();
		
		// TODO: check IP range validity
		
		if ( !$allblogs )
		{
			if ( !Ban::addBan($blogid, $iprange, $reason) )
			{
				self::error(_ERROR_ADDBAN);
				return;
			}
		}
		else
		{
			// get blogs fot which member has admin rights
			$adminblogs = $member->getAdminBlogs();
			$failed = 0;
			foreach ($adminblogs as $blogje)
			{
				if ( !Ban::addBan($blogje, $iprange, $reason) )
				{
					$failed = 1;
				}
			}
			if ( $failed )
			{
				self::error(_ERROR_ADDBAN);
				return;
			}
		}
		self::action_banlist();
		return;
	}
	
	/**
	 * Admin::action_clearactionlog()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_clearactionlog()
	{
		global $member;
		
		$member->isAdmin() or self::disallow();
		
		ActionLog::clear();
		
		self::action_manage(_MSG_ACTIONLOGCLEARED);
		return;
	}
	
	/**
	 * Admin::action_backupoverview()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_backupoverview()
	{
		global $member, $manager;
		
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('backupoverview');
		return;
	}

	/**
	 * Admin::action_backupcreate()
	 * create file for backup
	 * 
	 * @param		void
	 * @return	void
	 * 
	 */
	static private function action_backupcreate()
	{
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or self::disallow();
		
		// use compression ?
		$useGzip = (integer) postVar('gzip');
		
		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		Backup::do_backup($useGzip);
		return;
	}
	
	/**
	 * Admin::action_backuprestore()
	 * restoring from uploaded file
	 * 
	 * @param		void
	 * @return	void
	 */
	static private function action_backuprestore()
	{
		global $member, $DIR_LIBS;
		
		$member->isAdmin() or self::disallow();
		
		if ( intPostVar('letsgo') != 1 )
		{
			self::error(_ERROR_BACKUP_NOTSURE);
			return;
		}
		
		include($DIR_LIBS . 'backup.php');
		
		// try to extend time limit
		// (creating/restoring dumps might take a while)
		@set_time_limit(1200);
		
		$message = Backup::do_restore();
		if ( $message != '' )
		{
			self::error($message);
			return;
		}
		self::$skin->parse('backuprestore');
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
	static private function action_pluginlist()
	{
		global $DIR_PLUGINS, $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		self::$skin->parse('pluginlist');
		return;
	}
	
	/**
	 * Admin::action_pluginhelp()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_pluginhelp()
	{
		global $member, $manager, $DIR_PLUGINS, $CONF;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$plugid = intGetVar('plugid');
		
		if ( !$manager->pidInstalled($plugid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		self::$skin->parse('pluginhelp');
		return;
	}
	
	/**
	 * Admin::action_pluginadd()
	 * 
	 * @param	Void
	 * @return	Void
	 * 
	 */
	static private function action_pluginadd()
	{
		global $member, $manager, $DIR_PLUGINS;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$name = postVar('filename');
		
		if ( $manager->pluginInstalled($name) )
		{
			self::error(_ERROR_DUPPLUGIN);
			return;
		}
		
		if ( !checkPlugin($name) )
		{
			self::error(_ERROR_PLUGFILEERROR . ' (' . Entity::hsc($name) . ')');
			return;
		}
		
		// get number of currently installed plugins
		$res = DB::getResult('SELECT * FROM ' . sql_table('plugin'));
		$numCurrent = $res->rowCount();
		
		// plugin will be added as last one in the list
		$newOrder = $numCurrent + 1;
		
		$data = array('file' => &$name);
		$manager->notify('PreAddPlugin', $data);
		
		// do this before calling getPlugin (in case the plugin id is used there)
		$query = "INSERT INTO %s (porder, pfile) VALUES (%d, %s);";
		$query = sprintf($query, sql_table('plugin'), (integer) $newOrder, DB::quoteValue($name));
		DB::execute($query);
		$iPid = DB::getInsertId();
		
		$manager->clearCachedInfo('installedPlugins');
		
		// Load the plugin for condition checking and instalation
		$plugin =& $manager->getPlugin($name);
		
		// check if it got loaded (could have failed)
		if ( !$plugin )
		{
			$query = "DELETE FROM %s WHERE pid=%d;";
			$query = sprintf($query, sql_table('plugin'), (integer) $iPid);
			
			DB::execute($query);
			
			$manager->clearCachedInfo('installedPlugins');
			self::error(_ERROR_PLUGIN_LOAD);
			return;
		}
		
		// check if plugin needs a newer Nucleus version
		if ( getNucleusVersion() < $plugin->getMinNucleusVersion() )
		{
			// uninstall plugin again...
			self::deleteOnePlugin($plugin->getID());
			
			// ...and show error
			self::error(_ERROR_NUCLEUSVERSIONREQ . Entity::hsc($plugin->getMinNucleusVersion()));
			return;
		}
		
		// check if plugin needs a newer Nucleus version
		if ( (getNucleusVersion() == $plugin->getMinNucleusVersion()) && (getNucleusPatchLevel() < $plugin->getMinNucleusPatchLevel()) )
		{
			// uninstall plugin again...
			self::deleteOnePlugin($plugin->getID());
			
			// ...and show error
			self::error(_ERROR_NUCLEUSVERSIONREQ . Entity::hsc( $plugin->getMinNucleusVersion() . ' patch ' . $plugin->getMinNucleusPatchLevel() ) );
			return;
		}
		
		$pluginList = $plugin->getPluginDep();
		foreach ( $pluginList as $pluginName )
		{
			$res = DB::getResult('SELECT * FROM '.sql_table('plugin') . ' WHERE pfile=' . DB::quoteValue($pluginName));
			if ($res->rowCount() == 0)
			{
				// uninstall plugin again...
				self::deleteOnePlugin($plugin->getID());
				self::error(sprintf(_ERROR_INSREQPLUGIN, Entity::hsc($pluginName)));
				return;
			}
		}
		
		// call the install method of the plugin
		$plugin->install();
		
		$data = array('plugin' => &$plugin);
		$manager->notify('PostAddPlugin', $data);
		
		// update all events
		self::action_pluginupdate();
		return;
	}
	
	/**
	 * ADMIN:action_pluginupdate():
	 * 
	 * @param	Void
	 * @return	Void
	 * 
	 */
	static private function action_pluginupdate()
	{
		global $member, $manager, $CONF;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		// delete everything from plugin_events
		DB::execute('DELETE FROM '.sql_table('plugin_event'));
		
		// loop over all installed plugins
		$res = DB::getResult('SELECT pid, pfile FROM '.sql_table('plugin'));
		foreach ( $res as $row )
		{
			$pid  =  $row['pid'];
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
	 * Admin::action_plugindelete()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_plugindelete()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$pid = intGetVar('plugid');
		
		if ( !$manager->pidInstalled($pid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		self::$skin->parse('plugindelete');
		return;
	}

	/**
	 * Admin::action_plugindeleteconfirm()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_plugindeleteconfirm()
	{
		global $member, $manager, $CONF;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$pid = intPostVar('plugid');
		
		$error = self::deleteOnePlugin($pid, 1);
		if ( $error )
		{
			self::error($error);
			return;
		}
		
		redirect($CONF['AdminURL'] . '?action=pluginlist');
		return;
	}
	
	/**
	 * Admin::deleteOnePlugin()
	 * 
	 * @param	integer	$pid
	 * @param	boolean	$callUninstall
	 * @return	string	empty or message if failed
	 */
	static public function deleteOnePlugin($pid, $callUninstall = 0)
	{
		global $manager;
		
		$pid = intval($pid);
		
		if ( !$manager->pidInstalled($pid) )
		{
			return _ERROR_NOSUCHPLUGIN;
		}
		
		$query = "SELECT pfile as result FROM %s WHERE pid=%d;";
		$query = sprintf($query, sql_table('plugin'), (integer) $pid);
		$name = DB::getValue($query);
		
		// check dependency before delete
		$res = DB::getResult('SELECT pfile FROM ' . sql_table('plugin'));
		foreach ( $res as $row )
		{
			$plug =& $manager->getPlugin($row['pfile']);
			if ( $plug )
			{
				$depList = $plug->getPluginDep();
				foreach ( $depList as $depName )
				{
					if ( $name == $depName )
					{
						return sprintf(_ERROR_DELREQPLUGIN, $row['pfile']);
					}
				}
			}
		}
		
		$data = array('plugid' => $pid);
		$manager->notify('PreDeletePlugin', $data);
		
		// call the unInstall method of the plugin
		if ( $callUninstall )
		{
			$plugin =& $manager->getPlugin($name);
			if ( $plugin )
			{
				$plugin->unInstall();
			}
		}
		
		// delete all subscriptions
		DB::execute('DELETE FROM ' . sql_table('plugin_event') . ' WHERE pid=' . $pid);
		
		// delete all options
		// get OIDs from plugin_option_desc
		$res = DB::getResult('SELECT oid FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
		$aOIDs = array();
		foreach ( $res as $row )
		{
			array_push($aOIDs, $row['oid']);
		}
		
		// delete from plugin_option and plugin_option_desc
		DB::execute('DELETE FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . $pid);
		if (count($aOIDs) > 0)
		{
			DB::execute('DELETE FROM ' . sql_table('plugin_option') . ' WHERE oid in (' . implode(',', $aOIDs) . ')');
		}
		
		// update order numbers
		$res = DB::getValue('SELECT porder FROM ' . sql_table('plugin') . ' WHERE pid=' . $pid);
		DB::execute('UPDATE ' . sql_table('plugin') . ' SET porder=(porder - 1) WHERE porder>' . $res);
		
		// delete row
		DB::execute('DELETE FROM ' . sql_table('plugin') . ' WHERE pid=' . $pid);
		
		$manager->clearCachedInfo('installedPlugins');
		$data = array('plugid' => $pid);
		$manager->notify('PostDeletePlugin', $data);
		
		return '';
	}
	
	/**
	 * Admin::action_pluginup()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_pluginup()
	{
		global $member, $manager, $CONF;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$plugid = intGetVar('plugid');
		
		if ( !$manager->pidInstalled($plugid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		// 1. get old order number
		$oldOrder = DB::getValue('SELECT porder FROM ' . sql_table('plugin') . ' WHERE pid=' . $plugid);
		
		// 2. calculate new order number
		$newOrder = ($oldOrder > 1) ? ($oldOrder - 1) : 1;
		
		// 3. update plug numbers
		DB::execute('UPDATE ' . sql_table('plugin') . ' SET porder=' . $oldOrder . ' WHERE porder=' . $newOrder);
		DB::execute('UPDATE ' . sql_table('plugin') . ' SET porder=' . $newOrder . ' WHERE pid=' . $plugid);
		
		//self::action_pluginlist();
		// To avoid showing ticket in the URL, redirect to pluginlist, instead.
		redirect($CONF['AdminURL'] . '?action=pluginlist');
		return;
	}
	
	/**
	 * Admin::action_plugindown()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_plugindown()
	{
		global $member, $manager, $CONF;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$plugid = intGetVar('plugid');
		if ( !$manager->pidInstalled($plugid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		// 1. get old order number
		$oldOrder = DB::getValue('SELECT porder FROM ' . sql_table('plugin') . ' WHERE pid=' . $plugid);
		
		$res = DB::getResult('SELECT * FROM ' . sql_table('plugin'));
		$maxOrder = $res->rowCount();
		
		// 2. calculate new order number
		$newOrder = ($oldOrder < $maxOrder) ? ($oldOrder + 1) : $maxOrder;
		
		// 3. update plug numbers
		DB::execute('UPDATE ' . sql_table('plugin') . ' SET porder=' . $oldOrder . ' WHERE porder=' . $newOrder);
		DB::execute('UPDATE ' . sql_table('plugin') . ' SET porder=' . $newOrder . ' WHERE pid=' . $plugid);
		
		//self::action_pluginlist();
		// To avoid showing ticket in the URL, redirect to pluginlist, instead.
		redirect($CONF['AdminURL'] . '?action=pluginlist');
		return;
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
	static private function action_pluginoptions($message = '')
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$pid = intRequestVar('plugid');
		if ( !$manager->pidInstalled($pid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		if ( isset($message) )
		{
			self::$headMess = $message;
		}
		$plugname	= $manager->getPluginNameFromPid($pid);
		$plugin		= $manager->getPlugin($plugname);
		self::$extrahead .= "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/numbercheck.js)%>\"></script>\n";
		
		self::$skin->parse('pluginoptions');
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
	static private function action_pluginoptionsupdate()
	{
		global $member, $manager;
		
		// check if allowed
		$member->isAdmin() or self::disallow();
		
		$pid = intRequestVar('plugid');
		
		if ( !$manager->pidInstalled($pid) )
		{
			self::error(_ERROR_NOSUCHPLUGIN);
			return;
		}
		
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions);
		
		$data = array(
			'context'	=> 'global',
			'plugid'	=> $pid
		);
		$manager->notify('PostPluginOptionsUpdate', $data);
		
		self::action_pluginoptions(_PLUGS_OPTIONS_UPDATED);
		return;
	}
	
	/**
	 * Admin::skineditgeneral()
	 * 
	 * @param	integer	$skinid
	 * @param	string	$handler
	 * @return	string	empty or message if failed
	 */
	static private function skineditgeneral($skinid, $handler='')
	{
		global $manager;
		
		$name = postVar('name');
		$desc = postVar('desc');
		$type = postVar('type');
		$inc_mode = postVar('inc_mode');
		$inc_prefix = postVar('inc_prefix');
		
		$skin =& $manager->getSkin($skinid, $handler);
		
		// 1. Some checks
		if ( !isValidSkinName($name) )
		{
			return _ERROR_BADSKINNAME;
		}
		
		if ( ($skin->getName() != $name) && SKIN::exists($name) )
		{
			return _ERROR_DUPSKINNAME;
		}
		
		if ( !$type )
		{
			$type = 'text/html';
		}
		
		if ( !$inc_mode )
		{
			$inc_mode = 'normal';
		}
		
		// 2. Update description
		$skin->updateGeneralInfo($name, $desc, $type, $inc_mode, $inc_prefix);
		
		return '';
	}
	/**
	 * Admin::skindeleteconfirm()
	 * 
	 * @param	integer	$skinid
	 * @return	void
	 */
	static private function skindeleteconfirm($skinid)
	{
		global $manager;
		
		if ( !in_array(self::$action, self::$adminskin_actions) )
		{
			$event_identifier = 'Skin';
		}
		else
		{
			$event_identifier = 'AdminSkin';
		}
		
		$manager->notify("PreDelete{$event_identifier}", array('skinid' => $skinid));
		
		// 1. delete description
		$query = "DELETE FROM %s WHERE sdnumber=%d;";
		$query = sprintf($query, sql_table('skin_desc'), (integer) $skinid);
		DB::execute($query);
		
		// 2. delete parts
		$query = "DELETE FROM %s WHERE sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), (integer) $skinid);
		DB::execute($query);
		
		$manager->notify("PostDelete{$event_identifier}", array('skinid' => $skinid));
		
		return;
	}
	
	/**
	 * Admin::skinremovetypeconfirm()
	 * 
	 * @param	integer	$skinid
	 * @param	string	$skintype
	 * @return	string	empty or message if failed
	 */
	static private function skinremovetypeconfirm($skinid, $skintype)
	{
		global $manager;
		
		if ( !in_array(self::$action, self::$adminskin_actions) )
		{
			$event_identifier = 'Skin';
		}
		else
		{
			$event_identifier = 'AdminSkin';
		}
		
		if ( !isValidShortName($skintype) )
		{
			return _ERROR_SKIN_PARTS_SPECIAL_DELETE;
		}
		
		$data = array(
			'skinid'	=> $skinid,
			'skintype'	=> $skintype
		);
		$manager->notify("PreDelete{$event_identifier}Part", $data);
		
		// delete part
		$query = 'DELETE FROM %s WHERE sdesc = %d AND stype = %s;';
		$query = sprintf($query, sql_table('skin'), (integer) $skinid, DB::quoteValue($skintype) );
		DB::execute($query);
		
		$data = array(
			'skinid'	=> $skinid,
			'skintype'	=> $skintype
		);
		$manager->notify("PostDelete{$event_identifier}Part", $data);
		
		return '';
	}
	
	/**
	 * Admin::skinclone()
	 * 
	 * @param	integer	$skinid
	 * @param	string	$handler
	 * @return	void
	 */
	static private function skinclone($skinid, $handler='')
	{
		global $manager;
		
		// 1. read skin to clone
		$skin =& $manager->getSkin($skinid, $handler);
		$name = "{$skin->getName()}_clone";
		
		// if a skin with that name already exists:
		if ( Skin::exists($name) )
		{
			$i = 1;
			while ( Skin::exists($name . $i) )
			{
				$i++;
			}
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
		
		// 3. clone
		$query = "SELECT stype FROM %s WHERE sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), (integer) $skinid);
		
		$res = DB::getResult($query);
		foreach ( $res as $row )
		{
			$content = $skin->getContentFromDB($row['stype']);
			if ( $content )
			{
				$query = "INSERT INTO %s (sdesc, scontent, stype) VALUES (%d, %s, %s)";
				$query = sprintf($query, sql_table('skin'), (integer) $newid, DB::quoteValue($content), DB::quoteValue($row['stype']));
				DB::execute($query);
			}
		}
		return;
	}
	
	/**
	 * Admin::skinieimport()
	 * 
	 * @param	string	$mode
	 * @param	string	$skinFileRaw
	 * @return	string	empty or message if failed
	 */
	static private function skinieimport($mode, $skinFileRaw)
	{
		global $DIR_LIBS, $DIR_SKINS;
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		$importer = new SkinImport();
		
		// get full filename
		if ( $mode == 'file' )
		{
			$skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';
		}
		else
		{
			$skinFile = $skinFileRaw;
		}
		
		// read only metadata
		$error = $importer->readFile($skinFile, 1);
		if ( $error )
		{
			unset($importer);
			return $error;
		}
		
		self::$contents['mode']		= $mode;
		self::$contents['skinfile']	= $skinFileRaw;
		self::$contents['skininfo']	= $importer->getInfo();
		self::$contents['skinnames']	= $importer->getSkinNames();
		self::$contents['tpltnames']	= $importer->getTemplateNames();
		
		// clashes
		$skinNameClashes		= $importer->checkSkinNameClashes();
		$templateNameClashes	= $importer->checkTemplateNameClashes();
		$hasNameClashes			= (count($skinNameClashes) > 0) || (count($templateNameClashes) > 0);
		
		self::$contents['skinclashes'] = $skinNameClashes;
		self::$contents['tpltclashes'] = $templateNameClashes;
		self::$contents['nameclashes'] = $hasNameClashes ? 1 : 0;
		
		unset($importer);
		return '';
	}
	
	/**
	 * Admin::skinieedoimport()
	 * 
	 * @param	string	$mode
	 * @param	string	$skinFileRaw
	 * @param	boolean	$allowOverwrite
	 * @return	string	empty	or message if failed
	 */
	static private function skiniedoimport($mode, $skinFileRaw, $allowOverwrite)
	{
		global $DIR_LIBS, $DIR_SKINS;
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		$importer = new SkinImport();
		
		// get full filename
		if ( $mode == 'file' )
		{
			$skinFile = $DIR_SKINS . $skinFileRaw . '/skinbackup.xml';
		}
		else
		{
			$skinFile = $skinFileRaw;
		}
		
		$error = $importer->readFile($skinFile);
		if ( $error )
		{
			unset($importer);
			return $error;
		}
		
		$error = $importer->writeToDatabase($allowOverwrite);
		if ( $error )
		{
			unset($importer);
			return $error;
		}
		
		self::$contents['mode']		= $mode;
		self::$contents['skinfile']	= $skinFileRaw;
		self::$contents['skininfo']	= $importer->getInfo();
		self::$contents['skinnames']	= $importer->getSkinNames();
		self::$contents['tpltnames']	= $importer->getTemplateNames();
		
		unset($importer);
		return '';
	}
	
	/**
	 * Admin::skinieexport()
	 * 
	 * @param	array	$aSkins
	 * @param	array	$aTemplates
	 * @param	string	$info
	 * @return	void
	 */
	static private function skinieexport($aSkins, $aTemplates, $info)
	{
		global $DIR_LIBS;
		
		// load skinie class
		include_once($DIR_LIBS . 'skinie.php');
		
		if ( !is_array($aSkins) )
		{
			$aSkins = array();
		}
		
		if (!is_array($aTemplates))
		{
			$aTemplates = array();
		}
		
		$skinList = array_keys($aSkins);
		$templateList = array_keys($aTemplates);
		
		$exporter = new SkinExport();
		foreach ( $skinList as $skinId )
		{
			$exporter->addSkin($skinId);
		}
		foreach ( $templateList as $templateId )
		{
			$exporter->addTemplate($templateId);
		}
		$exporter->setInfo($info);
		$exporter->export();
		
		return;
	}
	
	/**
	 * Admin::action_parseSpecialskin()
	 * 
	 * @param	void
	 * @return	void
	 */
	static private function action_parseSpecialskin()
	{
		self::$skin->parse(self::$action);
		return;
	}
}
