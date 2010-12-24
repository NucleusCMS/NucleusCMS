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
 * @version $Id$
 * $NucleusJP: bookmarklet.php,v 1.9.2.1 2007/09/07 07:16:39 kimitake Exp $
 */

// bookmarklet is part of admin area (might need XML-RPC)
$CONF = array();
$CONF['UsingAdminArea'] = 1;

// include all classes and config data
include('../config.php');

$action = requestVar('action');

if ($action == 'contextmenucode') {
	bm_doContextMenuCode();
	exit;
}

if (!$member->isLoggedIn() ) {
	bm_loginAndPassThrough();
	exit;
}

// on successfull login
if ( ($action == 'login') && ($member->isLoggedIn() ) ) {
	$action = requestVar('nextaction');
}

if ($action == '') {
	$action = 'add';
}

sendContentType('text/html', 'bookmarklet-' . $action);

// check ticket
$action = strtolower($action);
$aActionsNotToCheck = array('login', 'add', 'edit');

if (!in_array($action, $aActionsNotToCheck) ) {

	if (!$manager->checkTicket() ) {
		bm_doError(_ERROR_BADTICKET);
	}

}

// find out what to do
switch ($action) {
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
		bm_doError(_BOOKMARKLET_ERROR_SOMETHINGWRONG);
		break;

		// shows the fill in form
	case 'add':
	default:
		bm_doShowForm();
		break;
}

function bm_doAddItem() {
	global $member, $manager, $CONF;

	$manager->loadClass('ITEM');
	$result = ITEM::createFromRequest();

	if ($result['status'] == 'error') {
		bm_doError($result['message']);
	}

	$blogid = getBlogIDFromItemID($result['itemid']);
	$blog =& $manager->getBlog($blogid);

	if ($result['status'] == 'newcategory') {
		$href      = 'index.php?action=categoryedit&amp;blogid=' . $blogid . '&amp;catid=' . $result['catid'];
		$onclick   = 'if (event &amp;&amp; event.preventDefault) event.preventDefault(); window.open(this.href); return false;';
		$title     = _BOOKMARKLET_NEW_WINDOW;
		$aTag      = ' <a href="' . $href . '" onclick="' . $onclick . '" title="' . $title . '">';
		$message   = _BOOKMARKLET_NEW_CATEGORY . $aTag . _BOOKMARKLET_NEW_CATEGORY_EDIT . '</a>';
		$extrahead = '';
	} else {
		$message = _ITEM_ADDED;
		$extrahead = '';
	}

	bm_message(_ITEM_ADDED, _ITEM_ADDED, $message,$extrahead);
}

function bm_doEditItem() {
	global $member, $manager, $CONF;

	$itemid = intRequestVar('itemid');
	$catid = postVar('catid');

	// only allow if user is allowed to alter item
	if (!$member->canUpdateItem($itemid, $catid) ) {
		bm_doError(_ERROR_DISALLOWED);
	}

	$body = postVar('body');
	$title = postVar('title');
	$more = postVar('more');
	$closed = intPostVar('closed');
	$actiontype = postVar('actiontype');
	$draftid = intPostVar('draftid');

	// redirect to admin area on delete (has delete confirmation)
	if ($actiontype == 'delete') {
		redirect('index.php?action=itemdelete&itemid=' . $itemid);
		exit;
	}

	// create new category if needed (only on edit/changedate)
	if (strstr($catid,'newcat') ) {
		// get blogid
		list($blogid) = sscanf($catid, "newcat-%d");

		// create
		$blog =& $manager->getBlog($blogid);
		$catid = $blog->createNewCategory();

		// show error when sth goes wrong
		if (!$catid) {
			bm_doError(_BOOKMARKLET_ERROR_COULDNTNEWCAT);
		}
	}

	// only edit action is allowed for bookmarklet edit
	switch ($actiontype) {
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
			bm_doError(_BOOKMARKLET_ERROR_SOMETHINGWRONG);
	}

	// update item for real
	ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp);

	if ($draftid > 0) {
		ITEM::delete($draftid);
	}

	// show success message
	if ($catid != intPostVar('catid') ) {
		$href      = 'index.php?action=categoryedit&amp;blogid=' . $blog->getID() . '&amp;catid=' . $catid;
		$onclick   = 'if (event &amp;&amp; event.preventDefault) event.preventDefault(); window.open(this.href); return false;';
		$title     = _BOOKMARKLET_NEW_WINDOW;
		$aTag      = ' <a href="' . $href . '" onclick="' . $onclick . '" title="' . $title . '">';
		$message   = _BOOKMARKLET_NEW_CATEGORY . $aTag . _BOOKMARKLET_NEW_CATEGORY_EDIT . '</a>';
		bm_message(_ITEM_UPDATED, _ITEM_UPDATED, _BOOKMARKLET_NEW_CATEGORY . $aTag . _BOOKMARKLET_NEW_CATEGORY_EDIT . '</a>', '');
	} else {
		bm_message(_ITEM_UPDATED, _ITEM_UPDATED, _ITEM_UPDATED, '');
	}
}

