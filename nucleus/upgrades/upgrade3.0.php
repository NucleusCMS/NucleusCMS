<?php
function upgrade_do30() {

	if (upgrade_checkinstall(30))
		return 'already installed';

	// 2.5(beta/RC/...) -> 3.0
	// update database version  
	$query = 'UPDATE ' . sql_table('config') . ' set value=\'300\' where name=\'DatabaseVersion\'';
	upgrade_query('Updating DatabaseVersion in config table to 300', $query);
	
	// nothing!
}

?>
