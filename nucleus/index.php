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

// preload-admin-custum.php : You can write freely the settings such as allow ip address or spam tools.
$preload_admin_custum_php = dirname(dirname(__FILE__)) . '/settings/preload-admin-custum.php';
if (@is_file($preload_admin_custum_php)) {
    include_once $preload_admin_custum_php;
}
define("LOADED_PRELOAD_ADMIN_CUSTUM_PHP", in_array(realpath($preload_admin_custum_php), get_included_files()));
unset($preload_admin_custum_php);

// we are using admin stuff:
$CONF                   = array();
$CONF['UsingAdminArea'] = 1;

if (!@is_file('../config.php')) {
    if (@is_file('../install/index.php') && !headers_sent()) {
        header('Location: ../install/');
        exit;
    }
}
// include the admin code
require_once('../config.php');

$admin = new ADMIN();

$bNeedsLogin   = false;
$bIsActivation = in_array($action, array('activate', 'activatesetpwd'));

if ($action == 'logout') {
    $bNeedsLogin = true;
}

if ($member->isHalt()) {
    $error       = '( '.$member->getDisplayName()  .  ' ) '._ERROR_LOGIN_DISALLOWED_BY_HALT;
    $bNeedsLogin = true;
}

if (!$member->isLoggedIn() && !$bIsActivation) {
    $bNeedsLogin = true;
}

// show error if member cannot login to admin
if ($member->isLoggedIn() && !$member->canLogin() && !$bIsActivation) {
    $error       = _ERROR_LOGINDISALLOWED;
    $bNeedsLogin = true;
}

if ($action == 'lost_pwd' && (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0)) {
    $bNeedsLogin = false;
}

if ($bNeedsLogin) {
    setOldAction($action);  // see ADMIN::login() (sets old action in POST vars)
    $action = 'showlogin';
}

sendContentType('text/html', 'admin-' . $action);

$admin->action($action);
