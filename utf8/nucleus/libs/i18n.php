<?php
/*
 * i18n class
 * written by Takashi Sakamoto as of Jun.5, 2011
 * This is wrapper functions of iconv and mbstring
 * for multibyte processing.
 */

class i18n {
	private static $charset = '';
	private static $iconv = FALSE;
	private static $mbstring = FALSE;
	
	public static function init ($charset) {
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
		return (boolean) $return;
	}
	
	public static function hsc ($string, $quotation=ENT_QUOTES) {
		return (string) htmlspecialchars($string, $quotation, self::$charset);
	}
	
	public static function convert ($target, $from, $to='') {
		$string = '';
		if ($to == '') {
			$to = self::$charset;
		}
		if (self::$iconv) {
			$string = iconv($from, $to.'//TRANSLIT', $string);
		} else if (self::$mbstring) {
			$string = mb_convert_encoding($string, $to, $from);
		}
		return (string) $string;
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
		return (integer) $length;
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
		return (integer) $position;
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
		return (integer) $position;
	}
	
	public static function substr ($string, $start, $length=0) {
		$return = '';
		if (self::$iconv) {
			$return = iconv_substr ($string, $start, $length, self::$charset);
		} else if (self::$mbstring) {
			$return = mb_substr ($string, $start, $length, self::$charset);
		} else {
			$return = strrpos ($string, $start, $length);
		}
		return (string) $return;
	}
	
	public static function explode ($delimiter, $target, $limit=0) {
		$array = array();
		if (preg_match("#$delimiter#", $target) === 0) {
			return $target;
		}
		for ($count=0; $limit == 0 || $count < $limit; $count++) {
			$offset = self::strpos($target, $delimiter);
			if ($array != array() && $offset == 0) {
				$array[] = $target;
				break;
			}
			$array[] = self::substr($target, 0, $offset);
			$length = self::strlen($target) - $offset;
			$target = self::substr($target, $offset+1, $length);
			continue;
		}
		return (array) $array;
	}
	
	public static function strftime ($format, $timestamp='') {
		$formatted = '';
		$elements = array();
		if (preg_match('#%#', $format) === 0) {
			return $format;
		}
		$format = trim(preg_replace('#(%.)#', ',$1,', $format), ',');
		$elements = self::explode(',', $format);
		
		foreach ($elements as $element) {
			if (preg_match('#^%.$#', $element)) {
				$formatted .= strftime($element, $timestamp);
			} else {
				$formatted .= $element;
			}
		}
		
		return (string) $formatted;
	}
	
	/*
	 * This function is experimental, need to be tested in various PHP environment
	 */
	public static function mail($to, $subject, $message, $from) {
		if (self::$iconv) {
			$options = array(
			 'scheme' => 'B',
			 'input-charset' => self::$charset,
			 'output-charset' => self::$charset,
			 'line-length' => 76,
			 'line-break-chars' => "\r\n");
			
			$subject = iconv_mime_encode('Subject', $subject, $options);
			$addition = iconv_mime_encode('From', $from, $options);
			
			$result = mail($to, $subject, $message, $addition);
		} else if (self::$mbstring) {
			$result = mb_send_mail ($to, $subject, $message, "From: $from");
		} else {
			$result = mail ($to, $subject, $message, "From: $from");
		}
		return (boolean) $result;
	}
}