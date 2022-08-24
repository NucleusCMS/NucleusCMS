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
$SQL_DBH = null;

if (!function_exists('sql_fetch_assoc')) {
    /**
     * Errors before the database connection has been made
     */
    function startUpError($msg, $title)
    {
        if (!defined('_CHARSET')) {
            define('_CHARSET', 'UTF-8');
        }
        if (!defined('_HTML_XML_NAME_SPACE_AND_LANG_CODE')) {
            define('_HTML_XML_NAME_SPACE_AND_LANG_CODE', 'xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us"');
        }
        sendContentType('text/html', '', _CHARSET);
        ?>
<html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
    <head><meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET?>" />
    <title><?php echo hsc($title, ENT_QUOTES)?></title></head>
    <body>
        <h1><?php echo hsc($title, ENT_QUOTES)?></h1>
        <?php echo $msg?>
    </body>
</html>
<?php
    exit;
    }

    /**
     * Connects to mysql server
     */
    function sql_connect_args($db_host = 'localhost', $db_user = '', $db_password = '', $db_name = '')
    {
        global $CONF, $MYSQL_HANDLER;

        $DB_DRIVER_NAME = $MYSQL_HANDLER[1];

        try {
            if (strpos($db_host, ':') === false) {
                $host    = $db_host;
                $port    = '';
                $portnum = '';
            } else {
                list($host, $port) = explode(":", $db_host);
                if (isset($port)) {
                    $portnum = $port;
                    $port    = ';port='.trim($port);
                } else {
                    $port    = '';
                    $portnum = '';
                }
            }

            switch ($DB_DRIVER_NAME) {
                case 'sybase':
                case 'dblib':
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db_name, $db_user, $db_password);
                    break;
                case 'mssql':
                    if (is_numeric($portnum)) {
                        $port = ','.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db_name, $db_user, $db_password);
                    break;
                case 'oci':
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':dbname=//'.$host.$port.'/'.$db_name, $db_user, $db_password);
                    break;
                case 'odbc':
                    if (is_numeric($portnum)) {
                        $port = ';PORT='.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$db_name.';PROTOCOL=TCPIP;UID='.$db_user.';PWD='.$db_password);

                    break;
                case 'pgsql':
                    if (is_numeric($portnum)) {
                        $port = ';port='.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db_name, $db_user, $db_password);
                    break;
                case 'sqlite':
                    ini_set('default_charset', "UTF-8");
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $DBH = new PDO($DB_DRIVER_NAME.':'.$db_name, $db_user, $db_password);
                    if ($DBH) {
                        // standard: SUBSTR , non-standard: SUBSTRING
                        // SQLite has no SUBSTRING. but has SUBSTR.
                        // SUBSTRING , start index 1 or -1 , param 2 or 3
                        $DBH->sqliteCreateFunction('SUBSTRING', create_function('', '  $st = intval(func_get_arg(1)); if ($st>0) $st--; return substr(func_get_arg(0) , $st , func_get_arg(2)); '), 3);
                        $DBH->sqliteCreateFunction('UNIX_TIMESTAMP', 'strtotime', 1);
                        $DBH->sqliteCreateFunction('NOW', create_function('', 'return date("Y-m-d H:i:s", time());'), 0); // local time
                        // SQL non-standard : REGEXP (mysql , sqlite) , src_exp ~ pattern_text (postgreSQL)
                        //                    --- src_exp like pattern_text  ,  %  _
                        // src_exp REGEXP pattern_text
                        // 'P1' REGEXP 'P2' = P2 P1 ( return func_get_arg(0).' '.func_get_arg(1); )
                        $DBH->sqliteCreateFunction('REGEXP', create_function('$pattern , $Text', 'return preg_match("/(".str_replace("/","\\/",(string) $pattern).")/im", (string) $Text)? 1:0;'), 2);
                        $DBH->sqliteCreateFunction('CONCAT', create_function('', 'return implode ("",func_get_args() );'), -1);
                        $DBH->sqliteCreateFunction('FIND_IN_SET', create_function('$k,$v', 'return in_array($k, explode($v)) ? 1:0;'), 2);
                        $DBH->sqliteCreateFunction('md5', 'md5', 1);
//                      $DBH->beginTransaction();
                    }
                    break;
                case 'sqlite2': // PDO::sqliteCreateFunction does not support SQLite2
//                  trigger_error("Critical Error : sqlite2 driver is not suported. ", E_USER_ERROR);
                    $msg = '<p>a1 Error!: sqlite2 driver is not supportted.</p>';
                    startUpError($msg, 'Connect Error');
                    break;
                default:
                    //mysql
                    $DBH = new PDO($DB_DRIVER_NAME.':host='.$host.$port.';dbname='.$db_name, $db_user, $db_password);
                    break;
            }

            // <add for garble measure>
            // for mysql
            if ($DBH && (stripos($DB_DRIVER_NAME, 'mysql') === 0)) {
                if ($DBH && version_compare('5.2.0', PHP_VERSION, '>')) {
                    // HY000-2014 Cannot execute queries while other unbuffered queries are active.
                    $DBH->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                }
                if (defined('_CHARSET')) {
                    $charset = get_mysql_charset_from_php_charset(_CHARSET);
                } else {
                    $query = sprintf("SELECT * FROM %s WHERE name='Language'", sql_table('config'));
                    $res   = sql_query($query, $DBH);
                    if (!$res) {
                        exit('Language name fetch error');
                    }
                    $obj         = sql_fetch_object($res);
                    $Language    = $obj->value;
                    $charset     = get_charname_from_langname($Language);
                    $charsetOfDB = getCharSetFromDB(sql_table('config'), 'name', $DBH);
                    if ((stripos($charset, 'utf') !== false) && (stripos($charsetOfDB, 'utf8') !== false)) {
                        $charset = $charsetOfDB;
                    } // work around for utf8mb4_general_ci
                }
                sql_set_charset($charset, $DBH);
            }
            // </add for garble measure>*/
        } catch (PDOException $e) {
            $DBH = null;
            if ($CONF['debug']) {
                $msg = '<p>a1 Error!: ' . $e->getMessage() . '</p>';
            } else {
                $msg     = '<p>a1 Error!: ';
                $pattern = '/(Access denied for user|Unknown database)/i';
                if (preg_match($pattern, $e->getMessage(), $m)) {
                    $msg .= $m[1];
                }
                $msg .= '</p>';
            }
            startUpError($msg, 'Connect Error');
        }
