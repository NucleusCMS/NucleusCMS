<?php
header('Content-Type: text/html; charset=UTF-8');
include_once('upgrade.functions.php');

$srcPrefix = sql_table('');
$newPrefix = 'temp_'.'nucleus_';

@set_time_limit(0);

$charset = getCharSetFromDB(sql_table('config'),'name');

if($charset==='utf8') exit('utf8なので問題ありません。何もせずに終了します。');

$rs = sql_query("SHOW TABLES LIKE '{$srcPrefix}%'");
if(!$rs) exit('Nucleusのtableがありません。何もせずに終了します。');

$srcTableNames=array();
while($row=sql_fetch_array($rs)){
    $srcTableNames[] = $row[0];
}

foreach($srcTableNames as $srcTableName) {
    $tmpTableName = str_replace($srcPrefix,$newPrefix,$srcTableName);
    
    sql_query("SET NAMES {$charset}");
    sql_query("CREATE TABLE `{$tmpTableName}` LIKE `{$srcTableName}`");
    sql_query("ALTER TABLE `{$tmpTableName}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
    
    $rs = sql_query("SELECT * FROM `{$srcTableName}`");
    if(sql_num_rows($rs)==0) continue;
    
    sql_query('SET NAMES utf8');
    while($row = sql_fetch_object($rs)) {
        $fields = array();
        $values = array();
        foreach($row as $fieldName=>$value) {
            $v = sql_real_escape_string($value);
            $fields[] = "`{$fieldName}`";
            $values[] = "'{$v}'";
        }
        $inputFields = join(',', $fields);
        $inputValues = join(',', $values);
        sql_query("INSERT INTO {$tmpTableName} ({$inputFields}) VALUES ({$inputValues})");
    }
}
foreach($srcTableNames as $srcTableName) {
    $tmpTableName = str_replace($srcPrefix,$newPrefix,$srcTableName);
    sql_query(sprintf("ALTER TABLE `%s` RENAME TO `bak_%s`",$srcTableName,$srcTableName));
    sql_query(sprintf("ALTER TABLE `%s` RENAME TO `%s`",$tmpTableName,$srcTableName));
    echo "{$srcTableName} のデータをutf8に変換しました。<br />";
}
echo '完了しました。';
