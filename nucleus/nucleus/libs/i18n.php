<?php
/**
 * i18n class for Nucleus CMS
 * written by Takashi Sakamoto as of Feb 03, 2012
 * 
 * This includes wrapper functions of iconv and mbstring
 * for multibyte processing and includes parameters related to locale.
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2011 The Nucleus Group
 * @version $Id$
 */
class i18n
{
	static private $mode = FALSE;
	
	static private $charset = '';
	static private $language = '';
	static private $script = '';
	static private $region = '';
	static private $locale_list = array();
	static private $timezone = 'UTC';
	
	/**
	 * i18n::init
	 * Initializing i18n class
	 * 
	 * @static
	 * @param	string	$charset	character set
	 * @return	boolean	
	 */
	static public function init($charset, $dir)
	{
		/* i18n is already initialized */
		if ( self::$mode )
		{
			return TRUE;
		}
		
		/* make locale list in this Nucleus CMS */
		if ( ($handle = opendir($dir)) === FALSE )
		{
			return FALSE;
		}
		while ($filename = readdir($handle))
		{
			if (preg_match("#^(.+_.+_.+)\.{$charset}\.php$#", $filename, $matches) )
			{
				if ( !in_array($matches[1], self::$locale_list) )
				{
					self::$locale_list[] = $matches[1];
				}
			}
		}
		closedir($handle);
		
		/* set i18n backend and validate character set */
		if ( extension_loaded('iconv') )
		{
			/* this is just for checking the charset. */
			if ( iconv_set_encoding('internal_encoding', $charset)
			 && iconv_set_encoding('output_encoding', $charset)
			 && iconv_set_encoding('internal_encoding', $charset) )
			{
				self::$charset = $charset;
				self::$mode = 'iconv';
			}
		}
		else if ( extension_loaded('mbstring') )
		{
			/* this is just for checking the charset. */
			if ( mb_http_output($charset)
			 && mb_internal_encoding($charset)
			 && mb_regex_encoding($charset) )
			{
				self::$charset = $charset;
				self::$mode = 'mbstring';
			}
		}
		
		return TRUE;
	}
	
	/**
	 * i18n::get_available_locale_list
	 * return available locale list with current charset
	 * 
	 * @static
	 * @param	void
	 * @return	array	available locale list
	 */
	static public function get_available_locale_list()
	{
		return self::$locale_list;
	}
	
	/**
	 * i18n::get_current_charset
	 * return current charset
	 * 
	 * @static
	 * @param	void
	 * @return	string	$charset	current character set
	 */
	static public function get_current_charset()
	{
		return self::$charset;
	}
	
