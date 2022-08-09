<?php

$http_accept_language = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) : array());

if (!isset($_SERVER['HTTP_USER_AGENT']) || preg_match('/bot|wget|spider|clawler|https?:/i', $_SERVER['HTTP_USER_AGENT'])) {
    header("HTTP/1.0 404 Not Found");
    exit;
}

$lang_lists = array('ja'
//              ,'fr'
        );
foreach ($lang_lists as $lang) {
    $filename = sprintf('%s/%s/index.html', dirname(__FILE__), $lang);
    if (in_array($lang, $http_accept_language) && is_file($filename)) {
        header(sprintf('Location: %s/', $lang));
        exit;
    }
}

$lang = 'en';
$filename = sprintf('%s/%s/index.html', dirname(__FILE__), $lang);
if (in_array($lang, $http_accept_language) && is_file($filename)) {
    header(sprintf('Location: %s/', $lang));
    exit;
}

$filename = sprintf('%s/index.html', dirname(__FILE__));
if (is_file($filename)) {
    echo file_get_contents($filename);
} else {
    header("HTTP/1.0 404 Not Found");
}
