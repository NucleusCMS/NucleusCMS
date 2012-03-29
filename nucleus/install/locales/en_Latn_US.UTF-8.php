<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id: install.php 1227 2007-12-14 16:48:40Z ehui $
 */

// header
define('_TITLE',				'Nucleus Install');
define('_BODYFONTSTYLE',		'');

// common
define('_STEP1',				'Check DB');
define('_STEP2',				'Setting Blog');
define('_STEP3',				'Finish');
define('_MODE1',				'Step by Step');
define('_MODE2',				'Detailed setting');
define('_NEXT',					'NEXT');
define('_INSTALL',				'INSTALL');

// database settings
define('_SIMPLE_NAVI1',			'At first I confirm the connection of the database. I input setting of MySQL, and please click to "next".<br />When I input detailed information and set it, please click "Detailed Setting".');
define('_DB_HEADER',			'Check Database');
define('_DB_TEXT1',				'"Detailed setting" is recommended if used to Nucleus.');
define('_DB_FIELD1',			'Hostname');
define('_DB_FIELD1_DESC',		'(It is usually localhost)');
define('_DB_FIELD2',			'Username');
define('_DB_FIELD2_DESC',		'(alphabet, number, _, -)');
define('_DB_FIELD3',			'Password');
define('_DB_FIELD4',			'Database');
define('_DB_FIELD4_DESC',		'(alphabet, number, _, -)');
define('_DB_FIELD5',			'Table Prefix');
define('_DB_FIELD5_DESC',		'Don\'t usually set this.');

// blog settings
define('_SIMPLE_NAVI2',			'I was able to confirm the connection of the database.<br />Setting Blog and Information of the ADMIN, and please click to "NEXT".');
define('_BLOG_HEADER',			'Weblog Data');
define('_BLOG_FIELD1',			'Blog Name');
define('_BLOG_FIELD2',			'Blog Short Name');
define('_BLOG_FIELD2_DESC',		'(alphabet, number)');

// admin settings
define('_ADMIN_HEADER',			'Administrator User');
define('_ADMIN_FIELD1',			'Manager Name');
define('_ADMIN_FIELD2',			'Login ID');
define('_ADMIN_FIELD2_DESC',	'(alphabet, number)');
define('_ADMIN_FIELD3',			'Password');
define('_ADMIN_FIELD4',			'Password Again');
define('_ADMIN_FIELD5',			'E-mail Address');

// url/path settings
define('_PATH_FIELD1',			'Site URL');
define('_PATH_FIELD2',			'Admin-area URL');
define('_PATH_FIELD3',			'Admin-area path');
define('_PATH_FIELD4',			'Media files URL');
define('_PATH_FIELD5',			'Media dir path');
define('_PATH_FIELD6',			'Skin files URL');
define('_PATH_FIELD7',			'Skin files dir path');
define('_PATH_FIELD8',			'Plugin files URL');
define('_PATH_FIELD9',			'Action URL');

// detail
define('_DETAIL_NAVI1',			'All fields are mandatory. Optional information can be set from the Nucleus admin-area when installation is completed.');
define('_DETAIL_HEADER1',		'MySQL Login Data');
define('_DETAIL_TEXT1',			'Enter your MySQL data below. This install script needs it to be able to create and fill your database tables.');
define('_DETAIL_HEADER2',		'Directories and URLs');
define('_DETAIL_TEXT2',			'This install script has attempted to find out the directories and URLs in which Nucleus is installed. Please check the values below and correct if necessary. The URLs and file paths should end with a slash.');
define('_DETAIL_TEXT3',			'Note: Use absolute paths instead of relative paths.');
define('_DETAIL_HEADER3',		'Administrator User');
define('_DETAIL_TEXT4',			'You need to enter some information to create the first user of your site.');
define('_DETAIL_HEADER4',		'Weblog Data');
define('_DETAIL_TEXT5',			'Below, you need to enter some information to create a default weblog. The name of this weblog will also be used as name for your site.');
define('_DETAIL_TEXT6',			'Verify the data above, and click the button below to set up your database tables and initial data. This can take a while, so have patience. ONLY CLICK THE BUTTON ONCE !');

