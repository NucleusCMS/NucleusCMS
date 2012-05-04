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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

/**
 * The formfactory class can be used to insert add/edit item forms into
 * admin area, bookmarklet, skins or any other places where such a form
 * might be needed
 */
class PageFactory extends BaseActions
{
	/**
	 * PageFactory::$blog
	 * Reference to the blog object for which an add:edit form is created
	 */
	private $blog = NULL;
	
	/**
	 * PageFactory::$type
	 * One of the types got by self::getAvailableSkinTypes()
	 */
	private $type = '';
	
	/**
	 * PageFactory::$method
	 * 'add' or 'edit'
	 */
	private $method = '';
	
	/**
	 * PageFactory::$variables
	 * Info to fill out in the form (e.g. catid, itemid, ...)
	 */
	private $variables = array();
	
	/**
	 * PageFactory::$actions
	 * Allowed actions (for parser)
	 */
	// TODO: move the definition of actions to the createXForm methods
	static private $defined_actions = array(
		'authorname',
		'blogid',
		'bloglink',
		'blogname',
		'categories',
		'checkedonval',
		'contents',
		'currenttime',
		'extrahead',
		'helplink',
		'init',
		'itemoptions',
		'itemtime',
		'jsbuttonbar',
		'jsinput',
		'pluginextras',
		'ticket',
		'title'
	);
	
	static private $default_skin_types = array(
		'bookmarklet'	=> '',
		'admin'			=> ''
	);
	
	/**
	 * AdminActions::getSkinTypeFriendlyNames()
	 * 
	 * @static
	 * @param	void
	 * @return	array	list of friendly names for page actions
	 */
	static public function getAvailableSkinTypes()
	{
		return self::$default_skin_types;
	}
	
	/**
	 * PageFactory::__construct()
	 * Creates a new PAGEFACTORY object
	 * 
	 * @param	object	$blog
	 * @return	void
	 */
	public function __construct(&$blog)
	{
		global $manager;
		
		parent::__construct();
		
		$this->blog =& $blog;
		
		return;
	}
	
	/**
	 * PageFactory::getAvailableActions()
	 * 
	 * @param	void
	 * @return	array	array for defined action names
	 * 
	 */
	public function getAvailableActions()
	{
		return array_merge(self::$defined_actions, parent::getAvailableActions());
	}
	
	/**
	 * PageFactory::setVariables()
	 * 
	 * @param	array	$variables	associated array for item data
	 * @return	void
	 */
	public function setVariables($variables)
	{
		$this->variables = $variables;
		return;
	}
	
	/**
	 * PageFactory::getTemplateFor()
	 * Returns an appropriate template
	 * 
	 * @param	string	$type	type of skin
	 * @param	string	$method	type of template
	 * @return	string	contents of form template
	 */
	public function getTemplateFor($type, $method)
	{
		global $DIR_LIBS;
		
		// the $type is not in the allowed types array
		if ( !array_key_exists($type, $this->getAvailableSkinTypes()) )
		{
			return '';
		}
		
		$filename = "{$DIR_LIBS}include/{$type}-{$method}.template";
		
		// begin if: file doesn't exist
		if ( !file_exists($filename) )
		{
			return '';
		} // end if
		
		$filesize = filesize($filename);
		
		// begin if: filesize is LTE zero
		if ( $filesize <= 0 )
		{
			return '';
		}
		
		# read file and return it
		$fd = fopen ($filename, 'r');
		$contents = fread ($fd, $filesize);
		fclose ($fd);
		
		$this->type = $type;
		$this->method = $method;
		
		return $contents;
	}
	
	/**
	 * PageFactory::parse_categories()
	 * Create category dropdown box
	 * 
	 * @param	integer	$start_index
	 * @return	void
	 */
	public function parse_categories($start_index = 0)
	{
		// begin if: catid variable is set; use it to select the category
		if ( !array_key_exists('catid', $this->variables) )
		{
			$category_id = $this->blog->getDefaultCategory();
		}
		// else: get the default category
		else
		{
			$category_id = $this->variables['catid'];
		}
		
		Admin::selectBlogCategory('catid', $category_id, $start_index, 1, $this->blog->getID());
		return;
	}
	
	/**
	 * PageFactory::parse_blogid()
	 * Displays the blog ID
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogid()
	{
		echo $this->blog->getID();
		return;
	}
	
	/**
	 * PageFactory::parse_blogname()
	 * Displays the blog name
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogname()
	{
		echo $this->blog->getName();
		return;
	}
	
	/**
	 * PageFactory::parse_bloglink()
	 * Displays the blog link
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_bloglink()
	{
		echo '<a href="', Entity::hsc($this->blog->getURL()), '">', Entity::hsc($this->blog->getName()), '</a>';
		return;
	}
	
	/**
	 * PageFactory::parse_authorname()
	 * Displays the author's name
	 * 
	 * @param	void
	 * @return	void
	 */
	function parse_authorname()
	{
		// don't use on add item?
		global $member;
		echo $member->getDisplayName();
		return;
	}
	
