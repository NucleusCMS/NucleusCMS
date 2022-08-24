<?php
// English Nucleus Language File
// 
// Author：Wouter Demuynck (nucleus@demuynck.org)
// Nucleus version：v1.0-v2.0
//
// Please note：if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'查看');
define('_MEDIA_VIEW_TT',			'查看文件（在新窗口中打開）');
define('_MEDIA_FILTER_APPLY',		'應用過濾器');
define('_MEDIA_FILTER_LABEL',		'過濾器：');
define('_MEDIA_UPLOAD_TO',			'上載到…');
define('_MEDIA_UPLOAD_NEW',			'上載新文件…');
define('_MEDIA_COLLECTION_SELECT',	'選取');
define('_MEDIA_COLLECTION_TT',		'切換到這個目錄');
define('_MEDIA_COLLECTION_LABEL',	'當前收藏：');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'左對齊');
define('_ADD_ALIGNRIGHT_TT',		'右對齊');
define('_ADD_ALIGNCENTER_TT',		'居中');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'搜索時包括');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'上載失敗');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'允許發表到過去');
define('_ADD_CHANGEDATE',			'更新時間標記');
define('_BMLET_CHANGEDATE',			'更新時間標記');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'面板導入/導出…');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'普通');
define('_PARSER_INCMODE_SKINDIR',	'使用面板目錄');
define('_SKIN_INCLUDE_MODE',		'包括方式');
define('_SKIN_INCLUDE_PREFIX',		'包括前綴');

// global settings
define('_SETTINGS_BASESKIN',		'基本面板');
define('_SETTINGS_SKINSURL',		'面板URL');
define('_SETTINGS_ACTIONSURL',		'action.php的完整URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'不能移動默認類別');
define('_ERROR_MOVETOSELF',			'無法移動類別（描述日誌與源日誌相同）');
define('_MOVECAT_TITLE',			'將類別移動到');
define('_MOVECAT_BTN',				'移動類別');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL模式');
define('_SETTINGS_URLMODE_NORMAL',	'普通');
define('_SETTINGS_URLMODE_PATHINFO','優雅');

// Batch operations
define('_BATCH_NOSELECTION',		'沒有選擇動作執行的對象');
define('_BATCH_ITEMS',				'文章批處理');
define('_BATCH_CATEGORIES',			'類別批處裡');
define('_BATCH_MEMBERS',			'會員批處理');
define('_BATCH_TEAM',				'團隊會員批處理');
define('_BATCH_COMMENTS',			'評論批處理');
define('_BATCH_UNKNOWN',			'未知批處理：');
define('_BATCH_EXECUTING',			'執行');
define('_BATCH_ONCATEGORY',			'在類別');
define('_BATCH_ONITEM',				'在文章');
define('_BATCH_ONCOMMENT',			'在評論');
define('_BATCH_ONMEMBER',			'在會員');
define('_BATCH_ONTEAM',				'在團隊會員');
define('_BATCH_SUCCESS',			'成功！');
define('_BATCH_DONE',				'完成！');
define('_BATCH_DELETE_CONFIRM',		'確認批刪除');
define('_BATCH_DELETE_CONFIRM_BTN',	'確認批刪除');
define('_BATCH_SELECTALL',			'全選');
define('_BATCH_DESELECTALL',		'取消全選');

// batch operations：options in dropdowns
define('_BATCH_ITEM_DELETE',		'刪除');
define('_BATCH_ITEM_MOVE',			'移動');
define('_BATCH_MEMBER_DELETE',		'刪除');
define('_BATCH_MEMBER_SET_ADM',		'授予超級用戶權限');
define('_BATCH_MEMBER_UNSET_ADM',	'剝奪超級用戶權限');
define('_BATCH_TEAM_DELETE',		'從團隊刪除');
define('_BATCH_TEAM_SET_ADM',		'授予超級用戶權限');
define('_BATCH_TEAM_UNSET_ADM',		'剝奪超級用戶權限');
define('_BATCH_CAT_DELETE',			'刪除');
define('_BATCH_CAT_MOVE',			'移動到其他日誌');
define('_BATCH_COMMENT_DELETE',		'刪除');

// itemlist：Add new item…
define('_ITEMLIST_ADDNEW',			'添加新文章…');
define('_ADD_PLUGIN_EXTRAS',		'擴展插件選項');

// errors
define('_ERROR_CATCREATEFAIL',		'無法建立新類別');
define('_ERROR_NUCLEUSVERSIONREQ',	'該插件需要更新版本的Nucleus：');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'返回日誌設置');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'導入');
define('_SKINIE_TITLE_EXPORT',		'導出');
define('_SKINIE_BTN_IMPORT',		'導入');
define('_SKINIE_BTN_EXPORT',		'導出,選擇面板/模版');
define('_SKINIE_LOCAL',				'從本地文件導入：');
define('_SKINIE_NOCANDIDATES',		'在面板路徑中沒有找到任何候選文件');
define('_SKINIE_FROMURL',			'從URL導入：');
define('_SKINIE_EXPORT_INTRO',		'從下面選擇您想要導出的面板或模版');
define('_SKINIE_EXPORT_SKINS',		'面板');
define('_SKINIE_EXPORT_TEMPLATES',	'模版');
define('_SKINIE_EXPORT_EXTRA',		'更多信息');
define('_SKINIE_CONFIRM_OVERWRITE',	'覆蓋已經存在的面板文件（察看名稱衝突）');
define('_SKINIE_CONFIRM_IMPORT',	'是的，我想導入該文件');
define('_SKINIE_CONFIRM_TITLE',		'取消導入面板與模版');
define('_SKINIE_INFO_SKINS',		'文件中的面板：');
define('_SKINIE_INFO_TEMPLATES',	'文件中的模版：');
define('_SKINIE_INFO_GENERAL',		'信息：');
define('_SKINIE_INFO_SKINCLASH',	'面板名字衝突：');
define('_SKINIE_INFO_TEMPLCLASH',	'模版名字衝突：');
define('_SKINIE_INFO_IMPORTEDSKINS','已導入的面板：');
define('_SKINIE_INFO_IMPORTEDTEMPLS','已導入的模版：');
define('_SKINIE_DONE',				'完成導入');

