<?php
// French Nucleus Language File
//
// Author: Papachango <pfffouitt@yahoo.fr> (updated by Julien Pauthier <julienpauthier@yahoo.fr>)
// Nucleus version: v1.0-v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)
if (!defined('_CHARSET')) define('_CHARSET', 'UTF-8'); // charset to use
if (!defined('_LOCALE'))  define('_LOCALE', 'fr_FR');
if (!defined('_LOCALE_NAME_WINDOWS'))  define('_LOCALE_NAME_WINDOWS', 'french');

/********************************************
 *        Start New for 3.71                *
 ********************************************/
define('_ADMIN_SYSTEMOVERVIEW_DBANDVERSION',  'Database and Version');
define('_ADMIN_SYSTEMOVERVIEW_DBDRIVER',      'Database Driver');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDDB',      'PHP and Database');

define('_TEAM_NO_SELECTABLE_MEMBERS',         'team does not have selectable members');

define('_LISTS_FORM_SELECT_ALL_CATEGORY',    'All categories');

define('_LISTS_ITEM_COUNT',      'Item count');
define('_LISTS_ORDER',           'order');

define('_EBLOG_CAT_ORDER',            "This is the order of the category.<br />\nInput value will be on the smaller in number (standard 100)");
define('_EBLOG_CAT_ORDER_DESC2',      "Input value will be on the smaller in number (standard 100)");

// category order changes (batch)
define('_BATCH_CAT_CAHANGE_ORDER',                 'change the order');
define('_ERROR_CAHANGE_CATEGORY_ORDER',            'You can not change the sort');
define('_CAHANGE_CATEGORY_ORDER_TITLE',            'Please specify the order of the category');
define('_CAHANGE_CATEGORY_ORDER_CONFIRM_DESC',     'The order of the following categories will be changed at once.If it is good, please press the button.');
define('_CAHANGE_CATEGORY_ORDER_BTN_TITLE',        'Change the order');

// Skin import/export
define('_SKINIE_ERROR_FAILEDLOAD_XML',        'Failed to Load XML');

 /********************************************
 *        Start New for 3.65                *
 ********************************************/
define('_LISTS_AUTHOR', 'Author');
define('_OVERVIEW_OTHER_DRAFTS', 'Other Drafts');
 
