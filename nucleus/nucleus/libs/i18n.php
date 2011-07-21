<?php
/*
 * i18n class
 * written by Takashi Sakamoto as of Jul.02, 2011
 * This is wrapper functions of iconv and mbstring
 * and mail function with 7bit characters encoder
 * for multibyte processing.
 */
class i18n {
	private static $charset = '';
	private static $mode = FALSE;
	private static $timezone = 'UTC';
	
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
		
		self::confirm_default_date_timezone();
		
		self::$charset = $charset;
		return (boolean) $return;
	}
	
	/*
	 * i18n::confirm_default_date_timezone
	 * to avoid E_NOTICE or E_WARNING generated when every calling to a date/time function.
	 * Some private servers are lack of its timezone setting
	 * http://www.php.net/manual/en/function.date-default-timezone-set.php
	 * @param	void
	 * @return	void
	 */
	public static function confirm_default_date_timezone()
	{
		if ( function_exists('date_default_timezone_get') 
		 && FALSE !== ($timezone = @date_default_timezone_get()))
		{
			self::$timezone = $timezone;
		}
		if (function_exists('date_default_timezone_set')) {
			 @date_default_timezone_set(self::$timezone);
		}
		
		return;
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
	 * explode function based on multibyte processing with non-pcre regular expressions
	 * 
	 * NOTE: we SHOULD use preg_split function instead of this,
	 *  and I hope this is obsoleted near future...
	 * 
	 * @param	string	$delimiter	singlebyte or multibyte delimiter
	 * @param	string	$target	target string
	 * @param	integer	$limit	the number of index for returned array
	 * @return	array	array splitted by $delimiter
	 */
	public static function explode($delimiter, $target, $limit=0)
	{
		$array = array();
		$preg_delimiter = '#' . preg_quote($delimiter, '#') . '#';
		if ( preg_match($preg_delimiter, $target) === 0 )
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
	 * @param	timestamp	$timestamp	UNIX timestamp
	 * @return	string	formatted timestamp
	 */
	public static function strftime($format, $timestamp='')
	{
		$formatted = '';
		
		if ( $timestamp == '' )
		{
			$timestamp = time();
		}
		
		if ( $format == '%%' )
		{
			return '%';
		}
		else if ( preg_match('#%[^%]#', $format) === 0 )
		{
			return $format;
		}
		
		$format		= trim(preg_replace('#(%[^%])#', ',$1,', $format), ',');
		$elements	= preg_split('#,#', $format);
		
		foreach ( $elements as $element )
		{
			if ( preg_match('#(%[^%])#', $element) )
			{
				$formatted .= strftime($element, $timestamp);
			}
			else if ( $element == '%%' )
			{
				$formatted .= '%';
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
	 * @param	string	$to		receivers including singlebyte and multibyte strings, based on RFC 5322
	 * @param	string	$subject	subject including singlebyte and multibyte strings
	 * @param	string	$message	message including singlebyte and multibyte strings
	 * @param	string	$from		senders including singlebyte and multibyte strings, based on RFC 5322
	 * @param	string(B/Q)	$scheme	7bit-encoder scheme based on RFC 2047
	 * @return	boolean	accepted delivery or not
	 */
	public static function mail($to, $subject, $message, $from, $scheme='B')
	{
		
		$to = self::mailbox_list_encoder($to, $scheme);
		$subject = self::seven_bit_characters_encoder($subject, $scheme);
		$from = 'From: ' . self::mailbox_list_encoder($from, $scheme);
		
		/*
		 * All of 7bit character encoding derives from ISO/IEC 646
		 * So we can decide the body's encoding bit count by this regular expression.
		 * 
		 */
		$bitcount = '8bit';
		if ( preg_match('#\A[\x00-\x7f]*\z#', $message) )
		{
			$bitcount = '7bit';
		}
		
		$headers = 'Content-Type: text/html; charset=' . self::$charset . "; format=flowed; delsp=yes\n"
		. "Content-Transfer-Encoding: {$bitcount}\n"
		. "X-Mailer: Nucleus CMS i18n class\n";
		
		return mail($to, $subject, $message, "{$from}\n{$headers}");
	}
	
	/*
	 * i18n::mailbox_list_encoder
	 * Encode multi byte strings included in mailbox.
	 * The format of mailbox is based on RFC 5322, which obsoletes RFC 2822
	 * 
	 * @param	string	$mailbox_list		mailbox list
	 * @return	string	encoded string	
	 * @link	http://www.faqs.org/rfcs/rfc5322.html
	 * @see		3.4. Address Specification
	 * 
	 */
	private static function mailbox_list_encoder ($mailbox_list, $scheme='B')
	{
		$encoded_mailboxes = array();
		$mailboxes = preg_split('#,#', $mailbox_list);
		foreach ( $mailboxes as $mailbox )
		{
			if ( preg_match("#^([^,]+)?<([^,]+)?@([^,]+)?>$#", $mailbox, $match) )
			{
				$display_name = self::seven_bit_characters_encoder(trim($match[1]), $scheme);
				$local_part = trim($match[2]);
				$domain = trim($match[3]);
				$encoded_mailboxes[] = "{$name} <{$local_part}@{$domain}>";
			}
			else if ( preg_match("#([^,]+)?@([^,]+)?#", $mailbox) )
			{
				$encoded_mailboxes[] = $mailbox;
			}
			else
			{
				continue;
			}
		}
		if ( $encoded_mailboxes == array() )
		{
			return FALSE;
		}
		return implode(',', $encoded_mailboxes);
	}
	
	/*
	 * i18n::seven_bit_characters_encoder
	 * Encoder into 7bit ASCII expression for Non-ASCII Text based on RFC 2047.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2047.html
	 * @see 2. Syntax of encoded-words
	 * @param	string	$charset	Character set encoding
	 * @param	string	$type	type of 7 bit encoding, should be 'B' or 'Q'
	 * @param	string	$string	Target string with header field
	 * @return	string	encoded string
	 * 
	 * NOTE: iconv extension give the same functions as this and each encoder in PHP5
	 * These implementation are for the servers which is lack of iconv extension
	 * 
	 * NOTE: RFC 2047 has a ambiguousity for dealing with 'linear-white-space'.
	 *  This causes a trouble related to line breaking between single byte and multi byte strings.
	 *  To avoid this, single byte string is encoded as well as multi byte string here.
	 * 
	 * NOTE: RFC 2231 allows the specification of the language to be used
	 *  for display as well as the character set but isn't applied here.
	 * 
	 */
	private static function seven_bit_characters_encoder($string, $scheme='B')
	{
		if ( $scheme != 'Q' )
		{
			$scheme = 'B';
		}
		$header = chr(13) . chr(10) . chr(32) . '=?' . self::$charset . "?{$scheme}?";
		$footer = "?=";
		$restriction = 78 - strlen($header) - strlen($footer) ;
		
		$encoded_words = array();
		for ( $i = 0; $i < i18n::strlen($string); $i++ )
		{
			if ( $scheme == 'B' )
			{
				if ( $i == 0 )
				{
					$letters = '';
				}
				
				$letter = i18n::substr($string, $i, 1);
				$expected_length = strlen($letters) + strlen($letter) * 4 / 3;
				
				if ( $expected_length > $restriction )
				{
					$encoded_text = self::b_encoder($letters);
					$encoded_words[] = "{$header}{$encoded_text}{$footer}";
					$letters = '';
				}
				
				$letters .= $letter;
				
				if ( $i == i18n::strlen($string) - 1 )
				{
					$encoded_text = self::b_encoder($letters);
					$encoded_words[] = "{$header}{$encoded_text}{$footer}";
					break;
				}
				continue;
			}
			else
			{
				if ( $i == 0 )
				{
					$encoded_text = '';
				}
				
				$encoded_letter = self::q_encoder(i18n::substr($string, $i, 1));
				$expected_length = strlen($encoded_text) + strlen($encoded_letter);
				
				if ( $expected_length > $restriction )
				{
					$encoded_words[] = "{$header}{$encoded_text}{$footer}";
					$letters = '';
				}
				
				$encoded_text .= $encoded_letter;
				
				if ( $i == i18n::strlen($string) - 1 )
				{
					$encoded_words[] = "{$header}{$encoded_text}{$footer}";
					break;
				}
				continue;
			}
		}
		
		return implode('', $encoded_words);
	}
	
	/*
	 * B encoder according to RFC 2047.
	 * The "B" encoding is identical to the "BASE64" encoding defined by RFC 4648.
	 * 
	 * @link http://tools.ietf.org/html/rfc4648
	 * @see 6.8. Base64 Content-Transfer-Encoding
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 * 
	 * NOTE: According to RFC 4648
	 * (1)	The final quantum of encoding input is an integral multiple of 24 bits;
	 * 		here, the final unit of encoded output will be an integral multiple
	 * 		of 4 characters with no "=" padding.
	 * (2)	The final quantum of encoding input is exactly 8 bits; here,
	 * 		the final unit of encoded output will be two characters followed
	 * 		by two "=" padding characters.
	 * (3)	The final quantum of encoding input is exactly 16 bits; here,
	 * 		the final unit of encoded output will be three characters followed
	 * 		by one "=" padding character.
	 * 
	 */
	private static function b_encoder($target)
	{
		return base64_encode($target);
	}
	
	/*
	 * Q encoder according to RFC 2047.
	 * The "Q" encoding is similar to "Quoted-Printable" content-transfer-encoding defined in RFC 2045,
	 *  but the "Q" encoding and the "Quoted-Printable" are different a bit.
	 * 
	 * @link http://www.faqs.org/rfcs/rfc2047.html
	 * @see 4.2. The "Q" encoding
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 * 
	 * NOTE: According to RFC 2047
	 * (1)	Any 8-bit value may be represented by a "=" followed by two hexadecimal digits.
	 * 		For example, if the character set in use were ISO-8859-1,
	 * 		the "=" character would thus be encoded as "=3D", and a SPACE by "=20".
	 * 		(Upper case should be used for hexadecimal digits "A" through "F".)
	 * (2)	The 8-bit hexadecimal value 20 (e.g., ISO-8859-1 SPACE) may be
	 * 		represented as "_" (underscore, ASCII 95.).
	 * 		(This character may not pass through some internetwork mail gateways,
	 * 		but its use will greatly enhance readability of "Q" encoded data
	 * 		with mail readers that do not support this encoding.)
	 * 		Note that the "_" always represents hexadecimal 20,
	 * 		even if the SPACE character occupies a different code position
	 * 		in the character set in use.
	 * (3)	8-bit values which correspond to printable ASCII characters
	 * 		other than "=", "?", and "_" (underscore), MAY be represented as those characters.
	 * 		(But see section 5 for restrictions.)
	 * 		In particular, SPACE and TAB MUST NOT be represented as themselves within encoded words.
	 * 
	 */
	private static function q_encoder($target)
	{
		$string = '';
		
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
