<?php
// Japanese (EUC-JP) Nucleus Language File
//
// Author: chrome (chrome@cgi.no-ip.org)
// Modified by: Osamu Higuchi (osamu@higuchi.com)
// Modified by: shizuki (shizuki@kinezumi.net)
// Nucleus version: v1.0-v3.5
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



/**
 * Japanese EUC-JP Nucleus Language File
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The NucleusCMS Japan������
 * @version $Id$
 */

/********************************************
 *        Start New for 3.50                *
 ********************************************/
define('_PLUGS_TITLE_GETPLUGINS',		'�ץ饰����������');
define('_ARCHIVETYPE_YEAR', 'ǯ');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'�������С�����������ǽ�Ǥ�');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'���åץ��졼�ɤ������ǽ�Ǥ��� v');
define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "�ץ饰���� %s ���ɤ߹���ޤ���Ǥ�����(���Υץ饰�����SqlAPI�򥵥ݡ��Ȥ��Ƥ��ޤ��󡣥ǡ����١�������³��ˡ��ľ���Ƥ�������)");


/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
define('_MEMBERS_USEAUTOSAVE',				'���񤭤μ�ư��¸��ǽ��ͭ��ˤ��ޤ���?');

define('_TEMPLATE_PLUGIN_FIELDS',			'�ץ饰����ˤ���ĥ�ե������');
define('_TEMPLATE_BLOGLIST',				'Blog����');
define('_TEMPLATE_BLOGHEADER',				'Blog�����Υإå���');
define('_TEMPLATE_BLOGITEM',				'Blog����������');
define('_TEMPLATE_BLOGFOOTER',				'Blog�����Υեå���');

define('_SETTINGS_DEFAULTLISTSIZE',			'�����δ����ɽ����');
define('_SETTINGS_DEBUGVARS',				'�ǥХå��⡼�ɤ�ͭ��ˤ���');

define('_CREATE_ACCOUNT_TITLE',				'��������Ȥο�������');
define('_CREATE_ACCOUNT0',					'��������Ȥκ���');
define('_CREATE_ACCOUNT1',					'��������Ȥκ����ϵ��Ĥ���Ƥ��ޤ���<br /><br />');
define('_CREATE_ACCOUNT2',					'�ܺ٤ϥ����֥����Ȥδ���Ԥˤ��䤤��碌����������');
define('_CREATE_ACCOUNT_USER_DATA',			'������������Ȥξ���');
define('_CREATE_ACCOUNT_LOGIN_NAME',		'�?����ID (ɬ��)��');
define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',	' a-z �αѾ�ʸ��� 0-9 �ο���Τ߻��ѤǤ��ޤ�');
define('_CREATE_ACCOUNT_REAL_NAME',			'�ϥ�ɥ� (ɬ��)��');
define('_CREATE_ACCOUNT_EMAIL',				'�᡼�륢�ɥ쥹 (ɬ��)��');
define('_CREATE_ACCOUNT_EMAIL2',			'(�����ƥ��١�������ѤΥ�󥯤�������Τ�ͭ��ʤ�Τ���Ѥ��Ƥ�������)');
define('_CREATE_ACCOUNT_URL',				'(�⤷�����)��ʬ�Υ����Ȥ�URL��');
define('_CREATE_ACCOUNT_SUBMIT',			'��������Ȥκ���');

define('_BMLET_BACKTODRAFTS',				'�ɥ�եȤ��᤹');
define('_BMLET_CANCEL',						'����󥻥�');

define('_LIST_ITEM_NOCONTENT',						'�����ȤϤ���ޤ���');
define('_LIST_ITEM_COMMENTS',						'������(%d)��');

define('_EDITC_URL',								'Web site');
define('_EDITC_EMAIL',								'E-mail');

define('_MANAGER_PLUGINFILE_NOTFOUND',				"�ץ饰�����%s�פ��ɤ߹���ޤ���Ǥ���(�ե����뤬���Ĥ���ޤ���)");
/* changed */
// plugin dependency
define('_ERROR_INSREQPLUGIN',				'�ץ饰���� %s �����󥹥ȡ��뤵��Ƥ��ʤ�����˥��󥹥ȡ��뤹�뤳�Ȥ��Ǥ��ޤ���Ǥ�����');
define('_ERROR_DELREQPLUGIN',				'�ץ饰���� %s �����Υץ饰����˰�¸���Ƥ���٤˺��Ǥ��ޤ���');

//define('_ADD_ADDLATER',						'����ɲ�');
define('_ADD_ADDLATER',						'�������ꤷ���ɲ�');	// <mod by shizuki />

define('_LOGIN_NAME',						'�?����ID:');
define('_LOGIN_PASSWORD',					'�ѥ����:');

// changed from _BOOKMARLET_BMARKLFOLLOW
define('_BOOKMARKLET_BMARKFOLLOW',					' (�ۤȤ�ɤΥ֥饦����ư��ޤ�)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
define('_ADMIN_NOTABILIA',					'��ջ���');
define('_ADMIN_PLEASE_READ',				'�����ˤ����äơ�������<strong>��ջ���</strong> ��ޤ����ɤ߲�����');
define('_ADMIN_HOW_TO_ACCESS',				'������Blog�����������ˡ�����Blog�˥����������뤿�����ˡ��Ҳ𤷤Ƥ����ޤ�����ˡ��2�Ĥ���ޤ�:');
define('_ADMIN_SIMPLE_WAY',					'<strong>��ñ����ˡ:</strong> <code>index.php</code>��ʣ�����ꡢ������Blog��ɽ������褦���ѹ���ä��ޤ��� �����ѹ��ξܺ٤ϡ��������ɽ������ޤ���');
define('_ADMIN_ADVANCED_WAY',				'<strong>���٤���ˡ:</strong> ���ߤ�Blog�ǻ��Ѥ��Ƥ��륹�����<code>&lt;%otherblog()&gt;</code>�Ȥ��������ɤ�Ȥä����Ҥ�ä��ޤ���������ˡ�Ǥϡ�Ʊ���ڡ������ʣ����Blog��ɽ�����뤳�Ȥ���ǽ�Ȥʤ�ޤ���');
define('_ADMIN_HOW_TO_CREATE',				'Blog�κ���');


define('_BOOKMARKLET_NEW_CATEGORY',			'�����ƥ���ɲä��졢���������ƥ��꤬��������ޤ�����');
define('_BOOKMARKLET_NEW_CATEGORY_EDIT',	'�����򥯥�å����ƥ��ƥ��꡼��̾�����������Խ����Ƥ���������');
define('_BOOKMARKLET_NEW_WINDOW',			'������������ɥ��������ޤ�');
define('_BOOKMARKLET_SEND_PING',			'�����ƥ���ɲä�����ޤ���������blog���������ӥ��˹���ping���������ޤ���'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
define('_OVERVIEW_SHOWALL',							'���Ƥ�blog��ɽ��');

// Edit skins
define('_SKINEDIT_ALLOWEDBLOGS',					'�����Ѥߤ�blog:');
define('_SKINEDIT_ALLOWEDTEMPLATESS',				'���Ѳ�ǽ�ʥƥ�ץ졼��:');

// delete member
define('_WARNINGTXT_NOTDELMEDIAFILES',				'���С��ˤ�äƥ��åץ?�ɤ��줿�ե������<b>����ޤ���</b>�Τǵ���Ĥ��Ƥ���������(���ʤ��Ȥ⤳�ΥС������ʲ���Nucleus�ǤϤ����ʤäƤ��ޤ�)');	// <add by shizuki />

// send Weblogupdate.ping
define('_UPDATEDPING_MESSAGE',						'<h2>�����Ȥ���������ޤ�����Ping�����Ф˹��������Τ��ޤ���</h2><p>���Ф餯���Ԥ���������</p><p>��ưŪ�˥ڡ������ڤ��ؤ��ʤ����ϡ�ɽ��������󥯤򥯥�å����Ƥ���������'); // NOTE: This string is no longer in used
define('_UPDATEDPING_GOPINGPAGE',					'����Ping����'); // NOTE: This string is no longer in used
define('_UPDATEDPING_PINGING',						'Ping�����Ф�������Ǥ�'); // NOTE: This string is no longer in used
define('_UPDATEDPING_VIEWITEM',						'�������줿blog:'); // NOTE: This string is no longer in used
define('_UPDATEDPING_VISITOWNSITE',					'�����ȤعԤäƤߤ�'); // NOTE: This string is no longer in used

// General category
define('_EBLOGDEFAULTCATEGORY_NAME',				'���');
define('_EBLOGDEFAULTCATEGORY_DESC',				'��Ƥ��������˹礦���ƥ��̵꤬�����ˤ��Υ��ƥ������Ѥ�����ɤ��Ǥ��礦');

// First ITEM
define('_EBLOG_FIRSTITEM_TITLE',					'�ǽ�ε���(��ư���)');
define('_EBLOG_FIRSTITEM_BODY',						'����Ϥ��ʤ���blog�ˤ�����ǽ�Υ����ƥ�Ǥ�����ͳ�˺��Ƥ��������Ƥ��ޤ��ޤ���');

// New weblog was created
define('_BLOGCREATED_TITLE',						'������blog����������ޤ���');
define('_BLOGCREATED_ADDEDTXT',						'������blog ��%s�פ���������ޤ�����³���ơ�blog�˥����������뤿��˰ʲ��Τɤ��餫�μ��˿ʤ�Ǥ���������');
define('_BLOGCREATED_SIMPLEWAY',					'��ñ����ˡ: ���Υ����ɤ�Ž�դ��� <code>%s.php</code> �Ȥ����ե�������������');
define('_BLOGCREATED_ADVANCEDWAY',					'���٤���ˡ: ���߻��Ѥ��Ƥ��륹����˿�����blog��Ÿ�������뤿��ε��Ҥ�ä���');
define('_BLOGCREATED_SIMPLEDESC1',					'��ˡ 1 :��ñ����ˡ: <code>%s.php</code> �Ȥ����ե���������');
define('_BLOGCREATED_SIMPLEDESC2',					'<code>%s.php</code> �Ȥ����ե������������ơ���Ȥ˰ʲ��Υ����ɤ�Ž���դ��ޤ�:');
define('_BLOGCREATED_SIMPLEDESC3',					'���Ǥˤ���<code>index.php</code>��Ʊ���ǥ��쥯�ȥ�˥��åץ?�ɤ��ޤ���');
define('_BLOGCREATED_SIMPLEDESC4',					'������blog�κ�����λ���뤿��ˡ����Υե������URL�����Ϥ��Ƥ���������(<em>¿ʬ</em>���ϺѤߤ��ͤǹ�äƤ���Ȥϻפ��ޤ����ݾڤϤǤ��ޤ���):');
define('_BLOGCREATED_ADVANCEDWAY2',					'��ˡ 2 :���٤���ˡ: ���߻��Ѥ��Ƥ��륹����˿�����blog��Ÿ�����뵭�Ҥ�ä���');
define('_BLOGCREATED_ADVANCEDWAY3',					'������blog�κ�����λ���뤿���URL�����Ϥ��Ƥ���������(�ۤȤ�ɤξ���¸blog��Ʊ��URL�ˤʤ�ޤ�)');

// Donate!
define('_ADMINPAGEFOOT_OFFICIALURL',				'http://japan.nucleuscms.org/');
define('_ADMINPAGEFOOT_DONATEURL',					'http://japan.nucleuscms.org/donate.php');
define('_ADMINPAGEFOOT_DONATE',						'���դˤĤ���');
define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group &amp; Nucleus CMS Japan������');

// Quick menu
define('_QMENU_MANAGE_SYSTEM',						'�����ƥ�Ķ�');

// REG file
define('_WINREGFILE_TEXT',							'��%s�פ˵��������');

// Bookmarklet
define('_BOOKMARKLET_TITLE',						'�֥å��ޡ�����å�<!-- �� ������å���˥塼 -->');
define('_BOOKMARKLET_DESC1',						'�֥å��ޡ�����åȡ�Bookmarklet�ˤȤϡ�Web�֥饦���Υ֥å��ޡ�������Ͽ���ƻȤ�JavaScript�ץ?���Ǥ���<br />');
define('_BOOKMARKLET_DESC2',						'Nucleus�ˤϡؤ���������٤ޤ��ϡإ֥å��ޡ����ġ���С��٤���Ͽ�Ǥ�������å��ҤȤĤ� blog �ؤ���Ʋ��̤򳫤���ǽ��֥饦�����ɲä��뤳�Ȥ�����ޤ���<br />');
define('_BOOKMARKLET_DESC3',						'Web�����Ȥ򸫤Ƥ��Ƥ��Υڡ����˥�󥯤�ĥ�ä���Ƥ򤷤����Ȼפä����˥֥å��ޡ�����åȤ���Ѥ���С����Υ�����(�ڡ���)�ؤΥ�󥯤��񤭹��ޤ줿���֤ǡ�');
define('_BOOKMARKLET_DESC4',						'����ˡ����Υڡ������ʸ�Ϥ����򤷤����֤ǻ��Ѥ�����硢���򤵤�Ƥ���ʸ�Ϥ���ưŪ�˰��Ѥ��줿���֤ǡ�Nucleus�ο��������ƥ���ɲå�����ɥ����ݥåץ��åפ��ޤ���<br />');
define('_BOOKMARKLET_DESC5',						'�ޤ�Windows Internet Explorer�ΤߤǤ��������ε�ǽ�򱦥���å���˥塼����Ͽ���뤳�Ȥ����ޤ���');
define('_BOOKMARKLET_BOOKARKLET',					'�֥å��ޡ�����å�');
define('_BOOKMARKLET_ANCHOR',						'��%s�פ˵��������');
define('_BOOKMARKLET_BMARKTEXT',					' ���Υ�󥯤�֤���������פ⤷���ϡ֥֥å��ޡ����פ��ɲä��Ƥ����������ɲäλ���Ϥ��줾��Υ֥饦���Υإ�פ򻲾Ȥ��Ƥ���������<br />');
define('_BOOKMARKLET_BMARKTEST',					' (�ƥ��Ȥ��Ƥߤ������ϲ��Υ�󥯤򥯥�å����ƤߤƤ�������)');
define('_BOOKMARKLET_RIGHTCLICK',					'������å���˥塼�˥��󥹥ȡ���(Windows Internet Explorer�Τ�)');
define('_BOOKMARKLET_RIGHTLABEL',					'������å���˥塼');
define('_BOOKMARKLET_RIGHTTEXT1',					'Windows�ǥ��󥿡��ͥåȥ������ץ?�顼����Ѥ��Ƥ�����ϡ�');
define('_BOOKMARKLET_RIGHTTEXT2',					'�˥��󥹥ȡ��뤹�뤳�Ȥ����ޤ�<br />(�ֳ����פ����򤹤��ľ�ܥ쥸���ȥ����Ͽ���ޤ�)');
define('_BOOKMARKLET_RIGHTTEXT3',					'���Υ��󥹥ȡ��뤷��������å���˥塼��ɽ�����뤿��ˤ�IE�κƵ�ư��ɬ�פǤ���');
define('_BOOKMARKLET_UNINSTALLTT',					'���󥤥󥹥ȡ���');
define('_BOOKMARKLET_DELETEBAR',					'�֤���������פ⤷���ϥġ���С�����ä��ˤϡ�ñ�˺�������Ǥ���');
define('_BOOKMARKLET_DELETERIGHTT',					'������å���˥塼����ä��������ϡ��ʲ��μ���Ƨ��Ǥ�������:');
define('_BOOKMARKLET_DELETERIGHT1',					'�������ȥ�˥塼����֥ե��������ꤷ�Ƽ¹�...�פ�����');
define('_BOOKMARKLET_DELETERIGHT2',					'"regedit" ������');
define('_BOOKMARKLET_DELETERIGHT3',					'"OK" �ܥ���򲡤�');
define('_BOOKMARKLET_DELETERIGHT4',					'"\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" ��ĥ꡼���椫�鸡��');
define('_BOOKMARKLET_DELETERIGHT5',					'"��(���ʤ���blog��̾��)�פ˵��������" ����ȥ����');

define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'�������ְ�äƤ��ޤ�');
define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'���������ƥ�����뤳�Ȥ�����ޤ���Ǥ���');

