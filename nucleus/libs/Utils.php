<?php

// Utils::convert_encoding()
// Utils::mail()
// Utils::strftime
// Utils::strlen
// Utils::httpGet

if (!defined('_HAS_MBSTRING')) {
    define('_HAS_MBSTRING', extension_loaded('mbstring'));
}

class Utils
{
    function __construct()
    {
    }

    //  bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
    public static function mail($to, $subject, $message)
    {
        $args = func_get_args();

        // bool mb_send_mail ( string $to , string $subject , string $message [, string $additional_headers = NULL [, string $additional_parameter = NULL ]] )
        // bool         mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )

        if (!_HAS_MBSTRING || ('iso-8859-1' == strtolower(_CHARSET))) {
            if ('utf-8' == strtolower(_CHARSET)
                && (!isset($args[3]) || (false === stripos($args[3], 'utf-8')))) {
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
                $lang = strtolower(str_replace(array('\\', '/'), '', getLanguageName()));
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

    public static function strftime($format, $timestamp = '')
    {
        // [PHP8.1] Deprecated: Function strftime() is deprecated
        if (!is_string($format) || (strlen($format) == 0)) {
            return '';
        }
        if (!_HAS_MBSTRING) {
            return @strftime($format, $timestamp);
        }
        $old_locale = setlocale(LC_CTYPE, '0'); // backup locale : maintained per process, not thread
        $locale = setlocale(LC_CTYPE, '');
        try {
            if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                $locale_mbcahrset = false;
                // PHP not support wcsftime, so format cannot contain unicode charactors.
                // curl http://php.net/manual/ja/mbstring.supported-encodings.php | grep -Po CP[0-9]+ | grep -Po [0-9]+ | sort -n | uniq | xargs -IXXX echo "XXX|" | paste -s | tr -d "[:space:]"
                // 850|866|932|936|949|950|1251|1252  //|50220|50221|50222|51932|
                // Codepage: https://msdn.microsoft.com/ja-jp/library/windows/desktop/dd317756(v=vs.85).aspx
                // The locale name form : https://msdn.microsoft.com/en-us/library/hzz3tw78.aspx
                if (preg_match('/\.(850|866|932|936|949|950|1251|1252)$/', $locale, $m)) {
                    $codepage = intval($m[1]);
                    if (in_array($codepage, array(1251, 1252))) {
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
                    $format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
                    // Workaround for Multibyte and ANSI character sets.
                    $res = mb_convert_encoding(@strftime(
                        mb_convert_encoding($format, $locale_mbcahrset, _CHARSET),
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
        if (_HAS_MBSTRING) {
            return mb_strlen($string, _CHARSET);
        }
        return strlen($string);
    }

    public static function httpGet($url, $options = array('connecttimeout' => 3))
    {
        static $enable_curl = null;
        if (is_null($enable_curl)) {
            $enable_curl = (function_exists('curl_init'));
        }
        $timeout = ((isset($options['timeout']) && $options['timeout'] > 0) ? $options['timeout'] : 0);
        $connecttimeout = ((isset($options['connecttimeout']) && $options['connecttimeout'] > 0) ? $options['connecttimeout'] : 0);
        $start = microtime(true);
        $reply_response = (isset($options['reply_response']) && $options['reply_response']);

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
            if (isset($options['useragent']) && !empty($options['useragent'])) {
                curl_setopt($crl, CURLOPT_USERAGENT, $options['useragent']);
            } else {
                curl_setopt($crl, CURLOPT_USERAGENT, DEFAULT_USER_AGENT);
            }
            // request
            $res = curl_exec($crl);
            if ($res !== false) {
                $info = curl_getinfo($crl);
                if (!empty($info) && isset($info["header_size"])) {
                    if (isset($info["http_code"]) && $info["http_code"] == 200) {
                        $header = rtrim(substr($res, 0, $info["header_size"]));
                        if (0 == max(0, strlen($res) - $info["header_size"])) {
                            $body = '';
                        } else {
                            $body = substr($res, $info["header_size"]);
                        }
                        if ($reply_response) {
                            $ret = array('header' => &$header, 'body' => &$body);
                        } else {
                            $ret =& $body;
                        }
                    }
                }
            }
            curl_close($crl);
            return $ret;
        } // end curl

        if ($connecttimeout > 0 && version_compare(PHP_VERSION, '5.2.1', '>=')) {
            $opts = array('http' => array('timeout' => $connecttimeout)); // php-5.2.1 Added timeout.  default_socket_timeout
            $sc = stream_context_create($opts);
            $c = @fopen($url, "r", false, $sc);
        } else {
            $c = @fopen($url, "r");
        }
        if ($c) {
            $meta = array();
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
            $stR = array($c);
            $stW = null;
            while (is_resource($c) && !feof($c)) {
                $tv_sec = max(1, $timeout > 0 ? $timeout - ceil(microtime(true) - $start) : 1);
                if (!stream_select($stR, $stW, $stW, $tv_sec)) {
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
            if (!empty($meta) && isset($meta['wrapper_data'])) {
                return array('header' => (string)implode("\n", $meta['wrapper_data']), 'body' => &$data);
            }
            return $data;
        }
        return false;
    }
}
