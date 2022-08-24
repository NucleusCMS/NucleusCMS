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
 *	This file contains definitions for the methods of the metaWeblog API
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

// prevent direct access
if (! isset($member)) {
    exit;
}

/**
 * Name:validateIso8601 --- Validate $date as ISO 8601 format.
 *                          datetime patterns of ISO 8601 standard
 *                          basic datetime without utc symbol, time zone offset : YYYYmmdd\THHiiss
 *                          extended datetime without utc symbol, time zone offset : YYYY-mm-dd\THH:ii:ss
 *                          mixed datetime without utc symbol, time zone offset : YYYYmmdd\THH:ii:ss
 *                          basic datetime with UTC : YYYYmmdd\THHiiss'\Z'
 *                          extended datetime with UTC : YYYY-mm-dd\THH:ii:ss'\Z'
 *                          mixed datetime with UTC : YYYYmmdd\THH:ii:ss'\Z'
 *                          basic datetime with time zone offset : YYYYmmdd\THHiiss+0000
 *                          extended datetime with time zone offset : YYYY-mm-dd\THH:ii:ss+00:00
 *                          mixed datetime with time zone offset : YYYY-mm-dd\THH:ii:ss+00:00
 *
 * @param string $date : target string for ISO 8601 validation.
 *
 * @return boolean|string
 *                        success : 'basic'|'extended'|'mixed'|'basic utc'|'extended utc'|'mixed utc'|'basic tz'|'extended tz'
 *                        fail : false
 */
function validateIso8601($date)
{
    $r = false;
    if (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4])[0-5][0-9][0-5][0-9]'
            . '$/',
        $date,
        $matches
    ) === 1) {
        // Basic style datetime without utc symbol, time zone offset
        $r = 'basic';
    } elseif (preg_match(
        '/^(\d{1,4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . '$/',
        $date,
        $matches
    ) === 1) {
        // Extended style datetime without utc symbol, time zone offset
        $r = 'extended';
    } elseif (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . '$/',
        $date,
        $matches
    ) === 1) {
        // Mixed style datetime without utc symbol, time zone offset
        //(it violates ISO 8601 standard but Windows Live Writer sends createdDate with this style.)
        $r = 'mixed';
    } elseif (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4])[0-5][0-9][0-5][0-9]'
            . 'Z$/',
        $date,
        $matches
    ) === 1) {
        // Basic style datetime with utc symbol
        $r = 'basic utc';
    } elseif (preg_match(
        '/^(\d{1,4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . 'Z$/',
        $date,
        $matches
    ) === 1) {
        // Extended style datetime with utc symbol
        $r = 'extended utc';
    } elseif (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . 'Z$/',
        $date,
        $matches
    ) === 1) {
        // Extended style datetime with utc symbol
        $r = 'mixed utc';
    } elseif (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4])[0-5][0-9][0-5][0-9]'
            . '((\+|-)([01][0-9]|2[0-4])([0-5][0-9])?)$/',
        $date,
        $matches
    ) === 1) {
        // Basic style datetime with time zone offset
        $r = 'basic tz';
    } elseif (preg_match(
        '/^(\d{1,4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . '((\+|-)([01][0-9]|2[0-4]):?([0-5][0-9])?)$/',
        $date,
        $matches
    ) === 1) {
        // Extended style datetime with time zone offset
        $r = 'extended tz';
    } elseif (preg_match(
        '/^(\d{1,4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])'
            . 'T'
            . '([0-1][0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9]'
            . '((\+|-)([01][0-9]|2[0-4]):?([0-5][0-9])?)$/',
        $date,
        $matches
    ) === 1) {
        // Mixed style datetime with extended style time zone offset
        //(it violates ISO 8601 standard but Windows Live Writer sends createdDate with this style.)
        $r = 'mixed tz';
    }
    //check if $matches has valid date & time.
    if ($r == false) {
        return false;
    }
    return checkdate($matches[2], $matches[3], $matches[1]) ? $r : false;
}

