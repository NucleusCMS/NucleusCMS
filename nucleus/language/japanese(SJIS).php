<?
// Japanese Nucleus Language File
// 
// Author: chrome (chrome@cgi.no-ip.org)
// Nucleus version: v1.0-v2.0 (v2.0beta/January 18, 2003)
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'過去への投稿を許可する');
define('_ADD_CHANGEDATE',			'タイムスタンプを更新');
define('_BMLET_CHANGEDATE',			'タイムスタンプを更新');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'スキンの import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
define('_SKIN_INCLUDE_MODE',		'Include モード');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'ベース skin');
define('_SETTINGS_SKINSURL',		'スキンURL');
define('_SETTINGS_ACTIONSURL',		'action.php へのフルURL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'defaultカテゴリーは移動できません');
define('_ERROR_MOVETOSELF',			'カテゴリーを移動できません (移動先のblogが移動元と同じです)');
define('_MOVECAT_TITLE',			'カテゴリーを移動するblogを選択してください');
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
define('_BATCH_ONCATEGORY',			'on カテゴリー');
define('_BATCH_ONITEM',				'on アイテム');
define('_BATCH_ONCOMMENT',			'on コメント');
define('_BATCH_ONMEMBER',			'on メンバー');
define('_BATCH_ONTEAM',				'on チームメンバー');
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
define('_BATCH_CAT_MOVE',			'他のblogに移動');
define('_BATCH_COMMENT_DELETE',		'削除');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'新しいアイテムの追加...');
define('_ADD_PLUGIN_EXTRAS',		'追加Pluginオプション');

// errors
define('_ERROR_CATCREATEFAIL',		'新しいカテゴリーを作成できません');
define('_ERROR_NUCLEUSVERSIONREQ',	'このプラグインは新しいバージョンの Nucleus が必要です: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'blogセッティングに戻る');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'選択されたスキン/テンプレートを Export');
define('_SKINIE_LOCAL',				'ローカルファイルから Import :');
define('_SKINIE_NOCANDIDATES',		'skinsディレクトリ内に import 候補が見つかりません');
define('_SKINIE_FROMURL',			'URL から Import :');
define('_SKINIE_EXPORT_INTRO',		'下から export するスキン/テンプレートを選択してください');
define('_SKINIE_EXPORT_SKINS',		'スキン');
define('_SKINIE_EXPORT_TEMPLATES',	'テンプレート');
define('_SKINIE_EXPORT_EXTRA',		'追加情報');
define('_SKINIE_CONFIRM_OVERWRITE',	'既に存在するスキンを上書きする (nameclashes を参照)');
define('_SKINIE_CONFIRM_IMPORT',	'はい、これをimportします');
define('_SKINIE_CONFIRM_TITLE',		'スキンとテンプレートをimportしようとしています');
define('_SKINIE_INFO_SKINS',		'ファイル内のスキン:');
define('_SKINIE_INFO_TEMPLATES',	'ファイル内のテンプレート:');
define('_SKINIE_INFO_GENERAL',		'情報:');
define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
define('_SKINIE_INFO_IMPORTEDSKINS','Import されたスキン:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Import されたテンプレート:');
define('_SKINIE_DONE',				'Import 完了');

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
define('_NOTIFY_KV_MSG',			'Karma vote on item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'アイテムにコメントする:');
define('_NOTIFY_NC_TITLE',			'Nucleusコメント:');
define('_NOTIFY_USERID',			'ユーザーID:');
define('_NOTIFY_USER',				'ユーザー:');
define('_NOTIFY_COMMENT',			'コメント:');
define('_NOTIFY_VOTE',				'投票:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'メンバー:');
define('_NOTIFY_TITLE',				'タイトル:');
define('_NOTIFY_CONTENTS',			'コンテンツ:');

// member mail message
define('_MMAIL_MSG',				'A message sent to you by');
define('_MMAIL_FROMANON',			'an anonymous visitor');
define('_MMAIL_FROMNUC',			'Posted from a Nucleus weblog at');
define('_MMAIL_TITLE',				'A message from');
define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'アイテムの追加');
define('_BMLET_EDIT',				'アイテムの編集');
define('_BMLET_DELETE',				'アイテムの削除');
define('_BMLET_BODY',				'本文');
define('_BMLET_MORE',				'拡張');
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
define('_BACKTOOVERVIEW',			'概要に戻る');

// editlink
define('_TEMPLATE_EDITLINK',		'アイテムリンクの編集');

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
define('_OVERVIEW_PLUGINS',			'プラグインの管理...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'新しいメンバーの登録:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'あなたのe-mailアドレス:');

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
define('_LIST_PLUGS_UNINSTALL',		'アンインストール');
define('_LIST_PLUGS_ADMIN',			'管理');
define('_LIST_PLUGS_OPTIONS',		'編集&nbsp;オプション');

// plugin option list
define('_LISTS_VALUE',				'値');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'このプラグインのオプションはありません');
define('_PLUGS_BACK',				'プラグインの概要に戻る');
define('_PLUGS_SAVE',				'オプションの保存');
define('_PLUGS_OPTIONS_UPDATED',	'プラグインオプションが更新されました');

define('_OVERVIEW_MANAGEMENT',		'管理');
define('_OVERVIEW_MANAGE',			'Nucleusの管理...');
define('_MANAGE_GENERAL',			'管理');
define('_MANAGE_SKINS',				'スキン/テンプレート');
define('_MANAGE_EXTRA',				'追加機能\');

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
define('_COMMENTFORM_YOUARE',		'You are: ');
define('_COMMENTFORM_SUBMIT',		'コメントを追加');
define('_COMMENTFORM_COMMENT',		'comment');
define('_COMMENTFORM_NAME',			'Name');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'情報を記憶しておく');

// loginform
define('_LOGINFORM_NAME',			'ユーザー名');
define('_LOGINFORM_PWD',			'パスワード');
define('_LOGINFORM_YOUARE',			'Logged in as');
define('_LOGINFORM_SHARED',			'Shared Computer');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'メッセージ送信');

