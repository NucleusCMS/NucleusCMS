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
 * @version $Id$
 */

if ( !function_exists('requestVar') )
{
	exit;
}
require_once dirname(__FILE__) . '/BaseActions.php';

/**
 * This is the parser class of Nucleus. It is used for various things
 * (skin parsing, form generation, ...)
 */
class Parser
{
	// array with the names of all allowed actions
	public $actions;
	
	// reference to actions handler
	public $handler;
	
	// reference to an instance of Skin class
	public $skin;
	
	// delimiters that can be used for skin/templatevars
	public $delim;
	
	// parameter delimiter (to separate skinvar params)
	public $pdelim;
	
	// usually set to 0. When set to 1, all skinvars are allowed regardless of $actions
	public $norestrictions;
	
	/**
	 * Parset::__construct()
	 * Creates a new parser object with the given allowed actions
	 * and the given handler
	 *
	 * @param $handler class object with functions for each action (reference)
	 * @param $delim optional delimiter
	 * @param $paramdelim optional parameterdelimiter
	 */
	public function __construct( &$handler, $delim = '(<%|%>)', $pdelim = ',')
	{
		$this->handler	= &$handler;
		$this->actions	=  $handler->getAvailableActions();
		$this->delim	=  $delim;
		$this->pdelim	=  $pdelim;
		$this->norestrictions = 0;	// set this to 1 to disable checking for allowedActions
		
		$handler->setParser($this);
		
		return;
	}
	
	/**
	 * Parses the given contents and outputs it
	 */
	public function parse(&$contents)
	{
		/* escaping only pcre delimiter */
		$pcre = preg_replace('#\##', '#', $this->delim);
		
		$pieces = preg_split("#{$pcre}#", $contents);
		
		$maxidx = sizeof($pieces);
		for ( $idx = 0; $idx < $maxidx; $idx++ )
		{
			echo $pieces[$idx];
			$idx++;
			if ( $idx < $maxidx )
			{
				$this->doAction($pieces[$idx]);
			}
		}
		return;
	}


	/**
	 * Parset::doAction()
	 * Called from the parser to handle an action
	 * 
	 * @param	string	$action	name of the action (e.g. blog, image ...)
	 * @return	void
	 */
	public function doAction($action)
	{
		global $manager, $CONF;

		if ( !$action )
		{
			return;
		}
		
		// split into action name + arguments
		if ( i18n::strpos($action, '(') != FALSE )
		{
			$paramStartPos	= i18n::strpos($action, '(');
			$params			= i18n::substr($action, $paramStartPos + 1, i18n::strlen($action) - $paramStartPos - 2);
			$action			= i18n::substr($action, 0, $paramStartPos);
			$params			= preg_split ('#' . preg_quote($this->pdelim, '#') . '#', $params);
			$params			= array_map('trim', $params);
		}
		else
		{
			// no parameters
			$params = array();
		}
		
		$actionlc = strtolower($action);
		
		// skip execution of skinvars while inside an if condition which hides this part of the page
		$if_tags = array('else', 'elseif', 'endif', 'ifnot', 'elseifnot');
		if ( !$this->handler->getTopIfCondition()
		  && !in_array($actionlc, $if_tags)
		  && (i18n::substr($actionlc, 0, 2) != 'if') )
		{
			return;
		}
		
		if ( in_array($actionlc, $this->actions) || $this->norestrictions )
		{
			call_user_func_array(array(&$this->handler, "parse_{$actionlc}"), $params);
		}
		else
		{
			// redirect to plugin action if possible
			if ( in_array('plugin', $this->actions) && $manager->pluginInstalled("NP_{$action}") )
			{
				$this->doAction('plugin(' . $action . $this->pdelim . implode($this->pdelim,$params) . ')');
			}
			else
			{
				if ( $CONF['DebugVars']==true )
				{
					echo '&lt;%' , $action , '(', implode($this->pdelim, $params), ')%&gt;';
				}
			}
		}
		return;
	}
	
	/**
	 * Parser::setSkin()
	 * Set the skin
	 * @param	object	$skin	an instance of Skin class
	 * @return	void
	 */
	public function setSkin(&$skin)
	{
		$this->skin = &$skin;
		return;
	}
	
	/**
	 * Parser::setProperty()
	 * Set a property of the parser in the manager
	 * 
	 * @static
	 * @param	string	$property	additional parser property (e.g. include prefix of the skin)
	 * @param	string	$value		new value
	 * @return	void
	 */
	static public function setProperty($property, $value)
	{
		global $manager;
		$manager->setParserProperty($property, $value);
		return;
	}

	/**
	 * Parser::getProperty()
	 * Get a property of the parser from the manager
	 * 
	 * @static
	 * @param	string	$name	name of the property
	 * @return	string	value of the property
	 */
	static public function getProperty($name)
	{
		global $manager;
		return $manager->getParserProperty($name);
	}
}
