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
if(!isset($_SERVER['REQUEST_TIME_FLOAT'])) $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
global $StartTime;
$StartTime = $_SERVER['REQUEST_TIME_FLOAT'];

//if (version_compare(phpversion(),'5.3.0','<')) {
//    exit('The php of server module does not meet the execution minimum requirement. (-.-).');
//}

define('HAS_CATCH_ERROR', version_compare('7.0.0',PHP_VERSION,'<='));

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $DIR_LIBS, $DIR_LANG, $manager, $member;

include_once($DIR_LIBS. 'version.php');

define('CORE_APPLICATION_NAME',                'Nucleus CMS'); // if you forked product, you can easy to change cms name.
define('CORE_APPLICATION_VERSION',             NUCLEUS_VERSION);
define('CORE_APPLICATION_VERSION_ID',          NUCLEUS_VERSION_ID);
define('CORE_APPLICATION_DATABASE_VERSION_ID', NUCLEUS_DATABASE_VERSION_ID);
$nucleus['version'] = 'v'.NUCLEUS_VERSION;
$nucleus['codename'] = '';

$default_user_agent = array('ie' => array());
$default_user_agent['ie']['7']   = 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko';
$default_user_agent['ie']['8.1'] = 'Mozilla/5.0 (Windows NT 6.3; Win64, x64; Trident/7.0; Touch; rv:11.0) like Gecko';
$default_user_agent['ie']['11']  = 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko';
$default_user_agent['default'] = &$default_user_agent['ie']['11'];
// http://msdn.microsoft.com/ja-jp/library/ie/hh869301%28v=vs.85%29.aspx
if ( ! defined('DEFAULT_USER_AGENT') )
  define('DEFAULT_USER_AGENT' , $default_user_agent['default']);
ini_set( 'user_agent' , DEFAULT_USER_AGENT );

if(ini_get('register_globals')) exit('Should be change off register_globals.');

if (isset($CONF['debug'])&&!empty($CONF['debug'])) {
    error_reporting(E_ALL); // report all errors!
} else {
    if(!isset($CONF['UsingAdminArea'])||empty($CONF['UsingAdminArea']))
        ini_set('display_errors','0');
    if (!defined('E_DEPRECATED')) define('E_DEPRECATED', 8192);
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
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

global $DB_PHP_MODULE_NAME;
if ($DB_PHP_MODULE_NAME != 'pdo')
{
    // deprecated method
    // include core classes that are needed for login & plugin handling
    if (!function_exists('mysql_query'))
        include_once($DIR_LIBS . 'mysql.php'); // For PHP 7
    else
    {
        if (!defined('_EXT_MYSQL_EMULATE')) // installer define this value.
            define('_EXT_MYSQL_EMULATE' , 0);
    }
}
else
{
    // Todo: mysql wrapper for pdo? or deprecate mysql_* functions
    if (!defined('_EXT_MYSQL_EMULATE')) // installer define this value.
        define('_EXT_MYSQL_EMULATE' , 0);
}

include_once($DIR_LIBS . 'sql/'.$DB_PHP_MODULE_NAME.'.php');
include_once($DIR_LIBS . 'MEMBER.php');
include_once($DIR_LIBS . 'ACTIONLOG.php');
include_once($DIR_LIBS . 'MANAGER.php');
include_once($DIR_LIBS . 'PLUGIN.php');
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
        die("");
    }
}

// makes sure database connection gets closed on script termination
register_shutdown_function('sql_disconnect');

// read config
getConfig();

// Properly set $CONF['Self'] and others if it's not set... usually when we are access from admin menu
if (!isset($CONF['Self']))
    $CONF['Self'] = rtrim($CONF['IndexURL'], '/'); // strip trailing

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
    redirect($CONF['DisableSiteURL']);
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

function include_libs($file,$once=true,$require=true){
    global $DIR_LIBS;
    if (!is_dir($DIR_LIBS)) exit;
    if ($once && $require) require_once($DIR_LIBS.$file);
    elseif ($once && !$require) include_once($DIR_LIBS.$file);
    elseif ($require) require($DIR_LIBS.$file);
    else include($DIR_LIBS.$file);
}

function include_plugins($file,$once=true,$require=true){
    global $DIR_PLUGINS;
    if (!is_dir($DIR_PLUGINS)) exit;
    if ($once && $require) require_once($DIR_PLUGINS.$file);
    elseif ($once && !$require) include_once($DIR_PLUGINS.$file);
    elseif ($require) require($DIR_PLUGINS.$file);
    else include($DIR_PLUGINS.$file);
}

function intPostVar($name) {
    return intval(postVar($name) );
}

function intGetVar($name) {
    return intval(getVar($name) );
}

function intRequestVar($name) {
    return intval(requestVar($name) );
}

function intCookieVar($name) {
    return intval(cookieVar($name) );
}

/**
  * returns the currently used version (100 = 1.00, 101 = 1.01, etc...)
  */
function getNucleusVersion() {
    return NUCLEUS_VERSION_ID;
}

/**
 * power users can install patches in between nucleus releases. These patches
 * usually add new functionality in the plugin API and allow those to
 * be tested without having to install CVS.
 */
function getNucleusPatchLevel() {
    return NUCLEUS_PATCH_LEVEL;
}

/**
 * returns the latest version available for download from nucleuscms.org
 * or false if unable to attain data
 * format will be major.minor/patachlevel
 * e.g. 3.41 or 3.41/02
 */
function getLatestVersion() {
    global $CONF;

    // response version text ,  last request time
    foreach(array('LatestVerText','LatestVerReqTime') as $key)
    if (!array_key_exists($key,$CONF))
    {
        // `name`  varchar(20)
        $query = sprintf("INSERT INTO %s (name,value) VALUES ('%s', '')", sql_table('config'), sql_real_escape_string($key));
        sql_query($query);
        $CONF[$key] = '';
    }

    $t = (!empty($CONF['LatestVerReqTime']) ? intval($CONF['LatestVerReqTime']):0);
    $l_ver = (!empty($CONF['LatestVerText']) ? $CONF['LatestVerText']:'');
    $elapsed_time = time()-$t;
    // cache 180 minutes ,
    if ($t>0 && ($elapsed_time > -60) && ($elapsed_time<60*180))
    {
        return $l_ver;
    }

    $options = array('timeout'=> 5, 'connecttimeout'=> 3);
    $ret = Utils::httpGet('http://nucleuscms.org/version_check.php', $options);

    if (empty($ret))
        $ret = '';

    ADMIN::updateConfig('LatestVerText', $ret);
    ADMIN::updateConfig('LatestVerReqTime', strval(time()) );

    return $ret;
}

/**
 * returns a prefixed nucleus table name
 */
function sql_table($name) {
    global $DB_PREFIX;

    if (strlen($DB_PREFIX) > 0) {
        return $DB_PREFIX . 'nucleus_' . $name;
    } else {
        return 'nucleus_' . $name;
    }
}

function sendContentType($contenttype, $pagetype = '', $charset = _CHARSET) {
    global $manager, $CONF;

    if (!headers_sent() ) {
        if (
                ($contenttype == 'application/xhtml+xml')
            &&  (!stristr(serverVar('HTTP_ACCEPT'), 'application/xhtml+xml') )
            ) {
            $contenttype = 'text/html';
        }
        $param = array(
            'contentType'    => &$contenttype,
            'charset'        => &$charset,
            'pageType'        =>  $pagetype
        );

        if (!function_exists('sql_connected') || sql_connected())
        $manager->notify('PreSendContentType', $param);

        // strip strange characters
        $contenttype = preg_replace('|[^a-z0-9-+./]|i', '', $contenttype);
        $charset = preg_replace('|[^a-z0-9-_]|i', '', $charset);

        if ($charset != '') {
            header('Content-Type: ' . $contenttype . '; charset=' . $charset);
        } else {
            header('Content-Type: ' . $contenttype);
        }
    }
}

/**
 * Highlights a specific query in a given HTML text (not within HTML tags) and returns it
 * @param string $text text to be highlighted
 * @param string $expression regular expression to be matched (can be an array of expressions as well)
 * @param string $highlight highlight to be used (use \\0 to indicate the matched expression)
 * @return string
 **/
function highlight($text, $expression, $highlight) {
    if (!$highlight || !$expression)
    {
        return $text;
    }
    
    if (is_array($expression) && (count($expression) == 0) )
    {
        return $text;
    }
    
    // add a tag in front (is needed for preg_match_all to work correct)
    $text = '<!--h-->' . $text;
    
    // split the HTML up so we have HTML tags
    // $matches[0][i] = HTML + text
    // $matches[1][i] = HTML
    // $matches[2][i] = text
	$matches = array();
    preg_match_all('/(<[^>]+>)([^<>]*)/', $text, $matches);
    
    // throw it all together again while applying the highlight to the text pieces
    $result = '';
    $count_matches = count($matches[2]);
    for ($i = 0; $i < $count_matches; $i++) {
        if ($i != 0)
        {
            $result .= $matches[1][$i];
        }
        
        if (is_array($expression) )
        {
            foreach ($expression as $regex)
            {
                if ($regex)
                {
                    $matches[2][$i] = @preg_replace("#".$regex."#i", $highlight, $matches[2][$i]);
                }
            }
            
            $result .= $matches[2][$i];
        }
        else
        {
            $result .= @preg_replace("#".$expression."#i", $highlight, $matches[2][$i]);
        }
    }
    
    return $result;
}

