<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
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
    include(dirname(__FILE__) . '/sql_common_functions.php');

/**
 * Connects to mysql server
 */
    function sql_connect_args($db_host = 'localhost', $db_user = '', $db_password = '', $db_name = '') {
        global $CONF, $DB_DRIVER_NAME;

        if (!class_exists('PDO')) {
            exit('Critical error. pdo module is not loaded.');
        }
        if (!(defined('PDO::ATTR_SERVER_VERSION'))) {
            exit('The php of server does not meet the execution minimum requirement.');
        }

        try {
            if (strpos($db_host,':') === false) {
                $host = $db_host;
                $port = '';
                $portnum = '';
            }
            else {
                list($host,$port) = explode(":",$db_host);
                if (isset($port)) {
                    $portnum = $port;
                    $port = ';port='.trim($port);
                } else {
                    $port = '';
                    $portnum = '';
                }
            }

            if ($DB_DRIVER_NAME === 'sybase' || $DB_DRIVER_NAME === 'dblib') {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s'
                        , $DB_DRIVER_NAME
                        , $host
                        , is_numeric($portnum) ? ':' . (int)$portnum : ''
                        , $db_name
                    )
                    , $db_user
                    , $db_password
                );
            } elseif ($DB_DRIVER_NAME === 'mssql') {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s'
                        , $DB_DRIVER_NAME
                        , $host
                        , is_numeric($portnum) ? ',' . (int)$portnum : ''
                        , $db_name
                    )
                    , $db_user
                    , $db_password
                );
            } elseif ($DB_DRIVER_NAME === 'oci') {
                $DBH = new PDO(
                    sprintf(
                        '%s:dbname=//%s%s/%s'
                        , $DB_DRIVER_NAME
                        , $host
                        , is_numeric($portnum) ? ':' . (int)$portnum : ''
                        , $db_name
                    )
                    , $db_user
                    , $db_password
                );
            } elseif ($DB_DRIVER_NAME === 'odbc') {
                $DBH = new PDO(
                    sprintf(
                        "%s:DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=%s%s;DATABASE=%s;PROTOCOL=TCPIP;UID=%s;PWD=%s"
                        , $DB_DRIVER_NAME
                        , $host
                        , is_numeric($portnum) ? ';PORT=' . (int)$portnum : ''
                        , $db_name
                        , $db_user
                        , $db_password
                    )
                );
            } elseif ($DB_DRIVER_NAME === 'pgsql') {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s'
                        , $DB_DRIVER_NAME
                        , $host
                        , is_numeric($portnum) ? ';port=' . (int)$portnum : ''
                        , $db_name
                    )
                    , $db_user
                    , $db_password
                );
            } elseif ($DB_DRIVER_NAME === 'sqlite') {  // sqlite3
                ini_set('default_charset', "UTF-8");
                if (version_compare(PHP_VERSION, '7.1.0', '<')) {
                    $msg = 'Critical error: PHP 7.1 or higher is required.';
                    startUpError($msg, 'Connect Error');
                }

                if (!extension_loaded('PDO_SQLITE')) {
                    $msg = 'Critical error: pdo_sqlite module is not loaded.';
                    startUpError($msg, 'Connect Error');
                }

                // check file path
                $db_path = trim(dirname($db_name));
                if (strlen($db_path) == 0
                    ||
                    !is_dir($db_path)
                    ||
                    strpos(str_replace("\\", '/', $db_path), '/') === false
                ) {
                    exit('ERROR : database filename maybe wrong ');
                }

                $DBH = new PDO(
                    sprintf(
                        '%s:%s'
                        , $DB_DRIVER_NAME, $db_name)
                    , $db_user
                    , $db_password
                );
                if ($DBH) {
                    if (!class_exists('sqlite_functions')) {
                        require_once(__DIR__ . '/sqlite_functions.php');
                    } // __DIR__ : (php5.3-)
                    sqlite_functions::pdo_register_user_functions($DBH);
                    // $DBH->beginTransaction();
                }
            } elseif ($DB_DRIVER_NAME === 'sqlite2') {
                // PDO::sqliteCreateFunction does not support SQLite2
                //// trigger_error("Critical Error : sqlite2 driver is not suported. ", E_USER_ERROR);
                $msg = '<p>a1 Error!: sqlite2 driver is not supportted.</p>';
                startUpError($msg, 'Connect Error');
            } else {
                //mysql
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s'
                        , $DB_DRIVER_NAME
                        , $host
                        , $port
                        , $db_name
                    )
                    , $db_user
                    , $db_password
                );
            }

        // for mysql
            if ( $DBH && (stripos($DB_DRIVER_NAME, 'mysql') === 0) ) {
                if ($DBH && version_compare(PHP_VERSION, '5.2.0', '<' )) {
                    // HY000-2014 Cannot execute queries while other unbuffered queries are active.
                    $DBH->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                }
                if (defined('_CHARSET')) {
                    $charset  = get_mysql_charset_from_php_charset(_CHARSET);
                } else {
                    $query = sprintf("SELECT * FROM %s WHERE name='Language'", sql_table('config'));
                    $res = sql_query($query, $DBH);
                    if(!$res) exit('Language name fetch error');
                    $obj = sql_fetch_object($res);
                    $Language = $obj->value;
                    $charset = get_charname_from_langname($Language);
                    $charsetOfDB = getCharSetFromDB(sql_table('config'),'name', $DBH);
                    if ((stripos($charset, 'utf')!==FALSE) && (stripos($charsetOfDB, 'utf8')!==FALSE))
                        $charset = $charsetOfDB; // work around for utf8mb4_general_ci
                }
                sql_set_charset($charset , $DBH);
                fix_mysql_sqlmode($DBH);
            }

        } catch (PDOException $e) {
            $DBH =NULL;
            if (!($CONF['debug'])) {
                $msg = '<p>a1 Error!: ';
                $pattern = '/(Access denied for user|Unknown database|could not find driver)/i';
                if (preg_match($pattern, $e->getMessage(), $m)) {
                    $msg .= $m[1];
                }
                $msg .= '</p>';
            } else {
                $msg = '<p>a1 Error!: ' . hsc($e->getMessage()) . '</p>';
            }
            startUpError($msg , 'Connect Error');
        }
