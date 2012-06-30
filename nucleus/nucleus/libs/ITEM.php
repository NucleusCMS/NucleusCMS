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
 * A class representing an item
 *
 */
class Item
{
	/**
	 * Item::$actiontypes
	 * actiontype list for handling items
	 * 
	 * @static
	 */
	static private $actiontypes = array(
		'addnow', 'adddraft', 'addfuture', 'edit',
		'changedate', 'backtodrafts', 'delete'
	);
	
	/**
	 * Item::$itemid
	 * item id
	 * @deprecated
	 */
	public $itemid;
	
	/**
	 * Item::__construct()
	 * Creates a new ITEM object
	 * 
	 * @deprecated
	 * @param integer	$item_id	id for item
	 * @return void
	 */
	public function __construct($item_id)
	{
		$this->itemid = $item_id;
		return;
	}
	
	/**
	 * Item::getitem()
	 * Returns one item with the specific itemid
	 * 
	 * @static
	 * @param int $item_id
	 * @param bool $allow_draft
	 * @param bool $allow_future
	 * @return mixed
	 */
	static public function getitem($item_id, $allow_draft, $allow_future)
	{
		global $manager;
		
		$item_id = (integer) $item_id;
		
		$query = 'SELECT ' .
			'i.idraft AS draft, ' .
			'i.inumber AS itemid, ' .
			'i.iclosed AS closed, ' .
			'i.ititle AS title, ' .
			'i.ibody AS body, ' .
			'm.mname AS author, ' .
			'i.iauthor AS authorid, ' .
			'i.itime, ' .
			'i.imore AS more, ' .
			'i.ikarmapos AS karmapos, ' .
			'i.ikarmaneg AS karmaneg, ' .
			'i.icat AS catid, ' .
			'i.iblog AS blogid ' .
			'FROM %s AS i, %s AS m, %s AS b ' .
			'WHERE i.inumber = %d ' .
			'AND i.iauthor = m.mnumber ' .
			'AND i.iblog = b.bnumber ';
		
		$query = sprintf($query, sql_table('item'), sql_table('member'), sql_table('blog'), $item_id);
		
		if ( !$allow_draft )
		{
			$query .= "AND i.idraft = 0 ";
		}
		
		if ( !$allow_future )
		{
			$blog =& $manager->getBlog(getBlogIDFromItemID($item_id));
			$query .= 'AND i.itime <= ' . DB::formatDateTime($blog->getCorrectTime());
		}
		
		$query .= ' LIMIT 1';
		$result = DB::getResult($query);
		
		if ( $result->rowCount() != 1 )
		{
			return 0;
		}
		
		$aItemInfo = $result->fetch(PDO::FETCH_ASSOC);
		$aItemInfo['timestamp'] = strtotime($aItemInfo['itime']);
		return $aItemInfo;
	}
	
