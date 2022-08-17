<?
// Traditional Chinese Nucleus Language File
//
// 作者:kax (im_syk@yahoo.com.tw)
// 適用版本:v2.0(我只測試過這個)
//
// Author: kax (im_syk@yahoo.com.tw)
// Nucleus version: v2.0
//
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

/********************************************
 *        Important Settings                *
 ********************************************/
if (!defined('_CHARSET')) define('_CHARSET', 'UTF-8'); // charset to use
if (!defined('_LOCALE'))  define('_LOCALE',  'zh_TW');  // common locale , big5, 950
if (!defined('_LOCALE_NAME_WINDOWS'))  define('_LOCALE_NAME_WINDOWS', 'zh-TW');

/********************************************
 *        Start New for                     *
 ********************************************/

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'允許發表舊的時間');
define('_ADD_CHANGEDATE',			'更新時間');
define('_BMLET_CHANGEDATE',			'更新時間');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'面版輸入/輸出...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'一般');
define('_PARSER_INCMODE_SKINDIR',	'面版路徑');
define('_SKIN_INCLUDE_MODE',		'使用模式');
define('_SKIN_INCLUDE_PREFIX',		'依照字首');

// global settings
define('_SETTINGS_BASESKIN',		'基本面版');
define('_SETTINGS_SKINSURL',		'面版路徑');
define('_SETTINGS_ACTIONSURL',		'action.php的絕對路徑');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'無法移動標準類別');
define('_ERROR_MOVETOSELF',			'無法移動類別 ( 目標與來源相同 )');
define('_MOVECAT_TITLE',			'將類別移動到');
define('_MOVECAT_BTN',				'移動類別');

// URLMode setting
define('_SETTINGS_URLMODE',			'網址模式');
define('_SETTINGS_URLMODE_NORMAL',	'一般');
define('_SETTINGS_URLMODE_PATHINFO','特別');

// Batch operations
define('_BATCH_NOSELECTION',		'沒有選擇執行的對象');
define('_BATCH_ITEMS',				'批次處理項目');
define('_BATCH_CATEGORIES',			'批次處理類別');
define('_BATCH_MEMBERS',			'批次處理會員');
define('_BATCH_TEAM',				'批次處理群組');
define('_BATCH_COMMENTS',			'批次處理迴響');
define('_BATCH_UNKNOWN',			'未知的批次處理: ');
define('_BATCH_EXECUTING',			'執行');
define('_BATCH_ONCATEGORY',			'在類別');
define('_BATCH_ONITEM',				'在項目');
define('_BATCH_ONCOMMENT',			'在迴響');
define('_BATCH_ONMEMBER',			'在會員');
define('_BATCH_ONTEAM',				'在群組');
define('_BATCH_SUCCESS',			'成功!');
define('_BATCH_DONE',				'完成!');
define('_BATCH_DELETE_CONFIRM',		'確認批次刪除');
define('_BATCH_DELETE_CONFIRM_BTN',	'確認批次刪除');
define('_BATCH_SELECTALL',			'全選');
define('_BATCH_DESELECTALL',		'都不選');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'刪除');
define('_BATCH_ITEM_MOVE',			'移動');
define('_BATCH_MEMBER_DELETE',		'刪除');
define('_BATCH_MEMBER_SET_ADM',		'設定權限');
define('_BATCH_MEMBER_UNSET_ADM',	'取消權限');
define('_BATCH_TEAM_DELETE',		'刪除群組');
define('_BATCH_TEAM_SET_ADM',		'設定權限');
define('_BATCH_TEAM_UNSET_ADM',		'取消權限');
define('_BATCH_CAT_DELETE',			'刪除');
define('_BATCH_CAT_MOVE',			'移動到其他網誌');
define('_BATCH_COMMENT_DELETE',		'刪除');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'增加新文章...');
define('_ADD_PLUGIN_EXTRAS',		'外掛');

