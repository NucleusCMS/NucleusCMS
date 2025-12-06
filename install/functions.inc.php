<?php
function get_install_lang_defs()
{
    static $val = null;
    if (is_array($val)) {
        return $val;
    }
    $val = [ // Deprecated a language other than UTF-8
        'en' => ['name' => 'english',  'utf8' => 'english-utf8',  'title' => 'English'],
        'ja' => ['name' => 'japanese', 'utf8' => 'japanese-utf8', 'title' => '日本語 - Japanese'],
        'fr' => ['name' => 'french',   'utf8' => 'french-utf8',  'title' => 'French'],
//        'es' => array('name' => 'spanish',  'utf8'=>'spanish-utf8'  , 'title' => 'Spanish'),
//        'ko' => array('name' => 'korean-utf',  'title' => '한국어 - Korean'),
//        'zh_cn' => array('name' => '',  'title' => '中文 - Chinese simplified'),
//        'zh_tw' => array('name' => 'traditional_chinese' , 'title' => '中文 - Chinese traditional'),
    ];
    foreach (array_keys($val) as $key) {
        if ( ! is_file("./install_lang_{$key}.php")) {
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
    if (('' !== $dirname) && ( ! preg_match('#[\\/]$#', $dirname))) {
        return $dirname . '/';
    }
    return $dirname;
}

function installDefault($key, $default = '')
{
    global $INSTALL_DEFAULTS;

    if (isset($INSTALL_DEFAULTS) && is_array($INSTALL_DEFAULTS) && array_key_exists($key, $INSTALL_DEFAULTS)) {
        return $INSTALL_DEFAULTS[$key];
    }

    return $default;
}

function installDefaultBool($key, $default = false)
{
    $val = installDefault($key, $default);

    return (bool) $val;
}

function ensureInstallWritableDirectory($dir)
{
    if (is_file($dir)) {
        return false;
    }

    if ( ! is_dir($dir)) {
        if ( ! @mkdir($dir, 0o775, true)) {
            return false;
        }
    }

    if (@is_writable($dir)) {
        return true;
    }

    @chmod($dir, 0o775);
    if (@is_writable($dir)) {
        return true;
    }

    @chmod($dir, 0o777);

    return @is_writable($dir);
}

function ensureBladeCacheWritable($adminPath, &$warnings)
{
    $cacheBaseDir  = rtrim($adminPath, '/\\');
    $bladeCacheDir = $cacheBaseDir . '/cache/blade.cache';
    $paths         = [dirname($bladeCacheDir), $bladeCacheDir];

    foreach ($paths as $path) {
        if (ensureInstallWritableDirectory($path)) {
            continue;
        }

        $warnings[] = sprintf(_INSTALL_TEXT_BLADE_CACHE_PERMISSION, $path);

        return;
    }
}

function canWriteConfigFile(&$reason = '')
{
    $configFilename = dirname(__DIR__) . '/config.php';

    if (is_file($configFilename)) {
        if (is_writable($configFilename)) {
            return true;
        }

        $reason = _INSTALL_TEXT_CONFIG_WRITE_REASON_FILE_PERMISSION;
        return false;
    }

    $configDir = dirname($configFilename);

    if ( ! is_dir($configDir) || ! is_writable($configDir)) {
        $reason = _INSTALL_TEXT_CONFIG_WRITE_REASON_FOLDER_PERMISSION;
        return false;
    }

    $tmpFile = @tempnam($configDir, 'ncw');
    if (false === $tmpFile) {
        $reason = _INSTALL_TEXT_CONFIG_WRITE_REASON_FOLDER_PERMISSION;
        return false;
    }

    @unlink($tmpFile);

    return true;
}

function getSiteUrl()
{
    $url = 'http://';
    if ( ! empty($_SERVER['HTTPS']) || ! empty($_SERVER['REDIRECT_HTTPS'])) {
        $url = 'https://';
    }
    $url .= serverVar('HTTP_HOST') . serverVar('PHP_SELF');
    $url = str_replace('install/index.php', '', $url);
    return rtrim($url, '/').'/';
}

/*
 * Add a table prefix if it is used
 *
 * @param 	$unPrefixed
 * 			table name with prefix
 */
function tableName($unPrefixed)
{
    global $mysql_use_prefix, $mysql_prefix;

    if (1 == $mysql_use_prefix) {
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

    if ( ! defined('_INSTALL_TEXT_EXPERIMENTAL')) {
        define('_INSTALL_TEXT_EXPERIMENTAL', 'experimental');
    }

    $ph                          = [];
    $ph['_TITLE']                = _TITLE;
    $ph['_INSTALL_TEXT_VERSION'] = sprintf('%s %s', htmlspecialchars(_INSTALL_TEXT_VERSION, ENT_QUOTES, 'UTF-8'), NUCLEUS_VERSION);
    $ph['_HEADER1']              = sprintf('%s', hsc(_HEADER1));
    $ph['_TEXT1']                = _TEXT1;
    if ( ! @is_writable('../')) {
        $ph['_TEXT1'] .= sprintf('<p class="note">%s</p>', _INSTALL_TEXT_ERROR_ROOT_CONFIGFOLDER_NOT_WRITABLE);
    }
    $ph['lang']                            = $lang;
    $ph['_HEADER_LANG_SELECT']             = _HEADER_LANG_SELECT;
    $ph['_TEXT_LANG_SELECT1_1']            = _TEXT_LANG_SELECT1_1;
    $ph['_TEXT_LANG_SELECT1_1_TAB_HEAD']   = _TEXT_LANG_SELECT1_1_TAB_HEAD;
    $ph['_TEXT_LANG_SELECT1_1_TAB_FIELD1'] = _TEXT_LANG_SELECT1_1_TAB_FIELD1;
    $install_lang_defs                     = get_install_lang_defs();
    $options                               = [];
    foreach ($install_lang_defs as $k => $v) {
        $selected  = (INSTALL_LANG === $k) ? 'selected' : '';
        $options[] = sprintf(
            '<option value="%s" %s>%s</option>',
            $k,
            $selected,
            hsc($v['title'])
        );
    }
    $ph['dispINSTALL_LANG'] = htmlspecialchars($install_lang_defs[INSTALL_LANG]['title']);
    $ph['lang_options']     = implode("\n", $options);
    $ph['_HEADER2']         = _HEADER2;
    $ph['_TEXT2']           = _TEXT2;
    $ph['phpversion']       = sprintf('%s (%s)', phpversion(), php_sapi_name());
    $ph['config_write_warning'] = '';
    $configWriteReason          = '';
    if ( ! canWriteConfigFile($configWriteReason)) {
        $ph['config_write_warning'] = sprintf(
            '<p class="note">%s</p>',
            sprintf(_INSTALL_TEXT_CONFIG_WRITE_WARNING, $configWriteReason)
        );
    }
    if (is_file('../config.php') && ! is_writable('../config.php')) {
        $ph['configPermMsg'] = '<h1>' . _HEADER3 . '</h1>' . _TEXT3;
    } else {
        $ph['configPermMsg'] = '';
    }
    $ph['_INSTALL_TEXT_DATABASE_SELECT'] = _INSTALL_TEXT_DATABASE_SELECT;

    if ( ! defined('_INSTALL_TEXT_NOTE_PLUGIN')) {
        define('_INSTALL_TEXT_NOTE_PLUGIN', 'Note: Unsupported plug-ins cannot be used.');
    }
    $_     = '';
    $radio = [
        'mysql'  => [extension_loaded('pdo_mysql') && ENABLE_MYSQL_INSTALL, 'MySQL/MariaDB'],
        'sqlite' => [extension_loaded('pdo_sqlite') && ENABLE_SQLITE_INSTALL, 'SQLite3(' . _INSTALL_TEXT_EXPERIMENTAL . ')'],
        'pgsql'  => [extension_loaded('pdo_pgsql') && ENABLE_POSTGRESQL_INSTALL, 'PostgreSQL(' . _INSTALL_TEXT_EXPERIMENTAL . ')'],
    ];
    $tabindex = 10020;
    $checked  = 'checked';
    foreach ($radio as $k => $row) {
        $enable = $row[0] ? '' : 'disabled';
        $style  = $row[0] ? '' : 'background-color: lightgray;';
        $_ .= "<div style='line-height: 2em;{$style}'>";
        $_ .= "<input type='radio' id='install_db_type_{$k}' name='install_db_type' {$enable} {$checked} tabindex='{$tabindex}' value='{$k}' onclick='db_change();' />";
        $_ .= "<label for='install_db_type_{$k}'>{$row[1]}</label>";
        $_ .= "</div>";
        $tabindex++;
        if ($row[0]) {
            $checked = '';
        }
    }
    $_ .= '<div class="note">' . _INSTALL_TEXT_NOTE_PLUGIN . '</div>';
    $ph['selDB']                             = $_;
    $ph['_INSTALL_TEXT_DATABASE_LOGIN_INFO'] = _INSTALL_TEXT_DATABASE_LOGIN_INFO;
    $ph['_TEXT4_TAB_HEAD']                   = _TEXT4_TAB_HEAD;
    $ph['_TEXT4_TAB_FIELD4']                 = _TEXT4_TAB_FIELD4;
    $ph['_TEXT4']                            = _TEXT4;
    $ph['_TEXT4_TAB_HEAD']                   = _TEXT4_TAB_HEAD;
    $ph['_TEXT4_TAB_FIELD1']                 = _TEXT4_TAB_FIELD1;
    $ph['install_db_host_value']             = hsc(installDefault('db_host', @ini_get('mysql.default_host')));
    $ph['_TEXT4_TAB_FIELD2']                 = _TEXT4_TAB_FIELD2;
    $ph['install_db_user_value']             = hsc(installDefault('db_user', ''));
    $ph['_TEXT4_TAB_FIELD3']                 = _TEXT4_TAB_FIELD3;
    $ph['install_db_password_value']         = hsc(installDefault('db_password', ''));
    $ph['_TEXT4_TAB_FIELD4']                 = _TEXT4_TAB_FIELD4;
    $ph['install_db_database_value']         = hsc(installDefault('db_database', ''));
    $ph['install_db_create_checked']         = installDefaultBool('db_create') ? 'checked' : '';
    $ph['_TEXT4_TAB_FIELD4_ADD']             = _TEXT4_TAB_FIELD4_ADD;
    $ph['_TEXT4_TAB2_HEAD']                  = _TEXT4_TAB2_HEAD;
    $ph['_TEXT4_TAB2_FIELD']                 = _TEXT4_TAB2_FIELD;
    $ph['install_db_use_prefix_checked']     = installDefaultBool('db_use_prefix') ? 'checked' : '';
    $ph['install_db_tablePrefix_value']      = hsc(installDefault('db_table_prefix', ''));
    $ph['_TEXT4_TAB2_ADD']                   = _TEXT4_TAB2_ADD;
    $ph['_HEADER5']                          = _HEADER5;
    $ph['_TEXT5']                            = _TEXT5;
    $ph['_TEXT5_TAB_HEAD']                   = _TEXT5_TAB_HEAD;
    $ph['_TEXT5_TAB_FIELD1']                 = _TEXT5_TAB_FIELD1;
    $ph['IndexURL_value']                    = hsc(installDefault('index_url', NC_SITE_URL));
    $ph['AdminURL_value']                    = hsc(installDefault('admin_url', NC_SITE_URL . 'nucleus/'));
    $ph['AdminPath_value']                   = hsc(installDefault('admin_path', NC_BASE_PATH . 'nucleus/'));
    $ph['MediaURL_value']                    = hsc(installDefault('media_url', NC_SITE_URL . 'media/'));
    $ph['MediaPath_value']                   = hsc(installDefault('media_path', NC_BASE_PATH . 'media/'));
    $ph['SkinsURL_value']                    = hsc(installDefault('skins_url', NC_SITE_URL . 'skins/'));
    $ph['SkinsPath_value']                   = hsc(installDefault('skins_path', NC_BASE_PATH . 'skins/'));
    $ph['PluginURL_value']                   = hsc(installDefault('plugin_url', NC_SITE_URL . 'nucleus/plugins/'));
    $ph['ActionURL_value']                   = hsc(installDefault('action_url', NC_SITE_URL . 'action.php'));
    $ph['_TEXT5_TAB_FIELD2']                 = _TEXT5_TAB_FIELD2;
    $ph['_TEXT5_TAB_FIELD3']                 = _TEXT5_TAB_FIELD3;
    $ph['_TEXT5_TAB_FIELD4']                 = _TEXT5_TAB_FIELD4;
    $ph['_TEXT5_TAB_FIELD5']                 = _TEXT5_TAB_FIELD5;
    $ph['_TEXT5_TAB_FIELD6']                 = _TEXT5_TAB_FIELD6;
    $ph['_TEXT5_TAB_FIELD7_2']               = _TEXT5_TAB_FIELD7_2;
    $ph['_TEXT5_TAB_FIELD7']                 = _TEXT5_TAB_FIELD7;
    $ph['_TEXT5_TAB_FIELD7_2']               = _TEXT5_TAB_FIELD7_2;
    $ph['_TEXT5_TAB_FIELD8']                 = _TEXT5_TAB_FIELD8;
    $ph['_TEXT5_TAB_FIELD9']                 = _TEXT5_TAB_FIELD9;
    $ph['_TEXT5_TAB_FIELD9_2']               = _TEXT5_TAB_FIELD9_2;
    $ph['_TEXT5_2']                          = _TEXT5_2;
    $ph['_HEADER6']                          = _HEADER6;
    $ph['_TEXT6']                            = _TEXT6;
    $ph['_TEXT6_TAB_HEAD']                   = _TEXT6_TAB_HEAD;
    $ph['_TEXT6_TAB_FIELD1']                 = _TEXT6_TAB_FIELD1;
    $ph['User_name_value']                   = hsc(installDefault('user_name', ''));
    $ph['_TEXT6_TAB_FIELD1_2']               = _TEXT6_TAB_FIELD1_2;
    $ph['_TEXT6_TAB_FIELD2']                 = _TEXT6_TAB_FIELD2;
    $ph['User_realname_value']               = hsc(installDefault('user_realname', ''));
    $ph['_TEXT6_TAB_FIELD3']                 = _TEXT6_TAB_FIELD3;
    $ph['User_password_value']               = hsc(installDefault('user_password', ''));
    $ph['_TEXT6_TAB_FIELD4']                 = _TEXT6_TAB_FIELD4;
    $ph['User_password2_value']              = hsc(installDefault('user_password', ''));
    $ph['_TEXT6_TAB_FIELD5']                 = _TEXT6_TAB_FIELD5;
    $ph['User_email_value']                  = hsc(installDefault('user_email', ''));
    $ph['_TEXT6_TAB_FIELD5_2']               = _TEXT6_TAB_FIELD5_2;
    $ph['_HEADER7']                          = _HEADER7;
    $ph['_TEXT7']                            = _TEXT7;
    $ph['_TEXT7_TAB_HEAD']                   = _TEXT7_TAB_HEAD;
    $ph['_TEXT7_TAB_FIELD1']                 = _TEXT7_TAB_FIELD1;
    $ph['Blog_name_value']                   = hsc(installDefault('blog_name', 'My Nucleus CMS'));
    $ph['_TEXT7_TAB_FIELD2']                 = _TEXT7_TAB_FIELD2;
    $ph['Blog_shortname_value']              = hsc(installDefault('blog_shortname', 'mynucleuscms'));
    $ph['_TEXT7_TAB_FIELD2_2']               = _TEXT7_TAB_FIELD2_2;
    $ph['_HEADER9']                          = _HEADER9;
    $ph['_TEXT9']                            = _TEXT9;
    $ph['_BUTTON1']                          = _BUTTON1;
    $ph['_CONFIRM_RETRY_SEND_FORM']          = _CONFIRM_RETRY_SEND_FORM;
    $tpl                                     = file_get_contents('first.tpl');
    echo parseHtml($tpl, $ph);
}

function treatPathStr($str)
{
    $str = str_replace('\\', '/', $str);
    if ('.php' === substr($str, -4)) {
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
    global $mysql_use_prefix, $mysql_prefix;
    global $lang;

    // 0. put all POST-vars into vars
    $mysql_host          = postVar('install_db_host', installDefault('db_host', 'localhost'));
    $mysql_user          = postVar('install_db_user', installDefault('db_user', 'root'));
    $mysql_password      = postVar('install_db_password', installDefault('db_password', ''));
    $install_db_database = trim((string) postVar('install_db_database', installDefault('db_database', '')));
    $install_db_create   = (int) postVar('install_db_create', installDefaultBool('db_create', 0)) ? 1 : 0;
    $mysql_use_prefix    = (int) postVar('install_db_use_prefix', installDefaultBool('db_use_prefix', 0)) ? 1 : 0;
    $mysql_prefix        = trim((string) postVar('install_db_tablePrefix', installDefault('db_table_prefix', '')));
    $config_indexurl     = postVar('IndexURL', installDefault('index_url', NC_SITE_URL));
    $config_adminurl     = postVar('AdminURL', installDefault('admin_url', NC_SITE_URL . 'nucleus/'));
    $config_adminpath    = postVar('AdminPath', installDefault('admin_path', NC_BASE_PATH . 'nucleus/'));
    $config_mediaurl     = postVar('MediaURL', installDefault('media_url', NC_SITE_URL . 'media/'));
    $config_skinsurl     = postVar('SkinsURL', installDefault('skins_url', NC_SITE_URL . 'skins/'));
    $config_pluginurl    = postVar('PluginURL', installDefault('plugin_url', NC_SITE_URL . 'nucleus/plugins/'));
    $config_actionurl    = postVar('ActionURL', installDefault('action_url', NC_SITE_URL . 'action.php'));
    $config_mediapath    = postVar('MediaPath', installDefault('media_path', NC_BASE_PATH . 'media/'));
    $config_skinspath    = postVar('SkinsPath', installDefault('skins_path', NC_BASE_PATH . 'skins/'));
    $user_name           = postVar('User_name', installDefault('user_name', ''));
    $user_realname       = postVar('User_realname', installDefault('user_realname', ''));
    $user_password       = postVar('User_password', installDefault('user_password', ''));
    $user_password2      = postVar('User_password2', installDefault('user_password', ''));
    $user_email          = postVar('User_email');
    $blog_name           = postVar('Blog_name');
    $blog_shortname      = postVar('Blog_shortname');
    $config_adminemail   = $user_email;
    $config_sitename     = $blog_name;

    $install_db_type = postVar('install_db_type');

    $charset = 'utf8';

    if ('sqlite' === $install_db_type && ENABLE_SQLITE_INSTALL) {
        $install_db_type = 'sqlite';
    } elseif ('pgsql' === $install_db_type && ENABLE_POSTGRESQL_INSTALL) {
        $install_db_type = 'pgsql';
    } elseif ('mysql' === $install_db_type && ENABLE_MYSQL_INSTALL) {
        $install_db_type = 'mysql';
    } else {
        exit('Unkown error. $install_db_type');
    }
    $is_install_mysql  = ('mysql' === $install_db_type);
    $is_install_sqlite = ('sqlite' === $install_db_type);
    $is_install_pgsql  = ('pgsql' === $install_db_type);

    if ('sqlite' === $install_db_type) {
        $mysql_host     = '';
        $mysql_user     = '';
        $mysql_password = '';
    }

    $config_indexurl  = treatPathStr($config_indexurl);
    $config_adminurl  = treatPathStr($config_adminurl);
    $config_mediaurl  = treatPathStr($config_mediaurl);
    $config_skinsurl  = treatPathStr($config_skinsurl);
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

    if (DEBUG_INSTALL_STEPS) {
        global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;
        echo sprintf("PHP version : %s<br>\n", PHP_VERSION);
        echo sprintf("\$DB_DRIVER_NAME : %s<br>\n", $DB_DRIVER_NAME);
        echo sprintf("Step1(Line:%d)", __LINE__);
    }
    // 1. check all the data
    $errors = [];

    if ( ! $install_db_database && ! $is_install_sqlite) {
        array_push($errors, _ERROR_NO_DBNAME);
    }
    if ((1 == $mysql_use_prefix) && (0 == strlen($mysql_prefix))) {
        array_push($errors, _ERROR3);
    }

    if ((1 == $mysql_use_prefix) && ( ! preg_match('#^[a-zA-Z0-9_]+$#', $mysql_prefix))) {
        array_push($errors, _ERROR4);
    }

    $install_db_charset = $charset;
    define('_CHARSET_INSTALL', 'UTF-8');
    if ( ! defined('_CHARSET')) {
        define('_CHARSET', 'UTF-8');
    }
    if ('UTF-8' !== constant('_CHARSET')) {
        exit;
    }

    if ( ! endsWithSlash($config_skinspath)) {
        array_push($errors, _ERROR8);
    }

    if ( ! is_dir($config_adminpath)) {
        array_push($errors, _ERROR9);
    }

    if ( ! _isValidMailAddress($user_email)) {
        array_push($errors, _ERROR10);
    }

    if ( ! _isValidDisplayName($user_name)) {
        array_push($errors, _ERROR11);
    }

    if ( ! $user_password || ! $user_password2) {
        array_push($errors, _ERROR12);
    }

    if ($user_password != $user_password2) {
        array_push($errors, _ERROR13);
    }

    if ( ! _isValidShortName($blog_shortname)) {
        array_push($errors, _ERROR14);
    }

    if (count($errors) > 0) {
        showErrorMessages($errors);
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step2(Line:%d)", __LINE__);
    }
    // 2. try to log in to mySQL
    $db_host = $mysql_host;

    global $DB_PHP_MODULE_NAME, $SQL_DBH, $ORM_CONN;
    $ORM_CONN           = $SQL_DBH = null;
    $DB_PHP_MODULE_NAME = 'pdo';

    if ($is_install_sqlite) {
        global $DB_DRIVER_NAME;
        $DB_DRIVER_NAME      = 'sqlite';
        $sqlite_db_dir       = @realpath(__DIR__ . '/../settings');
        $sqlite_db_name      = $sqlite_db_dir . '/db_nucleus.sqlite';
        $install_db_database = $sqlite_db_name;

        if (( ! $sqlite_db_dir) || ! is_dir($sqlite_db_dir)) {
            $msg = sprintf("<p>not found: %s</p><p>%s</p>", _INSTALL_TEXT_SETTINGS_NOEXSIT, htmlspecialchars($sqlite_db_dir, null, _CHARSET));
            _doError($msg);
            exit;
        }

        if (@is_file($sqlite_db_name)) {
            $fsize = @filesize($sqlite_db_name);
            if ($fsize) {
                $msg = sprintf("<p>%s: %s</p>", _INSTALL_TEXT_DATABASE_EXSIT, htmlspecialchars($sqlite_db_name, null, _CHARSET));
                _doError($msg);
                exit;
            }
        }
        $db_name = $sqlite_db_name;

        $install_db_create = 0;
        $mysql_use_prefix  = 0;
        try {
            $ORM_CONN = @orm_connect_args($db_host, $mysql_user, $mysql_password, $db_name);
            $SQL_DBH  = $ORM_CONN?->getNativeConnection();
        } catch (Exception $exc) {
        }
    }

    if ( ! $is_install_sqlite) {
        try {
            if (empty($install_db_create)) {
                $ORM_CONN = @orm_connect_args($db_host, $mysql_user, $mysql_password, $install_db_database);
            } else {
                // データベースを作成するので、未入力
                $ORM_CONN = @orm_connect_args($db_host, $mysql_user, $mysql_password);
            }
            $SQL_DBH = $ORM_CONN?->getNativeConnection();
        } catch (Exception $exc) {
        }
    }

    if (empty($SQL_DBH)) {
        _doError(_ERROR15 . ': ' . sql_error());
    }

    $DB_HANDLE = $SQL_DBH;

    if ($is_install_sqlite) {
        $DB_HANDLE->beginTransaction(); // sql_query("begin");
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step3(Line:%d)", __LINE__);
    }
    // 3. try to create database (if needed)
    if ($is_install_mysql) {
        $mySqlVer  = sql_get_server_version();
        $collation = 'utf8_general_ci';
        if (version_compare('5.5.0', $mySqlVer, '<=') && ($res = sql_query("SHOW CHARACTER SET LIKE 'utf8mb4'"))) {
            $install_db_charset = 'utf8mb4';
            $collation          = 'utf8mb4_general_ci';
        }

        if (1 == $install_db_create) {
            $sql = "CREATE DATABASE `{$install_db_database}`";
            $sql .= " DEFAULT CHARACTER SET {$install_db_charset} COLLATE {$collation}";
            sql_query($sql) or _doError(_ERROR16 . ': ' . sql_error());
        }
    } elseif ($is_install_pgsql) {
        try {
            if (1 == $install_db_create) {
                getOrmConnection()->createSchemaManager()->createDatabase($install_db_database);
            }
        } catch (Exception $ex) {
            $msg = mb_convert_encoding($ex->getMessage(), 'UTF-8', 'AUTO,UTF-8,SJIS-WIN,EUC-JP');
            $msg = htmlspecialchars($msg, ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED);
            _doError(_ERROR16 . ': ' . $msg);
        }
    }

    if ($is_install_mysql && version_compare($mySqlVer, '5.6.0', '>=')) {
        sql_query("SET SESSION sql_mode = '';");
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step4(Line:%d)", __LINE__);
    }
    // 4. try to select database
    if ($is_install_mysql && ! empty($install_db_create)) {
        sql_select_db($install_db_database, $DB_HANDLE) or _doError(_ERROR17);
    }

    /*
     * 4.5. set character set to this database in MySQL server
     * This processing is added by Nucleus CMS Japanese Package Release Team as of Mar.30, 2011
    */
    if ($is_install_mysql) {
        sql_set_charset($install_db_charset);
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step5(Line:%d)", __LINE__);
    }
    // 5. execute queries
    if ($is_install_sqlite) {
        $queries = file_get_contents('install-sqlite.sql');
        if (0) {
            $queries = [$queries];
        } else {
            $queries = preg_replace("#/\*.*?\*/#ims", '', $queries);
            $queries = preg_split("#(;\n|;\r)#m", $queries);
            for ($i = 0, $iMax = count($queries); $i < $iMax; $i++) {
                if ('END' == strtoupper(trim($queries[$i]))) {
                    $queries[$i - 1] .= ';' .$queries[$i];
                    $queries[$i] = '';
                }
            }
        }
    } elseif ($is_install_pgsql) {
        //        getOrmSchemaManager()->dropDatabase($install_db_database);
        //        getOrmSchemaManager()->createDatabase($install_db_database);

        $queries = @file_get_contents('install-pgsql.sql');
        if (false === $queries) {
            throw  new Exception('install-pgsql.sql');
        }
        $queries = preg_split("#(;\n|;\r)#m", $queries);
    } else { // mysql
        $queries = @file_get_contents('install-mysql.sql');
        if (false === $queries) {
            throw  new Exception('install-mysql.sql');
        }
        $queries = preg_split("#(;\n|;\r)#m", $queries);
    }

    $aTableNames = [
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
        'nucleus_systemlog',
        ];

    $aTableNamesPrefixed = [];
    foreach ($aTableNames as $v) {
        $aTableNamesPrefixed[] = $mysql_prefix . $v;
    }

    $count = count($queries);

    foreach ($queries as $query) {
        $query = trim($query);
        if ($query) {
            //echo "QUERY = \n" . htmlspecialchars($query) . "\n<p>";

            if (1 == $mysql_use_prefix) {
                $query = str_replace($aTableNames, $aTableNamesPrefixed, $query);
            }

            if ($is_install_mysql && 1 != $install_db_create && str_starts_with($query, 'CREATE TABLE')) {
                $query .= " DEFAULT CHARACTER SET {$install_db_charset} COLLATE {$collation}";
            }

            sql_query($query) or _doError(_ERROR30 . ' (' . htmlspecialchars($query, ENT_QUOTES, _CHARSET) . '): ' . sql_error());
        }
    }

    // 5a make first post
    // UTF-8
    $itm_title = sprintf(_1ST_POST_TITLE, NUCLEUS_VERSION_DOT);
    $itm_body  = _1ST_POST;
    $itm_more  = _1ST_POST2;

    $itm_tableName = tableName('nucleus_item');
    $newpost       = "INSERT INTO {$itm_tableName} (`inumber`, `ititle`, `ibody`, `imore`,`iblog`, `iauthor`, `itime`,`iclosed`, `idraft`, `ikarmapos`, `icat`, `ikarmaneg`, `iposted`)"
         . " VALUES (:inumber, :ititle, :ibody, :imore, :iblog, :iauthor, :itime, :iclosed, :idraft, :ikarmapos, :icat, :ikarmaneg, :iposted)";
    //         . " VALUES (1, %s,%s,%s, 1, 1, '2005-08-15 11:04:26', 0, 0, 0, 1, 0, 1)";
    $params = [
        'inumber'   => 1,
        'ititle'    => $itm_title,
        'ibody'     => $itm_body,
        'imore'     => $itm_more,
        'iblog'     => 1,
        'iauthor'   => 1,
        'itime'     => '2005-08-15 11:04:26',
        'iclosed'   => 0,
        'idraft'    => 0,
        'ikarmapos' => 0,
        'icat'      => 1,
        'ikarmaneg' => 0,
        'iposted'   => 1,
    ];
    if ($is_install_pgsql) {
        $newpost = str_replace('`', '"', $newpost);
    }
    sql_prepare_execute($newpost, $params) or _doError(_ERROR18 . ' (' . htmlspecialchars($newpost, ENT_QUOTES, _CHARSET) . '): ' . sql_error());

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step6(Line:%d)", __LINE__);
    }
    // 6. update global settings
    updateConfig('DatabaseVersion', NUCLEUS_DATABASE_VERSION_ID);
    updateConfig('debug', (empty(NUCLEUS_RELEASE_IDENTIFIER) || preg_match('#^p[0-9]*$#', NUCLEUS_RELEASE_IDENTIFIER)) ? 0 : 1);
    updateConfig('IndexURL', $config_indexurl);
    updateConfig('BaseURL', getBaseUrl());
    updateConfig('AdminURL', $config_adminurl);
    updateConfig('MediaURL', $config_mediaurl);
    updateConfig('SkinsURL', $config_skinsurl);
    updateConfig('PluginURL', $config_pluginurl);
    updateConfig('ActionURL', $config_actionurl);
    updateConfig('AdminEmail', $config_adminemail);
    updateConfig('SiteName', $config_sitename);
    updateConfig('CookiePath', getBaseUrl());
    if (isset($_COOKIE['user'])) {
        updateConfig('CookiePrefix', substr(hash('sha256', (string) time()), 0, 6));
    }

    $install_lang_defs = get_install_lang_defs();
    if (isset($install_lang_defs[$lang]['utf8'])) {
        updateConfig('Language', $install_lang_defs[$lang]['utf8']);
    } else {
        _doError('Invalid lang.');
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step7(%d)", __LINE__);
    }
    // 7. update administrator member
    $values = [
        'mname'     => $user_name,
        'mrealname' => $user_realname,
        'mpassword' => md5(addslashes($user_password)),
        'murl'      => $config_indexurl,
        'memail'    => $user_email,
        'madmin'    => '1',
        'mcanlogin' => '1',
        ];
    $set = [];
    foreach (array_keys($values) as $k) {
        $set[] = "$k = :$k";
    }
    $set    = implode(', ', $set);
    $qtable = getOrmConnection()->quoteIdentifier(tableName('nucleus_member'));
    $sql    = "UPDATE {$qtable} SET {$set}"
            . " WHERE mnumber = 1";
    getOrmConnection()->executeStatement($sql, $values) or _doError(_ERROR19 . ': ' . sql_error());

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
    $query    = 'UPDATE ' . tableName('nucleus_category')
        . " SET cname  = '" . $cat_name . "',"
        . " cdesc	  = '" . $cat_desc . "'"
        . " WHERE"
        . " catid	  = '1'";
    //  . " SET cname = '{$cat_name}', cdesc = '{$cat_desc}' WHERE catid = 1");

    sql_query($query) or _doError(_ERROR20 . ': ' . sql_error());

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step9(%d)", __LINE__);
    }
    // 9. update item date
    $query = 'UPDATE ' . tableName('nucleus_item')
            . " SET itime='" . date('Y-m-d H:i:s', time()) ."'"
            . " WHERE inumber=1";

    sql_query($query) or _doError(_ERROR21 . ': ' . sql_error());

    global $aConfPlugsToInstall, $aConfSkinsToImport;
    $aSkinErrors        = [];
    $permissionWarnings = [];
    $aPlugErrors = [];

    if ($is_install_sqlite) {
        $SQL_DBH->commit(); // sql_query("end");
    }
    // close database connection (needs to be closed if we want to include globalfunctions.php)
    sql_close();

    if ((count($aConfPlugsToInstall) > 0) || (count($aConfSkinsToImport) > 0)) {
        if (DEBUG_INSTALL_STEPS) {
            echo sprintf("Step10(%d)", __LINE__);
        }
        // 10. set global variables
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE, $DB_PREFIX;

        $db__use_prefix = $mysql_use_prefix;
        $DB_HOST        = $mysql_host;
        $DB_USER        = $mysql_user;
        $DB_PASSWORD    = $mysql_password;
        $DB_DATABASE    = $install_db_database;
        $DB_PREFIX      = (1 == $db__use_prefix) ? $mysql_prefix : '';

        global $DIR_NUCLEUS, $DIR_MEDIA, $DIR_SKINS, $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;

        $DIR_NUCLEUS = $config_adminpath;
        $DIR_MEDIA   = $config_mediapath;
        $DIR_SKINS   = $config_skinspath;
        $DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
        $DIR_LANG    = $DIR_NUCLEUS . 'language/';
        $DIR_LIBS    = $DIR_NUCLEUS . 'libs/';

        $manager = '';
        include_once($DIR_LIBS . 'globalfunctions.php');

        if (DEBUG_INSTALL_STEPS) {
            echo sprintf("Step11(%d)", __LINE__);
        }
        // 11. install custom skins
        $aSkinErrors = installCustomSkins($manager);
        $defskinQue  = sprintf(
            "SELECT sdnumber as result FROM %s WHERE sdname = 'classic'",
            sql_table('skin_desc')
        );
        $defSkinID   = quickQuery($defskinQue);
        $updateQuery = sprintf(
            "UPDATE %s SET bdefskin = %d WHERE bnumber = 1",
            sql_table('blog'),
            (int) $defSkinID
        );
        sql_query($updateQuery);
        $updateQuery = 'UPDATE ' . sql_table('config') . ' SET value = ' . (int) $defSkinID . " WHERE name = 'BaseSkin'";
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

    $configFilename = dirname(__DIR__) . '/config.php';
    $config_data    = '';
    if ( ! @is_file($configFilename)
        //  || (@is_file($configFilename) && is_writable($configFilename))
    ) {
        global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME, $MYSQL_HANDLER;
        $indent      = str_repeat(' ', 4);
        $config_data = '<' . '?php' . "\n\n";
        $config_data .= "//\$CONF['PHP_BIN'] = '/usr/local/bin/php';\n";
        $config_data .= "\n";
        $config_data .= "//\$CONF['alertOnSecurityRisk'] = 0;\n";
        $config_data .= "//\$CONF['debug']               = 1;\n";
        $config_data .= "\n";
        //$config_data .= "\n"; (extraneous, just added extra \n to previous line
        $config_data .= "// database connection information\n";
        $config_data .= "\$DB_HOST     = '" . $DB_HOST . "';\n";
        $config_data .= "\$DB_USER     = '" . $DB_USER . "';\n";
        $config_data .= "\$DB_PASSWORD = '" . $DB_PASSWORD . "';\n";
        $config_data .= "\$DB_DATABASE = '" . $DB_DATABASE . "';\n";
        $config_data .= "\$DB_PREFIX   = '" . ((1 == $db__use_prefix) ? $DB_PREFIX : '') . "';\n";
        $config_data .= "\n";
        $config_data .= "global \$DB_DRIVER_NAME;\n";

        $config_data .= "// Database driver settings\n";
        $config_data .= "// default is  \$DB_DRIVER_NAME = '{$DB_DRIVER_NAME}';\n";
        $config_data .= "\$DB_DRIVER_NAME = '{$DB_DRIVER_NAME}';\n";
        $config_data .= "\n";
        $config_data .= "// main nucleus directory\n";
        $config_data .= "\$DIR_NUCLEUS = '" . $config_adminpath . "';\n";
        $config_data .= "\n";
        $config_data .= "// path to media dir\n";
        $config_data .= "\$DIR_MEDIA = '" . $config_mediapath . "';\n";
        $config_data .= "\n";
        $config_data .= "// extra skin files for imported skins\n";
        $config_data .= "\$DIR_SKINS = '" . $config_skinspath . "';\n";
        $config_data .= "\n";
        $config_data .= "// these dirs are normally sub dirs of the nucleus dir, but \n";
        $config_data .= "// you can redefine them if you wish\n";
        $config_data .= "\$DIR_PLUGINS = \$DIR_NUCLEUS . 'plugins/';\n";
        $config_data .= "\$DIR_LANG    = \$DIR_NUCLEUS . 'language/';\n";
        $config_data .= "\$DIR_LIBS    = \$DIR_NUCLEUS . 'libs/';\n";
        $config_data .= "\n";
        $config_data .= "// include libs\n";
        $config_data .= "include(\$DIR_LIBS.'globalfunctions.php');\n";

        $result = @file_put_contents($configFilename, $config_data);
        if ($result) {
            if (is_file($configFilename)) {
                @chmod($configFilename, 0o444);
            }
            $bConfigWritten = 1;
        }
        // if you fail to write on Windows, you check this.
        //   check folder permission : open folder property and special permissions, click Properties, and then click the Security tab
        //                             SYSTEM
        //   apache config : DocumentRoot
    }

    ensureBladeCacheWritable($config_adminpath, $permissionWarnings);

    if ( ! defined('_TITLE_CONFIGPHP_MANUAL')) {
        define('_TITLE_CONFIGPHP_MANUAL', 'config.php');
    }
    if ( ! defined('_TEXT_CONFIGPHP_MANUAL')) {
        define('_TEXT_CONFIGPHP_MANUAL', 'config.php could not be created automatically. Copy the contents below into a new config.php file at the Nucleus root.');
    }

    if (DEBUG_INSTALL_STEPS) {
        echo sprintf("Step end(%d)", __LINE__);
    }
    $ph['_TITLE']                = _TITLE;
    $ph['_ALT_NUCLEUS_CMS_LOGO'] = _ALT_NUCLEUS_CMS_LOGO;
    $aAllErrors                  = array_merge($aSkinErrors, $aPlugErrors, $permissionWarnings);
    if (count($aAllErrors) > 0) {
        $ph['_TITLE2']   = '<h1>' . _TITLE2 . '</h1>';
        $ph['AllErrors'] = '<ul><li>' . implode('</li><li>', $aAllErrors) . '</li></ul>';
    } else {
        $ph['_TITLE2'] = $ph['AllErrors'] = '';
    }
    $ph['_TITLE4']         = _TITLE4;
    $ph['_TEXT13']         = _TEXT13;
    $ph['_TITLE5']         = _TITLE5;
    $ph['_TEXT14']         = _TEXT14;
    $ph['_TEXT14_L1']      = _TEXT14_L1;
    $ph['_TEXT14_L2']      = _TEXT14_L2;
    $ph['_HEADER10']       = _HEADER10;
    $ph['_TEXT15']         = _TEXT15;
    $ph['_TEXT15_L1']      = _TEXT15_L1;
    $ph['_TEXT15_L2']      = _TEXT15_L2;
    $ph['_TEXT15_L3']      = _TEXT15_L3;
    $ph['_TEXT15_L4']      = _TEXT15_L4;
    $ph['_TEXT16']         = _TEXT16;
    $ph['_HEADER11']       = _HEADER11;
    $ph['_TEXT16_H']       = _TEXT16_H;
    $ph['config_adminurl'] = $config_adminurl;
    $ph['_TEXT16_L1']      = _TEXT16_L1;
    $ph['config_indexurl'] = $config_indexurl;
    $ph['_TEXT16_L2']      = _TEXT16_L2;

    if ($bConfigWritten) {
        $ph['config_php_manual'] = '';
    } else {
        $ph['config_php_manual'] = sprintf(
            '<h1>%s</h1><p>%s</p><textarea cols="80" rows="25" readonly="readonly" style="width:100%%;">%s</textarea>',
            hsc(_TITLE_CONFIGPHP_MANUAL),
            _TEXT_CONFIGPHP_MANUAL,
            hsc($config_data)
        );
    }

    $tpl = file_get_contents('result.tpl');

    echo parseText($tpl, $ph);
}

/**
 *  Install custom plugins
 */
function installCustomPlugs(&$manager)
{
    global $aConfPlugsToInstall, $DIR_LIBS;

    $aErrors = [];

    if (0 == count($aConfPlugsToInstall)) {
        return $aErrors;
    }

    $res        = sql_query('SELECT * FROM ' . sql_table('plugin'));
    $numCurrent = sql_num_rows($res);

    foreach ($aConfPlugsToInstall as $plugName) {
        // do this before calling getPlugin (in case the plugin id is used there)
        $query = sprintf(
            "INSERT INTO %s (porder, pfile) VALUES (%s, '%s')",
            sql_table('plugin'),
            ++$numCurrent,
            sql_real_escape_string($plugName)
        );
        sql_query($query);

        // get and install the plugin
        $manager->clearCachedInfo('installedPlugins');
        $plugin         = &$manager->getPlugin($plugName);
        $plugin->plugid = $numCurrent;

        if ( ! $plugin) {
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
        $pid  = $o->pid;
        $plug = &$manager->getPlugin($o->pfile);

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

    $aErrors = [];
    global $manager;
    if (empty($manager)) {
        $manager = new MANAGER();
    }

    if (0 == count($aConfSkinsToImport)) {
        return $aErrors;
    }

    // load skinie class
    include_once($DIR_LIBS . 'skinie.php');

    $importer = new SKINIMPORT();

    foreach ($aConfSkinsToImport as $skinName) {
        $importer->reset();
        $skinFile = sprintf('%s%s/skinbackup.xml', $DIR_SKINS, $skinName);
        //  Todo: localize skin file
        //    $skinFile_2 = $DIR_SKINS . $skinName . sprintf("/skinbackup-%s.xml", INSTALL_LANG);
        //    if ((INSTALL_LANG != 'en') && is_file($skinFile_2))
        //        $skinFile = $skinFile_2;

        if ( ! @is_file($skinFile)) {
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
    $missingfiles = [];
    $files        = [
        'install-mysql.sql',
        'install-pgsql.sql',
        'install-sqlite.sql',
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
        '../nucleus/media.php',
        ];

    if (ENABLE_POSTGRESQL_INSTALL) {
    }
    if (ENABLE_SQLITE_INSTALL) {
    }

    $count = count($files);

    for ($i = 0; $i < $count; $i++) {
        if ( ! is_readable($files[$i])) {
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
 * @param $name
 *              name of the config var
 * @param $val
 *              new value of the config var
 */
function updateConfig($name, $val): void
{
    $table = tableName('nucleus_config');
    if ( ! sql_existTableName($table)) {
        _doError(_ERROR26);
    }
    $params = ['name' => $name, 'value' => trim($val)];
    $qtable = sql_quote_identifier($table);
    if (sql_direct_getValue_AsInt("SELECT COUNT(*) FROM {$qtable} WHERE name = :name", ['name' => $name])) {
        $res = getOrmConnection()->executeQuery("UPDATE {$qtable} SET value = :value WHERE name = :name", $params);
    } else {
        $res = getOrmConnection()->executeQuery("INSERT INTO {$qtable} (name, value) VALUES(:name, :value);", $params);
    }
    $res or _doError(_ERROR26 . ': ' . sql_error());
    //return getOrmConnection()->lastInsertId();
}

/**
 * Checks if a string ends with a slash
 *
 * @param $s
 *           string
 */
function endsWithSlash($s)
{
    return (strrpos($s, '/') == strlen($s) - 1);
}

/**
 * Checks if email address is valid
 *
 * @param $address
 *                 address which should be tested
 */
function _isValidMailAddress($address)
{
    $patterns   = [];
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
 *          name which should be tested
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
 *          name which should be tested
 */
function _isValidDisplayName($name)
{
    if (preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9 ]*[a-zA-Z0-9]+$#", $name)) {
        return 1;
    } else {
        return 0;
    }
}

/*
 * Shows error message
 *
 * @param	$msg
 * 			error message
 */
function _doError($msg)
{
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo _TITLE; ?></title>
    <style>@import url('../nucleus/styles/manual.css');</style>
</head>
<body>
    <div style="text-align:center"><img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>" /></div> <!-- Nucleus logo -->
    <h1 class="note" style="text-align: right"><?php @printf('REMOTE_ADDR : [%s]', htmlspecialchars((string) $_SERVER['REMOTE_ADDR'])) ?></h1>
    <h1><?php echo _ERROR27; ?></h1>

    <p><?php echo _ERROR28; ?></p>
    <div style="color: #ff0000; border-color: #c0dcc0; border-style:dotted "><?php echo $msg; ?></div>

    <p><a href="index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a></p>
</body>
</html>

    <?php
    exit;
}

/*
 * Shows error messages
 *
 * @param	$errors
 * 			array with error messages
 */
function showErrorMessages($errors)
{
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo _TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="../nucleus/styles/manual.css">
</head>
<body>
    <div style="text-align:center"><img src="../nucleus/styles/logo.gif" alt="<?php echo _ALT_NUCLEUS_CMS_LOGO; ?>" /></div> <!-- Nucleus logo -->
    <h1 class="note" style="text-align: right"><?php @printf('REMOTE_ADDR : [%s]', htmlspecialchars((string) $_SERVER['REMOTE_ADDR'])) ?></h1>
    <h1><?php echo _ERROR27; ?></h1>

    <p><?php echo _ERROR29; ?>:</p>

    <ul>

    <?php
    while ($msg = array_shift($errors)) {
        echo '<li>' . $msg . '</li>';
    }
    ?>

    </ul>

    <p><a href="index.php" onclick="history.back();return false;"><?php echo _TEXT17; ?></a></p>
</body>
</html>

    <?php
    exit;
}
