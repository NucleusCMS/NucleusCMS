<?php
// Finnish Nucleus Language File
// 
// Author: Toni Ruuska, http://www.feldon.net 
// Based on earlier translations by Marko Sepp�nen (http://hoito.org) 
// and Jussi Josefsson (http://www.nominaali.com).
// Nucleus version: v1.0-v3.2 
//
// Please note: if you want to translate this file to your own translation, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated translation file can be sent to us and will be made
// available for download (with proper credit to the author, of course)
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

define('_LIST_PLUG_SUBS_NEEDUPDATE','Paina \'P�ivit� laajennuslista\'-nappulaa p�ivitt��ksesi listan kaikista laajennuksista.');
define('_LIST_PLUGS_DEP',			'Laajennus vaatii:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Kaikki kommentit kohteessa ');
define('_NOCOMMENTS_BLOG',			'Ei kommentteja');
define('_BLOGLIST_COMMENTS',		'Kommentit');
define('_BLOGLIST_TT_COMMENTS',		'Lista kommenteista');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'p�iv�');
define('_ARCHIVETYPE_MONTH',		'kuukausi');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Vanhentunut tai virheellinen tunniste.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Laajennuksen asennus ei onnistunut, syyn� ');
define('_ERROR_DELREQPLUGIN',		'Laajennuksen poistaminen ei onnistunut, syyn� ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Ev�steen tunniste');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Aktivointiin tarvittavaa linkki� ei voida l�hett��. Sis��nkirjautumista ei ole sallittu.');
define('_ERROR_ACTIVATE',			'Aktivointiin tarvittavaa avainta ei ole olemassa, se ei ole voimassa tai se on mennyt vanhaksi.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktivointilinkki on l�hetetty');
define('_MSG_ACTIVATION_SENT',		'Aktivointilinkki on l�hetetty s�hk�postitse.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Terve <%memberName%>,\n\nSinun tulee aktivoida k�ytt�j�tilisi sivustolla <%siteName%> (<%siteUrl%>).\nVoit tehd� t�m�n valitsemalla oheisen linkin: \n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa tehd� n�in. T�m�n j�lkeen aktivointilinkki menee vanhaksi.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktivoi tilisi nimelle '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Olet melkein valmis. Valitse salasana tilille.');
define('_ACTIVATE_FORGOT_MAIL',		"Terve <%memberName%>,\n\nOheisella linkill� voit vaihtaa uuden salasanan tilillesi sivustolle <%siteName%> (<%siteUrl%>), valitsemalla uusi salasana.\n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa k�ytt�� linkki�, t�m�n j�lkeen linkki vanhenee.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Aktivoi '<%memberName%>' tilisi uudestaan");
define('_ACTIVATE_FORGOT_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Valitse uusi salasana tilillesi:');
define('_ACTIVATE_CHANGE_MAIL',		"Terve <%memberName%>,\n\nKoska s�hk�postiosoitteesi on vaihtunut, sinun tulee aktivoida tilisi uudelleen sivustolle <%siteName%> (<%siteUrl%>).\nVoit tehd� t�m�n oheisella linkill�: \n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa tehd� n�in, t�m�n j�lkeen linkki menee vanhaksi.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Aktivoi tilisi '<%memberName%>' uudestaan");
define('_ACTIVATE_CHANGE_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Osoitteesi on tarkistettu. Kiitokset!');
define('_ACTIVATE_SUCCESS_TITLE',	'Onnistunut aktivointi');
define('_ACTIVATE_SUCCESS_TEXT',	'Tilisi on aktivoitu onnistuneesti.');
define('_MEMBERS_SETPWD',			'Aseta salasana');
define('_MEMBERS_SETPWD_BTN',		'Aseta salasana');
define('_QMENU_ACTIVATE',			'Tilin aktivointi');
define('_QMENU_ACTIVATE_TEXT',		'<p>Kun olet aktivoinut tilisi, voit alkaa k�ytt�� sit� <a href="index.php?action=showlogin">kirjautumalla sis��n</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'P�ivit� laajennuslista');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascript valikon tyyli');
define('_SETTINGS_JSTOOLBAR_FULL',	'T�ydellinen valikko (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Yksinkertainen valikko (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Poista valikko k�yt�st�');
define('_SETTINGS_URLMODE_HELP',	'(Lis�tietoja: <a href="documentation/tips.html#searchengines-fancyurls">How to activate fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Laajennuksen lis�asetukset');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'author:');
define('_LIST_ITEM_DATE',			'date:');
define('_LIST_ITEM_TIME',			'time:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(j�sen)');

// batch operations
define('_BATCH_WITH_SEL',			'Valituille:');
define('_BATCH_EXEC',				'Suorita');

// quickmenu
define('_QMENU_HOME',				'P��sivu');
define('_QMENU_ADD',				'Lis�� artikkeli');
define('_QMENU_ADD_SELECT',			'-- valitse --');
define('_QMENU_USER_SETTINGS',		'Tiedot');
define('_QMENU_USER_ITEMS',			'Artikkelit');
define('_QMENU_USER_COMMENTS',		'Kommentit');
define('_QMENU_MANAGE',				'Hallinta');
define('_QMENU_MANAGE_LOG',			'Toimintaloki');
define('_QMENU_MANAGE_SETTINGS',		'Asetukset');
define('_QMENU_MANAGE_MEMBERS',		'K�ytt�j�t');
define('_QMENU_MANAGE_NEWBLOG',		'Uusi blogi');
define('_QMENU_MANAGE_BACKUPS',		'Varmuuskopiot');
define('_QMENU_MANAGE_PLUGINS',		'Laajennukset');
define('_QMENU_LAYOUT',				'Ulkoasu');
define('_QMENU_LAYOUT_SKINS',		'Sivurungot');
define('_QMENU_LAYOUT_TEMPL',		'Asettelut');
define('_QMENU_LAYOUT_IEXPORT',		'Tuo/Vie');
define('_QMENU_PLUGINS',			'Laajennukset');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Esittely');
define('_QMENU_INTRO_TEXT',			'<p>T�m� on kirjautumisruutu Nucleus-sis�ll�nhallintaj�rjestelm�n yll�pitoalueelle.</p><p>Jos sinulla on tili sivustolle, voit kirjautua sis��n ja lis�t� uusia artikkeleita tai muuttaa asetuksia.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Avustustiedostoa laajennukselle ei l�ytynyt');
define('_PLUGS_HELP_TITLE',			'Laajennuksen avustussivu');
define('_LIST_PLUGS_HELP', 			'apua');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Salli ulkoinen varmennus');
define('_WARNING_EXTAUTH',			'Varoitus: salli vain jos tarvitset t�t�.');

// member profile
define('_MEMBERS_BYPASS',			'K�yt� ulkoista varmennusta');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'Sis�llyt� <em>aina</em> hakuun');

// END changed/added after v2.5beta


// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'Tarkastele');
define('_MEDIA_VIEW_TT',			'Tarkastele tiedostoa (avautuu uuteen ikkunaan)');
define('_MEDIA_FILTER_APPLY',		'Ota suodatin k�ytt��n');
define('_MEDIA_FILTER_LABEL',		'Suodatin: ');
define('_MEDIA_UPLOAD_TO',			'L�het�...');
define('_MEDIA_UPLOAD_NEW',			'L�het� uusi tiedosto...');
define('_MEDIA_COLLECTION_SELECT',	'Valitse');
define('_MEDIA_COLLECTION_TT',		'Vaihda t�h�n kategoriaan');
define('_MEDIA_COLLECTION_LABEL',	'Valittu kokoelma: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Tasaa vasemmalle');
define('_ADD_ALIGNRIGHT_TT',		'Tasaa oikealle');
define('_ADD_ALIGNCENTER_TT',		'Keskit�');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Sis�llyt� hakuun');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'L�hetys ep�onnistui');

// END introduced after v2.0 END


// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Salli menneille p�iville postitus');
define('_ADD_CHANGEDATE',			'P�ivit� aikaleima');
define('_BMLET_CHANGEDATE',			'P�ivit� aikaleima');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Tuominen / vieminen...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normaali');
define('_PARSER_INCMODE_SKINDIR',	'K�yt� sivurunkohakemistoa');
define('_SKIN_INCLUDE_MODE',		'Moodi');
define('_SKIN_INCLUDE_PREFIX',		'Etuliite');

// global settings
define('_SETTINGS_BASESKIN',		'Perussivurunko');
define('_SETTINGS_SKINSURL',		'Perussivurunkojen URL');
define('_SETTINGS_ACTIONSURL',		'Koko URL action.php:lle');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Vakiokategoriaa ei voi siirt��');
define('_ERROR_MOVETOSELF',			'Kategoriaa ei voi voida siirt�� (kohdeblogi on sama kuin l�hdeblogi)');
define('_MOVECAT_TITLE',			'Valitse blogi johon kategoria siirret��n');
define('_MOVECAT_BTN',				'Siirr� kategoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL moodi');
define('_SETTINGS_URLMODE_NORMAL',	'Normaali');
define('_SETTINGS_URLMODE_PATHINFO','Tarkka');

// Batch operations
define('_BATCH_NOSELECTION',		'Ei valintoja, joihin kohdistuu toimintoja');
define('_BATCH_ITEMS',				'Joukkotoiminne blogiartikkeleille');
define('_BATCH_CATEGORIES',			'Joukkotoiminne kategorioille');
define('_BATCH_MEMBERS',			'Joukkotoiminne j�senille');
define('_BATCH_TEAM',				'Joukkotoiminne hallintaryhmille');
define('_BATCH_COMMENTS',			'Joukkotoiminne kommenteille');
define('_BATCH_UNKNOWN',			'Tuntematon joukkotoiminne: ');
define('_BATCH_EXECUTING',			'Suorittaa..');
define('_BATCH_ONCATEGORY',			'kategorialle');
define('_BATCH_ONITEM',				'blogiartikkelille');
define('_BATCH_ONCOMMENT',			'kommentille');
define('_BATCH_ONMEMBER',			'j�senelle');
define('_BATCH_ONTEAM',				'hallintaryhm�n j�senelle');
define('_BATCH_SUCCESS',			'Onnistui!');
define('_BATCH_DONE',				'Valmis!');
define('_BATCH_DELETE_CONFIRM',		'Vahvista joukkopoistaminen');
define('_BATCH_DELETE_CONFIRM_BTN',	'Vahvista joukkopoistaminen');
define('_BATCH_SELECTALL',			'valitse kaikki');
define('_BATCH_DESELECTALL',		'poista valinnat');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Poista');
define('_BATCH_ITEM_MOVE',			'Siirr�');
define('_BATCH_MEMBER_DELETE',		'Poista');
define('_BATCH_MEMBER_SET_ADM',		'Anna j�rjestelm�nvalvojan oikeudet');
define('_BATCH_MEMBER_UNSET_ADM',	'Ota pois j�rjestelm�nvalvojan oikeudet');
define('_BATCH_TEAM_DELETE',		'Poista hallintaryhm�st�');
define('_BATCH_TEAM_SET_ADM',		'Anna j�rjestelm�nvalvojan oikeudet');
define('_BATCH_TEAM_UNSET_ADM',		'Ota pois j�rjestelm�nvalvojan oikeudet');
define('_BATCH_CAT_DELETE',			'Poista');
define('_BATCH_CAT_MOVE',			'Siirr�� toiseen blogiin');
define('_BATCH_COMMENT_DELETE',		'Poista');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Lis�� uusi blogiartikkeli...');
define('_ADD_PLUGIN_EXTRAS',		'Laajennuksen lis�valinnat');

// errors
define('_ERROR_CATCREATEFAIL',		'Ei pystytty luomaan uutta kategoriaa');
define('_ERROR_NUCLEUSVERSIONREQ',	'T�m� laajennus vaatii uudemman Nucleuksen version: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Takaisin blogiasetuksiin');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Tuo');
define('_SKINIE_TITLE_EXPORT',		'Vie');
define('_SKINIE_BTN_IMPORT',		'Tuo valitut sivurungot / asettelut');
define('_SKINIE_BTN_EXPORT',		'Vie valitut sivurungot / asettelut');
define('_SKINIE_LOCAL',				'Tuo paikallisesta tiedostosta:');
define('_SKINIE_NOCANDIDATES',		'Ei ehdokkaita tuotavaksi sivurunko -hakemistossa');
define('_SKINIE_FROMURL',			'Tuo URL:sta:');
define('_SKINIE_EXPORT_INTRO',		'Valitse sivurungot ja asettelut, jotka haluavat vied�');
define('_SKINIE_EXPORT_SKINS',		'Sivurungot');
define('_SKINIE_EXPORT_TEMPLATES',	'Asettelut');
define('_SKINIE_EXPORT_EXTRA',		'Lis�tietoa');
define('_SKINIE_CONFIRM_OVERWRITE',	'Ylikirjoita sivurungot, jotka ovat jo olemassa (katso nimien p��llekk�isyydet)');
define('_SKINIE_CONFIRM_IMPORT',	'Kyll�, haluan tuoda t�m�n ');
define('_SKINIE_CONFIRM_TITLE',		'Valmis tuomaan sivurungon ja asettelut');
define('_SKINIE_INFO_SKINS',		'Sivurungot tiedostossa:');
define('_SKINIE_INFO_TEMPLATES',	'Asettelut tiedostossa:');
define('_SKINIE_INFO_GENERAL',		'Tietoa:');
define('_SKINIE_INFO_SKINCLASH',	'Sivirunkonimien p��llekk�isyydet:');
define('_SKINIE_INFO_TEMPLCLASH',	'Asettelunimien p��llekk�isyydet:');
define('_SKINIE_INFO_IMPORTEDSKINS','Tuodut sivurungot:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Tuodut asettelut:');
define('_SKINIE_DONE',				'Tuominen valmis');

