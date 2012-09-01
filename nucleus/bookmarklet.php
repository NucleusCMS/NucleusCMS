<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * This script allows adding items to Nucleus through bookmarklets. The member must be logged in
 * in order to use this.
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id: bookmarklet.php 1624 2012-01-09 11:36:20Z sakamocchi $
 */

// bookmarklet is part of admin area (might need XML-RPC)
$CONF = array();
$CONF['UsingAdminArea'] = 1;

// include all classes and config data
include('../config.php');

// get skin object
$skinid = $member->bookmarklet;
if ( !Skin::existsID($skinid) )
{
	$skinid = $CONF['BookmarkletSkin'];
	if ( !Skin::existsID($skinid) )
	{
		sendContentType('text/html');
		echo _ERROR_SKIN;
		exit;
	}
}
$skin =& $manager->getSkin($skinid, 'AdminActions', 'AdminSkin');

// check logged-in or pass through
$action = requestVar('action');
if ( !$member->isLoggedIn() )
{
	bm_loginAndPassThrough($skin, $action);
	exit;
}
else if ( $action == 'login')
{
	$action = requestVar('nextaction');
}

$action = strtolower($action);

if ( $action == 'contextmenucode' )
{
	bm_doContextMenuCode();
	exit;
}
else if ( $action == '' )
{
	$action = 'add';
}

// check ticket
$aActionsNotToCheck = array('login', 'add', 'edit');
if ( !in_array($action, $aActionsNotToCheck) )
{
	if ( !$manager->checkTicket() )
	{
		bm_doError($skin, _ERROR_BADTICKET);
	}
}

// find out what to do
switch ( $action )
{
	// adds the item for real
	case 'additem':
		bm_doAddItem($skin);
		break;
	
	// shows the edit item form
	case 'edit':
		bm_doEditForm($skin);
		break;
	
	// edits the item for real
	case 'edititem':
		bm_doEditItem($skin);
		break;
	
	// on login, 'action' gets changed to 'nextaction'
	case 'login':
		bm_doError($skin, 'Something went wrong');
		break;
	
	// shows the fill in form
	case 'add':
	default:
		bm_doShowForm($skin);
		break;
}

function bm_doAddItem($skin)
{
	global $member, $manager, $CONF;
	
	$manager->loadClass('ITEM');
	$result = Item::createFromRequest();
	
	if ( $result['status'] == 'error' )
	{
		bm_doError($skin, $result['message']);
	}
	
	$blogid = getBlogIDFromItemID($result['itemid']);
	$blog =& $manager->getBlog($blogid);
	
	if ( $result['status'] == 'newcategory' )
	{
		$message = 'Item was added, and a new category was created. <a href="index.php?action=categoryedit&amp;blogid=' . $blogid . '&amp;catid=' . $result['catid'] . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); window.open(this.href); return false;" title="Opens in new window">Click here to edit the name and description of the category.</a>';
		$extrahead = '';
	}
	else
	{
		$message = _ITEM_ADDED;
		$extrahead = '';
	}
	
	bm_message($skin, _ITEM_ADDED, $message,$extrahead);
	
	return;
}

function bm_doEditItem($skin)
{
	global $member, $manager, $CONF;
	
	$itemid = intRequestVar('itemid');
	$catid = postVar('catid');
	
	// only allow if user is allowed to alter item
	if ( !$member->canUpdateItem($itemid, $catid) )
	{
		bm_doError($skin, _ERROR_DISALLOWED);
	}
	
	$body = postVar('body');
	$title = postVar('title');
	$more = postVar('more');
	$closed = intPostVar('closed');
	$actiontype = postVar('actiontype');
	$draftid = intPostVar('draftid');
	
	// redirect to admin area on delete (has delete confirmation)
	if ( $actiontype == 'delete' )
	{
		redirect('index.php?action=itemdelete&itemid=' . $itemid);
		exit;
	}
	
	// create new category if needed (only on edit/changedate)
	if ( i18n::strpos($catid,'newcat') === 0 )
	{
		// get blogid
		list($blogid) = sscanf($catid, "newcat-%d");
		
		// create
		$blog =& $manager->getBlog($blogid);
		$catid = $blog->createNewCategory();
		
		// show error when sth goes wrong
		if ( !$catid )
		{
			bm_doError($skin, 'Could not create new category');
		}
	}
	
	// only edit action is allowed for bookmarklet edit
	switch ( $actiontype )
	{
		case 'changedate':
			$publish = 1;
			$wasdraft = 0;
			$timestamp = mktime(intPostVar('hour'), intPostVar('minutes'), 0, intPostVar('month'), intPostVar('day'), intPostVar('year') );
			break;
		case 'edit':
			$publish = 1;
			$wasdraft = 0;
			$timestamp = 0;
			break;
		case 'backtodrafts':
			$publish = 0;
			$wasdraft = 0;
			$timestamp = 0;
			break;
		default:
			bm_doError($skin, 'Something went wrong');
	}
	
	// update item for real
	Item::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);
	
	if ( $draftid > 0 )
	{
		Item::delete($draftid);
	}
	
	if ( $result['status'] == 'newcategory' )
	{
		$href		= "index.php?action=categoryedit&amp;blogid={$blogid}&amp;catid={$result['catid']}";
		$onclick	= 'if (event &amp;&amp; event.preventDefault) event.preventDefault(); window.open(this.href); return false;';
		$title		= _BOOKMARKLET_NEW_WINDOW;
		$aTag		= " <a href=\"{$href}\" onclick=\"{$onclick}\" title=\"{$title}\">";
		$message	= _BOOKMARKLET_NEW_CATEGORY . $aTag . _BOOKMARKLET_NEW_CATEGORY_EDIT . '</a>';
	}
	else
	{
		$message = _ITEM_ADDED;
	}
	
	// show success message
	bm_message($skin, _ITEM_ADDED, $message, '');
	return;
}

