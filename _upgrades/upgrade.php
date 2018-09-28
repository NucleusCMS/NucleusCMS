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

include('upgrade.functions.php');

load_upgrade_lang();

// check if logged in etc
if (!$member->isLoggedIn()) {
    upgrade_showLogin('upgrade.php?from=' . intGetVar('from'));
}

if (!$member->isAdmin()) {
    upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
}

// [start] Reject a forked project database incompatible with Nucleus
if (!empty($CONF['DatabaseName']) && $CONF['DatabaseName'] != 'Nucleus') {
    upgrade_error('It is an incompatible database.');
}
if ((intval($CONF['DatabaseVersion']) >= 380) || (intval($from)>=380)) {
    $query = sprintf("SELECT count(*) as result FROM `%s` WHERE name='DatabaseName' AND value='Nucleus'", sql_table('config'));
    $res = quickQuery($query);
    if (empty($res))
        upgrade_error('It is an incompatible database.');
}
// [end] Reject a forked project database incompatible with Nucleus

$from = intGetVar('from');

if ($from < 300 && isset($_GET['from'])) {
    $msg = '<p class="warning">'    . _UPG_TEXT_UPGRADE_ABORTED .'</p>'
         . '<p class="deprecated">' . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP .'</p>'
         . '<p class="note">'       . _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP_INFO .'</p>'
         . '<a href="http://nucleuscms.org/" target="_blank">nucleuscms.org</a>';
    upgrade_error($msg);
    exit;
}

upgrade_head();
upgrade_start();

switch($from) {
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
        break;
}

global $upgrade_failures;
if (isset($_GET['from']) && ($from>0) && empty($upgrade_failures))
{
    upgrade_check_action_php();
}

upgrade_end( _UPG_TEXT_UPGRADE_COMPLETED );
upgrade_foot();
exit;
