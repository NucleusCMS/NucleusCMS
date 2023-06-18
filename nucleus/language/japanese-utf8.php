<?php
// Japanese (UTF-8) Nucleus Language File
//
// Author: The NucleusCMS Japan Team and other authors
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// Note for Japanese users
// このファイルは Nucleus の UTF-8 版日本語ランゲージファイルです。

/********************************************
 *        Important Settings                *
 ********************************************/
try_define('_CHARSET', 'UTF-8'); // charset to use
try_define('_LOCALE',  'ja_JP');  // common locale
try_define('_LOCALE_NAME_WINDOWS', 'Japanese');
try_define('_HTML_5_LANG_CODE', 'ja');

/********************************************
 *        Admin Links Settings                *
 ********************************************/
try_define('_MANAGE_LINKS_ITEMS', '<li>プラグイン<ul>
    <li><a href="https://github.com/NucleusCMS?q=NP_&type=all&language=&sort=" title="Nucleus github">github.com/NucleusCMS プラグイン</a></li>
    <li><a href="http://japan.nucleuscms.org/wiki/plugins" title="Nucleus CMS 日本 プラグイン japan.nucleuscms.org/wiki/plugins">[wiki] Nucleus CMS 日本 プラグイン</a></li>
</ul></li>
<li>ダウンロード<ul>
    <li><a href="http://japan.nucleuscms.org/download.php" title="Nucleus CMS 日本 japan.nucleuscms.org">Nucleus CMS 日本 最新版</a></li>
    <li><a href="https://github.com/NucleusCMS/NucleusCMS/tags" title="Nucleus CMS 過去のリリース">Nucleus CMS 過去のリリース</a></li>
</ul></li>
<li>スキン<ul>
    <li><a href="http://japan.nucleuscms.org/wiki/skins" title="Nucleus CMS 日本 スキン japan.nucleuscms.org/wiki/skins">[wiki] Nucleus CMS 日本 スキン</a></li>
</ul></li>
<li>その他<ul>
    <li><a href="http://japan.nucleuscms.org/forum/" title="サポートフォーラム japan.nucleuscms.org/forum/">Nucleus CMS 日本 サポートフォーラム</a></li>
    <li><a href="http://japan.nucleuscms.org/wiki/" title="Nucleus CMS Wiki japan.nucleuscms.org/wiki/">[wiki] Nucleus CMS 日本 Wiki</a></li>
</ul></li>
<li>英語サイト<ul>
<li><a href="https://github.com/NucleusCMS" title="Nucleus github">github.com/NucleusCMS</a></li>
<li><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></li>
<li><a href="http://nucleuscms.org/skins/" title="Nucleus CMS Skins">nucleuscms.org/skins/</a></li>
<li><a href="http://nucleuscms.org/wiki/doku.php/plugin" title="Nucleus CMS Plugins">[wiki] nucleuscms.org/wiki/doku.php/plugin</a></li>
<li><a href="http://nucleuscms.org/dev/" title="Nucleus Developer Network">nucleuscms.org/dev/</a></li>
</ul></li>
');

/********************************************
 *        Common constants                  *
 ********************************************/

try_define('_ADMIN_DEVELOP_VERSION' , '開発版');


// USER HOME
try_define('_USER_HOME',                       'あなたのホーム');
try_define('_BACK_USER_HOME',                  'あなたのホームに戻る');
try_define('_OVERVIEW_YR_MEMBER_SETTINGS',     'あなたの設定');
try_define('_BACK_YR_HOME',                    'あなたのホームに戻る');

// _QMENU
try_define('_QMENU_ABOUT',                 'このアプリ について');
try_define('_QMENU_BACK_USER_HOME',        'あなたのホームに戻る');
try_define('_QMENU_HELP',                  'ヘルプ');
try_define('_QMENU_MANUAL',                'ユーザーガイド');
try_define('_QMENU_USER_HOME',             'あなたのホーム');
try_define('_QMENU_USER_MEMBER_SETTINGS',  'メンバー設定');


try_define('_MEMBERS_CHANGE_PASSWORD',   'パスワードの変更');
try_define('_MEMBERS_CURRENT_PASSWORD',  '現在のパスワード');
try_define('_MEMBERS_NEW_PASSWORD',      '新しいパスワード');
try_define('_MEMBERS_CHANGED_PASSWORD',  'パスワードを変更しました');
try_define('_MEMBERS_INVALID_PASSWORD_CHARACTERS',  'パスワードに使えない文字が含まれています');
try_define('ERROR_PASSWORD_INVALID_CHARACTERS',  'パスワードに使えない文字が含まれています');
try_define('_ERROR_NOT_MATCH_CURRENT_PASSWORD',   '現在のパスワードが一致しませんでした');
try_define('_ERROR_NO_CHANGED_PASSWORD',          'パスワードの変更はありませんでした');
try_define('_QMENU_USER_PASSWORD',						'パスワード変更');
try_define('_OVERVIEW_USER_PASSWORD',					'パスワード変更');

try_define('_ADMIN_ITEMCLONE_TEXT1', '複製の確認をしてください');
try_define('_ADMIN_ITEMCLONE_TEXT2', '以下のアイテムを複製しようとしています。複製されたものは下書きとして保存されます。');
try_define('_ADMIN_ITEMCLONE_TEXT_DATETIME', '日時');
try_define('_ADMIN_ITEMCLONE_TEXT_TITLE', 'タイトル');
try_define('_ADMIN_ITEMCLONE_TEXT_BODY', '内容');
try_define('_ADMIN_ITEMCLONE_TEXT_EXECUTE', '複製を実行する');

try_define('_ADMIN_MEMBER_SETTINGSAVE_SELECTPAGE_TITLE',    'メンバーの編集保存後に表示されるページ');
try_define('_ADMIN_MEMBER_SETTINGSAVE_SELECTPAGE_SAMEPAGE', 'メンバーの編集に戻る');
try_define('_ADMIN_MEMBER_SETTINGSAVE_SELECTPAGE_BACKHOME', 'ホームに戻る');

try_define('_ADMIN_TEXT_BTN_CANCEL', 'キャンセル');
try_define('_ADMIN_TEXT_BTN_EXECUTE', '実行する');
try_define('_ADMIN_TEXT_ALLOW_PLUGINADMIN_OLD', '古い形式のプラグイン管理画面を有効にする');
try_define('_ERROR_INVALID_ACCESS', '無効なアクセスです.');

try_define('_ADMIN_TEXT_CONFLICT_DELETE_OLD_PLUGIN', '古い形式のプラグインが混在しています。古い形式のプラグインを削除してください。');
try_define('_ADMIN_TEXT_DOWNLOAD_PL_FOLDER', 'プラグインフォルダへダウンロード');
try_define('_ADMIN_TEXT_REMOTE_AUTO_UPDATE', 'ダウンロード自動更新する');
try_define('_ADMIN_TEXT_REMOTE_DOWNLOAD', 'リモートからダウンロード');

/********************************************
 *        Start New for 3.80                *
 ********************************************/
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_TITLE', 'アイテム保存後に表示されるページ');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_ITEM' , '保存したアイテムの編集に戻る');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST' , 'アイテム一覧に戻る');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST_WITH_CATEGORY' , 'アイテム一覧（カテゴリ）に戻る');
try_define('_SETTINGS_ENABLE_RSS',         'RSSの出力を有効にする');
try_define('_ERROR_NOSUCHPAGE',            '指定されたページはありません');
try_define('_SKIN_PARTS_SPECIAL_PAGE',     'スペシャルスキンページ');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE',  '本当にこのスペシャルスキンページを削除してもいいですか？');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_STYPE_CHANGE',  '本当にこのスキンパーツのタイプを変更していいですか？');
try_define('_ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST',          'スペシャルスキンパーツはありません。');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST',     'スペシャルスキンページはありません。');
try_define('_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE',       'スペシャルスキンパーツのタイプを変更できません');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE',  'スペシャルスキンページのタイプを変更できません');
try_define('_ADMIN_TEXT_CHANGE_CONFIRM',     '変更の確認をしてください');
try_define('_ADMIN_TEXT_CHANGE',             '変更');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PAGE',     'スペシャルスキンページに変更する');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PARTS',    'スペシャルスキンパーツに変更する');

try_define('_ADMIN_TEXT_UPGRADE_REQUIRED',       'データベースのアップグレードが必要です');
try_define('_ADMIN_TEXT_CLICK_HERE_TO_UPGRADE',  'ここをクリックしてデータベースを Nucleus v%s 用にアップグレードします');

try_define('_LISTS_FORM_SELECT_ITEM_FILTER',                     'フィルター');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_ALL',                 'すべて');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL',              '一般公開中');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL_TERM_FUTURE',  '一般公開-開始前');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_DRAFT',               '下書き');

try_define('_EDIT_DATE_FORMAT',                 'year,month,day');
try_define('_EDIT_DATE_FORMAT_SEPARATOR',       '年,月,日,時,分');
try_define('_EDIT_DATE_FORMAT_DESC',            '(yyyy)年(mm)月(dd)日 (hh)時(mm)分');

try_define('_ADD_DATEINPUTNOW',       '現在時刻');
try_define('_ADD_DATEINPUTRESET',     'リセット');

try_define('_LINKS',                                'リンク');
try_define('_MEMBERS_PASSWORD_INFO',				'(パスワードは6文字以上必要です)');

try_define('_NUMBER_OF_POST',		'投稿数');
try_define('_NUMBER_OF_COMMENT',	'コメント数');

try_define('_ADMIN_CAN_DELETE',	'削除可能');
try_define('_ADMIN_MEMBER_HALT_TITLE' ,             'メンバーの停止');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TITLE' ,     'メンバーの停止');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TEXT' ,      '以下のメンバーを停止しようとしています');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_DONE_BTN' ,  'メンバーの停止を実行する');
try_define('_ADMIN_MEMBER_SUPERADMIN',              '最高管理権限(super admin)');
try_define('_LISTS_HALT',		'停止');
try_define('_LISTS_HALTING',  	'停止中');
try_define('_ERROR_ADMIN_MEMBER_HALT_SELF',         'おそらくこのメンバーは、ログイン中の管理者自身であるため、停止できません。');
try_define('_ERROR_ADMIN_MEMBER_ALREADY_HALTED',    'このメンバーは、すでに停止中です。');
try_define('_ERROR_LOGIN_MEMBER_HALT_OR_INVALID',   'このメンバーは、停止中または無効です。');
try_define('_ERROR_LOGIN_DISALLOWED_BY_HALT',       'このメンバーは、現在無効です。ログインは認められていません。 もしあなたが管理ユーザーのアカウントを持っているのなら、管理ユーザーとしてログインしなおしてください。');
try_define('_GFUNCTIONS_LOGIN_FAILED_HALT_TXT',     'メンバー[ %s ]は、無効又は停止中です。ログインはできません。');

try_define('_ADMIN_DATABASE_OPTIMIZATION_REPAIR',      'データベースの最適化/修復');
try_define('_ADMIN_TITLE_OPTIMIZE',      '最適化');
try_define('_ADMIN_TITLE_REPAIR',        '修復');
try_define('_ADMIN_FILESIZE',            'ファイルサイズ');
try_define('_ADMIN_NEW',                 '新しい');
try_define('_ADMIN_OLD',                 '古い');
try_define('_ADMIN_TABLENAME',           'テーブル名');
try_define('_ADMIN_CONFIRM_TITLE_OPTIMIZE',    'テーブルの最適化をしますか');
try_define('_ADMIN_CONFIRM_TITLE_AUTO_REPAIR', 'テーブルの自動修復をしますか');
try_define('_ADMIN_EXEC_TITLE_AUTO_REPAIR',    'テーブルの自動修復をしました');
try_define('_ADMIN_EXEC_TITLE_OPTIMIZE',       'テーブルの最適化をしました');
try_define('_ADMIN_BTN_TITLE_AUTO_REPAIR',     '修復をする');
try_define('_ADMIN_BTN_TITLE_OPTIMIZE',        '最適化をする');
try_define('_ADMIN_PLEASE_OPTIMIZE',           '最適化をしてください');

try_define('_PROBLEMS_FOUND_ON_TABLE',   'テーブルに問題がみつかりました');
try_define('_NO_PROBLEMS_FOUND',         '問題は見つかりませんでした');
try_define('_NOT_IMPLEMENTED_YET',       'まだ実装されていません');
try_define('_SIZE',                      'サイズ');
try_define('_OVERHEAD',                  'オーバーヘッド');

try_define('_MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT',   "プラグイン %s を読み込めませんでした。(このプラグインはSqlAPI_%s または SqlApi_SQL92 をサポートしていません。プラグインをこの機能に対応した最新版に更新してください)");

try_define('_DEFAULT_DATE_FORMAT_YMD',         '%Y年%m月%d日');
try_define('_DEFAULT_DATE_FORMAT_YBD',         '%Y年%m月%d日');
try_define('_DEFAULT_DATE_FORMAT_YM',          '%Y年%m月');
try_define('_DEFAULT_DATE_FORMAT_YB',          '%Y年%m月');
try_define('_DEFAULT_DATE_FORMAT_MD',          '%m月%d日');
try_define('_DEFAULT_DATE_FORMAT_BD',          '%m月%d日');
try_define('_DEFAULT_DATE_FORMAT_Y',           '%Y年');

try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM',      'システムのコアについて');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_VERSION',     'コア のバージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_PATCHLEVEL',  'コア のパッチレベル');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_DB_VERSION', 'コア のデータベースバージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SETTINGS',    '重要な設定');

try_define('_ADMIN_SYSTEMOVERVIEW_DB_VERSION',       'データベースのバージョン');

