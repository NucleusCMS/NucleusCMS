<?php
// English Nucleus Language File
//
// Author: The Nucleus Group and other authors
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

/**
 * English Nucleus Language File
 *
 */

/********************************************
 *        Important Settings                *
 ********************************************/
try_define('_CHARSET', 'UTF-8'); // charset to use
try_define('_LOCALE', 'en_US');
try_define('_LOCALE_NAME_WINDOWS', 'english');
try_define('_HTML_5_LANG_CODE', 'en');

/********************************************
 *        Admin Links Settings                *
 ********************************************/
try_define('_MANAGE_LINKS_ITEMS', '<li><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></li>
<li><a href="http://nucleuscms.org/forum/" title="Nucleus CMS Support Forum">nucleuscms.org/forum/</a></li>
<li><a href="http://nucleuscms.org/docs/" title="Nucleus CMS Documentation">nucleuscms.org/docs/</a></li>
<li><a href="http://nucleuscms.org/wiki/" title="Nucleus CMS Wiki">nucleuscms.org/wiki/</a></li>
<li><a href="http://nucleuscms.org/skins/" title="Nucleus CMS Skins">nucleuscms.org/skins/</a></li>
<li><a href="http://nucleuscms.org/wiki/doku.php/plugin" title="Nucleus CMS Plugins">nucleuscms.org/wiki/doku.php/plugin</a></li>
<li><a href="http://nucleuscms.org/dev/" title="Nucleus Developer Network">nucleuscms.org/dev/</a></li>
');

/********************************************
 *        Start New for                     *
 ********************************************/

/********************************************
 *        Start New for 3.80                *
 ********************************************/

try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_TITLE', 'Which page do you want to select after saving the item?');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_ITEM' , 'back to the item');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST' , 'back to item lists');
try_define('_ADMIN_MEMBER_ITEMSAVE_SELECTPAGE_LIST_WITH_CATEGORY' , 'back to item lists with category');

try_define('ERROR_PASSWORD_INVALID_CHARACTERS',  'password contains invalid characters');

try_define('_SETTINGS_ENABLE_RSS',          'Enable RSS output');

try_define('_ERROR_NOSUCHPAGE',				'No such page');
try_define('_SKIN_PARTS_SPECIAL_PAGE',     'Special skin page');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE',  'Do you really want to delete this special skin page?');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_STYPE_CHANGE',  'Do you really want to change this special skin parts type?');
try_define('_ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST',          'There are no special skin parts.');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST',     'There are no special skin page.');
try_define('_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE',       'can not change the type of special skin part');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE',  'can not change the type of special skin page');
try_define('_ADMIN_TEXT_CHANGE_CONFIRM',     'Please check the change');
try_define('_ADMIN_TEXT_CHANGE',             'change');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PAGE',     'Change to special skin page');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PARTS',    'Change to special skin part');

try_define('_ADMIN_TEXT_UPGRADE_REQUIRED',       'Database upgrade is required.');
try_define('_ADMIN_TEXT_CLICK_HERE_TO_UPGRADE',  'Click here to upgrade the database to Nucleus v%s');

try_define('_LISTS_FORM_SELECT_ITEM_FILTER',                     'Filter');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_ALL',                 'All');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL',              'Normal published');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL_TERM_FUTURE',  'Normal future');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_DRAFT',             'Draft');

try_define('_EDIT_DATE_FORMAT',           'day,month,year');
try_define('_EDIT_DATE_FORMAT_SEPARATOR', '/,/,at,:,');
try_define('_EDIT_DATE_FORMAT_DESC',      '(dd/mm/yyyy hh:mm)');

try_define('_ADD_DATEINPUTNOW',       'now');
try_define('_ADD_DATEINPUTRESET',     'reset');

try_define('_LINKS',                                'Links');
try_define('_MEMBERS_PASSWORD_INFO',				'(Password should be at least 6 characters)');

try_define('_NUMBER_OF_POST',		'Number of post');
try_define('_NUMBER_OF_COMMENT',	'Number of comment');

try_define('_ADMIN_CAN_DELETE',	'Can be deleted');
try_define('_ADMIN_MEMBER_HALT_TITLE' ,             'Halt a member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TITLE' ,     'Halt a member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TEXT' ,      'Trying to stop the following member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_DONE_BTN' ,  'Execute stop a member');
try_define('_ADMIN_MEMBER_SUPERADMIN',              'Sper admin');
try_define('_LISTS_HALT',		'Halt');
try_define('_LISTS_HALTING',  	'Under suspension');
try_define('_ERROR_ADMIN_MEMBER_HALT_SELF',         'Perhaps this member, because it is the management\'s own logged in, you can not stop.');
try_define('_ERROR_ADMIN_MEMBER_ALREADY_HALTED',    'This member is already stopped.');
try_define('_ERROR_LOGIN_MEMBER_HALT_OR_INVALID',   'This member is invalid or stop.');
try_define('_ERROR_LOGIN_DISALLOWED_BY_HALT',       'This member is currently disabled. Logon is not permitted. If you\'re have an account of the administrative user, please log back in as an administrative user.');
try_define('_GFUNCTIONS_LOGIN_FAILED_HALT_TXT',     'Member [% s] is disabled or stopped. You can not log in.');

try_define('_ADMIN_DATABASE_OPTIMIZATION_REPAIR',      'Database Optimization/Repair');
try_define('_ADMIN_TITLE_OPTIMIZE',      'Optimize');
try_define('_ADMIN_TITLE_REPAIR',        'Repair');
try_define('_ADMIN_FILESIZE',            'File size');
try_define('_ADMIN_NEW',                 'New');
try_define('_ADMIN_OLD',                 'Old');
try_define('_ADMIN_TABLENAME',           'Table name');
try_define('_ADMIN_CONFIRM_TITLE_OPTIMIZE',    'Are you sure you want to optimize the tables?');
try_define('_ADMIN_CONFIRM_TITLE_AUTO_REPAIR', 'Are you sure you want to automatically repair the tables?');
try_define('_ADMIN_EXEC_TITLE_AUTO_REPAIR',    'tables repaired.');
try_define('_ADMIN_EXEC_TITLE_OPTIMIZE',       'tables optimized.');
try_define('_ADMIN_BTN_TITLE_AUTO_REPAIR',     'Repair');
try_define('_ADMIN_BTN_TITLE_OPTIMIZE',        'Optimize');
try_define('_ADMIN_PLEASE_OPTIMIZE',           'Optimize please');

try_define('_PROBLEMS_FOUND_ON_TABLE',   'problems found on table');
try_define('_NO_PROBLEMS_FOUND',         'No problems found');
try_define('_NOT_IMPLEMENTED_YET',       'Not implemented yet.');
try_define('_SIZE',                      'Size');
try_define('_OVERHEAD',                  'Overhead');

try_define('_MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT',   "Plugin %s was not loaded (does not support SqlApi_%s or SqlApi_SQL92. Please upgrade to the latest version of the plug-ins that support this feature.)");

try_define('_DEFAULT_DATE_FORMAT_YMD',         '%d/%m/%Y');
try_define('_DEFAULT_DATE_FORMAT_YBD',         '%d %B %Y');
try_define('_DEFAULT_DATE_FORMAT_YM',          '%m %Y');
try_define('_DEFAULT_DATE_FORMAT_YB',          '%B %Y');
try_define('_DEFAULT_DATE_FORMAT_MD',          '%m %d');
try_define('_DEFAULT_DATE_FORMAT_BD',          '%B %d');
try_define('_DEFAULT_DATE_FORMAT_Y',           '%Y');

try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM',      'About system core');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_VERSION',     'Core version');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_PATCHLEVEL',  'Core patch level');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_DB_VERSION', 'Core database version');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SETTINGS',    'Core important settings');

try_define('_ADMIN_SYSTEMOVERVIEW_DB_VERSION',  'Database version');

// Blog option
try_define('_EBLOG_VISIBLE_ITEM_AUTHOR',           "allow the display of the item's author");

try_define('_ADMIN_LOST_PSWD_TEXT_TITLE', "Forgot your password?");
try_define('_ADMIN_LOST_PSWD_TEXT_1', "Enter your username and email address below, and you'll be sent an e-mail with a link where you can choose a new password.");
try_define('_ADMIN_LOST_PSWD_TEXT_2', "If you don't remember your exact username, contact the site administrator.");
try_define('_ADMIN_LOST_PSWD_TEXT_3', "Send Activation Link");
try_define('_ADMIN_LOST_PSWD_TEXT_USENAME', "Username:");
try_define('_ADMIN_LOST_PSWD_TEXT_EMAIL', "Email address:");

try_define('_SETTINGS_TIDY_ENABLE', "Enable html auto-formatting by Tidy");
try_define('_SETTINGS_TIDY_INDENT_ENABLE', "Tidy: Indent the html tag");
try_define('_SETTINGS_TIDY_HIDE_COMMENT',  "TIDY_HIDE_COMMENT");
try_define('_SETTINGS_TIDY_HIDE_COMMENT_ADMIN',  "TIDY_HIDE_COMMENT_ADMIN");

try_define('_SYSTEMLOG_TITLE',       "System Log");
try_define('_SYSTEMLOG_CLEAR_TITLE', "Clear system Log");
try_define('_SYSTEMLOG_CLEAR_TEXT',  "Clear system log now");
try_define('_MSG_SYSTEMLOGCLEARED',  "System Log Cleared");

/********************************************
 *        Start New for 3.71                *
 ********************************************/
try_define('_ADMIN_SYSTEMOVERVIEW_DBANDVERSION',  'Database and Version');
try_define('_ADMIN_SYSTEMOVERVIEW_DBDRIVER',      'Database Driver');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPANDDB',      'PHP and Database');

try_define('_TEAM_NO_SELECTABLE_MEMBERS',         'team does not have selectable members');

try_define('_LISTS_FORM_SELECT_ALL_CATEGORY',    'All categories');

try_define('_LIST_BACK_TO',				'Back to %s');
try_define('_LIST_COMMENT_LIST_FOR_BLOG',		'Blog comments list');
try_define('_LIST_COMMENT_LIST_FOR_ITEM',		'Comments list of items');
try_define('_LIST_COMMENT_VIEW_ITEM',			'Show item');
try_define('_LISTS_VIEW',						'Show');

try_define('_LISTS_ITEM_COUNT',      'Item count');
try_define('_LISTS_ORDER',           'order');

try_define('_EBLOG_CAT_ORDER',            "This is the order of the category.<br />\nInput value will be on the smaller in number (standard 100)");
try_define('_EBLOG_CAT_ORDER_DESC2',      "Input value will be on the smaller in number (standard 100)");

// category order changes (batch)
try_define('_BATCH_CAT_CAHANGE_ORDER',                 'change the order');
try_define('_ERROR_CAHANGE_CATEGORY_ORDER',            'You can not change the sort');
try_define('_CAHANGE_CATEGORY_ORDER_TITLE',            'Please specify the order of the category');
try_define('_CAHANGE_CATEGORY_ORDER_CONFIRM_DESC',     'The order of the following categories will be changed at once.If it is good, please press the button.');
try_define('_CAHANGE_CATEGORY_ORDER_BTN_TITLE',        'Change the order');

