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
    if (!defined('_CHARSET')) {
        define('_CHARSET', 'UTF-8');
    }
    $lang = sprintf('lang="%s"', (defined('_HTML_5_LANG_CODE') ? _HTML_5_LANG_CODE : 'en'));
    sendContentType('text/html', '', _CHARSET);
    ?>
    <!DOCTYPE html>
    <html <?php echo $lang; ?>>
    <head>
        <meta charset="<?php echo _CHARSET; ?>"/>
        <title><?php echo hsc($title) ?></title></head>
    <body>
    <h1><?php echo hsc($title) ?></h1>
    <?php echo $msg ?>
    </body>
    </html>
    <?php
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
    if ($charset === 'utf8mb4') {
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
            if (getCharSetFromDB(sql_table('item'), 'ibody') === 'utf8mb4') {
                $charset = 'utf8mb4';
            } else {
                $charset = 'utf8';
            }
            break;
        default:
            if (preg_match('#^iso-8859-(\d+)$#i', $charset, $m)) {
                $db = sql_get_db();
                if ($db) { // ISO 8859-  2 8 7 9 13
                    $res = sql_query("SHOW CHARACTER SET where Description LIKE 'ISO 8859-{$m[1]} %'", $db);
                    if ($res && ($items = sql_fetch_assoc($res)) && !empty($items['Charset'])) {
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
    if (!str_contains($collation, '_')) {
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

function is_sql_result($res)
{
    return _EXT_MYSQL_EMULATE ? is_object($res) : is_resource($res);
}

function sql_get_server_version($conn_or_dbh = null)
{
    $dbh = (!empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());
    return implode('.', array_map('intval', explode('.', sql_get_server_info($dbh))));
}

function sql_get_mysql_sqlmode($conn_or_dbh = null)
{
    $dbh = (!empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());
    $q   = sql_query("SELECT @@SESSION.sql_mode;", $dbh);
    if (!$q) {
        return '';
    }
    $row = sql_fetch_array($q);
    return (empty($row) ? '' : strtoupper($row[0]));
}

function fix_mysql_sqlmode($conn_or_dbh = null)
{
    $dbh     = (!empty($conn_or_dbh) ? $conn_or_dbh : sql_get_db());
    $sqlmode = sql_get_mysql_sqlmode($dbh);
    if (empty($sqlmode)
        || version_compare(sql_get_server_version($dbh), '5.6.0', '<')) {
        return;
    }
    $options     = array_diff(explode(',', $sqlmode), array('NO_ZERO_DATE', 'NO_ZERO_IN_DATE'));
    $new_sqlmode = implode(',', $options);
    if (strcmp($sqlmode, $new_sqlmode) != 0) {
        sql_query(sprintf("SET SESSION sql_mode = '%s';", $new_sqlmode), $dbh);
    }
}
