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
 *
 * Some functions common to all upgrade scripts
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

/*************************************************************
 *     NOTE: With upgrade to 3.6, need to set this to use sql_* API           *
 **************************************************************/
function load_upgrade_lang() {
    $lang_path = sprintf('%s/langs/%s.php', __DIR__, upgrade_checkBrowserLang());
    include_once($lang_path);
}

function upgrade_checkBrowserLang() {
    $langs = explode(',', strtolower(serverVar('HTTP_ACCEPT_LANGUAGE')));
    
    if(!$langs) return 'en';
    
    foreach($langs as $lang) {
        $lang = substr($lang,0,2);
        if(is_file(__DIR__.'/langs/'.$lang.'.php')) {
            return $lang;
        }
    }
    
    return 'en';
}

function upgrade_checkinstall($version) {
    $installed = 0;
    global $DB_DRIVER_NAME;

    if ($DB_DRIVER_NAME == 'sqlite' && $version<=380)  return true;

    switch($version) {
        case '300':
            if (!sql_existTableName(sql_table('config'))) //  < 250
                return false;
        default:  // 250 - 380
            $query = sprintf("SELECT * FROM %s WHERE name='DatabaseVersion' and value>=%d LIMIT 1", sql_table('config'), intval($version));
            $minrows = 1;
            break;
    }

    $count = 0;
    $res = sql_query($query);
    while ( $res && sql_fetch_object($res))
        $count++;
    $installed = ($res && ($count >= $minrows));
    return $installed;
}


function upgrade_showLogin($type) {
?>
    <h1><?php echo _UPG_TEXT_PLEASE_LOGIN;  ?></h1>
    <p><?php echo _UPG_TEXT_ENTER_YOUR_DATA;  ?>:</p>

    <form method="post" action="<?php echo $type?>">

        <ul>
            <li><?php echo _UPG_TEXT_NAME; ?>: <input name="login" /></li>
            <li><?php echo _UPG_TEXT_PASSWORD; ?> <input name="password" type="password" /></li>
        </ul>

        <p>
            <input name="action" value="login" type="hidden" />
            <input type="submit" value="<?php echo _UPG_TEXT_LOGIN; ?>" />
        </p>

    </form>
<?php
}

