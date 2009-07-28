<?php
 
class NP_Text extends NucleusPlugin {
	
	var $incModePref = array();
	var $errorLogged = false;
	var $constantPrefix = "SL_";
 
	function getEventList() { return array('PreSkinParse'); }
	function getName() { return 'Text'; }
	function getAuthor() { return 'Armon Toubman'; }
	function getURL() { return 'http://forum.nucleuscms.org/viewtopic.php?t=14904'; }
	function getVersion() { return '0.53'; }
	function getDescription() {
		return 'Display constants from language files: <%Text(CONSTANT)%>';
	}
	function supportsFeature($feature) {
        switch($feature) {
            case 'SqlTablePrefix': return 1;
            default: return 0;
        }
	} 
	function install() {}
	function uninstall() {}
	function init() {
		$this->incModePref = $this->skin_incmodepref();
	}
	
	function event_PreSkinParse() {
		global $member;
		if( !$member->isLoggedIn() and isset($_GET['lang']) ) {
			setcookie('NP_Text', getVar('lang'), time()+60*60*24*90); // 3 months
		}
	}
	 
	function doSkinVar($skinType, $constant) {
		global $member, $CONF;
		
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
	
	function doTemplateVar(&$item, $constant) {
		global $member, $CONF;
		
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
	
	function use_lang($language, $constant) {
		global $DIR_SKINS;
		
		$filename = '';
		
		if( $this->incModePref[0] == "normal" ) {
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		}
		elseif( $this->incModePref[0] == "skindir" ) {
			$filename = $filename.$DIR_SKINS;
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		}
		
		if( is_file($filename) ) {
			include($filename);
		}
		else {
			addToLog(1, "NP_Text cannot find ".$filename);
		}
		
		if( defined($this->constantPrefix.$constant) ) {
			echo constant($this->constantPrefix.$constant);
		}
		else {
			echo $this->constantPrefix.$constant;
			if( is_file($filename) ) {
				addToLog(1, "NP_Text cannot find definition for ".$this->constantPrefix.$constant." in ".$filename);
			}
		}			
		
	}
	
	function skin_incmodepref() {
		global $currentSkinName;
		$sql = "SELECT * FROM ".sql_table("skin_desc")." WHERE sdname = '".$currentSkinName."'";
		$result = sql_query($sql);
		$row = sql_fetch_array($result, MYSQL_ASSOC);
		return array($row['sdincmode'], $row['sdincpref']);
	}
	
}
 
?>