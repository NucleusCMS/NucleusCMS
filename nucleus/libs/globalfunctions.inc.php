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
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group

 */

function include_libs($file,$once=true,$require=true){
    if (!is_dir(NC_LIBS_PATH)) exit;
    if ($once && $require) require_once(NC_LIBS_PATH.$file);
    elseif ($once && !$require) include_once(NC_LIBS_PATH.$file);
    elseif ($require) require(NC_LIBS_PATH.$file);
    else include(NC_LIBS_PATH.$file);
}

function include_plugins($file,$once=true,$require=true){
    global $DIR_PLUGINS;
    if (!is_dir($DIR_PLUGINS)) exit;
    if ($once && $require) require_once($DIR_PLUGINS.$file);
    elseif ($once && !$require) include_once($DIR_PLUGINS.$file);
    elseif ($require) require($DIR_PLUGINS.$file);
    else include($DIR_PLUGINS.$file);
}

function intPostVar($name) {
    return (int)postVar($name);
}

function intGetVar($name) {
    return (int)getVar($name);
}

function intRequestVar($name) {
    return (int)requestVar($name);
}

function intCookieVar($name) {
    return (int)cookieVar($name);
}

/**
  * returns the currently used version (100 = 1.00, 101 = 1.01, etc...)
  */
function getNucleusVersion() {
    return NUCLEUS_VERSION_ID;
}

/**
 * power users can install patches in between nucleus releases. These patches
 * usually add new functionality in the plugin API and allow those to
 * be tested without having to install CVS.
 */
function getNucleusPatchLevel() {
    return NUCLEUS_PATCH_LEVEL;
}

/**
 * returns the latest version available for download from nucleuscms.org
 * or false if unable to attain data
 * format will be major.minor/patachlevel
 * e.g. 3.41 or 3.41/02
 */
function getLatestVersion() {
    global $CONF;

    // response version text ,  last request time
    foreach(array('LatestVerText','LatestVerReqTime') as $name)
    {
        if (isset($CONF[$name])) continue;
        
        $ph['name'] = $name;
        sql_query(parseQuery("INSERT INTO [@prefix@]config (name,value) VALUES ('[@name@]','')", $ph));
        $CONF[$name] = '';
    }

    $t = (!empty($CONF['LatestVerReqTime']) ? (int)$CONF['LatestVerReqTime'] :0);
    $l_ver = (!empty($CONF['LatestVerText']) ? $CONF['LatestVerText']:'');
    $elapsed_time = time()-$t;
    // cache 180 minutes ,
    if ($t>0 && ($elapsed_time > -60) && ($elapsed_time<60*180))
    {
        return $l_ver;
    }

    $options = array('timeout'=> 5, 'connecttimeout'=> 3);
    $ret = @Utils::httpGet('http://nucleuscms.org/version_check.php', $options);

    if (empty($ret) || !preg_match('@^[0-9\./]+$@ms', $ret))
        $ret = '';

    ADMIN::updateConfig('LatestVerText', $ret);
    ADMIN::updateConfig('LatestVerReqTime', strval(time()) );

    return $ret;
}

/**
 * returns a prefixed nucleus table name
 */
function sql_table($name='') {
    global $DB_PREFIX;

    if (strlen($DB_PREFIX) > 0) {
        return $DB_PREFIX . 'nucleus_' . $name;
    } else {
        return 'nucleus_' . $name;
    }
}

function sendContentType($contenttype, $pagetype = '', $charset = _CHARSET) {
    global $manager;

    if (!headers_sent() ) {
        if (
                ($contenttype == 'application/xhtml+xml')
            &&  (!stristr(serverVar('HTTP_ACCEPT'), 'application/xhtml+xml') )
            ) {
            $contenttype = 'text/html';
        }
        $param = array(
            'contentType'    => &$contenttype,
            'charset'        => &$charset,
            'pageType'        =>  $pagetype
        );

        if (!function_exists('sql_connected') || sql_connected())
            $manager->notify('PreSendContentType', $param);

        // strip strange characters
        $contenttype = preg_replace('|[^a-z0-9-+./]|i', '', $contenttype);
        $charset = preg_replace('|[^a-z0-9-_]|i', '', $charset);

        if ($charset != '') {
            header('Content-Type: ' . $contenttype . '; charset=' . $charset);
        } else {
            header('Content-Type: ' . $contenttype);
        }

        if (function_exists('encoding_check')) {
            // check if valid charset
            if (!encoding_check(false,false,$charset)) {
                foreach(array($_GET, $_POST) as $input)
                    array_walk($input, 'encoding_check');
            }
        }
    }
}

/**
 * Highlights a specific query in a given HTML text (not within HTML tags) and returns it
 * @param string $text text to be highlighted
 * @param string $expression regular expression to be matched (can be an array of expressions as well)
 * @param string $highlight highlight to be used (use \\0 to indicate the matched expression)
 * @return string
 **/
function highlight($text, $expression, $highlight) {
    if (!$highlight || !$expression)
    {
        return $text;
    }
    
    if (is_array($expression) && (count($expression) == 0) )
    {
        return $text;
    }
    
    // add a tag in front (is needed for preg_match_all to work correct)
    $text = '<!--h-->' . $text;
    
    // split the HTML up so we have HTML tags
    // $matches[0][i] = HTML + text
    // $matches[1][i] = HTML
    // $matches[2][i] = text
    $matches = array();
    preg_match_all('/(<[^>]+>)([^<>]*)/', $text, $matches);
    
    // throw it all together again while applying the highlight to the text pieces
    $result = '';
    $count_matches = count($matches[2]);
    for ($i = 0; $i < $count_matches; $i++) {
        if ($i != 0)
        {
            $result .= $matches[1][$i];
        }
        
        if (is_array($expression) )
        {
            foreach ($expression as $regex)
            {
                if ($regex)
                {
                    $matches[2][$i] = @preg_replace("#".$regex."#i", $highlight, $matches[2][$i]);
                }
            }
            
            $result .= $matches[2][$i];
        }
        else
        {
            $result .= @preg_replace("#".$expression."#i", $highlight, $matches[2][$i]);
        }
    }
    
    return $result;
}

/**
 * Parses a query into an array of expressions that can be passed on to the highlight method
 */
function parseHighlight($query) {
    // TODO: add more intelligent splitting logic

    // get rid of quotes
    $query = str_replace(array("'",'/'), '', $query);

    if (!$query) {
        return array();
    }

    $aHighlight = explode(' ', $query);

    for ($i = 0, $iMax = count($aHighlight); $i < $iMax; $i++) {
        $aHighlight[$i] = trim($aHighlight[$i]);

//        if (strlen($aHighlight[$i]) < 3) {
//            unset($aHighlight[$i]);
//        }
    }

    if (count($aHighlight) == 1) {
        return $aHighlight[0];
    } else {
        return $aHighlight;
    }
}

/**
  * Checks if email address is valid
  */
function isValidMailAddress($address) {
    // enhancement made in 3.6x based on code by Quandary.
    if (preg_match('/^(?!\\.)(?:\\.?[-a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~]+)+@(?!\\.)(?:\\.?(?!-)[-a-zA-Z0-9]+(?<!-)){2,}$/', $address)) {
        return 1;
    } else {
        return 0;
    }
}

// some helper functions
function getBlogIDFromName($bshortname)
{
    $ph['bshortname'] = sql_quote_string($bshortname);
    $res = parseQuickQuery("SELECT bnumber as result FROM [@prefix@]blog WHERE bshortname=[@bshortname@]", $ph);
    if ($res !== false)
        $res = (int)$res;
    return $res;
}

function getBlogNameFromID($bnumber)
{
    $ph['bnumber'] = (int)$bnumber;
    return parseQuickQuery('SELECT bname as result FROM [@prefix@]blog WHERE bnumber=[@bnumber@]', $ph);
}

function getBlogIDFromItemID($inumber)
{
    $ph['inumber'] = (int)$inumber;
    $res = parseQuickQuery('SELECT iblog as result FROM [@prefix@]item WHERE inumber=[@inumber@]', $ph);
    if ($res !== false)
        $res = (int)$res;
    return $res;
}

function getBlogIDFromCommentID($cnumber)
{
    $ph['cnumber'] = (int)$cnumber;
    $res = parseQuickQuery('SELECT cblog as result FROM [@prefix@]comment WHERE cnumber=[@cnumber@]', $ph);
    if ($res !== false)
        $res = (int)$res;
    return $res;
}

function getBlogIDFromCatID($catid)
{
    $ph['catid'] = (int)$catid;
    $res = parseQuickQuery('SELECT cblog as result FROM [@prefix@]category WHERE catid=[@catid@]', $ph);
    if ($res !== false)
        $res = (int)$res;
    return $res;
}

function getCatIDFromName($cname)
{
    $ph['cname'] = sql_quote_string($cname);
    $res = parseQuickQuery("SELECT catid as result FROM [@prefix@]category WHERE cname=[@cname@]", $ph);
    if ($res !== false)
        $res = (int)$res;
    return $res;
}

function quickQuery($sqlText, $cacheClear=false)
{
    static $rs = array();
    
    $key = md5($sqlText);
    
    if($cacheClear && isset($rs[$key])) {
        unset($rs[$key]);
    }

    if(isset($rs[$key])) return $rs[$key];
    
    $res = sql_query($sqlText);
    
    $rs[$key] = false;
    
    if ($res && ($v = sql_fetch_array($res)))
    {
        if ( isset($v['result']) )
        {
            $rs[$key] = $v['result'];
        }
        elseif ( isset($v[0]) )
        {
            $rs[$key] = $v[0];
        }
    }
    return $rs[$key];
}

function getPluginNameFromPid($pid) {
    $ph['pid'] = (int)$pid;
    $res = sql_query( parseQuery('SELECT pfile FROM `[@prefix@]plugin` WHERE pid=[@pid@]', $ph) );
    if ($res && ($obj = sql_fetch_object($res)))
        return $obj->pfile;
    return false;
}

function _execOtherAction() {
    $action = requestVar('action');
    $actionNames = array('addcomment', 'sendmessage', 'createaccount', 'forgotpassword', 'votepositive', 'votenegative', 'plugin');
    if (in_array($action, $actionNames) ) {
        global $errormessage;
        include_once(NC_LIBS_PATH . 'ACTION.php');
        $a = new ACTION();
        $errorInfo = $a->doAction($action);

        if ($errorInfo) {
            $errormessage = $errorInfo['message'];
        }
    }
}

