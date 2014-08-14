<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * This script will install the Nucleus tables in your SQL-database,
 * and initialize the data in those tables.
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

include_once('setting.values.inc.php');
include_once('functions.inc.php');
include_once('ParamManager.class.inc.php');

/* global values initialize */
$CONF = array();

/* reporting all errors for support */
error_reporting(E_ALL);

if ( version_compare(PHP_VERSION, $minimum_php_version, '<') )
	exit('<div style="font-size: xx-large;"> Nucleus requires at least PHP version ' . $minimum_php_version . '</div>');
elseif ( version_compare(PHP_VERSION, '5.3.0', '<') )
	ini_set('magic_quotes_runtime', '0');

// Check if some important files
do_check_files();

/* i18n class is needed for internationalization */
include_once('../nucleus/libs/i18n.php');
if ( !i18n::init('UTF-8', '../nucleus/locales') )
{
	$str = 'Failed to initialize iconv or mbstring extension. Would you please contact the administrator of your PHP server?';
	$str = '<div style="font-size: xx-large;"> ' . $str . ' </div>';
	exit($str);
}

// include core classes that are needed for login & plugin handling

// added for 3.5 sql_* wrapper
global $MYSQL_HANDLER;

if ( !isset($MYSQL_HANDLER) )
{
	$MYSQL_HANDLER = array('mysql', '');
	// check if mysql support is installed; this check may not make sense, as is, in a version past 3.5x
	if ( !function_exists('mysql_query') && !function_exists('mysqli_query') )
		exit('<div style="font-size: xx-large;"> Your PHP version does not have support for MySQL :( </div>');
}
include_once('../nucleus/libs/sql/sql.php');

session_start();
if ( count($_GET) == 0 && count($_POST) == 0 )
	unset($_SESSION['param_manager']);

// restore the $param from the session
if ( array_key_exists('param_manager', $_SESSION) )
	$param = $_SESSION['param_manager'];
else
	$param = new ParamManager();

// include translation file
$param->set_locale();

do_action();

// $param is saved to the session
if ( isset($param) )
	$_SESSION['param_manager'] = $param;
else
	unset($_SESSION['param_manager']);

exit;
