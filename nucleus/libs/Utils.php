<?php

/*
 * license GNU General Public License
 * Copyright (C) 2017 torisanbird
 */

// Utils::mail()
// Utils::strftime
// Utils::strlen

if ( ! extension_loaded('mbstring')) {
    @trigger_error('Error: mbstring module not loaded', E_USER_ERROR);
}

if ( ! defined('_HAS_MBSTRING')) {
    define('_HAS_MBSTRING', extension_loaded('mbstring'));
}

class Utils
{
    public function __construct()
    {
    }

    //  bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
    public static function mail($to, $subject, $message)
    {
        $args = func_get_args();

        // bool mb_send_mail ( string $to , string $subject , string $message [, string $additional_headers = NULL [, string $additional_parameter = NULL ]] )
        // bool         mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )

        if ( ! _HAS_MBSTRING || ('iso-8859-1' == strtolower(_CHARSET))) {
            if ('utf-8' == strtolower(_CHARSET)
                && ( ! isset($args[3])
                     || (false === stripos($args[3], 'utf-8')))) {
                $additional_headers = 'Content-Type: text/plain; charset=utf-8';
                if (isset($args[3])) {
                    $args[3] = rtrim($args[3]) . "\n" . $additional_headers;
                } else {
                    $args[3] = $additional_headers;
                }
            }

            return call_user_func_array('mail', $args);
        } else {
            $mb_lang = 'uni';
            if ('utf-8' != strtolower(_CHARSET)) {
                $lang = strtolower(str_replace(
                    ['\\', '/'],
                    '',
                    getLanguageName()
                ));
                if (false !== stripos('japanese', $lang)) {
                    $mb_lang = 'ja';
                }
                //                else if ('iso-8859-1' == strtolower(_CHARSET))
                //                   $mb_lang = 'en';
            }
            mb_language($mb_lang); // Valid languages are "Japanese", "ja","English","en" , "uni"
            mb_internal_encoding(_CHARSET);

            return call_user_func_array('mb_send_mail', $args);
        }
    }

    public static function strftime($format, $timestamp = null)
    {
        // [PHP8.1] Deprecated: Function strftime()
        // $ php -r "echo strftime('%Y-%m-%d %H:%M:%S', null);"
        //  1970-01-01 09:00:00
        // PHP bug: manual : defaults to the current local time if timestamp is null
        //                   actual result : null treat as int 0

        if ( ! is_string($format) || (0 == strlen($format))) {
            return '';
        }
        if ((1 == func_num_args())) {
            $timestamp = time();
        }
        if ( ! _HAS_MBSTRING) {
            return @strftime($format, $timestamp);
        }
        $old_locale = setlocale(
            LC_CTYPE,
            '0'
        ); // backup locale : maintained per process, not thread
        $locale = setlocale(LC_CTYPE, '');
        try {
            if (0 == strncasecmp(PHP_OS, 'WIN', 3)) {
                $locale_mbcahrset = false;
                // PHP not support wcsftime, so format cannot contain unicode charactors.
                // curl http://php.net/manual/ja/mbstring.supported-encodings.php | grep -Po CP[0-9]+ | grep -Po [0-9]+ | sort -n | uniq | xargs -IXXX echo "XXX|" | paste -s | tr -d "[:space:]"
                // 850|866|932|936|949|950|1251|1252  //|50220|50221|50222|51932|
                // Codepage: https://msdn.microsoft.com/ja-jp/library/windows/desktop/dd317756(v=vs.85).aspx
                // The locale name form : https://msdn.microsoft.com/en-us/library/hzz3tw78.aspx
                if (preg_match(
                    '/\.(850|866|932|936|949|950|1251|1252)$/',
                    $locale,
                    $m
                )) {
                    $codepage = (int) ($m[1]);
                    if (in_array($codepage, [1251, 1252])) {
                        $locale_mbcahrset = "windows-{$m[1]}";
                    } else {
                        if (932 == $codepage) {
                            $locale_mbcahrset = 'SJIS-win';
                        } else {
                            $locale_mbcahrset = "CP{$codepage}";
                        }
                    }
                }
                if ($locale_mbcahrset) {
                    // Workaround for %e format
                    $format = preg_replace(
                        '#(?<!%)((?:%%)*)%e#',
                        '\1%#d',
                        $format
                    );
                    // Workaround for Multibyte and ANSI character sets.
                    $res
                        = mb_convert_encoding(@strftime(
                            mb_convert_encoding(
                                $format,
                                $locale_mbcahrset,
                                _CHARSET
                            ),
                            $timestamp
                        ), _CHARSET, $locale_mbcahrset);
                    //                    if ($old_locale != $locale)
                    //                        setlocale(LC_CTYPE, $old_locale); // restore locale
                    //    var_dump(basename(__FILE__).':'. __LINE__, $old_locale, $locale, $format, $timestamp, $res); // debug
                    return $res;
                }
            }
            if (PHP_OS == 'CYGWIN') {
                setlocale(LC_TIME, sprintf('%s.%s', _LOCALE, _CHARSET));
            }
            $res = @strftime($format, $timestamp);
            if ($old_locale != $locale) {
                setlocale(LC_CTYPE, $old_locale);
            } // restore locale
            //    var_dump(basename(__FILE__).':'. __LINE__ ,$locale, $format, $timestamp, $res); // debug
            return $res;
        } catch (Exception $e) {
            if ($old_locale != $locale) {
                setlocale(LC_CTYPE, $old_locale);
            } // restore locale
        }
    }

    public static function strlen($string)
    {
        if (null === $string) {
            return 0;
        }
        if (_HAS_MBSTRING) {
            return mb_strlen($string, _CHARSET);
        }

        return strlen($string);
    }
}
