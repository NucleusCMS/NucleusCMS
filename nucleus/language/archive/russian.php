<?php
// Russian Nucleus Language File
//
// Author: Andrey Serebryakov - saahov@gmail.com
// Nucleus version: v1.0-v3.2
// Update: 19.10.2005
// ������� �� ����������, ��������� � ������������ Nucleus �����
// ������ �� ������ ���������� ������� �������������: http://nucleus.net.ru .


// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','������� \'�������� ������\'-button to update the plugin\'s subscription list.');
define('_LIST_PLUGS_DEP',			'������� ���������:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'��� ����������� � �������');
define('_NOCOMMENTS_BLOG',			'� ���� ������� ��� ������������');
define('_BLOGLIST_COMMENTS',		'�����������');
define('_BLOGLIST_TT_COMMENTS',		'������ ���� ������������, ��������� � ���������� ����� �������');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'����');
define('_ARCHIVETYPE_MONTH',		'�����');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'������������ ��� ������������ �������� ������.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'������ ��� ��������� �������, ��������� ');
define('_ERROR_DELREQPLUGIN',		'�� ������� ��������� �������� �������, ��������� ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'������� Cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'������ ��������� �� ��������. ��� ��������� ������� �� ����.');
define('_ERROR_ACTIVATE',			'���� ��������� �� ����������, ������������ ��� ������������ ��������.');
define('_ACTIONLOG_ACTIVATIONLINK', '������ ��������� ���� ��������');
define('_MSG_ACTIVATION_SENT',		'������ ��� ��������� ���� �������� �� e-mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"������������, <%memberName%>,\n\n��� ���������� ������������ ���� ������� �� <%siteName%> (<%siteUrl%>).\n��� ����� �������� �� ������: \n\n\t<%activationUrl%>\n\n� ��� ���� 2 ���, �� ��������� ����� ����� ������ ���������� ����������������.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"��������� �������� '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'����� ���������� <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'�� ����� ������ ��������� �����������. ����������, ������� ������ ��� ����� ������� ������.');
define('_ACTIVATE_FORGOT_MAIL',		"������������, <%memberName%>,\n\n������� �� ��������� ������, �� ������ ������� ����� ������ ��� ������ �������� �� <%siteName%> (<%siteUrl%>)\n\n\t<%activationUrl%>\n\n� ��� ���� 2 ���, �� ��������� ����� ����� ������ ���������� ����������������.");
define('_ACTIVATE_FORGOT_MAILTITLE',"������������� �������� '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'����� ���������� <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'�� ������ ������ ����� ������ ��� ������ ��������:');
define('_ACTIVATE_CHANGE_MAIL',		"������������, <%memberName%>,\n\n����� ��������� ������ e-mail ��������� ������������� �������� �� <%siteName%> (<%siteUrl%>).\n�� ������ ������� ��� ������� �� ��������� ������: \n\n\t<%activationUrl%>\n\n� ��� ���� 2 ���, �� ��������� ����� ����� ������ ���������� ����������������.");
define('_ACTIVATE_CHANGE_MAILTITLE',"������������� �������� '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'����� ���������� <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'��� ��������� ����� ��� ��������. �������!');
define('_ACTIVATE_SUCCESS_TITLE',	'��������� ������ �������');
define('_ACTIVATE_SUCCESS_TEXT',	'��� ������� ��� ������� �����������.');
define('_MEMBERS_SETPWD',			'������� ������');
define('_MEMBERS_SETPWD_BTN',		'������� ������');
define('_QMENU_ACTIVATE',			'��������� ��������');
define('_QMENU_ACTIVATE_TEXT',		'<p>����� ��������� ��������, �� ������� ������������ ���� ����� � ������ ��� <a href="index.php?action=showlogin"><strong>�����</strong></a>.</p>');

define('_PLUGS_BTN_UPDATE',			'�������� ������');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript ������');
define('_SETTINGS_JSTOOLBAR_FULL',	'������ ������ (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','����-������ (�� IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'��������� ������');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">��� �������� fancy URLs (���)</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'�������������� ����� ��������');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'������:');
define('_LIST_ITEM_CAT',			'���������:');
define('_LIST_ITEM_AUTHOR',			'�����:');
define('_LIST_ITEM_DATE',			'����:');
define('_LIST_ITEM_TIME',			'�����:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(������������)');

// batch operations
define('_BATCH_WITH_SEL',			'� ����������:');
define('_BATCH_EXEC',				'�������');

// quickmenu
define('_QMENU_HOME',				'������');
define('_QMENU_ADD',				'�������� ��������� �:');
define('_QMENU_ADD_SELECT',			'-- ������� --');
define('_QMENU_USER_SETTINGS',		'�������');
define('_QMENU_USER_ITEMS',			'���� ���������');
define('_QMENU_USER_COMMENTS',		'���� �����������');
define('_QMENU_MANAGE',				'����������');
define('_QMENU_MANAGE_LOG',			'��� ��������');
define('_QMENU_MANAGE_SETTINGS',	'������������');
define('_QMENU_MANAGE_MEMBERS',		'������������');
define('_QMENU_MANAGE_NEWBLOG',		'������� ������');
define('_QMENU_MANAGE_BACKUPS',		'�����');
define('_QMENU_MANAGE_PLUGINS',		'�������');
define('_QMENU_LAYOUT',				'������');
define('_QMENU_LAYOUT_SKINS',		'�����');
define('_QMENU_LAYOUT_TEMPL',		'�������');
define('_QMENU_LAYOUT_IEXPORT',		'������/�������');
define('_QMENU_PLUGINS',			'�������');

// quickmenu on logon screen
define('_QMENU_INTRO',				'���������� ��������������');
define('_QMENU_INTRO_TEXT',			'<p>��� ����������� ������ � ������ ���������� �����������.</p><p>����� ����������� �� ������� ��������� ����� ���������.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'������������ �� �������');
define('_PLUGS_HELP_TITLE',			'������������ � �������');
define('_LIST_PLUGS_HELP', 			'������');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'�������� ������� ��������������');
define('_WARNING_EXTAUTH',			'��������: �������� ������ ��� �������������.');

// member profile
define('_MEMBERS_BYPASS',			'�������� ������� ��������������');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>������</em> �������� � �����');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'��������');
define('_MEDIA_VIEW_TT',			'�������� ���� (��������� � ����� ����)');
define('_MEDIA_FILTER_APPLY',		'��������� ������');
define('_MEDIA_FILTER_LABEL',		'������: ');
define('_MEDIA_UPLOAD_TO',			'�������� � ...');
define('_MEDIA_UPLOAD_NEW',			'�������� ����� ����...');
define('_MEDIA_COLLECTION_SELECT',	'�������');
define('_MEDIA_COLLECTION_TT',		'����������� �� ��� ���������');
define('_MEDIA_COLLECTION_LABEL',	'������� ���������: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'��������� �����');
define('_ADD_ALIGNRIGHT_TT',		'��������� ������');
define('_ADD_ALIGNCENTER_TT',		'��������� ��-������');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'������ �������');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'��������� ���������� ��������� � �������');
define('_ADD_CHANGEDATE',			'�������� �����');
define('_BMLET_CHANGEDATE',			'�������� �����');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'������/������� ������...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'�������');
define('_PARSER_INCMODE_SKINDIR',	'����� �����');
define('_SKIN_INCLUDE_MODE',		'Include mode');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'���� ��-���������');
define('_SETTINGS_SKINSURL',		'URL ������');
define('_SETTINGS_ACTIONSURL',		'������ URL � action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'������ ���������� �������� �� ��������� ���������');
define('_ERROR_MOVETOSELF',			'������ ���������� ��������� � ��� �� ������');
define('_MOVECAT_TITLE',			'�������� ������, � ������� ������ ����������� ���������');
define('_MOVECAT_BTN',				'����������� ���������');

// URLMode setting
define('_SETTINGS_URLMODE',			'��� URL');
define('_SETTINGS_URLMODE_NORMAL',	'�������');
define('_SETTINGS_URLMODE_PATHINFO','���');

// Batch operations
define('_BATCH_NOSELECTION',		'������ �� ������� ��� ���������� ��������');
define('_BATCH_ITEMS',				'�������� ��������� ���������');
define('_BATCH_CATEGORIES',			'�������� �������� � �����������');
define('_BATCH_MEMBERS',			'�������� �������� � ��������������');
define('_BATCH_TEAM',				'�������� �������� � ����������� ������� �������');
define('_BATCH_COMMENTS',			'�������� �������� � �������������');
define('_BATCH_UNKNOWN',			'����������� �������� ��������: ');
define('_BATCH_EXECUTING',			'����������');
define('_BATCH_ONCATEGORY',			'� �����������');
define('_BATCH_ONITEM',				'� �����������');
define('_BATCH_ONCOMMENT',			'� �������������');
define('_BATCH_ONMEMBER',			'� ��������������');
define('_BATCH_ONTEAM',				'� ���������� ������� �������');
define('_BATCH_SUCCESS',			'�������!');
define('_BATCH_DONE',				'���������!');
define('_BATCH_DELETE_CONFIRM',		'���������� �������� ��������');
define('_BATCH_DELETE_CONFIRM_BTN',	'���������� �������� ��������');
define('_BATCH_SELECTALL',			'�������� ���');
define('_BATCH_DESELECTALL',		'����� ���������');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'�������');
define('_BATCH_ITEM_MOVE',			'�����������');
define('_BATCH_MEMBER_DELETE',		'�������');
define('_BATCH_MEMBER_SET_ADM',		'��������� ����� ��������������');
define('_BATCH_MEMBER_UNSET_ADM',	'����� ����� ��������������');
define('_BATCH_TEAM_DELETE',		'������� �� ������� �������');
define('_BATCH_TEAM_SET_ADM',		'��������� ����� ��������������');
define('_BATCH_TEAM_UNSET_ADM',		'����� ����� ��������������');
define('_BATCH_CAT_DELETE',			'�������');
define('_BATCH_CAT_MOVE',			'����������� � ������ ������');
define('_BATCH_COMMENT_DELETE',		'�������');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'�������� ����� ��������� ...');
define('_ADD_PLUGIN_EXTRAS',		'�������������� ����� ��������');

// errors
define('_ERROR_CATCREATEFAIL',		'�� ������� ������� ����� ���������');
define('_ERROR_NUCLEUSVERSIONREQ',	'���� ������ ������������ ��� ����� ������� ������ Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'��������� � ���������� �������');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'������');
define('_SKINIE_TITLE_EXPORT',		'�������');
define('_SKINIE_BTN_IMPORT',		'������');
define('_SKINIE_BTN_EXPORT',		'�������������� ��������� �����/�������');
define('_SKINIE_LOCAL',				'������������� � ����� �� �������:');
define('_SKINIE_NOCANDIDATES',		'������ �� ������� ��� ������� � ����� �����');
define('_SKINIE_FROMURL',			'������������� �� URL:');
define('_SKINIE_EXPORT_INTRO',		'�������� ����� � �������, ������� �� ������ ��������������');
define('_SKINIE_EXPORT_SKINS',		'�����');
define('_SKINIE_EXPORT_TEMPLATES',	'�������');
define('_SKINIE_EXPORT_EXTRA',		'�������������� ����������');
define('_SKINIE_CONFIRM_OVERWRITE',	'������������ ��� ������������ ����� (�������� ����������� ��������)');
define('_SKINIE_CONFIRM_IMPORT',	'��, � ���� ������������� ���');
define('_SKINIE_CONFIRM_TITLE',		'�� ������������� ������ � ��������');
define('_SKINIE_INFO_SKINS',		'����� � �����:');
define('_SKINIE_INFO_TEMPLATES',	'������� � �����:');
define('_SKINIE_INFO_GENERAL',		'����������:');
define('_SKINIE_INFO_SKINCLASH',	'����������� �������� ������:');
define('_SKINIE_INFO_TEMPLCLASH',	'����������� �������� ��������:');
define('_SKINIE_INFO_IMPORTEDSKINS','��������������� �����:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','�������������� �������:');
define('_SKINIE_DONE',				'������ ���������');

define('_AND',						'�');
define('_OR',						'���');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'������ ���� (������� ��� ��������������)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'������������ �����:');

// backup
define('_BACKUPS_TITLE',			'��������� ����������� ���� ������ / ��������������');
define('_BACKUP_TITLE',				'��������� �����������');
define('_BACKUP_INTRO',				'������� ������ ����, ����� ������� ��������� ����������� ���� ������. ��������� ���� � ���������� �����.');
define('_BACKUP_ZIP_YES',			'����������� ������������ ������');
define('_BACKUP_ZIP_NO',			'�� ������������ ������');
define('_BACKUP_BTN',				'������� �����');
define('_BACKUP_NOTE',				'<b>����������:</b> � ��������� ����� �������� ������ ���������� ���� ������. ����� �� ����� MEDIA � ��������� �� ����� config.php <b>��</b> �������� � ��������� �����.');
define('_RESTORE_TITLE',			'��������������');
define('_RESTORE_NOTE',				'<b>��������������:</b> �������������� �� ��������� ����� <b>���Ш�</b> ��� ������� ������ Nucleus � ���� ������! �� ������ ���� ������� � ������������ ����� ��������!	<br />	<b>����������:</b> ��������������, ��� ������������ ������ ������ Nucleus �� �� �����, ����� ���� ��� ��������� �����������. ����� ����� ���������� ������ � ������ �����.');
define('_RESTORE_INTRO',			'�������� ���� � ��������� ������ (�� ����� �������� �� ������) � ������� ������ "������������ �� �����", ����� ��������� ������� �������������.');
define('_RESTORE_IMSURE',			'��, � ������, ��� ���� ������� ���!');
define('_RESTORE_BTN',				'������������ �� �����');
define('_RESTORE_WARNING',			'(���������, ��� ���� ��������� ����� �� ��������. �������� ������� ������� ����� ��������� �����.)');
define('_ERROR_BACKUP_NOTSURE',		'�� �� �������� ���� "��, � ������, ��� ���� ������� ���"');
define('_RESTORE_COMPLETE',			'�������������� ���������');

// new item notification
define('_NOTIFY_NI_MSG',			'����� ��������� ���� ���������:');
define('_NOTIFY_NI_TITLE',			'����� ���������!');
define('_NOTIFY_KV_MSG',			'Karma-����� � ���������:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'����������� � ���������:');
define('_NOTIFY_NC_TITLE',			'����������� Nucleus:');
define('_NOTIFY_USERID',			'ID ������������:');
define('_NOTIFY_USER',				'������������:');
define('_NOTIFY_COMMENT',			'�����������:');
define('_NOTIFY_VOTE',				'�����:');
define('_NOTIFY_HOST',				'����:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'������������:');
define('_NOTIFY_TITLE',				'���������:');
define('_NOTIFY_CONTENTS',			'����������:');

// member mail message
define('_MMAIL_MSG',				'��� ������� ������ ��:');
define('_MMAIL_FROMANON',			'�����');
define('_MMAIL_FROMNUC',			'������������');
define('_MMAIL_TITLE',				'��������� ��:');
define('_MMAIL_MAIL',				'���������:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'�������� ���������');
define('_BMLET_EDIT',				'������������� ���������');
define('_BMLET_DELETE',				'������� ���������');
define('_BMLET_BODY',				'������');
define('_BMLET_MORE',				'�������� �����');
define('_BMLET_OPTIONS',			'�����');
define('_BMLET_PREVIEW',			'��������');

// used in bookmarklet
define('_ITEM_UPDATED',				'��������� ��������');
define('_ITEM_DELETED',				'��������� �������');

// plugins
define('_CONFIRMTXT_PLUGIN',		'�� ������������� ������ ������� ������');
define('_ERROR_NOSUCHPLUGIN',		'��� ������ �������');
define('_ERROR_DUPPLUGIN',			'����, �� ���� ������ ��� ����������');
define('_ERROR_PLUGFILEERROR',		'������ ������� �� ���������� ��� CHMOD ���������� �������');
define('_PLUGS_NOCANDIDATES',		'��� �������� ��� ���������');

define('_PLUGS_TITLE_MANAGE',		'���������� ���������');
define('_PLUGS_TITLE_INSTALLED',	'������������� �������');
define('_PLUGS_TITLE_UPDATE',		'�������� ������');
define('_PLUGS_TEXT_UPDATE',		'� Nucleus ����������� ������������ ������ ��������. ���� �� �������� ��� ������� �����-�� ������, �������� ������.');
define('_PLUGS_TITLE_NEW',			'���������� ����� ������');
define('_PLUGS_ADD_TEXT',			'���� ������� ������ ���� ������, ����������� � ����� plugins, ������� ����� ���� �����������. �������������� ����� ����������, ��� ��������� ���� ���� ������������� �������� ��������.');
define('_PLUGS_BTN_INSTALL',		'���������� ������');
define('_BACKTOOVERVIEW',			'��������� � ���������� ���������');

// editlink
define('_TEMPLATE_EDITLINK',		'������ �� �������������� �����');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'�������� ����� �������');
define('_ADD_RIGHT_TT',				'�������� ������ �������');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'����� ���������...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL �������');
define('_SETTINGS_MAXUPLOADSIZE',	'������������ ������ ������������ ������ (� ������)');
define('_SETTINGS_NONMEMBERMSGS',	'��������� ������ �������� ���������');
define('_SETTINGS_PROTECTMEMNAMES',	'�������� ����� �������������');

// overview screen
define('_OVERVIEW_PLUGINS',			'���������� ���������...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'����� ������������ ���������������:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'��� e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'�� �� ������ ���� ��� ������� ������. � ��������� ����������� � ��������������');

// plugin list
define('_LISTS_INFO',				'����������');
define('_LIST_PLUGS_AUTHOR',		'�����:');
define('_LIST_PLUGS_VER',			'������:');
define('_LIST_PLUGS_SITE',			'����');
define('_LIST_PLUGS_DESC',			'��������:');
define('_LIST_PLUGS_SUBS',			'������� ��:');
define('_LIST_PLUGS_UP',			'�����');
define('_LIST_PLUGS_DOWN',			'����');
define('_LIST_PLUGS_UNINSTALL',		'�������');
define('_LIST_PLUGS_ADMIN',			'����������');
define('_LIST_PLUGS_OPTIONS',		'���������');

// plugin option list
define('_LISTS_VALUE',				'��������');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'��� �������� ��� �������');
define('_PLUGS_BACK',				'��������� � ������ ��������');
define('_PLUGS_SAVE',				'��������� ���������');
define('_PLUGS_OPTIONS_UPDATED',	'��������� ������� ���������');

define('_OVERVIEW_MANAGEMENT',		'���������� ������');
define('_OVERVIEW_MANAGE',			'��� ���������...');
define('_MANAGE_GENERAL',			'�������� ���������');
define('_MANAGE_SKINS',				'����� � �������');
define('_MANAGE_EXTRA',				'�������������� ���������');

define('_BACKTOMANAGE',				'��������� � ���������� ������');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',					'windows-1251');

// global stuff
define('_LOGOUT',					'�����');
define('_LOGIN',					'����');
define('_YES',						'��');
define('_NO',						'���');
define('_SUBMIT',					'���������');
define('_ERROR',					'������');
define('_ERRORMSG',					'��������� ������!');
define('_BACK',						'���������');
define('_NOTLOGGEDIN',				'�� ������������');
define('_LOGGEDINAS',				'����� ���');
define('_ADMINHOME',				'������');
define('_NAME',						'���');
define('_BACKHOME',					'��������� �� ������� �������� ���������� ������');
define('_BADACTION',				'������������� �������������� ��������');
define('_MESSAGE',					'���������');
define('_HELP_TT',					'������!');
define('_YOURSITE',					'�� ����');


define('_POPUP_CLOSE',				'������� ����');

define('_LOGIN_PLEASE',				'���������� ������� ��������������');

// commentform
define('_COMMENTFORM_YOUARE',		'��');
define('_COMMENTFORM_SUBMIT',		'��������������!');
define('_COMMENTFORM_COMMENT',		'��� �����������');
define('_COMMENTFORM_NAME',			'���');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'��������� ����');

// loginform
define('_LOGINFORM_NAME',			'�����');
define('_LOGINFORM_PWD',			'������');
define('_LOGINFORM_YOUARE',			'�� ����� ���');
define('_LOGINFORM_SHARED',			'����� ���������');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'���������');

// search form
define('_SEARCHFORM_SUBMIT',		'�����!');

// add item form
define('_ADD_ADDTO',				'�������� ��������� �');
define('_ADD_CREATENEW',			'������� ����� ���������');
define('_ADD_BODY',					'����� (������)');
define('_ADD_TITLE',				'���������');
define('_ADD_MORE',					'�������� �����');
define('_ADD_CATEGORY',				'���������');
define('_ADD_PREVIEW',				'������������');
define('_ADD_DISABLE_COMMENTS',		'��������� �����������?');
define('_ADD_DRAFTNFUTURE',			'��������� &amp; ������� ���������');
define('_ADD_ADDITEM',				'�������� ���������');
define('_ADD_ADDNOW',				'�������� ������');
define('_ADD_ADDLATER',				'�������� �����');
define('_ADD_PLACE_ON',				'�������� ����');
define('_ADD_ADDDRAFT',				'�������� � ���������');
define('_ADD_NOPASTDATES',			'(���� � ����� � ������� ���������������, ����� ������������ ������� �����)');
define('_ADD_BOLD_TT',				'������');
define('_ADD_ITALIC_TT',			'������');
define('_ADD_HREF_TT',				'������');
define('_ADD_MEDIA_TT',				'�������� media');
define('_ADD_PREVIEW_TT',			'��������/�������� ������������');
define('_ADD_CUT_TT',				'��������');
define('_ADD_COPY_TT',				'����������');
define('_ADD_PASTE_TT',				'��������');


// edit item form
define('_EDIT_ITEM',				'������������� ���������');
define('_EDIT_SUBMIT',				'��������� ���������');
define('_EDIT_ORIG_AUTHOR',			'�������������� �����');
define('_EDIT_BACKTODRAFTS',		'�������� � ���������');
define('_EDIT_COMMENTSNOTE',		'(����������: ���������� ������������ �� ����� ����������� ����� �����������)');

// used on delete screens
define('_DELETE_CONFIRM',			'������������� ��������');
define('_DELETE_CONFIRM_BTN',		'�������!');
define('_CONFIRMTXT_ITEM',			'�� ����������� ������� ��������� ���������:');
define('_CONFIRMTXT_COMMENT',		'�� ����������� ������� ��������� �����������:');
define('_CONFIRMTXT_TEAM1',			'�� ����������� ������� ');
define('_CONFIRMTXT_TEAM2',			' �� ������� ������� ������� ');
define('_CONFIRMTXT_BLOG',			'������, ������� �� ����������� �������: ');
define('_WARNINGTXT_BLOGDEL',		'��������! ������ ������, �� ������� ������ � ��� ��� ��������� � �����������, ����������� � ��.<br />���������, ��� ����� �������� ����������.');
define('_CONFIRMTXT_MEMBER',		'�� ����������� ������� ���������� ������������: ');
define('_CONFIRMTXT_TEMPLATE',		'�� ����������� ������� ������ ');
define('_CONFIRMTXT_SKIN',			'�� ����������� ������� ���� ');
define('_CONFIRMTXT_BAN',			'�� ����������� ����� ��� ��� ���������� ��������� IP');
define('_CONFIRMTXT_CATEGORY',		'�� ����������� ������� ��������� ');

// some status messages
define('_DELETED_ITEM',				'��������� �������');
define('_DELETED_MEMBER',			'������������ �����');
define('_DELETED_COMMENT',			'����������� �����');
define('_DELETED_BLOG',				'������ �����');
define('_DELETED_CATEGORY',			'��������� �������');
define('_ITEM_MOVED',				'��������� ����������');
define('_ITEM_ADDED',				'��������� ���������');
define('_COMMENT_UPDATED',			'����������� �������');
define('_SKIN_UPDATED',				'���� ��� ������');
define('_TEMPLATE_UPDATED',			'������ ��� ������');

// errors
define('_ERROR_COMMENT_LONGWORD',	'����������, �� ����������� ����� ������� ����� 90 ������ � ����� ������������');
define('_ERROR_COMMENT_NOCOMMENT',	'������� �����������');
define('_ERROR_COMMENT_NOUSERNAME',	'������� ������ ���');
define('_ERROR_COMMENT_TOOLONG',	'��� ����������� ������� ������� (����. 5000 ������)');
define('_ERROR_COMMENTS_DISABLED',	'����������� ��� ����� ������� ���������.');
define('_ERROR_COMMENTS_NONPUBLIC',	'�� ������ ���� ������������������ �������������, ����� ��������� ����������� � ���� �������');
define('_ERROR_COMMENTS_MEMBERNICK','���, ������� �� ������ ������������, ��� ������ ������ �������������. ���������� ����� ������.');
define('_ERROR_SKIN',				'������ �����');
define('_ERROR_ITEMCLOSED',			'��� ��������� ������� ��� ���������� ������������.');
define('_ERROR_NOSUCHITEM',			'��� ������ ���������');
define('_ERROR_NOSUCHBLOG',			'��� ������ �������');
define('_ERROR_NOSUCHSKIN',			'��� ������ �����');
define('_ERROR_NOSUCHMEMBER',		'��� ������ ������������');
define('_ERROR_NOTONTEAM',			'�� �� ������� � ������� ������� ����� �������.');
define('_ERROR_BADDESTBLOG',		'������������� ������ �� ����������');
define('_ERROR_NOTONDESTTEAM',		'������ ���������� ���������, ���� �� �� �������� � ������� �������');
define('_ERROR_NOEMPTYITEMS',		'������ ��������� ������ ���������!');
define('_ERROR_BADMAILADDRESS',		'������������ ����� e-mail');
define('_ERROR_BADNOTIFY',			'���� ��� ��������� email ������� �����������');
define('_ERROR_BADNAME',			'�� ���������� ��� (������ ������� a-z � 0-9, ��� ��������)');
define('_ERROR_NICKNAMEINUSE',		'����� ��� ��� ������������ ������ �������������');
define('_ERROR_PASSWORDMISMATCH',	'������ ������ ���������������');
define('_ERROR_PASSWORDTOOSHORT',	'������ ������ ���� �� ����� 6 ��������');
define('_ERROR_PASSWORDMISSING',	'������ �� ���� ���� ������');
define('_ERROR_REALNAMEMISSING',	'�� �� ����� ��������� ���');
define('_ERROR_ATLEASTONEADMIN',	'������ ������ ���� ���� �� ���� �����-�������������, ������� ������ ������� � �������');
define('_ERROR_ATLEASTONEBLOGADMIN','���������� ����� �������� ������� �� ������ �������������. ������ ���� ���� �� ���� �������������.');
define('_ERROR_ALREADYONTEAM',		'�� �� ������ �������� ������������, ������� ��� ��������� � ������� �������.');
define('_ERROR_BADSHORTBLOGNAME',	'�������� �������� ������� ����� �������� �� �������� a-z, 0-9, ��� ��������');
define('_ERROR_DUPSHORTBLOGNAME',	'�������� �������� ������� ��������� � ������ ��������. �������� �������� ������� ������ ���� ����������. ');
define('_ERROR_UPDATEFILE',			'���������� �������� ������ � ����� ����������. ��������� ��� CHMOD ���������� ��������� (���������� ��������� 666). ����� �������� �������� �� ������������ ����� ������������ admin-area �����, �������� ����� ������������ ���������� ���� (�������� /vash/put/k/nucleus/)');
define('_ERROR_DELDEFBLOG',			'������ ������� ������ �� ���������');
define('_ERROR_DELETEMEMBER',		'���� ������������ �� ����� ���� �����, �������� ������, ��� �� ����� ��������� ��� ������������');
define('_ERROR_BADTEMPLATENAME',	'������������ ��� �������, ����������� ������� a-z, 0-9, ��� ��������');
define('_ERROR_DUPTEMPLATENAME',	'������ � ����� ������ ��� ����������');
define('_ERROR_BADSKINNAME',		'������������ ��� �����, ����������� ������� a-z, 0-9, ��� ��������');
define('_ERROR_DUPSKINNAME',		'���� � ����� ������ ��� ����������');
define('_ERROR_DEFAULTSKIN',		'������ ������ ���� ������������ ���� � ��������� "default"');
define('_ERROR_SKINDEFDELETE',		'���������� ������� ����, �.�. �� ������������ �� ��������� � ��������� �������: ');
define('_ERROR_DISALLOWED',			'����, �� �� �� ������ ��������� ��� ��������');
define('_ERROR_DELETEBAN',			'������ ��� �������� ���� (���� �� ����������)');
define('_ERROR_ADDBAN',				'������ ��� ���������� ����. ��������, ��� ��������� �� ��������� �� ���� ��������.');
define('_ERROR_BADACTION',			'������������� �������� �� ����������');
define('_ERROR_MEMBERMAILDISABLED',	'��������� ����� �������������� ���������');
define('_ERROR_MEMBERCREATEDISABLED','�������� ��������� ���������');
define('_ERROR_INCORRECTEMAIL',		'������������ e-mail �����');
define('_ERROR_VOTEDBEFORE',		'�� ��� ������������� �� ��� ���������');
define('_ERROR_BANNED1',			'��� �������� ��������� ���� ��� (ip ');
define('_ERROR_BANNED2',			') �������.<br> �������: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'�� ������ ��������������, ����� ��������� ��� ��������');
define('_ERROR_CONNECT',			'������ �����������');
define('_ERROR_FILE_TOO_BIG',		'���� ������� �������!');
define('_ERROR_BADFILETYPE',		'����, ��� ���������� ���������');
define('_ERROR_BADREQUEST',			'�������� ������ �������');
define('_ERROR_DISALLOWEDUPLOAD',	'�� �� ������� �� � ���� ������� �������, �������������, ��� ��������� ���������� �����.');
define('_ERROR_BADPERMISSIONS',		'����� ������� � �����/����� ����������� �����������');
define('_ERROR_UPLOADMOVEP',		'������ ��� ����������� ������������ �����');
define('_ERROR_UPLOADCOPY',			'������ ��� ����������� �����');
define('_ERROR_UPLOADDUPLICATE',	'���� � ����� ������ ��� ����������. ���������� ������������� ���� ����� ��������.');
define('_ERROR_LOGINDISALLOWED',	'����, �� ��� ��������� ������� � ������ ���������� ������.');
define('_ERROR_DBCONNECT',			'���������� ����������� � MySQL ��������');
define('_ERROR_DBSELECT',			'���������� ������� ���� ������ Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'��� ������ ��������� �����');
define('_ERROR_NOSUCHCATEGORY',		'��� ����� ���������');
define('_ERROR_DELETELASTCATEGORY',	'������ ���� ���� �� ���� ���������');
define('_ERROR_DELETEDEFCATEGORY',	'������ ������� �������� �� ��������� ���������');
define('_ERROR_BADCATEGORYNAME',	'������������ ��� ���������');
define('_ERROR_DUPCATEGORYNAME',	'��������� � ����� ������ ��� ����������');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'��������������: ������� �������� - �� ����������!');
define('_WARNING_NOTREADABLE',		'��������������: ������� �������� - ���������� ����������!');
define('_WARNING_NOTWRITABLE',		'Warning: ������� �������� - �� ���������������� ����������!');

// media and upload
define('_MEDIA_UPLOADLINK',			'�������� ����');
define('_MEDIA_MODIFIED',			'������');
define('_MEDIA_FILENAME',			'��� �����');
define('_MEDIA_DIMENSIONS',			'�������');
define('_MEDIA_INLINE',				'����������');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'�������� ����');
define('_UPLOAD_MSG',				'�������� ����, ������� �� ������ �������� � ������� ������ "��������".');
define('_UPLOAD_BUTTON',			'��������');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'Account created, password will be sent through email');
//define('_MSG_PASSWORDSENT',			'Password has been sent by e-mail.');
define('_MSG_LOGINAGAIN',			'�� ������ ����� �����, ������ ��� ���������� � ��� ��������.');
define('_MSG_SETTINGSCHANGED',		'��������� ���������');
define('_MSG_ADMINCHANGED',			'������������� ������');
define('_MSG_NEWBLOG',				'����� ������ ������');
define('_MSG_ACTIONLOGCLEARED',		'��� �������� ������');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'����������� ��������: ');
define('_ACTIONLOG_PWDREMINDERSENT','������� ����� ������ ��� ');
define('_ACTIONLOG_TITLE',			'��� ��������');
define('_ACTIONLOG_CLEAR_TITLE',	'�������� ��� ��������');
define('_ACTIONLOG_CLEAR_TEXT',		'��������� ������� �������');

