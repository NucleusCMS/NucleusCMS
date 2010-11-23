<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id$
 */
 
/*
 * if no mysql_* functions exist, define wrappers
 */
 
$MYSQL_CONN = 0;

if (!function_exists('mysql_query'))
{
	if (!function_exists('mysqli_query') && function_exists('startUpError'))
	{
		startUpError(_NO_SUITABLE_MYSQL_LIBRARY);
	}
	
	function mysql_query($query) 
	{
		global $MYSQL_CONN;
		return mysqli_query($MYSQL_CONN, $query); 
	}
	
	function mysql_fetch_object($res) 
	{ 
		return mysqli_fetch_object($res);
	}
	
	function mysql_fetch_array($res) 
	{ 
		return mysqli_fetch_array($res);
	}	
	
	function mysql_fetch_assoc($res) 
	{ 
		return mysqli_fetch_assoc($res);
	}	

	function mysql_fetch_row($res) 
	{ 
		return mysqli_fetch_row($res);
	}	

	function mysql_num_rows($res)
	{
		return mysqli_num_rows($res);
	}
	
	function mysql_num_fields($res)
	{
		return mysqli_num_fields($res);
	}
	
	function mysql_free_result($res)
	{
		return mysqli_free_result($res);
	}
	
	function mysql_result($res, $row, $col) 
	{ 
		if (($row != 0) || ($col != 0)) {
			trigger_error('not implemented', E_USER_ERROR);
		}
		
		$row = mysqli_fetch_row($res);
		return $row[$col];
	}	
	
	function mysql_connect($host, $username, $pwd)
	{
		return mysqli_connect($host, $username, $pwd);
	}
	
	function mysql_error()
	{
		global $MYSQL_CONN;
		return mysqli_error($MYSQL_CONN);
	}
	
	function mysql_select_db($db)
	{
		global $MYSQL_CONN;
		return mysqli_select_db($MYSQL_CONN, $db);
	}
	
	function mysql_close()
	{
		global $MYSQL_CONN;
		return mysqli_close($MYSQL_CONN);
	}
	
	function mysql_insert_id()
	{
		global $MYSQL_CONN;
		return mysqli_insert_id($MYSQL_CONN);
	}
	
	function mysql_affected_rows()
	{
		global $MYSQL_CONN;
		return mysqli_affected_rows($MYSQL_CONN);
	}
	
	function mysql_real_escape_string($val)
	{
		global $MYSQL_CONN;
		return mysqli_real_escape_string($MYSQL_CONN,$val);
	}
}



?>