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

function upgrade_do95() {

    if (upgrade_checkinstall(95))
        return "already installed";

    if(!upgrade_checkIfColumnExists('blog', 'bconvertbreaks')){
        $query =  'ALTER TABLE '.sql_table('blog')
               . " ADD bsendping tinyint(2) NOT NULL default '0',"
               . " ADD bconvertbreaks tinyint(2) NOT NULL default '1'";
        upgrade_query("Adding 'send ping' and convert linebreaks options",$query);
    }else{
        echo "<li>Adding 'send ping' and convert linebreaks options ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
    }
}