// Skin import/export
try_define('_SKINIE_ERROR_FAILEDLOAD_XML',        'Failed to Load XML');

 /********************************************
 *        Start New for 3.65                *
 ********************************************/
try_define('_LISTS_AUTHOR', 'Author');
try_define('_OVERVIEW_OTHER_DRAFTS', 'Other Drafts');
 
/********************************************
 *        Start New for 3.64                *
 ********************************************/
try_define('_ERROR_USER_TOO_LONG', 'Please enter a name shorter than 40 characters.');
try_define('_ERROR_EMAIL_TOO_LONG', 'Please enter an email shorter than 100 characters.');
try_define('_ERROR_URL_TOO_LONG', 'Please enter a website shorter than 100 characters.');

/********************************************
 *        Start New for 3.62                *
 ********************************************/
try_define('_SETTINGS_ADMINCSS',		'Admin Area Style');

/********************************************
 *        Start New for 3.50                *
 ********************************************/
try_define('_PLUGS_TITLE_GETPLUGINS',		'get more plugins...');
try_define('_ARCHIVETYPE_YEAR', 'year');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'Newer Version Available');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'Upgrade available: v');
//try_define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "Plugin %s was not loaded (does not support SqlApi. Please upgrade to the latest version of the plug-ins that support this feature.)");

/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
try_define('_MEMBERS_USEAUTOSAVE',						'Use the Autosave function?');

try_define('_TEMPLATE_PLUGIN_FIELDS',					'Custom Plugin Fields');
try_define('_TEMPLATE_BLOGLIST',						'Template Blog List');
try_define('_TEMPLATE_BLOGHEADER',						'Blog List Header');
try_define('_TEMPLATE_BLOGITEM',						'Blog List Item');
try_define('_TEMPLATE_BLOGFOOTER',						'Blog List Footer');

try_define('_SETTINGS_DEFAULTLISTSIZE',					'Default Size of Lists in Admin Area');
try_define('_SETTINGS_DEBUGVARS',						'Debug Vars');
try_define('_SETTINGS_ENABLEQUERYCACHE',				'Enable query cache');
try_define('_SETTINGS_ENABLEQUERYCACHE_NOTE',			'');

try_define('_CREATE_ACCOUNT_TITLE',						'Create Member Account');
try_define('_CREATE_ACCOUNT0',							'Create Account');
try_define('_CREATE_ACCOUNT1',							'Visitors are not allowed to create a Member Account.<br /><br />');
try_define('_CREATE_ACCOUNT2',							'Please contact the website administrator for more information.');
try_define('_CREATE_ACCOUNT_USER_DATA',					'Account Info.');
try_define('_CREATE_ACCOUNT_LOGIN_NAME',				'Login Name (required):');
try_define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',			'only a-z and 0-9 allowed, no spaces at start/end');
try_define('_CREATE_ACCOUNT_REAL_NAME',					'Real Name (required):');
try_define('_CREATE_ACCOUNT_EMAIL',						'Email (required):');
try_define('_CREATE_ACCOUNT_EMAIL2',					'(must be valid, because an activation link will be sent over there)');
try_define('_CREATE_ACCOUNT_URL',						'URL:');
try_define('_CREATE_ACCOUNT_SUBMIT',					'Create Account');

try_define('_BMLET_BACKTODRAFTS',		'Move back to drafts');
try_define('_BMLET_CANCEL',				'Cancel');

try_define('_LIST_ITEM_NOCONTENT',						'No Comment');
try_define('_LIST_ITEM_COMMENTS',						'%d Comments');

try_define('_EDITC_URL',				'Web site');
try_define('_EDITC_EMAIL',				'E-mail');

try_define('_MANAGER_PLUGINFILE_NOTFOUND',				"Plugin %s was not loaded (File not found)");
/* changed */
// plugin dependency 
try_define('_ERROR_INSREQPLUGIN',		'Plugin installation failed, requires %s');
try_define('_ERROR_DELREQPLUGIN',		'Plugin deletion failed, required by %s');

//try_define('_ADD_ADDLATER',								'Add Later');
try_define('_ADD_ADDLATER',								'Add the dates specified');

try_define('_LOGIN_NAME',				'Name:');
try_define('_LOGIN_PASSWORD',			'Password:');

// changed from _BOOKMARLET_BMARKLFOLLOW
try_define('_BOOKMARKLET_BMARKFOLLOW',					' (Works with nearly all browsers)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
try_define('_ADMIN_NOTABILIA',							'Some information');
try_define('_ADMIN_PLEASE_READ',						"Before you start, here's some <strong>important information</strong>");
try_define('_ADMIN_HOW_TO_ACCESS',						"After you've created a new weblog, you'll need to perform some actions to make your blog accessible. There are two possibilities:");
try_define('_ADMIN_SIMPLE_WAY',							"<strong>Simple:</strong> Create a copy of <code>index.php</code> and modify it to display your new weblog. Further instructions on how to do this will be provided after you've submitted this first form.");
try_define('_ADMIN_ADVANCED_WAY',						"<strong>Advanced:</strong> Insert the blog content into your current skins using skinvars like <code>&lt;%otherblog()&gt;</code>. This way, you can place multiple blogs on the same page.");
try_define('_ADMIN_HOW_TO_CREATE',						'Create Weblog');


try_define('_BOOKMARKLET_NEW_CATEGORY',					'Item was added, and a new category was created. ');
try_define('_BOOKMARKLET_NEW_CATEGORY_EDIT',			'Click here to edit the name and description of the category.');
try_define('_BOOKMARKLET_NEW_WINDOW',					'Opens in new window');
try_define('_BOOKMARKLET_SEND_PING',					'Item was added successfully. Now pinging weblogs.com. Please hold on... (can take a while)'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
try_define('_OVERVIEW_SHOWALL',							'Show all blogs');	// <add by shizuki />

// Edit skins
try_define('_SKINEDIT_ALLOWEDBLOGS',						'Short blog names:');			// <add by shizuki>
try_define('_SKINEDIT_ALLOWEDTEMPLATESS',					'Template names:');		// <add by shizuki>

// delete member
try_define('_WARNINGTXT_NOTDELMEDIAFILES',				'Please note that media files will <b>NOT</b> be deleted. (At least not in this Nucleus version)');	// <add by shizuki />

// send Weblogupdate.ping
try_define('_UPDATEDPING_MESSAGE',						'<h2>Site Updated, Now pinging various weblog listing services...</h2><p>This can take a while...</p><p>If you aren\'t automatically passed through, '); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_GOPINGPAGE',					'try again'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_PINGING',						'Pinging services, please wait...'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VIEWITEM',						'View list of recent items for '); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VISITOWNSITE',					'Visit your own site'); // NOTE: This string is no longer in used

// General category
try_define('_EBLOGDEFAULTCATEGORY_NAME',				'General');
try_define('_EBLOGDEFAULTCATEGORY_DESC',				'Items that do not fit in other categories');

// First ITEM
try_define('_EBLOG_FIRSTITEM_TITLE',					'First Item');
try_define('_EBLOG_FIRSTITEM_BODY',						'This is the first item in your weblog. Feel free to delete it.');

// New weblog was created
try_define('_BLOGCREATED_TITLE',						'New weblog created');
try_define('_BLOGCREATED_ADDEDTXT',						"Your new weblog (%s) has been created. To continue, choose the way you'll want to make it viewable:");
try_define('_BLOGCREATED_SIMPLEWAY',					"Easiest: A copy of <code>%s.php</code>");
try_define('_BLOGCREATED_ADVANCEDWAY',					"Advanced: Call the weblog from existing skins");
try_define('_BLOGCREATED_SIMPLEDESC1',					"Method 1: Create an extra <code>%s.php</code> file");
try_define('_BLOGCREATED_SIMPLEDESC2',					"Create a file called <code>%s.php</code>, and copy-paste the following code into it:");
try_define('_BLOGCREATED_SIMPLEDESC3',					"Upload the file next to your existing <code>index.php</code> file, and you should be all set.");
try_define('_BLOGCREATED_SIMPLEDESC4',					"To finish the weblog creation process, please fill out the final URL for your weblog (the proposed value is a <em>guess</em>, don't take it for granted):");
try_define('_BLOGCREATED_ADVANCEDWAY2',					"Method 2: Call the weblog from existing skins");
try_define('_BLOGCREATED_ADVANCEDWAY3',					"To finish the weblog creation process, simply please fill out the final URL for your weblog: (might be the same as another already existing weblog)");

// Donate!
try_define('_ADMINPAGEFOOT_OFFICIALURL',				'http://nucleuscms.org/');
try_define('_ADMINPAGEFOOT_DONATEURL',					'http://nucleuscms.org/donate.php');
try_define('_ADMINPAGEFOOT_DONATE',						'Donate!');
try_define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group');

// Quick menu
try_define('_QMENU_MANAGE_SYSTEM',						'System info');

// REG file
try_define('_WINREGFILE_TEXT',							'Post To &Nucleus (%s)');

// Bookmarklet
try_define('_BOOKMARKLET_TITLE',						'Bookmarklet<!-- and Right Click Menu -->');
try_define('_BOOKMARKLET_DESC1',						'Bookmarklets allow adding items to your weblog with just one single click. ');
try_define('_BOOKMARKLET_DESC2',						'After installing these bookmarklets, you\'ll be able to click the \'add to weblog\' button on your browser toolbar, ');
try_define('_BOOKMARKLET_DESC3',						'and a Nucleus add-item window will popup, ');
try_define('_BOOKMARKLET_DESC4',						'containing the link and title of the page you were visiting, ');
try_define('_BOOKMARKLET_DESC5',						'plus any text you might have selected.');
try_define('_BOOKMARKLET_BOOKARKLET',					'bookmarklet');
try_define('_BOOKMARKLET_ANCHOR',						'Add to %s');
try_define('_BOOKMARKLET_BMARKTEXT',					'You can drag the following link to your favorites, or your browsers toolbar: ');
try_define('_BOOKMARKLET_BMARKTEST',					'(if you want to test the bookmarklet first, click the link)');
try_define('_BOOKMARKLET_RIGHTCLICK',					'Right Click Menu Access (IE &amp; Windows)');
try_define('_BOOKMARKLET_RIGHTLABEL',					'right click menu item');
try_define('_BOOKMARKLET_RIGHTTEXT1',					'Or you can install the ');
try_define('_BOOKMARKLET_RIGHTTEXT2',					' (choose \'open file\' and add to registry)');
try_define('_BOOKMARKLET_RIGHTTEXT3',					'You\'ll have to restart Internet Explorer before the option shows up in the context menus.');
try_define('_BOOKMARKLET_UNINSTALLTT',					'Uninstalling');
try_define('_BOOKMARKLET_DELETEBAR',					'For the bookmarklet, you can just delete it.');
try_define('_BOOKMARKLET_DELETERIGHTT',					'For the right click menu item, follow the procedure listed below:');
try_define('_BOOKMARKLET_DELETERIGHT1',					'Select "Run..." from the Start Menu');
try_define('_BOOKMARKLET_DELETERIGHT2',					'Type: "regedit"');
try_define('_BOOKMARKLET_DELETERIGHT3',					'Click the "OK" button');
try_define('_BOOKMARKLET_DELETERIGHT4',					'Search for "\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" in the tree');
try_define('_BOOKMARKLET_DELETERIGHT5',					'Delete the "add to \'Your weblog\'" item');

try_define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'Something went wrong');
try_define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'Could not create new category');