function _alertOnHeadersSent() {
    headers_sent($hsFile, $hsLine);
    $extraInfo = sprintf(_GFUNCTIONS_HEADERSALREADYSENT_FILE,$hsFile,$hsLine);

    startUpError(
        sprintf(_GFUNCTIONS_HEADERSALREADYSENT_TXT,$extraInfo),
        _GFUNCTIONS_HEADERSALREADYSENT_TITLE
    );
    exit;
}

function _decideItemSkin($itemid) {
    global $blogid, $CONF, $catid, $manager;
    // itemid given -> only show that item
    
    if (!$manager->existsItem(
            $itemid
            , (int)$CONF['allowFuture']
            , (int)$CONF['allowDrafts'] ) ) {
        doError(_ERROR_NOSUCHITEM);
    }

    global $itemidprev, $itemidnext, $itemtitlenext, $itemtitleprev;

    // 1. get timestamp, blogid and catid for item
    $obj = sql_fetch_object(
            sql_query(parseQuery(
                    "SELECT itime, iblog, icat FROM [@prefix@]item WHERE inumber='[@inumber@]'"
                    , array('inumber' => (int)$itemid)
                )
            )
    );

    // if a different blog id has been set through the request or selectBlog(),
    // deny access
    
    if ($blogid && (int)$blogid != $obj->iblog ) {
        if (!headers_sent()) {
            $b =& $manager->getBlog($obj->iblog);
            $CONF['ItemURL'] = $b->getURL();
            if ($CONF['URLMode'] === 'pathinfo' && substr($CONF['ItemURL'],-1) === '/')
                $CONF['ItemURL'] = substr($CONF['ItemURL'], 0, -1);
            $correctURL = createItemLink($itemid, '');
            redirect($correctURL);
            exit;
        }
        doError(_ERROR_NOSUCHITEM);
    }

    // if a category has been selected which doesn't match the item, ignore the
    // category. #85
    if (($catid != 0) && ($catid != $obj->icat) ) {
        $catid = 0;
    }

    $blogid = $obj->iblog;

    $b =& $manager->getBlog($blogid);

    if ($b->isValidCategory($catid) ) {
        $catextra = ' AND icat=' . $catid;
    } else {
        $catextra = '';
    }

    // get previous itemid and title
    $ph = array();
    $ph['itime'] = $obj->itime;
    $ph['blogid'] = $blogid;
    $ph['catextra'] = $catextra;
    $ph['now'] = date('Y-m-d H:i:s', $b->getCorrectTime());
    $res = sql_query(parseQuery(
        "SELECT inumber, ititle FROM [@prefix@]item WHERE itime<'[@itime@]' AND idraft=0 AND iblog=[@blogid@] [@catextra@] ORDER BY itime DESC LIMIT 1"
        , $ph));

    if ($res && ($obj = sql_fetch_object($res))) {
        $itemidprev    = $obj->inumber;
        $itemtitleprev = $obj->ititle;
    }

    // get next itemid and title
    $res = sql_query(parseQuery(
        "SELECT inumber, ititle FROM [@prefix@]item WHERE itime>'[@itime@]' AND itime<='[@now@]' AND idraft=0 AND iblog=[@blogid@] [@catextra@] ORDER BY itime ASC LIMIT 1"
        , $ph));

    if ($res && $obj = sql_fetch_object($res)) {
        $itemidnext    = $obj->inumber;
        $itemtitlenext = $obj->ititle;
    }
    return 'item';
}

function _decideArchivelistSkin($archivelist) {
    global $CONF, $blogid;
    
    if(!$blogid) {
        if (preg_match('@^[1-9][0-9]*$@', $archivelist)) {
            $blogid = $archivelist;
        } elseif($archivelist==0) {
            $blogid = $CONF['DefaultBlog'];
        } else {
            $blogid = getBlogIDFromName($archivelist);
        }
    }

    if (!$blogid) {
        doError(_ERROR_NOSUCHBLOG);
    }
    
    return 'archivelist';
}

function _decideArchiveSkin($archive) {
    global $CONF, $blogid, $query;
    // get next and prev month links ...
    global $archivenext, $archiveprev, $archivetype, $archivenextexists, $archiveprevexists;

    // sql queries for the timestamp of the first and the last published item
    $ph = array();
    $ph['iblog'] = (int)($blogid>0 ? $blogid : $CONF['DefaultBlog']);
    $query = parseQuery("SELECT UNIX_TIMESTAMP(itime) as result FROM [@prefix@]item WHERE idraft=0 AND iblog='[@iblog@]'",$ph);
    
    $first_timestamp = quickQuery($query . ' ORDER BY itime ASC LIMIT 1');
    $last_timestamp  = quickQuery($query . ' ORDER BY itime DESC LIMIT 1');

    $y = $m = $d = '';
    sscanf($archive, '%d-%d-%d', $y, $m, $d);

    if ($d != 0) {
        $archivetype = _ARCHIVETYPE_DAY;
        $t = mktime(0, 0, 0, $m, $d, $y);
        // one day has 24 * 60 * 60 = 86400 seconds
        $archiveprev = strftime('%Y-%m-%d', $t - 86400 );
        // check for published items
        if ($t > $first_timestamp) {
            $archiveprevexists = true;
        }
        else {
            $archiveprevexists = false;
        }

        // one day later
        $t += 86400;
        $archivenext = strftime('%Y-%m-%d', $t);
        if ($t < $last_timestamp) {
            $archivenextexists = true;
        }
        else {
            $archivenextexists = false;
        }

    } elseif ($m == 0) {
        $archivetype = _ARCHIVETYPE_YEAR;
        $t = mktime(0, 0, 0, 12, 31, $y - 1);
        // one day before is in the previous year
        $archiveprev = strftime('%Y', $t);
        if ($t > $first_timestamp) {
            $archiveprevexists = true;
        }
        else {
            $archiveprevexists = false;
        }

        // timestamp for the next year
        $t = mktime(0, 0, 0, 1, 1, $y + 1);
        $archivenext = strftime('%Y', $t);
        if ($t < $last_timestamp) {
            $archivenextexists = true;
        }
        else {
            $archivenextexists = false;
        }
    } else {
        $archivetype = _ARCHIVETYPE_MONTH;
        $t = mktime(0, 0, 0, $m, 1, $y);
        // one day before is in the previous month
        $archiveprev = strftime('%Y-%m', $t - 86400);
        if ($t > $first_timestamp) {
            $archiveprevexists = true;
        }
        else {
            $archiveprevexists = false;
        }

        // timestamp for the next month
        $t = mktime(0, 0, 0, $m+1, 1, $y);
        $archivenext = strftime('%Y-%m', $t);
        if ($t < $last_timestamp) {
            $archivenextexists = true;
        }
        else {
            $archivenextexists = false;
        }
    }
    return 'archive';
}

function _decideSearchSkin($keyword) {
    global $blogid, $query;
    $type = 'search';
    $query = stripslashes($keyword);

    if (function_exists('mb_convert_encoding')) {
        if (preg_match("/^(\xA1{2}|\xe3\x80{2}|\x20)+$/", $query)) {
            $type = 'index';
        }
        $query = _fix_mb_string($query);
    }

    if (is_numeric($blogid)) {
        $blogid = intVal($blogid);
//        } elseif(empty($blogid)) {
//            $blogid = $CONF['DefaultBlog'];
    } else {
        $blogid = getBlogIDFromName($blogid);
    }

    if (!$blogid) {
        doError(_ERROR_NOSUCHBLOG);
    }
    return $type;
}

function _decideMemberSkin($memberid) {
    global $manager, $memberinfo;

    if (!MEMBER::existsID($memberid) ) {
        doError(_ERROR_NOSUCHMEMBER);
    }

    $memberinfo = $manager->getMember($memberid);
    return 'member';
}

function _fix_mb_string($query) {
    switch(strtolower(_CHARSET)) {
        case 'utf-8':
            $order = 'ASCII, UTF-8, EUC-JP, JIS, SJIS, EUC-CN, ISO-8859-1';
            break;
        case 'gb2312':
            $order = 'ASCII, EUC-CN, EUC-JP, UTF-8, JIS, SJIS, ISO-8859-1';
            break;
        case 'shift_jis':
            // Note that shift_jis is only supported for output.
            // Using shift_jis in DB is prohibited.
            $order = 'ASCII, SJIS, EUC-JP, UTF-8, JIS, EUC-CN, ISO-8859-1';
            break;
        default:
            // euc-jp,iso-8859-x,windows-125x
            $order = 'ASCII, EUC-JP, UTF-8, JIS, SJIS, EUC-CN, ISO-8859-1';
            break;
    }
    return mb_convert_encoding($query, _CHARSET, $order);
}

