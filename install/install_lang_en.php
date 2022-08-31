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

/*  New for 3.71-fix */
define('_INSTALL_TEXT_ERROR_INSTALLATION_EXPIRED',  'Your installation has expired. Please re-upload install/index.php with a current timestamp.');
define('_INSTALL_TEXTCOMFIRM_RETRY_SEND',           '_INSTALL_TEXTCOMFIRM_RETRY_SEND');

/*  New for 3.71 */
define('_HEADER_LANG_SELECT',			 'Language');
define('_TEXT_LANG_SELECT1_1_TAB_HEAD',	 'Choose language');
define('_TEXT_LANG_SELECT1_1_TAB_FIELD1',	'Language');
define('_TEXT_LANG_SELECT1_1',	'Choose a language to use.');

/*   */

define('_ERROR1',	'Your PHP version does not have support for MySQL :(');
define('_ERROR2',	'mySQL database name missing');
define('_ERROR3',	'mySQL prefix was selected, but prefix is empty');
define('_ERROR4',	'mySQL prefix should only contain characters from the ranges A-Z, a-z, 0-9 or underscores');
define('_ERROR5',	'One of the URLs does not end with a slash, or action url does not end with \'action.php\'');
define('_ERROR6',	'The path of the administration area does not end with a slash');
define('_ERROR7',	'The media path does not end with a slash');
define('_ERROR8',	'The skins path does not end with a slash');
define('_ERROR9',	'The path of the administration area does not exist on your server');
define('_ERROR10',	'Invalid e-mail address given for user');
define('_ERROR11',	'User name is not a valid display name (allowed chars: a-zA-Z0-9 and spaces)');
define('_ERROR12',	'User password is empty');
define('_ERROR13',	'User password do not match');
define('_ERROR14',	'Invalid short name given for blog (allowed chars: a-z0-9, no spaces)');
define('_ERROR15',	'Could not connect to mySQL server');
define('_ERROR16',	'Could not create database. Make sure you have the rights to do so. SQL error was');
define('_ERROR17',	'Could not select database. Make sure it exists');
define('_ERROR18',	'Error while executing query');
define('_ERROR19',	'Error while setting member settings');
define('_ERROR20',	'Error while setting weblog settings');
define('_ERROR21',	'Error with query');
define('_ERROR22',	'Unable to install plugin ');
define('_ERROR23_1',	'Unable to import ');
define('_ERROR23_2',	'file does not exist');
define('_ERROR24',	'Unable to import ');
define('_ERROR25_1',	'File <b>');
define('_ERROR25_2',	'</b> is missing or not readable.');
define('_ERROR26',	'Query error while trying to update config');
define('_ERROR27',	'Error!');
define('_ERROR28',	'Error message was');
define('_ERROR29',	'Error message were');
define('_ERROR30',	'Error while executing query');

define('_NOTIFICATION1',	'Not available');

define('_ALT_NUCLEUS_CMS_LOGO',	'Logo of Nucleus CMS');
define('_TITLE',	'Nucleus Install');
define('_TITLE2',	'Skin/Plugin Install Errors');
define('_TITLE3',	'Installation Almost Complete!');
define('_TITLE4',	'Installation complete!');
define('_TITLE5',	'Fight against Spam');

define('_HEADER1', 	'Install Nucleus');
define('_TEXT1',	'<p>This script will help you to install Nucleus. It will set up your MySQL database tables and provide you with the information you need to enter in <i>config.php</i>. In order to do all this, you need to enter some information.</p><p>All fields are mandatory. Optional information can be set from the Nucleus admin-area when installation is completed.</p>');

define('_HEADER1_2',			'Character Set');
define('_TEXT1_2',				'Choose a character set to use. Recommend UTF-8.');
define('_TEXT1_2_TAB_HEAD',		'Choose character set');
define('_TEXT1_2_TAB_FIELD1',	'Character Set');

