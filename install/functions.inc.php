<?php
function get_install_lang_defs()
{
    static $val = null;
    if (is_array($val)) {
        return $val;
    }
    $val = array( // Deprecated a language other than UTF-8
        'en' => array('name' => 'english', 'utf8' => 'english-utf8', 'title' => 'English'),
        'ja' => array('name' => 'japanese', 'utf8' => 'japanese-utf8', 'title' => '日本語 - Japanese'),
//        'fr' => array('name' => 'french',   'utf8'=>'french-utf8'  ,  'title' => 'French'),
//        'es' => array('name' => 'spanish',  'utf8'=>'spanish-utf8'  , 'title' => 'Spanish'),
//        'ko' => array('name' => 'korean-utf',  'title' => '한국어 - Korean'),
//        'zh_cn' => array('name' => '',  'title' => '中文 - Chinese simplified'),
//        'zh_tw' => array('name' => 'traditional_chinese' , 'title' => '中文 - Chinese traditional'),
    );
    foreach (array_keys($val) as $key) {
        if (!is_file("./install_lang_${key}.php")) {
            unset($val[$key]);
        }
    }
    ksort($val);
    return $val;
}

function get_install_lang_keys()
{
    static $val = null;
    if (is_array($val)) {
        return $val;
    }
    $val = array_keys(get_install_lang_defs());
    return $val;
}

function add_last_directory_separator($dirname)
{
    if (($dirname !== '') && (!preg_match('#[\\/]$#', $dirname))) {
        return $dirname . '/';
    }
    return $dirname;
}

function getSiteUrl()
{
    $url = 'http://' . serverVar('HTTP_HOST') . serverVar('PHP_SELF');
    $url = str_replace('install/index.php', '', $url);
    return rtrim($url, '/') . '/';
}

/*
 * Add a table prefix if it is used
 * 
 * @param 	$unPrefixed
 * 			table name with prefix
 */
function tableName($unPrefixed)
{
    global $mysql_usePrefix, $mysql_prefix;

    if ($mysql_usePrefix == 1) {
        return $mysql_prefix . $unPrefixed;
    } else {
        return $unPrefixed;
    }
}

/*
 * Show the form for the installation settings
 */