define('_AND',						'ja');
define('_OR',						'tai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tyhj� kentt� (klikkaa editoidaksesi)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'M��ritellyt osat:');

// backup
define('_BACKUPS_TITLE',			'Varmuuskopioi / Palauta');
define('_BACKUP_TITLE',				'Varmuuskopioi');
define('_BACKUP_INTRO',				'Klikkaa alla olevaa painiketta luodaksesi varmuuskopion Nucleus-tietokannastasi. Tallennusikkuna tulee esiin ja voit valita minne haluat tallettaa varmuuskopiotiedoston. S�il� se varmaan paikkaan.');
define('_BACKUP_ZIP_YES',			'Yrit� k�ytt�� tiedonpakkausta');
define('_BACKUP_ZIP_NO',			'�l� k�yt� tiedonpakkausta');
define('_BACKUP_BTN',				'Luo varmuuskopio');
define('_BACKUP_NOTE',				'<b>Huomaa:</b> Vain tietokannan sis�lt� on talletettuna varmuuskopioon. Mediatiedostot ja asetukset tiedostossa config.php <b>eiv�t</b> t�ten sis�lly varmuuskopioon.');
define('_RESTORE_TITLE',			'Palauta');
define('_RESTORE_NOTE',				'<b>VAROITUS:</b> Varmuuskopiosta palauttaminen tulee <b>TYHJENT�M��N</b> kaiken nykyisen Nucleus-tietokannan kokonaan! �l� jatka ellet ole ehdottoman varma siit� mit� olet tekem�ss�!	<br />	<b>Huom!</b> Varmista, ett� Nucleuksen versio, jossa varmuuskopion loit, pit�isi olla sama kuin versio, jota k�yt�t juuri nyt! Muuten se ei toimi.');
define('_RESTORE_INTRO',			'Valitse varmuuskopiotiedosto alta (se tullaan lataamaan serverille) ja klikkaa "Palauta tiedostosta" -painiketta aloittaaksesi.');
define('_RESTORE_IMSURE',			'Kyll�, olen varma, ett� haluan tehd� t�m�n!');
define('_RESTORE_BTN',				'Palauta tiedostosta');
define('_RESTORE_WARNING',			'(varmista, ett� olet palauttamassa oikeaa varmuuskopiota. Kenties kannattaisi tehd� uusi varmuuskopio ennen kuin aloitat...)');
define('_ERROR_BACKUP_NOTSURE',		'Sinun t�ytyy ruksittaa \'Olen varma, ett� haluan tehd� t�m�n\' -kohta');
define('_RESTORE_COMPLETE',			'Palautus valmis');

// new item notification
define('_NOTIFY_NI_MSG',			'Uusi blogiartikkeli on postitettu:');
define('_NOTIFY_NI_TITLE',			'Uusi blogiartikkeli!');
define('_NOTIFY_KV_MSG',			'Karma-��nest� blogiartikkelia:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Kommentoi blogiartikkelia:');
define('_NOTIFY_NC_TITLE',			'Nucleus kommentti:');
define('_NOTIFY_USERID',			'K�ytt�j�n ID:');
define('_NOTIFY_USER',				'K�ytt�j�:');
define('_NOTIFY_COMMENT',			'Kommentti:');
define('_NOTIFY_VOTE',				'��nestys:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'J�sen:');
define('_NOTIFY_TITLE',				'Otsikko:');
define('_NOTIFY_CONTENTS',			'Sis�lt�:');

// member mail message
define('_MMAIL_MSG',				'Viesti sinulle, jonka on l�hett�nyt');
define('_MMAIL_FROMANON',			'nimet�n vierailija');
define('_MMAIL_FROMNUC',			'Postitettu Nucleus weblogista osoitteessa');
define('_MMAIL_TITLE',				'Viesti j�senelt�');
define('_MMAIL_MAIL',				'Viesti:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Lis�� artikkeli');
define('_BMLET_EDIT',				'Muokkaa artikkelia');
define('_BMLET_DELETE',				'Poista artikkeli');
define('_BMLET_BODY',				'Sis�lt�');
define('_BMLET_MORE',				'Laajennettu');
define('_BMLET_OPTIONS',			'Optiot');
define('_BMLET_PREVIEW',			'Esikatselu');

// used in bookmarklet
define('_ITEM_UPDATED',				'Artikkeli p�ivitetty');
define('_ITEM_DELETED',				'Artikkeli poistettu');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Oletko varma, ett� haluat poistaa laajennuksen nimelt�');
define('_ERROR_NOSUCHPLUGIN',		'Kyseist� laajennusta ei ole');
define('_ERROR_DUPPLUGIN',			'T�m� laajennus on jo asennettu');
define('_ERROR_PLUGFILEERROR',		'Kyseist� laajennusta ei ole, tai oikeudet ovat v��rin asetetut');
define('_PLUGS_NOCANDIDATES',		'Haluttuja laajennuksia ei l�ytynyt');

define('_PLUGS_TITLE_MANAGE',		'Laajennustenhallinta');
define('_PLUGS_TITLE_INSTALLED',	'Asennetut laajennukset');
define('_PLUGS_TITLE_UPDATE',		'P�ivit� tapahtumalistaa');
define('_PLUGS_TEXT_UPDATE',		'Nucleus pit�� yll� listaa laajennusten tapahtumatilauksista. Kun p�ivit�t laajennuksen ylikirjoittamalla sen tiedoston, sinun t�ytyisi ajaa t�m� p�ivitys varmistaaksesi, ett� listassa olisi oikeat tilaukset');
define('_PLUGS_TITLE_NEW',			'Asenna uusi laajennus');
define('_PLUGS_ADD_TEXT',			'Alla on lista kaikista tiedostoista Plugins -hakemistossasi, jotka voivat olla laajennuksia, joita ei viel� ole asennettu. Varmista ett� olet <strong>aivan varma</strong>, ett� kyseess� on laajennus, ennen kuin lis��t sen.');
define('_PLUGS_BTN_INSTALL',		'Asenna laajennus');
define('_BACKTOOVERVIEW',			'Takaisin');

// editlink
define('_TEMPLATE_EDITLINK',		'Muokkaa artikkelia -linkki');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Lis�� vasen palsta');
define('_ADD_RIGHT_TT',				'Lis�� oikea palsta');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Uusi kategoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Laajennuksen osoite (URL)');
define('_SETTINGS_MAXUPLOADSIZE',	'L�hetetyn tiedoston maksimikoko (bittein�)');
define('_SETTINGS_NONMEMBERMSGS',	'Salli ei-j�senten l�hett�� viestej�');
define('_SETTINGS_PROTECTMEMNAMES',	'Suojaa j�senten nimet');

// overview screen
define('_OVERVIEW_PLUGINS',			'Laajennuksien hallinta');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Uuden j�senen rekister�inti:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'S�hk�postiosoitteesi:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sinulla ei ole yll�pit�j�n oikeuksia mihink��n blogiin, joilla on kohdej�sen listallaan. T�ten, et ole oikeutettu l�hett�m��n tiedostoja t�m�n j�senen media -hakemistoon');

// plugin list
define('_LISTS_INFO',				'Tiedot');
define('_LIST_PLUGS_AUTHOR',		'Tekij�:');
define('_LIST_PLUGS_VER',			'Versio:');
define('_LIST_PLUGS_SITE',			'WWW-sivut');
define('_LIST_PLUGS_DESC',			'Kuvaus');
define('_LIST_PLUGS_SUBS',			'Liittyy seuraaviin tapahtumiin:');
define('_LIST_PLUGS_UP',			'Siirr� yl�s');
define('_LIST_PLUGS_DOWN',			'Siirr� alas');
define('_LIST_PLUGS_UNINSTALL',		'Poista&nbsp;installointi');
define('_LIST_PLUGS_ADMIN',			'Yll�pito');
define('_LIST_PLUGS_OPTIONS',		'S��d�&nbsp;asetuksia');

// plugin option list
define('_LISTS_VALUE',				'Arvo');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'T�ll� laajennuksella ei ole asetuksia s��dett�v�n�
');
define('_PLUGS_BACK',				'Takaisin Laajennukset -sivulle');
define('_PLUGS_SAVE',				'Tallenna asetukset');
define('_PLUGS_OPTIONS_UPDATED',	'Laajennuksen asetukset p�ivitetty');

define('_OVERVIEW_MANAGEMENT',		'Hallinta');
define('_OVERVIEW_MANAGE',			'Nucleuksen hallinta...');
define('_MANAGE_GENERAL',			'Yleinen hallinta');
define('_MANAGE_SKINS',				'Sivurungot ja asettelut');
define('_MANAGE_EXTRA',				'Lis�ominaisuudet');

define('_BACKTOMANAGE',				'Takaisin Nucleuksen hallintaan');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'Kirjaudu ulos');
define('_LOGIN',					'Kirjaudu sis��n');
define('_YES',						'Kyll�');
define('_NO',						'Ei');
define('_SUBMIT',					'L�het�');
define('_ERROR',					'Virhe');
define('_ERRORMSG',					'Virhe esiintyi!');
define('_BACK',						'Takaisin');
define('_NOTLOGGEDIN',				'Et ole kirjautunut sis��n');
define('_LOGGEDINAS',				'Olet kirjautunut sis��n tunnuksella');
define('_ADMINHOME',				'J�rjestelm�nvalvoja-asetukset');
define('_NAME',						'Nimi');
define('_BACKHOME',					'Takaisin j�rjestelm�nvalvoja-asetuksiin');
define('_BADACTION',				'Pyydetty� toimintoa ei ole');
define('_MESSAGE',					'Viesti');
define('_HELP_TT',					'Apua!');
define('_YOURSITE',					'Sivustosi');


