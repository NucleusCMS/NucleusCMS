<?php
// Czech Nucleus Language File
// 
// Author: Mnemonic (mnemonic@dead-code.org)
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
define('_MEDIA_VIEW',				'zobrazit');
define('_MEDIA_VIEW_TT',			'Zobrazit soubor (v nov�m okn�)');
define('_MEDIA_FILTER_APPLY',		'Pou��t filtr');
define('_MEDIA_FILTER_LABEL',		'Filtr: ');
define('_MEDIA_UPLOAD_TO',			'Nahr�t do...');
define('_MEDIA_UPLOAD_NEW',			'Nahr�t nov� soubor...');
define('_MEDIA_COLLECTION_SELECT',	'V�b�r');
define('_MEDIA_COLLECTION_TT',		'P�epnout se do t�to kategorie');
define('_MEDIA_COLLECTION_LABEL',	'Aktu�ln� kolekce:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovnat doleva');
define('_ADD_ALIGNRIGHT_TT',		'Zarovnat doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovnat na st�ed');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnout do hled�n�');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahr�v�n� selhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povolit publikov�n� do minulosti');
define('_ADD_CHANGEDATE',			'P�epsat datum/�as');
define('_BMLET_CHANGEDATE',			'P�epsat datum/�as');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzhledu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Norm�ln�');
define('_PARSER_INCMODE_SKINDIR',	'Pou��t adr. vzhledu');
define('_SKIN_INCLUDE_MODE',		'Re�im vkl�d�n�');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Z�kladn� vzhled');
define('_SETTINGS_SKINSURL',		'URL se vzhledy');
define('_SETTINGS_ACTIONSURL',		'Pln� URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nelze p�esunout v�choz� kategorii');
define('_ERROR_MOVETOSELF',			'Nelze p�esunout kategorii (c�lov� blog je stejn�, jako zdrojov� blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do kter�ho chcete p�esunout kategorii');
define('_MOVECAT_BTN',				'P�esunout kategorii');

// URLMode setting
define('_SETTINGS_URLMODE',			'Re�im URL');
define('_SETTINGS_URLMODE_NORMAL',	'Norm�ln�');
define('_SETTINGS_URLMODE_PATHINFO','Pestr�');

// Batch operations
define('_BATCH_NOSELECTION',		'Pro proveden� akce nen� nic vybr�no');
define('_BATCH_ITEMS',				'D�vkov� operace na �l�nc�ch');
define('_BATCH_CATEGORIES',			'D�vkov� operace na kategori�ch');
define('_BATCH_MEMBERS',			'D�vkov� operace na u�ivatel�ch');
define('_BATCH_TEAM',				'D�vkov� operace na �lenech t�mu');
define('_BATCH_COMMENTS',			'D�vkov� operace na koment���ch');
define('_BATCH_UNKNOWN',			'Nezn�m� d�vkov� operace: ');
define('_BATCH_EXECUTING',			'Spou�t� se');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na �l�nku');
define('_BATCH_ONCOMMENT',			'na koment��i');
define('_BATCH_ONMEMBER',			'na u�ivateli');
define('_BATCH_ONTEAM',				'na �lenovi t�mu');
define('_BATCH_SUCCESS',			'�sp�ch!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvr�te d�vkov� odstran�n�');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvr�te d�vkov� odstran�n�');
define('_BATCH_SELECTALL',			'vybrat v�e');
define('_BATCH_DESELECTALL',		'nevybrat nic');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstranit');
define('_BATCH_ITEM_MOVE',			'P�esunout');
define('_BATCH_MEMBER_DELETE',		'Odstranit');
define('_BATCH_MEMBER_SET_ADM',		'Nastavit spr�vcovsk� pr�va');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat spr�vcovsk� pr�va');
define('_BATCH_TEAM_DELETE',		'Odstranit z t�mu');
define('_BATCH_TEAM_SET_ADM',		'Nastavit spr�vcovsk� pr�va');
define('_BATCH_TEAM_UNSET_ADM',		'Odebrat spr�vcovsk� pr�va');
define('_BATCH_CAT_DELETE',			'Odstranit');
define('_BATCH_CAT_MOVE',			'P�esunout do jin�ho blogu');
define('_BATCH_COMMENT_DELETE',		'Odstranit');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'P�idat nov� �l�nek...');
define('_ADD_PLUGIN_EXTRAS',		'Nastaven� pro pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nelze vytvo�it novou kategorii');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vy�aduje nov�j�� verzi Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Zp�t na nastaven� blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybran�ch vzhled�/�ablon');
define('_SKINIE_LOCAL',				'Import z lok�ln�ho souboru:');
define('_SKINIE_NOCANDIDATES',		'V adres��i vzhled� nebyly nalezeny ��dn� polo�ky pro import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhledy a �ablony, kter� chcete exportovat');
define('_SKINIE_EXPORT_SKINS',		'Vzhledy');
define('_SKINIE_EXPORT_TEMPLATES',	'�ablony');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'P�epsat vzhledy, kter� ji� existuj� (viz konflikty jmen)');
define('_SKINIE_CONFIRM_IMPORT',	'Ano, toto chci naimportovat');
define('_SKINIE_CONFIRM_TITLE',		'Budou naimportov�ny vzhledy a �ablony');
define('_SKINIE_INFO_SKINS',		'Vzhledy v souboru:');
define('_SKINIE_INFO_TEMPLATES',	'�ablony v souboru:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v n�zvech vzhled�:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v n�zvech �ablon:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importovan� vzhledy:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importovan� �ablony::');
define('_SKINIE_DONE',				'Import dokon�en');