// install complete
define('_INST_TEXT',			'Congratulations. The installation was completed!');
define('_INST_HEADER1',			'New Blog');
define('_INST_TEXT1',			'Let\'s take a look at once you have created [%s].');
define('_INST_BUTTON1',			'New Blog');
define('_INST_HEADER2',			'Management page');
define('_INST_TEXT2',			'A design change, user addition, the category setting to the management page.');
define('_INST_BUTTON2',			'Management Page');
define('_INST_HEADER3',			'Addition of the Blog');
define('_INST_TEXT3',			'If necessary, you can even add a blog.');
define('_INST_BUTTON3',			'Add Blog');
define('_INST_TEXT4',			'Was unable to write to the <i>config.php</i>. Please replace with the following contents.');
define('_INST_TEXT5',			'Please make sure the <i>config.php</i> permissions if it were a <span style="font-weight:bold;">444</span>. If different, please change the "444".');

// errors
define('_DBCONNECT_ERROR',		'Could not connect to MySQL Server.');
define('_DBVERSION_UNKOWN',		'Indeterminable');
define('_DBVERSION_TOOLOW',		'You must have MySQL version %s or more at least in the Nucleus.');

define('_VALID_ERROR',			'There is an error in your input. Please re-look at the input value to see the error message for each section.');
define('_VALID_ERROR1',			'"%s" has not been entered.');
define('_VALID_ERROR2',			'"%s" character that can be used are A-Z, a-z ,0-9, _ and -.');
define('_VALID_ERROR3',			'"%s" character that can be used are A-Z, a-z ,0-9 and _.');
define('_VALID_ERROR4',			'It contains characters that can not be used to "Blog Short Name". (Characters that can be used: A-Z, a-z and 0-9, blank can not be used)');
define('_VALID_ERROR5',			'Contains characters that can not be used in "Login ID". (A-Z, a-z, 0-9 and the first and last non-blank characters that can be used)');
define('_VALID_ERROR6',			'Passwords entered do not match.');
define('_VALID_ERROR7',			'"E-mail address" is incorrect.');
define('_VALID_ERROR8',			'Does not end with a forward slash "/" is "%s".');
define('_VALID_ERROR9',			'Does not end with "action.php" the URL of the "%s".');
define('_VALID_ERROR10',		'Does not end with a forward slash "/" directory path of "%s".');
define('_VALID_ERROR11',		'Directory path in the "%s" does not exist on the server.');

define('_INST_ERROR',			'Failed to install. Please run the installation script again to fix the cause of the following.');
define('_INST_ERROR1',			'Could not create the database. Please make sure that there is a permission to create.');
define('_INST_ERROR2',			'Could not find the database. Please make sure that the database exists.');
define('_INST_ERROR3',			'Database table was trying to create already exists.');
define('_INST_ERROR4',			'An error occurred execution of the query');
define('_INST_ERROR5',			'An error occurred during the execution of the "Configuring Members"');
define('_INST_ERROR6',			'An error occurred during the execution of the "Blog Settings"');
define('_INST_ERROR7',			'An error occurred during the execution of the "Setting item"');
define('_INST_ERROR8',			'can not write to the config.php. Once you have the permissions to <span style="font-weight:bold;">666</span> of config.php, the script will automatically write the configuration information. (<a href="../nucleus/documentation/tips.html#filepermissions">Quick Guide to change permissions</a>)');
define('_INST_ERROR9',			'Could not install the plug-in "%s".');
define('_INST_ERROR10',			'File "%s" can not be found.');
define('_INST_ERROR11',			'Theme file "%s" could not be read.');
define('_INST_ERROR12',			'Could not import the theme "%s".');


