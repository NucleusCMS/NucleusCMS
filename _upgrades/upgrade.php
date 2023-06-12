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

// prevent direct access
if (!defined('NC_MTN_MODE')) {
    header('Location: ./');
    exit;
}

global $CONF;

// [start] Reject a forked project database incompatible with Nucleus
if (isset($CONF['DatabaseName']) && $CONF['DatabaseName'] != 'Nucleus') {
    $content = upgrade_error('It is an incompatible database.');
    echo renderPage($content);
    exit;
}
if ((int) ($CONF['DatabaseVersion']) >= NUCLEUS_UPGRADE_VERSION_ID || intGetVar('from') >= NUCLEUS_UPGRADE_VERSION_ID) {
    $query = "SELECT count(*) as result FROM `[@prefix@]config` WHERE name='DatabaseName' AND value='Nucleus'";
    if (!quickQuery(parseQuery($query))) {
        $content = upgrade_error('It is an incompatible database.');
        echo renderPage($content);
        exit;
    }
}
if (intGetVar('from') && intGetVar('from') < 300) {
    $content = '<p class="warning">'    . _UPG_TEXT_UPGRADE_ABORTED .'</p>'
         . '<p class="deprecated">' . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP .'</p>'
         . '<p class="note">'       . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP_INFO .'</p>'
         . '<a href="http://nucleuscms.org/" target="_blank">nucleuscms.org</a>';
    $content = upgrade_error($content);
    echo renderPage($content);
    exit;
}

echo renderPage(do_upgrade());
exit;
