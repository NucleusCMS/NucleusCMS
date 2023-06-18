<?php
	$filename = __DIR__ . '/japanese-utf8.php';
	$contents = file_get_contents($filename);
	$contents = mb_convert_encoding($contents, 'eucJP-win', 'UTF-8');
	$contents = str_replace("'UTF-8'", "'EUC-JP'", $contents);
	eval('?>' . $contents);
