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
 * This script is provides an XML-RPC [1] interface to Nucleus [2].
 *
 * At this time, the Blogger API [3], the metaWeblog API [4] and
 * parts of the Movable Type API [5] are implemented
 *
 * This script uses the the 'XML-RPC for PHP v1.02' implementation [6]
 * All other code was written by Wouter Demuynck [7]
 *
 * [1] http://www.xmlrpc.com/
 * [2] http://nucleuscms.org/
 * [3] http://plant.blogger.com/api/
 * [4] http://www.xmlrpc.com/metaWeblogApi
 * [5] http://www.movabletype.org/docs/mtmanual_programmatic.html
 * [6] http://phpxmlrpc.sourceforge.net/
 * [7] http://demuynck.org/
 *
 *
 * The Blogger API: (more info in the documentation)
 *
 *	blogger.newPost
 *	blogger.editPost
 *	blogger.getUsersBlogs
 *	blogger.deletePost
 *	blogger.getRecentPosts
 *	blogger.getPost
 *	blogger.getUserInfo
 *	blogger.getTemplate
 *	blogger.setTemplate
 *
 *	Note: The getUserInfo response contains an empty 'lastname' and the full name as
 *       'firstname'
 * Note: Blogger API methods only affect the body field of items
 *
 * The metaWeblog API (more info in documentation)
 *
 * metaWeblog.newPost
 * metaWeblog.getPost
 * metaWeblog.editPost
 * metaWeblog.getCategories
 * metaWeblog.newMediaObject
 * metaWeblog.getRecentPosts
 *
 * Note: metaWeblog API methods only affect the body and title fields of items.
 *       the extended part is left untouched (and empty for new posts)
 *
 * The Movable Type API
 *
 * mt.supportedMethods
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
$CONF = array();
$DIR_LIBS = '';
require("../../config.php");	// include Nucleus libs and code
//include($DIR_LIBS . "xmlrpc.inc.php");
//include($DIR_LIBS . "xmlrpcs.inc.php");
include_libs('xmlrpc.inc.php',false,false);
include_libs('xmlrpcs.inc.php',false,false);

/* define xmlrpc settings */
$xmlrpc_internalencoding = _CHARSET;
$xmlrpc_defencoding = 'UTF-8';

/* definition of available methods */

$functionDefs = array();

// load server functions
include('api_blogger.inc.php');
include('api_metaweblog.inc.php');
// include('api_nucleus.inc.php'); // uncomment if you still want to use the nucleus.* methods
include('api_mt.inc.php');


// create server
$s = new xmlrpc_server( $functionDefs );


/* ------------------------------ private functions ---------------------------------- */

/**
  * Adds an item to the given blog. Username and password are required to login
  */
function _addItem($blogid, $username, $password, $title, $body, $more, $publish, $closed, $catname = "") {
	$blog = new BLOG($blogid);
	$timestamp = $blog->getCorrectTime();
	return _addDatedItem($blogid, $username, $password, $title, $body, $more, $publish, $closed, $timestamp, 0, $catname);
}

/**
  * Adds item to blog, with time of item given
  */
function _addDatedItem($blogid, $username, $password, $title, $body, $more, $publish, $closed = '0', $timestamp, $future, $catname = "") {
	// 1. login
	$mem = new MEMBER();

	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 2. check if allowed to add to blog
	if (!BLOG::existsID($blogid))
		return _error(2,"No such blog ($blogid)");
	if (!$mem->teamRights($blogid))
		return _error(3,"Not a team member");
	if (!trim($body))
		return _error(4,"Cannot add empty items!");

	// 3. calculate missing vars
	$blog = new BLOG($blogid);

	// get category id (or id for default category when false category)
	$catid = $blog->getCategoryIdFromName($catname);

	if ($publish == 1) {
		$draft = 0;
	}
	else {
		$draft = 1;
	}
	
	// not needed because BLOG:additem has the same code
	/*if ($closed != 1)
	{$closed = 0;}*/

	// 4. add to blog
	$itemid = $blog->additem($catid, $title, $body, $more, $blogid, $mem->getID(), $timestamp, $closed, $draft);

	// [TODO] ping weblogs.com ?

	return new xmlrpcresp(new xmlrpcval($itemid,"string"));
}

/**
  * Updates an item. Username and password are required to login
  */
