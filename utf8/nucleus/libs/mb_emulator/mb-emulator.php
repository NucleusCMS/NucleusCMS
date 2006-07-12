<?php
/* mb-emulator.php by Andy
 * email : webmaster@matsubarafamily.com
 *
 * license based on GPL(GNU General Public License)
 *
 * Ver.0.37 (2005/1/30)
 */



include dirname(__FILE__).'/convert.table';
include dirname(__FILE__).'/sjistouni.table';
include dirname(__FILE__).'/unitosjis.table';

$ini_file = parse_ini_file(dirname(__FILE__).'/mb-emulator.ini');

$_language = $ini_file['language'];
$_internal_encoding = $ini_file['internal_encoding'];
$_lang_array = array (
	'Japanese', 'ja', 'English', 'en', 'uni'
	);

$_mb_encoding = array (
	'AUTO' => 0,
	'ASCII' => 0,
	'EUC-JP' => 1,
	'EUC' => 1,
	'SJIS' => 2,
	'SHIFT-JIS' => 2,
	'SJIS-WIN' => 2,
	'JIS' => 3,
	'ISO-2022-JP' => 3,
	'UTF-8' => 4,
	'UTF8' => 4,
	'UTF-16'=>5
	);

if (!(mb_detect_order($ini_file['detect_order'])))
	$_detect_order = array ("ASCII", "JIS", "UTF-8", "EUC-JP", "SJIS");



$sjis_match = "[\x81-\x9F,\xE0-\xFC]([\x40-\xFC])|[\x01-\x7F]|[\xA0-\xDF]";
$euc_match = "[\xa1-\xfe]([\xa1-\xfe])|[\x01-\x7f]|\x8e([\xa0-\xdf])";
$utf8_match = "[\x01-\x7F]|[\xC0-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF][\x80-\xBF]";
$jis_match = "(?:^|\x1b\(\x42)([^\x1b]*)|(?:\x1b\\$\x42([^\x1b]*))|(?:\x1b\(I([^\x1b]*))";

function mb_language($language)
{
  global $_language, $_lang_array;

  if ($language =='') {
    if ($_language == '') return FALSE;
    else return $_language;
  } else {
	foreach ($_lang_array as $element) {
		if ($element == $language) {
			$_language = $language;
			return TRUE;
		}
	}
	return FALSE;
  }
}


function mb_internal_encoding($encoding = '')
{
  global $_internal_encoding;

  if ($encoding =='') {
    if ($_internal_encoding == '') return FALSE;
    else return $_internal_encoding;
  } else {
		$_internal_encoding = $encoding;
		return TRUE;
  }
}



function mb_convert_encoding( $str, $to_encoding, $from_encoding = '')
{
	global $_internal_encoding, $_mb_encoding;

	$to_encoding = strtoupper($to_encoding);
	$from_encoding = mb_detect_encoding($str, $from_encoding);
	
	switch ($_mb_encoding[$from_encoding]) {
		case 1: //euc-jp
			switch($_mb_encoding[$to_encoding]) {
				case 2: //sjis
					return _euctosjis($str);
				case 3: //jis
					$str = _euctosjis($str);
					return _sjistojis($str);
				case 4: //utf8
					return _euctoutf8($str);
				case 5: //utf16
					$str = _euctoutf8($str);
					return _utf8toutf16($str);
				default:
					return $str;
			}
		case 2: //sjis
			switch($_mb_encoding[$to_encoding]) {
				case 1: //euc-jp
					return _sjistoeuc($str);
				case 3: //jis
					return _sjistojis($str);
				case 4: //utf8
					return _sjistoutf8($str);
				case 5: //utf16
					$str = _sjistoutf8($str);
					return _utf8toutf16($str);
				default:
					return $str;
			}
		case 3: //jis
			switch($_mb_encoding[$to_encoding]) {
				case 1: //euc-jp
					$str = _jistosjis($str);
					return _sjistoeuc($str);
				case 2: //sjis
					return _jistosjis($str);
				case 4: //utf8
					$str = _jistosjis($str);
					return _sjistoutf8($str);
				case 5: //utf16
					$str = _jistosjis($str);
					$str = _sjistoutf8($str);
					return _utf8toutf16($str);
				default:
					return $str;
			}
		case 4: //utf8
			switch($_mb_encoding[$to_encoding]) {
				case 1: //euc-jp
					return _utf8toeuc($str);
				case 2: //sjis
					return _utf8tosjis($str);
				case 3: //jis
					$str = _utf8tosjis($str);
					return _sjistojis($str);
				case 5: //utf16
					return _utf8toutf16($str);
				default:
					return $str;
			}
		case 5: //utf16
			$str = _utf16toutf8($str);
			switch($_mb_encoding[$to_encoding]) {
				case 1: //euc-jp
					return _utf8toeuc($str);
				case 2: //sjis
					return _utf8tosjis($str);
				case 3: //jis
					$str = _utf8tosjis($str);
					return _sjistojis($str);
				case 4: //utf8
					return $str;
				default:
					return _utf8toutf16($str);
			}
		default:
			return $str;
	}
}

function _get_encoding(&$str, $encoding)
{
	global $_internal_encoding, $_mb_encoding;

	if ($encoding =='') {
		if ($_internal_encoding == '') {
			return mb_detect_encoding($str, mb_detect_order());
		} else {
			return $_internal_encoding;
		}
	}
	return strtoupper($encoding);
}



function _sjistoeuc(&$str)
{
	global $sjis_match, $_sjistoeuc_byte1, $_sjistoeuc_byte2, $_sjistoeuc_byte1_shift;
	
	$max = preg_match_all("/$sjis_match/", $str, $allchars);  // 文字の配列に分解
	$str_EUC = '';
	for ($i = 0; $i < $max; ++$i) {
		$num = ord($allchars[0][$i]);  // 各文字の1バイト目を数値として取り出す
		if ($num2 = ord($allchars[1][$i])) { // 2バイト目がある場合
			$shift = $_sjistoeuc_byte1_shift[$num2];
			$str_EUC .= chr($_sjistoeuc_byte1[$num] + $shift)
					   .chr($_sjistoeuc_byte2[$shift][$num2]);
		} elseif ($num <= 0x7F) {//英数字
			$str_EUC .= chr($num);
		} else { //半角カナ
			$str_EUC .= chr(0x8E).chr($num);
		}
	}
	return $str_EUC;
}


