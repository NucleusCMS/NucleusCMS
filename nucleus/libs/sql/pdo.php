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
 */

/*
 * complete sql_* wrappers for mysql functions
 *
 * functions moved from globalfunctions.php: sql_connect, sql_disconnect, sql_query
 */

$MYSQL_CONN = 0;
global $SQL_DBH;
$SQL_DBH = null;

if ( ! function_exists('sql_fetch_assoc')) {
    include(__DIR__ . '/sql_common_functions.php');

    /**
     * Connects to mysql server
     */
    function sql_connect_args(
        $db_host = 'localhost',
        $db_user = '',
        $db_password = '',
        $db_name = ''
    ) {
        global $CONF, $DB_DRIVER_NAME;

        if ( ! class_exists('PDO')) {
            exit('Critical error. pdo module is not loaded.');
        }
        if ( ! (defined('PDO::ATTR_SERVER_VERSION'))) {
            exit('The php of server does not meet the execution minimum requirement.');
        }

        $supported_drivers = ['mysql','sqlite'];
        //  $supported_drivers[] = 'drivername'; // for debug

        if (
            empty($DB_DRIVER_NAME) ||
            ! in_array(strtolower($DB_DRIVER_NAME), $supported_drivers)
        ) {
            exit('Critical error: Invalid driver name. Check the config file.');
        }

        try {
            if ( ! str_contains($db_host, ':')) {
                $host    = $db_host;
                $port    = '';
                $portnum = '';
            } else {
                list($host, $port) = explode(":", $db_host);
                if (isset($port)) {
                    $portnum = $port;
                    $port    = ';port=' . trim($port);
                } else {
                    $port    = '';
                    $portnum = '';
                }
            }

            if ('sybase' === $DB_DRIVER_NAME || 'dblib' === $DB_DRIVER_NAME) {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ':' . (int) $portnum : '',
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
            } elseif ('mssql' === $DB_DRIVER_NAME) {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ',' . (int) $portnum : '',
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
            } elseif ('oci' === $DB_DRIVER_NAME) {
                $DBH = new PDO(
                    sprintf(
                        '%s:dbname=//%s%s/%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ':' . (int) $portnum : '',
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
            } elseif ('odbc' === $DB_DRIVER_NAME) {
                $DBH = new PDO(
                    sprintf(
                        "%s:DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=%s%s;DATABASE=%s;PROTOCOL=TCPIP;UID=%s;PWD=%s",
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ';PORT=' . (int) $portnum : '',
                        $db_name,
                        $db_user,
                        $db_password
                    )
                );
            } elseif ('pgsql' === $DB_DRIVER_NAME) {
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ';port=' . (int) $portnum : '',
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
            } elseif ('sqlite' === $DB_DRIVER_NAME) {  // sqlite3
                ini_set('default_charset', "UTF-8");
                if (version_compare(PHP_VERSION, '7.1.0', '<')) {
                    $msg = 'Critical error: PHP 7.1 or higher is required.';
                    startUpError($msg, 'Connect Error');
                }

                if ( ! extension_loaded('PDO_SQLITE')) {
                    $msg = 'Critical error: pdo_sqlite module is not loaded.';
                    startUpError($msg, 'Connect Error');
                }

                // check file path
                $db_path = trim(dirname($db_name));
                if (0 == strlen($db_path)
                    ||
                    ! is_dir($db_path)
                    || ! str_contains(str_replace("\\", '/', $db_path), '/')
                ) {
                    exit('ERROR : database filename maybe wrong ');
                }

                $DBH = new PDO(
                    sprintf(
                        '%s:%s',
                        $DB_DRIVER_NAME,
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
                if ($DBH) {
                    if ( ! class_exists('sqlite_functions')) {
                        require_once(__DIR__ . '/sqlite_functions.php');
                    } // __DIR__ : (php5.3-)
                    sqlite_functions::pdo_register_user_functions($DBH);
                    // $DBH->beginTransaction();
                }
            } elseif ('sqlite2' === $DB_DRIVER_NAME) {
                // PDO::sqliteCreateFunction does not support SQLite2
                //// trigger_error("Critical Error : sqlite2 driver is not suported. ", E_USER_ERROR);
                $msg = '<p>a1 Error!: sqlite2 driver is not supportted.</p>';
                startUpError($msg, 'Connect Error');
            } else {
                //mysql
                $DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        $port,
                        $db_name
                    ),
                    $db_user,
                    $db_password
                );
            }

            // for mysql
            if ($DBH && (0 === stripos($DB_DRIVER_NAME, 'mysql'))) {
                if ($DBH && version_compare(PHP_VERSION, '5.2.0', '<')) {
                    // HY000-2014 Cannot execute queries while other unbuffered queries are active.
                    $DBH->setAttribute(
                        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
                        true
                    );
                }
                if (defined('_CHARSET')) {
                    $charset = get_mysql_charset_from_php_charset(_CHARSET);
                } else {
                    $query = sprintf(
                        "SELECT * FROM %s WHERE name='Language'",
                        sql_table('config')
                    );
                    $res = sql_query($query, $DBH);
                    if ( ! $res) {
                        exit('Language name fetch error');
                    }
                    $obj         = sql_fetch_object($res);
                    $Language    = $obj->value;
                    $charset     = get_charname_from_langname($Language);
                    $charsetOfDB = getCharSetFromDB(
                        sql_table('config'),
                        'name',
                        $DBH
                    );
                    if ((false !== stripos($charset, 'utf'))
                        && (false !== stripos($charsetOfDB, 'utf8'))) {
                        $charset = $charsetOfDB;
                    } // work around for utf8mb4_general_ci
                }
                sql_set_charset($charset, $DBH);
                fix_mysql_sqlmode($DBH);
            }
        } catch (PDOException $e) {
            $DBH = null;
            if (isDebugMode()) {
                $msg = '<p>a1 Error!: ' . hsc($e->getMessage()) . '</p>';
            } else {
                $msg = '<p>a1 Error!: ';
                $pattern
                     = '/(Access denied for user|Unknown database|could not find driver)/i';
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
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE;
        global $MYSQL_CONN, $SQL_DBH;

        $SQL_DBH = sql_connect_args(
            $DB_HOST,
            $DB_USER,
            $DB_PASSWORD,
            $DB_DATABASE
        );
        if ( ! $SQL_DBH) {
            $title = 'Connect Error';
            $msg   = '<p>Error : Database Connection</p>';
            $msg .= sprintf(
                '<br><p><a href="%s">%s</a></p>',
                $_SERVER['REQUEST_URI'],
                'URL'
            );

            startUpError($msg, $title);
            exit;
        }
        //        echo '<hr />DBH: '.print_r($SQL_DBH,true).'<hr />';
        unset($MYSQL_CONN);
        if (7 * 10000 + 2 * 100 <= PHP_VERSION_ID) {
            $MYSQL_CONN = $SQL_DBH; // PHP[5.x - 8.2]
        } else {
            $MYSQL_CONN = clone $SQL_DBH; // PHP[5.x - 7.1]
            // PHP[7.2 - 8.2] Fatal error: Uncaught Error: Trying to clone an uncloneable object of class PDO
        }

        return $SQL_DBH;
    }

    /**
     * disconnects from SQL server
     */
    function sql_disconnect(&$dbh = null)
    {
        global $SQL_DBH;
        if (null === $dbh) {
            $SQL_DBH = null;
        } else {
            $dbh = null;
        }
    }

    function sql_close(&$dbh = null)
    {
        global $SQL_DBH;
        if (null === $dbh) {
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
        global $CONF, $SQLCount, $SQL_DBH;
        $SQLCount++;
        $debug = isDebugMode();
        $db    = (null !== $dbh ? $dbh : $SQL_DBH);
        if (is_array($query)) {
            $query = implode("\n", $query);
        }
        if (is_object($db) && ($db instanceof PDO)) {
            $res = $db->query($query);
        } else {
            $res = false;
        }
        if ( ! $debug) {
            return $res;
        }

        $style = 'height:100px; overflow:auto; background:#C0DCC0';
        if (false === $res) {
            $msg_text = ((is_object($db) && ($db instanceof PDO))
                ? sql_error($dbh) : 'Handle is null or not pdo object.');
            echo sprintf(
                'SQL error with query <div style="%s">%s<br />%s</div>: <p />',
                $style,
                hsc($msg_text),
                hsc($query)
            );
        } elseif ('00000' != $res->errorCode()) {
            $errors   = $res->errorInfo();
            $msg_text = $errors[0] . '-' . $errors[1] . ' ' . $errors[2];
            echo sprintf(
                'SQL error with query <div style="%s">%s</div>: %s<p />',
                $style,
                hsc($msg_text),
                hsc($query)
            );
        }

        return $res;
    }

    function sql_query_log(&$query, $override = false, $log = false)
    {
        global $SQLCount;

        if ( ! isset($SQLCount) || (0 == $SQLCount)) {
            $SQLCount = 0;
            $override = true;
        }
        $SQLCount++;
        if ( ! $log) {
            return;
        } //

        file_put_contents(
            __DIR__ . '/query_log.txt',
            sprintf(
                "tick time : %.2f , query No %d\r\n\t%s",
                (float) microtime(true) - (float) serverVar('REQUEST_TIME_FLOAT'),
                $SQLCount,
                preg_replace("/(\r\n|\n\r|\r|\n)/", "\r\n", $query . "\n")
            ),
            $override ? null : FILE_APPEND
        );
    }

    /**
     * executes an SQL error
     */
    function sql_error($dbh = null)
    {
        global $SQL_DBH;
        $db = (null !== $dbh ? $dbh : $SQL_DBH);
        if (is_object($db)) {
            $error = $db->errorInfo();
        } else {
            $error = ['Handle is not object', '', ''];
        }
        if ('00000' != $error[0]) {
            return $error[0] . '-' . $error[1] . ' ' . $error[2];
        }

        return '';
    }

    /**
     * executes an SQL db select
     */
    function sql_select_db($db, &$dbh = null)
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DRIVER_NAME;
        global $CONF, $SQL_DBH;
        //echo '<hr />'.print_r($dbh,true).'<hr />';
        //exit;
        if (null !== $dbh) {
            if (false !== $dbh->exec(sprintf('USE `%s`', (string) $db))) {
                return 1;
            }

            return 0;
        }

        try {
            $SQL_DBH           = null;
            list($host, $port) = explode(':', $DB_HOST);
            if (isset($port)) {
                $portnum = $port;
                $port    = ';port=' . trim($port);
            } else {
                $port    = '';
                $portnum = '';
            }
            //$SQL_DBH = new PDO($DB_DRIVER_NAME.':host='.trim($host).$port.';dbname='.$db, $DB_USER, $DB_PASSWORD));
            //$SQL_DBH = sql_connect();
            if ('sybase' === $DB_DRIVER_NAME || 'dblib' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ':' . (int) $portnum : '',
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            } elseif ('mssql' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ',' . (int) $portnum : '',
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            } elseif ('oci' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:dbname=//%s%s/%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ':' . (int) $portnum : '',
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            } elseif ('odbc' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=%s%s;DATABASE=%s;PROTOCOL=TCPIP;UID=%s;PWD=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ';PORT=' . (int) $portnum : '',
                        $db,
                        $DB_USER,
                        $DB_PASSWORD
                    )
                );
            } elseif ('pgsql' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        is_numeric($portnum) ? ';port=' . (int) $portnum : '',
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            } elseif ('sqlite' === $DB_DRIVER_NAME) {
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:%s',
                        $DB_DRIVER_NAME,
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            } elseif ('sqlite2' === $DB_DRIVER_NAME) {
                trigger_error(
                    "Critical Error : sqlite2 driver is not suported. ",
                    E_USER_ERROR
                );
            } else {
                //mysql
                $SQL_DBH = new PDO(
                    sprintf(
                        '%s:host=%s%s;dbname=%s',
                        $DB_DRIVER_NAME,
                        $host,
                        $port,
                        $db
                    ),
                    $DB_USER,
                    $DB_PASSWORD
                );
            }

            return 1;
        } catch (PDOException $e) {
            if (isDebugMode()) {
                $msg = '<p>a3 Error!: ' . $e->getMessage() . '</p>';
            } else {
                $msg = '<p>a3 Error!: ';
                if (preg_match(
                    '/(Access denied for user|Unknown database)/i',
                    $e->getMessage(),
                    $m
                )) {
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

        return (string) substr($s, 1, -1);
        //        return addslashes($val);
    }

    /**
     * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed
     */
    function sql_quote_string($val, $dbh = null)
    {
        global $SQL_DBH;

        if (null === $dbh) {
            return $SQL_DBH->quote((string) $val);
        }

        return $dbh->quote($val);
    }

    /**
     * executes an SQL insert id
     */
    function sql_insert_id($dbh = null)
    {
        global $SQL_DBH;

        if (null === $dbh) {
            return $SQL_DBH->lastInsertId();
        }

        return $dbh->lastInsertId();
    }

    /**
     * executes an SQL result request
     */
    function sql_result($res, $row = 0, $col = 0)
    {
        if ((int) $row < 1) {
            $results = $res->fetch(PDO::FETCH_BOTH);

            return $results[$col];
        }

        for ($i = 0, $iMax = (int) $row; $i < $iMax; $i++) {
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
        if (is_object($res) && ($res instanceof PDOStatement)) {
            return $res->closeCursor();
        }
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
        if (is_object($res)) {
            return $res->rowCount();
        }

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
        if ( ! $res) {
            return [];
        }

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a result row as an associative array, a numeric array, or both
     */
    function sql_fetch_array($res)
    {
        if ( ! $res) {
            return [];
        }

        return $res->fetch(PDO::FETCH_BOTH);
    }

    /**
     * fetches next row of SQL result as an object
     */
    function sql_fetch_object($res)
    {
        if ( ! $res || ! is_object($res)) {
            return null;
        }

        return $res->fetchObject();
    }

    /**
     * Get a result row as an enumerated array
     */
    function sql_fetch_row($res)
    {
        if ( ! $res) {
            return [];
        }

        return $res->fetch(PDO::FETCH_NUM);
    }

    function sql_fetch_column($res, $column_number = 0)
    {
        if ( ! $res) {
            return false;
        }

        return $res->fetchColumn($column_number);
    }

    /**
     * Get column information from a result and return as an object
     */
    function sql_fetch_field($res, $offset = 0)
    {
        if (is_object($res) && ($res instanceof PDOStatement)) {
            $results = $res->getColumnMeta($offset);
            if (is_array($results) && count($results) > 0) {
                return (object) $results;
            }
        }
        return null;
    }

    /**
     * Get current system status (returns string)
     */
    function sql_stat($dbh = null)
    {
        //not implemented
        if (null === $dbh) {
            return '';
        }

        return '';
    }

    /**
     * Returns the name of the character set
     */
    function sql_client_encoding($dbh = null)
    {
        //not implemented
        if (null === $dbh) {
            return '';
        }

        return '';
    }

    /**
     * Returns the array that column names of the table
     */
    function sql_getTableColumnNames($tablename)
    {
        global $SQL_DBH;
        if ( ! $SQL_DBH || ! is_string($tablename) || '' === $tablename) {
            return [];
        }

        $drivername = $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME);
        if (str_contains($tablename, '[@prefix@]')) {
            $tablename = parseQuery($tablename);
        }
        if ('sqlite' === $drivername) {
            $sql    = sprintf('PRAGMA TABLE_INFO(`%s`)', $tablename);
            $target = 'name';
        } else {
            // mysql
            $sql    = sprintf('SHOW COLUMNS FROM `%s` ', $tablename);
            $target = 'Field';
        }

        $items = [];
        $res   = [];
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
    function sql_existTableColumnName(
        $tablename,
        $ColumnName,
        $casesensitive = false
    ) {
        if ( ! is_string($tablename) || '' === $tablename) {
            return false;
        }
        $names = sql_getTableColumnNames($tablename);

        if ( ! $names) {
            return false;
        }

        if ($casesensitive) {
            return in_array($ColumnName, $names);
        }

        foreach ($names as $v) {
            if (0 == strcasecmp($ColumnName, $v)) {
                return true;
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
        if ( ! $SQL_DBH || ! is_string($tablename) || '' === $tablename) {
            return false;
        }

        if (str_contains($tablename, '[@prefix@]')) {
            $tablename = parseQuery($tablename);
        }

        if ('sqlite' === $SQL_DBH->getAttribute(PDO::ATTR_DRIVER_NAME)) {
            $stmt
                = $SQL_DBH->prepare("SELECT name FROM sqlite_master WHERE type='table' AND name = :name");
        } else { // mysql
            $stmt = $SQL_DBH->prepare('SHOW TABLES LIKE :name ');
        }
        $res = [];
        if ($stmt && $stmt->execute([':name' => $tablename])) {
            $res = $stmt->fetch();
        }

        return $res && count($res) > 0;
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
        if (null === $dbh) {
            return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
        }

        return $dbh->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
    }

    /**
     * Returns a string describing the type of SQL connection in use for the connection or FALSE on failure
     */
    function sql_get_host_info($dbh = null)
    {
        global $SQL_DBH;
        if (null === $dbh) {
            return $SQL_DBH->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
        }

        return $dbh->getAttribute(constant("PDO::ATTR_SERVER_INFO"));
    }

    /**
     * Returns the SQL protocol on success, or FALSE on failure.
     */
    function sql_get_proto_info($dbh = null)
    {
        //not implemented
        if (null === $dbh) {
            return false;
        }

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
     * Unimplemented mysql_* functions
     *
     * # mysql_ data_ seek (maybe useful)
     * # mysql_ errno (maybe useful)
     * # mysql_ fetch_ lengths (maybe useful)
     * # mysql_ field_ flags (maybe useful)
     * # mysql_ field_ len (maybe useful)
     * # mysql_ field_ name (maybe useful)
     * # mysql_ field_ seek (maybe useful)
     * # mysql_ field_ table (maybe useful)
     * # mysql_ field_ type (maybe useful)
     * # mysql_ info (maybe useful)
     * # mysql_ list_ processes (maybe useful)
     * # mysql_ ping (maybe useful)
     * # mysql_ set_ charset (maybe useful, requires php >=5.2.3 and mysql >=5.0.7)
     * # mysql_ thread_ id (maybe useful)
     *
     * # mysql_ db_ name (useful only if working on multiple dbs which we do not do)
     * # mysql_ list_ dbs (useful only if working on multiple dbs which we do not do)
     *
     * # mysql_ pconnect (probably not useful and could cause some unintended performance issues)
     * # mysql_ unbuffered_ query (possibly useful, but complicated and not supported by all database drivers (pdo))
     *
     * # mysql_ change_ user (deprecated)
     * # mysql_ create_ db (deprecated)
     * # mysql_ db_ query (deprecated)
     * # mysql_ drop_ db (deprecated)
     * # mysql_ escape_ string (deprecated)
     * # mysql_ list_ fields (deprecated)
     * # mysql_ list_ tables (deprecated)
     * # mysql_ tablename (deprecated)
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
    function sql_set_charset($charset, $dbh = null)
    {
        global $DB_DRIVER_NAME;
        if ('mysql' === $DB_DRIVER_NAME) {
            $db = ($dbh ? $dbh : sql_get_db());
            $i  = strtolower($charset);
            if ('utf-8' === $i || 'utf8' === $i) {
                $charset = 'utf8';
            } elseif ('utf8mb4' === $i) {
                $charset = 'utf8mb4';
            } elseif ('euc-jp' === $i || 'ujis' === $i) {  // Japanese EUC-JP
                $charset = 'ujis';
            } elseif ('gb2312' === $i) {
                $charset = 'gb2312';
            } elseif ('iso-8859-1' === $i) {
                $charset = 'latin1';
            } else {
                $converted = false;
                if (preg_match('#^iso-8859-(\d+)$#i', $charset, $m)) {
                    // ISO 8859-  2 8 7 9 13
                    $res
                        = sql_query(
                            "SHOW CHARACTER SET where Description LIKE 'ISO 8859-{$m[1]} %'",
                            $db
                        );
                    if ($res && ($items = sql_fetch_assoc($res))
                        && ! empty($items['Charset'])) {
                        $charset   = $items['Charset'];
                        $converted = true;
                    }
                }
                if ( ! $converted) {
                    $charset = 'utf8';
                }
            }

            $res = $db->exec("SET CHARACTER SET " . $charset);

            return $res;
        }

        return true;
    }

    function sql_set_charset_v2($charset, $dbh = null)
    {
        global $DB_DRIVER_NAME;
        $dbh = ($dbh ? $dbh : sql_get_db());
        if ('mysql' === $DB_DRIVER_NAME) {
            $charsetOfDB = getCharSetFromDB(sql_table('config'), 'name', $dbh);
            if ((false !== stripos($charset, 'utf'))
                && (false !== stripos($charsetOfDB, 'utf8'))) {
                $charset = $charsetOfDB;
            } // work around for utf8mb4_general_ci

            return sql_set_charset($charset, $dbh);
        }

        return sql_set_charset($charset, $dbh);
    }

    function sql_print_error($text)
    {
        global $CONF;
        if ( ! function_exists('addToLog')) {
            return;
        }

        if ( ! isDebugMode()) {
            addToLog(ERROR, $text);
        } else {
            addToLog(ERROR, $text);
            print htmlspecialchars(
                $text,
                ENT_QUOTES,
                defined('_CHARSET') ? _CHARSET : 'UTF-8'
            );
        }
    }

    function sql_quote_identifier($text)
    {
        global $DB_DRIVER_NAME;
        if ('sqlite' === $DB_DRIVER_NAME) {
            return '`' . str_replace("`", "``", $text) . '`';
        }

        // mysql
        return '`' . sql_real_escape_string($text) . '`';
    }

    function sql_prepare($sql)
    {
        global $SQL_DBH, $CONF;
        sql_query_log($sql);

        if ( ! $SQL_DBH) {
            return false;
        }

        $res = $SQL_DBH->prepare((string) $sql);
        if ( ! $res && isDebugMode()) {
            sql_print_error(sql_error($SQL_DBH));
        }

        return $res;
    }

    function sql_execute($stmt, $input_parameters = [])
    {
        if ( ! $stmt) {
            return false;
        }

        if ( ! ($stmt instanceof PDOStatement)) {
            sql_print_error("error: param1 is not PDOStatement.");

            return false;
        }

        if ( ! is_array($input_parameters)) {
            sql_print_error("error: param2 is not array.");

            return false;
        }

        return $stmt->execute($input_parameters);
    }

    function sql_prepare_execute($sql, $input_parameters = [])
    {
        global $SQL_DBH;
        sql_query_log($sql);

        if ( ! $SQL_DBH) {
            return false;
        }
        $stmt = $SQL_DBH->prepare((string) $sql);
        if ($stmt && $stmt->execute($input_parameters)) {
            return $stmt;
        }

        return false;
    }

    function sql_direct_getValue_AsInt($sql, $input_parameters = [])
    {
        if ( ! is_string($sql)) {
            sql_print_error("error: param1 is not string.");

            return 0;
        }
        $stmt = sql_prepare_execute($sql, $input_parameters);
        if ( ! $stmt) {
            return 0;
        }

        return (int) sql_fetch_column($stmt);
    }
} // if not exist sql_* functions
