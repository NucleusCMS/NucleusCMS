<?php
// Russian Nucleus Language File
//
// Author: Andrey Serebryakov - saahov@gmail.com
// Nucleus version: v1.0-v3.2
// Update: 19.10.2005
// ������� �� ����������, ��������� � ������������ Nucleus �����
// ������ �� ������ ���������� ������� �������������: http://nucleus.net.ru .
/**
 * Nucleus Language File
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id$
 */


/********************************************
 *        Start New for 4.0                 *
 ********************************************/
define('_SKINIE_INVALID_NAMES_DETECTED', 'Invalid skin or templates names detected. Valid names consist of only a-z, A-Z, 0-9, -, and _'); 
define('_LISTS_AUTHOR', 'Author');
define('_OVERVIEW_OTHER_DRAFTS', 'Other Drafts');
 
/********************************************
 *        Start New for 3.6x                *
 ********************************************/
define('_ERROR_USER_TOO_LONG', 'Please enter a name shorter than 40 characters.');
define('_ERROR_EMAIL_TOO_LONG', 'Please enter an email shorter than 100 characters.');
define('_ERROR_URL_TOO_LONG', 'Please enter a website shorter than 100 characters.');

/********************************************
 *        Start New for 3.62                *
 ********************************************/
define('_SETTINGS_ADMINCSS',		'Admin Area Style');

 
/********************************************
 *        Start New for 3.50                *
 ********************************************/
define('_PLUGS_TITLE_GETPLUGINS',		'get more plugins...');
define('_ARCHIVETYPE_YEAR', 'year');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'Newer Version Available');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'Upgrade available: v');
define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "Plugin %s was not loaded (does not support SqlApi and you are trying to use a non-mysql db)");


/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
define('_MEMBERS_USEAUTOSAVE',						'Use the Autosave function?');

define('_TEMPLATE_PLUGIN_FIELDS',					'Custom Plugin Fields');
define('_TEMPLATE_BLOGLIST',						'Template Blog List');
define('_TEMPLATE_BLOGHEADER',						'Blog List Header');
define('_TEMPLATE_BLOGITEM',						'Blog List Item');
define('_TEMPLATE_BLOGFOOTER',						'Blog List Footer');

define('_SETTINGS_DEFAULTLISTSIZE',					'Default Size of Lists in Admin Area');
define('_SETTINGS_DEBUGVARS',		'Debug Vars');

define('_CREATE_ACCOUNT_TITLE',						'Create Member Account');
define('_CREATE_ACCOUNT0',							'Create Account');
define('_CREATE_ACCOUNT1',							'Visitors are not allowed to create a Member Account.<br /><br />');
define('_CREATE_ACCOUNT2',							'Please contact the website administrator for more information.');
define('_CREATE_ACCOUNT_USER_DATA',					'Account Info.');
define('_CREATE_ACCOUNT_LOGIN_NAME',				'Login Name (required):');
define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',			'only a-z and 0-9 allowed, no spaces at start/end');
define('_CREATE_ACCOUNT_REAL_NAME',					'Real Name (required):');
define('_CREATE_ACCOUNT_EMAIL',						'Email (required):');
define('_CREATE_ACCOUNT_EMAIL2',					'(must be valid, because an activation link will be sent over there)');
define('_CREATE_ACCOUNT_URL',						'URL:');
define('_CREATE_ACCOUNT_SUBMIT',					'Create Account');

define('_BMLET_BACKTODRAFTS',		'Move back to drafts');
define('_BMLET_CANCEL',				'Cancel');

define('_LIST_ITEM_NOCONTENT',						'No Comment');
define('_LIST_ITEM_COMMENTS',						'%d Comments');

define('_EDITC_URL',				'Web site');
define('_EDITC_EMAIL',				'E-mail');

define('_MANAGER_PLUGINFILE_NOTFOUND',				"Plugin %s was not loaded (File not found)");
/* changed */
// plugin dependency 
define('_ERROR_INSREQPLUGIN',		'Plugin installation failed, requires %s');
define('_ERROR_DELREQPLUGIN',		'Plugin deletion failed, required by %s');

//define('_ADD_ADDLATER',								'Add Later');
define('_ADD_ADDLATER',								'Add the dates specified');

define('_LOGIN_NAME',				'Name:');
define('_LOGIN_PASSWORD',			'Password:');