function _euctosjis(&$str)
{
	global $euc_match, $_euctosjis_byte1, $_euctosjis_byte2;
	$max = preg_match_all("/$euc_match/", $str, $allchars);  // 文字の配列に分解
	$str_SJIS = '';
	for ($i = 0; $i < $max; ++$i) {
		$num = ord($allchars[0][$i]);  // 各文字の1バイト目を数値として取り出す
		if ($num2 = ord($allchars[1][$i])) { // 漢字の場合
			$str_SJIS .= chr($_euctosjis_byte1[$num]);
			if ($num & 1)
				$str_SJIS .= chr($_euctosjis_byte2[0][$num2]);
			else
				$str_SJIS .= chr($_euctosjis_byte2[1][$num2]);
		} elseif ($num3 = ord($allchars[2][$i])) {//半角カナ
			$str_SJIS .= chr($num3);
		} else { //英数字
			$str_SJIS .= chr($num);
		}
	}
	return $str_SJIS;
}

function _sjistojis(&$str)
{
	global $sjis_match, $_sjistoeuc_byte1, $_sjistoeuc_byte2, $_sjistoeuc_byte1_shift;
	
	$max = preg_match_all("/$sjis_match/", $str, $allchars);  // 文字の配列に分解
	$str_JIS = '';
	$mode = 0; // 英数
	for ($i = 0; $i < $max; ++$i) {
		$num = ord($allchars[0][$i]);  // 各文字の1バイト目を数値として取り出す
		if ($num2 = ord($allchars[1][$i])) { // 2バイト目がある場合
			if ($mode != 1) {
				$mode = 1;
				$str_JIS .= chr(0x1b).'$B';
			}
			$shift = $_sjistoeuc_byte1_shift[$num2];
			$str_JIS .= chr(($_sjistoeuc_byte1[$num] + $shift) & 0x7F)
					   .chr($_sjistoeuc_byte2[$shift][$num2] & 0x7F);
		} elseif ($num > 0x80) {//半角カナ
			if ($mode != 2) {
				$mode = 2;
				$str_JIS .= chr(0x1B).'(I';
			}
			$str_JIS .= chr($num & 0x7F);
		} else {//半角英数
			if ($mode != 0) {
				$mode = 0;
				$str_JIS .= chr(0x1B).'(B';
			}
			$str_JIS .= chr($num);
		}
	}
	if ($mode != 0) {
		$str_JIS .= chr(0x1B).'(B';
	}
	return $str_JIS;
}

function _sub_jtosj($match)
{
	global $_euctosjis_byte1, $_euctosjis_byte2;
	$num = ord($match[0]);
	$num2 = ord($match[1]);
	$s = chr($_euctosjis_byte1[$num | 0x80]);
	if ($num & 1) {
		$s .= chr($_euctosjis_byte2[0][$num2 | 0x80]);
	} else {
		$s .= chr($_euctosjis_byte2[1][$num2 | 0x80]);
	}
	return $s;
}

function _jistosjis(&$str)
{
	global $_euctosjis_byte1, $_euctosjis_byte2, $jis_match;
	
	$max = preg_match_all("/$jis_match/", $str, $allchunks, PREG_SET_ORDER);  // 文字種ごとの配列に分解
	$st = '';
	for ($i = 0; $i < $max; ++$i) {
		if (ord($allchunks[$i][1])) { //英数にマッチ
			$st .= $allchunks[$i][1];
		} elseif (ord($allchunks[$i][2])) { //漢字にマッチ
			$tmp = substr($allchunks[$i][0], 3, strlen($allchunks[$i][0]));
			$st .= preg_replace_callback("/.(.)/","_sub_jtosj", $tmp);
		} elseif (ord($allchunks[$i][3])) { //半角カナにマッチ
			$st .= preg_replace("/./e","chr(ord['$1'] | 0x80);",$allchunks[$i][3]);
		}
	}
	return $st;
}


function _ucs2utf8($uni)
{
	if ($uni <= 0x7f)
		return chr($uni);
	elseif ($uni <= 0x7ff) {
		$y = ($uni >> 6) & 0x1f;
		$x = $uni & 0x3f;
		return chr(0xc0 | $y).chr(0x80 | $x);
	} else {
		$z = ($uni >> 12) & 0x0f;
		$y = ($uni >> 6) & 0x3f;
		$x = $uni & 0x3f;
		return chr(0xe0 | $z).chr(0x80 | $y).chr(0x80 | $x);
	}
}

function _sjistoutf8(&$str)
{

	global $sjis_match, $sjistoucs2;
	$st = '';
	$max = preg_match_all("/$sjis_match/", $str, $allchars);  // 文字の配列に分解
	for ($i = 0; $i < $max; ++$i) {
		$num = ord($allchars[0][$i]);  // 各文字の1バイト目を数値として取り出す
		if ($num2 = ord($allchars[1][$i])) { // 2バイト目がある場合
			$ucs2 = $sjistoucs2[($num << 8) | $num2];
			$st .= _ucs2utf8($ucs2);
		} elseif ($num > 0x80) {//半角カナ
			$st .= _ucs2utf8(0xfec0 + $num);
		} else {//半角英数
			$st .= chr($num);
		}
	}
	return $st;
}

function _utf8ucs2($st)
{
	$num = ord($st);
	if (!($num & 0x80)) //1byte
		return $num;
	elseif (($num & 0xe0) == 0xc0) {//2bytes
		$num2 = ord(substr($st, 1,1));
		return (($num & 0x1f) << 6) | ($num2 & 0x3f);
	} else  { //3bytes
		$num2 = ord(substr($st, 1,1));
		$num3 = ord(substr($st, 2,1));
		return (($num & 0x0f) << 12) | (($num2 & 0x3f) << 6) | ($num3 & 0x3f);
	}
}

function _utf8tosjis(&$str)
{
	global $utf8_match, $ucs2tosjis;
	$st = '';
	$max = preg_match_all("/$utf8_match/", $str, $allchars);  // 文字の配列に分解
	for ($i = 0; $i < $max; ++$i) {
		$num = _utf8ucs2($allchars[0][$i]); //ucs2の値を取り出す
		if ($num < 0x80)
			$st .= chr($num);
		elseif ((0xff61 <= $num) && ($num <= 0xff9f))
			$st .= chr($num - 0xfec0);
		else {
			$sjis = $ucs2tosjis[$num];
			$st .= chr($sjis >> 8) . chr($sjis & 0xff);
		}
	}
	return $st;
}

function _euctoutf8(&$str)
{
	global $euc_match, $sjistoucs2, $_euctosjis_byte1, $_euctosjis_byte2;
	$st = '';
	$max = preg_match_all("/$euc_match/", $str, $allchars);  // 文字の配列に分解
	for ($i = 0; $i < $max; ++$i) {
		$num = ord($allchars[0][$i]);  // 各文字の1バイト目を数値として取り出す
		if ($num2 = ord($allchars[1][$i])) { // 2バイト目がある場合
			if ($num & 1)
				$sjis = ($_euctosjis_byte1[$num] << 8) | $_euctosjis_byte2[0][$num2];
			else
				$sjis = ($_euctosjis_byte1[$num] << 8) | $_euctosjis_byte2[1][$num2];
			$st .= _ucs2utf8($sjistoucs2[$sjis]);
		} elseif ($num3 = ord($allchars[2][$i])) {
			$st .= _ucs2utf8(0xfec0 + $num3);
		} else {//半角英数
			$st .= chr($num);
		}
	}
	return $st;
}

