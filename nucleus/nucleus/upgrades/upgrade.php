<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  */

include('upgrade.functions.php'); 
	
// check if logged in etc
if (!$member->isLoggedIn()) {
	upgrade_showLogin('upgrade.php?from=' . intval($HTTP_GET_VARS['from']));
}

if (!$member->isAdmin()) {
	upgrade_error('Only Super-Admins are allowed to perform upgrades');
}

include('upgrade0.95.php');
include('upgrade0.96.php');
include('upgrade1.0.php');
include('upgrade1.1.php');
include('upgrade1.5.php');
include('upgrade2.0.php');
include('upgrade2.5.php');
include('upgrade3.0.php');
include('upgrade3.1.php');

$from = intGetVar('from');

upgrade_start();

switch($from) {
	case 95:
		upgrade_do95();
		upgrade_do96();
	case 96:
		upgrade_do10();
	case 10:
		upgrade_do11();
	case 11:
		upgrade_do15();
	case 15:
		upgrade_do20();
	case 20:
		upgrade_do25();
	case 25:
		upgrade_do30();
	case 30:
		upgrade_do31();
		break;
	default:
		echo "<li>Error! No updates to execute</li>";
		break;
}



upgrade_end("Upgrade Completed");

?>