<?php
function upgrade_do31() {

	if (upgrade_checkinstall(31))
		return 'already installed';

	// 3.0 -> 3.1
	// update database version  
	$query = 'UPDATE ' . sql_table('config') . ' set value=\'310\' where name=\'DatabaseVersion\'';
	upgrade_query('Updating DatabaseVersion in config table to 310', $query);
	
	// nothing!
}

?>