define('_AND',						'a');
define('_OR',						'nebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'pr�zdn� pole (klikn�te pro editaci)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Re�im vkl�d�n�:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definovan� ��sti:');

// backup
define('_BACKUPS_TITLE',			'Z�loha / obnoven�');
define('_BACKUP_TITLE',				'Z�loha');
define('_BACKUP_INTRO',				'Klikn�te na tla��tko pro vytvo�en� z�lohy Nucleus datab�ze. Budete vyzv�n k ulo�en� souboru se z�lohou. Tento soubor pot� uschovejte na bezpe�n�m m�st�.');
define('_BACKUP_ZIP_YES',			'Pokusit se pou��t kompresi');
define('_BACKUP_ZIP_NO',			'Nepou��vat kompresi');
define('_BACKUP_BTN',				'Vytvo�it z�lohu');
define('_BACKUP_NOTE',				'<b>Pozn�mka:</b> Z�lohuje se pouze obsah datab�ze. Obr�zky a nastaven� v config.php tud� <b>NEJSOU</b> sou��st� z�lohy.');
define('_RESTORE_TITLE',			'Obnovit');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova ze z�lohy <b>VYMA�E</b> st�vaj�c� data v datab�zi! Tuto akci prove�te pouze pokud jste si opravdu jist�!	<br />	<b>Pozn�mka:</b> Ujist�te se, �e verze Nucleusu, ve kter� jste provedl z�lohu, je stejn�, jako verze, kterou pou��v�te nyn�! Jinak obnova nebude fungovat.');
define('_RESTORE_INTRO',			'Zde vyberte soubor se z�lohou (bude nahr�n na server) a klikn�te na tla��tko "Obnovit" pro zah�jen� akce.');
define('_RESTORE_IMSURE',			'Ano, jsem si jist�, �e to chci ud�lat!');
define('_RESTORE_BTN',				'Obnovit ze souboru');
define('_RESTORE_WARNING',			'(ujist�te se, �e obnovujete spr�vnou z�lohu, p��padn� si nejprve zaz�lohujte st�vaj�c� data)');
define('_ERROR_BACKUP_NOTSURE',		'Mus�te za�krtnout pol��ko \'Jsem si jist�\'');
define('_RESTORE_COMPLETE',			'Obnova byla dokon�ena');

// new item notification
define('_NOTIFY_NI_MSG',			'Byl publikov�n nov� �l�nek:');
define('_NOTIFY_NI_TITLE',			'Nov� �l�nek!');
define('_NOTIFY_KV_MSG',			'Karma volba u �l�nku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Koment�� ke �l�nku:');
define('_NOTIFY_NC_TITLE',			'Nucleus koment��:');
define('_NOTIFY_USERID',			'ID u�ivatele:');
define('_NOTIFY_USER',				'U�ivatel:');
define('_NOTIFY_COMMENT',			'Koment��:');
define('_NOTIFY_VOTE',				'Volba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'�len:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdr�el jste novou zpr�vu od');
define('_MMAIL_FROMANON',			'anonymn�ho n�v�t�vn�ka');
define('_MMAIL_FROMNUC',			'Odesl�no v syst�mu Nucleus weblog v');
define('_MMAIL_TITLE',				'Zpr�va od');
define('_MMAIL_MAIL',				'Zpr�va:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'P�idat �l�nek');
define('_BMLET_EDIT',				'Upravit �l�nek');
define('_BMLET_DELETE',				'Odstranit �l�nek');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Roz���en� text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'N�hled');

// used in bookmarklet
define('_ITEM_UPDATED',				'�l�nek byl upraven');
define('_ITEM_DELETED',				'�l�nek byl odstran�n');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skute�n� chcete odstranit plugin');
define('_ERROR_NOSUCHPLUGIN',		'Takov� plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin ji� byl nainstalov�n');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, nebo jsou �patn� nastavena p��stupov� pr�va');
define('_PLUGS_NOCANDIDATES',		'��dn� pluginy nebyly nalezeny');

define('_PLUGS_TITLE_MANAGE',		'Spr�va plugin�');
define('_PLUGS_TITLE_INSTALLED',	'Moment�ln� nainstalovan�');
define('_PLUGS_TITLE_UPDATE',		'Aktualizovat seznam odb�r�');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udr�uje datab�zi odb�r� ud�lost� pro pluginy. Pokud nahrajete novou verzi pluginu, m�l byste spustit tuto aktualizaci, aby byly odb�ry obnoveny.');
define('_PLUGS_TITLE_NEW',			'Nainstalovat nov� plugin');
define('_PLUGS_ADD_TEXT',			'Dole vid�te seznam soubor� z adres��e plugin�, kter� jsou patrn� nenainstalovan� pluginy. P�ed jejich nainstalov�n�m se ujist�te, �e to jsou <strong>ur�it�</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nainstalovat plugin');
define('_BACKTOOVERVIEW',			'Zp�tky k p�ehledu');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editaci �l�nku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'P�idat r�me�ek vlevo');
define('_ADD_RIGHT_TT',				'P�idat r�me�ek vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nov� kategorie...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginy');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. velikost souboru pro nahr�n� (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povolit neregistrovan�m pos�lat zpr�vy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chr�nit jm�na �len�');

// overview screen
define('_OVERVIEW_PLUGINS',			'Spr�va plugin�...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrace nov�ho �lena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Va�e emailov� adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nem�te spr�vcovsk� pr�va pro ��dn� z blog�, kter� maj� p��jemce ve sv�m t�mu. Proto nesm�te nahr�vat soubory do adres��e t�to osoby.');

// plugin list
define('_LISTS_INFO',				'Informace');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verze:');
define('_LIST_PLUGS_SITE',			'Nav�t�vit str�nku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odb�ratel t�chto ud�lost�:');
define('_LIST_PLUGS_UP',			'nahoru');
define('_LIST_PLUGS_DOWN',			'dol�');
define('_LIST_PLUGS_UNINSTALL',		'odinstalovat');
define('_LIST_PLUGS_ADMIN',			'spr�vce');
define('_LIST_PLUGS_OPTIONS',		'upravit&nbsp;nastaven�');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nem� ��dn� nastaven�');
define('_PLUGS_BACK',				'Zp�t na p�ehled plugin�');
define('_PLUGS_SAVE',				'Ulo�it nastaven�');
define('_PLUGS_OPTIONS_UPDATED',	'Nastaven� pluginu byla upravena');

define('_OVERVIEW_MANAGEMENT',		'Spr�va');
define('_OVERVIEW_MANAGE',			'Spr�va Nucleusu...');
define('_MANAGE_GENERAL',			'Obecn� nastaven�');
define('_MANAGE_SKINS',				'Vzhled a �ablony');
define('_MANAGE_EXTRA',				'Extra volby');

define('_BACKTOMANAGE',				'Zp�t na spr�vu Nucleusu');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'Odhl�sit se');
define('_LOGIN',					'P�ihl�sit se');
define('_YES',						'Ano');
define('_NO',						'Ne');
define('_SUBMIT',					'Odeslat');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Zp�t');
define('_NOTLOGGEDIN',				'Nejste p�ihl�en');
define('_LOGGEDINAS',				'P�ihl�en jako');
define('_ADMINHOME',				'Spr�vce');
define('_NAME',						'Jm�no');
define('_BACKHOME',					'Zp�t na spr�vcovskou str�nku');
define('_BADACTION',				'Byla po�adov�na neexistuj�c� akce');
define('_MESSAGE',					'Zpr�va');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Va�e str�nka');


define('_POPUP_CLOSE',				'Zav��t okno');

define('_LOGIN_PLEASE',				'Pros�m, nejprve se p�ihla�te');

// commentform
define('_COMMENTFORM_YOUARE',		'Jste');
define('_COMMENTFORM_SUBMIT',		'P�idat koment��');
define('_COMMENTFORM_COMMENT',		'V� koment��');
define('_COMMENTFORM_NAME',			'Jm�no');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamatuj si mne');

// loginform
define('_LOGINFORM_NAME',			'Jm�no');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'P�ihl�en jako');
define('_LOGINFORM_SHARED',			'Sd�len� po��ta�');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat zpr�vu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hled�n�');

