<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * Media popup window for Nucleus
  *
  * Purpose:
  *   - can be openen from an add-item form or bookmarklet popup
  *   - shows a list of recent files, allowing browsing, search and 
  *     upload of new files
  *   - close the popup by selecting a file in the list. The file gets
  *     passed through to the add-item form (linkto, popupimg or inline img)
  */
  
// include all classes and config data
$CONF = array();
include('../config.php');
include($DIR_LIBS . 'MEDIA.php');	// media classes

// moet ingelogd zijn
if (!$member->isLoggedIn()) {
	media_loginAndPassThrough();
	exit;
}

// check if member is on at least one teamlist
$query = 'SELECT * FROM ' . sql_table('team'). ' WHERE tmember=' . $member->getID();
$teams = mysql_query($query);
if (mysql_num_rows($teams) == 0)
	media_doError(_ERROR_DISALLOWEDUPLOAD);
	
// basic action:
switch($action) {
	case 'chooseupload':
	case 'Upload to...':
	case 'Upload new file...':
		media_choose();
		break;
	case 'uploadfile':
		media_upload();
		break;
	case 'selectmedia':
	case 'Select':
	default:
		media_select();
		break;
}

// select a file
function media_select() {
	global $member, $CONF, $DIR_MEDIA;
	
	media_head();
	
	// show 10 files + navigation buttons 
	// show msg when no files
	// show upload form
	// files sorted according to last modification date

	// currently selected collection
	$currentCollection = requestVar('collection');
	if (!$currentCollection || !@is_dir($DIR_MEDIA . $currentCollection))
		$currentCollection = $member->getID();
		
	
	// get collection list
	$collections = MEDIA::getCollectionList();

	if (sizeof($collections) > 1) {
	?>
		<form method="post" action="media.php"><div>
			<label for="media_collection">Current collection:</label>
			<select name="collection" id="media_collection">
				<?php					foreach ($collections as $dirname => $description) {
						echo '<option value="',htmlspecialchars($dirname),'"';
						if ($dirname == $currentCollection) {
							echo ' selected="selected"';
						}
						echo '>',htmlspecialchars($description),'</option>';
					}
				?>
			</select>
			<input type="submit" name="action" value="Select" title="Switch to this category" />
			<input type="submit" name="action" value="Upload to..." title="<?php echo _MEDIA_UPLOADLINK?>" />
		</div></form>
	<?php	} else {
	?>
		<form method="post" action="media.php"><div>
			<input type="hidden" name="collection" value="<?php echo intval($currentCollection)?>" />
			<input type="submit" name="action" value="Upload new file..." title="<?php echo _MEDIA_UPLOADLINK?>" />
		</div></form>	
	<?php	} // if sizeof
	
	?>	
		<table width="100%">
		<caption>Collection: <?php echo $collections[$currentCollection]?></caption>
		<tr>
		 <th><?php echo _MEDIA_MODIFIED?></th><th><?php echo _MEDIA_FILENAME?></th><th><?php echo _MEDIA_DIMENSIONS?></th>
		</tr>
	
	<?php	
	$arr = MEDIA::getMediaListByCollection($currentCollection);
	
	
	if (sizeof($arr)>0) {
	
		$offset = intRequestVar('offset');
	
		if (($offset + 10) >= sizeof($arr))
			$offset = sizeof($arr) - 10;

		if ($offset < 0) $offset = 0;
		
		$idxStart = $offset;
		$idxEnd = $offset + 10;
		$idxNext = $idxEnd;
		$idxPrev = $idxStart - 10;

		if ($idxPrev < 0) $idxPrev = 0;

		if ($idxEnd > sizeof($arr))
			$idxEnd = sizeof($arr);

		for($i=$idxStart;$i<$idxEnd;$i++) {
			$obj = $arr[$i];
			$filename = $DIR_MEDIA . $currentCollection . '/' . $obj->filename;

			$old_level = error_reporting(0);
			$size = @GetImageSize($filename); 
			error_reporting($old_level);
			$width = $size[0];
			$height = $size[1];
			$filetype = $size[2];
			
			echo "<tr>";
			echo "<td>". date("Y-m-d",$obj->timestamp) ."</td>";

			if ($filetype != 0) {
				// image (gif/jpg/png/swf)
				echo "<td><a href='media.php' onclick='chooseImage(\"$currentCollection\",\"$obj->filename\","
							   . "\"$width\",\"$height\""
							   . ")' title='" . htmlspecialchars($obj->filename). "'>"
							   . htmlspecialchars(shorten($obj->filename,30,'...'))
							   ."</a>";
				echo "</td>";
			} else {
				// no image (e.g. mpg)
				echo "<td><a href='media.php' onclick='chooseOther(\"$currentCollection\",\"$obj->filename\""
							   . ")' title='" . htmlspecialchars($obj->filename). "'>"
							   . htmlspecialchars(shorten($obj->filename,30,'...'))
							   ."</a></td>";

			}
			echo "<td>" . $width . "x" . $height . "</td>";
			echo "</tr>";
		}
	} // if (sizeof($arr)>0)
	?>
	
		</table>
	<?php	
	if ($idxStart > 0)
		echo "<a href='media.php?offset=$idxPrev&amp;collection=".urlencode($currentCollection)."'>". _LISTS_PREV."</a> ";
	if ($idxEnd < sizeof($arr))
		echo "<a href='media.php?offset=$idxNext&amp;collection=".urlencode($currentCollection)."'>". _LISTS_NEXT."</a> ";
	
	?>
		<input id="typeradio0" type="radio" name="typeradio" onclick="setType(0);" checked="checked" /><label for="typeradio0"><?php echo _MEDIA_INLINE?></label>
		<input id="typeradio1" type="radio" name="typeradio" onclick="setType(1);" /><label for="typeradio1"><?php echo _MEDIA_POPUP?></label>
	<?php	
	media_foot();
     
		
}

