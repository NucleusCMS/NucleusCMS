<?php
function upgrade_do33() {

	if (upgrade_checkinstall(33))
		return 'already installed';

	if (!upgrade_checkIfColumnExists('comment','cemail')) {
		$query = "	ALTER TABLE `nucleus_comment`
					ADD `cemail` VARCHAR( 100 ) AFTER `cmail` ;";

		upgrade_query('Altering ' . sql_table('comment') . ' table', $query);
	}

	if (!upgrade_checkIfColumnExists('blog','breqemail')) {
		$query = "	ALTER TABLE `nucleus_blog`
					ADD `breqemail` TINYINT( 2 ) DEFAULT '0' NOT NULL ;";

		upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
	}

	// 3.2 -> 3.3
	// update database version
	update_version('330');
}

?>
