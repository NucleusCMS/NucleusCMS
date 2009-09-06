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
 * This class is used when parsing comment templates
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 * @version $NucleusJP: COMMENTACTIONS.php,v 1.5.2.1 2007/08/08 05:31:31 kimitake Exp $
 */

class COMMENTACTIONS extends BaseActions {

	// ref to COMMENTS object which is using this object to handle
	// its templatevars
	var $commentsObj;

	// template to use to parse the comments
	var $template;

	// comment currenlty being handled (mysql result assoc array; see COMMENTS::showComments())
	var $currentComment;

	function COMMENTACTIONS(&$comments) {
		// call constructor of superclass first
		$this->BaseActions();

		// reference to the comments object
		$this->setCommentsObj($comments);
	}

	function getDefinedActions() {
		return array(
			'blogurl',
			'commentcount',
			'commentword',
			'email',
			'itemlink',
			'itemid',
			'itemtitle',
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
			'useremail',
			'userwebsite',
			'userwebsitelink',
			'excerpt',
			'short',
			'skinfile',
			'set',
			'plugin',
			'include',
			'phpinclude',
			'parsedinclude'
		);
	}

	function setParser(&$parser) {
		$this->parser =& $parser;
	}
	
	function setCommentsObj(&$commentsObj) {
		$this->commentsObj =& $commentsObj;
	}
	
	function setTemplate($template) {
		$this->template =& $template;
	}
	
	function setCurrentComment(&$comment) {
		global $manager;
		if ($comment['memberid'] != 0) {
			$comment['authtext'] = $template['COMMENTS_AUTH'];

			$mem =& $manager->getMember($comment['memberid']);
			$comment['user'] = $mem->getDisplayName();
			if ($mem->getURL())
				$comment['userid'] = $mem->getURL();
			else
				$comment['userid'] = $mem->getEmail();

			$comment['userlinkraw'] = createLink(
										'member',
										array(
											'memberid' => $comment['memberid'],
											'name' => $mem->getDisplayName(),
											'extra' => $this->commentsObj->itemActions->linkparams
										)
									  );

		} else {

			// create smart links
/*			if (isValidMailAddress($comment['userid']))
				$comment['userlinkraw'] = 'mailto:'.$comment['userid'];
			elseif (strstr($comment['userid'],'http://') != false)
				$comment['userlinkraw'] = $comment['userid'];
			elseif (strstr($comment['userid'],'www') != false)
				$comment['userlinkraw'] = 'http://'.$comment['userid'];*/
			if (strstr($comment['userid'],'http://') != false)
				$comment['userlinkraw'] = $comment['userid'];
			elseif (strstr($comment['userid'],'www') != false)
				$comment['userlinkraw'] = 'http://'.$comment['userid'];
			elseif (isValidMailAddress($comment['email']))
				$comment['userlinkraw'] = 'mailto:'.$comment['email'];
			elseif (isValidMailAddress($comment['userid']))
				$comment['userlinkraw'] = 'mailto:'.$comment['userid'];
		}

		$this->currentComment =& $comment;
	}

	/**
	 * Parse templatevar authtext
	 */
	function parse_authtext() {
		if ($this->currentComment['memberid'] != 0)
			$this->parser->parse($this->template['COMMENTS_AUTH']);
	}

	/**
	 * Parse templatevar blogid
	 */
	function parse_blogid() {
		echo $this->currentComment['blogid'];
	}

	/**
	 * Parse templatevar blogurl
	 */
	function parse_blogurl() {
		global $manager;
		$blogid = getBlogIDFromItemID($this->commentsObj->itemid);
		$blog =& $manager->getBlog($blogid);
		echo $blog->getURL();
	}

	/**
	 * Parse templatevar body
	 */
	function parse_body() {
		echo $this->highlight($this->currentComment['body']);
	}

	/**
	 * Parse templatevar commentcount
	 */
	function parse_commentcount() {
			echo $this->commentsObj->commentcount;
	}

	/**
	 * Parse templatevar commentid
	 */
	function parse_commentid() {
		echo $this->currentComment['commentid'];
	}

	/**
	 * Parse templatevar commentword
	 */
	function parse_commentword() {
		if ($this->commentsObj->commentcount == 1)
			echo $this->template['COMMENTS_ONE'];
		else
			echo $this->template['COMMENTS_MANY'];
	}

	/**
	 * Parse templatevar date
	 */
	function parse_date($format = '') {
		echo formatDate($format, $this->currentComment['timestamp'], $this->template['FORMAT_DATE'], $this->commentsObj->itemActions->blog);
	}
	
	/**
	 * Parse templatevar email
	 */
	function parse_email() {
		$email = $this->currentComment['email'];
		$email = str_replace('@', ' (at) ', $email);
		$email = str_replace('.', ' (dot) ', $email);
		echo $email;
	}

