<?php
//  Nucleus Language File
// 
// Author�GWouter Demuynck (nucleus@demuynck.org)
// Nucleus version�Gv1.0-v2.0
//
// Please note�Gif you want to translate this file to your own translation, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated translation file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)
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

// Language Files
define('_LANGUAGEFILES_JAPANESE-UTF8',				'Japanese - &#26085;&#26412;&#35486; (UTF-8)');
define('_LANGUAGEFILES_JAPANESE-EUC',				'Japanese - &#26085;&#26412;&#35486; (EUC)');
define('_LANGUAGEFILES_JAPANESE-SJIS',				'Japanese - &#26085;&#26412;&#35486; (Shift-JIS)');
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
define('_LANGUAGEFILES_KOREAN-EUC-KR',				'Korean - &#54620;&#44397;&#50612; (euc-kr)');
define('_LANGUAGEFILES_KOREAN-UTF',					'Korean - &#54620;&#44397;&#50612; (utf-8)');
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

define('_LIST_PLUG_SUBS_NEEDUPDATE','Please use the \'Update Subscription list\'-button to update the plugin\'s subscription list.');
define('_LIST_PLUGS_DEP',			'Plugin(s) requires:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'All Comments for blog');
define('_NOCOMMENTS_BLOG',			'No comments were made on items of this blog');
define('_BLOGLIST_COMMENTS',		'Comments');
define('_BLOGLIST_TT_COMMENTS',		'A list of all comments made on items of this blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'day');
define('_ARCHIVETYPE_MONTH',		'month');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Invalid or expired ticket.');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie Prefix');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Cannot send activation link. You\'re not allowed to log in.');
define('_ERROR_ACTIVATE',			'Activation key does not exist, is invalid, or has expired.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Activation link sent');
define('_MSG_ACTIVATION_SENT',		'An activation link has been sent by e-mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hi <%memberName%>,\n\nYou need to activate your account at <%siteName%> (<%siteUrl%>).\nYou can do this by visiting the link below: \n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activate your '<%memberName%>' account");
define('_ACTIVATE_REGISTER_TITLE',	'Welcome <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'You\'re almost there. Please choose a password for your account below.');
define('_ACTIVATE_FORGOT_MAIL',		"Hi <%memberName%>,\n\nUsing the link below, you can choose a new password for your account at <%siteName%> (<%siteUrl%>) by choosing a new password.\n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Re-activate your '<%memberName%>' account");
define('_ACTIVATE_FORGOT_TITLE',	'Welcome <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'You can choose a new password for your account below:');
define('_ACTIVATE_CHANGE_MAIL',		"Hi <%memberName%>,\n\nSince your e-mail address has changed, you'll need to re-activate your account at <%siteName%> (<%siteUrl%>).\nYou can do this by visiting the link below: \n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Re-activate your '<%memberName%>' account");
define('_ACTIVATE_CHANGE_TITLE',	'Welcome <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Your address change has been verified. Thanks!');
define('_ACTIVATE_SUCCESS_TITLE',	'Activation Succeeded');
define('_ACTIVATE_SUCCESS_TEXT',	'Your account has been successfully activated.');
define('_MEMBERS_SETPWD',			'Set Password');
define('_MEMBERS_SETPWD_BTN',		'Set Password');
define('_QMENU_ACTIVATE',			'Account Activation');
define('_QMENU_ACTIVATE_TEXT',		'<p>After you have activated your account, you can start using it by <a href="index.php?action=showlogin">logging in</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Update subscription list');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript Toolbar Style');
define('_SETTINGS_JSTOOLBAR_FULL',	'Full Toolbar (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Simple Toolbar (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Disable Toolbar');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">How to activate fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Extra Plugin Settings');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'author:');
define('_LIST_ITEM_DATE',			'date:');
define('_LIST_ITEM_TIME',			'time:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(member)');

// batch operations
define('_BATCH_WITH_SEL',			'With selected:');
define('_BATCH_EXEC',				'Execute');

// quickmenu
define('_QMENU_HOME',				'Home');
define('_QMENU_ADD',				'Add Item');
define('_QMENU_ADD_SELECT',			'-- select --');
define('_QMENU_USER_SETTINGS',		'Profile');
define('_QMENU_USER_ITEMS',			'Items');
define('_QMENU_USER_COMMENTS',		'Comments');
define('_QMENU_MANAGE',				'Management');
define('_QMENU_MANAGE_LOG',			'Action Log');
define('_QMENU_MANAGE_SETTINGS',	'Configuration');
define('_QMENU_MANAGE_MEMBERS',		'Members');
define('_QMENU_MANAGE_NEWBLOG',		'New Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'Skins');
define('_QMENU_LAYOUT_TEMPL',		'Templates');
define('_QMENU_LAYOUT_IEXPORT',		'Import/Export');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Introduction');
define('_QMENU_INTRO_TEXT',			'<p>This is the logon screen for Nucleus CMS, the content management system that\'s being used to maintain this website.</p><p>If you have an account, you can log on and start posting new items.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'The helpfile for this plugin can not be found');
define('_PLUGS_HELP_TITLE',			'Helppage for plugin');
define('_LIST_PLUGS_HELP', 			'help');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Enable External Authentication');
define('_WARNING_EXTAUTH',			'Warning: Enable only if needed.');

// member profile
define('_MEMBERS_BYPASS',			'Use External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Always</em> include in search');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'�d��');
define('_MEDIA_VIEW_TT',			'�d�ݤ��]�b�s���f�����}�^');
define('_MEDIA_FILTER_APPLY',		'���ιL�o��');
define('_MEDIA_FILTER_LABEL',		'�L�o���G');
define('_MEDIA_UPLOAD_TO',			'�W���K');
define('_MEDIA_UPLOAD_NEW',			'�W��s���K');
define('_MEDIA_COLLECTION_SELECT',	'���');
define('_MEDIA_COLLECTION_TT',		'������o�ӥؿ�');
define('_MEDIA_COLLECTION_LABEL',	'��e���áG');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'�����');
define('_ADD_ALIGNRIGHT_TT',		'�k���');
define('_ADD_ALIGNCENTER_TT',		'�~��');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'�j���ɥ]�A');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'�W���');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'���\�o���L�h');
define('_ADD_CHANGEDATE',			'��s�ɶ��аO');
define('_BMLET_CHANGEDATE',			'��s�ɶ��аO');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'���O�ɤJ/�ɥX�K');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'���q');
define('_PARSER_INCMODE_SKINDIR',	'�ϥέ��O�ؿ�');
define('_SKIN_INCLUDE_MODE',		'�]�A�覡');
define('_SKIN_INCLUDE_PREFIX',		'�]�A�e��');

