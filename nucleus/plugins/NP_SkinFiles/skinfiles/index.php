<?php

/* ==========================================================================================
 * Nucleus SkinFiles Plugin
 *
 * Copyright 2005-2007 by Jeff MacMichael and Niels Leenheer
 *
 * ==========================================================================================
 * This program is free software and open source software; you can redistribute
 * it and/or modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  or visit
 * http://www.gnu.org/licenses/gpl.html
 * ==========================================================================================
 */
$DIR_LIBS = '';
$strRel   = '../../../';
if (!is_file($strRel . 'config.php')) {
    $strRel .= '../';
}
require($strRel . 'config.php');
include_libs('PLUGINADMIN.php');

$language = str_replace(array('\\','/'), '', getLanguageName());
$langfile = $language.'.php';
if (is_file('language/'.$langfile)) {
    include_once('language/'.$langfile);
} else {
    include_once('language/english.php');
}

/**
  * Create admin area
  */

$oPluginAdmin = new PluginAdmin('SkinFiles');

if (!($member->isLoggedIn() && $member->isAdmin())) {
    $oPluginAdmin->start();
    echo '<p>' . _ERROR_DISALLOWED . '</p>';
    $oPluginAdmin->end();
    exit;
}

/**
  * Setup main variables
  */

$rootDirectory = sfRealPath($DIR_SKINS);
$rootUrl       = $CONF['SkinsURL'];
$pluginUrl     = $oPluginAdmin->plugin->getAdminURL();

$filetypes = array(
    'text' => array('inc', 'txt', 'css', 'js', 'php'),
    'html' => array('htm', 'html'),
    'img'  => array('png', 'gif', 'jpg', 'jpeg', 'bmp', 'ico', 'swf'),
);

/**
  * Bypass admin area for downloads
  */

$action = requestVar('action');

if ($action == 'download') {
    _skinfiles_download();
    exit;
}

/**
  * Build admin area
  */

$oPluginAdmin->start();

echo "<h2>" . _SKINFILES_MANAGEMENT . "</h2>";

$actions = array(
    'renfile', 'renfile_process', 'delfile', 'delfile_process',
    'editfile', 'editfile_process', 'uploadfile', 'createfile', 'viewfile',
    'rendir', 'rendir_process', 'deldir', 'deldir_process',
    'emptydir', 'emptydir_process', 'createdir'
);

if (in_array($action, $actions)) {
    if (!$manager->checkTicket()) {
        echo '<p class="error">' . _ERROR . ': ' . _ERROR_BADTICKET . '</p>';
        sfShowDirectory();
    } else {
        call_user_func('_skinfiles_' . $action);
    }
} else {
    sfShowDirectory();
}

$oPluginAdmin->end();
exit;

if (!function_exists('hsc')) {
    function hsc($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, _CHARSET, false);
    }
}

/* Helper functions **************************************************************************************************************/

function sfExpandDirectory($path)
{
    /* IN:  relative directory
     * OUT: full path to directory
     */

    global $rootDirectory;
    return sfRealPath($rootDirectory . $path);
}

function sfRealPath($path)
{
    /* IN:  full path
     * OUT: canonicalized absolute pathname
     */

    $path = realpath($path);
    $path = str_replace('\\', '/', $path);
    $path = substr($path, strlen($path) - 1) != '/' ? $path . '/' : $path;
    return $path;
}

function sfFullUrl($path)
{
    /* IN:  full path including filename
     * OUT: url including filename
     */

    global $rootDirectory, $rootUrl;

    $path = str_replace($rootDirectory, '', $path);
    $path = rawurlencode($path);
    $path = str_replace('%2F', '/', $path);
    return $rootUrl . $path;
}

function sfValidPath($path)
{
    /* IN:  full path excluding or including filename
     * OUT: boolean, true if full path is or is within rootDirectory
     */

    global $rootDirectory;
    return substr($path, 0, strlen($rootDirectory)) == $rootDirectory;
}

function sfRelativePath($path)
{
    /* IN:  full path including or excluding filename
     * OUT: relative path from rootDirectory
     */

    global $rootDirectory;
    return str_replace($rootDirectory, '', $path);
}

function sfIsFileType($type, $file)
{
    global $filetypes;
    return isset($filetypes[$type]) && in_array(strtolower(substr(strrchr($file, "."), 1)), $filetypes[$type]);
}

function sfAllowEditing($file)
{
    return sfIsFileType('html', $file) || sfIsFileType('text', $file);
}

function sfAllowViewing($file)
{
    return sfIsFileType('html', $file) || sfIsFileType('text', $file) || sfIsFileType('img', $file);
}

function sfDisplayPath($relative)
{
    global $pluginUrl;

    $result = '<a href="' . hsc($pluginUrl) . '" title="Go back to &laquo;skins&raquo;">';
    $result .= '<img src="' . hsc($pluginUrl . 'images/home.gif') . '" alt="" /> skins</a> / ';

    $parts = explode('/', $relative);
    $part  = '';

    foreach ($parts as $v) {
        if ($v != '') {
            $part .= $v . '/';

            $result .= '<a href="' . hsc($pluginUrl . '?dir=' . rawurlencode($part)) . '" ';
            $result .= 'title="Go back to &laquo;' . hsc($v) . '&raquo;">';
            $result .= '<img src="' . hsc($pluginUrl . 'images/dir.gif') . '" alt="" /> ';
            $result .= hsc($v) . '</a> / ';
        }
    }

    return $result;
}

function sfIcon($file)
{
    global $pluginUrl;

    $ext = strtolower(substr(strrchr($file, "."), 1));

    switch ($ext) {
        case 'htm':
        case 'html':
            return $pluginUrl . 'images/html.gif';
            break;

        case 'txt':
        case 'js':
        case 'css':
        case 'inc':
            return $pluginUrl . 'images/text.gif';
            break;

        case 'gif':
        case 'png':
        case 'jpg':
        case 'jpeg':
        case 'bmp':
        case 'xbmp':
        case 'ico':
            return $pluginUrl . 'images/image.gif';
            break;

        case 'php':
        case 'php3':
        case 'php4':
            return $pluginUrl . 'images/php.gif';
            break;

        default:
            return $pluginUrl . 'images/generic.gif';
            break;
    }
}