// team management
define('_TEAM_TITLE',				'���������� �������� ������� ��� ������� ');
define('_TEAM_CURRENT',				'������� �������');
define('_TEAM_ADDNEW',				'�������� ������������ � ������� �������');
define('_TEAM_CHOOSEMEMBER',		'�������� ������������');
define('_TEAM_ADMIN',				'���������� ��������������? ');
define('_TEAM_ADD',					'�������� � �������');
define('_TEAM_ADD_BTN',				'�������� � �������');

// blogsettings
define('_EBLOG_TITLE',				'��������� �������');
define('_EBLOG_TEAM_TITLE',			'���������� �������� �������');
define('_EBLOG_TEAM_TEXT',			'�������� ������� ������� ��� ����� �������...');
define('_EBLOG_SETTINGS_TITLE',		'��������� �������');
define('_EBLOG_NAME',				'�������� �������');
define('_EBLOG_SHORTNAME',			'�������� ���');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(������� a-z ��� ��������)');
define('_EBLOG_DESC',				'�������� �������');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'���� �� ���������');
define('_EBLOG_DEFCAT',				'�������� ���������');
define('_EBLOG_LINEBREAKS',			'�������������� ����������� ������ ���� � br');
define('_EBLOG_DISABLECOMMENTS',	'��������� �����������?<br /><small>(���� "���", �� �������������� ����� ����������.)</small>');
define('_EBLOG_ANONYMOUS',			'��������� ��������������� ������?');
define('_EBLOG_NOTIFY',				'����� (�) e-mail ��� �����������<br /> (���� ; ��� �����������)');
define('_EBLOG_NOTIFY_ON',			'���������� ���');
define('_EBLOG_NOTIFY_COMMENT',		'����� ������������');
define('_EBLOG_NOTIFY_KARMA',		'����� ����� �������');
define('_EBLOG_NOTIFY_ITEM',		'����� ����������');
define('_EBLOG_PING',				'��������� Weblogs.com ��� ����������?');
define('_EBLOG_MAXCOMMENTS',		'�������� ������������');
define('_EBLOG_UPDATE',				'���� ����������');
define('_EBLOG_OFFSET',				'������������� �������');
define('_EBLOG_STIME',				'����� �������');
define('_EBLOG_BTIME',				'����� �������');
define('_EBLOG_CHANGE',				'��������� ���������');
define('_EBLOG_CHANGE_BTN',			'��������� ���������');
define('_EBLOG_ADMIN',				'������������� �������');
define('_EBLOG_ADMIN_MSG',			'��� ����� ��������� ����� ��������������');
define('_EBLOG_CREATE_TITLE',		'������� ����� ������');
define('_EBLOG_CREATE_TEXT',		'��������� ����� ��� �������� �����. <br /><br /> <b>����������:</b> � ����� ������ ����� ����������� �����. ����� �������� � ��������� ������, ��������� �� �������� �������� ����� �������� �������.');
define('_EBLOG_CREATE',				'�������!');
define('_EBLOG_CREATE_BTN',			'������� ������');
define('_EBLOG_CAT_TITLE',			'���������');
define('_EBLOG_CAT_NAME',			'��� ���������');
define('_EBLOG_CAT_DESC',			'�������� ���������');
define('_EBLOG_CAT_CREATE',			'������� ����� ���������');
define('_EBLOG_CAT_UPDATE',			'�������� ���������');
define('_EBLOG_CAT_UPDATE_BTN',		'�������� ���������');