function showInstallForm()
{
    global $lang;

    doCheckFiles(); // 0. pre check if all necessary files exist

    if (!defined('_INSTALL_TEXT_EXPERIMENTAL')) {
        define('_INSTALL_TEXT_EXPERIMENTAL', 'experimental');
    }

    $ph = array();
    $ph['_TITLE'] = _TITLE;
    $ph['_INSTALL_TEXT_VERSION'] = sprintf('%s %s', htmlspecialchars(_INSTALL_TEXT_VERSION, ENT_QUOTES, 'UTF-8'),
        NUCLEUS_VERSION);
    $ph['_HEADER1'] = sprintf('%s', hsc(_HEADER1));
    $ph['_TEXT1'] = _TEXT1;
    if (!@is_writable('../')) {
        $ph['_TEXT1'] .= sprintf('<p class="note">%s</p>', _INSTALL_TEXT_ERROR_ROOT_CONFIGFOLDER_NOT_WRITABLE);
    }
    $ph['lang'] = $lang;
    $ph['_HEADER_LANG_SELECT'] = _HEADER_LANG_SELECT;
    $ph['_TEXT_LANG_SELECT1_1'] = _TEXT_LANG_SELECT1_1;
    $ph['_TEXT_LANG_SELECT1_1_TAB_HEAD'] = _TEXT_LANG_SELECT1_1_TAB_HEAD;
    $ph['_TEXT_LANG_SELECT1_1_TAB_FIELD1'] = _TEXT_LANG_SELECT1_1_TAB_FIELD1;
    $install_lang_defs = get_install_lang_defs();
    $options = array();
    foreach ($install_lang_defs as $k => $v) {
        $selected = ($k === INSTALL_LANG) ? 'selected' : '';
        $options[] = sprintf('<option value="%s" %s>%s</option>', $k, $selected, hsc($v['title']));
    }
    $ph['dispINSTALL_LANG'] = htmlspecialchars($install_lang_defs[INSTALL_LANG]['title']);
    $ph['lang_options'] = join("\n", $options);
    $ph['_HEADER2'] = _HEADER2;
    $ph['_TEXT2'] = _TEXT2;
    $ph['phpversion'] = phpversion();
    if (is_file('../config.php') && !is_writable('../config.php')) {
        $ph['configPermMsg'] = '<h1>' . _HEADER3 . '</h1>' . _TEXT3;
    } else {
        $ph['configPermMsg'] = '';
    }
    $ph['_INSTALL_TEXT_DATABASE_SELECT'] = _INSTALL_TEXT_DATABASE_SELECT;

    $_ = '';
    if (extension_loaded('pdo_mysql')) {
        $_ .= '<input type="radio" id="install_db_type_mysql" name="install_db_type" tabindex="10020" value="mysql" checked  onclick="db_change();" />';
        $_ .= '<label for="install_db_type_mysql">mysql</label>';
    }
    if (extension_loaded('pdo_sqlite') && ENABLE_SQLITE_INSTALL) {
        $_ .= '<input type="radio" id="install_db_type_sqlite" name="install_db_type" tabindex="10021" value="sqlite" onclick="db_change();" />';
        $_ .= '<label for="install_db_type_sqlite">sqlite(' . _INSTALL_TEXT_EXPERIMENTAL . ')</label>';
    }
    $ph['selDB'] = $_;
    $ph['_INSTALL_TEXT_DATABASE_LOGIN_INFO'] = _INSTALL_TEXT_DATABASE_LOGIN_INFO;
    $ph['_TEXT4_TAB_HEAD'] = _TEXT4_TAB_HEAD;
    $ph['_TEXT4_TAB_FIELD4'] = _TEXT4_TAB_FIELD4;
    $ph['_TEXT4'] = _TEXT4;
    $ph['_TEXT4_TAB_HEAD'] = _TEXT4_TAB_HEAD;
    $ph['_TEXT4_TAB_FIELD1'] = _TEXT4_TAB_FIELD1;
    $ph['install_db_host_value'] = hsc(@ini_get('mysql.default_host'));
    $ph['_TEXT4_TAB_FIELD2'] = _TEXT4_TAB_FIELD2;
    $ph['_TEXT4_TAB_FIELD3'] = _TEXT4_TAB_FIELD3;
    $ph['_TEXT4_TAB_FIELD4'] = _TEXT4_TAB_FIELD4;
    $ph['_TEXT4_TAB_FIELD4_ADD'] = _TEXT4_TAB_FIELD4_ADD;
    $ph['_TEXT4_TAB2_HEAD'] = _TEXT4_TAB2_HEAD;
    $ph['_TEXT4_TAB2_FIELD'] = _TEXT4_TAB2_FIELD;
    $ph['_TEXT4_TAB2_ADD'] = _TEXT4_TAB2_ADD;
    $ph['_HEADER1_2'] = _HEADER1_2;
    $ph['_TEXT1_2'] = _TEXT1_2;
    $ph['_TEXT1_2_TAB_HEAD'] = _TEXT1_2_TAB_HEAD;
    $ph['_TEXT1_2_TAB_FIELD1'] = _TEXT1_2_TAB_FIELD1;
    if (INSTALL_LANG === 'ja' && function_exists('mb_convert_encoding') && ENABLE_INSTALL_LANG_EUCJP) {
        $ph['euc_option'] = '<option value="ujis" >EUC-JP</option>';
    } else {
        $ph['euc_option'] = '';
    }
    $ph['_HEADER5'] = _HEADER5;
    $ph['_TEXT5'] = _TEXT5;
    $ph['_TEXT5_TAB_HEAD'] = _TEXT5_TAB_HEAD;
    $ph['_TEXT5_TAB_FIELD1'] = _TEXT5_TAB_FIELD1;
    $ph['NC_SITE_URL'] = NC_SITE_URL;
    $ph['NC_BASE_PATH'] = NC_BASE_PATH;
    $ph['_TEXT5_TAB_FIELD2'] = _TEXT5_TAB_FIELD2;
    $ph['NC_SITE_URL'] = NC_SITE_URL;
    $ph['_TEXT5_TAB_FIELD3'] = _TEXT5_TAB_FIELD3;
    $ph['_TEXT5_TAB_FIELD4'] = _TEXT5_TAB_FIELD4;
    $ph['_TEXT5_TAB_FIELD5'] = _TEXT5_TAB_FIELD5;
    $ph['_TEXT5_TAB_FIELD6'] = _TEXT5_TAB_FIELD6;
    $ph['_TEXT5_TAB_FIELD7_2'] = _TEXT5_TAB_FIELD7_2;
    $ph['_TEXT5_TAB_FIELD7'] = _TEXT5_TAB_FIELD7;
    $ph['_TEXT5_TAB_FIELD7_2'] = _TEXT5_TAB_FIELD7_2;
    $ph['_TEXT5_TAB_FIELD8'] = _TEXT5_TAB_FIELD8;
    $ph['_TEXT5_TAB_FIELD9'] = _TEXT5_TAB_FIELD9;
    $ph['_TEXT5_TAB_FIELD9_2'] = _TEXT5_TAB_FIELD9_2;
    $ph['_TEXT5_2'] = _TEXT5_2;
    $ph['_HEADER6'] = _HEADER6;
    $ph['_TEXT6'] = _TEXT6;
    $ph['_TEXT6_TAB_HEAD'] = _TEXT6_TAB_HEAD;
    $ph['_TEXT6_TAB_FIELD1'] = _TEXT6_TAB_FIELD1;
    $ph['_TEXT6_TAB_FIELD1_2'] = _TEXT6_TAB_FIELD1_2;
    $ph['_TEXT6_TAB_FIELD2'] = _TEXT6_TAB_FIELD2;
    $ph['_TEXT6_TAB_FIELD3'] = _TEXT6_TAB_FIELD3;
    $ph['_TEXT6_TAB_FIELD4'] = _TEXT6_TAB_FIELD4;
    $ph['_TEXT6_TAB_FIELD5'] = _TEXT6_TAB_FIELD5;
    $ph['_TEXT6_TAB_FIELD5_2'] = _TEXT6_TAB_FIELD5_2;
    $ph['_HEADER7'] = _HEADER7;
    $ph['_TEXT7'] = _TEXT7;
    $ph['_TEXT7_TAB_HEAD'] = _TEXT7_TAB_HEAD;
    $ph['_TEXT7_TAB_FIELD1'] = _TEXT7_TAB_FIELD1;
    $ph['_TEXT7_TAB_FIELD2'] = _TEXT7_TAB_FIELD2;
    $ph['_TEXT7_TAB_FIELD2_2'] = _TEXT7_TAB_FIELD2_2;
    $ph['_HEADER9'] = _HEADER9;
    $ph['_TEXT9'] = _TEXT9;
    $ph['_BUTTON1'] = _BUTTON1;
    $tpl = file_get_contents('first.tpl');
    echo parseText($tpl, $ph);
}

