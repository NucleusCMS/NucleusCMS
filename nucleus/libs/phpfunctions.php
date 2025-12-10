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

// PHP 8.0 string helper polyfills
if ( ! function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if ( ! function_exists('str_starts_with')) {
    function str_starts_with(string $haystack, string $needle): bool
    {
        return '' === $needle || 0 === strncmp($haystack, $needle, strlen($needle));
    }
}

if ( ! function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool
    {
        if ('' === $needle) {
            return true;
        }

        $needleLength = strlen($needle);
        return $needleLength <= strlen($haystack)
            && 0 === substr_compare($haystack, $needle, -$needleLength);
    }
}