// metaWeblog.newPost
$f_metaWeblog_newPost_sig = array(
    array(
        // return type
        $xmlrpcString,    // itemid of the new item

        // params:
        $xmlrpcString,    // blogid
        $xmlrpcString,    // username
        $xmlrpcString,    // password
        $xmlrpcStruct,    // content
        $xmlrpcBoolean,    // publish boolean (set to false to create draft)

    )
);
$f_metaWeblog_newPost_doc = "Adds a new item to the given blog. Adds it as a draft when publish is false";
function f_metaWeblog_newPost($m)
{
    global $manager;

    $blogid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);
    $struct   = $m->getParam(3);

    $content = _getStructVal($struct, 'description');
    $more    = _getStructVal($struct, 'mt_text_more');
    $title   = _getStructVal($struct, 'title');

    // category is optional (thus: be careful)!
    $catlist = $struct->structmem('categories');
    if ($catlist && ($catlist->kindOf() == "array") && ($catlist->arraysize() > 0)) {
        $category = _getArrayVal($catlist, 0);
    }

    //  mt_allow_comments is optional (thus: be careful)!
    $closed = 0;
    if ($struct->structmem('mt_allow_comments')) {
        // mt_allow_comments takes these values
        // 0 : none ( no comments are allowed. )
        // 1 : open ( comments are allowed. )
        // 2 : closed ( comment allowed time has passed. )
        // So $closed must be 1 when mt_allow_comments is 0 or 2, 0 when mt_allow_comments is 1.
        // $closed must be have value of 0 or 1.
        $closed = (((int)_getStructVal($struct, 'mt_allow_comments')) == 1) ? 0 : 1;
    }

    $publish = _getScalar($m, 4);

    // Add item
    $dateCreated = $struct->structmem('dateCreated');
    if ($dateCreated) {
        $dateCreated = _getStructVal($struct, 'dateCreated');
        $v           = validateIso8601($dateCreated);
        if ($v == false) {
            return _error(10, 'wrong format dateCreated');
        }
        if (($v == 'basic') || ($v == 'extended') || ($v == 'mixed')) {
            // if dateCreated has no utc symbol and time offset, treat it as utc datetime.
            // if dateCreated has utc symbol or time zone offset, convert to timestamp directly.
            $dateCreated .= 'Z';
        }
        //Convert ISO 8601 string to unix time(time zone offset is counted.)
        $timestamp = strtotime($dateCreated);
        $res       = _addDatedItem(
            $blogid,
            $username,
            $password,
            $title,
            $content,
            $more,
            $publish,
            $closed,
            $timestamp,
            1,
            $category
        );
    } else {
        $res = _addItem($blogid, $username, $password, $title, $content, $more, $publish, $closed, $category);
    }

    // Handle trackbacks
    $trackbacks = array();
    $tblist     = $struct->structmem('mt_tb_ping_urls');
    if ($tblist && ($tblist->kindOf() == "array") && ($tblist->arraysize() > 0)) {
        for ($i = 0; $i < $tblist->arraysize(); $i++) {
            $trackbacks[] = _getArrayVal($tblist, $i);
        }

        $data = array(
            'tb_id' => $itemid,
            'urls'  => & $trackbacks
        );
        $manager->notify('SendTrackback', $data);
    }

    return $res;
}

// metaWeblog.getCategories
$f_metaWeblog_getCategories_sig = array(
    array(
        // return
        $xmlrpcStruct,    // categories for blog

        // params
        $xmlrpcString,    // blogid
        $xmlrpcString,    // username
        $xmlrpcString,    // password

    )
);
$f_metaWeblog_getCategories_doc = "Returns the categories for a given blog";
function f_metaWeblog_getCategories($m)
{
    $blogid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);

    return _categoryList($blogid, $username, $password);
}