// Blog option
try_define('_EBLOG_VISIBLE_ITEM_AUTHOR',           'アイテム投稿者の表示を許可する');

try_define('_ADMIN_LOST_PSWD_TEXT_TITLE', "パスワードを忘れましたか？");
try_define('_ADMIN_LOST_PSWD_TEXT_1', "以下にユーザー名とメールアドレスを入力してください。新しいパスワードを設定するページへのリンクの入ったメールが送信されます。");
try_define('_ADMIN_LOST_PSWD_TEXT_2', "もしユーザー名をお忘れなら、あなたのNucleusサイト管理者に連絡してください。");
try_define('_ADMIN_LOST_PSWD_TEXT_3', "認証用リンクの送信");
try_define('_ADMIN_LOST_PSWD_TEXT_USENAME', "ユーザー名(ログインID)：");
try_define('_ADMIN_LOST_PSWD_TEXT_EMAIL', "メールアドレス：");

try_define('_SETTINGS_TIDY_ENABLE', "Tidyによるhtml自動整形を有効にする");
try_define('_SETTINGS_TIDY_INDENT_ENABLE', "Tidy: タグを字下げする(インデント)");
try_define('_SETTINGS_TIDY_HIDE_COMMENT',  "Tidy: コメントを隠す(通常コンテンツ、一般ユーザー)");
try_define('_SETTINGS_TIDY_HIDE_COMMENT_ADMIN',  "Tidy: コメントを隠す(Adminユーザー)");

try_define('_SYSTEMLOG_TITLE',       "システムログ");
try_define('_SYSTEMLOG_CLEAR_TITLE', "システムログの消去");
try_define('_SYSTEMLOG_CLEAR_TEXT',  "システムログを今すぐ消去");
try_define('_MSG_SYSTEMLOGCLEARED',  "システムログが消去されました");

try_define('ERROR_PASSWORD_INVALID_CHARACTERS',  'パスワードに使えない文字が含まれています');

/********************************************
 *        Start New for 3.71                *
 ********************************************/
try_define('_ADMIN_SYSTEMOVERVIEW_DBANDVERSION',  'データベース と バージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_DBDRIVER',      'データベースのドライバ');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPANDDB',      'PHP と データベース');

try_define('_TEAM_NO_SELECTABLE_MEMBERS',			'選択可能なメンバーはいません');

try_define('_LISTS_FORM_SELECT_ALL_CATEGORY',	'すべてのカテゴリ');

try_define('_LIST_BACK_TO',				'%sに戻る');
try_define('_LIST_COMMENT_LIST_FOR_BLOG',		'ブログのコメント一覧');
try_define('_LIST_COMMENT_LIST_FOR_ITEM',		'アイテムのコメント一覧');
try_define('_LIST_COMMENT_VIEW_ITEM',			'アイテムを表示');
try_define('_LISTS_VIEW',						'表示');

try_define('_LISTS_ITEM_COUNT',	'アイテム数');
try_define('_LISTS_ORDER',	'並び順');

try_define('_EBLOG_CAT_ORDER',					"カテゴリーの並び順です。<br />\n入力値は、数字(標準 100)で小さいほど上になります");
try_define('_EBLOG_CAT_ORDER_DESC2',			"入力値は、数字(標準 100)で小さいほど上になります");

// category order changes (batch)
try_define('_BATCH_CAT_CAHANGE_ORDER',	'並び順を変更する');
try_define('_ERROR_CAHANGE_CATEGORY_ORDER',		  '並びを変更できません');
try_define('_CAHANGE_CATEGORY_ORDER_TITLE',		  'カテゴリーの並び順を指定してください');
try_define('_CAHANGE_CATEGORY_ORDER_CONFIRM_DESC',	'以下のカテゴリーの並び順が一括で変更されます。よろしければ、ボタンを押してください。');
try_define('_CAHANGE_CATEGORY_ORDER_BTN_TITLE',	  '並び順を変更する');

// Skin import/export
try_define('_SKINIE_ERROR_FAILEDLOAD_XML',        'XMLのロードに失敗しました');

 /********************************************
 *        Start New for 3.65                *
 ********************************************/
try_define('_LISTS_AUTHOR', '作者');
try_define('_OVERVIEW_OTHER_DRAFTS', 'その他の下書き');
 
/********************************************
 *        Start New for 3.64                *
 ********************************************/
try_define('_ERROR_USER_TOO_LONG',				'名前を40文字以内で入力してください。');
try_define('_ERROR_EMAIL_TOO_LONG',				'eメールを40文字以内で入力してください。');
try_define('_ERROR_URL_TOO_LONG',				'ウェブサイトを40文字以内で入力してください。');

/********************************************
 *        Start New for 3.62                *
 ********************************************/
try_define('_SETTINGS_ADMINCSS',		'管理領域のスタイルシート');

/********************************************
 *        Start New for 3.50                *
 ********************************************/
try_define('_PLUGS_TITLE_GETPLUGINS',		'プラグインを入手…');
try_define('_ARCHIVETYPE_YEAR', '年');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'新しいバージョンが入手可能かもしれません');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'アップグレードが入手可能かもしれません： v');
//define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "プラグイン %s を読み込めませんでした。(このプラグインは SqlAPI をサポートしていません。プラグインをこの機能に対応した最新版に更新してください)");

/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
try_define('_MEMBERS_USEAUTOSAVE',				'下書きの自動保存機能を有効にしますか?');

try_define('_TEMPLATE_PLUGIN_FIELDS',			'プラグインによる拡張フィールド');
try_define('_TEMPLATE_BLOGLIST',				'Blog一覧');
try_define('_TEMPLATE_BLOGHEADER',				'Blog一覧のヘッダー');
try_define('_TEMPLATE_BLOGITEM',				'Blog一覧の本体');
try_define('_TEMPLATE_BLOGFOOTER',				'Blog一覧のフッター');

try_define('_SETTINGS_DEFAULTLISTSIZE',			'一覧の既定の表示数');
try_define('_SETTINGS_DEBUGVARS',				'デバッグモードを有効にする');

try_define('_CREATE_ACCOUNT_TITLE',				'アカウントの新規作成');
try_define('_CREATE_ACCOUNT0',					'アカウントの作成');
try_define('_CREATE_ACCOUNT1',					'アカウントの作成は許可されていません。<br /><br />');
try_define('_CREATE_ACCOUNT2',					'詳細はウェブサイトの管理者にお問い合わせください。');
try_define('_CREATE_ACCOUNT_USER_DATA',			'新規アカウントの情報');
try_define('_CREATE_ACCOUNT_LOGIN_NAME',		'ログインID (必須)：');
try_define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',	' a-z の英小文字と 0-9 の数字のみ使用できます');
try_define('_CREATE_ACCOUNT_REAL_NAME',			'ハンドル (必須)：');
try_define('_CREATE_ACCOUNT_EMAIL',				'メールアドレス (必須)：');
try_define('_CREATE_ACCOUNT_EMAIL2',			'(アクティベーション用のリンクが送られるので有効なものを使用してください)');
try_define('_CREATE_ACCOUNT_URL',				'(もしあれば)自分のサイトのURL：');
try_define('_CREATE_ACCOUNT_SUBMIT',			'アカウントの作成');

try_define('_BMLET_BACKTODRAFTS',				'ドラフトに戻す');
try_define('_BMLET_CANCEL',						'キャンセル');

try_define('_LIST_ITEM_NOCONTENT',						'コメントはありません');
try_define('_LIST_ITEM_COMMENTS',						'コメント(%d)件');

try_define('_EDITC_URL',								'Web site');
try_define('_EDITC_EMAIL',								'E-mail');

try_define('_MANAGER_PLUGINFILE_NOTFOUND',				"プラグイン「%s」を読み込めませんでした(ファイルが見つかりません)");
/* changed */
// plugin dependency
try_define('_ERROR_INSREQPLUGIN',				'プラグイン %s がインストールされていないためにインストールすることができませんでした。');
try_define('_ERROR_DELREQPLUGIN',				'プラグイン %s がこのプラグインに依存しているために削除できません。');

//define('_ADD_ADDLATER',						'後で追加');
try_define('_ADD_ADDLATER',						'日時を指定して追加');	// <mod by shizuki />

try_define('_LOGIN_NAME',						'ログインID:');
try_define('_LOGIN_PASSWORD',					'パスワード:');

// changed from _BOOKMARLET_BMARKLFOLLOW
try_define('_BOOKMARKLET_BMARKFOLLOW',					' (ほとんどのブラウザで動作します)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
try_define('_ADMIN_NOTABILIA',					'注意事項');
try_define('_ADMIN_PLEASE_READ',				'作成にあたって、下記の<strong>注意事項</strong> をまずお読み下さい');
try_define('_ADMIN_HOW_TO_ACCESS',				'新しいBlogを作成した後に、このBlogにアクセスするための方法を紹介しておきます。方法は2つあります:');
try_define('_ADMIN_SIMPLE_WAY',					'<strong>簡単な方法:</strong> <code>index.php</code>の複製を作り、新しいBlogを表示するように変更を加えます。 この変更の詳細は、作成後に表示されます。');
try_define('_ADMIN_ADVANCED_WAY',				'<strong>高度な方法:</strong> 現在のBlogで使用しているスキンに<code>&lt;%otherblog()&gt;</code>というコードを使った記述を加えます。この方法では、同じページ内で複数のBlogを表示することが可能となります。');
try_define('_ADMIN_HOW_TO_CREATE',				'Blogの作成');


try_define('_BOOKMARKLET_NEW_CATEGORY',			'アイテムは追加され、新しいカテゴリが作成されました。');
try_define('_BOOKMARKLET_NEW_CATEGORY_EDIT',	'ここをクリックしてカテゴリーの名前と説明を編集してください。');
try_define('_BOOKMARKLET_NEW_WINDOW',			'新しいウィンドウが開きます');
try_define('_BOOKMARKLET_SEND_PING',			'アイテムの追加に成功しました。現在blog検索サービスに更新pingを送信します。'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
try_define('_OVERVIEW_SHOWALL',							'全てのblogを表示');

// Edit skins
try_define('_SKINEDIT_ALLOWEDBLOGS',					'作成済みのblog:');
try_define('_SKINEDIT_ALLOWEDTEMPLATESS',				'使用可能なテンプレート:');

// delete member
try_define('_WARNINGTXT_NOTDELMEDIAFILES',				'メンバーによってアップロードされたファイルは<b>削除されません</b>ので気をつけてください。(少なくともこのバージョン以下のNucleusではそうなっています)');	// <add by shizuki />

// send Weblogupdate.ping
try_define('_UPDATEDPING_MESSAGE',						'<h2>サイトが更新されました。Pingサーバに更新を通知します。</h2><p>しばらくお待ちください</p><p>自動的にページが切り替わらない場合は、表示されるリンクをクリックしてください。'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_GOPINGPAGE',					'更新Ping送信'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_PINGING',						'Pingサーバに送信中です'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VIEWITEM',						'更新されたblog:'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VISITOWNSITE',					'サイトへ行ってみる'); // NOTE: This string is no longer in used

// General category
try_define('_EBLOGDEFAULTCATEGORY_NAME',				'総合');
try_define('_EBLOGDEFAULTCATEGORY_DESC',				'投稿した記事に合うカテゴリが無い時にこのカテゴリを使用すると良いでしょう');

// First ITEM
try_define('_EBLOG_FIRSTITEM_TITLE',					'最初の記事(自動投稿)');
try_define('_EBLOG_FIRSTITEM_BODY',						'これはこのblogにおける最初のアイテムです。自由に削除していただいてかまいません。');

// New weblog was created
try_define('_BLOGCREATED_TITLE',						'新しいblogが作成されました');
try_define('_BLOGCREATED_ADDEDTXT',						'新しいblog 「%s」が作成されました。続けて、blogにアクセスするために以下のどちらかの手順に進んでください。');
try_define('_BLOGCREATED_SIMPLEWAY',					'簡単な方法: 下のコードを貼付けた <code>%s.php</code> というファイルを作成する');
try_define('_BLOGCREATED_ADVANCEDWAY',					'高度な方法: 現在使用しているスキンに新しいblogを展開させるための記述を加える');
try_define('_BLOGCREATED_SIMPLEDESC1',					'方法 1 :簡単な方法: <code>%s.php</code> というファイルを作成');
try_define('_BLOGCREATED_SIMPLEDESC2',					'<code>%s.php</code> というファイルを作成して、中身に以下のコードを貼り付けます:');
try_define('_BLOGCREATED_SIMPLEDESC3',					'すでにある<code>index.php</code>と同じディレクトリにアップロードします。');
try_define('_BLOGCREATED_SIMPLEDESC4',					'新しいblogの作成を完了するために、このファイルのURLを入力してください。(<em>多分</em>入力済みの値で合っているとは思いますが保証はできません):');
try_define('_BLOGCREATED_ADVANCEDWAY2',					'方法 2 :高度な方法: 現在使用しているスキンに新しいblogを展開する記述を加える');
try_define('_BLOGCREATED_ADVANCEDWAY3',					'新しいblogの作成を完了するためにURLを入力してください。(ほとんどの場合既存blogと同じURLになります)');

// Donate!
try_define('_ADMINPAGEFOOT_OFFICIALURL',				'http://japan.nucleuscms.org/');
try_define('_ADMINPAGEFOOT_DONATEURL',					'http://japan.nucleuscms.org/donate.php');
try_define('_ADMINPAGEFOOT_DONATE',						'寄付について');
try_define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group &amp; Nucleus CMS Japanチーム');

// Quick menu
try_define('_QMENU_MANAGE_SYSTEM',						'システム環境');

// REG file
try_define('_WINREGFILE_TEXT',							'「%s」に記事を投稿');

// Bookmarklet
try_define('_BOOKMARKLET_TITLE',						'ブックマークレット<!-- と 右クリックメニュー -->');
try_define('_BOOKMARKLET_DESC1',						'ブックマークレット（Bookmarklet）とは、Webブラウザのブックマークに登録して使うJavaScriptプログラムです。<br />');
try_define('_BOOKMARKLET_DESC2',						'Nucleusには『お気に入り』または『ブックマークツールバー』に登録でき、クリックひとつで blog への投稿画面を開く機能をブラウザに追加することができます。<br />');
try_define('_BOOKMARKLET_DESC3',						'Webサイトを見ていてそのページにリンクを張った投稿をしたいと思った時にブックマークレットを使用すれば、そのサイト(ページ)へのリンクが書き込まれた状態で、');
try_define('_BOOKMARKLET_DESC4',						'さらに、そのページ内で文章を選択した状態で使用した場合、選択されている文章が自動的に引用された状態で、Nucleusの新規アイテムの追加ウィンドウがポップアップします。<br />');
try_define('_BOOKMARKLET_DESC5',						'またWindows Internet Explorerのみですが、この機能を右クリックメニューに登録することもできます。');
try_define('_BOOKMARKLET_BOOKARKLET',					'ブックマークレット');
try_define('_BOOKMARKLET_ANCHOR',						'「%s」に記事を投稿');
try_define('_BOOKMARKLET_BMARKTEXT',					' 下のリンクを「お気に入り」もしくは「ブックマーク」に追加してください。追加の仕方はそれぞれのブラウザのヘルプを参照してください。<br />');
try_define('_BOOKMARKLET_BMARKTEST',					' (テストしてみたい場合は下のリンクをクリックしてみてください)');
try_define('_BOOKMARKLET_RIGHTCLICK',					'右クリックメニューにインストール(Windows Internet Explorerのみ)');
try_define('_BOOKMARKLET_RIGHTLABEL',					'右クリックメニュー');
try_define('_BOOKMARKLET_RIGHTTEXT1',					'Windowsでインターネットエクスプローラーを使用している場合は、');
try_define('_BOOKMARKLET_RIGHTTEXT2',					'にインストールすることもできます<br />(「開く」を選択すれば直接レジストリに登録します)');
try_define('_BOOKMARKLET_RIGHTTEXT3',					'このインストールした右クリックメニューを表示するためにはIEの再起動が必要です。');
try_define('_BOOKMARKLET_UNINSTALLTT',					'アンインストール');
try_define('_BOOKMARKLET_DELETEBAR',					'「お気に入り」もしくはツールバーから消すには、単に削除するだけです。');
try_define('_BOOKMARKLET_DELETERIGHTT',					'右クリックメニューから消したい時は、以下の手順を踏んでください:');
try_define('_BOOKMARKLET_DELETERIGHT1',					'スタートメニューから「ファイルを指定して実行...」を選択');
try_define('_BOOKMARKLET_DELETERIGHT2',					'"regedit" と入力');
try_define('_BOOKMARKLET_DELETERIGHT3',					'"OK" ボタンを押す');
try_define('_BOOKMARKLET_DELETERIGHT4',					'"\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" をツリーの中から検索');
try_define('_BOOKMARKLET_DELETERIGHT5',					'"「(blogの名前)」に記事を投稿" エントリを削除');

try_define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'何かが間違っています');
try_define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'新しいカテゴリを作ることができませんでした');