/**
 * Parses a query into an array of expressions that can be passed on to the highlight method
 */
function parseHighlight($query) {
    // TODO: add more intelligent splitting logic

    // get rid of quotes
    $query = str_replace(array("'",'/'), '', $query);

    if (!$query) {
        return array();
    }

    $aHighlight = explode(' ', $query);

    for ($i = 0; $i < count($aHighlight); $i++) {
        $aHighlight[$i] = trim($aHighlight[$i]);

//        if (strlen($aHighlight[$i]) < 3)
//            unset($aHighlight[$i]);
    }

    if (count($aHighlight) == 1) {
        return $aHighlight[0];
    } else {
        return $aHighlight;
    }
}

/**
  * Checks if email address is valid
  */
function isValidMailAddress($address) {
    // enhancement made in 3.6x based on code by Quandary.
    if (preg_match('/^(?!\\.)(?:\\.?[-a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~]+)+@(?!\\.)(?:\\.?(?!-)[-a-zA-Z0-9]+(?<!-)){2,}$/', $address)) {
        return 1;
    } else {
        return 0;
    }
}

// some helper functions
function getBlogIDFromName($name)
{
    $res = quickQuery('SELECT bnumber as result FROM ' . sql_table('blog') . ' WHERE bshortname="' . sql_real_escape_string($name) . '"');
    if ($res !== false)
      $res = intval($res);
    return $res;
}

function getBlogNameFromID($id)
{
    return quickQuery('SELECT bname as result FROM ' . sql_table('blog') . ' WHERE bnumber=' . intval($id) );
}

function getBlogIDFromItemID($itemid)
{
    $res = quickQuery('SELECT iblog as result FROM ' . sql_table('item') . ' WHERE inumber=' . intval($itemid) );
    if ($res !== false)
      $res = intval($res);
    return $res;
}

function getBlogIDFromCommentID($commentid)
{
    $res = quickQuery('SELECT cblog as result FROM ' . sql_table('comment') . ' WHERE cnumber=' . intval($commentid) );
    if ($res !== false)
        $res = intval($res);
    return $res;
}

function getBlogIDFromCatID($catid)
{
    $res = quickQuery('SELECT cblog as result FROM ' . sql_table('category') . ' WHERE catid=' . intval($catid) );
    if ($res !== false)
        $res = intval ($res);
    return $res;
}

function getCatIDFromName($name)
{
    $res = quickQuery('SELECT catid as result FROM ' . sql_table('category') . ' WHERE cname="' . sql_real_escape_string($name) . '"');
	if ($res !== false)
		$res = intval ($res);
	return $res;
}

function quickQuery($sqlText)
{
    $res = sql_query($sqlText);
    if ($res && ($v = sql_fetch_array($res)))
    {
        if ( isset($v['result']) )
          return $v['result'];
        if ( isset($v[0]) )
          return $v[0];
    }
    return FALSE;
}

function getPluginNameFromPid($pid) {
    $query = sprintf('SELECT pfile FROM `%s` WHERE pid=%d', sql_table('plugin'), intval($pid));
    $res = sql_query($query);
    if ($res && ($obj = sql_fetch_object($res)))
        return $obj->pfile;
    return FALSE;
}

function selector() {
    global $itemid, $blogid, $memberid, $query, $amount, $archivelist, $maxresults;
    global $archive, $skinid, $blog, $memberinfo, $CONF, $member;
    global $imagepopup, $catid, $special;
    global $manager;

    $actionNames = array('addcomment', 'sendmessage', 'createaccount', 'forgotpassword', 'votepositive', 'votenegative', 'plugin');
    $action = requestVar('action');

    if (in_array($action, $actionNames) ) {
        global $DIR_LIBS, $errormessage;
        include_once($DIR_LIBS . 'ACTION.php');
        $a = new ACTION();
        $errorInfo = $a->doAction($action);

        if ($errorInfo) {
            $errormessage = $errorInfo['message'];
        }
    }

    // show error when headers already sent out
    if (headers_sent() && $CONF['alertOnHeadersSent']) {

        headers_sent($hsFile, $hsLine);
        $extraInfo = ' in <code>' . $hsFile . '</code> line <code>' . $hsLine . '</code>';

        startUpError(
            '<p>The page headers have already been sent out' . $extraInfo . '. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the language file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>',
            'Page headers already sent'
        );
        exit;
    }

    // make is so ?archivelist without blogname or blogid shows the archivelist
    // for the default weblog
    if (serverVar('QUERY_STRING') == 'archivelist') {
        $archivelist = $CONF['DefaultBlog'];
    }

    // now decide which type of skin we need
    if ($itemid) {
        // itemid given -> only show that item
        $type = 'item';

        if (!$manager->existsItem($itemid,intval($CONF['allowFuture']),intval($CONF['allowDrafts'])) ) {
            doError(_ERROR_NOSUCHITEM);
        }

        global $itemidprev, $itemidnext, $catid, $itemtitlenext, $itemtitleprev;

        // 1. get timestamp, blogid and catid for item
        $query = sprintf("SELECT itime, iblog, icat FROM %s WHERE inumber='%d'" , sql_table('item'),intval($itemid));
        $res = sql_query($query);
        $obj = sql_fetch_object($res);

        // if a different blog id has been set through the request or selectBlog(),
        // deny access
        
        if ($blogid && (intval($blogid) != $obj->iblog) ) {
            doError(_ERROR_NOSUCHITEM);
        }

        // if a category has been selected which doesn't match the item, ignore the
        // category. #85
        if (($catid != 0) && ($catid != $obj->icat) ) {
            $catid = 0;
        }

        $blogid = $obj->iblog;
        $timestamp = strtotime($obj->itime);

        $b =& $manager->getBlog($blogid);

        if ($b->isValidCategory($catid) ) {
            $catextra = ' and icat=' . $catid;
        } else {
            $catextra = '';
        }

        // get previous itemid and title
        $query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime<' . mysqldate($timestamp) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime DESC LIMIT 1';
        $res = sql_query($query);

        if ($res && ($obj = sql_fetch_object($res))) {
            $itemidprev = $obj->inumber;
            $itemtitleprev = $obj->ititle;
        }

        // get next itemid and title
        $query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime>' . mysqldate($timestamp) . ' and itime <= ' . mysqldate($b->getCorrectTime()) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime ASC LIMIT 1';
        $res = sql_query($query);

        if ($res && ($obj = sql_fetch_object($res))) {
            $itemidnext = $obj->inumber;
            $itemtitlenext = $obj->ititle;
        }

    } elseif ($archive) {
        // show archive
        $type = 'archive';

        // get next and prev month links ...
        global $archivenext, $archiveprev, $archivetype, $archivenextexists, $archiveprevexists;

        // sql queries for the timestamp of the first and the last published item
        $blogid_tmp = (int)($blogid>0 ? $blogid : $CONF['DefaultBlog']);
        $query = sprintf("SELECT UNIX_TIMESTAMP(itime) as result FROM %s "
                       . " WHERE idraft=0 AND iblog='%d'",
                         sql_table('item'), $blogid_tmp);
        $first_timestamp = quickQuery ($query . " ORDER BY itime ASC LIMIT 1");
        $last_timestamp  = quickQuery ($query . " ORDER BY itime DESC LIMIT 1");

        $y = $m = $d = '';
        sscanf($archive, '%d-%d-%d', $y, $m, $d);

        if ($d != 0) {
            $archivetype = _ARCHIVETYPE_DAY;
            $t = mktime(0, 0, 0, $m, $d, $y);
            // one day has 24 * 60 * 60 = 86400 seconds
            $archiveprev = strftime('%Y-%m-%d', $t - 86400 );
            // check for published items
            if ($t > $first_timestamp) {
                $archiveprevexists = true;
            }
            else {
                $archiveprevexists = false;
            }

            // one day later
            $t += 86400;
            $archivenext = strftime('%Y-%m-%d', $t);
            if ($t < $last_timestamp) {
                $archivenextexists = true;
            }
            else {
                $archivenextexists = false;
            }

        } elseif ($m == 0) {
            $archivetype = _ARCHIVETYPE_YEAR;
            $t = mktime(0, 0, 0, 12, 31, $y - 1);
            // one day before is in the previous year
            $archiveprev = strftime('%Y', $t);
            if ($t > $first_timestamp) {
                $archiveprevexists = true;
            }
            else {
                $archiveprevexists = false;
            }

            // timestamp for the next year
            $t = mktime(0, 0, 0, 1, 1, $y + 1);
            $archivenext = strftime('%Y', $t);
            if ($t < $last_timestamp) {
                $archivenextexists = true;
            }
            else {
                $archivenextexists = false;
            }
        } else {
            $archivetype = _ARCHIVETYPE_MONTH;
            $t = mktime(0, 0, 0, $m, 1, $y);
            // one day before is in the previous month
            $archiveprev = strftime('%Y-%m', $t - 86400);
            if ($t > $first_timestamp) {
                $archiveprevexists = true;
            }
            else {
                $archiveprevexists = false;
            }

            // timestamp for the next month
            $t = mktime(0, 0, 0, $m+1, 1, $y);
            $archivenext = strftime('%Y-%m', $t);
            if ($t < $last_timestamp) {
                $archivenextexists = true;
            }
            else {
                $archivenextexists = false;
            }
        }

    } elseif ($archivelist) {
        $type = 'archivelist';

        if (is_numeric($archivelist)) {
            $blogid = intVal($archivelist);
        } else {
            $blogid = getBlogIDFromName($archivelist);
        }

        if (!$blogid) {
            doError(_ERROR_NOSUCHBLOG);
        }

    } elseif ($query) {
        global $startpos;
        $type = 'search';
        $query = stripslashes($query);

        if (function_exists('mb_convert_encoding'))
        {
            if (preg_match("/^(\xA1{2}|\xe3\x80{2}|\x20)+$/", $query)) {
                $type = 'index';
            }
    //		$query = mb_convert_encoding($query, _CHARSET, $order . ' JIS, SJIS, ASCII');
            switch(strtolower(_CHARSET)) {
                case 'utf-8':
                    $order = 'ASCII, UTF-8, EUC-JP, JIS, SJIS, EUC-CN, ISO-8859-1';
                    break;
                case 'gb2312':
                    $order = 'ASCII, EUC-CN, EUC-JP, UTF-8, JIS, SJIS, ISO-8859-1';
                    break;
                case 'shift_jis':
                    // Note that shift_jis is only supported for output.
                    // Using shift_jis in DB is prohibited.
                    $order = 'ASCII, SJIS, EUC-JP, UTF-8, JIS, EUC-CN, ISO-8859-1';
                    break;
                default:
                    // euc-jp,iso-8859-x,windows-125x
                    $order = 'ASCII, EUC-JP, UTF-8, JIS, SJIS, EUC-CN, ISO-8859-1';
                    break;
            }
            $query = mb_convert_encoding($query, _CHARSET, $order);
        }

        if (is_numeric($blogid)) {
            $blogid = intVal($blogid);
        } else {
            $blogid = getBlogIDFromName($blogid);
        }

        if (!$blogid) {
            doError(_ERROR_NOSUCHBLOG);
        }

    } elseif ($memberid) {
        $type = 'member';

        if (!MEMBER::existsID($memberid) ) {
            doError(_ERROR_NOSUCHMEMBER);
        }

        $memberinfo = $manager->getMember($memberid);

    } elseif ($imagepopup) {
        // media object (images etc.)
        $type = 'imagepopup';

        // TODO: check if media-object exists
        // TODO: set some vars?
    } else {
        // show regular index page
        global $startpos;
        $type = 'index';
    }

    // any type of skin with catid
    if ($catid && !$blogid) {
        $blogid = getBlogIDFromCatID($catid);
    }

    // decide which blog should be displayed
    if (!$blogid) {
        $blogid = $CONF['DefaultBlog'];
    }

    $b =& $manager->getBlog($blogid);
    $blog = $b; // references can't be placed in global variables?

    if (!$blog->isValid) {
        doError(_ERROR_NOSUCHBLOG);
    }

    // set catid if necessary
    if ($catid) {
        // check if the category is valid
        if (!$blog->isValidCategory($catid)) {
            doError(_ERROR_NOSUCHCATEGORY);
        } else {
            $blog->setSelectedCategory($catid);
        }
    }

    // decide which skin should be used
    if ($skinid != '' && ($skinid == 0) ) {
        selectSkin($skinid);
    }

    if (!$skinid) {
        $skinid = $blog->getDefaultSkin();
    }

	$skin_options = array('spartstype'=>'parts');

    //$special = requestVar('special'); //get at top of file as global
    if (!empty($special) && isValidSkinSpecialPageName($special)) {
        if (!$skinid)
            doError(_ERROR_SKIN);
        if (!$skinid || !SKIN::existsSpecialPageName($skinid, $special))
            doError(_ERROR_NOSUCHPAGE);
        $skin_options['spartstype'] = 'specialpage';
        $type = strtolower($special);
    }

    $skin = new SKIN($skinid);

    if (!$skin->isValid) {
        doError(_ERROR_NOSUCHSKIN);
    }
    
    // set global skinpart variable so can determine quickly what is being parsed from any plugin or phpinclude
	global $skinpart, $skin_sparts_type;
    $skinpart = $type;
	$skin_sparts_type = $skin_options['spartstype']; // parts or specialpage
    
    // parse the skin
	$skin->parse($type, $skin_options);

    // check to see we should throw JustPosted event
    $blog->checkJustPosted();
}

