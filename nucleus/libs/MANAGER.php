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
 * active at all times. The object can be requested using Manager::instance()
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class Manager
{
	/**
	 * Cached ITEM, BLOG, PLUGIN, KARMA and MEMBER objects. When these objects are requested
	 * through the global $manager object (getItem, getBlog, ...), only the first call
	 * will create an object. Subsequent calls will return the same object.
	 *
	 * The $items, $blogs, ... arrays map an id to an object (for plugins, the name is used
	 * rather than an ID)
	 */
	private $items;
	private $blogs;
	private $plugins;
	private $karma;
	private $templates;
	private $members;
	private $skins;
	
	/**
	 * cachedInfo to avoid repeated SQL queries (see pidInstalled/pluginInstalled/getPidFromName)
	 * e.g. which plugins exists?
	 *
	 * $cachedInfo['installedPlugins'] = array($pid -> $name)
	 */
	private $cachedInfo;
	
	/**
	 * The plugin subscriptionlist
	 *
	 * The subcription array has the following structure
	 *		$subscriptions[$EventName] = array containing names of plugin classes to be
	 *									 notified when that event happens
	 * 
	 * NOTE: this is referred by Comments::addComment() for spamcheck API
	 * TODO: we should add new methods to get this
	 */
	public $subscriptions;
	
	/**
	 * Ticket functions. These are uses by the admin area to make it impossible to simulate certain GET/POST
	 * requests. tickets are user specific
	 */
	private $currentRequestTicket = '';
	
	/**
	 * Returns the only instance of this class. Creates the instance if it
	 * does not yet exists. Users should use this function as
	 * $manager =& Manager::instance(); to get a reference to the object
	 * instead of a copy
	 */
	static public function &instance()
	{
		static $instance = array();
		if ( empty($instance) )
		{
			$instance[0] = new Manager();
		}
		return $instance[0];
	}
	
	/**
	 * The constructor of this class initializes the object caches
	 */
	public function __construct()
	{
		$this->items = array();
		$this->blogs = array();
		$this->plugins = array();
		$this->karma = array();
		$this->templates = array();
		$this->skins = array();
		$this->parserPrefs = array();
		$this->cachedInfo = array();
		$this->members = array();
		return;
	}
	
	/**
	 * Returns the requested item object. If it is not in the cache, it will
	 * first be loaded and then placed in the cache.
	 * Intended use: $item =& $manager->getItem(1234, 0, 0)
	 */
	public function &getItem($itemid, $allowdraft, $allowfuture)
	{
		/* confirm to cached */
		if ( !array_key_exists($itemid, $this->items) )
		{
			$this->loadClass('ITEM');
			$item = Item::getitem($itemid, $allowdraft, $allowfuture);
			$this->items[$itemid] = $item;
		}
		
		$item =& $this->items[$itemid];
		if ( !$allowdraft && ($item['draft']) )
		{
			return 0;
		}
		
		$blog =& $this->getBlog($item['blogid']);
		if ( !$allowfuture && ($item['timestamp'] > $blog->getCorrectTime()) )
		{
			return 0;
		}
		
		return $item;
	}
	
	/**
	 * Loads a class if it has not yet been loaded
	 */
	public function loadClass($name)
	{
		$this->_loadClass($name, $name . '.php');
		return;
	}
	
	/**
	 * Checks if an item exists
	 */
	public function existsItem($id,$future,$draft)
	{
		$this->_loadClass('ITEM','ITEM.php');
		return Item::exists($id,$future,$draft);
	}
	
	/**
	 * Checks if a category exists
	 */
	public function existsCategory($id)
	{
		return (DB::getValue('SELECT COUNT(*) as result FROM '.sql_table('category').' WHERE catid='.intval($id)) > 0);
	}
	
	/**
	 * Returns the blog object for a given blogid
	 */
	public function &getBlog($blogid)
	{
		if ( !array_key_exists($blogid, $this->blogs) )
		{
			$this->_loadClass('BLOG','BLOG.php');
			$this->blogs[$blogid] = new Blog($blogid);
		}
		return $this->blogs[$blogid];
	}
	
	/**
	 * Checks if a blog exists
	 */
	public function existsBlog($name)
	{
		$this->_loadClass('BLOG','BLOG.php');
		return Blog::exists($name);
	}
	
	/**
	 * Checks if a blog id exists
	 */
	public function existsBlogID($id)
	{
		$this->_loadClass('BLOG','BLOG.php');
		return Blog::existsID($id);
	}
	
	/**
	 * Returns a previously read template
	 */
	public function &getTemplate($templateName)
	{
		if ( !array_key_exists($templateName, $this->templates) )
		{
			$this->_loadClass('Template','TEMPLATE.php');
			$tmplate_tmp = Template::read($templateName);
			$this->templates[$templateName] =& $tmplate_tmp;
		}
		return $this->templates[$templateName];
	}
	
	/**
	 * Returns a KARMA object (karma votes)
	 */
	public function &getKarma($itemid)
	{
		if ( !array_key_exists($itemid, $this->karma) )
		{
			$this->_loadClass('Karma','KARMA.php');
			$this->karma[$itemid] = new Karma($itemid);
		}
		return $this->karma[$itemid];
	}
	
	/**
	 * Returns a MEMBER object
	 */
	public function &getMember($memberid)
	{
		if ( !array_key_exists($memberid, $this->members) )
		{
			$this->_loadClass('Member','MEMBER.php');
			$this->members[$memberid] =& Member::createFromID($memberid);;
		}
		return $this->members[$memberid];
	}
	
	/**
	 * Manager::getSkin()
	 * 
	 * @param	integer	$skinid				ID for skin
	 * @param	string	$action_class		action class for handling skin variables
	 * @param	string	$event_identifier	identifier for event name
	 * @return	object	instance of Skin class
	 */
	public function &getSkin($skinid, $action_class='Actions', $event_identifier='Skin')
	{
		if ( !array_key_exists($skinid, $this->skins) )
		{
			$this->_loadClass('Skin', 'SKIN.php');
			$this->skins[$skinid] = new Skin($skinid, $action_class, $event_identifier);
		}
		
		return $this->skins[$skinid];
	}
	
	/**
	 * Set the global parser preferences
	 */
	public function setParserProperty($name, $value)
	{
		$this->parserPrefs[$name] = $value;
		return;
	}
	
	/**
	 * Get the global parser preferences
	 */
	public function getParserProperty($name)
	{
		return $this->parserPrefs[$name];
	}
	
	/**
	 * A helper function to load a class
	 * 
	 *	private
	 */
	private function _loadClass($name, $filename)
	{
		global $DIR_LIBS;
		
		if ( !class_exists($name) )
		{
			include($DIR_LIBS . $filename);
		}
		return;
	}
	
	/**
	 * Manager::_loadPlugin()
	 * loading a certain plugin
	 * 
	 * @param	string $name plugin name
	 * @return	void
	 */
	private function _loadPlugin($name)
	{
		global $DIR_PLUGINS, $MYSQL_HANDLER, $MYSQL_PREFIX;
		
		if ( class_exists($name) )
		{
			return;
		}
		
		$fileName = "{$DIR_PLUGINS}{$name}.php";
		
		if ( !file_exists($fileName) )
		{
			if ( !defined('_MANAGER_PLUGINFILE_NOTFOUND') )
			{
				define('_MANAGER_PLUGINFILE_NOTFOUND', 'Plugin %s was not loaded (File not found)');
			}
			ActionLog::add(WARNING, sprintf(_MANAGER_PLUGINFILE_NOTFOUND, $name)); 
			return 0;
		}
		
		// load plugin
		include($fileName);
		
		// check if class exists (avoid errors in eval'd code)
		if ( !class_exists($name) )
		{
			ActionLog::add(WARNING, sprintf(_MANAGER_PLUGINFILE_NOCLASS, $name));
			return 0;
		}
		
		// add to plugin array
		$this->plugins[$name] = new $name();
		
		// get plugid
		$this->plugins[$name]->setID($this->getPidFromName($name));
		
		// unload plugin if a prefix is used and the plugin cannot handle this
		if ( ($MYSQL_PREFIX != '')
		  && !$this->plugins[$name]->supportsFeature('SqlTablePrefix') )
		{
			unset($this->plugins[$name]);
			ActionLog::add(WARNING, sprintf(_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT, $name));
			return 0;
		}
		
		// unload plugin if using non-mysql handler and plugin does not support it 
		if ( (!in_array('mysql',$MYSQL_HANDLER))
		  && !$this->plugins[$name]->supportsFeature('SqlApi') )
		{
			unset($this->plugins[$name]);
			ActionLog::add(WARNING, sprintf(_MANAGER_PLUGINSQLAPI_NOTSUPPORT, $name));
			return 0;
		}
		
		// call init method
		$this->plugins[$name]->init();
		
		return;
	}

	/**
	 * Manager:getPlugin()
	 * Returns a PLUGIN object
	 * 
	 * @param	string	$name	name of plugin
	 * @return	object	plugin object
	 */
	public function &getPlugin($name)
	{
		// retrieve the name of the plugin in the right capitalisation
		$name = $this->getUpperCaseName ($name);
		
		// get the plugin	
		$plugin =& $this->plugins[$name]; 
		
		if ( !$plugin )
		{
			// load class if needed
			$this->_loadPlugin($name);
			$plugin =& $this->plugins[$name];
		}
		return $plugin;
	}
	
	/**
	 * Manager::pluginLoaded()
	 * Checks if the given plugin IS loaded or not
	 * 
	 * @param	string	$name	name of plugin
	 * @return	object	plugin object
	 */
	public function &pluginLoaded($name)
	{
		$plugin =& $this->plugins[$name];
		return $plugin;
	}
	
	/**
	 * Manager::pidLoaded()
	 * 
	 * @param	integer	$pid	id for plugin
	 * @return	object	plugin object
	 */
	public function &pidLoaded($pid)
	{
		$plugin=false;
		reset($this->plugins);
		while ( list($name) = each($this->plugins) )
		{
			if ( $pid!=$this->plugins[$name]->getId() )
			{
				continue;
			}
			$plugin= & $this->plugins[$name];
			break;
		}
		return $plugin;
	}
	
	/**
	 * Manager::pluginInstalled()
	 * checks if the given plugin IS installed or not
	 * 
	 * @param	string	$name	name of plugin
	 * @return	boolean	exists or not
	 */
	public function pluginInstalled($name)
	{
		$this->_initCacheInfo('installedPlugins');
		return ($this->getPidFromName($name) != -1);
	}

	/**
	 * Manager::pidInstalled()
	 * checks if the given plugin IS installed or not
	 * 
	 * @param	integer	$pid	id of plugin
	 * @return	boolean	exists or not
	 */
	public function pidInstalled($pid)
	{
		$this->_initCacheInfo('installedPlugins');
		return ($this->cachedInfo['installedPlugins'][$pid] != '');
	}
	
	/**
	 * Manager::getPidFromName()
	 * 
	 * @param	string	$name	name of plugin
	 * @return	mixed	id for plugin or -1 if not exists
	 */
	public function getPidFromName($name)
	{
		$this->_initCacheInfo('installedPlugins');
		foreach ( $this->cachedInfo['installedPlugins'] as $pid => $pfile )
		{
			if (strtolower($pfile) == strtolower($name))
			{
				return $pid;
			}
		}
		return -1;
	}
	
	/**
	 * Manager::getPluginNameFromPid()
	 * 
	 * @param	string	$pid	ID for plugin
	 * @return	string	name of plugin
	 */
	public function getPluginNameFromPid($pid)
	{
		if ( !array_key_exists($pid, $this->cachedInfo['installedPlugins']) )
		{
			$query = 'SELECT pfile FROM %s WHERE pid=%d;';
			$query = sprintf($query, sql_table('plugin'), (integer) $pid);
			return DB::getValue($query);
		}
		return $this->cachedInfo['installedPlugins'][$pid];
	}
	
	/**
	 * Manager::getUpperCaseName()
	 * Retrieve the name of a plugin in the right capitalisation
	 * 
	 * @param	string	$name	name of plugin
	 * @return	string	name according to UpperCamelCase
	 */
	public function getUpperCaseName ($name)
	{
		$this->_initCacheInfo('installedPlugins');
		foreach ( $this->cachedInfo['installedPlugins'] as $pid => $pfile )
		{
			if ( strtolower($pfile) == strtolower($name) )
			{
				return $pfile;
			}
		}
		return -1;
	}
	
	/**
	 * Manager::clearCachedInfo()
	 * 
	 * @param	string	$what
	 * @return	void
	 */
	public function clearCachedInfo($what)
	{
		unset($this->cachedInfo[$what]);
		return;
	}
	
	/**
	 * Manager::_initCacheInfo()
	 * Loads some info on the first call only
	 * 
	 * @param	string	$what	'installedPlugins'
	 * @return	void
	 */
	private function _initCacheInfo($what)
	{
		if ( array_key_exists($what, $this->cachedInfo)
		  && is_array($this->cachedInfo[$what]) )
		{
			return;
		}
		
		switch ($what)
		{
			// 'installedPlugins' = array ($pid => $name)
			case 'installedPlugins':
				$this->cachedInfo['installedPlugins'] = array();
				$res = DB::getResult('SELECT pid, pfile FROM ' . sql_table('plugin'));
				foreach ( $res as $row )
				{
					$this->cachedInfo['installedPlugins'][$row['pid']] = $row['pfile'];
				}
				break;
		}
		return;
	}
	
	/**
	 * Manager::notify()
	 * A function to notify plugins that something has happened. Only the plugins
	 * that are subscribed to the event will get notified.
	 * Upon the first call, the list of subscriptions will be fetched from the
	 * database. The plugins itsself will only get loaded when they are first needed
	 *
	 * @param	string	$eventName	Name of the event (method to be called on plugins)
	 * @param	string	$data		Can contain any type of data,
	 * 								depending on the event type. Usually this is an itemid, blogid, ...
	 * 								but it can also be an array containing multiple values
	 * @return	void
	 */
	public function notify($eventName, &$data)
	{
		// load subscription list if needed
		if ( !is_array($this->subscriptions) )
		{
			$this->_loadSubscriptions();
		}
		
		// get listening objects
		$listeners = false;
		if ( array_key_exists($eventName, $this->subscriptions)
		  && !empty($this->subscriptions[$eventName]) )
		{
			$listeners = $this->subscriptions[$eventName];
		}
		
		// notify all of them
		if ( is_array($listeners) )
		{
			foreach( $listeners as $listener )
			{
				// load class if needed
				$this->_loadPlugin($listener);
				
				// do notify (if method exists)
				if ( array_key_exists($listener, $this->plugins)
				  && !empty($this->plugins[$listener])
				  && method_exists($this->plugins[$listener], 'event_' . $eventName) )
				{
					call_user_func(array(&$this->plugins[$listener], 'event_' . $eventName), $data);
				}
			}
		}
		return;
	}
	
	/**
	 * Manager::_loadSubscriptions()
	 * Loads plugin subscriptions
	 * 
	 * @param	void
	 * @return	void
	 */
	private function _loadSubscriptions()
	{
		// initialize as array
		$this->subscriptions = array();
		
		$query = "SELECT p.pfile as pfile, e.event as event"
		       . " FROM %s as e, %s as p"
		       . " WHERE e.pid=p.pid ORDER BY p.porder ASC";
		$query = sprintf($query, sql_table('plugin_event'), sql_table('plugin'));
		$res = DB::getResult($query);
		
		foreach ( $res as $row )
		{
			$pluginName = $row['pfile'];
			$eventName = $row['event'];
			$this->subscriptions[$eventName][] = $pluginName;
		}
		return;
	}
	
	/**
	 * Manager::getNumberOfSubscribers()
	 * 
	 * @param	string	$event	name of events
	 * @return	integer	number of event subscriber
	 */
	public function getNumberOfSubscribers($event)
	{
		$query = 'SELECT COUNT(*) as count FROM %s WHERE event=%s;';
		$query = sprintf($query, sql_table('plugin_event'), DB::quoteValue($event));
		return (integer) DB::getValue($query);
	}
	
	/**
	 * Manager::addTicketToUrl()
	 * GET requests: Adds ticket to URL (URL should NOT be html-encoded!, ticket is added at the end)
	 * 
	 * @param	string	url	string for URI
	 * @return	void
	 */
	public function addTicketToUrl($url)
	{
		$ticketCode = 'ticket=' . $this->_generateTicket();
		if ( i18n::strpos($url, '?') === FALSE )
		{
			$ticketCode = "{$url}?{$ticketCode}";
		}
		else
		{
			$ticketCode = "{$url}&{$ticketCode}";
		}
		return $ticketCode;
	}
	
	/**
	 * Manager::addTicketHidden()
	 * POST requests: Adds ticket as hidden formvar
	 * 
	 * @param	void
	 * @return	void
	 */
	public function addTicketHidden()
	{
		$ticket = $this->_generateTicket();
		echo '<input type="hidden" name="ticket" value="', Entity::hsc($ticket), '" />';
		return;
	}
	
	/**
	 * Manager::getNewTicket()
	 * Get a new ticket
	 * (xmlHTTPRequest AutoSaveDraft uses this to refresh the ticket)
	 * 
	 * @param	void
	 * @return	string	string of ticket
	 */
	public function getNewTicket()
	{
		$this->currentRequestTicket = '';
		return $this->_generateTicket();
	}
	
	/**
	 * Manager::checkTicket()
	 * Checks the ticket that was passed along with the current request
	 * 
	 * @param	void
	 * @return	boolean	correct or not
	 */
	public function checkTicket()
	{
		global $member;
		
		// get ticket from request
		$ticket = requestVar('ticket');
		
		// no ticket -> don't allow
		if ( $ticket == '' )
		{
			return FALSE;
		}
		
		// remove expired tickets first
		$this->_cleanUpExpiredTickets();
		
		// get member id
		if (!$member->isLoggedIn())
		{
			$memberId = -1;
		}
		else
		{
			$memberId = $member->getID();
		}
		
		// check if ticket is a valid one
		$query = sprintf('SELECT COUNT(*) as result FROM %s WHERE member=%d and ticket=%s',
			sql_table('tickets'),
			intval($memberId),
			DB::quoteValue($ticket)
		);
		
		/*
		 * NOTE:
		 * [in the original implementation, the checked ticket was deleted. This would lead to invalid
		 * tickets when using the browsers back button and clicking another link/form
		 * leaving the keys in the database is not a real problem, since they're member-specific and
		 * only valid for a period of one hour]
		 */
		if ( DB::getValue($query) != 1 )
		{
			return FALSE;
		}
		
		return TRUE;
	}

	/**
	 * Manager::_cleanUpExpiredTickets()
	 * Removes the expired tickets
	 * 
	 * @param	void
	 * @return	void
	 */
	private function _cleanUpExpiredTickets()
	{
		// remove tickets older than 1 hour
		$oldTime = time() - 60 * 60;
		$query = 'DELETE FROM %s WHERE ctime < %s';
		$query = sprintf($query, sql_table('tickets'), DB::formatDateTime($oldTime));
		DB::execute($query);
		return;
	}
	
	/**
	 * Manager::_generateTicket()
	 * Generates/returns a ticket (one ticket per page request)
	 * 
	 * @param	void
	 * @return	void
	 */
	private function _generateTicket()
	{
		if ( $this->currentRequestTicket == '' )
		{
			// generate new ticket (only one ticket will be generated per page request)
			// and store in database
			global $member;
			// get member id
			if ( !$member->isLoggedIn() )
			{
				$memberId = -1;
			}
			else
			{
				$memberId = $member->getID();
			}
			
			$ok = false;
			while ( !$ok )
			{
				// generate a random token
				srand((double)microtime()*1000000);
				$ticket = md5(uniqid(rand(), true));
				
				// add in database as non-active
				$query = 'INSERT INTO %s (ticket, member, ctime) VALUES (%s, %d, %s)';
				$query = sprintf($query, sql_table('tickets'), DB::quoteValue($ticket), (integer) $memberId, DB::formatDateTime());
				
				if ( DB::execute($query) !== FALSE )
				{
					$ok = true;
				}
			}
			$this->currentRequestTicket = $ticket;
		}
		return $this->currentRequestTicket;
	}
}