// metaWeblog.getPost
$f_metaWeblog_getPost_sig = array(
    array(
        // return
        $xmlrpcStruct,    // the juice

        // params
        $xmlrpcString,    // itemid
        $xmlrpcString,    // username
        $xmlrpcString,    // password

    )
);
$f_metaWeblog_getPost_doc = "Retrieves a post";
function f_metaWeblog_getPost($m)
{
    $itemid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);

    return _mw_getPost($itemid, $username, $password);
}

// metaWeblog.editPost
$f_metaWeblog_editPost_sig = array(
    array(
        // return type
        $xmlrpcBoolean,    // true

        // params:
        $xmlrpcString,    // itemid
        $xmlrpcString,    // username
        $xmlrpcString,    // password
        $xmlrpcStruct,    // content
        $xmlrpcBoolean,    // publish boolean (set to false to create draft)

    )
);
$f_metaWeblog_editPost_doc = "Edits an item";
function f_metaWeblog_editPost($m)
{
    global $manager;

    $itemid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);

    $category = '';
    $struct   = $m->getParam(3);
    $content  = _getStructVal($struct, 'description');
    $title    = _getStructVal($struct, 'title');

    // category is optional (thus: be careful)!
    $catlist = $struct->structmem('categories');
    if ($catlist && ($catlist->kindOf() == "array") && ($catlist->arraysize() > 0)) {
        $category = _getArrayVal($catlist, 0);
    }

    $publish = _getScalar($m, 4);

    // get old title and extended part
    if (! $manager->existsItem($itemid, 1, 1)) {
        return _error(6, "No such item ({$itemid})");
    }
    $blogid = getBlogIDFromItemID($itemid);

    $old = & $manager->getItem($itemid, 1, 1);

    if ($category == '') {
        // leave category unchanged when not present
        $catid = $old['catid'];
    } else {
        $blog  = new BLOG($blogid);
        $catid = $blog->getCategoryIdFromName($category);
    }

    if ($old['draft'] && $publish) {
        $wasdraft = 1;
        $publish  = 1;
    } else {
        $wasdraft = 0;
    }

    $more = $struct->structmem('mt_text_more');
    if ($more) {
        $more = _getStructVal($struct, 'mt_text_more');
    } else {
        $more = $old['more'];
    }

    if ($struct->structmem('mt_allow_comments')) {
        // mt_allow_comments sends these values
        // 0 : none ( no comments are allowed. )
        // 1 : open ( comments are allowed. )
        // 2 : closed ( comment opened time has passed. )
        // So $closed must be 1 when mt_allow_comments is 0 or 2, 0 when mt_allow_comments is 1.
        // $closed must take 0 or 1.
        $closed = (((int)_getStructVal($struct, 'mt_allow_comments')) == 1) ? 0 : 1;
    } else {
        $closed = $old['closed'];
    }

    $dateCreated = $struct->structmem('dateCreated');
    if ($dateCreated) {
        $dateCreated = _getStructVal($struct, 'dateCreated');
        $v           = validateIso8601($dateCreated);
        if ($v == false) {
            return _error(10, 'wrong format dateCreated');
        }
        if (($v == 'basic') || ($v == 'extended') || ($v == 'mixed')) {
            // if dateCreated has no utc symbol and time zone offset, assume as utc.
            // if dateCreated has utc symbol or time zone offset, convert to timestamp directly.
            $dateCreated .= 'Z';
        }
        //ISO 8601 to unix time(time zone offset is counted.)
        $timestamp = strtotime($dateCreated);
        $res       = _edititem(
            $itemid,
            $username,
            $password,
            $catid,
            $title,
            $content,
            $more,
            $wasdraft,
            $publish,
            $closed,
            $timestamp
        );
    } else {
        $res = _edititem($itemid, $username, $password, $catid, $title, $content, $more, $wasdraft, $publish, $closed);
    }

    // Handle trackbacks
    $trackbacks = array();
    $tblist     = $struct->structmem('mt_tb_ping_urls');
    if ($tblist && ($tblist->kindOf() == "array") && ($tblist->arraysize() > 0)) {
        for ($i = 0; $i < $tblist->arraysize(); $i++) {
            $trackbacks[] = _getArrayVal($tblist, $i);
        }

        $data = array(
            'tb_id' => $itemid,
            'urls'  => & $trackbacks
        );
        $manager->notify('SendTrackback', $data);
    }

    return $res;
}