// add item form
define('_ADD_ADDTO',				'P�idat nov� �l�nek do');
define('_ADD_CREATENEW',			'Vytvo�it nov� �l�nek');
define('_ADD_BODY',					'Text');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Roz���en� text (voliteln�)');
define('_ADD_CATEGORY',				'Kategorie');
define('_ADD_PREVIEW',				'N�hled');
define('_ADD_DISABLE_COMMENTS',		'Zak�zat koment��e?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a �l�nky pro pozd�j�� publikov�n�');
define('_ADD_ADDITEM',				'P�idat �l�nek');
define('_ADD_ADDNOW',				'P�idat nyn�');
define('_ADD_ADDLATER',				'P�idat pozd�ji');
define('_ADD_PLACE_ON',				'Um�stit na');
define('_ADD_ADDDRAFT',				'P�idat mezi koncepty');
define('_ADD_NOPASTDATES',			'(data a �asy v minulosti NEJSOU platn�, v tom p��pad� bude pou�it aktu�ln� �as)');
define('_ADD_BOLD_TT',				'Tu�n�');
define('_ADD_ITALIC_TT',			'Kurz�va');
define('_ADD_HREF_TT',				'Vytvo�it odkaz');
define('_ADD_MEDIA_TT',				'P�idat obr�zek');
define('_ADD_PREVIEW_TT',			'Zobrazit/skr�t n�hled');
define('_ADD_CUT_TT',				'Vyjmout');
define('_ADD_COPY_TT',				'Kop�rovat');
define('_ADD_PASTE_TT',				'Vlo�it');


// edit item form
define('_EDIT_ITEM',				'Upravit �l�nek');
define('_EDIT_SUBMIT',				'Upravit �l�nek');
define('_EDIT_ORIG_AUTHOR',			'P�vodn� autor');
define('_EDIT_BACKTODRAFTS',		'P�idat zp�tky mezi koncepty');
define('_EDIT_COMMENTSNOTE',		'(pozn�mka: zak�z�n� koment��� _neskryje_ d��ve p�idan� koment��e)');

// used on delete screens
define('_DELETE_CONFIRM',			'Pros�m, potvr�te odstran�n�');
define('_DELETE_CONFIRM_BTN',		'Potvrzen� odstran�n�');
define('_CONFIRMTXT_ITEM',			'Chyst�te se odstranit n�sleduj�c� �l�nek:');
define('_CONFIRMTXT_COMMENT',		'Chyst�te se odstranit n�sleduj�c� koment��:');
define('_CONFIRMTXT_TEAM1',			'Chyst�te se odstranit u�ivatele ');
define('_CONFIRMTXT_TEAM2',			' z t�mu pro blog ');
define('_CONFIRMTXT_BLOG',			'Blog, kter� hodl�te odstranit, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstran�n�m blogu dojde k vymaz�n� V�ECH �l�nk� tohoto blogu a v�ech koment���. Pros�m, potvr�te, �e to OPRAVDU chcete ud�lat!<br />B�hem odstra�ov�n� blogu nep�eru�ujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chyst�te se odstranit profil n�sleduj�c�ho �lena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chyst�te se odstranit �ablonu ');
define('_CONFIRMTXT_SKIN',			'Chyst�te se odstranit vzhled ');
define('_CONFIRMTXT_BAN',			'Chyst�te se odstranit omezen� p��stupu pro ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chyst�te se odstranit kategorii ');

