<?php
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
	return get_magic_quotes_gpc() ? stripslashes($data) : $data;
}

// integer array from request
function requestIntArray($name) {
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
		if (($key != 'login') && ($key != 'password'))
			passVar($key, $value);
	}
	foreach ($HTTP_GET_VARS as $key => $value) {
		if (($key == 'action') && ($value != requestVar('nextaction')))
			$key = 'nextaction';
		if (($key != 'login') && ($key != 'password'))
			passVar($key, $value);
	}
	
}


?>