<?php

function upgrade_do360()
{

    if (upgrade_checkinstall(360)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }
    
    upgrade_do360_modfield_bnotify();
    
    // 3.5 -> 3.6
    // update database version
    update_version('360');
}

function upgrade_do360_modfield_bnotify()
{
    // changing the blog table to lengthen bnotify field
    $query = parseQuery("ALTER TABLE `[@prefix@]blog` MODIFY `bnotify` varchar(128) default NULL");
    upgrade_query('Altering [@prefix@]blog table', $query);
}
