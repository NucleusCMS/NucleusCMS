<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

include('upgrade.functions.php');

// check if logged in etc
if (!$member->isLoggedIn()) {
	upgrade_showLogin('upgrade.php?from=' . intGetVar('from'));
}

if (!$member->isAdmin()) {
	upgrade_error('Super-admin（最高管理者）のみがアップグレードを実行できます。');
}

$from = intGetVar('from');

upgrade_start();

switch($from) {
	case 95:
		include('upgrade0.95.php');
		include('upgrade0.96.php');
		upgrade_do95();
		upgrade_do96();
	case 96:
		include('upgrade1.0.php');
		upgrade_do100();
	case 100:
		include('upgrade1.1.php');
		upgrade_do110();
	case 110:
		include('upgrade1.5.php');
		upgrade_do150();
	case 150:
		include('upgrade2.0.php');
		upgrade_do200();
	case 200:
		include('upgrade2.5.php');
		upgrade_do250();
	case 250:
		include('upgrade3.0.php');
		upgrade_do300();
	case 300:
		include('upgrade3.1.php');
		upgrade_do310();
	case 310:
		include('upgrade3.2.php');
		upgrade_do320();
	case 320:
		include('upgrade3.3.php');
		upgrade_do330();
	case 330:
		include('upgrade3.31.php');
		upgrade_do331();
	case 331:
		include('upgrade3.4.php');
		upgrade_do340();
	case 340:
		include('upgrade3.5.php');
		upgrade_do350();
	case 350:
		include('upgrade3.6.php');
		upgrade_do360();
		break;
	default:
		echo "<li>エラー! 実行すべきアップデートはありません</li>";
		break;
}



upgrade_end('アップグレード成功');