function upgrade_head() {
    if (_CHARSET != 'UTF-8') {
//            ini_set('default_charset', 'UTF-8');
        if ( !headers_sent() )
            header ('Content-Type: text/html; charset=UTF-8');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo _UPG_TEXT_NUCLEUS_UPGRADE; ?></title>
    <link rel="stylesheet" href="../nucleus/styles/manual.css" type="text/css" />
</head>
<body>
    <?php
    }

    function upgrade_foot() {
    ?>
    </body>
</html>
    <?php
    }

function upgrade_error($msg) {

    echo "\n<h1>" . _UPG_TEXT_ERROR_FAILED . "</h1>\n";
    echo "\n<p>" . _UPG_TEXT_ERROR_WAS . ":</p>\n";
    echo sprintf("<blockquote><div>%s</div></blockquote>" , $msg);
    echo sprintf('<p><a href="index.php" onclick="history.back();">%s</a></p>' , _UPG_TEXT_BACK);
}

function upgrade_start() {
    global $upgrade_failures;
    $upgrade_failures = 0;

    echo "<h1>" . _UPG_TEXT_EXECUTING_UPGRADES . "</h1>\n<ul>\n";

    if (intGetVar('db_optimize') > 0)
        upgrade_db_optimize();
}

function upgrade_end($msg = "") {
    global $upgrade_failures;
    $from = intGetVar('from');
    if ($upgrade_failures > 0)
        $msg = _UPG_TEXT_QUERIES_HAVE_FAILED_01;

    echo "</ul>\n";
    echo "<h1>" . _UPG_TEXT_UPGRADE_COMPLETED_TITLE . "</h1>\n";
    echo "<p>" . $msg . "</p>\n";

    echo sprintf("<p>" . _UPG_TEXT_BACK_TO_OVERVIEW . "</p>\n", "index.php" . ($from>0 ? '?from='.$from : ''));
}

/**
  * Tries to execute a query, gives a message when failed
  *
  * @param friendly name
  * @param query
  */
function upgrade_query($friendly, $query) {
    global $upgrade_failures;

    echo sprintf('<li>%s ... ', parseQuery($friendly));
    $res = sql_query(parseQuery($query));
    if ($res) {
        echo '<span style="color:green">' . _UPG_TEXT_SUCCESS . "</span><br />\n";
    } else {
        echo '<span style="color:red">' . _UPG_TEXT_FAILURE . "</span>\n";
        echo sprintf('<blockquote>%s: %s </blockquote>', _UPG_TEXT_REASON_FOR_FAILURE, sql_error());
        $upgrade_failures++;
    }
    echo '</li>';
    return $res;
}

/**
  * Tries to update database version, gives a message when failed
  *
  * @param $version
  *     Schema version the database has been upgraded to
  */
function update_version($version) {
    global $upgrade_failures;
    $message = "Updating DatabaseVersion in config table to $version";
    if(0==$upgrade_failures){
        $query = "UPDATE [@prefix@]config SET value='[@version@]' WHERE name='DatabaseVersion'";
        upgrade_query($message, parseQuery($query, array('version'=>$version)));
    }else
        echo '<li>'.$message.' ... <span class="warning">NOT EXECUTED</span><blockquote>Errors occurred during upgrade process.</blockquote>';
}

/**
 * @param $table
 *        table to check (without prefix)
 * @param $aColumns
 *        array of column names included
 */
function upgrade_checkIfIndexExists($table, $aColumns) {
    // get info for indices from database

    $aIndices = array();
    $res = sql_query( sprintf('show index from %s', sql_table($table)) );
    if ($res)
    while ($o = sql_fetch_object($res)) {
        if (!$aIndices[$o->Key_name]) {
            $aIndices[$o->Key_name] = array();
        }
        $aIndices[$o->Key_name][] = $o->Column_name;
    }

    // compare each index with parameter
    foreach ($aIndices as $keyName => $aIndexColumns) {
        $aDiff = array_diff($aIndexColumns, $aColumns);
        if (count($aDiff) == 0) return 1;
    }

    return 0;

}

/**
  * Checks to see if a given table exists
  *
  * @param $table
  *     Name of table to check for existance of
  *     Uses sql_table internally
  * @return true if table exists, false otherwise.
  */
function upgrade_checkIfTableExists($table){
    $res = sql_query( sprintf("SHOW TABLES LIKE '%s'", sql_table($table)) );
    return ($res != 0) && (sql_num_rows($res) == 1);
}

/**
  * Checks to see if a given configuration value exists
  *
  * @param $name
  *     Config value to check for existance of.
  *     Paramater must be MySQL escaped
  * @return true if configuration value exists, false otherwise.
  */
function upgrade_checkIfCVExists($name){
    $res = sql_query( sprintf("SELECT name from %s WHERE name='%s'", sql_table('config'), $name) );
    return ($res != 0) && (sql_num_rows($res) == 1);
}

/**
  * Checks to see if a given column exists
  *
  * @param $table
  *     Name of table to check for column in
  *     Uses sql_table internally
  * @param $col
  *     Name of column to check for existance of
  * @return true if column exists, false otherwise.
  */
function upgrade_checkIfColumnExists($table, $col){
    $res = sql_query( sprintf('DESC `%s` `%s`', sql_table($table), $col) );
    return ($res != 0) && (sql_num_rows($res) == 1);
}

function upgrade_db_optimize()
{
    global $DB_DRIVER_NAME;
    if ($DB_DRIVER_NAME == 'mysql')
        upgrade_db_optimize_mysql();
}

function upgrade_db_optimize_mysql()
{
    global $DB_DRIVER_NAME;
    if ($DB_DRIVER_NAME != 'mysql')
        return;

    $tables = array();
    $res = sql_query(sprintf("SHOW TABLE STATUS LIKE '%s%%'", sql_table('')));
    while ($res && ($row = sql_fetch_assoc($res)) && !empty($row))
        $tables[] = $row['Name'];

    if (count($tables)>0)
    {
        foreach(array('REPAIR', 'OPTIMIZE') as $cmd) {
            $sql = $cmd . " TABLE `" . join("`, `", $tables) . "`";
            $res = upgrade_query($cmd . ' TABLE', $sql);
            while($res && ($row = sql_fetch_assoc($res)))
            {  }
            if ($res)
                sql_free_result($res);
        }
    }
}

function upgrade_remove_RefNew($filename)
{
    if (!is_file($filename)
       || !($src = file_get_contents($filename)))
        return ;
    $pattern = '/(\s*=\s*)&(\s*new\s)/ms';
    if (preg_match($pattern, $src))
    {
        $src_new = preg_replace($pattern, '\\1\\2', $src);
        $len = strlen($src_new);
        if (($len > 0) && ($len != strlen($src)))
        {
            file_put_contents($filename, $src_new);
        }
    }
}

function upgrade_check_action_php()
{
    static $checked = false;
    if ($checked)
        return;
    global $DIR_NUCLEUS;
    $checked = true;
    upgrade_remove_RefNew($DIR_NUCLEUS . '../action.php');
}

function upgrade_find_file($dir, $file_regex_pattern, $subdir_search=true, $limit=3)
{
    if ((int) $limit <= 0)
        return array();
    if (strlen($dir)>0 && substr($dir,-1,1)!='/')
        $dir .= '/';
    $limit--;
    $list = array();
    if (is_dir($dir))
    {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false)
            if (!in_array($file, array('.','..')))
            {
                if (is_dir($dir . $file))
                {
                    $child = upgrade_find_file($dir . $file, $file_regex_pattern, $subdir_search, $limit);
                    if (empty($child))
                        continue;
                    $list = array_merge($list, $child);
                }
                else if(@preg_match($file_regex_pattern, $file))
                    $list[] = $dir . $file;
            }
            closedir($dh);
        }
    }
    return $list;

}

