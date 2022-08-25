<?php

function upgrade_do340()
{
    if (upgrade_checkinstall(340)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    upgrade_do340_modfield_tpartname();
    upgrade_do340_modfield_tdname();
    upgrade_do340_Addfield_mautosave();
    upgrade_do340_addconfig();

    // 3.3 -> 3.4
    // update database version
    update_version('340');
}

function upgrade_do340_modfield_tpartname()
{
    // lengthen tpartname column of nucleus_template
    $query = parseQuery(" ALTER TABLE `[@prefix@]template` MODIFY `tpartname` varchar(64) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]template table', $query);
}

function upgrade_do340_modfield_tdname()
{
    // lengthen tdname column of nucleus_template_desc
    $query = parseQuery(" ALTER TABLE `[@prefix@]template_desc` MODIFY `tdname` varchar(64) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]template_desc table', $query);
}

function upgrade_do340_addconfig()
{
    // create DebugVars setting
    if (!upgrade_checkIfCVExists('DebugVars')) {
        $query = parseQuery("INSERT INTO [@prefix@]config VALUES ('DebugVars',0)");
        upgrade_query('Creating DebugVars config value', $query);
    }

    // create DefaultListSize setting
    if (!upgrade_checkIfCVExists('DefaultListSize')) {
        $query = parseQuery("INSERT INTO [@prefix@]config VALUES ('DefaultListSize',10)");
        upgrade_query('Creating DefaultListSize config value', $query);
    }
}

function upgrade_do340_Addfield_mautosave()
{
    // changing the member table
    if (upgrade_checkIfColumnExists('member', 'mautosave')) {
        return;
    }

    $query = parseQuery('ALTER TABLE [@prefix@]member ADD mautosave TINYINT(2) DEFAULT 1');
    upgrade_query('Adding a new row for the autosave member option', $query);
}
