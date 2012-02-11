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
 * This is an (abstract) class of which all Nucleus Plugins must inherit
 *
 * for more information on plugins and how to write your own, see the
 * plugins.html file that is included with the Nucleus documenation
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
abstract class NucleusPlugin
{
	// these final public functions _have_ to be redefined in your plugin
	public function getName()
	{
		return __CLASS__;
	}
	
	public function getAuthor()
	{
		return 'Undefined';
	}
	
	public function getURL()
	{
		return 'Undefined';
	}
	
	public function getVersion()
	{
		return '0.0';
	}
	
	public function getDescription()
	{
		return 'Undefined';
	}
	
	// these final public function _may_ be redefined in your plugin
	
	public function getMinNucleusVersion()
	{
		return 150;
	}
	
	public function getMinNucleusPatchLevel()
	{
		return 0;
	}
	
	public function getEventList()
	{
		return array();
	}
	
	public function getTableList()
	{
		return array();
	}
	
	public function hasAdminArea()
	{
		return 0;
	}
	
	public function install()
	{
		return;
	}
	
	public function unInstall()
	{
		return;
	}
	
	public function init()
	{
		return;
	}
	
	public function doSkinVar($skinType)
	{
		return;
	}
	
	public function doTemplateVar(&$item)
	{
		$args = func_get_args();
		array_shift($args);
		array_unshift($args, 'template');
		call_user_func_array(array(&$this,'doSkinVar'),$args);
		return;
	}
	
	public function doTemplateCommentsVar(&$item, &$comment)
	{
		$args = func_get_args();
		array_shift($args);
		array_shift($args);
		array_unshift($args, 'template');
		call_user_func_array(array(&$this,'doSkinVar'),$args);
		return;
	}
	
	public function doAction($type)
	{
		return _ERROR_PLUGIN_NOSUCHACTION;
	}
	
	public function doIf($key,$value)
	{
		return false;
	}
	
	public function doItemVar (&$item)
	{
		return;
	}
	
	/**
	 * Checks if a plugin supports a certain feature.
	 *
	 * @returns 1 if the feature is reported, 0 if not
	 * @param $feature
	 *  Name of the feature. See plugin documentation for more info
	 *   'SqlTablePrefix' -> if the plugin uses the sql_table() method to get table names
	 *   'HelpPage' -> if the plugin provides a helppage
	 *   'SqlApi' -> if the plugin uses the complete sql_* api (must also require nucleuscms 3.5)
	 */
	public function supportsFeature($feature)
	{
		return 0;
	}
	
	/**
	 * Report a list of plugin that is required to final public function
	 *
	 * @returns an array of names of plugin, an empty array indicates no dependency
	 */
	public function getPluginDep()
	{
		return array();
	}
	
	// these helper final public functions should not be redefined in your plugin
	
	/**
	 * Creates a new option for this plugin
	 *
	 * @param name
	 *		A string uniquely identifying your option. (max. length is 20 characters)
	 * @param description
	 *		A description that will show up in the nucleus admin area (max. length: 255 characters)
	 * @param type
	 *		Either 'text', 'yesno' or 'password'
	 *		This info is used when showing 'edit plugin options' screens
	 * @param value
	 *		Initial value for the option (max. value length is 128 characters)
	 */
	final public function createOption($name, $desc, $type, $defValue = '', $typeExtras = '')
	{
		return $this->create_option('global', $name, $desc, $type, $defValue, $typeExtras);
	}
	
	final public function createBlogOption($name, $desc, $type, $defValue = '', $typeExtras = '')
	{
		return $this->create_option('blog', $name, $desc, $type, $defValue, $typeExtras);
	}
	
	final public function createMemberOption($name, $desc, $type, $defValue = '', $typeExtras = '')
	{
		return $this->create_option('member', $name, $desc, $type, $defValue, $typeExtras);
	}
	
	final public function createCategoryOption($name, $desc, $type, $defValue = '', $typeExtras = '')
	{
		return $this->create_option('category', $name, $desc, $type, $defValue, $typeExtras);
	}
	
	final public function createItemOption($name, $desc, $type, $defValue = '', $typeExtras = '')
	{
		return $this->create_option('item', $name, $desc, $type, $defValue, $typeExtras);
	}
	
	/**
	 * Removes the option from the database
	 *
	 * Note: Options get erased automatically on plugin uninstall
	 */
	final public function deleteOption($name)
	{
		return $this->delete_option('global', $name);
	}
	
