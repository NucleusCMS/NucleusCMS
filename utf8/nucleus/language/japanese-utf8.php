<?php
// Japanese (UTF-8) Nucleus Language File
// 
// Author: chrome (chrome@cgi.no-ip.org)
// Modified by: Osamu Higuchi (osamu@higuchi.com)
// Nucleus version: v1.0-v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// Note for Japanese users
// このファイルは Nucleus の UTF-8 版日本語ランゲージファイルです。
// ファイル名を japanese.php に変更してから、Nucleus の language ディレクトリに
// 置いてください。

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Please use the \'Update Subscription list\'-button to update the plugin\'s subscription list.');
define('_LIST_PLUGS_DEP',			'Plugin(s) requires:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'コメントのリスト：');
define('_NOCOMMENTS_BLOG',			'このblogにはまだコメントがつけられていません');
define('_BLOGLIST_COMMENTS',		'コメント');
define('_BLOGLIST_TT_COMMENTS',		'このblogにつけられたコメントのリスト');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'日');
define('_ARCHIVETYPE_MONTH',		'月');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Invalid or expired ticket.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin installation failed, requires ');
define('_ERROR_DELREQPLUGIN',		'Plugin deletion failed, required by ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie プレフィックス');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'認証用リンクを送信できません。あなたのログインは許可されていないからです。');
define('_ERROR_ACTIVATE',			'認証キーは存在しないか、無効か、あるいは期限切れです。');
define('_ACTIONLOG_ACTIVATIONLINK', '認証用リンクが送信されました');
define('_MSG_ACTIVATION_SENT',		'認証用リンクがメールで送られました。');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"こんにちは <%memberName%>\n\n<%siteName%> (<%siteUrl%>)におけるアカウントを有効にしなければなりません。\n次のリンクを訪れることによりそれが可能になります：\n\n\t<%activationUrl%>\n\n二日以内にこれを行ってください。それを過ぎれば、認証用リンクは無効になります。");
define('_ACTIVATE_REGISTER_MAILTITLE',	"アカウント'<%memberName%>'の認証");
define('_ACTIVATE_REGISTER_TITLE',	'ようこそ <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'アカウント作成はほぼ完了しました。下のフォームでアカウントのパスワードを設定してください。');
define('_ACTIVATE_FORGOT_MAIL',		"こんにちは <%memberName%>\n\n下のリンクから、この<%siteName%> (<%siteUrl%>)におけるアカウントの新しいパスワードを設定することができます。\n\n\t<%activationUrl%>\n\n二日以内にこれを行ってください。それを過ぎれば、認証用リンクは無効になります。");
define('_ACTIVATE_FORGOT_MAILTITLE',"アカウント'<%memberName%>'の再認証");
define('_ACTIVATE_FORGOT_TITLE',	'ようこそ <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'下のフォームでアカウントの新しいパスワードが設定できます。');
define('_ACTIVATE_CHANGE_MAIL',		"こんにちは <%memberName%>\n\nメールアドレスが変更されたので、<%siteName%> (<%siteUrl%>)におけるアカウントを再認証する必要があります。\次のリンクを訪れることによりそれが可能になります：\n\n\t<%activationUrl%>\n\n二日以内にこれを行ってください。それを過ぎれば、認証用リンクは無効になります。");
define('_ACTIVATE_CHANGE_MAILTITLE',"アカウント'<%memberName%>'の再認証");
define('_ACTIVATE_CHANGE_TITLE',	'ようこそ <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'メールアドレスの変更が確認されました。ありがとう！');
define('_ACTIVATE_SUCCESS_TITLE',	'認証に成功しました');
define('_ACTIVATE_SUCCESS_TEXT',	'アカウントを有効にすることに成功しました。');
define('_MEMBERS_SETPWD',			'パスワードを設定する');
define('_MEMBERS_SETPWD_BTN',		'パスワードを設定');
define('_QMENU_ACTIVATE',			'アカウントの認証');
define('_QMENU_ACTIVATE_TEXT',		'<p>アカウントを有効にすれば、<a href="index.php?action=showlogin">ログイン</a>することにより利用できます。</p>');

define('_PLUGS_BTN_UPDATE',			'登録リストのアップデート');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascriptツールバーのスタイル');
define('_SETTINGS_JSTOOLBAR_FULL',	'フル・ツールバー(IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','シンプル・ツールバー(IE以外)');
define('_SETTINGS_JSTOOLBAR_NONE',	'ツールバーを使わない');
define('_SETTINGS_URLMODE_HELP',	'(参考：<a href="documentation/tips.html#searchengines-fancyurls">fancy URLを有効にする方法</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'プラグインによる追加設定');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'著者:');
define('_LIST_ITEM_DATE',			'日付:');
define('_LIST_ITEM_TIME',			'時間:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(メンバー)');

// batch operations
define('_BATCH_WITH_SEL',			'選択されたものを：');
define('_BATCH_EXEC',				'実行');

// quickmenu
define('_QMENU_HOME',				'管理ホーム');
define('_QMENU_ADD',				'アイテム追加');
define('_QMENU_ADD_SELECT',			'- blog選択 -');
define('_QMENU_USER_SETTINGS',		'あなたの設定');
define('_QMENU_USER_ITEMS',			'あなたのアイテム');
define('_QMENU_USER_COMMENTS',		'あなたのコメント');
define('_QMENU_MANAGE',				'サイト管理');
define('_QMENU_MANAGE_LOG',			'管理操作履歴');
define('_QMENU_MANAGE_SETTINGS',	'グローバル設定');
define('_QMENU_MANAGE_MEMBERS',		'メンバー管理');
define('_QMENU_MANAGE_NEWBLOG',		'新規Blog作成');
define('_QMENU_MANAGE_BACKUPS',		'DB保存/復元');
define('_QMENU_MANAGE_PLUGINS',		'プラグイン管理');
define('_QMENU_LAYOUT',				'レイアウト設定');
define('_QMENU_LAYOUT_SKINS',		'スキン編集');
define('_QMENU_LAYOUT_TEMPL',		'テンプレート編集');
define('_QMENU_LAYOUT_IEXPORT',		'読込/書出');
define('_QMENU_PLUGINS',			'プラグイン');

// quickmenu on logon screen
define('_QMENU_INTRO',				'導入ガイド');
define('_QMENU_INTRO_TEXT',			'<p>ここはウェブサイトの管理を行うコンテンツ管理システム、「Nucleus CMS」のログイン画面です。</p><p>アカウントを持っていればログインして記事の新規投稿ができます。</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'このプラグイン用のヘルプファイルが見つかりません');
define('_PLUGS_HELP_TITLE',			'プラグインのヘルプページ');
define('_LIST_PLUGS_HELP', 			'ヘルプ');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Enable External Authentication');
define('_WARNING_EXTAUTH',			'Warning: Enable only if needed.');

// member profile
define('_MEMBERS_BYPASS',			'Use External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>常に</em>検索対象にする');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'表示');
define('_MEDIA_VIEW_TT',			'ファイル表示 (新しいウィンドウが開きます)');
define('_MEDIA_FILTER_APPLY',		'フィルター適応');
define('_MEDIA_FILTER_LABEL',		'フィルター: ');
define('_MEDIA_UPLOAD_TO',			'アップロード先...');
define('_MEDIA_UPLOAD_NEW',			'新規アップロード...');
define('_MEDIA_COLLECTION_SELECT',	'選択');
define('_MEDIA_COLLECTION_TT',		'このカテゴリーに切り替え');
define('_MEDIA_COLLECTION_LABEL',	'現在のコレクション: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'左寄せ');
define('_ADD_ALIGNRIGHT_TT',		'右寄せ');
define('_ADD_ALIGNCENTER_TT',		'中央寄せ');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'アップロードに失敗しました');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'過去の日時での投稿を許可する');
define('_ADD_CHANGEDATE',			'タイムスタンプを更新');
define('_BMLET_CHANGEDATE',			'タイムスタンプを更新');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'読込/書出');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'ノーマル');
define('_PARSER_INCMODE_SKINDIR',	'skindirを使う');
define('_SKIN_INCLUDE_MODE',		'Include モード');
define('_SKIN_INCLUDE_PREFIX',		'Include プリフィックス');

// global settings
define('_SETTINGS_BASESKIN',		'基本のスキン');
define('_SETTINGS_SKINSURL',		'スキンURL');
define('_SETTINGS_ACTIONSURL',		'action.php へのフルURL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'defaultカテゴリーは移動できません');
define('_ERROR_MOVETOSELF',			'カテゴリーを移動できません (移動先のBlogが移動元と同じです)');
define('_MOVECAT_TITLE',			'カテゴリーを移動するBlogを選択してください');
define('_MOVECAT_BTN',				'カテゴリーを移動');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL モード');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'対象が選択されていません');
define('_BATCH_ITEMS',				'アイテム　　　に対してのバッチ操作');
define('_BATCH_CATEGORIES',			'カテゴリー　　に対してのバッチ操作');
define('_BATCH_MEMBERS',			'メンバー　　　に対してのバッチ操作');
define('_BATCH_TEAM',				'チームメンバーに対してのバッチ操作');
define('_BATCH_COMMENTS',			'コメント　　　に対してのバッチ操作');
define('_BATCH_UNKNOWN',			'未知のバッチ操作: ');
define('_BATCH_EXECUTING',			'実行中');
define('_BATCH_ONCATEGORY',			'- 対象カテゴリー');
define('_BATCH_ONITEM',				'- 対象アイテム');
define('_BATCH_ONCOMMENT',			'- 対象コメント');
define('_BATCH_ONMEMBER',			'- 対象メンバー');
define('_BATCH_ONTEAM',				'- 対象チームメンバー');
define('_BATCH_SUCCESS',			'成功!');
define('_BATCH_DONE',				'終了!');
define('_BATCH_DELETE_CONFIRM',		'バッチ削除の確認');
define('_BATCH_DELETE_CONFIRM_BTN',	'バッチ削除の確認');
define('_BATCH_SELECTALL',			'全て選択');
define('_BATCH_DESELECTALL',		'全ての選択を解除');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'削除');
define('_BATCH_ITEM_MOVE',			'移動');
define('_BATCH_MEMBER_DELETE',		'削除');
define('_BATCH_MEMBER_SET_ADM',		'管理者権限を与える');
define('_BATCH_MEMBER_UNSET_ADM',	'管理者権限を外す');
define('_BATCH_TEAM_DELETE',		'チームから削除');
define('_BATCH_TEAM_SET_ADM',		'管理者権限を与える');
define('_BATCH_TEAM_UNSET_ADM',		'管理者権限を外す');
define('_BATCH_CAT_DELETE',			'削除');
define('_BATCH_CAT_MOVE',			'他のBlogに移動');
define('_BATCH_COMMENT_DELETE',		'削除');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'新しいアイテムの追加...');
define('_ADD_PLUGIN_EXTRAS',		'追加プラグインオプション');

