<?php	/**
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
		function doTemplateCommentsVar(&$item, &$comment) {
			$args = func_get_args();
			array_shift($args);
			array_shift($args);
			array_unshift($args, 'template');
			call_user_func_array(array(&$this,'doSkinVar'),$args);
		}
		function doAction($type) { return 'No Such Action'; }

		/**
		 * Checks if a plugin supports a certain feature.
		 *
		 * @returns 1 if the feature is reported, 0 if not
		 * @param $feature
		 *		Name of the feature. See plugin documentation for more info
		 *			'SqlTablePrefix' -> if the plugin uses the sql_table() method to get table names
		 */
		function supportsFeature($feature) {
			return 0;
		}

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
		function createOption($name, $desc, $type, $defValue = '', $typeExtras = '') {
			return $this->_createOption('global', $name, $desc, $type, $defValue, $typeExtras);
		}
		function createBlogOption($name, $desc, $type, $defValue = '', $typeExtras = '') {
			return $this->_createOption('blog', $name, $desc, $type, $defValue, $typeExtras);
		}
		function createMemberOption($name, $desc, $type, $defValue = '', $typeExtras = '') {
			return $this->_createOption('member', $name, $desc, $type, $defValue, $typeExtras);
		}
		function createCategoryOption($name, $desc, $type, $defValue = '', $typeExtras = '') {
			return $this->_createOption('category', $name, $desc, $type, $defValue, $typeExtras);
		}

		/**
		  * Removes the option from the database
		  *
		  * Note: Options get erased automatically on plugin uninstall
		  */
		function deleteOption($name) {
			return $this->_deleteOption('global', $name);
		}
		function deleteBlogOption($name) {
			return $this->_deleteOption('blog', $name);
		}
		function deleteMemberOption($name) {
			return $this->_deleteOption('member', $name);
		}
		function deleteCategoryOption($name) {
			return $this->_deleteOption('category', $name);
		}

		/**
		  * Sets the value of an option to something new
		  */
		function setOption($name, $value) {
			return $this->_setOption('global', 0, $name, $value);
		}
		function setBlogOption($blogid, $name, $value) {
			return $this->_setOption('blog', $blogid, $name, $value);
		}
		function setMemberOption($memberid, $name, $value) {
			return $this->_setOption('member', $memberid, $name, $value);
		}
		function setCategoryOption($catid, $name, $value) {
			return $this->_setOption('category', $catid, $name, $value);
		}

		/**
		  * Retrieves the current value for an option
		  */
		function getOption($name) {
			return $this->_getOption('global', 0, $name);
		}
		function getBlogOption($blogid, $name) {
			return $this->_getOption('blog', $blogid, $name);
		}
		function getMemberOption($memberid, $name) {
			return $this->_getOption('member', $memberid, $name);
		}
		function getCategoryOption($catid, $name) {
			return $this->_getOption('category', $catid, $name);
		}

		/**
		 * Retrieves an associative array with the option value for each
		 * context id
		 */
		function getAllBlogOptions($name) {
			return $this->_getAllOptions('blog', $name);
		}
		function getAllMemberOptions($name) {
			return $this->_getAllOptions('member', $name);
		}
		function getAllCategoryOptions($name) {
			return $this->_getAllOptions('category', $name);
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


		// constructor. Initializes some internal data
		function NucleusPlugin() {
			$this->_aOptionValues = array();	// oid_contextid => value
			$this->_aOptionToInfo = array();	// context_name => array('oid' => ..., 'default' => ...)
		}

		// private
		function _createOption($context, $name, $desc, $type, $defValue, $typeExtras = '') {
			// create in plugin_option_desc
			$query = 'INSERT INTO ' . sql_table('plugin_option_desc')
			       .' (opid, oname, ocontext, odesc, otype, odef, oextra)'
			       .' VALUES ('.intval($this->plugid)
                             .', \''.addslashes($name).'\''
                             .', \''.addslashes($context).'\''
                             .', \''.addslashes($desc).'\''
                             .', \''.addslashes($type).'\''
                             .', \''.addslashes($defValue).'\''
			                 .', \''.addslashes($typeExtras).'\')';
			sql_query($query);
			$oid = mysql_insert_id();

			$key = $context . '_' . $name;
			$this->_aOptionToInfo[$key] = array('oid' => $oid, 'default' => $defValue);
			return 1;
		}


		// private
		function _deleteOption($context, $name) {
			$oid = getOID($name);
			if (!$oid) return 0; // no such option

			// delete all things from plugin_option
			sql_query('DELETE FROM plugin_option WHERE oid=' . $oid);

			// delete entry from plugin_option_desc
			sql_query('DELETE FROM plugin_option_desc WHERE oid=' . $oid);

			// clear from cache
			unset($this->_aOptionToInfo[$context . '_' . $name]);
			$this->_aOptionValues = array();
			return 1;
		}

		/**
		 * private
		 * returns: 1 on success, 0 on failure
		 */
		function _setOption($context, $contextid, $name, $value) {
			global $manager;

			$oid = $this->_getOID($context, $name);
			if (!$oid) return 0;

			// check if context id exists
			switch ($context) {
				case 'member':
					if (!MEMBER::existsID($contextid)) return 0;
					break;
				case 'blog':
					if (!$manager->existsBlogID($contextid)) return 0;
					break;
				case 'category':
					if (!$manager->existsCategory($contextid)) return 0;
					break;
				case 'global':
					if ($contextid != 0) return 0;
					break;
			}


			// update plugin_option
			sql_query('DELETE FROM ' . sql_table('plugin_option') . ' WHERE oid='.intval($oid) . ' and ocontextid='. intval($contextid));
			sql_query('INSERT INTO ' . sql_table('plugin_option') . ' (ovalue, oid, ocontextid) VALUES (\''.addslashes($value).'\', '. intval($oid) . ', ' . intval($contextid) . ')');

			// update cache
			$this->_aOptionValues[$oid . '_' . $contextid] = $value;

			return 1;
		}

		// private
		function _getOption($context, $contextid, $name) {
			$oid = $this->_getOID($context, $name);
			if (!$oid) return '';


			$key = $oid . '_' . $contextid;

			if (isset($this->_aOptionValues[$key]))
				return $this->_aOptionValues[$key];

			// get from DB
			$res = sql_query('SELECT ovalue FROM ' . sql_table('plugin_option') . ' WHERE oid='.intval($oid).' and ocontextid=' . intval($contextid));

			if (!$res || (mysql_num_rows($res) == 0)) {
				$defVal = $this->_getDefVal($context, $name);
				$this->_aOptionValues[$key] = $defVal;

				// fill DB with default value
				$query = 'INSERT INTO ' . sql_table('plugin_option') . ' (oid,ocontextid,ovalue)'
				       .' VALUES ('.intval($oid).', '.intval($contextid).', \''.addslashes($defVal).'\')';
				sql_query($query);
			}
			else {
				$o = mysql_fetch_object($res);
				$this->_aOptionValues[$key] = $o->ovalue;
			}

			return $this->_aOptionValues[$key];
		}

		/**
		 * Returns assoc array with all values for a given option (one option per
		 * possible context id)
		 */
		function _getAllOptions($context, $name) {
			$oid = $this->_getOID($context, $name);
			if (!$oid) return array();
			$defVal = $this->_getDefVal($context, $name);

			$aOptions = array();
			switch ($context) {
				case 'blog':
					$r = sql_query('SELECT bnumber as contextid FROM ' . sql_table('blog'));
					break;
				case 'category':
					$r = sql_query('SELECT catid as contextid FROM ' . sql_table('category'));
					break;
				case 'member':
					$r = sql_query('SELECT mnumber as contextid FROM ' . sql_table('member'));
					break;
			}
			if ($r) {
				while ($o = mysql_fetch_object($r))
					$aOptions[$o->contextid] = $defVal;
			}

			$res = sql_query('SELECT ocontextid, ovalue FROM ' . sql_table('plugin_option') . ' WHERE oid=' . $oid);
			while ($o = mysql_fetch_object($res))
				$aOptions[$o->ocontextid] = $o->ovalue;

			return $aOptions;
		}

		/**
		 * Gets the 'option identifier' that corresponds to a given option name.
		 * When this method is called for the first time, all the OIDs for the plugin
		 * are loaded into memory, to avoid re-doing the same query all over.
		 */
		function _getOID($context, $name) {
			$key = $context . '_' . $name;
			$info = $this->_aOptionToInfo[$key];
			if (is_array($info)) return $info['oid'];

			// load all OIDs for this plugin from the database
			$this->_aOptionToInfo = array();
			$query = 'SELECT oid, oname, ocontext, odef FROM ' . sql_table('plugin_option_desc') . ' WHERE opid=' . intval($this->plugid);
			$res = sql_query($query);
			while ($o = mysql_fetch_object($res)) {
				$k = $o->ocontext . '_' . $o->oname;
				$this->_aOptionToInfo[$k] = array('oid' => $o->oid, 'default' => $o->odef);
			}
			mysql_free_result($res);

			return $this->_aOptionToInfo[$key]['oid'];
		}
		function _getDefVal($context, $name) {
			$key = $context . '_' . $name;
			$info = $this->_aOptionToInfo[$key];
			if (is_array($info)) return $info['default'];
		}


		/**
		 * Deletes all option values for a given context and contextid
		 * (used when e.g. a blog, member or category is deleted)
		 *
		 * (static method)
		 */
		function _deleteOptionValues($context, $contextid) {
			// delete all associated plugin options
			$aOIDs = array();
				// find ids
			$query = 'SELECT oid FROM '.sql_table('plugin_option_desc') . ' WHERE ocontext=\''.addslashes($context).'\'';
			$res = sql_query($query);
			while ($o = mysql_fetch_object($res))
				array_push($aOIDs, $o->oid);
			mysql_free_result($res);
				// delete those options. go go go
			if (count($aOIDs) > 0) {
				$query = 'DELETE FROM ' . sql_table('plugin_option') . ' WHERE oid in ('.implode(',',$aOIDs).') and ocontextid=' . intval($contextid);
				sql_query($query);
			}
		}

		/**
		 * @param $aOptions: array ( 'oid' => array( 'contextid' => 'value'))
		 *        (taken from request using requestVar())
		 *
		 * (static method)
		 */
		function _applyPluginOptions(&$aOptions) {
			if (!is_array($aOptions)) return;

			foreach ($aOptions as $oid => $values) {

				// get option type info
				$query = 'SELECT otype, oextra, odef FROM ' . sql_table('plugin_option_desc') . ' WHERE oid=' . intval($oid);
				$res = sql_query($query);
				if ($o = mysql_fetch_object($res))
				{
					foreach ($values as $contextid => $value) {
							$value = undoMagic($value);	// value comes from request

							switch($o->otype) {
								case 'yesno':
									if (($value != 'yes') && ($value != 'no')) $value = 'no';
									break;
								default:
									break;
							}

							sql_query('DELETE FROM '.sql_table('plugin_option').' WHERE oid='.intval($oid).' AND ocontextid='.intval($contextid));
							sql_query('INSERT INTO '.sql_table('plugin_option')." (oid, ocontextid, ovalue) VALUES (".intval($oid).",".intval($contextid).",'" . addslashes($value) . "')");

					}
				}
			}
		}


	}
?>