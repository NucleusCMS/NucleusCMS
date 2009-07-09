<?php
function upgrade_do310() {

	if (upgrade_checkinstall(310))
		return 'already installed';

	// 3.0 -> 3.1
	// update database version  
	update_version('310');
	// nothing!
}

?>