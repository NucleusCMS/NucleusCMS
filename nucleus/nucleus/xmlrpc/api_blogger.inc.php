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
 * This file contains definitions for the methods in the Blogger API
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */


	// blogger.newPost
	$f_blogger_newPost_sig = array(array(
			// return type
			$xmlrpcString,	// itemid of the new item

			// params:
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// blogid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcString,	// content
			$xmlrpcBoolean,	// publish boolean (set to false to create draft)

		));
	$f_blogger_newPost_doc = "Adds a new item to the given blog. Adds it as a draft when publish is false";
	function f_blogger_newPost($m) {
		$blogid = _getScalar($m,1);
		$username = _getScalar($m,2);
		$password = _getScalar($m,3);
		$content = _getScalar($m,4);
		$publish = _getScalar($m,5);

		$title = blogger_extractTitle($content);
		$category = blogger_extractCategory($content);
		$content = blogger_removeSpecialTags($content);

		return _addItem($blogid, $username, $password, $title, $content, '', $publish, 0, $category);
	}

	// blogger.editPost
	$f_blogger_editPost_sig = array(array(
			// return type
			$xmlrpcBoolean,	// true or false

			// params:
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// postid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcString,	// content
			$xmlrpcBoolean,	// publish boolean (only considered when dealing with a draft)

		));
	$f_blogger_editPost_doc = "Edits an item of a blog";
	function f_blogger_editPost($m) {
		global $manager;

		$itemid = intval(_getScalar($m,1));
		$username = _getScalar($m,2);
		$password = _getScalar($m,3);
		$content = _getScalar($m,4);
		$publish = _getScalar($m,5);

		$title = blogger_extractTitle($content);
		$category = blogger_extractCategory($content);
		$content = blogger_removeSpecialTags($content);

		// get old title and extended part
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");
		$old =& $manager->getItem($itemid,1,1);

		$blogid = getBlogIDFromItemID($itemid);

		$blog = new BLOG($blogid);
		$catid = $blog->getCategoryIdFromName($category);

		if ($old['draft'] && $publish) {
			$wasdraft = 1;
			$publish = 1;
		} else {
			$wasdraft = 0;
		}

		return _edititem($itemid, $username, $password, $catid, $title, $content, $old['more'], $wasdraft, $publish, $old['closed']);
	}


	// blogger.getUsersBlogs
	$f_blogger_getUsersBlogs_sig = array(array(
			// return type
			$xmlrpcArray,	// array containing structs containing blog info

			// params:
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// username
			$xmlrpcString,	// password
		));
	$f_blogger_getUsersBlogs_doc = "Returns a list of all the blogs where the given member is on the team";
	function f_blogger_getUsersBlogs($m) {
		$username = _getScalar($m,1);
		$password = _getScalar($m,2);

		return _getUsersBlogs($username, $password);
	}

	// blogger.getRecentPosts
	$f_blogger_getRecentPosts_sig = array(array(
			// return type
			$xmlrpcArray,	// array of strucs (representing items)

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// blogid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			$xmlrpcInt,	// amount of items to return (max = 20)
		));
	$f_blogger_getRecentPosts_doc = "Returns a maximum of 20 recent items";
	function f_blogger_getRecentPosts($m) {
		$blogid = _getScalar($m, 1);
		$username = _getScalar($m, 2);
		$password = _getScalar($m, 3);
		$amount = _getScalar($m, 4);

		return _getRecentItemsBlogger($blogid, $username, $password, $amount);
	}


	// blogger.getPost
	$f_blogger_getPost_sig = array(array(
			// return type
			$xmlrpcStruct,	// A struct representing the item

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// postid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
		));
	$f_blogger_getPost_doc = "Returns an item (only the item body!)";
	function f_blogger_getPost($m) {
		$postid = _getScalar($m, 1);
		$username = _getScalar($m, 2);
		$password = _getScalar($m, 3);

		return _getItemBlogger($postid, $username, $password);
	}


	// blogger.deletePost
	$f_blogger_deletePost_sig = array(array(
			// return type
			$xmlrpcBoolean,	// boolean (ok or not ok)

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// postid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			$xmlrpcBoolean,	// publish (ignored)
		));
	$f_blogger_deletePost_doc = "Deletes an item";
	function f_blogger_deletePost($m) {
		$postid = _getScalar($m,1);
		$username = _getScalar($m, 2);
		$password = _getScalar($m, 3);

		return _deleteItem($postid, $username, $password);
	}

	// blogger.getTemplate
	$f_blogger_getTemplate_sig = array(array(
			// return type
			$xmlrpcString,	// the template

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// blogid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			$xmlrpcString,	// type of template (main/archiveIndex)
				));
	$f_blogger_getTemplate_doc = "Returns the required part of the default skin for the given blog";
	function f_blogger_getTemplate($m) {
		$blogid = _getScalar($m,1);
		$username = _getScalar($m,2);
		$password = _getScalar($m,3);
		$type = _getScalar($m,4);

		switch($type) {
			case "main":
				$type = "index";
				break;
			case "archiveIndex":
				$type = "archivelist";
				break;
		}

		return _getSkinPart($blogid, $username, $password, $type);
	}

	// blogger.setTemplate
	$f_blogger_setTemplate_sig = array(array(
			// return type
			$xmlrpcBoolean,	// OK or not OK

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString,	// blogid
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			$xmlrpcString,	// template contents
			$xmlrpcString,	// type of template (main/archiveIndex)
			));
	$f_blogger_setTemplate_doc = "Changes a part of the default skin for the selected blog";
	function f_blogger_setTemplate($m) {
		$blogid = _getScalar($m,1);
		$username = _getScalar($m,2);
		$password = _getScalar($m,3);
		$content = _getScalar($m,4);
		$type = _getScalar($m,5);

		switch($type) {
			case "main":
				$type = "index";
				break;
			case "archiveIndex":
				$type = "archivelist";
				break;
		}

		return _setSkinPart($blogid, $username, $password, $content, $type);
	}

	// blogger.getUserInfo
	$f_blogger_getUserInfo_sig = array(array(
			// return type
			$xmlrpcStruct,	// Struct

			// params
			$xmlrpcString,	// appkey (ignored)
			$xmlrpcString, 	// username
			$xmlrpcString,	// password
			));
	$f_blogger_getUserInfo_doc = "Returns info on the user";
	function f_blogger_getUserInfo($m) {
		$username = _getScalar($m,1);
		$password = _getScalar($m,2);

		return _getUserInfo($username, $password);
	}


	/**
	  * Returns a list of recent items
	  */
	function _getRecentItemsBlogger($blogid, $username, $password, $amount) {

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

		$blog = new BLOG($blogid);

		$structarray = array();		// the array in which the structs will be stored

		$query = "SELECT mname, ibody, iauthor, ibody, inumber, ititle as title, itime, cname as category"
			   .' FROM '.sql_table('item').', '.sql_table('category').', '.sql_table('member')
			   ." WHERE iblog=$blogid and icat=catid and iauthor=mnumber"
			   ." ORDER BY itime DESC"
			   ." LIMIT $amount";
		$r = sql_query($query);

		while ($row = sql_fetch_assoc($r)) {

			// remove linebreaks if needed
			if ($blog->convertBreaks())
				$row['ibody'] = removeBreaks($row['ibody']);

			$content = blogger_specialTags($row) . $row['ibody'];

			$newstruct = new xmlrpcval(array(
				"userid" => new xmlrpcval($row['iauthor'],"string"),
				"dateCreated" => new xmlrpcval(iso8601_encode(strtotime($row['itime'])),"dateTime.iso8601"),
				"blogid" => new xmlrpcval($blogid,"string"),
				"content" => new xmlrpcval($content,"string"),
				"postid" => new xmlrpcval($row['inumber'],"string"),
				"authorName" => new xmlrpcval($row['mname'],'string'),
				"title" => new xmlrpcval($row['title'],'string'),
			),'struct');
			array_push($structarray, $newstruct);
		}

		return new xmlrpcresp(new xmlrpcval( $structarray , "array"));

	}

	/**
	  * Returns one item (Blogger version)
	  */
	function _getItemBlogger($itemid, $username, $password) {
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

		// get category
		$item['category'] = $blog->getCategoryName($item['catid']);

		// remove linebreaks if needed
		if ($blog->convertBreaks())
			$item['body'] = removeBreaks($item['body']);

		$content = blogger_specialTags($item) . $item['body'];

		$newstruct = new xmlrpcval(array(
			"dateCreated" => new xmlrpcval(iso8601_encode($item['timestamp']),"dateTime.iso8601"),
			"userid" => new xmlrpcval($item['authorid'],"string"),
			"blogid" => new xmlrpcval($blogid,"string"),
			"content" => new xmlrpcval($content,"string")
		),'struct');

		return new xmlrpcresp($newstruct);


	}


	function blogger_extractTitle($body) {
		return blogger_matchTag('title',$body);
	}

	function blogger_extractCategory($body) {
		return blogger_matchTag('category',$body);
	}

	function blogger_matchTag($tag, $body) {
		if (preg_match("/<" . $tag .">(.+?)<\/".$tag.">/is",$body,$match))
			return $match[1];
		else
			return "";
	}

	function blogger_removeSpecialTags($body) {
		$body = preg_replace("/<title>(.+?)<\/title>/","",$body);
		$body = preg_replace("/<category>(.+?)<\/category>/","",$body);
		return trim($body);
	}

	function blogger_specialTags($item) {
		$result = "<title>". $item['title']."</title>";
		$result .= "<category>".$item['category']."</category>";
		return $result;
	}



	$functionDefs = array_merge($functionDefs,
		array(
			 "blogger.getUsersBlogs" =>
			 array( "function" => "f_blogger_getUsersBlogs",
				"signature" => $f_blogger_getUsersBlogs_sig,
				"docstring" => $f_blogger_getUsersBlogs_doc),

			 "blogger.newPost" =>
			 array( "function" => "f_blogger_newPost",
				"signature" => $f_blogger_newPost_sig,
				"docstring" => $f_blogger_newPost_doc),

			 "blogger.editPost" =>
			 array( "function" => "f_blogger_editPost",
				"signature" => $f_blogger_editPost_sig,
				"docstring" => $f_blogger_editPost_doc),

			 "blogger.deletePost" =>
			 array( "function" => "f_blogger_deletePost",
				"signature" => $f_blogger_deletePost_sig,
				"docstring" => $f_blogger_deletePost_doc),

			 "blogger.getPost" =>
			 array( "function" => "f_blogger_getPost",
				"signature" => $f_blogger_getPost_sig,
				"docstring" => $f_blogger_getPost_doc),

			 "blogger.getRecentPosts" =>
			 array( "function" => "f_blogger_getRecentPosts",
				"signature" => $f_blogger_getRecentPosts_sig,
				"docstring" => $f_blogger_getRecentPosts_doc),

			 "blogger.getUserInfo" =>
			 array( "function" => "f_blogger_getUserInfo",
				"signature" => $f_blogger_getUserInfo_sig,
				"docstring" => $f_blogger_getUserInfo_doc),

			 "blogger.getTemplate" =>
			 array( "function" => "f_blogger_getTemplate",
				"signature" => $f_blogger_getTemplate_sig,
				"docstring" => $f_blogger_getTemplate_doc),

			 "blogger.setTemplate" =>
			 array( "function" => "f_blogger_setTemplate",
				"signature" => $f_blogger_setTemplate_sig,
				"docstring" => $f_blogger_setTemplate_doc)

		)
	);


?>
