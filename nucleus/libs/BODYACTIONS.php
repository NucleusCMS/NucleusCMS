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
 * A class to parses plugin calls inside items
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class BODYACTIONS extends BaseActions {

	var $currentItem;

	var $template;

	/**
	 * Constructor of the BODYACTIONS
	 */
	function BODYACTIONS () {
		$this->BaseActions();	
	}

	/**
	 * Set the current item
	 * 
	 * @param &$item
	 * 			reference to the current item
	 */
	function setCurrentItem(&$item) {
		$this->currentItem =& $item;
		global $currentitemid;
		$currentitemid = $this->currentItem->itemid;
	}

	/**
	 * Set the current template
	 * 
	 * @param $template
	 * 			Template to be used
	 */
	function setTemplate($template) {
		$this->template =& $template;
	}

	/**
	 * Get the defined actions in an item
	 */
	function getDefinedActions() {
		return array('image', 'media', 'popup', 'plugin', 'if', 'else', 'endif', 'elseif', 'ifnot', 'elseifnot');
	}

	/**
	 * Parse a plugin var
	 * Called if <%plugin(...)%> in an item appears
	 * 
	 * Calls the doItemVar function in the plugin
	 */
	function parse_plugin($pluginName) {
		global $manager;

		// should be already tested from the parser (PARSER.php)
		// only continue when the plugin is really installed
		/*if (!$manager->pluginInstalled('NP_' . $pluginName)) {
			return;
		}*/

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem), $params);

		call_user_func_array(array($plugin, 'doItemVar'), $params);
	}

	/**
	 * Parse image
	 * Called if <%image(...)%> in an item appears
	 */
	function parse_image() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array($this, 'createImageCode'), $args);
	}
	
	/**
	 * Creates the code for an image
	 */
	function createImageCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['link']			= htmlspecialchars($CONF['MediaURL']. $filename ,ENT_QUOTES,_CHARSET);
		$vars['text']			= htmlspecialchars($text ,ENT_QUOTES,_CHARSET);
		$vars['image'] = '<img src="' . $vars['link'] . '" width="' . $width . '" height="' . $height . '" alt="' . $vars['text'] . '" title="' . $vars['text'] . '" />';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';


		echo TEMPLATE::fill($this->template['IMAGE_CODE'],$vars);;

	}

	/**
	 * Parse media
	 * Called if <%media(...)%> in an item appears
	 */
	function parse_media() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array($this, 'createMediaCode'), $args);
	}

	/**
	 * Creates the code for a media
	 */
	function createMediaCode($filename, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename ,ENT_QUOTES,_CHARSET);
		$vars['text']			= htmlspecialchars($text ,ENT_QUOTES,_CHARSET);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';

		echo TEMPLATE::fill($this->template['MEDIA_CODE'],$vars);;
	}

	/**
	 * Parse popup
	 * Called if <%popup(...)%> in an item appears
	 */
	function parse_popup() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array($this, 'createPopupCode'), $args);
	}

	/**
	 * Creates the code for a popup
	 */
	function createPopupCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['rawpopuplink'] 	= $CONF['Self'] . "?imagepopup=" . htmlspecialchars($filename,ENT_QUOTES,_CHARSET) . "&amp;width=$width&amp;height=$height&amp;imagetext=" . urlencode(htmlspecialchars($text,ENT_QUOTES,_CHARSET));
		$vars['popupcode'] 		= "window.open(this.href,'imagepopup','status=no,toolbar=no,scrollbars=no,resizable=yes,width=$windowwidth,height=$windowheight');return false;";
		$vars['popuptext'] 		= htmlspecialchars($text,ENT_QUOTES,_CHARSET);
		$vars['popuplink'] 		= '<a href="' . $vars['rawpopuplink']. '" onclick="'. $vars['popupcode'].'" >' . $vars['popuptext'] . '</a>';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['text']			= $text;
		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename ,ENT_QUOTES,_CHARSET);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['popuptext'] . '</a>';

		echo TEMPLATE::fill($this->template['POPUP_CODE'],$vars);
	}
	
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
