<?
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  */
  
	// we are using admin stuff:
	$CONF['UsingAdminArea'] = 1;

	// include the admin code
	include('../config.php');

	if (!$member->isLoggedIn() || ($action == 'logout')) {
		$HTTP_POST_VARS['oldaction'] = $action;	// see ADMIN::login()
		$_POST['oldaction'] = $action;	
		$action = "showlogin";
	}
	
	// show error if member cannot login to admin
	if ($member->isLoggedIn() && !$member->canLogin()) {
		$error = _ERROR_LOGINDISALLOWED;
		$HTTP_POST_VARS['oldaction'] = $action; // see ADMIN::login()
		$_POST['oldaction'] = $action; 
		$action = "showlogin";
		
	}
	
	$admin = new ADMIN();
	$admin->action($action);
?>