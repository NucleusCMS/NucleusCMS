<?php

function upgrade_do380()
{
    if (upgrade_checkinstall(380)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    upgrade_do380_addconfig();
    
    upgrade_do380_addfield_bauthorvisible();
    upgrade_do380_addfield_mhalt();
    upgrade_do380_addfield_mhalt_reason();
    upgrade_do380_modfield_ballowpast(); // ignore sqlite
    upgrade_do380_Skin_UpgardeAddColumnSpartstype();
    upgrade_do380_addfield_mimage();
    fix_do380_Skin_ColumnSpartstype();
    upgrade_do380_addtable_memberoption();

    //  -> 3.80
    // update database version
    update_version('380');
}

function upgrade_do380_Skin_UpgardeAddColumnSpartstype()
{
    global $DB_DRIVER_NAME;

    if (sql_existTableColumnName(parseQuery('[@prefix@]skin'), 'spartstype')) {
        return;
    }

    $upgrade_msg = parseQuery("Altering TABLE `[@prefix@]skin` ");

    if ($DB_DRIVER_NAME == 'mysql') {
        $sql = parseQuery("ALTER TABLE `[@prefix@]skin` ADD COLUMN `spartstype` varchar(20) NOT NULL default 'parts'");
        upgrade_query($upgrade_msg, $sql);
        return;
    }
    
    if ($DB_DRIVER_NAME !== 'sqlite') {
        return;
    }
    
    $dbh =  sql_get_db();
    
    if (!$dbh->beginTransaction()) {
        upgrade_query($upgrade_msg, 'Failure');
        return;
    }
    
    // table
    $rs = $dbh->query(parseQuery("ALTER TABLE `[@prefix@]skin` RENAME TO `[@prefix@]old_skin`"));
    if (!$rs) {
        $dbh->rollBack();
        upgrade_query($upgrade_msg, 'Failure');
        return;
    }
    
    $sql = parseQuery("CREATE TABLE IF NOT EXISTS `[@preifx@]skin` (
                      `sdesc`    int(11)     NOT NULL default '0',
                      `stype`    varchar(20) NOT NULL default '' COLLATE NOCASE ,
                      `scontent` text        NOT NULL ,
                      `spartstype`  varchar(20) NOT NULL default 'parts' ,
                      PRIMARY KEY  (`sdesc`,`stype`))");
    $rs = $dbh->query($sql);
    if (!$rs) {
        $dbh->rollBack();
        upgrade_query($upgrade_msg, 'Failure');
        return;
    }
    
    $sql = parseQuery("INSERT INTO `[@prefix@]skin` (`sdesc`, `stype`, `scontent`, `spartstype`) 
        SELECT `sdesc`, `stype`, `scontent`, 'parts' AS `spartstype` FROM `[@prefix@]old_skin`");
    $rs = $dbh->exec($sql);
    if ($rs===false) {
        $dbh->rollBack();
        upgrade_query($upgrade_msg, 'Failure');
        return;
    }
    
    $rs = $dbh->query(parseQuery("DROP TABLE `[@prefix@]old_skin`"));
    
    if ($rs && $dbh->commit()) {
        upgrade_query($upgrade_msg, "SELECT 'OK'");
        return;
    }
    $dbh->rollBack();
    upgrade_query($upgrade_msg, 'Failure');
}

function fix_do380_Skin_ColumnSpartstype()
{
    if (!sql_existTableColumnName(parseQuery('[@prefix@]skin'), 'spartstype')) {
        return;
    }
    
    $sql  = "SELECT * FROM `[@prefix@]skin`";
    $sql .= " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
    $sql .= " AND spartstype='parts'";
    
    if (!quickQuery(parseQuery($sql))) {
        return;
    }
    
    $sql  = "UPDATE [@prefix@]skin set spartstype='specialpage'";
    $sql .= "WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
    sql_query(parseQuery($sql));
    return;
}

function upgrade_do380_addfield_bauthorvisible()
{
    if (sql_existTableColumnName(parseQuery('[@prefix@]blog'), 'bauthorvisible')) {
        return;
    }
    
    $query = parseQuery("ALTER TABLE `[@prefix@]blog` ADD COLUMN `bauthorvisible` tinyint(2) NOT NULL default '1'");
    upgrade_query('Altering [@prefix@]blog table', $query);
}

function upgrade_do380_addfield_mhalt()
{
    if (sql_existTableColumnName(parseQuery('[@prefix@]member'), 'mhalt')) {
        return;
    }
    
    $query = parseQuery("ALTER TABLE `[@prefix@]member` ADD COLUMN `mhalt` tinyint(2) NOT NULL default '0'");
    upgrade_query('Altering [@prefix@]member table', $query);
}

function upgrade_do380_addfield_mhalt_reason()
{
    if (sql_existTableColumnName(parseQuery('[@prefix@]member'), 'mhalt_reason')) {
        return;
    }
    
    $query = parseQuery("ALTER TABLE `[@prefix@]member` ADD COLUMN `mhalt_reason` varchar(100) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]member table', $query);
}

function upgrade_do380_modfield_ballowpast()
{
    global $DB_DRIVER_NAME;
    
    if ($DB_DRIVER_NAME === 'sqlite') {
        return;
    }
    
    // mysql only. because sqlite not support MODIFY COLUMN
    $mode = (sql_existTableColumnName(parseQuery('[@prefix@]blog'), 'ballowpast') ? 'MODIFY' : 'ADD');
    $query = parseQuery("ALTER TABLE `[@prefix@]blog` [@mode@] COLUMN `ballowpast` tinyint(2)   NOT NULL default '1'", array('mode'=>$mode));
    upgrade_query('Altering [@prefix@]blog table', $query);

    $query = parseQuery("ALTER TABLE `[@prefix@]item`
                MODIFY COLUMN `ititle` varchar(160)  NOT NULL default '',
                MODIFY COLUMN `ibody`  mediumtext    NOT NULL default '',
                MODIFY COLUMN `imore`  mediumtext    NOT NULL default ''");

    upgrade_query('Altering [@prefix@]item table', $query);

    $query = parseQuery("ALTER TABLE `[@prefix@]config` MODIFY COLUMN `name` varchar(50)  NOT NULL default ''");
    upgrade_query('Altering [@prefix@]config table', $query);

    $query = parseQuery("ALTER TABLE `[@prefix@]plugin_option_desc` MODIFY COLUMN `oname` varchar(50) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]plugin_option_desc table', $query);
}

function upgrade_do380_addconfig()
{
    $query = parseQuery("SELECT count(*) as result FROM `[@prefix@]config` WHERE name='DatabaseName'");
    if (quickQuery($query)) {
        return;
    }
    
    $query = parseQuery("INSERT INTO `[@prefix@]config` (name, value) VALUES('DatabaseName', 'Nucleus')");
    upgrade_query('Updating [@prefix@]config ', $query);
}

function upgrade_do380_addfield_mimage()
{
    if (sql_existTableColumnName(parseQuery('[@prefix@]member'), 'mimage')) {
        return;
    }
    
    $query = parseQuery("ALTER TABLE `[@prefix@]member` ADD COLUMN `mimage` varchar(500) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]member table', $query);
}

function upgrade_do380_addtable_memberoption()
{
    global $DB_DRIVER_NAME;
    if (sql_existTableName(sql_table('member_option'))) {
        return;
    }
    if ($DB_DRIVER_NAME === 'sqlite') {
        return;
    }
    $query = parseQuery("
        CREATE TABLE `[@prefix@]member_option` (
          `omember`  int(11)      NOT NULL,
          `ocontext` varchar(20)  NOT NULL default '',
          `name`     varchar(100) NOT NULL,
          `value`    varchar(255) NOT NULL default '',
          PRIMARY KEY (`omember`),
          UNIQUE  KEY (`omember`, `ocontext`, `name`)
        ) ENGINE=MyISAM;");
    upgrade_query('Add [@prefix@]member table', $query);
}
