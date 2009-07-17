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

	// changing the blog table to remove bsendping flag
    $query = "	ALTER TABLE `" . sql_table('blog') . "`
					DROP `bsendping`;";

	upgrade_query('Altering ' . sql_table('blog') . ' table', $query);

	// 3.4 -> 3.5
	// update database version
	update_version('350');

	// Remind user to re-install NP_Ping 
	echo '<p>Note: There are new changes to NP_Ping in v3.50. If it is already installed, please go to Admin Panel uninstall and re-install the plugin</p>';
	
}
?>
