<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

define('_INSTALL_TEXT_ERROR_CONFIG_EXIST',             'config.phpファイルはすでにあります。再インストールするには、../config.phpを削除する必要があります');
define('_INSTALL_TEXT_ERROR_INSTALLATION_EXPIRED',     'インストール有効期限を経過しました。インストールするには、installフォルダを現在のタイムスタンプでアップロードし直してください。');
define('_INSTALL_TEXT_ERROR_PHP_MINIMUM_REQUIREMENT',  '動作しているPHPのバージョンが古く、必要な最低要件を満たしていません。インストール作業を中止します。PHP %s 以上が使えないかどうか、サーバ管理者に確認して下さい。');
define('_INSTALL_TEXT_ERROR_ROOT_CONFIGFOLDER_NOT_WRITABLE',  'Nucleusのルートフォルダ(../)が書き込み可能になっていません。config.phpファイルを書き込むことができません。');

/*  New for 3.72 */
define('_INSTALL_TEXT_DATABASE_SELECT' ,     'データベースの選択');
define('_INSTALL_TEXT_DATABASE_LOGIN_INFO',	 'データベースのログイン情報');

define('_INSTALL_TEXT_DATABASE_EXSIT',       'すでにデータベースがあります');
define('_INSTALL_TEXT_SETTINGS_NOEXSIT',	 '../settingsフォルダがありません');
define('_INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_1',	'../config.php がすでにあります。');
define('_INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_2',	'セキュリティ上の理由で、存在する場合は、インストールできません。');

define('_INSTALL_TEXT_VERSION',	      'バージョン');
define('_INSTALL_TEXT_SELECT_TEXT',	  'テキストを選択する');
define('_INSTALL_TEXT_EXPERIMENTAL',  '実験的, テスト中, 対応していないプラグインは使用できません');

define('_INST_CONF_ERROR1' , '設定がおかしいです。<a href="./install/index.php">インストール用スクリプト</a>を起動するか、config.phpの設定値を変更して下さい。');

/*  New for 3.71 */
define('_HEADER_LANG_SELECT',			 '表示言語');
define('_TEXT_LANG_SELECT1_1_TAB_HEAD',	 '表示言語の選択');
define('_TEXT_LANG_SELECT1_1_TAB_FIELD1',	'言語');
define('_TEXT_LANG_SELECT1_1',	'表示する言語を選択します。');

/*   */

define('_HEADER1_2',			'キャラクタセット');
define('_TEXT1_2',				'使用するキャラクタセットを選択します。UTF-8を推奨します。');
define('_TEXT1_2_TAB_HEAD',		'キャラクタセットの選択');
define('_TEXT1_2_TAB_FIELD1',	'キャラクタセット');

define('_ERROR1',				'使用中のPHPはMySQLをサポートしていません :(');
define('_ERROR_NO_DBNAME',		'データベース名が見つかりません');
define('_ERROR3',				'｢データベースプリフィックスを使用する｣が選択されていますが、プリフィックスが設定されていません。');
define('_ERROR4',				'プリフィックスに使用できる文字は A-Z、a-z、0-9 と _(アンダーバー)のみです。');
define('_ERROR5',				'URLのいづれかが｢/(スラッシュ)｣で終わっていないか、または機能決定ファイルのURLが｢action.php｣で終わっていません。');
define('_ERROR6',				'管理エリアのディレクトリパスが｢/(スラッシュ)｣で終わっていません。');
define('_ERROR7',				'アップロードしたファイルが格納されるディレクトリパスが｢/(スラッシュ)｣で終わっていません。');
define('_ERROR8',				'テーマファイルのディレクトリパスが｢/(スラッシュ)｣で終わっていません。');
define('_ERROR9',				'管理エリアのディレクトリパスがサーバ上に存在しません。');
define('_ERROR9_2',				'<tt>action.php</tt>ファイルへのURLが別のサーバを指しています。');
define('_ERROR9_3',				'<tt>action.php</tt>ファイルへのURLにファイルが存在しません。');

