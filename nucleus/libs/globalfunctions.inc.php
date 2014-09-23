<?php
/**
 * include_libs()
 * This function includes or requires the specified library file
 * 
 * @param	string	$file
 * @param	boolean	$once use the _once() version
 * @param	boolean	$require use require() instead of include()
 * @return	void
 */
function include_libs($file, $once = TRUE, $require = TRUE)
{
	global $DIR_LIBS;
	
	$lib_path = $DIR_LIBS . $file;
	if ( !is_file($lib_path) ) exit;
	
	if ( $once && $require )      require_once($lib_path);
	elseif ( $once && !$require ) include_once($lib_path);
	elseif ( $require )           require($lib_path);
	else                          include($lib_path);
	
	return;
}

/**
 * include_plugins()
 * This function includes or requires the specified plugin file
 * 
 * @param	string	$file
 * @param	boolean	$once use the _once() version
 * @param	boolean	$require use require() instead of include()
 * @return	
 */
function include_plugins($file, $once = TRUE, $require = TRUE)
{
	global $DIR_PLUGINS;
	
	$plugin_path = $DIR_PLUGINS . $file;
	if(!is_file($plugin_path)) exit;
	
	// begin if: 
	if ( $once && $require )      require_once($plugin_path);
	elseif ( $once && !$require ) include_once($plugin_path);
	elseif ( $require )           require($plugin_path);
	else                          include($plugin_path);
	
	return;
}

/**
 * include_translation()
 * This function decide which locale is used and include translation
 * 
 * @param	string	&$locale	locale name referring to 'language tags' defined in RFC 5646
 * @return	void
 */
function include_translation(&$locale)
{
	global $DIR_LOCALES;
	
	$current_charset = i18n::get_current_charset();
	$translation_file = "{$DIR_LOCALES}{$locale}.{$current_charset}.php";
	if ( !is_file($translation_file) )
	{
		$locale = 'en_Latn_US';
		$translation_file = "{$DIR_LOCALES}en_Latn_US.ISO-8859-1.php";
	}
	include($translation_file);
	
	/*
	 * NOTE:
	 * PHP is written by C and utilize C library, whose APIs are defined in POSIX.
	 * 
	 * setlocale() is one of APIs of C library.
	 * but the argument value for setlocale() depends on each implements
	 * 
	 * The latest POSIX standard:
	 * The Open Group Base Specifications Issue 7
	 * IEEE Std 1003.1™-2008
	 * http://pubs.opengroup.org/onlinepubs/9699919799/mindex.html
	 * 
	 * Microsoft's operating system uses their own implementation
	 *  Language Strings
	 *   http://msdn.microsoft.com/en-us/library/39cwe7zf%28v=vs.110%29.aspx
	 *  Country/Region Strings
	 *   http://msdn.microsoft.com/en-us/library/cdax410z%28v=vs.110%29.aspx
	 * 
	 * Linux and Unix (in this meaning, Apple's OS X derives from UNIX) uses ISO standard.
	 *  two characters language tag (ISO 639-1)
	 *  two characters region and country lag (ISO 3166-1 alpha-1)
	 * 
	 */
	if ( PHP_OS == "WIN32" || PHP_OS == "WINNT" )
	{
		/* LOCALE_IN_WINDOWS is defined in each translation files */
		setlocale(LC_ALL, _LOCALE_IN_WINDOWS);
	}
	else
	{
		setlocale(LC_ALL, preg_replace('#(.+)_(.+)_(.+)#', '$1-$3', $locale));
	}
	return;
}

/**
 * intPostVar()
 * This function returns the integer value of $_POST for the variable $name
 * 
 * @param	string	$name	field to get the integer value of
 * @return	integer
 */
function intPostVar($name)
{
	return (integer) postVar($name);
}


/**
 * intGetVar()
 * This function returns the integer value of $_GET for the variable $name
 * 
 * @param	string	$name	field to get the integer value of
 * @return	integer
 */
function intGetVar($name)
{
	return (integer) getVar($name);
}


/**
 * intRequestVar()
 * This function returns the integer value of $_REQUEST for the variable $name. Also checks $_GET and $_POST if not found in $_REQUEST
 * 
 * @param string $name field to get the integer value of
 * @return int
 */
function intRequestVar($name)
{
	return (integer) requestVar($name);
}


/**
 * intCookieVar()
 * This function returns the integer value of $_COOKIE for the variable $name
 * 
 * @param	string	$name	field to get the integer value of
 * @return	integer
 */
function intCookieVar($name)
{
	return (integer) cookieVar($name);
}

/**
 * getNucleusVersion()
 * This function returns the current Nucleus version (100 = 1.00, 101 = 1.01, etc...)
 * 
 * @param	void
 * @return	integer
 */
function getNucleusVersion()
{
	return 400;
}

/**
 * getNucleusPatchLevel()
 * TODO: Better description of this function.
 *
 * Power users can install patches in between nucleus releases. These patches
 * usually add new functionality in the plugin API and allow those to
 * be tested without having to install CVS.
 *
 *@param	void
 * @return	integer
 */
function getNucleusPatchLevel()
{
	return 0;
}

/**
 * getLatestVersion()
 * This function returns the latest Nucleus version available for download from nucleuscms.org or FALSE if unable to attain data
 * Format will be major.minor/patachlevel e.g. 3.41 or 3.41/02
 * 
 * @param	void
 * @return	mixed
 */
