<?php
/**
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id: AdminActions.php 1661 2012-02-12 11:55:39Z sakamocchi $
 */

class AdminActions extends BaseActions
{
	private $skintype;
	
	/**
	 * AdminActions::$default_actions
	 * list of whole action names with which this class can deal
	 */
	static private $default_actions = array(
		'actionurl',
		'addtickettourl',
		'adminurl',
		'codename',
		'customhelplink',
		'date',
		'extrahead',
		'headmessage',
		'helplink',
		'member',
		'newestcompare',
		'pagehead',
		'pagefoot',
		'qmenuaddselect',
		'quickmenu',
		'sitevar',
		'sprinttext',
		'ticket',
		'version',
		'versioncheckurl'
	);
	
	/**
	 * AdminActions::$normal_skin_types
	 * friendly name for wrapped page types
	 */
	static private $normal_skin_types = array(
		'actionlog'				=> _ADM_SKPRT_ACTIONLOG,
		'activate'				=> _ADM_SKPRT_ACTIVATE,
		'activatesetpwd'		=> _ADM_SKPRT_ACTIVATESETPWD,
		'addnewlog'				=> _ADM_SKPRT_ADDNEWLOG,
		'adminerrorpage'		=> _ADM_SKPRT_ADMINERRORPAGE,
		'adminskindelete'		=> _ADM_SKPRT_ADMINSKINDELETE,
		'adminskinedit'			=> _ADM_SKPRT_ADMINSKINEDIT,
		'adminskinedittype'		=> _ADM_SKPRT_ADMINSKINEDITTYPE,
		'adminskiniedoimport'	=> _ADM_SKPRT_ADMINSKINIEDOIMPORT,
		'adminskinieimport'		=> _ADM_SKPRT_ADMINSKINIEIMPORT,
		'adminskinieoverview'	=> _ADM_SKPRT_ADMINSKINIEOVERVIEW,
		'adminskinoverview'		=> _ADM_SKPRT_ADMINSKINOVERVIEW,
		'adminskinremovetype'	=> _ADM_SKPRT_ADMINSKINREMOVETYPE,
		'admintemplatedelete'	=> _ADM_SKPRT_ADMINTEMPLATEDELETE,
		'admintemplateedit'		=> _ADM_SKPRT_ADMINTEMPLATEEDIT,
		'admintemplateoverview'	=> _ADM_SKPRT_ADMINTEMPLATEOVERVIEW,
		'backupoverview'		=> _ADM_SKPRT_BACKUPOVERVIEW,
		'backuprestore'			=> _ADM_SKPRT_BACKUPRESTORE,
		'banlist'				=> _ADM_SKPRT_BANLIST,
		'banlistdelete'			=> _ADM_SKPRT_BANLISTDELETE,
		'banlistdeleteconfirm'	=> _ADM_SKPRT_BANLISTDELETECONFIRM,
		'banlistnew'			=> _ADM_SKPRT_BANLISTNEW,
		'batchcategory'			=> _ADM_SKPRT_BATCHCATEGORY,
		'batchcomment'			=> _ADM_SKPRT_BATCHCOMMENT,
		'batchdelete'			=> _ADM_SKPRT_BATCHDELETE,
		'batchitem'				=> _ADM_SKPRT_BATCHITEM,
		'batchmember'			=> _ADM_SKPRT_BATCHMEMBER,
		'batchmove'				=> _ADM_SKPRT_BATCHMOVE,
		'batchmovecat'			=> _ADM_SKPRT_BATCHMOVECAT,
		'batchteam'				=> _ADM_SKPRT_BATCHTEAM,
		'blogcommentlist'		=> _ADM_SKPRT_BLOGCOMMENTLIST,
		'blogsettings'			=> _ADM_SKPRT_BLOGSETTINGS,
		'bookmarklet'			=> _ADM_SKPRT_BOOKMARKLET,
		'browseowncomments'		=> _ADM_SKPRT_BROWSEOWNCOMMENTS,
		'browseownitems'		=> _ADM_SKPRT_BROWSEOWNITEMS,
		'categorydelete'		=> _ADM_SKPRT_CATEGORYDELETE,
		'categoryedit'			=> _ADM_SKPRT_CATEGORYEDIT,
		'commentdelete'			=> _ADM_SKPRT_COMMENTDELETE,
		'commentedit'			=> _ADM_SKPRT_COMMENTEDIT,
		'createitem'			=> _ADM_SKPRT_CREATEITEM,
		'createnewlog'			=> _ADM_SKPRT_CREATENEWLOG,
		'createaccountinput'	=> _ADM_SKPRT_CREATEACCOUNTINPUT,
		'createaccountsuccess'	=> _ADM_SKPRT_CREATEACCOUNTSUCCESS,
		'createaccountdisable'	=> _ADM_SKPRT_CREATEACCOUNTDISALLOWED,
		'deleteblog'			=> _ADM_SKPRT_DELETEBLOG,
		'editmembersettings'	=> _ADM_SKPRT_EDITMEMBERSETTINGS,
		'forgotpassword'		=> _ADM_SKPRT_FORGOTPASSWORD,
		'itemcommentlist'		=> _ADM_SKPRT_ITEMCOMMENTLIST,
		'itemdelete'			=> _ADM_SKPRT_ITEMDELETE,
		'itemedit'				=> _ADM_SKPRT_ITEMEDIT,
		'itemlist'				=> _ADM_SKPRT_ITEMLIST,
		'itemmove'				=> _ADM_SKPRT_ITEMMOVE,
		'manage'				=> _ADM_SKPRT_MANAGE,
		'manageteam'			=> _ADM_SKPRT_MANAGETEAM,
		'memberdelete'			=> _ADM_SKPRT_MEMBERDELETE,
		'overview'				=> _ADM_SKPRT_OVERVIEW,
		'pagefoot'				=> _ADM_SKPRT_PAGEFOOT,
		'pagehead'				=> _ADM_SKPRT_PAGEHEAD,
		'plugindelete'			=> _ADM_SKPRT_PLUGINDELETE,
		'pluginhelp'			=> _ADM_SKPRT_PLUGINHELP,
		'pluginlist'			=> _ADM_SKPRT_PLUGINLIST,
		'pluginoptions'			=> _ADM_SKPRT_PLUGINOPTIONS,
		'settingsedit'			=> _ADM_SKPRT_SETTINGSEDIT,
		'showlogin'				=> _ADM_SKPRT_SHOWLOGIN,
		'skindelete'			=> _ADM_SKPRT_SKINDELETE,
		'skinedit'				=> _ADM_SKPRT_SKINEDIT,
		'skinedittype'			=> _ADM_SKPRT_SKINEDITTYPE,
		'skiniedoimport'		=> _ADM_SKPRT_SKINIEDOIMPORT,
		'skinieimport'			=> _ADM_SKPRT_SKINIEIMPORT,
		'skinieoverview'		=> _ADM_SKPRT_SKINIEOVERVIEW,
		'skinoverview'			=> _ADM_SKPRT_SKINOVERVIEW,
		'skinremovetype'		=> _ADM_SKPRT_SKINREMOVETYPE,
		'systemoverview'		=> _ADM_SKPRT_SYSTEMOVERVIEW,
		'teamdelete'			=> _ADM_SKPRT_TEAMDELETE,
		'templatedelete'		=> _ADM_SKPRT_TEMPLATEDELETE,
		'templateedit'			=> _ADM_SKPRT_TEMPLATEEDIT,
		'templateoverview'		=> _ADM_SKPRT_TEMPLATEOVERVIEW,
		'usermanagement'		=> _ADM_SKPRT_USERMANAGEMENT
	);
	
	/**
	 * AdminActions::getNormalSkinTypes()
	 *
	 * @static
	 * @param	void
	 * @return	array	list of friendly names for page actions
	 */
	static public function getNormalSkinTypes()
	{
		return self::$normal_skin_types;
	}
	
	/**
	 * AdminActions::__construct()
	 * Constructor for a new Actions object
	 *
	 * @param	string	$type
	 * @return	void
	 */
	public function __construct($type)
	{
		// call constructor of superclass first
		parent::__construct();
		
		/* alias */
		if ( $type == 'admntemplateoverview' )
		{
			$this->skintype = 'admintemplateoverview';
		}
		else
		{
			$this->skintype = $type;
		}
	
		return;
	}
	
	/**
	 * AdminActions::getAvailableActions()
	 *
	 * @param	void
	 * @return	array	allowed	actions for the page type
	 */
	public function getAvailableActions()
	{
		$extra_actions = array();
		
		switch ( $this->skintype )
		{
			case 'actionlog':
				$extra_actions = array(
				'actionloglist',
				);
				break;
			case 'activate':
				$extra_actions = array(
				'activationmessage',
				'eventformextra',
				);
				break;
			case 'activatesetpwd':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'addnewlog':
				$extra_actions = array(
				'getblogsetting',
				'blogsetting',
				'requestblogid',
				);
				break;
			case 'adminerrorpage':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'adminskindelete':
				$extra_actions = array(
				'editskintype',
				);
				break;
			case 'adminskinedit':
				$extra_actions = array(
				'editskin',
				'normalskinlist',
				'specialskinlist',
				);
				break;
			case 'adminskinedittype':
				$extra_actions = array(
				'editskintype',
				'skintypehelp',
				'allowedskinactions',
				'skineditallowedlist',
				);
				break;
			case 'adminskiniedoimport':
				$extra_actions = array(
				'importskininfo',
				);
				break;
			case 'adminskinieimport':
				$extra_actions = array(
				'importskininfo',
				);
				break;
			case 'adminskinieoverview':
				$extra_actions = array(
				'selectlocalskinfiles',
				'skinielist',
				);
				break;
			case 'adminskinoverview':
				$extra_actions = array(
				'skinoverview',
				);
				break;
			case 'adminskinremovetype':
				$extra_actions = array(
				'editskintype',
				);
				break;
			case 'admintemplatedelete':
				$extra_actions = array(
				'editadmintemplateinfo',
				);
			case 'admintemplateedit':
				$extra_actions = array(
				'edittemplateinfo',
				);
				break;
			case 'admintemplateoverview':
				$extra_actions = array(
				'templateoverview',
				);
				break;
			case 'backupoverview':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'backuprestore':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'banlist':
				$extra_actions = array(
				'adminbloglink',
				'adminbanlist',
				'requestblogid',
				);
				break;
			case 'banlistdelete':
				$extra_actions = array(
				'requestiprange',
				'requestblogid',
				);
				break;
			case 'banlistdeleteconfirm':
				$extra_actions = array(
				'banlistdeletedlist',
				'requestblogid',
				);
				break;
			case 'banlistnew':
				$extra_actions = array(
				'iprangeinput',
				'requestblogid',
				'blogsetting',
				);
				break;
			case 'batchcategory':
				$extra_actions = array(
				'adminbatchaction',
				'adminbatchlist',
				);
				break;
			case 'batchcomment':
				$extra_actions = array(
				'adminbatchaction',
				'adminbatchlist',
				);
				break;
			case 'batchdelete':
				$extra_actions = array(
				'batchdeletetype',
				'batchdeletelist',
				);
				break;
			case 'batchitem':
				$extra_actions = array(
				'adminbatchaction',
				'adminbatchlist',
				);
				break;
			case 'batchmember':
				$extra_actions = array(
				'adminbatchaction',
				'adminbatchlist',
				);
				break;
			case 'batchmove':
				$extra_actions = array(
				'batchmovetitle',
				'batchmovetype',
				'batchmovelist',
				'movedistselect',
				'batchmovebtn',
				);
				break;
			case 'batchmovecat':
				$extra_actions = array(
				'batchmovetitle',
				'batchmovetype',
				'batchmovelist',
				'movedistselect',
				'batchmovebtn',
				);
				break;
			case 'batchteam':
				$extra_actions = array(
				'requestblogid',
				'adminbatchaction',
				'adminbatchlist',
				);
				break;
			case 'blogcommentlist':
				$extra_actions = array(
				'adminbloglink',
				'commentnavlist',
				'adminbatchlist',
				);
				break;
			case 'blogsettings':
				$extra_actions = array(
				'adminbloglink',
				'blogcatlist',
				'blognotifysetting',
				'blogsetting',
				'blogsettingyesno',
				'blogteammembers',
				'blogtime',
				'defcatselect',
				'defskinselect',
				'pluginextras',
				'pluginoptions',
				'requestblogid',
				);
				break;
			case 'bookmarklet':
				$extra_actions = array(
				'bookmarkletadmin',
				);
				break;
			case 'browseowncomments':
				$extra_actions = array(
				'commentnavlist',
				);
				break;
			case 'browseownitems':
				$extra_actions = array(
				'itemnavlist',
				);
				break;
			case 'categorydelete':
				$extra_actions = array(
				'categorysetting',
				'requestblogid',
				);
				break;
			case 'categoryedit':
				$extra_actions = array(
				'requestblogid',
				'categorysetting',
				'editdesturl',
				'pluginoptions'
				);
				break;
			case 'commentdelete':
				$extra_actions = array(
				'deletecomment',
				);
				break;
			case 'commentedit':
				$extra_actions = array(
				'editcomment',
				);
				break;
			case 'createaccountinput':
				$extra_actions = array(
				'contents',
				'pluginextras',
				'eventformextra',
				);
				break;
			case 'createaccountsuccess':
				$extra_actions = array(
				'contents',
				);
				break;
			case 'createaccountdisable':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'createitem':
				$extra_actions = array(
				'adminbloglink',
				'blogid',
				'contents',
				'categories',
				'currenttime',
				'init',
				'pluginoptions',
				'pluginextras'
				);
				break;
			case 'createnewlog':
				$extra_actions = array(
				'defskinselect',
				'blogtime',
				);
				break;
			case 'deleteblog':
				$extra_actions = array(
				'blogsetting',
				'requestblogid',
				);
				break;
			case 'editmembersettings':
				$extra_actions = array(
				'defskinselect',
				'editmember',
				'localeselectoptions',
				'pluginoptions',
				'defadminskinselect',
				'defbookmarkletselect',
				);
				break;
			case 'forgotpassword':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'itemcommentlist':
				$extra_actions = array(
				'requestblogid',
				'commentnavlist',
				);
				break;
			case 'itemdelete':
				$extra_actions = array(
				'deleteitemtitle',
				'deleteitembody',
				'deleteitemid',
				);
				break;
			case 'itemedit':
				$extra_actions = array(
				'init',
				'contents',
				'checkedonval',
				'categories',
				'currenttime',
				'itemtime',
				'pluginoptions',
				'pluginextras'
				);
				break;
			case 'itemlist':
				$extra_actions = array(
				'adminbloglink',
				'ilistaddnew',
				'itemnavlist',
				);
				break;
			case 'itemmove':
				$extra_actions = array(
				'moveitemid',
				'movedistselect',
				);
				break;
			case 'manage':
				$extra_actions = array(
				/* nothing special */
				);
				break;
			case 'manageteam':
				$extra_actions = array(
				'requestblogid',
				'blogsetting',
				'blogteamlist',
				'newmemberselect',
				'inputyesno',
				);
				break;
			case 'memberdelete':
				$extra_actions = array(
				'editmember',
				);
				break;
			case 'overview':
				$extra_actions = array(
				'yrbloglist',
				);
				break;
			case 'plugindelete':
				$extra_actions = array(
				'editpluginfo',
				);
				break;
			case 'pluginhelp':
				$extra_actions = array(
				'helpplugname',
				'pluginhelp',
				);
				break;
			case 'pluginlist':
				$extra_actions = array(
				'pluginlistlist',
				'newpluginlist',
				);
				break;
			case 'pluginoptions':
				$extra_actions = array(
				'editpluginfo',
				'editplugoptionslist',
				);
				break;
			case 'settingsedit':
				$extra_actions = array(
				'defblogselect',
				'defskinselect',
				'configsettingsedit',
				'configsettingsyesno',
				'outputspecialdirs',
				'jstoolbaroptions',
				'localeselectoptions',
				'mediadirwarning',
				'pluginextras',
				'defadminskinselect',
				'defbookmarkletselect',
				);
				break;
			case 'showlogin':
				$extra_actions = array(
				'passrequestvars',
				);
				break;
			case 'skindelete':
				$extra_actions = array(
				'editskintype',
				);
				break;
			case 'skinedit':
				$extra_actions = array(
				'editskin',
				'normalskinlist',
				'specialskinlist'
				);
				break;
			case 'skinedittype':
				$extra_actions = array(
				'editskintype',
				'skintypehelp',
				'allowedskinactions',
				'skineditallowedlist'
				);
				break;
			case 'skiniedoimport':
				$extra_actions = array(
				'importskininfo',
				);
				break;
			case 'skinieimport':
				$extra_actions = array(
				'importskininfo',
				);
				break;
			case 'skinieoverview':
				$extra_actions = array(
				'selectlocalskinfiles',
				'skinielist',
				);
				break;
			case 'skinoverview':
				$extra_actions = array(
				'skinoverview',
				);
				break;
			case 'skinremovetype':
				$extra_actions = array(
				'editskintype',
				);
				break;
			case 'systemoverview':
				$extra_actions = array(
				'systemsettings',
				);
				break;
			case 'teamdelete':
				$extra_actions = array(
				'editmember',
				'blogsetting',
				'requestblogid',
				);
				break;
			case 'templatedelete':
				$extra_actions = array(
				'edittemplateinfo',
				);
				break;
			case 'templateedit':
				$extra_actions = array(
				'edittemplateinfo',
				);
				break;
			case 'templateoverview':
				$extra_actions = array(
				'templateoverview',
				);
				break;
			case 'usermanagement':
				$extra_actions = array(
				'editmemberlist',
				'inputyesno',
				);
				break;
			case 'importAdmin':
				$extra_actions = array(
				'charset',
				'adminurl',
				'extrahead',
				'member',
				'versioncheckurl',
				'version',
				'codename',
				'newestcompare',
				'selectlocalskinfiles',
				'skinielist',
				);
				break;
			default:
				break;
		}
		
		$defined_actions = array_merge(self::$default_actions, $extra_actions);
		
		return array_merge($defined_actions, parent::getAvailableActions());
	}
	
