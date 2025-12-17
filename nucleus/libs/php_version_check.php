<?php
/**
 * PHP Version Check
 * 
 * Supported PHP versions: 7.4.0 - 8.3.x
 */

if (version_compare(phpversion(), '7.4.0', '<') || (80400 <= PHP_VERSION_ID)) {
    if ( ! headers_sent()) {
        header("HTTP/1.0 503 Service Unavailable");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 01 Jan 2018 00:00:00 GMT");
    }
    $ver = explode('.', phpversion());
    $ver = sprintf('PHP%d.%d', $ver[0], $ver[1]);
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
        && in_array('ja', preg_split('/[, ]|-[^,]+|;[^,]+/', strtolower((string) $_SERVER['HTTP_ACCEPT_LANGUAGE']), -1, PREG_SPLIT_NO_EMPTY))
    ) {
        exit("<h1>エラー</h1><div>このバージョンは、{$ver}に対応していません。</div>");
    }
    exit("<h1>Error</h1><div>This version does not support {$ver}.</div>");
}