// BAN
define('_BAN_EXAMPLE_TITLE',						'��');
define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193"�����Ϥ������ϡ�����IP���ɥ쥹����PC1�������֥�å����ޤ���"134.58.253"�����Ϥ������ϡ�"134.58.235.0��134.58.235.255"���ϰϤ�256�Ĥ�IP���ɥ쥹����PC�����ƥ֥�å����ޤ�������ϡ����Ԥ�IP���ɥ쥹(134.58.253.193)��ޤߤޤ���');
define('_BAN_IP_CUSTOM',							'�֥�å�����: ');
define('_BAN_BANBLOGNAME',							'%s �Τ�');

// Plugin Options
define('_PLUGIN_OPTIONS_TITLE',						'%s �Υ��ץ��������');

// Plugin file loda error
define('_PLUGINFILE_COULDNT_BELOADED',				'���顼: �ץ饰����ե����� <strong>%s.php</strong> ���ɤ߹���ޤ���Ǥ������ե����뤬¸�ߤ��ʤ����⤯�ϻ������ Nucleus ���ư����뤿���ɬ�פʵ�ǽ���ץ饰����ǥ��ݡ��Ȥ���Ƥ��ޤ���(<a href="?action=actionlog">�����������</a>�˾ܺ٤�����ޤ���)');

//ITEM add/edit template (for japanese only)
define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'�ե����ޥåȡ�');
define('_ITEM_ADDEDITTEMPLATE_YEAR',				'ǯ');
define('_ITEM_ADDEDITTEMPLATE_MONTH',				'��');
define('_ITEM_ADDEDITTEMPLATE_DAY',					'��');
define('_ITEM_ADDEDITTEMPLATE_HOUR',				'��');
define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'ʬ');

// Errors
define('_ERRORS_INSTALLSQL',						'��install.sql���ե��������Ƥ�������');
define('_ERRORS_INSTALLDIR',						'��install���ǥ��쥯�ȥ����Ƥ�������');  // <add by shizuki />
define('_ERRORS_INSTALLPHP',						'��install.php���ե��������Ƥ�������');
define('_ERRORS_UPGRADESDIR',						'��nucleus/upgrades���ǥ��쥯�ȥ����Ƥ�������');
define('_ERRORS_CONVERTDIR',						'��nucleus/convert���ǥ��쥯�ȥ����Ƥ�������');
define('_ERRORS_CONFIGPHP',							'��config.php���ե�������ɤ߼������(��chmod 444����)�ˤ��Ƥ�������');
define('_ERRORS_STARTUPERROR1',						'<p>��ġ��ޤ��Ϥ���ʾ��NucleusCMS�Υ��󥹥ȡ���(���åץ��졼��)�ѥե����뤬�����о�˻ĤäƤ��롢�⤷���Ͻ񤭹��߲�ǽ�ˤʤäƤ��ޤ���</p><p>�����Υե��������ޤ��ϥѡ��ߥå������ѹ����ƥ������ƥ�����ݤ��Ƥ���������Nucleus�����Ĥ����ե�����Τ����Ĥ��򼡤˼����ޤ���</p> <ul><li>');
define('_ERRORS_STARTUPERROR2',						'</li></ul><p>���ηٹ��ɽ�����������ʤ����ϡ�<code>globalfunctions.php</code>��<code>$CONF[\'alertOnSecurityRisk\']</code>���ͤ�<code>0</code>�ˤ��뤫��Ʊ�ͤ����Ƥ�<code>config.php</code>�κǸ�˵��Ҥ��ޤ�(�������ƥ���٥뤬������ޤ�)</p>');
define('_ERRORS_STARTUPERROR3',						'�������ƥ� �ꥹ���ηٹ�');

// PluginAdmin tickets by javascript
define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>�����åȤμ�ưȯ����˥��顼��ȯ�����ޤ���</b></p>');

// Global settings disablesite URL
define('_SETTINGS_DISABLESITEURL',					'ž�����URL:');

// Skin import/export
define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'ͽ��ʤ�����');
define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'�ե����롢�ޤ���URL�򳫤���������ޤ���');
define('_SKINIE_NAME_CLASHES_DETECTED',				'������/�ƥ�ץ졼�Ȥ�̾����Ʊ����Τ�����ޤ���allowOverwrite��1�����ꤷ�ơ���񤭥⡼�ɤǺ��ټ¹Ԥ��Ƥ���������');

// ACTIONS.php parse_commentform
define('_ACTIONURL_NOTLONGER_PARAMATER',			'��action.php����URL�ϥ����ȥե������Ѥ��ѿ��Υѥ�᡼�����ǤϤʤ��ʤäƤ��ޤ�����������ώ����?�Х����ꎣ�˰�ư���ޤ���');

// ADMIN.php addToTemplate 'Query error: '
define('_ADMIN_SQLDIE_QUERYERROR',					'������ ���顼: ');

// backup.php Backup WARNING
define('_BACKUP_BACKUPFILE_TITLE',					'Nucleus CMS �Υǡ����١����Хå����åץե�����Ǥ�');
define('_BACKUP_BACKUPFILE_BACKUPDATE',				'�Хå����åפ�����:');
define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Nucleus CMS �ΥС������:');
define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nucleus CMS �Υǡ����١�����̾��:');
define('_BACKUP_BACKUPFILE_TABLE_NAME',				'�ơ��֥�ι�¤ :');
define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'%s �ơ��֥�Υ���ץǡ���');
define('_BACKUP_WARNING_NUCLEUSVERSION',				'��ա�: �Хå����åפ���ǡ����١��������ݤϡ�Nucleus�ΥС�����󤬥Хå����åפ������������Ʊ����Τ��褯��ǧ���Ƥ���������');
define('_BACKUP_RESTOR_NOFILEUPLOADED',				'�ե����뤬���åץ?�ɤ���Ƥ��ޤ���');
define('_BACKUP_RESTOR_UPLOAD_ERROR',				'���åץ?����˥��顼��ȯ�����ޤ���');
define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'���åץ?�ɤ��줿�ե�����η����������Ǥ�');
define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'���̷����ΥХå����åץե���������Ǥ��ޤ���Ǥ���(��zlib���饤�֥�꤬���󥹥ȡ��뤵��Ƥ��ޤ���)');
define('_BACKUP_RESTOR_SQL_ERROR',					'SQL ���顼: ');

// BLOG.php addTeamMember
define('_TEAM_ADD_NEWTEAMMEMBER',					'%s(ID=%d) �򡢥֥? "%s" �Υ�����˲ä��ޤ���');

// ADMIN.php systemoverview()
define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'�����ƥ�Ķ�����');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL',			'PHP �� MySQL');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'�С������');
define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'PHP �ΥС������');
define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'MySQL �ΥС������');
define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'PHP ������');
define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'GD �饤�֥��');
define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Apache �⥸�塼��');
define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'ͭ��');
define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'̵��');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Nucleus �Υ����ƥ�ˤĤ���');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Nucleus �ΥС������');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Nucleus �Υѥå���٥�');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'���פ�����');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'�С����������å�');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'��꿷�����С������Υ�꡼����̵�����������Ȥǥ����å��Ǥ��ޤ�: ');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://japan.nucleuscms.org/version.php?v=%d&amp;pl=%d');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'�ǿ��ΥС�����������å�');
define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			'���β��̤�������븢�¤�����ޤ���');

// ENCAPSULATE.php
define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'����ȥ꡼������ޤ���');

// globalfunctions.php
define('_GFUNCTIONS_LOGINPCSHARED_YES',				'��ͭPC����Υ?����');
define('_GFUNCTIONS_LOGINPCSHARED_NO',				'��ͭ�ǤϤʤ�PC����Υ?����');
define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'%s ���?���󤷤ޤ��� (%s)');
define('_GFUNCTIONS_LOGINFAILED_TXT',				'%s ���?����˼��Ԥ��ޤ���');
define('_GFUNCTIONS_LOGOUT_TXT',					'%s ���?�����Ȥ��ޤ���');
define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		'<code>%s</code> �� <code>%s</code> ���ܤ�');
define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		'HTTP�إå��������ѤߤǤ�');
define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>%s���Ǥ˥ڡ�����HTTP�إå������Ф���Ƥ��ꡢNucleus�������ư��ʤ��ʤ��ǽ��������ޤ���</p><p><code>config.php</code>���󥲡����ե����롢����¾�ץ饰����Υե�����ν����ˡ�;ʬ�ʲ��Ԥ�ʸ���󤬤ʤ�����ǧ���Ƥ⤦�����ɥ����������ƤߤƤ���������</p><p>����Ū�ʲ��򤻤��ˤ��Υ�å�������ɽ�������ʤ�����ˤϡ�<code>globalfunctions.php</code>����Ƭ��<code>$CONF[\'alertOnHeadersSent\']</code>��<code>0</code>�����ꤷ�ޤ���</p>');
define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'�ե����뤬���Ĥ���ޤ���');
define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'���顼��ȯ�����ޤ���');
define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			'�?���󤷤Ƥ��ޤ���');

// MANAGER.php
define('_MANAGER_PLUGINFILE_NOCLASS',				"�ץ饰�����%s�פ��ɤ߹���ޤ���Ǥ���(�ե�������˥ץ饰���󥯥饹��¸�ߤ��ޤ���)");
define('_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT',		"�ץ饰�����%s�פ��ɤ߹���ޤ���Ǥ���(��SqlTablePrefix���򥵥ݡ��Ȥ��Ƥ��ޤ���)");

// mysql.php
define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>Nucleus��ư�����Τ�ɬ�פ�mySQL�ѤΥ饤�֥�꤬���󥹥ȡ��뤵��Ƥ��ޤ���</p>");

