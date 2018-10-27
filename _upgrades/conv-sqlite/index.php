<?php

/*
 * convert tool for sqlite
 *
 * Copyright (C) 2011-2016 piyoyo
 */

// web relative path : /install/conv-sqlite/

$uri = @preg_split('/[\?#]/', $_SERVER["REQUEST_URI"]);
$uri = $uri[0];
if (preg_match('#/[^/]+$#i', $uri) && !preg_match('#/index.php$#i', $uri))
{
    header("Location: " . $uri . "/");
    exit;
}

ob_start();
define('_CHARSET', 'UTF-8');

// auto search config.php
$basepath = realpath(dirname(__FILE__) . '/../../');
if (substr($basepath, -1,1) != DIRECTORY_SEPARATOR)
    $basepath .= DIRECTORY_SEPARATOR;
$config_file = $basepath . 'config.php';
if(is_file($config_file)) include_once($config_file);
else exit($config_file . ' Config file is not exists');
ob_end_clean();

$installer = new ConvertInstaller($basepath);

class ConvertInstaller
{

    public function __construct($basepath)
    {
        global $member, $CONF, $DB_DRIVER_NAME;
        $this->basepath = $basepath;
        $this->target_db_filename = $basepath . 'settings' . DIRECTORY_SEPARATOR . 'db_nucleus.sqlite';

        if (!isset($member) || !$member->isLoggedIn())
        {
            $this->showLogin('index.php');
            exit;
        }

        if ($CONF['DatabaseVersion'] != CORE_APPLICATION_DATABASE_VERSION_ID)
        {
            $msg = $this->_('Before conversion, please upgrade of the core');
            $this->error( $msg );
            exit;
        }

        if ('mysql' != $DB_DRIVER_NAME)
        {
            $msg = $this->_('Connected Driver is not mysql') . ' : ' . $DB_DRIVER_NAME;
            $this->error( $msg );
            exit;
        }

        foreach (array('pdo', 'pdo_sqlite', 'sqlite3') as $value)
        if (!extension_loaded($value))
        {
            $msg = $this->_('Not found') . ' : extension : ' . $value;
            $this->error( $msg );
            exit;
        }

        if ($member->isAdmin())
        {
            if (isset($_GET['export_config']) && $_GET['export_config']=='yes' )
                $this->export_config();

            if (is_file($this->target_db_filename))
            {
                $msg = $this->_('Database file is already exists') . "<br />"
                     . "settings/db_nucleus.sqlite" . "<br />"
                     . $this->_('If you want to convert, please try again move the old file');
                $msg .= "<br /><hr><br /><p>config.php</p>" .  $this->getDefaultConfig();
                $msg .= "<p>" . $this->_('Download the config.php') . "</p>\n";
                $msg .= "<p>Download <a href=\"./index.php?export_config=yes\" target=\"_blank\">config.php</a></p>\n";

                $this->error( $msg );
                exit;
            }
            $this->start();
            exit;
        }

        $this->error( $this->_('Only super admin'));
    }

    function printHead($title)
    {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="../styles/manual.css" type="text/css" />
  </head>
  <body>
<?php
        echo "\n";
        echo "<h1>" . $this->_('Convert database to sqlite') ."</h1>";
    }

    function printFoot()
    {
        echo "\n  </body>\n</html>";
    }

    function error($msg)
    {
        $this->printHead( $this->_('Error:') );

        echo "\n<h1>" . $this->_('Error failed') . "</h1>\n";
        echo "\n<p>" . $this->_('Error:') . "</p>\n";
        echo sprintf("<blockquote><div>%s</div></blockquote>", $msg);

        echo sprintf('<p><a href="index.php" onclick="history.back();">%s</a></p>', $this->_('Back'));

        $this->printFoot();
        exit;
    }

    function showLogin($type)
    {
        $this->printHead( $this->_('Login Please') );
        $name = isset($_POST['login']) ? "value='".hsc(strval($_POST['login']))."' " : '';
        ?>
        <h1><?php echo $this->_('Login Please'); ?></h1>
        <p><?php echo  $this->_('Enter your data'); ?>:</p>

        <form method="post" action="<?php echo $type ?>">

          <ul>
            <li><?php echo $this->_('Login name'); ?> <input name="login" <?php echo $name; ?>/></li>
            <li><?php echo $this->_('Login Password'); ?> <input name="password" type="password" /></li>
          </ul>

          <p>
            <input name="action" value="login" type="hidden" />
            <input type="submit" value="<?php echo $this->_('Login'); ?>" />
          </p>

        </form>
        <?php
        $this->printFoot();
        exit;
    }

