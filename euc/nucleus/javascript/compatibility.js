/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2007 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  *	Javascript code to make sure that:
  *  - javascript still works when sending pages as application/xhtml+xml
  *  - this doesn't break functionality in IE
  *
  * How to use:
  *		- Include this file
  *		- Use createElement() instead of document.createElement()
  *
  * That's basically it :)
  *
  * $Id: compatibility.js,v 1.4 2007-03-22 08:31:55 kimitake Exp $
  * $NucleusJP: compatibility.js,v 1.5 2007/02/04 06:28:45 kimitake Exp $
  */

// to get the script working when page is sent as application/xhtml+xml
function createElement(element) {
  if (document.createElementNS) {
	return document.createElementNS('http://www.w3.org/1999/xhtml', element);
  }
  if (document.createElement) {
	return document.createElement(element);
  }
  return false;
}
