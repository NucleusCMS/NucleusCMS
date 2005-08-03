<?php
function upgrade_do31() {

	if (upgrade_checkinstall(31))
		return 'already installed';

	// 3.0 -> 3.1
	// update database version  
	update_version('310');
	// nothing!
}

?>