/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *  
  * Some JavaScript code for the bookmarklets
  *
  */

function help(url) {
	popup = window.open(url,'helpwindow','status=no,toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500,top=0,left=0');
	if (popup.focus) popup.focus();
	if (popup.GetAttention) popup.GetAttention();
	return false;
}
