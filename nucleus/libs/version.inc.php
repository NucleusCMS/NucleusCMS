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

/*********************************************************************
 * [ Do not localize  file] The value will be auto-filled
*********************************************************************/

/*********************************************************************
 * (string) NUCLEUS_VERSION
 * (string) NUCLEUS_VERSION_DOT
 * (string) NUCLEUS_VERSION_TEXT
 * (string) NUCLEUS_RAW_VERSION_DOT
 * (string) NUCLEUS_RAW_VERSION_TEXT
 * (int) NUCLEUS_PATCH_LEVEL
 * (int) NUCLEUS_VERSION_ID
 * (int) NUCLEUS_DATABASE_VERSION_ID
*********************************************************************/

/*
 * NUCLEUS_PATCH_LEVEL
 */
$m = [];
if ( ! preg_match('#^p(\d+)$#', NUCLEUS_RELEASE_IDENTIFIER, $m)) {
    define('NUCLEUS_PATCH_LEVEL', 0); // (int)
} else {
    define('NUCLEUS_PATCH_LEVEL', (int) $m[1]); // (int)
}

/*
 * NUCLEUS_VERSION
 */
if (3 >= NUCLEUS_MAJOR_VERSION) {
    // [ string ] Major.MinorRelease
    define('NUCLEUS_VERSION', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION.NUCLEUS_RELEASE_VERSION);
} else {
    // [ string ] Major.Minor.Release
    define('NUCLEUS_VERSION', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION . '.' . NUCLEUS_RELEASE_VERSION);
}

/*
 * NUCLEUS_VERSION_DOT
 */
if (3 >= NUCLEUS_MAJOR_VERSION) {
    // [ string ] Major.MinorRelease
    define('NUCLEUS_VERSION_DOT', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION.NUCLEUS_RELEASE_VERSION);
} else {
    // [ string ] Major.Minor.Release
    define('NUCLEUS_VERSION_DOT', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION . '.' . NUCLEUS_RELEASE_VERSION);
}

/*
 * NUCLEUS_VERSION_TEXT
 */
if ('' !== NUCLEUS_RELEASE_IDENTIFIER) {
    define('NUCLEUS_VERSION_TEXT', NUCLEUS_VERSION_DOT . '-'. NUCLEUS_RELEASE_IDENTIFIER);
} else {
    define('NUCLEUS_VERSION_TEXT', NUCLEUS_VERSION_DOT);
}

/*
 * NUCLEUS_RAW_VERSION_DOT
 */
define('NUCLEUS_RAW_VERSION_DOT', NUCLEUS_MAJOR_VERSION . '.' . NUCLEUS_MINOR_VERSION . '.' . NUCLEUS_RELEASE_VERSION);

/*
 * NUCLEUS_RAW_VERSION_TEXT
 */
if ('' !== NUCLEUS_RELEASE_IDENTIFIER) {
    define('NUCLEUS_RAW_VERSION_TEXT', NUCLEUS_RAW_VERSION_DOT . '-'. NUCLEUS_RELEASE_IDENTIFIER);
} else {
    define('NUCLEUS_RAW_VERSION_TEXT', NUCLEUS_RAW_VERSION_DOT);
}

/*
 * (int) NUCLEUS_VERSION_ID Major * 100 + Minor * 10 + release
 */
define('NUCLEUS_VERSION_ID', NUCLEUS_MAJOR_VERSION * 100 + NUCLEUS_MINOR_VERSION * 10 + NUCLEUS_RELEASE_VERSION);

/*
 * (int) NUCLEUS_DATABASE_VERSION_ID
 */
define('NUCLEUS_DATABASE_VERSION_ID', NUCLEUS_VERSION_ID);
