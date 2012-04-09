<?php
/**
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * This class contains the functions that get called by using
 * the special tags in the skins
 *
 * The allowed tags for a type of skinpart are defined by the
 * Skin::getAllowedActionsForType($type) method
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id$
 */

class Actions extends BaseActions
{
	// part of the skin currently being parsed ('index', 'item', 'archive',
	// 'archivelist', 'member', 'search', 'error', 'imagepopup')
	var $skintype;
	
	// contains an assoc array with parameters that need to be included when
	// generating links to items/archives/... (e.g. catid)
	var $linkparams;
	
	// reference to the skin object for which a part is being parsed
	var $skin;
	
	// used when including templated forms from the include/ dir. The $formdata var
	// contains the values to fill out in there (assoc array name -> value)
	var $formdata;
	
	// filled out with the number of displayed items after calling one of the
	// (other)blog/(other)searchresults skinvars.
	var $amountfound;
	
	/**
	 * Actions::__construct()
	 * Constructor for a new Actions object
	 * 
	 * @param	string	$type
	 * @return	void
	 */
	public function __construct($type)
	{
		global $catid;
		
		// call constructor of superclass first
		$this->BaseActions();
		$this->skintype = $type;
		
		if ( $catid )
		{
			$this->linkparams = array('catid' => $catid);
		}
		return;
	}
	
	/**
	 * Actions::setSkin()
	 * Set the skin
	 * @param	object	$skin	an instance of Skin class
	 * @return	void
	 */
	public function setSkin(&$skin)
	{
		$this->skin =& $skin;
		return;
	}
	
	/**
	 * Actions::setParser()
	 * Set the parser
	 * 
	 * @param	object	$parser	an instance of Parser class
	 * @return	void
	 */
	public function setParser(&$parser)
	{
		$this->parser =& $parser;
		return;
	}
	
	/**
	 * Actions::doForm()
	 * Forms get parsedincluded now, using an extra <formdata> skinvar
	 *
	 * @param	string	$filename
	 * @return	void
	 */
	public function doForm($filename)
	{
		global $DIR_NUCLEUS;
		array_push($this->parser->actions,'formdata','text','callback','errordiv','ticket');
		
		$oldIncludeMode = Parser::getProperty('IncludeMode');
		$oldIncludePrefix = Parser::getProperty('IncludePrefix');
		Parser::setProperty('IncludeMode','normal');
		Parser::setProperty('IncludePrefix','');
		
		$this->parse_parsedinclude($DIR_NUCLEUS . 'forms/' . $filename . '.template');
		Parser::setProperty('IncludeMode',$oldIncludeMode);
		Parser::setProperty('IncludePrefix',$oldIncludePrefix);
		
		array_pop($this->parser->actions);	// errordiv
		array_pop($this->parser->actions);	// callback
		array_pop($this->parser->actions);	// text
		array_pop($this->parser->actions);	// formdata
		array_pop($this->parser->actions);	// ticket
		return;
	}

	/**
	 * Actions::checkCondition()
	 * Checks conditions for if statements
	 *
	 * @param	string	$field	type of <%if%>
	 * @param	string	$name	property of field
	 * @param	string	$value	value of property
	 * @return	boolean	condition
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
			case 'blogsetting':
				$condition = ($blog && ($blog->getSetting($name) == $value));
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
			case 'nextitem':
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
				$condition = (($name == $this->skintype) || ($name == requestVar('action')));
				break;
			case 'hasplugin':
				$condition = $this->ifHasPlugin($name, $value);
				break;
			default:
				$condition = $manager->pluginInstalled("NP_{$field}") && $this->ifPlugin($field, $name, $value);
				break;
		}
		return $condition;
	}
	
	/**
	 * Actions::_ifHasPlugin()
	 *	hasplugin,PlugName
	 *	   -> checks if plugin exists
	 *	hasplugin,PlugName,OptionName
	 *	   -> checks if the option OptionName from plugin PlugName is not set to 'no'
	 *	hasplugin,PlugName,OptionName=value
	 *	   -> checks if the option OptionName from plugin PlugName is set to value
	 *
	 * @param	string	$name	name of plugin
	 * @param	string	$value	
	 * @return	
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
					$condition = true;
				}
				else
				{
					list($name2, $value2) = preg_split('#=#', $value, 2);
					if ( $value2 == "" && $plugin->getOption($name2) != 'no' )
					{
						$condition = true;
					}
					else if ( $plugin->getOption($name2) == $value2 )
					{
						$condition = true;
					}
				}
			}
		}
		return $condition;
	}
	
	/**
	 * Actions::ifPlugin()
	 * Checks if a plugin exists and call its doIf function
	 * 
	 * @param	string	$name	name of plugin
	 * @param	string	$key	name of plugin option
	 * @param	string	$value	value of plugin option
	 * @return	void
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
	
	/**
	 * Actions::ifCategory()
	 * Different checks for a category
	 * 
	 * @param	string	$name	
	 * @param	string	$value	
	 * @return	boolean	
	 */
	private function ifCategory($name = '', $value='')
	{
		global $blog, $catid;
		
		// when no parameter is defined, just check if a category is selected
		if ( ($name != 'catname' && $name != 'catid') || ($value == '') )
		{
			return $blog->isValidCategory($catid);
		}
		
		// check category name
		if ( $name == 'catname' )
		{
			$value = $blog->getCategoryIdFromName($value);
			if ( $value == $catid )
			{
				return $blog->isValidCategory($catid);
			}
		}
		
		// check category id
		if ( ($name == 'catid') && ($value == $catid) )
		{
			return $blog->isValidCategory($catid);
		}
		return FALSE;
	}
	
