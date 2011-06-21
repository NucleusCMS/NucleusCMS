<?php
/*
 * i18n class
 * written by Takashi Sakamoto as of Jun.5, 2011
 * This is wrapper functions of iconv and mbstring
 * for multibyte processing.
 */
class i18n {
	private static $charset = '';
	private static $mode = FALSE;
	
	/*
	 * i18n::init
	 * Initializing i18n class
	 * @param	string	$charset	character set
	 * @return	boolean	
	 */
	public static function init($charset)
	{
		if ( !self::$mode )
		{
			$return = TRUE;
		}
		else if ( extension_loaded('iconv') )
		{
			self::$mode = 'iconv';
			$return = ( iconv_set_encoding('output_encoding', $charset)
			 && iconv_set_encoding('internal_encoding', $charset) );
		}
		else if ( extension_loaded('mbstring') )
		{
			self::$mode = 'mbstring';
			$return = ( mb_http_output($charset)
			 && mb_internal_encoding($charset)
			 && mb_regex_encoding($charset));
		}
		else
		{
			$return = TRUE;
		}
		self::$charset = $charset;
		return (boolean) $return;
	}
	
	public static function hsc($string, $quotation=ENT_QUOTES)
	{
		return (string) htmlspecialchars($string, $quotation, self::$charset);
	}
	
	public static function convert($string, $from, $to='')
	{
		if ( $to == '' )
		{
			$to = self::$charset;
		}
		
		if ( self::$mode == 'iconv' )
		{
			$string = iconv($from, $to.'//TRANSLIT', $string);
		}
		else if ( self::$mode == 'mbstring' )
		{
			$string = mb_convert_encoding($string, $to, $from);
		}
		return (string) $string;
	}
	
	public static function strlen($string)
	{
		$length = 0;
		if ( self::$mode == 'iconv' )
		{
			$length = iconv_strlen($string, self::$charset);
		}
		else if ( self::$mode == 'mbstring' )
		{
			$length = mb_strlen($string, self::$charset);
		}
		else
		{
			$length = strlen($string);
		}
		return (integer) $length;
	}
	
	public static function strpos($haystack, $needle, $offset=0)
	{
		$position = 0;
		if ( self::$mode == 'iconv' )
		{
			$position = iconv_strpos($haystack, $needle, $offset, self::$charset);
		}
		else if ( self::$mode == 'mbstring' )
		{
			$position = mb_strpos($haystack, $needle, $offset, self::$charset);
		}
		else
		{
			$position = strpos($haystack, $needle, $offset);
		}
		return (integer) $position;
	}
	
	public static function strrpos ($haystack, $needle)
	{
		$position = 0;
		if ( self::$mode == 'iconv' )
		{
			$position = iconv_strrpos($haystack, $needle, self::$charset);
		}
		else if ( self::$mode == 'mbstring' )
		{
			$position = mb_strrpos($haystack, $needle, 0, self::$charset);
		}
		else
		{
			$position = strrpos($haystack, $needle, 0);
		}
		return (integer) $position;
	}
	
	public static function substr($string, $start, $length=0)
	{
		$return = '';
		if ( self::$mode == 'iconv' )
		{
			$return = iconv_substr($string, $start, $length, self::$charset);
		}
		else if ( self::$mode == 'mbstring' )
		{
			$return = mb_substr($string, $start, $length, self::$charset);
		}
		else
		{
			$return = strrpos($string, $start, $length);
		}
		return (string) $return;
	}
	
	public static function explode($delimiter, $target, $limit=0)
	{
		$array = array();
		if ( preg_match("#$delimiter#", $target) === 0 )
		{
			return (array) $target;
		}
		for ( $count=0; $limit == 0 || $count < $limit; $count++ )
		{
			$offset = self::strpos($target, $delimiter);
			if ( $array != array() && $offset == 0 )
			{
				$array[] = $target;
				break;
			}
			$array[]	= self::substr($target, 0, $offset);
			$length	= self::strlen($target) - $offset;
			$target	= self::substr($target, $offset+1, $length);
			continue;
		}
		return (array) $array;
	}
	
	public static function strftime($format, $timestamp='')
	{
		$formatted = '';
		$elements = array();
		if ( preg_match('#%#', $format) === 0 )
		{
			return $format;
		}
		$format		= trim(preg_replace('#(%.)#', ',$1,', $format), ',');
		$elements	= self::explode(',', $format);
		
		foreach ( $elements as $element )
		{
			if ( preg_match('#^%.$#', $element) )
			{
				$formatted .= strftime($element, $timestamp);
			}
			else
			{
				$formatted .= $element;
			}
		}
		
		return (string) $formatted;
	}
	
