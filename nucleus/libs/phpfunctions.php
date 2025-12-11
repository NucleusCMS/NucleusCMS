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

if ( ! function_exists('str_contains')) { // added PHP 8
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if ( ! function_exists('str_starts_with')) { // added PHP 8
    function str_starts_with(string $haystack, string $needle): bool
    {
        $needle_length = strlen($needle);
        return 0 === $needle_length || 0 === strncmp($haystack, $needle, $needle_length);
    }
}

if ( ! function_exists('str_ends_with')) { // added PHP 8
    function str_ends_with(string $haystack, string $needle): bool
    {
        $needle_length = strlen($needle);
        if (0 === $needle_length) {
            return true;
        }

        return $needle_length <= strlen($haystack)
            && substr($haystack, -$needle_length) === $needle;
    }
}
