<?php	/*
	 *	This file contains definitions for the methods of the metaWeblog API
	 */
	 
	
	// metaWeblog.newPost
	$f_metaWeblog_newPost_sig = array(array(
			// return type
			$xmlrpcString,	// itemid of the new item

			// params:
			$xmlrpcString,	// blogid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcStruct,	// content
			$xmlrpcBoolean,	// publish boolean (set to false to create draft)

		));
	$f_metaWeblog_newPost_doc = "Adds a new item to the given blog. Adds it as a draft when publish is false";
	function f_metaWeblog_newPost($m) {
		$blogid = 			_getScalar($m,0);
		$username = 		_getScalar($m,1);
		$password = 		_getScalar($m,2);
		$struct = 			$m->getParam(3);
			$content = 		_getStructVal($struct, 'description');
			$title = 		_getStructVal($struct, 'title');

			// category is optional (thus: be careful)!
			$catlist = $struct->structmem('categories');
			if ($catlist) 
				$category = _getArrayVal($catlist, 0);

		$publish = _getScalar($m,4);

		return _addItem($blogid, $username, $password, $title, $content, '', $publish, 0, $category);
	}
	
	
	// metaWeblog.getCategories
	$f_metaWeblog_getCategories_sig = array(array(
		// return
		$xmlrpcStruct,	// categories for blog
		
		// params
		$xmlrpcString,	// blogid
		$xmlrpcString,	// username
		$xmlrpcString,	// password
		
	));
	$f_metaWeblog_getCategories_doc = "Returns the categories for a given blog";
	function f_metaWeblog_getCategories($m) {
		$blogid =	_getScalar($m,0);
		$username =	_getScalar($m,1);
		$password =	_getScalar($m,2);
	
		return _categoryList($blogid, $username, $password);
	}
	

	// metaWeblog.getPost
	$f_metaWeblog_getPost_sig = array(array(
		// return
		$xmlrpcStruct,	// the juice 
		
		// params
		$xmlrpcString,	// itemid
		$xmlrpcString,	// username
		$xmlrpcString,	// password
		
	));
	$f_metaWeblog_getPost_doc = "Retrieves a post";
	function f_metaWeblog_getPost($m) {
		$itemid =	_getScalar($m,0);
		$username =	_getScalar($m,1);
		$password =	_getScalar($m,2);
	
		return _mw_getPost($itemid, $username, $password);
	}
	

	// metaWeblog.editPost
	$f_metaWeblog_editPost_sig = array(array(
			// return type
			$xmlrpcBoolean,	// true

			// params:
			$xmlrpcString,	// itemid
			$xmlrpcString,	// username
			$xmlrpcString,	// password
			$xmlrpcStruct,	// content
			$xmlrpcBoolean,	// publish boolean (set to false to create draft)

		));
	$f_metaWeblog_editPost_doc = "Edits an item";
	function f_metaWeblog_editPost($m) {
		global $manager;

		$itemid = 			_getScalar($m,0);
		$username = 		_getScalar($m,1);
		$password = 		_getScalar($m,2);

		$struct = 			$m->getParam(3);
			$content = 		_getStructVal($struct, 'description');
			$title = 		_getStructVal($struct, 'title');

			// category is optional (thus: be careful)!
			$catlist = $struct->structmem('categories');
			if ($catlist->kindOf() == "array") {
				$category = _getArrayVal($catlist, 0);
			} 
			
		$publish = _getScalar($m,4);

		// get old title and extended part 
		if (!$manager->existsItem($itemid,1,1))
			return _error(6,"No such item ($itemid)");
		$blogid = getBlogIDFromItemID($itemid);

		$blog = new BLOG($blogid);
		$catid = $blog->getCategoryIdFromName($category);
		
		$old =& $manager->getItem($itemid,1,1);
		
		if ($old['draft'] && $publish) {
			$wasdraft = 1;
			$publish = 1;
		} else {
			$wasdraft = 0;
		}

		return _edititem($itemid, $username, $password, $catid, $title, $content, $old['more'], $wasdraft, $publish, $old['closed']);

	}
	
	function _categoryList($blogid, $username, $password) {
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

			$categorystruct[$obj->cname] = new xmlrpcval(
				array(
					"description" => new xmlrpcval($obj->cdesc,"string"),
					"htmlUrl" => new xmlrpcval($b->getURL() . "?catid=" . $obj->catid ,"string"),
					"rssUrl" => new xmlrpcval("","string")
				)
			,'struct');
		}
		
		
		return new xmlrpcresp(new xmlrpcval( $categorystruct , "struct"));
	
	}
	
	
	function _mw_getPost($itemid, $username, $password) {
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
		$item =& $manager->getItem($itemid,1,1); // (also allow drafts and future items)
		
		$b = new BLOG($blogid);
		if ($b->convertBreaks())
			$item['body'] = removeBreaks($item['body']);
			
		$categoryname = $b->getCategoryName($item['catid']);

		$newstruct = new xmlrpcval(array(
			"dateCreated" => new xmlrpcval(iso8601_encode($item['timestamp']),"dateTime.iso8601"),
			"userid" => new xmlrpcval($item['authorid'],"string"),
			"blogid" => new xmlrpcval($blogid,"string"),
			"description" => new xmlrpcval($item['body'],"string"),
			"title" => new xmlrpcval($item['title'],"string"),
			"categories" => new xmlrpcval(
					array(
						new xmlrpcval($categoryname, "string")
					)
					,"array")
		),'struct');

		return new xmlrpcresp($newstruct);
	
	}
	
	$functionDefs = array_merge($functionDefs,
		array(
			 "metaWeblog.newPost" =>
			 array(
				"function" => "f_metaWeblog_newPost",
				"signature" => $f_metaWeblog_newPost_sig,
				"docstring" => $f_metaWeblog_newPost_doc
			 ),

			 "metaWeblog.getCategories" =>
			 array(
				"function" => "f_metaWeblog_getCategories",
				"signature" => $f_metaWeblog_getCategories_sig,
				"docstring" => $f_metaWeblog_getCategories_doc
			 ),	

			 "metaWeblog.getPost" =>
			 array(
				"function" => "f_metaWeblog_getPost",
				"signature" => $f_metaWeblog_getPost_sig,
				"docstring" => $f_metaWeblog_getPost_doc
			 ),	

			 "metaWeblog.editPost" =>
			 array(
				"function" => "f_metaWeblog_editPost",
				"signature" => $f_metaWeblog_editPost_sig,
				"docstring" => $f_metaWeblog_editPost_doc
			 )
		
		)
	);
?>