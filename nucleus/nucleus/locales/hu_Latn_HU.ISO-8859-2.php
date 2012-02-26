<?php
// Hungarian Nucleus Language File
//
// Author: Koncz�r Tam�s (konczer@gmail.com)
// Nucleus version: v1.0-v3.2
//
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

define('_LIST_PLUG_SUBS_NEEDUPDATE','K�rlek haszn�ld a \'Csatol�si lista friss�t�se\'-gomot a plugin(ok) csatol�si list�j�nak friss�t�s�re.');
define('_LIST_PLUGS_DEP',			'Sz�ks�ges plugin(ok):');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'�sszes hozz�sz�l�s a bloghoz');
define('_NOCOMMENTS_BLOG',			'Nem volt hozz�sz�l�s ehhez a bloghoz.');
define('_BLOGLIST_COMMENTS',		'Hozz�sz�l�sok');
define('_BLOGLIST_TT_COMMENTS',		'Lista az �sszes ehhez a bloghoz tartoz� hozz�sz�l�sr�l');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'nap');
define('_ARCHIVETYPE_MONTH',		'h�nap');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Hamis vagy lej�rt c�mke.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin install�ci� sikertelen, sz�ks�ges: ');
define('_ERROR_DELREQPLUGIN',		'Plugin t�rl�se sikertelen, sz�ks�ges: ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'S�ti el�tag');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Nem lejet aktiv�ci�s linket k�ldeni. Nem vagy jogosult a bel�p�sre.');
define('_ERROR_ACTIVATE',			'Hi�nyzik/hib�s/lej�rt az aktiv�ci�s kulcs.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktiv�ci�s link elk�ldve!');
define('_MSG_ACTIVATION_SENT',		'Az aktiv�ci�s linket elk�ldt�k e-mailben.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"�dv <%memberName%>,\n\nAktiv�lnod kell a hozz�f�r�sedet a <%siteName%> (<%siteUrl%>) honlapon.\nEzt az al�bbi link seg�ts�g�vel teheted meg: \n\n\t<%activationUrl%>\n\n2 napod van erre a m�veletre, ut�na az aktiv�ci�s link lej�r.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktiv�ld a '<%memberName%>' hozz�f�r�sedet!");
define('_ACTIVATE_REGISTER_TITLE',	'�dv <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'M�r majdnem k�sz vagy. K�rlek, v�lassz jelsz�t a hozz�f�r�sedhez!');
define('_ACTIVATE_FORGOT_MAIL',		"�dv <%memberName%>,\n\nAz al�bbi link seg�ts�g�vel �j jelsz�t �ll�thatsz be a(z) <%siteName%> (<%siteUrl%>) weboldalon.\n\n\t<%activationUrl%>\n\n2 napod van erre a m�veletre, ut�na az aktiv�ci�s link lej�r.");
define('_ACTIVATE_FORGOT_MAILTITLE',"'<%memberName%>' hozz�f�r�s�nek �jraaktiv�l�sa");
define('_ACTIVATE_FORGOT_TITLE',	'�dv <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Az �j jelszavad:');
define('_ACTIVATE_CHANGE_MAIL',		"�dv <%memberName%>,\n\nAz e-mail c�med megv�ltoz�sa miatt a hozz�f�r�sed �jraaktiv�l�sa sz�ks�ges a <%siteName%> (<%siteUrl%>) honlapon.\nEzt az al�bbi link seg�ts�g�vel teheted meg: \n\n\t<%activationUrl%>\n\n2 napod van erre a m�veletre, ut�na az aktiv�ci�s link lej�r.");
define('_ACTIVATE_CHANGE_MAILTITLE',"A hozz�f�r�sed aktiv�l�sa '<%memberName%>' account");
define('_ACTIVATE_CHANGE_TITLE',	'�dv <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'A c�med v�ltoz�sa ellen�rizve. K�sz�nj�k!');
define('_ACTIVATE_SUCCESS_TITLE',	'Sikeres aktiv�l�s!');
define('_ACTIVATE_SUCCESS_TEXT',	'A hozz�f�r�sedet sikeresen aktiv�ltuk.!');
define('_MEMBERS_SETPWD',			'Jelsz� be�ll�t�sa');
define('_MEMBERS_SETPWD_BTN',		'Jelsz� be�ll�t�sa');
define('_QMENU_ACTIVATE',			'Hozz�f�r�s aktiv�ci�');
define('_QMENU_ACTIVATE_TEXT',		'<p>A hozz�f�r�sed aktiv�l�sa ut�n be tudsz jelentkezni <a href="index.php?action=showlogin">itt</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Csatol�si lista friss�t�se');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript eszk�zt�r');
define('_SETTINGS_JSTOOLBAR_FULL',	'Teljes eszk�zt�r (Internet Explorer)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Egyszer� eszk�zt�r (nem Internet Explorer)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Eszk�zt�r letilt�sa');
define('_SETTINGS_URLMODE_HELP',	'(Inform�ci�: <a href="documentation/tips.html#searchengines-fancyurls">kedvenc URL-ek aktiv�l�l�sa</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Extra plugin be�ll�t�sok');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'kateg�ria:');
define('_LIST_ITEM_AUTHOR',			'szerz�:');
define('_LIST_ITEM_DATE',			'd�tum:');
define('_LIST_ITEM_TIME',			'id�:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(tag)');

// batch operations
define('_BATCH_WITH_SEL',			'A kijel�ltekkel:');
define('_BATCH_EXEC',				'v�grehajt');

// quickmenu
define('_QMENU_HOME',				'F�oldal');
define('_QMENU_ADD',				'Elem hozz�ad�sa');
define('_QMENU_ADD_SELECT',			'-- v�lassz --');
define('_QMENU_USER_SETTINGS',		'Be�ll�t�sok');
define('_QMENU_USER_ITEMS',			'Elemek');
define('_QMENU_USER_COMMENTS',		'Megjegyz�sek');
define('_QMENU_MANAGE',				'Menedzsment');
define('_QMENU_MANAGE_LOG',			'Esem�nynapl�');
define('_QMENU_MANAGE_SETTINGS',	'Glob�lis be�ll�t�sok');
define('_QMENU_MANAGE_MEMBERS',		'Tagok');
define('_QMENU_MANAGE_NEWBLOG',		'�j blog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Pluginok');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'B�r�k');
define('_QMENU_LAYOUT_TEMPL',		'Sablonok');
define('_QMENU_LAYOUT_IEXPORT',		'Import�l�s/Export�l�s');
define('_QMENU_PLUGINS',			'Pluginok');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Bemutatkoz�s');
define('_QMENU_INTRO_TEXT',			'<p>Ez a Nucleus CMS bel�p�si oldala.</p><p>Ha van hozz�f�r�sed, itt be tudsz l�pni, hogy hozz�sz�l�sokat tudj �rni.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Nem tal�lhat� seg�ts�g f�jl ehhez pluginhoz');
define('_PLUGS_HELP_TITLE',			'Seg�ts�g a  pluginokhoz');
define('_LIST_PLUGS_HELP', 			'Seg�ts�g');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'K�ls� hiteles�t�s enged�lyez�se');
define('_WARNING_EXTAUTH',			'Vigy�zat: enged�lyez�s csak ha sz�ks�ges.');

