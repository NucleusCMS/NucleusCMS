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
class ItemActions extends BaseActions
{
	/**
	 * ItemActions::$currentItem
	 * item currently being handled (mysql result object, see Blog::showUsingQuery)
	 */
	public $currentItem;
	
	/**
	 * ItemActions::$linkparams
	 * contains an assoc array with parameters that need to be included when
	 * generating links to items/archives/... (e.g. catid)
	 */
	public $linkparams;
	
	/**
	 * ItemActions::$allowEditAll
	 * true when the current user is a blog admin (and thus allowed to edit all items) 
	 */
	private $allowEditAll;
	
	/**
	 * ItemActions::$lastVisit
	 * timestamp of last visit
	 */
	private $lastVisit;
	
	/**
	 * ItemActions::$blog
	 * reference to the blog currently being displayed
	 */
	private $blog;
	
	/**
	 * ItemActions::$template
	 * associative array with template info (part name => contents)
	 */
	private $template;
	
	/**
	 * ItemActions::$showComments
	 * true when comments need to be displayed
	 */
	private $showComments;
	
	/**
	 * ItemActions::$defined_actions
	 * defined actions in this class
	 */
	static private $defined_actions = array(
		'author',
		'authorid',
		'authorlink',
		'blogid',
		'blogurl',
		'body',
		'category',
		'categorylink',
		'catid',
		'closed',
		'comments',
		'date',
		'daylink',
		'edit',
		'editlink',
		'editpopupcode',
		'itemid',
		'itemlink',
		'karma',
		'karmaneglink',
		'karmaposlink',
		'more',
		'morelink',
		'new',
		'plugin',
		'query',
		'relevance',
		'smartbody',
		'syndicate_description',
		'syndicate_title',
		'time',
		'title',
	/* actions defined in BodyAction class */
		'image',
		'media',
		'popup',
		);
	
	/**
	 * ItemActions::__construct
	 * Enter description here ...
	 * @param unknown_type $blog
	 */
	public function __construct(&$blog)
	{
		global $catid, $member;
		// call constructor of superclass first
		parent::__construct();
		
		// extra parameters for created links
		if ( $catid )
		{
			$this->linkparams = array('catid' => $catid);
		}
		
		// check if member is blog admin (and thus allowed to edit all items)
		$this->allowEditAll = ($member->isLoggedIn() && $member->blogAdminRights($blog->getID()));
		$this->setBlog($blog);
		return;
	}
	
	/**
	 * ItemActions::getDefinedActions()
	 * Returns an array with the actions that are defined
	 * in the ItemActions class
	 * 
	 * @static
	 * @param	void
	 * @return	void
	 */
	static public function getDefinedActions()
	{
		return array_merge(self::$defined_actions, parent::getDefinedActions());
	}
	
	/**
	 * ItemActions::setLastVisit()
	 * 
	 * @param	timestamp	$lastVisit	timestamp of latest visit
	 * @return	void
	 */
	public function setLastVisit($lastVisit)
	{
		$this->lastVisit = $lastVisit;
		return;
	}
	
	/**
	 * ItemActions::setParser()
	 * 
	 * @param	object	&$parser	instance of Parser class
	 * @return	void
	 */
	public function setParser(&$parser)
	{
		$this->parser =& $parser;
		return;
	}
	
	/**
	 * ItemActions::setCurrentItem()
	 * 
	 * @param	object	$item	instance of Item class
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
	 * ItemActions::setBlog()
	 * 
	 * @param	object	&$blog	instance of Blog class
	 * @return	void
	 */
	public function setBlog(&$blog)
	{
		$this->blog =& $blog;
		return;
	}
	
	/**
	 * ItemActions::setTemplate()
	 * 
	 * @param	array	$template	array including templates
	 * @return	void
	 */
	public function setTemplate($template)
	{
		$this->template =& $template;
		return;
	}
	
	/**
	 * ItemActions::setShowComments()
	 * 
	 * @param	boolean	$val	need to be displayed or not
	 * @return	void
	 */
	public function setShowComments($val)
	{
		$this->showComments = (boolean) $val;
		return;
	}
	
