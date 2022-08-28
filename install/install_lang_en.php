<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: install.php 1227 2007-12-14 16:48:40Z ehui $
 */

try_define('_INSTALL_TEXT_ERROR_CONFIG_EXIST',             'The config.php file already exists. To reinstall, you need to delete ../config.php.');
try_define('_INSTALL_TEXT_ERROR_INSTALLATION_EXPIRED',     'Your installation has expired. Please update your index.php again.');
try_define('_INSTALL_TEXT_ERROR_PHP_MINIMUM_REQUIREMENT',  'The version of PHP that is running is outdated and does not meet the required minimum requirements.It will cancel the installation work.Please check with the server administrator whether PHP %s or higher can not be used.');
try_define('_INSTALL_TEXT_ERROR_ROOT_CONFIGFOLDER_NOT_WRITABLE',  'Nucleus root folder (../) is not writable. Nucleus installer  can not write the config.php file.');

/*  New for 3.72 */
try_define('_INSTALL_TEXT_DATABASE_SELECT' , 'Select Database');
try_define('_INSTALL_TEXT_DATABASE_LOGIN_INFO',				'Database login information');

try_define('_INSTALL_TEXT_DATABASE_EXSIT',	'Database is already exits.');
try_define('_INSTALL_TEXT_SETTINGS_NOEXSIT',	'../settings not exist');
try_define('_INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_1',	'../config.php  exist');
try_define('_INSTALL_TEXT_ERROR_SQLITE_SETTINGS_EXSIT_2',	'For security reasons, if present, can not be installed.');

try_define('_INSTALL_TEXT_VERSION',	      'Version');
try_define('_INSTALL_TEXT_SELECT_TEXT',	  'select text');
try_define('_INSTALL_TEXT_EXPERIMENTAL',  'experimental');

try_define('_INST_CONF_ERROR1' , 'please run the <a href="./install/index.php">install script</a> or modify config.php');


/*  New for 3.71 */
try_define('_HEADER_LANG_SELECT',			 'Language');
try_define('_TEXT_LANG_SELECT1_1_TAB_HEAD',	 'Choose language');
try_define('_TEXT_LANG_SELECT1_1_TAB_FIELD1',	'Language');
try_define('_TEXT_LANG_SELECT1_1',	'Choose a language to use.');

/*   */

try_define('_ERROR1',	'Your PHP version does not have support for MySQL :(');
try_define('_ERROR_NO_DBNAME',	'mySQL database name missing');
try_define('_ERROR3',	'mySQL prefix was selected, but prefix is empty');
try_define('_ERROR4',	'mySQL prefix should only contain characters from the ranges A-Z, a-z, 0-9 or underscores');
try_define('_ERROR5',	'One of the URLs does not end with a slash, or action url does not end with \'action.php\'');
try_define('_ERROR6',	'The path of the administration area does not end with a slash');
try_define('_ERROR7',	'The media path does not end with a slash');
try_define('_ERROR8',	'The skins path does not end with a slash');
try_define('_ERROR9',	'The path of the administration area does not exist on your server');

try_define('_ERROR10',	'Invalid e-mail address given for user');
try_define('_ERROR11',	'User name is not a valid display name (allowed chars: a-zA-Z0-9 and spaces)');
try_define('_ERROR12',	'User password is empty');
try_define('_ERROR13',	'User password do not match');
try_define('_ERROR14',	'Invalid short name given for blog (allowed chars: a-z0-9, no spaces)');
try_define('_ERROR15',	'Could not connect to mySQL server');
try_define('_ERROR16',	'Could not create database. Make sure you have the rights to do so. SQL error was');
try_define('_ERROR17',	'Could not select database. Make sure it exists');
try_define('_ERROR18',	'Error while executing query');
try_define('_ERROR19',	'Error while setting member settings');
try_define('_ERROR20',	'Error while setting weblog settings');
try_define('_ERROR21',	'Error with query');
try_define('_ERROR22',	'Unable to install plugin ');
try_define('_ERROR23_1',	'Unable to import ');
try_define('_ERROR23_2',	'file does not exist');
try_define('_ERROR24',	'Unable to import ');
try_define('_ERROR25_1',	'File <b>');
try_define('_ERROR25_2',	'</b> is missing or not readable.');
try_define('_ERROR26',	'Query error while trying to update config');
try_define('_ERROR27',	'Error!');
try_define('_ERROR28',	'Error message was');
try_define('_ERROR29',	'Error message were');
try_define('_ERROR30',	'Error while executing query');

try_define('_NOTIFICATION1',	'Not available');