// search form
define('_SEARCHFORM_SUBMIT',		'検索');

// add item form
define('_ADD_ADDTO',				'アイテムの追加:');
define('_ADD_CREATENEW',			'新しいアイテム');
define('_ADD_BODY',					'本文');
define('_ADD_TITLE',				'タイトル');
define('_ADD_MORE',					'拡張 (optional)');
define('_ADD_CATEGORY',				'カテゴリー');
define('_ADD_PREVIEW',				'プレビュー');
define('_ADD_DISABLE_COMMENTS',		'コメントを無効にしますか?');
define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
define('_ADD_ADDITEM',				'アイテムを追加');
define('_ADD_ADDNOW',				'今すぐ追加');
define('_ADD_ADDLATER',				'後で追加');
define('_ADD_PLACE_ON',				'日時:');
define('_ADD_ADDDRAFT',				'ドラフトに追加');
define('_ADD_NOPASTDATES',			'(過去の日時は指定できません。指定された場合は現在の日時が使用されます)');
define('_ADD_BOLD_TT',				'太字');
define('_ADD_ITALIC_TT',			'斜体');
define('_ADD_HREF_TT',				'リンク作成');
define('_ADD_MEDIA_TT',				'Mediaの追加');
define('_ADD_PREVIEW_TT',			'プレビューの表示/非表示');
define('_ADD_CUT_TT',				'カット');
define('_ADD_COPY_TT',				'コピー');
define('_ADD_PASTE_TT',				'ペースト');


// edit item form
define('_EDIT_ITEM',				'アイテムの編集');
define('_EDIT_SUBMIT',				'アイテムの編集');
define('_EDIT_ORIG_AUTHOR',			'原作者');
define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
define('_EDIT_COMMENTSNOTE',		'(注意: コメントの非表示は以前に追加されたコメントを隠しはしません)');

