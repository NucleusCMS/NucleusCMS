<?
// persian Nucleus Language File
// 
// Author:kambiz mozaffari (kami_kamo@yahoo.com)
// Nucleus version: v1.0-v2.5
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'نمايش');
define('_MEDIA_VIEW_TT',			'(نمايش پوشه( بازكردن پوشه در پنجره جديد');
define('_MEDIA_FILTER_APPLY',		'استفاده از صافي');
define('_MEDIA_FILTER_LABEL',		'صافي: ');
define('_MEDIA_UPLOAD_TO',			'باركذاري در...');
define('_MEDIA_UPLOAD_NEW',			'بارگذاري پوشه جديد...');
define('_MEDIA_COLLECTION_SELECT',	'انتخاب');
define('_MEDIA_COLLECTION_TT',		'برو به اين دسته بندي');
define('_MEDIA_COLLECTION_LABEL',	'مكان فعلي: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'تراز از چپ');
define('_ADD_ALIGNRIGHT_TT',		'تراز از راست');
define('_ADD_ALIGNCENTER_TT',		'تراز از وسط');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'شامل جستجو بودن');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'خطا در بارگذاري');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'اجازه به ارسال در گذشته');
define('_ADD_CHANGEDATE',			'Update timestamp');
define('_BMLET_CHANGEDATE',			'Update timestamp');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'ورود/صدور پوسته...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'عادي');
define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
define('_SKIN_INCLUDE_MODE',		'Include mode');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'قالب پايه');
define('_SETTINGS_SKINSURL',		'نشاني قابل');
define('_SETTINGS_ACTIONSURL',		'action.phpنشاني كامل به');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'عدم توانايي در جابجايي دسته بندي پيش فرضُ');
define('_ERROR_MOVETOSELF',			'Cannot move category (destination blog is the same as source blog)');
define('_MOVECAT_TITLE',			'Select blog to move category to');
define('_MOVECAT_BTN',				'جابجايي دسته بندي');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL Mode');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nothing selected to perform actions on');
define('_BATCH_ITEMS',				'Batch operation on items');
define('_BATCH_CATEGORIES',			'Batch operation on categories');
define('_BATCH_MEMBERS',			'Batch operation on members');
define('_BATCH_TEAM',				'Batch operation on team members');
define('_BATCH_COMMENTS',			'Batch operation on comments');
define('_BATCH_UNKNOWN',			'Unknown batch operation: ');
define('_BATCH_EXECUTING',			'Executing');
define('_BATCH_ONCATEGORY',			'on category');
define('_BATCH_ONITEM',				'on item');
define('_BATCH_ONCOMMENT',			'on comment');
define('_BATCH_ONMEMBER',			'on member');
define('_BATCH_ONTEAM',				'on team member');
define('_BATCH_SUCCESS',			'Success!');
define('_BATCH_DONE',				'انجام شد!');
define('_BATCH_DELETE_CONFIRM',		'Confirm Batch Deletion');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirm Batch Deletion');
define('_BATCH_SELECTALL',			'انتخاب همه');
define('_BATCH_DESELECTALL',		'انتخاب نشدن همه');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'حذف');
define('_BATCH_ITEM_MOVE',			'جابجايي');
define('_BATCH_MEMBER_DELETE',		'حذف');
define('_BATCH_MEMBER_SET_ADM',		'Give admin rights');
define('_BATCH_MEMBER_UNSET_ADM',	'Take away admin rights');
define('_BATCH_TEAM_DELETE',		'حذف از گروه');
define('_BATCH_TEAM_SET_ADM',		'Give admin rights');
define('_BATCH_TEAM_UNSET_ADM',		'Take away admin rights');
define('_BATCH_CAT_DELETE',			'حذف');
define('_BATCH_CAT_MOVE',			'Move to other blog');
define('_BATCH_COMMENT_DELETE',		'حذف');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'اضافه كردن نوشته جديد...');
define('_ADD_PLUGIN_EXTRAS',		'Extra Plugin Options');