function bm_loginAndPassThrough() {

	$blogid = intRequestVar('blogid');
	$log_text = requestVar('logtext');
	$log_link = requestVar('loglink');
	$log_linktitle = requestVar('loglinktitle');

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET ?>" />
<title>Nucleus</title>
	<?php bm_style(); ?>
</head>
<body>
<h1><?php echo _LOGIN_PLEASE ?></h1>

<form method="post" action="bookmarklet.php">
	<p>
		<input name="action" value="login" type="hidden" />
		<input name="blogid" value="<?php echo htmlspecialchars($blogid); ?>" type="hidden" />
		<input name="logtext" value="<?php echo htmlspecialchars($log_text); ?>" type="hidden" />
		<input name="loglink" value="<?php echo htmlspecialchars($log_link); ?>" type="hidden" />
		<input name="loglinktitle" value="<?php echo htmlspecialchars($log_linktitle); ?>" type="hidden" />
		<?php echo _LOGINFORM_NAME ?>
		<br /><input name="login" />
		<br /><?php echo _LOGINFORM_PWD ?>
		<br /><input name="password" type="password" />
		<br /><br />
		<br /><input type="submit" value="<?php echo _LOGIN ?>" />
	</p>
</form>
<p><a href="bookmarklet.php" onclick="window.close();"><?php echo _POPUP_CLOSE ?></a></p>
</body>
</html>
	<?php
}

function bm_doShowForm() {
	global $member;

	$blogid = intRequestVar('blogid');
	$log_text = trim(requestVar('logtext'));
	$log_link = requestVar('loglink');
	$log_linktitle = requestVar('loglinktitle');

	$log_text = uniDecode($log_text,_CHARSET);
	$log_linktitle = uniDecode($log_linktitle,_CHARSET);

	if (!BLOG::existsID($blogid) ) {
		bm_doError(_ERROR_NOSUCHBLOG);
	}

	if (!$member->isTeamMember($blogid) ) {
		bm_doError(_ERROR_NOTONTEAM);
	}

	$logje = '';

	if ($log_text) {
		$logje .= '<blockquote><div>"' . htmlspecialchars($log_text) . '"</div></blockquote>' . "\n";
	}

	if (!$log_linktitle) {
		$log_linktitle = $log_link;
	}

	if ($log_link) {
		$logje .= '<a href="' . htmlspecialchars($log_link) . '">' . htmlspecialchars($log_linktitle) . '</a>';
	}

	$item['body'] = $logje;
	$item['title'] = htmlspecialchars($log_linktitle);

	$factory = new PAGEFACTORY($blogid);
	$factory->createAddForm('bookmarklet', $item);
}

function bm_doEditForm() {
	global $member, $manager;

	$itemid = intRequestVar('itemid');

	if (!$manager->existsItem($itemid, 0, 0) ) {
		bm_doError(_ERROR_NOSUCHITEM);
	}

	if (!$member->canAlterItem($itemid) ) {
		bm_doError(_ERROR_DISALLOWED);
	}

	$item =& $manager->getItem($itemid, 1, 1);
	$blog =& $manager->getBlog(getBlogIDFromItemID($itemid) );

	$manager->notify('PrepareItemForEdit', array('item' => &$item) );

	if ($blog->convertBreaks() ) {
		$item['body'] = removeBreaks($item['body']);
		$item['more'] = removeBreaks($item['more']);
	}

	$formfactory = new PAGEFACTORY($blog->getID() );
	$formfactory->createEditForm('bookmarklet', $item);
}

function bm_doError($msg) {
	bm_message(_ERROR, _ERRORMSG, $msg);
	die;
}

function bm_message($title, $head, $msg, $extrahead = '') {
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET ?>" />
<title><?php echo $title ?></title>
	<?php bm_style(); ?>
	<?php echo $extrahead; ?>
</head>
<body>
<h1><?php echo $head; ?></h1>
<p><?php echo $msg; ?></p>
<p><a href="bookmarklet.php" onclick="window.close();window.opener.location.reload();"><?php echo _POPUP_CLOSE ?></a></p>
</body>
</html>

	<?php
}

function bm_style() {
	echo '<link rel="stylesheet" type="text/css" href="styles/bookmarklet.css" />';
	echo '<link rel="stylesheet" type="text/css" href="styles/addedit.css" />';
}

function bm_doContextMenuCode() {
	global $CONF;
	?>
<script type="text/javascript" defer="defer">
doc = external.menuArguments.document;
lt = escape(doc.selection.createRange().text);
loglink = escape(external.menuArguments.location.href);
loglinktitle = escape(doc.title);
wingm = window.open('<?php echo $CONF['AdminURL']?>bookmarklet.php?blogid=<?php echo intGetVar('blogid')?>&logtext=' + lt + '&loglink=' + loglink + '&loglinktitle=' + loglinktitle, 'nucleusbm', 'scrollbars=yes,width=710,height=500,left=10,top=10,status=yes,resizable=yes');
wingm.focus();
</script>
	<?php
}

function uniDecode($str,$charcode){
	$text = preg_replace_callback("/%u[0-9A-Za-z]{4}/", 'toUtf8', $str);
	return mb_convert_encoding($text, $charcode, 'UTF-8');
}
function toUtf8($ar){
	foreach($ar as $val){
		$val = intval(substr($val,2),16);
		if($val < 0x7F){        // 0000-007F
			$c .= chr($val);
		}elseif($val < 0x800) { // 0080-0800
			$c .= chr(0xC0 | ($val / 64));
			$c .= chr(0x80 | ($val % 64));
		}else{                // 0800-FFFF
			$c .= chr(0xE0 | (($val / 64) / 64));
			$c .= chr(0x80 | (($val / 64) % 64));
			$c .= chr(0x80 | ($val % 64));
		}
	}
	return $c;
}

?>