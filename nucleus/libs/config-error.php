<?php

if (!headers_sent()) {
    header('Content-type: text/html; charset=utf-8');
}

$http_accept_language_list = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ?
        preg_split('/[, ]|-[^,]+|;[^,]+/', strtolower((string) $_SERVER['HTTP_ACCEPT_LANGUAGE']), -1, PREG_SPLIT_NO_EMPTY)
        : []);

global $CONF;
$url = './install/index.php';
if (isset($CONF) && isset($CONF['UsingAdminArea']) && (bool)$CONF['UsingAdminArea']) {
    $url = '.' . $url;
}

if (in_array('ja', $http_accept_language_list)) { // japanese
    printf('<h3>設定がおかしいです。</h3><a href="%s">インストール用スクリプト</a>を起動するか、config.phpの設定値を変更して下さい。', $url);
} else {
    echo '<h1>Configuration error</h1>';
    printf('<p>please run the <a href="%s">install script</a> or modify config.php</p>', $url);
}

exit;
