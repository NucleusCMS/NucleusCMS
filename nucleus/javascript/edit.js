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
  * This file contains functions to allow adding items from inside the weblog.
  * Also contains code to avoid submitting form data twice.
  *
  * $Id$
  */

var nucleusConvertBreaks = true;
var nucleusMediaPopupURL = '';
var nucleusMediaURL = 'media/';
var nucleusAuthorId = 0;
var scrollTop = -1;

function setConvertBreaks(newval) {	nucleusConvertBreaks = newval; }
function setMediaUrl(url) { nucleusMediaURL = url; }
function setAuthorId(id) { nucleusAuthorId = id; }

function preview(id, value) {
	elem = document.getElementById(id);
	if (!elem) return;

	var preview = nucleusConvertBreaks ? str_replace("\n","<br />",value)+"&#160;" : value+"&#160;";

	// expand the media commands (without explicit collection)
	preview = preview.replace(/\<\%image\(([^\/\|]*)\|([^\|]*)\|([^\|]*)\|([^)]*)\)\%\>/g,"<img src='"+nucleusMediaURL+nucleusAuthorId+"/$1' width='$2' height='$3' alt=\"$4\" />");

	// expand the media commands (with collection)
	preview = preview.replace(/\<\%image\(([^\|]*)\|([^\|]*)\|([^\|]*)\|([^)]*)\)\%\>/g,"<img src='"+nucleusMediaURL+"$1' width='$2' height='$3' alt=\"$4\" />");
	preview = preview.replace(/\<\%popup\(([^\|]*)\|([^\|]*)\|([^\|]*)\|([^)]*)\)\%\>/g,"<a href='' onclick='if (event &amp;&amp; event.preventDefault) event.preventDefault(); alert(\"popup image\"); return false;' title='popup'>$4</a>");
	preview = preview.replace(/\<\%media\(([^\|]*)\|([^)]*)\)\%\>/g,"<a href='' title='media link'>$2</a>");

	elem.innerHTML = preview;
}

function showedit() {
	prevval = document.getElementById('edit').style.display;
	if (prevval == "block")
		newval = "none";
	else
		newval = "block";
	document.getElementById('edit').style.display = newval;

	if (newval == "block")
		updAllPreviews();
}

function updAllPreviews() {
	updPreview('title');
	updPreview('body');
	updPreview('more');
}

function isEditVisible() {
	var editform = document.getElementById('edit');
	if (!editform) return true;
	var prevval = editform.style.display;
	return (prevval == "none") ? false : true;
}

function updPreview(id) {
	// don't update when preview is hidden
	if (!isEditVisible()) return;

	var inputField = document.getElementById('input' + id);
	if (!inputField) return;
	preview('prev' + id, inputField.value);
}

// replace a in s by b (taken from milov.nl)
function str_replace(a, b, s)
{
	if (a == b || !s.length || !a.length) return s;
	if ((p=s.indexOf(a)) == -1) { return s; }
	else { ns = s.substring(0,p) + b + s.substring(p+a.length,s.length); }
	return (s.indexOf(a) != -1) ? str_replace(a, b, ns) : ns;
}

function shortCuts() {
	if (!event || (event.ctrlKey != true)) return;

	switch (event.keyCode) {
		case 1:
			ahrefThis(); break; // ctrl-shift-a
		case 2:
			boldThis(); break; // ctrl-shift-b
		case 9:
			italicThis(); break; // ctrl-shift-i
		case 13:
			addMedia(); break; // ctrl-shift-m
		default:
			return;
	}
	return;
}

function cutThis() { execAndUpdate('cut'); }
function copyThis() { execAndUpdate('copy'); }
function pasteThis() { execAndUpdate('paste'); }
function boldThis() { insertAroundCaret('<b>','</b>'); }
function italicThis() { insertAroundCaret('<i>','</i>'); }
function leftThis() { insertAroundCaret('<div class="leftbox">','</div>'); }
function rightThis() { insertAroundCaret('<div class="rightbox">','</div>'); }
function alignleftThis() { insertAroundCaret('<div style="text-align: left">','</div>'); }
function alignrightThis() { insertAroundCaret('<div style="text-align: right">','</div>'); }
function aligncenterThis() { insertAroundCaret('<div style="text-align: center">','</div>'); }


function ahrefThis() {
	if (document.selection)
		strSelection = document.selection.createRange().text;
	else
		strSelection = '';

	strHref = prompt("Create a link to:","http://");
	if (strHref == null) return;

	var textpre = "<a href=\"" + strHref.replace(/&/g,'&amp;') + "\">";
	insertAroundCaret(textpre, "</a>");
}

function execAndUpdate(action) {
	lastSelected.caretPos.execCommand(action);
	updAllPreviews();
}


var nonie_FormType = 'body';

