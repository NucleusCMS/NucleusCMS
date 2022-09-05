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
 */

/**
 * @license   http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 */

/*
 * if no mysql_* functions exist, define wrappers
 */

$MYSQL_CONN = 0;

if (! function_exists('mysqli_query') && function_exists('startUpError')) {
    startUpError(_NO_SUITABLE_MYSQL_LIBRARY);
}

define('_EXT_MYSQL_EMULATE', 1);

define('MYSQL_ASSOC', 1);
define('MYSQL_NUM', 2);
define('MYSQL_BOTH', 3);

if (! defined('MYSQLI_TYPE_BIT')) {
    define('MYSQLI_TYPE_BIT', 16);
}
if (! defined('MYSQLI_TYPE_TINY')) {
    define('MYSQLI_TYPE_TINY', 1);
}
if (! defined('MYSQLI_TYPE_NEWDECIMAL')) {
    define('MYSQLI_TYPE_NEWDECIMAL', 246);
}
if (! defined('MYSQLI_TYPE_YEAR')) {
    define('MYSQLI_TYPE_YEAR', 13);
}
if (! defined('MYSQLI_TYPE_NEWDATE')) {
    define('MYSQLI_TYPE_NEWDATE', 14);
}
if (! defined('MYSQLI_TYPE_GEOMETRY')) {
    define('MYSQLI_TYPE_GEOMETRY', 255);
}

function mysql_query($query, $dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_query($link, $query);
}

function mysql_fetch_object($res)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_fetch_object($res);
}

function mysql_fetch_array($res, $result_type = MYSQL_BOTH)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_fetch_array($res, $result_type);
    // MYSQLI_ASSOC = MYSQL_ASSOC  : 1
    // MYSQLI_NUM   = MYSQL_NUM    : 2
    // MYSQLI_BOTH  = MYSQL_BOTH   : 3
}

function mysql_fetch_assoc($res)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_fetch_assoc($res);
}

function mysql_fetch_row($res)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_fetch_row($res);
}

function mysql_num_rows($res)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_num_rows($res);
}

function mysql_num_fields($res)
{
    if (! is_object($res)) {
        return false;
    }

    return mysqli_num_fields($res);
}

function mysql_free_result($res)
{
    if (! is_object($res)) {
        return false;
    }
    mysqli_free_result($res);
}

function mysql_result($res, $row, $col = 0)
{
    if (! $res) {
        return false;
    }
    $row = (int)$row;
    if (($row < 0) || ($col < 0)) {
        return false;
    }

    if ($row) {
        if (! mysqli_data_seek($res, $row)) {
            return false;
        }
    }
    $data = mysqli_fetch_row($res);
    if (! $data) {
        return false;
    }

    return (isset($data[$col]) ? $data[$col] : false);
}

function mysql_connect($host, $username, $pwd)
{
    global $MYSQL_CONN;

    $MYSQL_CONN = mysqli_connect($host, $username, $pwd);

    return $MYSQL_CONN;
}

function mysql_error($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);
    if (! $link) {
        return 'db handler is null';
    }

    return @mysqli_error($link);
}

function mysql_select_db($db, $dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    try {
        return mysqli_select_db($link, $db);
    } catch (Throwable $t) {
        // Executed only in PHP 7, will not match in PHP 5.x
        return false;
    } catch (Exception $e) {
        // Executed only in PHP 5.x, will not be reached in PHP 7
        return false;
    }
}

function mysql_close($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_close($link);
}

function mysql_insert_id($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_insert_id($link);
}

function mysql_affected_rows($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_affected_rows($link);
}

function mysql_real_escape_string($val, $dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    if (is_null($val)) {
        return '';
    }
    return mysqli_real_escape_string($link, $val);
}

function mysql_get_client_info()
{
    return mysqli_get_client_info();
}

function mysql_get_server_info($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_get_server_info($link);
}

function mysql_errno($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_errno($link);
}

function mysql_set_charset($charset, $dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return mysqli_set_charset($link, $charset);
}

/*
 *  convert mysql field definition object from mysqli  object
  */