function selector() {
    global $itemid, $blogid, $memberid, $archivelist;
    global $archive, $skinid, $blog, $CONF;
    global $imagepopup, $catid, $special;
    global $manager;

    _execOtherAction();
    
    // show error when headers already sent out
    if (headers_sent() && $CONF['alertOnHeadersSent']) {
        _alertOnHeadersSent();
    }

    // make is so ?archivelist without blogname or blogid shows the archivelist
    // for the default weblog
    if (serverVar('QUERY_STRING') == 'archivelist') {
        $archivelist = $CONF['DefaultBlog'];
    }

    // now decide which type of skin we need
    if ($itemid) {
        $type = _decideItemSkin($itemid);
    } elseif ($archive) {
        $type = _decideArchiveSkin($archive);
    } elseif ($archivelist) {
        $type = _decideArchivelistSkin($itemid);
    } elseif ($keyword = getVar('query',$GLOBALS['query'])) {
        $type = _decideSearchSkin($keyword);
    } elseif ($memberid) {
        $type = _decideMemberSkin($memberid);
    } elseif ($imagepopup) {
        $type = 'imagepopup';
    } else {
        $type = 'index';
    }

    // any type of skin with catid
    if ($catid && !$blogid) {
        $blogid = getBlogIDFromCatID($catid);
    }

    // decide which blog should be displayed
    if (!$blogid) {
        $blogid = $CONF['DefaultBlog'];
    }

    $b =& $manager->getBlog($blogid);
    $blog = $b; // references can't be placed in global variables?

    if (!$blog->isValid) {
        doError(_ERROR_NOSUCHBLOG);
    }

    // set catid if necessary
    if ($catid) {
        // check if the category is valid
        if (!$blog->isValidCategory($catid)) {
            doError(_ERROR_NOSUCHCATEGORY);
        } else {
            $blog->setSelectedCategory($catid);
        }
    }

    // decide which skin should be used
    if ($skinid != '' && $skinid == 0) {
        selectSkin($skinid);
    }

    if (!$skinid) {
        $skinid = $blog->getDefaultSkin();
    }

    $skin_options = array('spartstype'=>'parts');

    //$special = requestVar('special'); //get at top of file as global
    if ($special && isValidSkinSpecialPageName($special)) {
        if (!$skinid)
            doError(_ERROR_SKIN);
        if (!$skinid || !SKIN::existsSpecialPageName($skinid, $special))
            doError(_ERROR_NOSUCHPAGE);
        $skin_options['spartstype'] = 'specialpage';
        $type = strtolower($special);
    }

    $skin = new SKIN($skinid);

    if (!$skin->isValid) {
        doError(_ERROR_NOSUCHSKIN);
    }
    
    // set global skinpart variable so can determine quickly what is being parsed from any plugin or phpinclude
    global $skinpart, $skin_sparts_type;
    $skinpart = $type;
    $skin_sparts_type = $skin_options['spartstype']; // parts or specialpage
    
    // parse the skin
    $output = $skin->parse($type, $skin_options);
    checkOutputCompression($skin->getContentType());
    echo $output;

    // check to see we should throw JustPosted event
    $blog->checkJustPosted();
}

/**
  * Show error skin with given message. An optional skin-object to use can be given
  */
function doError($msg, $skin = '') {
    global $errormessage, $CONF, $skinid, $blogid, $manager;

    if ($skin == '') {

        if (SKIN::existsID($skinid) ) {
            $skin = new SKIN($skinid);
        } elseif ($manager->existsBlogID($blogid) ) {
            $blog =& $manager->getBlog($blogid);
            $skin = new SKIN($blog->getDefaultSkin() );
        } elseif ($CONF['DefaultBlog']) {
            $blog =& $manager->getBlog($CONF['DefaultBlog']);
            $skin = new SKIN($blog->getDefaultSkin() );
        } else {
            // this statement should actually never be executed
            $skin = new SKIN($CONF['BaseSkin']);
        }

    }

    if ($manager->existsBlogID($blogid) )
    {
        $blog =& $manager->getBlog($blogid);
        $CONF['SiteName'] = $blog->getName();
        $CONF['IndexURL'] = $blog->getURL();
    }

    $skinid = $skin->id;
    $errormessage = $msg;
    $output = $skin->parse('error');
    checkOutputCompression($skin->getContentType());
    echo $output;
    exit;
}

function getConfig() {
    global $CONF;

    $res = sql_query(parseQuery('SELECT * FROM `[@prefix@]config`'));

    if ($res)
    while ($obj = sql_fetch_object($res) ) {
        if(!isset($CONF[$obj->name]))
            $CONF[$obj->name] = $obj->value;
    }
}

// some checks for names of blogs, categories, templates, members, ...
function isValidShortName($name) {
    return preg_match('#^[a-z0-9]+$#i', $name);
}

function isValidDisplayName($name) {
    return preg_match('#^[a-z0-9]+[a-z0-9 ]*[a-z0-9]+$#i', $name);
}

function isValidCategoryName($name) {
    return 1;
}

function isValidTemplateName($name) {
    return preg_match('#^[a-z0-9/]+$#i', $name);
}

function isValidSkinName($name) {
    return preg_match('#^[a-z0-9/]+$#i', $name);
}

function isValidSkinPartsName($name)
{
    return preg_match('#^[a-z0-9_\-]+$#i', $name);
}

function isValidSkinSpecialPageName($name)
{
    return preg_match('@^[^\?\/#]+$@i', $name);
}


// add and remove linebreaks
function addBreaks($text) {
//    if($mode==='nl2br') return nl2br($text);
    
    $text = str_replace(array("\r\n","\r"),"\n",$text);
    
    $blockElms  = 'br,table,tbody,tr,td,th,thead,tfoot,caption,colgroup,div';
    $blockElms .= ',dl,dd,dt,ul,ol,li,pre,select,option,form,map,area,blockquote';
    $blockElms .= ',address,math,style,input,p,h1,h2,h3,h4,h5,h6,hr,object,param,embed';
    $blockElms .= ',noframes,noscript,section,article,aside,hgroup,footer,address,code';
    $blockElms = explode(',', $blockElms);
    $lines = explode("\n",$text);
    $c = count($lines);
    foreach($lines as $i=>$line)
    {
        $line = rtrim($line);
        if($i===$c-1) break;
        foreach($blockElms as $block)
        {
            if(preg_match("@</?{$block}" . '[^>]*>$@',$line))
                continue 2;
        }
        $lines[$i] = "{$line}<br />";
    }
    return join("\n", $lines);
}

function removeBreaks($var) {
    if(str_contains($var,"\r")) $var = str_replace("\r",'',$var);
    return preg_replace("@<br[ /]*>\n@i", "\n", $var);
}

// shortens a text string to maxlength ($toadd) is what needs to be added
// at the end (end length is <= $maxlength)
function shorten($text, $maxlength, $toadd) {
    $maxlength = (int)$maxlength;
    // 1. remove entities...
    $trans = get_html_translation_table(HTML_ENTITIES);

    $trans = array_flip($trans);
    $text = strtr($text, $trans);

    // 2. the actual shortening
    if (strlen($text) > $maxlength) {
        if (function_exists('mb_strimwidth'))
            $text = mb_strimwidth($text, 0, $maxlength, $toadd, _CHARSET);
        else
            $text = substr($text, 0, $maxlength - strlen($toadd) ) . $toadd;

    }

    return $text;
}

/**
  * Converts a unix timestamp to a mysql DATETIME format, and places
  * quotes around it.
  */
function mysqldate($timestamp) {
    return sprintf("'%s'", date('Y-m-d H:i:s', $timestamp));
}

/**
  * functions for use in index.php
  */
function selectBlog($shortname) {
    global $blogid, $archivelist;
    
    $blogid = getBlogIDFromName($shortname);

    // also force archivelist variable, if it is set
    if ($archivelist) {
        $archivelist = $blogid;
    }
}

function selectSkin($skinname) {
    global $skinid;
    $skinid = SKIN::getIdFromName($skinname);
}

/**
 * Can take either a category ID or a category name (be aware that
 * multiple categories can have the same name)
 */
function selectCategory($cat) {
    global $catid;
    if (is_numeric($cat) ) {
        $catid = (int)$cat;
    } else {
        $catid = getCatIDFromName($cat);
    }
}

function selectItem($id) {
    global $itemid;
    $itemid = (int)$id;
}

// force the use of a language file (warning: can cause warnings)
function selectLanguage($language) {

    global $DIR_LANG;

    # important note that '\' must be matched with '\\\\' in preg* expressions

    include_once(sprintf("%s%s.php", $DIR_LANG, str_replace(array('\\', '/'), '', $language)));

}

function parseFile($filename, $includeMode = 'normal', $includePrefix = '') {
    $handler = new ACTIONS('fileparser');
    $parser = new PARSER(SKIN::getAllowedActionsForType('fileparser'), $handler);
    $handler->parser =& $parser;

    // set IncludeMode properties of parser
    PARSER::setProperty('IncludeMode', $includeMode);
    PARSER::setProperty('IncludePrefix', $includePrefix);

    if (!is_file($filename) ) {
        if (defined('_GFUNCTIONS_PARSEFILE_FILEMISSING'))
            doError(_GFUNCTIONS_PARSEFILE_FILEMISSING);
        else
            doError('A file is missing');
    }

    $fsize = filesize($filename);

    if ($fsize <= 0) {
        return;
    }

    // read file
    $fd = fopen ($filename, 'r');
    $contents = fread ($fd, $fsize);
    fclose ($fd);

    // parse file contents
    $parser->parse($contents);
}

/**
  * Outputs a debug message
  */
function debug($msg) {
    echo sprintf("<p><b>%s</b></p>\n", $msg);
}

// shortcut
function addToLog($level, $msg) {
    ACTIONLOG::add($level, $msg);
}

// shows a link to help file
function help($id) {
    echo helpHtml($id);
}

function helpHtml($id) {
    global $CONF;
    $ph['help_link'] = helplink($id);
    $ph['AdminURL']  = $CONF['AdminURL'];
    $ph['alt_text'] = _HELP_TT;
    return parseHtml('{%help_link%}<img src="{%AdminURL%}documentation/icon-help.gif" width="15" height="15" alt="{%alt_text%}" /></a>',$ph);
}

function helplink($id) {
    $ph['help_dir'] = get_help_root_url(true);
    $ph['id'] = $id;

    return parseHtml('<a href="{%help_dir%}help.html#{%id%}" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);">', $ph);
}

function get_help_root_url($subdir_search = false) {
    global $CONF, $DIR_NUCLEUS;

    static $doc_root = array();
    
    $key = $subdir_search ? 1 : 0;
    if (isset($doc_root[$key])) return $doc_root[$key];
    
    $doc_root[$key] = $CONF['AdminURL'] . 'documentation/';
    if ($subdir_search)
    {
        $lang = getLanguageName();
        $items = array('japan'=>'ja', 'english'=>'en');
        foreach($items as $k => $v)
        {
            if (@stripos($lang , $k)===false || !is_dir($DIR_NUCLEUS . 'documentation/' . $v))
            {
                continue;
            }
            $doc_root[$key] .= $v . '/';
            break;
        }
    }
    return $doc_root[$key];
}

function getMailFooter() {
    $message = "\n\n-----------------------------";
    $message .=  "\n   Powered by Nucleus CMS";
    $message .=  "\n(http://www.nucleuscms.org/)";
    return $message;
}

/**
  * Returns the name of the language to use
  * preference priority: member - site
  * defaults to english when no good language found
  *
  * checks if file exists, etc...
  */
function getLanguageName() {
    global $CONF, $member;

    LoadCoreLanguage();

    if ($member && $member->isLoggedIn() ) {
        // try to use members language
        $memlang = $member->getLanguage();

        if (($memlang != '') && (checkLanguage($memlang) ) ) {
            return $memlang;
        }
    }

    // use default language
    if (checkLanguage($CONF['Language']) ) {
        return $CONF['Language'];
    }

    return 'english';
}