// global settings
define('_SETTINGS_BASESKIN',		'�򥻭��O');
define('_SETTINGS_SKINSURL',		'���OURL');
define('_SETTINGS_ACTIONSURL',		'action.php������URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'���ಾ���q�{���O');
define('_ERROR_MOVETOSELF',			'�L�k�������O�]�y�z��x�P����x�ۦP�^');
define('_MOVECAT_TITLE',			'�N���O���ʨ�');
define('_MOVECAT_BTN',				'�������O');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL�Ҧ�');
define('_SETTINGS_URLMODE_NORMAL',	'���q');
define('_SETTINGS_URLMODE_PATHINFO','�u��');

// Batch operations
define('_BATCH_NOSELECTION',		'�S����ܰʧ@���檺��H');
define('_BATCH_ITEMS',				'�峹��B�z');
define('_BATCH_CATEGORIES',			'���O��B��');
define('_BATCH_MEMBERS',			'�|���B�z');
define('_BATCH_TEAM',				'�ζ��|���B�z');
define('_BATCH_COMMENTS',			'��ק�B�z');
define('_BATCH_UNKNOWN',			'������B�z�G');
define('_BATCH_EXECUTING',			'����');
define('_BATCH_ONCATEGORY',			'�b���O');
define('_BATCH_ONITEM',				'�b�峹');
define('_BATCH_ONCOMMENT',			'�b���');
define('_BATCH_ONMEMBER',			'�b�|��');
define('_BATCH_ONTEAM',				'�b�ζ��|��');
define('_BATCH_SUCCESS',			'���\�I');
define('_BATCH_DONE',				'�����I');
define('_BATCH_DELETE_CONFIRM',		'�T�{��R��');
define('_BATCH_DELETE_CONFIRM_BTN',	'�T�{��R��');
define('_BATCH_SELECTALL',			'����');
define('_BATCH_DESELECTALL',		'������');

// batch operations�Goptions in dropdowns
define('_BATCH_ITEM_DELETE',		'�R��');
define('_BATCH_ITEM_MOVE',			'����');
define('_BATCH_MEMBER_DELETE',		'�R��');
define('_BATCH_MEMBER_SET_ADM',		'�¤��W�ťΤ��v��');
define('_BATCH_MEMBER_UNSET_ADM',	'��ܶW�ťΤ��v��');
define('_BATCH_TEAM_DELETE',		'�q�ζ��R��');
define('_BATCH_TEAM_SET_ADM',		'�¤��W�ťΤ��v��');
define('_BATCH_TEAM_UNSET_ADM',		'��ܶW�ťΤ��v��');
define('_BATCH_CAT_DELETE',			'�R��');
define('_BATCH_CAT_MOVE',			'���ʨ��L��x');
define('_BATCH_COMMENT_DELETE',		'�R��');

// itemlist�GAdd new item�K
define('_ITEMLIST_ADDNEW',			'�K�[�s�峹�K');
define('_ADD_PLUGIN_EXTRAS',		'�X�i����ﶵ');

// errors
define('_ERROR_CATCREATEFAIL',		'�L�k�إ߷s���O');
define('_ERROR_NUCLEUSVERSIONREQ',	'�Ӵ���ݭn��s������Nucleus�G');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'��^��x�]�m');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'�ɤJ');
define('_SKINIE_TITLE_EXPORT',		'�ɥX');
define('_SKINIE_BTN_IMPORT',		'�ɤJ');
define('_SKINIE_BTN_EXPORT',		'�ɥX,��ܭ��O/�Ҫ�');
define('_SKINIE_LOCAL',				'�q���a���ɤJ�G');
define('_SKINIE_NOCANDIDATES',		'�b���O���|���S��������Կ���');
define('_SKINIE_FROMURL',			'�qURL�ɤJ�G');
define('_SKINIE_EXPORT_INTRO',		'�q�U����ܱz�Q�n�ɥX�����O�μҪ�');
define('_SKINIE_EXPORT_SKINS',		'���O');
define('_SKINIE_EXPORT_TEMPLATES',	'�Ҫ�');
define('_SKINIE_EXPORT_EXTRA',		'��h�H��');
define('_SKINIE_CONFIRM_OVERWRITE',	'�л\�w�g�s�b�����O���]��ݦW�ٽĬ�^');
define('_SKINIE_CONFIRM_IMPORT',	'�O���A�ڷQ�ɤJ�Ӥ��');
define('_SKINIE_CONFIRM_TITLE',		'���ɤJ���O�P�Ҫ�');
define('_SKINIE_INFO_SKINS',		'��󤤪����O�G');
define('_SKINIE_INFO_TEMPLATES',	'��󤤪��Ҫ��G');
define('_SKINIE_INFO_GENERAL',		'�H���G');
define('_SKINIE_INFO_SKINCLASH',	'���O�W�r�Ĭ�G');
define('_SKINIE_INFO_TEMPLCLASH',	'�Ҫ��W�r�Ĭ�G');
define('_SKINIE_INFO_IMPORTEDSKINS','�w�ɤJ�����O�G');
define('_SKINIE_INFO_IMPORTEDTEMPLS','�w�ɤJ���Ҫ��G');
define('_SKINIE_DONE',				'�����ɤJ');

define('_AND',						'�M');
define('_OR',						'��');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'��(�I���s��)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'�]�A�覡�G');
define('_LIST_SKINS_INCPREFIX',		'�]�A�e��G');
define('_LIST_SKINS_DEFINED',		'�T�w�����G');

// backup
define('_BACKUPS_TITLE',			'�ƥ� / ��_');
define('_BACKUP_TITLE',				'�ƥ�');
define('_BACKUP_INTRO',				'�I���U�������s�إߤ@���s�D�t�Ϊ��ƥ��ƾڮw.���Ӵ��ܫO�s�@�ӳƥ����A�N���O�s�b�w�����a��C');
define('_BACKUP_ZIP_YES',			'���ըϥ����Y');
define('_BACKUP_ZIP_NO',			'���ϥ����Y');
define('_BACKUP_BTN',				'�إ߳ƥ�');
define('_BACKUP_NOTE',				'<b>�`�N�G</b> �u���ƾڮw�����e�b�ƥ����O�s�A���]�A<b>config.php</b>.');
define('_RESTORE_TITLE',			'��_');
define('_RESTORE_NOTE',				'<b>�`�N�G</b> ��_�@�Ӽƾڮw <b>�M��</b> ��e�t�μƾڮw�����Ҧ��ƾڡI��A�u���T�w����~�i�H���榹�ާ@!	<br />	<b>�`�N�G</b>�T�w�ͦ��ƥ���󪺪��峹�t�Ϊ������P�A�{�b�ҨϥΪ������ۦP�I�_�h�i��L�k���`�u�@');
define('_RESTORE_INTRO',			'��ܤU�����ƥ����(���N�|�Q�դJ��A�Ⱦ�) �I���u��_�v���s�}�l.');
define('_RESTORE_IMSURE',			'�O���A�ڽT�w���榹�ާ@�I');
define('_RESTORE_BTN',				'�q��󤤫�_');
define('_RESTORE_WARNING',			'(�T�w�A���b��_�@�ӥ��T���ƥ��A�b�A�}�l���e�A�i�H�إߤ@�ӷ�e�ƥ�)');
define('_ERROR_BACKUP_NOTSURE',		'�A�ݭn�ˬd�@�U�ڽT�w');
define('_RESTORE_COMPLETE',			'��_����');