function convert_mysqlFieldDefObj_from_mysqliFieldDefObj($obj, $offset = 0)
{
    $o = new stdClass();
    //      $o->mysqli_feild = $obj;
    $o->name         = $obj->name;
    $o->table        = $obj->table;
    $o->def          = $obj->def;
    $o->max_length   = $obj->max_length;
    $o->type         = convert_mysqlFieldType_from_mysqliFieldType($obj->type);
    $o->not_null     = (($obj->flags & MYSQLI_NOT_NULL_FLAG) ? 1 : 0);
    $o->primary_key  = (($obj->flags & MYSQLI_PRI_KEY_FLAG) ? 1 : 0);
    $o->multiple_key = (($obj->flags & MYSQLI_MULTIPLE_KEY_FLAG) ? 1 : 0);
    $o->unique_key   = (($obj->flags & MYSQLI_UNIQUE_KEY_FLAG) ? 1 : 0);
    $o->numeric      = (($obj->flags & MYSQLI_NUM_FLAG) ? 1 : 0);
    $o->blob         = (($obj->flags & MYSQLI_BLOB_FLAG) ? 1 : 0);
    $o->unsigned     = (($obj->flags & MYSQLI_UNSIGNED_FLAG) ? 1 : 0);
    $o->zerofill     = (($obj->flags & MYSQLI_ZEROFILL_FLAG) ? 1 : 0);

    return $o;
}

function mysql_fetch_field($res, $offset = 0)
{
    if ($res) {
        $offset = (int)$offset;
        if (func_num_args() == 1) {
            $finfo = mysqli_fetch_field($res);
        } else {
            $finfo = mysqli_fetch_fields($res);
        }
        if (is_array($finfo)) {
            if ($offset >= 0 && $offset < count($finfo)) {
                return convert_mysqlFieldDefObj_from_mysqliFieldDefObj($finfo[$offset]);
            }

            return false;
        }

        if (is_object($finfo)) {
            return convert_mysqlFieldDefObj_from_mysqliFieldDefObj($finfo);
        }
    }

    return false;
}

