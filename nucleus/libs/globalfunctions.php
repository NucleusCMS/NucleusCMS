<?php

/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  */

// needed if we include globalfunctions from install.php
global $nucleus, $CONF, $DIR_LIBS, $DIR_LANG, $manager, $member; 


checkVars(array('nucleus', 'CONF', 'DIR_LIBS', 'MYSQL_HOST', 'MYSQL_USER', 'MYSQL_PASSWORD', 'MYSQL_DATABASE', 'DIR_LANG', 'DIR_PLUGINS'));

$CONF['debug'] = 1;

$nucleus['version'] = 'v3.1+ CVS';
if (getNucleusPatchLevel() > 0)
{
	$nucleus['version'] .= '/' . getNucleusPatchLevel();
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

/**
  * returns the currently used version (100 = 1.00, 101 = 1.01, etc...)
  */
function getNucleusVersion() {
	return 310;
}

/**
 * power users can install patches in between nucleus releases. These patches
 * usually add new functionality in the plugin API and allow those to
 * be tested without having to install CVS.
 */
function getNucleusPatchLevel() {
	return 0;
}


if ($CONF['debug']) {
	error_reporting(E_ALL & ~E_NOTICE);	// report almost all errors!
										// (no uninitialized vars and such)
} else {
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

// we will use postVar, getVar, ... methods instead of HTTP_GET_VARS or _GET
if ($CONF['installscript']!=1){ // vars were already included in install.php
  if (phpversion() >= '4.1.0')
	  include_once($DIR_LIBS . 'vars4.1.0.php');
  else
	  include_once($DIR_LIBS . 'vars4.0.6.php');
}

function intPostVar($name) { return intval(postVar($name));}
function intGetVar($name) { return intval(getVar($name));}
function intRequestVar($name) { return intval(requestVar($name)); }
function intCookieVar($name) { return intval(cookieVar($name)); }

// get all variables that can come from the request and put them in the global scope
$blogid			= requestVar('blogid');
$itemid			= intRequestVar('itemid');
$catid			= intRequestVar('catid');
$skinid			= requestVar('skinid');
$memberid		= requestVar('memberid');
$archivelist	= requestVar('archivelist');
$imagepopup		= requestVar('imagepopup');
$archive 		= requestVar('archive');
$query			= requestVar('query');
$highlight		= requestVar('highlight');
$amount			= requestVar('amount');
$action			= requestVar('action');
$nextaction		= requestVar('nextaction');
$maxresults     = requestVar('maxresults');
$startpos       = intRequestVar('startpos');

if (!headers_sent())
	header('Generator: Nucleus ' . $nucleus['version']);

// include core classes that are needed for login & plugin handling
include($DIR_LIBS . 'MEMBER.php');
include($DIR_LIBS . 'ACTIONLOG.php');
include($DIR_LIBS . 'MANAGER.php');
include($DIR_LIBS . 'PLUGIN.php');

$manager =& MANAGER::instance();

// make sure there's no unnecessary escaping:
set_magic_quotes_runtime(0);

// only needed when updating logs
if ($CONF['UsingAdminArea']) {
	include($DIR_LIBS . 'xmlrpc.inc.php');	// XML-RPC client classes
	include_once($DIR_LIBS . 'ADMIN.php');
}


// connect to sql
sql_connect();

// makes sure database connection gets closed on script termination
register_shutdown_function('sql_disconnect');

// read config
getConfig();

// automatically use simpler toolbar for mozilla
if (($CONF['DisableJsTools'] == 0) && strstr(serverVar('HTTP_USER_AGENT'),'Mozilla/5.0') && strstr(serverVar('HTTP_USER_AGENT'),'Gecko'))
	$CONF['DisableJsTools'] = 2;

// login if cookies set

$member = new MEMBER();

// login/logout when required or renew cookies
if ($action == 'login') {
	// Form Authentication
	$login 	= postVar('login');
	$pw 	= postVar('password');
	$shared	= intPostVar('shared');	// shared computer or not

	if ($member->login($login,$pw)) {

		$member->newCookieKey();
		$member->setCookies($shared);

		// allows direct access to parts of the admin area after logging in
		if ($nextaction)
			$action = $nextaction;

		$manager->notify('LoginSuccess',array('member' => &$member));
		ACTIONLOG::add(INFO, "Login successful for $login (sharedpc=$shared)");
	} else {
		$manager->notify('LoginFailed',array('username' => $login));
		ACTIONLOG::add(INFO, 'Login failed for ' . $login);
	}
/*

Backed out for now: See http://forum.nucleuscms.org/viewtopic.php?t=3684 for details

} elseif (serverVar('PHP_AUTH_USER') && serverVar('PHP_AUTH_PW')) {
	// HTTP Authentication
       $login  = serverVar('PHP_AUTH_USER');
       $pw     = serverVar('PHP_AUTH_PW');

       if ($member->login($login,$pw)) {
               $manager->notify('LoginSuccess',array('member' => &$member));
               ACTIONLOG::add(INFO, "HTTP authentication successful for $login");
       } else {
               $manager->notify('LoginFailed',array('username' => $login));
               ACTIONLOG::add(INFO, 'HTTP authentication failed for ' . $login);

               //Since bad credentials, generate an apropriate error page
               header("WWW-Authenticate: Basic realm=\"Nucleus {$nucleus['version']}\"");
               header('HTTP/1.0 401 Unauthorized');
               echo 'Invalid username or password';
               exit;
       }
*/

} elseif (($action == 'logout') && (!headers_sent()) && cookieVar('user')){
	// remove cookies on logout
	setcookie('user','',(time()-2592000),$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
	setcookie('loginkey','',(time()-2592000),$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
	$manager->notify('Logout',array('username' => cookieVar('user')));
} elseif (cookieVar('user')) {
	// Cookie Authentication
	$res = $member->cookielogin(cookieVar('user'), cookieVar('loginkey'));

	// renew cookies when not on a shared computer
	if ($res && (cookieVar('sharedpc') != 1) && (!headers_sent()))
		$member->setCookies();
}

// login completed
$manager->notify('PostAuthentication',array('loggedIn' => $member->isLoggedIn()));

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


// set lastVisit cookie (if allowed)
if (!headers_sent()) {
	if ($CONF['LastVisit'])
		setcookie('lastVisit',time(),time()+2592000,$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
	else
		setcookie('lastVisit','',(time()-2592000),$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
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

// decode path_info
if ($CONF['URLMode'] == 'pathinfo') {
	$data = explode("/",serverVar('PATH_INFO'));
	for ($i=0;$i<sizeof($data);$i++) {
		switch ($data[$i]) {
			case 'item':			// item/1 (blogid)
				$i++;
				if ($i<sizeof($data)) $itemid = intval($data[$i]);
				break;
			case 'archives':		// archives/1 (blogid)
				$i++;
				if ($i<sizeof($data)) $archivelist = intval($data[$i]);
				break;
			case 'archive':			// two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid)
				if ((($i+1)<sizeof($data)) && (!strstr($data[$i+1],'-')) ){
					$blogid = intval($data[++$i]);
				}
				$i++;
				if ($i<sizeof($data)) $archive = $data[$i];
				break;
			case 'blogid':			// blogid/1
			case 'blog':			// blog/1
				$i++;
				if ($i<sizeof($data)) $blogid = intval($data[$i]);
				break;
			case 'category':		// category/1 (catid)
			case 'catid':
				$i++;
				if ($i<sizeof($data)) $catid = intval($data[$i]);
				break;
			case 'member':
				$i++;
				if ($i<sizeof($data)) $memberid = intval($data[$i]);
				break;
			default:
				// skip...
		}
	}
}

/**
  * Connects to mysql server
  */
function sql_connect() {
	global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE;

	$connection = @mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD) or startUpError('<p>Could not connect to MySQL database.</p>','Connect Error');
	mysql_select_db($MYSQL_DATABASE) or startUpError('<p>Could not select database: '. mysql_error().'</p>', 'Connect Error');

	return $connection;
}

/**
 * returns a prefixed nucleus table name
 */
function sql_table($name)
{
	global $MYSQL_PREFIX;

	if ($MYSQL_PREFIX)
		return $MYSQL_PREFIX . 'nucleus_' . $name;
	else
		return 'nucleus_' . $name;
}

function sendContentType($contenttype, $pagetype = '', $charset = _CHARSET) {
	global $manager, $CONF;
	
	if (!headers_sent()) {
		// if content type is application/xhtml+xml, only send it to browsers
		// that can handle it (IE6 cannot). Otherwise, send text/html
		
		// v2.5: For admin area pages, keep sending text/html (unless it's a debug version)
		//       application/xhtml+xml still causes too much problems with the javascript implementations
		if (
				($contenttype == 'application/xhtml+xml')
			&&	(($CONF['UsingAdminArea'] && !$CONF['debug']) || !stristr(serverVar('HTTP_ACCEPT'),'application/xhtml+xml'))
			)
		{
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
		
		header('Content-Type: ' . $contenttype . '; charset=' . $charset);			
	}
	
	

	
}

/**
 * Errors before the database connection has been made
 */
function startUpError($msg, $title) {
	?>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head><title><?php echo htmlspecialchars($title)?></title></head>
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
	if (!$highlight || !$expression) return $text;
	if (is_array($expression) && (count($expression) == 0))
		return $text;

	// add a tag in front (is needed for preg_match_all to work correct)
	$text = '<!--h-->'.$text;

	// split the HTML up so we have HTML tags
	// $matches[0][i] = HTML + text
	// $matches[1][i] = HTML
	// $matches[2][i] = text
	preg_match_all('/(<[^>]+>)([^<>]*)/', $text, $matches);

	// throw it all together again while applying the highlight to the text pieces
	$result = '';
	for ($i = 0; $i < sizeof($matches[2]); $i++) {
		if ($i != 0) $result .= $matches[1][$i];

		if (is_array($expression)) {
			foreach ($expression as $regex)
				if ($regex)
					$matches[2][$i] = @eregi_replace($regex,$highlight,$matches[2][$i]);
			$result .= $matches[2][$i];
		} else {
			$result .= @eregi_replace($expression,$highlight,$matches[2][$i]);
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
	$query = preg_replace('/\'|"/','',$query);

	if (!query) return array();

	$aHighlight = explode(' ', $query);

	for ($i = 0; $i<count($aHighlight); $i++) {
		$aHighlight[$i] = trim($aHighlight[$i]);
		if (strlen($aHighlight[$i]) < 3)
			unset($aHighlight[$i]);
	}

	if (count($aHighlight) == 1)
		return $aHighlight[0];
	else
		return $aHighlight;
}

/**
  * Checks if email address is valid
  */
function isValidMailAddress($address) {
	if (preg_match('/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[A-Za-z]{2,5}$/', $address))
		return 1;
	else
		return 0;
}


// some helper functions
function getBlogIDFromName($name) {
	return quickQuery('SELECT bnumber as result FROM '.sql_table('blog').' WHERE bshortname="'.addslashes($name).'"');
}
function getBlogNameFromID($id) {
	return quickQuery('SELECT bname as result FROM '.sql_table('blog').' WHERE bnumber='.intval($id));
}
function getBlogIDFromItemID($itemid) {
	return quickQuery('SELECT iblog as result FROM '.sql_table('item').' WHERE inumber='.intval($itemid));
}
function getBlogIDFromCommentID($commentid) {
	return quickQuery('SELECT cblog as result FROM '.sql_table('comment').' WHERE cnumber='.intval($commentid));
}
function getBlogIDFromCatID($catid) {
	return quickQuery('SELECT cblog as result FROM '.sql_table('category').' WHERE catid='.intval($catid));
}
function getCatIDFromName($name) {
	return quickQuery('SELECT catid as result FROM '.sql_table('category').' WHERE cname="'.addslashes($name).'"');
}
function quickQuery($q) {
	$res = sql_query($q);
	$obj = mysql_fetch_object($res);
	return $obj->result;
}

function getPluginNameFromPid($pid) {
	$obj = mysql_fetch_object(sql_query('SELECT pfile FROM '.sql_table('plugin').' WHERE pid='.intval($pid)));
	return $obj->pfile;
}

function selector() {
	global $itemid, $blogid, $memberid, $query, $amount, $archivelist, $maxresults;
	global $archive, $skinid, $blog, $memberinfo, $CONF, $member;
	global $imagepopup, $catid;
	global $manager;

	// first, let's see if the site is disabled or not
	if ($CONF['DisableSite'] && !$member->isAdmin()) {
		header('Location: ' . $CONF['DisableSiteURL']);
		exit;
	}

	// show error when headers already sent out
	if (headers_sent() && $CONF['alertOnHeadersSent']) {

		// try to get line number/filename (extra headers_sent params only exists in PHP 4.3+)
		if (function_exists('version_compare') && version_compare('4.3.0', phpversion(), '<=')) {
			headers_sent($hsFile, $hsLine);
			$extraInfo = ' in <code>'.$hsFile.'</code> line <code>'.$hsLine.'</code>';
		} else {
			$extraInfo = '';
		}


		startUpError(
			'<p>The page headers have already been sent out'.$extraInfo.'. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the language file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>',
			'Page headers already sent'
		);
		exit;
	}

	// make is so ?archivelist without blogname or blogid shows the archivelist
	// for the default weblog
	if (serverVar('QUERY_STRING') == 'archivelist')
		$archivelist = $CONF['DefaultBlog'];

	// now decide which type of skin we need
	if ($itemid) {
		// itemid given -> only show that item
		$type = 'item';
		if (!$manager->existsItem($itemid,0,0))
			doError(_ERROR_NOSUCHITEM);


		global $itemidprev, $itemidnext, $catid, $itemtitlenext, $itemtitleprev;

		// 1. get timestamp and blogid for item
		$query = 'SELECT itime, iblog FROM '.sql_table('item').' WHERE inumber=' . intval($itemid);
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);

		// if a different blog id has been set through the request or selectBlog(),
		// deny access
		if ($blogid && (intval($blogid) != $obj->iblog))
			doError(_ERROR_NOSUCHITEM);

		$blogid = $obj->iblog;
		$timestamp = strtotime($obj->itime);

		$b =& $manager->getBlog($blogid);
		if ($b->isValidCategory($catid))
			$catextra = ' and icat=' . $catid;

		// get previous itemid and title
		$query = 'SELECT inumber, ititle FROM '.sql_table('item').' WHERE itime<' . mysqldate($timestamp) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime DESC LIMIT 1';
		$res = sql_query($query);

		$obj = mysql_fetch_object($res);
		if ($obj) {
			$itemidprev = $obj->inumber;
			$itemtitleprev = $obj->ititle;
    	}

		// get next itemid and title
		$query = 'SELECT inumber, ititle FROM '.sql_table('item').' WHERE itime>' . mysqldate($timestamp) . ' and itime <= ' . mysqldate(time()) . ' and idraft=0 and iblog=' . $blogid . $catextra . ' ORDER BY itime ASC LIMIT 1';
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

		sscanf($archive,'%d-%d-%d',$y,$m,$d);
		if ($d != 0) {
			$archivetype = 'day';	// TODO: move to language file
			$t = mktime(0,0,0,$m,$d,$y);
			$archiveprev = strftime('%Y-%m-%d',$t - (24*60*60));
			$archivenext = strftime('%Y-%m-%d',$t + (24*60*60));

		} else {
			$archivetype = 'month'; // TODO: move to language file
			$t = mktime(0,0,0,$m,1,$y);
			$archiveprev = strftime('%Y-%m',$t - (1*24*60*60));
			$archivenext = strftime('%Y-%m',$t + (32*24*60*60));
		}


	} elseif ($archivelist) {
		$type = 'archivelist';
		if (intval($archivelist) != 0)
			$blogid = $archivelist;
		else
			$blogid = getBlogIDFromName($archivelist);
		if (!$blogid) doError(_ERROR_NOSUCHBLOG);
	} elseif ($query) {
	    global $startpos;
		$type = 'search';
		$query = stripslashes($query);
		if (intval($blogid)==0)
			$blogid = getBlogIDFromName($blogid);
		if (!$blogid) doError(_ERROR_NOSUCHBLOG);
	} elseif ($memberid) {
		$type = 'member';
		if (!MEMBER::existsID($memberid))
			doError(_ERROR_NOSUCHMEMBER);
		$memberinfo = MEMBER::createFromID($memberid);

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
	if (!$blogid)
		$blogid = $CONF['DefaultBlog'];

	$b =& $manager->getBlog($blogid);
	$blog = $b;	// references can't be placed in global variables?
	if (!$blog->isValid)
		doError(_ERROR_NOSUCHBLOG);

	// set catid if necessary
	if ($catid)
		$blog->setSelectedCategory($catid);

	// decide which skin should be used
	if ($skinid != '' && ($skinid == 0))
		selectSkin($skinid);
	if (!$skinid)
		$skinid = $blog->getDefaultSkin();

	
	$skin = new SKIN($skinid);
	if (!$skin->isValid)
		doError(_ERROR_NOSUCHSKIN);

	// parse the skin
	$skin->parse($type);
}

/**
  * Show error skin with given message. An optional skin-object to use can be given
  */
function doError($msg, $skin = '') {
	global $errormessage, $CONF, $skinid, $blogid, $manager;

	if ($skin == '') {
		if (SKIN::existsID($skinid)) {
			$skin = new SKIN($skinid);
		} elseif ($manager->existsBlogID($blogid)) {
			$blog =& $manager->getBlog($blogid);
			$skin = new SKIN($blog->getDefaultSkin());
		} elseif ($CONF['DefaultBlog']) {
			$blog =& $manager->getBlog($CONF['DefaultBlog']);
			$skin = new SKIN($blog->getDefaultSkin());
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

	$query = 'SELECT * FROM '.sql_table('config');
	$res = sql_query($query);
	while ($obj = mysql_fetch_object($res)) {
		$CONF[$obj->name] = $obj->value;
	}
}

// some checks for names of blogs, categories, templates, members, ...
function isValidShortName($name) {		return eregi('^[a-z0-9]+$', $name); }
function isValidDisplayName($name) {	return eregi('^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$', $name); }
function isValidCategoryName($name) {	return 1; } 
function isValidTemplateName($name) {	return eregi('^[a-z0-9/]+$', $name); }
function isValidSkinName($name) {		return eregi('^[a-z0-9/]+$', $name); }

// add and remove linebreaks
function addBreaks($var) { 				return nl2br($var); }
function removeBreaks($var) {			return preg_replace("/<br \/>([\r\n])/","$1",$var); }

/**
  * Generate a 'pronouncable' password
  * (http://www.zend.com/codex.php?id=215&single=1)
  */
function genPassword($length){

    srand((double)microtime()*1000000);

    $vowels = array('a', 'e', 'i', 'o', 'u');
    $cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
    'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph', 'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');

    $num_vowels = count($vowels);
    $num_cons = count($cons);

    for($i = 0; $i < $length; $i++){
        $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
    }

    return substr($password, 0, $length);
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
		$text = substr($text,0,$maxlength-strlen($toadd)) . $toadd;
	return $text;
}

/**
  * Converts a unix timestamp to a mysql DATETIME format, and places
  * quotes around it.
  */
function mysqldate($timestamp) {
	return '"' . date('Y-m-d H:i:s',$timestamp) . '"';
}

/**
  * functions for use in index.php
  */
function selectBlog($shortname) {
	global $blogid, $archivelist;
	$blogid = getBlogIDFromName($shortname);

	// also force archivelist variable, if it is set
	if ($archivelist)
		$archivelist = $blogid;
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
	if (is_numeric($cat))
		$catid = intval($cat);
	else
		$catid = getCatIDFromName($cat);
}

function selectItem($id){
	global $itemid;
	$itemid = intval($id);
}

// force the use of a language file (warning: can cause warnings)
function selectLanguage($language) {
	global $DIR_LANG;
	include($DIR_LANG . ereg_replace( '[\\|/]', '', $language) . '.php');
}

function parseFile($filename) {
	$handler = new ACTIONS('fileparser');
	$parser = new PARSER(SKIN::getAllowedActionsForType('fileparser'), $handler);
	$handler->parser =& $parser;

	if (!file_exists($filename)) doError('A file is missing');

	// read file
	$fd = fopen ($filename, 'r');
	$contents = fread ($fd, filesize ($filename));
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
function addToLog($level, $msg) { ACTIONLOG::add($level, $msg); }

// shows a link to help file
function help($id) {
	echo helpHtml($id);
}

function helpHtml($id) {
	return helplink($id) . '<img src="documentation/icon-help.gif" width="15" height="15" alt="'._HELP_TT.'" /></a>';
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

	if ($member) {
		// try to use members language
		$memlang = $member->getLanguage();

		if (($memlang != '') && (checkLanguage($memlang)))
			return $memlang;
	}

	// use default language
	if (checkLanguage($CONF['Language']))
		return $CONF['Language'];
	else
		return 'english';
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

	include($filename);
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


$CONF['ItemURL'] = $CONF['Self'];
$CONF['ArchiveURL'] = $CONF['Self'];
$CONF['ArchiveListURL'] = $CONF['Self'];
$CONF['MemberURL'] = $CONF['Self'];
$CONF['SearchURL'] = $CONF['Self'];
$CONF['BlogURL'] = $CONF['Self'];
$CONF['CategoryURL'] = $CONF['Self'];

// switch URLMode back to normal when $CONF['Self'] ends in .php
// this avoids urls like index.php/item/13/index.php/item/15
if (	($CONF['URLMode'] == 'pathinfo')
	&&	(substr($CONF['Self'], strlen($CONF['Self']) - 4) == '.php')
	) {
	$CONF['URLMode'] = 'normal';
}

/**
  * Centralisation of the functions that generate links
  */
function createItemLink($itemid, $extra = '') {
	global $CONF;
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['ItemURL'] . '/item/' . $itemid;
	else
		$link = $CONF['ItemURL'] . '?itemid=' . $itemid;
	return addLinkParams($link, $extra);
}
function createMemberLink($memberid, $extra = '') {
	global $CONF;
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['MemberURL'] . '/member/' . $memberid;
	else
		$link = $CONF['MemberURL'] . '?memberid=' . $memberid;
	return addLinkParams($link, $extra);
}
function createCategoryLink($catid, $extra = '') {
	global $CONF;
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['CategoryURL'] . '/category/' . $catid;
	else
		$link = $CONF['CategoryURL'] . '?catid=' . $catid;
	return addLinkParams($link, $extra);
}
function createArchiveListLink($blogid = '', $extra = '') {
	global $CONF;
	if (!$blogid)
		$blogid = $CONF['DefaultBlog'];
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['ArchiveListURL'] . '/archives/' . $blogid;
	else
		$link = $CONF['ArchiveListURL'] . '?archivelist=' . $blogid;
	return addLinkParams($link, $extra);
}
function createArchiveLink($blogid, $archive, $extra = '') {
	global $CONF;
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['ArchiveURL'] . '/archive/'.$blogid.'/' . $archive;
	else
		$link = $CONF['ArchiveURL'] . '?blogid='.$blogid.'&amp;archive=' . $archive;
	return addLinkParams($link, $extra);
}
function createBlogLink($url, $params) {
	return addLinkParams($url . '?', $params);
}
function createBlogidLink($blogid, $params = '') {
	global $CONF;
	if ($CONF['URLMode'] == 'pathinfo')
		$link = $CONF['BlogURL'] . '/blog/' . $blogid;
	else
		$link = $CONF['BlogURL'] . '?blogid=' . $blogid;
	return addLinkParams($link, $params);
}


function addLinkParams($link, $params) {
	global $CONF;
	if (is_array($params)) {
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
    $vars = explode("&", $querystr);
    $set  = false;
    for ($i=0;$i<count($vars);$i++) {
        $v = explode('=',$vars[$i]);
        if ($v[0] == $param) {
            $v[1]     = $value;
            $vars[$i] = implode('=', $v);
            $set      = true;
            break;
        }
    }
    if (!$set) {$vars[] = $param . '=' . $value;}
    return ltrim(implode('&', $vars), '&');
}

// passes one variable as hidden input field (multiple fields for arrays)
// @see passRequestVars in varsx.x.x.php
function passVar($key, $value) {
	// array ?
	if (is_array($value)) {
		for ($i=0;$i<sizeof($value);$i++)
			passVar($key.'['.$i.']',$value[$i]);
			return;
	}

	// other values: do stripslashes if needed
	?><input type="hidden" name="<?php echo htmlspecialchars($key)?>" value="<?php echo htmlspecialchars(undoMagic($value))?>" /><?php
}

/*
	Date format functions (to be used from [%date(..)%] skinvars
*/
function formatDate($format, $timestamp, $defaultFormat) {
	if ($format == 'rfc822') { 
		return date('r', $timestamp); 
	} else if ($format == 'rfc822GMT') { 
		return gmdate('r', $timestamp); 
	} else if ($format == 'utc') { 
		return gmdate('Y-m-d\TH:i:s\Z', $timestamp); 
	} else if ($format == 'iso8601') {
       	$tz = date('O', $timestamp);
        $tz = substr($tz, 0, 3) . ':' . substr($tz, 3, 2);	
		return gmdate('Y-m-d\TH:i:s', $timestamp) . $tz;
	} else {  
		return strftime($format ? $format : $defaultFormat,$timestamp); 
	}  

}

function checkVars($aVars)
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES, $HTTP_SESSION_VARS;
	foreach ($aVars as $varName)
	{
		if (   isset($HTTP_GET_VARS[$varName]) 
			|| isset($HTTP_POST_VARS[$varName]) 
			|| isset($HTTP_COOKIE_VARS[$varName])
			|| isset($HTTP_ENV_VARS[$varName])
			|| isset($HTTP_SESSION_VARS[$varName])
			|| isset($HTTP_POST_FILES[$varName])
		){
			die('Sorry. An error occurred.');
		}
	}
}

?>
