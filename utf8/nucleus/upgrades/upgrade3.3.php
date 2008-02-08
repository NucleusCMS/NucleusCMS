<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * $NucleusJP: upgrade3.3.php,v 1.5.2.1 2007/10/24 05:39:16 kimitake Exp $
 *
 */

function upgrade_do33() {

	if (upgrade_checkinstall(33))
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

	// 3.2 -> 3.3
	// update database version
	update_version('330');

}

?>
