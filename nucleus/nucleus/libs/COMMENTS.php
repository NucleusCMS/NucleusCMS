<?php

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
  * A class representing the comments (all of them) for a certain post on a ceratin blog
  */
class COMMENTS {
	
	/**
	 * Creates a new COMMENTS object for the given blog and item
	 *
	 * @param $itemid 
	 *		id of the item
	 * @param $itemActions
	 *		itemActions object, that will take care of the parsing
	 */
	function COMMENTS($itemid, &$itemActions) {
		$this->itemid = intval($itemid);
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
	 */
	function showComments($template, $maxToShow = -1, $showNone = 1) {
		global $CONF, $manager;

		// create parser object & action handler
		$actions = new COMMENTACTIONS($this);
		$parser = new PARSER($actions->getDefinedActions(),$actions);
		$actions->setTemplate($template);
		$actions->setParser($parser);
		
		if ($maxToShow == 0) {
			$this->commentcount = $this->amountComments();
		} else {
			$query =  'SELECT c.cnumber as commentid, c.cbody as body, c.cuser as user, c.cmail as userid, c.cmember as memberid, UNIX_TIMESTAMP(c.ctime) as timestamp, c.chost as host, c.cip as ip, c.cblog as blogid'
			       . ' FROM nucleus_comment as c'
			       . ' WHERE c.citem=' . $this->itemid 
			       . ' ORDER BY c.ctime';
			       
			$comments = sql_query($query);		
			$this->commentcount = mysql_num_rows($comments);
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
		
		while ( $comment = mysql_fetch_assoc($comments) ) {
			$actions->setCurrentComment($comment);
			$manager->notify('PreComment', array('comment' => &$comment));
			$parser->parse($template['COMMENTS_BODY']);
			$manager->notify('PostComment', array('comment' => &$comment));			
		}

		$parser->parse($template['COMMENTS_FOOTER']);
		
		mysql_free_result($comments);
				
		return $this->commentcount;
	}
	 
	/**
	 * Returns the amount of comments for this itemid
	 */
	function amountComments() {
		$query =  'SELECT COUNT(*)'
		       . ' FROM nucleus_comment as c'
		       . ' WHERE c.citem='. $this->itemid;
		$res = sql_query($query);
		$arr = mysql_fetch_row($res);
		
		return $arr[0];
	}
	

	function addComment($timestamp, $comment) {
		global $CONF, $member, $manager;
		
		$blogid = getBlogIDFromItemID($this->itemid);

		$settings =& $manager->getBlog($blogid);
		$settings->readSettings();
		
		if (!$settings->commentsEnabled())
			return _ERROR_COMMENTS_DISABLED;
			
		if (!$settings->isPublic() && !$member->isLoggedIn())
			return _ERROR_COMMENTS_NONPUBLIC;

		// member name protection
		if ($CONF['ProtectMemNames'] && !$member->isLoggedIn() && MEMBER::exists(trim($comment['user'])))
			return _ERROR_COMMENTS_MEMBERNICK;

		$isvalid = $this->isValidComment($comment);
		if ($isvalid != 1)
			return $isvalid;

		$comment['timestamp'] = $timestamp;
		$comment['host'] = gethostbyaddr(serverVar('REMOTE_ADDR'));	
		$comment['ip'] = serverVar('REMOTE_ADDR');

		// if member is logged in, use that data
		if ($member->isLoggedIn()) {
			$comment['memberid'] = $member->getID();
			$comment['user'] = '';
			$comment['userid'] = '';
		} else {
			$comment['memberid'] = 0;
		}
		
				
		// send email to notification address, if any
		if ($settings->getNotifyAddress() && $settings->notifyOnComment()) {
		
			$mailto_msg = _NOTIFY_NC_MSG . ' ' . $this->itemid . "\n";
			$mailto_msg .= $CONF['IndexURL'] . 'index.php?itemid=' . $this->itemid . "\n\n";
			if ($comment['memberid'] == 0) {
				$mailto_msg .= _NOTIFY_USER . ' ' . $comment['user'] . "\n";
				$mailto_msg .= _NOTIFY_USERID . ' ' . $comment['userid'] . "\n";
			} else {
				$mailto_msg .= _NOTIFY_MEMBER .' ' . $member->getDisplayName() . ' (ID=' . $member->getID() . ")\n";
			}
			$mailto_msg .= _NOTIFY_HOST . ' ' . $comment['host'] . "\n";
			$mailto_msg .= _NOTIFY_COMMENT . "\n " . $comment['body'] . "\n";
			$mailto_msg .= getMailFooter();
			
			$item =& $manager->getItem($this->itemid, 0, 0);
			$mailto_title = _NOTIFY_NC_TITLE . ' ' . strip_tags($item['title']) . ' (' . $this->itemid . ')';
			
			$frommail = $member->getNotifyFromMailAddress($comment['userid']);

			$notify = new NOTIFICATION($settings->getNotifyAddress());
			$notify->notify($mailto_title, $mailto_msg , $frommail);
		}

		$comment = COMMENT::prepare($comment);
		
		$manager->notify('PreAddComment',array('comment' => &$comment));		

		$name		= addslashes($comment['user']);
		$url		= addslashes($comment['userid']);
		$body		= addslashes($comment['body']);
		$host		= addslashes($comment['host']);
		$ip			= addslashes($comment['ip']);
		$memberid	= intval($comment['memberid']);
		$timestamp	= date('Y-m-d H:i:s', $comment['timestamp']);
		$itemid		= $this->itemid;
				
		$query = 'INSERT INTO nucleus_comment (CUSER, CMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CIP, CBLOG) '
		       . "VALUES ('$name', '$url', $memberid, '$body', $itemid, '$timestamp', '$host', '$ip', '$blogid')";

		sql_query($query);
	
		// succeeded !
		return true;
	}
	

	function isValidComment($comment) {
		global $member, $manager;

		// check if there exists a item for this date
		$item =& $manager->getItem($this->itemid,0,0);
		
		if (!$item)
			return _ERROR_NOSUCHITEM;

		if ($item['closed'])
			return _ERROR_ITEMCLOSED;

		// don't allow words that are too long
		if (eregi('[a-zA-Z0-9|\.,;:!\?=\/\\]{90,90}',$comment['body']) != false) 
			return _ERROR_COMMENT_LONGWORD;

		// check lengths of comment
		if (strlen($comment['body'])<3)
			return _ERROR_COMMENT_NOCOMMENT;

		if (strlen($comment['body'])>5000)
			return _ERROR_COMMENT_TOOLONG;
			
		// only check username if no member logged in
		if (!$member->isLoggedIn())
			if (strlen($comment['user'])<2)
				return _ERROR_COMMENT_NOUSERNAME;

		return 1;	
	}	

	
}

/**
  * This class is used when parsing comment templates
  */
class COMMENTACTIONS extends BaseActions {

	function COMMENTACTIONS(&$comments) {
		// call constructor of superclass first
		$this->BaseActions();	
		
		// reference to the comments object
		$this->setCommentsObj($comments);
	}

	function getDefinedActions() {
		return array(
			'commentcount',
			'commentword',
			'itemlink',
			'itemid',
			'date',
			'time',
			'commentid',
			'body',
			'memberid',
			'timestamp',
			'host',
			'ip',
			'blogid',
			'authtext',
			'user',
			'userid',
			'userlinkraw',
			'userlink',
			'short',
			'skinfile',
			'set',
			'plugin',
			'include',
			'phpinclude',
			'parsedinclude'
		);
	}
	
	function setParser(&$parser) {			$this->parser =& $parser; }
	function setCommentsObj(&$commentsObj) {$this->commentsObj =& $commentsObj; }
	function setTemplate($template) {		$this->template =& $template; }
	function setCurrentComment(&$comment) {	
		if ($comment['memberid'] != 0) {
			$comment['authtext'] = $template['COMMENTS_AUTH']; 

			$mem = MEMBER::createFromID($comment['memberid']);
			$comment['user'] = $mem->getDisplayName();
			if ($mem->getURL())
				$comment['userid'] = $mem->getURL();
			else
				$comment['userid'] = $mem->getEmail();

			$comment['userlinkraw'] = createMemberLink(
										$comment['memberid'], 
										$this->commentsObj->itemActions->linkparams
									  );

		} else {

			// create smart links
			if (isValidMailAddress($comment['userid']))
				$comment['userlinkraw'] = 'mailto:'.$comment['userid'];
			elseif (strstr($comment['userid'],'http://') != false)  
				$comment['userlinkraw'] = $comment['userid'];
			elseif (strstr($comment['userid'],'www') != false)
				$comment['userlinkraw'] = 'http://'.$comment['userid'];
		}
	
		$this->currentComment =& $comment; 
	}

	function parse_commentcount() {			echo $this->commentsObj->commentcount; }
	function parse_commentword() {			
		if ($this->commentsObj->commentcount == 1)
			echo $this->template['COMMENTS_ONE'];
		else
			echo $this->template['COMMENTS_MANY']; 
	}	
	
	function parse_itemlink() {				$this->commentsObj->itemActions->parse_itemlink(); }
	function parse_itemid() {				echo $this->commentsObj->itemid; }

	function parse_date() {					
		echo strftime($this->template['FORMAT_DATE'],$this->currentComment['timestamp']);
	}
	function parse_time() {					
		echo strftime($this->template['FORMAT_TIME'],$this->currentComment['timestamp']);
	}

	function parse_commentid() {			echo $this->currentComment['commentid']; }
	function parse_body() {					echo $this->currentComment['body']; }	
	function parse_memberid() {				echo $this->currentComment['memberid']; }
	function parse_timestamp() {			echo $this->currentComment['timestamp']; }	
	function parse_host() {					echo $this->currentComment['host']; }
	function parse_ip() {					echo $this->currentComment['ip']; }
	function parse_blogid() {				echo $this->currentComment['blogid']; }

	function parse_user() {					echo $this->currentComment['user']; }
	function parse_userid() {				echo $this->currentComment['userid']; }
	function parse_userlinkraw() {			echo $this->currentComment['userlinkraw']; }	
	function parse_userlink() {
		if ($this->currentComment['userlinkraw']) 
			echo '<a href="'.$this->currentComment['userlinkraw'].'">'.$this->currentComment['user'].'</a>';
		else 
			echo $this->currentComment['user'];
	}
	function parse_short() {
		$tmp = strtok($this->currentComment['body'],"\n");
		$tmp = str_replace('<br />','',$tmp);
		echo $tmp;
		if ($tmp != $this->currentComment['body'])
			$this->parser->parse($this->template['COMMENTS_CONTINUED']); 
	}
	function parse_authtext() {
		if ($this->currentComment['memberid'] != 0) 
			$this->parser->parse($this->template['COMMENTS_AUTH']);
	}
	
	/**
	  * Executes a plugin templatevar
	  *
	  * @param pluginName name of plugin (without the NP_)
	  * 
	  * extra parameters can be added
	  */
	function parse_plugin($pluginName) {
		global $manager;
		
		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName))
			return;
		
		$plugin =& $manager->getPlugin('NP_' . $pluginName);

		// get arguments
		$params = func_get_args();
		
		// remove plugin name 
		array_shift($params);
		
		// pass info on current item and current comment as well
		$params = array_merge(array(&$this->currentComment),$params);		
		$params = array_merge(array(&$this->commentsObj->itemActions->currentItem),$params);

		call_user_func_array(array(&$plugin,'doTemplateCommentsVar'), $params);
	}	
}

?>