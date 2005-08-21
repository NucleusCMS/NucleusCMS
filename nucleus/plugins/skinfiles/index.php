<?php

   /* ==========================================================================================
	* Nucleus SkinFiles Plugin
	*
	* Copyright 2005 by Jeff MacMichael and Niels Leenheer
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

 	$strRel = '../../../'; 
	include($strRel . 'config.php');
	include($DIR_LIBS . 'PLUGINADMIN.php');

	

	/**
	  * Create admin area
	  */

	$oPluginAdmin  = new PluginAdmin('SkinFiles');

	if (!($member->isLoggedIn() && $member->isAdmin()))
	{
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
	$pluginUrl 	   = $oPluginAdmin->plugin->getAdminURL();

	$filetypes = array (
		'text'	=> array ('inc', 'txt', 'css', 'js', 'php'),
		'html'	=> array ('htm', 'html'),
		'img'	=> array ('png', 'gif', 'jpg', 'jpeg', 'bmp', 'ico', 'swf'),
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

	$oPluginAdmin->start("<style type='text/css'>
	<!--
	
		div#content a {
			text-decoration: none;
		}
		div#content img {
			vertical-align: middle;
			margin-top: -3px;
		}
		p.message {
			font-weight: bold;
		}
		p.error {
			font-size: 100%;
			font-weight: bold;
			color: #880000;
		}
		pre {
			overflow: auto;
			height: 400px;
		}
		iframe {
			width: 100%;
			height: 400px;
			border: 1px solid gray;
		}
		div.dialogbox {
			border: 1px solid #ddd;
			background-color: #F6F6F6;
			margin: 18px 0 1.5em 0;
		}
		div.dialogbox h4 {
			background-color: #bbc;
			color: #000;
			margin: 0;
			padding: 5px;
		}
		div.dialogbox h4.light {
			background-color: #ddd;
		}
		div.dialogbox div {
			margin: 0;
			padding: 10px;
		}
		div.dialogbox button {
			margin: 10px 0 0 6px;
			float: right;
		}
		div.dialogbox p {
			margin: 0;
		}
		div.dialogbox p.buttons {
			text-align: right;
			overflow: auto;
		}
		div.dialogbox textarea {
			width: 100%;
			margin: 0;
		}
	
	-->
	</style>");
	
	echo "<h2>Skin File Management</h2>";
	
	$actions = array (
		'renfile', 'renfile_process', 'delfile', 'delfile_process', 
		'editfile', 'editfile_process', 'uploadfile', 'createfile', 'viewfile',
		'rendir', 'rendir_process', 'deldir', 'deldir_process',
		'emptydir', 'emptydir_process', 'createdir'
	);
	
	if (in_array($action, $actions)) 
	{ 
		if (!$manager->checkTicket())
		{
			echo '<p class="error">Error: ' . _ERROR_BADTICKET . '</p>';
			sfShowDirectory();
			
		} 
		else 
		{
			call_user_func('_skinfiles_' . $action);
		}
	} 
	else 
	{
		sfShowDirectory();
	}

	$oPluginAdmin->end();
	exit;
	
	





	/* Helper functions **************************************************************************************************************/

	function sfExpandDirectory ($path) {
	   /* IN:  relative directory
		* OUT: full path to directory
		*/

		global $rootDirectory;
		return sfRealPath($rootDirectory . $path);
	}
	
	function sfRealPath ($path) {
	   /* IN:  full path 
		* OUT: canonicalized absolute pathname
		*/

		$path = realpath($path);
		$path = str_replace('\\', '/', $path);	
		$path = substr($path, strlen($path) - 1) != '/' ? $path . '/' : $path;
		return $path;
	}

	function sfFullUrl ($path) {
	   /* IN:  full path including filename
		* OUT: url including filename
		*/

		global $rootDirectory, $rootUrl;
		
		$path = str_replace($rootDirectory, '', $path);
		$path = rawurlencode($path);
		$path = str_replace('%2F', '/', $path);
		return $rootUrl . $path;
	}

	function sfValidPath ($path) {
	   /* IN:  full path excluding or including filename
		* OUT: boolean, true if full path is or is within rootDirectory
		*/

		global $rootDirectory;
		return substr($path, 0, strlen($rootDirectory)) == $rootDirectory;
	}
	
	function sfRelativePath ($path) {
	   /* IN:  full path including or excluding filename
		* OUT: relative path from rootDirectory
		*/

		global $rootDirectory;
		return str_replace($rootDirectory, '', $path);
	}
	
	function sfIsFileType ($type, $file) {

		global $filetypes;
		return isset($filetypes[$type]) && in_array(strtolower(substr(strrchr($file, "."), 1)), $filetypes[$type]);
	}

	function sfAllowEditing ($file) {
		return sfIsFileType('html', $file) || sfIsFileType('text', $file);
	}
	
	function sfAllowViewing ($file) {
		return sfIsFileType('html', $file) || sfIsFileType('text', $file) || sfIsFileType('img', $file);
	}


	function sfDisplayPath ($relative) {
	
		global $pluginUrl;
		
		$result  = '<a href="' . htmlspecialchars($pluginUrl) . '" title="Go back to &laquo;skins&raquo;">';
		$result .= '<img src="' . htmlspecialchars($pluginUrl . 'home.gif') . '" alt="" /> skins</a> / ';

		$parts = explode('/', $relative);
		$part = '';
		
		while (list(,$v) = each ($parts)) {
			if ($v != '') {
				$part .= $v . '/';
				
				$result .= '<a href="' . htmlspecialchars($pluginUrl . '?dir=' . rawurlencode($part)) . '" ';
				$result .= 'title="Go back to &laquo;' . htmlspecialchars($v) . '&raquo;">';
				$result .= '<img src="' . htmlspecialchars($pluginUrl . 'dir.gif') . '" alt="" /> ';
				$result .= htmlspecialchars($v) . '</a> / ';
			}
		}
		
		return $result;
	}

	function sfIcon ($file) {
	
		global $pluginUrl;
	
		$ext = strtolower(substr(strrchr($file, "."), 1));
		
		switch ($ext) {
			case 'htm':
			case 'html':
				return $pluginUrl . 'html.gif';
				break;

			case 'txt':
			case 'js':
			case 'css':
			case 'inc':
				return $pluginUrl . 'text.gif';
				break;

			case 'gif':
			case 'png':
			case 'jpg':
			case 'jpeg':
			case 'bmp':
			case 'xbmp':
			case 'ico':
				return $pluginUrl . 'image.gif';
				break;

			case 'php':
			case 'php3':
			case 'php4':
				return $pluginUrl . 'php.gif';
				break;
				
			default:
				return $pluginUrl . 'generic.gif';
				break;
		}
	}

	function sfIllegalFilename($name) {
		return preg_match('#[\n\r\\\/\:\*\?\"\<\>\|]#', $name);
	}

	function sfDirectoryIsEmpty($dir) {
		
		$count = 0;
		
		if ($dh = opendir($dir)) 
		{
   			while (($file = readdir($dh)) !== false) 
       			$count++;
      			
			closedir($dh);
		}
		
		// $count must be smaller or equal than 2, because '.' 
		// and '..' are always returned by readdir().
		return $count <= 2;
	}









	/* Show directory ****************************************************************************************************************/

	function sfShowDirectory($default = '') {

		global $pluginUrl, $rootDirectory, $CONF, $manager;
		
		$directory = $default != '' ? 
			$default : 
			sfExpandDirectory(trim(requestVar('dir')));
		
		if (!sfValidPath($directory) || !is_dir($directory)) {
			$directory = $rootDirectory;
		}

		$relative  = sfRelativePath ($directory);
		
		echo '<p class="location">Current location: ' . sfDisplayPath($relative) . '</p>';			

			
		$dirs = array();
		$files = array();

		if ($dh = @opendir($directory)) { 
			while (($file = readdir($dh)) !== false) { 
				if (!preg_match("/^\.{1,2}$/", $file)) {
					$fstat = @stat($directory . $file);
				
					if ($fstat['mode'] & 040000)
						$dirs[$file] = $fstat;
					else
						$files[$file] = $fstat;
				}
			}
			closedir($dh); 
		} 			
		
		ksort($dirs);
		ksort($files);
		
		echo '<table><thead><tr>';
		echo '<th>Name</th><th>Size</th><th>Last modified</th><th colspan="4">Actions</th>';
		echo '</tr></thead>';

		while (list($name, $stat) = each($dirs)) {
			
			$dir = sfRelativePath($directory . $name . '/');
				
			echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);"><td>';
			
			if (is_readable ($directory . $name)) 
			{
				echo '<a href="' . htmlspecialchars($pluginUrl . '?dir=' . rawurlencode($dir)) . '">';
				echo '<img src="' . htmlspecialchars($pluginUrl . 'dir.gif') . '" alt="folder" /> ';
				echo htmlspecialchars($name).'</a>';			
			}
			else
			{
				echo '<img src="' . htmlspecialchars($pluginUrl . 'dir.gif') . '" alt="folder" /> ';
				echo htmlspecialchars($name);			
			}
						
			echo '</td>';
				
			$renUrl = $manager->addTicketToUrl($pluginUrl . '?action=rendir&dir=' . rawurlencode($dir));
			$delUrl = $manager->addTicketToUrl($pluginUrl . '?action=deldir&dir=' . rawurlencode($dir));
				
			echo '<td>&ndash;</td>';
			echo '<td>' . date('M d Y, H:i', $stat['mtime']);
			
			
			if (is_writable($directory . $name)) {
				echo '<td><a href="' . htmlspecialchars($renUrl) . '" title="Rename &laquo;' . htmlspecialchars($name) . '&raquo;">Rename</a></td>';
			} else {
				echo '<td>&nbsp;</td>';
			}
			
			if (is_writable($directory . $name) && sfDirectoryIsEmpty($directory . $name)) {
				echo '<td><a href="' . htmlspecialchars($delUrl) . '" title="Delete &laquo;' . htmlspecialchars($name) . '&raquo;">Delete</a></td>';
			} else {
				echo '<td>&nbsp;</td>';
			}
			
			echo '<td>&nbsp;</td><td>&nbsp;</td>';
			echo '</tr>';
		}


		while (list($name, $stat) = each($files)) {

			$file = sfRelativePath($directory . $name);

			$renUrl   = $manager->addTicketToUrl($pluginUrl . '?action=renfile&file='  . rawurlencode($file));
			$delUrl   = $manager->addTicketToUrl($pluginUrl . '?action=delfile&file='  . rawurlencode($file));
			$editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=editfile&file=' . rawurlencode($file));
			$viewUrl  = $manager->addTicketToUrl($pluginUrl . '?action=viewfile&file=' . rawurlencode($file));
			$dlUrl 	  = $manager->addTicketToUrl($pluginUrl . '?action=download&file=' . rawurlencode($file));

			echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);"><td>';
			
			if (is_readable ($directory . $name) && sfAllowViewing($name)) 
			{
				echo '<a href="' . htmlspecialchars($viewUrl) . '">';
				echo '<img src="' . htmlspecialchars(sfIcon($name)) . '" alt="" /> ';
				echo htmlspecialchars($name).'</a>';
			}
			else
			{
				echo '<img src="' . htmlspecialchars(sfIcon($name)) . '" alt="" /> ';
				echo htmlspecialchars($name);
			}

			echo '</td><td>';
			echo ceil($stat['size'] / 1024) . ' kB';
			echo '</td><td>';
			echo date('M d Y, H:i', $stat['mtime']);
			echo '</td><td>';
				
			if (is_writable($directory . $name)) {
				echo '<a href="' . htmlspecialchars($renUrl) . '" title="Rename &laquo;' . htmlspecialchars($name) . '&raquo;">Rename</a>';
			} else {
				echo '&nbsp;';
			}
				
			echo '</td><td>';

			if (is_writable($directory . $name)) {
				echo '<a href="' . htmlspecialchars($delUrl) . '" title="Delete &laquo;' . htmlspecialchars($name) . '&raquo;">Delete</a>';
			} else {
				echo '&nbsp;';
			}
				
			echo '</td><td>';
			
			if (is_writable($directory . $name) && sfAllowEditing($name))
				echo '<a href="'. htmlspecialchars($editUrl) . '" title="Edit &laquo;' . htmlspecialchars($name) . '&raquo;">Edit</a>';
			else
				echo '&nbsp;';

			echo '</td><td>';
			
			if (is_readable ($directory . $name))
				echo '<a href="' . htmlspecialchars($dlUrl) . '" title="Download &laquo;' . htmlspecialchars($name) . '&raquo;">Download</a>';
			else
				echo '&nbsp;';
				
			echo '</td></tr>';
		}

		if (!count($dirs) && !count($files)) {
			echo '<tr><td colspan="7">This directory does not contain any files or directories</td></tr>';
		}

		echo '</table>';

		if ($relative != '') {
		
			if (is_writable($directory)) {
				echo '<div class="dialogbox">';
				echo '<h4 class="light">Create a new file</h4><div>';
				echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
				$manager->addTicketHidden();
				echo '<input type="hidden" name="action" value="createfile" />';
				echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative) . '" />';
				echo '<input type="text" name="name" size="40" value="untitled.txt" />';
				echo '<p class="buttons"><input type="submit" value="Create file" /></p></form>';
				echo '</div></div>';
	
				echo '<div class="dialogbox">';
				echo '<h4 class="light">Upload new file</h4><div>';
				echo '<form method="post" enctype="multipart/form-data" action="' . htmlspecialchars($pluginUrl) . '">';
				$manager->addTicketHidden();
				echo '<input type="hidden" name="action" value="uploadfile" />';
				echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative) . '" />';
				echo '<input type="hidden" name="MAX_FILE_SIZE" value="' . $CONF['MaxUploadSize'] . '" />';
				echo '<input type="file" name="name" size="40" />';
				echo '<p class="buttons"><input type="submit" value="Upload" /></p></form>';
				echo '</div></div>';
			}
	
			if (count($files)) {
				echo '<div class="dialogbox">';
				echo '<h4 class="light">Delete all files in this directory</h4><div>';
				echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
				$manager->addTicketHidden();
				echo '<input type="hidden" name="action" value="emptydir" />';
				echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative) . '" />';
				echo 'Delete all files? (will ask for confirmation)';
				echo '<p class="buttons"><input type="submit" value="Delete All" tabindex="140" onclick="return checkSubmit();" /></p>';
				echo '</form>';
				echo '</div></div>';
			}
		}
	
		if (is_writable($directory)) {
			echo '<div class="dialogbox">';
			echo '<h4 class="light">Create a new directory</h4><div>';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="createdir" />';
			echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative) . '" />';
			echo '<input type="text" name="name" value="untitled" tabindex="90" size="40" />';
			echo '<p class="buttons"><input type="submit" value="Create" tabindex="140" onclick="return checkSubmit();" /></p>';
			echo '</form>';
			echo '</div></div>';
		}
	}
	
	
	

	/* Rename directory **************************************************************************************************************/

	function _skinfiles_rendir($preset = '') {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory . $file) && file_exists($directory . $file) && 
			is_dir($directory . $file) && is_writable($directory . $file)) 
		{
			$relative = sfRelativePath ($directory);
			$editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=rendir&dir=' . rawurlencode($relative . $file));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($editUrl) . '" title="Rename &laquo;' . $file . '&raquo;">';
			echo '<img src="' . $pluginUrl . 'dir.gif' . '" alt="" /> ' . $file . '</a></p>';

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="rendir_process" />';
			echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative . $file) . '" />';

			echo '<h4>Rename directory &laquo;' . htmlspecialchars($file) . '&raquo; to:</h4><div>';
			echo '<p><input type="text" name="name" size="40" value="' . htmlspecialchars($preset != '' ? $preset : $file) . '" /></p>';
			echo '<p class="buttons"><button name="sure" value="yes" onclick="return checkSubmit();">Rename</button>';
			echo '<button name="sure" value="no">Cancel</button></p></div>';
			echo '</form>';
			echo '</div>';
		}
		else
		{
			echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to rename the directory</p>";
		}
	}
	
	function _skinfiles_rendir_process() {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory . $file) && file_exists($directory . $file) && 
				is_dir($directory . $file) && is_writable($directory . $file)) 
			{
				$name = requestVar('name');
				
				if ($name == '') {
					echo "<p class='error'>Error: Could not rename the directory &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because no new name was supplied.</p>";
					_skinfiles_rendir($name);
					return;
				}
				
				if (sfIllegalFilename($name)) {
					echo "<p class='error'>Error: Could not rename the directory &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied name contains one or more illegal characters</p>";
					_skinfiles_rendir($name);
					return;
				} 
				
				if ($name == $file) {
					echo "<p class='error'>Error: Could not rename the directory &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied name is the same as the original name. Please use a different name.</p>";
					_skinfiles_rendir($name);
					return;
				}
				
				if (file_exists($directory . $name)) {
					echo "<p class='error'>Error: Could not rename the directory &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied name is already used by another file or directory. Consider using a different name, or ";
					echo "delete the existing file or directory first</p>";
					_skinfiles_rendir($name);
					return;
				}
				
				if (!@rename($directory . $file, $directory . $name)) 
				{
					echo "<p class='error'>Error: Could not rename the directory &laquo;" . htmlspecialchars($file) . "&raquo;</p>";
					_skinfiles_rendir($name);
					return;
				}
	
				echo "<p class='message'>Message: The directory &laquo;" . htmlspecialchars($file) . "&raquo; has been renamed ";
				echo "to &laquo;" . htmlspecialchars($name) . "&raquo;</p>";
				sfShowDirectory($directory);
			} 		
			else
			{
				echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to rename the directory</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory);
		}
	}




	/* Create directory **************************************************************************************************************/

	function _skinfiles_createdir() {
	
		$directory = trim(requestVar('dir'));
		$directory = sfExpandDirectory($directory);

		if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) 
		{
			$name = requestVar('name');
			
			if ($name == '') {
				echo "<p class='error'>Error: Could not create a new directory because there was no name supplied</p>";
				sfShowDirectory($directory);
				return;
			}
			
			if (sfIllegalFilename($name)) {
				echo "<p class='error'>Error: Could not create the directory &laquo;" . htmlspecialchars($name) . "&raquo; ";
				echo "because the supplied name contains one or more illegal characters</p>";
				sfShowDirectory($directory);
				return;
			} 
			
			if (file_exists($directory . $name)) {
				echo "<p class='error'>Error: Could not create the directory &laquo;" . htmlspecialchars($name) . "&raquo; ";
				echo "because the supplied name is already used by another file or directory. Consider using a different name, or ";
				echo "delete the existing file or directory first</p>";
				sfShowDirectory($directory);
				return;
			}
			
			$mask = @umask(0000);

			if (!@mkdir($directory . $name, 0755)) 
			{
				echo "<p class='error'>Error: Could not create the directory &laquo;" . htmlspecialchars($name) . "&raquo;</p>";
				sfShowDirectory($directory);
				return;
			}

			@umask($mask);
			
			echo "<p class='message'>Message: The directory &laquo;" . htmlspecialchars($name) . "&raquo; has been created</p>";
			sfShowDirectory($directory);
		} 		
		else
		{
			echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars(basename($directory)) . "&raquo;  does not exist ";
			echo "or you do not have permission to access that directory</p>";
		}
	}
	
	
	

	/* Delete directory **************************************************************************************************************/

	function _skinfiles_deldir() {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory . $file) && file_exists($directory . $file) && 
			is_dir($directory . $file) && is_writable($directory . $file) &&
			sfDirectoryIsEmpty($directory . $file)) 
		{
			$relative = sfRelativePath ($directory);
			$delUrl  = $manager->addTicketToUrl($pluginUrl . '?action=deldir&dir=' . rawurlencode($relative . $file));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($delUrl) . '" title="Delete &laquo;' . $file . '&raquo;">';
			echo '<img src="' . $pluginUrl . 'dir.gif' . '" alt="" /> ' . $file . '</a></p>';

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="deldir_process" />';
			echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative . $file) . '" />';

			echo '<h4>Delete directory &laquo;' . htmlspecialchars($file) . '&raquo;?</h4><div>';
			echo '<p class="buttons"><button name="sure" value="yes">Delete</button>';
			echo '<button name="sure" value="no">Cancel</button></p>';

			echo '</div></form></div>';
		}
		else
		{
			echo "<p class='error'>Error: The directory  &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to delete the directory</p>";
		}
	}
	
	function _skinfiles_deldir_process() {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory . $file) && file_exists($directory . $file) && 
				is_dir($directory . $file) && is_writable($directory . $file) &&
				sfDirectoryIsEmpty($directory . $file)) 
			{
				if (!@rmdir($directory . $file)) 
				{
					echo "<p class='error'>Error: Could not delete the directory &laquo;" . htmlspecialchars($file) . "&raquo;</p>";
					sfShowDirectory($directory);
					return;
				}
	
				echo "<p class='message'>Message: The directory &laquo;" . htmlspecialchars($file) . "&raquo; has been deleted</p>";
				sfShowDirectory($directory);
			} 		
			else
			{
				echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to delete the directory</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory);
		}
	}	
	
	
	
	
	/* Empty directory ***************************************************************************************************************/

	function _skinfiles_emptydir() {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory . $file) && file_exists($directory . $file) && is_dir($directory . $file)) 
		{
			$files = array();
	
			if ($dh = @opendir($directory . $file)) 
			{ 
				while (($name = readdir($dh)) !== false) {
					if(!preg_match("/^\.{1,2}$/", $name) && 
					   !is_dir($directory . $file . '/' . $name) &&
					   is_writable($directory . $file . '/' . $name)) 
							$files[] = $name;
				}
				
				closedir($dh); 
				sort($files);
			}
			
			$relative = sfRelativePath ($directory);
			$emptyUrl  = $manager->addTicketToUrl($pluginUrl . '?action=emptydir&dir=' . rawurlencode($relative . $file));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($emptyUrl) . '" title="Empty &laquo;' . $file . '&raquo;">';
			echo '<img src="' . $pluginUrl . 'dir.gif' . '" alt="" /> ' . $file . '</a></p>';

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="emptydir_process" />';
			echo '<input type="hidden" name="dir" value="' . htmlspecialchars($relative . $file) . '" />';

			echo '<h4>Delete the following files from directory &laquo;' . htmlspecialchars($file) . '&raquo;?</h4><div>';
			
			if (count($files)) 
			{
				echo '<ul>';
				foreach ($files as $name) {	echo '<li>' . htmlspecialchars($name) . '</li>'; }
				echo '</ul>';
	
				echo '<p class="buttons"><button name="sure" value="yes">Delete</button>';
				echo '<button name="sure" value="no">Cancel</button></p>';
			}
			else
			{
				echo '<p>There are currently no files in this directory that can be deleted</p>';
				echo '<p class="buttons"><button name="sure" value="no">Cancel</button></p>';
			}
			
			echo '</div></form></div>';
			
		}
		else
		{
			echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to access that directory</p>";
		}
	}

	function _skinfiles_emptydir_process() {

		global $pluginUrl, $manager;
		
		$file      = trim(basename(requestVar('dir')));
		$directory = trim(dirname(requestVar('dir')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory . $file) && file_exists($directory . $file) && is_dir($directory . $file)) 
			{
				if ($dh = @opendir($directory . $file)) 
				{ 
					while (($name = readdir($dh)) !== false) 
					{
						if(!preg_match("/^\.{1,2}$/", $name) &&  !is_dir($directory . $file . '/' . $name) &&
						   is_writable($directory . $file . '/' . $name)) 
						{
							if (unlink ($directory .$file . '/' . $name)) 
								echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($name) . "&raquo; has been deleted</p>";
							else
								echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($name) . "&raquo; could not be deleted</p>";
						}
					}
					
					closedir($dh); 
	
					sfShowDirectory($directory . $file . '/');
				}
			}
			else
			{
				echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to access that directory</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory . $file . '/');
		}
	}




	/* Download file *****************************************************************************************************************/

	function _skinfiles_download() {

		global $pluginUrl, $manager;
		
		$file = basename(trim(requestVar('file')));

		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory) && file_exists($directory . $file) && 
			is_file($directory . $file) && is_readable($directory . $file)) 
		{
			if (strstr(serverVar('HTTP_USER_AGENT'), "MSIE"))
				$name = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);
			else
				$name = $file;
				
			if ($fp = @fopen($directory . $file, 'r')) {
				header("Cache-Control: ");	// leave blank to avoid IE errors
				header("Pragma: ");			// leave blank to avoid IE errors
				header("Content-type: application/octet-stream");
				header('Content-Disposition: attachment; filename="'.$name.'"');
				header("Content-length: ".(string)(filesize($directory . $file)));
				sleep(1);
				
				fpassthru($fp);
				fclose($fp);
			}
			else
			{
				echo "Error: Could not access the file";
			}
		}
		else
		{
			echo "Error: No permission to access the file";
		}

		exit;
	}




	/* View file *********************************************************************************************************************/

	function _skinfiles_viewfile() {

		global $pluginUrl, $manager;
		
		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory) && file_exists($directory . $file) && 
			is_file($directory . $file) && is_readable($directory . $file) && sfAllowViewing($file)) 
		{
			$relative = sfRelativePath ($directory);
			$viewUrl  = $manager->addTicketToUrl($pluginUrl . '?action=viewfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($viewUrl) . '" title="View &laquo;' . $file . '&raquo;">';
			echo '<img src="' . htmlspecialchars(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

			echo '<h4>View file &laquo;' . htmlspecialchars($file) . '&raquo;</h4>';

			if (sfIsFileType('html', $file))
			{
				echo '<iframe src="' . sfFullUrl($directory . $file) . '"></iframe>';
			}

			if (sfIsFileType('text', $file))
			{
				$content = implode('', file($directory . $file));

				echo '<pre>';
				echo htmlspecialchars($content);
				echo '</pre>';
			}

			if (sfIsFileType('img', $file))
			{
				$size = getimagesize($directory . $file, $info);
				
				switch ($size[2]) {
					case IMAGETYPE_GIF:	  	$type = 'GIF document'; break;
					case IMAGETYPE_JPEG:  	$type = 'JPEG photograph'; break;
					case IMAGETYPE_PNG:	  	$type = 'PNG document'; break;
					case IMAGETYPE_SWF:	  	$type = 'Flash animation'; break;
					case IMAGETYPE_PSD:	  	$type = 'Photoshop document'; break;
					case IMAGETYPE_BMP:	  	$type = 'BMP document'; break;
					case IMAGETYPE_TIFF_II: $type = 'TIFF document (Intel Byte Order)'; break;
					case IMAGETYPE_TIFF_MM: $type = 'TIFF document (Motorola Byte Order)'; break;
					case IMAGETYPE_JPC:	 	$type = 'JPEG2000 photograph'; break;
					case IMAGETYPE_JP2: 	$type = 'JPEG2000 photograph'; break;
					case IMAGETYPE_JPX: 	$type = 'JPEG2000 photograph'; break;
					case IMAGETYPE_JB2: 	$type = 'Slowview document'; break;
					case IMAGETYPE_SWC: 	$type = 'Flash animation (compressed)'; break;
					case IMAGETYPE_IFF: 	$type = 'IFF document'; break;
					case IMAGETYPE_WBMP: 	$type = 'WBMP document'; break;
					case IMAGETYPE_XBM: 	$type = 'XBM document'; break;
					default:				$type = 'Unknown document'; break;
				}

				if ($size[2] == IMAGETYPE_GIF || $size[2] == IMAGETYPE_JPEG ||
					$size[2] == IMAGETYPE_PNG)
				{
					echo '<p><img src="' . sfFullUrl($directory . $file) . '" alt="" /></p>';
				}
				
				echo '<table>';
				echo '<tr><th colspan="2">Image information</th></tr>';
				echo '<tr><td>Type:</td><td>' . htmlspecialchars($type) . '</td></tr>';
				echo '<tr><td>Width:</td><td>' . htmlspecialchars($size[0]) . ' px</td></tr>';
				echo '<tr><td>Height:</td><td>' . htmlspecialchars($size[1]) . ' px</td></tr>';	
				
				if (isset($size['channels']) || isset($size['bits'])) 
				{
					$channels = isset($size['channels']) ? $size['channels'] : 3;
					$depth    = $size[2] == IMAGETYPE_GIF ? $size['bits'] : $size['bits'] * $channels;
					echo '<tr><td>Channels:</td><td>' . htmlspecialchars($channels) . '</td></tr>';
					echo '<tr><td>Color depth:</td><td>' . htmlspecialchars($depth) . ' bits</td></tr>';
					echo '<tr><td>Colors:</td><td>' . htmlspecialchars(pow(2, $depth)) . ' colors</td></tr>';
				}

				
				if (function_exists('exif_read_data') && ($size[2] == IMAGETYPE_JPEG || 
					$size[2] == IMAGETYPE_TIFF_II || $size[2] == IMAGETYPE_TIFF_MM))
				{
					$exif = exif_read_data($directory . $file, 'EXIF');
					
					if ($exif) 
					{
						echo '<tr><th colspan="2">Exif information</th></tr>';
						
						if (isset($exif['Make']) && isset($exif['Model']))
							echo '<tr><td>Camera:</td><td>' . htmlspecialchars($exif['Make'] . ' ' . $exif['Model']) . '</td></tr>';
						
						if (isset($exif['DateTime']))
							echo '<tr><td>Created on:</td><td>' . htmlspecialchars($exif['DateTime']) . '</td></tr>';
						
						if (isset($exif['XResolution']))
							echo '<tr><td>Horizontal resolution:</td><td>' . htmlspecialchars(_skinfiles_exif_prepare($exif['XResolution'])) . ' dpi</td></tr>';
						
						if (isset($exif['YResolution']))
							echo '<tr><td>Vertical resolution:</td><td>' . htmlspecialchars(_skinfiles_exif_prepare($exif['YResolution'])) . ' dpi</td></tr>';
						
						if (isset($exif['FocalLength']))
							echo '<tr><td>Focal length:</td><td>' . htmlspecialchars(_skinfiles_exif_prepare($exif['FocalLength'])) . ' mm</td></tr>';
						
						if (isset($exif['FNumber']))
							echo '<tr><td>F-number:</td><td>F/' . htmlspecialchars(_skinfiles_exif_prepare($exif['FNumber'])) . '</td></tr>';
						
						if (isset($exif['ExposureTime']))
							echo '<tr><td>Exposuretime:</td><td>' . htmlspecialchars(_skinfiles_exif_prepare($exif['ExposureTime'])) . ' sec</td></tr>';
						
						if (isset($exif['ISOSpeedRatings']))
							echo '<tr><td>ISO-speed:</td><td>' . htmlspecialchars(_skinfiles_exif_prepare($exif['ISOSpeedRatings'])) . '</td></tr>';
					}
				}

				echo '</table>';
			}
		}
		else
		{
			echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to view the file</p>";
		}
	}

	function _skinfiles_exif_prepare($value) {
		if (preg_match('#([0-9]+)/([0-9]+)#', $value, $matches))
			if ($matches[1] < $matches[2])
				return '1/' . round($matches[2] / $matches[1]);
			else
				return round($matches[1] / $matches[2]);
		else
			return $value;
	}




	/* Edit file *********************************************************************************************************************/

	function _skinfiles_editfile() {

		global $pluginUrl, $manager;
		
		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory) && file_exists($directory . $file) && 
			is_file($directory . $file) && is_writable($directory . $file) && sfAllowEditing($file)) 
		{
			$relative = sfRelativePath ($directory);
			$editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=editfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($editUrl) . '" title="Edit &laquo;' . $file . '&raquo;">';
			echo '<img src="' . htmlspecialchars(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

			$content = implode('', file($directory . $file));

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="editfile_process" />';
			echo '<input type="hidden" name="file" value="' . htmlspecialchars(sfRelativePath($directory . $file)) . '" />';

			echo '<h4>Edit file &laquo;' . htmlspecialchars($file) . '&raquo;</h4><div>';
			echo '<p><textarea class="skinedit" tabindex="8" rows="20" cols="80" name="content">';
			echo htmlspecialchars($content);
			echo '</textarea></p>';
			
			echo '<p class="buttons"><button name="sure" value="yes" onclick="return checkSubmit();">Save Changes</button>';
			echo '<button name="sure" value="no">Cancel</button></p></div>';
			echo '</form>';
			echo '</div>';
		}
		else
		{
			echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to edit the file</p>";
		}
	}

	function _skinfiles_editfile_process() {

		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory) && file_exists($directory . $file) && 
				is_file($directory . $file) && is_writable($directory . $file) && sfAllowEditing($file)) 
			{
				$content = postVar('content');
				$success = false;
				
				if ($fh = @fopen($directory . $file, 'wb')) { 
					
					if (@fwrite($fh, $content) !== false)
						$success = true;
						
					@fclose($fh);
				}
				
				if ($success)
					echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($file) . "&raquo; has been saved</p>";
				else
					echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo; could not be saved</p>";
			
				_skinfiles_editfile();
			}
			else
			{
				echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to edit the file</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory);
		}
	}



	/* Rename file *******************************************************************************************************************/

	function _skinfiles_renfile($preset = '') {

		global $pluginUrl, $manager;
		
		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory) && file_exists($directory . $file) && 
			is_file($directory . $file) && is_writable($directory . $file)) 
		{
			$relative = sfRelativePath ($directory);
			$editUrl  = $manager->addTicketToUrl($pluginUrl . '?action=renfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($editUrl) . '" title="Rename &laquo;' . $file . '&raquo;">';
			echo '<img src="' . htmlspecialchars(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="renfile_process" />';
			echo '<input type="hidden" name="file" value="' . htmlspecialchars(sfRelativePath($directory . $file)) . '" />';

			echo '<h4>Rename file &laquo;' . htmlspecialchars($file) . '&raquo; to:</h4><div>';
			echo '<p><input type="text" name="name" size="40" value="' . htmlspecialchars($preset != '' ? $preset : $file) . '" /></p>';
			echo '<p class="buttons"><button name="sure" value="yes" onclick="return checkSubmit();">Rename</button>';
			echo '<button name="sure" value="no">Cancel</button></p></div>';
			echo '</form>';
			echo '</div>';
		}
		else
		{
			echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to rename the file</p>";
		}
	}
	
	function _skinfiles_renfile_process() {

		global $pluginUrl, $manager;
		
		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory) && file_exists($directory . $file) && 
				is_file($directory . $file) && is_writable($directory . $file)) 
			{
				$name = requestVar('name');
				
				if ($name == '') {
					echo "<p class='error'>Error: Could not rename the file &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because no new name was supplied.</p>";
					_skinfiles_renfile($name);
					return;
				}
				
				if (sfIllegalFilename($name)) {
					echo "<p class='error'>Error: Could not rename the file &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied file name contains one or more illegal characters</p>";
					_skinfiles_renfile($name);
					return;
				} 
				
				if ($name == $file) {
					echo "<p class='error'>Error: Could not rename the file &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied name is the same as the original name. Please use a different name.</p>";
					_skinfiles_renfile($name);
					return;
				}
				
				if (file_exists($directory . $name)) {
					echo "<p class='error'>Error: Could not rename the file &laquo;" . htmlspecialchars($file) . "&raquo; ";
					echo "because the supplied name is already used by another file or directory. Consider using a different name, or ";
					echo "delete the existing file or directory first</p>";
					_skinfiles_renfile($name);
					return;
				}
				
				if (!@rename($directory . $file, $directory . $name)) 
				{
					echo "<p class='error'>Error: Could not rename the file &laquo;" . htmlspecialchars($file) . "&raquo;</p>";
					_skinfiles_renfile($name);
					return;
				}
	
				echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($file) . "&raquo; has been renamed ";
				echo "to &laquo;" . htmlspecialchars($name) . "&raquo;</p>";
				sfShowDirectory($directory);
			} 		
			else
			{
				echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to rename the file</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory);
		}
	}




	/* Create file *******************************************************************************************************************/

	function _skinfiles_createfile() {
	
		$directory = trim(requestVar('dir'));
		$directory = sfExpandDirectory($directory);

		if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) 
		{
			$name = requestVar('name');
			
			if ($name == '') {
				echo "<p class='error'>Error: Could not create a new file because there was no name supplied</p>";
				sfShowDirectory($directory);
				return;
			}
			
			if (sfIllegalFilename($name)) {
				echo "<p class='error'>Error: Could not create the file &laquo;" . htmlspecialchars($name) . "&raquo; ";
				echo "because the supplied file name contains one or more illegal characters</p>";
				sfShowDirectory($directory);
				return;
			} 
			
			if (file_exists($directory . $name)) {
				echo "<p class='error'>Error: Could not create the file &laquo;" . htmlspecialchars($name) . "&raquo; ";
				echo "because the supplied name is already used by another file or directory. Consider using a different name, or ";
				echo "delete the existing file or directory first</p>";
				sfShowDirectory($directory);
				return;
			}
			
			if (!@touch($directory . $name)) 
			{
				echo "<p class='error'>Error: Could not create the file &laquo;" . htmlspecialchars($name) . "&raquo;</p>";
				sfShowDirectory($directory);
				return;
			}

			$mask = @umask(0000);
			@chmod($directory . $name, 0755);
			@umask($mask);
			
			echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($name) . "&raquo; has been created</p>";
			sfShowDirectory($directory);
		} 		
		else
		{
			echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars(basename($directory)) . "&raquo;  does not exist ";
			echo "or you do not have permission to access that directory</p>";
		}
	}




	/* Delete file *******************************************************************************************************************/

	function _skinfiles_delfile() {

		global $pluginUrl, $manager;
		
		$file 	   = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (sfValidPath($directory) && file_exists($directory . $file) && 
			is_file($directory . $file) && is_writable($directory . $file)) 
		{
			$relative = sfRelativePath ($directory);
			$delUrl  = $manager->addTicketToUrl($pluginUrl . '?action=delfile&file=' . rawurlencode(sfRelativePath($directory . $file)));

			echo '<p class="location">Current location: ' . sfDisplayPath($relative);
			echo '<a href="' . htmlspecialchars($delUrl) . '" title="Delete &laquo;' . $file . '&raquo;">';
			echo '<img src="' . htmlspecialchars(sfIcon($file)) . '" alt="" /> ' . $file . '</a></p>';

			echo '<div class="dialogbox">';
			echo '<form method="post" action="' . htmlspecialchars($pluginUrl) . '">';
			$manager->addTicketHidden();
			echo '<input type="hidden" name="action" value="delfile_process" />';
			echo '<input type="hidden" name="file" value="' . htmlspecialchars(sfRelativePath($directory . $file)) . '" />';

			echo '<h4>Delete file &laquo;' . htmlspecialchars($file) . '&raquo;?</h4><div>';
			echo '<p class="buttons"><button name="sure" value="yes">Delete</button>';
			echo '<button name="sure" value="no">Cancel</button></p>';

			echo '</div></form></div>';
		}
		else
		{
			echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
			echo "or you do not have permission to delete the file</p>";
		}
	}

	function _skinfiles_delfile_process() {

		global $pluginUrl, $manager;
		
		$file      = basename(trim(requestVar('file')));
		$directory = dirname(trim(requestVar('file')));
		$directory = sfExpandDirectory ($directory);
		
		if (requestVar('sure') == 'yes')
		{
			if (sfValidPath($directory) && file_exists($directory . $file) && 
				is_file($directory . $file) && is_writable($directory . $file)) 
			{
				if (!@unlink($directory . $file)) 
				{
					echo "<p class='error'>Error: Could not delete the file &laquo;" . htmlspecialchars($file) . "&raquo;</p>";
					sfShowDirectory($directory);
					return;
				}
	
				echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($file) . "&raquo; has been deleted</p>";
				sfShowDirectory($directory);
			} 		
			else
			{
				echo "<p class='error'>Error: The file &laquo;" . htmlspecialchars($file) . "&raquo;  does not exist ";
				echo "or you do not have permission to delete the file</p>";
			}
		}
		else
		{
			// User cancelled
			sfShowDirectory($directory);
		}
	}



	/* Upload file *******************************************************************************************************************/

	function _skinfiles_uploadfile() {

		global $pluginUrl, $manager, $CONF;
		
		$directory = trim(requestVar('dir'));
		$directory = sfExpandDirectory($directory);

		if (sfValidPath($directory) && is_dir($directory) && is_writable($directory)) 
		{
			$file = postFileInfo('name');

			if ($file['size'] > $CONF['MaxUploadSize']) {
				echo "<p class='error'>Error: Could not upload the file &laquo;" . htmlspecialchars($file['name']) . "&raquo;. " . $CONF['MaxUploadSize'] . '/' . $file['size'] . _ERROR_FILE_TOO_BIG . "</p>";
				sfShowDirectory($directory);
				return;
			}

			if (!is_uploaded_file($file['tmp_name'])) {
				echo "<p class='error'>Error: Could not upload the file &laquo;" . htmlspecialchars($file['name']) . "&raquo;. " . _ERROR_BADREQUEST . "</p>";
				sfShowDirectory($directory);
				return;
			}
			
			if (sfIllegalFilename($file['name'])) {
				echo "<p class='error'>Error: Could not upload the file &laquo;" . htmlspecialchars($file['name']) . "&raquo; ";
				echo "because the supplied file name contains one or more illegal characters</p>";
				sfShowDirectory($directory);
				return;
			}
			
			if (file_exists($directory . $file['name'])) {
				echo "<p class='error'>Error: Could not upload the file &laquo;" . htmlspecialchars($file['name']) . "&raquo;. " . _ERROR_UPLOADDUPLICATE . "</p>";
				sfShowDirectory($directory);
				return;
			}

			if (!@move_uploaded_file($file['tmp_name'], $directory . $file['name'])) {
				echo "<p class='error'>Error: Could not upload the file &laquo;" . htmlspecialchars($file['name']) . "&raquo;. " . _ERROR_UPLOADMOVE . "</p>";
				sfShowDirectory($directory);
			}

			$mask = @umask(0000);
			@chmod($directory . $file['name'], 0755);
			@umask($mask);

			echo "<p class='message'>Message: The file &laquo;" . htmlspecialchars($file['name']) . "&raquo; has been uploaded</p>";
			sfShowDirectory($directory);
		}
		else
		{
			echo "<p class='error'>Error: The directory &laquo;" . htmlspecialchars(basename($directory)) . "&raquo;  does not exist ";
			echo "or you do not have permission to access that directory</p>";
		}	
	}




	
?>