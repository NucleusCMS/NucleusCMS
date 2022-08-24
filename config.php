<?php

// This file contains variables with the locations of the data dirs
// and basic functions that every page can use

// mySQL connection information
$MYSQL_HOST     = 'hostname';
$MYSQL_USER     = 'username';
$MYSQL_PASSWORD = 'password';
$MYSQL_DATABASE = 'databasename';
$MYSQL_PREFIX   = '';

// new in 3.50. first element is db handler, the second is the db driver used by the handler
// default is $MYSQL_HANDLER = array('mysql','');
//$MYSQL_HANDLER = array('mysql','');
//$MYSQL_HANDLER = array('pdo','mysql');
$MYSQL_HANDLER = array('mysql','');

// main nucleus directory
$DIR_BASE = dirname(__FILE__) . '/';

$DIR_NUCLEUS = '/your/path/to/nucleus/';
//$DIR_NUCLEUS = $DIR_BASE . 'nucleus/';

// media dir
//$DIR_MEDIA = '/your/path/to/media/';
$DIR_MEDIA = $DIR_BASE . 'media/';

// extra skin files for imported skins
//$DIR_SKINS = '/your/path/to/skins/';
$DIR_SKINS = $DIR_BASE . 'skins/';

// these dirs are normally subdirs of the nucleus dir, but
// you can redefine them if you wish
$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
$DIR_LANG    = $DIR_NUCLEUS . 'language/';
$DIR_LIBS    = $DIR_NUCLEUS . 'libs/';

if (!isset($DIR_NUCLEUS)
    || ($DIR_NUCLEUS === '/your/path/to/nucleus/')
    || !@is_file($DIR_LIBS . 'globalfunctions.php')) {
    foreach (array($DIR_LIBS , dirname(__FILE__).'/nucleus/libs/') as $path) {
        if (@is_file($path.'config-error.php')) {
            @include($path.'config-error.php');
        }
    }
    header('Content-type: text/html; charset=utf-8');
    echo '<h1>Configuration error</h1>';
    echo '<p>please run the <a href="./install/index.php">install script</a> or modify config.php</p>';
    exit;
}

// include libs
include($DIR_LIBS.'globalfunctions.php');