// member profile
define('_MEMBERS_BYPASS',			'K�ls� hiteles�t�s haszn�lata');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Mindig</em> tartalmazza a keres�sn�l');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'N�zet');
define('_MEDIA_VIEW_TT',			'F�jl n�z� (�j ablakban)');
define('_MEDIA_FILTER_APPLY',		'Sz�r� enged�lyez�se');
define('_MEDIA_FILTER_LABEL',		'Sz�r�:');
define('_MEDIA_UPLOAD_TO',			'Felt�lt...');
define('_MEDIA_UPLOAD_NEW',			'�j f�jl felt�lt�se...');
define('_MEDIA_COLLECTION_SELECT',	'V�laszt');
define('_MEDIA_COLLECTION_TT',		'Kateg�ria �lt�s');
define('_MEDIA_COLLECTION_LABEL',	'Jelenlegi kollekci�:');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Balra igaz�t�s');
define('_ADD_ALIGNRIGHT_TT',		'Jobbra igaz�t�s');
define('_ADD_ALIGNCENTER_TT',		'K�z�pre igaz�t�s');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Hib�s felt�lt�s!');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'R�gebbi id�pont enged�lyez�se cikkek j�v�hagy�sakor/�r�sakor');
define('_ADD_CHANGEDATE',			'Keletb�lyegz� friss�t�se');
define('_BMLET_CHANGEDATE',			'Keletb�lyegz� friss�t�se');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'B�r import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Norm�l');
define('_PARSER_INCMODE_SKINDIR',	'B�r k�nyvt�r');
define('_SKIN_INCLUDE_MODE',		'M�d');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Alap b�r');
define('_SETTINGS_SKINSURL',		'B�r�k URL-jei');
define('_SETTINGS_ACTIONSURL',		'Teljes URL az action.php-hez');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Az alap kateg�ri�t nem lehet mozgatni.');
define('_ERROR_MOVETOSELF',			'A kateg�ri�t nem lehet mozgatni (c�l blog ugyanaz, mint a forr�s blog.)');
define('_MOVECAT_TITLE',			'Blog kiv�laszt�sa kateg�ri�ba val� �thelyez�shez');
define('_MOVECAT_BTN',				'Kateg�ria �thelyez�se');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL M�d');
define('_SETTINGS_URLMODE_NORMAL',	'Norm�l');
define('_SETTINGS_URLMODE_PATHINFO','D�szes');

// Batch operations
define('_BATCH_NOSELECTION',		'Nincs semmi kiv�lasztva a tev�kenys�g v�grehajt�s�hoz!');
define('_BATCH_ITEMS',				'K�tegelt oper�ci� az elemeken.');
define('_BATCH_CATEGORIES',			'K�tegelt oper�ci� a kateg�ri�kon.');
define('_BATCH_MEMBERS',			'K�tegelt oper�ci� a tagokon.');
define('_BATCH_TEAM',				'K�tegelt oper�ci� a csapat tagjain.');
define('_BATCH_COMMENTS',			'K�tegelt oper�ci� a megjegyz�seken.');
define('_BATCH_UNKNOWN',			'Ismeretlen k�tegelt m�velet:');
define('_BATCH_EXECUTING',			'V�grehajt�s');
define('_BATCH_ONCATEGORY',			'a kateg�ri�n');
define('_BATCH_ONITEM',				'az elemen');
define('_BATCH_ONCOMMENT',			'a megjegyz�sen');
define('_BATCH_ONMEMBER',			'tagon');
define('_BATCH_ONTEAM',				'csapattagon');
define('_BATCH_SUCCESS',			'Siker!');
define('_BATCH_DONE',				'K�sz!');
define('_BATCH_DELETE_CONFIRM',		'K�tegelt opr�ci� t�rl�s�nek meger�s�t�se');
define('_BATCH_DELETE_CONFIRM_BTN',	'K�tegelt opr�ci� t�rl�s�nek meger�s�t�se');
define('_BATCH_SELECTALL',			'Mindent kiv�laszt');
define('_BATCH_DESELECTALL',		'Vissza');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'T�r�l');
define('_BATCH_ITEM_MOVE',			'Mozgat');
define('_BATCH_MEMBER_DELETE',		'T�r�l');
define('_BATCH_MEMBER_SET_ADM',		'Admin jogok ad�sa');
define('_BATCH_MEMBER_UNSET_ADM',	'Admin jogok elv�tele');
define('_BATCH_TEAM_DELETE',		'T�rl�s a csapatb�l');
define('_BATCH_TEAM_SET_ADM',		'Admin jogok ad�sa');
define('_BATCH_TEAM_UNSET_ADM',		'Admin jogok elv�tele');
define('_BATCH_CAT_DELETE',			'T�r�l');
define('_BATCH_CAT_MOVE',			'M�sik blogba val� mozgat�s');
define('_BATCH_COMMENT_DELETE',		'T�r�l');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'�j elem ad�sa...');
define('_ADD_PLUGIN_EXTRAS',		'Extra kieg�sz�t� opci�k');

// errors
define('_ERROR_CATCREATEFAIL',		'Nem lehets�ges �j kateg�ria k�sz�t�se!');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ehhez a kieg�sz�t�h�z �jabb Nucleus verzi�ra van sz�ks�g:');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Vissza a blogbe�ll�t�sokhoz');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Kiv�lasztott b�r(�k) export�l�sa');
define('_SKINIE_LOCAL',				'Helyi f�jl import�l�sa:');
define('_SKINIE_NOCANDIDATES',		'A skins k�nyvt�r �res!');
define('_SKINIE_FROMURL',			'Import�l�s URL-b�l:');
define('_SKINIE_EXPORT_INTRO',		'V�laszd ki a b�r�ket �s sablonokat, amiket export�lni szeretn�l.');
define('_SKINIE_EXPORT_SKINS',		'B�r�k');
define('_SKINIE_EXPORT_TEMPLATES',	'Sablonok');
define('_SKINIE_EXPORT_EXTRA',		'Extra inform�ci�');
define('_SKINIE_CONFIRM_OVERWRITE',	'L�tez� b�r�k fel�l�r�sa (l�sd. n�vegyez�sek!)');
define('_SKINIE_CONFIRM_IMPORT',	'Igen, import�lni akarom!');
define('_SKINIE_CONFIRM_TITLE',		'Inform�ci�k b�r�k �s sablonok import�l�s�r�l');
define('_SKINIE_INFO_SKINS',		'B�r�k f�jlban:');
define('_SKINIE_INFO_TEMPLATES',	'Sablonok f�jlban:');
define('_SKINIE_INFO_GENERAL',		'Inform�ci�:');
define('_SKINIE_INFO_SKINCLASH',	'B�r�k neveinek egyez�se:');
define('_SKINIE_INFO_TEMPLCLASH',	'Sablokon neveinek egyez�se:');
define('_SKINIE_INFO_IMPORTEDSKINS','Import�lt b�r�k:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Import�lt sablonok:');
define('_SKINIE_DONE',				'Import�l�s k�sz.');

define('_AND',						'�s');
define('_OR',						'vagy');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'�res mez� (kattints ide a szerkeszt�shez)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'M�d szerint:');
define('_LIST_SKINS_INCPREFIX',		'Prefixek szerint:');
define('_LIST_SKINS_DEFINED',		'Defini�lt r�szek:');

// backup
define('_BACKUPS_TITLE',			'Biztons�gi ment�s / Vissza�ll�t�s');
define('_BACKUP_TITLE',				'Biztons�gi ment�s');
define('_BACKUP_INTRO',				'Az adatb�zis biztons�gi ment�s�hez kattints a gombra. (T�rold biztons�gos helyen.)');
define('_BACKUP_ZIP_YES',			'T�m�r�t�s haszn�lata');
define('_BACKUP_ZIP_NO',			'Nincs t�m�r�t�s');
define('_BACKUP_BTN',				'Biztons�gi ment�s k�sz�t�se');
define('_BACKUP_NOTE',				'<b>FONTOS:</b> Csak az adatb�zis tartalma ment�dik. A m�dia f�jlok �s a config.php be�ll�t�sai �gy <b>NEM</b> ment�dnek el.');
define('_RESTORE_TITLE',			'Vissza�ll�t�s');
define('_RESTORE_NOTE',				'<b>FIGYELMEZTET�S:</b> A biztons�gi ment�sb�l val� vissza�ll�t�s <b>T�R�L</b> minden aktu�lis Nucleus adatot az adatb�zisb�l! Csak akkor tedd ezt, ha biztos vag a dolgodban!<br/>	<b>Fontos:</b> Legy�l biztos benne, hogy a Nucleus verzi�, amib�l a biztons�gi ment�st k�sz�tetted, megegyezik azzal a Nucleus verzi�val, amit jelenleg futtatsz. Ha nem �gy van, ne haszn�ld ezt a funkci�t.');
define('_RESTORE_INTRO',			'V�laszd ki a biztosn�gi ment�s f�jlt (ami fel lesz t�ltve a szerverre) �s kattints a "Vissza�ll�t�s" gombra.');
define('_RESTORE_IMSURE',			'Igen, biztosan ezt akarom tenni!');
define('_RESTORE_BTN',				'Vissza�ll�t�s f�jlb�l.');
define('_RESTORE_WARNING',			'(legy�l biztos benne, hogy a megfelel� biztons�gi ment�s f�jl �ll a rendelkez�sedre)');
define('_ERROR_BACKUP_NOTSURE',		'Be kell jel�ln�d a \'biztos vagyok benne\' rubrik�t.');
define('_RESTORE_COMPLETE',			'Vissza�ll�t�s k�sz!');

