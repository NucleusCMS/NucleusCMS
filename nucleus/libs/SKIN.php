<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * Class representing a skin
 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/ACTIONS.php';

class SKIN {

	// after creating a SKIN object, evaluates to true when the skin exists
	var $isValid;

	// skin characteristics. Use the getXXX methods rather than accessing directly
	var $id;
	var $description;
	var $contentType;
	var $includeMode;		// either 'normal' or 'skindir'
	var $includePrefix;
	var $name;

	function SKIN($id) {
		global $resultCache;
		
		$this->id = intval($id);

		// read skin name/description/content type
		$query = 'SELECT * FROM '.sql_table('skin_desc')." WHERE sdnumber='{$this->id}'";
		if(isset($resultCache[$query]))
		{
			$obj   = $resultCache[$query];
			$count = $resultCache["count{$query}"];
		}
		else
		{
			$res   = sql_query($query);
			$obj   = sql_fetch_object($res);
			$count = sql_num_rows($res);
			$resultCache[$query]          = $obj;
			$resultCache["count{$query}"] = $count;
		}
		$this->isValid = ($count > 0);
		if (!$this->isValid)
			return;

		$this->name = $obj->sdname;
		$this->description = $obj->sddesc;
		$this->contentType = $obj->sdtype;
		$this->includeMode = $obj->sdincmode;
		$this->includePrefix = $obj->sdincpref;

	}

	function getID() {				return $this->id; }
	function getName() { 			return $this->name; }
	function getDescription() { 	return $this->description; }
	function getContentType() { 	return $this->contentType; }
	function getIncludeMode() { 	return $this->includeMode; }
	function getIncludePrefix() { 	return $this->includePrefix; }

	/**
	 * Checks if a skin with a given shortname exists
	 * @param string $name Skin short name
	 * @return int number of skins with the given ID
	 * @static
	 */
	public static function exists($name) {
		return quickQuery('select count(*) as result FROM '.sql_table('skin_desc').' WHERE sdname="'.sql_real_escape_string($name).'"') > 0;
	}

	/**
	 * Checks if a skin with a given ID exists
	 * @param string $id Skin ID
	 * @return int number of skins with the given ID
	 * @static
	 */
	public static function existsID($id) {
		return quickQuery('select COUNT(*) as result FROM '.sql_table('skin_desc').' WHERE sdnumber='.intval($id)) > 0;
	}

	/**
	 * Returns a skin given its shortname
	 * @param string $name Skin shortname
	 * @return object SKIN
	 * @static
	 */
	public static function createFromName($name) {
		return new SKIN(SKIN::getIdFromName($name));
	}

	/**
	 * Returns a skin ID given its shortname
	 * @param string $name Skin shortname
	 * @return int Skin ID
	 * @static
	 */
	public static function getIdFromName($name) {
		$query =  'SELECT sdnumber'
			   . ' FROM '.sql_table('skin_desc')
			   . ' WHERE sdname="'.sql_real_escape_string($name).'"';
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return $obj->sdnumber;
	}

	/**
	 * Returns a skin shortname given its ID
	 * @param string $name
	 * @return string Skin short name
	 * @static
	 */
	public static function getNameFromId($id) {
		return quickQuery('SELECT sdname as result FROM '.sql_table('skin_desc').' WHERE sdnumber=' . intval($id));
	}