//echo '<hr />DBH: '.print_r($DBH,true).'<hr />';
        return $DBH;
    }

/**
 * Connects to mysql server
 */
    function sql_connect() {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE;
        global $MYSQL_CONN, $SQL_DBH;

        $SQL_DBH = sql_connect_args($DB_HOST , $DB_USER , $DB_PASSWORD , $DB_DATABASE);
        if ( !$SQL_DBH ) {
            $title = 'Connect Error';
            $msg = '<p>Error : Database Connection</p>';
            $msg .= sprintf('<br><p><a href="%s">%s</a></p>'
                        ,  $_SERVER['REQUEST_URI'] , 'URL');

            startUpError($msg, $title);
            exit;
        }
//        echo '<hr />DBH: '.print_r($SQL_DBH,true).'<hr />';
        unset($MYSQL_CONN);
        $MYSQL_CONN = clone $SQL_DBH;
        return $SQL_DBH;
    }

/**
 * disconnects from SQL server
 */
    function sql_disconnect(&$dbh=NULL) {
        global $SQL_DBH;
        if ($dbh === null) $SQL_DBH = NULL;
        else $dbh = NULL;
    }

    function sql_close(&$dbh=NULL) {
        global $SQL_DBH;
        if ($dbh === null) $SQL_DBH = NULL;
        else $dbh = NULL;
    }

    function sql_connected() {
        global $SQL_DBH;
        return is_object($SQL_DBH) ? true : false;
    }

/**
 * executes an SQL query
 */
    function sql_query($query,$dbh=NULL) {
        global $CONF, $SQLCount,$SQL_DBH;
        $SQLCount++;
        $debug = (!isset($CONF['debug']) || !$CONF['debug']);
        $db = ( $dbh !== null ? $dbh : $SQL_DBH );
        if (is_object($db) && ($db instanceof PDO))
            $res = $db->query($query);
        else
            $res = false;
        if (!$debug)
            return $res;

        $style = 'height:100px; overflow:auto; background:#C0DCC0';
        if ($res === false) {
            $msg_text = ((is_object($db) && ($db instanceof PDO)) ? sql_error($dbh) : 'Handle is null or not pdo object.');
            echo sprintf(
                'SQL error with query <div style="%s">%s<br />%s</div>: <p />'
                , $style
                , hsc($msg_text)
                , hsc($query)
            );
        } else if ($res->errorCode() != '00000') {
            $errors = $res->errorInfo();
            $msg_text = $errors[0].'-'.$errors[1].' '.$errors[2];
            echo sprintf(
                'SQL error with query <div style="%s">%s</div>: %s<p />'
                , $style
                , hsc($msg_text)
                , hsc($query)
            );
        }
        return $res;
    }

    function sql_query_log(&$query, $override = false)
    {
        global $SQLCount;

        if (!isset($SQLCount) || ($SQLCount == 0) )
        {
            $SQLCount = 0;
            $override = true;
        }
        $SQLCount ++;
        return ; //

        $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'query_log.txt';
        $handle = fopen($filename, ($override ? "w": "a") );
        if ($handle)
        {
            if ($_SERVER['REQUEST_TIME_FLOAT'])
            {
                $s = sprintf('tick time : %.2f , query No %d' ,
                        (float)microtime(true) - (float) $_SERVER['REQUEST_TIME_FLOAT']
                        ,$SQLCount);
                fwrite ($handle , $s."\r\n");
            }
            fwrite ($handle , "\t".preg_replace("/(\r\n|\n\r|\r|\n)/","\r\n", $query."\n") );
            fclose($handle);
        }
    }