// errors
define('_ERROR_CATCREATEFAIL',		'عدم توانايي در ساخت دسته بندي جديد');
define('_ERROR_NUCLEUSVERSIONREQ',	'This plugin requires a newer Nucleus version: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'بازگشت به تنظيمات وبلاگ');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'ورود');
define('_SKINIE_TITLE_EXPORT',		'صدور');
define('_SKINIE_BTN_IMPORT',		'ورود');
define('_SKINIE_BTN_EXPORT',		'صدور قالب ها/پوسته هاي انتخاب شده');
define('_SKINIE_LOCAL',				'Import from local file:');
define('_SKINIE_NOCANDIDATES',		'No candidates for import found in the skins directory');
define('_SKINIE_FROMURL',			'Import from URL:');
define('_SKINIE_EXPORT_INTRO',		'Select the skins and templates you want to export below');
define('_SKINIE_EXPORT_SKINS',		'پوسته');
define('_SKINIE_EXPORT_TEMPLATES',	'Templates');
define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Overwrite skins that already exists (see nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Yes, I want to import this');
define('_SKINIE_CONFIRM_TITLE',		'About to import skins and templates');
define('_SKINIE_INFO_SKINS',		'Skins in file:');
define('_SKINIE_INFO_TEMPLATES',	'Templates in file:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
define('_SKINIE_INFO_IMPORTEDSKINS','Imported skins:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Imported templates:');
define('_SKINIE_DONE',				'Done Importing');

define('_AND',						'و');
define('_OR',						'يا');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'empty field (click to edit)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Backup / Restore');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'Click the button below to create a backup of your Nucleus database. You\'ll be prompted to save a backup file. Store it in a safe place.');
define('_BACKUP_ZIP_YES',			'Try to use compression');
define('_BACKUP_ZIP_NO',			'Do not use compression');
define('_BACKUP_BTN',				'Create Backup');
define('_BACKUP_NOTE',				'<b>Note:</b> Only the database contents is stored in the backup. Media files and settings in config.php are thus <b>NOT</b> included in the backup.');
define('_RESTORE_TITLE',			'Restore');
define('_RESTORE_NOTE',				'<b>WARNING:</b> Restoring from a backup will <b>ERASE</b> all current Nucleus data in the database! Only do this when you\'re really sure!	<br />	<b>Note:</b> Make sure that the version of Nucleus in which you created the backup should be the same as the version you\'re running right now! It won\'t work otherwise');
define('_RESTORE_INTRO',			'Select the backup file below (it\'ll be uploaded to the server) and click the "Restore" button to start.');
define('_RESTORE_IMSURE',			'Yes, I\'m sure I want to do this!');
define('_RESTORE_BTN',				'Restore From File');
define('_RESTORE_WARNING',			'(make sure you\'re restoring the correct backup, maybe make a new backup before you start)');
define('_ERROR_BACKUP_NOTSURE',		'You\'ll need to check the \'I\'m sure\' testbox');
define('_RESTORE_COMPLETE',			'Restore Complete');

// new item notification
define('_NOTIFY_NI_MSG',			'A new item has been posted:');
define('_NOTIFY_NI_TITLE',			'New Item!');
define('_NOTIFY_KV_MSG',			'Karma vote on item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comment on item:');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'User ID:');
define('_NOTIFY_USER',				'User:');
define('_NOTIFY_COMMENT',			'Comment:');
define('_NOTIFY_VOTE',				'Vote:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Member:');
define('_NOTIFY_TITLE',				'Title:');
define('_NOTIFY_CONTENTS',			'Contents:');

// member mail message
define('_MMAIL_MSG',				'A message sent to you by');
define('_MMAIL_FROMANON',			'an anonymous visitor');
define('_MMAIL_FROMNUC',			'Posted from a Nucleus weblog at');
define('_MMAIL_TITLE',				'A message from');
define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Add Item');
define('_BMLET_EDIT',				'Edit Item');
define('_BMLET_DELETE',				'Delete Item');
define('_BMLET_BODY',				'Body');
define('_BMLET_MORE',				'Extended');
define('_BMLET_OPTIONS',			'Options');
define('_BMLET_PREVIEW',			'Preview');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item was updated');
define('_ITEM_DELETED',				'Item was deleted');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Are you sure you want to delete the plugin named');
define('_ERROR_NOSUCHPLUGIN',		'No such plugin');
define('_ERROR_DUPPLUGIN',			'Sorry, this plugin is already installed');
define('_ERROR_PLUGFILEERROR',		'No such plugin exists, or the permissions are set incorrectly');
define('_PLUGS_NOCANDIDATES',		'No plugin candidates found');

define('_PLUGS_TITLE_MANAGE',		'مديرت برنامه هاي الحاقي');
define('_PLUGS_TITLE_INSTALLED',	'Currently Installed');
define('_PLUGS_TITLE_UPDATE',		'Update subscription list');
define('_PLUGS_TEXT_UPDATE',		'Nucleus keeps a cache of the event subscriptions of the plugins. When you upgrade a plugin by replacing it\'s file, you should run this update to make sure that the correct subscriptions are cached');
define('_PLUGS_TITLE_NEW',			'Install New Plugin');
define('_PLUGS_ADD_TEXT',			'Below is a list of all the files in your plugins directory, that might be non-installed plugins. Make sure you are <strong>really sure</strong> that it\'s a plugin before adding it.');
define('_PLUGS_BTN_INSTALL',		'Install Plugin');
define('_BACKTOOVERVIEW',			'Back to overview');

// editlink
define('_TEMPLATE_EDITLINK',		'Edit Item Link');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Add left box');
define('_ADD_RIGHT_TT',				'Add right box');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'دسته بندي جديد...');

// new settings
define('_SETTINGS_PLUGINURL',		'Plugin URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. upload file size (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Allow non-members to send messages');
define('_SETTINGS_PROTECTMEMNAMES',	'Protect member names');

// overview screen
define('_OVERVIEW_PLUGINS',			'Manage Plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'ثبت كاربر جديد:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Your email address:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'You do not have admin rights on any of the blogs that have the destination member on the teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory');

// plugin list
define('_LISTS_INFO',				'اطلاعات');
define('_LIST_PLUGS_AUTHOR',		'به وسيله:');
define('_LIST_PLUGS_VER',			'نسخه:');
define('_LIST_PLUGS_SITE',			'ديدن وب سايت');
define('_LIST_PLUGS_DESC',			'توضيح:');
define('_LIST_PLUGS_SUBS',			'Subscribes to the following events:');
define('_LIST_PLUGS_UP',			'انتقال به بالا');
define('_LIST_PLUGS_DOWN',			'انتقال به پايين');
define('_LIST_PLUGS_UNINSTALL',		'غزل');
define('_LIST_PLUGS_ADMIN',			'مدير');
define('_LIST_PLUGS_OPTIONS',		'ويرايش&nbsp;تنظيم ها');

// plugin option list
define('_LISTS_VALUE',				'مقدار');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'this plugin does not have any options set');
define('_PLUGS_BACK',				'Back to Plugin Overview');
define('_PLUGS_SAVE',				'ذخيره تنظيم ها');
define('_PLUGS_OPTIONS_UPDATED',	'Plugin options updated');

