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
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group

 */

if(!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);    // (PHP 5.4-) : $_SERVER['REQUEST_TIME_FLOAT']
}
global $StartTime;
$StartTime = $_SERVER['REQUEST_TIME_FLOAT'];

global $DIR_NUCLEUS, $DIR_LIBS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG;

define('NC_CORE_PATH',    $DIR_NUCLEUS);
define('NC_LIBS_PATH',    $DIR_LIBS);
define('NC_MEDIA_PATH',   $DIR_MEDIA);
define('NC_SKINS_PATH',   $DIR_SKINS);
define('NC_PLUGINS_PATH', $DIR_PLUGINS);
define('NC_LOCALE_PATH',  $DIR_LANG);

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $manager, $member;

//if(is_file(NC_CORE_PATH.'autoload.php')) include_once(NC_CORE_PATH.'autoload.php');

define('HAS_CATCH_ERROR', version_compare('7.0.0',PHP_VERSION,'<='));

include_once(NC_LIBS_PATH. 'version.php');
include_once(NC_LIBS_PATH. 'globalfunctions.inc.php');

if (version_compare(phpversion(),'5.4.0','<')) {
    _checkEnv();
}

define('CORE_APPLICATION_NAME',                'Nucleus CMS'); // if you forked product, you can easy to change cms name.
define('CORE_APPLICATION_VERSION',             NUCLEUS_VERSION);
define('CORE_APPLICATION_VERSION_ID',          NUCLEUS_VERSION_ID);
define('CORE_APPLICATION_DATABASE_VERSION_ID', NUCLEUS_DATABASE_VERSION_ID);
$nucleus['version'] = 'v'.NUCLEUS_VERSION;
$nucleus['codename'] = (defined('NUCLEUS_DEVELOP') && constant('NUCLEUS_DEVELOP') ?  'dev' : '');

_setDefaultUa();
_setErrorReporting();
_setTimezone();

setDefaultConf();

if (getNucleusPatchLevel() > 0) {
    $nucleus['version'] .= '/' . getNucleusPatchLevel();
}

// we will use postVar, getVar, ... methods instead of _GET
if ($CONF['installscript'] != 1) { // vars were already included in install.php
    include_once(NC_LIBS_PATH . 'vars4.1.0.php');
}

// sanitize option
$bLoggingSanitizedResult=0;
$bSanitizeAndContinue=0;

$orgRequestURI = serverVar('REQUEST_URI');
sanitizeParams();

// get all variables that can come from the request and put them in the global scope
$blogid       = requestVar('blogid');
$itemid       = intRequestVar('itemid');
$catid        = intRequestVar('catid');
$skinid       = requestVar('skinid');
$memberid     = requestVar('memberid');
$archivelist  = requestVar('archivelist');
$imagepopup   = requestVar('imagepopup');
$archive      = requestVar('archive');
$query        = requestVar('query');
$highlight    = requestVar('highlight');
$amount       = requestVar('amount');
$action       = requestVar('action');
$nextaction   = requestVar('nextaction');
$maxresults   = requestVar('maxresults');
$startpos     = intRequestVar('startpos');
$errormessage = '';
$error        = '';
$special      = requestVar('special');
$virtualpath  = ((getVar('virtualpath') != null) ? getVar('virtualpath') : serverVar('PATH_INFO'));

if ( !headers_sent() && $CONF['expose_generator'] ) {
    header(sprintf('Generator: %s' , CORE_APPLICATION_NAME));
}

// Avoid the ClickJacking attack
if ( !headers_sent()
    &&
    (
        !defined('_DISABLE_FEATURE_SECURITY_CLICKJACKING') || !constant('_DISABLE_FEATURE_SECURITY_CLICKJACKING')
    )
)
{
    header('X-Frame-Options: SAMEORIGIN');
}

init_nucleus_compatibility_mysql_handler(); // compatible for mysql_handler global $MYSQL_*

global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;
// deprecated method
// include core classes that are needed for login & plugin handling
if (($DB_DRIVER_NAME === 'mysql') && !function_exists('mysql_query')) {
    if ($DB_PHP_MODULE_NAME === 'pdo')
        include_once(NC_LIBS_PATH . 'sql/pdo_mysql_emulate.php'); // For PHP 7
    else
        include_once(NC_LIBS_PATH . 'sql/mysql_emulate.php'); // For PHP 7
}
else
{
    if (!defined('_EXT_MYSQL_EMULATE')) // installer define this value.
        define('_EXT_MYSQL_EMULATE' , 0);
}