function treatPathStr($str)
{
    $str = str_replace('\\', '/', $str);
    if (substr($str, -4) === '.php') {
        return $str;
    } else {
        return rtrim($str, '/') . '/';
    }
}

/*
 * The installation process itself
 */
function doInstall()
{
    global $mysql_usePrefix, $mysql_prefix;
    global $lang;

    // 0. put all POST-vars into vars
    $mysql_host = postVar('install_db_host');
    $mysql_user = postVar('install_db_user');
    $mysql_password = postVar('install_db_password');
    $mysql_database = postVar('install_db_database');
    $mysql_create = postVar('install_db_create');
    $mysql_usePrefix = postVar('install_db_usePrefix');
    $mysql_prefix = postVar('install_db_tablePrefix');
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
    $charset = strtolower(postVar('charset'));
    $config_adminemail = $user_email;
    $config_sitename = $blog_name;

    $install_db_type = postVar('install_db_type');

    if ($install_db_type != 'sqlite' || !ENABLE_SQLITE_INSTALL) {
        $install_db_type = 'mysql';
    }
    $is_install_mysql = ($install_db_type == 'mysql');
    $is_install_sqlite = ($install_db_type == 'sqlite');
    if (!$is_install_mysql) {
        $charset = 'utf8';
    }

    $config_indexurl = treatPathStr($config_indexurl);
    $config_adminurl = treatPathStr($config_adminurl);
    $config_mediaurl = treatPathStr($config_mediaurl);
    $config_skinsurl = treatPathStr($config_skinsurl);
    $config_pluginurl = treatPathStr($config_pluginurl);
    $config_actionurl = treatPathStr($config_actionurl);
    $config_adminpath = treatPathStr($config_adminpath);
    $config_skinspath = treatPathStr($config_skinspath);
    $config_mediapath = treatPathStr($config_mediapath);

    /**
     * Include and initialize multibyte functions as a replacement for mbstring extension
     *  if mbstring extension is not loaded.
     * Jan.28, 2011. Japanese Package Release Team
     */
    if (function_exists('date_default_timezone_set')) {
        @date_default_timezone_set((function_exists('date_default_timezone_get')) ? @date_default_timezone_get() : 'UTC');
    }

    // 1. check all the data
    $errors = array();

    if (!$mysql_database && !$is_install_sqlite) {
        array_push($errors, _ERROR_NO_DBNAME);
    }
    if (($mysql_usePrefix == 1) && (strlen($mysql_prefix) == 0)) {
        array_push($errors, _ERROR3);
    }

    if (($mysql_usePrefix == 1) && (!preg_match('#^[a-zA-Z0-9_]+$#', $mysql_prefix))) {
        array_push($errors, _ERROR4);
    }

    if (!function_exists('mb_convert_encoding') && $charset != 'latin1') {
        $charset = 'utf8';
    }

    if (!defined('_CHARSET')) {
        define('_CHARSET', 'UTF-8');
    }

    $install_db_charset = $charset;
    switch ($install_db_charset) {
        case 'latin1':
            define('_CHARSET_INSTALL', 'iso-8859-1');
            break;
        case 'ujis':
            if (ENABLE_INSTALL_LANG_EUCJP) {
                define('_CHARSET_INSTALL', 'EUC-JP');
            } else {
                $install_db_charset = 'utf8';
                define('_CHARSET_INSTALL', 'UTF-8');
            }
            break;
        default :
            $charset = 'utf8';
            define('_CHARSET_INSTALL', 'UTF-8');
    }
    $charset = 'utf8';

    if (!endsWithSlash($config_skinspath)) {
        array_push($errors, _ERROR8);
    }

    if (!is_dir($config_adminpath)) {
        array_push($errors, _ERROR9);
    }

    if (!_isValidMailAddress($user_email)) {
        array_push($errors, _ERROR10);
    }

    if (!_isValidDisplayName($user_name)) {
        array_push($errors, _ERROR11);
    }

    if (!$user_password || !$user_password2) {
        array_push($errors, _ERROR12);
    }

    if ($user_password != $user_password2) {
        array_push($errors, _ERROR13);
    }

    if (!_isValidShortName($blog_shortname)) {
        array_push($errors, _ERROR14);
    }

    if (sizeof($errors) > 0) {
        showErrorMessages($errors);
    }

    // 2. try to log in to mySQL
    $db_host = $mysql_host;

    global $DB_PHP_MODULE_NAME, $SQL_DBH, $MYSQL_CONN;
    // this will need to be changed if we ever allow
    if ($is_install_sqlite) {
        global $DB_DRIVER_NAME;
        $DB_DRIVER_NAME = 'sqlite';
        $sqlite_db_dir = @realpath(dirname(__FILE__) . '/../settings');
        $sqlite_db_name = $sqlite_db_dir . '/db_nucleus.sqlite';
        $mysql_database = $sqlite_db_name;

        if ((!$sqlite_db_dir) || !is_dir($sqlite_db_dir)) {
            $msg = sprintf("<p>not found: %s</p><p>%s</p>", _INSTALL_TEXT_SETTINGS_NOEXSIT,
                htmlspecialchars($sqlite_db_dir, null, _CHARSET));
            _doError($msg);
            exit;
        }

        if (@is_file($sqlite_db_name)) {
            $fsize = @filesize($sqlite_db_name);
            if ($fsize) {
                $msg = sprintf("<p>%s: %s</p>", _INSTALL_TEXT_DATABASE_EXSIT,
                    htmlspecialchars($sqlite_db_name, null, _CHARSET));
                _doError($msg);
                exit;
            }
        }
        $db_name = $sqlite_db_name;

//			if (is_file('../config.php') || is_file('../config-custum.php'))
//			{
//				$msg = sprintf("<p>%s</p><p>%s</p>", _INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_1 , _INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_2 );
//				KaguyaInstaller::doError ( $msg );
//				exit;
//			}

        $mysql_create = 0;
        $mysql_usePrefix = 0;
        $MYSQL_CONN = @sql_connect_args($db_host, $mysql_user, $mysql_password, $db_name);
        $SQL_DBH = $MYSQL_CONN;
        $DB_PHP_MODULE_NAME == 'pdo';
//            var_dump($MYSQL_CONN);
    }

    if ($is_install_mysql) {
        $MYSQL_CONN = @sql_connect_args($db_host, $mysql_user, $mysql_password);
    }

    if ($MYSQL_CONN == false) {
        _doError(_ERROR15 . ': ' . sql_error());
    }

    $DB_HANDLE = $MYSQL_CONN;
    if ($DB_PHP_MODULE_NAME == 'pdo') {
        $SQL_DBH = $MYSQL_CONN;
        $MYSQL_CONN = 0;
    }
//var_dump($SQL_DBH, $DB_HANDLE);
    if ($is_install_sqlite) {
        $DB_HANDLE->beginTransaction();
    } // sql_query("begin");


    // 3. try to create database (if needed)
    if ($is_install_mysql) {
        $mySqlVer = sql_get_server_version();
        switch (strtolower($install_db_charset)) {
            case 'ujis':
                $collation = 'ujis_japanese_ci';
                break;
            case 'latin1':
                $collation = 'latin1_swedish_ci';
                break;
            case 'utf8':
            default:
                $collation = 'utf8_general_ci';
                if (version_compare('5.5.0', $mySqlVer,
                        '<=') && ($res = sql_query("SHOW CHARACTER SET LIKE 'utf8mb4'"))) {
                    $install_db_charset = 'utf8mb4';
                    $collation = 'utf8mb4_general_ci';
                }
        }

        if ($mysql_create == 1) {
            $sql = "CREATE DATABASE `{$mysql_database}`";
            $sql .= " DEFAULT CHARACTER SET {$install_db_charset} COLLATE {$collation}";
            sql_query($sql) or _doError(_ERROR16 . ': ' . sql_error());
        }
    }

    // 4. try to select database
    if ($is_install_mysql) {
        sql_select_db($mysql_database, $DB_HANDLE) or _doError(_ERROR17);
    }

    /*
     * 4.5. set character set to this database in MySQL server
     * This processing is added by Nucleus CMS Japanese Package Release Team as of Mar.30, 2011
    */
    if ($is_install_mysql) {
        sql_set_charset('utf8'); // Don't localized
    }

    // 5. execute queries
    if ($is_install_sqlite) {
        $queries = file_get_contents('install-sqlite.sql');
        if (0) {
            $queries = array($queries);
        } else {
            $queries = preg_replace("#/\*.*?\*/#ims", '', $queries);
            $queries = preg_split("#(;\n|;\r)#m", $queries);
            for ($i = 0; $i < count($queries); $i++) {
                if (strtoupper(trim($queries[$i])) == 'END') {
                    $queries[$i - 1] .= ';' . $queries[$i];
                    $queries[$i] = '';
                }
            }
        }
    } else { // mysql
        $queries = file_get_contents('install-mysql.sql');
        $queries = preg_split("#(;\n|;\r)#m", $queries);
    }

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
        'nucleus_tickets',
        'nucleus_cached_data',
        'nucleus_systemlog'
    );

    $aTableNamesPrefixed = array();
    foreach ($aTableNames as $v) {
        $aTableNamesPrefixed[] = $mysql_prefix . $v;
    }

    $count = count($queries);

    foreach ($queries as $query) {
        $query = trim($query);
        if ($query) {
//		 echo "QUERY = \n" . htmlspecialchars($query) . "\n<p>";

            if ($mysql_usePrefix == 1) {
                $query = str_replace($aTableNames, $aTableNamesPrefixed, $query);
            }

            if ($is_install_mysql && $mysql_create != 1 && strpos($query, 'CREATE TABLE') === 0) {
                $query .= " DEFAULT CHARACTER SET {$install_db_charset} COLLATE {$collation}";
            }

            sql_query($query) or _doError(_ERROR30 . ' (' . htmlspecialchars($query, ENT_QUOTES,
                    _CHARSET) . '): ' . sql_error());
        }
    }

    // 5a make first post
    // UTF-8
    $itm_title = sprintf(_1ST_POST_TITLE, NUCLEUS_VERSION);
    $itm_body = _1ST_POST;
    $itm_more = _1ST_POST2;

    $newpost = "INSERT INTO "
        . tableName('nucleus_item')
        . ' (`inumber`, `ititle`, `ibody`, `imore`,'
        . '`iblog`, `iauthor`, `itime`,'
        . '`iclosed`, `idraft`, `ikarmapos`, `icat`, `ikarmaneg`, `iposted`)'
        . " VALUES ("
        . "1, "
        . sql_quote_string($itm_title) . ","
        . sql_quote_string($itm_body) . ","
        . sql_quote_string($itm_more) . ","
        . " 1, 1, '2005-08-15 11:04:26', 0, 0, 0, 1, 0, 1);";
    sql_query($newpost) or _doError(_ERROR18 . ' (' . htmlspecialchars($newpost, ENT_QUOTES,
            _CHARSET) . '): ' . sql_error());

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step6(%d)", __LINE__);
    }
    // 6. update global settings
    updateConfig('IndexURL', $config_indexurl);
    updateConfig('AdminURL', $config_adminurl);
    updateConfig('MediaURL', $config_mediaurl);
    updateConfig('SkinsURL', $config_skinsurl);
    updateConfig('PluginURL', $config_pluginurl);
    updateConfig('ActionURL', $config_actionurl);
    updateConfig('AdminEmail', $config_adminemail);
    updateConfig('SiteName', $config_sitename);

    $install_lang_defs = get_install_lang_defs();
    if (($install_db_charset == 'utf8') || ($install_db_charset == 'utf8mb4')) {
        if (isset($install_lang_defs[$lang]['utf8'])) {
            updateConfig('Language', $install_lang_defs[$lang]['utf8']);
        } else {
            updateConfig('Language', $install_lang_defs[$lang]['name']);
        }
    } else {
        if ($install_db_charset == 'latin1') {
            updateConfig('Language', 'english');
        } else {
            if ($install_db_charset == 'ujis') {
                updateConfig('Language', 'japanese-euc');
            } else {
                updateConfig('Language', 'english-utf8');
            }
        }
    }


    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step7(%d)", __LINE__);
    }
    // 7. update GOD member
    $query = 'UPDATE ' . tableName('nucleus_member')
        . " SET mname='" . sql_real_escape_string($user_name) . "',"
        . " mrealname='" . sql_real_escape_string($user_realname) . "',"
        . " mpassword='" . md5(addslashes($user_password)) . "',"
        . " murl='" . sql_real_escape_string($config_indexurl) . "',"
        . " memail='" . sql_real_escape_string($user_email) . "',"
        . " madmin=1,"
        . " mcanlogin=1"
        . " WHERE mnumber=1";

    sql_query($query) or _doError(_ERROR19 . ': ' . sql_error());

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step8(%d)", __LINE__);
    }
    // 8. update weblog settings
    $query = 'UPDATE ' . tableName('nucleus_blog')
        . " SET bname='" . sql_real_escape_string($blog_name) . "',"
        . " bshortname='" . sql_real_escape_string($blog_shortname) . "',"
        . " burl='" . sql_real_escape_string($config_indexurl) . "'"
        . " WHERE bnumber=1";

    sql_query($query) or _doError(_ERROR20 . ': ' . sql_error());

    // 8-2. update category settings
    $cat_name = sql_real_escape_string(defined('_GENERALCAT_NAME') ? _GENERALCAT_NAME : 'general');
    $cat_desc = sql_real_escape_string(defined('_GENERALCAT_DESC') ? _GENERALCAT_DESC : '');
    $query = 'UPDATE ' . tableName('nucleus_category')
        . " SET cname  = '" . $cat_name . "',"
        . " cdesc	  = '" . $cat_desc . "'"
        . " WHERE"
        . " catid	  = 1";
