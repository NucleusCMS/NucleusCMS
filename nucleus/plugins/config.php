<?php

// if you wish change the plugin folder path, you create config-plugin.php.

$config_file = dirname(__FILE__) . '/config-plugin.php';
if (@is_file($config_file) && is_readable($config_file)) {
    // config-plugin.php
    include_once($config_file);
} else {
    // config.php
    $config_file = dirname(__FILE__) . '/../../config.php';
    if (@is_file($config_file) && is_readable($config_file)) {
        include_once($config_file);
    }
}
unset($config_file);
