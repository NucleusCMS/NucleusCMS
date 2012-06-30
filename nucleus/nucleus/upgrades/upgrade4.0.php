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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id: upgrade2.0.php 1388 2009-07-18 06:31:28Z shizuki $
 */

function upgrade_do400()
{
	if ( upgrade_checkinstall(400) )
	{
		return "already installed";
	}
	
	// Give user warning if they are running old version of PHP
	if ( phpversion() < '5' )
	{
		echo 'WARNING: You are running NucleusCMS on a older version of PHP that is no longer supported by NucleusCMS. Please upgrade to PHP5!';
	}
	
	/* config table */
	/* change Language setting to Locale */
	if ( upgrade_checkIfCVExists('Language') )
	{
		$res = sql_query("SELECT value FROM " . sql_table('config') . " WHERE name='Language'");
		if ( $res !== FALSE )
		{
			$row = sql_fetch_assoc($res);
			$locale = i18n_upg::convert_old_language_file_name_to_locale($row['value']);
			if ( $locale )
			{
				$query = 'INSERT INTO ' . sql_table('config') . " VALUES ('Locale','{$locale}')";
				upgrade_query('Creating Locale config value', $query);
				
				$query = 'DELETE FROM ' . sql_table('config') . " WHERE name='Language'";
				upgrade_query("Removing Language config value", $query);
			}
		}
	}
	
	/* change AdminCSS setting */
	if ( upgrade_checkIfCVExists('AdminCSS') )
	{
		$query = 'UPDATE ' . sql_table('config') . " SET value='original' WHERE name='AdminCSS'";
		upgrade_query('Changing AdminCSS config value', $query);
	}
	
	/* create AdminSkin setting */
	if ( !upgrade_checkIfCVExists('AdminSkin') )
	{
		$query = 'INSERT INTO ' . sql_table('config') . " VALUES ('AdminSkin','0')";
		upgrade_query('Creating AdminSkin config value', $query);
	}
	
	/* create BookmarkletSkin setting */
	if ( !upgrade_checkIfCVExists('BookmarkletSkin') )
	{
		$query = 'INSERT INTO ' . sql_table('config') . " VALUES ('BookmarkletSkin','0')";
		upgrade_query('Creating BookmarkletSkin config value', $query);
	}
	
	
	/* member table */
	/* changing the member table to rename deflang to mlocale */
	if ( !upgrade_checkIfColumnExists('member','mlocale') )
	{
		$query =  'ALTER TABLE '.sql_table('member') . " CHANGE deflang mlocale varchar(20) NOT NULL default '' AFTER mcookiekey";
		upgrade_query("Renaming deflang column for members to mlocale", $query);
	}
	
	/* changing the member table to add madminskin column */
	if ( !upgrade_checkIfColumnExists('member','madminskin') )
	{
		$query =  'ALTER TABLE '.sql_table('member') . " ADD madminskin tinyint(2) NOT NULL default '0'";
		upgrade_query("Adding a new row for the adminskin member option", $query);
	}
	
	/* changing the member table to add mbkmklt column */
		if ( !upgrade_checkIfColumnExists('member','mbkmklt') )
	{
		$query =  'ALTER TABLE '.sql_table('member') . " ADD mbkmklt tinyint(2) NOT NULL default '0'";
		upgrade_query("Adding a new row for the bkmklt member option", $query);
	}
	
	// all member default value set
	$result = sql_query("SELECT * FROM " . sql_table('member'));
	while ( $row = mysql_fetch_assoc($result) )
	{
		$locale = i18n_upg::convert_old_language_file_name_to_locale($row['mlocale']);
		if ( $locale )
		{
			$query = 'UPDATE $s SET mlocale=$s WHERE mnumber=$d';
			$query = sprintf($query, sql_table('member'), addslashes($locale), $row['mnumber']);
			upgrade_query('Changing mlocale value', $query);
		}
	}
	
	// 3.6 -> 4.0
	// update database version
	update_version('400');
	
}

class i18n_upg
{
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
			"finnish"		=> "fi_Latn_FI",
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
