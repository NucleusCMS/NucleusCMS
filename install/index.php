<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2020 The Nucleus Group
 *
 * lastedit: yotaca at 20200720
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

define('NC_BASE_PATH', str_replace(array('\\', 'install'), array('/', ''), __DIR__));
define('NC_SITE_URL', getSiteUrl());

$allow_sqlite = extension_loaded('PDO_SQLITE') && version_compare('7.1.0', PHP_VERSION, '<=');
define('ENABLE_SQLITE_INSTALL', ($allow_sqlite ? 1 : 0)); // allow sqlite install , boolean
define('INSTALL_PRIORITY_MYSQL_MODULE', 1); // mode , 0: pdo mysql , 1: mysql module
define('DEBUG_INSTALL_QUERY', 0); // debug query
define('DEBUG_INSTALL_STEPS', 0); // debug
define('NUCLEUS_INSTALL_MINIMUM_PHP_VERSION', '5.0.5'); // (string) , format : dot separated

define('ENABLE_INSTALL_LANG_EUCJP', 1); // allow Jpanase euc-jp install , boolean

$path = @preg_split('/[?#]/', $_SERVER["REQUEST_URI"]);
$path = $path[0];
if (preg_match('#/install$#', $path)) {
    header("Location: " . $path . "/");
    exit;
}

if (DEBUG_INSTALL_QUERY) {
    global $CONF;
    $CONF = array('debug' => 1);
}

include_once('../nucleus/libs/version.php');

$install_lang_defs = get_install_lang_defs();
$install_lang_keys = get_install_lang_keys();

global $lang;
if (isset($_REQUEST['lang'])) {
    $lang = strtolower($_REQUEST['lang']);
}

if (!$lang) {
    $v = '';
    $http_lang = explode('-', @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));

    foreach ($http_lang as $key) {
        if (!isset($install_lang_defs[$key])) {
            $key = substr($key, 2);
            if (!isset($install_lang_defs[$key])) {
                continue;
            }
        }
        if ($key !== 'en' && in_array($key, $install_lang_keys) && is_file("./install_lang_${key}.php")) {
            $v = $lang = $key;
            break;
        }
    }
    if (!$v) {
        $lang = 'en';
    }
}

define('INSTALL_LANG', $lang);
include_once(sprintf('./install_lang_%s.php', $lang));

$aConfPlugsToInstall = array(
    'NP_SkinFiles',
);

$aConfSkinsToImport = array('atom', 'rss2.0', 'rsd', 'default');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (version_compare(PHP_VERSION, NUCLEUS_INSTALL_MINIMUM_PHP_VERSION, '<')) {
    $msg = sprintf(_INSTALL_TEXT_ERROR_PHP_MINIMUM_REQUIREMENT, NUCLEUS_INSTALL_MINIMUM_PHP_VERSION);
    $errors = array($msg);
    showErrorMessages($errors); // exit to instalation
}

if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0)) {
    global $CONF;
    $CONF['installscript'] = 1;
}

if (!function_exists('mysql_query')) {
    include_once('../nucleus/libs/sql/mysql_emulate.php');
} else {
    define('_EXT_MYSQL_EMULATE', 0);
}

global $DB_PHP_MODULE_NAME, $DB_DRIVER_NAME;
if (ENABLE_SQLITE_INSTALL && (postVar('install_db_type') === 'sqlite')) {
    $DB_DRIVER_NAME = 'sqlite';
    $DB_PHP_MODULE_NAME = 'pdo';
}

//set the handler if different from mysql (or mysqli)
if (!isset($DB_DRIVER_NAME) || strlen($DB_DRIVER_NAME) === 0) {
    $mode1 = INSTALL_PRIORITY_MYSQL_MODULE && (extension_loaded('mysql') || extension_loaded('mysqli'));
    if ($mode1) {
        $DB_DRIVER_NAME = $DB_PHP_MODULE_NAME = 'mysql';
    } else {
        $DB_PHP_MODULE_NAME = 'pdo';
        $DB_DRIVER_NAME = 'mysql';
    }
}
include_once(sprintf('../nucleus/libs/sql/%s.php', $DB_PHP_MODULE_NAME));

// check if mysql support is installed
// this check may not make sense, as is, in a version past 3.5x
if ($DB_PHP_MODULE_NAME === 'pdo') {
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

if (postVar('action') === 'go') {
    doInstall();
} else {
    showInstallForm();
}
exit;

function _doError($msg)
{
    global $lang;
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex,nofollow,noarchive">
        <title><?php echo _TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="../nucleus/styles/manual.css"/>
    </head>
    <body>
    <div style="text-align:center">
        <img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>"/>
    </div>
    <h1><?php echo _ERROR27; ?></h1>
    <p>
        <?php echo _ERROR28; ?>
    </p>
    <div style="color: #ff0000; border-color: #c0dcc0; border-style:dotted ">
        <?php echo $msg; ?>
    </div>
    <p>
        <a href="index.php" onclick="history.back();return false;">
            <?php echo _TEXT17; ?>
        </a>
    </p>
    </body>
    </html>

    <?php
    exit;
}

function showErrorMessages($errors)
{
    global $lang;
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex,nofollow,noarchive">
        <title><?php echo _TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="../nucleus/styles/manual.css"/>
    </head>
    <body>
    <div style="text-align:center">
        <img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>"/>
    </div>
    <h1><?php echo _ERROR27; ?></h1>
    <p>
        <?php echo _ERROR29; ?>:
    </p>
    <ul>
        <?php
        while ($msg = array_shift($errors)) {
            echo '<li>' . $msg . '</li>';
        }
        ?>
    </ul>
    <p>
        <a href="index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a>
    </p>
    </body>
    </html>

    <?php
    exit;
}
