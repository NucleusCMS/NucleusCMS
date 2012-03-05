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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

/* needed if we include globalfunctions from install.php */
global $nucleus, $CONF, $DIR_LIBS, $DIR_LOCALES, $manager, $member;

$nucleus['version'] = 'v4.00 SVN';
$nucleus['codename'] = '';

/* check and die if someone is trying to override internal globals (when register_globals turn on) */
checkVars(array('nucleus', 'CONF', 'DIR_LIBS', 'MYSQL_HOST', 'MYSQL_USER', 'MYSQL_PASSWORD', 'MYSQL_DATABASE', '$DIR_LOCALES', 'DIR_PLUGINS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_ENV_VARS', 'HTTP_SESSION_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 'GLOBALS', 'argv', 'argc', '_GET', '_POST', '_COOKIE', '_ENV', '_SESSION', '_SERVER', '_FILES'));

$CONF['debug'] = 0;
if ( $CONF['debug'] )
{
	/* report all errors! */
	error_reporting(E_ALL);
}
else
{
	ini_set('display_errors','0');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

/*
 * FIXME: This is for compatibility since 4.0, should be obsoleted at future release.
 */
if ( !isset($DIR_LOCALES) )
{
	$DIR_LOCALES = $DIR_NUCLEUS . 'locales/';
}
global $DIR_LANG;
if ( !isset($DIR_LANG) )
{
	$DIR_LANG = $DIR_LOCALES;
}

/*
 * load and initialize i18n class
 */
if (!class_exists('i18n', FALSE))
{
	include($DIR_LIBS . 'i18n.php');
}
if ( !i18n::init('UTF-8', $DIR_LOCALES) )
{
	exit('Fail to initialize i18n class.');
}
/*
 * FIXME: This is for compatibility since 4.0, should be obsoleted at future release.
 */
define('_CHARSET', i18n::get_current_charset());

/*
 * Indicates when Nucleus should display startup errors. Set to 1 if you want
 * the error enabled (default), false otherwise
 *
 * alertOnHeadersSent
 *  Displays an error when visiting a public Nucleus page and headers have
 *  been sent out to early. This usually indicates an error in either a
 *  configuration file or a translation file, and could cause Nucleus to
 *  malfunction
 * alertOnSecurityRisk
 * Displays an error only when visiting the admin area, and when one or
 *  more of the installation files (install.php, install.sql, upgrades/
 *  directory) are still on the server.
 */
if ( !array_key_exists('alertOnHeadersSent', $CONF) || $CONF['alertOnHeadersSent'] !== 0 )
{
	$CONF['alertOnHeadersSent'] = 1;
}
$CONF['alertOnSecurityRisk'] = 1;
/*
 * NOTE: this should be removed when releasing 4.0
$CONF['ItemURL']           = $CONF['Self'];
$CONF['ArchiveURL']          = $CONF['Self'];
$CONF['ArchiveListURL']      = $CONF['Self'];
$CONF['MemberURL']           = $CONF['Self'];
$CONF['SearchURL']           = $CONF['Self'];
$CONF['BlogURL']             = $CONF['Self'];
$CONF['CategoryURL']         = $CONF['Self'];
*/

/*
 * NOTE: this should be removed when releasing 4.0
 * switch URLMode back to normal when $CONF['Self'] ends in .php
 * this avoids urls like index.php/item/13/index.php/item/15
if (!isset($CONF['URLMode']) || (($CONF['URLMode'] == 'pathinfo') && (substr($CONF['Self'], strlen($CONF['Self']) - 4) == '.php'))) {
    $CONF['URLMode'] = 'normal';
}*/

/*
 * Set these to 1 to allow viewing of future items or draft items
 * Should really never do this, but can be useful for some plugins that might need to
 * Could cause some other issues if you use future posts otr drafts
 * So use with care
 */
$CONF['allowDrafts'] = 0;
$CONF['allowFuture'] = 0;

if ( getNucleusPatchLevel() > 0 )
{
	$nucleus['version'] .= '/' . getNucleusPatchLevel();
}

/* Avoid notices */
if ( !isset($CONF['installscript']) )
{
	$CONF['installscript'] = 0;
}

/* we will use postVar, getVar, ... methods instead of $_GET, $_POST ...*/
if ( $CONF['installscript'] != 1 )
{
	/* vars were already included in install.php */
	include_once($DIR_LIBS . 'vars4.1.0.php');
}

/* sanitize option */
$bLoggingSanitizedResult=0;
$bSanitizeAndContinue=0;

$orgRequestURI = serverVar('REQUEST_URI');
sanitizeParams();

/* get all variables that can come from the request and put them in the global scope */
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

if ( !headers_sent() )
{
	header('Generator: Nucleus CMS ' . $nucleus['version']);
}

/* include core classes that are needed for login & plugin handling */
include_once($DIR_LIBS . 'mysql.php');
/* added for 3.5 sql_* wrapper */
global $MYSQL_HANDLER;
if ( !isset($MYSQL_HANDLER) )
{
	$MYSQL_HANDLER = array('mysql','');
}
if ( $MYSQL_HANDLER[0] == '' )
{
	$MYSQL_HANDLER[0] = 'mysql';
}
include_once($DIR_LIBS . 'sql/'.$MYSQL_HANDLER[0].'.php');
/* end new for 3.5 sql_* wrapper */
include($DIR_LIBS . 'MEMBER.php');
include($DIR_LIBS . 'ACTIONLOG.php');
include($DIR_LIBS . 'MANAGER.php');
include($DIR_LIBS . 'PLUGIN.php');

$manager =& MANAGER::instance();

/*
 * make sure there's no unnecessary escaping:
 * set_magic_quotes_runtime(0);
 */
if ( version_compare(PHP_VERSION, '5.3.0', '<') )
{
	ini_set('magic_quotes_runtime', '0');
}

/* Avoid notices */
if ( !array_key_exists('UsingAdminArea', $CONF) )
{
	$CONF['UsingAdminArea'] = 0;
}

/* only needed when updating logs */
if ( $CONF['UsingAdminArea'] )
{
	/* XML-RPC client classes */
	include($DIR_LIBS . 'xmlrpc.inc.php');
	include_once($DIR_LIBS . 'ADMIN.php');
}

/* connect to database */
sql_connect();
$SQLCount = 0;

/* logs sanitized result if need */
if ( $orgRequestURI!==serverVar('REQUEST_URI') )
{
	$msg = "Sanitized [" . serverVar('REMOTE_ADDR') . "] ";
	$msg .= $orgRequestURI . " -> " . serverVar('REQUEST_URI');
	if ( $bLoggingSanitizedResult )
	{
	addToLog(WARNING, $msg);
	}
	if ( !$bSanitizeAndContinue )
	{
		die("");
	}
}

/* makes sure database connection gets closed on script termination */
register_shutdown_function('sql_disconnect');

/* read config */
getConfig();

/*
 * FIXME: This is for backward compatibility, should be obsoleted near future.
 */
if ( !preg_match('#^(.+)_(.+)_(.+)$#', $CONF['Locale'])
  && ($CONF['Locale'] = i18n::convert_old_language_file_name_to_locale($CONF['Locale'])) === FALSE )
{
	$CONF['Locale'] = 'en_Latn_US';
}
if ( !array_key_exists('Language', $CONF) )
{
	$CONF['Language'] = i18n::convert_locale_to_old_language_file_name($CONF['Locale']);
}
$locale = $CONF['Locale'];

/* Properly set $CONF['Self'] and others if it's not set...
 * usually when we are access from admin menu
 */
if ( !array_key_exists('Self', $CONF) )
{
	$CONF['Self'] = $CONF['IndexURL'];
	/* strip trailing */
	if ( $CONF['Self'][i18n::strlen($CONF['Self']) -1] == "/" )
	{
		$CONF['Self'] = i18n::substr($CONF['Self'], 0, i18n::strlen($CONF['Self']) -1);
	}
}

$CONF['ItemURL'] = $CONF['Self'];
$CONF['ArchiveURL'] = $CONF['Self'];
$CONF['ArchiveListURL'] = $CONF['Self'];
$CONF['MemberURL'] = $CONF['Self'];
$CONF['SearchURL'] = $CONF['Self'];
$CONF['BlogURL'] = $CONF['Self'];
$CONF['CategoryURL'] = $CONF['Self'];

/*
 *switch URLMode back to normal when $CONF['Self'] ends in .php
 * this avoids urls like index.php/item/13/index.php/item/15
 */
if ( !array_key_exists('URLMode', $CONF)
 || (($CONF['URLMode'] == 'pathinfo')
  && (i18n::substr($CONF['Self'], i18n::strlen($CONF['Self']) - 4) == '.php')) )
{
	$CONF['URLMode'] = 'normal';
}

/* automatically use simpler toolbar for mozilla */
if ( ($CONF['DisableJsTools'] == 0)
   && strstr(serverVar('HTTP_USER_AGENT'), 'Mozilla/5.0')
   && strstr(serverVar('HTTP_USER_AGENT'), 'Gecko') )
{
	$CONF['DisableJsTools'] = 2;
}

/* login if cookies set*/
$member = new MEMBER();

/* secure cookie key settings (either 'none', 0, 8, 16, 24, or 32) */
if ( !array_key_exists('secureCookieKey', $CONF) )
{
	$CONF['secureCookieKey'] = 24;
}
switch( $CONF['secureCookieKey'] )
{
	case 8:
		$CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+\.[0-9]+\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
		break;
	case 16:
		$CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
		break;
	case 24:
		$CONF['secureCookieKeyIP'] = preg_replace('/\.[0-9]+$/','',serverVar('REMOTE_ADDR'));
		break;
	case 32:
		$CONF['secureCookieKeyIP'] = serverVar('REMOTE_ADDR');
		break;
	default:
		$CONF['secureCookieKeyIP'] = '';
}

/*
 * login/logout when required or renew cookies
 *  and decide locale on this session before plugin event generates
 */
if ( $action == 'login' )
{
	/* Form Authentication */
	$login = postVar('login');
	$pw = postVar('password');
	/* shared computer or not */
	$shared = intPostVar('shared');
	/* avoid md5 collision by using a long key */
	$pw=i18n::substr($pw,0,40);
	
	if ( $member->login($login, $pw) )
	{
		$member->newCookieKey();
		$member->setCookies($shared);
		
		if ( $CONF['secureCookieKey'] !== 'none' )
		{
			/* secure cookie key */
			$member->setCookieKey(md5($member->getCookieKey().$CONF['secureCookieKeyIP']));
			$member->write();
		}
		
		/* allows direct access to parts of the admin area after logging in */
		if ( $nextaction )
		{
			$action = $nextaction;
		}
		
		/* NOTE: include translation file and set locale */
		$locale = include_translation($locale, $member);
		i18n::set_current_locale($locale);
		
		$manager->notify('LoginSuccess', array('member' => &$member, 'username' => $login) );
		$errormessage = '';
		ACTIONLOG::add(INFO, "Login successful for $login (sharedpc=$shared)");
	}
	else
	{
		/* errormessage for [%errordiv%] */
		$trimlogin = trim($login);
		if ( empty($trimlogin) )
		{
			$errormessage = "Please enter a username.";
		}
		else 
		{
			$errormessage = 'Login failed for ' . $login;
		} 
		
		/* NOTE: include translation file and set locale */
		$locale = include_translation($locale);
		i18n::set_current_locale($locale);
		
		$manager->notify('LoginFailed', array('username' => $login) );
		ACTIONLOG::add(INFO, $errormessage);
	}
}

/*
 * TODO: this should be removed when releasing 4.0
Backed out for now: See http://forum.nucleuscms.org/viewtopic.php?t=3684 for details
elseif ( serverVar('PHP_AUTH_USER') && serverVar('PHP_AUTH_PW') )
{
	// HTTP Authentication
	$login  = serverVar('PHP_AUTH_USER');
	$pw     = serverVar('PHP_AUTH_PW');
	
	if ( $member->login($login, $pw) )
	{
		$manager->notify('LoginSuccess',array('member' => &$member));
		ACTIONLOG::add(INFO, "HTTP authentication successful for $login");
	}
	else
	{
		$manager->notify('LoginFailed',array('username' => $login));
		ACTIONLOG::add(INFO, 'HTTP authentication failed for ' . $login);
		
		//Since bad credentials, generate an apropriate error page
		header("WWW-Authenticate: Basic realm=\"Nucleus CMS {$nucleus['version']}\"");
		header('HTTP/1.0 401 Unauthorized');
		echo 'Invalid username or password';
		exit;
	}
}
*/

elseif ( ($action == 'logout')
      && (!headers_sent())
      && cookieVar($CONF['CookiePrefix'] . 'user') )
{
	/* remove cookies on logout */
	setcookie($CONF['CookiePrefix'] . 'user', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	setcookie($CONF['CookiePrefix'] . 'loginkey', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	
	/* NOTE: include translation file and set locale */
	$locale = include_translation($locale);
	i18n::set_current_locale($locale);
	
	$manager->notify('Logout', array('username' => cookieVar($CONF['CookiePrefix'] . 'user') ) );
}
elseif ( cookieVar($CONF['CookiePrefix'] . 'user') )
{
	/* Cookie Authentication */
	$ck=cookieVar($CONF['CookiePrefix'] . 'loginkey');
	/* 
	 * secure cookie key
	 * avoid md5 collision by using a long key
	 */
	$ck = i18n::substr($ck,0,32);
	if ( $CONF['secureCookieKey']!=='none' )
	{
		$ck = md5($ck.$CONF['secureCookieKeyIP']);
	}
	$res = $member->cookielogin(cookieVar($CONF['CookiePrefix'] . 'user'), $ck );
	unset($ck);
	
	/* renew cookies when not on a shared computer */
	if ( $res
	  && (cookieVar($CONF['CookiePrefix'] . 'sharedpc') != 1)
	  && (!headers_sent() ) )
	{
		$member->setCookieKey(cookieVar($CONF['CookiePrefix'] . 'loginkey'));
		$member->setCookies();
	}
	
	/* NOTE: include translation file and set locale */
	$locale = include_translation($locale, $member);
	i18n::set_current_locale($locale);
}
else
{
	/* NOTE: include translation file and set locale */
	$locale = include_translation($locale);
	i18n::set_current_locale($locale);
}

/* login completed */
$manager->notify('PostAuthentication', array('loggedIn' => $member->isLoggedIn() ) );

/*
 * Release ticket for plugin
 */
ticketForPlugin();

/* first, let's see if the site is disabled or not. always allow admin area access. */
if ( $CONF['DisableSite'] && !$member->isAdmin() && !$CONF['UsingAdminArea'] )
{
	redirect($CONF['DisableSiteURL']);
	exit;
}

/* load other classes */
include($DIR_LIBS . 'PARSER.php');
include($DIR_LIBS . 'SKIN.php');
include($DIR_LIBS . 'TEMPLATE.php');
include($DIR_LIBS . 'BLOG.php');
include($DIR_LIBS . 'BODYACTIONS.php');
include($DIR_LIBS . 'COMMENTS.php');
include($DIR_LIBS . 'COMMENT.php');
/* include($DIR_LIBS . 'ITEM.php'); */
include($DIR_LIBS . 'NOTIFICATION.php');
include($DIR_LIBS . 'BAN.php');
include($DIR_LIBS . 'PAGEFACTORY.php');
include($DIR_LIBS . 'SEARCH.php');
include($DIR_LIBS . 'ENTITY.php');
include($DIR_LIBS . 'LINK.php');

/* set lastVisit cookie (if allowed) */
if ( !headers_sent() )
{
	if ( $CONF['LastVisit'] )
	{
		setcookie($CONF['CookiePrefix'] . 'lastVisit', time(), time() + 2592000, $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	}
	else
	{
		setcookie($CONF['CookiePrefix'] . 'lastVisit', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	}
}

/*
Backed out for now: See http://forum.nucleuscms.org/viewtopic.php?t=3684 for details

// To remove after v2.5 is released and translation files have been updated.
// Including this makes sure that translation files for v2.5beta can still be used for v2.5final
// without having weird _SETTINGS_EXTAUTH string showing up in the admin area.
if (!defined('_MEMBERS_BYPASS'))
{
    define('_SETTINGS_EXTAUTH',         'Enable External Authentication');
    define('_WARNING_EXTAUTH',          'Warning: Enable only if needed.');
    define('_MEMBERS_BYPASS',           'Use External Authentication');
}
*/

/* make sure the archivetype skinvar keeps working when _ARCHIVETYPE_XXX not defined */
if ( !defined('_ARCHIVETYPE_MONTH') )
{
	define('_ARCHIVETYPE_DAY', 'day');
	define('_ARCHIVETYPE_MONTH', 'month');
	define('_ARCHIVETYPE_YEAR', 'year');
}

/* decode path_info */
if ( $CONF['URLMode'] == 'pathinfo' )
{
	/* initialize keywords if this hasn't been done before */
	if ( !isset($CONF['ItemKey']) || $CONF['ItemKey'] == '' )
	{
		$CONF['ItemKey'] = 'item';
	}
	
	if ( !isset($CONF['ArchiveKey']) || $CONF['ArchiveKey'] == '' )
	{
		$CONF['ArchiveKey'] = 'archive';
	}
	
	if ( !isset($CONF['ArchivesKey']) || $CONF['ArchivesKey'] == '' )
	{
		$CONF['ArchivesKey'] = 'archives';
	}
	
	if ( !isset($CONF['MemberKey']) || $CONF['MemberKey'] == '' )
	{
		$CONF['MemberKey'] = 'member';
	}
	
	if ( !isset($CONF['BlogKey']) || $CONF['BlogKey'] == '' )
	{
		$CONF['BlogKey'] = 'blog';
	}
	
	if ( !isset($CONF['CategoryKey']) || $CONF['CategoryKey'] == '' )
	{
		$CONF['CategoryKey'] = 'category';
	}
	
	if ( !isset($CONF['SpecialskinKey']) || $CONF['SpecialskinKey'] == '' )
	{
		$CONF['SpecialskinKey'] = 'special';
	}
	
	$parsed = false;
	$manager->notify(
		'ParseURL',
		array(
			/* e.g. item, blog, ... */
			'type' => basename(serverVar('SCRIPT_NAME') ),
			'info' => $virtualpath,
			'complete' => &$parsed
		)
	);
	
	if ( !$parsed )
	{
		/* default implementation */
		$data = i18n::explode("/", $virtualpath );
		for ( $i = 0; $i < sizeof($data); $i++ )
		{
			switch ( $data[$i] )
			{
				/* item/1 (blogid) */
				case $CONF['ItemKey']:
					$i++;
					
					if ( $i < sizeof($data) )
					{
						$itemid = intval($data[$i]);
					}
					break;
				
				/* archives/1 (blogid) */
				case $CONF['ArchivesKey']:
						$i++;
						if ( $i < sizeof($data) )
						{
							$archivelist = intval($data[$i]);
						}
						break;
					
				/* two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid) */
				case $CONF['ArchiveKey']:
					if ( (($i + 1) < sizeof($data) ) && (!strstr($data[$i + 1], '-') ) )
					{
						$blogid = intval($data[++$i]);
					}
					$i++;
					if ( $i < sizeof($data) )
					{
						$archive = $data[$i];
					}
					break;
					
				/* blogid/1 */
				case 'blogid':
				/* blog/1 */
				case $CONF['BlogKey']:
					$i++;
					if ( $i < sizeof($data) )
					{
						$blogid = intval($data[$i]);
					}
					break;
				
				/* category/1 (catid) */
				case $CONF['CategoryKey']:
				case 'catid':
					$i++;
					if ( $i < sizeof($data) )
					{
						$catid = intval($data[$i]);
					}
					break;
				
				case $CONF['MemberKey']:
					$i++;
					if ( $i < sizeof($data) )
					{
						$memberid = intval($data[$i]);
					}
					break;
				
				case $CONF['SpecialskinKey']:
					$i++;
					if ( $i < sizeof($data) )
					{
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

/*
 * PostParseURL is a place to cleanup any of the path-related global variables before the selector function is run.
 * It has 2 values in the data in case the original virtualpath is needed, but most the use will be in tweaking
 * global variables to clean up (scrub out catid or add catid) or to set someother global variable based on
 * the values of something like catid or itemid
 * New in 3.60
 */
$manager->notify(
	'PostParseURL',
	array(
		/* e.g. item, blog, ... */
		'type' => basename(serverVar('SCRIPT_NAME') ),
		'info' => $virtualpath
	)
);

/*
 * NOTE: Here is the end of initialization
 */

	/**
	 * This function includes or requires the specified library file
	 * @param string $file
	 * @param bool $once use the _once() version
	 * @param bool $require use require() instead of include()
	 */
	function include_libs($file, $once = TRUE, $require = TRUE)
	{
		global $DIR_LIBS;

		// begin if: $DIR_LIBS isn't a directory
		if ( !is_dir($DIR_LIBS) )
		{
			exit;
		} // end if

		$lib_path = $DIR_LIBS . $file;

		// begin if: 
		if ( $once && $require )
		{
			require_once($lib_path);
		}
		else if ( $once && !$require )
		{
			include_once($lib_path);
		}
		else if ( $require )
		{
			require($lib_path);
		}
		else
		{
			include($lib_path);
		} // end if

	}


	/**
	 * This function includes or requires the specified plugin file
	 * @param string $file
	 * @param bool $once use the _once() version
	 * @param bool $require use require() instead of include()
	 */
	function include_plugins($file, $once = TRUE, $require = TRUE)
	{
		global $DIR_PLUGINS;

		// begin if: $DIR_LIBS isn't a directory
		if ( !is_dir($DIR_PLUGINS) )
		{
			exit;
		} // end if

		$plugin_path = $DIR_PLUGINS . $file;

		// begin if: 
		if ( $once && $require )
		{
			require_once($plugin_path);
		}
		else if ( $once && !$require )
		{
			include_once($plugin_path);
		}
		elseif ( $require )
		{
			require($plugin_path);
		}
		else
		{
			include($plugin_path);
		}
	}
	
	/**
	 * This function decide which locale is used and include translation
	 * @param	string	$locale	locale name referring to 'language tags' defined in RFC 5646
	 * @param mixed	$member	member object
	 */
	function include_translation($locale, $member = FALSE)
	{
		global $DIR_LOCALES;
		
		/* 
		 * 1. user's locale is used if set
		 * 2. system default is used if it is not empty
		 * 3. else 'en_Latn_US.ISO-8859-1.php' is included
		 *     because this translation file is expected to include only 7bit ASCII characters
		 *      which common in whole character coding scheme
		 */
		if ( $member && $member->getLocale() )
		{
			$locale = $member->getLocale();
		}
		$translation_file = $DIR_LOCALES . $locale . '.' . i18n::get_current_charset() . '.php';
		if ( !file_exists($translation_file) )
		{
			$locale = 'en_Latn_US';
			$translation_file = $DIR_LOCALES . 'en_Latn_US.ISO-8859-1.php';
		}
		include($translation_file);
		return $locale;
	}
	
	/**
	 * This function returns the integer value of $_POST for the variable $name
	 * @param string $name field to get the integer value of
	 * @return int
	 */
	function intPostVar($name)
	{
		return intval(postVar($name));
	}


	/**
	 * This function returns the integer value of $_GET for the variable $name
	 * @param string $name field to get the integer value of
	 * @return int
	 */
	function intGetVar($name)
	{
		return intval(getVar($name));
	}


	/**
	 * This function returns the integer value of $_REQUEST for the variable $name. Also checks $_GET and $_POST if not found in $_REQUEST
	 * @param string $name field to get the integer value of
	 * @return int
	 */
	function intRequestVar($name)
	{
		return intval(requestVar($name));
	}


	/**
	 * This function returns the integer value of $_COOKIE for the variable $name
	 * @param string $name field to get the integer value of
	 * @return int
	 */
	function intCookieVar($name)
	{
		return intval(cookieVar($name));
	}


	/**
	 * This function returns the current Nucleus version (100 = 1.00, 101 = 1.01, etc...)
	 * @return int
	 */
	function getNucleusVersion()
	{
		return 400;
	}


	/**
	 * TODO: Better description of this function.
	 *
	 * Power users can install patches in between nucleus releases. These patches
	 * usually add new functionality in the plugin API and allow those to
	 * be tested without having to install CVS.
	 *
	 * @return int
	 */
	function getNucleusPatchLevel()
	{
		return 0;
	}


	/**
	 * This function returns the latest Nucleus version available for download from nucleuscms.org or FALSE if unable to attain data
	 * Format will be major.minor/patachlevel e.g. 3.41 or 3.41/02
	 * @return string|bool
	 */
	function getLatestVersion()
	{
		// begin if: cURL is not available in this PHP installation
		if ( !function_exists('curl_init') )
		{
			return FALSE;
		} // end if

		$curl = curl_init();
		$timeout = 5;
		curl_setopt ($curl, CURLOPT_URL, 'http://nucleuscms.org/version_check.php');
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		$return = curl_exec($curl);
		curl_close($curl);
		return $return;
	}


	/**
	 * This function returns a Nucleus table name with the appropriate prefix
	 * @param string $name
	 * @return string
	 */
	function sql_table($name)
	{
		global $MYSQL_PREFIX;

		// begin if: no MySQL prefix
		if ( empty($MYSQL_PREFIX) )
		{
			return 'nucleus_' . $name;
		}
		// else: use MySQL prefix
		else
		{
			return $MYSQL_PREFIX . 'nucleus_' . $name;
		} // end if

	}


	/**
	 * TODO: This function should be changed to send_content_type() per the Coding Guidelines. Ensure this change is compatible with rest of core.
	 *
	 * This function sends the Content-Type header if headers have not already been sent
	 * It also determines if the browser can accept application/xhtml+xml and sends it only to those that can.
	 * @param string $content_type
	 * @param string $page_type
	 * @param string $charset Deprecated. This has no meaning.
	 */
	function sendContentType($content_type, $page_type = '', $charset = _CHARSET)
	{
		global $manager, $CONF;
		
		if ( !headers_sent() )
		{
			// if content type is application/xhtml+xml, only send it to browsers
			// that can handle it (IE6 cannot). Otherwise, send text/html

			// v2.5: For admin area pages, keep sending text/html (unless it's a debug version)
			//       application/xhtml+xml still causes too much problems with the javascript implementations

			// v3.3: ($CONF['UsingAdminArea'] && !$CONF['debug']) gets removed,
			//       application/xhtml+xml seems to be working, so we're going to use it if we can.

			if ( ($content_type == 'application/xhtml+xml')
				&& (!stristr(serverVar('HTTP_ACCEPT'), 'application/xhtml+xml') ) )
			{
				$content_type = 'text/html';
			} // end if

			$manager->notify(
				'PreSendContentType',
				array(
					'contentType' => &$content_type,
					'charset' => i18n::get_current_charset(),
					'pageType' => $page_type
				)
			);

			// strip strange characters
			$content_type = preg_replace('|[^a-z0-9-+./]|i', '', $content_type);
			header('Content-Type: ' . $content_type . '; charset=' . i18n::get_current_charset());
		} // end if

	}


	/**
	 * This function parses a query into an array of expressions that can be passed on to the highlight method
	 * @param string $query
	 */
	function parseHighlight($query)
	{
		// TODO: add more intelligent splitting logic
		
		// get rid of quotes
		$query = preg_replace('/\'|"/', '', $query);
		
		if ( !$query )
		{
			return array();
		}
		
		$aHighlight = i18n::explode(' ', $query);
		
		for ( $i = 0; $i < count($aHighlight); $i++ )
		{
			$aHighlight[$i] = trim($aHighlight[$i]);
			
			if ( i18n::strlen($aHighlight[$i]) < 3 )
			{
				unset($aHighlight[$i]);
			}
		}
		
		if ( count($aHighlight) == 1 )
		{
			return $aHighlight[0];
		}
		else
		{
			return $aHighlight;
		}
	}


	/**
	 * This function gets the blog ID from the blog name
	 * @param string $name
	 * @return
	 */
	function getBlogIDFromName($name)
	{
		return quickQuery('SELECT `bnumber` AS `result` FROM `' . sql_table('blog') . '` WHERE `bshortname` = "' . sql_real_escape_string($name) . '"');
	}


	/**
	 * This function gets the blog name from the blog ID
	 * @param int $id
	 * @return object
	 */
	function getBlogNameFromID($id)
	{
		return quickQuery('SELECT `bname` AS `result` FROM `' . sql_table('blog') . '` WHERE `bnumber` = ' . intval($id));
	}


	/**
	 * This function gets the blog ID from the item ID
	 * @param int $item_id
	 * @return object
	 */
	function getBlogIDFromItemID($item_id)
	{
		return quickQuery('SELECT `iblog` AS `result` FROM `' . sql_table('item') . '` WHERE `inumber` = ' . intval($item_id));
	}


	/**
	 * This function gets the blog ID from the comment ID
	 * @param int $comment_id
	 * @return object
	 */
	function getBlogIDFromCommentID($comment_id)
	{
		return quickQuery('SELECT `cblog` AS `result` FROM `' . sql_table('comment') . '` WHERE `cnumber` = ' . intval($comment_id));
	}


	/**
	 * This function gets the blog ID from the category ID
	 * @param int $category_id
	 * @return object
	 */
	function getBlogIDFromCatID($category_id)
	{
		return quickQuery('SELECT `cblog` AS `result` FROM `' . sql_table('category') . '` WHERE `catid` = ' . intval($category_id));
	}


	/**
	 * This function gets the category ID from the category name
	 * @param int $name
	 * @return object
	 */
	function getCatIDFromName($name)
	{
		return quickQuery('SELECT `catid` AS `result` FROM `' . sql_table('category') . '` WHERE `cname` = "' . sql_real_escape_string($name) . '"');
	}


	/**
	 * This function performs a quick SQL query
	 * @param string $query
	 * @return object
	 */
	function quickQuery($query)
	{
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return $obj->result;
	}

function getPluginNameFromPid($pid) {
    $res = sql_query('SELECT pfile FROM ' . sql_table('plugin') . ' WHERE pid=' . intval($pid) );
    $obj = sql_fetch_object($res);
    return $obj->pfile;
//    return isset($obj->pfile) ? $obj->pfile : false;
}

function selector() {
	global $itemid, $blogid, $memberid, $query, $amount, $archivelist, $maxresults;
	global $archive, $skinid, $blog, $memberinfo, $CONF, $member;
	global $imagepopup, $catid, $special;
	global $manager;
	
	$actionNames = array('addcomment', 'sendmessage', 'createaccount', 'forgotpassword', 'votepositive', 'votenegative', 'plugin');
	$action = requestVar('action');
	
	if ( in_array($action, $actionNames) )
	{
		global $DIR_LIBS, $errormessage;
		include_once($DIR_LIBS . 'ACTION.php');
		$a = new ACTION();
		$errorInfo = $a->doAction($action);
		
		if ( $errorInfo )
		{
			$errormessage = $errorInfo['message'];
		}
	}
	
	// show error when headers already sent out
	if ( headers_sent() && $CONF['alertOnHeadersSent'] )
	{
		// try to get line number/filename (extra headers_sent params only exists in PHP 4.3+)
		if ( function_exists('version_compare') && version_compare('4.3.0', phpversion(), '<=') )
		{
			headers_sent($hsFile, $hsLine);
			$extraInfo = ' in <code>' . $hsFile . '</code> line <code>' . $hsLine . '</code>';
		}
		else
		{
			$extraInfo = '';
		}
		
		startUpError(
			'<p>The page headers have already been sent out' . $extraInfo . '. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the translation file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>',
			'Page headers already sent'
		);
		exit;
	}
	
	// make is so ?archivelist without blogname or blogid shows the archivelist
	// for the default weblog
	if ( serverVar('QUERY_STRING') == 'archivelist' )
	{
		$archivelist = $CONF['DefaultBlog'];
	}
	
	// now decide which type of skin we need
	if ( $itemid )
	{
		// itemid given -> only show that item
		$type = 'item';
		
		if ( !$manager->existsItem($itemid,intval($CONF['allowFuture']),intval($CONF['allowDrafts'])) )
		{
			doError(_ERROR_NOSUCHITEM);
		}
		
		global $itemidprev, $itemidnext, $catid, $itemtitlenext, $itemtitleprev;
		
		// 1. get timestamp, blogid and catid for item
		$query = 'SELECT itime, iblog, icat FROM ' . sql_table('item') . ' WHERE inumber=' . intval($itemid);
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		
		// if a different blog id has been set through the request or selectBlog(),
		// deny access
		
		if ( $blogid && (intval($blogid) != $obj->iblog) )
		{
			doError(_ERROR_NOSUCHITEM);
		}
		
		// if a category has been selected which doesn't match the item, ignore the
		// category. #85
		if ( ($catid != 0) && ($catid != $obj->icat) )
		{
			$catid = 0;
		}
		
		$blogid = $obj->iblog;
		$timestamp = strtotime($obj->itime);
		
		$b =& $manager->getBlog($blogid);
		
		if ( $b->isValidCategory($catid) )
		{
			$catextra = ' and icat=' . $catid;
		}
		else
		{
			$catextra = '';
		}
		
		// get previous itemid and title
		$query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime<' . mysqldate($timestamp) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime DESC LIMIT 1';
		$res = sql_query($query);
		
		$obj = sql_fetch_object($res);
		
		if ( $obj )
		{
			$itemidprev = $obj->inumber;
			$itemtitleprev = $obj->ititle;
		}
		
		// get next itemid and title
		$query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime>' . mysqldate($timestamp) . ' and itime <= ' . mysqldate($b->getCorrectTime()) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime ASC LIMIT 1';
		$res = sql_query($query);
		
		$obj = sql_fetch_object($res);
		
		if ( $obj )
		{
			$itemidnext = $obj->inumber;
			$itemtitlenext = $obj->ititle;
		}
	}
	elseif ($archive)
	{
		// show archive
		$type = 'archive';
		
		// get next and prev month links ...
		global $archivenext, $archiveprev, $archivetype, $archivenextexists, $archiveprevexists;
		
		// sql queries for the timestamp of the first and the last published item
		$query = "SELECT UNIX_TIMESTAMP(itime) as result FROM ".sql_table('item')." WHERE idraft=0 ORDER BY itime ASC";
		$first_timestamp=quickQuery ($query);
		$query = "SELECT UNIX_TIMESTAMP(itime) as result FROM ".sql_table('item')." WHERE idraft=0 ORDER BY itime DESC";
		$last_timestamp=quickQuery ($query);
		
		sscanf($archive, '%d-%d-%d', $y, $m, $d);
		
		if ( $d != 0 )
		{
			$archivetype = _ARCHIVETYPE_DAY;
			$t = mktime(0, 0, 0, $m, $d, $y);
			// one day has 24 * 60 * 60 = 86400 seconds
			$archiveprev = i18n::strftime('%Y-%m-%d', $t - 86400 );
			// check for published items
			if ( $t > $first_timestamp )
			{
				$archiveprevexists = true;
			}
			else
			{
				$archiveprevexists = false;
			}
			
			// one day later
			$t += 86400;
			$archivenext = i18n::strftime('%Y-%m-%d', $t);
			if ( $t < $last_timestamp )
			{
				$archivenextexists = true;
			}
			else
			{
				$archivenextexists = false;
			}
		}
		elseif ( $m == 0 )
		{
			$archivetype = _ARCHIVETYPE_YEAR;
			$t = mktime(0, 0, 0, 12, 31, $y - 1);
			// one day before is in the previous year
			$archiveprev = i18n::strftime('%Y', $t);
			if ( $t > $first_timestamp )
			{
				$archiveprevexists = true;
			}
			else
			{
				$archiveprevexists = false;
			}

			// timestamp for the next year
			$t = mktime(0, 0, 0, 1, 1, $y + 1);
			$archivenext = i18n::strftime('%Y', $t);
			if ( $t < $last_timestamp )
			{
				$archivenextexists = true;
			}
			else
			{
				$archivenextexists = false;
			}
		}
		else
		{
			$archivetype = _ARCHIVETYPE_MONTH;
			$t = mktime(0, 0, 0, $m, 1, $y);
			// one day before is in the previous month
			$archiveprev = i18n::strftime('%Y-%m', $t - 86400);
			if ( $t > $first_timestamp )
			{
				$archiveprevexists = true;
			}
			else
			{
				$archiveprevexists = false;
			}
			
			// timestamp for the next month
			$t = mktime(0, 0, 0, $m+1, 1, $y);
			$archivenext = i18n::strftime('%Y-%m', $t);
			if ( $t < $last_timestamp )
			{
				$archivenextexists = true;
			}
			else
			{
				$archivenextexists = false;
			}
		}
	}
	elseif ($archivelist)
	{
		$type = 'archivelist';
		
		if ( is_numeric($archivelist) )
		{
			$blogid = intVal($archivelist);
		}
		else
		{
			$blogid = getBlogIDFromName($archivelist);
		}
	
		if ( !$blogid )
		{
			doError(_ERROR_NOSUCHBLOG);
		}
	}
	elseif ( $query )
	{
		global $startpos;
		$type = 'search';
		$query = stripslashes($query);
		
		if ( is_numeric($blogid) )
		{
			$blogid = intVal($blogid);
		}
		else
		{
			$blogid = getBlogIDFromName($blogid);
		}
		
		if ( !$blogid )
		{
			doError(_ERROR_NOSUCHBLOG);
		}
	}
	elseif ( $memberid )
	{
		$type = 'member';
		
		if ( !MEMBER::existsID($memberid) )
		{
			doError(_ERROR_NOSUCHMEMBER);
		}
		$memberinfo = $manager->getMember($memberid);
	}
	elseif ( $imagepopup )
	{
		// media object (images etc.)
		$type = 'imagepopup';
		
		// TODO: check if media-object exists
		// TODO: set some vars?
	}
	else
	{
		// show regular index page
		global $startpos;
		$type = 'index';
	}
	
	// any type of skin with catid
	if ( $catid && !$blogid )
	{
		$blogid = getBlogIDFromCatID($catid);
	}
	
	// decide which blog should be displayed
	if ( !$blogid )
	{
		$blogid = $CONF['DefaultBlog'];
	}
	
	$b =& $manager->getBlog($blogid);
	$blog = $b; // references can't be placed in global variables?
	
	if ( !$blog->isValid )
	{
		doError(_ERROR_NOSUCHBLOG);
	}
	
	// set catid if necessary
	if ( $catid )
	{
		// check if the category is valid
		if ( !$blog->isValidCategory($catid) )
		{
			doError(_ERROR_NOSUCHCATEGORY);
		}
		else
		{
			$blog->setSelectedCategory($catid);
		}
	}
	
	// decide which skin should be used
	if ( $skinid != '' && ($skinid == 0) )
	{
		selectSkin($skinid);
	}
	
	if ( !$skinid )
	{
		$skinid = $blog->getDefaultSkin();
	}
	
	//$special = requestVar('special'); //get at top of file as global
	if ( !empty($special) && isValidShortName($special) )
	{
		$type = strtolower($special);
	}
	
	$skin = new SKIN($skinid);
	
	if ( !$skin->isValid )
	{
		doError(_ERROR_NOSUCHSKIN);
	}
	
	// set global skinpart variable so can determine quickly what is being parsed from any plugin or phpinclude
	global $skinpart;
	$skinpart = $type;
	
	// parse the skin
	$skin->parse($type);
	
	// check to see we should throw JustPosted event
	$blog->checkJustPosted();
	return;
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

    $skinid = $skin->id;
    $errormessage = $msg;
    $skin->parse('error');
    exit;
}

function getConfig() {
    global $CONF;

    $query = 'SELECT * FROM ' . sql_table('config');
    $res = sql_query($query);

    while ($obj = sql_fetch_object($res) ) {
        $CONF[$obj->name] = $obj->value;
    }
}

// some checks for names of blogs, categories, templates, members, ...
function isValidShortName($name) {

	# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
	# original eregi: eregi('^[a-z0-9]+$', $name)

	return preg_match('#^[a-z0-9]+$#i', $name);

}

function isValidDisplayName($name) {

	# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
	# original eregi: eregi('^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$', $name)

	return preg_match('#^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$#i', $name);

}

function isValidCategoryName($name) {
    return 1;
}

function isValidTemplateName($name) {

	# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
	# original eregi: eregi('^[a-z0-9/]+$', $name)
	// added - and _ to valid characters as of 4.00

	return preg_match('#^[a-z0-9/_\-]+$#i', $name);

}

function isValidSkinName($name) {

	# replaced eregi() below with preg_match(). ereg* functions are deprecated in PHP 5.3.0
	# original eregi: eregi('^[a-z0-9/]+$', $name);
	// added - and _ to valid characters as of 4.00

	return preg_match('#^[a-z0-9/_\-]+$#i', $name);

}

// add and remove linebreaks
function addBreaks($var) {
    return nl2br($var);
}

function removeBreaks($var) {
    return preg_replace("/<br \/>([\r\n])/", "$1", $var);
}

/**
  * Converts a unix timestamp to a mysql DATETIME format, and places
  * quotes around it.
  */
function mysqldate($timestamp) {
    return '"' . date('Y-m-d H:i:s', $timestamp) . '"';
}

/**
  * functions for use in index.php
  */
function selectBlog($shortname) {
    global $blogid, $archivelist;
    $blogid = getBlogIDFromName($shortname);

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

// force the use of a translation file (warning: can cause warnings)
function selectLanguage($language) {

	global $DIR_LANG;

	# replaced ereg_replace() below with preg_replace(). ereg* functions are deprecated in PHP 5.3.0
	# original ereg_replace: preg_replace( '@\\|/@', '', $language) . '.php')
	# important note that '\' must be matched with '\\\\' in preg* expressions

	include($DIR_LANG . preg_replace('#[\\\\|/]#', '', $language) . '.php');

}

function parseFile($filename, $includeMode = 'normal', $includePrefix = '') {
    $handler = new ACTIONS('fileparser');
    $parser = new PARSER(SKIN::getAllowedActionsForType('fileparser'), $handler);
    $handler->parser =& $parser;

    // set IncludeMode properties of parser
    PARSER::setProperty('IncludeMode', $includeMode);
    PARSER::setProperty('IncludePrefix', $includePrefix);

    if (!file_exists($filename) ) {
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
    return '<a href="' . $CONF['AdminURL'] . 'documentation/help.html#'. $id . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);">';
}

/**
  * Includes a PHP file. This method can be called while parsing templates and skins
  */
function includephp($filename) {
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
    global $argv, $argc, $PHP_SELF, $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $HTTP_POST_VARS;
    global $HTTP_POST_FILES, $HTTP_ENV_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS;

    // other
    global $PATH_INFO, $HTTPS, $HTTP_RAW_POST_DATA, $HTTP_X_FORWARDED_FOR;

    if (@file_exists($filename) ) {
        include($filename);
    }
}

/**
 * Checks if a certain plugin exists
 * @param string $plug
 * @return bool
 **/
function checkPlugin($plug) {

	global $DIR_PLUGINS;

	# replaced ereg_replace() below with preg_replace(). ereg* functions are deprecated in PHP 5.3.0
	# original ereg_replace: ereg_replace( '[\\|/]', '', $plug) . '.php')
	# important note that '\' must be matched with '\\\\' in preg* expressions

	return file_exists($DIR_PLUGINS . preg_replace('#[\\\\|/]#', '', $plug) . '.php');

}

/**
 * @param $querystr
 *		querystring to alter (e.g. foo=1&bar=2&x=y)
 * @param $param
 *		name of parameter to change (e.g. 'foo')
 * @param $value
 *		New value for that parameter (e.g. 3)
 * @result
 *		altered query string (for the examples above: foo=3&bar=2&x=y)
 */
function alterQueryStr($querystr, $param, $value) {
    $vars = i18n::explode('&', $querystr);
    $set  = false;

    for ($i = 0; $i < count($vars); $i++) {
        $v = i18n::explode('=', $vars[$i]);

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
    ?><input type="hidden" name="<?php echo ENTITY::hsc($key)?>" value="<?php echo ENTITY::hsc(undoMagic($value) )?>" /><?php
}

function checkVars($aVars) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES, $HTTP_SESSION_VARS;

    foreach ($aVars as $varName) {

        if (phpversion() >= '4.1.0') {

            if (   isset($_GET[$varName])
                || isset($_POST[$varName])
                || isset($_COOKIE[$varName])
                || isset($_ENV[$varName])
                || isset($_SESSION[$varName])
                || isset($_FILES[$varName])
            ) {
                die('Sorry. An error occurred.');
            }

        } else {

            if (   isset($HTTP_GET_VARS[$varName])
                || isset($HTTP_POST_VARS[$varName])
                || isset($HTTP_COOKIE_VARS[$varName])
                || isset($HTTP_ENV_VARS[$varName])
                || isset($HTTP_SESSION_VARS[$varName])
                || isset($HTTP_POST_FILES[$varName])
            ) {
                die('Sorry. An error occurred.');
            }

        }
    }
}


/**
 * Sanitize parameters such as $_GET and $_SERVER['REQUEST_URI'] etc.
 * to avoid XSS
 */
function sanitizeParams()
{
    global $HTTP_SERVER_VARS;

    $array = array();
    $str = '';
    $frontParam = '';

    // REQUEST_URI of $HTTP_SERVER_VARS
    $str =& $HTTP_SERVER_VARS["REQUEST_URI"];
    serverStringToArray($str, $array, $frontParam);
    sanitizeArray($array);
    arrayToServerString($array, $frontParam, $str);

    // QUERY_STRING of $HTTP_SERVER_VARS
    $str =& $HTTP_SERVER_VARS["QUERY_STRING"];
    serverStringToArray($str, $array, $frontParam);
    sanitizeArray($array);
    arrayToServerString($array, $frontParam, $str);

    if (phpversion() >= '4.1.0') {
        // REQUEST_URI of $_SERVER
        $str =& $_SERVER["REQUEST_URI"];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);

        // QUERY_STRING of $_SERVER
        $str =& $_SERVER["QUERY_STRING"];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);
    }

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
function ticketForPlugin()
{
	global $CONF, $DIR_PLUGINS, $member, $ticketforplugin;
	
	/* initialize */
	$ticketforplugin = array();
	$ticketforplugin['ticket'] = FALSE;
	
	/* $_SERVER['PATH_TRANSLATED']
	 * http://www.php.net/manual/en/reserved.variables.server.php
	 * Note: As of PHP 4.3.2, PATH_TRANSLATED is no longer set implicitly
	 * under the Apache 2 SAPI in contrast to the situation in Apache 1,
	 * where it's set to the same value as the SCRIPT_FILENAME server variable
	 * when it's not populated by Apache.
	 * This change was made to comply with the CGI specification
	 * that PATH_TRANSLATED should only exist if PATH_INFO is defined.
	 * Apache 2 users may use AcceptPathInfo = On inside httpd.conf to define PATH_INFO. 
	 */
	
	/* Check if using plugin's php file. */
	$p_translated = serverVar('SCRIPT_FILENAME');
	
	if (!file_exists($p_translated) )
	{
		header("HTTP/1.0 404 Not Found");
		exit('');
	}
	
	$p_translated = str_replace('\\', '/', $p_translated);
	$d_plugins = str_replace('\\', '/', $DIR_PLUGINS);
	
	// This isn't plugin php file.
	if ( i18n::strpos($p_translated, $d_plugins) !== 0 )
	{
		return;
	}

	// Solve the plugin php file or admin directory
	$phppath = i18n::substr($p_translated, i18n::strlen($d_plugins) );
	// Remove the first "/" if exists.
	$phppath = preg_replace('#^/#', '', $phppath);
	// Remove the first "NP_" and the last ".php" if exists.
	$path = preg_replace('#^NP_(.*)\.php$#', '$1', $phppath);
	// Remove the "/" and beyond.
	$path = preg_replace('#^([^/]*)/(.*)$#', '$1', $path);
	
	// Solve the plugin name.
	$plugins = array();
	$query = 'SELECT `pfile` FROM '.sql_table('plugin');
	$res = sql_query($query);
	
	while($row = sql_fetch_row($res) )
	{
		$name = i18n::substr($row[0], 3);
		$plugins[strtolower($name)] = $name;
	}
	
	sql_free_result($res);
	
	if (array_key_exists($path, $plugins))
	{
		$plugin_name = $plugins[$path];
	}
	else if (in_array($path, $plugins))
	{
		$plugin_name = $path;
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
		exit('You aren\'t logged in.');
	}
	
	global $manager, $DIR_LIBS, $DIR_LOCALES, $HTTP_GET_VARS, $HTTP_POST_VARS;
	
	/* Check if this feature is needed (ie, if "$manager->checkTicket()" is not included in the script). */
	if (!($p_translated = serverVar('PATH_TRANSLATED') ) )
	{
		$p_translated = serverVar('SCRIPT_FILENAME');
	}
	
	if ($file = @file($p_translated) )
	{
		$prevline = '';
		
		foreach($file as $line)
		{
			if (preg_match('/[\$]manager([\s]*)[\-]>([\s]*)checkTicket([\s]*)[\(]/i', $prevline . $line) )
			{
				return;
			}
			
			$prevline = $line;
		}
	}
	
	/* Show a form if not valid ticket */
	if ( ( strstr(serverVar('REQUEST_URI'), '?') || serverVar('QUERY_STRING')
	 || strtoupper(serverVar('REQUEST_METHOD') ) == 'POST')
	 && (!$manager->checkTicket() ) )
	{
		$oPluginAdmin = new PluginAdmin($plugin_name);
		$oPluginAdmin->start();
		echo '<p>' . _ERROR_BADTICKET . "</p>\n";
		
		/* Show the form to confirm action */
		// PHP 4.0.x support
		$get = (isset($_GET) ) ? $_GET : $HTTP_GET_VARS;
		$post = (isset($_POST) ) ? $_POST : $HTTP_POST_VARS;
		
		// Resolve URI and QUERY_STRING
		if ($uri = serverVar('REQUEST_URI') )
		{
			list($uri, $qstring) = i18n::explode('?', $uri);
		}
		else
		{
			if ( !($uri = serverVar('PHP_SELF') ) )
			{
				$uri = serverVar('SCRIPT_NAME');
			}
			$qstring = serverVar('QUERY_STRING');
		}
		if ($qstring)
		{
			$qstring = '?' . $qstring;
		}
		
		echo '<p>' . _SETTINGS_UPDATE . ' : ' . _QMENU_PLUGINS . ' <span style="color:red;">' . ENTITY::hsc($plugin_name) . "</span> ?</p>\n";
		
		switch(strtoupper(serverVar('REQUEST_METHOD') ) )
		{
			case 'POST':
				echo '<form method="POST" action="'.ENTITY::hsc($uri.$qstring).'">';
				$manager->addTicketHidden();
				_addInputTags($post);
				break;
			
			case 'GET':
				echo '<form method="GET" action="'.ENTITY::hsc($uri).'">';
				$manager->addTicketHidden();
				_addInputTags($get);
			
			default:
				break;
		}
		
		echo '<input type="submit" value="' . _YES . '" />&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="button" value="' . _NO . '" onclick="history.back(); return false;" />';
		echo "</form>\n";
		
		$oPluginAdmin->end();
		exit;
	}
	
	/* Create new ticket */
	$ticket=$manager->addTicketToUrl('');
	$ticketforplugin['ticket']=i18n::substr($ticket,i18n::strpos($ticket,'ticket=')+7);
}

function _addInputTags(&$keys,$prefix=''){
    foreach($keys as $key=>$value){
        if ($prefix) $key=$prefix.'['.$key.']';
        if (is_array($value)) _addInputTags($value,$key);
        else {
            if (get_magic_quotes_gpc()) $value=stripslashes($value);
            if ($key=='ticket') continue;
            echo '<input type="hidden" name="'.ENTITY::hsc($key).
                '" value="'.ENTITY::hsc($value).'" />'."\n";
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
    $frontParam = "";

    // split front param, e.g. /index.php, and others, e.g. blogid=1&page=2
    if (strstr($str, "?")){
        list($frontParam, $args) = preg_split("/\?/", $str, 2);
    }
    else {
        $args = $str;
        $frontParam = "";
    }

    // If there is no args like blogid=1&page=2, return
    if (!strstr($str, "=") && !i18n::strlen($frontParam)) {
        $frontParam = $str;
        return;
    }

    $array = i18n::explode("&", $args);
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
//	$excludeListForSanitization = array();

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
            if (i18n::strpos($val, '\\')) {
                list($val, $tmp) = i18n::explode('\\', $val);
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

/*
 * Returns the Javascript code for a bookmarklet that works on most modern browsers
 * @param blogid
 */
function getBookmarklet($blogid) {
    global $CONF;

    // normal
    $document = 'document';
    $bookmarkletline = "javascript:Q='';x=".$document.";y=window;if(x.selection){Q=x.selection.createRange().text;}else if(y.getSelection){Q=y.getSelection();}else if(x.getSelection){Q=x.getSelection();}wingm=window.open('";
    $bookmarkletline .= $CONF['AdminURL'] . "bookmarklet.php?blogid=$blogid";
    $bookmarkletline .="&logtext='+escape(Q)+'&loglink='+escape(x.location.href)+'&loglinktitle='+escape(x.title),'nucleusbm','scrollbars=yes,width=600,height=550,left=10,top=10,status=yes,resizable=yes');wingm.focus();";

    return $bookmarkletline;
}
// END: functions from the end of file ADMIN.php

/**
 * Returns a variable or null if not set
 *
 * @param mixed Variable
 * @return mixed Variable
 */
function ifset(&$var) {
    if (isset($var)) {
        return $var;
    }

    return null;
}

/**
 * Returns number of subscriber to an event
 *
 * @param event
 * @return number of subscriber(s)
 */
function numberOfEventSubscriber($event) {
    $query = 'SELECT COUNT(*) as count FROM ' . sql_table('plugin_event') . ' WHERE event=\'' . $event . '\'';
    $res = sql_query($query);
    $obj = sql_fetch_object($res);
    return $obj->count;
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
	$ext_point = i18n::strrpos($str,".");
	if ($ext_point===false) return false;
	$ext = i18n::substr($str,$ext_point,i18n::strlen($str));
	$str = i18n::substr($str,0,$ext_point);

	return preg_replace("/[^a-z0-9-]/","_",$str).$ext;
}

/**
 * Centralisation of the functions to send mail
 * Deprecated since 4.0:
 * Please use functions in NOTIFICATION class instead
 */
function getMailFooter()
{
	NOTIFICATION::get_mail_footer();
}
function isValidMailAddress($address)
{
	return NOTIFICATION::address_validation($address);
}
/**
 * Centralisation of the functions that deals XML entities
 * Deprecated since 4.0:
 * Please use ENTITY::FunctionName(...) instead
 */
function highlight($text, $expression, $highlight)
{
	return ENTITY::highlight($text, $expression, $highlight);
}
function shorten($string, $maxlength, $suffix)
{
	return ENTITY::shorten($string, $maxlength, $suffix);
}
function stringStripTags ($string)
{
	return ENTITY::strip_tags($string);
}
function toAscii($string)
{
	return ENTITY::anchor_footnoting($string);
}
function stringToAttribute ($string)
{
	return ENTITY::hsc($string);
}
function stringToXML ($string)
{
	return ENTITY::hen($string);
}
function encode_desc($data)
{
	return ENTITY::hen($data);
}
/**
 * Centralisation of the functions that deals with locales
 * This functions is based on the old way to deal with languages
 * Deprecated since 4.0:
 */
/* NOTE: use i18n::get_current_locale() directly instead of this */
function getLanguageName()
{
	if( ($language = i18n::convert_locale_to_old_language_file_name(i18n::get_current_locale())) === FALSE )
	{
		$language ='english';
	}
	return $language;
}

/* NOTE: use i18n::get_available_locales() directly instead of this */
function checkLanguage($lang)
{
	return ( preg_match('#^(.+)_(.+)_(.+)$#', $lang)
	  || i18n::convert_old_language_file_name_to_locale($lang) );
}
/* NOTE: use i18n::formatted_datetime() directly instead of this */
function formatDate($format, $timestamp, $default_format, &$blog)
{
	$offset = date('Z', $timestamp);
	if ( $blog )
	{
		$offset += $blog->getTimeOffset() * 3600;
	}
	return i18n::formatted_datetime($format, $timestamp, $default_format, $offset);
}
/**
 * Centralisation of the functions that generate links
 * Deprecated since 4.0:
 * Please use LINK::FunctionName(...) instead
 */
function createItemLink($itemid, $extra = '')
{
	return LINK::create_item_link($itemid, $extra);
}
function createMemberLink($memberid, $extra = '')
{
	return LINK::create_member_link($memberid, $extra);
}
function createCategoryLink($catid, $extra = '')
{
	return LINK::create_category_link($catid, $extra);
}
function createArchiveListLink($blogid = '', $extra = '')
{
	return LINK::create_archivelist_link($blogid, $extra);
}
function createArchiveLink($blogid, $archive, $extra = '')
{
	return LINK::create_archive_link($blogid, $archive, $extra);
}
function createBlogidLink($blogid, $params = '')
{
	return LINK::create_blogid_link($blogid, $params = '');
}
function createLink($type, $params)
{
	return LINK::create_link($type, $params);
}
function createBlogLink($url, $params)
{
	return LINK::create_blog_link($url, $params);
}
