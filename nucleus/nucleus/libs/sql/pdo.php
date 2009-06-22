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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: mysql.php 1279 2008-10-23 08:18:26Z shizuki $
 */
 
/*
 * complete sql_* wrappers for mysql functions
 *
 * functions moved from globalfunctions.php: sql_connect, sql_disconnect, sql_query
 */
 
$MYSQL_CONN = 0;
global $SQL_DBH;
$SQL_DBH = NULL;

if (function_exists('mysql_query') && !function_exists('sql_fetch_assoc'))
{
	/**
	  * Connects to mysql server
	  */
	function sql_connect_args($mysql_host, $mysql_user, $mysql_password) {
		global $MYSQL_HANDLER;
		
		try {
			if (strpos($mysql_host,':') === false) {
				$host = $mysql_host;
				$port = '';
			}
			else {
				list($host,$port) = explode(":",$mysql_host);
				if (isset($port)) 
					$port = ';port='.trim($port);
				else
					$port = '';
			}
			
			$DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port, $mysql_user, $mysql_password);
						
		} catch (PDOException $e) {
			startUpError('<p>Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
		}
		
		return $DBH;

	}
	
	/**
	  * Connects to mysql server
	  */
	function sql_connect() {
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
		
		try {
			if (strpos($MYSQL_HOST,':') === false) {
				$host = $MYSQL_HOST;
				$port = '';
			}
			else {
				list($host,$port) = explode(":",$MYSQL_HOST);
				if (isset($port)) 
					$port = ';port='.trim($port);
				else
					$port = '';
			}
			
			$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
						
		} catch (PDOException $e) {
			startUpError('<p>Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
		}
		
		return $MYSQL_CONN;

	}

	/**
	  * disconnects from SQL server
	  */
	function sql_disconnect() {
		global $SQL_DBH;
		$SQL_DBH = NULL;
	}
	
	function sql_close() {
		global $SQL_DBH;
		$SQL_DBH = NULL;
	}
	
	/**
	  * executes an SQL query
	  */
	function sql_query($query) {
		global $SQLCount,$SQL_DBH;
		$SQLCount++;
		$res = $SQL_DBH->query($query);
		if ($res->errorCode() != '00000') {
			$errors = $res->errorInfo();
		}
		
		return $res;
	}
	
	/**
	  * executes an SQL error
	  */
	function sql_error()
	{
		return '';
	}
	
	/**
	  * executes an SQL db select
	  */
	function sql_select_db($db)
	{
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
		$SQL_DBH = NULL;
		try {
			list($host,$port) = explode(":",$MYSQL_HOST);
			if (isset($port)) 
				$port = ';port='.trim($port);
			else
				$port = '';
			$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.trim($host).$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
			
		} catch (PDOException $e) {
			startUpError('<p>Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
		}
	}
	
	/**
	  * executes an SQL real escape 
	  */
	function sql_real_escape_string($val)
	{
		return addslashes($val);
	}
	
	/**
	  * executes an SQL insert id
	  */
	function sql_insert_id()
	{	
		global $SQL_DBH;
		
		return $SQL_DBH->lastInsertId();
	}
	
	/**
	  * executes an SQL result request
	  */
	function sql_result($res, $row = 0, $col = 0)
	{
		$results = array();
		if (intval($row) < 1) {
			$results = $res->fetch(PDO::FETCH_BOTH);
			return $results[$col];
		}
		else {
			for ($i = 0; $i < intval($row); $i++) {
				$results = $res->fetch(PDO::FETCH_BOTH);
			}
			$results = $res->fetch(PDO::FETCH_BOTH);
			return $results[$col];
		}
	}
	
	/**
	  * frees sql result resources
	  */
	function sql_free_result($res)
	{
		$res = NULL;
		return true;
	}
	
	/**
	  * returns number of rows in SQL result
	  */
	function sql_num_rows($res)
	{
		return $res->rowCount();
	}
	
	/**
	  * returns number of rows affected by SQL query
	  */
	function sql_affected_rows($res)
	{
		return $res->rowCount();
	}
	
	/**
	  * Get number of fields in result
	  */
	function sql_num_fields($res)
	{
		return $res->columnCount();
	}
	
	/**
	  * fetches next row of SQL result as an associative array
	  */
	function sql_fetch_assoc($res)
	{
		$results = array();
		$results = $res->fetch(PDO::FETCH_ASSOC);	
		return $results;
	}
	
	/**
	  * Fetch a result row as an associative array, a numeric array, or both
	  */
	function sql_fetch_array($res)
	{
		$results = array();
		$results = $res->fetch(PDO::FETCH_BOTH);
		return $results;
	}
	
	/**
	  * fetches next row of SQL result as an object
	  */
	function sql_fetch_object($res)
	{
		$results = NULL;
		$results = $res->fetchObject();	
		return $results;
	}
	
	/**
	  * Get a result row as an enumerated array
	  */
	function sql_fetch_row($res)
	{
		$results = array();
		$results = $res->fetch(PDO::FETCH_NUM);	
		return $results;
	}
	
	/**
	  * Get column information from a result and return as an object
	  */
	function sql_fetch_field($res,$offset = 0)
	{
		$results = array();
		$obj = NULL;
		$results = $res->getColumnMeta($offset);
		foreach($results as $key=>$value) {
			$obj->$key = $value;
		}
		return $obj;
	}
	
	/**
	  * Get current system status (returns string)
	  */
	function sql_stat()
	{
		//not implemented
		return '';
	}
	
	/**
	  * Returns the name of the character set
	  */
	function sql_client_encoding()
	{
		//not implemented
		return '';
	}
	
	/**
	  * Get SQL client version
	  */
	function sql_get_client_info()
	{
		global $SQL_DBH;
		return $SQL_DBH->getAttribute(constant("PDO::ATTR_CLIENT_VERSION"));
	}
	
	/**
	  * Get SQL server version
	  */
	function sql_get_server_info()
	{
		global $SQL_DBH;
		return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
	}
	
	/**
	  * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
	  */
	function sql_get_host_info()
	{
		global $SQL_DBH;
		return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
	}
	
	/**
	  * Returns the SQL protocol on success, or FALSE on failure. 
	  */
	function sql_get_proto_info()
	{
		//not implemented
		return '';
	}

}

/**************************************************************************
	Unimplemented mysql_* functions
	
# mysql_ change_ user
# mysql_ create_ db
# mysql_ data_ seek
# mysql_ db_ name
# mysql_ db_ query
# mysql_ drop_ db
# mysql_ errno
# mysql_ escape_ string
# mysql_ fetch_ lengths
# mysql_ field_ flags
# mysql_ field_ len
# mysql_ field_ name
# mysql_ field_ seek
# mysql_ field_ table
# mysql_ field_ type
# mysql_ info
# mysql_ list_ dbs
# mysql_ list_ fields
# mysql_ list_ processes
# mysql_ list_ tables
# mysql_ pconnect
# mysql_ ping
# mysql_ set_ charset
# mysql_ tablename
# mysql_ thread_ id
# mysql_ unbuffered_ query
*******************************************************************/



?>