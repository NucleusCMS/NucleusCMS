<?php

/*
 * convert tool for sqlite
 *
 * Copyright (C) 2011-2016 piyoyo
 */

class TableConvertor
{
    public $base_table_list;
    protected $error_logs;
    public $logs_count = 0;

    function __construct()
    {
        $this->error_logs = array();

        $this->base_table_list = array(
            sql_table('actionlog'),
            sql_table('ban'),
            sql_table('blog'),
            sql_table('comment'),
            sql_table('config'),
            sql_table('item'),
            sql_table('karma'),
            sql_table('member'),
            sql_table('skin'),
            sql_table('skin_desc'),
            sql_table('team'),
            sql_table('template'),
            sql_table('template_desc'),
            sql_table('plugin'),
            sql_table('plugin_event'),
            sql_table('plugin_option'),
            sql_table('plugin_option_desc'),
            sql_table('category'),
            sql_table('activation'),
            sql_table('tickets'),
        );
    }

//   function __destruct() { }

    public function clean_logs()
    {
        $this->error_logs = array();
    }

    public function get_logs()
    {
        return $this->error_logs;
    }

    public function logs_count()
    {
        return count($this->error_logs);
    }

    public function commentline($text)
    {
        return '#' . $text;
    }

    public function get_table_structure($tablename)
    {
        $tablename = (string) $tablename;
        if (strlen($tablename) <= 0) {
            return '';
        }
        // add command to drop table on restore
        $s = sprintf("DROP TABLE IF EXISTS `%s`;\n", $tablename);
        ob_start();
        $result = sql_query(sprintf("SHOW CREATE TABLE `%s`", $tablename));
        $msg = ob_get_contents();
        ob_end_clean();
        if (($result) && ($create = sql_fetch_assoc($result))) {
            $s .= $create['Create Table'] . ";\n";
            return $s;
        } else {
            $this->error_logs[] = $msg;
            return '';
        }
    }

    public function dump_table_structure($tablename)
    {
        echo "\n" . $this->commentline("\n");
        echo $this->commentline(" Table: $tablename") . "\n";
        echo $this->commentline("\n") . "\n";
        echo $this->get_table_structure($tablename);
    }

    public function dump_table_data($tablename, $callback_function_real_escape_string = null)
    {
        ob_start();
        $sql = sprintf("SELECT COUNT(*) FROM `%s` limit 1", $tablename);
        $ct = intval(sql_result(sql_query($sql), 0, 0));
        $result = sql_query(sprintf("SELECT * FROM `%s`", $tablename));
        ob_end_clean();

        if (!$result || ($ct == 0)) {
            return false;
        }

        $row = @sql_fetch_array($result);
        if (!$row) {
            return false;
        }

        echo "\n" . $this->commentline("\n");
        echo $this->commentline(" Table Data for $tablename");
        echo $this->commentline("\n") . "\n";

        $num_fields = sql_num_fields($result);
        $fields = array();
        for ($j = 0; $j < $num_fields; $j++) {
            $fields[] = sql_field_name($result, $j);
        }

        while ($row) {
            printf('INSERT INTO `%s` (%s) VALUES(', $tablename, '`' . implode('`, `', $fields) . '`');

            // Loop through the rows and fill in data for each column
            for ($j = 0; $j < $num_fields; $j++) {
                if (!isset($row[$j])) {
                    // no data for column
                    echo ' NULL';
                } elseif ($row[$j] != '') {
                    // data
                    if ((!isset($callback_function_real_escape_string)) || (!$callback_function_real_escape_string)) {
                        echo " '" . sql_real_escape_string($row[$j]) . "'";
                    } else {
                        echo " '" . call_user_func($callback_function_real_escape_string, $row[$j]) . "'";
                    }
                    // todo: other database change function
                } else {
                    // empty column (!= no data!)
                    echo "''";
                }

                // only add comma when not last column
                if ($j != ($num_fields - 1)) {
                    echo ",";
                }
            }

            echo ");\n";
            $row = sql_fetch_array($result);
        }
        echo "\n";
    }
}


class TableConvertor_mysql_to_sqlite extends TableConvertor
{
    function __construct()
    {
        parent::__construct();
    }

//   function __destruct() { }

