<?php

if (! function_exists('get_magic_quotes_gpc')) {
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

if (!function_exists('str_contains')) {
    // str_contains [PHP8 - ] : for PHP5, PHP7 / ext/standard/string.c php_memnstr
    // Note: This function returns true if the needle string is empty.
    function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false; // don't localize
        // result = bool(true)  : php -nr "var_dump(str_contains('',''));"
        // result = bool(true)  : php -nr "var_dump(str_contains('0',''));"
        // result = bool(false) : php -nr "var_dump(str_contains('','0'));"
        // result = bool(true)  : php -nr "$haystack='';$needle='';var_dump(strpos($haystack, $needle) !== false);"
        // result = bool(true)  : php -nr "$haystack='0';$needle='';var_dump(strpos($haystack, $needle) !== false);"
        // result = bool(false) : php -nr "$haystack='';$needle='0';var_dump(strpos($haystack, $needle) !== false);"
    }
}

if (!function_exists('str_starts_with')) {
    // str_contains [PHP8 - ] : for PHP5, PHP7 / ext/standard/string.c zend_string_starts_with
    // Note: This function returns true if the needle string is empty.
    function str_starts_with($haystack, $needle)
    {
        return strncmp($haystack, $needle, strlen($needle)) === 0; // don't localize
        // result = bool(true)  : php -nr "var_dump(str_starts_with('',''));"
        // result = bool(true)  : php -nr "var_dump(str_starts_with('0',''));"
        // result = bool(false) : php -nr "var_dump(str_starts_with('','0'));"
        // result = bool(true)  : php -nr "var_dump(strncmp('','', 0) === 0);"
        // result = bool(true)  : php -nr "var_dump(strncmp('0','', 0) === 0);"
        // result = bool(false) : php -nr "var_dump(strncmp('','0', 1) === 0);"
    }
}

if (!function_exists('str_ends_with')) {
    // str_contains [PHP8 - ] : for PHP5, PHP7 / ext/standard/string.c if len , memcmp
    // Note: This function returns true if the needle string is empty.
    function str_ends_with($haystack, $needle)
    {
        if (strlen($needle) > strlen($haystack)) {
            return false; // don't localize
        }
        return strlen($needle) === 0 || substr($haystack, -strlen($needle)) === $needle;
        // result = bool(true)  : php -nr "var_dump(str_ends_with('',''));"
        // result = bool(true)  : php -nr "var_dump(str_ends_with('0',''));"
        // result = bool(true)  : php -nr "var_dump(str_ends_with('1',''));"
        // result = bool(false) : php -nr "var_dump(str_ends_with('','0'));"
    }
}