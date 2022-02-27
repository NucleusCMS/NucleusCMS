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
 * @license   http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

if ( ! isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}

global $DIR_NUCLEUS, $DIR_LIBS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG;

define('NC_CORE_PATH', $DIR_NUCLEUS);
define('NC_LIBS_PATH', $DIR_LIBS);
define('NC_MEDIA_PATH', $DIR_MEDIA);
define('NC_SKINS_PATH', $DIR_SKINS);
define('NC_PLUGINS_PATH', $DIR_PLUGINS);
define('NC_LOCALE_PATH', $DIR_LANG);

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $manager, $member;

//if(is_file(NC_CORE_PATH.'autoload.php')) include_once(NC_CORE_PATH.'autoload.php');

define('HAS_CATCH_ERROR', version_compare('7.0.0', PHP_VERSION, '<='));

include_once(NC_LIBS_PATH . 'version.php');
include_once(NC_LIBS_PATH . 'helpers.php');
include_once(NC_LIBS_PATH . 'globalfunctions.inc.php');

if (version_compare(phpversion(), '5.4.0', '<')) {
    _checkEnv();
}

// if you forked product, you can easy to change cms name.
define('CORE_APPLICATION_NAME', 'Nucleus CMS');
define('CORE_APPLICATION_VERSION', NUCLEUS_VERSION);
define('CORE_APPLICATION_VERSION_ID', NUCLEUS_VERSION_ID);
define('CORE_APPLICATION_DATABASE_VERSION_ID', NUCLEUS_DATABASE_VERSION_ID);
$nucleus['version']  = 'v' . NUCLEUS_VERSION;
$nucleus['codename'] = defined('NUCLEUS_DEVELOP') && constant('NUCLEUS_DEVELOP')
    ? 'dev' : '';

_setDefaultUa();
_setErrorReporting();
_setTimezone();

setDefaultConf();

if (getNucleusPatchLevel() > 0) {
    $nucleus['version'] .= '/' . getNucleusPatchLevel();
}

// we will use postVar, getVar, ... methods instead of _GET

// sanitize option
$bLoggingSanitizedResult = 0;
$bSanitizeAndContinue    = 0;

$orgRequestURI = serverVar('REQUEST_URI');
sanitizeParams();

// get all variables that can come from the request and put them in the global scope
$blogid      = requestVar('blogid');
$itemid      = intRequestVar('itemid');
$catid       = intRequestVar('catid');
$skinid      = requestVar('skinid');
$memberid    = requestVar('memberid');
$archivelist = requestVar('archivelist');
$imagepopup  = requestVar('imagepopup');
$archive     = requestVar('archive');
$query       = requestVar('query');
$highlight   = requestVar('highlight');
$amount      = requestVar('amount');
$action      = requestVar('action');
$nextaction  = requestVar('nextaction');
$maxresults  = requestVar('maxresults');
$startpos    = intRequestVar('startpos');
$special     = requestVar('special');
$virtualpath = (getVar('virtualpath') != null) ? getVar('virtualpath')
    : serverVar('PATH_INFO');

if ( ! headers_sent() && confVar('expose_generator')) {
    header(sprintf('Generator: %s', CORE_APPLICATION_NAME));
}

// Avoid the ClickJacking attack
un_clickjacking();
init_nucleus_compatibility_mysql_handler(); // compatible for mysql_handler global $MYSQL_*

global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;
// deprecated method
// include core classes that are needed for login & plugin handling
if (($DB_DRIVER_NAME === 'mysql') && ! function_exists('mysql_query')) {
    // For PHP 7
    if ($DB_PHP_MODULE_NAME === 'pdo') {
        include_once(NC_LIBS_PATH . 'sql/pdo_mysql_emulate.php');
    } else {
        include_once(NC_LIBS_PATH . 'sql/mysql_emulate.php');
    }
} else {
    // installer define this value.
    if ( ! defined('_EXT_MYSQL_EMULATE')) {
        define('_EXT_MYSQL_EMULATE', 0);
    }
}

include_once(NC_LIBS_PATH . 'sql/' . $DB_PHP_MODULE_NAME . '.php');
include_once(NC_LIBS_PATH . 'MEMBER.php');
include_once(NC_LIBS_PATH . 'ACTIONLOG.php');
include_once(NC_LIBS_PATH . 'MANAGER.php');
include_once(NC_LIBS_PATH . 'PLUGIN.php');
include_once(NC_LIBS_PATH . 'SYSTEMLOG.php');
include_once(NC_LIBS_PATH . 'Utils.php');

