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

global $DIR_NUCLEUS;
//if(is_file($DIR_NUCLEUS.'autoload.php')) include_once($DIR_NUCLEUS.'autoload.php');

if(!isset($_SERVER['REQUEST_TIME_FLOAT'])) $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);    // (PHP 5.4-) : $_SERVER['REQUEST_TIME_FLOAT']
if(!isset($_SERVER['REQUEST_TIME'])) $_SERVER['REQUEST_TIME'] = $_SERVER['REQUEST_TIME_FLOAT']; // (PHP 5.1-) : $_SERVER['REQUEST_TIME']
global $StartTime;
$StartTime = $_SERVER['REQUEST_TIME_FLOAT'];

/*
// Set PHP of the minimum requirement of the target of the current release here.
if (version_compare(phpversion(), '5.3.0', '<')) {
    // PHP 5.6 and 7.0 : Security Support Until Dec 2018
    if (!headers_sent()) {
        header("HTTP/1.0 503 Service Unavailable");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 01 Jan 2018 00:00:00 GMT");
    }
    $msg = 'The php of server module does not meet the execution minimum requirement.';
    echo "<html><head><title>Error</title></head><body><h1>Error</h1>$msg</body></html>";
    exit();
}
*/

define('HAS_CATCH_ERROR', version_compare('7.0.0',PHP_VERSION,'<='));

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $DIR_LIBS, $DIR_LANG, $manager, $member;

include_once($DIR_LIBS. 'version.php');
include_once($DIR_LIBS. 'globalfunctions.inc.php');

define('CORE_APPLICATION_NAME',                'Nucleus CMS'); // if you forked product, you can easy to change cms name.
define('CORE_APPLICATION_VERSION',             NUCLEUS_VERSION);
define('CORE_APPLICATION_VERSION_ID',          NUCLEUS_VERSION_ID);
define('CORE_APPLICATION_DATABASE_VERSION_ID', NUCLEUS_DATABASE_VERSION_ID);
$nucleus['version'] = 'v'.NUCLEUS_VERSION;
$nucleus['codename'] = (defined('NUCLEUS_DEVELOP') && constant('NUCLEUS_DEVELOP') ?  'dev' : '');

$default_user_agent = array('ie' => array());
$default_user_agent['ie']['7']   = 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko';
$default_user_agent['ie']['8.1'] = 'Mozilla/5.0 (Windows NT 6.3; Win64, x64; Trident/7.0; Touch; rv:11.0) like Gecko';
$default_user_agent['ie']['11']  = 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko';
$default_user_agent['default'] = &$default_user_agent['ie']['11'];
// http://msdn.microsoft.com/ja-jp/library/ie/hh869301%28v=vs.85%29.aspx
if ( ! defined('DEFAULT_USER_AGENT') )
  define('DEFAULT_USER_AGENT' , $default_user_agent['default']);
ini_set( 'user_agent' , DEFAULT_USER_AGENT );

if (version_compare(phpversion(),'5.4.0','<')) {
    if(ini_get('register_globals')) exit('Should be change off register_globals.');
    if(get_magic_quotes_runtime() || ini_get('magic_quotes_gpc')) exit('Should be change php.ini: magic_quotes_gpc=0');
    if(ini_get('magic_quotes_sybase')) exit('Should be remove magic_quotes_sybase in php.ini');
}

if (isset($CONF['debug'])&&!empty($CONF['debug'])) {
    error_reporting(E_ALL); // report all errors!
    ini_set('display_errors', 1);
} else {
    if(!isset($CONF['UsingAdminArea'])||empty($CONF['UsingAdminArea']))
        ini_set('display_errors','0');
    if (!defined('E_DEPRECATED')) define('E_DEPRECATED', 8192);
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
}

/*
 * Set default time zone
 * By Japanese Packaging Team, Jan.27, 2011
 * For private server which has no condition for default time zone
 */

if (function_exists('date_default_timezone_get')) {
    if (FALSE == ($timezone = @date_default_timezone_get())) {
        $timezone = 'UTC';
    }
}

if (function_exists('date_default_timezone_set')) {
     @date_default_timezone_set($timezone);
}