// new item notification
define('_NOTIFY_NI_MSG',			'�j elem lett post�zva:');
define('_NOTIFY_NI_TITLE',			'�j elem!');
define('_NOTIFY_KV_MSG',			'Karma szavazat az elemre:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Megjegyz�s az elemre vonatkoztatva:');
define('_NOTIFY_NC_TITLE',			'Nucleus megjegyz�s:');
define('_NOTIFY_USERID',			'Felhaszn�l�i azonos�t�:');
define('_NOTIFY_USER',				'Felhaszn�l�:');
define('_NOTIFY_COMMENT',			'Megjegyz�s:');
define('_NOTIFY_VOTE',				'Szavazat:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Tag:');
define('_NOTIFY_TITLE',				'C�m:');
define('_NOTIFY_CONTENTS',			'Tartalom:');

// member mail message
define('_MMAIL_MSG',				'Az �zenet k�ldte:');
define('_MMAIL_FROMANON',			'ismeretelen l�togat�');
define('_MMAIL_FROMNUC',			'K�ldve a Nucleus weblogb�l');
define('_MMAIL_TITLE',				'Az �zenet k�ldve:');
define('_MMAIL_MAIL',				'�zenet:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'�j elem hozz�ad�sa');
define('_BMLET_EDIT',				'Elem szerkeszt�se');
define('_BMLET_DELETE',				'Elem t�rl�se');
define('_BMLET_BODY',				'Test');
define('_BMLET_MORE',				'Kiterjesztett');
define('_BMLET_OPTIONS',			'Opci�k');
define('_BMLET_PREVIEW',			'El�n�zet');

// used in bookmarklet
define('_ITEM_UPDATED',				'Elem friss�tve!');
define('_ITEM_DELETED',				'Elem t�r�lve!');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Biztos, hogy t�r�lni akarod a kieg�sz�t�t?');
define('_ERROR_NOSUCHPLUGIN',		'Nincs ilyen kieg�sz�t�.');
define('_ERROR_DUPPLUGIN',			'Sajn�lom, ez a plugin m�r install�lva van.');
define('_ERROR_PLUGFILEERROR',		'Nem l�tez� kieg�sz�t� vagy a jogosults�g rosszul van be�ll�tva.');
define('_PLUGS_NOCANDIDATES',		'Nem tal�ltam kieg�sz�t�ket');

define('_PLUGS_TITLE_MANAGE',		'Pluginok menedzsel�se');
define('_PLUGS_TITLE_INSTALLED',	'Aktu�lisan install�lt');
define('_PLUGS_TITLE_UPDATE',		'Csatol�si lista friss�t�se');
define('_PLUGS_TEXT_UPDATE',		'A Nucleus a gyors�t�t�rban hagyja a kieg�sz�t�k be�ll�t�sait. Amikor upgrade-elsz egy kieg�sz�t�t, azzal, hogy fel�l�rod a f�jlt, v�gre kell hajtanod ezt a friss�t�st, hogy meggy�z�dhess r�la: a be�ll�t�sok helyesen ker�ltek a gyors�t�t�rba.');
define('_PLUGS_TITLE_NEW',			'�j kieg�sz�t� install�l�sa');
define('_PLUGS_ADD_TEXT',			'Az al�bbi list�ban mindazon kieg�sz�t�k szerepelnek, melyek nincsenek install�lva. Legy�l biztos benne <strong>- eg�szen biztos -</strong>, hogy amit hozz� akarsz adni a rendszerhez, val�ban egy kieg�sz�t�.');
define('_PLUGS_BTN_INSTALL',		'Plugin install�l�sa');
define('_BACKTOOVERVIEW',			'Vissza az �ttekint�shez');

// editlink
define('_TEMPLATE_EDITLINK',		'Elem linkj�nek szerkeszt�se');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Hozz�ad a bal oldalhoz');
define('_ADD_RIGHT_TT',				'Hozz�ad a jobb oldalhoz');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'�j kateg�ria...');

// new settings
define('_SETTINGS_PLUGINURL',		'Kieg�sz�t� URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Maximum felt�lthet� f�jlm�ret (byte-ban)');
define('_SETTINGS_NONMEMBERMSGS',	'�zenetek k�ld�s�nek enged�lyez�se a l�togat�knak is.');
define('_SETTINGS_PROTECTMEMNAMES',	'Tagok neveinek v�delme');

// overview screen
define('_OVERVIEW_PLUGINS',			'Pluginok menedzsel�se...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'�j tag regisztr�l�sa:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nem rendelkezel adminisztr�tori joggal a blogokat illet�en, enn�lfogva nincs enged�lyed f�jlok felt�lt�s�re ennek a tagnak a m�dia k�nyvt�r�ba');

// plugin list
define('_LISTS_INFO',				'Inform�ci�');
define('_LIST_PLUGS_AUTHOR',		'K�ldte:');
define('_LIST_PLUGS_VER',			'Verzi�:');
define('_LIST_PLUGS_SITE',			'Oldal megl�togat�sa.');
define('_LIST_PLUGS_DESC',			'Le�r�s:');
define('_LIST_PLUGS_SUBS',			'A k�vetkez�k j�v�hagy�sa:');
define('_LIST_PLUGS_UP',			'Mozgat�s fel');
define('_LIST_PLUGS_DOWN',			'Mozgat�s le');
define('_LIST_PLUGS_UNINSTALL',		'uninstall�l�s');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'szerkeszt&nbsp;opci�k');

// plugin option list
define('_LISTS_VALUE',				'�rt�k');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Ez a kieg�sz�t� nem rendelkezik semmilyen be�ll�t�ssal');
define('_PLUGS_BACK',				'Vissza a kieg�sz�t�k be�ll�t�sihoz');
define('_PLUGS_SAVE',				'Opci�k ment�se');
define('_PLUGS_OPTIONS_UPDATED',	'A kieg�sz�t�k opci�i friss�ltek!');

define('_OVERVIEW_MANAGEMENT',		'Menedzsel�s');
define('_OVERVIEW_MANAGE',			'Nucleus menedzsel�se...');
define('_MANAGE_GENERAL',			'�ltal�nos be�ll�t�sok');
define('_MANAGE_SKINS',				'B�r�k �s sablonok');
define('_MANAGE_EXTRA',				'Extra tulajdons�gok');

define('_BACKTOMANAGE',				'Vissza a Nucleus menedzsel�s�hez');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'Kil�p�s');
define('_LOGIN',					'Bel�p�s');
define('_YES',						'Igen');
define('_NO',						'Nem');
define('_SUBMIT',					'K�ld');
define('_ERROR',					'Hiba');
define('_ERRORMSG',					'Hiba t�rt�nt!');
define('_BACK',						'Vissza');
define('_NOTLOGGEDIN',				'Nem vagy bejelentkezve');
define('_LOGGEDINAS',				'Bejelentkezve, mint');
define('_ADMINHOME',				'Admin f�oldal');
define('_NAME',						'N�v');
define('_BACKHOME',					'Vissza az adminisztr�ci�s f�oldalra');
define('_BADACTION',				'Nem l�tez� feladat v�grehajt�s�t k�rted.');
define('_MESSAGE',					'�zenet');
define('_HELP_TT',					'Seg�ts�g!');
define('_YOURSITE',					'Oldalad');


define('_POPUP_CLOSE',				'Bez�r');

define('_LOGIN_PLEASE',				'El�sz�r be kell jelentkezned!');