    public function commentline($text)
    {
        return '--' . $text;
    }

    public function dump_table_data($tablename, $callback_function_real_escape_string = null)
    {
        if (!is_null($callback_function_real_escape_string)) {
            $callback = $callback_function_real_escape_string;
        } elseif (class_exists("SQLite3")) {
            $callback = array("SQLite3", "escapeString");
        } else {
            $callback = "sqlite_escape_string";
        }
        parent::dump_table_data($tablename, $callback);
    }

    public function get_table_structure($tablename)
    {
        $structure = parent::get_table_structure($tablename);
//      var_dump($tablename , $structure);
        if (!$structure) {
            return $structure;
        }

        $pattern = '/(CREATE.+)$/ims';
        $this->current_table = $tablename;
        $structure = preg_replace_callback($pattern, array($this, "callback_replace_sql_create"), $structure);
        return $structure;
    }

    private function callback_replace_sql_create($match)
    {
        // todo: split

        $s = $match[0];

        $index_key = array();
        $unique_key = array();
        $fulltext_key = array();

        // adjust line breaks
        $pattern = '/(\r\n|\n\r|[\r\n])/ims';
        $s = preg_replace($pattern, "\n", $s);

        // move ,
        $s = str_replace(",\n", "\n,", $s);

        // remove empty line
        $s = str_replace("\n\n", "\n", $s);

        // remove PRIMARY KEY : plugin_option.oid
        if (preg_match('/`[^\`]+plugin_option`/ims', $s)) {
            //              1                         2             3
            $pattern = '/,?(\s+)PRIMARY\s+KEY\s*\(\s*(`oid`)\s*\)(\s*,?\s*)/ims';
            if (preg_match($pattern, $s, $m)) {
                $index_key[] = $m[2];
                $rep = "";
//               $rep = $1 KEY $2 ($2)$3';
                $s = preg_replace($pattern, $rep, $s);
            }
            // `oid` int(11) NOT NULL AUTO_INCREMENT,
            $pattern = '/(\s+`oid`.+?)AUTO_INCREMENT(\s*,?\s*)/ims';
            if (preg_match($pattern, $s, $m)) {
                $rep = $m[1] . $m[2];
                $s = preg_replace($pattern, $rep, $s);
            }
//          var_dump($pattern , $s); exit;
        }

        // todo: KEY | UNIQUE
        // remove (length) : nucleus_plugin_tb_lookup
        // PRIMARY KEY (`column name`(length)),
        // PRIMARY KEY | | UNIQUE [INDEX|KEY] | INDEX | KEY
        $sub_pattern1 = '(PRIMARY\s+KEY'
                . '|UNIQUE\s+KEY|UNIQUE\s+INDEX|UNIQUE'
                . '|KEY|INDEX'
                . ')';
        // `column name`[(length)][, ..]
        $sub_pattern2 = '(`[^`]+`\s*\(\s*\d+\s*\)\s*,?\s*|`[^`]+\s*,\s*)+';
        $pattern = '/,\s+' . $sub_pattern1 . '\s*\(' . $sub_pattern2 . '\)\s*(,?)\s*$/ims';
        if (preg_match($pattern, $s, $m)) {
            $rep = 'preg_replace(\'/\(\s*\d+\s*\)/ims\', \'\', "\\0");';
            $s = preg_replace($pattern . 'e', $rep, $s);
//      var_dump($pattern, $m, $s); exit;
        }

        // INT ... AUTO_INCREMENT
        $pattern = '/(`[^`]+`)\s+(INT[^\s\n\r]*)( [^\n\r]+ )AUTO_INCREMENT/ims';
        if (preg_match($pattern, $s, $m)) {
//      var_dump($m);
            $AUTO_INCREMENT = $m[1];
            $rep = $m[1] . ' INTEGER PRIMARY KEY AUTOINCREMENT ' . trim($m[3]);
            $s = preg_replace($pattern, $rep, $s, 1);
        }

        if (isset($AUTO_INCREMENT)) {
            // PRIMARY KEY (`column name`),
            $pattern = '/,\s+PRIMARY\s+KEY\s*\(\s*(' . preg_quote($AUTO_INCREMENT, "/") . ')\s*\)\s*(,?)\s*$/ims';
//          var_dump($pattern , $s);
            if (preg_match($pattern, $s, $m)) {
//          var_dump($pattern);
                $rep = '$2'; // /* $0 */
                $s = preg_replace($pattern, $rep, $s);
            } else { // multiple PRIMARY
                $pattern = '/([\s]+)PRIMARY\s+KEY \(([^\(\)]+)\)\s*(,?)\s*$/ims';
//          var_dump($pattern);
                if (preg_match($pattern, $s, $m)) {
                    $rep = '$1 UNIQUE ($2)$3'; //$m[1].' UNIQUE ('.$m[2].')'.$m[3];
                    $s = preg_replace($pattern, $rep, $s);
                }
            }
            unset($AUTO_INCREMENT);
        }

        // Add COLLATE NOCASE
//      if (!preg_match('/nucleus_tickets$/ims', $this->current_table))
//      {
        //              1                                  2    3
        $pattern = '/(,?\s+\s+`[^\`]+`\s*varchar\(\s*\d+\s*\)\s.+?\s*)(,?)(\s*)$/ims';
        if (preg_match($pattern, $s, $m)) {
            $rep = '$1 COLLATE NOCASE $2$3';
            $s = preg_replace($pattern, $rep, $s);
            $s = preg_replace("/\n COLLATE NOCASE \n/ims", " COLLATE NOCASE\n ", $s);
        }
//          var_dump($pattern,$s); exit;
//      }


        $pattern = '/,,\s*$/ims';
        $s = preg_replace($pattern, ",", $s);

        // UNIQUE KEY `index_name` (`col`[,..])
        //              1                            2                  3
        $pattern = '/( UNIQUE)\s+KEY\s+`[^\`]+`\s*\(\s*(`[^\(\)]+?`)\s*\)\s*(,?)\s*$/ims';
//      if (preg_match('/UNIQUE KEY/ims' , $s, $m))
//      {
        if (preg_match($pattern, $s, $m)) {
            $rep = '$1($2)$3'; // $m[1].' ('.$m[2].')'.trim($m[3]);
            $s = preg_replace($pattern, $rep, $s);
        }
//          var_dump($pattern,$s); exit;
//      }
        // KEY | INDEX `index_name` (`col`[,..])
        //              1                            2                  3
        $pattern = '/^\s*,?\s+(KEY|INDEX)\s+`[^\`]+`\s*\(\s*(`[^\(\)]+?`)\s*\)\s*(,?)\s*$/ims';
        if (preg_match_all($pattern, $s, $m, PREG_SET_ORDER)) {
            foreach ($m as $a) {
                $index_key[] = $a[2];
            }
            $rep = '/* $0 */';
            $s = preg_replace($pattern, $rep, $s);
//          var_dump($pattern,$s); exit;
        }

        if (preg_match('/nucleus_comment$/ims', $this->current_table) && (!in_array('`cblog`', $index_key))) {
            $index_key[] = '`cblog`';
        }
        if (preg_match('/nucleus_item$/ims', $this->current_table)) {
            foreach (array('`iblog`', '`idraft`', '`icat`') as $k) {
                if (!in_array($k, $index_key)) {
                    $index_key[] = $k;
                }
            }
        }

        // FULLTEXT KEY `index_name` (`col`[,..])
        //              1                            2                  3
        $pattern = '/^,?\s+(FULLTEXT)\s+KEY\s+`[^\`]+`\s*\(\s*(`[^\(\)]+?`)\s*\)\s*(,?)\s*$/ims';
        if (preg_match_all($pattern, $s, $m, PREG_SET_ORDER)) {
            foreach ($m as $a) {
                $fulltext_key[] = $a[2];
            }
            $rep = '/* $0 */';
            $s = preg_replace($pattern, $rep, $s);
//          var_dump($pattern,$s,$match[0]); exit;
        }

        $s = str_replace("\n\n", "\n", $s);
//      $s = str_replace("\n," , ",\n", $s);

        $pattern = '/[^\(\)]+;$/ims';
        $s = preg_replace($pattern, ";", $s);

        if ((count($index_key) == 0) && (count($fulltext_key) == 0)
        ) {
            return $s;
        }

//      if (preg_match('/CREATE\s+TABLE\s*[^\`]*`([^\`]+?)`/ims', $s, $m))
//          $tablename = $m[1];
        if (!isset($tablename) || !$tablename) {
            $tablename = $this->current_table;
        }

        // CREATE INDEX
        $i = 0;
        foreach ($index_key as $item) {
            if (substr_count($item, '`') > 2) {
                $i++;
                $name = $tablename . '_auto_idx_' . sprintf('%d', $i);
            } else {
                $name = $tablename . '_idx_' . str_replace('`', '', $item);
            }
            $s .= "\n"
                    . sprintf(
                        "CREATE INDEX IF NOT EXISTS `%s` ON `%s` (%s);\n",
                        $name,
                        $tablename,
                        $item
                    );
        }

        /* DROP TABLE IF EXISTS nucleus_item_fts; */
        /*
         * if make a trigger , it's unnecessary
          INSERT INTO nucleus_item_fts(docid, ifts_body, ifts_title, ifts_more)
          SELECT inumber , ibody, ititle, imore FROM nucleus_item order by inumber ASC;
         */


        // CREATE VIRTUAL TABLE
        $i = 0;
        foreach ($fulltext_key as $item) {
            $vt_tablename = $tablename . '_fts';
            $key_names = explode(',', $item);
            foreach ($key_names as $n => $v) {
                $key_names[$n] = preg_replace('/[`\s]/ims', '', $v);
            }
            $s .= "\n"
                    . "DROP TABLE IF EXISTS `$vt_tablename`;\n"
                    . sprintf(
                        "CREATE VIRTUAL TABLE `%s` USING fts4(%s);\n\n",
                        $vt_tablename,
                        '`ifts_' . implode('`,`ifts_', $key_names) . '`'
                    );

            $s .= $this->get_sql_create_trigger($tablename, $vt_tablename, $key_names);
        }

//      var_dump($s); exit;
        return $s;
    }