function convert_mysqlFieldType_from_mysqliFieldType($type)
{
    // php-src/ext/mysql/php_mysql.c :: php_mysql_get_field_name
    // php-src/ext/mysqlnd/mysqlnd_enum_n_def.h :: enum mysqlnd_field_types
    // php-src/ext/mysqli/mysqli.c :: MYSQLI_TYPE_
    // C lang : MYSQLI_TYPE_ = FIELD_TYPE_ = MYSQL_TYPE_

    switch ($type) {
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

function convert_mysqlFieldFlags_from_mysqliFieldFlags($flags)
{
    // int --> string
    // php-src/ext/mysql/php_mysql.c :: php_mysql_field_info , case PHP_MYSQL_FIELD_FLAGS:
    // php-src/ext/mysqli/mysqli.c :: column information , MYSQLI_*_FLAG

    $a = [];
    // *_FLAG constant min value 1 : mysqlnd_enum_n_def.h
    if ($flags & MYSQLI_NOT_NULL_FLAG) {
        $a[] = "not_null";
    }

    if ($flags & MYSQLI_PRI_KEY_FLAG) {
        $a[] = "primary_key";
    }

    if ($flags & MYSQLI_UNIQUE_KEY_FLAG) {
        $a[] = "unique_key";
    }

    if ($flags & MYSQLI_MULTIPLE_KEY_FLAG) {
        $a[] = "multiple_key";
    }

    if ($flags & MYSQLI_BLOB_FLAG) {
        $a[] = "blob";
    }

    if ($flags & MYSQLI_UNSIGNED_FLAG) {
        $a[] = "unsigned";
    }

    if ($flags & MYSQLI_ZEROFILL_FLAG) {
        $a[] = "zerofill";
    }

    if ($flags & MYSQLI_BINARY_FLAG) {
        $a[] = "binary";
    } // PHP 5.3.0 -

    if ($flags & MYSQLI_ENUM_FLAG) {
        $a[] = "enum";
    }

    if ($flags & MYSQLI_SET_FLAG) {
        $a[] = "set";
    }

    if ($flags & MYSQLI_AUTO_INCREMENT_FLAG) {
        $a[] = "auto_increment";
    }

    if ($flags & MYSQLI_TIMESTAMP_FLAG) {
        $a[] = "timestamp";
    }

    /*      // not defined ext/mysql
        //  unknown: MYSQLI_PART_KEY_FLAG MYSQLI_GROUP_FLAG MYSQLI_NUM_FLAG
        if ($flags & MYSQLI_PART_KEY_FLAG)
            $a[] = "part_key";

        if ($flags & MYSQLI_GROUP_FLAG)
            $a[] = "group";

        if ($flags & MYSQLI_NUM_FLAG)
            $a[] = "num"; // PHP 5.3.0 -
    */

    /*
        $known_flags = 4095;
    //      $known_flags = MYSQLI_NOT_NULL_FLAG | MYSQLI_PRI_KEY_FLAG | MYSQLI_UNIQUE_KEY_FLAG
    //              | MYSQLI_MULTIPLE_KEY_FLAG | MYSQLI_BLOB_FLAG | MYSQLI_UNSIGNED_FLAG
    //              | MYSQLI_ZEROFILL_FLAG | MYSQLI_BINARY_FLAG | MYSQLI_ENUM_FLAG
    //              | MYSQLI_SET_FLAG | MYSQLI_AUTO_INCREMENT_FLAG | MYSQLI_TIMESTAMP_FLAG;
    //      echo sprintf('$known_flags(%d)', $known_flags);

    //      $known_flags = $known_flags | MYSQLI_PART_KEY_FLAG | MYSQLI_GROUP_FLAG | MYSQLI_NUM_FLAG;

        $unknown_flags = $flags & ~$known_flags;
        if ($unknown_flags)
            $a[] = (string)$unknown_flags;
    */

    return implode(' ', $a);
}

function mysql_field_name($res, $offset)
{
    if ($res) {
        $finfo = mysqli_fetch_field_direct($res, $offset);
        if ($finfo && isset($finfo->name)) {
            return $finfo->name;
        }
    }

    return false;
}

function mysql_field_flags($res, $offset)
{
    // mysql_field_flags : string
    // mysqli_fetch_field_direct ->flags : int
    if ($res) {
        $finfo = mysqli_fetch_field_direct($res, $offset);
        if ($finfo && isset($finfo->flags)) {
            return convert_mysqlFieldFlags_from_mysqliFieldFlags($finfo->flags);
        }
    }

    return false;
}

function mysql_field_len($res, $offset)
{
    if ($res) {
        $finfo = mysqli_fetch_field_direct($res, $offset);
        if ($finfo && isset($finfo->length)) {
            return $finfo->length;
        }
    }

    return false;
}

function mysql_field_type($res, $offset)
{
    // mysql_field_type : string
    // mysqli_fetch_field_direct ->type : int
    if ($res) {
        if (func_num_args() != 2) {
            trigger_error('argument must be two', E_USER_WARNING);
        }
        $finfo = mysqli_fetch_field_direct($res, $offset);
        if (is_object($finfo) && isset($finfo->type)) {
            return convert_mysqlFieldType_from_mysqliFieldType($finfo->type);
        }
    }

    return false;
}

function mysql_thread_id($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return ($link ? mysqli_thread_id($link) : false);
}

function mysql_client_encoding($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return ($link ? mysqli_character_set_name($link) : false);
    // mysqli_client_encoding : DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
}

function mysql_data_seek($res, $offset)
{
    if (func_num_args() != 2) {
        trigger_error('argument must be two', E_USER_ERROR);
    }

    return ($res ? mysqli_data_seek($res, $offset) : false);
}

function mysql_get_host_info($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return ($link ? mysqli_get_host_info($link) : false);
}

function mysql_get_proto_info($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return ($link ? mysqli_get_proto_info($link) : false);
}

function mysql_stat($dblink = null)
{
    global $MYSQL_CONN;
    $link = ($dblink ? $dblink : $MYSQL_CONN);

    return ($link ? mysqli_stat($link) : null);
}

function mysql_field_seek($res, $offset)
{
    return ($res ? mysqli_field_seek($res, $offset) : false);
}