define('_POPUP_CLOSE',				'Sulje ikkuna');

define('_LOGIN_PLEASE',				'Kirjaudu ensin sis��n');

// commentform
define('_COMMENTFORM_YOUARE',		'Olet');
define('_COMMENTFORM_SUBMIT',		'Lis�� kommentti');
define('_COMMENTFORM_COMMENT',		'Kommenttisi');
define('_COMMENTFORM_NAME',			'Nimi');
define('_COMMENTFORM_MAIL',			'S�hk�postiosoite tai WWW-osoite');
define('_COMMENTFORM_REMEMBER',		'Muista minut');

// loginform
define('_LOGINFORM_NAME',			'Tunnus');
define('_LOGINFORM_PWD',			'Salasana');
define('_LOGINFORM_YOUARE',			'Olet kirjautuneena<br />sis��n tunnuksella<br />');
define('_LOGINFORM_SHARED',			'Usean k�ytt�j�n tietokone');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'L�het� viesti');

// search form
define('_SEARCHFORM_SUBMIT',		'Etsi');

// add item form
define('_ADD_ADDTO',				'Uusi artikkeli blogiin ');
define('_ADD_CREATENEW',			'Luo uusi artikkeli');
define('_ADD_BODY',					'Sis�lt�');
define('_ADD_TITLE',				'Otsikko');
define('_ADD_MORE',					'Laajennettu (optionaalinen)');
define('_ADD_CATEGORY',				'Kategoria');
define('_ADD_PREVIEW',				'Esikatselu');
define('_ADD_DISABLE_COMMENTS',		'Kommentit pois k�yt�st�?');
define('_ADD_DRAFTNFUTURE',			'Vedos &amp; tulevat artikkelit');
define('_ADD_ADDITEM',				'Lis�� artikkeli');
define('_ADD_ADDNOW',				'Lis�� nyt');
define('_ADD_ADDLATER',				'Lis�� my�hemmin');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Lis�� vedoksiin');
define('_ADD_NOPASTDATES',			'(Menneet p�iv�ykset ja kellonajat EIV�T kelpaa, k�yt� meneill��n olevaa aikaa.)');
define('_ADD_BOLD_TT',				'Lihavoitu');
define('_ADD_ITALIC_TT',			'Kursivoitu');
define('_ADD_HREF_TT',				'Luo linkki');
define('_ADD_MEDIA_TT',				'Lis�� media');
define('_ADD_PREVIEW_TT',			'N�yt�/Piilota esikatselu');
define('_ADD_CUT_TT',				'Leikkaa');
define('_ADD_COPY_TT',				'Kopioi');
define('_ADD_PASTE_TT',				'Liit�');


// edit item form
define('_EDIT_ITEM',				'Muokkaa artikkelia');
define('_EDIT_SUBMIT',				'Muokkaa');
define('_EDIT_ORIG_AUTHOR',			'Alkuper�inen kirjoittaja');
define('_EDIT_BACKTODRAFTS',		'Tallenna takaisin vedokseen');
define('_EDIT_COMMENTSNOTE',		'(huomaa: kommenttien pois p��lt� kytkeminen _ei_ piilota aiemmin lis�ttyj� kommentteja)');

// used on delete screens
define('_DELETE_CONFIRM',			'Varmista poistaminen');
define('_DELETE_CONFIRM_BTN',		'Varmista poistaminen');
define('_CONFIRMTXT_ITEM',			'Olet poistamassa seuraavan artikkelin:');
define('_CONFIRMTXT_COMMENT',		'Olet poistamassa seuraavan kommentin:');
define('_CONFIRMTXT_TEAM1',			'Olet poistamassa ');
define('_CONFIRMTXT_TEAM2',			' blogin hallintaryhm�ss� ');
define('_CONFIRMTXT_BLOG',			'Olet poistamassa blogia: ');
define('_WARNINGTXT_BLOGDEL',		'Varoitus! Blogin poisto tulee tuhoamaan kaikki artikkelit ja kommentit kyseisess� blogissa. Vahvista ett� olet AIVAN VARMA siit� mit� olet tekem�ss�!<br />�l� my�sk��n keskeyt� Nucleusta sen poistaessa blogiasi.');
define('_CONFIRMTXT_MEMBER',		'Olet poistamassa seuraavan k�ytt�j�n profiilin: ');
define('_CONFIRMTXT_TEMPLATE',		'Olet poistamassa sivuasetuksen nimelt� ');
define('_CONFIRMTXT_SKIN',			'Olet poistamassa sivurungon nimelt� ');
define('_CONFIRMTXT_BAN',			'Olet poistamassa eston ip-osoitteelle ');
define('_CONFIRMTXT_CATEGORY',		'Olet poistamassa kategorian ');

// some status messages
define('_DELETED_ITEM',				'Artikkeli poistettu');
define('_DELETED_MEMBER',			'K�ytt�j� poistettu');
define('_DELETED_COMMENT',			'Kommentti poistettu');
define('_DELETED_BLOG',				'Blogi poistettu');
define('_DELETED_CATEGORY',			'Kategoria poistettu');
define('_ITEM_MOVED',				'Artikkeli siirretty');
define('_ITEM_ADDED',				'Artikkeli lis�tty');
define('_COMMENT_UPDATED',			'Kommentti p�ivitetty');
define('_SKIN_UPDATED',				'Sivurunkodata on tallennettu');
define('_TEMPLATE_UPDATED',			'Asettelu on tallennettu');

