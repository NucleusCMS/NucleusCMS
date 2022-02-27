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
 * Media popup window for Nucleus
 *
 * Purpose:
 *   - can be openen from an add-item form or bookmarklet popup
 *   - shows a list of recent files, allowing browsing, search and
 *     upload of new files
 *   - close the popup by selecting a file in the list. The file gets
 *     passed through to the add-item form (linkto, popupimg or inline img)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 *
 */
global $manager, $member;
include_once 'libs/media.functions.inc.php';

$CONF = array();

// defines how much media items will be shown per page. You can override this
// in config.php if you like. (changing it in config.php instead of here will
// allow your settings to be kept even after a Nucleus upgrade)
$CONF['MediaPerPage'] = 10;

// include all classes and config data
$DIR_LIBS = '';
require_once('../config.php');
//include($DIR_LIBS . 'MEDIA.php');    // media classes
include_libs('MEDIA.php',false,false);

//sendContentType('application/xhtml+xml', 'media');

// user needs to be logged in to use this
if (!$member->isLoggedIn()) {
    media_loginAndPassThrough();
    exit;
}

// check if member is on at least one teamlist
$query = 'SELECT count(*) as result FROM ' . sql_table('team'). ' WHERE tmember=' . $member->getID();
$is_belong_team = ((int)quickQuery($query) > 0);
if (!$is_belong_team && !$member->isAdmin()) {
    media_doError(_ERROR_DISALLOWEDUPLOAD);
}

// get action
$action = requestVar('action');
if ($action == '') {
    $action = 'selectmedia';
}

// check ticket
if (!in_array($action, ['selectmedia', _MEDIA_FILTER_APPLY, _MEDIA_COLLECTION_SELECT])) {
    if (!$manager->checkTicket()) {
        media_doError(_ERROR_BADTICKET);
    }
}

switch($action) {
    case 'chooseupload':
    case _MEDIA_UPLOAD_TO:
    case _MEDIA_UPLOAD_NEW:
        if (!$member->isAdmin() && $CONF['AllowUpload'] != true) {
            media_doError(_ERROR_DISALLOWED);
        } else {
            media_choose();
        }
        break;
    case 'uploadfile':
        if (!$member->isAdmin() && $CONF['AllowUpload'] != true) {
            media_doError(_ERROR_DISALLOWED);
        } else {
            media_upload();
        }
        break;
    case _MEDIA_FILTER_APPLY:
    case 'selectmedia':
    case _MEDIA_COLLECTION_SELECT:
    default:
        media_select();
        break;
}
