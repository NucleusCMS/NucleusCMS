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

	$MYSQL_CONN = 0;

	// begin if: no mysql_* functions exist, define wrappers
	if ( !function_exists('mysql_query') )
	{

		// begin if: mysqli_query() function does not exist; no suitable MySQL library
		if ( !function_exists('mysqli_query') && function_exists('startUpError') )
		{
			startUpError(_NO_SUITABLE_MYSQL_LIBRARY);
		} // end if


		/**
		 * This function is a wrapper for mysqli_query()
		 * @param string $query
		 * @return resource|bool
		 */
		function mysql_query($query)
		{
			global $MYSQL_CONN;
			return mysqli_query($MYSQL_CONN, $query);
		}


		/**
		 * This function is a wrapper for mysqli_fetch_object
		 * @param resource $result
		 * @return object|null
		 */
		function mysql_fetch_object($result)
		{
			return mysqli_fetch_object($result);
		}


		/**
		 * This function is a wrapper for mysqli_fetch_array
		 * @param resource $result
		 * @return array|null
		 */
		function mysql_fetch_array($result)
		{
			return mysqli_fetch_array($result);
		}


		/**
		 * This function is a wrapper for mysqli_fetch_assoc
		 * @param resource $result
		 * @return array|null
		 */
		function mysql_fetch_assoc($result)
		{
			return mysqli_fetch_assoc($result);
		}


		/**
		 * This function is a wrapper for mysqli_fetch_row
		 * @param resource $result
		 * @return array|null
		 */
		function mysql_fetch_row($result)
		{
			return mysqli_fetch_row($result);
		}


		/**
		 * This function is a wrapper for mysqli_num_rows
		 * @param resource $result
		 * @return int|string
		 */
		function mysql_num_rows($result)
		{
			return mysqli_num_rows($result);
		}


		/**
		 * This function is a wrapper for mysqli_num_fields
		 * @param resource $result
		 * @return int
		 */
		function mysql_num_fields($result)
		{
			return mysqli_num_fields($result);
		}


		/**
		 * This function is a wrapper for mysqli_free_result
		 * @param resource $result
		 * @return null
		 */
		function mysql_free_result($result)
		{
			return mysqli_free_result($result);
		}


		/**
		 * This function is a wrapper for mysqli_free_result
		 * @param resource $result
		 * @return string
		 */
		function mysql_result($result, $row, $column)
		{

			// begin if: a row or column other than the initial one is selected; not implemented
			if ( ($row != 0) || ($column != 0) )
			{
				trigger_error('not implemented', E_USER_ERROR);
			} // end if

			$row = mysqli_fetch_row($result);
			return $row[$column];
		}


		/**
		 *
		 */
		function mysql_connect($host, $username, $pwd)
		{
			return mysqli_connect($host, $username, $pwd);
		}


		/**
		 *
		 */
		function mysql_error()
		{
			global $MYSQL_CONN;
			return mysqli_error($MYSQL_CONN);
		}


		/**
		 *
		 */
		function mysql_select_db($db)
		{
			global $MYSQL_CONN;
			return mysqli_select_db($MYSQL_CONN, $db);
		}


		/**
		 *
		 */
		function mysql_close()
		{
			global $MYSQL_CONN;
			return mysqli_close($MYSQL_CONN);
		}


		/**
		 *
		 */
		function mysql_insert_id()
		{
			global $MYSQL_CONN;
			return mysqli_insert_id($MYSQL_CONN);
		}


		/**
		 *
		 */
		function mysql_affected_rows()
		{
			global $MYSQL_CONN;
			return mysqli_affected_rows($MYSQL_CONN);
		}


		/**
		 *
		 */
		function mysql_real_escape_string($val)
		{
			global $MYSQL_CONN;
			return mysqli_real_escape_string($MYSQL_CONN,$val);
		}

	}



?>