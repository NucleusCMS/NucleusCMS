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
  * File containing actions that can be performed by visitors of the site,
  * like adding comments, etc...
  *
  * $Id: action.php,v 1.1 2005-02-28 07:13:48 kimitake Exp $
  */

$CONF = array();
include('./config.php');			// common functions
include_once($DIR_LIBS . 'ACTION.php');

$action = requestVar('action');

$a =& new ACTION();
$errorInfo = $a->doAction($action);

if ($errorInfo)
{
	doError($errorInfo['message'], new SKIN($errorInfo['skinid']));	
}

?>