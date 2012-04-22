<?php

// Portuguese Nucleus Language File
// 
// Author: Rafael Cruz (bataelo@myrealbox.com) (on previous translation by Rodrigo Moraes)
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
define('_MEDIA_VIEW_TT',			'Ver imagem (nova janela)');
define('_MEDIA_FILTER_APPLY',		'Aplicar filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Enviar para');
define('_MEDIA_UPLOAD_NEW',			'Nova imagem');
define('_MEDIA_COLLECTION_SELECT',	'Selecionar');
define('_MEDIA_COLLECTION_TT',		'Ir para esta cole��o');
define('_MEDIA_COLLECTION_LABEL',	'Cole��o atual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinhar � esquerda');
define('_ADD_ALIGNRIGHT_TT',		'Alinhar � direita');
define('_ADD_ALIGNCENTER_TT',		'Alinhar ao centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir na busca');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Upload failed');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permitir posts no passado');
define('_ADD_CHANGEDATE',			'Atualizar hor�rio');
define('_BMLET_CHANGEDATE',			'Atualizar hor�rio');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/Exportar skin...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usar diret�rio do skin');
define('_SKIN_INCLUDE_MODE',		'Modo de inclus�o');
define('_SKIN_INCLUDE_PREFIX',		'Prefixo de inclus�o');

