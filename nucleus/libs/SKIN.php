<?php


/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
  * Copyright (C) 2002-2004 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * Class representing a skin
  *
  * $Id$
  */
class SKIN {

	// after creating a SKIN object, evaluates to true when the skin exists
	var $isValid;
	
	// skin characteristics. Use the getXXX methods rather than accessing directly
	var $id;
	var $description;
	var $contentType;
	var $includeMode;		// either 'normal' or 'skindir'
	var $includePrefix;
	var $name;
	
	function SKIN($id) {
		$this->id = intval($id);

		// read skin name/description/content type
		$res = sql_query('SELECT * FROM '.sql_table('skin_desc').' WHERE sdnumber=' . $this->id);
		$obj = mysql_fetch_object($res);
		$this->isValid = (mysql_num_rows($res) > 0);
		if (!$this->isValid)
			return;
			
		$this->name = $obj->sdname;
		$this->description = $obj->sddesc;
		$this->contentType = $obj->sdtype;
		$this->includeMode = $obj->sdincmode;
		$this->includePrefix = $obj->sdincpref;

	}
	
	function getID() {				return $this->id; }
	function getName() { 			return $this->name; }
	function getDescription() { 	return $this->description; }
	function getContentType() { 	return $this->contentType; }
	function getIncludeMode() { 	return $this->includeMode; }
	function getIncludePrefix() { 	return $this->includePrefix; }
	
	// returns true if there is a skin with the given shortname (static)
	function exists($name) {
		return quickQuery('select count(*) as result FROM '.sql_table('skin_desc').' WHERE sdname="'.addslashes($name).'"') > 0;
	}

	// returns true if there is a skin with the given ID (static)
	function existsID($id) {
		return quickQuery('select COUNT(*) as result FROM '.sql_table('skin_desc').' WHERE sdnumber='.intval($id)) > 0;
	}	
	
	// (static)
	function createFromName($name) {
		return new SKIN(SKIN::getIdFromName($name));
	}	
	
