<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

function upgrade_do96() {

	if (upgrade_checkinstall(96))
		return "already installed";

	// 1. create nucleus_actionlog
	if (!upgrade_checkIfTableExists('actionlog')) {
		$query = 'CREATE TABLE '.sql_table('actionlog')." (timestamp datetime NOT NULL default '0000-00-00 00:00:00', message varchar(255) NOT NULL default '', PRIMARY KEY  (timestamp)) ENGINE=MyISAM;";
		upgrade_query("Creating nucleus_actionlog table",$query);
	}
	
	// 2. create nucleus_ban
	if (!upgrade_checkIfTableExists('ban')) {
		$query = 'CREATE TABLE '.sql_table('ban')." (  iprange varchar(15) NOT NULL default '',  reason varchar(255) NOT NULL default '',  blogid int(11) NOT NULL default '0') ENGINE=MyISAM;";
		upgrade_query("Creating nucleus_ban table",$query);
	}
	
	// 3. add ikarma to nucleus_item
	if (!upgrade_checkIfColumnExists('item','ikarma')) {
		$query =  'ALTER TABLE '.sql_table('item')
			   . " ADD ikarma int(11) NOT NULL default '0'";
		upgrade_query("Adding karma-votes to items",$query);
	}
	
	// 4. create nucleus_karma
	if (!upgrade_checkIfTableExists('karma')) {
		$query = 'CREATE TABLE '.sql_table('karma')." ("
			."  itemid int(11) NOT NULL default '0',"
			."  ip char(15) NOT NULL default ''"
			.") ENGINE=MyISAM;";
		upgrade_query("Creating nucleus_karma table",$query);
	}
	
	// 5. nucleus_config: add MediaURL, AllowedTypes, AllowLoginEdit, AllowUpload
	
	// create MediaURL out of IndexURL
	$mediaURL = $CONF['IndexURL'] . "media/";
	
	if (!upgrade_checkIfCVExists('MediaURL')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('MediaURL', '$mediaURL');";
		upgrade_query("New setting MediaURL",$query);
	}
	if (!upgrade_checkIfCVExists('AllowedTypes')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('AllowedTypes', 'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png');";
		upgrade_query("New setting AllowedTypes",$query);
	}
	if (!upgrade_checkIfCVExists('AllowLoginEdit')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('AllowLoginEdit', '0');";
		upgrade_query("New setting AllowLoginEdit",$query);
	}
	if (!upgrade_checkIfCVExists('AllowUpload')) {
		$query = 'INSERT INTO '.sql_table('config')." VALUES ('AllowUpload', '1');";
		upgrade_query("New setting AllowUpload",$query);
	}
	
	//The following blocks (6 and 7) should check for existing values and only update as needed.
	// 6. add 'imagepopup' skincontents in skin 'default'
	
	$query = 'SELECT sdnumber FROM '.sql_table('skin_desc')." WHERE sdname='default'";
	$res = sql_query($query);
	$obj = mysql_fetch_object($res);
	$skinid = $obj->sdnumber;
	$query = 'INSERT INTO '.sql_table('skin')." VALUES (" . $skinid . ", 'imagepopup', '<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n  <title><%imagetext%></title>\r\n  <style type=\"text/css\">\r\n   img { border: none; }\r\n  </style>\r\n</head>\r\n<body>\r\n  <a href=\"javascript:window.close();\"><%image%></a>\r\n</body>\r\n</html>');";
	upgrade_query("Adding 'imagepopup' skinparts",$query);
	
	// 7. add POPUP_CODE, MEDIA_CODE, IMAGE_CODE to ALL templates
	$query = 'SELECT tdnumber FROM '.sql_table('template_desc');
	$res = sql_query($query);	// get all template ids
	while ($obj = mysql_fetch_object($res)) {
		$tid = $obj->tdnumber; 	// template id
	
		$query = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'POPUP_CODE', '<%popuplink%>');";
		$query2 = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'MEDIA_CODE', '<%media%>');";
		$query3 = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'IMAGE_CODE', '<%image%>');";
		upgrade_query("Adding popupcode to template $tid",$query);
		upgrade_query("Adding mediacode to template $tid",$query2);
		upgrade_query("Adding imagecode to template $tid",$query3);
		
	}
	
	// 8. add cip to nucleus_comment
	if(0==$upgrade_failures && !upgrade_checkIfColumnExists('comment', 'cip')){
		$query =  'ALTER TABLE '.sql_table('comment')
			   . " ADD cip varchar(15) NOT NULL default ''";
		upgrade_query("Adding IP attribute to comments",$query);
	}else{
		echo "<li>Adding IP attribute to comments ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
	}
}


?>