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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

function upgrade_do330() {

    if (upgrade_checkinstall(330))
        return _UPG_TEXT_ALREADY_INSTALLED;

    if (!upgrade_checkIfColumnExists('comment','cemail')) {
        $query = "  ALTER TABLE `" . sql_table('comment') . "`
                    ADD `cemail` VARCHAR( 100 ) AFTER `cmail` ;";

        upgrade_query('Altering ' . sql_table('comment') . ' table', $query);
    }

    if (!upgrade_checkIfColumnExists('blog','breqemail')) {
        $query = "  ALTER TABLE `" . sql_table('blog') . "`
                    ADD `breqemail` TINYINT( 2 ) DEFAULT '0' NOT NULL ;";

        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    // check cmail column to separate to URL and cemail
    sql_query(
        'UPDATE ' . sql_table('comment') . ' ' . 
        "SET cemail = cmail, cmail = '' " .
        "WHERE cmail LIKE '%@%'"
    );

    if (!upgrade_checkIfColumnExists('item','iposted')) {
        $query = "    ALTER TABLE `" . sql_table('item') . "`
                                ADD `iposted` TINYINT(2) DEFAULT 1 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('item') . ' table', $query);
    }

    if (!upgrade_checkIfColumnExists('blog','bfuturepost')) {
        $query = "    ALTER TABLE `" . sql_table('blog') . "`
                                ADD `bfuturepost` TINYINT(2) DEFAULT 0 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    // 3.2 -> 3.3
    // update database version
    update_version('330');

    // check to see if user turn on Weblogs.com ping, if so, suggest to install the plugin
    $query = "SELECT bsendping FROM " . sql_table('blog') . " WHERE bsendping='1'"; 
    $res = sql_query($query);
    if (sql_num_rows($res) > 0) {
        echo "<li>" . _UPG_TEXT_NOTE_PING01 . "</li>";
    }
}

?>
