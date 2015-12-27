<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS
 * Copyright (C) 2003-2015 The Nucleus Group Japan (http://japan.nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group       (http://nucleuscms.org/)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

// このファイルはサーバ内のディレクトリに対するパスと
// Nucleus CMSの基本機能に関する設定を行います

// MySQLサーバへ接続するための諸設定
$MYSQL_HOST     = 'hostname';
$MYSQL_USER     = 'username';
$MYSQL_PASSWORD = 'password';
$MYSQL_DATABASE = 'databasename';
$MYSQL_PREFIX   = '';

// 3.50で導入された値。第1引数はデータベースハンドラです。第2引数はハンドラで使われるドライバです。
// デフォルト値は以下です。
// $MYSQL_HANDLER = array('mysql','');

//$MYSQL_HANDLER = array('mysql','mysql');
//$MYSQL_HANDLER = array('pdo','mysql');
$MYSQL_HANDLER = array('mysql','');

$DIR_BASE = dirname(__FILE__) . '/';

// サーバコンピュータ内でのコアへのフルパス
$DIR_NUCLEUS = $DIR_BASE . 'nucleus/';
$DIR_NUCLEUS = '/your/path/to/nucleus/';

// サーバコンピュータ内でのメディア用ディレクトリへのフルパス
$DIR_MEDIA = $DIR_BASE . 'media/';
//$DIR_MEDIA = '/your/path/to/media/';

// サーバコンピュータ内でのスキン用ディレクトリへのフルパス
$DIR_SKINS = $DIR_BASE . 'skins/';
$DIR_SKINS = '/your/path/to/skins/';

// プラグイン用ディレクトリ、言語ファイル用ディレクトリ、コアライブラリへのフルパス
// 通常はコアの子ディレクトリとなりますが、任意に設定する事もできます
$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
$DIR_LANG    = $DIR_NUCLEUS . 'language/';
$DIR_LIBS    = $DIR_NUCLEUS . 'libs/';

if(is_file($DIR_LIBS . 'globalfunctions.php')) {
    // コアライブラリのパースをします
    include($DIR_LIBS.'globalfunctions.php');
} else {
	header('Content-type: text/html; charset=utf-8');
	if (in_array('ja',explode(',', @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))))
		echo '設定がおかしいです。<a href="./install/index.php">インストール用スクリプト</a>を起動するか、config.phpの設定値を変更して下さい。';
	else
		echo '<h1>Configuration error</h1> <p>please run the <a href="./install/index.php">install script</a> or modify config.php</p>';
	exit;
}