define('_OVERVIEW_MANAGEMENT',		'تنظيم هاي مدير');
define('_OVERVIEW_MANAGE',			'Nucleusمديريت...');
define('_MANAGE_GENERAL',			'مديريت كلي');
define('_MANAGE_SKINS',				'پوسته و قالب ها');
define('_MANAGE_EXTRA',				'ويژگي هاي بيشتر');

define('_BACKTOMANAGE',				'Nucleusبازگشت به بخش مديريت');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'utf-8');

// global stuff
define('_LOGOUT',					'خروج');
define('_LOGIN',					'ورود');
define('_YES',						'بله');
define('_NO',						'خير');
define('_SUBMIT',					'تاييد');
define('_ERROR',					'اشتباه');
define('_ERRORMSG',					'An error has occurred!');
define('_BACK',						'بازگشت');
define('_NOTLOGGEDIN',				'وارد نشده ايد');
define('_LOGGEDINAS',				'وارد شده با نام');
define('_ADMINHOME',				'صفحه مدير');
define('_NAME',						'نام');
define('_BACKHOME',					'بازگشت به صفحه مدير');
define('_BADACTION',				'Non existing action requested');
define('_MESSAGE',					'پيام');
define('_HELP_TT',					'كمك!');
define('_YOURSITE',					'وب سايت شما');


define('_POPUP_CLOSE',				'بستن پنجره');

define('_LOGIN_PLEASE',				'Please Log in First');

// commentform
define('_COMMENTFORM_YOUARE',		'You are');
define('_COMMENTFORM_SUBMIT',		'ارسال نظر');
define('_COMMENTFORM_COMMENT',		'نظر شما');
define('_COMMENTFORM_NAME',			'نام');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'مرا به ياد آر');

// loginform
define('_LOGINFORM_NAME',			'نام كاربري');
define('_LOGINFORM_PWD',			'گذرواژه');
define('_LOGINFORM_YOUARE',			'وارد شده با نام');
define('_LOGINFORM_SHARED',			'رايانه اشتراكي');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'ارسال پيام');

// search form
define('_SEARCHFORM_SUBMIT',		'جستجو');

// add item form
define('_ADD_ADDTO',				'اضافه كردن نوشته جديد به');
define('_ADD_CREATENEW',			'ساخت نوشته جديد');
define('_ADD_BODY',					'بدنه');
define('_ADD_TITLE',				'عنوان');
define('_ADD_MORE',					'تمديد شده(اختياري)');
define('_ADD_CATEGORY',				'دسته بندي');
define('_ADD_PREVIEW',				'پيش نمايش');
define('_ADD_DISABLE_COMMENTS',		'فعال نبودن نظرها؟');
define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
define('_ADD_ADDITEM',				'اضافه كردن نوشته');
define('_ADD_ADDNOW',				'اكنون اضافه كن');
define('_ADD_ADDLATER',				'بعدا اضافه كن');
define('_ADD_PLACE_ON',				'در تاريخ');
define('_ADD_ADDDRAFT',				'به پيش نويس ها اضافه كن');
define('_ADD_NOPASTDATES',			'(dates and times in the past are NOT valid, the current time will be used in that case)');
define('_ADD_BOLD_TT',				'حرف برجسته');
define('_ADD_ITALIC_TT',			'حرف كج');
define('_ADD_HREF_TT',				'ساخت پيوند');
define('_ADD_MEDIA_TT',				'اضافه كردن يك چند رسانه اي');
define('_ADD_PREVIEW_TT',			'نمايش/مخفي كردن پيش نمايش');
define('_ADD_CUT_TT',				'برش');
define('_ADD_COPY_TT',				'رونوشت برداري');
define('_ADD_PASTE_TT',				'باز گذاري');


// edit item form
define('_EDIT_ITEM',				'ويرايش نوشته');
define('_EDIT_SUBMIT',				'ويرايش نوشته');
define('_EDIT_ORIG_AUTHOR',			'نويسنده اصلي');
define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
define('_EDIT_COMMENTSNOTE',		'(note: disabling comments will _not_ hide previously added comments)');

// used on delete screens
define('_DELETE_CONFIRM',			'لطفا حذف را تاييد كنيد');
define('_DELETE_CONFIRM_BTN',		'حذف تاييد مي شود');
define('_CONFIRMTXT_ITEM',			'You\'re about to delete the item following item:');
define('_CONFIRMTXT_COMMENT',		'You\'re about to delete the following comment:');
define('_CONFIRMTXT_TEAM1',			'You\'re about to delete ');
define('_CONFIRMTXT_TEAM2',			' from the teamlist for blog ');
define('_CONFIRMTXT_BLOG',			'The blog you are going to delete is: ');
define('_WARNINGTXT_BLOGDEL',		'Warning! Deleting a blog will delete ALL items of that blog, and all comments. Please confirm to make clear that you are CERTAIN of what you\'re doing!<br />Also, don\'t interrupt Nucleus while removing your blog.');
define('_CONFIRMTXT_MEMBER',		'You\'re about to delete the following member profile: ');
define('_CONFIRMTXT_TEMPLATE',		'You\'re about to delete the template named ');
define('_CONFIRMTXT_SKIN',			'You\'re about to delete the skin named ');
define('_CONFIRMTXT_BAN',			'You\'re about to delete the ban for the ip range');
define('_CONFIRMTXT_CATEGORY',		'You\'re about to delete the category ');

