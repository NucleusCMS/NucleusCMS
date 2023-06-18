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

if (version_compare(phpversion(), '8.1.0', '<') || (90000 <= PHP_VERSION_ID)) {
    $ver = explode('.', phpversion());
    $ver = sprintf('PHP%d.%d', $ver[0], $ver[1]);
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
        && in_array('ja', preg_split('/[, ]|-[^,]+|;[^,]+/', strtolower((string) $_SERVER['HTTP_ACCEPT_LANGUAGE']), -1, PREG_SPLIT_NO_EMPTY))
    ) {
        exit("<h1>エラー</h1><div>このバージョンは、{$ver}に対応していません。</div>");
    }
    exit("<h1>Error</h1><div>This version does not support {$ver}.</div>");
}

define('INSTALL_EXPIRE_SEC', 30 * 60); // 30 minutes

define('NC_MTN_MODE', 'install');

include_once('functions.inc.php');
include_once('../nucleus/libs/version.php');
include_once('../nucleus/libs/phpfunctions.php');
include_once('../nucleus/libs/globalfunctions.inc.php');
include_once('../nucleus/libs/helpers.php');

define('NC_BASE_PATH', str_replace('\\', '/', dirname(__DIR__)).'/');
define('NC_SITE_URL', getSiteUrl());

define('ENABLE_SQLITE_INSTALL', NUCLEUS_DEVELOP || @is_file('ENABLE_SQLITE_INSTALL')); // allow sqlite install , boolean , QA test not conducted
define('DEBUG_INSTALL_QUERY', 0); // debug query
define('DEBUG_INSTALL_STEPS', 0); // debug
define('NUCLEUS_INSTALL_MINIMUM_PHP_VERSION', '8.1.0'); // (string) , format : dot separated

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

$install_lang_defs = get_install_lang_defs();
$install_lang_keys = get_install_lang_keys();

global $lang;
if (isset($_POST['lang'])) {
    $lang = strtolower($_POST['lang']);
} elseif (isset($_GET['lang'])) {
    $lang = strtolower($_GET['lang']);
}

if ('' != $lang && ! in_array($lang, $install_lang_keys)) {
    $lang = 'en';
} elseif ('' != $lang && in_array($lang, $install_lang_keys) && is_file("./install_lang_{$lang}.php")) {
    // do nothing
} else {
    $v         = '';
    $http_lang = get_http_accept_primary_languages();
    foreach ($http_lang as $key) {
        if ( ! isset($install_lang_defs[$key])) {
            continue;
        }
        if ('en' != $key && in_array($key, $install_lang_keys)
                         && is_file("./install_lang_{$key}.php")) {
            $v = $lang = $key;
            break;
        }
    }
    if ( ! $v) {
        $lang = 'en';
    }
}

define('INSTALL_LANG', $lang);
include_once("./install_lang_{$lang}.php");

if ('en' != $lang) {
    ob_start();
    include_once("./install_lang_en.php");
    ob_end_clean();
}

// array with names of plugins to install. Plugin files must be present in the nucleus/plugin/
// directory.
//
$aConfPlugsToInstall = [
//    'NP_SkinFiles',
//    'NP_CKEditor',
//    'NP_CustomURL',
];

// array with skins to install. skins must be present under the skins/ directory with
// a subdirectory having the same name that contains a skinbackup.xml file
//
// example:
//     array('base','rsd')
$aConfSkinsToImport = ['atom','rss2.0','rsd','classic'];

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

// if there are some plugins or skins to import, do not include vars
// in globalfunctions.php again... so set a flag
if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0)) {
    global $CONF;
    $CONF['installscript'] = 1;
}

// include core classes that are needed for login & plugin handling
define('_EXT_MYSQL_EMULATE', 0);

global $DB_PHP_MODULE_NAME, $DB_DRIVER_NAME;
$DB_PHP_MODULE_NAME = 'pdo';

// sqlite
if (ENABLE_SQLITE_INSTALL && ('sqlite' == postVar('install_db_type'))) {
    $DB_DRIVER_NAME = 'sqlite';
}

//set the handler if different from mysql (or mysqli)
if ( ! isset($DB_DRIVER_NAME) || 0 == strlen($DB_DRIVER_NAME)) {
    $DB_DRIVER_NAME = 'mysql';
}
include_once('../nucleus/libs/sql/pdo.php');

// check if mysql support is installed
// this check may not make sense, as is, in a version past 3.5x
if ( ! extension_loaded('pdo_' . $DB_DRIVER_NAME)) {
    doError(_ERROR1);
}

// check config.php, v3.80-
if (@is_file('../config.php')) {
    _doError(_INSTALL_TEXT_ERROR_CONFIG_EXIST);
}

if ( ! @file_exists(__DIR__ . '/install-config.php')) {
    _doError(_INSTALL_TEXT_ERROR_INSTALLATION_NO_CONFIG_FILE);
} else {
    // basic auth
    // $INSTALL_AUTH_USER, $INSTALL_AUTH_PW
    include_once(__DIR__ . '/install-config.php');
    if (( ! isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
        || ( ! isset($INSTALL_AUTH_USER, $INSTALL_AUTH_PW))
        || (empty(trim($INSTALL_AUTH_USER)) || empty(trim($INSTALL_AUTH_PW)))
        || ($_SERVER['PHP_AUTH_USER'] !== $INSTALL_AUTH_USER)
        || ($_SERVER['PHP_AUTH_PW'] !== $INSTALL_AUTH_PW)
    ) {
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        _doError(_INSTALL_TEXT_ERROR_INSTALLATION_AUTH_FAILED);
    }
}

$mtime = @filemtime(__DIR__ . '/install-config.php');
if ( ! $mtime || ($mtime + INSTALL_EXPIRE_SEC < time())) {
    _doError(_INSTALL_TEXT_ERROR_INSTALLATION_EXPIRED);
}

if ('go' == postVar('action')) {
    doInstall();
} else {
    showInstallForm();
}

exit;
