<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * This script will install the Nucleus tables in your SQL-database,
 * and initialize the data in those tables.
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id$
 */

/* global values initialize */
$CONF = array();

/* reporting all errors for support */
error_reporting(E_ALL);

$minimum_php_version = '5.0.6';
$minimum_mysql_version = '3.23';

$page_footer_copyright	= '&copy; 2001-2012 The Nucleus Groupe . Running Nucleus CMS v4.00';

// begin if: server's PHP version is below the minimum; halt installation
if ( version_compare(PHP_VERSION, $minimum_php_version, '<') )
{
	exit('<div style="font-size: xx-large;"> Nucleus requires at least PHP version '. $minimum_php_version .'</div>');
}

// make sure there's no unnecessary escaping: # set_magic_quotes_runtime(0);
if ( version_compare(PHP_VERSION, '5.3.0', '<') )
{
	ini_set('magic_quotes_runtime', '0');
}

/* default installed plugins and skins */
$aConfPlugsToInstall	= array('NP_SecurityEnforcer', 'NP_SkinFiles', 'NP_Text');
$aConfSkinsToImport		= array('atom', 'rss2.0', 'rsd', 'default');

// Check if some important files
do_check_files();

/* i18n class is needed for internationalization */
include_once('../nucleus/libs/i18n.php');
if ( !i18n::init('UTF-8', './locales') )
{
	exit('<div style="font-size: xx-large;"> Failed to initialize iconv or mbstring extension. Would you please contact the administrator of your PHP server? </div>');
}

// check if mysql support is installed; this check may not make sense, as is, in a version past 3.5x
if ( !function_exists('mysql_query') && !function_exists('mysqli_query') )
{
	exit('<div style="font-size: xx-large;"> Your PHP version does not have support for MySQL :( </div>');
}

// include core classes that are needed for login & plugin handling
include_once('../nucleus/libs/mysql.php');

// added for 3.5 sql_* wrapper
global $MYSQL_HANDLER;

if ( !isset($MYSQL_HANDLER) )
{
	$MYSQL_HANDLER = array('mysql', '');
}
include_once('../nucleus/libs/sql/' . $MYSQL_HANDLER[0] . '.php');

session_start();
if ( count($_GET) == 0 && count($_POST) == 0 )
{
	unset($_SESSION['param_manager']);
}

// restore the $param from the session
if ( array_key_exists('param_manager', $_SESSION) )
{
	$param = $_SESSION['param_manager'];
}
else
{
	$param = new ParamManager();
}

// include translation file
if ( array_key_exists('locale', $_POST) ) $param->set_locale();
i18n::set_current_locale($param->locale);
$translation_file = './locales/' . i18n::get_current_locale() . '.' . i18n::get_current_charset() . '.php';
if ( !file_exists($translation_file) )
{
	$translation_file = './locales/en_Latn_US.UTF-8.php';
}
include($translation_file);

do_action();

// $param is saved to the session
if ( isset($param) )
{
	$_SESSION['param_manager'] = $param;
}
else
{
	unset($_SESSION['param_manager']);
}
exit;


/**
 * installer action
 */
function do_action()
{
	global $param;

	if ( array_key_exists('action', $_POST) )
	{
		$isPostback = true;
	}
	else
	{
		$isPostback = false;
	}

	// mode change
	if ( array_key_exists('mode', $_REQUEST) )
	{
		if ( $_REQUEST['mode'] == 'detail' )
		{
			$param->set_state('detail');
		}
		elseif ( $_REQUEST['mode'] == 'simple' )
		{
			$param->set_state('mysql');
		}
	}

	// input parameter check
	if ( $isPostback )
	{
		switch ( $param->state )
		{
			case 'locale':
				$param->set_locale();
				$param->set_state('mysql');
				$isPostback = false;
				break;
			case 'mysql':
				if ( count($param->check_mysql_parameters()) == 0 )
				{
					$param->set_state('weblog');
					$isPostback = false;
				}
				break;
			case 'weblog':
				if ( count($param->check_user_parameters()) == 0
					&& count($param->check_weblog_parameters()) == 0 )
				{
					$param->set_state('install');
					$isPostback = false;
				}
				break;
			case 'detail':
				if ( $param->check_all_parameters() )
				{
					$param->set_state('install');
					$isPostback = false;
				}
				break;
		}
	}

	// page render
	show_header();
	switch ( $param->state )
	{
		case 'locale':
			show_select_locale_form();
			break;
		case 'mysql':
			show_database_setting_form($isPostback);
			break;
		case 'weblog':
			show_blog_setting_form($isPostback);
			break;
		case 'detail':
			show_detail_setting_form($isPostback);
			break;
		case 'install':
			show_install_complete_form();
			break;
	}
	show_footer();
}

/**
 * header tag of the installation screens
 **/