// new item notification
define('_NOTIFY_NI_MSG',			'�z���s�峹�w�g�o��G');
define('_NOTIFY_NI_TITLE',			'�s�峹�I');
define('_NOTIFY_KV_MSG',			'�峹�벼�G');
define('_NOTIFY_KV_TITLE',			'�벼�t�ΡG');
define('_NOTIFY_NC_MSG',			'�峹��סG');
define('_NOTIFY_NC_TITLE',			'�t�ε�סG');
define('_NOTIFY_USERID',			'�Τ�ID�G');
define('_NOTIFY_USER',				'�Τ�G');
define('_NOTIFY_COMMENT',			'��סG');
define('_NOTIFY_VOTE',				'�벼�G');
define('_NOTIFY_HOST',				'�D��H�G');
define('_NOTIFY_IP',				'IP�G');
define('_NOTIFY_MEMBER',			'�|��G');
define('_NOTIFY_TITLE',				'���D�G');
define('_NOTIFY_CONTENTS',			'���e�G');

// member mail message
define('_MMAIL_MSG',				'�e���A���@���A��');
define('_MMAIL_FROMANON',			'�ΦW�X��');
define('_MMAIL_FROMNUC',			'��Nucleus�t�εo�e');
define('_MMAIL_TITLE',				'�@���Ӧ�');
define('_MMAIL_MAIL',				'��G');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'�K�[�峹');
define('_BMLET_EDIT',				'�s��峹');
define('_BMLET_DELETE',				'�R���峹');
define('_BMLET_BODY',				'�K�n/²�T');
define('_BMLET_MORE',				'��h/�X�i');
define('_BMLET_OPTIONS',			'�ﶵ');
define('_BMLET_PREVIEW',			'�w��');

// used in bookmarklet
define('_ITEM_UPDATED',				'�峹�w��s');
define('_ITEM_DELETED',				'�峹�w�Q�R��');

// plugins
define('_CONFIRMTXT_PLUGIN',		'�T�w�N�n�R���w�g�R�W������ܡH');
define('_ERROR_NOSUCHPLUGIN',		'�S���o�˪�����');
define('_ERROR_DUPPLUGIN',			'�藍�_�A�o�Ӵ���w�g�w��');
define('_ERROR_PLUGFILEERROR',		'���s�b�Ӵ���Ϊ��v�������T�]�w');
define('_PLUGS_NOCANDIDATES',		'�S�����Կﴡ��');

define('_PLUGS_TITLE_MANAGE',		'����޲z');
define('_PLUGS_TITLE_INSTALLED',	'��e�w�g�w��');
define('_PLUGS_TITLE_UPDATE',		'��s�w�w�C��');
define('_PLUGS_TEXT_UPDATE',		'Nucleus������O�s�F�ƥ�y�z���w�s�C��A�ɯŴ��������A���ӹB��ɯŵ{�ǥH�O�Ҩƥ�y�z�o���s');
define('_PLUGS_TITLE_NEW',			'�w�˷s����');
define('_PLUGS_ADD_TEXT',			'�U���O�A����ؿ�Ҧ���󪺦C��A���i��O���w�˪�������C�b�w�ˤ��e��<strong>�T�{</strong>���O�@�Ӧ��Ī�������C');
define('_PLUGS_BTN_INSTALL',		'�w�˴���');
define('_BACKTOOVERVIEW',			'��^�`��');

// editlink
define('_TEMPLATE_EDITLINK',		'�s��峹�챵');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'�K�[���䲰�l');
define('_ADD_RIGHT_TT',				'�K�[�k�䲰�l');

// add/edit item�Gnew category (in dropdown box)
define('_ADD_NEWCAT',				'�s���O�K');

// new settings
define('_SETTINGS_PLUGINURL',		'����URL');
define('_SETTINGS_MAXUPLOADSIZE',	'�W�Ǥ��̤j�e�q�]bytes�^');
define('_SETTINGS_NONMEMBERMSGS',	'���\�D�|��o�e��');
define('_SETTINGS_PROTECTMEMNAMES',	'�O�@�|��W�r');

// overview screen
define('_OVERVIEW_PLUGINS',			'�޲z����K');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'�s�|���U�G');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'�A���l��a�}�G');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'�A�S���N���W�Ǩ�C��ؿ��v�O');

// plugin list
define('_LISTS_INFO',				'�H��');
define('_LIST_PLUGS_AUTHOR',		'�ѡG');
define('_LIST_PLUGS_VER',			'�����G');
define('_LIST_PLUGS_SITE',			'�X�ݺ���');
define('_LIST_PLUGS_DESC',			'�y�z�G');
define('_LIST_PLUGS_SUBS',			'�U�C�ƥ󪺹w�w�G');
define('_LIST_PLUGS_UP',			'�W��');
define('_LIST_PLUGS_DOWN',			'�U��');
define('_LIST_PLUGS_UNINSTALL',		'���');
define('_LIST_PLUGS_ADMIN',			'�޲z');
define('_LIST_PLUGS_OPTIONS',		'�s��');

// plugin option list
define('_LISTS_VALUE',				'��');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'�o�Ӵ���S������ﶵ�]�m');
define('_PLUGS_BACK',				'��^�����`��');
define('_PLUGS_SAVE',				'�O�s�ﶵ');
define('_PLUGS_OPTIONS_UPDATED',	'����ﶵ�w�g��s');

define('_OVERVIEW_MANAGEMENT',		'�޲z');
define('_OVERVIEW_MANAGE',			'�t�κ޲z�K');
define('_MANAGE_GENERAL',			'���q�޲z');
define('_MANAGE_SKINS',				'���O�P�Ҫ�');
define('_MANAGE_EXTRA',				'�X�i�\��');

define('_BACKTOMANAGE',				'��^�t�κ޲z');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'�n�X');
define('_LOGIN',					'�n�J');
define('_YES',						'�O');
define('_NO',						'�_');
define('_SUBMIT',					'����');
define('_ERROR',					'��~');
define('_ERRORMSG',					'�X�{�@�ӿ�~�I');
define('_BACK',						'��^');
define('_NOTLOGGEDIN',				'���n��');
define('_LOGGEDINAS',				'�w�n��G');
define('_ADMINHOME',				'�޲z����');
define('_NAME',						'�W�r');
define('_BACKHOME',					'��^�޲z����');
define('_BADACTION',				'�S���s�b���ʧ@�ШD');
define('_MESSAGE',					'��');
define('_HELP_TT',					'���U');
define('_YOURSITE',					'������');