function LoadCoreLanguage()
{
    static $loaded = false;
    if ($loaded)
        return;
    $loaded = true;

//    global $DIR_LANG, $SQL_DBH;
    global $DIR_LANG;
    $language = remove_all_directory_separator(getLanguageName());
    $language = getValidLanguage($language);
    $filename = $DIR_LANG . $language . '.php';
    if (is_file($filename))
        include_once ($filename);

    if ((!defined('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM'))
        && (defined('_CHARSET') && (strtoupper(_CHARSET) === 'UTF-8')))
    {
        // load undefined constant
        if ((stripos($language, 'english')===false) && (stripos($language, 'japan')===false))
        {
            if (@is_file($DIR_LANG . 'english-utf8' . '.php'))
            {
                // load default lang
                ob_start();
                @include_once($DIR_LANG . 'english-utf8' . '.php');
                ob_end_clean();
            }
        }
    }
    sql_set_charset_v2(_CHARSET);
//  if (isset($SQL_DBH) && $SQL_DBH)
//      sql_set_charset_v2(_CHARSET);
//  else
//      sql_set_charset(_CHARSET);

    ini_set('default_charset', _CHARSET);
    if (_CHARSET !== 'UTF-8' && function_exists('mb_http_output'))
    {
//        ini_set('default_charset', ''); // To suppress the content type of http header
//        mb_internal_encoding(_CHARSET);
    }
}

/**
  * Includes a PHP file. This method can be called while parsing templates and skins
  */
function includephp($filename)
{
    // make predefined variables global, so most simple scripts can be used here

    // apache (names taken from PHP doc)
    global $GATEWAY_INTERFACE, $SERVER_NAME, $SERVER_SOFTWARE, $SERVER_PROTOCOL;
    global $REQUEST_METHOD, $QUERY_STRING, $DOCUMENT_ROOT, $HTTP_ACCEPT;
    global $HTTP_ACCEPT_CHARSET, $HTTP_ACCEPT_ENCODING, $HTTP_ACCEPT_LANGUAGE;
    global $HTTP_CONNECTION, $HTTP_HOST, $HTTP_REFERER, $HTTP_USER_AGENT;
    global $REMOTE_ADDR, $REMOTE_PORT, $SCRIPT_FILENAME, $SERVER_ADMIN;
    global $SERVER_PORT, $SERVER_SIGNATURE, $PATH_TRANSLATED, $SCRIPT_NAME;
    global $REQUEST_URI;

    // php (taken from PHP doc)
//    global $argv, $argc, $PHP_SELF, $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $HTTP_POST_VARS;
//    global $HTTP_POST_FILES, $HTTP_ENV_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS;
    global $argv, $argc, $PHP_SELF;

    // other
    global $PATH_INFO, $HTTPS, $HTTP_RAW_POST_DATA, $HTTP_X_FORWARDED_FOR;

    if (@is_file($filename) ) {
        include_once($filename);
    }
}

/**
 * Checks if a certain language exists
 * @param string $lang
 * @return bool
 **/
function checkLanguage($lang) {
    global $DIR_LANG;
    # important note that '\' must be matched with '\\\\' in preg* expressions

    return is_file($DIR_LANG . remove_all_directory_separator($lang) . '.php');
}

/**
 * Checks if a certain plugin exists
 * @param string $plug
 * @return bool
 **/
function checkPlugin($plug) {
    global $DIR_PLUGINS;

    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    $pl_name = remove_all_directory_separator($plug);
    $shortname = strtolower(preg_replace('#^NP_#', '', $plug));
    $fname = $pl_name . '.php';
    foreach(array($fname, "{$shortname}/{$fname}", "{$pl_name}/{$fname}") as $f)
    if (is_file($DIR_PLUGINS . $f))
    {
        return true;
    }
    return false;
}

function remove_all_directory_separator($text)
{
    return str_replace( array("\\" ,'/' , DIRECTORY_SEPARATOR ) , '' , $text);
}

/**
  * Centralisation of the functions that generate links
  */
function createItemLink($itemid, $extra = '') {
    return createLink('item', array('itemid' => $itemid, 'extra' => $extra) );
}

function createMemberLink($memberid, $extra = '') {
    return createLink('member', array('memberid' => $memberid, 'extra' => $extra) );
}

function createCategoryLink($catid, $extra = '') {
    return createLink('category', array('catid' => $catid, 'extra' => $extra) );
}

function createArchiveListLink($blogid = '', $extra = '') {
    return createLink('archivelist', array('blogid' => $blogid, 'extra' => $extra) );
}

function createArchiveLink($blogid, $archive, $extra = '') {
    return createLink('archive', array('blogid' => $blogid, 'archive' => $archive, 'extra' => $extra) );
}

function createBlogidLink($blogid, $params = '') {
    return createLink('blog', array('blogid' => $blogid, 'extra' => $params) );
}

function createLink($type, $params) {
    global $manager, $CONF;

    $generatedURL = '';
    $usePathInfo = ($CONF['URLMode'] === 'pathinfo');

    // ask plugins first
    $created = false;
    $url     = '';

    if ($usePathInfo) {
        $param = array(
            'type'        =>  $type,
            'params'    =>  $params,
            'completed'    => &$created,
            'url'        => &$url
        );
        $manager->notify('GenerateURL', $param);
    }

    // if a plugin created the URL, return it
    if ($created) {
        return $url;
    }

    // default implementation
    switch ($type) {
        case 'item':
            if ($usePathInfo) {
                $url = $CONF['ItemURL'] . '/' . $CONF['ItemKey'] . '/' . $params['itemid'];
            } else {
                $url = $CONF['ItemURL'] . '?itemid=' . $params['itemid'];
            }
            break;

        case 'member':
            if ($usePathInfo) {
                $url = $CONF['MemberURL'] . '/' . $CONF['MemberKey'] . '/' . $params['memberid'];
            } else {
                $url = $CONF['MemberURL'] . '?memberid=' . $params['memberid'];
            }
            break;

        case 'category':
            if ($usePathInfo) {
                $url = $CONF['CategoryURL'] . '/' . $CONF['CategoryKey'] . '/' . $params['catid'];
            } else {
                $url = $CONF['CategoryURL'] . '?catid=' . $params['catid'];
            }
            break;

        case 'archivelist':
            if (!$params['blogid']) {
                $params['blogid'] = $CONF['DefaultBlog'];
            }

            if ($usePathInfo) {
                $url = $CONF['ArchiveListURL'] . '/' . $CONF['ArchivesKey'] . '/' . $params['blogid'];
            } else {
                $url = $CONF['ArchiveListURL'] . '?archivelist=' . $params['blogid'];
            }
            break;

        case 'archive':
            if ($usePathInfo) {
                $url = $CONF['ArchiveURL'] . '/' . $CONF['ArchiveKey'] . '/'.$params['blogid'].'/' . $params['archive'];
            } else {
                $url = $CONF['ArchiveURL'] . '?blogid='.$params['blogid'].'&amp;archive=' . $params['archive'];
            }
            break;

        case 'blog':
            if ($usePathInfo) {
                $url = $CONF['BlogURL'] . '/' . $CONF['BlogKey'] . '/' . $params['blogid'];
            } else {
                global $blogid;
                if ($blogid == $params['blogid'] && ($CONF['BlogURL'] !== 'index.php'))
                    $url = $CONF['BlogURL']  . '?blogid=' . $params['blogid'];
                else
                    $url = $CONF['IndexURL'] . '?blogid=' . $params['blogid'];
            }
            break;
    }

    return addLinkParams($url, (isset($params['extra'])? $params['extra'] : null));
}

function createBlogLink($url, $params) {
    global $CONF;
    if ($CONF['URLMode'] === 'normal') {
        if (strpos($url, '?') === FALSE && is_array($params)) {
            $fParam = reset($params);
            $fKey   = key($params);
            array_shift($params);
            $url .= '?' . $fKey . '=' . $fParam;
        }
    } elseif ($CONF['URLMode'] === 'pathinfo' && substr($url, -1) === '/') {
        $url = substr($url, 0, -1);
    }
    return addLinkParams($url, $params);
}

function addLinkParams($link, $params) {
    global $CONF;

    if ( is_array($params) && (count($params) > 0) )
    {

        if ($CONF['URLMode'] === 'pathinfo') {
            foreach ($params as $param => $value) {
                // change in 3.63 to fix problem where URL generated with extra params mike look like category/4/blogid/1
                // but they should use the URL keys like this: category/4/blog/1
                // if user wants old urls back, set $CONF['NoURLKeysInExtraParams'] = 1; in config.php
                if (isset($CONF['NoURLKeysInExtraParams']) && $CONF['NoURLKeysInExtraParams'] == 1) 
                {
                    $link .= '/' . $param . '/' . urlencode($value);
                } else {
                    switch ($param) {
                        case 'itemid':
                            $link .= sprintf('/%s/%s', $CONF['ItemKey'], urlencode($value));
                        break;
                        case 'memberid':
                            $link .= sprintf('/%s/%s', $CONF['MemberKey'], urlencode($value));
                        break;
                        case 'catid':
                            $link .= sprintf('/%s/%s', $CONF['CategoryKey'], urlencode($value));
                        break;
                        case 'archivelist':
                            $link .= sprintf('/%s/%s', $CONF['ArchivesKey'], urlencode($value));
                        break;
                        case 'archive':
                            $link .= sprintf('/%s/%s', $CONF['ArchiveKey'], urlencode($value));
                        break;
                        case 'blogid':
                            $link .= sprintf('/%s/%s', $CONF['BlogKey'], urlencode($value));
                        break;
                        default:
                            $link .= sprintf('/%d/%s', $param, urlencode($value));
                        break;
                    }
                }
            }
        } else {

            foreach ($params as $param => $value) {
                $link .= sprintf('&amp;%d=%s', $param, urlencode($value));
            }

        }
    }

    return $link;
}

/**
 * @param $querystr
 *        querystring to alter (e.g. foo=1&bar=2&x=y)
 * @param $param
 *        name of parameter to change (e.g. 'foo')
 * @param $value
 *        New value for that parameter (e.g. 3)
 * @result
 *        altered query string (for the examples above: foo=3&bar=2&x=y)
 */
