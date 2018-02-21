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
 */

function getVar($name, $default='') {
    if (!isset($_GET[$name])) {
        return $default;
    }

    return undoMagic($_GET[$name]);
}

function postVar($name, $default='') {
    if (!isset($_POST[$name])) {
        return $default;
    }

    return undoMagic($_POST[$name]);
}

function cookieVar($name, $default='') {
    if (!isset($_COOKIE[$name])) {
        return $default;
    }

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

function serverVar($name, $default=false) {
    if (!isset($_SERVER[$name])) {
        return $default;
    }

    return $_SERVER[$name];
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
    return is_array($data) ? array_map('undoSybaseQuotes_array', $data) : str_replace("''", "'", $data);
}

function undoSybaseQuotes($data) {
    return str_replace("''", "'", $data);
}

// integer array from request
function requestIntArray($name) {
    if (!isset($_REQUEST[$name])) {
        return;
    }

    return $_REQUEST[$name];
}

// array from request. Be sure to call undoMagic on the strings inside
function requestArray($name) {
    if (!isset($_REQUEST[$name])) {
        return;
    }

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
    if (!isset($_FILES[$name])) {
        return false;
    }

    return $_FILES[$name];
}

function setOldAction($value) {
    $_POST['oldaction'] = $value;
}