/**
 * executes an SQL error
 */
    function sql_error($dbh=NULL)
    {
        global $SQL_DBH;
        $db = ($dbh !== null ? $dbh : $SQL_DBH);
        if ( is_object($db) )
            $error = $db->errorInfo();
        else
            $error = array('Handle is not object','','');
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
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE, $DB_DRIVER_NAME;
        global $CONF, $MYSQL_CONN, $SQL_DBH;
//echo '<hr />'.print_r($dbh,true).'<hr />';
//exit;
        if ( !is_null($dbh) )
        {
            if ($dbh->exec("USE $db") !== false)
                return 1;
            return 0;
        }

        try
        {
            $SQL_DBH = NULL;
            list($host,$port) = explode(":",$DB_HOST);
            if (isset($port)) {
                $portnum = $port;
                $port = ';port='.trim($port);
            }
            else {
                $port = '';
                $portnum = '';
            }
            //$SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.trim($host).$port.';dbname='.$db, $DB_USER, $DB_PASSWORD));
            //$SQL_DBH = sql_connect();
            switch ($DB_DRIVER_NAME) {
                case 'sybase':
                case 'dblib':
                    if (is_numeric($portnum)) $port = ':'.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db, $DB_USER, $DB_PASSWORD);
                break;
                case 'mssql':
                    if (is_numeric($portnum)) $port = ','.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db, $DB_USER, $DB_PASSWORD);
                break;
                case 'oci':
                    if (is_numeric($portnum)) $port = ':'.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':dbname=//'.$host.$port.'/'.$db, $DB_USER, $DB_PASSWORD);
                break;
                case 'odbc':
                    if (is_numeric($portnum)) $port = ';PORT='.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$db.';PROTOCOL=TCPIP;UID='.$DB_USER.';PWD='.$DB_PASSWORD);
                break;
                case 'pgsql':
                    if (is_numeric($portnum)) $port = ';port='.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db, $DB_USER, $DB_PASSWORD);
                break;
                case 'sqlite':
                    if (is_numeric($portnum)) $port = ':'.intval($portnum);
                    else $port = '';
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':'.$db, $DB_USER, $DB_PASSWORD);
                break;
                case 'sqlite2':
                    trigger_error("Critical Error : sqlite2 driver is not suported. ", E_USER_ERROR);
                    break;
                default:
                    //mysql
                    $SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db, $DB_USER, $DB_PASSWORD);
                break;
            }
            return 1;
        }
        catch (PDOException $e)
        {
            if ($CONF['debug'])
                $msg =  '<p>a3 Error!: ' . $e->getMessage() . '</p>';
            else
            {
                $msg =  '<p>a3 Error!: ';
                $pattern = '/(Access denied for user|Unknown database)/i';
                if (preg_match($pattern, $e->getMessage(), $m))
                    $msg .=  $m[1];
                $msg .=  '</p>';
            }
            startUpError($msg, 'Connect Error');
            return 0;
        }
    }

/**
 * executes an SQL real escape
 */
    function sql_real_escape_string($val,$dbh=NULL)
    {
        $s = sql_quote_string($val, $dbh);
        return (string) substr($s, 1, strlen($s) -2 );
//        return addslashes($val);
    }

/**
 * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed
 */
    function sql_quote_string($val,$dbh=NULL) {
        global $SQL_DBH;
        if ($dbh === null)
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
        if ($dbh === null)
            return $SQL_DBH->lastInsertId();
        else
            return $dbh->lastInsertId();
    }

/**
 * executes an SQL result request
 */
    function sql_result($res, $row = 0, $col = 0)
    {
        if ((int)$row < 1) {
            $results = $res->fetch(PDO::FETCH_BOTH);
            return $results[$col];
        }

        for ($i = 0, $iMax = (int)$row; $i < $iMax; $i++) {
            $res->fetch(PDO::FETCH_BOTH);
        }
        $results = $res->fetch(PDO::FETCH_BOTH);
        return $results[$col];
    }