function getLatestVersion()
{
	// begin if: cURL is not available in this PHP installation
	if ( !function_exists('curl_init') )
	{
		return FALSE;
	}
	
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
 * sql_table()
 * This function returns a Nucleus table name with the appropriate prefix
 * @param string $name
 * @return string
 */
function sql_table($name='')
{
	global $MYSQL_PREFIX;
	
	if ( empty($MYSQL_PREFIX) ) $MYSQL_PREFIX = '';
	
	return "{$MYSQL_PREFIX}nucleus_{$name}";
}

/**
 * sendContentType()
 * This function sends the Content-Type header if headers have not already been sent
 * It also determines if the browser can accept application/xhtml+xml and sends it only to those that can.
 * 
 * if content type is application/xhtml+xml, only send it to browsers
 * that can handle it (IE6 cannot). Otherwise, send text/html
 *
 * v2.5:
 * For admin area pages, keep sending text/html (unless it's a debug version)
 * application/xhtml+xml still causes too much problems with the javascript implementations
 *
 * v3.3:
 * ($CONF['UsingAdminArea'] && !$CONF['debug']) gets removed,
 * application/xhtml+xml seems to be working, so we're going to use it if we can.
 * 
 * @param	string	$content_type	MIME media type registered to IANA, http://www.iana.org/assignments/media-types/index.html
 * @param	string	$page_type		
 * @param	string	$charset		Deprecated. This has no meaning.
 * @return	void
 * 
 */
function sendContentType($content_type, $page_type = '', $charset = '')
{
	global $manager, $CONF;
	
	if ( headers_sent() )
	{
		return;
	}
	
	/* NOTE: MIME Media Type */
	if ( ($content_type == 'application/xhtml+xml')
		&& (!stristr(serverVar('HTTP_ACCEPT'), 'application/xhtml+xml') ) )
	{
		$content_type = 'text/html';
	}
	
	/* NOTE: generate event */
	$data = array(
		'pageType'		=>  $page_type,
		'contentType'	=> &$content_type
	);
	$manager->notify('PreSendContentType', $data);
	
	/* NOTE: confirm MIME Media Type */
	$content_type = preg_replace('#[^a-zA-Z0-9-+./]#', '', $content_type);
	
	/* NOTE: confirm character set */
	$charset = i18n::get_current_charset();
	if ( i18n::get_forced_charset() !== '' )
	{
		$charset = i18n::get_forced_charset();
	}
	
	/* NOTE: send HTTP 1.1 header */
	header("Content-Type: {$content_type}; charset={$charset}");
	
	/* NOTE: set handler for translating character set */
	if ( $charset != i18n::get_current_charset() )
	{
		ob_start(array('i18n', 'convert_handler'));
	}
	
	return;
}

/**
 * parseHighlight()
 * This function parses a query into an array of expressions that can be passed on to the highlight method
 * @param	string	$query
 * @return	void
 */
function parseHighlight($query)
{
	// TODO: add more intelligent splitting logic
	
	// get rid of quotes
	if(strpos($query, "'")) $query = str_replace("'", '', $query);
	if(strpos($query, '"')) $query = str_replace('"', '', $query);
	
	if ( !$query ) return array();
	
	$aHighlight = explode(' ', $query);
	$total = count($aHighlight);
	
	for ( $i = 0; $i < $total; $i++ )
	{
		$aHighlight[$i] = trim($aHighlight[$i]);
		
		if ( i18n::strlen($aHighlight[$i]) < 3 )
		{
			unset($aHighlight[$i]);
		}
	}
	
	if ( count($aHighlight) == 1 ) return $aHighlight[0];
	else                           return $aHighlight;
}

/**
 * getConfig()
 * 
 * @param	void
 * @return	void
 */
function getConfig()
{
	global $CONF;
	
	$query = sprintf('SELECT * FROM %s', sql_table('config'));
	$res = DB::getResult($query);
	
	foreach ( $res as $row )
	{
		$CONF[$row['name']] = $row['value'];
	}
	return;
}

/**
 * This function gets the blog ID from the blog name
 * @param string $name
 * @return
 */
function getBlogIDFromName($name)
{
	$query = sprintf('SELECT bnumber AS result FROM %s WHERE bshortname=%s', sql_table('blog'), DB::quoteValue($name));
	return DB::getValue($query);
}

/**
 * This function gets the blog name from the blog ID
 * @param int $id
 * @return object
 */
function getBlogNameFromID($id)
{
	$query = sprintf('SELECT bname AS result FROM %s WHERE bnumber=%d', sql_table('blog'), intval($id));
	return DB::getValue($query);
}

/**
 * This function gets the blog ID from the item ID
 * @param int $item_id
 * @return object
 */
function getBlogIDFromItemID($item_id)
{
	$query = sprintf('SELECT iblog AS result FROM %s WHERE inumber=%d', sql_table('item'), intval($item_id));
	return DB::getValue($query);
}

/**
 * This function gets the blog ID from the comment ID
 * @param int $comment_id
 * @return object
 */
function getBlogIDFromCommentID($comment_id)
{
	$query = sprintf('SELECT cblog AS result FROM %s WHERE cnumber=%d', sql_table('comment'), intval($comment_id));
	return DB::getValue($query);
}

/**
 * This function gets the blog ID from the category ID
 * @param int $category_id
 * @return object
 */
function getBlogIDFromCatID($category_id)
{
	$query = sprintf('SELECT cblog AS result FROM %s WHERE catid=%d', sql_table('category'), intval($category_id));
	return DB::getValue($query);
}

/**
 * This function gets the category ID from the category name
 * @param int $name
 * @return object
 */
function getCatIDFromName($name)
{
	$query = sprintf('SELECT catid AS result FROM %s WHERE cname=%s', sql_table('category'), DB::quoteValue($name));
	return DB::getValue($query);
}


/**
 * functions to be used in index.php to select something
 */
function selectBlog($shortname)
{
	global $blogid, $archivelist;
	$blogid = getBlogIDFromName($shortname);
	
	// also force archivelist variable, if it is set
	if ( $archivelist )
	{
		$archivelist = $blogid;
	}
	return;
}
function selectSkin($skinname)
{
	global $skinid;
	$skinid = SKIN::getIdFromName($skinname);
	return;
}
function selectCategory($cat)
{
	global $catid;
	if ( is_numeric($cat) )
	{
		$catid = (integer) $cat;
	}
	else
	{
		$catid = getCatIDFromName($cat);
	}
	return;
}
function selectItem($id)
{
	global $itemid;
	$itemid = (integer) $id;
	return;
}
function selectSpecialSkinType($id)
{
	global $special;
	$special = strtolower($id);
	return;
}
function selector()
{
	global $archive, $archivelist, $archivenext, $archivenextexists, $archiveprev, $archiveprevexists, $archivetype;
	global $blog, $blogid;
	global $catid;
	global $itemid, $itemidnext, $itemidprev, $itemtitlenext, $itemtitleprev;
	global $CONF, $DIR_LIBS, $amount, $errormessage, $imagepopup;
	global $manager, $maxresults, $query;
	global $member, $memberid, $memberinfo;
	global $skinid, $skinpart, $special;
	
	$actionNames = array('addcomment', 'sendmessage', 'createaccount', 'forgotpassword', 'votepositive', 'votenegative', 'plugin');
	$action = requestVar('action');
	
	if ( in_array($action, $actionNames) )
	{
		include_once("{$DIR_LIBS}ACTION.php");
		$a = new Action();
		$errorInfo = $a->doAction($action);
		
		if ( $errorInfo )
		{
			$errormessage = $errorInfo['message'];
		}
	}
	
	// show error when headers already sent out
	if ( headers_sent() && $CONF['alertOnHeadersSent'] )
	{
		// try to get line number/filename
		headers_sent($hsFile, $hsLine);
		$extraInfo = " in <code>{$hsFile}</code> line <code>{$hsLine}</code>";
		
		startUpError(
		   "<p>The page headers have already been sent out{$extraInfo}. This could cause Nucleus not to work in the expected way.</p>"
		 . "<p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, "
		 . "at the end of the translation file or at the end of a plugin file.</p>"
		 . "<p>Please check this and try again.</p>"
		 . "<p>If you don't want to see this error message again, without solving the problem, "
		 . "set <code>{$CONF['alertOnHeadersSent']}</code> in <code>globalfunctions.php</code> to <code>0</code></p>"
		 . "Page headers already sent"
		);
		exit;
	}
	
	// make is so ?archivelist without blogname or blogid shows the archivelist
	// for the default weblog
	if ( serverVar('QUERY_STRING') === 'archivelist' )
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
			return;
		}
		
		// 1. get timestamp, blogid and catid for item
		$query = sprintf('SELECT itime, iblog, icat FROM %s WHERE inumber=%d', sql_table('item'), intval($itemid));
		$row = DB::getRow($query);
		
		// if a different blog id has been set through the request or selectBlog(),
		// deny access
		
		if ( $blogid && (intval($blogid) != $row['iblog']) )
		{
			doError(_ERROR_NOSUCHITEM);
			return;
		}
		
		// if a category has been selected which doesn't match the item, ignore the
		// category. #85
		if ( ($catid != 0) && ($catid != $row['icat']) )
		{
			$catid = 0;
		}
		
		$blogid = $row['iblog'];
		$timestamp = strtotime($row['itime']);
		
		$b =& $manager->getBlog($blogid);
		
		if ( !$b->isValidCategory($catid) )
		{
			$query = "SELECT inumber, ititle FROM %s WHERE itime<%s AND idraft=0 AND iblog=%d ORDER BY itime DESC LIMIT 1";
			$query = sprintf($query, sql_table('item'), DB::formatDateTime($timestamp), intval($blogid));
		}
		else
		{
			$query = "SELECT inumber, ititle FROM %s WHERE itime<%s AND idraft=0 AND iblog=%d AND icat=%d ORDER BY itime DESC LIMIT 1";
			$query = sprintf($query, sql_table('item'), DB::formatDateTime($timestamp), intval($blogid), intval($catid));
		}
		$row = DB::getRow($query);
		
		if ( $row )
		{
			$itemidprev = $row['inumber'];
			$itemtitleprev = $row['ititle'];
		}
		
		// get next itemid and title
		if ( !$b->isValidCategory($catid) )
		{
			$query = "SELECT inumber, ititle FROM %s WHERE itime>%s AND itime<=%s AND idraft=0 AND iblog=%d ORDER BY itime ASC LIMIT 1";
			$query = sprintf($query, sql_table('item'), DB::formatDateTime($timestamp), DB::formatDateTime($b->getCorrectTime()), intval($blogid));
		}
		else
		{
			$query = "SELECT inumber, ititle FROM %s WHERE itime>%s AND itime<=%s AND idraft=0 AND iblog=%d AND icat=%d ORDER BY itime ASC LIMIT 1";
			$query = sprintf($query, sql_table('item'), DB::formatDateTime($timestamp), DB::formatDateTime($b->getCorrectTime()), intval($blogid), intval($catid));
		}
		$row = DB::getRow($query);
		
		if ( $row )
		{
			$itemidnext = $row['inumber'];
			$itemtitlenext = $row['ititle'];
		}
	}
	elseif ( $archive )
	{
		// show archive
		$type = 'archive';
		
		// sql queries for the timestamp of the first and the last published item
		$query = sprintf('SELECT UNIX_TIMESTAMP(itime) as result FROM %s WHERE idraft=0 ORDER BY itime ASC', sql_table('item'));
		$first_timestamp = DB::getValue($query);
		$query = sprintf('SELECT UNIX_TIMESTAMP(itime) as result FROM %s WHERE idraft=0 ORDER BY itime DESC', sql_table('item'));
		$last_timestamp = DB::getValue($query);
		
		sscanf($archive, '%d-%d-%d', $y, $m, $d);
		
		if ( $d != 0 )
		{
			$archivetype = _LABEL_DAY_UNIT;
			$t = mktime(0, 0, 0, $m, $d, $y);
			// one day has 24 * 60 * 60 = 86400 seconds
			$archiveprev = i18n::formatted_datetime('%Y-%m-%d', $t - 86400 );
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
			$archivenext = i18n::formatted_datetime('%Y-%m-%d', $t);
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
			$archivetype = _LABEL_YEAR_UNIT;
			$t = mktime(0, 0, 0, 12, 31, $y - 1);
			// one day before is in the previous year
			$archiveprev = i18n::formatted_datetime('%Y', $t);
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
			$archivenext = i18n::formatted_datetime('%Y', $t);
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
			$archivetype = _LABEL_MONTH_UNIT;
			$t = mktime(0, 0, 0, $m, 1, $y);
			// one day before is in the previous month
			$archiveprev = i18n::formatted_datetime('%Y-%m', $t - 86400);
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
			$archivenext = i18n::formatted_datetime('%Y-%m', $t);
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
	elseif ( $archivelist )
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
			return;
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
			return;
		}
	}
	elseif ( $memberid )
	{
		$type = 'member';
		
		if ( !Member::existsID($memberid) )
		{
			doError(_ERROR_NOSUCHMEMBER);
			return;
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
		return;
	}
	
	// set catid if necessary
	if ( $catid )
	{
		// check if the category is valid
		if ( !$blog->isValidCategory($catid) )
		{
			doError(_ERROR_NOSUCHCATEGORY);
			return;
		}
		else
		{
			$blog->setSelectedCategory($catid);
		}
	}
	
	if ( !$skinid )
	{
		$skinid = $blog->getDefaultSkin();
	}
	
	if ( !empty($special) && isValidShortName($special) )
	{
		$type = strtolower($special);
	}
	
	$skin =& $manager->getSkin($skinid);
	
	if ( !$skin->isValid() )
	{
		doError(_ERROR_NOSUCHSKIN);
		return;
	}
	
	// set global skinpart variable so can determine quickly what is being parsed from any plugin or phpinclude
	$skinpart = $type;
	
	// parse the skin
	$skin->parse($type);
	
	// check to see we should throw JustPosted event
	$blog->checkJustPosted();
	return;
}