// errors
define('_ERROR_CATCREATEFAIL',		'無法建立新的類別');
define('_ERROR_NUCLEUSVERSIONREQ',	'使用這個外掛需要新的Nucleus版本: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'返回網誌設定');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'輸入');
define('_SKINIE_TITLE_EXPORT',		'輸出');
define('_SKINIE_BTN_IMPORT',		'輸入');
define('_SKINIE_BTN_EXPORT',		'輸出所選的面版/模版');
define('_SKINIE_LOCAL',				'從妳的電腦上傳:');
define('_SKINIE_NOCANDIDATES',		'在面版路徑中沒有找到妳所選的檔案');
define('_SKINIE_FROMURL',			'從網址載入:');
define('_SKINIE_EXPORT_INTRO',		'從下面選擇你所想輸出的面版或版');
define('_SKINIE_EXPORT_SKINS',		'面版');
define('_SKINIE_EXPORT_TEMPLATES',	'模版');
define('_SKINIE_EXPORT_EXTRA',		'更多訊息');
define('_SKINIE_CONFIRM_OVERWRITE',	'覆蓋已經存在的面版(檢查重複的檔名)');
define('_SKINIE_CONFIRM_IMPORT',	'是的, 我確定要上傳');
define('_SKINIE_CONFIRM_TITLE',		'取消上傳面版和模版');
define('_SKINIE_INFO_SKINS',		'檔案中的面版:');
define('_SKINIE_INFO_TEMPLATES',	'檔案中的模版:');
define('_SKINIE_INFO_GENERAL',		'訊息:');
define('_SKINIE_INFO_SKINCLASH',	'面版重複:');
define('_SKINIE_INFO_TEMPLCLASH',	'模版重複:');
define('_SKINIE_INFO_IMPORTEDSKINS','以上傳的面版:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','以上傳的模版:');
define('_SKINIE_DONE',				'完成');

define('_AND',						'和');
define('_OR',						'或');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'空白 (編輯)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'包含模式:');
define('_LIST_SKINS_INCPREFIX',		'包含字首:');
define('_LIST_SKINS_DEFINED',		'確定的部分:');

// backup
define('_BACKUPS_TITLE',			'備份 / 還原');
define('_BACKUP_TITLE',				'備份');
define('_BACKUP_INTRO',				'按下面的按鈕來備份Nucleus的資料庫. 請妳按照提示把檔案存放在安全的地方.');
define('_BACKUP_ZIP_YES',			'嘗試使用壓縮');
define('_BACKUP_ZIP_NO',			'不使用壓縮');
define('_BACKUP_BTN',				'建立備份');
define('_BACKUP_NOTE',				'<b>注意:</b> 這個備份的檔案只有備份資料庫. 不包含<b>config.php</b>.');
define('_RESTORE_TITLE',			'還原');
define('_RESTORE_NOTE',				'<b>小心:</b> 還原備份的資料庫將會<b>刪除</b>現在的資料庫! 在執行動作前請務必確認!	<br />	<b>注意:</b> 起確定要還原的版本與現在的版本相同!否則可能無法執行');
define('_RESTORE_INTRO',			'從下面選擇已備份的檔案 ( 他將被上傳到伺服器上 ) 然後按 "還原" 開始執行.');
define('_RESTORE_IMSURE',			'是的, 我已經確定要執行這個動作!');
define('_RESTORE_BTN',				'從檔案還原');
define('_RESTORE_WARNING',			'( 正要還原一個備份, 在開始前你可以先製作目前的備分 )');
define('_ERROR_BACKUP_NOTSURE',		'妳需要檢查妳所確定的');
define('_RESTORE_COMPLETE',			'完成還原');

// new item notification
define('_NOTIFY_NI_MSG',			'這篇新的文章已被發表:');
define('_NOTIFY_NI_TITLE',			'新文章!');
define('_NOTIFY_KV_MSG',			'Karma vote on item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comment on item:');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'使用者id:');
define('_NOTIFY_USER',				'使用者:');
define('_NOTIFY_COMMENT',			'迴響:');
define('_NOTIFY_VOTE',				'票選:');
define('_NOTIFY_HOST',				'主機:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'會員:');
define('_NOTIFY_TITLE',				'標題:');
define('_NOTIFY_CONTENTS',			'內容:');

// member mail message
define('_MMAIL_MSG',				'一個妳的訊息從');
define('_MMAIL_FROMANON',			'一個匿名訊息');
define('_MMAIL_FROMNUC',			'由nucleus系統發送');
define('_MMAIL_TITLE',				'一個訊息從');
define('_MMAIL_MAIL',				'訊息:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'新增項目');
define('_BMLET_EDIT',				'編輯項目');
define('_BMLET_DELETE',				'刪除項目');
define('_BMLET_BODY',				'內容');
define('_BMLET_MORE',				'延伸');
define('_BMLET_OPTIONS',			'選項');
define('_BMLET_PREVIEW',			'預覽');

// used in bookmarklet
define('_ITEM_UPDATED',				'項目已更新');
define('_ITEM_DELETED',				'項目已刪除');

// plugins
define('_CONFIRMTXT_PLUGIN',		'妳確定要刪除這個外掛?');
define('_ERROR_NOSUCHPLUGIN',		'沒有這個外掛');
define('_ERROR_DUPPLUGIN',			'抱歉, 這個外掛已經安裝');
define('_ERROR_PLUGFILEERROR',		'沒有這個外掛或者是權限沒有設定好');
define('_PLUGS_NOCANDIDATES',		'找不到外掛的檔案');

define('_PLUGS_TITLE_MANAGE',		'外掛管理');
define('_PLUGS_TITLE_INSTALLED',	'目前已經安裝');
define('_PLUGS_TITLE_UPDATE',		'更新預定列表');
define('_PLUGS_TEXT_UPDATE',		'Nucleus保存了外掛的事件描述快取. 當妳升級外掛時, 請執行升級, 確定事件描述快取的更新  ');
define('_PLUGS_TITLE_NEW',			'安裝新的外掛');
define('_PLUGS_ADD_TEXT',			'下面的列表是妳外掛目錄中的所有檔案, 有些可能是妳沒安裝的. 請妳確定 <strong>非常確定</strong> 那是一個外掛妳才將他安裝.');
define('_PLUGS_BTN_INSTALL',		'安裝外掛');
define('_BACKTOOVERVIEW',			'返回總覽');

// editlink
define('_TEMPLATE_EDITLINK',		'編輯文章連結');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'增加左邊的區塊');
define('_ADD_RIGHT_TT',				'增加右邊的區塊');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'增加類別...');

// new settings
define('_SETTINGS_PLUGINURL',		'外掛網址');
define('_SETTINGS_MAXUPLOADSIZE',	'上傳檔案最大(位元組)');
define('_SETTINGS_NONMEMBERMSGS',	'允許非會員發送訊息');
define('_SETTINGS_PROTECTMEMNAMES',	'保護會員名稱');

// overview screen
define('_OVERVIEW_PLUGINS',			'外掛管理...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'新註冊的會員:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'妳的郵件位址:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'妳沒有將檔案上傳到會員目錄的權限');

// plugin list
define('_LISTS_INFO',				'資訊');
define('_LIST_PLUGS_AUTHOR',		'作者:');
define('_LIST_PLUGS_VER',			'版本:');
define('_LIST_PLUGS_SITE',			'訪問網站');
define('_LIST_PLUGS_DESC',			'描述:');
define('_LIST_PLUGS_SUBS',			'下列預定的事件:');
define('_LIST_PLUGS_UP',			'上移');
define('_LIST_PLUGS_DOWN',			'下移');
define('_LIST_PLUGS_UNINSTALL',		'移除');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'選項設定');

