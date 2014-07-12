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
 
/*
 * complete sql_* wrappers for mysql functions
 *
 * functions moved from globalfunctions.php: sql_connect, sql_disconnect, sql_query
 */


$MYSQL_CONN = 0;

if (function_exists('mysql_query') && !function_exists('sql_fetch_assoc'))
{
	/**
	 * Errors before the database connection has been made
	 */
	function startUpError($msg, $title) {
		?>
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head><title><?php echo htmlspecialchars($title,ENT_QUOTES,_CHARSET)?></title></head>
			<body>
				<h1><?php echo htmlspecialchars($title,ENT_QUOTES,_CHARSET)?></h1>
				<?php echo $msg?>
			</body>
		</html>
<?php
		exit;
	}
	
	/**
	  * Connects to mysql server with arguments
	  */
	function sql_connect_args($mysql_host = 'localhost', $mysql_user = '', $mysql_password = '', $mysql_database = '') {
		
		$CONN = mysql_connect($mysql_host, $mysql_user, $mysql_password); 
		if ($mysql_database) mysql_select_db($mysql_database,$CONN);

		return $CONN;
	}
	
	/**
	  * Connects to mysql server
	  */
	function sql_connect() {
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN;

		$MYSQL_CONN = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD) or startUpError('<p>Could not connect to MySQL database.</p>', 'Connect Error');
		mysql_select_db($MYSQL_DATABASE) or startUpError('<p>Could not select database: ' . mysql_error() . '</p>', 'Connect Error');

		return $MYSQL_CONN;
	}

	/**
	  * disconnects from SQL server
	  */
	function sql_disconnect($conn = false) {
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		mysql_close($conn);
	}
	
	function sql_close($conn = false) {
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		mysql_close($conn);
	}
	
	/**
	  * executes an SQL query
	  */
	function sql_query($query,$conn = false) {
		global $SQLCount,$MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		$SQLCount++;
		$res = mysql_query($query,$conn) or print("mySQL error with query $query: " . mysql_error($conn) . '<p />');
		return $res;
	}
	
	/**
	  * executes an SQL error
	  */
	function sql_error($conn = false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_error($conn);
	}
	
	/**
	  * executes an SQL db select
	  */
	function sql_select_db($db,$conn = false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_select_db($db,$conn);
	}
	
	/**
	  * executes an SQL real escape 
	  */
	function sql_real_escape_string($val,$conn = false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_real_escape_string($val,$conn);
	}
	
	/**
	  * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed 
	  */
	function sql_quote_string($val,$conn = false) {
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return "'".mysql_real_escape_string($val,$conn)."'";
	}
	
	/**
	  * executes an SQL insert id
	  */
	function sql_insert_id($conn = false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_insert_id($conn);
	}
	
	/**
	  * executes an SQL result request
	  */
	function sql_result($res, $row, $col)
	{
		return mysql_result($res,$row,$col);
	}
	
	/**
	  * frees sql result resources
	  */
	function sql_free_result($res)
	{
		return mysql_free_result($res);
	}
	
	/**
	  * returns number of rows in SQL result
	  */
	function sql_num_rows($res)
	{
		return mysql_num_rows($res);
	}
	
	/**
	  * returns number of rows affected by SQL query
	  */
	function sql_affected_rows($conn = false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_affected_rows($conn);
	}
	
	/**
	  * Get number of fields in result
	  */
	function sql_num_fields($res)
	{
		return mysql_num_fields($res);
	}
	
	/**
	  * fetches next row of SQL result as an associative array
	  */
	function sql_fetch_assoc($res)
	{
		return mysql_fetch_assoc($res);
	}
	
	/**
	  * Fetch a result row as an associative array, a numeric array, or both
	  */
	function sql_fetch_array($res)
	{
		return mysql_fetch_array($res);
	}
	
	/**
	  * fetches next row of SQL result as an object
	  */
	function sql_fetch_object($res)
	{
		return mysql_fetch_object($res);
	}
	
	/**
	  * Get a result row as an enumerated array
	  */
	function sql_fetch_row($res)
	{
		return mysql_fetch_row($res);
	}
	
	/**
	  * Get column information from a result and return as an object
	  */
	function sql_fetch_field($res,$offset = 0)
	{
		return mysql_fetch_field($res,$offset);
	}
	
	/**
	  * Get current system status (returns string)
	  */
	function sql_stat($conn=false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_stat($conn);
	}
	
	/**
	  * Returns the name of the character set
	  */
	function sql_client_encoding($conn=false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_client_encoding($conn);
	}
	
	/**
	  * Get SQL client version
	  */
	function sql_get_client_info()
	{
		return mysql_get_client_info();
	}
	
	/**
	  * Get SQL server version
	  */
	function sql_get_server_info($conn=false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_get_server_info($conn);
	}
	
	/**
	  * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
	  */
	function sql_get_host_info($conn=false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_get_host_info($conn);
	}
	
	/**
	  * Returns the SQL protocol on success, or FALSE on failure. 
	  */
	function sql_get_proto_info($conn=false)
	{
		global $MYSQL_CONN;
		if (!$conn) $conn = $MYSQL_CONN;
		return mysql_get_proto_info($conn);
	}

    /**
     * Get the name of the specified field in a result
     */
    function sql_field_name($res, $offset = 0)
    {
        return mysql_field_name($res, $offset);
    }
	
/**************************************************************************
Unimplemented mysql_* functions

# mysql_ data_ seek (maybe useful)
# mysql_ errno (maybe useful)
# mysql_ fetch_ lengths (maybe useful)
# mysql_ field_ flags (maybe useful)
# mysql_ field_ len (maybe useful)
# mysql_ field_ seek (maybe useful)
# mysql_ field_ table (maybe useful)
# mysql_ field_ type (maybe useful)
# mysql_ info (maybe useful)
# mysql_ list_ processes (maybe useful)
# mysql_ ping (maybe useful)
# mysql_ set_ charset (maybe useful, requires php >=5.2.3 and mysql >=5.0.7)
# mysql_ thread_ id (maybe useful)

# mysql_ db_ name (useful only if working on multiple dbs which we do not do)
# mysql_ list_ dbs (useful only if working on multiple dbs which we do not do)

# mysql_ pconnect (probably not useful and could cause some unintended performance issues)
# mysql_ unbuffered_ query (possibly useful, but complicated and not supported by all database drivers (pdo))

# mysql_ change_ user (deprecated)
# mysql_ create_ db (deprecated)
# mysql_ db_ query (deprecated)
# mysql_ drop_ db (deprecated)
# mysql_ escape_ string (deprecated)
# mysql_ list_ fields (deprecated)
# mysql_ list_ tables (deprecated)
# mysql_ tablename (deprecated)

*******************************************************************/


}
?>