// some status messages
define('_DELETED_ITEM',				'نوشته حذف شد');
define('_DELETED_MEMBER',			'كاربر حذف شد');
define('_DELETED_COMMENT',			'نظرها حذف شدند');
define('_DELETED_BLOG',				'وبلاگ حذف شد');
define('_DELETED_CATEGORY',			'دسته بندي حذف شد');
define('_ITEM_MOVED',				'Item Moved');
define('_ITEM_ADDED',				'Item Added');
define('_COMMENT_UPDATED',			'نظرات به روز شد');
define('_SKIN_UPDATED',				'اطلاعات پوسته ذخيره شد');
define('_TEMPLATE_UPDATED',			'اطلاعات قالب ذخيره شد');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Please don\'t use words of lengths higher than 90 in your comments');
define('_ERROR_COMMENT_NOCOMMENT',	'لطفا يك نظر وارد كنيد');
define('_ERROR_COMMENT_NOUSERNAME',	'نام كاربري نادرست');
define('_ERROR_COMMENT_TOOLONG',	'پيام شما بيش از اندازه طولانيست(max. 5000 chars)');
define('_ERROR_COMMENTS_DISABLED',	'نظرات اين وبلاگ در حال حاضر غير فعالند.');
define('_ERROR_COMMENTS_NONPUBLIC',	'You must be logged in as a member to add comment to this blog');
define('_ERROR_COMMENTS_MEMBERNICK','The name you want to use to post comments is in use by a site member. Choose something else.');
define('_ERROR_SKIN',				'Skin error');
define('_ERROR_ITEMCLOSED',			'This item is closed, it\'s not possible to add new comments to it or to vote on it');
define('_ERROR_NOSUCHITEM',			'No such item exists');
define('_ERROR_NOSUCHBLOG',			'No such blog');
define('_ERROR_NOSUCHSKIN',			'No such skin');
define('_ERROR_NOSUCHMEMBER',		'No such member');
define('_ERROR_NOTONTEAM',			'You\'re not on the teamlist of this weblog.');
define('_ERROR_BADDESTBLOG',		'Destination blog does not exist');
define('_ERROR_NOTONDESTTEAM',		'Cannot move item, since you\'re not on the teamlist of the destination blog');
define('_ERROR_NOEMPTYITEMS',		'Cannot add empty items!');
define('_ERROR_BADMAILADDRESS',		'Email address is not valid');
define('_ERROR_BADNOTIFY',			'One or more of the given notify addresses is not a valid email address');
define('_ERROR_BADNAME',			'Name is not valid (only a-z and 0-9 allowed, no spaces at start/end)');
define('_ERROR_NICKNAMEINUSE',		'كاربر ديگري از اين نام كاربري استفاده مي كند');
define('_ERROR_PASSWORDMISMATCH',	'Passwords must match');
define('_ERROR_PASSWORDTOOSHORT',	'Password should be at least 6 characters');
define('_ERROR_PASSWORDMISSING',	'Password cannot be empty');
define('_ERROR_REALNAMEMISSING',	'You must enter a real name');
define('_ERROR_ATLEASTONEADMIN',	'There should always be at least one super-admin that can login to the admin area.');
define('_ERROR_ATLEASTONEBLOGADMIN','Performing this action would leave your weblog unmaintainable. Please make sure there is always at least one admin.');
define('_ERROR_ALREADYONTEAM',		'You can\'t add a member that is already on the team');
define('_ERROR_BADSHORTBLOGNAME',	'The short blog name should only contain a-z and 0-9, without spaces');
define('_ERROR_DUPSHORTBLOGNAME',	'Another blog already has the chosen short name. These names should be unique');
define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Cannot delete the default blog');
define('_ERROR_DELETEMEMBER',		'This member cannot be deleted, probably because she is the author of items or comments');
define('_ERROR_BADTEMPLATENAME',	'Invalid name for template, use only a-z and 0-9, without spaces');
define('_ERROR_DUPTEMPLATENAME',	'Another template with this name already exists');
define('_ERROR_BADSKINNAME',		'Invalid name for skin (only a-z, 0-9 are allowed, no spaces)');
define('_ERROR_DUPSKINNAME',		'Another skin with this name already exists');
define('_ERROR_DEFAULTSKIN',		'There must at all times be a skin named "default"');
define('_ERROR_SKINDEFDELETE',		'Cannot delete skin since it is the default skin for the following weblog: ');
define('_ERROR_DISALLOWED',			'Sorry, you\'re not allowed to perform this action');
define('_ERROR_DELETEBAN',			'Error while trying to delete ban (ban does not exist)');
define('_ERROR_ADDBAN',				'Error while trying to add ban. Ban might not have been added correctly in all your blogs.');
define('_ERROR_BADACTION',			'Required action does not exist');
define('_ERROR_MEMBERMAILDISABLED',	'Member to Member mail messages are disabled');
define('_ERROR_MEMBERCREATEDISABLED','Creation of member accounts is disabled');
define('_ERROR_INCORRECTEMAIL',		'نشاني اي-ميل اشتباه');
define('_ERROR_VOTEDBEFORE',		'You have already voted for this item');
define('_ERROR_BANNED1',			'Cannot perform action since you (ip range ');
define('_ERROR_BANNED2',			') are banned from doing so. The message was: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'You must be logged in in order to perform this action');
define('_ERROR_CONNECT',			'اشتباه در وصل شدن');
define('_ERROR_FILE_TOO_BIG',		'File is too big!');
define('_ERROR_BADFILETYPE',		'Sorry, this filetype is not allowed');
define('_ERROR_BADREQUEST',			'Bad upload request');
define('_ERROR_DISALLOWEDUPLOAD',	'You are not on any weblogs teamlist. Hence, you are not allowed to upload files');
define('_ERROR_BADPERMISSIONS',		'File/Dir permissions are not set correctly');
define('_ERROR_UPLOADMOVEP',		'Error while moving uploaded file');
define('_ERROR_UPLOADCOPY',			'Error while copying file');
define('_ERROR_UPLOADDUPLICATE',	'Another file with that name already exists. Try to rename it before uploading.');
define('_ERROR_LOGINDISALLOWED',	'Sorry, you\'re not allowed to log in to the admin area. You can log in as another user, though');
define('_ERROR_DBCONNECT',			'Could not connect to mySQL server');
define('_ERROR_DBSELECT',			'Could not select the nucleus database.');
define('_ERROR_NOSUCHLANGUAGE',		'No such language file exists');
define('_ERROR_NOSUCHCATEGORY',		'No such category exists');
define('_ERROR_DELETELASTCATEGORY',	'There must at least be one category');
define('_ERROR_DELETEDEFCATEGORY',	'Cannot delete default category');
define('_ERROR_BADCATEGORYNAME',	'Bad category name');
define('_ERROR_DUPCATEGORYNAME',	'Another category with this name already exists');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Warning: Current value is not a directory!');
define('_WARNING_NOTREADABLE',		'Warning: Current value is a non-readable directory!');
define('_WARNING_NOTWRITABLE',		'Warning: Current value is NOT a writable directory!');

// media and upload
define('_MEDIA_UPLOADLINK',			'بارگذاري يك فايل جديد');
define('_MEDIA_MODIFIED',			'modified');
define('_MEDIA_FILENAME',			'نام فايل');
define('_MEDIA_DIMENSIONS',			'ابعاد');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'انتخاب فايل');
define('_UPLOAD_MSG',				'Select the file you want to upload below, and hit the \'Upload\' button.');
define('_UPLOAD_BUTTON',			'بارگذاري كن');

