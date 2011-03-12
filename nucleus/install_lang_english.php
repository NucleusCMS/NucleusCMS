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

define('_HEADER8',	'Weblog Ping');
define('_TEXT8_TAB_HEADER',	'Weblog Ping');
define('_TEXT8_TAB_FIELD1',	'Install NP_Ping weblog pinging plugin');

define('_HEADER9',	'Submit');
define('_TEXT9',	'<p>Verify the data above, and click the button below to set up your database tables and initial data. This can take a while, so have patience. <strong>ONLY CLICK THE BUTTON ONCE !</strong></p>');

define('_TEXT10',	'<p>The database tables have been initialized successfully. What still needs to be done is to change the contents of <i>config.php</i>. Below is how it should look like (the mysql password is masked, so you\'ll have to fill that out yourself)</p>');
define('_TEXT11',	'<p>After you changed the file on your computer, upload it to your web server using FTP. Make sure you use ASCII mode to send over the files.</p>');
define('_TEXT12',	'<b>Note:</b> Make sure that you have no spaces at the beginning or end of the <i>config.php</i> file. These would cause errors to happen when performing certain actions.<br /> Thus, the first character of config.php should be "&lt;", and the last character should be "&gt;".');
define('_TEXT13',	'<p>Nucleus has been installed, and your <code>config.php</code> has been updated for you.</p> <p>Don\'t forget to change the permissions on <code>config.php</code> back to 444 for security (<a href="nucleus/documentation/tips.html#filepermissions">Quick guide on how to change file permissions</a>).</p>');
define('_TEXT14',	'<p>Nucleus CMS allows every visitor to write comments in blogs. So there is a high risk that spammers abuse this function. We recommend that you protect your blog with one of the following methods:</p>');
define('_TEXT14_L1',	'If you don\\\'t want comments you can disable them individually for each blog: Go to the hompage of the Admin area and choose <b>Your Weblog > Settings > Comments enabled > No</b>.');
define('_TEXT14_L2',	'Install one of serveral plugins that help to avoid spam comments: <a href="http://faq.nucleuscms.org/item/45">How can I stop comment and trackback spam?</a> (you could bookmark this page to read it later).');
define('_HEADER10',	'Delete your install files');
define('_TEXT15',	'<p>Files you should delete from your web server:</p>');
define('_TEXT15_L1',	'<b>install.sql</b>: file containing table structures');
define('_TEXT15_L2',	'<b>install.php</b>: this file');

define('_TEXT16',	'<p>If you don\\\'t delete these files, you won\\\'t be able to open the admin area</p>');

define('_HEADER11',	'Visit your web site');
define('_TEXT16_H',	'Your web site is now ready to use.');
define('_TEXT16_L1',	'Login to the admin area to configure your site');
define('_TEXT16_L2',	'Visit your site now');

define('_TEXT17',	'Go Back');

define('_BUTTON1',	'Install Nucleus');