/**
  * Show error skin with given message. An optional skin-object to use can be given
  */
function doError($msg, $skin = '') {
    global $errormessage, $CONF, $skinid, $blogid, $manager;

    if ($skin == '') {

        if (SKIN::existsID($skinid) ) {
            $skin = new SKIN($skinid);
        } elseif ($manager->existsBlogID($blogid) ) {
            $blog =& $manager->getBlog($blogid);
            $skin = new SKIN($blog->getDefaultSkin() );
        } elseif ($CONF['DefaultBlog']) {
            $blog =& $manager->getBlog($CONF['DefaultBlog']);
            $skin = new SKIN($blog->getDefaultSkin() );
        } else {
            // this statement should actually never be executed
            $skin = new SKIN($CONF['BaseSkin']);
        }

    }

    if ($manager->existsBlogID($blogid) )
    {
        $blog =& $manager->getBlog($blogid);
        $CONF['SiteName'] = $blog->getName();
        $CONF['IndexURL'] = $blog->getURL();
    }

    $skinid = $skin->id;
    $errormessage = $msg;
    $skin->parse('error');
    exit;
}

function getConfig() {
    global $CONF;

    $query = sprintf('SELECT * FROM `%s`' , sql_table('config'));
    $res = sql_query($query);

    if ($res)
    while ($obj = sql_fetch_object($res) ) {
        if(!isset($CONF[$obj->name]))
            $CONF[$obj->name] = $obj->value;
    }
}

// some checks for names of blogs, categories, templates, members, ...
function isValidShortName($name) {
    return preg_match('#^[a-z0-9]+$#i', $name);
}

function isValidDisplayName($name) {
    return preg_match('#^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$#i', $name);
}

function isValidCategoryName($name) {
    return 1;
}

function isValidTemplateName($name) {
    return preg_match('#^[a-z0-9/]+$#i', $name);
}

function isValidSkinName($name) {
    return preg_match('#^[a-z0-9/]+$#i', $name);
}

function isValidSkinPartsName($name)
{
	return preg_match('#^[a-z0-9_\-]+$#i', $name);
}

function isValidSkinSpecialPageName($name)
{
	return preg_match('@^[^\?\/#]+$@i', $name);
}


// add and remove linebreaks
function addBreaks($var) {
    return nl2br($var);
}

function removeBreaks($var) {
    return preg_replace("/<br \/>([\r\n])/", "$1", $var);
}

// shortens a text string to maxlength ($toadd) is what needs to be added
// at the end (end length is <= $maxlength)
function shorten($text, $maxlength, $toadd) {
    $maxlength = intval($maxlength);
    // 1. remove entities...
    $trans = get_html_translation_table(HTML_ENTITIES);

    $trans = array_flip($trans);
    $text = strtr($text, $trans);

    // 2. the actual shortening
    if (strlen($text) > $maxlength) {
        if (function_exists('mb_strimwidth'))
            $text = mb_strimwidth($text, 0, $maxlength, $toadd, _CHARSET);
        else
            $text = substr($text, 0, $maxlength - strlen($toadd) ) . $toadd;

    }

    return $text;
}

/**
  * Converts a unix timestamp to a mysql DATETIME format, and places
  * quotes around it.
  */
function mysqldate($timestamp) {
    return "'" . date('Y-m-d H:i:s', $timestamp) . "'";
}

/**
  * functions for use in index.php
  */
function selectBlog($shortname) {
    global $blogid, $archivelist;

    $blogid = intval($blogid);
    if (!($blogid > 0)) {
        $blogid = getBlogIDFromName($shortname);
    }

    // also force archivelist variable, if it is set
    if ($archivelist) {
        $archivelist = $blogid;
    }
}

function selectSkin($skinname) {
    global $skinid;
    $skinid = SKIN::getIdFromName($skinname);
}

/**
 * Can take either a category ID or a category name (be aware that
 * multiple categories can have the same name)
 */