// global settings
define('_SETTINGS_BASESKIN',		'Skin base');
define('_SETTINGS_SKINSURL',		'URL dos skin');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Ceategoria default n�o pode ser movida');
define('_ERROR_MOVETOSELF',			'Imposs�vel de mover categoria (destino igual � origem)');
define('_MOVECAT_TITLE',			'Selecione o blog para mover a categoria');
define('_MOVECAT_BTN',				'Mover categoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo da URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nenhuma sele��o para executar');
define('_BATCH_ITEMS',				'Opera��o em grupo - �tens');
define('_BATCH_CATEGORIES',			'Opera��o em grupo - categorias');
define('_BATCH_MEMBERS',			'Opera��o em grupo - membros');
define('_BATCH_TEAM',				'Opera��o em grupo - membros do time');
define('_BATCH_COMMENTS',			'Opera��o em grupo - coment�rios');
define('_BATCH_UNKNOWN',			'Opera��o em grupo desconhecida: ');
define('_BATCH_EXECUTING',			'Executando');
define('_BATCH_ONCATEGORY',			'em: categoria');
define('_BATCH_ONITEM',				'em: post');
define('_BATCH_ONCOMMENT',			'em: coment�rio');
define('_BATCH_ONMEMBER',			'em: membro');
define('_BATCH_ONTEAM',				'em: membro de time');
define('_BATCH_SUCCESS',			'Sucesso!');
define('_BATCH_DONE',				'Feito!');
define('_BATCH_DELETE_CONFIRM',		'Confirmar exclus�o em grupo');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmar exclus�o em grupo');
define('_BATCH_SELECTALL',			'seleciona tudo');
define('_BATCH_DESELECTALL',		'limpar sele��o');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Apagar');
define('_BATCH_ITEM_MOVE',			'Mover');
define('_BATCH_MEMBER_DELETE',		'Apagar');
define('_BATCH_MEMBER_SET_ADM',		'Dar direitos de administrador');
define('_BATCH_MEMBER_UNSET_ADM',	'Tirar direitos de administrador');
define('_BATCH_TEAM_DELETE',		'Excluir do time');
define('_BATCH_TEAM_SET_ADM',		'Dar direitos de administrador');
define('_BATCH_TEAM_UNSET_ADM',		'Tirar direitos de administrador');
define('_BATCH_CAT_DELETE',			'Apagar');
define('_BATCH_CAT_MOVE',			'Mover para outro blog');
define('_BATCH_COMMENT_DELETE',		'Apagar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Novo post');
define('_ADD_PLUGIN_EXTRAS',		'Op��es Extra Plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Imposs�vel criar nova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin requer uma vers�o mais nova do nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Voltar para configura��es do blog');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar skins/templates selecionados');
define('_SKINIE_LOCAL',				'Importar de arquivo local:');
define('_SKINIE_NOCANDIDATES',		'Sem candidatos para importar na pasta de skins');
define('_SKINIE_FROMURL',			'Importar da URL:');
define('_SKINIE_EXPORT_INTRO',		'Selecione os skins e templates que voc� quer exportar abaixo');
define('_SKINIE_EXPORT_SKINS',		'Skins');
define('_SKINIE_EXPORT_TEMPLATES',	'Templates');
define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobrescrever skins existentes (see nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Sim, quero importar isto');
define('_SKINIE_CONFIRM_TITLE',		'Prestes a importar skins e templates');
define('_SKINIE_INFO_SKINS',		'Skins no arquivo:');
define('_SKINIE_INFO_TEMPLATES',	'Templates no arquivo:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Skin com mesmo nome:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template com mesmo nome:');
define('_SKINIE_INFO_IMPORTEDSKINS','Skins importados:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Templates importados:');
define('_SKINIE_DONE',				'Importa��o completa');

define('_AND',						'e');
define('_OR',						'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo vazio (clique para editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Partes definidas:');

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
define('_NOTIFY_NI_MSG',			'Um novo post foi postado:');
define('_NOTIFY_NI_TITLE',			'Novo post!');
define('_NOTIFY_KV_MSG',			'Karma vote no post:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Coment�rio no post');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'ID do usu�rio:');
define('_NOTIFY_USER',				'Nome:');
define('_NOTIFY_COMMENT',			'Coment�rio:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'T�tulo:');
define('_NOTIFY_CONTENTS',			'Conte�do:');

// member mail message
define('_MMAIL_MSG',				'Esta mensagem foi enviada atrav�s do seu blog por ');
define('_MMAIL_FROMANON',			'um visitante an�nimo');
define('_MMAIL_FROMNUC',			'');
define('_MMAIL_TITLE',				'Mensagem de');
define('_MMAIL_MAIL',				'Mensagem:');

// END introduced after v1.5 END

// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Publicar');
define('_BMLET_EDIT',				'Editar');
define('_BMLET_DELETE',				'Apagar');
define('_BMLET_BODY',				'Texto principal');
define('_BMLET_MORE',				'Leia mais');
define('_BMLET_OPTIONS',			'Op��es');
define('_BMLET_PREVIEW',			'Pr�via');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item editado');
define('_ITEM_DELETED',				'Item apagado');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Tem certeza que quer apagar o plugin');
define('_ERROR_NOSUCHPLUGIN',		'Este plugin n�o existe');
define('_ERROR_DUPPLUGIN',		'Oops. Este plugin j� est� instalado');
define('_ERROR_PLUGFILEERROR',		'Este plugin n�o existe, ou as permiss�es n�o est�o definidas corretamente');
define('_PLUGS_NOCANDIDATES',		'Nenhum plugin encontrado');

define('_PLUGS_TITLE_MANAGE',		'Administra��o de plugins');
define('_PLUGS_TITLE_INSTALLED',	'J� instalados');
define('_PLUGS_TITLE_UPDATE',		'Atualizar lista de inscritos');
define('_PLUGS_TEXT_UPDATE',		'Quando voc� atualiza um plugin susbstiruindo o arquivo, atualize o cache do Nucleus');
define('_PLUGS_TITLE_NEW',			'Instalar novo plugin');
define('_PLUGS_ADD_TEXT',			'Aqui est�o os arquivos localizados no diret�rio de plugins. Alguns podem ser plugins n�o instalados. Certifique-se de colocar apenas arquivos de plugin neste diret�rio.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'Voltar');

// editlink
define('_TEMPLATE_EDITLINK',		'Editar o link do item');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Caixa � esquerda');
define('_ADD_RIGHT_TT',				'Caixa � direita');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Endere�o do plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Tamanho m�ximo dos arquivos (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir que n�o membros enviem mensagens');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteger nomes de membros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Administra��o de plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Novo membro registrado:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Seu e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Voc� n�o possui autoriza��o ou n�o pode enviar arquivos para o diret�rio');

// plugin list
define('_LISTS_INFO',				'Informa��o');
define('_LIST_PLUGS_AUTHOR',		'Author:');
define('_LIST_PLUGS_VER',			'Vers�o:');
define('_LIST_PLUGS_SITE',			'Site:');
define('_LIST_PLUGS_DESC',			'Descri��o:');
define('_LIST_PLUGS_SUBS',			'Inscreva-se:');
define('_LIST_PLUGS_UP',			'para cima');
define('_LIST_PLUGS_DOWN',			'para baixo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar op��es');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'este plugin n�o tem op��es');
define('_PLUGS_BACK',				'Volta para a lista de plugins');
define('_PLUGS_SAVE',				'Gravar op��es');
define('_PLUGS_OPTIONS_UPDATED',	'Op��es de plugin atualizadas');

define('_OVERVIEW_MANAGEMENT',		'Administra��o');
define('_OVERVIEW_MANAGE',			'Administra��o do Nucleus...');
define('_MANAGE_GENERAL',			'Administra��o geral');
define('_MANAGE_SKINS',				'Skins e Templates');
define('_MANAGE_EXTRA',				'Extras');

define('_BACKTOMANAGE',				'Volta para a Administra��o do Nucleus');


// END introduced after v1.1 END


// global stuff
define('_LOGOUT',					'Sair');
define('_LOGIN',					'Entrar');
define('_YES',						'Sim');
define('_NO',						'N�o');
define('_SUBMIT',					'Envia');
define('_ERROR',					'Erro');
define('_ERRORMSG',					'Occorreu um erro!');
define('_BACK',						'Volta');
define('_NOTLOGGEDIN',				'Voc� n�o est� logado');
define('_LOGGEDINAS',				'Voc� est� logado como');
define('_ADMINHOME',				'In�cio');
define('_NAME',						'Nome');
define('_BACKHOME',					'In�cio');
define('_BADACTION',				'A a��o solicitada n�o existe');
define('_MESSAGE',					'Mensagem');
define('_HELP_TT',					'Ajuda');
define('_YOURSITE',					'p�gina inicial');


define('_POPUP_CLOSE',				'Fecha a janela');

define('_LOGIN_PLEASE',				'Por favor, fa�a o log in');

// commentform
define('_COMMENTFORM_YOUARE',		'Voc� est� logado como');
define('_COMMENTFORM_SUBMIT',		'Envia');
define('_COMMENTFORM_COMMENT',		'Seu coment�rio');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'E-mail ou site');
define('_COMMENTFORM_REMEMBER',		'auto-completar na pr�xima visita');

