<?php
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
	return undoMagic($_REQUEST[$name]);
}

function serverVar($name) {
	return $_SERVER[$name];
}

// removes magic quotes if that option is enabled
function undoMagic($data) {
	return get_magic_quotes_gpc() ? stripslashes($data) : $data;
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
		if (($key != 'login') && ($key != 'password'))
			passVar($key, $value);
	}
}


?>