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
 * This class contains parse actions that are available in all ACTION classes
 * e.g. include, phpinclude, parsedinclude, skinfile, ...
 *
 * It should never be used on it's own
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class BaseActions
{
	/**
	 * BaseActions::$parser
	 * Skin class calls parser with action classes succeeded to this class
	 */
	protected $parser;
	
	
	// depth level for includes (max. level is 3)
	private $level;
	
	// array of evaluated conditions (true/false). The element at the end is the one for the most nested
	// if block.
	private $if_conditions;
	
	// in the "elseif" / "elseifnot" sequences, if one of the conditions become "true" remained conditions should not
	// be tested. this variable (actually a stack) holds this information.
	private $if_execute;
	
	// at all times, can be evaluated to either true if the current block needs to be displayed. This
	// variable is used to decide to skip skinvars in parts that will never be outputted.
	private $if_currentlevel;
	
	
	// contains a search string with keywords that need to be highlighted. These get parsed into $aHighlight
	protected $strHighlight;
	
	// array of keywords that need to be highlighted in search results (see the highlight()
	// and parseHighlight() methods)
	private $aHighlight;
	
	/**
	 * BaseActions::BaseActions()
	 *  Constructor for a new BaseAction object
	 */
	protected function initialize()
	{
		$this->level = 0;
		
		// if nesting level
		$this->if_conditions = array(); // array on which condition values are pushed/popped
		$this->if_execute = array(); 	// array on which condition values are pushed/popped
		$this->if_currentlevel = 1;		// 1 = current level is displayed; 0 = current level not displayed
		
		// highlights
		$this->strHighlight = '';			// full highlight
		$this->aHighlight = array();		// parsed highlight
		return;
	}
	
	/**
	 * BaseActions::parse_include()
	 * include file (no parsing of php)
	 * 
	 * ToDo: function returns nothing and refering to the cross reference it
	 *       isn't called from anywhere   
	 * 
	 * @param	string	$filename	filename to be included
	 * @return	void
	 */
	public function parse_include($filename)
	{
		@readfile($this->getIncludeFileName($filename));
		return;
	}
	
	/**
	 * BaseActions::parse_phpinclude()
	 * php-include file
	 * 
	 * @param	string	$filename	filename to be included
	 * @return	void
	 */
	public function parse_phpinclude($filename)
	{
		includephp($this->getIncludeFileName($filename));
		return;
	}
	
	
	/**
	 * BaseActions::parse_parsedinclude()
	 * parsed include
	 * 
	 * @param	string	$filename	filename to be included
	 * @return	void
	 */
	public function parse_parsedinclude($filename)
	{
		// check current level
		if ( $this->level > 3 )
		{
			// max. depth reached (avoid endless loop)
			return;
		}
		
		$file = $this->getIncludeFileName($filename);
		
		if ( !file_exists($file) )
		{
			return;
		}
		
		$contents = file_get_contents($file);
		
		if ( empty($contents) )
		{
			return;
		}
		
		$this->level = $this->level + 1;
		// parse file contents
		$this->parser->parse($contents);
		
		$this->level = $this->level - 1;
		return;
	}
	
	/**
	 * BaseActions::getIncludeFileName()
	 * Returns the correct location of the file to be included, according to
	 * parser properties
	 *
	 * IF IncludeMode = 'skindir' => use skindir
	 * 
	 * @param	string	$filename	name of file to be inclluded
	 * @return	string	name of file with relative path
	 */
	private function getIncludeFileName($filename)
	{
		// leave absolute filenames and http urls as they are
		if (
				(i18n::substr($filename,0,1) == '/')
			||	(i18n::substr($filename,0,7) == 'http://')
			||	(i18n::substr($filename,0,6) == 'ftp://')
			)
		{
			return $filename;
		}
		
		$filename = Parser::getProperty('IncludePrefix') . $filename;
		
		if ( Parser::getProperty('IncludeMode') == 'skindir' )
		{
			global $DIR_SKINS;
			return $DIR_SKINS . $filename;
		}
		return $filename;
	}
	
	/**
	 * BaseActions::parse_skinfile()
	 * Inserts an url relative to the skindir (useful when doing import/export)
	 *
	 * e.g. <skinfile(default/myfile.sth)>
	 * 
	 * @param	string	$filename	name of file to be inclluded
	 * @return	void
	 */
	public function parse_skinfile($filename)
	{
		global $CONF;
		echo $CONF['SkinsURL'] . Parser::getProperty('IncludePrefix') . $filename;
		return;
	}

	/**
	 * BaseActions::parse_set()
	 * Sets a property for the parser
	 * 
	 * @param	string	$property	name of property
	 * @param	string	$value		value of property
	 * @return	void
	 */
	public function parse_set($property, $value)
	{
		Parser::setProperty($property, $value);
		return;
	}
	
	/**
	 * BaseActions::addIfCondition()
	 * Helper function: add if condition
	 * 
	 * @param	string	$condition	condition for if context
	 * @return	void
	 */
	private function addIfCondition($condition)
	{
		array_push($this->if_conditions,$condition);
		$this->updateTopIfCondition();
		ob_start();
		return;
	}
	
	/**
	 * BaseActions::updateTopIfCondition()
	 * Helper function: update the Top of the If Conditions Array
	 * 
	 * @param	void
	 * @return	void
	 */
	private function updateTopIfCondition()
	{
		if ( sizeof($this->if_conditions) == 0 )
		{
			$this->if_currentlevel = 1;
		}
		else
		{
			$this->if_currentlevel = $this->if_conditions[sizeof($this->if_conditions) - 1];
		}
		return;
	}
	
	/**
	 * BaseActions::addIfExecute()
	 * Helper function for elseif / elseifnot
	 * 
	 * @param	void
	 * @return	void
	 */
	private function addIfExecute()
	{
		array_push($this->if_execute, 0);
		return;
	}
	
	/**
	 * BaseActions::updateIfExecute()
	 * Helper function for elseif / elseifnot
	 * 
	 * @param	string	$condition	condition to be fullfilled
	 * @return	void
	 */
	private function updateIfExecute($condition)
	{
		$index = sizeof($this->if_execute) - 1;
		$this->if_execute[$index] = $this->if_execute[$index] || $condition;
		return;
	}

	/**
	 * BaseActions::getTopIfCondition()()
	 * returns the currently top if condition
	 * 
	 * @param	void
	 * @return	string	level
	 */
	public function getTopIfCondition()
	{
		return $this->if_currentlevel;
	}
	
	/**
	 * BaseActions::setHighlight(()
	 * Sets the search terms to be highlighted
	 *
	 * @param	string	$highlight	A series of search terms
	 * @return	void
	 */
	public function setHighlight($highlight)
	{
		$this->strHighlight = $highlight;
		if ( $highlight )
		{
			$this->aHighlight = parseHighlight($highlight);
		}
		return;
	}
	
	/**
	 * BaseActions::highlight()
	 * Applies the highlight to the given piece of text
	 *
	 * @see setHighlight
	 * @param	string	$data		Data that needs to be highlighted
	 * @return	string	hilighted data
	 */
	public function highlight($data)
	{
		if ( $this->aHighlight )
		{
			$data = Entity::highlight($data, $this->aHighlight, $this->template['SEARCH_HIGHLIGHT']);
		}
		return $data;
	}
	
	/**
	 * BaseActions::parse_if()
	 * Parses <%if%> statements
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_if()
	{
		$this->addIfExecute();
		$args = func_get_args();
		$condition = call_user_func_array(array(&$this,'checkCondition'), $args);
		$this->addIfCondition($condition);
		return;
	}

	/**
	 * BaseActions::parse_else()
	 * Parses <%else%> statements
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_else()
	{
		if ( sizeof($this->if_conditions) == 0 )
		{
			return;
		}
		
		array_pop($this->if_conditions);
		
		if ( $this->if_currentlevel )
		{
			ob_end_flush();
			$this->updateIfExecute(1);
			$this->addIfCondition(0);
		}
		elseif ( $this->if_execute[sizeof($this->if_execute) - 1] )
		{
			ob_end_clean();
			$this->addIfCondition(0);
		}
		else
		{
			ob_end_clean();
			$this->addIfCondition(1);
		}
		return;
	}
	
	/**
	 * BaseActions::parse_elseif()
	 * Parses <%elseif%> statements
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_elseif()
	{
		if ( sizeof($this->if_conditions) == 0 )
		{
			return;
		}
		
		array_pop($this->if_conditions);
		
		if ( $this->if_currentlevel )
		{
			ob_end_flush();
			$this->updateIfExecute(1);
			$this->addIfCondition(0);
		}
		elseif ( $this->if_execute[sizeof($this->if_execute) - 1] )
		{
			ob_end_clean();
			$this->addIfCondition(0);
		}
		else
		{
			ob_end_clean();
			$args = func_get_args();
			$condition = call_user_func_array(array(&$this,'checkCondition'), $args);
			$this->addIfCondition($condition);
		}
		return;
	}
	
	/**
	 * BaseActions::parse_ifnot()
	 * Parses <%ifnot%> statements
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_ifnot()
	{
		$this->addIfExecute();
		
		$args = func_get_args();
		$condition = call_user_func_array(array(&$this,'checkCondition'), $args);
		$this->addIfCondition(!$condition);
		return;
	}
	
	/**
	 * BaseActions::parse_elseifnot()
	 * Parses <%elseifnot%> statements
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_elseifnot()
	{
		if ( sizeof($this->if_conditions) == 0 )
		{
			return;
		}
		
		array_pop($this->if_conditions);
		
		if ( $this->if_currentlevel )
		{
			ob_end_flush();
			$this->updateIfExecute(1);
			$this->addIfCondition(0);
		}
		elseif ( $this->if_execute[sizeof($this->if_execute) - 1] )
		{
			ob_end_clean();
			$this->addIfCondition(0);
		}
		else
		{
			ob_end_clean();
			$args = func_get_args();
			$condition = call_user_func_array(array(&$this,'checkCondition'), $args);
			$this->addIfCondition(!$condition);
		}
		return;
	}

	/**
	 * BaseActions::parse_endif()
	 * Ends a conditional if-block
	 * see e.g. ifcat (BLOG), ifblogsetting (PAGEFACTORY)
	 * 
	 * @param	void
	 * @return	void
	 */
	public function parse_endif()
	{
		// we can only close what has been opened
		if ( sizeof($this->if_conditions) == 0 )
		{
			return;
		}
		
		if ( $this->if_currentlevel )
		{
			ob_end_flush();
		}
		else
		{
			ob_end_clean();
		}
		
		array_pop($this->if_conditions);
		array_pop($this->if_execute);
		
		$this->updateTopIfCondition();
		return;
	}
}