// loginform
define('_LOGINFORM_NAME',			'Nome');
define('_LOGINFORM_PWD',			'Senha');
define('_LOGINFORM_YOUARE',			'Ol�, ');
define('_LOGINFORM_SHARED',			'Desativar login autom�tico');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Novo post em');
define('_ADD_CREATENEW',			'Novo post');
define('_ADD_BODY',					'Corpo do texto');
define('_ADD_TITLE',				'T�tulo');
define('_ADD_MORE',					'Texto extendido para o "leia mais&raquo;" (opcional)');
define('_ADD_CATEGORY',				'Tema');
define('_ADD_PREVIEW',				'Previs�o');
define('_ADD_DISABLE_COMMENTS',		'Desativar coment�rios');
define('_ADD_DRAFTNFUTURE',			'Rascunhos &amp; itens futuros');
define('_ADD_ADDITEM',				'Novo post');
define('_ADD_ADDNOW',				'Publicar agora');
define('_ADD_ADDLATER',				'Publicar mais tarde');
define('_ADD_PLACE_ON',				'Publicar no dia');
define('_ADD_ADDDRAFT',				'Colocar nos rascunhos');
define('_ADD_NOPASTDATES',			'');
define('_ADD_BOLD_TT',				'Negrito');
define('_ADD_ITALIC_TT',			'It�lico');
define('_ADD_HREF_TT',				'Link');
define('_ADD_MEDIA_TT',				'Imagem');
define('_ADD_PREVIEW_TT',			'Mostrar o preview');
define('_ADD_CUT_TT',				'Cortar');
define('_ADD_COPY_TT',				'Copiar');
define('_ADD_PASTE_TT',				'Colar');


// edit item form
define('_EDIT_ITEM',				'Editar post');
define('_EDIT_SUBMIT',				'Editar post');
define('_EDIT_ORIG_AUTHOR',			'Autor');
define('_EDIT_BACKTODRAFTS',		'Devolver aos rascunhos');
define('_EDIT_COMMENTSNOTE',		'(desativar os coment�rios n�o oculta os j� enviados)');

// used on delete screens
define('_DELETE_CONFIRM',			'Por favor, confirme ');
define('_DELETE_CONFIRM_BTN',		'confirma');
define('_CONFIRMTXT_ITEM',			'Voc� est� prestes a excluir o seguinte post:');
define('_CONFIRMTXT_COMMENT',		'Voc� est� prestes a excluir o seguinte coment�rio:');
define('_CONFIRMTXT_TEAM1',			'Voc� est� prestes a excluir ');
define('_CONFIRMTXT_TEAM2',			' da equipe do blog ');
define('_CONFIRMTXT_BLOG',			'O blog que voc� vai excluir �: ');
define('_WARNINGTXT_BLOGDEL',		'<b>ATEN��O!</b><br />Ao excluir um blog voc� apagar� todas os posts e todos os coment�rios deste blog.<br />Certifique-se do que est� fazendo antes de confirmar esta a��o! <br />');
define('_CONFIRMTXT_MEMBER',		'Voc� est� prestes a excluir o seguinte membro: ');
define('_CONFIRMTXT_TEMPLATE',		'Voc� est� prestes a excluir o template ');
define('_CONFIRMTXT_SKIN',			'Voc� est� prestes a excluir a skin ');
define('_CONFIRMTXT_BAN',			'Voc� est� prestes a cancelar o banimento do IP');
define('_CONFIRMTXT_CATEGORY',		'Voc� est� prestes a excluir o tema ');