define('_AND',						'和');
define('_OR',						'或');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'空(點擊編輯)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'包括方式：');
define('_LIST_SKINS_INCPREFIX',		'包括前綴：');
define('_LIST_SKINS_DEFINED',		'確定部分：');

// backup
define('_BACKUPS_TITLE',			'備份 / 恢復');
define('_BACKUP_TITLE',				'備份');
define('_BACKUP_INTRO',				'點擊下面的按鈕建立一份新聞系統的備份數據庫.按照提示保存一個備份文件，將它保存在安全的地方。');
define('_BACKUP_ZIP_YES',			'嘗試使用壓縮');
define('_BACKUP_ZIP_NO',			'不使用壓縮');
define('_BACKUP_BTN',				'建立備份');
define('_BACKUP_NOTE',				'<b>注意：</b> 只有數據庫的內容在備份中保存，不包括<b>config.php</b>.');
define('_RESTORE_TITLE',			'恢復');
define('_RESTORE_NOTE',				'<b>注意：</b> 恢復一個數據庫 <b>清除</b> 當前系統數據庫中的所有數據！當你真的確定之後才可以執行此操作!	<br />	<b>注意：</b>確定生成備份文件的的文章系統的版本與你現在所使用的版本相同！否則可能無法正常工作');
define('_RESTORE_INTRO',			'選擇下面的備份文件(它將會被調入到服務器) 點擊「恢復」按鈕開始.');
define('_RESTORE_IMSURE',			'是的，我確定執行此操作！');
define('_RESTORE_BTN',				'從文件中恢復');
define('_RESTORE_WARNING',			'(確定你正在恢復一個正確的備份，在你開始之前你可以建立一個當前備份)');
define('_ERROR_BACKUP_NOTSURE',		'你需要檢查一下我確定');
define('_RESTORE_COMPLETE',			'恢復完成');

// new item notification
define('_NOTIFY_NI_MSG',			'您的新文章已經發表：');
define('_NOTIFY_NI_TITLE',			'新文章！');
define('_NOTIFY_KV_MSG',			'文章投票：');
define('_NOTIFY_KV_TITLE',			'投票系統：');
define('_NOTIFY_NC_MSG',			'文章評論：');
define('_NOTIFY_NC_TITLE',			'系統評論：');
define('_NOTIFY_USERID',			'用戶ID：');
define('_NOTIFY_USER',				'用戶：');
define('_NOTIFY_COMMENT',			'評論：');
define('_NOTIFY_VOTE',				'投票：');
define('_NOTIFY_HOST',				'主持人：');
define('_NOTIFY_IP',				'IP：');
define('_NOTIFY_MEMBER',			'會員：');
define('_NOTIFY_TITLE',				'標題：');
define('_NOTIFY_CONTENTS',			'內容：');

// member mail message
define('_MMAIL_MSG',				'送給你的一條消息，由');
define('_MMAIL_FROMANON',			'匿名訪問');
define('_MMAIL_FROMNUC',			'由Nucleus系統發送');
define('_MMAIL_TITLE',				'一條消息來自');
define('_MMAIL_MAIL',				'消息：');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'添加文章');
define('_BMLET_EDIT',				'編輯文章');
define('_BMLET_DELETE',				'刪除文章');
define('_BMLET_BODY',				'摘要/簡訊');
define('_BMLET_MORE',				'更多/擴展');
define('_BMLET_OPTIONS',			'選項');
define('_BMLET_PREVIEW',			'預覽');

// used in bookmarklet
define('_ITEM_UPDATED',				'文章已更新');
define('_ITEM_DELETED',				'文章已被刪除');

// plugins
define('_CONFIRMTXT_PLUGIN',		'確定將要刪除已經命名的插件嗎？');
define('_ERROR_NOSUCHPLUGIN',		'沒有這樣的插件');
define('_ERROR_DUPPLUGIN',			'對不起，這個插件已經安裝');
define('_ERROR_PLUGFILEERROR',		'不存在該插件或者權限未正確設定');
define('_PLUGS_NOCANDIDATES',		'沒有找到候選插件');

define('_PLUGS_TITLE_MANAGE',		'插件管理');
define('_PLUGS_TITLE_INSTALLED',	'當前已經安裝');
define('_PLUGS_TITLE_UPDATE',		'更新預定列表');
define('_PLUGS_TEXT_UPDATE',		'Nucleus為插件保存了事件描述的緩存。當你升級替換插件後，應該運行升級程序以保證事件描述得到更新');
define('_PLUGS_TITLE_NEW',			'安裝新插件');
define('_PLUGS_ADD_TEXT',			'下面是你插件目錄中所有文件的列表，那可能是未安裝的的插件。在安裝之前請<strong>確認</strong>那是一個有效的插件文件。');
define('_PLUGS_BTN_INSTALL',		'安裝插件');
define('_BACKTOOVERVIEW',			'返回總覽');

// editlink
define('_TEMPLATE_EDITLINK',		'編輯文章鏈接');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'添加左邊盒子');
define('_ADD_RIGHT_TT',				'添加右邊盒子');

// add/edit item：new category (in dropdown box)
define('_ADD_NEWCAT',				'新類別…');