/*
    Indicates when Nucleus should display startup errors. Set to 1 if you want
    the error enabled (default), false otherwise

    alertOnHeadersSent
        Displays an error when visiting a public Nucleus page and headers have
        been sent out to early. This usually indicates an error in either a
        configuration file or a language file, and could cause Nucleus to
        malfunction
    alertOnSecurityRisk
        Displays an error only when visiting the admin area, and when one or
        more of the installation files (install.php, install.sql, _upgrades/
        directory) are still on the server.
*/

if (!isset($CONF['alertOnHeadersSent']) || empty($CONF['alertOnHeadersSent']))
{
    $CONF['alertOnHeadersSent']  = 1;
}
if(!isset($CONF['alertOnSecurityRisk'])) $CONF['alertOnSecurityRisk'] = 1;

/*
    Set these to 1 to allow viewing of future items or draft items
    Should really never do this, but can be useful for some plugins that might need to
    Could cause some other issues if you use future posts otr drafts
    So use with care
*/
$CONF['allowDrafts'] = 0;
$CONF['allowFuture'] = 0;

if (getNucleusPatchLevel() > 0) {
    $nucleus['version'] .= '/' . getNucleusPatchLevel();
}

// Avoid notices
if (!isset($CONF['installscript'])) {
    $CONF['installscript'] = 0;
}

// we will use postVar, getVar, ... methods instead of _GET
if ($CONF['installscript'] != 1) { // vars were already included in install.php
    include_once($DIR_LIBS . 'vars4.1.0.php');
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

if (!isset($CONF['expose_generator']))
  $CONF['expose_generator'] = false;

if ( !headers_sent() && $CONF['expose_generator'] ) {
    header(sprintf('Generator: %s' , CORE_APPLICATION_NAME));
}

// Avoid the ClickJacking attack
if ( !headers_sent() && (!defined('_DISABLE_FEATURE_SECURITY_CLICKJACKING') || (! _DISABLE_FEATURE_SECURITY_CLICKJACKING)) )
{
    header('X-Frame-Options: SAMEORIGIN');
}

init_nucleus_compatibility_mysql_handler(); // compatible for mysql_handler global $MYSQL_*

global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;
// deprecated method
// include core classes that are needed for login & plugin handling
if (($DB_DRIVER_NAME=='mysql') && !function_exists('mysql_query')) {
    if ($DB_PHP_MODULE_NAME == 'pdo')
        include_once($DIR_LIBS . 'sql/pdo_mysql_emulate.php'); // For PHP 7
    else
        include_once($DIR_LIBS . 'sql/mysql_emulate.php'); // For PHP 7
}
else
{
    if (!defined('_EXT_MYSQL_EMULATE')) // installer define this value.
        define('_EXT_MYSQL_EMULATE' , 0);
}

include_once($DIR_LIBS . 'sql/'.$DB_PHP_MODULE_NAME.'.php');
include_once($DIR_LIBS . 'MEMBER.php');
include_once($DIR_LIBS . 'ACTIONLOG.php');
include_once($DIR_LIBS . 'MANAGER.php');
include_once($DIR_LIBS . 'PLUGIN.php');
include_once($DIR_LIBS . 'SYSTEMLOG.php');
include_once($DIR_LIBS . 'Utils.php');

$manager =& MANAGER::instance();

// make sure there's no unnecessary escaping:
//set_magic_quotes_runtime(0);
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    ini_set('magic_quotes_runtime', '0');
    set_magic_quotes_runtime(0);
}

// Avoid notices
if (!isset($CONF['UsingAdminArea'])) {
    $CONF['UsingAdminArea'] = 0;
}

