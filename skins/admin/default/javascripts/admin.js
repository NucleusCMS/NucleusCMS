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
  * Some JavaScript code for the admin area
  *
  * $Id$
  */

function help(url) {
	popup = window.open(url,'helpwindow','status=no,toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500,top=0,left=0');
	if (popup.focus) popup.focus();
	if (popup.GetAttention) popup.GetAttention();
	return false;
}				

var oldCellColor = "#000";
function focusRow(row) {
	var cells = row.cells;
	if (!cells) return;
	oldCellColor = cells[0].style.backgroundColor;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor='whitesmoke';
	}
}
function blurRow(row) {
	var cells = row.cells;
	if (!cells) return;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor=oldCellColor;
	}
}
function batchSelectAll(what) {
	var i = 0;
	var el;
	while (el = document.getElementById('batch' + i)) {
		el.checked = what?'checked':'';
		i++;
	}
	return false;					
}
function selectCanLogin(flag) {
	if (flag) {
		window.document.memberedit.canlogin[0].checked=true;

		// don't disable canlogin[0], otherwise the value won't be passed.
//		window.document.memberedit.canlogin[0].disabled=true;
		window.document.memberedit.canlogin[1].disabled=true;
	} else {
		window.document.memberedit.canlogin[0].disabled=false;
		window.document.memberedit.canlogin[1].disabled=false;
	}
}