// some status messages
define('_DELETED_ITEM',				'Post exclu�do');
define('_DELETED_MEMBER',			'Membro exclu�do');
define('_DELETED_COMMENT',			'Coment�rio exclu�do');
define('_DELETED_BLOG',				'Blog exclu�do');
define('_DELETED_CATEGORY',			'Tema exclu�;do');
define('_ITEM_MOVED',				'Post tranferido');
define('_ITEM_ADDED',				'Post publicado');
define('_COMMENT_UPDATED',			'Coment�rio editado');
define('_SKIN_UPDATED',				'A skin foi salva');
define('_TEMPLATE_UPDATED',			'O template foi salvo');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Por favor, n�o use palavras com mais de 90 caracteres em seus coment�rios');
define('_ERROR_COMMENT_NOCOMMENT',	'Comente');
define('_ERROR_COMMENT_NOUSERNAME',	'Usu�rio desconhecido.');
define('_ERROR_COMMENT_TOOLONG',	'Seu coment�rio � longo demais. Escreva no m�ximo 5000 caracteres.');
define('_ERROR_COMMENTS_DISABLED',	'Coment�rios para este blog est�o desabilitados.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Voc� precisa estar logado como um membro para comentar este blog');
define('_ERROR_COMMENTS_MEMBERNICK','Voc� tentou assinar o coment�rio com um nome protegido. Esta assinatura s� pode ser utilizada pelo usu�rio que a cadastrou.<br /><br />Por favor, volte � p�gina anterior e tente novamente.');
define('_ERROR_SKIN',				'Erro de skin');
define('_ERROR_ITEMCLOSED',			'Este post n�o permite coment�rios');
define('_ERROR_NOSUCHITEM',			'Este post n�o existe.');
define('_ERROR_NOSUCHBLOG',			'Este blog n�o existe.');
define('_ERROR_NOSUCHSKIN',			'Esta skin n�o existe.');
define('_ERROR_NOSUCHMEMBER',		'Este membro n�o existe.');
define('_ERROR_NOTONTEAM',			'Voc� n�o pertence � equipe deste blog.');
define('_ERROR_BADDESTBLOG',		'O blog escolhido n�o existe.');
define('_ERROR_NOTONDESTTEAM',		'N�o � poss�vel mover o post: voc� n�o pertence � equipe do blog de destino.');
define('_ERROR_NOEMPTYITEMS',		'N�o � posss�vel adicionar posts sem texto!');
define('_ERROR_BADMAILADDRESS',		'Endere�o de e-mail inv�lido');
define('_ERROR_BADNOTIFY',			'Um ou mais e-mails n�o s�o v�lidos');
define('_ERROR_BADNAME',			'O nome � inv�lido. Use apenas letras e n�meros, sem acentos e nem espa�os no in�cio ou no fim.');
define('_ERROR_NICKNAMEINUSE',		'J� existe um usu�rio com este apelido. Tente outro.');
define('_ERROR_PASSWORDMISMATCH',	'As senhas devem ser id�nticas');
define('_ERROR_PASSWORDTOOSHORT',	'A senha precisa ter no m�nimo 6 caracteres');
define('_ERROR_PASSWORDMISSING',	'Voc� n�o digitou uma senha');
define('_ERROR_REALNAMEMISSING',	'Voc� n�o digitou um nome real');
define('_ERROR_ATLEASTONEADMIN',	'� necess�rio pelo menos um super-admin que possa logar na �rea dministrativa.');
define('_ERROR_ATLEASTONEBLOGADMIN','Certifique-se de que h� pelo menos um administrador.');
define('_ERROR_ALREADYONTEAM',		'Voc� n�o pode adicionar um membro que j� pertence � equipe');
define('_ERROR_BADSHORTBLOGNAME',	'O nome resumido s&oacute pode conter a-z e 0-9, sem espa�oss');
define('_ERROR_DUPSHORTBLOGNAME',	'Outro blog j� usa este nome resumido. Escolha outro');
define('_ERROR_UPDATEFILE',			'N�o h� acesso para atualizar o arquivo. Certifique-se de que as permiss�es est�o configuradas corretamente (experimente colocar o chmod em 666). Perceba que a localiza��o � relativa � �rea administrativa, por isso voc� pode querer usar o diret&oacuterio absoluto (algo como  /seu/diret&oacuterio/do/nucleus/)');
define('_ERROR_DELDEFBLOG',			'N�o � poss�vel excluir o blog padr�o');
define('_ERROR_DELETEMEMBER',		'este membro n�o pode ser exclu�do, provavelmente porque ele � autor de posts ou coment�rios');
define('_ERROR_BADTEMPLATENAME',	'Nome de template inv�lido. Use apenas a-z e 0-9, sem espa�os');
define('_ERROR_DUPTEMPLATENAME',	'J� existe um template com este nome');
define('_ERROR_BADSKINNAME',		'Nome de skin inv�lido. Use apenas a-z e 0-9, sem espa�os');
define('_ERROR_DUPSKINNAME',		'J� existe uma skin com este nome');
define('_ERROR_DEFAULTSKIN',		'Sempre deve haver uma skin com o nome "default"');
define('_ERROR_SKINDEFDELETE',		'N�o � poss�vel excluir esta skin porque ela � usada pelo segunte blog: ');
define('_ERROR_DISALLOWED',			'Voc� n�o est� autorizado a fazer isso');
define('_ERROR_DELETEBAN',			'Erro ao tentar excluir o banimento (o ban n�o existe)');
define('_ERROR_ADDBAN',				'Erro ao tentar adiconar um banimento. O IP banido pode n�o ter sido corretamente adicionado aos seus blogs.');
define('_ERROR_BADACTION',			'Esta a��o n�o existe');
define('_ERROR_MEMBERMAILDISABLED',	'E-mail membro a membro est� desabilitado');
define('_ERROR_MEMBERCREATEDISABLED','Cria��o de contas est� desabilitada');
define('_ERROR_INCORRECTEMAIL',		'E-mail incorreto');
define('_ERROR_VOTEDBEFORE',		'Voc� j� votou neste post');
define('_ERROR_BANNED1',			'N�o � poss�vel executar a a��o porque o seu IP (');
define('_ERROR_BANNED2',			') est� banido. A raz�o para isso �: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Voc� precisa estar logado para executar esta a��o');
define('_ERROR_CONNECT',			'Erro de conex�o');
define('_ERROR_FILE_TOO_BIG',		'Arquivo grande demais!');
define('_ERROR_BADFILETYPE',		'Este tipo de arquivo n�o � permitido');
define('_ERROR_BADREQUEST',			'Ocorreu um problema no envio do arquivo');
define('_ERROR_DISALLOWEDUPLOAD',	'Voc� n�o pertence a nenhuma equipe de blog e por isso n�o pode enviar arquivos');
define('_ERROR_BADPERMISSIONS',		'Permiss�o de diret&oacuterio n�o est�o configuradas corretamente');
define('_ERROR_UPLOADMOVEP',		'Ocorreu um problema ao enviar o arquivo');
define('_ERROR_UPLOADCOPY',			'Ocorreu um problema ao copiar o arquivo');
define('_ERROR_UPLOADDUPLICATE',	'J� existe um arquivo com este nome. Renomeie antes de enviar.');
define('_ERROR_LOGINDISALLOWED',	'Voc� n�o pode logar. Tente usar outro usu�rio.');
define('_ERROR_DBCONNECT',			'N�o foi poss�vel conectar com o servidor mySQL.');
define('_ERROR_DBSELECT',			'N�o foi posss�vel acessar o banco de dados nucleus.');
define('_ERROR_NOSUCHLANGUAGE', 'Esta l�ngua n�o existe');
define('_ERROR_NOSUCHCATEGORY', 'Este tema n�o existe');
define('_ERROR_DELETELASTCATEGORY', '� preciso haver ao menos um tema');
define('_ERROR_DELETEDEFCATEGORY', 'Voc� n�o pode apagar o tema');
define('_ERROR_BADCATEGORYNAME', 'Este nome n�o pode ser usado para um tema');
define('_ERROR_DUPCATEGORYNAME', 'J� existe um tema com este nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Aviso: este n�o � um diret&oacuterio v�lido!');
define('_WARNING_NOTREADABLE',		'Aviso: este diret&oacuterio n�o pode ser lido!');
define('_WARNING_NOTWRITABLE',		'Aviso: este diret&oacuterio n�o tem permiss�o de escrita!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar um novo arquivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'arquivo');
define('_MEDIA_DIMENSIONS',			'dimens�es');
define('_MEDIA_INLINE',				'Na p�gina');
define('_MEDIA_POPUP',				'Em janela popup');
define('_UPLOAD_TITLE',				'Escolha o arquivo');
define('_UPLOAD_MSG',				'Escolha o arquivo que voc� deseja enviar e clique no bot�o "Envia".');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Conta criada. A senha ser� enviada por e-mail.');
define('_MSG_PASSWORDSENT',			'A senha foi enviada por e-mail.');
define('_MSG_LOGINAGAIN',			'Voc� precisa logar de novo, porque suas indforma��es foram alteradas');
define('_MSG_SETTINGSCHANGED',		'Configura��es alteradas');
define('_MSG_ADMINCHANGED',			'Administrador alterado');
define('_MSG_NEWBLOG',				'Novo blog criado');
define('_MSG_ACTIONLOGCLEARED',		'O log foi limpo');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'A��o n�o permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','A nova senha foi enviada para ');
define('_ACTIONLOG_TITLE',			'Arquivo de log');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpa o log');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpa o log agora');