define('_1ST_POST_TITLE',	'Welcome to Nucleus CMS v3.6');
define('_1ST_POST',	'This is the first post on your Nucleus CMS. Nucleus offers you the building blocks you need to create a web presence. Whether you want to
create a personal blog, a family page, or an online business site, Nucleus CMS can help you achieve your goals.<br /> <br /> We\\\'ve loaded this first entry with links and information to get you started. Though you can delete this entry, it will eventually scroll off the main page as you add content to your site. Add your comments while you learn to work with Nucleus CMS, or bookmark this page so you can come back to it when you need to.');
define('_1ST_POST2',	'<b>Home - <a href=\"http://nucleuscms.org/\" title=\"Nucleus CMS home\">nucleuscms.org</a></b><br /> Welcome to the world of Nucleus CMS. In 2001 a set of PHP scripts were let loose on the open Internet. Those scripts, which took user-generated data and used it to dynamically create html pages, contained the ideas and the algorithms that are the core of today\\\'s Nucleus CMS. Though Nucleus CMS 3.5 is far more flexible and powerful than the scripts from which it emerged, it still expresses the values that guided its birth: flexibility, security, and computational elegance.<br /> <br /> Thanks to an international community of sophisticated developers and designers, Nucleus CMS remains simple enough for anyone to learn, and expandable enough to allow you to build almost any website you can imagine. Nucleus CMS lets you integrate text, images, and user comments in a seamless package that will make your web presence as serious, professional, personal, or fun as you want it to be. We hope you enjoy its power.<br /> <br /> <b>Documentation - <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a></b><br /> The install process places a <a href=\"nucleus/documentation/\">user</a> and a <a href=\"nucleus/documentation/devdocs/\">developer</a> documentation on your web server. Pop-up <a href=\"/nucleus/documentation/help.html\">help</a> is available throughout the administration area to assist you in maintaining and customizing your site. When in the Nucleus CMS admin area, click on this symbol <img src=\"nucleus/documentation/icon-help.gif\" width=\"15\" height=\"15\" alt=\"help icon\" /> for context-sensitive help. You can also read this documentation online under <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a>.<br /> <br /> <b>Frequently Asked Questions - <a nicetitle=\"Nucleus CMS FAQ\" href=\"http://faq.nucleuscms.org/\">faq.nucleuscms.org</a></b><br /> If you need more information about managing, extending or troubleshooting your Nucleus CMS the Nucleus FAQ is the first place to search information. Over 170 frequently asked questions are answered from experienced Nucleus users.<br /> <br /> <b>Support - <a href=\"http://forum.nucleuscms.org/\" title=\"Nucleus CMS Support Forum\">forum.nucleuscms.org</a></b><br /> Should you require assistance, please don\\\'t hesitate to <a href=\"http://forum.nucleuscms.org/faq.php\">join</a> the 6,800+ registered users on our forums. With its built-in search capability of the 73,000+ posted articles, your answers are just a few clicks away. Remember: almost any question you think of has already been asked on the forums, and almost anything you want to do with Nucleus has been tried and explained there. Be sure to check them out.<br /> <br /> <b>Demonstration - <a href=\"http://demo.nucleuscms.org/\" title=\"Nucleus CMS Demonstration\">demo.nucleuscms.org</a></b><br /> Want to play around, test changes or tell a friend or relative about Nucleus CMS? Visit our live <a href=\"http://demo.nucleuscms.org/\">demo site</a>.<br /> <br /> <b>Skins - <a href=\"http://skins.nucleuscms.org/\" title=\"Nucleus CMS Skins\">skins.nucleuscms.org</a></b><br /> The combination of multi-weblogs and skins/templates make for a powerful duo in personalizing your site or designing one for a friend, relative or business client. Import new skins to change the look of your website, or create your own skins and share them with the Nucleus community! Help designing or modifying skins is only a few clicks away in the Nucleus forums.<br /> <br /> <b>Plugins - <a href=\"http://plugins.nucleuscms.org/\" title=\"Nucleus plugins\">plugins.nucleuscms.org</a></b><br /> Looking to add some extra functionality to the base Nucleus CMS package? Our <a href=\"http://wiki.nucleuscms.org/plugin\">plugin repository</a> gives you plenty of ways to extend and expand what Nucleus CMS can do; your imagination and creativity are the only limit on how Nucleus CMS can work for you.<br /> <br /> <b>Development - <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a></b><br /> If you need more information about the Nucleus development you can find Informations in the developer documents at <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a> or in the <a href=\"http://forum.nucleuscms.org/\">Support Forum</a>. Sourceforge.net graciously hosts our <a href=\"http://sourceforge.net/projects/nucleuscms/\">Open Source project page</a> which contains our software downloads and CVS repository.<br /> <br /> <b>Donators</b><br /> We would like to thank these <a href=\"http://nucleuscms.org/donators.php\">nice people</a> for their <a href=\"http://nucleuscms.org/donate.php\">support</a>. <em>Thanks all!</em><br /> <br /> <b>Vote for Nucleus CMS</b><br /> Like Nucleus CMS? Vote for us at <a href=\"http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org\">HotScripts</a> and <a href=\"http://www.opensourcecms.com/index.php?option=content&task=view&id=145\">opensourceCMS</a>.<br /> <br /> <b>License</b><br /> When we speak of free software, we are referring to freedom, not price. Our <a href=\"http://www.gnu.org/licenses/gpl.html\">General Public Licenses</a> are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.');

?>