// templates
define('_TEMPLATE_TITLE',			'���������� ���������');
define('_TEMPLATE_AVAILABLE_TITLE',	'��������� �������');
define('_TEMPLATE_NEW_TITLE',		'����� ������');
define('_TEMPLATE_NAME',			'��� �������');
define('_TEMPLATE_DESC',			'�������� �������');
define('_TEMPLATE_CREATE',			'������� ������');
define('_TEMPLATE_CREATE_BTN',		'������� ������');
define('_TEMPLATE_EDIT_TITLE',		'�������� ������');
define('_TEMPLATE_BACK',			'��������� � ������ ��������');
define('_TEMPLATE_EDIT_MSG',		'�� ��� ����� ������� ����������. ��������� ���� ����� �������� ��������������.');
define('_TEMPLATE_SETTINGS',		'������� ��������� �������');
define('_TEMPLATE_ITEMS',			'���������');
define('_TEMPLATE_ITEMHEADER',		'"�����" ���������');
define('_TEMPLATE_ITEMBODY',		'������� ��������');
define('_TEMPLATE_ITEMFOOTER',		'"������" ���������');
define('_TEMPLATE_MORELINK',		'������ �� ������ ���������');
define('_TEMPLATE_NEW',				'��������� ����� ���������');
define('_TEMPLATE_COMMENTS_ANY',	'����������� (���� ����)');
define('_TEMPLATE_CHEADER',			'"�����" ����������� ');
define('_TEMPLATE_CBODY',			'���� �����������');
define('_TEMPLATE_CFOOTER',			'"������" �����������');
define('_TEMPLATE_CONE',			'���� �����������');
define('_TEMPLATE_CMANY',			'2 ��� ������ ������������');
define('_TEMPLATE_CMORE',			'������ �� ��� �����������');
define('_TEMPLATE_CMEXTRA',			'Extra ��������� �������������');
define('_TEMPLATE_COMMENTS_NONE',	'����������� (���� ���)');
define('_TEMPLATE_CNONE',			'��� ������������');
define('_TEMPLATE_COMMENTS_TOOMUCH','����������� (���� ����, �� ������, ��� ��������)');
define('_TEMPLATE_CTOOMUCH',		'������� ����� ������������');
define('_TEMPLATE_ARCHIVELIST',		'������ ������');
define('_TEMPLATE_AHEADER',			'"�����" ������ ������');
define('_TEMPLATE_AITEM',			'����� ������ ������');
define('_TEMPLATE_AFOOTER',			'"������" ������ ������');
define('_TEMPLATE_DATETIME',		'����� � ����');
define('_TEMPLATE_DHEADER',			'"�����" ����');
define('_TEMPLATE_DFOOTER',			'"������" ����');
define('_TEMPLATE_DFORMAT',			'������ ����');
define('_TEMPLATE_TFORMAT',			'������ �������');
define('_TEMPLATE_LOCALE',			'������ (����)');
define('_TEMPLATE_IMAGE',			'�������� Popup');
define('_TEMPLATE_PCODE',			'������ Popup');
define('_TEMPLATE_ICODE',			'��� ����������� �����������');
define('_TEMPLATE_MCODE',			'��� ������ media-��������');
define('_TEMPLATE_SEARCH',			'�����');
define('_TEMPLATE_SHIGHLIGHT',		'����������');
define('_TEMPLATE_SNOTFOUND',		'������ �� ������� ��� ������');
define('_TEMPLATE_UPDATE',			'��������');
define('_TEMPLATE_UPDATE_BTN',		'�������� ������');
define('_TEMPLATE_RESET_BTN',		'�������� ������');
define('_TEMPLATE_CATEGORYLIST',	'������ ���������');
define('_TEMPLATE_CATHEADER',		'"�����" ������ ���������');
define('_TEMPLATE_CATITEM',			'����� ������ ���������');
define('_TEMPLATE_CATFOOTER',		'"������" ������ ���������');