// PLUGIN.php
define('_ERROR_PLUGIN_NOSUCHACTION',				'���ꤵ�줿����������¸�ߤ��ޤ���');

// PLUGINADMIN.php
define('_ERROR_INVALID_PLUGIN',						'�����ʥץ饰����Ǥ�');

// showlist.php
define('_LIST_PLUGS_DEPREQ',						'���Υץ饰����˰�¸����ץ饰����:');
define('_LIST_SKIN_PREVIEW',						"'%s' ������Υץ�ӥ塼");
define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"�礭�ʲ���򸫤�");
define('_LIST_SKIN_README',							"'%s' ������ˤĤ��Ƥ�äȾܤ���");
define('_LIST_SKIN_README_TXT',						'Read me');

// BLOG.php createNewCategory()
define('_CREATED_NEW_CATEGORY_NAME',				'���������ƥ���');
define('_CREATED_NEW_CATEGORY_DESC',				'���������ƥ��������');

// ADMIN.php blog settings
define('_EBLOG_CURRENT_TEAM_MEMBER',				'���Υ֥?������θ��ߤΥ��С���');

// HTML outputs
define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"');

// Language Files
define('_LANGUAGEFILES_JAPANESE-UTF8',				'���ܸ� - ���ܸ� (UTF-8)');
define('_LANGUAGEFILES_JAPANESE-EUC',				'���ܸ� - ���ܸ� (EUC)');
define('_LANGUAGEFILES_JAPANESE-SJIS',				'���ܸ� - ���ܸ� (Shift-JIS)');
define('_LANGUAGEFILES_ENGLISH-UTF8',				'�Ѹ� - English (UTF-8)');
define('_LANGUAGEFILES_ENGLISH',					'�Ѹ� - English (iso-8859-1)');
/*
define('_LANGUAGEFILES_BULGARIAN',					'�֥륬�ꥢ�� - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
define('_LANGUAGEFILES_CATALAN',					'�������� - Catal&agrave; (iso-8859-1)');
define('_LANGUAGEFILES_CHINESE-GBK',				'���λ����� - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
define('_LANGUAGEFILES_SIMCHINESE',					'���λ����� - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
define('_LANGUAGEFILES_CHINESE-UTF8',				'���λ����� - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CHINESEB5',					'���λ����� - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_CHINESEB5-UTF8',				'���λ����� - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'���λ����� - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'���λ����� - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CZECH',						'�������� - &#268;esky (windows-1250)');
define('_LANGUAGEFILES_FINNISH',					'�ե�����ɸ� - Suomi (iso-8859-1)');
define('_LANGUAGEFILES_FRENCH',						'�ե�󥹸� - Fran&ccedil;ais (iso-8859-1)');
define('_LANGUAGEFILES_GALEGO',						'���ꥷ���� - Galego (iso-8859-1)');
define('_LANGUAGEFILES_GERMAN',						'�ɥ��ĸ� - Deutsch (iso-8859-1)');
define('_LANGUAGEFILES_HUNGARIAN',					'�ϥ󥬥꡼�� - Magyar (iso-8859-2)');
define('_LANGUAGEFILES_ITALIANO',					'�����ꥢ�� - Italiano (iso-8859-1)');
define('_LANGUAGEFILES_KOREAN-EUC-KR',				'�ڹ�� - &#54620;&#44397;&#50612; (euc-kr)');
define('_LANGUAGEFILES_KOREAN-UTF',					'�ڹ�� - &#54620;&#44397;&#50612; (utf-8)');
define('_LANGUAGEFILES_LATVIAN',					'��ȥӥ��� - Latvie&scaron;u (windows-1257)');
define('_LANGUAGEFILES_NEDERLANDS',					'�������� - Nederlands (iso-8859-15)');
define('_LANGUAGEFILES_PERSIAN',					'�ڥ륷���� - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'�֥饸��-�ݥ�ȥ���� - Portugu&ecirc;s (iso-8859-1)');
define('_LANGUAGEFILES_RUSSIAN',					'�?���� - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
define('_LANGUAGEFILES_SLOVAK',						'����٥����� - Sloven&#269;ina (ISO-8859-2)');
define('_LANGUAGEFILES_SPANISH-UTF8',				'���ڥ���� - Espa&ntilde;ol (utf-8)');
define('_LANGUAGEFILES_SPANISH',					'���ڥ���� - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
define('_AUTOSAVEDRAFT',					'�ɥ�ե���¸����');
define('_AUTOSAVEDRAFT_LASTSAVED',			'�ǽ��ɥ�ե���¸���: ');
define('_AUTOSAVEDRAFT_NOTYETSAVED',		'��¸����Ƥ��ޤ���');
define('_AUTOSAVEDRAFT_NOW',				'�ɥ�ե���¸');
define('_SKIN_PARTS_SPECIAL',				'���ڥ���륹����ѡ���');
define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',	'�ѿ���ʳ���ʸ��ϻȤ��ޤ���');
define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',	'���Υ�����ѡ��Ĥ���Ǥ��ޤ���');
define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',	'�����ˤ��Υ��ڥ���륹����ѡ��Ĥ���Ƥ⤤���Ǥ�����');
define('_ERROR_PLUGIN_LOAD',				'Nucleus�Υץ饰����Ȥ���ɬ�פʥ᥽�åɤ��ץ饰����ǥ��ݡ��Ȥ���Ƥ��ʤ������ץ饰����ե����뤬��������ޤ���(<a href="?action=actionlog">�����������</a>�˾ܺ٤�����ޤ���)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
define('_SEARCHFORM_QUERY',					'�����������');
define('_ERROR_EMAIL_REQUIRED',				'�᡼�륢�ɥ쥹��ɬ�פǤ�');
define('_COMMENTFORM_MAIL',					'���ʤ��Υ����Ȥ�URL:');
define('_COMMENTFORM_EMAIL',				'�᡼�륢�ɥ쥹:');
define('_EBLOG_REQUIREDEMAIL',				'�����Ȼ��˥᡼�륢�ɥ쥹���׵᤹��');
define('_ERROR_COMMENTS_SPAM',              '���ʤ��Υ����Ȥϡ����ѥ�ƥ��Ȥη�̵��ݤ���ޤ���');
// END changed/added after 3.22 END

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE',		'����Ͽ�ꥹ�ȤΥ��åץǡ��Ȏ��ܥ���򥯥�å����ƥ��٥�Ⱦ���򹹿����Ƥ�������');
define('_LIST_PLUGS_DEP',					'��¸����ץ饰����:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',					'�����ȤΥꥹ��:');
define('_NOCOMMENTS_BLOG',					'����blog�ˤϤޤ������Ȥ��Ĥ����Ƥ��ޤ���');
define('_BLOGLIST_COMMENTS',				'������');
define('_BLOGLIST_TT_COMMENTS',				'����blog�ˤĤ���줿�����ȤΥꥹ��');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',					'��');
define('_ARCHIVETYPE_MONTH',				'��');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',					'�����åȤ��������⤷���ϴ���ڤ�Ǥ�');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',			'Cookie �ץ�ե��å���');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',			'ǧ���ѥ�󥯤������Ǥ��ޤ��󡣤��ʤ��Υ?����ϵ��Ĥ���Ƥ��ޤ���');
define('_ERROR_ACTIVATE',					'ǧ�ڥ�����¸�ߤ��ʤ�����̵�����뤤�ϴ���ڤ�Ǥ���');
define('_ACTIONLOG_ACTIVATIONLINK',			'ǧ���ѥ�󥯤���������ޤ�����');
define('_MSG_ACTIVATION_SENT',				'ǧ���ѥ�󥯤�᡼����������ޤ�����');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',			"����ˤ��� <%memberName%>\n\n<%siteName%> (<%siteUrl%>)�ˤ����륢������Ȥ�ͭ��ˤ��ʤ���Фʤ�ޤ���\n���Υ�󥯤򥯥�å����ƥ����ƥ��١�������ԤäƤ�����������\n\n\t<%activationUrl%>\n\n�����ƥ��١�������Ѥ�URL��ͭ���¤�2��֤Ǥ�������ʹߤ�̵��ˤʤ�ޤ��Τ����˹ԤäƤ���������");
define('_ACTIVATE_REGISTER_MAILTITLE',		"���������'<%memberName%>'�Υ����ƥ��١������");
define('_ACTIVATE_REGISTER_TITLE',			'�褦���� <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',			'��������Ⱥ����Ϥܴۤ�λ���ޤ��������Υե�����ǥ�������ȤΥѥ���ɤ����ꤷ�Ƥ���������');
define('_ACTIVATE_FORGOT_MAIL',				"����ˤ��� <%memberName%>\n\n���Υ�󥯤��顢����<%siteName%> (<%siteUrl%>)�ˤ����뿷�����ѥ���ɤ����ꤹ�뤳�Ȥ��Ǥ��ޤ���\n\n\t<%activationUrl%>\n\n�����ƥ��١�������Ѥ�URL��ͭ���¤�2��֤Ǥ�������ʹߤ�̵��ˤʤ�ޤ��Τ����˹ԤäƤ���������");
define('_ACTIVATE_FORGOT_MAILTITLE',		"���������'<%memberName%>'�κ�ǧ��");
define('_ACTIVATE_FORGOT_TITLE',			'�褦���� <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',				'���Υե�����ǿ������ѥ���ɤ�����Ǥ��ޤ���');
define('_ACTIVATE_CHANGE_MAIL',				"����ˤ��� <%memberName%>\n\n�᡼�륢�ɥ쥹���ѹ�����ޤ�����\n\n<%siteName%> (<%siteUrl%>)�ˤ����륢������Ȥ��ǧ�ڤ���ɬ�פ�����ޤ���\n���Υ�󥯤򥯥�å����ƥ����ƥ��١�������ԤäƤ�����������\n\n\t<%activationUrl%>\n\n�����ƥ��١�������Ѥ�URL��ͭ���¤�2��֤Ǥ�������ʹߤ�̵��ˤʤ�ޤ��Τ����˹ԤäƤ���������");
define('_ACTIVATE_CHANGE_MAILTITLE',		"���������'<%memberName%>'�κ�ǧ��");
define('_ACTIVATE_CHANGE_TITLE',			'�褦���� <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',				'�᡼�륢�ɥ쥹���ѹ�����ǧ����ޤ�����');
define('_ACTIVATE_SUCCESS_TITLE',			'�����ƥ��١�����������ޤ���');
define('_ACTIVATE_SUCCESS_TEXT',			'�����ƥ��١�����������ޤ�����');
define('_MEMBERS_SETPWD',					'�ѥ���ɤ����ꤹ��');
define('_MEMBERS_SETPWD_BTN',				'�ѥ���ɤ�����');
define('_QMENU_ACTIVATE',					'�����ƥ��١������');
define('_QMENU_ACTIVATE_TEXT',				'<p>�����ƥ��١�������λ����С�<a href="index.php?action=showlogin">�?����</a>���Ƥ������ѤǤ��ޤ���</p>');

define('_PLUGS_BTN_UPDATE',					'��Ͽ�ꥹ�ȤΥ��åץǡ���');

// global settings
define('_SETTINGS_JSTOOLBAR',				'Javascript�ġ���С��Υ�������');
define('_SETTINGS_JSTOOLBAR_FULL',			'�ե롦�ġ���С�(IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE',		'����ץ롦�ġ���С�(IE�ʳ�)');
define('_SETTINGS_JSTOOLBAR_NONE',			'�ġ���С���Ȥ�ʤ�');
define('_SETTINGS_URLMODE_HELP',			'(���͡�<a href="documentation/tips.html#searchengines-fancyurls">FancyURL��ͭ��ˤ�����ˡ</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',					'�ץ饰����ˤ���ɲ�����');

// itemlist info column keys
define('_LIST_ITEM_BLOG',					'blog:');
define('_LIST_ITEM_CAT',					'cat:');
define('_LIST_ITEM_AUTHOR',					'���:');
define('_LIST_ITEM_DATE',					'����:');
define('_LIST_ITEM_TIME',					'����:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 			'(���С�)');

// batch operations
define('_BATCH_WITH_SEL',					'���򤵤줿��Τ�');
define('_BATCH_EXEC',						'�¹�');

// quickmenu
// Note: _USER_SETTINGS �� _MANAGE_SETTINGS �� 3.3 �ʹߡ����ꥸ�ʥ��Ǥ�
// �ѹ�����ޤ����������ܸ��Ǥ�ɽ���򤽤ΤޤޤȤ��ޤ���
// �ְ�äƹ������ʤ��褦��!!
define('_QMENU_HOME',						'����ۡ���');
define('_QMENU_ADD',						'�����ƥ��ɲ�');
define('_QMENU_ADD_SELECT',					'- blog���� -');
define('_QMENU_USER_SETTINGS',				'���ʤ�������');
define('_QMENU_USER_ITEMS',					'���ʤ��Υ����ƥ�');
define('_QMENU_USER_COMMENTS',				'���ʤ��Υ�����');
define('_QMENU_MANAGE',						'�����ȴ���');
define('_QMENU_MANAGE_LOG',					'�����������');
define('_QMENU_MANAGE_SETTINGS',			'���?�Х�����');
define('_QMENU_MANAGE_MEMBERS',				'���С�����');
define('_QMENU_MANAGE_NEWBLOG',				'����Blog����');
define('_QMENU_MANAGE_BACKUPS',				'DB��¸/��');
define('_QMENU_MANAGE_PLUGINS',				'�ץ饰�������');
define('_QMENU_LAYOUT',						'�쥤����������');
define('_QMENU_LAYOUT_SKINS',				'�������Խ�');
define('_QMENU_LAYOUT_TEMPL',				'�ƥ�ץ졼���Խ�');
define('_QMENU_LAYOUT_IEXPORT',				'�ɹ�/���');
define('_QMENU_PLUGINS',					'�ץ饰����');

// quickmenu on logon screen
define('_QMENU_INTRO',						'Ƴ��������');
define('_QMENU_INTRO_TEXT',					'<p>�����ϥ����֥����Ȥδ����Ԥ�����ƥ�Ĵ���ƥࡢ��Nucleus CMS�פΥ?������̤Ǥ���</p><p>��������Ȥ��äƤ���Х?���󤷤ƿ�������������Ƥ��Ǥ��ޤ���</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',				'���Υץ饰�����ѤΥإ�ץե����뤬���Ĥ���ޤ���');
define('_PLUGS_HELP_TITLE',					'�ץ饰����Υإ�ץڡ���');
define('_LIST_PLUGS_HELP', 					'�إ��');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',					'����ǧ�ڤ�ͭ��');
define('_WARNING_EXTAUTH',					'�ٹ�:ɬ�פʻ��ʳ���ͭ��ˤ��ʤ�');

// member profile
define('_MEMBERS_BYPASS',					'����ǧ�ڤ���Ѥ���');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',						'<em>���</em>�����оݤˤ���');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',						'ɽ��');
define('_MEDIA_VIEW_TT',					'�ե�����ɽ�� (������������ɥ��������ޤ�)');
define('_MEDIA_FILTER_APPLY',				'�ե��륿��Ŭ��');
define('_MEDIA_FILTER_LABEL',				'�ե��륿��: ');
define('_MEDIA_UPLOAD_TO',					'���åץ?����...');
define('_MEDIA_UPLOAD_NEW',					'�������åץ?��...');
define('_MEDIA_COLLECTION_SELECT',			'����');
define('_MEDIA_COLLECTION_TT',				'���Υ��ƥ��꡼���ڤ��ؤ�');
define('_MEDIA_COLLECTION_LABEL',			'���ߤΥ��쥯�����: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',					'����');
define('_ADD_ALIGNRIGHT_TT',				'����');
define('_ADD_ALIGNCENTER_TT',				'����');


// generic upload failure
define('_ERROR_UPLOADFAILED',				'���åץ?�ɤ˼��Ԥ��ޤ���');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',			'��������Ǥ���Ƥ���Ĥ���');
define('_ADD_CHANGEDATE',					'�����ॹ����פ򹹿�');
define('_BMLET_CHANGEDATE',					'�����ॹ����פ򹹿�');

// skin import/export
define('_OVERVIEW_SKINIMPORT',				'�ɹ�/���');

// skin settings
define('_PARSER_INCMODE_NORMAL',			'�Ρ��ޥ�');
define('_PARSER_INCMODE_SKINDIR',			'skindir��Ȥ�');
define('_SKIN_INCLUDE_MODE',				'Include�⡼��');
define('_SKIN_INCLUDE_PREFIX',				'Include�ץ�ե��å���');

// global settings
define('_SETTINGS_BASESKIN',				'���ܤΥ�����');
define('_SETTINGS_SKINSURL',				'������URL');
define('_SETTINGS_ACTIONSURL',				'��http://�פ���Ϥޤ� action.php ��URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',			'�ǥե���ȤΥ��ƥ��꡼�ϰ�ư�Ǥ��ޤ���');
define('_ERROR_MOVETOSELF',					'���ƥ��꡼���ư�Ǥ��ޤ��� (��ư���Blog����ư����Ʊ���Ǥ�)');
define('_MOVECAT_TITLE',					'���ƥ��꡼���ư����Blog�����򤷤Ƥ�������');
define('_MOVECAT_BTN',						'���ƥ��꡼���ư');

// URLMode setting
define('_SETTINGS_URLMODE',					'URL �⡼��');
define('_SETTINGS_URLMODE_NORMAL',			'Normal');
define('_SETTINGS_URLMODE_PATHINFO',		'Fancy');

// Batch operations
define('_BATCH_NOSELECTION',				'�оݤ����򤵤�Ƥ��ޤ���');
define('_BATCH_ITEMS',						'�����ƥࡡ�������Ф��ƤΥХå����');
define('_BATCH_CATEGORIES',					'���ƥ��꡼�������Ф��ƤΥХå����');
define('_BATCH_MEMBERS',					'���С����������Ф��ƤΥХå����');
define('_BATCH_TEAM',						'��������С����Ф��ƤΥХå����');
define('_BATCH_COMMENTS',					'�����ȡ��������Ф��ƤΥХå����');
define('_BATCH_UNKNOWN',					'̤�ΤΥХå����: ');
define('_BATCH_EXECUTING',					'�¹���');
define('_BATCH_ONCATEGORY',					'- �оݥ��ƥ��꡼');
define('_BATCH_ONITEM',						'- �оݥ����ƥ�');
define('_BATCH_ONCOMMENT',					'- �оݥ�����');
define('_BATCH_ONMEMBER',					'- �оݥ��С�');
define('_BATCH_ONTEAM',						'- �оݥ�������С�');
define('_BATCH_SUCCESS',					'����!');
define('_BATCH_DONE',						'��λ!');
define('_BATCH_DELETE_CONFIRM',				'�Хå����γ�ǧ');
define('_BATCH_DELETE_CONFIRM_BTN',			'�Хå����γ�ǧ');
define('_BATCH_SELECTALL',					'��������');
define('_BATCH_DESELECTALL',				'���Ƥ��������');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',				'���');
define('_BATCH_ITEM_MOVE',					'��ư');
define('_BATCH_MEMBER_DELETE',				'���');
define('_BATCH_MEMBER_SET_ADM',				'����Ը��¤�Ϳ����');
define('_BATCH_MEMBER_UNSET_ADM',			'����Ը��¤򳰤�');
define('_BATCH_TEAM_DELETE',				'�����फ����');
define('_BATCH_TEAM_SET_ADM',				'����Ը��¤�Ϳ����');
define('_BATCH_TEAM_UNSET_ADM',				'����Ը��¤򳰤�');
define('_BATCH_CAT_DELETE',					'���');
define('_BATCH_CAT_MOVE',					'¾��Blog�˰�ư');
define('_BATCH_COMMENT_DELETE',				'���');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',					'�����������ƥ���ɲ�...');
define('_ADD_PLUGIN_EXTRAS',				'�ɲåץ饰���󥪥ץ����');

// errors
define('_ERROR_CATCREATEFAIL',				'���������ƥ��꡼������Ǥ��ޤ���');
define('_ERROR_NUCLEUSVERSIONREQ',			'���Υץ饰�������Ѥ���ˤϡ��������С������� Nucleus ��ɬ�פǤ�: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',				'Blog����������');

// skin import export
define('_SKINIE_TITLE_IMPORT',				'�ɤ߹���');
define('_SKINIE_TITLE_EXPORT',				'�񤭽Ф�');
define('_SKINIE_BTN_IMPORT',				'�ɤ߹���');
define('_SKINIE_BTN_EXPORT',				'���򤵤줿������/�ƥ�ץ졼�Ȥ�񤭽Ф�');
define('_SKINIE_LOCAL',						'�?����ե����뤫���ɤ߹���:');
define('_SKINIE_NOCANDIDATES',				'������ǥ��쥯�ȥ�����ɤ߹����ե����뤬����ޤ���');
define('_SKINIE_FROMURL',					'URL����ꤷ���ɤ߹���:');
define('_SKINIE_EXPORT_INTRO',				'�񤭽Ф�������/�ƥ�ץ졼�Ȥ�ʲ��������򤷤Ƥ�������');
define('_SKINIE_EXPORT_SKINS',				'������');
define('_SKINIE_EXPORT_TEMPLATES',			'�ƥ�ץ졼��');
define('_SKINIE_EXPORT_EXTRA',				'�ɲþ���ʽ񤭽Ф��ե�������ɲä������͡�');
define('_SKINIE_CONFIRM_OVERWRITE',			'���¸�ߤ��륹������񤭤��� (�֤Ĥ��륹����̾�򻲾�)');
define('_SKINIE_CONFIRM_IMPORT',			'�Ϥ���������ɤ߹��ߤޤ�');
define('_SKINIE_CONFIRM_TITLE',				'������ȥƥ�ץ졼�Ȥ��ɤ߹��⤦�Ȥ��Ƥ��ޤ�');
define('_SKINIE_INFO_SKINS',				'�ե�������Υ�����:');
define('_SKINIE_INFO_TEMPLATES',			'�ե�������Υƥ�ץ졼��:');
define('_SKINIE_INFO_GENERAL',				'����:');
define('_SKINIE_INFO_SKINCLASH',			'���Υ�����̾���֤Ĥ���ޤ�:');
define('_SKINIE_INFO_TEMPLCLASH',			'���Υƥ�ץ졼��̾���֤Ĥ���ޤ�:');
define('_SKINIE_INFO_IMPORTEDSKINS',		'�ɤ߹��ޤ줿������:');
define('_SKINIE_INFO_IMPORTEDTEMPLS',		'�ɤ߹��ޤ줿�ƥ�ץ졼��:');
define('_SKINIE_DONE',						'�ɤ߹��ߴ�λ');

define('_AND',								'and');
define('_OR',								'or');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',				'̵��(����å�����ȥե����ब�����ޤ�)');

// skin overview list
define('_LIST_SKINS_INCMODE',				'Include�⡼��:');
define('_LIST_SKINS_INCPREFIX',				'Include�ץ�ե��å���:');
define('_LIST_SKINS_DEFINED',				'����Ѥߥѡ���:');

// backup
define('_BACKUPS_TITLE',					'�Хå����å� / �ꥹ�ȥ�');
define('_BACKUP_TITLE',						'�Хå����å�');
define('_BACKUP_INTRO',						'���Υܥ���򲡤��ȡ�Nucleus�����Ѥ��Ƥ���ǡ����١�����Хå����åפǤ��ޤ����Хå����åץե�����ϰ����ʾ�����¸���Ƥ������Ȥ򤪴��ᤷ�ޤ���');
define('_BACKUP_ZIP_YES',					'���̤���');
define('_BACKUP_ZIP_NO',					'���̤��ʤ�');
define('_BACKUP_BTN',						'�Хå����åפ��������');
define('_BACKUP_NOTE',						'<b style="color:#f00;">���:</b> �Хå����åפ����Τϥǡ����١��������Ƥ����Ǥ������åץ?�ɤ����ե������ config.php �������ϥХå����å�<b style="color:#f00;">����ޤ���</b>��');
define('_RESTORE_TITLE',					'�ꥹ�ȥ�');
define('_RESTORE_NOTE',						'<b style="color:#f00;">�ٹ�:</b> �Хå����åפ���Υꥹ�ȥ��ϸ��ߤΥǡ����١������ Nucleus �ǡ���������<b style="color:#f00;">���</b>���ޤ����ɤ���դ��ƻ��Ѥ��Ƥ���������<br /><b style="color:#f00;">���:</b> �Хå����åפ�������� Nucleus �ΥС������ ���߻��Ѥ��Ƥ��� Nucleus �ΥС�������Ʊ������ǧ���Ƥ��������������Ǥʤ����������ư��ޤ���');
define('_RESTORE_INTRO',					'�ʲ�����Хå����åץե����������ʥ����Ф˥��åץ?�ɤ���ޤ��ˤ���"�ꥹ�ȥ�"�ܥ���򲡤��ȳ��Ϥ��ޤ���');
define('_RESTORE_IMSURE',					'�Ϥ����Τ��ˤ������μ¹Ԥ�ǧ���ޤ���');
define('_RESTORE_BTN',						'�ե����뤫��ꥹ�ȥ�');
define('_RESTORE_WARNING',					'���������Хå����åפ�ꥹ�ȥ����褦�Ȥ��Ƥ��뤫��ǧ�����Ϥ�����˸��ߤΥХå����åפ��äƤ����Ƥ���������');
define('_ERROR_BACKUP_NOTSURE',				'"��ǧ"�����å��ܥå���������å�����ɬ�פ�����ޤ�');
define('_RESTORE_COMPLETE',					'�ꥹ�ȥ���λ');

// new item notification
define('_NOTIFY_NI_MSG',					'�����������ƥब��Ƥ���ޤ���:');
define('_NOTIFY_NI_TITLE',					'�����������ƥ�!');
define('_NOTIFY_KV_MSG',					'�����ƥ�˥���ޤ���ɼ������ޤ���:');
define('_NOTIFY_KV_TITLE',					'Nucleus�����:');
define('_NOTIFY_NC_MSG',					'�����ƥ�˥����Ȥ�����ޤ���:');
define('_NOTIFY_NC_TITLE',					'Nucleus������:');
define('_NOTIFY_USERID',					'�桼����ID:');
define('_NOTIFY_USER',						'�桼����:');
define('_NOTIFY_COMMENT',					'������:');
define('_NOTIFY_VOTE',						'��ɼ:');
define('_NOTIFY_HOST',						'�ۥ���:');
define('_NOTIFY_IP',						'IP���ɥ쥹:');
define('_NOTIFY_MEMBER',					'���С�:');
define('_NOTIFY_TITLE',						'�����ȥ�:');
define('_NOTIFY_CONTENTS',					'����:');

// member mail message
define('_MMAIL_MSG',						'������餢�ʤ����Υ�å������������Ƥ��ޤ���');
define('_MMAIL_FROMANON',					'ƿ̾�Υӥ�����');
define('_MMAIL_FROMNUC',					'��������Nucleus Blog');
define('_MMAIL_TITLE',						'��å����� from');
define('_MMAIL_MAIL',						'��å�����:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',						'�����ƥ���ɲ�');
define('_BMLET_EDIT',						'��¸');
define('_BMLET_DELETE',						'�����ƥ�κ��');
define('_BMLET_BODY',						'��ʸ');
define('_BMLET_MORE',						'³��');
define('_BMLET_OPTIONS',					'���ץ����');
define('_BMLET_PREVIEW',					'�ץ�ӥ塼');

// used in bookmarklet
define('_ITEM_UPDATED',						'�����ƥब��������ޤ���');
define('_ITEM_DELETED',						'�����ƥब����ޤ���');

// plugins
define('_CONFIRMTXT_PLUGIN',				'���Υץ饰�������ޤ�����');
define('_ERROR_NOSUCHPLUGIN',				'���ꤵ�줿�ץ饰����Ϥ���ޤ���');
define('_ERROR_DUPPLUGIN',					'���Υץ饰����ϴ�˥��󥹥ȡ��뤵��Ƥ��ޤ�');
define('_ERROR_PLUGFILEERROR',				'���ꤵ�줿�ץ饰�����¸�ߤ��ʤ������ѡ��ߥå�������������ꤵ��Ƥ��ޤ���');
define('_PLUGS_NOCANDIDATES',				'�ץ饰����Υ��󥹥ȡ������Ϥ���ޤ���');

define('_PLUGS_TITLE_MANAGE',				'�ץ饰����δ���');
define('_PLUGS_TITLE_INSTALLED',			'���󥹥ȡ���Ѥ�');
define('_PLUGS_TITLE_UPDATE',				'��Ͽ�ꥹ�ȤΥ��åץǡ���');
define('_PLUGS_TEXT_UPDATE',				'Nucleus������Ƥ���ƥץ饰������Ͽ��Υ��٥�Ⱦ��󤬡����餫�θ���(�ץ饰����ΥС�����󥢥åפ�ȼ���ե�����ξ����)�ˤ�ä�����ǤϤʤ����֤ˤʤä����ˡ֥��åץǡ��ȡץܥ���򥯥�å����Ƥ���������');
define('_PLUGS_TITLE_NEW',					'�������ץ饰����򥤥󥹥ȡ���');
define('_PLUGS_ADD_TEXT',					'�ʲ���plugins�ǥ��쥯�ȥ���ˤ������ƤΡ֥��󥹥ȡ��뤵��Ƥ��ʤ��ץ饰����פβ�ǽ��������ե�����Υꥹ�ȤǤ����ɲä������˥ץ饰���󤫤ɤ�����<strong>���ä����ǧ</strong>���Ƥ���������');
define('_PLUGS_BTN_INSTALL',				'�ץ饰����Υ��󥹥ȡ���');
define('_BACKTOOVERVIEW',					'���������');

// editlink
define('_TEMPLATE_EDITLINK',				'�����ƥ���Խ����뤿��Υ��');

// add left / add right tooltips
define('_ADD_LEFT_TT',						'left box���ɲ�');
define('_ADD_RIGHT_TT',						'right box���ɲ�');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',						'���������ƥ��꡼���ɲ�...');

// new settings
define('_SETTINGS_PLUGINURL',				'�ץ饰����ǥ��쥯�ȥ��URL');
define('_SETTINGS_MAXUPLOADSIZE',			'���åץ?�ɤǤ���ե�����κ��祵���� (bytes)');
define('_SETTINGS_NONMEMBERMSGS',			'���С��ʳ�����Υ�å�����������դ���');
define('_SETTINGS_PROTECTMEMNAMES',			'���С�̾���ݸ�');

// overview screen
define('_OVERVIEW_PLUGINS',					'�ץ饰�������');

// actionlog
define('_ACTIONLOG_NEWMEMBER',				'���������С�����Ͽ:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',					'���ʤ��Υ᡼�륢�ɥ쥹:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',			'������˻��ä��Ƥ���ɤΥ֥?�����¤��äƤ��ʤ��١��ե�����Υ��åץ?�ɤ�����ޤ���');

/* plugin list
define('_LISTS_INFO',						'����');
define('_LIST_PLUGS_AUTHOR',				'���:');
define('_LIST_PLUGS_VER',					'�С������:');
define('_LIST_PLUGS_SITE',					'������');
define('_LIST_PLUGS_DESC',					'����:');
define('_LIST_PLUGS_SUBS',					'�ʲ��Υ��٥�Ȥ���Ͽ:');
define('_LIST_PLUGS_UP',					'���');
define('_LIST_PLUGS_DOWN',					'����');
define('_LIST_PLUGS_UNINSTALL',				'���');
define('_LIST_PLUGS_ADMIN',					'����');
define('_LIST_PLUGS_OPTIONS',				'�Խ�');*/
define('_LISTS_INFO',						'����ե��᡼�����');
define('_LIST_PLUGS_AUTHOR',				'����ԡ�');
define('_LIST_PLUGS_VER',					'�С������');
define('_LIST_PLUGS_SITE',					'���ꥵ���ȡ�');
define('_LIST_PLUGS_DESC',					'���ס�');
define('_LIST_PLUGS_SUBS',					'��Ͽ�Ѥߥ��٥�ȡ�');
define('_LIST_PLUGS_UP',					'&uarr; �ҤȤľ��');
define('_LIST_PLUGS_DOWN',					'&darr; �ҤȤĲ���');
define('_LIST_PLUGS_UNINSTALL',				'���󥤥󥹥ȡ���');
define('_LIST_PLUGS_ADMIN',					'����');
define('_LIST_PLUGS_OPTIONS',				'���ץ�����Խ�');