include_once(NC_LIBS_PATH . 'sql/'.$DB_PHP_MODULE_NAME.'.php');
include_once(NC_LIBS_PATH . 'MEMBER.php');
include_once(NC_LIBS_PATH . 'ACTIONLOG.php');
include_once(NC_LIBS_PATH . 'MANAGER.php');
include_once(NC_LIBS_PATH . 'PLUGIN.php');
include_once(NC_LIBS_PATH . 'SYSTEMLOG.php');
include_once(NC_LIBS_PATH . 'Utils.php');

$manager =& MANAGER::instance();

// only needed when updating logs
if ($CONF['UsingAdminArea']) {
    include_once(NC_LIBS_PATH . 'xmlrpc.inc.php');  // XML-RPC client classes
    include_once(NC_LIBS_PATH . 'ADMIN.php');
}

// connect to database
sql_connect();
$SQLCount = 0;

// logs sanitized result if need
if ($orgRequestURI!==serverVar('REQUEST_URI')) {
    $msg = "Sanitized [" . serverVar('REMOTE_ADDR') . "] ";
    $msg .= $orgRequestURI . " -> " . serverVar('REQUEST_URI');
    if ($bLoggingSanitizedResult) {
        addToLog(WARNING, $msg);
    }
    if (!$bSanitizeAndContinue) {
        exit;
    }
}

// makes sure database connection gets closed on script termination
register_shutdown_function('sql_disconnect');

// read config
getConfig();

// Properly set $CONF['Self'] and others if it's not set... usually when we are access from admin menu
if (!isset($CONF['Self'])) {
    $CONF['Self'] = rtrim($CONF['IndexURL'], '/'); // strip trailing
}

if($CONF['URLMode']==='pathinfo' && substr($CONF['Self'],-4)==='.php')
    $CONF['Self'] = rtrim($CONF['IndexURL'], '/');

$CONF['ItemURL']        = $CONF['Self'];
$CONF['ArchiveURL']     = $CONF['Self'];
$CONF['ArchiveListURL'] = $CONF['Self'];
$CONF['MemberURL']      = $CONF['Self'];
$CONF['SearchURL']      = $CONF['Self'];
$CONF['BlogURL']        = $CONF['Self'];
$CONF['CategoryURL']    = $CONF['Self'];

// switch URLMode back to normal when $CONF['Self'] ends in .php
// this avoids urls like index.php/item/13/index.php/item/15
if (
    !isset($CONF['URLMode'])
    ||
    (
        ($CONF['URLMode'] === 'pathinfo') && (substr($CONF['Self'], strlen($CONF['Self']) - 4) === '.php')
    )
) {
    $CONF['URLMode'] = 'normal';
}

// automatically use simpler toolbar for mozilla
if ($CONF['DisableJsTools'] == 0 && str_contains(serverVar('HTTP_USER_AGENT'), 'Mozilla/5.0') && str_contains(serverVar('HTTP_USER_AGENT'), 'Gecko')) {
    $CONF['DisableJsTools'] = 2;
}

// login if cookies set
$member = new MEMBER();

