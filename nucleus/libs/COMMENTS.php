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
 * A class representing the comments (all of them) for a certain post on a ceratin blog
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/COMMENTACTIONS.php';

class COMMENTS {

	// item for which comment are being displayed
	var $itemid;

	// reference to the itemActions object that is calling the showComments function
	var $itemActions;

	// total amount of comments displayed
	var $commentcount;

	/**
	 * Creates a new COMMENTS object for the given blog and item
	 *
	 * @param $itemid
	 *		id of the item
	 */
	function COMMENTS($itemid) {
		$this->itemid = intval($itemid);
	}
	
	/**
	 * Used when parsing comments
	 *
	 * @param $itemActions
	 *		itemActions object, that will take care of the parsing
	 */
	function setItemActions(&$itemActions) {
		$this->itemActions =& $itemActions;
	}

	/**
	 * Shows maximum $max comments to the given item using the given template
	 * returns the amount of shown comments (if maxToShow = -1, then there is no limit)
	 *
	 * @param template
	 *		template to use
	 * @param maxToShow
	 *		max. comments to show
	 * @param showNone
	 *		indicates if the 'no comments' thingie should be outputted when there are no comments
	 *		(useful for closed items)
	 * @param highlight
	 *		Highlight to use (if any)
	 */
	function showComments($template, $maxToShow = -1, $showNone = 1, $highlight = '') {
		global $CONF, $manager;

		// create parser object & action handler
		$actions = new COMMENTACTIONS($this);
		$parser = new PARSER($actions->getDefinedActions(),$actions);
		$actions->setTemplate($template);
		$actions->setParser($parser);

		if ($maxToShow == 0) {
			$this->commentcount = $this->amountComments();
		} else {
			$query =  'SELECT c.citem as itemid, c.cnumber as commentid, c.cbody as body, c.cuser as user, c.cmail as userid, c.cemail as email, c.cmember as memberid, c.ctime, c.chost as host, c.cip as ip, c.cblog as blogid'
				   . ' FROM '.sql_table('comment').' as c'
				   . ' WHERE c.citem=' . $this->itemid
				   . ' ORDER BY c.ctime';

			$comments = sql_query($query);
			$this->commentcount = sql_num_rows($comments);
		}

		// if no result was found
		if ($this->commentcount == 0) {
			// note: when no reactions, COMMENTS_HEADER and COMMENTS_FOOTER are _NOT_ used
			if ($showNone) $parser->parse($template['COMMENTS_NONE']);
			return 0;
		}

		// if too many comments to show
		if (($maxToShow != -1) && ($this->commentcount > $maxToShow)) {
			$parser->parse($template['COMMENTS_TOOMUCH']);
			return 0;
		}

		$parser->parse($template['COMMENTS_HEADER']);

		while ( $comment = sql_fetch_assoc($comments) ) {
			$comment['timestamp'] = strtotime($comment['ctime']);
			$actions->setCurrentComment($comment);
			$actions->setHighlight($highlight);
			$data = array('comment' => &$comment);
			$manager->notify('PreComment', $data);
			$parser->parse($template['COMMENTS_BODY']);
			$data = array('comment' => &$comment);
			$manager->notify('PostComment', $data);
		}

		$parser->parse($template['COMMENTS_FOOTER']);

		sql_free_result($comments);

		return $this->commentcount;
	}

	/**
	 * Returns the amount of comments for this itemid
	 */
	function amountComments() {
		$query =  'SELECT COUNT(*)'
			   . ' FROM '.sql_table('comment').' as c'
			   . ' WHERE c.citem='. $this->itemid;
		$res = sql_query($query);
		$arr = sql_fetch_row($res);

		return $arr[0];
	}