// plugin option list
define('_LISTS_VALUE',						'��(����)');

// plugin options
define('_ERROR_NOPLUGOPTIONS',				'���Υץ饰����ˤϥ��ץ���󤬤���ޤ���');
define('_PLUGS_BACK',						'�ץ饰����ΰ��������');
define('_PLUGS_SAVE',						'���ץ�������¸');
define('_PLUGS_OPTIONS_UPDATED',			'�ץ饰���󥪥ץ���󤬹�������ޤ���');

define('_OVERVIEW_MANAGEMENT',				'����');
define('_OVERVIEW_MANAGE',					'Nucleus�δ���');
define('_MANAGE_GENERAL',					'����');
define('_MANAGE_SKINS',						'������/�ƥ�ץ졼��');
define('_MANAGE_EXTRA',						'�ɲõ�ǽ');

define('_BACKTOMANAGE',						'Nucleus�δ�������');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',							'EUC-JP');

// global stuff
define('_LOGOUT',							'�?������');
define('_LOGIN',							'�?����');
define('_YES',								'�Ϥ�');
define('_NO',								'������');
define('_SUBMIT',							'����');
define('_ERROR',							'���顼');
define('_ERRORMSG',							'���顼��ȯ�����ޤ�����');
define('_BACK',								'���');
define('_NOTLOGGEDIN',						'�?���󤷤Ƥ��ޤ���');
define('_LOGGEDINAS',						'�?����:');
define('_ADMINHOME',						'����ۡ���');
define('_NAME',								'̾��');
define('_BACKHOME',							'����ۡ�������');
define('_BADACTION',						'¸�ߤ��ʤ�����������׵ᤵ��ޤ���');
define('_MESSAGE',							'��å�����');
define('_HELP_TT',							'�إ�ס�');
define('_YOURSITE',							'�����Ȥγ�ǧ');