function show_header()
{
	global $param;

	/* HTTP 1.1 application for no caching */
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header('Content-Type: text/html; charset=' . i18n::get_current_charset());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo _TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="./styles/inst.css" />
		<style type="text/css">
		<!--
		<?php echo _BODYFONTSTYLE; ?>
		-->
		</style>
		<script type="text/javascript">
			function SelectText( element ) {
				window.setTimeout( function() { element.select() }, 0 );
			}
			var isSubmit = false;
			function OnceSubmit() {
				if (!isSubmit) {
					isSubmit = true;
					window.setTimeout( function() { isSubmit = false; }, 10000 );
					return true;
				}
				return false;
			}
		</script>
	</head>
	<body>
		<div id="header">
			<div id="navigation">
				<h1><img src="./styles/nucleus_rogo.png" alt="NucleusCMS" /></h1>
				<ul>
					<?php
					if ( in_array($param->state, array('mysql', 'weblog', 'install')) )
					{
						echo '<li>', _STEP1, '</li><li';
						if ( $param->state == 'mysql' )
						{
							echo ' class="gry"';
						}
						echo '>&nbsp; &gt; &nbsp;', _STEP2, '</li><li';
						if ( in_array($param->state, array('mysql', 'weblog')) )
						{
							echo ' class="gry"';
						}
						echo '>&nbsp; &gt; &nbsp;', _STEP3, "</li>\n";
					}
					if ( in_array($param->state, array('mysql', 'weblog', 'detail')) )
					{
						echo '<li class="rightbox">';
						if ( in_array($param->state, array('mysql', 'weblog')) )
						{
							echo '<a href="./?mode=detail">', _MODE2, '</a>';
						}
						else
						{
							echo '<a href="./?mode=simple">', _MODE1, '</a>';
						}
						echo '</li>';
					}
					?>
				</ul>
			</div>
		</div>
<?php
}

/**
 * footer tag of the installation screens
 **/
function show_footer()
{
	global $page_footer_copyright;
?>
		<div id="footer">
			<?php echo $page_footer_copyright; ?>
		</div>
	</body>
</html>
<?php
}

/**
 * Display the form for language select
 */
function show_select_locale_form()
{
	// Get the browser language that can be displayed
	// TODO: default locale select simple implementation
	$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	foreach ($languages as $language)
	{
		$language = preg_replace('#([\w]+).*#', '$1', $language);
		break;
	}

	$locales = array(
		array('en_Latn_US', 'English - United States'),
		array('ja_Jpan_JP', 'Japanese - Japan')
	);
?>
		<div id="container">
			<p style="font-size:152%;font-weight:bold;">
				Select your locale:
			</p>
			<form method="post" action="./index.php">

				<div class="prt">
					<select name="locale">
<?php
	foreach ( $locales as $locale )
	{
		echo "<option value=\"$locale[0]\"";
		if ( i18n::strpos($locale[0], $language) === 0 )
		{
			echo ' selected';
		}
		echo ">$locale[1]</option>\n";
	}
?>
					</select>
					<p class="sbt">
						<button type="submit" name="action" value="locale" class="sbt_arw">START</button>
					</p>
				</div>
			</form>
		</div>
<?php
}

/**
 * Display the form to set up a database
 * @param bool $isPostback
 */