define('_POPUP_CLOSE',				'�������f');

define('_LOGIN_PLEASE',				'�Х�n��');

// commentform
define('_COMMENTFORM_YOUARE',		'�A�O');
define('_COMMENTFORM_SUBMIT',		'�K�[���');
define('_COMMENTFORM_COMMENT',		'�A�����');
define('_COMMENTFORM_NAME',			'�W�r');
define('_COMMENTFORM_MAIL',			'�l��/����');
define('_COMMENTFORM_REMEMBER',		'������');

// loginform
define('_LOGINFORM_NAME',			'�Τ�W');
define('_LOGINFORM_PWD',			'�K�X');
define('_LOGINFORM_YOUARE',			'�w�n��G');
define('_LOGINFORM_SHARED',			'���@���ҹq��');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'�o�e��');

// search form
define('_SEARCHFORM_SUBMIT',		'�j��');

// add item form
define('_ADD_ADDTO',				'�K�[�s�峹��');
define('_ADD_CREATENEW',			'�إ߷s�峹');
define('_ADD_BODY',					'���p');
define('_ADD_TITLE',				'���D');
define('_ADD_MORE',					'�X�i(�i��)');
define('_ADD_CATEGORY',				'���O');
define('_ADD_PREVIEW',				'�w��');
define('_ADD_DISABLE_COMMENTS',		'������סH');
define('_ADD_DRAFTNFUTURE',			'��Z &amp; ���Ӷ���');
define('_ADD_ADDITEM',				'�K�[�峹');
define('_ADD_ADDNOW',				'�{�b�K�[');
define('_ADD_ADDLATER',				'�H��K�[');
define('_ADD_PLACE_ON',				'�]�w�ɶ�');
define('_ADD_ADDDRAFT',				'�K�[���Z');
define('_ADD_NOPASTDATES',			'�]�L�h������M�ɶ��O�L�Ī��A�t�αN�ϥη�e�ɶ��^');
define('_ADD_BOLD_TT',				'����');
define('_ADD_ITALIC_TT',			'����');
define('_ADD_HREF_TT',				'�إ߶W���챵');
define('_ADD_MEDIA_TT',				'�K�[�C����');
define('_ADD_PREVIEW_TT',			'���/���� �w��');
define('_ADD_CUT_TT',				'����');
define('_ADD_COPY_TT',				'�ƻs');
define('_ADD_PASTE_TT',				'�ŶK');


// edit item form
define('_EDIT_ITEM',				'�s��峹');
define('_EDIT_SUBMIT',				'�s��峹');
define('_EDIT_ORIG_AUTHOR',			'��Ч@��');
define('_EDIT_BACKTODRAFTS',		'�K�[�^��Z');
define('_EDIT_COMMENTSNOTE',		'�]�`�N�G������רä���R���{����ס^');

// used on delete screens
define('_DELETE_CONFIRM',			'�нT�{�R���ʧ@');
define('_DELETE_CONFIRM_BTN',		'�T�{�R��');
define('_CONFIRMTXT_ITEM',			'�A�N�R���H�U�峹�G');
define('_CONFIRMTXT_COMMENT',		'�A�N�R���H�U��סG');
define('_CONFIRMTXT_TEAM1',			'�Y�N�R��');
define('_CONFIRMTXT_TEAM2',			'�q��x�ζ��C�?');
define('_CONFIRMTXT_BLOG',			'�A�N�n�R������x���G');
define('_WARNINGTXT_BLOGDEL',		'ĵ�i�I�R����x�N�|�R����W�����Ҧ��峹�M��סC�нT�w�O�_�u���n�R����x<br />�P�ɡA�b���ʤ�x�ɤ��n�פ�t�ΡC');
define('_CONFIRMTXT_MEMBER',		'�A�N�|�R���U���|���ɮסG');
define('_CONFIRMTXT_TEMPLATE',		'�A�N�R���w�R�W���Ҫ�');
define('_CONFIRMTXT_SKIN',			'�A�N�R���w�R�W�����O ');
define('_CONFIRMTXT_BAN',			'�A�N�R����o��IP������');
define('_CONFIRMTXT_CATEGORY',		'�A�N�R�����O');

// some status messages
define('_DELETED_ITEM',				'�峹�w�R��');
define('_DELETED_MEMBER',			'�|��w�R��');
define('_DELETED_COMMENT',			'��פw�R��');
define('_DELETED_BLOG',				'��x�w�R��');
define('_DELETED_CATEGORY',			'���O�w�R��');
define('_ITEM_MOVED',				'�峹�w����');
define('_ITEM_ADDED',				'�峹�w�K�[');
define('_COMMENT_UPDATED',			'��פw��s');
define('_SKIN_UPDATED',				'���O����w�g�O�s');
define('_TEMPLATE_UPDATED',			'�Ҫ�����w�g�O�s');