// plugin option list
define('_LISTS_VALUE',				'數值');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'這個外掛沒有任何的設定選項');
define('_PLUGS_BACK',				'返回外掛總覽');
define('_PLUGS_SAVE',				'儲存設定');
define('_PLUGS_OPTIONS_UPDATED',	'已更新外掛設定');

define('_OVERVIEW_MANAGEMENT',		'管理');
define('_OVERVIEW_MANAGE',			'系統管理...');
define('_MANAGE_GENERAL',			'一般管理');
define('_MANAGE_SKINS',				'面版和模版');
define('_MANAGE_EXTRA',				'其他功能');

define('_BACKTOMANAGE',				'返回Nucleus系統管理');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'登出');
define('_LOGIN',					'登入');
define('_YES',						'是');
define('_NO',						'否');
define('_SUBMIT',					'送出');
define('_ERROR',					'錯誤');
define('_ERRORMSG',					'出現一個錯誤!');
define('_BACK',						'返回');
define('_NOTLOGGEDIN',				'還沒有登入');
define('_LOGGEDINAS',				'登入以身份');
define('_ADMINHOME',				'管理中心');
define('_NAME',						'姓名');
define('_BACKHOME',					'返回管理中心');
define('_BADACTION',				'沒有動作要求');
define('_MESSAGE',					'訊息');
define('_HELP_TT',					'幫助!');
define('_YOURSITE',					'妳的網站');


define('_POPUP_CLOSE',				'關閉視窗');

define('_LOGIN_PLEASE',				'請先登入');

// commentform
define('_COMMENTFORM_YOUARE',		'妳是');
define('_COMMENTFORM_SUBMIT',		'迴響');
define('_COMMENTFORM_COMMENT',		'妳的迴響');
define('_COMMENTFORM_NAME',			'姓名');
define('_COMMENTFORM_MAIL',			'郵件/網站');
define('_COMMENTFORM_REMEMBER',		'記住妳');

// loginform
define('_LOGINFORM_NAME',			'會員帳號');
define('_LOGINFORM_PWD',			'密碼');
define('_LOGINFORM_YOUARE',			'Hello!  ');
define('_LOGINFORM_SHARED',			'這是一台公用電腦');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'發送訊息');

// search form
define('_SEARCHFORM_SUBMIT',		'搜尋');

// add item form
define('_ADD_ADDTO',				'新增文章到');
define('_ADD_CREATENEW',			'建立新文章');
define('_ADD_BODY',					'內容');
define('_ADD_TITLE',				'標題');
define('_ADD_MORE',					'深入閱讀 (選用)');
define('_ADD_CATEGORY',				'類別');
define('_ADD_PREVIEW',				'預覽');
define('_ADD_DISABLE_COMMENTS',		'取消迴響?');
define('_ADD_DRAFTNFUTURE',			'草稿 &amp; 自訂項目');
define('_ADD_ADDITEM',				'增加文章');
define('_ADD_ADDNOW',				'現在增加');
define('_ADD_ADDLATER',				'自訂增加時間');
define('_ADD_PLACE_ON',				'設定時間');
define('_ADD_ADDDRAFT',				'增加到草稿');
define('_ADD_NOPASTDATES',			'(不能用舊的時間, 將會使用目前的時間)');
define('_ADD_BOLD_TT',				'粗體');
define('_ADD_ITALIC_TT',			'斜體');
define('_ADD_HREF_TT',				'建立連結');
define('_ADD_MEDIA_TT',				'增加多媒體檔案');
define('_ADD_PREVIEW_TT',			'顯示/隱藏 預覽');
define('_ADD_CUT_TT',				'剪下');
define('_ADD_COPY_TT',				'複製');
define('_ADD_PASTE_TT',				'貼上');


// edit item form
define('_EDIT_ITEM',				'編輯文章');
define('_EDIT_SUBMIT',				'編輯文章');
define('_EDIT_ORIG_AUTHOR',			'元創作者');
define('_EDIT_BACKTODRAFTS',		'增加返回草稿');
define('_EDIT_COMMENTSNOTE',		'(注意: 關閉迴響並不會刪除已經發表的迴響)');

// used on delete screens
define('_DELETE_CONFIRM',			'請確認刪除動作');
define('_DELETE_CONFIRM_BTN',		'確認刪除動作');
define('_CONFIRMTXT_ITEM',			'妳將刪除以下的文章:');
define('_CONFIRMTXT_COMMENT',		'妳將刪除以下的迴響:');
define('_CONFIRMTXT_TEAM1',			'即將刪除 ');
define('_CONFIRMTXT_TEAM2',			' 從網誌群組列表中 ');
define('_CONFIRMTXT_BLOG',			'妳將刪除的網誌是: ');
define('_WARNINGTXT_BLOGDEL',		'小心! 刪除一個網誌將刪除所有相關的內容, 和所有的迴響. 請確定妳是否要刪除網誌!<br />也請勿在動作時終止系統.');
define('_CONFIRMTXT_MEMBER',		'妳將刪除以下的會員資料: ');
define('_CONFIRMTXT_TEMPLATE',		'妳將刪除以命名的模版 ');
define('_CONFIRMTXT_SKIN',			'妳將刪除以命名的面版 ');
define('_CONFIRMTXT_BAN',			'妳將取消對這些ip的封鎖');
define('_CONFIRMTXT_CATEGORY',		'妳將刪除類別 ');

