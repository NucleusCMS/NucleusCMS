<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-20011 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Registration form for new users
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-20011 The Nucleus Group
 * @version $Id$
 */

require_once "./config.php";
include_libs('ACTION.php',false,false);

sendContentType('text/html', 'createaccount');
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
echo "<html>\n";
echo "<head>\n";
echo "<title>Create Member Account</title>\n";
echo "<style type=\"text/css\">@import url(nucleus/styles/manual.css);</style>\n";
echo "</head>\n";
echo "<body>\n";
echo "<h1>Create Account</h1>\n";

// show form only if Visitors are allowed to create a Member Account
if ( $CONF['AllowMemberCreate'] == 1 )
{
	$name = '';
	$realname ='';
	$email = '';
	$url = '';
	
	/* already submit */
	if ( array_key_exists('showform', $_POST) && $_POST['showform'] == 1 )
	{
		if ( array_key_exists('name', $_POST) )
		{
			$name = $_POST['name'];
		}
		if ( array_key_exists('realname', $_POST) )
		{
			$realname = $_POST['realname'];
		}
		if ( array_key_exists('email', $_POST) )
		{
			$email = $_POST['email'];
		}
		if ( array_key_exists('url', $_POST) )
		{
			$url = $_POST['url'];
		}
		// after the from is sent it will be validated
		// POST data will be added as value to treat the user with care (;-))
		$a = new Action();
		
		$message = $a->createAccount();
		if ( $message != 1 )
		{
			echo '<p style="font-weight:bold; color:red;">' . $message . "</p>\n";
		}
		else
		{
			echo '<p>' . _MSG_ACTIVATION_SENT . "</p>\n"; 
			echo "<p>Return to <a href=\"{$CONF['IndexURL']}\" title=\"{$CONF['SiteName']}\">{$CONF['SiteName']}</a></p>\n";
			echo "</body>\n";
			echo "</html>\n";
			exit;
		}
	}
	
	echo "<form method=\"post\" action=\"createaccount.php\">\n";
	echo "<dl>\n";
	echo "<dt><label for=\"name\">Login Name (required): </label></dt>\n";
	echo "<dd><input id=\"name\"name=\"name\" value=\"{$name}\" size=\"32\" maxlength=\"32\" /><span style=\"\small\">(only a-z, 0-9)</span></dd>\n";
	echo "<dt><label for=\"realname\">Real Name (required): </label></dt>\n";
	echo "<dd><input id=\"realname\" name=\"realname\" value=\"{$realname}\" size=\"40\" /></dd>\n";
	echo "<dt><label for=\"email\">Email (required): </label></dt>\n";
	echo "<dd><input id=\"email\"name=\"email\" value=\"{$email}\" size=\"40\" /><span style=\"\small\">(must be valid, because an activation link will be sent over there)</span></dd>\n";
	echo "<dt><label for=\"url\">URL: </label></dt>\n";
	echo "<dd><input id=\"url\"name=\"url\" value=\"{$url}\" size=\"60\" /></dd>\n";
	echo "<input type=\"hidden\" name=\"showform\" value=\"1\" />\n";
	// add extra fields from Plugins, like NP_Profile
	$manager->notify('RegistrationFormExtraFields', array('type' => 'createaccount.php', 'prelabel' => '', 'postlabel' => '<br />', 'prefield' => '', 'postfield' => '<br /><br />'));
	
	// add a Captcha challenge or something else
	global $manager;
	$manager->notify('FormExtra', array('type' => 'membermailform-notloggedin'));
	echo "<button type=\"submit\" name=\"action\" value=\"createaccount\" />Create Account</button>\n";
	echo "</dl>\n";
	echo "</form>\n";
}
else
{
	echo "<p>\n";
	echo 'Visitors are not allowed to create a Member Account.<br /><br />';
	echo 'Please contact the website administrator for more information.';
	echo "</p>\n";
}
	
echo "</body>\n";
echo "</html>\n";
