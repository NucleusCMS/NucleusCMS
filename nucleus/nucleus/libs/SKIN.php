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

if ( !function_exists('requestVar') ) 
{
	exit;
}
require_once dirname(__FILE__) . '/ACTIONS.php';

class Skin
{
	// after creating a SKIN object, evaluates to true when the skin exists
	private $valid;
	
	// skin characteristics. Use the getXXX methods rather than accessing directly
	private $id;
	private $description;
	private $contentType;
	private $includeMode;		// either 'normal' or 'skindir'
	private $includePrefix;
	private $name;
	
	/**
	 * Skin::__construct()
	 * Constructor for a new SKIN object
	 * 
	 * @param	integer	$id	id of the skin
	 * @return	void
	 */
	public function __construct($id)
	{
		$this->id = (integer) $id;
		
		// read skin name/description/content type
		$query = "SELECT * FROM %s WHERE sdnumber=%d";
		$query = sprintf($query, sql_table('skin_desc'), (integer) $this->id);
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		$this->valid = (sql_num_rows($res) > 0);
		if ( !$this->valid )
		{
			return;
		}
		
		$this->name = $obj->sdname;
		$this->description = $obj->sddesc;
		$this->contentType = $obj->sdtype;
		$this->includeMode = $obj->sdincmode;
		$this->includePrefix = $obj->sdincpref;
		return;
	}
	
	/**
	 * Skin::getID()
	 * Get SKIN id
	 * 
	 * @param	void
	 * @return	integer	id for this skin instance
	 */
	public function getID()
	{
		return (integer) $this->id;
	}
	
	/**
	 * Skin::isValid()
	 * 
	 * @param	void
	 * @return	boolean
	 */
	public function isValid()
	{
		return (boolean) $this->valid;
	}
	
	/**
	 * Skin::getName()
	 * Get SKIN name
	 * 
	 * @param	void
	 * @return	string	name of this skin instance
	 */
	public function getName()
	{
		return (string) $this->name;
	}
	
	/**
	 * Skin::getDescription()
	 * Get SKIN description
	 * 
	 * @param	void
	 * @return	string	description of this skin instance
	 */
	public function getDescription()
	{
		return (string) $this->description;
	}
	
	/**
	 * Skin::getContentType()
	 * Get SKIN content type
	 * e.g. text/xml, text/html, application/atom+xml
	 * 
	 * @param	void
	 * @return	string	name of this skin instance
	 */
	public function getContentType()
	{
		return (string) $this->contentType;
	}
	
	/**
	 * Skin::getIncludeMode()
	 * Get include mode of the SKIN
	 * 
	 * Returns either 'normal' or 'skindir':
	 * 'normal': if a all data of the skin can be found in the databse
	 * 'skindir': if the skin has data in the it's skin driectory
	 * 
	 * @param	void
	 * @return	string	normal/skindir
	 */
	public function getIncludeMode()
	{
		return (string) $this->includeMode;
	}
	
	/**
	 * Skin::getIncludePrefix()
	 * Get include prefix of the SKIN
	 * 
	 * Get name of the subdirectory (with trailing slash) where
	 * the files of the current skin can be found (e.g. 'default/')
	 * 
	 * @param	void
	 * @return	string	include prefix of this skin instance
	 */
	public function getIncludePrefix()
	{
		return (string) $this->includePrefix;
	}
	
	/**
	 * Skin::exists()
	 * Checks if a skin with a given shortname exists
	 * 
	 * @static
	 * @param	string	$name	Skin short name
	 * @return	integer	number of skins with the given ID
	 */
	static public function exists($name)
	{
		$query = "SELECT COUNT (*) AS result FROM %s WHERE sdname='%s';";
		$query = sprintf($query, sql_table('skin_desc'), sql_real_escape_string($name));
		return quickQuery($query) > 0;
	}
	