/**
 * doError()
 * Show error skin with given message. An optional skin-object to use can be given
 * 
 * @param	string	$msg
 * @param	string	$skin
 * @return	void
 */
function doError($msg, $skin = '')
{
	global $errormessage, $CONF, $skinid, $blogid, $manager;
	
	if ( $skin == '' )
	{
		if ( Skin::existsID($skinid) )
		{
			$id = $skinid;
		}
		elseif ( $manager->existsBlogID($blogid) )
		{
			$blog =& $manager->getBlog($blogid);
			$id = $blog->getDefaultSkin();
		}
		elseif ($CONF['DefaultBlog'] )
		{
			$blog =& $manager->getBlog($CONF['DefaultBlog']);
			$id = $blog->getDefaultSkin();
		}
		else
		{
			// this statement should actually never be executed
			$id = $CONF['BaseSkin'];
		}
		$skin =& $manager->getSkin($id);
	}
	
	$errormessage = $msg;
	$skin->parse('error');
	return;
}

/**
 * Errors before the database connection has been made
 * 
 * @param	string	$msg	message to notify
 * @param	string	$title	page title
 * @return	void
 */
function startUpError($msg, $title)
{
	header('Content-Type: text/xml; charset=' . i18n::get_current_charset());
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n";
	echo "<title>{$title}</title></head>\n";
	echo "<body>\n";
	echo "<h1>{$title}</h1>\n";
	echo $msg;
	echo "</body>\n";
	echo "</html>\n";
	exit;
}