//     . " SET cname = '${cat_name}', cdesc = '${cat_desc}' WHERE catid = 1");

    sql_query($query) or _doError(_ERROR20 . ': ' . sql_error());

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step9(%d)", __LINE__);
    }
    // 9. update item date
    $query = 'UPDATE ' . tableName('nucleus_item')
        . " SET itime='" . date('Y-m-d H:i:s', time()) . "'"
        . " WHERE inumber=1";

    sql_query($query) or _doError(_ERROR21 . ': ' . sql_error());

    global $aConfPlugsToInstall, $aConfSkinsToImport;
    $aSkinErrors = array();
    $aPlugErrors = array();

    if ($is_install_sqlite) {
        $SQL_DBH->commit();
    } // sql_query("end");
    // close database connection (needs to be closed if we want to include globalfunctions.php)
    sql_close();

    if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0)) {
        if (DEBUG_INSTALL_STEPS) {
            echo sprintf("Step10(%d)", __LINE__);
        }
        // 10. set global variables
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE, $DB_PREFIX;

        $DB_HOST = $mysql_host;
        $DB_USER = $mysql_user;
        $DB_PASSWORD = $mysql_password;
        $DB_DATABASE = $mysql_database;
        $DB_PREFIX = ($mysql_usePrefix == 1) ? $mysql_prefix : '';

        global $DIR_NUCLEUS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;

        $DIR_NUCLEUS = $config_adminpath;
        $DIR_MEDIA = $config_mediapath;
        $DIR_SKINS = $config_skinspath;
        $DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
        $DIR_LANG = $DIR_NUCLEUS . 'language/';
        $DIR_LIBS = $DIR_NUCLEUS . 'libs/';

        $manager = '';
        include_once($DIR_LIBS . 'globalfunctions.php');

        if (DEBUG_INSTALL_STEPS) {
            echo sprintf("Step11(%d)", __LINE__);
        }
        // 11. install custom skins
        $aSkinErrors = installCustomSkins($manager);
        $defskinQue = 'SELECT `sdnumber` as result FROM ' . sql_table('skin_desc') . ' WHERE `sdname` = "default"';
        $defSkinID = quickQuery($defskinQue);
        $updateQuery = 'UPDATE ' . sql_table('blog') . ' SET `bdefskin` = ' . intval($defSkinID) . ' WHERE `bnumber` = 1';
        sql_query($updateQuery);
        $updateQuery = 'UPDATE ' . sql_table('config') . ' SET `value` = ' . intval($defSkinID) . ' WHERE `name` = "BaseSkin"';
        sql_query($updateQuery);

        if (DEBUG_INSTALL_STEPS) {
            echo sprintf("<br />Step13(%d): Start: install custom plugins<br />", __LINE__);
        }
        // 13. install custom plugins
        $aPlugErrors = installCustomPlugs($manager);
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step14(%d)", __LINE__);
    }
    // 14. Write config file ourselves (if possible)
    $bConfigWritten = 0;

    $configFilename = dirname(dirname(__FILE__)) . '/config.php';
    if (!@is_file($configFilename)
//      || (@is_file($configFilename) && is_writable($configFilename))
    ) {
        global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME, $MYSQL_HANDLER;
        $config_data = '<' . '?php' . "\n\n";
        //$config_data .= "\n"; (extraneous, just added extra \n to previous line
        $config_data .= "	// database connection information\n";
        $config_data .= "	\$MYSQL_HOST = '" . $mysql_host . "';\n";
        $config_data .= "	\$MYSQL_USER = '" . $mysql_user . "';\n";
        $config_data .= "	\$MYSQL_PASSWORD = '" . $mysql_password . "';\n";
        $config_data .= "	\$MYSQL_DATABASE = '" . $mysql_database . "';\n";
        $config_data .= "	\$MYSQL_PREFIX = '" . (($mysql_usePrefix == 1) ? $mysql_prefix : '') . "';\n";
        $config_data .= "	// new in 3.50. first element is db handler, the second is the db driver used by the handler\n";
        $config_data .= "	// default is \$MYSQL_HANDLER = array('mysql','');\n";
        $config_data .= "	//\$MYSQL_HANDLER = array('mysql','mysql');\n";
        $config_data .= "	//\$MYSQL_HANDLER = array('pdo','mysql');\n";
        $config_data .= "	\$MYSQL_HANDLER = array('" . $MYSQL_HANDLER[0] . "','" . $MYSQL_HANDLER[1] . "');\n";
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

        $result = @file_put_contents($configFilename, $config_data);
        if ($result) {
            if (is_file($configFilename)) {
                @chmod($configFilename, 0444);
            }
            $bConfigWritten = 1;
        }
        // if you fail to write on Windows, you check this.
        //   check folder permission : open folder property and special permissions, click Properties, and then click the Security tab
        //                             SYSTEM
        //   apache config : DocumentRoot
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step end(%d)", __LINE__);
    }
    $ph['_TITLE'] = _TITLE;
    $ph['_ALT_NUCLEUS_CMS_LOGO'] = _ALT_NUCLEUS_CMS_LOGO;
    $aAllErrors = array_merge($aSkinErrors, $aPlugErrors);
    if (count($aAllErrors) > 0) {
        $ph['_TITLE2'] = '<h1>' . _TITLE2 . '</h1>';
        $ph['AllErrors'] = '<ul><li>' . implode('</li><li>', $aAllErrors) . '</li></ul>';
    } else {
        $ph['_TITLE2'] = $ph['AllErrors'] = '';
    }
    $ph['_TITLE4'] = _TITLE4;
    $ph['_TEXT13'] = _TEXT13;
    $ph['_TITLE5'] = _TITLE5;
    $ph['_TEXT14'] = _TEXT14;
    $ph['_TEXT14_L1'] = _TEXT14_L1;
    $ph['_TEXT14_L2'] = _TEXT14_L2;
    $ph['_HEADER10'] = _HEADER10;
    $ph['_TEXT15'] = _TEXT15;
    $ph['_TEXT15_L1'] = _TEXT15_L1;
    $ph['_TEXT15_L2'] = _TEXT15_L2;
    $ph['_TEXT15_L3'] = _TEXT15_L3;
    $ph['_TEXT15_L4'] = _TEXT15_L4;
    $ph['_TEXT16'] = _TEXT16;
    $ph['_HEADER11'] = _HEADER11;
    $ph['_TEXT16_H'] = _TEXT16_H;
    $ph['config_adminurl'] = $config_adminurl;
    $ph['_TEXT16_L1'] = _TEXT16_L1;
    $ph['config_indexurl'] = $config_indexurl;
    $ph['_TEXT16_L2'] = _TEXT16_L2;

    $tpl = file_get_contents('result.tpl');

    echo parseText($tpl, $ph);
}