// errors
define('_ERROR_CATCREATEFAIL',		'新しいカテゴリーを作成できません');
define('_ERROR_NUCLEUSVERSIONREQ',	'このプラグインは新しいバージョンの Nucleus が必要です: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Blogの設定に戻る');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'読み込み');
define('_SKINIE_TITLE_EXPORT',		'書き出し');
define('_SKINIE_BTN_IMPORT',		'読み込み');
define('_SKINIE_BTN_EXPORT',		'選択されたスキン/テンプレートを書き出し');
define('_SKINIE_LOCAL',				'ローカルファイルから読み込み:');
define('_SKINIE_NOCANDIDATES',		'skinsディレクトリ内に読み込めるファイルがありません');
define('_SKINIE_FROMURL',			'URLを指定して読み込み:');
define('_SKINIE_EXPORT_INTRO',		'書き出すスキン/テンプレートを以下から選択してください');
define('_SKINIE_EXPORT_SKINS',		'スキン');
define('_SKINIE_EXPORT_TEMPLATES',	'テンプレート');
define('_SKINIE_EXPORT_EXTRA',		'追加情報');
define('_SKINIE_CONFIRM_OVERWRITE',	'既に存在するスキンを上書きする (ぶつかるスキン名を参照)');
define('_SKINIE_CONFIRM_IMPORT',	'はい、これを読み込みます');
define('_SKINIE_CONFIRM_TITLE',		'スキンとテンプレートを読み込もうとしています');
define('_SKINIE_INFO_SKINS',		'ファイル内のスキン:');
define('_SKINIE_INFO_TEMPLATES',	'ファイル内のテンプレート:');
define('_SKINIE_INFO_GENERAL',		'情報:');
define('_SKINIE_INFO_SKINCLASH',	'次のスキン名がぶつかります:');
define('_SKINIE_INFO_TEMPLCLASH',	'次のテンプレート名がぶつかります:');
define('_SKINIE_INFO_IMPORTEDSKINS','読み込まれたスキン:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','読み込まれたテンプレート:');
define('_SKINIE_DONE',				'読み込み完了');

define('_AND',						'and');
define('_OR',						'or');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'無し(クリックで編集)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Includeモード:');
define('_LIST_SKINS_INCPREFIX',		'Include Prefix:');
define('_LIST_SKINS_DEFINED',		'定義済みパーツ:');