define('_HEADER2',	'PHP &amp; MySQL Versions');
define('_TEXT2',	'<p>Below are the version numbers of the PHP interpreter and the MySQL server on your webhost. When reporting problems on the Nucleus Support Forum, please include this information.</p>');
define('_TEXT2_WARN',	'WARNING: Nucleus requires at least PHP ');
define('_TEXT2_WARN2',	'INFORMATION: Nucleus requires at least MySQL ');
define('_TEXT2_WARN3',	'WARNING: You are installing NucleusCMS on a older version of PHP. PHP4 support will be depreciated in the next release, please consider upgrade to PHP5!');

define('_HEADER3',	'Automatic <i>config.php</i> Update');
define('_TEXT3',	'<p>If you want Nucleus to automatically update the <em>config.php</em> file, you\'ll need to make it writable. You can do this by changing the file permissions to <strong>666</strong>. After Nucleus is successfully installed, you can change the permissions back to <strong>444</strong> (<a href="nucleus/documentation/tips.html#filepermissions">Quick guide on how to change file permissions</a>).</p> <p>If you choose not to make your file writable (or are unable to do so): don\'t worry. The installation process will provide you with the contents of the <em>config.php</em> file so you can upload it yourself.</p>');

define('_HEADER4',	'MySQL Login Data');
define('_TEXT4',	'<p>Enter your MySQL data below. This install script needs it to be able to create and fill your database tables. Afterwards, you\'ll also need to fill it out in <i>config.php</i>.</p> <p>If you don\'t know this information, contact your system administrator for more info. Often, the hostname will be \'localhost\'. If Nucleus found a \'default MySQL host\' in the PHP settings of your server, this host is already listed in the \'hostname\' field. There\'s no guarantee that this information is correct, though.</p>');
define('_TEXT4_TAB_HEAD',	'General Database Settings');
define('_TEXT4_TAB_FIELD1',	'Hostname');
define('_TEXT4_TAB_FIELD2',	'Username');
define('_TEXT4_TAB_FIELD3',	'Password');
define('_TEXT4_TAB_FIELD4',	'Database');
define('_TEXT4_TAB_FIELD4_ADD',	'needs to be created');

define('_TEXT4_TAB2_HEAD',	'Advanced Database Settings');
define('_TEXT4_TAB2_FIELD',	'Use table prefix');
define('_TEXT4_TAB2_ADD',	'<p>Unless you\'re installing multiple Nucleus installations in one single database and know what you\'re doing, <strong>you really shouldn\'t change this</strong>.</p> <p>All database tables generated by Nucleus will start with this prefix.</p>');

define('_HEADER5',	'Directories and URLs');
define('_TEXT5',	'<p>This install script has attempted to find out the directories and URLs in which Nucleus is installed. Please check the values below and correct if necessary. The URLs and file paths should end with a slash.</p>');

define('_TEXT5_TAB_HEAD',	'URLs and directories');
define('_TEXT5_TAB_FIELD1',	'Site <strong>URL</strong>');
define('_TEXT5_TAB_FIELD2',	'Admin-area <strong>URL</strong>');
define('_TEXT5_TAB_FIELD3',	'Admin-area <strong>path</strong>');
define('_TEXT5_TAB_FIELD4',	'Media files <strong>URL</strong>');
define('_TEXT5_TAB_FIELD5',	'Media directory <strong>path</strong>');
define('_TEXT5_TAB_FIELD6',	'Extra skin files <strong>URL</strong>');
define('_TEXT5_TAB_FIELD7',	'Extra skin files directory <strong>path</strong>');
define('_TEXT5_TAB_FIELD7_2',	'this is where imported skins can place their extra files');
define('_TEXT5_TAB_FIELD8',	'Plugin files <strong>URL</strong>');
define('_TEXT5_TAB_FIELD9',	'Action <strong>URL</strong>');
define('_TEXT5_TAB_FIELD9_2',	'absolute location of the <tt>action.php</tt> file');
define('_TEXT5_2',	'<p class="note"><strong>Note: Use absolute paths</strong> instead of relative paths. Usually, an absolute path will start with something like <tt>/home/username/public_html/</tt>. On Unix systems (most servers), paths should start with a slash. If you have trouble filling out this information, you should ask your administrator what to fill out.</p>');

