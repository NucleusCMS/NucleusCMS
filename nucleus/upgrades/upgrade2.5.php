<?php
function upgrade_do25() {

	if (upgrade_checkinstall(25))
		return 'already installed';

	// queries come here
	
	// 1. create nucleus_plugin_option_desc table
	// create new table: nucleus_plugin_option
	$query = 'CREATE TABLE '. sql_table('plugin_option_desc') . '('
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
		   
	
	
/*	// add ikarmaneg 
	$query =  'ALTER TABLE '.sql_table('item')
		   . " ADD ikarmaneg int(11) NOT NULL default '0'";
	upgrade_query("Adding ikarmaneg column to items",$query);

	// rename ikarma to ikarmapos
	$query =  'ALTER TABLE '.sql_table('item')
		   . " CHANGE ikarma ikarmapos int(11) NOT NULL default '0'";
	upgrade_query("Renaming ikarma column for items to ikarmapos",$query);

	// drop key in actionlog
	$query = 'ALTER TABLE '.sql_table('actionlog').' DROP PRIMARY KEY';
	upgrade_query("Dropping primary key in actionlog table",$query);	
	
	// change cmail field length
	$query = 'ALTER TABLE '.sql_table('comment').' CHANGE cmail cmail varchar(100) default NULL';
	upgrade_query("changing max email/url length of guest comments to 100",$query);	
	
	// create default skin option
	$skinid = SKIN::getIdFromName('default');
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('BaseSkin', '$skinid');";
	upgrade_query("Adding setting BaseSkin",$query);

	// add SkinsURL setting
	global $CONF;
	$skinsurl = str_replace('/media/','/skins/',$CONF['MediaURL']);
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('SkinsURL', '".addslashes($skinsurl)."');";
	upgrade_query("Adding setting SkinsURL",$query);

	// add ActionURL setting
	$actionurl = str_replace('/media/','/action.php',$CONF['MediaURL']);
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('ActionURL', '".addslashes($actionurl)."');";
	upgrade_query("Adding setting ActionURL",$query);
	
	// time offset can also be decimal (for half time zones like GMT+3:30)
	upgrade_query('Changing time offset column type to decimal','ALTER TABLE '.sql_table('blog')." CHANGE btimeoffset btimeoffset DECIMAL( 3, 1 ) DEFAULT '0' NOT NULL");
	
	// add sdincmode and sdincpref to skins
	$query =  'ALTER TABLE '.sql_table('skin_desc')
		   . " ADD sdincmode varchar(10) NOT NULL default 'normal'";
	upgrade_query('Adding IncludeMode property to skins',$query);	
	$query =  'ALTER TABLE '.sql_table('skin_desc')
		   . " ADD sdincpref varchar(50) NOT NULL default ''";
	upgrade_query('Adding IncludePrefix property to skins',$query);	
	
	// add ballowpast option to nucleus_blog
	$query =  'ALTER TABLE '.sql_table('blog')." ADD ballowpast tinyint(2) NOT NULL default '0'";
	upgrade_query("Adding 'Allow posting to the past' option to blogs",$query);
	
	// URLMode
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('URLMode', 'normal');";
	upgrade_query("Adding setting URLMode",$query);
	
	// add id to nucleus_plugin_option (allows for ordening)
	$query =  'ALTER TABLE '.sql_table('plugin_option').' ADD oid int(11) NOT NULL auto_increment UNIQUE ';
	upgrade_query("Adding id attribute to plugin options table",$query);
	*/
}

?>