	// (static)
	function getIdFromName($name) {
		$query =  'SELECT sdnumber'
		       . ' FROM '.sql_table('skin_desc')
		       . ' WHERE sdname="'.addslashes($name).'"';
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);
		return $obj->sdnumber;	
	}
	
	// (static)
	function getNameFromId($id) {
		return quickQuery('SELECT sdname as result FROM '.sql_table('skin_desc').' WHERE sdnumber=' . intval($id));
	}
	
	/**
	 * Creates a new skin, with the given characteristics.
	 *
	 * (static)
	 */
	function createNew($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '') {
		global $manager;
		
		$manager->notify(
			'PreAddSkin',
			array(
				'name' => &$name,
				'description' => &$desc,
				'type' => &$type,
				'includeMode' => &$includeMode,
				'includePrefix' => &$includePrefix
			)
		);

		sql_query('INSERT INTO '.sql_table('skin_desc')." (sdname, sddesc, sdtype, sdincmode, sdincpref) VALUES ('" . addslashes($name) . "','" . addslashes($desc) . "','".addslashes($type)."','".addslashes($includeMode)."','".addslashes($includePrefix)."')");
		$newid = mysql_insert_id();
		
		$manager->notify(
			'PostAddSkin',
			array(
				'skinid' => $newid,
				'name' => $name,
				'description' => $desc,
				'type' => $type,
				'includeMode' => $includeMode,
				'includePrefix' => $includePrefix
			)
		);
		
		return $newid;
	}
	
	function parse($type) {
		global $manager, $CONF;

		// set output type
		sendContentType($this->getContentType(), 'skin', _CHARSET);

		// set skin name as global var (so plugins can access it)
		global $currentSkinName;
		$currentSkinName = $this->getName();

		$contents = $this->getContent($type);

		if (!$contents) {
			// use base skin if this skin does not have contents
			$defskin = new SKIN($CONF['BaseSkin']);
			$contents = $defskin->getContent($type);
			if (!$contents) {
				echo _ERROR_SKIN;
				return;
			}
		}

		$actions = $this->getAllowedActionsForType($type);

		$manager->notify('PreSkinParse',array('skin' => &$this, 'type' => $type));

		// set IncludeMode properties of parser
		PARSER::setProperty('IncludeMode',$this->getIncludeMode());
		PARSER::setProperty('IncludePrefix',$this->getIncludePrefix());

		$handler = new ACTIONS($type, $this);
		$parser = new PARSER($actions, $handler);
		$handler->setParser($parser);
		$handler->setSkin($this);
		$parser->parse($contents);

		$manager->notify('PostSkinParse',array('skin' => &$this, 'type' => $type));


	}

	function getContent($type) {
		$query = 'SELECT scontent FROM '.sql_table('skin')." WHERE sdesc=$this->id and stype='". addslashes($type) ."'";
		$res = sql_query($query);

		if (mysql_num_rows($res) == 0)
			return '';
		else
			return mysql_result($res, 0, 0);
	}

	/**
	 * Updates the contents of one part of the skin
	 */
	function update($type, $content) {
		$skinid = $this->id;
		$content = trim($content);

		// delete old thingie
		sql_query('DELETE FROM '.sql_table('skin')." WHERE stype='".addslashes($type)."' and sdesc=" . intval($skinid));

		// write new thingie
		if ($content) {
			sql_query('INSERT INTO '.sql_table('skin')." SET scontent='" . addslashes($content) . "', stype='" . addslashes($type) . "', sdesc=" . intval($skinid));
		}	
	}
	
	/**
	 * Deletes all skin parts from the database
	 */
	function deleteAllParts() {
		sql_query('DELETE FROM '.sql_table('skin').' WHERE sdesc='.$this->getID());
	}
	
	/**
	 * Updates the general information about the skin
	 */
	function updateGeneralInfo($name, $desc, $type = 'text/html', $includeMode = 'normal', $includePrefix = '') {
		$query =  'UPDATE '.sql_table('skin_desc').' SET'
		       . " sdname='" . addslashes($name) . "',"
		       . " sddesc='" . addslashes($desc) . "',"
		       . " sdtype='" . addslashes($type) . "',"
			   . " sdincmode='" . addslashes($includeMode) . "',"
			   . " sdincpref='" . addslashes($includePrefix) . "'"		       
		       . " WHERE sdnumber=" . $this->getID();
		sql_query($query);		
	}
	
	/**
	 * static: returns an array of friendly names
	 */
	function getFriendlyNames() {
		return array(
			'index' => _SKIN_PART_MAIN,
			'item' => _SKIN_PART_ITEM,
			'archivelist' => _SKIN_PART_ALIST,
			'archive' => _SKIN_PART_ARCHIVE,
			'search' => _SKIN_PART_SEARCH,
			'error' => _SKIN_PART_ERROR,
			'member' => _SKIN_PART_MEMBER,
			'imagepopup' => _SKIN_PART_POPUP
		);	
	}
	
	function getAllowedActionsForType($type) {
		// some actions that can be performed at any time, from anywhere
		$defaultActions = array('otherblog',
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
								'self',
								'adminurl',
								'todaylink',
								'archivelink',
								'member',
								'ifcat',					// deprecated (Nucleus v2.0)
								'category',
								'searchform',
								'referer',
								'skinname',
								'skinfile',
								'set',
								'if',
								'else',
								'endif'
								);
		
		// extra actions specific for a certain skin type
		$extraActions = array();

		switch ($type) {
			case 'index':
				$extraActions = array('blog', 
					            'blogsetting',
					            'preview',
					            'additemform',
								'categorylist',					            
					            'archivelist',
					            'archivedaylist',
					            'nextlink',
					            'prevlink'
					            );				
				break;
			case 'archive':
				$extraActions = array('blog',
								'archive',
								'otherarchive',
								'categorylist',								
								'archivelist',
					            'archivedaylist',								
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
				$extraActions = array('blog',
							    'archivelist',
								'archivedaylist',
								'categorylist',
							    'blogsetting',
							   );
				break;
			case 'search':
				$extraActions = array('blog',
								'archivelist',
					            'archivedaylist',
								'categorylist',
								'searchresults',
								'othersearchresults',
								'blogsetting',
								'query',
								'nextlink',
								'prevlink',
								'relevance',
								);
				break;
			case 'imagepopup':
				$extraActions = array('image',
								'imagetext',				// deprecated (Nucleus v2.0)
								);
				break;
			case 'member':
				$extraActions = array(
								'membermailform',
								'blogsetting',
								'nucleusbutton'
				);
				break;
			case 'item':
				$extraActions = array('blog',
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
							    'itemtitle',
							    'itemid',
							    'itemlink',
							    );
				break;
			case 'error':
				$extraActions = array(
								'errormessage'
				);
				break;
		}
		return array_merge($defaultActions, $extraActions);
	}
	
}


/*
 * This class contains the functions that get called by using
 * the special tags in the skins
 *
 * The allowed tags for a type of skinpart are defined by the 
 * SKIN::getAllowedActionsForType($type) method
 */
class ACTIONS extends BaseActions {

	// part of the skin currently being parsed ('index', 'item', 'archive',
	// 'archivelist', 'member', 'search', 'error', 'imagepopup')
	var $skintype;
	
