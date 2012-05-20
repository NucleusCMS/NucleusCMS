<?php

/*
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
 * A class representing a blog and containing functions to get that blog shown
 * on the screen
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id: BLOG.php 1624 2012-01-09 11:36:20Z sakamocchi $
 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/ITEMACTIONS.php';

class Blog
{
	// blog id
	public $blogid;

	// After creating an object of the blog class, contains true if the BLOG object is
	// valid (the blog exists)
	public $isValid;

	// associative array, containing all blogsettings (use the get/set functions instead)
	private $settings;
	
	// ID of currently selected category
	private $selectedcatid;

	/**
	 * Blog::_\construct()
	 * Creates a new BLOG object for the given blog
	 *
	 * @param	integer	$id	blogid
	 * @return	void
	 */
	public function __construct($id)
	{
		global $catid;
		
		$this->blogid = (integer) $id;
		$this->readSettings();
		$this->setSelectedCategory($catid);
		return;
	}
	
	/**
	 * Blog::readLog()
	 * Shows the given amount of items for this blog
	 *
	 * @param	string	$template	String representing the template _NAME_ (!)
	 * @param	integer	$amountEntries	amount of entries to show
	 * @param	integer	$startpos	offset from where items should be shown (e.g. 5 = start at fifth item)
	 * @return	integer	amount of items shown
	 */
	public function readLog($template, $amountEntries, $offset = 0, $startpos = 0)
	{
		return $this->readLogAmount($template,$amountEntries,'','',1,1,$offset, $startpos);
	}
	
	/**
	 * Blog::showArchive()
	 * Shows an archive for a given month
	 *
	 * @param	integer	$year		year
	 * @param	integer	$month		month
	 * @param	string	$template	String representing the template name to be used
	 * @return	void
	 */
	public function showArchive($templatename, $year, $month=0, $day=0)
	{
		// create extra where clause for select query
		if ( $day == 0 && $month != 0 )
		{
			$timestamp_start = mktime(0,0,0,$month,1,$year);
			// also works when $month==12
			$timestamp_end = mktime(0,0,0,$month+1,1,$year);
		}
		elseif ( $month == 0 )
		{
			$timestamp_start = mktime(0,0,0,1,1,$year);
			// also works when $month==12
			$timestamp_end = mktime(0,0,0,12,31,$year);
		}
		else
		{
			$timestamp_start = mktime(0,0,0,$month,$day,$year);
			$timestamp_end = mktime(0,0,0,$month,$day+1,$year);
		}
		$extra_query = " and i.itime>=%s and i.itime<%s";
		$extra_query = sprintf($extra_query, DB::formatDateTime($timestamp_start), DB::formatDateTime($timestamp_end));
		
		$this->readLogAmount($templatename,0,$extra_query,'',1,1);
		return;
	}
	
	/**
	 * Blog::setSelectedCategory()
	 * Sets the selected category by id (only when category exists)
	 * 
	 * @param	integer	$catid	ID for category
	 * @return	void
	 */
	public function setSelectedCategory($catid)
	{
		if ( $this->isValidCategory($catid) || (intval($catid) == 0) )
		{
			$this->selectedcatid = intval($catid);
		}
		return;
	}
	
	/**
	 * Blog::setSelectedCategoryByName()
	 * Sets the selected category by name
	 * 
	 * @param	string	$catname	name of category
	 * @return	void
	 */
	public function setSelectedCategoryByName($catname)
	{
		$this->setSelectedCategory($this->getCategoryIdFromName($catname));
		return;
	}
	
	/**
	 * Blog::getSelectedCategory()
	 * Returns the selected category
	 * 
	 * @param	void
	 * @return	integer
	 */
	public function getSelectedCategory()
	{
		return $this->selectedcatid;
	}
	
	/**
	 * Shows the given amount of items for this blog
	 *
	 * @param	string	$template		string representing the template _NAME_ (!)
	 * @param	integer	$amountEntries	amount of entries to show (0 = no limit)
	 * @param	string	$extraQuery		extra conditions to be added to the query
	 * @param	string	$highlight		contains a query that should be highlighted
	 * @param	integer	$comments		1=show comments 0=don't show comments
	 * @param	integer	$dateheads		1=show dateheads 0=don't show dateheads
	 * @param	integer	$offset			offset
	 * @return	integer	amount of items shown
	 */
	private function readLogAmount($template, $amountEntries, $extraQuery, $highlight, $comments, $dateheads, $offset = 0, $startpos = 0)
	{
		$query = $this->getSqlBlog($extraQuery);
		
		if ( $amountEntries > 0 )
		{
			// $offset zou moeten worden:
			// (($startpos / $amountentries) + 1) * $offset ... later testen ...
			$query .= ' LIMIT ' . intval($startpos + $offset).',' . intval($amountEntries);
		}
		return $this->showUsingQuery($template, $query, $highlight, $comments, $dateheads);
	}
	
	/**
	 * Blog::showUsingQuery()
	 * Do the job for readLogAmmount
	 * 
	 * @param	string	$templateName	template name
	 * @param	string	$query			string for query
	 * @param	string	$highlight		string to be highlighted
	 * @param	integer	$comments		the number of comments
	 * @param	boolean	$dateheads		date header is needed or not
	 * @return	integer	the number of rows as a result of mysql query
	 */
	private function showUsingQuery($templateName, $query, $highlight = '', $comments = 0, $dateheads = 1)
	{
		global $CONF, $manager, $currentTemplateName;
		
		$lastVisit = cookieVar($CONF['CookiePrefix'] .'lastVisit');
		if ( $lastVisit != 0 )
		{
			$lastVisit = $this->getCorrectTime($lastVisit);
		}
		
		// set templatename as global variable (so plugins can access it)
		$currentTemplateName = $templateName;
		$template =& $manager->getTemplate($templateName);
		
		// create parser object & action handler
		$handler = new ItemActions($this);
		$handler->setTemplate($template);
		$handler->setHighlight($highlight);
		$handler->setLastVisit($lastVisit);
		$handler->setShowComments($comments);
		
		$parser = new Parser($handler);
		
		// execute query
		$items = DB::getResult($query);
		
		// loop over all items
		$old_date = 0;
		foreach ( $items as $item )
		{
			// string timestamp -> unix timestamp
			$item['timestamp'] = strtotime($item['itime']);
			
			// action handler needs to know the item we're handling
			$handler->setCurrentItem($item);
			
			// add date header if needed
			if ( $dateheads )
			{
				$new_date = date('dFY', $item['timestamp']);
				if ( $new_date != $old_date )
				{
					// unless this is the first time, write date footer
					$timestamp = $item['timestamp'];
					if ( $old_date != 0 )
					{
						$oldTS = strtotime($old_date);
						$manager->notify('PreDateFoot',array('blog' => &$this, 'timestamp' => $oldTS));
						
						if ( !in_array('DATE_FOOTER', $template) || empty($template['DATE_FOOTER']) )
						{
							$tmp_footer = '';
						}
						else
						{
							$tmp_footer = i18n::formatted_datetime($template['DATE_FOOTER'], $oldTS);
						}
						$parser->parse($tmp_footer);
						$manager->notify('PostDateFoot',array('blog' => &$this, 'timestamp' => $oldTS));
					}
					
					$manager->notify('PreDateHead',array('blog' => &$this, 'timestamp' => $timestamp));
					
					// note, to use templatvars in the dateheader, the %-characters need to be doubled in
					// order to be preserved by strftime
					if ( !in_array('DATE_HEADER', $template) || empty($template['DATE_HEADER']) )
					{
						$tmp_header = '';
					}
					else
					{
						$tmp_header = i18n::formatted_datetime($template['DATE_HEADER'], $timestamp);
					}
					$parser->parse($tmp_header);
					$manager->notify('PostDateHead',array('blog' => &$this, 'timestamp' => $timestamp));
				}
				$old_date = $new_date;
			}
			
			// parse item
			$parser->parse($template['ITEM_HEADER']);
			$manager->notify('PreItem', array('blog' => &$this, 'item' => &$item));
			$parser->parse($template['ITEM']);
			$manager->notify('PostItem', array('blog' => &$this, 'item' => &$item));
			$parser->parse($template['ITEM_FOOTER']);
		}
		
		$numrows = $items->rowCount();
		
		// add another date footer if there was at least one item
		if ( ($numrows > 0) && $dateheads )
		{
			$manager->notify('PreDateFoot',array('blog' => &$this, 'timestamp' => strtotime($old_date)));
			$parser->parse($template['DATE_FOOTER']);
			$manager->notify('PostDateFoot',array('blog' => &$this, 'timestamp' => strtotime($old_date)));
		}
		
		$items->closeCursor();
		return $numrows;
	}
	
	/**
	 * Blog::showOneitem()
	 * Simplified function for showing only one item
	 * 
	 * @param	integer	$itemid		ID for item
	 * @param	array	$template	template for item
	 * @param	string	$highlight	string for highlight
	 * @return	integer	1
	 */
	public function showOneitem($itemid, $template, $highlight)
	{
		$extraQuery = ' and inumber=' . intval($itemid);
		
		return $this->readLogAmount($template, 1, $extraQuery, $highlight, 0, 0);
	}
	
	/**
	 * Blog::addItem()
	 * Adds an item to this blog
	 * 
	 * @param	integer		$catid	ID for category
	 * @param	string		$title	ID for 
	 * @param	string		$body	text for body
	 * @param	string		$more	text for more
	 * @param	integer		$blogid	ID for blog
	 * @param	integer		$authorid	ID for author
	 * @param	timestamp	$timestamp	UNIX timestamp for post
	 * @param	boolean		$closed	opened or closed
	 * @param	boolean		$draft	draft or not
	 * @param	boolean		$posted	posted or not
	 * @return	integer	ID for added item
	 */
	function additem($catid, $title, $body, $more, $blogid, $authorid, $timestamp, $closed, $draft, $posted='1')
	{
		global $manager;
		
		$blogid		= (integer) $blogid;
		$authorid	= (integer) $authorid;
		$title		= $title;
		$body		= $body;
		$more		= $more;
		$catid		= intval($catid);
		
		// convert newlines to <br />
		if ( $this->convertBreaks() )
		{
			$body = addBreaks($body);
			$more = addBreaks($more);
		}

		if ( $closed != '1' )
		{
			$closed = '0';
		}
		if ( $draft != '0' )
		{
			$draft = '1';
		}
		
		if ( !$this->isValidCategory($catid) )
		{
			$catid = $this->getDefaultCategory();
		}
		
		$isFuture = 0;
		if ( $timestamp > $this->getCorrectTime() )
		{
			$isFuture = 1;
		}
		
		$timestamp = date('Y-m-d H:i:s',$timestamp);
		
		$manager->notify('PreAddItem',array('title' => &$title, 'body' => &$body, 'more' => &$more, 'blog' => &$this, 'authorid' => &$authorid, 'timestamp' => &$timestamp, 'closed' => &$closed, 'draft' => &$draft, 'catid' => &$catid));
		
		$ititle = DB::quoteValue($title);
		$ibody = DB::quoteValue($body);
		$imore = DB::quoteValue($more);
		$timestamp = DB::formatDateTime(strtotime($timestamp));
		
		$query = "INSERT INTO %s (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IDRAFT, ICAT, IPOSTED) VALUES (%s, %s, %s, %d, %d, %s, %s, %s, %s, %s)";
		$query = sprintf($query, sql_table('item'), $ititle, $ibody, $imore, $blogid, $authorid, $timestamp, $closed, $draft, $catid, $posted);
		DB::execute($query);
		$itemid = DB::getInsertId();
		
		$manager->notify('PostAddItem',array('itemid' => $itemid));
		
		if ( !$draft )
		{
			$this->updateUpdateFile();
		}
		// send notification mail
		if ( !$draft && !$isFuture && $this->getNotifyAddress() && $this->notifyOnNewItem() )
		{
			$this->sendNewItemNotification($itemid, $title, $body);
		}
		return $itemid;
	}
	
	/**
	 * Blog::sendNewItemNotification()
	 * Send a new item notification to the notification list
	 * 
	 * @param	string	$itemid	ID of the item
	 * @param	string	$title	title of the item
	 * @param	string	$body	body of the item
	 * @return	void
	 */
	public function sendNewItemNotification($itemid, $title, $body)
	{
		global $CONF, $member;
		
		$ascii = Entity::anchor_footnoting($body);
		
		$message = _NOTIFY_NI_MSG . " \n";
		$temp = parse_url($CONF['Self']);
		if ( $temp['scheme'] )
		{
			$message .= Link::create_item_link($itemid) . "\n\n";
		}
		else
		{
			$tempurl = $this->getURL();
			if ( i18n::substr($tempurl, -1) == '/' || i18n::substr($tempurl, -4) == '.php' )
			{
				$message .= $tempurl . '?itemid=' . $itemid . "\n\n";
			}
			else
			{
				$message .= $tempurl . '/?itemid=' . $itemid . "\n\n";
			}
		}
		$message .= _NOTIFY_TITLE . ' ' . strip_tags($title) . "\n";
		$message .= _NOTIFY_CONTENTS . "\n " . $ascii . "\n";
		$message .= NOTIFICATION::get_mail_footer();
		
		$subject = $this->getName() . ': ' . _NOTIFY_NI_TITLE;
		
		$from = $member->getNotifyFromMailAddress();
		
		NOTIFICATION::mail($this->getNotifyAddress(), $subject, $message, $from, i18n::get_current_charset());
		return;
	}
	
	/**
	 * Blog::createNewCategory()
	 * Creates a new category for this blog
	 *
	 * @param	string	$catName		name of the new category. When empty, a name is generated automatically (starting with newcat)
	 * @param	string	$catDescription	description of the new category. Defaults to 'New Category'
	 * @return	integer	ID for new category on success. 0 on failure
	 */
	public function createNewCategory($catName = '', $catDescription = _CREATED_NEW_CATEGORY_DESC)
	{
		global $member, $manager;
		
		if ( !$member->blogAdminRights($this->blogid) )
		{
			return 0;
		}
		
		// generate
		if ( $catName == '' )
		{
			$catName = _CREATED_NEW_CATEGORY_NAME;
			$i = 1;
			
			$res = DB::getResult('SELECT * FROM '.sql_table('category')." WHERE cname='".$catName.$i."' and cblog=".$this->blogid);
			while ( $res->rowCount() > 0 )
			{
				$i++;
				$res = DB::getResult('SELECT * FROM '.sql_table('category')." WHERE cname='".$catName.$i."' and cblog=".$this->blogid);
			}
			
			$catName = $catName . $i;
		}
		
		$data = array(
			'blog'			=> &$this,
			'name'			=> &$catName,
			'description'	=> $catDescription
		);
		$manager->notify('PreAddCategory', $data);
		
		$query = "INSERT INTO %s (cblog, cname, cdesc) VALUES (%d, %s, %s)";
		$query = sprintf($query, sql_table('category'), (integer) $this->blogid, DB::quoteValue($catName), DB::quoteValue($catDescription));
		DB::execute($query);
		$catid = DB::getInsertId();
		
		$data = array(
			'blog'			=> &$this,
			'name'			=> $catName,
			'description'	=> $catDescription,
			'catid'			=> $catid
		);
		$manager->notify('PostAddCategory', $data);
		
		return $catid;
	}
	
	/**
	 * Blog::search()
	 * Searches all months of this blog for the given query
	 *
	 * @param	string	$query			search query
	 * @param	array	$template		template to be used (__NAME__ of the template)
	 * @param	integer	$amountMonths	max amount of months to be search (0 = all)
	 * @param	integer	$maxresults		max number of results to show
	 * @param	integer	$startpos		offset
	 * @return	amount of hits found
	 */
	public function search($query, $template, $amountMonths, $maxresults, $startpos) {
		global $CONF, $manager;
		
		$highlight 	= '';
		$sqlquery	= $this->getSqlSearch($query, $amountMonths, $highlight);
		
		if ( $sqlquery == '' )
		{
			// no query -> show everything
			$extraquery = '';
			$amountfound = $this->readLogAmount($template, $maxresults, $extraQuery, $query, 1, 1);
		}
		else
		{
			// add LIMIT to query (to split search results into pages)
			if ( intval($maxresults > 0) )
			{
				$sqlquery .= ' LIMIT ' . intval($startpos) . ',' . intval($maxresults);
			}
			
			// show results
			$amountfound = $this->showUsingQuery($template, $sqlquery, $highlight, 1, 1);
			
			// when no results were found, show a message
			if ( $amountfound == 0 )
			{
				$template =& $manager->getTemplate($template);
				$vars = array(
					'query'		=> Entity::hsc($query),
					'blogid'	=> $this->blogid
				);
				echo Template::fill($template['SEARCH_NOTHINGFOUND'], $vars);
			}
		}
		return $amountfound;
	}
	
	/**
	 * Blog::getSqlSearch()
	 * Returns an SQL query to use for a search query
	 * No LIMIT clause is added. (caller should add this if multiple pages are requested)
	 *
	 * @param	string	$query			search query
	 * @param	integer	$amountMonths	amount of months to search back. Default = 0 = unlimited
	 * @param	string	$mode			either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
	 * @return	string	$highlight		words to highlight (out parameter)
	 * @return	string	either a full SQL query, or an empty string (if querystring empty)
	 */
	public function getSqlSearch($query, $amountMonths = 0, &$highlight, $mode = '')
	{
		$searchclass = new Search($query);
		
		$highlight	 = $searchclass->inclusive;
		
		// if querystring is empty, return empty string
		if ( $searchclass->inclusive == '' )
		{
			return '';
		}
		
		$where  = $searchclass->boolean_sql_where('ititle,ibody,imore');
		$select = $searchclass->boolean_sql_select('ititle,ibody,imore');
		
		// get list of blogs to search
		$blogs		= $searchclass->blogs;	// array containing blogs that always need to be included
		$blogs[]	= $this->blogid;		// also search current blog (duh)
		$blogs		= array_unique($blogs);	// remove duplicates
		$selectblogs = '';
		if ( count($blogs) > 0 )
		{
			$selectblogs = ' and i.iblog in (' . implode(',', $blogs) . ')';
		}
		
		if ( $mode == '' )
		{
			$query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, i.itime, i.imore as more, i.icat as catid, i.iclosed as closed,
				m.mname as author, m.mrealname as authorname, m.mnumber as authorid, m.memail as authormail, m.murl as authorurl,
				c.cname as category';
			
			if ( $select )
			{
				$query .= ', '.$select. ' as score ';
			}
		}
		else
		{
			$query = 'SELECT COUNT(*) as result ';
		}
		
		$query .= ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, '.sql_table('category').' as c'
				. ' WHERE i.iauthor=m.mnumber'
				. ' and i.icat=c.catid'
				// exclude drafts
				. ' and i.idraft=0'
				. $selectblogs
					// don't show future items
				. ' and i.itime<=' . DB::formatDateTime($this->getCorrectTime())
				. ' and '.$where;
		
		// take into account amount of months to search
		if ( $amountMonths > 0 )
		{
			$localtime = getdate($this->getCorrectTime());
			$timestamp_start = mktime(0,0,0,$localtime['mon'] - $amountMonths,1,$localtime['year']);
			$query .= ' and i.itime>' . DB::formatDateTime($timestamp_start);
		}
		
		if ( $mode == '' )
		{
			if ( $select )
			{
				$query .= ' ORDER BY score DESC';
			}
			else
			{
				$query .= ' ORDER BY i.itime DESC ';
			}
		}
		
		return $query;
	}
	
	/**
	 * Blog::getSqlBlog()
	 * Returns the SQL query that's normally used to display the blog items on the index type skins
	 * No LIMIT clause is added. (caller should add this if multiple pages are requested)
	 *
	 * @param	string	$extraQuery	extra query string
	 * @param	string	$mode		either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
	 * @return	string	either a full SQL query, or an empty string
	 */
	public function getSqlBlog($extraQuery, $mode = '')
	{
		if ( $mode == '' )
		{
			$query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, m.mname as author,
				m.mrealname as authorname, i.itime, i.imore as more, m.mnumber as authorid, m.memail as authormail,
				m.murl as authorurl, c.cname as category, i.icat as catid, i.iclosed as closed';
		}
		else
		{
			$query = 'SELECT COUNT(*) as result ';
		}
		
		$query	.= ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, '.sql_table('category').' as c'
				. ' WHERE i.iblog='.$this->blogid
				. ' and i.iauthor=m.mnumber'
				. ' and i.icat=c.catid'
				. ' and i.idraft=0' // exclude drafts
				. ' and i.itime<=' . DB::formatDateTime($this->getCorrectTime()); // don't show future items
		
		if ( $this->selectedcatid )
		{
			$query .= ' and i.icat=' . $this->selectedcatid . ' ';
		}
		
		$query .= $extraQuery;
		
		if ( $mode == '' )
		{
			$query .= ' ORDER BY i.itime DESC';
		}
		return $query;
	}
	
	/**
	 * Blog::showArchiveList()
	 * Shows the archivelist using the given template
	 * 
	 * @param	string	$template	template name
	 * @param	string	$mode	year/month/day
	 * @param	integer	$limit	limit of record count
	 * @return	void
	 */
	public function showArchiveList($template, $mode = 'month', $limit = 0)
	{
		global $CONF, $catid, $manager;
		
		if ( !isset ($linkparams) )
		{
			$linkparams = array();
		}
		
		if ( $catid )
		{
			$linkparams = array('catid' => $catid);
		}
		
		$template =& $manager->getTemplate($template);
		$data['blogid'] = $this->blogid;
		
		if ( !array_key_exists('ARCHIVELIST_HEADER', $template) || !$template['ARCHIVELIST_HEADER'] )
		{
			$tplt = '';
		}
		else
		{
			$tplt = $template['ARCHIVELIST_HEADER'];
		}
		
		echo Template::fill($tplt, $data);
		
		$query = 'SELECT itime, SUBSTRING(itime,1,4) AS Year, SUBSTRING(itime,6,2) AS Month, SUBSTRING(itime,9,2) AS Day'
				. ' FROM '.sql_table('item')
				. ' WHERE iblog=' . $this->blogid
				. ' AND itime <=' . DB::formatDateTime($this->getCorrectTime()) // don't show future items!
				. ' AND idraft=0'; // don't show draft items
		
		if ( $catid )
		{
			$query .= ' and icat=' . intval($catid);
		}
		
		$query .= ' GROUP BY Year';
		if ( $mode == 'month' || $mode == 'day' )
		{
			$query .= ', Month';
		}
		if ( $mode == 'day' )
		{
			$query .= ', Day';
		}
		
		$query .= ' ORDER BY itime DESC';
		
		if ( $limit > 0 )
		{
			$query .= ' LIMIT ' . intval($limit);
		}
		
		$res = DB::getResult($query);
		foreach ( $res as $current )
		{
			/* string time -> unix timestamp */
			$current['itime'] = strtotime($current['itime']);
			
			if ( $mode == 'day' )
			{
				$archivedate = date('Y-m-d',$current['itime']);
				$archive['day'] = date('d',$current['itime']);
				$data['day'] = date('d',$current['itime']);
				$data['month'] = date('m',$current['itime']);
				$archive['month'] = $data['month'];
			}
			elseif ( $mode == 'year' )
			{
				$archivedate = date('Y',$current['itime']);
				$data['day'] = '';
				$data['month'] = '';
				$archive['day'] = '';
				$archive['month'] = '';
			}
			else
			{
				$archivedate = date('Y-m',$current['itime']);
				$data['month'] = date('m',$current['itime']);
				$archive['month'] = $data['month'];
				$data['day'] = '';
				$archive['day'] = '';
			}
			
			$data['year'] = date('Y',$current['itime']);
			$archive['year'] = $data['year'];
			$data['archivelink'] = Link::create_archive_link($this->blogid,$archivedate,$linkparams);
			
			$manager->notify('PreArchiveListItem', array('listitem' => &$data));
			
			$temp = Template::fill($template['ARCHIVELIST_LISTITEM'],$data);
			echo i18n::formatted_datetime($temp, $current['itime']);
			return;
		}
		
		$res->closeCursor();
		
		if ( !array_key_exists('ARCHIVELIST_FOOTER', $template) || !$template['ARCHIVELIST_FOOTER'] )
		{
			$tplt = '';
		}
		else
		{
			$tplt = $template['ARCHIVELIST_FOOTER'];
		}
		
		echo Template::fill($tplt, $data);
		return;
	}
	
	/**
	 * Blog::showCategoryList()
	 * Shows the list of categories using a given template
	 * 
	 * @param	string	$template	Template Name
	 * @return	void
	 */
	public function showCategoryList($template)
	{
		global $CONF, $archive, $archivelist, $manager;
		
		/*
		 * determine arguments next to catids
		 * I guess this can be done in a better way, but it works
		 */
		$linkparams = array();
		if ( $archive )
		{
			$blogurl = Link::create_archive_link($this->blogid, $archive, '');
			$linkparams['blogid'] = $this->blogid;
			$linkparams['archive'] = $archive;
		}
		else if ( $archivelist )
		{
			$blogurl = Link::create_archivelist_link($this->blogid, '');
			$linkparams['archivelist'] = $archivelist;
		}
		else
		{
			$blogurl = Link::create_blogid_link($this->blogid, '');
			$linkparams['blogid'] = $this->blogid;
		}
		
		$template =& $manager->getTemplate($template);
		
		//: Change: Set nocatselected variable
		if ( $this->selectedcatid )
		{
			$nocatselected = 'no';
		}
		else
		{
			$nocatselected = 'yes';
		} 
		
		$args = array(
			'blogid'	=> $this->blogid,
			'blogurl'	=> $blogurl,
			'self'		=> $CONF['Self'],
			'catiscurrent'	=> $nocatselected, // Change: Set catiscurrent template variable for header
			'currentcat'	=> $nocatselected 
		);
		
		/* output header of category list item */
		if ( !array_key_exists('CATLIST_HEADER', $template) || empty($template['CATLIST_HEADER']) )
		{
			echo Template::fill(NULL, $args);
		}
		else
		{
			echo Template::fill($template['CATLIST_HEADER'], $args);
		}
		
		$query = "SELECT catid, cdesc as catdesc, cname as catname FROM %s WHERE cblog=%d ORDER BY cname ASC;";
		$query = sprintf($query, sql_table('category'), (integer) $this->blogid);
		$res = DB::getResult($query);
		
		foreach ( $res as $data )
		{
			$args = array(
				'catid'	=> $data['catid'],
				'name'	=> $data['catname'],
				'extra'	=> $linkparams
			);
			
			$data['blogid']		= $this->blogid;
			$data['blogurl']	= $blogurl;
			$data['catlink']	= Link::create_link('category', $args);
			$data['self']		= $CONF['Self'];
			
			// this gives catiscurrent = no when no category is selected.
			$data['catiscurrent'] = 'no';
			$data['currentcat'] = 'no';
			
			if ( $this->selectedcatid )
			{
				if ( $this->selectedcatid == $data['catid'] )
				{
					$data['catiscurrent']	= 'yes';
					$data['currentcat']		= 'yes';
				}
			}
			else
			{
				global $itemid;
				if ( intval($itemid) && $manager->existsItem(intval($itemid), 0, 0) )
				{
					$iobj	=& $manager->getItem(intval($itemid), 0, 0);
					$cid	= $iobj['catid'];
					
					if ( $cid == $data['catid'] )
					{
						$data['catiscurrent']	= 'yes';
						$data['currentcat']		= 'yes';
					}
				}
			}
			
			$manager->notify('PreCategoryListItem', array('listitem' => &$data));
			
			if ( !array_key_exists('CATLIST_LISTITEM', $template) || empty($template['CATLIST_LISTITEM']))
			{
				echo Template::fill(NULL, $data);
			}
			else
			{
				echo Template::fill($template['CATLIST_LISTITEM'], $data);
			}
		}
		
		$res->closeCursor();
		
		$args = array(
			'blogid'		=> $this->blogid,
			'blogurl'		=> $blogurl,
			'self'			=> $CONF['Self'],
			'catiscurrent'	=> $nocatselected, //: Change: Set catiscurrent template variable for footer
			'currentcat'	=> $nocatselected
		);
		
		if ( !array_key_exists('CATLIST_FOOTER', $template) || empty($template['CATLIST_FOOTER']))
		{
			echo Template::fill(NULL, $args);
		}
		else
		{
			echo Template::fill($template['CATLIST_FOOTER'], $args);
		}
		
		return;
	}
	
	/**
	 * Blog::showBlogList()
	 * Shows a list of all blogs in the system using a given template
	 * ordered by number, name, shortname or description
	 * in ascending or descending order
	 * 
	 * @param	string	$template	tempalte name
	 * @param	string	$bnametype	bname/bshortname
	 * @param	string	$orderby	string for 'ORDER BY' SQL
	 * @param	string	$direction	ASC/DESC
	 * @return	void
	 */
	public function showBlogList($template, $bnametype, $orderby, $direction)
	{
		global $CONF, $manager;
		
		switch ( $orderby )
		{
			case 'number':
				$orderby='bnumber';
				break;
			case 'name':
				$orderby='bname';
				break;
			case 'shortname':
				$orderby='bshortname';
				break;
			case 'description':
				$orderby='bdesc';
				break;
			default:
				$orderby='bnumber';
				break;
		}
		
		$direction=strtolower($direction);
		switch ( $direction )
		{
			case 'asc':
				$direction='ASC';
				break;
			case 'desc':
				$direction='DESC';
				break;
			default:
				$direction='ASC';
				break;
		}
		
		$template =& $manager->getTemplate($template);
		
		if ( array_key_exists('BLOGLIST_HEADER', $template) && !empty($template['BLOGLIST_HEADER']) )
		{
			$vars = array(
				'sitename'	=> $CONF['SiteName'],
				'siteurl'	=> $CONF['IndexURL']
			);
			
			echo Template::fill($template['BLOGLIST_HEADER'], $vars);
		}
		
		if ( array_key_exists('BLOGLIST_LISTITEM', $template) && !empty($template['BLOGLIST_LISTITEM']) )
		{
			$query = 'SELECT bnumber, bname, bshortname, bdesc, burl FROM '.sql_table('blog').' ORDER BY '.$orderby.' '.$direction;
			$res = DB::getResult($query);
			
			foreach ( $res as $data )
			{
				$list = array();
				$list['bloglink'] = Link::create_blogid_link($data['bnumber']);
				$list['blogdesc'] = $data['bdesc'];
				$list['blogurl'] = $data['burl'];
				
				if ( $bnametype == 'shortname' )
				{
					$list['blogname'] = $data['bshortname'];
				}
				else
				{
					/* all other cases */
					$list['blogname'] = $data['bname'];
				}
				
				$manager->notify('PreBlogListItem',array('listitem' => &$list));
				
				echo Template::fill($template['BLOGLIST_LISTITEM'], $list);
			}
			
			$res->closeCursor();
		}
		
		
		if ( array_key_exists('BLOGLIST_FOOTER', $template) && !empty($template['BLOGLIST_FOOTER']) )
		{
			$vars = array(
				'sitename' => $CONF['SiteName'],
				'siteurl' => $CONF['IndexURL']
			);
			echo Template::fill($template['BLOGLIST_FOOTER']);
		}
		return;
	}
	
	/**
	 * Blog::readSettings()
	 * Read the blog settings
	 * 
	 * @param	void
	 * @return	void
	 */
	public function readSettings()
	{
		$query =  'SELECT * FROM %s WHERE bnumber=%d;';
		$query = sprintf($query, sql_table('blog'), (integer) $this->blogid);
		$res = DB::getResult($query);
		
		$this->isValid = ($res->rowCount() > 0);
		if ( $this->isValid )
		{
			$this->settings = $res->fetch(PDO::FETCH_ASSOC);
		}
		return;
	}
	
	/**
	 * Blog::writeSettings()
	 * Write the blog settings
	 */
	public function writeSettings()
	{
		// (can't use floatval since not available prior to PHP 4.2)
		$offset = $this->getTimeOffset();
		if ( !is_float($offset) )
		{
			$offset = (integer) $offset;
		}
		
		$query =  'UPDATE '.sql_table('blog')
			   . ' SET bname=' . DB::quoteValue($this->getName()) . ','
			   . '     bshortname='. DB::quoteValue($this->getShortName()) . ','
			   . '     bcomments='. intval($this->commentsEnabled()) . ','
			   . '     bmaxcomments=' . intval($this->getMaxComments()) . ','
			   . '     btimeoffset=' . $offset . ','
			   . '     bpublic=' . intval($this->isPublic()) . ','
			   . '     breqemail=' . intval($this->emailRequired()) . ','
			   . '     bconvertbreaks=' . intval($this->convertBreaks()) . ','
			   . '     ballowpast=' . intval($this->allowPastPosting()) . ','
			   . '     bnotify=' . DB::quoteValue($this->getNotifyAddress()) . ','
			   . '     bnotifytype=' . intval($this->getNotifyType()) . ','
			   . '     burl=' . DB::quoteValue($this->getURL()) . ','
			   . '     bupdate=' . DB::quoteValue($this->getUpdateFile()) . ','
			   . '     bdesc=' . DB::quoteValue($this->getDescription()) . ','
			   . '     bdefcat=' . intval($this->getDefaultCategory()) . ','
			   . '     bdefskin=' . intval($this->getDefaultSkin()) . ','
			   . '     bincludesearch=' . intval($this->getSearchable())
			   . ' WHERE bnumber=' . intval($this->blogid);
		DB::execute($query);
		return;
	}
	
	/**
	 * Blog::updateUpdatefile()
	 * Update the update file if requested
	 * 
	 * @param	void
	 * @return	void
	 */
	public function updateUpdatefile()
	{
		if ( $this->getUpdateFile() )
		{
			$f_update = fopen($this->getUpdateFile(), 'w');
			fputs($f_update,$this->getCorrectTime());
			fclose($f_update);
		}
		return;
	}
	
	/**
	 * Blog::isValidCategory()
	 * Check if a category with a given catid is valid
	 * 
	 * @param	integer	$catid	ID for category
	 * @return	boolean	exists or not
	 */
	public function isValidCategory($catid)
	{
		$query = 'SELECT * FROM %s WHERE cblog=%d and catid=%d;';
		$query = sprintf($query, sql_table('category'), (integer) $this->blogid, (integer) $catid);
		$res = DB::getResult($query);
		return ($res->rowCount() != 0);
	}
	
	/**
	 * Blog::getCategoryName()
	 * Get the category name for a given catid
	 * 
	 * @param	integer	$catid	ID for category
	 * @return	string	name of category
	 */
	public function getCategoryName($catid)
	{
		$query = 'SELECT cname FROM %s WHERE cblog=%d and catid=%d;';
		$query = sprintf($query, sql_table('category'), (integer) $this->blogid, (integer) $catid);
		$res = DB::getValue($query);
		return $res;
	}
	
	/**
	 * Blog::getCategoryDesc()
	 * Get the category description for a given catid
	 * 
	 * @param $catid
	 * 	category id
	 */
	public function getCategoryDesc($catid)
	{
		$query = 'SELECT cdesc FROM %s WHERE cblog=%d and catid=%d;';
		$query = sprintf($querym, sql_table('category'), (integer) $this->blogid, (integer) $catid);
		$res = DB::getValue();
		return $res;
	}
	
	/**
	 * Blog::getCategoryIdFromName
	 * Get the category id for a given category name
	 * 
	 * @param	string	$name	category name
	 * @return	ID for category
	 */
	public function getCategoryIdFromName($name)
	{
		$query = 'SELECT catid FROM %s WHERE cblog=%d and cname=%s;';
		$query = sprintf($query, sql_table('category'), (integer) $this->blogid, DB::quoteValue($name));
		
		$res = DB::getValue();
		if ( !$res )
		{
			return $this->getDefaultCategory();
		}
		return $res;
	}
	
	/**
	 * Blog::insertJavaScriptInfo()
	 * Insert a javascript that includes information about the settings
	 * of an author:  ConvertBreaks, MediaUrl and AuthorId
	 * 
	 * @param	$authorid	id of the author
	 */
	public function insertJavaScriptInfo($authorid = '')
	{
		global $member, $CONF;
		
		if ( $authorid == '' )
		{
			$authorid = $member->getID();
		}
		
		echo "<script type=\"text/javascript\">\n";
		
		if ( !$this->convertBreaks() )
		{
			echo "setConvertBreaks(false);\n";
		}
		else
		{
			echo "setConvertBreaks(true);\n";
		}
		echo "setMediaUrl('{$CONF['MediaURL']}');\n";
		echo "setAuthorId('{$authorid}');\n";
		echo "</script>\n";
		return;
	}
	
	/**
	 * Blog::setAllowPastPosting()
	 * Set the the setting for allowing to publish postings in the past
	 * 
	 * @param	boolean	$val	new value for ballowpast
	 * @return	void
	 */
	public function setAllowPastPosting($val)
	{
		$this->setSetting('ballowpast', $val);
		return;
	}
	
	/**
	 * Blog::allowPastPosting()
	 * Get the the setting if it is allowed to publish postings in the past
	 * [should be named as getAllowPastPosting()]
	 * 
	 * @param	void
	 * @return	boolean
	 */
	public function allowPastPosting()
	{
		return $this->getSetting('ballowpast');
	}
	
	/**
	 * Blog::getCorrectTime()
	 * 
	 * @param	integer	$t
	 * @return	integer
	 */
	public function getCorrectTime($t=0)
	{
		if ( $t == 0 )
		{
			$t = time();
		}
		return ($t + 3600 * $this->getTimeOffset());
	}
	
	/**
	 * Blog::getName()
	 * 
	 * @param	void
	 * @return	string name of this weblog
	 */
	public function getName()
	{
		return $this->getSetting('bname');
	}
	
	/**
	 * Blog::getShortName()
	 * 
	 * @param	void
	 * @return	string	short name of this weblog
	 */
	public function getShortName()
	{
		return $this->getSetting('bshortname');
	}
	
	/**
	 * Blog::getMaxComments()
	 * 
	 * @param	void
	 * @return	integer	maximum number of comments
	 */
	public function getMaxComments()
	{
		return $this->getSetting('bmaxcomments');
	}
	
	/**
	 * Blog::getNotifyAddress()
	 * 
	 * @param	void
	 * @return	string	mail address for notifying
	 */
	public function getNotifyAddress()
	{
		return $this->getSetting('bnotify');
	}
	
	/**
	 * Blog::getNotifyType()
	 * 
	 * @param	void
	 * @return	integer	notifycation type
	 */
	public function getNotifyType()
	{
		return $this->getSetting('bnotifytype');
	}
	
	/**
	 * Blog::notifyOnComment()
	 * 
	 * @param	void
	 * @return	boolean
	 */
	public function notifyOnComment()
	{
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 3) == 0));
	}
	
	/**
	 * Blog::notifyOnVote()
	 * 
	 * @param	void
	 * @return	boolean
	 */
	public function notifyOnVote()
	{
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 5) == 0));
	}
	
	/**
	 * Blog::notifyOnNewItem()
	 * 
	 * @param	void
	 * @return	boolean
	 */
	public function notifyOnNewItem()
	{
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 7) == 0));
	}
	
	/**
	 * Blog::setNotifyType()
	 * 
	 * @param	integer	$val
	 * @return	void
	 */
	public function setNotifyType($val)
	{
		$this->setSetting('bnotifytype',$val);
		return;
	}
	
	/**
	 * Blog::getTimeOffset()
	 * @param	void
	 * @return	
	 */
	public function getTimeOffset()
	{
		return $this->getSetting('btimeoffset');
	}
	
	/**
	 * Blog::commentsEnabled()
	 * @param	void
	 * @return	integer	enabled or not
	 */
	public function commentsEnabled()
	{
		return $this->getSetting('bcomments');
	}
	
	/**
	 * Blog::getURL()
	 * @param	void
	 * @return	string	URI for this weblog
	 */
	public function getURL()
	{
		return $this->getSetting('burl');
	}
	
	/**
	 * Blog::getDefaultSkin()
	 * @param	void
	 * @return	name of skin as default for this weblog
	 */
	public function getDefaultSkin()
	{
		return $this->getSetting('bdefskin');
	}
	
	/**
	 * Blog::getUpdateFile()
	 * @param	void
	 * @return	string	name of file to be updated when weblog is updated
	 */
	public function getUpdateFile()
	{
		return $this->getSetting('bupdate');
	}
	
	/**
	 * Blog::getDescription()
	 * @param	void
	 * @return	string	description for this weblog
	 */
	public function getDescription()
	{
		return $this->getSetting('bdesc');
	}
	
	/**
	 * Blog::isPublic()
	 * @param	void
	 * @return	integer	publlic or not
	 */
	public function isPublic()
	{
		return $this->getSetting('bpublic');
	}
	
	/**
	 * Blog::emailRequired()
	 * @param	void
	 * @return	integer	email is required when posting comment or not
	 */
	public function emailRequired()
	{
		return $this->getSetting('breqemail');
	}
	
	/**
	 * Blog::getSearchable()
	 * @param	void
	 * @return	integer	searchable or not
	 */
	public function getSearchable()
	{
		return $this->getSetting('bincludesearch');
	}
	
	/**
	 * Blog::getDefaultCategory()
	 * @param	void
	 * @return	ID for category as a default
	 */
	public function getDefaultCategory()
	{
		return $this->getSetting('bdefcat');
	}
	
	/**
	 * Blog::setPublic()
	 * @param	integer	$val	allow comments by non-registered members or not
	 * @return	void
	 */
	public function setPublic($val)
	{
		$this->setSetting('bpublic', $val);
		return;
	}
	
	/**
	 * Blog::setSearchable()
	 * @param	integer	$val	searchable from the other blogs or not
	 * @return	void
	 */
	public function setSearchable($val)
	{
		$this->setSetting('bincludesearch', $val);
		return;
	}
	
	/**
	 * Blog::setDescription
	 * @param	string	$val	description for this weblog
	 * @return	void
	 */
	public function setDescription($val)
	{
		$this->setSetting('bdesc',$val);
		return;
	}
	
	/**
	 * Blog::setUpdateFile()
	 * @param	string	$val	name of file to beupdated when weblog is updated
	 * @return	
	 */
	public function setUpdateFile($val)
	{
		$this->setSetting('bupdate',$val);
		return;
	}
	
	/**
	 * Blog::setDefaultSkin()
	 * @param	integer	$val	ID for default skin to use when displaying this weblog
	 * @return	void
	 */
	public function setDefaultSkin($val)
	{
		$this->setSetting('bdefskin', $val);
		return;
	}
	
	/**
	 * Blog::setURL()
	 * @param	string	$val	URI for this weblog
	 * @return	
	 */
	public function setURL($val)
	{
		$this->setSetting('burl', $val);
		return;
	}
	
	/**
	 * Blog::setName()
	 * @param	string	$val	name of this weblog
	 * @return	void
	 */
	public function setName($val)
	{
		$this->setSetting('bname', $val);
		return;
	}
	
	/**
	 * Blog::setShortName()
	 * @param	string	$val	short name for this weblog
	 * @return	void
	 */
	public function setShortName($val)
	{
		$this->setSetting('bshortname', $val);
		return;
	}
	
	/**
	 * Blog::setCommentsEnabled()
	 * @param	integer	$val	enabling posting comment or not
	 * @return	void
	 */
	public function setCommentsEnabled($val)
	{
		$this->setSetting('bcomments',$val);
		return;
	}
	
	/**
	 * Blog::setMaxComments()
	 * @param	integer	$val	maximum number of comments for this weblog
	 * @return	void
	 */
	public function setMaxComments($val)
	{
		$this->setSetting('bmaxcomments', $val);
		return;
	}
	
	/**
	 * Blog::setNotifyAddress()
	 * @param	string	$val	email to be notified if weblog updated
	 * @return	void
	 */
	public function setNotifyAddress($val)
	{
		$this->setSetting('bnotify', $val);
		return;
	}
	
	/**
	 * Blog::setEmailRequired()
	 * @param	string	requiring comments with email or not from non member
	 * @return	void
	 */
	public function setEmailRequired($val)
	{
		$this->setSetting('breqemail', $val);
		return;
	}
	
	/**
	 * Blog::setTimeOffset()
	 * @param	integer	$val	time offset
	 * @return	void
	 */
	public function setTimeOffset($val)
	{
		// check validity of value
		// 1. replace , by . (common mistake)
		$val = str_replace(',','.',$val);
		
		// 2. cast to float or int
		if ( is_numeric($val) && (i18n::strpos($val, '.5') === (i18n::strlen($val) - 2)) )
		{
			$val = (float) $val;
		}
		else
		{
			$val = (integer) $val;
		}
		
		$this->setSetting('btimeoffset',$val);
		return;
	}
	
	/**
	 * Blog::setDefaultCategory()
	 * @param	integer	$val	ID for default category for this weblog
	 * @return	
	 */
	public function setDefaultCategory($val)
	{
		$this->setSetting('bdefcat',$val);
		return;
	}
	
	/**
	 * Blog::getSetting()
	 * @param	string	$key	key for setting of this weblog
	 * @return	mixed	value for the setting
	 */
	public function getSetting($key)
	{
		return $this->settings[$key];
	}
	
	/**
	 * Blog::setSetting()
	 * @param	string	$key	key for setting of this weblog
	 * @param	mixed	$value	value for the key
	 * @return	
	 */
	public function setSetting($key, $value)
	{
		$this->settings[$key] = $value;
		return;
	}
	
	/**
	 * Blog::addTeamMember()
	 * Tries to add a member to the team. 
	 * Returns false if the member was already on the team
	 * 
	 * @param	integer	$memberid	id for member
	 * @param	boolean	$admin	super-admin or not
	 * @return	boolean	Success/Fail
	 */
	public function addTeamMember($memberid, $admin)
	{
		global $manager;
		
		$memberid = intval($memberid);
		$admin = intval($admin);
		
		// check if member is already a member
		$tmem =& $manager->getMember($memberid);
		
		if ( $tmem->isTeamMember($this->blogid) )
		{
			return 0;
		}
		
		$data = array(
			'blog'		=> &$this,
			'member'	=> &$tmem,
			'admin'		=> &$admin
		);
		$manager->notify('PreAddTeamMember', $data);
		
		// add to team
		$query = "INSERT INTO %s (TMEMBER, TBLOG, TADMIN) VALUES (%d, %d, %d);";
		$query = sprintf($query, sql_table('team'), (integer) $memberid, (integer) $this->blogid, (integer) $admin);
		DB::execute($query);
		
		$data = array(
			'blog'		=> &$this,
			'member'	=> &$tmem,
			'admin'		=>  $admin
		);
		$manager->notify('PostAddTeamMember', $data);
		
		$logMsg = sprintf(_TEAM_ADD_NEWTEAMMEMBER, $tmem->getDisplayName(), $memberid, $this->getName());
		ActionLog::add(INFO, $logMsg);
		
		return 1;
	}
	
	/**
	 * Blog::getID()
	 * @param	void
	 * @return	integer	ID for this weblog
	 */
	public function getID()
	{
		return (integer) $this->blogid;
	}
	
	/**
	 * Checks if a blog with a given shortname exists 
	 * Returns true if there is a blog with the given shortname (static)
	 * 
	 * @param	string	$name		blog shortname
	 * @return	boolean	exists or not
	 */
	public function exists($name)
	{
		$r = DB::getResult('SELECT * FROM '.sql_table('blog').' WHERE bshortname='. DB::quoteValue($name));
		return ($r->rowCount() != 0);
	}
	
	/**
	 * Checks if a blog with a given id exists 
	 * Returns true if there is a blog with the given ID (static)
	 * 
	 * @param	integer	$id	ID for searched weblog
	 * @return	boolean	exists or not
	 */
	public function existsID($id)
	{
		$r = DB::getResult('SELECT * FROM '.sql_table('blog').' WHERE bnumber='.intval($id));
		return ($r->rowCount() != 0);
	}
	
	/**
	 * Blog::setFuturePost()
	 * flag there is a future post pending
	 * 
	 * @param	void
	 * @return	void
	 */
	public function setFuturePost()
	{
		$query =  "UPDATE %s SET bfuturepost='1' WHERE bnumber=%d;";
		$query = sprintf($query, sql_table('blog'), (integer) $this->blogid);
		DB::execute($query);
		return;
	}
	
	/**
	 * Blog::clearFuturePost()
	 * clear there is a future post pending
	 * 
	 * @param	void
	 * @return	void
	 */
	public function clearFuturePost()
	{
		$query =  "UPDATE %s SET bfuturepost='0' WHERE bnumber=%d;";
		$query = sprintf($query, sql_table('blog'), (integer) $this->blogid);
		DB::execute($query);
		return;
	}
	
	/**
	 * Blog::checkJustPosted()
	 * check if we should throw justPosted event 
	 * 
	 * @param	void
	 * @return	void
	 */
	public function checkJustPosted()
	{
		global $manager;
		
		if ( $this->settings['bfuturepost'] == 1 )
		{
			$query = "SELECT * FROM %s WHERE iposted=0 AND iblog=%d AND itime < NOW();";
			$query = sprintf($query, sql_table('item'), (integer) $this->blogid);
			
			$result = DB::getResult($query);
			if ( $result->rowCount() > 0 )
			{
				// This $pinged is allow a plugin to tell other hook to the event that a ping is sent already
				// Note that the plugins's calling order is subject to thri order in the plugin list
				$pinged = FALSE;
				$manager->notify('JustPosted', array('blogid' => $this->blogid, 'pinged' => &$pinged));
				
				// clear all expired future posts
				$query = "UPDATE %s SET iposted='1' WHERE iblog=%d AND itime < NOW();";
				$query = spriintf($query, sql_table('item'), (integer) $this->blogid);
				DB::execute($query);
				
				// check to see any pending future post, clear the flag is none
				$query = "SELECT * FROM %s WHERE iposted=0 AND iblog=%d;";
				$query = sprintf($query, sql_table('item'), (integer) $this->blogid);
				
				$result = DB::getResult($query);
				if ( $result->rowCount() == 0 )
				{
					$this->clearFuturePost();
				}
			}
		}
		return;
	}
	
	/**
	 * Blog::readLogFromList()
	 * Shows the given list of items for this blog
	 *
	 * @param	array	$itemarray	array of item numbers to be displayed
	 * @param	string	$template	string representing the template _NAME_ (!)
	 * @param	string	$highlight	contains a query that should be highlighted
	 * @param	boolean	$comments	1=show comments 0=don't show comments
	 * @param	boolean	$dateheads	1=show dateheads 0=don't show dateheads
	 * @param	boolean	$showDrafts	0=do not show drafts 1=show drafts
	 * @param	boolean	$showFuture	0=do not show future posts 1=show future posts
	 * @return	integer	amount of items shown
	 */
	public function readLogFromList($itemarray, $template, $highlight = '', $comments = 1, $dateheads = 1,$showDrafts = 0, $showFuture = 0)
	{
		$query = $this->getSqlItemList($itemarray,$showDrafts,$showFuture);
		return $this->showUsingQuery($template, $query, $highlight, $comments, $dateheads);
	}
	
	/**
	 * Blog::getSqlItemList()
	 * Returns the SQL query used to fill out templates for a list of items
	 * No LIMIT clause is added. (caller should add this if multiple pages are requested)
	 *
	 * @param	array	$itemarray	an array holding the item numbers of the items to be displayed
	 * @param	integer	$showDrafts	0=do not show drafts 1=show drafts
	 * @param	integer	$showFuture	0=do not show future posts 1=show future posts
	 * @return	string	either a full SQL query, or an empty string
	 */
	public function getSqlItemList($itemarray,$showDrafts = 0,$showFuture = 0)
	{
		if ( !is_array($itemarray) )
		{
			return '';
		}
		
		$showDrafts = intval($showDrafts);
		$showFuture = intval($showFuture);
		$items = array();
		
		foreach ( $itemarray as $value )
		{
			if ( intval($value) )
			{
				$items[] = intval($value);
			}
		}
		if ( !count($items) )
		{
			return '';
		}
		
		$i = count($items);
		$query = '';
		foreach ( $items as $value )
		{
			$query .= '('
					.	'SELECT'
					.	' i.inumber as itemid,'
					.	' i.ititle as title,'
					.	' i.ibody as body,'
					.	' m.mname as author,'
					.	' m.mrealname as authorname,'
					.	' i.itime,'
					.	' i.imore as more,'
					.	' m.mnumber as authorid,'
					.	' m.memail as authormail,'
					.	' m.murl as authorurl,'
					.	' c.cname as category,'
					.	' i.icat as catid,'
					.	' i.iclosed as closed';
			
			$query .= ' FROM '
					. sql_table('item') . ' as i, '
					. sql_table('member') . ' as m, '
					. sql_table('category') . ' as c'
					. ' WHERE'
				    .    ' i.iblog='.$this->blogid
				   . ' and i.iauthor=m.mnumber'
				   . ' and i.icat=c.catid';
			
			// exclude drafts	
			if ( !$showDrafts )
			{
				$query .= ' and i.idraft=0';
			}
			if ( !$showFuture )
			{
				// don't show future items
				$query .= ' and i.itime<=' . DB::formatDateTime($this->getCorrectTime());
			}
			
			$query .= ' and i.inumber='.intval($value);
			$query .= ')';
			$i--;
			if ($i) $query .= ' UNION ';
		}
		
		return $query;
	}
	
	/**
	 * Blog::convertBreaks()
	 * Get the the setting for the line break handling
	 * [should be named as getConvertBreaks()]
	 * 
	 * @deprecated
	 * @param	void
	 * @return	
	 */
	public function convertBreaks()
	{
		return $this->getSetting('bconvertbreaks');
	}
	
	/**
	 * Set the the setting for the line break handling
	 * 
	 * @deprecated
	 * @param	boolean	$val	new value for bconvertbreaks
	 * @return	void
	 */
	public function setConvertBreaks($val)
	{
		$this->setSetting('bconvertbreaks', $val);
		return;
	}
}
