<?php
 
class NP_Text extends NucleusPlugin
{
	public $incModePref = array();
	public $errorLogged = false;
	public $constantPrefix = "SL_";
	
	public function getName()			{ return 'Text'; }
	public function getAuthor()			{ return 'Armon Toubman'; }
	public function getURL()			{ return 'http://forum.nucleuscms.org/viewtopic.php?t=14904'; }
	public function getVersion()		{ return '0.53'; }
	public function getDescription()	{ return 'Display constants from language files: <%Text(CONSTANT)%>'; }
	public function getEventList()		{ return array('PreSkinParse'); }
	public function supportsFeature($feature)	{ return ( $feature == 'SqlTablePrefix' ); }
	public function install()			{ return; }
	public function uninstall()			{ return; }
	public function init()
	{
		$this->incModePref = $this->skin_incmodepref();
		return;
	}
	
	public function event_PreSkinParse()
	{
		global $member;
		if( !$member->isLoggedIn() and isset($_GET['lang']) )
		{
			/* 3 months */
			setcookie('NP_Text', getVar('lang'), time()+60*60*24*90);
		}
		return;
	}
	 
	public function doSkinVar($skinType, $constant)
	{
		global $member, $CONF;
		
		$language = getLanguageName();
		$getLanguage = isset($_GET['lang']) ? getVar('lang') : false;
		$cookieLanguage = isset($_COOKIE['NP_Text']) ? cookieVar('NP_Text') : false;
		
		if( $getLanguage )
		{
			$this->use_lang($getLanguage, $constant);
		}
		elseif( $cookieLanguage )
		{
			$this->use_lang($cookieLanguage, $constant);
		}
		else
		{
			$this->use_lang($language, $constant);
		}
		return;
	}
	
	public function doTemplateVar(&$item, $constant)
	{
		global $member, $CONF;
		
		$language = getLanguageName();
		$getLanguage = isset($_GET['lang']) ? getVar('lang') : false;
		$cookieLanguage = isset($_COOKIE['NP_Text']) ? cookieVar('NP_Text') : false;
		
		if( $getLanguage )
		{
			$this->use_lang($getLanguage, $constant);
		}
		elseif( $cookieLanguage )
		{
			$this->use_lang($cookieLanguage, $constant);
		}
		else
		{
			$this->use_lang($language, $constant);
		}
		return;
	}
	
	private function use_lang($language, $constant)
	{
		global $DIR_SKINS;
		
		$filename = '';
		
		if( $this->incModePref[0] == "normal" )
		{
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		}
		elseif( $this->incModePref[0] == "skindir" )
		{
			$filename = $filename.$DIR_SKINS;
			$filename = $filename.$this->incModePref[1];
			$filename = $filename."language/";
			$filename = $filename.$language;
			$filename = $filename.".php";
		}
		
		if( is_file($filename) ) {
			include($filename);
		}
		else
		{
			addToLog(1, "NP_Text cannot find ".$filename);
		}
		
		if( defined($this->constantPrefix.$constant) )
		{
			echo constant($this->constantPrefix.$constant);
		}
		else
		{
			echo $this->constantPrefix.$constant;
			if( is_file($filename) )
			{
				addToLog(1, "NP_Text cannot find definition for ".$this->constantPrefix.$constant." in ".$filename);
			}
		}
		return;
	}
	
	private function skin_incmodepref()
	{
		global $currentSkinName;
		$sql = "SELECT * FROM ".sql_table("skin_desc")." WHERE sdname = '".$currentSkinName."'";
		$result = sql_query($sql);
		$row = sql_fetch_array($result, MYSQL_ASSOC);
		return array($row['sdincmode'], $row['sdincpref']);
	}
}