// errors
define('_ERROR_COMMENT_LONGWORD',	'�l� k�yt� yli 60 merkki� pitki� sanoja kommenteissasi');
define('_ERROR_COMMENT_NOCOMMENT',	'Kommentti puuttuu');
define('_ERROR_COMMENT_NOUSERNAME',	'Nimi puuttuu');
define('_ERROR_COMMENT_TOOLONG',	'Kommenttisi on liian pitk� (max. 5000 merkki�)');
define('_ERROR_COMMENTS_DISABLED',	'Kommentointimahdollisuus t�lle blogille on pois k�yt�st�.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Sinun t�ytyy olla kirjautunut k�ytt�j� lis�t�ksesi kommentin t�h�n blogiin');
define('_ERROR_COMMENTS_MEMBERNICK','Tunnus, jota haluat k�ytt�� l�hett��ksesi kommentin on register�ityneen k�ytt�j�n k�yt�ss�. Valitse jokin toinen tunnus.');
define('_ERROR_SKIN',				'Sivurunkovirhe');
define('_ERROR_ITEMCLOSED',			'T�m� artikkeli on suljettu, et voi lis�t� uusia kommentteja siihen tai ��nest�� siin�');
define('_ERROR_NOSUCHITEM',			'Kyseist� artikkelia ei ole');
define('_ERROR_NOSUCHBLOG',			'Kyseist� blogia ei ole');
define('_ERROR_NOSUCHSKIN',			'Kyseist� sivurunkoa ei ole');
define('_ERROR_NOSUCHMEMBER',		'Kyseist� k�ytt�j�� ei ole');
define('_ERROR_NOTONTEAM',			'Et ole t�m�n webblogin hallintaryhm�ss�.');
define('_ERROR_BADDESTBLOG',		'Kohdeblogia ei ole');
define('_ERROR_NOTONDESTTEAM',		'Artikkelia ei voi siirt��, sill� et ole kohdeblogin hallintaryhm�ss�');
define('_ERROR_NOEMPTYITEMS',		'Tyhji� artikkeleita ei voi lis�t�!');
define('_ERROR_BADMAILADDRESS',		'S�hk�postiosoite ei ole kelvollinen');
define('_ERROR_BADNOTIFY',			'Yksi (tai useampi) annettu s�hk�posti-ilmoitusosoite on ep�kelpo s�hk�postiosoite');
define('_ERROR_BADNAME',			'Nimi ei ole hyv�ksytt�v� (vain a-z ja 0-9 ovat hyv�ksytt�vi� merkkej�, ei v�lily�ntej� alussa eik� lopussa)');
define('_ERROR_NICKNAMEINUSE',		'Jo register�itynyt k�ytt�� k�ytt�� jo kyseist� nime�');
define('_ERROR_PASSWORDMISMATCH',	'Salasanojen t�ytyy olla samoja');
define('_ERROR_PASSWORDTOOSHORT',	'Salasanan pit�isi olla ainakin 6 merkki� pitk�');
define('_ERROR_PASSWORDMISSING',	'Salasana on valittava');
define('_ERROR_REALNAMEMISSING',	'Sinun t�ytyy antaa oikea nimesi');
define('_ERROR_ATLEASTONEADMIN',	'Aina pit�isi olla ainakin yksi ylij�rjestelm�nvalvoja, joka voi kirjautua j�rjestelm�nvalvoja alueelle.');
define('_ERROR_ATLEASTONEBLOGADMIN','T�m� toiminnon suorittaminen j�tt�isi blogisi mahdottomaksi yll�pit��. Varmista ett� j�rjestelm�nvalvojia on ainakin yksi.');
define('_ERROR_ALREADYONTEAM',		'Et voi lis�t� k�ytt�j�� joka on jo hallintaryhm�ss�');
define('_ERROR_BADSHORTBLOGNAME',	'Blogin id-nimi saisi sis�lt�� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�');
define('_ERROR_DUPSHORTBLOGNAME',	'Toisella blogilla on jo valittu id-nimi. N�iden nimien tulisi erota toisistaan');
define('_ERROR_UPDATEFILE',			'P�ivitystiedostoon ei voi saada kirjoitusoikeutta. Tarkista ett� tiedosto-oikeudet ovat ok (kokeile chmod 666). Huomaa my�s, ett� sijainti on suhteellinen j�rjestelm�nvalvoja hakemistoon n�hden, joten saattanet haluta k�ytt�� absoluuttista polkua (kuten /sinun/polkusi/nucleukseen/)');
define('_ERROR_DELDEFBLOG',			'Oletusblogia ei voi poistaa');
define('_ERROR_DELETEMEMBER',		'K�ytt�j�� ei voi poistaa, koska h�n on kirjoittanut artikkeleita ja/tai kommentteja tietokantaan');
define('_ERROR_BADTEMPLATENAME',	'Sivuasetukselle antamasi nimi ei kelpaa. K�yt� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�');
define('_ERROR_DUPTEMPLATENAME',	'Toinen asettelu k�ytt�� jo t�t� nime�');
define('_ERROR_BADSKINNAME',		'Ep�kelpo nimi sivurungolle (k�yt� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�)');
define('_ERROR_DUPSKINNAME',		'Toinen sivurunko t�ll� nimell� on jo olemassa');
define('_ERROR_DEFAULTSKIN',		'Sivurunko nimelt� "default" t�ytyy olla olemassa');
define('_ERROR_SKINDEFDELETE',		'Sivurunkoa ei voi poistaa, koska se on vakiosivurunko seuraavalle weblogille: ');
define('_ERROR_DISALLOWED',			'Valitettavasti et ole oikeutettu suorittamaan t�t� toimintoa');
define('_ERROR_DELETEBAN',			'Virhe poistettaessa estoa (estoa ei ole olemassa)');
define('_ERROR_ADDBAN',				'Virhe lis�tt�ess� estoa. Estoa ei ehkei ole lis�tty oikein kaikissa blogeissasi.');
define('_ERROR_BADACTION',			'Pyydetty� toimintoa ei ole');
define('_ERROR_MEMBERMAILDISABLED',	'K�ytt�j�lt� k�ytt�j�lle -viestit ovat poissa k�yt�st�');
define('_ERROR_MEMBERCREATEDISABLED','K�ytt�jien luomismahdollisuus on poissa k�yt�st�');
define('_ERROR_INCORRECTEMAIL',		'Ep�kelpo osoite');
define('_ERROR_VOTEDBEFORE',		'Olet jo antanut ��nesi t�lle artikkelille');
define('_ERROR_BANNED1',			'Toimintoa ei voi suorittaa johtuen siit�, ett� (esto ip:lle ');
define('_ERROR_BANNED2',			') olet estetty tekem�st� niin. Viesti oli: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Sinun t�ytyy olla kirjautunut sis��n suorittaaksesi t�m�n toiminnon');
define('_ERROR_CONNECT',			'Yhdist�misvirhe');
define('_ERROR_FILE_TOO_BIG',		'Tiedosto on liian iso!');
define('_ERROR_BADFILETYPE',		'Valitettavasti t�m� tiedostotyyppi ei ole sallittujen joukossa');
define('_ERROR_BADREQUEST',			'Ep�kelpo tiedostonsiirto-pyynt�');
define('_ERROR_DISALLOWEDUPLOAD',	'Et ole mink��n weblogin hallintaryhm�ss�. T�ten, et ole oikeutettu l�hett�m��n tiedostoja blogiin');
define('_ERROR_BADPERMISSIONS',		'Tiedosto/hakemisto -oikeudet eiv�t ole oikein asetetut');
define('_ERROR_UPLOADMOVEP',		'Virhe tiedostoa siirrett�ess�');
define('_ERROR_UPLOADCOPY',			'Virhe tiedostoa kopioidessa');
define('_ERROR_UPLOADDUPLICATE',	'Toinen samanniminen tiedosto on jo olemassa. Kokeile sen uudelleennime�st� ennen tiedostonsiirtoa.');
define('_ERROR_LOGINDISALLOWED',	'Valitettavasti et ole oikeutettu kirjautumaan j�rjestelm�nvalvoja alueelle. Toisaalta, voit kirjautua sis��n toisena k�ytt�j�n�');
define('_ERROR_DBCONNECT',			'MySQL-palvelimeen ei saatu yhteytt�');
define('_ERROR_DBSELECT',			'Nucleus tietokantaa ei voitu valita.');
define('_ERROR_NOSUCHLANGUAGE',		'Kyseist� kielitiedostoa ei ole olemassa');
define('_ERROR_NOSUCHCATEGORY',		'Kyseist� kategoriaa ei ole olemassa');
define('_ERROR_DELETELASTCATEGORY',	'Ainakin yksi kategoria t�ytyy olla olemassa');
define('_ERROR_DELETEDEFCATEGORY',	'Vakiokategoriaa ei voi tuhota');
define('_ERROR_BADCATEGORYNAME',	'Ep�kelpo kategorian nimi');
define('_ERROR_DUPCATEGORYNAME',	'Toinen samanniminen kategoria samaisella nimell� on jo olemassa');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Varoitus: Nykyinen arvo ei ole hakemisto!');
define('_WARNING_NOTREADABLE',		'Varoitus: Nykyinen arvo on ei-lukuoikeudellinen hakemisto!');
define('_WARNING_NOTWRITABLE',		'Varoitus: Nykyinen arvo EI ole kirjoitusoikeudellinen hakemisto!');

// media and upload
define('_MEDIA_UPLOADLINK',			'L�het� uusi tiedosto');
define('_MEDIA_MODIFIED',			'muokattu');
define('_MEDIA_FILENAME',			'tiedoston nimi');
define('_MEDIA_DIMENSIONS',			'mittasuhteet');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Valitse tiedosto');
define('_UPLOAD_MSG',				'Valitse alta tiedosto, jonka haluat l�hett�� ja paina \'Lataa\' nappia.');
define('_UPLOAD_BUTTON',			'L�het�');

