<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
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
 * ?><div style="font-size: xx-large;"> Your web server is not properly configured to run PHP scripts and will not be able to install Nucleus. </div> <div style="display: none;"><?php
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id$
 */

$minimum_php_version = '5.0.6';
$minimum_mysql_version = '3.23';

// begin if: server's PHP version is below the minimum; halt installation
if ( phpversion() < $minimum_php_version )
{
	_doError(_ERROR31);
} // end if

/**
 * This part of the ./install/index.php code allows for customization of the install process.
 * When distributing plugins or skins together with a Nucleus installation, the
 * configuration below will instruct to install them
 *
 * -- Start Of Configurable Part --
 **/

/**
 * array with names of plugins to install. Plugin files must be present in the nucleus/plugin/ directory
 *
 * example:
 *		array('NP_TrackBack', 'NP_MemberGoodies')
 **/
$aConfPlugsToInstall = array('NP_SkinFiles', 'NP_SecurityEnforcer', 'NP_Text');

/**
 * array with skins to install. skins must be present under the skins/ directory with
 * a subdirectory having the same name that contains a skinbackup.xml file
 *
 * example:
 *		array('base', 'rsd')
 **/
$aConfSkinsToImport = array('atom', 'rss2.0', 'rsd', 'default');

/**
 * -- End Of Configurable Part --
 **/

// don't give warnings for uninitialized vars
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// make sure there's no unnecessary escaping: # set_magic_quotes_runtime(0);
if ( version_compare(PHP_VERSION, '5.3.0', '<') )
{
    ini_set('magic_quotes_runtime', '0');
} // end if

// if there are some plugins or skins to import, do not include vars in globalfunctions.php again... so set a flag
if ( (count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0) )
{
	global $CONF;
	$CONF['installscript'] = 1;
} // end if

if ( !class_exists('i18n', FALSE) )
{
	include('../nucleus/libs/i18n.php');

	if ( !i18n::init('UTF-8', './locales') )
	{
		exit('Failed to initialize iconv or mbstring extension. Would you please contact the administrator of your PHP server?');
	} // end if
} // end if

// we will use postVar, getVar, ... methods instead of $_GET, $_POST ...
include_once('../nucleus/libs/vars4.1.0.php');

// include core classes that are needed for login & plugin handling
include_once('../nucleus/libs/mysql.php');

## added for 3.5 sql_* wrapper
global $MYSQL_HANDLER;

//set the handler if different from mysql (or mysqli) # $MYSQL_HANDLER = array('pdo','mysql');
if ( !isset($MYSQL_HANDLER) )
{
	$MYSQL_HANDLER = array('mysql', '');
} // end if

include_once('../nucleus/libs/sql/' . $MYSQL_HANDLER[0] . '.php');
## end new for 3.5 sql_* wrapper

/* TODO: if something input related to locale, sdet it, else set default */
include('./locales/en_Latn_US.UTF-8.php');
i18n::set_current_locale('en_Latn_US');

/* send HTTP header */
header('Content-Type: application/xhtml+xml; charset=' . i18n::get_current_charset());

// check if mysql support is installed; this check may not make sense, as is, in a version past 3.5x
if ( !function_exists('mysql_query') )
{
	_doError(_ERROR1);
} // end if

if ( postVar('action') == 'go' )
{
	doInstall();
}
else
{
	showInstallForm();
}

exit;


/**
 * Display the form for installation settings
 */
