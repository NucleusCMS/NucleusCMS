<?php
    $filename = __DIR__ . '/japanese-utf8.php';
    $contents = file_get_contents($filename);

    if (function_exists('mb_convert_encoding'))
    {
        $contents = mb_convert_encoding($contents, 'eucJP-win', 'UTF-8');
        $contents = str_replace("'UTF-8'", "'EUC-JP'", $contents);
        eval('?>' . $contents);
    }
    else
    {
        // error : can not convert
        //         force utf-8
        include_once($filename);
    }