// changed from _BOOKMARLET_BMARKLFOLLOW
define('_BOOKMARKLET_BMARKFOLLOW',					' (Works with nearly all browsers)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
define('_ADMIN_NOTABILIA',							'Some information');
define('_ADMIN_PLEASE_READ',						"Before you start, here's some <strong>important information</strong>");
define('_ADMIN_HOW_TO_ACCESS',						"After you've created a new weblog, you'll need to perform some actions to make your blog accessible. There are two possibilities:");
define('_ADMIN_SIMPLE_WAY',							"<strong>Simple:</strong> Create a copy of <code>index.php</code> and modify it to display your new weblog. Further instructions on how to do this will be provided after you've submitted this first form.");
define('_ADMIN_ADVANCED_WAY',						"<strong>Advanced:</strong> Insert the blog content into your current skins using skinvars like <code>&lt;%otherblog()&gt;</code>. This way, you can place multiple blogs on the same page.");
define('_ADMIN_HOW_TO_CREATE',						'Create Weblog');


define('_BOOKMARKLET_NEW_CATEGORY',					'Item was added, and a new category was created. ');
define('_BOOKMARKLET_NEW_CATEGORY_EDIT',			'Click here to edit the name and description of the category.');
define('_BOOKMARKLET_NEW_WINDOW',					'Opens in new window');
define('_BOOKMARKLET_SEND_PING',					'Item was added successfully. Now pinging weblogs.com. Please hold on... (can take a while)'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
define('_OVERVIEW_SHOWALL',							'Show all blogs');	// <add by shizuki />

// Edit skins
define('_SKINEDIT_ALLOWEDBLOGS',						'Short blog names:');			// <add by shizuki>
define('_SKINEDIT_ALLOWEDTEMPLATESS',					'Template names:');		// <add by shizuki>

// delete member
define('_WARNINGTXT_NOTDELMEDIAFILES',				'Please note that media files will <b>NOT</b> be deleted. (At least not in this Nucleus version)');	// <add by shizuki />

// send Weblogupdate.ping
define('_UPDATEDPING_MESSAGE',						'<h2>Site Updated, Now pinging various weblog listing services...</h2><p>This can take a while...</p><p>If you aren\'t automatically passed through, '); // NOTE: This string is no longer in used
define('_UPDATEDPING_GOPINGPAGE',					'try again'); // NOTE: This string is no longer in used
define('_UPDATEDPING_PINGING',						'Pinging services, please wait...'); // NOTE: This string is no longer in used
define('_UPDATEDPING_VIEWITEM',						'View list of recent items for '); // NOTE: This string is no longer in used
define('_UPDATEDPING_VISITOWNSITE',					'Visit your own site'); // NOTE: This string is no longer in used

// General category
define('_EBLOGDEFAULTCATEGORY_NAME',				'General');
define('_EBLOGDEFAULTCATEGORY_DESC',				'Items that do not fit in other categories');

// First ITEM
define('_EBLOG_FIRSTITEM_TITLE',					'First Item');
define('_EBLOG_FIRSTITEM_BODY',						'This is the first item in your weblog. Feel free to delete it.');

// New weblog was created
define('_BLOGCREATED_TITLE',						'New weblog created');
define('_BLOGCREATED_ADDEDTXT',						"Your new weblog (%s) has been created. To continue, choose the way you'll want to make it viewable:");
define('_BLOGCREATED_SIMPLEWAY',					"Easiest: A copy of <code>%s.php</code>");
define('_BLOGCREATED_ADVANCEDWAY',					"Advanced: Call the weblog from existing skins");
define('_BLOGCREATED_SIMPLEDESC1',					"Method 1: Create an extra <code>%s.php</code> file");
define('_BLOGCREATED_SIMPLEDESC2',					"Create a file called <code>%s.php</code>, and copy-paste the following code into it:");
define('_BLOGCREATED_SIMPLEDESC3',					"Upload the file next to your existing <code>index.php</code> file, and you should be all set.");
define('_BLOGCREATED_SIMPLEDESC4',					"To finish the weblog creation process, please fill out the final URL for your weblog (the proposed value is a <em>guess</em>, don't take it for granted):");
define('_BLOGCREATED_ADVANCEDWAY2',					"Method 2: Call the weblog from existing skins");
define('_BLOGCREATED_ADVANCEDWAY3',					"To finish the weblog creation process, simply please fill out the final URL for your weblog: (might be the same as another already existing weblog)");

// Donate!
define('_ADMINPAGEFOOT_OFFICIALURL',				'http://nucleuscms.org/');
define('_ADMINPAGEFOOT_DONATEURL',					'http://nucleuscms.org/donate.php');
define('_ADMINPAGEFOOT_DONATE',						'Donate!');
define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group');

// Quick menu
define('_QMENU_MANAGE_SYSTEM',						'System info');

// Bookmarklet
define('_BOOKMARKLET_TITLE',						'Bookmarklet<!-- and Right Click Menu -->');
define('_BOOKMARKLET_DESC1',						'Bookmarklets allow adding items to your weblog with just one single click. ');
define('_BOOKMARKLET_DESC2',						'After installing these bookmarklets, you\'ll be able to click the \'add to weblog\' button on your browser toolbar, ');
define('_BOOKMARKLET_DESC3',						'and a Nucleus add-item window will popup, ');
define('_BOOKMARKLET_DESC4',						'containing the link and title of the page you were visiting, ');
define('_BOOKMARKLET_DESC5',						'plus any text you might have selected.');
define('_BOOKMARKLET_BOOKARKLET',					'bookmarklet');
define('_BOOKMARKLET_ANCHOR',						'Add to %s');
define('_BOOKMARKLET_BMARKTEXT',					'You can drag the following link to your favorites, or your browsers toolbar: ');
define('_BOOKMARKLET_BMARKTEST',					'(if you want to test the bookmarklet first, click the link)');

define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'Something went wrong');
define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'Could not create new category');

