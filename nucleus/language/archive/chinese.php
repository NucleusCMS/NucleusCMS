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
define('_MEDIA_VIEW_TT',			'查看文件（在新窗口中打开）');
define('_MEDIA_FILTER_APPLY',		'应用过滤器');
define('_MEDIA_FILTER_LABEL',		'过滤器：');
define('_MEDIA_UPLOAD_TO',			'上载到…');
define('_MEDIA_UPLOAD_NEW',			'上载新文件…');
define('_MEDIA_COLLECTION_SELECT',	'选取');
define('_MEDIA_COLLECTION_TT',		'切换到这个目录');
define('_MEDIA_COLLECTION_LABEL',	'当前收藏：');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'左对齐');
define('_ADD_ALIGNRIGHT_TT',		'右对齐');
define('_ADD_ALIGNCENTER_TT',		'居中');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'搜索时包括');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'上载失败');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'允许发表到过去');
define('_ADD_CHANGEDATE',			'更新时间标记');
define('_BMLET_CHANGEDATE',			'更新时间标记');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'皮肤导入/导出…');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'普通');
define('_PARSER_INCMODE_SKINDIR',	'使用皮肤目录');
define('_SKIN_INCLUDE_MODE',		'包括方式');
define('_SKIN_INCLUDE_PREFIX',		'包括前缀');

// global settings
define('_SETTINGS_BASESKIN',		'基本皮肤');
define('_SETTINGS_SKINSURL',		'皮肤URL');
define('_SETTINGS_ACTIONSURL',		'action.php的完整URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'不能移动默认类别');
define('_ERROR_MOVETOSELF',			'无法移动类别（描述日志与源日志相同）');
define('_MOVECAT_TITLE',			'将类别移动到');
define('_MOVECAT_BTN',				'移动类别');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL模式');
define('_SETTINGS_URLMODE_NORMAL',	'普通');
define('_SETTINGS_URLMODE_PATHINFO','优雅');

// Batch operations
define('_BATCH_NOSELECTION',		'没有选择动作执行的对象');
define('_BATCH_ITEMS',				'文章批处理');
define('_BATCH_CATEGORIES',			'类别批处里');
define('_BATCH_MEMBERS',			'会员批处理');
define('_BATCH_TEAM',				'团队会员批处理');
define('_BATCH_COMMENTS',			'评论批处理');
define('_BATCH_UNKNOWN',			'未知批处理：');
define('_BATCH_EXECUTING',			'执行');
define('_BATCH_ONCATEGORY',			'在类别');
define('_BATCH_ONITEM',				'在文章');
define('_BATCH_ONCOMMENT',			'在评论');
define('_BATCH_ONMEMBER',			'在会员');
define('_BATCH_ONTEAM',				'在团队会员');
define('_BATCH_SUCCESS',			'成功！');
define('_BATCH_DONE',				'完成！');
define('_BATCH_DELETE_CONFIRM',		'确认批删除');
define('_BATCH_DELETE_CONFIRM_BTN',	'确认批删除');
define('_BATCH_SELECTALL',			'全选');
define('_BATCH_DESELECTALL',		'取消全选');

// batch operations：options in dropdowns
define('_BATCH_ITEM_DELETE',		'删除');
define('_BATCH_ITEM_MOVE',			'移动');
define('_BATCH_MEMBER_DELETE',		'删除');
define('_BATCH_MEMBER_SET_ADM',		'授予超级用户权限');
define('_BATCH_MEMBER_UNSET_ADM',	'剥夺超级用户权限');
define('_BATCH_TEAM_DELETE',		'从团队删除');
define('_BATCH_TEAM_SET_ADM',		'授予超级用户权限');
define('_BATCH_TEAM_UNSET_ADM',		'剥夺超级用户权限');
define('_BATCH_CAT_DELETE',			'删除');
define('_BATCH_CAT_MOVE',			'移动到其他日志');
define('_BATCH_COMMENT_DELETE',		'删除');

// itemlist：Add new item…
define('_ITEMLIST_ADDNEW',			'添加新文章…');
define('_ADD_PLUGIN_EXTRAS',		'扩展插件选项');

// errors
define('_ERROR_CATCREATEFAIL',		'无法建立新类别');
define('_ERROR_NUCLEUSVERSIONREQ',	'该插件需要更新版本的Nucleus：');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'返回日志设置');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'导入');
define('_SKINIE_TITLE_EXPORT',		'导出');
define('_SKINIE_BTN_IMPORT',		'导入');
define('_SKINIE_BTN_EXPORT',		'导出,选择皮肤/模版');
define('_SKINIE_LOCAL',				'从本地文件导入：');
define('_SKINIE_NOCANDIDATES',		'在皮肤路径中没有找到任何候选文件');
define('_SKINIE_FROMURL',			'从URL导入：');
define('_SKINIE_EXPORT_INTRO',		'从下面选择您想要导出的皮肤或模版');
define('_SKINIE_EXPORT_SKINS',		'皮肤');
define('_SKINIE_EXPORT_TEMPLATES',	'模版');
define('_SKINIE_EXPORT_EXTRA',		'更多信息');
define('_SKINIE_CONFIRM_OVERWRITE',	'覆盖已经存在的皮肤文件（察看名称冲突）');
define('_SKINIE_CONFIRM_IMPORT',	'是的，我想导入该文件');
define('_SKINIE_CONFIRM_TITLE',		'取消导入皮肤与模版');
define('_SKINIE_INFO_SKINS',		'文件中的皮肤：');
define('_SKINIE_INFO_TEMPLATES',	'文件中的模版：');
define('_SKINIE_INFO_GENERAL',		'信息：');
define('_SKINIE_INFO_SKINCLASH',	'皮肤名字冲突：');
define('_SKINIE_INFO_TEMPLCLASH',	'模版名字冲突：');
define('_SKINIE_INFO_IMPORTEDSKINS','已导入的皮肤：');
define('_SKINIE_INFO_IMPORTEDTEMPLS','已导入的模版：');
define('_SKINIE_DONE',				'完成导入');