function showInstallForm()
{
	// 0. pre check if all necessary files exist
	doCheckFiles();

	echo "<?xml version=\"1.0\" encoding=\"" . i18n::get_current_charset() . "\" ?>\n";
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\" lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\">\n";
?>
	<head>
		<title><?php echo _TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="../nucleus/documentation/styles/manual.css" />
		<script type="text/javascript">
		<!--
			var submitcount = 0;

			// function to make sure the submit button only gets pressed once
			function checkSubmit()
			{

				if ( submitcount == 0 )
				{
					submitcount++;
					return true;
				}
				else
				{
					return false;
				}

			}
		-->
		</script>
	</head>
	<body>
		<div style="text-align: center;"><img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>" /></div>
		<form method="post" action="./index.php">

		<h1><?php echo _HEADER1; ?></h1>

		<?php echo _TEXT1; ?>

		<h1><?php echo _HEADER2; ?></h1>

		<?php echo _TEXT2; ?>

		<ul>
			<li> PHP: <?php echo phpversion(); ?> </li>
			<li> MySQL:

<?php
	// Turn on output buffer
	// Needed to repress the output of the sql function that are
	// not part of php (in this case the @ operator doesn't work)
	ob_start();

	// note: this piece of code is taken from phpMyAdmin
	$conn = sql_connect_args('localhost', '', '');
	$result = @sql_query('SELECT VERSION() AS version', $conn);

	if ( $result != FALSE && sql_num_rows($result) > 0 )
	{
		$row = sql_fetch_array($result);
		$match = i18n::explode('.', $row['version']);
	}
	else
	{
		$result = @sql_query('SHOW VARIABLES LIKE \'version\'', $conn);

		if ( $result != FALSE && @sql_num_rows($result) > 0 )
		{
			$row = sql_fetch_row($result);
			$match = i18n::explode('.', $row[1]);
		}
		else
		{
			//$output = shell_exec('mysql -V');
			$output = ( function_exists('shell_exec') ) ? @shell_exec('mysql -V') : '0.0.0';
			preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
			$match = i18n::explode('.', $version[0]);

			if ( $match[0] == '' )
			{
				$match[0] = '0';
				$match[1] = '0';
				$match[2] = '0';
			} // end if

		} // end if

	} // end if

	@sql_disconnect($conn);

	//End and clean output buffer
	ob_end_clean();

	$mysqlVersion = implode($match, '.');
	$minVersion = '3.23';

	if ( $mysqlVersion == '0.0.0' )
	{
		echo _NOTIFICATION1;
	}
	else
	{
		echo $mysqlVersion;
	}

	if ( $mysqlVersion < $minVersion )
	{
		echo ' <strong>', _TEXT2_WARN2 , $minVersion, '</strong>';
	}
?>

			</li>
		</ul>

<?php
	// tell people how they can have their config file filled out automatically
	if ( @file_exists('../config.php') && @!is_writable('../config.php') )
	{
?>

		<h1><?php echo _HEADER3; ?></h1>

<?php
	echo _TEXT3;

	} // end if
?>

		<h1><?php echo _HEADER4; ?></h1>

		<?php echo _TEXT4; ?>

		<fieldset>
			<legend><?php echo _TEXT4_TAB_HEAD; ?></legend>
			<table>
				<tr>
					<td><label for="if_mySQL_host"><?php echo _TEXT4_TAB_FIELD1; ?>:</label></td>
					<td><input id="if_mySQL_host" name="mySQL_host" value="<?php echo @ini_get('mysql.default_host'); ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_mySQL_user"><?php echo _TEXT4_TAB_FIELD2; ?>:</label></td>
					<td><input id="if_mySQL_user" name="mySQL_user" /></td>
				</tr>
				<tr>
					<td><label for="if_mySQL_password"><?php echo _TEXT4_TAB_FIELD3; ?>:</label></td>
					<td><input id="if_mySQL_password" name="mySQL_password" type="password" /></td>
				</tr>
				<tr>
					<td><label for="if_mySQL_database"><?php echo _TEXT4_TAB_FIELD4; ?>:</label></td>
					<td><input id="if_mySQL_database" name="mySQL_database" /> (<input name="mySQL_create" value="1" type="checkbox" id="mySQL_create" /><label for="mySQL_create"><?php echo _TEXT4_TAB_FIELD4_ADD; ?></label>)</td>
				</tr>
			</table>
		</fieldset>

		<fieldset>
			<legend><?php echo _TEXT4_TAB2_HEAD; ?></legend>
			<table>
				<tr>
					<td><input name="mySQL_usePrefix" value="1" type="checkbox" id="mySQL_usePrefix" /><label for="mySQL_usePrefix"><?php echo _TEXT4_TAB2_FIELD; ?>:</label></td>
					<td><input name="mySQL_tablePrefix" value="" /></td>
				</tr>
			</table>

			<?php echo _TEXT4_TAB2_ADD; ?>

		</fieldset>

		<h1><?php echo _HEADER5; ?></h1>

		<?php echo _TEXT5; ?>

<?php
	// no need to this all! dirname(__FILE__) is all we need -- moraes
	/*
	// discover full path
	$fullPath = serverVar('PATH_TRANSLATED');

	if ($fullPath == '') {
		$fullPath = serverVar('SCRIPT_FILENAME');
	}

	$base_path = str_replace('./index.php', '', $fullPath);
	$base_path = replace_double_backslash($base_path);
	$base_path = replace_double_backslash($base_path);

	// add slash at end if necessary
	if (!ends_with_slash($base_path) ) {
		$base_path .= '/';
	}
	*/

	/**
	 * In the code below, there used to be if conditions within the form's HTML that conditionally echoed the URLs.
	 *
	 * For example:
	 *		if ($base_path) . . .
	 * Or:
	 *		if ($url) . . .
	 *
	 * I removed this and simplified below, because PHP's type casting will make these always evaluate to TRUE.
	 * At least currently, $base_path will always be non-empty, since the trailing slash is appended to it.
	 * Similarly, $index_url will always be non-empty, since the 'http://' is prepended to it.
	 * Non-empty, non-zero strings evaluated in if conditions are always cast to boolean TRUE.
	 * The if conditions were accomplishing nothing (currently) and we should avoid using such comparisons, anyway.
	 * If we need to check for a blank/empty string, use empty().
	 *
	 * I was initially replacing those if conditions with ternary operators for empty(), but then I realized
	 * they will never be empty.
	 *
	 * In addition, I decided to remove the PHP logic from within the form and set up separate variables (they were
	 * all just $url before), so the form just echos the values as needed.
	 * - gregorlove 7/13/2011 5:56 PM
	 */
	
	/* base path */
	$base_path = realpath(dirname(__FILE__) . '/..');
	$pwd = preg_replace("#{$base_path}/#", '', dirname(__FILE__));
	
	# Index URL
	$index_url = 'http://' . serverVar('HTTP_HOST') . serverVar('PHP_SELF');
	$index_url = preg_replace("#{$pwd}/index.php#", '', $index_url);
	$index_url = replace_double_backslash($index_url);

	// add slash at end if necessary
	if ( !ends_with_slash($base_path) )
	{
		$base_path .= '/';
	}
	if ( !ends_with_slash($index_url) )
	{
		$index_url .= '/';
	}

	# Admin URL and path
	$admin_url = $index_url . 'nucleus/';
	$admin_path = $base_path . 'nucleus/';

	# Media URL and path
	$media_url = $index_url . 'media/';
	$media_path = $base_path . 'media/';

	# Skins URL and path
	$skins_url = $index_url . 'skins/';
	$skins_path = $base_path . 'skins/';

	# Plugins URL
	$plugins_url = $admin_url . 'plugins/';

	# Action URL
	$action_url = $index_url . 'action.php';

?>

		<fieldset>
			<legend><?php echo _TEXT5_TAB_HEAD; ?></legend>
			<table>
				<tr>
					<td><label for="if_IndexURL"><?php echo _TEXT5_TAB_FIELD1;?>:</label></td>
					<td><input id="if_IndexURL" name="IndexURL" size="60" value="<?php echo $index_url; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_AdminURL"><?php echo _TEXT5_TAB_FIELD2;?>:</label></td>
					<td><input id="if_AdminURL" name="AdminURL" size="60" value="<?php echo $admin_url; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_AdminPath"><?php echo _TEXT5_TAB_FIELD3;?>:</label></td>
					<td><input id="if_AdminPath" name="AdminPath" size="60" value="<?php echo $admin_path; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_MediaURL"><?php echo _TEXT5_TAB_FIELD4;?>:</label></td>
					<td><input id="if_MediaURL" name="MediaURL" size="60" value="<?php echo $media_url; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_MediaPath"><?php echo _TEXT5_TAB_FIELD5;?>:</label></td>
					<td><input id="if_MediaPath" name="MediaPath" size="60" value="<?php echo $media_path; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_SkinsURL"><?php echo _TEXT5_TAB_FIELD6;?>:</label></td>
					<td><input id="if_SkinsURL" name="SkinsURL" size="60" value="<?php echo $skins_url; ?>" />
						<br />(used by imported skins)
					</td>
				</tr>
				<tr>
					<td><label for="if_SkinsPath"><?php echo _TEXT5_TAB_FIELD7;?>:</label></td>
					<td><input id="if_SkinsPath" name="SkinsPath" size="60" value="<?php echo $skins_path; ?>" />
						<br />(<?php echo _TEXT5_TAB_FIELD7_2;?>)
					</td>
				</tr>
				<tr>
					<td><label for="if_PluginURL"><?php echo _TEXT5_TAB_FIELD8;?>:</label></td>
					<td><input id="if_PluginURL" name="PluginURL" size="60" value="<?php echo $plugins_url; ?>" /></td>
				</tr>
				<tr>
					<td><label for="if_ActionURL"><?php echo _TEXT5_TAB_FIELD9;?>:</label></td>
					<td><input id="if_ActionURL" name="ActionURL" size="60" value="<?php echo $action_url; ?>" />
						<br />(<?php echo _TEXT5_TAB_FIELD9_2;?>)
					</td>
				</tr>
			</table>
		</fieldset>

		<?php echo _TEXT5_2; ?>

		<h1><?php echo _HEADER6; ?></h1>

		<?php echo _TEXT6; ?>

		<fieldset>
			<legend><?php echo _TEXT6_TAB_HEAD; ?></legend>
			<table>
				<tr>
					<td><label for="if_User_name"><?php echo _TEXT6_TAB_FIELD1; ?>:</label></td>
					<td><input id="if_User_name" name="User_name" value="" /> <small>(<?php echo _TEXT6_TAB_FIELD1_2; ?>)</small></td>
				</tr>
				<tr>
					<td><label for="if_User_realname"><?php echo _TEXT6_TAB_FIELD2; ?>:</label></td>
					<td><input id="if_User_realname" name="User_realname" value="" /></td>
				</tr>
				<tr>
					<td><label for="if_User_password"><?php echo _TEXT6_TAB_FIELD3; ?>:</label></td>
					<td><input id="if_User_password" name="User_password" type="password" value="" /></td>
				</tr>
				<tr>
					<td><label for="if_User_password2"><?php echo _TEXT6_TAB_FIELD4; ?>:</label></td>
					<td><input id="if_User_password2" name="User_password2" type="password" value="" /></td>
				</tr>
				<tr>
					<td><label for="if_User_email"><?php echo _TEXT6_TAB_FIELD5; ?>:</label></td>
					<td><input id="if_User_email" name="User_email" value="" /> <small>(<?php echo _TEXT6_TAB_FIELD5_2; ?>)</small></td>
				</tr>
			</table>
		</fieldset>

		<h1><?php echo _HEADER7; ?></h1>

		<?php echo _TEXT7; ?>

		<fieldset>
			<legend><?php echo _TEXT7_TAB_HEAD; ?></legend>
			<table>
				<tr>
					<td><label for="if_Blog_name"><?php echo _TEXT7_TAB_FIELD1; ?>:</label></td>
					<td><input id="if_Blog_name" name="Blog_name" size="60" value="My Nucleus CMS" /></td>
				</tr>
				<tr>
					<td><label for="if_Blog_shortname"><?php echo _TEXT7_TAB_FIELD2; ?>:</label></td>
					<td><input id="if_Blog_shortname" name="Blog_shortname" value="mynucleuscms" /> <small>(<?php echo _TEXT7_TAB_FIELD2_2; ?>)</small></td>
				</tr>
			</table>
		</fieldset>

		<h1><?php echo _HEADER8; ?></h1>

		<fieldset>
			<legend><?php echo _TEXT8_TAB_HEADER; ?></legend>
			<table>
				<tr>
					<td><input name="Weblog_ping" value="1" type="checkbox" /><label for="Weblog_ping"><?php echo _TEXT8_TAB_FIELD1; ?></label></td>
				</tr>
			</table>
		</fieldset>

		<h1><?php echo _HEADER9; ?></h1>

		<?php echo _TEXT9; ?>

		<p><input name="action" value="go" type="hidden" /> <input type="submit" value="<?php echo _BUTTON1; ?>" onclick="return checkSubmit();" /></p>

		</form>
	</body>
</html>

<?php
} // end function showInstallForm()


