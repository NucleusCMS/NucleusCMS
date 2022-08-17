<?php
// English Nucleus Language File
// 
// Author: p0wer
// Nucleus version: v1.0-v3.1
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START changed/added after 3.1 START

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascript Toolbar Style');
define('_SETTINGS_JSTOOLBAR_FULL',	'����� Toolbar (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','��������� Toolbar (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'������� Toolbar');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">��� �� ���������� fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'������ ��������� �� Plugin');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'�����:');
define('_LIST_ITEM_DATE',			'����:');
define('_LIST_ITEM_TIME',			'�����:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(����)');

// batch operations
define('_BATCH_WITH_SEL',			'��� ���������:');
define('_BATCH_EXEC',				'����������');

// quickmenu
define('_QMENU_HOME',				'������');
define('_QMENU_ADD',				'������ Item');
define('_QMENU_ADD_SELECT',			'-- ������ --');
define('_QMENU_USER_SETTINGS',		'���������');
define('_QMENU_USER_ITEMS',			'Items');
define('_QMENU_USER_COMMENTS',		'��������');
define('_QMENU_MANAGE',				'����������');
define('_QMENU_MANAGE_LOG',			'Action Log');
define('_QMENU_MANAGE_SETTINGS',	'�������� ���������');
define('_QMENU_MANAGE_MEMBERS',		'�������');
define('_QMENU_MANAGE_NEWBLOG',		'��� Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'����������');
define('_QMENU_LAYOUT_SKINS',		'Skins');
define('_QMENU_LAYOUT_TEMPL',		'�������');
define('_QMENU_LAYOUT_IEXPORT',		'��������/��������');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'���������');
define('_QMENU_INTRO_TEXT',			'<p>���� � logon ������ �� Nucleus CMS, the content management system(������� �� ���������� �� ����������) , ����� �� �������� �� ������������ �� ���� ����.</p><p>��� ����� ������, ������ �� ������� � �� ��������� �� ����������� ���� items(������, ������.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'�������� ���� �� ���� plugin �� ���� �� ���� �������');
define('_PLUGS_HELP_TITLE',			'������� �������� �� plugin');
define('_LIST_PLUGS_HELP', 			'�����');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'������ External Authentication(������ ������������');
define('_WARNING_EXTAUTH',			'��������: ������ ���� ��� � ����������.');

// member profile
define('_MEMBERS_BYPASS',			'��������� External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>������</em> �������� � �������');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'���');
define('_MEDIA_VIEW_TT',			'��� ����� (������ �� � ��� ��������)');
define('_MEDIA_FILTER_APPLY',		'������� ������');
define('_MEDIA_FILTER_LABEL',		'�������: ');
define('_MEDIA_UPLOAD_TO',			'���� ��...');
define('_MEDIA_UPLOAD_NEW',			'���� ��� ����...');
define('_MEDIA_COLLECTION_SELECT',	'������');
define('_MEDIA_COLLECTION_TT',		'������� �� ���� ���������');
define('_MEDIA_COLLECTION_LABEL',	'������� ��������: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'������� � ����');
define('_ADD_ALIGNRIGHT_TT',		'������� � �����');
define('_ADD_ALIGNCENTER_TT',		'������� � �������');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'��������� �� �������');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'������� ����������� � ��������');
define('_ADD_CHANGEDATE',			'������ timestamp');
define('_BMLET_CHANGEDATE',			'������ timestamp');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'������/������ ����');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
define('_SKIN_INCLUDE_MODE',		'������ mode');
define('_SKIN_INCLUDE_PREFIX',		'������ prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Base Skin');
define('_SETTINGS_SKINSURL',		'URL �� ������');
define('_SETTINGS_ACTIONSURL',		'����� URL �� action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'�� ���� �� �� ����� default �����������');
define('_ERROR_MOVETOSELF',			'�� ���� �� �������� ����������� (destination blog is the same as source blog)');
define('_MOVECAT_TITLE',			'������ blog ,������ �� ��������� �����������');
define('_MOVECAT_BTN',				'�������� ���������');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL Mode');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'�� � ������� ���� �� �� �� ������� ����������');
define('_BATCH_ITEMS',				'Batch �������� �� items');
define('_BATCH_CATEGORIES',			'Batch �������� �� ���������');
define('_BATCH_MEMBERS',			'Batch �������� �� �������');
define('_BATCH_TEAM',				'Batch �������� �� ������� �������');
define('_BATCH_COMMENTS',			'Batch �������� �� ���������');
define('_BATCH_UNKNOWN',			'���������� batch ��������: ');
define('_BATCH_EXECUTING',			'��������� ��');
define('_BATCH_ONCATEGORY',			'�� ���������');
define('_BATCH_ONITEM',				'�� item');
define('_BATCH_ONCOMMENT',			'�� ��������');
define('_BATCH_ONMEMBER',			'�� ����');
define('_BATCH_ONTEAM',				'�� ������ ����');
define('_BATCH_SUCCESS',			'�����!');
define('_BATCH_DONE',				'���������!');
define('_BATCH_DELETE_CONFIRM',		'�������� ��������� �� Batch');
define('_BATCH_DELETE_CONFIRM_BTN',	'�������� ��������� �� Batch');
define('_BATCH_SELECTALL',			'������ ������');
define('_BATCH_DESELECTALL',		'�������� ������');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'������');
define('_BATCH_ITEM_MOVE',			'��������');
define('_BATCH_MEMBER_DELETE',		'������');
define('_BATCH_MEMBER_SET_ADM',		'��� ���������������� �����');
define('_BATCH_MEMBER_UNSET_ADM',	'������ ���������������� �����');
define('_BATCH_TEAM_DELETE',		'������ �� �������');
define('_BATCH_TEAM_SET_ADM',		'��� ���������������� �����');
define('_BATCH_TEAM_UNSET_ADM',		'������ ���������������� �����');
define('_BATCH_CAT_DELETE',			'������');
define('_BATCH_CAT_MOVE',			'�������� �� ���� blog');
define('_BATCH_COMMENT_DELETE',		'������');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'������ ��� item...');
define('_ADD_PLUGIN_EXTRAS',		'������ ��������� �� Plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'�� ���� �� ������� ���� ���������');
define('_ERROR_NUCLEUSVERSIONREQ',	'���� plugin ������� ��-���� ������ �� Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'����� ��� blogsettings');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'������');
define('_SKINIE_TITLE_EXPORT',		'������');
define('_SKINIE_BTN_IMPORT',		'������');
define('_SKINIE_BTN_EXPORT',		'������ ��������� ����/�������');
define('_SKINIE_LOCAL',				'������ �� ������� ����:');
define('_SKINIE_NOCANDIDATES',		'�� �� �������� ��������� �� ��������� � ����������� �� ������');
define('_SKINIE_FROMURL',			'������ �� URL:');
define('_SKINIE_EXPORT_INTRO',		'������ ���� � �������, ����� ����� �� �������');
define('_SKINIE_EXPORT_SKINS',		'����');
define('_SKINIE_EXPORT_TEMPLATES',	'�������');
define('_SKINIE_EXPORT_EXTRA',		'������ ����');
define('_SKINIE_CONFIRM_OVERWRITE',	'Overwrite ����, ����� ���� ����������� (��� nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'��, ����� �� ������ ���');
define('_SKINIE_CONFIRM_TITLE',		'About to import skins and templates');
define('_SKINIE_INFO_SKINS',		'���� ��� �����:');
define('_SKINIE_INFO_TEMPLATES',	'������� ��� �����:');
define('_SKINIE_INFO_GENERAL',		'����:');
define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
define('_SKINIE_INFO_IMPORTEDSKINS','�������� ����:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','�������� �������:');
define('_SKINIE_DONE',				'��������� ����������');

define('_AND',						'�');
define('_OR',						'���');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'�������� ������ (������ �� ��������)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'������Mode:');
define('_LIST_SKINS_INCPREFIX',		'������Prefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts(���������� �����):');

// backup
define('_BACKUPS_TITLE',			'Backup / ��������');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'������ �� ������ ��-���� �� �� �������� ����� �� ������ Nucleus ���� �����. You\'ll be prompted to save a backup file. �������� �� �� ������� �����.');
define('_BACKUP_ZIP_YES',			'������� �� ��������� ���������');
define('_BACKUP_ZIP_NO',			'�� ��������� ���������');
define('_BACKUP_BTN',				'������ Backup');
define('_BACKUP_NOTE',				'<b>���������:</b> ���� ������������ �� ������ ����� �� ��������� � backup. ����� ��������� � ����������� �� config.php �� thus <b>��</b> �� �������� � backup.');
define('_RESTORE_TITLE',			'��������');
define('_RESTORE_NOTE',				'<b>��������:</b> ����������� �� backup �� <b>������</b> �������� ������� ����� � Nucleus ���� �����! ��������� ���� ����, ��� ��� �������� �������!	<br />	<b>���������:</b> ������� ��, �� �������� �� Nucleus, � ����� ��� ������� backup � ������ ���� ��������, ����� ���������� � �������! � �������� ������ ���� �� ������');
define('_RESTORE_INTRO',			'������ backup ����� ���� (��� �� ���� ����� �� �������) � ��������� "Restore" ������ �� �� �������.');
define('_RESTORE_IMSURE',			'��, ������� ���, �� ����� �� ������� ����!');
define('_RESTORE_BTN',				'�������� �� ����');
define('_RESTORE_WARNING',			'(������� ��, �� ���������� ��������� backup, ���� �� ��������� ��� backup ����� �� ���������)');
define('_ERROR_BACKUP_NOTSURE',		'������ �� ��������� \'I\'m sure\' testbox');
define('_RESTORE_COMPLETE',			'���������� ���������');

// new item notification
define('_NOTIFY_NI_MSG',			'��� item ���� ����������:');
define('_NOTIFY_NI_TITLE',			'��� Item!');
define('_NOTIFY_KV_MSG',			'Karma ��������� �� item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'�������� �� item:');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'������������� ID:');
define('_NOTIFY_USER',				'����������:');
define('_NOTIFY_COMMENT',			'��������:');
define('_NOTIFY_VOTE',				'���������:');
define('_NOTIFY_HOST',				'����:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'����:');
define('_NOTIFY_TITLE',				'��������:');
define('_NOTIFY_CONTENTS',			'Contents:');

// member mail message
define('_MMAIL_MSG',				'����������� � ��������� �� ��� ��');
define('_MMAIL_FROMANON',			'�������� ���������');
define('_MMAIL_FROMNUC',			'����������� �� Nucleus weblog at');
define('_MMAIL_TITLE',				'��������� ��');
define('_MMAIL_MAIL',				'���������:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'������ Item');
define('_BMLET_EDIT',				'���������� Item');
define('_BMLET_DELETE',				'������ Item');
define('_BMLET_BODY',				'Body(����)');
define('_BMLET_MORE',				'Extended(�������)');
define('_BMLET_OPTIONS',			'�����');
define('_BMLET_PREVIEW',			'������������� ������');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item ���� updated');
define('_ITEM_DELETED',				'Item ���� ������');

// plugins
define('_CONFIRMTXT_PLUGIN',		'������� �� ���, �� ������ �� �������� plugin named(������������');
define('_ERROR_NOSUCHPLUGIN',		'���� ����� plugin');
define('_ERROR_DUPPLUGIN',			'���������, ���� plugin ���� � ����������');
define('_ERROR_PLUGFILEERROR',		'�� ���������� ����� plugin, ��� ��������� �� ���������� ��������');
define('_PLUGS_NOCANDIDATES',		'�� �� �������� plugin ���������');

define('_PLUGS_TITLE_MANAGE',		'���������� �� Plugins');
define('_PLUGS_TITLE_INSTALLED',	'�����������');
define('_PLUGS_TITLE_UPDATE',		'Update subscription list');
define('_PLUGS_TEXT_UPDATE',		'Nucleus ���� � cache event subscriptions �� plugins. ������ ���������(upgrade) plugin ��������� ������� ����, ��� �� ������ �� ��������� ���� update(����������) �� �� ��� �������, �� ������ subscriptions �� cached');
define('_PLUGS_TITLE_NEW',			'���������� ��� Plugin');
define('_PLUGS_ADD_TEXT',			'��-���� �� ������ ������� �� ������ ������� ��� ������ plugins ����������, ���� ���� � �� �� ������������� plugins. ������� ��, �� <strong>�������� ��� �������</strong> ,�� ���� � plugin ����� �� �� ��������.');
define('_PLUGS_BTN_INSTALL',		'���������� Plugin');
define('_BACKTOOVERVIEW',			'����� �� �� overview');

// editlink
define('_TEMPLATE_EDITLINK',		'���������� Item Link');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'������ ��� box(�����)');
define('_ADD_RIGHT_TT',				'������ ����� box(�����)');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'���� ���������...');

// new settings
define('_SETTINGS_PLUGINURL',		'Plugin URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. upload ������ ������ (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'������� �� non-members �� �������� ���������');
define('_SETTINGS_PROTECTMEMNAMES',	'���� ������� �� ���������');

// overview screen
define('_OVERVIEW_PLUGINS',			'Manage Plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'New member registration:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Your email address:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'You do not have admin rights on any of the blogs that have the destination member on the teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory');

// plugin list
define('_LISTS_INFO',				'����������');
define('_LIST_PLUGS_AUTHOR',		'��:');
define('_LIST_PLUGS_VER',			'������:');
define('_LIST_PLUGS_SITE',			'������ ����');
define('_LIST_PLUGS_DESC',			'��������:');
define('_LIST_PLUGS_SUBS',			'Subscribes �� �������� events:');
define('_LIST_PLUGS_UP',			'move up');
define('_LIST_PLUGS_DOWN',			'move down');
define('_LIST_PLUGS_UNINSTALL',		'������������');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'edit&nbsp;options');

// plugin option list
define('_LISTS_VALUE',				'��������');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'���� plugin ���� ������� ��������� �����');
define('_PLUGS_BACK',				'������� ��� Plugin Overview');
define('_PLUGS_SAVE',				'������ Options');
define('_PLUGS_OPTIONS_UPDATED',	'Plugin options updated');

define('_OVERVIEW_MANAGEMENT',		'����������');
define('_OVERVIEW_MANAGE',			'Nucleus ����������...');
define('_MANAGE_GENERAL',			'��������� ����������');
define('_MANAGE_SKINS',				'���� � �������');
define('_MANAGE_EXTRA',				'������ ����������');

define('_BACKTOMANAGE',				'������� ��� Nucleus ����������');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-5');

// global stuff
define('_LOGOUT',					'Log Out');
define('_LOGIN',					'Log In');
define('_YES',						'��');
define('_NO',						'��');
define('_SUBMIT',					'Submit');
define('_ERROR',					'������');
define('_ERRORMSG',					'����� �� ������!');
define('_BACK',						'����� ��');
define('_NOTLOGGEDIN',				'Not logged in');
define('_LOGGEDINAS',				'Logged in ����');
define('_ADMINHOME',				'Admin Home');
define('_NAME',						'���');
define('_BACKHOME',					'����� �� ��� Admin Home');
define('_BADACTION',				'������� �� �������������� �������');
define('_MESSAGE',					'���������');
define('_HELP_TT',					'�����!');
define('_YOURSITE',					'����� ����');


define('_POPUP_CLOSE',				'������� ���������');

define('_LOGIN_PLEASE',				'���� ����� �� �������');

// commentform
define('_COMMENTFORM_YOUARE',		'��� ���');
define('_COMMENTFORM_SUBMIT',		'������ ��������');
define('_COMMENTFORM_COMMENT',		'����� ��������');
define('_COMMENTFORM_NAME',			'���');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'������� ��');

// loginform
define('_LOGINFORM_NAME',			'������������� ���');
define('_LOGINFORM_PWD',			'������');
define('_LOGINFORM_YOUARE',			'Logged in ����');
define('_LOGINFORM_SHARED',			'Shared Computer');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'������� ���������');

