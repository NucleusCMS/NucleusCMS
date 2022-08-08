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
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

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
    if (empty($res)) {
        upgrade_error('It is an incompatible database.');
    }
}
// [end] Reject a forked project database incompatible with Nucleus

$from = intGetVar('from');

upgrade_start();

switch ($from) {
    case 300:
        include_once('upgrade3.1.php');
    case 310:
        include_once('upgrade3.2.php');
    case 320:
        include_once('upgrade3.3.php');
    case 330:
        include_once('upgrade3.31.php');
    case 331:
        include_once('upgrade3.4.php');
    case 340:
        include_once('upgrade3.5.php');
    case 350:
        include_once('upgrade3.6.php');
    case 360:
    case 370:
        include_once('upgrade3.7.php');
    case 371:
        include_once('upgrade3.8.php');
        break;
    default:
        echo "<li>" . _UPG_TEXT_ERROR_NO_UPDATES_TO_EXECUTE . "</li>";
        break;
}

global $upgrade_failures;
if (isset($_GET['from']) && ($from>0) && empty($upgrade_failures)) {
    upgrade_check_action_php();
}


upgrade_end(_UPG_TEXT_UPGRADE_COMPLETED);