	/**
	 * PageFactory::parse_title()
	 * Displays the title
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_title()
	{
		echo $this->contents['title'];
		return;
	}
	
	/**
	 * PageFactory::checkCondition()
	 * Checks conditions for if statements
	 *
	 * @param	string	$field	type of <%if%>
	 * @param	string	$name	property of field
	 * @param	string	$value	value of property
	 * @return	boolean
	 */
	protected function checkCondition($field, $name = '', $value = 1)
	{
		global $member;
		
		$condition = 0;
		switch ( $field )
		{
			case 'blogsetting':
				$condition = (boolean) ($this->blog->getSetting($name) == $value);
				break;
			case 'autosave':
				$condition = (boolean) ($member->getAutosave() == $value);
				break;
			case 'itemproperty':
				if ( array_key_exists($name, $this->variables) )
				{
					$condition = (boolean) ($this->variables[$name] == $value);
				}
				break;
			default:
				break;
		}
		return $condition;
	}
	
	/**
	 * PageFactory::parse_helplink()
	 * 
	 * @param	string	$topic
	 * @return	void
	 */
	function parse_helplink($topic)
	{
		help($topic);
		return;
	}
	
	/**
	 * PageFactory::parse_currenttime()
	 * for future items
	 * 
	 * @param	string	$what
	 * @return	void
	 */
	public function parse_currenttime($what)
	{
		$nu = getdate($this->blog->getCorrectTime());
		echo $nu[$what];
		return;
	}
	
	/**
	 * PageFactory::parse_itemtime()
	 * date change on edit item
	 * 
	 * @param	string	$what
	 * @return	void
	 */
	public function parse_itemtime($what)
	{
		$itemtime = getdate($this->variables['timestamp']);
		echo $itemtime[$what];
		return;
	}
	
	/**
	 * PageFactory::parse_init()
	 * some init stuff for all forms
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_init()
	{
		if ( $this->method != 'edit' )
		{
			$authorid = '';
		}
		else
		{
			$authorid = $this->variables['authorid'];
		}
		$this->blog->insertJavaScriptInfo($authorid);
		return;
	}
	
	/**
	 * PageFactory::parse_extrahead()
	 * on bookmarklets only: insert extra html header information (by plugins)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_extrahead()
	{
		global $manager;
		
		$extrahead = '';
		$data = array(
			'extrahead' => &$extrahead
		);
		
		$manager->notify('BookmarkletExtraHead', $data);
		echo $extrahead;
		return;
	}
	
	/**
	 * PageFactory::parse_contents()
	 * 
	 * @param	string	$which
	 * @return	void
	 */
	public function parse_contents($which)
	{
		if ( !array_key_exists($which, $this->variables) || !isset($this->variables[$which]) )
		{
			$this->variables[$which] = '';
		}
		echo Entity::hsc($this->variables[$which]);
		return;
	}
	
	/**
	 * PageFactory::parse_checkedonval()
	 * 
	 * @param	string	$value	value for input element with checkbox type
	 * @return	void
	 */
	public function parse_checkedonval($value, $name)
	{
		if ( !array_key_exists($name, $this->variables) || !isset($this->variables[$name]) )
		{
			$this->variables[$name] = '';
		}
		if ( $this->variables[$name] == $value )
		{
			echo "checked='checked'";
		}
		return;
	}
	
	/**
	 * Pagefactory::parse_jsinput()
	 * extra javascript for input and textarea fields
	 * 
	 * @param	string	$which	name of JavaScript function
	 * @return	string	attribute for input element
	 */
	public function parse_jsinput($which)
	{
		global $CONF, $member;
		
		$attributes  = " name=\"{$which}\"";
		$attributes .= " id=\"input{$which}\"";
		
		if ( !$CONF['DisableJsTools'] )
		{
			$attributes .= ' onkeypress="shortCuts();"';
			
			if ( $member->getAutosave() )
			{
				$attributes .= ' onkeyup="doMonitor();"';
			}
		}
		else
		{
			$attributes .= ' onclick="storeCaret(this);"';
			$attributes .= ' onselect="storeCaret(this);"';
			
			if ( $member->getAutosave() )
			{
				$attributes .= " onkeyup=\"storeCaret(this); updPreview('{$which}'); doMonitor();\"";
			}
			else
			{
				$attributes .= " onkeyup=\"storeCaret(this); updPreview('{$which}');\"";
			}
		}
		echo $attributes;
		return;
	}
	