define('_AND',						'和');
define('_OR',						'或');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'空(点击编辑)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'包括方式：');
define('_LIST_SKINS_INCPREFIX',		'包括前缀：');
define('_LIST_SKINS_DEFINED',		'确定部分：');

// backup
define('_BACKUPS_TITLE',			'备份 / 恢复');
define('_BACKUP_TITLE',				'备份');
define('_BACKUP_INTRO',				'点击下面的按钮建立一份新闻系统的备份数据库.按照提示保存一个备份文件，将它保存在安全的地方。');
define('_BACKUP_ZIP_YES',			'尝试使用压缩');
define('_BACKUP_ZIP_NO',			'不使用压缩');
define('_BACKUP_BTN',				'建立备份');
define('_BACKUP_NOTE',				'<b>注意：</b> 只有数据库的内容在备份中保存，不包括<b>config.php</b>.');
define('_RESTORE_TITLE',			'恢复');
define('_RESTORE_NOTE',				'<b>注意：</b> 恢复一个数据库 <b>清除</b> 当前系统数据库中的所有数据！当你真的确定之后才可以执行此操作!	<br />	<b>注意：</b>确定生成备份文件的的文章系统的版本与你现在所使用的版本相同！否则可能无法正常工作');
define('_RESTORE_INTRO',			'选择下面的备份文件(它将会被调入到服务器) 点击“恢复”按钮开始.');
define('_RESTORE_IMSURE',			'是的，我确定执行此操作！');
define('_RESTORE_BTN',				'从文件中恢复');
define('_RESTORE_WARNING',			'(确定你正在恢复一个正确的备份，在你开始之前你可以建立一个当前备份)');
define('_ERROR_BACKUP_NOTSURE',		'你需要检查一下我确定');
define('_RESTORE_COMPLETE',			'恢复完成');

// new item notification
define('_NOTIFY_NI_MSG',			'您的新文章已经发表：');
define('_NOTIFY_NI_TITLE',			'新文章！');
define('_NOTIFY_KV_MSG',			'文章投票：');
define('_NOTIFY_KV_TITLE',			'投票系统：');
define('_NOTIFY_NC_MSG',			'文章评论：');
define('_NOTIFY_NC_TITLE',			'系统评论：');
define('_NOTIFY_USERID',			'用户ID：');
define('_NOTIFY_USER',				'用户：');
define('_NOTIFY_COMMENT',			'评论：');
define('_NOTIFY_VOTE',				'投票：');
define('_NOTIFY_HOST',				'主持人：');
define('_NOTIFY_IP',				'IP：');
define('_NOTIFY_MEMBER',			'会员：');
define('_NOTIFY_TITLE',				'标题：');
define('_NOTIFY_CONTENTS',			'内容：');

// member mail message
define('_MMAIL_MSG',				'送给你的一条消息，由');
define('_MMAIL_FROMANON',			'匿名访问');
define('_MMAIL_FROMNUC',			'由Nucleus系统发送');
define('_MMAIL_TITLE',				'一条消息来自');
define('_MMAIL_MAIL',				'消息：');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'添加文章');
define('_BMLET_EDIT',				'编辑文章');
define('_BMLET_DELETE',				'删除文章');
define('_BMLET_BODY',				'摘要/简讯');
define('_BMLET_MORE',				'更多/扩展');
define('_BMLET_OPTIONS',			'选项');
define('_BMLET_PREVIEW',			'预览');

// used in bookmarklet
define('_ITEM_UPDATED',				'文章已更新');
define('_ITEM_DELETED',				'文章已被删除');

// plugins
define('_CONFIRMTXT_PLUGIN',		'确定将要删除已经命名的插件吗？');
define('_ERROR_NOSUCHPLUGIN',		'没有这样的插件');
define('_ERROR_DUPPLUGIN',			'对不起，这个插件已经安装');
define('_ERROR_PLUGFILEERROR',		'不存在该插件或者权限未正确设定');
define('_PLUGS_NOCANDIDATES',		'没有找到候选插件');

define('_PLUGS_TITLE_MANAGE',		'插件管理');
define('_PLUGS_TITLE_INSTALLED',	'当前已经安装');
define('_PLUGS_TITLE_UPDATE',		'更新预定列表');
define('_PLUGS_TEXT_UPDATE',		'Nucleus为插件保存了事件描述的缓存。当你升级替换插件后，应该运行升级程序以保证事件描述得到更新');
define('_PLUGS_TITLE_NEW',			'安装新插件');
define('_PLUGS_ADD_TEXT',			'下面是你插件目录中所有文件的列表，那可能是未安装的的插件。在安装之前请<strong>确认</strong>那是一个有效的插件文件。');
define('_PLUGS_BTN_INSTALL',		'安装插件');
define('_BACKTOOVERVIEW',			'返回总览');

// editlink
define('_TEMPLATE_EDITLINK',		'编辑文章链接');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'添加左边盒子');
define('_ADD_RIGHT_TT',				'添加右边盒子');

// add/edit item：new category (in dropdown box)
define('_ADD_NEWCAT',				'新类别…');