define('_ERROR10',				'メールアドレスが不正です。');
define('_ERROR11',				'｢表示される名前｣に使用できない文字が含まれています。(使用できる文字：a-z と 0-9、最初と最後以外の空白)');
define('_ERROR12',				'パスワードが入力されていません。');
define('_ERROR13',				'入力された二つのパスワードが一致しません。');
define('_ERROR14',				'｢ブログの短縮名(略称)｣に使用できない文字が含まれています。(使用できる文字：a-z と 0-9。空白は使用できません)');
define('_ERROR15',				'mySQL serverに接続できませんでした。');
define('_ERROR16',				'データベースを作成できませんでした。作成の権限があるかどうか確認してください。SQL エラーの内容');
define('_ERROR17',				'データベースを見つけられませんでした。データベースが存在するか確認してください。');
define('_ERROR18',				'次のクエリの実行中にエラーが発生しました');
define('_ERROR19',				'｢メンバー設定｣の実行中にエラーが発生しました');
define('_ERROR20',				'｢blog設定｣の実行中にエラーが発生しました');
define('_ERROR21',				'次のクエリの実行中にエラーが発生しました');
define('_ERROR22',				'プラグイン「%s」をインストールできませんでした。');
define('_ERROR23_1',			'テーマファイル｢%s｣が読み込めませんでした。');
define('_ERROR23_2',			'ファイルが見つかりません。');
define('_ERROR24',				'テーマ｢%s｣をインポートできませんでした。');
define('_ERROR25_1',			'プログラムのコアファイル <b>');
define('_ERROR25_2',			'</b> が見つからない、もしくは読み出し禁止になっています。');
define('_ERROR26',				'設定の更新中にエラーが発生しました。実行したクエリは次の通りです');
define('_ERROR27',				'エラー！');
define('_ERROR28',				'エラーメッセージは次の通りです');
define('_ERROR29',				'複数のエラーを発見しました');
define('_ERROR30',				'クエリの実行中にエラーが発生しました');

define('_NOTIFICATION1',		'判別不能');

define('_ALT_NUCLEUS_CMS_LOGO',	'Nucleus CMS ロゴ');
define('_TITLE',				'Nucleusのインストール');
define('_TITLE2',				'テーマ・プラグインのインストールエラー');
define('_TITLE3',				'インストールはほぼ完了しました！');
define('_TITLE4',				'インストールは完了しました！');
define('_TITLE5',				'スパムとの戦い');

define('_HEADER1',				'本体のインストール');
define('_TEXT1',				'<p>MySQLテーブルのセットアップと、config.php に入力するための情報を表示します。これをなす為に、いくつかの情報を入力する必要があります。</p><p>すべての欄の入力が必要です。オプション情報は、インストールが完了後Nucleusの管理領域から設定可能です。</p>');

define('_HEADER2',				'PHP のバージョン');
define('_TEXT2',				'<p>以下はあなたのウェブホストにおけるPHPのバージョンです。Nucleusのサポートフォーラムに問題を報告する時は、この情報を書き添えてください。</p>');
define('_TEXT2_WARN1',			' 注意: Nucleusの動作には少なくともバージョン %s が必要です');
define('_TEXT2_WARN2',			'情報: 動作に次のバージョン以降のMySQLが必要です。');
define('_TEXT2_WARN3',			'警告！ 動作しているPHPのバージョンが古く、正常な動作を保証できません。インストール作業を中止します。PHP5以上が使えないかどうか、サーバ管理者に確認して下さい。');

define('_HEADER3',				'config.phpの自動設定');
define('_TEXT3',				'<strong style="color:red;">config.phpへの書き込みができません。</strong>config.phpのパーミッションを<strong>666</strong>にしておけば、スクリプトが自動で設定情報を書き込みます。ただし、Nucleusのインストール完了後、<strong><em style="font-color:#f00;">必ず</em></strong>パーミッションを<strong>444</strong>に変更してください(<a href="../nucleus/documentation/tips.html#filepermissions">パーミッション変更の簡易ガイド</a>)。</p>');

define('_TEXT4',				'<p>データベースのログイン情報を入力してください。この情報が分からない場合は、システム管理者かホスティング元に確認をとってください。ほとんどの場合、ホスト名は｢localhost｣です。もしNucleusがあなたのサーバのPHP設定から｢default MySQL host｣を検出していれば｢ホスト名｣に既に記入されているはずですが、この情報が正確であるという保証はありません。</p>');
define('_TEXT4_TAB_HEAD',		'基本のデータベース設定');
define('_TEXT4_TAB_FIELD1',		'ホスト名');
define('_TEXT4_TAB_FIELD2',		'ユーザー名');
define('_TEXT4_TAB_FIELD3',		'パスワード');
define('_TEXT4_TAB_FIELD4',		'データベース名');
define('_TEXT4_TAB_FIELD4_ADD',	'データベースを作成する必要がある');

