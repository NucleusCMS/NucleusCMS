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
	//include $DIR_LIBS."ACTION.php";
	include_libs('ACTION.php',false,false);
	
	if (isset ($_POST['showform']) && $_POST['showform']==1) {
		$showform = 1;
	}
	else {
		$showform = 0;
	}
	sendContentType('text/html', 'createaccount', _CHARSET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Create Member Account</title>
	<style type="text/css">@import url(nucleus/styles/manual.css);</style>
</head>
<body>

	<h1>Create Account</h1>

<?php
	// show form only if Visitors are allowed to create a Member Account
	if ($CONF['AllowMemberCreate']==1) { 
		// if the form is shown the first time no POST data 
		// will be added as value for the input fields
		if ($showform==0) {
?>

	<form method="post" action="createaccount.php">

	<div>
	<input type="hidden" name="showform" value="1" />
	<input type="hidden" name="action" value="createaccount" />
	
		Login Name (required): 
		<br />
		<input name="name" size="32" maxlength="32" /> <small>(only a-z, 0-9)</small>
		<br />
		<br />		
		Real Name (required): 
		<br />
		<input name="realname" size="40" />
		<br />
		<br />		
		Email (required):
		<br />
		<input name="email" size="40" /> <small>(must be valid, because an activation link will be sent over there)</small>
		<br />
		<br />		
		URL: 
		<br />
		<input name="url" size="60" />
		<br />
		<?php
		// add extra fields from Plugins, like NP_Profile
		$data = array(
			'type'		=> 'createaccount.php',
			'prelabel'	=> '', 'postlabel' => '<br />',
			'prefield'	=> '', 'postfield' => '<br /><br />'
		);
		$manager->notify('RegistrationFormExtraFields', $data);
		// add a Captcha challenge or something else
		global $manager;
		$data = array('type' => 'membermailform-notloggedin');
		$manager->notify('FormExtra', $data);
		?>
		<br />
		<br />						
		<input type="submit" value="Create Account" />
	</div>

	</form>
<?php
		} // close if showfrom ...
		else {
		// after the from is sent it will be validated
		// POST data will be added as value to treat the user with care (;-))
	
		$a = new ACTION();

		// if createAccount fails it returns an error message 
		$message = $a->createAccount();

		echo '<span style="font-weight:bold; color:red;">'.$message.'</span><br /><br />'; 
?>
	
		<form method="post" action="createaccount.php">

	<div>
	<input type="hidden" name="showform" value="1" />
	<input type="hidden" name="action" value="createaccount" />
	
		Login Name (required): 
		<br />
		<input name="name" size="32" maxlength="32" <?php if(isset($_POST['name'])){echo 'value="'.hsc($_POST['name']).'"';}?>/> <small>(only a-z, 0-9)</small>
		<br />
		<br />		
		Real Name (required): 
		<br />
		<input name="realname" size="40" <?php if(isset($_POST['realname'])){echo 'value="'.hsc($_POST['realname']).'"';}?>/>
		<br />
		<br />		
		Email (required):
		<br />
		<input name="email" size="40" <?php if(isset($_POST['email'])){echo 'value="'.hsc($_POST['email']).'"';}?>/> <small>(must be valid, because an activation link will be sent over there)</small>
		<br />
		<br />		
		URL: 
		<br />
		<input name="url" size="60" <?php if(isset($_POST['url'])){echo 'value="'.hsc($_POST['url']).'"';}?>/>
		<br />
		<?php
		// add extra fields from plugin, like NP_Profile
		$data = array(
			'type'		=> 'createaccount.php',
			'prelabel'	=> '', 'postlabel' => '<br />',
			'prefield'	=> '', 'postfield' => '<br /><br />'
		);
		$manager->notify('RegistrationFormExtraFields', $data);
		// add a Captcha challenge or something else
		global $manager;
		$data = array('type' => 'membermailform-notloggedin');
		$manager->notify('FormExtra', $data);
		?>
		<br />
		<br />
		<input type="submit" value="Create Account" />
	</div>

	</form>
<?php
		}	// close else showform ...

}
else { 
	echo 'Visitors are not allowed to create a Member Account.<br /><br />';
	echo 'Please contact the website administrator for more information.';
}
?>
	
	
</body>
</html>