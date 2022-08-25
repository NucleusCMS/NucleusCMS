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

if (function_exists('mysql_query') && ! function_exists('sql_fetch_assoc')) {
    include __DIR__ . '/sql_common_functions.php';

    /**
     * Connects to mysql server with arguments
     */
    function sql_connect_args(
        $mysql_host = 'localhost',
        $mysql_user = '',
        $mysql_password = '',
        $mysql_database = ''
    ) {
        $CONN = @mysql_connect($mysql_host, $mysql_user, $mysql_password);
        if ($mysql_database) {
            sql_select_db($mysql_database, $CONN);
        }

        return $CONN;
    }

    /**
     * Connects to mysql server
     */
    function sql_connect()
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE;
        global $MYSQL_CONN, $MYSQL_HOST;

        if ($MYSQL_CONN) {
            return $MYSQL_CONN;
        }

        if (! $DB_HOST || ! $DB_USER) {
            exit('sql_connect error. Empty connect information.');
        }

        if (substr(PHP_OS, 0, 3) === 'WIN' && $DB_HOST === 'localhost') {
            $MYSQL_HOST = '127.0.0.1';
        }
        $MYSQL_CONN = @mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
        if (! $MYSQL_CONN) {
            startUpError(
                '<p>Could not connect to MySQL database.</p>',
                'Connect Error'
            );
        }

        if (! sql_select_db($DB_DATABASE, $MYSQL_CONN)) {
            @mysql_close($MYSQL_CONN);
            $MYSQL_CONN = null;
            $msg        = '';
            $pattern
                        = '/(Access denied for user|Unknown database|db handler is null)/i';
            if (preg_match($pattern, mysql_error(), $m)) {
                $msg .= $m[1];
            }
            startUpError(
                '<p>Could not select database: ' . $msg . '</p>',
                'Connect Error'
            );
        }

        if (defined('_CHARSET')) {
            $charset = get_mysql_charset_from_php_charset(_CHARSET);
        } else {
            $query = sprintf(
                "SELECT * FROM %s WHERE name='Language'",
                sql_table('config')
            );
            $res = sql_query($query);
            if (! $res) {
                exit('Language name fetch error');
            }
            $obj         = sql_fetch_object($res);
            $Language    = $obj->value;
            $charset     = get_charname_from_langname($Language);
            $charsetOfDB = getCharSetFromDB(
                sql_table('config'),
                'name',
                $MYSQL_CONN
            );
            if ((stripos($charset, 'utf') !== false)
                && (stripos($charsetOfDB, 'utf8') !== false)) {
                $charset = $charsetOfDB;
            } // work around for utf8mb4_general_ci
            else {
                if ($charset !== $charsetOfDB) {
                    global $CONF;
                    $CONF['adminAlert'] = '_MISSING_DB_ENCODING';
                }
            }
        }
        sql_set_charset($charset, $MYSQL_CONN);
        fix_mysql_sqlmode($MYSQL_CONN);

        return $MYSQL_CONN;
    }

    /**
     * disconnects from SQL server
     */
    function sql_disconnect($conn = false)
    {
        global $MYSQL_CONN;
        if ($conn) {
            @mysql_close($conn);
        } elseif ($MYSQL_CONN) {
            @mysql_close($MYSQL_CONN);
            $MYSQL_CONN = null;
        }
    }

    function sql_close($conn = false)
    {
        global $MYSQL_CONN;
        if ($conn) {
            @mysql_close($conn);
        } else {
            if ($MYSQL_CONN) {
                @mysql_close($MYSQL_CONN);
                $MYSQL_CONN = null;
            }
        }
    }

    function sql_connected()
    {
        global $MYSQL_CONN;

        return $MYSQL_CONN ? true : false;
    }

    /**
     * executes an SQL query
     */
    function sql_query($query, $conn = false)
    {
        global $SQLCount, $MYSQL_CONN, $CONF;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }
        $SQLCount++;
        if (is_array($query)) {
            $query = implode("\n", $query);
        }
        $res = mysql_query($query, $conn);
        if (! $res && isDebugMode()) {
            echo sprintf(
                "mySQL error with query <b>%s</b> : %s<p />",
                $query,
                mysql_error($conn)
            );
            $_ = debug_backtrace();
            print_r($_);
        }

        return $res;
    }

    /**
     * executes an SQL error
     */
    function sql_error($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_error($conn);
    }

    /**
     * executes an SQL db select
     */
    function sql_select_db($db, $conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_select_db($db, $conn);
    }

    /**
     * executes an SQL real escape
     */
    function sql_real_escape_string($val, $conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_real_escape_string($val, $conn);
    }

    /**
     * executes an PDO::quote() like escape, ie adds quotes arround the string and escapes chars as needed
     */
    function sql_quote_string($val, $conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return "'" . mysql_real_escape_string($val, $conn) . "'";
    }

    /**
     * executes an SQL insert id
     */
    function sql_insert_id($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_insert_id($conn);
    }

    /**
     * executes an SQL result request
     */
    function sql_result($res, $row = 0, $col = 0)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_result($res, $row, $col);
    }

    /**
     * frees sql result resources
     */
    function sql_free_result($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_free_result($res);
    }

    /**
     * returns number of rows in SQL result
     */
    function sql_num_rows($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_num_rows($res);
    }

    /**
     * returns number of rows affected by SQL query
     */
    function sql_affected_rows($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_affected_rows($conn);
    }

    /**
     * Get number of fields in result
     */
    function sql_num_fields($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_num_fields($res);
    }

    /**
     * fetches next row of SQL result as an associative array
     */
    function sql_fetch_assoc($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_fetch_assoc($res);
    }

    /**
     * Fetch a result row as an associative array, a numeric array, or both
     */
    function sql_fetch_array($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_fetch_array($res);
    }

    /**
     * fetches next row of SQL result as an object
     */
    function sql_fetch_object($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_fetch_object($res);
    }

    /**
     * Get a result row as an enumerated array
     */
    function sql_fetch_row($res)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_fetch_row($res);
    }

    /**
     * Get column information from a result and return as an object
     */
    function sql_fetch_field($res, $offset = 0)
    {
        if (! is_sql_result($res)) {
            return false;
        }

        return mysql_fetch_field($res, $offset);
    }

    /**
     * Get current system status (returns string)
     */
    function sql_stat($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_stat($conn);
    }

    /**
     * Returns the name of the character set
     */
    function sql_client_encoding($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_client_encoding($conn);
    }

    /**
     * Returns the array that column names of the table
     */
    function sql_getTableColumnNames($tablename)
    {
        global $MYSQL_CONN;
        if (! $MYSQL_CONN) {
            return array();
        }

        if (str_contains($tablename, '[@prefix@]')) {
            $tablename = parseQuery($tablename);
        }
        $sql    = sprintf('SHOW COLUMNS FROM `%s` ', $tablename);
        $target = 'Field';

        $items = array();
        $res   = mysql_query($sql);
        if (! $res) {
            return array();
        }
        while ($row = mysql_fetch_array($res)) {
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
        $names = sql_getTableColumnNames($tablename);

        if (! count($names)) {
            return false;
        }
        if ($casesensitive) {
            return in_array($ColumnName, $names);
        }

        foreach ($names as $v) {
            if (strcasecmp($ColumnName, $v) != 0) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * Returns the boolean value that column name of the table exist or not
     */
    function sql_existTableName($tablename)
    {
        global $MYSQL_CONN;
        if (! $MYSQL_CONN) {
            return false;
        }

        if (str_contains($tablename, '[@prefix@]')) {
            $tablename = parseQuery($tablename);
        }
        $sql = sprintf(
            "SHOW TABLES LIKE '%s' ",
            mysql_real_escape_string($tablename)
        );
        $res = mysql_query($sql);

        return ($res && ($r = mysql_fetch_array($res))
                && ! empty($r)); // PHP(-5.4) Parse error: empty($var = "")  syntax error
    }

    /**
     * Get SQL client version
     */
    function sql_get_client_info()
    {
        return mysql_get_client_info();
    }

    function sql_get_db()
    {
        global $MYSQL_CONN;

        return $MYSQL_CONN;
    }

    /**
     * Get SQL server version
     */
    function sql_get_server_info($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_get_server_info($conn);
    }

    /**
     * Returns a string describing the type of SQL connection in use for the connection or false on failure
     */
    function sql_get_host_info($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

        return mysql_get_host_info($conn);
    }

    /**
     * Returns the SQL protocol on success, or false on failure.
     */
    function sql_get_proto_info($conn = false)
    {
        global $MYSQL_CONN;
        if (! $conn) {
            $conn = $MYSQL_CONN;
        }

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
     * Unimplemented mysql_* functions
     *
     * # mysql_ data_ seek (maybe useful)
     * # mysql_ errno (maybe useful)
     * # mysql_ fetch_ lengths (maybe useful)
     * # mysql_ field_ flags (maybe useful)
     * # mysql_ field_ len (maybe useful)
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
     * NOTE: shift_jis is only supported for output. Using shift_jis in DB is prohibited.
     * NOTE: iso-8859-x,windows-125x if _CHARSET is unset.
     */
    function sql_set_charset($charset, $conn = false)
    {
        $conn     = ($conn ? $conn : sql_get_db());
        $charset  = get_mysql_charset_from_php_charset($charset);
        $mySqlVer = sql_get_server_version();

        if (defined('_CHARSET')) {
            $_CHARSET = strtolower(_CHARSET);
        } else {
            $_CHARSET = '';
        }

        if (version_compare($mySqlVer, '5.0.7', '>=')) {
            if (function_exists('mysql_set_charset')) {
                $res = mysql_set_charset($charset, $conn);
            } else {
                $res = sql_query("SET CHARACTER SET {$charset}", $conn);
            }
        } elseif ($charset === 'utf8mb4') {
            $res = sql_query("SET NAMES 'utf8mb4'", $conn);
        } elseif ($charset === 'utf8' && $_CHARSET === 'utf-8') {
            $res = sql_query("SET NAMES 'utf8'", $conn);
        } elseif ($charset === 'ujis' && $_CHARSET === 'euc-jp') {
            $res = sql_query("SET NAMES 'ujis'", $conn);
        }

        // retry : workaround for Can't initialize character set utf8mb4
        if (($res === false)
            && $charset
               === 'utf8mb4') {  // utf8mb4 : mysql_version 5.5 or higher
            $res = sql_set_charset('utf8', $conn);
            if ($res) {
                if (function_exists('mysql_set_charset')) {
                    $res = mysql_set_charset($charset, $conn);
                } else {
                    $res = sql_query("SET CHARACTER SET {$charset}", $conn);
                }
                if (! $res) {
                    $res = sql_query("SET CHARACTER SET {$charset}", $conn);
                }
            }
        }

        return isset($res) ? $res : false;
    }

    function sql_set_charset_v2($charset, $conn = false)
    {
        global $DB_DRIVER_NAME, $MYSQL_CONN;
        $conn = ($conn ? $conn : sql_get_db());
        if ($DB_DRIVER_NAME == 'mysql') {
            $charsetOfDB = getCharSetFromDB(sql_table('config'), 'name', $conn);
            if ((stripos($charset, 'utf') !== false)
                && (stripos($charsetOfDB, 'utf8') !== false)) {
                $charset = $charsetOfDB;
            } // work around for utf8mb4_general_ci

            return sql_set_charset($charset, $conn);
        }

        return sql_set_charset($charset, $conn);
    }
}