define('_POPUP_CLOSE',						'������ɥ����Ĥ���');

define('_LOGIN_PLEASE',						'�ޤ��?���󤷤Ƥ�������');

// commentform
define('_COMMENTFORM_YOUARE',				'�桼����̾: ');
define('_COMMENTFORM_SUBMIT',				'�����Ȥ��ɲ�');
define('_COMMENTFORM_COMMENT',				'������:');
define('_COMMENTFORM_NAME',					'��̾��:');
define('_COMMENTFORM_REMEMBER',				'����򵭲����Ƥ���');

// loginform
define('_LOGINFORM_NAME',					'�?����ID:');
define('_LOGINFORM_PWD',					'�ѥ����:');
define('_LOGINFORM_YOUARE',					'�?������:');
define('_LOGINFORM_SHARED',					'����PC��¾�οͤȶ��Ѥ���');

// member mailform
define('_MEMBERMAIL_SUBMIT',				'��å���������');

// search form
define('_SEARCHFORM_SUBMIT',				'����');

// add item form
define('_ADD_ADDTO',						'�����ƥ���ɲ�:');
define('_ADD_CREATENEW',					'�����������ƥ�');
define('_ADD_BODY',							'��ʸ');
define('_ADD_TITLE',						'�����ȥ�');
define('_ADD_MORE',							'³�� (����Ǥ��)');
define('_ADD_CATEGORY',						'���ƥ��꡼');
define('_ADD_PREVIEW',						'�ץ�ӥ塼');
define('_ADD_DISABLE_COMMENTS',				'�����Ȥ�����դ��ʤ�');
define('_ADD_DRAFTNFUTURE',					'�ɥ�եȤ�̤��ε���');
define('_ADD_ADDITEM',						'�����ƥ���ɲ�');
define('_ADD_ADDNOW',						'�������ɲ�');
define('_ADD_PLACE_ON',						'���:');
define('_ADD_ADDDRAFT',						'�ɥ�եȤ��ɲ�');
define('_ADD_NOPASTDATES',					'(��������ϻ���Ǥ��ޤ��󡣻��ꤵ�줿���ϸ��ߤ���������Ѥ���ޤ�)');
define('_ADD_BOLD_TT',						'����');
define('_ADD_ITALIC_TT',					'����');
define('_ADD_HREF_TT',						'��󥯺���');
define('_ADD_MEDIA_TT',						'��ǥ���(������)���ɲ�');
define('_ADD_PREVIEW_TT',					'�ץ�ӥ塼��ɽ��/��ɽ��');
define('_ADD_CUT_TT',						'���å�');
define('_ADD_COPY_TT',						'���ԡ�');
define('_ADD_PASTE_TT',						'�ڡ�����');


// edit item form
define('_EDIT_ITEM',						'�����ƥ���Խ�');
define('_EDIT_SUBMIT',						'��¸');
define('_EDIT_ORIG_AUTHOR',					'�����');
define('_EDIT_BACKTODRAFTS',				'���٥ɥ�եȤȤ�����¸');
define('_EDIT_COMMENTSNOTE',				'(���: �����Ȥ���ɽ���ϰ������ɲä��줿�����Ȥ򱣤��Ϥ��ޤ���)');

// used on delete screens
define('_DELETE_CONFIRM',					'���γ�ǧ�򤷤Ƥ�������');
define('_DELETE_CONFIRM_BTN',				'���γ�ǧ');
define('_CONFIRMTXT_ITEM',					'�ʲ��Υ����ƥ����褦�Ȥ��Ƥ��ޤ�:');
define('_CONFIRMTXT_COMMENT',				'�ʲ��Υ����Ȥ���褦�Ȥ��Ƥ��ޤ�:');
define('_CONFIRMTXT_TEAM1',					'����blog�Υ�����ꥹ�Ȥ���');
define('_CONFIRMTXT_TEAM2',					'���褦�Ȥ��Ƥ��ޤ�');
define('_CONFIRMTXT_BLOG',					'����Blog: ');
define('_WARNINGTXT_BLOGDEL',				'�ٹ� Blog�����Ȥ���˴ޤޤ�Ƥ������ƤΥ����ƥࡢ�����ȤϺ���ޤ������������ǧ������ǹԤäƤ���������<br />����ˡ�Blog�κ�����Nucleus�����Ǥ����ʤ��Ǥ���������');
define('_CONFIRMTXT_MEMBER',				'�ʲ��Υ��С��ץ�ե��������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_TEMPLATE',				'���Υƥ�ץ졼�Ȥ���褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_SKIN',					'���Υ��������褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_BAN',					'���ζػ�IP�ϰϤ���褦�Ȥ��Ƥ��ޤ�: ');
define('_CONFIRMTXT_CATEGORY',				'���Υ��ƥ��꡼����褦�Ȥ��Ƥ��ޤ�: ');