	/**
	 * Skin::existsID()
	 * Checks if a skin with a given ID exists
	 * 
	 * @static
	 * @param	string	$id	Skin ID
	 * @return	integer	number of skins with the given ID
	 */
	static public function existsID($id)
	{
		$query = "SELECT COUNT(*) AS result FROM %s WHERE sdnumber=%d;";
		$query = sprintf($query, sql_table('skin_desc'), (integer) $id);
		return quickQuery($query) > 0;
	}
	
	/**
	 * Skin::createFromName()
	 * Returns a skin given its shortname
	 * 
	 * @static
	 * @param	string	$name	Skin shortname
	 * @return	object instance of Skin class
	 */
	static public function createFromName($name)
	{
		return new SKIN(SKIN::getIdFromName($name));
	}
	
	/**
	 * Skin::getIdFromName()
	 * Returns a skin ID given its shortname
	 * 
	 * @static
	 * @param	string	$name	Skin shortname
	 * @return	integer	Skin ID
	 */
	static public function getIdFromName($name)
	{
		$query = "SELECT sdnumber FROM %s WHERE sdname='%s';";
		$query = sprintf($query, sql_table('skin_desc'), sql_real_escape_string($name));
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return $obj->sdnumber;
	}
	
	/**
	 * Skin::getNameFromId()
	 * Returns a skin shortname given its ID
	 * 
	 * @static
	 * @param	string	$name
	 * @return	string	Skin short name
	 */
	static public function getNameFromId($id)
	{
		$query = "SELECT sdname AS result FROM %s WHERE sdnumber=%d;";
		$query = sprintf($query, sql_table('skin_desc'), (integer) $id);
		return quickQuery($query);
	}
	
	/**
	 * SKIN::createNew()
	 * Creates a new skin, with the given characteristics.
	 *
	 * @static
	 * @param	String	$name	value for nucleus_skin.sdname
	 * @param	String	$desc	value for nucleus_skin.sddesc
	 * @param	String	$type	value for nucleus_skin.sdtype
	 * @param	String	$includeMode	value for nucleus_skin.sdinclude
	 * @param	String	$includePrefix	value for nucleus_skin.sdincpref
	 * @return	Integer	ID for just inserted record
	 */
	function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
	{
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
		
		$query = "INSERT INTO %s (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('%s', '%s', '%s', '%s', '%s');";
		$sdname		= sql_real_escape_string($name);
		$sddesc		= sql_real_escape_string($desc);
		$sdtype		= sql_real_escape_string($type);
		$sdincmode	= sql_real_escape_string($includeMode);
		$sdincpref	= sql_real_escape_string($includePrefix);
		$query = sprintf($query, sql_table('skin_desc'), $sdname, $sddesc, $sdtype, $sdincmode, $sdincpref);
		sql_query($query);
		$newid = sql_insert_id();
		
		$manager->notify(
			'PostAddSkin',
			array(
				'skinid'		=> $newid,
				'name'			=> $name,
				'description'	=> $desc,
				'type'			=> $type,
				'includeMode'	=> $includeMode,
				'includePrefix'	=> $includePrefix
			)
		);
		return $newid;
	}
	
	/**
	 * Skin::parse()
	 * Parse a SKIN
	 * 
	 * @param	string	$type
	 * @return	void
	 */
	public function parse($type)
	{
		global $currentSkinName, $manager, $CONF;
		
		$manager->notify('InitSkinParse',array('skin' => &$this, 'type' => $type));
		
		// set output type
		sendContentType($this->getContentType(), 'skin');
		
		// set skin name as global var (so plugins can access it)
		$currentSkinName = $this->getName();
		$contents = $this->getContent($type);
		
		if ( !$contents )
		{
			// use base skin if this skin does not have contents
			$defskin = new SKIN($CONF['BaseSkin']);
			$contents = $defskin->getContent($type);
			if ( !$contents )
			{
				echo _ERROR_SKIN;
				return;
			}
		}
		
		$actions = $this->getAllowedActionsForType($type);
		
		$manager->notify('PreSkinParse',array('skin' => &$this, 'type' => $type, 'contents' => &$contents));
		
		// set IncludeMode properties of parser
		Parser::setProperty('IncludeMode', $this->getIncludeMode());
		Parser::setProperty('IncludePrefix', $this->getIncludePrefix());
		
		$handler = new Actions($type, $this);
		$parser = new Parser($actions, $handler);
		$handler->setParser($parser);
		$handler->setSkin($this);
		$parser->parse($contents);
		
		$manager->notify('PostSkinParse',array('skin' => &$this, 'type' => $type));
		return;
	}
	
