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

    $table_item = sql_table('item');
    foreach(array( 'ipublic' => "`ipublic` tinyint(2) NOT NULL default '1'",
                   'ipublic_enable_term_start' => "`ipublic_enable_term_start`  tinyint(2)   NOT NULL default '0'",
                   'ipublic_enable_term_end'   => "`ipublic_enable_term_end`    tinyint(2)   NOT NULL default '0'",
                   'ipublic_term_start'        => "`ipublic_term_start`         datetime     NOT NULL default '2000-01-01 00:00:00'",
                   'ipublic_term_end'          => "`ipublic_term_end`           datetime     NOT NULL default '2099-01-01 00:00:00'"
        ) as $key=>$value) {
        if ( !sql_existTableColumnName($table_item, $key) )
        {
            $queries = array();
            $queries[] = sprintf("ALTER TABLE `%s` ADD COLUMN %s", $table_item, $value);
            if ($DB_DRIVER_NAME == 'sqlite') {
                $queries[0] .= ';';
                $queries[] = "CREATE INDEX IF NOT EXISTS `${table_item}_idx_${key}` on `${table_item}` (`${key}`);";
            } else {
                $queries[0] .= sprintf(" , ADD INDEX `%s` (`%s`);", $key, $key);
            }
            foreach($queries as $query)
                upgrade_query('Altering ' . $table_item . ' table', $query);
        }
    }

	//  -> 3.80
	// update database version
	update_version('380');
}
