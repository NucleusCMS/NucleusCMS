<?php
// Japanese (EUC-JP) Nucleus Language File
// 
// Author: chrome (chrome@cgi.no-ip.org)
// Modified by: Osamu Higuchi (osamu@higuchi.com)
// Nucleus version: v1.0-v3.1
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// Note for Japanese users
// ���Υե������ Nucleus �� EUC-JP �����ܸ��󥲡����ե�����Ǥ���
// �ե�����̾�� japanese.php ���ѹ����Ƥ��顢Nucleus �� language �ǥ��쥯�ȥ��
// �֤��Ƥ���������

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'�����ȤΥꥹ�ȡ�');
define('_NOCOMMENTS_BLOG',			'����blog�ˤϤޤ������Ȥ��Ĥ����Ƥ��ޤ���');
define('_BLOGLIST_COMMENTS',		'������');
define('_BLOGLIST_TT_COMMENTS',		'����blog�ˤĤ���줿�����ȤΥꥹ��');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'��');
define('_ARCHIVETYPE_MONTH',		'��');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Invalid or expired ticket.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin installation failed, requires ');
define('_ERROR_DELREQPLUGIN',		'Plugin deletion failed, required by ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie �ץ�ե��å���');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'ǧ���ѥ�󥯤������Ǥ��ޤ��󡣤��ʤ��Υ�����ϵ��Ĥ���Ƥ��ʤ�����Ǥ���');
define('_ERROR_ACTIVATE',			'ǧ�ڥ�����¸�ߤ��ʤ�����̵���������뤤�ϴ����ڤ�Ǥ���');
define('_ACTIONLOG_ACTIVATIONLINK', 'ǧ���ѥ�󥯤���������ޤ���');
define('_MSG_ACTIVATION_SENT',		'ǧ���ѥ�󥯤��᡼��������ޤ�����');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"����ˤ��� <%memberName%>\n\n<%siteName%> (<%siteUrl%>)�ˤ����륢������Ȥ�ͭ���ˤ��ʤ���Фʤ�ޤ���\n���Υ�󥯤�ˬ��뤳�Ȥˤ�ꤽ�줬��ǽ�ˤʤ�ޤ���\n\n\t<%activationUrl%>\n\n��������ˤ����ԤäƤ��������������᤮��С�ǧ���ѥ�󥯤�̵���ˤʤ�ޤ���");
define('_ACTIVATE_REGISTER_MAILTITLE',	"���������'<%memberName%>'��ǧ��");
define('_ACTIVATE_REGISTER_TITLE',	'�褦���� <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'��������Ⱥ����Ϥܴۤ�λ���ޤ��������Υե�����ǥ�������ȤΥѥ���ɤ����ꤷ�Ƥ���������');
define('_ACTIVATE_FORGOT_MAIL',		"����ˤ��� <%memberName%>\n\n���Υ�󥯤��顢����<%siteName%> (<%siteUrl%>)�ˤ����륢������Ȥο������ѥ���ɤ����ꤹ�뤳�Ȥ��Ǥ��ޤ���\n\n\t<%activationUrl%>\n\n��������ˤ����ԤäƤ��������������᤮��С�ǧ���ѥ�󥯤�̵���ˤʤ�ޤ���");
define('_ACTIVATE_FORGOT_MAILTITLE',"���������'<%memberName%>'�κ�ǧ��");
define('_ACTIVATE_FORGOT_TITLE',	'�褦���� <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'���Υե�����ǥ�������Ȥο������ѥ���ɤ�����Ǥ��ޤ���');
define('_ACTIVATE_CHANGE_MAIL',		"����ˤ��� <%memberName%>\n\n�᡼�륢�ɥ쥹���ѹ����줿�Τǡ�<%siteName%> (<%siteUrl%>)�ˤ����륢������Ȥ��ǧ�ڤ���ɬ�פ�����ޤ���\���Υ�󥯤�ˬ��뤳�Ȥˤ�ꤽ�줬��ǽ�ˤʤ�ޤ���\n\n\t<%activationUrl%>\n\n��������ˤ����ԤäƤ��������������᤮��С�ǧ���ѥ�󥯤�̵���ˤʤ�ޤ���");
define('_ACTIVATE_CHANGE_MAILTITLE',"���������'<%memberName%>'�κ�ǧ��");
define('_ACTIVATE_CHANGE_TITLE',	'�褦���� <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'�᡼�륢�ɥ쥹���ѹ�����ǧ����ޤ��������꤬�Ȥ���');
define('_ACTIVATE_SUCCESS_TITLE',	'ǧ�ڤ��������ޤ���');
define('_ACTIVATE_SUCCESS_TEXT',	'��������Ȥ�ͭ���ˤ��뤳�Ȥ��������ޤ�����');
define('_MEMBERS_SETPWD',			'�ѥ���ɤ����ꤹ��');
define('_MEMBERS_SETPWD_BTN',		'�ѥ���ɤ�����');
define('_QMENU_ACTIVATE',			'��������Ȥ�ǧ��');
define('_QMENU_ACTIVATE_TEXT',		'<p>��������Ȥ�ͭ���ˤ���С�<a href="index.php?action=showlogin">������</a>���뤳�Ȥˤ�����ѤǤ��ޤ���</p>');

define('_PLUGS_BTN_UPDATE',			'��Ͽ�ꥹ�ȤΥ��åץǡ���');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascript�ġ���С��Υ�������');
define('_SETTINGS_JSTOOLBAR_FULL',	'�ե롦�ġ���С�(IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','����ץ롦�ġ���С�(IE�ʳ�)');
define('_SETTINGS_JSTOOLBAR_NONE',	'�ġ���С���Ȥ�ʤ�');
define('_SETTINGS_URLMODE_HELP',	'(���͡�<a href="documentation/tips.html#searchengines-fancyurls">fancy URL��ͭ���ˤ�����ˡ</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'�ץ饰����ˤ���ɲ�����');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'����:');
define('_LIST_ITEM_DATE',			'����:');
define('_LIST_ITEM_TIME',			'����:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(���С�)');

// batch operations
define('_BATCH_WITH_SEL',			'���򤵤줿��Τ�');
define('_BATCH_EXEC',				'�¹�');

// quickmenu
define('_QMENU_HOME',				'�����ۡ���');
define('_QMENU_ADD',				'�����ƥ��ɲ�');
define('_QMENU_ADD_SELECT',			'- blog���� -');
define('_QMENU_USER_SETTINGS',		'���ʤ�������');
define('_QMENU_USER_ITEMS',			'���ʤ��Υ����ƥ�');
define('_QMENU_USER_COMMENTS',		'���ʤ��Υ�����');
define('_QMENU_MANAGE',				'�����ȴ���');
define('_QMENU_MANAGE_LOG',			'�����������');
define('_QMENU_MANAGE_SETTINGS',	'�����Х�����');
define('_QMENU_MANAGE_MEMBERS',		'���С�����');
define('_QMENU_MANAGE_NEWBLOG',		'����Blog����');
define('_QMENU_MANAGE_BACKUPS',		'DB��¸/����');
define('_QMENU_MANAGE_PLUGINS',		'�ץ饰�������');
define('_QMENU_LAYOUT',				'�쥤����������');
define('_QMENU_LAYOUT_SKINS',		'�������Խ�');
define('_QMENU_LAYOUT_TEMPL',		'�ƥ�ץ졼���Խ�');
define('_QMENU_LAYOUT_IEXPORT',		'�ɹ�/���');
define('_QMENU_PLUGINS',			'�ץ饰����');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Ƴ��������');
define('_QMENU_INTRO_TEXT',			'<p>�����ϥ����֥����Ȥδ�����Ԥ�����ƥ�Ĵ��������ƥࡢ��Nucleus CMS�פΥ�������̤Ǥ���</p><p>��������Ȥ���äƤ���Х����󤷤Ƶ����ο�����Ƥ��Ǥ��ޤ���</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'���Υץ饰�����ѤΥإ�ץե����뤬���Ĥ���ޤ���');
define('_PLUGS_HELP_TITLE',			'�ץ饰����Υإ�ץڡ���');
define('_LIST_PLUGS_HELP', 			'�إ��');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Enable External Authentication');
define('_WARNING_EXTAUTH',			'Warning: Enable only if needed.');

// member profile
define('_MEMBERS_BYPASS',			'Use External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>���</em>�����оݤˤ���');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'ɽ��');
define('_MEDIA_VIEW_TT',			'�ե�����ɽ�� (������������ɥ��������ޤ�)');
define('_MEDIA_FILTER_APPLY',		'�ե��륿��Ŭ��');
define('_MEDIA_FILTER_LABEL',		'�ե��륿��: ');
define('_MEDIA_UPLOAD_TO',			'���åץ�����...');
define('_MEDIA_UPLOAD_NEW',			'�������åץ���...');
define('_MEDIA_COLLECTION_SELECT',	'����');
define('_MEDIA_COLLECTION_TT',		'���Υ��ƥ��꡼���ڤ��ؤ�');
define('_MEDIA_COLLECTION_LABEL',	'���ߤΥ��쥯�����: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'����');
define('_ADD_ALIGNRIGHT_TT',		'����');
define('_ADD_ALIGNCENTER_TT',		'�����');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'���åץ��ɤ˼��Ԥ��ޤ���');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'���������Ǥ���Ƥ���Ĥ���');
define('_ADD_CHANGEDATE',			'�����ॹ����פ򹹿�');
define('_BMLET_CHANGEDATE',			'�����ॹ����פ򹹿�');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'�ɹ�/���');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'�Ρ��ޥ�');
define('_PARSER_INCMODE_SKINDIR',	'skindir��Ȥ�');
define('_SKIN_INCLUDE_MODE',		'Include �⡼��');
define('_SKIN_INCLUDE_PREFIX',		'Include �ץ�ե��å���');

// global settings
define('_SETTINGS_BASESKIN',		'���ܤΥ�����');
define('_SETTINGS_SKINSURL',		'������URL');
define('_SETTINGS_ACTIONSURL',		'action.php �ؤΥե�URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'default���ƥ��꡼�ϰ�ư�Ǥ��ޤ���');
define('_ERROR_MOVETOSELF',			'���ƥ��꡼���ư�Ǥ��ޤ��� (��ư���Blog����ư����Ʊ���Ǥ�)');
define('_MOVECAT_TITLE',			'���ƥ��꡼���ư����Blog�����򤷤Ƥ�������');
define('_MOVECAT_BTN',				'���ƥ��꡼���ư');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL �⡼��');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'�оݤ����򤵤�Ƥ��ޤ���');
define('_BATCH_ITEMS',				'�����ƥࡡ�������Ф��ƤΥХå����');
define('_BATCH_CATEGORIES',			'���ƥ��꡼�������Ф��ƤΥХå����');
define('_BATCH_MEMBERS',			'���С����������Ф��ƤΥХå����');
define('_BATCH_TEAM',				'��������С����Ф��ƤΥХå����');
define('_BATCH_COMMENTS',			'�����ȡ��������Ф��ƤΥХå����');
define('_BATCH_UNKNOWN',			'̤�ΤΥХå����: ');
define('_BATCH_EXECUTING',			'�¹���');
define('_BATCH_ONCATEGORY',			'- �оݥ��ƥ��꡼');
define('_BATCH_ONITEM',				'- �оݥ����ƥ�');
define('_BATCH_ONCOMMENT',			'- �оݥ�����');
define('_BATCH_ONMEMBER',			'- �оݥ��С�');
define('_BATCH_ONTEAM',				'- �оݥ�������С�');
define('_BATCH_SUCCESS',			'����!');
define('_BATCH_DONE',				'��λ!');
define('_BATCH_DELETE_CONFIRM',		'�Хå�����γ�ǧ');
define('_BATCH_DELETE_CONFIRM_BTN',	'�Хå�����γ�ǧ');
define('_BATCH_SELECTALL',			'��������');
define('_BATCH_DESELECTALL',		'���Ƥ��������');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'���');
define('_BATCH_ITEM_MOVE',			'��ư');
define('_BATCH_MEMBER_DELETE',		'���');
define('_BATCH_MEMBER_SET_ADM',		'�����Ը��¤�Ϳ����');
define('_BATCH_MEMBER_UNSET_ADM',	'�����Ը��¤򳰤�');
define('_BATCH_TEAM_DELETE',		'�����फ����');
define('_BATCH_TEAM_SET_ADM',		'�����Ը��¤�Ϳ����');
define('_BATCH_TEAM_UNSET_ADM',		'�����Ը��¤򳰤�');
define('_BATCH_CAT_DELETE',			'���');
define('_BATCH_CAT_MOVE',			'¾��Blog�˰�ư');
define('_BATCH_COMMENT_DELETE',		'���');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'�����������ƥ���ɲ�...');
define('_ADD_PLUGIN_EXTRAS',		'�ɲåץ饰���󥪥ץ����');

