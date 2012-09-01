<?php
require(dirname(__FILE__).'/../../../config.php');

include_libs('PLUGINADMIN.php');

// create a object of the plugin via Plugin Admin
$oPluginAdmin = new PluginAdmin('Ping');
ActionLog::add(INFO, 'NP_Ping: Sending ping (from background)');

$blogid = intval($argv[1]);
if ( $blogid > 0 )
{
	$oPluginAdmin->plugin->sendPings($blogid);
}
else
{
	ActionLog::add(WARNING, 'NP_Ping: invalid blogid, background ping abort');
}