function isValidShortName($name)
{
	return preg_match('#^[a-z0-9]+$#i', $name);
}
function isValidDisplayName($name)
{
	return preg_match('#^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$#i', $name);
}
function isValidCategoryName($name)
{
	return 1;
}
function isValidTemplateName($name)
{
	return preg_match('#^[a-z0-9/_\-]+$#i', $name);
}
function isValidSkinName($name)
{
	return preg_match('#^[a-z0-9/_\-]+$#i', $name);
}

// add and remove linebreaks
function addBreaks($var)
{
	return nl2br($var);
}
function removeBreaks($var)
{
	return preg_replace("/<br \/>([\r\n])/", "$1", $var);
}

/**
 * parseFile()
 * 
 * @param	string	$filename
 * @param	string	$includeMode
 * @param	string	$includePrefix
 * @return	void
 */
function parseFile($filename, $includeMode = 'normal', $includePrefix = '')
{
	global $manager, $skinid;
	
	if ( !$skinid || !existsID($skinid) )
	{
		$skin =& $manager->getSkin($CONF['BaseSkin']);
	}
	else
	{
		$skin =& $manager->getSkin($skinid);
	}
	
	$oldIncludeMode = Parser::getProperty('IncludeMode');
	$oldIncludePrefix = Parser::getProperty('IncludePrefix');
	
	$skin->parse('fileparse', $filename);
	
	Parser::setProperty('IncludeMode', $oldIncludeMode);
	Parser::setProperty('IncludePrefix', $oldIncludePrefix);
	
	return;
}

/**
 * debug()
 * Outputs a debug message
 * 
 * @param	string	$msg
 * @return	void
 */
function debug($msg)
{
	echo '<p><b>' . $msg . "</b></p>\n";
	return;
}