	// contains an assoc array with parameters that need to be included when
	// generating links to items/archives/... (e.g. catid)	
	var $linkparams;
	
	// reference to the skin object for which a part is being parsed
	var $skin;
	

	// used when including templated forms from the include/ dir. The $formdata var 
	// contains the values to fill out in there (assoc array name -> value)
	var $formdata;
	

	// filled out with the number of displayed items after calling one of the 

	// (other)blog/(other)searchresults skinvars.

	var $amountfound;

	function ACTIONS($type) {
		// call constructor of superclass first
		$this->BaseActions();

		$this->skintype = $type;

		global $catid;
		if ($catid) 
			$this->linkparams = array('catid' => $catid);
	}

	function setSkin(&$skin) {
		$this->skin =& $skin;
	}
	
	function setParser(&$parser) {
		$this->parser =& $parser;
	}
	
	/*
		Forms get parsedincluded now, using an extra <formdata> skinvar
	*/
	function doForm($filename) {
		global $DIR_NUCLEUS;
		array_push($this->parser->actions,'formdata','text','callback','errordiv');
		$oldIncludeMode = PARSER::getProperty('IncludeMode');
		$oldIncludePrefix = PARSER::getProperty('IncludePrefix');
		PARSER::setProperty('IncludeMode','normal');
		PARSER::setProperty('IncludePrefix','');
		$this->parse_parsedinclude($DIR_NUCLEUS . 'forms/' . $filename . '.template');
		PARSER::setProperty('IncludeMode',$oldIncludeMode);
		PARSER::setProperty('IncludePrefix',$oldIncludePrefix);
		array_pop($this->parser->actions);		// errordiv
		array_pop($this->parser->actions);		// callback
		array_pop($this->parser->actions);		// text
		array_pop($this->parser->actions);		// formdata
	}
	function parse_formdata($what) {
		echo $this->formdata[$what];
	}
	function parse_text($which) {
		// constant($which) only available from 4.0.4 :(
		if (defined($which)) { 	
			eval("echo $which;");
		}
	}
	function parse_callback($eventName, $type)
	{
		global $manager;
		$manager->notify($eventName, array('type' => $type));
	}
	function parse_errordiv() {
		global $errormessage;
		if ($errormessage)
	  		echo '<div class="error">', htmlspecialchars($errormessage),'</div>';
	}
	
	function parse_skinname() {
		echo $this->skin->getName();
	}
	
	function parse_if($field, $name='', $value = '') {
		global $catid, $blog, $member, $itemidnext, $itemidprev, $manager;

		$condition = 0;
		switch($field) {
			case 'category':
				$condition = $blog->isValidCategory($catid);
				break;
			case 'blogsetting':
				$condition = ($blog->getSetting($name) == $value);
				break;
			case 'loggedin':
				$condition = $member->isLoggedIn();
				break;
			case 'onteam':
				$condition = $member->isLoggedIn() && $this->_ifOnTeam($name);
				break;
			case 'admin':
				$condition = $member->isLoggedIn() && $this->_ifAdmin($name);
				break;				
			case 'nextitem':
				$condition = ($itemidnext != '');
				break;
			case 'previtem':
				$condition = ($itemidprev != ''); 
				break;
			case 'skintype':
				$condition = ($name == $this->skintype);
				break;
			/*
				hasplugin,PlugName
					-> checks if plugin exists
				hasplugin,PlugName,OptionName
					-> checks if the option OptionName from plugin PlugName is not set to 'no'
				hasplugin,PlugName,OptionName=value
					-> checks if the option OptionName from plugin PlugName is set to value
			*/
		  	case 'hasplugin':
                $condition = false;
                $plugin =& $manager->getPlugin('NP_' . $name);
                if ($plugin != NULL){
                    if ($value == "") {
                        $condition = true;
                    } else {
                        list($name2, $value2) = explode('=', $value, 2);
                        if ($value2 == "" && $plugin->getOption($name2) != 'no') {
                            $condition = true;
                        } else if ($plugin->getOption($name2) == $value2) {
                            $condition = true;
                        }
                    }
                }
                break;				
			default:	
				return;
		}
		$this->_addIfCondition($condition);
	}
	
	function _ifOnTeam($blogName = '') {
		global $blog, $member, $manager;
		
		// when no blog found
		if (($blogName == '') && (!is_object($blog)))
			return 0;
		
		// explicit blog selection
		if ($blogName != '') 
			$blogid = getBlogIDFromName($blogName); 
		
		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $blog->getID();
			
		return $member->teamRights($blogid);
	}
	