function alterQueryStr($querystr, $param, $value) {
    $vars = explode('&', $querystr);
    $set  = false;

    foreach ($vars as $i => $iValue) {
        $v = explode('=', $iValue);

        if ($v[0] == $param) {
            $v[1] = $value;
            $vars[$i] = implode('=', $v);
            $set = true;
            break;
        }
    }

    if (!$set) {
        $vars[] = $param . '=' . $value;
    }

    return ltrim(implode('&', $vars), '&');
}

// passes one variable as hidden input field (multiple fields for arrays)
// @see passRequestVars in varsx.x.x.php
function passVar($key, $value) {
    // array ?
    if (is_array($value) ) {
        foreach ($value as $i => $iValue) {
            passVar(sprintf('%s[%d]', $key, $i), $iValue);
        }

        return;
    }

    // other values: do stripslashes if needed
    ?><input type="hidden" name="<?php echo hsc($key)?>" value="<?php echo hsc($value); ?>" /><?php
}


/*
    Date format functions (to be used from [%date(..)%] skinvars
*/
function formatDate($format, $timestamp, $defaultFormat, &$blog) {
    // apply blog offset (#42)
    $boffset = $blog ? $blog->getTimeOffset() * 3600 : 0;
    $offset = date('Z', $timestamp) + $boffset;

    switch ($format) {
        case 'rfc822':
            if ($offset >= 0) {
                $tz = '+';
            } else {
                $tz = '-';
                $offset = -$offset;
            }

            $tz .= sprintf('%02d%02d', floor($offset / 3600), round(($offset % 3600) / 60) );
            return date('D, j M Y H:i:s ', $timestamp) . $tz;

        case 'rfc822GMT':
            $timestamp -= $offset;
            return date('D, j M Y H:i:s ', $timestamp) . 'GMT';

        case 'utc':
            $timestamp -= $offset;
            return date('Y-m-d\TH:i:s\Z', $timestamp);

        case 'iso8601':
            if ($offset >= 0) {
                $tz = '+';
            } else {
                $tz = '-';
                $offset = -$offset;
            }

            $tz .= sprintf('%02d:%02d', floor($offset / 3600), round(($offset % 3600) / 60) );
            return date('Y-m-d\TH:i:s', $timestamp) . $tz;

        default :
            return Utils::strftime($format ? $format : $defaultFormat, $timestamp);
    }
}

/*
 * checkVars()
 *
 * @param    string    $variables
 * @return    void
 */

function checkVars($aVars) {

    foreach ($aVars as $varName) {
        if (   isset($_GET[$varName])
            || isset($_POST[$varName])
            || isset($_COOKIE[$varName])
            || isset($_ENV[$varName])
            || isset($_SESSION[$varName])
            || isset($_FILES[$varName])
        ) {
            die('Sorry. An error occurred.');
        }
    }
}

/**
 * Sanitize parameters such as $_GET and $_SERVER['REQUEST_URI'] etc.
 * to avoid XSS
 */
function sanitizeParams()
{
    $array = array();
    $str = '';
    $frontParam = '';

    // REQUEST_URI of $_SERVER
        $str =& $_SERVER['REQUEST_URI'];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);

    // QUERY_STRING of $_SERVER
    unset($str);
        $str =& $_SERVER['QUERY_STRING'];
        serverStringToArray($str, $array, $frontParam);
        sanitizeArray($array);
        arrayToServerString($array, $frontParam, $str);

    // $_GET
    convArrayForSanitizing($_GET, $array);
    sanitizeArray($array);
    revertArrayForSanitizing($array, $_GET);

    // $_REQUEST (only GET param)
    convArrayForSanitizing($_REQUEST, $array);
    sanitizeArray($array);
    revertArrayForSanitizing($array, $_REQUEST);
}

/**
 * Check ticket when not checked in plugin's admin page
 * to avoid CSRF.
 * Also avoid the access to plugin/index.php by guest user.
 */
function ticketForPlugin() {
    global $DIR_PLUGINS, $member, $ticketforplugin;

    /* initialize */
    $ticketforplugin = array('ticket'=>false);
    
    /* Check if using plugin's php file. */
    if ($p_translated = serverVar('PATH_TRANSLATED') )
    {
        if (!is_file($p_translated) )
        {
            $p_translated = '';
        }
    }
    
    if (!$p_translated)
    {
        $p_translated = serverVar('SCRIPT_FILENAME');
        if (!is_file($p_translated) )
        {
            header("HTTP/1.0 404 Not Found");
            exit('');
        }
    }
    
    $p_translated = str_replace('\\', '/', $p_translated);
    $d_plugins = str_replace('\\', '/', $DIR_PLUGINS);
    
    if (strpos($p_translated, $d_plugins) !== 0)
    {
        return;// This isn't plugin php file.
    }
    
    /* Solve the plugin php file or admin directory */
    $phppath = substr($p_translated, strlen($d_plugins) );
    $phppath = preg_replace('#^/#', '', $phppath); // Remove the first "/" if exists.

    // NP_Plugin.php , plugin/* , NP_Plugin/NP_Plugin.php
//  var_dump(__FUNCTION__, $phppath);
    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    $path = $phppath;
    if ( preg_match('#^NP_([^/]+)(/|$)#', $path, $m) || preg_match('#^[^/]*/+NP_([^/]+)(/|$)#', $path, $m) )
    {
        // Remove the first "NP_" and the last ".php" if exists.
        $unsecure_value = preg_replace('#\.php$#', '', $m[1]);
        $unsecure_plugin_name_short = strtolower($unsecure_value);
    }
    else
    {
        $unsecure_value = preg_replace('#(?:^|.+/)NP_([^/]*)\.php$#', '$1', $path); // Remove the first "NP_" and the last ".php" if exists.
        $unsecure_value = preg_replace('#^([^/]*)/(.*)$#', '$1', $unsecure_value); // Remove the "/" and beyond.
        $unsecure_plugin_name_short = strtolower($unsecure_value);
    }
//  var_dump(__FUNCTION__, $path);

    /* Solve the plugin name. */
    $plugins = array();
    $res = sql_query( parseQuery('SELECT `pfile` FROM [@prefix@]plugin') );

    if ($res)
    {
        while($row = sql_fetch_row($res) )
        {
            $name = substr($row[0], 3);
            $plugins[strtolower($name)] = $name;
        }
        sql_free_result($res);
    }
    
    if ($plugins[$unsecure_plugin_name_short])
    {
        $plugin_name = $plugins[$unsecure_plugin_name_short];
    }
    else if (in_array($unsecure_plugin_name_short, $plugins))
    {
        $plugin_name = $unsecure_plugin_name_short;
    }
    else
    {
        header("HTTP/1.0 404 Not Found");
        exit('');
    }
    
    /* Return if not index.php */
    if ( ($phppath != strtolower($plugin_name) . '/') && ($phppath != strtolower($plugin_name) . '/index.php') )
    {
        return;
    }

    /* Exit if not logged in. */
    if ( !$member->isLoggedIn() )
    {
        LoadCoreLanguage();
        if (!defined('_GFUNCTIONS_YOU_AERNT_LOGGEDIN'))
            define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN', 'You aren\'t logged in.');
        exit("<html><head><title>Error</title></head><body>"
                . _GFUNCTIONS_YOU_AERNT_LOGGEDIN
                . "<br><br>\n"
                . '<a href="javascript: back();">back</a>'
                . "</body></html>");
    }

    global $manager,$DIR_LANG;

    /* Check if this feature is needed (ie, if "$manager->checkTicket()" is not included in the script). */
    if (!($p_translated=serverVar('PATH_TRANSLATED')))
    {
        $p_translated=serverVar('SCRIPT_FILENAME');
    }
    if ($file = @file($p_translated) )
    {
        $prevline='';
        foreach($file as $line)
        {
            if (preg_match('/[\$]manager([\s]*)[\-]>([\s]*)checkTicket([\s]*)[\(]/i',$prevline.$line))
            {
                return;
            }
            $prevline=$line;
        }
    }
    
    /* Show a form if not valid ticket */
    if ( ( strstr(serverVar('REQUEST_URI'),'?') || serverVar('QUERY_STRING')
            || strtoupper(serverVar('REQUEST_METHOD'))=='POST' )
                && (!$manager->checkTicket()) )
    {
        if (!class_exists('PluginAdmin'))
        {
            LoadCoreLanguage();
            include_once(NC_LIBS_PATH . 'PLUGINADMIN.php');
        }
        
        $oPluginAdmin = new PluginAdmin($plugin_name);
        $oPluginAdmin->start();
        echo '<p>' . _ERROR_BADTICKET . "</p>\n";

        /* Show the form to confirm action */
        
        // Resolve URI and QUERY_STRING
        if ($uri=serverVar('REQUEST_URI'))
        {
            list($uri,$qstring)=explode('?',$uri);
        }
        else
        {
            if ( !($uri=serverVar('PHP_SELF')) )
            {
                $uri=serverVar('SCRIPT_NAME');
            }
            $qstring=serverVar('QUERY_STRING');
        }
        if ($qstring)
        {
            $qstring='?'.$qstring;
        }
        echo '<p>'._SETTINGS_UPDATE.' : '._QMENU_PLUGINS.' <span style="color:#f00;">'.hsc($plugin_name)."</span> ?</p>\n";
        switch(strtoupper(serverVar('REQUEST_METHOD')))
        {
            case 'POST':
                echo '<form method="POST" action="'.hsc($uri.$qstring).'">';
                $manager->addTicketHidden();
                $post= $_POST;
                _addInputTags($post);
                break;
            case 'GET':
                echo '<form method="GET" action="'.hsc($uri).'">';
                $manager->addTicketHidden();
                $get=  $_GET;
                _addInputTags($get);
                break;
        }
        echo '<input type="submit" value="'._YES.'" />&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<input type="button" value="'._NO.'" onclick="history.back(); return false;" />';
        echo "</form>\n";

        $oPluginAdmin->end();
        exit;
    }

    /* Create new ticket */
    $ticket=$manager->addTicketToUrl('');
    $ticketforplugin['ticket']=substr($ticket,strpos($ticket,'ticket=')+7);
}
function _addInputTags(&$keys,$prefix=''){
    foreach($keys as $key=>$value){
        if ($prefix) $key=$prefix.'['.$key.']';
        if (is_array($value)) _addInputTags($value,$key);
        else {
            if ($key === 'ticket') continue;
            echo '<input type="hidden" name="'.hsc($key).
                '" value="'.hsc($value).'" />'."\n";
        }
    }
}

