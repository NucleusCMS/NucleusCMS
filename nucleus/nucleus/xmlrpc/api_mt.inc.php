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
				new xmlrpcval('mt.getCategoryList', 'string')								
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
				"docstring" => $f_mt_getCategoryList_doc)				
		)
	);
	
	
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
					"categoryId" => new xmlrpcval($obj->catid,"string")
				)
			,'struct');
			
		}
		
		
		return new xmlrpcresp(new xmlrpcval( $categorystruct , "array"));
	
	}
	


?>