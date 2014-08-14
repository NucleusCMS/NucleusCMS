<?php
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
	echo '<li>';
	$label = '_LOCALE_' . strtoupper($param->locale);
	if ( !defined($label) )
	{
		echo $param->locale;
	}
	else
	{
		echo constant($label);
	}
	echo "</li>\n";

	if ( in_array($param->state, array('mysql', 'weblog', 'install')) )
	{
		echo '<li>&nbsp; &gt; &nbsp;' . _STEP1, '</li><li';
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
	global $param;

?>
		<div id="container">
			<p style="font-weight:bold;margin-top:2em;">
				<?php echo _LOCALE_HEADER; ?>
			</p>
			<form method="post" action="./index.php">

				<div class="prt">
					<select name="locale">
<?php
	$locales = i18n::get_available_locale_list();
	foreach ( $locales as $locale )
	{
		if ( $param->locale != $locale )
		{
			echo "<option value=\"{$locale}\">";
		}
		else
		{
			echo "<option value=\"{$locale}\" selected=\"selected\">";
		}

		$checkfile = "./locales/{$locale}." . i18n::get_current_charset() . '.php';
		if ( !file_exists($checkfile) )
		{
			echo '*&nbsp;';
		}

		$label = '_LOCALE_' . strtoupper($locale);
		if ( !defined($label) )
	{
			echo $locale;
		}
		else
		{
			echo constant($label);
		}
		echo "</option>\n";
	}
?>
					</select>
					<p><?php echo _LOCALE_DESC1; ?></p>
					<p><?php echo _LOCALE_DESC2; ?></p>
					<p><?php echo _LOCALE_NEED_HELP;?></p>
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
		echo '<span class="err">', sprintf(_DBVERSION_TOOLOW, $minimum_mysql_version), '</span>';
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
						<div><?php echo _DB_FIELD1; echo _DB_FIELD1_DESC; ?></div>
						<div><input type="text" name="mysql_host" value="<?php echo $param->mysql_host; ?>" /></div>
						<div><?php echo _DB_FIELD2; echo _DB_FIELD2_DESC; ?></div>
						<div><input type="text" name="mysql_user" value="<?php echo $param->mysql_user; ?>" /></div>
						<div><?php echo _DB_FIELD3; ?></div>
						<div><input type="text" name="mysql_password" value="<?php echo $param->mysql_password; ?>" /></div>
						<div><?php echo _DB_FIELD4; echo _DB_FIELD4_DESC; ?></div>
						<div><input type="text" name="mysql_database" value="<?php echo $param->mysql_database; ?>" /></div>
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
		echo '<span class="err">', sprintf(_DBVERSION_TOOLOW, $minimum_mysql_version), '</span>';
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
<textarea id="config_text" readonly="readonly" onfocus="SelectText(this);"><?php echo htmlentities($_SESSION['config_data'], null, i18n::get_current_charset()) ?></textarea>
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
	global $MYSQL_HANDLER, $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_PREFIX, $MYSQL_CONN;
	global $DIR_NUCLEUS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;
	$errors = array();

	/*
	 * 1. put all param-vars into vars
	 */
	$MYSQL_HOST		= $param->mysql_host;
	$MYSQL_USER		= $param->mysql_user;
	$MYSQL_PASSWORD	= $param->mysql_password;
	$MYSQL_DATABASE	= $param->mysql_database;
	$MYSQL_PREFIX	= $param->mysql_tablePrefix;

	$DIR_NUCLEUS	= $param->AdminPath;
	$DIR_MEDIA		= $param->MediaPath;
	$DIR_SKINS		= $param->SkinsPath;
	$DIR_PLUGINS	= $DIR_NUCLEUS . 'plugins/';
	$DIR_LOCALES	= $DIR_NUCLEUS . 'locales/';
	$DIR_LIBS		= $DIR_NUCLEUS . 'libs/';

	/*
	 * 2.open mySQL connection
	 */
	$MYSQL_CONN = @DB::setConnectionInfo($MYSQL_HANDLER[1], $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD);
	if ( $MYSQL_CONN == FALSE )
	{
		$errors[] = _DBCONNECT_ERROR;
		return $errors;
	}

	/*
	 * 3. try to create database if needed
	 */
	if ( DB::execute("CREATE DATABASE IF NOT EXISTS {$MYSQL_DATABASE}") === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR1 . ': ' . $errinfo[2];
	}

	/*
	 * 4. try to select database
	 */
	$MYSQL_CONN = @DB::setConnectionInfo($MYSQL_HANDLER[1], $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);
	if ( !$MYSQL_CONN )
	{
		$errors[] = _INST_ERROR2;
	}

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
	$result = DB::getResult('SHOW TABLES');
	foreach ( $result as $row )
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
	$queries = fread($fd, filesize($filename));
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

			if ( DB::execute($query) === FALSE )
			{
				$errinfo = DB::getError();
				$errors[] = _INST_ERROR4 . ' (<small>' . $query . '</small>): ' . $errinfo[2];
			}
		}
	}

	/*
	 * 6. put needed records
	 */
	/* push first post */
	$query = "INSERT INTO %s VALUES (1, %s, %s, %s, 1, 1, %s, 0, 0, 0, 1, 0, 1)";
	$query = sprintf($query,
		tableName('nucleus_item'),
		DB::quoteValue(_1ST_POST_TITLE),
		DB::quoteValue(_1ST_POST),
		DB::quoteValue(_1ST_POST2),
		DB::formatDateTime()
	);
	if ( DB::execute($query) === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR4 . ' (<small>' . $query . '</small>): ' . $errinfo[2];
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

	/* push super admin */
	$query = "UPDATE %s SET mname = %s, mrealname = %s, mpassword = %s, memail = %s, murl = %s, madmin = 1, mcanlogin = 1 WHERE mnumber = 1";
	$query = sprintf($query,
		tableName('nucleus_member'),
		DB::quoteValue($param->user_name),
		DB::quoteValue($param->user_realname),
		DB::quoteValue(md5($param->user_password)),
		DB::quoteValue($param->user_email),
		DB::quoteValue($param->IndexURL)
	);
	if ( DB::execute($query) === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR5 . ': ' . $errinfo[2];
	}

	/* push new weblog */
	$query = "UPDATE %s SET bname = %s, bshortname = %s, burl = %s WHERE bnumber = 1";
	$query = sprintf($query,
		tableName('nucleus_blog'),
		DB::quoteValue($param->blog_name),
		DB::quoteValue($param->blog_shortname),
		DB::quoteValue($param->IndexURL)
	);
	if ( DB::execute($query) === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR6 . ': ' . $errinfo[2];
	}

	/* push default category */
	$query = "UPDATE %s SET cname = %s, cdesc = %s WHERE catid = 1";
	$query = sprintf($query,
		tableName('nucleus_category'),
		DB::quoteValue(_GENERALCAT_NAME),
		DB::quoteValue(_GENERALCAT_DESC)
	);
	if ( DB::execute($query) === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR6 . ': ' . $errinfo[2];
	}

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

		$query	= "SELECT sdnumber FROM %s WHERE sdname='admin/default'";
		$query	= sprintf($query, tableName('nucleus_skin_desc'));
		$res	= intval(DB::getValue($query));
		array_merge($errors, updateConfig('AdminSkin', $res));

		$query	= "SELECT sdnumber FROM %s WHERE sdname='admin/bookmarklet'";
		$query	= sprintf($query, tableName('nucleus_skin_desc'));
		$res	= intval(DB::getValue($query));
		array_merge($errors, updateConfig('BookmarkletSkin', $res));

		$query		= "SELECT sdnumber FROM %s WHERE sdname='default'";
		$query		= sprintf($query, tableName('nucleus_skin_desc'));
		$defSkinID	= intval(DB::getValue($query));

		$query = "UPDATE %s SET bdefskin=%d WHERE bnumber=1";
		$query = sprintf($query, tableName('nucleus_blog'), $defSkinID);
		DB::execute($query);
		$query = "UPDATE %s SET value=%d WHERE name='BaseSkin'";
		$query = sprintf($query, tableName('nucleus_config'), $defSkinID);
		DB::execute($query);

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
	$config_data .= "\$MYSQL_HANDLER = array('" . $MYSQL_HANDLER[0] . "','" . $MYSQL_HANDLER[1] . "');\n";
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
			$result = @fwrite($fp, $config_data, i18n::strlen($config_data));
			fclose($fp);
		}
	}

	if ( $result )
	{
		// try to change the read-only permission.
		if ( strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' )
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
		if ( strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' )
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
	global $MYSQL_HANDLER, $minimum_mysql_version, $errors;
	// Turn on output buffer
	// Needed to repress the output of the sql function that are
	// not part of php (in this case the @ operator doesn't work)
	ob_start();

	// note: this piece of code is taken from phpMyAdmin
	$conn = @DB::setConnectionInfo($MYSQL_HANDLER[1], 'localhost', '', '');

	if ( $conn )
	{
		$row = DB::getAttribute(PDO::ATTR_SERVER_VERSION);
		$match = preg_split('#\.#', $row);
	}
	else
	{
		$row = @DB::getRow('SHOW VARIABLES LIKE \'version\'');

		if ( $row )
		{
			$match = preg_split('#\.#', $row[1]);
		}
		else
		{
			$output = (function_exists('shell_exec')) ? @shell_exec('mysql -V') : '0.0.0';
			preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
			$match = preg_split('#\.#', $version[0]);

			if ( $match[0] == '' )
			{
				$match = array('0', '0', '0');
			}
		}
	}

	@DB::disConnect();

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

	$query = sprintf('SELECT * FROM %s', tableName('nucleus_plugin'));
	$res = DB::getResult($query);
	$numCurrent = $res->rowCount();

	foreach ( $aConfPlugsToInstall as $plugName )
	{
		$query = sprintf('INSERT INTO %s (porder, pfile) VALUES (%d, %s)',
			tableName('nucleus_plugin'),
			(++$numCurrent),
			DB::quoteValue($plugName));
		DB::execute($query);

		$manager->clearCachedInfo('installedPlugins');
		$plugin =& $manager->getPlugin($plugName);
		$plugin->setID($numCurrent);

		if ( !$plugin )
		{
			$query = sprintf('DELETE FROM %s WHERE pfile = %s',
				tableName('nucleus_plugin'),
				DB::quoteValue($plugName));
			DB::execute($query);
			$numCurrent--;
			array_push($aErrors, sprintf(_INST_ERROR9, $plugName));
			continue;
		}
		$plugin->install();
	}

	$query = sprintf('DELETE FROM %s', tableName('nucleus_plugin_event'));
	DB::execute($query);
	$query = sprintf('SELECT pid, pfile FROM %s', tableName('nucleus_plugin'));
	$res = DB::getResult($query);

	foreach ( $res as $row )
	{
		$plug =& $manager->getPlugin($row['pfile']);

		if ( $plug )
		{
			$eventList = $plug->getEventList();
			foreach ( $eventList as $eventName )
			{
				$query = sprintf('INSERT INTO %s (pid, event) VALUES (%d, %s)',
					tableName('nucleus_plugin_event'),
					intval($row['pid']),
					DB::quoteValue($eventName));
				DB::execute($query);
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
		'../nucleus/libs/ENTITY.php',
		'../nucleus/libs/globalfunctions.php',
		'../nucleus/libs/i18n.php',
		'../nucleus/libs/ITEM.php',
		'../nucleus/libs/ITEMACTIONS.php',
		'../nucleus/libs/LINK.php',
		'../nucleus/libs/MANAGER.php',
		'../nucleus/libs/MEDIA.php',
		'../nucleus/libs/MEMBER.php',
		'../nucleus/libs/NOTIFICATION.php',
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
		'../nucleus/libs/sql/DB.php',
		'../nucleus/libs/sql/MYSQLPDO.php'
	);

	$count = count($files);
	for ( $i = 0; $i < $count; $i++ )
	{
		if ( !is_readable($files[$i]) )
		{
			array_push($missingfiles, 'File <b>' . $files[$i] . '</b> is missing or not readable.<br />');
		}
	}

	if ( count($missingfiles) > 0 )
	{
		exit(implode("\n", $missingfiles));
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

	$query = "UPDATE %s SET value = %s WHERE name = %s";
	$query = sprintf($query, tableName('nucleus_config'), DB::quoteValue(trim($value)), DB::quoteValue($name));

	if ( DB::execute($query) === FALSE )
	{
		$errinfo = DB::getError();
		$errors[] = _INST_ERROR4 . ': ' . $errinfo[2];
	}
	return $errors;
}
