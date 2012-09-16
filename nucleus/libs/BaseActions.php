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

class BaseActions {

	// depth level for includes (max. level is 3)
	var $level;

	// array of evaluated conditions (true/false). The element at the end is the one for the most nested
	// if block.
	var $if_conditions;

	// in the "elseif" / "elseifnot" sequences, if one of the conditions become "true" remained conditions should not
	// be tested. this variable (actually a stack) holds this information.
	var $if_execute;

	// at all times, can be evaluated to either true if the current block needs to be displayed. This
	// variable is used to decide to skip skinvars in parts that will never be outputted.
	var $if_currentlevel;

	// contains a search string with keywords that need to be highlighted. These get parsed into $aHighlight
	var $strHighlight;

	// array of keywords that need to be highlighted in search results (see the highlight()
	// and parseHighlight() methods)
	var $aHighlight;

	// reference to the parser object that is using this object as actions-handler
	var $parser;

	/**
	 *  Constructor for a new BaseAction object
	 */
	function BaseActions() {
		$this->level = 0;

		// if nesting level
		$this->if_conditions = array(); // array on which condition values are pushed/popped
		$this->if_execute = array(); 	// array on which condition values are pushed/popped
		$this->if_currentlevel = 1;		// 1 = current level is displayed; 0 = current level not displayed

		// highlights
		$this->strHighlight = '';			// full highlight
		$this->aHighlight = array();		// parsed highlight

	}

	/**
	 * include file (no parsing of php)
	 * 
	 * ToDo: function returns nothing and refering to the cross reference it
	 *       isn't called from anywhere   
	 * 
	 * @param $filename
	 */
	function parse_include($filename) {
		@readfile($this->getIncludeFileName($filename));
	}

	/**
	 * php-include file
	 * 
	 * @param $filename
	 */
	function parse_phpinclude($filename) {
		includephp($this->getIncludeFileName($filename));
	}

	
	/**
	 * parsed include
	 * 
	 * @param $filename
	 */
	function parse_parsedinclude($filename) {
		// check current level
		if ($this->level > 3) return;	// max. depth reached (avoid endless loop)
		$file = $this->getIncludeFileName($filename);
		if (!file_exists($file)) return;
        $contents = file_get_contents($file);
        if (empty($contents)) return;
		
		$this->level = $this->level + 1;
		// parse file contents
		$this->parser->parse($contents);

		$this->level = $this->level - 1;
	}

	/**
	 * Returns the correct location of the file to be included, according to
	 * parser properties
	 *
	 * IF IncludeMode = 'skindir' => use skindir
	 * 
	 * @param $filename
	 */
	function getIncludeFileName($filename) {
		// leave absolute filenames and http urls as they are
		if (
				(substr($filename,0,1) == '/')
			||	(substr($filename,0,7) == 'http://')
			||	(substr($filename,0,6) == 'ftp://')
			)
			return $filename;

		$filename = PARSER::getProperty('IncludePrefix') . $filename;
		if (PARSER::getProperty('IncludeMode') == 'skindir') {
			global $DIR_SKINS;
			return $DIR_SKINS . $filename;
		} else {
			return $filename;
		}
	}

	/**
	 * Inserts an url relative to the skindir (useful when doing import/export)
	 *
	 * e.g. <skinfile(default/myfile.sth)>
	 */
	function parse_skinfile($filename) {
		global $CONF;

		echo $CONF['SkinsURL'] . PARSER::getProperty('IncludePrefix') . $filename;
	}

	/**
	 * Sets a property for the parser
	 */
	function parse_set($property, $value) {
		PARSER::setProperty($property, $value);
	}

	/**
	 * Helper function: add if condition
	 */
	function _addIfCondition($condition) {

		array_push($this->if_conditions,$condition);

		$this->_updateTopIfCondition();

		ob_start();
	}

	/**
	 * Helper function: update the Top of the If Conditions Array
	 */
	function _updateTopIfCondition() {
		if (sizeof($this->if_conditions) == 0) {
			$this->if_currentlevel = 1;
		}
		else {
			$this->if_currentlevel = $this->if_conditions[sizeof($this->if_conditions) - 1];
		}
	}