	final public function deleteBlogOption($name)
	{
		return $this->delete_option('blog', $name);
	}
	
	final public function deleteMemberOption($name)
	{
		return $this->delete_option('member', $name);
	}
	
	final public function deleteCategoryOption($name)
	{
		return $this->delete_option('category', $name);
	}
	
	final public function deleteItemOption($name)
	{
		return $this->delete_option('item', $name);
	}
	
	/**
	 * Sets the value of an option to something new
	 */
	final public function setOption($name, $value)
	{
		return $this->set_option('global', 0, $name, $value);
	}
	
	final public function setBlogOption($blogid, $name, $value)
	{
		return $this->set_option('blog', $blogid, $name, $value);
	}
	
	final public function setMemberOption($memberid, $name, $value)
	{
		return $this->set_option('member', $memberid, $name, $value);
	}
	
	final public function setCategoryOption($catid, $name, $value)
	{
		return $this->set_option('category', $catid, $name, $value);
	}
	
	final public function setItemOption($itemid, $name, $value) {
		return $this->set_option('item', $itemid, $name, $value);
	}
	
	/**
	 * Retrieves the current value for an option
	 */
	final public function getOption($name)
	{
		// only request the options the very first time. On subsequent requests
		// the static collection is used to save SQL queries.
		if ( $this->plugin_options == 0 )
		{
			$this->plugin_options = array();
			
			$query =  "SELECT d.oname as name, o.ovalue as value FROM %s o, %s d WHERE d.opid=%d AND d.oid=o.oid;";
			$query = sprintf($query, sql_table('plugin_option'), sql_table('plugin_option_desc'), (integer) $this->plugid);
			$result = sql_query($query);
			while ( $row = sql_fetch_object($result) )
			{
				$this->plugin_options[strtolower($row->name)] = $row->value;
			}
		}
		if ( isset($this->plugin_options[strtolower($name)]) )
		{
			return $this->plugin_options[strtolower($name)];
		}
		else
		{
			return $this->get_option('global', 0, $name);
		}
	}
	
	final public function getBlogOption($blogid, $name)
	{
		return $this->get_option('blog', $blogid, $name);
	}
	
	final public function getMemberOption($memberid, $name)
	{
		return $this->get_option('member', $memberid, $name);
	}
	
	final public function getCategoryOption($catid, $name)
	{
		return $this->get_option('category', $catid, $name);
	}
	
	final public function getItemOption($itemid, $name)
	{
		return $this->get_option('item', $itemid, $name);
	}
	
	/**
	 * Retrieves an associative array with the option value for each
	 * context id
	 */
	final public function getAllBlogOptions($name)
	{
		return $this->get_all_options('blog', $name);
	}
	
	final public function getAllMemberOptions($name)
	{
		return $this->get_all_options('member', $name);
	}
	
	final public function getAllCategoryOptions($name)
	{
		return $this->get_all_options('category', $name);
	}
	
	final public function getAllItemOptions($name)
	{
		return $this->get_all_options('item', $name);
	}
	
	/**
	 * Retrieves an indexed array with the top (or bottom) of an option
	 * (delegates to getOptionTop())
	 */
	final public function getBlogOptionTop($name, $amount = 10, $sort = 'desc')
	{
		return $this->get_option_top('blog', $name, $amount, $sort);
	}
	
	final public function getMemberOptionTop($name, $amount = 10, $sort = 'desc')
	{
		return $this->get_option_top('member', $name, $amount, $sort);
	}
	
	final public function getCategoryOptionTop($name, $amount = 10, $sort = 'desc')
	{
		return $this->get_option_top('category', $name, $amount, $sort);
	}
	
	final public function getItemOptionTop($name, $amount = 10, $sort = 'desc')
	{
		return $this->get_option_top('item', $name, $amount, $sort);
	}
	
	/**
	 * NucleusPlugin::getID()
	 * get id for this plugin
	 * 
	 * @access	public
	 * @param	void
	 * @return	integer	this plugid id
	 */
	final public function getID()
	{
		return (integer) $this->plugid;
	}
	
	/**
	 * NucleusPlugin::setID()
	 * set favorite id for this plugin
	 * 
	 * @access	public
	 * @param	integer	$plugid	favorite id for plugin
	 * @return	void
	 */
	final public function setID($plugid)
	{
		$this->plugid = (integer) $plugid;
		return;
	}
	