	function _ifAdmin($blogName = '') {
		global $blog, $member, $manager;

		// when no blog found
		if (($blogName == '') && (!is_object($blog)))
			return 0;

		// explicit blog selection
		if ($blogName != '')
			$blogid = getBlogIDFromName($blogName);

		if (($blogName == '') || !$manager->existsBlogID($blogid))
			// use current blog
			$blogid = $blog->getID();

		return $member->isBlogAdmin($blogid);
	}	
	
	function parse_ifcat($text = '') {
		if ($text == '') {
			// new behaviour
			$this->parse_if('category');
		} else {
			// old behaviour
			global $catid, $blog;
			if ($blog->isValidCategory($catid))
				echo $text;
		}
	}
	
	// a link to the today page (depending on selected blog, etc...)
	function parse_todaylink($linktext = '') {
		global $blog, $CONF;
		if ($blog)
			echo $this->_link(createBlogidLink($blog->getID(),$this->linkparams), $linktext);
		else
			echo $this->_link($CONF['SiteUrl'], $linktext);
	}
	
	// a link to the archives for the current blog (or for default blog)
	function parse_archivelink($linktext = '') {
		global $blog, $CONF;
		if ($blog)
			echo $this->_link(createArchiveListLink($blog->getID(),$this->linkparams), $linktext);
		else
			echo $this->_link(createArchiveListLink(), $linktext);
	}

	// include itemid of prev item
	function parse_previtem() {
		global $itemidprev;
		echo $itemidprev;
	}

	// include itemtitle of prev item
	function parse_previtemtitle() {
		global $itemtitleprev;
		echo htmlspecialchars($itemtitleprev);
	}

	// include itemid of next item
	function parse_nextitem() {
		global $itemidnext;
		echo $itemidnext;
	}

	// include itemtitle of next item
	function parse_nextitemtitle() {
		global $itemtitlenext;
		echo htmlspecialchars($itemtitlenext);
	}

	function parse_prevarchive() {
		global $archiveprev;
		echo $archiveprev;
	}

	function parse_nextarchive() {
		global $archivenext;
		echo $archivenext;
	}

	function parse_archivetype() {
		global $archivetype;
		echo $archivetype;
	}

	function parse_prevlink($linktext = '', $amount = 10) {
		global $itemidprev, $archiveprev, $startpos;

		if ($this->skintype == 'item')
			$this->_itemlink($itemidprev, $linktext);
	    else if ($this->skintype == 'search' || $this->skintype == 'index')
	        $this->_searchlink($amount, $startpos, 'prev', $linktext);
		else
			$this->_archivelink($archiveprev, $linktext);
	}
	
	function parse_nextlink($linktext = '', $amount = 10) {
		global $itemidnext, $archivenext, $startpos;
		if ($this->skintype == 'item')
			$this->_itemlink($itemidnext, $linktext);
	    else if ($this->skintype == 'search' || $this->skintype == 'index')
	        $this->_searchlink($amount, $startpos, 'next', $linktext);
		else
			$this->_archivelink($archivenext, $linktext);
	}
	
	/**
	 * returns either
	 *		- a raw link (html/xml encoded) when no linktext is provided
	 *		- a (x)html <a href... link when a text is present (text htmlencoded)
	 */
	function _link($url, $linktext = '')
	{
		$u = htmlspecialchars($url);
		$u = preg_replace("/&amp;amp;/",'&amp;',$u); // fix URLs that already had encoded ampersands
		if ($linktext != '')
			$l = '<a href="' . $u .'">'.htmlspecialchars($linktext).'</a>';
		else
			$l = $u;
		return $l; 	
	}

	/**
	 * Outputs a next/prev link
	 *
	 * @param $maxresults
	 *		The maximum amount of items shown per page (e.g. 10)
	 * @param $startpos
	 *		Current start position (requestVar('startpos'))
	 * @param $direction
	 *		either 'prev' or 'next'
	 * @param $linktext
	 *		When present, the output will be a full <a href...> link. When empty,
	 *		only a raw link will be outputted
	 */
    function _searchlink($maxresults, $startpos, $direction, $linktext = '') {
        global $CONF, $blog, $query, $amount;
        // TODO: Move request uri to linkparams. this is ugly. sorry for that.
        $startpos	= intval($startpos);		// will be 0 when empty. 
        $parsed		= parse_url(serverVar('REQUEST_URI'));
        $parsed		= $parsed['query'];
		$url		= '';
        
        switch ($direction) {
            case 'prev':
                if ( intval($startpos) - intval($maxresults) >= 0) {
                    $startpos 	= intval($startpos) - intval($maxresults);
                    $url		= $CONF['SearchURL'].'?'.alterQueryStr($parsed,'startpos',$startpos);
                }
                break;
            case 'next':
                $iAmountOnPage = $this->amountfound;
                if ($iAmountOnPage == 0)
                {
                	// [%nextlink%] or [%prevlink%] probably called before [%blog%] or [%searchresults%]
                	// try a count query
                	switch ($this->skintype)
                	{
                		case 'index':
                			$sqlquery = $blog->getSqlBlog('', 'count');
                			break;
                		case 'search':
                			$sqlquery = $blog->getSqlSearch($query, $amount, $unused_highlight, 'count');
                			break;
                	}
                	if ($sqlquery) 
                		$iAmountOnPage = intval(quickQuery($sqlquery)) - intval($startpos);
                }
                if (intval($iAmountOnPage) >= intval($maxresults)) {
                	$startpos 	= intval($startpos) + intval($maxresults);                
                	$url		= $CONF['SearchURL'].'?'.alterQueryStr($parsed,'startpos',$startpos);
                }
                break;
            default:
                break;
        } // switch($direction)

		if ($url != '')
			echo $this->_link($url, $linktext);        
    }

