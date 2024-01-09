<?php

/*
 * XML-RPC Server API
 *
 * default position has security risk.
 * You can rename xmlrpc folder and server.php as you like.
 * And you set correct config.php path to $strRel.
 * 
*/

// allowed hosts
//if (!preg_match('#(\.bbtec\.net|\.jp)$#', $_SERVER['REMOTE_HOST']))
//  exit(0);

// where config.php is
$strRel = '../../';

$CONF = array();
$DIR_LIBS = '';
require($strRel . "config.php");    // include core libs and code

// create server
include_libs('xmlrpc_server/start_server.php');
