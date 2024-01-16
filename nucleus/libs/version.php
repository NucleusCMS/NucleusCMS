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
 */

/**
 * @license   http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

define('NUCLEUS_MAJOR_VERSION', 3);   // (int)
define('NUCLEUS_MINOR_VERSION', 8);   // (int) [0 - 9]
define('NUCLEUS_RELEASE_VERSION', 0);   // (int) [0 - 9]

/*
 * string Major.MinorRelease
 */
define('NUCLEUS_VERSION', NUCLEUS_MAJOR_VERSION.'.'.NUCLEUS_MINOR_VERSION.NUCLEUS_RELEASE_VERSION);
define('NUCLEUS_VERSION_DOT', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION . '.' . NUCLEUS_RELEASE_VERSION);

/* int
 * Major * 100 + Minor * 10 + Release
*/
define('NUCLEUS_VERSION_ID', NUCLEUS_MAJOR_VERSION * 100 + NUCLEUS_MINOR_VERSION * 10 + NUCLEUS_RELEASE_VERSION);

define('NUCLEUS_PATCH_LEVEL', 0); // [Deprecated] (int)
define('NUCLEUS_RELEASE_IDENTIFIER', 'rc-202401-2'); // '' , 'dev' , 'rc', 'rc2' , 'fix', ... as you like

/* int
 * Major * 100 + Minor * 10
 * (Major * 100 + Minor * 10 + Release)
*/
define('NUCLEUS_DATABASE_VERSION_ID', NUCLEUS_MAJOR_VERSION * 100 + NUCLEUS_MINOR_VERSION * 10);

define('NUCLEUS_DEVELOP', false); // (bool): true if development version.