	function _itemlink($id, $linktext = '') {
		global $CONF;
		if ($id)
			echo $this->_link(createItemLink($id, $this->linkparams), $linktext);
		else
			$this->parse_todaylink($linktext);
	}

	function _archivelink($id, $linktext = '') {
		global $CONF, $blog;
		if ($id)
			echo $this->_link(createArchiveLink($blog->getID(), $id, $this->linkparams), $linktext);
		else
			$this->parse_todaylink($linktext);
	}
	
	
	function parse_itemlink($linktext = '') {	
		$this->_itemlink($itemid, $linktext);
	}
	
	/**
	  * %archivedate(locale,date format)%
	  */
	function parse_archivedate($locale = '-def-') {
		global $archive;
		
		if ($locale == '-def-')
			setlocale(LC_TIME,$template['LOCALE']);
		else
			setlocale(LC_TIME,$locale);
		
		// get archive date
		sscanf($archive,'%d-%d-%d',$y,$m,$d);

		// get format		
		$args = func_get_args();
		// format can be spread over multiple parameters
		if (sizeof($args) > 1) {
			// take away locale
			array_shift($args);
			// implode
			$format=implode(',',$args);
		} elseif ($d == 0) {
			$format = '%B %Y';	
		} else {
			$format = '%d %B %Y';	
		}
		
		echo strftime($format,mktime(0,0,0,$m,$d?$d:1,$y));		
	}
	
	function parse_blog($template, $amount = 10, $category = '') {
		global $blog, $startpos;
		
		list($limit, $offset) = sscanf($amount, '%d(%d)');
		$this->_setBlogCategory($blog, $category);
		$this->_preBlogContent('blog',$blog);
		$this->amountfound = $blog->readLog($template, $limit, $offset, $startpos);
		$this->_postBlogContent('blog',$blog);
	}

	function parse_otherblog($blogname, $template, $amount = 10, $category = '') {
		global $manager;

		list($limit, $offset) = sscanf($amount, '%d(%d)');

		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->_setBlogCategory($b, $category);
		$this->_preBlogContent('otherblog',$b);
		$this->amountfound = $b->readLog($template, $limit, $offset);
		$this->_postBlogContent('otherblog',$b);
	}

	// include one item (no comments)
	function parse_item($template) {
		global $blog, $itemid, $highlight;
		$this->_setBlogCategory($blog, '');	// need this to select default category
		$this->_preBlogContent('item',$blog);
		$r = $blog->showOneitem($itemid, $template, $highlight);
		if ($r == 0)
			echo _ERROR_NOSUCHITEM;
		$this->_postBlogContent('item',$blog);
	}

	function parse_itemid() {
		global $itemid;
		echo $itemid;
	}


	// include comments for one item
	function parse_comments($template) {
		global $itemid, $manager, $blog, $highlight;
		$template = TEMPLATE::read($template);

		// create parser object & action handler
		$actions = new ITEMACTIONS($blog);
		$parser = new PARSER($actions->getDefinedActions(),$actions);
		$actions->setTemplate($template);
		$actions->setParser($parser);
		$item = ITEM::getitem($itemid, 0, 0);
		$actions->setCurrentItem($item);

		$comments = new COMMENTS($itemid);
		$comments->setItemActions($actions);
		$comments->showComments($template, -1, 1, $highlight);	// shows ALL comments
	}

	function parse_archive($template, $category = '') {
		global $blog, $archive;
		// can be used with either yyyy-mm or yyyy-mm-dd
		sscanf($archive,'%d-%d-%d',$y,$m,$d);
		$this->_setBlogCategory($blog, $category);
		$this->_preBlogContent('achive',$blog);
		$blog->showArchive($template, $y, $m, $d);
		$this->_postBlogContent('achive',$blog);

	}

