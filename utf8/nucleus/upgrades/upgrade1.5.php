<?php
function upgrade_do15() {

	if (upgrade_checkinstall(15))
		return "already installed";

	// first two queries are needed for people running the development version
	global $nucleus;
	if (strstr($nucleus['version'],'dev')) {
		upgrade_query('Renaming table nucleus_plugins_events','RENAME TABLE '.sql_table('plugins_events').' TO '.sql_table('plugin_event'));
		upgrade_query('Renaming table nucleus_plugins','RENAME TABLE '.sql_table('plugins').' TO '.sql_table('plugin'));
	}
	
	// create nucleus_plugin_event
	$query = 'CREATE TABLE '.sql_table('plugin_event').' (pid int(11) NOT NULL, event varchar(40)) TYPE=MyISAM;';
	upgrade_query("Creating nucleus_plugin_event table",$query);

	// create nucleus_plugin
	$query = 'CREATE TABLE '.sql_table('plugin')." (pid int(11) NOT NULL auto_increment, pfile varchar(40) NOT NULL, porder int(11) not null, PRIMARY KEY(pid)) TYPE=MyISAM;";
	upgrade_query("Creating nucleus_plugin table",$query);

	// add MaxUploadSize to config	
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('MaxUploadSize','1048576')";
	upgrade_query('MaxUploadSize setting',$query);	
	

	// try to add cblog column when it does not exists yet
	$query = 'SELECT * FROM '.sql_table('comment').' WHERE cblog=0 LIMIT 1';
	$res = mysql_query($query);
	if (!$res || (mysql_num_rows($res) > 0)) {

		$query = 'ALTER TABLE '.sql_table('comment')." ADD cblog int(11) NOT NULL default '0'";
		upgrade_query('Adding cblog column in table nucleus_comment',$query);

		$query = 'SELECT inumber, iblog FROM '.sql_table('item').', '.sql_table('comment').' WHERE inumber=citem AND cblog=0';
		$res = sql_query($query);

		while($o = mysql_fetch_object($res)) {
			$query = 'UPDATE '.sql_table('comment')." SET cblog='".$o->iblog."' WHERE citem='".$o->inumber."'";
			upgrade_query('Filling cblog column for item ' . $o->inumber, $query);
		}
	}	
	
	// add 'pluginURL' to config
	global $CONF;
	$pluginURL = $CONF['AdminURL'] . "plugins/";
	$query = 'INSERT INTO '.sql_table('config')." VALUES ('PluginURL', '$pluginURL');";
	upgrade_query('PluginURL setting', $query);
	
	// add 'EDITLINK' to all templates
	$query = 'SELECT tdnumber FROM '.sql_table('template_desc');
	$res = sql_query($query);	// get all template ids
	while ($obj = mysql_fetch_object($res)) {
		$tid = $obj->tdnumber; 	// template id
	
		$query = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'EDITLINK', '<a href=\"<%editlink%>\" onclick=\"<%editpopupcode%>\">edit</a>');";
		upgrade_query("Adding editlink code to template $tid",$query);
		
	}
	
	// in templates: update DATE_HEADER templates
	$res = sql_query('SELECT * FROM '.sql_table('template').' WHERE tpartname=\'DATE_HEADER\'');
	while ($o = mysql_fetch_object($res)) {
		$newval = str_replace('<%daylink%>','<%%daylink%%>',$o->tcontent);
		$query = 'UPDATE '.sql_table('template').' SET tcontent=\''. addslashes($newval).'\' WHERE tdesc=' . $o->tdesc . ' AND tpartname=\'DATE_HEADER\'';
		upgrade_query('Updating DATE_HEADER part in template ' . $o->tdesc, $query);
	}
	
	// in templates: add 'comments'-templatevar to all non-empty ITEM templates	
	$res = sql_query('SELECT * FROM '.sql_table('template').' WHERE tpartname=\'ITEM\'');
	while ($o = mysql_fetch_object($res)) {
		if (!strstr($o->tcontent,'<%comments%>')) {
			$newval = $o->tcontent . '<%comments%>';
			$query = 'UPDATE '.sql_table('template').' SET tcontent=\''. addslashes($newval).'\' WHERE tdesc=' . $o->tdesc . ' AND tpartname=\'ITEM\'';
			upgrade_query('Updating ITEM part in template ' . $o->tdesc, $query);
		}
	}

	// new setting: NonmemberMail
	upgrade_query('NonmemberMail setting', 'INSERT INTO '.sql_table('config')." VALUES ('NonmemberMail', '0');");
	
	// new setting: ProtectMemNames
	upgrade_query('ProtectMemNames setting', 'INSERT INTO '.sql_table('config')." VALUES ('ProtectMemNames', '1');");

	// create new table: nucleus_plugin_option
	$query = 'CREATE TABLE '.sql_table('plugin_option')." (opid int(11) NOT NULL, oname varchar(20) NOT NULL, ovalue varchar(128) not null, odesc varchar(255), otype varchar(8), PRIMARY KEY(opid, oname)) TYPE=MyISAM;";
	upgrade_query("Creating nucleus_plugin_option table",$query);


}

?>