function sfIllegalFilename($name)
{
    return preg_match('#[\n\r\\\/\:\*\?\"\<\>\|]#', $name);
}

function sfDirectoryIsEmpty($dir)
{
    $count = 0;

    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $count++;
        }

        closedir($dh);
    }

    // $count must be smaller or equal than 2, because '.'
    // and '..' are always returned by readdir().
    return $count <= 2;
}

/* Show directory ****************************************************************************************************************/

function sfShowDirectory($default = '')
{
    global $pluginUrl, $rootDirectory, $CONF, $manager;

    $directory = $default != '' ?
        $default :
        sfExpandDirectory(trim(requestVar('dir')));

    if (!sfValidPath($directory) || !is_dir($directory)) {
        $directory = $rootDirectory;
    }

    $relative = sfRelativePath($directory);

    echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative) . '</p>';

    $dirs  = array();
    $files = array();

    if ($dh = @opendir($directory)) {
        while (($file = readdir($dh)) !== false) {
            if (!preg_match("/^\.{1,2}$/", $file)) {
                $fstat = @stat($directory . $file);

                if ($fstat['mode'] & 040000) {
                    $dirs[$file] = $fstat;
                } else {
                    $files[$file] = $fstat;
                }
            }
        }
        closedir($dh);
    }

    ksort($dirs);
    ksort($files);

    echo '<table><thead><tr>';
    echo '<th>' . _SKINFILES_NAME . '</th><th>' . _SKINFILES_SIZE . '</th><th>' . _SKINFILES_LAST_MODIFIED . '</th><th colspan="4">' . _SKINFILES_ACTIONS . '</th>';
    echo '</tr></thead>';

    foreach ($dirs as $name => $stat) {
        $dir = sfRelativePath($directory . $name . '/');

        echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);"><td>';

        if (is_readable($directory . $name)) {
            echo '<a href="' . hsc($pluginUrl . '?dir=' . rawurlencode($dir)) . '">';
            echo '<img src="' . hsc($pluginUrl . 'images/dir.gif') . '" alt="folder" /> ';
            echo hsc($name).'</a>';
        } else {
            echo '<img src="' . hsc($pluginUrl . 'images/dir.gif') . '" alt="folder" /> ';
            echo hsc($name);
        }

        echo '</td>';

        $renUrl = $manager->addTicketToUrl($pluginUrl . '?action=rendir&dir=' . rawurlencode($dir));
        $delUrl = $manager->addTicketToUrl($pluginUrl . '?action=deldir&dir=' . rawurlencode($dir));

        echo '<td>&ndash;</td>';
        echo '<td>' . date(_SKINFILES_DATE_FORMAT, $stat['mtime']);

        if (is_writable($directory . $name)) {
            echo '<td><a href="' . hsc($renUrl) . '" title="' . _SKINFILES_RENAME . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_RENAME . '</a></td>';
        } else {
            echo '<td>&nbsp;</td>';
        }

        if (is_writable($directory . $name) && sfDirectoryIsEmpty($directory . $name)) {
            echo '<td><a href="' . hsc($delUrl) . '" title="' . _SKINFILES_DELETE . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_DELETE . '</a></td>';
        } else {
            echo '<td>&nbsp;</td>';
        }

        echo '<td>&nbsp;</td><td>&nbsp;</td>';
        echo '</tr>';
    }

    foreach ($files as $name => $stat) {
        $file = sfRelativePath($directory . $name);

        $renUrl  = $manager->addTicketToUrl($pluginUrl . '?action=renfile&file='  . rawurlencode($file));
        $delUrl  = $manager->addTicketToUrl($pluginUrl . '?action=delfile&file='  . rawurlencode($file));
        $editUrl = $manager->addTicketToUrl($pluginUrl . '?action=editfile&file=' . rawurlencode($file));
        $viewUrl = $manager->addTicketToUrl($pluginUrl . '?action=viewfile&file=' . rawurlencode($file));
        $dlUrl   = $manager->addTicketToUrl($pluginUrl . '?action=download&file=' . rawurlencode($file));

        echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);"><td>';

        if (is_readable($directory . $name) && sfAllowViewing($name)) {
            echo '<a href="' . hsc($viewUrl) . '">';
            echo '<img src="' . hsc(sfIcon($name)) . '" alt="" /> ';
            echo hsc($name).'</a>';
        } else {
            echo '<img src="' . hsc(sfIcon($name)) . '" alt="" /> ';
            echo hsc($name);
        }

        echo '</td><td>';
        echo ceil($stat['size'] / 1024) . ' kB';
        echo '</td><td>';
        echo date(_SKINFILES_DATE_FORMAT, $stat['mtime']);
        echo '</td><td>';

        if (is_writable($directory . $name)) {
            echo '<a href="' . hsc($renUrl) . '" title="' . _SKINFILES_RENAME . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_RENAME . '</a>';
        } else {
            echo '&nbsp;';
        }

        echo '</td><td>';

        if (is_writable($directory . $name)) {
            echo '<a href="' . hsc($delUrl) . '" title="' . _SKINFILES_DELETE . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_DELETE . '</a>';
        } else {
            echo '&nbsp;';
        }

        echo '</td><td>';

        if (is_writable($directory . $name) && sfAllowEditing($name)) {
            echo '<a href="'. hsc($editUrl) . '" title="' . _SKINFILES_EDIT . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_EDIT . '</a>';
        } else {
            echo '&nbsp;';
        }

        echo '</td><td>';

        if (is_readable($directory . $name)) {
            echo '<a href="' . hsc($dlUrl) . '" title="' . _SKINFILES_DOWNLOAD . ' &laquo;' . hsc($name) . '&raquo;">' . _SKINFILES_DOWNLOAD . '</a>';
        } else {
            echo '&nbsp;';
        }

        echo '</td></tr>';
    }

    if (!count($dirs) && !count($files)) {
        echo '<tr><td colspan="7">' . _SKINFILES_ERR_DIR_DOES_NOT_CONTAIN . '</td></tr>';
    }

    echo '</table>';

    if ($relative != '') {
        if (is_writable($directory)) {
            echo '<div class="dialogbox">';
            echo '<h4 class="light">' . _SKINFILES_CREATE_NEW_FILE . '</h4><div>';
            echo '<form method="post" action="' . hsc($pluginUrl) . '">';
            $manager->addTicketHidden();
            echo '<input type="hidden" name="action" value="createfile" />';
            echo '<input type="hidden" name="dir" value="' . hsc($relative) . '" />';
            echo '<input type="text" name="name" size="40" value="untitled.txt" />';
            echo '<p class="buttons"><input type="submit" value="' . _SKINFILES_CREATE_FILE . '" /></p></form>';
            echo '</div></div>';

            echo '<div class="dialogbox">';
            echo '<h4 class="light">' . _SKINFILES_UPLOAD_NEW_FILE . '</h4><div>';
            echo '<form method="post" enctype="multipart/form-data" action="' . hsc($pluginUrl) . '">';
            $manager->addTicketHidden();
            echo '<input type="hidden" name="action" value="uploadfile" />';
            echo '<input type="hidden" name="dir" value="' . hsc($relative) . '" />';
            echo '<input type="hidden" name="MAX_FILE_SIZE" value="' . $CONF['MaxUploadSize'] . '" />';
            echo '<input type="file" name="name" size="40" />';
            echo '<p class="buttons"><input type="submit" value="' . _SKINFILES_UPLOAD . '" /></p></form>';
            echo '</div></div>';
        }

        if (count($files)) {
            echo '<div class="dialogbox">';
            echo '<h4 class="light">' . _SKINFILES_DEL_ALL_FILES . '</h4><div>';
            echo '<form method="post" action="' . hsc($pluginUrl) . '">';
            $manager->addTicketHidden();
            echo '<input type="hidden" name="action" value="emptydir" />';
            echo '<input type="hidden" name="dir" value="' . hsc($relative) . '" />';
            echo _SKINFILES_DEL_ALL_FILES_MSG;
            echo '<p class="buttons"><input type="submit" value="' . _SKINFILES_DELETE_ALL . '" tabindex="140" onclick="return checkSubmit();" /></p>';
            echo '</form>';
            echo '</div></div>';
        }
    }

    if (is_writable($directory)) {
        echo '<div class="dialogbox">';
        echo '<h4 class="light">' . _SKINFILES_CREATE_NEW_DIR . '</h4><div>';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="createdir" />';
        echo '<input type="hidden" name="dir" value="' . hsc($relative) . '" />';
        echo '<input type="text" name="name" value="untitled" tabindex="90" size="40" />';
        echo '<p class="buttons"><input type="submit" value="' . _SKINFILES_CREATE . '" tabindex="140" onclick="return checkSubmit();" /></p>';
        echo '</form>';
        echo '</div></div>';
    }
}