// new settings
define('_SETTINGS_PLUGINURL',		'插件URL');
define('_SETTINGS_MAXUPLOADSIZE',	'上传文件最大容量（bytes）');
define('_SETTINGS_NONMEMBERMSGS',	'允许非会员发送消息');
define('_SETTINGS_PROTECTMEMNAMES',	'保护会员名字');

// overview screen
define('_OVERVIEW_PLUGINS',			'管理插件…');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'新会员注册：');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'你的邮件地址：');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'你没有将文件上传到媒体目录的权力');

// plugin list
define('_LISTS_INFO',				'信息');
define('_LIST_PLUGS_AUTHOR',		'由：');
define('_LIST_PLUGS_VER',			'版本：');
define('_LIST_PLUGS_SITE',			'访问网站');
define('_LIST_PLUGS_DESC',			'描述：');
define('_LIST_PLUGS_SUBS',			'下列事件的预定：');
define('_LIST_PLUGS_UP',			'上移');
define('_LIST_PLUGS_DOWN',			'下移');
define('_LIST_PLUGS_UNINSTALL',		'卸载');
define('_LIST_PLUGS_ADMIN',			'管理');
define('_LIST_PLUGS_OPTIONS',		'编辑');

// plugin option list
define('_LISTS_VALUE',				'值');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'这个插件没有任何选项设置');
define('_PLUGS_BACK',				'返回插件总览');
define('_PLUGS_SAVE',				'保存选项');
define('_PLUGS_OPTIONS_UPDATED',	'插件选项已经更新');

define('_OVERVIEW_MANAGEMENT',		'管理');
define('_OVERVIEW_MANAGE',			'系统管理…');
define('_MANAGE_GENERAL',			'普通管理');
define('_MANAGE_SKINS',				'皮肤与模版');
define('_MANAGE_EXTRA',				'扩展功能');

define('_BACKTOMANAGE',				'返回系统管理');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'gb2312');

// global stuff
define('_LOGOUT',					'注销');
define('_LOGIN',					'登录');
define('_YES',						'是');
define('_NO',						'否');
define('_SUBMIT',					'提交');
define('_ERROR',					'错误');
define('_ERRORMSG',					'出现一个错误！');
define('_BACK',						'返回');
define('_NOTLOGGEDIN',				'未登录');
define('_LOGGEDINAS',				'已登录：');
define('_ADMINHOME',				'管理中心');
define('_NAME',						'名字');
define('_BACKHOME',					'返回管理中心');
define('_BADACTION',				'没有存在的动作请求');
define('_MESSAGE',					'消息');
define('_HELP_TT',					'帮助');
define('_YOURSITE',					'本网站');


define('_POPUP_CLOSE',				'关闭窗口');

define('_LOGIN_PLEASE',				'请先登录');

// commentform
define('_COMMENTFORM_YOUARE',		'你是');
define('_COMMENTFORM_SUBMIT',		'添加评论');
define('_COMMENTFORM_COMMENT',		'你的评论');
define('_COMMENTFORM_NAME',			'名字');
define('_COMMENTFORM_MAIL',			'邮件/网站');
define('_COMMENTFORM_REMEMBER',		'提醒我');

// loginform
define('_LOGINFORM_NAME',			'用户名');
define('_LOGINFORM_PWD',			'密码');
define('_LOGINFORM_YOUARE',			'已登录：');
define('_LOGINFORM_SHARED',			'公共场所电脑');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'发送消息');

// search form
define('_SEARCHFORM_SUBMIT',		'搜索');

// add item form
define('_ADD_ADDTO',				'添加新文章到');
define('_ADD_CREATENEW',			'建立新文章');
define('_ADD_BODY',					'概况');
define('_ADD_TITLE',				'标题');
define('_ADD_MORE',					'扩展(可选)');
define('_ADD_CATEGORY',				'类别');
define('_ADD_PREVIEW',				'预览');
define('_ADD_DISABLE_COMMENTS',		'关闭评论？');
define('_ADD_DRAFTNFUTURE',			'草稿 &amp; 未来项目');
define('_ADD_ADDITEM',				'添加文章');
define('_ADD_ADDNOW',				'现在添加');
define('_ADD_ADDLATER',				'以后添加');
define('_ADD_PLACE_ON',				'积攒');
define('_ADD_ADDDRAFT',				'添加到草稿');
define('_ADD_NOPASTDATES',			'（过去的日期和时间是无效的，系统将使用当前时间）');
define('_ADD_BOLD_TT',				'粗体');
define('_ADD_ITALIC_TT',			'斜体');
define('_ADD_HREF_TT',				'建立超级链接');
define('_ADD_MEDIA_TT',				'添加媒体文件');
define('_ADD_PREVIEW_TT',			'显示/隐藏 预览');
define('_ADD_CUT_TT',				'切除');
define('_ADD_COPY_TT',				'复制');
define('_ADD_PASTE_TT',				'粘贴');


// edit item form
define('_EDIT_ITEM',				'编辑文章');
define('_EDIT_SUBMIT',				'编辑文章');
define('_EDIT_ORIG_AUTHOR',			'原创作者');
define('_EDIT_BACKTODRAFTS',		'添加回草稿');
define('_EDIT_COMMENTSNOTE',		'（注意：关闭评论并不能删除现有评论）');