	/**
	 * Skin::getContent()
	 * Get content of the skin part from the database
	 * 
	 * @param	string	$type	type of the skin (e.g. index, item, search ...)
	 * @return	string	content of scontent
	 */
	function getContent($type)
	{
		$query = "SELECT scontent FROM %s WHERE sdesc=%d and stype='%s';";
		$query = sprintf($query, sql_table('skin'), (integer) $this->id, sql_real_escape_string($type));
		$res = sql_query($query);
		
		if ( sql_num_rows($res) == 0 )
		{
			return '';
		}
		return sql_result($res, 0, 0);
	}

	/**
	 * SKIN::update()
	 * Updates the contents for one part of the skin in the database
	 * 
	 * @param	string	$type type of the skin part (e.g. index, item, search ...) 
	 * @param	string	$content new content for this skin part
	 * @return	void
	 * 
	 */
	function update($type, $content)
	{
		global $manager;
		
		$query = "SELECT sdesc FROM %s WHERE stype='%s' and sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), sql_real_escape_string($type), (integer) $this->id);
		$res = sql_query($query);
		
		$skintypeexists = sql_fetch_object($res);
		$skintypevalue = ($content == true);
		
		if( $skintypevalue && $skintypeexists )
		{
			// PreUpdateSkinPart event
			$manager->notify(
				'PreUpdateSkinPart',
				array(
					'skinid' => $this->id,
					'type' => $type,
					'content' => &$content
				)
			);
		}
		else if( $skintypevalue && !$skintypeexists )
		{
			// PreAddSkinPart event
			$manager->notify(
				'PreAddSkinPart',
				array(
					'skinid' => $this->id,
					'type' => $type,
					'content' => &$content
				)
			);
		}
		else if( !$skintypevalue && $skintypeexists )
		{
			// PreDeleteSkinPart event
			$manager->notify(
				'PreDeleteSkinPart',
				array(
					'skinid' => $this->id,
					'type' => $type
				)
			);
		}
		
		// delete old thingie
		$query = "DELETE FROM %s WHERE stype='%s' and sdesc=%d";
		$query = sprintf($query, sql_table('skin'), sql_real_escape_string($type), (integer) $this->id);
		sql_query($query);
		
		// write new thingie
		if ( $content )
		{
			$query = "INSERT INTO %s (scontent, stype, sdesc) VALUE ('%s', '%s', %d)";
			$query = sprintf($query, sql_table('skin'), sql_real_escape_string($content), sql_real_escape_string($type), (integer) $this->id);
			sql_query($query);
		}
		
		if( $skintypevalue && $skintypeexists )
		{
			// PostUpdateSkinPart event
			$manager->notify(
			'PostUpdateSkinPart',
				array(
					'skinid'	=> $this->id,
					'type'		=> $type,
					'content'	=> &$content
				)
			);
		}
		else if( $skintypevalue && (!$skintypeexists) )
		{
			// PostAddSkinPart event
			$manager->notify(
				'PostAddSkinPart',
				array(
					'skinid'	=> $this->id,
					'type'		=> $type,
					'content'	=> &$content
				)
			);
		}
		else if( (!$skintypevalue) && $skintypeexists )
		{
			// PostDeleteSkinPart event
			$manager->notify(
				'PostDeleteSkinPart',
				array(
					'skinid'	=> $this->id,
					'type'		=> $type
				)
			);
		}
		return;
	}
	