// used on delete screens
define('_DELETE_CONFIRM',			'削除の確認をしてください');
define('_DELETE_CONFIRM_BTN',		'削除の確認');
define('_CONFIRMTXT_ITEM',			'以下のアイテムを削除しようとしています:');
define('_CONFIRMTXT_COMMENT',		'以下のコメントを削除しようとしています:');
define('_CONFIRMTXT_TEAM1',			'このblogのチームリストから');
define('_CONFIRMTXT_TEAM2',			'削除しようとしています');
define('_CONFIRMTXT_BLOG',			'削除するblog: ');
define('_WARNINGTXT_BLOGDEL',		'警告! blogを削除するとそれに含まれている全てのアイテム、コメントは削除されます。その点を確認した上で行ってください。<br />さらに、blogの削除中にNucleusを中断させないでください。');
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
define('_ERROR_NOSUCHBLOG',			'そのようなblogは存在しません');
define('_ERROR_NOSUCHSKIN',			'そのようなスキンは存在しません');
define('_ERROR_NOSUCHMEMBER',		'そのようなメンバーは存在しません');
define('_ERROR_NOTONTEAM',			'あなたはこのweblogのチームリストに含まれていません');
define('_ERROR_BADDESTBLOG',		'送り先のblogが存在しません');
define('_ERROR_NOTONDESTTEAM',		'あなたが送り先のblogのチームリストに入っていないため、アイテムを移動できません');
define('_ERROR_NOEMPTYITEMS',		'空のアイテムは追加できません!');
define('_ERROR_BADMAILADDRESS',		'Emailアドレスが不正です');
define('_ERROR_BADNOTIFY',			'与えられた1つ以上の通知アドレスが不正なEmailアドレスです');
define('_ERROR_BADNAME',			'名前が使用できません ( a～z 、0～9 の英数字しか使えません)');
define('_ERROR_NICKNAMEINUSE',		'他のメンバーがそのニックネームを使用しています');
define('_ERROR_PASSWORDMISMATCH',	'パスワードがマッチしません');
define('_ERROR_PASSWORDTOOSHORT',	'パスワードは6文字以上でなければなりません');
define('_ERROR_PASSWORDMISSING',	'パスワードが空です');
define('_ERROR_REALNAMEMISSING',	'本名を入力してください');
define('_ERROR_ATLEASTONEADMIN',	'管理者領域にログインできるsuper-adminが少なくとも1人はいなくてはいけません。');
define('_ERROR_ATLEASTONEBLOGADMIN','このアクションを実行するとあなたのweblogはメンテナンス不能になります。少なくとも1人の管理者がいるようにしてください。');
define('_ERROR_ALREADYONTEAM',		'既にチームにいるメンバーは追加できません');
define('_ERROR_BADSHORTBLOGNAME',	'短いblog名には a～z 、0～9、の英数字のみ使用できます。スペースは使用できません。');
define('_ERROR_DUPSHORTBLOGNAME',	'他のblogで同じ短縮名が使われています。同じ名前は使用できません。');
define('_ERROR_UPDATEFILE',			'更新ファイルに書き込めません。ファイルのパーミッションが正しくセットされているか確認してください (chmod 666 を試してみてください)。また、それが管理領域ディレクトリからの相対位置である場合、(/your/path/to/nucleus/ のように)絶対パスで指定してみてください');
define('_ERROR_DELDEFBLOG',			'default blogは削除できません');
define('_ERROR_DELETEMEMBER',		'このメンバーはアイテムかコメントを書いているため削除できません');
define('_ERROR_BADTEMPLATENAME',	'不正なテンプレート名です (a～z 、0～9 の英数字のみ使用可。スペースは使用不可)');
define('_ERROR_DUPTEMPLATENAME',	'同じ名前のテンプレートが既に存在します');
define('_ERROR_BADSKINNAME',		'不正なスキン名です (a～z 、0～9 の英数字のみ使用可。スペースは使用不可)');
define('_ERROR_DUPSKINNAME',		'同じ名前のスキンが既に存在します');
define('_ERROR_DEFAULTSKIN',		'常に "default" という名前のスキンが存在しなければいけません');
define('_ERROR_SKINDEFDELETE',		'以下のweblogのdefaultスキンのため、スキンを削除できません: ');
define('_ERROR_DISALLOWED',			'このアクションの実行が許可されていません');
define('_ERROR_DELETEBAN',			'禁止者の削除中にエラーが発生しました (禁止者が存在しません)');
define('_ERROR_ADDBAN',				'禁止者の追加中にエラーが発生しました。全てのblogに正しく追加されていないかもしれません。');
define('_ERROR_BADACTION',			'要求されたアクションが存在しません');
define('_ERROR_MEMBERMAILDISABLED',	'メンバー間のメールメッセージが使用不可になっています');
define('_ERROR_MEMBERCREATEDISABLED','メンバーの作成が使用不可になっています');
define('_ERROR_INCORRECTEMAIL',		'正しくないメールアドレスです');
define('_ERROR_VOTEDBEFORE',		'このアイテムに既に投票済みです');
define('_ERROR_BANNED1',			'あなた (ip範囲 ');
define('_ERROR_BANNED2',			') はこのアクションの実行が禁止されています。メッセージ: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'このアクションを実行するするにはログインが必要です');
define('_ERROR_CONNECT',			'接続エラー');
define('_ERROR_FILE_TOO_BIG',		'ファイルが大きすぎます!');
define('_ERROR_BADFILETYPE',		'このファイルタイプは認められていません');
define('_ERROR_BADREQUEST',			'不正なアップロード要求です');
define('_ERROR_DISALLOWEDUPLOAD',	'あなたはどのweblogチームリストにも入っていないので、ファイルをアップロードできませんません');
define('_ERROR_BADPERMISSIONS',		'ファイル/ディレクトリのパーミッションが正しくセットされていません');
define('_ERROR_UPLOADMOVEP',		'アップロードファイルの移動中にエラーが発生しました');
define('_ERROR_UPLOADCOPY',			'ファイルのコピー中にエラーが発生しました');
define('_ERROR_UPLOADDUPLICATE',	'同じ名前のファイルが既に存在します。アップロードする前に名前を変更してしてください。');
define('_ERROR_LOGINDISALLOWED',	'あなたは管理者領域へのログインが認められていません。しかし、他のユーザーとしてログインすることは出来ます');
define('_ERROR_DBCONNECT',			'mySQLサーバに接続できません');
define('_ERROR_DBSELECT',			'nucleusデータベースを選択できません');
define('_ERROR_NOSUCHLANGUAGE',		'そのようなlanguageファイルは存在しません');
define('_ERROR_NOSUCHCATEGORY',		'そのようなカテゴリーは存在しません');
define('_ERROR_DELETELASTCATEGORY',	'少なくとも1つのカテゴリーが必要です');
define('_ERROR_DELETEDEFCATEGORY',	'defaultカテゴリーは削除できません');
define('_ERROR_BADCATEGORYNAME',	'カテゴリー名として使えません');
define('_ERROR_DUPCATEGORYNAME',	'同じ名前のカテゴリーが既に存在します');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'警告: 現在の値はディレクトリではありません!');
define('_WARNING_NOTREADABLE',		'警告: 現在の値は読み取り不可能なディレクトリです!');
define('_WARNING_NOTWRITABLE',		'警告: 現在の値は書き込み不可能なディレクトリです!');