function _edititem($itemid, $username, $password, $catid, $title, $body, $more, $wasdraft, $publish, $closed) {
	global $manager;

	// 1. login
	$mem = new MEMBER();
	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 2. check if allowed to add to blog
	if (!$manager->existsItem($itemid,1,1))
		return _error(6,"No such item ($itemid)");
	if (!$mem->canAlterItem($itemid))
		return _error(7,"Not allowed to alter item");

	// 3. update item
	ITEM::update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, 0);

	return new xmlrpcresp(new xmlrpcval(1,"boolean"));
}

/**
  * Gives the list of blogs to which the user with given name and password has access
  */
function _getUsersBlogs($username, $password) {
	// 1. Try to login
	$mem = new MEMBER();
	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 2. Get list of blogs

	$structarray = array();
	$query =  "SELECT bnumber, bname, burl"
			. ' FROM '.sql_table('blog').', '.sql_table('team')
			. " WHERE tblog=bnumber and tmember=" . $mem->getID()
			. " ORDER BY bname";
	$r = sql_query($query);

	while ($obj = sql_fetch_object($r)) {
		if ($obj->burl)
			$blogurl = $obj->burl;
		else
			$blogurl = 'http://';

		$newstruct = new xmlrpcval(array(
			"url" => new xmlrpcval($blogurl,"string"),
			"blogid" => new xmlrpcval($obj->bnumber,"string"),
			"blogName" => new xmlrpcval($obj->bname,"string")
		),'struct');
		array_push($structarray, $newstruct);
	}

	return new xmlrpcresp(new xmlrpcval( $structarray , "array"));
}


function _getUserInfo($username, $password) {
	// 1. login
	$mem = new MEMBER();
	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 3. return the info
	// Structure returned has nickname, userid, url, email, lastname, firstname

	$newstruct = new xmlrpcval(array(
		"nickname" => new xmlrpcval($mem->getDisplayName(),"string"),
		"userid" => new xmlrpcval($mem->getID(),"string"),
		"url" => new xmlrpcval($mem->getURL(),"string"),
		"email" => new xmlrpcval($mem->getEmail(),"string"),
		"lastname" => new xmlrpcval("","string"),
		"firstname" => new xmlrpcval($mem->getRealName(),"string")
	),'struct');

	return new xmlrpcresp($newstruct);


}

/**
  * deletes an item
  */
function _deleteItem($itemid, $username, $password) {
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

	// delete the item
	ITEM::delete($itemid);

	return new xmlrpcresp(new xmlrpcval(1,"boolean"));
}

/**
  * Returns a template
  */
function _getSkinPart($blogid, $username, $password, $type) {
	// 1. login
	$mem = new MEMBER();
	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 2. check if allowed
	if (!BLOG::existsID($blogid))
		return _error(2,"No such blog ($blogid)");
	if (!$mem->teamRights($blogid))
		return _error(3,"Not a team member");

	// 3. return skin part
	$blog = new BLOG($blogid);
	$skin = new SKIN($blog->getDefaultSkin());
	return new xmlrpcresp(new xmlrpcval($skin->getContent($type),"string"));

}

function _setSkinPart($blogid, $username, $password, $content, $type) {
	// 1. login
	$mem = new MEMBER();
	if (!$mem->login($username, $password))
		return _error(1,"Could not log in");

	// 2. check if allowed
	if (!BLOG::existsID($blogid))
		return _error(2,"No such blog ($blogid)");
	if (!$mem->teamRights($blogid))
		return _error(3,"Not a team member");

	// 3. update skin part
	$blog = new BLOG($blogid);
	$skin = new SKIN($blog->getDefaultSkin());
	$skin->update($type, $content);

	return new xmlrpcresp(new xmlrpcval(1,'boolean'));
}

/**
  * Some convenience methods
  */

function _getScalar($m, $idx) {
	$v = $m->getParam($idx);
	return $v->scalarval();
}

function _getStructVal($struct, $key) {
	$t = $struct->structmem($key);
	if (!$t) 
		return '';	// no such struct value
	else
		return $t->scalarval();
}

function _getArrayVal($a, $idx) {
	$t = $a->arraymem($idx);
	return $t->scalarval();
}

/**
  * Returns an XML-RPC error response
  * $err is the error number (>0, will be added to $xmlrpcerruser)
  */
function _error($err, $msg) {
	global $xmlrpcerruser;
	return new xmlrpcresp(0, $xmlrpcerruser + $err, $msg);
}
?>