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
 *
 * Part of the code for the Nucleus admin area
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class ENCAPSULATE
{
    protected $isFootNavigation;
    /**
     * Uses $call to call a function using parameters $params
     * This function should return the amount of entries shown.
     * When entries are show, batch operation handlers are shown too.
     * When no entries were shown, $errormsg is used to display an error
     *
     * Passes on the amount of results found (for further encapsulation)
     */
    function doEncapsulate(
        &$call,
        &$params,
        $errorMessage = _ENCAPSULATE_ENCAPSULATE_NOENTRY
    ) {
        // start output buffering
        ob_start();

        $nbOfRows = call_user_func_array($call, $params);

        // get list contents and stop buffering
        $list = ob_get_contents();
        ob_end_clean();

        $this->isFootNavigation = ($nbOfRows > 0);
        $this->showHead();
        if ($nbOfRows > 0) {
            echo $list;
        } else {
            printf("<p class='note'>%s</p>", hsc($errorMessage));
        }
        $this->showFoot();

        return $nbOfRows;
    }

}

include_libs('BATCH.php');
include_libs('NAVLIST.php');
