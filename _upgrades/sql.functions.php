<?php
if (!function_exists('sql_existTableColumnName')) {
    function sql_existTableColumnName($tablename, $ColumnName, $casesensitive = false)
    {
        $names = sql_getTableColumnNames(parseQuery($tablename));

        if (!$names) {
            return false;
        }
        if ($casesensitive) {
            return in_array($ColumnName, $names);
        } else {
            foreach ($names as $v) {
                if (strcasecmp($ColumnName, $v) == 0) {
                     return true;
                }
            }
        }
        return false;
    }
}

if (!function_exists('sql_getTableColumnNames')) {
    function sql_getTableColumnNames($tablename)
    {
        $sql = sprintf('SHOW COLUMNS FROM `%s` ', parseQuery($tablename));
        $target = 'Field';

        $items = array();
        $res = sql_query($sql);
        if (!$res) {
            return array();
        }
        while ($row = sql_fetch_array($res)) {
            if (isset($row[$target])) {
                $items[] = $row[$target];
            }
        }

        if (count($items)>0) {
            sort($items);
        }
        return $items;
    }
}

if (!function_exists('sql_query')) {
    function sql_query($query, $link_identifier = null)
    {
        return mysql_query($query, $link_identifier);
    }
}

if (!function_exists('sql_real_escape_string')) {
    function sql_real_escape_string($val, $link_identifier = null)
    {
        if (empty($link_identifier)) {
            return mysql_real_escape_string($val);
        }
        return mysql_real_escape_string($val, $link_identifier);
    }
}

if (!function_exists('sql_fetch_array')) {
    function sql_fetch_array($result, $result_type = MYSQL_BOTH)
    {
        return mysql_fetch_array($result, $result_type);
    }
}

if (!function_exists('sql_fetch_assoc')) {
    function sql_fetch_assoc($result)
    {
        return mysql_fetch_assoc($result);
    }
}

if (!function_exists('sql_fetch_object')) {
    function sql_fetch_object($result)
    {
        return mysql_fetch_object($result);
    }
}

if (!function_exists('sql_num_rows')) {
    function sql_num_rows($result)
    {
        return mysql_num_rows($result);
    }
}

if (!function_exists('sql_error')) {
    function sql_error($link_identifier = null)
    {
        if (empty($link_identifier)) {
            return mysql_error();
        }
        return mysql_error($link_identifier);
    }
}

if (!function_exists('sql_existTableName')) {
    function sql_existTableName($tablename, $link_identifier = null)
    {
        $query = sprintf("SHOW TABLES LIKE '%s' ", sql_real_escape_string(parseQuery($tablename)));
        $res = sql_query($query, $link_identifier);
        return ($res && ($r = sql_fetch_array($res)) && !empty($r)); // PHP(-5.4) Parse error: empty($var = "")  syntax error
    }
}