// commentform
define('_COMMENTFORM_YOUARE',		'Te vagy');
define('_COMMENTFORM_SUBMIT',		'Megjegyz�s �r�sa');
define('_COMMENTFORM_COMMENT',		'�zeneted');
define('_COMMENTFORM_NAME',			'Neved');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Megjegyez');

// loginform
define('_LOGINFORM_NAME',			'Felhaszn�l�neved:');
define('_LOGINFORM_PWD',			'Jelszavad:');
define('_LOGINFORM_YOUARE',			'Bejelentkezve, mint');
define('_LOGINFORM_SHARED',			'Megosztott sz�m�t�g�p');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'�zenetk�ld�s');

// search form
define('_SEARCHFORM_SUBMIT',		'Keres�s');

// add item form
define('_ADD_ADDTO',				'�j elem hozz�ad�sa');
define('_ADD_CREATENEW',			'�j elem l�trehoz�sa');
define('_ADD_BODY',					'Test');
define('_ADD_TITLE',				'C�m');
define('_ADD_MORE',					'Kiterjesztett (opcion�lis)');
define('_ADD_CATEGORY',				'Kateg�ria');
define('_ADD_PREVIEW',				'El�n�zet');
define('_ADD_DISABLE_COMMENTS',		'Megjegyz�sek tilt�sa');
define('_ADD_DRAFTNFUTURE',			'Piszkozat &amp; J�v�beni elemek');
define('_ADD_ADDITEM',				'Elem hozz�ad�sa');
define('_ADD_ADDNOW',				'Hozz�ad�s azonnal');
define('_ADD_ADDLATER',				'Hozz�ad�s k�s�bb');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Hozz�ad�s a piszkozathoz');
define('_ADD_NOPASTDATES',			'(A r�gebbi d�tum �s id� NEM �rv�nyes, �gy ebben az esetben a mostani id� lesz)');
define('_ADD_BOLD_TT',				'f�lk�v�r');
define('_ADD_ITALIC_TT',			'd�lt');
define('_ADD_HREF_TT',				'Linket k�sz�t');
define('_ADD_MEDIA_TT',				'M�dia hozz�ad�sa');
define('_ADD_PREVIEW_TT',			'Mutatja/elrejti az el�n�zetet');
define('_ADD_CUT_TT',				'Kiv�g');
define('_ADD_COPY_TT',				'M�sol');
define('_ADD_PASTE_TT',				'Beilleszt');


// edit item form
define('_EDIT_ITEM',				'Elem szerkeszt�se');
define('_EDIT_SUBMIT',				'Elem szerkeszt�se');
define('_EDIT_ORIG_AUTHOR',			'Eredeti szerz�');
define('_EDIT_BACKTODRAFTS',		'Hozz�adja a piszkozatokhoz');
define('_EDIT_COMMENTSNOTE',		'(megjegyz�s: a megjegyz�sek tilt�sakor a r�gebbi megjegyz�sek ugyan�gy kint maradnak)');

// used on delete screens
define('_DELETE_CONFIRM',			'Er�s�tsd meg a t�rl�si m�veletet.');
define('_DELETE_CONFIRM_BTN',		'Er�s�tsd meg a t�rl�si m�veletet.');
define('_CONFIRMTXT_ITEM',			'A k�vetkez�n�l tartasz: az al�bbi elem t�rl�se:');
define('_CONFIRMTXT_COMMENT',		'A k�vetkez�n�l tartasz: a al�bbi megjegyz�s t�rl�se:');
define('_CONFIRMTXT_TEAM1',			'A k�vetkez�n�l tartasz: t�rl�s');
define('_CONFIRMTXT_TEAM2',			' a teamlista blogj�b�l.');
define('_CONFIRMTXT_BLOG',			'A blog, amit k�sz�lsz, hogy t�r�lj: ');
define('_WARNINGTXT_BLOGDEL',		'Vigy�zat! A blog t�rl�sekor a blognak minden elem�t �s az �sszes megjegyz�st t�r�lni fogod. K�rlek er�s�tsd meg a t�rl�si k�relmet<br/>Ne kapcsold ki a Nucleust a t�rl�si folyamat k�zben.');
define('_CONFIRMTXT_MEMBER',		'A k�vetkez�n�l tartasz: a al�bbi tag profilj�nak t�rl�se: ');
define('_CONFIRMTXT_TEMPLATE',		'A k�vetkez�n�l tartasz: a al�bbi sablon t�rl�se: ');
define('_CONFIRMTXT_SKIN',			'A k�vetkez�n�l tartasz: a al�bbi b�r t�rl�se: ');
define('_CONFIRMTXT_BAN',			'A k�vetkez�n�l tartasz: a al�bbi IP bannol�sa ebbebn a tartom�nybban:');
define('_CONFIRMTXT_CATEGORY',		'A k�vetkez�n�l tartasz: kateg�ria t�rl�se: ');

// some status messages
define('_DELETED_ITEM',				'Elem t�r�lve!');
define('_DELETED_MEMBER',			'Tag t�r�lve!');
define('_DELETED_COMMENT',			'Megjegyz�s t�r�lve!');
define('_DELETED_BLOG',				'Blog t�r�lve!');
define('_DELETED_CATEGORY',			'Kateg�ria t�r�lve!');
define('_ITEM_MOVED',				'Elem �thelyezve!');
define('_ITEM_ADDED',				'Elem hozz�adva!');
define('_COMMENT_UPDATED',			'Megjegyz�s friss�tve!');
define('_SKIN_UPDATED',				'A b�r adatai elmentve.');
define('_TEMPLATE_UPDATED',			'A sablon adatai elmentve.');

