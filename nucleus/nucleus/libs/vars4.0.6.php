<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

/**
  * The purpose of the functions below is to avoid declaring HTTP_ vars to be global
  * everywhere, plus to offer support for php versions before 4.1.0, that do not
  * have the _GET etc vars
  */
function getVar($name) {
	global $HTTP_GET_VARS;

	if (!isset($HTTP_GET_VARS[$name])) {
		return;
	}

	return undoMagic($HTTP_GET_VARS[$name]);
}

function postVar($name) {
	global $HTTP_POST_VARS;

	if (!isset($HTTP_POST_VARS[$name])) {
		return;
	}

	return undoMagic($HTTP_POST_VARS[$name]);
}

function cookieVar($name) {
	global $HTTP_COOKIE_VARS;

	if (!isset($HTTP_COOKIE_VARS[$name])) {
		return;
	}

	return undoMagic($HTTP_COOKIE_VARS[$name]);
}

// request: either POST or GET
function requestVar($name) {
	return (postVar($name)) ? postVar($name) : getVar($name);
}

function serverVar($name) {
	global $HTTP_SERVER_VARS;

	if (!isset($HTTP_SERVER_VARS[$name])) {
		return;
	}

	return $HTTP_SERVER_VARS[$name];
}

// removes magic quotes if that option is enabled
function undoMagic($data) {
	if (!get_magic_quotes_gpc())
		return $data;
	if (ini_get('magic_quotes_sybase') != 1)
		return stripslashes_array($data);
	else
		return undoSybaseQuotes_array($data);
}

function stripslashes_array($data) {
	return is_array($data) ? array_map('stripslashes_array', $data) : stripslashes($data);
}

function undoSybaseQuotes_array($data) {
	return is_array($data) ? array_map('undoSybaseQuotes', $data) : stripslashes($data);
}

function undoSybaseQuotes($data) {
	return str_replace("''", "'", $data);
}

// integer array from request
function requestIntArray($name) {
	global $HTTP_POST_VARS;

	if (!isset($HTTP_POST_VARS[$name])) {
		return;
	}

	return $HTTP_POST_VARS[$name];
}

// array from request. Be sure to call undoMagic on the strings inside
function requestArray($name) {
	global $HTTP_POST_VARS;

	if (!isset($HTTP_POST_VARS[$name])) {
		return;
	}

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

	if (!isset($HTTP_POST_FILES[$name])) {
		return;
	}

	return $HTTP_POST_FILES[$name];
}

function setOldAction($value) {
	global $HTTP_POST_VARS;
	$HTTP_POST_VARS['oldaction'] = $value;
}

?>