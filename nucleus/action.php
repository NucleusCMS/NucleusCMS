<?
/** 
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)  
  *
  * File containing actions that can be performed by visitors of the site,
  * like adding comments, etc...
  */

$CONF = array();
include('config.php');			// common functions

switch($action) {
	case 'addcomment':
		addComment();
		break;
	case 'sendmessage':
		sendMessage();
		break;
	case 'createaccount':
		createAccount();
		break;		
	case 'forgotpassword':
		forgotPassword();
		break;
	case 'votepositive':
		doKarma('pos');
		break;
	case 'votenegative':
		doKarma('neg');
		break;
	case 'plugin':
		callPlugin();
		break;
	default:
		doError(_ERROR_BADACTION);
}

function addComment() {
	global $CONF, $errormessage, $manager;
	
	$post['itemid'] =	postVar('itemid');
	$post['user'] = 	postVar('user');
	$post['userid'] = 	postVar('userid');
	$post['body'] = 	postVar('body');
	
	
	// set cookies when required
	$remember = intPostVar('remember');
	if ($remember == 1) {
		$lifetime = time()+2592000;
		setcookie('comment_user',$post['user'],$lifetime,'/','',0);
		setcookie('comment_userid', $post['userid'],$lifetime,'/','',0);
	}

	$comments = new COMMENTS($post['itemid']);

	$blogid = getBlogIDFromItemID($post['itemid']);
	checkban($blogid);
	$blog =& $manager->getBlog($blogid);

	// note: preAddComment gets called somewhere inside addComment
	$errormessage = $comments->addComment($blog->getCorrectTime(),$post);
	$manager->notify('PostAddComment',array('comment' => &$post, 'errormessage' => $errormessage));		
	
	if ($errormessage == '1') {		
		// redirect when adding comments succeeded
		if (postVar('url')) {
			Header('Location: ' . postVar('url'));
		} else {
			$url = $CONF['IndexURL'] . 'index.php?itemid=' . $post['itemid'];
			Header('Location: ' . $url);
		}
	} else {
		// else, show error message using default skin for blog
		doError($errormessage, new SKIN($blog->getDefaultSkin()));
	}
}

// Sends a message from the current member to the member given as argument
function sendMessage() {
	global $CONF, $member;
	
	if (!$CONF['AllowMemberMail']) 
		doError(_ERROR_MEMBERMAILDISABLED);
		
	if (!$member->isLoggedIn() && !$CONF['NonmemberMail'])
		doError(_ERROR_DISALLOWED);
		
	if (!$member->isLoggedIn()) {
		$fromMail = postVar('frommail');
		if (!isValidMailAddress($fromMail))
			doError(_ERROR_BADMAILADDRESS);
		$fromName = _MMAIL_FROMANON;
	} else {
		$fromMail = $member->getEmail();
		$fromName = $member->getDisplayName();
	}
		
	$tomem = new MEMBER();
	$tomem->readFromId(postVar('memberid'));

	$message  = _MMAIL_MSG . ' ' . $fromName . "\n"
		  . '(' . _MMAIL_FROMNUC. ' ' . $CONF['IndexURL'] .") \n\n"
		  . _MMAIL_MAIL . " \n\n"
		  . postVar('message');
	$message .= getMailFooter();

	$title = _MMAIL_TITLE . ' ' . $fromName;
	mail($tomem->getEmail(), $title, $message, 'From: '. $fromMail);

	if (postVar('url')) {
		Header('Location: ' . postVar('url'));
	} else {
		$url = $CONF['IndexURL'] . 'index.php?memberid=' . $tomem->getID();
		Header('Location: ' . $url);
	}

}

// creates a new user account
function createAccount() {
	global $CONF, $manager;
	
	if (!$CONF['AllowMemberCreate']) 
		doError(_ERROR_MEMBERCREATEDISABLED);

	// create random password
	$pw = genPassword(10);
	// create member (non admin/can login/no notes)
	$r = MEMBER::create(postVar('name'), postVar('realname'), $pw, postVar('email'), postVar('url'), 0, $CONF['NewMemberCanLogon'], '');
	if ($r != 1)
		doError($r);
	// send message containing password.
	$newmem = new MEMBER();
	$newmem->readFromName(postVar('name'));
	$newmem->sendPassword($pw);

	$manager->notify('PostRegister',array('member' => &$newmem));		

	if (postVar('desturl')) {
		Header('Location: ' . postVar('desturl'));
	} else {
		echo _MSG_ACCOUNTCREATED;
	}
}

