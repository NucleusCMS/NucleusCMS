<?php
header('Content-Type: text/html; charset=UTF-8');
include_once('upgrade.functions.php');

$srcPrefix = sql_table('');
$newPrefix = 'temp_'.'nucleus_';

@set_time_limit(0);

$charset = getCharSetFromDB(sql_table('config'),'name');

if($charset==='utf8') exit('utf8なので問題ありません。何もせずに終了します。');

sql_query("SET NAMES {$charset}");
$rs = sql_query("SHOW TABLES LIKE '{$srcPrefix}%'");
if(!$rs) exit('Nucleusのtableがありません。何もせずに終了します。');

$srcTableNames=array();
while($row=sql_fetch_array($rs)){
    $srcTableNames[] = $row[0];
}

foreach($srcTableNames as $srcTableName) {
    $newTableName = str_replace($srcPrefix,$newPrefix,$srcTableName);
    
    sql_query("SET NAMES {$charset}");
    sql_query("CREATE TABLE `{$newTableName}` LIKE `{$srcTableName}`");
    sql_query("ALTER TABLE `{$newTableName}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
    
    $rs = sql_query("SELECT * FROM `{$srcTableName}`");
    if(sql_num_rows($rs)==0) {echo "{$newTableName} を作成しました。<br />"; continue;}
    
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
        sql_query("INSERT INTO {$newTableName} ({$inputFields}) VALUES ({$inputValues})");
    }
    echo "{$newTableName} を作成しデータをコピーしました。<br />";
}
echo '完了しました。';
