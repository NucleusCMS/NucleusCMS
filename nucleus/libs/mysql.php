<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * if no mysql_* functions exist, define wrappers
 */
 
$MYSQL_CONN = 0;

if (!function_exists('mysql_query'))
{
	if (!function_exists('mysqli_query') && function_exists('startUpError'))
	{
		startUpError(_NO_SUITABLE_MYSQL_LIBRARY);
	}

	define('_EXT_MYSQL_EMULATE' , 1);
	
	define('MYSQL_ASSOC' , 1);
	define('MYSQL_NUM'   , 2);
	define('MYSQL_BOTH'  , 3);
	
	function mysql_query($query) 
	{
		global $MYSQL_CONN;
		return mysqli_query($MYSQL_CONN, $query); 
	}
	
	function mysql_fetch_object($res) 
	{ 
		return mysqli_fetch_object($res);
	}
	
	function mysql_fetch_array($res , $result_type = MYSQL_BOTH)
	{
		return mysqli_fetch_array($res, $result_type);
		// MYSQLI_ASSOC = MYSQL_ASSOC  : 1
		// MYSQLI_NUM   = MYSQL_NUM    : 2
		// MYSQLI_BOTH  = MYSQL_BOTH   : 3
	}	
	
	function mysql_fetch_assoc($res) 
	{ 
		return mysqli_fetch_assoc($res);
	}

	function mysql_fetch_row($res) 
	{ 
		return mysqli_fetch_row($res);
	}

	function mysql_num_rows($res)
	{
		return mysqli_num_rows($res);
	}
	
	function mysql_num_fields($res)
	{
		return mysqli_num_fields($res);
	}
	
	function mysql_free_result($res)
	{
		return mysqli_free_result($res);
	}
	
	function mysql_result($res, $row, $col=0)
	{
		$row = intval($row);
		if (($row < 0) || ($col < 0)) {
			return false;
		}

		if ($row)
		{
			if (!mysqli_data_seek($res, $row))
				return false;
		}
		$data = mysqli_fetch_row($res);
		if (!$data)
			return false;
		return (isset($data[$col]) ? $data[$col] : false);
	}
	
	function mysql_connect($host, $username, $pwd)
	{
		return mysqli_connect($host, $username, $pwd);
	}
	
	function mysql_error()
	{
		global $MYSQL_CONN;
		return mysqli_error($MYSQL_CONN);
	}
	
	function mysql_select_db($db)
	{
		global $MYSQL_CONN;
		return mysqli_select_db($MYSQL_CONN, $db);
	}
	
	function mysql_close()
	{
		global $MYSQL_CONN;
		return mysqli_close($MYSQL_CONN);
	}
	
	function mysql_insert_id()
	{
		global $MYSQL_CONN;
		return mysqli_insert_id($MYSQL_CONN);
	}
	
	function mysql_affected_rows()
	{
		global $MYSQL_CONN;
		return mysqli_affected_rows($MYSQL_CONN);
	}

	function mysql_real_escape_string($val)
	{
		global $MYSQL_CONN;
		return mysqli_real_escape_string($MYSQL_CONN,$val);
	}

	function mysql_get_client_info() {
		return mysqli_get_client_info();
	};

	function mysql_get_server_info($res = NULL) {
		global $MYSQL_CONN;
		return mysqli_get_server_info( $res ?  $res : $MYSQL_CONN );
	};

	function mysql_errno($res = NULL) {
		global $MYSQL_CONN;
		return mysqli_errno( $res ?  $res : $MYSQL_CONN );
	};

	function mysql_set_charset($charset , $res = NULL ) {
		global $MYSQL_CONN;
		return mysqli_set_charset( $res ?  $res : $MYSQL_CONN , $charset);
	};

	function mysql_fetch_field($res , $offset  = 0 )
	{
		global $MYSQL_CONN;
		if ($res || $MYSQL_CONN)
		{
			$offset = intval($offset);
			$finfo = mysqli_fetch_fields($res ? $res : $MYSQL_CONN);
			// todo: convert
			if (is_array($finfo)) {
				if ($offset>=0 && $offset<count($finfo)) {
					return $finfo[$offset];
				}
				return false;
			}
		}
		return false;
	}

	function mysql_field_name($res, $offset = 0)
	{
		global $MYSQL_CONN;
		if ($res || $MYSQL_CONN)
		{
			$finfo = mysqli_fetch_fields( $res ?  $res : $MYSQL_CONN);
			if ($finfo && isset($finfo[$offset]))
				return $finfo[$offset]->name;
		}
		return false;
	}

	if (!defined('MYSQLI_TYPE_BIT')) define('MYSQLI_TYPE_BIT', 16);
	if (!defined('MYSQLI_TYPE_TINY')) define('MYSQLI_TYPE_TINY', 1);
	if (!defined('MYSQLI_TYPE_NEWDECIMAL')) define('MYSQLI_TYPE_NEWDECIMAL', 246);
	if (!defined('MYSQLI_TYPE_YEAR')) define('MYSQLI_TYPE_YEAR', 13);
	if (!defined('MYSQLI_TYPE_NEWDATE')) define('MYSQLI_TYPE_NEWDATE', 14);
	if (!defined('MYSQLI_TYPE_GEOMETRY')) define('MYSQLI_TYPE_GEOMETRY', 255);

	function convert_mysqlFieldType_from_mysqliFieldType($type)
	{
		// php-src/ext/mysql/php_mysql.c :: php_mysql_get_field_name
		// php-src/ext/mysqlnd/mysqlnd_enum_n_def.h :: enum mysqlnd_field_types
		// php-src/ext/mysqli/mysqli.c :: MYSQLI_TYPE_
		// C lang : MYSQLI_TYPE_ = FIELD_TYPE_ = MYSQL_TYPE_

		switch($type) {
			case MYSQLI_TYPE_STRING:
			case MYSQLI_TYPE_VAR_STRING:
				return "string";
				break;
			case MYSQLI_TYPE_BIT:
			case MYSQLI_TYPE_INT24:
			case MYSQLI_TYPE_LONG:
			case MYSQLI_TYPE_LONGLONG:
			case MYSQLI_TYPE_SHORT:
			case MYSQLI_TYPE_TINY:
				return "int";
				break;
			case MYSQLI_TYPE_DECIMAL:
			case MYSQLI_TYPE_DOUBLE:
			case MYSQLI_TYPE_FLOAT:
			case MYSQLI_TYPE_NEWDECIMAL:
				return "real";
				break;
			case MYSQLI_TYPE_TIMESTAMP:
				return "timestamp";
				break;
			case MYSQLI_TYPE_YEAR:
				return "year";
				break;
			case MYSQLI_TYPE_DATE:
			case MYSQLI_TYPE_NEWDATE:
				return "date";
				break;
			case MYSQLI_TYPE_DATETIME:
				return "datetime";
				break;
			case MYSQLI_TYPE_TIME:
				return "time";
				break;
			case MYSQLI_TYPE_BLOB:
			case MYSQLI_TYPE_LONG_BLOB:
			case MYSQLI_TYPE_MEDIUM_BLOB:
			case MYSQLI_TYPE_TINY_BLOB:
				return "blob";
				break;
			case MYSQLI_TYPE_SET:
				return "set";
				break;
			case MYSQLI_TYPE_ENUM:
				return "enum";
				break;
			case MYSQLI_TYPE_GEOMETRY:
				return "geometry";
				break;
			case MYSQLI_TYPE_NULL:
				return "null";
				break;
			default:
				return "unknown";
				break;
		}
	}

	function mysql_field_type($res, $offset = 0)
	{
		// mysql_field_type : string
		// mysqli_fetch_field_direct ->type : int
		global $MYSQL_CONN;
		if ($res || $MYSQL_CONN)
		{
			$finfo = mysqli_fetch_field_direct( $res ?  $res : $MYSQL_CONN, $offset);
			if (is_object($finfo) && isset($finfo->type))
				return convert_mysqlFieldType_from_mysqliFieldType($finfo->type);
		}
		return false;
	}

	function mysql_thread_id($res = NULL) {
		global $MYSQL_CONN;
		$link = ($res ? $res : $MYSQL_CONN);
		return ($link ? mysqli_thread_id($link) : false);
	}

	function mysql_client_encoding($res = NULL) {
		global $MYSQL_CONN;
		if ($res || $MYSQL_CONN)
		{
			return mysqli_character_set_name($res ? $res : $MYSQL_CONN);
			// mysqli_client_encoding : DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
		}
		return false;
	}

	function mysql_data_seek($res, $offset)
	{
		if (func_num_args() != 2)
			trigger_error('argument must be two', E_USER_ERROR);
		return  ($res ? mysqli_data_seek($res, $offset) : false);
	}

	function mysql_get_host_info($res = NULL)
	{
		global $MYSQL_CONN;
		$link = ($res ? $res : $MYSQL_CONN);
		return ($link ?  mysqli_get_host_info($link) : false);
	}

	function mysql_get_proto_info($res = NULL)
	{
		global $MYSQL_CONN;
		$link = ($res ? $res : $MYSQL_CONN);
		return ($link ?  mysqli_get_proto_info($link) : false);
	}

	function mysql_stat($res = NULL)
	{
		global $MYSQL_CONN;
		$link = ($res ? $res : $MYSQL_CONN);
		return ($link ?  mysqli_stat($link) : NULL);
	}
}
else
{
	define('_EXT_MYSQL_EMULATE' , 0);
}
?>