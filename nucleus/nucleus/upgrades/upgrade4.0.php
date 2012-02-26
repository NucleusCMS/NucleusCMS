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
 * @version $Id: upgrade2.0.php 1388 2009-07-18 06:31:28Z shizuki $
 */

function upgrade_do400()
{
	if ( upgrade_checkinstall(400) )
	{
		return "already installed";
	}
	
	/* config.Language to config.Locale  */
	if ( !upgrade_checkIfColumnExists('config','Locale') )
	{
		$res = sql_query("SELECT * FROM " . sql_table('config') . " WHERE name='Language'");
		while ( $o = mysql_fetch_object($res) )
		{
			$locale = $o->Language;
		}
		$query = 'INSERT INTO ' . sql_table('config') . " (name, value) VALUE('Locale', '{$locale}');";
		upgrade_query("Renaming Language for configs to Locale", $query);
	}
	
	if ( !upgrade_checkIfColumnExists('config','Language') )
	{
		$query = "DELETE * FROM " . sql_table('config') . " WHERE name='Language'";
		upgrade_query("Renaming Language for configs to Locale", $query);
	}
	
	/* member.deflang to member.mlocale   */
	if ( !upgrade_checkIfColumnExists('member','mlocale') )
	{
		$query =  'ALTER TABLE '.sql_table('member') . " CHANGE deflang mlocale varchar(10) NOT NULL default ''";
		upgrade_query("Renaming deflang column for members to mlocale", $query);
	}
}