// some status messages
define('_MSG_ACCOUNTCREATED',		'K�ytt�j�tili luotu, salasana l�hetet��n s�hk�postitse');
define('_MSG_PASSWORDSENT',			'Salasana on l�hetetty� s�hk�postitse.');
define('_MSG_LOGINAGAIN',			'Sinun t�ytyy kirjautua sis��n uudelleen, johtuen vaihtuneista tiedoista');
define('_MSG_SETTINGSCHANGED',		'Asetuksia muutettu');
define('_MSG_ADMINCHANGED',			'J�rjestelm�nvalvoja muutettu');
define('_MSG_NEWBLOG',				'Uusi blogi luotu');
define('_MSG_ACTIONLOGCLEARED',		'Toimintologi tyhjennetty');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Ei hyv�ksytt�v� toiminto: ');
define('_ACTIONLOG_PWDREMINDERSENT','Uusi salasana on l�hetetty k�ytt�j�lle ');
define('_ACTIONLOG_TITLE',			'Toimintologi');
define('_ACTIONLOG_CLEAR_TITLE',	'Tyhjenn� toimintologi');
define('_ACTIONLOG_CLEAR_TEXT',		'Tyhjenn� toimintologi nyt');

// team management
define('_TEAM_TITLE',				'K�sittele blogin hallintaryhm�� ');
define('_TEAM_CURRENT',				'Nykyinen hallintaryhm�');
define('_TEAM_ADDNEW',				'Lis�� uusi k�ytt�j� hallintaryhm��n');
define('_TEAM_CHOOSEMEMBER',		'Valitse k�ytt�j�');
define('_TEAM_ADMIN',				'Yll�pit�j�n oikeudet? ');
define('_TEAM_ADD',					'Lis�� hallintaryhm��n');
define('_TEAM_ADD_BTN',				'Lis�� hallintaryhm��n');

// blogsettings
define('_EBLOG_TITLE',				'S��d� asetuksia blogiin');
define('_EBLOG_TEAM_TITLE',			'K�sittele hallintaryhm��');
define('_EBLOG_TEAM_TEXT',			'Klikkaa t�st� k�sitell�ksesi hallintaryhm��si.');
define('_EBLOG_SETTINGS_TITLE',		'Blogin asetukset');
define('_EBLOG_NAME',				'Blogin nimi');
define('_EBLOG_SHORTNAME',			'Blogin id-nimi');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(saisi sis�lt�� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�)');
define('_EBLOG_DESC',				'Blogin kuvaus');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Vakiosivurunko');
define('_EBLOG_DEFCAT',				'Vakiokategoria');
define('_EBLOG_LINEBREAKS',			'Konvertoi rivinvaihdot');
define('_EBLOG_DISABLECOMMENTS',	'Kommentit sallittuja?<br /><small>(Est�m�ll� kommenttien kirjoittaminen, kommenttien lis��minen ei ole mahdollista.)</small>');
define('_EBLOG_ANONYMOUS',			'Salli kommentit ei-k�ytt�jilt�?');
define('_EBLOG_NOTIFY',				'Ilmoituss�hk�postiosoite/-osoitteet (k�yt� puolipistemerkki� ; erottajana)');
define('_EBLOG_NOTIFY_ON',			'Ilmoitukset p��ll�');
define('_EBLOG_NOTIFY_COMMENT',		'Uusista kommenteista');
define('_EBLOG_NOTIFY_KARMA',		'Uusista karma ��nestyksist�');
define('_EBLOG_NOTIFY_ITEM',		'Uusista weblogin artikkeleista');
define('_EBLOG_PING',				'Pingaa Weblogs.com p�ivityksist�?');
define('_EBLOG_MAXCOMMENTS',		'Kommenttien maksimim��r�');
define('_EBLOG_UPDATE',				'P�ivitystiedosto');
define('_EBLOG_OFFSET',				'Ajan muutos');
define('_EBLOG_STIME',				'Nykyinen serverin aika on');
define('_EBLOG_BTIME',				'Nykyinen blogin aika on');
define('_EBLOG_CHANGE',				'Muuta asetuksia');
define('_EBLOG_CHANGE_BTN',			'Muuta asetuksia');
define('_EBLOG_ADMIN',				'Blogin yll�pito');
define('_EBLOG_ADMIN_MSG',			'Sinulle asetetaan j�rjestelm�nvalvoja oikeudet');
define('_EBLOG_CREATE_TITLE',		'Uusi weblogi');
define('_EBLOG_CREATE_TEXT',		'T�yt� alla oleva kaavake luodaksesi uuden weblogin. <br /><br /> <b>Huomaa:</b> Vain tarvittavat kent�t on listattu. Jos haluat s��t�� muita optioita, siirry blogin asetussivulle weblogin luomisen j�lkeen.');
define('_EBLOG_CREATE',				'Luo!');
define('_EBLOG_CREATE_BTN',			'Luo weblogi');
define('_EBLOG_CAT_TITLE',			'Kategoriat');
define('_EBLOG_CAT_NAME',			'Kategorian nimi');
define('_EBLOG_CAT_DESC',			'Kategorian kuvaus');
define('_EBLOG_CAT_CREATE',			'Luo uusi kategoria');
define('_EBLOG_CAT_UPDATE',			'P�ivit� kategoria');
define('_EBLOG_CAT_UPDATE_BTN',		'P�ivit� kategoria');

// templates
define('_TEMPLATE_TITLE',			'Asettelut');
define('_TEMPLATE_AVAILABLE_TITLE',	'Tarjolla olevat asettelut');
define('_TEMPLATE_NEW_TITLE',		'Uusi asettelu');
define('_TEMPLATE_NAME',			'Asettelun nimi');
define('_TEMPLATE_DESC',			'Asettelun kuvaus');
define('_TEMPLATE_CREATE',			'Luo asettelu');
define('_TEMPLATE_CREATE_BTN',		'Luo asettelu');
define('_TEMPLATE_EDIT_TITLE',		'Asettelut');
define('_TEMPLATE_BACK',			'Takaisin asettelut -sivulle');
define('_TEMPLATE_EDIT_MSG',		'Kaikkia asetteluja ei tarvita. Voit j�tt�� osan tyhj�ksi.');
define('_TEMPLATE_SETTINGS',		'Asettelun asetukset');
define('_TEMPLATE_ITEMS',			'Artikkelit');
define('_TEMPLATE_ITEMHEADER',		'Artikkelin yl�tunniste');
define('_TEMPLATE_ITEMBODY',		'Artikkelin sis�lt�');
define('_TEMPLATE_ITEMFOOTER',		'Artikkelin alatunniste');
define('_TEMPLATE_MORELINK',		'Linkki laajennettuun artikkeliin');
define('_TEMPLATE_NEW',				'Uuden artikkelin merkki');
define('_TEMPLATE_COMMENTS_ANY',	'Kommentit (jos niit� on)');
define('_TEMPLATE_CHEADER',			'Kommentin yl�tunniste');
define('_TEMPLATE_CBODY',			'Kommentin sis�lt�');
define('_TEMPLATE_CFOOTER',			'Kommentin alatunniste');
define('_TEMPLATE_CONE',			'Yksi kommentti');
define('_TEMPLATE_CMANY',			'Kaksi (tai useampi) kommenttia');
define('_TEMPLATE_CMORE',			'Kommentin lue_lis��');
define('_TEMPLATE_CMEXTRA',			'K�ytt�j�extrat');
define('_TEMPLATE_COMMENTS_NONE',	'Kommentit (jos niit� ei ole)');
define('_TEMPLATE_CNONE',			'Ei kommentteja');
define('_TEMPLATE_COMMENTS_TOOMUCH','Kommentit (jos niit� on, mutta liikaa jotta ne voitaisiin n�ytt��)');
define('_TEMPLATE_CTOOMUCH',		'Liikaa kommentteja');
define('_TEMPLATE_ARCHIVELIST',		'Arkistolistaukset');
define('_TEMPLATE_AHEADER',			'Arkistolistauksen yl�tunniste');
define('_TEMPLATE_AITEM',			'Arkistolistauksen artikkeli');
define('_TEMPLATE_AFOOTER',			'Arkistolistauksen alatunniste');
define('_TEMPLATE_DATETIME',		'P�iv�ys ja kellonaika');
define('_TEMPLATE_DHEADER',			'P�iv�yksen yl�tunniste');
define('_TEMPLATE_DFOOTER',			'P�iv�yksen alatunniste');
define('_TEMPLATE_DFORMAT',			'P�iv�yksen formaatti');
define('_TEMPLATE_TFORMAT',			'Kellonajan formaatti');
define('_TEMPLATE_LOCALE',			'Paikallinen p�iv�ys');
define('_TEMPLATE_IMAGE',			'Kuva popupit');
define('_TEMPLATE_PCODE',			'Popupin linkkikoodi');
define('_TEMPLATE_ICODE',			'Inline kuvan koodi');
define('_TEMPLATE_MCODE',			'Media objektin linkkikoodi');
define('_TEMPLATE_SEARCH',			'Etsi');
define('_TEMPLATE_SHIGHLIGHT',		'Korosta');
define('_TEMPLATE_SNOTFOUND',		'Haku ei palauttanut mit��n');
define('_TEMPLATE_UPDATE',			'P�ivit�');
define('_TEMPLATE_UPDATE_BTN',		'P�ivit� asettelu');
define('_TEMPLATE_RESET_BTN',		'Resetoi data');
define('_TEMPLATE_CATEGORYLIST',	'Kategorialistaus');
define('_TEMPLATE_CATHEADER',		'Kategorialistan yl�tunniste');
define('_TEMPLATE_CATITEM',			'Kategorialistan kategoria');
define('_TEMPLATE_CATFOOTER',		'Kategorialistan alatunniste');

