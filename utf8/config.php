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
 * Nucleus configration file
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

// This file contains variables with the locations of the data dirs
// and basic functions that every page can use

// mySQL connection information
$MYSQL_HOST     = 'hostname';
$MYSQL_USER     = 'username';
$MYSQL_PASSWORD = 'password';
$MYSQL_DATABASE = 'databasename';
$MYSQL_PREFIX   = '';
// new in 3.50. first element is db handler, the second is the db driver used by the handler
// default is $MYSQL_HANDLER = array('mysql','mysql');
$MYSQL_HANDLER = array('mysql','mysql');
//$MYSQL_HANDLER = array('pdo','mysql');

// main nucleus directory
$DIR_NUCLEUS = '/your/path/to/nucleus/';

// media dir
$DIR_MEDIA   = '/your/path/to/media/';

// extra skin files for imported skins
$DIR_SKINS   = '/your/path/to/skins/';

// these dirs are normally subdirs of the nucleus dir, but
// you can redefine them if you wish
$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
$DIR_LANG    = $DIR_NUCLEUS . 'language/';
$DIR_LIBS    = $DIR_NUCLEUS . 'libs/';

if (!@file_exists($DIR_LIBS . 'globalfunctions.php')) {
	echo 'Configuration error, please run the <a href="install.php">install script</a> or modify config.php';
	exit;
}

// include libs
include($DIR_LIBS.'globalfunctions.php');
if (!extension_loaded('mbstring')) {
	include($DIR_LIBS.'mb_emulator/mb-emulator.php');
}
?>