/**
 * frees sql result resources
 */
    function sql_free_result($res)
    {
        if (is_object($res) && ($res instanceof PDOStatement))
            return $res->closeCursor();
        trigger_error('argument is not instanceof PDOStatement', E_USER_NOTICE);
        return false;
    }

/**
 * returns number of rows in SQL result
 */
    function sql_num_rows($res)
    {
        // DELETE, INSERT, UPDATE
        // do not use : SELECT
        if (is_object($res))
            return $res->rowCount();
        return 0;
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
        if ($res)
            $results = $res->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

/**
 * Fetch a result row as an associative array, a numeric array, or both
 */
    function sql_fetch_array($res)
    {
        $results = array();
        if ($res)
            $results = $res->fetch(PDO::FETCH_BOTH);
        return $results;
    }

/**
 * fetches next row of SQL result as an object
 */
    function sql_fetch_object($res)
    {
        $results = null;
        if ( $res && is_object( $res ) )
            $results = $res->fetchObject();
        return $results;
    }

/**
 * Get a result row as an enumerated array
 */
    function sql_fetch_row($res)
    {
        $results = array();
        if ($res)
            $results = $res->fetch(PDO::FETCH_NUM);
        return $results;
    }

    function sql_fetch_column($res , $column_number = 0)
    {
        if ($res)
            return $res->fetchColumn ($column_number);
        return false;
    }


/**
 * Get column information from a result and return as an object
 */
    function sql_fetch_field($res,$offset = 0)
    {
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
        if (is_null($dbh))
            return '';
        else
            return '';
    }

/**
 * Returns the array that column names of the table
 */
    function sql_getTableColumnNames($tablename)
    {
        global $SQL_DBH;
        if (!$SQL_DBH) return array();

        $drivername = $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME);
        if(strpos($tablename,'[@prefix@]')!==false) {
            $tablename = parseQuery($tablename);
        }
        if ($drivername == 'sqlite')
        {
            $sql = sprintf('PRAGMA TABLE_INFO(`%s`)', $tablename);
            $target = 'name';
        }
        else
        {
            // mysql
            $sql = sprintf('SHOW COLUMNS FROM `%s` ', $tablename);
            $target = 'Field';
        }

        $items = array();
        $res = array();
        $stmt = $SQL_DBH->prepare($sql);
        if ( $stmt && $stmt->execute() )
            $res = $stmt->fetchAll();

        foreach($res as $row) {
            if (isset($row[$target]))
                $items[] = $row[$target];
        }
        if (count($items)>0) {
            sort($items);
        }
        return $items;
    }

/**
 * Returns the boolean value that column name of the table exist or not
 */
    function sql_existTableColumnName($tablename, $ColumnName, $casesensitive=False)
    {
        $names = sql_getTableColumnNames($tablename);

        if (!$names) {
            return false;
        }

        if ($casesensitive) {
            return in_array( $ColumnName , $names );
        }

        foreach($names as $v) {
            if ( strcasecmp( $ColumnName , $v ) == 0 ) {
                return True;
            }
        }
        return False;
    }

/**
 * Returns the boolean value that column name of the table exist or not
 */
    function sql_existTableName($tablename)
    {
        global $SQL_DBH;
        if (!$SQL_DBH) return FALSE;

        $drivername = $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME);
        if(strpos($tablename,'[@prefix@]')!==false) {
            $tablename = parseQuery($tablename);
        }
        $input_parameters = array(':name' => $tablename);
        if ($drivername === 'sqlite')
        {
            $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name = :name";
        }
        else
        {
            // mysql
            $sql = 'SHOW TABLES LIKE :name ';
        }
        $res = array();
        $stmt = $SQL_DBH->prepare($sql);
        if ( $stmt && $stmt->execute($input_parameters) )
            $res = $stmt->fetch();
        if ($res && count($res)>0)
            return TRUE;
        return FALSE;
    }