// metaWeblog.newMediaObject
$f_metaWeblog_newMediaObject_sig = array(
    array(
        //  return type
        $xmlrpcStruct,        // "url" element

        // params
        $xmlrpcString,        // blogid
        $xmlrpcString,        // username
        $xmlrpcString,        // password
        $xmlrpcStruct        // 'name', 'type' and 'bits'
    )
);
$f_metaWeblog_newMediaObject_doc = 'Uploads a file to to the media library of the user';
function f_metaWeblog_newMediaObject($m)
{
    $blogid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);

    $struct = $m->getParam(3);
    $name   = _getStructVal($struct, 'name');
    $type   = _getStructVal($struct, 'type');
    $bits   = _getStructVal($struct, 'bits');

    return _newMediaObject($blogid, $username, $password, array('name' => $name, 'type' => $type, 'bits' => $bits));
}

// metaWeblog.getRecentPosts
$f_metaWeblog_getRecentPosts_sig = array(
    array(
        // return type
        $xmlrpcStruct,        // array of structs

        // params
        $xmlrpcString,        // blogid
        $xmlrpcString,        // username
        $xmlrpcString,        // password
        $xmlrpcInt            // number of posts
    )
);
$f_metaWeblog_getRecentPosts_doc = 'Returns recent weblog items.';
function f_metaWeblog_getRecentPosts($m)
{
    $blogid   = _getScalar($m, 0);
    $username = _getScalar($m, 1);
    $password = _getScalar($m, 2);
    $amount   = intval(_getScalar($m, 3));

    return _getRecentItemsMetaWeblog($blogid, $username, $password, $amount);
}

function _getRecentItemsMetaWeblog($blogid, $username, $password, $amount)
{
    $blogid = intval($blogid);
    $amount = intval($amount);

    // 1. login
    $mem = new MEMBER();
    if (! $mem->login($username, $password)) {
        return _error(1, "Could not log in");
    }

    // 2. check if allowed
    if (! BLOG::existsID($blogid)) {
        return _error(2, "No such blog ({$blogid})");
    }
    if (! $mem->teamRights($blogid)) {
        return _error(3, "Not a team member");
    }
    $amount = intval($amount);
    if (($amount < 1) or ($amount > 20)) {
        return _error(5, "Amount parameter must be in range 1..20");
    }

    // 3. create and return list of recent items
    // Struct returned has dateCreated, userid, blogid and content

    $blog = new BLOG($blogid);

    $structarray = array();        // the array in which the structs will be stored

    $query = "SELECT mname, ibody, imore, iauthor, ibody, inumber, ititle as title, itime, cname as category, iclosed"
        . ' FROM ' . sql_table('item') . ', ' . sql_table('category') . ', ' . sql_table('member')
        . " WHERE iblog={$blogid} and icat=catid and iauthor=mnumber"
        . " ORDER BY itime DESC"
        . " LIMIT {$amount}";
    $r = sql_query($query);

    while ($row = sql_fetch_assoc($r)) {
        // remove linebreaks if needed
        if ($blog->convertBreaks()) {
            $row['ibody'] = removeBreaks($row['ibody']);
            $row['imore'] = removeBreaks($row['imore']);
        }

        $newstruct = new xmlrpcval(array(
            "dateCreated" => new xmlrpcval(iso8601_encode(strtotime($row['itime'])), "dateTime.iso8601"),
            "userid"      => new xmlrpcval($row['iauthor'], "string"),
            "blogid"      => new xmlrpcval($blogid, "string"),
            "postid"      => new xmlrpcval($row['inumber'], "string"),
            "description" => new xmlrpcval($row['ibody'], "string"),
            "title"       => new xmlrpcval($row['title'], "string"),
            "categories"  => new xmlrpcval(
                array(
                    new xmlrpcval($row['category'], "string")
                ),
                "array"
            ),

            "mt_text_more"      => new xmlrpcval($row['imore'], "string"),
            "mt_allow_comments" => new xmlrpcval($row['iclosed'] ? 0 : 1, "int"),
            "mt_allow_pings"    => new xmlrpcval(1, "int")
        ), 'struct');

        //TODO: String link?
        //TODO: String permaLink?

        array_push($structarray, $newstruct);
    }

    return new xmlrpcresp(new xmlrpcval($structarray, "array"));
}

