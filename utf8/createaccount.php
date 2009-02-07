<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Create account form
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

require './config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET; ?>" />
		<title><?php echo _CREATE_ACCOUNT_TITLE ?></title>
		<style type="text/css">@import url(nucleus/styles/manual.css);</style>
	</head>
	<body>

		<h1><?php echo _CREATE_ACCOUNT0; ?></h1>
<?php
// show form only if Visitors are allowed to create a Member Account
if ($CONF['AllowMemberCreate']==1) { 
	if (isset($_POST['showform']) && $_POST['showform'] == 1) {
		include $DIR_LIBS . 'ACTION.php';
		// after the from is sent it will be validated
		// POST data will be added as value to treat the user with care (;-))
		$a = new ACTION();
		// if createAccount fails it returns an error message 
		$message = '<span style="font-weight:bold; color:red;">' . htmlspecialchars($a->createAccount()) . '</span><br /><br />';
		if (isset($_POST['name']))
			$name     = 'value="' . htmlspecialchars($_POST['name']) . '" ';
		if (isset($_POST['realname']))
			$realname = 'value="' . htmlspecialchars($_POST['realname']) . '" ';
		if (isset($_POST['email']))
			$email    = 'value="' . htmlspecialchars($_POST['email']) . '" ';
		if (isset($_POST['url']))
			$url      = 'value="' . htmlspecialchars($_POST['url']) . '" ';
//		$showform = 1;
//	} else {
//		$showform = 0;
		echo $message;
	}
?>
		<form method="post" action="createaccount.php">
			<div>
				<input type="hidden" name="showform" value="1" />
				<input type="hidden" name="action" value="createaccount" />
				<?php echo _CREATE_ACCOUNT_LOGIN_NAME; ?>
				<br />
				<input name="name" size="20" <?php echo $name; ?>/> <small><?php echo _CREATE_ACCOUNT_LOGIN_NAME_VALID; ?></small>
				<br />
				<br />
				<?php echo _CREATE_ACCOUNT_REAL_NAME; ?>
				<br />
				<input name="realname" size="40" <?php echo $realname; ?>/>
				<br />
				<br />
				<?php echo _CREATE_ACCOUNT_EMAIL; ?>
				<br />
				<input name="email" size="40" <?php echo $email; ?>/> <small><?php echo _CREATE_ACCOUNT_EMAIL2; ?></small>
				<br />
				<br />
				<?php echo _CREATE_ACCOUNT_URL; ?>
				<br />
				<input name="url" size="60" <?php echo $url; ?>/>
				<br />
<?php
		global $manager;
		// add extra fields from Plugins, like NP_Profile
		$data = array(
			'type'      => 'createaccount.php',
			'prelabel'  => '',
			'postlabel' => '<br />',
			'prefield'  => '',
			'postfield' => '<br /><br />'
		);
		$manager->notify('RegistrationFormExtraFields', $data);
		// add a Captcha challenge or something else
		$manager->notify('FormExtra', array('type' => 'membermailform-notloggedin'));
?>
				<br />
				<br />
				<input type="submit" value="<?php echo _CREATE_ACCOUNT_SUBMIT; ?>" />
			</div>
		</form>
<?php
} else {
	echo _CREATE_ACCOUNT1;
	echo _CREATE_ACCOUNT2;
}
?>
	</body>
</html>
