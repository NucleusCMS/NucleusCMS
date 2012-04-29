<?php
// Latvian Nucleus Language File
//
// Author: Kaspars Priedols (house@tvertne.nu)
// Nucleus version: v1.0-v2.0
//
// Please note: if you want to translate this file to your own translation, be aware
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
define('_MEDIA_VIEW',				'skats');
define('_MEDIA_VIEW_TT',			'Skat�t failu (jaun� log�)');
define('_MEDIA_FILTER_APPLY',		'Pievienot filtru');
define('_MEDIA_FILTER_LABEL',		'Filtrs: ');
define('_MEDIA_UPLOAD_TO',			'Uzlikt uz...');
define('_MEDIA_UPLOAD_NEW',			'Uzlikt jaunu failu...');
define('_MEDIA_COLLECTION_SELECT',	'Izv�l�ties');
define('_MEDIA_COLLECTION_TT',		'P�riet uz sada�u');
define('_MEDIA_COLLECTION_LABEL',	'Pa�reiz�j� kolekcija: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Kreisaj� pus�');
define('_ADD_ALIGNRIGHT_TT',		'Labaj� pus�');
define('_ADD_ALIGNCENTER_TT',		'Iecentr�ts');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Pievienot mekl��anas indeksam');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'K��das rezult�t� fails netika pievienots.');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'At�aut s�t�t ar atpaka�ejo�u datumu');
define('_ADD_CHANGEDATE',			'Izmain�t laiku');
define('_BMLET_CHANGEDATE',			'Izmain�t laiku');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Noform�juma imports/eksports...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Vienk�r�i');
define('_PARSER_INCMODE_SKINDIR',	'Izmantot skins direktoriju');
define('_SKIN_INCLUDE_MODE',		'Pievieno�anas veids');
define('_SKIN_INCLUDE_PREFIX',		'Pievieno�anas prefikss');

// global settings
define('_SETTINGS_BASESKIN',		'Pamatnoform�jums');
define('_SETTINGS_SKINSURL',		'Noform�juma pakotnes URL');
define('_SETTINGS_ACTIONSURL',		'Pilns URL uz action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nevar p�rvietot pamatsada�u');
define('_ERROR_MOVETOSELF',			'Nevar p�rvietot sada�u (abas sada�as ir viens un tas pats)');
define('_MOVECAT_TITLE',			'Izv�lies kura bloga sada�u p�rvietot');
define('_MOVECAT_BTN',				'P�rvietot sada�u');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL re��ms');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nav iez�m�ti objekti');
define('_BATCH_ITEMS',				'Str�d�t ar ierakstiem');
define('_BATCH_CATEGORIES',			'Str�d�t ar sada��m');
define('_BATCH_MEMBERS',			'Str�d�t ar lietot�jiem');
define('_BATCH_TEAM',				'Str�d�t ar lietot�ju grupu');
define('_BATCH_COMMENTS',			'Str�d�t ar koment�riem');
define('_BATCH_UNKNOWN',			'Nepareiza oper�cija: ');
define('_BATCH_EXECUTING',			'Izpild��ana');
define('_BATCH_ONCATEGORY',			'sada�a');
define('_BATCH_ONITEM',				'ieraksts');
define('_BATCH_ONCOMMENT',			'koment�rs');
define('_BATCH_ONMEMBER',			'lietot�js');
define('_BATCH_ONTEAM',				'lietot�ju grupa');
define('_BATCH_SUCCESS',			'Veiksm�gi!');
define('_BATCH_DONE',				'Padar�ts!');
define('_BATCH_DELETE_CONFIRM',		'Apstiprin�t dz��anu');
define('_BATCH_DELETE_CONFIRM_BTN',	'Apstiprin�t dz��anu');
define('_BATCH_SELECTALL',			'iez�m�t visu');
define('_BATCH_DESELECTALL',		'no�emt visus iez�m�jumus');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Dz�st');
define('_BATCH_ITEM_MOVE',			'P�rvietot');
define('_BATCH_MEMBER_DELETE',		'Dz�st');
define('_BATCH_MEMBER_SET_ADM',		'Pie��irt administratora ties�bas');
define('_BATCH_MEMBER_UNSET_ADM',	'At�emt administratora ties�bas');
define('_BATCH_TEAM_DELETE',		'Dz�st no grupas');
define('_BATCH_TEAM_SET_ADM',		'Pie��irt administratora ties�bas');
define('_BATCH_TEAM_UNSET_ADM',		'At�emt administratora ties�bas');
define('_BATCH_CAT_DELETE',			'Dz�st');
define('_BATCH_CAT_MOVE',			'P�rvietot uz citu blogu');
define('_BATCH_COMMENT_DELETE',		'Dz�st');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pievienot jaunu ierakstu...');
define('_ADD_PLUGIN_EXTRAS',		'Pluginu ekstra opcijas');

// errors
define('_ERROR_CATCREATEFAIL',		'Nevar izveidot jaunu sada�u');
define('_ERROR_NUCLEUSVERSIONREQ',	'�� plugina aktiviz��anai nepiecie�ama jaun�ka Nucleus versija: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Atpaka� uz bloga uzst�d�jumiem');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import�t');
define('_SKINIE_TITLE_EXPORT',		'Eksport�t');
define('_SKINIE_BTN_IMPORT',		'Import�t');
define('_SKINIE_BTN_EXPORT',		'Eksport�t izv�l�tos noform�jumus/sagataves');
define('_SKINIE_LOCAL',				'Import�t no lok�la faila:');
define('_SKINIE_NOCANDIDATES',		'Skins direktorij� nekas import�jams nav atrasts');
define('_SKINIE_FROMURL',			'import�t no URL:');
define('_SKINIE_EXPORT_INTRO',		'Izv�lies noform�jumu un sagataves, kuras eksport�t');
define('_SKINIE_EXPORT_SKINS',		'Noform�jums (skins)');
define('_SKINIE_EXPORT_TEMPLATES',	'Sagataves');
define('_SKINIE_EXPORT_EXTRA',		'Papildus info');
#define('_SKINIE_CONFIRM_OVERWRITE', 'P�rrakst�t jau eksist�jo�us noform�jumus (see nameclashes)');
define('_SKINIE_CONFIRM_OVERWRITE',	'P�rrakst�t jau eksist�jo�us noform�jumus');
define('_SKINIE_CONFIRM_IMPORT',	'J�, import�t');
define('_SKINIE_CONFIRM_TITLE',		'Noform�juma un sagatavju import��ana');
define('_SKINIE_INFO_SKINS',		'Noform�jumi fail�:');
define('_SKINIE_INFO_TEMPLATES',	'Sagataves fail�:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Noform�juma nesader�ba (clashes):');
define('_SKINIE_INFO_TEMPLCLASH',	'Sagatavju nosaukumu nesader�ba (clashes):');
define('_SKINIE_INFO_IMPORTEDSKINS','Import�tie noform�jumi:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Import�t�s sagataves:');
define('_SKINIE_DONE',				'Import��ana veiksm�gi paveikta');

