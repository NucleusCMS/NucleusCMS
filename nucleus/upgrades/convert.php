<?php
include_once('upgrade.functions.php');
$prefix = sql_table('');
$rs = sql_query("SHOW TABLES LIKE '{$prefix}%'");

$error = 0;
while($row = sql_fetch_row($rs))
{
	$sql = sprintf('ALTER TABLE `%s` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci', $row[0]);
	$rs = sql_query($sql);
	if(!$rs) $error++;
}

header('Content-Type: text/html; charset=UTF-8');
if($error===0) echo '各Tableの文字セット照合順序をutf8_general_ciに変更しました。';
else           echo '一部のTableが変換に失敗しました。' . "エラー数：{$error}";
