<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * This class to parse item templates
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 * @version $Id: ITEMACTIONS.php,v 1.2 2006-07-20 08:01:52 kimitake Exp $
 * @version $NucleusJP$
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
			'relevance'/*,
			'if',
			'else',
			'endif',
			'elseif',
			'ifnot',
			'elseifnot'*/
		);
	}



	function setLastVisit($lastVisit) {		$this->lastVisit = $lastVisit; }
	function setParser(&$parser) {			$this->parser =& $parser; }
	function setCurrentItem(&$item) {		$this->currentItem =& $item; }
	function setBlog(&$blog) {				$this->blog =& $blog; }
	function setTemplate($template) {		$this->template =& $template; }
	function setShowComments($val) {		$this->showComments = $val; }

	// methods used by parser to insert content

	function parse_blogid() {		echo $this->blog->getID();	}
	function parse_body() {			$this->highlightAndParse($this->currentItem->body); }
	function parse_more() {			$this->highlightAndParse($this->currentItem->more); }
	function parse_itemid() {		echo $this->currentItem->itemid; }
	function parse_category() {		echo $this->currentItem->category; }
	function parse_categorylink() {	echo createLink('category', array('catid' => $this->currentItem->catid, 'name' => $this->currentItem->category)); }
	function parse_catid() {		echo $this->currentItem->catid; }
	function parse_authorid() {		echo $this->currentItem->authorid; }
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
	function parse_query() {		echo $this->strHighlight; }
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
	function parse_blogurl() {		echo $this->blog->getURL(); }
	function parse_closed() {		echo $this->currentItem->closed; }
	function parse_relevance() {    echo round($this->currentItem->score,2);}

	function parse_title($format = '') {
		switch ($format) {
			case 'xml':
				echo stringToXML ($this->currentItem->title);
				break;
			case 'attribute':
				echo stringToAttribute ($this->currentItem->title);
				break;
			case 'raw':
				echo $this->currentItem->title;
				break;
			default:
				$this->highlightAndParse($this->currentItem->title);
				break;
		}
	}

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

	function parse_smartbody() {
		if (!$this->currentItem->more) {
			$this->highlightAndParse($this->currentItem->body);
		} else {
			$this->highlightAndParse($this->currentItem->more);
		}
	}

	function parse_morelink() {
		if ($this->currentItem->more)
			$this->parser->parse($this->template['MORELINK']);
	}

	function parse_date($format = '') {
		echo formatDate($format, $this->currentItem->timestamp, $this->template['FORMAT_DATE'], $this->blog);
	}

	/**
	  * @param format optional strftime format
	  */
	function parse_time($format = '') {
		echo strftime($format ? $format : $this->template['FORMAT_TIME'],$this->currentItem->timestamp);
	}

	/**
	  * @param maxLength optional maximum length
	  */
	function parse_syndicate_title($maxLength = 100) {
		$syndicated = strip_tags($this->currentItem->title);
		echo htmlspecialchars(shorten($syndicated,$maxLength,'...'));
	}

	/**
	  * @param maxLength optional maximum length
	  */
	function parse_syndicate_description($maxLength = 250, $addHighlight = 0) {
		$syndicated = strip_tags($this->currentItem->body);
		if ($addHighlight) {
			$tmp_highlight = htmlspecialchars(shorten($syndicated,$maxLength,'...'));
			echo $this->highlightAndParse($tmp_highlight);
		} else {
			echo htmlspecialchars(shorten($syndicated,$maxLength,'...'));
		}
	}

	function parse_karmaposlink($text = '') {
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votepositive&amp;itemid='.$this->currentItem->itemid;
		echo $text ? '<a href="'.$link.'">'.$text.'</a>' : $link;
	}

	function parse_karmaneglink($text = '') {
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votenegative&amp;itemid='.$this->currentItem->itemid;
		echo $text ? '<a href="'.$link.'">'.$text.'</a>' : $link;
	}

	function parse_new() {
		if (($this->lastVisit != 0) && ($this->currentItem->timestamp > $this->lastVisit))
			echo $this->template['NEW'];
	}

	function parse_image() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createImageCode'),$args);
	}
	function parse_popup() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createPopupCode'),$args);
	}
	function parse_media() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createMediaCode'),$args);
	}

	function parse_daylink() {
		echo createArchiveLink($this->blog->getID(), strftime('%Y-%m-%d',$this->currentItem->timestamp), $this->linkparams);
	}

	function parse_comments($maxToShow = 0) {
		if ($maxToShow == 0)
			$maxToShow = $this->blog->getMaxComments();

		// add comments
		if ($this->showComments && $this->blog->commentsEnabled()) {
			$comments =& new COMMENTS($this->currentItem->itemid);
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

		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName))
			return;

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);

		call_user_func_array(array(&$plugin,'doTemplateVar'), $params);
	}

	function parse_edit() {
		global $member, $CONF;
		if ($this->allowEditAll || ($member->isLoggedIn() && ($member->getID() == $this->currentItem->authorid)) ) {
			$this->parser->parse($this->template['EDITLINK']);
		}
	}

	function parse_editlink() {
		global $CONF;
		echo $CONF['AdminURL'],'bookmarklet.php?action=edit&amp;itemid=',$this->currentItem->itemid;
	}

	function parse_editpopupcode() {
		echo "if (event &amp;&amp; event.preventDefault) event.preventDefault();winbm=window.open(this.href,'nucleusbm','scrollbars=yes,width=600,height=500,left=10,top=10,status=yes,resizable=yes');winbm.focus();return false;";
	}

	// helper functions

	/**
	 * Parses highlighted text, with limited actions only (to prevent not fully trusted team members
	 * from hacking your weblog.
	 * 'plugin variables in items' implementation by Andy
	 */
	function highlightAndParse(&$data) {
		$actions =& new BODYACTIONS($this->blog);
		$parser =& new PARSER($actions->getDefinedActions(), $actions);
		$actions->setTemplate($this->template);
		$actions->setHighlight($this->strHighlight);
		$actions->setCurrentItem($this->currentItem);
		$actions->setParser($parser);
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

	function createPopupCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['rawpopuplink'] 	= $CONF['Self'] . "?imagepopup=" . htmlspecialchars($filename) . "&amp;width=$width&amp;height=$height&amp;imagetext=" . urlencode(htmlspecialchars($text));
		$vars['popupcode'] 		= "window.open(this.href,'imagepopup','status=no,toolbar=no,scrollbars=no,resizable=yes,width=$windowwidth,height=$windowheight');return false;";
		$vars['popuptext'] 		= htmlspecialchars($text);
		$vars['popuplink'] 		= '<a href="' . $vars['rawpopuplink']. '" onclick="'. $vars['popupcode'].'" >' . $vars['popuptext'] . '</a>';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['text']			= $text;
		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['popuptext'] . '</a>';

		echo TEMPLATE::fill($this->template['POPUP_CODE'],$vars);
	}

	function createImageCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['link']			= htmlspecialchars($CONF['MediaURL']. $filename);
		$vars['text']			= htmlspecialchars($text);
		$vars['image'] = '<img src="' . $vars['link'] . '" width="' . $width . '" height="' . $height . '" alt="' . $vars['text'] . '" title="' . $vars['text'] . '" />';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';


		echo TEMPLATE::fill($this->template['IMAGE_CODE'],$vars);;

	}

	function createMediaCode($filename, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename);
		$vars['text']			= htmlspecialchars($text);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';

		echo TEMPLATE::fill($this->template['MEDIA_CODE'],$vars);;
	}
}

/**
 * A class to parse plugin calls inside items
 */
class BODYACTIONS extends ITEMACTIONS {

	function getDefinedActions() {
		return array('image','media','popup','plugin');
	}

	function parse_plugin($pluginName) {
		global $manager;

		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName)) {
			return;
		}

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);

		call_user_func_array(array(&$plugin,'doItemVar'), $params);
	}
}
?>