// errors
define('_ERROR_CATCREATEFAIL',		'���������ƥ��꡼������Ǥ��ޤ���');
define('_ERROR_NUCLEUSVERSIONREQ',	'���Υץ饰����Ͽ������С������� Nucleus ��ɬ�פǤ�: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Blog����������');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'�ɤ߹���');
define('_SKINIE_TITLE_EXPORT',		'�񤭽Ф�');
define('_SKINIE_BTN_IMPORT',		'�ɤ߹���');
define('_SKINIE_BTN_EXPORT',		'���򤵤줿������/�ƥ�ץ졼�Ȥ�񤭽Ф�');
define('_SKINIE_LOCAL',				'������ե����뤫���ɤ߹���:');
define('_SKINIE_NOCANDIDATES',		'skins�ǥ��쥯�ȥ�����ɤ߹����ե����뤬����ޤ���');
define('_SKINIE_FROMURL',			'URL����ꤷ���ɤ߹���:');
define('_SKINIE_EXPORT_INTRO',		'�񤭽Ф�������/�ƥ�ץ졼�Ȥ�ʲ��������򤷤Ƥ�������');
define('_SKINIE_EXPORT_SKINS',		'������');
define('_SKINIE_EXPORT_TEMPLATES',	'�ƥ�ץ졼��');
define('_SKINIE_EXPORT_EXTRA',		'�ɲþ���');
define('_SKINIE_CONFIRM_OVERWRITE',	'����¸�ߤ��륹������񤭤��� (�֤Ĥ��륹����̾�򻲾�)');
define('_SKINIE_CONFIRM_IMPORT',	'�Ϥ���������ɤ߹��ߤޤ�');
define('_SKINIE_CONFIRM_TITLE',		'������ȥƥ�ץ졼�Ȥ��ɤ߹��⤦�Ȥ��Ƥ��ޤ�');
define('_SKINIE_INFO_SKINS',		'�ե�������Υ�����:');
define('_SKINIE_INFO_TEMPLATES',	'�ե�������Υƥ�ץ졼��:');
define('_SKINIE_INFO_GENERAL',		'����:');
define('_SKINIE_INFO_SKINCLASH',	'���Υ�����̾���֤Ĥ���ޤ�:');
define('_SKINIE_INFO_TEMPLCLASH',	'���Υƥ�ץ졼��̾���֤Ĥ���ޤ�:');
define('_SKINIE_INFO_IMPORTEDSKINS','�ɤ߹��ޤ줿������:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','�ɤ߹��ޤ줿�ƥ�ץ졼��:');
define('_SKINIE_DONE',				'�ɤ߹��ߴ�λ');

define('_AND',						'and');
define('_OR',						'or');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'̵��(����å����Խ�)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Include�⡼��:');
define('_LIST_SKINS_INCPREFIX',		'Include Prefix:');
define('_LIST_SKINS_DEFINED',		'����Ѥߥѡ���:');

