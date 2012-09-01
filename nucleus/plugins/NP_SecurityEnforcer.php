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

* @version $Id$
*/
class NP_SecurityEnforcer extends NucleusPlugin
{
	public function getName()
	{
		return 'SecurityEnforcer';
	}

	public function getAuthor()
	{
		return 'Frank Truscott + Cacher + Mocchi';
	}

	public function getURL()
	{
		return 'http://revcetera.com/ftruscot';
	}

	public function getVersion()
	{
		return '1.02';
	}

	public function getDescription()
	{
		return _SECURITYENFORCER_DESCRIPTION;
	}

	public function getMinNucleusVersion()
	{
		return 400;
	}

	public function getTableList()
	{
		return array(sql_table('plug_securityenforcer'));
	}

	public function getEventList()
	{
		return array('QuickMenu','PrePasswordSet','CustomLogin','LoginSuccess','LoginFailed','PostRegister');
	}

	public function hasAdminArea() {
		return 1;
	}
	
	public function supportsFeature($what)
	{
		if ( $what == 'SqlTablePrefix' )
		{
			return 1;
		}
		return 0;
	}
	
	public function install()
	{
		global $CONF;
		
		// Need to make some options
		$this->createOption('quickmenu',			'_SECURITYENFORCER_OPT_QUICKMENU',			'yesno', 'yes');
		$this->createOption('del_uninstall_data',	'_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA',	'yesno','no');
		$this->createOption('enable_security',		'_SECURITYENFORCER_OPT_ENABLE',				'yesno','yes');
		$this->createOption('pwd_min_length',		'_SECURITYENFORCER_OPT_PWD_MIN_LENGTH',		'text','8');
		$this->createOption('pwd_complexity',		'_SECURITYENFORCER_OPT_PWD_COMPLEXITY',		'select','0', '_SECURITYENFORCER_OPT_SELECT_OFF_COMP|0|_SECURITYENFORCER_OPT_SELECT_ONE_COMP|1|_SECURITYENFORCER_OPT_SELECT_TWO_COMP|2|_SECURITYENFORCER_OPT_SELECT_THREE_COMP|3|_SECURITYENFORCER_OPT_SELECT_FOUR_COMP|4;datatype=numerical');
		$this->createOption('max_failed_login',		'_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN',	'text', '5');
		$this->createOption('login_lockout',		'_SECURITYENFORCER_OPT_LOGIN_LOCKOUT',		'text', '15');
		
		// create needed tables
		DB::execute('CREATE TABLE IF NOT EXISTS '. sql_table('plug_securityenforcer').
					" (login varchar(255),
					   fails int(11) NOT NULL default '0',
					   lastfail bigint NOT NULL default '0',
					   KEY login (login)) ENGINE=MyISAM");
		return;
	}
	
	public function unInstall()
	{
		// if requested, delete the data table
		if ( $this->getOption('del_uninstall_data') == 'yes' )
		{
			DB::execute('DROP TABLE '.sql_table('plug_securityenforcer'));
		}
		return;
	}
	
	public function init()
	{
		// include translation file for this plugin
		if ( file_exists($this->getDirectory() . i18n::get_current_locale() . '.' . i18n::get_current_charset() . '.php') )
		{
			include_once($this->getDirectory() . i18n::get_current_locale() . '.' . i18n::get_current_charset() . '.php');
		}
		else
		{
			include_once($this->getDirectory().'en_Latn_US.UTF-8.php');
		}
		
		$this->enable_security	= $this->getOption('enable_security');
		$this->pwd_min_length	= (integer) $this->getOption('pwd_min_length');
		$this->pwd_complexity	= (integer) $this->getOption('pwd_complexity');
		$this->max_failed_login	= (integer) $this->getOption('max_failed_login');
		$this->login_lockout	= (integer) $this->getOption('login_lockout');
		return;
	}
	
	public function event_QuickMenu(&$data)
	{
		// only show when option enabled
		global $member;
		if ( $this->getOption('quickmenu') != 'yes' || !$member->isAdmin() )
		{
			return;
		}
		//global $member;
		if ( !($member->isLoggedIn()) )
		{
			return;
		}
		array_push($data['options'],
			array('title' => 'Security Enforcer',
			'url' => $this->getAdminURL(),
			'tooltip' => _SECURITYENFORCER_ADMIN_TOOLTIP));
		return;
	}
	
	public function event_PrePasswordSet(&$data)
	{
		//password, errormessage, valid
		if ( $this->enable_security == 'no' )
		{
			return;
		}
		$password = $data['password'];
		// conditional below not needed in 3.60 or higher. Used to keep from setting off error when password not being changed
		if ( postVar('action') == 'changemembersettings' )
		{
			$emptyAllowed = true;
		}
		else
		{
			$emptyAllowed = false;
		}
		if ( (!$emptyAllowed)||$password )
		{
			$message = $this->validate_and_messsage($password,$this->pwd_min_length, $this->pwd_complexity);
			if ( $message )
			{
				$data['errormessage'] = _SECURITYENFORCER_INSUFFICIENT_COMPLEXITY . $message. "<br /><br />\n";
				$data['valid'] = false;
			}
		}
		return;
	}
	