/* Rename directory **************************************************************************************************************/

function _skinfiles_rendir($preset = '')
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory . $file) && file_exists($directory . $file) &&
        is_dir($directory . $file) && is_writable($directory . $file)) {
        $relative = sfRelativePath($directory);
        $editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=rendir&dir=' . rawurlencode($relative . $file));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($editUrl) . '" title="' . _SKINFILES_RENAME . ' &laquo;' . $file . '&raquo;">';
        echo '<img src="' . $pluginUrl . 'images/dir.gif' . '" alt="" /> ' . $file . '</a></p>';

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="rendir_process" />';
        echo '<input type="hidden" name="dir" value="' . hsc($relative . $file) . '" />';

        echo '<h4>' . _SKINFILES_RENAME_DIR_MSG . ' &laquo;' . hsc($file) . '&raquo; ' . _SKINFILES_RENAME_DIR_MSG2 . '</h4><div>';
        echo '<p><input type="text" name="name" size="40" value="' . hsc($preset != '' ? $preset : $file) . '" /></p>';
        echo '<p class="buttons">';
        echo '<input type="hidden" name="sure" value="yes" />';
        echo '<input type="submit" value="' . _SKINFILES_RENAME . '" />';
        echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
        echo '</p>';
        echo '</div></form></div>';
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_DIR_DOES_NOT_EXIST1 . " &laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DIR_DOES_NOT_EXIST2;
        echo _SKINFILES_ERR_DIR_DOES_NOT_EXIST3 . "</p>";
    }
}

