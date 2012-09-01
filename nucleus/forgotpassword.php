<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-20011 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Registration form for new users
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-20011 The Nucleus Group
 * @version $Id$
 */

// we are using admin stuff:
$CONF = array();
$CONF['UsingAdminArea'] = 1;

require_once "../config.php";
include_libs('ACTION.php');

if ( !Admin::initialize() )
{
	/* TODO: something to handling errors */
	exit;
}

Admin::action('forgotpassword');
exit;