// some status messages
define('_DELETED_ITEM',						'�����ƥब����ޤ���');
define('_DELETED_MEMBER',					'���С�������ޤ���');
define('_DELETED_COMMENT',					'�����Ȥ�����ޤ���');
define('_DELETED_BLOG',						'Blog������ޤ���');
define('_DELETED_CATEGORY',					'���ƥ��꡼������ޤ���');
define('_ITEM_MOVED',						'�����ƥब��ư����ޤ���');
define('_ITEM_ADDED',						'�����ƥब�ɲä���ޤ���');
define('_COMMENT_UPDATED',					'�����Ȥ���������ޤ���');
define('_SKIN_UPDATED',						'������ǡ�������¸����ޤ���');
define('_TEMPLATE_UPDATED',					'�ƥ�ץ졼�ȥǡ�������¸����ޤ���');

// errors
define('_ERROR_COMMENT_LONGWORD',			'�����Ȥˤ�Ⱦ�Ѥ�90ʸ��ʾ��ñ���Ȥ�ʤ��ǲ�������');
define('_ERROR_COMMENT_NOCOMMENT',			'�����Ȥ����Ϥ��Ƥ���������');
define('_ERROR_COMMENT_NOUSERNAME',			'���ѤǤ��ʤ�̾���Ǥ���');
define('_ERROR_COMMENT_TOOLONG',			'�����Ȥ�Ĺ�����ޤ���(Ⱦ�Ѥ�5000ʸ��ޤ�)');
define('_ERROR_COMMENTS_DISABLED',			'���ߤ���Blog�Ǥϥ����Ȥ�����դ��Ƥ��ޤ���');
define('_ERROR_COMMENTS_NONPUBLIC',			'����Blog�إ����Ȥ��ɲä���ˤϥ��С��Ȥ��ƥ?���󤷤ʤ���Ф����ޤ���');
define('_ERROR_COMMENTS_MEMBERNICK',		'���ʤ����Ȥ����Ȥ���̾���ϴ�˻Ȥ��Ƥ��ޤ���¾��̾�������Ϥ��Ƥ���������');
define('_ERROR_SKIN',						'�����󡡥��顼');
define('_ERROR_ITEMCLOSED',					'���Υ����ƥ�ϱ������ѤǤ��������Ȥ���ơ���ɼ�ϤǤ��ޤ���');
define('_ERROR_NOSUCHITEM',					'���Τ褦�ʥ����ƥ��¸�ߤ��ޤ���');
define('_ERROR_NOSUCHBLOG',					'���Τ褦��Blog��¸�ߤ��ޤ���');
define('_ERROR_NOSUCHSKIN',					'���Τ褦�ʥ������¸�ߤ��ޤ���');
define('_ERROR_NOSUCHMEMBER',				'���Τ褦�ʥ��С���¸�ߤ��ޤ���');
define('_ERROR_NOTONTEAM',					'���ʤ��Ϥ���Blog�Υ�����˴ޤޤ�Ƥ��ޤ���');
define('_ERROR_BADDESTBLOG',				'�������Blog��¸�ߤ��ޤ���');
define('_ERROR_NOTONDESTTEAM',				'���ʤ����������Blog�Υ���������äƤ��ʤ����ᥢ���ƥ���ư�Ǥ��ޤ���');
define('_ERROR_NOEMPTYITEMS',				'��ʸ�����Υ����ƥ����ƤǤ��ޤ���');
define('_ERROR_BADMAILADDRESS',				'�᡼�륢�ɥ쥹�������Ǥ���');
define('_ERROR_BADNOTIFY',					'���Υ᡼�륢�ɥ쥹����������ʤ�Τ������äƤ��ޤ���');
define('_ERROR_BADNAME',					'���ѤǤ��ʤ�̾���Ǥ���( a-z ��0-9 �αѿ����Ȥ��ޤ���)');
define('_ERROR_NICKNAMEINUSE',				'¾�Υ��С���Ʊ���?����ID����Ѥ��Ƥ��ޤ���');
define('_ERROR_PASSWORDMISMATCH',			'���Ϥ��줿�ѥ���ɤ�Ʊ��ǤϤ���ޤ���');
define('_ERROR_PASSWORDTOOSHORT',			'�ѥ���ɤ�6ʸ��ʾ�Ǥʤ���Фʤ�ޤ���');
define('_ERROR_PASSWORDMISSING',			'�ѥ���ɤ����Ǥ���');
define('_ERROR_REALNAMEMISSING',			'�ϥ�ɥ�����Ϥ��Ƥ���������');
define('_ERROR_ATLEASTONEADMIN',			'�����ΰ�˥?����Ǥ���super-admin�����ʤ��Ȥ�1�ͤϤ��ʤ��ƤϤ����ޤ���');
define('_ERROR_ATLEASTONEBLOGADMIN',		'���Υ���������¹Ԥ���Ȥ��ʤ���Blog�ϥ��ƥʥ���ǽ�ˤʤ�ޤ������ʤ��Ȥ�1�ͤδ���Ԥ�����褦�ˤ��Ƥ���������');
define('_ERROR_ALREADYONTEAM',				'��˥���������äƤ��ޤ���');
define('_ERROR_BADSHORTBLOGNAME',			'Blog��û��̾(ά��)�ˤ� a-z ��0-9���αѿ���Τ߻��ѤǤ��ޤ������ڡ����ϻ��ѤǤ��ޤ���');
define('_ERROR_DUPSHORTBLOGNAME',			'¾��Blog��Ʊ��û��̾(ά��)���Ȥ��Ƥ��ޤ����̤�û��̾(ά��)�����Ϥ��Ƥ���������');
define('_ERROR_UPDATEFILE',					'�����ե�����˽񤭹���ޤ��󡣥ե�����Υѡ��ߥå�������������åȤ���Ƥ��뤫��ǧ���Ƥ������� (chmod 666 ���ƤߤƤ�������)���⤷���Хѥ��ǻ��ꤵ��Ƥ���ʤ顢���Хѥ��ǻ��ꤷ�ƤߤƤ���������(/your/path/to/nucleus/ �Τ褦��)');
define('_ERROR_DELDEFBLOG',					'�����Blog�Ϻ��Ǥ��ޤ���');
define('_ERROR_DELETEMEMBER',				'�����餯���Υ��С��ϣ��İʾ�Υ����ƥ����ԤǤ��뤿�ᡢ���Ǥ��ޤ���');
define('_ERROR_BADTEMPLATENAME',			'�����ʥƥ�ץ졼��̾�Ǥ���(a-z ��0-9 �αѿ���Τ߻��Ѳġ����ڡ����ϻ����Բ�)');
define('_ERROR_DUPTEMPLATENAME',			'Ʊ��̾���Υƥ�ץ졼�Ȥ����¸�ߤ��ޤ�');
define('_ERROR_BADSKINNAME',				'�����ʥ�����̾�Ǥ���(a-z ��0-9 �αѿ���Τ߻��Ѳġ����ڡ����ϻ����Բ�)');
define('_ERROR_DUPSKINNAME',				'Ʊ��̾���Υ����󤬴��¸�ߤ��ޤ���');
define('_ERROR_DEFAULTSKIN',				'���Υ������ɸ��Υ���������ꤵ��Ƥ��뤿����Ǥ��ޤ���');
define('_ERROR_SKINDEFDELETE',				'�ʲ���Blog�δ���Υ�����˻��ꤵ��Ƥ��뤿�ᡢ���������Ǥ��ޤ���: ');
define('_ERROR_DISALLOWED',					'���Υ��������μ¹Ԥ����Ĥ���Ƥ��ޤ���');
define('_ERROR_DELETEBAN',					'�ػ߼Ԥκ����˥��顼��ȯ�����ޤ���(�ػ߼Ԥ�¸�ߤ��ޤ���)');
define('_ERROR_ADDBAN',						'�ػ߼Ԥ��ɲ���˥��顼��ȯ�����ޤ��������Ƥ�blog���������ɲä���Ƥ��ʤ����⤷��ޤ���');
define('_ERROR_BADACTION',					'�׵ᤵ�줿���������¸�ߤ��ޤ���');
define('_ERROR_MEMBERMAILDISABLED',			'���С��֤Υ᡼���å������������ԲĤˤʤäƤ��ޤ���');
define('_ERROR_MEMBERCREATEDISABLED',		'���С��������ػߤ���Ƥ��ޤ���');
define('_ERROR_INCORRECTEMAIL',				'�����ʥ᡼�륢�ɥ쥹�Ǥ���');
define('_ERROR_VOTEDBEFORE',				'���Υ����ƥ�ˤϴ����ɼ�ѤߤǤ���');
define('_ERROR_BANNED1',					'���ʤ� (IP�ϰ� ');
define('_ERROR_BANNED2',					') �Ϥ��Υ��������μ¹Ԥ��ػߤ���Ƥ��ޤ�����å�����: \'');
define('_ERROR_BANNED3',					'\'');
define('_ERROR_LOGINNEEDED',				'�¹Ԥ���ˤϥ?����ɬ�פǤ���');
define('_ERROR_CONNECT',					'��³���顼');
define('_ERROR_FILE_TOO_BIG',				'�ե����뤬�礭�����ޤ���');
define('_ERROR_BADFILETYPE',				'���åץ?�ɤ�ǧ����Ƥ��ʤ��ե����륿���פǤ���');
define('_ERROR_BADREQUEST',					'�����ʥ��åץ?���׵�Ǥ�');
define('_ERROR_DISALLOWEDUPLOAD',			'���ʤ��Ϥɤ�Blog������ˤ����äƤ��ʤ��Τǥե�����򥢥åץ?�ɤǤ��ޤ���');
define('_ERROR_BADPERMISSIONS',				'�ե�����/�ǥ��쥯�ȥ�Υѡ��ߥå�������������åȤ���Ƥ��ޤ���');
define('_ERROR_UPLOADMOVEP',				'���åץ?�ɥե�����ΰ�ư��˥��顼��ȯ�����ޤ�����');
define('_ERROR_UPLOADCOPY',					'�ե�����Υ��ԡ���˥��顼��ȯ�����ޤ�����');
define('_ERROR_UPLOADDUPLICATE',			'Ʊ��̾���Υե����뤬���¸�ߤ��ޤ������åץ?�ɤ�������̾�����ѹ����Ƥ��Ƥ���������');
define('_ERROR_LOGINDISALLOWED',			'�����ΰ�ؤΥ?����ǧ����Ƥ��ޤ��󡣤⤷���ʤ�������桼�����Υ�������Ȥ��äƤ���Τʤ顢����桼�����Ȥ��ƥ?���󤷤ʤ����Ƥ���������');
define('_ERROR_DBCONNECT',					'MySQL�����Ф���³�Ǥ��ޤ���');
define('_ERROR_DBSELECT',					'Nucleus�����Ѥ���ǡ����١���������Ǥ��ޤ���');
define('_ERROR_NOSUCHLANGUAGE',				'���ꤵ�줿����ե������¸�ߤ��ޤ���');
define('_ERROR_NOSUCHCATEGORY',				'���ꤵ�줿���ƥ��꡼��¸�ߤ��ޤ���');
define('_ERROR_DELETELASTCATEGORY',			'���ƥ��꡼������Ĥ����ꤷ�Ƥ���������');
define('_ERROR_DELETEDEFCATEGORY',			'����Υ��ƥ��꡼�Ϻ��Ǥ��ޤ���');
define('_ERROR_BADCATEGORYNAME',			'���ƥ��꡼̾�Ȥ��ƻȤ��ޤ���');
define('_ERROR_DUPCATEGORYNAME',			'Ʊ��̾���Υ��ƥ��꡼�����¸�ߤ��ޤ���');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',					'�ٹ�: �ǥ��쥯�ȥ�ǤϤ���ޤ���');
define('_WARNING_NOTREADABLE',				'�ٹ�: �ɤ߼���Բ�ǽ�ʥǥ��쥯�ȥ�Ǥ���');
define('_WARNING_NOTWRITABLE',				'�ٹ�: �񤭹����Բ�ǽ�ʥǥ��쥯�ȥ�Ǥ���');

// media and upload
define('_MEDIA_UPLOADLINK',					'�ե�����Υ��åץ?��');
define('_MEDIA_MODIFIED',					'������');
define('_MEDIA_FILENAME',					'�ե�����̾');
define('_MEDIA_DIMENSIONS',					'������');
define('_MEDIA_INLINE',						'�����߷�');
define('_MEDIA_POPUP',						'�ݥåץ��å׷�');
define('_UPLOAD_TITLE',						'�ե���������');
define('_UPLOAD_MSG',						'���åץ?�ɤ���ե���������򤷤ơ֥��åץ?�ɡץܥ���򲡤��Ƥ�������');
define('_UPLOAD_BUTTON',					'���åץ?��');