	public function event_PostRegister(&$data)
	{
		if ( $this->enable_security != 'yes' )
		{
			return;
		}
		$password = postVar('password');
		if( postVar('action') == 'memberadd' )
		{
			$message = $this->validate_and_messsage($password,$this->pwd_min_length, $this->pwd_complexity);
			if ( $message )
			{
				$errormessage = _SECURITYENFORCER_ACCOUNT_CREATED. $message. "<br /><br />\n";
				global $admin;
				$admin->error($errormessage);
			}
		}
		return;
	}
	
	public function event_CustomLogin(&$data)
	{
		if ( $this->enable_security != 'yes' || $this->max_failed_login <= 0 )
		{
			return;
		}
		
		//login,password,success,allowlocal
		global $_SERVER;
		$login = $data['login'];
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$query = "DELETE FROM %s WHERE lastfail < %d;";
		$query = sprintf($query, sql_table('plug_securityenforcer'), (integer) (time() - ($this->login_lockout * 60)));
		DB::execute($query);
		
		$query = "SELECT fails as result FROM %s WHERE login=%s;";
		$query = sprintf($query, sql_table('plug_securityenforcer'), DB::quoteValue($login));
		$flogin = DB::getValue($query); 
		
		$query = "SELECT fails as result FROM %s WHERE login=%s;";
		$query = sprintf($query, sql_table('plug_securityenforcer'), DB::quoteValue($ip));
		$fip = DB::getValue($query); 
		
		if ( $flogin >= $this->max_failed_login || $fip >= $this->max_failed_login )
		{
			$data['success']	= 0;
			$data['allowlocal']	= 0;
			$info = sprintf(_SECURITYENFORCER_LOGIN_DISALLOWED, Entity::hsc($login), Entity::hsc($ip));
			ActionLog::add(INFO, $info);
		}
		return;
	}
	
	public function event_LoginSuccess(&$data)
	{
		//member(obj),username
		if ( $this->enable_security != 'yes' || $this->max_failed_login <= 0 )
		{
			return;
		}
		global $_SERVER;
		$login = $data['username'];
		$ip = $_SERVER['REMOTE_ADDR'];
		DB::execute('DELETE FROM ' . sql_table('plug_securityenforcer') . ' WHERE login=' . DB::quoteValue($login));
		DB::execute('DELETE FROM ' . sql_table('plug_securityenforcer') . ' WHERE login=' . DB::quoteValue($ip));
		return;
	}
	
	public function event_LoginFailed(&$data)
	{
		//username
		if ( $this->enable_security != 'yes' || $this->max_failed_login <= 0 )
		{
			return;
		}
		global $_SERVER;
		$login = $data['username'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$lres = DB::getResult('SELECT * FROM ' . sql_table('plug_securityenforcer') . ' WHERE login=' . DB::quoteValue($login));
		if ( $lres->rowCount() > 0 )
		{
			DB::execute('UPDATE ' . sql_table('plug_securityenforcer') . ' SET fails=fails+1, lastfail=' . time() . ' WHERE login=' . DB::quoteValue($login));
		}
		else
		{
			DB::execute('INSERT INTO ' . sql_table('plug_securityenforcer') . ' (login,fails,lastfail) VALUES (' . DB::quoteValue($login) . ',1,' . time() . ')');
		}
		$lres = DB::getResult('SELECT * FROM ' . sql_table('plug_securityenforcer') . ' WHERE login=' . DB::quoteValue($ip));
		if ( $lres->rowCount() > 0 )
		{
			DB::execute('UPDATE ' . sql_table('plug_securityenforcer') . ' SET fails=fails+1, lastfail=' . time() . ' WHERE login=' . DB::quoteValue($ip));
		}
		else
		{
			DB::execute('INSERT INTO ' . sql_table('plug_securityenforcer') . ' (login,fails,lastfail) VALUES (' . DB::quoteValue($ip) . ',1,' . time() . ')');
		}
		return;
	}
	
	private function validate_and_messsage($passwd,$minlength = 6,$complexity = 0)
	{
		$minlength = intval($minlength);
		$complexity = intval($complexity);
		$message = '';
		
		if ( $minlength < 6 )
		{
			$minlength = 6;
		}
		if ( i18n::strlen($passwd) < $minlength )
		{
			$message = _SECURITYENFORCER_MIN_PWD_LENGTH . $this->pwd_min_length;
		}
		
		if ( $complexity > 4 )
		{
			$complexity = 4;
		}
		
		$ucchars	= '[A-Z]';
		$lcchars	= '[a-z]';
		$numchars	= '[0-9]';
		$ochars		= '[#-~!@\\$%^&*()_+=,.<>?:;|]';
		$chartypes	= array($ucchars, $lcchars, $numchars, $ochars);
		$tot		= array(0,0,0,0);
		$i			= 0;
		
		foreach ( $chartypes as $value )
		{
			$tot[$i] = preg_match("/" . $value . "/", $passwd);
			$i = $i + 1;
		}
		
		if ( array_sum($tot) < $complexity )
		{
			$message .= _SECURITYENFORCER_PWD_COMPLEXITY . $this->pwd_complexity;
		}
		return $message;
	}
}