function upgrade_check_plugin_syntax()
{
    global $DIR_PLUGINS;
    if (!is_dir($DIR_PLUGINS))
        return;
    $php = 'php';
    if (defined('UPGRADE_PHP_BIN_FOR_CHECK_SYNTAX')
        && constant('UPGRADE_PHP_BIN_FOR_CHECK_SYNTAX'))
    {
       $php = UPGRADE_PHP_BIN_FOR_CHECK_SYNTAX;
    }
    exec("{$php} --version", $output, $retval);
    if (($retval !== 0) || empty($output) || !preg_match('@^(PHP\s+[\d\.]+)@i', $output[0], $ver))
        return;
    $ver = $ver[1];
    $files = upgrade_find_file($DIR_PLUGINS, '/\.php$/i');
    sort($files);
//    var_dump($output, $retval, $files);
    $errors = array();
    foreach($files as $file)
    {
        $output = '';
        $arg = escapeshellarg($file);
        exec("{$php} -l {$arg}", $output, $retval);
        $output = preg_replace('/\s+/ms', ' ', implode(' ', $output));
        if (defined('UPGRADE_AUTOFIX_PLUGIN') && UPGRADE_AUTOFIX_PLUGIN)
        {
            if (strpos($output, "Parse error: syntax error, unexpected 'new' (T_NEW)")!==false)
            {
                upgrade_remove_RefNew($file);
                $output1 = $output;
                $output = '';
                exec("{$php} -l {$arg}", $output, $retval);
                $output = preg_replace('/\s+/ms', ' ', implode(' ', $output));
                if (strpos($output, 'No syntax errors detected')!==false) {
                    $errors[] = sprintf("<li>[auto fixed]%s: <div>%s</div></li>", substr($file,strlen($DIR_PLUGINS)), hsc($output1));
                }
            }
        }
        if (strpos($output, 'No syntax errors detected')!==false)
            continue;
        if (preg_match('/^[^:]+error:/', $output))
            $errors[] = sprintf("<li>%s: <div>%s</div></li>", substr($file,strlen($DIR_PLUGINS)), hsc($output));
    }
    if (!empty($errors))
        return sprintf("<h2>%s</h2>{$ver}<ul>%s</ul>", _UPG_TEXT_WARN_PLUGIN_SYNTAX_ERROR, implode("\n", $errors));
    return '';
}