	/**
	 * Item::createFromRequest()
	 * Tries to create an item from the data in the current request (comes from
	 * bookmarklet or admin area
	 *
	 * @static
	 * @param	void
	 * @return	array	(status = added/error/newcategory, message)
	 * 
	 */
	static public function createFromRequest()
	{
		global $member, $manager;
		
		/*
		 * TODO: these values from user agent should be validated but not implemented yet
		 */
		$i_author		= $member->getID();
		$i_body			= postVar('body');
		$i_title		= postVar('title');
		$i_more			= postVar('more');
		$i_actiontype	= postVar('actiontype');
		$i_closed		= intPostVar('closed');
		$i_hour			= intPostVar('hour');
		$i_minutes		= intPostVar('minutes');
		$i_month		= intPostVar('month');
		$i_day			= intPostVar('day');
		$i_year			= intPostVar('year');
		$i_catid		= postVar('catid');
		$i_draftid		= intPostVar('draftid');
		
		if ( !$member->canAddItem($i_catid) )
		{
			return array('status' => 'error', 'message' => _ERROR_DISALLOWED);
		}
		
		if ( !in_array($i_actiontype, self::$actiontypes) )
		{
			$i_actiontype = 'addnow';
		}
		
		$i_draft = (integer) ( $i_actiontype == 'adddraft' );
		
		if ( !trim($i_body) )
		{
			return array('status' => 'error', 'message' => _ERROR_NOEMPTYITEMS);
		}
		
		// create new category if needed
		if ( i18n::strpos($i_catid, 'newcat') === 0 )
		{
			// get blogid
			list($i_blogid) = sscanf($i_catid, "newcat-%d");
			
			// create
			$blog =& $manager->getBlog($i_blogid);
			$i_catid = $blog->createNewCategory();
			
			// show error when sth goes wrong
			if ( !$i_catid )
			{
				return array('status' => 'error','message' => 'Could not create new category');
			}
		}
		else
		{
			// force blogid (must be same as category id)
			$i_blogid = getBlogIDFromCatID($i_catid);
			$blog =& $manager->getBlog($i_blogid);
		}
		
		if ( $i_actiontype == 'addfuture' )
		{
			$posttime = mktime($i_hour, $i_minutes, 0, $i_month, $i_day, $i_year);
			
			// make sure the date is in the future, unless we allow past dates
			if ( (!$blog->allowPastPosting()) && ($posttime < $blog->getCorrectTime()) )
			{
				$posttime = $blog->getCorrectTime();
			}
		}
		else
		{
			if ( !$i_draft )
			{
				$posttime = $blog->getCorrectTime();
			}
			else
			{
				$posttime = 0;
			}
		}
		
		if ( $posttime > $blog->getCorrectTime() )
		{
			$posted = 0;
			$blog->setFuturePost();
		}
		else
		{
			$posted = 1;
		}
		
		$itemid = $blog->additem($i_catid, $i_title, $i_body, $i_more, $i_blogid, $i_author, $posttime, $i_closed, $i_draft, $posted);
		
		//Setting the itemOptions
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions, $itemid);
		$data = array(
			'context'	=> 'item',
			'itemid'	=> $itemid,
			'item'		=> array(
				'title'		=> $i_title,
				'body'		=> $i_body,
				'more'		=> $i_more,
				'closed'	=> $i_closed,
				'catid'		=> $i_catid
			)
		);
		
		$manager->notify('PostPluginOptionsUpdate', $data);
		
		if ( $i_draftid > 0 )
		{
			// delete permission is checked inside Item::delete()
			self::delete($i_draftid);
		}
		
		// success
		if ( $i_catid != intRequestVar('catid') )
		{
			return array('status' => 'newcategory', 'itemid' => $itemid, 'catid' => $i_catid);
		}
		
