<?php
	$contents = file_get_contents("{$DIR_LOCALES}language/ja_JP.php");
	$contents = mb_convert_encoding($contents, 'eucJP-win', 'UTF-8');
	eval('?>' . $contents);
	include_once('adminskinTypes.php');