/**
 * Add a table prefix if it is used
 *
 * @param string $input table name with prefix
 * @return string
 */
function tableName($input)
{
	global $mysql_usePrefix, $mysql_prefix;

	if ( $mysql_usePrefix == 1 )
	{
		return $mysql_prefix . $input;
	}
	else
	{
		return $input;
	} // end if

}


/**
 * The installation process itself
 */
function doInstall()
{
	global $mysql_usePrefix, $mysql_prefix, $weblog_ping;

	// 0. put all POST-vars into vars
	$mysql_host = postVar('mySQL_host');
	$mysql_user = postVar('mySQL_user');
	$mysql_password = postVar('mySQL_password');
	$mysql_database = postVar('mySQL_database');
	$mysql_create = postVar('mySQL_create');
	$mysql_usePrefix = postVar('mySQL_usePrefix');
	$mysql_prefix = postVar('mySQL_tablePrefix');
	$config_indexurl = postVar('IndexURL');
	$config_adminurl = postVar('AdminURL');
	$config_adminpath = postVar('AdminPath');
	$config_mediaurl = postVar('MediaURL');
	$config_skinsurl = postVar('SkinsURL');
	$config_pluginurl = postVar('PluginURL');
	$config_actionurl = postVar('ActionURL');
	$config_mediapath = postVar('MediaPath');
	$config_skinspath = postVar('SkinsPath');
	$user_name = postVar('User_name');
	$user_realname = postVar('User_realname');
	$user_password = postVar('User_password');
	$user_password2 = postVar('User_password2');
	$user_email = postVar('User_email');
	$blog_name = postVar('Blog_name');
	$blog_shortname = postVar('Blog_shortname');
	$config_adminemail = $user_email;
	$config_sitename = $blog_name;
	$weblog_ping = postVar('Weblog_ping');

	$config_indexurl = replace_double_backslash($config_indexurl);
	$config_adminurl = replace_double_backslash($config_adminurl);
	$config_mediaurl = replace_double_backslash($config_mediaurl);
	$config_skinsurl = replace_double_backslash($config_skinsurl);
	$config_pluginurl = replace_double_backslash($config_pluginurl);
	$config_actionurl = replace_double_backslash($config_actionurl);
	$config_adminpath = replace_double_backslash($config_adminpath);
	$config_skinspath = replace_double_backslash($config_skinspath);

	// 1. check all the data
	$errors = array();

	if ( !$mysql_database )
	{
		array_push($errors, _ERROR2);
	}

	if ( ($mysql_usePrefix == 1) && (i18n::strlen($mysql_prefix) == 0) )
	{
		array_push($errors, _ERROR3);
	}

	if ( ($mysql_usePrefix == 1) && (!preg_match('/^[a-zA-Z0-9_]+$/i', $mysql_prefix) ) )
	{
		array_push($errors, _ERROR4);
	}

	// TODO: add action.php check
	if ( !ends_with_slash($config_indexurl) || !ends_with_slash($config_adminurl) || !ends_with_slash($config_mediaurl) || !ends_with_slash($config_pluginurl) || !ends_with_slash($config_skinsurl) )
	{
		array_push($errors, _ERROR5);
	}

	if ( !ends_with_slash($config_adminpath) )
	{
		array_push($errors, _ERROR6);
	}

	if ( !ends_with_slash($config_mediapath) )
	{
		array_push($errors, _ERROR7);
	}

	if ( !ends_with_slash($config_skinspath) )
	{
		array_push($errors, _ERROR8);
	}

	if ( !is_dir($config_adminpath) )
	{
		array_push($errors, _ERROR9);
	}

	if ( !_isValidMailAddress($user_email) )
	{
		array_push($errors, _ERROR10);
	}

	if ( !_isValidDisplayName($user_name) )
	{
		array_push($errors, _ERROR11);
	}

	if ( !$user_password || !$user_password2 )
	{
		array_push($errors, _ERROR12);
	}

	if ( $user_password != $user_password2 )
	{
		array_push($errors, _ERROR13);
	}

	if ( !_isValidShortName($blog_shortname) )
	{
		array_push($errors, _ERROR14);
	}

	if ( sizeof($errors) > 0 )
	{
		showErrorMessages($errors);
	}

	// 2. try to log in to mySQL

	global $MYSQL_CONN;

	// this will need to be changed if we ever allow
	$MYSQL_CONN = @sql_connect_args($mysql_host, $mysql_user, $mysql_password);

	if ( $MYSQL_CONN == FALSE )
	{
		_doError(_ERROR15 . ': ' . sql_error() );
	}

	// 3. try to create database (if needed)
	if ( $mysql_create == 1 )
	{
		sql_query('CREATE DATABASE ' . $mysql_database . ' DEFAULT CHARACTER SET = utf8', $MYSQL_CONN) or _doError(_ERROR16 . ': ' . sql_error($MYSQL_CONN));
	}

	// 4. try to select database
	sql_select_db($mysql_database, $MYSQL_CONN) or _doError(_ERROR17);

	// 5. execute queries
	$filename = 'install.sql';
	$fd = fopen($filename, 'r');
	$queries = fread($fd, filesize($filename) );
	fclose($fd);

	$queries = preg_split('#(;\n|;\r)#', $queries);

	$aTableNames = array(
		'nucleus_actionlog',
		'nucleus_ban',
		'nucleus_blog',
		'nucleus_category',
		'nucleus_comment',
		'nucleus_config',
		'nucleus_item',
		'nucleus_karma',
		'nucleus_member',
		'nucleus_plugin',
		'nucleus_skin',
		'nucleus_template',
		'nucleus_team',
		'nucleus_activation',
		'nucleus_tickets'
	);

	// these are unneeded (one of the replacements above takes care of them)
	//			'nucleus_plugin_event',
	//			'nucleus_plugin_option',
	//			'nucleus_plugin_option_desc',
	//			'nucleus_skin_desc',
	//			'nucleus_template_desc',

	$aTableNamesPrefixed = array(
		$mysql_prefix . 'nucleus_actionlog',
		$mysql_prefix . 'nucleus_ban',
		$mysql_prefix . 'nucleus_blog',
		$mysql_prefix . 'nucleus_category',
		$mysql_prefix . 'nucleus_comment',
		$mysql_prefix . 'nucleus_config',
		$mysql_prefix . 'nucleus_item',
		$mysql_prefix . 'nucleus_karma',
		$mysql_prefix . 'nucleus_member',
		$mysql_prefix . 'nucleus_plugin',
		$mysql_prefix . 'nucleus_skin',
		$mysql_prefix . 'nucleus_template',
		$mysql_prefix . 'nucleus_team',
		$mysql_prefix . 'nucleus_activation',
		$mysql_prefix . 'nucleus_tickets'
	);

	// these are unneeded (one of the replacements above takes care of them)
	//			$mysql_prefix . 'nucleus_plugin_event',
	//			$mysql_prefix . 'nucleus_plugin_option',
	//			$mysql_prefix . 'nucleus_plugin_option_desc',
	//			$mysql_prefix . 'nucleus_skin_desc',
	//			$mysql_prefix . 'nucleus_template_desc',

	$count = count($queries);

	for ( $idx = 0; $idx < $count; $idx++ )
	{
		$query = trim($queries[$idx]);
		// echo "QUERY = <small>" . ENTITY::hsc($query) . "</small><p>";

		if ( $query )
		{

			if ( $mysql_usePrefix == 1 )
			{
				$query = str_replace($aTableNames, $aTableNamesPrefixed, $query);
			} // end if

			sql_query($query, $MYSQL_CONN) or _doError(_ERROR30 . ' (<small>' . ENTITY::hsc($query) . '</small>): ' . sql_error($MYSQL_CONN) );
		} // end if

	} // end loop

	// 5a make first post
	$newpost = "INSERT INTO ". tableName('nucleus_item') ." VALUES (1, '" . _1ST_POST_TITLE . "', '" . _1ST_POST . "', '" . _1ST_POST2 . "', 1, 1, '2005-08-15 11:04:26', 0, 0, 0, 1, 0, 1);";
	sql_query($newpost,$MYSQL_CONN) or _doError(_ERROR18 . ' (<small>' . ENTITY::hsc($newpost) . '</small>): ' . sql_error($MYSQL_CONN) );

	// 6. update global settings
	updateConfig('IndexURL', $config_indexurl);
	updateConfig('AdminURL', $config_adminurl);
	updateConfig('MediaURL', $config_mediaurl);
	updateConfig('SkinsURL', $config_skinsurl);
	updateConfig('PluginURL', $config_pluginurl);
	updateConfig('ActionURL', $config_actionurl);
	updateConfig('AdminEmail', $config_adminemail);
	updateConfig('SiteName', $config_sitename);

	// 7. update GOD member
	$query = 'UPDATE ' . tableName('nucleus_member')
			. " SET mname='" . addslashes($user_name) . "',"
			. " mrealname='" . addslashes($user_realname) . "',"
			. " mpassword='" . md5(addslashes($user_password) ) . "',"
			. " murl='" . addslashes($config_indexurl) . "',"
			. " memail='" . addslashes($user_email) . "',"
			. " madmin=1, mcanlogin=1"
			. " WHERE mnumber=1";

	sql_query($query,$MYSQL_CONN) or _doError(_ERROR19 . ': ' . sql_error($MYSQL_CONN) );

	// 8. update weblog settings
	$query = 'UPDATE ' . tableName('nucleus_blog')
			. " SET bname='" . addslashes($blog_name) . "',"
			. " bshortname='" . addslashes($blog_shortname) . "',"
			. " burl='" . addslashes($config_indexurl) . "'"
			. " WHERE bnumber=1";

	sql_query($query, $MYSQL_CONN) or _doError(_ERROR20 . ': ' . sql_error($MYSQL_CONN) );

	// 9. update item date
	$query = 'UPDATE ' . tableName('nucleus_item')
			. " SET itime='" . date('Y-m-d H:i:s', time() ) ."'"
			. " WHERE inumber=1";

	sql_query($query,$MYSQL_CONN) or _doError(_ERROR21 . ': ' . sql_error($MYSQL_CONN) );

	global $aConfPlugsToInstall, $aConfSkinsToImport;
	$aSkinErrors = array();
	$aPlugErrors = array();

	if ( (count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0) )
	{
		// 10. set global variables
		global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_PREFIX;

		$MYSQL_HOST = $mysql_host;
		$MYSQL_USER = $mysql_user;
		$MYSQL_PASSWORD = $mysql_password;
		$MYSQL_DATABASE = $mysql_database;
		$MYSQL_PREFIX = ( $mysql_usePrefix == 1 ) ? $mysql_prefix : '';

		global $DIR_NUCLEUS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;

		$DIR_NUCLEUS = $config_adminpath;
		$DIR_MEDIA = $config_mediapath;
		$DIR_SKINS = $config_skinspath;
		$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
		$DIR_LANG = $DIR_NUCLEUS . 'language/';
		$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

		// close database connection (needs to be closed if we want to include globalfunctions.php)
		sql_close($MYSQL_CONN);

		$manager = '';
		include_once($DIR_LIBS . 'globalfunctions.php');

		// 11. install custom skins
		$aSkinErrors = installCustomSkins($manager);
		$defskinQue  = 'SELECT `sdnumber` as result FROM ' . sql_table('skin_desc') . ' WHERE `sdname` = "default"';
		$defSkinID   = quickQuery($defskinQue);
		$updateQuery = 'UPDATE ' . sql_table('blog') . ' SET `bdefskin` = ' . intval($defSkinID) . ' WHERE `bnumber` = 1';
		sql_query($updateQuery);
		$updateQuery = 'UPDATE ' . sql_table('config') . ' SET `value` = ' . intval($defSkinID). ' WHERE `name` = "BaseSkin"';
		sql_query($updateQuery);

		// 12. install NP_Ping, if decided
		if ( $weblog_ping == 1 )
		{
			global $aConfPlugsToInstall;
			array_push($aConfPlugsToInstall, 'NP_Ping');
		}

		// 13. install custom plugins
		$aPlugErrors = installCustomPlugs($manager);
	}

	// 14. Write config file ourselves (if possible)
	$bConfigWritten = 0;

	if ( @file_exists('../config.php') && is_writable('../config.php') && $fp = @fopen('../config.php', 'w') )
	{
		$config_data = '<' . '?php' . "\n\n";
		//$config_data .= "\n"; (extraneous, just added extra \n to previous line
		$config_data .= "	// mySQL connection information\n";
		$config_data .= "	\$MYSQL_HOST = '" . $mysql_host . "';\n";
		$config_data .= "	\$MYSQL_USER = '" . $mysql_user . "';\n";
		$config_data .= "	\$MYSQL_PASSWORD = '" . $mysql_password . "';\n";
		$config_data .= "	\$MYSQL_DATABASE = '" . $mysql_database . "';\n";
		$config_data .= "	\$MYSQL_PREFIX = '" . (($mysql_usePrefix == 1)?$mysql_prefix:'') . "';\n";
		$config_data .= "	// new in 3.50. first element is db handler, the second is the db driver used by the handler\n";
		$config_data .= "	// default is \$MYSQL_HANDLER = array('mysql','mysql');\n";
		$config_data .= "	//\$MYSQL_HANDLER = array('mysql','mysql');\n";
		$config_data .= "	//\$MYSQL_HANDLER = array('pdo','mysql');\n";
		$config_data .= "	\$MYSQL_HANDLER = array('".$MYSQL_HANDLER[0]."','".$MYSQL_HANDLER[1]."');\n";
		$config_data .= "\n";
		$config_data .= "	// main nucleus directory\n";
		$config_data .= "	\$DIR_NUCLEUS = '" . $config_adminpath . "';\n";
		$config_data .= "\n";
		$config_data .= "	// path to media dir\n";
		$config_data .= "	\$DIR_MEDIA = '" . $config_mediapath . "';\n";
		$config_data .= "\n";
		$config_data .= "	// extra skin files for imported skins\n";
		$config_data .= "	\$DIR_SKINS = '" . $config_skinspath . "';\n";
		$config_data .= "\n";
		$config_data .= "	// these dirs are normally sub dirs of the nucleus dir, but \n";
		$config_data .= "	// you can redefine them if you wish\n";
		$config_data .= "	\$DIR_PLUGINS = \$DIR_NUCLEUS . 'plugins/';\n";
		$config_data .= "	\$DIR_LANG = \$DIR_NUCLEUS . 'language/';\n";
		$config_data .= "	\$DIR_LIBS = \$DIR_NUCLEUS . 'libs/';\n";
		$config_data .= "\n";
		$config_data .= "	// include libs\n";
		$config_data .= "	include(\$DIR_LIBS.'globalfunctions.php');\n";
		$config_data .= "?" . ">";

		$result = @fputs($fp, $config_data, i18n::strlen($config_data) );
		fclose($fp);

		if ( $result )
		{
			$bConfigWritten = 1;
		} // end if

	} // end if
	echo "<?xml version=\"1.0\" encoding=\"" . i18n::get_current_charset() . "\" ?>\n";
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\" lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\">\n";
?>
<head>
	<title><?php echo _TITLE; ?></title>
	<style>@import url('../nucleus/styles/manual.css');</style>
</head>
<body>
	<div style='text-align:center'><img src='../nucleus/styles/logo.gif' /></div> <!-- Nucleus logo -->

<?php
	$aAllErrors = array_merge($aSkinErrors, $aPlugErrors);

	if ( count($aAllErrors) > 0 )
	{
		echo '<h1>' . _TITLE2 . '</h1>';
		echo '<ul><li>' . implode('</li><li>', $aAllErrors) . '</li></ul>';
	}

	// begin if: config file not written
	if ( !$bConfigWritten )
	{
?>
		<h1><?php echo _TITLE3; ?></h1>

		<?php echo _TEXT10; ?>

		<pre><code>&lt;?php
	// mySQL connection information
	$MYSQL_HOST = '<b><?php echo $mysql_host?></b>';
	$MYSQL_USER = '<b><?php echo $mysql_user?></b>';
	$MYSQL_PASSWORD = '<i><b>xxxxxxxxxxx</b></i>';
	$MYSQL_DATABASE = '<b><?php echo $mysql_database?></b>';
	$MYSQL_PREFIX = '<b><?php echo ($mysql_usePrefix == 1)?$mysql_prefix:''?></b>';

	// new in 3.50. first element is db handler, the second is the db driver used by the handler
	// default is $MYSQL_HANDLER = array('mysql','mysql');
	//$MYSQL_HANDLER = array('mysql','mysql');
	//$MYSQL_HANDLER = array('pdo','mysql');
	$MYSQL_HANDLER = array('mysql','');

	// main nucleus directory
	$DIR_NUCLEUS = '<b><?php echo $config_adminpath?></b>';

	// path to media dir
	$DIR_MEDIA = '<b><?php echo $config_mediapath?></b>';

	// extra skin files for imported skins
	$DIR_SKINS = '<b><?php echo $config_skinspath?></b>';

	// these dirs are normally sub dirs of the nucleus dir, but
	// you can redefine them if you wish
	$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
	$DIR_LANG = $DIR_NUCLEUS . 'language/';
	$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

	// include libs
	include($DIR_LIBS.'globalfunctions.php');
?&gt;</code></pre>

	<?php echo _TEXT11; ?>

	<div class="note">
	<?php echo _TEXT12; ?>
	</div>

<?php
	}
	// else: config file written
	else
	{
?>

	<h1><?php echo _TITLE4; ?></h1>

	<?php echo _TEXT13; ?>

<?php
	} // end if
?>

	<h1><?php echo _TITLE5; ?></h1>

	<?php echo _TEXT14; ?>

	<ul>
		<li><?php echo _TEXT14_L1; ?></li>
		<li><?php echo _TEXT14_L2; ?></li>
	</ul>

	<h1><?php echo _HEADER10; ?></h1>

	<?php echo _TEXT15; ?>

	<ul>
		<li><?php echo _TEXT15_L1; ?></li>
		<li><?php echo _TEXT15_L2; ?></li>
	</ul>

	<?php echo _TEXT16; ?>

	<h1><?php echo _HEADER11; ?></h1>

	<p><?php echo _TEXT16_H; ?>
		<ul>
			<li><a href="<?php echo $config_adminurl?>"><?php echo _TEXT16_L1; ?></a></li>
			<li><a href="<?php echo $config_indexurl?>"><?php echo _TEXT16_L2; ?></a></li>
		</ul>
	</p>

</body>
</html>

<?php
} // end function doInstall()