define('_AND',						'un');
define('_OR',						'vai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tuk�s lauks (klik��ini, lai modific�tu)');

// skin overview list
//
// need to see in reality, then translate.
// will be translated l8r       -Kaspars
//
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Rezerves kopija / Atjauno�ana');
define('_BACKUP_TITLE',				'Rezerves kopija');
define('_BACKUP_INTRO',				'Klik��ini uz pogas, lai izveidotu Nucleus rezerves kopiju. Rezerves kopija b�s jasaglab� uz tava ciet� diska.');
define('_BACKUP_ZIP_YES',			'Kompres�t');
define('_BACKUP_ZIP_NO',			'Nekompres�t');
define('_BACKUP_BTN',				'Izveidot kopiju');
define('_BACKUP_NOTE',				'<b>Piez�me:</b> Rezerves kopij� tiek uzglab�ti tikai datu b�z� eso�ie dati. Att�li un citi faili <b>NETIEK</b> iek�auti.');
define('_RESTORE_TITLE',			'Atjaunot');
define('_RESTORE_NOTE',				'<b>UZMAN�BU:</b> Atjauno�anas rezult�t� visi Nucleus datu b�z� eso�ie dati tiks <b>DZ�STI</b>, t�p�c vair�kk�rt p�rliecinies, vai ir izveidota rezerves kopija1<br />	<b>Piez�me:</b> Rezerves kopijas datiem j�b�t no t�s pa�as Nucleus versijas, kas pa�laik ir uzinstal�ta pret�j� gad�jum� Nucleus nestr�d�s!');
define('_RESTORE_INTRO',			'Izv�lies attiec�gu failu, no kura atjaunot datu b�zi.');
define('_RESTORE_IMSURE',			'J�, esmu gatavs!');
define('_RESTORE_BTN',				'Atjaunot no faila');
define('_RESTORE_WARNING',			'(v�lreiz p�rliecinies, vai ir izveidota rezerves kopija)');
define('_ERROR_BACKUP_NOTSURE',		'J�iez�m� \'J�, esmu gatavs!\' lauci��');
define('_RESTORE_COMPLETE',			'Atjauno�ana pabeigta');

// new item notification
define('_NOTIFY_NI_MSG',			'Jauns ieraksts:');
define('_NOTIFY_NI_TITLE',			'Jauns!');
// ""wtf is karma here? And how to tranlsate it? :)"  -Kaspars
//define('_NOTIFY_KV_MSG',            'Karma vote on item:');
//define('_NOTIFY_KV_TITLE',            'Nucleus karma:');
define('_NOTIFY_KV_MSG',			'Karma ierakstam:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Ieraksta koment�rs:');
define('_NOTIFY_NC_TITLE',			'Nucleus koment�rs:');
define('_NOTIFY_USERID',			'Lietot�ja ID:');
define('_NOTIFY_USER',				'Lietot�js:');
define('_NOTIFY_COMMENT',			'Koment�rs:');
define('_NOTIFY_VOTE',				'V�rt�jums:');
define('_NOTIFY_HOST',				'Adrese:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Lietot�js:');
define('_NOTIFY_TITLE',				'Virsraksts:');
define('_NOTIFY_CONTENTS',			'Saturs:');

// member mail message
define('_MMAIL_MSG',				'Nos�t�jusi');
define('_MMAIL_FROMANON',			'anon�ma persona');
define('_MMAIL_FROMNUC',			'Nos�t�ts no Nucleus [web]bloga');
define('_MMAIL_TITLE',				'V�stule no');
define('_MMAIL_MAIL',				'Zi�a:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',                'Pievienot');
define('_BMLET_EDIT',                'Modific�t');
define('_BMLET_DELETE',                'Dz�st');
define('_BMLET_BODY',                'Papla�in�ti');
define('_BMLET_MORE',                'Vienk�r�i');
define('_BMLET_OPTIONS',            'Opcijas');
define('_BMLET_PREVIEW',            'Apskat�t');

// used in bookmarklet
define('_ITEM_UPDATED',                'Ieraksts izmain�ts');
define('_ITEM_DELETED',                'Ieraksts dz�sts');

// plugins
define('_CONFIRMTXT_PLUGIN',        'Tie��m dz�st pluginu ');
define('_ERROR_NOSUCHPLUGIN',        'Nav t�da plugina');
define('_ERROR_DUPPLUGIN',            'T�ds plugins jau ir');
define('_ERROR_PLUGFILEERROR',        'Nav t�da plugina vai ar� nav piek�uves ties�bu');
define('_PLUGS_NOCANDIDATES',        'Nav atrasts neviens plugins');

define('_PLUGS_TITLE_MANAGE',        'Plugini');
define('_PLUGS_TITLE_INSTALLED',    'Pa�laik akt�vie');
define('_PLUGS_TITLE_UPDATE',        'Atjaunot sarakstu');
define('_PLUGS_TEXT_UPDATE',        'Nucleus saglab� ke�� pluginu sarakstu. Atjaunojot/mainot pluginus, j�p�rliecin�s vai �is saraksts ar� tiek atjaunots');
define('_PLUGS_TITLE_NEW',            'Pievienot pluginus');
define('_PLUGS_ADD_TEXT',            'Zem�k redzams visu pieejamo pluginu saraksts, kas nav uzinstal�ti. V�lreiz papildus p�rliecinies, vai �aj� saraksta atrodamie plugini tie��m ir plugini!');
define('_PLUGS_BTN_INSTALL',        'Instal�t pluginu');
define('_BACKTOOVERVIEW',            'Atpaka� uz aprakstu');

// editlink
define('_TEMPLATE_EDITLINK',        'Modific�t linku');

// add left / add right tooltips
define('_ADD_LEFT_TT',                'Pievienot lodzi�u kreisaj� pus�');
define('_ADD_RIGHT_TT',                'Pievienot lodzi�u labaj� pus�');

// add/edit item: new category (in dropdown box)
// category = sada�a
define('_ADD_NEWCAT',                'Jauna sada�a');

// new settings
define('_SETTINGS_PLUGINURL',        'Plugina URL');
define('_SETTINGS_MAXUPLOADSIZE',    'Max. faila izm�rs (bytes)');
define('_SETTINGS_NONMEMBERMSGS',    'At�aut s�t�t ciemi�iem');
define('_SETTINGS_PROTECTMEMNAMES',    'Aizsarg�t dal�bnieku v�rdus');

// overview screen
define('_OVERVIEW_PLUGINS',            'Administr�t pluginus...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',        'Jauna dal�bnieka re�istr�cija:');

// membermail (when not logged in)
// email = epasts
define('_MEMBERMAIL_MAIL',            'Tava epasta adrese:');

// file upload
//You do not have admin rights on any of the blogs that have the destination member on the //teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory
define('_ERROR_DISALLOWEDUPLOAD2',    'Tev nav pieejamas upload ties�bas attiec�g� dal�bnieka media katalog�');


