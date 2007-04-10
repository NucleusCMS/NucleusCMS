<?php
function upgrade_do33() {

	if (upgrade_checkinstall(33))
		return 'already installed';

	// alter nucleus_blog table
	$query = 'ALTER TABLE ' . sql_table('blog')
		   . ' ADD breqemail TINYINT(2) DEFAULT \'0\' NOT NULL';
	upgrade_query('Altering ' . sql_table('blog') . ' table', $query);

	// insert breqemail default value
	$query = 'INSERT INTO ' . sql_table('blog')
		   . ' (breqemail)'
		   . ' VALUES (0)';
	upgrade_query('Filling breqemail column of ' . sql_table('blog') . ' table', $query);

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
		   . ' ADD cname varchar(200) default NULL AFTER cblog';
	upgrade_query('Altering ' . sql_table('category') . ' table', $query);

	// refill cname to nucleus_category
	foreach ($aValues as $aInfo) {
		$query = 'UPDATE ' . sql_table('category')
			   . ' SET cname='
			   . " '" . addslashes($aInfo['cname']) . "'"
			   . " WHERE catid=" . $aInfo['catid'];
		upgrade_query('Re-filling ' . sql_table('category')
			. ' (' . $aInfo['catid'] . ')', $query);
	}

	// alter nucleus_comment
	$query = 'ALTER TABLE ' . sql_table('comment')
		   . ' ADD cemail varchar(100)'
		   . ' AFTER cmail';
	upgrade_query('Altering ' . sql_table('comment') . ' table', $query);
	
	// nothing!
}

?>