/**
 * Install custom plugins
 */
function installCustomPlugs(&$manager)
{
	global $aConfPlugsToInstall, $DIR_LIBS;

	$aErrors = array();

	if ( count($aConfPlugsToInstall) == 0 )
	{
		return $aErrors;
	}

	$res = sql_query('SELECT * FROM ' . sql_table('plugin') );
	$numCurrent = sql_num_rows($res);

	foreach ( $aConfPlugsToInstall as $plugName )
	{
		// do this before calling getPlugin (in case the plugin id is used there)
		$query = 'INSERT INTO ' . sql_table('plugin') . ' (`porder`, `pfile`) VALUES (' . (++$numCurrent) . ', "' . addslashes($plugName) . '")';
		sql_query($query);

		// get and install the plugin
		$manager->clearCachedInfo('installedPlugins');
		$plugin =& $manager->getPlugin($plugName);
		$plugin->setID($numCurrent);
		
		if ( !$plugin )
		{
			sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE `pfile` = \'' . addslashes($plugName) . '\'');
			$numCurrent--;
			array_push($aErrors, _ERROR22 . $plugName);
			continue;
		} // end if

		$plugin->install();
	} // end loop

	// SYNC PLUGIN EVENT LIST
	sql_query('DELETE FROM ' . sql_table('plugin_event') );

	// loop over all installed plugins
	$res = sql_query('SELECT `pid`, `pfile` FROM ' . sql_table('plugin') );

	while ( $o = sql_fetch_object($res) )
	{
		$pid = $o->pid;
		$plug =& $manager->getPlugin($o->pfile);

		if ( $plug )
		{
			$eventList = $plug->getEventList();

			foreach ( $eventList as $eventName )
			{
				sql_query('INSERT INTO ' . sql_table('plugin_event') . ' (`pid`, `event`) VALUES (' . $pid . ', \'' . $eventName . '\')');
			} // end loop

		} // end if

	} // end loop

	return $aErrors;
} // end function installCustomPlugs()