	function parse_otherarchive($blogname, $template, $category = '') {
		global $archive, $manager;
		sscanf($archive,'%d-%d-%d',$y,$m,$d);
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->_setBlogCategory($b, $category);
		$this->_preBlogContent('otherachive',$b);
		$b->showArchive($template, $y, $m, $d);
		$this->_postBlogContent('otherachive',$b);
	}

	function parse_archivelist($template, $category = 'all', $limit = 0) {
		global $blog;
		if ($category == 'all') $category = '';
		$this->_preBlogContent('archivelist',$blog);
		$this->_setBlogCategory($blog, $category);
		$blog->showArchiveList($template, 'month', $limit);
		$this->_postBlogContent('archivelist',$blog);
	}

	function parse_archivedaylist($template, $category = 'all', $limit = 0) {
		global $blog;
		if ($category == 'all') $category = '';
		$this->_preBlogContent('archivelist',$blog);
		$this->_setBlogCategory($blog, $category);
		$blog->showArchiveList($template, 'day', $limit);
		$this->_postBlogContent('archivelist',$blog);
	}


	function parse_itemtitle() {
		global $manager, $itemid;
		$item =& $manager->getItem($itemid,0,0);
		echo htmlspecialchars(strip_tags($item['title']));
	}

	function parse_categorylist($template, $blogname = '') {
		global $blog, $manager;

		if ($blogname == '') {
			$this->_preBlogContent('categorylist',$blog);
			$blog->showCategoryList($template);
			$this->_postBlogContent('categorylist',$blog);
		} else {
			$b =& $manager->getBlog(getBlogIDFromName($blogname));
			$this->_preBlogContent('categorylist',$b);
			$b->showCategoryList($template);
			$this->_postBlogContent('categorylist',$b);
		}
	}

	function parse_category($type = 'name') {
		global $catid, $blog;
		if (!$blog->isValidCategory($catid))
			return;

		switch($type) {
			case 'name':
				echo $blog->getCategoryName($catid);
				break;
			case 'desc':
				echo $blog->getCategoryDesc($catid);
				break;
			case 'id':
				echo $catid;
				break;
		}
	}

	function parse_otherarchivelist($blogname, $template, $category = 'all', $limit = 0) {
		global $manager;
		if ($category == 'all') $category = '';
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->_setBlogCategory($b, $category);
		$this->_preBlogContent('otherarchivelist',$b);
		$b->showArchiveList($template, 'month', $limit);
		$this->_postBlogContent('otherarchivelist',$b);
	}

	function parse_otherarchivedaylist($blogname, $template, $category = 'all', $limit = 0) {
		global $manager;
		if ($category == 'all') $category = '';
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->_setBlogCategory($b, $category);
		$this->_preBlogContent('otherarchivelist',$b);
		$b->showArchiveList($template, 'day', $limit);
		$this->_postBlogContent('otherarchivelist',$b);
	}

	function parse_searchresults($template, $maxresults = 50 ) {
		global $blog, $query, $amount, $startpos;

		$this->_setBlogCategory($blog, '');	// need this to select default category
		$this->_preBlogContent('searchresults',$blog);
		$this->amountfound = $blog->search($query, $template, $amount, $maxresults, $startpos);
		$this->_postBlogContent('searchresults',$blog);
	}

	function parse_othersearchresults($blogname, $template, $maxresults = 50) {
		global $query, $amount, $manager, $startpos;
		$b =& $manager->getBlog(getBlogIDFromName($blogname));
		$this->_setBlogCategory($b, '');	// need this to select default category
		$this->_preBlogContent('othersearchresults',$b);
		$b->search($query, $template, $amount, $maxresults, $startpos);
		$this->_postBlogContent('othersearchresults',$b);
	}

	// includes the search query
	function parse_query() {
		global $query;
		echo htmlspecialchars($query);
	}
			
	// include nucleus versionnumber
	function parse_version() {
		global $nucleus;
		echo 'Nucleus ' . $nucleus['version'];
	}
	

	function parse_errormessage() {
		global $errormessage;
		echo $errormessage;
	}


	function parse_imagetext() {			
		echo htmlspecialchars(requestVar('imagetext'));
	}
	
	function parse_image($what = 'imgtag') {
		global $CONF;

		$imagetext 	= htmlspecialchars(requestVar('imagetext'));
		$imagepopup = requestVar('imagepopup');
		$width 		= requestVar('width');
		$height 	= requestVar('height');
		$fullurl = $CONF['MediaURL'] . $imagepopup;
		
		switch($what)
		{
			case 'url':
				echo $fullurl;
				break;
			case 'width':
				echo $width;
				break;
			case 'height':
				echo $height;
				break;
			case 'caption':
			case 'text':			
				echo $imagetext;
				break;
			case 'imgtag':
			default:
				echo "<img src=\"$fullurl\" width=\"$width\" height=\"$height\" alt=\"$imagetext\" />";
				break;
		}
	}
	
