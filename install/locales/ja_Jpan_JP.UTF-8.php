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
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id: install_lang_japanese.php 1189 2011-03-28 14:45:08Z sakamocchi $
 */

// header
define('_TITLE',				'Nucleusのインストール');
define('_BODYFONTSTYLE',		'body {
	font-family:Arial,"Helvetica Neue",Helvetica,Meiryo,"Hiragino Kaku Gothic Pro","MS PGothic",sans-serif;
	font-size:100%;
}

#container h2{
	padding:7px 0 3px 35px;
}

.prt .sbt .sbt_sqr,.prt .sbt .sbt_arw{
	letter-spacing:0.2em;
}');

// common
define('_STEP1',				'データベースの確認');
define('_STEP2',				'ブログ設定');
define('_STEP3',				'完了');
define('_MODE1',				'簡易設定');
define('_MODE2',				'詳細設定');
define('_NEXT',					'次へ');
define('_INSTALL',				'インストール');
define('_DEFINED',				'flag');

// locale setting
define('_LOCALE_HEADER',		'あなたのロケールを選択して下さい');
define('_LOCALE_DESC1',			'Nucleus CMSはさまざまなロケールで使うことができるよう作られています。');
define('_LOCALE_DESC2',			'上のセレクトボックスに表示される名前のうち、アスタリスクで始まるものは翻訳が十分ではありません。');
define('_LOCALE_NEED_HELP',		'もし余裕がありましたら、ぜひ翻訳したファイルを送って下さい!');

// database settings
define('_SIMPLE_NAVI1',			'まずデータベースの接続を確認します。MySQLの設定を入力して「次へ」をクリックしてください。<br />詳細な情報を入力して設定する場合は「詳細情報」をクリックしてください。');
define('_DB_HEADER',			'データベース接続');
define('_DB_TEXT1',				'Nucleusになれているなら、詳細設定がおすすめです。');
define('_DB_FIELD1',			'ホスト名');
define('_DB_FIELD1_DESC',		'（通常は localhost）');
define('_DB_FIELD2',			'ユーザー名');
define('_DB_FIELD2_DESC',		'（半角英数 , _ , - ）');
define('_DB_FIELD3',			'パスワード');
define('_DB_FIELD4',			'データベース名');
define('_DB_FIELD4_DESC',		'（半角英数 , _ , - ）');
define('_DB_FIELD5',			'プリフィックス');
define('_DB_FIELD5_DESC',		'通常は空白で結構です');

// blog settings
define('_SIMPLE_NAVI2',			'データベースの接続が確認できました。<br />ブログと管理者の設定をして「次へ」をクリックしてください。');
define('_BLOG_HEADER',			'ブログ設定');
define('_BLOG_FIELD1',			'ブログ名');
define('_BLOG_FIELD2',			'ブログ短縮名');
define('_BLOG_FIELD2_DESC',		'（半角英数）');

// admin settings
define('_ADMIN_HEADER',			'管理者の情報');
define('_ADMIN_FIELD1',			'管理者名');
define('_ADMIN_FIELD2',			'ログインID');
define('_ADMIN_FIELD2_DESC',	'（半角英数）');
define('_ADMIN_FIELD3',			'パスワード');
define('_ADMIN_FIELD4',			'パスワード：確認');
define('_ADMIN_FIELD5',			'メールアドレス');

// url/path settings
define('_PATH_FIELD1',			'サイトのURL');
define('_PATH_FIELD2',			'管理URL');
define('_PATH_FIELD3',			'管理パス');
define('_PATH_FIELD4',			'メディアURL');
define('_PATH_FIELD5',			'メディアパス');
define('_PATH_FIELD6',			'スキンファイルURL');
define('_PATH_FIELD7',			'スキンファイルパス');
define('_PATH_FIELD8',			'プラグインURL');
define('_PATH_FIELD9',			'アクションURL');