	/**
	 * i18n::set_locale
	 * Set current locale
	 * 
	 * NOTE:
	 * naming rule is "$language_$script_$region.$charset.php", refer to RFC 5646.
	 * @link http://www.ietf.org/rfc/rfc5646.txt
	 * @see 2.  The Language Tag
	 * 
	 * @static
	 * @param	string	$locale
	 * @return	bool	TRUE/FALSE
	 * 
	 */
	static public function set_current_locale($locale)
	{
		if ( preg_match('#^(.+)_(.+)_(.+)$#', $locale, $match) )
		{
			self::$language = $match[1];
			self::$script   = $match[2];
			self::$region   = $match[3];
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * i18n::get_locale
	 * Get current locale
	 * 
	 * @static
	 * @param	void
	 * @return	$locale
	 */
	static public function get_current_locale()
	{
		$elements = array(self::$language, self::$script, self::$region);
		return implode('_', $elements);
	}
	
	/**
	 * i18n::confirm_default_date_timezone
	 * to avoid E_NOTICE or E_WARNING generated when every calling to a date/time function.
	 * 
	 * NOTE:
	 * Some private servers are lack of its timezone setting
	 * http://www.php.net/manual/en/function.date-default-timezone-set.php
	 * 
	 * @static
	 * @param	void
	 * @return	void
	 */
	static public function confirm_default_date_timezone()
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
	
	/**
	 * i18n::get_current_date_timezone()
	 * get current timezone
	 * 
	 * @static
	 * @param	void
	 * @return	$timezone
	 */
	static public function get_date_timezone()
	{
		return self::$timezone;
	}
	
	/**
	 * i18n::convert
	 * character set converter
	 * 
	 * @static
	 * @param	string	$string	target string binary
	 * @param	string	$from	original character set encoding
	 * @param	string	$to	target character set encoding
	 * @return	string	converted string
	 */
	static public function convert($string, $from, $to='')
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
	
	/**
	 * i18n::strlen
	 * strlen wrapper
	 * 
	 * @static
	 * @param	string	$string	target string
	 * @return	integer	the number of letters
	 */
	static public function strlen($string)
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
	
	/**
	 * i18n::strpos
	 * strpos wrapper
	 * 
	 * @static
	 * @param	string	$haystack	string to search
	 * @param	string	$needle	string for search
	 * @param	string	$offset	the position from which the search should be performed. 
	 * @return	integer/FALSE	the numeric position of the first occurrence of needle in haystack
	 */
	static public function strpos($haystack, $needle, $offset=0)
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
	
	/**
	 * i18n::strrpos
	 * strrpos wrapper
	 * 
	 * @static
	 * @param	string	$haystack	string to search
	 * @param	string	$needle	string for search
	 * @return	integer/FALSE	the numeric position of the last occurrence of needle in haystack
	 */
	static public function strrpos ($haystack, $needle)
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
	
	/**
	 * i18n::substr
	 * substr wrapper
	 * 
	 * @static
	 * @param	string	$string	string to be cut
	 * @param	string	$start	the position of starting
	 * @param	integer	$length	the length to be cut
	 * @return	string	the extracted part of string
	 */
	static public function substr($string, $start, $length=0)
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
	
	/**
	 * i18n::explode()
	 * explode function based on multibyte processing with non-pcre regular expressions
	 * 
	 * NOTE: we SHOULD use preg_split function instead of this,
	 *  and I hope this is obsoleted near future...
	 *  
	 *  preg_split()
	 *  http://www.php.net/manual/en/function.preg-split.php
	 * 
	 * @static
	 * @param	string	$delimiter	singlebyte or multibyte delimiter
	 * @param	string	$target	target string
	 * @param	integer	$limit	the number of index for returned array
	 * @return	array	array splitted by $delimiter
	 */
	static public function explode($delimiter, $target, $limit=0)
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
	
	/**
	 * i18n::strftime
	 * strftime function based on multibyte processing
	 * 
	 * @static
	 * @param	string	$format	format with singlebyte or multibyte
	 * @param	timestamp	$timestamp	UNIX timestamp
	 * @return	string	formatted timestamp
	 */
	static public function strftime($format, $timestamp='')
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
		
		$format = trim(preg_replace('#(%[^%])#', ',$1,', $format), ',');
		$elements = preg_split('#,#', $format);
		
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
	
	/**
	 * i18n::formatted_datetime()
	 * return formatted datetime string
	 * 
	 * Date and Time Formats
	 * @link	http://www.w3.org/TR/NOTE-datetime
	 * 
	 * Working with Time Zones
	 * @link	http://www.w3.org/TR/timezone/
	 * 
	 * @param	String	$format	timezone format
	 * @param	String	$timestamp	UNIX timestamp
	 * @param	String	$default_format	default timezone format
	 * @param	Integer	$offset	timestamp offset
	 * @return	String	formatted datetime
	 */
	static public function formatted_datetime($format, $timestamp, $default_format, $offset)
	{
		$suffix = '';
		$string = '';
		
		switch ( $format )
		{
			case 'mysql':
				/*
				 * MySQL 5.0 Reference Manual
				 *  10.3.1. The DATE, DATETIME, and TIMESTAMP Types
				 *   http://dev.mysql.com/doc/refman/5.0/en/datetime.html
				 */
				$timestamp += $offset;
				$format = '%Y-%m-%d %H:%M:%S';
				$suffix ='';
				break;
			
			case 'rfc822':
				/*
				 * RFC 822: STANDARD FOR THE FORMAT OF ARPA INTERNET TEXT MESSAGES
				 *  5.  DATE AND TIME SPECIFICATION
				 *   http://www.ietf.org/rfc/rfc0822.txt
				 */
				$format = 'D, j M Y H:i:s ';
				if ( $offset < 0 )
				{
					$suffix = '-';
					$offset = -$offset;
				}
				else
				{
					$suffix = '+';
				}
				
				$suffix .= sprintf("%02d%02d", floor($offset / 3600), round(($offset % 3600) / 60) );
				break;
			case 'rfc822GMT':
				/*
				 * RFC 822: STANDARD FOR THE FORMAT OF ARPA INTERNET TEXT MESSAGES
				 *  5.  DATE AND TIME SPECIFICATION
				 *   http://www.ietf.org/rfc/rfc0822.txt
				 */
				$format = 'D, j M Y H:i:s ';
				$timestamp -= $offset;
				$suffix = 'GMT';
				break;
			case 'iso8601':
			case 'rfc3339':
				/*
				 * RFC3339: Date and Time on the Internet: Timestamps
				 *  5. Date and Time format
				 *   http://www.ietf.org/rfc/rfc3339.txt
				 */
				$format = 'Y-m-d\TH:i:s';
				if ( $offset < 0 )
				{
					$suffix = '-';
					$offset = -$offset;
				}
				else
				{
					$suffix = '+';
				}
				$suffix .= sprintf("%02d:%02d", floor($offset / 3600), round(($offset % 3600) / 60) );
				break;
			case 'utc':
			case 'iso8601UTC':
			case 'rfc3339UTC':
				/*
				 * RFC3339: Date and Time on the Internet: Timestamps
				 *  5. Date and Time format
				 *   http://www.ietf.org/rfc/rfc3339.txt
				 */
			case 'utc':
				$timestamp -= $offset;
				$format = 'Y-m-d\TH:i:s\Z';
				$suffix = '';
				break;
			case '':
				$format = '%X %x';
				$offset = '';
				break;
			default:
				$suffix = '';
				break;
		}
		return i18n::strftime($format, $timestamp) . $suffix;
	}
	
	/**
	 * i18n::convert_locale_to_old_language_file_name()
	 * NOTE: this should be obsoleted near future.
	 * 
	 * @static
	 * @param	string	$target_locale	locale name as language_script_region
	 * @return	string	old translation file name
	 */
	static public function convert_locale_to_old_language_file_name($target_locale)
	{
		$target_language = '';
		foreach ( self::$lang_refs as $language => $locale )
		{
			if ( preg_match('#-#', $language) )
			{
				if ( $target_locale . '.' . self::$charset == $locale )
				{
					$target_language = $language;
					break;
				}
			}
			else if ( $target_locale == $locale )
			{
				$target_language = $language;
			}
		}
		return $target_language;
	}
	
	/**
	 * i18n::convert_old_language_file_name_to_locale()
	 * NOTE: this should be obsoleted near future.
	 * 
	 * @static
	 * @param	string	$target_language	old translation file name
	 * @return	string	locale name as language_script_region
	 */
	static public function convert_old_language_file_name_to_locale($target_language)
	{
		$target_locale = '';
		foreach ( self::$lang_refs as $language => $locale )
		{
			if ( $target_language == $language )
			{
				if ( preg_match('#^(.+)\.(.+)$#', $locale, $match) )
				{
					$target_locale = $match[1];
				}
				else
				{
					$target_locale = $locale;
				}
				break;
			}
		}
		return $target_locale;
	}
	
	/**
	 * i18n::$lang_refs
	 * reference table to convert old and new way to name translation files.
	 * NOTE: this should be obsoleted as soon as possible.
	 * 
	 * @static
	 */
	static private $lang_refs = array(
		"english"		=> "en_Latn_US",
		"english-utf8"	=> "en_Latn_US.UTF-8",
		"bulgarian"	=> "bg_Cyrl_BG",
		"finnish"		=> "fi_Latn_FU",
		"catalan"		=> "ca_Latn_ES",
		"french"		=> "fr_Latn_FR",
		"russian"		=> "ru_Cyrl_RU",
		"chinese"		=> "zh_Hans_CN",
		"simchinese"	=> "zh_Hans_CN",
		"chineseb5"	=> "zh_Hant_TW",
		"traditional_chinese"	=>	"zh_Hant_TW",
		"galego"		=> "gl_Latn_ES",
		"german"		=> "de_Latn_DE",
		"korean-utf"	=> "ko_Kore_KR.UTF-8",
		"korean-euc-kr"	=> "ko_Kore_KR.EUC-KR",
		"slovak"		=> "sk_Latn_SK",
		"czech"		=> "cs_Latn_CZ",
		"hungarian"	=> "hu_Latn_HU",
		"latvian"		=> "lv_Latn_LV",
		"nederlands"	=> "nl_Latn_NL",
		"italiano"		=> "it_Latn_IT",
		"persian"		=> "fa_Arab_IR",
		"spanish"		=> "es_Latn_ES",
		"spanish-utf8"	=> "es_Latn_ES.UTF-8",
		"japanese-euc"	=> "ja_Jpan_JP.EUC-JP",
		"japanese-utf8"	=> "ja_Jpan_JP.UTF-8",
		"portuguese_brazil"	=> "pt_Latn_BR"
	);
}
