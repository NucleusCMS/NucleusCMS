<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

upgrade_do331();

function upgrade_do331()
{

    if (upgrade_checkinstall(331)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    if (!upgrade_checkIfColumnExists('item', 'iposted')) {
        $query = "  ALTER TABLE `" . sql_table('item') . "`
                                ADD `iposted` TINYINT(2) DEFAULT 1 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('item') . ' table', $query);
    }

    if (!upgrade_checkIfColumnExists('blog', 'bfuturepost')) {
        $query = "  ALTER TABLE `" . sql_table('blog') . "`
                                ADD `bfuturepost` TINYINT(2) DEFAULT 0 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    // 3.3 -> 3.31
    // update database version
    update_version('331');

    // check to see if user turn on Weblogs.com ping, if so, suggest to install the plugin
    $query = "SELECT bsendping FROM " . sql_table('blog') . " WHERE bsendping='1'";
    $res = sql_query($query);
    if ($res && !($r = sql_fetch_array($res)) && !empty($r)) {  // Fix for PHP(-5.4) Parse error: empty($var = "") or empty(function())
        echo "<li>" . _UPG_TEXT_NOTE_PING01 . "</li>";
    }
}