$manager =& MANAGER::instance();

// only needed when updating logs
if (confVar('UsingAdminArea')) {
    include_once(NC_LIBS_PATH . 'xmlrpc.inc.php');  // XML-RPC client classes
    include_once(NC_LIBS_PATH . 'ADMIN.php');
}

// connect to database
sql_connect();
$SQLCount = 0;

// logs sanitized result if need
if ($orgRequestURI !== serverVar('REQUEST_URI')) {
    $msg = "Sanitized [" . serverVar('REMOTE_ADDR') . "] ";
    $msg .= $orgRequestURI . " -> " . serverVar('REQUEST_URI');
    if ($bLoggingSanitizedResult) {
        addToLog(WARNING, $msg);
    }
    if ( ! $bSanitizeAndContinue) {
        exit;
    }
}

// makes sure database connection gets closed on script termination
register_shutdown_function('sql_disconnect');

// read config
getConfig();
setUrlKeys();

// Properly set $CONF['Self'] and others if it's not set... usually when we are access from admin menu
if ( ! isset($CONF['Self'])) {
    $CONF['Self'] = rtrim(confVar('IndexURL'), '/'); // strip trailing
}

if (confVar('URLMode') === 'pathinfo'
    && substr(confVar('Self'), -4) === '.php') {
    $CONF['Self'] = rtrim(confVar('IndexURL'), '/');
}

$CONF['ItemURL']        = confVar('Self');
$CONF['ArchiveURL']     = confVar('Self');
$CONF['ArchiveListURL'] = confVar('Self');
$CONF['MemberURL']      = confVar('Self');
$CONF['SearchURL']      = confVar('Self');
$CONF['BlogURL']        = confVar('Self');
$CONF['CategoryURL']    = confVar('Self');

// switch URLMode back to normal when confVar('Self') ends in .php
// this avoids urls like index.php/item/13/index.php/item/15
if (
    confVar('URLMode') === null
    || (
        (confVar('URLMode') === 'pathinfo')
        && (substr(confVar('Self'), strlen(confVar('Self')) - 4) === '.php')
    )
) {
    $CONF['URLMode'] = 'normal';
}

// automatically use simpler toolbar for mozilla
if ( ! confVar('DisableJsTools')
     && str_contains(serverVar('HTTP_USER_AGENT'),
        'Mozilla/5.0')
     && str_contains(serverVar('HTTP_USER_AGENT'), 'Gecko')) {
    $CONF['DisableJsTools'] = 2;
}

// login if cookies set
$member = new MEMBER();

// secure cookie key settings (either 'none', 0, 8, 16, 24, or 32)
if ( ! isset($CONF['secureCookieKey'])) {
    $CONF['secureCookieKey'] = 24;
}
switch ($CONF['secureCookieKey']) {
    case 8:
        $CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+\.[0-9]+\.[0-9]+$/',
            '', serverVar('REMOTE_ADDR'));
        break;
    case 16:
        $CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+\.[0-9]+$/', '',
            serverVar('REMOTE_ADDR'));
        break;
    case 24:
        $CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+$/', '',
            serverVar('REMOTE_ADDR'));
        break;
    case 32:
        $CONF['secureCookieKeyIP'] = serverVar('REMOTE_ADDR');
        break;
    default:
        $CONF['secureCookieKeyIP'] = '';
}

