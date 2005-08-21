<?php
function upgrade_do30() {

	if (upgrade_checkinstall(30))
		return 'already installed';

	// 2.5(beta/RC/...) -> 3.0
	// update database version  
	update_version('300');
	// nothing!
}

?>