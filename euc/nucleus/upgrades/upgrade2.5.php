<?php
function upgrade_do25() {

	if (upgrade_checkinstall(25))
		return 'already installed';

	// -------------------- 2.0 -> 2.2 (dev only) --------------------
	// (avoid doing this twice :))
	if (!upgrade_checkinstall(22))	{
		// 1. create nucleus_plugin_option_desc table
		// create new table: nucleus_plugin_option
		$query = 'CREATE TABLE IF NOT EXISTS '. sql_table('plugin_option_desc') . '('
			   ." oid int(11) NOT NULL auto_increment UNIQUE,"
			   ." opid int(11) NOT NULL,"
			   ." oname varchar(20) NOT NULL,"
			   ." ocontext varchar(20) NOT NULL,"
			   ." odesc varchar(255),"
			   ." otype varchar(20),"
			   ." odef text,"
			   ." oextra text,"
			   ." PRIMARY KEY(opid, oname, ocontext)"
			   .") TYPE=MyISAM;";
		upgrade_query('Creating ' . sql_table('plugin_option_desc') . ' table',$query);

		// 2. move all data from plugin_option to plugin_option_desc
		$query = 'SELECT * FROM ' . sql_table('plugin_option') .' ORDER BY oid ASC';
		$res = sql_query($query);
		$aValues = array();
		while ($o = mysql_fetch_object($res)) {
			$query = 'INSERT INTO ' . sql_table('plugin_option_desc')
				   .' (opid, oname, ocontext, odesc, otype)'
				   ." VALUES ("
						."'".addslashes($o->opid)."',"
						."'".addslashes($o->oname) ."',"
						."'global',"
						."'".addslashes($o->odesc) ."',"
						."'".addslashes($o->otype) ."')";
			upgrade_query('Moving option description for '.htmlspecialchars($o->oname).' to ' . sql_table('plugin_option_desc'), $query);

			// store new id
			$aValues[] = array ( 
							'id' => mysql_insert_id(),
							'value' => $o->ovalue
						);

		}

		// 3. alter plugin_options table 
		$query = 'ALTER TABLE ' . sql_table('plugin_option')
			   .' DROP PRIMARY KEY,'
			   .' DROP KEY oid,'
			   .' DROP COLUMN opid,'
			   .' DROP COLUMN oname,'
			   .' DROP COLUMN odesc,'
			   .' DROP COLUMN otype,'		
			   .' ADD ocontextid INT(11) NOT NULL,'
			   .' ADD PRIMARY KEY (oid, ocontextid)';
		upgrade_query('Altering ' . sql_table('plugin_option') . ' table', $query);

		// 4. delete from plugin_options
		$query = 'DELETE FROM ' . sql_table('plugin_option');
		upgrade_query('Cleaning ' . sql_table('plugin_option'), $query);

		// 5. refill plugin_options
		foreach ($aValues as $aInfo) {
			$query = 'INSERT INTO ' . sql_table('plugin_option') 
				   .' (oid, ocontextid, ovalue)'
				   ." VALUES (".$aInfo['id'].",'0','".addslashes($aInfo['value'])."')";
			upgrade_query('Re-filling ' . sql_table('plugin_option') . ' ('.$aInfo['id'].')', $query);
		}	
	}		
	
	// -------------------- 2.0 -> 2.5 --------------------
	
	if (!upgrade_checkIfIndexExists('item', array('ibody', 'ititle', 'imore'))) {
		// add fulltext indices for search
		$query = 'ALTER TABLE ' . sql_table('item') . ' ADD FULLTEXT(ibody, ititle, imore)';
		upgrade_query('Adding fulltext index to item table', $query);
		// repair table is needed (build index)
		upgrade_query('Repairing item table', 'REPAIR TABLE ' . sql_table('item'));
	}
	
	if (!upgrade_checkIfIndexExists('comment', array('cbody'))) {
		$query = 'ALTER TABLE ' . sql_table('comment') . ' ADD FULLTEXT(cbody)';
		upgrade_query('Adding fulltext index to comments table', $query);	
		upgrade_query('Repairing comment table', 'REPAIR TABLE ' . sql_table('comment'));	
	}	
	
	if (!upgrade_checkinstall(24))	{
	    $query = ' ALTER TABLE ' . sql_table('blog') . ' ADD bincludesearch TINYINT(2) DEFAULT 0';
		upgrade_query('Adding bincludesearch column to blog', $query);
	}
	
	// modify plugin option table value column type to TEXT
	$query = 'ALTER TABLE ' . sql_table('plugin_option') . ' MODIFY ovalue TEXT NOT NULL default \'\'';
	upgrade_query('Modifying plugin options column type', $query);
	
	// insert database version  (allows us to do better version checking in v3.0 upgrades)
	$query = 'INSERT INTO ' . sql_table('config') . ' (name,value) VALUES (\'DatabaseVersion\',\'250\')';
	upgrade_query('Adding DatabaseVersion to config table', $query);

	// insert External Authentication global option
	$query = 'INSERT INTO ' . sql_table('config') . ' (name,value) VALUES (\'ExtAuth\',\'0\')';
	upgrade_query('Adding External Authentication option to config table', $query);	
}

?>