/**
 * Install custom skins
 * Prepares the installation of custom skins
 */
function installCustomSkins(&$manager)
{
	global $aConfSkinsToImport, $DIR_LIBS, $DIR_SKINS, $manager;

	$aErrors = array();

	if ( empty($manager) )
	{
		$manager = new MANAGER;
	}

	if ( count($aConfSkinsToImport) == 0 )
	{
		return $aErrors;
	}

	// load skinie class
	include_once($DIR_LIBS . 'skinie.php');

	$importer = new SKINIMPORT();

	foreach ( $aConfSkinsToImport as $skinName )
	{
		$importer->reset();
		$skinFile = $DIR_SKINS . $skinName . '/skinbackup.xml';

		if ( !@file_exists($skinFile) )
		{
			array_push($aErrors, _ERROR23_1 . $skinFile . ' : ' . _ERROR23_2);
			continue;
		} // end if

		$error = $importer->readFile($skinFile);

		if ( $error )
		{
			array_push($aErrors, _ERROR24 . $skinName . ' : ' . $error);
			continue;
		} // end if

		$error = $importer->writeToDatabase(1);

		if ( $error )
		{
			array_push($aErrors, _ERROR24 . $skinName . ' : ' . $error);
			continue;
		} // end if

	} // end loop

	return $aErrors;
} // end function installCustomSkins()


