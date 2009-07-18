/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * $Id$
 *
 * JavaScript to open non-local links in a new window.
 *
 * How to use:
 *  in the <head>...</head> section of your page, add the following line:
 *
 *  <script type="text/javascript" src="nucleus/javascript/opennew.js"></script>
 *
 *  Then, add the following to your <body> tag:
 *
 *  <body ... onload="setOpenNewWindow(true);">
 *
 *  And you're all done.
 *
 * Variables that can be overridden if necessary:
 *	local = something to recognize local URLs (by default, if your page is something like
 *              http://www.example.com/path/page.html, then local will be automatically set to
 *              http://www.example.com/path/)
 *      exception = something to recognize exceptions to the local check. You might need this
 *                  when you use a 'click-through' type of script (e.g. when
 *                  http://www.example.com/path/click.php?http://otherpage.com/ would 
 *                  auto-redirect to otherpage.com and record a click in your logs)
 *                  In most of the cases, this variable is unneeded and can be left empty
 *      destinationFrame = name of the destination frame (by default this is "_blank" to spawn a
 *                         new window for each link clicked)
 */


var local = document.URL.substring(0,document.URL.lastIndexOf('/'));
var exception = "";
var destinationFrame = "_blank";

function setOpenNewWindow(newWin) {
	if (newWin) {
		from = ""; to = destinationFrame;
	} else {
		from = destinationFrame; to = "";
	}

	for (var i=0; i<=(document.links.length-1); i++) {
		if (document.links[i].target == from) {

			var href = document.links[i].href;
			var isLocal = (href.indexOf(local) != -1);
			if (isLocal && ((exception=="") || (href.indexOf(exception) != -1)))
				isLocal = false;
			if (!isLocal)
				document.links[i].target = to;
		}
	}
}