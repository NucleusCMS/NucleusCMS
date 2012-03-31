<?php

class Entity
{
	/**
	 * Entity::hen
	 * htmlentities wrapper
	 * 
	 * @static
	 * @access public
	 * @param	string	$string	target string
	 * @param	string	$quotation	quotation mode. please refer to the argument of PHP built-in htmlentities
	 * @return	string	escaped string
	 */
	static public function hen($string, $quotation=ENT_QUOTES)
	{
		/*
		 * we can use 'double_encode' flag instead of this when dropping supports for PHP 5.2.2 or lower
		 */
		$string = html_entity_decode($string, $quotation, i18n::get_current_charset());
		return (string) htmlentities($string, $quotation, i18n::get_current_charset());
	}
	
	/**
	 * Entity::hsc
	 * htmlspecialchars wrapper
	 * 
	 * NOTE: htmlspecialchars_decode() is ASCII-to-ACII conversion
	 *  and its target string consists of several letters.
	 *   There are no problems.
	 * 
	 * @static
	 * @access public
	 * @param	string	$string	target string
	 * @param	string	$quotation	quotation mode. please refer to the argument of PHP built-in htmlspecialchars
	 * @return	string	escaped string
	 * 
	 */
	static public function hsc($string, $quotation=ENT_QUOTES)
	{
		/*
		 * we can use 'double_encode' flag instead of this when dropping supports for PHP 5.2.2 or lower
		 */
		$string = htmlspecialchars_decode($string, $quotation);
		return (string) htmlspecialchars($string, $quotation, i18n::get_current_charset());
	}
	
	/**
	 * Entity::strip_tags()
	 * Strip HTML tags from a string
	 * 
	 * This function is a bit more intelligent than a regular call to strip_tags(),
	 * because it also deletes the contents of certain tags and cleans up any
	 * unneeded whitespace.
	 * 
	 * @static
	 * @param	String	$string	target string
	 * @return	String	string with stripped tags
	 */
	static public function strip_tags($string)
	{
		$string = preg_replace("#<del[^>]*>.+<\/del[^>]*>#isU", '', $string);
		$string = preg_replace("#<script[^>]*>.+<\/script[^>]*>#isU", '', $string);
		$string = preg_replace("#<style[^>]*>.+<\/style[^>]*>#isU", '', $string);
		$string = preg_replace('#>#', '> ', $string);
		$string = preg_replace('#<#', ' <', $string);
		$string = strip_tags($string);
		$string = preg_replace("#\s+#", " ", $string);
		$string = trim($string);
		return $string;
	}
	
	/**
	 * shortens a text string to maxlength.
	 * $suffix is what needs to be added at the end (end length is <= $maxlength)
	 *
	 * The purpose is to limit the width of string for rendered screen in web browser.
	 * So it depends on style sheet, browser's rendering scheme, client's system font.
	 *
	 * NOTE: In general, non-Latin font such as Japanese, Chinese, Cyrillic have two times as width as Latin fonts,
	 *  but this is not always correct, for example, rendered by proportional font.
	 *
	 * @static
	 * @param string $escaped_string target string
	 * @param integer $maxlength maximum length of return string which includes suffix
	 * @param string $suffix added in the end of shortened-string
	 * @return string
	 */
	static public function shorten($string, $maxlength, $suffix)
	{
		static $flag;
		
		$decoded_entities_pcre = array();
		$encoded_entities = array();
		
		/* 1. store html entities */
		preg_match('#&[^&]+?;#', $string, $encoded_entities);
		if ( !$encoded_entities )
		{
			$flag = FALSE;
		}
		else
		{
			$flag = TRUE;
		}
		if ( $flag )
		{
			foreach ( $encoded_entities as $encoded_entity )
			{
				$decoded_entities_pcre[] = '#' . html_entity_decode($encoded_entity, ENT_QUOTES, i18n::get_current_charset()) . '#';
			}
		}
		
		/* 2. decode string */
		$string = html_entity_decode($string, ENT_QUOTES, i18n::get_current_charset());
		
		/* 3. shorten string and add suffix if string length is longer */
		if ( i18n::strlen($string) > $maxlength - i18n::strlen($suffix) )
		{
			$string = i18n::substr($string, 0, $maxlength - i18n::strlen($suffix) );
			$string .= $suffix;
		}
		
		/* 4. recover entities */
		if ( $flag )
		{
			$string = preg_replace($decoded_entities_pcre, $encoded_entities, $string);
		}
		
		return $string;
	}
	
