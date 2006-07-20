<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * A class to parses plugin calls inside items
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 * @version $Id$
 */

class BODYACTIONS extends ITEMACTIONS {

	function getDefinedActions() {
		return array('image','media','popup','plugin');
	}

	function parse_plugin($pluginName) {
		global $manager;

		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName)) {
			return;
		}

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);

		call_user_func_array(array(&$plugin,'doItemVar'), $params);
	}
}
?>
