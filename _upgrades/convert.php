<?php
if (is_file('../config.php')) {
    include_once('../config.php');
} elseif (is_file('config.php')) {
    include_once('config.php');
} else {
    exit('config.phpが見つかりません。');
}

$conv = new convert();
$conv->run();

exit;

class convert
{
    
    var $current_collation;
    var $current_charset;
    var $new_collation;
    var $new_charset;
    var $collations;

    function __construct()
    {
        $this->current_charset   = getCharSetFromDB(sql_table('config'), 'name');
        $this->current_collation = getCollationFromDB(sql_table('config'), 'name');
        $this->collations = explode(',', 'utf8mb4_general_ci,utf8mb4_unicode_ci,utf8_general_ci,utf8_unicode_ci');
    }
    
    function run()
    {
        $tpl = $this->getTemplate();
        $ph['content'] = $this->getContent();
        header('Content-Type: text/html; charset=UTF-8');
        echo parseText($tpl, $ph);
        exit;
    }
    
    function getContent()
    {
        if (isset($_GET['convertto'])) {
            $mode = 'convert';
        } elseif (isset($_GET['complete'])) {
            $mode = 'complete';
        } else {
            $mode = 'default';
        }
        switch ($mode) {
            case 'convert':
                $new_collation = trim($_GET['convertto']);
                return $this->convert($new_collation);
                break;
            case 'complete':
                return '<p>変換を完了しました。</p>';
                break;
            default:
                $tpl = $this->getMainContent();
                $ph['current_collation'] = $this->current_collation;
                $ph['options']           = $this->getOptions($this->current_collation);
                return parseText($tpl, $ph);
        }
    }
    
    function convert($new_collation)
    {
        
        if ($this->current_collation===$new_collation) {
            return '同じコレーションのため変換の必要はありません';
        }
        
        $new_charset   = substr($new_collation, 0, strpos($new_collation, '_'));
        
        $currentPrefix = sql_table('');
        $tmpPrefix = 'temp_'.'nucleus_';
        $bkPrefix = $this->getBkPrefix();

        @set_time_limit(0);
        
        $rs = sql_query("SHOW TABLES LIKE '{$currentPrefix}%'");
        if (!$rs) {
            exit('Nucleusのtableがありません。何もせずに終了します。');
        }
        
        $srcTableNames=array();
        while ($row=sql_fetch_array($rs)) {
            $srcTableNames[] = $row[0];
        }
        
        foreach ($srcTableNames as $srcTableName) {
            $tmpTableName = str_replace($currentPrefix, $tmpPrefix, $srcTableName);
            
            sql_query("SET NAMES {$this->current_charset}");
            sql_query("CREATE TABLE `{$tmpTableName}` LIKE `{$srcTableName}`");
            $vs = array($tmpTableName, $new_charset, $new_collation);
            $sql = vsprintf("ALTER TABLE `%s` CONVERT TO CHARACTER SET %s COLLATE %s", $vs);
            sql_query($sql);
            
            sql_query("SET NAMES {$new_charset}");
            $rs = sql_query("SELECT * FROM `{$srcTableName}`");
            if (0<sql_num_rows($rs)) {
                while ($row = sql_fetch_object($rs)) {
                    $fields = array();
                    $values = array();
                    foreach ($row as $fieldName => $value) {
                        $v = sql_real_escape_string($value);
                        $fields[] = "`{$fieldName}`";
                        $values[] = "'{$v}'";
                    }
                    $inputFields = join(',', $fields);
                    $inputValues = join(',', $values);
                    sql_query("INSERT INTO {$tmpTableName} ({$inputFields}) VALUES ({$inputValues})");
                }
            }
            $bkTableName = $bkPrefix.$srcTableName;
            sql_query(sprintf("ALTER TABLE `%s` RENAME TO `%s`", $srcTableName, $bkTableName));
            sql_query(sprintf("ALTER TABLE `%s` RENAME TO `%s`", $tmpTableName, $srcTableName));
            $output[] = sprintf('%s のデータを%sに変換しました。<br />', $srcTableName, $new_charset);
        }
        
        if ($this->current_charset==='ujis') {
            sql_query(sprintf("UPDATE %s SET `value`='japanese-utf8' WHERE `name`='Language'", sql_table('config')));
        }
        return join("\n", $output) . '<p>変換を完了しました。 <a href="convert.php">戻る</a></p>';
        //sleep(3);
        //header('Location:convert.php?complete');
    }
    
    function getBkPrefix()
    {
        $i = 0;
        while ($i<5) {
            $i++;
            if ($i==1) {
                $bkPrefix = 'bak_';
            } else {
                $bkPrefix = sprintf('bak%s_', $i);
            }
            $rs = sql_query("SHOW TABLES LIKE '{$bkPrefix}%'");
            if (!sql_num_rows($rs)) {
                break;
            }
            if ($i==5) {
                exit('バックアップを作成できません。終了します。');
            }
        }
        return $bkPrefix;
    }
    
    function getMainContent()
    {
        $tpl = '
    <h1>コレーションコンバータ</h1>
    <p>各テーブルのコレーション(照合順序)を変更します。旧テーブルは別名をつけてバックアップします。</p>
    <p>iPhoneの絵文字や異体字などを扱いたい場合は文字コードとしてutf8mb4を、半角・全角・ひらがな・カタカナ・濁音・半濁音を同一扱いするなど曖昧検索が必要な場合は言語名としてunicodeを選んでください。<br />
    特に理由がなければutf8mb4_general_ciを選んでください。</p>
    <div style="overflow:hidden;">
    <p style="float:left;margin-top:0;">現在のコレーション：<%current_collation%></p>
    <form method="GET" style="float:right;text-align:right;">
    <select name="convertto" style="margin-bottom:8px;">
    <%options%>
    </select><br />
    <input type="submit" action="convert.php" value="変換を実行する">
    </form>
    </div>
';
        return $tpl;
    }
    
    function getTemplate()
    {
        $tpl = '
<html>
<head>
    <title>Convert</title>
    <style>
        body {color:#555;background-color:#f5f5f5;line-height:1.7;font-family:Meiryo,\"Hiragino Kaku Gothic Pro\",Arial,\"Helvetica Neue\",Helvetica,sans-serif;}
        .box {background-color:#fff;border:1px solid #ccc;border-radius:8px;padding:1.5em;width:650px;margin:5em auto;}
        input[type=submit] {letter-spacing:1px;font-size:1.2em;background-color:#1abc9c;padding:8px;border:1px solid #1abc9c;color:#fff;border-radius:8px;}
        select,input[type=submit] {
            cursor:pointer;cursor:hand;font-family:inherit;
        }
        option{padding:5px;}
        h1 {font-size:1.5em;letter-spacing:2px;}
        </style>
</head>
<body>
<div class="box">
    <%content%>
</div>
</body>
</html>
';
        return $tpl;
    }
    
    function getOptions()
    {
        $tpl = '<option value="<%collation%>"><%collation%>に変換</option>';
        $_ = array();
        foreach ($this->collations as $collation) {
            if ($collation===$this->current_collation) {
                continue;
            }
            $_[] = parseText($tpl, array('collation'=>$collation));
        }
        return join("\n", $_);
    }
}