// new settings
define('_SETTINGS_PLUGINURL',		'插件URL');
define('_SETTINGS_MAXUPLOADSIZE',	'上傳文件最大容量（bytes）');
define('_SETTINGS_NONMEMBERMSGS',	'允許非會員發送消息');
define('_SETTINGS_PROTECTMEMNAMES',	'保護會員名字');

// overview screen
define('_OVERVIEW_PLUGINS',			'管理插件…');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'新會員註冊：');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'你的郵件地址：');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'你沒有將文件上傳到媒體目錄的權力');

// plugin list
define('_LISTS_INFO',				'信息');
define('_LIST_PLUGS_AUTHOR',		'由：');
define('_LIST_PLUGS_VER',			'版本：');
define('_LIST_PLUGS_SITE',			'訪問網站');
define('_LIST_PLUGS_DESC',			'描述：');
define('_LIST_PLUGS_SUBS',			'下列事件的預定：');
define('_LIST_PLUGS_UP',			'上移');
define('_LIST_PLUGS_DOWN',			'下移');
define('_LIST_PLUGS_UNINSTALL',		'卸載');
define('_LIST_PLUGS_ADMIN',			'管理');
define('_LIST_PLUGS_OPTIONS',		'編輯');

// plugin option list
define('_LISTS_VALUE',				'值');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'這個插件沒有任何選項設置');
define('_PLUGS_BACK',				'返回插件總覽');
define('_PLUGS_SAVE',				'保存選項');
define('_PLUGS_OPTIONS_UPDATED',	'插件選項已經更新');

define('_OVERVIEW_MANAGEMENT',		'管理');
define('_OVERVIEW_MANAGE',			'系統管理…');
define('_MANAGE_GENERAL',			'普通管理');
define('_MANAGE_SKINS',				'面板與模版');
define('_MANAGE_EXTRA',				'擴展功能');

define('_BACKTOMANAGE',				'返回系統管理');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'big5');

// global stuff
define('_LOGOUT',					'登出');
define('_LOGIN',					'登入');
define('_YES',						'是');
define('_NO',						'否');
define('_SUBMIT',					'提交');
define('_ERROR',					'錯誤');
define('_ERRORMSG',					'出現一個錯誤！');
define('_BACK',						'返回');
define('_NOTLOGGEDIN',				'未登錄');
define('_LOGGEDINAS',				'已登錄：');
define('_ADMINHOME',				'管理中心');
define('_NAME',						'名字');
define('_BACKHOME',					'返回管理中心');
define('_BADACTION',				'沒有存在的動作請求');
define('_MESSAGE',					'消息');
define('_HELP_TT',					'幫助');
define('_YOURSITE',					'本網站');


define('_POPUP_CLOSE',				'關閉窗口');

define('_LOGIN_PLEASE',				'請先登錄');

// commentform
define('_COMMENTFORM_YOUARE',		'你是');
define('_COMMENTFORM_SUBMIT',		'添加評論');
define('_COMMENTFORM_COMMENT',		'你的評論');
define('_COMMENTFORM_NAME',			'名字');
define('_COMMENTFORM_MAIL',			'郵件/網站');
define('_COMMENTFORM_REMEMBER',		'提醒我');

// loginform
define('_LOGINFORM_NAME',			'用戶名');
define('_LOGINFORM_PWD',			'密碼');
define('_LOGINFORM_YOUARE',			'已登錄：');
define('_LOGINFORM_SHARED',			'公共場所電腦');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'發送消息');

// search form
define('_SEARCHFORM_SUBMIT',		'搜索');

// add item form
define('_ADD_ADDTO',				'添加新文章到');
define('_ADD_CREATENEW',			'建立新文章');
define('_ADD_BODY',					'概況');
define('_ADD_TITLE',				'標題');
define('_ADD_MORE',					'擴展(可選)');
define('_ADD_CATEGORY',				'類別');
define('_ADD_PREVIEW',				'預覽');
define('_ADD_DISABLE_COMMENTS',		'關閉評論？');
define('_ADD_DRAFTNFUTURE',			'草稿 &amp; 未來項目');
define('_ADD_ADDITEM',				'添加文章');
define('_ADD_ADDNOW',				'現在添加');
define('_ADD_ADDLATER',				'以後添加');
define('_ADD_PLACE_ON',				'設定時間');
define('_ADD_ADDDRAFT',				'添加到草稿');
define('_ADD_NOPASTDATES',			'（過去的日期和時間是無效的，系統將使用當前時間）');
define('_ADD_BOLD_TT',				'粗體');
define('_ADD_ITALIC_TT',			'斜體');
define('_ADD_HREF_TT',				'建立超級鏈接');
define('_ADD_MEDIA_TT',				'添加媒體文件');
define('_ADD_PREVIEW_TT',			'顯示/隱藏 預覽');
define('_ADD_CUT_TT',				'切除');
define('_ADD_COPY_TT',				'複製');
define('_ADD_PASTE_TT',				'剪貼');


// edit item form
define('_EDIT_ITEM',				'編輯文章');
define('_EDIT_SUBMIT',				'編輯文章');
define('_EDIT_ORIG_AUTHOR',			'原創作者');
define('_EDIT_BACKTODRAFTS',		'添加回草稿');
define('_EDIT_COMMENTSNOTE',		'（注意：關閉評論並不能刪除現有評論）');