try_define('_ALT_NUCLEUS_CMS_LOGO',	'Logo of Nucleus CMS');
try_define('_TITLE',	'Nucleus Install');
try_define('_TITLE2',	'Skin/Plugin Install Errors');
try_define('_TITLE3',	'Installation Almost Complete!');
try_define('_TITLE4',	'Installation complete!');
try_define('_TITLE5',	'Fight against Spam');

try_define('_HEADER1', 	'Install Nucleus');
try_define('_TEXT1',	'<p>This script will help you to install Nucleus. It will set up your MySQL database tables and provide you with the information you need to enter in <i>config.php</i>. In order to do all this, you need to enter some information.</p><p>All fields are mandatory. Optional information can be set from the Nucleus admin-area when installation is completed.</p>');

try_define('_HEADER1_2',			'Character Set');
try_define('_TEXT1_2',				'Choose a character set to use. Recommend UTF-8.');
try_define('_TEXT1_2_TAB_HEAD',		'Choose character set');
try_define('_TEXT1_2_TAB_FIELD1',	'Character Set');

try_define('_HEADER2',	'PHP &amp; MySQL Versions');
try_define('_TEXT2',	'<p>Below are the version numbers of the PHP interpreter and the MySQL server on your webhost. When reporting problems on the Nucleus Support Forum, please include this information.</p>');
try_define('_TEXT2_WARN',	'WARNING: Nucleus requires at least PHP ');
try_define('_TEXT2_WARN2',	'INFORMATION: Nucleus requires at least MySQL ');
try_define('_TEXT2_WARN3',	'WARNING: The version of PHP that is running is outdated and does not meet the required minimum requirements.It will cancel the installation work.Please check with the server administrator whether PHP 5 or higher can not be used.');

try_define('_HEADER3',	'Automatic <i>config.php</i> Update');
try_define('_TEXT3',	'<p>If you want Nucleus to automatically update the <em>config.php</em> file, you\'ll need to make it writable. You can do this by changing the file permissions to <strong>666</strong>. After Nucleus is successfully installed, you can change the permissions back to <strong>444</strong> (<a href="nucleus/documentation/tips.html#filepermissions">Quick guide on how to change file permissions</a>).</p> <p>If you choose not to make your file writable (or are unable to do so): don\'t worry. The installation process will provide you with the contents of the <em>config.php</em> file so you can upload it yourself.</p>');

try_define('_TEXT4',	'<p>Enter your MySQL data below. This install script needs it to be able to create and fill your database tables. Afterwards, you\'ll also need to fill it out in <i>config.php</i>.</p> <p>If you don\'t know this information, contact your system administrator for more info. Often, the hostname will be \'localhost\'. If Nucleus found a \'default MySQL host\' in the PHP settings of your server, this host is already listed in the \'hostname\' field. There\'s no guarantee that this information is correct, though.</p>');
try_define('_TEXT4_TAB_HEAD',	'General Database Settings');
try_define('_TEXT4_TAB_FIELD1',	'Hostname');
try_define('_TEXT4_TAB_FIELD2',	'Username');
try_define('_TEXT4_TAB_FIELD3',	'Password');
try_define('_TEXT4_TAB_FIELD4',	'Database');
try_define('_TEXT4_TAB_FIELD4_ADD',	'needs to be created');

try_define('_TEXT4_TAB2_HEAD',	'Advanced Database Settings');
try_define('_TEXT4_TAB2_FIELD',	'Use table prefix');
try_define('_TEXT4_TAB2_ADD',	'<p>Unless you\'re installing multiple Nucleus installations in one single database and know what you\'re doing, <strong>you really shouldn\'t change this</strong>.</p> <p>All database tables generated by Nucleus will start with this prefix.</p>');

try_define('_HEADER5',	'Directories and URLs');
try_define('_TEXT5',	'<p>This install script has attempted to find out the directories and URLs in which Nucleus is installed. Please check the values below and correct if necessary. The URLs and file paths should end with a slash.</p>');

try_define('_TEXT5_TAB_HEAD',	'URLs and directories');
try_define('_TEXT5_TAB_FIELD1',	'Site <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD2',	'Admin-area <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD3',	'Admin-area <strong>path</strong>');
try_define('_TEXT5_TAB_FIELD4',	'Media files <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD5',	'Media directory <strong>path</strong>');
try_define('_TEXT5_TAB_FIELD6',	'Extra skin files <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD7',	'Extra skin files directory <strong>path</strong>');
try_define('_TEXT5_TAB_FIELD7_2',	'this is where imported skins can place their extra files');
try_define('_TEXT5_TAB_FIELD8',	'Plugin files <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD9',	'Action <strong>URL</strong>');
try_define('_TEXT5_TAB_FIELD9_2',	'absolute location of the <tt>action.php</tt> file');
try_define('_TEXT5_2',	'<p class="note"><strong>Note: Use absolute paths</strong> instead of relative paths. Usually, an absolute path will start with something like <tt>/home/username/public_html/</tt>. On Unix systems (most servers), paths should start with a slash. If you have trouble filling out this information, you should ask your administrator what to fill out.</p>');

