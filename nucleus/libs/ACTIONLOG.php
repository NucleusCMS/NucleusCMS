<?

/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * Actionlog class for Nucleus
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
		
		if ($member->isLoggedIn())
			$message = "[" . $member->getDisplayName() . "] " . $message;
		
		$message = addslashes($message);		// add slashes
		$timestamp = date("Y-m-d H:i:s",time());	// format timestamp
		$query = "INSERT INTO " . sql_table('actionlog') . " (timestamp, message) VALUES ('$timestamp', '$message')";
		
		sql_query($query);
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

}

?>
