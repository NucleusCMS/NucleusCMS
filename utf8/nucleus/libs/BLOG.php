<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
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
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: BLOG.php,v 1.10 2007-03-13 05:13:29 shizuki Exp $
 * $NucleusJP: BLOG.php,v 1.9 2007/02/17 04:39:29 shizuki Exp $
 */

// temporary: dirt way to separe class ITEMACTIONS from BLOG
require_once $DIR_LIBS . 'ITEMACTIONS.php';

class BLOG {

	// blog id
	var $blogid;

	// ID of currently selected category
	var $selectedcatid;

	// After creating an object of the blog class, contains true if the BLOG object is
	// valid (the blog exists)
	var $isValid;

	// associative array, containing all blogsettings (use the get/set functions instead)
	var $settings;

	/**
	 * Creates a new BLOG object for the given blog
	 *
	 * @param $id blogid
	 */
	function BLOG($id) {
		$this->blogid = intval($id);
		$this->readSettings();

		// try to set catid
		// (the parse functions in SKIN.php will override this, so it's mainly useless)
		global $catid;
		$this->setSelectedCategory($catid);
	}

	/**
	 * Shows the given amount of items for this blog
	 *
	 * @param $template
	 *		String representing the template _NAME_ (!)
	 * @param $amountEntries
	 *		amount of entries to show
	 * @param $startpos
	 *		offset from where items should be shown (e.g. 5 = start at fifth item)
	 * @returns int
	 *		amount of items shown
	 */
	function readLog($template, $amountEntries, $offset = 0, $startpos = 0) {
		return $this->readLogAmount($template,$amountEntries,'','',1,1,$offset, $startpos);
	}

	/**
	 * Shows an archive for a given month
	 *
	 * @param $year
	 *		year
	 * @param $month
	 *		month
	 * @param $template
	 *		String representing the template name to be used
	 */
	function showArchive($templatename, $year, $month, $day=0) {

		// create extra where clause for select query
		if ($day == 0) {
			$timestamp_start = mktime(0,0,0,$month,1,$year);
			$timestamp_end = mktime(0,0,0,$month+1,1,$year);  // also works when $month==12
		} else {
			$timestamp_start = mktime(0,0,0,$month,$day,$year);
			$timestamp_end = mktime(0,0,0,$month,$day+1,$year);
		}
		$extra_query = ' and i.itime>=' . mysqldate($timestamp_start)
					 . ' and i.itime<' . mysqldate($timestamp_end);


		$this->readLogAmount($templatename,0,$extra_query,'',1,1);

	}


	// sets/gets current category (only when category exists)
	function setSelectedCategory($catid) {
		if ($this->isValidCategory($catid) || (intval($catid) == 0))
			$this->selectedcatid = intval($catid);
	}

	function setSelectedCategoryByName($catname) {
		$this->setSelectedCategory($this->getCategoryIdFromName($catname));
	}

	function getSelectedCategory() {
		return $this->selectedcatid;
	}

	/**
	 * Shows the given amount of items for this blog
	 *
	 * @param $template
	 *		String representing the template _NAME_ (!)
	 * @param $amountEntries
	 *		amount of entries to show (0 = no limit)
	 * @param $extraQuery
	 *		extra conditions to be added to the query
	 * @param $highlight
	 *		contains a query that should be highlighted
	 * @param $comments
	 *		1=show comments 0=don't show comments
	 * @param $dateheads
	 *		1=show dateheads 0=don't show dateheads
	 * @param $offset
	 *		offset
	 * @returns int
	 *		amount of items shown
	 */
	function readLogAmount($template, $amountEntries, $extraQuery, $highlight, $comments, $dateheads, $offset = 0, $startpos = 0) {

		$query = $this->getSqlBlog($extraQuery);

		if ($amountEntries > 0) {
				// $offset zou moeten worden:
				// (($startpos / $amountentries) + 1) * $offset ... later testen ...
			   $query .= ' LIMIT ' . intval($startpos + $offset).',' . intval($amountEntries);
		}
		return $this->showUsingQuery($template, $query, $highlight, $comments, $dateheads);
	}