function selectCategory($cat) {
    global $catid;
    if (is_numeric($cat) ) {
        $catid = intval($cat);
    } else {
        $catid = getCatIDFromName($cat);
    }
}

function selectItem($id) {
    global $itemid;
    $itemid = intval($id);
}

// force the use of a language file (warning: can cause warnings)
function selectLanguage($language) {

    global $DIR_LANG;

    # important note that '\' must be matched with '\\\\' in preg* expressions

    include_once($DIR_LANG . str_replace(array('\\','/'), '', $language) . '.php');

}

function parseFile($filename, $includeMode = 'normal', $includePrefix = '') {
    $handler = new ACTIONS('fileparser');
    $parser = new PARSER(SKIN::getAllowedActionsForType('fileparser'), $handler);
    $handler->parser =& $parser;

    // set IncludeMode properties of parser
    PARSER::setProperty('IncludeMode', $includeMode);
    PARSER::setProperty('IncludePrefix', $includePrefix);

    if (!file_exists($filename) ) {
        if (defined('_GFUNCTIONS_PARSEFILE_FILEMISSING'))
            doError(_GFUNCTIONS_PARSEFILE_FILEMISSING);
        else
            doError('A file is missing');
    }

    $fsize = filesize($filename);

    if ($fsize <= 0) {
        return;
    }

    // read file
    $fd = fopen ($filename, 'r');
    $contents = fread ($fd, $fsize);
    fclose ($fd);

    // parse file contents
    $parser->parse($contents);
}

/**
  * Outputs a debug message
  */
function debug($msg) {
    echo '<p><b>' . $msg . "</b></p>\n";
}

// shortcut
function addToLog($level, $msg) {
    ACTIONLOG::add($level, $msg);
}

// shows a link to help file
function help($id) {
    echo helpHtml($id);
}

function helpHtml($id) {
    global $CONF;
    return helplink($id) . '<img src="' . $CONF['AdminURL'] . 'documentation/icon-help.gif" width="15" height="15" alt="' . _HELP_TT . '" title="' . _HELP_TT . '" /></a>';
}

function helplink($id) {
    global $CONF;

    $doc_root = get_help_root_url(TRUE);

    return '<a href="' . $doc_root . 'help.html#'. $id . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);">';
}

function get_help_root_url($subdir_search = FALSE) {
    global $CONF, $DIR_NUCLEUS;

    static $doc_root = array();
    $key = $subdir_search ? 1 : 0;
    if (!isset($doc_root[$key]))
    {
        $doc_root[$key] = $CONF['AdminURL'] . 'documentation/';
        if ($subdir_search)
        {
            $lang = getLanguageName();
            $items = array('japan'=>'ja', 'english'=>'en');
            foreach($items as $k => $v)
            {
                if ((@stripos($lang , $k) !== false) && (is_dir($DIR_NUCLEUS . "documentation/" . $v)))
                {
                    $doc_root[$key] .= $v . '/';
                    break;
                }
            }
        }
    }
    return $doc_root[$key];
}

function getMailFooter() {
    $message = "\n\n-----------------------------";
    $message .=  "\n   Powered by Nucleus CMS";
    $message .=  "\n(http://www.nucleuscms.org/)";
    return $message;
}

/**
  * Returns the name of the language to use
  * preference priority: member - site
  * defaults to english when no good language found
  *
  * checks if file exists, etc...
  */
function getLanguageName() {
    global $CONF, $member;

    LoadCoreLanguage();

    if ($member && $member->isLoggedIn() ) {
        // try to use members language
        $memlang = $member->getLanguage();

        if (($memlang != '') && (checkLanguage($memlang) ) ) {
            return $memlang;
        }
    }

    // use default language
    if (checkLanguage($CONF['Language']) ) {
        return $CONF['Language'];
    } else {
        return 'english';
    }
}

function LoadCoreLanguage()
{
    static $loaded = FALSE;
    if ($loaded)
        return;
    $loaded = TRUE;

    global $DIR_LANG;
    $language = remove_all_directory_separator(getLanguageName());
    $language = getValidLanguage($language);
    $filename = $DIR_LANG . $language . '.php';
    if (file_exists($filename))
        include_once ($filename);

    if ((!defined('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM'))
         && (defined('_CHARSET') && (strtoupper(_CHARSET) == 'UTF-8')))
    {
        // load undefined constant
        if ((stripos($language, 'english')===false) && (stripos($language, 'japan')===false))
        {
            if (@is_file($DIR_LANG . 'english-utf8' . '.php'))
            {
                // load default lang
                ob_start();
                @include_once($DIR_LANG . 'english-utf8' . '.php');
                ob_end_clean();
            }
        }
    }
    sql_set_charset_v2(_CHARSET);

    ini_set('default_charset', _CHARSET);
    if (_CHARSET != 'UTF-8' && function_exists('mb_http_output'))
    {
//        ini_set('default_charset', ''); // To suppress the content type of http header
//        mb_internal_encoding(_CHARSET);
    }
}

/**
  * Includes a PHP file. This method can be called while parsing templates and skins
  */
function includephp($filename)
{
    // make predefined variables global, so most simple scripts can be used here

    // apache (names taken from PHP doc)
    global $GATEWAY_INTERFACE, $SERVER_NAME, $SERVER_SOFTWARE, $SERVER_PROTOCOL;
    global $REQUEST_METHOD, $QUERY_STRING, $DOCUMENT_ROOT, $HTTP_ACCEPT;
    global $HTTP_ACCEPT_CHARSET, $HTTP_ACCEPT_ENCODING, $HTTP_ACCEPT_LANGUAGE;
    global $HTTP_CONNECTION, $HTTP_HOST, $HTTP_REFERER, $HTTP_USER_AGENT;
    global $REMOTE_ADDR, $REMOTE_PORT, $SCRIPT_FILENAME, $SERVER_ADMIN;
    global $SERVER_PORT, $SERVER_SIGNATURE, $PATH_TRANSLATED, $SCRIPT_NAME;
    global $REQUEST_URI;

    // php (taken from PHP doc)
    global $argv, $argc, $PHP_SELF;

    // other
    global $PATH_INFO, $HTTPS, $HTTP_RAW_POST_DATA, $HTTP_X_FORWARDED_FOR;

    if (@file_exists($filename) ) {
        include_once($filename);
    }
}

/**
 * Checks if a certain language exists
 * @param string $lang
 * @return bool
 **/
function checkLanguage($lang) {
    global $DIR_LANG;
    # important note that '\' must be matched with '\\\\' in preg* expressions

    return file_exists($DIR_LANG . remove_all_directory_separator($lang) . '.php');
}

/**
 * Checks if a certain plugin exists
 * @param string $plug
 * @return bool
 **/
function checkPlugin($plug) {
    global $DIR_PLUGINS;

    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    $pl_name = remove_all_directory_separator($plug);
    $shortname = strtolower(preg_replace('#^NP_#', '', $plug));
    $fname = $pl_name . '.php';
    foreach(array($fname, "{$shortname}/{$fname}", "{$pl_name}/{$fname}") as $f)
    if (file_exists($DIR_PLUGINS . $f))
    {
        return TRUE;
    }
    return FALSE;
}

function remove_all_directory_separator($text)
{
  	return str_replace( array("\\" ,'/' , DIRECTORY_SEPARATOR ) , '' , $text);
}

/**
  * Centralisation of the functions that generate links
  */
function createItemLink($itemid, $extra = '') {
    return createLink('item', array('itemid' => $itemid, 'extra' => $extra) );
}

function createMemberLink($memberid, $extra = '') {
    return createLink('member', array('memberid' => $memberid, 'extra' => $extra) );
}

function createCategoryLink($catid, $extra = '') {
    return createLink('category', array('catid' => $catid, 'extra' => $extra) );
}

function createArchiveListLink($blogid = '', $extra = '') {
    return createLink('archivelist', array('blogid' => $blogid, 'extra' => $extra) );
}

function createArchiveLink($blogid, $archive, $extra = '') {
    return createLink('archive', array('blogid' => $blogid, 'archive' => $archive, 'extra' => $extra) );
}

function createBlogidLink($blogid, $params = '') {
    return createLink('blog', array('blogid' => $blogid, 'extra' => $params) );
}