    // todo
    public function get_sql_create_trigger($table, $vt_table, $key_names)
    {
        if (preg_match('/nucleus_item$/ims', $table)) {
            $num = 'inumber';
        } elseif (preg_match('/nucleus_comment$/ims', $table)) {
            $num = 'cnumber';
        } else {
            return '/* unkown FULLTEXT TYPE :' . $table . ' */';
        }

        $s = '';
        $s .= 'CREATE TRIGGER ' . $table . '_trig_insert' . "\n"
                . 'AFTER INSERT ON ' . $table . ' FOR EACH ROW' . "\n"
                . "BEGIN\n  "
                . sprintf(
                    "INSERT INTO %s(docid, %s)",
                    $vt_table,
                    'ifts_' . implode(',ifts_', $key_names) . ''
                )
                . sprintf(
                    " VALUES(NEW.%s , %s);\n",
                    $num,
                    'NEW.' . implode(' , NEW.', $key_names) . ''
                )
                . "END;\n\n";

        $s .= 'CREATE TRIGGER ' . $table . '_trig_delete' . "\n"
                . 'AFTER DELETE ON ' . $table . ' FOR EACH ROW' . "\n"
                . "BEGIN\n  "
                . sprintf("DELETE FROM %s WHERE docid = OLD.%s;\n", $vt_table, $num)
                . "END;\n\n";

        $sets = array();
        foreach ($key_names as $k) {
            $sets[] = sprintf("ifts_%s = NEW.%s", $k, $k);
        }
        $s .= 'CREATE TRIGGER ' . $table . '_trig_update' . "\n"
                . 'AFTER UPDATE ON ' . $table . ' FOR EACH ROW' . "\n"
                . "BEGIN\n  "
                . sprintf(
                    "UPDATE %s SET %s WHERE docid = NEW.%s;\n",
                    $vt_table,
                    implode(',', $sets),
                    $num
                )
                . "END;\n\n";
        return $s;
    }

    /*
      public function dump_table_structure($tablename)
      {
      parent::dump_table_structure($tablename);
      }
     */
} // TableConvertor_mysql_to_sqlite