// plugin list
define('_LISTS_INFO',                'Inform�cija');
define('_LIST_PLUGS_AUTHOR',        'Autors:');
define('_LIST_PLUGS_VER',            'Versija:');
define('_LIST_PLUGS_SITE',            'M�jas lapa');
define('_LIST_PLUGS_DESC',            'Apraksts:');
define('_LIST_PLUGS_SUBS',            'Tiek pierakst�ts sekojo�iem notikumiem:');
define('_LIST_PLUGS_UP',            'p�rvietot uz aug�u');
define('_LIST_PLUGS_DOWN',            'p�rvietot uz leju');
define('_LIST_PLUGS_UNINSTALL',        'deinstal�t');
define('_LIST_PLUGS_ADMIN',            'admin');
define('_LIST_PLUGS_OPTIONS',        'modific��anas&nbsp;opcijas');

// plugin option list
define('_LISTS_VALUE',                'Iestat�jums');

// plugin options
define('_ERROR_NOPLUGOPTIONS',        '�im pluginam pa�laik nav neviena iestat�juma');
define('_PLUGS_BACK',                'Atpaka� uz plugina aprakstu');
define('_PLUGS_SAVE',                'Saglab�t izmai�as');
define('_PLUGS_OPTIONS_UPDATED',    'Plugina opcijas saglab�tas');

define('_OVERVIEW_MANAGEMENT',        'Mened�ments');
define('_OVERVIEW_MANAGE',            'Nucleus mened�ments...');
define('_MANAGE_GENERAL',            'Galvenais mened�ments');
define('_MANAGE_SKINS',                'T�mas un veidnes');
define('_MANAGE_EXTRA',                'Extra f��as');

define('_BACKTOMANAGE',                'Atpaka� uz Nucleus mened�mentu');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',                    'Atsl�gties');
define('_LOGIN',                    'Piesl�gties');
define('_YES',                        'J�');
define('_NO',                        'N�');
define('_SUBMIT',                    'Apstiprin�t');
define('_ERROR',                    'K��da');
define('_ERRORMSG',                    'K��da!');
define('_BACK',                        'Atgriezties');
define('_NOTLOGGEDIN',                'Nav piesl�guma');
define('_LOGGEDINAS',                'Piesl�dzies k�');
define('_ADMINHOME',                'Admina sada�a');
define('_NAME',                        'V�rds/nosaukums');
define('_BACKHOME',                    'Atpaka� uz admina sada�u');
define('_BADACTION',                'Piepras�jumu nav iesp�jams izpild�t');
define('_MESSAGE',                    'Zi�ojums');
define('_HELP_TT',                    'Pal�g�!');
define('_YOURSITE',                    'Galven� lapa');


define('_POPUP_CLOSE',                'Aizv�rt logu');

define('_LOGIN_PLEASE',                'Vispirms piesl�dzies sist�mai');

// commentform
define('_COMMENTFORM_YOUARE',        'Tu esi');
define('_COMMENTFORM_SUBMIT',        'Koment�t');
define('_COMMENTFORM_COMMENT',        'Tavs koment�rs');
define('_COMMENTFORM_NAME',            'V�rds');
define('_COMMENTFORM_MAIL',            'Epasts/HTTP');
define('_COMMENTFORM_REMEMBER',        'Atcer�ties mani turpm�k');

// loginform
define('_LOGINFORM_NAME',            'Dal�bnieks');
define('_LOGINFORM_PWD',            'Parole');
define('_LOGINFORM_YOUARE',            'Piesl�dzies k�');
define('_LOGINFORM_SHARED',            'Koplieto�anas dators (piem. e-cafe)');

// member mailform
define('_MEMBERMAIL_SUBMIT',        'Nos�t�t');

// search form
define('_SEARCHFORM_SUBMIT',        'Mekl�t');

// add item form
define('_ADD_ADDTO',                'Pievienot pie');
define('_ADD_CREATENEW',            'Izveidot jaunu');
define('_ADD_BODY',                    'Teksts');
define('_ADD_TITLE',                'Virsraksts');
define('_ADD_MORE',                    'Pievienot tekstu (nav oblig�ti)');
define('_ADD_CATEGORY',                'Sada�a (J�IZV�LAS SAV�J�!)');
define('_ADD_PREVIEW',                'Apskat�t');
define('_ADD_DISABLE_COMMENTS',        'Atsl�gt koment�rus?');
define('_ADD_DRAFTNFUTURE',            'Sagataves n�kotnei');
define('_ADD_ADDITEM',                'Pievienot');
define('_ADD_ADDNOW',                'Pievienot tagad');
define('_ADD_ADDLATER',                'Pievienot v�l�k');
define('_ADD_PLACE_ON',                'Vieta');
define('_ADD_ADDDRAFT',                'Pievienot sagatav�m');
define('_ADD_NOPASTDATES',            '(pag�tnes datumi un laiki nav iesp�jami, �aj� gad�jum� tiks lietots ��br��a laiks)');
define('_ADD_BOLD_TT',                'Treknrakst�');
define('_ADD_ITALIC_TT',            'Sl�prakst�');
define('_ADD_HREF_TT',                'Haiperlinks');
define('_ADD_MEDIA_TT',                'Pievienot m�diju');
define('_ADD_PREVIEW_TT',            'Par�d�t/pasl�pt to, k� izskat�sies');
define('_ADD_CUT_TT',                'Iz�emt');
define('_ADD_COPY_TT',                'Kop�t');
define('_ADD_PASTE_TT',                'Iel�m�t (paste)');


// edit item form
define('_EDIT_ITEM',                'Modific�t');
define('_EDIT_SUBMIT',                'Modific�t');
define('_EDIT_ORIG_AUTHOR',            'Ori�in�la autors');
define('_EDIT_BACKTODRAFTS',        'Pievienot atpaka�, sagatav�s');
define('_EDIT_COMMENTSNOTE',        '(piez�me: visi iepriek� ierakst�tie koment�ri netiks pasl�pti)');


// used on delete screens
define('_DELETE_CONFIRM',            'L�dzu apstiprini dz��anu');
define('_DELETE_CONFIRM_BTN',        'Apstiprin�t');
define('_CONFIRMTXT_ITEM',            'Tu v�lies izdz�st sekojo�u zi�u:');
define('_CONFIRMTXT_COMMENT',        'Tu v�lies izdz�st sekojo�u koment�ru:');
define('_CONFIRMTXT_TEAM1',            'Tu v�lies izdz�st ');
define('_CONFIRMTXT_TEAM2',            ' no dal�bnieku komandas ');
define('_CONFIRMTXT_BLOG',            'Tiks izdz�sts sekojo�s blogs: ');
define('_WARNINGTXT_BLOGDEL',        'UZMAN�BU! Tiks izdz�sts gan pats blogs, gan visi t� koment�ri. P�rleicinies, vai tie��m to v�lies.<br />Un, l�dzu, nep�rtrauc procesu, kad notiks dz��ana!');

