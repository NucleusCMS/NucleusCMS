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
 * This file contains definitions for the functions in the Nucleus API
 *
 * NOTE: These functions are deprecated and will most likely be removed!
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

	// nucleus.addItem
	$f_nucleus_addItem_sig = array(array(
			// return type
			$xmlrpcString,	// itemid of the new item

			// params:
			$xmlrpcString,	// blogid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcString,  // title
			$xmlrpcString,	// body
			$xmlrpcString,	// extended part
			$xmlrpcBoolean,	// publish boolean (set to false to create draft)
			$xmlrpcBoolean,	// closed boolean (set to true to disable comments)

		));
	$f_nucleus_addItem_doc = "Adds a new item to the given blog. Adds it as a draft when publish is false";
	function f_nucleus_addItem($m) {
		$blogid = _getScalar($m,0);
		$username = _getScalar($m,1);
		$password = _getScalar($m,2);
		$title = _getScalar($m,3);
		$body = _getScalar($m,4);
		$more = _getScalar($m,5);
		$publish = _getScalar($m,6);
		$closed = _getScalar($m,7);

		return _addItem($blogid, $username, $password, $title, $body, $more, $publish, $closed);
	}

	// nucleus.addDatedItem (the time of the item can be given here, for offline blogging)
	$f_nucleus_addDatedItem_sig = array(array(
			// return type
			$xmlrpcString,	// itemid of the new item

			// params:
			$xmlrpcString,	// blogid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcString,  // title
			$xmlrpcString,	// body
			$xmlrpcString,	// extended part
			$xmlrpcBoolean,	// publish boolean (set to false to create draft)
			$xmlrpcBoolean,	// closed boolean (set to true to disable comments)
			$xmlrpcInt	// item time (unix timestamp)

		));
	$f_nucleus_addDatedItem_doc = "Adds a new item to the given blog. Adds it as a draft when publish is false. The timestamp of the item needs to be given as a Unix timestamp";
	function f_nucleus_addDatedItem($m) {
		$blogid = _getScalar($m,0);
		$username = _getScalar($m,1);
		$password = _getScalar($m,2);
		$title = _getScalar($m,3);
		$body = _getScalar($m,4);
		$more = _getScalar($m,5);
		$publish = _getScalar($m,6);
		$closed = _getScalar($m,7);
		$timestamp = _getScalar($m,8);

		// use '1' as $future param to make sure the date does not get erased
		return _addDatedItem($blogid, $username, $password, $title, $body, $more, $publish, $closed, $timestamp, 1);
	}

	// nucleus.editItem
	$f_nucleus_editItem_sig = array(array(
			// return type
			$xmlrpcBoolean,	// true or false

			// params:
			$xmlrpcString,	// itemid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcString,  // title
			$xmlrpcString,	// body
			$xmlrpcString,	// extended part
			$xmlrpcBoolean,	// publish boolean (set to false if you want a draft to stay draft)
			$xmlrpcBoolean,	// closed boolean (set to true to disable comments)
		));
	$f_nucleus_editItem_doc = "Edits an item of a blog";
	function f_nucleus_editItem($m) {
		global $manager;

		$itemid = intval(_getScalar($m,0));
		$username = _getScalar($m,1);
		$password = _getScalar($m,2);
		$title = _getScalar($m,3);
		$content = _getScalar($m,4);
		$more = _getScalar($m,5);
		$publish = _getScalar($m,6);
		$closed = _getScalar($m,7);

		// get old title and extended part
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");

		$old =& $manager->getItem($itemid,1,1);
		$wasdraft = ($old['draft']) ? 1 : 0;

		return _edititem($itemid, $username, $password, $old['catid'], $title, $content, $more, $wasdraft, $publish, $closed);
	}


	// nucleus.getUsersBlogs
	$f_nucleus_getUsersBlogs_sig = array(array(
			// return type
			$xmlrpcArray,	// array containing structs containing blog info

			// params:
			$xmlrpcString,	// username
			$xmlrpcString,	// password
		));
	$f_nucleus_getUsersBlogs_doc = "Returns a list of all the blogs where the given member is on the team";
	function f_nucleus_getUsersBlogs($m) {
		$username = _getScalar($m,0);
		$password = _getScalar($m,1);

		return _getUsersBlogs($username, $password);
	}

	// nucleus.getRecentItems
	$f_nucleus_getRecentItems_sig = array(array(
			// return type
			$xmlrpcArray,	// array of strucs (representing items)

			// params
			$xmlrpcString,	// blogid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			$xmlrpcInt,	// amount of items to return (max = 20)
		));
	$f_nucleus_getRecentItems_doc = "Returns a maximum of 20 recent items for a given webblog";
	function f_nucleus_getRecentItems($m) {
		$blogid = _getScalar($m, 0);
		$username = _getScalar($m, 1);
		$password = _getScalar($m, 2);
		$amount = _getScalar($m, 3);

		return _getRecentItems($blogid, $username, $password, $amount);
	}

	// nucleus.getItem
	$f_nucleus_getItem_sig = array(array(
			// return type
			$xmlrpcStruct,	// A struct representing the item

			// params
			$xmlrpcString,	// itemid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
		));
	$f_nucleus_getItem_doc = "Returns an item";
	function f_nucleus_getItem($m) {
		$postid = _getScalar($m, 0);
		$username = _getScalar($m, 1);
		$password = _getScalar($m, 2);

		return _getItem($postid, $username, $password);
	}

	// nucleus.deleteItem
	$f_nucleus_deleteItem_sig = array(array(
			// return type
			$xmlrpcBoolean,	// boolean (ok or not ok)

			// params
			$xmlrpcString,	// itemid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
		));
	$f_nucleus_deleteItem_doc = "Deletes an item";
	function f_nucleus_deleteItem($m) {
		$itemid = _getScalar($m,0);
		$username = _getScalar($m, 1);
		$password = _getScalar($m, 2);

		return _deleteItem($itemid, $username, $password);
	}


	/**
	  * Returns a list of recent items (Nucleus Version)
	  * ($amount = max 20);
	  */
	function _getRecentItems($blogid, $username, $password, $amount) {
		$blogid = intval($blogid);
		$amount = intval($amount);

		// 1. login
		$mem = new MEMBER();
		if (!$mem->login($username, $password))
			return _error(1,"Could not log in");

		// 2. check if allowed
		if (!BLOG::existsID($blogid))
			return _error(2,"No such blog ($blogid)");
		if (!$mem->teamRights($blogid))
			return _error(3,"Not a team member");
		$amount = intval($amount);
		if (($amount < 1) or ($amount > 20))
			return _error(5,"Amount parameter must be in range 1..20");

		// 3. create and return list of recent items
		// Struct returned has dateCreated, userid, blogid and content

		$structarray = array();		// the array in which the structs will be stored

		$query = "SELECT ibody, iauthor, ibody, imore, ititle, iclosed, idraft, itime"
			   .' FROM '.sql_table('item')
			   ." WHERE iblog=$blogid"
			   ." ORDER BY itime DESC"
			   ." LIMIT $amount";
		$r = sql_query($query);
		while ($obj = sql_fetch_object($r)) {
			$newstruct = new xmlrpcval(array(
				"publishDate" => new xmlrpcval(iso8601_encode(strtotime($obj->itime)),"dateTime.iso8601"),
				"userid" => new xmlrpcval($obj->iauthor,"string"),
				"blogid" => new xmlrpcval($blogid,"string"),
				"title" => new xmlrpcval($obj->ititle,"string"),
				"body" => new xmlrpcval($obj->ibody,"string"),
				"more" => new xmlrpcval($obj->imore,"string"),
				"draft" => new xmlrpcval($obj->idraft,"boolean"),
				"closed" => new xmlrpcval($obj->iclosed,"boolean"),
			),'struct');
			array_push($structarray, $newstruct);
		}

		return new xmlrpcresp(new xmlrpcval( $structarray , "array"));

	}



	/**
	  * Returns one item (Nucleus version)
	  */
	function _getItem($itemid, $username, $password) {
		global $manager;

		// 1. login
		$mem = new MEMBER();
		if (!$mem->login($username, $password))
			return _error(1,"Could not log in");

		// 2. check if allowed
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");
		$blogid = getBlogIDFromItemID($itemid);

		if (!$mem->teamRights($blogid))
			return _error(3,"Not a team member");

		// 3. return the item
		// Structure returned has dateCreated, userid, blogid and content

		$item =& $manager->getItem($itemid,1,1); // (also allow drafts and future items)

		$blog = new BLOG($blogid);
		if ($blog->convertBreaks())
			$item['body'] = removeBreaks($item['body']);

		$newstruct = new xmlrpcval(array(
			"publishDate" => new xmlrpcval(iso8601_encode($item['timestamp']),"dateTime.iso8601"),
			"userid" => new xmlrpcval($item['authorid'],"string"),
			"blogid" => new xmlrpcval($blogid,"string"),
			"title" => new xmlrpcval($item['title'],"string"),
			"body" => new xmlrpcval($item['body'],"string"),
			"more" => new xmlrpcval($item['more'],"string"),
			"draft" => new xmlrpcval($item['draft'],"boolean"),
			"closed" => new xmlrpcval($item['closed'],"boolean"),
		),'struct');

		return new xmlrpcresp($newstruct);


	}


	$functionDefs = array_merge($functionDefs,
		array(
			"nucleus.addItem" =>
			array( "function" => "f_nucleus_addItem",
				"signature" => $f_nucleus_addItem_sig,
				"docstring" => $f_nucleus_addItem_doc),

			"nucleus.editItem" =>
			array( "function" => "f_nucleus_editItem",
				"signature" => $f_nucleus_editItem_sig,
				"docstring" => $f_nucleus_editItem_doc),

			"nucleus.addDatedItem" =>
			array( "function" => "f_nucleus_addDatedItem",
				"signature" => $f_nucleus_addDatedItem_sig,
				"docstring" => $f_nucleus_addDatedItem_doc),

			"nucleus.deleteItem" =>
			array( "function" => "f_nucleus_deleteItem",
				"signature" => $f_nucleus_deleteItem_sig,
				"docstring" => $f_nucleus_deleteItem_doc),

			"nucleus.getUsersBlogs" =>
			array( "function" => "f_nucleus_getUsersBlogs",
				"signature" => $f_nucleus_getUsersBlogs_sig,
				"docstring" => $f_nucleus_getUsersBlogs_doc),

			"nucleus.getRecentItems" =>
			array( "function" => "f_nucleus_getRecentItems",
				"signature" => $f_nucleus_getRecentItems_sig,
				"docstring" => $f_nucleus_getRecentItems_doc),

			"nucleus.getItem" =>
			array( "function" => "f_nucleus_getItem",
				"signature" => $f_nucleus_getItem_sig,
				"docstring" => $f_nucleus_getItem_doc)
		)

	);

?>