	/**
	 * PageFactory::parse_jsbuttonbar()
	 * shows the javascript button bar
	 * 
	 * @param	string	$extrabuttons	
	 * @return	void
	 */
	public function parse_jsbuttonbar($extrabuttons = "")
	{
		global $CONF;
		switch ( $CONF['DisableJsTools'] )
		{
			case "0":
				echo "<div class=\"jsbuttonbar\">\n";
				$this->jsbutton('cut','cutThis()',_ADD_CUT_TT . " (Ctrl + X)");
				$this->jsbutton('copy','copyThis()',_ADD_COPY_TT . " (Ctrl + C)");
				$this->jsbutton('paste','pasteThis()',_ADD_PASTE_TT . " (Ctrl + V)");
				$this->jsbuttonspacer();
				$this->jsbutton('bold',"boldThis()", _ADD_BOLD_TT ." (Ctrl + Shift + B)");
				$this->jsbutton('italic',"italicThis()", _ADD_ITALIC_TT ." (Ctrl + Shift + I)");
				$this->jsbutton('link',"ahrefThis()", _ADD_HREF_TT ." (Ctrl + Shift + A)");
				$this->jsbuttonspacer();
				$this->jsbutton('alignleft',"alignleftThis()", _ADD_ALIGNLEFT_TT);
				$this->jsbutton('alignright',"alignrightThis()", _ADD_ALIGNRIGHT_TT);
				$this->jsbutton('aligncenter',"aligncenterThis()", _ADD_ALIGNCENTER_TT);
				$this->jsbuttonspacer();
				$this->jsbutton('left',"leftThis()", _ADD_LEFT_TT);
				$this->jsbutton('right',"rightThis()", _ADD_RIGHT_TT);
				
				if ( $extrabuttons )
				{
					$btns = preg_split('#\+#',$extrabuttons);
					$this->jsbuttonspacer();
					foreach ( $btns as $button )
					{
						switch ( $button )
						{
							case "media":
								$this->jsbutton('media', "addMedia()", _ADD_MEDIA_TT .	" (Ctrl + Shift + M)");
								break;
							case "preview":
								$this->jsbutton('preview', "showedit()", _ADD_PREVIEW_TT);
								break;
						}
					}
				}
				echo "</div>\n";
				break;
			case "2":
				echo "<div class=\"jsbuttonbar\">";
				$this->jsbutton('bold',"boldThis()", _ADD_BOLD_TT);
				$this->jsbutton('italic',"italicThis()", _ADD_ITALIC_TT);
				$this->jsbutton('link',"ahrefThis()", _ADD_HREF_TT);
				$this->jsbuttonspacer();
				$this->jsbutton('alignleft',"alignleftThis()", _ADD_ALIGNLEFT_TT);
				$this->jsbutton('alignright',"alignrightThis()", _ADD_ALIGNRIGHT_TT);
				$this->jsbutton('aligncenter',"aligncenterThis()", _ADD_ALIGNCENTER_TT);
				$this->jsbuttonspacer();
				$this->jsbutton('left',"leftThis()", _ADD_LEFT_TT);
				$this->jsbutton('right',"rightThis()", _ADD_RIGHT_TT);

				if ( $extrabuttons )
				{
					$btns = preg_split('#\+#',$extrabuttons);
					$this->jsbuttonspacer();
					foreach ( $btns as $button )
					{
						switch ( $button )
						{
							case "media":
								$this->jsbutton('media', "addMedia()", _ADD_MEDIA_TT);
								break;
						}
					}
				}
				echo "</div>\n";
				break;
		}
		return;
	}
	
	/**
	 * PageFactory::parse_pluginextras()
	 * Allows plugins to add their own custom fields
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_pluginextras()
	{
		global $manager;
		
		switch ( $this->method )
		{
			case 'add':
				$data = array(
					'blog' => &$this->blog
				);
				
				$manager->notify('AddItemFormExtras', $data);
				break;
			case 'edit':
				$data = array(
					'variables'	=> $this->variables,
					'blog'		=> &$this->blog,
					'itemid'	=> $this->variables['itemid']
				);
				$manager->notify('EditItemFormExtras', $data);
				break;
		}
		return;
	}
	
	/**
	 * PageFactory::parse_itemoptions()
	 * Adds the itemOptions of a plugin to a page
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemoptions()
	{
		global $itemid;
		Admin::_insertPluginOptions('item', $itemid);
		return;
	}
	
	/**
	 * PageFactory::parse_ticket()
	 */
	public function parse_ticket()
	{
		global $manager;
		$manager->addTicketHidden();
		return;
	}
	
	/**
	 * PageFactory::jsbutton()
	 * convenience method
	 * 
	 * @param	string	$type		type of button
	 * @param	string	$code		JavaScript codes for onclick event
	 * @param	string	$tooltip	alternative text attribute for image element
	 */
	private function jsbutton($type, $code, $tooltip)
	{
		echo "<span class=\"jsbutton\" onmouseover=\"BtnHighlight(this);\" onmouseout=\"BtnNormal(this);\" onclick=\"{$code}\" >\n";
		echo "<img src=\"images/button-{$type}.gif\" alt=\"{$tooltip}\" title=\"{$tooltip}\" width=\"16\" height=\"16\" />\n";
		echo "</span>\n";
		return;
	}
	
	/**
	 * PageFactory::jsbuttonspacer()
	 * 
	 * @param	void
	 * @return	void
	 */
	private function jsbuttonspacer()
	{
		echo '<span class="jsbuttonspacer"></span>';
		return;
	}
}
