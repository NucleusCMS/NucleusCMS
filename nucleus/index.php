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
	// we are using admin stuff:
	$CONF = array();
	$CONF['UsingAdminArea'] = 1;

	// include the admin code
	require_once('../config.php');

	$admin = new ADMIN();

	$bNeedsLogin = false;
	$bIsActivation = in_array($action, array('activate', 'activatesetpwd'));

	if ($action == 'logout')
		$bNeedsLogin = true;

	if (!$member->isLoggedIn() && !$bIsActivation)
		$bNeedsLogin = true;

	// show error if member cannot login to admin
	if ($member->isLoggedIn() && !$member->canLogin() && !$bIsActivation) {
		$error       = _ERROR_LOGINDISALLOWED;
		$bNeedsLogin = true;
	}

	if ($bNeedsLogin)
	{
		setOldAction($action);	// see ADMIN::login() (sets old action in POST vars)
		$action = 'showlogin';
	}

	sendContentType('text/html', 'admin-' . $action);

	$admin->action($action);