function createLink($type, $params) {
    global $manager, $CONF;

    $generatedURL = '';
    $usePathInfo = ($CONF['URLMode'] == 'pathinfo');

    // ask plugins first
    $created = false;
    $url     = '';

    if ($usePathInfo) {
        $param = array(
            'type'        =>  $type,
            'params'    =>  $params,
            'completed'    => &$created,
            'url'        => &$url
        );
        $manager->notify('GenerateURL', $param);
    }

    // if a plugin created the URL, return it
    if ($created) {
        return $url;
    }

    // default implementation
    switch ($type) {
        case 'item':
            if ($usePathInfo) {
                $url = $CONF['ItemURL'] . '/' . $CONF['ItemKey'] . '/' . $params['itemid'];
            } else {
                $url = $CONF['ItemURL'] . '?itemid=' . $params['itemid'];
            }
            break;

        case 'member':
            if ($usePathInfo) {
                $url = $CONF['MemberURL'] . '/' . $CONF['MemberKey'] . '/' . $params['memberid'];
            } else {
                $url = $CONF['MemberURL'] . '?memberid=' . $params['memberid'];
            }
            break;

        case 'category':
            if ($usePathInfo) {
                $url = $CONF['CategoryURL'] . '/' . $CONF['CategoryKey'] . '/' . $params['catid'];
            } else {
                $url = $CONF['CategoryURL'] . '?catid=' . $params['catid'];
            }
            break;

        case 'archivelist':
            if (!$params['blogid']) {
                $params['blogid'] = $CONF['DefaultBlog'];
            }

            if ($usePathInfo) {
                $url = $CONF['ArchiveListURL'] . '/' . $CONF['ArchivesKey'] . '/' . $params['blogid'];
            } else {
                $url = $CONF['ArchiveListURL'] . '?archivelist=' . $params['blogid'];
            }
            break;

        case 'archive':
            if ($usePathInfo) {
                $url = $CONF['ArchiveURL'] . '/' . $CONF['ArchiveKey'] . '/'.$params['blogid'].'/' . $params['archive'];
            } else {
                $url = $CONF['ArchiveURL'] . '?blogid='.$params['blogid'].'&amp;archive=' . $params['archive'];
            }
            break;

        case 'blog':
            if ($usePathInfo) {
                $url = $CONF['BlogURL'] . '/' . $CONF['BlogKey'] . '/' . $params['blogid'];
            } else {
                global $blogid;
                if ($blogid == $params['blogid'] && ($CONF['BlogURL'] != 'index.php'))
                    $url = $CONF['BlogURL']  . '?blogid=' . $params['blogid'];
                else
                    $url = $CONF['IndexURL'] . '?blogid=' . $params['blogid'];
            }
            break;
    }

    return addLinkParams($url, (isset($params['extra'])? $params['extra'] : null));
}

function createBlogLink($url, $params) {
    global $CONF;
    if ($CONF['URLMode'] == 'normal') {
        if (strpos($url, '?') === FALSE && is_array($params)) {
            $fParam = reset($params);
            $fKey   = key($params);
            array_shift($params);
            $url .= '?' . $fKey . '=' . $fParam;
        }
    } elseif ($CONF['URLMode'] == 'pathinfo' && substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
    }
    return addLinkParams($url, $params);
}

function addLinkParams($link, $params) {
    global $CONF;

	if ( is_array($params) && (count($params) > 0) )
	{

        if ($CONF['URLMode'] == 'pathinfo') {
            foreach ($params as $param => $value) {
                // change in 3.63 to fix problem where URL generated with extra params mike look like category/4/blogid/1
                // but they should use the URL keys like this: category/4/blog/1
                // if user wants old urls back, set $CONF['NoURLKeysInExtraParams'] = 1; in config.php
                if (isset($CONF['NoURLKeysInExtraParams']) && $CONF['NoURLKeysInExtraParams'] == 1) 
                {
                    $link .= '/' . $param . '/' . urlencode($value);
                } else {
                    switch ($param) {
                        case 'itemid':
                            $link .= '/' . $CONF['ItemKey'] . '/' . urlencode($value);
                        break;
                        case 'memberid':
                            $link .= '/' . $CONF['MemberKey'] . '/' . urlencode($value);
                        break;
                        case 'catid':
                            $link .= '/' . $CONF['CategoryKey'] . '/' . urlencode($value);
                        break;
                        case 'archivelist':
                            $link .= '/' . $CONF['ArchivesKey'] . '/' . urlencode($value);
                        break;
                        case 'archive':
                            $link .= '/' . $CONF['ArchiveKey'] . '/' . urlencode($value);
                        break;
                        case 'blogid':
                            $link .= '/' . $CONF['BlogKey'] . '/' . urlencode($value);
                        break;
                        default:
                            $link .= '/' . $param . '/' . urlencode($value);
                        break;
                    }
                }
            }
        } else {

            foreach ($params as $param => $value) {
                $link .= '&amp;' . $param . '=' . urlencode($value);
            }

        }
    }

    return $link;
}

/**
 * @param $querystr
 *        querystring to alter (e.g. foo=1&bar=2&x=y)
 * @param $param
 *        name of parameter to change (e.g. 'foo')
 * @param $value
 *        New value for that parameter (e.g. 3)
 * @result
 *        altered query string (for the examples above: foo=3&bar=2&x=y)
 */
function alterQueryStr($querystr, $param, $value) {
    $vars = explode('&', $querystr);
    $set  = false;

    for ($i = 0; $i < count($vars); $i++) {
        $v = explode('=', $vars[$i]);

        if ($v[0] == $param) {
            $v[1] = $value;
            $vars[$i] = implode('=', $v);
            $set = true;
            break;
        }
    }

    if (!$set) {
        $vars[] = $param . '=' . $value;
    }

    return ltrim(implode('&', $vars), '&');
}

// passes one variable as hidden input field (multiple fields for arrays)
// @see passRequestVars in varsx.x.x.php
function passVar($key, $value) {
    // array ?
    if (is_array($value) ) {
        for ($i = 0; $i < sizeof($value); $i++) {
            passVar($key . '[' . $i . ']', $value[$i]);
        }

        return;
    }

    // other values: do stripslashes if needed
    ?><input type="hidden" name="<?php echo hsc($key)?>" value="<?php echo hsc(undoMagic($value) )?>" /><?php
}

/*
    Date format functions (to be used from [%date(..)%] skinvars
*/
function formatDate($format, $timestamp, $defaultFormat, &$blog) {
    // apply blog offset (#42)
    $boffset = $blog ? $blog->getTimeOffset() * 3600 : 0;
    $offset = date('Z', $timestamp) + $boffset;

    switch ($format) {
        case 'rfc822':
            if ($offset >= 0) {
                $tz = '+';
            } else {
                $tz = '-';
                $offset = -$offset;
            }

            $tz .= sprintf("%02d%02d", floor($offset / 3600), round(($offset % 3600) / 60) );
            return date('D, j M Y H:i:s ', $timestamp) . $tz;

        case 'rfc822GMT':
            $timestamp -= $offset;
            return date('D, j M Y H:i:s ', $timestamp) . 'GMT';

        case 'utc':
            $timestamp -= $offset;
            return date('Y-m-d\TH:i:s\Z', $timestamp);

        case 'iso8601':
            if ($offset >= 0) {
                $tz = '+';
            } else {
                $tz = '-';
                $offset = -$offset;
            }

            $tz .= sprintf("%02d:%02d", floor($offset / 3600), round(($offset % 3600) / 60) );
            return date('Y-m-d\TH:i:s', $timestamp) . $tz;

        default :
            return Utils::strftime($format ? $format : $defaultFormat, $timestamp);
    }
}

function checkVars($aVars) {

    foreach ($aVars as $varName) {
        if (   isset($_GET[$varName])
            || isset($_POST[$varName])
            || isset($_COOKIE[$varName])
            || isset($_ENV[$varName])
            || isset($_SESSION[$varName])
            || isset($_FILES[$varName])
        ) {
            die('Sorry. An error occurred.');
        }
    }
}

/**
 * Sanitize parameters such as $_GET and $_SERVER['REQUEST_URI'] etc.
 * to avoid XSS
 */
function sanitizeParams()
{
    $array = array();
    $str = '';
    $frontParam = '';

    // REQUEST_URI of $_SERVER
        $str =& $_SERVER["REQUEST_URI"];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);

    // QUERY_STRING of $_SERVER
    unset($str);
        $str =& $_SERVER["QUERY_STRING"];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);

    // $_GET
    convArrayForSanitizing($_GET, $array);
    sanitizeArray($array);
    revertArrayForSanitizing($array, $_GET);

    // $_REQUEST (only GET param)
    convArrayForSanitizing($_REQUEST, $array);
    sanitizeArray($array);
    revertArrayForSanitizing($array, $_REQUEST);
}

/**
 * Check ticket when not checked in plugin's admin page
 * to avoid CSRF.
 * Also avoid the access to plugin/index.php by guest user.
 */