// some status messages
define('_DELETED_ITEM',				'文章已刪除');
define('_DELETED_MEMBER',			'會員已刪除');
define('_DELETED_COMMENT',			'迴響已刪除');
define('_DELETED_BLOG',				'網誌已刪除');
define('_DELETED_CATEGORY',			'類別已刪除');
define('_ITEM_MOVED',				'文章已移動');
define('_ITEM_ADDED',				'文章已增加');
define('_COMMENT_UPDATED',			'迴響已更新');
define('_SKIN_UPDATED',				'面版日期已被紀錄');
define('_TEMPLATE_UPDATED',			'模版日期已被紀錄');

// errors
define('_ERROR_COMMENT_LONGWORD',	'請勿在迴響中使用長度超過90個字元的單字');
define('_ERROR_COMMENT_NOCOMMENT',	'請輸入一個迴響');
define('_ERROR_COMMENT_NOUSERNAME',	'使用者名稱錯誤');
define('_ERROR_COMMENT_TOOLONG',	'妳的迴響太長了(最多. 5000 英文字元 = 2500個中文字元 )');
define('_ERROR_COMMENTS_DISABLED',	'這個網誌的迴響已被取消.');
define('_ERROR_COMMENTS_NONPUBLIC',	'妳必須登入才能迴響');
define('_ERROR_COMMENTS_MEMBERNICK','妳的名子已被使用, 請另外想一個.');
define('_ERROR_SKIN',				'面版錯誤');
define('_ERROR_ITEMCLOSED',			'這篇文章已經關閉, 不能迴響或投票');
define('_ERROR_NOSUCHITEM',			'沒有這篇文章');
define('_ERROR_NOSUCHBLOG',			'沒有這個網誌');
define('_ERROR_NOSUCHSKIN',			'沒有這個面版');
define('_ERROR_NOSUCHMEMBER',		'沒有這個會員');
define('_ERROR_NOTONTEAM',			'妳不在這個網誌的會員列表上.');
define('_ERROR_BADDESTBLOG',		'預定的網誌不存在');
define('_ERROR_NOTONDESTTEAM',		'無法移動文章, 妳不在這個預定網誌的會員列表上');
define('_ERROR_NOEMPTYITEMS',		'無法增加空白文件!');
define('_ERROR_BADMAILADDRESS',		'錯誤的郵件位址');
define('_ERROR_BADNOTIFY',			'一個或多個錯誤的郵件位址');
define('_ERROR_BADNAME',			'名稱錯誤');
define('_ERROR_NICKNAMEINUSE',		'這個暱稱已經有人使用了, 另外想一個吧');
define('_ERROR_PASSWORDMISMATCH',	'密碼必須符合');
define('_ERROR_PASSWORDTOOSHORT',	'密碼最少需要六個字元');
define('_ERROR_PASSWORDMISSING',	'密碼不能空白');
define('_ERROR_REALNAMEMISSING',	'請輸入全名');
define('_ERROR_ATLEASTONEADMIN',	'必須有一個超級使用者存在, 才可以登入管理介面.');
define('_ERROR_ATLEASTONEBLOGADMIN','請確定至少有一個超級使用者存在.');
define('_ERROR_ALREADYONTEAM',		'無法增加此使用者, 已存在於群組中');
define('_ERROR_BADSHORTBLOGNAME',	'網誌縮寫只允許a-z和0-9, 不能有空白');
define('_ERROR_DUPSHORTBLOGNAME',	'其他網誌已使用此縮寫, 從新想一個獨一無二的吧');
define('_ERROR_UPDATEFILE',			'無法寫入檔案. 請確定檔案的權限設定正確(可以試著設定為666).');
define('_ERROR_DELDEFBLOG',			'無法刪除預設的網誌');
define('_ERROR_DELETEMEMBER',		'無法刪除此會員, 也許她是文章或迴響的作者');
define('_ERROR_BADTEMPLATENAME',	'無效的模版名(只允許a-z或0-9)');
define('_ERROR_DUPTEMPLATENAME',	'另外一個模版已經使用相同的名子');
define('_ERROR_BADSKINNAME',		'無效的面版名(只允許a-z或0-9)');
define('_ERROR_DUPSKINNAME',		'另外一個面版已經使用相同的名子');
define('_ERROR_DEFAULTSKIN',		'必須有一個預設面版名為"default"');
define('_ERROR_SKINDEFDELETE',		'無法刪除此面版版, 因為有以下的網誌使用他當預設的面版: ');
define('_ERROR_DISALLOWED',			'抱歉, 妳沒有這個權限執行此動作');
define('_ERROR_DELETEBAN',			'嘗試取消封鎖IP時錯誤 (封鎖的IP不存在)');
define('_ERROR_ADDBAN',				'嘗試增加封鎖IP時錯誤. 要封鎖的IP也許還沒有正確輸入.');
define('_ERROR_BADACTION',			'需要的動作不存在');
define('_ERROR_MEMBERMAILDISABLED',	'使用這訊息已被關閉');
define('_ERROR_MEMBERCREATEDISABLED','建立使用者帳號已被關閉');
define('_ERROR_INCORRECTEMAIL',		'錯誤的郵址');
define('_ERROR_VOTEDBEFORE',		'妳已經為這個文章投票了');
define('_ERROR_BANNED1',			'無法執行動作(IP封鎖');
define('_ERROR_BANNED2',			') 因為被禁止了. 訊息: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'妳必須登入來執行這個動作');
define('_ERROR_CONNECT',			'連線錯誤');
define('_ERROR_FILE_TOO_BIG',		'檔案太大啦!');
define('_ERROR_BADFILETYPE',		'抱歉, 這個檔案的格式不被允許.');
define('_ERROR_BADREQUEST',			'錯誤的上傳');
define('_ERROR_DISALLOWEDUPLOAD',	'妳不在任何的網誌群組內. 因此妳不能上傳檔案');
define('_ERROR_BADPERMISSIONS',		'檔案或目錄權限設定錯誤');
define('_ERROR_UPLOADMOVEP',		'上傳時發生錯誤');
define('_ERROR_UPLOADCOPY',			'複製時發生錯誤');
define('_ERROR_UPLOADDUPLICATE',	'另外一個檔案已經有相同的名稱. 請另想個名字再重新上傳.');
define('_ERROR_LOGINDISALLOWED',	'抱歉, 妳沒有權限進入控制中心.');
define('_ERROR_DBCONNECT',			'無法連接到mySQL伺服器');
define('_ERROR_DBSELECT',			'無法選用這個資料庫.');
define('_ERROR_NOSUCHLANGUAGE',		'沒有這個語系檔存在的');
define('_ERROR_NOSUCHCATEGORY',		'沒有這個類別');
define('_ERROR_DELETELASTCATEGORY',	'最少需要有一個類別');
define('_ERROR_DELETEDEFCATEGORY',	'無法刪除預設的類別');
define('_ERROR_BADCATEGORYNAME',	'錯誤的類別名稱');
define('_ERROR_DUPCATEGORYNAME',	'已經有一個類別使用相同的名稱');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'小心: 目前的數值不是目錄!');
define('_WARNING_NOTREADABLE',		'小心: 目前的目錄是不可讀的!');
define('_WARNING_NOTWRITABLE',		'小心: 目前的目錄是不可寫的!');

