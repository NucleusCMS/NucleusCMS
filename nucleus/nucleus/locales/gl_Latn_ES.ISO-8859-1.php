<?
// Galician Nucleus Language File
// 
// Author: Xes Garc�a Santamarina (xes@afragamaldita.net)
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
define('_MEDIA_VIEW',				'ver');
define('_MEDIA_VIEW_TT',			'Ver arquivo (�brese nunha nova fiestra)');
define('_MEDIA_FILTER_APPLY',		'Aplicar filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Subir a...');
define('_MEDIA_UPLOAD_NEW',			'Subir arquivo novo...');
define('_MEDIA_COLLECTION_SELECT',	'Seleccionar');
define('_MEDIA_COLLECTION_TT',		'Cambiar a esta categor�a');
define('_MEDIA_COLLECTION_LABEL',	'Colecci�n actual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinear � esquerda');
define('_ADD_ALIGNRIGHT_TT',		'Alinear � derieta');
define('_ADD_ALIGNCENTER_TT',		'Alinear � centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir en b�squedas');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Erro � subir');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permite introducir entradas no pasado');
define('_ADD_CHANGEDATE',			'Actualizar data e hora');
define('_BMLET_CHANGEDATE',			'Actualizar data e hora');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/exportar pel...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usa-lo directorio de peles');
define('_SKIN_INCLUDE_MODE',		'Incluir modo');
define('_SKIN_INCLUDE_PREFIX',		'Incluir prefixo');

// global settings
define('_SETTINGS_BASESKIN',		'Pel base');
define('_SETTINGS_SKINSURL',		'URL de peles');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Non se pode move-la categor�a por defecto');
define('_ERROR_MOVETOSELF',			'Non se pode move-la categor�a (a bit�cora de destino � a mesma que a de orixen)');
define('_MOVECAT_TITLE',			'Selecciona-la bit�cora � que move-la categor�a');
define('_MOVECAT_BTN',				'Mover categor�a');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Atractivo');

// Batch operations
define('_BATCH_NOSELECTION',		'Nada seleccionado sobre o que se poida realizar unha acci�n');
define('_BATCH_ITEMS',				'Operaci�n de lotes sobre elementos');
define('_BATCH_CATEGORIES',			'Operaci�n de lotes sobre categor�as');
define('_BATCH_MEMBERS',			'Operaci�n de lotes sobre membros');
define('_BATCH_TEAM',				'Operaci�n de lotes sobre membros de equipos');
define('_BATCH_COMMENTS',			'Operaci�n de lotes sobre comentarios');
define('_BATCH_UNKNOWN',			'Operaci�n de lotes desconocida: ');
define('_BATCH_EXECUTING',			'Executando');
define('_BATCH_ONCATEGORY',			'sobre a categor�a');
define('_BATCH_ONITEM',				'sobre o elemento');
define('_BATCH_ONCOMMENT',			'sobre o comentario');
define('_BATCH_ONMEMBER',			'sobre o membro');
define('_BATCH_ONTEAM',				'sobre o membro de equipo');
define('_BATCH_SUCCESS',			'�Sin problemas!');
define('_BATCH_DONE',				'�Feito!');
define('_BATCH_DELETE_CONFIRM',		'Confirma-la eliminaci�n do lote');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirma-la eliminaci�n do lote');
define('_BATCH_SELECTALL',			'seleccionar todo');
define('_BATCH_DESELECTALL',		'deseleccionar todo');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Eliminar');
define('_BATCH_ITEM_MOVE',			'Mover');
define('_BATCH_MEMBER_DELETE',		'Eliminar');
define('_BATCH_MEMBER_SET_ADM',		'Dar dereitos de administraci�n');
define('_BATCH_MEMBER_UNSET_ADM',	'Quitar dereitos de administraci�n');
define('_BATCH_TEAM_DELETE',		'Borrar do equipo');
define('_BATCH_TEAM_SET_ADM',		'Dar dereitos de administraci�n');
define('_BATCH_TEAM_UNSET_ADM',		'Quitar dereitos de administraci�n');
define('_BATCH_CAT_DELETE',			'Eliminar');
define('_BATCH_CAT_MOVE',			'Mover a outra bit�cora');
define('_BATCH_COMMENT_DELETE',		'Eliminar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Introducir novo elemento...');
define('_ADD_PLUGIN_EXTRAS',		'Opci�ns extra de plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Non se pode crear unha nova categor�a');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin necesita unha versi�n mais recente de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Voltar a preferencias de bit�cora');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar peles/plantillas seleccionadas');
define('_SKINIE_LOCAL',				'Importar dende un arquivo local:');
define('_SKINIE_NOCANDIDATES',		'Non se atoparon candidatos para importar no directorio de peles');
define('_SKINIE_FROMURL',			'Importar desde URL:');
define('_SKINIE_EXPORT_INTRO',		'Seleccionar abaixo as peles e plantillas a exportar');
define('_SKINIE_EXPORT_SKINS',		'Peles');
define('_SKINIE_EXPORT_TEMPLATES',	'Plantillas');
define('_SKINIE_EXPORT_EXTRA',		'Informaci�n Extra');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobreescribe peeles que xa existan (ver conflictos de nome)');
define('_SKINIE_CONFIRM_IMPORT',	'S�, quero importar �sto');
define('_SKINIE_CONFIRM_TITLE',		'Sobre importar peles e plantillas');
define('_SKINIE_INFO_SKINS',		'Peles en arquivo:');
define('_SKINIE_INFO_TEMPLATES',	'Plantillas en arquivo:');
define('_SKINIE_INFO_GENERAL',		'Informaci�n:');
define('_SKINIE_INFO_SKINCLASH',	'nome de pel conflictivo:');
define('_SKINIE_INFO_TEMPLCLASH',	'nome de plantilla conflictivo:');
define('_SKINIE_INFO_IMPORTEDSKINS','Peles importadas:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Plantillas importadas:');
define('_SKINIE_DONE',				'Importaci�n feita');

