<?php

function upgrade_do320()
{
    if (upgrade_checkinstall(320)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    upgrade_do320_addtable_activation();
    upgrade_do320_addconfig_cookieprefix();
    upgrade_do320_addtable_tickets();

    // 3.1 -> 3.2
    // update database version
    update_version('320');
}

function upgrade_do320_addtable_activation()
{
    // create nucleus_activation table
    if (upgrade_checkIfTableExists('activation')) {
        return;
    }

    $query = parseQuery('CREATE TABLE [@prefix@]activation (')
           . " vkey varchar(40) NOT NULL default '',"
           . " vtime datetime NOT NULL default '0000-00-00 00:00:00',"
           . " vmember int(11) NOT NULL default '0',"
           . " vtype varchar(15) NOT NULL default '',"
           . " vextra varchar(128) NOT NULL default '',"
           . ' PRIMARY KEY  (vkey) '
           . ' )';
    upgrade_query('Creating account activation table', $query);
}

function upgrade_do320_addconfig_cookieprefix()
{
    // create CookiePrefix setting
    if (upgrade_checkIfCVExists('CookiePrefix')) {
        return;
    }

    $query = parseQuery("INSERT INTO [@prefix@]config VALUES ('CookiePrefix','')");
    upgrade_query('Creating CookiePrefix config value', $query);
}

function upgrade_do320_addtable_tickets()
{
    // create nucleus_tickets table
    if (upgrade_checkIfTableExists('tickets')) {
        return;
    }

    $query = parseQuery('CREATE TABLE [@prefix@]tickets (')
           . " ticket varchar(40) NOT NULL default '',"
           . " ctime datetime NOT NULL default '0000-00-00 00:00:00',"
           . " member int(11) NOT NULL default '0', "
           . ' PRIMARY KEY  (ticket, member) '
           . ' )';
    upgrade_query('Creating ticket table', $query);
}