// skins
define('_SKIN_EDIT_TITLE',			'������������� ����');
define('_SKIN_AVAILABLE_TITLE',		'��������� �����');
define('_SKIN_NEW_TITLE',			'����� ����');
define('_SKIN_NAME',				'���');
define('_SKIN_DESC',				'��������');
define('_SKIN_TYPE',				'��� ��������');
define('_SKIN_CREATE',				'�������');
define('_SKIN_CREATE_BTN',			'������� ����');
define('_SKIN_EDITONE_TITLE',		'�������� ����');
define('_SKIN_BACK',				'��������� � ������ ������');
define('_SKIN_PARTS_TITLE',			'����� �����');
define('_SKIN_PARTS_MSG',			'�� ��� ������������ ���������� ��� ������. ������� ������� ��, ������� ��� �� �����. <br>�������� ����, ������� �� ������ ���������������:');
define('_SKIN_PART_MAIN',			'������� ��������');
define('_SKIN_PART_ITEM',			'�������� � ����������');
define('_SKIN_PART_ALIST',			'������ ������');
define('_SKIN_PART_ARCHIVE',		'�����');
define('_SKIN_PART_SEARCH',			'�����');
define('_SKIN_PART_ERROR',			'������');
define('_SKIN_PART_MEMBER',			'���������� � ������������');
define('_SKIN_PART_POPUP',			'�������� Popups');
define('_SKIN_GENSETTINGS_TITLE',	'�������� ���������');
define('_SKIN_CHANGE',				'��������');
define('_SKIN_CHANGE_BTN',			'�������� ���������');
define('_SKIN_UPDATE_BTN',			'�������� ����');
define('_SKIN_RESET_BTN',			'������� ������');
define('_SKIN_EDITPART_TITLE',		'������������� ����');
define('_SKIN_GOBACK',				'���������');
define('_SKIN_ALLOWEDVARS',			'��������� ���������� (������� ��� ����������):');