/**
 * Get SQL client version
 */
    function sql_get_client_info()
    {
        global $SQL_DBH;
        return $SQL_DBH->getAttribute(constant("PDO::ATTR_CLIENT_VERSION"));
    }

    function  sql_get_db()
    {
        global $SQL_DBH;
        return $SQL_DBH;
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
# mysql_ field_ name (maybe useful)
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

    /*
     * for preventing I/O strings from auto-detecting the charactor encodings by MySQL
     * since 3.62_beta-jp
     * Jan.20, 2011 by kotorisan and cacher
     * refering to their conversation below,
     * http://japan.nucleuscms.org/bb/viewtopic.php?p=26581
     *
     * NOTE:    shift_jis is only supported for output. Using shift_jis in DB is prohibited.
     * NOTE:    iso-8859-x,windows-125x if _CHARSET is unset.
     */
    function sql_set_charset($charset, $dbh=NULL) {
        global $DB_DRIVER_NAME;
        if ( $DB_DRIVER_NAME === 'mysql' ) {
            $db = ($dbh ? $dbh : sql_get_db());
            switch(strtolower($charset)){
                case 'utf-8':
                case 'utf8':
                    $charset = 'utf8';
                    break;
                case 'utf8mb4':
                    $charset = 'utf8mb4';
                    break;
                case 'euc-jp':  // Japanese EUC-JP
                case 'ujis':
                    $charset = 'ujis';
                    break;
                case 'gb2312':
                    $charset = 'gb2312';
                    break;
                /*
                case 'shift_jis':  // Japanese Shift_JIS
                case 'sjis':
                    $charset = 'sjis';
                    break;
                */
                case 'iso-8859-1':
                    $charset='latin1';
                    break;
                default:
                    $converted = FALSE;
                    if (preg_match('#^iso-8859-(\d+)$#i', $charset, $m))
                    {
                        // ISO 8859-  2 8 7 9 13
                        $res = sql_query("SHOW CHARACTER SET where Description LIKE 'ISO 8859-${m[1]} %'", $db);
                        if ($res && ($items = sql_fetch_assoc($res)) && !empty($items['Charset']) )
                        {
                            $charset = $items['Charset'];
                            $converted = TRUE;
                        }
                    }
                    if (!$converted)
                        $charset = 'utf8';
                    break;
            }

            $res = $db->exec("SET CHARACTER SET " . $charset);
            return $res;
        }
        return TRUE;
    }

    function sql_set_charset_v2($charset, $dbh=NULL) {
        global $DB_DRIVER_NAME;
        $dbh = ($dbh ? $dbh : sql_get_db());
        if ( $DB_DRIVER_NAME == 'mysql' ) {
            $charsetOfDB = getCharSetFromDB(sql_table('config'),'name',$dbh);
            if ((stripos($charset, 'utf')!==FALSE) && (stripos($charsetOfDB, 'utf8')!==FALSE))
                $charset = $charsetOfDB; // work around for utf8mb4_general_ci
            return sql_set_charset($charset, $dbh);
        } else {
            return sql_set_charset($charset, $dbh);
        }
    }

    function sql_print_error($text)
    {
        global $CONF;
        if ( ! function_exists('addToLog') )
            return ;

        if (!isset($CONF['debug']) || (!$CONF['debug']))
        {
            addToLog(ERROR, $text);
        }
        else
        {
            addToLog(ERROR, $text);
            print htmlspecialchars($text, ENT_QUOTES, defined('_CHARSET') ? _CHARSET : 'UTF-8');
        }
    }

    function sql_quote_identifier($text)
    {
        global $DB_DRIVER_NAME;
        switch ($DB_DRIVER_NAME)
        {
            case 'sqlite':
                return '`'. str_replace("`","``",$text) . '`';
            default :  // mysql
                return '`'. sql_real_escape_string($text) . '`';
        }
    }

    function sql_prepare($sql)
    {
        global $SQL_DBH, $CONF;
        sql_query_log($sql);

        if (!$SQL_DBH) return false;

        $res = $SQL_DBH->prepare($sql);
        if (!$res && $CONF['debug'])
            sql_print_error(sql_error($SQL_DBH));
        return $res;
    }

    function sql_execute($stmt , $input_parameters = array())
    {
        if (!$stmt)
            return false;

        if (!($stmt instanceof PDOStatement))
        {
            sql_print_error("error: param1 is not PDOStatement.");
            return false;
        }

        if (!is_array($input_parameters))
        {
            sql_print_error("error: param2 is not array.");
            return false;
        }

        return $stmt->execute($input_parameters);
    }

    function sql_prepare_execute($sql , $input_parameters = array())
    {
        global $SQL_DBH;
        sql_query_log($sql);

        if (!$SQL_DBH) return false;
        $stmt = $SQL_DBH->prepare($sql);
        if ( $stmt && $stmt->execute($input_parameters) )
            return $stmt;
        return false;
    }

    function sql_direct_getValue_AsInt($sql , $input_parameters = array())
    {
        if (!is_string($sql))
        {
            sql_print_error("error: param1 is not string.");
            return 0;
        }
        $stmt = sql_prepare_execute($sql , $input_parameters);
        if ($stmt)
            $res = sql_fetch_column($stmt);
        else
            $res = 0;
        return intval($res);
    }

}