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
	 * Some functions common to all upgrade scripts
	 *
	 * @license http://nucleuscms.org/license.txt GNU General Public License
	 * @copyright Copyright (C) 2002-2009 The Nucleus Group
	 * @version $Id$
	 */
	 
/*************************************************************
 *     NOTE: With upgrade to 3.6, need to set this to use sql_* API           *
 **************************************************************/

	include('../../config.php');

	// sql_table function did not exists in nucleus <= 2.0
	if (!function_exists('sql_table'))
	{
		function sql_table($name) {
			return 'nucleus_' . $name;
		}
	}

	//intGetVar did not exist in very early versions
	if (!function_exists('intGetVar')) {
		function intGetVar($name) {
			if (defined($_GET)) {
				return intval($_GET[$name]);
			} else {
				global $HTTP_GET_VARS;
				return intval($HTTP_GET_VARS[$name]);
			}
		}
	}

	function upgrade_checkinstall($version) {
		$installed = 0;

		switch($version) {
			case '95':
				$query = 'SELECT bconvertbreaks FROM '.sql_table('blog').' LIMIT 1';
				$minrows = -1;
				break;
			case '96':
				$query = 'SELECT cip FROM '.sql_table('comment').' LIMIT 1';
				$minrows = -1;
				break;
			case '100':
				$query = 'SELECT mcookiekey FROM '.sql_table('member').' LIMIT 1';
				$minrows = -1;
				break;
			case '110':
				$query = 'SELECT bnotifytype FROM '.sql_table('blog').' LIMIT 1';
				$minrows = -1;
				break;
			case '150':
				$query = 'SELECT * FROM '.sql_table('plugin_option').' LIMIT 1';
				$minrows = -1;
				break;
			case '200':
				$query = 'SELECT sdincpref FROM '.sql_table('skin_desc').' LIMIT 1';
				$minrows = -1;
				break;
			// dev only (v2.2)
			case '220':
				$query = 'SELECT oid FROM '.sql_table('plugin_option_desc').' LIMIT 1';
				$minrows = -1;
				break;
			// v2.5 beta
			case '240':
				$query = 'SELECT bincludesearch FROM ' . sql_table('blog') . ' LIMIT 1';
				$minrows = -1;
				break;
			case '250':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 250 LIMIT 1';
				$minrows = 1;
				break;
			case '300':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 300 LIMIT 1';
				$minrows = 1;
				break;
			case '310':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 310 LIMIT 1';
				$minrows = 1;
				break;
			case '320':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 320 LIMIT 1';
				$minrows = 1;
				break;
			case '330':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 330 LIMIT 1';
				$minrows = 1;
				break;
			case '340':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 340 LIMIT 1';
				$minrows = 1;
				break;
			case '350':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 350 LIMIT 1';
				$minrows = 1;
				break;
			case '360':
				$query = 'SELECT * FROM '.sql_table('config').' WHERE name=\'DatabaseVersion\' and value >= 360 LIMIT 1';
				$minrows = 1;
				break;
		}

		$res = mysql_query($query);
		$installed = ($res != 0) && (mysql_num_rows($res) >= $minrows);

		return $installed;
	}


	/** this function gets the nucleus version, even if the getNucleusVersion
	 * function does not exist yet
	 * return 96 for all versions < 100
	 */
	function upgrade_getNucleusVersion() {
		if (!function_exists('getNucleusVersion')) return 96;
		return getNucleusVersion();
	}

	function upgrade_showLogin($type) {
		upgrade_head();
	?>
		<h1>Please Log in First</h1>
		<p>Enter your data below:</p>

		<form method="post" action="<?php echo $type?>">

			<ul>
				<li>Name: <input name="login" /></li>
				<li>Password <input name="password" type="password" /></li>
			</ul>

			<p>
				<input name="action" value="login" type="hidden" />
				<input type="submit" value="Log in" />
			</p>

		</form>
	<?php		upgrade_foot();
		exit;
	}

	function upgrade_head() {
	?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>Nucleus Upgrade</title>
<?php if (file_exists("../styles/manual.css")) { ?>
				<link rel="stylesheet" href="../styles/manual.css" type="text/css" />
<?php }else{ ?>
				<style type="text/css"><!--
					.warning {
						color: red;
					}
					.ok {
						color: green;
					}
				--></style>
<?php } ?>
			</head>
			<body>
	<?php	}

	function upgrade_foot() {
	?>
			</body>
			</html>
	<?php	}

	function upgrade_error($msg) {
		upgrade_head();
		?>
		<h1>Error!</h1>

		<p>Message was:</p>

		<blockquote><div>
		<?php echo $msg?>
		</div></blockquote>

		<p><a href="index.php" onclick="history.back();">Go Back</a></p>
		<?php
		upgrade_foot();
		exit;
	}


	function upgrade_start() {
		global $upgrade_failures;
		$upgrade_failures = 0;

		upgrade_head();
		?>
		<h1>Executing Upgrades</h1>
		<ul>
		<?php	}

	function upgrade_end($msg = "") {
		global $upgrade_failures;
		$from = intGetVar('from');
		if ($upgrade_failures > 0)
			$msg = "Some queries have failed. Try reverting to a backup or reparing things manually, then rerun this script.";

		?>
		</ul>

		<h1>Upgrade Completed!</h1>

		<p><?php echo $msg?></p>

		<p>Back to the <a href="index.php?from=<?php echo $from; ?>">Upgrades Overview</a></p>

		<?php
		upgrade_foot();
		exit;
	}

	/**
	  * Tries to execute a query, gives a message when failed
	  *
	  * @param friendly name
	  * @param query
	  */
	function upgrade_query($friendly, $query) {
		global $upgrade_failures;

		echo "<li>$friendly ... ";
		$res = mysql_query($query);
		if (!$res) {
			echo "<span class='warning'>FAILED</span>\n";
			echo "<blockquote>Error was: " . mysql_error() . " </blockquote>";
			$upgrade_failures++;
		} else {
			echo "<span class='ok'>SUCCESS!</span><br />\n";
		}
		echo "</li>";
		return $res;
	}

	/**
	  * Tries to update database version, gives a message when failed
	  *
	  * @param $version
	  * 	Schema version the database has been upgraded to
	  */
	function update_version($version) {
		global $upgrade_failures;
		$message='Updating DatabaseVersion in config table to '.$version;
		if(0==$upgrade_failures){
			$query = 'UPDATE ' . sql_table('config') . ' set value=\''.$version.'\' where name=\'DatabaseVersion\'';
			upgrade_query($message, $query);
		}else
			echo '<li>'.$message.' ... <span class="warning">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>';
	}

	/**
	 * @param $table
	 *		table to check (without prefix)
	 * @param $aColumns
	 *		array of column names included
	 */
	function upgrade_checkIfIndexExists($table, $aColumns) {
		// get info for indices from database

		$aIndices = array();
		$query = 'show index from ' . sql_table($table);
		$res = mysql_query($query);
		while ($o = mysql_fetch_object($res)) {
			if (!$aIndices[$o->Key_name]) {
				$aIndices[$o->Key_name] = array();
			}
			array_push($aIndices[$o->Key_name], $o->Column_name);
		}

		// compare each index with parameter
		foreach ($aIndices as $keyName => $aIndexColumns) {
			$aDiff = array_diff($aIndexColumns, $aColumns);
			if (count($aDiff) == 0) return 1;
		}

		return 0;

	}

	/**
	  * Checks to see if a given table exists
	  *
	  * @param $table
	  * 	Name of table to check for existance of
	  * 	Uses sql_table internally
	  * @return true if table exists, false otherwise.
	  */
	function upgrade_checkIfTableExists($table){
		$query = 'SHOW TABLES LIKE \''.sql_table($table).'\'';
		$res = mysql_query($query);
		return ($res != 0) && (mysql_num_rows($res) == 1);
	}

	/**
	  * Checks to see if a given configuration value exists
	  *
	  * @param $value
	  * 	Config value to check for existance of.
	  * 	Paramater must be MySQL escaped
	  * @return true if configuration value exists, false otherwise.
	  */
	function upgrade_checkIfCVExists($value){
		$query = 'SELECT name from '.sql_table('config').' WHERE name = \''.$value.'\'';
		$res = mysql_query($query);
		return ($res != 0) && (mysql_num_rows($res) == 1);
	}

	/**
	  * Checks to see if a given column exists
	  *
	  * @param $table
	  * 	Name of table to check for column in
	  * 	Uses sql_table internally
	  * @param $col
	  * 	Name of column to check for existance of
	  * @return true if column exists, false otherwise.
	  */
	function upgrade_checkIfColumnExists($table, $col){
		$query = 'DESC `'.sql_table($table).'` `'.$col.'`';
		$res = mysql_query($query);
		return ($res != 0) && (mysql_num_rows($res) == 1);
	}
?>