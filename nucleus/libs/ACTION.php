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
  * Actions that can be called via action.php
  *
  * $Id$
  */
class ACTION
{
	function ACTION()
	{
	
	}
	
	function doAction($action) 
	{
		switch($action) {
			case 'addcomment':
				return $this->addComment();
				break;
			case 'sendmessage':
				return $this->sendMessage();
				break;
			case 'createaccount':
				return $this->createAccount();
				break;		
			case 'forgotpassword':
				return $this->forgotPassword();
				break;
			case 'votepositive':
				return $this->doKarma('pos');
				break;
			case 'votenegative':
				return $this->doKarma('neg');
				break;
			case 'plugin':
				return $this->callPlugin();
				break;
			default:
				doError(_ERROR_BADACTION);
		}
	}
	
	function addComment() {
		global $CONF, $errormessage, $manager;

		$post['itemid'] =	intPostVar('itemid');
		$post['user'] = 	postVar('user');
		$post['userid'] = 	postVar('userid');
		$post['body'] = 	postVar('body');

		// set cookies when required
		$remember = intPostVar('remember');
		if ($remember == 1) {
			$lifetime = time()+2592000;
			setcookie($CONF['CookiePrefix'] . 'comment_user',$post['user'],$lifetime,'/','',0);
			setcookie($CONF['CookiePrefix'] . 'comment_userid', $post['userid'],$lifetime,'/','',0);
		}

		$comments = new COMMENTS($post['itemid']);

		$blogid = getBlogIDFromItemID($post['itemid']);
		$this->checkban($blogid);
		$blog =& $manager->getBlog($blogid);

		// note: PreAddComment and PostAddComment gets called somewhere inside addComment
		$errormessage = $comments->addComment($blog->getCorrectTime(),$post);

		if ($errormessage == '1') {		
			// redirect when adding comments succeeded
			if (postVar('url')) {
				redirect(postVar('url'));
			} else {
				$url = $CONF['IndexURL'] . createItemLink($post['itemid']);
				redirect($url);
			}
		} else {
			// else, show error message using default skin for blog
			return array(
				'message' => $errormessage,
				'skinid' => $blog->getDefaultSkin()
			);
		}
		
		exit;
	}

	// Sends a message from the current member to the member given as argument
	function sendMessage() {
		global $CONF, $member;

		$error = $this->validateMessage();
		if ($error != '')
			return array('message' => $error);

		if (!$member->isLoggedIn()) {
			$fromMail = postVar('frommail');
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
			redirect(postVar('url'));
		} else {
			$CONF['MemberURL'] = $CONF['IndexURL'];
			if ($CONF['URLMode'] == 'pathinfo')
				$url = createMemberLink($tomem->getID());
			else
				$url = $CONF['IndexURL'] . createMemberLink($tomem->getID());
			redirect($url);
		}
		
		exit;

	}
	
	function validateMessage() {
		global $CONF, $member, $manager;

		if (!$CONF['AllowMemberMail']) 
			return _ERROR_MEMBERMAILDISABLED;

		if (!$member->isLoggedIn() && !$CONF['NonmemberMail'])
			return _ERROR_DISALLOWED;

		if (!$member->isLoggedIn() && (!isValidMailAddress(postVar('frommail'))))
			return _ERROR_BADMAILADDRESS;
			
		// let plugins do verification (any plugin which thinks the comment is invalid
		// can change 'error' to something other than '')
		$result = '';
		$manager->notify('ValidateForm', array('type' => 'membermail', 'error' => &$result));
		
		return $result;
		
	}

	// creates a new user account
	function createAccount() {
		global $CONF, $manager;

		if (!$CONF['AllowMemberCreate']) 
			doError(_ERROR_MEMBERCREATEDISABLED);

		// even though the member can not log in, set some random initial password. One never knows.
		srand((double)microtime()*1000000);
		$initialPwd = md5(uniqid(rand(), true));

		// create member (non admin/can not login/no notes/random string as password)
		$r = MEMBER::create(postVar('name'), postVar('realname'), $initialPwd, postVar('email'), postVar('url'), 0, 0, '');
		
		if ($r != 1)
			doError($r);
			
		// send message containing password.
		$newmem = new MEMBER();
		$newmem->readFromName(postVar('name'));
		$newmem->sendActivationLink('register');

		$manager->notify('PostRegister',array('member' => &$newmem));		

		if (postVar('desturl')) {
			redirect(postVar('desturl'));
		} else {
			echo _MSG_ACTIVATION_SENT;
		}
		
		exit;
	}

	// sends a new password 
	function forgotPassword() {
		$membername = trim(postVar('name'));

		if (!MEMBER::exists($membername))
			doError(_ERROR_NOSUCHMEMBER);
		$mem = MEMBER::createFromName($membername);

		if (!$mem->canLogin())
			doError(_ERROR_NOLOGON_NOACTIVATE);

		// check if e-mail address is correct
		if (!($mem->getEmail() == postVar('email')))
			doError(_ERROR_INCORRECTEMAIL);

		// send activation link
		$mem->sendActivationLink('forgot');

		if (postVar('url')) {
			redirect(postVar('url'));
		} else {
			echo _MSG_ACTIVATION_SENT;
		}
		
		exit;
	}

	// handle karma votes
	function doKarma($type) {
		global $itemid, $member, $CONF, $manager;

		// check if itemid exists
		if (!$manager->existsItem($itemid,0,0)) 
			doError(_ERROR_NOSUCHITEM);

		$blogid = getBlogIDFromItemID($itemid);
		$this->checkban($blogid);	

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


		$refererUrl = serverVar('HTTP_REFERER');
		if ($refererUrl)
			$url = $refererUrl;
		else
			$url = $CONF['IndexURL'] . 'index.php?itemid=' . $itemid;

		redirect($url);	
		exit;
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
		if ($pluginObject)
			$error = $pluginObject->doAction($actionType);
		else
			$error = 'Could not load plugin (see actionlog)';

		// doAction returns error when:
		// - an error occurred (duh)
		// - no actions are allowed (doAction is not implemented)
		if ($error)
			doError($error);
			
		exit;

	}

	function checkban($blogid) {
		// check if banned
		$ban = BAN::isBanned($blogid, serverVar('REMOTE_ADDR'));
		if ($ban != 0) {
			doError(_ERROR_BANNED1 . $ban->iprange . _ERROR_BANNED2 . $ban->message . _ERROR_BANNED3);
		}

	}


}

?>