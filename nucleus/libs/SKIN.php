<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

// temporary: dirt way to separe class ACTIONS from SKIN
require_once $DIR_LIBS . 'ACTIONS.php';

/**
 * Class representing a skin
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 * @version $Id$
 */
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
		$this->id = intval($id);

		// read skin name/description/content type
		$res = sql_query('SELECT * FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $this->id);
		$obj = mysql_fetch_object($res);
		$this->isValid = (mysql_num_rows($res) > 0);
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
	function exists($name) {
		return quickQuery('select count(*) as result FROM '.sql_table('skin_desc').' WHERE sdname="'.addslashes($name).'"') > 0;
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
			   . ' WHERE sdname="'.addslashes($name).'"';
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);
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

		$manager->notify(
			'PreAddSkin',
			array(
				'name' => &$name,
				'description' => &$desc,
				'type' => &$type,
				'includeMode' => &$includeMode,
				'includePrefix' => &$includePrefix
			)
		);

		sql_query('INSERT INTO '.sql_table('skin_desc')." (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('" . addslashes($name) . "','" . addslashes($desc) . "','".addslashes($type)."','".addslashes($includeMode)."','".addslashes($includePrefix)."')");
		$newid = mysql_insert_id();

		$manager->notify(
			'PostAddSkin',
			array(
				'skinid' => $newid,
				'name' => $name,
				'description' => $desc,
				'type' => $type,
				'includeMode' => $includeMode,
				'includePrefix' => $includePrefix
			)
		);

		return $newid;
	}

	function parse($type) {
		global $manager, $CONF;

		$manager->notify('InitSkinParse',array('skin' => &$this, 'type' => $type));

		// set output type
		sendContentType($this->getContentType(), 'skin', _CHARSET);

		// set skin name as global var (so plugins can access it)
		global $currentSkinName;
		$currentSkinName = $this->getName();

		$contents = $this->getContent($type);

		if (!$contents) {
			// use base skin if this skin does not have contents
			$defskin =& new SKIN($CONF['BaseSkin']);
			$contents = $defskin->getContent($type);
			if (!$contents) {
				echo _ERROR_SKIN;
				return;
			}
		}

		$actions = $this->getAllowedActionsForType($type);

		$manager->notify('PreSkinParse',array('skin' => &$this, 'type' => $type, 'contents' => &$contents));

		// set IncludeMode properties of parser
		PARSER::setProperty('IncludeMode',$this->getIncludeMode());
		PARSER::setProperty('IncludePrefix',$this->getIncludePrefix());

		$handler =& new ACTIONS($type, $this);
		$parser =& new PARSER($actions, $handler);
		$handler->setParser($parser);
		$handler->setSkin($this);
		$parser->parse($contents);

		$manager->notify('PostSkinParse',array('skin' => &$this, 'type' => $type));


	}

	function getContent($type) {
		$query = 'SELECT scontent FROM '.sql_table('skin')." WHERE sdesc=$this->id and stype='". addslashes($type) ."'";
		$res = sql_query($query);

		if (mysql_num_rows($res) == 0)
			return '';
		else
			return mysql_result($res, 0, 0);
	}

	/**
	 * Updates the contents of one part of the skin
	 */
	function update($type, $content) {
		$skinid = $this->id;

		// delete old thingie
		sql_query('DELETE FROM '.sql_table('skin')." WHERE stype='".addslashes($type)."' and sdesc=" . intval($skinid));

		// write new thingie
		if ($content) {
			sql_query('INSERT INTO '.sql_table('skin')." SET scontent='" . addslashes($content) . "', stype='" . addslashes($type) . "', sdesc=" . intval($skinid));
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
			   . " sdname='" . addslashes($name) . "',"
			   . " sddesc='" . addslashes($desc) . "',"
			   . " sdtype='" . addslashes($type) . "',"
			   . " sdincmode='" . addslashes($includeMode) . "',"
			   . " sdincpref='" . addslashes($includePrefix) . "'"
			   . " WHERE sdnumber=" . $this->getID();
		sql_query($query);
	}

	/**
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
		while ($row = mysql_fetch_array($res)) {
			$skintypes[strtolower($row['stype'])] = ucfirst($row['stype']);
		}

		return $skintypes;
	}

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
								'bloglist'
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
								'categorylist',
								'blogsetting',
							   );
				break;
			case 'search':
				$extraActions = array('blog',
								'archivelist',
								'archivedaylist',
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
								'nucleusbutton'
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
								'itemtitle',
								'itemid',
								'itemlink',
								);
				break;
			case 'error':
				$extraActions = array(
								'errormessage'
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
						'nextlink',
						'archivelist',
						'archivedaylist',
						'prevlink',
						'membermailform',
						'nucleusbutton'
					);
				}
				break;
		}

		return array_merge($defaultActions, $extraActions);
	}

}

?>