	function showUsingQuery($templateName, $query, $highlight = '', $comments = 0, $dateheads = 1) {
		global $CONF, $manager;

		$lastVisit = cookieVar($CONF['CookiePrefix'] .'lastVisit');
		if ($lastVisit != 0)
			$lastVisit = $this->getCorrectTime($lastVisit);

		// set templatename as global variable (so plugins can access it)
		global $currentTemplateName;
		$currentTemplateName = $templateName;

		$template =& $manager->getTemplate($templateName);

		// create parser object & action handler
		$actions =& new ITEMACTIONS($this);
		$parser =& new PARSER($actions->getDefinedActions(),$actions);
		$actions->setTemplate($template);
		$actions->setHighlight($highlight);
		$actions->setLastVisit($lastVisit);
		$actions->setParser($parser);
		$actions->setShowComments($comments);

		// execute query
		$items = sql_query($query);

		// loop over all items
		while ($item = mysql_fetch_object($items)) {

			$item->timestamp = strtotime($item->itime);	// string timestamp -> unix timestamp

			// action handler needs to know the item we're handling
			$actions->setCurrentItem($item);

			// add date header if needed
			$old_date = 0;
			if ($dateheads) {
				$new_date = date('dFY',$item->timestamp);
				if ($new_date != $old_date) {
					// unless this is the first time, write date footer
					$timestamp = $item->timestamp;
					if ($old_date != 0) {
						$oldTS = strtotime($old_date);
						$manager->notify('PreDateFoot',array('blog' => &$this, 'timestamp' => $oldTS));
						$tmp_footer = strftime($template['DATE_FOOTER'], $oldTS);
						$parser->parse($tmp_footer);
						$manager->notify('PostDateFoot',array('blog' => &$this, 'timestamp' => $oldTS));
					}
					$manager->notify('PreDateHead',array('blog' => &$this, 'timestamp' => $timestamp));
					// note, to use templatvars in the dateheader, the %-characters need to be doubled in
					// order to be preserved by strftime
					$tmp_header = strftime((isset($template['DATE_HEADER']) ? $template['DATE_HEADER'] : null), $timestamp);
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

		$numrows = mysql_num_rows($items);

		// add another date footer if there was at least one item
		if (($numrows > 0) && $dateheads) {
			$manager->notify('PreDateFoot',array('blog' => &$this, 'timestamp' => strtotime($old_date)));
			$parser->parse($template['DATE_FOOTER']);
			$manager->notify('PostDateFoot',array('blog' => &$this, 'timestamp' => strtotime($old_date)));
		}

		mysql_free_result($items);	// free memory

		return $numrows;

	}

	function showOneitem($itemid, $template, $highlight) {
		$extraQuery = ' and inumber=' . intval($itemid);

		return $this->readLogAmount($template, 1, $extraQuery, $highlight, 0, 0);
	}


	/**
	  * Adds an item to this blog
	  */
	function additem($catid, $title, $body, $more, $blogid, $authorid, $timestamp, $closed, $draft) {
		global $manager;

		$blogid 	= intval($blogid);
		$authorid	= intval($authorid);
		$title		= $title;
		$body		= $body;
		$more		= $more;
		$catid		= intval($catid);

		// convert newlines to <br />
		if ($this->convertBreaks()) {
			$body = addBreaks($body);
			$more = addBreaks($more);
		}

		if ($closed != '1')	$closed = '0';
		if ($draft != '0') $draft = '1';

		if (!$this->isValidCategory($catid))
			$catid = $this->getDefaultCategory();

		if ($timestamp > $this->getCorrectTime())
			$isFuture = 1;

		$timestamp = date('Y-m-d H:i:s',$timestamp);

		$manager->notify('PreAddItem',array('title' => &$title, 'body' => &$body, 'more' => &$more, 'blog' => &$this, 'authorid' => &$authorid, 'timestamp' => &$timestamp, 'closed' => &$closed, 'draft' => &$draft, 'catid' => &$catid));

		$title = addslashes($title);
		$body = addslashes($body);
		$more = addslashes($more);

		$query = 'INSERT INTO '.sql_table('item').' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IDRAFT, ICAT) '
			   . "VALUES ('$title', '$body', '$more', $blogid, $authorid, '$timestamp', $closed, $draft, $catid)";
		sql_query($query);
		$itemid = mysql_insert_id();

		$manager->notify('PostAddItem',array('itemid' => $itemid));

		if (!$draft)
			$this->updateUpdateFile();

		// send notification mail
		if (!$draft && !$isFuture && $this->getNotifyAddress() && $this->notifyOnNewItem())
			$this->sendNewItemNotification($itemid, stripslashes($title), stripslashes($body));

		return $itemid;
	}

	function sendNewItemNotification($itemid, $title, $body) {
		global $CONF, $member;

		// create text version of html post
		$ascii = toAscii($body);

		$mailto_msg = _NOTIFY_NI_MSG . " \n";
//		$mailto_msg .= $CONF['IndexURL'] . 'index.php?itemid=' . $itemid . "\n\n";
		$temp = parse_url($CONF['Self']);
		if ($temp['scheme']) {
			$mailto_msg .= createItemLink($itemid) . "\n\n";
		} else {
			$tempurl = $this->getURL();
			if (substr($tempurl, -1) == '/' || substr($tempurl, -4) == '.php') {
				$mailto_msg .= $tempurl . '?itemid=' . $itemid . "\n\n";
			} else {
				$mailto_msg .= $tempurl . '/?itemid=' . $itemid . "\n\n";
			}
		}
		$mailto_msg .= _NOTIFY_TITLE . ' ' . strip_tags($title) . "\n";
		$mailto_msg .= _NOTIFY_CONTENTS . "\n " . $ascii . "\n";
		$mailto_msg .= getMailFooter();

		$mailto_title = $this->getName() . ': ' . _NOTIFY_NI_TITLE;

		$frommail = $member->getNotifyFromMailAddress();

		$notify =& new NOTIFICATION($this->getNotifyAddress());
		$notify->notify($mailto_title, $mailto_msg , $frommail);



	}


	/**
	  * Creates a new category for this blog
	  *
	  * @param $catName
	  *		name of the new category. When empty, a name is generated automatically
	  *		(starting with newcat)
	  * @param $catDescription
	  *		description of the new category. Defaults to 'New Category'
	  *
	  * @returns
	  *		the new category-id in case of success.
	  *		0 on failure
	  */
	function createNewCategory($catName = '', $catDescription = 'New category') {
		global $member, $manager;

		if ($member->blogAdminRights($this->getID())) {
			// generate
			if ($catName == '')
			{
				$catName = 'newcat';
				$i = 1;

				$res = sql_query('SELECT * FROM '.sql_table('category')." WHERE cname='".$catName.$i."' and cblog=".$this->getID());
				while (mysql_num_rows($res) > 0)
				{
					$i++;
					$res = sql_query('SELECT * FROM '.sql_table('category')." WHERE cname='".$catName.$i."' and cblog=".$this->getID());
				}

				$catName = $catName . $i;
			}

			$manager->notify(
				'PreAddCategory',
				array(
					'blog' => &$this,
					'name' => &$catName,
					'description' => $catDescription
				)
			);

			$query = 'INSERT INTO '.sql_table('category').' (cblog, cname, cdesc) VALUES (' . $this->getID() . ", '" . addslashes($catName) . "', '" . addslashes($catDescription) . "')";
			sql_query($query);
			$catid = mysql_insert_id();

			$manager->notify(
				'PostAddCategory',
				array(
					'blog' => &$this,
					'name' => $catName,
					'description' => $catDescription,
					'catid' => $catid
				)
			);

			return $catid;
		} else {
			return 0;
		}

	}


	/**
	 * Searches all months of this blog for the given query
	 *
	 * @param $query
	 *		search query
	 * @param $template
	 *		template to be used (__NAME__ of the template)
	 * @param $amountMonths
	 *		max amount of months to be search (0 = all)
	 * @param $maxresults
	 *		max number of results to show
	 * @param $startpos
	 *		offset
	 * @returns
	 *		amount of hits found
	 */
	function search($query, $template, $amountMonths, $maxresults, $startpos) {
		global $CONF, $manager;

		$highlight 	= '';
		$sqlquery	= $this->getSqlSearch($query, $amountMonths, $highlight);

		if ($sqlquery == '')
		{
			// no query -> show everything
			$extraquery = '';
			$amountfound = $this->readLogAmount($template, $maxresults, $extraQuery, $query, 1, 1);
		} else {

			// add LIMIT to query (to split search results into pages)
			if (intval($maxresults > 0))
				$sqlquery .= ' LIMIT ' . intval($startpos).',' . intval($maxresults);

			// show results
			$amountfound = $this->showUsingQuery($template, $sqlquery, $highlight, 1, 1);

			// when no results were found, show a message
			if ($amountfound == 0)
			{
				$template =& $manager->getTemplate($template);
				$vars = array(
					'query'		=> htmlspecialchars($query),
					'blogid'	=> $this->getID()
				);
				echo TEMPLATE::fill($template['SEARCH_NOTHINGFOUND'],$vars);
			}
		}

		return $amountfound;
	}

	/**
	 * Returns an SQL query to use for a search query
	 *
	 * @param $query
	 *		search query
	 * @param $amountMonths
	 *		amount of months to search back. Default = 0 = unlimited
	 * @param $mode
	 *		either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
	 * @returns $highlight
	 *		words to highlight (out parameter)
	 * @returns
	 *		either a full SQL query, or an empty string (if querystring empty)
	 * @note
	 *		No LIMIT clause is added. (caller should add this if multiple pages are requested)
	 */
	function getSqlSearch($query, $amountMonths = 0, &$highlight, $mode = '')
	{
		$searchclass =& new SEARCH($query);

		$highlight	  = $searchclass->inclusive;

		// if querystring is empty, return empty string
		if ($searchclass->inclusive == '')
			return '';


		$where  = $searchclass->boolean_sql_where('ititle,ibody,imore');
		$select = $searchclass->boolean_sql_select('ititle,ibody,imore');

		// get list of blogs to search
		$blogs 		= $searchclass->blogs; 		// array containing blogs that always need to be included
		$blogs[]	= $this->getID();			// also search current blog (duh)
		$blogs 		= array_unique($blogs);		// remove duplicates
		$selectblogs = '';
		if (count($blogs) > 0)
			$selectblogs = ' and i.iblog in (' . implode(',', $blogs) . ')';

		if ($mode == '')
		{
			$query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, m.mname as author, m.mrealname as authorname, i.itime, i.imore as more, m.mnumber as authorid, m.memail as authormail, m.murl as authorurl, c.cname as category, i.icat as catid, i.iclosed as closed';
			if ($select)
				$query .= ', '.$select. ' as score ';
		} else {
			$query = 'SELECT COUNT(*) as result ';
		}

		$query .= ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, '.sql_table('category').' as c'
			   . ' WHERE i.iauthor=m.mnumber'
			   . ' and i.icat=c.catid'
			   . ' and i.idraft=0'	// exclude drafts
			   . $selectblogs
					// don't show future items
			   . ' and i.itime<=' . mysqldate($this->getCorrectTime())
			   . ' and '.$where;

		// take into account amount of months to search
		if ($amountMonths > 0)
		{
			$localtime = getdate($this->getCorrectTime());
			$timestamp_start = mktime(0,0,0,$localtime['mon'] - $amountMonths,1,$localtime['year']);
			$query .= ' and i.itime>' . mysqldate($timestamp_start);
		}

		if ($mode == '')
		{
			if ($select)
				$query .= ' ORDER BY score DESC';
			else
				$query .= ' ORDER BY i.itime DESC ';
		}

		return $query;
	}

	/**
	 * Returns the SQL query that's normally used to display the blog items on the index type skins
	 *
	 * @param $mode
	 *		either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
	 * @returns
	 *		either a full SQL query, or an empty string
	 * @note
	 *		No LIMIT clause is added. (caller should add this if multiple pages are requested)
	 */
	function getSqlBlog($extraQuery, $mode = '')
	{
		if ($mode == '')
			$query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, m.mname as author, m.mrealname as authorname, i.itime, i.imore as more, m.mnumber as authorid, m.memail as authormail, m.murl as authorurl, c.cname as category, i.icat as catid, i.iclosed as closed';
		else
			$query = 'SELECT COUNT(*) as result ';

		$query .= ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, '.sql_table('category').' as c'
			   . ' WHERE i.iblog='.$this->blogid
			   . ' and i.iauthor=m.mnumber'
			   . ' and i.icat=c.catid'
			   . ' and i.idraft=0'	// exclude drafts
					// don't show future items
			   . ' and i.itime<=' . mysqldate($this->getCorrectTime());

		if ($this->getSelectedCategory())
			$query .= ' and i.icat=' . $this->getSelectedCategory() . ' ';


		$query .= $extraQuery;

		if ($mode == '')
			$query .= ' ORDER BY i.itime DESC';

		return $query;
	}

	/**
	  * Shows the archivelist using the given template
	  */
	function showArchiveList($template, $mode = 'month', $limit = 0) {
		global $CONF, $catid, $manager;

		if ($catid)
			$linkparams = array('catid' => $catid);

		$template =& $manager->getTemplate($template);
		$data['blogid'] = $this->getID();

		echo TEMPLATE::fill($template['ARCHIVELIST_HEADER'],$data);

		$query = 'SELECT itime, SUBSTRING(itime,1,4) AS Year, SUBSTRING(itime,6,2) AS Month, SUBSTRING(itime,9,2) as Day FROM '.sql_table('item')
		. ' WHERE iblog=' . $this->getID()
		. ' and itime <=' . mysqldate($this->getCorrectTime())	// don't show future items!
		. ' and idraft=0'; // don't show draft items

		if ($catid)
			$query .= ' and icat=' . intval($catid);

		$query .= ' GROUP BY Year, Month';
		if ($mode == 'day')
			$query .= ', Day';


		$query .= ' ORDER BY itime DESC';

		if ($limit > 0)
			$query .= ' LIMIT ' . intval($limit);

		$res = sql_query($query);

		while ($current = mysql_fetch_object($res)) {
			$current->itime = strtotime($current->itime);	// string time -> unix timestamp

			if ($mode == 'day') {
				$archivedate = date('Y-m-d',$current->itime);
				$archive['day'] = date('d',$current->itime);
			} else {
				$archivedate = date('Y-m',$current->itime);
			}
			$data['month'] = date('m',$current->itime);
			$data['year'] = date('Y',$current->itime);
			$data['archivelink'] = createArchiveLink($this->getID(),$archivedate,$linkparams);

			$temp = TEMPLATE::fill($template['ARCHIVELIST_LISTITEM'],$data);
			echo strftime($temp,$current->itime);

		}

		mysql_free_result($res);

		echo TEMPLATE::fill($template['ARCHIVELIST_FOOTER'],$data);
	}


	/**
	  * Shows the list of categories using a given template
	  */
	function showCategoryList($template) {
		global $CONF, $manager;

		// determine arguments next to catids
		// I guess this can be done in a better way, but it works
		global $archive, $archivelist;

		$linkparams = array();
		if ($archive) {
			$blogurl = createArchiveLink($this->getID(), $archive, '');
			$linkparams['blogid'] = $this->getID();
			$linkparams['archive'] = $archive;
		} else if ($archivelist) {
			$blogurl = createArchiveListLink($this->getID(), '');
			$linkparams['archivelist'] = $archivelist;
		} else {
			$blogurl = createBlogidLink($this->getID(), '');
			$linkparams['blogid'] = $this->getID();
		}

		//$blogurl = $this->getURL() . $qargs;
		//$blogurl = createBlogLink($this->getURL(), $linkparams);

		$template =& $manager->getTemplate($template);

		echo TEMPLATE::fill((isset($template['CATLIST_HEADER']) ? $template['CATLIST_HEADER'] : null),
							array(
								'blogid' => $this->getID(),
								'blogurl' => $blogurl,
								'self' => $CONF['Self']
							));

		$query = 'SELECT catid, cdesc as catdesc, cname as catname FROM '.sql_table('category').' WHERE cblog=' . $this->getID() . ' ORDER BY cname ASC';
		$res = sql_query($query);


		while ($data = mysql_fetch_assoc($res)) {
			$data['blogid'] = $this->getID();
			$data['blogurl'] = $blogurl;
			$data['catlink'] = createLink(
								'category',
								array(
									'catid' => $data['catid'],
									'name' => $data['catname'],
									'extra' => $linkparams
								)
							   );
			$data['self'] = $CONF['Self'];

			echo TEMPLATE::fill((isset($template['CATLIST_LISTITEM']) ? $template['CATLIST_LISTITEM'] : null), $data);
			//$temp = TEMPLATE::fill((isset($template['CATLIST_LISTITEM']) ? $template['CATLIST_LISTITEM'] : null), $data);
			//echo strftime($temp, $current->itime);

		}

		mysql_free_result($res);

		echo TEMPLATE::fill((isset($template['CATLIST_FOOTER']) ? $template['CATLIST_FOOTER'] : null),
							array(
								'blogid' => $this->getID(),
								'blogurl' => $blogurl,
								'self' => $CONF['Self']
							));
	}
	
	/**
	  * Shows a list of all blogs in the system using a given template
	  */
	function showBlogList($template, $bnametype) {
		global $CONF, $manager;
		
		$template =& $manager->getTemplate($template);
		
		echo TEMPLATE::fill((isset($template['BLOGLIST_HEADER']) ? $template['BLOGLIST_HEADER'] : null),
							array(
								'sitename' => $CONF['SiteName'],
								'siteurl' => $CONF['IndexURL']
							));
		
		$query = 'SELECT bnumber, bname, bshortname, bdesc, burl FROM '.sql_table('blog').' ORDER BY bnumber ASC';
		$res = sql_query($query);
		
		while ($data = mysql_fetch_assoc($res)) {
		
			$list = array();
		
			$list['bloglink'] = createLink('blog', array('blogid' => $data['bnumber']));
		
			$list['blogdesc'] = $data['bdesc'];
			
			if ($bnametype=='shortname') {
				$list['blogname'] = $data['bshortname'];
			}
			else { // all other cases
				$list['blogname'] = $data['bname'];
			}
			
			echo TEMPLATE::fill((isset($template['BLOGLIST_LISTITEM']) ? $template['BLOGLIST_LISTITEM'] : null), $list);
			
		}
		
		mysql_free_result($res);
		
		echo TEMPLATE::fill((isset($template['BLOGLIST_FOOTER']) ? $template['BLOGLIST_FOOTER'] : null),
							array(
								'sitename' => $CONF['SiteName'],
								'siteurl' => $CONF['IndexURL']
							));

	}

	/**
	  * Blogsettings functions
	  */

	function readSettings() {
		$query =  'SELECT *'
			   . ' FROM '.sql_table('blog')
			   . ' WHERE bnumber=' . $this->blogid;
		$res = sql_query($query);

		$this->isValid = (mysql_num_rows($res) > 0);
		if (!$this->isValid)
			return;

		$this->settings = mysql_fetch_assoc($res);
	}

	function writeSettings() {

		// (can't use floatval since not available prior to PHP 4.2)
		$offset = $this->getTimeOffset();
		if (!is_float($offset))
			$offset = intval($offset);

		$query =  'UPDATE '.sql_table('blog')
			   . " SET bname='" . addslashes($this->getName()) . "',"
			   . "     bshortname='". addslashes($this->getShortName()) . "',"
			   . "     bcomments=". intval($this->commentsEnabled()) . ","
			   . "     bmaxcomments=" . intval($this->getMaxComments()) . ","
			   . "     btimeoffset=" . $offset . ","
			   . "     bpublic=" . intval($this->isPublic()) . ","
			   . "     breqemail=" . intval($this->emailRequired()) . ","
			   . "     bsendping=" . intval($this->pingUserland()) . ","
			   . "     bconvertbreaks=" . intval($this->convertBreaks()) . ","
			   . "     ballowpast=" . intval($this->allowPastPosting()) . ","
			   . "     bnotify='" . addslashes($this->getNotifyAddress()) . "',"
			   . "     bnotifytype=" . intval($this->getNotifyType()) . ","
			   . "     burl='" . addslashes($this->getURL()) . "',"
			   . "     bupdate='" . addslashes($this->getUpdateFile()) . "',"
			   . "     bdesc='" . addslashes($this->getDescription()) . "',"
			   . "     bdefcat=" . intval($this->getDefaultCategory()) . ","
			   . "     bdefskin=" . intval($this->getDefaultSkin()) . ","
			   . "     bincludesearch=" . intval($this->getSearchable())
			   . " WHERE bnumber=" . intval($this->getID());
		sql_query($query);

	}



	// update update file if requested
	function updateUpdatefile() {
		 if ($this->getUpdateFile()) {
			$f_update = fopen($this->getUpdateFile(),'w');
			fputs($f_update,$this->getCorrectTime());
			fclose($f_update);
		 }

	}

	/**
	  * Sends a XML-RPC ping message to Userland, so the weblog can
	  * show up in the weblogs.com updates-list
	  */
	function sendUserlandPing() {
		global $php_errormsg;

		 if ($this->pingUserland()) {
			  // testmessage for adding an item
			  $message = new xmlrpcmsg('weblogUpdates.ping',array(
					new xmlrpcval($this->getName(),'string'),
					new xmlrpcval($this->getURL(),'string')
			  ));

			  $c = new xmlrpc_client('/RPC2', 'rpc.weblogs.com', 80);

			  // $c->setDebug(1);

			  $r = $c->send($message,15); // 15 seconds timeout...

			  if (($r == 0) && ($r->errno || $r->errstring)) {
				return 'Error ' . $r->errno . ' : ' . $r->errstring;
			  } elseif (($r == 0) && ($php_errormsg)) {
				return 'PHP Error: ' . $php_errormsg;
			  } elseif ($r == 0) {
				return 'Error while trying to send ping. Sorry about that.';
			  } elseif ($r->faultCode() != 0) {
				return 'Error: ' . $r->faultString();
			  } else {
				  $r = $r->value();	// get response struct
				  // get values
				  $flerror = $r->structmem('flerror');
				  $flerror = $flerror->scalarval();


				  $message = $r->structmem('message');
				  $message = $message->scalarval();

				  if ($flerror != 0)
					return 'Error (flerror=1): ' . $message;
				  else
					return 'Success: ' . $message;
			  }
		 }
	}

	function isValidCategory($catid) {
		$query = 'SELECT * FROM '.sql_table('category').' WHERE cblog=' . $this->getID() . ' and catid=' . intval($catid);
		$res = mysql_query($query);
		return (mysql_num_rows($res) != 0);
	}

	function getCategoryName($catid) {
		$res = mysql_query('SELECT cname FROM '.sql_table('category').' WHERE cblog='.$this->getID().' and catid=' . intval($catid));
		$o = mysql_fetch_object($res);
		return $o->cname;
	}

	function getCategoryDesc($catid) {
		$res = mysql_query('SELECT cdesc FROM '.sql_table('category').' WHERE cblog='.$this->getID().' and catid=' . intval($catid));
		$o = mysql_fetch_object($res);
		return $o->cdesc;
	}

	function getCategoryIdFromName($name) {
		$res = mysql_query('SELECT catid FROM '.sql_table('category').' WHERE cblog='.$this->getID().' and cname="' . addslashes($name) . '"');
		if (mysql_num_rows($res) > 0) {
			$o = mysql_fetch_object($res);
			return $o->catid;
		} else {
			return $this->getDefaultCategory();
		}
	}

	function pingUserland() {
		return $this->getSetting('bsendping');
	}

	function setPingUserland($val) {
		$this->setSetting('bsendping',$val);
	}

	function convertBreaks() {
		return $this->getSetting('bconvertbreaks');
	}

	function insertJavaScriptInfo($authorid = '') {
		global $member, $CONF;

		if ($authorid == '')
			$authorid = $member->getID();

		?>
		<script type="text/javascript">
			setConvertBreaks(<?php echo  $this->convertBreaks() ? 'true' : 'false' ?>);
			setMediaUrl("<?php echo $CONF['MediaURL']?>");
			setAuthorId(<?php echo $authorid?>);
		</script><?php	}

	function setConvertBreaks($val) {
		$this->setSetting('bconvertbreaks',$val);
	}
	function setAllowPastPosting($val) {
		$this->setSetting('ballowpast',$val);
	}
	function allowPastPosting() {
		return $this->getSetting('ballowpast');
	}

	function getCorrectTime($t=0) {
		if ($t == 0) $t = time();
		return ($t + 3600 * $this->getTimeOffset());
	}

	function getName() {
		return $this->getSetting('bname');
	}

	function getShortName() {
		return $this->getSetting('bshortname');
	}

	function getMaxComments() {
		return $this->getSetting('bmaxcomments');
	}

	function getNotifyAddress() {
		return $this->getSetting('bnotify');
	}

	function getNotifyType() {
		return $this->getSetting('bnotifytype');
	}

	function notifyOnComment() {
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 3) == 0));
	}