/**
 *  Install custom plugins
 */
function installCustomPlugs(&$manager)
{
    global $aConfPlugsToInstall, $DIR_LIBS;

    $aErrors = array();

    if (count($aConfPlugsToInstall) == 0) {
        return $aErrors;
    }

    $res = sql_query('SELECT * FROM ' . sql_table('plugin'));
    $numCurrent = sql_num_rows($res);

    foreach ($aConfPlugsToInstall as $plugName) {
        // do this before calling getPlugin (in case the plugin id is used there)
        $query = 'INSERT INTO ' . sql_table('plugin') . ' (porder, pfile) VALUES (' . (++$numCurrent) . ', "' . sql_real_escape_string($plugName) . '")';
        sql_query($query);

        // get and install the plugin
        $manager->clearCachedInfo('installedPlugins');
        $plugin =& $manager->getPlugin($plugName);
        $plugin->plugid = $numCurrent;

        if (!$plugin) {
            sql_query('DELETE FROM ' . sql_table('plugin') . ' WHERE pfile=\'' . sql_real_escape_string($plugName) . '\'');
            $numCurrent--;
            array_push($aErrors, _ERROR22 . $plugName);
            continue;
        }

        $plugin->install();
    }

    // SYNC PLUGIN EVENT LIST
    sql_query('DELETE FROM ' . sql_table('plugin_event'));

    // loop over all installed plugins
    $res = sql_query('SELECT pid, pfile FROM ' . sql_table('plugin'));

    while ($o = sql_fetch_object($res)) {
        $pid = $o->pid;
        $plug =& $manager->getPlugin($o->pfile);

        if ($plug) {
            $eventList = $plug->_getEventList();

            foreach ($eventList as $eventName) {
                sql_query('INSERT INTO ' . sql_table('plugin_event') . ' (pid, event) VALUES (' . $pid . ', \'' . $eventName . '\')');
            }
        }
    }

    return $aErrors;
}