// some status messages
define('_DELETED_ITEM',				'�l�nek odstran�n');
define('_DELETED_MEMBER',			'Reg. u�ivatel odstran�n');
define('_DELETED_COMMENT',			'Koment�� odstran�n');
define('_DELETED_BLOG',				'Blog odstran�n');
define('_DELETED_CATEGORY',			'Kategorie odstran�na');
define('_ITEM_MOVED',				'�l�nek p�esunut');
define('_ITEM_ADDED',				'�l�nek p�id�n');
define('_COMMENT_UPDATED',			'Koment�� upraven');
define('_SKIN_UPDATED',				'Vzhled byl ulo�en');
define('_TEMPLATE_UPDATED',			'�ablona byla ulo�ena');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Pros�m, v koment���ch nepou��vejte slova del�� ne� 90 znak�');
define('_ERROR_COMMENT_NOCOMMENT',	'Pros�m, vlo�te koment��');
define('_ERROR_COMMENT_NOUSERNAME',	'�patn� u�ivatelsk� jm�no');
define('_ERROR_COMMENT_TOOLONG',	'V� koment�� je p��li� dlouh� (max. 5000 znak�)');
define('_ERROR_COMMENTS_DISABLED',	'Koment��e pro tento blog jsou moment�ln� zak�z�ny.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Abyste mohl p�id�vat koment��e do tohoto blogu, mus�te b�t p�ihl�en');
define('_ERROR_COMMENTS_MEMBERNICK','Jm�no, pod kter�m chcete odeslat koment��, pou��v� jin� registrovan� u�ivatel. Pou�ijte n�jak� jin�.');
define('_ERROR_SKIN',				'Chyba v definici vzhledu');
define('_ERROR_ITEMCLOSED',			'Tento �l�nek byl uzav�en. U� nen� mo�n� k n�mu p�id�vat koment��e ani hlasovat');
define('_ERROR_NOSUCHITEM',			'�l�nek nenalezen');
define('_ERROR_NOSUCHBLOG',			'Blog nenalezen');
define('_ERROR_NOSUCHSKIN',			'Vzhled nenalezen');
define('_ERROR_NOSUCHMEMBER',		'Registrovan� u�ivatel nenalezen');
define('_ERROR_NOTONTEAM',			'Nejste �lenem t�mu tohoto blogu');
define('_ERROR_BADDESTBLOG',		'C�lov� blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nelze p�esunout �l�nek, proto�e nejste �lenem t�mu c�lov�ho blogu');
define('_ERROR_NOEMPTYITEMS',		'Nelze p�idat pr�zdn� �l�nek!');
define('_ERROR_BADMAILADDRESS',		'Emailov� adresa nen� platn�');
define('_ERROR_BADNOTIFY',			'Jedna nebo v�ce z udan�ch adres pro oznamov�n� nen� platn� emailov� adresa');
define('_ERROR_BADNAME',			'Jm�no nen� platn� (jsou dovoleny pouze znaky a-z a 0-9, ��dn� mezery na za��tku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Tuto p�ezd�vku ji� pou��v� jin� registrovan� �len');
define('_ERROR_PASSWORDMISMATCH',	'Hesla musej� b�t stejn�');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by m�lo m�t alespo� 6 znak�');
define('_ERROR_PASSWORDMISSING',	'Heslo nesm� b�t pr�zdn�');
define('_ERROR_REALNAMEMISSING',	'Mus�te vlo�it skute�n� jm�no');
define('_ERROR_ATLEASTONEADMIN',	'M�l by b�t v�dy aspo� jeden super-spr�vce, kter� se m�e p�ihl�sit do spr�vcovsk� sekce.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykon�n� t�to akce by zp�sobilo, �e by v� blog nem�l kdo spravovat.  Ujist�te se, �e v�dy existuje alespo� jeden spr�vce.');
define('_ERROR_ALREADYONTEAM',		'Nem�ete p�idat u�ivatele, kter� u� je �lenem t�mu');
define('_ERROR_BADSHORTBLOGNAME',	'Kr�tk� jm�no blogu by m�lo obsahovat jen znaky a-z a 0-9, bez mezer');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto kr�tk� jm�no ji� pou��v� jin� blog. Tato jm�na musej� b�t unik�tn�.');
define('_ERROR_UPDATEFILE',			'Nelze zapisovat to update-souboru. Ujist�te se, �e jsou spr�vn� nastavena p��stupov� pr�va (zkuste chmod 666). Tak� pozor na to, �e um�st�n� je relativn� k adres��i spr�vcovsk� oblasti, tak�e byste mohl zkusit absolutn� cestu (n�co jako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nelze odstranit v�choz� blog');
define('_ERROR_DELETEMEMBER',		'Tento u�ivatel nem�e b�t odstran�n. Patrn� proto�e je autorem n�jak�ch �l�nk�, nebo koment���.');
define('_ERROR_BADTEMPLATENAME',	'Neplatn� jm�no �ablony. Pou�ijte pouze znaky a-z a 0-9, ��dn� mezery.');
define('_ERROR_DUPTEMPLATENAME',	'Ji� existuje �ablona s t�mto n�zvem.');
define('_ERROR_BADSKINNAME',		'Neplatn� jm�no vzhledu (pou�ijte pouze znaky a-z a 0-9, ��dn� mezery)');
define('_ERROR_DUPSKINNAME',		'Ji� existuje vzhled s t�mto n�zvem.');
define('_ERROR_DEFAULTSKIN',		'Vzhled s n�zvem "default" mus� b�t v�dy dostupn�.');
define('_ERROR_SKINDEFDELETE',		'Nelze odstranit vzhled, proto�e �e to v�choz� vzhled pro n�sleduj�c� blog: ');
define('_ERROR_DISALLOWED',			'Promi�te, ale nejste opr�vn�n prov�d�t tuto akci.');
define('_ERROR_DELETEBAN',			'Chyba p�i odstra�ov�n� omezen� p��stupu (omezen� p��stupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba p�i p�id�v�n� omezen� p��stupu. Omezen� p��stupu asi nebylo korektn� p�id�no do v�ech blog�.');
define('_ERROR_BADACTION',			'Po�adovan� akce neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailov� zpr�vy mezi �leny jsou zak�z�ny.');
define('_ERROR_MEMBERCREATEDISABLED','Vytv��en� u�ivatelsk�ch kont je zak�z�no.');
define('_ERROR_INCORRECTEMAIL',		'�patn� mailov� adresa');
define('_ERROR_VOTEDBEFORE',		'Pro tento �l�nek u� jste hlasoval');
define('_ERROR_BANNED1',			'Akci nelze vykonat, proto�e v�m (rozsah adres ');
define('_ERROR_BANNED2',			') byl omezen p��stup. Zpr�va byla: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Abyste mohl vykonat tuto akci, mus�te se p�ihl�sit.');
define('_ERROR_CONNECT',			'Chyba spojen�');
define('_ERROR_FILE_TOO_BIG',		'Soubor je p��li� velk�!');
define('_ERROR_BADFILETYPE',		'Promi�te, ale tento typ souboru nen� povolen.');
define('_ERROR_BADREQUEST',			'�patn� po�adavek pro nahr�n� souboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nejste �lenem t�mu ��dn�ho blogu, a proto nem�ete nahr�vat soubory.');
define('_ERROR_BADPERMISSIONS',		'Pr�va pro soubor/adres�� nejsou spr�vn� nastavena');
define('_ERROR_UPLOADMOVEP',		'Chyba p�i p�esunu nahran�ho souboru');
define('_ERROR_UPLOADCOPY',			'Chyba p�i kop�rov�n� souboru');
define('_ERROR_UPLOADDUPLICATE',	'Soubor s t�mto n�zvem ji� existuje. P�ed nahr�n�m ho zkuste p�ejmenovat.');
define('_ERROR_LOGINDISALLOWED',	'Promi�te, ale nem�ete se p�ihl�sit do spr�vcovsk� oblasti. Nicm�n� m�ete se p�ihl�sit jako jin� u�ivatel.');
define('_ERROR_DBCONNECT',			'Nelze se p�ipojit k mySQL serveru');
define('_ERROR_DBSELECT',			'Nelze vybrat datab�zi nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykov� soubor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Takov� kategorie neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Mus� existovat alespo� jedna kategorie');
define('_ERROR_DELETEDEFCATEGORY',	'Nelze odstranit v�choz� kategorii');
define('_ERROR_BADCATEGORYNAME',	'�patn� n�zev kategorie');
define('_ERROR_DUPCATEGORYNAME',	'Kategorie s t�mto n�zvem u� existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktu�ln� hodnota nen� adres��!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktu�ln� hodnota nen� adres�� pro �ten�!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktu�ln� hodnota NEN� adres��, do kter�ho lze zapisovat!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahr�t nov� soubor');
define('_MEDIA_MODIFIED',			'modifikov�n');
define('_MEDIA_FILENAME',			'n�zev souboru');
define('_MEDIA_DIMENSIONS',			'rozm�ry');
define('_MEDIA_INLINE',				'Uvnit�');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvolte soubor');
define('_UPLOAD_MSG',				'Vyberte soubor pro nahr�n�, a potom stiskn�te tla��tko \'Nahr�t\'.');
define('_UPLOAD_BUTTON',			'Nahr�t');