    private function _getText($text)
    {
        static $cached_array = null;
        if (is_null($cached_array))
        {
            $cached_array = array();
            if (!extension_loaded('SimpleXML')) {
                return $text;
            }
            // skin for default
            $filename = dirname(__FILE__) . '/default_text.xml';
            if (!is_file($filename))
                return $text;
            $xml = simplexml_load_file($filename);
            if (!$xml)
                return $text;
            foreach ($xml->children() as $text_node) {
                if ($text_node->getName() != 'text')
                    continue;
                $keyname = '';
                $items = array();
                foreach ($text_node->children() as $node) {
                    $key   = $node->getName();
                    $value = (string) $node;
                    if ($key == 'key')
                        $keyname = $value;
                    else
                        $items[$key] = $value;
                }
                if (!isset($items['default']))
                    $items['default'] = $keyname;
                $keyname = (function_exists ('mb_strtolower') ? mb_strtolower($keyname,'UTF-8') :  strtolower($keyname));
                $cached_array[$keyname] = $items;
//                var_dump($keyname, $items);
            }
        }
        $key = strtolower($text);
        if (array_key_exists($key, $cached_array) && isset($cached_array[$key][_LOCALE]))
        {
            $subkey = _LOCALE;
            if (!isset($cached_array[$key][$subkey]))
            {
                if (!isset($cached_array[$key]['default']))
                    return $text;
                $subkey = 'default';
            }
            else
            {
                if (_CHARSET == 'UTF-8')
                    return $cached_array[$key][_LOCALE];
            }
            if (!function_exists('mb_convert_encoding'))
                return $text;
            return mb_convert_encoding($cached_array[$key][$subkey], _CHARSET, 'UTF-8');
        }
        return $text; // not found
    }

    public function _($text)
    {
        // not implemented yet
        // check language
        // load text
        // if undefined, search constant
        $name = strtoupper(str_replace(' ', '_', $text));
        foreach (array('','_TEXT_','_') as $prefix)
        {
            if (defined($prefix.$name))
                return constant($prefix.$name);
        }
        return $this->_getText($text);
    }

    public function start()
    {
        global $CONF;
        $this->printHead( $this->_('Convert data mysql to sqlite') );

        // check mysql database
        // check sqlite is_file
        // start convert

        if (isset($_POST['action']) && $_POST['action'] == "startconvert")
        {
            $this->doConvert();
            clearstatcache();
            echo sprintf("Size: %d", filesize($this->target_db_filename));
            echo "\n<p>" . $this->_('Conversion was over') . "</p>\n";
            echo "<h2>" . $this->_('Please edit the config.php manually') . "</h2>\n";
            echo "<p>config.php</p>\n";
            echo $this->getDefaultConfig();
            echo "<p>" . $this->_('Download the config.php') . "</p>\n";
            echo "<p>Download <a href=\"./index.php?export_config=yes\" target=\"_blank\">config.php</a></p>\n";

            printf("<h1>%s</h1>", $this->_('Visit your web site'));
            echo "<p><ul>";
            printf('<li><a href="%s">%s</a></li>', $CONF['AdminURL'], $this->_('Login to the admin area'));
            printf('<li><a href="%s">%s</a></li>', $CONF['BlogURL'],  $this->_('Visit your site now'));
            echo "</ul></p>";
//            echo "\n<h3>" . $this->_('Error failed') . "</h3>\n";
//            echo "\n<p>" . $this->_('Error:') . "</p>\n";
//            echo sprintf("<blockquote><div>%s</div></blockquote>", $this->_('Sorry') . ', ' . $this->_('not implemented yet'));
//            echo sprintf("<blockquote><div>%s</div></blockquote>", $this->_('Currentry supports on shell or command prompt (php_sapi is cli). Do it yourself by manually.'));
        }
        else
        {
            echo "<p>"  . $this->_('If you want to convert start, please press the start button') ."</p>";
            echo "<p>"  . $this->_('Save file path:') . " settings/</p>";
            // Todo : Note
            $btn_title = $this->_('Start convert');
                    $s = <<<EOD
            <form method="post" action="index.php"><p>
            <input type="hidden" name="action" value="startconvert" />
            <input type="submit" value="${btn_title}" tabindex="20" />
            </p></form>
EOD;
                    echo $s;
            $this->showUnSupportedPlugins();
        }

        echo sprintf('<p><a href="index.php" onclick="history.back();">%s</a></p>', $this->_('Back'));

        $this->printFoot();
    }