// login/logout when required or renew cookies
if (requestVar('action') === 'login') {
    if ( ! serverVar('HTTP_ACCEPT_LANGUAGE')) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    // Form Authentication
    // avoid md5 collision by using a long key
    if ($member->login(postVar('login'), substr(postVar('password'), 0, 40))) {
        $member->newCookieKey();
        $member->setCookies(intPostVar('shared'));
        if (confVar('secureCookieKey') !== 'none') {
            // secure cookie key
            $member->setCookieKey(
                md5($member->getCookieKey() . confVar('secureCookieKeyIP'))
            );
            $member->writeCookieKey();
        }

        // allows direct access to parts of the admin area after logging in
        if ($nextaction) {
            $action = $nextaction;
        }

        $param = array(
            'member'   => &$member,
            'username' => postVar('login'),
        );
        $manager->notify('LoginSuccess', $param);
        $log_message = sprintf("Login successful for %s (sharedpc=%s)",
            postVar('login'), intPostVar('shared'));

        $remote_ip   = serverVar('REMOTE_ADDR', '');
        $remote_host = serverVar('REMOTE_HOST', gethostbyaddr($remote_ip));
        if ($remote_ip !== '') {
            $log_message .= sprintf(" %s", $remote_ip);
            if ($remote_host !== false && $remote_host != $remote_ip) {
                $log_message .= sprintf("(%s)", $remote_host);
            }
        }
        if (serverVar('HTTP_X_FORWARDED_FOR')) {
            $remote_proxy_ip   = explode(',',
                serverVar('HTTP_X_FORWARDED_FOR'));
            $remote_proxy_ip
                               = $remote_proxy_ip[0]; //   explode(,)[0] syntax error php(-5.2)
            $remote_proxy_host = gethostbyaddr($remote_proxy_ip);
            $log_message       .= sprintf(" , proxy %s", $remote_proxy_ip);
            if ($remote_proxy_host !== false
                && $remote_proxy_host != $remote_proxy_ip) {
                $log_message .= sprintf('(%s)', $remote_proxy_host);
            }
            unset($remote_proxy_ip, $remote_proxy_host);
        }
        ACTIONLOG::add(INFO, $log_message);
        unset($log_message);
        unset($remote_ip, $remote_host);
    } else {
        $param = array('username' => postVar('login'));
        $manager->notify('LoginFailed', $param);
        if ( ! trim(postVar('login'))) {
            ACTIONLOG::add(INFO, 'Please enter a username.');
        } else {
            loadCoreLanguage();
            if ($member->isHalt()) {
                ACTIONLOG::add(
                    INFO
                    ,
                    sprintf(_GFUNCTIONS_LOGIN_FAILED_HALT_TXT, postVar('login'))
                );
            } else {
                ACTIONLOG::add(INFO, 'Login failed for ' . postVar('login'));
            }
        }
    }
} elseif ($action === 'logout' && ! headers_sent()
          && cookieVar(confVar('CookiePrefix') . 'user')) {
    // remove cookies on logout
    setcookie(
        confVar('CookiePrefix') . 'user'
        , ''
        , time() - 2592000
        , confVar('CookiePath')
        , confVar('CookieDomain')
        , confVar('CookieSecure')
    );
    setcookie(
        confVar('CookiePrefix') . 'loginkey'
        , ''
        , time() - 2592000
        , confVar('CookiePath')
        , confVar('CookieDomain')
        , confVar('CookieSecure')
    );
    $param = array('username' => cookieVar(confVar('CookiePrefix') . 'user'));
    $manager->notify('Logout', $param);
} elseif (cookieVar(confVar('CookiePrefix') . 'user')) {
    // Cookie Authentication
    $ck = cookieVar(confVar('CookiePrefix') . 'loginkey');
    // secure cookie key
    $ck = substr($ck, 0, 32); // avoid md5 collision by using a long key
    if (confVar('secureCookieKey') !== 'none') {
        $ck = md5($ck . confVar('secureCookieKeyIP'));
    }
    $res = $member->cookielogin(cookieVar(confVar('CookiePrefix') . 'user'),
        $ck);
    unset($ck);

    // renew cookies when not on a shared computer
    if ($res && (cookieVar(confVar('CookiePrefix') . 'sharedpc') != 1)
        && ( ! headers_sent())) {
        $member->setCookieKey(cookieVar(confVar('CookiePrefix') . 'loginkey'));
        $member->setCookies();
    }
}

// login completed
$param = array('loggedIn' => $member->isLoggedIn());
$manager->notify('PostAuthentication', $param);
ticketForPlugin();

// first, let's see if the site is disabled or not. always allow admin area access.
if (confVar('DisableSite') && ! $member->isAdmin()
    && ! confVar('UsingAdminArea')) {
    $url = trim(confVar('DisableSiteURL'));
    if (strlen($url) > 0) {
        redirect($url);
    } else {
        if ( ! headers_sent()) {
            header("HTTP/1.0 503 Service Unavailable");
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Mon, 01 Jan 2018 00:00:00 GMT");
        }
        $title = 'Service Unavailable';
        $msg   = 'Service Unavailable.';
        echo "<html><head><title>$title</title></head><body><h1>$title</h1>$msg</body></html>";
    }
    exit;
}

$param = array();
$manager->notify('PreLoadMainLibs', $param);