	/**
	 * ItemActions::parse_blogid()
	 * Parse templatevar blogid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogid()
	{
		echo $this->blog->getID();
	}

	/**
	 * ItemActions::parse_body()
	 * Parse templatevar body
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_body()
	{
		$this->highlightAndParse($this->currentItem->body);
		return;
	}
	
	/**
	 * ItemActions::parse_more()
	 * Parse templatevar more
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_more()
	{
		$this->highlightAndParse($this->currentItem->more);
		return;
	}
	
	/**
	 * ItemActions::parse_itemid()
	 * Parse templatevar itemid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemid()
	{
		echo $this->currentItem->itemid;
		return;
	}
	
	/**
	 * ItemActions::parse_category()
	 * Parse templatevar category
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_category()
	{
		echo $this->currentItem->category;
		return;
	}
	
	/**
	 * ItemActions::parse_categorylink()
	 * Parse templatevar categorylink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_categorylink()
	{
		echo Link::create_link('category', array('catid' => $this->currentItem->catid, 'name' => $this->currentItem->category));
		return;
	}
	
	/**
	 * ItemActions::parse_catid()
	 * Parse templatevar catid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_catid()
	{
		echo $this->currentItem->catid;
		return;
	}
	
	/**
	 * ItemActions::parse_authorid()
	 * Parse templatevar authorid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_authorid()
	{
		echo $this->currentItem->authorid;
		return;
	}
	
	/**
	 * ItemActions::parse_authorlink()
	 * Parse templatevar authorlink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_authorlink()
	{
		$data = array(
				'memberid' => $this->currentItem->authorid,
				'name' => $this->currentItem->author,
				'extra' => $this->linkparams
			);
		
		echo Link::create_link('member', $data);
		return;
	}
	
	/**
	 * ItemActions::parse_query()
	 * Parse templatevar query
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_query()
	{
		echo $this->strHighlight;
		return;
	}
	
	/**
	 * ItemActions::parse_itemlink()
	 * Parse templatevar itemlink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemlink()
	{
		$data = array(
			'itemid'	=> $this->currentItem->itemid,
			'title'		=> $this->currentItem->title,
			'timestamp'	=> $this->currentItem->timestamp,
			'extra'		=> $this->linkparams
		);
		
		echo Link::create_link('item', $data);
		return;
	}
	
	/**
	 * ItemActions::parse_blogurl()
	 * Parse templatevar blogurl
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogurl()
	{
		echo $this->blog->getURL();
		return;
	}
	
	/**
	 * ItemActions::parse_closed()
	 * Parse templatevar closed
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_closed()
	{
		echo $this->currentItem->closed;
		return;
	}
	
	/**
	 * ItemActions::parse_relevance()
	 * Parse templatevar relevance
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_relevance()
	{
		echo round($this->currentItem->score,2);
		return;
	}
	
	/**
	 * ItemActions::parse_title()
	 * Parse templatevar title
	 *
	 * @param	string	$format	defines in which format the title is shown
	 * @return	void
	 */
	public function parse_title($format = '')
	{
		if ( is_array($this->currentItem) )
		{
			$itemtitle = $this->currentItem['title'];
		}
		elseif ( is_object($this->currentItem) )
		{
			$itemtitle = $this->currentItem->title;
		}
		switch ( $format )
		{
			case 'xml':
				echo Entity::hen($itemtitle);
				break;
			case 'attribute':
				echo Entity::hsc($itemtitle);
				break;
			case 'raw':
				echo $itemtitle;
				break;
			default:
				$this->highlightAndParse($itemtitle);
				break;
		}
		return;
	}
	