function ticketForPlugin() {
    global $CONF, $DIR_PLUGINS, $member, $ticketforplugin;

    /* initialize */
    $ticketforplugin = array();
    $ticketforplugin['ticket'] = FALSE;
    
    /* Check if using plugin's php file. */
    if ($p_translated = serverVar('PATH_TRANSLATED') )
    {
        if (!file_exists($p_translated) )
        {
            $p_translated = '';
        }
    }
    
    if (!$p_translated)
    {
        $p_translated = serverVar('SCRIPT_FILENAME');
        if (!file_exists($p_translated) )
        {
            header("HTTP/1.0 404 Not Found");
            exit('');
        }
    }
    
    $p_translated = str_replace('\\', '/', $p_translated);
    $d_plugins = str_replace('\\', '/', $DIR_PLUGINS);
    
    if (strpos($p_translated, $d_plugins) !== 0)
    {
        return;// This isn't plugin php file.
    }
    
    /* Solve the plugin php file or admin directory */
    $phppath = substr($p_translated, strlen($d_plugins) );
    $phppath = preg_replace('#^/#', '', $phppath); // Remove the first "/" if exists.

    // NP_Plugin.php , plugin/* , NP_Plugin/NP_Plugin.php
//	var_dump(__FUNCTION__, $phppath);
    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    $path = $phppath;
    if ( preg_match('#^NP_([^/]+)(/|$)#', $path, $m) || preg_match('#^[^/]*/+NP_([^/]+)(/|$)#', $path, $m) )
    {
        // Remove the first "NP_" and the last ".php" if exists.
        $unsecure_value = preg_replace('#\.php$#', '', $m[1]);
        $unsecure_plugin_name = $unsecure_value;
        $unsecure_plugin_name_short = strtolower($unsecure_value);
    }
    else
    {
        $unsecure_value = preg_replace('#(?:^|.+/)NP_([^/]*)\.php$#', '$1', $path); // Remove the first "NP_" and the last ".php" if exists.
        $unsecure_value = preg_replace('#^([^/]*)/(.*)$#', '$1', $unsecure_value); // Remove the "/" and beyond.
        $unsecure_plugin_name = $unsecure_value;
        $unsecure_plugin_name_short = strtolower($unsecure_value);
    }
//	var_dump(__FUNCTION__, $path);

    /* Solve the plugin name. */
    $plugins = array();
    $query = 'SELECT `pfile` FROM '.sql_table('plugin');
    $res = sql_query($query);

    if ($res)
    {
        while($row = sql_fetch_row($res) )
        {
            $name = substr($row[0], 3);
            $plugins[strtolower($name)] = $name;
        }
        sql_free_result($res);
    }
    
    if ($plugins[$unsecure_plugin_name_short])
    {
        $plugin_name = $plugins[$unsecure_plugin_name_short];
    }
    else if (in_array($unsecure_plugin_name_short, $plugins))
    {
        $plugin_name = $unsecure_plugin_name_short;
    }
    else
    {
        header("HTTP/1.0 404 Not Found");
        exit('');
    }
    
    /* Return if not index.php */
    if ( ($phppath != strtolower($plugin_name) . '/') && ($phppath != strtolower($plugin_name) . '/index.php') )
    {
        return;
    }

    /* Exit if not logged in. */
    if ( !$member->isLoggedIn() )
    {
        LoadCoreLanguage();
		if (!defined('_GFUNCTIONS_YOU_AERNT_LOGGEDIN'))
			define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN', 'You aren\'t logged in.');
		exit("<html><head><title>Error</title></head><body>"
				. _GFUNCTIONS_YOU_AERNT_LOGGEDIN
				. "<br><br>\n"
				. '<a href="javascript: back();">back</a>'
				. "</body></html>");
    }

    global $manager,$DIR_LIBS,$DIR_LANG;

    /* Check if this feature is needed (ie, if "$manager->checkTicket()" is not included in the script). */
    if (!($p_translated=serverVar('PATH_TRANSLATED')))
    {
        $p_translated=serverVar('SCRIPT_FILENAME');
    }
    if ($file = @file($p_translated) )
    {
        $prevline='';
        foreach($file as $line)
        {
            if (preg_match('/[\$]manager([\s]*)[\-]>([\s]*)checkTicket([\s]*)[\(]/i',$prevline.$line))
            {
                return;
            }
            $prevline=$line;
        }
    }
    
    /* Show a form if not valid ticket */
    if ( ( strstr(serverVar('REQUEST_URI'),'?') || serverVar('QUERY_STRING')
            || strtoupper(serverVar('REQUEST_METHOD'))=='POST' )
                && (!$manager->checkTicket()) )
    {
        if (!class_exists('PluginAdmin'))
        {
            LoadCoreLanguage();
            include_once($DIR_LIBS . 'PLUGINADMIN.php');
        }
        
        $oPluginAdmin = new PluginAdmin($plugin_name);
        $oPluginAdmin->start();
        echo '<p>' . _ERROR_BADTICKET . "</p>\n";

        /* Show the form to confirm action */
        
        // Resolve URI and QUERY_STRING
        if ($uri=serverVar('REQUEST_URI'))
        {
            list($uri,$qstring)=explode('?',$uri);
        }
        else
        {
            if ( !($uri=serverVar('PHP_SELF')) )
            {
                $uri=serverVar('SCRIPT_NAME');
            }
            $qstring=serverVar('QUERY_STRING');
        }
        if ($qstring)
        {
            $qstring='?'.$qstring;
        }
        echo '<p>'._SETTINGS_UPDATE.' : '._QMENU_PLUGINS.' <span style="color:red;">'.hsc($plugin_name)."</span> ?</p>\n";
        switch(strtoupper(serverVar('REQUEST_METHOD')))
        {
            case 'POST':
                echo '<form method="POST" action="'.hsc($uri.$qstring).'">';
                $manager->addTicketHidden();
                $post= $_POST;
                _addInputTags($post);
                break;
            case 'GET':
                echo '<form method="GET" action="'.hsc($uri).'">';
                $manager->addTicketHidden();
                $get=  $_GET;
                _addInputTags($get);
            default:
                break;
        }
        echo '<input type="submit" value="'._YES.'" />&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<input type="button" value="'._NO.'" onclick="history.back(); return false;" />';
        echo "</form>\n";

        $oPluginAdmin->end();
        exit;
    }

    /* Create new ticket */
    $ticket=$manager->addTicketToUrl('');
    $ticketforplugin['ticket']=substr($ticket,strpos($ticket,'ticket=')+7);
}
function _addInputTags(&$keys,$prefix=''){
    foreach($keys as $key=>$value){
        if ($prefix) $key=$prefix.'['.$key.']';
        if (is_array($value)) _addInputTags($value,$key);
        else {
            if (get_magic_quotes_gpc()) $value=stripslashes($value);
            if ($key=='ticket') continue;
            echo '<input type="hidden" name="'.hsc($key).
                '" value="'.hsc($value).'" />'."\n";
        }
    }
}

/**
 * Convert the server string such as $_SERVER['REQUEST_URI']
 * to arry like arry['blogid']=1 and array['page']=2 etc.
 */
function serverStringToArray($str, &$array, &$frontParam)
{
    // init param
    $array = array();
    $fronParam = "";

    // split front param, e.g. /index.php, and others, e.g. blogid=1&page=2
    if (strstr($str, "?")){
        list($frontParam, $args) = preg_split("/\?/", $str, 2);
    }
    else {
        $args = $str;
        $frontParam = "";
    }

    // If there is no args like blogid=1&page=2, return
    if (!strstr($str, "=") && !strlen($frontParam)) {
        $frontParam = $str;
        return;
    }

    $array = explode("&", $args);
}

/**
 * Convert array like array['blogid'] to server string
 * such as $_SERVER['REQUEST_URI']
 */
function arrayToServerString($array, $frontParam, &$str)
{
    if (strstr($str, "?")) {
        $str = $frontParam . "?";
    } else {
        $str = $frontParam;
    }
    if (count($array)) {
        $str .= implode("&", $array);
    }
}

/**
 * Sanitize array parameters.
 * This function checks both key and value.
 * - check key if it inclues " (double quote),  remove from array
 * - check value if it includes \ (escape sequece), remove remaining string
 */
function sanitizeArray(&$array)
{
    $excludeListForSanitization = array('query');
//    $excludeListForSanitization = array();

    foreach ($array as $k => $v) {

        // split to key and value
        list($key, $val) = preg_split("/=/", $v, 2);
        if (!isset($val)) {
            continue;
        }

        // when magic quotes is on, need to use stripslashes,
        // and then addslashes
        if (get_magic_quotes_gpc()) {
            $val = stripslashes($val);
        }
        // note that we must use addslashes here because this function is called before the db connection is made
        // and sql_real_escape_string needs a db connection
        $val = addslashes($val);

        // if $key is included in exclude list, skip this param
        if (!in_array($key, $excludeListForSanitization)) {

            // check value
            if (strpos($val, '\\')) {
                list($val, $tmp) = explode('\\', $val);
            }

            // remove control code etc.
            $val = strtr($val, "\0\r\n<>'\"", "       ");

            // check key
            if (preg_match('/\"/i', $key)) {
                unset($array[$k]);
                continue;
            }

            // set sanitized info
            $array[$k] = sprintf("%s=%s", $key, $val);
        }
    }
}

/**
 * Convert array for sanitizeArray function
 */
function convArrayForSanitizing($src, &$array)
{
    $array = array();
    foreach ($src as $key => $val) {
        if (key_exists($key, $_GET)) {
            array_push($array, sprintf("%s=%s", $key, $val));
        }
    }
}

/**
 * Revert array after sanitizeArray function
 */