	/**
	 * Entity::highlight()
	 * highlights a specific query in a given HTML text (not within HTML tags)
	 * 
	 * @static
	 * @param	string $text text to be highlighted
	 * @param	string $expression regular expression to be matched (can be an array of expressions as well)
	 * @param	string $highlight highlight to be used (use \\0 to indicate the matched expression)
	 * @return	string
	 */
	static public function highlight($text, $expression, $highlight)
	{
		if ( !$highlight || !$expression )
		{
			return $text;
		}
		
		if ( is_array($expression) && (count($expression) == 0) )
		{
			return $text;
		}
		
		$text = "<!--h-->{$text}";
		preg_match_all('#(<[^>]+>)([^<>]*)#', $text, $matches);
		$result = '';
		$count = count($matches[2]);
		
		for ( $i = 0; $i < $count; $i++ )
		{
			if ( $i != 0 )
			{
				$result .= $matches[1][$i];
			}
			
			if ( is_array($expression) )
			{
				foreach ( $expression as $regex )
				{
						$matches[2][$i] = preg_replace("#{$regex}#i", $highlight, $matches[2][$i]);
				}
				$result .= $matches[2][$i];
			}
			else
			{
				$result .= preg_replace("#{$expression}#i", $highlight, $matches[2][$i]);
			}
		}
		return $result;
	}
	
	/**
	 * Entity::anchor_footnoting()
	 * change strings with footnoticing generated from anchor elements
	 * 
	 * @static
	 * @param	String	$string	strings which includes html elements
	 * @return	String	string with footnotes
	 */
	static public function anchor_footnoting($string)
	{
		/* 1. detect anchor elements */
		$anchors = array();
		if ( !preg_match_all("#<a[^>]*href=[\"\']([^\"^']*)[\"\'][^>]*>([^<]*)<\/a>#i", $subject, $anchors) )
		{
			return $string;
		}
		
		/* 2. add footnotes */
		$string .= "\n\n";
		$count = 1;
		foreach ( $anchors as $anchor )
		{
			preg_replace("#{$anchor[0]}#", "{$anchor[2]} [{$count}] ", $subject);
			$subject .= "[{$count}] {$anchor[1]}\n";
			$count++;
		}
		
		return strip_tags($ascii);
	}
	
	/*
	 * NOTE: Obsoleted functions
	 */
	
