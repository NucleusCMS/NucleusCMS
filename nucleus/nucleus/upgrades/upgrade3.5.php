<?php
function upgrade_do350() {

	if (upgrade_checkinstall(350))
		return 'already installed';
	
	// Give user warning if they are running old version of PHP
        if (phpversion() < '5') {
                echo 'WARNING: You are running NucleusCMS on a older version of PHP that is no longer supported by NucleusCMS. Please upgrade to PHP5!';
        }
	}
	
	// changing the member table to lengthen display name (mname)
    $query = "	ALTER TABLE `" . sql_table('member') . "`
					MODIFY `mname` varchar(32) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('member') . ' table', $query);

	// 3.4 -> 3.5
	// update database version
	update_version('350');
	
}

?>