function _skinfiles_rendir_process()
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory . $file) && file_exists($directory . $file) &&
            is_dir($directory . $file) && is_writable($directory . $file)) {
            $name = requestVar('name');

            if ($name == '') {
                echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_RENAME_DIR1 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_COULD_NOT_RENAME_DIR2 . "</p>";
                _skinfiles_rendir($name);
                return;
            }

            if (sfIllegalFilename($name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_RENAME_DIR3 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_COULD_NOT_RENAME_DIR4 . "</p>";
                _skinfiles_rendir($name);
                return;
            }

            if ($name == $file) {
                echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_RENAME_DIR5 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_COULD_NOT_RENAME_DIR6 . _SKINFILES_ERR_COULD_NOT_RENAME_DIR7 . "</p>";
                _skinfiles_rendir($name);
                return;
            }

            if (file_exists($directory . $name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_RENAME_DIR8 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_COULD_NOT_RENAME_DIR9 . _SKINFILES_ERR_COULD_NOT_RENAME_DIR10 . "</p>";
                _skinfiles_rendir($name);
                return;
            }

            if (!@rename($directory . $file, $directory . $name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_RENAME_DIR11 . "&laquo;" . hsc($file) . "&raquo;</p>";
                _skinfiles_rendir($name);
                return;
            }

            echo "<p class='message'>" . _SKINFILES_RENAMED_DIR1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_RENAMED_DIR2;
            echo _SKINFILES_RENAMED_DIR3 . "&laquo;" . hsc($name) . "&raquo;" . _SKINFILES_RENAMED_DIR4 . "</p>";
            sfShowDirectory($directory);
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_DIR_DOES_NOT_EXIST1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DIR_DOES_NOT_EXIST2;
            echo _SKINFILES_ERR_DIR_DOES_NOT_EXIST3 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory);
    }
}

/* Create directory **************************************************************************************************************/

function _skinfiles_createdir()
{
    $directory = trim(requestVar('dir'));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) {
        $name = requestVar('name');

        if ($name == '') {
            echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR1 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (sfIllegalFilename($name)) {
            echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR2 . "&laquo;" . hsc($name) . "&raquo; ";
            echo _SKINFILES_ERR_COULD_NOT_CREATE_DIR3 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (file_exists($directory . $name)) {
            echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR4 . "&laquo;" . hsc($name) . "&raquo; ";
            echo _SKINFILES_ERR_COULD_NOT_CREATE_DIR5 . _SKINFILES_ERR_COULD_NOT_CREATE_DIR6 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        $mask = @umask(0000);

        if (!@mkdir($directory . $name, 0755)) {
            echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR2 . "&laquo;" . hsc($name) . "&raquo;</p>";
            sfShowDirectory($directory);
            return;
        }

        @umask($mask);

        echo "<p class='message'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR7 . "&laquo;" . hsc($name) . "&raquo; " . _SKINFILES_ERR_COULD_NOT_CREATE_DIR8 . "</p>";
        sfShowDirectory($directory);
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_COULD_NOT_CREATE_DIR9 . "&laquo;" . hsc(_skinfiles_basename($directory)) . "&raquo; " .  _SKINFILES_ERR_COULD_NOT_CREATE_DIR10;
        echo _SKINFILES_ERR_COULD_NOT_CREATE_DIR11 . "</p>";
    }
}

/* Delete directory **************************************************************************************************************/

function _skinfiles_deldir()
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory . $file) && file_exists($directory . $file) &&
        is_dir($directory . $file) && is_writable($directory . $file) &&
        sfDirectoryIsEmpty($directory . $file)) {
        $relative = sfRelativePath($directory);
        $delUrl   = $manager->addTicketToUrl($pluginUrl . '?action=deldir&dir=' . rawurlencode($relative . $file));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($delUrl) . '" title="' . _SKINFILES_DELETE . ' &laquo;' . $file . '&raquo;">';
        echo '<img src="' . $pluginUrl . 'images/dir.gif' . '" alt="" /> ' . $file . '</a></p>';

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="deldir_process" />';
        echo '<input type="hidden" name="dir" value="' . hsc($relative . $file) . '" />';

        echo '<h4>' . _SKINFILES_DELETE_DIR . ' &laquo;' . hsc($file) . '&raquo; ' . _SKINFILES_DELETE_DIR2 . '</h4><div>';
        echo '<p class="buttons">';
        echo '<input type="hidden" name="sure" value="yes" />';
        echo '<input type="submit" value="' . _SKINFILES_DELETE . '" />';
        echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
        echo '</p>';
        echo '</div></form></div>';
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_DELETE_DIR1 . " &laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_DIR2;
        echo _SKINFILES_ERR_DELETE_DIR3 . "</p>";
    }
}

function _skinfiles_deldir_process()
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory . $file) && file_exists($directory . $file) &&
            is_dir($directory . $file) && is_writable($directory . $file) &&
            sfDirectoryIsEmpty($directory . $file)) {
            if (!@rmdir($directory . $file)) {
                echo "<p class='error'>" . _SKINFILES_ERR_DELETE_DIR4 . "&laquo;" . hsc($file) . "&raquo;</p>";
                sfShowDirectory($directory);
                return;
            }

            echo "<p class='message'>" . _SKINFILES_ERR_DELETE_DIR5 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_DIR6 . "</p>";

            /* begin modification by katsumi */
            $num = 0;
            $d   = dir($directory);
            while (false !== ($entry = $d->read())) {
                if ($entry != '.' && $entry != '..') {
                    $num++;
                }
            }
            $d->close();
            if ($num == 0) {
                _skinfiles_delbutton('dir', dirname(trim(requestVar('dir'))));
            }
            /* end modification */

            sfShowDirectory($directory);
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_DELETE_DIR1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_DIR2;
            echo _SKINFILES_ERR_DELETE_DIR3 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory);
    }
}

/* Empty directory ***************************************************************************************************************/

function _skinfiles_emptydir()
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory . $file) && file_exists($directory . $file) && is_dir($directory . $file)) {
        $files = array();

        if ($dh = @opendir($directory . $file)) {
            while (($name = readdir($dh)) !== false) {
                if (!preg_match("/^\.{1,2}$/", $name) &&
                   !is_dir($directory . $file . '/' . $name) &&
                   is_writable($directory . $file . '/' . $name)) {
                    $files[] = $name;
                }
            }

            closedir($dh);
            sort($files);
        }

        $relative = sfRelativePath($directory);
        $emptyUrl = $manager->addTicketToUrl($pluginUrl . '?action=emptydir&dir=' . rawurlencode($relative . $file));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($emptyUrl) . '" title="Empty &laquo;' . $file . '&raquo;">';
        echo '<img src="' . $pluginUrl . 'images/dir.gif' . '" alt="" /> ' . $file . '</a></p>';

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="emptydir_process" />';
        echo '<input type="hidden" name="dir" value="' . hsc($relative . $file) . '" />';

        echo '<h4>' . _SKINFILES_DELETE_FILE_MSG . ' &laquo;' . hsc($file) . '&raquo;' . _SKINFILES_DELETE_FILE_MSG2 . '</h4><div>';

        if (count($files)) {
            echo '<ul>';
            foreach ($files as $name) {
                echo '<li>' . hsc($name) . '</li>';
            }
            echo '</ul>';

            echo '<p class="buttons">';
            echo '<input type="hidden" name="sure" value="yes" />';
            echo '<input type="submit" value="' . _SKINFILES_DELETE . '" />';
            echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
            echo '</p>';
        } else {
            echo '<p>' . _SKINFILES_ERR_DELETE_DIR7 . '</p>';
            echo '<p class="buttons">';
            echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
            echo '</p>';
        }

        echo '</div></form></div>';
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_DELETE_DIR1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_DIR2;
        echo _SKINFILES_ERR_DELETE_DIR3 . "</p>";
    }
}