// search form
define('_SEARCHFORM_SUBMIT',		'�����');

// add item form
define('_ADD_ADDTO',				'������ ��� item ���');
define('_ADD_CREATENEW',			'������ item');
define('_ADD_BODY',					'Body');
define('_ADD_TITLE',				'��������');
define('_ADD_MORE',					'Extended (�� �����)');
define('_ADD_CATEGORY',				'���������');
define('_ADD_PREVIEW',				'Preview');
define('_ADD_DISABLE_COMMENTS',		'������� ���������?');
define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
define('_ADD_ADDITEM',				'������ Item');
define('_ADD_ADDNOW',				'������ ����');
define('_ADD_ADDLATER',				'������ ��-�����');
define('_ADD_PLACE_ON',				'������� ��');
define('_ADD_ADDDRAFT',				'������ ��� drafts');
define('_ADD_NOPASTDATES',			'(���� � ����� � �������� �� �� �������, � ����� ������ �� �� �������� ��������� �����)');
define('_ADD_BOLD_TT',				'Bold');
define('_ADD_ITALIC_TT',			'Italic');
define('_ADD_HREF_TT',				'������� ����');
define('_ADD_MEDIA_TT',				'������ �����');
define('_ADD_PREVIEW_TT',			'������/����� Preview');
define('_ADD_CUT_TT',				'Cut');
define('_ADD_COPY_TT',				'Copy');
define('_ADD_PASTE_TT',				'Paste');