// load other classes
include_once(NC_LIBS_PATH . 'PARSER.php');
include_once(NC_LIBS_PATH . 'SKIN.php');
include_once(NC_LIBS_PATH . 'TEMPLATE.php');
include_once(NC_LIBS_PATH . 'BLOG.php');
include_once(NC_LIBS_PATH . 'BODYACTIONS.php');
include_once(NC_LIBS_PATH . 'COMMENTS.php');
include_once(NC_LIBS_PATH . 'COMMENT.php');
include_once(NC_LIBS_PATH . 'ITEM.php');
include_once(NC_LIBS_PATH . 'NOTIFICATION.php');
include_once(NC_LIBS_PATH . 'BAN.php');
include_once(NC_LIBS_PATH . 'PAGEFACTORY.php');
include_once(NC_LIBS_PATH . 'SEARCH.php');
include_once(NC_LIBS_PATH . 'entity.php');
include_once(NC_LIBS_PATH . 'CoreCachedData.php');

spl_autoload_register('loadCoreClassFor_spl' . (version_compare('5.3.0',
        PHP_VERSION, '<=') ? '' : '_prephp53'));

// set lastVisit cookie (if allowed)
if ( ! headers_sent()) {
    if (confVar('LastVisit')) {
        setcookie(
            confVar('CookiePrefix') . 'lastVisit'
            , time()
            , time() + 2592000
            , confVar('CookiePath')
            , confVar('CookieDomain')
            , confVar('CookieSecure')
        );
    } else {
        setcookie(
            confVar('CookiePrefix') . 'lastVisit'
            , ''
            , time() - 2592000
            , confVar('CookiePath')
            , confVar('CookieDomain')
            , confVar('CookieSecure')
        );
    }
}

// read language file, only after user has been initialized
LoadCoreLanguage();
$language = getLanguageName();

// check if valid charset
if (function_exists('encoding_check')) {
    if ( ! encoding_check(false, false, _CHARSET)) {
        foreach (array($_GET, $_POST) as $input) {
            array_walk($input, 'encoding_check');
        }
    }
}

// make sure the archivetype skinvar keeps working when _ARCHIVETYPE_XXX not defined
if ( ! defined('_ARCHIVETYPE_MONTH')) {
    define('_ARCHIVETYPE_DAY', 'day');
    define('_ARCHIVETYPE_MONTH', 'month');
    define('_ARCHIVETYPE_YEAR', 'year');
}

// decode path_info
if (confVar('URLMode') === 'pathinfo') {
    $parsed = false;
    $param  = array(
        'type'     => basename(serverVar('SCRIPT_NAME')),
        // e.g. item, blog, ...
        'info'     => $virtualpath,
        'complete' => &$parsed,
    );
    $manager->notify('ParseURL', $param);

    if ( ! $parsed) {
        // default implementation
        $data  = explode('/', $virtualpath);
        $total = count($data);
        foreach ($data as $i => $iValue) {
            switch ($data[$i]) {
                case confVar('ItemKey'): // item/1 (blogid)
                    $i++;
                    if ($i < $total) {
                        $itemid = (int)$iValue;
                    }
                    break;

                case confVar('ArchivesKey'): // archives/1 (blogid)
                    $i++;
                    if ($i < $total) {
                        $archivelist = (int)$iValue;
                    }
                    break;

                // two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid)
                case confVar('ArchiveKey'):
                    if (($i + 1) < $total
                        && strpos($data[$i + 1], '-') === false) {
                        $blogid = (int)$data[++$i];
                    }
                    $i++;
                    if ($i < $total) {
                        $archive = $iValue;
                    }
                    break;

                case 'blogid': // blogid/1
                case confVar('BlogKey'): // blog/1
                    $i++;
                    if ($i < $total) {
                        $blogid = (int)$iValue;
                    }
                    break;

                case confVar('CategoryKey'): // category/1 (catid)
                case 'catid':
                    $i++;
                    if ($i < $total) {
                        $catid = (int)$iValue;
                    }
                    break;

                case confVar('MemberKey'):
                    $i++;
                    if ($i < $total) {
                        $memberid = (int)$iValue;
                    }
                    break;

                case confVar('SpecialskinKey'):
                    $i++;
                    if ($i < $total) {
                        $special             = $iValue;
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
    'type' => basename(serverVar('SCRIPT_NAME')), // e.g. item, blog, ...
    'info' => $virtualpath,
);
$manager->notify('PostParseURL', $param);