/**
 *  Install custom skins
 *  Prepares the installation of custom skins
 */
function installCustomSkins(&$manager)
{
    global $aConfSkinsToImport, $DIR_LIBS, $DIR_SKINS;

    $aErrors = array();
    global $manager;
    if (empty($manager)) {
        $manager = new MANAGER;
    }

    if (count($aConfSkinsToImport) == 0) {
        return $aErrors;
    }

    // load skinie class
    include_once($DIR_LIBS . 'skinie.php');

    $importer = new SKINIMPORT();

    foreach ($aConfSkinsToImport as $skinName) {
        $importer->reset();
        $skinFile = $DIR_SKINS . $skinName . '/skinbackup.xml';
//      Todo: localize skin file
//		$skinFile_2 = $DIR_SKINS . $skinName . sprintf("/skinbackup-%s.xml", INSTALL_LANG);
//		if ((INSTALL_LANG != 'en') && is_file($skinFile_2))
//			$skinFile = $skinFile_2;

        if (!@file_exists($skinFile)) {
            array_push($aErrors, _ERROR23_1 . $skinFile . ' : ' . _ERROR23_2);
            continue;
        }

        $error = $importer->readFile($skinFile);

        if ($error) {
            array_push($aErrors, _ERROR24 . $skinName . ' : ' . $error);
            continue;
        }

        $error = $importer->writeToDatabase(1);

        if ($error) {
            array_push($aErrors, _ERROR24 . $skinName . ' : ' . $error);
            continue;
        }
    }

    return $aErrors;
}