// edit item form
define('_EDIT_ITEM',				'���������� Item');
define('_EDIT_SUBMIT',				'���������� Item');
define('_EDIT_ORIG_AUTHOR',			'���������� �����');
define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
define('_EDIT_COMMENTSNOTE',		'(���������: ����������� ����������� ���� _��_ ����� �������� �������� ���������)');

// used on delete screens
define('_DELETE_CONFIRM',			'����, ���������� �����������');
define('_DELETE_CONFIRM_BTN',		'�������� ���������');
define('_CONFIRMTXT_ITEM',			'��� ��� �� ��� �� �������� the item ������� item:');
define('_CONFIRMTXT_COMMENT',		'��� ��� �� ��� �� �������� ������� ��������:');
define('_CONFIRMTXT_TEAM1',			'��� ��� �� ��� �� �������� ');
define('_CONFIRMTXT_TEAM2',			' �� teamlist �� blog ');
define('_CONFIRMTXT_BLOG',			'Blog-a , ����� �� �������� �: ');
define('_WARNINGTXT_BLOGDEL',		'��������! ���������� blog �� �������� ������ items �� ���� blog, � ������ ���������. ���� ����������, �� ��� ������� ����� �������!<br />���� ����, �� ����������� Nucleus , ������ �������� ����� blog.');
define('_CONFIRMTXT_MEMBER',		'�� ��� ��� �� �������� ������� �� ������� ����: ');
define('_CONFIRMTXT_TEMPLATE',		'�� ��� ��� �� �������� template named ');
define('_CONFIRMTXT_SKIN',			'�� ��� ��� �� �������� skin named ');
define('_CONFIRMTXT_BAN',			'�� ��� ��� �� �������� ban-� �� ip range');
define('_CONFIRMTXT_CATEGORY',		'�� ��� ��� �� �������� ����������� ');

