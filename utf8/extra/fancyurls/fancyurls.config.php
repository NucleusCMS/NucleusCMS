<?php
	/*
		About
		-----
		
		This directory contains extra files to make the 'fancy urls' feature even more
		fancier, by eliminating the 'index.php'-part of the URL
	
		Installation
		------------
		
		1. Copy all files in this directory (except for index.html) to your main nucleus dir
		   (where your index.php and action.php file are)
		   
		   If you have an already existing .htaccess file (most ftp-programs don't show hidden files
		   by default, so don't start uploading it without checking your server). If you do, download
		   that old one first, and copy the contents of the new .htaccess file (from the fancyurls
		   folder) in your old one, and upload that... 

		2. Edit fancyurls.config.php so that $CONF['Self'] points to your main directory. 
			NOTE: this time, and only this time, the URL should NOT end in a slash

		3. Edit index.php to look like this: 
		   
			$CONF = array();

			include('./fancyurls.config.php'); 
			include('./config.php');

			selector();
			
		4. Enable 'Fancy URLs' in the Nucleus admin area (nucleus management / edit settings)

		5. Off you go!
		
		If it doesn't work:
		-------------------
		
		Remove the files again (don't forget the hidden file .htaccess). Voila.
		
	*/

	
	// remember: this URL should _NOT_ end with a slash. 
	$CONF['Self'] = 'http://www.yourhost.com/yourpath';

    /*
    	Advanced: keywords to use in fancy URLs. 
    	
    	If you want to change these, you'll also need to rename the stub files 
    	and update the contents of the .htaccess file accordingly
    */
    $CONF['ItemKey']        = 'item';
    $CONF['ArchiveKey']     = 'archive';
    $CONF['ArchivesKey']    = 'archives';
    $CONF['MemberKey']      = 'member';
    $CONF['BlogKey']        = 'blog';
    $CONF['CategoryKey']    = 'category';
    $CONF['SpecialskinKey'] = 'special';
?>