function _skinfiles_emptydir_process()
{
    global $pluginUrl, $manager;

    $file      = trim(_skinfiles_basename(requestVar('dir')));
    $directory = trim(dirname(requestVar('dir')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory . $file) && file_exists($directory . $file) && is_dir($directory . $file)) {
            if ($dh = @opendir($directory . $file)) {
                while (($name = readdir($dh)) !== false) {
                    if (!preg_match("/^\.{1,2}$/", $name) && !is_dir($directory . $file . '/' . $name) &&
                       is_writable($directory . $file . '/' . $name)) {
                        if (unlink($directory .$file . '/' . $name)) {
                            echo "<p class='message'>" . _SKINFILES_ERR_EMPTY_DIR1 . "&laquo;" . hsc($name) . "&raquo; " . _SKINFILES_ERR_EMPTY_DIR2 . "</p>";
                        } else {
                            echo "<p class='error'>" . _SKINFILES_ERR_EMPTY_DIR3 . "&laquo;" . hsc($name) . "&raquo; " . _SKINFILES_ERR_EMPTY_DIR4 . "</p>";
                        }
                    }
                }

                closedir($dh);

                sfShowDirectory($directory . $file . '/');
            }
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_EMPTY_DIR5 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_EMPTY_DIR6;
            echo _SKINFILES_ERR_EMPTY_DIR7 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory . $file . '/');
    }
}

/* Download file *****************************************************************************************************************/

function _skinfiles_download()
{
    global $pluginUrl, $manager;

    $file = _skinfiles_basename(trim(requestVar('file')));

    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && file_exists($directory . $file) &&
        is_file($directory . $file) && is_readable($directory . $file)) {
        if (strstr(serverVar('HTTP_USER_AGENT'), "MSIE")) {
            $name = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);
        } else {
            $name = $file;
        }

        if ($fp = @fopen($directory . $file, 'r')) {
            header("Cache-Control: ");  // leave blank to avoid IE errors
            header("Pragma: ");         // leave blank to avoid IE errors
            header("Content-type: application/octet-stream");
            header('Content-Disposition: attachment; filename="'.$name.'"');
            header("Content-length: ".(string)(filesize($directory . $file)));
            sleep(1);

            fpassthru($fp);
            fclose($fp);
        } else {
            echo _SKINFILES_ERR_DOWNLOAD_FILE1;
        }
    } else {
        echo _SKINFILES_ERR_DOWNLOAD_FILE2;
    }

    exit;
}

/* View file *********************************************************************************************************************/

