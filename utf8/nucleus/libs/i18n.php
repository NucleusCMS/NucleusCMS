<?php
/*
 * i18n class
 * written by Takashi Sakamoto as of Apr.18, 2011
 * This is wrapper functions of iconv and mbstring
 * for multibyte processing.
 * 
 * Usage: Firstly i18n::initialize($charset),
 *  then access to each static functions.
 * 
 */

class i18n {
	private static $charset = '';
	private static $iconv = FALSE;
	private static $mbstring = FALSE;
	
	public static function initialize ($charset) {
		if (extension_loaded('iconv')) {
			self::$iconv = TRUE;
			if (iconv_set_encoding ('output_encoding', $charset)
			 && iconv_set_encoding ('internal_encoding', $charset)){
				$return =TRUE;
			} else {
				$return =FALSE;
			}
		} else if (extension_loaded('mbstring')) {
			self::$mbstring = TRUE;
			if (mb_http_output($charset)
			 && mb_internal_encoding($charset)
			 && mb_regex_encoding($charset)) {
			 	$return = TRUE;
			 } else {
			 	$return =FALSE;
			 }
		} else {
			$return =FALSE;
		}
		self::$charset = $charset;
		return $return;
	}
	
	public static function hsc ($string, $quotation) {
		return htmlspecialchars($string, $quotation, self::$charset);
	}
	
	public static function convert ($target, $from, $to='') {
		$string = '';
		if (!$to) {
			$to = self::$charset;
		}
		if (self::$iconv) {
			$string = iconv($from, $to.'//TRANSLIT', $string);
		} else if (self::$mbstring) {
			$string = mb_convert_encoding($string, $to, $from);
		}
		return $string;
	}
	
	public static function strlen ($string) {
		$length = 0;
		if (self::$iconv) {
			$length = iconv_strlen ($string, self::$charset);
		} else if (self::$mbstring) {
			$length = mb_strlen ($string, self::$charset);
		} else {
			$length = strlen ($string);
		}
		return $length;
	}
	
	public static function strpos ($haystack, $needle, $offset=0) {
		$position = 0;
		if (self::$iconv) {
			$position = iconv_strpos ($haystack, $needle, $offset, self::$charset);
		} else if (self::$mbstring) {
			$position = mb_strpos ($haystack, $needle, $offset, self::$charset);
		} else {
			$position = strpos ($haystack, $needle, $offset);
		}
		return $position;
	}
	
	public static function strrpos ($haystack, $needle) {
		$position = 0;
		if (self::$iconv) {
			$position = iconv_strrpos ($haystack, $needle, self::$charset);
		} else if (self::$mbstring) {
			$position = mb_strrpos ($haystack, $needle, 0, self::$charset);
		} else {
			$position = strrpos ($haystack, $needle, 0);
		}
		return $position;
	}
	
	public static function substr ($string, $start, $length=0) {
		$return = 0;
		if (self::$iconv) {
			$return = iconv_substr ($string, $start, $length, self::$charset);
		} else if (self::$mbstring) {
			$return = mb_substr ($string, $start, $length, self::$charset);
		} else {
			$return = strrpos ($string, $start, $length);
		}
		return $return;
	}
	
	/*
	 * we should use preg_split function instead of this, I think.
	 */
	public static function explode ($delimiter, $target, $limit=0) {
		$array = array();
		for ($count=0; $limit == 0 || $count < $limit; $count++) {
			$offset = self::strpos($target, $delimiter);
			if ($offset == 0) {
					$array[] = $target;
				break;
			}
			$before = self::substr($target, 0, $offset);
			$array[] = $before;
			$length = self::strlen($target) - self::strlen($before);
			$target = self::substr($target, $offset+1, $length);
		}
		return $array;
	}
	
	public static function strftime ($format, $timestamp='') {
		$formatted = '';
		if (setlocale(LC_CTYPE, 0) == 'Japanese_Japan.932') {
			$formatted = iconv('CP932', self::$charset, strftime(iconv(self::$charset, 'CP932', $format),$timestamp));
		} else {
			$formatted = strftime($format,$timestamp);
		}
		return $formatted;
	}
}