function _newMediaObject($blogid, $username, $password, $info)
{
    global $CONF, $DIR_MEDIA, $DIR_LIBS, $member;

    // - login
    $mem = new MEMBER();
    if (! $mem->login($username, $password)) {
        return _error(1, 'Could not log in');
    }

    // - check if team member
    if (! BLOG::existsID($blogid)) {
        return _error(2, "No such blog ({$blogid})");
    }
    if (! $mem->teamRights($blogid)) {
        return _error(3, 'Not a team member');
    }

    $b = new BLOG($blogid);

    // - decode data
    $data = $info['bits']; // decoding was done transparantly by xmlrpclib

    // - check filesize
    if (strlen($data) > $CONF['MaxUploadSize']) {
        return _error(9, 'filesize is too big');
    }

    // - check if filetype is allowed (check filename)
    $filename     = $info['name'];
    $ok           = 0;
    $allowedtypes = MEDIA::getAllowedTypes();
    foreach ($allowedtypes as $type) {
        //if (eregi("\." .$type. "$",$filename)) $ok = 1;
        if (preg_match("#\." . $type . "$#i", $filename)) {
            $ok = 1;
        }
    }
    if (! $ok) {
        _error(8, 'Filetype is not allowed');
    }

    // - add file to media library
    //include_once($DIR_LIBS . 'MEDIA.php');    // media classes
    include_libs('MEDIA.php', true, false);

    // always use private media library of member
    $collection = $mem->getID();

    // prefix filename with current date (YYYY-MM-DD-)
    // this to avoid nameclashes
    if ($CONF['MediaPrefix']) {
        $filename = date("Ymd-", time()) . $filename;
    }

    $member = $mem;
    $res    = MEDIA::addMediaObjectRaw($collection, $filename, $data);
    if ($res) {
        return _error(10, $res);
    }

    // - return URL
    $urlstruct = new xmlrpcval(array(
        "url" => new xmlrpcval($CONF['MediaURL'] . $collection . '/' . $filename, 'string')
    ), 'struct');

    return new xmlrpcresp($urlstruct);
}

function _categoryList($blogid, $username, $password)
{
    // 1. login
    $mem = new MEMBER();
    if (! $mem->login($username, $password)) {
        return _error(1, "Could not log in");
    }

    // check if on team and blog exists
    if (! BLOG::existsID($blogid)) {
        return _error(2, "No such blog ({$blogid})");
    }
    if (! $mem->teamRights($blogid)) {
        return _error(3, "Not a team member");
    }

    $b = new BLOG($blogid);

    $structarray = array();

    $query = "SELECT cname, cdesc, catid"
        . ' FROM ' . sql_table('category')
        . " WHERE cblog=" . intval($blogid)
        . " ORDER BY cname";
    $r = sql_query($query);

    while ($obj = sql_fetch_object($r)) {
        array_push($structarray, new xmlrpcval(
            array(
                "title"       => new xmlrpcval($obj->cname, "string"),
                "categoryId"  => new xmlrpcval($obj->catid, "string"),
                "description" => new xmlrpcval($obj->cdesc, "string"),
                "htmlUrl"     => new xmlrpcval($b->getURL() . "?catid=" . $obj->catid, "string"),
                "rssUrl"      => new xmlrpcval("", "string")
            ),
            'struct'
        ));
    }

    return new xmlrpcresp(new xmlrpcval($structarray, "array"));
}

