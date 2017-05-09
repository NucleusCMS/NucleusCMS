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

function upgrade_do371() {

    if (upgrade_checkinstall(371))
        return _UPG_TEXT_ALREADY_INSTALLED;

//    $query = sprintf("ALTER TABLE `%s`
//                    ADD `corder` int(11)     NOT NULL default '100',
//                    ADD INDEX `cblog` (`cblog`),
//                    ADD INDEX `corder` (`corder`);", sql_table('category'));
    $query = array();
    if (!sql_existTableColumnName(sql_table('category'), 'corder')) {
        $query[] = "ADD `corder` int(11)     NOT NULL default '100',
                   ADD INDEX `corder` (`corder`)";
    }
    $q = sql_query(sprintf("show index from `%s` WHERE Column_name = 'cblog'", sql_table('category')));
    if (!$q || !sql_num_rows($q))
        $query[] = "ADD INDEX `cblog` (`cblog`);";
    unset($q);
    if (count($query)) {
        $query = sprintf("ALTER TABLE `%s` ", sql_table('category'))
                 . implode(', ', $query);
        upgrade_query('Altering ' . sql_table('category') . ' table', $query);
    }

    // 3.70 -> 3.71
    // update database version
    update_version('371');
}

function upgrade_do370() {

    if (upgrade_checkinstall(370))
        return _UPG_TEXT_ALREADY_INSTALLED;
    
    // changing the blog table to lengthen bnotify field 
    $query = sprintf("ALTER TABLE `%s`
                    MODIFY COLUMN `ibody` mediumtext default NULL,
                    MODIFY COLUMN `imore` mediumtext default NULL;", sql_table('item'));
    
    upgrade_query('Altering ' . sql_table('item') . ' table', $query);
    
    $query = sprintf("ALTER TABLE `%s` MODIFY COLUMN `mpassword`  varchar(255)  NOT NULL default ''", sql_table('member'));
    
    upgrade_query('Altering ' . sql_table('member') . ' table', $query);
    
    // 3.6 -> 3.7
    // update database version
    update_version('370');
}
