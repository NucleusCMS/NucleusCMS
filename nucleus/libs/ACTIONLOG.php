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
 * Actionlog class for Nucleus
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
define('ERROR',1);		// only errors
define('WARNING',2);	// errors and warnings
define('INFO',3);		// info, errors and warnings
define('DEBUG',4);		// everything
$CONF['LogLevel'] = INFO;

class ActionLog
{
	/**
	 * ActionLog::add()
	 * Method to add a message to the action log
	 * 
	 * @static
	 * @param	Integer	$level	log level
	 * @param	String	$message	log message
	 * @return	
	 * 
	 */
	function add($level, $message)
	{
		global $member, $CONF;
		
		if ( $CONF['LogLevel'] < $level )
		{
			return;
		}
		
		if ( $member && $member->isLoggedIn() )
		{
			$message = "[" . $member->getDisplayName() . "] " . $message;
		}
		
		$query = "INSERT INTO %s (timestamp, message) VALUES (%s, %s)";
		$query = sprintf($query, sql_table('actionlog'), DB::formatDateTime(), DB::quoteValue($message));
		DB::execute($query);
		
		self::trimLog();
		return;
	}
	
	/**
	  * (Static) Method to clear the whole action log
	  */
	function clear() {
		global $manager;

		$query = sprintf('DELETE FROM %s', sql_table('actionlog'));

		$data = array();
		$manager->notify('ActionLogCleared', $data);

		return DB::execute($query) !== FALSE;
	}

	/**
	  * (Static) Method to trim the action log (from over 500 back to 250 entries)
	  */
	function trimLog() {
		static $checked = 0;

		// only check once per run
		if ($checked) return;

		// trim
		$checked = 1;

		$query = sprintf('SELECT COUNT(*) AS result FROM %s', sql_table('actionlog'));
		$iTotal = DB::getValue($query);

		// if size > 500, drop back to about 250
		$iMaxSize = 500;
		$iDropSize = 250;
		if ($iTotal > $iMaxSize) {
			$query = sprintf('SELECT timestamp as result FROM %s ORDER BY timestamp DESC LIMIT %d,1',
				sql_table('actionlog'), intval($iDropSize));
			$tsChop = DB::getValue($query);
			$query = sprintf("DELETE FROM %s WHERE timestamp < '%s'", sql_table('actionlog'), $tsChop);
			DB::execute($query);
		}

	}

}

?>