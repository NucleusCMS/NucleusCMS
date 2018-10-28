<?php

function upgrade_do371() {

    if (upgrade_checkinstall(371))
        return _UPG_TEXT_ALREADY_INSTALLED;

    $query = array();
    if (!sql_existTableColumnName(sql_table('category'), 'corder')) {
        $query[] = "ADD `corder` int(11) NOT NULL default '100', ADD INDEX `corder` (`corder`)";
    }
    $q = sql_query(parseQuery("show index from `[@prefix@]category` WHERE Column_name = 'cblog'"));
    if (!$q || !sql_num_rows($q))
        $query[] = "ADD INDEX `cblog` (`cblog`)";
    unset($q);
    if (count($query)) {
        $query = parseQuery("ALTER TABLE `[@prefix@]category` ") . join(', ', $query);
        upgrade_query('Altering [@prefix@]category table', $query);
    }

    // 3.70 -> 3.71
    // update database version
    update_version('371');
}

function upgrade_do370() {

    if (upgrade_checkinstall(370))
        return _UPG_TEXT_ALREADY_INSTALLED;
    
    $query = parseQuery("ALTER TABLE `[@prefix@]item`
                    MODIFY COLUMN `ibody` mediumtext default NULL,
                    MODIFY COLUMN `imore` mediumtext default NULL;");
    
    upgrade_query(parseQuery('Altering [@prefix@]item table'), $query);
    
    $query = parseQuery("ALTER TABLE `[@prefix@]member` MODIFY COLUMN `mpassword`  varchar(255)  NOT NULL default ''");
    upgrade_query('Altering [@prefix@]member table', $query);
    
    // 3.6 -> 3.7
    // update database version
    update_version('370');
}