// BAN
define('_BAN_EXAMPLE_TITLE',						'An example');
define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193" will only block one computer, while "134.58.253" will block 256 IP addresses, including the one from the first example.');
define('_BAN_IP_CUSTOM',							'Custom: ');
define('_BAN_BANBLOGNAME',							'Only blog %s');

// Plugin Options
define('_PLUGIN_OPTIONS_TITLE',							'Options for %s');

// Plugin file loda error
define('_PLUGINFILE_COULDNT_BELOADED',				'Error: plugin file <strong>%s.php</strong> could not be loaded, or it has been set inactive because it does not support some features (check the <a href="?action=actionlog">actionlog</a> for more info)');

//ITEM add/edit template (for japanese only)
define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'Format :');
define('_ITEM_ADDEDITTEMPLATE_YEAR',				'Year');
define('_ITEM_ADDEDITTEMPLATE_MONTH',				'Month');
define('_ITEM_ADDEDITTEMPLATE_DAY',					'Day');
define('_ITEM_ADDEDITTEMPLATE_HOUR',				'Hour');
define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'Minute');

// Errors
define('_ERRORS_INSTALLSQL',						'install.sql should be deleted');
define('_ERRORS_INSTALLDIR',						'install directory should be deleted');  // <add by shizuki />
define('_ERRORS_INSTALLPHP',						'install.php should be deleted');
define('_ERRORS_UPGRADESDIR',						'nucleus/upgrades directory should be deleted');
define('_ERRORS_CONVERTDIR',						'nucleus/convert directory should be deleted');
define('_ERRORS_CONFIGPHP',							'config.php should be non-writable (chmod to 444)');
define('_ERRORS_STARTUPERROR1',						'<p>One or more of the Nucleus installation files are still present on the webserver, or are writable.</p><p>You should remove these files or change their permissions to ensure security. Here are the files that were found by Nucleus</p> <ul><li>');
define('_ERRORS_STARTUPERROR2',						'</li></ul><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnSecurityRisk\']</code> in <code>globalfunctions.php</code> to <code>0</code>, or do this at the end of <code>config.php</code>.</p>');
define('_ERRORS_STARTUPERROR3',						'Security Risk');

// PluginAdmin tickets by javascript
define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>Error occured during automatic addition of tickets.</b></p>');

// Global settings disablesite URL
define('_SETTINGS_DISABLESITEURL',					'Redirect URL:');

// Skin import/export
define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'UNEXPECTED TAG');
define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'Failed to open file/URL');
define('_SKINIE_NAME_CLASHES_DETECTED',				'Name clashes detected, re-run with allowOverwrite = 1 to force overwrite');

// ACTIONS.php parse_commentform
define('_ACTIONURL_NOTLONGER_PARAMATER',			'actionurl is not longer a parameter on commentform skinvars. Moved to be a global setting instead.');

// ADMIN.php addToTemplate 'Query error: '
define('_ADMIN_SQLDIE_QUERYERROR',					'Query error: ');

// backyp.php Backup WARNING
define('_BACKUP_BACKUPFILE_TITLE',					'This is a backup file generated by Nucleus');
define('_BACKUP_BACKUPFILE_BACKUPDATE',				'backup-date:');
define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Nucleus CMS version:');
define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nucleus CMS Database name:');
define('_BACKUP_BACKUPFILE_TABLE_NAME',				'TABLE:');
define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'Table Data for %s');
define('_BACKUP_WARNING_NUCLEUSVERSION',			'WARNING: Only try to restore on servers running the exact same version of Nucleus');
define('_BACKUP_RESTOR_NOFILEUPLOADED',				'No file uploaded');
define('_BACKUP_RESTOR_UPLOAD_ERROR',				'File Upload Error');
define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'The uploaded file is not of the correct type');
define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'Cannot decompress gzipped backup (zlib package not installed)');
define('_BACKUP_RESTOR_SQL_ERROR',					'SQL Error: ');

