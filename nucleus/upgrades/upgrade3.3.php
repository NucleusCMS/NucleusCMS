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

function upgrade_do330() {

	if (upgrade_checkinstall(330))
		return 'already installed';

	if (!upgrade_checkIfColumnExists('comment','cemail')) {
		$query = "	ALTER TABLE `" . sql_table('comment') . "`
					ADD `cemail` VARCHAR( 100 ) AFTER `cmail` ;";

		upgrade_query('Altering ' . sql_table('comment') . ' table', $query);
	}

	if (!upgrade_checkIfColumnExists('blog','breqemail')) {
		$query = "	ALTER TABLE `" . sql_table('blog') . "`
					ADD `breqemail` TINYINT( 2 ) DEFAULT '0' NOT NULL ;";

		upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
	}

	// check cmail column to separate to URL and cemail
	mysql_query(
		'UPDATE ' . sql_table('comment') . ' ' . 
		"SET cemail = cmail, cmail = '' " .
		"WHERE cmail LIKE '%@%'"
	);

	if (!upgrade_checkIfColumnExists('item','iposted')) {
		$query = "	ALTER TABLE `" . sql_table('item') . "`
                                ADD `iposted` TINYINT(2) DEFAULT 1 NOT NULL ;";

		upgrade_query('Altering ' . sql_table('item') . ' table', $query);
	}

	if (!upgrade_checkIfColumnExists('blog','bfuturepost')) {
		$query = "	ALTER TABLE `" . sql_table('blog') . "`
                                ADD `bfuturepost` TINYINT(2) DEFAULT 0 NOT NULL ;";

		upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
	}

	// 3.2 -> 3.3
	// update database version
	update_version('330');

	// check to see if user turn on Weblogs.com ping, if so, suggest to install the plugin
	$query = "SELECT bsendping FROM " . sql_table('blog') . " WHERE bsendping='1'"; 
	$res = mysql_query($query);
	if (mysql_num_rows($res) > 0) {
		echo "<li>Note: The weblogs.com ping function is improved and moved into a plugin. To activate this function in v3.3, please go to plugin menu and install NP_Ping plugin. Also, NP_Ping is replacing NP_PingPong. If you have NP_PingPing installed, please also remove it.</li>";
	}
}

?>
