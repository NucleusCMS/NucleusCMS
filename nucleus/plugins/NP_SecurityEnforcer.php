<?php
/**
 * Attach plugin for Nucleus CMS
 * Version 0.9.5 (1.0 RC) for PHP5
 * Written by Cacher, Jan.16, 2011
 * Original code was written by Frank Truscott, Nov. 01, 2009
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 */

class NP_SecurityEnforcer extends NucleusPlugin {
	public function getName()			{ return 'SecurityEnforcer'; }
	public function getAuthor()		{ return 'Frank Truscott + Cacher';	}
	public function getURL()			{ return 'https://github.com/NucleusCMS/NP_SecurityEnforcer';	} // 'http://revcetera.com/ftruscot'
	public function getVersion()		{ return '1.03 (1.02JP-f2fb07c8-patch1)'; }
	public function getDescription()	{ return _SECURITYENFORCER_DESCRIPTION;}
	public function getTableList()	{ return array(sql_table('plug_securityenforcer')); }
	public function hasAdminArea()	{ return 1; }
	public function getMinNucleusVersion()	{ return 350; }
	public function supportsFeature($feature)	{ return in_array ($feature, array ('SqlTablePrefix', 'SqlApi'));}
	public function getEventList()	{ return array('QuickMenu','PrePasswordSet','CustomLogin','LoginSuccess','LoginFailed','PostRegister','PrePluginOptionsEdit'); }

	public function install() {
		global $CONF;
		$this->createOption('quickmenu', '_SECURITYENFORCER_OPT_QUICKMENU', 'yesno', 'yes');
		$this->createOption('del_uninstall_data', '_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA', 'yesno','no');
		$this->createOption('enable_security', '_SECURITYENFORCER_OPT_ENABLE', 'yesno','yes');
		$this->createOption('pwd_min_length', '_SECURITYENFORCER_OPT_PWD_MIN_LENGTH', 'text','8');
		//$this->createOption('pwd_complexity', '_SECURITYENFORCER_OPT_PWD_COMPLEXITY', 'select','0',_SECURITYENFORCER_OPT_SELECT_OFF_COMP.'|0|'._SECURITYENFORCER_OPT_SELECT_ONE_COMP.'|1|'._SECURITYENFORCER_OPT_SELECT_TWO_COMP.'|2|'._SECURITYENFORCER_OPT_SELECT_THREE_COMP.'|3|'._SECURITYENFORCER_OPT_SELECT_FOUR_COMP.'|4');
		$this->createOption('pwd_complexity', '_SECURITYENFORCER_OPT_PWD_COMPLEXITY', 'select','0','_SECURITYENFORCER_OPT_SELECT');
		$this->createOption('max_failed_login', '_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN', 'text', '5');
		$this->createOption('login_lockout', '_SECURITYENFORCER_OPT_LOGIN_LOCKOUT', 'text', '15');
		
		$query = "CREATE TABLE IF NOT EXISTS ". sql_table('plug_securityenforcer').
					" ( 
					  `login` varchar(255),
					  `fails` int(11) NOT NULL default '0',
					  `lastfail` bigint NOT NULL default '0',
					KEY `login` (`login`)) ENGINE=MyISAM";

		sql_query($query);
	}
	
	public function unInstall() {
		if ($this->getOption('del_uninstall_data') == 'yes')	{
			sql_query('DROP TABLE '.sql_table('plug_securityenforcer'));
		}
	}
	
	public function init() {
		$language = preg_replace( '#\\\\|/#', '', getLanguageName());
		if (file_exists($this->getDirectory().$language.'.php')){
			include_once($this->getDirectory().$language.'.php');
		} else {
			include_once($this->getDirectory().'english.php');
		}
			
		$this->enable_security = $this->getOption('enable_security');
		$this->pwd_min_length = intval($this->getOption('pwd_min_length'));
		$this->pwd_complexity = intval($this->getOption('pwd_complexity'));
		$this->max_failed_login = intval($this->getOption('max_failed_login'));
		$this->login_lockout = intval($this->getOption('login_lockout'));
	}

	public function event_QuickMenu(&$data) {
		global $member;
		if ($this->getOption('quickmenu') != 'yes' || !$member->isAdmin()) {
			return;
		}
		if (!($member->isLoggedIn())) {
			return;
		}
    	array_push($data['options'],
      		array('title' => 'Security Enforcer',
        	'url' => $this->getAdminURL(),
			'tooltip' => _SECURITYENFORCER_ADMIN_TOOLTIP)
		);
	}
	
	public function event_PrePasswordSet(&$data) {
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
	
	public function event_PostRegister(&$data) {
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
	
	public function event_CustomLogin(&$data) {
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
				if (!defined('_CHARSET')) define('_CHARSET', 'UTF-8');
				$info = sprintf(_SECURITYENFORCER_LOGIN_DISALLOWED, htmlspecialchars($login,ENT_QUOTES,_CHARSET), htmlspecialchars($ip,ENT_QUOTES,_CHARSET));
				ACTIONLOG::add(INFO, $info);
			}
		}
	}
	
	public function event_LoginSuccess(&$data) {
		if ($this->enable_security == 'yes' && $this->max_failed_login > 0) {
			global $_SERVER;
			$login = $data['username'];
			$ip = $_SERVER['REMOTE_ADDR'];
			sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($login)."'");
			sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE login='".sql_real_escape_string($ip)."'");
		}
	}
	
	function event_LoginFailed(&$data) {
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
	
	public function event_PrePluginOptionsEdit($data) {
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
	
	private function _validate_passwd($passwd,$minlength = 6,$complexity = 0) {
		$minlength = intval($minlength);
		$complexity = intval($complexity);
		
		if ($minlength < 6 ) {
			$minlength = 6;
		}
		if (strlen($passwd) < $minlength) {
			return false;
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

		if (array_sum($tot) >= $complexity) {
			return true;
		}
		else return false;
	}
	
	private function _validate_and_messsage($passwd,$minlength = 6,$complexity = 0) {
		$minlength = intval($minlength);
		$complexity = intval($complexity);

		if ($minlength < 6 ) {
			$minlength = 6;
		}
		if (strlen($passwd) < $minlength) {
			$message = _SECURITYENFORCER_MIN_PWD_LENGTH . $this->pwd_min_length;
		}

		if ($complexity > 4) {
			$complexity = 4;
		}
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
