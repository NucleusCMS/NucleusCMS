<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

include('upgrade.functions.php');

// check if logged in etc
if (!$member->isLoggedIn()) {
	upgrade_showLogin('upgrade.php?from=' . intGetVar('from'));
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
include('upgrade3.2.php');
include('upgrade3.3.php');
include('upgrade3.4.php');
include('upgrade3.5.php');
include('upgrade3.6.php');

$from = intGetVar('from');

upgrade_start();

switch($from) {
	case 95:
		upgrade_do95();
		upgrade_do96();
	case 96:
		upgrade_do100();
	case 100:
		upgrade_do110();
	case 110:
		upgrade_do150();
	case 150:
		upgrade_do200();
	case 200:
		upgrade_do250();
	case 250:
		upgrade_do300();
	case 300:
		upgrade_do310();
	case 310:
		upgrade_do320();
		//break;
	case 320:
		upgrade_do330();
		//break;
	case 330:
		upgrade_do340();
		//break;
	case 340:
		upgrade_do350();
		//break;
	case 350:
		upgrade_do360();
		break;
	default:
		echo "<li>Error! No updates to execute</li>";
		break;
}



upgrade_end("Upgrade Completed");

?>