// global settings
define('_SETTINGS_TITLE',			'�������� ���������');
define('_SETTINGS_SUB_GENERAL',		'�������� ���������');
define('_SETTINGS_DEFBLOG',			'������ �� ���������');
define('_SETTINGS_ADMINMAIL',		'E-mail ��������������');
define('_SETTINGS_SITENAME',		'�������� �����');
define('_SETTINGS_SITEURL',			'URL ����� (������ ������������� ������ "/")');
define('_SETTINGS_ADMINURL',		'URL ����������������� ����� (������ ������������� ������ "/")');
define('_SETTINGS_DIRS',			'Nucleus - ���������� ���� �� �������');
define('_SETTINGS_MEDIADIR',		'Media - ���������� ���� �� �������');
define('_SETTINGS_SEECONFIGPHP',	'(��. config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (������ ������������� ������ "/")');
define('_SETTINGS_ALLOWUPLOAD',		'��������� ��������?');
define('_SETTINGS_ALLOWUPLOADTYPES','����������� ����������');
define('_SETTINGS_CHANGELOGIN',		'��������� ������������� ������ �����/������');
define('_SETTINGS_COOKIES_TITLE',	'��������� Cookie');
define('_SETTINGS_COOKIELIFE',		'���� �������� Cookie');
define('_SETTINGS_COOKIESESSION',	'�� �������');
define('_SETTINGS_COOKIEMONTH',		'���� �����');
define('_SETTINGS_COOKIEPATH',		'���� Cookie (����������� ���������)');
define('_SETTINGS_COOKIEDOMAIN',	'����� Cookie (����������� ���������)');
define('_SETTINGS_COOKIESECURE',	'���������� Cookie (����������� ���������)');
define('_SETTINGS_LASTVISIT',		'��������� Cookies ���������� ���������');
define('_SETTINGS_ALLOWCREATE',		'��������� ��������������� �����������');
define('_SETTINGS_NEWLOGIN',		'��������� ������������������ ������������� ������� � �������');
define('_SETTINGS_NEWLOGIN2',		'(������ ��� ����� ���������)');
define('_SETTINGS_MEMBERMSGS',		'��������� ��������� ����� ��������������');
define('_SETTINGS_LANGUAGE',		'���� �� ���������');
define('_SETTINGS_DISABLESITE',		'��������� ����');
define('_SETTINGS_DBLOGIN',			'mySQL ������');
define('_SETTINGS_UPDATE',			'��������� ���������');
define('_SETTINGS_UPDATE_BTN',		'��������� ���������');
define('_SETTINGS_DISABLEJS',		'��������� ������ JavaScript');
define('_SETTINGS_MEDIA',			'��������� Media/Upload');
define('_SETTINGS_MEDIAPREFIX',		'������� ���� ��� ����������� ������');
define('_SETTINGS_MEMBERS',			'��������� �������������');