/********************************************
 *        Start New for 3.64                *
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

// REG file
define('_WINREGFILE_TEXT',							'Post To &Nucleus (%s)');

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
define('_BOOKMARKLET_RIGHTCLICK',					'Right Click Menu Access (IE &amp; Windows)');
define('_BOOKMARKLET_RIGHTLABEL',					'right click menu item');
define('_BOOKMARKLET_RIGHTTEXT1',					'Or you can install the ');
define('_BOOKMARKLET_RIGHTTEXT2',					' (choose \'open file\' and add to registry)');
define('_BOOKMARKLET_RIGHTTEXT3',					'You\'ll have to restart Internet Explorer before the option shows up in the context menus.');
define('_BOOKMARKLET_UNINSTALLTT',					'Uninstalling');
define('_BOOKMARKLET_DELETEBAR',					'For the bookmarklet, you can just delete it.');
define('_BOOKMARKLET_DELETERIGHTT',					'For the right click menu item, follow the procedure listed below:');
define('_BOOKMARKLET_DELETERIGHT1',					'Select "Run..." from the Start Menu');
define('_BOOKMARKLET_DELETERIGHT2',					'Type: "regedit"');
define('_BOOKMARKLET_DELETERIGHT3',					'Click the "OK" button');
define('_BOOKMARKLET_DELETERIGHT4',					'Search for "\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" in the tree');
define('_BOOKMARKLET_DELETERIGHT5',					'Delete the "add to \'Your weblog\'" item');

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

// backup.php Backup WARNING
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
define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>The page headers have already been sent out%s. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the language file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>');
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

// HTML outputs
define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us"');

// Language Files
define('_LANGUAGEFILES_JAPANESE-UTF8',				'Japanese - &#26085;&#26412;&#35486; (UTF-8)');
define('_LANGUAGEFILES_JAPANESE-EUC',				'Japanese - &#26085;&#26412;&#35486; (EUC)');
define('_LANGUAGEFILES_ENGLISH-UTF8',				'English - English (UTF-8)');
define('_LANGUAGEFILES_ENGLISH',					'English - English (iso-8859-1)');
/*
define('_LANGUAGEFILES_BULGARIAN',					'Bulgarian - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
define('_LANGUAGEFILES_CATALAN',					'Catalan - Catal&agrave; (iso-8859-1)');
define('_LANGUAGEFILES_CHINESE-GBK',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
define('_LANGUAGEFILES_SIMCHINESE',					'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
define('_LANGUAGEFILES_CHINESE-UTF8',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CHINESEB5',					'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_CHINESEB5-UTF8',				'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CZECH',						'Czech - &#268;esky (windows-1250)');
define('_LANGUAGEFILES_FINNISH',					'Finnish - Suomi (iso-8859-1)');
define('_LANGUAGEFILES_FRENCH',						'French - Fran&ccedil;ais (iso-8859-1)');
define('_LANGUAGEFILES_GALEGO',						'Galego - Galego (iso-8859-1)');
define('_LANGUAGEFILES_GERMAN',						'German - Deutsch (iso-8859-1)');
define('_LANGUAGEFILES_HUNGARIAN',					'Hungarian - Magyar (iso-8859-2)');
define('_LANGUAGEFILES_ITALIANO',					'Italiano - Italiano (iso-8859-1)');
define('_LANGUAGEFILES_KOREAN-UTF8',				'Korean - &#54620;&#44397;&#50612; (utf-8)');
define('_LANGUAGEFILES_LATVIAN',					'Latvian - Latvie&scaron;u (windows-1257)');
define('_LANGUAGEFILES_NEDERLANDS',					'Duch - Nederlands (iso-8859-15)');
define('_LANGUAGEFILES_PERSIAN',					'Persian - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'Portuguese Brazil - Portugu&ecirc;s (iso-8859-1)');
define('_LANGUAGEFILES_RUSSIAN',					'Russian - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
define('_LANGUAGEFILES_SLOVAK',						'Slovak - Sloven&#269;ina (ISO-8859-2)');
define('_LANGUAGEFILES_SPANISH-UTF8',				'Spanish - Espa&ntilde;ol (utf-8)');
define('_LANGUAGEFILES_SPANISH',					'Spanish - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

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

define('_LIST_PLUG_SUBS_NEEDUPDATE',	'Veuillez utiliser le bouton \'Mettre ï¿½ jour la liste des installations\' pour mettre ï¿½ jour la liste des modules installï¿½s.');
define('_LIST_PLUGS_DEP',		'Ce module nï¿½cessite:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',		'Tous les commentaires du blog');
define('_NOCOMMENTS_BLOG',		'Aucun commentaire n\'a ï¿½tï¿½ fait sur les billets de ce blog');
define('_BLOGLIST_COMMENTS',		'Commentaires');
define('_BLOGLIST_TT_COMMENTS',		'Liste de tous les commentaires apportï¿½s aux billets de blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',		'jour');
define('_ARCHIVETYPE_MONTH',		'mois');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',		'Ticket invalide ou expirï¿½.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'L\'installation a ï¿½chouï¿½ car le module nï¿½cessite ');
define('_ERROR_DELREQPLUGIN',		'L\'dï¿½sinstallation a ï¿½chouï¿½ car le module est requis par ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Prï¿½fixe du cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Impossible d\'envoyer le lien d\'activation. Vous n\'ï¿½tes pas autorisï¿½ ï¿½ vous authentifier.');
define('_ERROR_ACTIVATE',		'La clef d\'activation key n\'existe pas, est invalide, ou a expirï¿½.');
define('_ACTIONLOG_ACTIVATIONLINK', 	'Lien d\'activation envoyï¿½');
define('_MSG_ACTIVATION_SENT',		'Lien d\'activation a ï¿½tï¿½ envoyï¿½ par mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Bonjour <%memberName%>,\n\nvous devez activer votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassï¿½s 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activez votre compte '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Une derniï¿½re ï¿½tape : choisissez un mot de passe pour votre compte.');
define('_ACTIVATE_FORGOT_MAIL',		"Bonjour <%memberName%>,\n\nEn suivant le lien ci-dessous, vous pouvez choisir un nouveau mot de passe pour votre compte sur <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nPassï¿½s 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_FORGOT_MAILTITLE',	"Procï¿½dez ï¿½ la rï¿½activation de votre compte '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Vous pouvez choisir un nouveau mot de passe pour votre compte ci-dessous :');
define('_ACTIVATE_CHANGE_MAIL',		"Bonjour <%memberName%>,\n\nMaintenant que votre adresse email a ï¿½tï¿½ changï¿½e, vous devez rï¿½activation de votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassï¿½s 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_CHANGE_MAILTITLE',	"Procï¿½dez ï¿½ la rï¿½activation de votre compte '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Votre changement d\'adresse email a ï¿½tï¿½ validï¿½. Merci !');
define('_ACTIVATE_SUCCESS_TITLE',	'Activation rï¿½ussie');
define('_ACTIVATE_SUCCESS_TEXT',	'Votre compte a ï¿½tï¿½ rï¿½activï¿½.');
define('_MEMBERS_SETPWD',		'Choisissez un mot de passe');
define('_MEMBERS_SETPWD_BTN',		'Choisissez un mot de passe');
define('_QMENU_ACTIVATE',		'Activation de compte');
define('_QMENU_ACTIVATE_TEXT',		'<p>Dï¿½s l\'activation de votre compte, vous pouvez commencer ï¿½ l\'utiliser en <a href="index.php?action=showlogin">vous authentifiant</a>.</p>');

define('_PLUGS_BTN_UPDATE',		'Mettre ï¿½ jour la liste des installations');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Type de barre d\'ï¿½dition');
define('_SETTINGS_JSTOOLBAR_FULL',	'Barre d\'ï¿½dition complï¿½te (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE',	'Barre d\'ï¿½dition simplifiï¿½e (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Dï¿½sactiver la barre d\'ï¿½dition');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">activer l\'utilisation des URLs pour la recherche</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',		'Autres paramï¿½tres du module');

// itemlist info column keys
define('_LIST_ITEM_BLOG',		'blog:');
define('_LIST_ITEM_CAT',		'thï¿½me:');
define('_LIST_ITEM_AUTHOR',		'auteur:');
define('_LIST_ITEM_DATE',		'date:');
define('_LIST_ITEM_TIME',		'heure:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(participant)');

// batch operations
define('_BATCH_WITH_SEL',		'Ayant pour sï¿½lection:');
define('_BATCH_EXEC',			'Executer');

// quickmenu
define('_QMENU_HOME',			'Accueil');
define('_QMENU_ADD',			'Ajouter un billet');
define('_QMENU_ADD_SELECT',		'-- sï¿½lectionnez --');
define('_QMENU_USER_SETTINGS',		'Prï¿½fï¿½rences');
define('_QMENU_USER_ITEMS',		'Billets');
define('_QMENU_USER_COMMENTS',		'Commentaires');
define('_QMENU_MANAGE',			'Paramï¿½tres');
define('_QMENU_MANAGE_LOG',		'Log');
define('_QMENU_MANAGE_SETTINGS',	'Configuration');
define('_QMENU_MANAGE_MEMBERS',		'Participants');
define('_QMENU_MANAGE_NEWBLOG',		'Nouveau blog');
define('_QMENU_MANAGE_BACKUPS',		'Sauvegardes');
define('_QMENU_MANAGE_PLUGINS',		'Modules');
define('_QMENU_LAYOUT',			'Mise en page');
define('_QMENU_LAYOUT_SKINS',		'Habillages');
define('_QMENU_LAYOUT_TEMPL',		'Modï¿½les');
define('_QMENU_LAYOUT_IEXPORT',		'Importer/Exporter');
define('_QMENU_PLUGINS',		'Modules');

// quickmenu on logon screen
define('_QMENU_INTRO',			'Introduction');
define('_QMENU_INTRO_TEXT',		'<p>Ceci est la page d\'authentification de Nucleus CMS, le systï¿½me permettant la mise ï¿½ jour du contenu de ce site.</p><p>Pour mettre en ligne de nouveaux billets, authentifiez-vous.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Impossible de trouver le fichier d\'aide correspondant ï¿½ ce module');
define('_PLUGS_HELP_TITLE',		'Page d\'aide pour le module');
define('_LIST_PLUGS_HELP', 		'aide');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',		'Activer le systï¿½me d\'authentification externe');
define('_WARNING_EXTAUTH',		'Attention: ï¿½ n\'activer que si nï¿½cessaire.');

// member profile
define('_MEMBERS_BYPASS',		'Utiliser le systï¿½me d\'authentification externe');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',			'<em>Toujours</em> inclure dans la recherche');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',			'afficher');
define('_MEDIA_VIEW_TT',		'Afficher la page (ouvrir une nouvelle fenï¿½tre)');
define('_MEDIA_FILTER_APPLY',		'Appliquer le filtre');
define('_MEDIA_FILTER_LABEL',		'Filtre: ');
define('_MEDIA_UPLOAD_TO',		'Tï¿½lï¿½charger dans...');
define('_MEDIA_UPLOAD_NEW',		'Tï¿½lï¿½charger un nouveau fichier...');
define('_MEDIA_COLLECTION_SELECT',	'Sï¿½lectionner');
define('_MEDIA_COLLECTION_TT',		'Changer de bibliothï¿½que');
define('_MEDIA_COLLECTION_LABEL',	'Bibliothï¿½que actuelle: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',		'Aligner ï¿½ gauche');
define('_ADD_ALIGNRIGHT_TT',		'Aligner ï¿½ droite');
define('_ADD_ALIGNCENTER_TT',		'Centrer');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Echec du tï¿½lï¿½chargement');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permettre d\'antidater');
define('_ADD_CHANGEDATE',		'Mise ï¿½  jour  de la date');
define('_BMLET_CHANGEDATE',		'Mise ï¿½  jour de la date');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Habillage import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Utiliser un dossier d\'habillage');
define('_SKIN_INCLUDE_MODE',		'Type d\'inclusion');
define('_SKIN_INCLUDE_PREFIX',		'Prï¿½fixe d\'inclusion');

// global settings
define('_SETTINGS_BASESKIN',		'Habillage de base');
define('_SETTINGS_SKINSURL',		'URL pour l\'habillage');
define('_SETTINGS_ACTIONSURL',		'URL complet pour action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Impossible de dï¿½placer le thï¿½me par dï¿½faut');
define('_ERROR_MOVETOSELF',		'Impossible de dï¿½placer le thï¿½me (le blog de destination est identique au blog source)');
define('_MOVECAT_TITLE',		'Sï¿½lectionner le blog dans lequel vous souhaitez dï¿½placer ce thï¿½me');
define('_MOVECAT_BTN',			'Dï¿½placer le thï¿½me');

// URLMode setting
define('_SETTINGS_URLMODE',		'Type de lien');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO',	'Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Aucune action sï¿½lectionnï¿½e');
define('_BATCH_ITEMS',			'Action sur les billets');
define('_BATCH_CATEGORIES',		'Action sur les thï¿½mes');
define('_BATCH_MEMBERS',		'Action sur les participants');
define('_BATCH_TEAM',			'Action sur les participants d\'un blog');
define('_BATCH_COMMENTS',		'Action sur les commentaires');
define('_BATCH_UNKNOWN',		'Action inconnue: ');
define('_BATCH_EXECUTING',		'En cours');
define('_BATCH_ONCATEGORY',		'sur un thï¿½me');
define('_BATCH_ONITEM',			'sur un ï¿½lï¿½ment');
define('_BATCH_ONCOMMENT',		'sur un commentaire');
define('_BATCH_ONMEMBER',		'sur un participant');
define('_BATCH_ONTEAM',			'sur le participant du blog');
define('_BATCH_SUCCESS',		'Action rï¿½ussie!');
define('_BATCH_DONE',			'Terminï¿½!');
define('_BATCH_DELETE_CONFIRM',		'Confirmer la suppression');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmer');
define('_BATCH_SELECTALL',		'Tout sï¿½lectionner');
define('_BATCH_DESELECTALL',		'Annuler la sï¿½lection');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Supprimer');
define('_BATCH_ITEM_MOVE',		'Dï¿½placer');
define('_BATCH_MEMBER_DELETE',		'Supprimer');
define('_BATCH_MEMBER_SET_ADM',		'Donner les droits d\'administrateur');
define('_BATCH_MEMBER_UNSET_ADM',	'Retirer les droits d\'administrateur');
define('_BATCH_TEAM_DELETE',		'Retirer de l\'ï¿½quipe');
define('_BATCH_TEAM_SET_ADM',		'Donner les droits d\'administrateur');
define('_BATCH_TEAM_UNSET_ADM',		'Retirer les droits d\'administrateur');
define('_BATCH_CAT_DELETE',		'Supprimer');
define('_BATCH_CAT_MOVE',		'Dï¿½placer vers un autre blog');
define('_BATCH_COMMENT_DELETE',		'Supprimer');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',		'Ajouter un nouveau billet...');
define('_ADD_PLUGIN_EXTRAS',		'Options supplï¿½mentaires des modules');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossible de crï¿½er le nouveau thï¿½me');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ce module requiert une version ultï¿½rieure de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Retour au menu de configuration des blogs');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importation');
define('_SKINIE_TITLE_EXPORT',		'Exportation');
define('_SKINIE_BTN_IMPORT',		'Importer');
define('_SKINIE_BTN_EXPORT',		'Exporter les habillages/modï¿½les sï¿½lectionnï¿½s');
define('_SKINIE_LOCAL',			'Importer depuis un fichier local:');
define('_SKINIE_NOCANDIDATES',		'Aucun habillage trouvï¿½ dans le rï¿½pertoire skins');
define('_SKINIE_FROMURL',		'Importer ï¿½ partir d\'un lien:');
define('_SKINIE_EXPORT_INTRO',		'Sï¿½lectionnez ci-dessous les habillages et modï¿½les que vous souhaitez exporter:');
define('_SKINIE_EXPORT_SKINS',		'Habillages');
define('_SKINIE_EXPORT_TEMPLATES',	'Modï¿½les');
define('_SKINIE_EXPORT_EXTRA',		'Notes');
define('_SKINIE_CONFIRM_OVERWRITE',	'Ecraser l\'ancienne version?');
define('_SKINIE_CONFIRM_IMPORT',	'Oui, je veux importer ceci');
define('_SKINIE_CONFIRM_TITLE',		'A propos de l\'importation d\'habillage et de modï¿½le');
define('_SKINIE_INFO_SKINS',		'Habillages dans le fichier:');
define('_SKINIE_INFO_TEMPLATES',	'Modï¿½les dans le fichier:');
define('_SKINIE_INFO_GENERAL',		'Notes:');
define('_SKINIE_INFO_SKINCLASH',	'Nom de l\'habillage:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nom du modï¿½le:');
define('_SKINIE_INFO_IMPORTEDSKINS',	'Habillage importï¿½:');
define('_SKINIE_INFO_IMPORTEDTEMPLS',	'Modï¿½le importï¿½:');
define('_SKINIE_DONE',			'Importation rï¿½ussie');

define('_AND',				'et');
define('_OR',				'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'Champ vide (cliquer pour modifier)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Type d\'inclusion:');
define('_LIST_SKINS_INCPREFIX',		'Prï¿½fixe d\'inclusion:');
define('_LIST_SKINS_DEFINED',		'Habillages dï¿½finis:');

// backup
define('_BACKUPS_TITLE',		'Sauvegarde / Rï¿½cupï¿½ration');
define('_BACKUP_TITLE',			'Sauvegarde');
define('_BACKUP_INTRO',			'Cliquez sur le bouton ci-dessous pour crï¿½er une sauvegarde de votre base de donnï¿½es Nucleus. Enregistrez-la dans un fichier. Gardez-le en lieu sï¿½r.');
define('_BACKUP_ZIP_YES',		'Essayer d\'utiliser la compression');
define('_BACKUP_ZIP_NO',		'Ne pas utiliser la compression');
define('_BACKUP_BTN',			'Sauvegarder!');
define('_BACKUP_NOTE',			'<b>NB:</b> Seul le contenu de la base de donnï¿½es est sauvegardï¿½. Les fichiers Media importï¿½s et la configuration de config.php <b>NE SONT PAS</b> inclus dans la sauvegarde.');
define('_RESTORE_TITLE',		'Rï¿½cupï¿½ration');
define('_RESTORE_NOTE',			'<b>ATTENTION:</b> Restaurer une sauvegarde <b>EFFACERA</b> toutes les donnï¿½es contenues dans la base de donnï¿½es Nucleus! N\'agissez qu\'en connaissance de cause!<br /><b>NB:</b> Vï¿½rifiez que la version de Nucleus de votre sauvegarde soit la mï¿½me que celle que vous utilisez actuellement autrement cela ne fonctionnera pas.');
define('_RESTORE_INTRO',		'Sï¿½lectionnez le fichier de rï¿½cupï¿½ration ci-dessous (il sera tï¿½lï¿½chargï¿½ sur le serveur) et cliquez sur le bouton "Rï¿½cupï¿½ration" pour procï¿½der.');
define('_RESTORE_IMSURE',		'Oui, je suis sï¿½r!');
define('_RESTORE_BTN',			'Rï¿½cupï¿½ration');
define('_RESTORE_WARNING',		'(Vï¿½rifiez que vous restaurez le bon fichier de sauvegarde. Faites une nouvelle sauvegarde avant de commencer si vous n\'ï¿½tes pas sï¿½r.)');
define('_ERROR_BACKUP_NOTSURE',		'Vous devez cliquer sur le bouton \'je suis sï¿½r\'');
define('_RESTORE_COMPLETE',		'Rï¿½cupï¿½ration terminï¿½e');

// new item notification
define('_NOTIFY_NI_MSG',		'Nouveau billet:');
define('_NOTIFY_NI_TITLE',		'Nouveau!');
define('_NOTIFY_KV_MSG',		'Votes Karma pour le billet:');
define('_NOTIFY_KV_TITLE',		'Nucleus karma:');
define('_NOTIFY_NC_MSG',		'Commentaires sur le billet:');
define('_NOTIFY_NC_TITLE',		'Commentaire Nucleus:');
define('_NOTIFY_USERID',		'Utilisateur:');
define('_NOTIFY_USER',			'Utilisateur:');
define('_NOTIFY_COMMENT',		'Commentaire:');
define('_NOTIFY_VOTE',			'Vote:');
define('_NOTIFY_HOST',			'Hï¿½te:');
define('_NOTIFY_IP',			'IP:');
define('_NOTIFY_MEMBER',		'Participant:');
define('_NOTIFY_TITLE',			'Titre:');
define('_NOTIFY_CONTENTS',		'Contenu:');

// member mail message
define('_MMAIL_MSG',			'Vous avez reï¿½u un message de');
define('_MMAIL_FROMANON',		'un visiteur anonyme');
define('_MMAIL_FROMNUC',		'Postï¿½ depuis un weblog Nucleus ï¿½');
define('_MMAIL_TITLE',			'Un message de');
define('_MMAIL_MAIL',			'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',			'Ajouter un  billet');
define('_BMLET_EDIT',			'Modifier un billet');
define('_BMLET_DELETE',			'Effacer un billet');
define('_BMLET_BODY',			'Corps');
define('_BMLET_MORE',			'Dï¿½veloppement');
define('_BMLET_OPTIONS',		'Options');
define('_BMLET_PREVIEW',		'Prï¿½visualisation');

// used in bookmarklet
define('_ITEM_UPDATED',			'Billet mis ï¿½ jour');
define('_ITEM_DELETED',			'Billet effacï¿½');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Etes-vous sur de vouloir supprimer ce module?');
define('_ERROR_NOSUCHPLUGIN',		'Pas de module correspondant');
define('_ERROR_DUPPLUGIN',		'Dï¿½solï¿½, ce module est dï¿½jï¿½ installï¿½');
define('_ERROR_PLUGFILEERROR',		'Ce module n\'existe pas, ou les permissions sont mal configurï¿½es');
define('_PLUGS_NOCANDIDATES',		'Pas de module valide trouvï¿½');

define('_PLUGS_TITLE_MANAGE',		'Gï¿½rer les modules');
define('_PLUGS_TITLE_INSTALLED',	'Dï¿½jï¿½ installï¿½s');
define('_PLUGS_TITLE_UPDATE',		'Mettre ï¿½ jour la liste des installations');
define('_PLUGS_TEXT_UPDATE',		'Nucleus garde un cache des inscriptions des modules. Quand vous mettez ï¿½ jour un module en remplaï¿½ant son fichier, vous devez utiliser cette fonction pour mettre ï¿½ jour le cache.');
define('_PLUGS_TITLE_NEW',		'Installer un nouveau module');
define('_PLUGS_ADD_TEXT',		'Vous trouverez ci-dessous la liste de tous les fichiers contenus dans votre rï¿½pertoire de plugins. Il peut s\'agir de modules non-installï¿½s. Soyez <strong>vraiment</strong> sï¿½r qu\'il s\'agit d\'un module avant de l\'ajouter.');
define('_PLUGS_BTN_INSTALL',		'Installer le module');
define('_BACKTOOVERVIEW',		'Retour au sommaire');

// editlink
define('_TEMPLATE_EDITLINK',		'Modifier le lien du billet');

// add left / add right tooltips
define('_ADD_LEFT_TT',			'Ajouter un cadre ï¿½ gauche');
define('_ADD_RIGHT_TT',			'Ajouter un cadre ï¿½ droite');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',			'Nouveau thï¿½me...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL des modules');
define('_SETTINGS_MAXUPLOADSIZE',	'Taille maxi. du fichier tï¿½lï¿½chargï¿½ (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Autoriser les non-participants ï¿½ envoyer des messages');
define('_SETTINGS_PROTECTMEMNAMES',	'Protï¿½ger les noms des participants');

// overview screen
define('_OVERVIEW_PLUGINS',		'Gï¿½rer les modules...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Inscription d\'un nouveau participant:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',		'Votre adresse email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Vous n\'avez pas les droits d\'admin sur les blogs de ce participant. Vous n\'ï¿½tes donc pas autorisï¿½ ï¿½ tï¿½lï¿½charger de fichier sur le rï¿½pertoire media de ce participant.');

// plugin list
define('_LISTS_INFO',			'Information');
define('_LIST_PLUGS_AUTHOR',		'de:');
define('_LIST_PLUGS_VER',		'Version:');
define('_LIST_PLUGS_SITE',		'Visiter le site');
define('_LIST_PLUGS_DESC',		'Description:');
define('_LIST_PLUGS_SUBS',		'Inscription aux ï¿½vï¿½nements suivants:');
define('_LIST_PLUGS_UP',		'monter');
define('_LIST_PLUGS_DOWN',		'descendre');
define('_LIST_PLUGS_UNINSTALL',		'dï¿½sinstaller');
define('_LIST_PLUGS_ADMIN',		'admin');
define('_LIST_PLUGS_OPTIONS',		'modifier les options');

// plugin option list
define('_LISTS_VALUE',			'Valeur');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'ce plugin n\'a pas d\'option');
define('_PLUGS_BACK',			'Retour au menu des modules');
define('_PLUGS_SAVE',			'Sauvegarder les options');
define('_PLUGS_OPTIONS_UPDATED',	'Options du module mises ï¿½ jour');

define('_OVERVIEW_MANAGEMENT',		'Gestion');
define('_OVERVIEW_MANAGE',		'Gestion de Nucleus...');
define('_MANAGE_GENERAL',		'Gestion globale');
define('_MANAGE_SKINS',			'Habillages et modï¿½les');
define('_MANAGE_EXTRA',			'Options supplï¿½mentaires');

define('_BACKTOMANAGE',			'Retour au menu de gestion de Nucleus');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',			'Dï¿½connexion');
define('_LOGIN',			'Connexion');
define('_YES',				'Oui');
define('_NO',				'Non');
define('_SUBMIT',			'Envoyer');
define('_ERROR',			'Erreur');
define('_ERRORMSG',			'Une erreur est survenue!');
define('_BACK',				'Retour');
define('_NOTLOGGEDIN',			'Non connectï¿½');
define('_LOGGEDINAS',			'Connectï¿½ en tant que');
define('_ADMINHOME',			'Accueil');
define('_NAME',				'Nom');
define('_BACKHOME',			'Retour ï¿½ l\'accueil');
define('_BADACTION',			'Action inconnue');
define('_MESSAGE',			'Message');
define('_HELP_TT',			'Aide!');
define('_YOURSITE',			'Votre site');


define('_POPUP_CLOSE',			'Fermer la fenï¿½tre');

define('_LOGIN_PLEASE',			'Connectez-vous d\'abord, SVP');

// commentform
define('_COMMENTFORM_YOUARE',		'Vous ï¿½tes');
define('_COMMENTFORM_SUBMIT',		'Ajouter un commentaire');
define('_COMMENTFORM_COMMENT',		'Votre commentaire');
define('_COMMENTFORM_NAME',		'Nom');
define('_COMMENTFORM_MAIL',		'Email/HTTP');
define('_COMMENTFORM_REMEMBER',		'Retenir votre nom');

// loginform
define('_LOGINFORM_NAME',		'Nom d\'utilisateur');
define('_LOGINFORM_PWD',		'Mot de passe');
define('_LOGINFORM_YOUARE',		'Connectï¿½ en tant que');
define('_LOGINFORM_SHARED',		'Ordinateur partagï¿½');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Envoyer un message');

// search form
define('_SEARCHFORM_SUBMIT',		'Rechercher');

// add item form
define('_ADD_ADDTO',			'Ajouter un billet ï¿½');
define('_ADD_CREATENEW',		'Crï¿½er un nouveau billet');
define('_ADD_BODY',			'Corps');
define('_ADD_TITLE',			'Titre');
define('_ADD_MORE',			'Dï¿½veloppement (facultatif)');
define('_ADD_CATEGORY',			'Thï¿½me');
define('_ADD_PREVIEW',			'Prï¿½visualisation');
define('_ADD_DISABLE_COMMENTS',		'Interdire les commentaires?');
define('_ADD_DRAFTNFUTURE',		'Brouillons &amp; billets ï¿½ venir');
define('_ADD_ADDITEM',			'Ajouter le billet');
define('_ADD_ADDNOW',			'Ajouter maintenant');
define('_ADD_ADDLATER',			'Ajouter plus tard');
define('_ADD_PLACE_ON',			'Datï¿½ du');
define('_ADD_ADDDRAFT',			'Ajouter aux brouillons');
define('_ADD_NOPASTDATES',		'(Les dates et heures passï¿½es ne sont pas valides, la date d\'aujourd\'hui sera utilisï¿½e)');
define('_ADD_BOLD_TT',			'Gras');
define('_ADD_ITALIC_TT',		'Italiques');
define('_ADD_HREF_TT',			'Faire un lien');
define('_ADD_MEDIA_TT',			'Ajouter un document');
define('_ADD_PREVIEW_TT',		'Montrer/cacher la prï¿½visualisation');
define('_ADD_CUT_TT',			'Couper');
define('_ADD_COPY_TT',			'Copier');
define('_ADD_PASTE_TT',			'Coller');


// edit item form
define('_EDIT_ITEM',			'Modifier le billet');
define('_EDIT_SUBMIT',			'Valider');
define('_EDIT_ORIG_AUTHOR',		'Auteur');
define('_EDIT_BACKTODRAFTS',		'Remettre aux brouillons');
define('_EDIT_COMMENTSNOTE',		'(NB: Dï¿½sactiver les commentaires ne cachera pas les anciens)');

// used on delete screens
define('_DELETE_CONFIRM',		'SVP, confirmez la suppression');
define('_DELETE_CONFIRM_BTN',		'Confirmer');
define('_CONFIRMTXT_ITEM',		'Vous allez effacer le billet suivant:');
define('_CONFIRMTXT_COMMENT',		'Vous allez effacer le commentaire suivant:');
define('_CONFIRMTXT_TEAM1',		'Vous allez effacer ');
define('_CONFIRMTXT_TEAM2',		' de l\'ï¿½quipe pour le blog ');
define('_CONFIRMTXT_BLOG',		'Le blog que vous allez effacer est: ');
define('_WARNINGTXT_BLOGDEL',		'Attention! Effacer un blog effarcera TOUS les billets de ce blog et tous les commentaires associï¿½s. Soyez certain de ne pas faire erreur. <br />Et n\'interrompez pas le processus.');
define('_CONFIRMTXT_MEMBER',		'Vous allez effacer le profil du participant suivant: ');
define('_CONFIRMTXT_TEMPLATE',		'Vous allez effacer le modï¿½le  ');
define('_CONFIRMTXT_SKIN',		'Vous allez effacer l\'habillage ');
define('_CONFIRMTXT_BAN',		'Vous allez annuler l\'exclusion de la plage IP');
define('_CONFIRMTXT_CATEGORY',		'Vous allez effacer le thï¿½me ');

// some status messages
define('_DELETED_ITEM',			'Billet supprimï¿½');
define('_DELETED_MEMBER',		'Participant effacï¿½');
define('_DELETED_COMMENT',		'Commentaire supprimï¿½');
define('_DELETED_BLOG',			'Blog effacï¿½');
define('_DELETED_CATEGORY',		'Categorie supprimï¿½e');
define('_ITEM_MOVED',			'Billet dï¿½placï¿½');
define('_ITEM_ADDED',			'Billet ajoutï¿½');
define('_COMMENT_UPDATED',		'Commentaire mis ï¿½ jour');
define('_SKIN_UPDATED',			'Habillage modifiï¿½');
define('_TEMPLATE_UPDATED',		'Modï¿½le modifiï¿½');

// errors
define('_ERROR_COMMENT_LONGWORD',	'SVP, n\'employez pas de mot de plus de 90 caractï¿½res dans votre commentaire');
define('_ERROR_COMMENT_NOCOMMENT',	'Tapez votre commentaire');
define('_ERROR_COMMENT_NOUSERNAME',	'Nom invalide');
define('_ERROR_COMMENT_TOOLONG',	'Votre commentaire est trop long (max. 5000 cars)');
define('_ERROR_COMMENTS_DISABLED',	'Les commentaires sur ce blog sont actuellement dï¿½sactivï¿½s.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Vous devez ï¿½tre connectï¿½ en tant que participant pour pouvoir commenter ce blog.');
define('_ERROR_COMMENTS_MEMBERNICK',	'Ce nom est dï¿½jï¿½ utilisï¿½ par un participant du blog. Choisissez autre chose.');
define('_ERROR_SKIN',			'Erreur d\'habillage');
define('_ERROR_ITEMCLOSED',		'Ce billet est protï¿½gï¿½. Il n\'est pas possible de le commenter ni de voter pour lui.');
define('_ERROR_NOSUCHITEM',		'Billet inexistant');
define('_ERROR_NOSUCHBLOG',		'Blog inexistant');
define('_ERROR_NOSUCHSKIN',		'Habillage inexistant');
define('_ERROR_NOSUCHMEMBER',		'Participant inexistant');
define('_ERROR_NOTONTEAM',		'Vous n\'appartenez pas ï¿½ l\'ï¿½quipe de ce blog.');
define('_ERROR_BADDESTBLOG',		'Le blog de destination n\'existe pas.');
define('_ERROR_NOTONDESTTEAM',		'Impossible de dï¿½placer le billet car vous ne faites pas partie de l\'ï¿½quipe du blog de destination.');
define('_ERROR_NOEMPTYITEMS',		'Impossible d\'ajouter un billet vide!');
define('_ERROR_BADMAILADDRESS',		'Adresse email incorrecte');
define('_ERROR_BADNOTIFY',		'Adresse(s) de notification incorrecte(s)');
define('_ERROR_BADNAME',		'Nom incorrect (seuls les lettres de a ï¿½ z et les chiffres de 0 ï¿½ 9 sont autorisï¿½s, sans espace au dï¿½but ni ï¿½ la fin)');
define('_ERROR_NICKNAMEINUSE',		'Un autre participant utilise dï¿½jï¿½ ce nom');
define('_ERROR_PASSWORDMISMATCH',	'Les mots de passe doivent correspondre');
define('_ERROR_PASSWORDTOOSHORT',	'Le mot de passe doit commprendre au moins 6 caractï¿½res');
define('_ERROR_PASSWORDMISSING',	'Il FAUT un mot de passe');
define('_ERROR_REALNAMEMISSING',	'Vous devez inscrire votre nom');
define('_ERROR_ATLEASTONEADMIN',	'Il doit toujours y avoir un super admin qui puisse se connecter.');
define('_ERROR_ATLEASTONEBLOGADMIN',	'Cela empï¿½cherait la gestion de votre blog. Assurez-vous qu\'il y ait toujours au-moins un administrateur.');
define('_ERROR_ALREADYONTEAM',		'Ce participant est dï¿½jï¿½ dans l\'ï¿½quipe');
define('_ERROR_BADSHORTBLOGNAME',	'Le diminutif du blog ne peut contenir que des lettres de a ï¿½ z et des chiffres de 0 ï¿½ 9, sans espace.');
define('_ERROR_DUPSHORTBLOGNAME',	'Un autre blog utilise dï¿½jï¿½ ce diminutif. Les diminutifs doivent ï¿½tre uniques.');
define('_ERROR_UPDATEFILE',		'Impossible de mettre ï¿½ jour le fichier. Vï¿½rifiez le rï¿½glage de permissions d\'ï¿½criture (faites un chmod 666). Remarquez aussi que le chemin est relatif au rï¿½pertoire de la zone admin ; vous devriez utiliser un chemin absolu (quelque chose comme /votre/chemin/vers/nucleus/)');
define('_ERROR_DELDEFBLOG',		'Impossible d\'effacer le blog par dï¿½faut');
define('_ERROR_DELETEMEMBER',		'Impossible de supprimer ce participant car il est probablement l\'auteur de billets ou de commentaires.');
define('_ERROR_BADTEMPLATENAME',	'Nom de modï¿½le incorrect, n\'utilisez que des lettres de a ï¿½ z et des chiffres de 0 ï¿½ 9, sans espace.');
define('_ERROR_DUPTEMPLATENAME',	'Il existe dï¿½jï¿½ un modï¿½le de ce nom');
define('_ERROR_BADSKINNAME',		'Nom d\'habillage incorrect, n\'utilisez que des lettres de a ï¿½ z et des chiffres de 0 ï¿½ 9, sans espace.');
define('_ERROR_DUPSKINNAME',		'Il existe dï¿½jï¿½ un habillage de ce nom');
define('_ERROR_DEFAULTSKIN',		'Il doit toujours subsister un habillage nommï¿½ "default"');
define('_ERROR_SKINDEFDELETE',		'Impossible de supprimer l\'habillage car il s\'agit de l\'habillage par dï¿½faut du blog: ');
define('_ERROR_DISALLOWED',		'Vous n\'ï¿½tes pas autorisï¿½ ï¿½ faire cela');
define('_ERROR_DELETEBAN',		'Erreur en essayant de supprimer l\'exclusion (elle n\'existe pas)');
define('_ERROR_ADDBAN',			'Erreur en essayant d\'ajouter l\'exclusion. L\'exclusion n\'a pas ï¿½tï¿½ ajoutï¿½e correctement dans tous vos blogs.');
define('_ERROR_BADACTION',		'L\'action demandï¿½e n\'existe pas');
define('_ERROR_MEMBERMAILDISABLED',	'Messages de participant ï¿½ participant dï¿½sactivï¿½s');
define('_ERROR_MEMBERCREATEDISABLED',	'Creation de nouveaux comptes dï¿½sactivï¿½e');
define('_ERROR_INCORRECTEMAIL',		'Email incorrect');
define('_ERROR_VOTEDBEFORE',		'Vous avez dï¿½jï¿½ votï¿½ pour ce billet');
define('_ERROR_BANNED1',		'Action impossible car vous (plage IP ');
define('_ERROR_BANNED2',			') ï¿½tes exclu. Le message ï¿½tait: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Vous devez ï¿½tre connectï¿½ pour faire cela');
define('_ERROR_CONNECT',		'Erreur de connexion');
define('_ERROR_FILE_TOO_BIG',		'Fichier trop gros!');
define('_ERROR_BADFILETYPE',		'Dï¿½solï¿½, cette extension n\'est pas autorisï¿½e');
define('_ERROR_BADREQUEST',		'Mauvaise demande de tï¿½lï¿½chargement');
define('_ERROR_DISALLOWEDUPLOAD',	'Vous ne faites partie d\'aucune ï¿½quipe. Vous n\'ï¿½tes donc pas autorisï¿½ ï¿½ tï¿½lï¿½charger des fichiers.');
define('_ERROR_BADPERMISSIONS',		'Les permissions de fichiers/rï¿½pertoires ne sont pas correctement configurï¿½es');
define('_ERROR_UPLOADMOVEP',		'Erreur de dï¿½placement de fichier');
define('_ERROR_UPLOADCOPY',		'Erreur de copie de fichier');
define('_ERROR_UPLOADDUPLICATE',	'Un fichier de ce nom existe dï¿½jï¿½. Essayez de le renommer avant de le tï¿½lï¿½charger.');
define('_ERROR_LOGINDISALLOWED',	'Dï¿½solï¿½, vous n\'ï¿½tes pas autorisï¿½ ï¿½ vous connecter ï¿½ la zone admin. Vous pouvez vous connecter sous un autre nom');
define('_ERROR_DBCONNECT',		'Impossible de se connecter au serveur mySQL');
define('_ERROR_DBSELECT',		'Impossible de sï¿½lectionner la base Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Fichier de langue indisponible');
define('_ERROR_NOSUCHCATEGORY',		'Thï¿½me indisponible');
define('_ERROR_DELETELASTCATEGORY',	'Il doit y avoir au moins un thï¿½me');
define('_ERROR_DELETEDEFCATEGORY',	'Impossible d\'effacerle thï¿½me par dï¿½faut');
define('_ERROR_BADCATEGORYNAME',	'Nom de thï¿½me incorrect');
define('_ERROR_DUPCATEGORYNAME',	'Ce thï¿½me existe dï¿½jï¿½');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',		'Attention: ceci n\'est pas un rï¿½pertoire!');
define('_WARNING_NOTREADABLE',		'Attention: ceci n\'est pas un rï¿½pertoire avec droit de lecture!');
define('_WARNING_NOTWRITABLE',		'Attention: ceci n\'est pas un rï¿½pertoire avec droit d\'ï¿½criture!');

// media and upload
define('_MEDIA_UPLOADLINK',		'Tï¿½lï¿½charger un nouveau fichier');
define('_MEDIA_MODIFIED',		'modifiï¿½');
define('_MEDIA_FILENAME',		'nom de fichier');
define('_MEDIA_DIMENSIONS',		'dimensions');
define('_MEDIA_INLINE',			'Insï¿½rï¿½');
define('_MEDIA_POPUP',			'Popup');
define('_UPLOAD_TITLE',			'Choisir le fichier');
define('_UPLOAD_MSG',			'Sï¿½lectionnez le fichier ï¿½ tï¿½lï¿½charger ci-dessous et pressez le bouton \'Tï¿½lï¿½charger\'.');
define('_UPLOAD_BUTTON',		'Tï¿½lï¿½charger');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'Compte crï¿½ï¿½, le mot de passe sera envoyï¿½ par email');
//define('_MSG_PASSWORDSENT',		'Mot de passe envoyï¿½ par email');
define('_MSG_LOGINAGAIN',		'Vous devrez vous reconnecter car vos informations ont changï¿½');
define('_MSG_SETTINGSCHANGED',		'Rï¿½glages modifiï¿½s');
define('_MSG_ADMINCHANGED',		'Admin changï¿½');
define('_MSG_NEWBLOG',			'Nouveau blog crï¿½ï¿½');
define('_MSG_ACTIONLOGCLEARED',		'Journal effacï¿½');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Action interdite: ');
define('_ACTIONLOG_PWDREMINDERSENT',	'Nouveau mot de passe envoyï¿½ pour ');
define('_ACTIONLOG_TITLE',		'Journal des ï¿½vï¿½nements');
define('_ACTIONLOG_CLEAR_TITLE',	'Effacer le journal des ï¿½vï¿½nements');
define('_ACTIONLOG_CLEAR_TEXT',		'Effacer le journal des ï¿½vï¿½nements maintenant');

// team management
define('_TEAM_TITLE',			'Gï¿½rer les participants ');
define('_TEAM_CURRENT',			'Equipe actuelle');
define('_TEAM_ADDNEW',			'Ajouter un participant');
define('_TEAM_CHOOSEMEMBER',		'Choisir un participant');
define('_TEAM_ADMIN',			'Privilï¿½ges d\'administrateur? ');
define('_TEAM_ADD',			'Ajouter ï¿½ l\'ï¿½quipe');
define('_TEAM_ADD_BTN',			'Ajouter!');

// blogsettings
define('_EBLOG_TITLE',			'Modifier les rï¿½glages du blog');
define('_EBLOG_TEAM_TITLE',		'Modifier l\'ï¿½quipe');
define('_EBLOG_TEAM_TEXT',		'Cliquez ici pour modifier votre ï¿½quipe...');
define('_EBLOG_SETTINGS_TITLE',		'Rï¿½glages du blog');
define('_EBLOG_NAME',			'Nom du blog');
define('_EBLOG_SHORTNAME',		'Diminutif');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(seulement de a ï¿½ z et sans espace)');
define('_EBLOG_DESC',			'Description');
define('_EBLOG_URL',			'URL');
define('_EBLOG_DEFSKIN',		'Habillage par dï¿½faut');
define('_EBLOG_DEFCAT',			'Thï¿½me par dï¿½faut');
define('_EBLOG_LINEBREAKS',		'Convertir les sauts de ligne');
define('_EBLOG_DISABLECOMMENTS',	'Activer les commentaires?<br /><small>(Cela signifie qu\'il sera impossible d\'en ajouter.)</small>');
define('_EBLOG_ANONYMOUS',		'Autoriser les commentaires par des non-participants?');
define('_EBLOG_NOTIFY',			'Adresse(s) de notification (sï¿½parï¿½es par des ;)');
define('_EBLOG_NOTIFY_ON',		'Notification activï¿½e');
define('_EBLOG_NOTIFY_COMMENT',		'Nouveaux commentaires');
define('_EBLOG_NOTIFY_KARMA',		'Nouveaux votes karma');
define('_EBLOG_NOTIFY_ITEM',		'Nouveau billet');
define('_EBLOG_PING',			'Pinger Weblogs.com ï¿½ la mise ï¿½ jour?');
define('_EBLOG_MAXCOMMENTS',		'Nombre maximum de commentaires');
define('_EBLOG_UPDATE',			'Fichier de mise-ï¿½-jour');
define('_EBLOG_OFFSET',			'Dï¿½calage horaire');
define('_EBLOG_STIME',			'Heure du serveur:');
define('_EBLOG_BTIME',			'Heure du blog:');
define('_EBLOG_CHANGE',			'Changer les rï¿½glages');
define('_EBLOG_CHANGE_BTN',		'Valider');
define('_EBLOG_ADMIN',			'Gï¿½rer le blog');
define('_EBLOG_ADMIN_MSG',		'Les privilï¿½ges d\'administrateur vous seront attribuï¿½s');
define('_EBLOG_CREATE_TITLE',		'Crï¿½er un nouveau blog');
define('_EBLOG_CREATE_TEXT',		'Remplissez le formulaire ci-dessous pour crï¿½er un nouveau blog. <br /><br /> <b>NB:</b> Seules les options nï¿½cessaires sont listï¿½es. Pour plus d\'options, changez les paramï¿½tres aprï¿½s la crï¿½ation.');
define('_EBLOG_CREATE',			'Crï¿½er le blog');
define('_EBLOG_CREATE_BTN',		'Crï¿½er');
define('_EBLOG_CAT_TITLE',		'Thï¿½mes');
define('_EBLOG_CAT_NAME',		'Thï¿½mes');
define('_EBLOG_CAT_DESC',		'Description du thï¿½me');
define('_EBLOG_CAT_CREATE',		'Crï¿½er un nouveau thï¿½me');
define('_EBLOG_CAT_UPDATE',		'Mettre ï¿½ jour le thï¿½me');
define('_EBLOG_CAT_UPDATE_BTN',		'Mettre ï¿½ jour le thï¿½me');

// templates
define('_TEMPLATE_TITLE',		'Modifier les modï¿½les');
define('_TEMPLATE_AVAILABLE_TITLE',	'Modï¿½les disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nouveau modï¿½le');
define('_TEMPLATE_NAME',		'Nom du modï¿½le');
define('_TEMPLATE_DESC',		'Description du modï¿½le');
define('_TEMPLATE_CREATE',		'Crï¿½er le modï¿½le');
define('_TEMPLATE_CREATE_BTN',		'Crï¿½er le modï¿½le');
define('_TEMPLATE_EDIT_TITLE',		'Modifier le modï¿½le');
define('_TEMPLATE_BACK',		'Retour au sommaire des modï¿½les');
define('_TEMPLATE_EDIT_MSG',		'Tous les ï¿½lï¿½ments de modï¿½le ne sont pas nï¿½cessaires. Laissez vides ceux dont vous n\'avez pas besoin');
define('_TEMPLATE_SETTINGS',		'Rï¿½glages de modï¿½le');
define('_TEMPLATE_ITEMS',		'Billet');
define('_TEMPLATE_ITEMHEADER',		'En-tï¿½te du billet');
define('_TEMPLATE_ITEMBODY',		'Corps du billet');
define('_TEMPLATE_ITEMFOOTER',		'Pied du billet');
define('_TEMPLATE_MORELINK',		'Lien vers le dï¿½veloppement');
define('_TEMPLATE_NEW',			'Indication de nouveau billet');
define('_TEMPLATE_COMMENTS_ANY',	'Commentaires (si nï¿½cessaire)');
define('_TEMPLATE_CHEADER',		'En-tï¿½te des commentaires');
define('_TEMPLATE_CBODY',		'Corps des commentaires');
define('_TEMPLATE_CFOOTER',		'Pied des commentaires');
define('_TEMPLATE_CONE',		'Un seul commentaire');
define('_TEMPLATE_CMANY',		'Deux (ou plus) commentaires');
define('_TEMPLATE_CMORE',		'Commentaires: en voir plus');
define('_TEMPLATE_CMEXTRA',		'Infos participant');
define('_TEMPLATE_COMMENTS_NONE',	'Commentaire (si aucun)');
define('_TEMPLATE_CNONE',		'Pas de commentaire');
define('_TEMPLATE_COMMENTS_TOOMUCH',	'Commentaires (s\'il y en a, mais trop pour les montrer tous)');
define('_TEMPLATE_CTOOMUCH',		'Trop de commentaires');
define('_TEMPLATE_ARCHIVELIST',		'Listes d\'archives');
define('_TEMPLATE_AHEADER',		'En-tï¿½te d\'archives');
define('_TEMPLATE_AITEM',		'Archive (billet)');
define('_TEMPLATE_AFOOTER',		'Pied de liste d\'archives');
define('_TEMPLATE_DATETIME',		'Date et heure');
define('_TEMPLATE_DHEADER',		'En-tï¿½te de date');
define('_TEMPLATE_DFOOTER',		'Pied de date');
define('_TEMPLATE_DFORMAT',		'Format de la date');
define('_TEMPLATE_TFORMAT',		'Format de l\'heure');
define('_TEMPLATE_LOCALE',		'Locale');
define('_TEMPLATE_IMAGE',		'Fenï¿½tre popup');
define('_TEMPLATE_PCODE',		'Code de lien popup');
define('_TEMPLATE_ICODE',		'Code d\'image insï¿½rï¿½e');
define('_TEMPLATE_MCODE',		'Code lien objet media');
define('_TEMPLATE_SEARCH',		'Recherche');
define('_TEMPLATE_SHIGHLIGHT',		'Surbrillance');
define('_TEMPLATE_SNOTFOUND',		'Rien trouvï¿½');
define('_TEMPLATE_UPDATE',		'Mettre ï¿½ jour');
define('_TEMPLATE_UPDATE_BTN',		'Mettre ï¿½ jour le modï¿½me');
define('_TEMPLATE_RESET_BTN',		'Rï¿½tablir les donnï¿½es');
define('_TEMPLATE_CATEGORYLIST',	'Listes de thï¿½mes');
define('_TEMPLATE_CATHEADER',		'En-tï¿½te de liste de thï¿½mes');
define('_TEMPLATE_CATITEM',		'Liste des thï¿½mes (billet)');
define('_TEMPLATE_CATFOOTER',		'Pied de liste de thï¿½mes');

// skins
define('_SKIN_EDIT_TITLE',		'Modification des habillages');
define('_SKIN_AVAILABLE_TITLE',		'Habillages disponibles');
define('_SKIN_NEW_TITLE',		'Nouvel habillage');
define('_SKIN_NAME',			'Nom');
define('_SKIN_DESC',			'Description');
define('_SKIN_TYPE',			'Type de contenu');
define('_SKIN_CREATE',			'Crï¿½er l\'habillage');
define('_SKIN_CREATE_BTN',		'Crï¿½er');
define('_SKIN_EDITONE_TITLE',		'Modifier l\'habillage');
define('_SKIN_BACK',			'Retour au menu habillage');
define('_SKIN_PARTS_TITLE',		'Elements d\'habillage');
define('_SKIN_PARTS_MSG',		'Tous les ï¿½lï¿½ments ne sont pas requis. Laissez vides ceux dont vous n\'avez pas esoin. Choisissez ci-dessous l\'ï¿½lï¿½ment d\'habillage ï¿½ modifier:');
define('_SKIN_PART_MAIN',		'Page index');
define('_SKIN_PART_ITEM',		'Page billet');
define('_SKIN_PART_ALIST',		'Liste des archives');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',		'Recherche');
define('_SKIN_PART_ERROR',		'Erreurs');
define('_SKIN_PART_MEMBER',		'Fiches des participants');
define('_SKIN_PART_POPUP',		'Fenï¿½tres Popups');
define('_SKIN_GENSETTINGS_TITLE',	'Rï¿½glages d\'ensemble');
define('_SKIN_CHANGE',			'Modifier');
define('_SKIN_CHANGE_BTN',		'Modifier ces rï¿½glages');
define('_SKIN_UPDATE_BTN',		'Mettre ï¿½ jour');
define('_SKIN_RESET_BTN',		'Rï¿½tablir');
define('_SKIN_EDITPART_TITLE',		'Modifier l\'habillage');
define('_SKIN_GOBACK',			'Retour');
define('_SKIN_ALLOWEDVARS',		'Variables autorisï¿½es (cliquer pour info):');

// global settings
define('_SETTINGS_TITLE',		'Rï¿½glages d\'ensemble');
define('_SETTINGS_SUB_GENERAL',		'Rï¿½glages d\'ensemble');
define('_SETTINGS_DEFBLOG',		'Blog par dï¿½faut');
define('_SETTINGS_ADMINMAIL',		'Email de l\'administrateur');
define('_SETTINGS_SITENAME',		'Nom du site');
define('_SETTINGS_SITEURL',		'URL du site (terminï¿½ par un /)');
define('_SETTINGS_ADMINURL',		'URL de la zone admin (terminï¿½ par un /)');
define('_SETTINGS_DIRS',		'Rï¿½pertoires Nucleus');
define('_SETTINGS_MEDIADIR',		'Rï¿½pertoire media');
define('_SETTINGS_SEECONFIGPHP',	'(voir config.php)');
define('_SETTINGS_MEDIAURL',		'URL du repertoire media (terminï¿½ par un /)');
define('_SETTINGS_ALLOWUPLOAD',		'Autoriser le tï¿½lï¿½chargement ascendant de fichier?');
define('_SETTINGS_ALLOWUPLOADTYPES',	'Indiquer les extensions de fichier autorisï¿½es');
define('_SETTINGS_CHANGELOGIN',		'Autoriser les participants ï¿½ changer de login/mot de passe?');
define('_SETTINGS_COOKIES_TITLE',	'Paramï¿½tres des cookies');
define('_SETTINGS_COOKIELIFE',		'Durï¿½e de vie du cookie de connexion');
define('_SETTINGS_COOKIESESSION',	'Cookies de session');
define('_SETTINGS_COOKIEMONTH',		'Durï¿½e de vie d\'un mois');
define('_SETTINGS_COOKIEPATH',		'Chemin du cookie (utilisateur averti)');
define('_SETTINGS_COOKIEDOMAIN',	'Domaine du cookie (utilisateur averti)');
define('_SETTINGS_COOKIESECURE',	'Cookie de sï¿½curitï¿½ (utilisateur averti)');
define('_SETTINGS_LASTVISIT',		'Garder les cookies de la derniï¿½re visite');
define('_SETTINGS_ALLOWCREATE',		'Autoriser les visiteurs ï¿½ crï¿½er un compte');
define('_SETTINGS_NEWLOGIN',		'Connexion autorisï¿½e pour les comptes crï¿½ï¿½s par des utilisateurs');
define('_SETTINGS_NEWLOGIN2',		'(ne vaut que pour les comptes rï¿½cemment crï¿½ï¿½s)');
define('_SETTINGS_MEMBERMSGS',		'Autoriser les services de participant ï¿½ participant');
define('_SETTINGS_LANGUAGE',		'Langue par dï¿½faut');
define('_SETTINGS_DISABLESITE',		'Dï¿½sactiver le site');
define('_SETTINGS_DBLOGIN',		'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',		'Mettre ï¿½ jour les rï¿½glages');
define('_SETTINGS_UPDATE_BTN',		'Mettre ï¿½ jour');
define('_SETTINGS_DISABLEJS',		'Dï¿½sactiver la barre d\'outils JavaScript');
define('_SETTINGS_MEDIA',		'Paramï¿½tres de tï¿½lï¿½chargement de mï¿½dias');
define('_SETTINGS_MEDIAPREFIX',		'Prï¿½fixer le nom des fichiers avec la date');
define('_SETTINGS_MEMBERS',		'Rï¿½glages des participants');

// bans
define('_BAN_TITLE',			'Liste des exclusions pour');
define('_BAN_NONE',			'Pas d\'exclusion pour ce blog');
define('_BAN_NEW_TITLE',		'Ajouter une exclusion');
define('_BAN_NEW_TEXT',			'Ajouter une exclusion maintenant');
define('_BAN_REMOVE_TITLE',		'Retirer une exclusion');
define('_BAN_IPRANGE',			'Plage IP');
define('_BAN_BLOGS',			'Quels blogs?');
define('_BAN_DELETE_TITLE',		'Supprimer une exclusion');
define('_BAN_ALLBLOGS',			'Tous les blogs dont vous ï¿½tes administrateur.');
define('_BAN_REMOVED_TITLE',		'Exclusion supprimï¿½e');
define('_BAN_REMOVED_TEXT',		'L\'exclusion a ï¿½tï¿½ supprimï¿½e pour les blogs suivants:');
define('_BAN_ADD_TITLE',		'Dï¿½finir des exclusions');
define('_BAN_IPRANGE_TEXT',		'Choisissez la plage IP que vous voulez bloquer. Moins il y aura de nombres, plus il y aura d\'IP bloquï¿½es.');
define('_BAN_BLOGS_TEXT',		'Vous pouvez choisir d\'exclure une IP pour un blog seulement ou pour tous ceux dont vous ï¿½tes admin. Choisissez ici.');
define('_BAN_REASON_TITLE',		'Motif');
define('_BAN_REASON_TEXT',		'Vous pouvez motiver l\'exclusion: La raison s\'affichera quand l\'IP concernï¿½e essaiera d\'ajouter un commentaire ou un vote. Longueur max. 256 caractï¿½res.');
define('_BAN_ADD_BTN',			'Exclure');

// LOGIN screen
define('_LOGIN_MESSAGE',		'Message');
define('_LOGIN_NAME',			'Nom');
define('_LOGIN_PASSWORD',		'Mot de passe');
define('_LOGIN_SHARED',			_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',			'Mot de passe oubliï¿½?');

// membermanagement
define('_MEMBERS_TITLE',		'Gestion des participants');
define('_MEMBERS_CURRENT',		'Participants actuels');
define('_MEMBERS_NEW',			'Nouveau participant');
define('_MEMBERS_DISPLAY',		'Nom affichï¿½');
define('_MEMBERS_DISPLAY_INFO',		'(C\'est le nom que vous utilisez pour vous connecter)');
define('_MEMBERS_REALNAME',		'Nom');
define('_MEMBERS_PWD',			'Mot de passe');
define('_MEMBERS_REPPWD',		'Rï¿½pï¿½ter le mot de passe');
define('_MEMBERS_EMAIL',		'Adresse email');
define('_MEMBERS_EMAIL_EDIT',		'(Quand vous changez d\'adresse email, un nouveau mot de passe est envoyï¿½ ï¿½ cette adresse)');
define('_MEMBERS_URL',			'Adresse du site (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilï¿½ges de super admin');
define('_MEMBERS_CANLOGIN',		'Peut ouvrir une session comme admin');
define('_MEMBERS_NOTES',		'Notes');
define('_MEMBERS_NEW_BTN',		'Ajouter un participant');
define('_MEMBERS_EDIT',			'Modifier les participants');
define('_MEMBERS_EDIT_BTN',		'Modifier');
define('_MEMBERS_BACKTOOVERVIEW',	'Retour au sommaire des participants');
define('_MEMBERS_DEFLANG',		'Langue');
define('_MEMBERS_USESITELANG',		'- utiliser les rï¿½glages du site -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visiter le site');
define('_BLOGLIST_ADD',			'Ajouter un billet');
define('_BLOGLIST_TT_ADD',		'Ajouter un billet ï¿½ ce blog');
define('_BLOGLIST_EDIT',		'Modifier/Supprimer les billets');
define('_BLOGLIST_TT_EDIT',		'');
define('_BLOGLIST_BMLET',		'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Paramï¿½tres');
define('_BLOGLIST_TT_SETTINGS',		'Modifier rï¿½glages ou gï¿½rer ï¿½quipe');
define('_BLOGLIST_BANS',		'Exclusions');
define('_BLOGLIST_TT_BANS',		'Consulter, ajouter ou supprimer les exclusions IP');
define('_BLOGLIST_DELETE',		'Tout effacer');
define('_BLOGLIST_TT_DELETE',		'Effacer ce blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',		'Vos blogs');
define('_OVERVIEW_YRDRAFTS',		'Vos brouillons');
define('_OVERVIEW_YRSETTINGS',		'Vos rï¿½glages');
define('_OVERVIEW_GSETTINGS',		'Rï¿½glages d\'ensemble');
define('_OVERVIEW_NOBLOGS',		'Vous ne faites partie d\'aucune ï¿½quipe');
define('_OVERVIEW_NODRAFTS',		'Pas  de brouillon');
define('_OVERVIEW_EDITSETTINGS',	'Modifier vos rï¿½glages...');
define('_OVERVIEW_BROWSEITEMS',		'Consulter vos billets...');
define('_OVERVIEW_BROWSECOMM',		'Consulter vos commentaires...');
define('_OVERVIEW_VIEWLOG',		'Consulter le journal des ï¿½vï¿½nements...');
define('_OVERVIEW_MEMBERS',		'Gï¿½rer les participants...');
define('_OVERVIEW_NEWLOG',		'Crï¿½er un nouveau blog...');
define('_OVERVIEW_SETTINGS',		'Modifier les rï¿½glages...');
define('_OVERVIEW_TEMPLATES',		'Modifier les modï¿½les...');
define('_OVERVIEW_SKINS',		'Modifier les habillages...');
define('_OVERVIEW_BACKUP',		'Sauvegarde/Rï¿½cupï¿½ration...');

// ITEMLIST
define('_ITEMLIST_BLOG',		'Billets du blog');
define('_ITEMLIST_YOUR',		'Vos billets');

// Comments
define('_COMMENTS',			'Commentaires');
define('_NOCOMMENTS',			'Pas de commentaire pour ce billet');
define('_COMMENTS_YOUR',		'Vos commentaires');
define('_NOCOMMENTS_YOUR',		'Vous n\'avez pas ï¿½crit de commentaire');

// LISTS (general)
define('_LISTS_NOMORE',			'Rien de plus ou pas de rï¿½sultat du tout');
define('_LISTS_PREV',			'Prï¿½cï¿½dent');
define('_LISTS_NEXT',			'Suivant');
define('_LISTS_SEARCH',			'Rechercher');
define('_LISTS_CHANGE',			'Changer');
define('_LISTS_PERPAGE',		'billets/page');
define('_LISTS_ACTIONS',		'Actions');
define('_LISTS_DELETE',			'Supprimer');
define('_LISTS_EDIT',			'Modifier');
define('_LISTS_MOVE',			'Dï¿½placer');
define('_LISTS_CLONE',			'Dupliquer');
define('_LISTS_TITLE',			'Titre');
define('_LISTS_BLOG',			'Blog');
define('_LISTS_NAME',			'Nom');
define('_LISTS_DESC',			'Description');
define('_LISTS_TIME',			'Heure');
define('_LISTS_COMMENTS',		'Commentaires');
define('_LISTS_TYPE',			'Type');


// member list
define('_LIST_MEMBER_NAME',		'Nom affichï¿½');
define('_LIST_MEMBER_RNAME',		'Nom');
define('_LIST_MEMBER_ADMIN',		'Super admin? ');
define('_LIST_MEMBER_LOGIN',		'Peut se connecter? ');
define('_LIST_MEMBER_URL',		'Site');

// banlist
define('_LIST_BAN_IPRANGE',		'Plage IP');
define('_LIST_BAN_REASON',		'Motif');

// actionlist
define('_LIST_ACTION_MSG',		'Message');

// commentlist
define('_LIST_COMMENT_BANIP',		'Exclure l\'IP');
define('_LIST_COMMENT_WHO',		'Auteur');
define('_LIST_COMMENT',			'Commentaire');
define('_LIST_COMMENT_HOST',		'Hï¿½te');

// itemlist
define('_LIST_ITEM_INFO',		'Info');
define('_LIST_ITEM_CONTENT',		'Titre et contenu');


// teamlist
define('_LIST_TEAM_ADMIN',		'Admin ');
define('_LIST_TEAM_CHADMIN',		'Changer l\'admin');

// edit comments
define('_EDITC_TITLE',			'Modifier les commentaires');
define('_EDITC_WHO',			'Auteur');
define('_EDITC_HOST',			'D\'oï¿½?');
define('_EDITC_WHEN',			'Quand?');
define('_EDITC_TEXT',			'Contenu');
define('_EDITC_EDIT',			'Modifier le commentaire');
define('_EDITC_MEMBER',			'participant');
define('_EDITC_NONMEMBER',		'non participant');

// move item
define('_MOVE_TITLE',			'Dï¿½placer dans quel blog?');
define('_MOVE_BTN',			'Dï¿½placer le billet');