// backup
define('_BACKUPS_TITLE',			'�Хå����å� / �ꥹ�ȥ�');
define('_BACKUP_TITLE',				'�Хå����å�');
define('_BACKUP_INTRO',				'���Υܥ���򲡤��Ȥ��ʤ��� Nucleus �ǡ����١�����Хå����åפ��ޤ����Хå����åץե�����ϰ����ʾ�����¸���Ƥ������Ȥ򤪴��ᤷ�ޤ���');
define('_BACKUP_ZIP_YES',			'���̤���');
define('_BACKUP_ZIP_NO',			'���̤��ʤ�');
define('_BACKUP_BTN',				'�Хå����åפ��������');
define('_BACKUP_NOTE',				'<b>���:</b> �Хå����åפ����Τϥǡ����١��������Ƥ����Ǥ�����ǥ����ե������ config.php �������ϥХå����å�<b>����ޤ���</b>��');
define('_RESTORE_TITLE',			'�ꥹ�ȥ�');
define('_RESTORE_NOTE',				'<b>�ٹ�:</b> �Хå����åפ���Υꥹ�ȥ��ϸ��ߤΥǡ����١������ Nucleus �ǡ���������<b>���</b>���ޤ����ɤ���դ��ƻ��Ѥ��Ƥ���������	<br />	<b>���:</b> �Хå����åפ�������� Nucleus �ΥС������ ���߻��Ѥ��Ƥ��� Nucleus �ΥС�������Ʊ������ǧ���Ƥ��������������Ǥʤ����������ư��ޤ���');
define('_RESTORE_INTRO',			'�ʲ�����Хå����åץե�����ʥ����Ф˥��åץ��ɤ���ޤ��ˤ����򤷤�"�ꥹ�ȥ�"�ܥ���򲡤��ȳ��Ϥ��ޤ���');
define('_RESTORE_IMSURE',			'�Ϥ����Τ��ˤ������μ¹Ԥ�ǧ���ޤ���');
define('_RESTORE_BTN',				'�ե����뤫��ꥹ�ȥ�');
define('_RESTORE_WARNING',			'���������Хå����åפ�ꥹ�ȥ����褦�Ȥ��Ƥ��뤫��ǧ�����Ϥ�����˸��ߤΥХå����åפ��äƤ����Ƥ���������');
define('_ERROR_BACKUP_NOTSURE',		'"��ǧ"�ƥ��ȥܥå���������å�����ɬ�פ�����ޤ�');
define('_RESTORE_COMPLETE',			'�ꥹ�ȥ���λ');

// new item notification
define('_NOTIFY_NI_MSG',			'�����������ƥब��Ƥ���ޤ���:');
define('_NOTIFY_NI_TITLE',			'�����������ƥ�!');
define('_NOTIFY_KV_MSG',			'����ޤ���ɼ������ޤ���:');
define('_NOTIFY_KV_TITLE',			'Nucleus�����:');
define('_NOTIFY_NC_MSG',			'�����ƥ�˥����Ȥ���:');
define('_NOTIFY_NC_TITLE',			'Nucleus������:');
define('_NOTIFY_USERID',			'�桼����ID:');
define('_NOTIFY_USER',				'�桼����:');
define('_NOTIFY_COMMENT',			'������:');
define('_NOTIFY_VOTE',				'��ɼ:');
define('_NOTIFY_HOST',				'�ۥ���:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'���С�:');
define('_NOTIFY_TITLE',				'�����ȥ�:');
define('_NOTIFY_CONTENTS',			'����ƥ��:');

// member mail message
define('_MMAIL_MSG',				'���������餢�ʤ����Υ�å������������Ƥ��ޤ���');
define('_MMAIL_FROMANON',			'ƿ̾�Υӥ�����');
define('_MMAIL_FROMNUC',			'��������Nucleus �����֥�');
define('_MMAIL_TITLE',				'��å����� from');
define('_MMAIL_MAIL',				'��å�����:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'�����ƥ���ɲ�');
define('_BMLET_EDIT',				'��¸');
define('_BMLET_DELETE',				'�����ƥ�κ��');
define('_BMLET_BODY',				'��ʸ');
define('_BMLET_MORE',				'³��');
define('_BMLET_OPTIONS',			'���ץ����');
define('_BMLET_PREVIEW',			'�ץ�ӥ塼');

// used in bookmarklet
define('_ITEM_UPDATED',				'�����ƥब��������ޤ���');
define('_ITEM_DELETED',				'�����ƥब�������ޤ���');

// plugins
define('_CONFIRMTXT_PLUGIN',		'���Υץ饰����������ޤ���?');
define('_ERROR_NOSUCHPLUGIN',		'���Τ褦�ʥץ饰����Ϥ���ޤ���');
define('_ERROR_DUPPLUGIN',			'���Υץ饰����ϴ��˥��󥹥ȡ��뤵��Ƥ��ޤ�');
define('_ERROR_PLUGFILEERROR',		'���Τ褦�ʥץ饰�����¸�ߤ��ʤ������ѡ��ߥå�������������ꤵ��Ƥ��ޤ���');
define('_PLUGS_NOCANDIDATES',		'�ץ饰������䤬���Ĥ���ޤ���');

define('_PLUGS_TITLE_MANAGE',		'�ץ饰����δ���');
define('_PLUGS_TITLE_INSTALLED',	'���󥹥ȡ���Ѥ�');
define('_PLUGS_TITLE_UPDATE',		'��Ͽ�ꥹ�ȤΥ��åץǡ���');
define('_PLUGS_TEXT_UPDATE',		'Nucleus�ϥץ饰����Υ��٥����Ͽ���ݻ����ޤ��� �ե�������񤭤��ƥץ饰����Υ��åץǡ��Ȥ򤹤��硢��Ͽ������������å��夵��뤿��ˤ��Υ��åץǡ��Ȥ�¹Ԥ��Ƥ���������');
define('_PLUGS_TITLE_NEW',			'�������ץ饰����򥤥󥹥ȡ���');
define('_PLUGS_ADD_TEXT',			'�ʲ���plugins�ǥ��쥯�ȥ���Ρ����ƤΥ��󥹥ȡ��뤵��Ƥ��ʤ���ǽ���Τ���ץ饰����Υե�����Υꥹ�ȤǤ����ɲä������˥ץ饰���󤫤ɤ�����<strong>���ä����ǧ</strong>���Ƥ���������');
define('_PLUGS_BTN_INSTALL',		'�ץ饰����Υ��󥹥ȡ���');
define('_BACKTOOVERVIEW',			'���������');

// editlink
define('_TEMPLATE_EDITLINK',		'�����ƥ���Խ����뤿��Υ��');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'left box���ɲ�');
define('_ADD_RIGHT_TT',				'right box���ɲ�');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'���������ƥ��꡼...');

// new settings
define('_SETTINGS_PLUGINURL',		'�ץ饰����URL');
define('_SETTINGS_MAXUPLOADSIZE',	'���åץ��ɥե�����κ��祵���� (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'���С��ʳ�����Υ�å��������դ����');
define('_SETTINGS_PROTECTMEMNAMES',	'���С�̾���ݸ�');

// overview screen
define('_OVERVIEW_PLUGINS',			'�ץ饰�������');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'���������С�����Ͽ:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'���ʤ��Υ᡼�륢�ɥ쥹:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'������ꥹ������оݥ��С�����Ĥɤ�blog�ؤδ����Ը��¤���äƤ��ޤ��󡣤��Τ���ˡ����Υ��С��Υ�ǥ������ǥ��쥯�ȥ꡼�ؤΥե�����Υ��åץ��ɤ�ǧ����ޤ���');

// plugin list
define('_LISTS_INFO',				'����');
define('_LIST_PLUGS_AUTHOR',		'By:');
define('_LIST_PLUGS_VER',			'�С������:');
define('_LIST_PLUGS_SITE',			'������');
define('_LIST_PLUGS_DESC',			'����:');
define('_LIST_PLUGS_SUBS',			'�ʲ��Υ��٥�Ȥ���Ͽ:');
define('_LIST_PLUGS_UP',			'���');
define('_LIST_PLUGS_DOWN',			'����');
define('_LIST_PLUGS_UNINSTALL',		'���');
define('_LIST_PLUGS_ADMIN',			'����');
define('_LIST_PLUGS_OPTIONS',		'�Խ�');
define('_LIST_PLUGS_DEP',		'Plugin(s) requires:');

// plugin option list
define('_LISTS_VALUE',				'��');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'���Υץ饰����Υ��ץ����Ϥ���ޤ���');
define('_PLUGS_BACK',				'�ץ饰����ΰ��������');
define('_PLUGS_SAVE',				'���ץ�������¸');
define('_PLUGS_OPTIONS_UPDATED',	'�ץ饰���󥪥ץ���󤬹�������ޤ���');

define('_OVERVIEW_MANAGEMENT',		'����');
define('_OVERVIEW_MANAGE',			'Nucleus�δ���');
define('_MANAGE_GENERAL',			'����');
define('_MANAGE_SKINS',				'������/�ƥ�ץ졼��');
define('_MANAGE_EXTRA',				'�ɲõ�ǽ');

define('_BACKTOMANAGE',				'Nucleus�δ��������');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'EUC-JP');

// global stuff
define('_LOGOUT',					'��������');
define('_LOGIN',					'������');
define('_YES',						'�Ϥ�');
define('_NO',						'������');
define('_SUBMIT',					'����');
define('_ERROR',					'���顼');
define('_ERRORMSG',					'���顼��ȯ�����ޤ���!');
define('_BACK',						'���');
define('_NOTLOGGEDIN',				'�����󤷤Ƥ��ޤ���');
define('_LOGGEDINAS',				'������:');
define('_ADMINHOME',				'�����ۡ���');
define('_NAME',						'̾��');
define('_BACKHOME',					'�����ۡ�������');
define('_BADACTION',				'¸�ߤ��ʤ�����������׵ᤵ��ޤ���');
define('_MESSAGE',					'��å�����');
define('_HELP_TT',					'�إ��!');
define('_YOURSITE',					'�����Ȥγ�ǧ');


