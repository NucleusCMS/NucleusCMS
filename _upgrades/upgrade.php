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

global $CONF;

include_once('define.php');

if (is_file('../config.php'))
    include_once('../config.php');
else
    exit('config not found');

include_once('upgrade.functions.php');
include_once('sql.functions.php');

load_upgrade_lang();

// check if logged in etc
if (!$member->isLoggedIn()) {
    upgrade_head();
    upgrade_showLogin('upgrade.php?from=' . intGetVar('from'));
    upgrade_foot();
    exit;
}

if (!$member->isAdmin()) {
    upgrade_head();
    upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
    upgrade_foot();
    exit;
}

// [start] Reject a forked project database incompatible with Nucleus
if (isset($CONF['DatabaseName']) && $CONF['DatabaseName'] != 'Nucleus') {
    upgrade_head();
    upgrade_error('It is an incompatible database.');
    upgrade_foot();
    exit;
}
if ((intval($CONF['DatabaseVersion']) >= NUCLEUS_UPGRADE_VERSION_ID) || (intGetVar('from')>=NUCLEUS_UPGRADE_VERSION_ID)) {
    $query = "SELECT count(*) as result FROM `[@prefix@]config` WHERE name='DatabaseName' AND value='Nucleus'";
    if (!quickQuery(parseQuery($query))) {
        upgrade_head();
        upgrade_error('It is an incompatible database.');
        upgrade_foot();
        exit;
    }
}

// [end] Reject a forked project database incompatible with Nucleus

if (intGetVar('from') && intGetVar('from')<300) {
    $msg = '<p class="warning">'    . _UPG_TEXT_UPGRADE_ABORTED .'</p>'
         . '<p class="deprecated">' . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP .'</p>'
         . '<p class="note">'       . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP_INFO .'</p>'
         . '<a href="http://nucleuscms.org/" target="_blank">nucleuscms.org</a>';
    upgrade_head();
    upgrade_error($msg);
    upgrade_foot();
    exit;
}

upgrade_head();
upgrade_start();

switch(intGetVar('from')) {
    case 300:
        include_once('upgrade3.1.php');
        upgrade_do310();
    case 310:
        include_once('upgrade3.2.php');
        upgrade_do320();
    case 320:
        include_once('upgrade3.3.php');
        upgrade_do330();
    case 330:
        include_once('upgrade3.4.php');
        upgrade_do340();
    case 340:
        include_once('upgrade3.5.php');
        upgrade_do350();
    case 350:
        include_once('upgrade3.6.php');
        upgrade_do360();
    case 360:
        include_once('upgrade3.7.php');
        upgrade_do370();
    case 370:
        include_once('upgrade3.7.php');
        upgrade_do371();
    case 371:
        include_once('upgrade3.8.php');
        upgrade_do380();
        break;
    default:
        echo '<li>' . _UPG_TEXT_ERROR_NO_UPDATES_TO_EXECUTE . '</li>';
}

global $upgrade_failures;
if (isset($_GET['from']) && (intGetVar('from')>0) && empty($upgrade_failures))
{
    upgrade_check_action_php();
}

upgrade_end( _UPG_TEXT_UPGRADE_COMPLETED );
upgrade_foot();
exit;
if (isset($_GET['from']) && ($from>0) && empty($upgrade_failures))
{
    upgrade_check_action_php();
}