// used on delete screens
define('_DELETE_CONFIRM',			'请确认删除动作');
define('_DELETE_CONFIRM_BTN',		'确认删除');
define('_CONFIRMTXT_ITEM',			'你将删除以下文章：');
define('_CONFIRMTXT_COMMENT',		'你将删除以下评论：');
define('_CONFIRMTXT_TEAM1',			'即将删除');
define('_CONFIRMTXT_TEAM2',			'从日志团队列表中');
define('_CONFIRMTXT_BLOG',			'你将要删除的日志为：');
define('_WARNINGTXT_BLOGDEL',		'警告！删除日志将会删除其上的的所有文章和评论。请确定是否真的要删除日志<br />同时，在移动日志时不要终止系统。');
define('_CONFIRMTXT_MEMBER',		'你将会删除下面会员档案：');
define('_CONFIRMTXT_TEMPLATE',		'你将删除已命名的模版');
define('_CONFIRMTXT_SKIN',			'你将删除已命名的皮肤 ');
define('_CONFIRMTXT_BAN',			'你将删除对这些IP的封锁');
define('_CONFIRMTXT_CATEGORY',		'你将删除类别');

// some status messages
define('_DELETED_ITEM',				'文章已删除');
define('_DELETED_MEMBER',			'会员已删除');
define('_DELETED_COMMENT',			'评论已删除');
define('_DELETED_BLOG',				'日志已删除');
define('_DELETED_CATEGORY',			'类别已删除');
define('_ITEM_MOVED',				'文章已移动');
define('_ITEM_ADDED',				'文章已添加');
define('_COMMENT_UPDATED',			'评论已更新');
define('_SKIN_UPDATED',				'皮肤日期已经保存');
define('_TEMPLATE_UPDATED',			'模版日期已经保存');

// errors
define('_ERROR_COMMENT_LONGWORD',	'请不要使用长度超过90个字符的单词');
define('_ERROR_COMMENT_NOCOMMENT',	'请输入一条评论');
define('_ERROR_COMMENT_NOUSERNAME',	'错误的用户名');
define('_ERROR_COMMENT_TOOLONG',	'你的评论太长(最长：2500字)');
define('_ERROR_COMMENTS_DISABLED',	'这个日志的评论已经被禁止.');
define('_ERROR_COMMENTS_NONPUBLIC',	'你必须以会员身份登录才可以添加评论');
define('_ERROR_COMMENTS_MEMBERNICK','你想使用的这个名字已经被其他人使用，请另选一个。');
define('_ERROR_SKIN',				'皮肤错误');
define('_ERROR_ITEMCLOSED',			'这篇文章已经关闭，不能添加评论和投票');
define('_ERROR_NOSUCHITEM',			'没有这篇文章');
define('_ERROR_NOSUCHBLOG',			'没有这个日志');
define('_ERROR_NOSUCHSKIN',			'没有这个皮肤');
define('_ERROR_NOSUCHMEMBER',		'没有这个会员');
define('_ERROR_NOTONTEAM',			'你不在该日志的团队列表上。');
define('_ERROR_BADDESTBLOG',		'预定版不存在');
define('_ERROR_NOTONDESTTEAM',		'不能移动文章,你不在这个版的团队列表上');
define('_ERROR_NOEMPTYITEMS',		'不能添加空文章！');
define('_ERROR_BADMAILADDRESS',		'Email地址无效');
define('_ERROR_BADNOTIFY',			'一个或多个邮件地址是无效的');
define('_ERROR_BADNAME',			'名字无效');
define('_ERROR_NICKNAMEINUSE',		'已经有一个会员使用那个昵称');
define('_ERROR_PASSWORDMISMATCH',	'密码必须匹配');
define('_ERROR_PASSWORDTOOSHORT',	'密码最少6个字符');
define('_ERROR_PASSWORDMISSING',	'密码不能为空');
define('_ERROR_REALNAMEMISSING',	'你必须输入一个真实的名字');
define('_ERROR_ATLEASTONEADMIN',	'系统至少应该存在一个可以登录到管理界面的超级用户。');
define('_ERROR_ATLEASTONEBLOGADMIN','请确定总是至少有一个超级用户。');
define('_ERROR_ALREADYONTEAM',		'团队中已经存在这个会员');
define('_ERROR_BADSHORTBLOGNAME',	'日志缩写只允许包含a-z,0-9');
define('_ERROR_DUPSHORTBLOGNAME',	'其他日志已经使用这个缩写名称');
define('_ERROR_UPDATEFILE',			'对升级文件没有写入权限，请确定文件权限设置正确（chmod 666）。同时注意路径是基于管理目录的相对路径，所以你可能需要使用绝对路径（如/your/path/to/nucleus/）。');
define('_ERROR_DELDEFBLOG',			'不能删除默认日志');
define('_ERROR_DELETEMEMBER',		'该会员无法删除，他可能是文章或评论的作者');
define('_ERROR_BADTEMPLATENAME',	'无效的模版名（只允许a-z, 0-9）');
define('_ERROR_DUPTEMPLATENAME',	'已存在这样一个名字的模版');
define('_ERROR_BADSKINNAME',		'无效皮肤名（只允许a-z, 0-9）');
define('_ERROR_DUPSKINNAME',		'已存在同名皮肤');
define('_ERROR_DEFAULTSKIN',		'系统必须有一个名为"default"的默认皮肤');
define('_ERROR_SKINDEFDELETE',		'这是默认皮肤，不能删除：');
define('_ERROR_DISALLOWED',			'对不起，你没有权力执行该动作');
define('_ERROR_DELETEBAN',			'删除封锁的时候发生错误（封锁不存在）。');
define('_ERROR_ADDBAN',				'添加封锁的时候发生错误，它可能没有正确添加到你的所有日志里。');
define('_ERROR_BADACTION',			'需要的动作不存在');
define('_ERROR_MEMBERMAILDISABLED',	'会员到会员的邮件消息被禁止');
define('_ERROR_MEMBERCREATEDISABLED','建立会员账号被禁止');
define('_ERROR_INCORRECTEMAIL',		'不正确的邮件地址');
define('_ERROR_VOTEDBEFORE',		'你已经为这个文章投过票了');
define('_ERROR_BANNED1',			'动作无法执行（IP范围');
define('_ERROR_BANNED2',			'）被封锁。消息为：\'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'执行这个动作必须登录');
define('_ERROR_CONNECT',			'连接错误');
define('_ERROR_FILE_TOO_BIG',		'文件太大！');
define('_ERROR_BADFILETYPE',		'对不起，不允许上传这种格式的文件');
define('_ERROR_BADREQUEST',			'无效的上传请求');
define('_ERROR_DISALLOWEDUPLOAD',	'你不在任何日志的团队列表中，没有上传文件的权力');
define('_ERROR_BADPERMISSIONS',		'文件/目录权限设置不正确');
define('_ERROR_UPLOADMOVEP',		'上传文件时发生错误');
define('_ERROR_UPLOADCOPY',			'拷贝文件时发生错误');
define('_ERROR_UPLOADDUPLICATE',	'已经有一个同名文件，上传之前请先改名。');
define('_ERROR_LOGINDISALLOWED',	'对不起，你不能登录管理区。但可以用其他用户身份登录');
define('_ERROR_DBCONNECT',			'无法连接到 MySQL 服务器');
define('_ERROR_DBSELECT',			'无法选择文章系统的数据库');
define('_ERROR_NOSUCHLANGUAGE',		'没有这个语言文件');
define('_ERROR_NOSUCHCATEGORY',		'没有这个类别');
define('_ERROR_DELETELASTCATEGORY',	'至少一个类别');
define('_ERROR_DELETEDEFCATEGORY',	'不能删除默认类别');
define('_ERROR_BADCATEGORYNAME',	'无效类别名');
define('_ERROR_DUPCATEGORYNAME',	'已经存在同名类别');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'警告：当前值非目录！');
define('_WARNING_NOTREADABLE',		'警告：当前值为不可读取的目录！');
define('_WARNING_NOTWRITABLE',		'警告：当前值为不可读取的目录！');