// BAN
try_define('_BAN_EXAMPLE_TITLE',						'例');
try_define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193"と入力した場合は、このIPアドレスを持つPC1台だけをブロックします。"134.58.253"と入力した場合は、"134.58.235.0～134.58.235.255"の範囲の256個のIPアドレスを持つPCを全てブロックします。これは、前者のIPアドレス(134.58.253.193)を含みます。');
try_define('_BAN_IP_CUSTOM',							'ブロック指定: ');
try_define('_BAN_BANBLOGNAME',							'%s のみ');

// Plugin Options
try_define('_PLUGIN_OPTIONS_TITLE',						'%s のオプション設定');

// Plugin file loda error
try_define('_PLUGINFILE_COULDNT_BELOADED',				'エラー: プラグインファイル <strong>%s.php</strong> を読み込めませんでした。ファイルが存在しない、もしくは使用中の Nucleus 上で動作させるために必要な機能がプラグインでサポートされていません。(<a href="?action=actionlog">管理操作履歴</a>に詳細があります。)');

//ITEM add/edit template (for japanese only)
try_define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'フォーマット：');
try_define('_ITEM_ADDEDITTEMPLATE_YEAR',				'年');
try_define('_ITEM_ADDEDITTEMPLATE_MONTH',				'月');
try_define('_ITEM_ADDEDITTEMPLATE_DAY',					'日');
try_define('_ITEM_ADDEDITTEMPLATE_HOUR',				'時');
try_define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'分');

// Errors
try_define('_ERRORS_INSTALLSQL',						'｢install.sql｣ファイルを削除してください');
try_define('_ERRORS_INSTALLDIR',						'｢install｣ディレクトリを削除してください');  // <add by shizuki />
try_define('_ERRORS_INSTALLPHP',						'｢install.php｣ファイルを削除してください');
try_define('_ERRORS_UPGRADESDIR',						'｢_upgrades｣ディレクトリを削除してください');
try_define('_ERRORS_CONVERTDIR',						'｢nucleus/convert｣ディレクトリを削除してください');
try_define('_ERRORS_CONFIGPHP',							'｢config.php｣ファイルを読み取り専用(｢chmod 444｣等)にしてください');
try_define('_ERRORS_STARTUPERROR1',						'<p>一つ、またはそれ以上のNucleusCMSのインストール(アップグレード)用ファイルがサーバ上に残っている、もしくは書き込み可能になっています。</p><p>これらのファイルを削除、またはパーミッションを変更してセキュリティを確保してください。Nucleusが見つけたファイルのいくつかを次に示します。</p> <ul><li>');
try_define('_ERRORS_STARTUPERROR2',						'</li></ul><p>この警告を表示させたくない場合は、<code>globalfunctions.php</code>の<code>$CONF[\'alertOnSecurityRisk\']</code>の値を<code>0</code>にするか、同様の内容を<code>config.php</code>の最後に記述します(セキュリティレベルが下がります)</p>');
try_define('_ERRORS_STARTUPERROR3',						'セキュリティ リスクの警告');

// PluginAdmin tickets by javascript
try_define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>チケットの自動発行中にエラーが発生しました</b></p>');

// Global settings disablesite URL
try_define('_SETTINGS_DISABLESITEURL',					'転送先のURL:');

// Skin import/export
try_define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'予期しないタグ');
try_define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'ファイル、またはURLを開くことができません');
try_define('_SKINIE_NAME_CLASHES_DETECTED',				'スキン/テンプレートに名前の同じものがあります。allowOverwriteを1に設定して、上書きモードで再度実行してください。');

// ACTIONS.php parse_commentform
try_define('_ACTIONURL_NOTLONGER_PARAMATER',			'｢action.php｣のURLはコメントフォーム用の変数のパラメーターではなくなっています。この設定は｢グローバル設定｣に移動しました');

// ADMIN.php addToTemplate 'Query error: '
try_define('_ADMIN_SQLDIE_QUERYERROR',					'クエリ エラー: ');

// backup.php Backup WARNING
try_define('_BACKUP_BACKUPFILE_TITLE',					'Nucleus CMS のデータベースバックアップファイルです');
try_define('_BACKUP_BACKUPFILE_BACKUPDATE',				'バックアップした日:');
try_define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Nucleus CMS のバージョン:');
try_define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nucleus CMS のデータベースの名前:');
try_define('_BACKUP_BACKUPFILE_TABLE_NAME',				'テーブルの構造 :');
try_define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'%s テーブルのダンプデータ');
try_define('_BACKUP_WARNING_NUCLEUSVERSION',				'注意！: バックアップからデータベースを復元する際は、Nucleusのバージョンがバックアップを作成した時と同じものかよく確認してください。');
try_define('_BACKUP_RESTOR_NOFILEUPLOADED',				'ファイルがアップロードされていません');
try_define('_BACKUP_RESTOR_UPLOAD_ERROR',				'アップロード中にエラーが発生しました');
try_define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'アップロードされたファイルの形式が不正です');
try_define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'圧縮形式のバックアップファイルを解凍できませんでした(｢zlib｣ライブラリがインストールされていません)');
try_define('_BACKUP_RESTOR_SQL_ERROR',					'SQL エラー: ');

// BLOG.php addTeamMember
try_define('_TEAM_ADD_NEWTEAMMEMBER',					'%s(ID=%d) を、ブログ "%s" のチームに加えました');

// ADMIN.php systemoverview()
try_define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'システム環境一覧');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'バージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'PHP のバージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'MySQL のバージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'PHP の設定');
try_define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'GD ライブラリ');
try_define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Apache モジュール');
try_define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'有効');
try_define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'無効');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Nucleus のシステムについて');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Nucleus のバージョン');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Nucleus のパッチレベル');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'重要な設定');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'バージョンチェック');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'より新しいバージョンのリリースが無いか、公式サイトでチェックできます: ');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://japan.nucleuscms.org/version.php?v=%d&amp;pl=%d');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'最新のバージョンをチェック');
try_define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			'この画面を閲覧する権限がありません');

// ENCAPSULATE.php
try_define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'エントリーがありません');

// globalfunctions.php
try_define('_GFUNCTIONS_LOGINPCSHARED_YES',				'共有PCからのログイン');
try_define('_GFUNCTIONS_LOGINPCSHARED_NO',				'共有ではないPCからのログイン');
try_define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'%s がログインしました (%s)');
try_define('_GFUNCTIONS_LOGINFAILED_TXT',				'%s がログインに失敗しました');
try_define('_GFUNCTIONS_LOGOUT_TXT',					'%s がログアウトしました');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		'<code>%s</code> の <code>%s</code> 行目で');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		'HTTPヘッダは送信済みです');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>%sすでにページのHTTPヘッダが送出されており、Nucleusが正常に動作しなくなる可能性があります。</p><p><code>config.php</code>やランゲージファイル、その他プラグインのファイルの終わりに、余分な改行や文字列がないか確認してもういちどアクセスしてみてください。</p><p>根本的な解決をせずにこのメッセージを表示させなくするには、<code>globalfunctions.php</code>の冒頭の<code>$CONF[\'alertOnHeadersSent\']</code>を<code>0</code>に設定します。</p>');
try_define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'ファイルが見つかりません');
try_define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'エラーが発生しました');
try_define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			'ログインしていません');

// MANAGER.php
try_define('_MANAGER_PLUGINFILE_NOCLASS',				"プラグイン「%s」を読み込めませんでした(ファイル内にプラグインクラスが存在しません)");

// mysql.php
try_define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>Nucleusを動かすのに必要なmySQL用のライブラリがインストールされていません</p>");

// PLUGIN.php
try_define('_ERROR_PLUGIN_NOSUCHACTION',				'指定されたアクションは存在しません。');

// PLUGINADMIN.php
try_define('_ERROR_INVALID_PLUGIN',						'不正なプラグインです');

// showlist.php
try_define('_LIST_PLUGS_DEPREQ',						'このプラグインに依存するプラグイン:');
try_define('_LIST_SKIN_PREVIEW',						"'%s' スキンのプレビュー");
try_define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"大きな画像を見る");
try_define('_LIST_SKIN_README',							"'%s' スキンについてもっと詳しく");
try_define('_LIST_SKIN_README_TXT',						'Read me');

// BLOG.php createNewCategory()
try_define('_CREATED_NEW_CATEGORY_NAME',				'新しいカテゴリ');
try_define('_CREATED_NEW_CATEGORY_DESC',				'新しいカテゴリの説明');

// ADMIN.php blog settings
try_define('_EBLOG_CURRENT_TEAM_MEMBER',				'このブログチームの現在のメンバー：');

// HTML outputs
try_define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"');
try_define('_LANG_CODE',		'ja');