function _utf8toeuc(&$str)
{
	global $utf8_match, $ucs2tosjis, $_sjistoeuc_byte1, $_sjistoeuc_byte2, $_sjistoeuc_byte1_shift;
	$st = '';
	$max = preg_match_all("/$utf8_match/", $str, $allchars);  // 文字の配列に分解
	for ($i = 0; $i < $max; ++$i) {
		$num = _utf8ucs2($allchars[0][$i]); //ucs2の値を取り出す
		if ($num < 0x80)
			$st .= chr($num);
		elseif ((0xff61 <= $num) && ($num <= 0xff9f)) //半角カナ
			$st .= chr(0x8e) . chr($num - 0xfec0);
		else {
			$sjis = $ucs2tosjis[$num];
			$upper = $sjis >> 8;
			$lower = $sjis & 0xff;
			$shift = $_sjistoeuc_byte1_shift[$lower];
			$st .= chr($_sjistoeuc_byte1[$upper] + $shift)
				   .chr($_sjistoeuc_byte2[$shift][$lower]);
		}
	}
	return $st;
}

function _utf8toutf16(&$str)
{
	global $utf8_match;
	$st = '';
	$max = preg_match_all("/$utf8_match/", $str, $allchars);  // 文字の配列に分解
	for ($i = 0; $i < $max; ++$i) {
		$num = _utf8ucs2($allchars[0][$i]); //ucs2の値を取り出す
		$st .= chr(($num >> 8) & 0xff).chr($num & 0xff);
	}
	return $st;
}

function _utf16toutf8(&$str)
{
	global $utf8_match;
	$st = '';
	$ar = unpack("n*", $str);
	foreach($ar as $char) {
		$st .= _ucs2utf8($char);
	}
	return $st;
}

	
function sub_zenhan_EUC(&$str, $match) {
	global $alphanumeric_convert;

	$match = $match . "|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //全角にマッチングした場合
			$str .= chr(array_search($chars[1][$i], $alphanumeric_convert));
		//	$str .= chr($num & 0x7F);
		else
			$str .= $chars[0][$i];
	}
}

function sub_hanzen_EUC(&$str, $match) {
	global $alphanumeric_convert;

	$match = $match . "|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //半角にマッチングした場合
			$str .= $alphanumeric_convert[$num];
		else
			$str .= $chars[0][$i];
	}
}

function alpha_zenhan_EUC(&$str) {
	sub_zenhan_EUC($str, "(\xA3[\xC1-\xFA])");
}

function alpha_hanzen_EUC(&$str) {
	sub_hanzen_EUC($str, "([\x41-\x5A,\x61-\x7A])");
}


function num_zenhan_EUC(&$str) {
	sub_zenhan_EUC($str, "(\xA3[\xB0-\xB9])");
}

function num_hanzen_EUC(&$str) {
	sub_hanzen_EUC($str, "([\x30-\x39])");
}

function alphanum_zenhan_EUC(&$str) {
	sub_zenhan_EUC($str, "(\xa1[\xa4,\xa5,\xa7-\xaa,\xb0,\xb2,\xbf,\xc3,\xca,\xcb,\xce-\xd1,\xdc,\xdd,\xe1,\xe3,\xe4,\xf0,\xf3-\xf7]|\xA3[\xC1-\xFA]|\xA3[\xB0-\xB9])");
}

function alphanum_hanzen_EUC(&$str) {
	sub_hanzen_EUC($str, "([\\\x21,\\\x23-\\\x26,\\\x28-\\\x5B,\\\x5D-\\\x7D])");
}


function space_zenhan_EUC(&$str) {
	sub_zenhan_EUC($str, "(\xA1\xA1)");
}

function space_hanzen_EUC(&$str) {
	sub_hanzen_EUC($str, "(\x20)");
}

function katakana_zenhan_EUC(&$str) {
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "\xa5([\xa1-\xf4])|\xa1([\xa2,\xa3,\xa6,\xab,\xac,\xbc,\xd6,\xd7])|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //カナにマッチングした場合
			$str .= chr(0x8e) . $kana_zenhan_convert[$num];
		elseif ($num = ord($chars[2][$i])) //半角変換可能な特殊文字にマッチした場合
			$str .= chr(0x8e) . $special_zenhan_convert[$num];
		else
			$str .= $chars[0][$i];
	}
}

function hiragana_zenhan_EUC(&$str) {
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "\xa4([\xa1-\xf4])|\xa1([\xa2,\xa3,\xa6,\xab,\xac,\xbc,\xd6,\xd7])|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //かなにマッチングした場合
			$str .= chr(0x8e) . $kana_zenhan_convert[$num];
		elseif ($num = ord($chars[2][$i])) //半角変換可能な特殊文字にマッチした場合
			$str .= chr(0x8e) . $special_zenhan_convert[$num];
		else
			$str .= $chars[0][$i];
	}
}

function katakana_hanzen1_EUC(&$str) {	//濁点の統合をする方
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "\x8e((?:[\xb3,\xb6-\xc4,\xca-\xce]\x8e\xde)|(?:[\xca-\xce]\x8e\xdf))|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e([\xa1-\xdf])";
		//濁点や半濁点は一緒にマッチング
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($chars[1][$i]) //濁音，半濁音にマッチングした場合
			$str .= chr(0xa5).chr(array_search($chars[1][$i], $kana_zenhan_convert));
		elseif ($chars[2][$i]) //その他の半角カナにマッチ
			if ($num = array_search($chars[2][$i], $kana_zenhan_convert))
				$str .= chr(0xa5).chr($num);
			else
				$str .= chr(0xa1).chr(array_search($chars[2][$i], $special_zenhan_convert));
		else
			$str .= $chars[0][$i];
	}
}

function hiragana_hanzen1_EUC(&$str) {	//濁点の統合をする方
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "\x8e((?:[\xb6-\xc4,\xca-\xce]\x8e\xde)|(?:[\xca-\xce]\x8e\xdf))|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e([\xa1-\xdf])";
		//濁点や半濁点は一緒にマッチング
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($chars[1][$i]) //濁音，半濁音にマッチングした場合
			$str .= chr(0xa4).chr(array_search($chars[1][$i], $kana_zenhan_convert));
		elseif ($chars[2][$i]) //その他の半角カナにマッチ
			if ($num = array_search($chars[2][$i], $kana_zenhan_convert))
				$str .= chr(0xa4).chr($num);
			else
				$str .= chr(0xa1).chr(array_search($chars[2][$i], $special_zenhan_convert));
		else
			$str .= $chars[0][$i];
	}
}