// some status messages
define('_DELETED_ITEM',				'Item ������');
define('_DELETED_MEMBER',			'���� ������');
define('_DELETED_COMMENT',			'�������� ������');
define('_DELETED_BLOG',				'Blog ������');
define('_DELETED_CATEGORY',			'��������� �������');
define('_ITEM_MOVED',				'Item ���������');
define('_ITEM_ADDED',				'Item �������');
define('_COMMENT_UPDATED',			'�������� �������');
define('_SKIN_UPDATED',				'Skin data has been saved');
define('_TEMPLATE_UPDATED',			'Template data has been saved');

// errors
define('_ERROR_COMMENT_LONGWORD',	'���� �� ����������� ���� � ������� ��-������ �� 90 ������� ��� ������ ���������');
define('_ERROR_COMMENT_NOCOMMENT',	'���� �������� ��������');
define('_ERROR_COMMENT_NOUSERNAME',	'���� ������������ ���');
define('_ERROR_COMMENT_TOOLONG',	'������ �������� � ����� ����� (max. 5000 �������)');
define('_ERROR_COMMENTS_DISABLED',	'����������� �� ���� ���� �� ����������� �� ������.');
define('_ERROR_COMMENTS_NONPUBLIC',	'������ �� ��� �� ������� ���� ���� �� �� �������� ��������� ��� ���� blog');
define('_ERROR_COMMENTS_MEMBERNICK','�����, ����� ������ �� ���������� �� �� ����������� ��������� �� �������� �� ���� �� �����. �������� ���� �����.');
define('_ERROR_SKIN',				'Skin error');
define('_ERROR_ITEMCLOSED',			'���� item � ��������, �� � �������� �� �������� ���� ��������� ��� ���� ��� �� ��������� �� ����');
define('_ERROR_NOSUCHITEM',			'�� ���������� ����� item');
define('_ERROR_NOSUCHBLOG',			'���� ����� blog');
define('_ERROR_NOSUCHSKIN',			'���� ������ ����');
define('_ERROR_NOSUCHMEMBER',		'���� ����� ����');
define('_ERROR_NOTONTEAM',			'�� �� �� ��� ��������� ����� �� ���� weblog.');
define('_ERROR_BADDESTBLOG',		'���������� blog �� ����������');
define('_ERROR_NOTONDESTTEAM',		'�� ������ �� ������� items, ������ �� ��� �� ��������� ����� �� ���������� blog');
define('_ERROR_NOEMPTYITEMS',		'�� ������ �� �������� ������ items!');
define('_ERROR_BADMAILADDRESS',		'Email ������ �� � �������');
define('_ERROR_BADNOTIFY',			'���� ��� ������� �� �������������� �� ����������� ������ �� � ������� email �����');
define('_ERROR_BADNAME',			'����� �� � ������� (���� a-z � 0-9 �� ���������, ��� ������ ����� � ��������/����)');
define('_ERROR_NICKNAMEINUSE',		'���� ���� ���� �������� ���� ������������� ���');
define('_ERROR_PASSWORDMISMATCH',	'�������� ������ �� ��������');
define('_ERROR_PASSWORDTOOSHORT',	'�������� ������ �� � ������� 6 �����');
define('_ERROR_PASSWORDMISSING',	'�������� �� ���� �� � ������');
define('_ERROR_REALNAMEMISSING',	'������ �� �������� �������� ���');
define('_ERROR_ATLEASTONEADMIN',	'������ ������ �� ��� ���� ���� ����� ����� �� �� ���� �� �� ����� ��� ������������������ ����.');
define('_ERROR_ATLEASTONEBLOGADMIN','������������ ���� �������� �� ������ ����� weblog ������������. ���� ������� �� , �� ������ ��� ���� ���� �������������.');
define('_ERROR_ALREADYONTEAM',		'�� ������ �� �������� ���� , ����� ���� � � �������');
define('_ERROR_BADSHORTBLOGNAME',	'�������� ��� �� blog-� ������ �� ������� ���� a-z and 0-9, ��� ����������');
define('_ERROR_DUPSHORTBLOGNAME',	'���� blog ���� ��� ������ ������ ���. ���� ����� ������ �� �� ��������');
define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. ������� ��, �� ��������� �� ����� �� ������� ����� ������ (����������� chmodding it to 666). ���� ���� ����������, �� ����������������� �� ������ �� admin-area ������������, ����, �� ���� �� ������ �� ���������� absolute path (���� ���� /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'�� ������ �� �������� default blog');
define('_ERROR_DELETEMEMBER',		'���� ���� �� ���� �� ���� ������, ������� ������ ���/�� � ����� �� items ��� ���������');
define('_ERROR_BADTEMPLATENAME',	'��������� ��� �� ������, ����������� ���� a-z � 0-9, ��� ����������');
define('_ERROR_DUPTEMPLATENAME',	'���� ������ � ���� ��� ���� ����������');
define('_ERROR_BADSKINNAME',		'��������� ��� �� ���� (���� a-z, 0-9 �� ���������, ��� ����������)');
define('_ERROR_DUPSKINNAME',		'����� ���� � ���� ��� ���� ����������');
define('_ERROR_DEFAULTSKIN',		'������ ������ �� ��� ���� � ��� "default"');
define('_ERROR_SKINDEFDELETE',		'�� ���� �� ������ ���� ������ �� � default skin �� �������/�� weblog: ');
define('_ERROR_DISALLOWED',			'���������, ��� ������ ���������� �� ��������� ���� ��������');
define('_ERROR_DELETEBAN',			'������ ��� ����� �� �� ������ ban (ban �� ����������)');
define('_ERROR_ADDBAN',				'������ ��� ����� �� �� ������ ban. Ban ���� �� �� � ������� �������� �� ������ blogs.');
define('_ERROR_BADACTION',			'���������� �������� �� ����������');
define('_ERROR_MEMBERMAILDISABLED',	'Emails �� ���� ��� ���� �� ���������');
define('_ERROR_MEMBERCREATEDISABLED','����������� �� ������� ������� � ���������');
define('_ERROR_INCORRECTEMAIL',		'��������� mail �����');
define('_ERROR_VOTEDBEFORE',		'���� ���������� �� ���� item');
define('_ERROR_BANNED1',			'�� ���� �� ������� ���������� ������ ��� (ip range ');
define('_ERROR_BANNED2',			') ��� banned �� ������� ����. ����������� ����: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'��� ������ �� �� �������, �� �� ��������� ���� ��������');
define('_ERROR_CONNECT',			'Connect Error');
define('_ERROR_FILE_TOO_BIG',		'����� � ������ �����!');
define('_ERROR_BADFILETYPE',		'���������, ���� ���������� �� ����� �� � ���������');
define('_ERROR_BADREQUEST',			'���� upload ������');
define('_ERROR_DISALLOWEDUPLOAD',	'��� �� ��� � ��������� ����� �� ����� weblog. ������������ ������ ���������� �� ������� �������');
define('_ERROR_BADPERMISSIONS',		'File/Dir ��������� �� �� ��������� �����');
define('_ERROR_UPLOADMOVEP',		'������ ��� ��������� �� ������� ����');
define('_ERROR_UPLOADCOPY',			'������ ��� �������� �� �����');
define('_ERROR_UPLOADDUPLICATE',	'���� ���� ��� ������ ��� ���� ����������. �������� �� �� �� ������������ ����� �� �� ������.');
define('_ERROR_LOGINDISALLOWED',	'Sorry, you\'re not allowed to log in to the admin area. You can log in as another user, though');
define('_ERROR_DBCONNECT',			'�� ���� �� �� ������ � mySQL �������');
define('_ERROR_DBSELECT',			'�� ���� �� ������ nucleus ������ �����.');
define('_ERROR_NOSUCHLANGUAGE',		'�� ���������� ����� ������ ����');
define('_ERROR_NOSUCHCATEGORY',		'�� ���������� ������ ���������');
define('_ERROR_DELETELASTCATEGORY',	'������ �� ��� ���� ���� ���������');
define('_ERROR_DELETEDEFCATEGORY',	'�� ������ �� �������� default �����������');
define('_ERROR_BADCATEGORYNAME',	'���� ��� �� �����������');
define('_ERROR_DUPCATEGORYNAME',	'����� ��������� � ���� ��� ���� ����������');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'��������: �������� �������� �� � ����������!');
define('_WARNING_NOTREADABLE',		'��������: �������� �������� � non-readable directory!');
define('_WARNING_NOTWRITABLE',		'��������: �������� �������� �� � a writable directory!');