// Language Files
try_define('_LANGUAGEFILES_JAPANESE-UTF8',				'日本語 - 日本語 (UTF-8)');
try_define('_LANGUAGEFILES_JAPANESE-EUC',				'日本語 - 日本語 (EUC)');
try_define('_LANGUAGEFILES_ENGLISH-UTF8',				'英語 - English (UTF-8)');
try_define('_LANGUAGEFILES_ENGLISH',					'英語 - English (iso-8859-1)');
/*
try_define('_LANGUAGEFILES_BULGARIAN',					'ブルガリア語 - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
try_define('_LANGUAGEFILES_CATALAN',					'カタラン語 - Catal&agrave; (iso-8859-1)');
try_define('_LANGUAGEFILES_CHINESE-GBK',				'簡体字中国語 - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
try_define('_LANGUAGEFILES_SIMCHINESE',					'簡体字中国語 - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
try_define('_LANGUAGEFILES_CHINESE-UTF8',				'簡体字中国語 - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CHINESEB5',					'繁体字中国語 - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_CHINESEB5-UTF8',				'繁体字中国語 - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'繁体字中国語 - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'繁体字中国語 - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CZECH',						'チェコ語 - &#268;esky (windows-1250)');
try_define('_LANGUAGEFILES_FINNISH',					'フィンランド語 - Suomi (iso-8859-1)');
try_define('_LANGUAGEFILES_FRENCH',						'フランス語 - Fran&ccedil;ais (iso-8859-1)');
try_define('_LANGUAGEFILES_GALEGO',						'ガリシア語 - Galego (iso-8859-1)');
try_define('_LANGUAGEFILES_GERMAN',						'ドイツ語 - Deutsch (iso-8859-1)');
try_define('_LANGUAGEFILES_HUNGARIAN',					'ハンガリー語 - Magyar (iso-8859-2)');
try_define('_LANGUAGEFILES_ITALIANO',					'イタリア語 - Italiano (iso-8859-1)');
try_define('_LANGUAGEFILES_KOREAN-UTF8',					'韓国語 - &#54620;&#44397;&#50612; (utf-8)');
try_define('_LANGUAGEFILES_LATVIAN',					'ラトビア語 - Latvie&scaron;u (windows-1257)');
try_define('_LANGUAGEFILES_NEDERLANDS',					'オランダ語 - Nederlands (iso-8859-15)');
try_define('_LANGUAGEFILES_PERSIAN',					'ペルシア語 - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
try_define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'ブラジル-ポルトガル語 - Portugu&ecirc;s (iso-8859-1)');
try_define('_LANGUAGEFILES_RUSSIAN',					'ロシア語 - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
try_define('_LANGUAGEFILES_SLOVAK',						'スロベキア語 - Sloven&#269;ina (ISO-8859-2)');
try_define('_LANGUAGEFILES_SPANISH-UTF8',				'スペイン語 - Espa&ntilde;ol (utf-8)');
try_define('_LANGUAGEFILES_SPANISH',					'スペイン語 - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
try_define('_AUTOSAVEDRAFT',					'ドラフト保存状況');
try_define('_AUTOSAVEDRAFT_LASTSAVED',			'最終ドラフト保存日時: ');
try_define('_AUTOSAVEDRAFT_NOTYETSAVED',		'保存されていません');
try_define('_AUTOSAVEDRAFT_NOW',				'ドラフト保存');
try_define('_SKIN_PARTS_SPECIAL',				'スペシャルスキンパーツ');
try_define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',	'英数字以外の文字は使えません');
try_define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',	'このスキンパーツを削除できません');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',	'本当にこのスペシャルスキンパーツを削除してもいいですか？');
try_define('_ERROR_PLUGIN_LOAD',				'Nucleusのプラグインとして必要なメソッドがプラグインでサポートされていないか、プラグインファイルが見当たりません。(<a href="?action=actionlog">管理操作履歴</a>に詳細があります。)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
try_define('_SEARCHFORM_QUERY',					'検索キーワード');
try_define('_ERROR_EMAIL_REQUIRED',				'メールアドレスが必要です');
try_define('_COMMENTFORM_MAIL',					'あなたのサイトのURL:');
try_define('_COMMENTFORM_EMAIL',				'メールアドレス:');
try_define('_EBLOG_REQUIREDEMAIL',				'コメント時にメールアドレスを要求する');
try_define('_ERROR_COMMENTS_SPAM',              '投稿されたコメントは、スパムテストの結果拒否されました');
// END changed/added after 3.22 END

// START changed/added after 3.15 START

try_define('_LIST_PLUG_SUBS_NEEDUPDATE',		'｢登録リストのアップデート｣ボタンをクリックしてイベント情報を更新してください');
try_define('_LIST_PLUGS_DEP',					'依存するプラグイン:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
try_define('_COMMENTS_BLOG',					'コメントのリスト:');
try_define('_NOCOMMENTS_BLOG',					'このblogにはまだコメントがつけられていません');
try_define('_BLOGLIST_COMMENTS',				'コメント一覧');
try_define('_BLOGLIST_TT_COMMENTS',				'このblogにつけられたコメントのリスト');


// for use in archivetype-skinvar
try_define('_ARCHIVETYPE_DAY',					'日');
try_define('_ARCHIVETYPE_MONTH',				'月');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
try_define('_ERROR_BADTICKET',					'チケットが不正、もしくは期限切れです');

// cookie prefix
try_define('_SETTINGS_COOKIEPREFIX',			'Cookie プレフィックス');

// account activation
try_define('_ERROR_NOLOGON_NOACTIVATE',			'認証用リンクを送信できません。ログインが許可されていません。');
try_define('_ERROR_ACTIVATE',					'認証キーは存在しないか、無効か、あるいは期限切れです。');
try_define('_ACTIONLOG_ACTIVATIONLINK',			'認証用リンクが送信されました。');
try_define('_MSG_ACTIVATION_SENT',				'認証用リンクをメールで送信しました。');

// activation link emails
try_define('_ACTIVATE_REGISTER_MAIL',			"こんにちは <%memberName%>\n\n<%siteName%> (<%siteUrl%>)におけるアカウントを有効にしなければなりません。\n下のリンクをクリックしてアクティベーションを行ってください。：\n\n\t<%activationUrl%>\n\nアクティベーション用のURLの有効期限は<%activationDays%>日間です。それ以降は無効になりますので早めに行ってください。");
try_define('_ACTIVATE_REGISTER_MAILTITLE',		"アカウント'<%memberName%>'のアクティベーション");
try_define('_ACTIVATE_REGISTER_TITLE',			'ようこそ <%memberName%>');
try_define('_ACTIVATE_REGISTER_TEXT',			'アカウント作成はほぼ完了しました。下のフォームでアカウントのパスワードを設定してください。');
try_define('_ACTIVATE_FORGOT_MAIL',				"こんにちは <%memberName%>\n\n下のリンクから、この<%siteName%> (<%siteUrl%>)における新しいパスワードを設定することができます。\n\n\t<%activationUrl%>\n\nアクティベーション用のURLの有効期限は<%activationDays%>日間です。それ以降は無効になりますので早めに行ってください。");
try_define('_ACTIVATE_FORGOT_MAILTITLE',		"アカウント'<%memberName%>'の再認証");
try_define('_ACTIVATE_FORGOT_TITLE',			'ようこそ <%memberName%>');
try_define('_ACTIVATE_FORGOT_TEXT',				'下のフォームで新しいパスワードが設定できます。');
try_define('_ACTIVATE_CHANGE_MAIL',				"こんにちは <%memberName%>\n\nメールアドレスが変更されました。\n\n<%siteName%> (<%siteUrl%>)におけるアカウントを再認証する必要があります。\n下のリンクをクリックしてアクティベーションを行ってください。：\n\n\t<%activationUrl%>\n\nアクティベーション用のURLの有効期限は<%activationDays%>日間です。それ以降は無効になりますので早めに行ってください。");
try_define('_ACTIVATE_CHANGE_MAILTITLE',		"アカウント'<%memberName%>'の再認証");
try_define('_ACTIVATE_CHANGE_TITLE',			'ようこそ <%memberName%>');
try_define('_ACTIVATE_CHANGE_TEXT',				'メールアドレスの変更が確認されました。');
try_define('_ACTIVATE_SUCCESS_TITLE',			'アクティベーションに成功しました');
try_define('_ACTIVATE_SUCCESS_TEXT',			'アクティベーションに成功しました。');
try_define('_MEMBERS_SETPWD',					'パスワードを設定する');
try_define('_MEMBERS_SETPWD_BTN',				'パスワードを設定');
try_define('_QMENU_ACTIVATE',					'アクティベーション');
try_define('_QMENU_ACTIVATE_TEXT',				'<p>アクティベーションを完了すれば、<a href="index.php?action=showlogin">ログイン</a>してから利用できます。</p>');

try_define('_PLUGS_BTN_UPDATE',					'登録リストのアップデート');

// global settings
try_define('_SETTINGS_JSTOOLBAR',				'Javascriptツールバーのスタイル');
try_define('_SETTINGS_JSTOOLBAR_FULL',			'フル・ツールバー(IE)');
try_define('_SETTINGS_JSTOOLBAR_SIMPLE',		'シンプル・ツールバー(IE以外)');
try_define('_SETTINGS_JSTOOLBAR_NONE',			'ツールバーを使わない');
try_define('_SETTINGS_URLMODE_HELP',			'(参考：<a href="documentation/ja/tips.html#searchengines-fancyurls">FancyURLを有効にする方法</a>)');

// extra plugin settings part when editing categories/members/blogs/...
try_define('_PLUGINS_EXTRA',					'プラグインによる追加設定');

// itemlist info column keys
try_define('_LIST_ITEM_BLOG',					'blog:');
try_define('_LIST_ITEM_CAT',					'cat:');
try_define('_LIST_ITEM_AUTHOR',					'著者:');
try_define('_LIST_ITEM_DATE',					'日付:');
try_define('_LIST_ITEM_TIME',					'時間:');

// indication of registered members in comments list
try_define('_LIST_COMMENTS_MEMBER', 			'(メンバー)');

// batch operations
try_define('_BATCH_WITH_SEL',					'選択されたものを：');
try_define('_BATCH_EXEC',						'実行');

// quickmenu
// Note: _USER_SETTINGS と _MANAGE_SETTINGS は 3.3 以降、オリジナル版は
// 変更されましたが、日本語版は表記をそのままとします。
// 間違って更新しないように!!
try_define('_QMENU_HOME',						'管理ホーム');
try_define('_QMENU_ADD',						'アイテム追加');
try_define('_QMENU_ADD_SELECT',					'- blog選択 -');
try_define('_QMENU_USER_SETTINGS',				'あなたの設定');
try_define('_QMENU_USER_ITEMS',					'あなたのアイテム');
try_define('_QMENU_USER_COMMENTS',				'あなたのコメント');
try_define('_QMENU_MANAGE',						'サイト管理');
try_define('_QMENU_MANAGE_LOG',					'管理操作履歴');
try_define('_QMENU_MANAGE_SETTINGS',			'グローバル設定');
try_define('_QMENU_MANAGE_MEMBERS',				'メンバー管理');
try_define('_QMENU_MANAGE_NEWBLOG',				'新規Blog作成');
try_define('_QMENU_MANAGE_BACKUPS',				'DB保存/復元');
try_define('_QMENU_MANAGE_PLUGINS',				'プラグイン管理');
try_define('_QMENU_LAYOUT',						'レイアウト設定');
try_define('_QMENU_LAYOUT_SKINS',				'スキン編集');
try_define('_QMENU_LAYOUT_TEMPL',				'テンプレート編集');
try_define('_QMENU_LAYOUT_IEXPORT',				'読込/書出');
try_define('_QMENU_PLUGINS',					'プラグイン');

// quickmenu on logon screen
try_define('_QMENU_INTRO',						'導入ガイド');
try_define('_QMENU_INTRO_TEXT',					'<p>ここはウェブサイトの管理を行うコンテンツ管理システム、「Nucleus CMS」のログイン画面です。</p><p>アカウントを持っていればログインして新しい記事の投稿ができます。</p>');

// helppages for plugins
try_define('_ERROR_PLUGNOHELPFILE',				'このプラグイン用のヘルプファイルが見つかりません');
try_define('_PLUGS_HELP_TITLE',					'プラグインのヘルプページ');
try_define('_LIST_PLUGS_HELP', 					'ヘルプ');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
try_define('_SETTINGS_EXTAUTH',					'外部認証の有効化');
try_define('_WARNING_EXTAUTH',					'警告:必要な時以外は有効にしない');

// member profile
try_define('_MEMBERS_BYPASS',					'外部認証を使用する');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
try_define('_EBLOG_SEARCH',						'<em>常に</em>検索対象にする');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
try_define('_MEDIA_VIEW',						'表示');
try_define('_MEDIA_VIEW_TT',					'ファイル表示 (新しいウィンドウが開きます)');
try_define('_MEDIA_FILTER_APPLY',				'フィルター適用');
try_define('_MEDIA_FILTER_LABEL',				'フィルター: ');
try_define('_MEDIA_UPLOAD_TO',					'アップロード先...');
try_define('_MEDIA_UPLOAD_NEW',					'新規アップロード...');
try_define('_MEDIA_COLLECTION_SELECT',			'選択');
try_define('_MEDIA_COLLECTION_TT',				'このカテゴリーに切り替え');
try_define('_MEDIA_COLLECTION_LABEL',			'現在のコレクション: ');

// tooltips on toolbar
try_define('_ADD_ALIGNLEFT_TT',					'左寄せ');
try_define('_ADD_ALIGNRIGHT_TT',				'右寄せ');
try_define('_ADD_ALIGNCENTER_TT',				'中央寄せ');


// generic upload failure
try_define('_ERROR_UPLOADFAILED',				'アップロードに失敗しました');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
try_define('_EBLOG_ALLOWPASTPOSTING',			'過去の日時での投稿を許可する');
try_define('_ADD_CHANGEDATE',					'タイムスタンプを更新');
try_define('_BMLET_CHANGEDATE',					'タイムスタンプを更新');

// skin import/export
try_define('_OVERVIEW_SKINIMPORT',				'読込/書出');

// skin settings
try_define('_PARSER_INCMODE_NORMAL',			'ノーマル');
try_define('_PARSER_INCMODE_SKINDIR',			'skindirを使う');
try_define('_SKIN_INCLUDE_MODE',				'Includeモード');
try_define('_SKIN_INCLUDE_PREFIX',				'Includeプリフィックス');

// global settings
try_define('_SETTINGS_BASESKIN',				'基本のスキン');
try_define('_SETTINGS_SKINSURL',				'スキンURL');
try_define('_SETTINGS_ACTIONSURL',				'「https://」「http://」から始まる action.php のURL');

// category moves (batch)
try_define('_ERROR_MOVEDEFCATEGORY',			'デフォルトのカテゴリーは移動できません');
try_define('_ERROR_MOVETOSELF',					'カテゴリーを移動できません (移動先のBlogが移動元と同じです)');
try_define('_MOVECAT_TITLE',					'カテゴリーを移動するBlogを選択してください');
try_define('_MOVECAT_BTN',						'カテゴリーを移動');

// URLMode setting
try_define('_SETTINGS_URLMODE',					'URL モード');
try_define('_SETTINGS_URLMODE_NORMAL',			'Normal');
try_define('_SETTINGS_URLMODE_PATHINFO',		'Fancy');

// Batch operations
try_define('_BATCH_NOSELECTION',				'対象が選択されていません');
try_define('_BATCH_ITEMS',						'アイテム　　　に対してのバッチ操作');
try_define('_BATCH_CATEGORIES',					'カテゴリー　　に対してのバッチ操作');
try_define('_BATCH_MEMBERS',					'メンバー　　　に対してのバッチ操作');
try_define('_BATCH_TEAM',						'チームメンバーに対してのバッチ操作');
try_define('_BATCH_COMMENTS',					'コメント　　　に対してのバッチ操作');
try_define('_BATCH_UNKNOWN',					'未知のバッチ操作: ');
try_define('_BATCH_EXECUTING',					'実行中');
try_define('_BATCH_ONCATEGORY',					'- 対象カテゴリー');
try_define('_BATCH_ONITEM',						'- 対象アイテム');
try_define('_BATCH_ONCOMMENT',					'- 対象コメント');
try_define('_BATCH_ONMEMBER',					'- 対象メンバー');
try_define('_BATCH_ONTEAM',						'- 対象チームメンバー');
try_define('_BATCH_SUCCESS',					'成功!');
try_define('_BATCH_DONE',						'終了!');
try_define('_BATCH_DELETE_CONFIRM',				'バッチ削除の確認');
try_define('_BATCH_DELETE_CONFIRM_BTN',			'バッチ削除の確認');
try_define('_BATCH_SELECTALL',					'全て選択');
try_define('_BATCH_DESELECTALL',				'全ての選択を解除');

// batch operations: options in dropdowns
try_define('_BATCH_ITEM_DELETE',				'削除');
try_define('_BATCH_ITEM_MOVE',					'移動');
try_define('_BATCH_MEMBER_DELETE',				'削除');
try_define('_BATCH_MEMBER_SET_ADM',				'管理者権限を与える');
try_define('_BATCH_MEMBER_UNSET_ADM',			'管理者権限を外す');
try_define('_BATCH_TEAM_DELETE',				'チームから削除');
try_define('_BATCH_TEAM_SET_ADM',				'管理者権限を与える');
try_define('_BATCH_TEAM_UNSET_ADM',				'管理者権限を外す');
try_define('_BATCH_CAT_DELETE',					'削除');
try_define('_BATCH_CAT_MOVE',					'他のBlogに移動');
try_define('_BATCH_COMMENT_DELETE',				'削除');

// itemlist: Add new item...
try_define('_ITEMLIST_ADDNEW',					'新しいアイテムの追加...');
try_define('_ADD_PLUGIN_EXTRAS',				'追加プラグインオプション');

// errors
try_define('_ERROR_CATCREATEFAIL',				'新しいカテゴリーを作成できません');
try_define('_ERROR_NUCLEUSVERSIONREQ',			'このプラグインを使用するには、新しいバージョンの Nucleus が必要です: ');

// backlinks
try_define('_BACK_TO_BLOGSETTINGS',				'Blogの設定に戻る');

// skin import export
try_define('_SKINIE_TITLE_IMPORT',				'読み込み');
try_define('_SKINIE_TITLE_EXPORT',				'書き出し');
try_define('_SKINIE_BTN_IMPORT',				'読み込み');
try_define('_SKINIE_BTN_EXPORT',				'選択されたスキン/テンプレートを書き出し');
try_define('_SKINIE_LOCAL',						'ローカルファイルから読み込み:');
try_define('_SKINIE_NOCANDIDATES',				'スキンディレクトリ内に読み込めるファイルがありません');
try_define('_SKINIE_FROMURL',					'URLを指定して読み込み:');
try_define('_SKINIE_EXPORT_INTRO',				'書き出すスキン/テンプレートを以下から選択してください');
try_define('_SKINIE_EXPORT_SKINS',				'スキン');
try_define('_SKINIE_EXPORT_TEMPLATES',			'テンプレート');
try_define('_SKINIE_EXPORT_EXTRA',				'追加情報（書き出しファイルに追加する備考）');
try_define('_SKINIE_CONFIRM_OVERWRITE',			'既に存在するスキンを上書きする (ぶつかるスキン名を参照)');
try_define('_SKINIE_CONFIRM_IMPORT',			'はい、これを読み込みます');
try_define('_SKINIE_CONFIRM_TITLE',				'スキンとテンプレートを読み込もうとしています');
try_define('_SKINIE_INFO_SKINS',				'ファイル内のスキン:');
try_define('_SKINIE_INFO_TEMPLATES',			'ファイル内のテンプレート:');
try_define('_SKINIE_INFO_GENERAL',				'情報:');
try_define('_SKINIE_INFO_SKINCLASH',			'次のスキン名がぶつかります:');
try_define('_SKINIE_INFO_TEMPLCLASH',			'次のテンプレート名がぶつかります:');
try_define('_SKINIE_INFO_IMPORTEDSKINS',		'読み込まれたスキン:');
try_define('_SKINIE_INFO_IMPORTEDTEMPLS',		'読み込まれたテンプレート:');
try_define('_SKINIE_DONE',						'読み込み完了');

try_define('_AND',								'and');
try_define('_OR',								'or');

// empty fields on template edit
try_define('_EDITTEMPLATE_EMPTY',				'無し(クリックするとフォームが開きます)');

// skin overview list
try_define('_LIST_SKINS_INCMODE',				'Includeモード:');
try_define('_LIST_SKINS_INCPREFIX',				'Includeプリフィックス:');
try_define('_LIST_SKINS_DEFINED',				'定義済みパーツ:');

// backup
try_define('_BACKUPS_TITLE',					'バックアップ / リストア');
try_define('_BACKUP_TITLE',						'バックアップ');
try_define('_BACKUP_INTRO',						'下のボタンを押すと、Nucleusが使用しているデータベースをバックアップできます。バックアップファイルは安全な場所に保存しておくことをお勧めします。');
try_define('_BACKUP_ZIP_YES',					'圧縮する');
try_define('_BACKUP_ZIP_NO',					'圧縮しない');
try_define('_BACKUP_BTN',						'バックアップを作成する');
try_define('_BACKUP_NOTE',						'<b style="color:#f00;">注意:</b> バックアップされるのはデータベースの内容だけです。アップロードしたファイルや config.php 内の設定はバックアップ<b style="color:#f00;">されません</b>。');
try_define('_RESTORE_TITLE',					'リストア');
try_define('_RESTORE_NOTE',						'<b style="color:#f00;">警告:</b> バックアップからのリストアは現在のデータベース内の Nucleus データを全て<b style="color:#f00;">削除</b>します！良く注意して使用してください！<br /><b style="color:#f00;">注意:</b> バックアップを作成した Nucleus のバージョンが 現在使用している Nucleus のバージョンと同じか確認してください！そうでなければ正しく動作しません。');
try_define('_RESTORE_INTRO',					'以下からバックアップファイルを選択（サーバにアップロードされます）して"リストア"ボタンを押すと開始します。');
try_define('_RESTORE_IMSURE',					'はい、確かにこの操作の実行を承認します！');
try_define('_RESTORE_BTN',						'ファイルからリストア');
try_define('_RESTORE_WARNING',					'（正しいバックアップをリストアしようとしているか確認し、始める前に現在のバックアップを作っておいてください）');
try_define('_ERROR_BACKUP_NOTSURE',				'"承認"チェックボックスをチェックする必要があります');
try_define('_RESTORE_COMPLETE',					'リストア完了');

// new item notification
try_define('_NOTIFY_NI_MSG',					'新しいアイテムが投稿されました:');
try_define('_NOTIFY_NI_TITLE',					'新しいアイテム!');
try_define('_NOTIFY_KV_MSG',					'アイテムにカルマの投票がありました:');
try_define('_NOTIFY_KV_TITLE',					'Nucleusカルマ:');
try_define('_NOTIFY_NC_MSG',					'アイテムにコメントがありました:');
try_define('_NOTIFY_NC_TITLE',					'Nucleusコメント:');
try_define('_NOTIFY_USERID',					'ユーザーID:');
try_define('_NOTIFY_USER',						'ユーザー:');
try_define('_NOTIFY_COMMENT',					'コメント:');
try_define('_NOTIFY_VOTE',						'投票:');
try_define('_NOTIFY_HOST',						'ホスト:');
try_define('_NOTIFY_IP',						'IPアドレス:');
try_define('_NOTIFY_MEMBER',					'メンバー:');
try_define('_NOTIFY_TITLE',						'タイトル:');
try_define('_NOTIFY_CONTENTS',					'内容:');

// member mail message
try_define('_MMAIL_MSG',						'次の方からあなた宛のメッセージが送られてきました');
try_define('_MMAIL_FROMANON',					'匿名のビジター');
try_define('_MMAIL_FROMNUC',					'送信元のNucleus Blog');
try_define('_MMAIL_TITLE',						'メッセージ from');
try_define('_MMAIL_MAIL',						'メッセージ:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
try_define('_BMLET_ADD',						'アイテムの追加');
try_define('_BMLET_EDIT',						'保存');
try_define('_BMLET_DELETE',						'アイテムの削除');
try_define('_BMLET_BODY',						'本文');
try_define('_BMLET_MORE',						'続き');
try_define('_BMLET_OPTIONS',					'オプション');
try_define('_BMLET_PREVIEW',					'プレビュー');

// used in bookmarklet
try_define('_ITEM_UPDATED',						'アイテムが更新されました');
try_define('_ITEM_DELETED',						'アイテムが削除されました');

// plugins
try_define('_CONFIRMTXT_PLUGIN',				'このプラグインを削除しますか？');
try_define('_ERROR_NOSUCHPLUGIN',				'指定されたプラグインはありません');
try_define('_ERROR_DUPPLUGIN',					'そのプラグインは既にインストールされています');
try_define('_ERROR_PLUGFILEERROR',				'指定されたプラグインは存在しないか、パーミッションが正しく設定されていません');
try_define('_PLUGS_NOCANDIDATES',				'プラグインのインストール候補はありません。');

try_define('_PLUGS_TITLE_MANAGE',				'プラグインの管理');
try_define('_PLUGS_TITLE_INSTALLED',			'インストール済み');
try_define('_PLUGS_TITLE_UPDATE',				'登録リストのアップデート');
try_define('_PLUGS_TEXT_UPDATE',				'Nucleusが管理している各プラグインが登録中のイベント情報が、何らかの原因(プラグインのバージョンアップに伴うファイルの上書き等)によって正常ではない状態になった時に「アップデート」ボタンをクリックしてください。');
try_define('_PLUGS_TITLE_NEW',					'新しいプラグインをインストール');
try_define('_PLUGS_ADD_TEXT',					'以下はpluginsディレクトリ内にある全ての「インストールされていないプラグイン」の可能性があるファイルのリストです。追加する前にプラグインかどうかを<strong>しっかり確認</strong>してください。');
try_define('_PLUGS_BTN_INSTALL',				'プラグインのインストール');
try_define('_BACKTOOVERVIEW',					'一覧に戻る');

// editlink
try_define('_TEMPLATE_EDITLINK',				'アイテムを編集するためのリンク');

// add left / add right tooltips
try_define('_ADD_LEFT_TT',						'left boxを追加');
try_define('_ADD_RIGHT_TT',						'right boxを追加');

// add/edit item: new category (in dropdown box)
try_define('_ADD_NEWCAT',						'新しいカテゴリーを追加...');

// new settings
try_define('_SETTINGS_PLUGINURL',				'プラグインディレクトリのURL');
try_define('_SETTINGS_MAXUPLOADSIZE',			'アップロードできるファイルの最大サイズ (bytes)');
try_define('_SETTINGS_NONMEMBERMSGS',			'メンバー以外からのメッセージを受け付ける');
try_define('_SETTINGS_PROTECTMEMNAMES',			'メンバー名の保護');

// overview screen
try_define('_OVERVIEW_PLUGINS',					'プラグイン管理');

// actionlog
try_define('_ACTIONLOG_NEWMEMBER',				'新しいメンバーの登録:');

// membermail (when not logged in)
try_define('_MEMBERMAIL_MAIL',					'メールアドレス:');

// file upload
try_define('_ERROR_DISALLOWEDUPLOAD2',			'チームに参加しているどのブログも管理権限を持っていないため、ファイルのアップロードができません。');

/* plugin list
try_define('_LISTS_INFO',						'情報');
try_define('_LIST_PLUGS_AUTHOR',				'作者:');
try_define('_LIST_PLUGS_VER',					'バージョン:');
try_define('_LIST_PLUGS_SITE',					'サイト');
try_define('_LIST_PLUGS_DESC',					'説明:');
try_define('_LIST_PLUGS_SUBS',					'以下のイベントに登録:');
try_define('_LIST_PLUGS_UP',					'上へ');
try_define('_LIST_PLUGS_DOWN',					'下へ');
try_define('_LIST_PLUGS_UNINSTALL',				'削除');
try_define('_LIST_PLUGS_ADMIN',					'管理');
try_define('_LIST_PLUGS_OPTIONS',				'編集');*/
try_define('_LISTS_INFO',						'インフォメーション');
try_define('_LIST_PLUGS_AUTHOR',				'製作者：');
try_define('_LIST_PLUGS_VER',					'バージョン：');
try_define('_LIST_PLUGS_SITE',					'入手サイト：');
try_define('_LIST_PLUGS_DESC',					'概要：');
try_define('_LIST_PLUGS_SUBS',					'登録済みイベント：');
try_define('_LIST_PLUGS_UP',					'&uarr; 上へ');
try_define('_LIST_PLUGS_DOWN',					'下へ &darr;');
try_define('_LIST_PLUGS_UNINSTALL',				'アンインストール');
try_define('_LIST_PLUGS_ADMIN',					'管理画面');
try_define('_LIST_PLUGS_OPTIONS',				'オプション設定');