// media and upload
define('_MEDIA_UPLOADLINK',			'新しいファイルのアップロード');
define('_MEDIA_MODIFIED',			'modified');
define('_MEDIA_FILENAME',			'ファイル名');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'埋め込み');
define('_MEDIA_POPUP',				'ポップアップ');
define('_UPLOAD_TITLE',				'ファイル選択');
define('_UPLOAD_MSG',				'アップロードするファイルを選択して、\'アップロード\' ボタンを押してください');
define('_UPLOAD_BUTTON',			'アップロード');

// some status messages
define('_MSG_ACCOUNTCREATED',		'アカウントが作成されました。パスワードがEmailで送信されます');
define('_MSG_PASSWORDSENT',			'パスワードがe-mailで送信されました。');
define('_MSG_LOGINAGAIN',			'あなたの情報が変更された為、ログインしなおす必要があります');
define('_MSG_SETTINGSCHANGED',		'設定が変更されました');
define('_MSG_ADMINCHANGED',			'管理者権限 が変更されました');
define('_MSG_NEWBLOG',				'新しいblogが作成されました');
define('_MSG_ACTIONLOGCLEARED',		'Action Log が消去されました');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'許可されていないアクション: ');
define('_ACTIONLOG_PWDREMINDERSENT','新しいパスワードの送り先: ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'Action Logの消去');
define('_ACTIONLOG_CLEAR_TEXT',		'action logを今すぐ消去');

// team management
define('_TEAM_TITLE',				'blogのチームを管理する ');
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
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a～zの英文字のみが使用でき、スペースは使用できません)');
define('_EBLOG_DESC',				'Blogの説明');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'標準のスキン');
define('_EBLOG_DEFCAT',				'標準のカテゴリ');
define('_EBLOG_LINEBREAKS',			'改行を変換する');
define('_EBLOG_DISABLECOMMENTS',	'コメントを無効にしますか?<br /><small>(コメントを無効にするとコメントの追加はできなくなります。)</small>');
define('_EBLOG_ANONYMOUS',			'非メンバーのコメントを許可しますか?');
define('_EBLOG_NOTIFY',				'通知するメールアドレス ( ; で区切ってください)');
define('_EBLOG_NOTIFY_ON',			'以下を通知する');
define('_EBLOG_NOTIFY_COMMENT',		'新しいコメント');
define('_EBLOG_NOTIFY_KARMA',		'新しい karma votes');
define('_EBLOG_NOTIFY_ITEM',		'新しい weblog アイテム');
define('_EBLOG_PING',				'更新時に Weblogs.com へPingを送りますか?');
define('_EBLOG_MAXCOMMENTS',		'コメントの最大量');
define('_EBLOG_UPDATE',				'アップロードファイル');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'現在のサーバ時刻: ');
define('_EBLOG_BTIME',				'現在のblog時刻: ');
define('_EBLOG_CHANGE',				'設定の変更');
define('_EBLOG_CHANGE_BTN',			'設定の変更');
define('_EBLOG_ADMIN',				'Blog 管理者権限');
define('_EBLOG_ADMIN_MSG',			'あなたには管理者権限が割り当てられます');
define('_EBLOG_CREATE_TITLE',		'新しいweblogの作成');
define('_EBLOG_CREATE_TEXT',		'新しいweblogを作成する為に以下のフォームに書き込んでください。<br /><br /> <b>注意:</b> 必要なオプションのみが表示されています。追加のオプションを設定したい場合は、weblogを作成した後でblog設定ページに行って設定してください。');
define('_EBLOG_CREATE',				'作成!');
define('_EBLOG_CREATE_BTN',			'Weblogを作成');
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
define('_TEMPLATE_BACK',			'テンプレートの概要に戻る');
define('_TEMPLATE_EDIT_MSG',		'全てのテンプレートパーツが必要な訳ではありません。必要ない場合は空欄のままにしておいてください。');
define('_TEMPLATE_SETTINGS',		'テンプレート設定');
define('_TEMPLATE_ITEMS',			'アイテム');
define('_TEMPLATE_ITEMHEADER',		'アイテムの Header');
define('_TEMPLATE_ITEMBODY',		'アイテムの Body');
define('_TEMPLATE_ITEMFOOTER',		'アイテムの Footer');
define('_TEMPLATE_MORELINK',		'拡張エントリーへのリンク');
define('_TEMPLATE_NEW',				'新しいアイテムの指示');
define('_TEMPLATE_COMMENTS_ANY',	'コメント (ある場合)');
define('_TEMPLATE_CHEADER',			'コメントの Header');
define('_TEMPLATE_CBODY',			'コメントの Body');
define('_TEMPLATE_CFOOTER',			'コメントの Footer');
define('_TEMPLATE_CONE',			'コメントが1つの時');
define('_TEMPLATE_CMANY',			'コメントが2つ以上の時');
define('_TEMPLATE_CMORE',			'さらにコメントを読む');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'コメント (無い場合)');
define('_TEMPLATE_CNONE',			'コメントが無い時');
define('_TEMPLATE_COMMENTS_TOOMUCH','コメント (インライン表示には長すぎる場合)');
define('_TEMPLATE_CTOOMUCH',		'長すぎるコメントの時');
define('_TEMPLATE_ARCHIVELIST',		'アーカイブリスト');
define('_TEMPLATE_AHEADER',			'アーカイブリスト Header');
define('_TEMPLATE_AITEM',			'アーカイブリスト Item');
define('_TEMPLATE_AFOOTER',			'アーカイブリスト Footer');
define('_TEMPLATE_DATETIME',		'日付と時刻');
define('_TEMPLATE_DHEADER',			'日付 Header');
define('_TEMPLATE_DFOOTER',			'日付 Footer');
define('_TEMPLATE_DFORMAT',			'日付 Format');
define('_TEMPLATE_TFORMAT',			'時刻 Format');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'イメージのポップアップ');
define('_TEMPLATE_PCODE',			'ポップアップ画像へのリンクコード');
define('_TEMPLATE_ICODE',			'インライン画像のコード');
define('_TEMPLATE_MCODE',			'メディアオブジェクトへのリンクコード');
define('_TEMPLATE_SEARCH',			'検索');
define('_TEMPLATE_SHIGHLIGHT',		'ハイライト表示');
define('_TEMPLATE_SNOTFOUND',		'検索で何も見つからなかった場合');
define('_TEMPLATE_UPDATE',			'更新');
define('_TEMPLATE_UPDATE_BTN',		'テンプレートの更新');
define('_TEMPLATE_RESET_BTN',		'リセット');
define('_TEMPLATE_CATEGORYLIST',	'カテゴリーリスト');
define('_TEMPLATE_CATHEADER',		'カテゴリーリスト Header');
define('_TEMPLATE_CATITEM',			'カテゴリーリスト Item');
define('_TEMPLATE_CATFOOTER',		'カテゴリーリスト Footer');

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
define('_SKIN_BACK',				'スキンの概要に戻る');
define('_SKIN_PARTS_TITLE',			'スキンパーツ');
define('_SKIN_PARTS_MSG',			'それぞれのスキンに全てのタイプが必要とは限りません。必要ない場合は空欄のままにしておいてください。以下から編集するスキンを選んでください:');
define('_SKIN_PART_MAIN',			'Main Index');
define('_SKIN_PART_ITEM',			'Item Pages');
define('_SKIN_PART_ALIST',			'Archive List');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',			'Search');
define('_SKIN_PART_ERROR',			'Errors');
define('_SKIN_PART_MEMBER',			'Member Details');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'一般設定');
define('_SKIN_CHANGE',				'変更');
define('_SKIN_CHANGE_BTN',			'設定の変更');
define('_SKIN_UPDATE_BTN',			'スキンの更新');
define('_SKIN_RESET_BTN',			'リセット');
define('_SKIN_EDITPART_TITLE',		'スキンの編集');
define('_SKIN_GOBACK',				'戻る');
define('_SKIN_ALLOWEDVARS',			'使用可能な変数 (クリックで説明表示):');