// media and upload
define('_MEDIA_UPLOADLINK',			'���� ��� ����');
define('_MEDIA_MODIFIED',			'��������');
define('_MEDIA_FILENAME',			'��� �� �����');
define('_MEDIA_DIMENSIONS',			'�������');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'������ ����');
define('_UPLOAD_MSG',				'������ ����� ����� ������ �� ������ , � ��������� \'Upload\' ������.');
define('_UPLOAD_BUTTON',			'����');

// some status messages
define('_MSG_ACCOUNTCREATED',		'������� � ��������. �������� �� ���� ��������� ���� e-mail');
define('_MSG_PASSWORDSENT',			'�������� ���� ��������� � e-mail.');
define('_MSG_LOGINAGAIN',			'�� ������ �� �� ������� ������, ������ ������ ����������� �� �������');
define('_MSG_SETTINGSCHANGED',		'����� ���������');
define('_MSG_ADMINCHANGED',			'������������� ��������');
define('_MSG_NEWBLOG',				'��� Blog � ��������');
define('_MSG_ACTIONLOGCLEARED',		'Action Log ��������');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'����������� ��������: ');
define('_ACTIONLOG_PWDREMINDERSENT','���� ������ � ��������� �� ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'������� Action Log');
define('_ACTIONLOG_CLEAR_TEXT',		'������� action log ����');

// team management
define('_TEAM_TITLE',				'���������� ����� �� blog ');
define('_TEAM_CURRENT',				'������� �����');
define('_TEAM_ADDNEW',				'������ ��� ���� ��� �����');
define('_TEAM_CHOOSEMEMBER',		'������ ����');
define('_TEAM_ADMIN',				'���������������� ����������? ');
define('_TEAM_ADD',					'������ ��� �����');
define('_TEAM_ADD_BTN',				'������ ��� �����');

// blogsettings
define('_EBLOG_TITLE',				'���������� ������� �� Blog');
define('_EBLOG_TEAM_TITLE',			'���������� �����');
define('_EBLOG_TEAM_TEXT',			'������� ��� �� �� ���������� ������ �����...');
define('_EBLOG_SETTINGS_TITLE',		'����� �� Blog');
define('_EBLOG_NAME',				'��� �� Blog');
define('_EBLOG_SHORTNAME',			'������ ��� �� Blog');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(������ �� ������� ���� a-z � ��� ����������)');
define('_EBLOG_DESC',				'�������� �� Blog');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Default ����');
define('_EBLOG_DEFCAT',				'Default ���������');
define('_EBLOG_LINEBREAKS',			'Convert line breaks');
define('_EBLOG_DISABLECOMMENTS',	'������� ���������?<br /><small>(������������ ��������� ��������, �� ���������� �� ��������� �� � ���������.)</small>');
define('_EBLOG_ANONYMOUS',			'������� ��������� �� non-members?');
define('_EBLOG_NOTIFY',				'��������� �����(��) (use ; as separator)');
define('_EBLOG_NOTIFY_ON',			'Notify on');
define('_EBLOG_NOTIFY_COMMENT',		'���� ���������');
define('_EBLOG_NOTIFY_KARMA',		'���� karma ����������');
define('_EBLOG_NOTIFY_ITEM',		'���� weblog items');
define('_EBLOG_PING',				'Ping Weblogs.com �� ����������?');
define('_EBLOG_MAXCOMMENTS',		'���������� ���� �� �����������');
define('_EBLOG_UPDATE',				'������ ����');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'�������� ����� �� ������� �');
define('_EBLOG_BTIME',				'�������� ����� �� blog �');
define('_EBLOG_CHANGE',				'������� ���������');
define('_EBLOG_CHANGE_BTN',			'������� ���������');
define('_EBLOG_ADMIN',				'Blog Admin');
define('_EBLOG_ADMIN_MSG',			'�� �� ����� ������������ ���������������� ����������');
define('_EBLOG_CREATE_TITLE',		'������ ��� weblog');
define('_EBLOG_CREATE_TEXT',		'������� ������� ��-���� �� �� ������� ��� weblog. <br /><br /> <b>���������:</b> ���� ������� ����� �� ��������. ��� ������ �� ��������� ������ �����, ������ � ���������� �� blogsettings ���� ���� ��� ������� ����� ����.');
define('_EBLOG_CREATE',				'������!');
define('_EBLOG_CREATE_BTN',			'������ Weblog');
define('_EBLOG_CAT_TITLE',			'���������');
define('_EBLOG_CAT_NAME',			'��� �� �����������');
define('_EBLOG_CAT_DESC',			'�������� �� �����������');
define('_EBLOG_CAT_CREATE',			'������ ���� ���������');
define('_EBLOG_CAT_UPDATE',			'������ ���������');
define('_EBLOG_CAT_UPDATE_BTN',		'������ ���������');

