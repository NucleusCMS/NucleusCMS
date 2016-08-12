<?php

// Utils::convert_encoding()
// Utils::mail()
// Utils::strftime
// Utils::strlen

if (!defined('_HAS_MBSTRING'))
    define('_HAS_MBSTRING', extension_loaded('mbstring'));

class Utils
{
    function __construct() {

    }

    //  bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
    public static function mail($to, $subject, $message)
    {
        $args = func_get_args();

        // bool mb_send_mail ( string $to , string $subject , string $message [, string $additional_headers = NULL [, string $additional_parameter = NULL ]] )
        // bool         mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )

        if (!_HAS_MBSTRING || ('iso-8859-1' == strtolower(_CHARSET)))
        {
            if ('utf-8' == strtolower(_CHARSET)
                && (!isset($args[3]) || (FALSE===stripos($args[3], 'utf-8'))))
            {
                $additional_headers = 'Content-Type: text/plain; charset=utf-8';
                if (isset($args[3]))
                    $args[3] = rtrim($args[3]) . "\n" . $additional_headers;
                else
                    $args[3] = $additional_headers;
            }
            return call_user_func_array('mail', $args);
        }
        else
        {
            $mb_lang = 'uni';
            if ('utf-8' != strtolower(_CHARSET))
            {
                $lang = strtolower(str_replace(array('\\','/'), '', getLanguageName()));
                if (stripos('japanese', $lang) !== FALSE)
                   $mb_lang = 'ja';
//                else if ('iso-8859-1' == strtolower(_CHARSET))
//                   $mb_lang = 'en';
            }
            mb_language($mb_lang); // Valid languages are "Japanese", "ja","English","en" , "uni"
            mb_internal_encoding(_CHARSET);
            return call_user_func_array('mb_send_mail', $args);
        }
    }

    public static function strftime($format, $timestamp = '')
    {
        if (! _HAS_MBSTRING )
            return strftime($format, $timestamp);
        $locale = setlocale(LC_CTYPE, 0);
        if ((setlocale(LC_CTYPE, 0) == 'Japanese_Japan.932')) {
            return mb_convert_encoding(strftime(mb_convert_encoding($format, 'CP932', _CHARSET), $timestamp), _CHARSET, 'CP932');
        //      return iconv('CP932', _CHARSET, strftime(iconv(_CHARSET, 'CP932', $format),$timestamp));
        }
//var_dump(setlocale(LC_CTYPE, 0),setlocale(LC_TIME, 0), $format, $timestamp, strftime($format, $timestamp), mb_internal_encoding()); // debug
        if (PHP_OS=='CYGWIN')
            setlocale(LC_TIME , sprintf('%s.%s', _LOCALE, _CHARSET));
        return strftime($format, $timestamp);
    }

    public static function strlen($string)
    {
        if (_HAS_MBSTRING)
            return mb_strlen($string, _CHARSET);
        return strlen($string);
    }

}