function _mw_getPost($itemid, $username, $password)
{
    global $manager;

    // 1. login
    $mem = new MEMBER();
    if (! $mem->login($username, $password)) {
        return _error(1, "Could not log in");
    }

    // 2. check if allowed
    if (! $manager->existsItem($itemid, 1, 1)) {
        return _error(6, "No such item ({$itemid})");
    }
    $blogid = getBlogIDFromItemID($itemid);
    if (! $mem->teamRights($blogid)) {
        return _error(3, "Not a team member");
    }

    // 3. return the item
    $item = & $manager->getItem($itemid, 1, 1); // (also allow drafts and future items)

    $b = new BLOG($blogid);
    if ($b->convertBreaks()) {
        $item['body'] = removeBreaks($item['body']);
        $item['more'] = removeBreaks($item['more']);
    }

    $categoryname = $b->getCategoryName($item['catid']);

    $newstruct = new xmlrpcval(array(
        "dateCreated" => new xmlrpcval(iso8601_encode($item['timestamp']), "dateTime.iso8601"),
        "userid"      => new xmlrpcval($item['authorid'], "string"),
        "blogid"      => new xmlrpcval($blogid, "string"),
        "postid"      => new xmlrpcval($itemid, "string"),
        "description" => new xmlrpcval($item['body'], "string"),
        "title"       => new xmlrpcval($item['title'], "string"),
        "categories"  => new xmlrpcval(
            array(
                new xmlrpcval($categoryname, "string")
            ),
            "array"
        ),

        "mt_text_more"      => new xmlrpcval($item['more'], "string"),
        "mt_allow_comments" => new xmlrpcval($item['closed'] ? 0 : 1, "int"),
        "mt_allow_pings"    => new xmlrpcval(1, "int")
    ), 'struct');

    //TODO: add "String link" to struct?
    //TODO: add "String permaLink" to struct?

    return new xmlrpcresp($newstruct);
}

$functionDefs = array_merge(
    $functionDefs,
    array(
        "metaWeblog.newPost" => array(
                "function"  => "f_metaWeblog_newPost",
                "signature" => $f_metaWeblog_newPost_sig,
                "docstring" => $f_metaWeblog_newPost_doc
            ),

        "metaWeblog.getCategories" => array(
                "function"  => "f_metaWeblog_getCategories",
                "signature" => $f_metaWeblog_getCategories_sig,
                "docstring" => $f_metaWeblog_getCategories_doc
            ),

        "metaWeblog.getPost" => array(
                "function"  => "f_metaWeblog_getPost",
                "signature" => $f_metaWeblog_getPost_sig,
                "docstring" => $f_metaWeblog_getPost_doc
            ),

        "metaWeblog.editPost" => array(
                "function"  => "f_metaWeblog_editPost",
                "signature" => $f_metaWeblog_editPost_sig,
                "docstring" => $f_metaWeblog_editPost_doc
            ),

        'metaWeblog.newMediaObject' => array(
                'function'  => 'f_metaWeblog_newMediaObject',
                'signature' => $f_metaWeblog_newMediaObject_sig,
                'docstring' => $f_metaWeblog_newMediaObject_doc
            ),

        'metaWeblog.getRecentPosts' => array(
                'function'  => 'f_metaWeblog_getRecentPosts',
                'signature' => $f_metaWeblog_getRecentPosts_sig,
                'docstring' => $f_metaWeblog_getRecentPosts_doc
            )

    )
);
