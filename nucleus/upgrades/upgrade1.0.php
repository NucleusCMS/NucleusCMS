<?php
function upgrade_do10() {
	
if (upgrade_checkinstall(10))
	return "already installed";

// 1. add mcookiekey to nucleus_member
$query =  'ALTER TABLE '.sql_table('member')
       . " ADD mcookiekey varchar(40) ";
$res = upgrade_query("Adding cookiekey attribute to members",$query);       

// only do this when the previous query succeeds
if ($res) {
	// 2. for all members: hash their password and also copy it to mcookiekey
	$query = 'SELECT * FROM '.sql_table('member');
	$res = mysql_query($query);
	while ($current = mysql_fetch_object($res)) {
		$hashedpw = md5($current->mpassword);
		$updquery = 'UPDATE '.sql_table('member')." SET mpassword='$hashedpw' WHERE mnumber=" . $current->mnumber;
		upgrade_query("Encrypting password for member " . $current->mnumber,$updquery);
	}
}

// 3. add extra indices to tables
$query = 'ALTER TABLE '.sql_table('item').' ADD INDEX(iblog, itime);';
upgrade_query("Adding extra index to nucleus_item",$query);
$query = 'ALTER TABLE '.sql_table('comment').' ADD INDEX(citem);';
upgrade_query("Adding extra index to nucleus_comment",$query);

// 4. add DisableJsTools to config
$query = 'INSERT INTO '.sql_table('config')." VALUES ('DisableJsTools', '0');";
upgrade_query("Adding setting DisableJsTools",$query);

// 5. Drop primary key in nucleus_actionlog
$query = 'ALTER TABLE '.sql_table('actionlog').' DROP PRIMARY KEY;';
upgrade_query("Dropping primary key for actionlog table",$query);

}


?>