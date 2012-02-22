<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2011 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Nucleus Benchmark
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2011 The Nucleus Group
 * @version $Id: benchmark.inc 904 2009-02-06 16:26:06Z shizuki $
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