// backup
define('_BACKUPS_TITLE',			'バックアップ / リストア');
define('_BACKUP_TITLE',				'バックアップ');
define('_BACKUP_INTRO',				'下のボタンを押すとあなたの Nucleus データベースをバックアップします。バックアップファイルは安全な場所に保存しておくことをお勧めします。');
define('_BACKUP_ZIP_YES',			'圧縮する');
define('_BACKUP_ZIP_NO',			'圧縮しない');
define('_BACKUP_BTN',				'バックアップを作成する');
define('_BACKUP_NOTE',				'<b>注意:</b> バックアップされるのはデータベースの内容だけです。メディアファイルや config.php 内の設定はバックアップ<b>されません</b>。');
define('_RESTORE_TITLE',			'リストア');
define('_RESTORE_NOTE',				'<b>警告:</b> バックアップからのリストアは現在のデータベース内の Nucleus データを全て<b>削除</b>します！良く注意して使用してください！	<br />	<b>注意:</b> バックアップを作成した Nucleus のバージョンが 現在使用している Nucleus のバージョンと同じか確認してください！そうでなければ正しく動作しません。');
define('_RESTORE_INTRO',			'以下からバックアップファイル（サーバにアップロードされます）を選択して"リストア"ボタンを押すと開始します。');
define('_RESTORE_IMSURE',			'はい、確かにこの操作の実行を承認します！');
define('_RESTORE_BTN',				'ファイルからリストア');
define('_RESTORE_WARNING',			'（正しいバックアップをリストアしようとしているか確認し、始める前に現在のバックアップを作っておいてください）');
define('_ERROR_BACKUP_NOTSURE',		'"承認"テストボックスをチェックする必要があります');
define('_RESTORE_COMPLETE',			'リストア完了');

// new item notification
define('_NOTIFY_NI_MSG',			'新しいアイテムが投稿されました:');
define('_NOTIFY_NI_TITLE',			'新しいアイテム!');
define('_NOTIFY_KV_MSG',			'カルマの投票がありました:');
define('_NOTIFY_KV_TITLE',			'Nucleusカルマ:');
define('_NOTIFY_NC_MSG',			'アイテムにコメントする:');
define('_NOTIFY_NC_TITLE',			'Nucleusコメント:');
define('_NOTIFY_USERID',			'ユーザーID:');
define('_NOTIFY_USER',				'ユーザー:');
define('_NOTIFY_COMMENT',			'コメント:');
define('_NOTIFY_VOTE',				'投票:');
define('_NOTIFY_HOST',				'ホスト:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'メンバー:');
define('_NOTIFY_TITLE',				'タイトル:');
define('_NOTIFY_CONTENTS',			'コンテンツ:');

// member mail message
define('_MMAIL_MSG',				'次の方からあなた宛のメッセージが送られてきました');
define('_MMAIL_FROMANON',			'匿名のビジター');
define('_MMAIL_FROMNUC',			'送信元のNucleus ウェブログ');
define('_MMAIL_TITLE',				'メッセージ from');
define('_MMAIL_MAIL',				'メッセージ:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'アイテムの追加');
define('_BMLET_EDIT',				'保存');
define('_BMLET_DELETE',				'アイテムの削除');
define('_BMLET_BODY',				'本文');
define('_BMLET_MORE',				'続き');
define('_BMLET_OPTIONS',			'オプション');
define('_BMLET_PREVIEW',			'プレビュー');

// used in bookmarklet
define('_ITEM_UPDATED',				'アイテムが更新されました');
define('_ITEM_DELETED',				'アイテムが削除されました');

// plugins
define('_CONFIRMTXT_PLUGIN',		'このプラグインを削除しますか?');
define('_ERROR_NOSUCHPLUGIN',		'そのようなプラグインはありません');
define('_ERROR_DUPPLUGIN',			'そのプラグインは既にインストールされています');
define('_ERROR_PLUGFILEERROR',		'そのようなプラグインは存在しないか、パーミッションが正しく設定されていません');
define('_PLUGS_NOCANDIDATES',		'プラグイン候補が見つかりません');

define('_PLUGS_TITLE_MANAGE',		'プラグインの管理');
define('_PLUGS_TITLE_INSTALLED',	'インストール済み');
define('_PLUGS_TITLE_UPDATE',		'登録リストのアップデート');
define('_PLUGS_TEXT_UPDATE',		'Nucleusはプラグインのイベント登録を保持します。 ファイルを上書きしてプラグインのアップデートをする場合、登録が正しくキャッシュされるためにこのアップデートを実行してください。');
define('_PLUGS_TITLE_NEW',			'新しいプラグインをインストール');
define('_PLUGS_ADD_TEXT',			'以下はpluginsディレクトリ内の、全てのインストールされていない可能性のあるプラグインのファイルのリストです。追加する前にプラグインかどうかを<strong>しっかり確認</strong>してください。');
define('_PLUGS_BTN_INSTALL',		'プラグインのインストール');
define('_BACKTOOVERVIEW',			'一覧に戻る');

// editlink
define('_TEMPLATE_EDITLINK',		'アイテムを編集するためのリンク');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'left boxを追加');
define('_ADD_RIGHT_TT',				'right boxを追加');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'新しいカテゴリー...');

// new settings
define('_SETTINGS_PLUGINURL',		'プラグインURL');
define('_SETTINGS_MAXUPLOADSIZE',	'アップロードファイルの最大サイズ (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'メンバー以外からのメッセージ送付を許可');
define('_SETTINGS_PROTECTMEMNAMES',	'メンバー名の保護');

// overview screen
define('_OVERVIEW_PLUGINS',			'プラグイン管理');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'新しいメンバーの登録:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'あなたのメールアドレス:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'チームリスト内に対象メンバーを持つどのblogへの管理者権限も持っていません。そのために、このメンバーのメディア・ディレクトリーへのファイルのアップロードを認められません。');

// plugin list
define('_LISTS_INFO',				'情報');
define('_LIST_PLUGS_AUTHOR',		'By:');
define('_LIST_PLUGS_VER',			'バージョン:');
define('_LIST_PLUGS_SITE',			'サイト');
define('_LIST_PLUGS_DESC',			'説明:');
define('_LIST_PLUGS_SUBS',			'以下のイベントに登録:');
define('_LIST_PLUGS_UP',			'上へ');
define('_LIST_PLUGS_DOWN',			'下へ');
define('_LIST_PLUGS_UNINSTALL',		'削除');
define('_LIST_PLUGS_ADMIN',			'管理');
define('_LIST_PLUGS_OPTIONS',		'編集');
define('_LIST_PLUGS_DEP',		'Plugin(s) requires:');

// plugin option list
define('_LISTS_VALUE',				'値');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'このプラグインのオプションはありません');
define('_PLUGS_BACK',				'プラグインの一覧に戻る');
define('_PLUGS_SAVE',				'オプションの保存');
define('_PLUGS_OPTIONS_UPDATED',	'プラグインオプションが更新されました');

define('_OVERVIEW_MANAGEMENT',		'管理');
define('_OVERVIEW_MANAGE',			'Nucleusの管理');
define('_MANAGE_GENERAL',			'管理');
define('_MANAGE_SKINS',				'スキン/テンプレート');
define('_MANAGE_EXTRA',				'追加機能');

define('_BACKTOMANAGE',				'Nucleusの管理に戻る');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'UTF-8');

