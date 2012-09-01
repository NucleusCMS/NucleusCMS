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
 * @version $Id: COMMENTS.php 1527 2011-06-21 10:43:44Z sakamocchi $
 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/COMMENTACTIONS.php';

class Comments
{
	// reference to the itemActions object that is calling the showComments function
	public $itemActions;
	
	// item for which comment are being displayed
	public $itemid;
	
	// total amount of comments displayed
	public $commentcount;
	
	/**
	 * Comments::__construct()
	 * Creates a new Comments object for the given blog and item
	 *
	 * @param	integer	$itemid	id of the item
	 * @return	void
	 */
	public function __construct($itemid)
	{
		$this->itemid = (integer) $itemid;
		return;
	}
	
	/**
	 * Comments::setItemActions()
	 * Used when parsing comments
	 *
	 * @param	object	$itemActions	itemActions object, that will take care of the parsing
	 * @return	void
	 */
	public function setItemActions(&$itemActions)
	{
		$this->itemActions =& $itemActions;
		return;
	}
	
	/**
	 * Comments::showComments()
	 * Shows maximum $max comments to the given item using the given template
	 * returns the amount of shown comments (if maxToShow = -1, then there is no limit)
	 *
	 * @param	array	template	template to use
	 * @param	integer	maxToShow	max. comments to show
	 * @param	integer	showNone	indicates if the 'no comments' thingie should be outputted
	 * 								when there are no comments (useful for closed items)
	 * @param	string	highlight	Highlight to use (if any)
	 * @return	integer	number of comments
	 */
	public function showComments($template, $maxToShow = -1, $showNone = 1, $highlight = '')
	{
		global $CONF, $manager;
		
		if ( $maxToShow == 0 )
		{
			$this->commentcount = $this->amountComments();
		}
		else
		{
			$query = 'SELECT citem as itemid, cnumber as commentid, cbody as body, cuser as user, cmail as userid, '
			       . 'cemail as email, cmember as memberid, ctime, chost as host, cip as ip, cblog as blogid '
			       . 'FROM %s as c WHERE citem=%d ORDER BY ctime';
			
			$query = sprintf($query, sql_table('comment'), (integer) $this->itemid);
			$comments = DB::getResult($query);
			$this->commentcount = $comments->rowCount();
		}
		
		// create parser object & action handler
		$handler = new CommentActions($this);
		$handler->setTemplate($template);
		
		$parser = new Parser($handler);
		
		// if no result was found
		if ( $this->commentcount == 0 )
		{
			// note: when no reactions, COMMENTS_HEADER and COMMENTS_FOOTER are _NOT_ used
			if ( $showNone )
			{
				$parser->parse($template['COMMENTS_NONE']);
			}
			return 0;
		}
		
		// if too many comments to show
		if ( ($maxToShow != -1) && ($this->commentcount > $maxToShow) )
		{
			$parser->parse($template['COMMENTS_TOOMUCH']);
			return 0;
		}
		
		$parser->parse($template['COMMENTS_HEADER']);
		
		foreach ( $comments as $comment )
		{
			$comment['timestamp'] = strtotime($comment['ctime']);
			$handler->setCurrentComment($comment);
			$handler->setHighlight($highlight);

			$data = array('comment' => &$comment);
			$manager->notify('PreComment', $data);
			$parser->parse($template['COMMENTS_BODY']);
			$manager->notify('PostComment', $data);
		}
		
		$parser->parse($template['COMMENTS_FOOTER']);
		
		$comments->closeCursor();
		
		return $this->commentcount;
	}
	
	/**
	 * Comments::amountComments()
	 * Returns the amount of comments for this itemid
	 * 
	 * @param	void
	 * @return	integer	number of comments
	 */
	public function amountComments()
	{
		$query = 'SELECT COUNT(*) FROM %s WHERE citem=%d;';
		$query = sprintf($query, sql_table('comment'), (integer) $this->itemid);
		$res = DB::getValue($query);
		
		return $res;
	}
	
	/**
	 * Comments::addComment()
	 * Adds a new comment to the database
	 * 
	 * @param string $timestamp
	 * @param array $comment
	 * @return mixed
	 */
	public function addComment($timestamp, $comment)
	{
		global $CONF, $member, $manager;
		
		$blogid = getBlogIDFromItemID($this->itemid);
		
		$settings =& $manager->getBlog($blogid);
		$settings->readSettings();
		
		// begin if: comments disabled
		if ( !$settings->commentsEnabled() )
		{
			return _ERROR_COMMENTS_DISABLED;
		}
		
		// begin if: public cannot comment
		if ( !$settings->isPublic() && !$member->isLoggedIn() )
		{
			return _ERROR_COMMENTS_NONPUBLIC;
		}
		
		// begin if: comment uses a protected member name
		if ( $CONF['ProtectMemNames'] && !$member->isLoggedIn() && Member::isNameProtected($comment['user']) )
		{
			return _ERROR_COMMENTS_MEMBERNICK;
		}
		
		// begin if: email required, but missing (doesn't apply to members)
		if ( $settings->emailRequired() && i18n::strlen($comment['email']) == 0 && !$member->isLoggedIn() )
		{
			return _ERROR_EMAIL_REQUIRED;
		}
		
		// begin if: commenter's name is too long
		if ( i18n::strlen($comment['user']) > 40 )
		{
			return _ERROR_USER_TOO_LONG;
		}
		
		// begin if: commenter's email is too long
		if ( i18n::strlen($comment['email']) > 100 )
		{
			return _ERROR_EMAIL_TOO_LONG;
		}
		
		// begin if: commenter's url is too long
		if ( i18n::strlen($comment['userid']) > 100 )
		{
			return _ERROR_URL_TOO_LONG;
		}
		
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
			'type'		=> 'comment',
			'body'		=> $comment['body'],
			'id'		=> $comment['itemid'],
			'live'		=> TRUE,
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
		}

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
		