define('_POPUP_CLOSE',				'������ɥ����Ĥ���');

define('_LOGIN_PLEASE',				'�ޤ������󤷤Ƥ�������');

// commentform
define('_COMMENTFORM_YOUARE',		'�桼����̾: ');
define('_COMMENTFORM_SUBMIT',		'�����Ȥ��ɲ�');
define('_COMMENTFORM_COMMENT',		'������');
define('_COMMENTFORM_NAME',			'��̾��');
define('_COMMENTFORM_MAIL',			'�᡼��ޤ���Web������');
define('_COMMENTFORM_REMEMBER',		'����򵭲����Ƥ���');

// loginform
define('_LOGINFORM_NAME',			'�桼����̾');
define('_LOGINFORM_PWD',			'�ѥ����');
define('_LOGINFORM_YOUARE',			'��������:');
define('_LOGINFORM_SHARED',			'����PC��¾�οͤȶ��Ѥ���');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'��å���������');

// search form
define('_SEARCHFORM_SUBMIT',		'����');

// add item form
define('_ADD_ADDTO',				'�����ƥ���ɲ�:');
define('_ADD_CREATENEW',			'�����������ƥ�');
define('_ADD_BODY',					'��ʸ');
define('_ADD_TITLE',				'�����ȥ�');
define('_ADD_MORE',					'³�� (����Ǥ��)');
define('_ADD_CATEGORY',				'���ƥ��꡼');
define('_ADD_PREVIEW',				'�ץ�ӥ塼');
define('_ADD_DISABLE_COMMENTS',		'�����Ȥ�̵���ˤ��ޤ���?');
define('_ADD_DRAFTNFUTURE',			'�ɥ�եȤ�̤��ε���');
define('_ADD_ADDITEM',				'�����ƥ���ɲ�');
define('_ADD_ADDNOW',				'�������ɲ�');
define('_ADD_ADDLATER',				'����ɲ�');
define('_ADD_PLACE_ON',				'����:');
define('_ADD_ADDDRAFT',				'�ɥ�եȤ��ɲ�');
define('_ADD_NOPASTDATES',			'(���������ϻ���Ǥ��ޤ��󡣻��ꤵ�줿���ϸ��ߤ����������Ѥ���ޤ�)');
define('_ADD_BOLD_TT',				'����');
define('_ADD_ITALIC_TT',			'����');
define('_ADD_HREF_TT',				'��󥯺���');
define('_ADD_MEDIA_TT',				'��ǥ���(����������)���ɲ�');
define('_ADD_PREVIEW_TT',			'�ץ�ӥ塼��ɽ��/��ɽ��');
define('_ADD_CUT_TT',				'���å�');
define('_ADD_COPY_TT',				'���ԡ�');
define('_ADD_PASTE_TT',				'�ڡ�����');


// edit item form
define('_EDIT_ITEM',				'�����ƥ���Խ�');
define('_EDIT_SUBMIT',				'��¸');
define('_EDIT_ORIG_AUTHOR',			'�����');
define('_EDIT_BACKTODRAFTS',		'���٥ɥ�եȤȤ�����¸');
define('_EDIT_COMMENTSNOTE',		'(���: �����Ȥ���ɽ���ϰ������ɲä��줿�����Ȥ򱣤��Ϥ��ޤ���)');

// used on delete screens
define('_DELETE_CONFIRM',			'����γ�ǧ�򤷤Ƥ�������');
define('_DELETE_CONFIRM_BTN',		'����γ�ǧ');
define('_CONFIRMTXT_ITEM',			'�ʲ��Υ����ƥ�������褦�Ȥ��Ƥ��ޤ�:');
define('_CONFIRMTXT_COMMENT',		'�ʲ��Υ����Ȥ������褦�Ȥ��Ƥ��ޤ�:');
define('_CONFIRMTXT_TEAM1',			'����blog�Υ�����ꥹ�Ȥ���');
define('_CONFIRMTXT_TEAM2',			'������褦�Ȥ��Ƥ��ޤ�');
define('_CONFIRMTXT_BLOG',			'�������Blog: ');
define('_WARNINGTXT_BLOGDEL',		'�ٹ�! Blog��������Ȥ���˴ޤޤ�Ƥ������ƤΥ����ƥࡢ�����ȤϺ������ޤ������������ǧ������ǹԤäƤ���������<br />����ˡ�Blog�κ�����Nucleus�����Ǥ����ʤ��Ǥ���������');
define('_CONFIRMTXT_MEMBER',		'�ʲ��Υ��С��ץ�ե�����������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_TEMPLATE',		'���Υƥ�ץ졼�Ȥ������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_SKIN',			'���Υ�����������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_BAN',			'���ζػ�IP�ϰϤ������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_CATEGORY',		'���Υ��ƥ��꡼�������褦�Ȥ��Ƥ��ޤ�: ');

// some status messages
define('_DELETED_ITEM',				'�����ƥब�������ޤ���');
define('_DELETED_MEMBER',			'���С����������ޤ���');
define('_DELETED_COMMENT',			'�����Ȥ��������ޤ���');
define('_DELETED_BLOG',				'Blog���������ޤ���');
define('_DELETED_CATEGORY',			'���ƥ��꡼���������ޤ���');
define('_ITEM_MOVED',				'�����ƥब��ư����ޤ���');
define('_ITEM_ADDED',				'�����ƥब�ɲä���ޤ���');
define('_COMMENT_UPDATED',			'�����Ȥ���������ޤ���');
define('_SKIN_UPDATED',				'������ǡ�������¸����ޤ���');
define('_TEMPLATE_UPDATED',			'�ƥ�ץ졼�ȥǡ�������¸����ޤ���');