// errors
define('_ERROR_COMMENT_LONGWORD',	'�Ф��n�ϥΪ�׶W�L90�Ӧr�Ū����');
define('_ERROR_COMMENT_NOCOMMENT',	'�п�J�@����');
define('_ERROR_COMMENT_NOUSERNAME',	'��~���Τ�W');
define('_ERROR_COMMENT_TOOLONG',	'�A����פӪ�(�̪�G2500�r)');
define('_ERROR_COMMENTS_DISABLED',	'�o�Ӥ�x����פw�g�Q�T��.');
define('_ERROR_COMMENTS_NONPUBLIC',	'�A�����H�|����n��~�i�H�K�[���');
define('_ERROR_COMMENTS_MEMBERNICK','�A�Q�ϥΪ��o�ӦW�r�w�g�Q��L�H�ϥΡA�Хt��@�ӡC');
define('_ERROR_SKIN',				'���O��~');
define('_ERROR_ITEMCLOSED',			'�o�g�峹�w�g�����A����K�[��שM�벼');
define('_ERROR_NOSUCHITEM',			'�S���o�g�峹');
define('_ERROR_NOSUCHBLOG',			'�S���o�Ӥ�x');
define('_ERROR_NOSUCHSKIN',			'�S���o�ӭ��O');
define('_ERROR_NOSUCHMEMBER',		'�S���o�ӷ|��');
define('_ERROR_NOTONTEAM',			'�A���b�Ӥ�x���ζ��C��W�C');
define('_ERROR_BADDESTBLOG',		'�w�w�����s�b');
define('_ERROR_NOTONDESTTEAM',		'���ಾ�ʤ峹,�A���b�o�Ӫ����ζ��C��W');
define('_ERROR_NOEMPTYITEMS',		'����K�[�Ť峹�I');
define('_ERROR_BADMAILADDRESS',		'Email�a�}�L��');
define('_ERROR_BADNOTIFY',			'�@�өΦh�Ӷl��a�}�O�L�Ī�');
define('_ERROR_BADNAME',			'�W�r�L��');
define('_ERROR_NICKNAMEINUSE',		'�w�g���@�ӷ|��ϥΨ��Ӽʺ�');
define('_ERROR_PASSWORDMISMATCH',	'�K�X�����ǰt');
define('_ERROR_PASSWORDTOOSHORT',	'�K�X�̤�6�Ӧr��');
define('_ERROR_PASSWORDMISSING',	'�K�X���ର��');
define('_ERROR_REALNAMEMISSING',	'�A������J�@�ӯu�ꪺ�W�r');
define('_ERROR_ATLEASTONEADMIN',	'�t�Φܤ����Ӧs�b�@�ӥi�H�n���޲z�ɭ����W�ťΤ�C');
define('_ERROR_ATLEASTONEBLOGADMIN','�нT�w�`�O�ܤ֦��@�ӶW�ťΤ�C');
define('_ERROR_ALREADYONTEAM',		'�ζ����w�g�s�b�o�ӷ|��');
define('_ERROR_BADSHORTBLOGNAME',	'��x�Y�g�u���\�]�ta-z,0-9');
define('_ERROR_DUPSHORTBLOGNAME',	'��L��x�w�g�ϥγo���Y�g�W��');
define('_ERROR_UPDATEFILE',			'��ɯŤ��S���g�J�v���A�нT�w����v���]�m���T�]chmod 666�^�C�P�ɪ`�N���|�O���޲z�ؿ�۹���|�A�ҥH�A�i��ݭn�ϥε�����|�]�p/your/path/to/nucleus/�^�C');
define('_ERROR_DELDEFBLOG',			'����R���q�{��x');
define('_ERROR_DELETEMEMBER',		'�ӷ|��L�k�R���A�L�i��O�峹�ε�ת��@��');
define('_ERROR_BADTEMPLATENAME',	'�L�Ī��Ҫ��W�]�u���\a-z, 0-9�^');
define('_ERROR_DUPTEMPLATENAME',	'�w�s�b�o�ˤ@�ӦW�r���Ҫ�');
define('_ERROR_BADSKINNAME',		'�L�ĭ��O�W�]�u���\a-z, 0-9�^');
define('_ERROR_DUPSKINNAME',		'�w�s�b�P�W���O');
define('_ERROR_DEFAULTSKIN',		'�t�Υ������@�ӦW��"default"���q�{���O');
define('_ERROR_SKINDEFDELETE',		'�o�O�q�{���O�A����R���G');
define('_ERROR_DISALLOWED',			'�藍�_�A�A�S���v�O����Ӱʧ@');
define('_ERROR_DELETEBAN',			'�R�����ꪺ�ɭԵo�Ϳ�~�]���ꤣ�s�b�^�C');
define('_ERROR_ADDBAN',				'�K�[���ꪺ�ɭԵo�Ϳ�~�A���i��S�����T�K�[��A���Ҧ���x�̡C');
define('_ERROR_BADACTION',			'�ݭn���ʧ@���s�b');
define('_ERROR_MEMBERMAILDISABLED',	'�|���|��l���Q�T��');
define('_ERROR_MEMBERCREATEDISABLED','�إ߷|��㸹�Q�T��');
define('_ERROR_INCORRECTEMAIL',		'�����T���l��a�}');
define('_ERROR_VOTEDBEFORE',		'�A�w�g���o�Ӥ峹��L���F');
define('_ERROR_BANNED1',			'�ʧ@�L�k����]IP�d��');
define('_ERROR_BANNED2',			'�^�Q����C���G\'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'����o�Ӱʧ@�����n��');
define('_ERROR_CONNECT',			'�s����~');
define('_ERROR_FILE_TOO_BIG',		'���Ӥj�I');
define('_ERROR_BADFILETYPE',		'�藍�_�A�����\�W�ǳo�خ榡�����');
define('_ERROR_BADREQUEST',			'�L�Ī��W�ǽШD');
define('_ERROR_DISALLOWEDUPLOAD',	'�A���b�����x���ζ��C�?�A�S���W�Ǥ���v�O');
define('_ERROR_BADPERMISSIONS',		'���/�ؿ��v���]�m�����T');
define('_ERROR_UPLOADMOVEP',		'�W�Ǥ��ɵo�Ϳ�~');
define('_ERROR_UPLOADCOPY',			'�������ɵo�Ϳ�~');
define('_ERROR_UPLOADDUPLICATE',	'�w�g���@�ӦP�W���A�W�Ǥ��e�Х��W�C');
define('_ERROR_LOGINDISALLOWED',	'�藍�_�A�A����n��޲z�ϡC��i�H�Ψ�L�Τᨭ���n��');
define('_ERROR_DBCONNECT',			'�L�k�s���� MySQL �A�Ⱦ�');
define('_ERROR_DBSELECT',			'�L�k��ܤ峹�t�Ϊ��ƾڮw');
define('_ERROR_NOSUCHLANGUAGE',		'�S���o�ӻy�����');
define('_ERROR_NOSUCHCATEGORY',		'�S���o�����O');
define('_ERROR_DELETELASTCATEGORY',	'�ܤ֤@�����O');
define('_ERROR_DELETEDEFCATEGORY',	'����R���q�{���O');
define('_ERROR_BADCATEGORYNAME',	'�L�����O�W');
define('_ERROR_DUPCATEGORYNAME',	'�w�g�s�b�P�W���O');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'ĵ�i�G��e�ȫD�ؿ�I');
define('_WARNING_NOTREADABLE',		'ĵ�i�G��e�Ȭ����iŪ��ؿ�I');
define('_WARNING_NOTWRITABLE',		'ĵ�i�G��e�Ȭ����iŪ��ؿ�I');

// media and upload
define('_MEDIA_UPLOADLINK',			'�W�Ǥ@�ӷs���');
define('_MEDIA_MODIFIED',			'�ק�');
define('_MEDIA_FILENAME',			'���W');
define('_MEDIA_DIMENSIONS',			'�ؤo');
define('_MEDIA_INLINE',				'�����f');
define('_MEDIA_POPUP',				'�s���f');
define('_UPLOAD_TITLE',				'��ܤ��');
define('_UPLOAD_MSG',				'��ܧA�Q�W�Ǫ����A�M���I�� \'Upload\' ���s�C');
define('_UPLOAD_BUTTON',			'�W��');

// some status messages
define('_MSG_ACCOUNTCREATED',		'�㸹�w�إߡA�K�X�N�|�q�L�l��q���A');
define('_MSG_PASSWORDSENT',			'�K�X�w�q�L�l��o�X�C');
define('_MSG_LOGINAGAIN',			'�A�ݭn���s�n��A�]���A���H���w�g���ܡC');
define('_MSG_SETTINGSCHANGED',		'�]�m����');
define('_MSG_ADMINCHANGED',			'�޲z�����');
define('_MSG_NEWBLOG',				'�s����x�w�إ�');
define('_MSG_ACTIONLOGCLEARED',		'�ʧ@�O��M��');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'�����\���ʧ@�G');
define('_ACTIONLOG_PWDREMINDERSENT','�s�K�X�e�X��');
define('_ACTIONLOG_TITLE',			'�ʧ@�O��');
define('_ACTIONLOG_CLEAR_TITLE',	'�M���ʧ@�O��');
define('_ACTIONLOG_CLEAR_TEXT',		'�{�b�N�M���ʧ@�O��');