// templates
define('_TEMPLATE_TITLE',			'���������� �������');
define('_TEMPLATE_AVAILABLE_TITLE',	'������� �������');
define('_TEMPLATE_NEW_TITLE',		'��� ������');
define('_TEMPLATE_NAME',			'��� �� �������');
define('_TEMPLATE_DESC',			'�������� �� �������');
define('_TEMPLATE_CREATE',			'������ ������');
define('_TEMPLATE_CREATE_BTN',		'������ ������');
define('_TEMPLATE_EDIT_TITLE',		'���������� ������');
define('_TEMPLATE_BACK',			'������� ��� Template Overview');
define('_TEMPLATE_EDIT_MSG',		'�� ������ ����� �� ������� �� �����, ������ ������ ���� ����� �� �� ��������.');
define('_TEMPLATE_SETTINGS',		'��������� �� �������');
define('_TEMPLATE_ITEMS',			'Items');
define('_TEMPLATE_ITEMHEADER',		'Item Header');
define('_TEMPLATE_ITEMBODY',		'Item Body');
define('_TEMPLATE_ITEMFOOTER',		'Item Footer');
define('_TEMPLATE_MORELINK',		'Link to extended entry');
define('_TEMPLATE_NEW',				'Indication of new item');
define('_TEMPLATE_COMMENTS_ANY',	'��������� (��� ���)');
define('_TEMPLATE_CHEADER',			'Comments Header');
define('_TEMPLATE_CBODY',			'Comments Body');
define('_TEMPLATE_CFOOTER',			'Comments Footer');
define('_TEMPLATE_CONE',			'���� ��������');
define('_TEMPLATE_CMANY',			'��� (��� ������) ���������');
define('_TEMPLATE_CMORE',			'������� ��� ���������');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'��������� (��� ����)');
define('_TEMPLATE_CNONE',			'���� ���������');
define('_TEMPLATE_COMMENTS_TOOMUCH','��������� (��� ���, �� �� ������ ����� �� �� ������� inline)');
define('_TEMPLATE_CTOOMUCH',		'������ ����� ���������');
define('_TEMPLATE_ARCHIVELIST',		'Archive Lists');
define('_TEMPLATE_AHEADER',			'Archive List Header');
define('_TEMPLATE_AITEM',			'Archive List Item');
define('_TEMPLATE_AFOOTER',			'Archive List Footer');
define('_TEMPLATE_DATETIME',		'���� and �����');
define('_TEMPLATE_DHEADER',			'Date Header');
define('_TEMPLATE_DFOOTER',			'Date Footer');
define('_TEMPLATE_DFORMAT',			'���� ������');
define('_TEMPLATE_TFORMAT',			'����� ������');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Image popups');
define('_TEMPLATE_PCODE',			'Popup Link Code');
define('_TEMPLATE_ICODE',			'Inline Image Code');
define('_TEMPLATE_MCODE',			'Media Object Link Code');
define('_TEMPLATE_SEARCH',			'�����');
define('_TEMPLATE_SHIGHLIGHT',		'Highlight');
define('_TEMPLATE_SNOTFOUND',		'��������� �� ���� ����������');
define('_TEMPLATE_UPDATE',			'������');
define('_TEMPLATE_UPDATE_BTN',		'������ ������');
define('_TEMPLATE_RESET_BTN',		'Reset Data');
define('_TEMPLATE_CATEGORYLIST',	'������ �� �����������');
define('_TEMPLATE_CATHEADER',		'Category List Header');
define('_TEMPLATE_CATITEM',			'Category List Item');
define('_TEMPLATE_CATFOOTER',		'Category List Footer');