	// When commentform is not used, to include a hidden field with itemid
	function parse_vars() {
		global $itemid;
		echo '<input type="hidden" name="itemid" value="'.$itemid.'" />';
	}
	
	// include a sitevar
	function parse_sitevar($which) {
		global $CONF;
		switch($which) {
			case 'url':
				echo $CONF['IndexURL'];
				break;
			case 'name':
				echo $CONF['SiteName'];
				break;
			case 'admin':
				echo $CONF['AdminEmail'];
				break;
			case 'adminurl':
				echo $CONF['AdminURL'];
		}			
	}
	
	// shortcut for admin url
	function parse_adminurl() { $this->parse_sitevar('adminurl'); }
	
	function parse_blogsetting($which) {
		global $blog;
		switch($which) {
			case 'id':
				echo $blog->getID();
				break;
			case 'url':
				echo $blog->getURL();
				break;
			case 'name':
				echo $blog->getName();
				break;
			case 'desc':
				echo $blog->getDescription();
				break;
		}	
	}
	
	// includes a member info thingie
	function parse_member($what) {
		global $memberinfo, $member;
		
		// 1. only allow the member-details-page specific variables on member pages
		if ($this->skintype == 'member') {

			switch($what) {
				case 'name':
					echo $memberinfo->getDisplayName();
					break;
				case 'realname':
					echo $memberinfo->getRealName();
					break;
				case 'notes':
					echo $memberinfo->getNotes();
					break;
				case 'url':
					echo $memberinfo->getURL();
					break;
				case 'email':
					echo $memberinfo->getEmail();
					break;
				case 'id':
					echo $memberinfo->getID();
					break;					
			}	
		}
		
		// 2. the next bunch of options is available everywhere, as long as the user is logged in
		if ($member->isLoggedIn())
		{
			switch($what) {
				case 'yourname':
					echo $member->getDisplayName();
					break;
				case 'yourrealname':
					echo $member->getRealName();
					break;
				case 'yournotes':
					echo $member->getNotes();
					break;
				case 'yoururl':
					echo $member->getURL();
					break;
				case 'youremail':
					echo $member->getEmail();
					break;
				case 'yourid':
					echo $member->getID();
					break;									
			}	
		}

	}
	
	function parse_preview($template) {
		global $blog, $CONF;
		
		$template = TEMPLATE::read($template);
		$row['body'] = '<span id="prevbody"></span>';
		$row['title'] = '<span id="prevtitle"></span>';
		$row['more'] = '<span id="prevmore"></span>';
		$row['itemlink'] = '';
		$row['itemid'] = 0; $row['blogid'] = $blog->getID();
		echo TEMPLATE::fill($template['ITEM_HEADER'],$row);
		echo TEMPLATE::fill($template['ITEM'],$row);
		echo TEMPLATE::fill($template['ITEM_FOOTER'],$row);
	}
	
	function parse_additemform() {
		global $blog, $CONF;
		$this->formdata = array(
			'adminurl' => htmlspecialchars($CONF['AdminURL']),
			'catid' => $blog->getDefaultCategory()
		);
		$blog->InsertJavaScriptInfo(); 
		$this->doForm('additemform');
	}

