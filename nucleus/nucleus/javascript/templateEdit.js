/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  *	Javascript code to hide empty textareas when editing templates.
  */

var amountOfFields = 1;
var editText = 'empty field (click to edit)';

function hideUnused() {
	while (document.getElementById('textarea' + amountOfFields)) 
		amountOfFields++;
	amountOfFields--;

	for (var i=1;i<=amountOfFields;i++) {
		var el = document.getElementById('textarea' + i);

		// hide textareas when empty, and add onclick event
		// to make them visible again
		if (el.value == '') {
			el.style.display = 'none';
			var tdEl = document.getElementById('td' + i);
			tdEl.innerHTML += '<a href="" class="expandLink" id="expandLink'+i+'" onclick="return makeVisible('+i+')" tabindex="'+el.tabIndex+'">'+editText+'</a>';
		}
	}

}

function setTemplateEditText(newText) {
	editText = newText;
}

function makeVisible(i) {
	var textareaEl = document.getElementById('textarea' + i);
	var expandEl = document.getElementById('expandLink' + i);

	textareaEl.style.display = 'block';
	expandEl.style.display = 'none';

	textareaEl.focus();
	return false;
}

window.onload = hideUnused;	