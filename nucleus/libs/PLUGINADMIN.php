<?php

/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * code to make it easier to create plugin admin areas
  */

include($DIR_LIBS . 'ADMIN.php');

class PluginAdmin {
	

	function PluginAdmin($pluginName)
	{
		global $manager;
		
		$this->plugin =& $manager->getPlugin('NP_' . $pluginName);
		$this->bValid = $this->plugin;
	
		if (!$this->bValid)
			doError('Invalid plugin');
		
		$this->admin = new ADMIN();
		$this->admin->action = 'plugin_' . $pluginName;
	}
	
	function start($extraHead = '')
	{
		global $CONF;
		$strBaseHref  = '<base href="' . htmlspecialchars($CONF['AdminURL']) . '" />';	
		$extraHead .= $strBaseHref;
		
		$this->admin->pagehead($extraHead);
	}
	
	function end()
	{
		$this->admin->pagefoot();
	}	
}



?>