// media and upload
define('_MEDIA_UPLOADLINK',			'上傳新檔');
define('_MEDIA_MODIFIED',			'修改');
define('_MEDIA_FILENAME',			'檔名');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'選擇檔案');
define('_UPLOAD_MSG',				'從下面選擇妳要上傳的檔案.');
define('_UPLOAD_BUTTON',			'上傳');

// some status messages
define('_MSG_ACCOUNTCREATED',		'帳號建立, 密碼將由郵件發送');
define('_MSG_PASSWORDSENT',			'密碼已發送.');
define('_MSG_LOGINAGAIN',			'資料變更妳需要重新登入');
define('_MSG_SETTINGSCHANGED',		'設定變更');
define('_MSG_ADMINCHANGED',			'管理員變更');
define('_MSG_NEWBLOG',				'已建立新的網誌');
define('_MSG_ACTIONLOGCLEARED',		'清空動做記錄');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'不允許的動做: ');
define('_ACTIONLOG_PWDREMINDERSENT','新的密碼送出為 ');
define('_ACTIONLOG_TITLE',			'動做記錄');
define('_ACTIONLOG_CLEAR_TITLE',	'清除動作記錄');
define('_ACTIONLOG_CLEAR_TEXT',		'現在清除動作記錄');

// team management
define('_TEAM_TITLE',				'網誌群組 ');
define('_TEAM_CURRENT',				'目前群組');
define('_TEAM_ADDNEW',				'新增使用者到群組');
define('_TEAM_CHOOSEMEMBER',		'選擇使用者');
define('_TEAM_ADMIN',				'超級使用者權限? ');
define('_TEAM_ADD',					'增加到群組');
define('_TEAM_ADD_BTN',				'增加到群組');

// blogsettings
define('_EBLOG_TITLE',				'編輯網誌設定');
define('_EBLOG_TEAM_TITLE',			'編輯網誌');
define('_EBLOG_TEAM_TEXT',			'點這裡來編輯妳的群組...');
define('_EBLOG_SETTINGS_TITLE',		'網誌設定');
define('_EBLOG_NAME',				'網誌名稱');
define('_EBLOG_SHORTNAME',			'網誌縮寫');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(只能包含a-z, 不能有空白)');
define('_EBLOG_DESC',				'網誌描述');
define('_EBLOG_URL',				'網址');
define('_EBLOG_DEFSKIN',			'預設的面版');
define('_EBLOG_DEFCAT',				'預設的類別');
define('_EBLOG_LINEBREAKS',			'自動轉換斷行');
define('_EBLOG_DISABLECOMMENTS',	'開啟迴響?<br /><small>(關閉迴響是指不能增加迴響.)</small>');
define('_EBLOG_ANONYMOUS',			'允許非會員瀏覽?');
define('_EBLOG_NOTIFY',				'通知書 (可以用 ; 來分開郵件網址)');
define('_EBLOG_NOTIFY_ON',			'什麼時候通知');
define('_EBLOG_NOTIFY_COMMENT',		'新的迴響');
define('_EBLOG_NOTIFY_KARMA',		'新的投票');
define('_EBLOG_NOTIFY_ITEM',		'新的網誌');
define('_EBLOG_PING',				'當更新網頁時通知Weblogs.com?');
define('_EBLOG_MAXCOMMENTS',		'迴響篇數最多幾篇');
define('_EBLOG_UPDATE',				'更新檔案');
define('_EBLOG_OFFSET',				'時差設定');
define('_EBLOG_STIME',				'目前伺服器的時間');
define('_EBLOG_BTIME',				'目前網誌設定的時間');
define('_EBLOG_CHANGE',				'更新設定');
define('_EBLOG_CHANGE_BTN',			'更新設定');
define('_EBLOG_ADMIN',				'網誌管理');
define('_EBLOG_ADMIN_MSG',			'妳將被賦予管理的權限');
define('_EBLOG_CREATE_TITLE',		'建立新的網誌');
define('_EBLOG_CREATE_TEXT',		'建立新的網誌請填寫以下表格. <br /><br /> <b>注意:</b> 下面的表格都是必要的選項. 如果妳想做額外的設定, 可以再到網誌設定裡去做設定.');
define('_EBLOG_CREATE',				'建立!');
define('_EBLOG_CREATE_BTN',			'建立網誌');
define('_EBLOG_CAT_TITLE',			'類別');
define('_EBLOG_CAT_NAME',			'類別名稱');
define('_EBLOG_CAT_DESC',			'類別描述');
define('_EBLOG_CAT_CREATE',			'新增類別');
define('_EBLOG_CAT_UPDATE',			'更新類別');
define('_EBLOG_CAT_UPDATE_BTN',		'更新類別');

