<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS
 * Copyright (C) 2003-2015 The Nucleus Group　Japan (http://japan.nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group  (http://nucleuscms.org/)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

try_define('_UPG_TEXT_BACKHOME',  'Back to Nucleus management');

try_define('_UPG_TEXT_UPGRADE_ABORTED',  'Aborted upgrade.');
try_define('_UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP',      'It does not support upgrading from older than version 3 core.');
try_define('_UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP_INFO', 'Please try again to upgrade to version 3.71 or earlier.');
try_define('_UPG_TEXT_WARN_PLUGIN_SYNTAX_ERROR', 'Error was detected in the PHP file of the plugin folder.');

try_define('_UPG_TEXT_ALREADY_INSTALLED', 'already installed');
try_define('_UPG_TEXT_V035_WARN_PING',      'Note: There are new changes to NP_Ping in v3.50. If it is already installed, please go to Admin Panel uninstall and re-install the plugin');
try_define('_UPG_TEXT_NOTE_PING01',          'Note: The weblogs.com ping function is improved and moved into a plugin. To activate this function in v3.3, please go to plugin menu and install NP_Ping plugin. Also, NP_Ping is replacing NP_PingPong. If you have NP_PingPing installed, please also remove it.');

try_define('_UPG_TEXT_ONLY_SUPER_ADMIN',   'Only Super-Admins are allowed to perform upgrades');
try_define('_UPG_TEXT_ERROR_NO_UPDATES_TO_EXECUTE',    'Error! No updates to execute');
try_define('_UPG_TEXT_UPGRADE_COMPLETED', 'Upgrade Completed');

try_define('_UPG_TEXT_PLEASE_LOGIN',      'Please Log in First');
try_define('_UPG_TEXT_ENTER_YOUR_DATA',      'Enter your data below');
try_define('_UPG_TEXT_NAME',              'Name');
try_define('_UPG_TEXT_PASSWORD',          'Password');
try_define('_UPG_TEXT_LOGIN',              'Log in');

try_define('_UPG_TEXT_NUCLEUS_UPGRADE',      'Nucleus Upgrade');
try_define('_UPG_TEXT_ERROR_FAILED',      'FAILED');
try_define('_UPG_TEXT_ERROR_WAS',          'Error was');
try_define('_UPG_TEXT_BACK',              'Back');

try_define('_UPG_TEXT_EXECUTING_UPGRADES', 'Executing Upgrades');
try_define('_UPG_TEXT_QUERIES_HAVE_FAILED_01',     'Some queries have failed. Try reverting to a backup or reparing things manually, then rerun this script.');
try_define('_UPG_TEXT_UPGRADE_COMPLETED_TITLE',    'Upgrade Completed!');
try_define('_UPG_TEXT_BACK_TO_OVERVIEW',  'Back to the <a href="%s">Upgrades Overview</a>');

try_define('_UPG_TEXT_FAILURE',             'FAILED');
try_define('_UPG_TEXT_REASON_FOR_FAILURE',  'Error was');
try_define('_UPG_TEXT_SUCCESS',                'SUCCESS!');


try_define('_UPG_TEXT_UPGRADE_SCRIPTS',             'Upgrade Scripts');
try_define('_UPG_TEXT_NOTE01NEW',         "If you aren't upgrading from an old Nucleus version (you installed Nucleus from scratch), you won't need these files.");
try_define('_UPG_TEXT_NOTE02',             'When upgrading from an older Nucleus version, upgrades to the database tables are required. This upgrade script allows you to automate these changes.');


try_define('_UPG_TEXT_NO_AUTOMATIC_UPGRADES_REQUIRED', 'No automatic upgrades required! The database tables have already been updated to the latest version of Nucleus.');
try_define('_UPG_TEXT_WARN_DEPRECATED_PHP4_STOP',    'Nucleus does not work with PHP4. It aborts the upgrade work, and whether we can use the PHP5 or more, check with your server administrator.');
try_define('_UPG_TEXT_WARN_MINIMUM_PHP_STOP',        'Nucleus %s minimum requirement is PHP %s. It aborts the upgrade work, and whether we can use the PHP %s or more, check with your server administrator.');

try_define('_UPG_TEXT_CLICK_HERE_TO_UPGRADE',        'Click here to upgrade the database to Nucleus v%s');

try_define('_UPG_TEXT_NOTE50_WARNING',        'Note');
try_define('_UPG_TEXT_NOTE50_MAKE_BACKUP',    "Don't forget to make a backup of your database every once in a while!<br/>\n It is suggested that you do so before upgrading the database in case things go wrong.");
try_define('_UPG_TEXT_NOTE50_MANUAL_CHANGES', 'Manual changes');
try_define('_UPG_TEXT_NOTE50_MANUAL_CHANGES_01',    'Some changes need to be done manually. Instructions are given below (if any)');
try_define('_UPG_TEXT_NO_MANUAL_CHANGES_LUCKY_DAY',    'No manual changes needed. This must be your lucky day!');

try_define('_UPG_TEXT_60_INSTALLED',            'installed');
try_define('_UPG_TEXT_60_NOT_INSTALLED',        'not yet installed');

try_define('_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS',     'Changes needed for Nucleus %s');

/*******************/

try_define('_UPG_TEXT_V340_01',        "It is recommended that you apply some restrictions to what you allow the web server to do with files in the <i>media</i> and <i>skins</i> folders. These restrictions are not necessary to the functioning of the software, nor to the security of the software. However, they can be an important help under the security principle of denying any access that is not required.");
try_define('_UPG_TEXT_V340_02',        "Instructions for applying the restrictions are found in the following two files on your server");

try_define('_UPG_TEXT_V366_01',                        'Necessary changes to the latest version of the PHP environment');
try_define('_UPG_TEXT_V366_02_UPDATE_ACTION_PHP',    'Please update the action.php');

try_define('_UPG_TEXT_ATOM1_01', 'Since the atom feed is now 1.0 correspondence from Nucleus 3.3, please upgrade of skin template in the next procedure.');
try_define('_UPG_TEXT_ATOM1_02', 'Open the administrator screen, to open the "Import/Export" of skin in the management home. Select the atom from there, please overwrite installation by pressing the read button.');
try_define('_UPG_TEXT_ATOM1_03', 'If you have changed the atom of skins and templates, export the existing contents to a file (which is file is created that skinbackup.xml), /skins/atom/skinbackup.xml is compared (this is a new file) and , we will update this new file. Then, please overwrite installation in the same way as described above from the administrator screen to open the "Import/Export" of skin.');
try_define('_UPG_TEXT_ATOM1_04', 'Default Skin');
try_define('_UPG_TEXT_ATOM1_05', 'Nucleus 3.3 has become a CSS change of some form from the (release May 1, 2007). For example, the login form and the first page, such as a form for comments. For this reason since the display of the form is lost, please upgrade of Default skin in the next procedure.');
try_define('_UPG_TEXT_ATOM1_06', 'Open the administrator screen, to open the "Import/Export" of skin in the management home. Select the default from there, please overwrite installation by pressing the read button.');
try_define('_UPG_TEXT_ATOM1_07', 'If you have changed the default skins and templates, export the existing contents to a file (which is file is created that skinbackup.xml), /skins/default/skinbackup.xml is compared (this is a new file) and , we will update this new file. Then, please overwrite installation in the same way as described above from the administrator screen to open the "Import/Export" of skin.');