	/**
	  * Executes a plugin skinvar
	  *
	  * @param pluginName name of plugin (without the NP_)
	  * 
	  * extra parameters can be added
	  */
	function parse_plugin($pluginName) {
		global $manager;
		
		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName))
			return;
		
		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();
		
		// remove plugin name 
		array_shift($params);
		
		// add skin type on front
		array_unshift($params, $this->skintype);
		
		call_user_func_array(array(&$plugin,'doSkinVar'), $params);
	}

			
	function parse_commentform($destinationurl = '') {
		global $blog, $itemid, $member, $CONF, $manager, $DIR_LIBS, $errormessage;
		
		// warn when trying to provide a actionurl (used to be a parameter in Nucleus <2.0)
		if (stristr($destinationurl, 'action.php')) {
			$args = func_get_args();
			$destinationurl = $args[1];
			ACTIONLOG::add(WARNING,'actionurl is not longer a parameter on commentform skinvars. Moved to be a global setting instead.');
		}
		
		$actionurl = $CONF['ActionURL'];
		
		// if item is closed, show message and do nothing
		$item =& $manager->getItem($itemid,0,0);
		if ($item['closed'] || !$blog->commentsEnabled()) {
			$this->doForm('commentform-closed');
			return;
		}
		
		if (!$destinationurl)
			$destinationurl = createItemLink($itemid, $this->linkparams);

		// values to prefill
		$user = cookieVar('comment_user');
		if (!$user) $user = postVar('user');
		$userid = cookieVar('comment_userid');
		if (!$userid) $userid = postVar('userid');
		$body = postVar('body');
		
		$this->formdata = array(
			'destinationurl' => htmlspecialchars($destinationurl),
			'actionurl' => htmlspecialchars($actionurl),
			'itemid' => $itemid,
			'user' => htmlspecialchars($user),
			'userid' => htmlspecialchars($userid),			
			'body' => htmlspecialchars($body),			
			'membername' => $member->getDisplayName(),
			'rememberchecked' => cookieVar('comment_user')?'checked="checked"':''
		);
		
		if (!$member->isLoggedIn()) {
			$this->doForm('commentform-notloggedin');
		} else {
			$this->doForm('commentform-loggedin');		
		}
	}

	function parse_loginform() {
		global $member, $CONF;
		if (!$member->isLoggedIn()) {
			$filename = 'loginform-notloggedin';
			$this->formdata = array();
		} else {
			$filename = 'loginform-loggedin';
			$this->formdata = array(
				'membername' => $member->getDisplayName(),
			);
		}
		$this->doForm($filename);
	}	
	
	
	function parse_membermailform($rows = 10, $cols = 40, $desturl = '') {
		global $member, $CONF, $memberid;
		
		if ($desturl == '') {
			if ($CONF['URLMode'] == 'pathinfo')
				$desturl = createMemberLink($memberid);
			else
				$desturl = $CONF['IndexURL'] . createMemberLink($memberid);				
		}
			
		$message = postVar('message');
		$frommail = postVar('frommail');
		
		$this->formdata = array(
			'url' => htmlspecialchars($desturl),
			'actionurl' => htmlspecialchars($CONF['ActionURL']),
			'memberid' => $memberid,
			'rows' => $rows,
			'cols' => $cols,
			'message' => htmlspecialchars($message),
			'frommail' => htmlspecialchars($frommail)
		);
		if ($member->isLoggedIn()) {
			$this->doForm('membermailform-loggedin');
		} else if ($CONF['NonmemberMail']) {
			$this->doForm('membermailform-notloggedin');		
		} else {
			$this->doForm('membermailform-disallowed');		
		}

	}

	function parse_searchform($blogname = '') {
		global $CONF, $manager, $maxresults;
		if ($blogname) {
			$blog =& $manager->getBlog(getBlogIDFromName($blogname));
		} else {
			global $blog;
		}
		// use default blog when no blog is selected
		$this->formdata = array(
			'id' => $blog?$blog->getID():$CONF['DefaultBlog'],
			'query' => htmlspecialchars(getVar('query')),
		);
		$this->doForm('searchform');
	}

	function parse_nucleusbutton($imgurl = '',
							     $imgwidth = '85',
							     $imgheight = '31') {
		global $CONF;
		if ($imgurl == '') {
			$imgurl = $CONF['AdminURL'] . 'nucleus.gif';
		} else if (PARSER::getProperty('IncludeMode') == 'skindir'){
			// when skindit IncludeMode is used: start from skindir
			$imgurl = $CONF['SkinsURL'] . PARSER::getProperty('IncludePrefix') . $imgurl;
		}

		$this->formdata = array(
			'imgurl' => $imgurl,
			'imgwidth' => $imgwidth,
			'imgheight' => $imgheight,
		);
		$this->doForm('nucleusbutton');
	}
	
	function parse_self() {
		global $CONF;
		echo $CONF['Self'];
	}
	
	function parse_referer() {
		echo htmlspecialchars(serverVar('HTTP_REFERER'));
	}
	
	/**
	  * Helper function that sets the category that a blog will need to use 
	  *
	  * @param $blog
	  *		An object of the blog class, passed by reference (we want to make changes to it)
	  * @param $catname
	  *		The name of the category to use
	  */
	function _setBlogCategory(&$blog, $catname) {
		global $catid;
		if ($catname != '')
			$blog->setSelectedCategoryByName($catname);
		else
			$blog->setSelectedCategory($catid);
	}
	
	function _preBlogContent($type, &$blog) {
		global $manager;
		$manager->notify('PreBlogContent',array('blog' => &$blog, 'type' => $type));
	}

	function _postBlogContent($type, &$blog) {
		global $manager;
		$manager->notify('PostBlogContent',array('blog' => &$blog, 'type' => $type));
	}

}

?>