function bm_loginAndPassThrough($skin, $action='add')
{
	/*
	 * TODO: これを出力させる
	$blogid = intRequestVar('blogid');
	$itemid = intRequestVar('itemid');
	$log_text = requestVar('logtext');
	$log_link = requestVar('loglink');
	$log_linktitle = requestVar('loglinktitle');
	
	echo '<input type="hidden" name="blogid" value="' . Entity::hsc($blogid). '" />' . "\n";
	echo '<input type="hidden" name="itemid" value="' . Entity::hsc($itemid). '" />' . "\n";
	echo '<input type="hidden" name="logtext" value="' . Entity::hsc($log_text) . '" />' . "\n";
	echo '<input type="hidden" name="loglink" value="' . Entity::hsc($log_link) . '" />' . "\n";
	echo '<input type="hidden" name="loglinktitle" value="' . Entity::hsc($log_linktitle) . '" />' . "\n";
	echo "<input type=\"hidden\" name=\"nextaction\" value=\"{$action}\" />\n";
	*/
	
	$skin->parse('showlogin');
	
	return;
}

function bm_doShowForm($skin)
{
	global $manager, $member;
	
	$blogid			= intRequestVar('blogid');
	$log_text		= trim(requestVar('logtext'));
	$log_link		= requestVar('loglink');
	$log_linktitle	= requestVar('loglinktitle');
	
	if ( !Blog::existsID($blogid) )
	{
		bm_doError($skin, _ERROR_NOSUCHBLOG);
	}
	else if ( !$member->isTeamMember($blogid) )
	{
		bm_doError($skin, _ERROR_NOTONTEAM);
	}
	
	$blog =& $manager->getBlog($blogid);
	
	$logje = '';
	
	if ( $log_text )
	{
		$logje .= '<blockquote><div>"' . Entity::hsc($log_text) . '"</div></blockquote>' . "\n";
	}
	
	if ( !$log_linktitle )
	{
		$log_linktitle = $log_link;
	}
	
	if ( $log_link )
	{
		$logje .= '<a href="' . Entity::hsc($log_link) . '">' . Entity::hsc($log_linktitle) . '</a>';
	}
	
	$item = array();
	$item['body'] = $logje;
	$item['title'] = Entity::hsc($log_linktitle);
	
	$data = array(
		'blog'		=> &$blog,
		'item'		=> &$item,
		'contents'	=> &$item
	);
	$manager->notify('PreAddItemForm', $data);
	
	if ( $blog->convertBreaks() )
	{
		$item['body'] = removeBreaks($item['body']);
	}
	
	Admin::$blog = &$blog;
	Admin::$contents = &$item;
	
	Admin::$action = 'createitem';
	$skin->parse('createitem');
	
	return;
}

function bm_doEditForm($skin)
{
	global $member, $manager;
	
	$itemid = intRequestVar('itemid');
	
	if ( !$manager->existsItem($itemid, 0, 0) )
	{
		bm_doError($skin, _ERROR_NOSUCHITEM);
	}
	else if ( !$member->canAlterItem($itemid) )
	{
		bm_doError($skin, _ERROR_DISALLOWED);
	}
	
	$blog =& $manager->getBlog(getBlogIDFromItemID($itemid) );
	$item =& $manager->getItem($itemid, 1, 1);
	
	$data = array(
		'blog' => &$blog,
		'item' => &$item
	);
	$manager->notify('PrepareItemForEdit', $data);
	
	if ( $blog->convertBreaks() )
	{
		$item['body'] = removeBreaks($item['body']);
		$item['more'] = removeBreaks($item['more']);
	}
	
	Admin::$blog = &$blog;
	Admin::$contents = &$item;
	
	Admin::$action = 'itemedit';
	$skin->parse('itemedit');
	
	return;}

function bm_doError($skin, $msg)
{
	bm_message($skin, _ERRORMSG, $msg);
	die;
}

function bm_message($skin, $title, $msg, $extrahead = '')
{
	Admin::$extrahead = $extrahead;
	Admin::$headMess = $msg;
	$skin->parse('adminerrorpage');
	
	return;
}

function bm_doContextMenuCode($width=600, $height=500)
{
	global $CONF;	
	$blogid = (integer) intGetVar('blogid');
	
	echo "<script type=\"text/javascript\" defer=\"defer\">\n";
	echo "<![CDATA[\n";
	echo " doc = external.menuArguments.document;\n";
	echo " lt = encodeURIComponent(doc.selection.createRange().text);\n";
	echo " loglink = encodeURIComponent(external.menuArguments.location.href);\n";
	echo " loglinktitle = encodeURIComponent(doc.title);\n";
	echo " wingm = window.open('{$CONF['AdminURL']}bookmarklet.php?blogid={$blogid}&logtext=' + lt + '&loglink=' + loglink + '&loglinktitle=' + loglinktitle, 'nucleusbm', 'scrollbars=yes,width={$width},height={$height},left=10,top=10,status=yes,resizable=yes')\n";
	echo " wingm.focus()\n";
	echo "]]>\n";
	echo "</script>\n";
}