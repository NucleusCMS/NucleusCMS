<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
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
 * @copyright Copyright (C) The Nucleus Group
 */

require_once "./config.php";
//include $DIR_LIBS."ACTION.php";
include_libs('ACTION.php', false, false);

sendContentType('text/html', 'createaccount', _CHARSET);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php echo _HTML_XML_NAME_SPACE_AND_LANG_CODE; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET; ?>" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo _CREATE_ACCOUNT_TITLE; ?></title>
    <style type="text/css">@import url(nucleus/styles/manual.css);</style>
</head>
<body>

    <h1><?php echo _CREATE_ACCOUNT0; ?></h1>
<?php
// show form only if Visitors are allowed to create a Member Account
if ($CONF['AllowMemberCreate']==1) {
    if (isset($_POST['showform']) && $_POST['showform'] == 1) {
        // after the from is sent it will be validated
        // POST data will be added as value to treat the user with care (;-))
    
        $a = new ACTION();

        // if createAccount fails it returns an error message
        $message = $a->createAccount();

        echo '<span style="font-weight:bold; color:red;">'.$message.'</span><br /><br />';
    }
    ?>
        <form method="post" action="createaccount.php">
            <div>
                <input type="hidden" name="showform" value="1" />
                <input type="hidden" name="action" value="createaccount" />
                <?php echo _CREATE_ACCOUNT_LOGIN_NAME; ?>
                <br />
                <input name="name" size="32" maxlength="32" value="<?php echo hsc(postVar('name')); ?>" /> <small><?php echo _CREATE_ACCOUNT_LOGIN_NAME_VALID; ?></small>
                <br />
                <br />
                <?php echo _CREATE_ACCOUNT_REAL_NAME; ?>
                <br />
                <input name="realname" size="40" value="<?php echo hsc(postVar('realname')); ?>" />
                <br />
                <br />
                <?php echo _CREATE_ACCOUNT_EMAIL; ?>
                <br />
                <input name="email" size="40" value="<?php echo hsc(postVar('email')); ?>" /> <small><?php echo _CREATE_ACCOUNT_EMAIL2; ?></small>
                <br />
                <br />
                <?php echo _CREATE_ACCOUNT_URL; ?>
                <br />
                <input name="url" size="60" value="<?php echo hsc(postVar('url')); ?>" />
                <br />
        <?php
        // add extra fields from Plugins, like NP_Profile
        $param = array(
            'type'      => 'createaccount.php',
            'prelabel'  => '',
            'postlabel' => '<br />',
            'prefield'  => '',
            'postfield' => '<br /><br />'
        );
        $manager->notify('RegistrationFormExtraFields', $param);
        // add a Captcha challenge or something else
        $param = array('type' => 'membermailform-notloggedin');
        $manager->notify('FormExtra', $param);
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
