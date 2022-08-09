<?php

// Nucleus CMS

define('_EXT_MYSQL_EMULATE', 1);

define('MYSQL_ASSOC', 1);
define('MYSQL_NUM', 2);
define('MYSQL_BOTH', 3);

function _mysql_add_admin_warnings($funcname)
{
    static $names = array();
    global $SQL_DBH;
    if ($SQL_DBH && is_object($SQL_DBH) && class_exists('SYSTEMLOG') && !in_array($names, $funcname)) {
        $names[] = $funcname;
        $message = sprintf(
            '%s : An incompatible function was called. Please change to %s .',
            $funcname,
            substr($funcname, 2)
        );
        SYSTEMLOG::addUnique('error', 'Warning', $message);
    }
}

function mysql_query($query, $dblink = null)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    global $SQL_DBH;
    $o = ($dblink ? $dblink : $SQL_DBH);
    if ($o && is_object($o) && method_exists($o, 'query')) {
        return $o->query($query);
    }
    return false;
}

function mysql_error($dblink = null)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    global $SQL_DBH;
    $o = ($dblink ? $dblink : $SQL_DBH);
    if ($o && is_object($o) && method_exists($o, 'errorInfo ')) {
        $msg = $o->errorInfo();
        if (!empty($msg[2])) {
            return (string)$msg[2];
        }
    }
    return '';
}

function mysql_num_rows($res)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    if ($res && is_object($res) && method_exists($res, 'rowCount')) {
        return $res->rowCount();
    }
    return false;
}

function mysql_fetch_object($res)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    if ($res && is_object($res) && method_exists($res, 'fetchObject')) {
        return $res->fetchObject();
    }
    return false;
}

function mysql_fetch_assoc($res)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    if ($res && is_object($res) && method_exists($res, 'fetch')) {
        return $res->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}

function mysql_fetch_array($res, $result_type = MYSQL_BOTH)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    if ($result_type == MYSQL_ASSOC) {
        $p = PDO::FETCH_ASSOC;
    } else {
        if ($result_type == MYSQL_NUM) {
            $p = PDO::FETCH_NUM;
        } else {
            $p = PDO::FETCH_BOTH;
        }
    }
    if ($res && is_object($res) && method_exists($res, 'fetch')) {
        return $res->fetch($p);
    }
    return false;
}

// int mysql_insert_id ([ resource $link_identifier = NULL ] )
function mysql_insert_id($res)
{
    _mysql_add_admin_warnings(__FUNCTION__);
    if ($res && is_object($res) && method_exists($res, 'lastInsertId')) {
        return $res->lastInsertId();
    }
    return false;
}
