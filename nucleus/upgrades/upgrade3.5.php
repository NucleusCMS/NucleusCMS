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

function upgrade_do350() {

	if (upgrade_checkinstall(350))
		return 'インストール済みです';
	
	// Give user warning if they are running old version of PHP
		if (phpversion() < '5') {
				echo '警告：サーバで稼動しているPHPのバージョンが、NucleusCMSの動作保障外の古いバージョンのようです。PHP5以上にアップグレードしてください！';
		}
	
	// changing the member table to lengthen display name (mname)
	$query = "	ALTER TABLE `" . sql_table('member') . "`
					MODIFY `mname` varchar(32) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('member') . ' table', $query);

	// changing the blog table to remove bsendping flag
	if (upgrade_checkIfColumnExists('blog', 'bsendping')) {
		$query = "	ALTER TABLE `" . sql_table('blog') . "`
					DROP `bsendping`;";
	
		upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
	}

	// 3.4 -> 3.5
	// update database version
	update_version('350');

	// Remind user to re-install NP_Ping 
	echo '<p>注意: バージョン3.50よりNP_Pingに変更があるので、使用中の方は管理画面より再インストールしてください。</p>';

}