// some status messages
define('_MSG_ACCOUNTCREATED',		'حساب ساخته شد,گذرواژه به نشاني اي-ميل شما ارسال خواهد شد');
define('_MSG_PASSWORDSENT',			'گذرواژه به نشاني اي-ميل ارسال شد.');
define('_MSG_LOGINAGAIN',			'You\'ll need to login again, because your info changed');
define('_MSG_SETTINGSCHANGED',		'تنظيم ها تغيير كرد');
define('_MSG_ADMINCHANGED',			'مدير تغيير كرد');
define('_MSG_NEWBLOG',				'وبلاگ جديد ساخته شد');
define('_MSG_ACTIONLOGCLEARED',		'Action Log Cleared');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'فعاليت هاي غيرمجاز: ');
define('_ACTIONLOG_PWDREMINDERSENT','New password sent for ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'Clear Action Log');
define('_ACTIONLOG_CLEAR_TEXT',		'Clear action log now');

// team management
define('_TEAM_TITLE',				'مديريت گروه براي وبلاگ ');
define('_TEAM_CURRENT',				'گروه فعلي');
define('_TEAM_ADDNEW',				'اضافه كردن كاربر جديد به گروه');
define('_TEAM_CHOOSEMEMBER',		'انتخاب كاربر');
define('_TEAM_ADMIN',				'انتيازهاي مدير؟');
define('_TEAM_ADD',					'به گروه بيافزا');
define('_TEAM_ADD_BTN',				'به گروه بيافزا');

// blogsettings
define('_EBLOG_TITLE',				'ويرايش تنظيم هاي وبلاگ');
define('_EBLOG_TEAM_TITLE',			'ويرايش گروه');
define('_EBLOG_TEAM_TEXT',			'براي ويرايش گروه خود به اينجا برويد...');
define('_EBLOG_SETTINGS_TITLE',		'تنظيم هاي وبلاگ');
define('_EBLOG_NAME',				'نام وبلاگ');
define('_EBLOG_SHORTNAME',			'نام كوتاه وبلاگ');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(should only contain a-z and no spaces)');
define('_EBLOG_DESC',				'توضيح هاي وبلاگ');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'پوسته پيش فرض');
define('_EBLOG_DEFCAT',				'دسته بندي پيش فرض');
define('_EBLOG_LINEBREAKS',			'Convert line breaks');
define('_EBLOG_DISABLECOMMENTS',	'فعال بودن نظرات؟<br /><small>(Disabling comments means that adding comments is not possible.)</small>');
define('_EBLOG_ANONYMOUS',			'اجازه به غير اعضا براي نظردهي؟');
define('_EBLOG_NOTIFY',				'Notify Address(es) (use ; as separator)');
define('_EBLOG_NOTIFY_ON',			'Notify on');
define('_EBLOG_NOTIFY_COMMENT',		'نظرهاي جديد');
define('_EBLOG_NOTIFY_KARMA',		'New karma votes');
define('_EBLOG_NOTIFY_ITEM',		'نوشته هاي جديد وبلاگ');
define('_EBLOG_PING',				'Ping Weblogs.com on update?');
define('_EBLOG_MAXCOMMENTS',		'Max Amount of comments');
define('_EBLOG_UPDATE',				'Update file');
define('_EBLOG_OFFSET',				'تفاوت زماني');
define('_EBLOG_STIME',				'زمان فعلي سرور');
define('_EBLOG_BTIME',				'زمان فعلي وبلاگ');
define('_EBLOG_CHANGE',				'تغيير تنظيم ها');
define('_EBLOG_CHANGE_BTN',			'تغيير تنظيم ها');
define('_EBLOG_ADMIN',				'مدير وبلاگ');
define('_EBLOG_ADMIN_MSG',			'You will be assigned admin privileges');
define('_EBLOG_CREATE_TITLE',		'ساخت وبلاگ جديد');
define('_EBLOG_CREATE_TEXT',		'Fill out the form below to create a new weblog. <br /><br /> <b>Note:</b> Only the necessary options are listed. If you want to set extra options, enter the blogsettings page after creating the weblog.');
define('_EBLOG_CREATE',				'بساز!');
define('_EBLOG_CREATE_BTN',			'وبلاگ جديد را بساز');
define('_EBLOG_CAT_TITLE',			'دسته بندي ها');
define('_EBLOG_CAT_NAME',			'نام دسته بندي');
define('_EBLOG_CAT_DESC',			'توضيح دسته بندي');
define('_EBLOG_CAT_CREATE',			'ساخت دسته بندي جديد');
define('_EBLOG_CAT_UPDATE',			'به روز رساني دسته بندي');
define('_EBLOG_CAT_UPDATE_BTN',		'به روز رساني دسته بندي');

