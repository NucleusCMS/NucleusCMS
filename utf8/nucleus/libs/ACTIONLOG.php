<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * Actionlog class for Nucleus
  *
  * $Id: ACTIONLOG.php,v 1.1.1.1 2005-02-28 07:14:43 kimitake Exp $
  */
define('ERROR',1);		// only errors
define('WARNING',2);	// errors and warnings
define('INFO',3);		// info, errors and warnings
define('DEBUG',4);		// everything 
$CONF['LogLevel'] = INFO;

class ACTIONLOG {

	/**
	  * (Static) Method to add message to log
	  */
	function add($level, $message) {
		global $member, $CONF;
		
		if ($CONF['LogLevel'] < $level)
			return;
		
		if ($member && $member->isLoggedIn())
			$message = "[" . $member->getDisplayName() . "] " . $message;
		
		$message = addslashes($message);		// add slashes
		$timestamp = date("Y-m-d H:i:s",time());	// format timestamp
		$query = "INSERT INTO " . sql_table('actionlog') . " (timestamp, message) VALUES ('$timestamp', '$message')";
		
		sql_query($query);
		
		ACTIONLOG::trimLog();
	}
	
	/**
	  * (Static) Method to clear log
	  */
	function clear() {
		global $manager;
		
		$query = 'DELETE FROM ' . sql_table('actionlog');

		$manager->notify('ActionLogCleared',array());
		
		return sql_query($query);
	}
	
	function trimLog() {
		static $checked = 0;
		
		// only check once per run
		if ($checked) return;
		
		// trim
		$checked = 1;
		
		$iTotal = quickQuery('SELECT COUNT(*) AS result FROM ' . sql_table('actionlog'));
		
		// if size > 500, drop back to about 250
		$iMaxSize = 500;
		$iDropSize = 250;
		if ($iTotal > $iMaxSize) {
			$tsChop = quickQuery('SELECT timestamp as result FROM ' . sql_table('actionlog') . ' ORDER BY timestamp DESC LIMIT '.$iDropSize.',1');
			sql_query('DELETE FROM ' . sql_table('actionlog') . ' WHERE timestamp < \'' . $tsChop . '\'');
		}
		
	}

}

?>