	/**
	 * Returns the URL of the admin area for this plugin (in case there's
	 * no such area, the returned information is invalid)
	 *
	 * public
	 */
	final public function getAdminURL()
	{
		global $CONF;
		return $CONF['PluginURL'] . $this->getShortName() . '/';
	}
	
	/**
	 * Returns the directory where the admin directory is located and
	 * where the plugin can maintain his extra files
	 *
	 * public
	 */
	final public function getDirectory()
	{
		global $DIR_PLUGINS;
		return $DIR_PLUGINS . $this->getShortName() . '/';
	}
	
	/**
	 * Derives the short name for the plugin from the classname (all
	 * lowercase)
	 *
	 * public
	 */
	final public function getShortName()
	{
		return str_replace('np_','',strtolower(get_class($this)));
	}
	
	/**
	 *	Clears the option value cache which saves the option values during
	 *	the plugin execution. This function is usefull if the options has
	 *	changed during the plugin execution (especially in association with
	 *	the PrePluginOptionsUpdate and the PostPluginOptionsUpdate events)
	 *	
	 *  public
	 **/
	final public function clearOptionValueCache()
	{
		$this->option_values = array();
		$this->plugin_options = 0;
		return;
	}
	
	// internal functions of the class starts here
	protected $option_values;	// oid_contextid => value
	protected $option_info;		// context_name => array('oid' => ..., 'default' => ...)
	protected $plugin_options;	// see getOption()
	protected $plugid;			// plugin id
	
	/**
	 * Class constructor: Initializes some internal data
	 */
	public function __construct()
	{
		$this->option_values = array();	// oid_contextid => value
		$this->option_info = array();	// context_name => array('oid' => ..., 'default' => ...)
		$this->plugin_options = 0;
	}
	
	/**
	 * Retrieves an array of the top (or bottom) of an option from a plugin.
	 * @author TeRanEX
	 * @param  string $context the context for the option: item, blog, member,...
	 * @param  string $name    the name of the option
	 * @param  int    $amount  how many rows must be returned
	 * @param  string $sort    desc or asc
	 * @return array           array with both values and contextid's
	 * @access private
	 */
	final protected function get_option_top($context, $name, $amount = 10, $sort = 'desc')
	{
		if ( ($sort != 'desc') && ($sort != 'asc') )
		{
			$sort= 'desc';
		}
		
		$oid = $this->get_option_id($context, $name);
		
		// retrieve the data and return
		$query = "SELECT otype, oextra FROM %s WHERE oid = %d;";
		$query = sprintf($query, sql_table('plugin_option_desc'), $oid);
		$result = sql_query($query);
		
		$o = sql_fetch_array($result);
		
		if ( ($this->optionCanBeNumeric($o['otype'])) && ($o['oextra'] == 'number' ) )
		{
			$orderby = 'CAST(ovalue AS SIGNED)';
		}
		else
		{
			$orderby = 'ovalue';
		}
		$query = "SELECT ovalue value, ocontextid id FROM %s WHERE oid = %d ORDER BY %s %s LIMIT 0,%d;";
		$query = sprintf($query, sql_table('plugin_option'), $oid, $orderby, $sort, (integer) $amount);
		$result = sql_query($query);
		
		// create the array
		$i = 0;
		$top = array();
		while( $row = sql_fetch_array($result) )
		{
			$top[$i++] = $row;
		}
		
		// return the array (duh!)
		return $top;
	}
	
	/**
	 * Creates an option in the database table plugin_option_desc
	 *	
	 * private
	 */
	final protected function create_option($context, $name, $desc, $type, $defValue, $typeExtras = '')
	{
		// create in plugin_option_desc
		$query = 'INSERT INTO ' . sql_table('plugin_option_desc')
				.' (opid, oname, ocontext, odesc, otype, odef, oextra)'
				.' VALUES ('.intval($this->plugid)
					.', \''.sql_real_escape_string($name).'\''
					.', \''.sql_real_escape_string($context).'\''
					.', \''.sql_real_escape_string($desc).'\''
					.', \''.sql_real_escape_string($type).'\''
					.', \''.sql_real_escape_string($defValue).'\''
					.', \''.sql_real_escape_string($typeExtras).'\');';
		sql_query($query);
		$oid = sql_insert_id();
		
		$key = $context . '_' . $name;
		$this->option_info[$key] = array('oid' => $oid, 'default' => $defValue);
		return 1;
	}
	
