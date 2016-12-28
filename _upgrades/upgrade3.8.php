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

function upgrade_do380() {
    global $DB_DRIVER_NAME;

    if (upgrade_checkinstall(380))
        return 'already installed';

    if ( !sql_existTableColumnName(sql_table('blog'), 'bauthorvisible') )
    {
        $query = sprintf("ALTER TABLE `%s`
                         ADD COLUMN `bauthorvisible` tinyint(2) NOT NULL default '1';
                         ", sql_table( 'blog' ));

        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    if ( !sql_existTableColumnName(sql_table('member'), 'mhalt') )
    {
        $query = sprintf("ALTER TABLE `%s`
                         ADD COLUMN `mhalt` tinyint(2) NOT NULL default '0';
                         ", sql_table( 'member' ));

        upgrade_query('Altering ' . sql_table('member') . ' table', $query);
    }

    if ( !sql_existTableColumnName(sql_table('member'), 'mhalt_reason') )
    {
        $query = sprintf("ALTER TABLE `%s`
                         ADD COLUMN `mhalt_reason` varchar(100) NOT NULL default '';
                         ", sql_table( 'member' ));

        upgrade_query('Altering ' . sql_table('member') . ' table', $query);
    }

	//  -> 3.80
	// update database version
	update_version('380');
}
