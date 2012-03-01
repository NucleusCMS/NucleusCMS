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
 * This script allows adding items to Nucleus through bookmarklets. The member must be logged in
 * in order to use this.
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id: bookmarklet.php 1624 2012-01-09 11:36:20Z sakamocchi $
 */

// bookmarklet is part of admin area (might need XML-RPC)
$CONF = array();
$CONF['UsingAdminArea'] = 1;

// include all classes and config data
include('../config.php');

$action = requestVar('action');

if ( $action == 'contextmenucode' )
{
	bm_doContextMenuCode();
	exit;
}

if ( !$member->isLoggedIn() )
{
	bm_loginAndPassThrough();
	exit;
}

// on successfull login
if ( ($action == 'login') && ($member->isLoggedIn()) )
{
	$action = requestVar('nextaction');
}

if ($action == '') {
	$action = 'add';
}

sendContentType('text/html', 'bookmarklet-' . $action);

// check ticket
$action = strtolower($action);
$aActionsNotToCheck = array('login', 'add', 'edit');

if ( !in_array($action, $aActionsNotToCheck) )
{
	if ( !$manager->checkTicket() )
	{
		bm_doError(_ERROR_BADTICKET);
	}
}

// find out what to do
switch ( $action )
{
	// adds the item for real
	case 'additem':
		bm_doAddItem();
		break;
	
	// shows the edit item form
	case 'edit':
		bm_doEditForm();
		break;
	
	// edits the item for real
	case 'edititem':
		bm_doEditItem();
		break;
	
	// on login, 'action' gets changed to 'nextaction'
	case 'login':
		bm_doError('Something went wrong');
		break;
	
	// shows the fill in form
	case 'add':
	default:
		bm_doShowForm();
		break;
}

