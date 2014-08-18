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

function upgrade_do360() {

	if (upgrade_checkinstall(360))
		return 'インストール済みです';
	
	// Give user warning if they are running old version of PHP
	if (phpversion() < '5') {
		echo '警告：サーバで稼動しているPHPのバージョンが、NucleusCMSの動作保障外の古いバージョンのようです。PHP5以上にアップグレードしてください！';
	}
	
	// changing the blog table to lengthen bnotify field 
	$query = "	ALTER TABLE `" . sql_table('blog') . "`
					MODIFY `bnotify` varchar(128) default NULL ;";
	
	upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
	
	// 3.5 -> 3.6
	// update database version
	update_version('360');
	
}

