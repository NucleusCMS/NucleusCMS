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
 * This class makes sure each item/weblog/comment object gets requested from
 * the database only once, by keeping them in a cache. The class also acts as
 * a dynamic classloader, loading classes _only_ when they are first needed,
 * hoping to diminish execution time
 *
 * The class is a singleton, meaning that there will be only one object of it
 * active at all times. The object can be requested using MANAGER::instance()
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class MANAGER {

	/**
	 * Cached ITEM, BLOG, PLUGIN, KARMA and MEMBER objects. When these objects are requested
	 * through the global $manager object (getItem, getBlog, ...), only the first call
	 * will create an object. Subsequent calls will return the same object.
	 *
	 * The $items, $blogs, ... arrays map an id to an object (for plugins, the name is used
	 * rather than an ID)
	 */
	var $items;
	var $blogs;
	var $plugins;
	var $karma;
	var $templates;
	var $members;

	/**
	 * cachedInfo to avoid repeated SQL queries (see pidInstalled/pluginInstalled/getPidFromName)
	 * e.g. which plugins exists?
	 *
	 * $cachedInfo['installedPlugins'] = array($pid -> $name)
	 */
	var $cachedInfo;

	/**
	  * The plugin subscriptionlist
	  *
	  * The subcription array has the following structure
	  *		$subscriptions[$EventName] = array containing names of plugin classes to be
	  *									 notified when that event happens
	  */
	var $subscriptions;

	/**
	  * Returns the only instance of this class. Creates the instance if it
	  * does not yet exists. Users should use this function as
	  * $manager =& MANAGER::instance(); to get a reference to the object
	  * instead of a copy
	  */
	function &instance() {
		static $instance = array();
		if (empty($instance)) {
			$instance[0] = new MANAGER();
		}
		return $instance[0];
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
		$this->cachedInfo = array();
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

	/**
	  * Returns the blog object for a given blogid
	  */
	function &getBlog($blogid) {
		$blog =& $this->blogs[$blogid];

		if (!$blog) {
			// load class if needed
			$this->_loadClass('BLOG','BLOG.php');
			// load blog object
			$blog = new BLOG($blogid);
			$this->blogs[$blogid] =& $blog;
		}
		return $blog;
	}

	/**
	  * Checks if a blog exists
	  */
	function existsBlog($name) {
		$this->_loadClass('BLOG','BLOG.php');
		return BLOG::exists($name);
	}

	/**
	  * Checks if a blog id exists
	  */
	function existsBlogID($id) {
		$this->_loadClass('BLOG','BLOG.php');
		return BLOG::existsID($id);
	}

	/**
	 * Returns a previously read template
	 */
	function &getTemplate($templateName) {
		$template =& $this->templates[$templateName];

		if (!$template) {
			$template = TEMPLATE::read($templateName);
			$this->templates[$templateName] =& $template;
		}
		return $template;
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
			$this->karma[$itemid] =& $karma;
		}
		return $karma;
	}

	/**
	 * Returns a MEMBER object
	 */
	function &getMember($memberid) {
		$mem =& $this->members[$memberid];

		if (!$mem) {
			// load class if needed
			$this->_loadClass('MEMBER','MEMBER.php');
			// create MEMBER object
			$mem =& MEMBER::createFromID($memberid);
			$this->members[$memberid] =& $mem;
		}
		return $mem;
	}

	/**
	 * Set the global parser preferences
	 */
	function setParserProperty($name, $value) {
		$this->parserPrefs[$name] = $value;
	}
	
	/**
	 * Get the global parser preferences
	 */
	function getParserProperty($name) {
		return $this->parserPrefs[$name];
	}

	/**
	  * A helper function to load a class
	  * 
	  *	private
	  */
	function _loadClass($name, $filename) {
		if (!class_exists($name)) {
				global $DIR_LIBS;
				include($DIR_LIBS . $filename);
		}
	}

	/**
	  * A helper function to load a plugin
	  * 
	  *	private
	  */
	function _loadPlugin($name) {
		if (!class_exists($name)) {
				global $DIR_PLUGINS;

				$fileName = $DIR_PLUGINS . $name . '.php';

				if (!file_exists($fileName))
				{
					if (!defined('_MANAGER_PLUGINFILE_NOTFOUND')) {
                        define('_MANAGER_PLUGINFILE_NOTFOUND', 'Plugin %s was not loaded (File not found)');
                    }
                    ACTIONLOG::add(WARNING, sprintf(_MANAGER_PLUGINFILE_NOTFOUND, $name)); 
					return 0;
				}

				// load plugin
				include($fileName);

				// check if class exists (avoid errors in eval'd code)
				if (!class_exists($name))
				{
					ACTIONLOG::add(WARNING, sprintf(_MANAGER_PLUGINFILE_NOCLASS, $name));
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
					ACTIONLOG::add(WARNING, sprintf(_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT, $name));
					return 0;
				}
				
				// unload plugin if using non-mysql handler and plugin does not support it 
				global $MYSQL_HANDLER;
				if ((!in_array('mysql',$MYSQL_HANDLER)) && !$this->plugins[$name]->supportsFeature('SqlApi'))
				{
					unset($this->plugins[$name]);
					ACTIONLOG::add(WARNING, sprintf(_MANAGER_PLUGINSQLAPI_NOTSUPPORT, $name));
					return 0;
				}

				// call init method
				$this->plugins[$name]->init();

		}
	}

	/**
	 * Returns a PLUGIN object
	 */
	function &getPlugin($name) {
		// retrieve the name of the plugin in the right capitalisation
		$name = $this->getUpperCaseName ($name);
		// get the plugin	
		$plugin =& $this->plugins[$name]; 

		if (!$plugin) {
			// load class if needed
			$this->_loadPlugin($name);
			$plugin =& $this->plugins[$name];
		}
		return $plugin;
	}

	/**
	  * Checks if the given plugin IS loaded or not
	  */
	function &pluginLoaded($name) {
		$plugin =& $this->plugins[$name];
		return $plugin;
	}
		
	function &pidLoaded($pid) {
		$plugin=false;
		reset($this->plugins);
		while (list($name) = each($this->plugins)) {
			if ($pid!=$this->plugins[$name]->getId()) continue;
			$plugin= & $this->plugins[$name];
			break;
		}
		return $plugin;
	}

	/**
	  * checks if the given plugin IS installed or not
	  */
	function pluginInstalled($name) {
		$this->_initCacheInfo('installedPlugins');
		return ($this->getPidFromName($name) != -1);
	}

	function pidInstalled($pid) {
		$this->_initCacheInfo('installedPlugins');
		return ($this->cachedInfo['installedPlugins'][$pid] != '');
	}

	function getPidFromName($name) {
		$this->_initCacheInfo('installedPlugins');
		foreach ($this->cachedInfo['installedPlugins'] as $pid => $pfile)
		{
			if (strtolower($pfile) == strtolower($name))
				return $pid;
		}
		return -1;
	}

	/**
	  * Retrieve the name of a plugin in the right capitalisation
	  */
	function getUpperCaseName ($name) {
		$this->_initCacheInfo('installedPlugins');
		foreach ($this->cachedInfo['installedPlugins'] as $pid => $pfile)
		{
			if (strtolower($pfile) == strtolower($name))
				return $pfile;
		}
		return -1;
	}
	
	function clearCachedInfo($what) {
		unset($this->cachedInfo[$what]);
	}

	/**
	 * Loads some info on the first call only
	 */
	function _initCacheInfo($what)
	{
		if (isset($this->cachedInfo[$what]) && is_array($this->cachedInfo[$what]))
			return;
		switch ($what)
		{
			// 'installedPlugins' = array ($pid => $name)
			case 'installedPlugins':
				$this->cachedInfo['installedPlugins'] = array();
				$res = sql_query('SELECT pid, pfile FROM ' . sql_table('plugin'));
				while ($o = sql_fetch_object($res))
				{
					$this->cachedInfo['installedPlugins'][$o->pid] = $o->pfile;
				}
				break;
		}
	}

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
	function notify($eventName, &$data) {
		// load subscription list if needed
		if (!is_array($this->subscriptions))
			$this->_loadSubscriptions();


		// get listening objects
		$listeners = false;
		if (isset($this->subscriptions[$eventName])) {
			$listeners = $this->subscriptions[$eventName];
		}

		// notify all of them
		if (is_array($listeners)) {
			foreach($listeners as $listener) {
				// load class if needed
				$this->_loadPlugin($listener);
				// do notify (if method exists)
				if (isset($this->plugins[$listener]) && method_exists($this->plugins[$listener], 'event_' . $eventName))
					call_user_func(array($this->plugins[$listener], 'event_' . $eventName), $data);
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
		while ($o = sql_fetch_object($res)) {
			$pluginName = $o->pfile;
			$eventName = $o->event;
			$this->subscriptions[$eventName][] = $pluginName;
		}

	}

	/*
		Ticket functions. These are uses by the admin area to make it impossible to simulate certain GET/POST
		requests. tickets are user specific
	*/

	var $currentRequestTicket = '';

	/**
	 * GET requests: Adds ticket to URL (URL should NOT be html-encoded!, ticket is added at the end)
	 */
	function addTicketToUrl($url)
	{
		$ticketCode = 'ticket=' . $this->_generateTicket();
		if (strstr($url, '?'))
			return $url . '&' . $ticketCode;
		else
			return $url . '?' . $ticketCode;
	}

	/**
	 * POST requests: Adds ticket as hidden formvar
	 */
	function addTicketHidden()
	{
		$ticket = $this->_generateTicket();

		echo '<input type="hidden" name="ticket" value="', hsc($ticket), '" />';
	}

	/**
	 * Get a new ticket
	 * (xmlHTTPRequest AutoSaveDraft uses this to refresh the ticket)
	 */
	function getNewTicket()
	{
		$this->currentRequestTicket = '';
		return $this->_generateTicket();
	}

	/**
	 * Checks the ticket that was passed along with the current request
	 */
	function checkTicket()
	{
		global $member;

		// get ticket from request
		$ticket = requestVar('ticket');

		// no ticket -> don't allow
		if ($ticket == '')
			return false;

		// remove expired tickets first
		$this->_cleanUpExpiredTickets();

		// get member id
		if (!$member->isLoggedIn())
			$memberId = -1;
		else
			$memberId = $member->getID();

		// check if ticket is a valid one
		$query = 'SELECT COUNT(*) as result FROM ' . sql_table('tickets') . ' WHERE member=' . intval($memberId). ' and ticket=\''.sql_real_escape_string($ticket).'\'';
		if (quickQuery($query) == 1)
		{
			// [in the original implementation, the checked ticket was deleted. This would lead to invalid
			//  tickets when using the browsers back button and clicking another link/form
			//  leaving the keys in the database is not a real problem, since they're member-specific and
			//  only valid for a period of one hour
			// ]
			// sql_query('DELETE FROM '.sql_table('tickets').' WHERE member=' . intval($memberId). ' and ticket=\''.addslashes($ticket).'\'');
			return true;
		} else {
			// not a valid ticket
			return false;
		}

	}

	/**
	 * (internal method) Removes the expired tickets
	 */
	function _cleanUpExpiredTickets()
	{
		// remove tickets older than 1 hour
		$oldTime = time() - 60 * 60;
		$query = 'DELETE FROM ' . sql_table('tickets'). ' WHERE ctime < \'' . date('Y-m-d H:i:s',$oldTime) .'\'';
		sql_query($query);
	}

	/**
	 * (internal method) Generates/returns a ticket (one ticket per page request)
	 */
	function _generateTicket()
	{
		if ($this->currentRequestTicket == '')
		{
			// generate new ticket (only one ticket will be generated per page request)
			// and store in database
			global $member;
			// get member id
			if (!$member->isLoggedIn())
				$memberId = -1;
			else
				$memberId = $member->getID();

			$ok = false;
			while (!$ok)
			{
				// generate a random token
				srand((double)microtime()*1000000);
				$ticket = md5(uniqid(rand(), true));

				// add in database as non-active
				$query = 'INSERT INTO ' . sql_table('tickets') . ' (ticket, member, ctime) ';
				$query .= 'VALUES (\'' . sql_real_escape_string($ticket). '\', \'' . intval($memberId). '\', \'' . date('Y-m-d H:i:s',time()) . '\')';
				if (sql_query($query))
					$ok = true;
			}

			$this->currentRequestTicket = $ticket;
		}
		return $this->currentRequestTicket;
	}

}

?>