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
 * Class representing a skin
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
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

	/**
	 * Constructor for a new SKIN object
	 * 
	 * @param $id 
	 * 			id of the skin
	 */
	function SKIN($id) {
		$this->id = intval($id);

		// read skin name/description/content type
		$res = sql_query('SELECT * FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $this->id);
		$obj = sql_fetch_object($res);
		$this->isValid = (sql_num_rows($res) > 0);
		if (!$this->isValid)
			return;

		$this->name = $obj->sdname;
		$this->description = $obj->sddesc;
		$this->contentType = $obj->sdtype;
		$this->includeMode = $obj->sdincmode;
		$this->includePrefix = $obj->sdincpref;

	}

	/**
	 * Get SKIN id
	 */
	function getID() {
		return $this->id;
	}

	/**
	 * Get SKIN name
	 */
	function getName() {
		return $this->name;
	}
	
	/**
	 * Get SKIN description
	 */
	function getDescription() {
		return $this->description;
	}
	
	/**
	 * Get SKIN content type
	 * 
	 * e.g. text/xml, text/html, application/atom+xml
	 */
	function getContentType() {
		return $this->contentType;
	}
	
	/**
	 * Get include mode of the SKIN
	 * 
	 * Returns either 'normal' or 'skindir':
	 * 'normal': if a all data of the skin can be found in the databse
	 * 'skindir': if the skin has data in the it's skin driectory
	 */
	function getIncludeMode() {
		return $this->includeMode;
	}
	
	/**
	 * Get include prefix of the SKIN
	 * 
	 * Get name of the subdirectory (with trailing slash) where
	 * the files of the current skin can be found (e.g. 'default/')
	 */
	function getIncludePrefix() {
		return $this->includePrefix;
	}

	/**
	 * Checks if a skin with a given shortname exists
	 * @param string $name Skin short name
	 * @return int number of skins with the given ID
	 * @static
	 */
	function exists($name) {
		return quickQuery('select count(*) as result FROM '.sql_table('skin_desc').' WHERE sdname="'.sql_real_escape_string($name).'"') > 0;
	}

	/**
	 * Checks if a skin with a given ID exists
	 * @param string $id Skin ID
	 * @return int number of skins with the given ID
	 * @static
	 */
	function existsID($id) {
		return quickQuery('select COUNT(*) as result FROM '.sql_table('skin_desc').' WHERE sdnumber='.intval($id)) > 0;
	}

	/**
	 * Returns a skin given its shortname
	 * @param string $name Skin shortname
	 * @return object SKIN
	 * @static
	 */
	function createFromName($name) {
		return new SKIN(SKIN::getIdFromName($name));
	}

	/**
	 * Returns a skin ID given its shortname
	 * @param string $name Skin shortname
	 * @return int Skin ID
	 * @static
	 */
	function getIdFromName($name) {
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
	function getNameFromId($id) {
		return quickQuery('SELECT sdname as result FROM '.sql_table('skin_desc').' WHERE sdnumber=' . intval($id));
	}

	/**
	 * Creates a new skin, with the given characteristics.
	 *
	 * @static
	 */
	function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '') {
		global $manager;

		$data = array(
			'name'			=> &$name,
			'description'	=> &$desc,
			'type'			=> &$type,
			'includeMode'	=> &$includeMode,
			'includePrefix'	=> &$includePrefix
		);
		$manager->notify('PreAddSkin', $data);

		sql_query('INSERT INTO '.sql_table('skin_desc')." (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('" . sql_real_escape_string($name) . "','" . sql_real_escape_string($desc) . "','".sql_real_escape_string($type)."','".sql_real_escape_string($includeMode)."','".sql_real_escape_string($includePrefix)."')");
		$newid = sql_insert_id();

		$data = array(
			'skinid'		=> $newid,
			'name'			=> $name,
			'description'	=> $desc,
			'type'			=> $type,
			'includeMode'	=> $includeMode,
			'includePrefix'	=> $includePrefix
		);
		$manager->notify('PostAddSkin', $data);

		return $newid;
	}

	/**
	 * Parse a SKIN
	 * 
	 * @param string $type
	 */
	function parse($type) {
		global $manager, $CONF;

		$data = array(
			'skin' => &$this,
			'type' => $type
		);
		$manager->notify('InitSkinParse', $data);

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

		$data = array(
			'skin'		=> &$this,
			'type'		=> $type,
			'contents'	=> &$contents
		);
		$manager->notify('PreSkinParse', $data);

		// set IncludeMode properties of parser
		PARSER::setProperty('IncludeMode',$this->getIncludeMode());
		PARSER::setProperty('IncludePrefix',$this->getIncludePrefix());

		$handler = new ACTIONS($type, $this);
		$parser = new PARSER($actions, $handler);
		$handler->setParser($parser);
		$handler->setSkin($this);
		$parser->parse($contents);

		$data = array(
			'skin' => &$this,
			'type' => $type
		);
		$manager->notify('PostSkinParse', $data);


	}

	/**
	 * Get content of the skin part from the database
	 * 
	 * @param $type type of the skin (e.g. index, item, search ...)
	 */
	function getContent($type) {
		$query = 'SELECT scontent FROM '.sql_table('skin')." WHERE sdesc=$this->id and stype='". sql_real_escape_string($type) ."'";
		$res = sql_query($query);

		if (sql_num_rows($res) == 0)
			return '';
		else
			return sql_result($res, 0, 0);
	}

	/**
	 * Updates the contents for one part of the skin in the database
	 * 
	 * @param $type type of the skin part (e.g. index, item, search ...) 
	 * @param $content new content for this skin part
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
	 * Get an array with the names of possible skin parts
	 * Used to show all possible parts of a skin in the administration backend
	 * 
	 * static: returns an array of friendly names
	 */
	function getFriendlyNames() {
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

	/**
	 * Get the allowed actions for a skin type
	 * returns an array with the allowed actions
	 * 
	 * @param $type type of the skin (e.g. index, item, search ...)
	 */
	function getAllowedActionsForType($type) {
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
								'nucleusbutton',
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
						'nucleusbutton',
						'categorylist'
					);
				}
				break;
		}

		return array_merge($defaultActions, $extraActions);
	}

}

?>
