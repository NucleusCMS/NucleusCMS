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
 */

if ( !function_exists('requestVar') ) exit;
require_once dirname(__FILE__) . '/BaseActions.php';

/**
 * This is the parser class of Nucleus. It is used for various things (skin parsing,
 * form generation, ...)
 */
class PARSER {

	// array with the names of all allowed actions
	var $actions;

	// reference to actions handler
	var $handler;

	// delimiters that can be used for skin/templatevars
	var $delim;

	// parameter delimiter (to separate skinvar params)
	var $pdelim;

	// usually set to 0. When set to 1, all skinvars are allowed regardless of $actions
	var $norestrictions;

	/**
	 * Creates a new parser object with the given allowed actions
	 * and the given handler
	 *
	 * @param $allowedActions array
	 * @param $handler class object with functions for each action (reference)
	 * @param $delim optional delimiter
	 * @param $paramdelim optional parameterdelimiter
	 */
	function __construct($allowedActions, &$handler, $delim = '(<%|%>)', $pdelim = ',') {
		$this->actions = $allowedActions;
		$this->handler =& $handler;
		$this->delim = $delim;
		$this->pdelim = $pdelim;
		$this->norestrictions = 0;	// set this to 1 to disable checking for allowedActions
	}

	/**
	 * Parses the given contents and outputs it
	 */
	function parse(&$contents) {
		global $manager;
		if(strpos($contents,'<%')===false)
		{
			echo $contents;
			return;
		}
		$hashedTagBM = md5('<%BenchMark%>');
		if(strpos($contents,'<%BenchMark%>')!==false)
		{
			if(!$manager->pluginInstalled('NP_BenchMark'))
				$contents = str_replace('<%BenchMark%>', $hashedTagBM, $contents);
		}
		$hashedTagDI = md5('<%DebugInfo%>');
		if(strpos($contents,'<%DebugInfo%>')!==false)
		{
			if(!$manager->pluginInstalled('NP_DebugInfo'))
				$contents = str_replace('<%DebugInfo%>', $hashedTagDI, $contents);
		}
		
		$pieces = preg_split('/'.$this->delim.'/',$contents);

		$maxidx = sizeof($pieces);
		for ($idx = 0; $idx < $maxidx; $idx++) {
			echo $pieces[$idx];
			$idx++;
			if ($idx < $maxidx) {
				$this->doAction($pieces[$idx]);
			}
		}
	}


	/**
	  * handle an action
	  */
	function doAction($action) {
		global $manager, $CONF, $doActionStack, $doActionCount;

		if (!$action) return;
		$raw_action = $action;
		// split into action name + arguments
		if (strstr($action,'(')) {
			$paramStartPos = strpos($action, '(');
			$params = substr($action, $paramStartPos + 1, strlen($action) - $paramStartPos - 2);
			$action = substr($action, 0, $paramStartPos);
			$params = explode ($this->pdelim, $params);

			 foreach ($params as $key => $value) { $params[$key] = trim($value); }
		} else {
			// no parameters
			$params = array();
		}

		$actionlc = strtolower($action);

		// skip execution of skinvars while inside an if condition which hides this part of the page
		if (!$this->handler->if_currentlevel
			&& ($actionlc !== 'else')
			&& ($actionlc !== 'elseif')
			&& ($actionlc !== 'endif')
			&& ($actionlc !== 'ifnot')
			&& ($actionlc !== 'elseifnot')
			&& (substr($actionlc,0,2) !== 'if'))
			return;

		if (in_array($actionlc, $this->actions) || $this->norestrictions ) {
			// when using PHP versions lower than 4.0.5, uncomment the line before
			// and comment the call_user_func_array call
			//$this->call_using_array($action, $this->handler, $params);
			$bt = microtime(true);
			call_user_func_array(array($this->handler, 'parse_' . $actionlc), $params);
			$doActionCount++;
			$et = microtime(true);
			$diff = number_format($et - $bt, 20);
			$hscAction = hsc("<%{$raw_action}%>");
			$doActionStack[$doActionCount] = "[$doActionCount] {$diff}s - {$hscAction}";
		} else {
			// redirect to plugin action if possible
			if (in_array('plugin', $this->actions) && $manager->pluginInstalled("NP_{$action}")) {
				$this->doAction('plugin('.$action.$this->pdelim.implode($this->pdelim,$params).')');
			} else {
				if ($CONF['DebugVars']==true) {
					echo '&lt;%' , $action , '(', implode($this->pdelim, $params), ')%&gt;';
				}
			}

		}
	}

	/**
	  * Calls a method using an array of parameters (for use with PHP versions lower than 4.0.5)
	  * ( = call_user_func_array() function )
	  */
	function call_using_array($methodname, &$handler, $paramarray) {

		$methodname = 'parse_' . $methodname;

		if (!method_exists($handler, $methodname)) {
			return;
		}

		$command = 'call_user_func(array($handler,$methodname)';
		for ($i = 0; $i<count($paramarray); $i++)
			$command .= ',$paramarray[' . $i . ']';
		$command .= ');';
		eval($command);	// execute the correct method
	}

	public static function setProperty($property, $value) {
		global $manager;
		$manager->setParserProperty($property, $value);
	}

	public static function getProperty($name) {
		global $manager;
		return $manager->getParserProperty($name);
	}


}