// used on delete screens
define('_DELETE_CONFIRM',			'請確認刪除動作');
define('_DELETE_CONFIRM_BTN',		'確認刪除');
define('_CONFIRMTXT_ITEM',			'你將刪除以下文章：');
define('_CONFIRMTXT_COMMENT',		'你將刪除以下評論：');
define('_CONFIRMTXT_TEAM1',			'即將刪除');
define('_CONFIRMTXT_TEAM2',			'從日誌團隊列表中');
define('_CONFIRMTXT_BLOG',			'你將要刪除的日誌為：');
define('_WARNINGTXT_BLOGDEL',		'警告！刪除日誌將會刪除其上的的所有文章和評論。請確定是否真的要刪除日誌<br />同時，在移動日誌時不要終止系統。');
define('_CONFIRMTXT_MEMBER',		'你將會刪除下面會員檔案：');
define('_CONFIRMTXT_TEMPLATE',		'你將刪除已命名的模版');
define('_CONFIRMTXT_SKIN',			'你將刪除已命名的面板 ');
define('_CONFIRMTXT_BAN',			'你將刪除對這些IP的封鎖');
define('_CONFIRMTXT_CATEGORY',		'你將刪除類別');

// some status messages
define('_DELETED_ITEM',				'文章已刪除');
define('_DELETED_MEMBER',			'會員已刪除');
define('_DELETED_COMMENT',			'評論已刪除');
define('_DELETED_BLOG',				'日誌已刪除');
define('_DELETED_CATEGORY',			'類別已刪除');
define('_ITEM_MOVED',				'文章已移動');
define('_ITEM_ADDED',				'文章已添加');
define('_COMMENT_UPDATED',			'評論已更新');
define('_SKIN_UPDATED',				'面板日期已經保存');
define('_TEMPLATE_UPDATED',			'模版日期已經保存');

// errors
define('_ERROR_COMMENT_LONGWORD',	'請不要使用長度超過90個字符的單詞');
define('_ERROR_COMMENT_NOCOMMENT',	'請輸入一條評論');
define('_ERROR_COMMENT_NOUSERNAME',	'錯誤的用戶名');
define('_ERROR_COMMENT_TOOLONG',	'你的評論太長(最長：2500字)');
define('_ERROR_COMMENTS_DISABLED',	'這個日誌的評論已經被禁止.');
define('_ERROR_COMMENTS_NONPUBLIC',	'你必須以會員身份登錄才可以添加評論');
define('_ERROR_COMMENTS_MEMBERNICK','你想使用的這個名字已經被其他人使用，請另選一個。');
define('_ERROR_SKIN',				'面板錯誤');
define('_ERROR_ITEMCLOSED',			'這篇文章已經關閉，不能添加評論和投票');
define('_ERROR_NOSUCHITEM',			'沒有這篇文章');
define('_ERROR_NOSUCHBLOG',			'沒有這個日誌');
define('_ERROR_NOSUCHSKIN',			'沒有這個面板');
define('_ERROR_NOSUCHMEMBER',		'沒有這個會員');
define('_ERROR_NOTONTEAM',			'你不在該日誌的團隊列表上。');
define('_ERROR_BADDESTBLOG',		'預定版不存在');
define('_ERROR_NOTONDESTTEAM',		'不能移動文章,你不在這個版的團隊列表上');
define('_ERROR_NOEMPTYITEMS',		'不能添加空文章！');
define('_ERROR_BADMAILADDRESS',		'Email地址無效');
define('_ERROR_BADNOTIFY',			'一個或多個郵件地址是無效的');
define('_ERROR_BADNAME',			'名字無效');
define('_ERROR_NICKNAMEINUSE',		'已經有一個會員使用那個暱稱');
define('_ERROR_PASSWORDMISMATCH',	'密碼必須匹配');
define('_ERROR_PASSWORDTOOSHORT',	'密碼最少6個字符');
define('_ERROR_PASSWORDMISSING',	'密碼不能為空');
define('_ERROR_REALNAMEMISSING',	'你必須輸入一個真實的名字');
define('_ERROR_ATLEASTONEADMIN',	'系統至少應該存在一個可以登錄到管理界面的超級用戶。');
define('_ERROR_ATLEASTONEBLOGADMIN','請確定總是至少有一個超級用戶。');
define('_ERROR_ALREADYONTEAM',		'團隊中已經存在這個會員');
define('_ERROR_BADSHORTBLOGNAME',	'日誌縮寫只允許包含a-z,0-9');
define('_ERROR_DUPSHORTBLOGNAME',	'其他日誌已經使用這個縮寫名稱');
define('_ERROR_UPDATEFILE',			'對升級文件沒有寫入權限，請確定文件權限設置正確（chmod 666）。同時注意路徑是基於管理目錄的相對路徑，所以你可能需要使用絕對路徑（如/your/path/to/nucleus/）。');
define('_ERROR_DELDEFBLOG',			'不能刪除默認日誌');
define('_ERROR_DELETEMEMBER',		'該會員無法刪除，他可能是文章或評論的作者');
define('_ERROR_BADTEMPLATENAME',	'無效的模版名（只允許a-z, 0-9）');
define('_ERROR_DUPTEMPLATENAME',	'已存在這樣一個名字的模版');
define('_ERROR_BADSKINNAME',		'無效面板名（只允許a-z, 0-9）');
define('_ERROR_DUPSKINNAME',		'已存在同名面板');
define('_ERROR_DEFAULTSKIN',		'系統必須有一個名為"default"的默認面板');
define('_ERROR_SKINDEFDELETE',		'這是默認面板，不能刪除：');
define('_ERROR_DISALLOWED',			'對不起，你沒有權力執行該動作');
define('_ERROR_DELETEBAN',			'刪除封鎖的時候發生錯誤（封鎖不存在）。');
define('_ERROR_ADDBAN',				'添加封鎖的時候發生錯誤，它可能沒有正確添加到你的所有日誌裡。');
define('_ERROR_BADACTION',			'需要的動作不存在');
define('_ERROR_MEMBERMAILDISABLED',	'會員到會員的郵件消息被禁止');
define('_ERROR_MEMBERCREATEDISABLED','建立會員賬號被禁止');
define('_ERROR_INCORRECTEMAIL',		'不正確的郵件地址');
define('_ERROR_VOTEDBEFORE',		'你已經為這個文章投過票了');
define('_ERROR_BANNED1',			'動作無法執行（IP範圍');
define('_ERROR_BANNED2',			'）被封鎖。消息為：\'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'執行這個動作必須登錄');
define('_ERROR_CONNECT',			'連接錯誤');
define('_ERROR_FILE_TOO_BIG',		'文件太大！');
define('_ERROR_BADFILETYPE',		'對不起，不允許上傳這種格式的文件');
define('_ERROR_BADREQUEST',			'無效的上傳請求');
define('_ERROR_DISALLOWEDUPLOAD',	'你不在任何日誌的團隊列表中，沒有上傳文件的權力');
define('_ERROR_BADPERMISSIONS',		'文件/目錄權限設置不正確');
define('_ERROR_UPLOADMOVEP',		'上傳文件時發生錯誤');
define('_ERROR_UPLOADCOPY',			'拷貝文件時發生錯誤');
define('_ERROR_UPLOADDUPLICATE',	'已經有一個同名文件，上傳之前請先改名。');
define('_ERROR_LOGINDISALLOWED',	'對不起，你不能登錄管理區。但可以用其他用戶身份登錄');
define('_ERROR_DBCONNECT',			'無法連接到 MySQL 服務器');
define('_ERROR_DBSELECT',			'無法選擇文章系統的數據庫');
define('_ERROR_NOSUCHLANGUAGE',		'沒有這個語言文件');
define('_ERROR_NOSUCHCATEGORY',		'沒有這個類別');
define('_ERROR_DELETELASTCATEGORY',	'至少一個類別');
define('_ERROR_DELETEDEFCATEGORY',	'不能刪除默認類別');
define('_ERROR_BADCATEGORYNAME',	'無效類別名');
define('_ERROR_DUPCATEGORYNAME',	'已經存在同名類別');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'警告：當前值非目錄！');
define('_WARNING_NOTREADABLE',		'警告：當前值為不可讀取的目錄！');
define('_WARNING_NOTWRITABLE',		'警告：當前值為不可讀取的目錄！');