// some status messages
define('_MSG_ACCOUNTCREATED',		'��et byl vytvo�en. Heslo obdr��te emailem.');
define('_MSG_PASSWORDSENT',			'Heslo v�m bylo odesl�no emailem.');
define('_MSG_LOGINAGAIN',			'Budete se muset znovu p�ihl�sit, proto�e va�e �daje byly zm�n�ny.');
define('_MSG_SETTINGSCHANGED',		'Nastaven� zm�n�na');
define('_MSG_ADMINCHANGED',			'Spr�vce zm�n�n');
define('_MSG_NEWBLOG',				'Nov� blog byl vytvo�en');
define('_MSG_ACTIONLOGCLEARED',		'Log akc� byl smaz�n');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolen� akce: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odesl�no nov� heslo pro ');
define('_ACTIONLOG_TITLE',			'Log akc�');
define('_ACTIONLOG_CLEAR_TITLE',	'Smazat log akc�');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymazat log akc�');

// team management
define('_TEAM_TITLE',				'Spr�va t�mu pro blog ');
define('_TEAM_CURRENT',				'Aktu�ln� t�m');
define('_TEAM_ADDNEW',				'P�idat �lena do t�mu');
define('_TEAM_CHOOSEMEMBER',		'Zvolte �lena');
define('_TEAM_ADMIN',				'Spr�vcovsk� pr�va? ');
define('_TEAM_ADD',					'P�idat do t�mu');
define('_TEAM_ADD_BTN',				'P�idat do t�mu');