function katakana_hanzen2_EUC(&$str) {	//濁点の統合をしない方
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e([\xa1-\xdf])";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($chars[1][$i]) //半角カナにマッチ
			if ($num = array_search($chars[1][$i], $kana_zenhan_convert))
				$str .= chr(0xa5).chr($num);
			else
				$str .= chr(0xa1).chr(array_search($chars[1][$i], $special_zenhan_convert));
		else
			$str .= $chars[0][$i];
	}
}

function hiragana_hanzen2_EUC(&$str) {	//濁点の統合をしない方
global $kana_zenhan_convert, $special_zenhan_convert;

	$match = "[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e([\xa1-\xdf])";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($chars[1][$i]) //半角カナにマッチ
			if ($num = array_search($chars[1][$i], $kana_zenhan_convert))
				$str .= chr(0xa4).chr($num);
			else
				$str .= chr(0xa1).chr(array_search($chars[1][$i], $special_zenhan_convert));
		else
			$str .= $chars[0][$i];
	}
}

function katakana_hiragana_EUC(&$str) {

	$match = "\xa5([\xa1-\xf3])|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //カナにマッチングした場合
			$str .= chr(0xa4) . chr($num);
		else
			$str .= $chars[0][$i];
	}
}

function hiragana_katakana_EUC(&$str) {

	$match = "\xa4([\xa1-\xf4])|[\xa1-\xfe][\xa1-\xfe]|[\x01-\x7f]|\x8e[\xa0-\xdf]";
	$max = preg_match_all("/$match/", $str, $chars);
	$str = '';
	for ($i = 0; $i < $max; ++$i) {
		if ($num = ord($chars[1][$i])) //カナにマッチングした場合
			$str .= chr(0xa5) . chr($num);
		else
			$str .= $chars[0][$i];
	}
}

function mb_convert_kana( $str, $option='KV', $encoding = '')
{
	$encoding = mb_detect_encoding($str, $encoding);
	$str = mb_convert_encoding($str, 'EUC-JP', $encoding);

	if (strstr($option, "r")) alpha_zenhan_EUC($str);
	if (strstr($option, "R")) alpha_hanzen_EUC($str);
	if (strstr($option, "n")) num_zenhan_EUC($str);
	if (strstr($option, "N")) num_hanzen_EUC($str);
	if (strstr($option, "a")) alphanum_zenhan_EUC($str);
	if (strstr($option, "A")) alphanum_hanzen_EUC($str);
	if (strstr($option, "s")) space_zenhan_EUC($str);
	if (strstr($option, "S")) space_hanzen_EUC($str);
	if (strstr($option, "k")) katakana_zenhan_EUC($str);
	if (strstr($option, "K")) {
		if (strstr($option, "V"))
			katakana_hanzen1_EUC($str);
		else
			katakana_hanzen2_EUC($str);
	}
	if (strstr($option, "H")) {
		if (strstr($option, "V"))
			hiragana_hanzen1_EUC($str);
		else
			hiragana_hanzen2_EUC($str);
	}
	if (strstr($option, "h")) hiragana_zenhan_EUC($str);
	if (strstr($option, "c")) katakana_hiragana_EUC($str);
	if (strstr($option, "C")) hiragana_katakana_EUC($str);

	$str = mb_convert_encoding($str, $encoding, 'EUC-JP');
	return $str;
}

function mb_send_mail($to, $subject, $message , $additional_headers, $additional_parameter)
{
	if (!_is_JIS($subject)) 
		$subject =mb_encode_mimeheader($subject);
	else {
		$tmp = mb_internal_encoding();
		mb_internal_encoding('iso-2022-jp');
		$subject =mb_encode_mimeheader($subject);
		mb_internal_encoding($tmp);
	}
	if (!_is_JIS($message))
		$message = mb_convert_encoding($message, "iso-2022-jp", mb_internal_encoding());
	$additional_headers .= 
	"\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=ISO-2022-JP\r\nContent-Transfer-Encoding: 7bit";
	mail($to, $subject, $message, $additional_headers, $additional_parameter); 
	
}


function mb_detect_order($encoding_list = '')
{
	global $_detect_order, $_mb_encoding;
	
	if ($encoding_list) {
		if (is_string($encoding_list)) {
			$encoding_list = strtoupper($encoding_list);
			$encoding_list = split(', *', $encoding_list);
		}
		foreach($encoding_list as $encode)
			if (!array_key_exists($encode, $_mb_encoding)) return FALSE;
		$_detect_order = $encoding_list;
		return TRUE;
	}
	return $_detect_order;
}

function _is_Ascii(&$str)
{
	return (!ereg("[\x80-\xFF]", $str) && !ereg("\x1B", $str));
}

function _is_JIS(&$str)
{
	return (!ereg("[\x80-\xFF]", $str) && ereg("\x1B", $str));
}

function _is_SJIS(&$str)
{
	$sjis_match = 
	"[\x01-\x7F]|[\xA0-\xDF]|[\x81-\xFC][\x40-\xFC]";
	return (preg_match("/^($sjis_match)+$/", $str) == 1);
}

function _is_EUCJP(&$str)
{
	$euc_match = 
	"[\x01-\x7F]|\x8E[\xA0-\xDF]|\x8F[xA1-\xFE][\xA1-\xFE]|[\xA1-\xFE][\xA1-\xFE]";
	return (preg_match("/^($euc_match)+$/", $str) == 1);
}

function _is_UTF8(&$str)
{
	$utf8_match = 
	"[\x01-\x7F]|[\xC0-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF][\x80-\xBF]";
	return (preg_match("/^($utf8_match)+$/", $str) == 1);
}

function mb_detect_encoding( $str , $encoding_list = '')
{
	global $_mb_encoding;

	if ($encoding_list == '') 
			$encoding_list = mb_detect_order();
	if (!is_array($encoding_list)) {
		$encoding_list = strtoupper($encoding_list);
		if ($encoding_list == 'AUTO') {
			$encoding_list = mb_detect_order();
		} else {
			$encoding_list = split(', *', $encoding_list);
		}
	}
	foreach($encoding_list as $encode) {
		switch ($_mb_encoding[$encode]) {
			case 0 : //ascii
				if (_is_ASCII($str)) return 'ASCII';
				break;
			case 1 : //euc-jp
				if (_is_EUCJP($str)) return 'EUC-JP';
				break;
			case 2 : //shift-jis
				if (_is_SJIS($str)) return 'SJIS';
				break;
			case 3 : //jis
				if (_is_JIS($str)) return 'JIS';
				break;
			case 4 : //utf-8
				if (_is_UTF8($str)) return 'UTF-8';
				break;
		}
	}
	return $encode;
}

