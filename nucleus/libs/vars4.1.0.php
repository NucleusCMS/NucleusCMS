<?php

/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * $Id$
  */
  
function getVar($name) {
	return undoMagic($_GET[$name]);
}

function postVar($name) {
	return undoMagic($_POST[$name]);
}

function cookieVar($name) {	
	return undoMagic($_COOKIE[$name]);
}

function requestVar($name) {
	if(array_key_exists($name,$_REQUEST))
		return undoMagic($_REQUEST[$name]);
	elseif( array_key_exists($name,$_GET))   
		return undoMagic($_GET[$name]);
	elseif( array_key_exists($name,$_POST))   
		return undoMagic($_POST[$name]);
	else
		return;
}

function serverVar($name) {
	return $_SERVER[$name];
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
	return $_REQUEST[$name];	
}

// array from request. Be sure to call undoMagic on the strings inside
function requestArray($name) {
	return $_REQUEST[$name];	
}

// add all the variables from the request as hidden input field
// @see globalfunctions.php#passVar
function passRequestVars() {
	foreach ($_REQUEST as $key => $value) {
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
	return $_FILES[$name];
}

function setOldAction($value) {
	$_POST['oldaction'] = $value;	
}

?>