// global stuff
define('_LOGOUT',					'ログアウト');
define('_LOGIN',					'ログイン');
define('_YES',						'はい');
define('_NO',						'いいえ');
define('_SUBMIT',					'送信');
define('_ERROR',					'エラー');
define('_ERRORMSG',					'エラーが発生しました!');
define('_BACK',						'戻る');
define('_NOTLOGGEDIN',				'ログインしていません');
define('_LOGGEDINAS',				'ログイン:');
define('_ADMINHOME',				'管理ホーム');
define('_NAME',						'名前');
define('_BACKHOME',					'管理ホームに戻る');
define('_BADACTION',				'存在しないアクションが要求されました');
define('_MESSAGE',					'メッセージ');
define('_HELP_TT',					'ヘルプ!');
define('_YOURSITE',					'サイトの確認');


define('_POPUP_CLOSE',				'ウィンドウを閉じる');

define('_LOGIN_PLEASE',				'まずログインしてください');

// commentform
define('_COMMENTFORM_YOUARE',		'ユーザー名: ');
define('_COMMENTFORM_SUBMIT',		'コメントを追加');
define('_COMMENTFORM_COMMENT',		'コメント');
define('_COMMENTFORM_NAME',			'お名前');
define('_COMMENTFORM_MAIL',			'メールまたはWebサイト');
define('_COMMENTFORM_REMEMBER',		'情報を記憶しておく');

// loginform
define('_LOGINFORM_NAME',			'ユーザー名');
define('_LOGINFORM_PWD',			'パスワード');
define('_LOGINFORM_YOUARE',			'ログイン中:');
define('_LOGINFORM_SHARED',			'このPCを他の人と共用する');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'メッセージ送信');

// search form
define('_SEARCHFORM_SUBMIT',		'検索');

// add item form
define('_ADD_ADDTO',				'アイテムの追加:');
define('_ADD_CREATENEW',			'新しいアイテム');
define('_ADD_BODY',					'本文');
define('_ADD_TITLE',				'タイトル');
define('_ADD_MORE',					'続き (空欄でも可)');
define('_ADD_CATEGORY',				'カテゴリー');
define('_ADD_PREVIEW',				'プレビュー');
define('_ADD_DISABLE_COMMENTS',		'コメントを無効にしますか?');
define('_ADD_DRAFTNFUTURE',			'ドラフトと未来の記事');
define('_ADD_ADDITEM',				'アイテムを追加');
define('_ADD_ADDNOW',				'今すぐ追加');
define('_ADD_ADDLATER',				'後で追加');
define('_ADD_PLACE_ON',				'日時:');
define('_ADD_ADDDRAFT',				'ドラフトに追加');
define('_ADD_NOPASTDATES',			'(過去の日時は指定できません。指定された場合は現在の日時が使用されます)');
define('_ADD_BOLD_TT',				'太字');
define('_ADD_ITALIC_TT',			'斜体');
define('_ADD_HREF_TT',				'リンク作成');
define('_ADD_MEDIA_TT',				'メディア(画像・音声)の追加');
define('_ADD_PREVIEW_TT',			'プレビューの表示/非表示');
define('_ADD_CUT_TT',				'カット');
define('_ADD_COPY_TT',				'コピー');
define('_ADD_PASTE_TT',				'ペースト');


// edit item form
define('_EDIT_ITEM',				'アイテムの編集');
define('_EDIT_SUBMIT',				'保存');
define('_EDIT_ORIG_AUTHOR',			'原作者');
define('_EDIT_BACKTODRAFTS',		'再度ドラフトとして保存');
define('_EDIT_COMMENTSNOTE',		'(注意: コメントの非表示は以前に追加されたコメントを隠しはしません)');

// used on delete screens
define('_DELETE_CONFIRM',			'削除の確認をしてください');
define('_DELETE_CONFIRM_BTN',		'削除の確認');
define('_CONFIRMTXT_ITEM',			'以下のアイテムを削除しようとしています:');
define('_CONFIRMTXT_COMMENT',		'以下のコメントを削除しようとしています:');
define('_CONFIRMTXT_TEAM1',			'このblogのチームリストから');
define('_CONFIRMTXT_TEAM2',			'削除しようとしています');
define('_CONFIRMTXT_BLOG',			'削除するBlog: ');
define('_WARNINGTXT_BLOGDEL',		'警告! Blogを削除するとそれに含まれている全てのアイテム、コメントは削除されます。その点を確認した上で行ってください。<br />さらに、Blogの削除中にNucleusを中断させないでください。');
define('_CONFIRMTXT_MEMBER',		'以下のメンバープロファイルを削除しようとしています: ');
define('_CONFIRMTXT_TEMPLATE',		'次のテンプレートを削除しようとしています: ');
define('_CONFIRMTXT_SKIN',			'次のスキンを削除しようとしています: ');
define('_CONFIRMTXT_BAN',			'次の禁止IP範囲を削除しようとしています: ');
define('_CONFIRMTXT_CATEGORY',		'次のカテゴリーを削除しようとしています: ');

// some status messages
define('_DELETED_ITEM',				'アイテムが削除されました');
define('_DELETED_MEMBER',			'メンバーが削除されました');
define('_DELETED_COMMENT',			'コメントが削除されました');
define('_DELETED_BLOG',				'Blogが削除されました');
define('_DELETED_CATEGORY',			'カテゴリーが削除されました');
define('_ITEM_MOVED',				'アイテムが移動されました');
define('_ITEM_ADDED',				'アイテムが追加されました');
define('_COMMENT_UPDATED',			'コメントが更新されました');
define('_SKIN_UPDATED',				'スキンデータが保存されました');
define('_TEMPLATE_UPDATED',			'テンプレートデータが保存されました');