function mb_strlen ( $str , $encoding='')
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;

	$encoding = _get_encoding($str, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			return preg_match_all("/$euc_match/", $str, $arr);
		case 0 : //ascii
		case 4 : //utf-8
			return preg_match_all("/$utf8_match/", $str, $arr);
		case 2 : //shift-jis
			return preg_match_all("/$sjis_match/", $str, $arr);
		case 3 : //jis
			$str = mb_convert_encoding($str, 'SJIS', 'JIS');
			return preg_match_all("/$sjis_match/", $str, $arr);
	}
}

function mb_strwidth( $str, $encoding='')
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;

	$encoding = _get_encoding($str, $encoding);
	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			$max = $len = preg_match_all("/$euc_match/", $str, $arr);
			$len;
			for ($i=0; $i < $max; ++$i)
				if ($arr[1][$i]) ++$len;
			return $len;
		case 0 : //ascii
		case 4 : //utf-8
			$max = $len = preg_match_all("/$utf8_match/", $str, $arr);
			for ($i=0; $i < $max; ++$i) {
				$ucs2 = _utf8ucs2($arr[0][$i]);
				if (((0x2000 <= $ucs2) && ($ucs2 <= 0xff60)) || (0xffa0 <= $ucs2))
					++$len;
			}
			return $len;
		case 2 : //shift-jis
			$max = $len = preg_match_all("/$sjis_match/", $str, $arr);
			for ($i=0; $i < $max; ++$i)
				if ($arr[1][$i]) ++$len;
			return $len;
		case 3 : //jis
			$str = mb_convert_encoding($str, 'SJIS', 'JIS');
			$max = $len = preg_match_all("/$sjis_match/", $str, $arr);
			for ($i=0; $i < $max; ++$i)
				if ($arr[1][$i]) ++$len;
			return $len;
	}
}

function mb_strimwidth( $str, $start, $width, $trimmarker , $encoding = '')
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;

	$encoding = _get_encoding($str, $encoding);
	$str = mb_substr($str, $start, 'notnumber', $encoding);
	if (($len = mb_strwidth($str,$encoding)) <= $width)
		return $str;
	$trimwidth = mb_strwidth($trimmarker,$encoding);
	$width -= $trimwidth;
	if ($width <= 0) return $trimmarker;
	
	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $str, $arr);
			$i = 0;
			while(TRUE) {
				if ($arr[1][$i])
					$width -= 2;
				else
					--$width;
				if ($width<0) break;
				++$i;
			}
			$arr[0] = array_slice($arr[0], 0, $i);
			return implode("", $arr[0]).$trimmarker;
		case 0 : //ascii
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $str, $arr);
			$i = 0;
			while(TRUE) {
				$ucs2 = _utf8ucs2($arr[0][$i]);
				if (((0x2000 <= $ucs2) && ($ucs2 <= 0xff60)) || (0xffa0 <= $ucs2))
					$width -= 2;
				else
					--$width;
				if ($width<0) break;
				++$i;
			}
			$arr[0] = array_slice($arr[0], 0, $i);
			return implode("", $arr[0]).$trimmarker;
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $str, $arr);
			$i = 0;
			while(TRUE) {
				if ($arr[1][$i])
					$width -= 2;
				else
					--$width;
				if ($width<0) break;
				++$i;
			}
			$arr[0] = array_slice($arr[0], 0, $i);
			return implode("", $arr[0]).$trimmarker;
		case 3 : //jis
			$str = mb_convert_encoding($str, 'SJIS', 'JIS');
			$trimmarker = mb_convert_encoding($trimmarker, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $str, $arr);
			$i = 0;
			while(TRUE) {
				if ($arr[1][$i])
					$width -= 2;
				else
					--$width;
				if ($width<0) break;
				++$i;
			}
			$arr[0] = array_slice($arr[0], 0, $i);
			return mb_convert_encoding(implode("", $arr[0]).$trimmarker,'JIS','SJIS');
	}
}


function mb_substr ( $str, $start , $length='notnumber' , $encoding='')
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;

	$encoding = _get_encoding($str, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $str, $arr);
			break;
		case 0 : //ascii
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $str, $arr);
			break;
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $str, $arr);
			break;
		case 3 : //jis
			$str = mb_convert_encoding($str, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $str, $arr);
	}
	if (is_int($length))
		$arr[0] = array_slice($arr[0], $start, $length);
	else
		$arr[0] = array_slice($arr[0], $start);
	$str = implode("", $arr[0]);
	if ($_mb_encoding[$encoding] == 3)
		$str = mb_convert_encoding($str, 'JIS', 'SJIS');
	return $str;
}

function _sub_strcut($arr, $start, $length) {
	$max = count($arr[0]);
	$s = ''; $counter = 0;
	for ($i = 0; $i < $max; ++$i) {
		$counter += strlen($arr[0][$i]);
		if ($counter > $start) {
			if ($length == 0) {
				for ($j = $i; $j < $max; ++$j)
					$s .= $arr[0][$j];
				return $s;
			}
			for ($j = $i, $len = 0; $j < $max; ++$j) {
				$len += strlen($arr[0][$j]);
				if ($len <= $length)
					$s .= $arr[0][$j];
			}
			return $s;
		}
	}
	return $s;
}


function mb_strcut ( $str, $start , $length=0 , $encoding = '')
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;
	
	
	$encoding = _get_encoding($str, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $str, $arr);
			return _sub_strcut($arr, $start, $length);
		case 0 : //ascii
			return substr($str, $start, $length);
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $str, $arr);
			return _sub_strcut($arr, $start, $length);
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $str, $arr);
			return _sub_strcut($arr, $start, $length);
		case 3 : //jis
			$str = mb_convert_encoding($str, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $str, $arr);
			$sub = _sub_strcut($arr, $start, $length);
			return mb_convert_encoding($sub, 'JIS', 'SJIS');
	}
}

function _sub_strrpos($ar_haystack, $ar_needle)
{
	$max_h = count($ar_haystack) - 1;
	$max_n = count($ar_needle) - 1;
	for ($i = $max_h; $i >= $max_n; --$i) {
		if ($ar_haystack[$i] == $ar_needle[$max_n]) {
			$match = TRUE;
			for ($j = 1; $j <= $max_n; ++$j)
				if ($ar_haystack[$i-$j] != $ar_needle[$max_n-$j]) {
					$match = FALSE;
					break;
				}
			if ($match) return $i - $max_n;
		}
	}
	return FALSE;
}