// some status messages
//define('_MSG_ACCOUNTCREATED',				'��������Ȥ���������ޤ������ѥ���ɤ��᡼�����������ޤ�');
//define('_MSG_PASSWORDSENT',				'�ѥ���ɤ��᡼�����������ޤ�����');
define('_MSG_LOGINAGAIN',					'��������Ⱦ����ѹ����줿�١��?���󤷤ʤ���ɬ�פ�����ޤ�');
define('_MSG_SETTINGSCHANGED',				'���꤬�ѹ�����ޤ���');
define('_MSG_ADMINCHANGED',					'����Ը��¤��ѹ�����ޤ���');
define('_MSG_NEWBLOG',						'������Blog����������ޤ���');
define('_MSG_ACTIONLOGCLEARED',				'����������򤬾õ��ޤ���');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',				'���Ĥ���Ƥ��ʤ����������: ');
define('_ACTIONLOG_PWDREMINDERSENT',		'�������ѥ���ɤ�������: ');
define('_ACTIONLOG_TITLE',					'�����������');
define('_ACTIONLOG_CLEAR_TITLE',			'�����������ξõ�');
define('_ACTIONLOG_CLEAR_TEXT',				'�����������򺣤����õ�');

// team management
define('_TEAM_TITLE',						'Blog�Υ���������� ');
define('_TEAM_CURRENT',						'���ߤΥ�������С�');
define('_TEAM_ADDNEW',						'������˿��������С����ɲä���');
define('_TEAM_CHOOSEMEMBER',				'���С�������');
define('_TEAM_ADMIN',						'����Ը��¤�Ϳ���� ');
define('_TEAM_ADD',							'��������ɲ�');
define('_TEAM_ADD_BTN',						'��������ɲ�');

// blogsettings
define('_EBLOG_TITLE',						'Blog������Խ�');
define('_EBLOG_TEAM_TITLE',					'������δ���');
define('_EBLOG_TEAM_TEXT',					'������δ���...');
define('_EBLOG_SETTINGS_TITLE',				'Blog����');
define('_EBLOG_NAME',						'Blog��̾��');
define('_EBLOG_SHORTNAME',					'Blog��û��̾(ά��)');
define('_EBLOG_SHORTNAME_EXTRA',			'<br />(a-z�αѾ�ʸ��Τߤ����ѤǤ��ޤ�������ϻ��ѤǤ��ޤ���)');
define('_EBLOG_DESC',						'Blog������');
define('_EBLOG_URL',						'Blog��URL');
define('_EBLOG_DEFSKIN',					'Blog��ɸ��Υ�����');
define('_EBLOG_DEFCAT',						'Blog��ɸ��Υ��ƥ���');
define('_EBLOG_LINEBREAKS',					'�����ƥ�β��Ԥ��Ѵ�����');
define('_EBLOG_DISABLECOMMENTS',			'�����Ȥ�����դ���<br /><small>(�����Ȥ�ػߤ���ȥ����Ȥ��ɲäϤǤ��ʤ��ʤ�ޤ���)</small>');
define('_EBLOG_ANONYMOUS',					'���С��ʳ��Υ����Ȥ�����դ���');
define('_EBLOG_NOTIFY',						'���Τ���᡼�륢�ɥ쥹 ( ; �Ƕ��ڤäƤ�������)');
define('_EBLOG_NOTIFY_ON',					'�ʲ������Τ���');
define('_EBLOG_NOTIFY_COMMENT',				'������������');
define('_EBLOG_NOTIFY_KARMA',				'�������������ɼ');
define('_EBLOG_NOTIFY_ITEM',				'������Blog�����ƥ�');
define('_EBLOG_PING',						'��������Blog���������ӥ��˹��������Τ���'); // NOTE: This string is no longer in used
define('_EBLOG_MAXCOMMENTS',				'������ɽ�����륳���Ȥκ����');
define('_EBLOG_UPDATE',						'��ư��������ե�����');
define('_EBLOG_OFFSET',						'�����л���Ȥλ���');
define('_EBLOG_STIME',						'���ߤΥ����л���: ');
define('_EBLOG_BTIME',						'���ߤ�Blog����: ');
define('_EBLOG_CHANGE',						'������ѹ�');
define('_EBLOG_CHANGE_BTN',					'������ѹ�');
define('_EBLOG_ADMIN',						'Blog����Ը���');
define('_EBLOG_ADMIN_MSG',					'���ʤ��ˤϴ���Ը��¤�������Ƥ��ޤ�');
define('_EBLOG_CREATE_TITLE',				'������Blog�κ���');
define('_EBLOG_CREATE_TEXT',				'������Blog���������٤˰ʲ��Υե���������Ƥ���������<br /><br /> <b>���:</b> ɬ�פʥ��ץ����Τߤ�ɽ������Ƥ��ޤ����ɲäΥ��ץ��������ꤷ��������Blog����������塢Blog����ڡ��������ꤷ�Ƥ���������');
define('_EBLOG_CREATE',						'������');
define('_EBLOG_CREATE_BTN',					'Blog�����');
define('_EBLOG_CAT_TITLE',					'���ƥ��꡼');
define('_EBLOG_CAT_NAME',					'���ƥ��꡼̾');
define('_EBLOG_CAT_DESC',					'���ƥ��꡼������');
define('_EBLOG_CAT_CREATE',					'���������ƥ��꡼����');
define('_EBLOG_CAT_UPDATE',					'���ƥ��꡼�ι���');
define('_EBLOG_CAT_UPDATE_BTN',				'���ƥ��꡼�򹹿�');

// templates
define('_TEMPLATE_TITLE',					'�ƥ�ץ졼�Ȥ��Խ�');
define('_TEMPLATE_AVAILABLE_TITLE',			'���Ѳ�ǽ�ʥƥ�ץ졼��');
define('_TEMPLATE_NEW_TITLE',				'�������ƥ�ץ졼��');
define('_TEMPLATE_NAME',					'�ƥ�ץ졼��̾');
define('_TEMPLATE_DESC',					'�ƥ�ץ졼�Ȥ�����');
define('_TEMPLATE_CREATE',					'�ƥ�ץ졼�Ȥκ���');
define('_TEMPLATE_CREATE_BTN',				'�ƥ�ץ졼�Ȥ����');
define('_TEMPLATE_EDIT_TITLE',				'�ƥ�ץ졼�Ȥ��Խ�');
define('_TEMPLATE_BACK',					'�ƥ�ץ졼�Ȥΰ��������');
define('_TEMPLATE_EDIT_MSG',				'���ƤΥƥ�ץ졼�ȥѡ��Ĥ�ɬ�פ����ǤϤ���ޤ���ɬ�פʤ����϶���Τޤޤˤ��Ƥ����Ƥ���������');
define('_TEMPLATE_SETTINGS',				'�ƥ�ץ졼������');
define('_TEMPLATE_ITEMS',					'�����ƥ�');
define('_TEMPLATE_ITEMHEADER',				'�����ƥ�Υإå���');
define('_TEMPLATE_ITEMBODY',				'�����ƥ������');
define('_TEMPLATE_ITEMFOOTER',				'�����ƥ�Υեå���');
define('_TEMPLATE_MORELINK',				'³���ؤΥ��');
define('_TEMPLATE_NEW',						'�����������ƥ���դ���ޡ���');
define('_TEMPLATE_COMMENTS_ANY',			'������ (������)');
define('_TEMPLATE_CHEADER',					'�����ȤΥإå���');
define('_TEMPLATE_CBODY',					'�����Ȥ�����');
define('_TEMPLATE_CFOOTER',					'�����ȤΥեå���');
define('_TEMPLATE_CONE',					'�����Ȥ�1�Ĥλ�');
define('_TEMPLATE_CMANY',					'�����Ȥ�2�İʾ�λ�');
define('_TEMPLATE_CMORE',					'�����Ȥ�³�����ɤ�');
define('_TEMPLATE_CMEXTRA',					'��Ͽ���С�����Υ����Ȥؤ��ɲ�ɽ��');
define('_TEMPLATE_COMMENTS_NONE',			'������ (̵�����)');
define('_TEMPLATE_CNONE',					'�����Ȥ�̵����');
define('_TEMPLATE_COMMENTS_TOOMUCH',		'������ (����ɽ�������¿�����)');
define('_TEMPLATE_CTOOMUCH',				'�����Ȥ�¿�������');
define('_TEMPLATE_ARCHIVELIST',				'���������ְ���');
define('_TEMPLATE_AHEADER',					'���������ְ����Υإå���');
define('_TEMPLATE_AITEM',					'���������ְ���������');
define('_TEMPLATE_AFOOTER',					'���������ְ����Υեå���');
define('_TEMPLATE_DATETIME',				'���դȻ���');
define('_TEMPLATE_DHEADER',					'���դΥإå���');
define('_TEMPLATE_DFOOTER',					'���դΥեå���');
define('_TEMPLATE_DFORMAT',					'���եե����ޥå�');
define('_TEMPLATE_TFORMAT',					'����ե����ޥå�');
define('_TEMPLATE_LOCALE',					'�?����');
define('_TEMPLATE_IMAGE',					'����ȥ�ǥ����Υݥåץ��å�');
define('_TEMPLATE_PCODE',					'�ݥåץ��åײ���ؤΥ�󥯥�����');
define('_TEMPLATE_ICODE',					'����饤�����Υ�����');
define('_TEMPLATE_MCODE',					'��ǥ������֥������ȤؤΥ�󥯥�����');
define('_TEMPLATE_SEARCH',					'����');
define('_TEMPLATE_SHIGHLIGHT',				'�ϥ��饤��ɽ��');
define('_TEMPLATE_SNOTFOUND',				'�����ǲ��⸫�Ĥ���ʤ��ä����');
define('_TEMPLATE_UPDATE',					'����');
define('_TEMPLATE_UPDATE_BTN',				'�ƥ�ץ졼�Ȥι���');
define('_TEMPLATE_RESET_BTN',				'�ꥻ�å�');
define('_TEMPLATE_CATEGORYLIST',			'���ƥ��꡼����');
define('_TEMPLATE_CATHEADER',				'���ƥ��꡼�����Υإå���');
define('_TEMPLATE_CATITEM',					'���ƥ��꡼����������');
define('_TEMPLATE_CATFOOTER',				'���ƥ��꡼�����Υեå���');

// skins
define('_SKIN_EDIT_TITLE',					'��������Խ�');
define('_SKIN_AVAILABLE_TITLE',				'���Ѳ�ǽ�ʥ�����');
define('_SKIN_NEW_TITLE',					'������������');
define('_SKIN_NAME',						'̾��');
define('_SKIN_DESC',						'����');
define('_SKIN_TYPE',						'Content Type');
define('_SKIN_CREATE',						'����');
define('_SKIN_CREATE_BTN',					'������κ���');
define('_SKIN_EDITONE_TITLE',				'��������Խ�');
define('_SKIN_BACK',						'������ΰ��������');
define('_SKIN_PARTS_TITLE',					'������ѡ���');
define('_SKIN_PARTS_MSG',					'���줾��Υ���������ƤΥ����פ�ɬ�פȤϸ¤�ޤ���ɬ�פʤ����϶���Τޤޤˤ��Ƥ����Ƥ����������ʲ������Խ����륹���������Ǥ�������:');
define('_SKIN_PART_MAIN',					'�ᥤ����ܼ��ڡ���');
define('_SKIN_PART_ITEM',					'���̥����ƥ�ڡ���');
define('_SKIN_PART_ALIST',					'���̥��������ְ����ڡ���');
define('_SKIN_PART_ARCHIVE',				'���̥��������֥ڡ���');
define('_SKIN_PART_SEARCH',					'�����ڡ���');
define('_SKIN_PART_ERROR',					'���顼�ڡ���');
define('_SKIN_PART_MEMBER',					'���С��ܺ٥ڡ���');
define('_SKIN_PART_POPUP',					'����ݥåץ��åץ�����ɥ�');
define('_SKIN_GENSETTINGS_TITLE',			'��������');
define('_SKIN_CHANGE',						'�ѹ�');
define('_SKIN_CHANGE_BTN',					'������ѹ�');
define('_SKIN_UPDATE_BTN',					'������ι���');
define('_SKIN_RESET_BTN',					'�ꥻ�å�');
define('_SKIN_EDITPART_TITLE',				'��������Խ�');
define('_SKIN_GOBACK',						'���');
define('_SKIN_ALLOWEDVARS',					'���Ѳ�ǽ���ѿ� (����å�������ɽ��):');

