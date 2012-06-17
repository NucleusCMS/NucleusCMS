/* init */
if ( !medium )
{
	var medium = new Object();
	medium.type = 'inline';
	medium.url = '';

}

/* for main window */
medium.addMedia = function()
{
	window.open(this.url,
	 'Nucleus CMS Medium Plugin',
	 'status=yes,toolbar=no,scrollbars=yes,resizable=yes,width=500,height=450,top=0,left=0');
	return;
};

medium.isCaretEmpty = function()
{
	/* lastSelected object is on main window */
	if ( lastSelected && lastSelected.createTextRange && lastSelected.caretPos )
	{
		return ( lastSelected.caretPos.text == '' );
	}
	else if ( !document.all && document.getElementById )
	{
		return ( mozSelectedText() == '' );
	}
	return true;
};

medium.getCaretText = function()
{
	if ( !document.all && document.getElementById )
	{
		return mozSelectedText();
	}
	return lastSelected.caretPos.text;
}

// inserts text at caret (overwriting selection)
medium.insertAtCaret = function(text)
{
	/* lastSelected is on main window */
	var textEl = lastSelected;
	if ( textEl && textEl.createTextRange && textEl.caretPos )
	{
		var caretPos = textEl.caretPos;
		
		if ( caretPos.text.charAt(caretPos.text.length - 1) != ' ' )
		{
			caretPos.text = text;
		}
		else
		{
			caretPos.text = text + ' ';
		}
	}
	else if ( !document.all && document.getElementById )
	{
		mozReplace(document.getElementById('input' + nonie_FormType), text);
		if ( scrollTop > -1 )
		{
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	}
	else if ( textEl )
	{
		textEl.value  += text;
	}
	else
	{
		document.getElementById('input' + nonie_FormType).value += text;
		if ( scrollTop > -1 )
		{
			document.getElementById('input' + nonie_FormType).scrollTop = scrollTop;
		}
	}
	/* updAllPreviews() is on main window */
	updAllPreviews();
	return;
}

medium.includeImage = function(collection, filename, type, width, height)
{
	var fullName;
	var replaceBy;
	
	if ( this.isCaretEmpty() )
	{
		text = prompt("Text to display ?", filename);
	}
	else
	{
		text = this.getCaretText();
	}
	
	/*
	 * add collection name when not private collection
	 * (or editing a message that's not your)
	 */
	if ( isNaN(collection) || (nucleusAuthorId != collection) )
	{
		fullName = collection + '/' + filename;
	}
	else
	{
		fullName = filename;
	}
	
	switch ( type )
	{
		case 'popup':
			replaceBy = '<%popup(' +  fullName + '|'+width+'|'+height+'|' + text +')%>';
			break;
		case 'inline':
		default:
			replaceBy = '<%image(' +  fullName + '|'+width+'|'+height+'|' + text +')%>';
			break;
	}
	
	this.insertAtCaret(replaceBy);
	return;
}

medium.includeOtherMedia = function(collection, filename)
{
	var fullName;
	var replaceBy;
	
	if ( this.isCaretEmpty() )
	{
		text = prompt("Text to display ?",filename);
	}
	else
	{
		text = getCaretText();
	}
	
	// add collection name when not private collection (or editing a message that's not your)
	if ( isNaN(collection) || (nucleusAuthorId != collection) )
	{
		fullName = collection + '/' + filename;
	}
	else
	{
		fullName = filename;
	}
	
	replaceBy = '<%media(' +  fullName + '|' + text +')%>';
	
	this.insertAtCaret(replaceBy);
	return;
}

/* for sub window */
medium.setType = function(value)
{
	this.type = value;
};

medium.chooseImage = function(collection, filename, width, height)
{
	if ( this.type != 'inline' )
	{
		this.type = 'popup';
	}
	
	window.close();
	window.opener.focus();
	window.opener.medium.includeImage(collection, filename, this.type, width, height);
	return;
}

medium.chooseOther = function(collection, filename)
{
	
	window.close();
	window.opener.focus();
	window.opener.medium.type = this.type;
	window.opener.medium.includeOtherMedia(collection, filename);
	return;
}