define('_HEADER6',	'Administrator User');
define('_TEXT6',	'<p>Below, you need to enter some information to create the first user of your site.</p>');
define('_TEXT6_TAB_HEAD',	'Administrator User');
define('_TEXT6_TAB_FIELD1',	'Display Name');
define('_TEXT6_TAB_FIELD1_2',	'allowed characters: a-z and 0-9, spaces allowed inside');
define('_TEXT6_TAB_FIELD2',	'Real Name');
define('_TEXT6_TAB_FIELD3',	'Password');
define('_TEXT6_TAB_FIELD4',	'Password Again');
define('_TEXT6_TAB_FIELD5',	'E-mail Address');
define('_TEXT6_TAB_FIELD5_2',	'needs to be a valid e-mail address');

define('_HEADER7',	'Weblog Data');
define('_TEXT7',	'<p>Below, you need to enter some information to create a default weblog. The name of this weblog will also be used as name for your site</p>');
define('_TEXT7_TAB_HEAD',	'Weblog Data');
define('_TEXT7_TAB_FIELD1',	'Blog Name');
define('_TEXT7_TAB_FIELD2',	'Blog Short Name');
define('_TEXT7_TAB_FIELD2_2',	'allowed characters: a-z and 0-9, no spaces allowed');

define('_HEADER9',	'Submit');
define('_TEXT9',	'<p>Verify the data above, and click the button below to set up your database tables and initial data. This can take a while, so have patience. <strong>ONLY CLICK THE BUTTON ONCE !</strong></p>');

define('_TEXT10',	'<p>The database tables have been initialized successfully. What still needs to be done is to change the contents of <i>config.php</i>. Below is how it should look like (the mysql password is masked, so you\'ll have to fill that out yourself)</p>');
define('_TEXT11',	'<p>After you changed the file on your computer, upload it to your web server using FTP. Make sure you use ASCII mode to send over the files.</p>');
define('_TEXT12',	'<b>Note:</b> Make sure that you have no spaces at the beginning or end of the <i>config.php</i> file. These would cause errors to happen when performing certain actions.<br /> Thus, the first character of config.php should be "&lt;", and the last character should be "&gt;".');
define('_TEXT13',	'<p>Nucleus has been installed, and your <code>config.php</code> has been updated for you.</p> <p>Don\'t forget to change the permissions on <code>config.php</code> back to 444 for security (<a href="nucleus/documentation/tips.html#filepermissions">Quick guide on how to change file permissions</a>).</p>');
define('_TEXT14',	'<p>Nucleus CMS allows every visitor to write comments in blogs. So there is a high risk that spammers abuse this function. We recommend that you protect your blog with one of the following methods:</p>');
define('_TEXT14_L1',	'If you don\'t want comments you can disable them individually for each blog: Go to the hompage of the Admin area and choose <b>Your Weblog > Settings > Comments enabled > No</b>.');
define('_TEXT14_L2',	'Install one of serveral plugins that help to avoid spam comments: <a href="http://faq.nucleuscms.org/item/45">How can I stop comment and trackback spam?</a> (you could bookmark this page to read it later).');
define('_HEADER10',	'Delete your install files');
define('_TEXT15',	'<p>Files you should delete from your web server:</p>');
define('_TEXT15_L1',	'<b>install/install.sql</b>: file containing table structures');
define('_TEXT15_L2',	'<b>install/index.php</b>: this file');
define('_TEXT15_L3',	'<b>install_lang_*.php</b>');
define('_TEXT15_L4',	'<b>install/*</b>');

define('_TEXT16',	'<p>If you don\'t delete these files, you won\\\'t be able to open the admin area</p>');

define('_HEADER11',	'Visit your web site');
define('_TEXT16_H',	'Your web site is now ready to use.');
define('_TEXT16_L1',	'Login to the admin area to configure your site');
define('_TEXT16_L2',	'Visit your site now');

define('_TEXT17',	'Go Back');

define('_BUTTON1',	'Install Nucleus');

define('_GENERALCAT_NAME',		'general');

define('_1ST_POST_TITLE',	'Welcome to Nucleus CMS Version %s');
define('_1ST_POST',	'This is the first post on your Nucleus CMS. You can edit this page.');
define('_1ST_POST2',	'');

