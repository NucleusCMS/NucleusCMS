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

class BodyActions extends BaseActions
{
	private $currentItem;
	private $template;
	
	static private $defined_actions = array(
		'image',
		'media',
		'popup',
		'plugin',
		'if',
		'else',
		'endif',
		'elseif',
		'ifnot',
		'elseifnot'
	);
	
	/**
	 * BodyActions::__construct()
	 * Constructor of the BODYACTIONS
	 * 
	 * @param	void
	 * @return	void
	 */
	public function __construct()
	{
		$this->initialize();	
		return;
	}
	
	/**
	 * BodyActions::setCurrentItem()
	 * Set the current item
	 * 
	 * @param	object	&$item	reference to the current item
	 * @return	void
	 */
	public function setCurrentItem(&$item)
	{
		global $currentitemid;
		$this->currentItem =& $item;
		$currentitemid = $this->currentItem->itemid;
		return;
	}
	
	/**
	 * BodyActions::setTemplate()
	 * Set the current template
	 * 
	 * @param	string	$template	Template to be used
	 * @return	void
	 */
	public function setTemplate($template)
	{
		$this->template =& $template;
		return;
	}
	
	/**
	 * BodyActions::getDefinedActions()
	 * Get the defined actions in an item
	 * 
	 * @param	void
	 * @return	Array	self::$defined_actions
	 */
	public function getDefinedActions()
	{
		return self::$defined_actions;
	}
	
	/**
	 * BodyActions::parse_plugin()
	 * Parse a plugin var
	 * Called if <%plugin(...)%> in an item appears
	 * 
	 * Calls the doItemVar function in the plugin
	 */
	public function parse_plugin($pluginName)
	{
		global $manager;
		
		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if ( !$plugin )
		{
			return;	
		}
		
		// get arguments
		$params = func_get_args();
		
		// remove plugin name
		array_shift($params);
		
		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);
		