	/**
	 * Actions::ifOnTeam()
	 * Checks if a member is on the team of a blog and return his rights
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	mixed
	 */
	private function ifOnTeam($blogName = '')
	{
		global $blog, $member, $manager;
		
		// when no blog found
		if ( ($blogName == '') && !is_object($blog) )
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
	 * Actions::ifAdmin()
	 * Checks if a member is admin of a blog
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	mixed
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
	 * Actions::link()
	 * returns either
	 * 	- a raw link (html/xml encoded) when no linktext is provided
	 * 	- a (x)html <a href... link when a text is present (text htmlencoded)
	 * 
	 * @param	string	$url		URL for href attribute of anchor element
	 * @param	string	$linktext	content of anchor element
	 * @return	
	 */
	private function link($url, $linktext = '')
	{
		$u = Entity::hsc($url);
		// fix URLs that already had encoded ampersands
		$u = preg_replace("#&amp;amp;#", '&amp;', $u);
		if ( $linktext != '' )
		{
			$l = '<a href="' . $u .'">' . Entity::hsc($linktext) . '</a>';
		}
		else
		{
			$l = $u;
		}
		return $l;
	}
	
	/**
	 * Actions::searchlink()
	 * Outputs a next/prev link
	 *
	 * @param $maxresults
	 *		The maximum amount of items shown per page (e.g. 10)
	 * @param $startpos
	 *		Current start position (requestVar('startpos'))
	 * @param $direction
	 *		either 'prev' or 'next'
	 * @param $linktext
	 *		When present, the output will be a full <a href...> link. When empty,
	 *		only a raw link will be outputted
	 */
	private function searchlink($maxresults, $startpos, $direction, $linktext = '', $recount = '')
	{
		global $CONF, $blog, $query, $amount;
		// TODO: Move request uri to linkparams. this is ugly. sorry for that.
		$startpos	= (integer) $startpos;
		$parsed		= parse_url(serverVar('REQUEST_URI'));
		$path		= $parsed['path'];
		$parsed		= $parsed['query'];
		$url		= '';
		
		if ( $direction == 'prev' )
		{
			if ( intval($startpos) - intval($maxresults) >= 0 )
			{
				$startpos 	= intval($startpos) - intval($maxresults);
				
				if ( $this->skintype == 'index' )
				{
					$url = $path;
				}
				else if ( $this->skintype == 'search' )
				{
					$url = $CONF['SearchURL'];
				}
				$url .= '?' . alterQueryStr($parsed,'startpos',$startpos);
			}
		}
		else if ( $direction == 'next' )
		{
			global $navigationItems;
			if ( !isset($navigationItems) )
			{
				$navigationItems = 0;
			}
			
			if ( $recount )
			{
				$iAmountOnPage = 0;
			}
			else 
			{
				$iAmountOnPage = $this->amountfound;
			}
			
			if ( intval($navigationItems) > 0 )
			{
				$iAmountOnPage = intval($navigationItems) - intval($startpos);
			}
			elseif ( $iAmountOnPage == 0 )
			{
				/*
				 * [%nextlink%] or [%prevlink%] probably called before [%blog%] or [%searchresults%]
				 * try a count query
				 */
				if ( $this->skintype == 'index' )
				{
					$sqlquery = $blog->getSqlBlog('', 'count');
					$url = $path;
				}
				else if ( $this->skintype == 'search' )
				{
					$unused_highlight = '';
					$sqlquery = $blog->getSqlSearch($query, $amount, $unused_highlight, 'count');
					$url = $CONF['SearchURL'];
				}
				if ( $sqlquery )
				{
					$iAmountOnPage = intval(quickQuery($sqlquery)) - intval($startpos);
				}
			}
			
			$url = '';
			if ( intval($iAmountOnPage) >= intval($maxresults) )
			{
				$startpos	 = intval($startpos) + intval($maxresults);
				$url		.= '?' . alterQueryStr($parsed, 'startpos', $startpos);
			}
		}
		
		if ( $url != '' )
		{
			echo $this->link($url, $linktext);
		}
		return;
	}
	
	/**
	 * Actions::itemlink()
	 * Creates an item link and if no id is given a todaylink 
	 * 
	 * @param	integer	$id	id for link
	 * @param	string	$linktext	text for link
	 * @return	void
	 */
	private function itemlink($id, $linktext = '')
	{
		global $CONF;
		if ( $id != 0 )
		{
			echo $this->link(Link::create_item_link($id, $this->linkparams), $linktext);
		}
		else
		{
			$this->parse_todaylink($linktext);
		}
		return;
	}
	
	/**
	 * Actions::archivelink)
	 * Creates an archive link and if no id is given a todaylink 
	 * 
	 * @param	integer	$id	id for link
	 * @param	string	$linktext	text for link
	 * @return	void
	 */
	private function archivelink($id, $linktext = '')
	{
		global $CONF, $blog;
		if ( $id != 0 )
		{
			echo $this->link(Link::create_archive_link($blog->getID(), $id, $this->linkparams), $linktext);
		}
		else
		{
			$this->parse_todaylink($linktext);
		}
		return;
	}
	
	/**
	 * Actions:setBlogCategory()
	 * Helper function that sets the category that a blog will need to use
	 *
	 * @param	string	$blog		An object of the blog class, passed by reference (we want to make changes to it)
	 * @param	string	$catname	The name of the category to use
	 * @return	void
	 */
	private function setBlogCategory(&$blog, $catname)
	{
		global $catid;
		if ( $catname != '' )
		{
			$blog->setSelectedCategoryByName($catname);
		}
		else
		{
			$blog->setSelectedCategory($catid);
		}
		return;
	}
	
	/**
	 * Actions::preBlogContent()
	 * Notifies the Manager that a PreBlogContent event occurs
	 * 
	 * @param	string	$type	type of skin
	 * @param	object	$blog	an instance of Blog class
	 * @return	void
	 */
	private function preBlogContent($type, &$blog)
	{
		global $manager;
		$manager->notify('PreBlogContent',array('blog' => &$blog, 'type' => $type));
		return;
	}

	/**
	 * Actions::postBlogContent()
	 * Notifies the Manager that a PostBlogContent event occurs
	 * 
	 * @param	string	$type	type of skin
	 * @param	objecct	$blog	an instance of Blog class
	 * @return	void
	 */
	private function postBlogContent($type, &$blog)
	{
		global $manager;
		$manager->notify('PostBlogContent', array('blog' => &$blog, 'type' => $type));
		return;
	}
	
	/**
	 * Actions::parse_additemform()
	 * Parse skinvar additemform
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_additemform()
	{
		global $blog, $CONF;
		$this->formdata = array(
			'adminurl'	=> Entity::hsc($CONF['AdminURL']),
			'catid'		=> $blog->getDefaultCategory()
		);
		$blog->InsertJavaScriptInfo();
		$this->doForm('additemform');
		return;
	}
	
	/**
	 * Actions::parse_addlink()
	 * Parse skinvar addlink
	 * A Link that allows to open a bookmarklet to add an item
	 */
	public function parse_addlink()
	{
		global $CONF, $member, $blog;
		if ( $member->isLoggedIn() && $member->isTeamMember($blog->blogid) )
		{
			echo $CONF['AdminURL'].'bookmarklet.php?blogid='.$blog->blogid;
		}
		return;
	}
	
	/**
	 * Actions::parse_addpopupcode()
	 * Parse skinvar addpopupcode
	 * Code that opens a bookmarklet in an popup window
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_addpopupcode()
	{
		echo "if (event &amp;&amp; event.preventDefault) event.preventDefault();winbm=window.open(this.href,'nucleusbm','scrollbars=yes,width=600,height=500,left=10,top=10,status=yes,resizable=yes');winbm.focus();return false;";
		return;
	}
	
	/**
	 * Parse skinvar adminurl
	 * (shortcut for admin url)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_adminurl()
	{
		$this->parse_sitevar('adminurl');
		return;
	}
	
	/**
	 * Actions::parse_archive()
	 * Parse skinvar archive
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @return	
	 */
	public function parse_archive($template, $category = '')
	{
		global $blog, $archive;
		// can be used with either yyyy-mm or yyyy-mm-dd
		sscanf($archive,'%d-%d-%d', $y, $m, $d);
		$this->setBlogCategory($blog, $category);
		$this->preBlogContent('achive',$blog);
		$blog->showArchive($template, $y, $m, $d);
		$this->postBlogContent('achive',$blog);
		return;
	}
	
	/**
	 * Actions::parse_archivedate()
	 * %archivedate(locale,date format)%
	 * 
	 * @param	string	$locale
	 * @return	void
	 */
	public function parse_archivedate($locale = '-def-')
	{
		global $archive;
		
		/* 
		 * TODO: these lines are no meaning because there is no $template.
		if ( $locale == '-def-' )
		{
			setlocale(LC_TIME, $template['LOCALE']);
		}
		else
		{
			setlocale(LC_TIME, $locale);
		}
		 */
		
		// get archive date
		sscanf($archive,'%d-%d-%d',$y,$m,$d);
		
		// get format
		$args = func_get_args();
		// format can be spread over multiple parameters
		if ( sizeof($args) > 1 )
		{
			// take away locale
			array_shift($args);
			// implode
			$format=implode(',',$args);
		}
		elseif ( $d == 0 && $m !=0 )
		{
			$format = '%B %Y';
		}
		elseif ( $m == 0 )
		{
			$format = '%Y';
		}
		else
		{
			$format = '%d %B %Y';
		}
		echo i18n::formatted_datetime($format, mktime(0,0,0,$m?$m:1,$d?$d:1,$y));
		return;
	}
	
	/**
	 * Actions::parse_archivedaylist()
	 * Parse skinvar archivedaylist
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @param	integer	$limit		the number of items in a display
	 * @return	void
	 */
	public function parse_archivedaylist($template, $category = 'all', $limit = 0)
	{
		global $blog;
		if ( $category == 'all' )
		{
			$category = '';
		}
		$this->preBlogContent('archivelist',$blog);
		$this->setBlogCategory($blog, $category);
		$blog->showArchiveList($template, 'day', $limit);
		$this->postBlogContent('archivelist',$blog);
		return;
	}
	
	/**
	 * Actions::parse_archivelink()
	 * A link to the archives for the current blog (or for default blog)
	 * 
	 * @param	string	$linktext	text for link
	 * @return	void
	 */
	public function parse_archivelink($linktext = '')
	{
		global $blog, $CONF;
		if ( $blog )
		{
			echo $this->link(Link::create_archivelist_link($blog->getID(), $this->linkparams), $linktext);
		}
		else
		{
			echo $this->link(Link::create_archivelist_link(), $linktext);
		}
		return;
	}
	
	/**
	 * Actions::parse_archivelist()
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @param	integer	$limit		the number of items in a display
	 * @return	void
	 */
	public function parse_archivelist($template, $category = 'all', $limit = 0)
	{
		global $blog;
		if ( $category == 'all' )
		{
			$category = '';
		}
		$this->preBlogContent('archivelist',$blog);
		$this->setBlogCategory($blog, $category);
		$blog->showArchiveList($template, 'month', $limit);
		$this->postBlogContent('archivelist',$blog);
		return;
	}
	
	/**
	 * Actions::parse_archiveyearlist()
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @param	integer	$limit		the number of items in a display
	 */
	public function parse_archiveyearlist($template, $category = 'all', $limit = 0)
	{
		global $blog;
		if ( $category == 'all' )
		{
			$category = '';
		}
		$this->preBlogContent('archivelist',$blog);
		$this->setBlogCategory($blog, $category);
		$blog->showArchiveList($template, 'year', $limit);
		$this->postBlogContent('archivelist',$blog);
		return;
	}
	
	/**
	 * Actions::parse_archivetype()
	 * Parse skinvar archivetype
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_archivetype()
	{
		global $archivetype;
		echo $archivetype;
		return;
	}
	
	/**
	 * Actions::parse_blog()
	 * Parse skinvar blog
	 * 
	 * @param	string	$template	name of template
	 * @param	mixed	$amount		the number of items in a display, in case it includes the beginning
	 * @param	string	$category	name of category
	 * @return	void
	 */
	public function parse_blog($template, $amount = 10, $category = '')
	{
		global $blog, $startpos;
		
		list($limit, $offset) = sscanf($amount, '%d(%d)');
		$this->setBlogCategory($blog, $category);
		$this->preBlogContent('blog',$blog);
		$this->amountfound = $blog->readLog($template, $limit, $offset, $startpos);
		$this->postBlogContent('blog',$blog);
		return;
	}
	
	/**
	 * Actions::parse_bloglist()
	 * Parse skinvar bloglist
	 * Shows a list of all blogs
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$bnametype	whether 'name' or 'shortname' is used for the link text
	 * @param	string	$orderby	order criteria
	 * @param	string	$direction	order ascending or descending		  
	 * @return	void
	 */
	public function parse_bloglist($template, $bnametype = '', $orderby='number', $direction='asc')
	{
		Blog::showBlogList($template, $bnametype, $orderby, $direction);
		return;
	}
	
	/**
	 * Actions::parse_blogsetting()
	 * Parse skinvar blogsetting
	 * 
	 * @param	string	$which	key of weblog settings
	 * @return	void
	 */
	public function parse_blogsetting($which)
	{
		global $blog;
		switch( $which )
		{
			case 'id':
				echo Entity::hsc($blog->getID());
				break;
			case 'url':
				echo Entity::hsc($blog->getURL());
				break;
			case 'name':
				echo Entity::hsc($blog->getName());
				break;
			case 'desc':
				echo Entity::hsc($blog->getDescription());
				break;
			case 'short':
				echo Entity::hsc($blog->getShortName());
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_callback()
	 * Parse callback
	 * 
	 * @param	string	$eventName	name of event
	 * @param	string	$type	type of skin
	 * @return	void
	 */
	public function parse_callback($eventName, $type)
	{
		global $manager;
		$manager->notify($eventName, array('type' => $type));
		return;
	}
	
	/**
	 * Actions::parse_category()
	 * Parse skinvar category
	 * 
	 * @param	string	$type	key of category settings
	 * @return	void
	 */
	public function parse_category($type = 'name')
	{
		global $catid, $blog;
		if ( !$blog->isValidCategory($catid) )
		{
			return;
		}
		
		switch ( $type )
		{
			case 'name':
				echo $blog->getCategoryName($catid);
				break;
			case 'desc':
				echo $blog->getCategoryDesc($catid);
				break;
			case 'id':
				echo $catid;
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_categorylist()
	 * Parse categorylist
	 * 
	 * @param	string	$template	name of template
	 * @param	string	$blogname	name of weblog
	 * @return	void
	 */
	public function parse_categorylist($template, $blogname = '')
	{
		global $blog, $manager;
		
		// when no blog found
		if ( ($blogname == '') && (!is_object($blog)) )
		{
			return 0;
		}
			
		if ( $blogname == '' )
		{
			$this->preBlogContent('categorylist',$blog);
			$blog->showCategoryList($template);
			$this->postBlogContent('categorylist',$blog);
		}
		else
		{
			$b =& $manager->getBlog(getBlogIDFromName($blogname));
			$this->preBlogContent('categorylist',$b);
			$b->showCategoryList($template);
			$this->postBlogContent('categorylist',$b);
		}
		return;
	}
	
	/**
	 * Actions::parse_charset()
	 * Parse skinvar charset
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_charset()
	{
		echo i18n::get_current_charset();
		return;
	}
	
	/**
	 * Actions::parse_commentform()
	 * Parse skinvar commentform
	 * 
	 * @param	string	$destinationurl	URI for redirection
	 * @return	void
	 */
	public function parse_commentform($destinationurl = '')
	{
		global $blog, $itemid, $member, $CONF, $manager, $DIR_LIBS, $errormessage;
		
		// warn when trying to provide a actionurl (used to be a parameter in Nucleus <2.0)
		if ( stristr($destinationurl, 'action.php') )
		{
			$args = func_get_args();
			$destinationurl = $args[1];
			ActionLog::add(WARNING,_ACTIONURL_NOTLONGER_PARAMATER);
		}
		
		$actionurl = $CONF['ActionURL'];
		
		// if item is closed, show message and do nothing
		$item =& $manager->getItem($itemid,0,0);
		if ( $item['closed'] || !$blog->commentsEnabled() )
		{
			$this->doForm('commentform-closed');
			return;
		}
		
		if ( !$blog->isPublic() && !$member->isLoggedIn() )
		{
			$this->doForm('commentform-closedtopublic');
			return;
		}
		
		if ( !$destinationurl )
		{
			// note: createLink returns an HTML encoded URL
			$destinationurl = Link::create_link(
				'item',
				array(
					'itemid' => $itemid,
					'title' => $item['title'],
					'timestamp' => $item['timestamp'],
					'extra' => $this->linkparams
				)
			);
		}
		else
		{
			// HTML encode URL
			$destinationurl = Entity::hsc($destinationurl);
		}
		
		// values to prefill
		$user = cookieVar($CONF['CookiePrefix'] .'comment_user');
		if ( !$user )
		{
			$user = postVar('user');
		}
		
		$userid = cookieVar($CONF['CookiePrefix'] .'comment_userid');
		if ( !$userid )
		{
			$userid = postVar('userid');
		}
		
		$email = cookieVar($CONF['CookiePrefix'] .'comment_email');
		if (!$email)
		{
			$email = postVar('email');
		}
		
		$body = postVar('body');
		
		$this->formdata = array(
			'destinationurl' => $destinationurl,	// url is already HTML encoded
			'actionurl' => Entity::hsc($actionurl),
			'itemid' => $itemid,
			'user' => Entity::hsc($user),
			'userid' => Entity::hsc($userid),
			'email' => Entity::hsc($email),
			'body' => Entity::hsc($body),
			'membername' => $member->getDisplayName(),
			'rememberchecked' => cookieVar($CONF['CookiePrefix'] .'comment_user')?'checked="checked"':''
		);
		
		if ( !$member->isLoggedIn() )
		{
			$this->doForm('commentform-notloggedin');
		}
		else
		{
			$this->doForm('commentform-loggedin');
		}
		return;
	}
	
	/**
	 * Actions::parse_comments()
	 * Parse skinvar comments
	 * include comments for one item
	 * 
	 * @param	string	$template	name of template
	 * @return	void
	 */
	public function parse_comments($template)
	{
		global $itemid, $manager, $blog, $highlight;
		$template =& $manager->getTemplate($template);
		
		// create parser object & action handler
		$actions = new ItemActions($blog);
		$parser = new Parser($actions->getDefinedActions(),$actions);
		$actions->setTemplate($template);
		$actions->setParser($parser);
		$item = Item::getitem($itemid, 0, 0);
		$actions->setCurrentItem($item);
		
		$comments = new Comments($itemid);
		$comments->setItemActions($actions);
		// shows ALL comments
		$comments->showComments($template, -1, 1, $highlight);
		return;
	}
	
	/**
	 * Actions::parse_errordiv()
	 * Parse errordiv
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_errordiv()
	{
		global $errormessage;
		if ( $errormessage )
		{
			echo '<div class="error">' . Entity::hsc($errormessage) . "</div>\n";
		}
		return;
	}
	
	/**
	 * Actions::parse_errormessage()
	 * Parse skinvar errormessage
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_errormessage()
	{
		global $errormessage;
		echo $errormessage;
		return;
	}
	
	/**
	 * Actions::parse_formdata()
	 * Parse formdata
	 * 
	 * @param	string	$what	key of format data
	 * @return	void
	 */
	public function parse_formdata($what)
	{
		echo $this->formdata[$what];
		return;
	}
	
	/**
	 * Actions::parse_ifcat()
	 * Parse ifcat
	 * 
	 * @param	string	$text
	 * @return	void
	 */
	public function parse_ifcat($text = '')
	{
		if ( $text == '' )
		{
			// new behaviour
			$this->parse_if('category');
		}
		else
		{
			// old behaviour
			global $catid, $blog;
			if ( $blog->isValidCategory($catid) )
			{
				echo $text;
			}
		}
		return;
	}
	
	/**
	 * Actions::parse_image()
	 * Parse skinvar image
	 * 
	 * @param	string	$what	name of tag
	 * @return	void
	 */
	public function parse_image($what = 'imgtag')
	{
		global $CONF;
		
		$imagetext 	= Entity::hsc(requestVar('imagetext'));
		$imagepopup = requestVar('imagepopup');
		$width 		= intRequestVar('width');
		$height 	= intRequestVar('height');
		$fullurl 	= Entity::hsc($CONF['MediaURL'] . $imagepopup);
		
		switch ( $what )
		{
			case 'url':
				echo $fullurl;
				break;
			case 'width':
				echo $width;
				break;
			case 'height':
				echo $height;
				break;
			case 'caption':
			case 'text':
				echo $imagetext;
				break;
			case 'imgtag':
			default:
				echo "<img src=\"$fullurl\" width=\"$width\" height=\"$height\" alt=\"$imagetext\" title=\"$imagetext\" />";
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_imagetext()
	 * Parse skinvar imagetext
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_imagetext()
	{
		$this->parse_image('imagetext');
		return;
	}

	/**
	 * Actions::parse_item()
	 * Parse skinvar item
	 * include one item (no comments)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_item($template)
	{
		global $blog, $itemid, $highlight;
		
		// need this to select default category
		$this->setBlogCategory($blog, '');
		$this->preBlogContent('item',$blog);
		$r = $blog->showOneitem($itemid, $template, $highlight);
		if ( $r == 0 )
		{
			echo _ERROR_NOSUCHITEM;
		}
		$this->postBlogContent('item',$blog);
		return;
	}

	/**
	 * Actions::parse_itemid()
	 * Parse skinvar itemid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemid()
	{
		global $itemid;
		echo $itemid;
		return;
	}
	
	/**
	 * Actions::parseitemlink()
	 * Parse skinvar itemlink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemlink($linktext = '')
	{
		global $itemid;
		$this->itemlink($itemid, $linktext);
		return;
	}
	
	/**
	 * Actions::parse_itemtitle()
	 * Parse itemtitle
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemtitle($format = '')
	{
		global $manager, $itemid;
		$item =& $manager->getItem($itemid,0,0);
		
		switch ( $format )
		{
			case 'xml':
				echo Entity::hen($item['title']);
				break;
			case 'raw':
				echo $item['title'];
				break;
			case 'attribute':
			default:
				echo Entity::hsc(strip_tags($item['title']));
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_loginform()
	 * Parse skinvar loginform
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_loginform()
	{
		global $member, $CONF;
		if ( !$member->isLoggedIn() )
		{
			$filename = 'loginform-notloggedin';
			$this->formdata = array();
		}
		else
		{
			$filename = 'loginform-loggedin';
			$this->formdata = array(
				'membername' => $member->getDisplayName(),
			);
		}
		$this->doForm($filename);
		return;
	}
	
	/**
	 * Actions::parse_member()
	 * Parse skinvar member
	 * (includes a member info thingie)
	 * 
	 * @param	string	$what	which memberdata is needed
	 * @return	void
	 */
	public function parse_member($what)
	{
		global $memberinfo, $member, $CONF;
		
		// 1. only allow the member-details-page specific variables on member pages
		if ( $this->skintype == 'member' )
		{
			switch( $what )
			{
				case 'name':
					echo Entity::hsc($memberinfo->getDisplayName());
					break;
				case 'realname':
					echo Entity::hsc($memberinfo->getRealName());
					break;
				case 'notes':
					echo Entity::hsc($memberinfo->getNotes());
					break;
				case 'url':
					echo Entity::hsc($memberinfo->getURL());
					break;
				case 'email':
					echo Entity::hsc($memberinfo->getEmail());
					break;
				case 'id':
					echo Entity::hsc($memberinfo->getID());
					break;
			}
		}
		
		// 2. the next bunch of options is available everywhere, as long as the user is logged in
		if ( $member->isLoggedIn() )
		{
			switch( $what )
			{
				case 'yourname':
					echo $member->getDisplayName();
					break;
				case 'yourrealname':
					echo $member->getRealName();
					break;
				case 'yournotes':
					echo $member->getNotes();
					break;
				case 'yoururl':
					echo $member->getURL();
					break;
				case 'youremail':
					echo $member->getEmail();
					break;
				case 'yourid':
					echo $member->getID();
					break;
				case 'yourprofileurl':
					if ($CONF['URLMode'] == 'pathinfo')
						echo Link::create_member_link($member->getID());
					else
						echo $CONF['IndexURL'] . Link::create_member_link($member->getID());
					break;
			}
		}
		return;
	}
	
	/**
	 * Link::parse_membermailform()
	 * Parse skinvar membermailform
	 * 
	 * @param	integer	$rows	the height for textarea
	 * @param	integer	$cols	the width for textarea
	 * @param	string	$desturl	URI to redirect
	 * @return	void
	 */
	public function parse_membermailform($rows = 10, $cols = 40, $desturl = '')
	{
		global $member, $CONF, $memberid;
		
		if ( $desturl == '' )
		{
			if ( $CONF['URLMode'] == 'pathinfo' )
			{
				$desturl = Link::create_member_link($memberid);
			}
			else
			{
				$desturl = $CONF['IndexURL'] . Link::create_member_link($memberid);
			}
		}
		
		$message = postVar('message');
		$frommail = postVar('frommail');
		
		$this->formdata = array(
			'url' => Entity::hsc($desturl),
			'actionurl' => Entity::hsc($CONF['ActionURL']),
			'memberid' => $memberid,
			'rows' => $rows,
			'cols' => $cols,
			'message' => Entity::hsc($message),
			'frommail' => Entity::hsc($frommail)
		);
		
		if ( $member->isLoggedIn() )
		{
			$this->doForm('membermailform-loggedin');
		}
		else if ( $CONF['NonmemberMail'] )
		{
			$this->doForm('membermailform-notloggedin');
		}
		else
		{
			$this->doForm('membermailform-disallowed');
		}
		return;
	}
	
	/**
	 * Actions::parse_nextarchive()
	 * Parse skinvar nextarchive
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_nextarchive()
	{
		global $archivenext;
		echo $archivenext;
		return;
	}
	
	/**
	 * Parse skinvar nextitem
	 * (include itemid of next item)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_nextitem()
	{
		global $itemidnext;
		if ( isset($itemidnext) )
		{
			echo (int)$itemidnext;
		}
		return;
	}
	
	/**
	 * Actions::parse_nextitemtitle()
	 * Parse skinvar nextitemtitle
	 * (include itemtitle of next item)
	 * 
	 * @param	string	$format	format of text
	 * @return	void
	 */
	public function parse_nextitemtitle($format = '')
	{
		global $itemtitlenext;
		
		switch ( $format )
		{
			case 'xml':
				echo Entity::hen($itemtitlenext);
				break;
			case 'raw':
				echo $itemtitlenext;
				break;
			case 'attribute':
			default:
				echo Entity::hsc($itemtitlenext);
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_nextlink()
	 * Parse skinvar nextlink
	 * 
	 * @param	string	$linktext	text for content of anchor element
	 * @param	integer	$amount		the amount of items in a display
	 * @param	integer	$recount	increment from this value
	 * @return	void
	 */
	public function parse_nextlink($linktext = '', $amount = 10, $recount = '')
	{
		global $itemidnext, $archivenext, $startpos;
		if ( $this->skintype == 'item' )
		{
			$this->itemlink($itemidnext, $linktext);
		}
		else if ( $this->skintype == 'search' || $this->skintype == 'index' )
		{
			$this->searchlink($amount, $startpos, 'next', $linktext, $recount);
		}
		else
		{
			$this->archivelink($archivenext, $linktext);
		}
		return;
	}

	/**
	 * Actions::parse_nucleusbutton()
	 * Parse skinvar nucleusbutton
	 * 
	 * @param	string	$imgurl	URL  for image
	 * @param	integer	$imgwidth	width of image
	 * @param	integer	$imgheidht	height of image
	 */
	public function parse_nucleusbutton($imgurl = '', $imgwidth = '85', $imgheight = '31')
	{
		global $CONF;
		if ( $imgurl == '' )
		{
			$imgurl = $CONF['AdminURL'] . 'nucleus.gif';
		}
		else if ( Parser::getProperty('IncludeMode') == 'skindir' )
		{
			// when skindit IncludeMode is used: start from skindir
			$imgurl = $CONF['SkinsURL'] . Parser::getProperty('IncludePrefix') . $imgurl;
		}
		
		$this->formdata = array(
			'imgurl' => $imgurl,
			'imgwidth' => $imgwidth,
			'imgheight' => $imgheight,
		);
		$this->doForm('nucleusbutton');
		return;
	}
	
	/**
	 * Actions::parse_otherarchive()
	 * Parse skinvar otherarchive
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @return	void
	 */	
	public function parse_otherarchive($blogname, $template, $category = '')
	{
		global $archive, $manager;
		sscanf($archive,'%d-%d-%d',$y,$m,$d);
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->setBlogCategory($b, $category);
		$this->preBlogContent('otherachive',$b);
		$b->showArchive($template, $y, $m, $d);
		$this->postBlogContent('otherachive',$b);
		return;
	}
	
	/**
	 * Actions::parse_otherarchivedaylist()
	 * Parse skinvar otherarchivedaylist
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @param	integer	$limit		the amount of items in a display
	 * @return	void
	 */
	public function parse_otherarchivedaylist($blogname, $template, $category = 'all', $limit = 0)
	{
		global $manager;
		if ( $category == 'all')
		{
			$category = '';
		}
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->setBlogCategory($b, $category);
		$this->preBlogContent('otherarchivelist',$b);
		$b->showArchiveList($template, 'day', $limit);
		$this->postBlogContent('otherarchivelist',$b);
		return;
	}
	
	/**
	 * Actions::parse_otherarchivelist()
	 * Parse skinvar otherarchivelist
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @param	integer	$limit		the amount of items in a display
	 * @return	void
	 */
	public function parse_otherarchivelist($blogname, $template, $category = 'all', $limit = 0)
	{
		global $manager;
		if ( $category == 'all' )
		{
			$category = '';
		}
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->setBlogCategory($b, $category);
		$this->preBlogContent('otherarchivelist',$b);
		$b->showArchiveList($template, 'month', $limit);
		$this->postBlogContent('otherarchivelist',$b);
		return;
	}
	
	/**
	 * Actions::parse_otherarchiveyearlist()
	 * Parse skinvar otherarchiveyearlist
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	string	$category	name of category
	 * @limit	integer	$limit		the amount of items in a display
	 */
	public function parse_otherarchiveyearlist($blogname, $template, $category = 'all', $limit = 0)
	{
		global $manager;
		if ( $category == 'all' )
		{
			$category = '';
		}
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->setBlogCategory($b, $category);
		$this->preBlogContent('otherarchivelist',$b);
		$b->showArchiveList($template, 'year', $limit);
		$this->postBlogContent('otherarchivelist',$b);
		return;
	}
	
	/**
	 * Actions::parse_otherblog()
	 * Parse skinvar otherblog
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	mixed	$amount		the amount of items, in case it includes the beginning
	 * @param	string	$category	name of category
	 * @return	void
	 */
	public function parse_otherblog($blogname, $template, $amount = 10, $category = '')
	{
		global $manager;
		
		list($limit, $offset) = sscanf($amount, '%d(%d)');
		
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->setBlogCategory($b, $category);
		$this->preBlogContent('otherblog',$b);
		$this->amountfound = $b->readLog($template, $limit, $offset);
		$this->postBlogContent('otherblog',$b);
		return;
	}
	
	/**
	 * Actions::parse_othersearchresults()
	 * Parse skinvar othersearchresults
	 * 
	 * @param	string	$blogname	name of weblog
	 * @param	string	$template	name of template
	 * @param	integer	$maxresults	the amount of results
	 * @return	void
	 */
	public function parse_othersearchresults($blogname, $template, $maxresults = 50)
	{
		global $query, $amount, $manager, $startpos;
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		// need this to select default category
		$this->setBlogCategory($b, '');
		$this->preBlogContent('othersearchresults',$b);
		$b->search($query, $template, $amount, $maxresults, $startpos);
		$this->postBlogContent('othersearchresults',$b);
		return;
	}
	
	/**
	 * Actions::parse_plugin()
	 * Executes a plugin skinvar
	 * extra parameters can be added
	 * 
	 * @param	string	$pluginName	name of plugin (without the NP_)
	 * @return	void
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
		
		// add skin type on front
		array_unshift($params, $this->skintype);
		
		call_user_func_array(array(&$plugin,'doSkinVar'), $params);
		return;
	}
	
	/**
	 * Actions::parse_prevarchive()
	 * Parse skinvar prevarchive
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_prevarchive()
	{
		global $archiveprev;
		echo $archiveprev;
	}
	
	/**
	 * Actions::parse_preview()
	 * Parse skinvar preview
	 * 
	 * @param	string	$template	name of tempalte
	 * @return	void
	 */
	public function parse_preview($template)
	{
		global $blog, $CONF, $manager;
		
		$template =& $manager->getTemplate($template);
		
		$row['body'] = '<span id="prevbody"></span>';
		$row['title'] = '<span id="prevtitle"></span>';
		$row['more'] = '<span id="prevmore"></span>';
		$row['itemlink'] = '';
		$row['itemid'] = 0; $row['blogid'] = $blog->getID();
		
		echo Template::fill($template['ITEM_HEADER'],$row);
		echo Template::fill($template['ITEM'],$row);
		echo Template::fill($template['ITEM_FOOTER'],$row);
		return;
	}
	
	/**
	 * Actions::parse_previtem()
	 * Parse skinvar previtem
	 * (include itemid of prev item)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_previtem()
	{
		global $itemidprev;
		if ( isset($itemidprev) )
		{
			echo (integer) $itemidprev;
		}
		return;
	}
	
	/**
	 * Actions::parse_previtemtitle()
	 * Parse skinvar previtemtitle
	 * (include itemtitle of prev item)
	 * 
	 * @param	String	$format	string format
	 * @return	String	formatted string
	 */
	public function parse_previtemtitle($format = '')
	{
		global $itemtitleprev;
		
		switch ( $format )
		{
			case 'xml':
				echo Entity::hen($itemtitleprev);
				break;
			case 'raw':
				echo $itemtitleprev;
				break;
			case 'attribute':
			default:
				echo Entity::hsc($itemtitleprev);
				break;
		}
		return;
	}
	
	/**
	 * Actions::parse_prevlink()
	 * Parse skinvar prevlink
	 * 
	 * @param	string	$linktext	text as a content of anchor element
	 * @param	integer	the amount of links
	 * @return	void
	 */
	public function parse_prevlink($linktext = '', $amount = 10)
	{
		global $itemidprev, $archiveprev, $startpos;
		
		if ( $this->skintype == 'item' )
		{
			$this->itemlink($itemidprev, $linktext);
		}
		else if ( $this->skintype == 'search' || $this->skintype == 'index' )
		{
			$this->searchlink($amount, $startpos, 'prev', $linktext);
		}
		else
		{
			$this->archivelink($archiveprev, $linktext);
		}
		return;
	}
	
	/**
	 * Actions::parse_query()
	 * Parse skinvar query
	 * (includes the search query)	 
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_query()
	{
		global $query;
		echo Entity::hsc($query);
		return;
	}
	
	/**
	 * Actions::parse_referer()
	 * Parse skinvar referer
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_referer()
	{
		echo Entity::hsc(serverVar('HTTP_REFERER'));
		return;
	}
	
	/**
	 * Actions::parse_searchform()
	 * Parse skinvar searchform
	 * 
	 * @param	string	$blogname	name of weblog
	 * @return	void
	 */
	public function parse_searchform($blogname = '')
	{
		global $CONF, $manager, $maxresults;
		if ( $blogname )
		{
			$blog =& $manager->getBlog(getBlogIDFromName($blogname));
		}
		else
		{
			global $blog;
		}
		// use default blog when no blog is selected
		$this->formdata = array(
			'id'	=> $blog?$blog->getID():$CONF['DefaultBlog'],
			'query'	=> Entity::hsc(getVar('query')),
		);
		$this->doForm('searchform');
		return;
	}
	
	/**
	 * Actions::parse_searchresults()
	 * Parse skinvar searchresults
	 * 
	 * @param	string	$template	name of tempalte
	 * @param	integer	$maxresults	searched items in a display
	 * @return	void;
	 */
	public function parse_searchresults($template, $maxresults = 50 )
	{
		global $blog, $query, $amount, $startpos;
		
		$this->setBlogCategory($blog, '');	// need this to select default category
		$this->preBlogContent('searchresults',$blog);
		$this->amountfound = $blog->search($query, $template, $amount, $maxresults, $startpos);
		$this->postBlogContent('searchresults',$blog);
		return;
	}
	
	/**
	 * Actions::parse_self()
	 * Parse skinvar self
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_self()
	{
		global $CONF;
		echo $CONF['Self'];
		return;
	}
	
	/**
	 * Actions::parse_sitevar()
	 * Parse skinvar sitevar
	 * (include a sitevar)
	 * 
	 * @param	string	$which
	 * @return	void
	 */
	public function parse_sitevar($which)
	{
		global $CONF;
		switch ( $which )
		{
			case 'url':
				echo $CONF['IndexURL'];
				break;
			case 'name':
				echo $CONF['SiteName'];
				break;
			case 'admin':
				echo $CONF['AdminEmail'];
				break;
			case 'adminurl':
				echo $CONF['AdminURL'];
		}
		return;
	}
	
	/**
	 * Actions::parse_skinname()
	 * Parse skinname
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_skinname()
	{
		echo $this->skin->getName();
		return;
	}
	
	/**
	 * Actions::parse_skintype()
	 * Parse skintype (experimental)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_skintype()
	{
		echo $this->skintype;
		return;
	}
	
	/**
	 * Actions::parse_text()
	 * Parse text
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_text($which)
	{
		// constant($which) only available from 4.0.4 :(
		if ( defined($which) )
		{
			eval("echo $which;");
		}
		return;
	}
	
	/**
	 * Actions::parse_ticket()
	 * Parse ticket
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_ticket()
	{
		global $manager;
		$manager->addTicketHidden();
		return;
	}

	/**
	 * Actions::parse_todaylink()
	 * Parse skinvar todaylink
	 * A link to the today page (depending on selected blog, etc...)
	 *
	 * @param	string	$linktext	text for link
	 * @return	void
	 */
	public function parse_todaylink($linktext = '')
	{
		global $blog, $CONF;
		if ( $blog )
		{
			echo $this->link(Link::create_blogid_link($blog->getID(),$this->linkparams), $linktext);
		}
		else
		{
			echo $this->link($CONF['SiteUrl'], $linktext);
		}
		return;
	}
	
	/**
	 * Parse vars
	 * When commentform is not used, to include a hidden field with itemid	 
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_vars()
	{
		global $itemid;
		echo '<input type="hidden" name="itemid" value="'.$itemid.'" />' . "\n";
		return;
	}

	/**
	 * Actions::parse_version()
	 * Parse skinvar version
	 * (include nucleus versionnumber)	 
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_version()
	{
		global $nucleus;
		echo 'Nucleus CMS ' . $nucleus['version'];
		return;
	}
	
	/**
	 * Actions::parse_sticky()
	 * Parse skinvar sticky
	 * 
	 * @param	integer	$itemnumber	id of item
	 * @param	string	$template	name of template
	 * @return	void
	 */
	public function parse_sticky($itemnumber = 0, $template = '')
	{
		global $manager;
		
		$itemnumber = intval($itemnumber);
		$itemarray = array($itemnumber);
		
		$b =& $manager->getBlog(getBlogIDFromItemID($itemnumber));
		$this->preBlogContent('sticky',$b);
		$this->amountfound = $b->readLogFromList($itemarray, $template);
		$this->postBlogContent('sticky',$b);
		return;
	}
}
