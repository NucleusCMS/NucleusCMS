<?php

/*

Admin area for NP_SecurityEnforcer

*/

if ( ! isset($member)) {
    $p = explode(DIRECTORY_SEPARATOR, __DIR__);
    while ($p && array_pop($p) && ! empty($p)) {
        $strRel = implode(DIRECTORY_SEPARATOR, $p) . DIRECTORY_SEPARATOR;
        if (@is_file($strRel . 'config.php')) {
            break;
        }
    }
    // if your 'plugin' directory is not in the default location,
    // edit this variable to point to your site directory
    // (where config.php is)
    //  $strRel = '../../../';
    if (@ ! is_file($strRel . 'config.php')) {
        exit('Error: config file not found.');
    }
    require($strRel . 'config.php');
}

if ( ! isset($member) || ! $member->isAdmin()) {
    doError('Insufficient Permissions.');
}

if ( ! $member->isLoggedIn()) {
    doError('You\'re not logged in.');
}

include_libs('PLUGINADMIN.php');

// some functions

function SE_unlockLogin($login)
{
    $sql = sprintf('DELETE FROM `%s` WHERE login=?', sql_table('plug_securityenforcer'));
    sql_prepare_execute($sql, [$login]);
}

// checks

// create the admin area page
$oPluginAdmin = new PluginAdmin('SecurityEnforcer');
// add styles to the <HEAD>
$oPluginAdmin->start('');

$message = '';
// if form to unlock is posted
if ('unlock' == postVar('plaction')) {
    if ( ! $manager->checkTicket()) {
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
$sql    = sprintf("SELECT * FROM `%s` WHERE fails >= ? ", sql_table("plug_securityenforcer"));
$result = sql_prepare_execute($sql, [$plug->max_failed_login]);
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
if (0 == $nums) {
    echo '<tr><td colspan="2"><strong>'._SECURITYENFORCER_ADMIN_NONE_LOCKED.'</strong></td></tr>';
}
echo '<tr><td colspan="2" class="submit"><input type="submit" value="'._SECURITYENFORCER_UNLOCK.'" /></td></tr>';
echo '</table>';
echo '</form>';

$oPluginAdmin->end();