	/**
	 * Skin::deleteAllParts()
	 * Deletes all skin parts from the database
	 * 
	 * @param	void
	 * @return	void
	 */
	function deleteAllParts()
	{
		$query = "DELETE FROM %s WHERE sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), (integer) $this->id);
		sql_query($query);
	}
	
	/**
	 * Skin::updateGeneralInfo()
	 * Updates the general information about the skin
	 * 
	 * @param	string	$name			name of the skin
	 * @param	string	$desc			description of the skin
	 * @param	string	$type			type of the skin
	 * @param	string	$includeMode	include mode of the skin
	 * @param	string	$includePrefix	include prefix of the skin
	 * @return	void
	 */
	function updateGeneralInfo($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
	{
		$name			= sql_real_escape_string($name);
		$desc			= sql_real_escape_string($desc);
		$type			= sql_real_escape_string($type);
		$includeMode	= sql_real_escape_string($includeMode);
		$includePrefix	= sql_real_escape_string($includePrefix);
		
		$query ="UPDATE %s SET sdname='', sddesc='%s', sdtype='%s', sdincmode='%s', sdincpref='%s' WHERE sdnumber=%d:";
		$query = sprintf($query, $name, $desc, $type, $includeMode, $includePrefix, (integer) $this->id);
		
		sql_query($query);
		return;
	}
	
	/**
	 * Skin::getFriendlyNames()
	 * Get an array with the names of possible skin parts
	 * Used to show all possible parts of a skin in the administration backend
	 * 
	 * @param	void
	 * @param	array	type of the skin
	 */
	static public function getFriendlyNames()
	{
		$skintypes = array(
			'index'			=> _SKIN_PART_MAIN,
			'item'			=> _SKIN_PART_ITEM,
			'archivelist'	=> _SKIN_PART_ALIST,
			'archive'		=> _SKIN_PART_ARCHIVE,
			'search'		=> _SKIN_PART_SEARCH,
			'error'			=> _SKIN_PART_ERROR,
			'member'		=> _SKIN_PART_MEMBER,
			'imagepopup'	=> _SKIN_PART_POPUP
		);
		
		$query = "SELECT stype FROM " . sql_table('skin')
		       . " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
		$res = sql_query($query);
		while ( $row = sql_fetch_array($res) )
		{
			/* TODO: ucfirst() depends on the current locale  */
			$skintypes[strtolower($row['stype'])] = ucfirst($row['stype']);
		}
		return $skintypes;
	}
	
	/**
	 * Skin::getAllowedActionsForType()
	 * Get the allowed actions for a skin type
	 * returns an array with the allowed actions
	 * 
	 * @param	string	$type	type of the skin (e.g. index, item, search ...)
	 * @return	array	allowed action types
	 */
	function getAllowedActionsForType($type)
	{
		global $blogid;
		
		// some actions that can be performed at any time, from anywhere
		$defaultActions = array(
			'otherblog',
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
			'sticky',
			// deprecated (Nucleus v2.0)
			/* TODO: remove this */
			'ifcat'
		);
		
		// extra actions specific for a certain skin type
		$extraActions = array();
		
		switch ( $type )
		{
			case 'index':
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
					'prevlink'
				);
				break;
			case 'archive':
				$extraActions = array(
					'blog',
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
				$extraActions = array(
					'blog',
					'archivelist',
					'archivedaylist',
					'archiveyearlist',
					'categorylist',
					'blogsetting'
				);
				break;
			case 'search':
				$extraActions = array(
					'blog',
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
				$extraActions = array(
					'image',
					// deprecated (Nucleus v2.0)
					/* TODO: remove this */
					'imagetext'
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
				$extraActions = array(
					'blog',
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
					'itemlink'
				);
				break;
			case 'error':
				$extraActions = array(
					'errormessage',
					'categorylist'
				);
				break;
			default:
				if ( $blogid && $blogid > 0 )
				{
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