// blogsettings
define('_EBLOG_TITLE',				'Upravit nastaven� blogu');
define('_EBLOG_TEAM_TITLE',			'Upravit t�m');
define('_EBLOG_TEAM_TEXT',			'Klikn�te zde pro �pravu t�mu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastaven� blogu');
define('_EBLOG_NAME',				'Jm�no blogu');
define('_EBLOG_SHORTNAME',			'Kr�tk� jm�no blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(pouze znaky a-z bez mezer)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'V�choz� vzhled');
define('_EBLOG_DEFCAT',				'V�choz� kategorie');
define('_EBLOG_LINEBREAKS',			'P�ev�d�t od��dkov�n�');
define('_EBLOG_DISABLECOMMENTS',	'Povolit koment��e?<br /><small>(Ur�uje, zda lze p�id�vat koment��e)</small>');
define('_EBLOG_ANONYMOUS',			'Povolit koment��e od neregistrovan�ch n�v�t�vn�k�?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pro oznamov�n� (pou�ijte ; jako odd�lova�)');
define('_EBLOG_NOTIFY_ON',			'Oznamovat zasl�n�');
define('_EBLOG_NOTIFY_COMMENT',		'Nov�ch koment���');
define('_EBLOG_NOTIFY_KARMA',		'Nov�ch karma hlas�');
define('_EBLOG_NOTIFY_ITEM',		'Nov�ch �l�nk� blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com p�i zm�n�ch?');
define('_EBLOG_MAXCOMMENTS',		'Maxim�ln� po�et koment���');
define('_EBLOG_UPDATE',				'Zapsat zm�ny do souboru');
define('_EBLOG_OFFSET',				'�asov� posun');
define('_EBLOG_STIME',				'Aktu�ln� �as serveru je');
define('_EBLOG_BTIME',				'Aktu�ln� �as blogu je');
define('_EBLOG_CHANGE',				'Zm�nit nastaven�');
define('_EBLOG_CHANGE_BTN',			'Zm�nit nastaven�');
define('_EBLOG_ADMIN',				'Spr�vce blogu');
define('_EBLOG_ADMIN_MSG',			'Obdr��te spr�vcovsk� pr�va');
define('_EBLOG_CREATE_TITLE',		'Vytvo�it nov� blog');
define('_EBLOG_CREATE_TEXT',		'Pro vytvo�en� nov�ho blogu vypl�te n�sleduj�c� formul��. <br /><br /> <b>Pozn�mka:</b> Jsou zde vyps�ny pouze nejnutn�j�� volby. Pokud chcete zm�nit dal�� nastaven�, po vytvo�en� blogu nav�tivte str�nku s vlastnostmi blogu.');
define('_EBLOG_CREATE',				'Vytvo�it!');
define('_EBLOG_CREATE_BTN',			'Vytvo�it blog');
define('_EBLOG_CAT_TITLE',			'Kategorie');
define('_EBLOG_CAT_NAME',			'N�zev kategorie');
define('_EBLOG_CAT_DESC',			'Popis kategorie');
define('_EBLOG_CAT_CREATE',			'Vytvo�it novou kategorii');
define('_EBLOG_CAT_UPDATE',			'Upravit kategorii');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravit kategorii');

// templates
define('_TEMPLATE_TITLE',			'Upravit �ablony');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupn� �ablony');
define('_TEMPLATE_NEW_TITLE',		'Nov� �ablona');
define('_TEMPLATE_NAME',			'N�zev �ablony');
define('_TEMPLATE_DESC',			'Popis �ablony');
define('_TEMPLATE_CREATE',			'Vytvo�it �ablonu');
define('_TEMPLATE_CREATE_BTN',		'Vytvo�it �ablonu');
define('_TEMPLATE_EDIT_TITLE',		'Upravit �ablonu');
define('_TEMPLATE_BACK',			'Zp�t na p�ehled �ablon');
define('_TEMPLATE_EDIT_MSG',		'Ne v�echny ��sti �ablony jsou vy�adov�ny. Nepot�ebn� ��sti nechte pr�zdn�.');
define('_TEMPLATE_SETTINGS',		'Nastaven� �ablony');
define('_TEMPLATE_ITEMS',			'�l�nky');
define('_TEMPLATE_ITEMHEADER',		'Hlavi�ka �l�nku');
define('_TEMPLATE_ITEMBODY',		'T�lo �l�nku');
define('_TEMPLATE_ITEMFOOTER',		'Pati�ka �l�nku');
define('_TEMPLATE_MORELINK',		'Odkaz na roz�i�uj�c� text');
define('_TEMPLATE_NEW',				'Ozna�en� nov�ho �l�nku');
define('_TEMPLATE_COMMENTS_ANY',	'Koment��e (pokud jsou)');
define('_TEMPLATE_CHEADER',			'Hlavi�ka koment��e');
define('_TEMPLATE_CBODY',			'T�lo koment��e');
define('_TEMPLATE_CFOOTER',			'Pati�ka koment��e');
define('_TEMPLATE_CONE',			'Jeden koment��');
define('_TEMPLATE_CMANY',			'Dva (a v�ce) koment���');
define('_TEMPLATE_CMORE',			'\'��st v�ce\' u koment���');
define('_TEMPLATE_CMEXTRA',			'Dal�� �daje jen pro �leny');
define('_TEMPLATE_COMMENTS_NONE',	'Koment��e (nejsou-li ��dn�)');
define('_TEMPLATE_CNONE',			'��dn� koment��e');
define('_TEMPLATE_COMMENTS_TOOMUCH','Koment��e (pokud jsou, ale je jich v�c, ne� se d� zobrazit p��mo)');
define('_TEMPLATE_CTOOMUCH',		'P��li� mnoho koment���');
define('_TEMPLATE_ARCHIVELIST',		'Seznam archiv�');
define('_TEMPLATE_AHEADER',			'Hlavi�ka seznamu archiv�');
define('_TEMPLATE_AITEM',			'Polo�ka seznamu archiv�');
define('_TEMPLATE_AFOOTER',			'Pati�ka seznamu archiv�');
define('_TEMPLATE_DATETIME',		'Datum a �as');
define('_TEMPLATE_DHEADER',			'Hlavi�ka datumu');
define('_TEMPLATE_DFOOTER',			'Pati�ka datumu');
define('_TEMPLATE_DFORMAT',			'Form�t datumu');
define('_TEMPLATE_TFORMAT',			'Form�t �asu');
define('_TEMPLATE_LOCALE',			'M�stn� nastaven�');
define('_TEMPLATE_IMAGE',			'Okna s obr�zkem');
define('_TEMPLATE_PCODE',			'K�d odkazu pro okna s obr�zkem');
define('_TEMPLATE_ICODE',			'K�d pro vlo�en� obr�zek');
define('_TEMPLATE_MCODE',			'K�d odkazu na soubor m�di�');
define('_TEMPLATE_SEARCH',			'Hled�n�');
define('_TEMPLATE_SHIGHLIGHT',		'Zv�razn�n�');
define('_TEMPLATE_SNOTFOUND',		'P�i hled�n� nebylo nic nalezeno');
define('_TEMPLATE_UPDATE',			'Upravit');
define('_TEMPLATE_UPDATE_BTN',		'Upravit �ablonu');
define('_TEMPLATE_RESET_BTN',		'P�vodn� data');
define('_TEMPLATE_CATEGORYLIST',	'Seznamy kategori�');
define('_TEMPLATE_CATHEADER',		'Hlavi�ka seznamu kategori�');
define('_TEMPLATE_CATITEM',			'Polo�ka seznamu kategori�');
define('_TEMPLATE_CATFOOTER',		'Pati�ka seznamu kategori�');

// skins
define('_SKIN_EDIT_TITLE',			'Upravit vzhledy');
define('_SKIN_AVAILABLE_TITLE',		'Dostupn� vzhledy');
define('_SKIN_NEW_TITLE',			'Nov� vzhled');
define('_SKIN_NAME',				'N�zev');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvo�it');
define('_SKIN_CREATE_BTN',			'Vytvo�it vzhled');
define('_SKIN_EDITONE_TITLE',		'Upravit vzhled');
define('_SKIN_BACK',				'Zp�t na p�ehled vzhled�');
define('_SKIN_PARTS_TITLE',			'��sti vzhledu');
define('_SKIN_PARTS_MSG',			'Pro ka�d� vzhled nejsou pot�eba v�echny typy. Ty, kter� nepot�ebujete, nechte pr�zdn�. Zvolte typ vzhledu, kter� chcete upravit::');
define('_SKIN_PART_MAIN',			'Hlavn� p�ehled');
define('_SKIN_PART_ITEM',			'Str�nky �l�nku');
define('_SKIN_PART_ALIST',			'Seznam archiv�');
define('_SKIN_PART_ARCHIVE',		'Archiv');
define('_SKIN_PART_SEARCH',			'Hled�n�');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. u�ivatele');
define('_SKIN_PART_POPUP',			'Okna s obr�zkem');
define('_SKIN_GENSETTINGS_TITLE',	'Obecn� nastaven�');
define('_SKIN_CHANGE',				'Zm�nit');
define('_SKIN_CHANGE_BTN',			'Zm�nit tato nastaven�');
define('_SKIN_UPDATE_BTN',			'Ulo�it vzhled');
define('_SKIN_RESET_BTN',			'P�vodn� data');
define('_SKIN_EDITPART_TITLE',		'Upravit vzhled');
define('_SKIN_GOBACK',				'Zp�t');
define('_SKIN_ALLOWEDVARS',			'Dostupn� prom�nn� (klikn�te pro bli��� informace):');

// global settings
define('_SETTINGS_TITLE',			'Obecn� nastaven�');
define('_SETTINGS_SUB_GENERAL',		'Obecn� nastaven�');
define('_SETTINGS_DEFBLOG',			'V�choz� blog');
define('_SETTINGS_ADMINMAIL',		'Email spr�vce');
define('_SETTINGS_SITENAME',		'N�zev str�nky');
define('_SETTINGS_SITEURL',			'URL str�nky (m�lo by kon�it lom�tkem)');
define('_SETTINGS_ADMINURL',		'URL spr�vcovsk� oblasti (m�lo by kon�it lom�tkem)');
define('_SETTINGS_DIRS',			'Adres��e Nucleusu');
define('_SETTINGS_MEDIADIR',		'Adres�� s m�dii');
define('_SETTINGS_SEECONFIGPHP',	'(viz config.php)');
define('_SETTINGS_MEDIAURL',		'URL m�di� (m�lo by kon�it lom�tkem)');
define('_SETTINGS_ALLOWUPLOAD',		'Povolit nahr�v�n� (upload) soubor�?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy soubor�, kter� lze nahr�t');
define('_SETTINGS_CHANGELOGIN',		'Povolit registrovan�m u�ivatel�m m�nit jm�no/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastaven� cookies');
define('_SETTINGS_COOKIELIFE',		'Doba �ivotnosti p�ihla�ovac�ho cookie');
define('_SETTINGS_COOKIESESSION',	'Jednor�zov� cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'M�s�c');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokro�il�)');
define('_SETTINGS_COOKIEDOMAIN',	'Dom�na cookie (pokro�il�)');
define('_SETTINGS_COOKIESECURE',	'Zabezpe�n� cookie (pokro�il�)');
define('_SETTINGS_LASTVISIT',		'Ukl�dat cookies posledn� n�v�t�vy');
define('_SETTINGS_ALLOWCREATE',		'Povolit n�v�t�vn�k�m vytvo�it si registrovan� ��et');
define('_SETTINGS_NEWLOGIN',		'Povolit p�ihl�en� z ��t�, vytvo�en�ch n�v�t�vn�ky');
define('_SETTINGS_NEWLOGIN2',		'(pouze pro nov� vytvo�en� ��ty)');
define('_SETTINGS_MEMBERMSGS',		'Povolit slu�by mezi �leny');
define('_SETTINGS_LANGUAGE',		'V�choz� jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnout str�nku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Datab�ze');
define('_SETTINGS_UPDATE',			'Ulo�it nastaven�');
define('_SETTINGS_UPDATE_BTN',		'Ulo�it nastaven�');
define('_SETTINGS_DISABLEJS',		'Zak�zat JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastaven� pro m�dia/nahr�v�n� soubor�');
define('_SETTINGS_MEDIAPREFIX',		'Nahran�m soubor�m p�idat p�ed jm�no datum');
define('_SETTINGS_MEMBERS',			'Nastaven� registrovan�ch u�ivatel�');

// bans
define('_BAN_TITLE',				'Seznam omezen� p��stupu pro');
define('_BAN_NONE',					'Tento blog nem� ��dn� omezen� p��stupu');
define('_BAN_NEW_TITLE',			'P�idat nov� omezen� p��stupu');
define('_BAN_NEW_TEXT',				'P�idat omezen�');
define('_BAN_REMOVE_TITLE',			'Odstranit omezen�');
define('_BAN_IPRANGE',				'Rozsah IP adres');
define('_BAN_BLOGS',				'Kter� blogy?');
define('_BAN_DELETE_TITLE',			'Odstranit omezen�');
define('_BAN_ALLBLOGS',				'V�echny blogy, ke kter�m m�te spr�vcovsk� pr�va.');
define('_BAN_REMOVED_TITLE',		'Omezen� p��stupu bylo odstran�no');
define('_BAN_REMOVED_TEXT',			'Bylo odstran�no omezen� p��stupu pro n�sleduj�c� blogy:');
define('_BAN_ADD_TITLE',			'P�idat omezen� p��stupu');
define('_BAN_IPRANGE_TEXT',			'Zadejte rozsah IP adres, kter� chcete blokovat. ��m men�� ��sla, t�m v�ce adres bude blokov�no.');
define('_BAN_BLOGS_TEXT',			'M�ete zablokovat rozsah IP adres pouze pro jeden blog, nebo pro v�echny blogy, ke kter�m m�te spr�vcovsk� pr�va.');
define('_BAN_REASON_TITLE',			'D�vod');
define('_BAN_REASON_TEXT',			'M�ete zadat d�vod omezen� p��stupu, kter� bude zobrazen, pokud se vlastn�k blokovan� IP adresy pokus� p�idat koment��, nebo odeslat karma hlas. Maxim�ln� d�lka je 256 znak�.');
define('_BAN_ADD_BTN',				'P�idat omezen�');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Zpr�va');
define('_LOGIN_NAME',				'Jm�no');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zapomn�l jste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Spr�va registrovan�ch u�ivatel�');
define('_MEMBERS_CURRENT',			'Aktu�ln� u�ivatel�');
define('_MEMBERS_NEW',				'Nov� u�ivatel');
define('_MEMBERS_DISPLAY',			'Zobrazovan� jm�no');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je jm�no, pod kter�m se p�ihla�ujete)');
define('_MEMBERS_REALNAME',			'Skute�n� jm�no');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakovat heslo');
define('_MEMBERS_EMAIL',			'Emailov� adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Pokud zm�n�te emailovou adresu, bude v�m na ni automaticky odesl�no nov� heslo)');
define('_MEMBERS_URL',				'Adresa webov� str�nky (URL)');
define('_MEMBERS_SUPERADMIN',		'Spr�vcovsk� pr�va');
define('_MEMBERS_CANLOGIN',			'M�e se p�ihl�sit do spr�vcovsk� oblasti');
define('_MEMBERS_NOTES',			'Pozn�mky');
define('_MEMBERS_NEW_BTN',			'P�idat u�ivatele');
define('_MEMBERS_EDIT',				'Upravit u�ivatele');
define('_MEMBERS_EDIT_BTN',			'Ulo�it nastaven�');
define('_MEMBERS_BACKTOOVERVIEW',	'Zp�t na p�ehled u�ivatel�');
define('_MEMBERS_LOCALE',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- v�choz� jazyk str�nky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Nav�t�vit str�nku');
define('_BLOGLIST_ADD',				'P�idat �l�nek');
define('_BLOGLIST_TT_ADD',			'P�idat nov� �l�nek do tohoto blogu');
define('_BLOGLIST_EDIT',			'Upravit/odstranit �l�nky');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastaven�');
define('_BLOGLIST_TT_SETTINGS',		'Upravit nastaven� nebo spravovat t�m');
define('_BLOGLIST_BANS',			'Omezen� p��stupu');
define('_BLOGLIST_TT_BANS',			'Zobrazit, p�idat nebo odstranit blokovan� IP adresy');
define('_BLOGLIST_DELETE',			'Odstranit v�e');
define('_BLOGLIST_TT_DELETE',		'Odstranit tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Va�e blogy');
define('_OVERVIEW_YRDRAFTS',		'Va�e koncepty');
define('_OVERVIEW_YRSETTINGS',		'Va�e nastaven�');
define('_OVERVIEW_GSETTINGS',		'Obecn� nastaven�');
define('_OVERVIEW_NOBLOGS',			'Nejste �lenem t�mu ��dn�ho z blog�');
define('_OVERVIEW_NODRAFTS',		'��dn� koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravit va�e nastaven�...');
define('_OVERVIEW_BROWSEITEMS',		'Prohl�et va�e �l�nky...');
define('_OVERVIEW_BROWSECOMM',		'Prohl�et va�e koment��e...');
define('_OVERVIEW_VIEWLOG',			'Prohl�et seznam akc�...');
define('_OVERVIEW_MEMBERS',			'Spr�va reg. u�ivatel�...');
define('_OVERVIEW_NEWLOG',			'Vytvo�it nov� blog...');
define('_OVERVIEW_SETTINGS',		'Upravit nastaven�...');
define('_OVERVIEW_TEMPLATES',		'Upravit �ablony...');
define('_OVERVIEW_SKINS',			'Upravit vzhledy...');
define('_OVERVIEW_BACKUP',			'Z�loha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'�l�nky pro blog'); 
define('_ITEMLIST_YOUR',			'Va�e �l�nky');

// Comments
define('_COMMENTS',					'Koment��e');
define('_NOCOMMENTS',				'Tento �l�nek nem� ��dn� koment��e');
define('_COMMENTS_YOUR',			'Va�e koment��e');
define('_NOCOMMENTS_YOUR',			'Nenapsal jste ��dn� koment��e');

// LISTS (general)
define('_LISTS_NOMORE',				'��dn� dal�� nebo v�bec ��dn� v�sledky');
define('_LISTS_PREV',				'P�edchoz�');
define('_LISTS_NEXT',				'Dal��');
define('_LISTS_SEARCH',				'Hledat');
define('_LISTS_CHANGE',				'Zm�nit');
define('_LISTS_PERPAGE',			'�l�nk�/strana');
define('_LISTS_ACTIONS',			'Akce');
define('_LISTS_DELETE',				'Odstranit');
define('_LISTS_EDIT',				'Upravit');
define('_LISTS_MOVE',				'P�esunout');
define('_LISTS_CLONE',				'Zkop�rovat');
define('_LISTS_TITLE',				'Titulek');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'N�zev');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'�as');
define('_LISTS_COMMENTS',			'Koment��e');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazovan� jm�no');
define('_LIST_MEMBER_RNAME',		'Skute�n� jm�no');
define('_LIST_MEMBER_ADMIN',		'Super-spr�vce? ');
define('_LIST_MEMBER_LOGIN',		'M�e se p�ihl�sit? ');
define('_LIST_MEMBER_URL',			'Str�nka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'D�vod');

// actionlist
define('_LIST_ACTION_MSG',			'Zpr�va');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokovat IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Koment��');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulek a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Spr�vce ');
define('_LIST_TEAM_CHADMIN',		'Zm�nit spr�vce');

// edit comments
define('_EDITC_TITLE',				'Upravit koment��e');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkud?');
define('_EDITC_WHEN',				'Kdy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravit koment��');
define('_EDITC_MEMBER',				'�len');
define('_EDITC_NONMEMBER',			'nen� �len');

// move item
define('_MOVE_TITLE',				'P�esunout do jak�ho blogu?');
define('_MOVE_BTN',					'P�esunout �l�nek');