define('_CONFIRMTXT_MEMBER',        'Tu v�lies dz�st sekojo�a dal�bnieka datus: ');
define('_CONFIRMTXT_TEMPLATE',        'Tu v�lies dz�st veidni ');
define('_CONFIRMTXT_SKIN',            'Tu v�lies dz�st t�mu ');
define('_CONFIRMTXT_BAN',            'Tu v�lies dz�st aizliegumu sekojo�am IP adre�u apgabalam');
define('_CONFIRMTXT_CATEGORY',        'Tu v�lies dz�st sada�u ');

// some status messages
define('_DELETED_ITEM',                'Zi�a tika izdz�sta');
define('_DELETED_MEMBER',            'Dal�bnieks tika izdz�sta');
define('_DELETED_COMMENT',            'Koment�ri tika izdz�sti');
define('_DELETED_BLOG',                'Blogs tika izdz�sts');
define('_DELETED_CATEGORY',            'Sada�a tika izdz�sta');
define('_ITEM_MOVED',                'Zi�a tika veiksm�gi p�rvietota');
define('_ITEM_ADDED',                'Zi�a tika veiksm�gi pievienota');
define('_COMMENT_UPDATED',            'Koment�ri tika modific�ti');
define('_SKIN_UPDATED',                'T�mas inform�cija tika saglab�ta');
define('_TEMPLATE_UPDATED',            'Veidnes inform�cija tika saglab�ta');

// errors
define('_ERROR_COMMENT_LONGWORD',    'L�dzu nelieto koment�ros v�rdus, kas satur vair�k par 90 simboliem');
define('_ERROR_COMMENT_NOCOMMENT',    'L�dzu uzraksti ar� koment�ru');
define('_ERROR_COMMENT_NOUSERNAME',    'Hm. Izskat�s, ka neesi dal�bnieks vai ar� kaut kas nav k�rt�ba ar tavu v�rdu.');
define('_ERROR_COMMENT_TOOLONG',    'P�r�k liels koment�rs (max. 5000 simboli)');
define('_ERROR_COMMENTS_DISABLED',    '�eit nevar koment�t.');
define('_ERROR_COMMENTS_NONPUBLIC',    'Hm, nesan�ks koment�t, jo neesi ieg�jis sist�m�');
define('_ERROR_COMMENTS_MEMBERNICK','Ir jau t�ds v�rds. Izv�lies citu.');
define('_ERROR_SKIN',                'T�mas k��da');
define('_ERROR_ITEMCLOSED',            'T�ma sl�gta, koment�ri sl�gti, balsot nevar');
define('_ERROR_NOSUCHITEM',            'Nek� nav');
define('_ERROR_NOSUCHBLOG',            'Nav t�da bloga');
define('_ERROR_NOSUCHSKIN',            'Nav t�das t�mas');
define('_ERROR_NOSUCHMEMBER',        'Nav t�da dal�bnieka');
define('_ERROR_NOTONTEAM',            'Izskat�s, ka neesi komand� k� blog dal�bnieks.');
//define('_ERROR_BADDESTBLOG',        'Destination blog does not exist');
define('_ERROR_BADDESTBLOG',        '�is blogs neeksist�');
define('_ERROR_NOTONDESTTEAM',        'Nevar p�rvietot �o blogu tur, kur tu neesi pierakst�ts');
define('_ERROR_NOEMPTYITEMS',        'Neaizpild�tas lietas netiks pievienotas!');
define('_ERROR_BADMAILADDRESS',        'Nepareiza epasta adrese');
define('_ERROR_BADNOTIFY',            'Epasta adrese(s) nav pareiza(s)');
define('_ERROR_BADNAME',            'V�rds nepareizs (at�auti burti a-z, cipari 0-9 un bez atstarp�m s�kum�/beig�s)');
define('_ERROR_NICKNAMEINUSE',        'K�dam citam ir ��ds v�rds');
define('_ERROR_PASSWORDMISMATCH',    'Parol�m j�sakr�t');
define('_ERROR_PASSWORDTOOSHORT',    'Parolei j�b�t ar minimums 6 simboliem');
define('_ERROR_PASSWORDMISSING',    'Parole nedr�kst b�t tuk�a');
define('_ERROR_REALNAMEMISSING',    'Hm, kautkas nav k�rt�b� ar v�rdu');
define('_ERROR_ATLEASTONEADMIN',    'Vienm�r j�b�t vismaz vienam super-adminam, kas var administr�t.');
define('_ERROR_ATLEASTONEBLOGADMIN','Darot ��di, iesp�jams blog sist�ma vairs neb�s administr�jama. P�rliecinies, lai vienm�r b�tu vismaz viens admins.');
define('_ERROR_ALREADYONTEAM',        'Nevar pievienot jau eso�us dal�bniekus');
define('_ERROR_BADSHORTBLOGNAME',    '�ss tava bloga nosaukums (ar burtiem a-z, cipariem 0-9 un bez atstarp�m s�kum�/beig�s');
define('_ERROR_DUPSHORTBLOGNAME',    'Ir jau t�ds blogs');
define('_ERROR_UPDATEFILE',            'Atjauno�anas fails nepieejams. Vai failam var piek��t (pam��ini uzlikt chmod 666). Ieteicams lietot pilnu ce�u (piem. /sisteemas/celshs/uz/nucleus/)');
//'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',            '�is ir galvenais blogs, to nevar dz�st');
define('_ERROR_DELETEMEMBER',        'Nevar dz�st �o dal�bnieku, iesp�jams t�p�c, ka vi�� ir k�du rakstu vai koment�ru autors');
define('_ERROR_BADTEMPLATENAME',    'Nepareizs sagataves nosaukums, at�auti burti a-z, cipari 0-9 un bez atstarp�m');
define('_ERROR_DUPTEMPLATENAME',    'Ir jau t�da sagatave');
define('_ERROR_BADSKINNAME',        'Nepareizs t�mas nosaukums (at�auti burti a-z, cipari 0-9 un bez atstarp�m)');
define('_ERROR_DUPSKINNAME',        'Ir jau t�ma ar t�du nosaukumu');
define('_ERROR_DEFAULTSKIN',        'T�mai "default" j�b�t un tur neko nevar dar�t');
define('_ERROR_SKINDEFDELETE',        'Nevar izdz�st �o t�mu, jo t� ir galven� sekojo�am blogam: ');
define('_ERROR_DISALLOWED',            '��das darb�bas ir aizliegtas');
define('_ERROR_DELETEBAN',            'K��da, dz��ot aizliegumu (nav t�da aizlieguma)');
define('_ERROR_ADDBAN',                'K��da. ��ds aizliegums var netikt pievienots visos blogos.');
define('_ERROR_BADACTION',            'Netiklas..em.. darb�bas sod�mas p�c krimin�llikuma');
define('_ERROR_MEMBERMAILDISABLED',    'Dal�bnieks-dal�bniekam zi�u s�t��ana aizliegta');
define('_ERROR_MEMBERCREATEDISABLED','Dal�bnieku pievieno�ana atsl�gta');
define('_ERROR_INCORRECTEMAIL',        'Nepareiza epasta adrese');
define('_ERROR_VOTEDBEFORE',        'Par �o jau esi balsojis');
define('_ERROR_BANNED1',            'Diem��l man tevi j�apb�dina, jo tava IP adrese ir iek�auta aizliegto IP adre�u apgabal� ');
define('_ERROR_BANNED2',            ' . Tu rakst�ji: \'');
define('_ERROR_BANNED3',            '\'');
define('_ERROR_LOGINNEEDED',        'Piesl�dzies sist�mai, lai veiktu ��du darb�bu');
define('_ERROR_CONNECT',            'Piesl�g�an�s k��da');
define('_ERROR_FILE_TOO_BIG',        'Fails ir p�r�k liels!');
define('_ERROR_BADFILETYPE',        '��da form�ta faili �eit ir aizliegti');
define('_ERROR_BADREQUEST',            'Fuj! Slikti dar�ji.');
define('_ERROR_DISALLOWEDUPLOAD',    'Nevar atrast tevi m�su komand�. Nu, l�dz ar to tev nesan�ks uzlikt failus');
define('_ERROR_BADPERMISSIONS',        'Nepareizi uzst�d�tas failu/direktoriju at�aujas');
define('_ERROR_UPLOADMOVEP',        'K��da dz��ot failu');
define('_ERROR_UPLOADCOPY',            'K��da kop�jot failu');
define('_ERROR_UPLOADDUPLICATE',    'Fails ar ��du nosaukumu jau eksist�. Pirms uzlik�anas to p�rsauc.');
define('_ERROR_LOGINDISALLOWED',    'Piedod, tev nav dota at�auja �eit �rd�ties k� adminam. Bet vismaz vari padarboties k� dal�bnieks. Uzraksti kaut ko labu');
define('_ERROR_DBCONNECT',            'Hm, mySQL serveris nok�ries? Piezvani adminam');
define('_ERROR_DBSELECT',            'Hm, probl�ma ar blogu datu b�zi.');
define('_ERROR_NOSUCHLANGUAGE',        'Hm, probl�ma ar valodu failu (nav atrasts)');
define('_ERROR_NOSUCHCATEGORY',        'Hm, sada�a netika atrasta');
define('_ERROR_DELETELASTCATEGORY',    'J�b�t vismaz vienai sada�ai');
define('_ERROR_DELETEDEFCATEGORY',    'Pamatsada�u nedr�kst dz�st');
define('_ERROR_BADCATEGORYNAME',    'Slikts nosaukums priek� sada�as');
define('_ERROR_DUPCATEGORYNAME',    'Ir, ir jau t�da sada�a');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',            'Uzman�bu: �is uzst�d�jums neizskat�s p�c direktorijas!');
define('_WARNING_NOTREADABLE',        'Uzman�bu: �� direktorija nav redzama, ar domu - nevar nolas�t!');
define('_WARNING_NOTWRITABLE',        'Uzman�bu: �aj� direktorij� neko nevar saglab�t!');