// errors
define('_ERROR_COMMENT_LONGWORD',	'�����Ȥˤ�Ⱦ�Ѥ�90ʸ���ʾ�θ��Ȥ�ʤ��ǲ�����');
define('_ERROR_COMMENT_NOCOMMENT',	'�����Ȥ����Ϥ��Ƥ�������');
define('_ERROR_COMMENT_NOUSERNAME',	'�������ʤ��桼��̾�Ǥ�');
define('_ERROR_COMMENT_TOOLONG',	'�����Ȥ�Ĺ�����ޤ�(Ⱦ�Ѥ�5000ʸ���ޤ�)');
define('_ERROR_COMMENTS_DISABLED',	'����Blog�ؤΥ����Ȥϸ��߻��ѤǤ��ޤ���');
define('_ERROR_COMMENTS_NONPUBLIC',	'����Blog�إ����Ȥ��ɲä���ˤϥ��С��Ȥ��ƥ����󤷤ʤ���Ф����ޤ���');
define('_ERROR_COMMENTS_MEMBERNICK','���ʤ����Ȥ����Ȥ���̾���ϴ��˻Ȥ��Ƥ��ޤ���¾��̾��������Ǥ���������');
define('_ERROR_SKIN',				'�����󡡥��顼');
define('_ERROR_ITEMCLOSED',			'���Υ����ƥ���ĺ�����ޤ��������Υ����ƥ�ؤΥ����Ȥ��ɲá���ɼ�ϤǤ��ޤ���');
define('_ERROR_NOSUCHITEM',			'���Τ褦�ʥ����ƥ��¸�ߤ��ޤ���');
define('_ERROR_NOSUCHBLOG',			'���Τ褦��Blog��¸�ߤ��ޤ���');
define('_ERROR_NOSUCHSKIN',			'���Τ褦�ʥ������¸�ߤ��ޤ���');
define('_ERROR_NOSUCHMEMBER',		'���Τ褦�ʥ��С���¸�ߤ��ޤ���');
define('_ERROR_NOTONTEAM',			'���ʤ��Ϥ���Blog�Υ�����ꥹ�Ȥ˴ޤޤ�Ƥ��ޤ���');
define('_ERROR_BADDESTBLOG',		'�������Blog��¸�ߤ��ޤ���');
define('_ERROR_NOTONDESTTEAM',		'���ʤ����������Blog�Υ�����ꥹ�Ȥ����äƤ��ʤ����ᡢ�����ƥ���ư�Ǥ��ޤ���');
define('_ERROR_NOEMPTYITEMS',		'���Υ����ƥ���ɲäǤ��ޤ���!');
define('_ERROR_BADMAILADDRESS',		'�᡼�륢�ɥ쥹�������Ǥ�');
define('_ERROR_BADNOTIFY',			'���Υ᡼�륢�ɥ쥹����������ʤ�Τ������äƤ��ޤ�');
define('_ERROR_BADNAME',			'̾�������ѤǤ��ޤ��� ( a-z ��0-9 �αѿ��������Ȥ��ޤ���)');
define('_ERROR_NICKNAMEINUSE',		'¾�Υ��С������Υ˥å��͡������Ѥ��Ƥ��ޤ�');
define('_ERROR_PASSWORDMISMATCH',	'�ѥ���ɤ��ޥå����ޤ���');
define('_ERROR_PASSWORDTOOSHORT',	'�ѥ���ɤ�6ʸ���ʾ�Ǥʤ���Фʤ�ޤ���');
define('_ERROR_PASSWORDMISSING',	'�ѥ���ɤ����Ǥ�');
define('_ERROR_REALNAMEMISSING',	'��̾�����Ϥ��Ƥ�������');
define('_ERROR_ATLEASTONEADMIN',	'�������ΰ�˥�����Ǥ���super-admin�����ʤ��Ȥ�1�ͤϤ��ʤ��ƤϤ����ޤ���');
define('_ERROR_ATLEASTONEBLOGADMIN','���Υ���������¹Ԥ���Ȥ��ʤ���Blog�ϥ��ƥʥ���ǽ�ˤʤ�ޤ������ʤ��Ȥ�1�ͤδ����Ԥ�����褦�ˤ��Ƥ���������');
define('_ERROR_ALREADYONTEAM',		'���˥�����ˤ�����С����ɲäǤ��ޤ���');
define('_ERROR_BADSHORTBLOGNAME',	'û��Blog̾�ˤ� a-z ��0-9���αѿ����Τ߻��ѤǤ��ޤ������ڡ����ϻ��ѤǤ��ޤ���');
define('_ERROR_DUPSHORTBLOGNAME',	'¾��Blog��Ʊ��û��̾���Ȥ��Ƥ��ޤ���Ʊ��̾���ϻ��ѤǤ��ޤ���');
define('_ERROR_UPDATEFILE',			'�����ե�����˽񤭹���ޤ��󡣥ե�����Υѡ��ߥå�������������åȤ���Ƥ��뤫��ǧ���Ƥ������� (chmod 666 ���ƤߤƤ�������)���ޤ������줬�����ΰ�ǥ��쥯�ȥ꤫������а��֤Ǥ����硢(/your/path/to/nucleus/ �Τ褦��)���Хѥ��ǻ��ꤷ�ƤߤƤ�������');
define('_ERROR_DELDEFBLOG',			'�����Blog�Ϻ���Ǥ��ޤ���');
define('_ERROR_DELETEMEMBER',		'���Υ��С��ϥ����ƥफ�����Ȥ�񤤤Ƥ��뤿�����Ǥ��ޤ���');
define('_ERROR_BADTEMPLATENAME',	'�����ʥƥ�ץ졼��̾�Ǥ� (a-z ��0-9 �αѿ����Τ߻��Ѳġ����ڡ����ϻ����Բ�)');
define('_ERROR_DUPTEMPLATENAME',	'Ʊ��̾���Υƥ�ץ졼�Ȥ�����¸�ߤ��ޤ�');
define('_ERROR_BADSKINNAME',		'�����ʥ�����̾�Ǥ� (a-z ��0-9 �αѿ����Τ߻��Ѳġ����ڡ����ϻ����Բ�)');
define('_ERROR_DUPSKINNAME',		'Ʊ��̾���Υ����󤬴���¸�ߤ��ޤ�');
define('_ERROR_DEFAULTSKIN',		'��� "default" �Ȥ���̾���Υ�����¸�ߤ��ʤ���Ф����ޤ���');
define('_ERROR_SKINDEFDELETE',		'�ʲ���Blog�δ���Υ�����˻��ꤵ��Ƥ��뤿�ᡢ����������Ǥ��ޤ���: ');
define('_ERROR_DISALLOWED',			'���Υ��������μ¹Ԥ����Ĥ���Ƥ��ޤ���');
define('_ERROR_DELETEBAN',			'�ػ߼Ԥκ����˥��顼��ȯ�����ޤ��� (�ػ߼Ԥ�¸�ߤ��ޤ���)');
define('_ERROR_ADDBAN',				'�ػ߼Ԥ��ɲ���˥��顼��ȯ�����ޤ��������Ƥ�blog���������ɲä���Ƥ��ʤ����⤷��ޤ���');
define('_ERROR_BADACTION',			'�׵ᤵ�줿���������¸�ߤ��ޤ���');
define('_ERROR_MEMBERMAILDISABLED',	'���С��֤Υ᡼���å������������ԲĤˤʤäƤ��ޤ�');
define('_ERROR_MEMBERCREATEDISABLED','���С��κ����������ԲĤˤʤäƤ��ޤ�');
define('_ERROR_INCORRECTEMAIL',		'�������ʤ��᡼�륢�ɥ쥹�Ǥ�');
define('_ERROR_VOTEDBEFORE',		'���Υ����ƥ�˴�����ɼ�ѤߤǤ�');
define('_ERROR_BANNED1',			'���ʤ� (IP�ϰ� ');
define('_ERROR_BANNED2',			') �Ϥ��Υ��������μ¹Ԥ��ػߤ���Ƥ��ޤ�����å�����: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'���Υ���������¹Ԥ��뤹��ˤϥ�����ɬ�פǤ�');
define('_ERROR_CONNECT',			'��³���顼');
define('_ERROR_FILE_TOO_BIG',		'�ե����뤬�礭�����ޤ�!');
define('_ERROR_BADFILETYPE',		'���Υե����륿���פ�ǧ����Ƥ��ޤ���');
define('_ERROR_BADREQUEST',			'�����ʥ��åץ����׵�Ǥ�');
define('_ERROR_DISALLOWEDUPLOAD',	'���ʤ��Ϥɤ�Blog������ꥹ�Ȥˤ����äƤ��ʤ��Τǡ��ե�����򥢥åץ��ɤǤ��ޤ���ޤ���');
define('_ERROR_BADPERMISSIONS',		'�ե�����/�ǥ��쥯�ȥ�Υѡ��ߥå�������������åȤ���Ƥ��ޤ���');
define('_ERROR_UPLOADMOVEP',		'���åץ��ɥե�����ΰ�ư��˥��顼��ȯ�����ޤ���');
define('_ERROR_UPLOADCOPY',			'�ե�����Υ��ԡ���˥��顼��ȯ�����ޤ���');
define('_ERROR_UPLOADDUPLICATE',	'Ʊ��̾���Υե����뤬����¸�ߤ��ޤ������åץ��ɤ�������̾�����ѹ����Ƥ��Ƥ���������');
define('_ERROR_LOGINDISALLOWED',	'���ʤ��ϴ������ΰ�ؤΥ�����ǧ����Ƥ��ޤ��󡣤�������¾�Υ桼�����Ȥ��ƥ����󤹤뤳�ȤϽ���ޤ�');
define('_ERROR_DBCONNECT',			'MySQL�����Ф���³�Ǥ��ޤ���');
define('_ERROR_DBSELECT',			'nucleus�ǡ����١���������Ǥ��ޤ���');
define('_ERROR_NOSUCHLANGUAGE',		'���Τ褦�ʥ�󥲡����ե������¸�ߤ��ޤ���');
define('_ERROR_NOSUCHCATEGORY',		'���Τ褦�ʥ��ƥ��꡼��¸�ߤ��ޤ���');
define('_ERROR_DELETELASTCATEGORY',	'���ʤ��Ȥ�1�ĤΥ��ƥ��꡼��ɬ�פǤ�');
define('_ERROR_DELETEDEFCATEGORY',	'����Υ��ƥ��꡼�Ϻ���Ǥ��ޤ���');
define('_ERROR_BADCATEGORYNAME',	'���ƥ��꡼̾�Ȥ��ƻȤ��ޤ���');
define('_ERROR_DUPCATEGORYNAME',	'Ʊ��̾���Υ��ƥ��꡼������¸�ߤ��ޤ�');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'�ٹ�: ���ߤ��ͤϥǥ��쥯�ȥ�ǤϤ���ޤ���!');
define('_WARNING_NOTREADABLE',		'�ٹ�: ���ߤ��ͤ��ɤ߼���Բ�ǽ�ʥǥ��쥯�ȥ�Ǥ�!');
define('_WARNING_NOTWRITABLE',		'�ٹ�: ���ߤ��ͤϽ񤭹����Բ�ǽ�ʥǥ��쥯�ȥ�Ǥ�!');

