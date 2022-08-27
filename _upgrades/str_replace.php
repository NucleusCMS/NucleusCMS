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
    public $current_collation;
    public $current_charset;
    public $new_collation;
    public $new_charset;
    public $collations;

    public function __construct()
    {
    }

    public function run()
    {
        global $CONF;

        if (strpos($CONF['IndexURL'], 'https://') === 0) {
            exit('すでにhttps化済です。');
        }
        $tpl           = $this->getTemplate();
        $ph['content'] = $this->getContent();
        header('Content-Type: text/html; charset=UTF-8');
        echo parseText($tpl, $ph);
        exit;
    }

    public function getContent()
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
                $tpl                     = $this->getMainContent();
                $ph['current_collation'] = $this->current_collation;
                $ph['options']           = $this->getOptions($this->current_collation);
                return parseText($tpl, $ph);
        }
    }

    public function convert($new_collation)
    {
        @set_time_limit(0);

        $rs = sql_query("SHOW TABLES LIKE '{$currentPrefix}%'");
        if (!$rs) {
            exit('Nucleusのtableがありません。何もせずに終了します。');
        }

        $srcTableNames = [];
        while ($row = sql_fetch_array($rs)) {
            $srcTableNames[] = $row[0];
        }

        // todo: undefined $vs $output
        foreach ($srcTableNames as $srcTableName) {
            $sql = vsprintf("ALTER TABLE `%s` CONVERT TO CHARACTER SET %s COLLATE %s", $vs);
            sql_query(parseQuery($sql));
        }
        return implode("\n", $output) . '<p>変換を完了しました。 <a href="convert.php">戻る</a></p>';
        //sleep(3);
        //header('Location:convert.php?complete');
    }

        public function getMainContent()
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

        public function getTemplate()
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

        public function getOptions()
        {
            $tpl = '<option value="<%collation%>"><%collation%>に変換</option>';
            $_   = [];
            foreach ($this->collations as $collation) {
                if ($collation === $this->current_collation) {
                    continue;
                }
                $_[] = parseText($tpl, ['collation' => $collation]);
            }
            return implode("\n", $_);
        }
}