// shows a link to help file
function help($id)
{
	echo helpHtml($id);
	return;
}
function helpHtml($id)
{
	global $CONF;
	return helplink($id) . '<img src="' . $CONF['AdminURL'] . 'documentation/icon-help.gif" width="15" height="15" alt="' . _HELP_TT . '" title="' . _HELP_TT . '" /></a>';
}
function helplink($id)
{
	global $CONF;
	return '<a href="' . $CONF['AdminURL'] . 'documentation/help.html#'. $id . '" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);">';
}

/**
 * includephp()
 * Includes a PHP file. This method can be called while parsing templates and skins
 * 
 * @param	string	$filename	name of file to parse
 * @return	void
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
	
	if ( @file_exists($filename) )
	{
		include($filename);
	}
	return;
}

/**
 * Checks if a certain plugin exists
 * @param	string	$plug	name of plugin
 * @return	boolean	exists or not
 */
function checkPlugin($name)
{
	global $DIR_PLUGINS;
	return is_file($DIR_PLUGINS . preg_replace('#[\\\\|/]#', '', $name) . '.php');
}

/**
 * alterQueryStr()
 * 
 * @param	string	$querystr	querystring to alter (e.g. foo=1&bar=2&x=y)
 * @param	string	$param	name of parameter to change (e.g. 'foo')
 * @param	string	$value	New value for that parameter (e.g. 3)
 * @return	string	altered query string (for the examples above: foo=3&bar=2&x=y)
 */
function alterQueryStr($querystr, $param, $value)
{
	$vars = preg_split('#&#', $querystr);
	$set = FALSE;
	
	for ( $i = 0; $i < count($vars); $i++ )
	{
		$v = explode('=', $vars[$i]);
		
		if ( $v[0] == $param )
		{
			$v[1] = $value;
			$vars[$i] = implode('=', $v);
			$set = true;
			break;
		}
	}
	if ( !$set )
	{
		$vars[] = "{$param}={$value}";
	}
	return ltrim(implode('&', $vars), '&');
}

/**
 * passVar()
 * passes one variable as hidden input field (multiple fields for arrays)
 * @see passRequestVars in varsx.x.x.php
 * 
 * @param	string	$key
 * @param	string	$value
 * @return	void
 */
function passVar($key, $value)
{
	// array ?
	if ( is_array($value) )
	{
		for ( $i = 0; $i < sizeof($value); $i++ )
		{
			passVar("{$key}[{$i}]", $value[$i]);
		}
		return;
	}
	
	// other values: do stripslashes if needed
	echo sprintf('<input type="hidden" name="%s" value="%s" />', Entity::hsc($key), Entity::hsc(undoMagic($value))) . "\n";
	return;
}

/**
 * checkVars()
 * 
 * @param	string	$variables
 * @return	void
 */
function checkVars()
{
	$variables = array('nucleus', 'CONF', 'DIR_LIBS',
		'MYSQL_HOST', 'MYSQL_USER', 'MYSQL_PASSWORD', 'MYSQL_DATABASE',
		'DIR_LOCALES', 'DIR_PLUGINS',
		'GLOBALS', 'argv', 'argc', '_GET', '_POST', '_COOKIE', '_ENV', '_SESSION', '_SERVER', '_FILES');
	
	foreach ( $variables as $variable )
	{
		if ( array_key_exists($variable, $_GET)
		  || array_key_exists($variable, $_POST)
		  || array_key_exists($variable, $_COOKIE)
		  || array_key_exists($variable, $_ENV)
		  || (session_id() !== '' && array_key_exists($variable, $_SESSION))
		  || array_key_exists($variable, $_FILES) )
		{
			die('Sorry. An error occurred.');
		}
	}
	return;
}

/**
 * sanitizeParams()
 * Sanitize parameters such as $_GET and $_SERVER['REQUEST_URI'] etc.
 * to avoid XSS.
 * 
 * @param	void
 * @return	void
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
	
	return;
}

function _addInputTags(&$keys,$prefix='')
{
	foreach ( $keys as $key=>$value )
	{
		if ( $prefix ) $key=$prefix.'['.$key.']';
		
		if ( is_array($value) ) _addInputTags($value,$key);
		else
		{
			if ( get_magic_quotes_gpc() ) $value=stripslashes($value);
			
			if ( $key === 'ticket' )       continue;
			
			echo '<input type="hidden" name="'.Entity::hsc($key).
			     '" value="'.Entity::hsc($value).'" />'."\n";
		}
	}
	return;
}

/**
 * serverStringToArray()
 * Convert the server string such as $_SERVER['REQUEST_URI']
 * to arry like arry['blogid']=1 and array['page']=2 etc.
 * 
 * @param	string	 $uri				string
 * @param	string	&$query_elements	elements of query according to application/x-www-form-urlencoded
 * @param	string	&$hier_part			hierarchical part includes path
 * 
 * NOTE:
 * RFC 3986: Uniform Resource Identifiers (URI): Generic Syntax
 * 3.  Syntax Components
 * http://www.ietf.org/rfc/rfc3986.txt
 * 
 * Hypertext Markup Language - 2.0
 * 8.2.1. The form-urlencoded Media Type
 * http://tools.ietf.org/html/rfc1866#section-8.2.1
 * 
 * $_SERVER > Language Reference > Predefined Variables > PHP Manual
 * http://www.php.net/manual/en/reserved.variables.server.php
 */