// team management
define('_TEAM_TITLE',				'Equipe do blog ');
define('_TEAM_CURRENT',				'Equipe atual');
define('_TEAM_ADDNEW',				'Novo membro');
define('_TEAM_CHOOSEMEMBER',		'Escolha o membro');
define('_TEAM_ADMIN',				'Privil�gios de administrador? ');
define('_TEAM_ADD',					'Adicionar � equipe');
define('_TEAM_ADD_BTN',				'Adicionar � equipe');

// blogsettings
define('_EBLOG_TITLE',				'Configura��es do blog');
define('_EBLOG_TEAM_TITLE',			'Alterar equipe');
define('_EBLOG_TEAM_TEXT',			'Clique aqui para alterar a equipe deste blog.');
define('_EBLOG_SETTINGS_TITLE',		'Configura��es do blog');
define('_EBLOG_NAME',				'Nome');
define('_EBLOG_SHORTNAME',			'Nome resumido');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(use apenas a-z e 0-9, sem espa�os)');
define('_EBLOG_DESC',				'Descri��o');
define('_EBLOG_URL',				'Endere�o (http://...)');
define('_EBLOG_DEFSKIN',			'Skin padr�o');
define('_EBLOG_DEFCAT',				'Categoria padr�o');
define('_EBLOG_LINEBREAKS',			'Converter quebras de linhas?');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar coment�rios?');
define('_EBLOG_ANONYMOUS',			'Permitir coment�rios de n�o-membros?');
define('_EBLOG_NOTIFY',				'Avisar e-mails (use ; para separar)');
define('_EBLOG_NOTIFY_ON',			'Aviso ligado para');
define('_EBLOG_NOTIFY_COMMENT',		'Novos coment�rios');
define('_EBLOG_NOTIFY_KARMA',		'Novos votos de karma');
define('_EBLOG_NOTIFY_ITEM',		'Novos posts no blog');
define('_EBLOG_PING',				'Dar ping no Weblogs.com?');
define('_EBLOG_MAXCOMMENTS',		'N�mero m�ximo de coment�rios');
define('_EBLOG_UPDATE',				'Atualiza arquivo');
define('_EBLOG_OFFSET',				'Diferen�a de fuso');
define('_EBLOG_STIME',				'A hora atual no servidor �');
define('_EBLOG_BTIME',				'A hora atual no blog �');
define('_EBLOG_CHANGE',				'Salvar altera��es');
define('_EBLOG_CHANGE_BTN',			'Salvar altera��es');
define('_EBLOG_ADMIN',				'Administrador do blog');
define('_EBLOG_ADMIN_MSG',			'Voc� ter� privil�gios de administrador');
define('_EBLOG_CREATE_TITLE',		'Criar novo blog');
define('_EBLOG_CREATE_TEXT',		'Preencha os campos abaixo para criar um novo blog. <br /><br /> <b>Nota:</b> Apenas os campos necess�rios est�o listados. Se voc� quer configurar op��es extras, acesse as configura��es do blog depois de cri�-lo.');
define('_EBLOG_CREATE',				'Cria o blog!');
define('_EBLOG_CREATE_BTN',			'Cria um novo blog');
define('_EBLOG_CAT_TITLE',			'Categorias');
define('_EBLOG_CAT_NAME',			'Nome da categoria');
define('_EBLOG_CAT_DESC',			'Descri��o da categoria');
define('_EBLOG_CAT_CREATE',			'Criar nova categoria');
define('_EBLOG_CAT_UPDATE',			'Alterar cateforia');
define('_EBLOG_CAT_UPDATE_BTN',		'Alterar categoria');