// templates
define('_TEMPLATE_TITLE',			'ويرايش قالب ها');
define('_TEMPLATE_AVAILABLE_TITLE',	'قالب هاي در دسترس');
define('_TEMPLATE_NEW_TITLE',		'قالب جديد');
define('_TEMPLATE_NAME',			'نام قالب');
define('_TEMPLATE_DESC',			'توضيح قالب');
define('_TEMPLATE_CREATE',			'ساخت قالب');
define('_TEMPLATE_CREATE_BTN',		'قالب را بساز');
define('_TEMPLATE_EDIT_TITLE',		'ويرايش قالب');
define('_TEMPLATE_BACK',			'Back to Template Overview');
define('_TEMPLATE_EDIT_MSG',		'Not all template parts are needed, leave empty those that are not needed.');
define('_TEMPLATE_SETTINGS',		'تنظيم هاي قالب');
define('_TEMPLATE_ITEMS',			'Items');
define('_TEMPLATE_ITEMHEADER',		'Item Header');
define('_TEMPLATE_ITEMBODY',		'Item Body');
define('_TEMPLATE_ITEMFOOTER',		'Item Footer');
define('_TEMPLATE_MORELINK',		'Link to extended entry');
define('_TEMPLATE_NEW',				'Indication of new item');
define('_TEMPLATE_COMMENTS_ANY',	'Comments (if any)');
define('_TEMPLATE_CHEADER',			'Comments Header');
define('_TEMPLATE_CBODY',			'Comments Body');
define('_TEMPLATE_CFOOTER',			'Comments Footer');
define('_TEMPLATE_CONE',			'One Comment');
define('_TEMPLATE_CMANY',			'Two (or more) Comments');
define('_TEMPLATE_CMORE',			'Comments Read More');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Comments (if none)');
define('_TEMPLATE_CNONE',			'No Comments');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comments (if any, but too much to show inline)');
define('_TEMPLATE_CTOOMUCH',		'Too Much Comments');
define('_TEMPLATE_ARCHIVELIST',		'Archive Lists');
define('_TEMPLATE_AHEADER',			'Archive List Header');
define('_TEMPLATE_AITEM',			'Archive List Item');
define('_TEMPLATE_AFOOTER',			'Archive List Footer');
define('_TEMPLATE_DATETIME',		'Date and Time');
define('_TEMPLATE_DHEADER',			'Date Header');
define('_TEMPLATE_DFOOTER',			'Date Footer');
define('_TEMPLATE_DFORMAT',			'Date Format');
define('_TEMPLATE_TFORMAT',			'Time Format');
define('_TEMPLATE_LOCALE',			'منطقه');
define('_TEMPLATE_IMAGE',			'Image popups');
define('_TEMPLATE_PCODE',			'Popup Link Code');
define('_TEMPLATE_ICODE',			'Inline Image Code');
define('_TEMPLATE_MCODE',			'Media Object Link Code');
define('_TEMPLATE_SEARCH',			'جستجو');
define('_TEMPLATE_SHIGHLIGHT',		'Highlight');
define('_TEMPLATE_SNOTFOUND',		'Nothing found in search');
define('_TEMPLATE_UPDATE',			'Update');
define('_TEMPLATE_UPDATE_BTN',		'Update Template');
define('_TEMPLATE_RESET_BTN',		'Reset Data');
define('_TEMPLATE_CATEGORYLIST',	'Category Lists');
define('_TEMPLATE_CATHEADER',		'Category List Header');
define('_TEMPLATE_CATITEM',			'Category List Item');
define('_TEMPLATE_CATFOOTER',		'Category List Footer');

// skins
define('_SKIN_EDIT_TITLE',			'ويرايش پوسته');
define('_SKIN_AVAILABLE_TITLE',		'پوسته هاي قابل دسترسي');
define('_SKIN_NEW_TITLE',			'پوسته جديد');
define('_SKIN_NAME',				'نام');
define('_SKIN_DESC',				'توضيح');
define('_SKIN_TYPE',				'نوع محتوا');
define('_SKIN_CREATE',				'ساخت');
define('_SKIN_CREATE_BTN',			'پوسته را بساز');
define('_SKIN_EDITONE_TITLE',		'ويرايش پوسته');
define('_SKIN_BACK',				'Back to Skin Overview');
define('_SKIN_PARTS_TITLE',			'بخش هاي پوسته');
define('_SKIN_PARTS_MSG',			'Not all types are needed for each skin. Leave empty those you don\'t need. Choose the skin type to edit below:');
define('_SKIN_PART_MAIN',			'Main Index');
define('_SKIN_PART_ITEM',			'Item Pages');
define('_SKIN_PART_ALIST',			'Archive List');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',			'Search');
define('_SKIN_PART_ERROR',			'Errors');
define('_SKIN_PART_MEMBER',			'Member Details');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'تنظيم هاي كلي');
define('_SKIN_CHANGE',				'تغيير');
define('_SKIN_CHANGE_BTN',			'تغييرها را انجام بده');
define('_SKIN_UPDATE_BTN',			'پوسته را به روز كن');
define('_SKIN_RESET_BTN',			'بازنشاندن اطلاعات');
define('_SKIN_EDITPART_TITLE',		'ويرايش پوسته');
define('_SKIN_GOBACK',				'بازگشت');
define('_SKIN_ALLOWEDVARS',			'Allowed Variables (click for info):');

