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

global $CONF;

include_once('define.php');

if (!is_file('../config.php')) {
    exit('config not found');
}

include_once('../config.php');
include_once('upgrade.functions.php');
include_once('sql.functions.php');

load_upgrade_lang();

if(getVar('mode')==='exec') {
    include_once('upgrade.php');
    exit;
}

// check if logged in etc
if (!$member->isLoggedIn()) {
    $content = upgrade_showLogin('./');
}
elseif (!$member->isAdmin()) {
    $content = upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
}
elseif (!upgrade_checkinstall(300)) {
    $tpl = file_get_contents('tpl/content_beforev2.tpl');
    $ph = array();
    $ph['UPGRADE_ABORTED'] = _UPG_TEXT_UPGRADE_ABORTED;
    $ph['WARN_OLD_UNSUPPORT_CORE_STOP'] = _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP;
    $ph['WARN_OLD_UNSUPPORT_CORE_STOP_INFO'] = _UPG_TEXT_WARN_OLD_UNSUPPORT_CORE_STOP_INFO;
    $content = upgrade_error(parseHtml($tpl,$ph));
}
else {
    $ph = array();
    $ph['UPGRADE_SCRIPTS'] = _UPG_TEXT_UPGRADE_SCRIPTS;
    $ph['NOTE01NEW']       = _UPG_TEXT_NOTE01NEW;
    $ph['NOTE02']          = _UPG_TEXT_NOTE02;
    $ph['AdminURL']        = $CONF['AdminURL'];
    $ph['BACKHOME']        = _UPG_TEXT_BACKHOME;
    $tpl = file_get_contents('tpl/content_default.tpl');
    $content = parseHtml(parseHtml($tpl,$ph), array('content'=>get_default_content()));
}

echo renderPage($content);
exit;
