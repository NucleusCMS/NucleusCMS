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
 * @version $Id: CommentActions.php 1626 2012-01-09 15:46:54Z sakamocchi $
 */

class CommentActions extends BaseActions
{
	/**
	 * CommentsActions::$commentsObj
	 * ref to COMMENTS object which is using this object to handle its templatevars
	 */
	private $commentsObj;
	
	/**
	 * CommentsActions::$template
	 * template to use to parse the comments
	 */
	private $template;
	
	/**
	 * CommentsActions::$currentComment
	 * comment currenlty being handled (mysql result assoc array; see Comments::showComments())
	 */
	private $currentComment;
	
	/**
	 * CommentsActions::$defined_actions
	 * defined actions in this class
	 */
	static private $defined_actions = array(
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
	
	/**
	 * CommentActions::__construct()
	 * 
	 * @param	object	$comments	instance of Comments class
	 * @return	void
	 */
	public function __construct(&$comments)
	{
		// call constructor of superclass first
		parent::__construct();
		
		// reference to the comments object
		$this->setCommentsObj($comments);
		return;
	}
	
	/**
	 * CommentActions::getDefinedActions()
	 * 
	 * @param	void
	 * @return array	actions array
	 */
	public function getDefinedActions()
	{
		return self::$defined_actions;
	}
	
	/**
	 * CommentActions::setParser()
	 * 
	 * @param	object	$parser	instance of Parser class
	 * @return	void
	 */
	public function setParser(&$parser)
	{
		$this->parser =& $parser;
		return;
	}
	
	/**
	 * 
	 * CommentActions::setCommentsObj()
	 * 
	 * @param	object	$commentsObj	instance of Comments class
	 * @return	void
	 */
	public function setCommentsObj(&$commentsObj)
	{
		$this->commentsObj =& $commentsObj;
		return;
	}
	
	/**
	 * CommentActions::setTemplate()
	 * 
	 * @param	array	$template	array includes templates
	 * @return	void
	 */
	public function setTemplate($template)
	{
		$this->template =& $template;
		return;
	}
	
	/**
	 * CommentActions::setCurrentComment()
	 * Set $currentcommentid and $currentcommentarray
	 * 
	 * @param	array	$comment	associated array includes comment information
	 * @return	void
	 */
	public function setCurrentComment(&$comment)
	{
		global $currentcommentid, $currentcommentarray, $manager;
		
		if ( $comment['memberid'] != 0 )
		{
			if ( !array_key_exists('COMMENTS_AUTH', $this->template) )
			{
				$comment['authtext'] = '';
			}
			else
			{
				$comment['authtext'] = $this->template['COMMENTS_AUTH'];
			}
			
			$mem =& $manager->getMember($comment['memberid']);
			$comment['user'] = $mem->getDisplayName();
			
			if ( $mem->getURL() )
			{
				$comment['userid'] = $mem->getURL();
			}
			else
			{
				$comment['userid'] = $mem->getEmail();
			}
			
			$data = array(
				'memberid'	=> $comment['memberid'],
				'name'		=> $mem->getDisplayName(),
				'extra'		=> $this->commentsObj->itemActions->linkparams
			);
			
			$comment['userlinkraw'] = Link::create_link('member', $data);
		}
		else
		{
			// create smart links
			if ( !array_key_exists('userid', $comment) || !empty($comment['userid']) )
			{
				if ( (i18n::strpos($comment['userid'], 'http://') === 0) || (i18n::strpos($comment['userid'], 'https://') === 0) )
				{
					$comment['userlinkraw'] = $comment['userid'];
				}
				else
				{
					$comment['userlinkraw'] = 'http://' . $comment['userid'];
				}
			}
			else if ( NOTIFICATION::address_validation($comment['email']) )
			{
				$comment['userlinkraw'] = 'mailto:' . $comment['email'];
			}
			else if ( NOTIFICATION::address_validation($comment['userid']) )
			{
				$comment['userlinkraw'] = 'mailto:' . $comment['userid'];
			}
		}
		
		$this->currentComment =& $comment;
		$currentcommentid = $comment['commentid'];
		$currentcommentarray = $comment;
		return;
	}
	
	/**
	 * CommentActions::parse_authtext()
	 * Parse templatevar authtext
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_authtext()
	{
		if ( $this->currentComment['memberid'] != 0 )
		{
			$this->parser->parse($this->template['COMMENTS_AUTH']);
		}
		return;
	}
	
	/**
	 * CommentActions::parse_blogid()
	 * Parse templatevar blogid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogid() {
		echo $this->currentComment['blogid'];
	}
	
	/**
	 * CommentActions::parse_blogurl()
	 * Parse templatevar blogurl
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_blogurl()
	{
		global $manager;
		$blogid = getBlogIDFromItemID($this->commentsObj->itemid);
		$blog =& $manager->getBlog($blogid);
		echo $blog->getURL();
		return;
	}
	
	/**
	 * CommentActions::parse_body()
	 * Parse templatevar body
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_body() {
		echo $this->highlight($this->currentComment['body']);
		return;
	}
	
	/**
	 * CommentActions::parse_commentcount()
	 * Parse templatevar commentcount
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_commentcount()
	{
		echo $this->commentsObj->commentcount;
		return;
	}
	
	/**
	 * CommentActions::parse_commentid()
	 * Parse templatevar commentid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_commentid()
	{
		echo $this->currentComment['commentid'];
		return;
	}
	
	/**
	 * CommentActions::parse_commentword()
	 * Parse templatevar commentword
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_commentword()
	{
		if ( $this->commentsObj->commentcount == 1 )
		{
			echo $this->template['COMMENTS_ONE'];
		}
		else
		{
			echo $this->template['COMMENTS_MANY'];
		}
		return;
	}
	
	/**
	 * CommentActions::parse_date()
	 * Parse templatevar date
	 * 
	 * @format	String	$format	Date format according to PHP
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
			$format = '%X';
		}
		else
		{
			$format = $this->template['FORMAT_DATE'];
		}
		
		$offset = $this->commentsObj->itemActions->blog->getTimeOffset() * 3600;
		
		echo i18n::formatted_datetime($format, $this->currentComment['timestamp'], $offset);
		return;
	}
	
	/**
	 * CommentActions::parse_excerpt()
	 * Parse templatevar email
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_email()
	{
		$email = $this->currentComment['email'];
		$email = str_replace('@', ' (at) ', $email);
		$email = str_replace('.', ' (dot) ', $email);
		echo $email;
		return;
	}
	
	/**
	 * CommentActions::parse_excerpt()
	 * Parse templatevar excerpt
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_excerpt()
	{
		echo Entity::hen(Entity::shorten($this->currentComment['body'], 60, '...'));
		return;
	}
	
	/**
	 * CommentActions::parse_host()
	 * Parse templatevar host
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_host()
	{
		echo $this->currentComment['host'];
		return;
	}
	
	/**
	 * CommentActions::parse_ip()
	 * Parse templatevar ip
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_ip()
	{
		echo $this->currentComment['ip'];
		return;
	}
	
	/**
	 * CommentActions::parse_itemid()
	 * Parse templatevar itemid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemid()
	{
		echo $this->commentsObj->itemid;
		return;
	}
	
	/**
	 * CommentActions::parse_itemlink()
	 * Parse templatevar itemlink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_itemlink()
	{
		$data = array(
			'itemid'	=> $this->commentsObj->itemid,
			'timestamp'	=> $this->commentsObj->itemActions->currentItem->timestamp,
			'title'		=> $this->commentsObj->itemActions->currentItem->title,
			'extra'		=> $this->commentsObj->itemActions->linkparams
		);
		
		echo Link::create_link('item', $data);
		return;
	}
	
	/**
	 * CommentActions::parse_itemtitle()
	 * Parse templatevar itemtitle
	 * 
	 * @param	integer	$maxLength	maximum length for item title
	 * @return	void
	 */
	public function parse_itemtitle($maxLength = 0)
	{
		if ( $maxLength == 0 )
		{
			$this->commentsObj->itemActions->parse_title();
		}
		else
		{
			$this->commentsObj->itemActions->parse_syndicate_title($maxLength);
		}
		return;
	}
	
	/**
	 * CommentActions::parse_memberid()
	 * Parse templatevar memberid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_memberid()
	{
		echo $this->currentComment['memberid'];
		return;
	}
	
	/**
	 * CommentActions::parse_short()
	 * Parse templatevar short
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_short()
	{
		$tmp = strtok($this->currentComment['body'], "\n");
		$tmp = str_replace('<br />', '', $tmp);
		echo $tmp;
		if ( $tmp != $this->currentComment['body'] )
		{
			$this->parser->parse($this->template['COMMENTS_CONTINUED']);
		}
		return;
	}
	
	/**
	 * CommentActions::parse_time()
	 * Parse templatevar time
	 * 
	 * @param	string	$format	datetime format referring to strftime() in PHP's built-in function
	 * @return	void
	 */
	public function parse_time($format = '')
	{
		if ( $format === '' )
		{
			/* do nothing */
			;
		}
		else if ( !array_key_exists('FORMAT_TIME', $this->template) || $this->template['FORMAT_TIME'] === '' )
		{
			$format = '%x';
		}
		else
		{
			$format = $this->template['FORMAT_TIME'];
		}
		
		echo i18n::formatted_datetime($format, $this->currentComment['timestamp']);
		return;
	}
	
	/**
	 * CommentActions::parse_timestamp()
	 * Parse templatevar timestamp
	 * 
	 * @param	void
	 * @return	void
	 * 
	 */
	public function parse_timestamp()
	{
		echo $this->currentComment['timestamp'];
		return;
	}
	
	/**
	 * CommentActions::parse_plugin()
	 * Executes a plugin templatevar
	 *
	 * @param	string	$pluginName	name of plugin (without the NP_)
	 * @param	extra parameters can be added
	 * @return	void
	 */
	public function parse_plugin($pluginName)
	{
		global $manager;
		
		// only continue when the plugin is really installed
		if ( !$manager->pluginInstalled("NP_{$pluginName}") )
		{
			return;
		}
		
		$plugin =& $manager->getPlugin("NP_{$pluginName}");
		if ( !$plugin )
		{
			return;
		}
		
		// get arguments
		$params = func_get_args();
		
		// remove plugin name
		array_shift($params);
		
		// pass info on current item and current comment as well
		$params = array_merge(array(&$this->currentComment), $params);
		$params = array_merge(array(&$this->commentsObj->itemActions->currentItem), $params);
		
		call_user_func_array(array(&$plugin,'doTemplateCommentsVar'), $params);
		return;
	}
	
	/**
	 * CommentActions::parse_user()
	 * Parse templatevar user
	 * 
	 * @param	string	$mode	realname or else
	 * @return	void
	 */
	public function parse_user($mode = '')
	{
		global $manager;
		
		if ( $mode == 'realname' && $this->currentComment['memberid'] > 0 )
		{
			$member =& $manager->getMember($this->currentComment['memberid']);
			echo $member->getRealName();
		}
		else
		{
			echo Entity::hsc($this->currentComment['user']);
		}
		return;
	}
	
	/**
	 * CommentActions::parse_useremail()
	 * Output mail address
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_useremail() {
		global $manager;
		if ( $this->currentComment['memberid'] > 0 )
		{
			$member =& $manager->getMember($this->currentComment['memberid']);
			
			if ( $member->email != '' )
			{
				echo $member->email;
			}
		}
		else
		{
			if ( NOTIFICATION::address_validation($this->currentComment['email']) )
			{
				echo $this->currentComment['email'];
			}
			elseif ( NOTIFICATION::address_validation($this->currentComment['userid']) )
			{
				echo $this->currentComment['userid'];
			}
		}
		return;
	}
	
	/**
	 * CommentActions::parse_userid()
	 * Parse templatevar userid
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_userid()
	{
		echo $this->currentComment['userid'];
		return;
	}
	
	/**
	 * CommentActions::parse_userlink()
	 * Parse templatevar userlink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_userlink()
	{
		if ( $this->currentComment['userlinkraw'] )
		{
			echo '<a href="'.$this->currentComment['userlinkraw'].'" rel="nofollow">'.$this->currentComment['user'].'</a>';
		}
		else
		{
			echo $this->currentComment['user'];
		}
		return;
	}
	
	/**
	 * CommentActions::parse_userlinkraw()
	 * Parse templatevar userlinkraw
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_userlinkraw()
	{
		echo $this->currentComment['userlinkraw'];
		return;
	}
	
	/**
	 * CommentActions::parse_userwebsite()
	 * Parse templatevar userwebsite
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_userwebsite()
	{
		if ( !(i18n::strpos($this->currentComment['userlinkraw'], 'http://') === false) )
		{
			echo $this->currentComment['userlinkraw'];
		}
		return;
	}
	
	/**
	 * CommentActions::parse_userwebsitelink()
	 * Parse templatevar userwebsitelink
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_userwebsitelink()
	{
		if ( !(i18n::strpos($this->currentComment['userlinkraw'], 'http://') === false) )
		{
			echo '<a href="'.$this->currentComment['userlinkraw'].'" rel="nofollow">'.$this->currentComment['user'].'</a>';
		}
		else
		{
			echo $this->currentComment['user'];
		}
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
	private function checkCondition($field, $name='', $value = '') {
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
				$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
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
	 * CommentActions::ifCategory()
	 * Different checks for a category
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
			return $blog->isValidCategory($catid);
		}
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $blog->getCategoryIdFromName($value);
			if ($value == $catid)
			return $blog->isValidCategory($catid);
		}
		
		// check category id
		if ( ($key == 'catid') && ($value == $catid) )
		{
			return $blog->isValidCategory($catid);
		}
		return FALSE;
	}
	
	/**
	 * CommentActions::ifAuthor()
	 * Different checks for an author
	 *
	 * @param	string	$key	key of data for author
	 * @param	string	$value	value of data for author
	 * @return	boolean	correct or not
	 */
	private function ifAuthor($key = '', $value = '')
	{
		global $member, $manager;
		
		if ( $this->currentComment['memberid'] == 0 )
		{
			return FALSE;
		}
		
		$mem =& $manager->getMember($this->currentComment['memberid']);
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		$citem =& $manager->getItem($this->currentComment['itemid'], 1, 1);
		
		// when no parameter is defined, just check if item author is current visitor
		if (($key != 'isadmin' && $key != 'name' && $key != 'isauthor' && $key != 'isonteam')) {
			return (intval($member->getID()) > 0 && intval($member->getID()) == intval($citem['authorid']));
		}
		
		// check comment author name
		if ( $key == 'name' )
		{
			$value = trim(strtolower($value));
			if ( $value == '' )
			{
				return FALSE;
			}
			if ( $value == strtolower($mem->getDisplayName()) )
			{
				return TRUE;
			}
		}
		
		// check if comment author is admin
		if ( $key == 'isadmin' )
		{
			$blogid = intval($b->getID());
			if ( $mem->isAdmin() )
			{
				return TRUE;
			}
			return $mem->isBlogAdmin($blogid);
		}
		
		// check if comment author is item author
		if ( $key == 'isauthor' )
		{
			return (intval($citem['authorid']) == intval($this->currentComment['memberid']));
		}
		
		// check if comment author is on team
		if ( $key == 'isonteam' )
		{
			return $mem->teamRights(intval($b->getID()));
		}
		return FALSE;
	}
	
	/**
	 * CommentActions::ifItemCategory()
	 * Different checks for a category
	 *
	 * @param	string	$key	key of data for category to which item belongs
	 * @param	string	$value	value of data for category to which item belongs
	 * @return boolean	correct or not
	 */
	private function ifItemCategory($key = '', $value = '')
	{
		global $catid, $manager;
	
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		$citem =& $manager->getItem($this->currentComment['itemid'],1,1);
		$icatid = $citem['catid'];
	
		// when no parameter is defined, just check if a category is selected
		if ( ($key != 'catname' && $key != 'catid') || ($value == '') )
		{
			return $b->isValidCategory($icatid);
		}
	
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
	 * CommentActions::ifOnTeam()
	 * Checks if a member is on the team of a blog and return his rights
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean	correct or not
	 */
	private function ifOnTeam($blogName = '')
	{
		global $blog, $member, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		
		// when no blog found
		if ( ($blogName == '') && (!is_object($b)) )
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
			$blogid = $b->getID();
		}
		
		return $member->teamRights($blogid);
	}
	
	/**
	 * CommentActions::ifAdmin()
	 * Checks if a member is admin of a blog
	 * 
	 * @param	string	$blogName	name of weblog
	 * @return	boolean	correct or not
	 */
	private function ifAdmin($blogName = '')
	{
		global $blog, $member, $manager;
		
		$b =& $manager->getBlog(getBlogIDFromItemID($this->currentComment['itemid']));
		
		// when no blog found
		if ( ($blogName == '') && (!is_object($b)) )
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
			$blogid = $b->getID();
		}
		
		return $member->isBlogAdmin($blogid);
	}
	
	/**
	 * CommentActions::ifHasPlugin()
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
		if ( $manager->pluginInstalled('NP_'.$name) )
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
	 * CommentActions::ifPlugin()
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
		
		return call_user_func_array(array(&$plugin, 'doIf'), $params);
	}
}
