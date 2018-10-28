<?php

function upgrade_do310() {

    if (upgrade_checkinstall(310))
        return _UPG_TEXT_ALREADY_INSTALLED;

    // 3.0 -> 3.1
    // update database version  
    update_version('310');
}