// media and upload
define('_MEDIA_UPLOADLINK',			'�������ե�����Υ��åץ���');
define('_MEDIA_MODIFIED',			'������');
define('_MEDIA_FILENAME',			'�ե�����̾');
define('_MEDIA_DIMENSIONS',			'������');
define('_MEDIA_INLINE',				'������');
define('_MEDIA_POPUP',				'�ݥåץ��å�');
define('_UPLOAD_TITLE',				'�ե���������');
define('_UPLOAD_MSG',				'���åץ��ɤ���ե���������򤷤ơ�\'���åץ���\' �ܥ���򲡤��Ƥ�������');
define('_UPLOAD_BUTTON',			'���åץ���');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'��������Ȥ���������ޤ������ѥ���ɤ��᡼�����������ޤ�');
//define('_MSG_PASSWORDSENT',			'�ѥ���ɤ��᡼�����������ޤ�����');
define('_MSG_LOGINAGAIN',			'���ʤ��ξ����ѹ����줿�١������󤷤ʤ���ɬ�פ�����ޤ�');
define('_MSG_SETTINGSCHANGED',		'���꤬�ѹ�����ޤ���');
define('_MSG_ADMINCHANGED',			'�����Ը��� ���ѹ�����ޤ���');
define('_MSG_NEWBLOG',				'������Blog����������ޤ���');
define('_MSG_ACTIONLOGCLEARED',		'����������򤬾õ��ޤ���');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'���Ĥ���Ƥ��ʤ����������: ');
define('_ACTIONLOG_PWDREMINDERSENT','�������ѥ���ɤ�������: ');
define('_ACTIONLOG_TITLE',			'�����������');
define('_ACTIONLOG_CLEAR_TITLE',	'�����������ξõ�');
define('_ACTIONLOG_CLEAR_TEXT',		'�����������򺣤����õ�');

// team management
define('_TEAM_TITLE',				'Blog�Υ������������� ');
define('_TEAM_CURRENT',				'���ߤΥ�����');
define('_TEAM_ADDNEW',				'������˿��������С����ɲä���');
define('_TEAM_CHOOSEMEMBER',		'���С�������');
define('_TEAM_ADMIN',				'�����Ը��¤�Ϳ���� ');
define('_TEAM_ADD',					'��������ɲ�');
define('_TEAM_ADD_BTN',				'��������ɲ�');

// blogsettings
define('_EBLOG_TITLE',				'Blog������Խ�');
define('_EBLOG_TEAM_TITLE',			'��������Խ�');
define('_EBLOG_TEAM_TEXT',			'��������Խ�...');
define('_EBLOG_SETTINGS_TITLE',		'Blog����');
define('_EBLOG_NAME',				'Blog��̾��');
define('_EBLOG_SHORTNAME',			'Blog��û��̾');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a-z�α�ʸ���Τߤ����ѤǤ������ڡ����ϻ��ѤǤ��ޤ���)');
define('_EBLOG_DESC',				'Blog������');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'ɸ��Υ�����');
define('_EBLOG_DEFCAT',				'ɸ��Υ��ƥ���');
define('_EBLOG_LINEBREAKS',			'���Ԥ��Ѵ�����');
define('_EBLOG_DISABLECOMMENTS',	'�����Ȥ���Ĥ��ޤ���?<br /><small>(�����Ȥ�ػߤ���ȥ����Ȥ��ɲäϤǤ��ʤ��ʤ�ޤ���)</small>');
define('_EBLOG_ANONYMOUS',			'����С��Υ����Ȥ���Ĥ��ޤ���?');
define('_EBLOG_NOTIFY',				'���Τ���᡼�륢�ɥ쥹 ( ; �Ƕ��ڤäƤ�������)');
define('_EBLOG_NOTIFY_ON',			'�ʲ������Τ���');
define('_EBLOG_NOTIFY_COMMENT',		'������������');
define('_EBLOG_NOTIFY_KARMA',		'�������������ɼ');
define('_EBLOG_NOTIFY_ITEM',		'������Blog�����ƥ�');
define('_EBLOG_PING',				'�������� Weblogs.com ��Ping������ޤ���?');
define('_EBLOG_MAXCOMMENTS',		'�����Ȥκ�����');
define('_EBLOG_UPDATE',				'��ư��������ե�����');
define('_EBLOG_OFFSET',				'�����л���Ȥλ���');
define('_EBLOG_STIME',				'���ߤΥ����л���: ');
define('_EBLOG_BTIME',				'���ߤ�Blog����: ');
define('_EBLOG_CHANGE',				'������ѹ�');
define('_EBLOG_CHANGE_BTN',			'������ѹ�');
define('_EBLOG_ADMIN',				'Blog�����Ը���');
define('_EBLOG_ADMIN_MSG',			'���ʤ��ˤϴ����Ը��¤�������Ƥ��ޤ�');
define('_EBLOG_CREATE_TITLE',		'������Blog�κ���');
define('_EBLOG_CREATE_TEXT',		'������Blog���������٤˰ʲ��Υե�����˽񤭹���Ǥ���������<br /><br /> <b>���:</b> ɬ�פʥ��ץ����Τߤ�ɽ������Ƥ��ޤ����ɲäΥ��ץ��������ꤷ�������ϡ�Blog������������Blog����ڡ����˹Ԥä����ꤷ�Ƥ���������');
define('_EBLOG_CREATE',				'����!');
define('_EBLOG_CREATE_BTN',			'Blog�����');
define('_EBLOG_CAT_TITLE',			'���ƥ��꡼');
define('_EBLOG_CAT_NAME',			'���ƥ��꡼̾');
define('_EBLOG_CAT_DESC',			'���ƥ��꡼������');
define('_EBLOG_CAT_CREATE',			'���������ƥ��꡼����');
define('_EBLOG_CAT_UPDATE',			'���ƥ��꡼�ι���');
define('_EBLOG_CAT_UPDATE_BTN',		'���ƥ��꡼�򹹿�');