// templates
define('_TEMPLATE_TITLE',			'Edita templates');
define('_TEMPLATE_AVAILABLE_TITLE',	'Templates dispon�veis');
define('_TEMPLATE_NEW_TITLE',		'Novo template');
define('_TEMPLATE_NAME',			'Nome do template');
define('_TEMPLATE_DESC',			'Descri��o do template');
define('_TEMPLATE_CREATE',			'Cria template');
define('_TEMPLATE_CREATE_BTN',		'Cria template');
define('_TEMPLATE_EDIT_TITLE',		'Edita template');
define('_TEMPLATE_BACK',			'Volta para a lista de templates');
define('_TEMPLATE_EDIT_MSG',		'Nem todas as partes do template s�o necess�rias. Deixe em branco as que n�o for utilizar.');
define('_TEMPLATE_SETTINGS',		'Configura��es do template');
define('_TEMPLATE_ITEMS',			'Posts');
define('_TEMPLATE_ITEMHEADER',		'Cabe�alhos dos posts');
define('_TEMPLATE_ITEMBODY',		'Corpo dos posts');
define('_TEMPLATE_ITEMFOOTER',		'Fim dos posts');
define('_TEMPLATE_MORELINK',		'Link para o texto extendido');
define('_TEMPLATE_NEW',				'Indica��o de novo post');
define('_TEMPLATE_COMMENTS_ANY',	'Coment�rios (se houver)');
define('_TEMPLATE_CHEADER',			'Cabe�alho dos coment�rios');
define('_TEMPLATE_CBODY',			'Corpo dos coment�rios');
define('_TEMPLATE_CFOOTER',			'Fim dos coment�rios');
define('_TEMPLATE_CONE',			'Um coment�rio');
define('_TEMPLATE_CMANY',			'Dois ou mais coment�rios');
define('_TEMPLATE_CMORE',			'Leia mais nos coment�rios');
define('_TEMPLATE_CMEXTRA',			'Extras dos membros');
define('_TEMPLATE_COMMENTS_NONE',	'Coment�rios (se n�o tiver nenhum)');
define('_TEMPLATE_CNONE',			'Nenhum coment�rio');
define('_TEMPLATE_COMMENTS_TOOMUCH','Coment�rios (se houver, mas longos demais para serem mostrados)');
define('_TEMPLATE_CTOOMUCH',		'Coment�rios demais');
define('_TEMPLATE_ARCHIVELIST',		'Listagem de arquivo');
define('_TEMPLATE_AHEADER',			'Cabe�alho do arquivo');
define('_TEMPLATE_AITEM',			'Lista de posts no arquivo');
define('_TEMPLATE_AFOOTER',			'Fim do arquivo');
define('_TEMPLATE_DATETIME',		'Data e hora');
define('_TEMPLATE_DHEADER',			'Cabe�alho da data');
define('_TEMPLATE_DFOOTER',			'Fim da data');
define('_TEMPLATE_DFORMAT',			'Formato da data');
define('_TEMPLATE_TFORMAT',			'Formato da hora');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Janelas popup para imagens');
define('_TEMPLATE_PCODE',			'C�digo das janelas popup');
define('_TEMPLATE_ICODE',			'C�digo das imagens na p�gina');
define('_TEMPLATE_MCODE',			'C�digo de link para outras m�dias');
define('_TEMPLATE_SEARCH',			'Busca');
define('_TEMPLATE_SHIGHLIGHT',		'Sublinhado');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado na busca');
define('_TEMPLATE_UPDATE',			'Atualiza');
define('_TEMPLATE_UPDATE_BTN',		'Altera template');
define('_TEMPLATE_RESET_BTN',		'Limpa');
define('_TEMPLATE_CATEGORYLIST',	'Listas de temas');
define('_TEMPLATE_CATHEADER',		'Cabe�alho da lista de temas');
define('_TEMPLATE_CATITEM',			'Item da lista de temas');
define('_TEMPLATE_CATFOOTER',		'Fim da lista de temas');

// skins
define('_SKIN_EDIT_TITLE',			'Edita skins');
define('_SKIN_AVAILABLE_TITLE',		'Skins dispon�veis');
define('_SKIN_NEW_TITLE',			'Nova skin');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descri��o');
define('_SKIN_TYPE',				'Tipo de conte�do');
define('_SKIN_CREATE',				'Cria');
define('_SKIN_CREATE_BTN',			'Cria skin');
define('_SKIN_EDITONE_TITLE',		'Edita skin');
define('_SKIN_BACK',				'Volta para a lista de skins');
define('_SKIN_PARTS_TITLE',			'Partes da skin');
define('_SKIN_PARTS_MSG',			'Nem todas as partes da skin s�o necess�rias. Deixe em branco as que n�o for utilizar.');
define('_SKIN_PART_MAIN',			'P�gina inicial');
define('_SKIN_PART_ITEM',			'Posts individuais');
define('_SKIN_PART_ALIST',			'Lista de arquivos');
define('_SKIN_PART_ARCHIVE',		'Arquivo');
define('_SKIN_PART_SEARCH',			'Busca');
define('_SKIN_PART_ERROR',			'Erro');
define('_SKIN_PART_MEMBER',			'Detalhes dos membros');
define('_SKIN_PART_POPUP',			'Janelas popups de imagem');
define('_SKIN_GENSETTINGS_TITLE',	'Configura��es gerais');
define('_SKIN_CHANGE',				'Altera');
define('_SKIN_CHANGE_BTN',			'Altera configura��es');
define('_SKIN_UPDATE_BTN',			'Atualiza skin');
define('_SKIN_RESET_BTN',			'Limpa');
define('_SKIN_EDITPART_TITLE',		'Edita skin');
define('_SKIN_GOBACK',				'Volta');
define('_SKIN_ALLOWEDVARS',			'Vari�veis dispon�veis (clique para mais informa��es):');