// skins
define('_SKIN_EDIT_TITLE',			'Sivurungot');
define('_SKIN_AVAILABLE_TITLE',		'Tarjolla olevat sivurungot');
define('_SKIN_NEW_TITLE',			'Uusi sivurunko');
define('_SKIN_NAME',				'Nimi');
define('_SKIN_DESC',				'Kuvaus');
define('_SKIN_TYPE',				'Sis�ll�n tyyppi');
define('_SKIN_CREATE',				'Luo');
define('_SKIN_CREATE_BTN',			'Luo sivurunko');
define('_SKIN_EDITONE_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_BACK',				'Takaisin sivurunko -sivulle');
define('_SKIN_PARTS_TITLE',			'Sivurungon osat');
define('_SKIN_PARTS_MSG',			'Kaikkia osia ei tarvita jokaiselle sivurungolle. J�t� tyhj�ksi ne joita et tarvitse. Valitse muokattava sivurunko alta:');
define('_SKIN_PART_MAIN',			'Artikkelit (indeksi)');
define('_SKIN_PART_ITEM',			'Yksitt�iset artikkelisivut');
define('_SKIN_PART_ALIST',			'Arkisto (indeksi)');
define('_SKIN_PART_ARCHIVE',		'Arkistolistaukset');
define('_SKIN_PART_SEARCH',			'Etsi');
define('_SKIN_PART_ERROR',			'Virheet');
define('_SKIN_PART_MEMBER',			'K�ytt�j�n tiedot');
define('_SKIN_PART_POPUP',			'Kuva popupit');
define('_SKIN_GENSETTINGS_TITLE',	'Yleiset asetukset');
define('_SKIN_CHANGE',				'Muuta');
define('_SKIN_CHANGE_BTN',			'Muuta n�it� asetuksia');
define('_SKIN_UPDATE_BTN',			'P�ivit� sivurunko');
define('_SKIN_RESET_BTN',			'Resetoi data');
define('_SKIN_EDITPART_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_GOBACK',				'Palaa takaisin');
define('_SKIN_ALLOWEDVARS',			'Sallitut muuttujat (klikkaa saadaksesi infoa):');

// global settings
define('_SETTINGS_TITLE',			'Yleiset asetukset');
define('_SETTINGS_SUB_GENERAL',		'Yleiset asetukset');
define('_SETTINGS_DEFBLOG',			'Vakioblogi');
define('_SETTINGS_ADMINMAIL',		'Yll�pit�j�n s�hk�postiosoite');
define('_SETTINGS_SITENAME',		'Sivuston nimi');
define('_SETTINGS_SITEURL',			'Sivuston URL (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_ADMINURL',		'J�rjestelm�nvalvoja-alueen osoite (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_DIRS',			'Nucleus -hakemisto');
define('_SETTINGS_MEDIADIR',		'Media -hakemisto');
define('_SETTINGS_SEECONFIGPHP',	'(katso config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_ALLOWUPLOAD',		'Salli tiedostojen l�hetys blogiin?');
define('_SETTINGS_ALLOWUPLOADTYPES','Sallitut tiedostomuodot l�hett�ess�');
define('_SETTINGS_CHANGELOGIN',		'Salli k�ytt�jien vaihtaa tunnusta/salasanaa');
define('_SETTINGS_COOKIES_TITLE',	'Ev�steasetukset');
define('_SETTINGS_COOKIELIFE',		'Kirjautumisev�steen elinaika');
define('_SETTINGS_COOKIESESSION',	'Istuntoev�ste');
define('_SETTINGS_COOKIEMONTH',		'Kuukauden elinaika');
define('_SETTINGS_COOKIEPATH',		'Ev�stepolku (edistykselliset)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (edistykselliset)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (edistykselliset)');
define('_SETTINGS_LASTVISIT',		'Tallenna edellisen k�ynnin ev�steet');
define('_SETTINGS_ALLOWCREATE',		'Salli k�ytt�jien luoda k�ytt�j�tili');
define('_SETTINGS_NEWLOGIN',		'Sis��nkirjautuminen sallittu k�ytt�j�n luomilla tileill�');
define('_SETTINGS_NEWLOGIN2',		'(koskee vain vasta luotuja tilej�)');
define('_SETTINGS_MEMBERMSGS',		'Salli k�ytt�j�lt�-k�ytt�j�lle palvelu');
define('_SETTINGS_LANGUAGE',		'Vakiokieli');
define('_SETTINGS_DISABLESITE',		'Sivusto pois k�yt�st�');
define('_SETTINGS_DBLOGIN',			'MySQL -kirjautuminen &amp; -tietokanta');
define('_SETTINGS_UPDATE',			'P�ivit� asetukset');
define('_SETTINGS_UPDATE_BTN',		'P�ivit� asetukset');
define('_SETTINGS_DISABLEJS',		'JavaScript -ty�kalurivi pois k�yt�st�');
define('_SETTINGS_MEDIA',			'Media/lataus -asetukset');
define('_SETTINGS_MEDIAPREFIX',		'P�iv�ysetuliite ladatuille tiedostoille');
define('_SETTINGS_MEMBERS',			'K�ytt�j�asetukset');

// bans
define('_BAN_TITLE',				'Estolistasi blogissa');
define('_BAN_NONE',					'Ei estoja t�lle weblogille');
define('_BAN_NEW_TITLE',			'Lis�� uusi esto');
define('_BAN_NEW_TEXT',				'Lis�� uusi esto nyt');
define('_BAN_REMOVE_TITLE',			'Poista esto');
define('_BAN_IPRANGE',				'IP-osoite');
define('_BAN_BLOGS',				'Mitk� blogit?');
define('_BAN_DELETE_TITLE',			'Poista esto');
define('_BAN_ALLBLOGS',				'Kaikki blogit joihin sinulla on j�rjestelm�nvalvojan oikeudet.');
define('_BAN_REMOVED_TITLE',		'Esto poistettu');
define('_BAN_REMOVED_TEXT',			'Esto poistettu seuraavista blogeista:');
define('_BAN_ADD_TITLE',			'Lis�� esto');
define('_BAN_IPRANGE_TEXT',			'Valitse ip-osoite, jonka haluat blokata. Mit� v�hemm�n numeroita siin� on, sit� enemm�n osoitteita tullaan blokkaamaan.');
define('_BAN_BLOGS_TEXT',			'Voit est�� ip:n vain yhdell� blogilla tai voit est�� ip:n kaikilla niill� blogeilla, joihin sinulla j�rjestelm�nvalvojan oikeudet. Tee valintasi alla.');
define('_BAN_REASON_TITLE',			'Syy');
define('_BAN_REASON_TEXT',			'Voit osoittaa syyn estolle, joka n�ytet��n kun ip:n haltija yritt�� lis�t� uuden kommentin tai antaa karma ��nen. Maksimipituus on 256 merkki�.');
define('_BAN_ADD_BTN',				'Lis�� esto');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Viesti');
define('_LOGIN_NAME',				'Tunnus');
define('_LOGIN_PASSWORD',			'Salasana');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Unohditko salasanasi?');

