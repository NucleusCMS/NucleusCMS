<?php
    $filename = dirname(__FILE__) . '/french-utf8.php';
    $contents = file_get_contents($filename);

    if (function_exists('mb_convert_encoding'))
    {
        $contents = mb_convert_encoding($contents, 'iso-8859-1', 'UTF-8');
        $contents = str_replace("'UTF-8'", "'iso-8859-1'", $contents);
        eval('?>' . $contents);
    }
    else
    {
        // error : can not convert
        //         force utf-8
        include_once($filename);
    }