// plugin option list
try_define('_LISTS_VALUE',						'値(内容)');

// plugin options
try_define('_ERROR_NOPLUGOPTIONS',				'このプラグインにはオプションがありません');
try_define('_PLUGS_BACK',						'プラグインの一覧に戻る');
try_define('_PLUGS_SAVE',						'オプションの保存');
try_define('_PLUGS_OPTIONS_UPDATED',			'プラグインオプションが更新されました');

try_define('_OVERVIEW_MANAGEMENT',				'管理');
try_define('_OVERVIEW_MANAGE',					'Nucleusの管理');
try_define('_MANAGE_GENERAL',					'管理');
try_define('_MANAGE_SKINS',						'スキン/テンプレート');
try_define('_MANAGE_EXTRA',						'追加機能');

try_define('_BACKTOMANAGE',						'Nucleusの管理に戻る');


// END introduced after v1.1 END





// global stuff
try_define('_LOGOUT',							'ログアウト');
try_define('_LOGIN',							'ログイン');
try_define('_YES',								'はい');
try_define('_NO',								'いいえ');
try_define('_SUBMIT',							'保存');
try_define('_ERROR',							'エラー');
try_define('_ERRORMSG',							'エラーが発生しました！');
try_define('_BACK',								'戻る');
try_define('_NOTLOGGEDIN',						'ログインしていません');
try_define('_LOGGEDINAS',						'ログイン名 : ');
try_define('_ADMINHOME',						'管理ホーム');
try_define('_NAME',								'名前');
try_define('_BACKHOME',							'管理ホームに戻る');
try_define('_BADACTION',						'存在しないアクションが要求されました');
try_define('_MESSAGE',							'メッセージ');
try_define('_HELP_TT',							'ヘルプ');
try_define('_YOURSITE',							'サイトを表示');