// BAN
try_define('_BAN_EXAMPLE_TITLE',						'An example');
try_define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193" will only block one computer, while "134.58.253" will block 256 IP addresses, including the one from the first example.');
try_define('_BAN_IP_CUSTOM',							'Custom: ');
try_define('_BAN_BANBLOGNAME',							'Only blog %s');

// Plugin Options
try_define('_PLUGIN_OPTIONS_TITLE',							'Options for %s');

// Plugin file loda error
try_define('_PLUGINFILE_COULDNT_BELOADED',				'Error: plugin file <strong>%s.php</strong> could not be loaded, or it has been set inactive because it does not support some features (check the <a href="?action=actionlog">actionlog</a> for more info)');

//ITEM add/edit template (for japanese only)
try_define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'Format :');
try_define('_ITEM_ADDEDITTEMPLATE_YEAR',				'Year');
try_define('_ITEM_ADDEDITTEMPLATE_MONTH',				'Month');
try_define('_ITEM_ADDEDITTEMPLATE_DAY',					'Day');
try_define('_ITEM_ADDEDITTEMPLATE_HOUR',				'Hour');
try_define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'Minute');

// Errors
try_define('_ERRORS_INSTALLSQL',						'install.sql should be deleted');
try_define('_ERRORS_INSTALLDIR',						'install directory should be deleted');  // <add by shizuki />
try_define('_ERRORS_INSTALLPHP',						'install.php should be deleted');
try_define('_ERRORS_UPGRADESDIR',						'_upgrades directory should be deleted');
try_define('_ERRORS_CONVERTDIR',						'nucleus/convert directory should be deleted');
try_define('_ERRORS_CONFIGPHP',							'config.php should be non-writable (chmod to 444)');
try_define('_ERRORS_STARTUPERROR1',						'<p>One or more of the Nucleus installation files are still present on the webserver, or are writable.</p><p>You should remove these files or change their permissions to ensure security. Here are the files that were found by Nucleus</p> <ul><li>');
try_define('_ERRORS_STARTUPERROR2',						'</li></ul><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnSecurityRisk\']</code> in <code>globalfunctions.php</code> to <code>0</code>, or do this at the end of <code>config.php</code>.</p>');
try_define('_ERRORS_STARTUPERROR3',						'Security Risk');

// PluginAdmin tickets by javascript
try_define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>Error occured during automatic addition of tickets.</b></p>');

// Global settings disablesite URL
try_define('_SETTINGS_DISABLESITEURL',					'Redirect URL:');

// Skin import/export
try_define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'UNEXPECTED TAG');
try_define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'Failed to open file/URL');
try_define('_SKINIE_NAME_CLASHES_DETECTED',				'Name clashes detected, re-run with allowOverwrite = 1 to force overwrite');

// ACTIONS.php parse_commentform
try_define('_ACTIONURL_NOTLONGER_PARAMATER',			'actionurl is not longer a parameter on commentform skinvars. Moved to be a global setting instead.');

// ADMIN.php addToTemplate 'Query error: '
try_define('_ADMIN_SQLDIE_QUERYERROR',					'Query error: ');

// backup.php Backup WARNING
try_define('_BACKUP_BACKUPFILE_TITLE',					'This is a backup file generated by Nucleus');
try_define('_BACKUP_BACKUPFILE_BACKUPDATE',				'backup-date:');
try_define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Nucleus CMS version:');
try_define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nucleus CMS Database name:');
try_define('_BACKUP_BACKUPFILE_TABLE_NAME',				'TABLE:');
try_define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'Table Data for %s');
try_define('_BACKUP_WARNING_NUCLEUSVERSION',			'WARNING: Only try to restore on servers running the exact same version of Nucleus');
try_define('_BACKUP_RESTOR_NOFILEUPLOADED',				'No file uploaded');
try_define('_BACKUP_RESTOR_UPLOAD_ERROR',				'File Upload Error');
try_define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'The uploaded file is not of the correct type');
try_define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'Cannot decompress gzipped backup (zlib package not installed)');
try_define('_BACKUP_RESTOR_SQL_ERROR',					'SQL Error: ');

// BLOG.php addTeamMember
try_define('_TEAM_ADD_NEWTEAMMEMBER',					'Added %s (ID=%d) to the team of blog "%s"');

// ADMIN.php systemoverview()
try_define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'System Overview');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'Versions');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'PHP version');
try_define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'MySQL version');
try_define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'Settings');
try_define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'GD Libraly');
try_define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Modules');
try_define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'enabled');
try_define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'disabled');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Your Nucleus CMS System');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Nucleus CMS version');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Nucleus CMS patch level');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'Important settings');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'Check for a new version');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'Check on nucleuscms.org if a new version is available: ');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://nucleuscms.org/version.php?v=%d&amp;pl=%d');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'Check for upgrade');
try_define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			"You haven't enough rights to see the system informations.");

// ENCAPSULATE.php
try_define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'No entries');

// globalfunctions.php
try_define('_GFUNCTIONS_LOGINPCSHARED_YES',				'on shared PC');
try_define('_GFUNCTIONS_LOGINPCSHARED_NO',				'on not shared PC');
try_define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'Login successful for %s (%s)');
try_define('_GFUNCTIONS_LOGINFAILED_TXT',				'Login failed for %s');
try_define('_GFUNCTIONS_LOGOUT_TXT',					'%s is logouted');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		' in <code>%s</code> line <code>%s</code>');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		' Page headers already sent');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>The page headers have already been sent out%s. This could cause Nucleus not to work in the expected way.</p><p>Usually, this is caused by spaces or newlines at the end of the <code>config.php</code> file, at the end of the language file or at the end of a plugin file. Please check this and try again.</p><p>If you don\'t want to see this error message again, without solving the problem, set <code>$CONF[\'alertOnHeadersSent\']</code> in <code>globalfunctions.php</code> to <code>0</code></p>');
try_define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'A file is missing');
try_define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'Sorry. An error occurred.');
try_define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			"You aren't logged in.");

// MANAGER.php
try_define('_MANAGER_PLUGINFILE_NOCLASS',				"Plugin %s was not loaded (Class not found in file, possible parse error)");

// mysql.php
try_define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>No suitable mySQL library was found to run Nucleus</p>");

// PLUGIN.php
try_define('_ERROR_PLUGIN_NOSUCHACTION',				'No Such Action');

// PLUGINADMIN.php
try_define('_ERROR_INVALID_PLUGIN',						'Invalid plugin');

// showlist.php
try_define('_LIST_PLUGS_DEPREQ',						'Plugin(s) requires:');
try_define('_LIST_SKIN_PREVIEW',						"Preview for '%s' skin");
try_define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"View larger");
try_define('_LIST_SKIN_README',							"More info on the '%s' skin");
try_define('_LIST_SKIN_README_TXT',						'Read me');

// BLOG.php createNewCategory()
try_define('_CREATED_NEW_CATEGORY_NAME',				'newcat');
try_define('_CREATED_NEW_CATEGORY_DESC',				'New category');

// ADMIN.php blog settings
try_define('_EBLOG_CURRENT_TEAM_MEMBER',				'Members currently on your team:');

// HTML outputs
try_define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us"');
try_define('_LANG_CODE',		'en');

