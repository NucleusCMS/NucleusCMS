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

    $upgrade_istatus = false;

    $table_item = sql_table('item');
    foreach(array( 'istatus' => "`istatus` varchar(255) NOT NULL default 'published'",
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
            foreach($queries as $query) {
                upgrade_query('Altering ' . $table_item . ' table', $query);
            }
            if ($key=='istatus') {
                $upgrade_istatus = true;
            }
        }
    }
    if ($upgrade_istatus) {
        global $manager;
        $query = sprintf('SELECT iblog AS blogid FROM %s GROUP BY iblog ORDER BY iblog ASC', $table_item);
        $res = sql_query($query);
        // each blogs : item count > 0
        while($res && ($o = sql_fetch_object($res)) && is_object($o)) {
            $blog = $manager->getBlog(intval($o->blogid));
            $date = sqldate($blog->getCorrectTime());
            // set to future
            $query = sprintf("UPDATE `%s` SET `istatus`='future' WHERE itime>%s", $table_item, $date);
            upgrade_query('istatus: Changing initial value to future ', $query);
            // free blog object
            unset($manager->blogs[intval($o->blogid)]); // free memory
        }
        $queries = array();
        $queries['draft']  = sprintf("UPDATE %s SET `istatus`='draft' WHERE idraft=1", $table_item);
        foreach($queries as $key=>$query) {
            upgrade_query('istatus: Changing initial value to '.$key , $query);
            sql_query($query);
        }
    }

	//  -> 3.80
	// update database version
	update_version('380');
}