	/**
	 * Entity::named_to_numeric()
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function named_to_numeric ($string)
	{
		$string = preg_replace('/(&[0-9A-Za-z]+)(;?\=?|([^A-Za-z0-9\;\:\.\-\_]))/e', "Entity::_named('\\1', '\\2') . '\\3'", $string);
		return $string;
	}
	
	/**
	 * Entity::named_to_numeric()
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function normalize_numeric ($string) {
		$string = preg_replace('/&#([0-9]+)(;)?/e', "'&#x'.dechex('\\1').';'", $string);
		$string = preg_replace('/&#[Xx](0)*([0-9A-Fa-f]+)(;?|([^A-Za-z0-9\;\:\.\-\_]))/e', "'&#x' . strtoupper('\\2') . ';\\4'", $string);
		$string = strtr($string, self::$entities['Windows-1252']);
		return $string;
	}
	
	/**
	 * Entity::numeric_to_utf8()
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function numeric_to_utf8 ($string) {
		$string = preg_replace('/&#([0-9]+)(;)?/e', "'&#x'.dechex('\\1').';'", $string);
		$string = preg_replace('/&#[Xx](0)*([0-9A-Fa-f]+)(;?|([^A-Za-z0-9\;\:\.\-\_]))/e', "'&#x' . strtoupper('\\2') . ';\\4'", $string);
		$string = preg_replace('/&#x([0-9A-Fa-f]+);/e', "Entity::_hex_to_utf8('\\1')", $string);		
		return $string; 	
	}
	
	/**
	 * Entity::numeric_to_named()
	 * convert decimal and hexadecimal numeric character references into named character references
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function numeric_to_named ($string)
	{
		$string = preg_replace('/&#[Xx]([0-9A-Fa-f]+)/e', "'&#'.hexdec('\\1')", $string);
		$string = strtr($string, array_flip(self::$entities['named_to_numeric']));
		return $string;	
	}
	
	/**
	 * Entity::specialchars()
	 * convert HTML entities to named character reference
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function specialchars ($string, $type = 'xml')
	{
		$specialchars = array(
			'"'		=> '&quot;',
			'&'		=> '&amp;',
			'<'		=> '&lt;',
			'>'		=> '&gt;'
		);
		if ( $type != 'xml' )
		{
			$specialchars["'"] = '&#39;';
		}
		else
		{
			$specialchars["'"] = '&apos;';
		}
		
		$string = preg_replace('/&(#?[Xx]?[0-9A-Za-z]+);/', "[[[ENTITY:\\1]]]", $string);
		$string = strtr($string, $specialchars);
		$string = preg_replace('/\[\[\[ENTITY\:([^\]]+)\]\]\]/', "&\\1;", $string);		
		return $string;
	}
	
	/**
	 * Entity::_hex_to_utf8()
	 * convert decimal numeric character references to hexadecimal numeric character references
	 * 
	 * @deprecated
	 * @param String $string
	 */
	function _hex_to_utf8($s)
	{
		$c = hexdec($s);
		
		if ( $c < 0x80 )
		{
			$str = chr($c);
		}
		else if ( $c < 0x800 )
		{
			$str = chr(0xC0 | $c>>6) . chr(0x80 | $c & 0x3F);
		}
		else if ( $c < 0x10000 )
		{
			$str = chr(0xE0 | $c>>12) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F);
		}
		else if ( $c < 0x200000 )
		{
			$str = chr(0xF0 | $c>>18) . chr(0x80 | $c>>12 & 0x3F) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F);
		}
		return $str;
	}
	
	/**
	 * Entity::_named()
	 * convert entities to named character reference
	 * 
	 * @deprecated
	 * @param String $string
	 * @param	String	$extra
	 * @return	
	 */
	function _named($entity, $extra)
	{
		if ( $extra == '=' )
		{
			return $entity . '=';
		}
		
		$length = i18n::strlen($entity);
		
		while ( $length > 0 )
		{
			$check = i18n::substr($entity, 0, $length);
			if ( array_key_exists($check, self::$entities['named_to_numeric']) )
			{
				return self::$entities['named_to_numeric'][$check] . ';' . i18n::substr($entity, $length);
			}
			$length--;
		}
		
		if ( $extra != ';' )
		{
			return $entity;
		}
		else
		{
			return "{$entity};";
		}
	}
	
	/**
	 * ENTITIY::$entities
	 * 
	 * HTML 4.01 Specification
	 * @link	http://www.w3.org/TR/html4/sgml/entities.html
	 * @see	24 Character entity references in HTML 4
	 * 
	 * XHTML™ 1.0 The Extensible HyperText Markup Language (Second Edition)
	 *  A Reformulation of HTML 4 in XML 1.0
	 * @link	http://www.w3.org/TR/xhtml1/
	 * @see	4.12. Entity references as hex values
	 * @see	C.16. The Named Character Reference &apos;
	 * 
	 * @static
	 * @deprecated
	 */
	static private $entities = array (
		'named_to_numeric' => array (
			'&nbsp'	=>	'&#x00A0',
			'&iexcl'	=>	'&#x00A1',
			'&cent'	=>	'&#x00A2',
			'&pound'	=>	'&#x00A3',
			'&curren'	=>	'&#x00A4',
			'&yen'		=>	'&#x00A5',
			'&brvbar'	=>	'&#x00A6',
			'&sect'	=>	'&#x00A7',
			'&uml'		=>	'&#x00A8',
			'&copy'	=>	'&#x00A9',
			'&ordf'	=>	'&#x00AA',
			'&laquo'	=>	'&#x00AB',
			'&not'		=>	'&#x00AC',
			'&shy'		=>	'&#x00AD',
			'&reg'		=>	'&#x00AE',
			'&macr'	=>	'&#x00AF',
			'&deg'		=>	'&#x00B0',
			'&plusmn'	=>	'&#x00B1',
			'&sup2'	=>	'&#x00B2',
			'&sup3'	=>	'&#x00B3',
			'&acute'	=>	'&#x00B4',
			'&micro'	=>	'&#x00B5',
			'&para'	=>	'&#x00B6',
			'&middot'	=>	'&#x00B7',
			'&cedil'	=>	'&#x00B8',
			'&sup1'	=>	'&#x00B9',
			'&ordm'	=>	'&#x00BA',
			'&raquo'	=>	'&#x00BB',
			'&frac14'	=>	'&#x00BC',
			'&frac12'	=>	'&#x00BD',
			'&frac34'	=>	'&#x00BE',
			'&iquest'	=>	'&#x00BF',
			'&Agrave'	=>	'&#x00C0',
			'&Aacute'	=>	'&#x00C1',
			'&Acirc'	=>	'&#x00C2',
			'&Atilde'	=>	'&#x00C3',
			'&Auml'	=>	'&#x00C4',
			'&Aring'	=>	'&#x00C5',
			'&AElig'	=>	'&#x00C6',
			'&Ccedil'	=>	'&#x00C7',
			'&Egrave'	=>	'&#x00C8',
			'&Eacute'	=>	'&#x00C9',
			'&Ecirc'	=>	'&#x00CA',
			'&Euml'	=>	'&#x00CB',
			'&Igrave'	=>	'&#x00CC',
			'&Iacute'	=>	'&#x00CD',
			'&Icirc'	=>	'&#x00CE',
			'&Iuml'	=>	'&#x00CF',
			'&ETH'		=>	'&#x00D0',
			'&Ntilde'	=>	'&#x00D1',
			'&Ograve'	=>	'&#x00D2',
			'&Oacute'	=>	'&#x00D3',
			'&Ocirc'	=>	'&#x00D4',
			'&Otilde'	=>	'&#x00D5',
			'&Ouml'	=>	'&#x00D6',
			'&times'	=>	'&#x00D7',
			'&Oslash'	=>	'&#x00D8',
			'&Ugrave'	=>	'&#x00D9',
			'&Uacute'	=>	'&#x00DA',
			'&Ucirc'	=>	'&#x00DB',
			'&Uuml'	=>	'&#x00DC',
			'&Yacute'	=>	'&#x00DD',
			'&THORN'	=>	'&#x00DE',
			'&szlig'	=>	'&#x00DF',
			'&agrave'	=>	'&#x00E0',
			'&aacute'	=>	'&#x00E1',
			'&acirc'	=>	'&#x00E2',
			'&atilde'	=>	'&#x00E3',
			'&auml'	=>	'&#x00E4',
			'&aring'	=>	'&#x00E5',
			'&aelig'	=>	'&#x00E6',
			'&ccedil'	=>	'&#x00E7',
			'&egrave'	=>	'&#x00E8',
			'&eacute'	=>	'&#x00E9',
			'&ecirc'	=>	'&#x00EA',
			'&euml'	=>	'&#x00EB',
			'&igrave'	=>	'&#x00EC',
			'&iacute'	=>	'&#x00ED',
			'&icirc'	=>	'&#x00EE',
			'&iuml'	=>	'&#x00EF',
			'&eth'		=>	'&#x00F0',
			'&ntilde'	=>	'&#x00F1',
			'&ograve'	=>	'&#x00F2',
			'&oacute'	=>	'&#x00F3',
			'&ocirc'	=>	'&#x00F4',
			'&otilde'	=>	'&#x00F5',
			'&ouml'	=>	'&#x00F6',
			'&divide'	=>	'&#x00F7',
			'&oslash'	=>	'&#x00F8',
			'&ugrave'	=>	'&#x00F9',
			'&uacute'	=>	'&#x00FA',
			'&ucirc'	=>	'&#x00FB',
			'&uuml'	=>	'&#x00FC',
			'&yacute'	=>	'&#x00FD',
			'&thorn'	=>	'&#x00FE',
			'&yuml'	=>	'&#x00FF',
			'&OElig'	=>	'&#x0152',
			'&oelig'	=>	'&#x00E5',
			'&Scaron'	=>	'&#x0160',
			'&scaron'	=>	'&#x0161',
			'&Yuml'	=>	'&#x0178',
			'&circ'	=>	'&#x02C6',
			'&tilde'	=>	'&#x02DC',
			'&esnp'	=>	'&#x2002',
			'&emsp'	=>	'&#x2003',
			'&thinsp'	=>	'&#x2009',
			'&zwnj'	=>	'&#x200C',
			'&zwj'		=>	'&#x200D',
			'&lrm'		=>	'&#x200E',
			'&rlm'		=>	'&#x200F',
			'&ndash'	=>	'&#x2013',
			'&mdash'	=>	'&#x2014',
			'&lsquo'	=>	'&#x2018',
			'&rsquo'	=>	'&#x2019',
			'&sbquo'	=>	'&#x201A',
			'&ldquo'	=>	'&#x201C',
			'&rdquo'	=>	'&#x201D',
			'&bdquo'	=>	'&#x201E',
			'&dagger'	=>	'&#x2020',
			'&Dagger'	=>	'&#x2021',
			'&permil'	=>	'&#x2030',
			'&lsaquo'	=>	'&#x2039',
			'&rsaquo'	=>	'&#x203A',
			'&euro'	=>	'&#x20AC',
			'&fnof'	=>	'&#x0192',
			'&Alpha'	=>	'&#x0391',
			'&Beta'	=>	'&#x0392',
			'&Gamma'	=>	'&#x0393',
			'&Delta'	=>	'&#x0394',
			'&Epsilon'	=>	'&#x0395',
			'&Zeta'	=>	'&#x0396',
			'&Eta'		=>	'&#x0397',
			'&Theta'	=>	'&#x0398',
			'&Iota'	=>	'&#x0399',
			'&Kappa'	=>	'&#x039A',
			'&Lambda'	=>	'&#x039B',
			'&Mu'		=>	'&#x039C',
			'&Nu'		=>	'&#x039D',
			'&Xi'		=>	'&#x039E',
			'&Omicron'	=>	'&#x039F',
			'&Pi'		=>	'&#x03A0',
			'&Rho'		=>	'&#x03A1',
			'&Sigma'	=>	'&#x03A3',
			'&Tau'		=>	'&#x03A4',
			'&Upsilon'	=>	'&#x03A5',
			'&Phi'		=>	'&#x03A6',
			'&Chi'		=>	'&#x03A7',
			'&Psi'		=>	'&#x03A8',
			'&Omega'	=>	'&#x03A9',
			'&alpha'	=>	'&#x03B1',
			'&beta'	=>	'&#x03B2',
			'&gamma'	=>	'&#x03B3',
			'&delta'	=>	'&#x03B4',
			'&epsilon'	=>	'&#x03B5',
			'&zeta'	=>	'&#x03B6',
			'&eta'		=>	'&#x03B7',
			'&theta'	=>	'&#x03B8',
			'&iota'	=>	'&#x03B9',
			'&kappa'	=>	'&#x03BA',
			'&lambda'	=>	'&#x03BB',
			'&mu'		=>	'&#x03BC',
			'&nu'		=>	'&#x03BD',
			'&xi'		=>	'&#x03BE',
			'&omicron'	=>	'&#x03BF',
			'&pi'		=>	'&#x03C0',
			'&rho'		=>	'&#x03C1',
			'&sigmaf'	=>	'&#x03C2',
			'&sigma'	=>	'&#x03C3',
			'&tau'		=>	'&#x03C4',
			'&upsilon'	=>	'&#x03C5',
			'&phi'		=>	'&#x03C6',
			'&chi'		=>	'&#x03C7',
			'&psi'		=>	'&#x03C8',
			'&omega'	=>	'&#x03C9',
			'&thetasym'	=>	'&#x03D1',
			'&upsih'	=>	'&#x03D2',
			'&piv'		=>	'&#x03D6',
			'&bull'	=>	'&#x2022',
			'&hellip'	=>	'&#x2026',
			'&prime'	=>	'&#x2032',
			'&Prime'	=>	'&#x2033',
			'&oline'	=>	'&#x203E',
			'&frasl'	=>	'&#x2044',
			'&weierp'	=>	'&#x2118',
			'&image'	=>	'&#x2111',
			'&real'	=>	'&#x211C',
			'&trade'	=>	'&#x2112',
			'&alefsym'	=>	'&#x2135',
			'&larr'	=>	'&#x2190',
			'&uarr'	=>	'&#x2191',
			'&rarr'	=>	'&#x2192',
			'&darr'	=>	'&#x2193',
			'&harr'	=>	'&#x2194',
			'&crarr'	=>	'&#x21B5',
			'&lArr'	=>	'&#x21D0',
			'&uArr'	=>	'&#x21D1',
			'&rArr'	=>	'&#x21D2',
			'&dArr'	=>	'&#x21D3',
			'&hArr'	=>	'&#x21D4',
			'&forall'	=>	'&#x2200',
			'&part'	=>	'&#x2202',
			'&exist'	=>	'&#x2203',
			'&empty'	=>	'&#x2205',
			'&nabla'	=>	'&#x2207',
			'&isin'	=>	'&#x2208',
			'&notin'	=>	'&#x2209',
			'&ni'		=>	'&#x220B',
			'&prod'	=>	'&#x220F',
			'&sum'		=>	'&#x2211',
			'&minus'	=>	'&#x2212',
			'&lowast'	=>	'&#x2217',
			'&radic'	=>	'&#x221A',
			'&prop'	=>	'&#x221D',
			'&infin'	=>	'&#x221E',
			'&ang'		=>	'&#x2220',
			'&and'		=>	'&#x2227',
			'&or'		=>	'&#x2228',
			'&cap'		=>	'&#x2229',
			'&cup'		=>	'&#x222A',
			'&int'		=>	'&#x222B',
			'&there4'	=>	'&#x2234',
			'&sim'		=>	'&#x223C',
			'&cong'	=>	'&#x2245',
			'&asymp'	=>	'&#x2248',
			'&ne'		=>	'&#x2260',
			'&equiv'	=>	'&#x2261',
			'&le'		=>	'&#x2264',
			'&ge'		=>	'&#x2265',
			'&sub'		=>	'&#x2282',
			'&sup'		=>	'&#x2283',
			'&nsub'	=>	'&#x2284',
			'&sube'	=>	'&#x2286',
			'&supe'	=>	'&#x2287',
			'&oplus'	=>	'&#x2295',
			'&otimes'	=>	'&#x2296',
			'&perp'	=>	'&#x22A5',
			'&sdot'	=>	'&#x22C5',
			'&lceil'	=>	'&#x2368',
			'&rceil'	=>	'&#x2309',
			'&lfloor'	=>	'&#x230A',
			'&rfloor'	=>	'&#x230B',
			'&lang'	=>	'&#x2329',
			'&rang'	=>	'&#x2330',
			'&loz'		=>	'&#x25CA',
			'&spades'	=>	'&#x2660',
			'&clubs'	=>	'&#x2663',
			'&hearts'	=>	'&#x2665',
			'&diams'	=>	'&#x2666'
		),
		'Windows-1252' => array(
			'&#x80;'	=>	'&#x20AC;',
			'&#x82;'	=>	'&#x201A;',
			'&#x83;'	=>	'&#x0192;',
			'&#x84;'	=>	'&#x201E;',
			'&#x85;'	=>	'&#x2026;',
			'&#x86;'	=>	'&#x2020;',
			'&#x87;'	=>	'&#x2021;',
			'&#x88;'	=>	'&#x02C6;',
			'&#x89;'	=>	'&#x2030;',
			'&#x8A;'	=>	'&#x0160;',
			'&#x8B;'	=>	'&#x2039;',
			'&#x8C;'	=>	'&#x0152;',
			'&#x8E;'	=>	'&#x017D;',
			'&#x91;'	=>	'&#x2018;',
			'&#x92;'	=>	'&#x2019;',
			'&#x93;'	=>	'&#x201C;',
			'&#x94;'	=>	'&#x201D;',
			'&#x95;'	=>	'&#x2022;',
			'&#x96;'	=>	'&#x2013;',
			'&#x97;'	=>	'&#x2014;',
			'&#x98;'	=>	'&#x02DC;',
			'&#x99;'	=>	'&#x2122;',
			'&#x9A;'	=>	'&#x0161;',
			'&#x9B;'	=>	'&#x203A;',
			'&#x9C;'	=>	'&#x0153;',
			'&#x9E;'	=>	'&#x017E;',
			'&#x9F;'	=>	'&#x0178;',
		)
	);
}