try_define('_POPUP_CLOSE',						'ウィンドウを閉じる');

try_define('_LOGIN_PLEASE',						'まずログインしてください');

// commentform
try_define('_COMMENTFORM_YOUARE',				'ユーザー名: ');
try_define('_COMMENTFORM_SUBMIT',				'コメントを追加');
try_define('_COMMENTFORM_COMMENT',				'コメント:');
try_define('_COMMENTFORM_NAME',					'お名前:');
try_define('_COMMENTFORM_REMEMBER',				'情報を記憶しておく');

// loginform
try_define('_LOGINFORM_NAME',					'ログインID:');
try_define('_LOGINFORM_PWD',					'パスワード:');
try_define('_LOGINFORM_YOUARE',					'ログイン中:');
try_define('_LOGINFORM_SHARED',					'このPCを他の人と共用する');

// member mailform
try_define('_MEMBERMAIL_SUBMIT',				'メッセージ送信');

// search form
try_define('_SEARCHFORM_SUBMIT',				'検索');

// add item form
try_define('_ADD_ADDTO',						'アイテムの追加:');
try_define('_ADD_CREATENEW',					'新しいアイテム');
try_define('_ADD_BODY',							'本文');
try_define('_ADD_TITLE',						'タイトル');
try_define('_ADD_MORE',							'続き (空欄でも可)');
try_define('_ADD_CATEGORY',						'カテゴリー');
try_define('_ADD_PREVIEW',						'プレビュー');
try_define('_ADD_DISABLE_COMMENTS',				'コメントを受け付けない');
try_define('_ADD_DRAFTNFUTURE',					'ドラフトと未来の記事');
try_define('_ADD_ADDITEM',						'アイテムを追加');
try_define('_ADD_ADDNOW',						'今すぐ追加');
try_define('_ADD_PLACE_ON',						'日時:');
try_define('_ADD_ADDDRAFT',						'ドラフトに追加');
try_define('_ADD_NOPASTDATES',					'(過去の日時は指定できません。指定された場合は現在の日時が使用されます)');
try_define('_ADD_BOLD_TT',						'太字');
try_define('_ADD_ITALIC_TT',					'斜体');
try_define('_ADD_HREF_TT',						'リンク作成');
try_define('_ADD_MEDIA_TT',						'メディア(画像・音声)の追加');
try_define('_ADD_PREVIEW_TT',					'プレビューの表示/非表示');
try_define('_ADD_CUT_TT',						'カット');
try_define('_ADD_COPY_TT',						'コピー');
try_define('_ADD_PASTE_TT',						'ペースト');


// edit item form
try_define('_EDIT_ITEM',						'アイテムの編集');
try_define('_EDIT_SUBMIT',						'保存');
try_define('_EDIT_ORIG_AUTHOR',					'原作者');
try_define('_EDIT_BACKTODRAFTS',				'再度ドラフトとして保存');
try_define('_EDIT_COMMENTSNOTE',				'(注意: コメントの非表示は以前に追加されたコメントを隠しはしません)');

// used on delete screens
try_define('_DELETE_CONFIRM',					'削除の確認をしてください');
try_define('_DELETE_CONFIRM_BTN',				'削除の確認');
try_define('_CONFIRMTXT_ITEM',					'以下のアイテムを削除しようとしています:');
try_define('_CONFIRMTXT_COMMENT',				'以下のコメントを削除しようとしています:');
try_define('_CONFIRMTXT_TEAM1',					'このblogのチームリストから');
try_define('_CONFIRMTXT_TEAM2',					'削除しようとしています');
try_define('_CONFIRMTXT_BLOG',					'削除するBlog: ');
try_define('_WARNINGTXT_BLOGDEL',				'警告！ Blogを削除するとそれに含まれている全てのアイテム、コメントは削除されます。その点を確認した上で行ってください。<br />さらに、Blogの削除中にNucleusを中断させないでください。');
try_define('_CONFIRMTXT_MEMBER',				'以下のメンバープロファイルを削除しようとしています: ');
try_define('_CONFIRMTXT_TEMPLATE',				'次のテンプレートを削除しようとしています: ');
try_define('_CONFIRMTXT_SKIN',					'次のスキンを削除しようとしています: ');
try_define('_CONFIRMTXT_BAN',					'次の禁止IP範囲を削除しようとしています: ');
try_define('_CONFIRMTXT_CATEGORY',				'次のカテゴリーを削除しようとしています: ');

// some status messages
try_define('_DELETED_ITEM',						'アイテムが削除されました');
try_define('_DELETED_MEMBER',					'メンバーが削除されました');
try_define('_DELETED_COMMENT',					'コメントが削除されました');
try_define('_DELETED_BLOG',						'Blogが削除されました');
try_define('_DELETED_CATEGORY',					'カテゴリーが削除されました');
try_define('_ITEM_MOVED',						'アイテムが移動されました');
try_define('_ITEM_ADDED',						'アイテムが追加されました');
try_define('_COMMENT_UPDATED',					'コメントが更新されました');
try_define('_SKIN_UPDATED',						'スキンデータが保存されました');
try_define('_TEMPLATE_UPDATED',					'テンプレートデータが保存されました');

// errors
try_define('_ERROR_COMMENT_LONGWORD',			'コメントには半角で90文字以上の単語を使わないで下さい。');
try_define('_ERROR_COMMENT_NOCOMMENT',			'コメントを入力してください。');
try_define('_ERROR_COMMENT_NOUSERNAME',			'使用できない名前です。');
try_define('_ERROR_COMMENT_TOOLONG',			'コメントが長すぎます。(半角で5000文字まで)');
try_define('_ERROR_COMMENTS_DISABLED',			'現在このBlogではコメントを受け付けていません。');
try_define('_ERROR_COMMENTS_NONPUBLIC',			'このBlogへコメントを追加するにはメンバーとしてログインしなければいけません。');
try_define('_ERROR_COMMENTS_MEMBERNICK',		'使おうとした名前は既に使われています。他の名前を入力してください。');
try_define('_ERROR_SKIN',						'スキンエラー');
try_define('_ERROR_ITEMCLOSED',					'このアイテムは閲覧専用です。コメントの投稿、投票はできません。');
try_define('_ERROR_NOSUCHITEM',					'そのようなアイテムは存在しません。');
try_define('_ERROR_NOSUCHBLOG',					'そのようなBlogは存在しません。');
try_define('_ERROR_NOSUCHSKIN',					'そのようなスキンは存在しません。');
try_define('_ERROR_NOSUCHMEMBER',				'そのようなメンバーは存在しません。');
try_define('_ERROR_NOTONTEAM',					'あなたはこのBlogのチームに含まれていません。');
try_define('_ERROR_BADDESTBLOG',				'送り先のBlogが存在しません。');
try_define('_ERROR_NOTONDESTTEAM',				'あなたが送り先のBlogのチームに入っていないためアイテムを移動できません。');
try_define('_ERROR_NOEMPTYITEMS',				'本文が空のアイテムは投稿できません！');
try_define('_ERROR_BADMAILADDRESS',				'メールアドレスが不正です。');
try_define('_ERROR_BADNOTIFY',					'通知メールアドレスの中に不正なものが混じっています。');
try_define('_ERROR_BADNAME',					'使用できない名前です。( a-z 、0-9 の英数字しか使えません)');
try_define('_ERROR_NICKNAMEINUSE',				'他のメンバーが同じログインIDを使用しています。');
try_define('_ERROR_PASSWORDMISMATCH',			'入力されたパスワードが同一ではありません。');
try_define('_ERROR_PASSWORDTOOSHORT',			'パスワードは6文字以上でなければなりません。');
try_define('_ERROR_PASSWORDMISSING',			'パスワードが空です。');
try_define('_ERROR_REALNAMEMISSING',			'ハンドルを入力してください。');
try_define('_ERROR_ATLEASTONEADMIN',			'管理領域にログインできるsuper-adminが少なくとも1人はいなくてはいけません。');
try_define('_ERROR_ATLEASTONEBLOGADMIN',		'このアクションを実行するとサイトのメンテナンスができなくなります。少なくとも1人の管理者がいるようにしてください。');
try_define('_ERROR_ALREADYONTEAM',				'既にチームに入っています。');
try_define('_ERROR_BADSHORTBLOGNAME',			'Blogの短縮名(略称)には a-z 、0-9、の英数字のみ使用できます。スペースは使用できません。');
try_define('_ERROR_DUPSHORTBLOGNAME',			'他のBlogで同じ短縮名(略称)が使われています。別の短縮名(略称)を入力してください。');
try_define('_ERROR_UPDATEFILE',					'更新ファイルに書き込めません。ファイルのパーミッションが正しくセットされているか確認してください (chmod 666 を試してみてください)。もし相対パスで指定されているなら、絶対パスで指定してみてください。(/your/path/to/nucleus/ のように)');
try_define('_ERROR_DELDEFBLOG',					'既定のBlogは削除できません');
try_define('_ERROR_DELETEMEMBER',				'おそらくこのメンバーは１つ以上のアイテムの著者であるため、削除できません。');
try_define('_ERROR_BADTEMPLATENAME',			'不正なテンプレート名です。(a-z 、0-9 の英数字のみ使用可。スペースは使用不可)');
try_define('_ERROR_DUPTEMPLATENAME',			'同じ名前のテンプレートが既に存在します');
try_define('_ERROR_BADSKINNAME',				'不正なスキン名です。(a-z 、0-9 の英数字のみ使用可。スペースは使用不可)');
try_define('_ERROR_DUPSKINNAME',				'同じ名前のスキンが既に存在します。');
try_define('_ERROR_DEFAULTSKIN',				'このスキンは標準のスキンに設定されているため削除できません。');
try_define('_ERROR_SKINDEFDELETE',				'以下のBlogの既定のスキンに指定されているため、スキンを削除できません。: ');
try_define('_ERROR_DISALLOWED',					'このアクションの実行が許可されていません。');
try_define('_ERROR_DELETEBAN',					'禁止者の削除中にエラーが発生しました(禁止者が存在しません)');
try_define('_ERROR_ADDBAN',						'禁止者の追加中にエラーが発生しました。全てのblogに正しく追加されていないかもしれません。');
try_define('_ERROR_BADACTION',					'要求されたアクションが存在しません。');
try_define('_ERROR_MEMBERMAILDISABLED',			'メンバー間のメールメッセージが使用不可になっています。');
try_define('_ERROR_MEMBERCREATEDISABLED',		'メンバー作成が禁止されています。');
try_define('_ERROR_INCORRECTEMAIL',				'不正なメールアドレスです。');
try_define('_ERROR_VOTEDBEFORE',				'このアイテムには既に投票済みです。');
try_define('_ERROR_BANNED1',					'あなた (IP範囲 ');
try_define('_ERROR_BANNED2',					') はこのアクションの実行が禁止されています。メッセージ: \'');
try_define('_ERROR_BANNED3',					'\'');
try_define('_ERROR_LOGINNEEDED',				'実行するにはログインが必要です。');
try_define('_ERROR_CONNECT',					'接続エラー');
try_define('_ERROR_FILE_TOO_BIG',				'ファイルが大きすぎます！');
try_define('_ERROR_BADFILETYPE',				'アップロードが認められていないファイルタイプです。');
try_define('_ERROR_BADREQUEST',					'不正なアップロード要求です');
try_define('_ERROR_DISALLOWEDUPLOAD',			'どのBlogチームにも入っていないためファイルをアップロードできません。');
try_define('_ERROR_BADPERMISSIONS',				'ファイル/ディレクトリのパーミッションが正しくセットされていません。');
try_define('_ERROR_UPLOADMOVEP',				'アップロードファイルの移動中にエラーが発生しました。');
try_define('_ERROR_UPLOADCOPY',					'ファイルのコピー中にエラーが発生しました。');
try_define('_ERROR_UPLOADDUPLICATE',			'同じ名前のファイルが既に存在します。アップロードする前に名前を変更してしてください。');
try_define('_ERROR_LOGINDISALLOWED',			'管理領域へのログインが認められていません。もし管理ユーザーのアカウントを持っているのなら、管理ユーザーとしてログインしなおしてください。');
try_define('_ERROR_DBCONNECT',					'MySQLサーバに接続できません');
try_define('_ERROR_DBSELECT',					'Nucleusが使用するデータベースを選択できません。');
try_define('_ERROR_NOSUCHLANGUAGE',				'指定された言語ファイルは存在しません。');
try_define('_ERROR_NOSUCHCATEGORY',				'指定されたカテゴリーは存在しません。');
try_define('_ERROR_DELETELASTCATEGORY',			'カテゴリーを最低一つは設定してください。');
try_define('_ERROR_DELETEDEFCATEGORY',			'既定のカテゴリーは削除できません。');
try_define('_ERROR_BADCATEGORYNAME',			'カテゴリー名として使えません');
try_define('_ERROR_DUPCATEGORYNAME',			'同じ名前のカテゴリーが既に存在します。');

