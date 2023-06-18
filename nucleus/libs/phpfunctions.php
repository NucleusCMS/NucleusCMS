<?php

if ( ! defined('_PHPFUNCTIONS_PHP_')) {
    define('_PHPFUNCTIONS_PHP_', 1);
}

if ( ! function_exists('get_magic_quotes_gpc')) {  // removed function PHP[ - 7.4]
    function get_magic_quotes_gpc(): bool
    {
        return false;
    }
}

if ( ! function_exists('get_magic_quotes_runtime')) { // removed function
    function get_magic_quotes_runtime(): bool
    {
        return false;
    }
}

if ( ! function_exists('each')) { // removed function PHP[ - 7.4]
    function each(&$array)
    {
        $value = current($array);
        $key   = key($array);
        if (null === $key) {
            return false;
        }
        next($array);
        return [1 => $value, 'value' => $value, 0 => $key, 'key' => $key];
    }
}

define('USER_FUNCTION_STRFTIME', ! function_exists('strftime'));
if (USER_FUNCTION_STRFTIME) {
    // strftime : deprecated PHP[8.1-] / removed from PHP9.0 ?
    // strftime(string $format, ?int $timestamp = null): string|false
    function strftime(string $format, ?int $timestamp = null): string|false
    {
        static $checked = false;
        if ( ! $checked && ! class_exists('Utils')) {
            include_once(__DIR__ . '/Utils.php');
            $checked = true;
        }
        return Utils::date_with_strftime_format($format, $timestamp);
    }
}
