<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 *
 */

define('NUCLEUS_UPGRADE_VERSION', "3.80");
define('NUCLEUS_UPGRADE_VERSION_ID', 380);

//define('UPGRADE_CHECK_PLUGIN_SYNTAX', 1); // plugin/*.php : php syntax check
//define('UPGRADE_PHP_BIN_FOR_CHECK_SYNTAX', 'pathto/php');
//define('UPGRADE_AUTOFIX_PLUGIN', 1);

$path = @preg_split('/[\?#]/', $_SERVER["REQUEST_URI"]);
$path = $path[0];
if (preg_match('#/_?upgrades$#', $path)) {
    header("Location: " . $path . "/");
    exit;
}

include('upgrade.functions.php');

load_upgrade_lang();

// check if logged in etc
if (!$member->isLoggedIn()) {
    upgrade_showLogin('../index.php');
}

if (!$member->isAdmin()) {
    upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
}

$echo = array();
$echo[] = '<h1>'  . _UPG_TEXT_UPGRADE_SCRIPTS . '</h1>';
$echo[] = _UPG_TEXT_NOTE01NEW;
$echo[] = '<p>' . _UPG_TEXT_NOTE02 . '</p>';

// calculate current version
if (!upgrade_checkinstall(250)) {
    $current = 200;
} elseif (!upgrade_checkinstall(300)) {
    $current = 250;
} elseif (!upgrade_checkinstall(310)) {
    $current = 300;
} elseif (!upgrade_checkinstall(320)) {
    $current = 310;
} elseif (!upgrade_checkinstall(330)) {
    $current = 320;
} elseif (!upgrade_checkinstall(331)) {
    $current = 330;
} elseif (!upgrade_checkinstall(340)) {
    $current = 331;
} elseif (!upgrade_checkinstall(350)) {
    $current = 340;
} elseif (!upgrade_checkinstall(360)) {
    $current = 350;
} elseif (!upgrade_checkinstall(370)) {
    $current = 360;
} elseif (!upgrade_checkinstall(371)) {
    $current = 370;
} elseif (!upgrade_checkinstall(380)) {
    $current = 371;
} else {
    $current = NUCLEUS_UPGRADE_VERSION_ID;
}

if (version_compare(phpversion(), '5.0.0', '<')) {
    $echo[] = '<p class="deprecated">' . _UPG_TEXT_WARN_DEPRECATED_PHP4_STOP .'</p>';
} elseif ($current == NUCLEUS_UPGRADE_VERSION_ID) {
    $echo[] = '<p class="ok">' . _UPG_TEXT_NO_AUTOMATIC_UPGRADES_REQUIRED . '</p>';
} else {
    $tmp_title = sprintf(_UPG_TEXT_CLICK_HERE_TO_UPGRADE, NUCLEUS_UPGRADE_VERSION);
    $echo[] = sprintf('<p class="warning"><a href="upgrade.php?from=%s" class="btn btn-warning">%s</a></p>', $current, $tmp_title);
    $echo[] = '<div class="note">';
    $echo[] = sprintf('<b>%s:</b> %s', _UPG_TEXT_NOTE50_WARNING, _UPG_TEXT_NOTE50_MAKE_BACKUP);
    $echo[] = '</div>';
}

$from = intGetVar('from');
if (!$from) {
    $from = $current;
}

if (version_compare('5.0.0', phpversion(), '<=') && $from < NUCLEUS_UPGRADE_VERSION_ID) {
    $sth = array();

    if ($from < 330) {
        $sth[] = upgrade_manual_atom1_0(); // atom feed supports 1.0 and blogsetting is added
    }
    if ($from < 340) {
        $sth[] = upgrade_manual_340();     // Need to be told of recommended .htaccess files for the media and skins folders.
    }
    if ($from < 366) {
        $sth[] = upgrade_manual_366();
    }
    
    $sth = trim(join('', $sth));
    if (!empty($sth)) {
        $echo[] = '<h1>' . _UPG_TEXT_NOTE50_MANUAL_CHANGES .'</h1>';
        $echo[] = '<p>' . _UPG_TEXT_NOTE50_MANUAL_CHANGES_01 .'</p>';
        $echo[] = $sth;
    }
}

// php syntax check
if (defined('UPGRADE_CHECK_PLUGIN_SYNTAX') && UPGRADE_CHECK_PLUGIN_SYNTAX) {
    $tmp_msg = upgrade_check_plugin_syntax();
    if ($tmp_msg) {
        $messages[] = $tmp_msg;
    }
}

upgrade_head();
echo join("\n", $echo);
upgrade_foot();

function upgrade_todo($ver)
{
    return upgrade_checkinstall($ver) ? '(<span class="ok">'. _UPG_TEXT_60_INSTALLED .'</span>)' : "(<span class='warning'>". _UPG_TEXT_60_NOT_INSTALLED ."</span>)";
}

function upgrade_manual_atom1_0()
{
    // atom 1.0
    $query = sprintf('SELECT sddesc FROM %s WHERE sdname="feeds/atom"', sql_table('skin_desc'));
    $res = sql_query($query);
    
    $echo = array();
    while ($o = sql_fetch_object($res)) {
        if ($o->sddesc=='Atom 0.3 weblog syndication') {
            $echo[] = '<h2>Atom 1.0</h2>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_01 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_02 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_03 . '</p>';
        }
    }

    // default skin
    $query = sprintf('SELECT tdnumber FROM %s WHERE tdname="default/index"', sql_table('template_desc'));
    $res = sql_query($query);
    $tdnumber = 0;
    $o = sql_fetch_object($res);
    $tdnumber = $o->tdnumber;
    if (0<$tdnumber) {
        $query = sprintf("SELECT tpartname FROM %s WHERE tdesc=%s AND tpartname='BLOGLIST_LISTITEM'", sql_table('template'), $tdnumber);
        $res = sql_query($query);
        if (!sql_fetch_object($res)) {
            $echo[] = '<h2>' . _UPG_TEXT_ATOM1_04 . '</h2>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_05 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_06 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_07 . '</p>';
        }
    }
    return !empty($echo) ? join("\n", $echo) : '';
}

function upgrade_manual_340()
{
    $row = array();
    $row[] = '<h2>' . sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS, '3.4') . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V340_01 . '</p>';
    $row[] = '<p>';
    $row[] = _UPG_TEXT_V340_02 . '：';
    $row[] = '<ul>';
    $row[] = '<li><a href="../../extra/htaccess/media/readme.ja.txt">extra/htaccess/media/readme.ja.txt</a></li>';
    $row[] = '<li><a href="../../extra/htaccess/skins/readme.ja.txt">extra/htaccess/skins/readme.ja.txt</a></li>';
    $row[] = '</ul>';
    $row[] = '</p>';
    return join("\n", $row);
}

function upgrade_manual_366()
{
    $row = array();
    $content = @file_get_contents('../../action.php');
    if (strpos($content, '=&')===false) {
        return '';
    }
    $row[] = '<h2>' . _UPG_TEXT_V366_01 . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V366_02_UPDATE_ACTION_PHP .'</p>';
    return join("\n", $row);
}
