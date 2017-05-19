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

    if ($DB_DRIVER_NAME != 'sqlite') {
        // mysql
        $mode = (sql_existTableColumnName(sql_table('blog'), 'ballowpast') ? 'MODIFY' : 'ADD'); // sqlite not support MODIFY COLUMN
        $query = sprintf("ALTER TABLE `%s`
                         ${mode} COLUMN `ballowpast` tinyint(2)   NOT NULL default '1';
                         ", sql_table( 'blog' ));
        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);

        $query = sprintf("ALTER TABLE `%s`
                    MODIFY COLUMN `ititle` varchar(160)  NOT NULL default '',
                    MODIFY COLUMN `ibody`  mediumtext    NOT NULL default '',
                    MODIFY COLUMN `imore`  mediumtext    NOT NULL default '';", sql_table('item'));
    
        upgrade_query('Altering ' . sql_table('item') . ' table', $query);

        $query = sprintf("ALTER TABLE `%s`
                         MODIFY COLUMN `name` varchar(50)  NOT NULL default '';
                         ", sql_table( 'config' ));
        upgrade_query('Altering ' . sql_table('config') . ' table', $query);

        $query = sprintf("ALTER TABLE `%s`
                         MODIFY COLUMN `oname` varchar(50) NOT NULL default '';
                         ", sql_table( 'plugin_option_desc' ));
        upgrade_query('Altering ' . sql_table('plugin_option_desc') . ' table', $query);
    }

    upgrade_do380_Skin_UpgardeAddColumnSpartstype();

	//  -> 3.80
	// update database version
	update_version('380');
}

function upgrade_do380_Skin_UpgardeAddColumnSpartstype()
{
    global $DB_DRIVER_NAME;

    if ( sql_existTableColumnName(sql_table('skin'), 'spartstype' ))
        return;

    $upgrade_msg = sprintf("Altering TABLE `%s` ", sql_table('skin'));

    if ($DB_DRIVER_NAME == 'mysql')
    {
        $sql = sprintf('ALTER TABLE `%s` ', sql_table('skin'))
             . "ADD COLUMN `spartstype` varchar(20) NOT NULL default 'parts'";
        upgrade_query($upgrade_msg, $sql);
        return;
    }
    else if ($DB_DRIVER_NAME == 'sqlite')
    {
        $dbh =  sql_get_db();
        $sql = '';
        if ($dbh->beginTransaction())
        {
            $isSuccess = True;
            // table
            $isSuccess = $dbh->query(sprintf("ALTER TABLE `%s` RENAME TO `%s`", sql_table('skin'), sql_table('old_skin')));
            if ($isSuccess)
            {
                $sql = sprintf("CREATE TABLE IF NOT EXISTS `%s` (
                                  `sdesc`    int(11)     NOT NULL default '0',
                                  `stype`    varchar(20) NOT NULL default '' COLLATE NOCASE ,
                                  `scontent` text        NOT NULL ,
                                  `spartstype`  varchar(20) NOT NULL default 'parts' ,
                                  PRIMARY KEY  (`sdesc`,`stype`)
                                )", sql_table('skin'));
                $isSuccess = $dbh->query($sql);
                if ($isSuccess)
                {
                    $sql = sprintf("INSERT INTO `%s` (`sdesc`, `stype`, `scontent`, `spartstype`) "
                                    . "SELECT `sdesc`, `stype`, `scontent`, 'parts' AS `spartstype` FROM `%s`",
                                    sql_table('skin'), sql_table('old_skin'));
                    $isSuccess = ($dbh->exec($sql) !== FALSE);
                }
                if ($isSuccess)
                    $isSuccess = $dbh->query(sprintf("DROP TABLE `%s`", sql_table('old_skin')));
            }
            if ($isSuccess && $dbh->commit())
            {
                upgrade_query($upgrade_msg, "SELECT 'OK'");
                return;
            }
            $dbh->rollBack();
        }
        upgrade_query($upgrade_msg, "Failure");
    }

}