// media and upload
define('_MEDIA_UPLOADLINK',			'上傳一個新文件');
define('_MEDIA_MODIFIED',			'修改');
define('_MEDIA_FILENAME',			'文件名');
define('_MEDIA_DIMENSIONS',			'尺寸');
define('_MEDIA_INLINE',				'本窗口');
define('_MEDIA_POPUP',				'新窗口');
define('_UPLOAD_TITLE',				'選擇文件');
define('_UPLOAD_MSG',				'選擇你想上傳的文件，然後點擊 \'Upload\' 按鈕。');
define('_UPLOAD_BUTTON',			'上傳');

// some status messages
define('_MSG_ACCOUNTCREATED',		'賬號已建立，密碼將會通過郵件通知你');
define('_MSG_PASSWORDSENT',			'密碼已通過郵件發出。');
define('_MSG_LOGINAGAIN',			'你需要重新登錄，因為你的信息已經改變。');
define('_MSG_SETTINGSCHANGED',		'設置改變');
define('_MSG_ADMINCHANGED',			'管理員改變');
define('_MSG_NEWBLOG',				'新的日誌已建立');
define('_MSG_ACTIONLOGCLEARED',		'動作記錄清空');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'不允許的動作：');
define('_ACTIONLOG_PWDREMINDERSENT','新密碼送出為');
define('_ACTIONLOG_TITLE',			'動作記錄');
define('_ACTIONLOG_CLEAR_TITLE',	'清除動作記錄');
define('_ACTIONLOG_CLEAR_TEXT',		'現在就清除動作記錄');

// team management
define('_TEAM_TITLE',				'為日誌管理團隊 ');
define('_TEAM_CURRENT',				'當前團隊');
define('_TEAM_ADDNEW',				'向團隊中添加新會員');
define('_TEAM_CHOOSEMEMBER',		'選擇會員');
define('_TEAM_ADMIN',				'超級管理員權限？ ');
define('_TEAM_ADD',					'添加到團隊');
define('_TEAM_ADD_BTN',				'添加到團隊');

// blogsettings
define('_EBLOG_TITLE',				'編輯日誌設置');
define('_EBLOG_TEAM_TITLE',			'編輯團隊');
define('_EBLOG_TEAM_TEXT',			'點擊這裡編輯你的團隊…');
define('_EBLOG_SETTINGS_TITLE',		'日誌設置');
define('_EBLOG_NAME',				'日誌名');
define('_EBLOG_SHORTNAME',			'日誌名縮寫');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(只允許包含 a-z )');
define('_EBLOG_DESC',				'日誌描述');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'默認面板');
define('_EBLOG_DEFCAT',				'默認類別');
define('_EBLOG_LINEBREAKS',			'轉換行中斷');
define('_EBLOG_DISABLECOMMENTS',	'開啟評論');
define('_EBLOG_ANONYMOUS',			'允許非會員評論');
define('_EBLOG_NOTIFY',				'通知地址（多個地址用 ; 分隔）');
define('_EBLOG_NOTIFY_ON',			'以下事件通知');
define('_EBLOG_NOTIFY_COMMENT',		'新評論');
define('_EBLOG_NOTIFY_KARMA',		'新的投票');
define('_EBLOG_NOTIFY_ITEM',		'新的日誌');
define('_EBLOG_PING',				'更新時 Ping Weblogs.com？');
define('_EBLOG_MAXCOMMENTS',		'最多允許評論數量');
define('_EBLOG_UPDATE',				'更新文件');
define('_EBLOG_OFFSET',				'時差');
define('_EBLOG_STIME',				'當前服務器時間為');
define('_EBLOG_BTIME',				'當前日誌時間為');
define('_EBLOG_CHANGE',				'改變設置');
define('_EBLOG_CHANGE_BTN',			'改變設置');
define('_EBLOG_ADMIN',				'日誌管理員');
define('_EBLOG_ADMIN_MSG',			'將被授予管理員權力');
define('_EBLOG_CREATE_TITLE',		'創建新日誌');
define('_EBLOG_CREATE_TEXT',		'填寫下面的表單創建一個新日誌. <br /><br /> <b>注意：</b> 列表中只有必要的選項，如果你想更改更多的選項，創建後再到相應的設置中去修改。');
define('_EBLOG_CREATE',				'創建！');
define('_EBLOG_CREATE_BTN',			'創建日誌');
define('_EBLOG_CAT_TITLE',			'類別');
define('_EBLOG_CAT_NAME',			'類別名');
define('_EBLOG_CAT_DESC',			'類別描述');
define('_EBLOG_CAT_CREATE',			'創建新的類別');
define('_EBLOG_CAT_UPDATE',			'更新類別');
define('_EBLOG_CAT_UPDATE_BTN',		'更新類別');