// errors
define('_ERROR_COMMENT_LONGWORD',	'K�rlek, ne haszn�lj 90 karaktern�l hosszabb szavakat megjegyz�s �r�s�n�l.');
define('_ERROR_COMMENT_NOCOMMENT',	'K�rlek, �rj megjegyz�st');
define('_ERROR_COMMENT_NOUSERNAME',	'Rossz felhaszn�l�n�v');
define('_ERROR_COMMENT_TOOLONG',	'A megjegyz�sed t�l hossz� (max. 5000 karakter lehet)');
define('_ERROR_COMMENTS_DISABLED',	'Ehhez a bloghoz nem lehets�ges megjegyz�st �rni.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Tagk�nt kell bel�pned ahhoz, hogy megjegyz�st �rhass ehhez a bloghoz.');
define('_ERROR_COMMENTS_MEMBERNICK','A nevet, amit haszn�lni szeretn�l, m�r haszn�lja valaki. K�rlek, v�lassz m�sikat.');
define('_ERROR_SKIN',				'B�r hiba!');
define('_ERROR_ITEMCLOSED',			'Az elem z�rva van, ne mlehets�ges �j megjegyz�s �r�sa �s szavaz�s');
define('_ERROR_NOSUCHITEM',			'Nem l�tezik ilyen elem!');
define('_ERROR_NOSUCHBLOG',			'Nem l�tezik ilyen blog');
define('_ERROR_NOSUCHSKIN',			'Nem l�tezik ilyen b�r');
define('_ERROR_NOSUCHMEMBER',		'Nem l�tezik ilyen tag');
define('_ERROR_NOTONTEAM',			'Nem vagy a csapattag, ehhez a bloghoz.');
define('_ERROR_BADDESTBLOG',		'C�l blog nem l�tezik!');
define('_ERROR_NOTONDESTTEAM',		'Mivel nem vagy a c�l blog csapat tagja, nem mozgathatod ezt az elemet.');
define('_ERROR_NOEMPTYITEMS',		'�res elem hozz�ad�sa nem lehets�ges!');
define('_ERROR_BADMAILADDRESS',		'Az email c�m nem �rv�nyes.');
define('_ERROR_BADNOTIFY',			'Egy vagy t�bb megadott kapcsolattart� email c�m nem �rv�nyes');
define('_ERROR_BADNAME',			'�rv�nytelen n�v. (a-z �s 0-9, az elej�n �s v�g�n nem lehet sz�k�z)');
define('_ERROR_NICKNAMEINUSE',		'Ez a n�v m�r foglalt.');
define('_ERROR_PASSWORDMISMATCH',	'A jelszavaknak egyezni�k kell.');
define('_ERROR_PASSWORDTOOSHORT',	'A jelsz�nak legal�b 6 karakterb�l kell �llnia');
define('_ERROR_PASSWORDMISSING',	'Nem lehet �res a jelsz� mez�');
define('_ERROR_REALNAMEMISSING',	'Val�di nevet kell be�rnod.');
define('_ERROR_ATLEASTONEADMIN',	'Legal�bb egy szuper-adminnak lennie kell.');
define('_ERROR_ATLEASTONEBLOGADMIN','Ezzel a m�velettel j�r, hogy a bloghoz nem lehet hozz�f�rni k�s�bb, ez�rt legy�l biztos benne, hogy van adminisztr�ora az oldalnak.');
define('_ERROR_ALREADYONTEAM',		'Nem adhatsz hozz� olyan tagot, aki m�r tagj a csapatnak!');
define('_ERROR_BADSHORTBLOGNAME',	'A blog r�vid neve a-z �s 0-9 lehet sz�k�z n�lk�l.');
define('_ERROR_DUPSHORTBLOGNAME',	'Egy m�sik blog r�vid neve ugyanez.');
define('_ERROR_UPDATEFILE',			'Nem lehet �rni az update f�jlba. Legy�l biztos benne, hogy az attrib�tumok j�l vannak be�l�tva a f�jlokon (666). M�sr�szt a hely relat�v az admin k�nyvt�rhoz. abszol�t �tvonalat adj meg (valahogy �gy /te/�tvonalad/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Az alap blog nem t�r�lhet�!');
define('_ERROR_DELETEMEMBER',		'Ez a tag nem t�r�lhet�, lehet, hogy az�rt, mivel � a szerz�je ennek az megjegyz�snek');
define('_ERROR_BADTEMPLATENAME',	'Helytelen sablon elnevez�s (a-z �s 0-9 lehet, sz�k�z�k n�lk�l)');
define('_ERROR_DUPTEMPLATENAME',	'Egy m�sik sablon m�r l�tezik ezzel a n�vvel.');
define('_ERROR_BADSKINNAME',		'Helytelen b�r elnevez�s (a-z �s 0-9 lehet, sz�k�z�k n�lk�l)');
define('_ERROR_DUPSKINNAME',		'Egy m�sik b�r m�r l�tezik ezzel a n�vvel.');
define('_ERROR_DEFAULTSKIN',		'Egy b�rnek mindig "default" elnevez�s�nek kell lennie!');
define('_ERROR_SKINDEFDELETE',		'Nem lehet a b�rt t�r�lni, am�g az alap b�r az al�bbi bloghoz: ');
define('_ERROR_DISALLOWED',			'Sajn�lom, nem hajthatod v�gre ezt a m�veletet.');
define('_ERROR_DELETEBAN',			'Hiba a ban t�rl�se k�zben (nem l�tez� ban)');
define('_ERROR_ADDBAN',				'Hiba ban hozz�ad�sa k�zben. Lehet, hogy a ban nem lett korrekt�l hozz�adva valamelyik bloghoz.');
define('_ERROR_BADACTION',			'A sz�ks�ges m�velet nem l�tezik.');
define('_ERROR_MEMBERMAILDISABLED',	'Tag a taghoz email �zenet tiltott');
define('_ERROR_MEMBERCREATEDISABLED','Tag l�trehoz�sa tiltva');
define('_ERROR_INCORRECTEMAIL',		'Helytelen email c�m');
define('_ERROR_VOTEDBEFORE',		'M�r szavazt�l!');
define('_ERROR_BANNED1',			'Nem v�grehajthat� a m�velet, am�g az al�bbi IP tartom�nyb�l j�ssz: ');
define('_ERROR_BANNED2',			' . Az �zenet a k�vetkez�: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Be kell jelentkezned a m�velet v�grehajt�s�hoz.');
define('_ERROR_CONNECT',			'Kapcsol�d�si hiba');
define('_ERROR_FILE_TOO_BIG',		'T�l nagy f�jl!');
define('_ERROR_BADFILETYPE',		'Sajn�lom, ez a f�jlt�pus nem megengedett!');
define('_ERROR_BADREQUEST',			'Hib�s felt�lt�s k�r�s!');
define('_ERROR_DISALLOWEDUPLOAD',	'Egyik blog csapatlist�j�ban sem szerepelsz. Ez�rt nem t�lthetsz fel f�jlokat.');
define('_ERROR_BADPERMISSIONS',		'A f�jl/k�nyvt�r jogok rosszul vannak be�l�tva.');
define('_ERROR_UPLOADMOVEP',		'Hiba a felt�lt�tt f�jl mozgat�sa k�zben.');
define('_ERROR_UPLOADCOPY',			'Hiba f�jl m�sol�sakor.');
define('_ERROR_UPLOADDUPLICATE',	'Egy f�jl m�r l�tezik ezzel a n�vvel. Nevezd �t, �s �gy pr�b�lkozz a felt�lt�ssel.');
define('_ERROR_LOGINDISALLOWED',	'Sajn�lom, nem enged�lyezett az adminisztr�ci�s ter�letre val� bel�p�s. Jelentkezz be felhaszn�l�k�nt.');
define('_ERROR_DBCONNECT',			'Nem tudok kapcsol�dni a mySQL szerverhez.');
define('_ERROR_DBSELECT',			'Nem l�tom a nucleus adatb�zis�t.');
define('_ERROR_NOSUCHLANGUAGE',		'Nem l�tez� nelvi f�jl!');
define('_ERROR_NOSUCHCATEGORY',		'Nem l�tez� kateg�ria!');
define('_ERROR_DELETELASTCATEGORY',	'Egy kateg�ri�nak l�teznie kell!');
define('_ERROR_DELETEDEFCATEGORY',	'Az alap kateg�ri�t nem lehet t�r�lni!');
define('_ERROR_BADCATEGORYNAME',	'Rossz kateg�ria n�v!');
define('_ERROR_DUPCATEGORYNAME',	'Egy m�sik kateg�ria ezzel a n�vvel m�r l�tezik!');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Figyelmeztet�s: az aktu�lis �rt�k nem k�nyvt�r!');
define('_WARNING_NOTREADABLE',		'Figyelmeztet�s: az aktu�lis �rt�k nem olvashat� k�nyvt�r!');
define('_WARNING_NOTWRITABLE',		'Figyelmeztet�s: az aktu�lis �rt�k nem �rhat� k�nyvt�r!');

// media and upload
define('_MEDIA_UPLOADLINK',			'�j f�jl felt�lt�se');
define('_MEDIA_MODIFIED',			'm�dos�tva');
define('_MEDIA_FILENAME',			'f�jln�v');
define('_MEDIA_DIMENSIONS',			'm�ret');
define('_MEDIA_INLINE',				'sor');
define('_MEDIA_POPUP',				'el�ugr�');
define('_UPLOAD_TITLE',				'V�lassz f�jlt!');
define('_UPLOAD_MSG',				'V�laszd ki a felt�lteni k�v�nt f�jlt �s kattints a \'felt�lt�s\' gombra.');
define('_UPLOAD_BUTTON',			'Felt�lt�s');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Felhaszn�l�i fi�kod l�trehozva. A jelszavadat emailben k�ldj�k.');
define('_MSG_PASSWORDSENT',			'Jelsz� elk�ldve! (emailben)');
define('_MSG_LOGINAGAIN',			'M�gegyszer be kell jelentkezned, mert megv�ltoztak az adataid.');
define('_MSG_SETTINGSCHANGED',		'Be�l�t�sok megv�ltoztatva.');
define('_MSG_ADMINCHANGED',			'Admin megv�ltoztatva.');
define('_MSG_NEWBLOG',				'�j blog l�trehozva');
define('_MSG_ACTIONLOGCLEARED',		'M�veletek log t�r�lve.');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Tiltott m�velet: ');
define('_ACTIONLOG_PWDREMINDERSENT','�j jelsz� elk�ldve: ');
define('_ACTIONLOG_TITLE',			'M�veletek logja');
define('_ACTIONLOG_CLEAR_TITLE',	'M�veletek logj�nak t�rl�se');
define('_ACTIONLOG_CLEAR_TEXT',		'M�veletek logj�nak t�rl�se most');