	/**
	 * Adds a new comment to the database
	 * @param string $timestamp
	 * @param array $comment
	 * @return mixed
	 */
	function addComment($timestamp, $comment)
	{
		global $CONF, $member, $manager;

		$blogid = getBlogIDFromItemID($this->itemid);

		$settings =& $manager->getBlog($blogid);
		$settings->readSettings();

		// begin if: comments disabled
		if ( !$settings->commentsEnabled() )
		{
			return _ERROR_COMMENTS_DISABLED;
		} // end if

		// begin if: public cannot comment
		if ( !$settings->isPublic() && !$member->isLoggedIn() )
		{
			return _ERROR_COMMENTS_NONPUBLIC;
		} // end if

		// begin if: comment uses a protected member name
		if ( $CONF['ProtectMemNames'] && !$member->isLoggedIn() && MEMBER::isNameProtected($comment['user']) )
		{
			return _ERROR_COMMENTS_MEMBERNICK;
		} // end if

		// begin if: email required, but missing (doesn't apply to members)
		if ( $settings->emailRequired() && strlen($comment['email']) == 0 && !$member->isLoggedIn() )
		{
			return _ERROR_EMAIL_REQUIRED;
		} // end if

		// begin if: commenter's name is too long
		if ( strlen($comment['user']) > 40 )
		{
			return _ERROR_USER_TOO_LONG;
		} // end if

		// begin if: commenter's email is too long
		if ( strlen($comment['email']) > 100 )
		{
			return _ERROR_EMAIL_TOO_LONG;
		} // end if

		// begin if: commenter's url is too long
		if ( strlen($comment['userid']) > 100 )
		{
			return _ERROR_URL_TOO_LONG;
		} // end if

		$comment['timestamp'] = $timestamp;
		$comment['host'] = gethostbyaddr(serverVar('REMOTE_ADDR') );
		$comment['ip'] = serverVar('REMOTE_ADDR');

		// begin if: member is logged in, use that data
		if ( $member->isLoggedIn() )
		{
			$comment['memberid'] = $member->getID();
			$comment['user'] = '';
			$comment['userid'] = '';
			$comment['email'] = '';
		}
		else
		{
			$comment['memberid'] = 0;
		}

		// spam check
		$continue = FALSE;
		$plugins = array();

		if ( isset($manager->subscriptions['ValidateForm']) )
		{
			$plugins = array_merge($plugins, $manager->subscriptions['ValidateForm']);
		}

		if ( isset($manager->subscriptions['PreAddComment']) )
		{
			$plugins = array_merge($plugins, $manager->subscriptions['PreAddComment']);
		}

		if ( isset($manager->subscriptions['PostAddComment']) )
		{
			$plugins = array_merge($plugins, $manager->subscriptions['PostAddComment']);
		}

		$plugins = array_unique($plugins);

		while ( list(, $plugin) = each($plugins) )
		{
			$p = $manager->getPlugin($plugin);
			$continue = $continue || $p->supportsFeature('handleSpam');
		}

		$spamcheck = array(
			'type'  	=> 'comment',
			'body'		=> $comment['body'],
			'id'        => $comment['itemid'],
			'live'   	=> TRUE,
			'return'	=> $continue
		);

		// begin if: member logged in
		if ( $member->isLoggedIn() )
		{
			$spamcheck['author'] = $member->displayname;
			$spamcheck['email'] = $member->email;
		}
		// else: public
		else
		{
			$spamcheck['author'] = $comment['user'];
			$spamcheck['email'] = $comment['email'];
			$spamcheck['url'] = $comment['userid'];
		} // end if

		$data = array('spamcheck' => &$spamcheck);
		$manager->notify('SpamCheck', $data);

		if ( !$continue && isset($spamcheck['result']) && $spamcheck['result'] == TRUE )
		{
			return _ERROR_COMMENTS_SPAM;
		}

		// isValidComment returns either "1" or an error message
		$isvalid = $this->isValidComment($comment, $spamcheck);

		if ( $isvalid != 1 )
		{
			return $isvalid;
		}

		// begin if: send email to notification address
		if ( $settings->getNotifyAddress() && $settings->notifyOnComment() )
		{

			$mailto_msg = _NOTIFY_NC_MSG . ' ' . $this->itemid . "\n";
//			$mailto_msg .= $CONF['IndexURL'] . 'index.php?itemid=' . $this->itemid . "\n\n";
			$temp = parse_url($CONF['Self']);

			if ( $temp['scheme'] )
			{
				$mailto_msg .= createItemLink($this->itemid) . "\n\n";
			}
			else
			{
				$tempurl = $settings->getURL();

				if ( substr($tempurl, -1) == '/' || substr($tempurl, -4) == '.php' )
				{
					$mailto_msg .= $tempurl . '?itemid=' . $this->itemid . "\n\n";
				}
				else
				{
					$mailto_msg .= $tempurl . '/?itemid=' . $this->itemid . "\n\n";
				}
			}

			if ( $comment['memberid'] == 0 )
			{
				$mailto_msg .= _NOTIFY_USER . ' ' . $comment['user'] . "\n";
				$mailto_msg .= _NOTIFY_USERID . ' ' . $comment['userid'] . "\n";
			}
			else
			{
				$mailto_msg .= _NOTIFY_MEMBER .' ' . $member->getDisplayName() . ' (ID=' . $member->getID() . ")\n";
			}

			$mailto_msg .= _NOTIFY_HOST . ' ' . $comment['host'] . "\n";
			$mailto_msg .= _NOTIFY_COMMENT . "\n " . $comment['body'] . "\n";
			$mailto_msg .= getMailFooter();

			$item =& $manager->getItem($this->itemid, 0, 0);
			$mailto_title = _NOTIFY_NC_TITLE . ' ' . strip_tags($item['title']) . ' (' . $this->itemid . ')';

			$frommail = $member->getNotifyFromMailAddress($comment['email']);

			$notify = new NOTIFICATION($settings->getNotifyAddress() );
			$notify->notify($mailto_title, $mailto_msg , $frommail);
		}

		$comment = COMMENT::prepare($comment);

		$data = array(
			'comment'	=> &$comment,
			'spamcheck'	=> &$spamcheck
		);
		$manager->notify('PreAddComment', $data);

		$name		= sql_real_escape_string($comment['user']);
		$url		= sql_real_escape_string($comment['userid']);
		$email      = sql_real_escape_string($comment['email']);
		$body		= sql_real_escape_string($comment['body']);
		$host		= sql_real_escape_string($comment['host']);
		$ip			= sql_real_escape_string($comment['ip']);
		$memberid	= intval($comment['memberid']);
		$timestamp	= date('Y-m-d H:i:s', $comment['timestamp']);
		$itemid		= $this->itemid;

		$qSql       = 'SELECT COUNT(*) AS result '
					. 'FROM ' . sql_table('comment')
					. ' WHERE '
					.      'cmail   = "' . $url . '"'
					. ' AND cmember = "' . $memberid . '"'
					. ' AND cbody   = "' . $body . '"'
					. ' AND citem   = "' . $itemid . '"'
					. ' AND cblog   = "' . $blogid . '"';
		$result     = (integer) quickQuery($qSql);

		if ( $result > 0 )
		{
			return _ERROR_BADACTION;
		}

		$query = 'INSERT INTO '.sql_table('comment').' (CUSER, CMAIL, CEMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CIP, CBLOG) '
			   . "VALUES ('$name', '$url', '$email', $memberid, '$body', $itemid, '$timestamp', '$host', '$ip', '$blogid')";

		sql_query($query);

		// post add comment
		$commentid = sql_insert_id();
		$data = array(
			'comment'	=> &$comment,
			'commentid'	=> &$commentid,
			'spamcheck'	=> &$spamcheck
		);
		$manager->notify('PostAddComment', $data);

		// succeeded !
		return TRUE;
	}