// team management
define('_TEAM_TITLE',				'����x�޲z�ζ� ');
define('_TEAM_CURRENT',				'��e�ζ�');
define('_TEAM_ADDNEW',				'�V�ζ����K�[�s�|��');
define('_TEAM_CHOOSEMEMBER',		'��ܷ|��');
define('_TEAM_ADMIN',				'�W�ź޲z���v���H ');
define('_TEAM_ADD',					'�K�[��ζ�');
define('_TEAM_ADD_BTN',				'�K�[��ζ�');

// blogsettings
define('_EBLOG_TITLE',				'�s���x�]�m');
define('_EBLOG_TEAM_TITLE',			'�s��ζ�');
define('_EBLOG_TEAM_TEXT',			'�I���o�̽s��A���ζ��K');
define('_EBLOG_SETTINGS_TITLE',		'��x�]�m');
define('_EBLOG_NAME',				'��x�W');
define('_EBLOG_SHORTNAME',			'��x�W�Y�g');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(�u���\�]�t a-z )');
define('_EBLOG_DESC',				'��x�y�z');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'�q�{���O');
define('_EBLOG_DEFCAT',				'�q�{���O');
define('_EBLOG_LINEBREAKS',			'�ഫ�椤�_');
define('_EBLOG_DISABLECOMMENTS',	'�}�ҵ��');
define('_EBLOG_ANONYMOUS',			'���\�D�|����');
define('_EBLOG_NOTIFY',				'�q���a�}�]�h�Ӧa�}�� ; ���j�^');
define('_EBLOG_NOTIFY_ON',			'�H�U�ƥ�q��');
define('_EBLOG_NOTIFY_COMMENT',		'�s���');
define('_EBLOG_NOTIFY_KARMA',		'�s���벼');
define('_EBLOG_NOTIFY_ITEM',		'�s����x');
define('_EBLOG_PING',				'��s�� Ping Weblogs.com�H');
define('_EBLOG_MAXCOMMENTS',		'�̦h���\��׼ƶq');
define('_EBLOG_UPDATE',				'��s���');
define('_EBLOG_OFFSET',				'�ɮt');
define('_EBLOG_STIME',				'��e�A�Ⱦ��ɶ���');
define('_EBLOG_BTIME',				'��e��x�ɶ���');
define('_EBLOG_CHANGE',				'���ܳ]�m');
define('_EBLOG_CHANGE_BTN',			'���ܳ]�m');
define('_EBLOG_ADMIN',				'��x�޲z��');
define('_EBLOG_ADMIN_MSG',			'�N�Q�¤��޲z���v�O');
define('_EBLOG_CREATE_TITLE',		'�Ыطs��x');
define('_EBLOG_CREATE_TEXT',		'��g�U�������Ыؤ@�ӷs��x. <br /><br /> <b>�`�N�G</b> �C�?�u�����n���ﶵ�A�p�G�A�Q����h���ﶵ�A�Ыث�A��������]�m���h�ק�C');
define('_EBLOG_CREATE',				'�ЫءI');
define('_EBLOG_CREATE_BTN',			'�Ыؤ�x');
define('_EBLOG_CAT_TITLE',			'���O');
define('_EBLOG_CAT_NAME',			'���O�W');
define('_EBLOG_CAT_DESC',			'���O�y�z');
define('_EBLOG_CAT_CREATE',			'�Ыطs�����O');
define('_EBLOG_CAT_UPDATE',			'��s���O');
define('_EBLOG_CAT_UPDATE_BTN',		'��s���O');

// templates
define('_TEMPLATE_TITLE',			'�s��Ҫ�');
define('_TEMPLATE_AVAILABLE_TITLE',	'���ļҪ�');
define('_TEMPLATE_NEW_TITLE',		'�s�Ҫ�');
define('_TEMPLATE_NAME',			'�Ҫ��W');
define('_TEMPLATE_DESC',			'�Ҫ��y�z');
define('_TEMPLATE_CREATE',			'�إ߼Ҫ�');
define('_TEMPLATE_CREATE_BTN',		'�إ߼Ҫ�');
define('_TEMPLATE_EDIT_TITLE',		'�s��Ҫ�');
define('_TEMPLATE_BACK',			'��^�Ҫ��`��');
define('_TEMPLATE_EDIT_MSG',		'�ëD�Ҧ����Ҫ����O�ݭn��,�A���ݭn�����ǥi�H�d��.');
define('_TEMPLATE_SETTINGS',		'�Ҫ��]�m');
define('_TEMPLATE_ITEMS',			'�峹');
define('_TEMPLATE_ITEMHEADER',		'�峹�Y');
define('_TEMPLATE_ITEMBODY',		'�峹��');
define('_TEMPLATE_ITEMFOOTER',		'�峹��');
define('_TEMPLATE_MORELINK',		'�s�����X�i�J�f');
define('_TEMPLATE_NEW',				'�s��ؼлx');
define('_TEMPLATE_COMMENTS_ANY',	'���');
define('_TEMPLATE_CHEADER',			'����Y');
define('_TEMPLATE_CBODY',			'�����');
define('_TEMPLATE_CFOOTER',			'��ק�');
define('_TEMPLATE_CONE',			'�@����');
define('_TEMPLATE_CMANY',			'���]�Χ�h�^���');
define('_TEMPLATE_CMORE',			'�\Ū��h���');
define('_TEMPLATE_CMEXTRA',			'�|���X�i');
define('_TEMPLATE_COMMENTS_NONE',	'���(�p�G�S��)');
define('_TEMPLATE_CNONE',			'�S�����');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comments (�Ӧh�A�L�k�b�u���)');
define('_TEMPLATE_CTOOMUCH',		'��פӦh');
define('_TEMPLATE_ARCHIVELIST',		'�ɮצC��');
define('_TEMPLATE_AHEADER',			'�ɮצC���Y');
define('_TEMPLATE_AITEM',			'�ɮצC�?��');
define('_TEMPLATE_AFOOTER',			'�ɮצC���');
define('_TEMPLATE_DATETIME',		'����M�ɶ�');
define('_TEMPLATE_DHEADER',			'����Y');
define('_TEMPLATE_DFOOTER',			'�����');
define('_TEMPLATE_DFORMAT',			'����榡');
define('_TEMPLATE_TFORMAT',			'�ɶ��榡');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'�Ϲ��s���f');
define('_TEMPLATE_PCODE',			'�s���f');
define('_TEMPLATE_ICODE',			'�O�J�Ϲ��N�X');
define('_TEMPLATE_MCODE',			'�C��ﹳ�챵�N�X');
define('_TEMPLATE_SEARCH',			'�j��');
define('_TEMPLATE_SHIGHLIGHT',		'�E�J');
define('_TEMPLATE_SNOTFOUND',		'�S��������F��');
define('_TEMPLATE_UPDATE',			'��s');
define('_TEMPLATE_UPDATE_BTN',		'��s�Ҫ�');
define('_TEMPLATE_RESET_BTN',		'���m���');
define('_TEMPLATE_CATEGORYLIST',	'���O�C��');
define('_TEMPLATE_CATHEADER',		'���O�C���Y');
define('_TEMPLATE_CATITEM',			'���O�C�?��');
define('_TEMPLATE_CATFOOTER',		'���O�C���');