// media and upload
define('_MEDIA_UPLOADLINK',			'上传一个新文件');
define('_MEDIA_MODIFIED',			'修改');
define('_MEDIA_FILENAME',			'文件名');
define('_MEDIA_DIMENSIONS',			'尺寸');
define('_MEDIA_INLINE',				'本窗口');
define('_MEDIA_POPUP',				'新窗口');
define('_UPLOAD_TITLE',				'选择文件');
define('_UPLOAD_MSG',				'选择你想上传的文件，然后点击 \'Upload\' 按钮。');
define('_UPLOAD_BUTTON',			'上传');

// some status messages
define('_MSG_ACCOUNTCREATED',		'账号已建立，密码将会通过邮件通知你');
define('_MSG_PASSWORDSENT',			'密码已通过邮件发出。');
define('_MSG_LOGINAGAIN',			'你需要重新登录，因为你的信息已经改变。');
define('_MSG_SETTINGSCHANGED',		'设置改变');
define('_MSG_ADMINCHANGED',			'管理员改变');
define('_MSG_NEWBLOG',				'新的日志已建立');
define('_MSG_ACTIONLOGCLEARED',		'动作记录清空');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'不允许的动作：');
define('_ACTIONLOG_PWDREMINDERSENT','新密码送出为');
define('_ACTIONLOG_TITLE',			'动作记录');
define('_ACTIONLOG_CLEAR_TITLE',	'清除动作记录');
define('_ACTIONLOG_CLEAR_TEXT',		'现在就清除动作记录');

// team management
define('_TEAM_TITLE',				'为日志管理团队 ');
define('_TEAM_CURRENT',				'当前团队');
define('_TEAM_ADDNEW',				'向团队中添加新会员');
define('_TEAM_CHOOSEMEMBER',		'选择会员');
define('_TEAM_ADMIN',				'超级管理员权限？ ');
define('_TEAM_ADD',					'添加到团队');
define('_TEAM_ADD_BTN',				'添加到团队');

// blogsettings
define('_EBLOG_TITLE',				'编辑日志设置');
define('_EBLOG_TEAM_TITLE',			'编辑团队');
define('_EBLOG_TEAM_TEXT',			'点击这里编辑你的团队…');
define('_EBLOG_SETTINGS_TITLE',		'日志设置');
define('_EBLOG_NAME',				'日志名');
define('_EBLOG_SHORTNAME',			'日志名缩写');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(只允许包含 a-z )');
define('_EBLOG_DESC',				'日志描述');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'默认皮肤');
define('_EBLOG_DEFCAT',				'默认类别');
define('_EBLOG_LINEBREAKS',			'转换行中断');
define('_EBLOG_DISABLECOMMENTS',	'开启评论');
define('_EBLOG_ANONYMOUS',			'允许非会员评论');
define('_EBLOG_NOTIFY',				'通知地址（多个地址用 ; 分隔）');
define('_EBLOG_NOTIFY_ON',			'以下事件通知');
define('_EBLOG_NOTIFY_COMMENT',		'新评论');
define('_EBLOG_NOTIFY_KARMA',		'新的投票');
define('_EBLOG_NOTIFY_ITEM',		'新的日志');
define('_EBLOG_PING',				'更新时 Ping Weblogs.com？');
define('_EBLOG_MAXCOMMENTS',		'最多允许评论数量');
define('_EBLOG_UPDATE',				'更新文件');
define('_EBLOG_OFFSET',				'时差');
define('_EBLOG_STIME',				'当前服务器时间为');
define('_EBLOG_BTIME',				'当前日志时间为');
define('_EBLOG_CHANGE',				'改变设置');
define('_EBLOG_CHANGE_BTN',			'改变设置');
define('_EBLOG_ADMIN',				'日志管理员');
define('_EBLOG_ADMIN_MSG',			'将被授予管理员权力');
define('_EBLOG_CREATE_TITLE',		'创建新日志');
define('_EBLOG_CREATE_TEXT',		'填写下面的表单创建一个新日志. <br /><br /> <b>注意：</b> 列表中只有必要的选项，如果你想更改更多的选项，创建后再到相应的设置中去修改。');
define('_EBLOG_CREATE',				'创建！');
define('_EBLOG_CREATE_BTN',			'创建日志');
define('_EBLOG_CAT_TITLE',			'类别');
define('_EBLOG_CAT_NAME',			'类别名');
define('_EBLOG_CAT_DESC',			'类别描述');
define('_EBLOG_CAT_CREATE',			'创建新的类别');
define('_EBLOG_CAT_UPDATE',			'更新类别');
define('_EBLOG_CAT_UPDATE_BTN',		'更新类别');

