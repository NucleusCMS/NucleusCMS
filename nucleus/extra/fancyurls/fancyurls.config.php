<?
	/*
		About
		-----
		This directory contains extra files to make the 'fancy urls' feature even more
		fancier, by eliminating the 'index.php'-part of the URL
	
		Installation
		------------
		
		1. Copy all files in this directory (except for index.html) to your main nucleus dir
		   (where your index.php and action.php file are)
		2. Edit this file so that $CONF['Self'] points to your main directory. 
			NOTE: this time, and only this time, the URL should NOT end in a slash
		3. Also edit the $CONF['Self'] variable in your index.php, if you don't want to
		   end up with index.php/item/1234 urls when people come via that way
		4. Enable 'Fancy URLs' in the Nucleus admin area (nucleus management / edit settings)
		5. Off you go!
		
		If it doesn't work:
		-------------------
		
		Remove the files again (don't forget the hidden file .htaccess). Voila.
		
	*/

	
	// remember: this URL should _NOT_ end with a slash. 
	$CONF['Self'] = 'http://www.yourhost.com/yourpath';
	
?>