// templates
define('_TEMPLATE_TITLE',			'編輯模版');
define('_TEMPLATE_AVAILABLE_TITLE',	'有效模版');
define('_TEMPLATE_NEW_TITLE',		'新模版');
define('_TEMPLATE_NAME',			'模版名');
define('_TEMPLATE_DESC',			'模版描述');
define('_TEMPLATE_CREATE',			'建立模版');
define('_TEMPLATE_CREATE_BTN',		'建立模版');
define('_TEMPLATE_EDIT_TITLE',		'編輯模版');
define('_TEMPLATE_BACK',			'返回模版總覽');
define('_TEMPLATE_EDIT_MSG',		'並非所有的模版都是需要的,你不需要的那些可以留空.');
define('_TEMPLATE_SETTINGS',		'模版設置');
define('_TEMPLATE_ITEMS',			'文章');
define('_TEMPLATE_ITEMHEADER',		'文章頭');
define('_TEMPLATE_ITEMBODY',		'文章體');
define('_TEMPLATE_ITEMFOOTER',		'文章尾');
define('_TEMPLATE_MORELINK',		'連接到擴展入口');
define('_TEMPLATE_NEW',				'新條目標誌');
define('_TEMPLATE_COMMENTS_ANY',	'評論');
define('_TEMPLATE_CHEADER',			'評論頭');
define('_TEMPLATE_CBODY',			'評論體');
define('_TEMPLATE_CFOOTER',			'評論尾');
define('_TEMPLATE_CONE',			'一條評論');
define('_TEMPLATE_CMANY',			'兩條（或更多）評論');
define('_TEMPLATE_CMORE',			'閱讀更多評論');
define('_TEMPLATE_CMEXTRA',			'會員擴展');
define('_TEMPLATE_COMMENTS_NONE',	'評論(如果沒有)');
define('_TEMPLATE_CNONE',			'沒有評論');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comments (太多，無法在線顯示)');
define('_TEMPLATE_CTOOMUCH',		'評論太多');
define('_TEMPLATE_ARCHIVELIST',		'檔案列表');
define('_TEMPLATE_AHEADER',			'檔案列表頭');
define('_TEMPLATE_AITEM',			'檔案列表項目');
define('_TEMPLATE_AFOOTER',			'檔案列表尾');
define('_TEMPLATE_DATETIME',		'日期和時間');
define('_TEMPLATE_DHEADER',			'日期頭');
define('_TEMPLATE_DFOOTER',			'日期尾');
define('_TEMPLATE_DFORMAT',			'日期格式');
define('_TEMPLATE_TFORMAT',			'時間格式');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'圖像新窗口');
define('_TEMPLATE_PCODE',			'新窗口');
define('_TEMPLATE_ICODE',			'嵌入圖像代碼');
define('_TEMPLATE_MCODE',			'媒體對像鏈接代碼');
define('_TEMPLATE_SEARCH',			'搜索');
define('_TEMPLATE_SHIGHLIGHT',		'聚焦');
define('_TEMPLATE_SNOTFOUND',		'沒有找到任何東西');
define('_TEMPLATE_UPDATE',			'更新');
define('_TEMPLATE_UPDATE_BTN',		'更新模版');
define('_TEMPLATE_RESET_BTN',		'重置日期');
define('_TEMPLATE_CATEGORYLIST',	'類別列表');
define('_TEMPLATE_CATHEADER',		'類別列表頭');
define('_TEMPLATE_CATITEM',			'類別列表項目');
define('_TEMPLATE_CATFOOTER',		'類別列表尾');