// templates
define('_TEMPLATE_TITLE',			'编辑模版');
define('_TEMPLATE_AVAILABLE_TITLE',	'有效模版');
define('_TEMPLATE_NEW_TITLE',		'新模版');
define('_TEMPLATE_NAME',			'模版名');
define('_TEMPLATE_DESC',			'模版描述');
define('_TEMPLATE_CREATE',			'建立模版');
define('_TEMPLATE_CREATE_BTN',		'建立模版');
define('_TEMPLATE_EDIT_TITLE',		'编辑模版');
define('_TEMPLATE_BACK',			'返回模版总览');
define('_TEMPLATE_EDIT_MSG',		'并非所有的模版都是需要的,你不需要的那些可以留空.');
define('_TEMPLATE_SETTINGS',		'模版设置');
define('_TEMPLATE_ITEMS',			'文章');
define('_TEMPLATE_ITEMHEADER',		'文章头');
define('_TEMPLATE_ITEMBODY',		'文章体');
define('_TEMPLATE_ITEMFOOTER',		'文章尾');
define('_TEMPLATE_MORELINK',		'连接到扩展入口');
define('_TEMPLATE_NEW',				'新条目标志');
define('_TEMPLATE_COMMENTS_ANY',	'评论');
define('_TEMPLATE_CHEADER',			'评论头');
define('_TEMPLATE_CBODY',			'评论体');
define('_TEMPLATE_CFOOTER',			'评论尾');
define('_TEMPLATE_CONE',			'一条评论');
define('_TEMPLATE_CMANY',			'两条（或更多）评论');
define('_TEMPLATE_CMORE',			'阅读更多评论');
define('_TEMPLATE_CMEXTRA',			'会员扩展');
define('_TEMPLATE_COMMENTS_NONE',	'评论(如果没有)');
define('_TEMPLATE_CNONE',			'没有评论');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comments (太多，无法在线显示)');
define('_TEMPLATE_CTOOMUCH',		'评论太多');
define('_TEMPLATE_ARCHIVELIST',		'档案列表');
define('_TEMPLATE_AHEADER',			'档案列表头');
define('_TEMPLATE_AITEM',			'档案列表项目');
define('_TEMPLATE_AFOOTER',			'档案列表尾');
define('_TEMPLATE_DATETIME',		'日期和时间');
define('_TEMPLATE_DHEADER',			'日期头');
define('_TEMPLATE_DFOOTER',			'日期尾');
define('_TEMPLATE_DFORMAT',			'日期格式');
define('_TEMPLATE_TFORMAT',			'时间格式');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'图像新窗口');
define('_TEMPLATE_PCODE',			'新窗口');
define('_TEMPLATE_ICODE',			'嵌入图像代码');
define('_TEMPLATE_MCODE',			'媒体对象链接代码');
define('_TEMPLATE_SEARCH',			'搜索');
define('_TEMPLATE_SHIGHLIGHT',		'聚焦');
define('_TEMPLATE_SNOTFOUND',		'没有找到任何东西');
define('_TEMPLATE_UPDATE',			'更新');
define('_TEMPLATE_UPDATE_BTN',		'更新模版');
define('_TEMPLATE_RESET_BTN',		'重置日期');
define('_TEMPLATE_CATEGORYLIST',	'类别列表');
define('_TEMPLATE_CATHEADER',		'类别列表头');
define('_TEMPLATE_CATITEM',			'类别列表项目');
define('_TEMPLATE_CATFOOTER',		'类别列表尾');