	function notifyOnVote() {
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 5) == 0));
	}

	function notifyOnNewItem() {
		$n = $this->getNotifyType();
		return (($n != 0) && (($n % 7) == 0));
	}

	function setNotifyType($val) {
		$this->setSetting('bnotifytype',$val);
	}


	function getTimeOffset() {
		return $this->getSetting('btimeoffset');
	}

	function commentsEnabled() {
		return $this->getSetting('bcomments');
	}

	function getURL() {
		return $this->getSetting('burl');
	}

	function getDefaultSkin() {
		return $this->getSetting('bdefskin');
	}

	function getUpdateFile() {
		return $this->getSetting('bupdate');
	}

	function getDescription() {
		return $this->getSetting('bdesc');
	}

	function isPublic() {
		return $this->getSetting('bpublic');
	}

	function emailRequired() {
		return $this->getSetting('breqemail');
	}

	function getSearchable() {
		return $this->getSetting('bincludesearch');
	}

	function getDefaultCategory() {
		return $this->getSetting('bdefcat');
	}

	function setPublic($val) {
		$this->setSetting('bpublic',$val);
	}

	function setSearchable($val) {
		$this->setSetting('bincludesearch',$val);
	}

	function setDescription($val) {
		$this->setSetting('bdesc',$val);
	}

	function setUpdateFile($val) {
		$this->setSetting('bupdate',$val);
	}

	function setDefaultSkin($val) {
		$this->setSetting('bdefskin',$val);
	}

	function setURL($val) {
		$this->setSetting('burl',$val);
	}

	function setName($val) {
		$this->setSetting('bname',$val);
	}

	function setShortName($val) {
		$this->setSetting('bshortname',$val);
	}

	function setCommentsEnabled($val) {
		$this->setSetting('bcomments',$val);
	}

	function setMaxComments($val) {
		$this->setSetting('bmaxcomments',$val);
	}

	function setNotifyAddress($val) {
		$this->setSetting('bnotify',$val);
	}

	function setEmailRequired($val) {
		$this->setSetting('breqemail',$val);
	}

	function setTimeOffset($val) {
		// check validity of value
		// 1. replace , by . (common mistake)
		$val = str_replace(',','.',$val);
		// 2. cast to float or int
		if (is_numeric($val) && strstr($val,'.5')) {
			$val = (float) $val;
		} else {
			$val = intval($val);
		}

		$this->setSetting('btimeoffset',$val);
	}

	function setDefaultCategory($val) {
		$this->setSetting('bdefcat',$val);
	}

	function getSetting($key) {
		return $this->settings[$key];
	}

	function setSetting($key,$value) {
		$this->settings[$key] = $value;
	}


	// tries to add a member to the team. Returns false if the member was already on
	// the team
	function addTeamMember($memberid, $admin) {
		global $manager;

		$memberid = intval($memberid);
		$admin = intval($admin);

		// check if member is already a member
		$tmem = MEMBER::createFromID($memberid);

		if ($tmem->isTeamMember($this->getID()))
			return 0;

		$manager->notify(
			'PreAddTeamMember',
			array(
				'blog' => &$this,
				'member' => &$tmem,
				'admin' => &$admin
			)
		);

		// add to team
		$query = 'INSERT INTO '.sql_table('team').' (TMEMBER, TBLOG, TADMIN) '
			   . 'VALUES (' . $memberid .', '.$this->getID().', "'.$admin.'")';
		sql_query($query);

		$manager->notify(
			'PostAddTeamMember',
			array(
				'blog' => &$this,
				'member' => &$tmem,
				'admin' => $admin
			)

		);

		ACTIONLOG::add(INFO, 'Added ' . $tmem->getDisplayName() . ' (ID=' .
					   $memberid .') to the team of blog "' . $this->getName() . '"');

		return 1;
	}

	function getID() {
		return intVal($this->blogid);
	}

	// returns true if there is a blog with the given shortname (static)
	function exists($name) {
		$r = sql_query('select * FROM '.sql_table('blog').' WHERE bshortname="'.addslashes($name).'"');
		return (mysql_num_rows($r) != 0);
	}

	// returns true if there is a blog with the given ID (static)
	function existsID($id) {
		$r = sql_query('select * FROM '.sql_table('blog').' WHERE bnumber='.intval($id));
		return (mysql_num_rows($r) != 0);
	}


}

?>