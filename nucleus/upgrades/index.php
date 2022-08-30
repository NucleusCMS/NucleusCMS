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

if (version_compare('8.0.0', phpversion(), '<=')) {
    exit('<h1>Error</h1><div>This version does not support PHP 8.0 or later.</div>
        <div>Nucleus CMS version 3.80 or later is required to work with PHP8.0 or later.</div>');
}

define('NUCLEUS_UPGRADE_VERSION_ID', 371);

include('upgrade.functions.php');

load_upgrade_lang();

// check if logged in etc
if (!$member->isLoggedIn()) {
    upgrade_showLogin('index.php');
}

if (!$member->isAdmin()) {
    upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
}

$echo   = array();
$echo[] = '<h1>'  . _UPG_TEXT_UPGRADE_SCRIPTS . '</h1>';
$echo[] = '<div class="note"><b>Note:</b> ';
$echo[] = _UPG_TEXT_NOTE01NEW;
$echo[] = '<p>' . _UPG_TEXT_NOTE02 . '</p>';
$echo[] = '</div>';

// calculate current version
if (!upgrade_checkinstall(96)) {
    $current = 95;
} elseif (!upgrade_checkinstall(100)) {
    $current = 96;
} elseif (!upgrade_checkinstall(110)) {
    $current = 100;
} elseif (!upgrade_checkinstall(150)) {
    $current = 110;
} elseif (!upgrade_checkinstall(200)) {
    $current = 150;
} elseif (!upgrade_checkinstall(250)) {
    $current = 200;
} elseif (!upgrade_checkinstall(300)) {
    $current = 250;
} elseif (!upgrade_checkinstall(310)) {
    $current = 300;
} elseif (!upgrade_checkinstall(320)) {
    $current = 310;
} elseif (!upgrade_checkinstall(330)) {
    $current = 320;
} elseif (!upgrade_checkinstall(340)) {
    $current = 330;
} elseif (!upgrade_checkinstall(350)) {
    $current = 340;
} elseif (!upgrade_checkinstall(360)) {
    $current = 350;
} elseif (!upgrade_checkinstall(370)) {
    $current = 360;
} elseif (!upgrade_checkinstall(371)) {
    $current = 370;
} else {
    $current = 371;
}

if (version_compare(phpversion(), '5.0.0', '<')) {
    $echo[] = '<p class="deprecated">' . _UPG_TEXT_WARN_DEPRECATED_PHP4_STOP .'</p>';
}
//elseif ($current > NUCLEUS_UPGRADE_VERSION_ID) {
//    exit('your core is old.'); // error
//}
elseif ($current == NUCLEUS_UPGRADE_VERSION_ID) {
    $echo[] = '<p class="ok">' . _UPG_TEXT_NO_AUTOMATIC_UPGRADES_REQUIRED . '</p>';
} else {
    $echo[] = sprintf('<p class="warning"><a href="upgrade.php?from=%s&db_optimize=1">%s</a></p>', $current, _UPG_TEXT_CLICK_HERE_TO_UPGRADE);
    $echo[] = '<div class="note">';
    $echo[] = sprintf('<b>%s:</b> %s', _UPG_TEXT_NOTE50_WARNING, _UPG_TEXT_NOTE50_MAKE_BACKUP);
    $echo[] = '</div>';
}

$from = intGetVar('from');
if (!$from) {
    $from = $current;
}

if ($from < NUCLEUS_UPGRADE_VERSION_ID) {
    $sth = array();
//    if (!$DIR_MEDIA) $sth[] = upgrade_manual_96();
//    if (!$DIR_SKINS) $sth[] = upgrade_manual_200();

    if ($from < 330) {
        $sth[] = upgrade_manual_atom1_0();
    } // atom feed supports 1.0 and blogsetting is added
    if ($from < 340) {
        $sth[] = upgrade_manual_340();
    }     // Need to be told of recommended .htaccess files for the media and skins folders.
    if ($from < 350) {
        $sth[] = upgrade_manual_350();
    }
    if ($from < 366) {
        $sth[] = upgrade_manual_366();
    }

    $echo[] = '<h1>' . _UPG_TEXT_NOTE50_MANUAL_CHANGES .'</h1>';
    $sth    = trim(implode('', $sth));
    if (!empty($sth)) {
        $echo[] = '<p>' . _UPG_TEXT_NOTE50_MANUAL_CHANGES_01 .'</p>';
        $echo[] = $sth;
    } else {
        $echo[] = '<p>' . _UPG_TEXT_NO_MANUAL_CHANGES_LUCKY_DAY .'</p>';
    }
}
$echo[] = sprintf("<p><a href=\"%s\">%s</a></p>", $CONF['AdminURL'], _UPG_TEXT_BACKHOME);

upgrade_head();
echo implode("\n", $echo);
upgrade_foot();

function upgrade_todo($ver)
{
    return upgrade_checkinstall($ver) ? '(<span class="ok">'. _UPG_TEXT_60_INSTALLED .'</span>)' : "(<span class='warning'>". _UPG_TEXT_60_NOT_INSTALLED ."</span>)";
}

function upgrade_manual_atom1_0()
{
    // atom 1.0
    $query = sprintf('SELECT sddesc FROM %s WHERE sdname="feeds/atom"', sql_table('skin_desc'));
    $res   = sql_query($query);

    $echo = array();
    while ($o = sql_fetch_object($res)) {
        if ($o->sddesc == 'Atom 0.3 weblog syndication') {
            $echo[] = '<h2>Atom 1.0</h2>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_01 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_02 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_03 . '</p>';
        }
    }

    // default skin
    $query    = sprintf('SELECT tdnumber FROM %s WHERE tdname="default/index"', sql_table('template_desc'));
    $res      = sql_query($query);
    $tdnumber = 0;
    $o        = sql_fetch_object($res);
    $tdnumber = $o->tdnumber;
    if (0 < $tdnumber) {
        $query = sprintf("SELECT tpartname FROM %s WHERE tdesc=%s AND tpartname='BLOGLIST_LISTITEM'", sql_table('template'), $tdnumber);
        $res   = sql_query($query);
        if (!sql_fetch_object($res)) {
            $echo[] = '<h2>' . _UPG_TEXT_ATOM1_04 . '</h2>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_05 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_06 . '</p>';
            $echo[] = '<p>' . _UPG_TEXT_ATOM1_07 . '</p>';
        }
    }
    return !empty($echo) ? implode("\n", $echo) : '';
}

function upgrade_manual_96()
{
    global $DIR_NUCLEUS;

    $guess = hsc(str_replace("/nucleus/", "/media/", $DIR_NUCLEUS));

    $s = <<<EOL
  <h2>Changes needed for Nucleus 0.96</h2>
  <p>
    A manual addition needs to be made to <i>config.php</i>, in order to get the media functions to work. Here's what to add:
  </p>
  <pre>
  // path to media dir
  \$DIR_MEDIA = '<b>{$guess}</b>';
  </pre>

  <p>
  Also, it will be necessary to create that directory yourself. If you want to make file upload possible, you should set the permissions of the media/ directory to 777 (see the documentation/tips.html in Nucleus 0.96+ for a quick guide on setting permissions).
  </p>
EOL;
    return $s;
}

function upgrade_manual_200()
{
    global $DIR_NUCLEUS;

    $guess = hsc(str_replace("/nucleus/", "/skins/", $DIR_NUCLEUS));

    $s = <<<EOL
  <h2>Changes needed for Nucleus 2.0</h2>
  <p>
    A manual addition needs to be made to <i>config.php</i>, in order to get imported skins to work correctly. Here's what to add:
  </p>
  <pre>
  // extra skin files for imported skins
  \$DIR_SKINS = '<b>{$guess}</b>';
  </pre>

  <p>Also, it will be necessary to create this directory yourself. Downloaded skins can then be expanded into that directory and be imported from inside the Nucleus admin area.</p>

  <h3>RSS 2.0 and RSD skin</h3>

  <p>When a fresh version of Nucleus 2.0 is installed, an RSS 2.0 (Really Simple Syndication) syndication skin is also installed, as well as an RSD skin (Really Simple Discovery). The files <code>xml-rss2.php</code> and <code>rsd.php</code> are available in the upgrade, however the skin itself needs to be installed manually. After you've uploaded the contents of the <code>upgrade-files</code>, open <code>admin area &gt; nucleus management &gt; skin import</code>. From there, you can install both skins. (Unless you don't want them installed, that is)</p>
EOL;
    return $s;
}