/**
 * Convert the server string such as $_SERVER['REQUEST_URI']
 * to arry like arry['blogid']=1 and array['page']=2 etc.
 */
function serverStringToArray($str, &$array, &$frontParam)
{
    // init param
    $array = array();
    // split front param, e.g. /index.php, and others, e.g. blogid=1&page=2
    if (strpos($str, "?") !== false){
        list($frontParam, $args) = preg_split("/\?/", $str, 2);
    }
    else {
        $args = $str;
        $frontParam = "";
    }

    // If there is no args like blogid=1&page=2, return
    if (strpos($str, "=") === false && !strlen($frontParam)) {
        $frontParam = $str;
        return;
    }

    $array = explode("&", $args);
}

/**
 * Convert array like array['blogid'] to server string
 * such as $_SERVER['REQUEST_URI']
 */
function arrayToServerString($array, $frontParam, &$str)
{
    if (strpos($str, "?") !== false) {
        $str = $frontParam . "?";
    } else {
        $str = $frontParam;
    }
    if (count($array)) {
        $str .= implode("&", $array);
    }
}

/**
 * Sanitize array parameters.
 * This function checks both key and value.
 * - check key if it inclues " (double quote),  remove from array
 * - check value if it includes \ (escape sequece), remove remaining string
 */
function sanitizeArray(&$array)
{
    $excludeListForSanitization = array('query');
//    $excludeListForSanitization = array();

    foreach ($array as $k => $v) {

        // split to key and value
        if (strpos($v,'=')===false) {
            continue;
        }
        list($key, $val) = explode('=', $v, 2);

        // note that we must use addslashes here because this function is called before the db connection is made
        // and sql_real_escape_string needs a db connection
        $val = addslashes($val);

        // if $key is included in exclude list, skip this param
        if (!in_array($key, $excludeListForSanitization)) {

            // check value
            if (str_contains($val, '\\')) {
                list($val, $tmp) = explode('\\', $val);
            }

            // remove control code etc.
            $val = strtr($val, "\0\r\n<>'\"", "       ");

            // check key
            if (preg_match('/\"/i', $key)) {
                unset($array[$k]);
                continue;
            }

            // set sanitized info
            $array[$k] = sprintf("%s=%s", $key, $val);
        }
    }
}

/**
 * Convert array for sanitizeArray function
 */
function convArrayForSanitizing($src, &$array)
{
    $array = array();
    foreach ($src as $key => $val) {
        if (array_key_exists($key, $_GET)) {
            $array[] = sprintf("%s=%s", $key, $val);
        }
    }
}

/**
 * Revert array after sanitizeArray function
 */
function revertArrayForSanitizing($array, &$dst)
{
    foreach ($array as $v) {
        list($key, $val) = explode('=', $v, 2);
        $dst[$key] = $val;
    }
}

/**
 * Stops processing the request and redirects to the given URL.
 * - no actual contents should have been sent to the output yet
 * - the URL will be stripped of illegal or dangerous characters
 */
function redirect($url) {
    $url = preg_replace('|[^a-z0-9-~+_.?#=&;,/:@%*]|i', '', $url);
    header('Location: ' . $url);
    exit;
}

/**
 * Strip HTML tags from a string
 * This function is a bit more intelligent than a regular call to strip_tags(),
 * because it also deletes the contents of certain tags and cleans up any
 * unneeded whitespace.
 */
function stringStripTags ($string) {
    $string = preg_replace("/<del[^>]*>.+<\/del[^>]*>/isU", '', $string);
    $string = preg_replace("/<script[^>]*>.+<\/script[^>]*>/isU", '', $string);
    $string = preg_replace("/<style[^>]*>.+<\/style[^>]*>/isU", '', $string);
    $string = str_replace(array('>', '<'), array('> ', ' <'), $string);
    $string = strip_tags($string);
    $string = preg_replace("/\s+/", " ", $string);
    $string = trim($string);
    return $string;
}

/**
 * Make a string containing HTML safe for use in a HTML attribute
 * Tags are stripped and entities are normalized
 */
function stringToAttribute ($string) {
    $string = stringStripTags($string);
    $string = entity::named_to_numeric($string);
    $string = entity::normalize_numeric($string);

    if (strtoupper(_CHARSET) === 'UTF-8') {
        $string = entity::numeric_to_utf8($string);
    }

    $string = entity::specialchars($string, 'html');
    $string = entity::numeric_to_named($string);
    return $string;
}

/**
 * Make a string containing HTML safe for use in a XML document
 * Tags are stripped, entities are normalized and named entities are
 * converted to numeric entities.
 */
function stringToXML ($string) {
    $string = stringStripTags($string);
    $string = entity::named_to_numeric($string);
    $string = entity::normalize_numeric($string);

    if (strtoupper(_CHARSET) === 'UTF-8') {
        $string = entity::numeric_to_utf8($string);
    }

    $string = entity::specialchars($string, 'xml');
    return $string;
}

// START: functions from the end of file BLOG.php
// used for mail notification (html -> text)
function toAscii($html) {
    // strip off most tags
    $html = strip_tags($html,'<a>');
    $to_replace = "/<a[^>]*href=[\"\']([^\"^']*)[\"\'][^>]*>([^<]*)<\/a>/i";
    _links_init();
    $ascii = preg_replace_callback ($to_replace, '_links_add', $html);
    $ascii .= "\n\n" . _links_list();
    return strip_tags($ascii);
}

function _links_init() {
    global $tmp_links;
    $tmp_links = array();
}

function _links_add($match) {
    global $tmp_links;
    $tmp_links[] = $match[1];
    return $match[2] . ' [' . count($tmp_links) .']';
}

function _links_list() {
    global $tmp_links;
    $output = '';
    $i = 1;
    foreach ($tmp_links as $current) {
        $output .= "[$i] $current\n";
        $i++;
    }
    return $output;
}
// END: functions from the end of file BLOG.php

// START: functions from the end of file ADMIN.php
/**
 * @todo document this
 */
function encode_desc(&$data)
{
    $to_entities = get_html_translation_table(HTML_ENTITIES);

    $from_entities = array_flip($to_entities);

    $data = strtr($data,$from_entities);
    $data = strtr($data,$to_entities);

    return $data;
// jp
//    _$to_entities = get_html_translation_table(HTML_ENTITIES);
    $to_entities = get_html_translation_table(HTML_SPECIALCHARS,ENT_QUOTES); // for Japanese
    $from_entities = array_flip($to_entities);
    $data = str_replace('<br />', '\n', $data); //hack
    $data = strtr($data,$from_entities);
    $data = strtr($data,$to_entities);
    $data = str_replace('\n', '<br />', $data); //hack
    return $data;
}

/**
 * Returns the Javascript code for a bookmarklet that works on most modern browsers
 *
 * @param blogid
 */
function getBookmarklet($blogid) {
    global $CONF;

    // normal
    $document = 'document';
    $bookmarkletline = "javascript:Q='';x=".$document.";y=window;if(x.selection){Q=x.selection.createRange().text;}else if(y.getSelection){Q=y.getSelection();}else if(x.getSelection){Q=x.getSelection();}wingm=window.open('";
    $bookmarkletline .= $CONF['AdminURL'] . "bookmarklet.php?blogid=$blogid";
    $bookmarkletline .="&logtext='+escape(Q)+'&loglink='+escape(x.location.href)+'&loglinktitle='+escape(x.title),'nucleusbm','scrollbars=yes,width='+window.parent.screen.width*0.9+',height='+window.parent.screen.height*0.9+',left=10,top=10,status=yes,resizable=yes');wingm.focus();";

    return $bookmarkletline;
}
// END: functions from the end of file ADMIN.php

/**
 * Returns a variable or null if not set
 *
 * @param mixed Variable
 * @return mixed Variable
 */
function ifset(&$var)
{
    return isset($var) ? $var : null;
}

/**
 * Returns number of subscriber to an event
 *
 * @param event
 * @return number of subscriber(s)
 */
function numberOfEventSubscriber($event) {
    $ph['event'] = $event;
    $res = sql_query( parseQuery("SELECT COUNT(*) as count FROM `[@prefix@]plugin_event` WHERE event='[@event@]'", $ph) );
    if ($res && ($obj = sql_fetch_object($res)))
        return $obj->count;
    return 0; // unknown error
}

/**
 * sets $special global variable for use in index.php before selector()
 *
 * @param String id
 * @return nothing
 */
function selectSpecialSkinType($id) {
    global $special;
    $special = strtolower($id);
}

/**
 * cleans filename of uploaded file for writing to file system
 *
 * @param String str
 * @return String cleaned filename ready for use
 */
function cleanFileName($str) {
    $str = strtolower($str);
    $ext_point = strrpos($str,".");
    if ($ext_point===false) return false;
    $ext = substr($str,$ext_point,strlen($str));
    $str = substr($str,0,$ext_point);

    return preg_replace("/[^a-z0-9-]/","_",$str).$ext;
}

function escapeHTML($string,  $flags = ENT_QUOTES )
{
    return htmlspecialchars( $string , $flags , (defined('_CHARSET') ? _CHARSET : 'UTF-8') );
}

function strftimejp($format,$timestamp = ''){
    return Utils::strftime($format,$timestamp);
}

function hsc($string, $flags=ENT_QUOTES, $encoding='') {
    if($encoding==='')
    {
        if(defined('_CHARSET')) $encoding = _CHARSET;
        else                    $encoding = 'utf-8';
    }
    return htmlspecialchars($string, $flags, $encoding);
}