// skins
define('_SKIN_EDIT_TITLE',			'编辑皮肤');
define('_SKIN_AVAILABLE_TITLE',		'有效的皮肤');
define('_SKIN_NEW_TITLE',			'新皮肤');
define('_SKIN_NAME',				'名字');
define('_SKIN_DESC',				'描述');
define('_SKIN_TYPE',				'内容类型');
define('_SKIN_CREATE',				'创建');
define('_SKIN_CREATE_BTN',			'创建皮肤');
define('_SKIN_EDITONE_TITLE',		'编辑皮肤');
define('_SKIN_BACK',				'返回皮肤总览');
define('_SKIN_PARTS_TITLE',			'皮肤部分');
define('_SKIN_PARTS_MSG',			'并不是所有的否是必需的,不需要的可以留空.选择下面需要编辑的皮肤类型');
define('_SKIN_PART_MAIN',			'主索引文件');
define('_SKIN_PART_ITEM',			'文章页');
define('_SKIN_PART_ALIST',			'档案列表');
define('_SKIN_PART_ARCHIVE',		'档案');
define('_SKIN_PART_SEARCH',			'搜索');
define('_SKIN_PART_ERROR',			'错误');
define('_SKIN_PART_MEMBER',			'会员详细资料');
define('_SKIN_PART_POPUP',			'图像弹出窗口');
define('_SKIN_GENSETTINGS_TITLE',	'普通设置');
define('_SKIN_CHANGE',				'改变');
define('_SKIN_CHANGE_BTN',			'改变这些设置');
define('_SKIN_UPDATE_BTN',			'更新皮肤');
define('_SKIN_RESET_BTN',			'恢复数据');
define('_SKIN_EDITPART_TITLE',		'编辑皮肤');
define('_SKIN_GOBACK',				'返回');
define('_SKIN_ALLOWEDVARS',			'允许的表达式（点击相应的项目察看详细信息）：');

// global settings
define('_SETTINGS_TITLE',			'普通设置');
define('_SETTINGS_SUB_GENERAL',		'普通设置');
define('_SETTINGS_DEFBLOG',			'默认日志');
define('_SETTINGS_ADMINMAIL',		'超级管理员邮件');
define('_SETTINGS_SITENAME',		'网站名称');
define('_SETTINGS_SITEURL',			'网站的URL（以斜线"/"结束）');
define('_SETTINGS_ADMINURL',		'管理员区域的URL（以斜线"/"结束）');
define('_SETTINGS_DIRS',			'系统目录');
define('_SETTINGS_MEDIADIR',		'媒体目录');
define('_SETTINGS_SEECONFIGPHP',	'（察看 config.php）');
define('_SETTINGS_MEDIAURL',		'Media URL （以斜线"/"结束）');
define('_SETTINGS_ALLOWUPLOAD',		'允许文件上传？');
define('_SETTINGS_ALLOWUPLOADTYPES','允许上传文件的类型');
define('_SETTINGS_CHANGELOGIN',		'允许会员更改登录密码');
define('_SETTINGS_COOKIES_TITLE',	'Cookie 设置');
define('_SETTINGS_COOKIELIFE',		'Cookie 保存时间');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'保存一个月');
define('_SETTINGS_COOKIEPATH',		'Cookie 路径 (高级)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie 域（高级）');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie（高级）');
define('_SETTINGS_LASTVISIT',		'保存上次访问的Cookie');
define('_SETTINGS_ALLOWCREATE',		'允许访客建立会员账号');
define('_SETTINGS_NEWLOGIN',		'允许访客建立的账号登录');
define('_SETTINGS_NEWLOGIN2',		'（只在新注册的账号上生效）');
define('_SETTINGS_MEMBERMSGS',		'允许会员到会员的服务');
define('_SETTINGS_LANGUAGE',		'默认语言');
define('_SETTINGS_DISABLESITE',		'关闭站点');
define('_SETTINGS_DBLOGIN',			'MySQL 登录 &amp; 数据库');
define('_SETTINGS_UPDATE',			'更新设置');
define('_SETTINGS_UPDATE_BTN',		'更新设置');
define('_SETTINGS_DISABLEJS',		'禁止 JavaScript 工具条');
define('_SETTINGS_MEDIA',			'媒体/上传 设置');
define('_SETTINGS_MEDIAPREFIX',		'前缀上传文件带有日期');
define('_SETTINGS_MEMBERS',			'会员设置');

// bans
define('_BAN_TITLE',				'禁止列表');
define('_BAN_NONE',					'改日志没有任何封锁');
define('_BAN_NEW_TITLE',			'添加新的封锁');
define('_BAN_NEW_TEXT',				'现在添加一条新的封锁');
define('_BAN_REMOVE_TITLE',			'删除规定');
define('_BAN_IPRANGE',				'IP封锁');
define('_BAN_BLOGS',				'哪个日志？');
define('_BAN_DELETE_TITLE',			'删除封锁');
define('_BAN_ALLBLOGS',				'你拥有管理员权利的所有日志。');
define('_BAN_REMOVED_TITLE',		'封锁移除');
define('_BAN_REMOVED_TEXT',			'从以下日志移除封锁：');
define('_BAN_ADD_TITLE',			'添加封锁');
define('_BAN_IPRANGE_TEXT',			'选择你要封锁的IP。');
define('_BAN_BLOGS_TEXT',			'你可以选择仅仅禁止本日志或者禁止所有你拥有管理员权利的日志，在下面选择。');
define('_BAN_REASON_TITLE',			'原因');
define('_BAN_REASON_TEXT',			'你可以为封锁提供一个原因，当被禁止的IP所有者试图添加另一条评论或者是投票时显示，最多128字。');
define('_BAN_ADD_BTN',				'添加封锁');

// LOGIN screen
define('_LOGIN_MESSAGE',			'消息');
define('_LOGIN_NAME',				'名字');
define('_LOGIN_PASSWORD',			'密码');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'忘记密码？');