// bans
define('_BAN_TITLE',				'������ ���� ���');
define('_BAN_NONE',					'��� ����� ��� ����� �������');
define('_BAN_NEW_TITLE',			'���������� ���');
define('_BAN_NEW_TEXT',				'���������� ���');
define('_BAN_REMOVE_TITLE',			'������� ���');
define('_BAN_IPRANGE',				'�������� IP');
define('_BAN_BLOGS',				'��� ����� ��������?');
define('_BAN_DELETE_TITLE',			'������� ���');
define('_BAN_ALLBLOGS',				'��� �������, � ������� �� ������ ����������������� ����������.');
define('_BAN_REMOVED_TITLE',		'������� ���');
define('_BAN_REMOVED_TEXT',			'��� ��� ���� ��� ��������� ��������:');
define('_BAN_ADD_TITLE',			'���������� ���');
define('_BAN_IPRANGE_TEXT',			'�������� �������� IP, ������� �� ������ �������������. ��� ������ ����� ����� � ���������, ��� ������ ������� ����� �������������.');
define('_BAN_BLOGS_TEXT',			'�� ������ �������, ��� �������� IP - � ����� ������� ��� � ���� ��������, � ������� �� ��������� ������������ ��������������.');
define('_BAN_REASON_TITLE',			'�������');
define('_BAN_REASON_TEXT',			'������� ���� (�������� ��� ������� ���������� IP-������ �������� ����������� ��� ������� ����� �����, �������� 256 ������)');
define('_BAN_ADD_BTN',				'���������� ���');

