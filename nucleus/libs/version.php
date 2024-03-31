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
define('NUCLEUS_RELEASE_VERSION', 0); // (int) [0 - 9]

define('NUCLEUS_RELEASE_IDENTIFIER', 'dev202403'); // '' , 'dev',  'RC' , 'RC1' .... ,  'p' , 'p1' ....
// https://getcomposer.org/doc/04-schema.md#version

define('NUCLEUS_DEVELOP', false); // (bool): true (developer mode)

// version.inc.php
include_once(__DIR__ . '/version.inc.php');
