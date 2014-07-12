<?php
/*
License:
This software is published under the same license as NucleusCMS, namely
the GNU General Public License. See http://www.gnu.org/licenses/gpl.html for
details about the conditions of this license.

In general, this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by the Free
Software Foundation; either version 2 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/
class NP_SecurityEnforcer extends NucleusPlugin {

	function getName() { return 'SecurityEnforcer'; }

	function getAuthor()  {	return 'Frank Truscott + Cacher';	}

	function getURL()   { return 'http://revcetera.com/ftruscot';	}

	function getVersion() {	return '1.02'; }

	function getDescription() {
		return _SECURITYENFORCER_DESCRIPTION;
	}
	
	function getMinNucleusVersion() { return 350; }

	function supportsFeature($what)	{
		switch($what) {
		case 'SqlTablePrefix':
			return 1;
		/*case 'HelpPage':
			return 1;*/
		default:
			return 0;
		}
	}

	function getTableList() { return array(sql_table('plug_securityenforcer')); }
	function getEventList() { return array('QuickMenu','PrePasswordSet','CustomLogin','LoginSuccess','LoginFailed','PostRegister','PrePluginOptionsEdit'); }
	
	function install() {
		global $CONF;

// Need to make some options
		$this->createOption('quickmenu', _SECURITYENFORCER_OPT_QUICKMENU, 'yesno', 'yes');
		$this->createOption('del_uninstall_data', _SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA, 'yesno','no');
		$this->createOption('enable_security', _SECURITYENFORCER_OPT_ENABLE, 'yesno','yes');
		$this->createOption('pwd_min_length', _SECURITYENFORCER_OPT_PWD_MIN_LENGTH, 'text','8');
		//$this->createOption('pwd_complexity', _SECURITYENFORCER_OPT_PWD_COMPLEXITY, 'select','0',_SECURITYENFORCER_OPT_SELECT_OFF_COMP.'|0|'._SECURITYENFORCER_OPT_SELECT_ONE_COMP.'|1|'._SECURITYENFORCER_OPT_SELECT_TWO_COMP.'|2|'._SECURITYENFORCER_OPT_SELECT_THREE_COMP.'|3|'._SECURITYENFORCER_OPT_SELECT_FOUR_COMP.'|4');
		$this->createOption('pwd_complexity', '_SECURITYENFORCER_OPT_PWD_COMPLEXITY', 'select','0','_SECURITYENFORCER_OPT_SELECT');
		$this->createOption('max_failed_login', _SECURITYENFORCER_OPT_MAX_FAILED_LOGIN, 'text', '5');
		$this->createOption('login_lockout', _SECURITYENFORCER_OPT_LOGIN_LOCKOUT, 'text', '15');
		
// create needed tables
		sql_query("CREATE TABLE IF NOT EXISTS ". sql_table('plug_securityenforcer').
					" ( 
					  `login` varchar(255),
					  `fails` int(11) NOT NULL default '0',
					  `lastfail` bigint NOT NULL default '0',
					  KEY `login` (`login`)) ENGINE=MyISAM");

	}
	
	function unInstall() {
		// if requested, delete the data table
		if ($this->getOption('del_uninstall_data') == 'yes')	{
			sql_query('DROP TABLE '.sql_table('plug_securityenforcer'));
		}
	}
	
	function init() {
		// include language file for this plugin
        $language = preg_replace( '@\\|/@', '', getLanguageName());
        if (file_exists($this->getDirectory().$language.'.php'))
            include_once($this->getDirectory().$language.'.php');
        else
            include_once($this->getDirectory().'english.php');
			
		$this->enable_security = $this->getOption('enable_security');
		$this->pwd_min_length = intval($this->getOption('pwd_min_length'));
		$this->pwd_complexity = intval($this->getOption('pwd_complexity'));
		$this->max_failed_login = intval($this->getOption('max_failed_login'));
		$this->login_lockout = intval($this->getOption('login_lockout'));
	}
	function hasAdminArea() { return 1; }

	function event_QuickMenu(&$data) {
    	// only show when option enabled
		global $member;
    	if ($this->getOption('quickmenu') != 'yes' || !$member->isAdmin()) return;
    	//global $member;
    	if (!($member->isLoggedIn())) return;
    	array_push($data['options'],
      		array('title' => 'Security Enforcer',
        	'url' => $this->getAdminURL(),
        	'tooltip' => _SECURITYENFORCER_ADMIN_TOOLTIP));
  	}
	
	function event_PrePasswordSet(&$data) {
		//password, errormessage, valid
		if ($this->enable_security == 'yes') {
			$password = $data['password'];
			// conditional below not needed in 3.60 or higher. Used to keep from setting off error when password not being changed
			if (postVar('action') == 'changemembersettings')
				$emptyAllowed = true;
			else
				$emptyAllowed = false;
			if ((!$emptyAllowed)||$password){
				$message = $this->_validate_and_messsage($password,$this->pwd_min_length, $this->pwd_complexity);
				if ($message) {
					$data['errormessage'] = _SECURITYENFORCER_INSUFFICIENT_COMPLEXITY . $message. "<br /><br />\n";
					$data['valid'] = false;
				}
			}
		}
	}
	
	function event_PostRegister(&$data) {
		if ($this->enable_security == 'yes') {
			$password = postVar('password');
			if(postVar('action') == 'memberadd'){
				$message = $this->_validate_and_messsage($password,$this->pwd_min_length, $this->pwd_complexity);
				if ($message) {
					$errormessage = _SECURITYENFORCER_ACCOUNT_CREATED. $message. "<br /><br />\n";
					global $admin;
					$admin->error($errormessage);
				}
			}
		}
	}
	
	function event_CustomLogin(&$data) {
		//login,password,success,allowlocal
		if ($this->enable_security == 'yes' && $this->max_failed_login > 0) {
			global $_SERVER;
			$login = $data['login'];
			$ip = $_SERVER['REMOTE_ADDR'];
			sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE lastfail < ".(time() - ($this->login_lockout * 60)));
			$query = "SELECT fails as result FROM ".sql_table('plug_securityenforcer')." ";
			$query .= "WHERE login='".sql_real_escape_string($login)."'";
			$flogin = quickQuery($query); 
			$query = "SELECT fails as result FROM ".sql_table('plug_securityenforcer')." ";
			$query .= "WHERE login='".sql_real_escape_string($ip)."'";
			$fip = quickQuery($query); 
			if ($flogin >= $this->max_failed_login || $fip >= $this->max_failed_login) {
				$data['success'] = 0;
				$data['allowlocal'] = 0;
				$info = sprintf(_SECURITYENFORCER_LOGIN_DISALLOWED, htmlspecialchars($login,ENT_QUOTES,_CHARSET), htmlspecialchars($ip,ENT_QUOTES,_CHARSET));
                ACTIONLOG::add(INFO, $info);
			}
		}
	}
	
	function event_LoginSuccess(&$data) {
		//member(obj),username
		if ($this->enable_security == 'yes' && $this->max_failed_login > 0) {
			global $_SERVER;
			$login = $data['username'];
			$ip = $_SERVER['REMOTE_ADDR'];
			sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($login)."'");
			sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($ip)."'");
		}
	}
	
	function event_LoginFailed(&$data) {
		//username
		if ($this->enable_security == 'yes' && $this->max_failed_login > 0) {
			global $_SERVER;
			$login = $data['username'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$lres = sql_query("SELECT * FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($login)."'");
			if (sql_num_rows($lres)) {
				sql_query("UPDATE ".sql_table('plug_securityenforcer')." SET fails=fails+1, lastfail=".time()." WHERE login='".sql_real_escape_string($login)."'");
			}
			else {
				sql_query("INSERT INTO ".sql_table('plug_securityenforcer')." (login,fails,lastfail) VALUES ('".sql_real_escape_string($login)."',1,".time().")");
			}
			$lres = sql_query("SELECT * FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($ip)."'");
			if (sql_num_rows($lres)) {
				sql_query("UPDATE ".sql_table('plug_securityenforcer')." SET fails=fails+1, lastfail=".time()." WHERE login='".sql_real_escape_string($ip)."'");
			}
			else {
				sql_query("INSERT INTO ".sql_table('plug_securityenforcer')." (login,fails,lastfail) VALUES ('".sql_real_escape_string($ip)."',1,".time().")");
			}
		}		
	}
	
	function event_PrePluginOptionsEdit($data) {
		if (array_key_exists('plugid', $data) && $data['plugid'] === $this->getID()) {
			foreach($data['options'] as $key => $value){
				if (defined($value['description'])) {
					$data['options'][$key]['description'] = constant($value['description']);
				}
				if (!strcmp($value['type'], 'select') && defined($value['typeinfo'])) {
					$data['options'][$key]['typeinfo'] = constant($value['typeinfo']);
				}
			}
		}
	}
	
	/* Helper Functions */
	
	function _validate_passwd($passwd,$minlength = 6,$complexity = 0) {
		$minlength = intval($minlength);
		$complexity = intval($complexity);
		
		if ($minlength < 6 ) $minlength = 6;
		if (strlen($passwd) < $minlength) return false;

		if ($complexity > 4) $complexity = 4;
		$ucchars = "[A-Z]";
		$lcchars = "[a-z]";
		$numchars = "[0-9]";
		$ochars = "[-~!@#$%^&*()_+=,.<>?:;|]";
		$chartypes = array($ucchars, $lcchars, $numchars, $ochars);
		$tot = array(0,0,0,0);
		$i = 0;
		foreach ($chartypes as $value) {
			$tot[$i] = preg_match("/".$value."/", $passwd);
			$i = $i + 1;
		}

		if (array_sum($tot) >= $complexity) return true;
		else return false;
	}
	
	function _validate_and_messsage($passwd,$minlength = 6,$complexity = 0) {
		$minlength = intval($minlength);
		$complexity = intval($complexity);

		if ($minlength < 6 ) $minlength = 6;
		if (strlen($passwd) < $minlength) {
			$message = _SECURITYENFORCER_MIN_PWD_LENGTH . $this->pwd_min_length;
		}

		if ($complexity > 4) $complexity = 4;
		$ucchars = "[A-Z]";
		$lcchars = "[a-z]";
		$numchars = "[0-9]";
		$ochars = "[-~!@#$%^&*()_+=,.<>?:;|]";
		$chartypes = array($ucchars, $lcchars, $numchars, $ochars);
		$tot = array(0,0,0,0);
		$i = 0;
		foreach ($chartypes as $value) {
			$tot[$i] = preg_match("/".$value."/", $passwd);
			$i = $i + 1;
		}

		if (array_sum($tot) < $complexity) {
			$message .= _SECURITYENFORCER_PWD_COMPLEXITY . $this->pwd_complexity;
		}
		return $message;
	}
}
?>