/**
 * Check if some important files of the Nucleus CMS installation are available
 * Give an error if one or more files are not accessible
 */
function doCheckFiles()
{
	$missingfiles = array();
	$files = array(
		'./install.sql',
		'../index.php',
		'../action.php',
		'../nucleus/index.php',
		'../nucleus/libs/globalfunctions.php',
		'../nucleus/libs/ADMIN.php',
		'../nucleus/libs/BLOG.php',
		'../nucleus/libs/COMMENT.php',
		'../nucleus/libs/COMMENTS.php',
		'../nucleus/libs/ITEM.php',
		'../nucleus/libs/MEMBER.php',
		'../nucleus/libs/SKIN.php',
		'../nucleus/libs/TEMPLATE.php',
		'../nucleus/libs/MEDIA.php',
		'../nucleus/libs/ACTIONLOG.php',
		'../nucleus/media.php'
	);
	
	$count = count($files);

	for ( $i = 0; $i < $count; $i++ )
	{

		if ( !is_readable($files[$i]) )
		{
			array_push($missingfiles, _ERROR25_1 . $files[$i] . _ERROR25_2);
		} // end if

	} // end loop

	if ( count($missingfiles) > 0 )
	{
		showErrorMessages($missingfiles);
	} // end if

} // end function doCheckFiles()


