<?php
function upgrade_do32() {

	if (upgrade_checkinstall(32))
		return 'already installed';

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
//	$query = 'UPDATE ' . sql_table('config') . ' set value=\'320\' where name=\'DatabaseVersion\'';
//	upgrade_query('Updating DatabaseVersion in config table to 320', $query);
	
	// nothing!
}

?>