function upgrade_todo($ver) {
    return upgrade_checkinstall($ver) ? '(<span class="ok">'. _UPG_TEXT_60_INSTALLED .'</span>)' : "(<span class='warning'>". _UPG_TEXT_60_NOT_INSTALLED ."</span>)";
}

function upgrade_manual_atom1_0() {
    // atom 1.0
    $res = sql_query(parseQuery('SELECT sddesc FROM [@prefix@]skin_desc WHERE sdname="feeds/atom"'));
    
    $messages = array();
    while ($o = sql_fetch_object($res)) {
        if ($o->sddesc=='Atom 0.3 weblog syndication') {
            $messages[] = '<h2>Atom 1.0</h2>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_01 . '</p>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_02 . '</p>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_03 . '</p>';
        }
    }

    // default skin
    $res = sql_query(parseQuery('SELECT tdnumber FROM [@prefix@]template_desc WHERE tdname="default/index"'));
    $tdnumber = 0;
    $o = sql_fetch_object($res);
    $tdnumber = $o->tdnumber;
    if (0<$tdnumber){
        $query = sprintf("SELECT tpartname FROM %s WHERE tdesc=%s AND tpartname='BLOGLIST_LISTITEM'",sql_table('template'),$tdnumber);
        $res = sql_query($query);
        if (!sql_fetch_object($res)) {
            $messages[] = '<h2>' . _UPG_TEXT_ATOM1_04 . '</h2>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_05 . '</p>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_06 . '</p>';
            $messages[] = '<p>' . _UPG_TEXT_ATOM1_07 . '</p>';
        }
    }
    return !empty($messages) ? join("\n",$messages) : '';
}

function upgrade_manual_340() {
    $row = array();
    $row[] = '<h2>' . sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS , '3.4') . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V340_01 . '</p>';
    $row[] = '<p>';
    $row[] = _UPG_TEXT_V340_02 . ':';
    $row[] = '<ul>';
    $row[] = '<li><a href="../../extra/media/readme.txt">extra/media/readme.txt</a></li>';
    $row[] = '<li><a href="../../extra/skins/readme.txt">extra/skins/readme.txt</a></li>';
    $row[] = '</ul>';
    $row[] = '</p>';
    return join("\n", $row);
}

function upgrade_manual_350() {
    $s = <<<EOL
  <h2>Important Notices for Nucleus 3.5</h2>
  <p>
    Two new plugins have been included with version 3.5. You may want to consider installing them from the Plugins page of the admin area.
    <ul>
       <li><strong>NP_SecurityEnforcer</strong>: Enforces some security properties like password complexity and maximum failed login attempts. Note that it is disabled by default and must be enabled after installation.</li>
    </ul>
  </p>
EOL;
    return $s;
}

function upgrade_manual_366() {
    $row = array();
    $content = @file_get_contents('../../action.php');
    if(strpos($content,'=&')===false) return '';
    $row[] = '<h2>' . _UPG_TEXT_V366_01 . '</h2>';
    $row[] = '<p>' . _UPG_TEXT_V366_02_UPDATE_ACTION_PHP .'</p>';
    return join("\n", $row);
}

if(!function_exists('parseQuery')) {
    function parseQuery($query='',$ph=array()) { // $ph is placeholders
        $ph['prefix'] = sql_table();
        foreach($ph as $k=>$v) {
            
            if(strpos($query,'[@')===false) break;
            $k = '[@'.$k.'@]';
            $query = str_replace($k, $v, $query);
        }
        return $query;
    }
}
