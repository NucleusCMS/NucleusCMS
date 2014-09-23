<?php

/**
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

	/**
	 * Some functions common to all upgrade scripts
	 */

	/*************************************************************
	 * NOTE: With upgrade to 4.0, need to set this to use DB::* API
	 **************************************************************/

	include('../../config.php');

	// sql_table function did not exists in nucleus <= 2.0
	if ( !function_exists('sql_table') )
	{
		function sql_table($name)
		{
			return 'nucleus_' . $name;
		}
	}

	//intGetVar did not exist in very early versions
	if ( !function_exists('intGetVar') )
	{
		function intGetVar($name)
		{
			return intval($_GET[$name]);
		}
	}


	function upgrade_checkinstall($version)
	{
		$installed = 0;

		switch( $version )
		{
			case '95':
				$query = 'SELECT bconvertbreaks FROM ' . sql_table('blog') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '96':
				$query = 'SELECT cip FROM ' . sql_table('comment') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '100':
				$query = 'SELECT mcookiekey FROM ' . sql_table('member') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '110':
				$query = 'SELECT bnotifytype FROM ' . sql_table('blog') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '150':
				$query = 'SELECT * FROM ' . sql_table('plugin_option') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '200':
				$query = 'SELECT sdincpref FROM ' . sql_table('skin_desc') . ' LIMIT 1';
				$minrows = -1;
			break;

			// dev only (v2.2)
			case '220':
				$query = 'SELECT oid FROM ' . sql_table('plugin_option_desc') . ' LIMIT 1';
				$minrows = -1;
			break;

			// v2.5 beta
			case '240':
				$query = 'SELECT bincludesearch FROM ' . sql_table('blog') . ' LIMIT 1';
				$minrows = -1;
			break;

			case '250':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 250 LIMIT 1";
				$minrows = 1;
			break;

			case '300':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 300 LIMIT 1";
				$minrows = 1;
			break;

			case '310':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 310 LIMIT 1";
				$minrows = 1;
			break;

			case '320':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 320 LIMIT 1";
				$minrows = 1;
			break;

			case '330':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 330 LIMIT 1";
				$minrows = 1;
			break;

			case '340':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 340 LIMIT 1";
				$minrows = 1;
			break;

			case '350':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 350 LIMIT 1";
				$minrows = 1;
			break;

			case '360':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 360 LIMIT 1";
				$minrows = 1;
			break;

			case '400':
				$query = 'SELECT * FROM ' . sql_table('config') . " WHERE name='DatabaseVersion' and value >= 400 LIMIT 1";
				$minrows = 1;
			break;
		}

		$result = mysql_query($query);
		$installed = ( $result != 0 ) && (mysql_num_rows($result) >= $minrows);
		
		return $installed;
	}


	/**
	 * Get the Nucleus version. If getNucleusVersion() doesn't exist, default to version 0.96
	 * @return int
	 */
	function upgrade_getNucleusVersion()
	{
		if ( !function_exists('getNucleusVersion') )
		{
			return 96;
		}

		return getNucleusVersion();
	}

	/**
	 * Show the login form
	 * @param string $action
	 */
	function upgrade_showLogin($action)
	{
		upgrade_head();
		
		echo "<h1> Log In </h1>\n";
		echo "<p>Please enter your login name and password. </p>\n";
	
		echo "<form method=\"POST\" action=\"{$action}\">\n";
		echo "<ul>\n";
		echo '<li><label for="i_login">Name:</label> <input type="text" name="login" id="i_login" size="20" /></li>' . "\n";
		echo '<li><label for="i_password">Password:</label> <input type="password" name="password" id="i_password" size="20" /></li>' . "\n";
		echo "</ul>\n";
		echo '<p><input type="submit" value="Log In" /></p>' . "\n";
		echo '<input name="action" value="login" type="hidden" />' . "\n";
		echo "</form>\n";
		
		upgrade_foot();
		exit;
	}

	/**
	 * Display the HTML header
	 */
	function upgrade_head()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
		echo "<head>\n";
		echo "<title> Nucleus Upgrade </title>\n";
		
		if ( file_exists('../documentation/styles/manual.css') )
		{
			echo "<link rel=\"stylesheet\" href=\"../documentation/styles/manual.css\" type=\"text/css\" />\n";
		}
		else
		{
			echo '<style type="text/css">' . "\n";
			echo ".warning { color: red; }\n";
			echo ".ok { color: green; }\n";
			echo "</style>\n";
		}
		
		echo "</head>\n";
		echo "<body>\n";
	}


	/**
	 * Display the HTML footer
	 */
	function upgrade_foot()
	{
		echo '</body></html>';
	}


	/**
	 * Display an error page
	 * @param string $message
	 */
	function upgrade_error($message)
	{
		upgrade_head();
?>
		<h1> Error </h1>

		<p> The following message was returned: </p>
		<p> <?php echo $message?> </p>
		<p> <a href="index.php" onclick="history.back(); return false;">Go Back</a> </p>

<?php
		upgrade_foot();
		exit;
	}


	function upgrade_start()
	{
		global $upgrade_failures;
		$upgrade_failures = 0;

		upgrade_head();
?>
		<h1> Executing Upgrades </h1>

		<ul>
<?php
	}


	function upgrade_end($message = '')
	{
		global $upgrade_failures;

		$from = intGetVar('from');

		if ( $upgrade_failures > 0 )
		{
			$message = 'Some queries have failed. Try reverting to a backup or reparing things manually, then re-run this script.';
		}
?>
		</ul>

		<h1> Upgrade Completed! </h1>

		<p> <?php echo $message?> </p>

		<p> Back to the <a href="index.php?from=<?php echo $from; ?>">Upgrades Overview</a> </p>

<?php
		upgrade_foot();
		exit;
	}


	/**
	 * Executes a query, displaying the user-friendly explanation and a success / fail message. Query errors are displayed, too.
	 *
	 * @param string $friendly
	 * @param string $query
	 * @return resource (is this return necessary?)
	 */
	function upgrade_query($friendly, $query)
	{
		global $upgrade_failures;

		# output the friendly message
		echo "<li> $friendly &mdash; ";

		# execute the query
		$result = @mysql_query($query);

		// begin if: error executing query
		if ( $result === FALSE )
		{
			echo '<span class="warning"> FAILED </span> <br />';
			echo 'Error: <code>', mysql_error(), '</code>';
			$upgrade_failures++;
		}
		// else: query was successful
		else
		{
			echo '<span class="ok"> SUCCESS! </span>';
		} // end if

		echo '</li>', "\n";
		return $result;
	}


	/**
	  * Tries to update database version, gives a message when failed
	  *
	  * @param $version
	  * 	Schema version the database has been upgraded to
	  */
	function update_version($version)
	{
		global $upgrade_failures;

		$message = 'Updating DatabaseVersion in config table to ' . $version;

		// begin if: no upgrade failures; update the database version in the config table
		if ( $upgrade_failures == 0 )
		{
			$query = 'UPDATE %s SET value = "%s" WHERE name = "DatabaseVersion";';
			
			$query = sprintf($query, sql_table('config'), $version);
			upgrade_query($message, $query);
		}
		// else: display 'not executed' message
		else
		{
			echo '<li>', $message, ' &mdash; <span class="warning">NOT EXECUTED</span> Errors occurred during upgrade process. </li>';
		} // end if

	}


	/**
	 * 
	 *
	 * @param string $table table to check (without prefix)
	 * @param array $columns array of column names included
	 * @return int
	 */
	function upgrade_checkIfIndexExists($table, $columns)
	{
		// get info for indices from database
		$indices = array();

		$query = 'SHOW INDEX FROM ' . sql_table($table);
		$result = @mysql_query($query);

		// begin loop: each result object
		while ( $object = mysql_fetch_object($result) )
		{

			// begin if: key has not been added to the indeces array yet
			if ( !isset($indices[$object->Key_name]) )
			{
				$indices[$object->Key_name] = array();
			} // end if

			array_push($indices[$object->Key_name], $object->Column_name);
		}

		// compare each index with parameter
		foreach ( $indices as $key_name => $index_columns )
		{
			$diff = array_diff($index_columns, $columns);

			if ( count($diff) == 0 )
			{
				return 1;
			} // end if

		} // end loop

		return 0;
	}


	/**
	 * Checks to see if a given table exists
	 *
	 * @param string $table name of table to check existence of
	 * @return bool TRUE if table exists, FALSE otherwise.
	 */
	function upgrade_checkIfTableExists($table)
	{
		$query = 'SHOW TABLES LIKE ' . sql_table($table);
		$result = @mysql_query($query);

		// begin if: query executed successfully and one row was returned
		if ( ($result !== FALSE) && (@mysql_num_rows($result) == 1) )
		{
			return TRUE;
		}
		// else: query error or no results returned
		else
		{
			return FALSE;
		} // end if

	}


	/**
	  * Checks to see if a given configuration value exists
	  *
	  * @param string $value config value to check for existance of (paramater must be MySQL escaped already)
	  * @return bool TRUE if configuration value exists, FALSE otherwise.
	  */
	function upgrade_checkIfCVExists($value)
	{
		$query = 'SELECT name FROM ' . sql_table('config') . ' WHERE name = "' . $value . '"';
		$result = @mysql_query($query);

		// begin if: query executed successfully and one row was returned
		if ( ($result !== FALSE) && (@mysql_num_rows($result) == 1) )
		{
			return TRUE;
		}
		// else: query error or no results returned
		else
		{
			return FALSE;
		} // end if

	}


	/**
	  * Checks to see if a given column exists
	  *
	  * @param string $table name of table to check for column in
	  * @param string $column name of column to check for existance of
	  * @return bool TRUE if column exists, FALSE otherwise.
	  */
	function upgrade_checkIfColumnExists($table, $column)
	{
		$query = 'DESC ' . sql_table($table) . ' ' . $column;
		$result = @mysql_query($query);

		// begin if: query executed successfully and one row was returned
		if ( ($result !== FALSE) && (@mysql_num_rows($result) == 1) )
		{
			return TRUE;
		}
		// else: query error or no results returned
		else
		{
			return FALSE;
		} // end if

	}