function serverStringToArray($uri, &$query_elements, &$hier_part)
{
	// init param
	$query_elements = array();
	$hier_part = "";
	
	// split hierarchical part, e.g. /index.php, query and fragment, e.g. blogid=1&page=2#section1
	if ( i18n::strpos($uri, "?") > 0 )
	{
		list($hier_part, $query_and_fragment) = preg_split("#\?#", $uri, 2);
	}
	else
	{
		$query_and_fragment = $uri;
		$hier_part = '';
	}
	
	// If there is no query like blogid=1&page=2, return
	if ( i18n::strpos($uri, "=") == FALSE && !i18n::strlen($hier_part) )
	{
		$hier_part = $uri;
		return;
	}
	
	$query_elements = preg_split("#&#", $query_and_fragment);
	return;
}

/**
 * arrayToServerString()
 * Convert array like array['blogid'] to server string
 * such as $_SERVER['REQUEST_URI']
 * 
 * @param	array	 $query_elements	elements of query according to application/x-www-form-urlencoded
 * @param	string	 $hier_part			hier-part defined in RFC3986
 * @param	string	&$uri				return value
 * @return	void
 * 
 * NOTE:
 * RFC 3986: Uniform Resource Identifiers (URI): Generic Syntax
 * 3.  Syntax Components
 * http://www.ietf.org/rfc/rfc3986.txt
 * 
 * Hypertext Markup Language - 2.0
 * 8.2.1. The form-urlencoded Media Type
 * http://tools.ietf.org/html/rfc1866#section-8.2.1
 * 
 * $_SERVER > Language Reference > Predefined Variables > PHP Manual
 * http://www.php.net/manual/en/reserved.variables.server.php
 */
function arrayToServerString($query_elements, $hier_part, &$uri)
{
	if ( i18n::strpos($uri, "?") !== FALSE )
	{
		$uri = $hier_part . "?";
	}
	else
	{
		$uri = $hier_part;
	}
	if ( count($query_elements) > 0 )
	{
		$uri .= implode("&", $query_elements);
	}
	return;
}

/**
 * sanitizeArray()
 * Sanitize array parameters.
 * This function checks both key and value.
 * - check key if it inclues " (double quote),  remove from array
 * - check value if it includes \ (escape sequece), remove remaining string
 * 
 * @param	array	&$array	elements of query according to application/x-www-form-urlencoded
 * @return	void
 */
function sanitizeArray(&$array)
{
	$excludeListForSanitization = array('query');
	
	foreach ( $array as $k => $v )
	{
		// split to key and value
		list($key, $val) = preg_split("#=#", $v, 2);
		if ( !isset($val) )
		{
			continue;
		}
		
		// when magic quotes is on, need to use stripslashes,
		// and then addslashes
		if ( get_magic_quotes_gpc() )
		{
			$val = stripslashes($val);
		}
		
		// note that we must use addslashes here because this function is called before the db connection is made
		// and sql_real_escape_string needs a db connection
		$val = addslashes($val);
		
		// if $key is included in exclude list, skip this param
		if ( !in_array($key, $excludeListForSanitization) )
		{
			// check value
			if ( i18n::strpos($val, '\\') > 0 )
			{
				list($val, $tmp) = preg_split('#\\\\#', $val);
			}
			
			// remove control code etc.
			$val = strtr($val, "\0\r\n<>'\"", "       ");
			
			// check key
			if ( preg_match('#\"#', $key) > 0 )
			{
				unset($array[$k]);
				continue;
			}
			
			// set sanitized info
			$array[$k] = sprintf("%s=%s", $key, $val);
		}
	}
	return;
}

/**
 * convArrayForSanitizing()
 * Convert array for sanitizeArray function
 * 
 * @param	string	$src	array to be sanitized
 * @param	array	&$array	array to be temporarily stored
 * @return	void
 */
function convArrayForSanitizing($src, &$array)
{
	$array = array();
	foreach ( $src as $key => $val )
	{
		if ( !key_exists($key, $_GET) )
		{
			continue;
		}
		$array[] = sprintf("%s=%s", $key, $val);
		continue;
	}
	return;
}

/**
 * revertArrayForSanitizing()
 * Revert array after sanitizeArray function
 * 
 * @param	array	$array	element of query according to application/x-www-form-urlencoded
 * @param	array	&$dst	combination of key and value
 * @return	void
 */
function revertArrayForSanitizing($array, &$dst)
{
	foreach ( $array as $v )
	{
		list($key, $val) = preg_split("#=#", $v, 2);
		$dst[$key] = $val;
		continue;
	}
	return;
}

/**
 * decodePathInfo()
 * 
 * @param	string	$virtualpath
 * @return	void
 */