	/**
	 * ItemActions::parse_karma()
	 * Parse templatevar karma
	 * 
	 * @param	string	$type	type of data for karma
	 * @return	void
	 */
	public function parse_karma($type = 'totalscore')
	{
		global $manager;
		
		// get karma object
		$karma =& $manager->getKarma($this->currentItem->itemid);
		
		switch ( $type )
		{
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
		return;
	}
	
	/**
	 * ItemActions::parse_author()
	 * Parse templatevar author
	 * 
	 * @param	string	$which	key of data for author
	 * @return	void
	 */
	public function parse_author($which = '')
	{
		switch ( $which )
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
		return;
	}
	
	/**
	 * ItemActions::parse_smartbody()
	 * Parse templatevar smartbody
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_smartbody()
	{
		if ( !$this->currentItem->more )
		{
			$this->highlightAndParse($this->currentItem->body);
		}
		else
		{
			$this->highlightAndParse($this->currentItem->more);
		}
		return;
	}
	
	/**
	 * ItemActions::parse_morelink()
	 * Parse templatevar morelink
	 */
	public function parse_morelink()
	{
		if ( $this->currentItem->more )
		{
			$this->parser->parse($this->template['MORELINK']);
		}
		return;
	}
	
	/**
	 * ItemActions::parse_date()
	 * Parse templatevar date
	 *
	 * @param	string	$format	format optional strftime format
	 * @return	void
	 */
	public function parse_date($format = '')
	{
		if ( $format !== '' )
		{
			/* do nothing */
			;
		}
		else if ( !array_key_exists('FORMAT_DATE', $this->template) || $this->template['FORMAT_DATE'] === '' )
		{
			/* depends on the PHP's current locale */
			$format = '%X';
		}
		else
		{
			$format = $this->template['FORMAT_DATE'];
		}
		
		$offset = 0;
		if ( $this->blog )
		{
			$offset = $this->blog->getTimeOffset() * 3600;
		}
		
		echo i18n::formatted_datetime($format, $this->currentItem->timestamp, $offset);
		return;
	}
	
	/**
	 * ItemActions::parse_time()
	 * Parse templatevar time
	 *
	 * @param	string	$format	format optional strftime format
	 * @return	void
	 */
	public function parse_time($format = '')
	{
		if ( $format !== '' )
		{
			/* do nothing */
			;
		}
		else if ( !array_key_exists('FORMAT_TIME', $this->template) || $this->template['FORMAT_TIME'] === '' )
		{
			/* depends on the PHP's current locale */
			$format = '%x';
		}
		else
		{
			$format = $this->template['FORMAT_TIME'];
		}
		echo i18n::formatted_datetime($format, $this->currentItem->timestamp);
		return;
	}
	
	/**
	 * ItemActions::parse_syndicate_title()
	 * Parse templatevar syndicate_title
	 *
	 * @param	string	$maxLength	maxLength optional maximum length
	 * @return	string	syndicated	title
	 */
	public function parse_syndicate_title($maxLength = 100) {
		$syndicated = strip_tags($this->currentItem->title);
		echo Entity::hsc(Entity::shorten($syndicated,$maxLength,'...'));
	}
	
	/**
	 * ItemActions::parse_syndicate_description()
	 * Parse templatevar syndicate_description
	 *
	 * @param	stromg	$maxLength		maxlength optional maximum length
	 * @param	string	$addHighlight	highlighted string
	 * @return	void
	 */
	public function parse_syndicate_description($maxLength = 250, $addHighlight = 0)
	{
		$syndicated = strip_tags($this->currentItem->body);
		if ( $addHighlight )
		{
			$tmp_highlight = Entity::hsc(Entity::shorten($syndicated,$maxLength,'...'));
			echo $this->highlightAndParse($tmp_highlight);
		}
		else
		{
			echo Entity::hsc(Entity::shorten($syndicated,$maxLength,'...'));
		}
		return;
	}
	
	/**
	 * ItemActions::parse_karmaposlink()
	 * Parse templatevar karmaposlink
	 *
	 * @param	string	$text	text element for anchor element
	 * @return	void
	 */
	public function parse_karmaposlink($text = '')
	{
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votepositive&amp;itemid=' . $this->currentItem->itemid;
		if ( !$text )
		{
			echo '<a href="'.$link.'">' . $text . '</a>';
		}
		else
		{
			echo $link;
		}
		
		return;
	}
	
	/**
	 * ItemActions::parse_karmaneglink()
	 * Parse templatevar karmaneglink
	 *
	 * @param	string $text	text element for anchor element
	 * @return	void
	 */
	public function parse_karmaneglink($text = '')
	{
		global $CONF;
		$link = $CONF['ActionURL'] . '?action=votenegative&amp;itemid='.$this->currentItem->itemid;
		
		if ( !$text )
		{
			echo '<a href="'.$link.'">' . $text . '</a>';
		}
		else
		{
			echo $link;
		}
		
		return;
	}

	/**
	 * ItemActions::parse_new()
	 * Parse templatevar new
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_new()
	{
		if ( ($this->lastVisit != 0) && ($this->currentItem->timestamp > $this->lastVisit) )
		{
			echo $this->template['NEW'];
		}
		return;
	}
	
	/**
	 * ItemActions::parse_daylink()
	 * Parse templatevar daylink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_daylink()
	{
		echo Link::create_archive_link($this->blog->getID(), i18n::formatted_datetime('%Y-%m-%d', $this->currentItem->timestamp), $this->linkparams);
		return;
	}
	
	/**
	 * ItemActions::parse_comments(
	 * Parse templatevar comments
	 * 
	 * @param	integer	$maxToShow	maximum number of comments in a display
	 * @return	void
	 */
	public function parse_comments($maxToShow = 0)
	{
		if ( $maxToShow == 0 )
		{
			$maxToShow = $this->blog->getMaxComments();
		}
		
		// add comments
		if ( $this->showComments && $this->blog->commentsEnabled() )
		{
			$comments = new Comments($this->currentItem->itemid);
			$comments->setItemActions($this);
			$comments->showComments($this->template, $maxToShow, $this->currentItem->closed ? 0 : 1, $this->strHighlight);
		}
		return;
	}
	
	/**
	 * ItemActions::parse_plugin()
	 * Executes a plugin templatevar
	 *
	 * @param	string	$pluginName	name of plugin (without the NP_)
	 * @param	extra parameters can be added
	 * @return	void
	 */
	public function parse_plugin($pluginName)
	{
		global $manager;
		
		$plugin =& $manager->getPlugin("NP_{$pluginName}");
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
		
		call_user_func_array(array(&$plugin,'doTemplateVar'), $params);
		return;
	}
	
	/**
	 * ItemActions::parse_edit()
	 * Parse templatevar edit
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_edit()
	{
		global $member, $CONF;
		if ( $this->allowEditAll || ($member->isLoggedIn() && ($member->getID() == $this->currentItem->authorid)) )
		{
			$this->parser->parse($this->template['EDITLINK']);
		}
		return;
	}
	
	/**
	 * ItemActions::parse_editlink()
	 * Parse templatevar editlink
	 */
	public function parse_editlink()
	{
		global $CONF;
		echo $CONF['AdminURL'] . 'bookmarklet.php?action=edit&amp;itemid=' . $this->currentItem->itemid;
		return;
	}
	
	/**
	 * ItemActions::parse_editpopupcode()
	 * Parse templatevar editpopupcode
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_editpopupcode()
	{
		echo "if (event &amp;&amp; event.preventDefault) event.preventDefault();winbm=window.open(this.href,'nucleusbm','scrollbars=yes,width=600,height=550,left=10,top=10,status=yes,resizable=yes');winbm.focus();return false;";
		return;
	}
	
	/**
	 * ItemActions::highlightAndParse()
	 * Parses highlighted text, with limited actions only (to prevent not fully trusted team members
	 * from hacking your weblog.
	 * 'plugin variables in items' implementation by Andy
	 * 
	 * @param	array	$data	
	 * @return	void
	 */
	public function highlightAndParse(&$data)
	{
		$handler = new BodyActions($this->blog);
		$parser = new Parser($handler->getDefinedActions(), $handler);
		$handler->setTemplate($this->template);
		$handler->setHighlight($this->strHighlight);
		$handler->setCurrentItem($this->currentItem);
		$parser->parse($handler->highlight($data));
		return;
	}
	
	/**
	 * ItemActions::checkCondition()
	 * Checks conditions for if statements
	 *
	 * @param	string	$field	type of <%if%>
	 * @param	string	$name	property of field
	 * @param	string	$value	value of property
	 * @return	boolean
	 */
	protected function checkCondition($field, $name='', $value = '')
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
	 * ItemActions::ifCategory()
	 *  Different checks for a category
	 *  
	 * @param	string	$key	key of category
	 * @param	string	$value	value for key of category
	 * @return	boolean
	 */
	private function ifCategory($key = '', $value = '')
	{
		global $blog, $catid;
		
		// when no parameter is defined, just check if a category is selected
		if ( ($key != 'catname' && $key != 'catid') || ($value == '') )
		{
			return (boolean) $blog->isValidCategory($catid);
		}
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $blog->getCategoryIdFromName($value);
			if ( $value == $catid )
			{
				return (boolean) $blog->isValidCategory($catid);
			}
		}
		
		// check category id
		if ( ($key == 'catid') && ($value == $catid) )
		{
			return (boolean) $blog->isValidCategory($catid);
		}
		return FALSE;
	}
	
