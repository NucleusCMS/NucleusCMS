<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * This class makes sure each item/weblog/comment object gets requested from
 * the database only once, by keeping them in a cache. The class also acts as
 * a dynamic classloader, loading classes _only_ when they are first needed,
 * hoping to diminish execution time
 *
 * The class is a singleton, meaning that there will be only one object of it
 * active at all times. The object can be requested using MANAGER::instance()
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class MANAGER
{
    /**
     * Cached ITEM, BLOG, PLUGIN, KARMA and MEMBER objects. When these objects are requested
     * through the global $manager object (getItem, getBlog, ...), only the first call
     * will create an object. Subsequent calls will return the same object.
     *
     * The $items, $blogs, ... arrays map an id to an object (for plugins, the name is used
     * rather than an ID)
     */
    public $items;
    public $blogs;
    public $plugins;
    public $karma;
    public $templates;
    public $members;

    /**
     * cachedInfo to avoid repeated SQL queries (see pidInstalled/pluginInstalled/getPidFromName)
     * e.g. which plugins exists?
     *
     * $cachedInfo['installedPlugins'] = array($pid -> $name)
     */
    public $cachedInfo;

    /**
     * The plugin subscriptionlist
     *
     * The subcription array has the following structure
     *     $subscriptions[$EventName] = array containing names of plugin classes to be
     *                                  notified when that event happens
     */
    public $subscriptions;

    /**
     * Returns the only instance of this class. Creates the instance if it
     * does not yet exists. Users should use this function as
     * $manager =& MANAGER::instance(); to get a reference to the object
     * instead of a copy
     */
    public static function &instance()
    {
        static $instance = array();
        if (empty($instance)) {
            $instance[0] = new MANAGER();
        }
        return $instance[0];
    }

    /**
     * The constructor of this class initializes the object caches
     */
    function __construct()
    {
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
    function &getItem($itemid, $allowdraft, $allowfuture)
    {
        $item =& $this->items[$itemid];

        // check the draft and future rules if the item was already cached
        if ($item) {
            if ((!$allowdraft) && ($item['draft'])) {
                return 0;
            }

            $blog =& $this->getBlog(getBlogIDFromItemID($itemid));
            if ((!$allowfuture) && ($item['timestamp'] > $blog->getCorrectTime())) {
                return 0;
            }
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
    function loadClass($name)
    {
        $this->_loadClass($name, $name . '.php');
    }

    /**
     * Checks if an item exists
     */
    function existsItem($id, $future, $draft)
    {
        $this->_loadClass('ITEM', 'ITEM.php');
        return ITEM::exists($id, $future, $draft);
    }

    /**
     * Checks if a category exists
     */
    function existsCategory($id)
    {
        return (quickQuery('SELECT COUNT(*) as result FROM ' . sql_table('category') . ' WHERE catid=' . intval($id)) > 0);
    }

    /**
     * Returns the blog object for a given blogid
     */
    function &getBlog($blogid)
    {
        $blog =& $this->blogs[$blogid];

        if (!$blog) {
            // load class if needed
            $this->_loadClass('BLOG', 'BLOG.php');
            // load blog object
            $blog = new BLOG($blogid);
            $this->blogs[$blogid] =& $blog;
        }
        return $blog;
    }

    /**
     * Checks if a blog exists
     */
    function existsBlog($name)
    {
        $this->_loadClass('BLOG', 'BLOG.php');
        return BLOG::exists($name);
    }

    /**
     * Checks if a blog id exists
     */
    function existsBlogID($id)
    {
        $this->_loadClass('BLOG', 'BLOG.php');
        return BLOG::existsID($id);
    }

    /**
     * Returns a previously read template
     */
    function &getTemplate($templateName)
    {
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
    function &getKarma($itemid)
    {
        $karma =& $this->karma[$itemid];

        if (!$karma) {
            // load class if needed
            $this->_loadClass('KARMA', 'KARMA.php');
            // create KARMA object
            $karma = new KARMA($itemid);
            $this->karma[$itemid] =& $karma;
        }
        return $karma;
    }

    /**
     * Returns a MEMBER object
     */
    function &getMember($memberid)
    {
        $mem =& $this->members[$memberid];

        if (!$mem) {
            // load class if needed
            $this->_loadClass('MEMBER', 'MEMBER.php');
            // create MEMBER object
            $mem =& MEMBER::createFromID($memberid);
            $this->members[$memberid] =& $mem;
        }
        return $mem;
    }

    /**
     * Set the global parser preferences
     */
    function setParserProperty($name, $value)
    {
        $this->parserPrefs[$name] = $value;
    }

    /**
     * Get the global parser preferences
     */
    function getParserProperty($name)
    {
        return $this->parserPrefs[$name];
    }

    /**
     * A helper function to load a class
     *
     * private
     */
    function _loadClass($name, $filename)
    {
        if (!class_exists($name)) {
            global $DIR_LIBS;
            include_once($DIR_LIBS . $filename);
        }
    }

    /**
     * A helper function to load a plugin
     *
     * private
     */
    private function _loadPlugin($NP_Name)
    {
        if (!HAS_CATCH_ERROR) {
            $this->_loadPluginRaw($NP_Name);
            return class_exists($NP_Name);
        }
        return $this->_loadPluginTry($NP_Name);
    }

    private function _loadPluginTry($NP_Name)
    {
        $success = false;
        try {
            $this->_loadPluginRaw($NP_Name);
            $success = class_exists($NP_Name);
        } catch (Error $e) {
            global $member, $CONF;
            if ($member && $member->isLoggedIn() && $member->isAdmin()) {
                $msg = sprintf("php critical error in plugin(%s):[%s] Line:%d (%s) : ",
                    $NP_Name, get_class($e), $e->getLine(), $e->getFile());
                if ($CONF['DebugVars']) {
                    var_dump($e->getMessage());
                    // $e->getTraceAsString
                }
                SYSTEMLOG::addUnique('error', 'Error', $msg . $e->getMessage());
            }
        }
        return $success;
    }

    private function _loadPluginRaw($NP_Name)
    {
        if (class_exists($NP_Name)) {
            return;
        }

        global $DIR_PLUGINS;

        $shortname = strtolower(preg_replace('#^NP_#', '', $NP_Name));

        // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
        $plugin_dir_type = 0;
        $_ = array(
            'NP_Name/NP_Name.php' => "{$NP_Name}/{$NP_Name}.php"
        ,
            'NP_Name.php' => "{$NP_Name}.php"
        ,
            'shortname/NP_Name.php' => "{$shortname}/{$NP_Name}.php"
        );
        $plugin_path = false;
        foreach ($_ as $key => $f) {
            $f = $DIR_PLUGINS . $f;
            if (is_file($f)) {
                $plugin_path = $f;

                if ($key === 'NP_Name/NP_Name.php') {
                    if (is_dir(dirname($f) . "/{$shortname}")) {
                        $plugin_dir_type = 21;
                    } else {
                        $plugin_dir_type = 22;
                    }
                } elseif ($key === 'shortname/NP_Name.php') {
                    if (is_dir(dirname($f) . "/{$shortname}")) {
                        $plugin_dir_type = 11;
                    } else {
                        $plugin_dir_type = 12;
                    }
                } elseif ($key === 'NP_Name.php') {
                    $plugin_dir_type = 1;
                } else {
                    $plugin_path = false;
                }  // ?

                break;
            }
        }

        if (!$plugin_path) {
            if (!defined('_MANAGER_PLUGINFILE_NOTFOUND')) {
                define('_MANAGER_PLUGINFILE_NOTFOUND', 'Plugin %s was not loaded (File not found)');
            }
            SYSTEMLOG::addUnique('error', 'Error', sprintf(_MANAGER_PLUGINFILE_NOTFOUND, $NP_Name));
            return 0;
        }

        // load plugin
        @include($plugin_path);

        // check if class exists (avoid errors in eval'd code)
        if (!class_exists($NP_Name)) {
            if (!defined('_MANAGER_PLUGINFILE_NOCLASS')) {
                define('_MANAGER_PLUGINFILE_NOCLASS',
                    "Plugin %s was not loaded (Class not found in file, possible parse error)");
            }
            SYSTEMLOG::addUnique('error', 'Error', sprintf(_MANAGER_PLUGINFILE_NOCLASS, $NP_Name));
            return 0;
        }

        // add to plugin array
        $this->plugins[$NP_Name] = new $NP_Name();

        // get plugid
        $this->plugins[$NP_Name]->plugid = $this->getPidFromName($NP_Name);

        // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
        if (is_object($this->plugins[$NP_Name])) {
            $o_plugin = $this->plugins[$NP_Name];
            $o_plugin->plugin_dir_type = $plugin_dir_type;
            switch ($plugin_dir_type) {
                case 1: // NP_*.php              , shortname/
                    $o_plugin->plugin_admin_dir = $DIR_PLUGINS . $o_plugin->getShortName() . '/';
                    $o_plugin->plugin_admin_url_prefix = '';
                    break;
                case 11: // shortname/NP_*.php    , shortname/
                    $o_plugin->plugin_admin_dir = $DIR_PLUGINS . $o_plugin->getShortName() . '/';
                    $o_plugin->plugin_admin_url_prefix = '';
                    break;
                case 12: // shortname/NP_*.php    , shortname/shortname/
                    $o_plugin->plugin_admin_dir = dirname($plugin_path) . '/' . $o_plugin->getShortName() . '/';
                    $o_plugin->plugin_admin_url_prefix = $o_plugin->getShortName() . '/';
                    break;
                case 21: // NP_*/NP_*.php         , NP_*/shortname/
                    $o_plugin->plugin_admin_dir = dirname($plugin_path) . '/' . $o_plugin->getShortName() . '/';
                    $o_plugin->plugin_admin_url_prefix = $NP_Name . '/';
                    break;
                case 22: // NP_*/NP_*.php        , NP_*/
                    $o_plugin->plugin_admin_dir = dirname($plugin_path) . '/';
                    $o_plugin->plugin_admin_url_prefix = $NP_Name . '/';
                    break;
            }
        }

        if (!$this->checkIfOk_supportsFeature_onLoadPlugin($NP_Name)) {
            return 0;
        }

        // call init method
        $this->plugins[$NP_Name]->init();
    }

    private function checkIfOk_supportsFeature_onLoadPlugin($NP_Name)
    {
        global $DB_DRIVER_NAME;
        $flag = true;
        if ('mysql' != $DB_DRIVER_NAME) {
            $flag = $this->checkIfOk_supportsFeature_db($NP_Name);
        }
        return $flag;
    }

    private function checkIfOk_supportsFeature_db($NP_Name)
    {
        global $DB_PREFIX, $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;

        $tablelist = $this->plugins[$NP_Name]->getTableList();
        if (empty($tablelist)) {
            return true;
        }

        // check SqlApi
        if ($DB_PHP_MODULE_NAME == 'pdo') {
//                         DB       Standard SQL
//                        MySQL5  : - SQL:2008
//                        SQLite3 : SQL92
            // unload plugin if using non-mysql handler and plugin does not support it
            if (('mysql' != $DB_DRIVER_NAME)
                &&
                !($this->plugins[$NP_Name]->supportsFeature('SqlApi_' . $DB_DRIVER_NAME)
                    || $this->plugins[$NP_Name]->supportsFeature('SqlApi_SQL92')
                )
            ) {
                unset($this->plugins[$NP_Name]);
                $msg = sprintf(_MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT, $NP_Name, $DB_DRIVER_NAME);
                SYSTEMLOG::addUnique('error', 'Error', $msg);
                return 0;
            }
        } // end : plugin uses DB query

        return true;
    }

    /**
     * Returns a PLUGIN object
     */
    function &getPlugin($name)
    {
        // retrieve the name of the plugin in the right capitalisation
        $name = $this->getUpperCaseName($name);
        // get the plugin   
        $plugin =& $this->plugins[$name];

        if (!$plugin) {
            // load class if needed
            $this->_loadPlugin($name);
            $plugin =& $this->plugins[$name];
        }
        return $plugin;
    }

    function &getPluginFromPid($pid)
    {
        $name = getPluginNameFromPid($pid);
        return $this->getPlugin((is_string($name) ? $name : ''));
    }

    /**
     * Checks if the given plugin IS loaded or not
     */
    function &pluginLoaded($name)
    {
        $plugin =& $this->plugins[$name];
        return $plugin;
    }

    function &pidLoaded($pid)
    {
        $plugin = false;
        reset($this->plugins);
        while (list($name) = each($this->plugins)) {
            if ($pid != $this->plugins[$name]->getId()) {
                continue;
            }
            $plugin = &$this->plugins[$name];
            break;
        }
        return $plugin;
    }

    /**
     * checks if the given plugin IS installed or not
     */
    function pluginInstalled($name)
    {
        $this->_initPluginCacheInfo();
        return ($this->getPidFromName($name) != -1);
    }

    function pidInstalled($pid)
    {
        $this->_initPluginCacheInfo();
        return ($this->cachedInfo['installedPlugins'][$pid] != '');
    }

    function getPidFromName($name)
    {
        $this->_initPluginCacheInfo();
        foreach ($this->cachedInfo['installedPlugins'] as $pid => $pfile) {
            if (strtolower($pfile) == strtolower($name)) {
                return $pid;
            }
        }
        return -1;
    }

    /**
     * Retrieve the name of a plugin in the right capitalisation
     */
    function getUpperCaseName($name)
    {
        $this->_initPluginCacheInfo();
        foreach ($this->cachedInfo['installedPlugins'] as $pid => $pfile) {
            if (strtolower($pfile) == strtolower($name)) {
                return $pfile;
            }
        }
        return -1;
    }

    function clearCachedInfo($what)
    {
        unset($this->cachedInfo[$what]);
    }

    function initSqlCacheInfo($what, $query = '')
    {
        if (isset($this->cachedInfo[$what][$query])) {
            return;
        }

        switch ($what) {
            case 'sql_num_rows':
                $rs = sql_query($query);
                $this->cachedInfo['sql_num_rows'][$query] = sql_num_rows($rs);
                break;
            case 'sql_fetch_object':
                $rs = sql_query($query);
                $obj = sql_fetch_object($rs);
                $this->cachedInfo['sql_fetch_object'][$query] = is_object($obj) ? $obj->result : '';
                break;
        }
    }

    /**
     * Loads some info on the first call only
     */
    function _initPluginCacheInfo()
    {
        if (isset($this->cachedInfo['installedPlugins'])) {
            return;
        }

        $this->cachedInfo['installedPlugins'] = array();
        $res = sql_query('SELECT pid, pfile FROM ' . sql_table('plugin'));
        $this->cachedInfo['installedPlugins'] = array();
        while ($o = sql_fetch_object($res)) {
            $this->cachedInfo['installedPlugins'][$o->pid] = $o->pfile;
        }
    }

    /**
     * A function to notify plugins that something has happened. Only the plugins
     * that are subscribed to the event will get notified.
     * Upon the first call, the list of subscriptions will be fetched from the
     * database. The plugins itsself will only get loaded when they are first needed
     *
     * @param $eventName
     *     Name of the event (method to be called on plugins)
     * @param $data
     *     Can contain any type of data, depending on the event type. Usually this is
     *     an itemid, blogid, ... but it can also be an array containing multiple values
     */
    function notify($eventName, &$data)
    {
        global $member, $CONF;
        // load subscription list if needed
        if (!is_array($this->subscriptions)) {
            $this->_loadSubscriptions();
        }

        // get listening objects
        $listeners = false;
        if (isset($this->subscriptions[$eventName])) {
            $listeners = $this->subscriptions[$eventName];
        }

        // notify all of them
        if (is_array($listeners)) {
            foreach ($listeners as $listener) {
                // load class if needed
                $this->_loadPlugin($listener);
                // do notify (if method exists)
                $event_funcname = 'event_' . $eventName;
                if (!HAS_CATCH_ERROR) {
                    if (isset($this->plugins[$listener]) && method_exists($this->plugins[$listener], $event_funcname)) {
                        $this->plugins[$listener]->$event_funcname($data);
                    }
                } else {
                    try {
                        if (isset($this->plugins[$listener]) && method_exists($this->plugins[$listener],
                                $event_funcname)) {
                            $this->plugins[$listener]->{$event_funcname}($data);
                        }
                        // can not catch : trigger_error('test error', E_USER_ERROR);
                    } catch (Error $e) // TypeError ParseError AssertionError
                    {
                        if ($member && $member->isLoggedIn() && $member->isAdmin()) {
                            $msg = sprintf("php error in plugin %s::%s:",
                                    $this->plugins[$listener]->getName(), $event_funcname)
                                . sprintf("[%s] Line:%d (%s) : ", get_class($e), $e->getLine(), $e->getFile());
                            if (!empty($CONF['DebugVars']) && $CONF['DebugVars']) {
                                var_dump($e->getMessage());
                                // $e->getTraceAsString
                            }
                            SYSTEMLOG::addUnique('error', 'Error', $msg . $e->getMessage());
                        }
                        if (!empty($CONF['debug']) && $CONF['debug']) {
                            throw $e;
                        } // return exception
                    }
                }
            }
        }
    }

    /**
     * Loads plugin subscriptions
     */
    function _loadSubscriptions()
    {
        // initialize as array
        $this->subscriptions = array();

        $res = sql_query('SELECT p.pfile as pfile, e.event as event FROM ' . sql_table('plugin_event') . ' as e, ' . sql_table('plugin') . ' as p'
            . ' WHERE e.pid=p.pid ORDER BY p.porder ASC');
        if ($res) {
            while ($o = sql_fetch_object($res)) {
                $pluginName = $o->pfile;
                $eventName = $o->event;
                $this->subscriptions[$eventName][] = $pluginName;
            }
        }
    }

    /*
        Ticket functions. These are uses by the admin area to make it impossible to simulate certain GET/POST
        requests. tickets are user specific
    */

    public $currentRequestTicket = '';

    /**
     * GET requests: Adds ticket to URL (URL should NOT be html-encoded!, ticket is added at the end)
     */
    function addTicketToUrl($url)
    {
        $ticketCode = 'ticket=' . $this->_generateTicket();
        if (strstr($url, '?')) {
            return $url . '&' . $ticketCode;
        } else {
            return $url . '?' . $ticketCode;
        }
    }

    /**
     * POST requests: Adds ticket as hidden formvar
     */
    function addTicketHidden()
    {
        echo $this->getHtmlInputTicketHidden();
    }

    function getHtmlInputTicketHidden()
    {
        $ticket = $this->_generateTicket();
        return '<input type="hidden" name="ticket" value="' . htmlspecialchars($ticket) . '" />';
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
        if ($ticket == '') {
            return false;
        }

        // remove expired tickets first
        $this->_cleanUpExpiredTickets();

        // get member id
        if (!$member->isLoggedIn()) {
            $memberId = -1;
        } else {
            $memberId = $member->getID();
        }

        // check if ticket is a valid one
        $params = array(sql_table('tickets'), intval($memberId), sql_real_escape_string($ticket));
        $query = vsprintf("SELECT COUNT(*) as result FROM %s WHERE member=%s and ticket='%s'", $params);
        if (quickQuery($query) == 1) {
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
        $query = sprintf("DELETE FROM %s WHERE ctime < '%s'",
            sql_table('tickets'),
            date('Y-m-d H:i:s', $oldTime));
        sql_query($query);
    }

    /**
     * (internal method) Generates/returns a ticket (one ticket per page request)
     */
    function _generateTicket()
    {
        if ($this->currentRequestTicket == '') {
            // generate new ticket (only one ticket will be generated per page request)
            // and store in database
            global $member, $DB_PHP_MODULE_NAME;
            // get member id
            if (!$member->isLoggedIn()) {
                $memberId = -1;
            } else {
                $memberId = $member->getID();
            }

            $ok = false;
            while (!$ok) {
                // generate a random token
                srand((double)microtime() * 1000000);
                $ticket = md5(uniqid(mt_rand(), true));

                // add in database as non-active
                if ($DB_PHP_MODULE_NAME == 'pdo') {
                    $input_parameters = array((string)$ticket, intval($memberId), date('Y-m-d H:i:s', time()));
                    $query = sprintf('INSERT INTO `%s` (ticket, member, ctime) VALUES (?, ?, ?)', sql_table('tickets'));
                    if (sql_prepare_execute($query, $input_parameters)) {
                        break;
                    }
                } else {  // mysql driver
                    $params = array(
                        sql_table('tickets'),
                        sql_real_escape_string($ticket),
                        intval($memberId),
                        date('Y-m-d H:i:s', time())
                    );
                    $query = vsprintf("INSERT INTO `%s` (ticket, member, ctime) VALUES ('%s', '%s', '%s')", $params);
                    if (sql_query($query)) {
                        break;
                    }
                }
            }

            $this->currentRequestTicket = $ticket;
        }
        return $this->currentRequestTicket;
    }

// _getText
// Note: This function will may be specification change
// Note: use only core functions
// Notice: Do not call this function from user plugin
// return Converted text
    public function _getText($type, $text)
    {
        // MARKER_FEATURE_LOCALIZATION_SKIN_TEXT
        return SKIN::_getText($text);
    }

}