// Add media to new item
function addMedia() {

	var mediapopup = window.open(nucleusMediaPopupURL + 'media.php','name',
		'status=yes,toolbar=no,scrollbars=yes,resizable=yes,width=500,height=450,top=0,left=0');

	return;
}


function setMediaPopupURL(url) {
	nucleusMediaPopupURL = url;
}

function includeImage(collection, filename, type, width, height) {
	if (isCaretEmpty()) {
		text = prompt("Text to display ?",filename);
	} else {
		text = getCaretText();
	}

	// add collection name when not private collection (or editing a message that's not your)
	var fullName;
	if (isNaN(collection) || (nucleusAuthorId != collection)) {
		fullName = collection + '/' + filename;
	} else {
		fullName = filename;
	}


	var replaceBy;
	switch(type) {
		case 'popup':
			replaceBy = '<%popup(' +  fullName + '|'+width+'|'+height+'|' + text +')%>';
			break;
		case 'inline':
		default:
			replaceBy = '<%image(' +  fullName + '|'+width+'|'+height+'|' + text +')%>';
	}

	insertAtCaret(replaceBy);
	updAllPreviews();

}


function includeOtherMedia(collection, filename) {
	if (isCaretEmpty()) {
		text = prompt("Text to display ?",filename);
	} else {
		text = getCaretText();
	}

	// add collection name when not private collection (or editing a message that's not your)
	var fullName;
	if (isNaN(collection) || (nucleusAuthorId != collection)) {
		fullName = collection + '/' + filename;
	} else {
		fullName = filename;
	}

	var replaceBy = '<%media(' +  fullName + '|' + text +')%>';

	insertAtCaret(replaceBy);
	updAllPreviews();
}



// function to prevent submitting form data twice
var submitcount=0;
function checkSubmit() {
	if (submitcount == 0) {
		submitcount++;
		return true;
	} else {
		return false;
	}
}


// code to store the caret (cursor) position of a text field/text area
// taken from javascript.faqts and modified
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130

// stores the caret
function storeCaret (textEl) {

	// store caret
	if (textEl.createTextRange)
		textEl.caretPos = document.selection.createRange().duplicate();

	// also store lastselectedelement
	lastSelected = textEl;

	nonie_FormType = textEl.name;

	scrollTop = textEl.scrollTop;
}

var lastSelected;

 // inserts text at caret (overwriting selection)
function insertAtCaret (text) {
	var textEl = lastSelected;
	if (textEl && textEl.createTextRange && textEl.caretPos) {
		var caretPos = textEl.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
	} else if (!document.all && document.getElementById) {
		mozReplace(document.getElementById('input' + nonie_FormType), text);
		if(scrollTop>-1) {
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	} else if (textEl) {
		textEl.value  += text;
	} else {
		document.getElementById('input' + nonie_FormType).value += text;
		if(scrollTop>-1) {
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	}
	updAllPreviews();
}

 // inserts a tag around the selected text
function insertAroundCaret (textpre, textpost) {
	var textEl = lastSelected;

	if (textEl && textEl.createTextRange && textEl.caretPos) {
		var caretPos = textEl.caretPos;
		caretPos.text = textpre + caretPos.text + textpost;
	} else if (!document.all && document.getElementById) {
		mozWrap(document.getElementById('input' + nonie_FormType), textpre, textpost);
		if(scrollTop>-1) {
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	} else {
		document.getElementById('input' + nonie_FormType).value += textpre + textpost;
		if(scrollTop>-1) {
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	}

	updAllPreviews();
}

/* some methods to get things working in Mozilla as well */
function mozWrap(txtarea, lft, rgt) {
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd==1 || selEnd==2) selEnd=selLength;
	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + lft + s2 + rgt + s3;
}
function mozReplace(txtarea, newText) {
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd==1 || selEnd==2) selEnd=selLength;
	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + newText + s3;
}
function mozSelectedText() {
	var txtarea = document.getElementById('input' + nonie_FormType);
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd==1 || selEnd==2) selEnd=selLength;
	return (txtarea.value).substring(selStart, selEnd);
}

function getCaretText() {
	if (!document.all && document.getElementById)
		return mozSelectedText();
	else
		return lastSelected.caretPos.text;
}

function isCaretEmpty() {
	if (lastSelected && lastSelected.createTextRange && lastSelected.caretPos)
		return (lastSelected.caretPos.text == '');
	else if (!document.all && document.getElementById)
		return (mozSelectedText() == '');
	else
		return true;
}

function BtnHighlight(el) {
	with(el.style){
		borderLeft="1px solid gray";
		borderRight="1px solid #e9e9e9";
		borderTop="1px solid gray";
		borderBottom="1px solid #e9e9e9";
	}
}

function BtnNormal(el) {
	with(el.style){
		padding="3px";
		border="1px solid #dddddd";
	}
}