// detail
define('_DETAIL_NAVI1',			'すべての項目を入力してください。オプション設定は、インストール完了後Nucleusの管理ページから変更できます。');
define('_DETAIL_HEADER1',		'MySQLのログイン情報');
define('_DETAIL_TEXT1',			'データベースのログイン情報を入力してください。この情報が分からない場合は、システム管理者かホスティング元に確認をとってください。');
define('_DETAIL_HEADER2',		'ディレクトリとURL');
define('_DETAIL_TEXT2',			'ディレクトリとURLを下記の設定でインストールします。特殊なディレクトリ構成で運用したい場合は、ここで変更できます。<br />ディレクトリのパス及びURLはスラッシュ「/」で閉じてください。');
define('_DETAIL_TEXT3',			'Note: パスは相対パスではなく絶対パスを使用してください。');
define('_DETAIL_HEADER3',		'管理権限をもつユーザー');
define('_DETAIL_TEXT4',			'サイトの最初のユーザーを作成するための情報を入力してください。');
define('_DETAIL_HEADER4',		'ブログ設定');
define('_DETAIL_TEXT5',			'デフォルトのブログを作成するための情報を入力してください。このブログの名前は、サイト名としても利用されます。');
define('_DETAIL_TEXT6',			'上に書いてきたデータが正しいか確かめてください。よければデータベース・テーブルと最初のデータを設定するために下のボタンを押してください。少し時間がかかるかもしれませんがご辛抱を。ボタンをクリックするのは一回だけにしてください。');

// install complete
define('_INST_TEXT',			'おめでとうございます。インストールは完了しました！');
define('_INST_HEADER1',			'作成したブログ');
define('_INST_TEXT1',			'さっそく作成した "%s" を見てみましょう。');
define('_INST_BUTTON1',			'ブログへ');
define('_INST_HEADER2',			'管理ページ');
define('_INST_TEXT2',			'デザイン変更、ユーザー追加、カテゴリ設定は管理ページへ。');
define('_INST_BUTTON2',			'管理ページ');
define('_INST_HEADER3',			'ブログの追加');
define('_INST_TEXT3',			'必要であれば、さらにブログを追加できます。');
define('_INST_BUTTON3',			'追加作成');
define('_INST_TEXT4',			'<i>config.php</i>への書き込みが行えませんでした。以下の内容で書き換えてください。');
define('_INST_TEXT5',			'<i>config.php</i>のパーミッションが"<span style="font-weight:bold;">444</span>"であるか確認してください。もし、違うならば"444"に変更してください。');

// errors
define('_DBCONNECT_ERROR',		'MySQL Serverに接続できませんでした。');
define('_DBVERSION_UNKOWN',		'判別不能');
define('_DBVERSION_TOOLOW',		'Nucleusでは少なくともバージョン "%s" 以上のMySQLが必要です。');

define('_VALID_ERROR',			'入力内容に誤りがあります。各セクションのエラーメッセージを確認して入力値を見なおしてください。');
define('_VALID_ERROR1',			'"%s" が入力されていません。');
define('_VALID_ERROR2',			'"%s" に使用できる文字は半角の A-Z、a-z、0-9、_（アンダーライン）、-（ハイフン）のみです。');
define('_VALID_ERROR3',			'"%s" に使用できる文字は半角の A-Z、a-z、0-9、_（アンダーライン）のみです。');
define('_VALID_ERROR4',			'"ブログの短縮名(略称)" に使用できる文字は  A-Z、a-z、0-9（半角英数）のみです。');
define('_VALID_ERROR5',			'"ログインID" に使用できる文字は A-Z、a-z、0-9（半角英数）のみです。ただし、最初と最後以外では半角スペースも使用できます。');
define('_VALID_ERROR6',			'入力された二つのパスワードが一致しません。');
define('_VALID_ERROR7',			'"メールアドレス" が不正です。');
define('_VALID_ERROR8',			'"%s" が"/(スラッシュ)"で終わっていません。');
define('_VALID_ERROR9',			'"%s" のアドレスが"action.php"で終わっていません。');
define('_VALID_ERROR10',		'"%s" のディレクトリパスが"/(スラッシュ)"で終わっていません。');
define('_VALID_ERROR11',		'"%s" のディレクトリパスがサーバ上に存在しません。');

define('_INST_ERROR',			'インストールに失敗しました。以下の原因を解決して再度インストールスクリプトを実行してください。');
define('_INST_ERROR1',			'データベースを作成できませんでした。作成の権限があるかどうか確認してください。');
define('_INST_ERROR2',			'データベースを見つけられませんでした。データベースが存在するか確認してください。');
define('_INST_ERROR3',			'作成しようとしたテーブルが既に存在しています。');
define('_INST_ERROR4',			'クエリの実行中にエラーが発生しました');
define('_INST_ERROR5',			'"メンバー設定" の実行中にエラーが発生しました');
define('_INST_ERROR6',			'"ブログ設定" の実行中にエラーが発生しました');
define('_INST_ERROR7',			'"アイテム設定" の実行中にエラーが発生しました');
define('_INST_ERROR8',			'config.php への書き込みができません。config.php のパーミッションを<span style="font-weight:bold;">666</span>にしておけば、スクリプトが自動で設定情報を書き込みます。(<a href="../nucleus/documentation/tips.html#filepermissions">パーミッション変更の簡易ガイド</a>)。');
define('_INST_ERROR9',			'プラグイン "%s" をインストールできませんでした。');
define('_INST_ERROR10',			'ファイル "%s" が見つかりません。');
define('_INST_ERROR11',			'テーマファイル "%s" が読み込めませんでした。');
define('_INST_ERROR12',			'テーマ "%s" をインポートできませんでした。');