// global settings
define('_SETTINGS_TITLE',					'���?�Х�����');
define('_SETTINGS_SUB_GENERAL',				'���?�Х�����');
define('_SETTINGS_DEFBLOG',					'�����Blog');
define('_SETTINGS_ADMINMAIL',				'����ԤΥ᡼�륢�ɥ쥹');
define('_SETTINGS_SITENAME',				'������̾');
define('_SETTINGS_SITEURL',					'�����Ȥ�URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_ADMINURL',				'������ΰ��URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_DIRS',					'Nucleus�ǥ��쥯�ȥ�');
define('_SETTINGS_MEDIADIR',				'��ǥ���(������)�����åץ?�ɤ����ǥ��쥯�ȥ�');
define('_SETTINGS_SEECONFIGPHP',			'(config.php �򻲾�)');
define('_SETTINGS_MEDIAURL',				'��ǥ���URL (�Ǹ�˥���å��� "/" ���դ��Ƥ�������)');
define('_SETTINGS_ALLOWUPLOAD',				'�ե�����Υ��åץ?�ɤ��ǽ�ˤ���');
define('_SETTINGS_ALLOWUPLOADTYPES',		'���åץ?�ɤ���Ĥ���ե����륿����');
define('_SETTINGS_CHANGELOGIN',				'���С��ˤ��?����̾/�ѥ���ɤ��ѹ����ǽ�ˤ���');
define('_SETTINGS_COOKIES_TITLE',			'Cookie ����');
define('_SETTINGS_COOKIELIFE',				'�?���� Cookie ��ͭ����');
define('_SETTINGS_COOKIESESSION',			'���å���󤴤�');
define('_SETTINGS_COOKIEMONTH',				'�����');
define('_SETTINGS_COOKIEPATH',				'Cookie �ѥ� (��饪�ץ����)');
define('_SETTINGS_COOKIEDOMAIN',			'Cookie �ɥᥤ�� (��饪�ץ����)');
define('_SETTINGS_COOKIESECURE',			'�����奢 Cookie (��饪�ץ����)');
define('_SETTINGS_LASTVISIT',				'�ǽ�ˬ�������Cookie����¸����');
define('_SETTINGS_ALLOWCREATE',				'�ӥ������ˤ����С���������Ⱥ������ǽ�ˤ���');
define('_SETTINGS_NEWLOGIN',				'�ӥ�����������������������ȤǤΥ?��������ľ��˲�ǽ�ˤ���');
define('_SETTINGS_NEWLOGIN2',				'(�������������줿��������ȤΤ�)');
define('_SETTINGS_MEMBERMSGS',				'���С��֥����ӥ����ǽ�ˤ���');
define('_SETTINGS_LANGUAGE',				'���Ѥ������');
define('_SETTINGS_DISABLESITE',				'�����Ȥ��ĺ����������URL��ž������������ѡ�');
define('_SETTINGS_DBLOGIN',					'MySQL �?���� &amp; �ǡ����١���');
define('_SETTINGS_UPDATE',					'����ι���');
define('_SETTINGS_UPDATE_BTN',				'����򹹿�');
define('_SETTINGS_DISABLEJS',				'JavaScript�ġ���С���̵��ˤ���');
define('_SETTINGS_MEDIA',					'��ǥ���/���åץ?������');
define('_SETTINGS_MEDIAPREFIX',				'���åץ?�ɤ���ե�����̾��Ƭ�����դ��ղä���');
define('_SETTINGS_MEMBERS',					'���С�����');

// bans
define('_BAN_TITLE',						'�����إꥹ��:');
define('_BAN_NONE',							'����Blog�ϥ���������������Ƥ��ޤ���');
define('_BAN_NEW_TITLE',					'��������IP���ɥ쥹���ɲ�');
define('_BAN_NEW_TEXT',						'�������������ɥ쥹���ɲä���');
define('_BAN_REMOVE_TITLE',					'�������������β��');
define('_BAN_IPRANGE',						'����������������IP���ɥ쥹���ϰ�');
define('_BAN_BLOGS',						'����������������Blog: ');
define('_BAN_DELETE_TITLE',					'�������������β��');
define('_BAN_ALLBLOGS',						'���ʤ�������Ը��¤������Ƥ�Blog');
define('_BAN_REMOVED_TITLE',				'����������������ޤ���');
define('_BAN_REMOVED_TEXT',					'�ʲ���Blog�Υ���������������ޤ���:');
define('_BAN_ADD_TITLE',					'��������IP���ɥ쥹���ɲ�');
define('_BAN_IPRANGE_TEXT',					'�ʲ��˥֥�å�������IP���ɥ쥹�����Ϥ��Ƥ���������');
define('_BAN_BLOGS_TEXT',					'1�Ĥ�Blog�Τߤǵ������뤫�����ʤ�������Ը��¤������Ƥ�Blog�ǵ������뤫�����򤹤뤳�Ȥ�����ޤ����ʲ���������Ǥ���������');
define('_BAN_REASON_TITLE',					'��ͳ');
define('_BAN_REASON_TEXT',					'�������IP���ɥ쥹���ϰ����HOST���饳���Ȥ���Ƥ����ꥫ�����ɼ�򤷤褦�Ȥ����Ȥ���ɽ������뵬����ͳ��񤤤Ƥ������Ȥ��Ǥ��ޤ� (���256ʸ��)��');
define('_BAN_ADD_BTN',						'��������IP���ɥ쥹���ɲ�');

// LOGIN screen
define('_LOGIN_MESSAGE',					'��å�����');
define('_LOGIN_SHARED',						_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',						'�ѥ���ɤ�˺�줿');

// membermanagement
define('_MEMBERS_TITLE',					'���С��δ���');
define('_MEMBERS_CURRENT',					'���ߤΥ��С�');
define('_MEMBERS_NEW',						'���������С����ɲ�');
define('_MEMBERS_DISPLAY',					'ɽ�������̾��(�?����ID)');
define('_MEMBERS_DISPLAY_INFO',				'(����̾���ϥ?������˻Ȥ��ޤ�)');
define('_MEMBERS_REALNAME',					'�ϥ�ɥ�͡���');
define('_MEMBERS_PWD',						'�ѥ����');
define('_MEMBERS_REPPWD',					'�ѥ���ɡʳ�ǧ��');
define('_MEMBERS_EMAIL',					'�᡼�륢�ɥ쥹');
define('_MEMBERS_EMAIL_EDIT',				'(�᡼�륢�ɥ쥹���ѹ�����ȡ����Υ��ɥ쥹�ؼ�ưŪ��ǧ���ѥ�󥯤���������ޤ�)');
define('_MEMBERS_URL',						'Web site���ɥ쥹 (URL)');
define('_MEMBERS_SUPERADMIN',				'Super-admin(�ǹ����)���¤�Ϳ����');
define('_MEMBERS_CANLOGIN',					'������ΰ�ؤΥ?������ǽ�ˤ���');
define('_MEMBERS_NOTES',					'����');
define('_MEMBERS_NEW_BTN',					'���С����ɲ�');
define('_MEMBERS_EDIT',						'���С����Խ�');
define('_MEMBERS_EDIT_BTN',					'������ѹ�');
define('_MEMBERS_BACKTOOVERVIEW',			'���С��ΰ��������');
define('_MEMBERS_DEFLANG',					'���Ѥ������');
define('_MEMBERS_USESITELANG',				'- �����Ȥ������Ȥ� -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',				'�����Ȥ򸫤�');
define('_BLOGLIST_ADD',						'�����ƥ���ɲ�');
define('_BLOGLIST_TT_ADD',					'����Blog�˿����������ƥ���ɲä��ޤ�');
define('_BLOGLIST_EDIT',					'�����ƥ���Խ�/���');
define('_BLOGLIST_TT_EDIT',					'��ѤߤΥ����ƥ���Խ��Ⱥ��');
define('_BLOGLIST_BMLET',					'�֥å��ޡ�����å�');
define('_BLOGLIST_TT_BMLET',				'�֥å��ޡ�����åȤΥ��󥹥ȡ���');
define('_BLOGLIST_SETTINGS',				'�֥?����');
define('_BLOGLIST_TT_SETTINGS',				'�֥?������ȥ֥?������δ���');
define('_BLOGLIST_BANS',					'������������');
define('_BLOGLIST_TT_BANS',					'�������������γ�ǧ/�ɲ�/���');
define('_BLOGLIST_DELETE',					'���ƺ��');
define('_BLOGLIST_TT_DELETE',				'����Blog����');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',					'���ʤ���Blog');
define('_OVERVIEW_YRDRAFTS',				'�ɥ�ե�(����)');
define('_OVERVIEW_YRSETTINGS',				'����');
define('_OVERVIEW_GSETTINGS',				'��������');
define('_OVERVIEW_NOBLOGS',					'���ʤ��Ϥɤ�Blog������ꥹ�Ȥˤ����äƤ��ޤ���');
define('_OVERVIEW_NODRAFTS',				'�ɥ�ե�(������)�ε����Ϥ���ޤ���');
define('_OVERVIEW_EDITSETTINGS',			'���ʤ�������');
define('_OVERVIEW_BROWSEITEMS',				'���ʤ��Υ����ƥ�');
define('_OVERVIEW_BROWSECOMM',				'���ʤ��Υ�����');
define('_OVERVIEW_VIEWLOG',					'�����������');
define('_OVERVIEW_MEMBERS',					'���С�����');
define('_OVERVIEW_NEWLOG',					'����Blog����');
define('_OVERVIEW_SETTINGS',				'���?�Х�����');
define('_OVERVIEW_TEMPLATES',				'�ƥ�ץ졼���Խ�');
define('_OVERVIEW_SKINS',					'�������Խ�');
define('_OVERVIEW_BACKUP',					'DB��¸/��');

// ITEMLIST
define('_ITEMLIST_BLOG',							'Blog�����ƥ���Խ�: ');
define('_ITEMLIST_YOUR',							'���ʤ��Υ����ƥ�');

// Comments
define('_COMMENTS',									'������');
define('_NOCOMMENTS',								'���Υ����ƥ�ؤΥ����ȤϤ���ޤ���');
define('_COMMENTS_YOUR',							'���ʤ��Υ�����');
define('_NOCOMMENTS_YOUR',							'���ʤ��Υ����ȤϤ���ޤ���');

// LISTS (general)
define('_LISTS_NOMORE',								'���⤢��ޤ���');
define('_LISTS_PREV',								'����');
define('_LISTS_NEXT',								'����');
define('_LISTS_SEARCH',								'����');
define('_LISTS_CHANGE',								'�ѹ�');
define('_LISTS_PERPAGE',							'�����ƥ�/�ڡ���');
define('_LISTS_ACTIONS',							'���������');
define('_LISTS_DELETE',								'���');
define('_LISTS_EDIT',								'�Խ�');
define('_LISTS_MOVE',								'��ư');
define('_LISTS_CLONE',								'ʣ��');
define('_LISTS_TITLE',								'�����ȥ�');
define('_LISTS_BLOG',								'Blog');
define('_LISTS_NAME',								'̾��');
define('_LISTS_DESC',								'����');
define('_LISTS_TIME',								'����');
define('_LISTS_COMMENTS',							'������');
define('_LISTS_TYPE',								'������');


// member list
define('_LIST_MEMBER_NAME',							'ɽ�������̾��(�?����ID)');
define('_LIST_MEMBER_RNAME',						'�ϥ�ɥ�͡���');
define('_LIST_MEMBER_ADMIN',						'Super-admin���� ');
define('_LIST_MEMBER_LOGIN',						'�?�����ǽ');
define('_LIST_MEMBER_URL',							'�����֥�����');

// banlist
define('_LIST_BAN_IPRANGE',							'�������IP���ɥ쥹���ϰ�');
define('_LIST_BAN_REASON',							'��������ͳ');

// actionlist
define('_LIST_ACTION_MSG',							'��å�����');

// commentlist
define('_LIST_COMMENT_BANIP',						'IP���ɥ쥹����');
define('_LIST_COMMENT_WHO',							'���');
define('_LIST_COMMENT',								'������');
define('_LIST_COMMENT_HOST',						'�ۥ���');

// itemlist
define('_LIST_ITEM_INFO',							'����');
define('_LIST_ITEM_CONTENT',						'�����ȥ����ʸ');


// teamlist
define('_LIST_TEAM_ADMIN',							'����Ը��� ');
define('_LIST_TEAM_CHADMIN',						'����Ը��¤��ѹ�');

// edit comments
define('_EDITC_TITLE',								'�����Ȥ��Խ�');
define('_EDITC_WHO',								'���');
define('_EDITC_HOST',								'�ۥ���');
define('_EDITC_WHEN',								'���');
define('_EDITC_TEXT',								'��ʸ');
define('_EDITC_EDIT',								'�����Ȥ��Խ�');
define('_EDITC_MEMBER',								'���С�');
define('_EDITC_NONMEMBER',							'����С�');

// move item
define('_MOVE_TITLE',								'�ɤ�Blog�˰�ư���ޤ�����');
define('_MOVE_BTN',									'�����ƥ���ư����');

?>