define('_TEXT4_TAB2_HEAD',		'高度なデータベース設定');
define('_TEXT4_TAB2_FIELD',		'異なるテーブル・プリフィックスを使用する');
define('_TEXT4_TAB2_ADD',		'<p><strong>通常はここを変更する必要はありません。</strong>ひとつのデータベースに複数のNucleusをインストールしたい場合にこの設定を用います。</p>');

define('_HEADER5',				'ディレクトリとURL');
define('_TEXT5',				'<p>ディレクトリとURLを下記の設定でインストールします。特殊なディレクトリ構成で運用したい場合は、ここで変更できます。ディレクトリのパス及びURLはスラッシュ「/」で閉じてください。</p>');

define('_TEXT5_TAB_HEAD',		'ディレクトリとURL');
define('_TEXT5_TAB_FIELD1',		'サイトの<strong>URL</strong>');
define('_TEXT5_TAB_FIELD2',		'管理エリアの<strong>URL</strong>');
define('_TEXT5_TAB_FIELD3',		'管理エリアの<strong>ディレクトリ</strong>');
define('_TEXT5_TAB_FIELD4',		'アップロードしたファイルが格納される<strong>URL</strong>');
define('_TEXT5_TAB_FIELD5',		'アップロードしたファイルが格納される<strong>ディレクトリ</strong>');
define('_TEXT5_TAB_FIELD6',		'スキンファイルの<strong>URL</strong>');
define('_TEXT5_TAB_FIELD7',		'スキンファイルの<strong>ディレクトリ</strong>');
define('_TEXT5_TAB_FIELD7_2',	'インポートしたスキンで使用するファイル');
define('_TEXT5_TAB_FIELD8',		'プラグインが格納されている<strong>URL</strong>');
define('_TEXT5_TAB_FIELD9',		'機能決定ファイルの<strong>URL</strong>');
define('_TEXT5_TAB_FIELD9_2',	'<tt>action.php</tt>ファイルへのhttp://から始まるURL');
define('_TEXT5_2',				'<p class="note"><strong>付記:</strong> 相対パスではなく<strong>絶対パスを使用してください</strong>。絶対パスはほとんどの場合、<tt>/home/username/public_html/</tt>のようにスラッシュから始まります。よく解らない場合はサーバ管理者に質問してください。</p>');

define('_HEADER6',				'管理権限をもつユーザー');
define('_TEXT6',				'<p>以下に、サイトの最初のユーザーを作成するための情報を入力してください。</p>');
define('_TEXT6_TAB_HEAD',		'サイトの管理者');
define('_TEXT6_TAB_FIELD1',		'表示される名前(ログインID)');
define('_TEXT6_TAB_FIELD1_2',	'使用できる文字：a-z と 0-9、最初と最後以外の空白');
define('_TEXT6_TAB_FIELD2',		'本名(ハンドル名)');
define('_TEXT6_TAB_FIELD3',		'パスワード');
define('_TEXT6_TAB_FIELD4',		'パスワード(確認入力)');
define('_TEXT6_TAB_FIELD5',		'メールアドレス');
define('_TEXT6_TAB_FIELD5_2',	'利用可能なメールアドレスを入れてください');

define('_HEADER7',				'ブログのデータ');
define('_TEXT7',				'<p>デフォルトのブログを作成するための情報を入力してください。このブログの名前は、サイト名としても利用されます。</p>');
define('_TEXT7_TAB_HEAD',		'ブログのデータ');
define('_TEXT7_TAB_FIELD1',		'ブログの名前');
define('_TEXT7_TAB_FIELD2',		'ブログの短縮名(略称)');
define('_TEXT7_TAB_FIELD2_2',	'使用できる文字：a-z と 0-9、空白は不可');

