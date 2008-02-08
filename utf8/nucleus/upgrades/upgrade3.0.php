<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * $NucleusJP: upgrade3.0.php,v 1.3.2.1 2007/10/24 05:39:16 kimitake Exp $
 *
 */

function upgrade_do30() {

	if (upgrade_checkinstall(30))
		return 'already installed';

	// 2.5(beta/RC/...) -> 3.0
	// update database version  
	update_version('300');
	// nothing!
}

?>