// media and upload
define('_MEDIA_UPLOADLINK',            'Pievienot jaunu failu');
define('_MEDIA_MODIFIED',            'izmai�as');
define('_MEDIA_FILENAME',            'nosaukums');
define('_MEDIA_DIMENSIONS',            'izm�ri');
define('_MEDIA_INLINE',                'Iek�aut lap�');
define('_MEDIA_POPUP',                'Atsevi��s logs');
define('_UPLOAD_TITLE',                'Izv�l�ties failu');
define('_UPLOAD_MSG',                'Izv�lies failu un spied \'Uzlikt\' pogu.');
define('_UPLOAD_BUTTON',            'Uzlikt');

// some status messages
define('_MSG_ACCOUNTCREATED',        'Konts izveidots, parole nos�t�ta pa epastu');
define('_MSG_PASSWORDSENT',            'Parole tika nos�t�ta uz attiec�go epasta adresi.');
define('_MSG_LOGINAGAIN',            'Tev j�piesl�dzas v�leiz, jo inform�cija par tevi tika izmain�ta');
define('_MSG_SETTINGSCHANGED',        'Uzst�d�jumi izmain�ti');
define('_MSG_ADMINCHANGED',            'Admins nomain�ts');
define('_MSG_NEWBLOG',                'Jauns blogs izveidots');
define('_MSG_ACTIONLOGCLEARED',        'Statistika dz�sta');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',        'Aizliegta r�c�ba: ');
define('_ACTIONLOG_PWDREMINDERSENT','Jaun� parole nos�t�ta dal�bniekam ');
define('_ACTIONLOG_TITLE',            'Statistika');
define('_ACTIONLOG_CLEAR_TITLE',    'Dz�st statistiku');
define('_ACTIONLOG_CLEAR_TEXT',        'Dz�st statistiku t�l�t');

// team management
define('_TEAM_TITLE',                'Mened��t bloga komandu ');
define('_TEAM_CURRENT',                '\'Teko��\' komanda');
define('_TEAM_ADDNEW',                'Pievienot komandai jaunu dal�bnieku');
define('_TEAM_CHOOSEMEMBER',        'Izv�l�ties dal�bnieku');
define('_TEAM_ADMIN',                'Admina ties�bas? ');
define('_TEAM_ADD',                    'Pievienot komandai');
define('_TEAM_ADD_BTN',                'Pievienot komandai');

// blogsettings
define('_EBLOG_TITLE',                'Bloga modific��ana');
define('_EBLOG_TEAM_TITLE',            'Modific�t komandu');
define('_EBLOG_TEAM_TEXT',            'Spied �eit, lai modific�tu komandu...');
define('_EBLOG_SETTINGS_TITLE',        'Bloga uzst�d�jumi');
define('_EBLOG_NAME',                'Bloga nosaukums');
define('_EBLOG_SHORTNAME',            '�ss bloga nosaukums');
define('_EBLOG_SHORTNAME_EXTRA',    '<br />(j�satur burtus a-z un bez atstarp�m)');
define('_EBLOG_DESC',                'Bloga apraksts');
define('_EBLOG_URL',                'URL');
define('_EBLOG_DEFSKIN',            'Pamatt�ma');
define('_EBLOG_DEFCAT',                'Pamatsada�a');
define('_EBLOG_LINEBREAKS',            'Konvert�t rindu p�rnesumus jaun� rind�');
define('_EBLOG_DISABLECOMMENTS',    'Koment�ri at�auti?<br /><small>(Atsl�dzot koment�rus, koment��ana neb�s iesp�jama.)</small>');
define('_EBLOG_ANONYMOUS',            'At�aut koment�t ciemi�iem?');
define('_EBLOG_NOTIFY',                'Apzi�o�anas adrese(s) (vair�kus atdal�t ar ;)');
define('_EBLOG_NOTIFY_ON',            'Apzi�o�ana iesl�gta');
define('_EBLOG_NOTIFY_COMMENT',        'Apzi�ot par jauniem koment�riem');
define('_EBLOG_NOTIFY_KARMA',        'Apzi�ot par balsojumiem');
define('_EBLOG_NOTIFY_ITEM',        'Apzi�ot par jauniem rakstiem');
define('_EBLOG_PING',                'Nos�t�t ping uz Weblogs.com p�c izmai�u veik�anas Nucleus sist�m�?');
define('_EBLOG_MAXCOMMENTS',        'Maksim�lais at�autais koment�ru skaits');
define('_EBLOG_UPDATE',                'Atjauno�anas fails');
define('_EBLOG_OFFSET',                'Laika nob�de');
define('_EBLOG_STIME',                'Pa�reiz�jais servera laiks');
define('_EBLOG_BTIME',                'Pa�reiz�jais bloga laiks');
define('_EBLOG_CHANGE',                'Izmain�t uzst�d�jumus');
define('_EBLOG_CHANGE_BTN',            'Izmain�t uzst�d�jumus');
define('_EBLOG_ADMIN',                'Bloga admins');
define('_EBLOG_ADMIN_MSG',            'tev pie��irtas admina ties�bas');
define('_EBLOG_CREATE_TITLE',        'Izveidot jaunu blogu');
define('_EBLOG_CREATE_TEXT',        'Aizpildi formu, lai izveidotu jaunu blogu. <br /><br /> <b>Piez�me:</b> �eit atrodami tikai nepiecie�am�kie uzst�d�jumi. Ekstra uzst�d�jumi atrodami bloga uzst�d�jumu sada��.');
define('_EBLOG_CREATE',                'Izveidot!');
define('_EBLOG_CREATE_BTN',            'Izveidot blogu');
define('_EBLOG_CAT_TITLE',            'Sada�as');
define('_EBLOG_CAT_NAME',            'Nosaukums');
define('_EBLOG_CAT_DESC',            'Apraksts');
define('_EBLOG_CAT_CREATE',            'Jaunas sada�as izveido�ana');
define('_EBLOG_CAT_UPDATE',            'Atjaunin�t sada�u');
define('_EBLOG_CAT_UPDATE_BTN',        'Atjaunin�t sada�u');