// only needed when updating logs
if ($CONF['UsingAdminArea']) {
    include_once($DIR_LIBS . 'xmlrpc.inc.php');  // XML-RPC client classes
    include_once($DIR_LIBS . 'ADMIN.php');
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
if (!isset($CONF['URLMode']) || (($CONF['URLMode'] == 'pathinfo') && (substr($CONF['Self'], strlen($CONF['Self']) - 4) == '.php'))) {
    $CONF['URLMode'] = 'normal';
}

// automatically use simpler toolbar for mozilla
if (($CONF['DisableJsTools'] == 0) && strstr(serverVar('HTTP_USER_AGENT'), 'Mozilla/5.0') && strstr(serverVar('HTTP_USER_AGENT'), 'Gecko') ) {
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
if ($action == 'login') {
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
} elseif (($action == 'logout') && (!headers_sent() ) && cookieVar($CONF['CookiePrefix'] . 'user') ) {
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
include_once("{$DIR_LIBS}PARSER.php");
include_once("{$DIR_LIBS}SKIN.php");
include_once("{$DIR_LIBS}TEMPLATE.php");
include_once("{$DIR_LIBS}BLOG.php");
include_once("{$DIR_LIBS}BODYACTIONS.php");
include_once("{$DIR_LIBS}COMMENTS.php");
include_once("{$DIR_LIBS}COMMENT.php");
include_once("{$DIR_LIBS}ITEM.php");
include_once("{$DIR_LIBS}NOTIFICATION.php");
include_once("{$DIR_LIBS}BAN.php");
include_once("{$DIR_LIBS}PAGEFACTORY.php");
include_once("{$DIR_LIBS}SEARCH.php");
include_once("{$DIR_LIBS}entity.php");
include_once("{$DIR_LIBS}CoreCachedData.php");

if (version_compare('5.1.0',PHP_VERSION,'<=')) {
    // register autoload class function / PHP >= 5.1.0
    spl_autoload_register('loadCoreClassFor_spl'.(version_compare('5.3.0',PHP_VERSION,'<=') ? '' : '_prephp53'));
}

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
if (function_exists('encoding_check'))
if (!encoding_check(false, false, _CHARSET)) {
    foreach(array($_GET, $_POST) as $input) {
        array_walk($input, 'encoding_check');
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
if ($CONF['URLMode'] == 'pathinfo') {
    // initialize keywords if this hasn't been done before
    if (!isset($CONF['ItemKey']) || $CONF['ItemKey'] == '') {
        $CONF['ItemKey'] = 'item';
    }

    if (!isset($CONF['ArchiveKey']) || $CONF['ArchiveKey'] == '') {
        $CONF['ArchiveKey'] = 'archive';
    }

    if (!isset($CONF['ArchivesKey']) || $CONF['ArchivesKey'] == '') {
        $CONF['ArchivesKey'] = 'archives';
    }

    if (!isset($CONF['MemberKey']) || $CONF['MemberKey'] == '') {
        $CONF['MemberKey'] = 'member';
    }

    if (!isset($CONF['BlogKey']) || $CONF['BlogKey'] == '') {
        $CONF['BlogKey'] = 'blog';
    }

    if (!isset($CONF['CategoryKey']) || $CONF['CategoryKey'] == '') {
        $CONF['CategoryKey'] = 'category';
    }

    if (!isset($CONF['SpecialskinKey']) || $CONF['SpecialskinKey'] == '') {
        $CONF['SpecialskinKey'] = 'special';
    }

    $parsed = false;
    $param = array(
        'type'        =>  basename(serverVar('SCRIPT_NAME') ), // e.g. item, blog, ...
        'info'        =>  $virtualpath,
        'complete'    => &$parsed
    );
    $manager->notify('ParseURL', $param);

    if (!$parsed) {
        // default implementation
        $data = explode("/", $virtualpath );
        for ($i = 0; $i < sizeof($data); $i++) {
            switch ($data[$i]) {
                case $CONF['ItemKey']: // item/1 (blogid)
                    $i++;

                    if ($i < sizeof($data) ) {
                        $itemid = intval($data[$i]);
                    }
                    break;

                case $CONF['ArchivesKey']: // archives/1 (blogid)
                    $i++;

                    if ($i < sizeof($data) ) {
                        $archivelist = intval($data[$i]);
                    }
                    break;

                case $CONF['ArchiveKey']: // two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid)
                    if ((($i + 1) < sizeof($data) ) && (!strstr($data[$i + 1], '-') ) ) {
                        $blogid = intval($data[++$i]);
                    }

                    $i++;

                    if ($i < sizeof($data) ) {
                        $archive = $data[$i];
                    }
                    break;

                case 'blogid': // blogid/1
                case $CONF['BlogKey']: // blog/1
                    $i++;

                    if ($i < sizeof($data) ) {
                        $blogid = intval($data[$i]);
                    }
                    break;

                case $CONF['CategoryKey']: // category/1 (catid)
                case 'catid':
                    $i++;

                    if ($i < sizeof($data) ) {
                        $catid = intval($data[$i]);
                    }
                    break;

                case $CONF['MemberKey']:
                    $i++;

                    if ($i < sizeof($data) ) {
                        $memberid = intval($data[$i]);
                    }
                    break;

                case $CONF['SpecialskinKey']:
                    $i++;

                    if ($i < sizeof($data) ) {
                        $special = $data[$i];
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