// BLOG.php addTeamMember
define('_TEAM_ADD_NEWTEAMMEMBER',					'Added %s (ID=%d) to the team of blog "%s"');

// ADMIN.php systemoverview()
define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'System Overview');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL',			'PHP and MySQL');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'Versions');
define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'PHP version');
define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'MySQL version');
define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'Settings');
define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'GD Libraly');
define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Modules');
define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'enabled');
define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'disabled');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Your Nucleus CMS System');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Nucleus CMS version');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Nucleus CMS patch level');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'Important settings');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'Check for a new version');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'Check on nucleuscms.org if a new version is available: ');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://nucleuscms.org/version.php?v=%d&amp;pl=%d');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'Check for upgrade');
define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			"You haven't enough rights to see the system informations.");

// ENCAPSULATE.php
define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'No entries');

// globalfunctions.php
define('_GFUNCTIONS_LOGINPCSHARED_YES',				'on shared PC');
define('_GFUNCTIONS_LOGINPCSHARED_NO',				'on not shared PC');
define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'Login successful for %s (%s)');
define('_GFUNCTIONS_LOGINFAILED_TXT',				'Login failed for %s');
define('_GFUNCTIONS_LOGOUT_TXT',					'%s is logouted');
define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		' in <code>%s</code> line <code>%s</code>');
define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		' Page headers already sent');
define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>The page headers have already been sent out%s. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the translation file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>');
define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'A file is missing');
define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'Sorry. An error occurred.');
define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			"You aren't logged in.");

// MANAGER.php
define('_MANAGER_PLUGINFILE_NOCLASS',				"Plugin %s was not loaded (Class not found in file, possible parse error)");
define('_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT',		"Plugin %s was not loaded (does not support SqlTablePrefix)");

// mysql.php
define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>No suitable mySQL library was found to run Nucleus</p>");

// PLUGIN.php
define('_ERROR_PLUGIN_NOSUCHACTION',				'No Such Action');

// PLUGINADMIN.php
define('_ERROR_INVALID_PLUGIN',						'Invalid plugin');

// showlist.php
define('_LIST_PLUGS_DEPREQ',						'Plugin(s) requires:');
define('_LIST_SKIN_PREVIEW',						"Preview for '%s' skin");
define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"View larger");
define('_LIST_SKIN_README',							"More info on the '%s' skin");
define('_LIST_SKIN_README_TXT',						'Read me');

// BLOG.php createNewCategory()
define('_CREATED_NEW_CATEGORY_NAME',				'newcat');
define('_CREATED_NEW_CATEGORY_DESC',				'New category');

// ADMIN.php blog settings
define('_EBLOG_CURRENT_TEAM_MEMBER',				'Members currently on your team:');

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
define('_AUTOSAVEDRAFT',		'Auto save draft');
define('_AUTOSAVEDRAFT_LASTSAVED',	'Last saved: ');
define('_AUTOSAVEDRAFT_NOTYETSAVED',	'No saves have been made yet');
define('_AUTOSAVEDRAFT_NOW',		'Auto save now');
define('_SKIN_PARTS_SPECIAL',		'Special skin parts');
define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',		'You must enter a name that exists only out of lowercase letters and digits');
define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',		'Can\'t delete this skin part');
define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',		'Do you really want to delete this special skin part?');
define('_ERROR_PLUGIN_LOAD',		'Plugin could not be loaded, or does not support certain features that are required for it to run on your Nucleus installation (you might want to check the <a href="?action=actionlog">actionlog</a> for more info)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
define('_SEARCHFORM_QUERY',			'Keywords to search');
define('_ERROR_EMAIL_REQUIRED',		'Email address is required');
define('_COMMENTFORM_MAIL',			'Website:');
define('_COMMENTFORM_EMAIL',		'E-mail:');
define('_EBLOG_REQUIREDEMAIL',		'Require E-mail address with comments?');
define('_ERROR_COMMENTS_SPAM',      'Your comment was rejected because it did not pass the spam test');
// END changed/added after 3.22 END

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
define('_ERROR_NOSUCHLOCALE',		'��� ������ ��������� �����');
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
define('_ACTIONLOG_DISALLOWED',		'���������� ��������: ');
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
define('_SETTINGS_ALLOWUPLOADTYPES','���������� ����������');
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
define('_SETTINGS_LOCALE',		'���� �� ���������');
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
define('_MEMBERS_LOCALE',			'����');
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