		call_user_func_array(array(&$plugin,'doItemVar'), $params);
		return;
	}
	
	/**
	 * BodyActions::parse_image()
	 * Parse image
	 * Called if <%image(...)%> in an item appears
	 * 
	 * @param	void
	 * @return	parsed image tag
	 */
	public function parse_image()
	{
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = preg_split('#\|#',implode($args,', '));
		echo call_user_func_array(array(&$this,'createImageCode'),$args);
	}
	
	/**
	 * BodyActions::createImageCode()
	 * Creates the code for an image
	 * 
	 * @param	string	$filename	name of file from tag
	 * @param	integer	$width		width of file from tag
	 * @param	integer	$height		height of file from tag
	 * @return	string	image element with anchor element
	 */
	public function createImageCode($filename, $width, $height, $text = '')
	{
		global $CONF;
		
		// select private collection when no collection given
		if ( !strstr($filename,'/') )
		{
			$filename = $this->currentItem->authorid . '/' . $filename;
		}
		
		$windowwidth = $width;
		$windowheight = $height;
		
		$vars['link']			= Entity::hsc($CONF['MediaURL']. $filename);
		$vars['text']			= Entity::hsc($text);
		$vars['image'] = '<img src="' . $vars['link'] . '" width="' . $width . '" height="' . $height . '" alt="' . $vars['text'] . '" title="' . $vars['text'] . '" />';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';
		
		return Template::fill($this->template['IMAGE_CODE'],$vars);;
	}
	
	/**
	 * BodyActions::parse_media()
	 * Parse media
	 * Called if <%media(...)%> in an item appears
	 * 
	 * @param	void
	 * @param	parsed media tag
	 */
	public function parse_media()
	{
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = preg_split('#\|#', implode($args,', '));
		echo call_user_func_array(array(&$this,'createMediaCode'), $args);
	}
	
	/**
	 * BodyActions::createMediaCode()
	 * Creates the code for a media
	 * 
	 * @param	string	$filename	name of file from tag
	 * @param	string	$text		alternative text from tag
	 * @return	string	text element with anchor element
	 */
	public function createMediaCode($filename, $text = '')
	{
		global $CONF;
		
		// select private collection when no collection given
		if ( !strstr($filename,'/') )
		{
			$filename = $this->currentItem->authorid . '/' . $filename;
		}
		
		$vars['link']			= Entity::hsc($CONF['MediaURL'] . $filename);
		$vars['text']			= Entity::hsc($text);
		$vars['media']			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';
		
		return Template::fill($this->template['MEDIA_CODE'], $vars);;
	}
	
	/**
	 * BodyActions::parse_popup()
	 * Parse popup
	 * Called if <%popup(...)%> in an item appears
	 * 
	 * @param	void
	 * @return	string	parsed popup tag
	 */
	public function parse_popup()
	{
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = preg_split('#\|#', implode($args,', '));
		echo call_user_func_array(array(&$this,'createPopupCode'), $args);
	}
	
	/**
	 * BodyActions::createPopupCode()
	 * Creates the code for a popup
	 * 
	 * @param	string	$filename	name of file from tag
	 * @param	integer	$width		width of file from tag
	 * @param	integer	$height		height of file from tag
	 * @param	string	$text		alternative text from tag
	 * @return	string	text element with anchor element of JavaScript window.open
	 */
	public function createPopupCode($filename, $width, $height, $text = '')
	{
		global $CONF;
		
		// select private collection when no collection given
		if ( !strstr($filename,'/') )
		{
			$filename = $this->currentItem->authorid . '/' . $filename;
		}
		
		$windowwidth = $width;
		$windowheight = $height;
		
		$vars['rawpopuplink'] 	= $CONF['Self'] . "?imagepopup=" . Entity::hsc($filename) . "&amp;width=$width&amp;height=$height&amp;imagetext=" . urlencode(Entity::hsc($text));
		$vars['popupcode'] 		= "window.open(this.href,'imagepopup','status=no,toolbar=no,scrollbars=no,resizable=yes,width=$windowwidth,height=$windowheight');return false;";
		$vars['popuptext'] 		= Entity::hsc($text);
		$vars['popuplink'] 		= '<a href="' . $vars['rawpopuplink']. '" onclick="'. $vars['popupcode'].'" >' . $vars['popuptext'] . '</a>';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['text']			= $text;
		$vars['link']			= Entity::hsc($CONF['MediaURL'] . $filename);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['popuptext'] . '</a>';
		
		return Template::fill($this->template['POPUP_CODE'], $vars);
	}
	
	/**
	 * BodyActions::checkCondition()
	 * Checks conditions for if statements
	 *
	 * @param	string	$field	type of <%if%>
	 * @param	string	$name	property of field
	 * @param	string	$value	value of property
	 * @return	condition
	 */
	public function checkCondition($field, $name='', $value = '')
	{
		global $catid, $blog, $member, $itemidnext, $itemidprev, $manager, $archiveprevexists, $archivenextexists;
		
		$condition = 0;
		switch ( $field )
		{
			case 'category':
				$condition = ($blog && $this->ifCategory($name,$value));
				break;
			case 'itemcategory':
				$condition = ($this->ifItemCategory($name,$value));
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
				$condition = $member->isLoggedIn() && $this->ifOnTeam($name);
				break;
			case 'admin':
				$condition = $member->isLoggedIn() && $this->ifAdmin($name);
				break;
			case 'author':
				$condition = ($this->ifAuthor($name,$value));
				break;
			case 'hasplugin':
				$condition = $this->ifHasPlugin($name, $value);
				break;
			default:
				$condition = $manager->pluginInstalled('NP_' . $field) && $this->ifPlugin($field, $name, $value);
				break;
		}
		return $condition;
	}	
	
	/**
	 * BodyActions::ifCategory()
	 *  Different checks for a category
	 *  
	 * @param	string	$key	key for data of category
	 * @param	string	$value	value for data of category
	 * @return	boolean
	 */
	private function ifCategory($key = '', $value = '')
	{
		global $blog, $catid;
		
		// when no parameter is defined, just check if a category is selected
		if ( ($key != 'catname' && $key != 'catid') || ($value == '') )
		{
			return $blog->isValidCategory($catid);
		}
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $blog->getCategoryIdFromName($value);
			if ( $value == $catid )
			{
				return $blog->isValidCategory($catid);
			}
		}
		
		// check category id
		if ( ($key == 'catid') && ($value == $catid) )
		{
			return $blog->isValidCategory($catid);
		}
		
		return FALSE;
	}
	
	/**
	 * BodyActions::ifAuthor()
	 * Different checks for an author
	 * 
	 * @param	string	$key	key for data of author
	 * @param	string	$value	value for data of author
	 * @return	boolean
	 */
	private function ifAuthor($key = '', $value = '')
	{
		global $member, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));
		
		// when no parameter is defined, just check if author is current visitor
		if ( ($key != 'isadmin' && $key != 'name') || ($key == 'name' && $value == '') )
		{
			return (intval($member->getID()) > 0 && intval($member->getID()) == intval($this->currentItem->authorid));
		}
		
		// check author name
		if ( $key == 'name' )
		{
			$value = strtolower($value);
			if ( $value == strtolower($this->currentItem->author) )
			{
				return TRUE;
			}
		}
		
		// check if author is admin
		if ( ($key == 'isadmin') )
		{
			$aid = intval($this->currentItem->authorid);
			$blogid = intval($b->getID());			
			$amember =& $manager->getMember($aid);
			if ( $amember->isAdmin() )
			{
				return TRUE;
			}	
			return $amember->isBlogAdmin($blogid);
		}
		
		return FALSE;
	}
	
	/**
	 * BodyActions::ifItemCategory()
	 * Different checks for a category
	 * 
	 * @param	string	$key	key for data of category
	 * @param	string	$value	value for data of category
	 * @return	boolean	
	 */
	private function ifItemCategory($key = '', $value = '')
	{
		global $catid, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));
		
		// when no parameter is defined, just check if a category is selected
		if ( ($key != 'catname' && $key != 'catid') || ($value == '') )
		{
			return $b->isValidCategory($catid);
		}
			
		$icatid = $this->currentItem->catid;
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $b->getCategoryIdFromName($value);
			if ( $value == $icatid )
			{
				return $b->isValidCategory($icatid);
			}
		}
		
		// check category id
		if ( ($key == 'catid') && ($value == $icatid) )
		{
			return $b->isValidCategory($icatid);
		}
		return FALSE;
	}
	
	/**
	 * BodyActions::ifOnTeam()
	 * Checks if a member is on the team of a blog and return his rights
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean
	 */
	private function ifOnTeam($blogName = '')
	{
		global $blog, $member, $manager;
		
		// when no blog found
		if ( ($blogName == '') && (!is_object($blog)) )
		{
			return 0;
		}
		
		// explicit blog selection
		if ( $blogName != '' )
		{
			$blogid = getBlogIDFromName($blogName);
		}
		
		if ( ($blogName == '') || !$manager->existsBlogID($blogid) )
		{
			// use current blog
			$blogid = $blog->getID();
		}
		return $member->teamRights($blogid);
	}
	
	/**
	 * BodyActions::ifAdmin()
	 * Checks if a member is admin of a blog
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean
	 */
	private function ifAdmin($blogName = '')
	{
		global $blog, $member, $manager;
		
		// when no blog found
		if ( ($blogName == '') && (!is_object($blog)) )
		{
			return 0;
		}
		
		// explicit blog selection
		if ( $blogName != '' )
		{
			$blogid = getBlogIDFromName($blogName);
		}
		
		if ( ($blogName == '') || !$manager->existsBlogID($blogid) )
		{
			// use current blog
			$blogid = $blog->getID();
		}
		return $member->isBlogAdmin($blogid);
	}
	
	
	/**
	 * BodyActions::ifHasPlugin()
	 *	hasplugin,PlugName
	 *	   -> checks if plugin exists
	 *	hasplugin,PlugName,OptionName
	 *	   -> checks if the option OptionName from plugin PlugName is not set to 'no'
	 *	hasplugin,PlugName,OptionName=value
	 *	   -> checks if the option OptionName from plugin PlugName is set to value
	 *
	 * @param	string	$name	name of plugin
	 * @param	string	$value	value for plugin argument
	 * @return	boolean
	 */
	private function ifHasPlugin($name, $value)
	{
		global $manager;
		$condition = false;
		
		// (pluginInstalled method won't write a message in the actionlog on failure)
		if ( $manager->pluginInstalled("NP_{$name}") )
		{
			$plugin =& $manager->getPlugin("NP_{$name}");
			if ( $plugin != NULL )
			{
				if ( $value == "" )
				{
					$condition = TRUE;
				}
				else
				{
					list($name2, $value2) = preg_split('#=#', $value, 2);
					if ( $value2 == "" && $plugin->getOption($name2) != 'no' )
					{
						$condition = TRUE;
					}
					else if ( $plugin->getOption($name2) == $value2 )
					{
						$condition = TRUE;
					}
				}
			}
		}
		return $condition;
	}
	
	/**
	 * BodyActions::ifPlugin()
	 * Checks if a plugin exists and call its doIf function
	 * 
	 * @param	string	$name	name of plugin
	 * @param	string	$key	...
	 * @param	string	$value	...
	 * @return	string	result of plugin 'doIf'
	 */
	private function ifPlugin($name, $key = '', $value = '')
	{
		global $manager;
		
		$plugin =& $manager->getPlugin("NP_{$name}");
		if ( !$plugin )
		{
			return;
		}
		
		$params = func_get_args();
		array_shift($params);
		
		return call_user_func_array(array(&$plugin, 'doIf'), $params);
	}
}
