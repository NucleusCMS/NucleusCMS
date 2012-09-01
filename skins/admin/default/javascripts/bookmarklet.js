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
  * Some JavaScript code for the bookmarklets
  *
  * $Id$
  */

/**
 * On browsers that have DOM support, the non-visible tabs of the bookmarklet are 
 * initially hidden. This is not defined in the CSS stylesheet since this causes 
 * problems with Opera (which does not seem to be sending form data for input
 * fields which are in a hidden block)
 */
function initStyles() {
	hideBlock('more');
	hideBlock('options');
	hideBlock('preview');
	
	// in browsers that do not support DOM (like opera), the buttons used
	// to switch tabs are useless and can be hidden
	document.getElementById('switchbuttons').style.display = 'inline';
}

/**
 * To be called with id='body','more','options' or 'preview'
 * Hides all other tabs and makes the chosen one visible
 */
function flipBlock(id) {

	showBlock(id);
	
	if (id != 'body')
		hideBlock('body');
	if (id != 'more')
		hideBlock('more');
	if (id != 'options')
		hideBlock('options');
	if (id != 'preview')
		hideBlock('preview');		
	
}

/**
 * Hides one element (tab)
 */
function hideBlock(id) {
	document.getElementById(id).style.display = "none";
}

/**
 * Makes an element (tab) visible
 */
function showBlock(id) {
	document.getElementById(id).style.display = "block";
}

function help(url) {
	popup = window.open(url,'helpwindow','status=no,toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500,top=0,left=0');
	if (popup.focus) popup.focus();
	if (popup.GetAttention) popup.GetAttention();
	return false;
}
