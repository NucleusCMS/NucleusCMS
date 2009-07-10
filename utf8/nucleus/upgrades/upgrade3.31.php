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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 * $NucleusJP: upgrade3.31.php,v 1.1.2.4 2008/02/04 07:05:36 kimitake Exp $
 *
 */

function upgrade_do331() {

    if (upgrade_checkinstall(331))
        return 'already installed';

    if (!upgrade_checkIfColumnExists('item','iposted')) {
        $query = "  ALTER TABLE `" . sql_table('item') . "`
                                ADD `iposted` TINYINT(2) DEFAULT 1 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('item') . ' table', $query);
    }

    if (!upgrade_checkIfColumnExists('blog','bfuturepost')) {
        $query = "  ALTER TABLE `" . sql_table('blog') . "`
                                ADD `bfuturepost` TINYINT(2) DEFAULT 0 NOT NULL ;";

        upgrade_query('Altering ' . sql_table('blog') . ' table', $query);
    }

    // 3.3 -> 3.31
    // update database version
    update_version('331');

    // check to see if user turn on Weblogs.com ping, if so, suggest to install the plugin
    $query = "SELECT bsendping FROM " . sql_table('blog') . " WHERE bsendping='1'"; 
    $res = mysql_query($query);
    if (mysql_num_rows($res) > 0) {
        echo "<li>メモ: weblogs.com ping 機能が向上しプラグイン化されました。この機能を有効化するには、プラグインの管理メニューを開き、NP_Ping プラグインをインストールしてください。また NP_Ping は NP_PingPong を置き換えるものです。もしすでに NP_PingPong をインストール済みであれば削除してください。</li>";
    }
}

?>