// membermanagement
define('_MEMBERS_TITLE',			'会员管理');
define('_MEMBERS_CURRENT',			'当前会员');
define('_MEMBERS_NEW',				'新会员');
define('_MEMBERS_DISPLAY',			'账号');
define('_MEMBERS_DISPLAY_INFO',		'（即登录名）');
define('_MEMBERS_REALNAME',			'真实名字');
define('_MEMBERS_PWD',				'密码');
define('_MEMBERS_REPPWD',			'重复密码');
define('_MEMBERS_EMAIL',			'Email地址');
define('_MEMBERS_EMAIL_EDIT',		'（当你改变邮件地址的时候，将会向该地址发关一封邮件）');
define('_MEMBERS_URL',				'网站地址(URL)');
define('_MEMBERS_SUPERADMIN',		'超级管理员权限');
define('_MEMBERS_CANLOGIN',			'可以登录到管理员界面');
define('_MEMBERS_NOTES',			'注意');
define('_MEMBERS_NEW_BTN',			'添加会员');
define('_MEMBERS_EDIT',				'编辑会员');
define('_MEMBERS_EDIT_BTN',			'改变设置');
define('_MEMBERS_BACKTOOVERVIEW',	'返回会员总揽');
define('_MEMBERS_DEFLANG',			'语言');
define('_MEMBERS_USESITELANG',		'- 使用站点设置 -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'访问站点');
define('_BLOGLIST_ADD',				'添加文章');
define('_BLOGLIST_TT_ADD',			'在这个日志中添加新文章');
define('_BLOGLIST_EDIT',			'编辑/删除 文章');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'书签');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'设置');
define('_BLOGLIST_TT_SETTINGS',		'编辑设置或者管理团队');
define('_BLOGLIST_BANS',			'规定');
define('_BLOGLIST_TT_BANS',			'察看,添加或者移除被禁止的IP');
define('_BLOGLIST_DELETE',			'全部删除');
define('_BLOGLIST_TT_DELETE',		'删除该日志');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'你的日志');
define('_OVERVIEW_YRDRAFTS',		'你的草稿');
define('_OVERVIEW_YRSETTINGS',		'你的设置');
define('_OVERVIEW_GSETTINGS',		'普通设置');
define('_OVERVIEW_NOBLOGS',			'你不属于任何团队的列表');
define('_OVERVIEW_NODRAFTS',		'没有草稿');
define('_OVERVIEW_EDITSETTINGS',	'编辑设置…');
define('_OVERVIEW_BROWSEITEMS',		'浏览项目…');
define('_OVERVIEW_BROWSECOMM',		'浏览评论…');
define('_OVERVIEW_VIEWLOG',			'动作纪录…');
define('_OVERVIEW_MEMBERS',			'会员管理…');
define('_OVERVIEW_NEWLOG',			'建立新的日志…');
define('_OVERVIEW_SETTINGS',		'编辑设置…');
define('_OVERVIEW_TEMPLATES',		'编辑模版…');
define('_OVERVIEW_SKINS',			'编辑皮肤…');
define('_OVERVIEW_BACKUP',			'备份/恢复…');

// ITEMLIST
define('_ITEMLIST_BLOG',			'这个日志的文章'); 
define('_ITEMLIST_YOUR',			'你的文章');

// Comments
define('_COMMENTS',					'评论');
define('_NOCOMMENTS',				'这篇文章没有评论');
define('_COMMENTS_YOUR',			'你的评论');
define('_NOCOMMENTS_YOUR',			'你没有写任何评论');

// LISTS (general)
define('_LISTS_NOMORE',				'没有更多结果或者没有结果');
define('_LISTS_PREV',				'上一篇');
define('_LISTS_NEXT',				'下一篇');
define('_LISTS_SEARCH',				'搜索');
define('_LISTS_CHANGE',				'改变');
define('_LISTS_PERPAGE',			'文章/页');
define('_LISTS_ACTIONS',			'动作');
define('_LISTS_DELETE',				'删除');
define('_LISTS_EDIT',				'编辑');
define('_LISTS_MOVE',				'移动');
define('_LISTS_CLONE',				'克隆');
define('_LISTS_TITLE',				'标题');
define('_LISTS_BLOG',				'日志');
define('_LISTS_NAME',				'名字');
define('_LISTS_DESC',				'描述');
define('_LISTS_TIME',				'时间');
define('_LISTS_COMMENTS',			'评论');
define('_LISTS_TYPE',				'类型');


// member list 
define('_LIST_MEMBER_NAME',			'用户账号');
define('_LIST_MEMBER_RNAME',		'真实名字');
define('_LIST_MEMBER_ADMIN',		'超级管理员？');
define('_LIST_MEMBER_LOGIN',		'能够登录？');
define('_LIST_MEMBER_URL',			'网站');

// banlist
define('_LIST_BAN_IPRANGE',			'IP范围');
define('_LIST_BAN_REASON',			'原因');

// actionlist
define('_LIST_ACTION_MSG',			'消息');

// commentlist
define('_LIST_COMMENT_BANIP',		'禁止IP');
define('_LIST_COMMENT_WHO',			'作者');
define('_LIST_COMMENT',				'评论');
define('_LIST_COMMENT_HOST',		'主人');

// itemlist
define('_LIST_ITEM_INFO',			'信息');
define('_LIST_ITEM_CONTENT',		'标题和文本');


// teamlist
define('_LIST_TEAM_ADMIN',			'超级用户 ');
define('_LIST_TEAM_CHADMIN',		'更改超级用户');

// edit comments
define('_EDITC_TITLE',				'编辑评论');
define('_EDITC_WHO',				'作者');
define('_EDITC_HOST',				'从哪里？');
define('_EDITC_WHEN',				'什么时候？');
define('_EDITC_TEXT',				'文本');
define('_EDITC_EDIT',				'编辑评论');
define('_EDITC_MEMBER',				'会员');
define('_EDITC_NONMEMBER',			'非会员');

// move item
define('_MOVE_TITLE',				'移动到哪个日志？');
define('_MOVE_BTN',					'移动文章');

?>