function mb_strrpos ( $haystack, $needle , $encoding = '')
{
	
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;
	
	$encoding = _get_encoding($haystack, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $haystack, $ar_h);
			preg_match_all("/$euc_match/", $needle, $ar_n);
			return _sub_strrpos($ar_h[0], $ar_n[0]);
		case 0 : //ascii
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $haystack, $ar_h);
			preg_match_all("/$utf8_match/", $needle, $ar_n);
			return _sub_strrpos($ar_h[0], $ar_n[0]);
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_strrpos($ar_h[0], $ar_n[0]);
		case 3 : //jis
			$haystack = mb_convert_encoding($haystack, 'SJIS', 'JIS');
			$needle = mb_convert_encoding($needle, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_strrpos($ar_h[0], $ar_n[0]);
	}
}

function _sub_strpos($ar_haystack, $ar_needle, $offset)
{
	$max_n = count($ar_needle) - 1;
	$max_h = count($ar_haystack) - count($ar_needle);
	for ($i = $offset; $i <= $max_h; ++$i) {
		for ($j = 0; $j <= $max_n; ++$j) {
			$match = TRUE;
			if ($ar_haystack[$i+$j] != $ar_needle[$j]) {
				$match = FALSE;
				break;
			}
		}
		if ($match) return $i;
	}
	return FALSE;
}

function mb_strpos ( $haystack, $needle , $offset = 0, $encoding = '')
{
	
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;
	
	$encoding = _get_encoding($haystack, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $haystack, $ar_h);
			preg_match_all("/$euc_match/", $needle, $ar_n);
			return _sub_strpos($ar_h[0], $ar_n[0], $offset);
		case 0 : //ascii
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $haystack, $ar_h);
			preg_match_all("/$utf8_match/", $needle, $ar_n);
			return _sub_strpos($ar_h[0], $ar_n[0], $offset);
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_strpos($ar_h[0], $ar_n[0], $offset);
		case 3 : //jis
			$haystack = mb_convert_encoding($haystack, 'SJIS', 'JIS');
			$needle = mb_convert_encoding($needle, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_strpos($ar_h[0], $ar_n[0], $offset);
	}
}

function _sub_substr_count($ar_haystack, $ar_needle)
{
	$matches = 0;
	$max_n = count($ar_needle) - 1;
	$max_h = count($ar_haystack) - count($ar_needle);
	for ($i = 0; $i <= $max_h; ++$i) {
		for ($j = 0; $j <= $max_n; ++$j) {
			$match = TRUE;
			if ($ar_haystack[$i+$j] != $ar_needle[$j]) {
				$match = FALSE;
				break;
			}
		}
		if ($match) ++$matches;
	}
	return $matches;
}

function mb_substr_count($haystack, $needle , $encoding = '')
{
	
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match;
	
	$encoding = _get_encoding($haystack, $encoding);

	switch ($_mb_encoding[$encoding]) {
		case 1 : //euc-jp
			preg_match_all("/$euc_match/", $haystack, $ar_h);
			preg_match_all("/$euc_match/", $needle, $ar_n);
			return _sub_substr_count($ar_h[0], $ar_n[0]);
		case 0 : //ascii
		case 4 : //utf-8
			preg_match_all("/$utf8_match/", $haystack, $ar_h);
			preg_match_all("/$utf8_match/", $needle, $ar_n);
			return _sub_substr_count($ar_h[0], $ar_n[0]);
		case 2 : //shift-jis
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_substr_count($ar_h[0], $ar_n[0]);
		case 3 : //jis
			$haystack = mb_convert_encoding($haystack, 'SJIS', 'JIS');
			$needle = mb_convert_encoding($needle, 'SJIS', 'JIS');
			preg_match_all("/$sjis_match/", $haystack, $ar_h);
			preg_match_all("/$sjis_match/", $needle, $ar_n);
			return _sub_substr_count($ar_h[0], $ar_n[0]);
	}
}


/******************
mb_convert_variables
*******************/
if (!$ini_file['convert_variables_arrayonly']) {
	function mb_convert_variables($to_encoding, $from_encoding, $s1, $s2='',$s3='',$s4='',$s5='',$s6='',$s7='', $s8='',$s9='', $s10='')
	{
		if (is_array($s1)) {
			$st = '';
			foreach($s1 as $s) $st .= $s;
			if (!($encode = mb_detect_encoding($st, $from_encoding)))
				return FALSE;
			reset($s1);
			while (list ($key, $val) = each ($s1)) {
				$s1[$key] = mb_convert_encoding($val, $to_encoding, $encode);
			}
			return $encode;
		}
	    $st = $s1.$s2.$s3.$s4.$s5.$s6.$s7.$s8.$s9.$s10;
	    if (!($encode = mb_detect_encoding($st, $from_encoding)))
	        return FALSE;
	    $s1 = mb_convert_encoding($s1, $to_encoding, $encode);
	    $s2 = mb_convert_encoding($s2, $to_encoding, $encode);
	    $s3 = mb_convert_encoding($s3, $to_encoding, $encode);
	    $s4 = mb_convert_encoding($s4, $to_encoding, $encode);
	    $s5 = mb_convert_encoding($s5, $to_encoding, $encode);
	    $s6 = mb_convert_encoding($s6, $to_encoding, $encode);
	    $s7 = mb_convert_encoding($s7, $to_encoding, $encode);
	    $s8 = mb_convert_encoding($s8, $to_encoding, $encode);
	    $s9 = mb_convert_encoding($s9, $to_encoding, $encode);
	    $s10 = mb_convert_encoding($s10, $to_encoding, $encode);
	    return $encode;
	}
} else {
	function mb_convert_variables($to_encoding, $from_encoding, &$arr)
	{
		$st = '';
		foreach($arr as $s) $st .= $s;
		if (!($encode = mb_detect_encoding($st, $from_encoding)))
			return FALSE;
		reset($arr);
		while (list ($key, $val) = each ($arr)) {
			$arr[$key] = mb_convert_encoding($val, $to_encoding, $encode);
		}
		return $encode;
	}
}

function mb_preferred_mime_name ($encoding)
{
	global $_mb_encoding;
	
	$encoding = strtoupper($encoding);
	
	switch ($_mb_encoding[$encoding]) {
		case 0 : //ascii
			return 'US-ASCII';
		case 1 : //euc-jp
			return 'EUC-JP';
		case 2 : //shift-jis
			return 'Shift_JIS';
		case 3 : //jis
			return 'ISO-2022-JP';
		case 4 : //utf-8
			return 'UTF-8';
	}
}