function decodePathInfo($virtualpath)
{
	global $CONF, $manager, $archive, $blog, $catid, $memberid, $special;
	
	/* initialize keywords if this hasn't been done before */
	if ( !isset($CONF['ItemKey']) || empty($CONF['ItemKey']) )
	{
		$CONF['ItemKey'] = 'item';
	}
	
	if ( !isset($CONF['ArchiveKey']) || empty($CONF['ArchiveKey']) )
	{
		$CONF['ArchiveKey'] = 'archive';
	}
	
	if ( !isset($CONF['ArchivesKey']) || empty($CONF['ArchivesKey']) )
	{
		$CONF['ArchivesKey'] = 'archives';
	}
	
	if ( !isset($CONF['MemberKey']) || empty($CONF['MemberKey']) )
	{
		$CONF['MemberKey'] = 'member';
	}
	
	if ( !isset($CONF['BlogKey']) || empty($CONF['BlogKey']) )
	{
		$CONF['BlogKey'] = 'blog';
	}
	
	if ( !isset($CONF['CategoryKey']) || empty($CONF['CategoryKey']) )
	{
		$CONF['CategoryKey'] = 'category';
	}
	
	if ( !isset($CONF['SpecialskinKey']) || empty($CONF['SpecialskinKey']) )
	{
		$CONF['SpecialskinKey'] = 'special';
	}
	
	$parsed = FALSE;
	$data = array(
		'type'		=>  basename(serverVar('SCRIPT_NAME') ),
		'info'		=>  $virtualpath,
		'complete'	=> &$parsed
	);
	$manager->notify('ParseURL', $data);
	
	/* already parsed by the other subsystem */
	if ( $parsed )
	{
		return;
	}
	/* default implementation */
	$data = preg_split("#/#", $virtualpath);
	for ( $i = 0; $i < sizeof($data); $i++ )
	{
		switch ( $data[$i] )
		{
			/* item/1 (blogid) */
			case $CONF['ItemKey']:
				$i++;
				
				if ( $i < sizeof($data) )
				{
					$itemid = (integer) $data[$i];
				}
				break;
			
			/* archives/1 (blogid) */
			case $CONF['ArchivesKey']:
					$i++;
					if ( $i < sizeof($data) )
					{
						$archivelist = (integer) $data[$i];
					}
					break;
				
			/* two possibilities: archive/yyyy-mm or archive/1/yyyy-mm (with blogid) */
			case $CONF['ArchiveKey']:
				if ( (($i + 1) < sizeof($data) ) && (i18n::strpos($data[$i + 1], '-') === FALSE ) )
				{
					$blogid = (integer) $data[++$i];
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
				}
				break;
			
			default:
				/* do nothing */
				break;
		}
	}
	
	return;
}


/**
 * redirect()
 * Stops processing the request and redirects to the given URL.
 * - no actual contents should have been sent to the output yet
 * - the URL will be stripped of illegal or dangerous characters
 * 
 * @param	string	$uri
 * @return	void
 */
function redirect($url)
{
	$url = preg_replace('#[^a-z0-9-~+_.?\#=&;,/:@%*]#i', '', $url);
	header('Location: ' . $url);
	exit;
}

/**
 * getBookmarklet()
 * Returns the Javascript code for a bookmarklet that works on most modern browsers
 * 
 * @param	integer	$blogid	ID for weblog
 * @return	script to call Bookmarklet
 */
function getBookmarklet($blogid, $width=600,  $height=500)
{
	global $CONF;
	
	$script = "Q='';"
	        . "x=document;"
	        . "y=window;"
	        . "if ( x.selection )"
	        . "{"
	        . " Q=x.selection.createRange().text;"
	        . "}"
	        . "else if ( y.getSelection )"
	        . "{"
	        . " Q=y.getSelection();"
	        . "}"
	        . "else if ( x.getSelection )"
	        . "{"
	        . " Q=x.getSelection();"
	        . "}"
	        . "wingm = window.open('{$CONF['AdminURL']}bookmarklet.php?blogid={$blogid}"
	        . " &logtext=' + encodeURIComponent(Q) +"
	        . " '&loglink=' + encodeURIComponent(x.location.href) +"
	        . " '&loglinktitle=' + encodeURIComponent(x.title),"
	        . " 'nucleusbm',"
	        . " 'scrollbars=yes,width={$width},height={$height},left=10,top=10,status=yes,resizable=yes');"
	        . "wingm.focus();";
	
	return $script;
}

/**
 * cleanFileName()
 * cleans filename of uploaded file for writing to file system
 *
 * @param	string	$str
 * @return	string	$cleaned filename ready for use
 */
function cleanFileName($str)
{
	$str = strtolower($str);
	$ext_point = i18n::strrpos($str,".");
	if ( $ext_point === FALSE )
	{
		return FALSE;
	}
	$ext = i18n::substr($str,$ext_point,i18n::strlen($str));
	$str = i18n::substr($str,0,$ext_point);
	
	return preg_replace("#[^a-z0-9-]#", "_", $str) . $ext;
}

/**
 * use Notification class instead of this
 * Deprecated since 4.0:
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
 * use Entity class instead of this
 * Deprecated since 4.0:
 */
function highlight($text, $expression, $highlight)
{
	return Entity::highlight($text, $expression, $highlight);
}
function shorten($string, $maxlength, $suffix)
{
	return Entity::shorten($string, $maxlength, $suffix);
}
function stringStripTags ($string)
{
	return Entity::strip_tags($string);
}
function toAscii($string)
{
	return Entity::anchor_footnoting($string);
}
function stringToAttribute ($string)
{
	return Entity::hsc($string);
}
function stringToXML ($string)
{
	return Entity::hen($string);
}
function encode_desc($data)
{
	return Entity::hen($data);
}
/**
 * Centralisation of the functions that deals with locales
 * This functions is based on the old way to deal with languages
 * Deprecated since 4.0:
 */
function getLanguageName()
{
	if( ($language = i18n::convert_locale_to_old_language_file_name(i18n::get_current_locale())) === FALSE )
	{
		$language ='english';
	}
	return $language;
}
function selectLanguage($language)
{
	global $DIR_LANG;
	include($DIR_LANG . preg_replace('#[\\\\|/]#', '', $language) . '.php');
	return;
}
/**
 * use i18n class instead of these
 * Deprecated since 4.0
 */
function checkLanguage($lang)
{
	return ( preg_match('#^(.+)_(.+)_(.+)$#', $lang)
	  || i18n::convert_old_language_file_name_to_locale($lang) );
}
function formatDate($format, $timestamp, $default_format, &$blog)
{
	$offset = date('Z', $timestamp);
	if ( $blog )
	{
		$offset += $blog->getTimeOffset() * 3600;
	}
	return i18n::formatted_datetime($format, $timestamp, $offset, $default_format);
}

/**
 * use DB class instead of these
 * Deprecated since 4.0
 */
function quickQuery($query)
{
	$row = DB::getRow($query);
	return $row['result'];
}
function mysqldate($timestamp)
{
	return DB::formatDateTime($timestamp);
 }