// some warnings (used for mediadir setting)
try_define('_WARNING_NOTADIR',					'警告: ディレクトリではありません！');
try_define('_WARNING_NOTREADABLE',				'警告: 読み取り不可能なディレクトリです！');
try_define('_WARNING_NOTWRITABLE',				'警告: 書き込み不可能なディレクトリです！');

// media and upload
try_define('_MEDIA_UPLOADLINK',					'ファイルのアップロード');
try_define('_MEDIA_MODIFIED',					'更新日');
try_define('_MEDIA_FILENAME',					'ファイル名');
try_define('_MEDIA_DIMENSIONS',					'サイズ');
try_define('_MEDIA_INLINE',						'埋め込み型');
try_define('_MEDIA_POPUP',						'ポップアップ型');
try_define('_UPLOAD_TITLE',						'ファイル選択');
try_define('_UPLOAD_MSG',						'アップロードするファイルを選択して「アップロード」ボタンを押してください');
try_define('_UPLOAD_BUTTON',					'アップロード');

// some status messages
//define('_MSG_ACCOUNTCREATED',				'アカウントが作成されました。パスワードがメールで送信されます');
//define('_MSG_PASSWORDSENT',				'パスワードがメールで送信されました。');
try_define('_MSG_LOGINAGAIN',					'アカウント情報が変更されたため、ログインしなおす必要があります');
try_define('_MSG_SETTINGSCHANGED',				'設定が変更されました');
try_define('_MSG_ADMINCHANGED',					'管理者権限が変更されました');
try_define('_MSG_NEWBLOG',						'新しいBlogが作成されました');
try_define('_MSG_ACTIONLOGCLEARED',				'管理操作履歴が消去されました');

// actionlog in admin area
try_define('_ACTIONLOG_DISALLOWED',				'許可されていないアクション: ');
try_define('_ACTIONLOG_PWDREMINDERSENT',		'新しいパスワードの送信先: ');
try_define('_ACTIONLOG_TITLE',					'管理操作履歴');
try_define('_ACTIONLOG_CLEAR_TITLE',			'管理操作履歴の消去');
try_define('_ACTIONLOG_CLEAR_TEXT',				'管理操作履歴を今すぐ消去');

// team management
try_define('_TEAM_TITLE',						'Blogのチームを管理する ');
try_define('_TEAM_CURRENT',						'現在のチームメンバー');
try_define('_TEAM_ADDNEW',						'チームに新しいメンバーを追加する');
try_define('_TEAM_CHOOSEMEMBER',				'メンバーを選ぶ');
try_define('_TEAM_ADMIN',						'管理者権限を与える ');
try_define('_TEAM_ADD',							'チームに追加');
try_define('_TEAM_ADD_BTN',						'チームに追加');

// blogsettings
try_define('_EBLOG_TITLE',						'Blog設定の編集');
try_define('_EBLOG_TEAM_TITLE',					'チームの管理');
try_define('_EBLOG_TEAM_TEXT',					'チームの管理...');
try_define('_EBLOG_SETTINGS_TITLE',				'Blog設定');
try_define('_EBLOG_NAME',						'Blogの名前');
try_define('_EBLOG_SHORTNAME',					'Blogの短縮名(略称)');
try_define('_EBLOG_SHORTNAME_EXTRA',			'<br />(a-zの英小文字のみが使用できます。空白は使用できません)');
try_define('_EBLOG_DESC',						'Blogの説明');
try_define('_EBLOG_URL',						'BlogのURL');
try_define('_EBLOG_DEFSKIN',					'Blogの標準のスキン');
try_define('_EBLOG_DEFCAT',						'Blogの標準のカテゴリ');
try_define('_EBLOG_LINEBREAKS',					'アイテムの改行を変換する');
try_define('_EBLOG_DISABLECOMMENTS',			'コメントを受け付ける<br /><small>(コメントを禁止するとコメントの追加はできなくなります。)</small>');
try_define('_EBLOG_ANONYMOUS',					'メンバー以外のコメントを受け付ける');
try_define('_EBLOG_NOTIFY',						'通知するメールアドレス ( ; で区切ってください)');
try_define('_EBLOG_NOTIFY_ON',					'以下を通知する');
try_define('_EBLOG_NOTIFY_COMMENT',				'新しいコメント');
try_define('_EBLOG_NOTIFY_KARMA',				'新しいカルマ投票');
try_define('_EBLOG_NOTIFY_ITEM',				'新しいBlogアイテム');
try_define('_EBLOG_PING',						'更新時にBlog検索サービスに更新を通知する'); // NOTE: This string is no longer in used
try_define('_EBLOG_MAXCOMMENTS',				'一覧に表示するコメントの最大数');
try_define('_EBLOG_UPDATE',						'自動更新するファイル');
try_define('_EBLOG_OFFSET',						'サーバ時刻との時差');
try_define('_EBLOG_STIME',						'現在のサーバ時刻: ');
try_define('_EBLOG_BTIME',						'現在のBlog時刻: ');
try_define('_EBLOG_CHANGE',						'設定の変更');
try_define('_EBLOG_CHANGE_BTN',					'設定の変更');
try_define('_EBLOG_ADMIN',						'Blog管理者権限');
try_define('_EBLOG_ADMIN_MSG',					'あなたには管理者権限が割り当てられます');
try_define('_EBLOG_CREATE_TITLE',				'新しいBlogの作成');
try_define('_EBLOG_CREATE_TEXT',				'新しいBlogを作成するために以下のフォームを埋めてください。<br /><br /> <b>注意:</b> 必要なオプションのみが表示されています。追加のオプションを設定したい場合はBlogを作成した後、Blog設定ページで設定してください。');
try_define('_EBLOG_CREATE',						'作成！');
try_define('_EBLOG_CREATE_BTN',					'Blogを作成');
try_define('_EBLOG_CAT_TITLE',					'カテゴリー');
try_define('_EBLOG_CAT_NAME',					'カテゴリー名');
try_define('_EBLOG_CAT_DESC',					'カテゴリーの説明');
try_define('_EBLOG_CAT_CREATE',					'新しいカテゴリーを作る');
try_define('_EBLOG_CAT_UPDATE',					'カテゴリーの更新');
try_define('_EBLOG_CAT_UPDATE_BTN',				'カテゴリーを更新');

// templates
try_define('_TEMPLATE_TITLE',					'テンプレートの編集');
try_define('_TEMPLATE_AVAILABLE_TITLE',			'使用可能なテンプレート');
try_define('_TEMPLATE_NEW_TITLE',				'新しいテンプレート');
try_define('_TEMPLATE_NAME',					'テンプレート名');
try_define('_TEMPLATE_DESC',					'テンプレートの説明');
try_define('_TEMPLATE_CREATE',					'テンプレートの作成');
try_define('_TEMPLATE_CREATE_BTN',				'テンプレートを作成');
try_define('_TEMPLATE_EDIT_TITLE',				'テンプレートの編集');
try_define('_TEMPLATE_BACK',					'テンプレートの一覧に戻る');
try_define('_TEMPLATE_EDIT_MSG',				'全てのテンプレートパーツが必要な訳ではありません。必要ない場合は空欄のままにしておいてください。');
try_define('_TEMPLATE_SETTINGS',				'テンプレート設定');
try_define('_TEMPLATE_ITEMS',					'アイテム');
try_define('_TEMPLATE_ITEMHEADER',				'アイテムのヘッダー');
try_define('_TEMPLATE_ITEMBODY',				'アイテムの本体');
try_define('_TEMPLATE_ITEMFOOTER',				'アイテムのフッター');
try_define('_TEMPLATE_MORELINK',				'続きへのリンク');
try_define('_TEMPLATE_NEW',						'新しいアイテムに付けるマーク');
try_define('_TEMPLATE_COMMENTS_ANY',			'コメント (ある場合)');
try_define('_TEMPLATE_CHEADER',					'コメントのヘッダー');
try_define('_TEMPLATE_CBODY',					'コメントの本体');
try_define('_TEMPLATE_CFOOTER',					'コメントのフッター');
try_define('_TEMPLATE_CONE',					'コメントが1つの時');
try_define('_TEMPLATE_CMANY',					'コメントが2つ以上の時');
try_define('_TEMPLATE_CMORE',					'コメントの続きを読む');
try_define('_TEMPLATE_CMEXTRA',					'登録メンバーからのコメントへの追加表示');
try_define('_TEMPLATE_COMMENTS_NONE',			'コメント (無い場合)');
try_define('_TEMPLATE_CNONE',					'コメントが無い時');
try_define('_TEMPLATE_COMMENTS_TOOMUCH',		'コメント (最大表示数より多い場合)');
try_define('_TEMPLATE_CTOOMUCH',				'コメントが多すぎる時');
try_define('_TEMPLATE_ARCHIVELIST',				'アーカイブ一覧');
try_define('_TEMPLATE_AHEADER',					'アーカイブ一覧のヘッダー');
try_define('_TEMPLATE_AITEM',					'アーカイブ一覧の本体');
try_define('_TEMPLATE_AFOOTER',					'アーカイブ一覧のフッター');
try_define('_TEMPLATE_DATETIME',				'日付と時刻');
try_define('_TEMPLATE_DHEADER',					'日付のヘッダー');
try_define('_TEMPLATE_DFOOTER',					'日付のフッター');
try_define('_TEMPLATE_DFORMAT',					'日付フォーマット');
try_define('_TEMPLATE_TFORMAT',					'時刻フォーマット');
try_define('_TEMPLATE_LOCALE',					'ロケール');
try_define('_TEMPLATE_IMAGE',					'画像とメディアのポップアップ');
try_define('_TEMPLATE_PCODE',					'ポップアップ画像へのリンクコード');
try_define('_TEMPLATE_ICODE',					'インライン画像のコード');
try_define('_TEMPLATE_MCODE',					'メディアオブジェクトへのリンクコード');
try_define('_TEMPLATE_SEARCH',					'検索');
try_define('_TEMPLATE_SHIGHLIGHT',				'ハイライト表示');
try_define('_TEMPLATE_SNOTFOUND',				'検索で何も見つからなかった場合');
try_define('_TEMPLATE_UPDATE',					'更新');
try_define('_TEMPLATE_UPDATE_BTN',				'テンプレートの更新');
try_define('_TEMPLATE_RESET_BTN',				'リセット');
try_define('_TEMPLATE_CATEGORYLIST',			'カテゴリー一覧');
try_define('_TEMPLATE_CATHEADER',				'カテゴリー一覧のヘッダー');
try_define('_TEMPLATE_CATITEM',					'カテゴリー一覧の本体');
try_define('_TEMPLATE_CATFOOTER',				'カテゴリー一覧のフッター');

// skins
try_define('_SKIN_EDIT_TITLE',					'スキンの編集');
try_define('_SKIN_AVAILABLE_TITLE',				'使用可能なスキン');
try_define('_SKIN_NEW_TITLE',					'新しいスキン');
try_define('_SKIN_NAME',						'名前');
try_define('_SKIN_DESC',						'説明');
try_define('_SKIN_TYPE',						'Content Type');
try_define('_SKIN_CREATE',						'作成');
try_define('_SKIN_CREATE_BTN',					'スキンの作成');
try_define('_SKIN_EDITONE_TITLE',				'スキンの編集');
try_define('_SKIN_BACK',						'スキンの一覧に戻る');
try_define('_SKIN_PARTS_TITLE',					'スキンパーツ');
try_define('_SKIN_PARTS_MSG',					'それぞれのスキンに全てのタイプが必要とは限りません。必要ない場合は空欄のままにしておいてください。以下から編集するスキンを選んでください:');
try_define('_SKIN_PART_MAIN',					'メインの目次ページ');
try_define('_SKIN_PART_ITEM',					'個別アイテムページ');
try_define('_SKIN_PART_ALIST',					'月別アーカイブ一覧ページ');
try_define('_SKIN_PART_ARCHIVE',				'月別アーカイブページ');
try_define('_SKIN_PART_SEARCH',					'検索ページ');
try_define('_SKIN_PART_ERROR',					'エラーページ');
try_define('_SKIN_PART_MEMBER',					'メンバー詳細ページ');
try_define('_SKIN_PART_POPUP',					'画像ポップアップウィンドウ');
try_define('_SKIN_GENSETTINGS_TITLE',			'一般設定');
try_define('_SKIN_CHANGE',						'変更');
try_define('_SKIN_CHANGE_BTN',					'設定の変更');
try_define('_SKIN_UPDATE_BTN',					'スキンの更新');
try_define('_SKIN_RESET_BTN',					'リセット');
try_define('_SKIN_EDITPART_TITLE',				'スキンの編集');
try_define('_SKIN_GOBACK',						'戻る');
try_define('_SKIN_ALLOWEDVARS',					'使用可能な変数 (クリックで説明表示):');

