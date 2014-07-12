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
global $SQL_DBH;
$SQL_DBH = NULL;

if (!function_exists('sql_fetch_assoc'))
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
		<?php	exit;
	}
	
	/**
	  * Connects to mysql server
	  */
	function sql_connect_args($mysql_host = 'localhost', $mysql_user = '', $mysql_password = '', $mysql_database = '') {
		global $MYSQL_HANDLER;
		
		try {
			if (strpos($mysql_host,':') === false) {
				$host = $mysql_host;
				$port = '';
				$portnum = '';
			}
			else {
				list($host,$port) = explode(":",$mysql_host);
				if (isset($port)) {
					$portnum = $port;
					$port = ';port='.trim($port);
				}
				else {
					$port = '';
					$portnum = '';
				}
			}
			
			switch ($MYSQL_HANDLER[1]) {
				case 'sybase':
				case 'dblib':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$mysql_database, $mysql_user, $mysql_password);
				break;
				case 'mssql':
					if (is_numeric($portnum)) $port = ','.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$mysql_database, $mysql_user, $mysql_password);
				break;
				case 'oci':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':dbname=//'.$host.$port.'/'.$mysql_database, $mysql_user, $mysql_password);
				break;
				case 'odbc':
					if (is_numeric($portnum)) $port = ';PORT='.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$mysql_database.';PROTOCOL=TCPIP;UID='.$mysql_user.';PWD='.$mysql_password);

				break;
				case 'pgsql':
					if (is_numeric($portnum)) $port = ';port='.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$mysql_database, $mysql_user, $mysql_password);
				break;
				case 'sqlite':
				case 'sqlite2':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$DBH = new PDO($MYSQL_HANDLER[1].':'.$mysql_database, $mysql_user, $mysql_password);
				break;
				default:
					//mysql
					$DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$mysql_database, $mysql_user, $mysql_password);
				break;
			}
	
			
						
		} catch (PDOException $e) {
			$DBH =NULL;
			startUpError('<p>a1 Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
		}
//echo '<hr />DBH: '.print_r($DBH,true).'<hr />';		
		return $DBH;
	}
	
	/**
	  * Connects to mysql server
	  */
	function sql_connect() {
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
		$SQL_DBH = NULL;
		try {
			if (strpos($MYSQL_HOST,':') === false) {
				$host = $MYSQL_HOST;
				$port = '';
			}
			else {
				list($host,$port) = explode(":",$MYSQL_HOST);
				if (isset($port)) {
					$portnum = $port;
					$port = ';port='.trim($port);
				}
				else {
					$port = '';
					$portnum = '';
				}
			}
			
			switch ($MYSQL_HANDLER[1]) {
				case 'sybase':
				case 'dblib':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
				case 'mssql':
					if (is_numeric($portnum)) $port = ','.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
				case 'oci':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':dbname=//'.$host.$port.'/'.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
				case 'odbc':
					if (is_numeric($portnum)) $port = ';PORT='.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$MYSQL_DATABASE.';PROTOCOL=TCPIP;UID='.$MYSQL_USER.';PWD='.$MYSQL_PASSWORD);

				break;
				case 'pgsql':
					if (is_numeric($portnum)) $port = ';port='.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
				case 'sqlite':
				case 'sqlite2':
					if (is_numeric($portnum)) $port = ':'.intval($portnum);
					else $port = '';
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':'.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
				default:
					//mysql
					$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
				break;
			}
			
			//$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$MYSQL_DATABASE, $MYSQL_USER, $MYSQL_PASSWORD);
						
		} catch (PDOException $e) {
			$SQL_DBH = NULL;
			startUpError('<p>a2 Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
		}
//		echo '<hr />DBH: '.print_r($SQL_DBH,true).'<hr />';		
		$MYSQL_CONN &= $SQL_DBH;
		return $SQL_DBH;

	}

	/**
	  * disconnects from SQL server
	  */
	function sql_disconnect(&$dbh=NULL) {
		global $SQL_DBH;
		if (is_null($dbh)) $SQL_DBH = NULL;
		else $dbh = NULL;
	}
	
	function sql_close(&$dbh=NULL) {
		global $SQL_DBH;
		if (is_null($dbh)) $SQL_DBH = NULL;
		else $dbh = NULL;
	}
	
	/**
	  * executes an SQL query
	  */
	function sql_query($query,$dbh=NULL) {
		global $SQLCount,$SQL_DBH;
		$SQLCount++;
//echo '<hr />SQL_DBH: ';
//print_r($SQL_DBH);
//echo '<hr />DBH: ';
//print_r($dbh);
//echo '<hr />';
//echo $query.'<hr />';
		if (is_null($dbh)) $res = $SQL_DBH->query($query);
		else $res = $dbh->query($query);
		if ($res->errorCode() != '00000') {
			$errors = $res->errorInfo();
			print("SQL error with query $query: " . $errors[0].'-'.$errors[1].' '.$errors[2] . '<p />');
		}
		
		return $res;
	}
	
	/**
	  * executes an SQL error
	  */
	function sql_error($dbh=NULL)
	{
		global $SQL_DBH;
		if (is_null($dbh)) $error = $SQL_DBH->errorInfo();
		else $error = $dbh->errorInfo();
		if ($error[0] != '00000') {
			return $error[0].'-'.$error[1].' '.$error[2];
		}
		else return '';
	}
	
	/**
	  * executes an SQL db select
	  */
	function sql_select_db($db,&$dbh=NULL)
	{
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
//echo '<hr />'.print_r($dbh,true).'<hr />';
//exit;
		if (is_null($dbh)) { 
			try {
				$SQL_DBH = NULL;
				list($host,$port) = explode(":",$MYSQL_HOST);
				if (isset($port)) {
					$portnum = $port;
					$port = ';port='.trim($port);
				}
				else {
					$port = '';
					$portnum = '';
				}
				//$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.trim($host).$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
				//$SQL_DBH = sql_connect();
				switch ($MYSQL_HANDLER[1]) {
					case 'sybase':
					case 'dblib':
						if (is_numeric($portnum)) $port = ':'.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
					case 'mssql':
						if (is_numeric($portnum)) $port = ','.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
					case 'oci':
						if (is_numeric($portnum)) $port = ':'.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':dbname=//'.$host.$port.'/'.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
					case 'odbc':
						if (is_numeric($portnum)) $port = ';PORT='.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$db.';PROTOCOL=TCPIP;UID='.$MYSQL_USER.';PWD='.$MYSQL_PASSWORD);

					break;
					case 'pgsql':
						if (is_numeric($portnum)) $port = ';port='.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
					case 'sqlite':
					case 'sqlite2':
						if (is_numeric($portnum)) $port = ':'.intval($portnum);
						else $port = '';
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':'.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
					default:
						//mysql
						$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
					break;
				}
				return 1;
			} catch (PDOException $e) {
				startUpError('<p>a3 Error!: ' . $e->getMessage() . '</p>', 'Connect Error');
				return 0;
			}
		}
		else {
			if ($dbh->exec("USE $db") !== false) return 1;
			else return 0;
		}
	}
	
	/**
	  * executes an SQL real escape 
	  */
	function sql_real_escape_string($val,$dbh=NULL)
	{
		return addslashes($val);
	}
	
	/**
	  * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed 
	  */
	function sql_quote_string($val,$dbh=NULL) {
		global $SQL_DBH;
		if (is_null($dbh))
			return $SQL_DBH->quote($val);
		else
			return $dbh->quote($val);
	}
	
	/**
	  * executes an SQL insert id
	  */
	function sql_insert_id($dbh=NULL)
	{	
		global $SQL_DBH;
		if (is_null($dbh))
			return $SQL_DBH->lastInsertId();
		else
			return $dbh->lastInsertId();
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
	function sql_stat($dbh=NULL)
	{
		//not implemented
		global $SQL_DBH;
		if (is_null($dbh))
			return '';
		else
			return '';
	}
	
	/**
	  * Returns the name of the character set
	  */
	function sql_client_encoding($dbh=NULL)
	{
		//not implemented
		global $SQL_DBH;
		if (is_null($dbh))
			return '';
		else
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
	function sql_get_server_info($dbh=NULL)
	{
		global $SQL_DBH;
		if (is_null($dbh))
			return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
		else
			return $dbh->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
	}
	
	/**
	  * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
	  */
	function sql_get_host_info($dbh=NULL)
	{
		global $SQL_DBH;
		if (is_null($dbh))
			return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
		else
			return $dbh->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
	}
	
	/**
	  * Returns the SQL protocol on success, or FALSE on failure. 
	  */
	function sql_get_proto_info($dbh=NULL)
	{
		//not implemented
		global $SQL_DBH;
		if (is_null($dbh))
			return false;
		else
			return false;
	}

    /**
     * Get the name of the specified field in a result
     */
    function sql_field_name($res, $offset = 0)
    {
        $column = $res->getColumnMeta($offset);
        if ($column) {
            return $column['name'];
        }
        return false;
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