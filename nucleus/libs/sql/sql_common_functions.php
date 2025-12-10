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

/**
 * Errors before the database connection has been made
 */
function startUpError($msg, $title)
{
    if ( ! defined('_CHARSET')) {
        define('_CHARSET', 'UTF-8');
    }
    if ( ! defined('NC_LIBS_PATH')) {
        define('NC_LIBS_PATH', dirname(__DIR__) . '/');
    }
    $tpl             = file_get_contents(NC_LIBS_PATH . 'template/startup_error.template');
    $ph              = [];
    $ph['lang_code'] = defined('_HTML_5_LANG_CODE') ? _HTML_5_LANG_CODE : 'en';
    $ph['CHARSET']   = _CHARSET;
    $ph['title']     = hsc($title);
    $ph['msg']       = $msg;
    sendContentTypeEx('text/html', ['http_code' => '503']);
    echo parseHtml($tpl, $ph);
    exit;
}

function sqldate($timestamp)
{
    return sql_quote_string(date('Y-m-d H:i:s', $timestamp));
}

function sql_timestamp_from_utime($timestamp)
{
    return date('Y-m-d H:i:s', $timestamp);
}

function sql_gmDateTime_from_utime($timestamp)
{
    return gmdate('Y-m-d H:i:s', $timestamp);
}

function get_mysql_charset_from_php_charset($charset = 'utf-8')
{
    switch (strtolower($charset)) {
        case 'utf-8':
            $charset = 'utf8';
            break;
        case 'euc-jp':
            $charset = 'ujis';
            break;
        case 'iso-8859-1':
            $charset = 'latin1';
            break;
        case 'windows-1250':
            $charset = 'cp1250';
            break; // cp1250_general_ci
        default:
            global $DB_DRIVER_NAME;
            if ('mysql' === $DB_DRIVER_NAME
                && preg_match('#^iso-8859-(\d+)$#i', $charset, $m)) {
                $db = sql_get_db();
                if ($db) { // ISO 8859-  2 8 7 9 13
                    $res
                        = sql_query(
                            "SHOW CHARACTER SET where Description LIKE 'ISO 8859-{$m[1]} %'",
                            $db
                        );
                    if ($res && ($items = sql_fetch_assoc($res))
                        && ! empty($items['Charset'])) {
                        return $items['Charset'];
                    }
                }
            }
    }

    return $charset;
}

function get_charname_from_langname($language_name = 'english-utf8')
{
    $language_name = strtolower($language_name);

    if (str_contains(strtolower($language_name), 'utf8')) {
        return 'utf8';
    }

    switch ($language_name) {
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
        case 'korean-utf8':
        case 'persian':
        default:
            $charset_name = 'utf8';
    }

    return $charset_name;
}

function treat_char_name($charset = 'utf8mb4')
{
    if ('utf8mb4' === $charset) {
        return 'utf8mb4';
    }

    switch (strtolower($charset)) {
        case 'euc-jp':
            $charset = 'ujis';
            break;
        case 'iso-8859-1':
            $charset = 'latin1';
            break;
        case 'windows-1250':
            $charset = 'cp1250';
            break; // cp1250_general_ci
        case 'utf8':
        case 'utf-8':
            if ('utf8mb4' === getCharSetFromDB(sql_table('item'), 'ibody')) {
                $charset = 'utf8mb4';
            } else {
                $charset = 'utf8';
            }
            break;
        default:
            if (preg_match('#^iso-8859-(\d+)$#i', $charset, $m)) {
                $db = sql_get_db();
                if ($db) { // ISO 8859-  2 8 7 9 13
                    $res
                        = sql_query(
                            "SHOW CHARACTER SET where Description LIKE 'ISO 8859-{$m[1]} %'",
                            $db
                        );
                    if ($res && ($items = sql_fetch_assoc($res))
                        && ! empty($items['Charset'])) {
                        return $items['Charset'];
                    }
                }
            }
    }

    return $charset;
}

function getCharSetFromDB($tableName, $columnName, $dbh = null)
{
    $collation = getCollationFromDB($tableName, $columnName, $dbh);
    if ( ! str_contains($collation, '_')) {
        $charset = $collation;
    } else {
        [$charset, $dummy] = explode('_', $collation, 2);
    }

    return $charset;
}

