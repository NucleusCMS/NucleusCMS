<?
	/**
	  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
	  * Copyright (C) 2002 The Nucleus Group
	  *
	  * This program is free software; you can redistribute it and/or
	  * modify it under the terms of the GNU General Public License
	  * as published by the Free Software Foundation; either version 2
	  * of the License, or (at your option) any later version.
	  * (see nucleus/documentation/index.html#license for more info)
	  *	
	  * This is an (abstract) class of which all Nucleus Plugins must inherit
	  *
	  * for more information on plugins and how to write your own, see the 
	  * plugins.html file that is included with the Nucleus documenation
	  */
	class NucleusPlugin {
		
		// these functions _have_ to be redefined in your plugin
		
		function getName() { return 'Undefined'; }
		function getAuthor()  { return 'Undefined'; }
		function getURL()  { return 'Undefined'; }
		function getVersion() { return '0.0'; }
		function getDescription() { return 'Undefined';}
		
		// these function _may_ be redefined in your plugin
		
		function getMinNucleusVersion() { return 150; }
		function getEventList() { return array(); }
		function getTableList() { return array(); }
		function hasAdminArea() { return 0; }
		
		function install() {}
		function unInstall() {}
		
		function init() {}
		
		function doSkinVar($skinType) {}
		function doTemplateVar(&$item) {
			$args = func_get_args();
			array_shift($args);
			array_unshift($args, 'template');
			call_user_func_array(array(&$this,'doSkinVar'),$args);
		}
		function doAction($type) { return 'No Such Action'; }
		
		// these helper functions should not be redefined in your plugin
		
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
		function createOption($name, $description, $type, $value) {
			$query = "INSERT INTO nucleus_plugin_option (oname, odesc, otype, ovalue, opid) VALUES ('".addslashes($name)."','".addslashes($description)."','".addslashes($type)."','".addslashes($value)."',".$this->plugid.")";
			return sql_query($query);
		}
		
		/**
		  * Removes the option from the database
		  *
		  * Note: Options get erased automatically on plugin uninstall
		  */
		function deleteOption($name) {
			return sql_query("DELETE FROM nucleus_plugin_option WHERE opid=".$this->plugid." and oname='".addslashes($name)."'");
		}
		
		/**
		  * Sets the value of an option to something new
		  */
		function setOption($name, $value) {
			return sql_query("UPDATE nucleus_plugin_option SET ovalue='".addslashes($value)."' WHERE opid=".$this->plugid." and oname='".addslashes($name)."'");
		}
		
		/**
		  * Retrieves the current value for an option
		  */
		function getOption($name) {
			$query = 'SELECT ovalue AS result FROM nucleus_plugin_option WHERE oname=\''.addslashes($name).'\' and opid=' . $this->plugid;
			return quickQuery($query);
		}
		
		/**
		  * Returns the plugin ID
		  */
		function getID() {
			return $this->plugid;
		}
		
		/**
		  * returns the URL of the admin area for this plugin (in case there's
		  * no such area, the returned information is invalid)
		  */
		function getAdminURL() {
			global $CONF;
			return $CONF['PluginURL'] . $this->getShortName() . '/';
		}
		
		/**
		  * Returns the directory where the admin directory is located and 
		  * where the plugin can maintain his extra files
		  */
		function getDirectory() {
			global $DIR_PLUGINS;
			return $DIR_PLUGINS . $this->getShortName() . '/';
		}
		  
		/**
		  * Derives the short name for the plugin from the classname (all lowercase)
		  */
		function getShortName() {
			return str_replace('np_','',get_class($this));
		}
		
		
		  
	}
?>