	/**
	 * AdminActions::parse_actionloglist()
	 * Parse skinvar actionloglist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_actionloglist($template_name = '')
	{
		$query = "SELECT * FROM %s ORDER BY timestamp DESC;";
		$query = sprintf($query, sql_table('actionlog'));
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['content'] = 'actionlist';
			$this->parser->parse(showlist($resource, 'table', $template, $template_name));
		}
		else
		{
			/* TODO: nothing to be shown */
		}
		return;
	}
	
	/**
	 * AdminActions::parse_activationmessage()
	 * Parse skinvar activationmessage
	 *
	 * @param	string	$type			type of message
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_activationmessage($type, $template_name = '')
	{
		global $CONF, $manager;
		
		$template = array();
		
		if ( !empty($template_name))
		{
			$template =& $manager->getTemplate($template_name);
		}
		
		$key = postVar('ackey');
		if ( !$key )
		{
			Admin::error(_ERROR_ACTIVATE);
		}
		
		$info = MEMBER::getActivationInfo($key);
		if ( !$info )
		{
			Admin::error(_ERROR_ACTIVATE);
		}
		
		$mem =& $manager->getMember($info->vmember);
		if ( !$mem )
		{
			Admin::error(_ERROR_ACTIVATE);
		}
		switch ( $info->vtype )
		{
			case 'forgot':
				if ( array_key_exists('ACTIVATE_FORGOT_TITLE', $template) && !empty($template['ACTIVATE_FORGOT_TITLE']) )
				{
					$title = $template['ACTIVATE_FORGOT_TITLE'];
				}
				else
				{
					$title = _ACTIVATE_FORGOT_TITLE;
				}
				if ( array_key_exists('ACTIVATE_FORGOT_TEXT', $template) && !empty($template['ACTIVATE_FORGOT_TEXT']) )
				{
					$text = $template['ACTIVATE_FORGOT_TEXT'];
				}
				else
				{
					$text = _ACTIVATE_FORGOT_TEXT;
				}
				break;
			case 'register':
				if ( array_key_exists('ACTIVATE_REGISTER_TITLE', $template) && !empty($template['ACTIVATE_REGISTER_TITLE']) )
				{
					$title = $template['ACTIVATE_REGISTER_TITLE'];
				}
				else
				{
					$title = _ACTIVATE_REGISTER_TITLE;
				}
				if ( array_key_exists('ACTIVATE_REGISTER_TEXT', $template) && !empty($template['ACTIVATE_REGISTER_TEXT']) )
				{
					$text = $template['ACTIVATE_REGISTER_TEXT'];
				}
				else
				{
					$text = _ACTIVATE_REGISTER_TEXT;
				}
				break;
			case 'addresschange':
				if ( array_key_exists('ACTIVATE_CHANGE_TITLE', $template) && !empty($template['ACTIVATE_CHANGE_TITLE']) )
				{
					$title = $template['ACTIVATE_CHANGE_TITLE'];
				}
				else
				{
					$title = _ACTIVATE_CHANGE_TITLE;
				}
				if (array_key_exists('ACTIVATE_CHANGE_TEXT', $template) && !empty($template['ACTIVATE_CHANGE_TEXT']))
				{
					$text = $template['ACTIVATE_CHANGE_TEXT'];
				}
				else
				{
					$text = _ACTIVATE_CHANGE_TEXT;
				}
				break;
		}
		$aVars = array(
			'memberName'	=> Entity::hsc($mem->getDisplayName()),
			'realName'		=> Entity::hsc($mem->getRealName()),
		);
		switch ( $type )
		{
			case 'title':
				echo Template::fill($title, $aVars);
				break;
			case 'text':
				echo Template::fill($text,  $aVars);
				break;
			case 'ackey':
				echo Entity::hsc($key);
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_addtickettourl()
	 * Parse skinvar addtickettourl
	 *
	 * @param	string	$url	URI for ticket
	 * @return	void
	 */
	public function parse_addtickettourl($url)
	{
		global $manager;
		$url = $manager->addTicketToUrl($url);
		echo Entity::hsc($url);
		return;
	}
	
	/**
	 * AdminActions::parse_adminbanlist()
	 * Parse skinvar adminbanlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_adminbanlist($template_name = '')
	{
		$blogid = intRequestVar('blogid');
		
		$query = "SELECT * FROM %s WHERE blogid=%d ORDER BY iprange;";
		$query = sprintf($query, sql_table('ban'), (integer) $blogid);
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['content'] = 'banlist';
			$this->parser-parse(showlist($resource, 'table', $template, $template_name));
		}
		else
		{
			echo _BAN_NONE;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_adminbatchaction()
	 * Parse skinvar adminbatchaction
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_adminbatchaction()
	{
		echo Entity::hsc(requestVar('batchaction'));
		return;
	}
	
	/**
	 * AdminActions::parse_adminbatchlist()
	 * Parse skinvar adminbatchlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_adminbatchlist($template_name = '')
	{
		global $manager;
		$templates = array();
		
		if ( !empty($template_name) )
		{
			$templates =& $manager->getTemplate($template_name);
		}
		
		if ( !array_key_exists('ADMIN_BATCHLIST', $templates) || empty($templates['ADMIN_BATCHLIST']) )
		{
			$template = '<li><%text(_BATCH_EXECUTING)%>&nbsp;'
			. '<b><%adminbatchaction%></b>&nbsp;'
			. '<%batchlisttype%>&nbsp;'
			. '<b><%batchid%></b>...&nbsp;'
			. '<b><%batchlistmsg%></b>'
			. "</li>\n";
		}
		else
		{
			$template = $templates['ADMIN_BATCHLIST'];
		}
		
		$selected = requestIntArray('batch');
		$action = requestVar('batchaction');
		
		switch ( $this->skintype )
		{
			case 'batchitem':
				$batchlisttype	= _BATCH_ONITEM;
				$deleteaction	= 'deleteOneItem';
				$moveaction		= 'moveOneItem';
				$destid			= intRequestVar('destcatid');
				break;
			case 'batchcomment':
				$batchlisttype	= _BATCH_ONCOMMENT;
				$deleteaction 	= 'deleteOneComment';
				break;
			case 'batchmember':
				$batchlisttype	= _BATCH_ONMEMBER;
				$deleteaction	= 'deleteOneMember';
				$setadminsql	= sql_table('member') . ' SET madmin = 1 WHERE mnumber = ';
				$unsetchksql	= 'SELECT * FROM ' . sql_table('member') . ' WHERE madmin = 1 AND mcanlogin = 1';
				$unsetupsql		= sql_table('member') . ' SET madmin = 0 WHERE mnumber = ';
				$unseterrmsg	= _ERROR_ATLEASTONEADMIN;
				break;
			case 'batchteam':
				$blogid			= intRequestVar('blogid');
				$batchlisttype	= _BATCH_ONTEAM;
				$deleteaction	= 'deleteOneTeamMember';
				$setadminsql	= sql_table('team') . ' SET tadmin = 1 WHERE tblog = ' . $blogid . ' AND tmember = ';
				$unsetchksql	= 'SELECT * FROM ' . sql_table('team') . ' WHERE tadmin = 1 AND tblog = ' . $blogid;
				$unseterrmsg	= _ERROR_ATLEASTONEBLOGADMIN;
				$unsetupsql		= sql_table('team') . ' SET tadmin = 0 WHERE tblog = ' . $blogid . ' AND tmember = ';
				break;
			case 'batchcategory':
				$batchlisttype	= _BATCH_ONCATEGORY;
				$deleteaction 	= 'deleteOneCategory';
				$moveaction		= 'moveOneCategory';
				$destid			= intRequestVar('destblogid');
				break;
		}
		
		// walk over all selectedids and perform action
		foreach ( $selected as $selectedid )
		{
			$error = '';
			$selectedid = intval($selectedid);
			switch ( $action )
			{
				case 'delete':
					if ( $this->skintype != 'batchteam' )
					{
						$error = call_user_func_array(array('Admin', $deleteaction), array($selectedid));
					}
					else
					{
						$error = Admin::deleteOneTeamMember($blogid, $selectedid);
					}
					break;
				case 'move':
					$error = call_user_func_array(array('Admin', $moveaction), array($selectedid, $destid));
					break;
				case 'setadmin':
					// always succeeds
					DB::execute("UPDATE {$setadminsql} {$selectedid};");
					$error = '';
					break;
				case 'unsetadmin':
					// there should always remain at least one super-admin
					$r = DB::getResult($unsetchksql);
					if ( $r->rowCount() < 2 )
					{
						$error = $unseterrmsg;
					}
					else
					{
						DB::execute("UPDATE {$unsetupsql} {$selectedid};");
					}
					break;
				default:
					$error = _BATCH_UNKNOWN . Entity::hsc($action);
			}
				
			$data = array(
				'batchid'			=> $selectedid,
				'batchlisttype'		=> Entity::hsc($batchlisttype),
				'adminbatchaction'	=> Entity::hsc($action),
				'batchlistmsg'		=> $error ? $error : _BATCH_SUCCESS,
			);
				
			$this->parser->parse(Template::fill($template, $data));
			echo '<br />';
		}
		return;
	}
	
	/**
	 * AdminActions::parse_adminbloglink()
	 * Parse skinvar adminbloglink
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_adminbloglink($template_name = '')
	{
		global $manager;
		$blogid	=  intRequestVar('blogid');
		$blog	=& $manager->getBlog($blogid);
		$templates = array();
		
		if ( !empty($template_name) )
		{
			$templates =& $manager->getTemplate($template_name);
		}
		
		if ( !array_key_exists('ADMIN_BLOGLINK', $templates) || empty($templates['ADMIN_BLOGLINK']) )
		{
			$template = '<a href="<%url%>" title="<%adminbloglinktitle%>"><%blogname%></a>';
		}
		else
		{
			$template = $templates['ADMIN_BLOGLINK'];
		}
		
		$data = array(
			'url'					=> Entity::hsc($blog->getURL()),
			'adminbloglinktitle'	=> _BLOGLIST_TT_VISIT,
			'blogname'				=> Entity::hsc($blog->getName())
		);
		
		echo Template::fill($template, $data);
		return;
	}
	
	/**
	 * AdminActions::parse_adminerrormesg()
	 * Parse skinvar adminerrormesg
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_adminerrormesg()
	{
		global $CONF;
		$message = '';
		
		if ( requestVar('errormessage') )
		{
			$message = requestVar('errormessage');
		}
		elseif ( cookieVar($CONF['CookiePrefix'] . 'errormessage') )
		{
			$message = cookieVar($CONF['CookiePrefix'] . 'errormessage');
		}
		elseif ( Admin::sessionVar($CONF['CookiePrefix'] . 'errormessage') )
		{
			$message = Admin::sessionVar($CONF['CookiePrefix'] . 'errormessage');
		}
		echo Entity::hsc($message);
		return;
	}
	
	/**
	 * AdminActions::parse_allowedskinactions()
	 * Parse skinvar allowedskinactions
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_allowedskinactions()
	{
		global $manager;
		
		$type = strtolower(trim(requestVar('type')));
		$skinid = intRequestVar('skinid');
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$skin =& $manager->getSkin($skinid);
			$tag = 'skinvar';
		}
		else
		{
			$skin =& $manager->getSkin($skinid, 'AdminActions');
			$tag = 'adminskinvar';
		}
		
		$actions = $skin->getAllowedActionsForType($type);
		sort($actions);
		
		while ( $current = array_shift($actions) )
		{
			echo helplink("{$tag}-{$current}") . "$current</a>\n";
			
			if ( count($actions) != 0 )
			{
				echo ", ";
			}
		}
		return;
	}
	
	/**
	 * AdminActions::parse_banlistdeletedlist()
	 * Parse skinvar banlistdeletedlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_banlistdeletedlist($template_name = '')
	{
		global $manager;
		
		$templates = array();
		if ( $template_name )
		{
			$templates =& $manager->getTemplate($template_name);
		}
		
		if ( !array_key_exists('BANLIST_DELETED_LIST', $templates) || empty($templates['BANLIST_DELETED_LIST']) )
		{
			$template = "<li><%blogname%></li>\n";
		}
		else
		{
			$template = $templates['BANLIST_DELETED_LIST'];
		}
		
		$deleted = requestArray('delblogs');
		foreach ( $deleted as $delblog )
		{
			$blog =& $manager->getBlog($delblog);
			$data =  array(
				'blogname' => Entity::hsc($blog->getName())
			);
			echo Template::fill($template, $data);
		}
		
		return;
	}
	
	/**
	 * AdminActions::parse_batchdeletelist()
	 * Parse skinvar batchdeletelist
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_batchdeletelist()
	{
		$selected = requestIntArray('batch');
		$index	= 0;
		
		foreach ( $selected as $select )
		{
			echo '<input type="hidden" name="batch[' . ($index++) . ']" value="' . intval($select) . "\" />\n";
		}
		// add hidden vars for team & comment
		if ( requestVar('action') == 'batchteam' )
		{
			echo '<input type="hidden" name="blogid" value="' . intRequestVar('blogid') . "\" />\n";
		}
		if ( requestVar('action') == 'batchcomment' )
		{
			echo '<input type="hidden" name="itemid" value="' . intRequestVar('itemid') . "\" />\n";
		}
		return;
	}

	/**
	 * AdminActions::parse_defadminskinselect()
	 * Parse skinvar defadminskinselect
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_defadminskinselect($template_name)
	{
		global $CONF, $action, $manager;
		
		if ( $action == 'editmembersettings' )
		{
			global $member;
			$default = $member->adminskin;
		}
		elseif ( $action == 'memberedit' )
		{
			$mem = $manager->getMember(intRequestVar('memberid'));
			$default = $mem->adminskin;
		}
		else
		{
			$default = $CONF['AdminSkin'];
		}
		
		$query  = "SELECT sdname as text, sdnumber as value FROM %s WHERE sdname LIKE 'admin/%%'";
		$query = sprintf($query, sql_table('skin_desc'));
		$template = array(
				'name'		=> 'adminskin',
				'tabindex'	=> 10080,
				'selected'	=> $default
		);
		
		if ( $this->skintype != 'settingsedit' )
		{
			$template['extra'] = Entity::hsc(_MEMBERS_USESITELANG);
		}
		
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		return;
	}
	
	/**
	 * AdminActions::parse_defbookmarkletselect()
	 * Parse skinvar defbookmarkletselect
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_defbookmarkletselect($template_name)
	{
		global $CONF, $action, $manager;
		
		if ( $action == 'editmembersettings' )
		{
			global $member;
			$default = $member->bookmarklet;
		}
		elseif ( $action == 'memberedit' )
		{
			$mem = $manager->getMember(intRequestVar('memberid'));
			$default = $mem->bookmarklet;
		}
		else
		{
			$default = $CONF['BookmarkletSkin'];
		}
		
		$query  = "SELECT sdname as text, sdnumber as value FROM %s WHERE sdname LIKE 'admin/%%'";
		$query = sprintf($query, sql_table('skin_desc'));
	
		$template = array(
				'name'		=> 'bookmarklet',
				'tabindex'	=> 10085,
				'selected'	=> $default
		);
		
		if ( $this->skintype != 'settingsedit' )
		{
			$template['extra'] = Entity::hsc(_MEMBERS_USESITELANG);
		}
		
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		return;
	}
	
	/**
	 * AdminActions::parse_batchdeletetype()
	 * Parse skinvar batchdeletetype
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_batchdeletetype()
	{
		echo Entity::hsc(requestVar('action'));
		return;
	}
	
	/**
	 * AdminActions::parse_batchmovebtn()
	 * Parse skinvar batchmovebtn
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_batchmovebtn()
	{
		$actionType = requestVar('action');
		switch ( $actionType )
		{
			case 'batchitem':
				echo _MOVE_BTN;
				break;
			case 'batchcategory':
				echo _MOVECAT_BTN;
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_batchmovelist()
	 * Parse skinvar batchmovelist
	 *
	 * @param	void
	 * @param	void
	 */
	public function parse_batchmovelist()
	{
		$selected = requestIntArray('batch');
		$count    = 0;
		foreach ( $selected as $select )
		{
			echo '<input type="hidden" name="batch[' . ($count) . ']" value="' . intval($select) . "\" />\n";
			$count++;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_batchmovetitle()
	 * Parse skinvar batchmovetitle
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_batchmovetitle()
	{
		$actionType = requestVar('action');
		switch ( $actionType )
		{
			case 'batchitem':
				echo _MOVE_TITLE;
				break;
			case 'batchcategory':
				echo _MOVECAT_TITLE;
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_batchmovetype()
	 * Parse skinvar batchmovetype
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_batchmovetype()
	{
		echo Entity::hsc(requestVar('action'));
		return;
	}
	
	/**
	 * AdminActions::parse_blogcatlist()
	 * Parse skinvar blogcatlist
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_blogcatlist($template_name = '')
	{
		global $manager;
		$blogid = intRequestVar('blogid');
		$query = "SELECT * FROM %s WHERE cblog = %d ORDER BY cname;";
		$query = sprintf($query, sql_table('category'), (integer) $blogid);
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['content']  = 'categorylist';
			$template['tabindex'] = 200;
			$this->parser->parse(listplug_batchlist('category', $resource, 'table', $template, $template_name));
		}
		else
		{
			/* TODO: nothing to be shown */
		}
		$resource->closeCursor();
		
		return;
	}
	
	/**
	 * AdminActions::parse_blogid()
	 * Parse skinvar blogid
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_blogid()
	{
		echo intRequestVar('blogid');
		return;
	}
	
	/**
	 * AdminActions::parse_blognotifysetting()
	 * Parse skinvar blognotifysetting
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_blognotifysetting($type)
	{
		global $manager;
		$blogid	=  intRequestVar('blogid');
		$blog	=& $manager->getBlog($blogid);
		
		switch ( $type )
		{
			case 'comment':
				if ( !$blog->notifyOnComment() )
				{
					return;
				}
				break;
			case 'vote':
				if ( !$blog->notifyOnVote() )
				{
					return;
				}
				break;
			case 'newitem':
				if ( !$blog->notifyOnNewItem() )
				{
					return;
				}
				break;
		}
		echo ' checked="checked"';
		return;
	}
	
	/**
	 * AdminActions::parse_blogsetting()
	 * Parse skinvar blogsetting
	 *
	 * @param	string	$which	name of weblog setting
	 * @return	void
	 */
	public function parse_blogsetting($which)
	{
		echo $this->parse_getblogsetting($which);
		return;
	}
	
	/**
	 * AdminActions::parse_blogsettingyesno()
	 * Parse skinvar blogsettingyesno
	 *
	 * @param	string	$type			type of weblog setting
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_blogsettingyesno($type, $template_name = '')
	{
		global $manager;

		$blogid	=  intRequestVar('blogid');
		$blog	=& $manager->getBlog($blogid);

		switch ( $type )
		{
			case 'convertbreaks':
				$checkedval = $blog->convertBreaks();
				$tabindex   = 55;
				break;
			case 'allowpastposting':
				$checkedval = $blog->allowPastPosting();
				$tabindex   = 57;
				break;
			case 'comments':
				$checkedval = $blog->commentsEnabled();
				$tabindex   = 60;
				break;
			case 'public':
				$checkedval = $blog->isPublic();
				$tabindex   = 70;
				break;
			case 'reqemail':
				$checkedval = $blog->emailRequired();
				$tabindex   = 72;
				break;
			case 'searchable':
				$checkedval = $blog->getSearchable();
				$tabindex   = 122;
				break;
		}
		$this->parse_inputyesno($type, $checkedval, $tabindex, 1, 0, _YES, _NO, 0, $template_name);
		return;
	}
	
	/**
	 * AdminActions::parse_blogteamlist()
	 * Parse skinvar blogteamlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_blogteamlist($template_name = '')
	{
		global $manager;
		$blogid = intRequestVar('blogid');
		$query = "SELECT tblog, tmember, mname, mrealname, memail, tadmin "
		. "FROM %s, %s "
		. "WHERE tmember=mnumber AND tblog= %d";
		$query = sprintf($query, sql_table('member'), sql_table('team'), (integer) $blogid);
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['content']  = 'teamlist';
			$template['tabindex'] = 10;
				
			$this->parser->parse(listplug_batchlist('team', $resource, 'table', $template, $template_name));
		}
		else
		{
			echo _LISTS_NOMORE;
		}
		$resource->closeCursor();
		
		return;
	}
	
	/**
	 * AdminActions::parse_blogteammembers()
	 * Parse skinvar blogteammembers
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_blogteammembers()
	{
		$blogid = intRequestVar('blogid');
		$query  = "SELECT mname, mrealname "
		. "FROM %s, %s "
		. "WHERE mnumber=tmember AND tblog=%d;";
		$query = sprintf($query, sql_table('member'), sql_table('team'), (integer) $blogid);
		$res = DB::getResult($query);
		$memberNames = array();
		foreach ( $res as $row )
		{
			$memberNames[] = Entity::hsc($row['mname']) . ' (' . Entity::hsc($row['mrealname']). ')';
		}
		echo implode(',', $memberNames);
	}
	
	/**
	 * AdminActions::parse_blogtime()
	 * Parse skinvar blogtime
	 *
	 * @param	string	$type	type of time
	 * @param	string	$format	format for time expression
	 * @param	integer	$offset	offset of time
	 * @return	void
	 */
	public function parse_blogtime($type, $format = '%H:%M', $offset = 0)
	{
		global $manager;
		
		if ( $type != 'blogtime' )
		{
			/* return server time */
			$timestamp = time() + $offset;
		}
		else
		{
			$bid = intRequestVar('blogid');
			$b =& $manager->getBlog($bid);
			$timestamp = $b->getCorrectTime() + $offset;
		}
		
		echo i18n::formatted_datetime($format, $timestamp);
		return;
	}
	
	/**
	 * AdminActions::parse_bookmarkletadmin()
	 * Parse skinvar bookmarkletadmin
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_bookmarkletadmin()
	{
		global $manager;
		
		$blogid = intRequestVar('blogid');
		
		echo Entity::hsc('javascript:' . getBookmarklet($blogid));
		return;
	}
	
	/**
	 * AdminActions::parse_categories()
	 * Parse skinvar categories
	 *
	 * create category dropdown box
	 *
	 * @param	string	$type	name of setting for category
	 * @return	void
	 */
	public function parse_categories($startidx = 0)
	{
		global $manager;
		
		if ( !array_key_exists('catid', Admin::$contents) || empty(Admin::$contents['catid']) )
		{
			$catid = Admin::$blog->getDefaultCategory();
		}
		else
		{
			$catid = Admin::$contents['catid'];
		}
		
		$this->selectBlog('catid', 'category', $catid, $startidx, 1, Admin::$blog->getID());
		
		return;
	}

	/**
	 * AdminActions::parse_categorysetting()
	 * Parse skinvar categorysetting
	 *
	 * @param	string	$type	type in category setting
	 * @return	void
	 */
	public function parse_categorysetting($type)
	{
		$catid  = intRequestVar('catid');
		if ( $type == 'id' )
		{
			echo $catid;
			return;
		}
		$blogid = intRequestVar('blogid');
		$query	= "SELECT * FROM %s WHERE cblog = %d AND catid = %d;";
		$query	= sprintf($query, sql_table('category'), (integer) $blogid, (integer) $catid);
		$row	= DB::getRow($query);
		
		if ( $type != 'name' )
		{
			echo Entity::hsc($row['cdesc']);
		}
		else
		{
			echo Entity::hsc($row['cname']);
		}
		
		return;
	}
	
	/**
	 * AdminActions::parse_codename()
	 * Parse templatevar codename
	 *
	 * @param	$value
	 * @param	$name
	 *
	 */
	public function parse_checkedonval($value, $name)
	{
		global $manager;
		
		$item = false;
		$itemid = intRequestVar('itemid');
		$item =& $manager->getItem($itemid, 1, 1);
		
		if ( $item )
		{
			$blog =& $manager->getBlog($item['blogid']);
			
			if ( $blog->convertBreaks() && requestVar('action') == 'itemedit' )
			{
				$item['body'] = removeBreaks($item['body']);
				$item['more'] = removeBreaks($item['more']);
			}
		}
		
		$contents = array();
		if ( requestVar('action') == 'itemedit' )
		{
			$contents = $item;
		}
		if ( !isset($contents[$name]) )
		{
			$contents[$name] = '';
		}
		if ($contents[$name] == $value)
		{
			echo 'checked="checked"';
		}
		return;
	}
	
	/**
	 * AdminActions::parse_codename()
	 * Parse templatevar codename
	 *
	 * @param	void
	 * @return	void
	 *
	 * TODO: is this need???
	 */
	public function parse_codename()
	{
		global $nucleus;
		echo $nucleus['codename'];
		return;
	}
	
	/**
	 * AdminActions::parse_commentnavlist()
	 * Parse skinvar commentnavlist
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_commentnavlist()
	{
		global $CONF, $manager, $member;
		
		// start index
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = (integer) $CONF['DefaultListSize'];
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		$query = 'SELECT cbody, cuser, cmail, cemail, mname, ctime, chost, cnumber, cip, citem '
		       . 'FROM %s '
		       . 'LEFT OUTER JOIN %s ON  mnumber=cmember '
		       . 'WHERE ';
		$query = sprintf($query, sql_table('comment'), sql_table('member'));
		
		if ( $this->skintype == 'itemcommentlist' )
		{
			$itemid					= intRequestVar('itemid');
			$query					.= " citem={$itemid}";
			$template['canAddBan']	= $member->blogAdminRights(intRequestVar('blogid'));
			$bid					= 0;
			$nonComments			= _NOCOMMENTS;
		}
		elseif ( $this->skintype == 'browseowncomments' )
		{
			$itemid					= 0;
			$query					.= ' cmember=' . $member->getID();
			$template['canAddBan']	= 0;
			$bid					= 0;
			$nonComments			= _NOCOMMENTS_YOUR;
		}
		elseif ( $this->skintype == 'blogcommentlist' )
		{
			$itemid					= 0;
			$query					.= ' cblog=' . intRequestVar('blogid');
			$template['canAddBan']	= $member->blogAdminRights(intRequestVar('blogid'));
			$bid					= intRequestVar('blogid');
			$nonComments			= _NOCOMMENTS_BLOG;
		}
		
		$search = postVar('search');
		if ( !empty($search) )
		{
			$query .= ' and cbody LIKE ' . DB::quoteValue('%'.$search.'%');
		}
		
		$query .= " ORDER BY ctime ASC LIMIT {$start},{$amount}";
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['action'] = $this->skintype;
			$template['start'] = $start;
			$template['amount'] = $amount;
			$template['minamount'] = 0;
			$template['maxamount'] = 1000;
			$template['blogid'] = $bid;
			$template['search'] = $search;
			$template['itemid'] = $itemid;
				
			$template['content'] = 'commentlist';
				
			$this->parser->parse(listplug_navlist('comment', $resource, 'table', $template));
		}
		else
		{
			/* TODO: nothing to be shown */
		}
		$resource->closeCursor();
		
		return;
	}
	
	/**
	 * AdminActions::parse_configsettingsedit()
	 * Parse skinvar configsettingsedit
	 *
	 * @param	string	$type	type of global configuration
	 * @return	void
	 */
	public function parse_configsettingsedit($type)
	{
		global $CONF;
		switch ( $type )
		{
			case 'DefaultListSize':
				if ( !array_key_exists('DefaultListSize', $CONF) )
				{
					$query = "INSERT INTO %s VALUES (DefaultListSize, 10);";
					$query = sprintf($query, sql_table('config'));
					DB::execute($query);
					$CONF['DefaultListSize'] = 10;
				}
				elseif ( intval($CONF['DefaultListSize']) < 1 )
				{
					$CONF['DefaultListSize'] = 10;
				}
				echo intval($CONF['DefaultListSize']);
				break;
			case 'SessionCookie':
				$value = $CONF['SessionCookie'];
				$txt1  = _SETTINGS_COOKIESESSION;
				$txt2  = _SETTINGS_COOKIEMONTH;
				$this->parse_inputyesno('SessionCookie', $value, 10190, 1, 0, $txt1, $txt2);
				break;
			case 'URLMode':
				$value = $CONF['URLMode'];
				$txt1  = _SETTINGS_URLMODE_NORMAL;
				$txt2  = _SETTINGS_URLMODE_PATHINFO;
				$this->parse_inputyesno('URLMode', $value, 10077, 'normal', 'pathinfo', $txt1, $txt2);
				break;
			default:
				if ( array_key_exists($type, $CONF) && is_string($CONF[$type]) )
				{
					echo  Entity::hsc($CONF[$type]);
				}
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_configsettingsyesno()
	 * Parse skinvar configsettingsyesno
	 *
	 * @param	string	$type		type of global setting
	 * @param	integer	$tabindex	tabindex attribute of input element
	 * @return	void
	 */
	public function parse_configsettingsyesno($type, $tabindex)
	{
		global $CONF;
		if ( array_key_exists($type, $CONF) )
		{
			$this->parse_inputyesno($type, $CONF[$type], $tabindex);
		}
		return;
	}
	
	/**
	 * AdminActions::parse_contents()
	 * Parse skinvar contents
	 *
	 * @param	string	$which		part for item
	 * @return	void
	 */
	public function parse_contents($which)
	{
		if ( !array_key_exists($which, Admin::$contents) )
		{
			Admin::$contents[$which] = '';
		}
		echo Entity::hsc(Admin::$contents[$which]);
	}
	
	/**
	 * AdminActions::parse_currenttime()
	 * Parse skinvar currenttime
	 *
	 * @param	string	$what
	 */
	// for future items
	public function parse_currenttime($what)
	{
		$nu = getdate(Admin::$blog->getCorrectTime());
		echo $nu[$what];
	}
	
	/**
	 * AdminActions::parse_customhelplink()
	 * Parse skinvar customhelplink
	 *
	 * @param	string	$topic		name of topic
	 * @param	string	$tplName	name of template
	 * @param	string	$url		string as URI
	 * @param	string	$iconURL	string as URI for icon
	 * @param	string	$alt		alternative text for image element
	 * @param	string	$title		title for anchor element
	 * @return	void
	 */
	public function parse_customhelplink($topic, $tplName = '', $url = '', $iconURL = '', $alt = '', $title = '', $onclick = '')
	{
		$this->customHelp($topic, $url, $iconURL);
		return;
	}
	
	/**
	 * AdminActions::parse_date()
	 * Parse skinvar date
	 */
	public function parse_date($format = 'c')
	{
		global $CONF, $manager;
		/* TODO: offset is based on i18n::get_current_locale()? */
		echo i18n::formatted_datetime($format, time());
		return;
	}
	
	/**
	 * AdminActions::parse_normalskinlist()
	 * Parse skinvar defaultadminskintypes
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_normalskinlist($template_name = '')
	{
		global $CONF, $manager;
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$skin =& $manager->getSkin($CONF['BaseSkin']);
			/* TODO: removeaction? */
			$template['editaction'] = 'skinedittype';
		}
		else
		{
			$skin =& $manager->getSkin($CONF['AdminSkin'], 'AdminActions');
			$template['editaction'] = 'adminskinedittype';
			/* TODO: removeaction? */
		}
		
		$temporary = $skin->getNormalTypes();
		$normal_skintype = array();
		foreach ( $temporary as $type => $label )
		{
			$normal_skintype[] = array(
				'skintype'		=> $type,
				'skintypename'	=> $label
			);
		}
		
		$template['tabindex'] = 10;
		$template['skinid'] = intRequestVar('skinid');
		$template['skinname'] = $skin->getName();
		$this->parser->parse(showlist($normal_skintype, 'list_normalskinlist', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_defblogselect()
	 * Parse skinvar defblogselect
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_defblogselect($template_name = '')
	{
		global $CONF;
		
		$query = "SELECT bname as text, bnumber as value FROM %s;";
		$query = sprintf($query, sql_table('blog'));
		
		$template['name'] = 'DefaultBlog';
		$template['selected'] = $CONF['DefaultBlog'];
		$template['tabindex'] = 10;
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_defcatselect()
	 * Parse skinvar defcatselect
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_defcatselect($template_name = '')
	{
		global $manager;
		
		$blogid = intRequestVar('blogid');
		$blog =& $manager->getBlog($blogid);
		
		$query = "SELECT cname as text, catid as value FROM %s WHERE cblog=%d;";
		$query = sprintf($query, sql_table('category'), (integer) $blog->getID());
		
		$template['name']	 = 'defcat';
		$template['selected'] = $blog->getDefaultCategory();
		$template['tabindex'] = 110;
		
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_defskinselect()
	 * Parse skinvar defskinselect
	 *
	 * @param	string	$type			type of skin
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_defskinselect($type = 'blog', $template_name = '')
	{
		global $CONF, $manager, $member;
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$blogid = intRequestVar('blogid');
			if ( !$blogid )
			{
				$template['selected'] = $CONF['BaseSkin'];
			}
			else
			{
				$blog =& $manager->getBlog($blogid);
				$template['selected'] = $blog->getDefaultSkin();
			}
				
			if ( $type != 'blog' )
			{
				$template['name'] = 'BaseSkin';
			}
			else
			{
				$template['name'] = 'defskin';
			}
				
			$query = "SELECT sdname as text, sdnumber as value FROM %s WHERE sdname NOT LIKE 'admin/%%';";
		}
		else
		{
			/* TODO: member object will have its own adminskin id */
			$template['selected'] = $CONF['AdminSkin'];
			$template['name'] = 'AdminSkin';
			$query = "SELECT sdname as text, sdnumber as value FROM %s WHERE sdname LIKE 'admin/%%';";
		}
		
		$query = sprintf($query, sql_table('skin_desc'));
		$template['tabindex'] = 50;
		
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_deletecomment()
	 * Parse skinvar deletecomment
	 *
	 * @param	string	$type	type of infomation for comment
	 * @return	void
	 */
	public function parse_deletecomment($type = 'id')
	{
		$commentid	= intRequestVar('commentid');
		$comment	= COMMENT::getComment($commentid);
		
		switch ( $type )
		{
			case 'id':
				echo intRequestVar('commentid');
				break;
			case 'author':
				if ( array_key_exists('member', $comment) && !empty($comment['member']) )
				{
					echo $comment['member'];
				}
				else
				{
					echo $comment['user'];
				}
				break;
			case 'body':
				$body = strip_tags($comment['body']);
				echo Entity::hsc(shorten($body, 300, '...'));
		}
		return;
	}
	
	/**
	 * AdminActions::parse_deleteitembody()
	 * Parse skinvar deleteitembody
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_deleteitembody()
	{
		global $manager;
		
		$itemid	=  intRequestVar('itemid');
		$item =& $manager->getItem($itemid, 1, 1);
		
		$body =  strip_tags($item['body']);
		
		echo Entity::hsc(shorten($body, 300, '...'));
		
		return;
	}
	
	/**
	 * AdminActions::parse_deleteitemid()
	 * Parse skinvar deleteitemid
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_deleteitemid()
	{
		echo (integer) intRequestVar('itemid');
		return;
	}
	
	/**
	 * AdminActions::parse_deleteitemtitle()
	 * Parse skinvar deleteitemtitle
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_deleteitemtitle()
	{
		global $manager;
		
		$itemid = intRequestVar('itemid');
		$item =& $manager->getItem($itemid, 1, 1);
		
		echo Entity::hsc(strip_tags($item['title']));
		
		return;
	}
	
	/**
	 * AdminActions::parse_editcomment()
	 * Parse skinvar editcomment
	 *
	 * @param	string	$type	type of comment setting
	 * @return	void
	 */
	public function parse_editcomment($type = 'id')
	{
		global $manager;
		
		$comment = Admin::$contents;
		
		switch ( $type )
		{
			case 'id':
				echo intRequestVar('commentid');
				break;
			case 'user':
				if ( !array_key_exists('member', $comment) || empty($comment['member']) )
				{
					echo $comment['user'] . " (" . _EDITC_NONMEMBER . ")";
				}
				else
				{
					echo $comment['member'] . " (" . _EDITC_MEMBER . ")";
				}
				break;
			case 'date':
				echo date("Y-m-d @ H:i", $comment['timestamp']);
				break;
			case 'body':
				$comment['body'] = str_replace('<br />', '', $comment['body']);
				$comment['body'] = preg_replace("#<a href=['\"]([^'\"]+)['\"]( rel=\"nofollow\")?>[^<]*</a>#", "\\1", $comment['body']);
				echo $comment['body'];
				break;
			case 'cmail':
				echo $comment['userid'];
				break;
			case 'url':
				echo $comment['userid'];
				break;
			default:
				if ( array_key_exists($type, $comment) && !empty($comment[$type]) )
				{
					echo $comment[$type];
				}
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editdesturl()
	 * Parse skinvar editdesturl
	 */
	public function parse_editdesturl()
	{
		if ( requestVar('desturl') )
		{
			echo Entity::hsc(requestVar('desturl'));
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editmemberlist()
	 * Parse skinvar editmemberlist
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_editmemberlist($template_name = '')
	{
		global $manager;
		// show list of members with actions
		$query = 'SELECT * FROM %s;';
		$query =  sprintf($query, sql_table('member'));
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['content'] = 'memberlist';
			$template['tabindex'] = 10;
				
			$this->parser->parse(listplug_batchlist('member', $resource, 'table', $template, $template_name));
		}
		else
		{
			echo _LISTS_NOMORE;
		}
		$resource->closeCursor();
		
		return;
	}
	
	/**
	 * AdminActions::parse_editmember()
	 * Parse skinvar editmember
	 *
	 * @param	string	$type			type of information for member
	 * @return	string	$tempateName	name of template to use
	 * @return	void
	 */
	public function parse_editmember($type = 'id', $template_name = '')
	{
		global $CONF, $manager, $member;
		
		$memberid = intRequestVar('memberid');
		$mem =& $manager->getMember($memberid);
		
		switch ( $type )
		{
			case 'id':
				echo intRequestVar('memberid');
				break;
			case 'displayname':
				if ( $this->skintype == 'teamdelete' || $this->skintype == 'memberdelete' )
				{
					echo Entity::hsc($mem->getDisplayName());
				}
				else
				{
					$dispName = Entity::hsc($mem->getDisplayName());
					if ( $CONF['AllowLoginEdit'] || $member->isAdmin() )
					{
						echo '<input name="name" tabindex="10" maxlength="32" size="32" value="' . $dispName . "\" />\n";
					}
					else
					{
						echo $dispName;
					}
				}
				break;
			case 'realname':
				echo Entity::hsc($mem->getRealName());
				break;
			case 'email':
				echo Entity::hsc($mem->getEmail());
				break;
			case 'url':
				echo Entity::hsc($mem->getURL());
				break;
			case 'admin':
				$this->parse_inputyesno('admin', $mem->isAdmin(), 60, 1, 0, _YES, _NO, 0, $template_name);
				break;
			case 'canlogin':
				$this->parse_inputyesno('canlogin', $mem->canLogin(), 70, 1, 0, _YES, _NO, $mem->isAdmin(), $template_name);
				break;
			case 'notes':
				echo Entity::hsc($mem->getNotes());
				break;
			case 'autosave':
				$this->parse_inputyesno('autosave', $mem->getAutosave(), 87, 1, 0, _YES, _NO, 0, $template_name);
				break;
			default:
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editpluginfo()
	 * Parse skinvar editpluginfo
	 *
	 * @param	string	$type	type of plugin info
	 * @return	void
	 */
	public function parse_editpluginfo($type)
	{
		global $manager;
		
		$pid = intRequestVar('plugid');
		switch ( $type )
		{
			case 'id':
				echo $pid;
				break;
			case 'name':
				echo Entity::hsc($manager->getPluginNameFromPid($pid));
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editplugoptionslist()
	 * Parse skinvar editplugoptionslist
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_editplugoptionslist($template_name = '')
	{
		global $manager;
		
		$pid = intRequestVar('plugid');
		$aOptions = array();
		$aOIDs	= array();
		
		$query	= "SELECT * FROM %s WHERE ocontext='global' AND opid=%d ORDER BY oid ASC;";
		$query = sprintf($query, sql_table('plugin_option_desc'), (integer) $pid);
		$resource = DB::getResult($query);
		
		foreach ( $resource as $row )
		{
			$aOIDs[] = $row['oid'];
			$aOptions[$row['oid']] = array(
				'oid'			=> $row['oid'],
				'value'			=> $row['odef'],
				'name'			=> $row['oname'],
				'description'	=> $row['odesc'],
				'type'			=> $row['otype'],
				'typeinfo'		=> $row['oextra'],
				'contextid'		=> 0
			);
		}
		
		// fill out actual values
		if ( count($aOIDs) > 0 )
		{
			$query = 'SELECT oid, ovalue FROM %s WHERE oid in (%s)';
			$query = sprintf($query, sql_table('plugin_option'), implode(',', $aOIDs));
				
			$result = DB::getResult($query);
			foreach ( $result as $row )
			{
				$aOptions[$row['oid']]['value'] = $row['ovalue'];
			}
		}
	
		// call plugins
		$data = array(
			'context'	=>  'global',
			'plugid'	=>  $pid,
			'options'	=> &$aOptions
		);
		$manager->notify('PrePluginOptionsEdit', $data);
		
		if ( sizeof($aOptions) > 0 )
		{
			$template['content'] = 'plugoptionlist';
			$this->parser->parse(showlist($aOptions, 'table', $template, $template_name));
		}
		else
		{
			echo '<p>' . _ERROR_NOPLUGOPTIONS . "</p>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editskin()
	 * Parse skinvar editskin
	 *
	 * @param	string	$type	type of skin
	 * @return	void
	 */
	public function parse_editskin($type = 'id')
	{
		global $manager;
		
		$skinid = intRequestVar('skinid');
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$skin =& $manager->getSKIN($skinid);
		}
		else
		{
			$skin =& $manager->getSKIN($skinid, 'AdminActions');
		}
		
		switch ( $type )
		{
			case 'id':
				echo intRequestVar('skinid');
				break;
			case 'name':
				echo Entity::hsc($skin->getName());
				break;
			case 'desc':
				echo Entity::hsc($skin->getDescription());
				break;
			case 'type':
				echo Entity::hsc($skin->getContentType());
				break;
			case 'prefix':
				echo Entity::hsc($skin->getIncludePrefix());
				break;
			case 'mode':
				$this->parse_inputyesno('inc_mode', $skin->getIncludeMode(), 120, 'skindir', 'normal', _PARSER_INCMODE_SKINDIR, _PARSER_INCMODE_NORMAL);
			default:
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_editskintype()
	 * Parse skinvar editskintype
	 *
	 * @param	string	$type	name of type for skin type
	 * @return	void
	 */
	public function parse_editskintype($stype = 'id')
	{
		global $manager;
		
		static $skin = NULL;
		static $types = array();
		
		if ( $skin == NULL )
		{
			$skinid = intRequestVar('skinid');
			
			if ( !in_array($this->skintype, Admin::$adminskin_actions) )
			{
				$skin =& $manager->getSkin($skinid);
			}
			else
			{
				$skin =& $manager->getSkin($skinid, 'AdminActions');
			}
			
			$types = $skin->getNormalTypes();
		}
		
		$type = strtolower(trim(requestVar('type')));
		
		switch ( $stype )
		{
			case 'id':
				echo $skin->getID();
				break;
			case 'name':
				echo Entity::hsc($skin->getName());
				break;
			case 'desc':
				echo Entity::hsc($skin->getDescription());
				break;
			case 'type':
				echo Entity::hsc($skin->getContentType());
				break;
			case 'content':
				echo Entity::hsc($skin->getContentFromDB($type));
				break;
			case 'skintype':
				if ( !array_key_exists($type, $types) )
				{
					$skinType = ucfirst($type);
				}
				else
				{
					$skinType = $types[$type];
				}
				echo Entity::hsc($skinType);
				break;
			case 'skintyperaw':
				echo Entity::hsc($type);
				break;
			case 'prefix':
				echo Entity::hsc($skin->getIncludePrefix());
				break;
			case 'mode':
				if ( !$skin->getIncludeMode() != 'skindir' )
				{
					$incMode = _PARSER_INCMODE_NORMAL;
				}
				else
				{
					$incMode = _PARSER_INCMODE_SKINDIR;
				}
				echo Entity::hsc($incMode);
				break;
			default:
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_adminurl()
	 * Parse skinvar adminurl
	 * (shortcut for admin url)
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_adminurl()
	{
		$this->parse_sitevar('adminurl');
		return;
	}
	
	/**
	 * AdminActions::parse_edittemplateinfo()
	 * Parse skinvar edittemplateinfo
	 *
	 * @param	string	$format		format to output
	 * @param	string	$typedesc	type of template
	 * @param	string	$typename	type name of template
	 * @param	string	$help		help text
	 * @param	string	$tabindex	index value for tabindex attribute of input element
	 * @param	string	$big		textarea size
	 * @param	string	$tplt		name of template to be filled
	 * @return	boolean
	 */
	public function parse_edittemplateinfo($format, $typedesc = '', $typename = '', $help = '', $tabindex = 0, $big = 0, $template_name = '')
	{
		global $manager;
		static $id = NULL;
		static $name = NULL;
		static $desc = NULL;
		
		if ( $id == NULL )
		{
			$id = intRequestVar('templateid');
		}
		
		if ( $name == NULL )
		{
			$name = Template::getNameFromId($id);
		}
		
		if ( $desc == NULL )
		{
			$desc = Template::getDesc($id);
		}
		
		$template =& $manager->getTemplate($name);
		
		switch ( $format )
		{
			case 'id':
				echo (integer) $id;
				break;
			case 'name':
				echo Entity::hsc($name);
				break;
			case 'desc':
				echo Entity::hsc($desc);
				break;
			case 'extratemplate':
				$tabidx = 600;
				$pluginfields = array();
				if ( !in_array($this->skintype, Admin::$adminskin_actions) )
				{
					$data = array('fields' => &$pluginfields);
					$manager->notify('TemplateExtraFields', $data);
				}
				else
				{
					$data = array('fields' => &$pluginfields);
					$manager->notify('AdminTemplateExtraFields', $data);
				}
				
				foreach ( $pluginfields as $ptkey => $ptvalue )
				{
					$tmplt = array();
					if ( $desc )
					{
						$tmplt =& $manager->getTemplate($desc);
					}
						
					/* extra plugin field */
					if ( !array_key_exists('TEMPLATE_EDIT_EXPLUGNAME', $tmplt) || empty($tmplt['TEMPLATE_EDIT_EXPLUGNAME']) )
					{
						$base = "<tr>\n"
						      . "<th colspan=\"2\"><%explugtplname%></th>\n"
						      . "</tr>";
					}
					else
					{
						$base = $tmplt['TEMPLATE_EDIT_EXPLUGNAME'];
					}
					$data = array(
						'explugtplname' => Entity::hsc($ptkey)
					);
					echo Template::fill($base, $data);
						
					foreach ( $ptvalue as $ptname => $ptdesc )
					{
						if ( !array_key_exists($ptname, $template) )
						{
							$content = '';
						}
						else
						{
							$content = $template[$ptname];
						}
						$this->parser->parse(listplug_templateEditRow($content, $ptdesc, $ptname, $help, $tabidx++, $big, $template_name));
						continue;
					}
				}
				break;
			default:
				$typedesc = defined($typedesc) ? constant($typedesc) : $typedesc;
				$typename = defined($typename) ? constant($typename) : $typename;
				
				if ( !array_key_exists($typename, $template) )
				{
					$content = '';
				}
				else
				{
					$content = $template[$typename];
				}
				$this->parser->parse(listplug_templateEditRow($content, $typedesc, $typename, $help, $tabindex, $big, $template_name));
				break;
		}
		
		return;
	}
	
	/**
	 * AdminActions::parse_eventformextra()
	 * Parse skinvar eventformextra
	 *
	 * @param	string	$type	name of type for event form extra
	 * @return	void
	 */
	public function parse_eventformextra($type = 'activation')
	{
		global $manager;
		
		$data = array();
		
		switch ( $type )
		{
			case 'activation':
				$key = requestVar('ackey');
				if ( !$key )
				{
					Admin::error(_ERROR_ACTIVATE);
				}
				$info = MEMBER::getActivationInfo($key);
				if ( !$info )
				{
					Admin::error(_ERROR_ACTIVATE);
				}
				$mem  =& $manager->getMember($info->vmember);
				if ( !$mem )
				{
					Admin::error(_ERROR_ACTIVATE);
				}
				$data = array(
					'type'		=> 'activation',
					'member'	=> $mem
				);
				break;
			case 'membermailform-notloggedin':
				$data = array('type' => 'membermailform-notloggedin',);
				break;
		}
		$manager->notify('FormExtra', $data);
		return;
	}
	
	/**
	 * AdminActions::parse_extrahead()
	 * Parse skinvar extrahead
	 */
	public function parse_extrahead()
	{
		global $manager;
		
		$data = array(
			'extrahead'	=> &Admin::$extrahead,
			'action'	=> Admin::$action
		);
		
		$manager->notify('AdminPrePageHead', $data);
		
		$this->parser->parse(Admin::$extrahead);
		return;
	}
	
	/**
	 * AdminActions::parse_member()
	 * Parse skinvar member
	 * (includes a member info thingie)
	 *
	 * @param	string	$what	which memberdata is needed
	 * @return	void
	 */
	public function parse_member($what)
	{
		global $memberinfo, $member, $CONF;
		
		// 1. only allow the member-details-page specific variables on member pages
		if ( $this->skintype == 'member' )
		{
			switch( $what )
			{
				case 'name':
					echo Entity::hsc($memberinfo->getDisplayName());
					break;
				case 'realname':
					echo Entity::hsc($memberinfo->getRealName());
					break;
				case 'notes':
					echo Entity::hsc($memberinfo->getNotes());
					break;
				case 'url':
					echo Entity::hsc($memberinfo->getURL());
					break;
				case 'email':
					echo Entity::hsc($memberinfo->getEmail());
					break;
				case 'id':
					echo Entity::hsc($memberinfo->getID());
					break;
			}
		}
		
		// 2. the next bunch of options is available everywhere, as long as the user is logged in
		if ( $member->isLoggedIn() )
		{
			switch( $what )
			{
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
				case 'yourprofileurl':
					if ( $CONF['URLMode'] == 'pathinfo' )
					{
						echo Link::create_member_link($member->getID());
					}
					else
					{
						echo $CONF['IndexURL'] . Link::create_member_link($member->getID());
					}
					break;
			}
		}
		return;
	}
	
	/**
	 * AdminActions::parse_version()
	 * Parse skinvar version
	 * (include nucleus versionnumber)
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_version()
	{
		global $nucleus;
		echo 'Nucleus CMS ' . $nucleus['version'];
		return;
	}
	
	/**
	 * AdminActions::parse_sitevar()
	 * Parse skinvar sitevar
	 * (include a sitevar)
	 *
	 * @param	string	$which
	 * @return	void
	 */
	public function parse_sitevar($which)
	{
		global $CONF;
		switch ( $which )
		{
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
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_actionurl()
	 * Parse $CONF;
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_actionurl()
	{
		global $CONF;
		echo Entity::hsc($CONF['ActionURL']);
		return;
	}
	
	/**
	 * AdminActions::parse_getblogsetting()
	 * Parse skinvar getblogsetting
	 */
	public function parse_getblogsetting($which)
	{
		global $blog, $manager;
		
		if ( $blog )
		{
			$b =& $blog;
		}
		elseif ( $bid = intRequestVar('blogid') )
		{
			$b =& $manager->getBlog($bid);
		}
		else
		{
			return;
		}
	
		switch ( $which )
		{
			case 'id':
				return Entity::hsc($b->getID());
				break;
			case 'url':
				return Entity::hsc($b->getURL());
				break;
			case 'name':
				return Entity::hsc($b->getName());
				break;
			case 'desc':
				return Entity::hsc($b->getDescription());
				break;
			case 'short':
				return Entity::hsc($b->getShortName());
				break;
			case 'notifyaddress':
				return Entity::hsc($b->getNotifyAddress());
				break;
			case 'maxcomments':
				return Entity::hsc($b->getMaxComments());
				break;
			case 'updatefile':
				return Entity::hsc($b->getUpdateFile());
				break;
			case 'timeoffset':
				return Entity::hsc($b->getTimeOffset());
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_geteditpluginfo()
	 * Parse skinvar geteditpluginfo
	 *
	 * @param	string	$type	name of setting for edit plugin info
	 * @return	void
	 */
	public function parse_geteditpluginfo($type)
	{
		global $manager;
		$pid = intRequestVar('plugid');
		switch ( $type )
		{
			case 'id':
				return $pid;
				break;
			case 'name':
				return Entity::hsc($manager->getPluginNameFromPid($pid));
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_getmember()
	 * Parse skinvar getmember
	 * (includes a member info thingie)
	 *
	 * @param	string	$what	name of setting for member
	 * @return	void
	 */
	public function parse_getmember($what)
	{
		global $memberinfo, $member;
		// 1. only allow the member-details-page specific variables on member pages
		if ( $this->skintype == 'member' )
		{
			switch ( $what )
			{
				case 'name':
					return Entity::hsc($memberinfo->getDisplayName());
					break;
				case 'realname':
					return Entity::hsc($memberinfo->getRealName());
					break;
				case 'notes':
					return Entity::hsc($memberinfo->getNotes());
					break;
				case 'url':
					return Entity::hsc($memberinfo->getURL());
					break;
				case 'email':
					return Entity::hsc($memberinfo->getEmail());
					break;
				case 'id':
					return Entity::hsc($memberinfo->getID());
					break;
			}
		}
		// 2. the next bunch of options is available everywhere, as long as the user is logged in
		if ( $member->isLoggedIn() )
		{
			switch ( $what )
			{
				case 'yourname':
					return $member->getDisplayName();
					break;
				case 'yourrealname':
					return $member->getRealName();
					break;
				case 'yournotes':
					return $member->getNotes();
					break;
				case 'yoururl':
					return $member->getURL();
					break;
				case 'youremail':
					return $member->getEmail();
					break;
				case 'yourid':
					return $member->getID();
					break;
			}
		}
		return;
	}
	
	/**
	 * AdminActions::parse_headmessage()
	 * Parse skinvar headmessage
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_headmessage()
	{
		if ( !empty(Admin::$headMess) )
		{
			echo '<p>' . _MESSAGE . ': ' . Entity::hsc(Admin::$headMess) . "</p>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_helplink()
	 * Parse skinvar helplink
	 *
	 * @param	string	$topic	name of topic for help
	 * @return	void
	 */
	public function parse_helplink($topic = '')
	{
		if ( !empty($topic) )
		{
			help($topic);
		}
		return;
	}
	
	/**
	 * AdminActions::parse_helpplugname()
	 * Parse skinvar helpplugname
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_helpplugname()
	{
		$plugid = intGetVar('plugid');
		Entity::hsc($manager->getPluginNameFromPid($plugid));
		return;
	}
	
	/**
	 * AdminActions::parse_ilistaddnew()
	 * Parse skinvar ilistaddnew
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_ilistaddnew()
	{
		$blogid = intRequestVar('blogid');
		if ( intPostVar('start') == 0 )
		{
			echo '<p><a href="index.php?action=createitem&amp;blogid=' . $blogid . '">' . _ITEMLIST_ADDNEW . "</a></p>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_importskininfo()
	 * Parse skinvar importskininfo
	 *
	 * @param	string	$type	name of information for imported skin
	 * @return	void
	 */
	public function parse_importskininfo($type)
	{
		switch ( $type )
		{
			case 'info':
				echo Entity::hsc(Admin::$contents['skininfo']);
				break;
			case 'snames':
				$dataArr = Admin::$contents['skinnames'];
				echo implode(' <em>' . _AND . '</em> ', $dataArr);
				break;
			case 'tnames':
				$dataArr = Admin::$contents['tpltnames'];
				echo implode(' <em>' . _AND . '</em> ', $dataArr);
				break;
			case 'sclashes':
				$dataArr = Admin::$contents['skinclashes'];
				echo implode(' <em>' . _AND . '</em> ', $dataArr);
				break;
			case 'tclashes':
				$dataArr = Admin::$contents['tpltclashes'];
				echo implode(' <em>' . _AND . '</em> ', $dataArr);
				break;
			case 'skinfile':
				echo Entity::hsc(Admin::$contents['skinfile']);
				break;
			case 'mode':
				echo Entity::hsc(Admin::$contents['mode']);
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_init()
	 * some init stuff for all forms
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_init()
	{
		global $manager;
		
		$authorid = '';
		if ( requestVar('action') == 'itemedit' )
		{
			$authorid = Admin::$contents['authorid'];
		}
		
		Admin::$blog->insertJavaScriptInfo($authorid);
		return;
	}
	
	/**
	 * AdminActions::parse_inputyesno()
	 * Parse skinvar inputyesno
	 *
	 * @param	string	$name
	 * @param	string	$checkedval
	 * @param	string	$tabindex
	 * @param	string	$value1
	 * @param	string	$value2
	 * @param	string	$yesval
	 * @param	string	$noval
	 * @param	string	$isAdmin
	 * @param	string	$template_name
	 * @return	void
	 */
	public function parse_inputyesno($name, $checkedval, $tabindex = 0, $value1 = 1, $value2 = 0, $yesval = _YES, $noval = _NO, $isAdmin = 0, $template_name = '')
	{
		$this->parser->parse(listplug_input_yesno($name, $checkedval, $tabindex, $value1, $value2, $yesval, $noval, $isAdmin, $template_name));
		return;
	}
	
	/**
	 * AdminActions::parse_insertpluginfo()
	 * Parse templatevar insertpluginfo
	 */
	public function parse_insertpluginfo($type)
	{
		switch ( $type )
		{
			case 'id':
				return Admin::$aOptions['pid'];
				break;
			case 'name':
				return Entity::hsc(Admin::$aOptions['pfile']);
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_insplugoptcontent()
	 * Parse skinvar insplugoptcontent
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_insplugoptcontent()
	{
		$meta = NucleusPlugin::getOptionMeta(Admin::$aOptions['typeinfo']);
		if ( array_key_exists('access', $meta) && $meta['access'] != 'hidden' )
		{
			echo '<tr>';
			listplug_plugOptionRow(Admin::$aOptions);
			echo '</tr>';
		}
		return;
	}
	
	/**
	 * AdminActions::parse_iprangeinput()
	 * Parse skinvar iprangeinput
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_iprangeinput()
	{
		if ( requestVar('ip') )
		{
			$iprangeVal = Entity::hsc(requestVar('ip'));
			echo "<input name=\"iprange\" type=\"radio\" value=\"{$iprangeVal}\" checked=\"checked\" id=\"ip_fixed\" />\n";
			echo "<label for=\"ip_fixed\">{$iprangeVal}</label><br />\n";
			echo '<input name="iprange" type="radio" value="custom" id="ip_custom" />' . "\n";
			echo '<label for="ip_custom">' . _BAN_IP_CUSTOM . '</label>' . "\n";
			echo "<input name=\"customiprange\" value=\"{$iprangeVal}\" maxlength=\"15\" size=\"15\" />\n";
		}
		else
		{
			echo '<input name="iprange" value="custom" type="hidden" />' . "\n";
			echo '<input name="customiprange" value="" maxlength="15" size="15" />' . "\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_itemnavlist()
	 * Parse skinvar itemnavlist
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_itemnavlist($template_name)
	{
		global $CONF, $manager, $member;
		
		$query  = "SELECT bshortname, cname, mname, ititle, ibody, inumber, idraft, itime"
		      . " FROM %s, %s, %s, %s"
		      . " WHERE iblog=bnumber AND iauthor=mnumber AND icat=catid";
		
		$query = sprintf($query, sql_table('item'), sql_table('blog'), sql_table('member'), sql_table('category'));
		
		if ( $this->skintype == 'itemlist' )
		{
			$blog = FALSE;
			if ( array_key_exists('blogid', $_REQUEST) )
			{
				$blogid = intRequestVar('blogid');
			}
			else if ( array_key_exists('itemid', $_REQUEST) )
			{
				$itemid	=  intRequestVar('itemid');
				$item	= &$manager->getItem($itemid, 1, 1);
				$blogid	=  (integer) $item['blogid'];
			}
			$blog =& $manager->getBlog($blogid);
				
			$query .= " AND iblog={$blogid}";
			$template['now'] = $blog->getCorrectTime(time());
				
			// non-blog-admins can only edit/delete their own items
			if ( !$member->blogAdminRights($blogid) )
			{
				$query .= ' AND iauthor = ' . $member->getID();
			}
		}
		elseif ( $this->skintype == 'browseownitems' )
		{
			$query .= ' AND iauthor   = ' . $member->getID();
			$blogid = 0;
			$template['now'] = time();
		}
		
		// search through items
		$search = postVar('search');
		
		if ( !empty($search) )
		{
			$query .= ' AND ((ititle LIKE ' . DB::quoteValue('%'.$search.'%') . ') '
			. '  OR  (ibody LIKE ' . DB::quoteValue('%'.$search.'%') . ') '
			. '  OR  (imore LIKE ' . DB::quoteValue('%'.$search.'%') . '))';
		}
		
		if ( postVar('start') )
		{
			$start = intPostVar('start');
		}
		else
		{
			$start = 0;
		}
		
		// amount of items to show
		if ( postVar('amount') )
		{
			$amount = intPostVar('amount');
		}
		else
		{
			$amount = (integer) $CONF['DefaultListSize'];
			if ( $amount < 1 )
			{
				$amount = 10;
			}
		}
		
		$query .= ' ORDER BY itime DESC'
		        . " LIMIT {$start},{$amount}";
		
		$resource = DB::getResult($query);
		if ( $resource->rowCount() > 0 )
		{
			$template['action'] = $this->skintype;
			$template['start'] = $start;
			$template['amount'] = $amount;
			$template['minamount'] = 0;
			$template['maxamount'] = 1000;
			$template['blogid'] = $blogid;
			$template['search'] = $search;
			$template['itemid'] = 0;
				
			$template['content'] = 'itemlist';
				
			$this->parser->parse(listplug_navlist('item', $query, 'table', $template, $template_name));
		}
		else
		{
			/* TODO: nothing to be shown */
		}
		$resource->closeCursor();

		return;
	}
	
	/**
	 * AdminActions::parse_itemtime()
	 * date change on edit item
	 *
	 * @param	string	$key	key of PHP's getDate()
	 * @return	void
	 */
	public function parse_itemtime($key)
	{
		global $manager;
		
		$contents = Admin::$contents;
		$itemtime = getdate($contents['timestamp']);
		echo $itemtime[$key];
		return;
	}
	
	/**
	 * AdminActions::parse_jstoolbaroptions()
	 * Parse skinvar jstoolbaroptions
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_jstoolbaroptions()
	{
		global $CONF;
		$options = array(
			_SETTINGS_JSTOOLBAR_NONE,
			_SETTINGS_JSTOOLBAR_SIMPLE,
			_SETTINGS_JSTOOLBAR_FULL
		);
		
		$i = 1;
		foreach ( $options as $option )
		{
			$text  = "<option value=\"%d\"%s>%s</option>\n";
			$extra = ($CONF['DisableJsTools'] == $i) ? ' selected="selected"' : '';
			echo sprintf($text, $i, $extra, $option);
			$i++;
		}
		return;
	}
	/**
	 * AdminActions::parse_localeselectoptions()
	 * Parse skinvar localeselectoptions
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_localeselectoptions()
	{
		global $CONF, $member;
		
		$locales = i18n::get_available_locale_list();
		
		/* default option */
		if ( $this->skintype == 'editmembersettings' )
		{
			if ( !$member->getLocale() )
			{
				echo "<option value=\"\" selected=\"selected\">" . Entity::hsc(_MEMBERS_USESITELANG) . "</option>\n";
			}
			else
			{
				echo "<option value=\"\">" . Entity::hsc(_MEMBERS_USESITELANG) . "</option>\n";
			}
		}
		else
		{
			if ( $CONF['Locale'] == 'en_Latn_US' )
			{
				echo "<option value=\"\" selected=\"selected\">" . Entity::hsc(_LOCALE_EN_LATN_US) . "</option>\n";
			}
			else
			{
				echo "<option value=\"\">" . Entity::hsc(_LOCALE_EN_LATN_US) . "</option>\n";
			}
		}
		
		/* optional options */
		foreach ( $locales as $locale )
		{
			if ( $this->skintype == 'editmembersettings' )
			{
				if ( $locale != $member->getLocale() )
				{
					echo "<option value=\"{$locale}\">";
				}
				else
				{
					echo "<option value=\"{$locale}\" selected=\"selected\">";
				}
			}
			else
			{
				if ( $locale == 'en_Latn_US' )
				{
					/* already output */
					continue;
				}
				else if ( $locale != $CONF['Locale'] )
				{
					echo "<option value=\"{$locale}\">";
				}
				else
				{
					echo "<option value=\"{$locale}\" selected=\"selected\">";
				}
			}
			$label = '_LOCALE_' . strtoupper($locale);
			if ( !defined($label) )
			{
				echo $locale;
			}
			else
			{
				echo constant($label);
			}
			echo "</option>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_listplugplugoptionrow()
	 * Parse templatevar listplugplugoptionrow
	 *
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_listplugplugoptionrow($template_name = '')
	{
		echo listplug_plugOptionRow(Admin::$aOptions, $template_name);
		return;
	}
	
	/**
	 * AdminActions::parse_mediadirwarning()
	 * Parse skinvar mediadirwarning
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_mediadirwarning()
	{
		global $DIR_MEDIA;
		if ( !is_dir($DIR_MEDIA) )
		{
			echo "<br /><b>" . _WARNING_NOTADIR . "</b>\n";
		}
		if ( !is_readable($DIR_MEDIA) )
		{
			echo "<br /><b>" . _WARNING_NOTREADABLE . "</b>\n";
		}
		if ( !is_writeable($DIR_MEDIA) )
		{
			echo "<br /><b>" . _WARNING_NOTWRITABLE . "</b>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_movedistselect()
	 * Parse skinvar movedistselect
	 */
	public function parse_movedistselect()
	{
		$actionType = requestVar('action');
		switch ( $actionType )
		{
			case 'batchitem':
				$this->selectBlog('destcatid', 'category');
				break;
			case 'batchcategory':
				$this->selectBlog('destblogid');
				break;
			default:
				if ( $this->skintype == 'itemmove' )
				{
					$query  = "SELECT icat as result FROM %s WHERE inumber=%d;";
					$query = sprintf($query, sql_table('item'), intRequestVar('itemid'));
					$catid  = DB::getValue(sprintf($query, intRequestVar('itemid')));
					$this->selectBlog('catid', 'category', $catid, 10, 1);
				}
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_moveitemid()
	 * Parse skinvar moveitemid
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_moveitemid()
	{
		echo intRequestVar('itemid');
		return;
	}
	
	/**
	 * AdminActions::parse_newestcompare()
	 * Parse skinvar newestcompare
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_newestcompare()
	{
		global $nucleus;
		
		$newestVersion  = getLatestVersion();
		$newestCompare  = str_replace('/', '.', $newestVersion);
		$currentVersion = str_replace(array('/', 'v'), array('.', ''), $nucleus['version']);
		
		if ( $newestVersion && version_compare($newestCompare, $currentVersion, '>') )
		{
			echo '<br /><a style="color:red" href="http://nucleuscms.org/upgrade.php" title="' . _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE . '">';
			echo _ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT . $newestVersion . '</a>';
		}
		else
		{
			echo _ADMIN_SYSTEMOVERVIEW_VERSION_LATEST;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_newmemberselect()
	 * Parse skinvar newmemberselect
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_newmemberselect($template_name = '')
	{
		$blogid = intRequestVar('blogid');
		
		$query = "SELECT tmember FROM %s WHERE tblog=%d;";
		$query = sprintf($query, sql_table('team'), (integer) $blogid);
		$res = DB::getResult($query);
		
		$tmem = array();
		foreach ( $res as $row )
		{
			$tmem[] = intval($row['tmember']);
		}
		
		$query  = "SELECT mname as text, mnumber as value FROM %s WHERE mnumber NOT IN (%s);";
		$query = sprintf($query, sql_table('member'), implode(', ', $tmem));
		
		$template = array(
			'name'		=> 'memberid',
			'tabindex'	=> 10000,
			'selected'	=> 0
		);
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		return;
	}
	
	/**
	 * AdminActions::parse_newpluginlist()
	 * Parse skinvar newpluginlist
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_newpluginlist()
	{
		$candidates = $this->newPlugCandidates;
		foreach ( $candidates as $name )
		{
			echo '<option value="NP_' . $name . '">' . Entity::hsc($name) . "</option>\n";
		}
		return;
	}
	
	/**
	 * AdminActions::parse_outputspecialdirs()
	 * Parse skinvar outputspecialdirs
	 *
	 * @param	string	$type	type of setting for directory
	 * @return	void
	 */
	public function parse_outputspecialdirs($type)
	{
		global $DIR_MEDIA, $DIR_NUCLEUS;
		
		switch ( $type )
		{
			case 'nucleusdir':
				echo Entity::hsc($DIR_NUCLEUS);
				break;
			case 'mediadir':
				echo Entity::hsc($DIR_MEDIA);
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_passrequestvars()
	 * Parse skinvar passrequestvars
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_passrequestvars()
	{
		$passvar   = Admin::$passvar;
		$oldaction = postVar('oldaction');
		
		if ( ($oldaction != 'logout')
		&& ($oldaction != 'login')
		&& $passvar
		&& !postVar('customaction') )
		{
			passRequestVars();
		}
		return;
	}
	
	/**
	 * AdminActions::parse_pluginextras()
	 * Parse skinvar pluginextras
	 *
	 * @param	string	$type	type of plugin context
	 * @return	void
	 */
	public function parse_pluginextras($type = 'global')
	{
		global $manager;
		
		switch ( $type )
		{
			case 'member':
				$id  = intRequestVar('memberid');
				$mem =& $manager->getMember($id);
				$data = array('member' => &$mem);
				$manager->notify('MemberSettingsFormExtras', $data);
				break;
			case 'blog':
				$id  = intRequestVar('blogid');
				$blg =& $manager->getBlog($id);
				$data = array('member' => &$blg);
				$manager->notify('BlogSettingsFormExtras', $data);
				break;
			case 'createaccount':
				$data = array(
					'type'		=> 'createaccount.php',
					'prelabel'	=> '',
					'postlabel'	=> '<br />',
					'prefield'	=> '',
					'postfield'	=> '<br /><br />'
				);
				$manager->notify('RegistrationFormExtraFields', $data);
				break;
			default:
			$data = array();
				$manager->notify('GeneralSettingsFormExtras', $data);
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_pluginhelp()
	 * Parse skinvar pluginhelp
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_pluginhelp()
	{
		global $manager, $DIR_PLUGINS;
		
		$plugid = intGetVar('plugid');
		$plugName = $manager->getPluginNameFromPid($plugid);
		$plug =& $manager->getPlugin($plugName);
		
		if ( $plug->supportsFeature('HelpPage') > 0 )
		{
			$helpfile = $DIR_PLUGINS . $plug->getShortName() . '/help.';
			if ( @file_exists($helpfile . 'php') )
			{
				@include($helpfile . 'php');
				return;
			}
			elseif ( @file_exists($helpfile . 'html') )
			{
				@include($helpfile . 'html');
				return;
			}
		}
		echo '<p>' . _ERROR . ': ' . _ERROR_PLUGNOHELPFILE . "</p>\n";
		echo '<p><a href="index.php?action=pluginlist">(' . _BACK . ")</a></p>\n";
		return;
	}
	
	/**
	 * AdminActions::parse_pluginlistlist()
	 * Parse skinvar pluginlistlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_pluginlistlist($template_name = '')
	{
		$query = "SELECT * FROM %s ORDER BY porder ASC;";
		$query = sprintf($query, sql_table('plugin'));
		
		$template['content']  = 'pluginlist';
		$template['tabindex'] = 10;
		
		$this->parser->parse(showlist($query, 'table', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_pluginoptions()
	 * Parse skinvar pluginoptions
	 *
	 * @param	string	$type	type of plugin option
	 * @return	void
	 */
	public function parse_pluginoptions($context='global', $template_name='')
	{
		global $itemid, $manager;
		
		switch ( $context )
		{
			case 'member':
				$contextid = intRequestVar('memberid');
				break;
			case 'blog':
				$contextid = intRequestVar('blogid');
				break;
			case 'category':
				$contextid = intRequestVar('catid');
				break;
			case 'item':
				$contextid = $itemid;
				break;
		}
		
		/* Actually registererd plugin options */
		$aIdToValue = array();
		$query = "SELECT oid, ovalue FROM %s WHERE ocontextid=%d;";
		$query = sprintf($query, sql_table('plugin_option'), (integer) $contextid);
		$res = DB::getResult($query);
		foreach ( $res as $row )
		{
			$aIdToValue[$row['oid']] = $row['ovalue'];
		}
		
		/* Currently available plugin options */
		$query	= "SELECT * FROM %s, %s WHERE opid=pid and ocontext= %s ORDER BY porder, oid ASC;";
		$query	= sprintf($query, sql_table('plugin_option_desc'), sql_table('plugin'), DB::quoteValue($context));
		$res	= DB::getResult($query);
		
		$options = array();
		foreach ($res as $row )
		{
			if ( !array_key_exists($row['oid'], $aIdToValue) )
			{
				$value = $row['odef'];
			}
			else
			{
				$value = $aIdToValue[$row['oid']];
			}
			
			$options[] = array(
				'pid'			=> $row['pid'],
				'pfile'			=> $row['pfile'],
				'oid'			=> $row['oid'],
				'value'			=> $value,
				'name'			=> $row['oname'],
				'description'	=> $row['odesc'],
				'type'			=> $row['otype'],
				'typeinfo'		=> $row['oextra'],
				'contextid'		=> $contextid,
				'extra'			=> ''
			);
		}
		
		$data = array(
			'context'	=>  $context,
			'contextid'	=>  $contextid,
			'options'	=> &$options
		);
		$manager->notify('PrePluginOptionsEdit', $data);
		
		$template = array();
		if ( $template_name )
		{
			$templates =& $manager->getTemplate($template_name);
			if ( !array_key_exists('INSERT_PLUGOPTION_TITLE', $templates) || empty($templates['INSERT_PLUGOPTION_TITLE']) )
			{
				$template['title'] = "<tr>"
				. "<th colspan=\"2\"><%sprinttext(_PLUGIN_OPTIONS_TITLE, <|%insertpluginfo(name)%|>)%></th>"
				. "</tr>\n";
			}
			else
			{
				$template['title'] = $templates['INSERT_PLUGOPTION_TITLE'];
			}
			
			if ( !array_key_exists('INSERT_PLUGOPTION_BODY', $templates) || empty($templates['INSERT_PLUGOPTION_BODY']) )
			{
				$template['body'] = "<tr>"
				. "<%listplugplugoptionrow%>"
				. "</tr>\n";
			}
			else
			{
				$template['body'] = $templates['INSERT_PLUGOPTION_BODY'];
			}
		}
		
		$prevPid = -1;
		
		foreach ( $options as $option )
		{
			// new plugin?
			if ( $prevPid != $option['pid'] )
			{
				$prevPid  = $option['pid'];
				$this->parser->parse($template['title']);
			}
			
			$meta = NucleusPlugin::getOptionMeta($option['typeinfo']);
			
			if ( @$meta['access'] != 'hidden' )
			{
				$parsed = $this->parser->parse($template['body']);
			}
		}
	
		return;
	}
	
	/**
	 * AdminActions::parse_qmenuaddselect()
	 * Parse skinvar qmanuaddselect
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_qmenuaddselect($template_name = '')
	{
		global $member, $blogid;
		$showAll = requestVar('showall');
		if ( $member->isAdmin() && ($showAll == 'yes') )
		{
			// Super-Admins have access to all blogs! (no add item support though)
			$query =  'SELECT bnumber as value, bname as text FROM %s ORDER BY bname;';
			$query = sprintf($query, sql_table('blog'));
		}
		else
		{
			$query =  'SELECT bnumber as value, bname as text FROM %s, %s WHERE tblog=bnumber and tmember=%d ORDER BY bname;';
			$query = sprintf($query, sql_table('blog'), sql_table('team'), (integer) $member->getID());
		}
		
		$template['name']		= 'blogid';
		$template['tabindex']	= 15000;
		$template['extra']		= _QMENU_ADD_SELECT;
		$template['selected']	= 0;
		$template['shorten']	= 10;
		$template['shortenel']	= '';
		$template['javascript']	= 'onchange="return form.submit()"';
		
		$this->parser->parse(showlist($query, 'select', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_quickmenu()
	 * Parse skinvar quickmenu
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_quickmenu($template_name = '')
	{
		global $manager;
		$templates = array();
		
		if ( !empty($template_name) )
		{
			$templates = & $manager->getTemplate($template_name);
		}
		$pluginExtras = array();
		$data = array('options' => &$pluginExtras);
		$manager->notify('QuickMenu', $data);
		
		$template  = array();
		if ( count($pluginExtras) > 0 )
		{
			if ( !array_key_exists('PLUGIN_QUICKMENU_HEAD', $templates) || empty($templates['PLUGIN_QUICKMENU_HEAD']) )
			{
				$template['head'] = "<h2><%text(_QMENU_PLUGINS)%></h2>\n"
				. "<ul>\n";
			}
			else
			{
				$template['head'] = $templates['PLUGIN_QUICKMENU_HEAD'];
			}
			
			if ( !array_key_exists('PLUGIN_QUICKMENU_BODY', $templates) && empty($templates['PLUGIN_QUICKMENU_BODY']) )
			{
				$template['body'] = "<li><a href=\"<%plugadminurl%>\" title=\"<%plugadmintooltip%>\"><%plugadmintitle%></a></li>\n";
			}
			else
			{
				$template['body'] = $templates['PLUGIN_QUICKMENU_BODY'];
			}
			
			if ( !array_key_exists('PLUGIN_QUICKMENU_FOOT', $templates) || empty($templates['PLUGIN_QUICKMENU_FOOT']) )
			{
				$template['foot'] = "</ul>\n";
			}
			else
			{
				$template['foot'] = $templates['PLUGIN_QUICKMENU_FOOT'];
			}
			
			$this->parser->parse($template['head']);
			foreach ( $pluginExtras as $aInfo )
			{
				$data = array(
					'plugadminurl'		=> Entity::hsc($aInfo['url']),
					'plugadmintooltip'	=> Entity::hsc($aInfo['tooltip']),
					'plugadmintitle'	=> Entity::hsc($aInfo['title']),
				);
				$this->parser->parse(Template::fill($template['body'], $data));
			}
			$this->parser->parse($template['foot']);
		}
		return;
	}
	
	/**
	 * AdminActions::parse_requestblogid()
	 * Parse skinvar requestblogid
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_requestblogid()
	{
		echo intRequestVar('blogid');
		return;
	}
	
	/**
	 * AdminActions::parse_requestiprange()
	 * Parse skinvar requestiprange
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_requestiprange()
	{
		if ( requestVar('iprange') )
		{
			echo Entity::hsc(requestVar('iprange'));
		}
		elseif ( requestVar('ip') )
		{
			echo Entity::hsc(requestVar('ip'));
		}
		return;
	}
	
	/**
	 * AdminActions::parse_selectlocalskinfiles()
	 * Parse skinvar selectlocalskinfiles
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_selectlocalskinfiles()
	{
		global $DIR_SKINS;
		
		if ( !class_exists('SkinImport', FALSE) )
		{
			include_libs('skinie.php');
		}
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) && $this->skintype != 'importAdmin' )
		{
			$skindir = $DIR_SKINS;
		}
		else
		{
			$skindir = "{$DIR_SKINS}admin/";
		}
		
		$candidates = SkinImport::searchForCandidates($skindir);
		foreach ( $candidates as $skinname => $skinfile )
		{
			$skinname = Entity::hsc($skinname);
			if ( !in_array($this->skintype, Admin::$adminskin_actions) && $this->skintype != 'importAdmin' )
			{
				$skinfile = Entity::hsc($skinfile);
			}
			else
			{
				$skinfile = Entity::hsc("admin/$skinfile");
			}
			echo "<option value=\"{$skinfile}\">{$skinname}</option>\n";
		}
	
		return;
	}
	
	/**
	 * AdminActions::parse_skineditallowedlist()
	 * Parse skinvar skineditallowedlist
	 *
	 * @param	string	$type			type of skin
	 * @param	string	$template_name	name of template
	 * @return	void
	 */
	public function parse_skineditallowedlist($type, $template_name = '')
	{
		switch ( $type )
		{
			case 'blog':
				$query = "SELECT bshortname, bname FROM %s;";
				$show  = array(
					'content' => 'shortblognames'
				);
				$query = sprintf($query, sql_table('blog'));
				break;
			case 'template':
				if ( !in_array($this->skintype, Admin::$adminskin_actions) )
				{
					$query = "SELECT tdname as name, tddesc as description FROM %s WHERE tdname NOT LIKE 'admin/%%';";
				}
				else
				{
					$query = "SELECT tdname as name, tddesc as description FROM %s WHERE tdname LIKE 'admin/%%';";
				}
				$show  = array(
					'content' => 'shortnames'
				);
				$query = sprintf($query, sql_table('template_desc'));
				break;
		}
	
		$this->parser->parse(showlist($query, 'table', $show, $template_name));
		return;
	}
	
	/**
	 * AdminActions::parse_skinielist()
	 * Parse skinvar skinielist
	 *
	 * @param	string	$type			type of skin
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_skinielist($type, $template_name = '')
	{
		global $manager;
		
		$templates = array();
		if ( $template_name )
		{
			$templates =& $manager->getTemplate($template_name);
		}
		if ( !array_key_exists('SKINIE_EXPORT_LIST', $templates) || empty($templates['SKINIE_EXPORT_LIST']) )
		{
			$template = "<tr>\n"
			          . "<td>"
			          . "<input type=\"checkbox\" name=\"<%typeid%>\" id=\"<%expid%>\" />\n"
			          . "<label for=\"<%expid%>\"><%expname%></label>\n"
			          . "</td>\n"
			          . "<td><%expdesc%></td>\n"
			          . "</tr>\n";
		}
		else
		{
			$template = $templates['SKINIE_EXPORT_LIST'];
		}
		
		switch ( $type )
		{
			case 'skin':
				if ( !in_array($this->skintype, Admin::$adminskin_actions) )
				{
					$res = DB::getResult('SELECT * FROM ' . sql_table('skin_desc'). " WHERE sdname NOT LIKE 'admin/%%';");
				}
				else
				{
					$res = DB::getResult('SELECT * FROM ' . sql_table('skin_desc'). " WHERE sdname LIKE 'admin/%%';");
				}
				foreach ( $res as $row )
				{
					$data = array(
						'typeid'	=> 'skin[' . $row['sdnumber'] . ']',
						'expid'		=> 'skinexp' . $row['sdnumber'],
						'expname'	=> Entity::hsc($row['sdname']),
						'expdesc'	=> Entity::hsc($row['sddesc'])
					);
					echo Template::fill($template, $data);
				}
				break;
			case 'template':
				if ( !in_array($this->skintype, Admin::$adminskin_actions) )
				{
					$res = DB::getResult('SELECT * FROM '.sql_table('template_desc'). " WHERE tdname NOT LIKE 'admin/%%';");
				}
				else
				{
					$res = DB::getResult('SELECT * FROM '.sql_table('template_desc'). " WHERE tdname LIKE 'admin/%%';");
				}
				foreach ( $res as $row )
				{
					$data = array(
						'typeid'	=> 'template[' . $row['tdnumber'] . ']',
						'expid'		=> 'templateexp' . $row['tdnumber'],
						'expname'	=> Entity::hsc($row['tdname']),
						'expdesc'	=> Entity::hsc($row['tddesc'])
					);
					echo Template::fill($template, $data);
				}
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_skinoverview()
	 * Parse skinvar skinoverview
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_skinoverview($template_name = '')
	{
		global $CONF;
		
		$template = array();
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$query = "SELECT * FROM %s WHERE sdname NOT LIKE 'admin/%%' ORDER BY sdname;";
			$template['handler'] = 'Actions';
			$template['editaction'] = 'skinedit';
			$template['cloneaction'] = 'skinclone';
			$template['deleteaction'] = 'skindelete';
			$template['edittypeaction'] = 'skinedittype';
			$template['default'] = $CONF['BaseSkin'];
		}
		else
		{
			$query = "SELECT * FROM %s WHERE sdname LIKE 'admin/%%' ORDER BY sdname;";
			$template['handler'] = 'AdminActions';
			$template['editaction'] = 'adminskinedit';
			$template['cloneaction'] = 'adminskinclone';
			$template['deleteaction'] = 'adminskindelete';
			$template['edittypeaction'] = 'adminskinedittype';
			$template['default'] = $CONF['AdminSkin'];
		}
		$query = sprintf($query, sql_table('skin_desc'));
		
		$template['tabindex'] = 10;
		$template['content'] = 'skinlist';
		
		$this->parser->parse(showlist($query, 'table', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_skintypehelp()
	 * Check editing skintypehelp
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_skintypehelp()
	{
		$surrent_skin_type = strtolower(trim(requestVar('type')));
		$page_action  = strtolower(trim(requestVar('action')));
		if ( in_array($page_action, Admin::$adminskin_actions) )
		{
			$normal_types = array_keys(self::$normal_skin_types);
		}
		else
		{
			$normal_types = array_keys(Actions::getNormalSkinTypes());
		}
		
		if ( in_array($surrent_skin_type, $normal_types) )
		{
			help('skinpart' . $surrent_skin_type);
		}
		else
		{
			help('skinpartspecial');
		}
		return;
	}
	
	/**
	 * AdminActions::parse_specialskinlist()
	 * Parse skinvar specialskinlist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_specialskinlist($template_name = '')
	{
		global $CONF, $manager;
		
		$template = array();
		
		$skinid = intRequestVar('skinid');
		
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$skin =& $manager->getSkin($skinid);
			$template['editaction'] = 'skinedittype';
			$template['removeaction'] = 'skinremovetype';
		}
		else
		{
			$skin =& $manager->getSkin($skinid, 'AdminActions');
			$template['editaction'] = 'adminskinedittype';
			$template['removeaction'] = 'adminskinremovetype';
		}
		$normal_types = $skin->getNormalTypes();
		$available_types = $skin->getAvailableTypes();
		
		$special_skintypes = array();
		foreach( $available_types as $skintype => $skinname )
		{
			if ( !array_key_exists($skintype, $normal_types) )
			{
				$special_skintypes[] = array(
					'skintype'		=> $skintype,
					'skintypename'	=> $skinname
				);
			}
		}
		
		if ( sizeof($special_skintypes) > 0 )
		{
			$template['tabindex'] = 75;
			$template['skinid'] = $skin->getID();
			$template['skinname'] = $skin->getName();
			$this->parser->parse(showlist($special_skintypes, 'list_specialskinlist', $template, $template_name));
		}
		else
		{
			/* TODO: nothing to be shown */
		}
	
		return;
	}
	
	/**
	 * AdminActions::parse_sprinttext()
	 * Parse sprinttext
	 *
	 * @param	string	$which
	 * @param	string	$val
	 * @return	void
	 */
	public function parse_sprinttext($which, $val)
	{
		if ( !defined($which) )
		{
			$base = $which;
		}
		else
		{
			$base = constant($which);
		}
		
		if ( preg_match('#[^<|%].*[^%|>]#', $val, $matchies) )
		{
			if ( !preg_match('#[(].*[^)]#', $matchies[0], $args) )
			{
				$met = 'parse_' . $matchies[0];
			}
			else
			{
				$arg = trim($args[0], '()');
				$met = 'parse_' . substr($matchies[0], 0, strpos($matchies[0], '('));
			}
			
			if ( method_exists($this, $met) )
			{
				$value = call_user_func(array(&$this, $met), $arg);
			}
		}
		
		if ( !isset($value) || empty($value) )
		{
			$value = $val;
		}
		echo sprintf($base, $value);
		return;
	}
	
	/**
	 * AdminActions::parse_systemsettings()
	 * Parse skinvar systemsettings
	 *
	 * @param	string	$type			type of settings for system
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_systemsettings($type = 'phpinfo', $template_name = '')
	{
		global $manager, $member, $CONF, $nucleus;
		
		$member->isAdmin() or Admin::disallow();
		
		$enable  = _ADMIN_SYSTEMOVERVIEW_ENABLE;
		$disable = _ADMIN_SYSTEMOVERVIEW_DISABLE;
		
		switch ( $type )
		{
			case 'phpversion':
				echo phpversion();
				break;
			case 'sqlserverinfo':
				echo DB::getAttribute(PDO::ATTR_SERVER_VERSION);
				break;
			case 'sqlclientinfo':
				echo DB::getAttribute(PDO::ATTR_CLIENT_VERSION);
				break;
			case 'magicquotesgpc':
				echo ini_get('magic_quotes_gpc') ? 'On' : 'Off';
				break;
			case 'magicquotesruntime':
				echo ini_get('magic_quotes_runtime') ? 'On' : 'Off';
				break;
			case 'registerglobals':
				echo ini_get('register_globals') ? 'On' : 'Off';
				break;
			case 'gdinfo':
				$templates = array();
				if ( $template_name )
				{
					$templates =& $manager->getTemplate($template_name);
				}
				if ( !array_key_exists('SYSTEMINFO_GDSETTINGS', $templates) || empty($templates['SYSTEMINFO_GDSETTINGS']) )
				{
					$template = "<tr>\n"
					. "<td><%key%></td>\n"
					. "<td><%value%></td>\n"
					. "</tr>\n";
				}
				else
				{
					$template = $templates['SYSTEMINFO_GDSETTINGS'];
				}
				
				$gdinfo = gd_info();
				
				foreach ( $gdinfo as $key => $value )
				{
					if ( is_bool($value) )
					{
						$value = $value ? $enable : $disable;
					}
					else
					{
						$value = Entity::hsc($value);
					}
					$data = array(
						'key'   => $key,
						'value' => $value,
					);
					echo Template::fill($template, $data);
				}
				break;
			case 'modrewrite':
				if ( function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()) )
				{
					echo $enable;
				}
				else
				{
					ob_start();
					phpinfo(INFO_MODULES);
					$im = ob_get_contents();
					ob_end_clean();
					if ( i18n::strpos($im, 'mod_rewrite') !== FALSE )
					{
						echo $enable;
					}
					else
					{
						echo $disable;
					}
				}
				break;
			case 'nucleusversion':
				echo getNucleusVersion() / 100 . '(' . $nucleus['version'] . ')';
				break;
			case 'nucleuspatchlevel':
				echo getNucleusPatchLevel();
				break;
			case 'confself':
				echo $CONF['Self'];
				break;
			case 'confitemurl':
				echo $CONF['ItemURL'];
				break;
			case 'alertonheaderssent':
				echo $CONF['alertOnHeadersSent'] ? $enable : $disable;
				break;
			case 'nucleuscodename':
				if ( $nucleus['codename'] != '' )
				{
					echo ' &quot;' . $nucleus['codename'] . '&quot;';
				}
				break;
			case 'versioncheckurl':
				echo sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
				break;
		}
		return;
	}
	
	/**
	 * AdminActions::parse_templateoverview()
	 * Parse skinvar templateoverview
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_templateoverview($template_name = '')
	{
		if ( !in_array($this->skintype, Admin::$adminskin_actions) )
		{
			$query = "SELECT * FROM %s WHERE tdname NOT LIKE 'admin/%%' ORDER BY tdname;";
			$template['deleteaction'] = 'templatedelete';
			$template['editaction'] = 'templateedit';
			$template['cloneaction'] = 'templateclone';
		}
		else
		{
			$query = "SELECT * FROM %s WHERE tdname LIKE 'admin/%%' ORDER BY tdname;";
			$template['deleteaction'] = 'admintemplatedelete';
			$template['editaction'] = 'admintemplateedit';
			$template['cloneaction'] = 'admintemplateclone';
		}
		$query = sprintf($query, sql_table('template_desc'));
		
		$template['tabindex'] = 10;
		$template['content'] = 'templatelist';
		
		$this->parser->parse(showlist($query, 'table', $template, $template_name));
		
		return;
	}
	
	/**
	 * AdminActions::parse_ticket()
	 * Parse ticket
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_ticket()
	{
		global $manager;
		$manager->addTicketHidden();
		return;
	}
	
	/**
	 * AdminActions::parse_versioncheckurl()
	 * Parse skinvar versioncheckurl
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_versioncheckurl()
	{
		echo sprintf(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL, getNucleusVersion(), getNucleusPatchLevel());
		return;
	}
	
	/**
	 * AdminActions::parse_yrbloglist()
	 * Parse skinvar yrbloglist
	 *
	 * @param	string	$template_name	name of template to use
	 * @return	void
	 */
	public function parse_yrbloglist($template_name = '')
	{
		global $member;
		$showAll = requestVar('showall');
		
		if ( $member->isAdmin() && ($showAll == 'yes') )
		{
			// Super-Admins have access to all blogs! (no add item support though)
			$query =  "SELECT bnumber, bname, 1 as tadmin, burl, bshortname"
			. " FROM %s"
			. " ORDER BY bnumber;";
			$query = sprintf($query, sql_table('blog'));
		}
		else
		{
			$query = "SELECT bnumber, bname, tadmin, burl, bshortname"
			. " FROM %s,%s"
			. " WHERE tblog=bnumber and tmember=%d"
			. " ORDER BY bnumber;";
			$query = sprintf($query, sql_table('blog'), sql_table('team'), (integer) $member->getID());
		}
		
		$resource = DB::getResult($query);
		if ( ($showAll != 'yes') && $member->isAdmin() )
		{
			$query = 'SELECT COUNT(*) as result FROM ' . sql_table('blog');
			$total = DB::getValue($query);
				
			if ( $total > $resource->rowCount() )
			{
				echo '<p><a href="index.php?action=overview&amp;showall=yes">' . _OVERVIEW_SHOWALL . '</a></p>';
			}
		}
		
		if ( $resource->rowCount() > 0 )
		{
			$template['content']	= 'bloglist';
			$template['superadmin'] = $member->isAdmin();
				
			$this->parser->parse(showlist($resource, 'table', $template, $template_name));
			$resource->closeCursor();
				
			echo '<h2>' . _OVERVIEW_YRDRAFTS . '</h2>';
				
			$query = 'SELECT ititle, inumber, bshortname FROM %s, %s '
			. 'WHERE iauthor=%d AND iblog=bnumber AND idraft=1;';
			$query = sprintf($query, sql_table('item'), sql_table('blog'), (integer) $member->getID());
				
			$resource = DB::getResult($query);
			if ( $resource->rowCount() > 0 )
			{
				$template['content'] = 'draftlist';
				$this->parser->parse(showlist($resource, 'table', $template, $template_name));
			}
			else
			{
				echo _OVERVIEW_NODRAFTS;
			}
		}
		else
		{
			echo _OVERVIEW_NOBLOGS;
		}
		$resource->closeCursor();
		
		return;
	}
	
	/**
	 * AdminActions::checkCondition()
	 * Checks conditions for if statements
	 *
	 * @param	string	$field type of <%if%>
	 * @param	string	$name property of field
	 * @param	string	$value value of property
	 * @return	boolean	condition
	 */
	protected function checkCondition($field, $name='', $value = '')
	{
		global $CONF, $archiveprevexists, $archivenextexists, $blog, $catid, $itemidnext, $itemidprev, $manager, $member;
		
		$condition = 0;
		switch ( $field )
		{
			case 'category':
				if ( !$blog )
				{
					if ( $blogid )
					{
						$blog =& $manager->getBlog($blogid);
					}
					elseif ( $catid )
					{
						$blogid = getBlogIDFromCatID($catid);
						$blog =& $manager->getBlog($blogid);
					}
					elseif ( intRequestVar('catid') )
					{
						$catid = intRequestVar('catid');
						$blogid = getBlogIDFromCatID($catid);
						$blog =& $manager->getBlog($blogid);
					}
					else
					{
						return;
					}
				}
				$condition = ($blog && $this->ifCategory($name, $value));
				break;
			case 'loggedin':
				$condition = $member->isLoggedIn();
				break;
			case 'onteam':
				$condition = $member->isLoggedIn() && $this->ifOnTeam($name);
				break;
			case 'admin':
				$condition = $member->isLoggedIn() && $this->ifAdmin($name);
				break;
			case 'superadmin':
				$condition = $member->isLoggedIn() && $member->isAdmin();
				break;
			case 'allowloginedit':
				$condition = $member->isLoggedIn() && ($CONF['AllowLoginEdit'] || $member->isAdmin());
				break;
			case 'nextitem':
				$condition = ($itemidnext != '');
				break;
			case 'previtem':
				$condition = ($itemidprev != '');
				break;
			case 'archiveprevexists':
				$condition = ($archiveprevexists == true);
				break;
			case 'archivenextexists':
				$condition = ($archivenextexists == true);
				break;
			case 'skintype':
				$condition = (($name == $this->skintype) || ($name == requestVar('action')));
				break;
			case 'hasplugin':
				$condition = $this->ifHasPlugin($name, $value);
				break;
			case 'adminaction':
				$condition = (Admin::$action == $name);
				break;
			case 'adminoldaction':
				$condition = (Admin::$action == $name);
				break;
			case 'addresschange':
				$condition = ($this->ifAddresscange());
				break;
			case 'bechangepass':
				$condition = ($this->beChangePassword());
				break;
			case 'skincandidates':
				$condition = ($this->ifSkincandidates());
				break;
			case 'nameclashes':
				$condition = Admin::$contents['nameclashes'];
				break;
			case 'existsnewplugin':
				$condition = ($this->existsNewPlugin());
				break;
			case 'autosave':
				if ( $value == '' )
				{
					$value = 1;
				}
				$condition = (boolean) ($member->getAutosave() == $value);
				break;
			case 'blogsetting':
				if ( $value == '' )
				{
					$value = 1;
				}
				$condition = (Admin::$blog->getSetting($name) == $value);
				break;
			case 'itemproperty':
				if ( $value == '' )
				{
					$value = 1;
				}
				if ( array_key_exists($name, Admin::$contents) )
				{
					$condition = (boolean) (Admin::$contents[$name] == $value);
				}
				break;
			default:
				$condition = $manager->pluginInstalled("NP_{$field}") && $this->ifPlugin($field, $name, $value);
				break;
		}
		return $condition;
	}
	
	/**
	 * AdminActions::_ifHasPlugin()
	 *	hasplugin,PlugName
	 *	   -> checks if plugin exists
	 *	hasplugin,PlugName,OptionName
	 *	   -> checks if the option OptionName from plugin PlugName is not set to 'no'
	 *	hasplugin,PlugName,OptionName=value
	 *	   -> checks if the option OptionName from plugin PlugName is set to value
	 *
	 * @param	string	$name	name of plugin
	 * @param	string	$value
	 * @return
	 */
	private function ifHasPlugin($name, $value)
	{
		global $manager;
		$condition = false;
		// (pluginInstalled method won't write a message in the actionlog on failure)
		if ( $manager->pluginInstalled("NP_{$name}") )
		{
			$plugin =& $manager->getPlugin("NP_{$name}");
			if ( $plugin != NULL )
			{
				if ( $value == "" )
				{
					$condition = true;
				}
				else
				{
					list($name2, $value2) = preg_split('#=#', $value, 2);
					if ( $value2 == "" && $plugin->getOption($name2) != 'no' )
					{
						$condition = true;
					}
					else if ( $plugin->getOption($name2) == $value2 )
					{
						$condition = true;
					}
				}
			}
		}
		return $condition;
	}
	
	/**
	 * AdminActions::beChangePassword()
	 *
	 * @param	void
	 * @return	void
	 */
	private function beChangePassword()
	{
		return intRequestVar('bNeedsPasswordChange');
	}
	
	/**
	 * AdminActions::ifSkincandidates()
	 * Checks if a plugin exists and call its doIf function
	 *
	 * @param	void
	 * @return	void
	 * @return	boolean
	 */
	private function ifSkincandidates()
	{
		global $DIR_SKINS;
		$candidates = SKINIMPORT::searchForCandidates($DIR_SKINS);
		return (count($candidates) > 0);
	}
	
	/**
	 * AdminActions::ifPlugin()
	 * Checks if a plugin exists and call its doIf function
	 *
	 * @param	string	$name	name of plugin
	 * @param	string	$key
	 * @param	string	$value
	 * @return	callback
	 */
	private function ifPlugin($name, $key = '', $value = '')
	{
		global $manager;
		
		$plugin =& $manager->getPlugin("NP_{$name}");
		if ( !$plugin )
		{
			return;
		}
		
		$params = func_get_args();
		array_shift($params);
		
		return call_user_func_array(array(&$plugin, 'doIf'), $params);
	}
	
	/**
	 * AdminActions::ifCategory()
	 *  Different checks for a category
	 *
	 * @param	string	$key	key for information of category
	 * @param	string	$value	value for information of category
	 * @return	boolean
	 */
	private function ifCategory($key = '', $value='')
	{
		global $blog, $catid;
		
		// when no parameter is defined, just check if a category is selected
		if (($key != 'catname' && $key != 'catid') || ($value == ''))
		{
			return $blog->isValidCategory($catid);
		}
		
		// check category name
		if ( $key == 'catname' )
		{
			$value = $blog->getCategoryIdFromName($value);
			if ($value == $catid)
			{
				return $blog->isValidCategory($catid);
			}
		}
		
		// check category id
		if (($key == 'catid') && ($value == $catid))
		{
			return $blog->isValidCategory($catid);
		}
		
		return FALSE;
	}
	
	/**
	 * AdminActions::ifOnTeam()
	 * Checks if a member is on the team of a blog and return his rights
	 *
	 * @param	string	$blogName	name of weblog
	 * @return	boolean
	 */
	private function ifOnTeam($blogName = '')
	{
		global $blog, $member, $manager;
		
		// when no blog found
		if ( ($blogName == '') && !is_object($blog) )
		{
			return 0;
		}
		
		// explicit blog selection
		if ($blogName != '')
		{
			$blogid = getBlogIDFromName($blogName);
		}
		
		if (($blogName == '') || !$manager->existsBlogID($blogid))
		{
			// use current blog
			$blogid = $blog->getID();
		}
		return $member->teamRights($blogid);
	}
	
	/**
	 * AdminActions::ifAdmin()
	 * Checks if a member is admin of a blog
	 *
	 * @param	string	$blogName	name of weblog
	 * @return	boolean
	 */
	private function ifAdmin($blogName = '')
	{
		global $blog, $member, $manager;
		
		// when no blog found
		if (($blogName == '') && (!is_object($blog)))
		{
			return 0;
		}
		
		// explicit blog selection
		if ($blogName != '')
		{
			$blogid = getBlogIDFromName($blogName);
		}
		
		if (($blogName == '') || !$manager->existsBlogID($blogid))
		{
			// use current blog
			$blogid = $blog->getID();
		}
	
		return $member->isBlogAdmin($blogid);
	}
	
	/**
	 * AdminActions::ifAddresscange()
	 * Check e-Mail address is changed
	 *
	 * @param	void
	 * @return	boolean
	 */
	private function ifAddresscange()
	{
		global $manager;

		$key = $this->objAdmin->sessionVar("{$CONF['CookiePrefix']}ackey");
		if ( !$key )
		{
			return FALSE;
		}
		$info = MEMBER::getActivationInfo($key);
		if ( !$info )
		{
			return FALSE;
		}
		$mem =& $manager->getMember($info->vmember);
		if ( !$mem )
		{
			return FALSE;
		}
		if ( $info->vtype == 'addresschange' )
		{
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * TODO: move
	 * AdminActions::customHelp()
	 * shows a link to custom help file
	 *
	 * @param	string	$id
	 * @param	string	$tplName
	 * @param	string	$url
	 * @param	string	$iconURL
	 * @param	string	$alt
	 * @param	string	$title
	 * @param	$onclick
	 *
	 */
	private function customHelp($id, $tplName = '', $url = '', $iconURL = '', $alt = '', $title = '', $onclick = '')
	{
		echo $this->customHelpHtml($id, $tplName, $url, $iconURL, $alt, $title, $onclick);
	}
	
	/**
	 * TODO: move
	 * AdminActions::customHelp()
	 * shows a link to custom help file
	 *
	 * @param	string	$id
	 * @param	string	$tplName
	 * @param	string	$url
	 * @param	string	$iconURL
	 * @param	string	$alt
	 * @param	string	$title
	 * @param	$onclick
	 *
	 */
	static function customHelplink($id, $tplName = '', $url = '', $title = '', $onclick = '')
	{
		global $CONF, $manager;
		
		$templates = array();
		
		if ( $tplName )
		{
			$templates =& $manager->getTemplate($tplName);
		}
		
		if ( !array_key_exists('ADMIN_CUSTOMHELPLINK_ANCHOR', $templates) || empty($templates['ADMIN_CUSTOMHELPLINK_ANCHOR']) )
		{
			$template = "<a href=\"<%helpurl%>#<%helptarget%>\" title=\"<%title%>\" <%onclick%>>\n";
		}
		else
		{
			$template = $templates['ADMIN_CUSTOMHELPLINK_ANCHOR'];
		}
		
		if ( empty($url) )
		{
			$url = $CONF['AdminURL'] . 'documentation/customHelp.html';
		}
		
		if ( empty($onclick) )
		{
			$onclick = 'onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return help(this.href);"';
		}
		elseif ( preg_match('#^onclick#', $onclick) )
		{
			$onclick = $onclick;
		}
		else
		{
			$onclick = 'onclick="' . $onclick . '"';
		}
		
		$data = array(
			'helpurl'		=> $url,
			'helptarget'	=> $id,
			'onclick'		=> $onclick,
			'title'			=> (isset($title) && !empty($title)) ? $title : _HELP_TT,
		);
		return Template::fill($template, $data);
	}
	
	/**
	 * TODO: move
	 * AdminActions::customHelpHtml()
	 */
	private function customHelpHtml($id, $tplName = '', $url = '', $iconURL = '', $alt = '', $title = '', $onclick = '')
	{
		global $CONF, $manager;
		
		$templates = array();
		
		if ( $tplName )
		{
			$templates =& $manager->getTemplate($tplName);
		}
		if ( !array_key_exists('ADMIN_CUSTOMHELPLINK_ICON', $templates) || !empty($templates['ADMIN_CUSTOMHELPLINK_ICON']) )
		{
			$template = "<img src=\"<%iconurl%>\" <%width%><%height%>alt=\"<%alt%>\" title=\"<%title%>\" /></a>\n";
		}
		else
		{
			$template = $templates['ADMIN_CUSTOMHELPLINK_ICON'];
		}
		
		if ( empty($iconURL) )
		{
			$iconURL = $CONF['AdminURL'] . 'documentation/icon-help.gif';
		}
		
		if ( function_exists('getimagesize') )
		{
			$size	= getimagesize($iconURL);
			$width	= 'width="'  . $size[0] . '" ';
			$height	= 'height="' . $size[1] . '" ';
		}
		
		$data = array(
			'iconurl'	=> $iconURL,
			'width'		=> $width,
			'height'	=> $height,
			'alt'		=> (isset($alt) && !empty($alt))	 ? $alt   : _HELP_TT,
			'title'		=> (isset($title) && !empty($title)) ? $title : _HELP_TT,
		);
		
		$icon = Template::fill($template, $data);
		$help = $this->customHelplink($id, $tplName, $url, $title, $onclick);
		
		return $help . $icon;
	}
	
	/**
	 * AdminActions::existsNewPlugin()
	 * Check exists new plugin
	 *
	 * @param	void
	 * @return	boolean	exists or not
	 */
	private function existsNewPlugin()
	{
		global $DIR_PLUGINS;
		
		$query = "SELECT * FROM %s;";
		$query = sprintf($query, sql_table('plugin'));
		$res  = DB::getResult($query);
		
		$installed = array();
		foreach( $res as $row )
		{
			$installed[] = $row['pfile'];
		}
		
		$files = scandir($DIR_PLUGINS);
		
		$candidates = array();
		foreach ( $files as $file )
		{
			if ( preg_match("#^(NP_.*)\.php$#", $file, $matches) )
			{
				if ( !in_array($matches[1], $installed) )
				{
					$candidates[] = preg_replace("#^NP_#", "", $matches[1]);
				}
			}
		}
		$this->newPlugCandidates = $candidates;
		return (count($candidates) > 0);
	}
	
	/**
	 * AdminActions::pagehead()
	 * Output admin page head
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_pagehead()
	{
		global $member, $nucleus, $CONF, $manager;
		
		/* HTTP 1.1 application for no caching */
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		
		$content = $this->parser->skin->getContentFromDB('pagehead');
		if ( !$content )
		{
			$root_element = 'html';
			$charset = i18n::get_current_charset();
			$locale = preg_replace('#_#', '-', i18n::get_current_locale());
			$xml_version_info = '1.0';
			$formal_public_identifier = '-//W3C//DTD XHTML 1.0 Strict//EN';
			$system_identifier = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd';
			$xhtml_namespace = 'http://www.w3.org/1999/xhtml';
			
			$content = "<?xml version=\"{$xml_version_info}\" encoding=\"{$charset}\" ?>\n"
			          . "<!DOCTYPE {$root_element} PUBLIC \"{$formal_public_identifier}\" \"{$system_identifier}\">\n"
			          . "<{$root_element} xmlns=\"{$xhtml_namespace}\" xml:lang=\"{$locale}\" lang=\"{$locale}\">\n"
			          . "<head>\n"
			          . "<title><%sitevar(name)%> - Admin</title>\n"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/edit.js)%>\"></script>"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/admin.js)%>\"></script>"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/compatibility.js)%>\"></script>"
			          . "<%extrahead%>"
			          . "</head>"
			          . "<body>"
			          . "<div id=\"adminwrapper\">"
			          . "<div class=\"header\">"
			          . "<h1><%sitevar(name)%></h1>"
			          . "</div>"
			          . "<div id=\"container\">"
			          . "<div id=\"content\">"
			          . "<div class=\"loginname\">"
			          . "<link rel=\"stylesheet\" title=\"Nucleus Admin Default\" type=\"text/css\" href=\"<%skinfile(admin/defaultadmin/styles/addedit.css%>\" />\n"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/edit.js)%>\"></script>\n"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/admin.js)%>\"></script>\n"
			          . "<script type=\"text/javascript\" src=\"<%skinfile(/javascripts/compatibility.js)%>\"></script>\n"
			          . "<%extrahead%>\n"
			          . "</head>\n"
			          . "\n"
			          . "<body>\n"
			          . "<div id=\"adminwrapper\">\n"
			          . "<div class=\"header\">\n"
			          . "<h1><%sitevar(name)%></h1>\n"
			          . "</div>\n"
			          . "<div id=\"container\">\n"
			          . "<div id=\"content\">\n"
			          . "<div class=\"loginname\">\n"
			          . "<%if(loggedin)%>"
			          . "<%text(_LOGGEDINAS)%> <%member(yourrealname)%> - <a href=\"<%adminurl%>index.php?action=logout\"><%text(_LOGOUT)%></a><br />"
			          . "<a href=\"<%adminurl%>index.php?action=overview\"><%text(_ADMINHOME)%></a> - "
			          . "<%else%>"
			          . "<a href=\"<%adminurl%>index.php?action=showlogin\" title=\"Log in\"><%text(_NOTLOGGEDIN)%></a><br />"
			          . "<%endif%>"
			          . "<a href=\"<%sitevar(url)%>\"><%text(_YOURSITE)%></a><br />"
			          . "("
			          . "<%if(superadmin)%>"
			          . "<a href=\"<%versioncheckurl%>\" title=\"<%text(_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE)%>\"><%version%><%codename%></a>"
			          . "<%newestcompare%><%else%><%version%><%codename%>"
			          . "<%endif%>"
			          . ")"
			          . "</div>";
		}
		
		$this->parser->parse($content);
		return;
	}
	
	/**
	 * AdminActionss::pagefoot()
	 * Output admin page foot include quickmenu
	 *
	 * @param	void
	 * @return	void
	 */
	public function parse_pagefoot()
	{
		global $action, $member, $manager, $blogid;

		$data = array('action' => Admin::$action);
		$manager->notify('AdminPrePageFoot', $data);
		
		$content = $this->parser->skin->getContentFromDB('pagefoot');
		if ( !$content )
		{
			$content = "<%if(loggedin)%>"
			         . "<%ifnot(adminaction,showlogin)%>"
			         . "<h2><%text(_LOGOUT)%></h2>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=overview\"><%text(_BACKHOME)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=logout\"><%text(_LOGOUT)%></a></li>"
			         . "</ul>"
			         . "<%endif%>"
			         . "<%endif%>"
			         . "<div class=\"foot\">"
			         . "<a href=\"<%text(_ADMINPAGEFOOT_OFFICIALURL)%>\">Nucleus CMS</a> &copy; 2002- <%date(%Y)%> <%text(_ADMINPAGEFOOT_COPYRIGHT)%>"
			         . " - <a href=\"<%text(_ADMINPAGEFOOT_DONATEURL)%>\"><%text(_ADMINPAGEFOOT_DONATE)%></a>"
			         . "</div>"
			         . "</div>"
			         . "<!-- content -->"
			         . "<div id=\"quickmenu\">"
			         . "<%if(loggedin)%>"
			         . "<%ifnot(adminaction,showlogin)%>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=overview\"><%text(_QMENU_HOME)%></a></li>"
			         . "</ul>"
			         . "<h2><%text(_QMENU_ADD)%></h2>"
			         . "<form method=\"get\" action=\"<%adminurl%>index.php\">"
			         . "<div>"
			         . "<input type=\"hidden\" name=\"action\" value=\"createitem\" />"
			         . "<%qmenuaddselect(admin/default)%>"
			         . "</div>"
			         . "</form>"
			         . "<h2><%member(yourrealname)%></h2>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=editmembersettings\"><%text(_QMENU_USER_SETTINGS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=browseownitems\"><%text(_QMENU_USER_ITEMS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=browseowncomments\"><%text(_QMENU_USER_COMMENTS)%></a></li>"
			         . "</ul>"
			         . "<%if(superadmin)%>"
			         . "<h2><%text(_QMENU_MANAGE)%></h2>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=actionlog\"><%text(_QMENU_MANAGE_LOG)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=settingsedit\"><%text(_QMENU_MANAGE_SETTINGS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=systemoverview\"><%text(_QMENU_MANAGE_SYSTEM)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=usermanagement\"><%text(_QMENU_MANAGE_MEMBERS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=createnewlog\"><%text(_QMENU_MANAGE_NEWBLOG)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=backupoverview\"><%text(_QMENU_MANAGE_BACKUPS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=pluginlist\"><%text(_QMENU_MANAGE_PLUGINS)%></a></li>"
			         . "</ul>"
			         . "<h2><%text(_QMENU_LAYOUT)%></h2>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=skinoverview\"><%text(_QMENU_LAYOUT_SKINS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=templateoverview\"><%text(_QMENU_LAYOUT_TEMPL)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=skinieoverview\"><%text(_QMENU_LAYOUT_IEXPORT)%></a></li>"
			         . "</ul>"
			         . "<h2><%text(_SKINABLEADMIN_QMENU_LAYOUT)%></h2>"
			         . "<ul>"
			         . "<li><a href=\"<%adminurl%>index.php?action=adminskinoverview\"><%text(_QMENU_LAYOUT_SKINS)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=admintemplateoverview\"><%text(_QMENU_LAYOUT_TEMPL)%></a></li>"
			         . "<li><a href=\"<%adminurl%>index.php?action=adminskinieoverview\"><%text(_QMENU_LAYOUT_IEXPORT)%></a></li>"
			         . "</ul>"
			         . "<%endif%>"
			         . "<%quickmenu(admin/default)%>"
			         . "<%endif%>"
			         . "<%elseif(adminaction,activate)%>"
			         . "<h2><%text(_QMENU_ACTIVATE)%></h2>"
			         . "<%text(_QMENU_ACTIVATE_TEXT)%>"
			         . "<%elseif(adminaction,activatesetpwd)%>"
			         . "<h2><%text(_QMENU_ACTIVATE)%></h2><%text(_QMENU_ACTIVATE_TEXT)%>"
			         . "<%else%>"
			         . "<h2><%text(_QMENU_INTRO)%></h2><%text(_QMENU_INTRO_TEXT)%>"
			         . "<%endif%>"
			         . "</div>"
			         . "<!-- content / quickmenu container -->"
			         . "<div class=\"clear\"></div>"
			         . "<!-- new -->"
			         . "</div>"
			         . "<!-- adminwrapper -->"
			         . "<!-- new -->"
			         . "</div>"
			         . "<!-- new -->"
			         . "<p style=\"text-align:right;\"><%benchmark%></p>"
			         . "</body>"
			         . "</html>";
		}
		
		$this->parser->parse($content);
		return;
	}
	/**
	 * AdminActions::selectBlog()
	 * Inserts a HTML select element with choices for all blogs to which the user has access
	 *      mode = 'blog' => shows blognames and values are blogids
	 *      mode = 'category' => show category names and values are catids
	 *
	 * @param	string	$name
	 * @param	string	$mode
	 * @param	integer	$selected
	 * @param	integer	$tabindex
	 * @param	integer	$showNewCat
	 * @param	integer	$iForcedBlogInclude	ID for weblog always included
	 * @param $iForcedBlogInclude
	 *      ID of a blog that always needs to be included, without checking if the
	 *      member is on the blog team (-1 = none)
	 * @return	void
	 */
	private function selectBlog($name, $mode='blog', $selected = 0, $tabindex = 0, $showNewCat = 0, $iForcedBlogInclude = -1)
	{
		global $member, $CONF;
		
		// 0. get IDs of blogs to which member can post items (+ forced blog)
		$aBlogIds = array();
		if ( $iForcedBlogInclude != -1 )
		{
			$aBlogIds[] = intval($iForcedBlogInclude);
		}
		
		if ( $member->isAdmin() && array_key_exists('ShowAllBlogs', $CONF) && $CONF['ShowAllBlogs'] )
		{
			$query =  "SELECT bnumber FROM %s ORDER BY bname;";
			$query = sprintf($query, sql_table('blog'));
		}
		else
		{
			$query =  "SELECT bnumber FROM %s, %s WHERE tblog=bnumber AND tmember=%d;";
			$query = sprintf($query, sql_table('blog'), sql_table('team'), (integer) $member->getID());
		}
		
		$rblogids = DB::getResult($query);
		foreach ( $rblogids as $row )
		{
			if ( $row['bnumber'] != $iForcedBlogInclude )
			{
				$aBlogIds[] = intval($row['bnumber']);
			}
		}
		
		if ( count($aBlogIds) == 0 )
		{
			return;
		}
		
		echo "<select name=\"{$name}\" tabindex=\"{$tabindex}\">\n";
		
		// 1. select blogs (we'll create optiongroups)
		// (only select those blogs that have the user on the team)
		$queryBlogs = "SELECT bnumber, bname FROM %s WHERE bnumber in (%s) ORDER BY bname;";
		$queryBlogs = sprintf($queryBlogs, sql_table('blog'), implode(',', $aBlogIds));
		$blogs = DB::getResult($queryBlogs);
		
		if ( $mode == 'category' )
		{
			if ( $blogs->rowCount() > 1 )
			{
				$multipleBlogs = 1;
			}
			foreach ( $blogs as $rBlog )
			{
				if ( isset($multipleBlogs) && !empty($multipleBlogs) )
				{
					echo '<optgroup label="' . Entity::hsc($rBlog['bname']) . "\">\n";
				}
				
				// show selection to create new category when allowed/wanted
				if ( $showNewCat )
				{
					// check if allowed to do so
					if ( $member->blogAdminRights($rBlog['bnumber']) )
					{
						echo '<option value="newcat-' . $rBlog['bnumber'] . '">' . _ADD_NEWCAT . "</option>\n";
					}
				}
				
				// 2. for each category in that blog
				$catQuery = "SELECT cname, catid FROM %s WHERE cblog=%d ORDER BY cname ASC;";
				$catQuery = sprintf($catQuery, sql_table('category'), (integer) $rBlog['bnumber']);
				$categories = DB::getResult($catQuery);
				foreach ( $categories as $rCat )
				{
					if ( $rCat['catid'] == $selected )
					{
						$selectText = ' selected="selected" ';
					}
					else
					{
						$selectText = '';
					}
					echo '<option value="' . $rCat['catid'] . '" ' . $selectText . '>' . Entity::hsc($rCat['cname']) . "</option>\n";
				}
				
				if ( isset($multipleBlogs) && !empty($multipleBlogs) )
				{
					echo '</optgroup>';
				}
			}
		}
		else
		{
			foreach ( $blogs as $rBlog )
			{
				echo '<option value="' . $rBlog['bnumber'] . '"';
				if ( $rBlog['bnumber'] == $selected )
				{
					echo '<option value="' . $rBlog['bnumber'] . '" selected="selected">' . Entity::hsc($rBlog['bname']) . "</option>\n";
				}
				else
				{
					echo '<option value="' . $rBlog['bnumber'] . '">' . Entity::hsc($rBlog['bname']) . "</option>\n";
				}
			}
		}
		echo "</select>\n";
		return;
	}
}
