<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Nucleus RSS syndication channel skin
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

header('Pragma: no-cache');

$CONF = array();

include('./config.php');

if (isset($CONF['DisableRSS']) && $CONF['DisableRSS']) {
    header("HTTP/1.0 404 Not Found");
    echo "<html><head><title>404 Not Found</title></head><h1>404 Not Found</h1><body></body></html>";
    exit;
}

if (!$CONF['DisableSite']) {
    // get feed into $feed
    ob_start();
    selectSkin('feeds/rss20');
    selector();
    $feed = ob_get_contents();
    ob_end_clean();

    // create ETAG (hash of feed)
    // (HTTP_IF_NONE_MATCH has quotes around it)
    $eTag = '"' . md5($feed) . '"';
    header('Etag: ' . $eTag);

    // compare Etag to what we got
    if ($eTag == serverVar('HTTP_IF_NONE_MATCH')) {
        header('HTTP/1.0 304 Not Modified');
        header('Content-Length: 0');
    } else {
        if (strtolower(_CHARSET) != 'utf-8') {
            $feed = mb_convert_encoding($feed, "UTF-8", _CHARSET);
        }
        header("Content-Type: application/xml");
        // dump feed
        echo $feed;
    }
} else {
    // output empty RSS file...
    // (because site is disabled)

    echo '<' . '?xml version="1.0" encoding="' . _CHARSET . '"?' . '>';

    ?>
    <rss version="2.0">
        <channel>
            <title><?php echo hsc($CONF['SiteName']); ?></title>
            <link><?php echo hsc($CONF['IndexURL']); ?></link>
            <description></description>
            <docs>http://backend.userland.com/rss</docs>
        </channel>
    </rss>
    <?php
}

?>
