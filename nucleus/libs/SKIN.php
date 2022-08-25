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
 * Class representing a skin
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

if (!function_exists('requestVar')) {
    exit;
}
require_once __DIR__ . '/ACTIONS.php';

class SKIN
{
    // after creating a SKIN object, evaluates to true when the skin exists
    public $isValid;

    // skin characteristics. Use the getXXX methods rather than accessing directly
    public $id;
    public $description;
    public $contentType;
    public $includeMode;        // either 'normal' or 'skindir'
    public $includePrefix;
    public $name;

    /**
     * Constructor for a new SKIN object
     *
     * @param $id
     *             id of the skin
     */
    public function __construct($id)
    {
        global $resultCache;

        $this->id = intval($id);

        // read skin name/description/content type
        $query = 'SELECT * FROM ' . sql_table('skin_desc') . " WHERE sdnumber='{$this->id}'";
        if (isset($resultCache[$query])) {
            $obj   = $resultCache[$query];
            $count = $resultCache["count{$query}"];
        } else {
            $res                          = sql_query($query);
            $obj                          = sql_fetch_object($res);
            $count                        = is_object($obj) ? 1 : 0;
            $resultCache[$query]          = $obj;
            $resultCache["count{$query}"] = $count;
        }
        $this->isValid = ($count > 0);
        if (!$this->isValid) {
            return;
        }

        $this->name          = $obj->sdname;
        $this->description   = $obj->sddesc;
        $this->contentType   = $obj->sdtype;
        $this->includeMode   = $obj->sdincmode;
        $this->includePrefix = $obj->sdincpref;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function getIncludeMode()
    {
        return $this->includeMode;
    }

    public function getIncludePrefix()
    {
        return $this->includePrefix;
    }

    /**
     * Checks if a skin with a given shortname exists
     * @param  string $name Skin short name
     * @return int    number of skins with the given ID
     * @static
     */
    public static function exists($name)
    {
        $query = sprintf(
            "SELECT count(*) AS result FROM `%s` WHERE sdname='%s'",
            sql_table('skin_desc'),
            sql_real_escape_string($name)
        );
        return intval(quickQuery($query)) > 0;
    }

    /**
     * Checks if a skin with a given ID exists
     * @param  string $id Skin ID
     * @return int    number of skins with the given ID
     * @static
     */
    public static function existsID($id)
    {
        return quickQuery('select COUNT(*) as result FROM ' . sql_table('skin_desc') . ' WHERE sdnumber=' . intval($id)) > 0;
    }

    public function existsSpecialName($name)
    {
        return self::existsSpecialPageName($this->id, $name);
    }

    public static function existsSpecialPartsName($skinid, $name)
    {
        return self::existsSpecialNameEx($skinid, $name, 'parts');
    }

    public static function existsSpecialPageName($skinid, $name)
    {
        return self::existsSpecialNameEx($skinid, $name, 'specialpage');
    }

    public static function existsSpecialNameEx($skinid, $name, $spartstype = 'specialpage')
    {
        global $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;

        $exp = '';
        if ($spartstype !== '') {
            $exp = sprintf(" AND spartstype = '%s'", ($spartstype == 'specialpage' ? 'specialpage' : 'parts'));
        }

        $sql = sprintf(
            "SELECT COUNT(*) AS result FROM `%s`  WHERE sdesc=%d ",
            sql_table('skin'),
            intval($skinid)
        ) . $exp;

        if ($DB_PHP_MODULE_NAME == 'pdo') {
            if (stripos('sqlite', $DB_DRIVER_NAME) !== false) {
                $sql .= " AND lower(stype) = ?";
            } else {
                $sql .= " AND stype = ?";
            }
        } else {
            $sql .= " AND stype = " . sql_quote_string($name);
        }

        $sql .= " LIMIT 1 ";

        if ($DB_PHP_MODULE_NAME == 'pdo') {
            $res = sql_prepare_execute($sql, array($name));
        } else {
            $res = sql_query($sql);
        }

        if ($res && ($o = sql_fetch_object($res))) {
            return (intval($o->result) > 0);
        }
        return false;
    }

    /**
     * Returns a skin given its shortname
     * @param  string $name Skin shortname
     * @return object SKIN
     * @static
     */
    public static function createFromName($name)
    {
        return new SKIN(SKIN::getIdFromName($name));
    }

    /**
     * Returns a skin ID given its shortname
     * @param  string $name Skin shortname
     * @return int    Skin ID
     * @static
     */
    public static function getIdFromName($name)
    {
        $query = sprintf(
            "SELECT sdnumber FROM `%s` WHERE sdname='%s'",
            sql_table('skin_desc'),
            sql_real_escape_string($name)
        );
        $res = sql_query($query);
        if ($res && ($obj = sql_fetch_object($res))) {
            return $obj->sdnumber;
        }
        return 0;
    }

    /**
     * Returns a skin shortname given its ID
     * @param  string $name
     * @return string Skin short name
     * @static
     */
    public static function getNameFromId($id)
    {
        return quickQuery('SELECT sdname as result FROM ' . sql_table('skin_desc') . ' WHERE sdnumber=' . intval($id));
    }

    /**
     * Creates a new skin, with the given characteristics.
     *
     * @static
     */
    public static function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
    {
        global $manager;

        $param = array(
            'name'          => &$name,
            'description'   => &$desc,
            'type'          => &$type,
            'includeMode'   => &$includeMode,
            'includePrefix' => &$includePrefix
        );
        $manager->notify('PreAddSkin', $param);

        sql_query('INSERT INTO ' . sql_table('skin_desc') . " (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('" . sql_real_escape_string($name) . "','" . sql_real_escape_string($desc) . "','" . sql_real_escape_string($type) . "','" . sql_real_escape_string($includeMode) . "','" . sql_real_escape_string($includePrefix) . "')");
        $newid = sql_insert_id();

        $param = array(
            'skinid'        => $newid,
            'name'          => $name,
            'description'   => $desc,
            'type'          => $type,
            'includeMode'   => $includeMode,
            'includePrefix' => $includePrefix
        );
        $manager->notify('PostAddSkin', $param);

        return $newid;
    }

    /**
     * Parse a SKIN
     *
     * @param string $type
     */
    public function parse($type, $options = array())
    {
        global $manager, $CONF, $skinid;

        $spartstype = (isset($options['spartstype']) ? $options['spartstype'] : 'parts');

        $notify_data = array(
            'skin'      => &$this,
            'type'      => $type,
            'partstype' => $spartstype
        );
        $manager->notify('InitSkinParse', $notify_data);
        $skinid = $this->id;

        // set output type
        sendContentType($this->getContentType(), 'skin', _CHARSET);

        // set skin name as global var (so plugins can access it)
        global $currentSkinName;
        $currentSkinName = $this->getName();

        $getcontents_options = array('spartstype' => $spartstype);
        $contents            = $this->getContent($type, $getcontents_options);

        if (!$contents) {
            if ($spartstype == 'specialpage') {
                doError(_ERROR_NOSUCHPAGE);
                echo _ERROR_NOSUCHPAGE;
                return;
            }
            // use base skin if this skin does not have contents
            $defskin  = new SKIN($CONF['BaseSkin']);
            $contents = $defskin->getContent($type, $getcontents_options);
            if (!$contents) {
                $contents = $this->getContent('index');
            }
            if (!$contents) {
                echo _ERROR_SKIN;
                return;
            }
        }

        $actions = $this->getAllowedActionsForType($type);

        $param = array(
            'skin'      => &$this,
            'type'      => $type,
            'contents'  => &$contents,
            'partstype' => $spartstype
        );
        $manager->notify('PreSkinParse', $param);
        $skinid = $this->id;

        // set IncludeMode properties of parser
        PARSER::setProperty('IncludeMode', $this->getIncludeMode());
        PARSER::setProperty('IncludePrefix', $this->getIncludePrefix());

        $handler = new ACTIONS($type, $this);
        $parser  = new PARSER($actions, $handler);
        $handler->setParser($parser);
        $handler->setSkin($this);

        ob_start();
        $parser->parse($contents);
        $output = ob_get_contents();
        @ob_clean();

        $md5['<%BenchMark%>'] = md5('<%BenchMark%>');
        if (strpos($output, $md5['<%BenchMark%>']) !== false) {
            $output = str_replace($md5['<%BenchMark%>'], '<%BenchMark%>', $output);
        }

        $md5['<%DebugInfo%>'] = md5('<%DebugInfo%>');
        if (strpos($output, $md5['<%DebugInfo%>']) !== false) {
            $output = str_replace($md5['<%DebugInfo%>'], '<%DebugInfo%>', $output);
        }

        $param = array(
            'skin'   => &$this,
            'type'   => $type,
            'output' => &$output
        );
        $manager->notify('PostSkinParse', $param);

        if (strpos($output, '<%BenchMark%>') !== false) {
            $rs     = coreSkinVar('<%BenchMark%>');
            $output = str_replace('<%BenchMark%>', $rs, $output);
        }
        if (strpos($output, '<%DebugInfo%>') !== false) {
            $rs     = coreSkinVar('<%DebugInfo%>');
            $output = str_replace('<%DebugInfo%>', $rs, $output);
        }

        $len_leak = ob_get_length();
        if (!empty($len_leak) && isDebugMode()) {
            global $member;
            if ($member->isAdmin() && ini_get('display_errors')) {
                $output .= ob_get_contents();
            }
        }
        ob_end_clean();

        $skinid = $this->id;
        return $output;
    }

    /**
     * Get content of the skin part from the database
     *
     * @param $type type of the skin (e.g. index, item, search ...)
     */
    public function getContent($type, $options = array())
    {
        global $DB_DRIVER_NAME, $CONF;
        if (strpos($type, '/') !== false) {
            return '';
        }
        if ('mysql' == $DB_DRIVER_NAME) {
            $query = sprintf(
                "SELECT scontent FROM %s WHERE sdesc=%d and stype='%s'",
                sql_table('skin'),
                $this->id,
                sql_real_escape_string($type)
            );
        } else {
            $query = sprintf(
                "SELECT scontent FROM %s WHERE sdesc=%d and lower(stype)='%s'",
                sql_table('skin'),
                $this->id,
                sql_real_escape_string(strtolower($type))
            );
        }

        $spartstype = 'parts';
        if ($options && isset($options['spartstype']) && (strlen($options['spartstype']) > 0)
            && (intval($CONF['DatabaseVersion']) >= 380)) {
            $spartstype = (string)$options['spartstype'];
            $query .= " AND spartstype = " . sql_quote_string($spartstype);
        }

        $res = sql_query($query);

        if (!$res || !($r = sql_fetch_array($res)) || empty($r)) { // Fix for PHP(-5.4) Parse error: empty($var = "")
            return '';
        }
        return $r[0];
    }

    /**
     * Updates the contents for one part of the skin in the database
     *
     * @param $type type of the skin part (e.g. index, item, search ...)
     * @param $content new content for this skin part
     */
    public function update($type, $content, $options = array())
    {
        $skinid = $this->id;

        $spartstype = 'parts';
        if ($options && isset($options['spartstype']) && (strlen($options['spartstype']) > 0)) {
            $spartstype = (string)$options['spartstype'];
        }

        // delete old thingie
        sql_query('DELETE FROM ' . sql_table('skin')
            . " WHERE stype='" . sql_real_escape_string($type) . "' and sdesc=" . intval($skinid)
            . " AND spartstype = " . sql_quote_string((string)$spartstype));

        global $SQL_DBH;
        // write new thingie
        if (strlen($content) > 0) {
            $sql = 'INSERT INTO ' . sql_table('skin') . "(scontent, stype, sdesc, spartstype) VALUES";
            if (!$SQL_DBH) { // $MYSQL_CONN && $DB_PHP_MODULE_NAME != 'pdo'
                $sql .= sprintf(
                    "('%s', '%s', %d, '%s')",
                    sql_real_escape_string($content),
                    sql_real_escape_string($type),
                    intval($skinid),
                    sql_real_escape_string($spartstype)
                );
                sql_query($sql);
            } else {
                sql_prepare_execute(
                    $sql . '(?, ?, ?, ?)',
                    array($content, $type, intval($skinid), (string)$spartstype)
                );
            }
        }

        global $resultCache, $manager;
        $resultCache = array();
        $manager->clearCachedInfo('sql_fetch_object');
    }

    /**
     * Deletes all skin parts from the database
     */
    public function deleteAllParts()
    {
        sql_query('DELETE FROM ' . sql_table('skin') . ' WHERE sdesc=' . $this->getID());
    }

    /**
     * Updates the general information about the skin
     */
    public function updateGeneralInfo($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '')
    {
        $query = 'UPDATE ' . sql_table('skin_desc') . ' SET'
            . " sdname='" . sql_real_escape_string($name) . "',"
            . " sddesc='" . sql_real_escape_string($desc) . "',"
            . " sdtype='" . sql_real_escape_string($type) . "',"
            . " sdincmode='" . sql_real_escape_string($includeMode) . "',"
            . " sdincpref='" . sql_real_escape_string($includePrefix) . "'"
            . " WHERE sdnumber=" . $this->getID();
        sql_query($query);

        global $resultCache, $manager;
        $resultCache = array();
        $manager->clearCachedInfo('sql_fetch_object');
    }

    /**
     * Get an array with the names of possible skin parts
     * Used to show all possible parts of a skin in the administration backend
     *
     * static: returns an array of friendly names
     */
    public static function getFriendlyNames()
    {
        $skintypes = array(
            'index'       => _SKIN_PART_MAIN,
            'item'        => _SKIN_PART_ITEM,
            'archivelist' => _SKIN_PART_ALIST,
            'archive'     => _SKIN_PART_ARCHIVE,
            'search'      => _SKIN_PART_SEARCH,
            'error'       => _SKIN_PART_ERROR,
            'member'      => _SKIN_PART_MEMBER,
            'imagepopup'  => _SKIN_PART_POPUP
        );

        $query = "SELECT stype FROM " . sql_table('skin')
            . " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
        $query .= " AND spartstype = 'parts'";
        $res = sql_query($query);
        while ($row = sql_fetch_array($res)) {
            $skintypes[strtolower($row['stype'])] = $row['stype'];
        }

        return $skintypes;
    }

    /**
     * Get the allowed actions for a skin type
     * returns an array with the allowed actions
     *
     * @param $type type of the skin (e.g. index, item, search ...)
     */
    public static function getAllowedActionsForType($type)
    {
        global $blogid;

        // some actions that can be performed at any time, from anywhere
        $defaultActions = array(
            'otherblog',
            'plugin',
            'version',
            'nucleusbutton',
            'include',
            'phpinclude',
            'parsedinclude',
            'loginform',
            'sitevar',
            'otherarchivelist',
            'otherarchivedaylist',
            'otherarchiveyearlist',
            'self',
            'adminurl',
            'todaylink',
            'archivelink',
            'member',
            'ifcat',                    // deprecated (Nucleus v2.0)
            'category',
            'searchform',
            'referer',
            'skinname',
            'skinfile',
            'set',
            'if',
            'else',
            'endif',
            'elseif',
            'ifnot',
            'elseifnot',
            'charset',
            'bloglist',
            'addlink',
            'addpopupcode',
            'sticky'
        );

        // extra actions specific for a certain skin type
        $extraActions = array();

        switch ($type) {
            case 'index':
                $extraActions = array(
                    'blog',
                    'blogsetting',
                    'preview',
                    'additemform',
                    'categorylist',
                    'archivelist',
                    'archivedaylist',
                    'archiveyearlist',
                    'nextlink',
                    'prevlink'
                );
                break;
            case 'archive':
                $extraActions = array(
                    'blog',
                    'archive',
                    'otherarchive',
                    'categorylist',
                    'archivelist',
                    'archivedaylist',
                    'archiveyearlist',
                    'blogsetting',
                    'archivedate',
                    'nextarchive',
                    'prevarchive',
                    'nextlink',
                    'prevlink',
                    'archivetype'
                );
                break;
            case 'archivelist':
                $extraActions = array(
                    'blog',
                    'archivelist',
                    'archivedaylist',
                    'archiveyearlist',
                    'categorylist',
                    'blogsetting',
                );
                break;
            case 'search':
                $extraActions = array(
                    'blog',
                    'archivelist',
                    'archivedaylist',
                    'archiveyearlist',
                    'categorylist',
                    'searchresults',
                    'othersearchresults',
                    'blogsetting',
                    'query',
                    'nextlink',
                    'prevlink'
                );
                break;
            case 'imagepopup':
                $extraActions = array(
                    'image',
                    'imagetext',                // deprecated (Nucleus v2.0)
                );
                break;
            case 'member':
                $extraActions = array(
                    'membermailform',
                    'blogsetting',
//                                'nucleusbutton'
                    'categorylist'
                );
                break;
            case 'item':
                $extraActions = array(
                    'blog',
                    'item',
                    'comments',
                    'commentform',
                    'vars',
                    'blogsetting',
                    'nextitem',
                    'previtem',
                    'nextlink',
                    'prevlink',
                    'nextitemtitle',
                    'previtemtitle',
                    'categorylist',
                    'archivelist',
                    'archivedaylist',
                    'archiveyearlist',
                    'itemtitle',
                    'itemid',
                    'itemlink',
                );
                break;
            case 'error':
                $extraActions = array(
                    'errormessage',
                    'categorylist'
                );
                break;
            default:
                if ($blogid && $blogid > 0) {
                    $extraActions = array(
                        'blog',
                        'blogsetting',
                        'preview',
                        'additemform',
                        'categorylist',
                        'archivelist',
                        'archivedaylist',
                        'archiveyearlist',
                        'nextlink',
                        'prevlink',
                        'membermailform',
//                        'nucleusbutton'
                        'categorylist'
                    );
                }
                break;
        }

        return array_merge($defaultActions, $extraActions);
    }

    public function changeSkinByName($name)
    {
        $id = $this->getIdFromName($name);
        return $this->changeSkinById($id);
    }

    public function changeSkinById($id)
    {
        $id = intval($id);

        if ($id > 0 && $this->id == $id) {
            return true;
        }

        if ($id <= 0 || !$this->existsID($id)) {
            return false;
        }

        // read skin name/description/content type
        $res = sql_query('SELECT * FROM ' . sql_table('skin_desc') . ' WHERE sdnumber=' . $id);
        $obj = sql_fetch_object($res);
        if (!is_object($obj)) {
            return false;
        }

        $this->isValid       = true;
        $this->id            = $id;
        $this->name          = $obj->sdname;
        $this->description   = $obj->sddesc;
        $this->contentType   = $obj->sdtype;
        $this->includeMode   = $obj->sdincmode;
        $this->includePrefix = $obj->sdincpref;
        return true;
    }

    public static function getRootURL()
    {
        global $CONF;
        return $CONF['SkinsURL'];
    }

    public function getURL()
    {
        global $CONF;
        return $CONF['SkinsURL'] . $this->includePrefix;
    }

// _getText
// Note: This function will may be specification change
// Note: use only core functions
// Notice: Do not call this function from user plugin
// return Converted text
    public static function _getText($text)
    {
        // MARKER_FEATURE_LOCALIZATION_SKIN_TEXT
        global $DIR_SKINS;
        static $cached_array = null;
        if (is_null($cached_array)) {
            $cached_array = array();
            if (!extension_loaded('SimpleXML')) {
                addToLog(DEBUG, 'Error: SimpleXML not loaded');
                return $text;
            }
            // skin for default
            $filename = $DIR_SKINS . 'default/skintext.xml';
            if (!is_file($filename)) {
                return $text;
            }
            $xml = simplexml_load_file($filename);

            if (!$xml || !method_exists($xml, 'children')) {
                return $text;
            }
            foreach ($xml->children() as $text_node) {
                if (!is_object($text_node) || !method_exists($text_node, 'getName')) {
                    return $text;
                }

                if ($text_node->getName() != 'text') {
                    continue;
                }
                $keyname = '';
                $items   = array();
                foreach ($text_node->children() as $node) {
                    $key   = $node->getName();
                    $value = (string)$node;
                    if ($key == 'key') {
                        $keyname = $value;
                    } else {
                        $items[$key] = $value;
                    }
                }
                if (!isset($items['default'])) {
                    $items['default'] = $keyname;
                }
                $keyname                = (function_exists('mb_strtolower') ? mb_strtolower($keyname, 'UTF-8') : strtolower($keyname));
                $cached_array[$keyname] = $items;
//                var_dump($keyname, $items);
            }
        }
        $key = strtolower($text);
        if (array_key_exists($key, $cached_array) && isset($cached_array[$key][_LOCALE])) {
            $subkey = _LOCALE;
            if (!isset($cached_array[$key][$subkey])) {
                if (!isset($cached_array[$key]['default'])) {
                    return $text;
                }
                $subkey = 'default';
            } else {
                if (_CHARSET == 'UTF-8') {
                    return $cached_array[$key][_LOCALE];
                }
            }
            if (!function_exists('mb_convert_encoding')) {
                return $text;
            }
            return mb_convert_encoding($cached_array[$key][$subkey], _CHARSET, 'UTF-8');
        }
        return $text; // not found
    }

 }
