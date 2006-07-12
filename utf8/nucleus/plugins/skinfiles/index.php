<?php

/*                                       */
/* Admin page for NP_SkinFiles           */
/* ------------------------------------  */
/* A simple skin files manager           */
/*                                       */
/* code by Jeff MacMichael               */
/* http://gednet.com/                    */
/*                                       */
/* version 1.01                          */
 
 	$strRel = '../../../'; 
	include($strRel . 'config.php');
	
	include($DIR_LIBS . 'PLUGINADMIN.php');

	if (preg_match("/MD$/", $nucleus['version'])) {
		$isblogadmin = $member->isBlogAdmin(-1);
	} else {
		$isblogadmin = $member->isBlogAdmin($blogid);
	}
	if (!($member->isAdmin() || $isblogadmin)) {
		$oPluginAdmin = new PluginAdmin('SkinFiles');
		$oPluginAdmin->start();
		echo "<p>"._ERROR_DISALLOWED."</p>";
		$oPluginAdmin->end();
		exit;
	}

	// set to FALSE for normal operation, or TRUE if skins are stored
	// under owner's member id i.e. /skins/1/grey/...   (MDNucleus)
	$privateskins = FALSE;
	if ($privateskins) { 
		global $member;
		$SKINSUBDIR = $member->getID().'/'; 
		$latestskins = 'latest-skins/';
	} else {
		$SKINSUBDIR = '';
	}
	
	global $pluginsskinfiles, $CONF;
	$pluginsskinfiles=$CONF['PluginURL']."skinfiles";

	if (isset($_GET['action'])) {$action = $_GET['action'];}
	if (isset($_POST['action'])) {$action = $_POST['action'];}

	if ($action == 'download') { 
		download();
		return;
		break;
	}

	// create the admin area page
	$oPluginAdmin = new PluginAdmin('SkinFiles');
	$oPluginAdmin->start();
	
	echo "<h2>Skin File Management</h2>";
	
	if (strstr('renfile delfile createdir rendir deldir deleteAllInDir'
		.' editfile uploadfile createfile getLatestSkins', $action)) { 
		call_user_func($action);
	} else {
		showdir();
	}

	$oPluginAdmin->end();
	return;
	break;
		
	function createfile() {
		global $oPluginAdmin, $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		$parent = $_POST["dir"];
		$filename = $_POST["filename"];
		$fullpath = $DIR_SKINS.$SKINSUBDIR.$parent.'/'.$filename;
		if (file_exists($fullpath)) {
			$msg = "Error: the file '$filename' already exists.";
			showdir($msg);
		}
		echo "<h3><b>Creating file \"/$parent/$filename\":</b></h3>";
		$errrep = error_reporting(E_ERROR);
		if (touch($fullpath)) { 
			$msg = 'The file was created successfully.';
		} else {
			$msg = 'ERROR: The file was <i>not</i> created successfully.';
		}
		$oldumask = umask(0000);
		chmod($fullpath, 0755);
		umask($oldumask);
		error_reporting($errrep);
		showdir($msg);
	}

	function createdir() {
		global $oPluginAdmin, $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		$parent = $_POST["dir"];
		$newdir = $_POST["newdir"];
		if (!$newdir) {
			echo 'You need to specify a directory name to create. <br /><br />';
			echo '> <a href="'.$_SERVER['HTTP_REFERER'].'">Go back</a><br />';		
			return;
		}
		$errrep = error_reporting(E_ERROR);
		$oldumask = umask(0000);
		if (mkdir ($DIR_SKINS.$SKINSUBDIR.$parent.'/'.$newdir, 0755)) {
			$msg = 'Directory created successfully.';
		} else {
			$msg = 'There was an error creating the directory (check to see if the directory already exists).';
		}
		umask($oldumask);
		error_reporting($errrep);
		showdir($msg);
	}
	
	function download() {
		global $DIR_SKINS, $SKINSUBDIR;
		$file = $_GET["rfp"];
		$path = $DIR_SKINS.$SKINSUBDIR.$file;
		$splitpath =  preg_split( "/\//", strrev($_GET["rfp"]), 2);
		$file = strrev($splitpath[0]);
		
		// download code taken from Paul Alger's PHP_Easy_Download. 

		// translate file name properly for Internet Explorer.
		if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")){
			$file = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);
		}
		// make sure the file exists before sending headers
		if(!$fdl=@fopen($path,'r')){
			die("Cannot Open File!");
		} else {
			header("Cache-Control: ");// leave blank to avoid IE errors
			header("Pragma: ");// leave blank to avoid IE errors
			header("Content-type: application/octet-stream");
			header('Content-Disposition: attachment; filename="'.$file.'"');
			header("Content-length: ".(string)(filesize($path)));
			sleep(1);
			
			fpassthru($fdl);
		}
		return;
		break;
	}
	
	function uploadfile() {
		global $HTTP_POST_FILES, $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles, $CONF;
		$filename = $HTTP_POST_FILES['filename']['name'];
		$filesize = $HTTP_POST_FILES['filename']['size'];
		$filetempname = $HTTP_POST_FILES['filename']['tmp_name'];
		$todir = $DIR_SKINS.$SKINSUBDIR.$_POST['dir'].'/';
		
		if ($filesize > $CONF['MaxUploadSize']) {
			showdir(_ERROR_FILE_TOO_BIG);
			return;
		}

		// check file type against allowed types
		$ok = 0;
		$allowedtypes = explode (',', "css,html,htm,xml,inc,txt,".$CONF['AllowedTypes']);
		foreach ( $allowedtypes as $type ) 
			if (eregi("\." .$type. "$",$filename)) $ok = 1;    
		if (!$ok) {
			showdir(_ERROR_BADFILETYPE);
			return;
		}
		if (!is_uploaded_file($filetempname)) {
			showdir(_ERROR_BADREQUEST);
			return;
		}
		if (file_exists($todir.$filename)) {
			showdir(_ERROR_UPLOADDUPLICATE);
			return;
		}

		// move file to directory
		if (is_uploaded_file($filetempname)) {
			$errrep = error_reporting(E_ERROR);
			if (!@move_uploaded_file($filetempname, $todir . $filename)) {
				showdir(_ERROR_UPLOADMOVE);
				return;
			}
			error_reporting($errrep);
		}
		// chmod uploaded file
		$oldumask = umask(0000);
		@chmod($todir . $filename, 0755); 
		umask($oldumask);		

		showdir("File uploaded successfully.");
	}

	function rendir() {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		if (isset($_POST['newname'])) {
			$splitpath =  preg_split( "/\//", strrev($_POST["oldname"]), 2);
			$newname = strrev($splitpath[1]) .'/'. $_POST["newname"];
			$newname = preg_replace("/^\//", "", $newname);
			$res = rename ( $DIR_SKINS.$SKINSUBDIR.$_POST["oldname"], 
				$DIR_SKINS.$SKINSUBDIR.$newname);
			if ($res) { 
				$msg = "Directory successfully renamed."; 
			} else {
				$msg = "Failed to rename directory - (check to see if another directory already exists with the new name).";
			}
			showdir($msg);
		} else { 
			$oldname = preg_replace("/^\//", "", $_GET["oldname"]);
			echo '<h3><b>Rename directory "/'.$oldname.'":</b></h3>';
			$splitpath =  preg_split( "/\//", strrev($_GET["oldname"]), 2);
			$dir = strrev($splitpath[0]);
			$parent = strrev($splitpath[1]);
			echo '> <a href="'.$_SERVER['HTTP_REFERER'].'">Cancel rename</a><br />';		
			?>
				<form method="post" action="<?php echo $pluginsskinfiles?>/">
					<input type="hidden" name="action" value="rendir" />
					<input type="hidden" name="dir" value="<?php echo "/$parent" ?>"/>
					<input type="hidden" name="oldname" value="<?php echo $oldname?>"/>
					<table><tr>
						<td><?php echo 'Rename to'?></td>
						<td><input name="newname" tabindex="90" value="<?php echo  htmlspecialchars($dir) ?>" maxlength="50" size="20" /></td>
					</tr><tr>
						<td><?php echo "Rename"?></td>
						<td><input type="submit" tabindex="140" value="<?php echo "Rename this folder"?>" onclick="return checkSubmit();" /></td>
					</tr></table>
				</form>
			<?PHP
		}
	}

	function editfile () {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		if (isset ($_POST['rfp']) && isset($_POST['content'])) {
			$file = $_POST['rfp'];
			$errrep = error_reporting(E_ERROR);
			$success = true;
			if ($fh = @fopen($DIR_SKINS.$SKINSUBDIR.$file, 'w')) { 
				if (fwrite ($fh, trim(stripslashes($_POST['content'])))) {
					fclose($fh);
				} else {
					$success = false;
				}
			} else {
				$success = false;
			}
			error_reporting($errrep);
			if ($success) {
				$msg = 'File was edited successfully.';
			} else {
				$msg = 'ERROR: File was <i>not</i> saved successfully.';
			}
		}
		if (isset ($_GET['rfp'])) { $file = $_GET['rfp']; }
		if (isset ($_POST['rfp'])) { $file = $_POST['rfp']; }
		$splitpath =  preg_split( "/\//", strrev($file), 2);
		$parent = strrev($splitpath[1]);
		echo '<h3>Editing file "/'.$file.'":</h3>';
		if (isset($msg)) { echo "<p><b>$msg</b></p>"; }
		echo "> <a href=\"$pluginsskinfiles/?dir=$parent\"> Cancel/Return to /$parent</a><br /><br />";
		$fh = @fopen($DIR_SKINS.$SKINSUBDIR.$file, 'r');
		while (!feof($fh)) { 
			$content .= fread($fh, 4096); 
		}
		fclose ($fh);			
		?>
			<form method="post" action="<?php echo $pluginsskinfiles?>/">
				<input type="hidden" name="action" value="editfile" />
				<input type="hidden" name="rfp" value="<?php echo $file ?>"/>
				<input type="hidden" name="dir" value="<?php echo $parent ?>"/>
				<input type="submit" tabindex="140" value="<?php echo "Save changes"?>" onclick="return checkSubmit();" />
				<input type="reset" value="Reset Data" /><br />
				<textarea class="skinedit" tabindex="8" rows="20" cols="80" name="content"><?PHP echo htmlspecialchars($content) ?></textarea>
				<input type="submit" tabindex="140" value="<?php echo "Save changes"?>" onclick="return checkSubmit();" />
				<input type="reset" value="Reset Data" /><br />
			</form>
		<?PHP
	}


	function renfile() {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		if (isset($_POST['newname'])) {
			$splitpath =  preg_split( "/\//", strrev($_POST["oldname"]), 2);
			$newname = strrev($splitpath[1]) .'/'. $_POST["newname"];
			$newname = preg_replace("/^\//", "", $newname);
			$res = rename ( $DIR_SKINS.$SKINSUBDIR.$_POST["oldname"], 
				$DIR_SKINS.$SKINSUBDIR.$newname);
			if ($res) { 
				$msg = "File successfully renamed."; 
			} else {
				$msg = "File could not be renamed - (check to see if another file already exists with the new name).";
			}
			showdir($msg);
		} else { 
			echo '<h3><b>Rename file "/'.$_GET["rfp"].'":</b></h3>';
			$splitpath =  preg_split( "/\//", strrev($_GET["rfp"]), 2);
			$file = strrev($splitpath[0]);
			$parent = strrev($splitpath[1]);
			echo '> <a href="'.$_SERVER['HTTP_REFERER'].'">Cancel rename</a><br />';		
			?>
				<form method="post" action="<?php echo $pluginsskinfiles?>/">
					<input type="hidden" name="action" value="renfile" />
					<input type="hidden" name="oldname" value="<?php echo $_GET["rfp"] ?>"/>
					<input type="hidden" name="dir" value="<?php echo "/$parent" ?>"/>
					<table><tr>
						<td><?php echo 'Rename to'?></td>
						<td><input name="newname" tabindex="90" value="<?php echo  htmlspecialchars($file) ?>" maxlength="50" size="20" /></td>
					</tr><tr>
						<td><?php echo "Rename"?></td>
						<td><input type="submit" tabindex="140" value="<?php echo "Rename this file"?>" onclick="return checkSubmit();" /></td>
					</tr></table>
				</form>
			<?PHP
		}
	}

	function delfile() {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		if (isset($_GET['sure'])) { 
			$file = $DIR_SKINS.$SKINSUBDIR.$_GET["rfp"];
			$errrep = error_reporting(E_ERROR);
			if (unlink ($file)) {
				$msg = 'File "'.$_GET["rfp"].'" has been deleted.';
			} else {
				$msg = 'ERROR: File "'.$_GET["rfp"].'" could not be deleted.';
			}
			error_reporting($errrep);
			showdir($msg);
		} else {
			$file = $DIR_SKINS.$SKINSUBDIR.$_GET["rfp"];
			$splitpath =  preg_split( "/\//", strrev($_GET["rfp"]), 2);
			$parent = strrev($splitpath[1]);
			echo '<h3><b>Delete file "'.$_GET["rfp"].'": are you sure?</b></h3>';
			echo '<b>This action cannot be undone!</b><br /><br />';
			echo "> <a href=\"$pluginsskinfiles/?action=delfile&dir=$parent&sure=y&rfp=".$_GET["rfp"]."\">Yes, delete the file.</a><br />";		
			echo "> <a href=\"$pluginsskinfiles/?dir=".$parent.'">No, go back.</a><br />';		
		}
	}

	function deldir() {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		if (isset($_GET['sure'])) { 
			$dir = $DIR_SKINS.$SKINSUBDIR.$_GET["remdir"];
			$errrep = error_reporting(E_ERROR);
			if (rmdir ($dir)) {
				$msg = 'Directory "'.$_GET["remdir"].'" has been deleted.';
			} else {
				$msg = 'ERROR: directory "'.$_GET["remdir"].'" could not be deleted - (check to see if it contains files).';
			}
			error_reporting($errrep);
			showdir($msg);
		} else {
			$dir = preg_replace("/^\//", "",$_GET['remdir']);
			$parent = $_GET['dir'];
			echo '<h3><b>Delete directory "/'.$dir.'": are you sure?</b></h3>';
			echo '<b>This action cannot be undone!</b><br /><br />';
			echo "> <a href=\"$pluginsskinfiles/?action=deldir&sure=y&remdir=$dir&dir=$parent\">Yes, delete the directory (it must be empty to do this).</a><br /><br />";		
			echo "> <a href=\"$pluginsskinfiles/?dir=".$parent.'">No, go back.</a><br />';		
		}
	}

	function deleteAllInDir() {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles;
		$parent = $DIR_SKINS.$SKINSUBDIR.preg_replace("/^\//", "",$_GET['dir']);
		if ($dh = @opendir($parent)) { 
			while (($file = readdir($dh)) !== false) { 
				if(!preg_match("/^\.{1,2}/", $file)){
					if (!is_dir($parent.$file)) {
						$files[] = $file;
					}
				}
			}
			closedir($dh); 
		} 
		if (isset($_GET['sure'])) { 
			$errrep = error_reporting(E_ERROR);
			echo '<h3>Deletion results</h3><table>';
			echo "> <a href=\"$pluginsskinfiles/?dir=".$_GET["dir"]."\">Return to the /".$_GET["dir"]." directory.</a><br />";		
			foreach ($files as $file) {
				if (unlink ("$parent/$file")) { 
					echo "<tr><td>File: $file was deleted.</td></tr>"; 
				} else {
					echo "<tr><td>File: $file was <b>NOT</b> deleted.</td></tr>";
				}
			}
			echo "</table>";
			error_reporting($errrep);
			echo "> <a href=\"$pluginsskinfiles/?dir=".$_GET["dir"]."\">Return to the /".$_GET["dir"]." directory.</a><br />";		
		} else {
			echo '<h3><b>Delete all files in directory "/'.$_GET['dir'].'": are you sure?</b></h3>';
			echo '<b>This action cannot be undone!</b><br /><br />';
			echo "> <a href=\"$pluginsskinfiles/?action=deleteAllInDir&sure=y&dir=".$_GET["dir"]."\">Yes, delete <u>all files</u> in this directory.</a><br />";		
			echo "> <a href=\"$pluginsskinfiles/?dir=".$_GET['dir'].'">No, go back.</a><br /><br />';		
			echo '<b>Files list:</b><table>';
			foreach ($files as $file) {	echo "<tr><td>$file</td></tr>"; }
			echo '</table>';
		}
	}

	// function for MDNucleus; won't work unless $privateskins is set to true
	function getLatestSkins() {
		global $DIR_SKINS, $pluginsskinfiles, $privateskins, $latestskins, $member;
		$confirmed = $_POST['overwrite'];
		if (!$confirmed) {
			showdir("Overwrite of default skin files not confirmed - no action taken.");
			return;
		}
		if ($dh = @opendir($DIR_SKINS.$latestskins)) { 
			while (($file = readdir($dh)) !== false) { 
				if(!preg_match("/^\.{1,2}/", $file))
					if (is_dir($DIR_SKINS.$latestskins.$file)) $skins[] = $file;
			}
			closedir($dh); 
		} 
		if ($skins) {
			$msg = "Refreshed skin folders:";
			sort ($skins);
			foreach ($skins as $skin) {
				$memberskin = $DIR_SKINS.$member->getID().'/'.$skin;
				if (is_file($memberskin)) unlink($memberskin);
				if (!is_dir($memberskin)) {
					$old_umask = umask(0);
					mkdir($memberskin, 0755);
					umask($old_umask);
				}
				exec("rsync -Wtr --delete ".$DIR_SKINS.$latestskins.$skin."/* ".$memberskin.'/');
				$msg .= "  $skin";
			}
		} else {
			showdir("No default skin folders found.  No action taken.");
			return;
		}
		showdir($msg);
	}

	function _isImageFile($file) {
		return preg_match ("/\.(gif|png|jpg|jpeg|bmp|ico)$/i", $file);
	}

	function _isEditableFile($file) {
		return preg_match ("/\.(inc|txt|htm|html|xml)$/i", $file);
	}

	function showdir($msg = '') {
		global $DIR_SKINS, $SKINSUBDIR, $pluginsskinfiles, $CONF;
		global $privateskins, $latestskins;
		if (isset($_GET['dir'])) { 
			$newdir = preg_replace("/^\//", "",$_GET['dir']);
			$currdir = $DIR_SKINS.$SKINSUBDIR."$newdir/";
			$in_subdir = 1;
		} elseif (isset($_POST['dir'])) { 
			$newdir = preg_replace("/^\//", "",$_POST['dir']);
			$currdir = $DIR_SKINS.$SKINSUBDIR."$newdir/";
			$in_subdir = 1;
		} else {
			$newdir = '';
			$currdir = $DIR_SKINS.$SKINSUBDIR;
			$in_subdir = 0;
		}
	
		if ($privateskins && (!is_dir($DIR_SKINS.$SKINSUBDIR))) {
			$oldumask = umask(0);
			mkdir($DIR_SKINS.$SKINSUBDIR, 0755);
			umask($oldmask);
		}

		if (!is_dir($currdir)) {
			echo 'The specified location is not a directory or doesn\'t exist.';
			return;
		}
		
		if ($dh = @opendir($currdir)) { 
			while (($file = readdir($dh)) !== false) { 
				if(!preg_match("/^\.{1,2}/", $file)){
					if (is_dir($currdir.$file)) {
						$dirs[] = $file;
					} else {
						$files[] = $file;
					}
				}
			}
			closedir($dh); 
		} 
		
		echo "<h3>Current Directory: <b>/$newdir</b></h3>";
		
		if ($msg) {
			echo '<p><b>'.htmlspecialchars($msg).'</b></p>';
		}
		
		if ($newdir != '') {
			echo "<u><a href=\"$pluginsskinfiles/\">> Return to / <</a></u><br />";
			if (strstr($newdir, '/')) {
				$splitpath =  preg_split( "/\//", strrev($newdir), 2);
				$updir = strrev($splitpath[1]);
				echo "<u><a href=\"$pluginsskinfiles/?dir=/$updir\">> Return to /$updir <</a></u><br /><br />";
			}
		}
		echo "<u><a href=\"$pluginsskinfiles/?dir=$newdir\">> Refresh <</a></u><br />";

		echo "<table>";
		if(is_array($dirs)){
			sort($dirs);
			foreach($dirs as $dir) {
				echo "<tr onmouseover='focusRow(this);' onmouseout='blurRow(this);'><td>";
				echo "&nbsp;&nbsp;<a href=\"$pluginsskinfiles/?dir=$newdir/$dir\">";
				echo "<img src=\"$pluginsskinfiles/dir.gif\"> $dir</a>&nbsp;</td>";
				echo "<td>&nbsp;<a href=\"$pluginsskinfiles/?action=rendir&oldname=$newdir/$dir\" title=\"Rename directory\">(ren)</a></td>";
				echo "<td>&nbsp;<a href=\"$pluginsskinfiles/?action=deldir&dir=$newdir&remdir=$newdir/$dir\" title=\"Delete directory\">(del)</a></td>";
				echo "</td><td></td><td></td><td></td><td>";
				echo "<td>".date('M d, Y  h:i:s a', filemtime($DIR_SKINS.$SKINSUBDIR.$newdir."/$dir"));
				echo "</td></tr>";
			}
		}
	
		if(is_array($files)){
			sort($files);
			foreach($files as $file) {
				echo "<tr onmouseover='focusRow(this);' onmouseout='blurRow(this);'><td>";
				echo "&nbsp;&nbsp;";
				if (preg_match("/\.css$/i", $file)) {
					echo "<img src=\"$pluginsskinfiles/css.gif\"> ";
				} elseif (preg_match("/\.php(3|4)?$/i", $file)) {
					echo "<img src=\"$pluginsskinfiles/php.gif\"> ";
				} elseif (_isEditableFile($file)) {
					echo "<img src=\"$pluginsskinfiles/text.gif\"> ";
				} elseif (_isImageFile($file)) {
					echo "<img src=\"$pluginsskinfiles/image.gif\"> ";
				} else {
					echo "<img src=\"$pluginsskinfiles/generic.png\"> ";
				}
				if ($newdir == '') {$thisdir = '';} else {$thisdir = "$newdir/";}
				echo "$file&nbsp;";
				echo "</td><td>";
				echo "&nbsp;<a href=\"$pluginsskinfiles/?action=renfile&rfp=$thisdir"."$file\" title=\"Rename file\">(ren)</a>";
				echo "</td><td>";
				echo "&nbsp;<a href=\"$pluginsskinfiles/?action=delfile&rfp=$thisdir"."$file\" title=\"Delete file\">(del)</a>";
				echo "</td><td>";
				if ((is_writable($DIR_SKINS.$SKINSUBDIR.$thisdir.$file)) && (!_isImageFile($file))) {
					echo "&nbsp;<a href=\"$pluginsskinfiles/?action=editfile&rfp=$thisdir"."$file\" title=\"Edit file\">(edit)</a>";
				}
				echo "</td><td>";
				if (_isImageFile($file)) {
					echo '&nbsp;<a href="'.$CONF['SkinsURL'].$SKINSUBDIR.$thisdir."$file\" title=\"View graphic\">(view)</a>";
				}
				echo "</td><td>";
				echo "&nbsp;<a href=\"$pluginsskinfiles/?action=download&rfp=$thisdir"."$file\" title=\"Download file\">(d/l)</a>";
				echo "</td><td>";
				echo number_format(filesize($DIR_SKINS.$SKINSUBDIR.$thisdir.$file)/1024, 2)." KB";
				echo "</td><td>";
				echo date('M d, Y  h:i:s a', filemtime($DIR_SKINS.$SKINSUBDIR.$thisdir.$file));
				echo "</td></tr>";
			}
		}
		echo "</table>";
	
		if(is_array($dirs) || is_array($files)) {
			if ($newdir != '') {
				echo "<u><a href=\"$pluginsskinfiles/\">> Return to / <</a></u><br />";
				if (strstr($newdir, '/')) {
					$splitpath =  preg_split( "/\//", strrev($newdir), 2);
					$updir = strrev($splitpath[1]);
					echo "<u><a href=\"$pluginsskinfiles/?dir=/$updir\">> Return to /$updir <</a></u><br /><br />";
				}
			}
			echo "<u><a href=\"$pluginsskinfiles/?dir=$newdir\">> Refresh <</a></u><br />";
		}

		if ($newdir != '') {
			echo "<h3>Create new file in <b>/$newdir</b></h3>";
				?>
				<form method="POST" enctype="multipart/form-data" action="<?php echo $pluginsskinfiles ?>/">
						<input type="hidden" name="action" value="createfile" />
						<input type="hidden" name="dir" value="<?php echo $newdir ?>">
						<input type="text" name="filename" size="40">
						<input type="submit" value="<?php echo 'Create file' ?>" />
					</form>
				<?PHP

				echo "<h3>Upload new file to <b>/$newdir</b></h3>";
				?>
				<form method="POST" enctype="multipart/form-data" action="<?php echo $pluginsskinfiles ?>/">
						<input type="hidden" name="action" value="uploadfile" />
						<input type="hidden" name="dir" value="<?php echo $newdir ?>">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $CONF['MaxUploadSize']?>" />
						<input type="file" name="filename" size="40">
						<input type="submit" value="<?php echo _UPLOAD_BUTTON?>" />
					</form>
				<?PHP
	
			if (count($files)) {
				echo "<h3>Delete all files in <b>/$newdir</b></h3>";
					?>
						<form method="get" action="<?php echo $pluginsskinfiles?>/">
							<input type="hidden" name="action" value="deleteAllInDir" />
							<input type="hidden" name="dir" value="<?php echo $newdir?>"/>
							<?php echo "Delete all Files? (will ask for confirmation)"?>
							<input type="submit" tabindex="140" value="<?php echo "Delete All"?>" onclick="return checkSubmit();" />
						</form>
					<?PHP
			}
		}
	
		echo "<h3>Create a new directory in <b>/$newdir</b></h3>"; 
				?>
					<form method="post" action="<?php echo $pluginsskinfiles?>/">
						<input type="hidden" name="action" value="createdir" />
						<input type="hidden" name="dir" value="<?php echo $newdir?>"/>
						<input name="newdir" tabindex="90" value="<?php echo 'newdir' ?>" size="40" />
						<input type="submit" tabindex="140" value="<?php echo "Create"?>" onclick="return checkSubmit();" />
					</form>
				<?PHP

		// for MDNucleus, ignored if on Win32 platform (for the moment)
		if (($newdir == '') && ($privateskins) && (!strtoupper(substr(PHP_OS, 0,3) == 'WIN'))) {
			if ($dh = @opendir($DIR_SKINS.$latestskins)) { 
				while (($file = readdir($dh)) !== false) { 
					if(!preg_match("/^\.{1,2}/", $file))
						if (is_dir($DIR_SKINS.$latestskins.$file)) $skins[] = $file;
				}
				closedir($dh); 
			}
			if ($skins) {
				echo "<h3>Refresh default skin files to standard versions</h3>";
				?>
					<form method="post" action="<?php echo $pluginsskinfiles?>/">
						<input type="hidden" name="action" value="getLatestSkins" />
						<?php
						sort ($skins);
						if (count($skins) > 1) {
							$lastskin = array_pop($skins);
							array_push($skins, "</b>and<b> $lastskin");
						}
						echo "This will overwrite or create files in the following skin file directories: <b>";
						echo implode(", ", $skins)."</b><br /><br />"; 
						?> 
						Note that you may need to re-import skin definitions you wish to use (See Layout Import/Export).<br /><br />
						<input type="checkbox" name="overwrite" value="1" id="cb_overwrite" />
						<label for="cb_overwrite"><?php echo "Check this box to confirm overwrite of files<br />" ?></label>
						<input type="submit" tabindex="140" value="<?php echo "Overwrite Default Skin Files"?>" onclick="return checkSubmit();" />
					</form>
				<?PHP
			}
		}

	}

	
	
?>