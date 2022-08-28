<?php

// Utils::convert_encoding()
// Utils::mail()
// Utils::strftime
// Utils::strlen
// Utils::httpGet

if (! defined('_HAS_MBSTRING')) {
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

        if (! _HAS_MBSTRING || ('iso-8859-1' == strtolower(_CHARSET))) {
            if ('utf-8' == strtolower(_CHARSET)
                && (! isset($args[3])
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
                if (stripos('japanese', $lang) !== false) {
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

        if (! is_string($format) || (strlen($format) == 0)) {
            return '';
        }
        if ((func_num_args() == 1)) {
            $timestamp = time();
        }
        if (90000 <= PHP_VERSION_ID && USER_FUNCTION_STRFTIME) {
            return self::date_with_strftime_format($format, $timestamp);
        }
        if (! _HAS_MBSTRING) {
            return @strftime($format, $timestamp);
        }
        $old_locale = setlocale(
            LC_CTYPE,
            '0'
        ); // backup locale : maintained per process, not thread
        $locale = setlocale(LC_CTYPE, '');
        try {
            if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
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
                    $codepage = intval($m[1]);
                    if (in_array($codepage, [1251, 1252])) {
                        $locale_mbcahrset = "windows-{$m[1]}";
                    } else {
                        if ($codepage == 932) {
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
        if (is_null($string)) {
            return 0;
        }
        if (_HAS_MBSTRING) {
            return mb_strlen($string, _CHARSET);
        }

        return strlen($string);
    }

    public static function httpGet(
        $url,
        $options = ['connecttimeout' => 3]
    ) {
        static $enable_curl = null;
        if (is_null($enable_curl)) {
            $enable_curl = (function_exists('curl_init'));
        }
        $timeout = ((isset($options['timeout'])
                            && $options['timeout'] > 0) ? $options['timeout']
            : 0);
        $connecttimeout = ((isset($options['connecttimeout'])
                            && $options['connecttimeout'] > 0)
            ? $options['connecttimeout'] : 0);
        $start          = microtime(true);
        $reply_response = (isset($options['reply_response'])
                           && $options['reply_response']);

        if ($enable_curl) {
            $ret = false;
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($crl, CURLOPT_HEADER, 1);
            if ($timeout > 0) {
                curl_setopt($crl, CURLOPT_TIMEOUT, $timeout);
            }
            if ($connecttimeout > 0) {
                curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
            }
            if (preg_match('#^https://#', $url)) {
                curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
            }
            if (isset($options['useragent'])
                && ! empty($options['useragent'])) {
                curl_setopt($crl, CURLOPT_USERAGENT, $options['useragent']);
            } else {
                curl_setopt($crl, CURLOPT_USERAGENT, DEFAULT_USER_AGENT);
            }
            // request
            $res = curl_exec($crl);
            if ($res !== false) {
                $info = curl_getinfo($crl);
                if (! empty($info) && isset($info["header_size"])) {
                    if (isset($info["http_code"])
                        && $info["http_code"] == 200) {
                        $header = rtrim(substr($res, 0, $info["header_size"]));
                        if (0 == max(0, strlen($res) - $info["header_size"])) {
                            $body = '';
                        } else {
                            $body = substr($res, $info["header_size"]);
                        }
                        if ($reply_response) {
                            $ret = [
                                'header' => &$header,
                                'body'   => &$body,
                            ];
                        } else {
                            $ret = & $body;
                        }
                    }
                }
            }
            curl_close($crl);

            return $ret;
        } // end curl

        if ($connecttimeout > 0
            && version_compare(PHP_VERSION, '5.2.1', '>=')) {
            $opts
                = ['http' => ['timeout' => $connecttimeout]]; // php-5.2.1 Added timeout.  default_socket_timeout
            $sc = stream_context_create($opts);
            $c  = @fopen($url, "r", false, $sc);
        } else {
            $c = @fopen($url, "r");
        }
        if ($c) {
            $meta = [];
            if ($reply_response) {
                $meta = stream_get_meta_data($c);
            }
            if ($timeout > 0 && (microtime(true) - $start > $timeout)) {
                fclose($c);

                return false; // Timeout
            }
            if ($timeout > 0) {
                stream_set_timeout($c, $timeout);
            }
            $data = '';
            $stR  = [$c];
            $stW  = null;
            while (is_resource($c) && ! feof($c)) {
                $tv_sec = max(
                    1,
                    $timeout > 0 ? $timeout - ceil(microtime(true) - $start)
                    : 1
                );
                if (! stream_select($stR, $stW, $stW, $tv_sec)) {
                    fclose($c);

                    return false; // Timeout
                }
                $str = fgets($c, 500);
                if ($str !== false) {
                    $data .= $str;
                }

                // Handling of "traditional" timeout
                $info = stream_get_meta_data($c);
                if ($info['timed_out']) {
                    fclose($c);

                    return false; // Timeout
                }
                if ($timeout > 0 && (microtime(true) - $start > $timeout)) {
                    fclose($c);

                    return false; // Timeout
                }
            }
            fclose($c);
            if (! empty($meta) && isset($meta['wrapper_data'])) {
                return [
                    'header' => (string)implode("\n", $meta['wrapper_data']),
                    'body'   => &$data,
                ];
            }

            return $data;
        }

        return false;
    }

    public static function date_with_strftime_format($format, $timestamp = null)
    {
        $fmt = self::convertDateformatFromStrftimeformat($format);
        if ($fmt !== false) {
            if ((func_num_args() == 1)) {
                return date($fmt);
            } else {
                return date($fmt, $timestamp);
            }
        }
        return false;
    }

    public static function convertDateformatFromStrftimeformat($format)
    {
        // Todo: ignore error option
        $force = true;
        $parts = preg_split('|(%[%a-z])|i', $format, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $res   = [];

        foreach ($parts as $part) {
            if (substr($part, 0, 1) !== '%') {
                // normal string
                $res[] = preg_replace('|([a-z])|i', '\\\\${1}', $part);
                continue;
            }
            if (strlen($part) != 2) {
                // syntax error;
                if ($force) {
                    $res[] = '%';
                    continue;
                }
                return false;
            }
            // %a %A %d %e %j %u %w %U %V %W %b %B %h %m %C %g %G %y %Y %H %k %I %l %M %p %P %r %R %S %T %X %z %Z %c %D %F %s %x %n %t %%
            if (!str_contains('aAdejuwUVWbBhmCgGyYHkIlMpPrRSTXzZcDFsxnt%', substr($part, 1, 1))) {
                // syntax error;
                return false;
            }
            $pairs = [
                '%%' => '%',
                '%y' => 'y',
                '%Y' => 'Y',
                '%m' => 'm',
                '%d' => 'd',
                '%H' => 'H',
                '%M' => 'i',
                '%S' => 's',
                '%s' => 'U',
                '%w' => 'w',
                '%W' => 'W',
                '%z' => 'O',
                '%Z' => 'T',
                '%T' => 'H:i:s', // %T "%H:%M:%S"
                '%p' => 'A', // AM PM
                '%P' => 'a', // am pm
                '%I' => 'h',  // 01-12 (hour)
                '%a' => 'D',  // Mon - Sun
                '%A' => 'l',  // Monday - Sunday
//                '%j' => 'z',  // %j 001-366  / z 0 - 365
                '%u' => 'N',  // week number
                '%h' => 'M',  // Jan - Dec
                '%b' => 'M',
                '%B' => 'F',  // January - December
                '%n' => "\n",
                '%t' => "\t",
                '%F' => 'Y-m-d', // %F "%Y-%m-%d"
                '%D' => 'm/d/y', // %D "%m/%d/%y"
                //
//                '%e' => '',
//                '%u' => '',
//                '%U' => '',
//                '%V' => '',
//                '%C' => '',
//                '%g' => '',
//                '%G' => '',
//                '%k' => '',
//                '%l' => '',
//                '%r' => '',
//                '%R' => '',
//                '%X' => '',
//                '%c' => '',
//                '%x' => '',
            ];
            $new = strtr($part, $pairs);
            if (strcmp($new, $part) === 0) {
                // Not implemented yet.
                if ($force) {
                    // todo: ? or do nothing or as it is
//                   $res[] = '?';
//                   $res[] = $part;
                    continue;
                }
                return false;
//              continue;
            }
            $res[] = $new;
        }
        return implode('', $res);
    }

    public static function test_date_with_strftime_format()
    {
        $t = null;
        //  php -r "include('Utils.php'); Utils::test_date_with_strftime_format();"
        $list = [
            '%Y-%m-%d %H:%M:%S',
            '%W %w %s',
            'text : ok?',
            '%z %Z %T %P %p %I %j',
            '%u %a %A %h %b %B',
            '%F %D %y',
        ];
        foreach ($list as $format) {
            $date_fmt = self::convertDateformatFromStrftimeformat($format);
            printf("format                        : %s\n", $format);
            printf("  date fmt convert            : %s\n", $date_fmt);
            printf("  strftime(\$format)           : %s\n", strftime($format));
            printf("  date_with_strftime_format() : %s\n", self::date_with_strftime_format($format));
            printf("  date()                      : %s\n", date($date_fmt));
            echo "\n";
            printf("  strftime(\$format, \$t)       : %s\n", strftime($format, $t));
            printf("  date_with_strftime_format() : %s\n", self::date_with_strftime_format($format, $t));
            printf("  date()                      : %s\n", date($date_fmt, $t));
        }
    }
}