// templates
define('_TEMPLATE_TITLE',			'編輯模版');
define('_TEMPLATE_AVAILABLE_TITLE',	'有效的模版');
define('_TEMPLATE_NEW_TITLE',		'新增模版');
define('_TEMPLATE_NAME',			'模版名稱');
define('_TEMPLATE_DESC',			'模版描述');
define('_TEMPLATE_CREATE',			'建立模版');
define('_TEMPLATE_CREATE_BTN',		'建立模版');
define('_TEMPLATE_EDIT_TITLE',		'編輯模版');
define('_TEMPLATE_BACK',			'返回模版總覽');
define('_TEMPLATE_EDIT_MSG',		'不是所有的部分都需要, 請把妳不需要的留下空白.');
define('_TEMPLATE_SETTINGS',		'模版設定');
define('_TEMPLATE_ITEMS',			'文章');
define('_TEMPLATE_ITEMHEADER',		'文章頭');
define('_TEMPLATE_ITEMBODY',		'文章內容');
define('_TEMPLATE_ITEMFOOTER',		'文章尾');
define('_TEMPLATE_MORELINK',		'連結額外資訊');
define('_TEMPLATE_NEW',				'Indication of new item');
define('_TEMPLATE_COMMENTS_ANY',	'迴響 (如果任何)');
define('_TEMPLATE_CHEADER',			'迴響頭');
define('_TEMPLATE_CBODY',			'迴響內容');
define('_TEMPLATE_CFOOTER',			'迴響尾');
define('_TEMPLATE_CONE',			'一個迴響');
define('_TEMPLATE_CMANY',			'多個迴響');
define('_TEMPLATE_CMORE',			'深入閱讀迴響');
define('_TEMPLATE_CMEXTRA',			'會員額外資訊');
define('_TEMPLATE_COMMENTS_NONE',	'迴響 (如果沒有)');
define('_TEMPLATE_CNONE',			'沒有任何迴響');
define('_TEMPLATE_COMMENTS_TOOMUCH','迴響(如果任何, 但是太多行要顯示了)');
define('_TEMPLATE_CTOOMUCH',		'太多迴響');
define('_TEMPLATE_ARCHIVELIST',		'檔案列表');
define('_TEMPLATE_AHEADER',			'檔案列表頭');
define('_TEMPLATE_AITEM',			'檔案列表項目');
define('_TEMPLATE_AFOOTER',			'檔案列表尾');
define('_TEMPLATE_DATETIME',		'日期和時間');
define('_TEMPLATE_DHEADER',			'日期頭');
define('_TEMPLATE_DFOOTER',			'日期尾');
define('_TEMPLATE_DFORMAT',			'日期格式');
define('_TEMPLATE_TFORMAT',			'時間格式');
define('_TEMPLATE_LOCALE',			'本機');
define('_TEMPLATE_IMAGE',			'圖片popups');
define('_TEMPLATE_PCODE',			'Popup連結語法');
define('_TEMPLATE_ICODE',			'文章中插入圖片');
define('_TEMPLATE_MCODE',			'多媒體語法');
define('_TEMPLATE_SEARCH',			'搜尋');
define('_TEMPLATE_SHIGHLIGHT',		'焦點標示');
define('_TEMPLATE_SNOTFOUND',		'沒有搜尋到任何東西');
define('_TEMPLATE_UPDATE',			'更新');
define('_TEMPLATE_UPDATE_BTN',		'更新模版');
define('_TEMPLATE_RESET_BTN',		'重設資料');
define('_TEMPLATE_CATEGORYLIST',	'分類列表');
define('_TEMPLATE_CATHEADER',		'分類列表頭');
define('_TEMPLATE_CATITEM',			'分類列表項目');
define('_TEMPLATE_CATFOOTER',		'分類列表尾');

// skins
define('_SKIN_EDIT_TITLE',			'編輯面版');
define('_SKIN_AVAILABLE_TITLE',		'有效的面版');
define('_SKIN_NEW_TITLE',			'新面版');
define('_SKIN_NAME',				'名稱');
define('_SKIN_DESC',				'描述');
define('_SKIN_TYPE',				'內容類型');
define('_SKIN_CREATE',				'建立');
define('_SKIN_CREATE_BTN',			'建立面版');
define('_SKIN_EDITONE_TITLE',		'編輯面版');
define('_SKIN_BACK',				'返回面版總覽');
define('_SKIN_PARTS_TITLE',			'面版部分');
define('_SKIN_PARTS_MSG',			'不是所有的格式都需要. 把妳不要的留空白. 編輯下面妳需要的:');
define('_SKIN_PART_MAIN',			'首頁');
define('_SKIN_PART_ITEM',			'文章頁面');
define('_SKIN_PART_ALIST',			'檔案列表');
define('_SKIN_PART_ARCHIVE',		'檔案夾');
define('_SKIN_PART_SEARCH',			'搜尋');
define('_SKIN_PART_ERROR',			'錯誤');
define('_SKIN_PART_MEMBER',			'會員詳細資料');
define('_SKIN_PART_POPUP',			'圖片popups');
define('_SKIN_GENSETTINGS_TITLE',	'一般設定');
define('_SKIN_CHANGE',				'更新');
define('_SKIN_CHANGE_BTN',			'更新這些設定');
define('_SKIN_UPDATE_BTN',			'更新面版');
define('_SKIN_RESET_BTN',			'重設定資料');
define('_SKIN_EDITPART_TITLE',		'編輯面版');
define('_SKIN_GOBACK',				'返回');
define('_SKIN_ALLOWEDVARS',			'允許的表達方式(按這裡看相關資訊):');

