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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

// we are using admin stuff:
$CONF = array();
$CONF['UsingAdminArea'] = 1;

// include the admin code
require_once('../config.php');

if ( $CONF['alertOnSecurityRisk'] == 1 )
{
	// check if files exist and generate an error if so
	$aFiles = array(
		'../install'	=> _ERRORS_INSTALLDIR,
		'upgrades'		=> _ERRORS_UPGRADESDIR,
		'convert'		=> _ERRORS_CONVERTDIR
	);
	$aFound = array();
	foreach ( $aFiles as $fileName => $fileDesc )
	{
		if ( @file_exists($fileName) )
		{
			array_push($aFound, $fileDesc);
		}
	}
	if ( @is_writable('../config.php') )
	{
		array_push($aFound, _ERRORS_CONFIGPHP);
	}
	if ( sizeof($aFound) > 0 )
	{
		startUpError(
			_ERRORS_STARTUPERROR1. implode($aFound, '</li><li>')._ERRORS_STARTUPERROR2,
			_ERRORS_STARTUPERROR3
		);
	}
}

$bNeedsLogin	= FALSE;
$bIsActivation	= in_array($action, array('activate', 'activatesetpwd'));

if ( $action == 'logout' )
{
	$bNeedsLogin = TRUE;
}

if ( !$member->isLoggedIn() && !$bIsActivation )
{
	$bNeedsLogin = TRUE;
}

// show error if member cannot login to admin
if ( $member->isLoggedIn() && !$member->canLogin() && !$bIsActivation )
{
	$error = _ERROR_LOGINDISALLOWED;
	$bNeedsLogin = TRUE;
}

if ( $bNeedsLogin )
{
	// see Admin::login() (sets old action in POST vars)
	setOldAction($action);
	$action = 'showlogin';
}

if ( !Admin::initialize() )
{
	/* TODO: this is a bad way... */
	sendContentType('text/html', 'admin-' . $action);
	
	$skin =& $manager->getSkin(0, 'AdminActions', 'AdminSkin');
	if ( $bNeedsLogin )
	{
		$skin->parse('fileparse', $DIR_SKINS . 'admin/showlogin.skn');
	}
	else if ($action == 'adminskinieimport' )
	{
		Admin::action($action);
	}
	else
	{
		$skin->parse('importAdmin', $DIR_SKINS . 'admin/defaultimporter.skn');
	}
	/* TODO: something to handling errors */
	exit;
}

Admin::action($action);
exit;