// skins
define('_SKIN_EDIT_TITLE',			'���������� ����');
define('_SKIN_AVAILABLE_TITLE',		'������� ����');
define('_SKIN_NEW_TITLE',			'���� ����');
define('_SKIN_NAME',				'���');
define('_SKIN_DESC',				'��������');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'������');
define('_SKIN_CREATE_BTN',			'������ ����');
define('_SKIN_EDITONE_TITLE',		'���������� ����');
define('_SKIN_BACK',				'������� ��� Skin Overview');
define('_SKIN_PARTS_TITLE',			'����� �� ������');
define('_SKIN_PARTS_MSG',			'�� ������ ����� �� ���������� �� ����� ����. ������ ������ ����, �� ����� ����� �����. Choose the skin type to edit below:');
define('_SKIN_PART_MAIN',			'Main Index');
define('_SKIN_PART_ITEM',			'Item Pages');
define('_SKIN_PART_ALIST',			'������ �� ������');
define('_SKIN_PART_ARCHIVE',		'�����');
define('_SKIN_PART_SEARCH',			'������');
define('_SKIN_PART_ERROR',			'������');
define('_SKIN_PART_MEMBER',			'������� �� �����');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'��������� ���������');
define('_SKIN_CHANGE',				'�������');
define('_SKIN_CHANGE_BTN',			'������� ���� ���������');
define('_SKIN_UPDATE_BTN',			'������ ����');
define('_SKIN_RESET_BTN',			'Reset Data');
define('_SKIN_EDITPART_TITLE',		'���������� ����');
define('_SKIN_GOBACK',				'����� �� �����');
define('_SKIN_ALLOWEDVARS',			'��������� ���������� (������� �� ����):');

// global settings
define('_SETTINGS_TITLE',			'��������� ��������');
define('_SETTINGS_SUB_GENERAL',		'��������� ��������');
define('_SETTINGS_DEFBLOG',			'Default Blog');
define('_SETTINGS_ADMINMAIL',		'Email �� ��������������');
define('_SETTINGS_SITENAME',		'��� �� �����');
define('_SETTINGS_SITEURL',			'URL �� ����� (������ �� ������� ��� slash(��������� �����))');
define('_SETTINGS_ADMINURL',		'URL �� Admin Area (������ �� ������� ��� slash(��������� �����))');
define('_SETTINGS_DIRS',			'Nucleus ����������');
define('_SETTINGS_MEDIADIR',		'Media ����������');
define('_SETTINGS_SEECONFIGPHP',	'(��� config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (������ �� ������� ��� slash(��������� �����))');
define('_SETTINGS_ALLOWUPLOAD',		'������� ������� �� �������?');
define('_SETTINGS_ALLOWUPLOADTYPES','������� �������� ������� �� �������');
define('_SETTINGS_CHANGELOGIN',		'������� �� ��������� �� ������ ������������� ���/������');
define('_SETTINGS_COOKIES_TITLE',	'Cookie ���������');
define('_SETTINGS_COOKIELIFE',		'Login Cookie Lifetime');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'Lifetime of a Month');
define('_SETTINGS_COOKIEPATH',		'Cookie Path (advanced)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (advanced)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (advanced)');
define('_SETTINGS_LASTVISIT',		'������ Cookies �� ���������� ���������');
define('_SETTINGS_ALLOWCREATE',		'������� �� ������������ �� �������� ������� ������');
define('_SETTINGS_NEWLOGIN',		'Login �������� �� �������������-��������� �������');
define('_SETTINGS_NEWLOGIN2',		'(������ �� ���� �� ������������� �������)');
define('_SETTINGS_MEMBERMSGS',		'������� Member-2-Member ��������');
define('_SETTINGS_LANGUAGE',		'Default Language');
define('_SETTINGS_DISABLESITE',		'���� �����');
define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',			'�������� ���������');
define('_SETTINGS_UPDATE_BTN',		'�������� ���������');
define('_SETTINGS_DISABLEJS',		'������� JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Media/Upload ���������');
define('_SETTINGS_MEDIAPREFIX',		'Prefix �������� ������� � ����');
define('_SETTINGS_MEMBERS',			'��������� �� ���������');

// bans
define('_BAN_TITLE',				'Ban ������ ��');
define('_BAN_NONE',					'���� bans �� ���� weblog');
define('_BAN_NEW_TITLE',			'������ ��� Ban');
define('_BAN_NEW_TEXT',				'������ ��� ban �������');
define('_BAN_REMOVE_TITLE',			'�������� Ban');
define('_BAN_IPRANGE',				'IP Range');
define('_BAN_BLOGS',				'��� blogs?');
define('_BAN_DELETE_TITLE',			'������ Ban');
define('_BAN_ALLBLOGS',				'������ �������, �� ����� ���� ���������������� ����������.');
define('_BAN_REMOVED_TITLE',		'Ban ���������');
define('_BAN_REMOVED_TEXT',			'Ban ���� ��������� �� �������� �������:');
define('_BAN_ADD_TITLE',			'������ Ban');
define('_BAN_IPRANGE_TEXT',			'������ IP range ����� ����� �� ��������. ������� ��-����� �����, ������ ������ �� ����� ���������.');
define('_BAN_BLOGS_TEXT',			'������ �� �������� �� ban IP �� ���� ���� ����, ��� ���� �� �������� �� ��������� IP �� ������ blogs ������ ����� ���������������� ����������. Make your choice below.');
define('_BAN_REASON_TITLE',			'�������');
define('_BAN_REASON_TEXT',			'���� �� ������������ ������� �� ���, ����� �� �� ������� ������ ����������� �� ���� IP �� ����� �� ������ �������� ��� �� ����� �� ������� � karma. ������������ ������� � 256 �������.');
define('_BAN_ADD_BTN',				'������ Ban');