// global settings
define('_SETTINGS_TITLE',			'全區設定');
define('_SETTINGS_SUB_GENERAL',		'全區設定');
define('_SETTINGS_DEFBLOG',			'預設網誌');
define('_SETTINGS_ADMINMAIL',		'超級管理員的郵件');
define('_SETTINGS_SITENAME',		'網站名稱');
define('_SETTINGS_SITEURL',			'網站網址(要加上反斜線)');
define('_SETTINGS_ADMINURL',		'管理中心網址(要加上反斜線)');
define('_SETTINGS_DIRS',			'Nucleus系統目錄');
define('_SETTINGS_MEDIADIR',		'多媒體檔案目錄');
define('_SETTINGS_SEECONFIGPHP',	'(請看 config.php)');
define('_SETTINGS_MEDIAURL',		'多媒體檔案目錄的網址(要加上反斜線)');
define('_SETTINGS_ALLOWUPLOAD',		'是否允許檔案上傳?');
define('_SETTINGS_ALLOWUPLOADTYPES','允許上傳的檔案格式');
define('_SETTINGS_CHANGELOGIN',		'允許會員更改登入密碼');
define('_SETTINGS_COOKIES_TITLE',	'Cookie設定');
define('_SETTINGS_COOKIELIFE',		'Cookie保存時間');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'保存一個月');
define('_SETTINGS_COOKIEPATH',		'Cookie路徑(進階設定)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain(進階設定)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie(進階設定)');
define('_SETTINGS_LASTVISIT',		'保存上次訪問的Cookies');
define('_SETTINGS_ALLOWCREATE',		'開放註冊');
define('_SETTINGS_NEWLOGIN',		'允許新註冊的帳號登陸');
define('_SETTINGS_NEWLOGIN2',		'(只對新註冊的帳號有效)');
define('_SETTINGS_MEMBERMSGS',		'允許Member-2-Member的服務');
define('_SETTINGS_LANGUAGE',		'預設語言Default Language');
define('_SETTINGS_DISABLESITE',		'關閉網站');
define('_SETTINGS_DBLOGIN',			'mySQL 登入 &amp; 資料庫');
define('_SETTINGS_UPDATE',			'變更設定');
define('_SETTINGS_UPDATE_BTN',		'變更設定');
define('_SETTINGS_DISABLEJS',		'關閉 JavaScript 工具列');
define('_SETTINGS_MEDIA',			'多媒體/檔案上傳 設定');
define('_SETTINGS_MEDIAPREFIX',		'在上傳的檔案名稱前加上時間');
define('_SETTINGS_MEMBERS',			'會員設定');

// bans
define('_BAN_TITLE',				'已封鎖的IP列表給');
define('_BAN_NONE',					'這個網誌沒有封鎖任何IP');
define('_BAN_NEW_TITLE',			'新增封鎖IP');
define('_BAN_NEW_TEXT',				'現在新增封鎖的IP');
define('_BAN_REMOVE_TITLE',			'取消封鎖');
define('_BAN_IPRANGE',				'IP位置');
define('_BAN_BLOGS',				'給哪個網誌?');
define('_BAN_DELETE_TITLE',			'刪除封鎖');
define('_BAN_ALLBLOGS',				'任何妳有管理權限的網誌.');
define('_BAN_REMOVED_TITLE',		'已取消封鎖');
define('_BAN_REMOVED_TEXT',			'已取消對以下網誌的封鎖:');
define('_BAN_ADD_TITLE',			'增加封鎖');
define('_BAN_IPRANGE_TEXT',			'選擇妳要封鎖的IP.');
define('_BAN_BLOGS_TEXT',			'妳可以只為一個網誌封鎖一個IP, 或全部的網誌都封鎖同一個IP. 在下面做出妳的選擇.');
define('_BAN_REASON_TITLE',			'原因');
define('_BAN_REASON_TEXT',			'妳可以為這個封鎖留下註解/原因, 以免以後忘記.');
define('_BAN_ADD_BTN',				'增加封鎖');

// LOGIN screen
define('_LOGIN_MESSAGE',			'訊息');
define('_LOGIN_NAME',				'名稱');
define('_LOGIN_PASSWORD',			'密碼');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'忘記妳的密碼?');