// membermanagement
define('_MEMBERS_TITLE',			'K�ytt�j�t');
define('_MEMBERS_CURRENT',			'Nykyiset k�ytt�j�t');
define('_MEMBERS_NEW',				'Uusi k�ytt�j�');
define('_MEMBERS_DISPLAY',			'Tunnus');
define('_MEMBERS_DISPLAY_INFO',		'(T�m� on tunnus jota k�yt�t kirjautumiseen)');
define('_MEMBERS_REALNAME',			'Oikea nimi');
define('_MEMBERS_PWD',				'Salasana');
define('_MEMBERS_REPPWD',			'Toista salasana');
define('_MEMBERS_EMAIL',			'S�hk�postiosoite');
define('_MEMBERS_EMAIL_EDIT',		'(Kun vaihdat s�hk�postiosoitetta, uusi salasana tullaan automaattisesti postittamaan siihen osoitteeseen)');
define('_MEMBERS_URL',				'Sivuston osoite (URL)');
define('_MEMBERS_SUPERADMIN',		'J�rjestelm�nvalvojan oikeudet');
define('_MEMBERS_CANLOGIN',			'Voi kirjautua j�rjestelm�nvalvoja alueelle');
define('_MEMBERS_NOTES',			'Tietoja');
define('_MEMBERS_NEW_BTN',			'Lis�� k�ytt�j�');
define('_MEMBERS_EDIT',				'K�ytt�j�tietojen muokkaus');
define('_MEMBERS_EDIT_BTN',			'Muuta asetuksia');
define('_MEMBERS_BACKTOOVERVIEW',	'Takaisin k�ytt�j�t -sivulle');
define('_MEMBERS_LOCALE',			'Kieli');
define('_MEMBERS_USESITELANG',		'- k�yt� sivuston vakioasetusta -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'K�y sivustolla');
define('_BLOGLIST_ADD',				'Lis�� artikkeli');
define('_BLOGLIST_TT_ADD',			'Lis�� artikkeli t�h�n weblogiin');
define('_BLOGLIST_EDIT',			'Muokkaa/poista artikkeleita');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Asetukset');
define('_BLOGLIST_TT_SETTINGS',		'S��d� asetuksia tai k�sittele hallintaryhm��');
define('_BLOGLIST_BANS',			'Estot');
define('_BLOGLIST_TT_BANS',			'Tarkastele, lis�� tai poista estettyj� ip:it�');
define('_BLOGLIST_DELETE',			'Poista kaikki');
define('_BLOGLIST_TT_DELETE',		'Poista t�m� weblogi');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Weblogisi');
define('_OVERVIEW_YRDRAFTS',		'Vedoksesi');
define('_OVERVIEW_YRSETTINGS',		'Asetuksesi');
define('_OVERVIEW_GSETTINGS',		'Yleiset asetukset');
define('_OVERVIEW_NOBLOGS',			'Et ole mink��n weblogin hallintaryhm�ss�');
define('_OVERVIEW_NODRAFTS',		'Ei vedoksia');
define('_OVERVIEW_EDITSETTINGS',	'Muokkaa omia tietojasi...');
define('_OVERVIEW_BROWSEITEMS',		'Selaa artikkeleitasi...');
define('_OVERVIEW_BROWSECOMM',		'Selaa kommenttejasi...');
define('_OVERVIEW_VIEWLOG',			'Tarkastele toimintologia...');
define('_OVERVIEW_MEMBERS',			'Hallitse k�ytt�ji�...');
define('_OVERVIEW_NEWLOG',			'Luo uusi weblogi...');
define('_OVERVIEW_SETTINGS',		'S��d� yleisi� asetuksia...');
define('_OVERVIEW_TEMPLATES',		'Muokkaa asetteluja...');
define('_OVERVIEW_SKINS',			'Muokkaa sivurunkoja...');
define('_OVERVIEW_BACKUP',			'Tee varmuuskopio / palauta varmuuskopio...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Artikkelit blogiin'); 
define('_ITEMLIST_YOUR',			'Artikkelisi');

// Comments
define('_COMMENTS',					'Kommentteja');
define('_NOCOMMENTS',				'Ei kommentteja t�h�n artikkeliin');
define('_COMMENTS_YOUR',			'Kommenttisi');
define('_NOCOMMENTS_YOUR',			'Et ole kirjoittanut kommentteja');

// LISTS (general)
define('_LISTS_NOMORE',				'Ei en�� hakuvastauksia tai ei hakuvastauksia ollenkaan');
define('_LISTS_PREV',				'Edellinen');
define('_LISTS_NEXT',				'Seuraava');
define('_LISTS_SEARCH',				'Etsi');
define('_LISTS_CHANGE',				'Muuta');
define('_LISTS_PERPAGE',			'artikkelia/sivu');
define('_LISTS_ACTIONS',			'Toiminnot');
define('_LISTS_DELETE',				'Poista');
define('_LISTS_EDIT',				'Muokkaa');
define('_LISTS_MOVE',				'Siirr�');
define('_LISTS_CLONE',				'Monista');
define('_LISTS_TITLE',				'Otsikko');
define('_LISTS_BLOG',				'Blogi');
define('_LISTS_NAME',				'Nimi');
define('_LISTS_DESC',				'Kuvaus');
define('_LISTS_TIME',				'P�iv�ys');
define('_LISTS_COMMENTS',			'Kommentit');
define('_LISTS_TYPE',				'Tyyppi');


// member list 
define('_LIST_MEMBER_NAME',			'Tunnus');
define('_LIST_MEMBER_RNAME',		'Oikea nimi');
define('_LIST_MEMBER_ADMIN',		'Ylij�rjestelm�nvalvoja? ');
define('_LIST_MEMBER_LOGIN',		'Voi kirjautua sis��n? ');
define('_LIST_MEMBER_URL',			'Verkkosivut');

// banlist
define('_LIST_BAN_IPRANGE',			'IP-osoite');
define('_LIST_BAN_REASON',			'Syy');

// actionlist
define('_LIST_ACTION_MSG',			'Viesti');

// commentlist
define('_LIST_COMMENT_BANIP',		'Est� IP');
define('_LIST_COMMENT_WHO',			'Kirjoittaja');
define('_LIST_COMMENT',				'Kommentti');
define('_LIST_COMMENT_HOST',		'Is�nt�kone');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Otsikko ja teksti');


// teamlist
define('_LIST_TEAM_ADMIN',			'J�rjestelm�nvalvoja ');
define('_LIST_TEAM_CHADMIN',		'Vaihda j�rjestelm�nvalvoja');

// edit comments
define('_EDITC_TITLE',				'Muokkaa kommentteja');
define('_EDITC_WHO',				'Kirjoittaja');
define('_EDITC_HOST',				'Mist�?');
define('_EDITC_WHEN',				'Milloin?');
define('_EDITC_TEXT',				'Teksti');
define('_EDITC_EDIT',				'Muokkaa kommenttia');
define('_EDITC_MEMBER',				'k�ytt�j�');
define('_EDITC_NONMEMBER',			'ei-k�ytt�j�');

// move item
define('_MOVE_TITLE',				'Siirr� mihin blogiin?');
define('_MOVE_BTN',					'Siirr� artikkeli');