// LOGIN screen
define('_LOGIN_MESSAGE',			'���������');
define('_LOGIN_NAME',				'���');
define('_LOGIN_PASSWORD',			'������');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'��������� ������?');

// membermanagement
define('_MEMBERS_TITLE',			'���������� �� �����');
define('_MEMBERS_CURRENT',			'������ ������� ');
define('_MEMBERS_NEW',				'��� ����');
define('_MEMBERS_DISPLAY',			'������ ���');
define('_MEMBERS_DISPLAY_INFO',		'(���� � �����, ����� ���������� �� login)');
define('_MEMBERS_REALNAME',			'�������� ���');
define('_MEMBERS_PWD',				'������');
define('_MEMBERS_REPPWD',			'������� ������');
define('_MEMBERS_EMAIL',			'Email �����');
define('_MEMBERS_EMAIL_EDIT',		'(������ �������� �-���� �����, ���� ������ �� ���� ����������� ��������� �� ���� �����)');
define('_MEMBERS_URL',				'Website ����� (URL)');
define('_MEMBERS_SUPERADMIN',		'���������������� ����������');
define('_MEMBERS_CANLOGIN',			'���� �� �� login �� ������������������ ����');
define('_MEMBERS_NOTES',			'�������');
define('_MEMBERS_NEW_BTN',			'������ ����');
define('_MEMBERS_EDIT',				'���������� ����');
define('_MEMBERS_EDIT_BTN',			'������� ���������');
define('_MEMBERS_BACKTOOVERVIEW',	'������� ��� Member Overview');
define('_MEMBERS_DEFLANG',			'����');
define('_MEMBERS_USESITELANG',		'- ��������� ����������� �� ����� -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'������ ����');
define('_BLOGLIST_ADD',				'������ Item');
define('_BLOGLIST_TT_ADD',			'������ ��� item �� ���� weblog');
define('_BLOGLIST_EDIT',			'����������/������ Items');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'���������');
define('_BLOGLIST_TT_SETTINGS',		'���������� ��������� ��� ���������� �����');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'���, ���� ��� �������� banned IP-��');
define('_BLOGLIST_DELETE',			'������ ������');
define('_BLOGLIST_TT_DELETE',		'������ ����  weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'������ weblogs');
define('_OVERVIEW_YRDRAFTS',		'������ drafts');
define('_OVERVIEW_YRSETTINGS',		'������ ���������');
define('_OVERVIEW_GSETTINGS',		'��������� ���������');
define('_OVERVIEW_NOBLOGS',			'��� �� ��� � ��������� ������� ����� weblogs');
define('_OVERVIEW_NODRAFTS',		'���� drafts');
define('_OVERVIEW_EDITSETTINGS',	'���������� ������ ���������...');
define('_OVERVIEW_BROWSEITEMS',		'��������� ������ items...');
define('_OVERVIEW_BROWSECOMM',		'��������� ������ ���������...');
define('_OVERVIEW_VIEWLOG',			'��� Action Log...');
define('_OVERVIEW_MEMBERS',			'���������� ���������...');
define('_OVERVIEW_NEWLOG',			'������ ��� Weblog...');
define('_OVERVIEW_SETTINGS',		'���������� ���������...');
define('_OVERVIEW_TEMPLATES',		'���������� �������...');
define('_OVERVIEW_SKINS',			'���������� ����...');
define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Items �� blog'); 
define('_ITEMLIST_YOUR',			'������ items');

// Comments
define('_COMMENTS',					'Comments');
define('_NOCOMMENTS',				'No comments for this item');
define('_COMMENTS_YOUR',			'Your Comments');
define('_NOCOMMENTS_YOUR',			'You didn\'t write any comments');

// LISTS (general)
define('_LISTS_NOMORE',				'No more results, or no results at all');
define('_LISTS_PREV',				'Previous');
define('_LISTS_NEXT',				'Next');
define('_LISTS_SEARCH',				'Search');
define('_LISTS_CHANGE',				'Change');
define('_LISTS_PERPAGE',			'items/page');
define('_LISTS_ACTIONS',			'Actions');
define('_LISTS_DELETE',				'Delete');
define('_LISTS_EDIT',				'Edit');
define('_LISTS_MOVE',				'Move');
define('_LISTS_CLONE',				'Clone');
define('_LISTS_TITLE',				'Title');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Name');
define('_LISTS_DESC',				'Description');
define('_LISTS_TIME',				'Time');
define('_LISTS_COMMENTS',			'���������');
define('_LISTS_TYPE',				'Type');


// member list 
define('_LIST_MEMBER_NAME',			'������ ���');
define('_LIST_MEMBER_RNAME',		'�������� ���');
define('_LIST_MEMBER_ADMIN',		'�����-�����? ');
define('_LIST_MEMBER_LOGIN',		'���� �� �� login? ');
define('_LIST_MEMBER_URL',			'Website');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Range');
define('_LIST_BAN_REASON',			'�������');

// actionlist
define('_LIST_ACTION_MSG',			'���������');

// commentlist
define('_LIST_COMMENT_BANIP',		'Ban IP');
define('_LIST_COMMENT_WHO',			'�����');
define('_LIST_COMMENT',				'��������');
define('_LIST_COMMENT_HOST',		'����');

// itemlist
define('_LIST_ITEM_INFO',			'����');
define('_LIST_ITEM_CONTENT',		'�������� � �����');


// teamlist
define('_LIST_TEAM_ADMIN',			'����� ');
define('_LIST_TEAM_CHADMIN',		'����� �����');

// edit comments
define('_EDITC_TITLE',				'���������� ���������');
define('_EDITC_WHO',				'�����');
define('_EDITC_HOST',				'�� ����?');
define('_EDITC_WHEN',				'����?');
define('_EDITC_TEXT',				'�����');
define('_EDITC_EDIT',				'���������� ��������');
define('_EDITC_MEMBER',				'����');
define('_EDITC_NONMEMBER',			'non member');

// move item
define('_MOVE_TITLE',				'�������� ��� ��� blog?');
define('_MOVE_BTN',					'�������� Item');

?>