// errors
define('_ERROR_COMMENT_LONGWORD',	'コメントには半角で90文字以上の語を使わないで下さい');
define('_ERROR_COMMENT_NOCOMMENT',	'コメントを入力してください');
define('_ERROR_COMMENT_NOUSERNAME',	'正しくないユーザ名です');
define('_ERROR_COMMENT_TOOLONG',	'コメントが長すぎます(半角で5000文字まで)');
define('_ERROR_COMMENTS_DISABLED',	'このBlogへのコメントは現在使用できません');
define('_ERROR_COMMENTS_NONPUBLIC',	'このBlogへコメントを追加するにはメンバーとしてログインしなければいけません');
define('_ERROR_COMMENTS_MEMBERNICK','あなたが使おうとした名前は既に使われています。他の名前を選んでください。');
define('_ERROR_SKIN',				'スキン　エラー');
define('_ERROR_ITEMCLOSED',			'このアイテムは閉鎖されました。このアイテムへのコメントの追加、投票はできません。');
define('_ERROR_NOSUCHITEM',			'そのようなアイテムは存在しません');
define('_ERROR_NOSUCHBLOG',			'そのようなBlogは存在しません');
define('_ERROR_NOSUCHSKIN',			'そのようなスキンは存在しません');
define('_ERROR_NOSUCHMEMBER',		'そのようなメンバーは存在しません');
define('_ERROR_NOTONTEAM',			'あなたはこのBlogのチームリストに含まれていません');
define('_ERROR_BADDESTBLOG',		'送り先のBlogが存在しません');
define('_ERROR_NOTONDESTTEAM',		'あなたが送り先のBlogのチームリストに入っていないため、アイテムを移動できません');
define('_ERROR_NOEMPTYITEMS',		'空のアイテムは追加できません!');
define('_ERROR_BADMAILADDRESS',		'メールアドレスが不正です');
define('_ERROR_BADNOTIFY',			'通知メールアドレスの中に不正なものが混じっています');
define('_ERROR_BADNAME',			'名前が使用できません ( a-z 、0-9 の英数字しか使えません)');
define('_ERROR_NICKNAMEINUSE',		'他のメンバーがそのニックネームを使用しています');
define('_ERROR_PASSWORDMISMATCH',	'パスワードがマッチしません');
define('_ERROR_PASSWORDTOOSHORT',	'パスワードは6文字以上でなければなりません');
define('_ERROR_PASSWORDMISSING',	'パスワードが空です');
define('_ERROR_REALNAMEMISSING',	'本名を入力してください');
define('_ERROR_ATLEASTONEADMIN',	'管理者領域にログインできるsuper-adminが少なくとも1人はいなくてはいけません。');
define('_ERROR_ATLEASTONEBLOGADMIN','このアクションを実行するとあなたのBlogはメンテナンス不能になります。少なくとも1人の管理者がいるようにしてください。');
define('_ERROR_ALREADYONTEAM',		'既にチームにいるメンバーは追加できません');
define('_ERROR_BADSHORTBLOGNAME',	'短いBlog名には a-z 、0-9、の英数字のみ使用できます。スペースは使用できません。');
define('_ERROR_DUPSHORTBLOGNAME',	'他のBlogで同じ短縮名が使われています。同じ名前は使用できません。');
define('_ERROR_UPDATEFILE',			'更新ファイルに書き込めません。ファイルのパーミッションが正しくセットされているか確認してください (chmod 666 を試してみてください)。また、それが管理領域ディレクトリからの相対位置である場合、(/your/path/to/nucleus/ のように)絶対パスで指定してみてください');
define('_ERROR_DELDEFBLOG',			'既定のBlogは削除できません');
define('_ERROR_DELETEMEMBER',		'このメンバーはアイテムかコメントを書いているため削除できません');
define('_ERROR_BADTEMPLATENAME',	'不正なテンプレート名です (a-z 、0-9 の英数字のみ使用可。スペースは使用不可)');
define('_ERROR_DUPTEMPLATENAME',	'同じ名前のテンプレートが既に存在します');
define('_ERROR_BADSKINNAME',		'不正なスキン名です (a-z 、0-9 の英数字のみ使用可。スペースは使用不可)');
define('_ERROR_DUPSKINNAME',		'同じ名前のスキンが既に存在します');
define('_ERROR_DEFAULTSKIN',		'常に "default" という名前のスキンが存在しなければいけません');
define('_ERROR_SKINDEFDELETE',		'以下のBlogの既定のスキンに指定されているため、スキンを削除できません: ');
define('_ERROR_DISALLOWED',			'このアクションの実行が許可されていません');
define('_ERROR_DELETEBAN',			'禁止者の削除中にエラーが発生しました (禁止者が存在しません)');
define('_ERROR_ADDBAN',				'禁止者の追加中にエラーが発生しました。全てのblogに正しく追加されていないかもしれません。');
define('_ERROR_BADACTION',			'要求されたアクションが存在しません');
define('_ERROR_MEMBERMAILDISABLED',	'メンバー間のメールメッセージが使用不可になっています');
define('_ERROR_MEMBERCREATEDISABLED','メンバーの作成が使用不可になっています');
define('_ERROR_INCORRECTEMAIL',		'正しくないメールアドレスです');
define('_ERROR_VOTEDBEFORE',		'このアイテムに既に投票済みです');
define('_ERROR_BANNED1',			'あなた (IP範囲 ');
define('_ERROR_BANNED2',			') はこのアクションの実行が禁止されています。メッセージ: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'このアクションを実行するするにはログインが必要です');
define('_ERROR_CONNECT',			'接続エラー');
define('_ERROR_FILE_TOO_BIG',		'ファイルが大きすぎます!');
define('_ERROR_BADFILETYPE',		'このファイルタイプは認められていません');
define('_ERROR_BADREQUEST',			'不正なアップロード要求です');
define('_ERROR_DISALLOWEDUPLOAD',	'あなたはどのBlogチームリストにも入っていないので、ファイルをアップロードできませんません');
define('_ERROR_BADPERMISSIONS',		'ファイル/ディレクトリのパーミッションが正しくセットされていません');
define('_ERROR_UPLOADMOVEP',		'アップロードファイルの移動中にエラーが発生しました');
define('_ERROR_UPLOADCOPY',			'ファイルのコピー中にエラーが発生しました');
define('_ERROR_UPLOADDUPLICATE',	'同じ名前のファイルが既に存在します。アップロードする前に名前を変更してしてください。');
define('_ERROR_LOGINDISALLOWED',	'あなたは管理者領域へのログインが認められていません。しかし、他のユーザーとしてログインすることは出来ます');
define('_ERROR_DBCONNECT',			'MySQLサーバに接続できません');
define('_ERROR_DBSELECT',			'nucleusデータベースを選択できません');
define('_ERROR_NOSUCHLANGUAGE',		'そのようなランゲージファイルは存在しません');
define('_ERROR_NOSUCHCATEGORY',		'そのようなカテゴリーは存在しません');
define('_ERROR_DELETELASTCATEGORY',	'少なくとも1つのカテゴリーが必要です');
define('_ERROR_DELETEDEFCATEGORY',	'既定のカテゴリーは削除できません');
define('_ERROR_BADCATEGORYNAME',	'カテゴリー名として使えません');
define('_ERROR_DUPCATEGORYNAME',	'同じ名前のカテゴリーが既に存在します');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'警告: 現在の値はディレクトリではありません!');
define('_WARNING_NOTREADABLE',		'警告: 現在の値は読み取り不可能なディレクトリです!');
define('_WARNING_NOTWRITABLE',		'警告: 現在の値は書き込み不可能なディレクトリです!');

// media and upload
define('_MEDIA_UPLOADLINK',			'新しいファイルのアップロード');
define('_MEDIA_MODIFIED',			'更新日');
define('_MEDIA_FILENAME',			'ファイル名');
define('_MEDIA_DIMENSIONS',			'サイズ');
define('_MEDIA_INLINE',				'埋め込み');
define('_MEDIA_POPUP',				'ポップアップ');
define('_UPLOAD_TITLE',				'ファイル選択');
define('_UPLOAD_MSG',				'アップロードするファイルを選択して、\'アップロード\' ボタンを押してください');
define('_UPLOAD_BUTTON',			'アップロード');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'アカウントが作成されました。パスワードがメールで送信されます');
//define('_MSG_PASSWORDSENT',			'パスワードがメールで送信されました。');
define('_MSG_LOGINAGAIN',			'あなたの情報が変更された為、ログインしなおす必要があります');
define('_MSG_SETTINGSCHANGED',		'設定が変更されました');
define('_MSG_ADMINCHANGED',			'管理者権限 が変更されました');
define('_MSG_NEWBLOG',				'新しいBlogが作成されました');
define('_MSG_ACTIONLOGCLEARED',		'管理操作履歴が消去されました');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'許可されていないアクション: ');
define('_ACTIONLOG_PWDREMINDERSENT','新しいパスワードの送り先: ');
define('_ACTIONLOG_TITLE',			'管理操作履歴');
define('_ACTIONLOG_CLEAR_TITLE',	'管理操作履歴の消去');
define('_ACTIONLOG_CLEAR_TEXT',		'管理操作履歴を今すぐ消去');

