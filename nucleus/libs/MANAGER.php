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
  *	This class makes sure each item/weblog/comment object gets requested from
  * the database only once, by keeping them in a cache. The class also acts as 
  * a dynamic classloader, loading classes _only_ when they are first needed,
  * hoping to diminish execution time
  *
  * The class is a singleton, meaning that there will be only one object of it
  * active at all times. The object can be requested using MANAGER::instance()
  */
class MANAGER {
	
	/**
	  * Returns the only instance of this class. Creates the instance if it 
	  * does not yet exists. Users should use this function as 
	  * $manager =& MANAGER::instance(); to get a reference to the object
	  * instead of a copy
	  */
	function &instance() {
		static $instance = '';
		if ($instance == '')
			$instance = new MANAGER();
		return $instance;
	}
	
	/**
	  * The constructor of this class initializes the object caches 
	  */
	function MANAGER() {
		$this->items = array();
		$this->blogs = array();
		$this->plugins = array();
		$this->karma = array();
		$this->parserPrefs = array();
	}
	
	/**
	  * Returns the requested item object. If it is not in the cache, it will
	  * first be loaded and then placed in the cache.
	  * Intended use: $item =& $manager->getItem(1234)
	  */
	function &getItem($itemid, $allowdraft, $allowfuture) {
		$item =& $this->items[$itemid];
		
		// check the draft and future rules if the item was already cached 
		if ($item) {
			if ((!$allowdraft) && ($item['draft']))
				return 0;

			$blog =& $this->getBlog(getBlogIDFromItemID($itemid));
			if ((!$allowfuture) && ($item['timestamp'] > $blog->getCorrectTime()))
				return 0;				
		}
		if (!$item) {
			// load class if needed
			$this->loadClass('ITEM');
			// load item object
			$item = ITEM::getitem($itemid, $allowdraft, $allowfuture);
			$this->items[$itemid] = $item;
		}
		return $item;
	}
	
	/**
	  * Loads a class if it has not yet been loaded
	  */
	function loadClass($name) {
		$this->_loadClass($name, $name . '.php');
	}
	
	/**
	  * Checks if an item exists
	  */
	function existsItem($id,$future,$draft) {
		$this->_loadClass('ITEM','ITEM.php');	
		return ITEM::exists($id,$future,$draft);
	}
	
	/**
	  * Checks if a category exists
	  */
	function existsCategory($id) {
		return (quickQuery('SELECT COUNT(*) as result FROM '.sql_table('category').' WHERE catid='.intval($id)) > 0);
	}
	
	function &getBlog($blogid) {
		$blog =& $this->blogs[$blogid];

		if (!$blog) {
			// load class if needed
			$this->_loadClass('BLOG','BLOG.php');
			// load blog object
			$blog = new BLOG($blogid);
			$this->blogs[$blogid] = $blog;
		}
		return $blog;
	}
	
	function existsBlog($name) {
		$this->_loadClass('BLOG','BLOG.php');
		return BLOG::exists($name);
	}

	function existsBlogID($id) {
		$this->_loadClass('BLOG','BLOG.php');
		return BLOG::existsID($id);
	}	
	
	/**
	 * Returns a KARMA object (karma votes)
	 */
	function &getKarma($itemid) {
		$karma =& $this->karma[$itemid];

		if (!$karma) {
			// load class if needed
			$this->_loadClass('KARMA','KARMA.php');
			// create KARMA object
			$karma = new KARMA($itemid);
			$this->karma[$itemid] = $karma;
		}
		return $karma;
	}	
	
	/**
	 * Global parser preferences
	 */
	function setParserProperty($name, $value) {
		$this->parserPrefs[$name] = $value;
	}
	function getParserProperty($name) {
		return $this->parserPrefs[$name];
	}

	/**
	  * A private helper class to load classes
	  */
	function _loadClass($name, $filename) {
		if (!class_exists($name)) {
				global $DIR_LIBS;
				include($DIR_LIBS . $filename);
		}	
	}
	