function bm_doAddItem()
{
	global $member, $manager, $CONF;
	
	$manager->loadClass('ITEM');
	$result = ITEM::createFromRequest();
	
	if ( $result['status'] == 'error' )
	{
		bm_doError($result['message']);
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
	
	bm_message(_ITEM_ADDED, _ITEM_ADDED, $message,$extrahead);
}

function bm_doEditItem()
{
	global $member, $manager, $CONF;
	
	$itemid = intRequestVar('itemid');
	$catid = postVar('catid');
	
	// only allow if user is allowed to alter item
	if ( !$member->canUpdateItem($itemid, $catid) )
	{
		bm_doError(_ERROR_DISALLOWED);
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
	if ( strstr($catid,'newcat') )
	{
		// get blogid
		list($blogid) = sscanf($catid, "newcat-%d");
		
		// create
		$blog =& $manager->getBlog($blogid);
		$catid = $blog->createNewCategory();
		
		// show error when sth goes wrong
		if ( !$catid )
		{
			bm_doError('Could not create new category');
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
			bm_doError('Something went wrong');
	}
	
	// update item for real
	ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);
	
	if ( $draftid > 0 )
	{
		ITEM::delete($draftid);
	}
	
	// show success message
	if ( $catid != intPostVar('catid') )
	{
		bm_message(_ITEM_UPDATED, _ITEM_UPDATED, 'Item was added, and a new category was created. <a href="index.php?action=categoryedit&amp;blogid=' . $blog->getID() . '&amp;catid=' . $catid . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); window.open(this.href); return false;" title="Opens in new window">Click here to edit the name and description of the category.</a>', '');
	}
	else
	{
		bm_message(_ITEM_UPDATED, _ITEM_UPDATED, _ITEM_UPDATED, '');
	}
}

function bm_loginAndPassThrough()
{
	$blogid = intRequestVar('blogid');
	$log_text = requestVar('logtext');
	$log_link = requestVar('loglink');
	$log_linktitle = requestVar('loglinktitle');
	
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n";
	echo "<title>Nucleus</title>\n";
	
	bm_style();
	
	echo "</head>\n";
	echo "<body>\n";
	echo '<h1>' . _LOGIN_PLEASE . "</h1>\n";
	
	echo "<form method=\"post\" action=\"bookmarklet.php\">\n";
	echo "<dl>\n";
	echo '<dt>' . _LOGINFORM_NAME . "</dt>\n";
	echo "<dd><input type=\"text\" name=\"login\" value=\"\" /></dd>\n";
	echo '<dt>' . _LOGINFORM_PWD . ":</dt>\n";
	echo "<input type=\"password\" name=\"password\" value=\"\" /></dd>\n";
	echo "</dl>\n";
	echo "<p>\n";
	echo '<input type=\"hidden\" name="blogid" value="' . ENTITY::hsc($blogid). '" />' . "\n";
	echo '<input type=\"hidden\" name="logtext" value="' . ENTITY::hsc($log_text) . '" />' . "\n";
	echo '<input type=\"hidden\" name="loglink" value="' . ENTITY::hsc($log_link) . '" />' . "\n";
	echo '<input type=\"hidden\" name="loglinktitle" value="' . ENTITY::hsc($log_linktitle) . '" />' . "\n";
	echo '<button type="submit" name="action" value="login">' . _LOGIN . "</button>\n";
	echo "</p>\n";
	echo "</form>\n";
	echo '<p><a href=\"bookmarklet.php\" onclick=\"window.close();\">' . _POPUP_CLOSE . "</a></p>\n";
	echo "</body>\n";
	echo "</html>\n";
	return;
}

function bm_doShowForm()
{
	global $member;
	
	$blogid = intRequestVar('blogid');
	$log_text = trim(requestVar('logtext'));
	$log_link = requestVar('loglink');
	$log_linktitle = requestVar('loglinktitle');
	
	if ( !BLOG::existsID($blogid) )
	{
		bm_doError(_ERROR_NOSUCHBLOG);
	}
	
	if ( !$member->isTeamMember($blogid) )
	{
		bm_doError(_ERROR_NOTONTEAM);
	}
	
	$logje = '';
	
	if ( $log_text )
	{
		$logje .= '<blockquote><div>"' . ENTITY::hsc($log_text) . '"</div></blockquote>' . "\n";
	}
	
	if ( !$log_linktitle )
	{
		$log_linktitle = $log_link;
	}
	
	if ( $log_link )
	{
		$logje .= '<a href="' . ENTITY::hsc($log_link) . '">' . ENTITY::hsc($log_linktitle) . '</a>';
	}
	
	$item['body'] = $logje;
	$item['title'] = ENTITY::hsc($log_linktitle);
	
	$factory = new PAGEFACTORY($blogid);
	$factory->createAddForm('bookmarklet', $item);
	return;
}

function bm_doEditForm()
{
	global $member, $manager;
	
	$itemid = intRequestVar('itemid');
	
	if ( !$manager->existsItem($itemid, 0, 0) )
	{
		bm_doError(_ERROR_NOSUCHITEM);
	}
	
	if ( !$member->canAlterItem($itemid) )
	{
		bm_doError(_ERROR_DISALLOWED);
	}
	
	$item =& $manager->getItem($itemid, 1, 1);
	$blog =& $manager->getBlog(getBlogIDFromItemID($itemid) );
	
	$manager->notify('PrepareItemForEdit', array('item' => &$item) );
	
	if ( $blog->convertBreaks() )
	{
		$item['body'] = removeBreaks($item['body']);
		$item['more'] = removeBreaks($item['more']);
	}
	
	$formfactory = new PAGEFACTORY($blog->getID() );
	$formfactory->createEditForm('bookmarklet', $item);
	return;
}

function bm_doError($msg)
{
	bm_message(_ERROR, _ERRORMSG, $msg);
	die;
}

function bm_message($title, $head, $msg, $extrahead = '')
{
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n";
	echo "<title>{$title}</title>\n";
	
	bm_style();
	
	echo $extrahead . "\n";
	echo "</head>\n";
	echo "<body>\n";
	echo "<h1>{$head}</h1>\n";
	echo "<p>{$msg}</p>\n";
	echo '<p><a href="bookmarklet.php" onclick="window.close();window.opener.location.reload();">' . _POPUP_CLOSE . "</a></p>\n";
	echo "</body>\n";
	echo "</html>\n";
	return;
}

function bm_style()
{
	echo '<link rel="stylesheet" type="text/css" href="styles/bookmarklet.css" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="styles/addedit.css" />' . "\n";
}

function bm_doContextMenuCode()
{
	global $CONF;
	
	$blogid = (integer) intGetVar('blogid');
	
	echo "<script type=\"text/javascript\" defer=\"defer\">\n";
	echo "	doc = external.menuArguments.document;\n";
	echo "	lt = escape(doc.selection.createRange().text);\n";
	echo "	loglink = escape(external.menuArguments.location.href);\n";
	echo "	loglinktitle = escape(doc.title);\n";
	echo "	wingm = window.open('{$CONF['AdminURL']}bookmarklet.php?blogid={$blogid}&logtext=' + lt + '&loglink=' + loglink + '&loglinktitle=' + loglinktitle, 'nucleusbm', 'scrollbars=yes,width=600,height=500,left=10,top=10,status=yes,resizable=yes')\n";
	echo "	wingm.focus()\n";
	echo "</script>\n";
}