// global settings
define('_SETTINGS_TITLE',			'تنظيم هاي كلي');
define('_SETTINGS_SUB_GENERAL',		'تنظيم هاي كلي');
define('_SETTINGS_DEFBLOG',			'وبلاگ پيش فرض');
define('_SETTINGS_ADMINMAIL',		'نشاني اي-ميل مدير');
define('_SETTINGS_SITENAME',		'نام سايت');
define('_SETTINGS_SITEURL',			'URL of Site (should end with a slash)');
define('_SETTINGS_ADMINURL',		'URL of Admin Area (should end with a slash)');
define('_SETTINGS_DIRS',			'Nucleus Directories');
define('_SETTINGS_MEDIADIR',		'Media Directory');
define('_SETTINGS_SEECONFIGPHP',	'(ديدن config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (should end with a slash)');
define('_SETTINGS_ALLOWUPLOAD',		'اجازه به بارگداري فايل؟');
define('_SETTINGS_ALLOWUPLOADTYPES','فايل هاي مجاز براي بارگذاري');
define('_SETTINGS_CHANGELOGIN',		'اجازه به كاربران براي تغيير نام كاربري/گذرواژه');
define('_SETTINGS_COOKIES_TITLE',	'Cookie Settings');
define('_SETTINGS_COOKIELIFE',		'Login Cookie Lifetime');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'Lifetime of a Month');
define('_SETTINGS_COOKIEPATH',		'Cookie Path (advanced)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (advanced)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (advanced)');
define('_SETTINGS_LASTVISIT',		'Save Last Visit Cookies');
define('_SETTINGS_ALLOWCREATE',		'اجازه به بازديد كنندگان براي ساخت حساب كاربري');
define('_SETTINGS_NEWLOGIN',		'Login Allowed for User-Created accounts');
define('_SETTINGS_NEWLOGIN2',		'(only goes for newly created accounts)');
define('_SETTINGS_MEMBERMSGS',		'Allow Member-2-Member Service');
define('_SETTINGS_LANGUAGE',		'زبان پيش فرض');
define('_SETTINGS_DISABLESITE',		'غيرفعال سازي سايت');
define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',			'به روز رساني تنظيم ها');
define('_SETTINGS_UPDATE_BTN',		'تنظيم ها را به روز كن');
define('_SETTINGS_DISABLEJS',		'Disable JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'تنظيم هاي چندرسانه اي/بارگذاري');
define('_SETTINGS_MEDIAPREFIX',		'Prefix uploaded files with date');
define('_SETTINGS_MEMBERS',			'تنظيم هاي كاربران');

// bans
define('_BAN_TITLE',				'Ban List for');
define('_BAN_NONE',					'No bans for this weblog');
define('_BAN_NEW_TITLE',			'Add New Ban');
define('_BAN_NEW_TEXT',				'Add a new ban now');
define('_BAN_REMOVE_TITLE',			'Remove Ban');
define('_BAN_IPRANGE',				'IP Range');
define('_BAN_BLOGS',				'Which blogs?');
define('_BAN_DELETE_TITLE',			'Delete Ban');
define('_BAN_ALLBLOGS',				'All blogs to which you have admin privileges.');
define('_BAN_REMOVED_TITLE',		'Ban Removed');
define('_BAN_REMOVED_TEXT',			'Ban was removed for the following blogs:');
define('_BAN_ADD_TITLE',			'Add Ban');
define('_BAN_IPRANGE_TEXT',			'Choose the IP range you want to block below. The less numbers in it, the more addresses will be blocked.');
define('_BAN_BLOGS_TEXT',			'You can either select to ban the IP on one blog only, or you can select to block the IP on all blogs where you have administrator privileges. Make your choice below.');
define('_BAN_REASON_TITLE',			'Reason');
define('_BAN_REASON_TEXT',			'You can provide a reason for the ban, which will be displayed when the IP holder tries to add another comment or tries to cast a karma vote. Maximum length is 256 characters.');
define('_BAN_ADD_BTN',				'Add Ban');

// LOGIN screen
define('_LOGIN_MESSAGE',			'پيغام');
define('_LOGIN_NAME',				'نام كاربري');
define('_LOGIN_PASSWORD',			'گذرواژه');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'گذرواژه را فراموش كرده ايد؟');