// global settings
define('_SETTINGS_TITLE',			'一般設定');
define('_SETTINGS_SUB_GENERAL',		'一般設定');
define('_SETTINGS_DEFBLOG',			'規定の Blog');
define('_SETTINGS_ADMINMAIL',		'管理者の Email');
define('_SETTINGS_SITENAME',		'サイト名');
define('_SETTINGS_SITEURL',			'サイトのURL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_ADMINURL',		'管理者領域のURL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_DIRS',			'Nucleus ディレクトリ');
define('_SETTINGS_MEDIADIR',		'Media ディレクトリ');
define('_SETTINGS_SEECONFIGPHP',	'(config.php を参照)');
define('_SETTINGS_MEDIAURL',		'Media URL (最後にスラッシュ "/" を付けてください)');
define('_SETTINGS_ALLOWUPLOAD',		'ファイルのアップロードを許可しますか?');
define('_SETTINGS_ALLOWUPLOADTYPES','アップロードを許可するファイルタイプ');
define('_SETTINGS_CHANGELOGIN',		'メンバーによるログイン名/パスワードの変更を許可する');
define('_SETTINGS_COOKIES_TITLE',	'Cookie 設定');
define('_SETTINGS_COOKIELIFE',		'ログイン Cookie の有効期間');
define('_SETTINGS_COOKIESESSION',	'セッションごと');
define('_SETTINGS_COOKIEMONTH',		'一ヶ月');
define('_SETTINGS_COOKIEPATH',		'Cookie パス (advanced)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie ドメイン (advanced)');
define('_SETTINGS_COOKIESECURE',	'セキュア Cookie (advanced)');
define('_SETTINGS_LASTVISIT',		'Last Visit Cookies の保存');
define('_SETTINGS_ALLOWCREATE',		'ビジターにメンバーアカウント作成を許可する');
define('_SETTINGS_NEWLOGIN',		'ユーザーが作成したアカウントによるログインを許可');
define('_SETTINGS_NEWLOGIN2',		'(新しく作成されたアカウントのみ)');
define('_SETTINGS_MEMBERMSGS',		'メンバー間サービスを許可');
define('_SETTINGS_LANGUAGE',		'規定の言語');
define('_SETTINGS_DISABLESITE',		'他のサイトへのリダイレクト（非常時用）');
define('_SETTINGS_DBLOGIN',			'mySQL ログイン &amp; データベース');
define('_SETTINGS_UPDATE',			'設定の更新');
define('_SETTINGS_UPDATE_BTN',		'設定を更新');
define('_SETTINGS_DISABLEJS',		'JavaScriptツールバーを無効にする');
define('_SETTINGS_MEDIA',			'メディア/アップロード設定');
define('_SETTINGS_MEDIAPREFIX',		'アップロードするファイル名の頭に日付を付加する');
define('_SETTINGS_MEMBERS',			'メンバー設定');