	/*
	 * This function is still experimental,
	 * need to be tested in various PHP environment
	 */
	public static function mail($to, $subject, $message, $from)
	{
		$senders = array();
		$receivers = array();
		
		$elements = self::explode(',', $to);
		foreach ( $elements as $element )
		{
			if ( preg_match("#^([^,]+)?<([^,]+)?@([^,]+)?>$#", $element, $match) )
			{
				$name = self::seven_bit_encoder(self::$charset, 'B', trim($match[1]));
				$address = trim($match[2]) . '@' . trim($match[3]);
				$receivers[] = "{$name <$address>}";
			}
			else if ( preg_match("#([^,]+)?@([^,]+)?#", $element) )
			{
				$receivers[] = $element;
			}
			else
			{
				continue;
			}
		}
		if ( $receivers == array() )
		{
			return FALSE;
		}
		$to = implode(',', $receivers);
		
		if ( preg_match("#^([^,]+)?<([^,]+)?@([^,]+)?>$#", $from, $match) )
		{
			$name = self::seven_bit_encoder(self::$charset, 'B', trim($match[1]));
			$address = trim($match[2]) . '@' . trim($match[3]);
			$sender = "{$name <$address>}";
		}
		else if ( preg_match("#([^,]+)?@([^,]+)?#", $from) )
		{
			$sender = trim($element);
		}
		$from = "From: {$sender}\n";
		
		$subject = self::seven_bit_encoder(self::$charset, 'B', $subject);
		
		$headers = "Content-Type: text/html; charset=UTF-8; format=flowed\n"
		. "MIME-Version: 1.0\n"
		. "Content-Transfer-Encoding: 8bit\n"
		. "X-Mailer: Nucleus CMS\n";
		
		return mail($to, $subject, $message, $from . $headers);
	}
	
	/*
	 * Encoder into 7bit ASCII expression for Non-ASCII Text based on RFC 2047.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2047.html
	 * @see 2. Syntax of encoded-words
	 * 
	 * @param	string	$charset	Character set encoding
	 * @param	string	$type	type of 7 bit encoding, should be 'B' or 'Q'
	 * @param	string	$target	Target string
	 * @return	string	encoded string
	 * 
	 */
	public function seven_bit_encoder($charset, $type='B', $target)
	{
		$string ='';
		
		if ($scheme == 'Q')
		{
			$target = self::q_type_encoder($target);
		}
		else
		{
			$scheme == 'B';
			$target = base64_encode($target);
		}
		
		$header = "=?{$charset}?{$scheme}?";
		$footer = "?=";
		$max = 75 - strlen($header) - strlen($footer);
		
		// a 'encoded-word is limited to 75 characters
		// multiple 'encoded-word' should be used
		$string .= $header;
		for ( $i = 0; $i < strlen($target); $i++ )
		{
			if ( ($i != 0) && ($i % $max == 0) )
			{
				$string .= $footer . char(13). char(10) . char(32) . $header;
			}
			
			$string .= substr($target, $i, 1);
			
		}
		$string .= $footer;
		return $string;
	}
	
	/*
	 * Encoder for Q type based on RFC 2047.
	 * The "Q" encoding is similar to the "Quoted-Printable" content-transfer-encoding
	 * defined in RFC 2045.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2047.html
	 * @see 4.2. The "Q" encoding
	 * 
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 * 
	 */
	public function q_type_encoder($target)
	{
		$string = '';
		
		$lines = preg_split("#\r?\n#", $target);
		$count = 0;
		
		foreach ( $lines as $line )
		{
			$str_line = '';
			
			for ( $j = 0; $j < strlen($line); $j++ )
			{
				// this substr() should be based on single byte!
				$letter = substr ($line, $j, 1);
				$order = ord($letter);
				
				// Printable ASCII characters without "=", "?", "_"
				if ((33 <= $order && $order <= 60)
				 || (62 == $order)
				 || (64 <= $order && $order <= 94)
				 || (96 <= $order && $order <= 126))
				{
					$str_line .= strtoupper(dechex($order));
				}
				// Space shuold be encoded as the same strings as "_"
				else if ($order == 32)
				{
					$str_line .= '_';
				}
				// Other characters
				else
				{
					$str_line .= '=' . strtoupper(dechex($order));
				}
			}
			
			$string .= $str_line . char(13) . char(10);
		}
		return $string;
	}
}
