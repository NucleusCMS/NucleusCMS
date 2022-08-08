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

upgrade_do310();

function upgrade_do310()
{

    if (upgrade_checkinstall(310)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    // 3.0 -> 3.1
    // update database version
    update_version('310');
    // nothing!
}