function _skinfiles_viewfile()
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && file_exists($directory . $file) &&
        is_file($directory . $file) && is_readable($directory . $file) && sfAllowViewing($file)) {
        $relative = sfRelativePath($directory);
        $viewUrl  = $manager->addTicketToUrl($pluginUrl . '?action=viewfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($viewUrl) . '" title="View &laquo;' . $file . '&raquo;">';
        echo '<img src="' . hsc(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

        echo '<h4>' . _SKINFILES_VIEW_FILE . '&laquo;' . hsc($file) . '&raquo;</h4>';

        if (sfIsFileType('html', $file)) {
            echo '<iframe src="' . sfFullUrl($directory . $file) . '"></iframe>';
        }

        if (sfIsFileType('text', $file)) {
            $content = implode('', file($directory . $file));

            echo '<pre>';
            echo hsc($content);
            echo '</pre>';
        }

        if (sfIsFileType('img', $file)) {
            $size = getimagesize($directory . $file, $info);

            switch ($size[2]) {
                case IMAGETYPE_GIF:
                    $type = 'GIF document';
                    break;
                case IMAGETYPE_JPEG:
                    $type = 'JPEG photograph';
                    break;
                case IMAGETYPE_PNG:
                    $type = 'PNG document';
                    break;
                case IMAGETYPE_SWF:
                    $type = 'Flash animation';
                    break;
                case IMAGETYPE_PSD:
                    $type = 'Photoshop document';
                    break;
                case IMAGETYPE_BMP:
                    $type = 'BMP document';
                    break;
                case IMAGETYPE_TIFF_II:
                    $type = 'TIFF document (Intel Byte Order)';
                    break;
                case IMAGETYPE_TIFF_MM:
                    $type = 'TIFF document (Motorola Byte Order)';
                    break;
                case IMAGETYPE_JPC:
                    $type = 'JPEG2000 photograph';
                    break;
                case IMAGETYPE_JP2:
                    $type = 'JPEG2000 photograph';
                    break;
                case IMAGETYPE_JPX:
                    $type = 'JPEG2000 photograph';
                    break;
                case IMAGETYPE_JB2:
                    $type = 'Slowview document';
                    break;
                case IMAGETYPE_SWC:
                    $type = 'Flash animation (compressed)';
                    break;
                case IMAGETYPE_IFF:
                    $type = 'IFF document';
                    break;
                case IMAGETYPE_WBMP:
                    $type = 'WBMP document';
                    break;
                case IMAGETYPE_XBM:
                    $type = 'XBM document';
                    break;
                default:
                    $type = 'Unknown document';
                    break;
            }

            if ($size[2] == IMAGETYPE_GIF || $size[2] == IMAGETYPE_JPEG ||
                $size[2] == IMAGETYPE_PNG) {
                echo '<p><img src="' . sfFullUrl($directory . $file) . '" alt="" /></p>';
            }

            echo '<table>';
            echo '<tr><th colspan="2">' . _SKINFILES_VIEW_FILE_IMG_INFO . '</th></tr>';
            echo '<tr><td>' . _SKINFILES_VIEW_FILE_TYPE . '</td><td>' . hsc($type) . '</td></tr>';
            echo '<tr><td>' . _SKINFILES_VIEW_FILE_WIDTH . '</td><td>' . hsc($size[0]) . _SKINFILES_VIEW_FILE_PX . '</td></tr>';
            echo '<tr><td>' . _SKINFILES_VIEW_FILE_HEIGHT . '</td><td>' . hsc($size[1]) . _SKINFILES_VIEW_FILE_PX . '</td></tr>';

            if (isset($size['channels']) || isset($size['bits'])) {
                $channels = isset($size['channels']) ? $size['channels'] : 3;
                $depth    = $size[2] == IMAGETYPE_GIF ? $size['bits'] : $size['bits'] * $channels;
                echo '<tr><td>' . _SKINFILES_VIEW_FILE_CHANNELS . '</td><td>' . hsc($channels) . '</td></tr>';
                echo '<tr><td>' . _SKINFILES_VIEW_FILE_COLOR_DEPTH . '</td><td>' . hsc($depth) . _SKINFILES_VIEW_FILE_BITS . '</td></tr>';
                echo '<tr><td>' . _SKINFILES_VIEW_FILE_COLORS . '</td><td>' . hsc(pow(2, $depth)) . _SKINFILES_VIEW_FILE_COLORS2 . '</td></tr>';
            }

            if (function_exists('exif_read_data') && ($size[2] == IMAGETYPE_JPEG ||
                $size[2] == IMAGETYPE_TIFF_II || $size[2] == IMAGETYPE_TIFF_MM)) {
                $exif = exif_read_data($directory . $file, 'EXIF');

                if ($exif) {
                    echo '<tr><th colspan="2">Exif information</th></tr>';

                    if (isset($exif['Make']) && isset($exif['Model'])) {
                        echo '<tr><td>Camera:</td><td>' . hsc($exif['Make'] . ' ' . $exif['Model']) . '</td></tr>';
                    }

                    if (isset($exif['DateTime'])) {
                        echo '<tr><td>Created on:</td><td>' . hsc($exif['DateTime']) . '</td></tr>';
                    }

                    if (isset($exif['XResolution'])) {
                        echo '<tr><td>Horizontal resolution:</td><td>' . hsc(_skinfiles_exif_prepare($exif['XResolution'])) . ' dpi</td></tr>';
                    }

                    if (isset($exif['YResolution'])) {
                        echo '<tr><td>Vertical resolution:</td><td>' . hsc(_skinfiles_exif_prepare($exif['YResolution'])) . ' dpi</td></tr>';
                    }

                    if (isset($exif['FocalLength'])) {
                        echo '<tr><td>Focal length:</td><td>' . hsc(_skinfiles_exif_prepare($exif['FocalLength'])) . ' mm</td></tr>';
                    }

                    if (isset($exif['FNumber'])) {
                        echo '<tr><td>F-number:</td><td>F/' . hsc(_skinfiles_exif_prepare($exif['FNumber'])) . '</td></tr>';
                    }

                    if (isset($exif['ExposureTime'])) {
                        echo '<tr><td>Exposuretime:</td><td>' . hsc(_skinfiles_exif_prepare($exif['ExposureTime'])) . ' sec</td></tr>';
                    }

                    if (isset($exif['ISOSpeedRatings'])) {
                        echo '<tr><td>ISO-speed:</td><td>' . hsc(_skinfiles_exif_prepare($exif['ISOSpeedRatings'])) . '</td></tr>';
                    }
                }
            }

            echo '</table>';
        }
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_VIEW_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_VIEW_FILE2;
        echo _SKINFILES_ERR_VIEW_FILE3 . "</p>";
    }
}

function _skinfiles_exif_prepare($value)
{
    if (preg_match('#([0-9]+)/([0-9]+)#', $value, $matches)) {
        if ($matches[1] < $matches[2]) {
            return '1/' . round($matches[2] / $matches[1]);
        } else {
            return round($matches[1] / $matches[2]);
        }
    } else {
        return $value;
    }
}

/* Edit file *********************************************************************************************************************/

function _skinfiles_editfile()
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && file_exists($directory . $file) &&
        is_file($directory . $file) && is_writable($directory . $file) && sfAllowEditing($file)) {
        $relative = sfRelativePath($directory);
        $editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=editfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($editUrl) . '" title="Edit &laquo;' . $file . '&raquo;">';
        echo '<img src="' . hsc(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

        $content = implode('', file($directory . $file));

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="editfile_process" />';
        echo '<input type="hidden" name="file" value="' . hsc(sfRelativePath($directory . $file)) . '" />';

        echo '<h4>' . _SKINFILES_EDIT_FILE_MSG . ' &laquo;' . hsc($file) . '&raquo;</h4><div>';
        echo '<p><textarea class="skinedit" tabindex="8" rows="20" cols="80" name="content">';
        echo hsc($content);
        echo '</textarea></p>';

        echo '<p class="buttons">';
        echo '<input type="hidden" name="sure" value="yes" /">';
        echo '<input type="submit" value="' .  _SKINFILES_SAVE_CHANGES . '" />';
        echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
        echo '</p>';
        echo '</div></form></div>';
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_EDIT_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_EDIT_FILE2;
        echo _SKINFILES_ERR_EDIT_FILE3 . "</p>";
    }
}

function _skinfiles_editfile_process()
{
    global $manager;
    $skinfiles = $manager->getPlugin('NP_SkinFiles');
    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory) && file_exists($directory . $file) &&
            is_file($directory . $file) && is_writable($directory . $file) && sfAllowEditing($file)) {
            if ($skinfiles->getOption('generate_backup') == 'yes') {
                copy($directory . $file, $directory . $skinfiles->getOption('backup_prefix') . $file);
            }
            $content = postVar('content');
            $success = false;

            if ($fh = @fopen($directory . $file, 'wb')) {
                if (@fwrite($fh, $content) !== false) {
                    $success = true;
                }

                @fclose($fh);
            }

            if ($success) {
                echo "<p class='message'>" . _SKINFILES_ERR_EDIT_FILE4 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_EDIT_FILE5 . "</p>";
            } else {
                echo "<p class='error'>" . _SKINFILES_ERR_EDIT_FILE6 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_EDIT_FILE7 . "</p>";
            }

            /* begin modification by katsumi */
            if ($success && strlen($content) == 0) {
                _skinfiles_delbutton('file', trim(requestVar('file')));
            }
            /* end modification */
            _skinfiles_editfile();
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_EDIT_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_EDIT_FILE2;
            echo _SKINFILES_ERR_EDIT_FILE3 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory);
    }
}