function upgrade_manual_340()
{
    $row   = array();
    $row[] = '<h2>' . sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS, '3.4') . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V340_01 . '</p>';
    $row[] = '<p>';
    $row[] = _UPG_TEXT_V340_02 . ':';
    $row[] = '<ul>';
    $row[] = '<li><a href="../../extra/media/readme.txt">extra/media/readme.txt</a></li>';
    $row[] = '<li><a href="../../extra/skins/readme.txt">extra/skins/readme.txt</a></li>';
    $row[] = '</ul>';
    $row[] = '</p>';
    return implode("\n", $row);
}

function upgrade_manual_350()
{
    $s = <<<EOL
  <h2>Important Notices for Nucleus 3.5</h2>
  <p>
    Two new plugins have been included with version 3.5. You may want to consider installing them from the Plugins page of the admin area.
    <ul>
       <li><strong>NP_SecurityEnforcer</strong>: Enforces some security properties like password complexity and maximum failed login attempts. Note that it is disabled by default and must be enabled after installation.</li>
    </ul>
  </p>
EOL;
    return $s;
}

function upgrade_manual_366()
{
    $row     = array();
    $content = @file_get_contents('../../action.php');
    if (!str_contains($content, '=&')) {
        return '';
    }
    $row[] = '<h2>' . _UPG_TEXT_V366_01 . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V366_02_UPDATE_ACTION_PHP .'</p>';
    return implode("\n", $row);
}