// templates
define('_TEMPLATE_TITLE',            'Modific�t veidnes');
define('_TEMPLATE_AVAILABLE_TITLE',    'Pieejam�s veidnes');
define('_TEMPLATE_NEW_TITLE',        'Jauna veidne');
define('_TEMPLATE_NAME',            'Veidnes nosaukums');
define('_TEMPLATE_DESC',            'Apraksts');
define('_TEMPLATE_CREATE',            'Izveidot veidni');
define('_TEMPLATE_CREATE_BTN',        'Izveidot veidni');
define('_TEMPLATE_EDIT_TITLE',        'Modific�t veidni');
define('_TEMPLATE_BACK',            'Atpaka� uz veid�u aprakstu');
define('_TEMPLATE_EDIT_MSG',        'Vair�kus uzst�d�jumus dr�kst atst�t tuk�us.');
define('_TEMPLATE_SETTINGS',        'Veidnes uzst�d�jumi');
define('_TEMPLATE_ITEMS',            'Raksti');
define('_TEMPLATE_ITEMHEADER',        'Raksta auk�da�a');
define('_TEMPLATE_ITEMBODY',        'Raksta vidusda�a');
define('_TEMPLATE_ITEMFOOTER',        'Raksta apak�da�a');
define('_TEMPLATE_MORELINK',        'Nor�de uz pilnu rakstu');
define('_TEMPLATE_NEW',                'Nor�de uz jaunu rakstu');
define('_TEMPLATE_COMMENTS_ANY',    'Koment�ri (ja ir)');
define('_TEMPLATE_CHEADER',            'Koment�ru auk�da�a');
define('_TEMPLATE_CBODY',            'Koment�ru vidusda�a');
define('_TEMPLATE_CFOOTER',            'Koment�ru apak�da�a');
define('_TEMPLATE_CONE',            'Viens koment�rs');
define('_TEMPLATE_CMANY',            'Divi (vai vair�k) koment�ri');
define('_TEMPLATE_CMORE',            'Las�t vair�k koment�rus');
define('_TEMPLATE_CMEXTRA',            'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',    'Ja nav koment�ru');
define('_TEMPLATE_CNONE',            'Koment�ru nav');
define('_TEMPLATE_COMMENTS_TOOMUCH','Ja ir p�r�k daudz koment�ru');
define('_TEMPLATE_CTOOMUCH',        'P�r�k daudz koment�ru');
define('_TEMPLATE_ARCHIVELIST',        'K� izskat�s arh�vi');
define('_TEMPLATE_AHEADER',            'Arh�va aug�da�a');
define('_TEMPLATE_AITEM',            'Arh�va vidusda�a');
define('_TEMPLATE_AFOOTER',            'Arh�va apak�da�a');
define('_TEMPLATE_DATETIME',        'Datums un laiks');
define('_TEMPLATE_DHEADER',            'Datuma aug�da�a');
define('_TEMPLATE_DFOOTER',            'Datuma apak�da�a');
define('_TEMPLATE_DFORMAT',            'Datuma form�ts');
define('_TEMPLATE_TFORMAT',            'Laika form�ts');
define('_TEMPLATE_LOCALE',            'Lok�lais uzst�d�jums');
define('_TEMPLATE_IMAGE',            'Izleco�ie att�li');
define('_TEMPLATE_PCODE',            'Kods izleco�ajam linkam');
define('_TEMPLATE_ICODE',            'Lap� iek�aujam� att�la kods');
define('_TEMPLATE_MCODE',            'M�dija objekta kods');
define('_TEMPLATE_SEARCH',            'Mekl��anas sist�ma');
define('_TEMPLATE_SHIGHLIGHT',        'V�rdu izcel�ana');
define('_TEMPLATE_SNOTFOUND',        'Ja nekas nav atrasts');
define('_TEMPLATE_UPDATE',            'Izmai�u veik�ana');
define('_TEMPLATE_UPDATE_BTN',        'Saglab�t izmai�as veidn�');
define('_TEMPLATE_RESET_BTN',        'Noklus�t�s v�rt�bas');
define('_TEMPLATE_CATEGORYLIST',    'Sada�u saraksti');
define('_TEMPLATE_CATHEADER',        'Sada�u saraksta aug�da�a');
define('_TEMPLATE_CATITEM',            'Sada�u saraksta vidusda�a');
define('_TEMPLATE_CATFOOTER',        'Sada�u saraksta apak�da�a');

