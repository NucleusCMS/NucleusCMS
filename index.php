<?php

// This file will generate and return the main page of the site
$CONF = array();
$CONF['Self'] = 'index.php';

if (!@is_file('./config.php')) {
    if (@is_file('./install/index.php') && !headers_sent()) {
        header('Location: ./install/');
        exit;
    }
    $f = dirname(__FILE__).'/nucleus/libs/config-error.php';
    if (@is_file($f)) {
        @include($f);
    }
    header('Content-type: text/html; charset=utf-8');
    echo '<h1>Configuration error</h1>';
    echo '<p>please run the <a href="./install/index.php">install script</a> or modify config.php</p>';
    exit;
}

include('./config.php');

selector();