	/**
	 * Deletes an option from the database tables
	 * plugin_option and plugin_option_desc
	 *
	 * private
	 */
	final protected function delete_option($context, $name)
	{
		$oid = $this->get_option_id($context, $name);
		if ( !$oid )
		{
			return 0; // no such option
		}
		
		// delete all things from plugin_option
		$query = "DELETE FROM %s WHERE oid=%d;";
		$query = sprintf($query, sql_table('plugin_option'), (integer) $oid);
		sql_query($query);
		
		// delete entry from plugin_option_desc
		$query = "DELETE FROM %s WHERE oid=%d;";
		$query = sprintf($query, sql_table('plugin_option_desc'), $oid);
		sql_query($query);
		
		// clear from cache
		unset($this->option_info["{$context}_{$name}"]);
		$this->option_values = array();
		return 1;
	}
	
	/**
	 * Update an option in the database table plugin_option
	 * 		
	 * returns: 1 on success, 0 on failure
	 * private
	 */
	final protected function set_option($context, $contextid, $name, $value)
	{
		global $manager;
		
		$oid = $this->get_option_id($context, $name);
		if ( !$oid )
		{
			return 0;
		}
		
		// check if context id exists
		switch ( $context )
		{
			case 'member':
				if ( !MEMBER::existsID($contextid) )
				{
					return 0;
				}
				break;
			case 'blog':
				if ( !$manager->existsBlogID($contextid) )
				{
					return 0;
				}
				break;
			case 'category':
				if ( !$manager->existsCategory($contextid) )
				{
					return 0;
				}
				break;
			case 'item':
				if ( !$manager->existsItem($contextid, true, true) )
				{
					return 0;
				}
				break;
			case 'global':
				if ( $contextid != 0 )
				{
					return 0;
				}
				break;
		}
		
		// update plugin_option
		$query = "DELETE FROM %s WHERE oid=%d and ocontextid=%d;";
		$query = sprintf($query, sql_table('plugin_option'), (integer) $oid, (integer) $contextid);
		sql_query($query);
		
		$query = "INSERT INTO %s (ovalue, oid, ocontextid) VALUES ('%s', %d, %d);";
		$query = sprintf($query, sql_table('plugin_option'), sql_real_escape_string($value), $oid, $contextid);
		sql_query($query);
		
		// update cache
		$this->option_values["{$oid}_{$contextid}"] = $value;
		if ( $context == 'global' )
		{
			$this->plugin_options[strtolower($name)] = $value;
		}
		
		return 1;
	}
	
	/**
	 * Get an option from Cache or database
	 * 	 - if not in the option Cache read it from the database
	 *   - if not in the database write default values into the database
	 *   		
	 * private		
	 */		 		 		
	final protected function get_option($context, $contextid, $name)
	{
		$oid = $this->get_option_id($context, $name);
		if ( !$oid )
		{
			return '';
		}
		
		$key = "{$oid}_{$contextid}";
		
		if ( isset($this->option_values[$key]) )
		{
			return $this->option_values[$key];
		}
		
		// get from DB
		$query = "SELECT ovalue FROM %s WHERE oid=%d and ocontextid=%d;";
		$query = sprintf($query, sql_table('plugin_option'), (integer) $oid, (integer) $contextid);
		$result = sql_query($query);
		
		if ( !$result || (sql_num_rows($result) == 0) )
		{
			// fill DB with default value
			$this->option_values[$key] = $this->get_default_value($context, $name);
			$query = "INSERT INTO %s (oid, ocontextid, ovalue) VALUES (%d, %d, '%s');";
			$query = sprintf($query, sql_table('plugin_option'), (integer) $oid, (integer) $contextid, sql_real_escape_string($defVal));
			sql_query($query);
		}
		else
		{
			$o = sql_fetch_object($result);
			$this->option_values[$key] = $o->ovalue;
		}
		
		return $this->option_values[$key];
	}
	
