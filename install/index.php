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

if (version_compare(phpversion(), '5.5.0', '<') || 90000 <= PHP_VERSION_ID) {
    $ver = explode('.', phpversion());
    $ver = sprintf('PHP%d.%d', $ver[0], $ver[1]);
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && in_array('ja', explode(',', @strtolower((string) $_SERVER['HTTP_ACCEPT_LANGUAGE'])))) {
        exit("<h1>エラー</h1><div>このバージョンは、{$ver}に対応していません。</div>");
    }
    exit("<h1>Error</h1><div>This version does not support {$ver}.</div>");
}

define('NC_MTN_MODE', 'install');

include_once('functions.inc.php');
include_once('../nucleus/libs/phpfunctions.php');
include_once('../nucleus/libs/globalfunctions.inc.php');
include_once('../nucleus/libs/helpers.php');

define('NC_BASE_PATH', str_replace('\\', '/', dirname(__DIR__)).'/');
define('NC_SITE_URL', getSiteUrl());

define('ENABLE_SQLITE_INSTALL', 0); // allow sqlite install , boolean  PHP[7.1-] , QA test not conducted , move to v3.90dev
define('INSTALL_PRIORITY_MYSQL_MODULE', PHP_VERSION_ID <= 70000 ? 1 : 0); // mode , 0: pdo mysql , 1: mysql module
define('DEBUG_INSTALL_QUERY', 0); // debug query
define('DEBUG_INSTALL_STEPS', 0); // debug
define('NUCLEUS_INSTALL_MINIMUM_PHP_VERSION', '5.5.0'); // (string) , format : dot separated

define('ENABLE_INSTALL_LANG_EUCJP', 1); // allow Jpanase euc-jp install , boolean

$path = @preg_split('/[\?#]/', $_SERVER["REQUEST_URI"]);
$path = $path[0];
if (preg_match('#/install$#', $path)) {
    header("Location: " . $path . "/");
    exit;
}

if (DEBUG_INSTALL_QUERY) {
    global $CONF;
    $CONF = ['debug' => 1];
}

include_once('../nucleus/libs/version.php');

$install_lang_defs = get_install_lang_defs();
$install_lang_keys = get_install_lang_keys();

global $lang;
if (isset($_POST['lang'])) {
    $lang = strtolower($_POST['lang']);
} elseif (isset($_GET['lang'])) {
    $lang = strtolower($_GET['lang']);
}

if ($lang != '' && !in_array($lang, $install_lang_keys)) {
    $lang = 'en';
} elseif ($lang != '' && in_array($lang, $install_lang_keys) && is_file("./install_lang_{$lang}.php")) {
    // do nothing
} else {
    $v         = '';
    $http_lang = explode(',', @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
    foreach ($http_lang as $key) {
        if (!isset($install_lang_defs[$key])) {
            $key = substr($key, 2);
            if (!isset($install_lang_defs[$key])) {
                continue;
            }
        }
        if ($key != 'en' && in_array($key, $install_lang_keys)
                         && is_file("./install_lang_{$key}.php")) {
            $v = $lang = $key;
            break;
        }
    }
    if (!$v) {
        $lang = 'en';
    }
}

define('INSTALL_LANG', $lang);
include_once("./install_lang_{$lang}.php");

if ($lang != 'en') {
    ob_start();
    include_once("./install_lang_en.php");
    ob_end_clean();
}

// array with names of plugins to install. Plugin files must be present in the nucleus/plugin/
// directory.
//
// example:
//     array('NP_CKEditor', 'NP_Text')
$aConfPlugsToInstall = [
    'NP_SkinFiles',
//        'NP_CustomURL',
//        'NP_CKEditor',
];

// array with skins to install. skins must be present under the skins/ directory with
// a subdirectory having the same name that contains a skinbackup.xml file
//
// example:
//     array('base','rsd')
$aConfSkinsToImport = ['atom','rss2.0','rsd','default'];

/*
    -- End Of Configurable Part --
*/

// don't give warnings for uninitialized vars
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (version_compare(phpversion(), NUCLEUS_INSTALL_MINIMUM_PHP_VERSION, '<')) {
    $msg    = sprintf(_INSTALL_TEXT_ERROR_PHP_MINIMUM_REQUIREMENT, NUCLEUS_INSTALL_MINIMUM_PHP_VERSION);
    $errors = [$msg];
    showErrorMessages($errors); // exit to instalation
}

// make sure there's no unnecessary escaping:
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    set_magic_quotes_runtime(0);
}

// if there are some plugins or skins to import, do not include vars
// in globalfunctions.php again... so set a flag
if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0)) {
    global $CONF;
    $CONF['installscript'] = 1;
}

// include core classes that are needed for login & plugin handling
if (!function_exists('mysql_query')) {
    include_once('../nucleus/libs/sql/mysql_emulate.php');
} else {
    define('_EXT_MYSQL_EMULATE', 0);
}

global $DB_PHP_MODULE_NAME, $DB_DRIVER_NAME;
if (ENABLE_SQLITE_INSTALL && (postVar('install_db_type') == 'sqlite')) {
    $DB_DRIVER_NAME     = 'sqlite';
    $DB_PHP_MODULE_NAME = 'pdo';
}

//set the handler if different from mysql (or mysqli)
if (!isset($DB_DRIVER_NAME) || strlen($DB_DRIVER_NAME) == 0) {
    $mode1 = INSTALL_PRIORITY_MYSQL_MODULE && (extension_loaded('mysql') || extension_loaded('mysqli'));
    if ($mode1) {
        $DB_DRIVER_NAME = $DB_PHP_MODULE_NAME = 'mysql';
    } else {
        $DB_PHP_MODULE_NAME = 'pdo';
        $DB_DRIVER_NAME     = 'mysql';
    }
}
include_once('../nucleus/libs/sql/'.$DB_PHP_MODULE_NAME.'.php');

// check if mysql support is installed
// this check may not make sense, as is, in a version past 3.5x
if ($DB_PHP_MODULE_NAME == 'pdo') {
    if (!extension_loaded('pdo_' . $DB_DRIVER_NAME)) {
        doError(_ERROR1);
    }
} elseif (!function_exists('mysql_query')) {
    _doError(_ERROR1);
}

// check config.php, v3.80-
if (@is_file('../config.php')) {
    _doError(_INSTALL_TEXT_ERROR_CONFIG_EXIST);
}

if (postVar('action') == 'go') {
    doInstall();
} else {
    showInstallForm();
}

exit;
