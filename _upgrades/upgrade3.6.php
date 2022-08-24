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
 * @version $Id: upgrade3.5.php 1416 2009-09-24 15:58:08Z ftruscot $
 */

upgrade_do360();

function upgrade_do360()
{
    if (upgrade_checkinstall(360)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    // changing the blog table to lengthen bnotify field
    $query = "    ALTER TABLE `" . sql_table('blog') . "`
                    MODIFY `bnotify` varchar(128) default NULL ;";

    upgrade_query('Altering ' . sql_table('blog') . ' table', $query);

    // 3.5 -> 3.6
    // update database version
    update_version('360');
}
