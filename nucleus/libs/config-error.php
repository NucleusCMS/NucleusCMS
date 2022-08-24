<?php

if (! headers_sent()) {
    header('Content-type: text/html; charset=utf-8');
}

$http_accept_language_list = explode(
    ',',
    @strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'])
);
if (in_array('ja', $http_accept_language_list)) { // japanese
    echo '<h3>設定がおかしいです。</h3><a href="./install/index.php">インストール用スクリプト</a>を起動するか、config.phpの設定値を変更して下さい。';
} else {
    echo '<h1>Configuration error</h1>';
    echo '<p>please run the <a href="./install/index.php">install script</a> or modify config.php</p>';
}

exit;
