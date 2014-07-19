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
 * This class is used to parse item templates
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class ITEMACTIONS extends BaseActions {

	// contains an assoc array with parameters that need to be included when
	// generating links to items/archives/... (e.g. catid)
	var $linkparams;

	// true when the current user is a blog admin (and thus allowed to edit all items)
	var $allowEditAll;

	// timestamp of last visit
	var $lastVisit;

	// item currently being handled (mysql result object, see BLOG::showUsingQuery)
	var $currentItem;

	// reference to the blog currently being displayed
	var $blog;

	// associative array with template info (part name => contents)
	var $template;

	// true when comments need to be displayed
	var $showComments;

	function ITEMACTIONS(&$blog) {
		// call constructor of superclass first
		$this->BaseActions();

		// extra parameters for created links
		global $catid;
		if ($catid)
			$this->linkparams = array('catid' => $catid);

		// check if member is blog admin (and thus allowed to edit all items)
		global $member;
		$this->allowEditAll = ($member->isLoggedIn() && $member->blogAdminRights($blog->getID()));
		$this->setBlog($blog);
	}

	/**
	  * Returns an array with the actions that are defined
	  * in the ITEMACTIONS class
	  */
	function getDefinedActions() {
		return array(
			'blogid',
			'title',
			'body',
			'more',
			'smartbody',
			'itemid',
			'morelink',
			'category',
			'categorylink',
			'author',
			'authorid',
			'authorlink',
			'catid',
			'karma',
			'date',
			'time',
			'query',
			'itemlink',
			'blogurl',
			'closed',
			'syndicate_title',
			'syndicate_description',
			'karmaposlink',
			'karmaneglink',
			'new',
			'image',
			'popup',
			'media',
			'daylink',
			'query',
			'include',
			'phpinclude',
			'parsedinclude',
			'skinfile',
			'set',
			'plugin',
			'edit',
			'editlink',
			'editpopupcode',
			'comments',
			'relevance',
			'if',
			'else',
			'endif',
			'elseif',
			'ifnot',
			'elseifnot'
		);
	}

	function setLastVisit($lastVisit) {
		$this->lastVisit = $lastVisit;
	}

	function setParser(&$parser) {
		$this->parser =& $parser;
	}

	function setCurrentItem(&$item) {
		$this->currentItem =& $item;
		global $currentitemid;
		if (is_array($this->currentItem)) {
			$currentitemid = $this->currentItem['itemid'];
		} else {
			$currentitemid = $this->currentItem->itemid;
		}
	}

	function setBlog(&$blog) {
		$this->blog =& $blog;
	}

	function setTemplate($template) {
		$this->template =& $template;
	}

	function setShowComments($val) {
		$this->showComments = $val;
	}

	// methods used by parser to insert content


	/**
	 * Parse templatevar blogid
	 */
	function parse_blogid() {
		echo $this->blog->getID();
	}

	/**
	 * Parse templatevar body
	 */
	function parse_body() {
		$this->highlightAndParse($this->currentItem->body);
	}

	/**
	 * Parse templatevar more
	 */
	function parse_more() {
		$this->highlightAndParse($this->currentItem->more);
	}

	/**
	 * Parse templatevar itemid
	 */
	function parse_itemid() {
		echo $this->currentItem->itemid;
	}

	/**
	 * Parse templatevar category
	 */
	function parse_category() {
		echo $this->currentItem->category;
	}

	/**
	 * Parse templatevar categorylink
	 */
	function parse_categorylink() {
		echo createLink('category', array('catid' => $this->currentItem->catid, 'name' => $this->currentItem->category));
	}

	/**
	 * Parse templatevar catid
	 */
	function parse_catid() {
		echo $this->currentItem->catid;
	}

	/**
	 * Parse templatevar authorid
	 */
	function parse_authorid() {
		echo $this->currentItem->authorid;
	}

	/**
	 * Parse templatevar authorlink
	 */
	function parse_authorlink() {
		echo createLink(
			'member',
			array(
				'memberid' => $this->currentItem->authorid,
				'name' => $this->currentItem->author,
				'extra' => $this->linkparams
			)
		);
	}

	/**
	 * Parse templatevar query
	 */
	function parse_query() {
		echo $this->strHighlight;
	}

	/**
	 * Parse templatevar itemlink
	 */
	function parse_itemlink() {
		echo createLink(
			'item',
			array(
				'itemid' => $this->currentItem->itemid,
				'title' => $this->currentItem->title,
				'timestamp' => $this->currentItem->timestamp,
				'extra' => $this->linkparams
			)
		);
	}

	/**
	 * Parse templatevar blogurl
	 */
	function parse_blogurl() {
		echo $this->blog->getURL();
	}

	/**
	 * Parse templatevar closed
	 */
	function parse_closed() {
		echo $this->currentItem->closed;
	}

	/**
	 * Parse templatevar relevance
	 */
	function parse_relevance() {
		echo round($this->currentItem->score,2);
	}

	/**
	 * Parse templatevar title
	 *
	 * @param string $format defines in which format the title is shown
	 */
	function parse_title($format = '') {
		if (is_array($this->currentItem)) {
			$itemtitle = $this->currentItem['title'];
		} elseif (is_object($this->currentItem)) {
			$itemtitle = $this->currentItem->title;
		}
		switch ($format) {
			case 'xml':
//				echo stringToXML ($this->currentItem->title);
				echo stringToXML ($itemtitle);
				break;
			case 'attribute':
//				echo stringToAttribute ($this->currentItem->title);
				echo stringToAttribute ($itemtitle);
				break;
			case 'raw':
//				echo $this->currentItem->title;
				echo $itemtitle;
				break;
			default:
//				$this->highlightAndParse($this->currentItem->title);
				$this->highlightAndParse($itemtitle);
				break;
		}
	}

	/**
	 * Parse templatevar karma
	 */
	function parse_karma($type = 'totalscore') {
		global $manager;

		// get karma object
		$karma =& $manager->getKarma($this->currentItem->itemid);

		switch($type) {
			case 'pos':
				echo $karma->getNbPosVotes();
				break;
			case 'neg':
				echo $karma->getNbNegVotes();
				break;
			case 'votes':
				echo $karma->getNbOfVotes();
				break;
			case 'posp':
				$percentage = $karma->getNbOfVotes() ? 100 * ($karma->getNbPosVotes() / $karma->getNbOfVotes()) : 50;
				echo number_format($percentage,2), '%';
				break;
			case 'negp':
				$percentage = $karma->getNbOfVotes() ? 100 * ($karma->getNbNegVotes() / $karma->getNbOfVotes()) : 50;
				echo number_format($percentage,2), '%';
				break;
			case 'totalscore':
			default:
				echo $karma->getTotalScore();
				break;
		}

	}

	/**
	 * Parse templatevar author
	 */
	function parse_author($which = '') {
		switch($which)
		{
			case 'realname':
				echo $this->currentItem->authorname;
				break;
			case 'id':
				echo $this->currentItem->authorid;
				break;
			case 'email':
				echo $this->currentItem->authormail;
				break;
			case 'url':
				echo $this->currentItem->authorurl;
				break;
			case 'name':
			default:
				echo $this->currentItem->author;
		}
	}

	/**
	 * Parse templatevar smartbody
	 */
	function parse_smartbody() {
		if (!$this->currentItem->more) {
			$this->highlightAndParse($this->currentItem->body);
		} else {
			$this->highlightAndParse($this->currentItem->more);
		}
	}

	/**
	 * Parse templatevar morelink
	 */
	function parse_morelink() {
		if ($this->currentItem->more)
			$this->parser->parse($this->template['MORELINK']);
	}

	/**
	 * Parse templatevar date
	 *
	 * @param format optional strftime format
	 */
	function parse_date($format = '') {
		if (!isset($this->template['FORMAT_DATE'])) $this->template['FORMAT_DATE'] = '';
		echo formatDate($format, $this->currentItem->timestamp, $this->template['FORMAT_DATE'], $this->blog);
	}

	/**
	  * Parse templatevar time
	  *
	  * @param format optional strftime format
	  */
	function parse_time($format = '') {
		if (!isset($this->template['FORMAT_TIME'])) $this->template['FORMAT_TIME'] = '';
		echo strftime($format ? $format : $this->template['FORMAT_TIME'],$this->currentItem->timestamp);
	}

	/**
	  * Parse templatevar syndicate_title
	  *
	  * @param maxLength optional maximum length
	  */
	function parse_syndicate_title($maxLength = 100) {
		$syndicated = strip_tags($this->currentItem->title);
		echo hsc(shorten($syndicated,$maxLength,'...'));
	}

	/**
	  * Parse templatevar syndicate_description
	  *
	  * @param maxLength optional maximum length
	  */
	function parse_syndicate_description($maxLength = 250, $addHighlight = 0) {
		$syndicated = strip_tags($this->currentItem->body);
		if ($addHighlight) {
			$tmp_highlight = hsc(shorten($syndicated,$maxLength,'...'));
			echo $this->highlightAndParse($tmp_highlight);
		} else {
			echo hsc(shorten($syndicated,$maxLength,'...'));
		}
	}

	/**
	  * Parse templatevar karmaposlink
	  *
	  * @param string text
	  */
	function parse_karmaposlink($text = '') {
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votepositive&amp;itemid='.$this->currentItem->itemid;
		echo $text ? '<a href="'.$link.'">'.$text.'</a>' : $link;
	}

	/**
	  * Parse templatevar karmaneglink
	  *
	  * @param string text
	  */
	function parse_karmaneglink($text = '') {
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votenegative&amp;itemid='.$this->currentItem->itemid;
		echo $text ? '<a href="'.$link.'">'.$text.'</a>' : $link;
	}

	/**
	  * Parse templatevar new
	  */
	function parse_new() {
		if (($this->lastVisit != 0) && ($this->currentItem->timestamp > $this->lastVisit))
			echo $this->template['NEW'];
	}

	/**
	  * Parse templatevar daylink
	  */
	function parse_daylink() {
		echo createArchiveLink($this->blog->getID(), strftime('%Y-%m-%d',$this->currentItem->timestamp), $this->linkparams);
	}

	/**
	  * Parse templatevar comments
	  */
	function parse_comments($maxToShow = 0) {
		if ($maxToShow == 0)
			$maxToShow = $this->blog->getMaxComments();

		// add comments
		if ($this->showComments && $this->blog->commentsEnabled()) {
			$comments = new COMMENTS($this->currentItem->itemid);
			$comments->setItemActions($this);
			$comments->showComments($this->template, $maxToShow, $this->currentItem->closed ? 0 : 1, $this->strHighlight);
		}
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

		// should be already tested from the parser (PARSER.php)
		// only continue when the plugin is really installed
		/*if (!$manager->pluginInstalled('NP_' . $pluginName))
			return;*/

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);

		call_user_func_array(array($plugin, 'doTemplateVar'), $params);
	}

	/**
	  * Parse templatevar edit
	  */
	function parse_edit() {
		global $member, $CONF;
		if ($this->allowEditAll || ($member->isLoggedIn() && ($member->getID() == $this->currentItem->authorid)) ) {
			$this->parser->parse($this->template['EDITLINK']);
		}
	}

	/**
	  * Parse templatevar editlink
	  */
	function parse_editlink() {
		global $CONF;
		echo $CONF['AdminURL'],'bookmarklet.php?action=edit&amp;itemid=',$this->currentItem->itemid;
	}

	/**
	  * Parse templatevar editpopupcode
	  */
	function parse_editpopupcode() {
		echo "if (event &amp;&amp; event.preventDefault) event.preventDefault();winbm=window.open(this.href,'nucleusbm','scrollbars=yes,width=600,height=550,left=10,top=10,status=yes,resizable=yes');winbm.focus();return false;";
	}

	// helper functions

	/**
	 * Parses highlighted text, with limited actions only (to prevent not fully trusted team members
	 * from hacking your weblog.
	 * 'plugin variables in items' implementation by Andy
	 */
	function highlightAndParse(&$data) {
		$actions = new BODYACTIONS($this->blog);
		$parser = new PARSER($actions->getDefinedActions(), $actions);
		$actions->setTemplate($this->template);
		$actions->setHighlight($this->strHighlight);
		$actions->setCurrentItem($this->currentItem);
		//$actions->setParser($parser);
		$parser->parse($actions->highlight($data));
	}

	/*
	// this is the function previous to the 'plugin variables in items' implementation by Andy
	function highlightAndParse(&$data) {
		// allow only a limited subset of actions (do not allow includes etc, they might be evil)
		$this->parser->actions = array('image','media','popup');
		$tmp_highlight = $this->highlight($data);
		$this->parser->parse($tmp_highlight);
		$this->parser->actions = $this->getDefinedActions();
	}
	*/
	
	// function to enable if-else-elseif-elseifnot-ifnot-endif to item template fields
	
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
				$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));
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
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));

		// when no parameter is defined, just check if author is current visitor
		if (($name != 'isadmin' && $name != 'name') || ($name == 'name' && $value == '')) {
			return (intval($member->getID()) > 0 && intval($member->getID()) == intval($this->currentItem->authorid));
		}

		// check author name
		if ($name == 'name') {
			$value = strtolower($value);
			if ($value == strtolower($this->currentItem->author))
				return true;
		}

		// check if author is admin
		if (($name == 'isadmin')) {			
			$aid = intval($this->currentItem->authorid);
			$blogid = intval($b->getID());			
			$amember =& $manager->getMember($aid);
			if ($amember->isAdmin())
				return true;
				
			return $amember->isBlogAdmin($blogid);
		}

		return false;
	}
	
	/**
	 *  Different checks for a category
	 */
	function _ifItemCategory($name = '', $value='') {
		global $catid, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));

		// when no parameter is defined, just check if a category is selected
		if (($name != 'catname' && $name != 'catid') || ($value == ''))
			return $b->isValidCategory($catid);
			
		$icatid = $this->currentItem->catid;
		//$icategory = $this->currentItem->category;

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

		// when no blog found
		if (($blogName == '') && (!is_object($blog)))
			return 0;

		// explicit blog selection
		if ($blogName != '')
			$blogid = getBlogIDFromName($blogName);

		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $blog->getID();

		return $member->teamRights($blogid);
	}

	/**
	 *  Checks if a member is admin of a blog
	 */
	function _ifAdmin($blogName = '') {
		global $blog, $member, $manager;

		// when no blog found
		if (($blogName == '') && (!is_object($blog)))
			return 0;

		// explicit blog selection
		if ($blogName != '')
			$blogid = getBlogIDFromName($blogName);

		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $blog->getID();

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