// skins
define('_SKIN_EDIT_TITLE',            'Modific�t t�mas');
define('_SKIN_AVAILABLE_TITLE',        'Pieejam�s t�mas');
define('_SKIN_NEW_TITLE',            'Jauna t�ma');
define('_SKIN_NAME',                'Nosaukums');
define('_SKIN_DESC',                'Apraksts');
define('_SKIN_TYPE',                '"Content Type"');
define('_SKIN_CREATE',                'Izveido�ana');
define('_SKIN_CREATE_BTN',            'Izveidot t�mu');
define('_SKIN_EDITONE_TITLE',        'Modific�t t�mu');
define('_SKIN_BACK',                'Atpaka� pie t�mu apraksta');
define('_SKIN_PARTS_TITLE',            'Katras lapas t�ma');
define('_SKIN_PARTS_MSG',            'Ne visi uzst�d�jumi ir oblig�ti. Nevajadz�gos var atst�t tuk�us. T�mas iesp�jams main�t ��d�m sada��m:');
define('_SKIN_PART_MAIN',            'Galven� lapa');
define('_SKIN_PART_ITEM',            'Raksti');
define('_SKIN_PART_ALIST',            'Arh�vu saraksts');
define('_SKIN_PART_ARCHIVE',        'Arh�vs');
define('_SKIN_PART_SEARCH',            'Mekl��ana');
define('_SKIN_PART_ERROR',            'K��du pazi�ojumi');
define('_SKIN_PART_MEMBER',            'Inform�cija par dal�bniekiem');
define('_SKIN_PART_POPUP',            'Izleco�ie att�li');
define('_SKIN_GENSETTINGS_TITLE',    'Infom�cija par t�mu');
define('_SKIN_CHANGE',                'Izmai�as');
define('_SKIN_CHANGE_BTN',            'Saglab�t izmai�as');
define('_SKIN_UPDATE_BTN',            'Saglab�t izmai�as');
define('_SKIN_RESET_BTN',            'Noklus�tie uzst�d�jumi');
define('_SKIN_EDITPART_TITLE',        'Modific�t t�mu');
define('_SKIN_GOBACK',                'Atpaka�');
define('_SKIN_ALLOWEDVARS',            'Pieejamie uzst�d�jumi (s�k�ka inform�cija, uzklik��inot):');

// global settings
define('_SETTINGS_TITLE',            'Galvenie uzst�d�jumi');
define('_SETTINGS_SUB_GENERAL',        'Galvenie uzst�d�jumi');
define('_SETTINGS_DEFBLOG',            'Prim�rais blogs');
define('_SETTINGS_ADMINMAIL',        'Admina epasta adrese');
define('_SETTINGS_SITENAME',        'M�jas lapas nosaukums');
define('_SETTINGS_SITEURL',            'Lapas URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_ADMINURL',        'Administr��anas URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_DIRS',            'Nucleus pilna atra�an�s vieta sist�m�');
define('_SETTINGS_MEDIADIR',        'M�diju direktorija');
define('_SETTINGS_SEECONFIGPHP',    '(skat. config.php)');
define('_SETTINGS_MEDIAURL',        'M�diju URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_ALLOWUPLOAD',        'At�aut likt failus?');
define('_SETTINGS_ALLOWUPLOADTYPES','At�autie failu form�ti');
define('_SETTINGS_CHANGELOGIN',        'At�aut dal�bniekiem main�t v�rdu/paroli');
define('_SETTINGS_COOKIES_TITLE',    'Cookie uzst�d�jumi');
define('_SETTINGS_COOKIELIFE',        'Sist�mas Cookie ilgums');
define('_SETTINGS_COOKIESESSION',    'tik pat, cik sesija');
define('_SETTINGS_COOKIEMONTH',        'viens m�nesis');
define('_SETTINGS_COOKIEPATH',        'Cookie ce�� (advanced)');
define('_SETTINGS_COOKIEDOMAIN',    'Cookie dom�ns (advanced)');
define('_SETTINGS_COOKIESECURE',    'Dro�ie Cookie (advanced)');
define('_SETTINGS_LASTVISIT',        'Saglab�t p�d�j� apmekl�juma Cookies');
define('_SETTINGS_ALLOWCREATE',        'At�aut visiem apmekl�t�jiem re�istr�ties');
define('_SETTINGS_NEWLOGIN',        'At�aut piesl�gties k� administratoram uzreiz p�c re�istr��an�s');
define('_SETTINGS_NEWLOGIN2',        '(tikai jaunizveidotiem)');
define('_SETTINGS_MEMBERMSGS',        'At�aut izmantot dal�bnieks-dal�bniekam servisu');
define('_SETTINGS_LANGUAGE',        'Valoda');
define('_SETTINGS_DISABLESITE',        'Apst�din�t sist�mu');
define('_SETTINGS_DBLOGIN',            'mySQL DB inform�cija');
define('_SETTINGS_UPDATE',            'Uzst�d�jumu saglab��ana');
define('_SETTINGS_UPDATE_BTN',        'Saglab�t izmai�as');
define('_SETTINGS_DISABLEJS',        'Atsl�gt JavaScript paneli');
define('_SETTINGS_MEDIA',            'Mediju/Failu uzst�d�jumi');
define('_SETTINGS_MEDIAPREFIX',        'Failu nosaukumu s�kumu likt teko�o datumu');
define('_SETTINGS_MEMBERS',            'Dal�bnieku uzst�d�jumi');

// bans
define('_BAN_TITLE',                'Aizliegumi: ');
define('_BAN_NONE',                    '�im blogam nav IP adre�u aizliegumu');
define('_BAN_NEW_TITLE',            'Pievienot jaunu aizliegumu');
define('_BAN_NEW_TEXT',                'Pievienot aizliegumu(s)');
define('_BAN_REMOVE_TITLE',            'No�emt aizliegumu(s)');
define('_BAN_IPRANGE',                'IP adre�u apgabals');
define('_BAN_BLOGS',                'K�diem blogiem?');
define('_BAN_DELETE_TITLE',            'Dz�st aizliegumu');
define('_BAN_ALLBLOGS',                'Visi blogi, kur� esi admins.');
define('_BAN_REMOVED_TITLE',        'Aizliegums no�emts');
define('_BAN_REMOVED_TEXT',            'Aizliegums no�emts no sekojo�iem blogiem:');
define('_BAN_ADD_TITLE',            'Pievienot aizliegumu');
define('_BAN_IPRANGE_TEXT',            'Izv�lies blo��jamo IP adre�u apgabalu. Jo maz�k ciparu IP adres�, jo liel�ks apgabals tiks blo��ts.');
define('_BAN_BLOGS_TEXT',            'Var blo��t pieeju vienam noteiktam blogam vai ar� visiem blogiem, kur� esi administrators.');
define('_BAN_REASON_TITLE',            'Iemesls');
define('_BAN_REASON_TEXT',            'Pievieno iemeslu, k�p�c dal�bniekam tiek blo��ta pieeja. Maksimums 256 simboli.');
define('_BAN_ADD_BTN',                'Pievienot aizliegumu');

// LOGIN screen
define('_LOGIN_MESSAGE',            'Zi�ojums');
define('_LOGIN_NAME',                'V�rds/nosaukums');
define('_LOGIN_PASSWORD',            'Parole');
define('_LOGIN_SHARED',                _LOGINFORM_SHARED);
define('_LOGIN_FORGOT',                'Aizmirs�s parole?');