// team management
define('_TEAM_TITLE',				'Csapat menedzsel�se a bloghoz');
define('_TEAM_CURRENT',				'Jelenlegi csapat');
define('_TEAM_ADDNEW',				'�j tag hozz�ad�sa a csapathoz');
define('_TEAM_CHOOSEMEMBER',		'V�lassz tagot');
define('_TEAM_ADMIN',				'Admin privil�giumok?');
define('_TEAM_ADD',					'Hozz�ad�s a csapathoz');
define('_TEAM_ADD_BTN',				'Hozz�ad�s a csapathoz');

// blogsettings
define('_EBLOG_TITLE',				'Blog be�ll�t�sok szerkeszt�se');
define('_EBLOG_TEAM_TITLE',			'Csapat szerkeszt�se');
define('_EBLOG_TEAM_TEXT',			'Kattints ide a csapat szerkeszt�s�hez');
define('_EBLOG_SETTINGS_TITLE',		'Blog be�ll�t�sok');
define('_EBLOG_NAME',				'Blog N�v');
define('_EBLOG_SHORTNAME',			'R�vid blog n�v');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a-z-ig sz�k�z n�lk�l)');
define('_EBLOG_DESC',				'Blog le�r�s');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Alap b�r');
define('_EBLOG_DEFCAT',				'Alap kateg�ria');
define('_EBLOG_LINEBREAKS',			'Sort�r�sek konvert�l�sa');
define('_EBLOG_DISABLECOMMENTS',	'Megengeded a megjegyz�seket?<br /><small>(A megjegyz�sek tilt�sa azt jelenti, hogy nem lehet megjegyz�st adni a rendszerhez.)</small>');
define('_EBLOG_ANONYMOUS',			'Megjegyz�st a l�togat�k is �rhatnak? (nem csak a tagok)');
define('_EBLOG_NOTIFY',				'�rtes�t� c�mek (haszn�lata; mint elv�laszt�)');
define('_EBLOG_NOTIFY_ON',			'�res�t�s:');
define('_EBLOG_NOTIFY_COMMENT',		'�j megjegyz�s');
define('_EBLOG_NOTIFY_KARMA',		'�j karma szavazat');
define('_EBLOG_NOTIFY_ITEM',		'�j blog elem');
define('_EBLOG_PING',				'Ping Weblogs.com a friss�t�s�rt?');
define('_EBLOG_MAXCOMMENTS',		'Max. mennyis�g a megjegyz�sekb�l!');
define('_EBLOG_UPDATE',				'F�jl friss�t�se');
define('_EBLOG_OFFSET',				'Id�eltol�d�s');
define('_EBLOG_STIME',				'Aktu�lis szerverid�: ');
define('_EBLOG_BTIME',				'Aktu�lis blog id�: ');
define('_EBLOG_CHANGE',				'Be�ll�t�sok v�ltoztat�sa');
define('_EBLOG_CHANGE_BTN',			'Be�ll�t�sok v�ltoztat�sa');
define('_EBLOG_ADMIN',				'Blog admin');
define('_EBLOG_ADMIN_MSG',			'Hozz� lett�l rendelve az adminisztr�tori jogokhoz!');
define('_EBLOG_CREATE_TITLE',		'�j blog l�trehoz�sa');
define('_EBLOG_CREATE_TEXT',		'T�ltsd ki az al�bbi mez�t �j blog l�trehoz�s�hoz. <br /><br /> <b>Figyelem:</b> Csak a sz�ks�ges opci�k vannak kilist�zva. Ha extra opci�kat szeretn�l be�ll�tani, kattints a blogbe�ll�t�sokra a lap alj�n az "�j blog l�trehoz�sa" alatt.');
define('_EBLOG_CREATE',				'L�trehoz!');
define('_EBLOG_CREATE_BTN',			'Blog l�trehoz�sa');
define('_EBLOG_CAT_TITLE',			'Kateg�ri�k');
define('_EBLOG_CAT_NAME',			'Kateg�ria n�v');
define('_EBLOG_CAT_DESC',			'Kateg�ria le�r�sa');
define('_EBLOG_CAT_CREATE',			'�j kateg�ria l�trehoz�sa');
define('_EBLOG_CAT_UPDATE',			'Kateg�ria friss�t�se');
define('_EBLOG_CAT_UPDATE_BTN',		'Kateg�ria friss�t�se');

// templates
define('_TEMPLATE_TITLE',			'Sablonok szerkeszt�se');
define('_TEMPLATE_AVAILABLE_TITLE',	'El�rhet� sablonok');
define('_TEMPLATE_NEW_TITLE',		'�j sablon');
define('_TEMPLATE_NAME',			'A sablon neve: ');
define('_TEMPLATE_DESC',			'Sablon le�r�sa');
define('_TEMPLATE_CREATE',			'Sablon l�trehoz�sa');
define('_TEMPLATE_CREATE_BTN',		'Sablon l�trehoz�sa');
define('_TEMPLATE_EDIT_TITLE',		'Sablon szerkeszt�se');
define('_TEMPLATE_BACK',			'Vissza a sablonok be�ll�t�saihoz');
define('_TEMPLATE_EDIT_MSG',		'Nincs sz�ks�g az �sszes sablon r�szletre, hagyd �resen amire nincs sz�ks�ged.');
define('_TEMPLATE_SETTINGS',		'Sablonok be�ll�t�sai');
define('_TEMPLATE_ITEMS',			'Elemek');
define('_TEMPLATE_ITEMHEADER',		'Elem fejl�c');
define('_TEMPLATE_ITEMBODY',		'Elem test');
define('_TEMPLATE_ITEMFOOTER',		'elem l�bl�c');
define('_TEMPLATE_MORELINK',		'Kiterjesztett m�d');
define('_TEMPLATE_NEW',				'�j elem indik�ci�ja');
define('_TEMPLATE_COMMENTS_ANY',	'Megjegyz�sek (ha van)');
define('_TEMPLATE_CHEADER',			'Megjegyz�sek fejl�ce');
define('_TEMPLATE_CBODY',			'Megjegyz�sek teste');
define('_TEMPLATE_CFOOTER',			'Megjegz�sek l�bl�ceComments Footer');
define('_TEMPLATE_CONE',			'Egy megjegyz�s');
define('_TEMPLATE_CMANY',			'Kett� vagy (t�bb) megjegyz�s');
define('_TEMPLATE_CMORE',			'T�bbi megjegyz�s olvas�sa');
define('_TEMPLATE_CMEXTRA',			'Tagok extr�i');
define('_TEMPLATE_COMMENTS_NONE',	'Megjegyz�sek (ha nincs)');
define('_TEMPLATE_CNONE',			'Nincsenek megjegyz�sek.');
define('_TEMPLATE_COMMENTS_TOOMUCH','Megjegyz�sek (han nincs, de t�l sok, hogy az �sszeset meg lehessen jelen�teni)');
define('_TEMPLATE_CTOOMUCH',		'T�l sok megjegyz�s');
define('_TEMPLATE_ARCHIVELIST',		'Arch�v lista');
define('_TEMPLATE_AHEADER',			'Arch�v lista fejl�ce');
define('_TEMPLATE_AITEM',			'Arch�v lista eleme');
define('_TEMPLATE_AFOOTER',			'Arch�v lista l�bl�ce');
define('_TEMPLATE_DATETIME',		'D�tum �s id�');
define('_TEMPLATE_DHEADER',			'D�tum fejl�c');
define('_TEMPLATE_DFOOTER',			'D�tum l�bl�c');
define('_TEMPLATE_DFORMAT',			'D�tum form�tum');
define('_TEMPLATE_TFORMAT',			'Id� form�tum');
define('_TEMPLATE_LOCALE',			'Lok�lis');
define('_TEMPLATE_IMAGE',			'Felbukkan� k�pek');
define('_TEMPLATE_PCODE',			'Felbukkan� link k�d');
define('_TEMPLATE_ICODE',			'K�pek sorban k�d');
define('_TEMPLATE_MCODE',			'M�dia objektum link k�dja');
define('_TEMPLATE_SEARCH',			'Keres�s');
define('_TEMPLATE_SHIGHLIGHT',		'Kiemel�s');
define('_TEMPLATE_SNOTFOUND',		'A keres�s nem eredm�nyezett tal�latot.');
define('_TEMPLATE_UPDATE',			'Friss�t�s');
define('_TEMPLATE_UPDATE_BTN',		'Sablonok friss�t�se');
define('_TEMPLATE_RESET_BTN',		'Adatok vissza�ll�t�sa');
define('_TEMPLATE_CATEGORYLIST',	'Kateg�ria lista');
define('_TEMPLATE_CATHEADER',		'Kateg�ria lista fejl�ce');
define('_TEMPLATE_CATITEM',			'Kateg�ria lista eleme');
define('_TEMPLATE_CATFOOTER',		'Kateg�ria lista l�bl�ce');