/* Rename file *******************************************************************************************************************/

function _skinfiles_renfile($preset = '')
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && file_exists($directory . $file) &&
        is_file($directory . $file) && is_writable($directory . $file)) {
        $relative = sfRelativePath($directory);
        $editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=renfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($editUrl) . '" title="' . _SKINFILES_RENAME . ' &laquo;' . $file . '&raquo;">';
        echo '<img src="' . hsc(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="renfile_process" />';
        echo '<input type="hidden" name="file" value="' . hsc(sfRelativePath($directory . $file)) . '" />';

        echo '<h4>' . _SKINFILES_RENAME_FILE_MSG . '&laquo;' . hsc($file) . '&raquo; ' . _SKINFILES_RENAME_FILE_MSG2 . '</h4><div>';
        echo '<p><input type="text" name="name" size="40" value="' . hsc($preset != '' ? $preset : $file) . '" /></p>';
        echo '<p class="buttons">';
        echo '<input type="hidden" name="sure" value="yes" /">';
        echo '<input type="submit" value="' . _SKINFILES_RENAME . '" />';
        echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
        echo '</p>';
        echo '</div></form></div>';
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_RENAME_FILE2;
        echo _SKINFILES_ERR_RENAME_FILE3 . "</p>";
    }
}

function _skinfiles_renfile_process()
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory) && file_exists($directory . $file) &&
            is_file($directory . $file) && is_writable($directory . $file)) {
            $name = requestVar('name');

            if ($name == '') {
                echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE4 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_RENAME_FILE5 . "</p>";
                _skinfiles_renfile($name);
                return;
            }

            if (sfIllegalFilename($name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE6 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_RENAME_FILE7 . "</p>";
                _skinfiles_renfile($name);
                return;
            }

            if ($name == $file) {
                echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE8 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_RENAME_FILE9 . "</p>";
                _skinfiles_renfile($name);
                return;
            }

            if (file_exists($directory . $name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE10 . "&laquo;" . hsc($file) . "&raquo; ";
                echo _SKINFILES_ERR_RENAME_FILE11;
                echo _SKINFILES_ERR_RENAME_FILE12 . "</p>";
                _skinfiles_renfile($name);
                return;
            }

            if (!@rename($directory . $file, $directory . $name)) {
                echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE13 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_RENAME_FILE14 . "</p>";
                _skinfiles_renfile($name);
                return;
            }

            echo "<p class='message'>" . _SKINFILES_ERR_RENAME_FILE15 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_RENAME_FILE16;
            echo _SKINFILES_ERR_RENAME_FILE17 . "&laquo;" . hsc($name) . "&raquo;" . _SKINFILES_ERR_RENAME_FILE18 . "</p>";
            sfShowDirectory($directory);
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_RENAME_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_RENAME_FILE2;
            echo _SKINFILES_ERR_RENAME_FILE3 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory);
    }
}

/* Create file *******************************************************************************************************************/