// global settings
define('_SETTINGS_TITLE',			'Configura��es gerais');
define('_SETTINGS_SUB_GENERAL',		'Configura��es gerais');
define('_SETTINGS_DEFBLOG',			'Blog padr�o');
define('_SETTINGS_ADMINMAIL',		'E-mail do adminstrador');
define('_SETTINGS_SITENAME',		'Nome do site');
define('_SETTINGS_SITEURL',			'Endere�o do site (deve terminar com uma barra)');
define('_SETTINGS_ADMINURL',		'Endere�o da �rea administrativa (deve terminar com uma barra)');
define('_SETTINGS_DIRS',			'Diret�rios do Nucleus');
define('_SETTINGS_MEDIADIR',		'Diret�rio da m�dia');
define('_SETTINGS_SEECONFIGPHP',	'(veja config.php)');
define('_SETTINGS_MEDIAURL',		'Endere�o da m�dia (deve terminar com uma barra)');
define('_SETTINGS_ALLOWUPLOAD',		'Permite envio de arquivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de arquivos permitidos para envio');
define('_SETTINGS_CHANGELOGIN',		'Permite que membros alterem Login/Senha');
define('_SETTINGS_COOKIES_TITLE',	'Configura��es do cookie');
define('_SETTINGS_COOKIELIFE',		'Cookie por tempo de expira��o');
define('_SETTINGS_COOKIESESSION',	'Cookie por sess�o');
define('_SETTINGS_COOKIEMONTH',		'Expira��o de um m�s');
define('_SETTINGS_COOKIEPATH',		'Local do cookie (avan�ado)');
define('_SETTINGS_COOKIEDOMAIN',	'Dom�nio do cookie (avan�ado)');
define('_SETTINGS_COOKIESECURE',	'Cookie seguro (avan�ado)');
define('_SETTINGS_LASTVISIT',		'Gravar cookies das &uacuteltimas visitas');
define('_SETTINGS_ALLOWCREATE',		'Permitir que usu�rios criem novas contas');
define('_SETTINGS_NEWLOGIN',		'Permitir login para as contas criadas por usu�rios');
define('_SETTINGS_NEWLOGIN2',		'(apenas para as novas contas criadas)');
define('_SETTINGS_MEMBERMSGS',		'Permitir servi�o membro-a-membro');
define('_SETTINGS_LANGUAGE',		'Linguagem padr�o');
define('_SETTINGS_DISABLESITE',		'Desabilitar o site');
define('_SETTINGS_DBLOGIN',			'Login do banco de dados mySQL');
define('_SETTINGS_UPDATE',			'Atualiza configura��es');
define('_SETTINGS_UPDATE_BTN',		'Atualiza configura��es');
define('_SETTINGS_DISABLEJS',		'Desabilitar barra de ferramentas em javaScript');
define('_SETTINGS_MEDIA',			'Configura��es do envio de arquivos');
define('_SETTINGS_MEDIAPREFIX',		'Colocar data no prefixo dos arquivos enviados');
define('_SETTINGS_MEMBERS',			'Configura��es dos membros');

// bans
define('_BAN_TITLE',				'Lista de IPs banidos do blog');
define('_BAN_NONE',					'Nenhum IP foi banido para este blog');
define('_BAN_NEW_TITLE',			'Banir novo IP');
define('_BAN_NEW_TEXT',				'Banir novo IP');
define('_BAN_REMOVE_TITLE',			'Remover IP banido');
define('_BAN_IPRANGE',				'IP');
define('_BAN_BLOGS',				'Que blogs?');
define('_BAN_DELETE_TITLE',			'Exclui IP banido');
define('_BAN_ALLBLOGS',				'Todos os blogs que voc� tem privil�gios de administrador.');
define('_BAN_REMOVED_TITLE',		'O IP banido foi removido');
define('_BAN_REMOVED_TEXT',			'O IP banido foi removido dos seguintes blogs:');
define('_BAN_ADD_TITLE',			'Banir novo IP');
define('_BAN_IPRANGE_TEXT',			'Escolha o raio de a��o do IP banido. Quanto menos n&uacutemeros, mais endere�os ser�o bloqueados.');
define('_BAN_BLOGS_TEXT',			'Voc� pode banir o IP de apenas um blog ou bloquear o IP de todos os blogs que voc� possui privil�gios de administrador. Escolha abaixo.');
define('_BAN_REASON_TITLE',			'Raz�o');
define('_BAN_REASON_TEXT',			'Voc� pode colocar uma raz�o para o banimento, que ser� mostrada se o IP tentar adicionar um coment�rio. Use no m�ximo 256 caracteres.');
define('_BAN_ADD_BTN',				'Banir novo IP');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensagem');
define('_LOGIN_NAME',				'Nome');
define('_LOGIN_PASSWORD',			'Senha');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Esqueceu sua senha?');

