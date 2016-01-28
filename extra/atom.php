<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * Nucleus Atom Syndication
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

header('Pragma: no-cache');

$CONF = array();
$CONF['Self'] = 'atom.php';

include('./config.php');

if (!$CONF['DisableSite']) {
	// get feed into $feed
	ob_start();
		selectSkin('feeds/atom');
		selector();
		$feed = ob_get_contents();
	ob_end_clean();

	// create ETAG (hash of feed)
	// (HTTP_IF_NONE_MATCH has quotes around it)
	$eTag = '"' . md5($feed) . '"';
	header('Etag: ' . $eTag);

	// compare Etag to what we got
	if ($eTag == serverVar('HTTP_IF_NONE_MATCH') ) {
		header('HTTP/1.0 304 Not Modified');
		header('Content-Length: 0');
	} else {
		// dump feed
		echo $feed;
	}

}

?>