		return array('status' => 'added', 'itemid' => $itemid);
	}
	
	/**
	 * Item::update()
	 * Updates an item
	 *
	 * @static
	 * @param	integer	$itemid	item id
	 * @param	integer	$catid	category id
	 * @param	string	$title	title
	 * @param	string	$body	body text
	 * @param	string	$more	more text
	 * @param	boolean	$closed	closed or not
	 * @param	boolean	$wasdraft	previously draft or not
	 * @param	boolean	$publish	published or not
	 * @param	timestamp	$timestamp	timestamp
	 * @return	void
	 */
	static public function update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp = 0)
	{
		global $manager;
		
		$itemid = (integer) $itemid;
		$closed = (boolean) $closed;
		
		// get destination blogid
		$new_blogid = getBlogIDFromCatID($catid);
		$old_blogid = getBlogIDFromItemID($itemid);
		
		// move will be done on end of method
		$moveNeeded = 0;
		if ( $new_blogid != $old_blogid )
		{
			$moveNeeded = 1;
		}
		
		$blog =& $manager->getBlog($new_blogid);
		
		// begin if: convert line breaks to <br/>
		if ( $blog->convertBreaks() )
		{
			$body = addBreaks($body);
			$more = addBreaks($more);
		}
		
		// call plugins
		$data = array(
			'itemid'	=> $itemid,
			'title'		=> &$title,
			'body'		=> &$body,
			'more'		=> &$more,
			'blog'		=> &$blog,
			'closed'	=> &$closed,
			'catid'		=> &$catid
		);
		$manager->notify('PreUpdateItem', $data);
		
		// update item itself
		$query =  'UPDATE ' . sql_table('item')
				. ' SET'
				. ' ibody = ' . DB::quoteValue($body) . ','
				. ' ititle = ' . DB::quoteValue($title) . ','
				. ' imore = ' . DB::quoteValue($more) . ','
				. ' iclosed = ' . intval($closed) . ','
				. ' icat = ' . intval($catid);
		
		// if we received an updated timestamp that is in the past, but past posting is not allowed,
		// reject that date change (timestamp = 0 will make sure the current date is kept)
		if ( (!$blog->allowPastPosting()) && ($timestamp < $blog->getCorrectTime()) )
		{
			$timestamp = 0;
		}
		
		// begin if: post is in the future
		if ( $timestamp > $blog->getCorrectTime(time()) )
		{
			$isFuture = 1;
			$query .= ', iposted = 0';
		}
		else
		{
			$isFuture = 0;
			$query .= ', iposted = 1';
		}
		
		if ( $wasdraft && $publish )
		{
			// set timestamp to current date only if it's not a future item
			// draft items have timestamp == 0
			// don't allow timestamps in the past (unless otherwise defined in blogsettings)
			$query .= ', idraft = 0';
			
			if ( $timestamp == 0 )
			{
				$timestamp = $blog->getCorrectTime();
			}
			
			// send new item notification
			if ( !$isFuture && $blog->getNotifyAddress() && $blog->notifyOnNewItem() )
			{
				$blog->sendNewItemNotification($itemid, $title, $body);
			}
		}
		
		// save back to drafts
		if ( !$wasdraft && !$publish )
		{
			$query .= ', idraft = 1';
			// set timestamp back to zero for a draft
			$query .= ', itime = ' . DB::formatDateTime($timestamp);
		}
		
		// update timestamp when needed
		if ( $timestamp != 0 )
		{
			$query .= ', itime = ' . DB::formatDateTime($timestamp);
		}
		
		// make sure the correct item is updated
		$query .= ' WHERE inumber = ' . $itemid;
		
		// off we go!
		DB::execute($query);

		$data = array('itemid' => $itemid);
		$manager->notify('PostUpdateItem', $data);
		
		// when needed, move item and comments to new blog
		if ( $moveNeeded )
		{
			self::move($itemid, $catid);
		}
		
		//update the itemOptions
		$aOptions = requestArray('plugoption');
		NucleusPlugin::apply_plugin_options($aOptions);
		$data = array(
			'context'	=> 'item',
			'itemid'	=> $itemid,
			'item'		=> array(
				'title'		=> $title,
				'body'		=> $body,
				'more'		=> $more,
				'closed'	=> $closed,
				'catid'		=> $catid
			)
		);
		$manager->notify('PostPluginOptionsUpdate', $data);
		return;
	}
	
	/**
	 * Item::move()
	 * Move an item to another blog (no checks)
	 *
	 * @static
	 * @param	integer	$itemid
	 * @param	integer	$new_catid
	 * @return	void
	 */
	static public function move($itemid, $new_catid)
	{
		global $manager;
		
		$itemid		= (integer) $itemid;
		$new_catid	= (integer) $new_catid;
		$new_blogid	= getBlogIDFromCatID($new_catid);
		
		$data = array(
			'itemid'		=> $itemid,
			'destblogid'	=> $new_blogid,
			'destcatid'		=> $new_catid
		);
		$manager->notify('PreMoveItem', $data);
		
		// update item table
		$query = "UPDATE %s SET iblog=%d, icat=%d WHERE inumber=%d";
		$query = sprintf($query, sql_table('item'), $new_blogid, $new_catid, $itemid);
		DB::execute($query);
		
		// update comments
		$query = "UPDATE %s SET cblog=%d WHERE citem=%d";
		$query = sprintf($query, sql_table('comment'), $new_blogid, $itemid);
		DB::execute($query);
		
		$data = array(
			'itemid'		=> $itemid,
			'destblogid'	=> $new_blogid,
			'destcatid'		=> $new_catid
		);
		$manager->notify('PostMoveItem', $data);
		return;
	}
	
	/**
	 * Item::delete()
	 * Deletes an item
	 * 
	 * @param	integer	$itemid
	 * @return	void
	 */
	static public function delete($itemid)
	{
		global $manager, $member;
		
		$itemid = (integer) $itemid;
		
		// check permission
		if ( !$member->canAlterItem($itemid) )
		{
			return 1;
		}

		$data = array('itemid' => $itemid);
		$manager->notify('PreDeleteItem', $data);
		
		// delete item
		$query = "DELETE FROM %s WHERE inumber=%d;";
		$query = sprintf($query, sql_table('item'), $itemid);
		DB::execute($query);
		
		// delete the comments associated with the item
		$query = "DELETE FROM %s WHERE citem=%d;";
		$query = sprintf($query, sql_table('comment'), $itemid);
		DB::execute($query);
		
		// delete all associated plugin options
		NucleusPlugin::delete_option_values('item', $itemid);
		
		$manager->notify('PostDeleteItem', $data);
		
		return 0;
	}
	
	/**
	 * Item::exists()
	 * Returns true if there is an item with the given ID
	 *
	 * @static
	 * @param	integer	$itemid
	 * @param	boolean	$future
	 * @param	boolean	$draft
	 * @return	boolean	exists or not
	 */
	static public function exists($itemid, $future, $draft)
	{
		global $manager;
		
		$itemid = (integer) $itemid;
		
		$query = 'SELECT * FROM %s WHERE inumber=%d';
		$query = sprintf($query, sql_table('item'), $itemid);
		
		if ( !$future )
		{
			$blogid = getBlogIDFromItemID($itemid);
			if ( !$blogid )
			{
				return 0;
			}
			$blog =& $manager->getBlog($blogid);
			$query .= ' AND itime<=' . DB::formatDateTime($blog->getCorrectTime());
		}
		
		if ( !$draft )
		{
			$query .= ' AND idraft=0';
		}
		
		$result = DB::getResult($query);
		return ( $result->rowCount() != 0 );
	}
	
	/**
	 * Item::createDraftFromRequest()
	 * Tries to create an draft from the data
	 *  in the current request (comes from bookmarklet or admin area)
	 *   Used by xmlHTTPRequest AutoDraft
	 *
	 * Returns an array with status info:
	 * status = 'added', 'error', 'newcategory'
	 *
	 * @static
	 * @param	void
	 * @return	array	(status = added/error/newcategory, message)
	 */
	static public function createDraftFromRequest()
	{
		global $member, $manager;
		
		/*
		 * TODO: these values from user agent should be validated but not implemented yet
		 */
		$i_author	= $member->getID();
		$i_body		= postVar('body');
		$i_title	= postVar('title');
		$i_more		= postVar('more');
		$i_closed	= intPostVar('closed');
		$i_catid	= postVar('catid');
		$i_draft	= 1;
		$type		= postVar('type');
		$i_draftid	= intPostVar('draftid');
		
		if ( $type == 'edit' )
		{
			$itemid = intPostVar('itemid');
			$i_blogid = getBlogIDFromItemID($itemid);
		}
		else
		{
			$i_blogid = intPostVar('blogid');
		}
		
		if ( !$member->canAddItem($i_catid) )
		{
			return array('status' => 'error', 'message' => _ERROR_DISALLOWED);
		}
		
		if ( !trim($i_body) )
		{
			return array('status' => 'error', 'message' => _ERROR_NOEMPTYITEMS);
		}
		
		// create new category if needed
		if ( i18n::strpos($i_catid,'newcat') === 0 )
		{
			// Set in default category
			$blog =& $manager->getBlog($i_blogid);
			$i_catid = $blog->getDefaultCategory();
		}
		else
		{
			// force blogid (must be same as category id)
			$i_blogid = getBlogIDFromCatID($i_catid);
			$blog =& $manager->getBlog($i_blogid);
		}
		
		$posttime = 0;
		
		if ( $i_draftid > 0 )
		{
			self::update($i_draftid, $i_catid, $i_title, $i_body, $i_more, $i_closed, 1, 0, 0);
			$itemid = $i_draftid;
		}
		else
		{
			$itemid = $blog->additem($i_catid, $i_title, $i_body, $i_more, $i_blogid, $i_author, $posttime, $i_closed, $i_draft);
		}
		
		return array('status' => 'added', 'draftid' => $itemid);
	}
}