/**
 * Updates the configuration in the database
 *
 * @param string $name name of the config var
 * @param string $value new value of the config var
 * @return int
 */
function updateConfig($name, $value)
{
	global $MYSQL_CONN;
	$name = addslashes($name);
	$value = trim(addslashes($value) );

	$query = 'UPDATE ' . tableName('nucleus_config')
			. " SET `value` = '$value'"
			. " WHERE `name` = '$name'";

	sql_query($query, $MYSQL_CONN) or _doError(_ERROR26 . ': ' . sql_error($MYSQL_CONN) );
	return sql_insert_id($MYSQL_CONN);
}


/**
 * Replaces double backslashs
 *
 * @param string $input string that could have double backslashs
 * @return string
 */
function replace_double_backslash($input)
{
	return str_replace('\\', '/', $input);
}


/**
 * Checks if a string ends with a slash
 *
 * @param string $input
 * @return string
 */
function ends_with_slash($input)
{
	return ( i18n::strrpos($input, '/') == i18n::strlen($input) - 1);
}


/**
 * Checks if email address is valid
 *
 * @param string $address address which should be tested
 * @return bool
 */
function _isValidMailAddress($address)
{

	if ( preg_match("/^[a-zA-Z0-9\._-]+@+[A-Za-z0-9\._-]+\.+[A-Za-z]{2,4}$/", $address) )
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	} // end if

}