function mb_decode_mimeheader($str)
{
	$lines = preg_split("/(\r\n|\r|\n)( *)/", $str);
	$s = '';
	foreach ($lines as $line) {
		if ($line != "") {
			$line = preg_replace("/<[\w\-+\.]+\@[\w\-+\.]+>/","", $line); //メール・アドレス部を消す
			$matches = preg_split("/=\?([^?]+)\?(B|Q)\?([^?]+)\?=/", $line, -1, PREG_SPLIT_DELIM_CAPTURE);
			for ($i = 0; $i < count($matches)-1; $i+=4) {
				if (!preg_match("/^[ \t\r\n]*$/", $matches[$i]))
					$s .= $matches[$i];
				if ($matches[$i+2] == 'B')
					$s .= mb_convert_encoding(base64_decode($matches[$i+3]), 
											mb_internal_encoding(), $matches[$i+1]);
				else
					$s .= mb_convert_encoding(quoted_printable_decode($matches[$i+3]), 
											mb_internal_encoding(), $matches[$i+1]);
			}
			if (!preg_match("/^[ \t\r\n]*$/", $matches[$i]))
					$s .= $matches[$i];
		}
	}
	return $s;
}

function _sub_qponechar($str, &$len)
{
	$all = unpack("C*", $str);
	$s = ''; $len = 0;
	foreach($all as $char) {
		if (((ord('A') <= $char) && ($char <= ord('Z'))) ||
			((ord('a') <= $char) && ($char <= ord('z')))) {
			$s .= chr($char);
			++$len;
		} else {
			$s .= '='.sprintf("%2X",$char);
			$len += 3;
		}
	}
	return $s;
}

function _sub_quoted_printable_encode($str, $encoding, $maxline, $linefeed)
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match, $jis_match;
	switch ($_mb_encoding[$encoding]) {
		case 0 : //ascii
			$allchars[0] = unpack("c*", $str);
			$max = count($allchars[0]);
			break;
		case 1 : //euc-jp
			$max = preg_match_all("/$euc_match/", $str, $allchars);
			break;
		case 2 : //shift-jis
			$max = preg_match_all("/$sjis_match/", $str, $allchars);
			break;
		case 4 : //utf-8
			$max = preg_match_all("/$utf8_match/", $str, $allchars);
			break;
		case 3 : //jis
			$max = preg_match_all("/$jis_match/", $str, $allchunks, PREG_SET_ORDER);  // 文字種ごとの配列に分解
			$st = ''; // quoted printable変換後の文字列
			$len = $maxline;  // その行に追加可能なバイト数
			$needterminate = FALSE; //最後にエスケープシーケンスが必要かどうか
			for ($i = 0; $i < $max; ++$i) {
				if (ord($allchunks[$i][1])) { //英数にマッチ
					if ($needterminate) {
						$st .= '=1B=28B';
						$len -= 7;
					}
					$tmparr = unpack("C*", $allchunks[$i][1]);
					foreach ($tmparr as $char) {
						$tmp = _sub_qponechar(chr($char), $l);
						if ($len < $l) {
							$st .= $linefeed;
							$len = $maxline;
						}
						$st .= $tmp;
						$len -= $l;
					} 
					$needterminate = FALSE;
				} elseif (ord($allchunks[$i][2])) { //漢字にマッチ
					$maxchars = preg_match_all("/../",substr($allchunks[$i][0], 3),$allchars);
					$tmp = _sub_qponechar($allchars[0][0], $l);
					if ($len < 14 + $l) {
						if ($needterminate)
							$st .= '=1B=28B';
						$st .= $linefeed;
						$len = $maxline;
					}
					$st .= '=1B=24B';
					$len -= 7;
					for ($j = 0; $j < $maxchars; ++$j) {
						$tmp = _sub_qponechar($allchars[0][$j], $l);
						if ($len < $l + 7) {
							$st .= '=1B=28B'.$linefeed.'=1B=24B';
							$len = $maxline-7;
						}
						$st .= $tmp;
						$len -= $l;
					}
					$needterminate = TRUE;
					
				} elseif (ord($allchunks[$i][3])) { //半角カナにマッチ
					$max = preg_match_all("/./",$allchunks[$i][3],$allchars);
					$tmp = _sub_qponechar($allchars[0][0], $l);
					if ($len < 14 + $l) {
						if ($needterminate)
							$st .= '=1B=28B';
						$st .= $linefeed;
						$len = $maxline;
					}
					$st .= '=1B=28I';
					$len -= 7;
					for ($j == 0; $j < $max; ++$j) {
						$tmp = _sub_qponechar($allchars[0][$j], $l);
						if ($len < $l + 7) {
							$st .= '=1B=28B'.$linefeed.'=1B=28I';
							$len = $maxline-7;
						}
						$st .= $tmp;
						$len -= $l;
					}
					$needterminate = TRUE;
				}
			}
			if ($needterminate) $st .= '=1B=28B';
			$st .= $linefeed;
			return $st;
	}
	$st = ''; // quoted printable変換後の文字列
	$len = $maxline;  // その行に追加可能なバイト数
	for ($i = 0; $i < $max; ++$i) {
		$tmp = _sub_qponechar($allchars[0][$i], $l);
		if ($l > $len) {
			$st .= $linefeed;
			$len = $maxline;
		}
		$st .= $tmp;
		$len -= $l;
	}
	$st .= $linefeed;
	return $st;
}

