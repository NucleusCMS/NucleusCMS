<?php
/**
 * Text plugin for Nucleus CMS
 * Version 0.53JP for PHP5
 * Written By Cacher, Jan.16, 2011
 * Original was written by Armon Toubman, Jan.18, 2007
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 */
 
class NP_Text extends NucleusPlugin {
	
	private $incModePref = array();
	private $constantPrefix = "SL_";
	
	public function getEventList() { return array('PreSkinParse'); }
	public function getName() { return 'Text'; }
	public function getAuthor() { return 'Armon Toubman, Cacher'; }
    public function getURL() { return 'https://github.com/NucleusCMS/NP_Text'; } // 'http://nucleuscms.org/forum/viewtopic.php?t=14904';
	public function getVersion() { return '0.53JP-8bceb304-patch1'; }
	public function getDescription() {
		$desc = '言語ファイル中の定数を表示します。: <%Text(定数名)%>';
		switch (preg_replace( '#\\\\|/#', '', getLanguageName())) {
			case 'japanese-utf8':
				break;
			case 'japanese-euc':
				$desc = mb_convert_encoding($desc,'EUC-JP','UTF-8');
				break;
			default:
				$desc ='Display constants from language files: <%Text(CONSTANT)%>';
				break;
		}
		return $desc;
	}
	public function supportsFeature($feature) {
		return in_array ($feature, array ('SqlTablePrefix', 'SqlApi'));
	}
	public function install() {}
	public function uninstall() {}

	public function init() {
		$this->incModePref = $this->skin_incmodepref();
	}
	
	public function event_PreSkinParse() {
		global $member;
		if( !$member->isLoggedIn() and isset($_GET['lang']) ) {
			// 3 months
			setcookie('NP_Text', getVar('lang'), time()+60*60*24*90);
		}
	}
	 
	public function doSkinVar($skinType, $constant='') {
		global $member, $CONF;

		if ($constant==='') return ;
		$language = getLanguageName();
		$getLanguage = isset($_GET['lang']) ? getVar('lang') : false;
		$cookieLanguage = isset($_COOKIE['NP_Text']) ? cookieVar('NP_Text') : false;
		
//		if( !$member->isLoggedIn() ) {
			if( $getLanguage ) {
				$this->use_lang($getLanguage, $constant);
			}
			elseif( $cookieLanguage ) {
				$this->use_lang($cookieLanguage, $constant);
			}
			else {
				$this->use_lang($language, $constant);
			}
//		}
//		else {
//			$this->use_lang($language, $constant);
//		}
		
	}
	
	public function doTemplateVar(&$item, $constant='') {
		global $member, $CONF;

		if ($constant==='') return ;
		$language = getLanguageName();
		$getLanguage = isset($_GET['lang']) ? getVar('lang') : false;
		$cookieLanguage = isset($_COOKIE['NP_Text']) ? cookieVar('NP_Text') : false;
		
//		if( !$member->isLoggedIn() ) {
			if( $getLanguage ) {
				$this->use_lang($getLanguage, $constant);
			}
			elseif( $cookieLanguage ) {
				$this->use_lang($cookieLanguage, $constant);
			}
			else {
				$this->use_lang($language, $constant);
			}
//		}
//		else {
//			$this->use_lang($language, $constant);
//		}
	}
	
	public function use_lang($language, $constant) {
		global $DIR_SKINS;
		
		$filename = '';
		
		if( $this->incModePref[0] == "normal" ) {
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		} elseif ( $this->incModePref[0] == "skindir" ) {
			$filename = $filename.$DIR_SKINS;
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		}
		
		if( is_file($filename) ) {
			include($filename);
		} else {
			addToLog(1, "NP_Text cannot find ".$filename);
		}
		
		if( defined($this->constantPrefix.$constant) ) {
			echo constant($this->constantPrefix.$constant);
		} else {
			echo $this->constantPrefix.$constant;
			if( is_file($filename) ) {
				addToLog(1, "NP_Text cannot find definition for ".$this->constantPrefix.$constant." in ".$filename);
			}
		}			
	}
	
	public function skin_incmodepref() {
		global $currentSkinName;
		$sql = "SELECT * FROM ".sql_table("skin_desc")." WHERE sdname = '".$currentSkinName."'";
		$result = sql_query($sql);
		$row = sql_fetch_array($result, MYSQL_ASSOC);
		return array($row['sdincmode'], $row['sdincpref']);
	}
}