function _skinfiles_createfile()
{
    $directory = trim(requestVar('dir'));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) {
        $name = requestVar('name');

        if ($name == '') {
            echo "<p class='error'>" . _SKINFILES_ERR_CREATE_FILE1 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (sfIllegalFilename($name)) {
            echo "<p class='error'>" . _SKINFILES_ERR_CREATE_FILE2 . "&laquo;" . hsc($name) . "&raquo; ";
            echo _SKINFILES_ERR_CREATE_FILE3 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (file_exists($directory . $name)) {
            echo "<p class='error'>" . _SKINFILES_ERR_CREATE_FILE4 . "&laquo;" . hsc($name) . "&raquo; ";
            echo _SKINFILES_ERR_CREATE_FILE5;
            echo _SKINFILES_ERR_CREATE_FILE6 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (!@touch($directory . $name)) {
            echo "<p class='error'>" . _SKINFILES_ERR_CREATE_FILE7 . "&laquo;" . hsc($name) . "&raquo; " . _SKINFILES_ERR_CREATE_FILE8 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        $mask = @umask(0000);
        @chmod($directory . $name, 0755);
        @umask($mask);

        echo "<p class='message'>" . _SKINFILES_ERR_CREATE_FILE9 . "&laquo;" . hsc($name) . "&raquo; " . _SKINFILES_ERR_CREATE_FILE10 . "</p>";
        sfShowDirectory($directory);
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_CREATE_FILE11 . "&laquo;" . hsc(_skinfiles_basename($directory)) . "&raquo; " . _SKINFILES_ERR_CREATE_FILE12;
        echo _SKINFILES_ERR_CREATE_FILE13 . "</p>";
    }
}

/* Delete file *******************************************************************************************************************/

function _skinfiles_delfile()
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && file_exists($directory . $file) &&
        is_file($directory . $file) && is_writable($directory . $file)) {
        $relative = sfRelativePath($directory);
        $delUrl   = $manager->addTicketToUrl($pluginUrl . '?action=delfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

        echo '<p class="location">' . _SKINFILES_CURRENT_LOCATION . sfDisplayPath($relative);
        echo '<a href="' . hsc($delUrl) . '" title="' . _SKINFILES_DELETE . ' &laquo;' . $file . '&raquo;">';
        echo '<img src="' . hsc(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

        echo '<div class="dialogbox">';
        echo '<form method="post" action="' . hsc($pluginUrl) . '">';
        $manager->addTicketHidden();
        echo '<input type="hidden" name="action" value="delfile_process" />';
        echo '<input type="hidden" name="file" value="' . hsc(sfRelativePath($directory . $file)) . '" />';

        echo '<h4>' . _SKINFILES_DELETE_FILE . ' &laquo;' . hsc($file) . '&raquo; ' . _SKINFILES_DELETE_FILE2 . '</h4><div>';
        echo '<p class="buttons">';
        echo '<input type="hidden" name="sure" value="yes" />';
        echo '<input type="submit" value="' . _SKINFILES_DELETE . '" />';
        echo '<input type="button" name="sure" value="' . _SKINFILES_CANCEL . '" onclick="history.back();" />';
        echo '</p>';
        echo '</div></form></div>';
    } else {
        echo "<p class='error'>"  . _SKINFILES_ERR_DELETE_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_FILE2;
        echo _SKINFILES_ERR_DELETE_FILE3 . "</p>";
    }
}

function _skinfiles_delfile_process()
{
    global $pluginUrl, $manager;

    $file      = _skinfiles_basename(trim(requestVar('file')));
    $directory = dirname(trim(requestVar('file')));
    $directory = sfExpandDirectory($directory);

    if (requestVar('sure') == 'yes') {
        if (sfValidPath($directory) && file_exists($directory . $file) &&
            is_file($directory . $file) && is_writable($directory . $file)) {
            if (!@unlink($directory . $file)) {
                echo "<p class='error'>" . _SKINFILES_ERR_DELETE_FILE4 . "&laquo;" . hsc($file) . "&raquo;</p>";
                sfShowDirectory($directory);
                return;
            }

            echo "<p class='message'>" . _SKINFILES_ERR_DELETE_FILE5 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_FILE6 . "</p>";

            /* begin modification by katsumi */
            $num = 0;
            $d   = dir($directory);
            while (false !== ($entry = $d->read())) {
                if ($entry != '.' && $entry != '..') {
                    $num++;
                }
            }
            $d->close();
            if ($num == 0) {
                _skinfiles_delbutton('dir', dirname(trim(requestVar('file'))));
            }
            /* end modification */

            sfShowDirectory($directory);
        } else {
            echo "<p class='error'>" . _SKINFILES_ERR_DELETE_FILE1 . "&laquo;" . hsc($file) . "&raquo; " . _SKINFILES_ERR_DELETE_FILE2;
            echo _SKINFILES_ERR_DELETE_FILE3 . "</p>";
        }
    } else {
        // User cancelled
        sfShowDirectory($directory);
    }
}

/* Upload file *******************************************************************************************************************/

function _skinfiles_uploadfile()
{
    global $pluginUrl, $manager, $CONF;

    $directory = trim(requestVar('dir'));
    $directory = sfExpandDirectory($directory);

    if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) {
        $file = postFileInfo('name');

        if ($file['size'] > $CONF['MaxUploadSize']) {
            echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE1 . "&laquo;" . hsc($file['name']) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE2 . _ERROR_FILE_TOO_BIG . "<br />";
            echo _SKINFILES_ERR_UPLOAD_FILE3 . $CONF['MaxUploadSize'] . " / ";
            echo $file['size'] . " bytes</p>";
            sfShowDirectory($directory);
            return;
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE1 . "&laquo;" . hsc($file['name']) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE2 . _ERROR_BADREQUEST .  _SKINFILES_ERR_UPLOAD_FILE4 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (sfIllegalFilename($file['name'])) {
            echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE5 . "&laquo;" . hsc($file['name']) . "&raquo; ";
            echo _SKINFILES_ERR_UPLOAD_FILE6 . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (file_exists($directory . $file['name'])) {
            echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE1 . "&laquo;" . hsc($file['name']) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE2 . _ERROR_UPLOADDUPLICATE . "</p>";
            sfShowDirectory($directory);
            return;
        }

        if (!@move_uploaded_file($file['tmp_name'], $directory . $file['name'])) {
            echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE1 . "&laquo;" . hsc($file['name']) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE2 . _ERROR_UPLOADMOVEP . _SKINFILES_ERR_UPLOAD_FILE4 . "</p>";
            sfShowDirectory($directory);
        }

        $mask = @umask(0000);
        @chmod($directory . $file['name'], 0755);
        @umask($mask);

        echo "<p class='message'>" . _SKINFILES_ERR_UPLOAD_FILE7 . "&laquo;" . hsc($file['name']) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE8 . "</p>";
        sfShowDirectory($directory);
    } else {
        echo "<p class='error'>" . _SKINFILES_ERR_UPLOAD_FILE9 . "&laquo;" . hsc(_skinfiles_basename($directory)) . "&raquo; " . _SKINFILES_ERR_UPLOAD_FILE10;
        echo _SKINFILES_ERR_UPLOAD_FILE11 . "</p>";
    }
}

/* begin modification by katsumi */
/* Delete file/directory buttons when empty *******************************************************************************************************************/

function _skinfiles_delbutton($mode, $path)
{
    global $pluginUrl,$manager;
    echo '<p><form method="post" action="' . hsc($pluginUrl) . '">';
    $manager->addTicketHidden();
    switch ($mode) {
        case 'file':
            echo _SKINFILES_02;
            echo '<input type="hidden" name="action" value="delfile_process" />';
            echo '<input type="hidden" name="file" value="'.hsc($path).'" />';
            break;
        case 'dir':
        default:
            echo 'The directory is empty.';
            echo '<input type="hidden" name="action" value="deldir_process" />';
            echo '<input type="hidden" name="dir" value="'.hsc($path).'" />';
    }
    echo '<input type="hidden" name="sure" value="yes" />';
    echo '<input type="submit" value="'._SKINFILES_DELETE.'" />';
    echo "</form></p>\n";
}
/* end modification */

function _skinfiles_basename($name)
{
    if ((strtolower(_CHARSET) != 'utf-8') && function_exists('mb_convert_encoding')) {
        $name = mb_convert_encoding($name, "UTF-8", _CHARSET);
    }
    $name = str_replace('\\', '/', $name); // Avoid using "\" in Windows.
    $name = rtrim($name, '/');
    $name = (function_exists('mb_split')) ? mb_split("/", $name) : explode("/", $name);
    $name = end($name); // Only variables can be passed by reference
    if ((strtolower(_CHARSET) != 'utf-8') && function_exists('mb_convert_encoding')) {
        $name = mb_convert_encoding($name, _CHARSET, "UTF-8");
    }
    return $name;
}