// team management
define('_TEAM_TITLE',				'Blogのチームを管理する ');
define('_TEAM_CURRENT',				'現在のチーム');
define('_TEAM_ADDNEW',				'チームに新しいメンバーを追加する');
define('_TEAM_CHOOSEMEMBER',		'メンバーを選ぶ');
define('_TEAM_ADMIN',				'管理者権限を与える ');
define('_TEAM_ADD',					'チームに追加');
define('_TEAM_ADD_BTN',				'チームに追加');

// blogsettings
define('_EBLOG_TITLE',				'Blog設定の編集');
define('_EBLOG_TEAM_TITLE',			'チームの編集');
define('_EBLOG_TEAM_TEXT',			'チームの編集...');
define('_EBLOG_SETTINGS_TITLE',		'Blog設定');
define('_EBLOG_NAME',				'Blogの名前');
define('_EBLOG_SHORTNAME',			'Blogの短縮名');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a-zの英文字のみが使用でき、スペースは使用できません)');
define('_EBLOG_DESC',				'Blogの説明');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'標準のスキン');
define('_EBLOG_DEFCAT',				'標準のカテゴリ');
define('_EBLOG_LINEBREAKS',			'改行を変換する');
define('_EBLOG_DISABLECOMMENTS',	'コメントを許可しますか?<br /><small>(コメントを禁止するとコメントの追加はできなくなります。)</small>');
define('_EBLOG_ANONYMOUS',			'非メンバーのコメントを許可しますか?');
define('_EBLOG_NOTIFY',				'通知するメールアドレス ( ; で区切ってください)');
define('_EBLOG_NOTIFY_ON',			'以下を通知する');
define('_EBLOG_NOTIFY_COMMENT',		'新しいコメント');
define('_EBLOG_NOTIFY_KARMA',		'新しいカルマ投票');
define('_EBLOG_NOTIFY_ITEM',		'新しいBlogアイテム');
define('_EBLOG_PING',				'更新時に Weblogs.com へPingを送りますか?');
define('_EBLOG_MAXCOMMENTS',		'コメントの最大量');
define('_EBLOG_UPDATE',				'自動更新するファイル');
define('_EBLOG_OFFSET',				'サーバ時刻との時差');
define('_EBLOG_STIME',				'現在のサーバ時刻: ');
define('_EBLOG_BTIME',				'現在のBlog時刻: ');
define('_EBLOG_CHANGE',				'設定の変更');
define('_EBLOG_CHANGE_BTN',			'設定の変更');
define('_EBLOG_ADMIN',				'Blog管理者権限');
define('_EBLOG_ADMIN_MSG',			'あなたには管理者権限が割り当てられます');
define('_EBLOG_CREATE_TITLE',		'新しいBlogの作成');
define('_EBLOG_CREATE_TEXT',		'新しいBlogを作成する為に以下のフォームに書き込んでください。<br /><br /> <b>注意:</b> 必要なオプションのみが表示されています。追加のオプションを設定したい場合は、Blogを作成した後でBlog設定ページに行って設定してください。');
define('_EBLOG_CREATE',				'作成!');
define('_EBLOG_CREATE_BTN',			'Blogを作成');
define('_EBLOG_CAT_TITLE',			'カテゴリー');
define('_EBLOG_CAT_NAME',			'カテゴリー名');
define('_EBLOG_CAT_DESC',			'カテゴリーの説明');
define('_EBLOG_CAT_CREATE',			'新しいカテゴリーを作る');
define('_EBLOG_CAT_UPDATE',			'カテゴリーの更新');
define('_EBLOG_CAT_UPDATE_BTN',		'カテゴリーを更新');

// templates
define('_TEMPLATE_TITLE',			'テンプレートの編集');
define('_TEMPLATE_AVAILABLE_TITLE',	'使用可能なテンプレート');
define('_TEMPLATE_NEW_TITLE',		'新しいテンプレート');
define('_TEMPLATE_NAME',			'テンプレート名');
define('_TEMPLATE_DESC',			'テンプレートの説明');
define('_TEMPLATE_CREATE',			'テンプレートの作成');
define('_TEMPLATE_CREATE_BTN',		'テンプレートを作成');
define('_TEMPLATE_EDIT_TITLE',		'テンプレートの編集');
define('_TEMPLATE_BACK',			'テンプレートの一覧に戻る');
define('_TEMPLATE_EDIT_MSG',		'全てのテンプレートパーツが必要な訳ではありません。必要ない場合は空欄のままにしておいてください。');
define('_TEMPLATE_SETTINGS',		'テンプレート設定');
define('_TEMPLATE_ITEMS',			'アイテム');
define('_TEMPLATE_ITEMHEADER',		'アイテムのヘッダー');
define('_TEMPLATE_ITEMBODY',		'アイテムの本体');
define('_TEMPLATE_ITEMFOOTER',		'アイテムのフッター');
define('_TEMPLATE_MORELINK',		'続きへのリンク');
define('_TEMPLATE_NEW',				'新しいアイテムに付けるマーク');
define('_TEMPLATE_COMMENTS_ANY',	'コメント (ある場合)');
define('_TEMPLATE_CHEADER',			'コメントのヘッダー');
define('_TEMPLATE_CBODY',			'コメントの本体');
define('_TEMPLATE_CFOOTER',			'コメントのフッター');
define('_TEMPLATE_CONE',			'コメントが1つの時');
define('_TEMPLATE_CMANY',			'コメントが2つ以上の時');
define('_TEMPLATE_CMORE',			'コメントの続きを読む');
define('_TEMPLATE_CMEXTRA',			'登録メンバーからのコメントへの追加表示');
define('_TEMPLATE_COMMENTS_NONE',	'コメント (無い場合)');
define('_TEMPLATE_CNONE',			'コメントが無い時');
define('_TEMPLATE_COMMENTS_TOOMUCH','コメント (最大表示数より多い場合)');
define('_TEMPLATE_CTOOMUCH',		'コメントが多すぎる時');
define('_TEMPLATE_ARCHIVELIST',		'アーカイブ一覧');
define('_TEMPLATE_AHEADER',			'アーカイブ一覧のヘッダー');
define('_TEMPLATE_AITEM',			'アーカイブ一覧の本体');
define('_TEMPLATE_AFOOTER',			'アーカイブ一覧のフッター');
define('_TEMPLATE_DATETIME',		'日付と時刻');
define('_TEMPLATE_DHEADER',			'日付のヘッダー');
define('_TEMPLATE_DFOOTER',			'日付のフッター');
define('_TEMPLATE_DFORMAT',			'日付フォーマット');
define('_TEMPLATE_TFORMAT',			'時刻フォーマット');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'画像とメディアのポップアップ');
define('_TEMPLATE_PCODE',			'ポップアップ画像へのリンクコード');
define('_TEMPLATE_ICODE',			'インライン画像のコード');
define('_TEMPLATE_MCODE',			'メディアオブジェクトへのリンクコード');
define('_TEMPLATE_SEARCH',			'検索');
define('_TEMPLATE_SHIGHLIGHT',		'ハイライト表示');
define('_TEMPLATE_SNOTFOUND',		'検索で何も見つからなかった場合');
define('_TEMPLATE_UPDATE',			'更新');
define('_TEMPLATE_UPDATE_BTN',		'テンプレートの更新');
define('_TEMPLATE_RESET_BTN',		'リセット');
define('_TEMPLATE_CATEGORYLIST',	'カテゴリー一覧');
define('_TEMPLATE_CATHEADER',		'カテゴリー一覧のヘッダー');
define('_TEMPLATE_CATITEM',			'カテゴリー一覧の本体');
define('_TEMPLATE_CATFOOTER',		'カテゴリー一覧のフッター');