define('_AND',						'y');
define('_OR',						'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo valeiro (facer clic para editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'incl�e modo:');
define('_LIST_SKINS_INCPREFIX',		'incl�e prefixo:');
define('_LIST_SKINS_DEFINED',		'Partes definidas:');

// backup
define('_BACKUPS_TITLE',			'gardar / Restaurar');
define('_BACKUP_TITLE',				'gardar');
define('_BACKUP_INTRO',				'Facer clic sobre o srguinte bot�n para crear unha copia de seguridade da base de datos de Nucleus. Pedir�selle que garde un arquivo de seguridade. Gardeo nun sitio seguro.');
define('_BACKUP_ZIP_YES',			'Intente usala compresi�n');
define('_BACKUP_ZIP_NO',			'Non use compresi�n');
define('_BACKUP_BTN',				'Crear copia de seguridade');
define('_BACKUP_NOTE',				'<b>Nota:</b> S� os contidos da base de datos se gardan na copia de seguridade. Arquivos de medios, im�xes e preferencias de config.php <b>NON</b> se incl�en na copia de seguridade.');
define('_RESTORE_TITLE',			'Restaurar');
define('_RESTORE_NOTE',				'<b>AVISO:</b> Restaurar dende unha copia de seguridade <b>BORRAR�</b> t�dolos datos de Nucleus actuales! �Facer �sto s� se est� totalmente seguro!	<br />	<b>Nota:</b> Comprobar a versi�n de Nucleus na que se creou a copia � a mesma que a versi�n que se est� usando agora! Non funcionar� se non � as�');
define('_RESTORE_INTRO',			'Seleccionar o arquivo de copia de seguridade (ser� enviado � servidor) e faga clic sobre o bot�n "Restaurar" para empezar.');
define('_RESTORE_IMSURE',			'�S�, estou seguro de que quero facer eso!');
define('_RESTORE_BTN',				'Restaurar dende arquivo');
define('_RESTORE_WARNING',			'(asegurarse de estar restaurando a copia de seguridade correcta, quizais sexa mellor facer una copia de seguridade antes de empezar)');
define('_ERROR_BACKUP_NOTSURE',		'Necesitar� marca-la casilla \'Estou seguro\'');
define('_RESTORE_COMPLETE',			'Restauraci�n feita');

// new item notification
define('_NOTIFY_NI_MSG',			'Un novo elemento foi insertado:');
define('_NOTIFY_NI_TITLE',			'Novo elemento!');
define('_NOTIFY_KV_MSG',			'Voto Karma del elemento:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comentario sobre o elemento:');
define('_NOTIFY_NC_TITLE',			'Comentario de Nucleus:');
define('_NOTIFY_USERID',			'ID de usuario:');
define('_NOTIFY_USER',				'Usuario:');
define('_NOTIFY_COMMENT',			'Comentario:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'T�tulo:');
define('_NOTIFY_CONTENTS',			'Contido:');

// member mail message
define('_MMAIL_MSG',				'Unha mensaxe enviada por');
define('_MMAIL_FROMANON',			'un visitante an�nimo');
define('_MMAIL_FROMNUC',			'Insertado dende unha bit�cora de Nucleus en');
define('_MMAIL_TITLE',				'Unha mensaxe de');
define('_MMAIL_MAIL',				'Mensaxe:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Introducir entrada');
define('_BMLET_EDIT',				'Editar entrada');
define('_BMLET_DELETE',				'Eliminar entrada');
define('_BMLET_BODY',				'Corpo');
define('_BMLET_MORE',				'Mais');
define('_BMLET_OPTIONS',			'Opci�ns');
define('_BMLET_PREVIEW',			'Previsualizar');

// used in bookmarklet
define('_ITEM_UPDATED',				'A entrada foi actualizada');
define('_ITEM_DELETED',				'A entrada foi eliminada');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Seguro que se desexa elimina-lo plugin chamado');
define('_ERROR_NOSUCHPLUGIN',		'Non existe ese plugin');
define('_ERROR_DUPPLUGIN',			'Ese plugin xa foi instalado');
define('_ERROR_PLUGFILEERROR',		'Non existe ese plugin, ou os permisos no son os correctos');
define('_PLUGS_NOCANDIDATES',		'Non se atoparon candidatos para o plugin');

define('_PLUGS_TITLE_MANAGE',		'Xestionar plugins');
define('_PLUGS_TITLE_INSTALLED',	'Actualmente instalado');
define('_PLUGS_TITLE_UPDATE',		'Actualiza-la lista de suscripci�n');
define('_PLUGS_TEXT_UPDATE',		'Nucleus manten unha cach� das suscripcions a eventos dos plugins. Cando se actualiza un plugin sustituindo o seu arquivo, d�bese executar esta actualizaci�n para asegurar que as suscripcions da cach� son correctas');
define('_PLUGS_TITLE_NEW',			'Instalar un novo plugin');
define('_PLUGS_ADD_TEXT',			'A continuaci�n hai una lista de t�dolos arquivos do teu directorio de plugins, alg�ns poder�an ser plugins sin instalaci�n. Aseg�rate de estar <strong>totalmente seguro</strong> de que se trata de un plugin antes de introducirlo.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'voltar a principal');

// editlink
define('_TEMPLATE_EDITLINK',		'Editalo enlace da entrada');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Insertar cadro � esquerda');
define('_ADD_RIGHT_TT',				'Insertar cadro � dereita');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categor�a');

// new settings
define('_SETTINGS_PLUGINURL',		'URL do plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. tama�o de arquivo para subida (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir �s non membros que envien mensaxes');
define('_SETTINGS_PROTECTMEMNAMES',	'Protexelos nomes dos membros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Xestionar plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Rexistro dun novo membro:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'O teu e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sen permiso de administraci�n sobre ningunha das bit�coras que ten o membro de destino do equipo. Polo tanto, non � posible subir arquivos � directorio de medios de este membro');

// plugin list
define('_LISTS_INFO',				'Informaci�n');
define('_LIST_PLUGS_AUTHOR',		'Por:');
define('_LIST_PLUGS_VER',			'Versi�n:');
define('_LIST_PLUGS_SITE',			'Visitar sitio');
define('_LIST_PLUGS_DESC',			'Descripci�n:');
define('_LIST_PLUGS_SUBS',			'Suscribir �s seguintes eventos:');
define('_LIST_PLUGS_UP',			'desplazar arriba');
define('_LIST_PLUGS_DOWN',			'desplazar abaixo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar&nbsp;opci�ns');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Este plugin non ten establecida ningunha opci�n');
define('_PLUGS_BACK',				'Voltar � lista de plugins');
define('_PLUGS_SAVE',				'Gardar opci�ns');
define('_PLUGS_OPTIONS_UPDATED',	'Opci�ns de plugin actualizadas');

define('_OVERVIEW_MANAGEMENT',		'Xesti�n');
define('_OVERVIEW_MANAGE',			'Xesti�n de Nucleus...');
define('_MANAGE_GENERAL',			'Xesti�n xeral');
define('_MANAGE_SKINS',				'"Skins" e plantillas');
define('_MANAGE_EXTRA',				'Caracter�sticas extra');

define('_BACKTOMANAGE',				'voltar � xesti�n de Nucleus');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'Sair');
define('_LOGIN',					'Entrar');
define('_YES',						'S�');
define('_NO',						'Non');
define('_SUBMIT',					'Enviar');
define('_ERROR',					'Erro');
define('_ERRORMSG',					'Ha sucedido un error!');
define('_BACK',						'voltar');
define('_NOTLOGGEDIN',				'No registrado');
define('_LOGGEDINAS',				'Registrado como');
define('_ADMINHOME',				'Administraci�n');
define('_NAME',						'nome');
define('_BACKHOME',					'Voltar � administraci�n');
define('_BADACTION',				'No existe la acci�n requerida');
define('_MESSAGE',					'Mensaje');
define('_HELP_TT',					'Ayuda!');
define('_YOURSITE',					'Ver web');


define('_POPUP_CLOSE',				'Cerrar ventana');

define('_LOGIN_PLEASE',				'Es necesario reg�strarse primero');

// commentform
define('_COMMENTFORM_YOUARE',		'Eres');
define('_COMMENTFORM_SUBMIT',		'Introducir comentario');
define('_COMMENTFORM_COMMENT',		'Comentario');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'Email/HTTP');
define('_COMMENTFORM_REMEMBER',		'Lembrar usuario');

// loginform
define('_LOGINFORM_NAME',			'Usuario');
define('_LOGINFORM_PWD',			'contrasinal');
define('_LOGINFORM_YOUARE',			'Rexistrado como');
define('_LOGINFORM_SHARED',			'Ordenador compartido');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar mensaxe');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Introducir nova entrada a');
define('_ADD_CREATENEW',			'Crear nova entrada');
define('_ADD_BODY',					'Corpo');
define('_ADD_TITLE',				'T�tulo');
define('_ADD_MORE',					'Extensi�n (opcional)');
define('_ADD_CATEGORY',				'Categor�a');
define('_ADD_PREVIEW',				'Previsualizar');
define('_ADD_DISABLE_COMMENTS',		'Deshabilitar comentarios?');
define('_ADD_DRAFTNFUTURE',			'Borrador e futuras entradas');
define('_ADD_ADDITEM',				'Introducir entrada');
define('_ADD_ADDNOW',				'Introducir agora');
define('_ADD_ADDLATER',				'Introducir logo');
define('_ADD_PLACE_ON',				'Colocar en');
define('_ADD_ADDDRAFT',				'Introducir no borrador');
define('_ADD_NOPASTDATES',			'(As datas e horas pasadas non son v�lidas, usarase o momento actual)');
define('_ADD_BOLD_TT',				'Negrita');
define('_ADD_ITALIC_TT',			'It�lica');
define('_ADD_HREF_TT',				'Crear enlace');
define('_ADD_MEDIA_TT',				'Introducir imaxe ou multimedia');
define('_ADD_PREVIEW_TT',			'Mostrar/ocultar previsualizaci�n');
define('_ADD_CUT_TT',				'Cortar');
define('_ADD_COPY_TT',				'Copiar');
define('_ADD_PASTE_TT',				'Pegar');


// edit item form
define('_EDIT_ITEM',				'Editar entrada');
define('_EDIT_SUBMIT',				'Editar entrada');
define('_EDIT_ORIG_AUTHOR',			'Autor orixinal');
define('_EDIT_BACKTODRAFTS',		'Enviar � borrador');
define('_EDIT_COMMENTSNOTE',		'(nota: deshabilitalos comentarios non ocultar� os existentes)');

// used on delete screens
define('_DELETE_CONFIRM',			'Confirmala eliminaci�n');
define('_DELETE_CONFIRM_BTN',		'Confirmala eliminaci�n');
define('_CONFIRMTXT_ITEM',			'A punto de eliminala segunte entrada:');
define('_CONFIRMTXT_COMMENT',		'A punto de eliminalo seguinte comentario:');
define('_CONFIRMTXT_TEAM1',			'A punto de eliminar ');
define('_CONFIRMTXT_TEAM2',			' do equipo para a bit�cora ');
define('_CONFIRMTXT_BLOG',			'Aa bit�cora a eliminar �: ');
define('_WARNINGTXT_BLOGDEL',		'Cuidado! Eliminar unha bit�cora eliminar� TODALAS s�as entradas e comentarios. Confirmar definitivamente a eliminaci�n!<br />Non interrumpilo sistema durante a eliminaci�n.');
define('_CONFIRMTXT_MEMBER',		'A punto de eliminalo seguinte membro: ');
define('_CONFIRMTXT_TEMPLATE',		'A punto de eliminala plantilla chamada ');
define('_CONFIRMTXT_SKIN',			'A punto de eliminala pel chamada ');
define('_CONFIRMTXT_BAN',			'A punto de eliminala restricci�n para o rango IP');
define('_CONFIRMTXT_CATEGORY',		'A punto de eliminala categor�a ');

// some status messages
define('_DELETED_ITEM',				'Entrada eliminada');
define('_DELETED_MEMBER',			'Membro eliminado');
define('_DELETED_COMMENT',			'Comentario eliminado');
define('_DELETED_BLOG',				'Bit�cora eliminada');
define('_DELETED_CATEGORY',			'Categor�a eliminada');
define('_ITEM_MOVED',				'Entrada movida');
define('_ITEM_ADDED',				'Entrada introducida');
define('_COMMENT_UPDATED',			'Comentario actualizado');
define('_SKIN_UPDATED',				'Datos da pel actualizados');
define('_TEMPLATE_UPDATED',			'Datos da plantilla gardados');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Non usar palabras de lonxitude maior a 90 car�cteres nos comentarios');
define('_ERROR_COMMENT_NOCOMMENT',	'Introducilo comentario');
define('_ERROR_COMMENT_NOUSERNAME',	'Usuario incorrecto');
define('_ERROR_COMMENT_TOOLONG',	'Comentario  demasiado longo (m�ximo : 5000 car�cteres)');
define('_ERROR_COMMENTS_DISABLED',	'Comentarios deshabilitados para esta bit�cora.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Rexistrarse primeiro como membro para introducir comentarios nesta bit�cora');
define('_ERROR_COMMENTS_MEMBERNICK','O nome indicado para introducir comentarios est� sendo usado por outro membro. Probar con outro.');
define('_ERROR_SKIN',				'Erro de pel');
define('_ERROR_ITEMCLOSED',			'Esta entrada est� pechada, non � posible introducir novos comentarios � votar');
define('_ERROR_NOSUCHITEM',			'A entrada indicada non existe');
define('_ERROR_NOSUCHBLOG',			'A bit�cora indicada non existe');
define('_ERROR_NOSUCHSKIN',			'A pel indicada non existe');
define('_ERROR_NOSUCHMEMBER',		'O membro indicado non existe');
define('_ERROR_NOTONTEAM',			'O usuario non pertence � equipo desta bit�cora.');
define('_ERROR_BADDESTBLOG',		'A bit�cora de destino non existe');
define('_ERROR_NOTONDESTTEAM',		'Non � posible movela entrada, xa que o usuario non pertence � equipo da bit�cora de destino');
define('_ERROR_NOEMPTYITEMS',		'Non � posible introducir entradas valeiras!');
define('_ERROR_BADMAILADDRESS',		'Direcci�n de correo incorrecta');
define('_ERROR_BADNOTIFY',			'Unha ou mais das direcci�ns de notificaci�n non son direcci�ns correctas');
define('_ERROR_BADNAME',			'O nome non � v�lido (s�lo a-z y 0-9 permitidos, sin espacios � principio nin � final)');
define('_ERROR_NICKNAMEINUSE',		'Outro membro est� usando xa ese nome');
define('_ERROR_PASSWORDMISMATCH',	'As contrasinals deben coincidir');
define('_ERROR_PASSWORDTOOSHORT',	'A contrasinal debe ter polo menos 6 car�cteres');
define('_ERROR_PASSWORDMISSING',	'A contrasinal non pode estar valeira');
define('_ERROR_REALNAMEMISSING',	'O nome real introducido non � v�lido');
define('_ERROR_ATLEASTONEADMIN',	'Debe de existir sempre polo menos un superadministrador que poida rexistrarse na zona de administraci�n.');
define('_ERROR_ATLEASTONEBLOGADMIN','Executar esta acci�n deixar�a a bit�cora insostible. Debe de existir sempre polo menos un administrador.');
define('_ERROR_ALREADYONTEAM',		'Non � posible introducir un membro que xa pertenza � equipo');
define('_ERROR_BADSHORTBLOGNAME',	'O nome corto da bit�cora s� debe conter a-z y 0-9, y sen espacios');
define('_ERROR_DUPSHORTBLOGNAME',	'Outra bit�cora xa ten ese nome corto. Os nomes cortos deben de ser �nicos');
define('_ERROR_UPDATEFILE',			'Sen permiso de escritura para actualizalo arquivo. Os permisos deben de ser correctos (probar chmod 666). A localizaci�n debe ser relativa � directorio de administraci�n, polo que quizais conve�a usar un cami�o absoluto (como /cami�o/ata/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Non � posible eliminala bit�cora principal');
define('_ERROR_DELETEMEMBER',		'Este membro non pode ser eliminado, probablemente porque � o autor de entradas ou comentarios');
define('_ERROR_BADTEMPLATENAME',	'Nome incorrecto para a plantilla, usar s� a-z y 0-9, y sen espacios');
define('_ERROR_DUPTEMPLATENAME',	'Xa existe outra plantilla con ese nome');
define('_ERROR_BADSKINNAME',		'Nome incorrecto para a pel (s� a-z, 0-9 est�n permitidos, e sen espacios)');
define('_ERROR_DUPSKINNAME',		'Xa existe outra pel con ese nome');
define('_ERROR_DEFAULTSKIN',		'Sempre debe de existir unha pel chamada "default"');
define('_ERROR_SKINDEFDELETE',		'Non � posible eliminala pel xa que � a pel predeterminada para a seguinte bit�cora: ');
define('_ERROR_DISALLOWED',			'Sen suficiente permiso para executar esa acci�n');
define('_ERROR_DELETEBAN',			'Erro � eliminala restricci�n (a restricci�n non existe)');
define('_ERROR_ADDBAN',				'Erro � introducir restricci�n. A poida que non se introducira correctamente nas bit�coras.');
define('_ERROR_BADACTION',			'A acci�n indicada non existe');
define('_ERROR_MEMBERMAILDISABLED',	'As mensaxes de membro a membro est�n deshabilitadas');
define('_ERROR_MEMBERCREATEDISABLED','A creaci�n de contas para membros est� deshabilitada');
define('_ERROR_INCORRECTEMAIL',		'Direcci�n de correo incorrecta');
define('_ERROR_VOTEDBEFORE',		'O voto do usuario para esta entrada xa existe');
define('_ERROR_BANNED1',			'Non � posible executala acci�n xa que el (rango IP ');
define('_ERROR_BANNED2',			') est� restrinxido. A mensaxe era: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'O usuario debe de estar rexistrado para facer eso');
define('_ERROR_CONNECT',			'Erro de conexi�n');
define('_ERROR_FILE_TOO_BIG',		'O arquivo � demasiado grande!');
define('_ERROR_BADFILETYPE',		'Tipo de arquivo non permitido');
define('_ERROR_BADREQUEST',			'Erro no env�o do arquivo');
define('_ERROR_DISALLOWEDUPLOAD',	'O usuario non pertence � equipo de ningunha bit�cora. Non � posible enviar arquivos');
define('_ERROR_BADPERMISSIONS',		'Los permisos non son correctos');
define('_ERROR_UPLOADMOVEP',		'Erro � movelo arquivo enviado');
define('_ERROR_UPLOADCOPY',			'Erro � copialo arquivo enviado');
define('_ERROR_UPLOADDUPLICATE',	'Xa existe otro arquivo con ese nome. Intente renomealo antes de envialo.');
define('_ERROR_LOGINDISALLOWED',	'Sen permiso para entrar na administraci�n. � posible rexistrarse como outro usuario');
define('_ERROR_DBCONNECT',			'Non � posible conectar con MySQL server');
define('_ERROR_DBSELECT',			'Non � posible seleccionala base de datos de Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Non existe o arquivo para o idioma');
define('_ERROR_NOSUCHCATEGORY',		'Non existe a categor�a');
define('_ERROR_DELETELASTCATEGORY',	'Debe de haber polo menos una categor�a');
define('_ERROR_DELETEDEFCATEGORY',	'Non � posible eliminala categor�a principal');
define('_ERROR_BADCATEGORYNAME',	'Nome de categor�a incorrecto');
define('_ERROR_DUPCATEGORYNAME',	'Xa existe outra categor�a con ese nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Cuidado: O valor actual non � un directorio!');
define('_WARNING_NOTREADABLE',		'Cuidado: O valor actual � un directorio sin permiso de lectura!');
define('_WARNING_NOTWRITABLE',		'Cuidado: O valor actual NON � un directorio con permiso de escritura!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar un novo arquivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'Nome de arquivo');
define('_MEDIA_DIMENSIONS',			'Dimensi�ns');
define('_MEDIA_INLINE',				'Conectado');
define('_MEDIA_POPUP',				'Vent� popup');
define('_UPLOAD_TITLE',				'Seleccionar arquivo');
define('_UPLOAD_MSG',				'Seleccionalo arquivo a enviar, e pulsalo bot�n \'Enviar\'.');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Conta creada, a contrasinal ser� enviada por correo');
define('_MSG_PASSWORDSENT',			'A contrasinal foi enviada por correo.');
define('_MSG_LOGINAGAIN',			'� necesario rexistrarse de novo xa que los datos do usuario foron modificados');
define('_MSG_SETTINGSCHANGED',		'Preferencias modificadas');
define('_MSG_ADMINCHANGED',			'Administrador modificado');
define('_MSG_NEWBLOG',				'Nova bit�cora creada');
define('_MSG_ACTIONLOGCLEARED',		'Rexistro de actividades valeirado');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Acci�n non permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nova contrasinal enviada a ');
define('_ACTIONLOG_TITLE',			'Rexistro de actividades');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpalo rexistro de actividades');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpalo rexistro de actividades ahora');

// team management
define('_TEAM_TITLE',				'Modificalo equipo da bit�cora ');
define('_TEAM_CURRENT',				'Equipo actual');
define('_TEAM_ADDNEW',				'Introducir un nuevo membro no equipo');
define('_TEAM_CHOOSEMEMBER',		'Seleccionar membro');
define('_TEAM_ADMIN',				'Privilexios de administraci�n? ');
define('_TEAM_ADD',					'Introducir no equipo');
define('_TEAM_ADD_BTN',				'Introducir no equipo');

// blogsettings
define('_EBLOG_TITLE',				'Modificalas preferencias da bit�cora');
define('_EBLOG_TEAM_TITLE',			'Modificarlo equipo');
define('_EBLOG_TEAM_TEXT',			'Pulsa aqu� para modificalo equipo.');
define('_EBLOG_SETTINGS_TITLE',		'Preferencias da bit�cora');
define('_EBLOG_NAME',				'Nome da bit�cora');
define('_EBLOG_SHORTNAME',			'Nome corto da bit�cora');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(debe conter s� letras e sen espacios)');
define('_EBLOG_DESC',				'Descripci�n da bit�cora');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Pel por defecto');
define('_EBLOG_DEFCAT',				'Categor�a por defecto');
define('_EBLOG_LINEBREAKS',			'Convertir saltos de l�nea');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar comentarios?<br /><small>(Deshabilitalos comentarios implica non poder introducir novos.)</small>');
define('_EBLOG_ANONYMOUS',			'Permitese a introducci�n de comentarios por non membros?');
define('_EBLOG_NOTIFY',				'Direcci�n(s) de notificaci�n (usa ; como separador)');
define('_EBLOG_NOTIFY_ON',			'Notificar');
define('_EBLOG_NOTIFY_COMMENT',		'Novos comentarios');
define('_EBLOG_NOTIFY_KARMA',		'Novos votos');
define('_EBLOG_NOTIFY_ITEM',		'Novas entradas');
define('_EBLOG_PING',				'Ping Weblogs.com � actualizar?');
define('_EBLOG_MAXCOMMENTS',		'M�xima cantidade de comentarios');
define('_EBLOG_UPDATE',				'Actualizalo arquivo');
define('_EBLOG_OFFSET',				'Zona horaria');
define('_EBLOG_STIME',				'A hora actual do servidor �');
define('_EBLOG_BTIME',				'A hora actual da bit�cora �');
define('_EBLOG_CHANGE',				'Modificalas preferencias');
define('_EBLOG_CHANGE_BTN',			'Modificar preferencias');
define('_EBLOG_ADMIN',				'Administraci�n da bit�cora');
define('_EBLOG_ADMIN_MSG',			'Asinar�nselle privilexios de administrador � usuario');
define('_EBLOG_CREATE_TITLE',		'Crear nova bit�cora');
define('_EBLOG_CREATE_TEXT',		'Cubrir o seguinte formulario para crear unha nueva bit�cora. <br /><br /> <b>Nota:</b> S� as opci�ns necesarias est�n listadas. Para opci�ns extra, entrar na p�xina de preferencias da bit�cora despois de creala.');
define('_EBLOG_CREATE',				'Crear!');
define('_EBLOG_CREATE_BTN',			'Crear bit�cora');
define('_EBLOG_CAT_TITLE',			'Categor�as');
define('_EBLOG_CAT_NAME',			'Nome da categor�a');
define('_EBLOG_CAT_DESC',			'Descripci�n da categor�a');
define('_EBLOG_CAT_CREATE',			'Crear categor�a');
define('_EBLOG_CAT_UPDATE',			'Actualizar categor�a');
define('_EBLOG_CAT_UPDATE_BTN',		'Actualizar categor�a');

// templates
define('_TEMPLATE_TITLE',			'Modificar plantillas');
define('_TEMPLATE_AVAILABLE_TITLE',	'Plantillas dispo�ibles');
define('_TEMPLATE_NEW_TITLE',		'Nova plantilla');
define('_TEMPLATE_NAME',			'Nome de plantilla');
define('_TEMPLATE_DESC',			'Descripci�n da plantilla');
define('_TEMPLATE_CREATE',			'Crear plantilla');
define('_TEMPLATE_CREATE_BTN',		'Crear plantilla');
define('_TEMPLATE_EDIT_TITLE',		'Editar plantilla');
define('_TEMPLATE_BACK',			'Voltar � p�xina da plantilla');
define('_TEMPLATE_EDIT_MSG',		'Non todalas partes da plantilla son necesarias, � posible deixar en blanco as innecesarias.');
define('_TEMPLATE_SETTINGS',		'Preferencias das plantillas');
define('_TEMPLATE_ITEMS',			'Entradas');
define('_TEMPLATE_ITEMHEADER',		'Cabeceira de entrada');
define('_TEMPLATE_ITEMBODY',		'Corpo da entrada');
define('_TEMPLATE_ITEMFOOTER',		'Pe da entrada');
define('_TEMPLATE_MORELINK',		'Enlazala extensi�n da entrada');
define('_TEMPLATE_NEW',				'Indicaci�n de nova entrada');
define('_TEMPLATE_COMMENTS_ANY',	'Comentarios (se os hai)');
define('_TEMPLATE_CHEADER',			'Cabeceira dos comentarios');
define('_TEMPLATE_CBODY',			'Corpo dos comentarios');
define('_TEMPLATE_CFOOTER',			'Pe dos comentarios');
define('_TEMPLATE_CONE',			'Un comentario');
define('_TEMPLATE_CMANY',			'Dous (ou mais) comentarios');
define('_TEMPLATE_CMORE',			'Comentarios Ler mais');
define('_TEMPLATE_CMEXTRA',			'membro Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Comentarios (se non hai)');
define('_TEMPLATE_CNONE',			'Sen comentarios');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comentarios (se os hai, pero son demasiados para mostralos directamente)');
define('_TEMPLATE_CTOOMUCH',		'Demasiados comentarios');
define('_TEMPLATE_ARCHIVELIST',		'Listas de arquivos');
define('_TEMPLATE_AHEADER',			'Cabeceira da lista de arquivos');
define('_TEMPLATE_AITEM',			'Elemento da lista de arquivos');
define('_TEMPLATE_AFOOTER',			'Pe da lista de arquivos');
define('_TEMPLATE_DATETIME',		'Data e hora');
define('_TEMPLATE_DHEADER',			'Cabeceira da data');
define('_TEMPLATE_DFOOTER',			'Pe da data');
define('_TEMPLATE_DFORMAT',			'Formato da data');
define('_TEMPLATE_TFORMAT',			'Formato da hora');
define('_TEMPLATE_LOCALE',			'Local');
define('_TEMPLATE_IMAGE',			'Vent�s de imaxe');
define('_TEMPLATE_PCODE',			'C�digo de enlace popup');
define('_TEMPLATE_ICODE',			'C�digo de imaxe insertada');
define('_TEMPLATE_MCODE',			'C�digo de enlace a imaxe ou multimedia');
define('_TEMPLATE_SEARCH',			'Buscar');
define('_TEMPLATE_SHIGHLIGHT',		'Resaltar');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado na busca');
define('_TEMPLATE_UPDATE',			'Actualizar');
define('_TEMPLATE_UPDATE_BTN',		'Actualizar plantilla');
define('_TEMPLATE_RESET_BTN',		'Inicializar datos');
define('_TEMPLATE_CATEGORYLIST',	'Lista de categor�as');
define('_TEMPLATE_CATHEADER',		'Cabeceira de lista de categor�as');
define('_TEMPLATE_CATITEM',			'Elemento de lista de categor�as');
define('_TEMPLATE_CATFOOTER',		'P� de lista de categor�as');

// skins
define('_SKIN_EDIT_TITLE',			'Modificar peles');
define('_SKIN_AVAILABLE_TITLE',		'Peles dispo�ibles');
define('_SKIN_NEW_TITLE',			'Nova pel');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descripci�n');
define('_SKIN_TYPE',				'Tipo de contido');
define('_SKIN_CREATE',				'Crear');
define('_SKIN_CREATE_BTN',			'Crear pel');
define('_SKIN_EDITONE_TITLE',		'Modificar pel');
define('_SKIN_BACK',				'Voltar � p�gina da pel');
define('_SKIN_PARTS_TITLE',			'Partes da piel');
define('_SKIN_PARTS_MSG',			'Non t�dolos tipos son necesarios para cada pel. Deixar en blanco os innecesarios. Selecciona o tipo de pel a modificar:');
define('_SKIN_PART_MAIN',			'�ndice principal');
define('_SKIN_PART_ITEM',			'P�xinas do elemento');
define('_SKIN_PART_ALIST',			'Lista de arquivos');
define('_SKIN_PART_ARCHIVE',		'arquivos');
define('_SKIN_PART_SEARCH',			'Buscar');
define('_SKIN_PART_ERROR',			'Erros');
define('_SKIN_PART_MEMBER',			'Detalles do membro');
define('_SKIN_PART_POPUP',			'Im�xes de popup');
define('_SKIN_GENSETTINGS_TITLE',	'Preferencias xerais');
define('_SKIN_CHANGE',				'Modificar');
define('_SKIN_CHANGE_BTN',			'Modificar estas preferencias');
define('_SKIN_UPDATE_BTN',			'Actualizar pel');
define('_SKIN_RESET_BTN',			'Inicializar datos');
define('_SKIN_EDITPART_TITLE',		'Modificar pel');
define('_SKIN_GOBACK',				'Voltar');
define('_SKIN_ALLOWEDVARS',			'Variables permitidas (facer clic para mais informaci�n):');

// global settings
define('_SETTINGS_TITLE',			'Preferencias xerais');
define('_SETTINGS_SUB_GENERAL',		'Preferencias xerais');
define('_SETTINGS_DEFBLOG',			'Bit�cora principal');
define('_SETTINGS_ADMINMAIL',		'Administrador de correo');
define('_SETTINGS_SITENAME',		'nome da web');
define('_SETTINGS_SITEURL',			'URL da web ( debe de rematar cunha barra / )');
define('_SETTINGS_ADMINURL',		'URL da administraci�n ( debe terminar cunha barra / )');
define('_SETTINGS_DIRS',			'Directorios de Nucleus');
define('_SETTINGS_MEDIADIR',		'Directorios de imaxes e multimedia');
define('_SETTINGS_SEECONFIGPHP',	'(ver config.php)');
define('_SETTINGS_MEDIAURL',		'URL para im�xes ou multimedia ( debe de rematar cunha barra / )');
define('_SETTINGS_ALLOWUPLOAD',		'�Permitilo env�o de arquivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de arquivo permitidos para env�o');
define('_SETTINGS_CHANGELOGIN',		'Permitirlles �s membros modificar os seus datos de rexistro / contrasinal');
define('_SETTINGS_COOKIES_TITLE',	'Preferencias de cookies');
define('_SETTINGS_COOKIELIFE',		'Tempo de vida da cookie de rexistro');
define('_SETTINGS_COOKIESESSION',	'Cookies de sesi�n');
define('_SETTINGS_COOKIEMONTH',		'Tempo de vida dun mes');
define('_SETTINGS_COOKIEPATH',		'Cami�o das cookies (avanzado)');
define('_SETTINGS_COOKIEDOMAIN',	'Dominio das cookies (avanzado)');
define('_SETTINGS_COOKIESECURE',	'Cookies seguras (avanzado)');
define('_SETTINGS_LASTVISIT',		'Gardalas cookies da �ltima visita');
define('_SETTINGS_ALLOWCREATE',		'Permitir �s visitantes crear unha conta de membro');
define('_SETTINGS_NEWLOGIN',		'Rexistro permitido para as contas creadas polo usuario');
define('_SETTINGS_NEWLOGIN2',		'(s� para contas novas)');
define('_SETTINGS_MEMBERMSGS',		'Permite un servicio de membro a membro');
define('_SETTINGS_LANGUAGE',		'Idioma por defecto');
define('_SETTINGS_DISABLESITE',		'Deshabilitar web');
define('_SETTINGS_DBLOGIN',			'MySQL Rexistro e base de datos');
define('_SETTINGS_UPDATE',			'Actualizar preferencias');
define('_SETTINGS_UPDATE_BTN',		'Actualizar preferencias');
define('_SETTINGS_DISABLEJS',		'Deshabilitala barra de ferramientas de JavaScript');
define('_SETTINGS_MEDIA',			'Preferencias de env�o / im�xes / multimedia');
define('_SETTINGS_MEDIAPREFIX',		'Prefixalos arquivos enviados coa data');
define('_SETTINGS_MEMBERS',			'Preferencias dos membros');

// bans
define('_BAN_TITLE',				'Lista de restriccions para');
define('_BAN_NONE',					'No hay restricci�ns para esta bit�cora');
define('_BAN_NEW_TITLE',			'Introducir nova restricci�n');
define('_BAN_NEW_TEXT',				'Introducir unha nova restricci�n agora');
define('_BAN_REMOVE_TITLE',			'Eliminar restricci�n');
define('_BAN_IPRANGE',				'Rango IP');
define('_BAN_BLOGS',				'�Qu� bit�coras?');
define('_BAN_DELETE_TITLE',			'Eliminar restricci�n');
define('_BAN_ALLBLOGS',				'Bit�coras para as que o usuario ten privilexios de administrador.');
define('_BAN_REMOVED_TITLE',		'Restricci�n eliminada');
define('_BAN_REMOVED_TEXT',			'Restricci�n eliminada para as seguintes bit�coras:');
define('_BAN_ADD_TITLE',			'Introducir restricci�n');
define('_BAN_IPRANGE_TEXT',			'Seleccionalo rango IP a restrinxir. A menor cantidade de n�meros, m�is direccions restrinxidas.');
define('_BAN_BLOGS_TEXT',			'� posible optar por restrinxila IP para unha s�a bit�cora, ou restrinxila IP en todalas bit�coras nas que o usuario te�a privilexios de administrador.');
define('_BAN_REASON_TITLE',			'Raz�n');
define('_BAN_REASON_TEXT',			'� posible incluir unha raz�n para a restricci�n, que ser� mostrada cuando o usuario con esa IP intente engadir un comentario ou votar. La longitud m�xima es de 256 car�cteres.');
define('_BAN_ADD_BTN',				'Introducir restricci�n');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensaxe');
define('_LOGIN_NAME',				'nome');
define('_LOGIN_PASSWORD',			'contrasinal');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'�Esquencichela contrasinal?');

// membermanagement
define('_MEMBERS_TITLE',			'Xesti�n dos membros');
define('_MEMBERS_CURRENT',			'Membros actuais');
define('_MEMBERS_NEW',				'Novo membro');
define('_MEMBERS_DISPLAY',			'Nome mostrado');
define('_MEMBERS_DISPLAY_INFO',		'(Este � o nome usado para rexistrarse)');
define('_MEMBERS_REALNAME',			'Nome real');
define('_MEMBERS_PWD',				'Contrasinal');
define('_MEMBERS_REPPWD',			'Repetila contrasinal');
define('_MEMBERS_EMAIL',			'Direcci�n de correo');
define('_MEMBERS_EMAIL_EDIT',		'(Cando se cambie a direcci�n de correo, unha nova contrasinal ser� enviada autom�ticamente a esa direcci�n)');
define('_MEMBERS_URL',				'Direcci�n da web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilexios de administrador');
define('_MEMBERS_CANLOGIN',			'O usuario pode entrar na administraci�n');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Introducir membro');
define('_MEMBERS_EDIT',				'Modificar membro');
define('_MEMBERS_EDIT_BTN',			'Modificalas preferencias');
define('_MEMBERS_BACKTOOVERVIEW',	'Voltar � p�xina do membro');
define('_MEMBERS_LOCALE',			'Lingua');
define('_MEMBERS_USESITELANG',		'- usalas preferencias da web -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar web');
define('_BLOGLIST_ADD',				'Introducir entrada');
define('_BLOGLIST_TT_ADD',			'Introducir unha nova entrada nesta bit�cora');
define('_BLOGLIST_EDIT',			'Modificar/Eliminar entradas');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Preferencias');
define('_BLOGLIST_TT_SETTINGS',		'Modificar preferencias o xestionar equipo');
define('_BLOGLIST_BANS',			'Restricci�ns');
define('_BLOGLIST_TT_BANS',			'Ver, introducir ou eliminar IPs restrinxidas');
define('_BLOGLIST_DELETE',			'Eliminar todo');
define('_BLOGLIST_TT_DELETE',		'Eliminar esta bit�cora');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'As t�as bit�coras');
define('_OVERVIEW_YRDRAFTS',		'Os teus borradores');
define('_OVERVIEW_YRSETTINGS',		'Preferencias persoais');
define('_OVERVIEW_GSETTINGS',		'Preferencias xerais');
define('_OVERVIEW_NOBLOGS',			'O usuario non est� en ning�n equipo da bit�cora');
define('_OVERVIEW_NODRAFTS',		'Non hai borradores');
define('_OVERVIEW_EDITSETTINGS',	'Modificar preferencias personais...');
define('_OVERVIEW_BROWSEITEMS',		'Examinar entradas...');
define('_OVERVIEW_BROWSECOMM',		'Examinar comentarios...');
define('_OVERVIEW_VIEWLOG',			'Ver o rexistro de actividades...');
define('_OVERVIEW_MEMBERS',			'Xestionalos membros...');
define('_OVERVIEW_NEWLOG',			'Crear unha nova bit�cora...');
define('_OVERVIEW_SETTINGS',		'Modificar preferencias...');
define('_OVERVIEW_TEMPLATES',		'Modificar plantillas...');
define('_OVERVIEW_SKINS',			'Modificar peles...');
define('_OVERVIEW_BACKUP',			'Copia de seguridade / Restauraci�n...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Entradas para a bit�cora'); 
define('_ITEMLIST_YOUR',			'Entradas');