// Language Files
try_define('_LANGUAGEFILES_JAPANESE-UTF8',				'Japanese - &#26085;&#26412;&#35486; (UTF-8)');
try_define('_LANGUAGEFILES_JAPANESE-EUC',				'Japanese - &#26085;&#26412;&#35486; (EUC)');
try_define('_LANGUAGEFILES_ENGLISH-UTF8',				'English - English (UTF-8)');
try_define('_LANGUAGEFILES_ENGLISH',					'English - English (iso-8859-1)');
/*
try_define('_LANGUAGEFILES_BULGARIAN',					'Bulgarian - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
try_define('_LANGUAGEFILES_CATALAN',					'Catalan - Catal&agrave; (iso-8859-1)');
try_define('_LANGUAGEFILES_CHINESE-GBK',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
try_define('_LANGUAGEFILES_SIMCHINESE',					'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
try_define('_LANGUAGEFILES_CHINESE-UTF8',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CHINESEB5',					'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_CHINESEB5-UTF8',				'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CZECH',						'Czech - &#268;esky (windows-1250)');
try_define('_LANGUAGEFILES_FINNISH',					'Finnish - Suomi (iso-8859-1)');
try_define('_LANGUAGEFILES_FRENCH',						'French - Fran&ccedil;ais (iso-8859-1)');
try_define('_LANGUAGEFILES_GALEGO',						'Galego - Galego (iso-8859-1)');
try_define('_LANGUAGEFILES_GERMAN',						'German - Deutsch (iso-8859-1)');
try_define('_LANGUAGEFILES_HUNGARIAN',					'Hungarian - Magyar (iso-8859-2)');
try_define('_LANGUAGEFILES_ITALIANO',					'Italiano - Italiano (iso-8859-1)');
try_define('_LANGUAGEFILES_KOREAN-UTF8',				'Korean - &#54620;&#44397;&#50612; (utf-8)');
try_define('_LANGUAGEFILES_LATVIAN',					'Latvian - Latvie&scaron;u (windows-1257)');
try_define('_LANGUAGEFILES_NEDERLANDS',					'Duch - Nederlands (iso-8859-15)');
try_define('_LANGUAGEFILES_PERSIAN',					'Persian - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
try_define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'Portuguese Brazil - Portugu&ecirc;s (iso-8859-1)');
try_define('_LANGUAGEFILES_RUSSIAN',					'Russian - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
try_define('_LANGUAGEFILES_SLOVAK',						'Slovak - Sloven&#269;ina (ISO-8859-2)');
try_define('_LANGUAGEFILES_SPANISH-UTF8',				'Spanish - Espa&ntilde;ol (utf-8)');
try_define('_LANGUAGEFILES_SPANISH',					'Spanish - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
try_define('_AUTOSAVEDRAFT',		'Auto save draft');
try_define('_AUTOSAVEDRAFT_LASTSAVED',	'Last saved: ');
try_define('_AUTOSAVEDRAFT_NOTYETSAVED',	'No saves have been made yet');
try_define('_AUTOSAVEDRAFT_NOW',		'Auto save now');
try_define('_SKIN_PARTS_SPECIAL',		'Special skin parts');
try_define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',		'You must enter a name that exists only out of lowercase letters and digits');
try_define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',		'Can\'t delete this skin part');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',		'Do you really want to delete this special skin part?');
try_define('_ERROR_PLUGIN_LOAD',		'Plugin could not be loaded, or does not support certain features that are required for it to run on your Nucleus installation (you might want to check the <a href="?action=actionlog">actionlog</a> for more info)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
try_define('_SEARCHFORM_QUERY',			'Keywords to search');
try_define('_ERROR_EMAIL_REQUIRED',		'Email address is required');
try_define('_COMMENTFORM_MAIL',			'Website:');
try_define('_COMMENTFORM_EMAIL',		'E-mail:');
try_define('_EBLOG_REQUIREDEMAIL',		'Require E-mail address with comments?');
try_define('_ERROR_COMMENTS_SPAM',      'Your comment was rejected because it did not pass the spam test');
// END changed/added after 3.22 END

// START changed/added after 3.15 START

try_define('_LIST_PLUG_SUBS_NEEDUPDATE','Please use the \'Update Subscription list\'-button to update the plugin\'s subscription list.');
try_define('_LIST_PLUGS_DEP',			'Plugin(s) requires:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
try_define('_COMMENTS_BLOG',			'All Comments for blog');
try_define('_NOCOMMENTS_BLOG',			'No comments were made on items of this blog');
try_define('_BLOGLIST_COMMENTS',		'Comments');
try_define('_BLOGLIST_TT_COMMENTS',		'A list of all comments made on items of this blog');


// for use in archivetype-skinvar
try_define('_ARCHIVETYPE_DAY',			'day');
try_define('_ARCHIVETYPE_MONTH',		'month');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
try_define('_ERROR_BADTICKET',			'Invalid or expired ticket.');

// cookie prefix
try_define('_SETTINGS_COOKIEPREFIX',	'Cookie Prefix');

// account activation
try_define('_ERROR_NOLOGON_NOACTIVATE',	'Cannot send activation link. You\'re not allowed to log in.');
try_define('_ERROR_ACTIVATE',			'Activation key does not exist, is invalid, or has expired.');
try_define('_ACTIONLOG_ACTIVATIONLINK', 'Activation link sent');
try_define('_MSG_ACTIVATION_SENT',		'An activation link has been sent by e-mail.');

// activation link emails
try_define('_ACTIVATE_REGISTER_MAIL',	"Hi <%memberName%>,\n\nYou need to activate your account at <%siteName%> (<%siteUrl%>).\nYou can do this by visiting the link below: \n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
try_define('_ACTIVATE_REGISTER_MAILTITLE',	"Activate your '<%memberName%>' account");
try_define('_ACTIVATE_REGISTER_TITLE',	'Welcome <%memberName%>');
try_define('_ACTIVATE_REGISTER_TEXT',	'You\'re almost there. Please choose a password for your account below.');
try_define('_ACTIVATE_FORGOT_MAIL',		"Hi <%memberName%>,\n\nUsing the link below, you can choose a new password for your account at <%siteName%> (<%siteUrl%>) by choosing a new password.\n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
try_define('_ACTIVATE_FORGOT_MAILTITLE',"Re-activate your '<%memberName%>' account");
try_define('_ACTIVATE_FORGOT_TITLE',	'Welcome <%memberName%>');
try_define('_ACTIVATE_FORGOT_TEXT',		'You can choose a new password for your account below:');
try_define('_ACTIVATE_CHANGE_MAIL',		"Hi <%memberName%>,\n\nSince your e-mail address has changed, you'll need to re-activate your account at <%siteName%> (<%siteUrl%>).\nYou can do this by visiting the link below: \n\n\t<%activationUrl%>\n\nYou have <%activationDays%> days to do this. After this, the activation link becomes invalid.");
try_define('_ACTIVATE_CHANGE_MAILTITLE',"Re-activate your '<%memberName%>' account");
try_define('_ACTIVATE_CHANGE_TITLE',	'Welcome <%memberName%>');
try_define('_ACTIVATE_CHANGE_TEXT',		'Your address change has been verified. Thanks!');
try_define('_ACTIVATE_SUCCESS_TITLE',	'Activation Succeeded');
try_define('_ACTIVATE_SUCCESS_TEXT',	'Your account has been successfully activated.');
try_define('_MEMBERS_SETPWD',			'Set Password');
try_define('_MEMBERS_SETPWD_BTN',		'Set Password');
try_define('_QMENU_ACTIVATE',			'Account Activation');
try_define('_QMENU_ACTIVATE_TEXT',		'<p>After you have activated your account, you can start using it by <a href="index.php?action=showlogin">logging in</a>.</p>');

try_define('_PLUGS_BTN_UPDATE',			'Update subscription list');

// global settings
try_define('_SETTINGS_JSTOOLBAR',		'Javascript Toolbar Style');
try_define('_SETTINGS_JSTOOLBAR_FULL',	'Full Toolbar (IE)');
try_define('_SETTINGS_JSTOOLBAR_SIMPLE','Simple Toolbar (Non-IE)');
try_define('_SETTINGS_JSTOOLBAR_NONE',	'Disable Toolbar');
try_define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/en/tips.html#searchengines-fancyurls">How to activate fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
try_define('_PLUGINS_EXTRA',			'Extra Plugin Settings');

// itemlist info column keys
try_define('_LIST_ITEM_BLOG',			'blog:');
try_define('_LIST_ITEM_CAT',			'cat:');
try_define('_LIST_ITEM_AUTHOR',			'author:');
try_define('_LIST_ITEM_DATE',			'date:');
try_define('_LIST_ITEM_TIME',			'time:');

// indication of registered members in comments list
try_define('_LIST_COMMENTS_MEMBER', 	'(member)');

// batch operations
try_define('_BATCH_WITH_SEL',			'With selected:');
try_define('_BATCH_EXEC',				'Execute');

// quickmenu
try_define('_QMENU_HOME',				'Home');
try_define('_QMENU_ADD',				'Add Item');
try_define('_QMENU_ADD_SELECT',			'-- select --');
try_define('_QMENU_USER_SETTINGS',		'Profile');
try_define('_QMENU_USER_ITEMS',			'Items');
try_define('_QMENU_USER_COMMENTS',		'Comments');
try_define('_QMENU_MANAGE',				'Management');
try_define('_QMENU_MANAGE_LOG',			'Action Log');
try_define('_QMENU_MANAGE_SETTINGS',	'Configuration');
try_define('_QMENU_MANAGE_MEMBERS',		'Members');
try_define('_QMENU_MANAGE_NEWBLOG',		'New Weblog');
try_define('_QMENU_MANAGE_BACKUPS',		'Backups');
try_define('_QMENU_MANAGE_PLUGINS',		'Plugins');
try_define('_QMENU_LAYOUT',				'Layout');
try_define('_QMENU_LAYOUT_SKINS',		'Skins');
try_define('_QMENU_LAYOUT_TEMPL',		'Templates');
try_define('_QMENU_LAYOUT_IEXPORT',		'Import/Export');
try_define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
try_define('_QMENU_INTRO',				'Introduction');
try_define('_QMENU_INTRO_TEXT',			'<p>This is the logon screen for Nucleus CMS, the content management system that\'s being used to maintain this website.</p><p>If you have an account, you can log on and start posting new items.</p>');

// helppages for plugins
try_define('_ERROR_PLUGNOHELPFILE',		'The helpfile for this plugin can not be found');
try_define('_PLUGS_HELP_TITLE',			'Helppage for plugin');
try_define('_LIST_PLUGS_HELP', 			'help');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
try_define('_SETTINGS_EXTAUTH',			'Enable External Authentication');
try_define('_WARNING_EXTAUTH',			'Warning: Enable only if needed.');

// member profile
try_define('_MEMBERS_BYPASS',			'Use External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
try_define('_EBLOG_SEARCH',				'<em>Always</em> include in search');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
try_define('_MEDIA_VIEW',				'view');
try_define('_MEDIA_VIEW_TT',			'View file (opens in new window)');
try_define('_MEDIA_FILTER_APPLY',		'Apply Filter');
try_define('_MEDIA_FILTER_LABEL',		'Filter: ');
try_define('_MEDIA_UPLOAD_TO',			'Upload to...');
try_define('_MEDIA_UPLOAD_NEW',			'Upload new file...');
try_define('_MEDIA_COLLECTION_SELECT',	'Select');
try_define('_MEDIA_COLLECTION_TT',		'Switch to this category');
try_define('_MEDIA_COLLECTION_LABEL',	'Current collection: ');

// tooltips on toolbar
try_define('_ADD_ALIGNLEFT_TT',			'Align Left');
try_define('_ADD_ALIGNRIGHT_TT',		'Align Right');
try_define('_ADD_ALIGNCENTER_TT',		'Align Center');


// generic upload failure
try_define('_ERROR_UPLOADFAILED',		'Upload failed');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
try_define('_EBLOG_ALLOWPASTPOSTING',	'Allow posting to the past');
try_define('_ADD_CHANGEDATE',			'Update timestamp');
try_define('_BMLET_CHANGEDATE',			'Update timestamp');

// skin import/export
try_define('_OVERVIEW_SKINIMPORT',		'Skin import/export...');

// skin settings
try_define('_PARSER_INCMODE_NORMAL',	'Normal');
try_define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
try_define('_SKIN_INCLUDE_MODE',		'Include mode');
try_define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
try_define('_SETTINGS_BASESKIN',		'Base Skin');
try_define('_SETTINGS_SKINSURL',		'Skins URL');
try_define('_SETTINGS_ACTIONSURL',		'Full URL to action.php');

// category moves (batch)
try_define('_ERROR_MOVEDEFCATEGORY',	'Cannot move default category');
try_define('_ERROR_MOVETOSELF',			'Cannot move category (destination blog is the same as source blog)');
try_define('_MOVECAT_TITLE',			'Select blog to move category to');
try_define('_MOVECAT_BTN',				'Move category');

// URLMode setting
try_define('_SETTINGS_URLMODE',			'URL Mode');
try_define('_SETTINGS_URLMODE_NORMAL',	'Normal');
try_define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
try_define('_BATCH_NOSELECTION',		'Nothing selected to perform actions on');
try_define('_BATCH_ITEMS',				'Batch operation on items');
try_define('_BATCH_CATEGORIES',			'Batch operation on categories');
try_define('_BATCH_MEMBERS',			'Batch operation on members');
try_define('_BATCH_TEAM',				'Batch operation on team members');
try_define('_BATCH_COMMENTS',			'Batch operation on comments');
try_define('_BATCH_UNKNOWN',			'Unknown batch operation: ');
try_define('_BATCH_EXECUTING',			'Executing');
try_define('_BATCH_ONCATEGORY',			'on category');
try_define('_BATCH_ONITEM',				'on item');
try_define('_BATCH_ONCOMMENT',			'on comment');
try_define('_BATCH_ONMEMBER',			'on member');
try_define('_BATCH_ONTEAM',				'on team member');
try_define('_BATCH_SUCCESS',			'Success!');
try_define('_BATCH_DONE',				'Done!');
try_define('_BATCH_DELETE_CONFIRM',		'Confirm Batch Deletion');
try_define('_BATCH_DELETE_CONFIRM_BTN',	'Confirm Batch Deletion');
try_define('_BATCH_SELECTALL',			'select all');
try_define('_BATCH_DESELECTALL',		'deselect all');

// batch operations: options in dropdowns
try_define('_BATCH_ITEM_DELETE',		'Delete');
try_define('_BATCH_ITEM_MOVE',			'Move');
try_define('_BATCH_MEMBER_DELETE',		'Delete');
try_define('_BATCH_MEMBER_SET_ADM',		'Give admin rights');
try_define('_BATCH_MEMBER_UNSET_ADM',	'Take away admin rights');
try_define('_BATCH_TEAM_DELETE',		'Delete from team');
try_define('_BATCH_TEAM_SET_ADM',		'Give admin rights');
try_define('_BATCH_TEAM_UNSET_ADM',		'Take away admin rights');
try_define('_BATCH_CAT_DELETE',			'Delete');
try_define('_BATCH_CAT_MOVE',			'Move to other blog');
try_define('_BATCH_COMMENT_DELETE',		'Delete');

// itemlist: Add new item...
try_define('_ITEMLIST_ADDNEW',			'Add new item...');
try_define('_ADD_PLUGIN_EXTRAS',		'Extra Plugin Options');

// errors
try_define('_ERROR_CATCREATEFAIL',		'Could not create new category');
try_define('_ERROR_NUCLEUSVERSIONREQ',	'This plugin requires a newer Nucleus version: ');

// backlinks
try_define('_BACK_TO_BLOGSETTINGS',		'Back to blogsettings');

// skin import export
try_define('_SKINIE_TITLE_IMPORT',		'Import');
try_define('_SKINIE_TITLE_EXPORT',		'Export');
try_define('_SKINIE_BTN_IMPORT',		'Import');
try_define('_SKINIE_BTN_EXPORT',		'Export selected skins/templates');
try_define('_SKINIE_LOCAL',				'Import from local file:');
try_define('_SKINIE_NOCANDIDATES',		'No candidates for import found in the skins directory');
try_define('_SKINIE_FROMURL',			'Import from URL:');
try_define('_SKINIE_EXPORT_INTRO',		'Select the skins and templates you want to export below');
try_define('_SKINIE_EXPORT_SKINS',		'Skins');
try_define('_SKINIE_EXPORT_TEMPLATES',	'Templates');
try_define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
try_define('_SKINIE_CONFIRM_OVERWRITE',	'Overwrite skins that already exists (see nameclashes)');
try_define('_SKINIE_CONFIRM_IMPORT',	'Yes, I want to import this');
try_define('_SKINIE_CONFIRM_TITLE',		'About to import skins and templates');
try_define('_SKINIE_INFO_SKINS',		'Skins in file:');
try_define('_SKINIE_INFO_TEMPLATES',	'Templates in file:');
try_define('_SKINIE_INFO_GENERAL',		'Info:');
try_define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
try_define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
try_define('_SKINIE_INFO_IMPORTEDSKINS','Imported skins:');
try_define('_SKINIE_INFO_IMPORTEDTEMPLS','Imported templates:');
try_define('_SKINIE_DONE',				'Done Importing');

try_define('_AND',						'and');
try_define('_OR',						'or');

// empty fields on template edit
try_define('_EDITTEMPLATE_EMPTY',		'empty field (click to edit)');

// skin overview list
try_define('_LIST_SKINS_INCMODE',		'IncludeMode:');
try_define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
try_define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
try_define('_BACKUPS_TITLE',			'Backup / Restore');
try_define('_BACKUP_TITLE',				'Backup');
try_define('_BACKUP_INTRO',				'Click the button below to create a backup of your Nucleus database. You\'ll be prompted to save a backup file. Store it in a safe place.');
try_define('_BACKUP_ZIP_YES',			'Try to use compression');
try_define('_BACKUP_ZIP_NO',			'Do not use compression');
try_define('_BACKUP_BTN',				'Create Backup');
try_define('_BACKUP_NOTE',				'<b>Note:</b> Only the database contents is stored in the backup. Media files and settings in config.php are thus <b>NOT</b> included in the backup.');
try_define('_RESTORE_TITLE',			'Restore');
try_define('_RESTORE_NOTE',				'<b>WARNING:</b> Restoring from a backup will <b>ERASE</b> all current Nucleus data in the database! Only do this when you\'re really sure!	<br />	<b>Note:</b> Make sure that the version of Nucleus in which you created the backup should be the same as the version you\'re running right now! It won\'t work otherwise');
try_define('_RESTORE_INTRO',			'Select the backup file below (it\'ll be uploaded to the server) and click the "Restore" button to start.');
try_define('_RESTORE_IMSURE',			'Yes, I\'m sure I want to do this!');
try_define('_RESTORE_BTN',				'Restore From File');
try_define('_RESTORE_WARNING',			'(make sure you\'re restoring the correct backup, maybe make a new backup before you start)');
try_define('_ERROR_BACKUP_NOTSURE',		'You\'ll need to check the \'I\'m sure\' testbox');
try_define('_RESTORE_COMPLETE',			'Restore Complete');

// new item notification
try_define('_NOTIFY_NI_MSG',			'A new item has been posted:');
try_define('_NOTIFY_NI_TITLE',			'New Item!');
try_define('_NOTIFY_KV_MSG',			'Karma vote on item:');
try_define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
try_define('_NOTIFY_NC_MSG',			'Comment on item:');
try_define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
try_define('_NOTIFY_USERID',			'User ID:');
try_define('_NOTIFY_USER',				'User:');
try_define('_NOTIFY_COMMENT',			'Comment:');
try_define('_NOTIFY_VOTE',				'Vote:');
try_define('_NOTIFY_HOST',				'Host:');
try_define('_NOTIFY_IP',				'IP:');
try_define('_NOTIFY_MEMBER',			'Member:');
try_define('_NOTIFY_TITLE',				'Title:');
try_define('_NOTIFY_CONTENTS',			'Contents:');

// member mail message
try_define('_MMAIL_MSG',				'A message sent to you by');
try_define('_MMAIL_FROMANON',			'an anonymous visitor');
try_define('_MMAIL_FROMNUC',			'Posted from a Nucleus weblog at');
try_define('_MMAIL_TITLE',				'A message from');
try_define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
try_define('_BMLET_ADD',				'Add Item');
try_define('_BMLET_EDIT',				'Edit Item');
try_define('_BMLET_DELETE',				'Delete Item');
try_define('_BMLET_BODY',				'Body');
try_define('_BMLET_MORE',				'Extended');
try_define('_BMLET_OPTIONS',			'Options');
try_define('_BMLET_PREVIEW',			'Preview');

// used in bookmarklet
try_define('_ITEM_UPDATED',				'Item was updated');
try_define('_ITEM_DELETED',				'Item was deleted');

// plugins
try_define('_CONFIRMTXT_PLUGIN',		'Are you sure you want to delete the plugin named');
try_define('_ERROR_NOSUCHPLUGIN',		'No such plugin');
try_define('_ERROR_DUPPLUGIN',			'Sorry, this plugin is already installed');
try_define('_ERROR_PLUGFILEERROR',		'No such plugin exists, or the permissions are set incorrectly');
try_define('_PLUGS_NOCANDIDATES',		'No plugin candidates found');

try_define('_PLUGS_TITLE_MANAGE',		'Manage Plugins');
try_define('_PLUGS_TITLE_INSTALLED',	'Currently Installed');
try_define('_PLUGS_TITLE_UPDATE',		'Update subscription list');
try_define('_PLUGS_TEXT_UPDATE',		'Nucleus keeps a cache of the event subscriptions of the plugins. When you upgrade a plugin by replacing it\'s file, you should run this update to make sure that the correct subscriptions are cached');
try_define('_PLUGS_TITLE_NEW',			'Install New Plugin');
try_define('_PLUGS_ADD_TEXT',			'Below is a list of all the files in your plugins directory, that might be non-installed plugins. Make sure you are <strong>really sure</strong> that it\'s a plugin before adding it.');
try_define('_PLUGS_BTN_INSTALL',		'Install Plugin');
try_define('_BACKTOOVERVIEW',			'Back to overview');

// editlink
try_define('_TEMPLATE_EDITLINK',		'Edit Item Link');

// add left / add right tooltips
try_define('_ADD_LEFT_TT',				'Add left box');
try_define('_ADD_RIGHT_TT',				'Add right box');

// add/edit item: new category (in dropdown box)
try_define('_ADD_NEWCAT',				'New Category...');

// new settings
try_define('_SETTINGS_PLUGINURL',		'Plugin URL');
try_define('_SETTINGS_MAXUPLOADSIZE',	'Max. upload file size (bytes)');
try_define('_SETTINGS_NONMEMBERMSGS',	'Allow non-members to send messages');
try_define('_SETTINGS_PROTECTMEMNAMES',	'Protect member names');

// overview screen
try_define('_OVERVIEW_PLUGINS',			'Manage Plugins...');

// actionlog
try_define('_ACTIONLOG_NEWMEMBER',		'New member registration:');

// membermail (when not logged in)
try_define('_MEMBERMAIL_MAIL',			'Your email address:');

// file upload
try_define('_ERROR_DISALLOWEDUPLOAD2',	'You do not have admin rights on any of the blogs that have the destination member on the teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory');

// plugin list
try_define('_LISTS_INFO',				'Information');
try_define('_LIST_PLUGS_AUTHOR',		'By:');
try_define('_LIST_PLUGS_VER',			'Version:');
try_define('_LIST_PLUGS_SITE',			'Visit site');
try_define('_LIST_PLUGS_DESC',			'Description:');
try_define('_LIST_PLUGS_SUBS',			'Subscribes to the following events:');
try_define('_LIST_PLUGS_UP',			'move up');
try_define('_LIST_PLUGS_DOWN',			'move down');
try_define('_LIST_PLUGS_UNINSTALL',		'uninstall');
try_define('_LIST_PLUGS_ADMIN',			'admin');
try_define('_LIST_PLUGS_OPTIONS',		'edit&nbsp;options');

// plugin option list
try_define('_LISTS_VALUE',				'Value');

// plugin options
try_define('_ERROR_NOPLUGOPTIONS',		'this plugin does not have any options set');
try_define('_PLUGS_BACK',				'Back to Plugin Overview');
try_define('_PLUGS_SAVE',				'Save Options');
try_define('_PLUGS_OPTIONS_UPDATED',	'Plugin options updated');

try_define('_OVERVIEW_MANAGEMENT',		'Management');
try_define('_OVERVIEW_MANAGE',			'Nucleus management...');
try_define('_MANAGE_GENERAL',			'General Management');
try_define('_MANAGE_SKINS',				'Skin and Templates');
try_define('_MANAGE_EXTRA',				'Extra features');

try_define('_BACKTOMANAGE',				'Back to Nucleus management');


// END introduced after v1.1 END





// global stuff
try_define('_LOGOUT',					'Log Out');
try_define('_LOGIN',					'Log In');
try_define('_YES',						'Yes');
try_define('_NO',						'No');
try_define('_SUBMIT',					'Submit');
try_define('_ERROR',					'Error');
try_define('_ERRORMSG',					'An error has occurred!');
try_define('_BACK',						'Go Back');
try_define('_NOTLOGGEDIN',				'Not logged in');
try_define('_LOGGEDINAS',				'Logged in as');
try_define('_ADMINHOME',				'Admin Home');
try_define('_NAME',						'Name');
try_define('_BACKHOME',					'Back to Admin Home');
try_define('_BADACTION',				'Non existing action requested');
try_define('_MESSAGE',					'Message');
try_define('_HELP_TT',					'Help!');
try_define('_YOURSITE',					'Your site');


try_define('_POPUP_CLOSE',				'Close Window');

try_define('_LOGIN_PLEASE',				'Please Log in First');

// commentform
try_define('_COMMENTFORM_YOUARE',		'You are');
try_define('_COMMENTFORM_SUBMIT',		'Add Comment');
try_define('_COMMENTFORM_COMMENT',		'Your comment:');
try_define('_COMMENTFORM_NAME',			'Name:');
try_define('_COMMENTFORM_REMEMBER',		'Remember Me');

// loginform
try_define('_LOGINFORM_NAME',			'Username:');
try_define('_LOGINFORM_PWD',			'Password:');
try_define('_LOGINFORM_YOUARE',			'Logged in as');
try_define('_LOGINFORM_SHARED',			'Shared Computer');

// member mailform
try_define('_MEMBERMAIL_SUBMIT',		'Send Message');

// search form
try_define('_SEARCHFORM_SUBMIT',		'Search');

// add item form
try_define('_ADD_ADDTO',				'Add new item to');
try_define('_ADD_CREATENEW',			'Create new item');
try_define('_ADD_BODY',					'Body');
try_define('_ADD_TITLE',				'Title');
try_define('_ADD_MORE',					'Extended (optional)');
try_define('_ADD_CATEGORY',				'Category');
try_define('_ADD_PREVIEW',				'Preview');
try_define('_ADD_DISABLE_COMMENTS',		'Disable comments?');
try_define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
try_define('_ADD_ADDITEM',				'Add Item');
try_define('_ADD_ADDNOW',				'Add Now');
try_define('_ADD_PLACE_ON',				'Place on');
try_define('_ADD_ADDDRAFT',				'Add to drafts');
try_define('_ADD_NOPASTDATES',			'(dates and times in the past are NOT valid, the current time will be used in that case)');
try_define('_ADD_BOLD_TT',				'Bold');
try_define('_ADD_ITALIC_TT',			'Italic');
try_define('_ADD_HREF_TT',				'Make Link');
try_define('_ADD_MEDIA_TT',				'Add Media');
try_define('_ADD_PREVIEW_TT',			'Show/Hide Preview');
try_define('_ADD_CUT_TT',				'Cut');
try_define('_ADD_COPY_TT',				'Copy');
try_define('_ADD_PASTE_TT',				'Paste');


// edit item form
try_define('_EDIT_ITEM',				'Edit Item');
try_define('_EDIT_SUBMIT',				'Edit Item');
try_define('_EDIT_ORIG_AUTHOR',			'Original author');
try_define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
try_define('_EDIT_COMMENTSNOTE',		'(note: disabling comments will _not_ hide previously added comments)');

// used on delete screens
try_define('_DELETE_CONFIRM',			'Please confirm deletion');
try_define('_DELETE_CONFIRM_BTN',		'Confirm Deletion');
try_define('_CONFIRMTXT_ITEM',			'You\'re about to delete the item following item:');
try_define('_CONFIRMTXT_COMMENT',		'You\'re about to delete the following comment:');
try_define('_CONFIRMTXT_TEAM1',			'You\'re about to delete ');
try_define('_CONFIRMTXT_TEAM2',			' from the teamlist for blog ');
try_define('_CONFIRMTXT_BLOG',			'The blog you are going to delete is: ');
try_define('_WARNINGTXT_BLOGDEL',		'Warning! Deleting a blog will delete ALL items of that blog, and all comments. Please confirm to make clear that you are CERTAIN of what you\'re doing!<br />Also, don\'t interrupt Nucleus while removing your blog.');
try_define('_CONFIRMTXT_MEMBER',		'You\'re about to delete the following member profile: ');
try_define('_CONFIRMTXT_TEMPLATE',		'You\'re about to delete the template named ');
try_define('_CONFIRMTXT_SKIN',			'You\'re about to delete the skin named ');
try_define('_CONFIRMTXT_BAN',			'You\'re about to delete the ban for the ip range');
try_define('_CONFIRMTXT_CATEGORY',		'You\'re about to delete the category ');

// some status messages
try_define('_DELETED_ITEM',				'Item Deleted');
try_define('_DELETED_MEMBER',			'Member Deleted');
try_define('_DELETED_COMMENT',			'Comment Deleted');
try_define('_DELETED_BLOG',				'Blog Deleted');
try_define('_DELETED_CATEGORY',			'Category Deleted');
try_define('_ITEM_MOVED',				'Item Moved');
try_define('_ITEM_ADDED',				'Item Added');
try_define('_COMMENT_UPDATED',			'Comment updated');
try_define('_SKIN_UPDATED',				'Skin data has been saved');
try_define('_TEMPLATE_UPDATED',			'Template data has been saved');

// errors
try_define('_ERROR_COMMENT_LONGWORD',	'Please don\'t use words of lengths higher than 90 in your comments');
try_define('_ERROR_COMMENT_NOCOMMENT',	'Please enter a comment');
try_define('_ERROR_COMMENT_NOUSERNAME',	'Bad username');
try_define('_ERROR_COMMENT_TOOLONG',	'Your comments are too long (max. 5000 chars)');
try_define('_ERROR_COMMENTS_DISABLED',	'Comments for this blog are currently disabled.');
try_define('_ERROR_COMMENTS_NONPUBLIC',	'You must be logged in as a member to add comment to this blog');
try_define('_ERROR_COMMENTS_MEMBERNICK','The name you want to use to post comments is in use by a site member. Choose something else.');
try_define('_ERROR_SKIN',				'Skin error');
try_define('_ERROR_ITEMCLOSED',			'This item is closed, it\'s not possible to add new comments to it or to vote on it');
try_define('_ERROR_NOSUCHITEM',			'No such item exists');
try_define('_ERROR_NOSUCHBLOG',			'No such blog');
try_define('_ERROR_NOSUCHSKIN',			'No such skin');
try_define('_ERROR_NOSUCHMEMBER',		'No such member');
try_define('_ERROR_NOTONTEAM',			'You\'re not on the teamlist of this weblog.');
try_define('_ERROR_BADDESTBLOG',		'Destination blog does not exist');
try_define('_ERROR_NOTONDESTTEAM',		'Cannot move item, since you\'re not on the teamlist of the destination blog');
try_define('_ERROR_NOEMPTYITEMS',		'Cannot add empty items!');
try_define('_ERROR_BADMAILADDRESS',		'Email address is not valid');
try_define('_ERROR_BADNOTIFY',			'One or more of the given notify addresses is not a valid email address');
try_define('_ERROR_BADNAME',			'Name is not valid (only a-z and 0-9 allowed, no spaces at start/end)');
try_define('_ERROR_NICKNAMEINUSE',		'Another member is already using that nickname');
try_define('_ERROR_PASSWORDMISMATCH',	'Passwords must match');
try_define('_ERROR_PASSWORDTOOSHORT',	'Password should be at least 6 characters');
try_define('_ERROR_PASSWORDMISSING',	'Password cannot be empty');
try_define('_ERROR_REALNAMEMISSING',	'You must enter a real name');
try_define('_ERROR_ATLEASTONEADMIN',	'There should always be at least one super-admin that can login to the admin area.');
try_define('_ERROR_ATLEASTONEBLOGADMIN','Performing this action would leave your weblog unmaintainable. Please make sure there is always at least one admin.');
try_define('_ERROR_ALREADYONTEAM',		'You can\'t add a member that is already on the team');
try_define('_ERROR_BADSHORTBLOGNAME',	'The short blog name should only contain a-z and 0-9, without spaces');
try_define('_ERROR_DUPSHORTBLOGNAME',	'Another blog already has the chosen short name. These names should be unique');
try_define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
try_define('_ERROR_DELDEFBLOG',			'Cannot delete the default blog');
try_define('_ERROR_DELETEMEMBER',		'This member cannot be deleted, probably because he/she is the author of item(s)');
try_define('_ERROR_BADTEMPLATENAME',	'Invalid name for template, use only a-z and 0-9, without spaces');
try_define('_ERROR_DUPTEMPLATENAME',	'Another template with this name already exists');
try_define('_ERROR_BADSKINNAME',		'Invalid name for skin (only a-z, 0-9 are allowed, no spaces)');
try_define('_ERROR_DUPSKINNAME',		'Another skin with this name already exists');
try_define('_ERROR_DEFAULTSKIN',		'There must at all times be a skin named "default"');
try_define('_ERROR_SKINDEFDELETE',		'Cannot delete skin since it is the default skin for the following weblog: ');
try_define('_ERROR_DISALLOWED',			'Sorry, you\'re not allowed to perform this action');
try_define('_ERROR_DELETEBAN',			'Error while trying to delete ban (ban does not exist)');
try_define('_ERROR_ADDBAN',				'Error while trying to add ban. Ban might not have been added correctly in all your blogs.');
try_define('_ERROR_BADACTION',			'Required action does not exist');
try_define('_ERROR_MEMBERMAILDISABLED',	'Member to Member mail messages are disabled');
try_define('_ERROR_MEMBERCREATEDISABLED','Creation of member accounts is disabled');
try_define('_ERROR_INCORRECTEMAIL',		'Incorrect mail address');
try_define('_ERROR_VOTEDBEFORE',		'You have already voted for this item');
try_define('_ERROR_BANNED1',			'Cannot perform action since you (ip range ');
try_define('_ERROR_BANNED2',			') are banned from doing so. The message was: \'');
try_define('_ERROR_BANNED3',			'\'');
try_define('_ERROR_LOGINNEEDED',		'You must be logged in in order to perform this action');
try_define('_ERROR_CONNECT',			'Connect Error');
try_define('_ERROR_FILE_TOO_BIG',		'File is too big!');
try_define('_ERROR_BADFILETYPE',		'Sorry, this filetype is not allowed');
try_define('_ERROR_BADREQUEST',			'Bad upload request');
try_define('_ERROR_DISALLOWEDUPLOAD',	'You are not on any weblogs teamlist. Hence, you are not allowed to upload files');
try_define('_ERROR_BADPERMISSIONS',		'File/Dir permissions are not set correctly');
try_define('_ERROR_UPLOADMOVEP',		'Error while moving uploaded file');
try_define('_ERROR_UPLOADCOPY',			'Error while copying file');
try_define('_ERROR_UPLOADDUPLICATE',	'Another file with that name already exists. Try to rename it before uploading.');
try_define('_ERROR_LOGINDISALLOWED',	'Sorry, you\'re not allowed to log in to the admin area. You can log in as another user, though');
try_define('_ERROR_DBCONNECT',			'Could not connect to mySQL server');
try_define('_ERROR_DBSELECT',			'Could not select the Nucleus database.');
try_define('_ERROR_NOSUCHLANGUAGE',		'No such language file exists');
try_define('_ERROR_NOSUCHCATEGORY',		'No such category exists');
try_define('_ERROR_DELETELASTCATEGORY',	'There must at least be one category');
try_define('_ERROR_DELETEDEFCATEGORY',	'Cannot delete default category');
try_define('_ERROR_BADCATEGORYNAME',	'Bad category name');
try_define('_ERROR_DUPCATEGORYNAME',	'Another category with this name already exists');

// some warnings (used for mediadir setting)
try_define('_WARNING_NOTADIR',			'Warning: Current value is not a directory!');
try_define('_WARNING_NOTREADABLE',		'Warning: Current value is a non-readable directory!');
try_define('_WARNING_NOTWRITABLE',		'Warning: Current value is NOT a writable directory!');

// media and upload
try_define('_MEDIA_UPLOADLINK',			'Upload a new file');
try_define('_MEDIA_MODIFIED',			'modified');
try_define('_MEDIA_FILENAME',			'filename');
try_define('_MEDIA_DIMENSIONS',			'dimensions');
try_define('_MEDIA_INLINE',				'Inline');
try_define('_MEDIA_POPUP',				'Popup');
try_define('_UPLOAD_TITLE',				'Choose File');
try_define('_UPLOAD_MSG',				'Select the file you want to upload below, and hit the \'Upload\' button.');
try_define('_UPLOAD_BUTTON',			'Upload');

// some status messages
//try_define('_MSG_ACCOUNTCREATED',		'Account created, password will be sent through email');
//try_define('_MSG_PASSWORDSENT',			'Password has been sent by e-mail.');
try_define('_MSG_LOGINAGAIN',			'You\'ll need to login again, because your info changed');
try_define('_MSG_SETTINGSCHANGED',		'Settings Changed');
try_define('_MSG_ADMINCHANGED',			'Admin Changed');
try_define('_MSG_NEWBLOG',				'New Blog Created');
try_define('_MSG_ACTIONLOGCLEARED',		'Action Log Cleared');

// actionlog in admin area
try_define('_ACTIONLOG_DISALLOWED',		'Disallowed action: ');
try_define('_ACTIONLOG_PWDREMINDERSENT','New password sent for ');
try_define('_ACTIONLOG_TITLE',			'Action Log');
try_define('_ACTIONLOG_CLEAR_TITLE',	'Clear Action Log');
try_define('_ACTIONLOG_CLEAR_TEXT',		'Clear action log now');

// team management
try_define('_TEAM_TITLE',				'Manage team for blog ');
try_define('_TEAM_CURRENT',				'Current team');
try_define('_TEAM_ADDNEW',				'Add new member to team');
try_define('_TEAM_CHOOSEMEMBER',		'Choose member');
try_define('_TEAM_ADMIN',				'Admin privileges? ');
try_define('_TEAM_ADD',					'Add to team');
try_define('_TEAM_ADD_BTN',				'Add to team');

// blogsettings
try_define('_EBLOG_TITLE',				'Edit Blog Settings');
try_define('_EBLOG_TEAM_TITLE',			'Edit Team');
try_define('_EBLOG_TEAM_TEXT',			'Click here to edit your team...');
try_define('_EBLOG_SETTINGS_TITLE',		'Blog settings');
try_define('_EBLOG_NAME',				'Blog Name');
try_define('_EBLOG_SHORTNAME',			'Short Blog Name');
try_define('_EBLOG_SHORTNAME_EXTRA',	'<br />(should only contain a-z and no spaces)');
try_define('_EBLOG_DESC',				'Blog Description');
try_define('_EBLOG_URL',				'URL');
try_define('_EBLOG_DEFSKIN',			'Default Skin');
try_define('_EBLOG_DEFCAT',				'Default Category');
try_define('_EBLOG_LINEBREAKS',			'Convert line breaks');
try_define('_EBLOG_DISABLECOMMENTS',	'Comments enabled?<br /><small>(Disabling comments means that adding comments is not possible.)</small>');
try_define('_EBLOG_ANONYMOUS',			'Allow comments by non-members?');
try_define('_EBLOG_NOTIFY',				'Notify Address(es) (use ; as separator)');
try_define('_EBLOG_NOTIFY_ON',			'Notify on');
try_define('_EBLOG_NOTIFY_COMMENT',		'New comments');
try_define('_EBLOG_NOTIFY_KARMA',		'New karma votes');
try_define('_EBLOG_NOTIFY_ITEM',		'New weblog items');
try_define('_EBLOG_PING',				'Ping weblog listing service on update?'); // NOTE: This string is no longer in used
try_define('_EBLOG_MAXCOMMENTS',		'Max Amount of comments');
try_define('_EBLOG_UPDATE',				'Update file');
try_define('_EBLOG_OFFSET',				'Time Offset');
try_define('_EBLOG_STIME',				'Current server time is');
try_define('_EBLOG_BTIME',				'Current blog time is');
try_define('_EBLOG_CHANGE',				'Change Settings');
try_define('_EBLOG_CHANGE_BTN',			'Change Settings');
try_define('_EBLOG_ADMIN',				'Blog Admin');
try_define('_EBLOG_ADMIN_MSG',			'You will be assigned admin privileges');
try_define('_EBLOG_CREATE_TITLE',		'Create new weblog');
try_define('_EBLOG_CREATE_TEXT',		'Fill out the form below to create a new weblog. <br /><br /> <b>Note:</b> Only the necessary options are listed. If you want to set extra options, enter the blogsettings page after creating the weblog.');
try_define('_EBLOG_CREATE',				'Create!');
try_define('_EBLOG_CREATE_BTN',			'Create Weblog');
try_define('_EBLOG_CAT_TITLE',			'Categories');
try_define('_EBLOG_CAT_NAME',			'Category Name');
try_define('_EBLOG_CAT_DESC',			'Category Description');
try_define('_EBLOG_CAT_CREATE',			'Create New Category');
try_define('_EBLOG_CAT_UPDATE',			'Update Category');
try_define('_EBLOG_CAT_UPDATE_BTN',		'Update Category');

// templates
try_define('_TEMPLATE_TITLE',			'Edit Templates');
try_define('_TEMPLATE_AVAILABLE_TITLE',	'Available Templates');
try_define('_TEMPLATE_NEW_TITLE',		'New Template');
try_define('_TEMPLATE_NAME',			'Template Name');
try_define('_TEMPLATE_DESC',			'Template Description');
try_define('_TEMPLATE_CREATE',			'Create Template');
try_define('_TEMPLATE_CREATE_BTN',		'Create Template');
try_define('_TEMPLATE_EDIT_TITLE',		'Edit Template');
try_define('_TEMPLATE_BACK',			'Back to Template Overview');
try_define('_TEMPLATE_EDIT_MSG',		'Not all template parts are needed, leave empty those that are not needed.');
try_define('_TEMPLATE_SETTINGS',		'Template Settings');
try_define('_TEMPLATE_ITEMS',			'Items');
try_define('_TEMPLATE_ITEMHEADER',		'Item Header');
try_define('_TEMPLATE_ITEMBODY',		'Item Body');
try_define('_TEMPLATE_ITEMFOOTER',		'Item Footer');
try_define('_TEMPLATE_MORELINK',		'Link to extended entry');
try_define('_TEMPLATE_NEW',				'Indication of new item');
try_define('_TEMPLATE_COMMENTS_ANY',	'Comments (if any)');
try_define('_TEMPLATE_CHEADER',			'Comments Header');
try_define('_TEMPLATE_CBODY',			'Comments Body');
try_define('_TEMPLATE_CFOOTER',			'Comments Footer');
try_define('_TEMPLATE_CONE',			'One Comment');
try_define('_TEMPLATE_CMANY',			'Two (or more) Comments');
try_define('_TEMPLATE_CMORE',			'Comments Read More');
try_define('_TEMPLATE_CMEXTRA',			'Member Extra');
try_define('_TEMPLATE_COMMENTS_NONE',	'Comments (if none)');
try_define('_TEMPLATE_CNONE',			'No Comments');
try_define('_TEMPLATE_COMMENTS_TOOMUCH','Comments (if any, but too much to show inline)');
try_define('_TEMPLATE_CTOOMUCH',		'Too Much Comments');
try_define('_TEMPLATE_ARCHIVELIST',		'Archive Lists');
try_define('_TEMPLATE_AHEADER',			'Archive List Header');
try_define('_TEMPLATE_AITEM',			'Archive List Item');
try_define('_TEMPLATE_AFOOTER',			'Archive List Footer');
try_define('_TEMPLATE_DATETIME',		'Date and Time');
try_define('_TEMPLATE_DHEADER',			'Date Header');
try_define('_TEMPLATE_DFOOTER',			'Date Footer');
try_define('_TEMPLATE_DFORMAT',			'Date Format');
try_define('_TEMPLATE_TFORMAT',			'Time Format');
try_define('_TEMPLATE_LOCALE',			'Locale');
try_define('_TEMPLATE_IMAGE',			'Image popups');
try_define('_TEMPLATE_PCODE',			'Popup Link Code');
try_define('_TEMPLATE_ICODE',			'Inline Image Code');
try_define('_TEMPLATE_MCODE',			'Media Object Link Code');
try_define('_TEMPLATE_SEARCH',			'Search');
try_define('_TEMPLATE_SHIGHLIGHT',		'Highlight');
try_define('_TEMPLATE_SNOTFOUND',		'Nothing found in search');
try_define('_TEMPLATE_UPDATE',			'Update');
try_define('_TEMPLATE_UPDATE_BTN',		'Update Template');
try_define('_TEMPLATE_RESET_BTN',		'Reset Data');
try_define('_TEMPLATE_CATEGORYLIST',	'Category Lists');
try_define('_TEMPLATE_CATHEADER',		'Category List Header');
try_define('_TEMPLATE_CATITEM',			'Category List Item');
try_define('_TEMPLATE_CATFOOTER',		'Category List Footer');

// skins
try_define('_SKIN_EDIT_TITLE',			'Edit Skins');
try_define('_SKIN_AVAILABLE_TITLE',		'Available Skins');
try_define('_SKIN_NEW_TITLE',			'New Skin');
try_define('_SKIN_NAME',				'Name');
try_define('_SKIN_DESC',				'Description');
try_define('_SKIN_TYPE',				'Content Type');
try_define('_SKIN_CREATE',				'Create');
try_define('_SKIN_CREATE_BTN',			'Create Skin');
try_define('_SKIN_EDITONE_TITLE',		'Edit skin');
try_define('_SKIN_BACK',				'Back to Skin Overview');
try_define('_SKIN_PARTS_TITLE',			'Skin Parts');
try_define('_SKIN_PARTS_MSG',			'Not all types are needed for each skin. Leave empty those you don\'t need. Choose the skin type to edit below:');
try_define('_SKIN_PART_MAIN',			'Main Index');
try_define('_SKIN_PART_ITEM',			'Item Pages');
try_define('_SKIN_PART_ALIST',			'Archive List');
try_define('_SKIN_PART_ARCHIVE',		'Archive');
try_define('_SKIN_PART_SEARCH',			'Search');
try_define('_SKIN_PART_ERROR',			'Errors');
try_define('_SKIN_PART_MEMBER',			'Member Details');
try_define('_SKIN_PART_POPUP',			'Image Popups');
try_define('_SKIN_GENSETTINGS_TITLE',	'General Settings');
try_define('_SKIN_CHANGE',				'Change');
try_define('_SKIN_CHANGE_BTN',			'Change these settings');
try_define('_SKIN_UPDATE_BTN',			'Update Skin');
try_define('_SKIN_RESET_BTN',			'Reset Data');
try_define('_SKIN_EDITPART_TITLE',		'Edit Skin');
try_define('_SKIN_GOBACK',				'Go Back');
try_define('_SKIN_ALLOWEDVARS',			'Allowed Variables (click for info):');

// global settings
try_define('_SETTINGS_TITLE',			'General Settings');
try_define('_SETTINGS_SUB_GENERAL',		'General Settings');
try_define('_SETTINGS_DEFBLOG',			'Default Blog');
try_define('_SETTINGS_ADMINMAIL',		'Administrator Email');
try_define('_SETTINGS_SITENAME',		'Site Name');
try_define('_SETTINGS_SITEURL',			'URL of Site (should end with a slash)');
try_define('_SETTINGS_ADMINURL',		'URL of Admin Area (should end with a slash)');
try_define('_SETTINGS_DIRS',			'Nucleus Directories');
try_define('_SETTINGS_MEDIADIR',		'Media Directory');
try_define('_SETTINGS_SEECONFIGPHP',	'(see config.php)');
try_define('_SETTINGS_MEDIAURL',		'Media URL (should end with a slash)');
try_define('_SETTINGS_ALLOWUPLOAD',		'Allow File Upload?');
try_define('_SETTINGS_ALLOWUPLOADTYPES','Allow File Types for Upload');
try_define('_SETTINGS_CHANGELOGIN',		'Allow Members to Change Login/Password');
try_define('_SETTINGS_COOKIES_TITLE',	'Cookie Settings');
try_define('_SETTINGS_COOKIELIFE',		'Login Cookie Lifetime');
try_define('_SETTINGS_COOKIESESSION',	'Session Cookies');
try_define('_SETTINGS_COOKIEMONTH',		'Lifetime of a Month');
try_define('_SETTINGS_COOKIEPATH',		'Cookie Path (advanced)');
try_define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (advanced)');
try_define('_SETTINGS_COOKIESECURE',	'Secure Cookie (advanced)');
try_define('_SETTINGS_LASTVISIT',		'Save Last Visit Cookies');
try_define('_SETTINGS_ALLOWCREATE',		'Allow Visitors to Create a Member Account');
try_define('_SETTINGS_NEWLOGIN',		'Login Allowed for User-Created accounts');
try_define('_SETTINGS_NEWLOGIN2',		'(only goes for newly created accounts)');
try_define('_SETTINGS_MEMBERMSGS',		'Allow Member-2-Member Service');
try_define('_SETTINGS_LANGUAGE',		'Default Language');
try_define('_SETTINGS_DISABLESITE',		'Disable Site');
try_define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
try_define('_SETTINGS_UPDATE',			'Update Settings');
try_define('_SETTINGS_UPDATE_BTN',		'Update Settings');
try_define('_SETTINGS_DISABLEJS',		'Disable JavaScript Toolbar');
try_define('_SETTINGS_MEDIA',			'Media/Upload Settings');
try_define('_SETTINGS_MEDIAPREFIX',		'Prefix uploaded files with date');
try_define('_SETTINGS_MEMBERS',			'Member Settings');

// bans
try_define('_BAN_TITLE',				'Ban List for');
try_define('_BAN_NONE',					'No bans for this weblog');
try_define('_BAN_NEW_TITLE',			'Add New Ban');
try_define('_BAN_NEW_TEXT',				'Add a new ban now');
try_define('_BAN_REMOVE_TITLE',			'Remove Ban');
try_define('_BAN_IPRANGE',				'IP Range');
try_define('_BAN_BLOGS',				'Which blogs?');
try_define('_BAN_DELETE_TITLE',			'Delete Ban');
try_define('_BAN_ALLBLOGS',				'All blogs to which you have admin privileges.');
try_define('_BAN_REMOVED_TITLE',		'Ban Removed');
try_define('_BAN_REMOVED_TEXT',			'Ban was removed for the following blogs:');
try_define('_BAN_ADD_TITLE',			'Add Ban');
try_define('_BAN_IPRANGE_TEXT',			'Choose the IP range you want to block below. The less numbers in it, the more addresses will be blocked.');
try_define('_BAN_BLOGS_TEXT',			'You can either select to ban the IP on one blog only, or you can select to block the IP on all blogs where you have administrator privileges. Make your choice below.');
try_define('_BAN_REASON_TITLE',			'Reason');
try_define('_BAN_REASON_TEXT',			'You can provide a reason for the ban, which will be displayed when the IP holder tries to add another comment or tries to cast a karma vote. Maximum length is 256 characters.');
try_define('_BAN_ADD_BTN',				'Add Ban');

// LOGIN screen
try_define('_LOGIN_MESSAGE',			'Message');
try_define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
try_define('_LOGIN_FORGOT',				'Forgot your password?');

// membermanagement
try_define('_MEMBERS_TITLE',			'Member Management');
try_define('_MEMBERS_CURRENT',			'Current Members');
try_define('_MEMBERS_NEW',				'New Member');
try_define('_MEMBERS_DISPLAY',			'Display Name');
try_define('_MEMBERS_DISPLAY_INFO',		'(This is the name you use to login)');
try_define('_MEMBERS_REALNAME',			'Real Name');
try_define('_MEMBERS_PWD',				'Password');
try_define('_MEMBERS_REPPWD',			'Repeat Password');
try_define('_MEMBERS_EMAIL',			'Email address');
try_define('_MEMBERS_EMAIL_EDIT',		'(When you change the email address, a new password will be automatically sent out to that address)');
try_define('_MEMBERS_URL',				'Website Address (URL)');
try_define('_MEMBERS_SUPERADMIN',		'Administrator privileges');
try_define('_MEMBERS_CANLOGIN',			'Can login to admin area');
try_define('_MEMBERS_NOTES',			'Notes');
try_define('_MEMBERS_NEW_BTN',			'Add Member');
try_define('_MEMBERS_EDIT',				'Edit Member');
try_define('_MEMBERS_EDIT_BTN',			'Change Settings');
try_define('_MEMBERS_BACKTOOVERVIEW',	'Back to Member Overview');
try_define('_MEMBERS_DEFLANG',			'Language');
try_define('_MEMBERS_USESITELANG',		'- use site settings -');

// List of blogs (TT = tooltip)
try_define('_BLOGLIST_TT_VISIT',		'Visit Site');
try_define('_BLOGLIST_ADD',				'Add Item');
try_define('_BLOGLIST_TT_ADD',			'Add a new item to this weblog');
try_define('_BLOGLIST_EDIT',			'Edit/Delete Items');
try_define('_BLOGLIST_TT_EDIT',			'');
try_define('_BLOGLIST_BMLET',			'Bookmarklet');
try_define('_BLOGLIST_TT_BMLET',		'');
try_define('_BLOGLIST_SETTINGS',		'Settings');
try_define('_BLOGLIST_TT_SETTINGS',		'Edit settings or manage team');
try_define('_BLOGLIST_BANS',			'Bans');
try_define('_BLOGLIST_TT_BANS',			'View, add or remove banned IPs');
try_define('_BLOGLIST_DELETE',			'Delete All');
try_define('_BLOGLIST_TT_DELETE',		'Delete this weblog');

// OVERVIEW screen
try_define('_OVERVIEW_YRBLOGS',			'Your weblogs');
try_define('_OVERVIEW_YRDRAFTS',		'Your drafts');
try_define('_OVERVIEW_YRSETTINGS',		'Your settings');
try_define('_OVERVIEW_GSETTINGS',		'General settings');
try_define('_OVERVIEW_NOBLOGS',			'You\'re not on any weblogs teamlist');
try_define('_OVERVIEW_NODRAFTS',		'No drafts');
try_define('_OVERVIEW_EDITSETTINGS',	'Edit Your Settings...');
try_define('_OVERVIEW_BROWSEITEMS',		'Browse your items...');
try_define('_OVERVIEW_BROWSECOMM',		'Browse your comments...');
try_define('_OVERVIEW_VIEWLOG',			'View Action Log...');
try_define('_OVERVIEW_MEMBERS',			'Manage Members...');
try_define('_OVERVIEW_NEWLOG',			'Create New Weblog...');
try_define('_OVERVIEW_SETTINGS',		'Edit Settings...');
try_define('_OVERVIEW_TEMPLATES',		'Edit Templates...');
try_define('_OVERVIEW_SKINS',			'Edit Skins...');
try_define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
try_define('_ITEMLIST_BLOG',			'Items for blog');
try_define('_ITEMLIST_YOUR',			'Your items');

// Comments
try_define('_COMMENTS',					'Comments');
try_define('_NOCOMMENTS',				'No comments for this item');
try_define('_COMMENTS_YOUR',			'Your Comments');
try_define('_NOCOMMENTS_YOUR',			'You didn\'t write any comments');

// LISTS (general)
try_define('_LISTS_NOMORE',				'No more results, or no results at all');
try_define('_LISTS_PREV',				'Previous');
try_define('_LISTS_NEXT',				'Next');
try_define('_LISTS_SEARCH',				'Search');
try_define('_LISTS_CHANGE',				'Change');
try_define('_LISTS_PERPAGE',			'items/page');
try_define('_LISTS_ACTIONS',			'Actions');
try_define('_LISTS_DELETE',				'Delete');
try_define('_LISTS_EDIT',				'Edit');
try_define('_LISTS_MOVE',				'Move');
try_define('_LISTS_CLONE',				'Clone');
try_define('_LISTS_TITLE',				'Title');
try_define('_LISTS_BLOG',				'Blog');
try_define('_LISTS_NAME',				'Name');
try_define('_LISTS_DESC',				'Description');
try_define('_LISTS_TIME',				'Time');
try_define('_LISTS_COMMENTS',			'Comments');
try_define('_LISTS_TYPE',				'Type');


// member list
try_define('_LIST_MEMBER_NAME',			'Display Name');
try_define('_LIST_MEMBER_RNAME',		'Real Name');
try_define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
try_define('_LIST_MEMBER_LOGIN',		'Can login? ');
try_define('_LIST_MEMBER_URL',			'Website');

// banlist
try_define('_LIST_BAN_IPRANGE',			'IP Range');
try_define('_LIST_BAN_REASON',			'Reason');

// actionlist
try_define('_LIST_ACTION_MSG',			'Message');

// commentlist
try_define('_LIST_COMMENT_BANIP',		'Ban IP');
try_define('_LIST_COMMENT_WHO',			'Author');
try_define('_LIST_COMMENT',				'Comment');
try_define('_LIST_COMMENT_HOST',		'Host');

// itemlist
try_define('_LIST_ITEM_INFO',			'Info');
try_define('_LIST_ITEM_CONTENT',		'Title and Text');


// teamlist
try_define('_LIST_TEAM_ADMIN',			'Admin ');
try_define('_LIST_TEAM_CHADMIN',		'Change Admin');

// edit comments
try_define('_EDITC_TITLE',				'Edit Comments');
try_define('_EDITC_WHO',				'Author');
try_define('_EDITC_HOST',				'From Where?');
try_define('_EDITC_WHEN',				'When?');
try_define('_EDITC_TEXT',				'Text');
try_define('_EDITC_EDIT',				'Edit Comment');
try_define('_EDITC_MEMBER',				'member');
try_define('_EDITC_NONMEMBER',			'non member');

// move item
try_define('_MOVE_TITLE',				'Move to which blog?');
try_define('_MOVE_BTN',					'Move Item');
