<?php
include($argv[1] . '../config.php');

include($DIR_LIBS . 'PLUGINADMIN.php');

// create a object of the plugin via Plugin Admin
$oPluginAdmin = new PluginAdmin('Ping');
ACTIONLOG::add(INFO, 'NP_Ping: Sending ping');
$oPluginAdmin->plugin->sendPings($argv[2]);
?>