// Comments
define('_COMMENTS',					'Comentarios');
define('_NOCOMMENTS',				'Entrada sen comentarios');
define('_COMMENTS_YOUR',			'Comentarios');
define('_NOCOMMENTS_YOUR',			'Non se escribiu ning�n comentario');

// LISTS (general)
define('_LISTS_NOMORE',				'Non hai resultados (adicionais)');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Seguinte');
define('_LISTS_SEARCH',				'Buscar');
define('_LISTS_CHANGE',				'Modificar');
define('_LISTS_PERPAGE',			'Entradas por p�xina');
define('_LISTS_ACTIONS',			'Acci�ns');
define('_LISTS_DELETE',				'Eliminar');
define('_LISTS_EDIT',				'Modificar');
define('_LISTS_MOVE',				'Mover');
define('_LISTS_CLONE',				'Clonar');
define('_LISTS_TITLE',				'T�tulo');
define('_LISTS_BLOG',				'Bit�cora');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descripci�n');
define('_LISTS_TIME',				'Tempo');
define('_LISTS_COMMENTS',			'Comentarios');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Nome mostrado');
define('_LIST_MEMBER_RNAME',		'Nome real');
define('_LIST_MEMBER_ADMIN',		'Superadministrador? ');
define('_LIST_MEMBER_LOGIN',		'Pode rexistrarse? ');
define('_LIST_MEMBER_URL',			'Web');

// banlist
define('_LIST_BAN_IPRANGE',			'Rango IP');
define('_LIST_BAN_REASON',			'Raz�n');

// actionlist
define('_LIST_ACTION_MSG',			'Mensaxe');

// commentlist
define('_LIST_COMMENT_BANIP',		'Restricci�n de IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Comentario');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'T�tulo e texto');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Modificar administrador');

// edit comments
define('_EDITC_TITLE',				'Modificar comentarios');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Dende onde?');
define('_EDITC_WHEN',				'Cando?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Modificar comentario');
define('_EDITC_MEMBER',				'Nembro');
define('_EDITC_NONMEMBER',			'Non membro');

// move item
define('_MOVE_TITLE',				'Mover a qu� bit�cora?');
define('_MOVE_BTN',					'Mover entrada');