// skins
define('_SKIN_EDIT_TITLE',			'編輯面板');
define('_SKIN_AVAILABLE_TITLE',		'有效的面板');
define('_SKIN_NEW_TITLE',			'新面板');
define('_SKIN_NAME',				'名字');
define('_SKIN_DESC',				'描述');
define('_SKIN_TYPE',				'內容類型');
define('_SKIN_CREATE',				'創建');
define('_SKIN_CREATE_BTN',			'創建面板');
define('_SKIN_EDITONE_TITLE',		'編輯面板');
define('_SKIN_BACK',				'返回面板總覽');
define('_SKIN_PARTS_TITLE',			'面板部分');
define('_SKIN_PARTS_MSG',			'並不是所有的否是必需的,不需要的可以留空.選擇下面需要編輯的面板類型');
define('_SKIN_PART_MAIN',			'主索引文件');
define('_SKIN_PART_ITEM',			'文章頁');
define('_SKIN_PART_ALIST',			'檔案列表');
define('_SKIN_PART_ARCHIVE',		'檔案');
define('_SKIN_PART_SEARCH',			'搜索');
define('_SKIN_PART_ERROR',			'錯誤');
define('_SKIN_PART_MEMBER',			'會員詳細資料');
define('_SKIN_PART_POPUP',			'圖像彈出窗口');
define('_SKIN_GENSETTINGS_TITLE',	'普通設置');
define('_SKIN_CHANGE',				'改變');
define('_SKIN_CHANGE_BTN',			'改變這些設置');
define('_SKIN_UPDATE_BTN',			'更新面板');
define('_SKIN_RESET_BTN',			'恢復數據');
define('_SKIN_EDITPART_TITLE',		'編輯面板');
define('_SKIN_GOBACK',				'返回');
define('_SKIN_ALLOWEDVARS',			'允許的表達式（點擊相應的項目察看詳細信息）：');

// global settings
define('_SETTINGS_TITLE',			'普通設置');
define('_SETTINGS_SUB_GENERAL',		'普通設置');
define('_SETTINGS_DEFBLOG',			'默認日誌');
define('_SETTINGS_ADMINMAIL',		'超級管理員郵件');
define('_SETTINGS_SITENAME',		'網站名稱');
define('_SETTINGS_SITEURL',			'網站的URL（以斜線"/"結束）');
define('_SETTINGS_ADMINURL',		'管理員區域的URL（以斜線"/"結束）');
define('_SETTINGS_DIRS',			'系統目錄');
define('_SETTINGS_MEDIADIR',		'媒體目錄');
define('_SETTINGS_SEECONFIGPHP',	'（察看 config.php）');
define('_SETTINGS_MEDIAURL',		'Media URL （以斜線"/"結束）');
define('_SETTINGS_ALLOWUPLOAD',		'允許文件上傳？');
define('_SETTINGS_ALLOWUPLOADTYPES','允許上傳文件的類型');
define('_SETTINGS_CHANGELOGIN',		'允許會員更改登錄密碼');
define('_SETTINGS_COOKIES_TITLE',	'Cookie 設置');
define('_SETTINGS_COOKIELIFE',		'Cookie 保存時間');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'保存一個月');
define('_SETTINGS_COOKIEPATH',		'Cookie 路徑 (高級)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie 域（高級）');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie（高級）');
define('_SETTINGS_LASTVISIT',		'保存上次訪問的Cookie');
define('_SETTINGS_ALLOWCREATE',		'允許訪客建立會員賬號');
define('_SETTINGS_NEWLOGIN',		'允許訪客建立的賬號登錄');
define('_SETTINGS_NEWLOGIN2',		'（只在新註冊的賬號上生效）');
define('_SETTINGS_MEMBERMSGS',		'允許會員到會員的服務');
define('_SETTINGS_LANGUAGE',		'默認語言');
define('_SETTINGS_DISABLESITE',		'關閉站點');
define('_SETTINGS_DBLOGIN',			'MySQL 登錄 &amp; 數據庫');
define('_SETTINGS_UPDATE',			'更新設置');
define('_SETTINGS_UPDATE_BTN',		'更新設置');
define('_SETTINGS_DISABLEJS',		'禁止 JavaScript 工具條');
define('_SETTINGS_MEDIA',			'媒體/上傳 設置');
define('_SETTINGS_MEDIAPREFIX',		'前綴上傳文件帶有日期');
define('_SETTINGS_MEMBERS',			'會員設置');

// bans
define('_BAN_TITLE',				'禁止列表');
define('_BAN_NONE',					'改日誌沒有任何封鎖');
define('_BAN_NEW_TITLE',			'添加新的封鎖');
define('_BAN_NEW_TEXT',				'現在添加一條新的封鎖');
define('_BAN_REMOVE_TITLE',			'刪除規定');
define('_BAN_IPRANGE',				'IP封鎖');
define('_BAN_BLOGS',				'哪個日誌？');
define('_BAN_DELETE_TITLE',			'刪除封鎖');
define('_BAN_ALLBLOGS',				'你擁有管理員權利的所有日誌。');
define('_BAN_REMOVED_TITLE',		'封鎖移除');
define('_BAN_REMOVED_TEXT',			'從以下日誌移除封鎖：');
define('_BAN_ADD_TITLE',			'添加封鎖');
define('_BAN_IPRANGE_TEXT',			'選擇你要封鎖的IP。');
define('_BAN_BLOGS_TEXT',			'你可以選擇僅僅禁止本日誌或者禁止所有你擁有管理員權利的日誌，在下面選擇。');
define('_BAN_REASON_TITLE',			'原因');
define('_BAN_REASON_TEXT',			'你可以為封鎖提供一個原因，當被禁止的IP所有者試圖添加另一條評論或者是投票時顯示，最多128字。');
define('_BAN_ADD_BTN',				'添加封鎖');

// LOGIN screen
define('_LOGIN_MESSAGE',			'消息');
define('_LOGIN_NAME',				'名字');
define('_LOGIN_PASSWORD',			'密碼');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'忘記密碼？');