// membermanagement
define('_MEMBERS_TITLE',            'Dal�bnieku mened�ments');
define('_MEMBERS_CURRENT',            'Re�istr�tie dal�bnieki');
define('_MEMBERS_NEW',                'Jauns dal�bnieks');
define('_MEMBERS_DISPLAY',            'Atspogu�ojamais v�rds');
define('_MEMBERS_DISPLAY_INFO',        '(segv�rds, ar kuru piesl�dzas sist�mai)');
define('_MEMBERS_REALNAME',            'Pilnais v�rds');
define('_MEMBERS_PWD',                'Parole');
define('_MEMBERS_REPPWD',            'Atk�rtot paroli');
define('_MEMBERS_EMAIL',            'Epasta adrese');
define('_MEMBERS_EMAIL_EDIT',        '(Mainot epasta adresi, jaun� parole<br /> autom�tiski nos�t�sies uz jauno adresi)');
define('_MEMBERS_URL',                'M�jas lapa (URL)');
define('_MEMBERS_SUPERADMIN',        'Admina ties�bas');
define('_MEMBERS_CANLOGIN',            'Var piesl�gties adminu sada�ai');
define('_MEMBERS_NOTES',            'Piez�mes');
define('_MEMBERS_NEW_BTN',            'Pievienot');
define('_MEMBERS_EDIT',                'Modific�t dal�bnieka inform�ciju');
define('_MEMBERS_EDIT_BTN',            'Main�t uzst�d�jumus');
define('_MEMBERS_BACKTOOVERVIEW',    'Atpaka� uz Dal�bnieku inform�ciju');
define('_MEMBERS_LOCALE',            'Valoda');
define('_MEMBERS_USESITELANG',        '- sist�mas pamatvaloda -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',        'apmekl�t saitu');
define('_BLOGLIST_ADD',                'Pievienot');
define('_BLOGLIST_TT_ADD',            'Pievienot jaunu rakstu �im blogam');
define('_BLOGLIST_EDIT',            'Modific�t/dz�st');
define('_BLOGLIST_TT_EDIT',            '');
define('_BLOGLIST_BMLET',            'Noder�gas saites');
define('_BLOGLIST_TT_BMLET',        '');
define('_BLOGLIST_SETTINGS',        'Uzst�d�jumi');
define('_BLOGLIST_TT_SETTINGS',        'Modific�t uzst�d�jumus vai inform�ciju par komandu');
define('_BLOGLIST_BANS',            'Aizliegumi');
define('_BLOGLIST_TT_BANS',            'Skat�t/pievienot/dz�st blo��t�s IP');
define('_BLOGLIST_DELETE',            'Dz�st visu');
define('_BLOGLIST_TT_DELETE',        'Dz�st �o blogu');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',            'Tavi blogi');
define('_OVERVIEW_YRDRAFTS',        'Tavas sagataves');
define('_OVERVIEW_YRSETTINGS',        'Tavi uzst�d�jumi');
define('_OVERVIEW_GSETTINGS',        'Galvenie uzst�d�jumi');
define('_OVERVIEW_NOBLOGS',            'Tu neesi nevien� blogu komand�');
define('_OVERVIEW_NODRAFTS',        'Sagatavju nav');
define('_OVERVIEW_EDITSETTINGS',    'Modific�t savus uzst�d�jumus...');
define('_OVERVIEW_BROWSEITEMS',        'Skat�ties savus rakstus...');
define('_OVERVIEW_BROWSECOMM',        'Skat�ties savus koment�rus...');
define('_OVERVIEW_VIEWLOG',            'Skat�ties statistiku...');
define('_OVERVIEW_MEMBERS',            'Administr�t dal�bniekus...');
define('_OVERVIEW_NEWLOG',            'Izveidot jaunu blogu...');
define('_OVERVIEW_SETTINGS',        'Modific�t uzst�d�jumus...');
define('_OVERVIEW_TEMPLATES',        'Modific�t veidnes...');
define('_OVERVIEW_SKINS',            'Modific�t t�mas...');
define('_OVERVIEW_BACKUP',            'Rezerves kopija/Atjauno�ana...');

// ITEMLIST
define('_ITEMLIST_BLOG',            'Kas atrodams blog�, ar nosaukumu');
define('_ITEMLIST_YOUR',            'Tavi raksti');

// Comments
define('_COMMENTS',                    'Koment�ri');
define('_NOCOMMENTS',                'Nav koment�ru');
define('_COMMENTS_YOUR',            'Tavi koment�ri');
define('_NOCOMMENTS_YOUR',            'Neesi rakst�jis koment�rus');

// LISTS (general)
define('_LISTS_NOMORE',                'Vair�k rezult�tu nav vai rezult�tu nav visp�r');
define('_LISTS_PREV',                'Iepriek��jie');
define('_LISTS_NEXT',                'N�kamie');
define('_LISTS_SEARCH',                'Mekl�t');
define('_LISTS_CHANGE',                'Modific�t');
define('_LISTS_PERPAGE',            'rezult�ti/lap�');
define('_LISTS_ACTIONS',            'Darb�bas');
define('_LISTS_DELETE',                'Dz�st');
define('_LISTS_EDIT',                'Modific�t');
define('_LISTS_MOVE',                'P�rvietot');
define('_LISTS_CLONE',                'Klon�t');
define('_LISTS_TITLE',                'Virsraksts');
define('_LISTS_BLOG',                'Blogs');
define('_LISTS_NAME',                'Nosaukums');
define('_LISTS_DESC',                'Apraksts');
define('_LISTS_TIME',                'Laiks');
define('_LISTS_COMMENTS',            'Koment�ri');
define('_LISTS_TYPE',                'Form�ts');


// member list
define('_LIST_MEMBER_NAME',            'Public�jamais v�rds');
define('_LIST_MEMBER_RNAME',        '�stais v�rds');
define('_LIST_MEMBER_ADMIN',        'Super-admins? ');
define('_LIST_MEMBER_LOGIN',        'Var piesl�gties? ');
define('_LIST_MEMBER_URL',            'M�jas lapa');

// banlist
define('_LIST_BAN_IPRANGE',            'IP apgabals');
define('_LIST_BAN_REASON',            'Iemesls');

// actionlist
define('_LIST_ACTION_MSG',            'Zi�ojums');

// commentlist
define('_LIST_COMMENT_BANIP',        'Blo��t IP');
define('_LIST_COMMENT_WHO',            'Autors');
define('_LIST_COMMENT',                'Koment�ri');
define('_LIST_COMMENT_HOST',        'Hosts');

// itemlist
define('_LIST_ITEM_INFO',            'Info');
define('_LIST_ITEM_CONTENT',        'Virsraksts un teksts');


// teamlist
define('_LIST_TEAM_ADMIN',            'Admins ');
define('_LIST_TEAM_CHADMIN',        'Mainam adminu');

// edit comments
define('_EDITC_TITLE',                'Modific�t koment�rus');
define('_EDITC_WHO',                'Autors');
define('_EDITC_HOST',                'No kurienes?');
define('_EDITC_WHEN',                'Kad?');
define('_EDITC_TEXT',                'Teksts');
define('_EDITC_EDIT',                'Modific�t koment�ru');
define('_EDITC_MEMBER',                'dal�bnieks');
define('_EDITC_NONMEMBER',            'ciemi��');

// move item
define('_MOVE_TITLE',                'Uz kuru blogu?');
define('_MOVE_BTN',                    'P�rvietot...');
