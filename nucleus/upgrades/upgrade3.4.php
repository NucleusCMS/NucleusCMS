<?php
function upgrade_do340() {

	if (upgrade_checkinstall(340))
		return 'already installed';
	
	// Give user warning if they are running old version of PHP
        if (phpversion() < '5') {
                echo 'WARNING: You are running NucleusCMS on a older version of PHP. PHP4 support will be depreciated in the next release, please consider upgrade to PHP5!';
        }

	// lengthen tpartname column of nucleus_template
	$query = "	ALTER TABLE `" . sql_table('template') . "`
					MODIFY `tpartname` varchar(64) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('template') . ' table', $query);
	
	// lengthen tdname column of nucleus_template_desc
	$query = "	ALTER TABLE `" . sql_table('template_desc') . "`
					MODIFY `tdname` varchar(64) NOT NULL default '' ;";

	upgrade_query('Altering ' . sql_table('template_desc') . ' table', $query);
	
	// create DebugVars setting
	if (!upgrade_checkIfCVExists('DebugVars')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('DebugVars',0)";
		upgrade_query('Creating DebugVars config value',$query);	
	}
	
	// create DefaultListSize setting
	if (!upgrade_checkIfCVExists('DefaultListSize')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('DefaultListSize',10)";
		upgrade_query('Creating DefaultListSize config value',$query);	
	}
	
	// changing the member table
    $query = ' ALTER TABLE ' . sql_table('member') . ' ADD mautosave TINYINT(2) DEFAULT 1';
	upgrade_query('Adding a new row for the autosave member option', $query);

	// 3.3 -> 3.4
	// update database version
	update_version('340');
	
}

?>