function _sub_encode_base64($str, $encoding, $maxline , $linefeed)
{
	global $_mb_encoding, $euc_match, $utf8_match, $sjis_match, $jis_match;
	switch ($_mb_encoding[$encoding]) {
		case 0 : //ascii
			return chunk_split( base64_encode($str) , $maxline, $linefeed);
		case 1 : //euc-jp
			$max = preg_match_all("/$euc_match/", $str, $allchars);
			break;
		case 2 : //shift-jis
			$max = preg_match_all("/$sjis_match/", $str, $allchars);
			break;
		case 4 : //utf-8
			$max = preg_match_all("/$utf8_match/", $str, $allchars);
			break;
		case 3 : //jis
			$max = preg_match_all("/$jis_match/", $str, $allchunks, PREG_SET_ORDER);  // 文字種ごとの配列に分解
			$st = ''; // BASE64変換後の文字列
			$maxbytes = floor($maxline * 3 / 4);  //1行に変換可能なバイト数
			$len = $maxbytes;  // その行に追加可能なバイト数
			$line = '';  //1行分の変換前の文字列
			$needterminate = FALSE; //最後にエスケープシーケンスが必要かどうか
			for ($i = 0; $i < $max; ++$i) {
				if (ord($allchunks[$i][1])) { //英数にマッチ
					if ($needterminate) {
						$line .= chr(0x1B).'(B';
						$len -= 3;
					}
					$tmpstr = $allchunks[$i][1];  //追加する文字列
					$l = strlen($tmpstr);  //追加する文字列の長さ
					while ($l > $len) {
						$line .= substr($tmpstr, 0, $len);
						$st .= base64_encode($line).$linefeed;
						$l -= $len;
						$tmpstr = substr($tmpstr, $len);
						$len = $maxbytes;
						$line = '';
					} 
					$line .= $tmpstr;
					$len -= $l;
					$needterminate = FALSE;
				} elseif (ord($allchunks[$i][2])) { //漢字にマッチ
					$tmpstr = substr($allchunks[$i][0], 3);
					if ($len < 8) { //文字を追加するのに最低8バイト必要なので
						if ($needterminate)
							$line .= chr(0x1B).'(B';
						$st .= base64_encode($line).$linefeed;
						$len = $maxbytes;
						$line = '';
					}
					$l = strlen($tmpstr);
					$line .= chr(0x1B).'$B';
					$len -= 3; 
					while ($l > $len-3) {
						$add = floor(($len-3) / 2) * 2;
						if ($add == 0) break;
						$line .= substr($tmpstr, 0, $add).chr(0x1B).'(B';
						$st .= base64_encode($line).$linefeed;
						$l -= $add;
						$tmpstr = substr($tmpstr, $add);
						$len = $maxbytes-3;
						$line = chr(0x1B).'$B';
					} 
					$line .= $tmpstr;
					$len -= $l;
					$needterminate = TRUE;
					
				} elseif (ord($allchunks[$i][3])) { //半角カナにマッチ
					$tmpstr = $allchunks[$i][3];
					if ($len < 7) { //文字を追加するのに最低7バイト必要なので
						if ($needterminate)
							$line .= chr(0x1B).'(B';
						$st .= base64_encode($line).$linefeed;
						$len = $maxbytes;
						$line = '';
					}
					$l = strlen($tmpstr);
					$line .= chr(0x1B).'(I';
					$len -= 3; 
					while ($l > $len-3) {
						$line .= substr($tmpstr, 0, $len-3).chr(0x1B).'(B';
						$st .= base64_encode($line).$linefeed;
						$l -= $len;
						$tmpstr = substr($tmpstr, $len-3);
						$len = $maxbytes-3;
						$line = chr(0x1B).'(I';
					} 
					$line .= $tmpstr;
					$len -= $l;
					$needterminate = TRUE;
				}
			}
			if ($needterminate) $line .= chr(0x1B).'(B';
			$st .= base64_encode($line).$linefeed;
			return $st;
	}
	$st = ''; // BASE64変換後の文字列
	$maxbytes = floor($maxline * 3 / 4);  //1行に変換可能なバイト数
	$len = $maxbytes;  // その行に追加可能なバイト数
	$line = '';  //1行分の変換前の文字列
	for ($i = 0; $i < $max; ++$i) {
		$l = strlen($allchars[0][$i]);
		if ($l > $len) {
			$st .= base64_encode($line).$linefeed;
			$len = $maxbytes;
			$line = '';
		}
		$line .= $allchars[0][$i];
		$len -= $l;
	}
	$st .= base64_encode($line).$linefeed;
	return $st;
}

function mb_encode_mimeheader( $str, $encoding = "ISO-2022-JP", $transfer_encoding = "B", $linefeed = "\r\n")
{
	global $_mb_encoding;
	if ($transfer_encoding == "b") $transfer_encoding = "B";
	if ($transfer_encoding <> "B") $transfer_encoding = "Q";
	$encoding = strtoupper($encoding);
	
	$head = '=?' . mb_preferred_mime_name ($encoding) . '?'.$transfer_encoding.'?';
	$str = mb_convert_encoding($str, $encoding, mb_internal_encoding());
	$length = 76 - strlen($head) - 4;
	if ($transfer_encoding == "B") {
        $str = _sub_encode_base64( $str , $encoding, $length, $linefeed);
	} else {
		$str = _sub_quoted_printable_encode($str, $encoding, $length, $linefeed);
	}
	$ar = explode($linefeed, $str);
	$s = '';
	foreach ($ar as $element) {
		if ($element <> '')
			$s .= $head . $element . '?=' .$linefeed;
	}
	return $s;
}

function mb_http_input($type = '')
{
	return FALSE;
}

function mb_http_output($encoding = '')
{
	global $ini_file;
	
	if ($encoding == '') return $ini_file['http_output'];
	if (strtolower($encoding) == 'pass') {
		$ini_file['http_output'] = 'pass';
		return TRUE;
	}
	$ini_file['http_output'] = mb_preferred_mime_name($encoding);
	return TRUE;
}


function mb_output_handler ( $buffer, $status='')
{
	global $ini_file, $tmpstr;
	if ($ini_file['http_output'] == 'pass')
		return $buffer;
	return mb_convert_encoding($buffer, $ini_file['http_output'], mb_internal_encoding());
}


function mb_encode_numericentity($str, $convmap, $encoding="")
{
	if (!$encoding) $encoding = mb_internal_encoding();
	$str = mb_convert_encoding($str, "utf-16", $encoding);
	$ar = unpack("n*", $str);
	$s = "";
	foreach($ar as $char) {
		$max = count($convmap);
		for ($i = 0; $i < $max; $i += 4) {
			if (($convmap[$i] <= $char) && ($char <= $convmap[$i+1])) {
				$char += $convmap[$i+2];
				$char &= $convmap[$i+3];
				$s .= sprintf("&#%u;", $char);
				break;
			}
		}
		if ($i >= $max) $s .= pack("n*", $char);
	}
	return $s;
}

function mb_decode_numericentity ($str, $convmap, $encoding="")
{
	if (!$encoding) $encoding = mb_internal_encoding();
	$ar = preg_split('/(&#[0-9]+;)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE);
	$s = '';
	$max = count($convmap);
	foreach($ar as $chunk) {
		if (preg_match('/&#([0-9]+);/', $chunk, $match)) {
			for ($i = 0; $i < $max; $i += 4) {
				$num = $match[1] - $convmap[$i+2];
				if (($convmap[$i] <= $num) && ($num <= $convmap[$i+1])) {
					$ucs2 = pack('n*', $num);
					$s .= mb_convert_encoding($ucs2, $encoding, 'UTF-16');
					break;
				}
			}
			if ($i >= $max) $s .= $chunk;
		} else {
			$s .= $chunk;
		}
	}
	return $s;
}


function _print_str($str) {
	$all = unpack("C*", $str);
	$s = '';
	foreach($all as $char) {
		$s .= sprintf(" %2X",$char);
	}
	print $s."\n";
}

?>