	/**
	 * Checks if a comment is valid and call plugins
	 * that can check if the comment is a spam comment	  
	 */
	function isValidComment(&$comment, &$spamcheck) {

		global $member, $manager;

		// check if there exists a item for this date
		$item =& $manager->getItem($this->itemid, 0, 0);

		if (!$item)
		{
			return _ERROR_NOSUCHITEM;
		}

		if ($item['closed'])
		{
			return _ERROR_ITEMCLOSED;
		}

		# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
		# original eregi comparison: eregi('[a-zA-Z0-9|\.,;:!\?=\/\\]{90,90}', $comment['body']) != FALSE

		// don't allow words that are too long
		if (preg_match('/[a-zA-Z0-9|\.,;:!\?=\/\\\\]{90,90}/', $comment['body']) != 0)
		{
			return _ERROR_COMMENT_LONGWORD;
		}

		// check lengths of comment
		if (strlen($comment['body']) < 3)
		{
			return _ERROR_COMMENT_NOCOMMENT;
		}

		if (strlen($comment['body']) > 5000)
		{
			return _ERROR_COMMENT_TOOLONG;
		}

		// only check username if no member logged in
		if (!$member->isLoggedIn() )
		{

			if (strlen($comment['user']) < 2)
			{
				return _ERROR_COMMENT_NOUSERNAME;
			}

		}

		if ((strlen($comment['email']) != 0) && !(isValidMailAddress(trim($comment['email']) ) ) )
		{
			return _ERROR_BADMAILADDRESS;
		}

		// let plugins do verification (any plugin which thinks the comment is invalid
		// can change 'error' to something other than '1')
		$result = 1;
		$data = array(
			'type'		=>  'comment',
			'comment'	=> &$comment,
			'error'		=> &$result,
			'spamcheck'	=> &$spamcheck
		);
		$manager->notify('ValidateForm', $data);

		return $result;
	}

}

?>
