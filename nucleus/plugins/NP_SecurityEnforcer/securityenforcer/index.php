<?php

/*

Admin area for NP_SecurityEnforcer

*/

// if your 'plugin' directory is not in the default location,
// edit this variable to point to your site directory
// (where config.php is)
$strRel = '../../../';

if (!is_file($strRel . 'config.php')
         && is_file($strRel.'../config.php')) {
    $strRel .= '../';
}

if (!isset($member)) {
    include($strRel . 'config.php');
}

if (!isset($member) || !$member->isAdmin()) {
    doError('Insufficient Permissions.');
}

include_libs('PLUGINADMIN.php');

// some functions

function SE_unlockLogin($login)
{
    sql_query("DELETE FROM ".sql_table('plug_securityenforcer')." WHERE login=".sql_quote_string($login));
}

// checks

// create the admin area page
$oPluginAdmin = new PluginAdmin('SecurityEnforcer');
// add styles to the <HEAD>
$oPluginAdmin->start('');

$message = '';
// if form to unlock is posted
if (postVar('plaction') == 'unlock') {
    if (!$manager->checkTicket()) {
        doError('Invalid Ticket');
    }
    $logins = postVar('unlock');
    if (is_array($logins)) {
        foreach ($logins as $entity) {
            SE_unlockLogin($entity);
            $message .= '<br />' . $entity . _SECURITYENFORCER_ADMIN_UNLOCKED;
        }
    }
}
$plug = & $oPluginAdmin->plugin;

// page title
echo '<h2>'._SECURITYENFORCER_ADMIN_TITLE.'</h2>';

// error output
if ($message) {
    echo "<p><strong>";
    echo $message;
    echo "</strong></p>";
}

// generate table from all entries in the database
echo '<h3>'._SECURITYENFORCER_LOCKED_ENTITIES.'</h3>';
echo '<form action="' . $oPluginAdmin->plugin->getAdminURL() . '" method="POST">';
echo '<input type="hidden" name="plaction" value="unlock" />';
$manager->addTicketHidden();
echo '<table>';
echo '<tr><th>'._SECURITYENFORCER_ENTITY.'</th><th>'._SECURITYENFORCER_UNLOCK.'?</th></tr>';
echo '<tr><td colspan="2" class="submit"><input type="submit" value="'._SECURITYENFORCER_UNLOCK.'" /></td></tr>';
// do query to get all entries, loop
$result = sql_query("SELECT * FROM ".sql_table("plug_securityenforcer")." WHERE fails >= ".$plug->max_failed_login);
$nums   = 0;
if ($result) {
    while ($row = sql_fetch_assoc($result)) {
        $nums++;
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['login'], ENT_QUOTES, _CHARSET).'</td>';
        echo '<td><input type="checkbox" name="unlock[]" value="'.htmlspecialchars($row['login'], ENT_QUOTES, _CHARSET).'" />'._SECURITYENFORCER_UNLOCK.'</td>';
        echo '</tr>';
    }
}
if ($nums == 0) {
    echo '<tr><td colspan="2"><strong>'._SECURITYENFORCER_ADMIN_NONE_LOCKED.'</strong></td></tr>';
}
echo '<tr><td colspan="2" class="submit"><input type="submit" value="'._SECURITYENFORCER_UNLOCK.'" /></td></tr>';
echo '</table>';
echo '</form>';

$oPluginAdmin->end();
