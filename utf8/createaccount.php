<?php
	require "./config.php";
	include $DIR_LIBS."ACTION.php";
	
	if (isset ($_POST['showform'])&&$_POST['showform']==1) {
		$showform = 1;
	}
	else {
		$showform = 0;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja-JP" lang="ja-JP">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo _CHARSET; ?>" />
	<title>Create Member Account</title>
	<style type="text/css">@import url(nucleus/styles/manual.css);</style>
</head>
<body>

	<h1><?php echo _CREATE_ACCOUNT0?></h1>

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
	
		<?php echo _CREATE_ACCOUNT_LOGIN_NAME?>
		<br />
		<input name="name" size="20" /> <small>(only a-z, 0-9)</small>
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_REAL_NAME?>
		<br />
		<input name="realname" size="40" />
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_EMAIL?>
		<br />
		<input name="email" size="40" /> <small><?php echo _CREATE_ACCOUNT_EMAIL2?></small>
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_URL?>
		<br />
		<input name="url" size="60" />
		<br />
		<?php
		// add a Captcha challenge or something else
		global $manager;
		$manager->notify('FormExtra', array('type' => 'membermailform-notloggedin'));
		?>
		<br />
		<br />						
		<input type="submit" value="<?php echo _CREATE_ACCOUNT_SUBMIT?>" />
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

		echo '<span style="font-weight:bold; color:red;">'.htmlspecialchars($message).'</span><br /><br />'; 
?>
	
		<form method="post" action="createaccount.php">

	<div>
	<input type="hidden" name="showform" value="1" />
	<input type="hidden" name="action" value="createaccount" />
	
		<?php echo _CREATE_ACCOUNT_LOGIN_NAME?> 
		<br />
		<input name="name" size="20" <?php if(isset($_POST['name'])){echo 'value="'.htmlspecialchars($_POST['name']).'"';}?>/> <small>(only a-z, 0-9)</small>
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_REAL_NAME?> 
		<br />
		<input name="realname" size="40" <?php if(isset($_POST['realname'])){echo 'value="'.htmlspecialchars($_POST['realname']).'"';}?>/>
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_EMAIL?>
		<br />
		<input name="email" size="40" <?php if(isset($_POST['email'])){echo 'value="'.htmlspecialchars($_POST['email']).'"';}?>/> <small><?php echo _CREATE_ACCOUNT_EMAIL2?></small>
		<br />
		<br />		
		<?php echo _CREATE_ACCOUNT_URL?> 
		<br />
		<input name="url" size="60" <?php if(isset($_POST['url'])){echo 'value="'.htmlspecialchars($_POST['url']).'"';}?>/>
		<br />
		<?php
		// add a Captcha challenge or something else
		global $manager;
		$manager->notify('FormExtra', array('type' => 'membermailform-notloggedin'));
		?>
		<br />
		<br />
		<input type="submit" value="<?php echo _CREATE_ACCOUNT_SUBMIT?>" />


	</form>
<?php
		}	// close else showform ...

}
else { 
	echo _CREATE_ACCOUNT1;
	echo _CREATE_ACCOUNT2;
}
?>
	
	
</body>
</html>