function getCollationFromDB($tableName, $columnName, $dbh = null)
{
    $columns
            = sql_query(
                "SHOW FULL COLUMNS FROM `{$tableName}` LIKE '{$columnName}'",
                $dbh
            );
    $column = sql_fetch_object($columns);

    return $column->Collation ?? false;
}

function is_sql_result($res)
{
    return _EXT_MYSQL_EMULATE ? is_object($res) : is_resource($res);
}

function selectQuery($table_name, $where = '', $fields = '*', $extra = [])
{
    if (is_array($table_name)) {
        $table_name = implode(' ', $table_name);
    }
    $table_name = parseQuery($table_name);
    if (is_array($fields)) {
        $fields = _getFieldsStringFromArray($fields);
    }
    if (is_array($where)) {
        $where = implode(' ', $where);
    }
    if (is_array($extra)) {
        $extra = implode(' ', $extra);
    }

    if (trim($where)) {
        $where = "WHERE {$where}";
    }

    return "SELECT {$fields} FROM {$table_name} {$where} {$extra}";
}

function updateQuery(string $table_name, array $values, string|array $where = '', array $extra = [])
{
    if (is_array($where)) {
        $where = implode(' ', $where);
    }
    // $extra : not implemented
    $qb = getOrmQueryBuilder()
            ->update(parseQuery($table_name));
    foreach (array_keys($values) as $key) {
        if (str_starts_with($key, ':')) {
            $key = substr($key, 1);
        }
        $qb->set($key, ":{$key}");
    }
    $qb->setParameters($values)
       ->where($where)
       ->executeStatement();
}

function _getFieldsStringFromArray($fields = [])
{
    if (empty($fields)) {
        return '*';
    }

    $_ = [];
    foreach ($fields as $k => $v) {
        if (preg_match('@^[0-9]+$@', $k)) {
            $_[] = $v;
        } elseif (str_contains($v, ',')) {
            $_[] = $v;
        } elseif (str_contains($v, ' ')) {
            $_[] = $v;
        } elseif ($k !== $v) {
            $_[] = "{$v} as {$k}";
        } else {
            $_[] = $v;
        }
    }
    if (0 === stripos($_[0], 'distinct')) {
        $_[0] = preg_replace('@^distinct[, ]*@i', '', $_[0]);
    }

    return implode(',', $_);
}

function sql_get_server_version($conn_or_dbh = null)
{
    $dbh = ( ! empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());

    return implode(
        '.',
        array_map('intval', explode('.', sql_get_server_info($dbh)))
    );
}

function sql_get_mysql_sqlmode($conn_or_dbh = null)
{
    $dbh = ( ! empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());
    $q   = sql_query("SELECT @@SESSION.sql_mode;", $dbh);
    if ( ! $q) {
        return '';
    }
    $row = sql_fetch_array($q);

    return (empty($row) ? '' : strtoupper($row[0]));
}

function fix_mysql_sqlmode($conn_or_dbh = null)
{
    $dbh = ( ! empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());
    if (version_compare(sql_get_server_version($dbh), '5.6.0', '<')) {
        return;
    }
    // MySQL 8.0 : ONLY_FULL_GROUP_BY, STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_ENGINE_SUBSTITUTION
    // Error reporting on forums : ONLY_FULL_GROUP_BY, STRICT_TRANS_TABLES, NO_ZERO_IN_DATE, NO_ZERO_DATE
    $options = [
        'PIPES_AS_CONCAT', //  || is string concatenation in standard SQL
        'ERROR_FOR_DIVISION_BY_ZERO',
        'NO_ENGINE_SUBSTITUTION',
    ];
    $new_sqlmode = implode(',', $options);
    sql_query(sprintf("SET SESSION sql_mode = '%s';", $new_sqlmode), $dbh);
}

/**
 * Doctrine\DBAL\DriverManager::getConnection
 */
function getOrmConnection(): ?\Doctrine\DBAL\Connection
{
    global $ORM_CONN;
    return $ORM_CONN ? $ORM_CONN : null;
}