// global settings
try_define('_SETTINGS_TITLE',					'グローバル設定');
try_define('_SETTINGS_SUB_GENERAL',				'グローバル設定');
try_define('_SETTINGS_DEFBLOG',					'既定のBlog');
try_define('_SETTINGS_ADMINMAIL',				'管理者のメールアドレス');
try_define('_SETTINGS_SITENAME',				'サイト名');
try_define('_SETTINGS_SITEURL',					'サイトのURL (最後にスラッシュ "/" を付けてください)');
try_define('_SETTINGS_ADMINURL',				'管理者領域のURL (最後にスラッシュ "/" を付けてください)');
try_define('_SETTINGS_DIRS',					'Nucleusディレクトリ');
try_define('_SETTINGS_MEDIADIR',				'メディア(画像・音声)がアップロードされるディレクトリ');
try_define('_SETTINGS_SEECONFIGPHP',			'(config.php を参照)');
try_define('_SETTINGS_MEDIAURL',				'メディアURL (最後にスラッシュ "/" を付けてください)');
try_define('_SETTINGS_ALLOWUPLOAD',				'ファイルのアップロードを可能にする');
try_define('_SETTINGS_ALLOWUPLOADTYPES',		'アップロードを許可するファイルタイプ');
try_define('_SETTINGS_CHANGELOGIN',				'メンバーによるログイン名/パスワードの変更を可能にする');
try_define('_SETTINGS_COOKIES_TITLE',			'Cookie 設定');
try_define('_SETTINGS_COOKIELIFE',				'ログイン Cookie の有効期間');
try_define('_SETTINGS_COOKIESESSION',			'セッションごと');
try_define('_SETTINGS_COOKIEMONTH',				'一ヶ月');
try_define('_SETTINGS_COOKIEPATH',				'Cookie パス (上級オプション)');
try_define('_SETTINGS_COOKIEDOMAIN',			'Cookie ドメイン (上級オプション)');
try_define('_SETTINGS_COOKIESECURE',			'セキュア Cookie (上級オプション)');
try_define('_SETTINGS_LASTVISIT',				'最終訪問日時をCookieに保存する');
try_define('_SETTINGS_ALLOWCREATE',				'ビジターによるメンバーアカウント作成を可能にする');
try_define('_SETTINGS_NEWLOGIN',				'ビジターが作成したアカウントでのログインを<br />作成直後に可能にする');
try_define('_SETTINGS_NEWLOGIN2',				'(新しく作成されたアカウントのみ)');
try_define('_SETTINGS_MEMBERMSGS',				'メンバー間サービスを可能にする');
try_define('_SETTINGS_LANGUAGE',				'使用する言語');
try_define('_SETTINGS_DISABLESITE',				'サイトを閉鎖し、指定のURLに転送する（非常時用）');
try_define('_SETTINGS_DBLOGIN',					'MySQL ログイン &amp; データベース');
try_define('_SETTINGS_UPDATE',					'設定の更新');
try_define('_SETTINGS_UPDATE_BTN',				'設定を更新');
try_define('_SETTINGS_DISABLEJS',				'JavaScriptツールバーを無効にする');
try_define('_SETTINGS_MEDIA',					'メディア/アップロード設定');
try_define('_SETTINGS_MEDIAPREFIX',				'アップロードするファイル名の頭に日付を付加する');
try_define('_SETTINGS_MEMBERS',					'メンバー設定');

// bans
try_define('_BAN_TITLE',						'制限IPアドレスのリスト:');
try_define('_BAN_NONE',							'このBlogはアクセス制限されていません');
try_define('_BAN_NEW_TITLE',					'制限するIPアドレスの追加');
try_define('_BAN_NEW_TEXT',						'今すぐ制限アドレスを追加する');
try_define('_BAN_REMOVE_TITLE',					'アクセス制限の解除');
try_define('_BAN_IPRANGE',						'アクセス制限するIPアドレスの範囲');
try_define('_BAN_BLOGS',						'アクセス制限するBlog: ');
try_define('_BAN_DELETE_TITLE',					'アクセス制限の解除');
try_define('_BAN_ALLBLOGS',						'あなたが管理者権限を持つ全てのBlog');
try_define('_BAN_REMOVED_TITLE',				'アクセス制限を解除しました');
try_define('_BAN_REMOVED_TEXT',					'以下のBlogのアクセス制限を解除しました:');
try_define('_BAN_ADD_TITLE',					'制限するIPアドレスの追加');
try_define('_BAN_IPRANGE_TEXT',					'以下にブロックしたいIPアドレスを入力してください。');
try_define('_BAN_BLOGS_TEXT',					'1つのBlogのみで制限するか、あなたが管理者権限を持つ全てのBlogで制限するかを選択することができます。以下から選んでください。');
try_define('_BAN_REASON_TITLE',					'理由');
try_define('_BAN_REASON_TEXT',					'制限中のIPアドレスの範囲内のHOSTからコメントを投稿したりカルマ投票をしようとしたときに表示される制限理由を書いておくことができます (上限256文字)。');
try_define('_BAN_ADD_BTN',						'制限するIPアドレスの追加');

// LOGIN screen
try_define('_LOGIN_MESSAGE',					'メッセージ');
try_define('_LOGIN_SHARED',						_LOGINFORM_SHARED);
try_define('_LOGIN_FORGOT',						'パスワードを忘れた');

// membermanagement
try_define('_MEMBERS_TITLE',					'メンバーの管理');
try_define('_MEMBERS_CURRENT',					'現在のメンバー');
try_define('_MEMBERS_NEW',						'新しいメンバーの追加');
try_define('_MEMBERS_DISPLAY',					'表示される名前(ログインID)');
try_define('_MEMBERS_DISPLAY_INFO',				'(この名前はログイン時に使われます)');
try_define('_MEMBERS_REALNAME',					'ハンドルネーム');
try_define('_MEMBERS_PWD',						'パスワード');
try_define('_MEMBERS_REPPWD',					'パスワード（確認）');
try_define('_MEMBERS_EMAIL',					'メールアドレス');
try_define('_MEMBERS_EMAIL_EDIT',				'(メールアドレスを変更すると<br />そのアドレスへ自動的に新しいパスワードが送信されます)');
try_define('_MEMBERS_URL',						'Web siteアドレス (URL)');
try_define('_MEMBERS_SUPERADMIN',				'Super-admin(最高管理)権限を与える');
try_define('_MEMBERS_CANLOGIN',					'管理者領域へのログインを可能にする');
try_define('_MEMBERS_NOTES',					'備考');
try_define('_MEMBERS_NEW_BTN',					'メンバーの追加');
try_define('_MEMBERS_EDIT',						'メンバーの編集');
try_define('_MEMBERS_EDIT_BTN',					'設定の変更');
try_define('_MEMBERS_BACKTOOVERVIEW',			'メンバーの一覧に戻る');
try_define('_MEMBERS_DEFLANG',					'使用する言語');
try_define('_MEMBERS_USESITELANG',				'- グローバル設定を使う -');

// List of blogs (TT = tooltip)
try_define('_BLOGLIST_TT_VISIT',				'サイトを見る');
try_define('_BLOGLIST_ADD',						'アイテムの追加');
try_define('_BLOGLIST_TT_ADD',					'このBlogに新しいアイテムを追加します');
try_define('_BLOGLIST_EDIT',					'アイテムの編集/削除');
try_define('_BLOGLIST_TT_EDIT',					'公開済みのアイテムを編集と削除');
try_define('_BLOGLIST_BMLET',					'ブックマークレット');
try_define('_BLOGLIST_TT_BMLET',				'ブックマークレットのインストール');
try_define('_BLOGLIST_SETTINGS',				'ブログ設定');
try_define('_BLOGLIST_TT_SETTINGS',				'ブログの設定とブログチームの管理');
try_define('_BLOGLIST_BANS',					'アクセス制限');
try_define('_BLOGLIST_TT_BANS',					'アクセス制限の確認/追加/削除');
try_define('_BLOGLIST_DELETE',					'全て削除');
try_define('_BLOGLIST_TT_DELETE',				'このBlogを削除');

// OVERVIEW screen
try_define('_OVERVIEW_YRBLOGS',					'あなたのBlog');
try_define('_OVERVIEW_YRDRAFTS',				'ドラフト(下書き)');
try_define('_OVERVIEW_YRSETTINGS',				'設定');
try_define('_OVERVIEW_GSETTINGS',				'基本設定');
try_define('_OVERVIEW_NOBLOGS',					'あなたはどのBlogチームリストにも入っていません');
try_define('_OVERVIEW_NODRAFTS',				'ドラフト(下書き中)の記事はありません');
try_define('_OVERVIEW_EDITSETTINGS',			'あなたの設定');
try_define('_OVERVIEW_BROWSEITEMS',				'あなたのアイテム');
try_define('_OVERVIEW_BROWSECOMM',				'あなたのコメント');
try_define('_OVERVIEW_VIEWLOG',					'管理操作履歴');
try_define('_OVERVIEW_MEMBERS',					'メンバー管理');
try_define('_OVERVIEW_NEWLOG',					'新規Blog作成');
try_define('_OVERVIEW_SETTINGS',				'グローバル設定');
try_define('_OVERVIEW_TEMPLATES',				'テンプレート編集');
try_define('_OVERVIEW_SKINS',					'スキン編集');
try_define('_OVERVIEW_BACKUP',					'DB保存/復元');

// ITEMLIST
try_define('_ITEMLIST_BLOG',							'Blogアイテムの編集: ');
try_define('_ITEMLIST_YOUR',							'あなたのアイテム');

// Comments
try_define('_COMMENTS',									'コメント');
try_define('_NOCOMMENTS',								'このアイテムへのコメントはありません');
try_define('_COMMENTS_YOUR',							'コメント一覧');
try_define('_NOCOMMENTS_YOUR',							'コメントはありません');

// LISTS (general)
try_define('_LISTS_NOMORE',								'何もありません');
try_define('_LISTS_PREV',								'前へ');
try_define('_LISTS_NEXT',								'次へ');
try_define('_LISTS_SEARCH',								'検索');
try_define('_LISTS_CHANGE',								'変更');
try_define('_LISTS_PERPAGE',							'アイテム/ページ');
try_define('_LISTS_ACTIONS',							'アクション');
try_define('_LISTS_DELETE',								'削除');
try_define('_LISTS_EDIT',								'編集');
try_define('_LISTS_MOVE',								'移動');
try_define('_LISTS_CLONE',								'複製');
try_define('_LISTS_TITLE',								'タイトル');
try_define('_LISTS_BLOG',								'Blog');
try_define('_LISTS_NAME',								'名前');
try_define('_LISTS_DESC',								'説明');
try_define('_LISTS_TIME',								'時間');
try_define('_LISTS_COMMENTS',							'コメント');
try_define('_LISTS_TYPE',								'タイプ');


// member list
try_define('_LIST_MEMBER_NAME',							'表示される名前(ログインID)');
try_define('_LIST_MEMBER_RNAME',						'ハンドルネーム');
try_define('_LIST_MEMBER_ADMIN',						'Super-admin権限 ');
try_define('_LIST_MEMBER_LOGIN',						'ログイン可能');
try_define('_LIST_MEMBER_URL',							'ウェブサイト');

// banlist
try_define('_LIST_BAN_IPRANGE',							'制限中のIPアドレスの範囲');
try_define('_LIST_BAN_REASON',							'制限の理由');

// actionlist
try_define('_LIST_ACTION_MSG',							'メッセージ');

// commentlist
try_define('_LIST_COMMENT_BANIP',						'IPアドレスを制限');
try_define('_LIST_COMMENT_WHO',							'作者');
try_define('_LIST_COMMENT',								'コメント');
try_define('_LIST_COMMENT_HOST',						'ホスト');

// itemlist
try_define('_LIST_ITEM_INFO',							'情報');
try_define('_LIST_ITEM_CONTENT',						'タイトルと本文');


// teamlist
try_define('_LIST_TEAM_ADMIN',							'管理者権限 ');
try_define('_LIST_TEAM_CHADMIN',						'管理者権限の変更');

// edit comments
try_define('_EDITC_TITLE',								'コメントの編集');
try_define('_EDITC_WHO',								'作者');
try_define('_EDITC_HOST',								'ホスト');
try_define('_EDITC_WHEN',								'日時');
try_define('_EDITC_TEXT',								'本文');
try_define('_EDITC_EDIT',								'コメントの編集');
try_define('_EDITC_MEMBER',								'メンバー');
try_define('_EDITC_NONMEMBER',							'非メンバー');

// move item
try_define('_MOVE_TITLE',								'どのBlogに移動しますか？');
try_define('_MOVE_BTN',									'アイテムを移動する');

