<?php

// Utils::convert_encoding()
// Utils::mail()
// Utils::strftime
// Utils::strlen
// Utils::httpGet

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
        $locale = setlocale(LC_CTYPE, "0");
        if ((setlocale(LC_CTYPE, "0") == 'Japanese_Japan.932')) {
            return mb_convert_encoding(strftime(mb_convert_encoding($format, 'CP932', _CHARSET), $timestamp), _CHARSET, 'CP932');
        //      return iconv('CP932', _CHARSET, strftime(iconv(_CHARSET, 'CP932', $format),$timestamp));
        }
//var_dump(setlocale(LC_CTYPE, "0"),setlocale(LC_TIME, "0"), $format, $timestamp, strftime($format, $timestamp), mb_internal_encoding()); // debug
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

    public static function httpGet($url , $options = array('connecttimeout'=> 3))
    {
        $timeout = ((isset($options['timeout']) && $options['timeout']>0) ? $options['timeout'] : 0);
        $connecttimeout = ((isset($options['connecttimeout']) && $options['connecttimeout']>0) ? $options['connecttimeout'] : 0);
        $start = microtime(TRUE);
        $reply_response = (isset($options['reply_response']) && $options['reply_response']);

        if (function_exists('curl_init'))
        {
            $crl = curl_init();
            curl_setopt ($crl, CURLOPT_URL, $url);
            curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
            if ($timeout > 0)
                curl_setopt ($crl, CURLOPT_TIMEOUT, $timeout);
            if ($connecttimeout > 0)
                curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
            if (preg_match('#^https://#', $url))
                curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
            if (isset($options['useragent']) && !empty($options['useragent']))
                curl_setopt($crl, CURLOPT_USERAGENT, $options['useragent']);
            else
                curl_setopt($crl, CURLOPT_USERAGENT, DEFAULT_USER_AGENT);
            // request
            if ($reply_response)
            {
                curl_setopt($crl, CURLOPT_HEADER, 1);
                $ret = curl_exec($crl);
                if ($ret !== false)
                {
                    $info = curl_getinfo($crl);
                    $header = substr ($ret, 0, $info["header_size"]);
                    $body   = substr ($ret, $info["header_size"]);
                    $ret = array('header' => &$header, 'body'=> &$body);
                }
                curl_close($crl);
            }
            else
            {
                $ret = curl_exec($crl);
                curl_close($crl);
            }
            return $ret;
        }

        if ($connecttimeout>0 && version_compare(PHP_VERSION, '5.2.1', '>=')) {
            $opts = array('http'=>array('timeout'=> $connecttimeout)); // php-5.2.1 Added timeout.  default_socket_timeout
            $sc = stream_context_create($opts);
            $c = fopen($url, "r", FALSE, $sc);
        } else {
            $c = fopen($url, "r");
        }
        if ($c)
        {
            $meta = array();
            if ($reply_response)
                $meta = stream_get_meta_data($c);
            if ($timeout>0 && (microtime(TRUE)-$start > $timeout)) {
                fclose($c);
                return FALSE; // Timeout
            }
            if ($timeout>0)
                stream_set_timeout($c, $timeout);
            $data = '';
            $stR = array($c);
            $stW = null;
            while (is_resource($c) && !feof($c)) {
                $tv_sec = max(1, $timeout > 0 ? $timeout - ceil(microtime(TRUE)-$start) : 1);
                if (!stream_select($stR, $stW, $stW, $tv_sec)) {
                     fclose($c);
                     return FALSE; // Timeout
                }
                $str = fgets($c, 500);
                $data.= $str;

                // Handling of "traditional" timeout
                $info = stream_get_meta_data($c);
                if ($info['timed_out']) {
                    fclose($c);
                    return FALSE; // Timeout
                }
                if ($timeout>0 && (microtime(TRUE)-$start > $timeout)) {
                    fclose($c);
                    return FALSE; // Timeout
                }
             }
             fclose($c);
             if (!empty($meta) && isset($meta['wrapper_data']))
                 return array('header' => (string) implode("\n", $meta['wrapper_data']), 'body'=> &$data);
             return $data;
        }
        return FALSE;
    }

}