// membermanagement
define('_MEMBERS_TITLE',			'會員管理');
define('_MEMBERS_CURRENT',			'目前的會員');
define('_MEMBERS_NEW',				'新增會員');
define('_MEMBERS_DISPLAY',			'顯示的名稱');
define('_MEMBERS_DISPLAY_INFO',		'(這是妳要用來登入的帳號)');
define('_MEMBERS_REALNAME',			'真實姓名');
define('_MEMBERS_PWD',				'密碼');
define('_MEMBERS_REPPWD',			'再次確認密碼');
define('_MEMBERS_EMAIL',			'郵件網址');
define('_MEMBERS_EMAIL_EDIT',		'(當妳變更郵件網址, 將會發送新的密碼到妳的信箱)');
define('_MEMBERS_URL',				'網站網址');
define('_MEMBERS_SUPERADMIN',		'系統管理員');
define('_MEMBERS_CANLOGIN',			'可以進入管理中心');
define('_MEMBERS_NOTES',			'備註');
define('_MEMBERS_NEW_BTN',			'增加會員');
define('_MEMBERS_EDIT',				'設定個人資料');
define('_MEMBERS_EDIT_BTN',			'變更設定');
define('_MEMBERS_BACKTOOVERVIEW',	'返回會員管理');
define('_MEMBERS_DEFLANG',			'語言Language');
define('_MEMBERS_USESITELANG',		'- 使用網站設定 -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'訪問網站');
define('_BLOGLIST_ADD',				'新增文章');
define('_BLOGLIST_TT_ADD',			'增加新的文章到這個網誌');
define('_BLOGLIST_EDIT',			'編輯/刪除 文章');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'設定');
define('_BLOGLIST_TT_SETTINGS',		'設定或編輯群組');
define('_BLOGLIST_BANS',			'IP管理');
define('_BLOGLIST_TT_BANS',			'檢視, 增加或移除封鎖的IP');
define('_BLOGLIST_DELETE',			'刪除全部');
define('_BLOGLIST_TT_DELETE',		'刪除這個網誌');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'妳的網誌');
define('_OVERVIEW_YRDRAFTS',		'妳的草稿');
define('_OVERVIEW_YRSETTINGS',		'妳的設定');
define('_OVERVIEW_GSETTINGS',		'一般設定');
define('_OVERVIEW_NOBLOGS',			'妳不在任何的網誌群組內');
define('_OVERVIEW_NODRAFTS',		'沒有草稿');
define('_OVERVIEW_EDITSETTINGS',	'編輯妳的設定...');
define('_OVERVIEW_BROWSEITEMS',		'瀏覽妳的文章...');
define('_OVERVIEW_BROWSECOMM',		'瀏覽妳的迴響...');
define('_OVERVIEW_VIEWLOG',			'檢視動作記錄...');
define('_OVERVIEW_MEMBERS',			'會員管理...');
define('_OVERVIEW_NEWLOG',			'新增網誌...');
define('_OVERVIEW_SETTINGS',		'編輯設定...');
define('_OVERVIEW_TEMPLATES',		'編輯模版...');
define('_OVERVIEW_SKINS',			'編輯面版...');
define('_OVERVIEW_BACKUP',			'備份/還原...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'網誌的文章'); 
define('_ITEMLIST_YOUR',			'妳的文章');

// Comments
define('_COMMENTS',					'迴響<br>');
define('_NOCOMMENTS',				'沒有這篇文章的迴響');
define('_COMMENTS_YOUR',			'妳的迴響');
define('_NOCOMMENTS_YOUR',			'妳沒有給任何的迴響');

// LISTS (general)
define('_LISTS_NOMORE',				'沒有更多的項目或沒有項目');
define('_LISTS_PREV',				'上一篇');
define('_LISTS_NEXT',				'下一篇');
define('_LISTS_SEARCH',				'搜尋');
define('_LISTS_CHANGE',				'變更');
define('_LISTS_PERPAGE',			'文章/頁');
define('_LISTS_ACTIONS',			'動作');
define('_LISTS_DELETE',				'刪除');
define('_LISTS_EDIT',				'編輯<br>');
define('_LISTS_MOVE',				'移動<br>');
define('_LISTS_CLONE',				'完整複製');
define('_LISTS_TITLE',				'標題');
define('_LISTS_BLOG',				'網誌');
define('_LISTS_NAME',				'名稱');
define('_LISTS_DESC',				'描述');
define('_LISTS_TIME',				'時間');
define('_LISTS_COMMENTS',			'迴響<br>');
define('_LISTS_TYPE',				'格式');


// member list 
define('_LIST_MEMBER_NAME',			'顯示名稱');
define('_LIST_MEMBER_RNAME',		'真實姓名');
define('_LIST_MEMBER_ADMIN',		'超級管理員? ');
define('_LIST_MEMBER_LOGIN',		'可以登入? ');
define('_LIST_MEMBER_URL',			'網站');

// banlist
define('_LIST_BAN_IPRANGE',			'IP範圍');
define('_LIST_BAN_REASON',			'原因');

// actionlist
define('_LIST_ACTION_MSG',			'訊息');

// commentlist
define('_LIST_COMMENT_BANIP',		'禁止IP');
define('_LIST_COMMENT_WHO',			'作者');
define('_LIST_COMMENT',				'迴響');
define('_LIST_COMMENT_HOST',		'主機');

// itemlist
define('_LIST_ITEM_INFO',			'資訊');
define('_LIST_ITEM_CONTENT',		'標題和內文');


// teamlist
define('_LIST_TEAM_ADMIN',			'系統管理員 ');
define('_LIST_TEAM_CHADMIN',		'變更系統管理員');

// edit comments
define('_EDITC_TITLE',				'編輯迴響');
define('_EDITC_WHO',				'作者');
define('_EDITC_HOST',				'來自');
define('_EDITC_WHEN',				'時間');
define('_EDITC_TEXT',				'文字');
define('_EDITC_EDIT',				'編輯迴響');
define('_EDITC_MEMBER',				'使用者');
define('_EDITC_NONMEMBER',			'分使用者');

// move item
define('_MOVE_TITLE',				'移到哪一個網誌?');
define('_MOVE_BTN',					'移動文章');