			$message = _NOTIFY_NC_MSG . ' ' . $this->itemid . "\n";
			$temp = parse_url($CONF['Self']);
			
			if ( $temp['scheme'] )
			{
				$message .= Link::create_item_link($this->itemid) . "\n\n";
			}
			else
			{
				$tempurl = $settings->getURL();
				
				if ( i18n::substr($tempurl, -1) == '/' || i18n::substr($tempurl, -4) == '.php' )
				{
					$message .= $tempurl . '?itemid=' . $this->itemid . "\n\n";
				}
				else
				{
					$message .= $tempurl . '/?itemid=' . $this->itemid . "\n\n";
				}
			}
			
			if ( $comment['memberid'] == 0 )
			{
				$message .= _NOTIFY_USER . ' ' . $comment['user'] . "\n";
				$message .= _NOTIFY_USERID . ' ' . $comment['userid'] . "\n";
			}
			else
			{
				$message .= _NOTIFY_MEMBER .' ' . $member->getDisplayName() . ' (ID=' . $member->getID() . ")\n";
			}
			
			$message .= _NOTIFY_HOST . ' ' . $comment['host'] . "\n";
			$message .= _NOTIFY_COMMENT . "\n " . $comment['body'] . "\n";
			$message .= NOTIFICATION::get_mail_footer();
			
			$item =& $manager->getItem($this->itemid, 0, 0);
			$subject = _NOTIFY_NC_TITLE . ' ' . strip_tags($item['title']) . ' (' . $this->itemid . ')';
			
			$from = $member->getNotifyFromMailAddress($comment['email']);
			
			NOTIFICATION::mail($settings->getNotifyAddress(), $subject, $message, $from, i18n::get_current_charset());
		}
		
		$comment = Comment::prepare($comment);

		$data = array('comment' => &$comment, 'spamcheck' => &$spamcheck);
		$manager->notify('PreAddComment', $data);
		
		$name		= DB::quoteValue($comment['user']);
		$url		= DB::quoteValue($comment['userid']);
		$email		= DB::quoteValue($comment['email']);
		$body		= DB::quoteValue($comment['body']);
		$host		= DB::quoteValue($comment['host']);
		$ip			= DB::quoteValue($comment['ip']);
		$memberid	= intval($comment['memberid']);
		$timestamp	= DB::formatDateTime($comment['timestamp']);
		$itemid		= $this->itemid;
		
		$qSql = 'SELECT COUNT(*) AS result '
		      . 'FROM ' . sql_table('comment')
		      . ' WHERE '
		      .      'cmail   = ' . $url
		      . ' AND cmember = ' . $memberid
		      . ' AND cbody   = ' . $body
		      . ' AND citem   = ' . $itemid
		      . ' AND cblog   = ' . $blogid;
		$result = (integer) DB::getValue($qSql);
		
		if ( $result > 0 )
		{
			return _ERROR_BADACTION;
		}
		
		$query = sprintf('INSERT INTO %s (cuser, cmail, cemail, cmember, cbody, citem, ctime, chost, cip, cblog) '
			. 'VALUES (%s, %s, %s, %d, %s, %d, %s, %s, %s, %d)'
			, sql_table('comment'), $name, $url, $email, $memberid, $body, $itemid, $timestamp, $host, $ip, $blogid);
		
		DB::execute($query);
		
		// post add comment
		$commentid = DB::getInsertId();
		$data = array('comment' => &$comment, 'commentid' => &$commentid, 'spamcheck' => &$spamcheck);
		$manager->notify('PostAddComment', $data);
		
		// succeeded !
		return TRUE;
	}
	
	/**
	 * Comments::isValidComment()
	 * Checks if a comment is valid and call plugins
	 * that can check if the comment is a spam comment	  
	 * 
	 * @param	array	$comment	array with comment elements
	 * @param	array	$spamcheck	array with spamcheck elements
	 * @return	boolean	valid or not
	 */
	private function isValidComment(&$comment, &$spamcheck)
	{
		global $member, $manager;
		
		// check if there exists a item for this date
		$item =& $manager->getItem($this->itemid, 0, 0);
		
		if ( !$item )
		{
			return _ERROR_NOSUCHITEM;
		}
		
		if ( $item['closed'] )
		{
			return _ERROR_ITEMCLOSED;
		}
		
		// don't allow words that are too long
		if ( preg_match('/[a-zA-Z0-9|\.,;:!\?=\/\\\\]{90,90}/', $comment['body']) != 0 )
		{
			return _ERROR_COMMENT_LONGWORD;
		}
		
		// check lengths of comment
		if ( i18n::strlen($comment['body']) < 3 )
		{
			return _ERROR_COMMENT_NOCOMMENT;
		}
		
		if ( i18n::strlen($comment['body']) > 5000 )
		{
			return _ERROR_COMMENT_TOOLONG;
		}
		
		// only check username if no member logged in
		if ( !$member->isLoggedIn() && (i18n::strlen($comment['user']) < 2) )
		{
			return _ERROR_COMMENT_NOUSERNAME;
		}
		
		if ( (i18n::strlen($comment['email']) != 0) && !NOTIFICATION::address_validation(trim($comment['email'])) )
		{
			return _ERROR_BADMAILADDRESS;
		}
		
		// let plugins do verification (any plugin which thinks the comment is invalid
		// can change 'error' to something other than '1')
		$result = 1;
		$data = array('type' => 'comment', 'comment' => &$comment, 'error' => &$result, 'spamcheck' => &$spamcheck);
		$manager->notify('ValidateForm', $data);
		
		return $result;
	}
}