	/**
	 * Helper function for elseif / elseifnot
	 */
	function _addIfExecute() {
		array_push($this->if_execute, 0);
	}

	/**
	 * Helper function for elseif / elseifnot
	 * @param string condition to be fullfilled
	 */
	function _updateIfExecute($condition) {
		$index = sizeof($this->if_execute) - 1;
		$this->if_execute[$index] = $this->if_execute[$index] || $condition;
	}

	/**
	 * returns the currently top if condition
	 */
	function _getTopIfCondition() {
		return $this->if_currentlevel;
	}

	/**
	 * Sets the search terms to be highlighted
	 *
	 * @param $highlight
	 *		A series of search terms
	 */
	function setHighlight($highlight) {
		$this->strHighlight = $highlight;
		if ($highlight) {
			$this->aHighlight = parseHighlight($highlight);
		}
	}

	/**
	 * Applies the highlight to the given piece of text
	 *
	 * @param &$data
	 *		Data that needs to be highlighted
	 * @see setHighlight
	 */
	function highlight(&$data) {
		if ($this->aHighlight)
			return highlight($data,$this->aHighlight,$this->template['SEARCH_HIGHLIGHT']);
		else
			return $data;
	}

	/**
	 * Parses <%if%> statements
	 */
	function parse_if() {
		$this->_addIfExecute();

		$args = func_get_args();
		$condition = call_user_func_array(array($this, 'checkCondition'), $args);
		$this->_addIfCondition($condition);
	}

	/**
	 * Parses <%else%> statements
	 */
	function parse_else() {
		if (sizeof($this->if_conditions) == 0) return;
		array_pop($this->if_conditions);
		if ($this->if_currentlevel) {
			ob_end_flush();
			$this->_updateIfExecute(1);
			$this->_addIfCondition(0);
		} elseif ($this->if_execute[sizeof($this->if_execute) - 1]) {
			ob_end_clean();
			$this->_addIfCondition(0);
		} else {
			ob_end_clean();
			$this->_addIfCondition(1);
		}
	}

	/**
	 * Parses <%elseif%> statements
	 */
	function parse_elseif() {
		if (sizeof($this->if_conditions) == 0) return;
		array_pop($this->if_conditions);
		if ($this->if_currentlevel) {
			ob_end_flush();
			$this->_updateIfExecute(1);
			$this->_addIfCondition(0);
		} elseif ($this->if_execute[sizeof($this->if_execute) - 1]) {
			ob_end_clean();
			$this->_addIfCondition(0);
		} else {
			ob_end_clean();
			$args = func_get_args();
			$condition = call_user_func_array(array($this, 'checkCondition'), $args);
			$this->_addIfCondition($condition);
		}
	}

	/**
	 * Parses <%ifnot%> statements
	 */
	function parse_ifnot() {
		$this->_addIfExecute();

		$args = func_get_args();
		$condition = call_user_func_array(array($this, 'checkCondition'), $args);
		$this->_addIfCondition(!$condition);
	}

	/**
	 * Parses <%elseifnot%> statements
	 */
	function parse_elseifnot() {
		if (sizeof($this->if_conditions) == 0) return;
		array_pop($this->if_conditions);
		if ($this->if_currentlevel) {
			ob_end_flush();
			$this->_updateIfExecute(1);
			$this->_addIfCondition(0);
		} elseif ($this->if_execute[sizeof($this->if_execute) - 1]) {
			ob_end_clean();
			$this->_addIfCondition(0);
		} else {
			ob_end_clean();
			$args = func_get_args();
			$condition = call_user_func_array(array($this, 'checkCondition'), $args);
			$this->_addIfCondition(!$condition);
		}
	}

	/**
	 * Ends a conditional if-block
	 * see e.g. ifcat (BLOG), ifblogsetting (PAGEFACTORY)
	 */
	function parse_endif() {
		// we can only close what has been opened
		if (sizeof($this->if_conditions) == 0) return;

		if ($this->if_currentlevel) {
			ob_end_flush();
		} else {
			ob_end_clean();
		}
		array_pop($this->if_conditions);
		array_pop($this->if_execute);

		$this->_updateTopIfCondition();
	}
}
?>
