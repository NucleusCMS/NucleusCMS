<?php
	/*
	 * This file contains definitions for the methods in the Movable Type API
	 *
	 * Wouter Demuynck 2003-08-31
	 */


	// mt.supportedMethods
	$f_mt_supportedMethods_sig = array(array(
			// return type
			$xmlrpcArray // array of strings
		));
	$f_mt_supportedMethods_doc = 'returns an array of supported methods';
	function f_mt_supportedMethods($m) {
		$res = new xmlrpcresp(new xmlrpcval( 
			array(
				new xmlrpcval('mt.supportedMethods', 'string'),
				new xmlrpcval('mt.supportedTextFilters', 'string'),
				new xmlrpcval('mt.publishPost', 'string'),
				new xmlrpcval('mt.getCategoryList', 'string'),
				new xmlrpcval('mt.getPostCategories', 'string'),
				new xmlrpcval('mt.setPostCategories', 'string')								
			), 'array')
		);
		return $res;
	}
	
	// mt.supportedTextFilters
	$f_mt_supportedTextFilters_sig = array(array(
			// return type
			$xmlrpcArray	// array of structs
		));
	$f_mt_supportedTextFilters_doc = 'returns the supported text filters';
	function f_mt_supportedTextFilters($m) {
		$res = new xmlrpcresp(new xmlrpcval( 
			array(
				// no text filters in nucleus
			), 'array')
		);
		return $res;
	}
	
	// mt.getCategoryList
	$f_mt_getCategoryList_sig = array(array(
			// return type
			$xmlrpcArray,		// array of structs
			
			// params
			$xmlrpcString,		// blogid
			$xmlrpcString,		// username
			$xmlrpcString		// password
			
		));
	$f_mt_getCategoryList_doc = 'Returns a list of all categories defined in the weblog';
	function f_mt_getCategoryList($m) {
		$blogid =	_getScalar($m,0);
		$username =	_getScalar($m,1);
		$password =	_getScalar($m,2);

		return _mt_categoryList($blogid, $username, $password);
	}
	
	// mt.publishPost
	$f_mt_publishPost_sig = array(array(
			// return type
			$xmlrpcBoolean,		// true
			
			// params
			$xmlrpcString,		// itemid
			$xmlrpcString,		// username
			$xmlrpcString		// password
		));
	$f_mt_publishPost_doc = 'Transfers an item from the "draft" state to the "published" state. For items that were published earlier, does nothing.';
	function f_mt_publishPost($m) {
		$itemid		= intval(_getScalar($m, 0));
		$username	= _getScalar($m, 1);
		$password	= _getScalar($m, 2);		
		
		return _mt_publishPost($itemid, $username, $password);
	}
	
	// mt.getPostCategories
	$f_mt_getPostCategories_sig = array(array(
		// return
		$xmlrpcArray,		// array of structs
		// parameters
		$xmlrpcString,		// itemid
		$xmlrpcString,		// username
		$xmlrpcString		// password
	));
	$f_mt_getPostCategories_doc = 'Returns a list of all categories to which the post is assigned.';
	function f_mt_getPostCategories($m) {
		$itemid		= intval(_getScalar($m, 0));
		$username	= _getScalar($m, 1);
		$password	= _getScalar($m, 2);
		
		return _mt_getPostCategories($itemid, $username, $password);
	}

	// mt.setPostCategories
	$f_mt_setPostCategories_sig = array(array(
		// return
		$xmlrpcBoolean,		// true
		// parameters
		$xmlrpcString,		// itemid
		$xmlrpcString,		// username
		$xmlrpcString,		// password
		$xmlrpcArray		// categories
	));
	$f_mt_setPostCategories_doc = 'Sets the categories for a post. Only the primary category will be stored';
	function f_mt_setPostCategories($m) {
		$itemid		= intval(_getScalar($m, 0));
		$username	= _getScalar($m, 1);
		$password	= _getScalar($m, 2);

		$categories = $m->getParam(3);
		$iSize = $categories->arraysize();		

		for ($i=0;$i<$iSize;$i++) {
			$struct = $categories->arraymem($i);
			$bPrimary = $struct->structmem('isPrimary');
			$bPrimary = $bPrimary->scalarval();
			if ($bPrimary) {
				$category = $struct->structmem('categoryId');
				$category = $category->scalarval();
			}
			
		}
		
		return _mt_setPostCategories($itemid, $username, $password, $category);
	}

	$functionDefs = array_merge($functionDefs,
		array(
			 "mt.supportedMethods" =>
			 array( "function" => "f_mt_supportedMethods",
				"signature" => $f_mt_supportedMethods_sig,
				"docstring" => $f_mt_supportedMethods_doc),
		
			 "mt.supportedTextFilters" =>
			 array( "function" => "f_mt_supportedTextFilters",
				"signature" => $f_mt_supportedTextFilters_sig,
				"docstring" => $f_mt_supportedTextFilters_doc),
				
			 "mt.getCategoryList" =>
			 array( "function" => "f_mt_getCategoryList",
				"signature" => $f_mt_getCategoryList_sig,
				"docstring" => $f_mt_getCategoryList_doc),
				
			 "mt.publishPost" =>
			 array( "function" => "f_mt_publishPost",
				"signature" => $f_mt_publishPost_sig,
				"docstring" => $f_mt_publishPost_doc),
				
			 "mt.getPostCategories" =>
			 array( "function" => "f_mt_getPostCategories",
				"signature" => $f_mt_getPostCategories_sig,
				"docstring" => $f_mt_getPostCategories_doc),
				
			 "mt.setPostCategories" =>
			 array( "function" => "f_mt_setPostCategories",
				"signature" => $f_mt_setPostCategories_sig,
				"docstring" => $f_mt_setPostCategories_doc)				

		)
	);

	function _mt_setPostCategories($itemid, $username, $password, $category) {
		global $manager;

		// login
		$mem = new MEMBER();
		if (!$mem->login($username, $password))
			return _error(1,"Could not log in");

		// check if item exists			
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");
			
		$blogid = getBlogIDFromItemID($itemid);
		$blog = new BLOG($blogid);

		if (!$mem->canAlterItem($itemid))
			return _error(7,"Not allowed to alter item");
		
		$old =& $manager->getItem($itemid,1,1);		

		$catid = $blog->getCategoryIdFromName($category);		

		$publish = 0;
		if ($old['draft'] && $publish) {
			$wasdraft = 1;
			$publish = 1;
		} else {
			$wasdraft = 0;
		}
		
		return _edititem($itemid, $username, $password, $catid, $old['title'], $old['body'], $old['more'], $wasdraft, $publish, $old['closed']);
	}
	
	
	function _mt_getPostCategories($itemid, $username, $password) {
		global $manager;
		
		// login
		$mem = new MEMBER();
		if (!$mem->login($username, $password))
			return _error(1,"Could not log in");

		// check if item exists			
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");
			
		$blogid = getBlogIDFromItemID($itemid);
		$blog = new BLOG($blogid);

		if (!$mem->canAlterItem($itemid))
			return _error(7, 'You are not allowed to request this information');
		
		$info =& $manager->getItem($itemid,1,1);		
		
		$struct = new xmlrpcval(
			array(
				'categoryId' => new xmlrpcval($blog->getCategoryName($info['catid']), $xmlrpcString),
				'isPrimary'	=> new xmlrpcval(1, $xmlrpcBoolean)
			), $xmlrpcStruct
		);		
		
		return new xmlrpcresp(new xmlrpcval(array($struct), $xmlrpcArray));

	}
	
	function _mt_publishPost($itemid, $username, $password) {
		global $manager;
		
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");

		// get item data
		$blogid = getBlogIDFromItemID($itemid);
		$blog = new BLOG($blogid);
		$old =& $manager->getItem($itemid,1,1);

		return _edititem($itemid, $username, $password, $old['catid'], $old['title'], $old['body'], $old['more'], $old['draft'], 1, $old['closed']);
	}
	
	
	function _mt_categoryList($blogid, $username, $password) {
		// 1. login
		$mem = new MEMBER();
		if (!$mem->login($username, $password))
			return _error(1,"Could not log in");

		// check if on team and blog exists
		if (!BLOG::existsID($blogid))
			return _error(2,"No such blog ($blogid)");
		if (!$mem->teamRights($blogid))
			return _error(3,"Not a team member");
			
		$b = new BLOG($blogid);
		
		$categorystruct = array();

		$query =  "SELECT cname, cdesc, catid"
				. ' FROM '.sql_table('category')
				. " WHERE cblog=" . intval($blogid)
				. " ORDER BY cname";
		$r = sql_query($query);

		while ($obj = mysql_fetch_object($r)) {

			$categorystruct[] = new xmlrpcval(
				array(
					"categoryName" => new xmlrpcval($obj->cname,"string"),
					"categoryId" => new xmlrpcval($obj->cname,"string")
				)
			,'struct');
			
		}
		
		
		return new xmlrpcresp(new xmlrpcval( $categorystruct , "array"));
	
	}
	


?>