// skins
define('_SKIN_EDIT_TITLE',			'スキンの編集');
define('_SKIN_AVAILABLE_TITLE',		'使用可能なスキン');
define('_SKIN_NEW_TITLE',			'新しいスキン');
define('_SKIN_NAME',				'名前');
define('_SKIN_DESC',				'説明');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'作成');
define('_SKIN_CREATE_BTN',			'スキンの作成');
define('_SKIN_EDITONE_TITLE',		'スキンの編集');
define('_SKIN_BACK',				'スキンの一覧に戻る');
define('_SKIN_PARTS_TITLE',			'スキンパーツ');
define('_SKIN_PARTS_MSG',			'それぞれのスキンに全てのタイプが必要とは限りません。必要ない場合は空欄のままにしておいてください。以下から編集するスキンを選んでください:');
define('_SKIN_PART_MAIN',			'メインの目次ページ');
define('_SKIN_PART_ITEM',			'個別アイテムページ');
define('_SKIN_PART_ALIST',			'月別アーカイブ一覧ページ');
define('_SKIN_PART_ARCHIVE',		'月別アーカイブページ');
define('_SKIN_PART_SEARCH',			'検索ページ');
define('_SKIN_PART_ERROR',			'エラーページ');
define('_SKIN_PART_MEMBER',			'メンバー詳細ページ');
define('_SKIN_PART_POPUP',			'画像ポップアップウィンドウ');
define('_SKIN_GENSETTINGS_TITLE',	'一般設定');
define('_SKIN_CHANGE',				'変更');
define('_SKIN_CHANGE_BTN',			'設定の変更');
define('_SKIN_UPDATE_BTN',			'スキンの更新');
define('_SKIN_RESET_BTN',			'リセット');
define('_SKIN_EDITPART_TITLE',		'スキンの編集');
define('_SKIN_GOBACK',				'戻る');
define('_SKIN_ALLOWEDVARS',			'使用可能な変数 (クリックで説明表示):');

// global settings
define('_SETTINGS_TITLE',			'グローバル設定');
define('_SETTINGS_SUB_GENERAL',		'グローバル設定');
define('_SETTINGS_DEFBLOG',			'既定のBlog');
define('_SETTINGS_ADMINMAIL',		'管理者のメールアドレス');
define('_SETTINGS_SITENAME',		'サイト名');
define('_SETTINGS_SITEURL',			'サイトのURL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_ADMINURL',		'管理者領域のURL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_DIRS',			'Nucleus ディレクトリ');
define('_SETTINGS_MEDIADIR',		'メディア(画像・音声)ディレクトリ');
define('_SETTINGS_SEECONFIGPHP',	'(config.php を参照)');
define('_SETTINGS_MEDIAURL',		'メディアURL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_ALLOWUPLOAD',		'ファイルのアップロードを許可しますか?');
define('_SETTINGS_ALLOWUPLOADTYPES','アップロードを許可するファイルタイプ');
define('_SETTINGS_CHANGELOGIN',		'メンバーによるログイン名/パスワードの変更を許可する');
define('_SETTINGS_COOKIES_TITLE',	'Cookie 設定');
define('_SETTINGS_COOKIELIFE',		'ログイン Cookie の有効期間');
define('_SETTINGS_COOKIESESSION',	'セッションごと');
define('_SETTINGS_COOKIEMONTH',		'一ヶ月');
define('_SETTINGS_COOKIEPATH',		'Cookie パス (上級オプション)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie ドメイン (上級オプション)');
define('_SETTINGS_COOKIESECURE',	'セキュア Cookie (上級オプション)');
define('_SETTINGS_LASTVISIT',		'最終訪問日時 Cookie の保存');
define('_SETTINGS_ALLOWCREATE',		'ビジターにメンバーアカウント作成を許可する');
define('_SETTINGS_NEWLOGIN',		'ユーザーが作成したアカウントによるログインを許可');
define('_SETTINGS_NEWLOGIN2',		'(新しく作成されたアカウントのみ)');
define('_SETTINGS_MEMBERMSGS',		'メンバー間サービスを許可');
define('_SETTINGS_LANGUAGE',		'既定の言語');
define('_SETTINGS_DISABLESITE',		'他のサイトへのリダイレクト（非常時用）');
define('_SETTINGS_DBLOGIN',			'MySQL ログイン &amp; データベース');
define('_SETTINGS_UPDATE',			'設定の更新');
define('_SETTINGS_UPDATE_BTN',		'設定を更新');
define('_SETTINGS_DISABLEJS',		'JavaScriptツールバーを無効にする');
define('_SETTINGS_MEDIA',			'メディア/アップロード設定');
define('_SETTINGS_MEDIAPREFIX',		'アップロードするファイル名の頭に日付を付加する');
define('_SETTINGS_MEMBERS',			'メンバー設定');

// bans
define('_BAN_TITLE',				'禁止リスト:');
define('_BAN_NONE',					'このBlogの禁止者はいません');
define('_BAN_NEW_TITLE',			'禁止者を追加する');
define('_BAN_NEW_TEXT',				'今すぐ禁止者を追加する');
define('_BAN_REMOVE_TITLE',			'禁止者の削除');
define('_BAN_IPRANGE',				'IPの範囲');
define('_BAN_BLOGS',				'禁止するBlog: ');
define('_BAN_DELETE_TITLE',			'禁止者の削除');
define('_BAN_ALLBLOGS',				'あなたが管理者特権を持つ全てのBlog');
define('_BAN_REMOVED_TITLE',		'禁止者が削除されました');
define('_BAN_REMOVED_TEXT',			'以下のBlogへの禁止者が削除されました:');
define('_BAN_ADD_TITLE',			'禁止者の追加');
define('_BAN_IPRANGE_TEXT',			'以下でブロックしたいIPの範囲を選んでください。指定する範囲が小さい程多くのアドレスがブロックされます。');
define('_BAN_BLOGS_TEXT',			'1つのBlogのみで禁止するか、あなたが管理者特権を持つ全てのBlogで禁止するかを選択することが出来ます。以下から選んでください。');
define('_BAN_REASON_TITLE',			'理由');
define('_BAN_REASON_TEXT',			'該当するIP禁止者がコメントを追加したりカルマ投票をしようとしたときに表示される禁止理由を書いておくことができます (上限256文字)。');
define('_BAN_ADD_BTN',				'禁止者の追加');

