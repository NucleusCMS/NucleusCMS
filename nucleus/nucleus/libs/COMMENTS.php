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
	 * @param $itemid id of the item
	 */
	function COMMENTS($itemid) {
		$this->itemid = intval($itemid);
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
		
		 if ($maxToShow == 0) {
			$commentcount = $this->amountComments();
		} else {
			$query =  'SELECT c.cnumber as commentid, c.cbody as body, c.cuser as user, c.cmail as userid, c.cmember as memberid, UNIX_TIMESTAMP(c.ctime) as timestamp, c.chost as host, c.cip as ip, c.cblog as blogid'
			       . ' FROM nucleus_comment as c'
			       . ' WHERE c.citem=' . $this->itemid 
			       . ' ORDER BY c.ctime';
			       
			$comments = sql_query($query);		
			$commentcount = mysql_num_rows($comments);
		}
		
		global $catid;
		$linkparams = array();
		if ($catid) {
			$catextra = '&amp;catid=' . $catid;
			$linkparams['catid'] = $catid;
		}
		
		$ids['itemid'] = $this->itemid;
		$ids['itemlink'] = createItemLink($this->itemid, $linkparams);
		$ids['commentcount'] = $commentcount;
		
		if ($commentcount == 1)
			$ids['commentword'] = $template['COMMENTS_ONE'];
		else
			$ids['commentword'] = $template['COMMENTS_MANY'];
		

		// if no result was found
		if ($commentcount == 0) {
			// note: when no reactions, COMMENTS_HEADER and COMMENTS_FOOTER are _NOT_ used
			if ($showNone) echo TEMPLATE::fill($template['COMMENTS_NONE'],$ids);
			return 0;
		}
		
		// if too many comments to show
		if (($maxToShow != -1) && ($commentcount > $maxToShow)) {
			echo TEMPLATE::fill($template['COMMENTS_TOOMUCH'],$ids);
			return 0;
		}
		
		echo TEMPLATE::fill($template['COMMENTS_HEADER'],$ids);
		
		while ( $row = mysql_fetch_assoc($comments) ) {

			$row['commentcount'] = $ids['commentcount'];
			$row['commentword'] = $ids['commentword'];
		
			$row['date'] = strftime($template['FORMAT_DATE'],$row['timestamp']);
			$row['time'] = strftime($template['FORMAT_TIME'],$row['timestamp']);
			$row['itemid'] = $this->itemid;
			$row['itemlink'] = createItemLink($this->itemid, $linkparams);
			
			if ($row['memberid'] != 0) {
				$row['authtext'] = $template['COMMENTS_AUTH']; 
				
				$mem = MEMBER::createFromID($row['memberid']);
				$row['user'] = $mem->getDisplayName();
				if ($mem->getURL())
					$row['userid'] = $mem->getURL();
				else
					$row['userid'] = $mem->getEmail();
				
				$row['userlinkraw'] = createMemberLink($row['memberid'], $linkparams);
				
			} else {

				// create smart links
				if (isValidMailAddress($row['userid']))
					$row['userlinkraw'] = 'mailto:'.$row['userid'];
				elseif (strstr($row['userid'],'http://') != false)  
					$row['userlinkraw'] = $row['userid'];
				elseif (strstr($row['userid'],'www') != false)
					$row['userlinkraw'] = 'http://'.$row['userid'];
			}

			if ($row['userlinkraw']) 
				$row['userlink'] = '<a href="'.$row['userlinkraw'].'">'.$row['user'].'</a>';
			else 
				$row['userlink'] = $row['user'];
			
			// provide a chopped-off version for summaries (like on main pages)
			$row['short'] = strtok($row['body'],"\n");
			$row['short'] = str_replace('<br />','',$row['short']);
			$row['itemlink'] = createItemLink($this->itemid, $linkparams);
			if ($row['short'] != $row['body'])
				$row['short'] .= TEMPLATE::fill($template['COMMENTS_CONTINUED'],$row); 
				// (fillTemplate allows for itemid-tags to be filled out)
			
		
			$manager->notify('PreComment', array('comment' => &$row));
			echo TEMPLATE::fill($template['COMMENTS_BODY'],$row);
			$manager->notify('PostComment', array('comment' => &$row));			
						
		}

		echo TEMPLATE::fill($template['COMMENTS_FOOTER'],$ids);
		
		mysql_free_result($comments);
				
		return $commentcount;
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

		$name = addslashes($comment['user']);
		$url = addslashes($comment['userid']);
		$body = addslashes($comment['body']);
		$host = addslashes($comment['host']);
		$ip = addslashes($comment['ip']);
		$memberid = intval($comment['memberid']);
		$timestamp = date('Y-m-d H:i:s', $comment['timestamp']);
		$itemid = $this->itemid;
				
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

