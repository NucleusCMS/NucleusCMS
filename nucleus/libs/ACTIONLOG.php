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
 * Actionlog class for Nucleus
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

define('ERROR',1);        // only errors
define('WARNING',2);    // errors and warnings
define('INFO',3);        // info, errors and warnings
define('DEBUG',4);        // everything
$CONF['LogLevel'] = INFO;

class ACTIONLOG {

    /**
      * (Static) Method to add a message to the action log
      */
    public static function add($level, $message) {
        global $member, $CONF, $DB_PHP_MODULE_NAME;

        if ($CONF['LogLevel'] < $level)
            return;

        if ($member && $member->isLoggedIn())
            $message = sprintf('[%s] %s', $member->getDisplayName(), $message);

        $timestamp = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);    // format timestamp
        if ($DB_PHP_MODULE_NAME == 'pdo') {
            $query = sprintf("INSERT INTO `%s` (timestamp, message) VALUES (?, ?)" , sql_table('actionlog'));
            sql_prepare_execute($query , array((string) $timestamp, (string) $message));
        } else {
            $message = sql_quote_string($message);        // add slashes
            $query = sprintf("INSERT INTO `%s` (timestamp, message) VALUES ('%s', %s)", sql_table('actionlog'), $timestamp, $message);
            sql_query($query);
        }

        ACTIONLOG::trimLog();
    }

    /**
      * (Static) Method to add a message to the action log
      * If the same message, the old one will be erased.
      */
    public static function addUnique($level, $message) {
        global $member, $CONF, $DB_PHP_MODULE_NAME;

        if ($CONF['LogLevel'] < $level)
            return;

        $msg = $message;
        if ($member && $member->isLoggedIn())
            $msg = "[" . $member->getDisplayName() . "] " . $msg;

        if ($DB_PHP_MODULE_NAME == 'pdo') {
            $query = sprintf("DELETE FROM `%s` WHERE message = ?" , sql_table('actionlog'));
            sql_prepare_execute($query , array((string) $msg));
        } else {
            $query = sprintf("DELETE FROM `%s` WHERE message = %s" , sql_table('actionlog') , sql_quote_string($msg) );
            sql_query($query);
        }

        ACTIONLOG::add($level, $message);
    }

    /**
      * (Static) Method to clear the whole action log
      */
    public static function clear() {
        global $manager;

        $query = 'DELETE FROM ' . sql_table('actionlog');
        
        $param = array();
        $manager->notify('ActionLogCleared', $param);

        return sql_query($query);
    }

    /**
      * (Static) Method to trim the action log (from over 500 back to 250 entries)
      */
    public static function trimLog() {
        static $checked = 0;

        // only check once per run
        if ($checked) return;

        // trim
        $checked = 1;

        $iTotal = quickQuery('SELECT COUNT(*) AS result FROM ' . sql_table('actionlog'));

        // if size > 500, drop back to about 250
        $iMaxSize = 500;
        $iDropSize = 250;
        if ($iTotal > $iMaxSize) {
            $tsChop = quickQuery('SELECT timestamp as result FROM ' . sql_table('actionlog') . ' ORDER BY timestamp DESC LIMIT '.$iDropSize.',1');
            sql_query('DELETE FROM ' . sql_table('actionlog') . ' WHERE timestamp < \'' . $tsChop . '\'');
        }

    }

}