//echo '<hr />DBH: '.print_r($DBH,true).'<hr />';
        return $DBH;
    }

    /**
     * Connects to mysql server
     */
    function sql_connect()
    {
        global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
        global $CONF;

        $SQL_DBH = sql_connect_args($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);
        if (!$SQL_DBH) {
            $title = 'Connect Error';
            $msg   = '<p>Error : Database Connection</p>';
            $msg .= sprintf('<br><p><a href="%s">%s</a></p>', $_SERVER['REQUEST_URI'], 'URL');

            startUpError($msg, $title);
            exit;
        }
//        echo '<hr />DBH: '.print_r($SQL_DBH,true).'<hr />';
        unset($MYSQL_CONN);
        $MYSQL_CONN = & $SQL_DBH;
        return $SQL_DBH;
    }

    /**
     * disconnects from SQL server
     */
    function sql_disconnect(&$dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            $SQL_DBH = null;
        } else {
            $dbh = null;
        }
    }

    function sql_close(&$dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            $SQL_DBH = null;
        } else {
            $dbh = null;
        }
    }

    function sql_connected()
    {
        global $SQL_DBH;
        return is_object($SQL_DBH) ? true : false;
    }

    /**
     * executes an SQL query
     */
    function sql_query($query, $dbh = null)
    {
        global $CONF, $SQLCount,$SQL_DBH;
        $SQLCount++;
        //echo '<hr />SQL_DBH: ';
        //print_r($SQL_DBH);
        //echo '<hr />DBH: ';
        //print_r($dbh);
        //echo '<hr />';
        //echo $query.'<hr />';
        $db = (!is_null($dbh) ? $dbh : $SQL_DBH);
        if (is_object($db)) {
            $res = $db->query($query);
        } else {
            $res = false;
        }
        if (!$CONF['debug']) {
            return $res;
        }

        if ($res === false) {
            print("SQL error with query {$query}: " . '<p />');
        } elseif ($res->errorCode() != '00000') {
            $errors = $res->errorInfo();
            print("SQL error with query {$query}: " . $errors[0].'-'.$errors[1].' '.$errors[2] . '<p />');
        }

        return $res;
    }

    /**
     * executes an SQL error
     */
    function sql_error($dbh = null)
    {
        global $SQL_DBH;
        $db = (!is_null($dbh) ? $dbh : $SQL_DBH);
        if (is_object($db)) {
            $error = $db->errorInfo();
        } else {
            $error = array('Handle is not object','','');
        }
        if ($error[0] != '00000') {
            return $error[0].'-'.$error[1].' '.$error[2];
        } else {
            return '';
        }
    }

    /**
     * executes an SQL db select
     */
    function sql_select_db($db, &$dbh = null)
    {
        global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN, $MYSQL_HANDLER, $SQL_DBH;
        global $CONF;
        //echo '<hr />'.print_r($dbh,true).'<hr />';
        //exit;
        if (!is_null($dbh)) {
            if ($dbh->exec("USE {$db}") !== false) {
                return 1;
            }
            return 0;
        }

        try {
            $SQL_DBH           = null;
            list($host, $port) = explode(":", $MYSQL_HOST);
            if (isset($port)) {
                $portnum = $port;
                $port    = ';port='.trim($port);
            } else {
                $port    = '';
                $portnum = '';
            }
            //$SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.trim($host).$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
            //$SQL_DBH = sql_connect();
            switch ($MYSQL_HANDLER[1]) {
                case 'sybase':
                case 'dblib':
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
                case 'mssql':
                    if (is_numeric($portnum)) {
                        $port = ','.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
                case 'oci':
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':dbname=//'.$host.$port.'/'.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
                case 'odbc':
                    if (is_numeric($portnum)) {
                        $port = ';PORT='.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME='.$host.$port.';DATABASE='.$db.';PROTOCOL=TCPIP;UID='.$MYSQL_USER.';PWD='.$MYSQL_PASSWORD);
                    break;
                case 'pgsql':
                    if (is_numeric($portnum)) {
                        $port = ';port='.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
                case 'sqlite':
                    if (is_numeric($portnum)) {
                        $port = ':'.intval($portnum);
                    } else {
                        $port = '';
                    }
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':'.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
                case 'sqlite2':
                    trigger_error("Critical Error : sqlite2 driver is not suported. ", E_USER_ERROR);
                    break;
                default:
                    //mysql
                    $SQL_DBH = new PDO($MYSQL_HANDLER[1].':host='.$host.$port.';dbname='.$db, $MYSQL_USER, $MYSQL_PASSWORD);
                    break;
            }
            return 1;
        } catch (PDOException $e) {
            if ($CONF['debug']) {
                $msg = '<p>a3 Error!: ' . $e->getMessage() . '</p>';
            } else {
                $msg     = '<p>a3 Error!: ';
                $pattern = '/(Access denied for user|Unknown database)/i';
                if (preg_match($pattern, $e->getMessage(), $m)) {
                    $msg .= $m[1];
                }
                $msg .= '</p>';
            }
            startUpError($msg, 'Connect Error');
            return 0;
        }
    }

    /**
     * executes an SQL real escape
     */
    function sql_real_escape_string($val, $dbh = null)
    {
        $s = sql_quote_string($val, $dbh);
        return (string) substr($s, 1, strlen($s) - 2);
//        return addslashes($val);
    }

    /**
     * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed
     */
    function sql_quote_string($val, $dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            return $SQL_DBH->quote($val);
        } else {
            return $dbh->quote($val);
        }
    }

    /**
     * executes an SQL insert id
     */
    function sql_insert_id($dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            return $SQL_DBH->lastInsertId();
        } else {
            return $dbh->lastInsertId();
        }
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
        } else {
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
        $res = null;
        return true;
    }

    /**
     * returns number of rows in SQL result
     */
    function sql_num_rows($res)
    {
        // DELETE, INSERT, UPDATE
        // do not use : SELECT
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
        if ($res) {
            $results = $res->fetch(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    /**
     * Fetch a result row as an associative array, a numeric array, or both
     */
    function sql_fetch_array($res)
    {
        $results = array();
        if ($res) {
            $results = $res->fetch(PDO::FETCH_BOTH);
        }
        return $results;
    }

    /**
     * fetches next row of SQL result as an object
     */
    function sql_fetch_object($res)
    {
        $results = null;
        if ($res && is_object($res)) {
            $results = $res->fetchObject();
        }
        return $results;
    }

    /**
     * Get a result row as an enumerated array
     */
    function sql_fetch_row($res)
    {
        $results = array();
        if ($res) {
            $results = $res->fetch(PDO::FETCH_NUM);
        }
        return $results;
    }

    function sql_fetch_column($res, $column_number = 0)
    {
        if ($res) {
            return $res->fetchColumn($column_number);
        }
        return false;
    }

    /**
     * Get column information from a result and return as an object
     */
    function sql_fetch_field($res, $offset = 0)
    {
        $results = array();
        $obj     = null;
        $results = $res->getColumnMeta($offset);
        foreach ($results as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }

    /**
     * Get current system status (returns string)
     */
    function sql_stat($dbh = null)
    {
        //not implemented
        global $SQL_DBH;
        if (is_null($dbh)) {
            return '';
        } else {
            return '';
        }
    }

    /**
     * Returns the name of the character set
     */
    function sql_client_encoding($dbh = null)
    {
        //not implemented
        global $SQL_DBH;
        if (is_null($dbh)) {
            return '';
        } else {
            return '';
        }
    }

    /**
     * Returns the array that column names of the table
     */
    function sql_getTableColumnNames($tablename)
    {
        global $SQL_DBH;
        if (!$SQL_DBH) {
            return array();
        }

        $drivername = $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME);
        if ($drivername == 'sqlite') {
            $sql    = sprintf('PRAGMA TABLE_INFO(`%s`)', $tablename);
            $target = 'name';
        } else {
            // mysql
            $sql    = sprintf('SHOW COLUMNS FROM `%s` ', $tablename);
            $target = 'Field';
        }

        $items = array();
        $res   = array();
        $stmt  = $SQL_DBH->prepare($sql);
        if ($stmt && $stmt->execute()) {
            $res = $stmt->fetchAll();
        }

        foreach ($res as $row) {
            if (isset($row[$target])) {
                $items[] = $row[$target];
            }
        }
        if (count($items) > 0) {
            sort($items);
        }
        return $items;
    }

    /**
     * Returns the boolean value that column name of the table exist or not
     */
    function sql_existTableColumnName($tablename, $ColumnName, $casesensitive = false)
    {
        $names = sql_getTableColumnNames($tablename);

        if (count($names) > 0) {
            if ($casesensitive) {
                return in_array($ColumnName, $names);
            } else {
                foreach ($names as $v) {
                    if (strcasecmp($ColumnName, $v) == 0) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Returns the boolean value that column name of the table exist or not
     */
    function sql_existTableName($tablename)
    {
        global $SQL_DBH;
        if (!$SQL_DBH) {
            return false;
        }

        $drivername       = $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME);
        $input_parameters = array(':name' => $tablename);
        if ($drivername == 'sqlite') {
            $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name = :name";
        } else {
            // mysql
            $sql = 'SHOW TABLES LIKE :name ';
        }
        $res  = array();
        $stmt = $SQL_DBH->prepare($sql);
        if ($stmt && $stmt->execute($input_parameters)) {
            $res = $stmt->fetch();
        }
        if ($res && count($res) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Get SQL client version
     */
    function sql_get_client_info()
    {
        global $SQL_DBH;
        return $SQL_DBH->getAttribute(constant("PDO::ATTR_CLIENT_VERSION"));
    }

    function sql_get_db()
    {
        global $SQL_DBH;
        return $SQL_DBH;
    }

    /**
     * Get SQL server version
     */
    function sql_get_server_info($dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
        } else {
            return $dbh->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
        }
    }

    /**
     * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
     */
    function sql_get_host_info($dbh = null)
    {
        global $SQL_DBH;
        if (is_null($dbh)) {
            return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
        } else {
            return $dbh->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
        }
    }

    /**
     * Returns the SQL protocol on success, or FALSE on failure.
     */
    function sql_get_proto_info($dbh = null)
    {
        //not implemented
        global $SQL_DBH;
        if (is_null($dbh)) {
            return false;
        } else {
            return false;
        }
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
     * NOTE: 	shift_jis is only supported for output. Using shift_jis in DB is prohibited.
     * NOTE:	iso-8859-x,windows-125x if _CHARSET is unset.
     */
    function sql_set_charset($charset, $dbh = null)
    {
        global $MYSQL_HANDLER,$SQL_DBH;
        if (strpos($MYSQL_HANDLER[1], 'mysql') === 0) {
            switch(strtolower($charset)) {
                case 'utf-8':
                case 'utf8':
                    $charset = 'utf8';
                    break;
                case 'utf8mb4':
                    $charset = 'utf8mb4';
                    break;
                case 'euc-jp':
                case 'ujis':
                    $charset = 'ujis';
                    break;
                case 'gb2312':
                    $charset = 'gb2312';
                    break;
                    /*
                    case 'shift_jis':
                    case 'sjis':
                        $charset = 'sjis';
                        break;
                    */
                default:
                    $charset = 'latin1';
                    break;
            }

            $db       = ($dbh ? $dbh : sql_get_db());
            $mySqlVer = implode('.', array_map('intval', explode('.', sql_get_server_info($db))));
            if (version_compare($mySqlVer, '4.1.0', '>=')) {
                $res = $db->exec("SET CHARACTER SET " . $charset);
            }
        }
        return $res;
    }

    function get_mysql_charset_from_php_charset($charset = 'utf-8')
    {
        switch(strtolower($charset)) {
            case 'utf-8': $charset = 'utf8';
            break;
            case 'euc-jp': $charset = 'ujis';
            break;
            case 'iso-8859-1': $charset = 'latin1';
            break;
            case 'windows-1250': $charset = 'cp1250';
            break; // cp1250_general_ci
        }
        return $charset;
    }

    function get_charname_from_langname($language_name = 'english-utf8')
    {
        $language_name = strtolower($language_name);

        if (strpos($language_name, 'utf8') !== false) {
            return 'utf8';
        }

        switch($language_name) {
            case 'english':
            case 'catalan':
            case 'finnish':
            case 'french':
            case 'galego':
            case 'german':
            case 'italiano':
            case 'portuguese_brazil':
            case 'spanish':
                $charset_name = 'latin1';
                break;
            case 'hungarian': // iso-8859-2
            case 'slovak': // iso-8859-2
                $charset_name = 'latin2';
                break;
            case 'bulgarian': // iso-8859-5
                $charset_name = 'koi8r';
                break;
            case 'chinese': // gb2312
            case 'simchinese': // gb2312
                $charset_name = 'gb2312';
                break;
            case 'chineseb5': // big5
            case 'traditional_chinese': // big5
                $charset_name = 'big5';
                break;
            case 'czech': // windows-1250
                $charset_name = 'cp1250';
                break;
            case 'russian': // windows-1251
                $charset_name = 'cp1251';
                break;
            case 'latvian': // windows-1257
                $charset_name = 'cp1257';
                break;
            case 'nederlands': // iso-8859-15
                $charset_name = 'latin9';
                break;
            case 'japanese-euc':
                $charset_name = 'ujis';
                break;
            case 'korean-euc-kr':
            case 'korean-utf':
            case 'persian':
            default:
                $charset_name = 'utf8';
        }
        return $charset_name;
    }

    function getCharSetFromDB($tableName, $columnName, $dbh = null)
    {
        $collation = getCollationFromDB($tableName, $columnName, $dbh);
        if (strpos($collation, '_') === false) {
            $charset = $collation;
        } else {
            list($charset, $dummy) = explode('_', $collation, 2);
        }
        return $charset;
    }

    function getCollationFromDB($tableName, $columnName, $dbh = null)
    {
        $columns = sql_query("SHOW FULL COLUMNS FROM `{$tableName}` LIKE '{$columnName}'", $dbh);
        $column  = sql_fetch_object($columns);
        return isset($column->Collation) ? $column->Collation : false;
    }
}
