<?php
function upgrade_do20() {

	if (upgrade_checkinstall(20))
		return "already installed";

	// queries come here
	
	// add ikarmaneg 
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
	
}

?>