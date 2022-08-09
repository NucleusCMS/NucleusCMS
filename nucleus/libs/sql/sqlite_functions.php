<?php

class sqlite_functions
{

    public static function pdo_register_user_functions($dbh)
    {
        if (empty($dbh) || ! ($dbh instanceof PDO)) {
            trigger_error('handler is not PDO object.', E_USER_WARNING);

            return;
        }
        // standard: SUBSTR , non-standard: SUBSTRING
        // SQLite has no SUBSTRING. but has SUBSTR.
        // SUBSTRING , start index 1 or -1 , param 2 or 3
        $dbh->sqliteCreateFunction(
            'SUBSTRING',
            function () {
                $st = intval(func_get_arg(1));
                if ($st > 0) {
                    $st--;
                }

                return substr(func_get_arg(0), $st, func_get_arg(2));
            },
            3
        );
        $dbh->sqliteCreateFunction('UNIX_TIMESTAMP', 'strtotime', 1);
        $dbh->sqliteCreateFunction('NOW', function () {
            return date("Y-m-d H:i:s", time());
        }, 0); // local time
        // SQL non-standard : REGEXP (mysql , sqlite) , src_exp ~ pattern_text (postgreSQL)
        //                    --- src_exp like pattern_text  ,  %  _
        // src_exp REGEXP pattern_text
        // 'P1' REGEXP 'P2' = P2 P1 ( return func_get_arg(0).' '.func_get_arg(1); )
        $dbh->sqliteCreateFunction(
            'REGEXP',
            function ($pattern, $Text) {
                return preg_match("/(" . str_replace(
                    "/",
                    "\\/",
                    (string)$pattern
                ) . ")/im", (string)$Text) ? 1 : 0;
            },
            2
        );
        $dbh->sqliteCreateFunction('CONCAT', function () {
            return implode("", func_get_args());
        }, -1);
        $dbh->sqliteCreateFunction('FIND_IN_SET', function ($k, $v) {
            return in_array($k, explode($v)) ? 1 : 0;
        }, 2);
        $dbh->sqliteCreateFunction('md5', 'md5', 1);
    }
}
