<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2016 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 * 
 * This script will install the Nucleus tables in your SQL-database, 
 * and initialize the data in those tables.
 *
 * Below is a friendly way of letting users on non-php systems know that Nucleus won't run there.
 * ?><div style="font-size: xx-large;">If you see this text in your browser when you open <i>/install/</i>, your web server is not able to run PHP-scripts, and therefor Nucleus will not be able to run there. </div><div style="display: none"><?php
 */

/*
	This part of the index.php code allows for customization of the install process.
	When distributing plugins or skins together with a Nucleus installation, the
	configuration below will instruct to install them

	-- Start Of Configurable Part --
*/
define('NC_MTN_MODE', 'install');

include_once('functions.inc.php');
include_once('../nucleus/libs/globalfunctions.inc.php');
include_once('../nucleus/libs/vars4.1.0.php');

define('NC_BASE_PATH', str_replace(array('\\','install'), array('/',''), dirname(__FILE__)));
define('NC_SITE_URL', getSiteUrl());

define('ENABLE_SQLITE_INSTALL', ( !extension_loaded('PDO_SQLITE') ? 0 : 1) ); // allow sqlite install , boolean
define('INSTALL_PRIORITY_MYSQL_MODULE', 1); // mode , 0: pdo mysql , 1: mysql module
define('DEBUG_INSTALL_QUERY', 0); // debug query
define('DEBUG_INSTALL_STEPS', 0); // debug

define('ENABLE_INSTALL_LANG_EUCJP', 1); // allow Jpanase euc-jp install , boolean

$path = @preg_split('/[\?#]/', $_SERVER["REQUEST_URI"]);
$path = $path[0];
if (preg_match('#/install$#', $path))
{
    header("Location: " . $path . "/");
    exit;
}

if (DEBUG_INSTALL_QUERY)
    { global $CONF; $CONF=array('debug'=>1); }

include_once('../nucleus/libs/version.php');

$install_lang_defs = get_install_lang_defs();
$install_lang_keys = get_install_lang_keys();

global $lang;
if (isset($_POST['lang']))
	$lang = strtolower( $_POST['lang'] );
else if (isset($_GET['lang']))
	$lang = strtolower( $_GET['lang'] );

if ($lang != '' && !in_array($lang, $install_lang_keys))
    $lang = 'en';
else if ($lang != '' && in_array($lang, $install_lang_keys) && is_file("./install_lang_${lang}.php"))
{
   // do nothing
}
else
{
    $v = '';
    $http_lang = explode(',', @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
    foreach($http_lang as $key)
    {
        if (!isset($install_lang_defs[$key]))
        {
            $key = substr($key, 2);
            if (!isset($install_lang_defs[$key]))
                continue;
        }
        if ($key != 'en' && in_array($key, $install_lang_keys)
                         && is_file("./install_lang_${key}.php") )
           {  $v = $lang = $key; break; }
    }
    if (!$v)
       $lang = 'en';
}

	define('INSTALL_LANG' , $lang);
	include_once("./install_lang_${lang}.php");

    if ($lang != 'en')
    {
        ob_start();
        include_once("./install_lang_en.php");
        ob_end_clean();
    }

// array with names of plugins to install. Plugin files must be present in the nucleus/plugin/
// directory.
//
// example:
//     array('NP_CKEditor', 'NP_Text')
$aConfPlugsToInstall = array(
	'NP_SkinFiles',
//        'NP_CustomURL',
//        'NP_CKEditor',
);


// array with skins to install. skins must be present under the skins/ directory with
// a subdirectory having the same name that contains a skinbackup.xml file
//
// example:
//     array('base','rsd')
$aConfSkinsToImport = array('atom','rss2.0','rsd','default');

/*
	-- End Of Configurable Part --
*/

// don't give warnings for uninitialized vars
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (version_compare(phpversion(), '5.0.5', '<')) {
    $errors = array(_INSTALL_TEXT_ERROR_PHP_MINIMUM_REQUIREMENT);
    showErrorMessages($errors); // exit to instalation
}

// make sure there's no unnecessary escaping:
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    set_magic_quotes_runtime(0);
}

// if there are some plugins or skins to import, do not include vars
// in globalfunctions.php again... so set a flag
if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0) ) {
	global $CONF;
	$CONF['installscript'] = 1;
}


// include core classes that are needed for login & plugin handling
if (!function_exists('mysql_query')) include_once('../nucleus/libs/sql/mysql_emulate.php');
else                                 define('_EXT_MYSQL_EMULATE' , 0);

global $DB_PHP_MODULE_NAME, $DB_DRIVER_NAME;
if ( ENABLE_SQLITE_INSTALL && (postVar('install_db_type') == 'sqlite')) {
    $DB_DRIVER_NAME = 'sqlite';
    $DB_PHP_MODULE_NAME = 'pdo';
}

//set the handler if different from mysql (or mysqli)
if (!isset($DB_DRIVER_NAME) || strlen($DB_DRIVER_NAME)==0) {
    $mode1 = INSTALL_PRIORITY_MYSQL_MODULE && (extension_loaded('mysql') || extension_loaded('mysqli'));
    if ($mode1) {
        $DB_DRIVER_NAME = $DB_PHP_MODULE_NAME = 'mysql';
	} else {
        $DB_PHP_MODULE_NAME = 'pdo';
        $DB_DRIVER_NAME = 'mysql';
	}
}
include_once('../nucleus/libs/sql/'.$DB_PHP_MODULE_NAME.'.php');

// check if mysql support is installed
// this check may not make sense, as is, in a version past 3.5x
if ($DB_PHP_MODULE_NAME == 'pdo') {
	if (!extension_loaded('pdo_' . $DB_DRIVER_NAME)) doError(_ERROR1);
}
elseif (!function_exists('mysql_query') ) _doError(_ERROR1);

// check config.php, v3.80-
if (@is_file('../config.php')) {
    _doError(_INSTALL_TEXT_ERROR_CONFIG_EXIST);
}

if (postVar('action') == 'go') doInstall();
else                           showInstallForm();

exit;



/*
 * Shows error message
 * 
 * @param	$msg
 * 			error message
 */
function _doError($msg) {
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noindex,nofollow,noarchive" />
	<title><?php echo _TITLE; ?></title>
	<style>@import url('../nucleus/styles/manual.css');</style>
</head>
<body>
	<div style="text-align:center"><img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>" /></div> <!-- Nucleus logo -->
	<h1><?php echo _ERROR27; ?></h1>

    <p><?php echo _ERROR28; ?></p>
    <div style="color: #ff0000; border-color: #c0dcc0; border-style:dotted "><?php echo $msg; ?></div>

	<p><a href="index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a></p>
</body>
</html>

<?php
	exit;
}

/*
 * Shows error messages
 * 
 * @param	$errors
 * 			array with error messages
 */
function showErrorMessages($errors) {
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noindex,nofollow,noarchive" />
	<title><?php echo _TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="../nucleus/styles/manual.css" />
</head>
<body>
	<div style="text-align:center"><img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>" /></div> <!-- Nucleus logo -->
	<h1><?php echo _ERROR27; ?></h1>

	<p><?php echo _ERROR29; ?>:</p>

	<ul>

<?php
	while($msg = array_shift($errors) ) {
		echo '<li>' . $msg . '</li>';
	}
?>

	</ul>

	<p><a href="index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a></p>
</body>
</html>

<?php
	exit;
}
