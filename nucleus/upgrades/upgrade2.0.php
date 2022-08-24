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
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

function upgrade_do200()
{
    if (upgrade_checkinstall(200)) {
        return "already installed";
    }

    // queries come here

    // add ikarmaneg
    if (!upgrade_checkIfColumnExists('item', 'ikarmaneg')) {
        $query = 'ALTER TABLE '.sql_table('item')
               . " ADD ikarmaneg int(11) NOT NULL default '0'";
        upgrade_query("Adding ikarmaneg column to items", $query);
    }

    // rename ikarma to ikarmapos
    if (!upgrade_checkIfColumnExists('item', 'ikarmapos')) {
        $query = 'ALTER TABLE '.sql_table('item')
               . " CHANGE ikarma ikarmapos int(11) NOT NULL default '0'";
        upgrade_query("Renaming ikarma column for items to ikarmapos", $query);
    }

    // drop key in actionlog
    $query = 'ALTER TABLE '.sql_table('actionlog').' DROP PRIMARY KEY';
    upgrade_query("Dropping primary key in actionlog table", $query);

    // change cmail field length
    $query = 'ALTER TABLE '.sql_table('comment').' CHANGE cmail cmail varchar(100) default NULL';
    upgrade_query("changing max email/url length of guest comments to 100", $query);

    // create default skin option
    if (!upgrade_checkIfCVExists('BaseSkin')) {
        $skinid = SKIN::getIdFromName('default');
        $query  = 'INSERT INTO '.sql_table('config')." VALUES ('BaseSkin', '{$skinid}');";
        upgrade_query("Adding setting BaseSkin", $query);
    }

    global $CONF;
    // add SkinsURL setting
    if (!upgrade_checkIfCVExists('SkinsURL')) {
        $skinsurl = str_replace('/media/', '/skins/', $CONF['MediaURL']);
        $query    = 'INSERT INTO '.sql_table('config')." VALUES ('SkinsURL', '".addslashes($skinsurl)."');";
        upgrade_query("Adding setting SkinsURL", $query);
    }

    // add ActionURL setting
    if (!upgrade_checkIfCVExists('ActionURL')) {
        $actionurl = str_replace('/media/', '/action.php', $CONF['MediaURL']);
        $query     = 'INSERT INTO '.sql_table('config')." VALUES ('ActionURL', '".addslashes($actionurl)."');";
        upgrade_query("Adding setting ActionURL", $query);
    }

    // time offset can also be decimal (for half time zones like GMT+3:30)
    $query = 'ALTER TABLE '.sql_table('blog')." CHANGE btimeoffset btimeoffset DECIMAL( 3, 1 ) DEFAULT '0' NOT NULL";
    upgrade_query('Changing time offset column type to decimal', $query);

    // add ballowpast option to nucleus_blog
    if (!upgrade_checkIfColumnExists('blog', 'ballowpast')) {
        $query = 'ALTER TABLE '.sql_table('blog')." ADD ballowpast tinyint(2) NOT NULL default '0'";
        upgrade_query("Adding 'Allow posting to the past' option to blogs", $query);
    }

    // URLMode
    if (!upgrade_checkIfCVExists('URLMode')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('URLMode', 'normal');";
        upgrade_query("Adding setting URLMode", $query);
    }

    // add id to nucleus_plugin_option (allows for ordening)
    if (!upgrade_checkIfColumnExists('plugin_option', 'oid')) {
        $query = 'ALTER TABLE '.sql_table('plugin_option').' ADD oid int(11) NOT NULL auto_increment UNIQUE ';
        upgrade_query("Adding id attribute to plugin options table", $query);
    }

    // add sdincmode and sdincpref to skins
    global $upgrade_failures;
    if (0 == $upgrade_failures && !upgrade_checkIfColumnExists('skin_desc', 'sdincpref')) {
        $query = 'ALTER TABLE '.sql_table('skin_desc')
               . " ADD sdincmode varchar(10) NOT NULL default 'normal',"
               . " ADD sdincpref varchar(50) NOT NULL default ''";
        upgrade_query('Adding IncludeMode and IncludePrefix properties to skins', $query);
    } else {
        echo "<li>Adding IncludeMode and IncludePrefix properties to skins ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
    }
}
