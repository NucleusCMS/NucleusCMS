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
	
	/* action class */
	private $action_class;
	private $event_identifier;
	
	/**
	 * Skin::__construct()
	 * Constructor for a new SKIN object
	 * 
	 * @param	integer	$id					id of the skin
	 * @param	string	$action_class		name of class extended from BaseActions
	 * @param	string	$event_identifier	event identifier. for example, InitAdminSkinParse if AdminSkin is used
	 * @return	void
	 */
	public function __construct($id, $action_class='Actions', $event_identifier='Skin')
	{
		global $DIR_LIBS;
		
		$this->id = (integer) $id;
		
		/*
		 * NOTE: include needed action class
		 */
		if ( $action_class != 'Actions' )
		{
			if ( !class_exists($action_class, FALSE)
			  && (!file_exists("{$DIR_LIBS}{$action_class}.php")
			   || !include("{$DIR_LIBS}{$action_class}.php")) )
			{
				return;
			}
		}
		else
		{
			if ( !class_exists('Actions', FALSE)
			  && (!file_exists("{$DIR_LIBS}ACTIONS.php")
			   || !include("{$DIR_LIBS}ACTIONS.php")) )
			{
				return;
			}
		}
		
		$this->action_class = $action_class;
		$this->event_identifier = $event_identifier;
		
		// read skin name/description/content type
		$query = "SELECT * FROM %s WHERE sdnumber=%d;";
		$query = sprintf($query, sql_table('skin_desc'), $this->id);
		$res = DB::getRow($query);
		
		$this->valid = !empty($res);
		if ( $this->valid )
		{
			$this->name = $res['sdname'];
			$this->description = $res['sddesc'];
			$this->contentType = $res['sdtype'];
			$this->includeMode = $res['sdincmode'];
			$this->includePrefix = $res['sdincpref'];
		}
		
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
		$query = "SELECT COUNT(*) AS result FROM %s WHERE sdname=%s;";
		$query = sprintf($query, sql_table('skin_desc'), DB::quoteValue($name));
		return (DB::getValue($query) > 0);
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
		return (DB::getValue($query) > 0);
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
		$query = "SELECT sdnumber FROM %s WHERE sdname=%s;";
		$query = sprintf($query, sql_table('skin_desc'), DB::quoteValue($name));
		return DB::getValue($query);
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
		return DB::getValue($query);
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
	public function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
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
		
		$query = "INSERT INTO %s (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES (%s, %s, %s, %s, %s);";
		$sdname		= DB::quoteValue($name);
		$sddesc		= DB::quoteValue($desc);
		$sdtype		= DB::quoteValue($type);
		$sdincmode	= DB::quoteValue($includeMode);
		$sdincpref	= DB::quoteValue($includePrefix);
		$query = sprintf($query, sql_table('skin_desc'), $sdname, $sddesc, $sdtype, $sdincmode, $sdincpref);
		DB::execute($query);
		$newid = DB::getInsertId();
		
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
	 * @param	string	$path	path to file if using fileparser
	 * @return	void
	 */
	public function parse($type, $path='')
	{
		global $currentSkinName, $manager, $CONF, $DIR_NUCLEUS;
		
		$manager->notify("Init{$this->event_identifier}Parse", array('skin' => &$this, 'type' => $type));
		
		// include skin locale file for <%text%> tag if useable
		$this->includeTranslation();
		
		// set output type
		sendContentType($this->getContentType(), 'skin');
		
		/* FIX: should be obsoleted */
		$currentSkinName = $this->getName();
		
		// retrieve contents
		$contents = FALSE;
		if ( $type != 'fileparse' )
		{
			$contents = $this->getContentFromDB($type);
		}
		else if ( $path !== ''  && i18n::strpos(realpath($path), realpath("$DIR_NUCLEUS/../")) == 0 )
		{
			$contents = $this->getContentFromFile($path);
		}
		// use base skin if this skin does not have contents
		if ( $contents === FALSE )
		{
			$defskin = new SKIN($CONF['BaseSkin']);
			$contents = $defskin->getContentFromDB($type);
			if ( !$contents )
			{
				echo _ERROR_SKIN;
				return;
			}
		}
		
		$manager->notify("Pre{$this->event_identifier}Parse", array('skin' => &$this, 'type' => $type, 'contents' => &$contents));
		
		// set IncludeMode properties of parser
		Parser::setProperty('IncludeMode', $this->getIncludeMode());
		Parser::setProperty('IncludePrefix', $this->getIncludePrefix());
		
		// call action handler
		$action_class = $this->action_class;
		$handler = new $action_class($type);
		
		// register action handler to parser
		$actions = $handler->getDefinedActions($type);
		$parser = new Parser($actions, $handler);
		
		$handler->setParser($parser);
		$handler->setSkin($this);
		$parser->parse($contents);
		
		$manager->notify("Post{$this->event_identifier}Parse", array('skin' => &$this, 'type' => $type));
		return;
	}
	
	/**
	 * Skin::getContentFromDB()
	 * 
	 * @param	string	$skintype	skin type
	 * @return	string	content for the skin type
	 */
	public function getContentFromDB($skintype)
	{
		$query = "SELECT scontent FROM %s WHERE sdesc=%d and stype=%s;";
		$query = sprintf($query, sql_table('skin'), (integer) $this->id, DB::quoteValue($skintype));
		$res = DB::getValue($query);
		
		return $res ? $res : '';
	}
	
	/**
	 * Skin::getContentFromFile()
	 * 
	 * @param	string	$fullpath	fullpath to the file to parse
	 * @return	mixed	file contents or FALSE
	 */
	public function getContentFromFile($fullpath)
	{
		$fsize = filesize($fullpath);
		if ( $fsize <= 0 )
		{
			return;
		}
		
		$fd = fopen ($fullpath, 'r');
		if ( $fd === FALSE )
		{
			return FALSE;
		}
		
		$contents = fread ($fd, $fsize);
		if ( $contents === FALSE )
		{
			return FALSE;
		}
		
		fclose ($fd);
		return $contents;
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
	public function update($type, $content)
	{
		global $manager;
		
		$query = "SELECT sdesc FROM %s WHERE stype=%s and sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), DB::quoteValue($type), (integer) $this->id);
		$res = DB::getValue($query);
		
		$skintypeexists = !empty($res);
		$skintypevalue = ($content == true);
		
		if( $skintypevalue && $skintypeexists )
		{
			$data = array(
				'skinid'	=>  $this->id,
				'type'		=>  $type,
				'content'	=> &$content
			);
			
			// PreUpdateSkinPart event
			$manager->notify("PreUpdate{{$this->event_identifier}}Part", $data);
		}
		else if( $skintypevalue && !$skintypeexists )
		{
			$data = array(
				'skinid' => $this->id,
				'type' => $type,
				'content' => &$content
			);
			
			$manager->notify("PreAdd{$this->event_identifier}Part", $data);
		}
		else if( !$skintypevalue && $skintypeexists )
		{
			$data = array(
				'skinid' => $this->id,
				'type' => $type
			);
			
			$manager->notify("PreDelete{$this->event_identifier}Part", $data);
		}
		
		// delete old thingie
		$query = "DELETE FROM %s WHERE stype=%s and sdesc=%d";
		$query = sprintf($query, sql_table('skin'), DB::quoteValue($type), (integer) $this->id);
		DB::execute($query);
		
		// write new thingie
		if ( $content )
		{
			$query = "INSERT INTO %s (scontent, stype, sdesc) VALUE (%s, %s, %d)";
			$query = sprintf($query, sql_table('skin'), DB::quoteValue($content), DB::quoteValue($type), (integer) $this->id);
			DB::execute($query);
		}
		
		if( $skintypevalue && $skintypeexists )
		{
			$data = array(
				'skinid'	=> $this->id,
				'type'		=> $type,
				'content'	=> &$content
			);
			
			// PostUpdateSkinPart event
			$manager->notify("PostUpdate{$this->event_identifier}Part", $data);
		}
		else if( $skintypevalue && (!$skintypeexists) )
		{
			$data = array(
				'skinid'	=> $this->id,
				'type'		=> $type,
				'content'	=> &$content
			);
			
			// PostAddSkinPart event
			$manager->notify("PostAdd{$this->event_identifier}Part", $data);
		}
		else if( (!$skintypevalue) && $skintypeexists )
		{
			$data = array(
				'skinid'	=> $this->id,
				'type'		=> $type
			);
			
			$manager->notify("PostDelete{$this->event_identifier}Part", $data);
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
	public function deleteAllParts()
	{
		$query = "DELETE FROM %s WHERE sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), (integer) $this->id);
		DB::execute($query);
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
	public function updateGeneralInfo($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
	{
		$name			= DB::quoteValue($name);
		$desc			= DB::quoteValue($desc);
		$type			= DB::quoteValue($type);
		$includeMode	= DB::quoteValue($includeMode);
		$includePrefix	= DB::quoteValue($includePrefix);
		
		$query ="UPDATE %s SET sdname=%s, sddesc=%s, sdtype=%s, sdincmode=%s, sdincpref=%s WHERE sdnumber=%d";
		$query = sprintf($query, sql_table('skin_desc'), $name, $desc, $type, $includeMode, $includePrefix, (integer) $this->id);
		
		DB::execute($query);
		return;
	}
	
	/**
	 * Skin::includeTranslation()
	 * 
	 * @param	void
	 * @return	void
	 */
	private function includeTranslation()
	{
		global $DIR_SKINS;
		
		$locale = i18n::get_current_locale() . '.' . i18n::get_current_charset();
		
		if( $this->includeMode == "normal" )
		{
			$filename = "./locales/{$locale}.php";
		}
		else if( $this->includeMode == "skindir" )
		{
			if ( $this->includePrefix == '' )
			{
				$filename = "{$DIR_SKINS}locales/{$locale}.php";
			}
			else
			{
				$filename = "{$DIR_SKINS}{$this->includePrefix}locales/{$locale}.php";
			}
		}
		else
		{
			return;
		}
		
		if ( !file_exists($filename) )
		{
			return;
		}
		
		include_once($filename);
		
		return;
	}
	
	/**
	 * Skin::getDefaultTypes()
	 * 
	 * @param	string	void
	 * @return	array	default skin types
	 */
	public function getDefaultTypes()
	{
		return call_user_func(array($this->action_class, 'getDefaultSkinTypes'));
	}
	
	/**
	 * Skin::getAvailableTypes()
	 * 
	 * @param	string	void
	 * @return	array	registered skin types
	 */
	public function getAvailableTypes()
	{
		$default_skintypes = $this->getDefaultTypes();
		$query = "SELECT stype FROM %s WHERE sdesc=%d;";
		$query = sprintf($query, sql_table('skin'), (integer) $this->id);
		
		/* NOTE: force to put default types in the beginning */
		$in_default = array();
		$no_default = array();
		
		$res = DB::getResult($query);
		foreach ( $res as $row )
		{
			if ( !array_key_exists($row['stype'], $default_skintypes) )
			{
				$no_default[$row['stype']] = FALSE;
			}
			else
			{
				$in_default[$row['stype']] = $default_skintypes[$row['stype']];
			}
		}
		
		return array_merge($in_default, $no_default);
	}
	
	/**
	 * Skin::getAllowedActionsForType()
	 * Get the allowed actions for a skin type
	 * returns an array with the allowed actions
	 * 
	 * @param	string	$type	type of the skin
	 * @return	array	allowed action types
	 */
	public function getAllowedActionsForType($type)
	{
		return call_user_func(array($this->action_class, 'getDefinedActions'), $type);
	}
	
}