// membermanagement
define('_MEMBERS_TITLE',			'Administra��o de membros');
define('_MEMBERS_CURRENT',			'Membros');
define('_MEMBERS_NEW',				'Novo membro');
define('_MEMBERS_DISPLAY',			'Apelido');
define('_MEMBERS_DISPLAY_INFO',		'(Este � o nome que voc� usa para logar)');
define('_MEMBERS_REALNAME',			'Nome real');
define('_MEMBERS_PWD',				'Senha');
define('_MEMBERS_REPPWD',			'Repita a senha');
define('_MEMBERS_EMAIL',			'E-mail');
define('_MEMBERS_EMAIL_EDIT',		'(quando voc� altera o e-mail, uma nova senha � enviada para o novo endere�o automaticamente)');
define('_MEMBERS_URL',				'Endere�o do blog');
define('_MEMBERS_SUPERADMIN',		'Privil�gios de administrador');
define('_MEMBERS_CANLOGIN',			'Pode logar na �rea administrativa');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Novo membro');
define('_MEMBERS_EDIT',				'Perfil');
define('_MEMBERS_EDIT_BTN',			'Salvar altera��es');
define('_MEMBERS_BACKTOOVERVIEW',	'Voltar para a lista de membros');
define('_MEMBERS_LOCALE',			'L�ngua');
define('_MEMBERS_USESITELANG',		'- configura��es do site -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar');
define('_BLOGLIST_ADD',				'Novo post');
define('_BLOGLIST_TT_ADD',			'Novo post para este blog');
define('_BLOGLIST_EDIT',			'Editar posts');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Atalho');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Configura��es');
define('_BLOGLIST_TT_SETTINGS',		'Edita configura��es ou administra time');
define('_BLOGLIST_BANS',			'Banidos');
define('_BLOGLIST_TT_BANS',			'V�, adicona ou remove IPs banidos');
define('_BLOGLIST_DELETE',			'Excluir este blog');
define('_BLOGLIST_TT_DELETE',		'Exclui este blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Seus blogs');
define('_OVERVIEW_YRDRAFTS',		'Seus rascunhos');
define('_OVERVIEW_YRSETTINGS',		'Configura��es');
define('_OVERVIEW_GSETTINGS',		'Configura��es gerais');
define('_OVERVIEW_NOBLOGS',			'Voc� n�o pertence a nenhuma equipe');
define('_OVERVIEW_NODRAFTS',		'Nenhum rascunho');
define('_OVERVIEW_EDITSETTINGS',	'Alterar seu perfil...');
define('_OVERVIEW_BROWSEITEMS',		'Explora os posts...');
define('_OVERVIEW_BROWSECOMM',		'Explora seus coment�rios...');
define('_OVERVIEW_VIEWLOG',			'Ver Log...');
define('_OVERVIEW_MEMBERS',			'Altera membros...');
define('_OVERVIEW_NEWLOG',			'Cria novo blog...');
define('_OVERVIEW_SETTINGS',		'Edita configura��es...');
define('_OVERVIEW_TEMPLATES',		'Edita templates...');
define('_OVERVIEW_SKINS',			'Edita skins...');
define('_OVERVIEW_BACKUP',			'Faz backup/restaura o banco de dados...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Posts do blog'); 
define('_ITEMLIST_YOUR',			'Seus posts');

// Comments
define('_COMMENTS',					'Coment�rios');
define('_NOCOMMENTS',				'Nenhum coment�rio para este post');
define('_COMMENTS_YOUR',			'Seus coment�rios');
define('_NOCOMMENTS_YOUR',			'Voc� n�o escreveu nenhum coment�rio');

// LISTS (general)
define('_LISTS_NOMORE',				'Nenhum post encontrado');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Pr�xima');
define('_LISTS_SEARCH',				'Busca');
define('_LISTS_CHANGE',				'Altera');
define('_LISTS_PERPAGE',			'posts por p�gina');
define('_LISTS_ACTIONS',			'A��es');
define('_LISTS_DELETE',				'Exclui');
define('_LISTS_EDIT',				'Edita');
define('_LISTS_MOVE',				'Move');
define('_LISTS_CLONE',				'Duplica');
define('_LISTS_TITLE',				'T�tulo');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descri��o');
define('_LISTS_TIME',				'Time');
define('_LISTS_COMMENTS',			'Coment�rios');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Apelido');
define('_LIST_MEMBER_RNAME',		'Nome real');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Pode logar? ');
define('_LIST_MEMBER_URL',			'Site');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Banido');
define('_LIST_BAN_REASON',			'Raz�o');

// actionlist
define('_LIST_ACTION_MSG',			'Mensagem');

// commentlist
define('_LIST_COMMENT_BANIP',		'Bane IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Coment�rio');
define('_LIST_COMMENT_HOST',		'IP');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'T�tulo e texto do post');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Altera Administrador');

// edit comments
define('_EDITC_TITLE',				'Alterar coment�rios');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'De onde?');
define('_EDITC_WHEN',				'Quando?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Edita coment�rio');
define('_EDITC_MEMBER',				'membro');
define('_EDITC_NONMEMBER',			'n�o membro');

// move item
define('_MOVE_TITLE',				'Mover o post para qual blog?');
define('_MOVE_BTN',					'Mover');