// sends a new password 
function forgotPassword() {
	$membername = trim(postVar('name'));
	
	if (!MEMBER::exists($membername))
		doError(_ERROR_NOSUCHMEMBER);
	$mem = MEMBER::createFromName($membername);
	
	// check if e-mail address is correct
	if (!($mem->getEmail() == postVar('email')))
		doError(_ERROR_INCORRECTEMAIL);
	
	$pw = genPassword(10);
	$mem->setPassword($pw);	// change password
	$mem->write();			// save
	$mem->sendPassword($pw);// send
	
	if (postVar('url')) {
		Header('Location: ' . postVar('url'));
	} else {
		echo _MSG_PASSWORDSENT;
	}
}

// handle karma votes
function doKarma($type) {
	global $itemid, $member, $CONF, $HTTP_REFERER, $manager;

	// check if itemid exists
	if (!$manager->existsItem($itemid,0,0)) 
		doError(_ERROR_NOSUCHITEM);

	$blogid = getBlogIDFromItemID($itemid);
	checkban($blogid);	
		
	$karma =& $manager->getKarma($itemid);
	
	// check if not already voted
	if (!$karma->isVoteAllowed(serverVar('REMOTE_ADDR'))) 
		doError(_ERROR_VOTEDBEFORE);		
		
	// check if item does allow voting
	$item =& $manager->getItem($itemid,0,0);
	if ($item['closed'])
		doError(_ERROR_ITEMCLOSED);
	
	switch($type) {
		case 'pos': 
			$karma->votePositive();
			break;
		case 'neg':
			$karma->voteNegative();
			break;
	}
	
	$blogid = getBlogIDFromItemID($itemid);
	$blog =& $manager->getBlog($blogid);
	
	// send email to notification address, if any
	if ($blog->getNotifyAddress() && $blog->notifyOnVote()) {

		$mailto_msg = _NOTIFY_KV_MSG . ' ' . $itemid . "\n";
		$mailto_msg .= $CONF['IndexURL'] . 'index.php?itemid=' . $itemid . "\n\n";
		if ($member->isLoggedIn()) {
			$mailto_msg .= _NOTIFY_MEMBER . ' ' . $member->getDisplayName() . ' (ID=' . $member->getID() . ")\n";
		}
		$mailto_msg .= _NOTIFY_IP . ' ' . serverVar('REMOTE_ADDR') . "\n";
		$mailto_msg .= _NOTIFY_HOST . ' ' .  gethostbyaddr(serverVar('REMOTE_ADDR'))  . "\n";
		$mailto_msg .= _NOTIFY_VOTE . "\n " . $type . "\n";
		$mailto_msg .= getMailFooter();

		$mailto_title = _NOTIFY_KV_TITLE . ' ' . strip_tags($item['title']) . ' (' . $itemid . ')';

		$frommail = $member->getNotifyFromMailAddress();

		$notify = new NOTIFICATION($blog->getNotifyAddress());
		$notify->notify($mailto_title, $mailto_msg , $frommail);
	}
	
	
	if ($HTTP_REFERER)
		$url = $HTTP_REFERER;
	else
		$url = $CONF['IndexURL'] . 'index.php?itemid=' . $itemid;

	Header('Location: ' . $url);	
}

/**
  * Calls a plugin action
  */
function callPlugin() {
	global $manager;
	
	$pluginName = 'NP_' . requestVar('name');
	$actionType = requestVar('type');
	
	// 1: check if plugin is installed
	if (!$manager->pluginInstalled($pluginName))
		doError(_ERROR_NOSUCHPLUGIN);
	
	// 2: call plugin
	$pluginObject =& $manager->getPlugin($pluginName);
	$error = $pluginObject->doAction($actionType);
	
	// doAction returns error when:
	// - an error occurred (duh)
	// - no actions are allowed (doAction is not implemented)
	if ($error)
		doError($error);
	
}

function checkban($blogid) {
	// check if banned
	$ban = BAN::isBanned($blogid, serverVar('REMOTE_ADDR'));
	if ($ban != 0) {
		doError(_ERROR_BANNED1 . $ban->iprange . _ERROR_BANNED2 . $ban->message . _ERROR_BANNED3);
	}

}



?>