/**
 * Centralisation of the functions that generate links
 * Deprecated since 4.0:
 * Please use Link::FunctionName(...) instead
 */
function createItemLink($itemid, $extra = '')
{
	return Link::create_item_link($itemid, $extra);
}
function createMemberLink($memberid, $extra = '')
{
	return Link::create_member_link($memberid, $extra);
}
function createCategoryLink($catid, $extra = '')
{
	return Link::create_category_link($catid, $extra);
}
function createArchiveListLink($blogid = '', $extra = '')
{
	return Link::create_archivelist_link($blogid, $extra);
}
function createArchiveLink($blogid, $archive, $extra = '')
{
	return Link::create_archive_link($blogid, $archive, $extra);
}
function createBlogidLink($blogid, $params = '')
{
	return Link::create_blogid_link($blogid, $params = '');
}
function createLink($type, $params)
{
	return Link::create_link($type, $params);
}
function createBlogLink($url, $params)
{
	return Link::create_blog_link($url, $params);
}
/**
 * use ActionLog class instead of this
 * Deprecated since 4.0
 */
function addToLog($level, $msg)
{
	ActionLog::add($level, $msg);
}
/**
 * use PHP's implement
 * Deprecated since 4.0
 */
function ifset(&$var)
{
	if ( isset($var) )
	{
		return $var;
	}
	
	return NULL;
}
/**
 * use Manager::getPluginNameFromPid() instead of this
 * Deprecated since 4.0
 */
function getPluginNameFromPid($pid)
{
	global $manager;
	return $manager->getPluginNameFromPid($pid);
}
/**
 * use Manager::numberOfEventSubscribers() instead of this
 * Deprecated since 4.0
 */
function numberOfEventSubscribers($event)
{
	global $manager;
	return $manager->getNumberOfSubscribers($event);
}

/**
 * PluginAdmin has already the alternative implement
 * Deprecated since 4.0
 */
function ticketForPlugin()
{
	global $CONF, $DIR_LIBS, $DIR_LOCALES, $DIR_PLUGINS, $manager, $member, $ticketforplugin;
	
	/* initialize */
	$ticketforplugin = array();
	$ticketforplugin['ticket'] = FALSE;
	
	/* Check if using plugin's php file. */
	$p_translated = serverVar('SCRIPT_FILENAME');
	
	if (!file_exists($p_translated) )
	{
		header("HTTP/1.0 404 Not Found");
		exit('');
	}
	
	// check whether this is plugin or not
	$p_translated = str_replace('\\', '/', $p_translated);
	$d_plugins = str_replace('\\', '/', $DIR_PLUGINS);
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
	$query = sprintf('SELECT pfile FROM %s;', sql_table('plugin'));
	$res = DB::getResult($query);
	
	foreach ( $res as $row )
	{
		$name = i18n::substr($row['pfile'], 3);
		$plugins[strtolower($name)] = $name;
	}
	
	$res->closeCursor();
	
	if ( !array_key_exists($path, $plugins) )
	{
		header("HTTP/1.0 404 Not Found");
		exit('');
	}
	else
	{
		$plugin_name = $plugins[$path];
	}
	
	/* Return if not index.php */
	if ( ($phppath != strtolower($plugin_name) . '/')
	  && ($phppath != strtolower($plugin_name) . '/index.php') )
	{
		return;
	}
	
	/* Exit if not logged in. */
	if ( !$member->isLoggedIn() )
	{
		exit('You aren\'t logged in.');
	}
	
	/* Check if this feature is needed (ie, if "$manager->checkTicket()" is not included in the script). */
	if ( $file = @file($p_translated) )
	{
		$prevline = '';
		
		foreach($file as $line)
		{
			if (preg_match('#[\$]manager([\s]*)[\-]>([\s]*)checkTicket([\s]*)[\(]#i', $prevline . $line) )
			{
				return;
			}
			
			$prevline = $line;
		}
	}
	
	/* Show a form if not valid ticket */
	if ( (i18n::strpos(serverVar('REQUEST_URI'), '?') !== FALSE
	  || serverVar('QUERY_STRING')
	  || strtoupper(serverVar('REQUEST_METHOD') ) == 'POST')
	  && !$manager->checkTicket() )
	{
		$oPluginAdmin = new PluginAdmin($plugin_name);
		$oPluginAdmin->start();
		
		echo '<p>' . _ERROR_BADTICKET . "</p>\n";
		
		// Resolve URI and QUERY_STRING
		if ($uri = serverVar('REQUEST_URI') )
		{
			list($uri, $qstring) = preg_split('#\?#', $uri);
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
		
		echo '<p>' . _SETTINGS_UPDATE . ' : ' . _QMENU_PLUGINS . ' <span style="color:red;">' . Entity::hsc($plugin_name) . "</span> ?</p>\n";
		
		switch(strtoupper(serverVar('REQUEST_METHOD') ) )
		{
			case 'POST':
				echo '<form method="POST" action="'.Entity::hsc($uri.$qstring).'">';
				$manager->addTicketHidden();
				_addInputTags($_POST);
				break;
			
			case 'GET':
				echo '<form method="GET" action="'.Entity::hsc($uri).'">';
				$manager->addTicketHidden();
				_addInputTags($_GET);
			
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
	$ticketforplugin['ticket'] = preg_split($ticket, i18n::strpos($ticket, 'ticket=') + 7);
	return;
}


function parseTags($tpl, $ph)
{
	if(empty($tpl)||empty($ph)) return $tpl;
	
	foreach($ph as $k=>$v)
	{
		$k = "<%{$k}%>";
		if(strpos($tpl,$k)!==false)
			$tpl = str_replace($k,$v,$tpl);
	}
	return $tpl;
}