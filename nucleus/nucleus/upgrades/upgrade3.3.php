<?php
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

	if (!upgrade_checkIfColumnExists('item','posted')) {
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
		echo "<li>Note: The weblogs.com ping function is improved and moved into a plugin. To activate this function in v3.3, please go to plugin menu and install NP_Ping plugin.</li>";
	}
}

?>