	/**
	 * Parse templatevar excerpt
	 */
	function parse_excerpt() {
		echo stringToXML(shorten($this->currentComment['body'], 60, '...'));
	}

	/**
	 * Parse templatevar host
	 */
	function parse_host() {
		echo $this->currentComment['host'];
	}

	/**
	 * Parse templatevar ip
	 */
	function parse_ip() {
		echo $this->currentComment['ip'];
	}

	/**
	 * Parse templatevar itemid
	 */
	function parse_itemid() {
		echo $this->commentsObj->itemid;
	}

	/**
	 * Parse templatevar itemlink
	 */
	function parse_itemlink() {
		echo createLink(
			'item',
			array(
				'itemid' => $this->commentsObj->itemid,
				'timestamp' => $this->commentsObj->itemActions->currentItem->timestamp,
				'title' => $this->commentsObj->itemActions->currentItem->title,
				'extra' => $this->commentsObj->itemActions->linkparams
			)
		);
	}

	/**
	 * Parse templatevar itemtitle
	 */
	function parse_itemtitle($maxLength = 0) {
		if ($maxLength == 0)
			$this->commentsObj->itemActions->parse_title();
		else
			$this->commentsObj->itemActions->parse_syndicate_title($maxLength);
	}

	/**
	 * Parse templatevar memberid
	 */
	function parse_memberid() {
		echo $this->currentComment['memberid'];
	}

	/**
	 * Parse templatevar short
	 */
	function parse_short() {
		$tmp = strtok($this->currentComment['body'],"\n");
		$tmp = str_replace('<br />','',$tmp);
		echo $tmp;
		if ($tmp != $this->currentComment['body'])
			$this->parser->parse($this->template['COMMENTS_CONTINUED']);
	}

	/**
	 * Parse templatevar time
	 */
	function parse_time($format = '') {
		echo strftime(
				($format == '') ? $this->template['FORMAT_TIME'] : $format,
				$this->currentComment['timestamp']
			);
	}

	/**
	 * Parse templatevar timestamp
	 */
	function parse_timestamp() {
		echo $this->currentComment['timestamp'];
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
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// pass info on current item and current comment as well
		$params = array_merge(array(&$this->currentComment),$params);
		$params = array_merge(array(&$this->commentsObj->itemActions->currentItem),$params);

		call_user_func_array(array(&$plugin,'doTemplateCommentsVar'), $params);
	}

	/**
	 * Parse templatevar user
	 */
	function parse_user($mode='') {
		global $manager;
		if ($mode == 'realname' && $this->currentComment['memberid'] > 0) {
			$member =& $manager->getMember($this->currentComment['memberid']);
			echo $member->getRealName();
		} else {
			echo $this->currentComment['user'];
		}
	}

	/**
	 * Parse templatevar useremail
	 */
	function parse_useremail() {
		global $manager;
		if ($this->currentComment['memberid'] > 0)
		{
			$member =& $manager->getMember($this->currentComment['memberid']);

			if ($member->email != '')
				echo $member->email;
		}
		else
		{
			if (isValidMailAddress($this->currentComment['email']))
				echo $this->currentComment['email'];
			elseif (isValidMailAddress($this->currentComment['userid']))
				echo $this->currentComment['userid'];
//			if (!(strpos($this->currentComment['userlinkraw'], 'mailto:') === false))
//				echo str_replace('mailto:', '', $this->currentComment['userlinkraw']);
		}
	}

	/**
	 * Parse templatevar userid
	 */
	function parse_userid() {
			echo $this->currentComment['userid'];
	}


	/**
	 * Parse templatevar userlink
	 */
	function parse_userlink() {
		if ($this->currentComment['userlinkraw']) {
			echo '<a href="'.$this->currentComment['userlinkraw'].'" rel="nofollow">'.$this->currentComment['user'].'</a>';
		} else {
			echo $this->currentComment['user'];
		}
	}

	/**
	 * Parse templatevar userlinkraw
	 */
	function parse_userlinkraw() {
		echo $this->currentComment['userlinkraw'];
	}
	
	/**
	 * Parse templatevar userwebsite
	 */
	function parse_userwebsite() {
		if (!(strpos($this->currentComment['userlinkraw'], 'http://') === false))
			echo $this->currentComment['userlinkraw'];
	}
	
	/**
	 * Parse templatevar userwebsitelink
	 */
	function parse_userwebsitelink() {
		if (!(strpos($this->currentComment['userlinkraw'], 'http://') === false)) {
			echo '<a href="'.$this->currentComment['userlinkraw'].'" rel="nofollow">'.$this->currentComment['user'].'</a>';
		} else {
			echo $this->currentComment['user'];
		}
	}

}
?>