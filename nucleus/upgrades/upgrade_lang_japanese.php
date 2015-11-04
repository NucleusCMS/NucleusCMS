<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS
 * Copyright (C) 2003-2015 The Nucleus Group　Japan (http://japan.nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group  (http://nucleuscms.org/)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

define('_UPG_TEXT_ALREADY_INSTALLED', 'インストール済みです');
define('_UPG_TEXT_WARN_PHP_IS_OLD',	  '警告：サーバで稼動しているPHPのバージョンが、NucleusCMSの動作保障外の古いバージョンのようです。PHP5以上にアップグレードしてください！');
define('_UPG_TEXT_V035_WARN_PING',	  '注意: バージョン3.50よりNP_Pingに変更があるので、使用中の方は管理画面より再インストールしてください。');
define('_UPG_TEXT_NOTE_PING01',	      'メモ: weblogs.com ping 機能が向上しプラグイン化されました。この機能を有効化するには、プラグインの管理メニューを開き、NP_Ping プラグインをインストールしてください。また NP_Ping は NP_PingPong を置き換えるものです。もしすでに NP_PingPong をインストール済みであれば削除してください。');

define('_UPG_TEXT_ONLY_SUPER_ADMIN',  'Super-admin（最高管理者）のみがアップグレードを実行できます。');
define('_UPG_TEXT_ERROR_NO_UPDATES_TO_EXECUTE',	'エラー! 実行すべきアップデートはありません');
define('_UPG_TEXT_UPGRADE_COMPLETED', 'アップグレード成功');

define('_UPG_TEXT_PLEASE_LOGIN',	  'まずはログインして下さい');
define('_UPG_TEXT_ENTER_YOUR_DATA',	  '下記の情報を入力して下さい');
define('_UPG_TEXT_NAME',			  '名前');
define('_UPG_TEXT_PASSWORD',		  'パスワード');
define('_UPG_TEXT_LOGIN',			  'ログイン');

define('_UPG_TEXT_NUCLEUS_UPGRADE',	  'Nucleus アップグレード');
define('_UPG_TEXT_ERROR_FAILED',	  'エラー!');
define('_UPG_TEXT_ERROR_WAS',		  'メッセージは以下の通り');
define('_UPG_TEXT_BACK',			  '戻る');

define('_UPG_TEXT_EXECUTING_UPGRADES',   'アップグレードの実行');
define('_UPG_TEXT_QUERIES_HAVE_FAILED_01',	 'いくつかのデータベース操作に失敗しました。もし以前にこのアップグレードスクリプトを実行していたのであれば、問題ないと思われます。');
define('_UPG_TEXT_UPGRADE_COMPLETED_TITLE',	'アップグレード完了!');
define('_UPG_TEXT_BACK_TO_OVERVIEW',  '<a href="%s">アップグレード最初のページ</a>にもどる');

define('_UPG_TEXT_FAILURE',             '失敗');
define('_UPG_TEXT_REASON_FOR_FAILURE',  '失敗の理由');
define('_UPG_TEXT_SUCCESS',		        '成功!');


define('_UPG_TEXT_UPGRADE_SCRIPTS',	 'アップグレードスクリプト集');
define('_UPG_TEXT_NOTE01NEW',		 '新規インストールの場合はこれらのスクリプト集は必要ありません。');
define('_UPG_TEXT_NOTE02',			 'Nucleus CMSはバージョンアップごとに、データベースのテーブル構造を少しずつ変えています。このスクリプト集は、古いバージョンの Nucleus からアップグレードする際に必要な、データベーステーブルのアップグレードを行います。');


define('_UPG_TEXT_NO_AUTOMATIC_UPGRADES_REQUIRED', '自動でできるアップグレードはありません。データベースは既に最新の Nucleus 用にアップデートされています。');
define('_UPG_TEXT_WARN_DEPRECATED_PHP4_STOP',	'NucleusはPHP4では動作しません。アップグレード作業を中止して、PHP5以上が使えるかどうか、サーバ管理者に確認して下さい。');

define('_UPG_TEXT_CLICK_HERE_TO_UPGRADE',		'ここをクリックしてデータベースを Nucleus v3.71 用にアップグレードします');

define('_UPG_TEXT_NOTE50_WARNING',        '注意');
define('_UPG_TEXT_NOTE50_MAKE_BACKUP',    '作業中、各ステップごとにデータベースのバックアップを忘れないようにして下さい。');
define('_UPG_TEXT_NOTE50_MANUAL_CHANGES', '手動変更');
define('_UPG_TEXT_NOTE50_MANUAL_CHANGES_01',  'いくつかの変更は手動で行う必要があります。下記にその手順を示します。');
define('_UPG_TEXT_NO_MANUAL_CHANGES_LUCKY_DAY',			 '手動変更は必要ありません。今日はラッキーな日ですね!');

define('_UPG_TEXT_60_INSTALLED',			'インストール済み');
define('_UPG_TEXT_60_NOT_INSTALLED',		'インストールが必要');

define('_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS',	 'Nucleus %s 用に必要な変更');

/*******************/

define('_UPG_TEXT_V096MEDIA',	'メディア機能を使用するために<i>config.php</i>を手動で変更する必要があります。下記の通り追加します');
define('_UPG_TEXT_V096MEDIA02',	'また、ディレクトリもあなた自身の手で作る必要があります。もしファイルのアップロードを可能にしたいのであれば、media/ ディレクトリのパーミッションを777にします。（Nucleus 0.96+ のためのパーミッションの設定に関するクイックガイドが documentation/tips.html にあります）');

define('_UPG_TEXT_V200_01',			 'スキンの取り込み機能を使用するために%sを手動で変更する必要があります。下記の通り追加します');
define('_UPG_TEXT_V200_02',			 'また、ディレクトリもあなた自身の手で作る必要があります。これでダウンロードしたスキンを上記ディレクトリに展開したり、Nucleus 管理画面から取り込んだりできるようになります。');
define('_UPG_TEXT_V200_RSS_RSD',	 'RSS 2.0 と RSD スキン');
define('_UPG_TEXT_V200_04',			 'Nucleus 2.0 を新規にインストールしたとき、RSD(Really Simple Discovery) 用のスキンの他に、RSS 2.0(Really Simple Syndication)用のスキンもまたインストールされます。<code>xml-rss2.php</code> と <code>rsd.php</code> の両ファイルはアップグレードされますが、スキンに関しては手動でインストールする必要があります。<code>upgrade-files</code>の中身をアップロードしたあと、管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから両スキンをインストールすることができます（もしインストールするつもりがなければ、しなくても結構です）。');

define('_UPG_TEXT_V340_01',		'<em>skins</em>ディレクトリと<em>media</em>ディレクトリに「.haccess」を設置して、アクセス制限をかけることが推奨されます。この変更は、Nucleusの機能やセキュリティに直接関係があるわけではありませんが、不正アクセスを防ぐ為の重要な助けになるでしょう。');
define('_UPG_TEXT_V340_02',		'手順は以下の2つのファイルに書いてありますので参考にしてください');

define('_UPG_TEXT_V350_01_IMPORTANT',	'Nucleus 3.51に関する重要なお知らせ');

define('_UPG_TEXT_V366_01',	                    '最新のPHP環境に必要な変更');
define('_UPG_TEXT_V366_02_UPDATE_ACTION_PHP',	'action.phpを更新してください。');

define('_UPG_TEXT_ATOM1_01', 'Nucleus 3.3 から atom feed が 1.0 対応になりましたので、次の手順でスキン・テンプレートのアップグレードをして下さい。');
define('_UPG_TEXT_ATOM1_02', '管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから atom を選択し、読み込みボタンを押して上書きインストールしてください。');
define('_UPG_TEXT_ATOM1_03', 'もし atom のスキンやテンプレートを変更している場合は、既存の内容をファイルに書き出して（skinbackup.xml というファイルが作成されます）、/skins/atom/skinbackup.xml （これが新しいファイル）と比較し、この新しいファイルを更新します。その後、前述の通り管理者画面からスキンの「読込/書出」を開いて同様にして上書きインストールして下さい。');
define('_UPG_TEXT_ATOM1_04', 'Default スキン');
define('_UPG_TEXT_ATOM1_05', 'Nucleus 3.3(2007年5月1日リリース) からいくつかのフォームの CSS が変更になっています。たとえば最初のページのログインフォームや、コメント投稿のためのフォームなど。このためフォームの表示が崩れるので、次の手順でDefault スキンのアップグレードをして下さい。');
define('_UPG_TEXT_ATOM1_06', '管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから default を選択し、読み込みボタンを押して上書きインストールしてください。');
define('_UPG_TEXT_ATOM1_07', 'もし default のスキンやテンプレートを変更している場合は、既存の内容をファイルに書き出して（skinbackup.xml というファイルが作成されます）、/skins/default/skinbackup.xml （これが新しいファイル）と比較し、この新しいファイルを更新します。その後、前述の通り管理者画面からスキンの「読込/書出」を開いて同様にして上書きインストールして下さい。');

