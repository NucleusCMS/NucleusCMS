<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

if (!function_exists('getmtime'))
{
    function getmtime()
    {
        $a = explode (' ',microtime());
        return(double) $a[0] + $a[1];
    }
}

// For benchmarking
global $StartTime;
$StartTime = getmtime();
?>
