<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2012 The Nucleus Group
 * @version $Id$
 */

/*
 * sql_* wrappers for DB class access
 */
if ( !class_exists('DB') )
{
	include_once realpath(dirname(__FILE__)) . '/DB.php';
}

/**
 * Connects to database server with arguments
 * @deprecated
 */
function sql_connect_args($host = 'localhost', $user = '', $password = '', $database = '', $new_link = FALSE)
{
	global $MYSQL_HANDLER;
	return DB::setConnectionInfo($MYSQL_HANDLER[1], $host, $user, $password, $database);
}

/**
 * Connects to database server
 * @deprecated
 */
function sql_connect()
{
	global $MYSQL_HANDLER, $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE;

	return DB::setConnectionInfo($MYSQL_HANDLER[1], $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);
}

/**
 * disconnects from SQL server
 * @deprecated
 */
function sql_disconnect($conn = false)
{
	DB::disConnect();
}

/**
 * disconnects from SQL server
 * @deprecated
 * @param unknown_type $conn
 */
function sql_close($conn = false)
{
	DB::disConnect();
}

/**
 * executes an SQL query
 * @deprecated
 */
function sql_query($query, $conn = false)
{
	global $mysql_affected_row;
	$mysql_affected_row = -1;
	if ( preg_match('/^\W*(INSERT|UPDATE|DELETE|DROP)/i', $query) )
	{
		$mysql_affected_row = DB::execute($query);
		return $mysql_affected_row !== FALSE ? TRUE : FALSE;
	}
	return DB::getResult($query);
}

/**
 * executes an SQL error
 * @deprecated
 */
function sql_error($conn = false)
{
	$err = DB::getError();
	return $err[2];
}

/**
 * executes an SQL db select
 * @deprecated
 */
function sql_select_db($db, $conn = false)
{
	sql_disconnect();
	return sql_connect();
}

/**
 * executes an SQL real escape
 * @deprecated
 */
function sql_real_escape_string($val, $conn = false)
{
	if ( is_numeric($val) )
	{
		return $val;
	}
	$escapeval = DB::quoteValue($val);
	if ( preg_match("/^'(.*)'$/", $escapeval, $matches) )
	{
		$escapeval = $matches[1];
	}
	return $escapeval;
}

/**
 * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed
 * @deprecated
 */
function sql_quote_string($val, $conn = false)
{
	if ( is_numeric($val) )
	{
		return $val;
	}
	return DB::quoteValue($val);
}

/**
 * executes an SQL insert id
 * @deprecated
 */
function sql_insert_id($conn = false)
{
	return DB::getInsertId();
}

/**
 * executes an SQL result request
 * @deprecated
 */
function sql_result($res, $row, $col)
{
	if ( !method_exists($res, 'fetch') ) return FALSE;
	for ( $i = 0; $i < $row; $i++ )
		$res->fetch();
	return $res->fetchColumn($col);
}

/**
 * frees sql result resources
 * @deprecated
 */
function sql_free_result($res)
{
	if ( !method_exists($res, 'closeCursor') ) return FALSE;
	return $res->closeCursor();
}

/**
 * returns number of rows in SQL result
 * @deprecated
 */
function sql_num_rows($res)
{
	if ( !method_exists($res, 'rowCount') ) return FALSE;
	return $res->rowCount();
}

/**
 * returns number of rows affected by SQL query
 * @deprecated
 */
function sql_affected_rows($conn = false)
{
	global $mysql_affected_row;
	return $mysql_affected_row;
}

/**
 * Get number of fields in result
 * @deprecated
 */
function sql_num_fields($res)
{
	if ( !method_exists($res, 'columnCount') ) return FALSE;
	return $res->columnCount();
}

/**
 * fetches next row of SQL result as an associative array
 * @deprecated
 */
function sql_fetch_assoc($res)
{
	if ( !method_exists($res, 'fetch') ) return FALSE;
	return $res->fetch(PDO::FETCH_ASSOC);
}

/**
 * Fetch a result row as an associative array, a numeric array, or both
 * @deprecated
 */
function sql_fetch_array($res)
{
	if ( !method_exists($res, 'fetch') ) return FALSE;
	return $res->fetch(PDO::FETCH_BOTH);
}

/**
 * fetches next row of SQL result as an object
 * @deprecated
 */
function sql_fetch_object($res)
{
	if ( !method_exists($res, 'fetch') ) return FALSE;
	return $res->fetch(PDO::FETCH_OBJ);
}

/**
 * Get a result row as an enumerated array
 * @deprecated
 */
function sql_fetch_row($res)
{
	if ( !method_exists($res, 'fetch') ) return FALSE;
	return $res->fetch(PDO::FETCH_NUM);
}

/**
 * Get column information from a result and return as an object
 * @deprecated
 */
function sql_fetch_field($res, $offset = 0)
{
	return FALSE;
}

/**
 * Get current system status (returns string)
 * @deprecated
 */
function sql_stat($conn = false)
{
	return FALSE;
}

/**
 * Returns the name of the character set
 * @deprecated
 */
function sql_client_encoding($conn = false)
{
	return FALSE;
}

/**
 * Get SQL client version
 * @deprecated
 */
function sql_get_client_info()
{
	return DB::getAttribute(PDO::ATTR_CLIENT_VERSION);
}

/**
 * Get SQL server version
 * @deprecated
 */
function sql_get_server_info($conn = false)
{
	return DB::getAttribute(PDO::ATTR_SERVER_VERSION);
}

/**
 * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
 * @deprecated
 */
function sql_get_host_info($conn = false)
{
	return FALSE;
}

/**
 * Returns the SQL protocol on success, or FALSE on failure.
 * @deprecated
 */
function sql_get_proto_info($conn = false)
{
	return FALSE;
}

/**
 * Get the name of the specified field in a result
 * @deprecated
 */
function sql_field_name($res, $offset = 0)
{
	if ( !method_exists($res, 'getColumnMeta') ) return FALSE;
	$column = $res->getColumnMeta($offset);
	return $column['name'];
}

/**
 * Set character encodings in each fields related to MySQL connection.
 * @deprecated
 */
function sql_set_charset($charset)
{
	return TRUE;
}