/**
  * Shows a screen where you can select the file to upload
  */
function media_choose() {
	global $CONF, $member;

	$currentCollection = requestVar('collection');
	
	$collections = MEDIA::getCollectionList();

	media_head();
	?>
	<h1><?php echo _UPLOAD_TITLE?></h1>
	
	<p><?php echo _UPLOAD_MSG?></p>
	
	<form method="post" enctype="multipart/form-data" action="media.php">
	<div>
 	  <input type="hidden" name="action" value="uploadfile" />
	  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $CONF['MaxUploadSize']?>" />
	  File:
	  <br />
	  <input name="uploadfile" type="file" size="40" />
	<?php		if (sizeof($collections) > 1) {
	?>
		<br /><br /><label for="upload_collection">Collection:</label>
		<br /><select name="collection" id="upload_collection">
			<?php				foreach ($collections as $dirname => $description) {
					echo '<option value="',htmlspecialchars($dirname),'"';
					if ($dirname == $currentCollection) {
						echo ' selected="selected"';
					}
					echo '>',htmlspecialchars($description),'</option>';
				}
			?>
		</select>
	<?php		} else {
	?>
	  	<input name="collection" type="hidden" value="<?php echo htmlspecialchars(requestVar('collection'))?>" />			
	<?php		} // if sizeof
	?>  
	  <br /><br />
	  <input type="submit" value="<?php echo _UPLOAD_BUTTON?>" />
	</div>
	</form>
	
	<?php	
	media_foot();
}


/**
  * accepts a file for upload
  */
function media_upload() {
	global $HTTP_POST_FILES, $DIR_MEDIA;
	global $member, $CONF;
	
	$filename = $HTTP_POST_FILES['uploadfile']['name'];
	$filetype = $HTTP_POST_FILES['uploadfile']['type'];
	$filesize = $HTTP_POST_FILES['uploadfile']['size'];
	$filetempname = $HTTP_POST_FILES['uploadfile']['tmp_name'];
	
	if ($filesize > $CONF['MaxUploadSize'])
		media_doError(_ERROR_FILE_TOO_BIG);
	
	// check file type against allowed types
	$ok = 0;
	$allowedtypes = explode (',', $CONF['AllowedTypes']);
	foreach ( $allowedtypes as $type ) 
		if (eregi("\." .$type. "$",$filename)) $ok = 1;    
	if (!$ok) media_doError(_ERROR_BADFILETYPE);
		
	if (!is_uploaded_file($filetempname)) 
		media_doError(_ERROR_BADREQUEST);

	// prefix filename with current date (YYYY-MM-DD-)
	// this to avoid nameclashes
	if ($CONF['MediaPrefix'])
		$filename = strftime("%Y%m%d-", time()) . $filename;

	$collection = requestVar('collection');
	$res = MEDIA::addMediaObject($collection, $filetempname, $filename);

	if ($res != '') 
		media_doError($res);
	
	// shows updated list afterwards
	media_select();
}

function media_loginAndPassThrough() {
	media_head();
	?>
		<h1><?php echo _LOGIN_PLEASE?></h1>
	
		<form method="post" action="media.php">
		<div>
			<input name="action" value="login" type="hidden" />
			<input name="collection" value="<?php echo htmlspecialchars(requestVar('collection'))?>" type="hidden" />			
			<?php echo _LOGINFORM_NAME?>: <input name="login" />
			<br /><?php echo _LOGINFORM_PWD?>: <input name="password" type="password" />
			<br /><input type="submit" value="<?php echo _LOGIN?>" />
		</div>
		</form>
		<p><a href="media.php" onclick="window.close();"><?php echo _POPUP_CLOSE?></a></p>
	<?php	media_foot();
	exit;
}

function media_doError($msg) {
	media_head();
	?>
	<h1><?php echo _ERROR?></h1>
	<p><?php echo $msg?></p>
	<p><a href="media.php" onclick="history.back()"><?php echo _BACK?></a></p>
	<?php	media_foot();
	exit;
}


function media_head() {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html>
	<head>
		<title>Nucleus Media</title>
		<style><!--
			@import url('styles/popups.css');
		--></style>
		<script type="text/javascript">
			var type = 0;
			function setType(val) { type = val; }
			
			function chooseImage(collection, filename, width, height) {
				window.blur();
				window.opener.includeImage(collection,
										   filename, 
				                           type == 0 ? 'inline' : 'popup',
				                           width,
				                           height
				                           );
				window.close();
			}
			
			function chooseOther(collection, filename) {
				window.opener.includeOtherMedia(collection, filename);
				window.close();
			
			}
		</script>
	</head>
	<body>		
<?php }

function media_foot() {
?>
	</body>
	</html>	
<?php }	

?>
