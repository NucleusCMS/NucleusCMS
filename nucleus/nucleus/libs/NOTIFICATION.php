<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * Class used to represent a collection of e-mail addresses, to which a
 * message can be sent (e.g. comment or karma vote notification).
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class Notification
{
	static private $charset;
	static private $scheme = 'B';
	
	/**
	 * NOTIFICATION::address_validation()
	 * Validating the string as address
	 * 
	 * FIXME: this is just migrated from globalfunctions.php
	 *  we should confirm this regular expression refering to RFC 5322
	 * 
	 * @link	http://www.ietf.org/rfc/rfc5322.txt
	 * @see		3.4. Address Specification
	 * 
	 * @static
	 * @param	String	$address	Address
	 * @return	Boolean	valid or not
	 */
	static public function address_validation($address)
	{
		return (boolean) preg_match('#^(?!\\.)(?:\\.?[-a-zA-Z0-9!\\#$%&\'*+/=?^_`{|}~]+)+@(?!\\.)(?:\\.?(?!-)[-a-zA-Z0-9]+(?<!-)){2,}$#', $address);
	}
	
	/**
	 * NOTIFICATION::get_mail_footer()
	 * Return mail footer with Nucleus CMS singnature
	 * 
	 * @static
	 * @param	void
	 * @return	String	Message body with 
	 */
	static public function get_mail_footer()
	{
		$message  = "\n";
		$message .= "\n";
		$message .= "-----------------------------\n";
		$message .=  "   Powered by Nucleus CMS\n";
		$message .=  "(http://www.nucleuscms.org/)\n";
		return $message;
	}
	
	/**
	 * NOTIFICATION::mail
	 * Send mails with headers including 7bit-encoded multibyte string
	 * 
	 * @static
	 * @param	string	$to		receivers including singlebyte and multibyte strings, based on RFC 5322
	 * @param	string	$subject	subject including singlebyte and multibyte strings
	 * @param	string	$message	message including singlebyte and multibyte strings
	 * @param	string	$from		senders including singlebyte and multibyte strings, based on RFC 5322
	 * @param	string(B/Q)	$scheme	7bit-encoder scheme based on RFC 2047
	 * @return	boolean	accepted delivery or not
	 */
	static public function mail($to, $subject, $message, $from, $charset, $scheme='B')
	{
		self::$charset = $charset;
		self::$scheme = $scheme;
		
		$to = self::mailbox_list_encoder($to);
		$subject = self::seven_bit_characters_encoder($subject);
		$from = 'From: ' . self::mailbox_list_encoder($from);
		
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
		
		$header  = 'Content-Type: text/html; charset=' . self::$charset . "; format=flowed; delsp=yes\n";
		$header .= "Content-Transfer-Encoding: {$bitcount}\n";
		$header .= "X-Mailer: Nucleus CMS NOTIFICATION class\n";
		
		return mail($to, $subject, $message, "{$from}\n{$header}");
	}
	
	/**
	 * NOTIFICATION::mailbox_list_encoder
	 * Encode multi byte strings included in mailbox.
	 * The format of mailbox is based on RFC 5322, which obsoletes RFC 2822
	 * 
	 * @link	http://www.ietf.org/rfc/rfc5322.txt
	 * @see		3.4. Address Specification
	 * 
	 * @static
	 * @param	string	$mailbox_list		mailbox list
	 * @return	string	encoded string	
	 * 
	 */
	static private function mailbox_list_encoder ($mailbox_list)
	{
		$encoded_mailboxes = array();
		$mailboxes = preg_split('#,#', $mailbox_list);
		foreach ( $mailboxes as $mailbox )
		{
			if ( preg_match("#^([^,]+)?<([^,]+)?@([^,]+)?>$#", $mailbox, $match) )
			{
				$display_name = self::seven_bit_characters_encoder(trim($match[1]));
				$local_part = trim($match[2]);
				$domain = trim($match[3]);
				$encoded_mailboxes[] = "{$display_name} <{$local_part}@{$domain}>";
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
	
	/**
	 * NOTIFICATION::seven_bit_characters_encoder
	 * Encoder into 7bit ASCII expression for Non-ASCII Text based on RFC 2047.
	 * 
	 * @link http://www.ietf.org/rfc/rfc2047.txt
	 * @see 2. Syntax of encoded-words
	 * 
	 * NOTE: RFC 2047 has a ambiguousity for dealing with 'linear-white-space'.
	 *  This causes a trouble related to line breaking between single byte and multi-byte strings.
	 *  To avoid this, single byte string is encoded as well as multi byte string here.
	 * 
	 * NOTE: RFC 2231 also defines the way to use non-ASCII characters in MIME header.
	 * http://www.ietf.org/rfc/rfc2231.txt
	 * 
	 * NOTE: iconv extension give the same functions as this in PHP5
	 * iconv_mime_encode():
	 * http://www.php.net/manual/en/function.iconv-mime-encode.php
	 * 
	 * @static
	 * @param	string	$charset	Character set encoding
	 * @param	string	$type	type of 7 bit encoding, should be 'B' or 'Q'
	 * @param	string	$string	Target string with header field
	 * @return	string	encoded string
	 * 
	 */
	static private function seven_bit_characters_encoder($string)
	{
		$header = chr(13) . chr(10) . chr(32) . '=?' . self::$charset . '?' . self::$scheme . '?';
		$footer = "?=";
		$restriction = 78 - strlen($header) - strlen($footer) ;
		
		$encoded_words = array();
		for ( $i = 0; $i < i18n::strlen($string); $i++ )
		{
			if ( self::$scheme == 'B' )
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
	
	/**
	 * NOTIFICATION::b_encoder()
	 * 
	 * B encoder according to RFC 2047.
	 * The "B" encoding is identical to the "BASE64" encoding defined by RFC 4648.
	 * 
	 * @link http://www.ietf.org/rfc/rfc4648.txt
	 * @see 6.8. Base64 Content-Transfer-Encoding
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
	 * @static
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 */
	static private function b_encoder($target)
	{
		return base64_encode($target);
	}
	
	/**
	 * NOTIFICATION::q_encoder()
	 * 
	 * Q encoder according to RFC 2047.
	 * The "Q" encoding is similar to "Quoted-Printable" content-transfer-encoding defined in RFC 2045,
	 *  but the "Q" encoding and the "Quoted-Printable" are different a bit.
	 * 
	 * @link http://www.ietf.org/rfc/rfc2047.txt
	 * @see 4.2. The "Q" encoding
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
	 * @static
	 * @param	string	$target	targetted string
	 * @return	string	encoded string
	 */
	static private function q_encoder($target)
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
	
	/**
	 * NOTICE: Deprecated
	 * NOTIFICATION::$addresses
	 * 
	 * @deprecated
	 */
	private $addresses = array();
	
	/**
	 * NOTICE: Deprecated
	 * takes one string as argument, containing multiple e-mail addresses
	 * separated by semicolons
	 * eg: site@demuynck.org;nucleus@demuynck.org;foo@bar.com
	 * 
	 * @deprecated
	 */
	function __construct($addresses)
	{
		$this->addresses = preg_split('#;#' , $addresses);
	}
	
	/**
	 * NOTICE: Deprecated
	 * NOTIFICATION::validAddresses()
	 * 
	 * returns true if all addresses are valid
	 * 
	 * @deprecated
	 * @param	Void
	 * @return	Boolean
	 */
	function validAddresses()
	{
		foreach ( $this->addresses as $address )
		{
			if ( !self::address_validation(trim($address)) )
			{
				return 0;
			}
		}
		return 1;
	}
	
	/**
	 * NOTICE: Deprecated
	 * NOTIFICATION::notify()
	 * 
	 * Sends email messages to all the email addresses
	 * 
	 * @deprecated
	 * @param	String	$title	
	 * @param	String	$message	
	 * @param	String	$from	
	 * @return	Void
	 */
	function notify($title, $message, $from)
	{
		global $member;
		$addresses = array();
		
		foreach ($this->addresses as $address)
		{
			if ( $member->isLoggedIn() && ($member->getEmail() == $address) )
			{
				continue;
			}
			$addresses[] = $address;
		}
		
		self::mail(implode(',', $addresses), $title, $message , $from);
		return;
	}
}
