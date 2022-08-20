<?php

if (!defined('PHP_VERSION_ID')) { // PHP[5.2.7 -]
    $v = explode('.', PHP_VERSION);
    define('PHP_VERSION_ID', $v[0]*10000 + $v[1]*100 + $v[2]);
    unset($v);
}

if (! function_exists('get_magic_quotes_gpc')) {  // removed function PHP[ - 7.4]
    function get_magic_quotes_gpc()
    {
        return false;
    }
}
if (! function_exists('get_magic_quotes_runtime')) {
    function get_magic_quotes_runtime()
    {
        return false;
    }
}