try_define('_HEADER6',	'Administrator User');
try_define('_TEXT6',	'<p>Below, you need to enter some information to create the first user of your site.</p>');
try_define('_TEXT6_TAB_HEAD',	'Administrator User');
try_define('_TEXT6_TAB_FIELD1',	'Display Name');
try_define('_TEXT6_TAB_FIELD1_2',	'allowed characters: a-z and 0-9, spaces allowed inside');
try_define('_TEXT6_TAB_FIELD2',	'Real Name');
try_define('_TEXT6_TAB_FIELD3',	'Password');
try_define('_TEXT6_TAB_FIELD4',	'Password Again');
try_define('_TEXT6_TAB_FIELD5',	'E-mail Address');
try_define('_TEXT6_TAB_FIELD5_2',	'needs to be a valid e-mail address');

try_define('_HEADER7',	'Weblog Data');
try_define('_TEXT7',	'<p>Below, you need to enter some information to create a default weblog. The name of this weblog will also be used as name for your site</p>');
try_define('_TEXT7_TAB_HEAD',	'Weblog Data');
try_define('_TEXT7_TAB_FIELD1',	'Blog Name');
try_define('_TEXT7_TAB_FIELD2',	'Blog Short Name');
try_define('_TEXT7_TAB_FIELD2_2',	'allowed characters: a-z and 0-9, no spaces allowed');

try_define('_HEADER9',	'Submit');
try_define('_TEXT9',	'<p>Verify the data above, and click the button below to set up your database tables and initial data. This can take a while, so have patience. <strong>ONLY CLICK THE BUTTON ONCE !</strong></p>');

try_define('_TEXT10',	'<p>The database tables have been initialized successfully. What still needs to be done is to change the contents of <i>config.php</i>. Below is how it should look like (the mysql password is masked, so you\'ll have to fill that out yourself)</p>');
try_define('_TEXT11',	'<p>After you changed the file on your computer, upload it to your web server using FTP. Make sure you use ASCII mode to send over the files.</p>');
try_define('_TEXT12',	'<b>Note:</b> Make sure that you have no spaces at the beginning or end of the <i>config.php</i> file. These would cause errors to happen when performing certain actions.<br /> Thus, the first character of config.php should be "&lt;", and the last character should be "&gt;".');
try_define('_TEXT13',	'<p>Nucleus has been installed, and your <code>config.php</code> has been updated for you.</p> <p>Don\'t forget to change the permissions on <code>config.php</code> back to 444 for security (<a href="nucleus/documentation/tips.html#filepermissions">Quick guide on how to change file permissions</a>).</p>');
try_define('_TEXT14',	'<p>Nucleus CMS allows every visitor to write comments in blogs. So there is a high risk that spammers abuse this function. We recommend that you protect your blog with one of the following methods:</p>');
try_define('_TEXT14_L1',	'If you don\'t want comments you can disable them individually for each blog: Go to the hompage of the Admin area and choose <b>Your Weblog > Settings > Comments enabled > No</b>.');
try_define('_TEXT14_L2',	'Install one of serveral plugins that help to avoid spam comments: <a href="http://faq.nucleuscms.org/item/45">How can I stop comment and trackback spam?</a> (you could bookmark this page to read it later).');
try_define('_HEADER10',	'Delete your install files');
try_define('_TEXT15',	'<p>Files you should delete from your web server:</p>');
try_define('_TEXT15_L1',	'<b>install/install.sql</b>: file containing table structures');
try_define('_TEXT15_L2',	'<b>install/index.php</b>: this file');
try_define('_TEXT15_L3',	'<b>install_lang_*.php</b>');
try_define('_TEXT15_L4',	'<b>install/*</b>');

try_define('_TEXT16',	'<p>If you don\'t delete these files, you won\\\'t be able to open the admin area</p>');

try_define('_HEADER11',	'Visit your web site');
try_define('_TEXT16_H',	'Your web site is now ready to use.');
try_define('_TEXT16_L1',	'Login to the admin area to configure your site');
try_define('_TEXT16_L2',	'Visit your site now');

try_define('_TEXT17',	'Go Back');

try_define('_BUTTON1',	'Install Nucleus');

try_define('_GENERALCAT_NAME',		'general');

try_define('_1ST_POST_TITLE',	'Welcome to Nucleus CMS Version %s');
try_define('_1ST_POST',	'This is the first post on your Nucleus CMS. You can edit this page.');
try_define('_1ST_POST2',	'');

try_define('_CONFIRM_RETRY_SEND_FORM',		'Would you like to retry submitting the form?');