// secure cookie key settings (either 'none', 0, 8, 16, 24, or 32)
if (!isset($CONF['secureCookieKey'])) $CONF['secureCookieKey']=24;
switch($CONF['secureCookieKey']){
case 8:
    $CONF['secureCookieKeyIP']=preg_replace('/\.[0-9]+\.[0-9]+\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
    break;
case 16:
    $CONF['secureCookieKeyIP']=preg_replace('/\.[0-9]+\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
    break;
case 24:
    $CONF['secureCookieKeyIP']=preg_replace('/\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
    break;
case 32:
    $CONF['secureCookieKeyIP']=serverVar('REMOTE_ADDR');
    break;
default:
    $CONF['secureCookieKeyIP']='';
}

// login/logout when required or renew cookies
if (requestVar('action') === 'login') {
    if(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    // Form Authentication
    $login = postVar('login');
    $pw = postVar('password');
    $shared = intPostVar('shared'); // shared computer or not

    $pw=substr($pw,0,40); // avoid md5 collision by using a long key

    if ($member->login($login, $pw) ) {

        $member->newCookieKey();
        $member->setCookies($shared);

        if ($CONF['secureCookieKey']!=='none') {
            // secure cookie key
            $member->setCookieKey(md5($member->getCookieKey().$CONF['secureCookieKeyIP']));
            $member->writeCookieKey();
        }

        // allows direct access to parts of the admin area after logging in
        if ($nextaction) {
            $action = $nextaction;
        }

        $param = array(
            'member'    => &$member,
            'username'    =>  $login
        );
        $manager->notify('LoginSuccess', $param);
        $errormessage = '';
        $log_message = sprintf("Login successful for %s (sharedpc=%s)", $login, $shared);

        $remote_ip = (isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '');
        $remote_host = (isset($_SERVER["REMOTE_HOST"]) ? $_SERVER["REMOTE_HOST"] : gethostbyaddr($remote_ip));
        if ($remote_ip !=='')
        {
            $log_message .= sprintf(" %s", $remote_ip);
            if ($remote_host!==FALSE && $remote_host!=$remote_ip)
                $log_message .= sprintf("(%s)", $remote_host);
        }
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $remote_proxy_ip = explode(',' , $_SERVER["HTTP_X_FORWARDED_FOR"]);
            $remote_proxy_ip = $remote_proxy_ip[0]; //   explode(,)[0] syntax error php(-5.2)
            $remote_proxy_host = gethostbyaddr($remote_proxy_ip);
            $log_message .= sprintf(" , proxy %s", $remote_proxy_ip);
            if ($remote_proxy_host !==FALSE && $remote_proxy_host!=$remote_proxy_ip)
                $log_message .= sprintf("(%s)", $remote_proxy_host);
            unset($remote_proxy_ip, $remote_proxy_host);
        }
        ACTIONLOG::add(INFO, $log_message);
        unset($log_message);
        unset($remote_ip, $remote_host);
    } else {
        // errormessage for [%errordiv%]
        $trimlogin = trim($login);
        if (empty($trimlogin))
        {
            $errormessage = "Please enter a username.";
        }
        else 
        {
            loadCoreLanguage(false);
            if ($member->isHalt())
                $errormessage = sprintf(_GFUNCTIONS_LOGIN_FAILED_HALT_TXT , $login);
            else
                $errormessage = 'Login failed for ' . $login;
        }
        $param = array('username' => $login);
        $manager->notify('LoginFailed', $param);
        ACTIONLOG::add(INFO, $errormessage);
    }
} elseif (($action === 'logout') && (!headers_sent() ) && cookieVar($CONF['CookiePrefix'] . 'user') ) {
    // remove cookies on logout
    setcookie($CONF['CookiePrefix'] . 'user', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
    setcookie($CONF['CookiePrefix'] . 'loginkey', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
    $param = array('username' => cookieVar($CONF['CookiePrefix'] . 'user'));
    $manager->notify('Logout', $param);
} elseif (cookieVar($CONF['CookiePrefix'] . 'user') ) {
    // Cookie Authentication
    $ck=cookieVar($CONF['CookiePrefix'] . 'loginkey');
    // secure cookie key
    $ck=substr($ck,0,32); // avoid md5 collision by using a long key
    if ($CONF['secureCookieKey']!=='none') $ck=md5($ck.$CONF['secureCookieKeyIP']);
    $res = $member->cookielogin(cookieVar($CONF['CookiePrefix'] . 'user'), $ck );
    unset($ck);

    // renew cookies when not on a shared computer
    if ($res && (cookieVar($CONF['CookiePrefix'] . 'sharedpc') != 1) && (!headers_sent() ) ) {
        $member->setCookieKey(cookieVar($CONF['CookiePrefix'] . 'loginkey'));
        $member->setCookies();
    }
}

// login completed
$param = array('loggedIn' => $member->isLoggedIn());
$manager->notify('PostAuthentication', $param);
ticketForPlugin();

// first, let's see if the site is disabled or not. always allow admin area access.
if ($CONF['DisableSite'] && !$member->isAdmin() && !$CONF['UsingAdminArea']) {
    $url = trim($CONF['DisableSiteURL']);
    if (strlen($url)>0) {
        redirect($url);
    } else {
        if (!headers_sent()) {
            header("HTTP/1.0 503 Service Unavailable");
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Mon, 01 Jan 2018 00:00:00 GMT");
        }
        $title = 'Service Unavailable';
        $msg = 'Service Unavailable.';
        echo "<html><head><title>$title</title></head><body><h1>$title</h1>$msg</body></html>";
    }
    exit;
}

$param = array();
$manager->notify('PreLoadMainLibs', $param);

// load other classes
include_once(NC_LIBS_PATH.'PARSER.php');
include_once(NC_LIBS_PATH.'SKIN.php');
include_once(NC_LIBS_PATH.'TEMPLATE.php');
include_once(NC_LIBS_PATH.'BLOG.php');
include_once(NC_LIBS_PATH.'BODYACTIONS.php');
include_once(NC_LIBS_PATH.'COMMENTS.php');
include_once(NC_LIBS_PATH.'COMMENT.php');
include_once(NC_LIBS_PATH.'ITEM.php');
include_once(NC_LIBS_PATH.'NOTIFICATION.php');
include_once(NC_LIBS_PATH.'BAN.php');
include_once(NC_LIBS_PATH.'PAGEFACTORY.php');
include_once(NC_LIBS_PATH.'SEARCH.php');
include_once(NC_LIBS_PATH.'entity.php');
include_once(NC_LIBS_PATH.'CoreCachedData.php');

spl_autoload_register('loadCoreClassFor_spl'.(version_compare('5.3.0',PHP_VERSION,'<=') ? '' : '_prephp53'));

// set lastVisit cookie (if allowed)
if (!headers_sent() ) {
    if ($CONF['LastVisit']) {
        setcookie($CONF['CookiePrefix'] . 'lastVisit', time(), time() + 2592000, $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
    } else {
        setcookie($CONF['CookiePrefix'] . 'lastVisit', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
    }
}

// read language file, only after user has been initialized
LoadCoreLanguage();
$language = getLanguageName();

// check if valid charset
if (function_exists('encoding_check')) {
    if (!encoding_check(false, false, _CHARSET)) {
        foreach(array($_GET, $_POST) as $input) {
            array_walk($input, 'encoding_check');
        }
    }
}

// make sure the archivetype skinvar keeps working when _ARCHIVETYPE_XXX not defined
if (!defined('_ARCHIVETYPE_MONTH') )
{
    define('_ARCHIVETYPE_DAY', 'day');
    define('_ARCHIVETYPE_MONTH', 'month');
    define('_ARCHIVETYPE_YEAR', 'year');
}

// decode path_info
if ($CONF['URLMode'] === 'pathinfo') {
    $parsed = false;
    $param = array(
        'type'        =>  basename(serverVar('SCRIPT_NAME') ), // e.g. item, blog, ...
        'info'        =>  $virtualpath,
        'complete'    => &$parsed
    );
    $manager->notify('ParseURL', $param);

    if (!$parsed) {
        // default implementation
        $data = explode('/', $virtualpath );
        $total = count($data);
        foreach ($data as $i => $iValue) {
            switch ($data[$i]) {
                case $CONF['ItemKey']: // item/1 (blogid)
                    $i++;

                    if ($i < $total ) {
                        $itemid = (int)$iValue;
                    }
                    break;

                case $CONF['ArchivesKey']: // archives/1 (blogid)
                    $i++;

                    if ($i < $total ) {
                        $archivelist = (int)$iValue;
                    }
                    break;

                case $CONF['ArchiveKey']: // two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid)
                    if ((($i + 1) < $total ) && (strpos($data[$i + 1], '-') === false) ) {
                        $blogid = (int)$data[++$i];
                    }

                    $i++;

                    if ($i < $total ) {
                        $archive = $iValue;
                    }
                    break;

                case 'blogid': // blogid/1
                case $CONF['BlogKey']: // blog/1
                    $i++;

                    if ($i < $total ) {
                        $blogid = (int)$iValue;
                    }
                    break;

                case $CONF['CategoryKey']: // category/1 (catid)
                case 'catid':
                    $i++;

                    if ($i < $total ) {
                        $catid = (int)$iValue;
                    }
                    break;

                case $CONF['MemberKey']:
                    $i++;

                    if ($i < $total ) {
                        $memberid = (int)$iValue;
                    }
                    break;

                case $CONF['SpecialskinKey']:
                    $i++;

                    if ($i < $total ) {
                        $special = $iValue;
                        $_REQUEST['special'] = $special;
                    }
                    break;

                default:
                    // skip...
            }
        }
    }
}
/*     PostParseURL is a place to cleanup any of the path-related global variables before the selector function is run.
    It has 2 values in the data in case the original virtualpath is needed, but most the use will be in tweaking
    global variables to clean up (scrub out catid or add catid) or to set someother global variable based on
    the values of something like catid or itemid
    New in 3.60
*/
$param = array(
    'type' => basename(serverVar('SCRIPT_NAME') ), // e.g. item, blog, ...
    'info' => $virtualpath
);
$manager->notify('PostParseURL', $param);
