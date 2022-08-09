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

// RSD file (http://archipelago.phrasewise.com/rsd)
$CONF = array();
include('./config.php');

if (isset($CONF['DisableRSS']) && $CONF['DisableRSS']) {
    header("HTTP/1.0 404 Not Found");
    echo "<html><head><title>404 Not Found</title></head><h1>404 Not Found</h1><body></body></html>";
    exit;
}

selectSkin('xml/rsd');
selector();