// skins
define('_SKIN_EDIT_TITLE',			'�s�譱�O');
define('_SKIN_AVAILABLE_TITLE',		'���Ī����O');
define('_SKIN_NEW_TITLE',			'�s���O');
define('_SKIN_NAME',				'�W�r');
define('_SKIN_DESC',				'�y�z');
define('_SKIN_TYPE',				'���e����');
define('_SKIN_CREATE',				'�Ы�');
define('_SKIN_CREATE_BTN',			'�Ыح��O');
define('_SKIN_EDITONE_TITLE',		'�s�譱�O');
define('_SKIN_BACK',				'��^���O�`��');
define('_SKIN_PARTS_TITLE',			'���O����');
define('_SKIN_PARTS_MSG',			'�ä��O�Ҧ����_�O���ݪ�,���ݭn���i�H�d��.��ܤU���ݭn�s�誺���O����');
define('_SKIN_PART_MAIN',			'�D���ޤ��');
define('_SKIN_PART_ITEM',			'�峹��');
define('_SKIN_PART_ALIST',			'�ɮצC��');
define('_SKIN_PART_ARCHIVE',		'�ɮ�');
define('_SKIN_PART_SEARCH',			'�j��');
define('_SKIN_PART_ERROR',			'��~');
define('_SKIN_PART_MEMBER',			'�|��ԲӸ��');
define('_SKIN_PART_POPUP',			'�Ϲ��u�X���f');
define('_SKIN_GENSETTINGS_TITLE',	'���q�]�m');
define('_SKIN_CHANGE',				'����');
define('_SKIN_CHANGE_BTN',			'���ܳo�ǳ]�m');
define('_SKIN_UPDATE_BTN',			'��s���O');
define('_SKIN_RESET_BTN',			'��_�ƾ�');
define('_SKIN_EDITPART_TITLE',		'�s�譱�O');
define('_SKIN_GOBACK',				'��^');
define('_SKIN_ALLOWEDVARS',			'���\����F���]�I�����������ع�ݸԲӫH���^�G');

// global settings
define('_SETTINGS_TITLE',			'���q�]�m');
define('_SETTINGS_SUB_GENERAL',		'���q�]�m');
define('_SETTINGS_DEFBLOG',			'�q�{��x');
define('_SETTINGS_ADMINMAIL',		'�W�ź޲z��l��');
define('_SETTINGS_SITENAME',		'�����W��');
define('_SETTINGS_SITEURL',			'������URL�]�H�׽u"/"�����^');
define('_SETTINGS_ADMINURL',		'�޲z��ϰ쪺URL�]�H�׽u"/"�����^');
define('_SETTINGS_DIRS',			'�t�Υؿ�');
define('_SETTINGS_MEDIADIR',		'�C��ؿ�');
define('_SETTINGS_SEECONFIGPHP',	'�]��� config.php�^');
define('_SETTINGS_MEDIAURL',		'Media URL �]�H�׽u"/"�����^');
define('_SETTINGS_ALLOWUPLOAD',		'���\���W�ǡH');
define('_SETTINGS_ALLOWUPLOADTYPES','���\�W�Ǥ������');
define('_SETTINGS_CHANGELOGIN',		'���\�|����n��K�X');
define('_SETTINGS_COOKIES_TITLE',	'Cookie �]�m');
define('_SETTINGS_COOKIELIFE',		'Cookie �O�s�ɶ�');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'�O�s�@�Ӥ�');
define('_SETTINGS_COOKIEPATH',		'Cookie ���| (����)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie ��]���š^');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie�]���š^');
define('_SETTINGS_LASTVISIT',		'�O�s�W���X�ݪ�Cookie');
define('_SETTINGS_ALLOWCREATE',		'���\�X�ȫإ߷|��㸹');
define('_SETTINGS_NEWLOGIN',		'���\�X�ȫإߪ��㸹�n��');
define('_SETTINGS_NEWLOGIN2',		'�]�u�b�s��U���㸹�W�ͮġ^');
define('_SETTINGS_MEMBERMSGS',		'���\�|���|��A��');
define('_SETTINGS_LANGUAGE',		'�q�{�y��');
define('_SETTINGS_DISABLESITE',		'�������I');
define('_SETTINGS_DBLOGIN',			'MySQL �n�� &amp; �ƾڮw');
define('_SETTINGS_UPDATE',			'��s�]�m');
define('_SETTINGS_UPDATE_BTN',		'��s�]�m');
define('_SETTINGS_DISABLEJS',		'�T�� JavaScript �u���');
define('_SETTINGS_MEDIA',			'�C��/�W�� �]�m');
define('_SETTINGS_MEDIAPREFIX',		'�e��W�Ǥ��a�����');
define('_SETTINGS_MEMBERS',			'�|��]�m');

// bans
define('_BAN_TITLE',				'�T��C��');
define('_BAN_NONE',					'���x�S���������');
define('_BAN_NEW_TITLE',			'�K�[�s������');
define('_BAN_NEW_TEXT',				'�{�b�K�[�@��s������');
define('_BAN_REMOVE_TITLE',			'�R���W�w');
define('_BAN_IPRANGE',				'IP����');
define('_BAN_BLOGS',				'���Ӥ�x�H');
define('_BAN_DELETE_TITLE',			'�R������');
define('_BAN_ALLBLOGS',				'�A�֦��޲z���v�Q���Ҧ���x�C');
define('_BAN_REMOVED_TITLE',		'���겾��');
define('_BAN_REMOVED_TEXT',			'�q�H�U��x��������G');
define('_BAN_ADD_TITLE',			'�K�[����');
define('_BAN_IPRANGE_TEXT',			'��ܧA�n���ꪺIP�C');
define('_BAN_BLOGS_TEXT',			'�A�i�H��ܶȶȸT���x�Ϊ̸T��Ҧ��A�֦��޲z���v�Q����x�A�b�U����ܡC');
define('_BAN_REASON_TITLE',			'��]');
define('_BAN_REASON_TEXT',			'�A�i�H�����괣�Ѥ@�ӭ�]�A��Q�T�IP�Ҧ��̸չϲK�[�t�@���שΪ̬O�벼����ܡA�̦h128�r�C');
define('_BAN_ADD_BTN',				'�K�[����');