/**
 *  Check if some important files of the Nucleus CMS installation are available
 *  Give an error if one or more files are not accessible
 */
function doCheckFiles()
{
    $missingfiles = array();
    $files = array(
        'install-mysql.sql',
//		'install-sqlite.sql',
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

    if (ENABLE_SQLITE_INSTALL) {
        $files[] = 'install-sqlite.sql';
    }

    $count = count($files);

    for ($i = 0; $i < $count; $i++) {
        if (!is_readable($files[$i])) {
            array_push($missingfiles, _ERROR25_1 . $files[$i] . _ERROR25_2);
        }
    }

    if (count($missingfiles) > 0) {
        showErrorMessages($missingfiles);
    }
}

/**
 *  Updates the configuration in the database
 *
 * @param    $name
 *            name of the config var
 * @param    $val
 *            new value of the config var
 */
function updateConfig($name, $val)
{
    $query = sprintf("UPDATE %s SET value='%s' WHERE name='%s'",
        tableName('nucleus_config'),
        sql_real_escape_string(trim($val)),
        sql_real_escape_string($name));

    sql_query($query) or _doError(_ERROR26 . ': ' . sql_error());
    return sql_insert_id();
}

/**
 * Checks if a string ends with a slash
 *
 * @param    $s
 *            string
 */
function endsWithSlash($s)
{
    return (strrpos($s, '/') == strlen($s) - 1);
}

/**
 * Checks if email address is valid
 *
 * @param    $address
 *            address which should be tested
 */
function _isValidMailAddress($address)
{
    $patterns = array();
    $patterns[] = "#^[a-zA-Z0-9\._-]+@+[A-Za-z0-9\._-]+\.+[A-Za-z]{2,4}$#";
    $patterns[] = "#^[a-zA-Z0-9\._-]+@localhost$#";
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $address)) {
            return 1;
        }
    }
    return 0;
}

/*
 * Check if short blog names and nicknames are allowed
 * Returns true if the given string is a valid shortname
 * logic: only letters and numbers are allowed, no spaces allowed
 * 
 * @param	$name
 * 			name which should be tested	
 */
function _isValidShortName($name)
{
    if (preg_match("#^[a-zA-Z0-9]+$#", $name)) {
        return 1;
    } else {
        return 0;
    }
}

/*
 * Check if a display name is allowed
 * Returns true if the given string is a valid display name
 * 
 * @param	$name
 * 			name which should be tested	
 */
function _isValidDisplayName($name)
{
    if (preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9 ]*[a-zA-Z0-9]+$#", $name)) {
        return 1;
    } else {
        return 0;
    }
}
