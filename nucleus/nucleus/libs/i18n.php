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
		if ( self::$mode )
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
	
	/*
	 * i18n::hsc
	 * htmlspecialchars wrapper
	 * @param	string	$string	target string
	 * @param	string	$quotation	quotation mode
	 * @return	string	escaped string
	 */
	public static function hsc($string, $quotation=ENT_QUOTES)
	{
		return (string) htmlspecialchars($string, $quotation, self::$charset);
	}
	
	/*
	 * i18n::convert
	 * character set converter
	 * @param	string	$string	target string binary
	 * @param	string	$from	original character set encoding
	 * @param	string	$to	target character set encoding
	 * @return	string	converted string
	 */
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
	
	/*
	 * i18n::strlen
	 * strlen wrapper
	 * @param	string	$string	target string
	 * @return	integer	the number of letters
	 */
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
	
	/*
	 * i18n::strpos
	 * strpos wrapper
	 * @param	string	$haystack	string to search
	 * @param	string	$needle	string for search
	 * @param	string	$offset	the position from which the search should be performed. 
	 * @return	integer/FALSE	the numeric position of the first occurrence of needle in haystack
	 */
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
		
		if ( $position !== FALSE)
		{
			$position = (integer) $position;
		}
		return $position;
	}
	
	/*
	 * i18n::strrpos
	 * strrpos wrapper
	 * @param	string	$haystack	string to search
	 * @param	string	$needle	string for search
	 * @return	integer/FALSE	the numeric position of the last occurrence of needle in haystack
	 */
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
		
		if ( $position !== FALSE)
		{
			$position = (integer) $position;
		}
		return $position;
	}
	
	/*
	 * i18n::substr
	 * substr wrapper
	 * @param	string	$string	string to be cut
	 * @param	string	$start	the position of starting
	 * @param	integer	$length	the length to be cut
	 * @return	string	the extracted part of string
	 */
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
	
	/*
	 * i18n::explode
	 * explode function based on multibyte processing
	 * we SHOULD use preg_split function instead of this
	 * @param	string	$delimiter	singlebyte or multibyte delimiter
	 * @param	string	$target	target string
	 * @param	integer	$limit	the number of index for returned array
	 * @return	array	array splitted by $delimiter
	 */
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
	
	/*
	 * i18n::strftime
	 * strftime function based on multibyte processing
	 * @param	string	$format	format with singlebyte or multibyte
	 * @param	timestamp	$timestamp	UNIT timestamp
	 * @return	string	formatted timestamp
	 */
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
	 * i18n::mail
	 * Send mails with headers including 7bit-encoded multibyte string
	 * @param	string	$to		receivers including singlebyte and multibyte strings, based on RFC 2822
	 * @param	string	$subject	subject including singlebyte and multibyte strings
	 * @param	string	$message	message including singlebyte and multibyte strings
	 * @param	string	$from		senders including singlebyte and multibyte strings, based on RFC 2822
	 * @param	string(B/Q)	$scheme	7bit-encoder scheme based on RFC 2047
	 * @return	boolean	accepted delivery or not
	 */
	public static function mail($to, $subject, $message, $from, $scheme='B')
	{
		$senders = array();
		$receivers = array();
		
		$elements = self::explode(',', $to);
		foreach ( $elements as $element )
		{
			if ( preg_match("#^([^,]+)?<([^,]+)?@([^,]+)?>$#", $element, $match) )
			{
				$name = self::seven_bit_encoder(self::$charset, $scheme, trim($match[1]));
				$address = trim($match[2]) . '@' . trim($match[3]);
				$receivers[] = "{$name} <{$address}>";
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
			$name = self::seven_bit_encoder(self::$charset, $scheme, trim($match[1]));
			$address = trim($match[2]) . '@' . trim($match[3]);
			$sender = "{$name} <{$address}>";
		}
		else if ( preg_match("#([^,]+)?@([^,]+)?#", $from) )
		{
			$sender = trim($element);
		}
		$from = "From: {$sender}\n";
		
		$subject = self::seven_bit_encoder(self::$charset, $scheme, $subject);
		
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
	 * @param	string	$target	Target string with header field
	 * @return	string	encoded string
	 * 
	 */
	private static function seven_bit_encoder($charset, $scheme, $target)
	{
		if ( $scheme != 'Q' )
		{
			$scheme = 'B';
		}
		
		$header = "=?{$charset}?{$scheme}?";
		$footer = "?=";
		
		$multiple_encoded_words = array();
		$encoded_text = $header;
		for ( $i = 0; $i < i18n::strlen($target); $i++ )
		{
			$letter = i18n::substr($target, $i, 1);
			
			if ($scheme == 'Q')
			{
				$encoded_letter = self::q_encoder($letter);
			}
			else
			{
				$encoded_letter = self::b_encoder($letter);
			}
			
			if ( strlen($encoded_text) + strlen($encoded_letter) > 75 - strlen($footer) )
			{
				$multiple_encoded_words[] = "{$encoded_text}{$footer}";
				$encoded_text = $header . $encoded_letter;
			}
			else if ( $i == i18n::strlen($target) - 1 )
			{
				$multiple_encoded_words[] = "{$encoded_text}{$encoded_letter}{$footer}";
			}
			else
			{
				$encoded_text .= $encoded_letter;
			}
		}
		
		return implode(chr(13).chr(10).chr(32), $multiple_encoded_words);
	}
	
	/*
	 * B encoder based on RFC 2047.
	 * The "B" encoding is identical to the "BASE64" encoding defined by RFC 2045.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2045.html
	 * @see 6.8. Base64 Content-Transfer-Encoding
	 * 
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 * 
	 */
	private static function b_encoder($target)
	{
		return base64_encode($target);
	}
	
	/*
	 * Q encoder based on RFC 2047.
	 * The "Q" encoding is similar to the "Quoted-Printable" content-transfer-encoding defined in RFC 2045.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2047.html
	 * @see 4.2. The "Q" encoding
	 * 
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 * 
	 */
	private static function q_encoder($target)
	{
		$string = '';
		
		// this strlen() and substr() should be based on single byte!
		for ( $i = 0; $i < strlen($target); $i++ )
		{
			$letter = substr ($target, $i, 1);
			$order = ord($letter);
			
			// Printable ASCII characters without "=", "?", "_"
			if ((33 <= $order && $order <= 60)
			 || (62 == $order)
			 || (64 <= $order && $order <= 94)
			 || (96 <= $order && $order <= 126))
			{
				$string .= strtoupper(dechex($order));
			}
			// Space shuold be encoded as the same strings as "_"
			else if ($order == 32)
			{
				$string .= '_';
			}
			// Other characters
			else
			{
				$string .= '=' . strtoupper(dechex($order));
			}
		}
		
		return $string;
	}
}