// LOGIN screen
define('_LOGIN_MESSAGE',			'��');
define('_LOGIN_NAME',				'�W�r');
define('_LOGIN_PASSWORD',			'�K�X');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'�ѰO�K�X�H');

// membermanagement
define('_MEMBERS_TITLE',			'�|��޲z');
define('_MEMBERS_CURRENT',			'��e�|��');
define('_MEMBERS_NEW',				'�s�|��');
define('_MEMBERS_DISPLAY',			'�㸹');
define('_MEMBERS_DISPLAY_INFO',		'�]�Y�n��W�^');
define('_MEMBERS_REALNAME',			'�u��W�r');
define('_MEMBERS_PWD',				'�K�X');
define('_MEMBERS_REPPWD',			'���ƱK�X');
define('_MEMBERS_EMAIL',			'Email�a�}');
define('_MEMBERS_EMAIL_EDIT',		'�]��A���ܶl��a�}���ɭԡA�N�|�V�Ӧa�}�o���@�ʶl��^');
define('_MEMBERS_URL',				'�����a�}(URL)');
define('_MEMBERS_SUPERADMIN',		'�W�ź޲z���v��');
define('_MEMBERS_CANLOGIN',			'�i�H�n���޲z��ɭ�');
define('_MEMBERS_NOTES',			'�`�N');
define('_MEMBERS_NEW_BTN',			'�K�[�|��');
define('_MEMBERS_EDIT',				'�s��|��');
define('_MEMBERS_EDIT_BTN',			'���ܳ]�m');
define('_MEMBERS_BACKTOOVERVIEW',	'��^�|���`��');
define('_MEMBERS_DEFLANG',			'�y��');
define('_MEMBERS_USESITELANG',		'- �ϥί��I�]�m -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'�X�ݯ��I');
define('_BLOGLIST_ADD',				'�K�[�峹');
define('_BLOGLIST_TT_ADD',			'�b�o�Ӥ�x���K�[�s�峹');
define('_BLOGLIST_EDIT',			'�s��/�R�� �峹');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'����');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'�]�m');
define('_BLOGLIST_TT_SETTINGS',		'�s��]�m�Ϊ̺޲z�ζ�');
define('_BLOGLIST_BANS',			'�W�w');
define('_BLOGLIST_TT_BANS',			'���,�K�[�Ϊ̲����Q�T�IP');
define('_BLOGLIST_DELETE',			'�����R��');
define('_BLOGLIST_TT_DELETE',		'�R���Ӥ�x');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'�A����x');
define('_OVERVIEW_YRDRAFTS',		'�A����Z');
define('_OVERVIEW_YRSETTINGS',		'�A���]�m');
define('_OVERVIEW_GSETTINGS',		'���q�]�m');
define('_OVERVIEW_NOBLOGS',			'�A���ݩ����ζ����C��');
define('_OVERVIEW_NODRAFTS',		'�S����Z');
define('_OVERVIEW_EDITSETTINGS',	'�s��]�m�K');
define('_OVERVIEW_BROWSEITEMS',		'�s��ءK');
define('_OVERVIEW_BROWSECOMM',		'�s���סK');
define('_OVERVIEW_VIEWLOG',			'�ʧ@����K');
define('_OVERVIEW_MEMBERS',			'�|��޲z�K');
define('_OVERVIEW_NEWLOG',			'�إ߷s����x�K');
define('_OVERVIEW_SETTINGS',		'�s��]�m�K');
define('_OVERVIEW_TEMPLATES',		'�s��Ҫ��K');
define('_OVERVIEW_SKINS',			'�s�譱�O�K');
define('_OVERVIEW_BACKUP',			'�ƥ�/��_�K');

// ITEMLIST
define('_ITEMLIST_BLOG',			'�o�Ӥ�x���峹'); 
define('_ITEMLIST_YOUR',			'�A���峹');

// Comments
define('_COMMENTS',					'���');
define('_NOCOMMENTS',				'�o�g�峹�S�����');
define('_COMMENTS_YOUR',			'�A�����');
define('_NOCOMMENTS_YOUR',			'�A�S���g������');

// LISTS (general)
define('_LISTS_NOMORE',				'�S����h���G�Ϊ̨S�����G');
define('_LISTS_PREV',				'�W�@�g');
define('_LISTS_NEXT',				'�U�@�g');
define('_LISTS_SEARCH',				'�j��');
define('_LISTS_CHANGE',				'����');
define('_LISTS_PERPAGE',			'�峹/��');
define('_LISTS_ACTIONS',			'�ʧ@');
define('_LISTS_DELETE',				'�R��');
define('_LISTS_EDIT',				'�s��');
define('_LISTS_MOVE',				'����');
define('_LISTS_CLONE',				'�J��');
define('_LISTS_TITLE',				'���D');
define('_LISTS_BLOG',				'��x');
define('_LISTS_NAME',				'�W�r');
define('_LISTS_DESC',				'�y�z');
define('_LISTS_TIME',				'�ɶ�');
define('_LISTS_COMMENTS',			'���');
define('_LISTS_TYPE',				'����');


// member list 
define('_LIST_MEMBER_NAME',			'�Τ�㸹');
define('_LIST_MEMBER_RNAME',		'�u��W�r');
define('_LIST_MEMBER_ADMIN',		'�W�ź޲z��H');
define('_LIST_MEMBER_LOGIN',		'����n��H');
define('_LIST_MEMBER_URL',			'����');

// banlist
define('_LIST_BAN_IPRANGE',			'IP�d��');
define('_LIST_BAN_REASON',			'��]');

// actionlist
define('_LIST_ACTION_MSG',			'��');

// commentlist
define('_LIST_COMMENT_BANIP',		'�T��IP');
define('_LIST_COMMENT_WHO',			'�@��');
define('_LIST_COMMENT',				'���');
define('_LIST_COMMENT_HOST',		'�D�H');

// itemlist
define('_LIST_ITEM_INFO',			'�H��');
define('_LIST_ITEM_CONTENT',		'���D�M�奻');


// teamlist
define('_LIST_TEAM_ADMIN',			'�W�ťΤ� ');
define('_LIST_TEAM_CHADMIN',		'���W�ťΤ�');

// edit comments
define('_EDITC_TITLE',				'�s����');
define('_EDITC_WHO',				'�@��');
define('_EDITC_HOST',				'�q���̡H');
define('_EDITC_WHEN',				'����ɭԡH');
define('_EDITC_TEXT',				'�奻');
define('_EDITC_EDIT',				'�s����');
define('_EDITC_MEMBER',				'�|��');
define('_EDITC_NONMEMBER',			'�D�|��');

// move item
define('_MOVE_TITLE',				'���ʨ���Ӥ�x�H');
define('_MOVE_BTN',					'���ʤ峹');
