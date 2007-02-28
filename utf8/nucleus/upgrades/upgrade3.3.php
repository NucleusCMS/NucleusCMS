<?php
function upgrade_do33() {

	if (upgrade_checkinstall(33))
		return 'already installed';

	// alter nucleus_blog table
	$query = 'ALTER TABLE ' . sql_table('blog')
		   . ' ADD breqemail TINYINT(2) DEFAULT '0' NOT NULL';
	upgrade_query('Altering ' . sql_table('blog') . ' table', $query);

	// insert breqemail default value
	$query = 'INSERT INTO ' . sql_table('blog')
		   . ' (breqemail)'
		   . ' VALUES (0)';

	// store cname from nucleus_category
	$query = 'SELECT catid, cname FROM ' . sql_table('category') . ' ORDER By catid ASC';
	$res = sql_query($query);
	$aValues = array();
	while ($o = mysql_fetch_object($res)) {
		$aValues[] = array(
						'catid' => $o->catid,
						'cname' => $o->cname
					);
	}

	// alter nucleus_category
	$query = 'ALTER TABLE ' . sql_table('category')
		   . ' DROP COLUMN cname,'
		   . ' ADD cname varchar(200) default NULL';
	upgrade_query('Altering ' . sql_table('category') . ' table', $query);

	// refill cname to nucleus_category
	foreach ($aValues as $aInfo) {
		$query = 'INSERT INTO ' . sql_table('category')
			   . ' (cname)'
			   . " VALUES (" . $aInfo['cname'] . ")"
			   . " WHERE catid=" . $aInfo['catid'];
		upgrade_query('Re-filling ' . sql_table('category')
			. ' (' . $aInfo['catid'] . ')', $query);
	}

	
/*
	// create nucleus_activation table
	$query = 'CREATE TABLE ' . sql_table('activation') . ' ('
	  	   . ' vkey varchar(40) NOT NULL default \'\','
	  	   . ' vtime datetime NOT NULL default \'0000-00-00 00:00:00\','
	  	   . ' vmember int(11) NOT NULL default \'0\','
	  	   . ' vtype varchar(15) NOT NULL default \'\','
	  	   . ' vextra varchar(128) NOT NULL default \'\','
	  	   . ' PRIMARY KEY  (vkey) '
	   	   . ' )';
    upgrade_query('Creating account activation table', $query);    

	// create CookiePrefix setting
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('CookiePrefix','')";
	upgrade_query('Creating CookiePrefix config value',$query);	
		
	// create nucleus_tickets table
	$query = 'CREATE TABLE ' . sql_table('tickets') . ' ('
	  	   . ' ticket varchar(40) NOT NULL default \'\','
	  	   . ' ctime datetime NOT NULL default \'0000-00-00 00:00:00\','
	  	   . ' member int(11) NOT NULL default \'0\', '
	  	   . ' PRIMARY KEY  (ticket, member) '
	   	   . ' )';
    upgrade_query('Creating ticket table', $query);    

	// 3.1 -> 3.1+
	// update database version  
	$query = 'UPDATE ' . sql_table('config') . ' set value=\'320\' where name=\'DatabaseVersion\'';
	upgrade_query('Updating DatabaseVersion in config table to 320', $query);
*/	
	// nothing!
}

?>