	/**
	 * Creates a new skin, with the given characteristics.
	 *
	 * @static
	 */
	public static function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '') {
		global $manager;

		$param = array(
			'name'			=> &$name,
			'description'	=> &$desc,
			'type'			=> &$type,
			'includeMode'	=> &$includeMode,
			'includePrefix'	=> &$includePrefix
		);
		$manager->notify('PreAddSkin', $param);

		sql_query('INSERT INTO '.sql_table('skin_desc')." (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('" . sql_real_escape_string($name) . "','" . sql_real_escape_string($desc) . "','".sql_real_escape_string($type)."','".sql_real_escape_string($includeMode)."','".sql_real_escape_string($includePrefix)."')");
		$newid = sql_insert_id();

		$param = array(
			'skinid'		=> $newid,
			'name'			=> $name,
			'description'	=> $desc,
			'type'			=> $type,
			'includeMode'	=> $includeMode,
			'includePrefix'	=> $includePrefix
		);
		$manager->notify('PostAddSkin', $param);

		return $newid;
	}

	function parse($type) {
		global $manager, $CONF, $skinid;
		
		$param = array(
			'skin' => &$this,
			'type' =>  $type
		);
		$manager->notify('InitSkinParse', $param);
		$skinid = $this->id;
		
		// set output type
		sendContentType($this->getContentType(), 'skin', _CHARSET);
		
		// set skin name as global var (so plugins can access it)
		global $currentSkinName;
		$currentSkinName = $this->getName();
		
		$contents = $this->getContent($type);
		
		if (!$contents) {
			// use base skin if this skin does not have contents
			$defskin = new SKIN($CONF['BaseSkin']);
			$contents = $defskin->getContent($type);
			if (!$contents) {
				echo _ERROR_SKIN;
				return;
			}
		}
		
		$actions = $this->getAllowedActionsForType($type);
		
		$param = array(
			'skin'		=> &$this,
			'type'		=>  $type,
			'contents'	=> &$contents
		);
		$manager->notify('PreSkinParse', $param);
		$skinid = $this->id;
		
		// set IncludeMode properties of parser
		PARSER::setProperty('IncludeMode',$this->getIncludeMode());
		PARSER::setProperty('IncludePrefix',$this->getIncludePrefix());
		
		$handler = new ACTIONS($type, $this);
		$parser = new PARSER($actions, $handler);
		$handler->setParser($parser);
		$handler->setSkin($this);
		
		ob_start();
		$parser->parse($contents);
		$output = ob_get_contents();
		
		$md5['<%BenchMark%>'] = md5('<%BenchMark%>');
		if(strpos($output,$md5['<%BenchMark%>'])!==false)
			$output = str_replace($md5['<%BenchMark%>'], '<%BenchMark%>', $output);
		
		$md5['<%DebugInfo%>'] = md5('<%DebugInfo%>');
		if(strpos($output,$md5['<%DebugInfo%>'])!==false)
			$output = str_replace($md5['<%DebugInfo%>'], '<%DebugInfo%>', $output);
		
		$param = array(
			'skin'   => &$this,
			'type'   =>  $type,
			'output' => &$output
		);
		$manager->notify('PostSkinParse', $param);

		if(strpos($output,'<%BenchMark%>')!==false)
		{
			$rs = coreSkinVar('<%BenchMark%>');
			$output = str_replace('<%BenchMark%>', $rs, $output);
		}
		if(strpos($output,'<%DebugInfo%>')!==false)
		{
			$rs = coreSkinVar('<%DebugInfo%>');
			$output = str_replace('<%DebugInfo%>', $rs, $output);
		}
		ob_end_clean();
		
		$skinid = $this->id;
		return $output;
	}

	function getContent($type) {
		if(strpos($type, '/')!==false) return '';
		$query = 'SELECT scontent FROM '.sql_table('skin')." WHERE sdesc=$this->id and stype='". sql_real_escape_string($type) ."'";
		$res = sql_query($query);

		if (sql_num_rows($res) == 0)
			return '';
		else
			return sql_result($res, 0, 0);
	}

	/**
	 * Updates the contents of one part of the skin
	 */
	function update($type, $content) {
		$skinid = $this->id;

		// delete old thingie
		sql_query('DELETE FROM '.sql_table('skin')." WHERE stype='".sql_real_escape_string($type)."' and sdesc=" . intval($skinid));

		// write new thingie
		if ($content) {
			sql_query('INSERT INTO '.sql_table('skin')." SET scontent='" . sql_real_escape_string($content) . "', stype='" . sql_real_escape_string($type) . "', sdesc=" . intval($skinid));
		}
	}

	/**
	 * Deletes all skin parts from the database
	 */
	function deleteAllParts() {
		sql_query('DELETE FROM '.sql_table('skin').' WHERE sdesc='.$this->getID());
	}

	/**
	 * Updates the general information about the skin
	 */
	function updateGeneralInfo($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '') {
		$query =  'UPDATE '.sql_table('skin_desc').' SET'
			   . " sdname='" . sql_real_escape_string($name) . "',"
			   . " sddesc='" . sql_real_escape_string($desc) . "',"
			   . " sdtype='" . sql_real_escape_string($type) . "',"
			   . " sdincmode='" . sql_real_escape_string($includeMode) . "',"
			   . " sdincpref='" . sql_real_escape_string($includePrefix) . "'"
			   . " WHERE sdnumber=" . $this->getID();
		sql_query($query);
	}

	/**
	 * static: returns an array of friendly names
	 */
	public static function getFriendlyNames() {
		$skintypes = array(
			'index' => _SKIN_PART_MAIN,
			'item' => _SKIN_PART_ITEM,
			'archivelist' => _SKIN_PART_ALIST,
			'archive' => _SKIN_PART_ARCHIVE,
			'search' => _SKIN_PART_SEARCH,
			'error' => _SKIN_PART_ERROR,
			'member' => _SKIN_PART_MEMBER,
			'imagepopup' => _SKIN_PART_POPUP
		);

		$query = "SELECT stype FROM " . sql_table('skin') . " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
		$res = sql_query($query);
		while ($row = sql_fetch_array($res)) {
			$skintypes[strtolower($row['stype'])] = ucfirst($row['stype']);
		}

		return $skintypes;
	}

	public static function getAllowedActionsForType($type) {
		global $blogid;

		// some actions that can be performed at any time, from anywhere
		$defaultActions = array('otherblog',
								'plugin',
								'version',
								'nucleusbutton',
								'include',
								'phpinclude',
								'parsedinclude',
								'loginform',
								'sitevar',
								'otherarchivelist',
								'otherarchivedaylist',
								'otherarchiveyearlist',
								'self',
								'adminurl',
								'todaylink',
								'archivelink',
								'member',
								'ifcat',					// deprecated (Nucleus v2.0)
								'category',
								'searchform',
								'referer',
								'skinname',
								'skinfile',
								'set',
								'if',
								'else',
								'endif',
								'elseif',
								'ifnot',
								'elseifnot',
								'charset',
								'bloglist',
								'addlink',
								'addpopupcode',
								'sticky'
								);

		// extra actions specific for a certain skin type
		$extraActions = array();

		switch ($type) {
			case 'index':
				$extraActions = array('blog',
								'blogsetting',
								'preview',
								'additemform',
								'categorylist',
								'archivelist',
								'archivedaylist',
								'archiveyearlist',
								'nextlink',
								'prevlink'
								);
				break;
			case 'archive':
				$extraActions = array('blog',
								'archive',
								'otherarchive',
								'categorylist',
								'archivelist',
								'archivedaylist',
								'archiveyearlist',
								'blogsetting',
								'archivedate',
								'nextarchive',
								'prevarchive',
								'nextlink',
								'prevlink',
								'archivetype'
				);
				break;
			case 'archivelist':
				$extraActions = array('blog',
								'archivelist',
								'archivedaylist',
								'archiveyearlist',
								'categorylist',
								'blogsetting',
							   );
				break;
			case 'search':
				$extraActions = array('blog',
								'archivelist',
								'archivedaylist',
								'archiveyearlist',
								'categorylist',
								'searchresults',
								'othersearchresults',
								'blogsetting',
								'query',
								'nextlink',
								'prevlink'
								);
				break;
			case 'imagepopup':
				$extraActions = array('image',
								'imagetext',				// deprecated (Nucleus v2.0)
								);
				break;
			case 'member':
				$extraActions = array(
								'membermailform',
								'blogsetting',
//								'nucleusbutton'
								'categorylist'
				);
				break;
			case 'item':
				$extraActions = array('blog',
								'item',
								'comments',
								'commentform',
								'vars',
								'blogsetting',
								'nextitem',
								'previtem',
								'nextlink',
								'prevlink',
								'nextitemtitle',
								'previtemtitle',
								'categorylist',
								'archivelist',
								'archivedaylist',
								'archiveyearlist',
								'itemtitle',
								'itemid',
								'itemlink',
								);
				break;
			case 'error':
				$extraActions = array(
								'errormessage',
								'categorylist'
				);
				break;
			default:
				if ($blogid && $blogid > 0) {
					$extraActions = array(
						'blog',
						'blogsetting',
						'preview',
						'additemform',
						'categorylist',
						'archivelist',
						'archivedaylist',
						'archiveyearlist',
						'nextlink',
						'prevlink',
						'membermailform',
//						'nucleusbutton'
						'categorylist'
					);
				}
				break;
		}

		return array_merge($defaultActions, $extraActions);
	}

}

?>
