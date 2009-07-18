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
  *
  * This page contains xmlHTTPRequest functions for:
  * - AutoSaveDraft
  *
  *
  * Usage:
  * - Add in the page before the form open tag:
  *     <script type="text/javascript" src="javascript/xmlhttprequest.js"></script>
  * - Add in the page behind the form close tag:
  *     var xmlhttprequest = new Array();
  *     xmlhttprequest[0] = createHTTPHandler(); // AutoDraft handler
  *     xmlhttprequest[1] = createHTTPHandler(); // UpdateTicket handler
  *     var seconds = now(); // Last AutoDraft time
  *     var checks = 0; // Number of checks since last AutoDraft
  *     var addform = document.getElementById('addform'); // The form id
  *     var goal = document.getElementById('lastsaved'); // The html div id where 'Last saved: date time' must come
  *     var goalurl = 'action.php'; // The PHP file where the content must be posted to (action.php)
  *     var lastsavedtext = 'Last saved'; // The language variable for 'Last saved'
  *     var formtype = 'add'; // Add or edit form
  * - Add to the form tag:
  *     id="addform"
  * - Add to the textarea's and text fields:
  *     onkeyup="doMonitor();"
  * - Add tot the selectboxes and radio buttons
  *     onchange="doMonitor();"
  * - Add to the form:
  *     <input type="hidden" name="draftid" value="0" />
  * - Optionally a autosave now button can be add:
  *     <input type="button" name="autosavenow" value="AutoSave now" onclick="autoSaveDraft();" />
  *
  *
  * $Id$
  */

/**
 * Creates the xmlHTTPRequest handler
 */
function createHTTPHandler() {
	var httphandler = false;
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		try {
			httphandler = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				httphandler = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (E) {
				httphandler = false;
			}
		}
	@end @*/
	if (!httphandler && typeof XMLHttpRequest != 'undefined') {
		httphandler = new XMLHttpRequest();
	}
	return httphandler;
}

/**
 * Auto saves as draft
 */
function autoSaveDraft() {
	checks = 0;
	seconds = now();

	var title = encodeURI(addform.title.value);
	var body = encodeURI(addform.body.value);
	var catid = addform.catid.options[addform.catid.selectedIndex].value;
	var more = encodeURI(addform.more.value);
	var closed = 0;
	if (addform.closed[0].checked) {
		closed = addform.closed[0].value;
	}
	else if (addform.closed[1].checked) {
		closed = addform.closed[1].value;
	}
	var ticket = addform.ticket.value;

	var querystring = 'action=autodraft';
	querystring += '&title=' + title;
	querystring += '&body=' + body;
	querystring += '&catid=' + catid;
	querystring += '&more=' + more;
	querystring += '&closed=' + closed;
	querystring += '&ticket=' + ticket;
	if (formtype == 'edit') {
		querystring += '&itemid=' + addform.itemid.value;
		querystring += '&type=edit';
	}
	else {
		querystring += '&blogid=' + addform.blogid.value;
		querystring += '&type=add';
	}
	if (addform.draftid.value > 0) {
		querystring += '&draftid=' + addform.draftid.value;
	}

	xmlhttprequest[0].open('POST', goalurl, true);
	xmlhttprequest[0].onreadystatechange = checkMonitor;
	xmlhttprequest[0].setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttprequest[0].send(querystring);

	var querystring = 'action=updateticket&ticket=' + ticket;

	xmlhttprequest[1].open('POST', goalurl, true);
	xmlhttprequest[1].onreadystatechange = updateTicket;
	xmlhttprequest[1].setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttprequest[1].send(querystring);
}

/**
 * Monitors the edits
 */
function doMonitor() {
	if (checks * (now() - seconds) > 120 * 1000 * 50) {
		autoSaveDraft();
	}
	else {
		checks++;
	}
}

/**
 * Checks the process of the saving
 */
function checkMonitor() {
	if (xmlhttprequest[0].readyState == 4) {
		if (xmlhttprequest[0].responseText) {
			if (xmlhttprequest[0].responseText.substr(0, 4) == 'err:') {
				goal.innerHTML = xmlhttprequest[0].responseText.substr(4) + ' (' + formattedDate() + ')';
			}
			else {
				addform.draftid.value = xmlhttprequest[0].responseText;
				goal.innerHTML = lastsavedtext + ' ' + formattedDate();
			}
		}
	}
}

/**
 * Checks the process of the ticket updating
 */
function updateTicket() {
	if (xmlhttprequest[1].readyState == 4) {
		if (xmlhttprequest[1].responseText) {
			if (xmlhttprequest[1].responseText.substr(0, 4) == 'err:') {
				goal.innerHTML = xmlhttprequest[1].responseText.substr(4) + ' (' + formattedDate() + ')';
			}
			else {
				addform.ticket.value = xmlhttprequest[1].responseText;
			}
		}
	}
}

/**
 * Gets now in milliseconds
 */
function now() {
	var now = new Date();
	return now.getTime();
}

/**
 * Gets now in the local dateformat
 */
function formattedDate() {
	var now = new Date();
	return now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
}