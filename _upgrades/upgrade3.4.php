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

upgrade_do340();

function upgrade_do340()
{
    if (upgrade_checkinstall(340)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    // lengthen tpartname column of nucleus_template
    $query = sprintf(" ALTER TABLE `%s` MODIFY `tpartname` varchar(64) NOT NULL default ''", sql_table('template'));
    upgrade_query('Altering ' . sql_table('template') . ' table', $query);

    // lengthen tdname column of nucleus_template_desc
    $query = sprintf(" ALTER TABLE `%s` MODIFY `tdname` varchar(64) NOT NULL default ''", sql_table('template_desc'));
    upgrade_query('Altering ' . sql_table('template_desc') . ' table', $query);

    // create DebugVars setting
    if (!upgrade_checkIfCVExists('DebugVars')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('DebugVars',0)";
        upgrade_query('Creating DebugVars config value', $query);
    }

    // create DefaultListSize setting
    if (!upgrade_checkIfCVExists('DefaultListSize')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('DefaultListSize',10)";
        upgrade_query('Creating DefaultListSize config value', $query);
    }

    // changing the member table
    if (!upgrade_checkIfColumnExists('member', 'mautosave')) {
        $query = ' ALTER TABLE ' . sql_table('member') . ' ADD mautosave TINYINT(2) DEFAULT 1';
        upgrade_query('Adding a new row for the autosave member option', $query);
    }

    // 3.3 -> 3.4
    // update database version
    update_version('340');
}
