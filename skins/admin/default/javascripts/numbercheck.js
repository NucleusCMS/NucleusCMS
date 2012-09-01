/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2009 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * script the check (on the clientside) if a entered value
  * is a valid number and remove the invalid chars
  *
  * $Id$
  */

function checkNumeric(f)
{
	newval='';
	dot = false;
	for (i = 0; i < f.value.length; i++) {
		c = f.value.substring(i,i+1);
		if (isInteger(c) || ((c == '.')&&(dot == false)) || ((i == 0)&&(c == '-'))) {
			newval += c;
			if (c == '.') {
				dot = true;
			}
		}
	}
	f.value = newval;
}

function isInteger(value)
{
	return (parseInt(value) == value);
}