// membermanagement
define('_MEMBERS_TITLE',			'مديريت كاربران');
define('_MEMBERS_CURRENT',			'كاربران كنوني');
define('_MEMBERS_NEW',				'كاربر جديد');
define('_MEMBERS_DISPLAY',			'نام قابل نمايش');
define('_MEMBERS_DISPLAY_INFO',		'(اين نام به عنوان نام ورودي شما استفاده مي گردد)');
define('_MEMBERS_REALNAME',			'نام واقعي');
define('_MEMBERS_PWD',				'گذرواژه');
define('_MEMBERS_REPPWD',			'تكرار گذرواژه');
define('_MEMBERS_EMAIL',			'نشاني اي-ميل');
define('_MEMBERS_EMAIL_EDIT',		'(When you change the email address, a new password will be automatically sent out to that address)');
define('_MEMBERS_URL',				'صفحه شخصي(URL)');
define('_MEMBERS_SUPERADMIN',		'داراي امتيازهاي مدير');
define('_MEMBERS_CANLOGIN',			'توانايي ورود به بخش مديريت');
define('_MEMBERS_NOTES',			'يادداشت ها');
define('_MEMBERS_NEW_BTN',			'افزودن كاربر');
define('_MEMBERS_EDIT',				'ويرايش كاربر');
define('_MEMBERS_EDIT_BTN',			'تغيير تنظيم ها');
define('_MEMBERS_BACKTOOVERVIEW',	'Back to Member Overview');
define('_MEMBERS_DEFLANG',			'زبان');
define('_MEMBERS_USESITELANG',		'- استفاده از تنظيم هاي سايت -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'نمايش سايت');
define('_BLOGLIST_ADD',				'افزودن نوشته');
define('_BLOGLIST_TT_ADD',			'افزودن يك نوشته جديد به اين وبلاگ');
define('_BLOGLIST_EDIT',			'ويرايش/حذف نوشته ها');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'نشانه گذاري');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'تنظيم ها');
define('_BLOGLIST_TT_SETTINGS',		'ويرايش تنظيم ها يا مديريت گروه');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'View, add or remove banned IPs');
define('_BLOGLIST_DELETE',			'حذف همه');
define('_BLOGLIST_TT_DELETE',		'حذف اين وبلاگ');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'وبلاگ هاي شما');
define('_OVERVIEW_YRDRAFTS',		'پيش نويس هاي شما');
define('_OVERVIEW_YRSETTINGS',		'تنظيم هاي شما');
define('_OVERVIEW_GSETTINGS',		'تنظيم هاي كلي');
define('_OVERVIEW_NOBLOGS',			'You\'re not on any weblogs teamlist');
define('_OVERVIEW_NODRAFTS',		'بدون پيش نويس');
define('_OVERVIEW_EDITSETTINGS',	'ويرايش تنظيم هاي شما...');
define('_OVERVIEW_BROWSEITEMS',		'مشاهده نوشته هاي شما...');
define('_OVERVIEW_BROWSECOMM',		'مشاهده نظرهاي شما...');
define('_OVERVIEW_VIEWLOG',			'View Action Log...');
define('_OVERVIEW_MEMBERS',			'مديريت كاربران...');
define('_OVERVIEW_NEWLOG',			'ساخت وبلاگ جديد...');
define('_OVERVIEW_SETTINGS',		'ويرايش تنظيم ها...');
define('_OVERVIEW_TEMPLATES',		'ويرايش قالب ها...');
define('_OVERVIEW_SKINS',			'ويرايش پوسته ها...');
define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Items for blog'); 
define('_ITEMLIST_YOUR',			'نوشته هاي شما');

// Comments
define('_COMMENTS',					'نظرها');
define('_NOCOMMENTS',				'هيچ نظري براي اين نوشته موجود نيست');
define('_COMMENTS_YOUR',			'نظرهاي شما');
define('_NOCOMMENTS_YOUR',			'شما هيچ نظري ننوشته ايد');

// LISTS (general)
define('_LISTS_NOMORE',				'No more results, or no results at all');
define('_LISTS_PREV',				'پيشين');
define('_LISTS_NEXT',				'پسين');
define('_LISTS_SEARCH',				'بگرد');
define('_LISTS_CHANGE',				'تغيير');
define('_LISTS_PERPAGE',			'نوشته/صفحه');
define('_LISTS_ACTIONS',			'فعاليت ها');
define('_LISTS_DELETE',				'حذف');
define('_LISTS_EDIT',				'ويرايش');
define('_LISTS_MOVE',				'جابجايي');
define('_LISTS_CLONE',				'Clone');
define('_LISTS_TITLE',				'عنوان');
define('_LISTS_BLOG',				'وبلاگ');
define('_LISTS_NAME',				'نام');
define('_LISTS_DESC',				'توضيح');
define('_LISTS_TIME',				'زمان');
define('_LISTS_COMMENTS',			'نظرها');
define('_LISTS_TYPE',				'نوع');


// member list 
define('_LIST_MEMBER_NAME',			'نام قابل نمايش');
define('_LIST_MEMBER_RNAME',		'نام واقعي');
define('_LIST_MEMBER_ADMIN',		'مدير اصلي؟ ');
define('_LIST_MEMBER_LOGIN',		'توانا در ورود؟ ');
define('_LIST_MEMBER_URL',			'صفحه شخصي');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Range');
define('_LIST_BAN_REASON',			'دليل');

// actionlist
define('_LIST_ACTION_MSG',			'پيغام');

// commentlist
define('_LIST_COMMENT_BANIP',		'Ban IP');
define('_LIST_COMMENT_WHO',			'نويسنده');
define('_LIST_COMMENT',				'نظر');
define('_LIST_COMMENT_HOST',		'ميزبان');

// itemlist
define('_LIST_ITEM_INFO',			'اطلاعات');
define('_LIST_ITEM_CONTENT',		'عنوان و متن');


// teamlist
define('_LIST_TEAM_ADMIN',			'مدير ');
define('_LIST_TEAM_CHADMIN',		'تغيير مدير');

// edit comments
define('_EDITC_TITLE',				'ويرايش نظرها');
define('_EDITC_WHO',				'نويسنده');
define('_EDITC_HOST',				'از كجا؟');
define('_EDITC_WHEN',				'كي؟');
define('_EDITC_TEXT',				'متن');
define('_EDITC_EDIT',				'ويرايش نظرها');
define('_EDITC_MEMBER',				'كاربر');
define('_EDITC_NONMEMBER',			'غير كاربر');

// move item
define('_MOVE_TITLE',				'انتقال به كدام وبلاگ؟');
define('_MOVE_BTN',					'جابجايي نوشته');

?>