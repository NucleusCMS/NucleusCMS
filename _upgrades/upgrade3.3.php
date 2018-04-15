<?php

function upgrade_do330() {

    if (upgrade_checkinstall(330))
        return _UPG_TEXT_ALREADY_INSTALLED;

    upgrade_do330_addfield_cemail();
    upgrade_do330_addfield_breqemail();
    upgrade_do330_modcommentfields();

    upgrade_do330_addfield_iposted();
    upgrade_do330_addfield_bfuturepost();
    upgrade_do330_shownotice_sendping();

    // 3.2 -> 3.3
    // update database version
    update_version('330');
}

function upgrade_do330_addfield_cemail() {
    if (upgrade_checkIfColumnExists('comment','cemail')) return;
    
    $query = parseQuery("ALTER TABLE `[@prefix@]comment` ADD `cemail` VARCHAR( 100 ) AFTER `cmail`");
    upgrade_query('Altering [@prefix@]comment table', $query);
}

function upgrade_do330_addfield_breqemail() {
    if (upgrade_checkIfColumnExists('blog','breqemail')) return;
    
    $query = parseQuery("ALTER TABLE `[@prefix@]blog` ADD `breqemail` TINYINT( 2 ) DEFAULT '0' NOT NULL");
    upgrade_query('Altering [@prefix@]blog table', $query);
}

function upgrade_do330_modcommentfields() {
    // check cmail column to separate to URL and cemail
    $sql = parseQuery("UPDATE [@prefix@]comment SET cemail = cmail, cmail = '' WHERE cmail LIKE '%@%'");
    sql_query($sql);
}

function upgrade_do330_addfield_iposted() {
    if (upgrade_checkIfColumnExists('item','iposted')) return;
    
    $query = parseQuery("ALTER TABLE `[@prefix@]item` ADD `iposted` TINYINT(2) DEFAULT 1 NOT NULL");
    upgrade_query('Altering [@prefix@]item table', $query);
}


function upgrade_do330_addfield_bfuturepost() {
    if (upgrade_checkIfColumnExists('blog','bfuturepost')) return;
    
    $query = parseQuery("ALTER TABLE `[@prefix@]blog` ADD `bfuturepost` TINYINT(2) DEFAULT 0 NOT NULL");
    upgrade_query('Altering [@prefix@]blog table', $query);
}
    
function upgrade_do330_shownotice_sendping() {
    // check to see if user turn on Weblogs.com ping, if so, suggest to install the plugin
    $query = parseQuery("SELECT bsendping FROM [@prefix@]blog WHERE bsendping='1'"); 
    $res = sql_query($query);
    if (sql_num_rows($res) > 0) {
        echo '<li>' . _UPG_TEXT_NOTE_PING01 . '</li>';
    }
}