/*
 * Check if short blog names and nicknames are allowed
 * Returns true if the given string is a valid shortname
 * logic: only letters and numbers are allowed, no spaces allowed
 *
 * FIX: function eregi is deprecated since PHP 5.3.0
 *
 * @param string $name name which should be tested
 * @return bool
 */
function _isValidShortName($name)
{

	if ( preg_match("/^[a-z0-9]+$/i", $name) )
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	} // end if

}


/*
 * Check if a display name is allowed
 * Returns true if the given string is a valid display name
 *
 * FIX: function eregi is deprecated since PHP 5.3.0
 *
 * @param string $name name which should be tested
 * @return bool
 */
function _isValidDisplayName($name)
{

	if ( preg_match("/^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$/i", $name) )
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	} // end if

}


/**
 * Shows error message
 *
 * @param string $msg error message
 */
function _doError($message)
{
	echo "<?xml version=\"1.0\" encoding=\"" . i18n::get_current_charset() . "\" ?>\n";
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\" lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\">\n";
?>
<head>
	<title><?php echo _TITLE; ?></title>
	<style>@import url('../nucleus/styles/manual.css');</style>
</head>
<body>
	<div style="text-align: center;"><img src="../nucleus/styles/logo.gif" /></div>
	<h1><?php echo _ERROR27; ?></h1>

	<p> <?php echo _ERROR28; ?>: "<?php echo $message; ?>" </p>
	<p> <a href="./index.php" onclick="history.back(); return false;"><?php echo _TEXT17; ?></a> </p>
</body>
</html>

<?php
	exit;
}


/*
 * Shows error messages
 *
 * @param array $errors array with error messages
 */
function showErrorMessages($errors)
{
	echo "<?xml version=\"1.0\" encoding=\"" . i18n::get_current_charset() . "\" ?>\n";
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\" lang=\"" . preg_replace('#_#', '-', i18n::get_current_locale()) . "\">\n";
?>
<head>
	<title><?php echo _TITLE; ?></title>
	<style>@import url('../nucleus/styles/manual.css');</style>
</head>
<body>
	<div style='text-align:center'><img src='../nucleus/styles/logo.gif' /></div> <!-- Nucleus logo -->
	<h1><?php echo _ERROR27; ?></h1>

	<p><?php echo _ERROR29; ?>:</p>

	<ul>

<?php
while ( $msg = array_shift($errors) )
{
	echo '<li>', $msg, '</li>';
}
?>
	</ul>
	<p><a href="./index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a></p>
</body>
</html>

<?php
exit;
}


/* for the non-php systems that decide to show the contents:
?></div>
<?php
*/