// bans
define('_BAN_TITLE',				'禁止リスト:');
define('_BAN_NONE',					'このweblogの禁止者はいません');
define('_BAN_NEW_TITLE',			'禁止者を追加する');
define('_BAN_NEW_TEXT',				'今すぐ禁止者を追加する');
define('_BAN_REMOVE_TITLE',			'禁止者の削除');
define('_BAN_IPRANGE',				'IPの範囲');
define('_BAN_BLOGS',				'禁止するblog: ');
define('_BAN_DELETE_TITLE',			'禁止者の削除');
define('_BAN_ALLBLOGS',				'あなたが管理者特権を持つ全てのblog。');
define('_BAN_REMOVED_TITLE',		'禁止者が削除されました');
define('_BAN_REMOVED_TEXT',			'以下のblogへの禁止者が削除されました:');
define('_BAN_ADD_TITLE',			'禁止者の追加');
define('_BAN_IPRANGE_TEXT',			'以下でブロックしたいIPの範囲を選んでください。指定する範囲が小さい程多くのアドレスがブロックされます。');
define('_BAN_BLOGS_TEXT',			'1つのblogのみで禁止するか、あなたが管理者特権を持つ全てのblogで禁止するかを選択することが出来ます。以下から選んでください。');
define('_BAN_REASON_TITLE',			'理由');
define('_BAN_REASON_TEXT',			'該当するIP禁止者がコメントを追加したりkarma voteをcastしようとしたときに表示される禁止理由を書いておくことができます (上限256文字)。');
define('_BAN_ADD_BTN',				'禁止者の追加');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Message');
define('_LOGIN_NAME',				'Name');
define('_LOGIN_PASSWORD',			'Password');
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
define('_MEMBERS_EMAIL',			'Emailアドレス');
define('_MEMBERS_EMAIL_EDIT',		'(Emailアドレスが変更されると、そのアドレスへ自動的に新しいパスワードが送信されます)');
define('_MEMBERS_URL',				'Webサイトアドレス (URL)');
define('_MEMBERS_SUPERADMIN',		'Super-admin(最高管理)権限を与える');
define('_MEMBERS_CANLOGIN',			'管理者領域へのログイン');
define('_MEMBERS_NOTES',			'備考');
define('_MEMBERS_NEW_BTN',			'メンバーの追加');
define('_MEMBERS_EDIT',				'メンバーの編集');
define('_MEMBERS_EDIT_BTN',			'設定の変更');
define('_MEMBERS_BACKTOOVERVIEW',	'メンバーの概要に戻る');
define('_MEMBERS_DEFLANG',			'言語');
define('_MEMBERS_USESITELANG',		'- サイトの設定を使う -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'サイトを見る');
define('_BLOGLIST_ADD',				'アイテムの追加');
define('_BLOGLIST_TT_ADD',			'このweblogに新しいアイテムを追加します');
define('_BLOGLIST_EDIT',			'アイテムの編集/削除');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'設定');
define('_BLOGLIST_TT_SETTINGS',		'設定の編集/チームの管理');
define('_BLOGLIST_BANS',			'禁止');
define('_BLOGLIST_TT_BANS',			'禁止IPの確認/追加/削除');
define('_BLOGLIST_DELETE',			'全て削除');
define('_BLOGLIST_TT_DELETE',		'このweblogを削除');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'あなたの weblog');
define('_OVERVIEW_YRDRAFTS',		'ドラフト');
define('_OVERVIEW_YRSETTINGS',		'設定');
define('_OVERVIEW_GSETTINGS',		'基本設定');
define('_OVERVIEW_NOBLOGS',			'あなたはどのweblogチームリストにも入っていません');
define('_OVERVIEW_NODRAFTS',		'ドラフト（編集中）の記事はありません');
define('_OVERVIEW_EDITSETTINGS',	'あなたの設定を編集...');
define('_OVERVIEW_BROWSEITEMS',		'あなたのアイテムを見る...');
define('_OVERVIEW_BROWSECOMM',		'あなたのコメントを見る...');
define('_OVERVIEW_VIEWLOG',			'Action Logを見る...');
define('_OVERVIEW_MEMBERS',			'メンバーの管理...');
define('_OVERVIEW_NEWLOG',			'新しいWeblogを作る...');
define('_OVERVIEW_SETTINGS',		'設定の編集...');
define('_OVERVIEW_TEMPLATES',		'テンプレートの編集...');
define('_OVERVIEW_SKINS',			'スキンの編集...');
define('_OVERVIEW_BACKUP',			'バックアップ/リストア...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'blog アイテムの編集: ');
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
define('_LISTS_TYPE',				'type');


// member list 
define('_LIST_MEMBER_NAME',			'名前');
define('_LIST_MEMBER_RNAME',		'本名');
define('_LIST_MEMBER_ADMIN',		'Super-admin権限 ');
define('_LIST_MEMBER_LOGIN',		'ログイン可能\');
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
define('_EDITC_HOST',				'Host');
define('_EDITC_WHEN',				'日時');
define('_EDITC_TEXT',				'本文');
define('_EDITC_EDIT',				'コメントの編集');
define('_EDITC_MEMBER',				'メンバー');
define('_EDITC_NONMEMBER',			'非メンバー');

// move item
define('_MOVE_TITLE',				'どのblogに移動しますか?');
define('_MOVE_BTN',					'アイテムを移動する');

?>