// skins
define('_SKIN_EDIT_TITLE',			'B�r�k szerkeszt�se');
define('_SKIN_AVAILABLE_TITLE',		'El�rhet� b�r�k');
define('_SKIN_NEW_TITLE',			'�j b�r');
define('_SKIN_NAME',				'N�v');
define('_SKIN_DESC',				'Le�r�s');
define('_SKIN_TYPE',				'Tartalom t�pusa');
define('_SKIN_CREATE',				'L�trehoz�s');
define('_SKIN_CREATE_BTN',			'B�r l�trehoz�sa');
define('_SKIN_EDITONE_TITLE',		'B�r szerkeszt�se');
define('_SKIN_BACK',				'Vissza a b�r�k be�ll�t�saihoz');
define('_SKIN_PARTS_TITLE',			'B�r�k r�szei');
define('_SKIN_PARTS_MSG',			'Nem sz�ks�ges az �sszs t�pus a b�r�kh�z. Hagyd �resen, amire nincs sz�ks�ged. V�lassz egy al�bbi b�rt�pust a szerkeszt�shez:');
define('_SKIN_PART_MAIN',			'F�oldal');
define('_SKIN_PART_ITEM',			'Elem lapok');
define('_SKIN_PART_ALIST',			'Arch�v lista');
define('_SKIN_PART_ARCHIVE',		'Arch�v');
define('_SKIN_PART_SEARCH',			'Keres�s');
define('_SKIN_PART_ERROR',			'Hib�k');
define('_SKIN_PART_MEMBER',			'Tagok r�szletei');
define('_SKIN_PART_POPUP',			'Felbukkan� l�pek');
define('_SKIN_GENSETTINGS_TITLE',	'Alap be�ll�t�sok');
define('_SKIN_CHANGE',				'V�ltoztat�s');
define('_SKIN_CHANGE_BTN',			'V�ltoztasd meg ezeket a be�ll�t�sokat');
define('_SKIN_UPDATE_BTN',			'B�r friss�t�se');
define('_SKIN_RESET_BTN',			'Adat vissza�ll�t�s');
define('_SKIN_EDITPART_TITLE',		'B�r szerkeszt�se');
define('_SKIN_GOBACK',				'Vissza');
define('_SKIN_ALLOWEDVARS',			'El�rhet� v�ltoz�k (kattints r� a b�vebb inform�ci��rt):');

// global settings
define('_SETTINGS_TITLE',			'Alap be�ll�t�sok');
define('_SETTINGS_SUB_GENERAL',		'Alap be�ll�t�sok');
define('_SETTINGS_DEFBLOG',			'Alap blog');
define('_SETTINGS_ADMINMAIL',		'Adminisztr�tor email');
define('_SETTINGS_SITENAME',		'Oldal neve');
define('_SETTINGS_SITEURL',			'Oldal URL-je (/-vel a v�g�n)');
define('_SETTINGS_ADMINURL',		'URL az admin ter�lethez (/-vel a v�g�n)');
define('_SETTINGS_DIRS',			'Nucleus k�nyvt�rak');
define('_SETTINGS_MEDIADIR',		'M�dia k�nyvt�r');
define('_SETTINGS_SEECONFIGPHP',	'(config.php)');
define('_SETTINGS_MEDIAURL',		'M�dia URL (/-vel a v�g�n)');
define('_SETTINGS_ALLOWUPLOAD',		'Enged�lyezed a f�jl felt�lt�st?');
define('_SETTINGS_ALLOWUPLOADTYPES','Enged�lyezett f�jlt�pusok felt�lt�shez');
define('_SETTINGS_CHANGELOGIN',		'Enged�ly a tagoknak a login/jelsz� v�ltozat�s�ra.');
define('_SETTINGS_COOKIES_TITLE',	'S�ti be�ll�t�sok');
define('_SETTINGS_COOKIELIFE',		'Bel�p�s s�ti �letideje');
define('_SETTINGS_COOKIESESSION',	'Cookie-k ideje');
define('_SETTINGS_COOKIEMONTH',		'Egy h�nap �letid�');
define('_SETTINGS_COOKIEPATH',		'S�ti �t (speci�lis)');
define('_SETTINGS_COOKIEDOMAIN',	'S�ti domain (speci�lis)');
define('_SETTINGS_COOKIESECURE',	'S�ti v�delem (speci�lis)');
define('_SETTINGS_LASTVISIT',		'Utols� l�togat�s s�tij�nek ment�se');
define('_SETTINGS_ALLOWCREATE',		'Enged�ly a l�togat�k sz�m�ra felhaszn�l�i fi�k l�trehoz�s�hoz.');
define('_SETTINGS_NEWLOGIN',		'Bel�p�s enged�lyez�se felhaszn�l�k �ltal l�trehozott felhaszn�l�i fi�kokhoz.');
define('_SETTINGS_NEWLOGIN2',		'(Csak az �jonnan l�trehozott felhaszn�l�i fi�kokhoz j�r)');
define('_SETTINGS_MEMBERMSGS',		'Tag a tagnak szolg�ltat�s enged�lez�se');
define('_SETTINGS_LANGUAGE',		'Alap nyelv');
define('_SETTINGS_DISABLESITE',		'Oldal tilt�sa');
define('_SETTINGS_DBLOGIN',			'mySQL bel�p�s &amp; adatb�zis');
define('_SETTINGS_UPDATE',			'Be�ll�t�sok friss�t�se');
define('_SETTINGS_UPDATE_BTN',		'Be�ll�t�sok friss�t�se');
define('_SETTINGS_DISABLEJS',		'JavaScript eszk�zt�r tilt�sa');
define('_SETTINGS_MEDIA',			'Media/felt�lt�s be�ll�t�sok');
define('_SETTINGS_MEDIAPREFIX',		'Felt�lt�tt f�jlok jel�l�se d�tum prefixszel');
define('_SETTINGS_MEMBERS',			'Tagok be�ll�t�sai');

// bans
define('_BAN_TITLE',				'Ban lista: ');
define('_BAN_NONE',					'Nincs ban ehhez a bloghoz: ');
define('_BAN_NEW_TITLE',			'�j ban hozz�ad�sa');
define('_BAN_NEW_TEXT',				'�j ban hozz�ad�sa azonnal');
define('_BAN_REMOVE_TITLE',			'Ban elt�vol�t�sa');
define('_BAN_IPRANGE',				'IP tartom�ny');
define('_BAN_BLOGS',				'Melyik blogokat?');
define('_BAN_DELETE_TITLE',			'Ban t�rl�se');
define('_BAN_ALLBLOGS',				'Az �sszes bloghoz, amihez adminisztr�tori jogaid vannak.');
define('_BAN_REMOVED_TITLE',		'Ban elt�vol�tva.');
define('_BAN_REMOVED_TEXT',			'A ban elt�vol�tva az al�bbi blogokb�l: ');
define('_BAN_ADD_TITLE',			'Ban hozz�ad�sa');
define('_BAN_IPRANGE_TEXT',			'V�laszd ki az IP tartom�nyt, amit blokkolni szertn�l. Min�l kevesebb sz�mot tartalmaz, ann�l t�bb c�m lesz blokkolva.');
define('_BAN_BLOGS_TEXT',			'Lehet�s�ged van v�lasztani egy bloghoz k�t�tt IP-t bannolni, vagy pedig bannolni az IP-t az �sszes bloghoz, ahol admininsztr�tori jogokkal rendelkezel.');
define('_BAN_REASON_TITLE',			'Ok');
define('_BAN_REASON_TEXT',			'Meg tudod v�deni a ban ok�t, ami akkor jelenik meg, amikor az IP birtokosa megpr�b�l megjegyz�st �rni, vagy szavazni (max. 256 karakter).');
define('_BAN_ADD_BTN',				'Ban hozz�ad�sa');

