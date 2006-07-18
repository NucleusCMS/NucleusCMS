<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 * @version $Id: globalfunctions.php,v 1.8 2006-07-18 08:42:04 kimitake Exp $
 * $NucleusJP: globalfunctions.php,v 1.7 2006/07/17 20:03:44 kimitake Exp $
 */

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $DIR_LIBS, $DIR_LANG, $manager, $member;

$nucleus['version'] = 'v3.3SVN';
$nucleus['codename'] = 'Lithium';

checkVars(array('nucleus', 'CONF', 'DIR_LIBS', 'MYSQL_HOST', 'MYSQL_USER', 'MYSQL_PASSWORD', 'MYSQL_DATABASE', 'DIR_LANG', 'DIR_PLUGINS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_ENV_VARS', 'HTTP_SESSION_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 'GLOBALS', 'argv', 'argc', '_GET', '_POST', '_COOKIE', '_ENV', '_SESSION', '_SERVER', '_FILES'));

$CONF['debug'] = 0;
if ($CONF['debug']) {
	error_reporting(E_ALL);	// report all errors!
} else {
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

// Avoid notices
if (!isset($CONF['Self'])) {
	$CONF['Self'] = $_SERVER['PHP_SELF'];
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
		more of the installation files (install.php, install.sql, upgrades/
		directory) are still on the server.
*/
$CONF['alertOnHeadersSent'] = 1;
$CONF['alertOnSecurityRisk'] = 1;
$CONF['ItemURL'] = $CONF['Self'];
$CONF['ArchiveURL'] = $CONF['Self'];
$CONF['ArchiveListURL'] = $CONF['Self'];
$CONF['MemberURL'] = $CONF['Self'];
$CONF['SearchURL'] = $CONF['Self'];
$CONF['BlogURL'] = $CONF['Self'];
$CONF['CategoryURL'] = $CONF['Self'];

// switch URLMode back to normal when $CONF['Self'] ends in .php
// this avoids urls like index.php/item/13/index.php/item/15
if (!isset($CONF['URLMode']) || (($CONF['URLMode'] == 'pathinfo') && (substr($CONF['Self'], strlen($CONF['Self']) - 4) == '.php'))) {
	$CONF['URLMode'] = 'normal';
}

if (getNucleusPatchLevel() > 0) {
	$nucleus['version'] .= '/' . getNucleusPatchLevel();
}

// Avoid notices
if (!isset($CONF['installscript'])) {
	$CONF['installscript'] = 0;
}

// we will use postVar, getVar, ... methods instead of HTTP_GET_VARS or _GET
if ($CONF['installscript'] != 1) { // vars were already included in install.php
	if (phpversion() >= '4.1.0') {
		include_once($DIR_LIBS . 'vars4.1.0.php');
	} else {
		include_once($DIR_LIBS . 'vars4.0.6.php');
	}
}

// get all variables that can come from the request and put them in the global scope
$blogid	= requestVar('blogid');
$itemid	= intRequestVar('itemid');
$catid = intRequestVar('catid');
$skinid	= requestVar('skinid');
$memberid = requestVar('memberid');
$archivelist = requestVar('archivelist');
$imagepopup = requestVar('imagepopup');
$archive = requestVar('archive');
$query = requestVar('query');
$highlight = requestVar('highlight');
$amount = requestVar('amount');
$action = requestVar('action');
$nextaction = requestVar('nextaction');
$maxresults = requestVar('maxresults');
$startpos = intRequestVar('startpos');
$errormessage = '';
$error = '';
$virtualpath = ((getVar('virtualpath') != null) ? getVar('virtualpath') : serverVar('PATH_INFO'));

if (!headers_sent() ) {
	header('Generator: Nucleus CMS ' . $nucleus['version']);
}

// include core classes that are needed for login & plugin handling
include($DIR_LIBS . 'mysql.php');
include($DIR_LIBS . 'MEMBER.php');
include($DIR_LIBS . 'ACTIONLOG.php');
include($DIR_LIBS . 'MANAGER.php');
include($DIR_LIBS . 'PLUGIN.php');

$manager =& MANAGER::instance();

// make sure there's no unnecessary escaping:
set_magic_quotes_runtime(0);

// Avoid notices
if (!isset($CONF['UsingAdminArea'])) {
	$CONF['UsingAdminArea'] = 0;
}

// only needed when updating logs
if ($CONF['UsingAdminArea']) {
	include($DIR_LIBS . 'xmlrpc.inc.php');	// XML-RPC client classes
	include_once($DIR_LIBS . 'ADMIN.php');
}

// connect to database
sql_connect();
$SQLCount = 0;

// makes sure database connection gets closed on script termination
register_shutdown_function('sql_disconnect');

// read config
getConfig();

// automatically use simpler toolbar for mozilla
if (($CONF['DisableJsTools'] == 0) && strstr(serverVar('HTTP_USER_AGENT'), 'Mozilla/5.0') && strstr(serverVar('HTTP_USER_AGENT'), 'Gecko') ) {
	$CONF['DisableJsTools'] = 2;
}

// login if cookies set
$member = new MEMBER();

// login/logout when required or renew cookies
if ($action == 'login') {
	// Form Authentication
	$login = postVar('login');
	$pw = postVar('password');
	$shared	= intPostVar('shared');	// shared computer or not

	if ($member->login($login, $pw) ) {

		$member->newCookieKey();
		$member->setCookies($shared);

		// allows direct access to parts of the admin area after logging in
		if ($nextaction) {
			$action = $nextaction;
		}

		$manager->notify('LoginSuccess', array('member' => &$member) );
		$errormessage = '';
		ACTIONLOG::add(INFO, "Login successful for $login (sharedpc=$shared)");
	} else {
		// errormessage for [%errordiv%]
		$errormessage = 'Login failed for ' . $login;

		$manager->notify('LoginFailed', array('username' => $login) );
		ACTIONLOG::add(INFO, $errormessage);
	}
/*

Backed out for now: See http://forum.nucleuscms.org/viewtopic.php?t=3684 for details

} elseif (serverVar('PHP_AUTH_USER') && serverVar('PHP_AUTH_PW')) {
	// HTTP Authentication
	$login  = serverVar('PHP_AUTH_USER');
	$pw     = serverVar('PHP_AUTH_PW');

	if ($member->login($login, $pw) ) {
		$manager->notify('LoginSuccess',array('member' => &$member));
		ACTIONLOG::add(INFO, "HTTP authentication successful for $login");
	} else {
		$manager->notify('LoginFailed',array('username' => $login));
		ACTIONLOG::add(INFO, 'HTTP authentication failed for ' . $login);

		//Since bad credentials, generate an apropriate error page
		header("WWW-Authenticate: Basic realm=\"Nucleus CMS {$nucleus['version']}\"");
		header('HTTP/1.0 401 Unauthorized');
		echo 'Invalid username or password';
		exit;
	}
*/

} elseif (($action == 'logout') && (!headers_sent() ) && cookieVar($CONF['CookiePrefix'] . 'user') ) {
	// remove cookies on logout
	setcookie($CONF['CookiePrefix'] . 'user', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	setcookie($CONF['CookiePrefix'] . 'loginkey', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	$manager->notify('Logout', array('username' => cookieVar($CONF['CookiePrefix'] . 'user') ) );
} elseif (cookieVar($CONF['CookiePrefix'] . 'user') ) {
	// Cookie Authentication
	$res = $member->cookielogin(cookieVar($CONF['CookiePrefix'] . 'user'), cookieVar($CONF['CookiePrefix'] . 'loginkey') );

	// renew cookies when not on a shared computer
	if ($res && (cookieVar($CONF['CookiePrefix'] . 'sharedpc') != 1) && (!headers_sent() ) ) {
		$member->setCookies();
	}
}

// login completed
$manager->notify('PostAuthentication', array('loggedIn' => $member->isLoggedIn() ) );

// first, let's see if the site is disabled or not. always allow admin area access.
if ($CONF['DisableSite'] && !$member->isAdmin() && !$CONF['UsingAdminArea']) {
	redirect($CONF['DisableSiteURL']);
	exit;
}

// load other classes
include($DIR_LIBS . 'PARSER.php');
include($DIR_LIBS . 'SKIN.php');
include($DIR_LIBS . 'TEMPLATE.php');
include($DIR_LIBS . 'BLOG.php');
include($DIR_LIBS . 'COMMENTS.php');
include($DIR_LIBS . 'COMMENT.php');
//include($DIR_LIBS . 'ITEM.php');
include($DIR_LIBS . 'NOTIFICATION.php');
include($DIR_LIBS . 'BAN.php');
include($DIR_LIBS . 'PAGEFACTORY.php');
include($DIR_LIBS . 'SEARCH.php');
include($DIR_LIBS . 'entity.php');


// set lastVisit cookie (if allowed)
if (!headers_sent() ) {
	if ($CONF['LastVisit']) {
		setcookie($CONF['CookiePrefix'] . 'lastVisit', time(), time() + 2592000, $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	} else {
		setcookie($CONF['CookiePrefix'] . 'lastVisit', '', (time() - 2592000), $CONF['CookiePath'], $CONF['CookieDomain'], $CONF['CookieSecure']);
	}
}

// read language file, only after user has been initialized
$language = getLanguageName();
include($DIR_LANG . ereg_replace( '[\\|/]', '', $language) . '.php');

/*
	Backed out for now: See http://forum.nucleuscms.org/viewtopic.php?t=3684 for details

// To remove after v2.5 is released and language files have been updated.
// Including this makes sure that language files for v2.5beta can still be used for v2.5final
// without having weird _SETTINGS_EXTAUTH string showing up in the admin area.
if (!defined('_MEMBERS_BYPASS'))
{
	define('_SETTINGS_EXTAUTH',			'Enable External Authentication');
	define('_WARNING_EXTAUTH',			'Warning: Enable only if needed.');
	define('_MEMBERS_BYPASS',			'Use External Authentication');
}

*/

// make sure the archivetype skinvar keeps working when _ARCHIVETYPE_XXX not defined
if (!defined('_ARCHIVETYPE_MONTH') ) {
	define('_ARCHIVETYPE_DAY', 'day');
	define('_ARCHIVETYPE_MONTH', 'month');
}

// decode path_info
if ($CONF['URLMode'] == 'pathinfo') {
	// initialize keywords if this hasn't been done before
	if ($CONF['ItemKey'] == '') {
		$CONF['ItemKey'] = 'item';
	}

	if ($CONF['ArchiveKey'] == '') {
		$CONF['ArchiveKey'] = 'archive';
	}

	if ($CONF['ArchivesKey'] == '') {
		$CONF['ArchivesKey'] = 'archives';
	}

	if ($CONF['MemberKey'] == '') {
		$CONF['MemberKey'] = 'member';
	}

	if ($CONF['BlogKey'] == '') {
		$CONF['BlogKey'] = 'blog';
	}

	if ($CONF['CategoryKey'] == '') {
		$CONF['CategoryKey'] = 'category';
	}

	$parsed = false;
	$manager->notify(
		'ParseURL',
		array(
			'type' => basename(serverVar('SCRIPT_NAME') ), // e.g. item, blog, ...
			'info' => $virtualpath,
			'complete' => &$parsed
		)
	);

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

				default:
					// skip...
			}
		}
	}
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
	return 330;
}

/**
 * power users can install patches in between nucleus releases. These patches
 * usually add new functionality in the plugin API and allow those to
 * be tested without having to install CVS.
 */
function getNucleusPatchLevel() {
	return 0;
}

/**
  * Connects to mysql server
  */
function sql_connect() {
	global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_CONN;

	$MYSQL_CONN = @mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD) or startUpError('<p>Could not connect to MySQL database.</p>', 'Connect Error');
	mysql_select_db($MYSQL_DATABASE) or startUpError('<p>Could not select database: ' . mysql_error() . '</p>', 'Connect Error');

	return $MYSQL_CONN;
}

/**
 * returns a prefixed nucleus table name
 */
function sql_table($name) {
	global $MYSQL_PREFIX;

	if ($MYSQL_PREFIX) {
		return $MYSQL_PREFIX . 'nucleus_' . $name;
	} else {
		return 'nucleus_' . $name;
	}
}

function sendContentType($contenttype, $pagetype = '', $charset = _CHARSET) {
	global $manager, $CONF;

	if (!headers_sent() ) {
		// if content type is application/xhtml+xml, only send it to browsers
		// that can handle it (IE6 cannot). Otherwise, send text/html

		// v2.5: For admin area pages, keep sending text/html (unless it's a debug version)
		//       application/xhtml+xml still causes too much problems with the javascript implementations

		// v3.3: ($CONF['UsingAdminArea'] && !$CONF['debug']) gets removed,
		//       application/xhtml+xml seems to be working, so we're going to use it if we can.
		if (
				($contenttype == 'application/xhtml+xml')
			&&	(!stristr(serverVar('HTTP_ACCEPT'), 'application/xhtml+xml') )
			) {
			$contenttype = 'text/html';
		}

		$manager->notify(
			'PreSendContentType',
			array(
				'contentType' => &$contenttype,
				'charset' => &$charset,
				'pageType' => $pagetype
			)
		);

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
 * Errors before the database connection has been made
 */
function startUpError($msg, $title) {
	?>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title><?php echo htmlspecialchars($title)?></title></head>
		<body>
			<h1><?php echo htmlspecialchars($title)?></h1>
			<?php echo $msg?>
		</body>
	</html>
	<?php	exit;
}

/**
  * disconnects from SQL server
  */
function sql_disconnect() {
	@mysql_close();
}

/**
  * executes an SQL query
  */
function sql_query($query) {
	global $SQLCount;
	$SQLCount++;
	$res = mysql_query($query) or print("mySQL error with query $query: " . mysql_error() . '<p />');
	return $res;
}


/**
 * Highlights a specific query in a given HTML text (not within HTML tags) and returns it
 *
 * @param $text
 *		text to be highlighted
 * @param $expression
 *		regular expression to be matched (can be an array of expressions as well)
 * @param $highlight
 *		highlight to be used (use \\0 to indicate the matched expression)
 *
 */
function highlight($text, $expression, $highlight) {
	if (!$highlight || !$expression) {
		return $text;
	}

	if (is_array($expression) && (count($expression) == 0) ) {
		return $text;
	}

	// add a tag in front (is needed for preg_match_all to work correct)
	$text = '<!--h-->' . $text;

	// split the HTML up so we have HTML tags
	// $matches[0][i] = HTML + text
	// $matches[1][i] = HTML
	// $matches[2][i] = text
	preg_match_all('/(<[^>]+>)([^<>]*)/', $text, $matches);

	// throw it all together again while applying the highlight to the text pieces
	$result = '';
	for ($i = 0; $i < sizeof($matches[2]); $i++) {
		if ($i != 0) {
			$result .= $matches[1][$i];
		}

		if (is_array($expression) ) {
			foreach ($expression as $regex) {
				if ($regex) {
					$matches[2][$i] = @eregi_replace($regex, $highlight, $matches[2][$i]);
				}
			}

			$result .= $matches[2][$i];
		} else {
			$result .= @eregi_replace($expression, $highlight, $matches[2][$i]);
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
	$query = preg_replace('/\'|"/', '', $query);

	if (!query) {
		return array();
	}

	$aHighlight = explode(' ', $query);

	for ($i = 0; $i < count($aHighlight); $i++) {
		$aHighlight[$i] = trim($aHighlight[$i]);

		if (strlen($aHighlight[$i]) < 3) {
			unset($aHighlight[$i]);
		}
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
	if (preg_match('/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[A-Za-z]{2,5}$/', $address) ) {
		return 1;
	} else {
		return 0;
	}
}


// some helper functions
function getBlogIDFromName($name) {
	return quickQuery('SELECT bnumber as result FROM ' . sql_table('blog') . ' WHERE bshortname="' . addslashes($name) . '"');
}

function getBlogNameFromID($id) {
	return quickQuery('SELECT bname as result FROM ' . sql_table('blog') . ' WHERE bnumber=' . intval($id) );
}

function getBlogIDFromItemID($itemid) {
	return quickQuery('SELECT iblog as result FROM ' . sql_table('item') . ' WHERE inumber=' . intval($itemid) );
}

function getBlogIDFromCommentID($commentid) {
	return quickQuery('SELECT cblog as result FROM ' . sql_table('comment') . ' WHERE cnumber=' . intval($commentid) );
}

function getBlogIDFromCatID($catid) {
	return quickQuery('SELECT cblog as result FROM ' . sql_table('category') . ' WHERE catid=' . intval($catid) );
}

function getCatIDFromName($name) {
	return quickQuery('SELECT catid as result FROM ' . sql_table('category') . ' WHERE cname="' . addslashes($name) . '"');
}

function quickQuery($q) {
	$res = sql_query($q);
	$obj = mysql_fetch_object($res);
	return $obj->result;
}

function getPluginNameFromPid($pid) {
	$res = sql_query('SELECT pfile FROM ' . sql_table('plugin') . ' WHERE pid=' . intval($pid) );
	$obj = mysql_fetch_object($res);
	return $obj->pfile;
}

function selector() {
	global $itemid, $blogid, $memberid, $query, $amount, $archivelist, $maxresults;
	global $archive, $skinid, $blog, $memberinfo, $CONF, $member;
	global $imagepopup, $catid;
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

		// try to get line number/filename (extra headers_sent params only exists in PHP 4.3+)
		if (function_exists('version_compare') && version_compare('4.3.0', phpversion(), '<=') ) {
			headers_sent($hsFile, $hsLine);
			$extraInfo = ' in <code>' . $hsFile . '</code> line <code>' . $hsLine . '</code>';
		} else {
			$extraInfo = '';
		}

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

		if (!$manager->existsItem($itemid,0,0) ) {
			doError(_ERROR_NOSUCHITEM);
		}

		global $itemidprev, $itemidnext, $catid, $itemtitlenext, $itemtitleprev;

		// 1. get timestamp, blogid and catid for item
		$query = 'SELECT itime, iblog, icat FROM ' . sql_table('item') . ' WHERE inumber=' . intval($itemid);
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);

		// if a different blog id has been set through the request or selectBlog(),
		// deny access
//		if ($blogid && (intval($blogid) != $obj->iblog) ) {
//			doError(_ERROR_NOSUCHITEM);
//		}
		if ($blogid && (intval($blogid) != $obj->iblog) ) {
			if (!headers_sent()) {
				$b =& $manager->getBlog($obj->iblog);
				$correctURL = $b->getURL();

				if ($CONF['URLMode'] == 'pathinfo') {
					if (substr($correctURL,strlen($correctURL)-1,1)=='/') {
						$correctURL .= 'item/' . $itemid;
					} else {
						$correctURL .= '/item/' . $itemid;
					}
				} else {
					$correctURL .= '?itemid=' . $itemid;
				}

				redirect($correctURL);
				exit;
			} else {
				doError(_ERROR_NOSUCHITEM);
			}
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
		}

		// get previous itemid and title
		$query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime<' . mysqldate($timestamp) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime DESC LIMIT 1';
		$res = sql_query($query);

		$obj = mysql_fetch_object($res);

		if ($obj) {
			$itemidprev = $obj->inumber;
			$itemtitleprev = $obj->ititle;
		}

		// get next itemid and title
		$query = 'SELECT inumber, ititle FROM ' . sql_table('item') . ' WHERE itime>' . mysqldate($timestamp) . ' and itime <= ' . mysqldate($b->getCorrectTime()) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime ASC LIMIT 1';
		$res = sql_query($query);

		$obj = mysql_fetch_object($res);

		if ($obj) {
			$itemidnext = $obj->inumber;
			$itemtitlenext = $obj->ititle;
		}

	} elseif ($archive) {
		// show archive
		$type = 'archive';

		// get next and prev month links
		global $archivenext, $archiveprev, $archivetype;

		sscanf($archive, '%d-%d-%d', $y, $m, $d);

		if ($d != 0) {
			$archivetype = _ARCHIVETYPE_DAY;
			$t = mktime(0, 0, 0, $m, $d, $y);
			$archiveprev = strftime('%Y-%m-%d', $t - (24 * 60 * 60) );
			$archivenext = strftime('%Y-%m-%d', $t + (24 * 60 * 60) );
		} else {
			$archivetype = _ARCHIVETYPE_MONTH;
			$t = mktime(0, 0, 0, $m, 1, $y);
			$archiveprev = strftime('%Y-%m', $t - (1 * 24 * 60 * 60) );
			$archivenext = strftime('%Y-%m', $t + (32 * 24 * 60 * 60) );
		}

	} elseif ($archivelist) {
		$type = 'archivelist';

		if (intval($archivelist) != 0) {
			$blogid = $archivelist;
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
		if(preg_match("/^(\xA1{2}|\xe3\x80{2}|\x20)+$/",$query)){
					$type = 'index';
		}
		$order = (_CHARSET == 'EUC-JP') ? 'EUC-JP, UTF-8,' : 'UTF-8, EUC-JP,';
		$query = mb_convert_encoding($query, _CHARSET, $order.' JIS, SJIS, ASCII');
		if (intval($blogid) == 0) {
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

	// decide which blog should be displayed
	if (!$blogid) {
		$blogid = $CONF['DefaultBlog'];
	}

	$b =& $manager->getBlog($blogid);
	$blog = $b;	// references can't be placed in global variables?

	if (!$blog->isValid) {
		doError(_ERROR_NOSUCHBLOG);
	}

	// set catid if necessary
	if ($catid) {
		$blog->setSelectedCategory($catid);
	}

	// decide which skin should be used
	if ($skinid != '' && ($skinid == 0) ) {
		selectSkin($skinid);
	}

	if (!$skinid) {
		$skinid = $blog->getDefaultSkin();
	}

	$special = requestVar('special');
	if (!empty($special) && isValidShortName($special)) {
		$type = strtolower($special);
	}

	$skin = new SKIN($skinid);

	if (!$skin->isValid) {
		doError(_ERROR_NOSUCHSKIN);
	}

	// parse the skin
	$skin->parse($type);
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

	$errormessage = $msg;
	$skin->parse('error');
	exit;
}

function getConfig() {
	global $CONF;

	$query = 'SELECT * FROM ' . sql_table('config');
	$res = sql_query($query);

	while ($obj = mysql_fetch_object($res) ) {
		$CONF[$obj->name] = $obj->value;
	}
}

// some checks for names of blogs, categories, templates, members, ...
function isValidShortName($name) {
	return eregi('^[a-z0-9]+$', $name);
}

function isValidDisplayName($name) {
	return eregi('^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$', $name);
}

function isValidCategoryName($name) {
	return 1;
}

function isValidTemplateName($name) {
	return eregi('^[a-z0-9/]+$', $name);
}

function isValidSkinName($name) {
	return eregi('^[a-z0-9/]+$', $name);
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
	// 1. remove entities...
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans = array_flip($trans);
	$text = strtr($text, $trans);

	// 2. the actual shortening
	if (strlen($text) > $maxlength)
		$text = mb_strimwidth($text, 0, $maxlength, $toadd, _CHARSET);
	return $text;
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

// force the use of a language file (warning: can cause warnings)
function selectLanguage($language) {
	global $DIR_LANG;
	include($DIR_LANG . ereg_replace( '[\\|/]', '', $language) . '.php');
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
	return helplink($id) . '<img src="documentation/icon-help.gif" width="15" height="15" alt="' . _HELP_TT . '" /></a>';
}

function helplink($id) {
	return '<a href="documentation/help.html#'. $id . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);">';
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
  * Checks if a certain language/plugin exists
  */
function checkLanguage($lang) {
	global $DIR_LANG ;
	return file_exists($DIR_LANG . ereg_replace( '[\\|/]', '', $lang) . '.php');
}

function checkPlugin($plug) {
	global $DIR_PLUGINS;
	return file_exists($DIR_PLUGINS . ereg_replace( '[\\|/]', '', $plug) . '.php');
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

	if ($usePathInfo) {
		$manager->notify(
			'GenerateURL',
			array(
				'type' => $type,
				'params' => $params,
				'completed' => &$created,
				'url' => &$url
			)
		);
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
				$url = $CONF['BlogURL'] . '?blogid=' . $params['blogid'];
			}
			break;
	}

	return addLinkParams($url, (isset($params['extra'])? $params['extra'] : null));
}

function createBlogLink($url, $params) {
	return addLinkParams($url . '?', $params);
}

function addLinkParams($link, $params) {
	global $CONF;

	if (is_array($params) ) {

		if ($CONF['URLMode'] == 'pathinfo')	{

			foreach ($params as $param => $value) {
				$link .= '/' . $param . '/' . urlencode($value);
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
 *		querystring to alter (e.g. foo=1&bar=2&x=y)
 * @param $param
 *		name of parameter to change (e.g. 'foo')
 * @param $value
 *		New value for that parameter (e.g. 3)
 * @result
 *		altered query string (for the examples above: foo=3&bar=2&x=y)
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
	?><input type="hidden" name="<?php echo htmlspecialchars($key)?>" value="<?php echo htmlspecialchars(undoMagic($value) )?>" /><?php
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
			return strftime($format ? $format : $defaultFormat, $timestamp);
	}
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
 * Stops processing the request and redirects to the given URL.
 * - no actual contents should have been sent to the output yet
 * - the URL will be stripped of illegal or dangerous characters
 */
function redirect($url) {
	$url = preg_replace('|[^a-z0-9-~+_.?#=&;,/:@%]|i', '', $url);
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

	if (_CHARSET == 'UTF-8') {
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

	if (_CHARSET == 'UTF-8') {
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
function encode_desc($data)
	{   $to_entities = get_html_translation_table(HTML_ENTITIES);
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
	$bookmarkletline .="&logtext='+escape(Q)+'&loglink='+escape(x.location.href)+'&loglinktitle='+escape(x.title),'nucleusbm','scrollbars=yes,width=600,height=500,left=10,top=10,status=yes,resizable=yes');wingm.focus();";

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

?>