function coreSkinVar($key='')
{
    if (strtolower($key)==='<%benchmark%>') {
        global $SQLCount;
        return sprintf(
                    '%.3f sec / %d queries'
                    , (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'])
                    , $SQLCount
                );
    }

    if(strtolower($key)==='<%debuginfo%>') {
        global $SQLStack, $doActionStack;
        $tpl = '<div style="background-color:#fff;padding:1em;font-family:monospace;">%s</div>';
        return sprintf(
                    $tpl.$tpl
                    , join("<br />\n", $SQLStack)
                    , join("<br />\n", $doActionStack)
                );

    }

    return '';
}

function nucleus_version_compare($version1, $version2, $operator = '')
{
    // examples: 3.66  3.7  v3.7 v3.71
    $args = func_get_args();
    for($i = 0; $i<=1; $i++)
    {
        $args[$i] = str_replace(array('_','-','+','/'), '.', $args[$i]);
        $args[$i] = preg_replace('#^[^0-9]+#', '', $args[$i]);
        $ver = explode('.', $args[$i]);
        $major = (int)$ver[0];
        if ($major <= 3)
        {   // minor version
            $x = @(int)$ver[1];
            if ($x >= 10)
                $ver[1] = sprintf('%d.%d', $x / 10 , $x % 10);
            else
                $ver[1] = sprintf('%d.0', $x);
        }
        $args[$i] = implode('.', $ver);
    }
    return call_user_func_array('version_compare', $args);
}

// getPluginListsFromDirName
// Note: This function will may be specification change
// Note: use only core functions
// Notice: Do not call this function from user plugin
// return Plugin Lists on SearchDir
// mode  1 , 2 : all $lists
function getPluginListsFromDirName($SearchDir , &$status, $clearcache = false)
{
    static $lists = array();

    $status = array('result'=>false);
    $SearchDir = str_replace("\\", '/', $SearchDir);
    if ( strlen($SearchDir)>0 && substr($SearchDir, -1, 1) !== '/' )
        $SearchDir .= '/';

    if ( $clearcache && isset($lists[$SearchDir]) )
        unset($lists[$SearchDir]);
    if ( isset($lists[$SearchDir]) )
    {
        $status = array('result'=>true, 'is_cache'=>true);
        return $lists[$SearchDir];
    }
    if ( !is_dir($SearchDir) )
        return false;

    $lists[$SearchDir] = array();
    $items = &$lists[$SearchDir];

    $dirhandle = opendir($SearchDir);
    if ($dirhandle === false)
        return false;

    $status['is_cache'] = false;
    $status['result']   = true;

    // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
    while ( $filename = readdir($dirhandle) !== false)
    {
        $current_file = $SearchDir . $filename;
        $pattern_php = '#^NP_(.*)\.php$#';
        $pattern = '#^NP_(.*)$#';
        $item = array();

        $saved_type = 0;
        if (is_file($current_file))
        {  // NP_*.php
            // type 1 , old_admin_area
            if (!preg_match($pattern_php, $filename, $matches))
                continue;
            $name = $matches[1];
            $saved_type = 1;
            $item['dir'] = $SearchDir;
            $item['dir_admin'] = $SearchDir . strtolower($name) . '/';
            $item['php'] = $SearchDir . $filename;
        }
        else
        {  // directory
            if (in_array($filename, array('.','..'))) {
                continue;
            }
            if ( preg_match($pattern, $filename, $matches) )
            {
                // type 4 or 5
                $name = $matches[1];
                $pl_own_dir  = $current_file . '/';
                $pl_own_dir_plfile = sprintf('%s%s.php', $pl_own_dir, $filename);
                if (! (is_dir($pl_own_dir) && (is_file($pl_own_dir_plfile))) )
                    continue;
                $item['dir'] = $pl_own_dir;
                $item['php'] = $pl_own_dir_plfile;
                if ( is_dir($pl_own_dir . strtolower($name)) )
                {
                    $saved_type = 4;
                    $item['dir_admin'] = sprintf('%s%s/', $pl_own_dir, strtolower($name));
                }
                else
                {
                    $saved_type = 5;
                    $item['dir_admin'] = $pl_own_dir;
                }
            }
            else
            {
                // find shortname/NP_*.php
                $pat = '';
                foreach(str_split(strtolower($filename)) as $value)
                {
                    if ( ord($value) >= ord('a') && ord($value) <= ord('z') )
                        $pat .= sprintf('[%s%s]', $value, strtoupper($value)); // strtoupper($value)
                    else
                        $pat .= $value;
                }
                $files = glob(sprintf('%s/NP_%s.php', $current_file, $pat), GLOB_NOSORT);

                if ($files === false || count($files)==0)
                    continue;

                $sub_file = basename($files[0]);
                if ( !preg_match($pattern_php, $sub_file, $matches)) {
                    continue;
                }
                // type: 2 , old_admin_area
                $name = $matches[1];
                $shortname = strtolower($name);
                $saved_type = 2;
                $item['dir'] = $SearchDir;
                $item['php'] = sprintf('%s%s/%s', $SearchDir, $filename, $sub_file);
                $item['dir_admin'] = sprintf('%s%s/', $SearchDir, $filename);
                if (  is_dir(sprintf('%s%s/%s', $SearchDir, $filename, $shortname)))
                {
                    $saved_type = 3;
                    $item['dir_admin'] = sprintf('%s%s/%s/', $SearchDir, $filename, $shortname);
                }
            }
        }

        if ( $saved_type )
        {
            $shortname = strtolower($name);
            $item['name'] = $name;
            $item['shortname'] = $shortname;
            $item['class_name'] = 'NP_' . $name;
            $item['feature_dir_type'] = $saved_type; // type of Plugin Folder , 0: unkown, 1: normal, 2: has own dir
            if ( isset($items[$shortname]) )
            {
                // Note: duplication : show error or add log ?
                if ( $saved_type >= $items[$shortname]['feature_dir_type'] )
                    continue;
            }
            unset($items[$shortname]);
            $items[$shortname] = &$item;
            unset($item);
        }
    }
    closedir($dirhandle);

    ksort($items);
    return $items;
}

function init_nucleus_compatibility_mysql_handler()
{
    // added for 3.5 sql_* wrapper
    global $MYSQL_HANDLER;
    if (!isset($MYSQL_HANDLER)) {
        $MYSQL_HANDLER = array('mysql','');
    }
    elseif ($MYSQL_HANDLER[0] == '') {
        $MYSQL_HANDLER[0] = 'mysql'; // end new for 3.5 sql_* wrapper
    }

    global $DB_PREFIX , $MYSQL_PREFIX;
    if ( !isset($DB_PREFIX) || !is_string($DB_PREFIX) )
        if (isset($MYSQL_PREFIX) && $MYSQL_PREFIX) {
            $DB_PREFIX = $MYSQL_PREFIX;
        } else {
            $DB_PREFIX = '';
        }

    global $DB_HOST , $MYSQL_HOST;
    if ( !isset($DB_HOST) || !is_string($DB_HOST) ) {
        $DB_HOST = $MYSQL_HOST ?: '';
    }

    global $DB_USER , $MYSQL_USER;
    if ( !isset($DB_USER) || !is_string($DB_USER) ) {
        $DB_USER = $MYSQL_USER ?: '';
    }

    global $DB_PASSWORD , $MYSQL_PASSWORD;
    if ( !isset($DB_PASSWORD) || !is_string($DB_PASSWORD) ) {
        $DB_PASSWORD = $MYSQL_PASSWORD ?: '';
    }

    global $DB_DATABASE , $MYSQL_DATABASE;
    if ( !isset($DB_DATABASE) || !is_string($DB_DATABASE) ) {
        $DB_DATABASE = $MYSQL_DATABASE ?: '';
    }

    $MYSQL_PREFIX   = @$DB_PREFIX;
    $MYSQL_HOST     = @$DB_HOST;
    $MYSQL_USER     = @$DB_USER;
    $MYSQL_PASSWORD = @$DB_PASSWORD;
    $MYSQL_DATABASE = @$DB_DATABASE;

    global $DB_PHP_MODULE_NAME;
    if (!isset($DB_PHP_MODULE_NAME)) {
        $DB_PHP_MODULE_NAME = 'pdo';
        $DB_PHP_MODULE_NAME = strtolower($DB_PHP_MODULE_NAME);
    }

    global $MYSQL_HANDLER , $DB_DRIVER_NAME;
    if (!isset($DB_DRIVER_NAME))
    {
//        if ($MYSQL_HANDLER[0] == 'mysql')
//            trigger_error("Deprecated : use sql_ instead of mysql_ . ", E_USER_DEPRECATED);
        if ( isset($MYSQL_HANDLER) )
        {
            if (
                ( is_string($MYSQL_HANDLER) && ($MYSQL_HANDLER === 'mysql') )
                ||
                ( is_array($MYSQL_HANDLER) && (strtolower($MYSQL_HANDLER[0]) === 'mysql') )
            )
            {
//                trigger_error("Critical Error : not allow mysql_ function. ", E_USER_ERROR);
                $DB_PHP_MODULE_NAME = 'mysql';
                $DB_DRIVER_NAME = 'mysql';
            }

            if ( !isset($DB_DRIVER_NAME) )
            {
                if ( is_array($MYSQL_HANDLER)
                && (strtolower($MYSQL_HANDLER[0]) === 'pdo')
                && isset($MYSQL_HANDLER[1])
                )
                    $DB_DRIVER_NAME = $MYSQL_HANDLER[1];
                else
                    $DB_DRIVER_NAME = 'mysql';
            }
        }
    }
    $DB_DRIVER_NAME = strtolower($DB_DRIVER_NAME);
    // check invalid parameter
    if ($DB_DRIVER_NAME === 'sqlite')
    {
        $DB_PHP_MODULE_NAME = 'pdo';
//        echo "Error::config , Not implemented yet. Invalid db driver name.";
//        exit;
    }
    if (!in_array($DB_PHP_MODULE_NAME, array('pdo', 'mysql'))) {
        $DB_PHP_MODULE_NAME = 'pdo';
    }
    if (!in_array($DB_DRIVER_NAME, array('mysql', 'sqlite')))
    {
//        $DB_DRIVER_NAME = 'mysql';
        echo "Error::config Invalid db driver name.";
        exit;
    }
    if ($DB_PHP_MODULE_NAME === 'mysql')
        $MYSQL_HANDLER = array('mysql', '');
    else
        $MYSQL_HANDLER = array($DB_PHP_MODULE_NAME, $DB_DRIVER_NAME);
}

function checkBrowserLang($locale)
{
    if(!serverVar('HTTP_ACCEPT_LANGUAGE')) {
        return false;
    }

    static $check = array();

    if (isset($check[$locale])) {
        return $check[$locale];
    }

    $check[$locale] = false;

    $items = explode(',', strtolower(serverVar('HTTP_ACCEPT_LANGUAGE')));

    $http_lang = array_map('substr', $items, array(0, 2));
    $check[$locale] = in_array(strtolower($locale), $http_lang);
    return $check[$locale];
}

function getValidLanguage($lang)
{
    global $DB_DRIVER_NAME;

    $pattern_replace = '#-[^\-]*$#i';
    if ( $DB_DRIVER_NAME !== 'mysql'
        ||
        (defined('_CHARSET') && constant('_CHARSET') === 'UTF-8')
    ) {
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';
    }

    if ( preg_match('#-utf8$#i', $lang) ) {
        if ( checkLanguage($lang) )
            return $lang;
        if (checkBrowserLang('ja') && checkLanguage('japanese-utf8'))
            return 'japanese-utf8';
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';
        if ( checkLanguage($lang) )
            return $lang;
        return 'english-utf8';
    }

    // non utf-8
    if (checkBrowserLang('ja')) {
        if (stripos($lang, 'japanese') === 0 && checkLanguage($lang))
            return $lang;
        $lang = preg_replace($pattern_replace, '', $lang) . '-utf8';
    }

    if ( checkLanguage($lang) )
        return $lang;
    return 'english-utf8';
}

function parseText($tpl='',$ph=array()) { // $ph is placeholders
    
    if(!is_array($ph)) {
        $ph = func_get_args();
    }
    
    foreach($ph as $k=>$v) {
        if(!str_contains($tpl,'<%')) break;
        $tpl = str_replace("<%{$k}%>", $v, $tpl);
    }
    return $tpl;
}

function parseHtml($html='',$ph=array()) { // $ph is placeholders
    
    if(!is_array($ph)) {
        $ph = func_get_args();
    }
    
    $esc = md5($_SERVER['REQUEST_TIME_FLOAT'].mt_rand());
    
    foreach($ph as $k=>$v) {
        if(!str_contains($html,'{%')) break;
        
        if(str_contains($v,'{%')) {
            $v = str_replace('{%',"[{$esc}%",$v);
        }
        $html = str_replace("{%{$k}%}", $v, $html);
        if(str_contains($html,"{%{$k}:hsc%}"))
        {
            $html = str_replace("{%{$k}:hsc%}", hsc($v), $html);
        }
        if(str_contains($html,"{%{$k}:urlencode%}"))
        {
            $html = str_replace("{%{$k}:urlencode%}", urlencode($v), $html);
        }
    }
    if(str_contains($html,'{'.$esc.'%')) {
        $html = str_replace('{'.$esc.'%','{%',$html);
    }
    return $html;
}

function parseQuery($query='',$ph=array()) { // $ph is placeholders

    if(is_array($query)) {
        $query = join("\n", $query);
    }
    
    if(str_contains($query,'<%')) {
        $query = str_replace(array('<%','%>'), array('[@','@]'), $query);
    }
    
    if(!is_array($ph)) {
        $ph = func_get_args();
    }
    
    if(!isset($ph['prefix'])) $ph['prefix'] = sql_table();
    $esc = md5($_SERVER['REQUEST_TIME_FLOAT'].mt_rand());
    foreach($ph as $k=>$v) {
        
        if(!str_contains($query,'[@')) break;
        
        if(str_contains($v,'[@')) {
            $v = str_replace('[@',"[{$esc}@",$v);
        }
        $query = str_replace("[@{$k}@]", $v, $query);
        if(str_contains($query,"[@{$k}:escape@]"))
        {
            $query = str_replace("[@{$k}:escape@]", sql_real_escape_string($v), $query);
        }
        if(str_contains($query,"[@{$k}:int@]"))
        {
            $query = str_replace("[@{$k}:int@]", (int)$v, $query);
        }
    }
    if(str_contains($query,"[{$esc}@")) {
        $query = str_replace("[{$esc}@",'[@',$query);
    }
    return $query;
}

function parseQuickQuery($query='',$ph=array()) {
    return quickQuery(parseQuery($query,$ph));
}

function loadCoreClassFor_spl($classname) {
    if (@is_file(__DIR__ . "/{$classname}.php"))
        require_once __DIR__ . "/{$classname}.php";
}

function loadCoreClassFor_spl_prephp53($classname) { // for PHP 5.1.0 - 5.2
    if (@is_file(NC_LIBS_PATH."{$classname}.php"))
        require_once (NC_LIBS_PATH."{$classname}.php");
}

if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc() { return false; }
}
if (!function_exists('get_magic_quotes_runtime')) {
    function get_magic_quotes_runtime() { return false; }
}