// General category
define('_GENERALCAT_NAME',		'総合');
define('_GENERALCAT_DESC',		'投稿した記事に合うカテゴリが無い時にこのカテゴリを使用すると良いでしょう');
define('_1ST_POST_TITLE',		'Nucleus CMS バージョン4.00 へようこそ');
define('_1ST_POST',				'ウェブサイトの作成を補助する積み木がここにあります。それは心躍るブログになるかもしれませんし、見る人を和ませる家族のサイトになるかもしれませんし、実り多い趣味のサイトになるかもしれません。あるいは現在のあなたには想像がつかないものになることだってあるでしょう。<br />
<br />用途が思いつきませんでしたか？ それならここへ来て正解です。なぜならあなた同様私たちにもわからないのですから。');
define('_1ST_POST2',			'これはサイトにおける最初のエントリーです。スタートを切りやすいように、リンクと情報を入れておきました。<br />
<br />
この記事を削除することもできますが、どちらにせよ記事を追加していくことによってやがてメインページからは見えなくなります。Nucleusを扱ううちに生じたメモをコメントとして追加し、将来アクセスできるようにこのページをブックマークしておくのも手です。<br />
<br />
<b>リンク</b><br />
<br />
Nucleus CMSの<a href="http://nucleuscms.org">本家</a>と<a href="http://japan.nucleuscms.org">日本語公式</a>ページ。<br />
<br />
Nucleus CMSのSourceForge<a href="http://sourceforge.net/projects/nucleuscms/">プロジェクト</a>（<a href="http://sourceforge.jp/projects/nucleus-jp/">日本版</a>）ページ。<br />
<br />
Nucleus CMSの<a href="http://wakka.xiffy.nl/Plugin/">プラグイン倉庫</a>と<a href="http://japan.nucleuscms.org/wiki/plugins">日本語のリスト</a>ページ。<br />
<br />
<b>ドキュメント - <a href="http://docs.nucleuscms.org/">docs.nucleuscms.org</a></b><br />
<br />
Nucleusの<a href="http://japan.nucleuscms.org/faq.php">FAQ（よくある質問集）</a>（<a href="http://nucleuscms.org/faq.php">原文</a>）ページ。<br />
<br />
インストール方法等は<a href="nucleus/documentation/">ユーザー向け</a>と<a href="nucleus/documentation/devdocs/">開発者向け</a>文書がファイルに含まれています。<br />
<br />
ポップアップ<a href="./nucleus/documentation/help.html">ヘルプ</a>が管理エリアのいたるところにあり、サイトのカスタマイズやデザインを手助けしてくれることでしょう。<br />
<br />
一度用意されているドキュメントに目を通したら、<a href="http://wiki.nucleuscms.org/">Wiki</a>（<a href="http://japan.nucleuscms.org/wiki/">日本版</a>）を訪れてください。ユーザーの書いたハウツーや小技が掲載されています。<br />
<br />
<b>サポート</b><br />
<br />
<a href="http://forum.nucleuscms.org/">forum.nucleuscms.org</a>（本家）<br />
<a href="http://japan.nucleuscms.org/bb/">japan.nucleuscms.org/bb/</a>（日本版）<br />
<br />
<a href="http://forum.nucleuscms.org/groupcp.php?g=3">moderators</a>とサポートフォーラムで活動する全てのボランティアに感謝します。<br />
<br />
- <a href="http://edmondhui.homeip.net/blog/">admun</a> - Ottawa, ON, Canada<br />
- <a href="http://www.tamizhan.com/">anand</a> - Bangalore, India<br />
- <a href="http://hcgtv.com">hcgtv</a> - Miami, Florida, USA<br />
- <a href="http://www.adrenalinsports.nl/">ikeizer</a> - Maastricht<br />
- <a href="http://www.tipos.com.br/">moraes</a> - Brazil<br />
- <a href="http://roelg.nl/">roel </a>- The Netherlands<br />
- <a href="http://budts.be/weblog/">TeRanEX </a>- Ekeren, Antwerp, Belgium<br />
- <a href="http://www.trentadams.com/">Trent </a>- Alberta, Canada<br />
- <a href="http://xiffy.nl/weblog/">xiffy </a>- Deventer<br />
<br />
もし手助けが必要なら、1400を超える登録ユーザーのいる私たちのフォーラムに参加してください。23,000を超える投稿された記事を検索できるようになっておりますので、求める答えに数回のクリックでたどり着けるかもしれません。<br />
<br />
<b>カスタマイズ - <a href="http://skins.nucleuscms.org/">skins.nucleuscms.org</a></b><br />
<br />
マルチウェブログとスキン/テンプレートの組み合わせは強力な相乗効果を生み出します。個人的なサイト作成、友人や親戚あるいはクライアントに対するサイトデザインいずれに対してもです。<br />
<br />
636の登録された<a href="http://nucleuscms.org/sites.php">Nucleusで運用されているサイト</a>（<a href="http://japan.nucleuscms.org/sites.php">日本版</a>）の中から特色あるサイトをサンプルとしてご紹介します。<br />
<br />
個人サイト<br />
- <a href="http://bloggard.com/">bloggard.com</a> - The Adventures of Bloggard<br />
- <a href="http://www.yetanotherblog.de/">yetanotherblog.de</a> - Yet Another Blog<br />
<br />
趣味、旅行、ニュースサイト<br />
- <a href="http://adrenalinsports.nl/">adrenalinsports.nl</a> - Extreme sports<br />
- <a href="http://groningen-info.de/">groningen-info.de</a> - Neues aus Groningen. Fr Leute aus Duitsland.<br />
<br />
<b>Nucleus Developer Network - <a href="http://dev.nucleuscms.org/">dev.nucleuscms.org</a></b><br />
<br />
NUDNは、開発者サイトおよびプログラミングリソースのハブです。<br />
<br />
NUDN satellite sites, handles, location and UTC offset:<br />
- <a href="http://karma.nucleuscms.org/">karma</a> - Izegem +02<br />
- <a href="http://edmondhui.homeip.net/blog/">admun</a> - Ottawa -04<br />
- <a href="http://dev.budts.be/nucleus/">TeRanEX</a> - Ekeren +02<br />
<br />
Sourceforge.net には私たちの <a href="http://sourceforge.net/projects/nucleuscms/">SVNリポジトリ</a> をホストをして頂いています。<br />
<br />
遊んだり、テスト更新を行ってみたい場合は、<a href="http://demo.nucleuscms.org/">demo.nucleuscms.org</a>にあるデモサイトを訪れてみてください。<br />
<br />
Not sure what plugins to use, visit the <a href="http://showcase.trentadams.com/">showcase site</a> where you can see plugins at play in their native habitat.<br />
<br />
Then visit the plugin repository at <a href="http://plugins.nucleuscms.org/">plugins.nucleuscms.org</a> for download and installation instructions.<br />
<br />
<b>寄付者一覧</b><br />
<br />
<a href="http://nucleuscms.org/donators.php">素晴らしい人々</a>による<a href="http://nucleuscms.org/donate.php">援助</a>感謝を捧げます。<em>ありがとう！</em><br />
<br />
<b>Nucleus CMS への投票</b><br />
<br />
Nucleusが気に入りましたか？　<a href="http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org">HotScripts</a>や<a href="http://www.opensourcecms.com/index.php?option=content&task=view&id=145">opensourceCMS</a>での投票をお願いします。<br />
<br />
<b>ライセンス</b><br />
<br />
私たちがフリー・ソフトウェアについて口にする場合は自由のことに言及しているのであって、価格のことではありません。私たちの<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public Licenses(一般公有使用許諾書)</a>（<a href="http://www.gnu.org/licenses/gpl.ja.html">日本語訳(参考)</a>と<a href="http://www.atmarkit.co.jp/aig/03linux/gpl.html">概要</a>）は、フリー・ソフトウェアの複製物を自由に頒布できること(そして、望むならこのサービスに対して対価を請求できること)、ソース・コードを実際に受け取るか希望しさえすれば入手することが可能であること、入手したソフトウェアを変更したり新しいフリー・プログラムの一部として使用できること、以上の各内容を行なうことができるということをユーザ自身が知っていることを実現できるようにデザインされています。');
