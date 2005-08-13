<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2005 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2005 The Nucleus Group
 * @version $Id: vars4.0.6.php,v 1.6 2005-08-13 07:33:02 kimitake Exp $
 * $NucleusJP: vars4.0.6.php,v 1.5 2005/03/12 06:19:05 kimitake Exp $
 */
  
/**
  * The purpose of the functions below is to avoid declaring HTTP_ vars to be global
  * everywhere, plus to offer support for php versions before 4.1.0, that do not
  * have the _GET etc vars
  */
function getVar($name) {
	global $HTTP_GET_VARS;
	return undoMagic($HTTP_GET_VARS[$name]);
}

function postVar($name) {
	global $HTTP_POST_VARS;
	return undoMagic($HTTP_POST_VARS[$name]);
}

function cookieVar($name) {	
	global $HTTP_COOKIE_VARS;
	return undoMagic($HTTP_COOKIE_VARS[$name]);
}

// request: either POST or GET
function requestVar($name) {
	return (postVar($name)) ? postVar($name) : getVar($name);
}

function serverVar($name) {
	global $HTTP_SERVER_VARS;
	return $HTTP_SERVER_VARS[$name];
}

// removes magic quotes if that option is enabled
function undoMagic($data) {
	return get_magic_quotes_gpc() ? stripslashes_array($data) : $data;
}

function stripslashes_array($data) {
	return is_array($data) ? array_map('stripslashes', $data) : stripslashes($data);
}

// integer array from request
function requestIntArray($name) {
	global $HTTP_POST_VARS;
	return $HTTP_POST_VARS[$name];	
}

// array from request. Be sure to call undoMagic on the strings inside
function requestArray($name) {
	global $HTTP_POST_VARS;
	return $HTTP_POST_VARS[$name];	
}


// add all the variables from the request as hidden input field
// @see globalfunctions.php#passVar
function passRequestVars() {
	global $HTTP_POST_VARS, $HTTP_GET_VARS;
	foreach ($HTTP_POST_VARS as $key => $value) {
		if (($key == 'action') && ($value != requestVar('nextaction')))
			$key = 'nextaction';
		// a nextaction of 'showlogin' makes no sense
		if (($key == 'nextaction') && ($value == 'showlogin'))
			continue;
		if (($key != 'login') && ($key != 'password'))
			passVar($key, $value);
	}
	foreach ($HTTP_GET_VARS as $key => $value) {
		if (($key == 'action') && ($value != requestVar('nextaction')))
			$key = 'nextaction';
		// a nextaction of 'showlogin' makes no sense
		if (($key == 'nextaction') && ($value == 'showlogin'))
			continue;
		if (($key != 'login') && ($key != 'password'))
			passVar($key, $value);
	}
}

function postFileInfo($name) {
	global $HTTP_POST_FILES;
	return $HTTP_POST_FILES[$name];
}

function setOldAction($value) {
	global $HTTP_POST_VARS;
	$HTTP_POST_VARS['oldaction'] = $value;	
}

?>
