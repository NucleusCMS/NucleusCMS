<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
  * Copyright (C) 2002-2005 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * $Id: index.php,v 1.3 2005-03-16 08:04:14 kimitake Exp $
  * $NucleusJP$
  */
	// we are using admin stuff:
	$CONF = array();
	$CONF['UsingAdminArea'] = 1;

	// include the admin code
	include('../config.php');

	if ($CONF['alertOnSecurityRisk'] == 1)
	{
		// check if files exist and generate an error if so
		$aFiles = array(
			'../install.sql' => 'install.sql should be deleted',
			'../install.php' => 'install.php should be deleted',
			'upgrades' => 'nucleus/upgrades directory should be deleted',
			'convert' => 'nucleus/convert directory should be deleted'
		);
		$aFound = array();
		foreach($aFiles as $fileName => $fileDesc)
		{
			if (@file_exists($fileName))
				array_push($aFound, $fileDesc);
		}
		if (@is_writable('../config.php')) {
			array_push($aFound, 'config.php should be non-writable (chmod to 444)');
		}
		if (sizeof($aFound) > 0)
		{
			startUpError(
				'<p>One or more of the Nucleus installation files are still present on the webserver, or are writable.</p><p>You should remove these files or change their permissions to ensure security. Here are the files that were found by Nucleus</p> <ul><li>'. implode($aFound, '</li><li>').'</li></ul><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnSecurityRisk\']</code> in <code>globalfunctions.php</code> to <code>0</code>, or do this at the end of <code>config.php</code>.</p>',
				'Security Risk'
			);
		}
	}

	$bNeedsLogin = false;
	$bIsActivation = in_array($action, array('activate', 'activatesetpwd'));
	
	if ($action == 'logout') 
		$bNeedsLogin = true;	
	
	if (!$member->isLoggedIn() && !$bIsActivation)
		$bNeedsLogin = true;

	// show error if member cannot login to admin
	if ($member->isLoggedIn() && !$member->canLogin() && !$bIsActivation) {
		$error = _ERROR_LOGINDISALLOWED;
		$bNeedsLogin = true;
	}
	
	if ($bNeedsLogin)
	{
		setOldAction($action);	// see ADMIN::login() (sets old action in POST vars)
		$action = 'showlogin';
	}

	sendContentType('application/xhtml+xml', 'admin-' . $action);
	
	$admin = new ADMIN();
	$admin->action($action);
?>