// LOGIN screen
define('_LOGIN_MESSAGE',			'�zenet');
define('_LOGIN_NAME',				'N�v');
define('_LOGIN_PASSWORD',			'Jelsz�');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Elfelejetted a jelszavad?');

// membermanagement
define('_MEMBERS_TITLE',			'Tagok menedzsel�se');
define('_MEMBERS_CURRENT',			'Jelenlegi tagok');
define('_MEMBERS_NEW',				'�j tag');
define('_MEMBERS_DISPLAY',			'N�v megjelen�t�se');
define('_MEMBERS_DISPLAY_INFO',		'(Ezt a nevet haszn�lod bel�p�shez.)');
define('_MEMBERS_REALNAME',			'Val�di n�v');
define('_MEMBERS_PWD',				'Jelsz�');
define('_MEMBERS_REPPWD',			'Jelsz� m�gegyszer');
define('_MEMBERS_EMAIL',			'Email c�m');
define('_MEMBERS_EMAIL_EDIT',		'(Amikor v�ltoztatod a c�med, az �j jelsz� automatikusan �rkezik a c�medre.)');
define('_MEMBERS_URL',				'Weboldal c�m (URL)');
define('_MEMBERS_SUPERADMIN',		'Adminisztr�tor jogok');
define('_MEMBERS_CANLOGIN',			'Be tud l�pni adminisztr�tor ter�letre');
define('_MEMBERS_NOTES',			'Megejgyz�sek');
define('_MEMBERS_NEW_BTN',			'Tag hozz�ad�sa');
define('_MEMBERS_EDIT',				'Tag szerkeszt�se');
define('_MEMBERS_EDIT_BTN',			'Be�ll�t�sok v�ltoztat�sa');
define('_MEMBERS_BACKTOOVERVIEW',	'Vissza a tagok be�ll�t�saihoz');
define('_MEMBERS_DEFLANG',			'Nyelv');
define('_MEMBERS_USESITELANG',		'- oldal be�ll�t�sainak haszn�lata -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Oldal megl�togat�sa');
define('_BLOGLIST_ADD',				'Elem hozz�ad�sa');
define('_BLOGLIST_TT_ADD',			'�j elem hozz�ad�sa ehhez a bloghoz.');
define('_BLOGLIST_EDIT',			'Elemek szerkeszt�se/t�rl�se');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'K�nyvjelz�');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Be�ll�t�sok');
define('_BLOGLIST_TT_SETTINGS',		'Be�ll�t�sok szerkeszt�se vagy a csapat menedzsel�s');
define('_BLOGLIST_BANS',			'Banok');
define('_BLOGLIST_TT_BANS',			'Bannolt IP-k megn�z�se, hozz�ad�sa vagy elt�vol�t�sa.');
define('_BLOGLIST_DELETE',			'�sszes t�rl�se');
define('_BLOGLIST_TT_DELETE',		'T�rli ezt a blogot.');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'A blogjaid');
define('_OVERVIEW_YRDRAFTS',		'Piszkozataid');
define('_OVERVIEW_YRSETTINGS',		'Be�ll�t�said');
define('_OVERVIEW_GSETTINGS',		'Alap be�ll�t�sok');
define('_OVERVIEW_NOBLOGS',			'Egyik blog csapatlist�j�ban sem vagy benne.');
define('_OVERVIEW_NODRAFTS',		'Nincsenek piszkozatok');
define('_OVERVIEW_EDITSETTINGS',	'Be�ll�t�said ment�se...');
define('_OVERVIEW_BROWSEITEMS',		'B�ng�szs�s az elemeid k�z�tt...');
define('_OVERVIEW_BROWSECOMM',		'B�ng�szs�s az megjegyz�seid k�z�tt...');
define('_OVERVIEW_VIEWLOG',			'Log megtekint�se...');
define('_OVERVIEW_MEMBERS',			'Tagok menedzsel�se...');
define('_OVERVIEW_NEWLOG',			'�j blog l�trehoz�sa...');
define('_OVERVIEW_SETTINGS',		'Be�ll�t�sok szerkeszt�se...');
define('_OVERVIEW_TEMPLATES',		'Sablonok szerkeszt�se...');
define('_OVERVIEW_SKINS',			'B�r�k szerkeszt�se...');
define('_OVERVIEW_BACKUP',			'Biztons�gi ment�s/Vissza�ll�t�s...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Elemek a bloghoz'); 
define('_ITEMLIST_YOUR',			'Elemeid');

// Comments
define('_COMMENTS',					'Megjegyz�sek');
define('_NOCOMMENTS',				'Nincsenek megjegyz�sek ehhez az elemhez.');
define('_COMMENTS_YOUR',			'Megjegyz�seid');
define('_NOCOMMENTS_YOUR',			'Nem �rt�l megjegyz�st!');

// LISTS (general)
define('_LISTS_NOMORE',				'Nincs t�bb tal�lat vagy a keres�s egy�ltal�n nem eredm�nyezett tal�latot.');
define('_LISTS_PREV',				'El�z�');
define('_LISTS_NEXT',				'K�vetkez�');
define('_LISTS_SEARCH',				'Keres');
define('_LISTS_CHANGE',				'V�ltoztat');
define('_LISTS_PERPAGE',			'elemek/lap');
define('_LISTS_ACTIONS',			'Akci�k');
define('_LISTS_DELETE',				'T�r�l');
define('_LISTS_EDIT',				'Szerkeszt');
define('_LISTS_MOVE',				'�thelyez');
define('_LISTS_CLONE',				'Kl�n');
define('_LISTS_TITLE',				'C�m');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'N�v');
define('_LISTS_DESC',				'Le�r�s');
define('_LISTS_TIME',				'Id�pont');
define('_LISTS_COMMENTS',			'Megjegyz�s');
define('_LISTS_TYPE',				'T�pus');


// member list 
define('_LIST_MEMBER_NAME',			'N�v mutat�sa');
define('_LIST_MEMBER_RNAME',		'Val�di n�v');
define('_LIST_MEMBER_ADMIN',		'Szuper-admin?');
define('_LIST_MEMBER_LOGIN',		'Bel�phet?');
define('_LIST_MEMBER_URL',			'Weboldal');

// banlist
define('_LIST_BAN_IPRANGE',			'IP tartom�ny');
define('_LIST_BAN_REASON',			'Ok');

// actionlist
define('_LIST_ACTION_MSG',			'�zenet');

// commentlist
define('_LIST_COMMENT_BANIP',		'IP bannol�sa');
define('_LIST_COMMENT_WHO',			'Szerz�');
define('_LIST_COMMENT',				'Megjegyz�s');
define('_LIST_COMMENT_HOST',		'Hoszt');

// itemlist
define('_LIST_ITEM_INFO',			'Inform�ci�');
define('_LIST_ITEM_CONTENT',		'C�m �s sz�veg');


// teamlist
define('_LIST_TEAM_ADMIN',			'Admin');
define('_LIST_TEAM_CHADMIN',		'Admin v�ltoztat�sa');

// edit comments
define('_EDITC_TITLE',				'Megjegyz�sek szerkeszt�se');
define('_EDITC_WHO',				'Szerz�');
define('_EDITC_HOST',				'Honnan?');
define('_EDITC_WHEN',				'Mikor?');
define('_EDITC_TEXT',				'Sz�veg');
define('_EDITC_EDIT',				'Megjegyz�s szerkeszt�se');
define('_EDITC_MEMBER',				'Tag');
define('_EDITC_NONMEMBER',			'Nem tag');

// move item
define('_MOVE_TITLE',				'Melyik blogba mozgassam?');
define('_MOVE_BTN',					'Elem �thelyez�se');
