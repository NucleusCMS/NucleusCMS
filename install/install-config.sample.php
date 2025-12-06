<?php

// This setting is only used during installation.
// この設定はインストール時のみ使われます。

// Set a temporary username and password for accessing the installation folder.
// インストールフォルダのアクセスに使用する一時的なユーザー名とパスワードを設定してください。

// BASIC認証が動作しない場合は、IPモードに変更してください

$INSTALL_MODE = 'BASIC'; // IP or BASIC : デフォルト BASIC

$INSTALL_AUTH_USER = ''; // username

$INSTALL_AUTH_PW = '';   // password

$INSTALL_ALLOW_IP = ''; // インストールを許可するIPアドレス

$INSTALL_DEFAULTS = [
    // Database settings
    'db_host'         => '',       // (string) Database host name
    'db_user'         => '',       // (string) Database user name
    'db_password'     => '',       // (string) Database password
    'db_database'     => '',       // (string) Database name
    'db_create'       => false,    // (bool)   Create database if it does not exist
    'db_use_prefix'   => false,    // (bool)   Use a table prefix
    'db_table_prefix' => '',       // (string) Table prefix

    // Path / URL settings
    'index_url'   => '',       // (string) Index page URL
    'admin_url'   => '',       // (string) Admin page URL
    'admin_path'  => '',       // (string) Admin directory path
    'media_url'   => '',       // (string) Media URL
    'media_path'  => '',       // (string) Media directory path
    'skins_url'   => '',       // (string) Skins URL
    'skins_path'  => '',       // (string) Skins directory path
    'plugin_url'  => '',       // (string) Plugin URL
    'action_url'  => '',       // (string) action.php URL

    // Administrator settings
    'user_name'     => '',     // (string) Login name
    'user_realname' => '',     // (string) Display name
    'user_password' => '',     // (string) Password
    'user_email'    => '',     // (string) Email address

    // Blog settings
    'blog_name'      => '',    // (string) Blog title
    'blog_shortname' => '',    // (string) Blog short name
];

/*
$aConfPlugsToInstall = [
//    'NP_SkinFiles',
//    'NP_CKEditor',
//    'NP_CustomURL',
];

// $aConfSkinsToImport = ['atom','rss2.0','rsd','classic'];

*/

//$CONF['PHP_BIN'] = '/usr/local/bin/php';