/**
 *
 */
function getOrmSchemaManager(): ?\Doctrine\DBAL\Schema\AbstractSchemaManager
{
    $conn = getOrmConnection();

    return $conn ? $conn->createSchemaManager() : null;
}

/**
 *
 */
function getOrmQueryBuilder(): ?\Doctrine\DBAL\Query\QueryBuilder
{
    $conn = getOrmConnection();

    return $conn ? $conn->createQueryBuilder() : null;
}

/**
 * Connects to Database server
 */
function orm_connect_args(
    $db_host = 'localhost',
    $db_user = '',
    $db_password = '',
    $db_name = ''
) {
    global $DB_DRIVER_NAME;
    if ( ! class_exists('Doctrine\DBAL\DriverManager')) {
        require_once __DIR__ . '/../vendor/autoload.php';
    }

    ini_set('default_charset', "UTF-8");

    if ( ! class_exists('PDO')) {
        exit('Critical error. pdo module is not loaded.');
    }

    $supported_drivers = ['mysql', 'sqlite', 'pgsql'];
    //  $supported_drivers[] = 'drivername'; // for debug

    if (
        empty($DB_DRIVER_NAME) ||
        ! in_array(strtolower($DB_DRIVER_NAME), $supported_drivers)
    ) {
        exit('Critical error: Invalid driver name. Check the config file.');
    }
    if (null === $db_name) {
        $db_name = '';
    }
    if (null === $db_password) {
        $db_password = '';
    }

    $options = [
         PDO::ATTR_ERRMODE          => PDO::ERRMODE_SILENT,
         PDO::ATTR_EMULATE_PREPARES => false,
         //PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
//           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $conn = null;
    try {
        if ( ! str_contains($db_host, ':')) {
            $host    = $db_host;
            $port    = '';
            $portnum = '';
        } else {
            [$host, $port] = explode(":", $db_host);
            if (isset($port)) {
                $portnum = $port;
                $port    = ';port=' . trim($port);
            } else {
                $port    = '';
                $portnum = '';
            }
        }

        switch (strtolower($DB_DRIVER_NAME)) {
            case 'sqlite':
                if ( ! extension_loaded('PDO_SQLITE')) {
                    $msg = 'Critical error: pdo_sqlite module is not loaded.';
                    startUpError($msg, 'Connect Error');
                }

                // check file path
                $db_path = trim(dirname($db_name));
                if (':memory:' !== $db_name) {
                    if (
                        (0 == strlen($db_path)) || ! is_dir($db_path)
                        || ( ! str_contains(str_replace("\\", '/', $db_path), '/'))
                    ) {
                        exit('ERROR : database filename maybe wrong ');
                    }
                }
                $connectionParams = [
                    'driver' => 'pdo_sqlite',
//                        'user' => $db_user,
//                        'password' => $db_password,
                    'path' => $db_name,
//                        'memory' => ':memory:' === $db_name,
                  ];
                break;
            case 'mysql':
                $connectionParams = [
                    'driver'   => 'pdo_mysql',
                    'user'     => $db_user,
                    'password' => $db_password,
                    'host'     => $db_host,
                    'dbname'   => $db_name,
                    'charset'  => 'utf8',
                  ];
                if ('' !== $portnum) {
                    $connectionParams['port'] = (int) $portnum;
                }
                break;
            case 'pgsql':
                $connectionParams = [
                    'driver'   => 'pdo_pgsql',
                    'user'     => $db_user,
                    'password' => $db_password,
                    'host'     => $db_host,
                    'dbname'   => $db_name,
                    'charset'  => 'utf8',
                  ];
                if ('' !== $portnum) {
                    $connectionParams['port'] = (int) $portnum;
                }
                // [Error] An exception occurred in the driver: SQLSTATE[08006] [7] FATAL: データベース"ユーザー名"は存在しません
                // データベース名: 未指定の場合はログインユーザー名のデータベースに接続する仕様
                // データベース指定しない場合は、postgresに接続しておく
                if (('' === $db_name) && isset($connectionParams['dbname'])) {
                    $connectionParams['dbname'] = 'postgres';
                }
                break;
            default:
                $msg = sprintf("<h1>Critical Error</h1><p>%s driver is not suported.</p>", escapeHTML($DB_DRIVER_NAME))
                            . "<p>Please check whether there is misspelling. Supported are 'mysql', 'sqlite', 'pgsql'.</p>";
                trigger_error($msg, E_USER_ERROR);
                break;
        }

        $conn   = null;
        $config = new Doctrine\DBAL\Configuration($options);
        try {
            $old_display_errors = ini_get('display_errors');
            ini_set('display_errors', 0);
            $conn = Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
            $DBH  = $conn ? $conn->getNativeConnection() : null;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            $conn = null;
            $DBH  = null;
            throw $exc;
        } finally {
            ini_set('display_errors', $old_display_errors);
        }
        if ($conn && $DBH) {
            switch (strtolower($DB_DRIVER_NAME)) {
                case 'mysql':
                    $charset = 'utf8';
                    if (
                        version_compare('5.5.0', sql_get_server_version($DBH), '<=')
                        && sql_query("SHOW CHARACTER SET LIKE 'utf8mb4'", $DBH)
                    ) {
                        $charset = 'utf8mb4';
                    }
                    sql_set_charset($charset, $DBH);
                    fix_mysql_sqlmode($DBH);
                    break;
                case 'sqlite':
                    if ( ! class_exists('sqlite_functions')) {
                        require_once(__DIR__ . '/sqlite_functions.php');
                    }
                    sqlite_functions::pdo_register_user_functions($DBH);
                    break;
            }
        }
    } catch (Exception $e) {
        $conn = null;
        $DBH  = $m = null;
        unset($conn);
        $msg = '<b>Could not connect to database.</b>';
        if (($e instanceof \Doctrine\DBAL\Exception\ConnectionException)
         || ($e instanceof PDOException)
        ) {
            if (defined('NC_MTN_MODE') && (NC_MTN_MODE === 'install')) {
                $m = trim($e->getMessage());
                if ( ! empty($m)) {
                    $m = mb_convert_encoding($m, 'UTF-8', 'AUTO,UTF-8,SJIS-WIN,EUC-JP');
                    $msg .= sprintf("<br />%s\n", htmlspecialchars($m, ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED));
                }
            } elseif (isDebugMode()) {
                if (preg_match('#^(SQLSTATE[^\'\"]+[^:\'\"/]+)#', $e->getMessage(), $m)) {
                    $msg .= sprintf("<br />%s\n", escapeHTML($m[1]));
                }
            }
        }
        startUpError('<div>'. $msg . '</div>', 'Error');
        exit;
    }

    return $conn;
}

/**
 * Connects to Database server
 */
function orm_connect()
{
    global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE;
    global $SQL_DBH, $ORM_CONN;

    $ORM_CONN = null;
    try {
        // 失敗すると接続情報吐き出すので tryで保護する
        $conn = orm_connect_args(
            $DB_HOST,
            $DB_USER,
            $DB_PASSWORD,
            $DB_DATABASE
        );
    } catch (Exception $exc) {
        //echo $exc->getTraceAsString();
    }
    if (empty($conn)) {
        $title = 'Error';
        $msg   = '<div><b>Could not connect to database.</b></div>';
        startUpError($msg, $title);
        exit;
    }
    $SQL_DBH  = $conn->getNativeConnection();
    $ORM_CONN = $conn;
    return $ORM_CONN;
}

/**
 *
 */
function ormCreateTable(\Doctrine\DBAL\Schema\Table $table): void
{
    $schemamanager = getOrmSchemaManager();
    if ($schemamanager instanceof \Doctrine\DBAL\Schema\MySQLSchemaManager) {
        if (empty($table->getOption('engine'))) {
            $table->addOption('engine', "InnoDB");
        }
    } elseif (getOrmSchemaManager() instanceof \Doctrine\DBAL\Schema\PostgreSQLSchemaManager) {
    } elseif (getOrmSchemaManager() instanceof \Doctrine\DBAL\Schema\SQLiteSchemaManager) {
    }
    $schemamanager->createTable($table);
}