// templates
define('_TEMPLATE_TITLE',			'�ƥ�ץ졼�Ȥ��Խ�');
define('_TEMPLATE_AVAILABLE_TITLE',	'���Ѳ�ǽ�ʥƥ�ץ졼��');
define('_TEMPLATE_NEW_TITLE',		'�������ƥ�ץ졼��');
define('_TEMPLATE_NAME',			'�ƥ�ץ졼��̾');
define('_TEMPLATE_DESC',			'�ƥ�ץ졼�Ȥ�����');
define('_TEMPLATE_CREATE',			'�ƥ�ץ졼�Ȥκ���');
define('_TEMPLATE_CREATE_BTN',		'�ƥ�ץ졼�Ȥ����');
define('_TEMPLATE_EDIT_TITLE',		'�ƥ�ץ졼�Ȥ��Խ�');
define('_TEMPLATE_BACK',			'�ƥ�ץ졼�Ȥΰ��������');
define('_TEMPLATE_EDIT_MSG',		'���ƤΥƥ�ץ졼�ȥѡ��Ĥ�ɬ�פ����ǤϤ���ޤ���ɬ�פʤ����϶���Τޤޤˤ��Ƥ����Ƥ���������');
define('_TEMPLATE_SETTINGS',		'�ƥ�ץ졼������');
define('_TEMPLATE_ITEMS',			'�����ƥ�');
define('_TEMPLATE_ITEMHEADER',		'�����ƥ�Υإå���');
define('_TEMPLATE_ITEMBODY',		'�����ƥ������');
define('_TEMPLATE_ITEMFOOTER',		'�����ƥ�Υեå���');
define('_TEMPLATE_MORELINK',		'³���ؤΥ��');
define('_TEMPLATE_NEW',				'�����������ƥ���դ���ޡ���');
define('_TEMPLATE_COMMENTS_ANY',	'������ (������)');
define('_TEMPLATE_CHEADER',			'�����ȤΥإå���');
define('_TEMPLATE_CBODY',			'�����Ȥ�����');
define('_TEMPLATE_CFOOTER',			'�����ȤΥեå���');
define('_TEMPLATE_CONE',			'�����Ȥ�1�Ĥλ�');
define('_TEMPLATE_CMANY',			'�����Ȥ�2�İʾ�λ�');
define('_TEMPLATE_CMORE',			'�����Ȥ�³�����ɤ�');
define('_TEMPLATE_CMEXTRA',			'��Ͽ���С�����Υ����Ȥؤ��ɲ�ɽ��');
define('_TEMPLATE_COMMENTS_NONE',	'������ (̵�����)');
define('_TEMPLATE_CNONE',			'�����Ȥ�̵����');
define('_TEMPLATE_COMMENTS_TOOMUCH','������ (����ɽ�������¿�����)');
define('_TEMPLATE_CTOOMUCH',		'�����Ȥ�¿�������');
define('_TEMPLATE_ARCHIVELIST',		'���������ְ���');
define('_TEMPLATE_AHEADER',			'���������ְ����Υإå���');
define('_TEMPLATE_AITEM',			'���������ְ���������');
define('_TEMPLATE_AFOOTER',			'���������ְ����Υեå���');
define('_TEMPLATE_DATETIME',		'���դȻ���');
define('_TEMPLATE_DHEADER',			'���դΥإå���');
define('_TEMPLATE_DFOOTER',			'���դΥեå���');
define('_TEMPLATE_DFORMAT',			'���եե����ޥå�');
define('_TEMPLATE_TFORMAT',			'����ե����ޥå�');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'�����ȥ�ǥ����Υݥåץ��å�');
define('_TEMPLATE_PCODE',			'�ݥåץ��åײ����ؤΥ�󥯥�����');
define('_TEMPLATE_ICODE',			'����饤������Υ�����');
define('_TEMPLATE_MCODE',			'��ǥ������֥������ȤؤΥ�󥯥�����');
define('_TEMPLATE_SEARCH',			'����');
define('_TEMPLATE_SHIGHLIGHT',		'�ϥ��饤��ɽ��');
define('_TEMPLATE_SNOTFOUND',		'�����ǲ��⸫�Ĥ���ʤ��ä����');
define('_TEMPLATE_UPDATE',			'����');
define('_TEMPLATE_UPDATE_BTN',		'�ƥ�ץ졼�Ȥι���');
define('_TEMPLATE_RESET_BTN',		'�ꥻ�å�');
define('_TEMPLATE_CATEGORYLIST',	'���ƥ��꡼����');
define('_TEMPLATE_CATHEADER',		'���ƥ��꡼�����Υإå���');
define('_TEMPLATE_CATITEM',			'���ƥ��꡼����������');
define('_TEMPLATE_CATFOOTER',		'���ƥ��꡼�����Υեå���');

// skins
define('_SKIN_EDIT_TITLE',			'��������Խ�');
define('_SKIN_AVAILABLE_TITLE',		'���Ѳ�ǽ�ʥ�����');
define('_SKIN_NEW_TITLE',			'������������');
define('_SKIN_NAME',				'̾��');
define('_SKIN_DESC',				'����');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'����');
define('_SKIN_CREATE_BTN',			'������κ���');
define('_SKIN_EDITONE_TITLE',		'��������Խ�');
define('_SKIN_BACK',				'������ΰ��������');
define('_SKIN_PARTS_TITLE',			'������ѡ���');
define('_SKIN_PARTS_MSG',			'���줾��Υ���������ƤΥ����פ�ɬ�פȤϸ¤�ޤ���ɬ�פʤ����϶���Τޤޤˤ��Ƥ����Ƥ����������ʲ������Խ����륹���������Ǥ�������:');
define('_SKIN_PART_MAIN',			'�ᥤ����ܼ��ڡ���');
define('_SKIN_PART_ITEM',			'���̥����ƥ�ڡ���');
define('_SKIN_PART_ALIST',			'���̥��������ְ����ڡ���');
define('_SKIN_PART_ARCHIVE',		'���̥��������֥ڡ���');
define('_SKIN_PART_SEARCH',			'�����ڡ���');
define('_SKIN_PART_ERROR',			'���顼�ڡ���');
define('_SKIN_PART_MEMBER',			'���С��ܺ٥ڡ���');
define('_SKIN_PART_POPUP',			'�����ݥåץ��åץ�����ɥ�');
define('_SKIN_GENSETTINGS_TITLE',	'��������');
define('_SKIN_CHANGE',				'�ѹ�');
define('_SKIN_CHANGE_BTN',			'������ѹ�');
define('_SKIN_UPDATE_BTN',			'������ι���');
define('_SKIN_RESET_BTN',			'�ꥻ�å�');
define('_SKIN_EDITPART_TITLE',		'��������Խ�');
define('_SKIN_GOBACK',				'���');
define('_SKIN_ALLOWEDVARS',			'���Ѳ�ǽ���ѿ� (����å�������ɽ��):');

// global settings
define('_SETTINGS_TITLE',			'�����Х�����');
define('_SETTINGS_SUB_GENERAL',		'�����Х�����');
define('_SETTINGS_DEFBLOG',			'�����Blog');
define('_SETTINGS_ADMINMAIL',		'�����ԤΥ᡼�륢�ɥ쥹');
define('_SETTINGS_SITENAME',		'������̾');
define('_SETTINGS_SITEURL',			'�����Ȥ�URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_ADMINURL',		'�������ΰ��URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_DIRS',			'Nucleus �ǥ��쥯�ȥ�');
define('_SETTINGS_MEDIADIR',		'��ǥ���(����������)�ǥ��쥯�ȥ�');
define('_SETTINGS_SEECONFIGPHP',	'(config.php �򻲾�)');
define('_SETTINGS_MEDIAURL',		'��ǥ���URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_ALLOWUPLOAD',		'�ե�����Υ��åץ��ɤ���Ĥ��ޤ���?');
define('_SETTINGS_ALLOWUPLOADTYPES','���åץ��ɤ���Ĥ���ե����륿����');
define('_SETTINGS_CHANGELOGIN',		'���С��ˤ�������̾/�ѥ���ɤ��ѹ�����Ĥ���');
define('_SETTINGS_COOKIES_TITLE',	'Cookie ����');
define('_SETTINGS_COOKIELIFE',		'������ Cookie ��ͭ������');
define('_SETTINGS_COOKIESESSION',	'���å���󤴤�');
define('_SETTINGS_COOKIEMONTH',		'�����');
define('_SETTINGS_COOKIEPATH',		'Cookie �ѥ� (��饪�ץ����)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie �ɥᥤ�� (��饪�ץ����)');
define('_SETTINGS_COOKIESECURE',	'�����奢 Cookie (��饪�ץ����)');
define('_SETTINGS_LASTVISIT',		'�ǽ�ˬ������ Cookie ����¸');
define('_SETTINGS_ALLOWCREATE',		'�ӥ������˥��С���������Ⱥ�������Ĥ���');
define('_SETTINGS_NEWLOGIN',		'�桼����������������������Ȥˤ�����������');
define('_SETTINGS_NEWLOGIN2',		'(�������������줿��������ȤΤ�)');
define('_SETTINGS_MEMBERMSGS',		'���С��֥����ӥ������');
define('_SETTINGS_LANGUAGE',		'����θ���');
define('_SETTINGS_DISABLESITE',		'¾�Υ����ȤؤΥ�����쥯�ȡ������ѡ�');
define('_SETTINGS_DBLOGIN',			'MySQL ������ &amp; �ǡ����١���');
define('_SETTINGS_UPDATE',			'����ι���');
define('_SETTINGS_UPDATE_BTN',		'����򹹿�');
define('_SETTINGS_DISABLEJS',		'JavaScript�ġ���С���̵���ˤ���');
define('_SETTINGS_MEDIA',			'��ǥ���/���åץ�������');
define('_SETTINGS_MEDIAPREFIX',		'���åץ��ɤ���ե�����̾��Ƭ�����դ��ղä���');
define('_SETTINGS_MEMBERS',			'���С�����');