	/**
	 * Returns assoc array with all values for a given option
	 * (one option per possible context id)
	 *
	 * private		 		
	 */
	final protected function get_all_options($context, $name)
	{
		$oid = $this->get_option_id($context, $name);
		if ( !$oid )
		{
			return array();
		}
		$default_value = $this->get_default_value($context, $name);
		
		$options = array();
		$query = "SELECT %s as contextid FROM %s;";
		switch ( $context )
		{
			case 'blog':
				$query = sprintf($query, 'bnumber', sql_table('blog'));
				break;
			case 'category':
				$query = sprintf($query, 'catid', sql_table('category'));
				break;
			case 'member':
				$query = sprintf($query, 'mnumber', sql_table('member'));
				break;
			case 'item':
				$query = sprintf($query, 'inumber', sql_table('item'));
				break;
		}
		
		$result = sql_query($query);
		if ( $result )
		{
			while ( $o = sql_fetch_object($r) )
			{
				$options[$o->contextid] = $default_value;
			}
		}
		
		$query = "SELECT ocontextid, ovalue FROM %s WHERE oid=%d;";
		$query = sprintf($query, sql_table('plugin_option'), $oid);
		$result = sql_query($query);
		while ( $o = sql_fetch_object($result) )
		{
			$options[$o->ocontextid] = $o->ovalue;
		}

		return $options;
	}
	
	/**
	 * NucleusPlugin::get_option_id
	 * 
	 * Gets the 'option identifier' that corresponds to a given option name.
	 * When this method is called for the first time, all the OIDs for the plugin
	 * are loaded into memory, to avoid re-doing the same query all over.
	 * 
	 * @param	string	$context	option context
	 * @param	string	$name		plugin name
	 * @return		integer	option id
	 */
	final protected function get_option_id($context, $name)
	{
		$key = "{$context}_{$name}";
		
		if ( array_key_exists($key, $this->option_info)
		 && array_key_exists('oid', $this->option_info[$key]) )
		{
			return $this->option_info[$key]['oid'];
		}
		
		// load all OIDs for this plugin from the database
		$this->option_info = array();
		$query = "SELECT oid, oname, ocontext, odef FROM %s WHERE opid=%d;";
		$query = sprintf($query, sql_table('plugin_option_desc'), $this->plugid);
		$result = sql_query($query);
		while ( $o = sql_fetch_object($result) )
		{
			$k = $o->ocontext . '_' . $o->oname;
			$this->option_info[$k] = array('oid' => $o->oid, 'default' => $o->odef);
		}
		sql_free_result($result);
		
		return $this->option_info[$key]['oid'];
	}
	final protected function get_default_value($context, $name)
	{
		$key = $context . '_' . $name;
		
		if ( array_key_exists($key, $this->option_info)
		 && array_key_exists('default', $this->option_info[$key]) )
		{
			return $this->option_info[$key]['default'];
		}
		return;
	}
	
	/**
	 * Deletes all option values for a given context and contextid
	 * (used when e.g. a blog, member or category is deleted)
	 *
	 * (static method)
	 */
	final protected function delete_option_values($context, $contextid)
	{
		// delete all associated plugin options
		$aOIDs = array();
		// find ids
		$query = "SELECT oid FROM %s WHERE ocontext='%s';";
		$query = sprintf($query, sql_table('plugin_option_desc'), sql_real_escape_string($context));
		
		$result = sql_query($query);
		while ( $o = sql_fetch_object($result) )
		{
			array_push($aOIDs, $o->oid);
		}
		sql_free_result($result);
		// delete those options. go go go
		if ( count($aOIDs) > 0 )
		{
			$query = "DELETE FROM %s WHERE oid in (%s) and ocontextid=%d;";
			$query = sprintf($query, sql_table('plugin_option'), implode(',',$aOIDs), (integer) $contextid);
			sql_query($query);
		}
		return;
	}
	
	/**
	 * NucleusPlugin::getOptionMeta()
	 * splits the option's typeextra field (at ;'s) to split the meta collection
	 * 
	 * @static
	 * @param string $typeExtra the value of the typeExtra field of an option
	 * @return array array of the meta-key/value-pairs
	 */
	static public function getOptionMeta($typeExtra)
	{
		$meta = array();
		
		/* 1. if $typeExtra includes delimiter ';', split it to tokens */
		$tokens = i18n::explode(';', $typeExtra);
		
		/*
		 * 2. if each of tokens includes "=", it consists of key => value
		 *    else it's 'select' option
		 */
		foreach ( $tokens as $token )
		{
			$matches = array();
			if ( preg_match("#^([^=]+)?=([^=]+)?$#", $token, $matches) )
			{
				$meta[$matches[1]] = $matches[2];
			}
			else
			{
				$meta['select'] = $token;
			}
		}
		return $meta;
	}
	
