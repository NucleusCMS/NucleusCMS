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
			'parsedinclude',
			'if',
			'else',
			'endif',
			'elseif',
			'ifnot',
			'elseifnot'
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

		// begin if: member comment
		if ($comment['memberid'] != 0)
		{
			$comment['authtext'] = $template['COMMENTS_AUTH'];

			$mem =& $manager->getMember($comment['memberid']);
			$comment['user'] = $mem->getDisplayName();

			// begin if: member URL exists, set it as the userid
			if ($mem->getURL() )
			{
				$comment['userid'] = $mem->getURL();
			}
			// else: set the email as the userid
			else
			{
				$comment['userid'] = $mem->getEmail();
			} // end if

			$comment['userlinkraw'] = createLink(
										'member',
										array(
											'memberid' => $comment['memberid'],
											'name' => $mem->getDisplayName(),
											'extra' => $this->commentsObj->itemActions->linkparams
										)
									);

		}
		// else: non-member comment
		else
		{

			// create smart links

			// begin if: comment userid is not empty
			if (!empty($comment['userid']) )
			{

				// begin if: comment userid has either "http://" or "https://" at the beginning
				if ( (strpos($comment['userid'], 'http://') === 0) || (strpos($comment['userid'], 'https://') === 0) )
				{
					$comment['userlinkraw'] = $comment['userid'];
				}
				// else: prepend the "http://" (backwards compatibility before rev 1471)
				else
				{
					$comment['userlinkraw'] = 'http://' . $comment['userid'];
				} // end if

			}
			// else if: comment email is valid
			else if (isValidMailAddress($comment['email']) )
			{
				$comment['userlinkraw'] = 'mailto:' . $comment['email'];
			}
			// else if: comment userid is a valid email
			else if (isValidMailAddress($comment['userid']) )
			{
				$comment['userlinkraw'] = 'mailto:' . $comment['userid'];
			} // end if

		} // end if

		$this->currentComment =& $comment;
		global $currentcommentid, $currentcommentarray;
		$currentcommentid = $comment['commentid'];
		$currentcommentarray = $comment;
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
		$params = array_merge(array(&$this->currentComment), $params);
		$params = array_merge(array(&$this->commentsObj->itemActions->currentItem), $params);

		call_user_func_array(array($plugin, 'doTemplateCommentsVar'), $params);
	}

	/**
	 * Parse templatevar user
	 * @param string $mode
	 */
	function parse_user($mode = '')
	{
		global $manager;

		if ( $mode == 'realname' && $this->currentComment['memberid'] > 0 )
		{
			$member =& $manager->getMember($this->currentComment['memberid']);
			echo $member->getRealName();
		}
		else
		{
			echo htmlspecialchars($this->currentComment['user'],ENT_QUOTES,_CHARSET);
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

	// function to enable if-else-elseif-elseifnot-ifnot-endif to comment template fields

	/**
	 * Checks conditions for if statements
	 *
	 * @param string $field type of <%if%>
	 * @param string $name property of field
	 * @param string $value value of property
	 */
	function checkCondition($field, $name='', $value = '') {
		global $catid, $blog, $member, $itemidnext, $itemidprev, $manager, $archiveprevexists, $archivenextexists;

		$condition = 0;
		switch($field) {
			case 'category':
				$condition = ($blog && $this->_ifCategory($name,$value));
				break;
			case 'itemcategory':
				$condition = ($this->_ifItemCategory($name,$value));
				break;
			case 'blogsetting':
				$condition = ($blog && ($blog->getSetting($name) == $value));
				break;
			case 'itemblogsetting':
				$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
				$condition = ($b && ($b->getSetting($name) == $value));
				break;
			case 'loggedin':
				$condition = $member->isLoggedIn();
				break;
			case 'onteam':
				$condition = $member->isLoggedIn() && $this->_ifOnTeam($name);
				break;
			case 'admin':
				$condition = $member->isLoggedIn() && $this->_ifAdmin($name);
				break;
			case 'author':
				$condition = ($this->_ifAuthor($name,$value));
				break;
/*			case 'nextitem':
				$condition = ($itemidnext != '');
				break;
			case 'previtem':
				$condition = ($itemidprev != '');
				break;
			case 'archiveprevexists':
				$condition = ($archiveprevexists == true);
				break;
			case 'archivenextexists':
				$condition = ($archivenextexists == true);
				break;
			case 'skintype':
				$condition = ($name == $this->skintype);
				break; */
			case 'hasplugin':
				$condition = $this->_ifHasPlugin($name, $value);
				break;
			default:
				$condition = $manager->pluginInstalled('NP_' . $field) && $this->_ifPlugin($field, $name, $value);
				break;
		}
		return $condition;
	}

	/**
	 *  Different checks for a category
	 */
	function _ifCategory($name = '', $value='') {
		global $blog, $catid;

		// when no parameter is defined, just check if a category is selected
		if (($name != 'catname' && $name != 'catid') || ($value == ''))
			return $blog->isValidCategory($catid);

		// check category name
		if ($name == 'catname') {
			$value = $blog->getCategoryIdFromName($value);
			if ($value == $catid)
				return $blog->isValidCategory($catid);
		}

		// check category id
		if (($name == 'catid') && ($value == $catid))
			return $blog->isValidCategory($catid);

		return false;
	}


	/**
	 *  Different checks for an author
	 */
	function _ifAuthor($name = '', $value='') {
		global $member, $manager;

		if ($this->currentComment['memberid'] == 0) return false;

		$mem =& $manager->getMember($this->currentComment['memberid']);
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		$citem =& $manager->getItem($this->currentComment['itemid'],1,1);

		// when no parameter is defined, just check if item author is current visitor
		if (($name != 'isadmin' && $name != 'name' && $name != 'isauthor' && $name != 'isonteam')) {
			return (intval($member->getID()) > 0 && intval($member->getID()) == intval($citem['authorid']));
		}

		// check comment author name
		if ($name == 'name') {
			$value = trim(strtolower($value));
			if ($value == '')
				return false;
			if ($value == strtolower($mem->getDisplayName()))
				return true;
		}

		// check if comment author is admin
		if ($name == 'isadmin') {
			$blogid = intval($b->getID());
			if ($mem->isAdmin())
				return true;

			return $mem->isBlogAdmin($blogid);
		}

		// check if comment author is item author
		if ($name == 'isauthor') {
			return (intval($citem['authorid']) == intval($this->currentComment['memberid']));
		}

		// check if comment author is on team
		if ($name == 'isonteam') {
			return $mem->teamRights(intval($b->getID()));
		}

		return false;
	}

	/**
	 *  Different checks for a category
	 */
	function _ifItemCategory($name = '', $value='') {
		global $catid, $manager;

		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		$citem =& $manager->getItem($this->currentComment['itemid'],1,1);
		$icatid = $citem['catid'];

		// when no parameter is defined, just check if a category is selected
		if (($name != 'catname' && $name != 'catid') || ($value == ''))
			return $b->isValidCategory($icatid);

		// check category name
		if ($name == 'catname') {
			$value = $b->getCategoryIdFromName($value);
			if ($value == $icatid)
				return $b->isValidCategory($icatid);
		}

		// check category id
		if (($name == 'catid') && ($value == $icatid))
			return $b->isValidCategory($icatid);

		return false;
	}


	/**
	 *  Checks if a member is on the team of a blog and return his rights
	 */
	function _ifOnTeam($blogName = '') {
		global $blog, $member, $manager;

		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));

		// when no blog found
		if (($blogName == '') && (!is_object($b)))
			return 0;

		// explicit blog selection
		if ($blogName != '')
			$blogid = getBlogIDFromName($blogName);

		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $b->getID();

		return $member->teamRights($blogid);
	}

	/**
	 *  Checks if a member is admin of a blog
	 */
	function _ifAdmin($blogName = '') {
		global $blog, $member, $manager;

		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));

		// when no blog found
		if (($blogName == '') && (!is_object($b)))
			return 0;

		// explicit blog selection
		if ($blogName != '')
			$blogid = getBlogIDFromName($blogName);

		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $b->getID();

		return $member->isBlogAdmin($blogid);
	}


	/**
	 *	hasplugin,PlugName
	 *	   -> checks if plugin exists
	 *	hasplugin,PlugName,OptionName
	 *	   -> checks if the option OptionName from plugin PlugName is not set to 'no'
	 *	hasplugin,PlugName,OptionName=value
	 *	   -> checks if the option OptionName from plugin PlugName is set to value
	 */
	function _ifHasPlugin($name, $value) {
		global $manager;
		$condition = false;
		// (pluginInstalled method won't write a message in the actionlog on failure)
		if ($manager->pluginInstalled('NP_'.$name)) {
			$plugin =& $manager->getPlugin('NP_' . $name);
			if ($plugin != NULL) {
				if ($value == "") {
					$condition = true;
				} else {
					list($name2, $value2) = explode('=', $value, 2);
					if ($value2 == "" && $plugin->getOption($name2) != 'no') {
						$condition = true;
					} else if ($plugin->getOption($name2) == $value2) {
						$condition = true;
					}
				}
			}
		}
		return $condition;
	}

	/**
	 * Checks if a plugin exists and call its doIf function
	 */
	function _ifPlugin($name, $key = '', $value = '') {
		global $manager;

		$plugin =& $manager->getPlugin('NP_' . $name);
		if (!$plugin) return;

		$params = func_get_args();
		array_shift($params);

		return call_user_func_array(array($plugin, 'doIf'), $params);
	}

}
?>