    private function doConvert()
    {
        include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "table_conv_mysql_to_sqlite.php");

        //$obj = new TableConvertor();
        $obj = new TableConvertor_mysql_to_sqlite();

        //var_dump ($obj->base_table_list);

        $tables = array();
        $result = @sql_query(sprintf("SHOW TABLES LIKE '%s'", sql_table("") . "%"));
        while ($row = @sql_fetch_array($result))
            $tables[] = $row[0];

        //$tables = $obj->base_table_list;
        //define('conv_debug', true);

        $db = new SQLite3($this->target_db_filename);
        $db->exec('BEGIN;');

        $error_messages = array();
        foreach ($tables as $table)
        {
        //  echo $table.$obj->get_table_structure($table);
            ob_start();
            @$obj->dump_table_structure($table);
            echo "\n";
            @$obj->dump_table_data($table);
            $sql = ob_get_contents();
            ob_end_clean();
            $db->exec($sql);

//            if ($obj->logs_count)
//            {
//                echo "\n/*\n";
//                echo "\n" . implode("\n", $obj->get_logs) . "\n";
//                echo "\n*/\n";
//            }
//            if (defined('conv_debug'))
//            {
//                if (preg_match('/nucleus_plugin_option$/i', $table))
//                    exit; // debug
//            }
        }
        $db->exec('END;');
    }

    public function getDefaultConfig()
    {
        $short =<<<EOD
<blockquote><pre style="width:100%; overflow: auto; background-color: #ffffe1"><b>//</b>\$DB_DRIVER_NAME = 'mysql'; \$DB_PHP_MODULE_NAME = 'mysql';<b>
\$DB_DRIVER_NAME = &#039;sqlite&#039;; \$DB_PHP_MODULE_NAME = &#039;pdo&#039;;
if (\$DB_DRIVER_NAME==&#039;sqlite&#039;)
{
   \$DB_DATABASE = dirname(__FILE__) . str_replace(&#039;/&#039;, DIRECTORY_SEPARATOR, &#039;/settings/db_nucleus.sqlite&#039;);
// \$DB_DATABASE = &#039;pathto/&#039; . &#039;db_nucleus.sqlite&#039;;
}</b></pre></blockquote>
EOD;
        return $short;
    }

    public function getCompleteConfig()
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE, $DB_PREFIX;
        global $DIR_NUCLEUS,  $DIR_MEDIA, $DIR_SKINS;
        global $DIR_PLUGINS, $DIR_LANG, $DIR_LIBS;
        global $DIR_BASE;
        
        $newDir = array();
        foreach(array('DIR_NUCLEUS'=>'nucleus', 'DIR_MEDIA'=>'media', 'DIR_SKINS'=>'skins') as $key => $value)
        {
            $newDir[$key] = sprintf("'%s'", $$key);
            if (!isset($DIR_BASE) || strlen($DIR_BASE)==0)
                continue;
            if ($DIR_BASE. $value .'/' == $$key)
                $newDir[$key] = "\$DIR_BASE . '${value}/'";
            else if (0 === strpos($$key, $DIR_BASE))
                $newDir[$key] = sprintf("\$DIR_BASE . '%s'", substr($$key, strlen($DIR_BASE)));
        }

        foreach(array('DIR_PLUGINS'=>'plugins', 'DIR_LANG'=>'language', 'DIR_LIBS'=>'libs') as $key => $value)
        {
            if ($DIR_NUCLEUS. $value .'/' == $$key)
                $newDir[$key] = "\$DIR_NUCLEUS . '${value}/'";
            else if (0 === strpos($$key, $DIR_NUCLEUS))
                $newDir[$key] = sprintf("\$DIR_NUCLEUS . '%s'", substr($$key, strlen($DIR_NUCLEUS)));
            else
               $newDir[$key] = sprintf("'%s'", $$key);
//           var_dump(__LINE__, $DIR_NUCLEUS, $key, $value, $$key);
        }

        $s =<<<EOD
<?php

// This file contains variables with the locations of the data dirs
// and basic functions that every page can use

// mySQL connection information
\$DB_HOST     = '$DB_HOST';
\$DB_USER     = '$DB_USER';
\$DB_PASSWORD = '$DB_PASSWORD';
\$DB_DATABASE = '$DB_DATABASE';
\$DB_PREFIX   = '$DB_PREFIX';

global \$DB_DRIVER_NAME, \$DB_PHP_MODULE_NAME;
// default is default is  \$DB_DRIVER_NAME = 'mysql'; \$DB_PHP_MODULE_NAME = 'mysql';
//\$DB_DRIVER_NAME = 'mysql';  \$DB_PHP_MODULE_NAME = 'pdo';
\$DB_DRIVER_NAME = 'sqlite';  \$DB_PHP_MODULE_NAME = 'pdo';
//\$DB_DRIVER_NAME = 'mysql';  \$DB_PHP_MODULE_NAME = 'mysql';

if (\$DB_DRIVER_NAME=='sqlite')
{
   \$DB_DATABASE = dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/settings/db_nucleus.sqlite');
// \$DB_DATABASE = 'pathto/' . 'db_nucleus.sqlite';
}

// main nucleus directory
\$DIR_BASE = dirname(__FILE__) . '/';

//\$DIR_NUCLEUS = \$DIR_BASE . 'nucleus/';
\$DIR_NUCLEUS = {$newDir['DIR_NUCLEUS']};
//\$DIR_NUCLEUS = '/your/path/to/nucleus/';

// media dir
//\$DIR_MEDIA = \$DIR_BASE . 'media/';
\$DIR_MEDIA = {$newDir['DIR_MEDIA']};
//\$DIR_MEDIA = '/your/path/to/media/';

// extra skin files for imported skins
//\$DIR_SKINS = \$DIR_BASE . 'skins/';
\$DIR_SKINS = {$newDir['DIR_SKINS']};
//\$DIR_SKINS = '/your/path/to/skins/';

// these dirs are normally subdirs of the nucleus dir, but
// you can redefine them if you wish
//\$DIR_PLUGINS = \$DIR_NUCLEUS . 'plugins/';
\$DIR_PLUGINS = {$newDir['DIR_PLUGINS']};

//\$DIR_LANG = \$DIR_NUCLEUS . 'language/';
\$DIR_LANG = {$newDir['DIR_LANG']};

//\$DIR_LIBS = \$DIR_NUCLEUS . 'libs/';
\$DIR_LIBS = {$newDir['DIR_LIBS']};

if (!isset(\$DIR_NUCLEUS) || !@is_file(\$DIR_LIBS . 'globalfunctions.php')) {
    foreach(array(\$DIR_LIBS , dirname(__FILE__).'/nucleus/libs/') as \$path)
        if (@is_file(\$path.'config-error.php')) @include(\$path.'config-error.php');
    header('Content-type: text/html; charset=utf-8');
    echo '<h1>Configuration error</h1>';
    echo '<p>please run the <a href="./install/index.php">install script</a> or modify config.php</p>';
    exit;
}

// include libs
include(\$DIR_LIBS.'globalfunctions.php');

EOD;
        return $s;
    }

    private function export_config()
    {
//        if (headers_sent())
//        {
//            $msg = $this->_('error: headers_sent');
//            $this->error( $msg );
//        }

        $contents = $this->getCompleteConfig(); 
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="config.php"');
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: " . strlen($contents));
        echo $contents;
        exit;
    }

    public function showUnSupportedPlugins()
    {
        global $manager;
        $items = array();
        $res = sql_query(sprintf('SELECT pid, pfile FROM `%s` ORDER BY porder ASC' , sql_table('plugin')));
        while($res && ($row = sql_fetch_array($res)))
        {
            $plugin = $manager->getPlugin($row[1]);
            $tablelist = $plugin->getTableList();
            if (empty($tablelist))
                continue;
            if (is_object($plugin)
                && ($plugin->supportsFeature('SqlApi_SQL92') || $plugin->supportsFeature('SqlApi_sqlite'))) {
                continue;
            }
            $items[] = $row[1];
        }
        if (count($items) == 0)
            return;
        sort($items);
        echo "<h2>" . hsc($this->_('The following installed plugins does not correspond to sqlite')) . "</h2>\n";
        echo "<table><ol>";
        foreach($items as $item)
           printf('<li>%s</li>', $item);
        echo "</ol></table>";
    }

}