	function _loadPlugin($name) {
		if (!class_exists($name)) {
				global $DIR_PLUGINS;
				
				$fileName = $DIR_PLUGINS . $name . '.php';
				
				if (!file_exists($fileName))
				{
					ACTIONLOG::add(WARNING, 'Plugin ' . $name . ' was not loaded (File not found)');
					return 0;
				}
				
				// load plugin
				include($fileName);
				
				// check if class exists (avoid errors in eval'd code)
				if (!class_exists($name))
				{
					ACTIONLOG::add(WARNING, 'Plugin ' . $name . ' was not loaded (Class not found in file, possible parse error)');				
					return 0;
				}
				
				// add to plugin array
				eval('$this->plugins[$name] = new ' . $name . '();');
				
				// get plugid
				$this->plugins[$name]->plugid = $this->getPidFromName($name);
				
				// unload plugin if a prefix is used and the plugin cannot handle this^
				global $MYSQL_PREFIX;
				if (($MYSQL_PREFIX != '') && !$this->plugins[$name]->supportsFeature('SqlTablePrefix')) 
				{
					unset($this->plugins[$name]);
					ACTIONLOG::add(WARNING, 'Plugin ' . $name . ' was not loaded (does not support SqlTablePrefix)');
					return;
				}
				
				// call init method
				$this->plugins[$name]->init();
				
		}	
	}
	
	function &getPlugin($name) {
		$plugin =& $this->plugins[$name];

		if (!$plugin) {
			// load class if needed
			$this->_loadPlugin($name);
			$plugin =& $this->plugins[$name];			
		}
		return $plugin;
	}

	/**
	  * checks if the given plugin IS installed or not
	  */
	function pluginInstalled($name) {
		$res = sql_query('SELECT pfile FROM '.sql_table('plugin').' WHERE pfile=\''.addslashes($name).'\' LIMIT 1');
		return (mysql_num_rows($res) != 0);
	}
	function pidInstalled($pid) {
		$res = sql_query('SELECT pid FROM '.sql_table('plugin').' WHERE pid=' . $pid);
		return (mysql_num_rows($res) != 0);
	}
	function getPidFromName($name) {
		return quickQuery('SELECT pid as result FROM '.sql_table('plugin').' WHERE pfile=\''.addslashes($name).'\' LIMIT 1');
	}
	
	/**
	  * Definition of the cache variables
	  */
	var $items;
	var $blogs;


	/**
	  * A function to notify plugins that something has happened. Only the plugins
	  * that are subscribed to the event will get notified.
	  * Upon the first call, the list of subscriptions will be fetched from the 
	  * database. The plugins itsself will only get loaded when they are first needed
	  *
	  * @param $eventName
	  *		Name of the event (method to be called on plugins)
	  * @param $data
	  *		Can contain any type of data, depending on the event type. Usually this is
	  *		an itemid, blogid, ... but it can also be an array containing multiple values
	  */
	function notify($eventName, $data) {
		// load subscription list if needed
		if (!is_array($this->subscriptions)) 
			$this->_loadSubscriptions();
			

		// get listening objects
		$listeners = $this->subscriptions[$eventName];
		
		// notify all of them
		if (is_array($listeners)) {
			foreach($listeners as $listener) {
				// load class if needed
				$this->_loadPlugin($listener);
				// do notify (if method exists)
				if (method_exists($this->plugins[$listener], 'event_' . $eventName))
					call_user_func(array(&$this->plugins[$listener],'event_' . $eventName), $data);
			}
		}
		
	}
	
	/**
	  * Loads plugin subscriptions
	  */
	function _loadSubscriptions() {
		// initialize as array
		$this->subscriptions = array();

		$res = sql_query('SELECT p.pfile as pfile, e.event as event FROM '.sql_table('plugin_event').' as e, '.sql_table('plugin').' as p WHERE e.pid=p.pid ORDER BY p.porder ASC');
		while ($o = mysql_fetch_object($res)) {
			$pluginName = $o->pfile;
			$eventName = $o->event;
			$this->subscriptions[$eventName][] = $pluginName;
		}
		
	}

	/**
	  * Definition of the plugin subscriptionlist, and the store of loaded 
	  * plugin objects
	  *
	  * The subcription array has the following structure
	  *		$subscriptions[$EventName] = array containing names of plugin classes to be
	  *									 notified when that event happens
	  */
	var $subscriptions;
	var $plugins;
	
	
}

?>