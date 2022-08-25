<?php

/*
 * convert tool for sqlite
 *
 * Copyright (C) 2011-2016 piyoyo
 */

$this_dir   = __DIR__;
$parent_dir = dirname(__DIR__);

if (version_compare(PHP_VERSION, '5.1.0', '<')) {
    fwrite(STDERR, "php 5.1.0 or higher needed.\n");
    exit();
}
if (!extension_loaded('pdo') || !extension_loaded('pdo_sqlite')) {
    fwrite(STDERR, "pdo or pdo_sqlite not found.\n");
    exit();
}
if (php_sapi_name() != 'cli') {
    fwrite(STDERR, "run on cli only.\n");
    exit();
}

ob_start();
$config_php = 'config.php';
foreach (array('','../','../../../') as $dir) {
    if (is_file("{$dir}config.php")) {
        $config_php = "{$dir}config.php";
        break;
    }
}
include_once($config_php);
$errors = ob_get_contents();
ob_end_clean();

//global $CONF;
//if ($errors && strlen($errors)>0 && $CONF['debug'])
//    fputs(STDERR, "{$errors}\n");

ini_set('display_errors', '0');
//ini_set('display_errors', 'stderr'); // 0, 1, stderr, stdout

global $DB_DRIVER_NAME;

if ("mysql" != $DB_DRIVER_NAME) {
    echo 'error : $DB_DRIVER_NAME is not mysql.' . "\n";
    exit;
}

//sql_connect();

//global $DIR_LIBS;
include($this_dir . DIRECTORY_SEPARATOR . "table_conv_mysql_to_sqlite.php");

$obj = new TableConvertor_mysql_to_sqlite();

//var_dump ($obj->base_table_list);

$tables = array();
$result = @sql_query(sprintf("SHOW TABLES LIKE '%s'", sql_table("") . "%"));
while ($row = @sql_fetch_array($result)) {
    $tables[] = $row[0];
}

//$tables = $obj->base_table_list;
//define('conv_debug', true);

echo "BEGIN;\n\n";
$error_messages = array();
foreach ($tables as $table) {
    //  echo $table.$obj->get_table_structure($table);
    @$obj->dump_table_structure($table);
    echo "\n";
    @$obj->dump_table_data($table);

    if ($obj->logs_count) {
        echo "\n/*\n";
        echo "\n" . implode("\n", $obj->get_logs) . "\n";
        echo "\n*/\n";
    }
    if (defined('conv_debug')) {
        if (preg_match('/nucleus_plugin_option$/i', $table)) {
            exit; // debug
        }
    }
}
echo "\n\nEND;\n";