function checkOutputCompression($content_type) {
    // supports Content-Encoding: gzip
    if (!extension_loaded('zlib') || headers_sent() || ob_get_level())
        return;
    $output_compression = ini_get('zlib.output_compression');
    // check false or '' or '0'
    if ($output_compression === false || $output_compression === ''
        || $output_compression === '0')
    {
        // check browser bug : see detail https://httpd.apache.org/docs/2.4/ja/mod/mod_deflate.html#enable
        if (!empty($_SERVER['HTTP_USER_AGENT'])
            && preg_match('@^Mozilla/4@i', $_SERVER['HTTP_USER_AGENT'])
            && (stripos("MSIE", $_SERVER['HTTP_USER_AGENT'])===false))
        {
            if (preg_match('@^Mozilla/4\.0[678]@i', $_SERVER['HTTP_USER_AGENT']))
                return;
            if (strcasecmp($content_type, "text/html") != 0)
                return;
        }
        // start zlib compression
        ini_set('zlib.output_compression_level', -1);
        ob_start("ob_gzhandler");
    }
}

function str_contains($haystack, $needle) {
    $pos = strpos($haystack, $needle);
    if($pos!==false) return true;
    return false;
}

function str_contain($haystack, $needle) {
    return str_contains($haystack, $needle);
}

function getBaseUrl() {
    $_ = dirname($_SERVER['SCRIPT_NAME']);
    if (in_array($_, array('/install','/nucleus','/_upgrades')))
    {
        return '/';
    }
    return substr($_, 0, strrpos($_,'/')+1);
}


function _checkEnv() {
    if(ini_get('register_globals')) {
        exit('Should be change off register_globals.');
    }
    if(get_magic_quotes_runtime() || ini_get('magic_quotes_gpc')) {
        exit('Should be change php.ini: magic_quotes_gpc=0');
    }
    if(ini_get('magic_quotes_sybase')) {
        exit('Should be remove magic_quotes_sybase in php.ini');
    }
}

function _setDefaultUa() {
    $default_user_agent = array('ie' => array());
    $default_user_agent['ie']['7']   = 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko';
    $default_user_agent['ie']['8.1'] = 'Mozilla/5.0 (Windows NT 6.3; Win64, x64; Trident/7.0; Touch; rv:11.0) like Gecko';
    $default_user_agent['ie']['11']  = 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko';
    $default_user_agent['default'] = &$default_user_agent['ie']['11'];
    // http://msdn.microsoft.com/ja-jp/library/ie/hh869301%28v=vs.85%29.aspx
    if ( ! defined('DEFAULT_USER_AGENT') )
        define('DEFAULT_USER_AGENT' , $default_user_agent['default']);
    ini_set( 'user_agent' , DEFAULT_USER_AGENT );
}

function _setErrorReporting() {
    global $CONF;
    if (isset($CONF['debug'])&&!empty($CONF['debug'])) {
        error_reporting(E_ALL); // report all errors!
        ini_set('display_errors', 1);
    } else {
        if(!isset($CONF['UsingAdminArea'])||empty($CONF['UsingAdminArea']))
            ini_set('display_errors','0');
        if (!defined('E_DEPRECATED')) define('E_DEPRECATED', 8192);
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    }
}

function _setTimezone() {
    $timezone = @date_default_timezone_get();
    if (!$timezone) {
        $timezone = 'UTC';
    }
    @date_default_timezone_set($timezone);
}

function setDefaultConf() {
    global $CONF;
    /*
        Indicates when Nucleus should display startup errors. Set to 1 if you want
        the error enabled (default), false otherwise

        alertOnHeadersSent
            Displays an error when visiting a public Nucleus page and headers have
            been sent out to early. This usually indicates an error in either a
            configuration file or a language file, and could cause Nucleus to
            malfunction
        alertOnSecurityRisk
            Displays an error only when visiting the admin area, and when one or
            more of the installation files (install.php, install.sql, _upgrades/
            directory) are still on the server.
    */

    if (!isset($CONF['alertOnHeadersSent']) || empty($CONF['alertOnHeadersSent']))
    {
        $CONF['alertOnHeadersSent']  = 1;
    }
    if(!isset($CONF['alertOnSecurityRisk'])) $CONF['alertOnSecurityRisk'] = 1;

    /*
        Set these to 1 to allow viewing of future items or draft items
        Should really never do this, but can be useful for some plugins that might need to
        Could cause some other issues if you use future posts otr drafts
        So use with care
    */
    $CONF['allowDrafts'] = 0;
    $CONF['allowFuture'] = 0;

    // Avoid notices
    if (!isset($CONF['installscript'])) {
        $CONF['installscript'] = 0;
    }

    if (!isset($CONF['expose_generator'])) {
        $CONF['expose_generator'] = false;
    }

    // Avoid notices
    if (!isset($CONF['UsingAdminArea'])) {
        $CONF['UsingAdminArea'] = 0;
    }
    if ($CONF['URLMode'] === 'pathinfo') {
        // initialize keywords if this hasn't been done before
        if (!isset($CONF['ItemKey']) || $CONF['ItemKey'] == '') {
            $CONF['ItemKey'] = 'item';
        }

        if (!isset($CONF['ArchiveKey']) || $CONF['ArchiveKey'] == '') {
            $CONF['ArchiveKey'] = 'archive';
        }

        if (!isset($CONF['ArchivesKey']) || $CONF['ArchivesKey'] == '') {
            $CONF['ArchivesKey'] = 'archives';
        }

        if (!isset($CONF['MemberKey']) || $CONF['MemberKey'] == '') {
            $CONF['MemberKey'] = 'member';
        }

        if (!isset($CONF['BlogKey']) || $CONF['BlogKey'] == '') {
            $CONF['BlogKey'] = 'blog';
        }

        if (!isset($CONF['CategoryKey']) || $CONF['CategoryKey'] == '') {
            $CONF['CategoryKey'] = 'category';
        }

        if (!isset($CONF['SpecialskinKey']) || $CONF['SpecialskinKey'] == '') {
            $CONF['SpecialskinKey'] = 'special';
        }
    }
}