function revertArrayForSanitizing($array, &$dst)
{
    foreach ($array as $v) {
        list($key, $val) = preg_split("/=/", $v, 2);
        $dst[$key] = $val;
    }
}

/**
 * Stops processing the request and redirects to the given URL.
 * - no actual contents should have been sent to the output yet
 * - the URL will be stripped of illegal or dangerous characters
 */
function redirect($url) {
    $url = preg_replace('|[^a-z0-9-~+_.?#=&;,/:@%*]|i', '', $url);
    header('Location: ' . $url);
    exit;
}

/**
 * Strip HTML tags from a string
 * This function is a bit more intelligent than a regular call to strip_tags(),
 * because it also deletes the contents of certain tags and cleans up any
 * unneeded whitespace.
 */
function stringStripTags ($string) {
    $string = preg_replace("/<del[^>]*>.+<\/del[^>]*>/isU", '', $string);
    $string = preg_replace("/<script[^>]*>.+<\/script[^>]*>/isU", '', $string);
    $string = preg_replace("/<style[^>]*>.+<\/style[^>]*>/isU", '', $string);
    $string = str_replace('>', '> ', $string);
    $string = str_replace('<', ' <', $string);
    $string = strip_tags($string);
    $string = preg_replace("/\s+/", " ", $string);
    $string = trim($string);
    return $string;
}

/**
 * Make a string containing HTML safe for use in a HTML attribute
 * Tags are stripped and entities are normalized
 */
function stringToAttribute ($string) {
    $string = stringStripTags($string);
    $string = entity::named_to_numeric($string);
    $string = entity::normalize_numeric($string);

    if (strtoupper(_CHARSET) == 'UTF-8') {
        $string = entity::numeric_to_utf8($string);
    }

    $string = entity::specialchars($string, 'html');
    $string = entity::numeric_to_named($string);
    return $string;
}

/**
 * Make a string containing HTML safe for use in a XML document
 * Tags are stripped, entities are normalized and named entities are
 * converted to numeric entities.
 */
function stringToXML ($string) {
    $string = stringStripTags($string);
    $string = entity::named_to_numeric($string);
    $string = entity::normalize_numeric($string);

    if (strtoupper(_CHARSET) == 'UTF-8') {
        $string = entity::numeric_to_utf8($string);
    }

    $string = entity::specialchars($string, 'xml');
    return $string;
}

// START: functions from the end of file BLOG.php
// used for mail notification (html -> text)
function toAscii($html) {
    // strip off most tags
    $html = strip_tags($html,'<a>');
    $to_replace = "/<a[^>]*href=[\"\']([^\"^']*)[\"\'][^>]*>([^<]*)<\/a>/i";
    _links_init();
    $ascii = preg_replace_callback ($to_replace, '_links_add', $html);
    $ascii .= "\n\n" . _links_list();
    return strip_tags($ascii);
}

function _links_init() {
   global $tmp_links;
   $tmp_links = array();
}

function _links_add($match) {
   global $tmp_links;
   array_push($tmp_links, $match[1]);
   return $match[2] . ' [' . sizeof($tmp_links) .']';
}

function _links_list() {
   global $tmp_links;
   $output = '';
   $i = 1;
   foreach ($tmp_links as $current) {
      $output .= "[$i] $current\n";
      $i++;
   }
   return $output;
}
// END: functions from the end of file BLOG.php

// START: functions from the end of file ADMIN.php
/**
 * @todo document this
 */
function encode_desc(&$data)
{
    $to_entities = get_html_translation_table(HTML_ENTITIES);

    $from_entities = array_flip($to_entities);

    $data = strtr($data,$from_entities);
    $data = strtr($data,$to_entities);

    return $data;
}

/**
 * Returns the Javascript code for a bookmarklet that works on most modern browsers
 *
 * @param blogid
 */
function getBookmarklet($blogid) {
    global $CONF;

    // normal
    $document = 'document';
    $bookmarkletline = "javascript:Q='';x=".$document.";y=window;if(x.selection){Q=x.selection.createRange().text;}else if(y.getSelection){Q=y.getSelection();}else if(x.getSelection){Q=x.getSelection();}wingm=window.open('";
    $bookmarkletline .= $CONF['AdminURL'] . "bookmarklet.php?blogid=$blogid";
    $bookmarkletline .="&logtext='+escape(Q)+'&loglink='+escape(x.location.href)+'&loglinktitle='+escape(x.title),'nucleusbm','scrollbars=yes,width='+window.parent.screen.width*0.9+',height='+window.parent.screen.height*0.9+',left=10,top=10,status=yes,resizable=yes');wingm.focus();";

    return $bookmarkletline;
}
// END: functions from the end of file ADMIN.php

/**
 * Returns a variable or null if not set
 *
 * @param mixed Variable
 * @return mixed Variable
 */
function ifset(&$var)
{
	return isset($var) ? $var : null;
}

/**
 * Returns number of subscriber to an event
 *
 * @param event
 * @return number of subscriber(s)
 */
function numberOfEventSubscriber($event) {
    $query = sprintf("SELECT COUNT(*) as count FROM `%s` WHERE event='%s'", sql_table('plugin_event'), $event);
    $res = sql_query($query);
    if ($res && ($obj = sql_fetch_object($res)))
        return $obj->count;
    return 0; // unknown error
}

/**
 * sets $special global variable for use in index.php before selector()
 *
 * @param String id
 * @return nothing
 */
function selectSpecialSkinType($id) {
    global $special;
    $special = strtolower($id);
}

/**
 * cleans filename of uploaded file for writing to file system
 *
 * @param String str
 * @return String cleaned filename ready for use
 */
function cleanFileName($str) {
    $str = strtolower($str);
    $ext_point = strrpos($str,".");
    if ($ext_point===false) return false;
    $ext = substr($str,$ext_point,strlen($str));
    $str = substr($str,0,$ext_point);

    return preg_replace("/[^a-z0-9-]/","_",$str).$ext;
}

function escapeHTML($string,  $flags = ENT_QUOTES )
{
    return htmlspecialchars( $string , $flags , (defined('_CHARSET') ? _CHARSET : 'UTF-8') );
}

function hsc($string, $flags=ENT_QUOTES, $encoding='') {
    if($encoding==='')
    {
        if(defined('_CHARSET')) $encoding = _CHARSET;
        else                    $encoding = 'utf-8';
    }
    if(version_compare(PHP_VERSION, '5.2.3', '>='))
        return htmlspecialchars($string, $flags, $encoding, false);
    else
    {
        if(function_exists('htmlspecialchars_decode'))
            $string = htmlspecialchars_decode($string, $flags);
        else
            $string = strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
        
        return htmlspecialchars($string, $flags, $encoding);
    }
}

function nucleus_version_compare($version1, $version2, $operator = '')
{
    // examples: 3.66  3.7  v3.7 v3.71
    $args = func_get_args();
    for($i = 0; $i<=1; $i++)
    {
        $args[$i] = str_replace(array('_','-','+','/'), '.', $args[$i]);
        $args[$i] = preg_replace('#^[^0-9]+#', '', $args[$i]);
        $ver = explode('.', $args[$i]);
        $major = intval($ver[0]);
        if ($major <= 3)
        {   // minor version
            $x = @intval($ver[1]);
            if ($x >= 10)
                $ver[1] = sprintf('%d.%d', $x / 10 , $x % 10);
            else
                $ver[1] = sprintf('%d.0', $x);
        }
        $args[$i] = implode('.', $ver);
    }
    return call_user_func_array('version_compare', $args);
}

