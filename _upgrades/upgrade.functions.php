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
 * Some functions common to all upgrade scripts
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

/*************************************************************
 *     NOTE: With upgrade to 3.6, need to set this to use sql_* API           *
 **************************************************************/

    if (is_file('../config.php'))
        include('../config.php');
    else
        include('../../config.php');

    function load_upgrade_lang() {
        $_ = getLanguageName();
        $langNames[] = stripos($_,'japan')!==false ? 'japanese' : $_;
        $langNames[] = 'english';
        foreach($langNames as $langName) {
            $lang_path = dirname(__FILE__) . "/upgrade_lang_{$langName}.php";
            if(is_file($lang_path)) break;
            else $lang_path = false;
        }
        if($lang_path) include_once($lang_path);
    }

    function upgrade_checkinstall($version) {
        $installed = 0;
        global $DB_DRIVER_NAME;

        if ($DB_DRIVER_NAME == 'sqlite' && $version<=380)  return TRUE;

        switch($version) {
            case '300':
                if (!sql_existTableName(sql_table('config'))) //  < 250
                    return FALSE;
            default:  // 250 - 380
                $query = sprintf("SELECT * FROM %s WHERE name='DatabaseVersion' and value>=%d LIMIT 1", sql_table('config'), intval($version));
                $minrows = 1;
                break;
        }

        $count = 0;
        $res = sql_query($query);
        while ( $res && sql_fetch_object($res))
            $count++;
        $installed = ($res && ($count >= $minrows));
        return $installed;
    }


    function upgrade_getNucleusVersion() {
        return getNucleusVersion();
    }

    function upgrade_showLogin($type) {
        upgrade_head();
    ?>
        <h1><?php echo _UPG_TEXT_PLEASE_LOGIN;  ?></h1>
        <p><?php echo _UPG_TEXT_ENTER_YOUR_DATA;  ?>:</p>

        <form method="post" action="<?php echo $type?>">

            <ul>
                <li><?php echo _UPG_TEXT_NAME; ?>: <input name="login" /></li>
                <li><?php echo _UPG_TEXT_PASSWORD; ?> <input name="password" type="password" /></li>
            </ul>

            <p>
                <input name="action" value="login" type="hidden" />
                <input type="submit" value="<?php echo _UPG_TEXT_LOGIN; ?>" />
            </p>

        </form>
    <?php       upgrade_foot();
        exit;
    }

    function upgrade_head() {
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo _UPG_TEXT_NUCLEUS_UPGRADE; ?></title>
    <link rel="stylesheet" href="../nucleus/styles/manual.css" type="text/css" />
</head>
<body>
    <?php
    }

    function upgrade_foot() {
    ?>
    </body>
</html>
    <?php
    }

    function upgrade_error($msg) {
        upgrade_head();

        echo "\n<h1>" . _UPG_TEXT_ERROR_FAILED . "</h1>\n";
        echo "\n<p>" . _UPG_TEXT_ERROR_WAS . ":</p>\n";
        echo sprintf("<blockquote><div>%s</div></blockquote>" , $msg);

        echo sprintf('<p><a href="index.php" onclick="history.back();">%s</a></p>' , _UPG_TEXT_BACK);

        upgrade_foot();
        exit;
    }


    function upgrade_start() {
        global $upgrade_failures;
        $upgrade_failures = 0;

        upgrade_head();

        echo "<h1>" . _UPG_TEXT_EXECUTING_UPGRADES . "</h1>\n<ul>\n";
    }

    function upgrade_end($msg = "") {
        global $upgrade_failures;
        $from = intGetVar('from');
        if ($upgrade_failures > 0)
            $msg = _UPG_TEXT_QUERIES_HAVE_FAILED_01;

        echo "</ul>\n";
        echo "<h1>" . _UPG_TEXT_UPGRADE_COMPLETED_TITLE . "</h1>\n";
        echo "<p>" . $msg . "</p>\n";

        echo sprintf("<p>" . _UPG_TEXT_BACK_TO_OVERVIEW . "</p>\n", "index.php" . ($from>0 ? '?from='.$from : ''));

        upgrade_foot();
        exit;
    }

    /**
      * Tries to execute a query, gives a message when failed
      *
      * @param friendly name
      * @param query
      */
    function upgrade_query($friendly, $query) {
        global $upgrade_failures;

        echo "<li>$friendly ... ";
        $res = sql_query($query);
        if (!$res) {
            echo '<span style="color:red">' . _UPG_TEXT_FAILURE . "</span>\n";
            echo "<blockquote>" . _UPG_TEXT_REASON_FOR_FAILURE . ": " . sql_error() . " </blockquote>";
            $upgrade_failures++;
        } else {
            echo '<span style="color:green">' . _UPG_TEXT_SUCCESS . "</span><br />\n";
        }
        echo "</li>";
        return $res;
    }

    /**
      * Tries to update database version, gives a message when failed
      *
      * @param $version
      *     Schema version the database has been upgraded to
      */
    function update_version($version) {
        global $upgrade_failures;
        $message = "Updating DatabaseVersion in config table to ${version}";
        if(0==$upgrade_failures){
            $query = sprintf("UPDATE %s set value='%s' where name='DatabaseVersion'", sql_table('config'), $version);
            upgrade_query($message, $query);
        }else
            echo '<li>'.$message.' ... <span class="warning">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>';
    }

    /**
     * @param $table
     *        table to check (without prefix)
     * @param $aColumns
     *        array of column names included
     */
    function upgrade_checkIfIndexExists($table, $aColumns) {
        // get info for indices from database

        $aIndices = array();
        $res = sql_query( sprintf('show index from %s', sql_table($table)) );
        if ($res)
        while ($o = sql_fetch_object($res)) {
            if (!$aIndices[$o->Key_name]) {
                $aIndices[$o->Key_name] = array();
            }
            array_push($aIndices[$o->Key_name], $o->Column_name);
        }

        // compare each index with parameter
        foreach ($aIndices as $keyName => $aIndexColumns) {
            $aDiff = array_diff($aIndexColumns, $aColumns);
            if (count($aDiff) == 0) return 1;
        }

        return 0;

    }

    /**
      * Checks to see if a given table exists
      *
      * @param $table
      *     Name of table to check for existance of
      *     Uses sql_table internally
      * @return true if table exists, false otherwise.
      */
    function upgrade_checkIfTableExists($table){
        $res = sql_query( sprntf("SHOW TABLES LIKE '%s'", sql_table($table)) );
        return ($res != 0) && (sql_num_rows($res) == 1);
    }

    /**
      * Checks to see if a given configuration value exists
      *
      * @param $name
      *     Config value to check for existance of.
      *     Paramater must be MySQL escaped
      * @return true if configuration value exists, false otherwise.
      */
    function upgrade_checkIfCVExists($name){
        $res = sql_query( sprintf("SELECT name from %s WHERE name='%s'", sql_table('config'), $name) );
        return ($res != 0) && (sql_num_rows($res) == 1);
    }

    /**
      * Checks to see if a given column exists
      *
      * @param $table
      *     Name of table to check for column in
      *     Uses sql_table internally
      * @param $col
      *     Name of column to check for existance of
      * @return true if column exists, false otherwise.
      */
    function upgrade_checkIfColumnExists($table, $col){
        $res = sql_query( sprintf('DESC `%s` `%s`', sql_table($table), $col) );
        return ($res != 0) && (sql_num_rows($res) == 1);
    }