// General category
define('_GENERALCAT_NAME',		'General');
define('_GENERALCAT_DESC',		'Items that do not fit in other categories');
define('_1ST_POST_TITLE',		'Welcome to Nucleus CMS v4.0');
define('_1ST_POST',				'This is the first post on your Nucleus CMS. Nucleus offers you the building blocks you need to create a web presence. Whether you want to
create a personal blog, a family page, or an online business site, Nucleus CMS can help you achieve your goals.<br /> <br /> We\\\'ve loaded this first entry with links and information to get you started. Though you can delete this entry, it will eventually scroll off the main page as you add content to your site. Add your comments while you learn to work with Nucleus CMS, or bookmark this page so you can come back to it when you need to.');
define('_1ST_POST2',			'<b>Home - <a href="http://nucleuscms.org/" title="Nucleus CMS home">nucleuscms.org</a></b><br /> Welcome to the world of Nucleus CMS. In 2001 a set of PHP scripts were let loose on the open Internet. Those scripts, which took user-generated data and used it to dynamically create html pages, contained the ideas and the algorithms that are the core of today\\\'s Nucleus CMS. Though Nucleus CMS 3.5 is far more flexible and powerful than the scripts from which it emerged, it still expresses the values that guided its birth: flexibility, security, and computational elegance.<br /> <br /> Thanks to an international community of sophisticated developers and designers, Nucleus CMS remains simple enough for anyone to learn, and expandable enough to allow you to build almost any website you can imagine. Nucleus CMS lets you integrate text, images, and user comments in a seamless package that will make your web presence as serious, professional, personal, or fun as you want it to be. We hope you enjoy its power.<br /> <br /> <b>Documentation - <a href="http://docs.nucleuscms.org/" title="Nucleus CMS Documentation">docs.nucleuscms.org</a></b><br /> The install process places a <a href="nucleus/documentation/">user</a> and a <a href="nucleus/documentation/devdocs/">developer</a> documentation on your web server. Pop-up <a href="/nucleus/documentation/help.html">help</a> is available throughout the administration area to assist you in maintaining and customizing your site. When in the Nucleus CMS admin area, click on this symbol <img src="nucleus/documentation/icon-help.gif" width="15" height="15" alt="help icon" /> for context-sensitive help. You can also read this documentation online under <a href="http://docs.nucleuscms.org/" title="Nucleus CMS Documentation">docs.nucleuscms.org</a>.<br /> <br /> <b>Frequently Asked Questions - <a nicetitle="Nucleus CMS FAQ" href="http://faq.nucleuscms.org/">faq.nucleuscms.org</a></b><br /> If you need more information about managing, extending or troubleshooting your Nucleus CMS the Nucleus FAQ is the first place to search information. Over 170 frequently asked questions are answered from experienced Nucleus users.<br /> <br /> <b>Support - <a href="http://forum.nucleuscms.org/" title="Nucleus CMS Support Forum">forum.nucleuscms.org</a></b><br /> Should you require assistance, please don\\\'t hesitate to <a href="http://forum.nucleuscms.org/faq.php">join</a> the 6,800+ registered users on our forums. With its built-in search capability of the 73,000+ posted articles, your answers are just a few clicks away. Remember: almost any question you think of has already been asked on the forums, and almost anything you want to do with Nucleus has been tried and explained there. Be sure to check them out.<br /> <br /> <b>Demonstration - <a href="http://demo.nucleuscms.org/" title="Nucleus CMS Demonstration">demo.nucleuscms.org</a></b><br /> Want to play around, test changes or tell a friend or relative about Nucleus CMS? Visit our live <a href="http://demo.nucleuscms.org/">demo site</a>.<br /> <br /> <b>Skins - <a href="http://skins.nucleuscms.org/" title="Nucleus CMS Skins">skins.nucleuscms.org</a></b><br /> The combination of multi-weblogs and skins/templates make for a powerful duo in personalizing your site or designing one for a friend, relative or business client. Import new skins to change the look of your website, or create your own skins and share them with the Nucleus community! Help designing or modifying skins is only a few clicks away in the Nucleus forums.<br /> <br /> <b>Plugins - <a href="http://plugins.nucleuscms.org/" title="Nucleus plugins">plugins.nucleuscms.org</a></b><br /> Looking to add some extra functionality to the base Nucleus CMS package? Our <a href="http://wiki.nucleuscms.org/plugin">plugin repository</a> gives you plenty of ways to extend and expand what Nucleus CMS can do; your imagination and creativity are the only limit on how Nucleus CMS can work for you.<br /> <br /> <b>Development - <a href="http://dev.nucleuscms.org/" title="Nucleus Development">dev.nucleuscms.org</a></b><br /> If you need more information about the Nucleus development you can find Informations in the developer documents at <a href="http://dev.nucleuscms.org/" title="Nucleus Development">dev.nucleuscms.org</a> or in the <a href="http://forum.nucleuscms.org/">Support Forum</a>. Sourceforge.net graciously hosts our <a href="http://sourceforge.net/projects/nucleuscms/">Open Source project page</a> which contains our software downloads and CVS repository.<br /> <br /> <b>Donators</b><br /> We would like to thank these <a href="http://nucleuscms.org/donators.php">nice people</a> for their <a href="http://nucleuscms.org/donate.php">support</a>. <em>Thanks all!</em><br /> <br /> <b>Vote for Nucleus CMS</b><br /> Like Nucleus CMS? Vote for us at <a href="http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org">HotScripts</a> and <a href="http://www.opensourcecms.com/index.php?option=content&task=view&id=145">opensourceCMS</a>.<br /> <br /> <b>License</b><br /> When we speak of free software, we are referring to freedom, not price. Our <a href="http://www.gnu.org/licenses/gpl.html">General Public Licenses</a> are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.');