function show_database_setting_form($isPostback)
{
	global $param, $minimum_mysql_version;

	$config_writable = canConfigFileWritable();
	$mysql_version = getMySqlVersion();
	?>
		<div id="container">
			<p class="msg">
<?php
	echo _SIMPLE_NAVI1;
	if ( $config_writable != '' )
	{
		echo '<span class="err">', $config_writable, '</span>';
	}
	if ( $mysql_version == '0.0.0' )
	{
		echo '<span class="err">', _DBVERSION_UNKOWN, '</span>';
	}
	elseif ( version_compare($mysql_version, $minimum_mysql_version, '<') )
	{
		echo '<span class="err">', sprintf(_DBVERSION_TOOLOW , $minimum_mysql_version), '</span>';
	}
?>
			</p>
			<form method="post" action="./index.php">
				<div class="prt">
					<h2><?php echo _DB_HEADER; ?></h2>
					<p class="msg">
<?php
	if ( $isPostback )
	{
		$errors = $param->check_mysql_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD1; ?></span><span class="sub"><?php echo _DB_FIELD1_DESC; ?></span></th>
								<td><input type="text" name="mysql_host" value="<?php echo $param->mysql_host; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD2; ?></span><span class="sub"><?php echo _DB_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="mysql_user" value="<?php echo $param->mysql_user; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD3; ?></span></th>
								<td><input type="text" name="mysql_password" value="<?php echo $param->mysql_password; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD4; ?></span><span class="sub"><?php echo _DB_FIELD4_DESC; ?></span></th>
								<td><input type="text" name="mysql_database" value="<?php echo $param->mysql_database; ?>" /></td>
						</tr>
					</table>
					<p class="sbt">
						<button type="submit" name="mode" value="detail" class="sbt_sqr"><?php echo _MODE2; ?></button>
						<button type="submit" name="action" value="mysql" class="sbt_arw"><?php echo _NEXT; ?></button>
					</p>
					<p class="msg">
						<?php echo _DB_TEXT1; ?>
					</p>
				</div>
			</form>
		</div>
<?php
}

/**
 * Displays a form to the blog settings
 * @param bool $isPostback
 */
function show_blog_setting_form($isPostback)
{
	global $param;

?>
		<div id="container">
			<p class="msg">
				<?php echo _SIMPLE_NAVI2; ?>
			</p>
			<form method="post" action="./index.php">
				<div class="prt">
					<h2><?php echo _BLOG_HEADER; ?></h2>
					<p class="msg">
<?php
	if ( $isPostback )
	{
		$errors = $param->check_weblog_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _BLOG_FIELD1; ?></span></th>
								<td><input type="text" name="blog_name" value="<?php echo $param->blog_name; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _BLOG_FIELD2; ?></span><span class="sub"><?php echo _BLOG_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="blog_shortname" value="<?php echo $param->blog_shortname; ?>" /></td>
						</tr>
					</table>
				</div>

				<div class="prt">
					<h2><?php echo _ADMIN_HEADER; ?></h2>
					<p class="msg">
<?php
	if ( $isPostback )
	{
		$errors = $param->check_user_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD1; ?></span></th>
								<td><input type="text" name="user_realname" value="<?php echo $param->user_realname; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD2; ?></span><span class="sub"><?php echo _ADMIN_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="user_name" value="<?php echo $param->user_name; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD3; ?></span></th>
								<td><input type="password" name="user_password" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD4; ?></span></th>
								<td><input type="password" name="user_password2" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD5; ?></span></th>
								<td><input type="text" name="user_email" value="<?php echo $param->user_email; ?>" /></td>
						</tr>
					</table>
					<p class="sbt">
						<button type="submit" name="action" value="weblog" class="sbt_arw" onclick="OnceSubmit()"><?php echo _INSTALL; ?></button>
					</p>
				</div>
			</form>
		</div>
<?php
}

/**
 * Displays a form to the detail settings
 * @param bool $isPostback
 */
function show_detail_setting_form($isPostback)
{
	global $param, $minimum_mysql_version;

	$mysql_version = getMySqlVersion();
?>
		<div id="container_detailed">
			<p class="msg">
				<?php echo _DETAIL_NAVI1; ?>
<?php
	if ( $isPostback && !$param->check_all_parameters() )
	{
		echo '<span class="err">', _VALID_ERROR, "</span>\n";
	}
?>
			</p>
			<ul class="msg">
				<li>PHP: <?php echo phpversion(); ?></li>
				<li>MySQL:
<?php
	echo ($mysql_version == '0.0.0') ? _DBVERSION_UNKOWN : $mysql_version;
	if ( version_compare($mysql_version, $minimum_mysql_version, '<') )
	{
		echo '<span class="err">', sprintf(_DBVERSION_TOOLOW , $minimum_mysql_version), '</span>';
	}
?></li>
			</ul>
			<form method="post" action="">

				<div class="prt">
					<h2><?php echo _DETAIL_HEADER1; ?></h2>
					<p class="msg">
<?php
	if ( $isPostback )
	{
		$errors = $param->check_mysql_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD1; ?></span><span class="sub"><?php echo _DB_FIELD1_DESC; ?></span></th>
								<td><input type="text" name="mysql_host" value="<?php echo $param->mysql_host; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD2; ?></span><span class="sub"><?php echo _DB_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="mysql_user" value="<?php echo $param->mysql_user; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD3; ?></span></th>
								<td><input type="text" name="mysql_password" value="<?php echo $param->mysql_password; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD4; ?></span><span class="sub"><?php echo _DB_FIELD4_DESC; ?></span></th>
								<td><input type="text" name="mysql_database" value="<?php echo $param->mysql_database; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _DB_FIELD5; ?></span><span class="sub"><?php echo _DB_FIELD5_DESC; ?></span></th>
								<td><input type="text" name="mysql_tablePrefix" value="<?php echo $param->mysql_tablePrefix; ?>" /></td>
						</tr>
					</table>

					<h2><?php echo _DETAIL_HEADER2; ?></h2>
					<p class="msg">
<?php
	if ( $isPostback )
	{
		$errors = $param->check_uri_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
		$errors = $param->check_path_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD1; ?></span></th>
								<td><input type="text" name="IndexURL" value="<?php echo $param->IndexURL; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD2; ?></span></th>
								<td><input type="text" name="AdminURL" value="<?php echo $param->AdminURL; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD3; ?></span></th>
								<td><input type="text" name="AdminPath" value="<?php echo $param->AdminPath; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD4; ?></span></th>
								<td><input type="text" name="MediaURL" value="<?php echo $param->MediaURL; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD5; ?></span></th>
								<td><input type="text" name="MediaPath" value="<?php echo $param->MediaPath; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD6; ?></span></th>
								<td><input type="text" name="SkinsURL" value="<?php echo $param->SkinsURL; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD7; ?></span></th>
								<td><input type="text" name="SkinsPath" value="<?php echo $param->SkinsPath; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD8; ?></span></th>
								<td><input type="text" name="PluginURL" value="<?php echo $param->PluginURL; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _PATH_FIELD9; ?></span></th>
								<td><input type="text" name="ActionURL" value="<?php echo $param->ActionURL; ?>" /></td>
						</tr>
					</table>
					<p class="msg">
						<?php echo _DETAIL_TEXT3; ?>
					</p>

					<h2><?php echo _DETAIL_HEADER3; ?></h2>
					<p class="msg">
<?php
	echo _DETAIL_TEXT4;
	if ( $isPostback )
	{
		$errors = $param->check_user_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD1; ?></span></th>
								<td><input type="text" name="user_realname" value="<?php echo $param->user_realname; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD2; ?></span><span class="sub"><?php echo _ADMIN_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="user_name" value="<?php echo $param->user_name; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD3; ?></span></th>
								<td><input type="password" name="user_password" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD4; ?></span></th>
								<td><input type="password" name="user_password2" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _ADMIN_FIELD5; ?></span></th>
								<td><input type="text" name="user_email" value="<?php echo $param->user_email; ?>" /></td>
						</tr>
					</table>

					<h2><?php echo _DETAIL_HEADER4; ?></h2>
					<p class="msg">
<?php
	echo _DETAIL_TEXT5;
	if ( $isPostback )
	{
		$errors = $param->check_weblog_parameters();
		if ( is_array($errors) )
		{
			foreach ( $errors as $error )
			{
				echo '<span class="err">', $error, "</span>\n";
			}
		}
	}
?>
					</p>
					<table>
						<tr>
							<th><span class="nam"><?php echo _BLOG_FIELD1; ?></span></th>
								<td><input type="text" name="blog_name" value="<?php echo $param->blog_name; ?>" /></td>
						</tr>
						<tr>
							<th><span class="nam"><?php echo _BLOG_FIELD2; ?></span><span class="sub"><?php echo _BLOG_FIELD2_DESC; ?></span></th>
								<td><input type="text" name="blog_shortname" value="<?php echo $param->blog_shortname; ?>" /></td>
						</tr>
					</table>

					<p class="msg">
						<?php echo _DETAIL_TEXT6; ?>
					</p>

					<p class="sbt">
						<button type="submit" name="action" value="detail" class="sbt_arw" onclick="OnceSubmit()"><?php echo _INSTALL; ?></button>
					</p>
				</div>
			</form>
		</div>
<?php
}

/**
 * Displays a screen to signal the completion of the installation
 */
function show_install_complete_form()
{
	global $MYSQL_HANDLER, $param;
	$errors = do_install();
?>
		<div id="container">
			<p class="msg">
<?php
	if ( is_array($errors) && count($errors) > 0 )
	{
		echo _INST_ERROR;
		foreach ( $errors as $error )
		{
			echo '<span class="err">', $error, "</span>\n";
		}
	}
	else
	{
		echo _INST_TEXT;
		if ( array_key_exists('config_data', $_SESSION) )
		{
			echo '<span class="err">', _INST_TEXT4, '</span>';
?>
<textarea id="config_text" readonly="readonly" onfocus="SelectText(this);"><?php echo htmlentities($_SESSION['config_data'], null, i18n::get_current_charset() ) ?></textarea>
<?php
		}
		else
		{
			echo '<span class="err">', _INST_TEXT5, '</span>';
		}
?>
			</p>
			<form method="post" action="./index.php">
				<div class="prt">
					<h2><?php echo _INST_HEADER1; ?></h2>
					<p class="msg">
						<?php echo sprintf(_INST_TEXT1, $param->blog_name); ?>
					</p>
					<p class="sbt">
						<button type="button" name="toBlog" onclick="location.href='<?php echo $param->IndexURL; ?>';" class="sbt_arw"><?php echo _INST_BUTTON1; ?></button>
					</p>
				</div>

				<div class="prt">
					<h2><?php echo _INST_HEADER2; ?></h2>
					<p class="msg">
						<?php echo _INST_TEXT2; ?>
					</p>
					<p class="sbt">
						<button type="button" name="toMng" onclick="location.href='<?php echo $param->AdminURL; ?>';" class="sbt_arw"><?php echo _INST_BUTTON2; ?></button>
					</p>
				</div>

				<div class="prt">
					<h2><?php echo _INST_HEADER3; ?></h2>
					<p class="msg">
						<?php echo _INST_TEXT3; ?>
					</p>
					<p class="sbt">
						<button type="button" name="toAddBlog" onclick="location.href='<?php echo $param->AdminURL; ?>index.php?action=createnewlog';" class="sbt_arw"><?php echo _INST_BUTTON3; ?></button>
					</p>
				</div>
			</form>
<?php
	}
?>
		</div>
<?php
	unset($param);
}

/**
 * The installation process itself
 * @return array error messages
 */
function do_install()
{
	global $param;
	global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_PREFIX, $MYSQL_CONN;
	global $DIR_NUCLEUS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;
	$errors = array();

	/*
	 * 1. put all param-vars into vars
	 */
	$MYSQL_HOST = $param->mysql_host;
	$MYSQL_USER = $param->mysql_user;
	$MYSQL_PASSWORD = $param->mysql_password;
	$MYSQL_DATABASE = $param->mysql_database;
	$MYSQL_PREFIX = $param->mysql_tablePrefix;

	$DIR_NUCLEUS = $param->AdminPath;
	$DIR_MEDIA = $param->MediaPath;
	$DIR_SKINS = $param->SkinsPath;
	$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
	$DIR_LOCALES = $DIR_NUCLEUS . 'locales/';
	$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

	/*
	 * 2.open mySQL connection
	 */
	$MYSQL_CONN = @sql_connect_args($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD);
	if ( $MYSQL_CONN == false )
	{
		$errors[] = _DBCONNECT_ERROR;
		return $errors;
	}

	/*
	 * 3. try to create database if needed
	 */
	if ( !sql_query("CREATE DATABASE IF NOT EXISTS {$MYSQL_DATABASE}") )
	{
		$errors[] = _INST_ERROR1 . ': ' . sql_error();
	}

	/*
	 * 4. try to select database
	 */
	if ( !sql_select_db($MYSQL_DATABASE) )
	{
		$errors[] = _INST_ERROR2;
	}
	sql_set_charset('utf8');

	if ( count($errors) > 0 )
	{
		return $errors;
	}

	/*
	 * 5. execute queries
	 */
	$table_names = array(
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

	$prefixed_table_names = array();
	foreach ( $table_names as $table_name )
	{
		$prefixed_table_names[] = $MYSQL_PREFIX . $table_name;
	}

	// table exists check
	$result = sql_query('SHOW TABLES');
	while ($row = mysql_fetch_array($result, MYSQL_NUM))
	{
		if ( in_array($row[0], $prefixed_table_names) )
		{
			$errors[] = _INST_ERROR3;
			break;
		}
	}
	if ( count($errors) > 0 )
	{
		return $errors;
	}

	$filename = 'install.sql';
	$fd = fopen($filename, 'r');
	$queries = fread($fd, filesize($filename) );
	fclose($fd);

	$queries = preg_split('#(;\n|;\r)#', $queries);

	foreach ( $queries as $query )
	{
		if ( preg_match('/\w+/', $query) )
		{
			if ( $MYSQL_PREFIX )
			{
				$query = str_replace($table_names, $prefixed_table_names, $query);
			}

			if ( !sql_query($query) )
			{
				$errors[] = _INST_ERROR4 . ' (<small>' . $query . '</small>): ' . sql_error();
			}
		}
	}

	/*
	 * 6. put needed records
	 */
	/* push first post */
	$query = "INSERT INTO %s VALUES (1, '%s', '%s', '%s', 1, 1, '%s', 0, 0, 0, 1, 0, 1)";
	$query = sprintf($query, tableName('nucleus_item'), _1ST_POST_TITLE, _1ST_POST, _1ST_POST2, i18n::formatted_datetime('mysql', time()));
	if ( !sql_query($query) )
	{
		$errors[] = _INST_ERROR4 . ' (<small>' . $newpost . '</small>): ' . sql_error();
	}

	/* push configurations */
	array_merge($errors, updateConfig('IndexURL', $param->IndexURL));
	array_merge($errors, updateConfig('AdminURL', $param->AdminURL));
	array_merge($errors, updateConfig('MediaURL', $param->MediaURL));
	array_merge($errors, updateConfig('SkinsURL', $param->SkinsURL));
	array_merge($errors, updateConfig('PluginURL', $param->PluginURL));
	array_merge($errors, updateConfig('ActionURL', $param->ActionURL));
	array_merge($errors, updateConfig('AdminEmail', $param->user_email));
	array_merge($errors, updateConfig('SiteName', $param->blog_name));
	array_merge($errors, updateConfig('Locale', i18n::get_current_locale()));

	/* escape strings for SQL */
	$user_name			= sql_real_escape_string($param->user_name);
	$user_realname		= sql_real_escape_string($param->user_realname);
	$user_password		= sql_real_escape_string(md5($param->user_password));
	$user_email			= sql_real_escape_string($param->user_email);
	$blog_name			= sql_real_escape_string($param->blog_name);
	$blog_shortname		= sql_real_escape_string($param->blog_shortname);
	$config_indexurl	= sql_real_escape_string($param->IndexURL);

	/* push super admin */
	$query = "UPDATE %s SET mname = '%s', mrealname = '%s', mpassword = '%s', memail = '%s', murl = '%s', madmin = 1, mcanlogin = 1 WHERE mnumber = 1";
	$query = sprintf($query, tableName('nucleus_member'), $user_name, $user_realname, $user_password, $user_email, $config_indexurl);
	if ( !sql_query($query) )
	{
		$errors[] = _INST_ERROR5 . ': ' . sql_error();
	}

	/* push new weblog */
	$query = "UPDATE %s SET bname = '%s', bshortname = '%s', burl = '%s' WHERE bnumber = 1";
	$query = sprintf($query, tableName('nucleus_blog'), $blog_name, $blog_shortname, $config_indexurl);
	if ( !sql_query($query) )
	{
		$errors[] = _INST_ERROR6 . ': ' . sql_error();
	}

	/* push default category */
	$query = "UPDATE %s SET cname = '%s', cdesc = '%s' WHERE catid = 1";
	$query = sprintf($query, tableName('nucleus_category'), _GENERALCAT_NAME, _GENERALCAT_DESC);
	if ( !sql_query($query) )
	{
		$errors[] = _INST_ERROR6 . ': ' . sql_error();
	}

	sql_close();

	/*
	 * 7. install default plugins and skins
	 */
	global $aConfPlugsToInstall, $aConfSkinsToImport;
	$aSkinErrors = array();
	$aPlugErrors = array();

	if ( (count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0) )
	{
		include_once($DIR_LIBS . 'globalfunctions.php');
		global $manager;
		if ( !isset($manager) )
		{
			$manager = new Manager();
		}

		include_once($DIR_LIBS . 'skinie.php');

		$aSkinErrors = installCustomSkins();
		if ( count($aSkinErrors) > 0 )
		{
			array_merge($errors, $aSkinErrors);
		}

		$query  = "SELECT sdnumber FROM %s WHERE sdname='default'";
		$query = sprintf($query, tableName('nucleus_skin_desc'));
		$res = sql_query($query);
		$obj = sql_fetch_assoc($res);
		$defSkinID = (integer) $obj['sdnumber'];

		$query = "UPDATE %s SET bdefskin=%d WHERE bnumber=1";
		$query = sprintf($query, tableName('nucleus_blog'), $defSkinID);
		sql_query($query);
		$query = "UPDATE %s SET value=%d WHERE name='BaseSkin'";
		$query = sprintf($query, tableName('nucleus_config'), $defSkinID);
		sql_query($query);

		$aPlugErrors = installCustomPlugs();
		if ( count($aPlugErrors) > 0 )
		{
			array_merge($errors, $aPlugErrors);
		}
	}

	/*
	 * 8. Write config file ourselves (if possible)
	 */
	$config_data = '<' . '?php' . "\n";
	$config_data .= "// mySQL connection information\n";
	$config_data .= "\$MYSQL_HOST = '" . $MYSQL_HOST . "';\n";
	$config_data .= "\$MYSQL_USER = '" . $MYSQL_USER . "';\n";
	$config_data .= "\$MYSQL_PASSWORD = '" . $MYSQL_PASSWORD . "';\n";
	$config_data .= "\$MYSQL_DATABASE = '" . $MYSQL_DATABASE . "';\n";
	$config_data .= "\$MYSQL_PREFIX = '" . $MYSQL_PREFIX . "';\n";
	$config_data .= "// new in 3.50. first element is db handler, the second is the db driver used by the handler\n";
	$config_data .= "// default is \$MYSQL_HANDLER = array('mysql','mysql');\n";
	$config_data .= "//\$MYSQL_HANDLER = array('mysql','mysql');\n";
	$config_data .= "//\$MYSQL_HANDLER = array('pdo','mysql');\n";
	$config_data .= "\$MYSQL_HANDLER = array('".$MYSQL_HANDLER[0]."','".$MYSQL_HANDLER[1]."');\n";
	$config_data .= "\n";
	$config_data .= "// main nucleus directory\n";
	$config_data .= "\$DIR_NUCLEUS = '" . $DIR_NUCLEUS . "';\n";
	$config_data .= "\n";
	$config_data .= "// path to media dir\n";
	$config_data .= "\$DIR_MEDIA = '" . $DIR_MEDIA . "';\n";
	$config_data .= "\n";
	$config_data .= "// extra skin files for imported skins\n";
	$config_data .= "\$DIR_SKINS = '" . $DIR_SKINS . "';\n";
	$config_data .= "\n";
	$config_data .= "// these dirs are normally sub dirs of the nucleus dir, but \n";
	$config_data .= "// you can redefine them if you wish\n";
	$config_data .= "\$DIR_PLUGINS = \$DIR_NUCLEUS . 'plugins/';\n";
	$config_data .= "\$DIR_LOCALES = \$DIR_NUCLEUS . 'locales/';\n";
	$config_data .= "\$DIR_LIBS = \$DIR_NUCLEUS . 'libs/';\n";
	$config_data .= "\n";
	$config_data .= "// include libs\n";
	$config_data .= "include(\$DIR_LIBS.'globalfunctions.php');\n";
	$config_data .= "?" . ">";

	$result = false;
	if ( @!file_exists('../config.php') || is_writable('../config.php') )
	{
		if ( $fp = @fopen('../config.php', 'w') )
		{
			$result = @fwrite($fp, $config_data, i18n::strlen($config_data) );
			fclose($fp);
		}
	}

	if ( $result )
	{
		// try to change the read-only permission.
		if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' )
		{
			@chmod('../config.php', 0444);
		}
	}
	else
	{
		$_SESSION['config_data'] = $config_data;
	}

	return $errors;
}

/**
 * Confirm that you can write to the configuration file
 * @return string error message
 */
function canConfigFileWritable()
{
	if ( @file_exists('../config.php') && @!is_writable('../config.php') )
	{
		// try to change the read-write permission.
		if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' )
		{
			@chmod('../config.php', 0666);
		}

		if ( @!is_writable('../config.php') )
		{
			return _INST_ERROR8;
		}
	}
	return '';
}

/**
 * To obtain the version of MySQL
 * @return string
 */
function getMySqlVersion()
{
	global $minimum_mysql_version, $errors;
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
		$match = preg_split('#\.#', $row['version']);
	}
	else
	{
		$result = @sql_query('SHOW VARIABLES LIKE \'version\'', $conn);

		if ( $result != FALSE && @sql_num_rows($result) > 0 )
		{
			$row = sql_fetch_row($result);
			$match = preg_split('#\.#', $row[1]);
		}
		else
		{
			$output = ( function_exists('shell_exec') ) ? @shell_exec('mysql -V') : '0.0.0';
			preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
			$match = preg_split('#\.#', $version[0]);

			if ( $match[0] == '' )
			{
				$match = array('0', '0', '0');
			}
		}
	}

	@sql_disconnect($conn);

	//End and clean output buffer
	ob_end_clean();

	return implode($match, '.');
}

/**
 * Add a table prefix if it is used
 *
 * @param string $input table name with prefix
 * @return string
 */
function tableName($input)
{
	global $MYSQL_PREFIX;
	if ( $MYSQL_PREFIX )
	{
		return $MYSQL_PREFIX . $input;
	}
	else
	{
		return $input;
	}
}

/**
 * Install custom plugins
 */
function installCustomPlugs()
{
	global $aConfPlugsToInstall, $DIR_LIBS, $manager;

	$aErrors = array();
	if ( count($aConfPlugsToInstall) == 0 )
	{
		return $aErrors;
	}

	$res = sql_query('SELECT * FROM ' . tableName('nucleus_plugin') );
	$numCurrent = sql_num_rows($res);

	foreach ( $aConfPlugsToInstall as $plugName )
	{
		$query = 'INSERT INTO ' . tableName('nucleus_plugin') . ' (porder, pfile) VALUES (' . (++$numCurrent) . ", '" . sql_real_escape_string($plugName) . "')";
		sql_query($query);

		$manager->clearCachedInfo('installedPlugins');
		$plugin =& $manager->getPlugin($plugName);
		$plugin->setID($numCurrent);

		if ( !$plugin )
		{
			sql_query('DELETE FROM ' . tableName('nucleus_plugin') . " WHERE pfile = '" . sql_real_escape_string($plugName) . "'");
			$numCurrent--;
			array_push($aErrors, sprintf(_INST_ERROR9 ,$plugName));
			continue;
		}
		$plugin->install();
	}

	sql_query('DELETE FROM ' . tableName('nucleus_plugin_event') );
	$res = sql_query('SELECT pid, pfile FROM ' . tableName('nucleus_plugin') );

	while ( $o = sql_fetch_object($res) )
	{
		$pid = $o->pid;
		$plug =& $manager->getPlugin($o->pfile);

		if ( $plug )
		{
			$eventList = $plug->getEventList();
			foreach ( $eventList as $eventName )
			{
				sql_query('INSERT INTO ' . tableName('nucleus_plugin_event') . ' (pid, event) VALUES (' . $pid . ", '" . $eventName . "')");
			}
		}
	}
	return $aErrors;
}

/**
 * Install custom skins
 * Prepares the installation of custom skins
 */
function installCustomSkins()
{
	global $aConfSkinsToImport, $DIR_LIBS, $DIR_SKINS;

	$aErrors = array();
	if ( count($aConfSkinsToImport) == 0 )
	{
		return $aErrors;
	}

	$importer = new SkinImport();

	foreach ( $aConfSkinsToImport as $skinName )
	{
		$importer->reset();
		$skinFile = $DIR_SKINS . $skinName . '/skinbackup.xml';

		if ( !@file_exists($skinFile) )
		{
			array_push($aErrors, sprintf(_INST_ERROR10, $skinFile));
			continue;
		}

		$error = $importer->readFile($skinFile);

		if ( $error )
		{
			array_push($aErrors, sprintf(_INST_ERROR11, $skinName) . ' : ' . $error);
			continue;
		}

		$error = $importer->writeToDatabase(1);

		if ( $error )
		{
			array_push($aErrors, sprintf(_INST_ERROR12, $skinName) . ' : ' . $error);
			continue;
		}
	}
	return $aErrors;
}


/**
 * Check if some important files of the Nucleus CMS installation are available
 * Give an error if one or more files are not accessible
 */
function do_check_files()
{
	$missingfiles = array();
	$files = array(
		'./install.sql',
		'../index.php',
		'../action.php',
		'../nucleus/index.php',
		'../nucleus/media.php',
		'../nucleus/libs/ACTION.php',
		'../nucleus/libs/ACTIONLOG.php',
		'../nucleus/libs/ACTIONS.php',
		'../nucleus/libs/ADMIN.php',
		'../nucleus/libs/BaseActions.php',
		'../nucleus/libs/BLOG.php',
		'../nucleus/libs/BODYACTIONS.php',
		'../nucleus/libs/COMMENT.php',
		'../nucleus/libs/COMMENTACTIONS.php',
		'../nucleus/libs/COMMENTS.php',
		'../nucleus/libs/ENCAPSULATE.php',
		'../nucleus/libs/ENTITY.php',
		'../nucleus/libs/globalfunctions.php',
		'../nucleus/libs/i18n.php',
		'../nucleus/libs/ITEM.php',
		'../nucleus/libs/ITEMACTIONS.php',
		'../nucleus/libs/LINK.php',
		'../nucleus/libs/MANAGER.php',
		'../nucleus/libs/MEDIA.php',
		'../nucleus/libs/MEMBER.php',
		'../nucleus/libs/mysql.php',
		'../nucleus/libs/NOTIFICATION.php',
		'../nucleus/libs/PAGEFACTORY.php',
		'../nucleus/libs/PARSER.php',
		'../nucleus/libs/PLUGIN.php',
		'../nucleus/libs/PLUGINADMIN.php',
		'../nucleus/libs/SEARCH.php',
		'../nucleus/libs/showlist.php',
		'../nucleus/libs/SKIN.php',
		'../nucleus/libs/TEMPLATE.php',
		'../nucleus/libs/vars4.1.0.php',
		'../nucleus/libs/xmlrpc.inc.php',
		'../nucleus/libs/xmlrpcs.inc.php',
		'../nucleus/libs/sql/mysql.php'
	);

	$count = count($files);
	for ( $i = 0; $i < $count; $i++ )
	{
		if ( !is_readable($files[$i]) )
		{
			array_push( $missingfiles, 'File <b>' . $files[$i] . '</b> is missing or not readable.<br />');
		}
	}

	if ( count($missingfiles) > 0 )
	{
		exit(implode( "\n", $missingfiles));
	}
}


/**
 * Updates the configuration in the database
 *
 * @param string $name name of the config var
 * @param string $value new value of the config var
 * @return array
 */
function updateConfig($name, $value)
{
	$errors = array();
	$name = sql_real_escape_string($name);
	$value = trim(sql_real_escape_string($value) );

	$query = "UPDATE %s SET value = '%s' WHERE name = '%s'";
	$query = sprintf($query, tableName('nucleus_config'), $value, $name);

	if ( !sql_query($query) )
	{
		$errors[] = _INST_ERROR4 . ': ' . sql_error();
	}
	return $errors;
}


class ParamManager
{
	/* process parameter */
	public $state;
	public $locale;

	/* mysql connection parameters */
	public $mysql_host;
	public $mysql_user;
	public $mysql_password;
	public $mysql_database;
	public $mysql_tablePrefix;

	/* weblog configuration parameters */
	public $blog_name;
	public $blog_shortname;

	/* member configuration parameters */
	public $user_name;
	public $user_realname;
	public $user_password;
	private $user_password2;
	public $user_email;

	/* URI parameters  */
	private $root_url;
	public $IndexURL;
	public $AdminURL;
	public $MediaURL;
	public $SkinsURL;
	public $PluginURL;
	public $ActionURL;

	/* path parameters */
	private $root_path;
	public $AdminPath;
	public $MediaPath;
	public $SkinsPath;

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		// set default values
		$this->state = 'locale';
		$this->install_mode = 'simple';
		$this->locale = 'en_Latn_US';
		$this->mysql_host = @ini_get('mysql.default_host');
		$this->blog_name = 'My Nucleus CMS';
		$this->blog_shortname = 'mynucleuscms';

		/* root path */
		$directory_separator = preg_quote(DIRECTORY_SEPARATOR, '|');
		$this->root_path = implode('/', preg_split("|$directory_separator|", realpath(dirname(__FILE__) . '/..')));
		if ( substr($this->root_path, -1, 1) !== '/' )
		{
			$this->root_path .= '/';
		}
		$base_path_pcre = preg_quote($this->root_path, '|');

		/* current directry name */
		$directory_name = preg_replace("#{$base_path_pcre}#", '', implode('/', preg_split("#{$directory_separator}#", realpath(dirname(__FILE__)))));
		$directory_name_pcre = preg_quote($directory_name, '|');

		/* root uri */
		$root_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		$this->root_url = preg_replace("|$directory_name_pcre(.*)$|", '', $root_url);

		$this->AdminPath = $this->root_path . 'nucleus/';
		$this->MediaPath = $this->root_path . 'media/';
		$this->SkinsPath = $this->root_path . 'skins/';

		$this->IndexURL  = $this->root_url;
		$this->AdminURL  = $this->root_url . 'nucleus/';
		$this->MediaURL  = $this->root_url . 'media/';
		$this->SkinsURL  = $this->root_url . 'skins/';
		$this->PluginURL = $this->root_url . 'nucleus/plugins/';
		$this->ActionURL = $this->root_url . 'action.php';
	}

	private function read_parameter($parameter)
	{
		foreach ( $parameter as $element )
		{
			if ( array_key_exists($element, $_POST) )
			{
				$this->$element = $_POST[$element];
			}
		}
	}

	public function set_state($state)
	{
		$states = array('locale', 'mysql', 'weblog', 'detail', 'install');
		if ( in_array($state, $states) )
		{
			$this->state = $state;
		}
	}

	public function set_locale()
	{
		$this->read_parameter(array('locale'));

		if ( !in_array($this->locale, i18n::get_available_locale_list()) )
		{
			$this->locale = 'en_Latn_US';
		}
	}

	public function check_mysql_parameters()
	{
		$parameters = array('mysql_host', 'mysql_user', 'mysql_password', 'mysql_database', 'mysql_tablePrefix');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->mysql_host == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD1);
		}

		if ( $this->mysql_user == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD2);
		}
		
		if ( $this->mysql_user != ''
			&& !preg_match('/^[a-z0-9_\-]+$/i', $this->mysql_user) )
		{
			$errors[] = sprintf(_VALID_ERROR2, _DB_FIELD2);
		}
		
		if ( $this->mysql_database == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD4);
		}

		if ( $this->mysql_database != ''
			&& !preg_match('/^[a-z0-9_\-]+$/i', $this->mysql_database) )
		{
			$errors[] = sprintf(_VALID_ERROR2, _DB_FIELD4);
		}

		if ( $this->mysql_tablePrefix != ''
			&& !preg_match('/^[a-z0-9_]+$/i', $this->mysql_tablePrefix) )
		{
			$errors[] = sprintf(_VALID_ERROR3, _DB_FIELD5);
		}
		
		if ( count($errors) == 0 )
		{
			$mysql_conn = @sql_connect_args($this->mysql_host, $this->mysql_user, $this->mysql_password);
			if ( $mysql_conn == false )
			{
				$errors[] = _DBCONNECT_ERROR;
			}
			else
			{
				@sql_close($mysql_conn);
			}
		}

		return $errors;
	}

	public function check_user_parameters()
	{
		$parameters = array('user_name', 'user_realname', 'user_password', 'user_password2', 'user_email');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->user_realname == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD1);
		}

		if ( $this->user_name == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD2);
		}
		elseif ( !preg_match("/^[a-z0-9]+([ a-z0-9]*[a-z0-9]+)?$/i", $this->user_name) )
		{
			$errors[] = _VALID_ERROR5;
		}

		if ( $this->user_password == '' || $this->user_password2 == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD3);
			$this->user_password = '';
		}
		elseif ( $this->user_password != $this->user_password2 )
		{
			$errors[] = _VALID_ERROR6;
			$this->user_password = '';
		}

		if ( !preg_match("/^[a-z0-9\._+\-]+@[a-z0-9\._\-]+\.[a-z]{2,6}$/i", $this->user_email) )
		{
			$errors[] = _VALID_ERROR7;
		}

		return $errors;
	}

	public function check_weblog_parameters()
	{
		$parameters = array('blog_name', 'blog_shortname');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->blog_name == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _BLOG_FIELD1);
		}

		if ( $this->blog_shortname == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _BLOG_FIELD2);
		}

		if ( !preg_match("/^[a-z0-9]+$/i", $this->blog_shortname) )
		{
			$errors[] = _VALID_ERROR4;
		}

		return $errors;
	}

	public function check_uri_parameters()
	{
		$parameters = array('IndexURL', 'AdminURL', 'MediaURL', 'SkinsURL', 'PluginURL', 'ActionURL');
		$this->read_parameter($parameters);

		$errors = array();
		if ( substr($this->IndexURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD1);
		}

		if ( substr($this->AdminURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD2);
		}

		if ( substr($this->MediaURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD4);
		}

		if ( substr($this->SkinsURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD6);
		}

		if ( substr($this->PluginURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD8);
		}

		if ( strrchr($this->ActionURL, '/') != '/action.php' )
		{
			$errors[] = sprintf(_VALID_ERROR9, _PATH_FIELD9);
		}

		return $errors;
	}

	public function check_path_parameters()
	{
		$parameters = array('AdminPath', 'MediaPath', 'SkinsPath');
		$this->read_parameter($parameters);

		$separators = array('/', DIRECTORY_SEPARATOR);
		$errors = array();
		if ( !in_array(substr($this->AdminPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD3);
		}
		elseif ( !file_exists($this->AdminPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD3);
		}

		if ( !in_array(substr($this->MediaPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD5);
		}
		elseif ( !file_exists($this->MediaPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD5);
		}

		if ( !in_array(substr($this->SkinsPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD7);
		}
		elseif ( !file_exists($this->SkinsPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD7);
		}

		return $errors;
	}

	/**
	 * check all parameters
	 * @return bool
	 */
	public function check_all_parameters()
	{
		$this->set_locale();

		$isValid = true;
		$isValid &= (count($this->check_mysql_parameters()) == 0);
		$isValid &= (count($this->check_user_parameters()) == 0);
		$isValid &= (count($this->check_weblog_parameters()) == 0);
		$isValid &= (count($this->check_uri_parameters()) == 0);
		$isValid &= (count($this->check_path_parameters()) == 0);

		return $isValid;
	}
}
