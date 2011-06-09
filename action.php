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
 * File containing actions that can be performed by visitors of the site,
 * like adding comments, etc...
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

$CONF = array();
require('./config.php');

// common functions
//include_once($DIR_LIBS . 'ACTION.php');
include_libs('ACTION.php',true,false);

$action = requestVar('action');
$a = new ACTION();
$errorInfo = $a->doAction($action);

if ($errorInfo) {
	doError($errorInfo['message'], new SKIN($errorInfo['skinid']) );
}

?>