	/**
	 * NucleusPlugin::getOptionSelectValues()
	 * filters the selectlists out of the meta collection
	 * 
	 * @static
	 * @param string $typeExtra the value of the typeExtra field of an option
	 * @return string the selectlist
	 */
	static public function getOptionSelectValues($typeExtra)
	{
		$meta = NucleusPlugin::getOptionMeta($typeExtra);
		
		if ( array_key_exists('select', $meta) )
		{
			return $meta['select'];
		}
		return;
	}
	
	/**
	 * checks if the eventlist in the database is up-to-date
	 * @return bool if it is up-to-date it return true, else false
	 * @author TeRanEX
	 */
	public function subscribtionListIsUptodate()
	{
		$res = sql_query('SELECT event FROM '.sql_table('plugin_event').' WHERE pid = '.$this->plugid);
		$ev = array();
		while( $a = sql_fetch_array($res) )
		{
			array_push($ev, $a['event']);
		}
		if ( count($ev) != count($this->getEventList()) )
		{
			return false;
		}
		$d = array_diff($ev, $this->getEventList());
		if ( count($d) > 0 )
		{
			// there are differences so the db is not up-to-date
			return false;
		}
		return true;
	}
	
	/**
	 * NucleusPlugin::apply_plugin_options()
	 * Update its entry in database table
	 * 
	 * @static
	 * @param	$options: array ( 'oid' => array( 'contextid' => 'value'))
	 * 			 (taken from request using requestVar())
	 * @param	$new_contextid: integer (accepts a contextid when it is for a new
	 *			 contextid there was no id available at the moment of writing the
	 *			  formcontrols into the page (by ex: itemOptions for new item)
	 * @return void
	 */
	static public function apply_plugin_options(&$options, $new_contextid = 0)
	{
		global $manager;
		
		if ( !is_array($options) )
		{
			return;
		}
		
		foreach ( $options as $oid => $values )
		{
			// get option type info
			$query = "SELECT opid, oname, ocontext, otype, oextra, odef FROM %s WHERE oid=%d;";
			$query = sprintf($query, sql_table('plugin_option_desc'), (integer) $oid);
			$result = sql_query($query);
			if ( $info = sql_fetch_object($result) )
			{
				foreach ( $values as $id => $value )
				{
					// decide wether we are using the contextid of newContextid
					if ( $new_contextid != 0 )
					{
						$contextid = $new_contextid;
					}
					else
					{
						$contextid = $id;
					}
					
					// retreive any metadata
					$meta = NucleusPlugin::getOptionMeta($info->oextra);
					
					// if the option is readonly or hidden it may not be saved
					if ( array_key_exists('access', $meta)
					 && in_array($meta['access'], array('readonly', 'hidden')) )
					{
						return;
					}
					
					// value comes from request
					$value = undoMagic($value);
					
					/* validation the value according to its type */
					switch ( $info->otype )
					{
						case 'yesno':
							if ( ($value != 'yes') && ($value != 'no') )
							{
								$value = 'no';
							}
							break;
						case 'text':
						case 'select':
							if ( array_key_exists('datatype', $meta)
							 && ($meta['datatype'] == 'numerical') && ($value != (integer) $value) )
							{
								$value = (integer) $info->odef;
							}
							break;
						case 'password':
						case 'textarea':
						default:
							break;
					}
					
					/*
					 * trigger event PrePluginOptionsUpdate to give the plugin the
					 * possibility to change/validate the new value for the option
					 */
					$data = array(
						'context'		=> $info->ocontext,
						'plugid'		=> $info->opid,
						'optionname'	=> $info->oname,
						'contextid'	=> $contextid,
						'value'		=> &$value);
					$manager->notify('PrePluginOptionsUpdate', $data);
					
					// delete and insert its fields of table in database
					$query = "DELETE FROM %s WHERE oid=%d AND ocontextid=%d;";
					$query = sprintf($query, sql_table('plugin_option'), (integer) $oid, (integer) $contextid);
					sql_query($query);
					$query = "INSERT INTO %s (oid, ocontextid, ovalue) VALUES (%d, %d, '%s');";
					$query = sprintf($query, sql_table('plugin_option'), (integer) $oid, (integer) $contextid, sql_real_escape_string($value));
					sql_query($query);
				}
			}
			// clear option value cache if the plugin object is already loaded
			if ( is_object($info) )
			{
				$plugin=& $manager->pidLoaded($info->opid);
				if ( $plugin )
				{
					$plugin->clearOptionValueCache();
				}
			}
		}
		return;
	}
}