// LOGIN screen
define('_LOGIN_MESSAGE',			'���������');
define('_LOGIN_NAME',				'���');
define('_LOGIN_PASSWORD',			'������');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'��������� ������');

// membermanagement
define('_MEMBERS_TITLE',			'���������� ��������������');
define('_MEMBERS_CURRENT',			'������� ������������');
define('_MEMBERS_NEW',				'����� ������������');
define('_MEMBERS_DISPLAY',			'������������ ���');
define('_MEMBERS_DISPLAY_INFO',		'(��� ��� ������������ ��� �����)');
define('_MEMBERS_REALNAME',			'��������� ���');
define('_MEMBERS_PWD',				'������');
define('_MEMBERS_REPPWD',			'��������� ������');
define('_MEMBERS_EMAIL',			'E-mail');
define('_MEMBERS_EMAIL_EDIT',		'(����� �� �������� e-mail, ����� ������ ����� ������ ������������� �� ����� �����)');
define('_MEMBERS_URL',				'���� (URL)');
define('_MEMBERS_SUPERADMIN',		'�������������');
define('_MEMBERS_CANLOGIN',			'����� ������� � �������');
define('_MEMBERS_NOTES',			'�������');
define('_MEMBERS_NEW_BTN',			'�������� ������������');
define('_MEMBERS_EDIT',				'�������� ������� ������������');
define('_MEMBERS_EDIT_BTN',			'������ ���������');
define('_MEMBERS_BACKTOOVERVIEW',	'��������� � ������ �������������');
define('_MEMBERS_DEFLANG',			'����');
define('_MEMBERS_USESITELANG',		'- ������������ ��������� ����� -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'�������� ����');
define('_BLOGLIST_ADD',				'�������� ���������');
define('_BLOGLIST_TT_ADD',			'�������� ��������� � ���� ������');
define('_BLOGLIST_EDIT',			'���./��. ���������');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'���������');
define('_BLOGLIST_TT_SETTINGS',		'��������� � ���������� �������� �������');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'�����������, �������� ��� ������� ���������� IP-������');
define('_BLOGLIST_DELETE',			'�������');
define('_BLOGLIST_TT_DELETE',		'������� ������');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'������� �����');
define('_OVERVIEW_YRDRAFTS',		'���� ���������');
define('_OVERVIEW_YRSETTINGS',		'���� ���������');
define('_OVERVIEW_GSETTINGS',		'������������ �����');
define('_OVERVIEW_NOBLOGS',			'�� �� ������� �� � ���� ������� �������');
define('_OVERVIEW_NODRAFTS',		'���������� ���');
define('_OVERVIEW_EDITSETTINGS',	'��������� ������� ...');
define('_OVERVIEW_BROWSEITEMS',		'���������� ���� ��������� ...');
define('_OVERVIEW_BROWSECOMM',		'���������� ���� ����������� ...');
define('_OVERVIEW_VIEWLOG',			'���������� ��� �������� ...');
define('_OVERVIEW_MEMBERS',			'���������� �������������� ...');
define('_OVERVIEW_NEWLOG',			'������� ����� ������ ...');
define('_OVERVIEW_SETTINGS',		'�������� ��������� ...');
define('_OVERVIEW_TEMPLATES',		'�������� ������� ...');
define('_OVERVIEW_SKINS',			'�������� ����� ...');
define('_OVERVIEW_BACKUP',			'�����/�������������� ...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'��������� � �������');
define('_ITEMLIST_YOUR',			'���� ���������');

// Comments
define('_COMMENTS',					'�����������');
define('_NOCOMMENTS',				'��� ������������ � ����� ���������');
define('_COMMENTS_YOUR',			'���� �����������');
define('_NOCOMMENTS_YOUR',			'�� �� ��������� ������������');

// LISTS (general)
define('_LISTS_NOMORE',				'No more results, or no results at all');
define('_LISTS_PREV',				'����������');
define('_LISTS_NEXT',				'���������');
define('_LISTS_SEARCH',				'�����');
define('_LISTS_CHANGE',				'��������');
define('_LISTS_PERPAGE',			'��������� �� ��������');
define('_LISTS_ACTIONS',			'��������');
define('_LISTS_DELETE',				'�������');
define('_LISTS_EDIT',				'�������������');
define('_LISTS_MOVE',				'�����������');
define('_LISTS_CLONE',				'����������');
define('_LISTS_TITLE',				'��������');
define('_LISTS_BLOG',				'������');
define('_LISTS_NAME',				'���');
define('_LISTS_DESC',				'��������');
define('_LISTS_TIME',				'�����');
define('_LISTS_COMMENTS',			'�����������');
define('_LISTS_TYPE',				'���');


// member list
define('_LIST_MEMBER_NAME',			'������������ ���');
define('_LIST_MEMBER_RNAME',		'R��������� ���');
define('_LIST_MEMBER_ADMIN',		'�����-�����? ');
define('_LIST_MEMBER_LOGIN',		'����� ������� � �������? ');
define('_LIST_MEMBER_URL',			'����');

// banlist
define('_LIST_BAN_IPRANGE',			'�������� IP');
define('_LIST_BAN_REASON',			'�������');

// actionlist
define('_LIST_ACTION_MSG',			'���������');

// commentlist
define('_LIST_COMMENT_BANIP',		'��� IP');
define('_LIST_COMMENT_WHO',			'�����');
define('_LIST_COMMENT',				'�����������');
define('_LIST_COMMENT_HOST',		'����');

// itemlist
define('_LIST_ITEM_INFO',			'����������');
define('_LIST_ITEM_CONTENT',		'��������� � �����');


// teamlist
define('_LIST_TEAM_ADMIN',			'������������� ');
define('_LIST_TEAM_CHADMIN',		'������� ���������������');

// edit comments
define('_EDITC_TITLE',				'�������� �����������');
define('_EDITC_WHO',				'�����');
define('_EDITC_HOST',				'������');
define('_EDITC_WHEN',				'�����');
define('_EDITC_TEXT',				'����� �����������');
define('_EDITC_EDIT',				'�������� �����������');
define('_EDITC_MEMBER',				'������������');
define('_EDITC_NONMEMBER',			'�����');

// move item
define('_MOVE_TITLE',				'�������� ������ ��� �����������');
define('_MOVE_BTN',					'����������� ���������');

?>