	/**
	 * ItemActions::ifAuthor()
	 * Different checks for an author
	 * 
	 * @param	string	$key	key of data for author
	 * @param	string	$value	value of data for author
	 * @return	boolean	correct or not
	 */
	private function ifAuthor($key = '', $value = '')
	{
		global $member, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));
		
		// when no parameter is defined, just check if author is current visitor
		if ( ($key != 'isadmin' && $key != 'name') || ($key == 'name' && $value == '') )
		{
			return (boolean) ((integer) $member->getID() > 0 && (integer) $member->getID() == (integer) $this->currentItem->authorid);
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
			return (boolean) $amember->isBlogAdmin($blogid);
		}
		
		return FALSE;
	}
	
	/**
	 * ItemActions::ifItemCategory()
	 * Different checks for a category
	 * 
	 * @param	string	$key	key of data for category to which item belongs
	 * @param	string	$value	value of data for category to which item belongs
	 * @return boolean	correct or not
	 */
	private function ifItemCategory($key = '', $value='')
	{
		global $catid, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentItem->itemid));
		
		// when no parameter is defined, just check if a category is selected
		if ( ($key != 'catname' && $key != 'catid') || ($value == '') )
		{
			return (boolean) $b->isValidCategory($catid);
		}
		
		$icatid = $this->currentItem->catid;
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $b->getCategoryIdFromName($value);
			if ( $value == $icatid )
			{
				return (boolean) $b->isValidCategory($icatid);
			}
		}
		
		// check category id
		if ( ($key == 'catid') && ($value == $icatid) )
		{
			return (boolean) $b->isValidCategory($icatid);
		}
		return FALSE;
	}

	
	/**
	 * ItemActions::ifOnTeam()
	 * Checks if a member is on the team of a blog and return his rights
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean	correct or not
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
		
		// use current blog
		if ( ($blogName == '') || !$manager->existsBlogID($blogid) )
		{
			$blogid = $blog->getID();
		}
		return (boolean) $member->teamRights($blogid);
	}
	
	/**
	 * ItemActions::ifAdmin()
	 * Checks if a member is admin of a blog
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean	correct or not
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
		
		// use current blog
		if ( ($blogName == '') || !$manager->existsBlogID($blogid) )
		{
			$blogid = $blog->getID();
		}
		return (boolean) $member->isBlogAdmin($blogid);
	}
	
	
	/**
	 * ItemActions::ifHasPlugin()
	 *	hasplugin,PlugName
	 *	   -> checks if plugin exists
	 *	hasplugin,PlugName,OptionName
	 *	   -> checks if the option OptionName from plugin PlugName is not set to 'no'
	 *	hasplugin,PlugName,OptionName=value
	 *	   -> checks if the option OptionName from plugin PlugName is set to value
	 *
	 * @param	string	$name	name of plugin
	 * @param	string	$value	key (and value) of plugin option
	 * @return	boolean	correct or not
	 */
	private function ifHasPlugin($name, $value)
	{
		global $manager;
		$condition = FALSE;
		// (pluginInstalled method won't write a message in the actionlog on failure)
		if ( $manager->pluginInstalled("NP_{$name}"))
		{
			$plugin =& $manager->getPlugin('NP_' . $name);
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
		return (boolean) $condition;
	}
	
	/**
	 * ItemActions::ifPlugin()
	 * Checks if a plugin exists and call its doIf function
	 * 
	 * @param	string	$name	name of plugin
	 * @param	string	$key	key of plugin option
	 * @param	string	$value	value of plugin option
	 * @return	boolean	callback output from plugin
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
		
		return (boolean) call_user_func_array(array(&$plugin, 'doIf'), $params);
	}
}