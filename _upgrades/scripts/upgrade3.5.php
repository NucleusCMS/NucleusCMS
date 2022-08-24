<?php

function upgrade_do350()
{
    if (upgrade_checkinstall(350)) {
        return _UPG_TEXT_ALREADY_INSTALLED;
    }

    upgrade_do350_dropfield_bsendping();
    upgrade_do350_modfield_mname();
    upgrade_do350_check_np_ping();

    // 3.4 -> 3.5
    // update database version
    update_version('350');
}

function upgrade_do350_modfield_mname()
{
    // changing the member table to lengthen display name (mname)
    $query = parseQuery("ALTER TABLE `[@prefix@]member` MODIFY `mname` varchar(32) NOT NULL default ''");
    upgrade_query('Altering [@prefix@]member table', $query);
}

function upgrade_do350_dropfield_bsendping()
{
    // changing the blog table to remove bsendping flag
    if (!upgrade_checkIfColumnExists('blog', 'bsendping')) {
        return;
    }

    $query = parseQuery("ALTER TABLE `[@prefix@]blog` DROP `bsendping`");
    upgrade_query('Altering [@prefix@]blog table', $query);
}

function upgrade_do350_check_np_ping()
{
    // Remind user to re-install NP_Ping
    $query = parseQuery("SELECT COUNT(*) as count FROM `[@prefix@]plugin` WHERE pfile='NP_Ping'");
    $rs    = sql_query($query);
    $row   = sql_fetch_assoc($rs);
    if ($row['count']) {
        echo '<p>' . _UPG_TEXT_V035_WARN_PING . '</p>';
    }
}