// getPluginListsFromDirName
// Note: This function will may be specification change
// Note: use only core functions
// Notice: Do not call this function from user plugin
// return Plugin Lists on SearchDir
// mode  1 , 2 : all $lists
function getPluginListsFromDirName($SearchDir , &$status, $clearcache = FALSE)
{
    static $lists = array();

    $status = array('result'=>FALSE);
    $SearchDir = str_replace("\\", '/', $SearchDir);
    if ( strlen($SearchDir)>0 && substr($SearchDir, -1, 1)!='/' )
        $SearchDir .= '/';

    if ( $clearcache && isset($lists[$SearchDir]) )
         unset($lists[$SearchDir]);
    if ( isset($lists[$SearchDir]) )
    {
        $status = array('result'=>TRUE, 'is_cache'=>TRUE);
        return $lists[$SearchDir];
    }
    if ( !is_dir($SearchDir) )
        return FALSE;

    $lists[$SearchDir] = array();
    $items = &$lists[$SearchDir];

    $dirhandle = opendir($SearchDir);
    if ($dirhandle === FALSE)
        return FALSE;

    $status['is_cache'] = FALSE;
    $status['result']   = TRUE;

    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    while ( false !== ($filename = readdir($dirhandle)) )
    {
        $current_file = $SearchDir . $filename;
        $pattern_php = '#^NP_(.*)\.php$#';
        $pattern = '#^NP_(.*)$#';
        $item = array();

        $saved_type = 0;
        if (is_file($current_file))
        {  // NP_*.php
            // type 1 , old_admin_area
            if (!preg_match($pattern_php, $filename, $matches))
                continue;
            $saved_type = 1;
            $name = $matches[1];
            $saved_type = 1;
            $item['dir'] = $SearchDir;
            $item['dir_admin'] = $SearchDir . strtolower($name) . '/';
            $item['php'] = $SearchDir . $filename;
        }
        else
        {  // directory
            if ($filename == '.' || $filename == '..')
                continue;
            if ( preg_match($pattern, $filename, $matches) )
            {
                // type 4 or 5
                $name = $matches[1];
                $pl_own_dir  = $current_file . '/';
                $pl_own_dir_plfile = $pl_own_dir . $filename . '.php';
                if (! (is_dir($pl_own_dir) && (is_file($pl_own_dir_plfile))) )
                    continue;
                $item['dir'] = $pl_own_dir;
                $item['php'] = $pl_own_dir_plfile;
                if ( is_dir($pl_own_dir . strtolower($name)) )
                {
                    $saved_type = 4;
                    $item['dir_admin'] = $pl_own_dir . strtolower($name) . '/';
                }
                else
                {
                    $saved_type = 5;
                    $item['dir_admin'] = $pl_own_dir;
                }
            }
            else
            {
                // find shortname/NP_*.php
                $pat = '';
                foreach(str_split(strtolower($filename)) as $value)
                {
                    if ( ord($value) >= ord('a') && ord($value) <= ord('z') )
                        $pat .= '[' . $value . strtoupper($value) . ']'; // strtoupper($value)
                    else
                        $pat .= $value;
                }
                $files = glob($current_file . '/' . 'NP_' . $pat . '.php', GLOB_NOSORT);

                if ($files === FALSE || count($files)==0)
                    continue;

                $sub_file = basename($files[0]);
                if ( !preg_match($pattern_php, $sub_file, $matches))
                    continue;
                // type: 2 , old_admin_area
                $name = $matches[1];
                $shortname = strtolower($name);
                $saved_type = 2;
                $item['dir'] = $SearchDir;
                $item['php'] = $SearchDir . $filename . '/' . $sub_file;
                $item['dir_admin'] = $SearchDir . $filename . '/' ;
                if (  is_dir( $SearchDir . $filename . '/' . $shortname ))
                {
                    $saved_type = 3;
                    $item['dir_admin'] = $SearchDir . $filename . '/' . $shortname . '/';
                }
            }
        }

        if ( $saved_type )
        {
            $shortname = strtolower($name);
            $item['name'] = $name;
            $item['shortname'] = $shortname;
            $item['class_name'] = 'NP_' . $name;
            $item['feature_dir_type'] = $saved_type; // type of Plugin Folder , 0: unkown, 1: normal, 2: has own dir
            if ( isset($items[$shortname]) )
            {
                // Note: duplication : show error or add log ?
                if ( $saved_type >= $items[$shortname]['feature_dir_type'] )
                    continue;
            }
            unset($items[$shortname]);
            $items[$shortname] = &$item;
            unset($item);
        }
    }
    closedir($dirhandle);

    ksort($items);
    return $items;
}

function init_nucleus_compatibility_mysql_handler()
{
    // added for 3.5 sql_* wrapper
    global $MYSQL_HANDLER;
    if (!isset($MYSQL_HANDLER))
        $MYSQL_HANDLER = array('mysql','');
    if ($MYSQL_HANDLER[0] == '')
        $MYSQL_HANDLER[0] = 'mysql';
    // end new for 3.5 sql_* wrapper

    global $DB_PREFIX , $MYSQL_PREFIX;
    if ( !isset($DB_PREFIX) || !is_string($DB_PREFIX) )
        $DB_PREFIX = (isset($MYSQL_PREFIX) && !empty($MYSQL_PREFIX) ? $MYSQL_PREFIX : '');

    global $DB_HOST , $MYSQL_HOST;
    if ( !isset($DB_HOST) || !is_string($DB_HOST) )
        $DB_HOST = !empty($MYSQL_HOST) ? $MYSQL_HOST : '';

    global $DB_USER , $MYSQL_USER;
    if ( !isset($DB_USER) || !is_string($DB_USER) )
        $DB_USER = !empty($MYSQL_USER) ? $MYSQL_USER : '';

    global $DB_PASSWORD , $MYSQL_PASSWORD;
    if ( !isset($DB_PASSWORD) || !is_string($DB_PASSWORD) )
        $DB_PASSWORD = !empty($MYSQL_PASSWORD) ? $MYSQL_PASSWORD : '';

    global $DB_DATABASE , $MYSQL_DATABASE;
    if ( !isset($DB_DATABASE) || !is_string($DB_DATABASE) )
        $DB_DATABASE = !empty($MYSQL_DATABASE) ? $MYSQL_DATABASE : '';

    $MYSQL_PREFIX   = @$DB_PREFIX;
    $MYSQL_HOST     = @$DB_HOST;
    $MYSQL_USER     = @$DB_USER;
    $MYSQL_PASSWORD = @$DB_PASSWORD;
    $MYSQL_DATABASE = @$DB_DATABASE;

    global $DB_PHP_MODULE_NAME;
    if (!isset($DB_PHP_MODULE_NAME))
    $DB_PHP_MODULE_NAME = 'pdo';
    $DB_PHP_MODULE_NAME = strtolower($DB_PHP_MODULE_NAME);

    global $MYSQL_HANDLER , $DB_DRIVER_NAME;
    if (!isset($DB_DRIVER_NAME))
    {
//        if ($MYSQL_HANDLER[0] == 'mysql')
//            trigger_error("Deprecated : use sql_ instead of mysql_ . ", E_USER_DEPRECATED);

        if ( isset($MYSQL_HANDLER) )
        {
            if (
                  ( is_string($MYSQL_HANDLER) && ($MYSQL_HANDLER == 'mysql') )
                  ||
                  ( is_array($MYSQL_HANDLER) && (strtolower($MYSQL_HANDLER[0]) == 'mysql') )
                )
            {
//                trigger_error("Critical Error : not allow mysql_ function. ", E_USER_ERROR);
                $DB_PHP_MODULE_NAME = 'mysql';
                $DB_DRIVER_NAME = 'mysql';
            }

            if ( !isset($DB_DRIVER_NAME) )
            {
                if ( is_array($MYSQL_HANDLER)
                  && (strtolower($MYSQL_HANDLER[0])=='pdo')
                  && isset($MYSQL_HANDLER[1])
                )
                    $DB_DRIVER_NAME = $MYSQL_HANDLER[1];
                else
                    $DB_DRIVER_NAME = 'mysql';
            }
        }
    }
    $DB_DRIVER_NAME = strtolower($DB_DRIVER_NAME);
    // check invalid parameter
    if ($DB_DRIVER_NAME == 'sqlite')
    {
        $DB_PHP_MODULE_NAME = 'pdo';
//        echo "Error::config , Not implemented yet. Invalid db driver name.";
//        exit;
    }
    if (!in_array($DB_PHP_MODULE_NAME, array('pdo', 'mysql')))
        $DB_PHP_MODULE_NAME = 'pdo';
    if (!in_array($DB_DRIVER_NAME, array('mysql', 'sqlite')))
    {
//        $DB_DRIVER_NAME = 'mysql';
        echo "Error::config Invalid db driver name.";
        exit;
    }
    if ($DB_PHP_MODULE_NAME == 'mysql')
        $MYSQL_HANDLER = array('mysql', '');
    else
        $MYSQL_HANDLER = array($DB_PHP_MODULE_NAME, $DB_DRIVER_NAME);
}

function checkBrowserLang($locale)
{
    static $http_lang = null;
    if (is_array($http_lang))
        return (in_array(strtolower($locale), $http_lang));

    $items = explode(',', @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
    if ($items === FALSE)
        $items = array();
    $http_lang = array_map('substr', $items, array(0, 2));
//var_dump(__FUNCTION__,__LINE__, $items, $http_lang, $locale);
    return (in_array(strtolower($locale), $http_lang));
}

function getValidLanguage($lang)
{
    global $DB_DRIVER_NAME;
    $pattern_replace = '#-[^\-]*$#i';
    if ( $DB_DRIVER_NAME != 'mysql' || (defined('_CHARSET') && constant('_CHARSET') == 'UTF-8') )
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';

    if ( preg_match('#-utf8$#i', $lang) )
    {
        if ( checkLanguage($lang) )
            return $lang;
        if (checkBrowserLang('ja') && checkLanguage('japanese-utf8'))
            return 'japanese-utf8';
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';
        if ( checkLanguage($lang) )
            return $lang;
        return 'english-utf8';
    }
    // non utf-8
    if (checkBrowserLang('ja'))
    {
        if (preg_match('#^japanese#i', $lang) && checkLanguage($lang))
            return $lang;
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';
    }

    if ( checkLanguage($lang) )
        return $lang;
    return 'english-utf8';
}