//define('_HEADER8',				'インストールするプラグインとテーマの選択');
define('_TEXT8_TAB_PLUGINDEP', '以下のプラグインに依存します。%s'); //<addsatona date="2008-09-03" />
//define('_TEXT8_TAB_HEADER',		'プラグインの選択');
define('_TEXT8_TAB_HEADER2',	'テーマの選択');

define('_HEADER9',				'データの送信');
define('_TEXT9',				'<p>上に書いてきたデータが正しいか確かめてください。よければデータベース・テーブルと最初のデータを設定するために下のボタンを押してください。少し時間がかかるかもしれませんがご辛抱を。<strong>ボタンをクリックするのは一回だけにしてください。</strong></p>');

define('_TEXT10',				'<p>データベーステーブルの初期値入力が成功しました。後は<i>config.php</i>を書き換えるだけです。以下に書き換えるべき内容を表示します（mysqlのパスワードはマスクされています。ここは実際のものに書き換えてください）</p>');
define('_TEXT11',				'<p>あなたのコンピュータ上のファイルを書き換えたら、FTPを使ってウェブサーバにアップロードしてください。ASCIIモードで送信してファイルを上書きします。</p>');
define('_TEXT12',				'<b>付記:</b> <i>config.php</i>の最初や終わりにスペースを空けないようにしましょう。実行時にエラーを引き起こす原因となります。<br />したがって、config.phpの最初の文字は "&lt;"で最後の文字は"&gt;"としなければなりません。');
define('_TEXT13',				'<p>Nucleusはインストールされ、<code>config.php</code>はアップデートされました。</p><p>セキュリティのため<code>config.php</code>のパーミッションを444に戻すことを忘れないでください(<a href="../nucleus/documentation/tips.html#filepermissions">パーミッション変更の簡易ガイド</a>)。</p>');
define('_TEXT14',				'<p>Nucleusは誰でもブログにコメントを残すことができる様になっているので、このままではスパムの温床になる危険があります。以下の方法によってブログを保護することをお勧めします：</p>');
define('_TEXT14_L1',			'あなたがコメントを必要としないのであれば、管理エリアから｢あなたのブログ｣ &gt; ｢ブログ設定｣ とたどり、 ｢コメントを許可しますか?｣ の設定を｢いいえ｣にすることで、コメント投稿フォームを非表示にすることができます。');
define('_TEXT14_L2',			'スパムを撃退・管理する為のプラグインをインストールすることも可能です：<a href="http://japan.nucleuscms.org/wiki/plugins_by_category#supamutsuru">Nucleus Japan wiki</a> (ブックマークをお勧めします)');
define('_HEADER10',				'インストールファイルの削除');
define('_TEXT15',				'<p>ウェブサーバから /install/ ディレクトリを削除してください：</p>');
define('_TEXT15_L1',			'<b>install/install.sql</b>：テーブルの構造を内包するファイル');
define('_TEXT15_L2',			'<b>install/index.php</b>：このファイル');
//define('_TEXT15_L3',			'<b>install_lang_japanese.php</b>：インストーラの言語ファイル');
define('_TEXT15_L3',			'<b>install/install_lang_*.php</b>：インストーラの言語ファイル');
define('_TEXT15_L4',			'<b>install/*</b>：インストーラの入っているフォルダ');
define('_TEXT16',			'<p>もしこのディレクトリを削除していなければ、管理領域を開くことができません。</p>');

define('_HEADER11',				'ウェブサイトの確認');
define('_TEXT16_H',				'ウェブサイトを使う準備が整いました。');
define('_TEXT16_L1',			'管理領域にログインしてサイトの設定を行う');
define('_TEXT16_L2',			'すぐにサイトへ行ってみる');

define('_TEXT17',				'戻る');

define('_BUTTON1',				'インストールを実行する');

// General category
define('_GENERALCAT_NAME',		'総合');
define('_GENERALCAT_DESC',		'投稿した記事に合うカテゴリが無い時にこのカテゴリを使用すると良いでしょう');
define('_1ST_POST_TITLE',		'Nucleus CMS バージョン%sへようこそ');
define('_1ST_POST',				'これは、最初のページです。そのまま内容を編集して使うことができます。');
define('_1ST_POST2',			'');

define('_CONFIRM_RETRY_SEND_FORM',		'フォームを再送信しますか？');