// membermanagement
define('_MEMBERS_TITLE',			'會員管理');
define('_MEMBERS_CURRENT',			'當前會員');
define('_MEMBERS_NEW',				'新會員');
define('_MEMBERS_DISPLAY',			'賬號');
define('_MEMBERS_DISPLAY_INFO',		'（即登錄名）');
define('_MEMBERS_REALNAME',			'真實名字');
define('_MEMBERS_PWD',				'密碼');
define('_MEMBERS_REPPWD',			'重複密碼');
define('_MEMBERS_EMAIL',			'Email地址');
define('_MEMBERS_EMAIL_EDIT',		'（當你改變郵件地址的時候，將會向該地址發關一封郵件）');
define('_MEMBERS_URL',				'網站地址(URL)');
define('_MEMBERS_SUPERADMIN',		'超級管理員權限');
define('_MEMBERS_CANLOGIN',			'可以登錄到管理員界面');
define('_MEMBERS_NOTES',			'注意');
define('_MEMBERS_NEW_BTN',			'添加會員');
define('_MEMBERS_EDIT',				'編輯會員');
define('_MEMBERS_EDIT_BTN',			'改變設置');
define('_MEMBERS_BACKTOOVERVIEW',	'返回會員總攬');
define('_MEMBERS_DEFLANG',			'語言');
define('_MEMBERS_USESITELANG',		'- 使用站點設置 -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'訪問站點');
define('_BLOGLIST_ADD',				'添加文章');
define('_BLOGLIST_TT_ADD',			'在這個日誌中添加新文章');
define('_BLOGLIST_EDIT',			'編輯/刪除 文章');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'書籤');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'設置');
define('_BLOGLIST_TT_SETTINGS',		'編輯設置或者管理團隊');
define('_BLOGLIST_BANS',			'規定');
define('_BLOGLIST_TT_BANS',			'察看,添加或者移除被禁止的IP');
define('_BLOGLIST_DELETE',			'全部刪除');
define('_BLOGLIST_TT_DELETE',		'刪除該日誌');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'你的日誌');
define('_OVERVIEW_YRDRAFTS',		'你的草稿');
define('_OVERVIEW_YRSETTINGS',		'你的設置');
define('_OVERVIEW_GSETTINGS',		'普通設置');
define('_OVERVIEW_NOBLOGS',			'你不屬於任何團隊的列表');
define('_OVERVIEW_NODRAFTS',		'沒有草稿');
define('_OVERVIEW_EDITSETTINGS',	'編輯設置…');
define('_OVERVIEW_BROWSEITEMS',		'瀏覽項目…');
define('_OVERVIEW_BROWSECOMM',		'瀏覽評論…');
define('_OVERVIEW_VIEWLOG',			'動作紀錄…');
define('_OVERVIEW_MEMBERS',			'會員管理…');
define('_OVERVIEW_NEWLOG',			'建立新的日誌…');
define('_OVERVIEW_SETTINGS',		'編輯設置…');
define('_OVERVIEW_TEMPLATES',		'編輯模版…');
define('_OVERVIEW_SKINS',			'編輯面板…');
define('_OVERVIEW_BACKUP',			'備份/恢復…');

// ITEMLIST
define('_ITEMLIST_BLOG',			'這個日誌的文章'); 
define('_ITEMLIST_YOUR',			'你的文章');

// Comments
define('_COMMENTS',					'評論');
define('_NOCOMMENTS',				'這篇文章沒有評論');
define('_COMMENTS_YOUR',			'你的評論');
define('_NOCOMMENTS_YOUR',			'你沒有寫任何評論');

// LISTS (general)
define('_LISTS_NOMORE',				'沒有更多結果或者沒有結果');
define('_LISTS_PREV',				'上一篇');
define('_LISTS_NEXT',				'下一篇');
define('_LISTS_SEARCH',				'搜索');
define('_LISTS_CHANGE',				'改變');
define('_LISTS_PERPAGE',			'文章/頁');
define('_LISTS_ACTIONS',			'動作');
define('_LISTS_DELETE',				'刪除');
define('_LISTS_EDIT',				'編輯');
define('_LISTS_MOVE',				'移動');
define('_LISTS_CLONE',				'克隆');
define('_LISTS_TITLE',				'標題');
define('_LISTS_BLOG',				'日誌');
define('_LISTS_NAME',				'名字');
define('_LISTS_DESC',				'描述');
define('_LISTS_TIME',				'時間');
define('_LISTS_COMMENTS',			'評論');
define('_LISTS_TYPE',				'類型');


// member list 
define('_LIST_MEMBER_NAME',			'用戶賬號');
define('_LIST_MEMBER_RNAME',		'真實名字');
define('_LIST_MEMBER_ADMIN',		'超級管理員？');
define('_LIST_MEMBER_LOGIN',		'能夠登錄？');
define('_LIST_MEMBER_URL',			'網站');

// banlist
define('_LIST_BAN_IPRANGE',			'IP範圍');
define('_LIST_BAN_REASON',			'原因');

// actionlist
define('_LIST_ACTION_MSG',			'消息');

// commentlist
define('_LIST_COMMENT_BANIP',		'禁止IP');
define('_LIST_COMMENT_WHO',			'作者');
define('_LIST_COMMENT',				'評論');
define('_LIST_COMMENT_HOST',		'主人');

// itemlist
define('_LIST_ITEM_INFO',			'信息');
define('_LIST_ITEM_CONTENT',		'標題和文本');


// teamlist
define('_LIST_TEAM_ADMIN',			'超級用戶 ');
define('_LIST_TEAM_CHADMIN',		'更改超級用戶');

// edit comments
define('_EDITC_TITLE',				'編輯評論');
define('_EDITC_WHO',				'作者');
define('_EDITC_HOST',				'從哪裡？');
define('_EDITC_WHEN',				'什麼時候？');
define('_EDITC_TEXT',				'文本');
define('_EDITC_EDIT',				'編輯評論');
define('_EDITC_MEMBER',				'會員');
define('_EDITC_NONMEMBER',			'非會員');

// move item
define('_MOVE_TITLE',				'移動到哪個日誌？');
define('_MOVE_BTN',					'移動文章');

?>