<?php
function upgrade_do300() {

	if (upgrade_checkinstall(300))
		return 'already installed';

	// 2.5(beta/RC/...) -> 3.0
	// update database version  
	update_version('300');
	// nothing!
}

?>