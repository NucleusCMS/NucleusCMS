<?php
function upgrade_do34() {

	if (upgrade_checkinstall(34))
		return 'already installed';
	
	// lengthen tpartname column of nucleus_template
	$query = "	ALTER TABLE `" . sql_table('template') . "`
					MODIFY `tpartname` varchar(64) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('template') . ' table', $query);
	
	// lengthen tdname column of nucleus_template_desc
	$query = "	ALTER TABLE `" . sql_table('template_desc') . "`
					MODIFY `tdname` varchar(64) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('template_desc') . ' table', $query);

	// 3.3 -> 3.4
	// update database version
	update_version('340');

	
}

?>
