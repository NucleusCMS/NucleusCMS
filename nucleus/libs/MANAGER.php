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
     * Cached ITEM, BLOG, PLUGIN, KARMA and MEMBER objects. When these objects
     * are requested through the global $manager object (getItem, getBlog,
     * ...), only the first call will create an object. Subsequent calls will
     * return the same object.
     *
     * The $items, $blogs, ... arrays map an id to an object (for plugins, the
     * name is used rather than an ID)
     */
    public array $items;
    public array $blogs;
    public array $plugins;
    public array $karma;
    public array $templates;
    public array $members;
    protected array $parserPrefs;

    /**
     * cachedInfo to avoid repeated SQL queries (see
     * pidInstalled/pluginInstalled/getPidFromName) e.g. which plugins exists?
     *
     * $cachedInfo['installedPlugins'] = array($pid -> $name)
     */
    public array $cachedInfo;

    /**
     * The plugin subscriptionlist
     *
     * The subcription array has the following structure
     *     $subscriptions[$EventName] = array containing names of plugin
     *     classes to be notified when that event happens
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
        static $instance = [];
        if (empty($instance)) {
            $instance[0] = new MANAGER();
        }

        return $instance[0];
    }

    /**
     * The constructor of this class initializes the object caches
     */
    public function __construct()
    {
        $this->items       = [];
        $this->blogs       = [];
        $this->plugins     = [];
        $this->karma       = [];
        $this->parserPrefs = [];
        $this->cachedInfo  = [];
    }

    /**
     * Returns the requested item object. If it is not in the cache, it will
     * first be loaded and then placed in the cache.
     * Intended use: $item =& $manager->getItem(1234)
     */
    public function &getItem($itemid, $allowdraft, $allowfuture)
    {
        return $this->getItemEx($itemid, $allowdraft, $allowfuture, 1);
    }

    /**
     * Returns one item with the specific itemid
     * Version [3.8 - ]
     *
     * @param integer $itemid         id of the item
     * @param boolean $allowdraft
     * @param boolean $allowfuture
     * @param boolean $enableitemterm
     *
     * @static
     */
    public function &getItemEx($itemid, $allowdraft, $allowfuture, $enableitemterm = 0)
    {
        $item = &$this->items[$itemid];

        // check the draft and future rules if the item was already cached
        if ($item) {
            if (( ! $allowdraft) && ($item['draft'])) {
                return 0;
            }

            $blog = &$this->getBlog(getBlogIDFromItemID($itemid));
            if (( ! $allowfuture)
                && ($item['timestamp'] > $blog->getCorrectTime())) {
                return 0;
            }
        }
        if ( ! $item) {
            // load class if needed
            $this->loadClass('ITEM');
            // load item object
            $item = ITEM::getitemEx(
                $itemid,
                $allowdraft,
                $allowfuture,
                $enableitemterm
            );
            $this->items[$itemid] = $item;
        }

        return $item;
    }

    /**
     * Loads a class if it has not yet been loaded
     */
    public static function loadClass($name)
    {
        self::_loadClass($name, $name . '.php');
    }

    /**
     * Checks if an item exists
     */
    public static function existsItem(?int $id, $future, $draft)
    {
        if ($id) {
            self::_loadClass('ITEM', 'ITEM.php');
            return ITEM::exists($id, $future, $draft);
        }
        return false;
    }

    /**
     * Checks if a category exists
     */
    public function existsCategory(?int $id)
    {
        if ($id) {
            return (quickQuery('SELECT COUNT(*) as result FROM '
                               . sql_table('category') . ' WHERE catid=' . (int) $id)
                    > 0);
        }
        return false;
    }

    /**
     * @param  int    $blogid
     * @return object Returns the blog object for a given blogid
     */
    public function &getBlog(?int $blogid): object
    {
        if ( ! empty($this->blogs[$blogid])) {
            $blog = &$this->blogs[$blogid];
        }
        if (empty($blog)) {
            // load class if needed
            $this->_loadClass('BLOG', 'BLOG.php');
            // load blog object
            $blog                 = new BLOG($blogid);
            $this->blogs[$blogid] = &$blog;
        }
        return $blog;
    }

    public function &getBlogByBlogName($blogname)
    {
        static $lists = [];
        // name => id
        if (isset($lists[$blogname])) {
            if ( ! $lists[$blogname]) {
                return $lists[$blogname];
            }
            $bid = $lists[$blogname];
            return $this->blogs[$bid];
        }

        $lists[$blogname] = false;
        $bid              = getBlogIDFromName($blogname);
        if ( ! $bid) {
            return $lists[$blogname];
        }
        if ($bid && isset($this->blogs[$bid])) {
            $lists[$blogname] = $bid;
            return $this->blogs[$bid];
        }
        // load class if needed
        $this->_loadClass('BLOG', 'BLOG.php');
        // load blog object
        $blog              = new BLOG($bid);
        $this->blogs[$bid] = &$blog;
        return $blog;
    }

    /**
     * Checks if a blog exists
     */
    public function existsBlog(?string $name): bool
    {
        if (empty($name)) {
            return false;
        }
        $this->_loadClass('BLOG', 'BLOG.php');
        return BLOG::exists($name);
    }

    /**
     * Checks if a blog id exists
     */
    public function existsBlogID(?int $id): bool
    {
        if ($id) {
            $this->_loadClass('BLOG', 'BLOG.php');
            return BLOG::existsID($id);
        }
        return false;
    }

    /**
     * Returns a previously read template
     */
    public function &getTemplate(string $templateName): array
    {
        $template = &$this->templates[$templateName];
        if ( ! $template) {
            $template                       = TEMPLATE::read($templateName);
            $this->templates[$templateName] = &$template;
        }
        return $template;
    }

    /**
     * Returns a KARMA object (karma votes)
     */
    public function &getKarma($itemid)
    {
        $karma = &$this->karma[$itemid];
        if ( ! $karma) {
            // load class if needed
            self::_loadClass('KARMA', 'KARMA.php');
            // create KARMA object
            $karma                = new KARMA($itemid);
            $this->karma[$itemid] = &$karma;
        }
        return $karma;
    }

    /**
     * Returns a MEMBER object
     */
    public function &getMember($memberid)
    {
        $mem = &$this->members[$memberid];
        if ( ! $mem) {
            // load class if needed
            $this->_loadClass('MEMBER', 'MEMBER.php');
            // create MEMBER object
            $mem                      = &MEMBER::createFromID($memberid);
            $this->members[$memberid] = &$mem;
        }
        return $mem;
    }

    /**
     * Set the global parser preferences
     */
    public function setParserProperty($name, $value)
    {
        $this->parserPrefs[$name] = $value;
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
     * private
     */
    public static function _loadClass($name, $filename)
    {
        if ( ! class_exists($name)) {
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
        $NP_Name = preg_replace('#[^a-z0-9_]+#i', '', $NP_Name);
        $success = false;
        try {
            $this->_loadPluginRaw($NP_Name);
            $success = class_exists($NP_Name);
        } catch (Error $e) {
            global $member, $CONF;
            if ($member && $member->isLoggedIn() && $member->isAdmin()) {
                $msg = sprintf(
                    "php critical error in plugin(%s):[%s] Line:%d (%s) : ",
                    $NP_Name,
                    $e::class,
                    $e->getLine(),
                    $e->getFile()
                );
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
        // See also getPluginListsFromDirName
        // check and force move to type2
        $res = self::getPluginTypePathWithForceRename($NP_Name); // false or ['type'=>, 'path'=>]
        if (false === $res) {
            if ( ! defined('_MANAGER_PLUGINFILE_NOTFOUND')) {
                define('_MANAGER_PLUGINFILE_NOTFOUND', 'Plugin %s was not loaded (File not found)');
            }
            SYSTEMLOG::addUnique(
                'error',
                'Error',
                sprintf(_MANAGER_PLUGINFILE_NOTFOUND, $NP_Name)
            );
            return 0;
        }
        $plugin_dir_type = $res['type'];
        $plugin_path     = $res['path'];

        if ( ! $this->checkifValidPluginBeforeLoad($plugin_path)) {
            return 0;
        }
        // load plugin
        include_once($plugin_path);

        // check if class exists (avoid errors in eval'd code)
        if ( ! class_exists($NP_Name)) {
            if ( ! defined('_MANAGER_PLUGINFILE_NOCLASS')) {
                define(
                    '_MANAGER_PLUGINFILE_NOCLASS',
                    "Plugin %s was not loaded (Class not found in file, possible parse error)"
                );
            }
            SYSTEMLOG::addUnique(
                'error',
                'Error',
                sprintf(_MANAGER_PLUGINFILE_NOCLASS, $NP_Name)
            );

            return 0;
        }

        // add to plugin array
        $this->plugins[$NP_Name] = new $NP_Name();

        // get plugid
        $this->plugins[$NP_Name]->plugid = $this->getPidFromName($NP_Name);

        // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
        if (is_object($this->plugins[$NP_Name])) {
            $o_plugin                   = $this->plugins[$NP_Name];
            $o_plugin->plugin_dir_type  = $plugin_dir_type;
            $o_plugin->plugin_admin_dir = "{$DIR_PLUGINS}{$shortname}/";
            $o_plugin->plugin_admin_url = CONF::asStrWithPathSlash('PluginURL') . "{$shortname}/";
            $o_plugin->setRootOwnDirPath("{$DIR_PLUGINS}{$shortname}/");
            $o_plugin->setRootOwnDirURL($o_plugin->plugin_admin_url);
        }

        if ( ! $this->checkIfOk_supportsFeature_onLoadPlugin($NP_Name)) {
            return 0;
        }

        // call init method
        $this->plugins[$NP_Name]->init();
    }

    public static function getPluginTypePathWithForceRename($NP_Name)
    {
        global $DIR_PLUGINS;

        // check and force move to type2
        $NP_Name   = preg_replace('#[^0-9a-z_]+#i', '', $NP_Name);
        $NP_Name   = 'NP_' . preg_replace('#^NP_#i', '', $NP_Name);
        $shortname = strtolower(preg_replace('#^NP_#', '', $NP_Name));

        // NOTE: MARKER_PLUGINS_FOLDER_FUEATURE
        // See also getPluginListsFromDirName
        // check and force move to type2
        $plugin_dir_type = 0;
        if (@is_file("{$DIR_PLUGINS}{$shortname}/{$NP_Name}.php")) {
            $plugin_dir_type = 2;
            $plugin_path     = "{$DIR_PLUGINS}{$shortname}/{$NP_Name}.php";
            $type1file       = "{$DIR_PLUGINS}{$NP_Name}.php";
            if (@is_file($type1file)) {
                if (@md5_file($plugin_path) === @md5_file($type1file)) {
                    //same file: remove
                    unlink($type1file);
                } else {
                    $ct = 0;
                    while ($ct < 1000) {
                        $ct++;
                        $f = "{$DIR_PLUGINS}{$shortname}/{$NP_Name}-({$ct}).php";
                        if (@is_file($f)) {
                            continue;
                        }
                        // Compare by timestamp
                        if (@filemtime($plugin_path) < @filemtime($type1file)) {
                            @rename($plugin_path, $f);
                            @rename($type1file, $plugin_path);
                        } else {
                            @rename($type1file, $f);
                        }
                        break;
                    }
                }
            }
        } elseif (@is_file("{$DIR_PLUGINS}{$NP_Name}.php")) {
            $plugin_dir_type = 1;
            $plugin_path     = "{$DIR_PLUGINS}{$NP_Name}.php";
            if ( ! @is_dir("{$DIR_PLUGINS}{$shortname}")) {
                @mkdir("{$DIR_PLUGINS}{$shortname}");
            }
            if (@is_dir("{$DIR_PLUGINS}{$shortname}")) {
                rename("{$DIR_PLUGINS}{$NP_Name}.php", "{$DIR_PLUGINS}{$shortname}/{$NP_Name}.php");
            }
            if (@is_file("{$DIR_PLUGINS}{$shortname}/{$NP_Name}.php")) {
                $plugin_dir_type = 2;
                $plugin_path     = "{$DIR_PLUGINS}{$shortname}/{$NP_Name}.php";
            }
        }
        if (0 === $plugin_dir_type) {
            return false;
        }
        return ['type' => $plugin_dir_type, 'path' => $plugin_path];
    }

    // valid ok true, not false
    public function checkifValidPluginBeforeLoad(string $NP_File, $noskip = false): bool
    {
        global $DB_DRIVER_NAME;
        if (empty($NP_File) || ! @is_file($NP_File)) {
            return false;
        }
        if ( ! $noskip && ! CONF::asBool('enable_plg_check_preload')) {
            return true;
        }
        $src = @file_get_contents($NP_File);
        if (false === $src
            || strlen($src) < 100
            || ! preg_match('#class\sNP_#', $src)
            || preg_match('#=\s*&\s*new\s+#is', $src)
            || preg_match('#\$[0-9\w_]+?\{[\d]+\}#is', $src)
        ) {
            return false;
        }
        $NP_Name = explode('.', basename($NP_File))[0];
        if (in_array($NP_Name, ['NP_StickyIt'])) {
            if (preg_match('#\s+do(?:Skin|Template)Var\(([^\)]+)\)#is', $src, $m)
                && substr_count($m[1], '$') > 1
            ) {
                $m = preg_replace('#[^\$,=]+#', '', $m[1]);
                $m = str_replace('$=', '', $m);
                $m = str_replace(',', '', $m);
                if (substr_count($m, '$') > 1) {
                    //var_dump(basename($NP_File), $m);
                    return false;
                }
            }
        }

        if ( ! str_contains($src, 'getTableList')) {
            return true;
        }

        // db check
        if ('sqlite' === $DB_DRIVER_NAME) {
            if ( ! str_contains($src, 'SqlApi_') && ! str_contains($src, 'sqlite')) {
                return false;
            }
            return true;
        }
        if (str_contains($src, 'SqlApi')) {
            return true;
        }
        //if (preg_match('#\s+mysql_[^\s]+\s*\(#', $src)) {
        //    return false;
        //}

        return true;
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
        global $DB_DRIVER_NAME;

        $tablelist = $this->plugins[$NP_Name]->getTableList();
        if (empty($tablelist)) {
            return true;
        }

        // check SqlApi
        //    DB       Standard SQL
        //    MySQL5  : - SQL:2008
        //    SQLite3 : SQL92
        // unload plugin if using non-mysql handler and plugin does not support it
        if (('mysql' != $DB_DRIVER_NAME)
            &&
            ! (
                $this->plugins[$NP_Name]->supportsFeature('SqlApi_'
                                                         . $DB_DRIVER_NAME)
               || $this->plugins[$NP_Name]->supportsFeature('SqlApi_SQL92')
            )
        ) {
            unset($this->plugins[$NP_Name]);
            $msg = sprintf(
                _MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT,
                $NP_Name,
                $DB_DRIVER_NAME
            );
            SYSTEMLOG::addUnique('error', 'Error', $msg);

            return 0;
        }

        return true;
    }

    /**
     * Returns a PLUGIN object
     */
    public function &getPlugin($name)
    {
        // retrieve the name of the plugin in the right capitalisation
        $name = $this->getUpperCaseName($name);
        // get the plugin
        $plugin = &$this->plugins[$name];
        if ( ! $plugin) {
            // load class if needed
            $this->_loadPlugin($name);
            $plugin = &$this->plugins[$name];
        }
        return $plugin;
    }

    public function &getPluginFromPid($pid)
    {
        $name = getPluginNameFromPid($pid);
        return $this->getPlugin((is_string($name) ? $name : ''));
    }

    /**
     * Checks if the given plugin IS loaded or not
     */
    public function &pluginLoaded($name)
    {
        $plugin = &$this->plugins[$name];
        return $plugin;
    }

    public function &pidLoaded($pid)
    {
        reset($this->plugins);
        foreach ($this->plugins as $plugin) {
            if ($pid != $plugin->getId()) {
                continue;
            }
            return $plugin;
        }
        $plugin = false;

        return $plugin;
    }

    /**
     * checks if the given plugin IS installed or not
     */
    public function pluginInstalled($name)
    {
        $this->_initCacheInfo('installedPlugins');
        return (-1 != $this->getPidFromName($name));
    }

    public function pidInstalled($pid)
    {
        $this->_initCacheInfo('installedPlugins');
        return ('' != $this->cachedInfo['installedPlugins'][$pid]);
    }

    public function getPidFromName($name)
    {
        $this->_initCacheInfo('installedPlugins');
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
    public function getUpperCaseName($name)
    {
        $this->_initCacheInfo('installedPlugins');
        foreach ($this->cachedInfo['installedPlugins'] as $pid => $pfile) {
            if (strtolower($pfile) == strtolower($name)) {
                return $pfile;
            }
        }
        return -1;
    }

    public function clearCachedInfo($what)
    {
        unset($this->cachedInfo[$what]);
    }

    public function initSqlCacheInfo($what, $query = '')
    {
        if (isset($this->cachedInfo[$what][$query])) {
            return;
        }

        switch ($what) {
            case 'sql_num_rows':
                $rs                                       = sql_query($query);
                $this->cachedInfo['sql_num_rows'][$query] = sql_num_rows($rs);
                break;
            case 'sql_fetch_object':
                $rs = sql_query($query);
                $obj
                                                              = sql_fetch_object($rs);
                $this->cachedInfo['sql_fetch_object'][$query] = is_object($obj)
                    ? $obj->result : '';
                break;
        }
    }

    /**
     * Loads some info on the first call only
     */
    public function _initCacheInfo($what)
    {
        if (isset($this->cachedInfo[$what])
            && is_array($this->cachedInfo[$what])) {
            return;
        }
        switch ($what) {
            // 'installedPlugins' = array ($pid => $name)
            case 'installedPlugins':
                $this->cachedInfo['installedPlugins'] = [];
                $res
                                                      = sql_query('SELECT pid, pfile FROM '
                                                                  . sql_table('plugin'));
                while ($o = sql_fetch_object($res)) {
                    $this->cachedInfo['installedPlugins'][$o->pid] = $o->pfile;
                }
                if (is_object($res) && is_a($res, 'PDOStatement')) {
                    $res->closeCursor();
                }
                unset($res);

                break;
        }
    }

    /**
     * A function to notify plugins that something has happened. Only the
     * plugins that are subscribed to the event will get notified. Upon the
     * first call, the list of subscriptions will be fetched from the database.
     * The plugins itsself will only get loaded when they are first needed
     *
     * @param $eventName
     *                   Name of the event (method to be called on plugins)
     * @param $data
     *                   Can contain any type of data, depending on the event type. Usually
     *                   this is an itemid, blogid, ... but it can also be an array
     *                   containing multiple values
     */
    public function notify($eventName, &$data)
    {
        global $member;
        // load subscription list if needed
        if ( ! is_array($this->subscriptions)) {
            $this->_loadSubscriptions();
        }

        // get listening objects
        $listeners = false;
        if (isset($this->subscriptions[$eventName])) {
            $listeners = $this->subscriptions[$eventName];
        }

        // notify all of them
        if ( ! is_array($listeners)) {
            return;
        }

        foreach ($listeners as $listener) {
            // load class if needed
            $this->_loadPlugin($listener);
            // do notify (if method exists)
            $event_funcname = 'event_' . $eventName;
            $has_plugin     = (isset($this->plugins[$listener])
                               && method_exists(
                                   $this->plugins[$listener],
                                   $event_funcname
                               ));

            try {
                if ($has_plugin) {
                    $this->plugins[$listener]->{$event_funcname}($data);
                }
                // can not catch : trigger_error('test error', E_USER_ERROR);
            } catch (Error $e) { // TypeError ParseError AssertionError
                if ($member && $member->isLoggedIn() && $member->isAdmin()) {
                    if (confVar('DebugVars')) {
                        var_dump($e->getMessage());
                        // $e->getTraceAsString
                    }
                    $msg = sprintf(
                        'php error in plugin %s::%s:[%s] Line:%d (%s) : %s',
                        $this->plugins[$listener]->getClassName(),
                        $event_funcname,
                        $e::class,
                        $e->getLine(),
                        $e->getFile(),
                        $e->getMessage()
                    );
                    SYSTEMLOG::addUnique('error', 'Error', $msg);
                }
                if (confVar('debug')) {
                    throw $e; // return exception
                }
            }
        }
    }

    /**
     * Loads plugin subscriptions
     */
    public function _loadSubscriptions()
    {
        // initialize as array
        $this->subscriptions = [];

        $res = sql_query(
            sprintf(
                'SELECT p.pfile as pfile, e.event as event FROM %s as e, %s as p WHERE e.pid=p.pid ORDER BY p.porder ASC',
                sql_table('plugin_event'),
                sql_table('plugin')
            )
        );
        if ( ! $res) {
            return;
        }
        while ($o = sql_fetch_object($res)) {
            $pluginName                        = $o->pfile;
            $eventName                         = $o->event;
            $this->subscriptions[$eventName][] = $pluginName;
        }
    }

    /*
        Ticket functions. These are uses by the admin area to make it impossible to simulate certain GET/POST
        requests. tickets are user specific
    */

    public $currentRequestTicket = '';

    /**
     * GET requests: Adds ticket to URL (URL should NOT be html-encoded!,
     * ticket is added at the end)
     */
    public function addTicketToUrl($url)
    {
        $ticketCode = 'ticket=' . $this->_generateTicket();
        $join       = (str_contains($url, '?')) ? '&' : '?';

        return $url . $join . $ticketCode;
    }

    /**
     * POST requests: Adds ticket as hidden formvar
     */
    public function addTicketHidden()
    {
        echo $this->getHtmlInputTicketHidden();
    }

    public function getHtmlInputTicketHidden()
    {
        $ticket = $this->_generateTicket();

        return sprintf(
            '<input type="hidden" name="ticket" value="%s" />',
            hsc($ticket)
        );
    }

    /**
     * Get a new ticket
     * (xmlHTTPRequest AutoSaveDraft uses this to refresh the ticket)
     */
    public function getNewTicket()
    {
        $this->currentRequestTicket = '';
        return $this->_generateTicket();
    }

    /**
     * Checks the ticket that was passed along with the current request
     */
    public function checkTicket()
    {
        global $member;
        // get ticket from request
        $ticket = requestVar('ticket');
        // no ticket -> don't allow
        if ('' == $ticket) {
            return false;
        }

        // remove expired tickets first
        $this->_cleanUpExpiredTickets();
        // get member id
        if ( ! $member->isLoggedIn()) {
            $memberId = -1;
        } else {
            $memberId = $member->getID();
        }

        // check if ticket is a valid one
        $query = sprintf(
            "SELECT COUNT(*) as result FROM %s WHERE member=%d AND ticket='%s'",
            sql_table('tickets'),
            (int) $memberId,
            sql_real_escape_string($ticket)
        );

        return 1 == quickQuery($query);
    }

    /**
     * (internal method) Removes the expired tickets
     */
    public function _cleanUpExpiredTickets()
    {
        // remove tickets older than 24 hour
        $oldTime    = time() - 60 * 60 * 1;
        $oldTimeMem = time() - 60 * 60 * 24;
        $table      = sql_table('tickets');
        $query      = "DELETE FROM `{$table}` WHERE "
                . sprintf(" (member <= 0 AND ctime < '%s')", gmdate('Y-m-d H:i:s', $oldTime))
                . sprintf(" OR (member > 0 AND ctime < '%s')", gmdate('Y-m-d H:i:s', $oldTimeMem));
        sql_query($query);
    }

    /**
     * (internal method) Generates/returns a ticket (one ticket per page request)
     */
    public function _generateTicket()
    {
        if ('' == $this->currentRequestTicket) {
            // generate new ticket (only one ticket will be generated per page request)
            // and store in database
            global $member;
            // get member id
            if ( ! $member->isLoggedIn()) {
                $memberId = -1;
            } else {
                $memberId = $member->getID();
            }

            $max_try = 3;
            // max times for try save data .
            while ($max_try > 0) {
                $max_try--;
                // generate a random token
                mt_srand((int) ((float) microtime() * 1000000));
                $ticket = md5(uniqid((string) mt_rand(), true));
                // add in database as non-active
                $query = 'INSERT INTO ' . sql_quote_identifier(sql_table('tickets'))
                        . ' (ticket, member, ctime) '
                        . "VALUES (? , ? , ?);";
                $params = [ $ticket, $memberId, gmdate('Y-m-d H:i:s', time()) ];
                $stmt   = sql_prepare_execute($query, $params);
                if ($stmt) {
                    unset($stmt);
                    break;
                }
                unset($stmt);
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