// bans
define('_BAN_TITLE',				'�ػߥꥹ��:');
define('_BAN_NONE',					'����Blog�ζػ߼ԤϤ��ޤ���');
define('_BAN_NEW_TITLE',			'�ػ߼Ԥ��ɲä���');
define('_BAN_NEW_TEXT',				'�������ػ߼Ԥ��ɲä���');
define('_BAN_REMOVE_TITLE',			'�ػ߼Ԥκ��');
define('_BAN_IPRANGE',				'IP���ϰ�');
define('_BAN_BLOGS',				'�ػߤ���Blog: ');
define('_BAN_DELETE_TITLE',			'�ػ߼Ԥκ��');
define('_BAN_ALLBLOGS',				'���ʤ����������ø���������Ƥ�Blog');
define('_BAN_REMOVED_TITLE',		'�ػ߼Ԥ��������ޤ���');
define('_BAN_REMOVED_TEXT',			'�ʲ���Blog�ؤζػ߼Ԥ��������ޤ���:');
define('_BAN_ADD_TITLE',			'�ػ߼Ԥ��ɲ�');
define('_BAN_IPRANGE_TEXT',			'�ʲ��ǥ֥�å�������IP���ϰϤ�����Ǥ������������ꤹ���ϰϤ���������¿���Υ��ɥ쥹���֥�å�����ޤ���');
define('_BAN_BLOGS_TEXT',			'1�Ĥ�Blog�ΤߤǶػߤ��뤫�����ʤ����������ø���������Ƥ�Blog�Ƕػߤ��뤫�����򤹤뤳�Ȥ�����ޤ����ʲ���������Ǥ���������');
define('_BAN_REASON_TITLE',			'��ͳ');
define('_BAN_REASON_TEXT',			'��������IP�ػ߼Ԥ������Ȥ��ɲä����ꥫ�����ɼ�򤷤褦�Ȥ����Ȥ���ɽ�������ػ���ͳ��񤤤Ƥ������Ȥ��Ǥ��ޤ� (���256ʸ��)��');
define('_BAN_ADD_BTN',				'�ػ߼Ԥ��ɲ�');

// LOGIN screen
define('_LOGIN_MESSAGE',			'��å�����');
define('_LOGIN_NAME',				'�桼����̾');
define('_LOGIN_PASSWORD',			'�ѥ����');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'�ѥ���ɤ�˺�줿���');

// membermanagement
define('_MEMBERS_TITLE',			'���С��δ���');
define('_MEMBERS_CURRENT',			'���ߤΥ��С�');
define('_MEMBERS_NEW',				'���������С����ɲ�');
define('_MEMBERS_DISPLAY',			'ɽ�������̾��');
define('_MEMBERS_DISPLAY_INFO',		'(����̾���ϥ�������˻Ȥ��ޤ�)');
define('_MEMBERS_REALNAME',			'��̾');
define('_MEMBERS_PWD',				'�ѥ����');
define('_MEMBERS_REPPWD',			'�ѥ���ɡʳ�ǧ��');
define('_MEMBERS_EMAIL',			'�᡼�륢�ɥ쥹');
define('_MEMBERS_EMAIL_EDIT',		'(�᡼�륢�ɥ쥹���ѹ�����ȡ����Υ��ɥ쥹�ؼ�ưŪ�˿������ѥ���ɤ���������ޤ�)');
define('_MEMBERS_URL',				'Web�����ȥ��ɥ쥹 (URL)');
define('_MEMBERS_SUPERADMIN',		'Super-admin(�ǹ����)���¤�Ϳ����');
define('_MEMBERS_CANLOGIN',			'�������ΰ�ؤΥ�����');
define('_MEMBERS_NOTES',			'����');
define('_MEMBERS_NEW_BTN',			'���С����ɲ�');
define('_MEMBERS_EDIT',				'���С����Խ�');
define('_MEMBERS_EDIT_BTN',			'������ѹ�');
define('_MEMBERS_BACKTOOVERVIEW',	'���С��ΰ��������');
define('_MEMBERS_DEFLANG',			'����');
define('_MEMBERS_USESITELANG',		'- �����Ȥ������Ȥ� -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'�����Ȥ򸫤�');
define('_BLOGLIST_ADD',				'�����ƥ���ɲ�');
define('_BLOGLIST_TT_ADD',			'����Blog�˿����������ƥ���ɲä��ޤ�');
define('_BLOGLIST_EDIT',			'�����ƥ���Խ�/���');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'����');
define('_BLOGLIST_TT_SETTINGS',		'������Խ�/������δ���');
define('_BLOGLIST_BANS',			'�ػ�');
define('_BLOGLIST_TT_BANS',			'�ػ�IP�γ�ǧ/�ɲ�/���');
define('_BLOGLIST_DELETE',			'���ƺ��');
define('_BLOGLIST_TT_DELETE',		'����Blog����');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'���ʤ���Blog');
define('_OVERVIEW_YRDRAFTS',		'�ɥ�ե�');
define('_OVERVIEW_YRSETTINGS',		'����');
define('_OVERVIEW_GSETTINGS',		'��������');
define('_OVERVIEW_NOBLOGS',			'���ʤ��Ϥɤ�Blog������ꥹ�Ȥˤ����äƤ��ޤ���');
define('_OVERVIEW_NODRAFTS',		'�ɥ�եȡ��Խ���ˤε����Ϥ���ޤ���');
define('_OVERVIEW_EDITSETTINGS',	'���ʤ�������');
define('_OVERVIEW_BROWSEITEMS',		'���ʤ��Υ����ƥ�');
define('_OVERVIEW_BROWSECOMM',		'���ʤ��Υ�����');
define('_OVERVIEW_VIEWLOG',			'�����������');
define('_OVERVIEW_MEMBERS',			'���С�����');
define('_OVERVIEW_NEWLOG',			'����Blog����');
define('_OVERVIEW_SETTINGS',		'�����Х�����');
define('_OVERVIEW_TEMPLATES',		'�ƥ�ץ졼���Խ�');
define('_OVERVIEW_SKINS',			'�������Խ�');
define('_OVERVIEW_BACKUP',			'DB��¸/����');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Blog�����ƥ���Խ�: ');
define('_ITEMLIST_YOUR',			'���ʤ��Υ����ƥ�');

// Comments
define('_COMMENTS',					'������');
define('_NOCOMMENTS',				'���Υ����ƥ�ؤΥ����ȤϤ���ޤ���');
define('_COMMENTS_YOUR',			'���ʤ��Υ�����');
define('_NOCOMMENTS_YOUR',			'���ʤ��Υ����ȤϤ���ޤ���');

// LISTS (general)
define('_LISTS_NOMORE',				'���⤢��ޤ���');
define('_LISTS_PREV',				'����');
define('_LISTS_NEXT',				'����');
define('_LISTS_SEARCH',				'����');
define('_LISTS_CHANGE',				'�ѹ�');
define('_LISTS_PERPAGE',			'�����ƥ�/�ڡ���');
define('_LISTS_ACTIONS',			'���������');
define('_LISTS_DELETE',				'���');
define('_LISTS_EDIT',				'�Խ�');
define('_LISTS_MOVE',				'��ư');
define('_LISTS_CLONE',				'ʣ��');
define('_LISTS_TITLE',				'�����ȥ�');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'̾��');
define('_LISTS_DESC',				'����');
define('_LISTS_TIME',				'����');
define('_LISTS_COMMENTS',			'������');
define('_LISTS_TYPE',				'������');


// member list 
define('_LIST_MEMBER_NAME',			'̾��');
define('_LIST_MEMBER_RNAME',		'��̾');
define('_LIST_MEMBER_ADMIN',		'Super-admin���� ');
define('_LIST_MEMBER_LOGIN',		'�������ǽ');
define('_LIST_MEMBER_URL',			'Web������');

// banlist
define('_LIST_BAN_IPRANGE',			'IP���ϰ�');
define('_LIST_BAN_REASON',			'��ͳ');

// actionlist
define('_LIST_ACTION_MSG',			'��å�����');

// commentlist
define('_LIST_COMMENT_BANIP',		'�ػ�IP');
define('_LIST_COMMENT_WHO',			'���');
define('_LIST_COMMENT',				'������');
define('_LIST_COMMENT_HOST',		'�ۥ���');

// itemlist
define('_LIST_ITEM_INFO',			'����');
define('_LIST_ITEM_CONTENT',		'�����ȥ����ʸ');


// teamlist
define('_LIST_TEAM_ADMIN',			'�����Ը��� ');
define('_LIST_TEAM_CHADMIN',		'�����Ը��¤��ѹ�');

// edit comments
define('_EDITC_TITLE',				'�����Ȥ��Խ�');
define('_EDITC_WHO',				'���');
define('_EDITC_HOST',				'�ۥ���');
define('_EDITC_WHEN',				'����');
define('_EDITC_TEXT',				'��ʸ');
define('_EDITC_EDIT',				'�����Ȥ��Խ�');
define('_EDITC_MEMBER',				'���С�');
define('_EDITC_NONMEMBER',			'����С�');

// move item
define('_MOVE_TITLE',				'�ɤ�Blog�˰�ư���ޤ���?');
define('_MOVE_BTN',					'�����ƥ���ư����');

?>
