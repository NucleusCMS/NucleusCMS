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

function upgrade_do100()
{
    if (upgrade_checkinstall(100)) {
        return "already installed";
    }

    // 1. add extra indices to tables
    if (!upgrade_checkIfIndexExists('item', array('iblog', 'itime'))) {
        $query = 'ALTER TABLE '.sql_table('item').' ADD INDEX(iblog, itime);';
        upgrade_query("Adding extra index to nucleus_item", $query);
    }
    if (!upgrade_checkIfIndexExists('comment', array('citem'))) {
        $query = 'ALTER TABLE '.sql_table('comment').' ADD INDEX(citem);';
        upgrade_query("Adding extra index to nucleus_comment", $query);
    }

    // 2. add DisableJsTools to config
    if (!upgrade_checkIfCVExists('DisableJsTools')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('DisableJsTools', '0');";
        upgrade_query("Adding setting DisableJsTools", $query);
    }

    // 3. Drop primary key in nucleus_actionlog
    $query = 'ALTER TABLE '.sql_table('actionlog').' DROP PRIMARY KEY;';
    upgrade_query("Dropping primary key for actionlog table", $query);

    // 4. add mcookiekey to nucleus_member
    if (0 == $upgrade_failures && !upgrade_checkIfColumnExists('member', 'mcookiekey')) {
        $query = 'ALTER TABLE '.sql_table('member')
               . " ADD mcookiekey varchar(40) ";
        $res = upgrade_query("Adding cookiekey attribute to members", $query);

        // only do this when the previous query succeeds
        //A more efficent query might be 'UPDATE '.sql_table('member')." SET mpassword=MD5(mpassword)"
        if ($res) {
            // 5. for all members: hash their password and also copy it to mcookiekey
            $query = 'SELECT * FROM '.sql_table('member');
            $res   = sql_query($query);
            while ($current = sql_fetch_object($res)) {
                $hashedpw = md5($current->mpassword);
                $updquery = 'UPDATE '.sql_table('member')." SET mpassword='{$hashedpw}' WHERE mnumber=" . $current->mnumber;
                upgrade_query("Encrypting password for member " . $current->mnumber, $updquery);
            }
        }
    } else {
        echo "<li>Adding cookiekey attribute to members ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
    }
}
