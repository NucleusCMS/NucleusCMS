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

function upgrade_do350() {

    if (upgrade_checkinstall(350))
        return _UPG_TEXT_ALREADY_INSTALLED;
    
    $prefix = sql_table('');
    // changing the member table to lengthen display name (mname)
    $query = "    ALTER TABLE `" . sql_table('member') . "`
                    MODIFY `mname` varchar(32) NOT NULL default '' ;";

    upgrade_query('Altering ' . sql_table('member') . ' table', $query);

    // changing the blog table to remove bsendping flag
    if (upgrade_checkIfColumnExists('blog', 'bsendping')) {
        $query = "    ALTER TABLE `" . sql_table('blog') . "`
                    DROP `bsendping`;";
    
        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    // 3.4 -> 3.5
    // update database version
    update_version('350');

    // Remind user to re-install NP_Ping 
    
    $query = "SELECT COUNT(*) as count FROM `{$prefix}plugin` WHERE pfile='NP_Ping'";
    $rs = sql_query($query);
    $row = sql_fetch_assoc($rs);
    if($row['count']==1)
        echo '<p>' . _UPG_TEXT_V035_WARN_PING . '</p>';

}