// LOGIN screen
define('_LOGIN_MESSAGE',			'メッセージ');
define('_LOGIN_NAME',				'ユーザー名');
define('_LOGIN_PASSWORD',			'パスワード');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'パスワードを忘れた場合');

// membermanagement
define('_MEMBERS_TITLE',			'メンバーの管理');
define('_MEMBERS_CURRENT',			'現在のメンバー');
define('_MEMBERS_NEW',				'新しいメンバーの追加');
define('_MEMBERS_DISPLAY',			'表示される名前');
define('_MEMBERS_DISPLAY_INFO',		'(この名前はログオン時に使われます)');
define('_MEMBERS_REALNAME',			'本名');
define('_MEMBERS_PWD',				'パスワード');
define('_MEMBERS_REPPWD',			'パスワード（確認）');
define('_MEMBERS_EMAIL',			'メールアドレス');
define('_MEMBERS_EMAIL_EDIT',		'(メールアドレスを変更すると、そのアドレスへ自動的に新しいパスワードが送信されます)');
define('_MEMBERS_URL',				'Webサイトアドレス (URL)');
define('_MEMBERS_SUPERADMIN',		'Super-admin(最高管理)権限を与える');
define('_MEMBERS_CANLOGIN',			'管理者領域へのログイン');
define('_MEMBERS_NOTES',			'備考');
define('_MEMBERS_NEW_BTN',			'メンバーの追加');
define('_MEMBERS_EDIT',				'メンバーの編集');
define('_MEMBERS_EDIT_BTN',			'設定の変更');
define('_MEMBERS_BACKTOOVERVIEW',	'メンバーの一覧に戻る');
define('_MEMBERS_DEFLANG',			'言語');
define('_MEMBERS_USESITELANG',		'- サイトの設定を使う -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'サイトを見る');
define('_BLOGLIST_ADD',				'アイテムの追加');
define('_BLOGLIST_TT_ADD',			'このBlogに新しいアイテムを追加します');
define('_BLOGLIST_EDIT',			'アイテムの編集/削除');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'設定');
define('_BLOGLIST_TT_SETTINGS',		'設定の編集/チームの管理');
define('_BLOGLIST_BANS',			'禁止');
define('_BLOGLIST_TT_BANS',			'禁止IPの確認/追加/削除');
define('_BLOGLIST_DELETE',			'全て削除');
define('_BLOGLIST_TT_DELETE',		'このBlogを削除');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'あなたのBlog');
define('_OVERVIEW_YRDRAFTS',		'ドラフト');
define('_OVERVIEW_YRSETTINGS',		'設定');
define('_OVERVIEW_GSETTINGS',		'基本設定');
define('_OVERVIEW_NOBLOGS',			'あなたはどのBlogチームリストにも入っていません');
define('_OVERVIEW_NODRAFTS',		'ドラフト（編集中）の記事はありません');
define('_OVERVIEW_EDITSETTINGS',	'あなたの設定');
define('_OVERVIEW_BROWSEITEMS',		'あなたのアイテム');
define('_OVERVIEW_BROWSECOMM',		'あなたのコメント');
define('_OVERVIEW_VIEWLOG',			'管理操作履歴');
define('_OVERVIEW_MEMBERS',			'メンバー管理');
define('_OVERVIEW_NEWLOG',			'新規Blog作成');
define('_OVERVIEW_SETTINGS',		'グローバル設定');
define('_OVERVIEW_TEMPLATES',		'テンプレート編集');
define('_OVERVIEW_SKINS',			'スキン編集');
define('_OVERVIEW_BACKUP',			'DB保存/復元');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Blogアイテムの編集: ');
define('_ITEMLIST_YOUR',			'あなたのアイテム');

// Comments
define('_COMMENTS',					'コメント');
define('_NOCOMMENTS',				'このアイテムへのコメントはありません');
define('_COMMENTS_YOUR',			'あなたのコメント');
define('_NOCOMMENTS_YOUR',			'あなたのコメントはありません');

// LISTS (general)
define('_LISTS_NOMORE',				'何もありません');
define('_LISTS_PREV',				'前へ');
define('_LISTS_NEXT',				'次へ');
define('_LISTS_SEARCH',				'検索');
define('_LISTS_CHANGE',				'変更');
define('_LISTS_PERPAGE',			'アイテム/ページ');
define('_LISTS_ACTIONS',			'アクション');
define('_LISTS_DELETE',				'削除');
define('_LISTS_EDIT',				'編集');
define('_LISTS_MOVE',				'移動');
define('_LISTS_CLONE',				'複製');
define('_LISTS_TITLE',				'タイトル');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'名前');
define('_LISTS_DESC',				'説明');
define('_LISTS_TIME',				'時間');
define('_LISTS_COMMENTS',			'コメント');
define('_LISTS_TYPE',				'タイプ');


// member list 
define('_LIST_MEMBER_NAME',			'名前');
define('_LIST_MEMBER_RNAME',		'本名');
define('_LIST_MEMBER_ADMIN',		'Super-admin権限 ');
define('_LIST_MEMBER_LOGIN',		'ログイン可能');
define('_LIST_MEMBER_URL',			'Webサイト');

// banlist
define('_LIST_BAN_IPRANGE',			'IPの範囲');
define('_LIST_BAN_REASON',			'理由');

// actionlist
define('_LIST_ACTION_MSG',			'メッセージ');

// commentlist
define('_LIST_COMMENT_BANIP',		'禁止IP');
define('_LIST_COMMENT_WHO',			'作者');
define('_LIST_COMMENT',				'コメント');
define('_LIST_COMMENT_HOST',		'ホスト');

// itemlist
define('_LIST_ITEM_INFO',			'情報');
define('_LIST_ITEM_CONTENT',		'タイトルと本文');


// teamlist
define('_LIST_TEAM_ADMIN',			'管理者権限 ');
define('_LIST_TEAM_CHADMIN',		'管理者権限の変更');

// edit comments
define('_EDITC_TITLE',				'コメントの編集');
define('_EDITC_WHO',				'作者');
define('_EDITC_HOST',				'ホスト');
define('_EDITC_WHEN',				'日時');
define('_EDITC_TEXT',				'本文');
define('_EDITC_EDIT',				'コメントの編集');
define('_EDITC_MEMBER',				'メンバー');
define('_EDITC_NONMEMBER',			'非メンバー');

// move item
define('_MOVE_TITLE',				'どのBlogに移動しますか?');
define('_MOVE_BTN',					'アイテムを移動する');

?>
