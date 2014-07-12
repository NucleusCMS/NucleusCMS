<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * Media popup window for Nucleus
 *
 * Purpose:
 *   - can be openen from an add-item form or bookmarklet popup
 *   - shows a list of recent files, allowing browsing, search and
 *     upload of new files
 *   - close the popup by selecting a file in the list. The file gets
 *     passed through to the add-item form (linkto, popupimg or inline img)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 *
 */

$CONF = array();

// defines how much media items will be shown per page. You can override this
// in config.php if you like. (changing it in config.php instead of here will
// allow your settings to be kept even after a Nucleus upgrade)
$CONF['MediaPerPage'] = 10;

// include all classes and config data
$DIR_LIBS = '';
require_once('../config.php');
//include($DIR_LIBS . 'MEDIA.php');	// media classes
include_libs('MEDIA.php',false,false);

sendContentType('application/xhtml+xml', 'media');

// user needs to be logged in to use this
if (!$member->isLoggedIn()) {
	media_loginAndPassThrough();
	exit;
}

// check if member is on at least one teamlist
$query = 'SELECT * FROM ' . sql_table('team'). ' WHERE tmember=' . $member->getID();
$teams = sql_query($query);
if (sql_num_rows($teams) == 0 && !$member->isAdmin())
	media_doError(_ERROR_DISALLOWEDUPLOAD);

// get action
$action = requestVar('action');
if ($action == '')
	$action = 'selectmedia';

// check ticket
$aActionsNotToCheck = array('selectmedia', _MEDIA_FILTER_APPLY, _MEDIA_COLLECTION_SELECT);
if (!in_array($action, $aActionsNotToCheck))
{
	if (!$manager->checkTicket())
		media_doError(_ERROR_BADTICKET);
}


switch($action) {
	case 'chooseupload':
	case _MEDIA_UPLOAD_TO:
	case _MEDIA_UPLOAD_NEW:
		if (!$member->isAdmin() and $CONF['AllowUpload'] != true) {
			media_doError(_ERROR_DISALLOWED);
		} else {
			media_choose();
		}
		break;
	case 'uploadfile':
		if (!$member->isAdmin() and $CONF['AllowUpload'] != true) {
			media_doError(_ERROR_DISALLOWED);
		} else {
			media_upload();
		}
		break;
	case _MEDIA_FILTER_APPLY:
	case 'selectmedia':
	case _MEDIA_COLLECTION_SELECT:
	default:
		media_select();
		break;
}

// select a file
function media_select() {
	global $member, $CONF, $DIR_MEDIA, $manager;

	// show 10 files + navigation buttons
	// show msg when no files
	// show upload form
	// files sorted according to last modification date

	// currently selected collection
	$currentCollection = requestVar('collection');
	if (!$currentCollection || !@is_dir($DIR_MEDIA . $currentCollection))
		$currentCollection = $member->getID();

	// avoid directory travarsal and accessing invalid directory
	if (!MEDIA::isValidCollection($currentCollection)) media_doError(_ERROR_DISALLOWED);

	media_head();

	// get collection list
	$collections = MEDIA::getCollectionList();

	if (sizeof($collections) > 1) {
	?>
		<form method="post" action="media.php"><div>
			<label for="media_collection"><?php echo htmlspecialchars(_MEDIA_COLLECTION_LABEL,ENT_QUOTES,_CHARSET)?></label>
			<select name="collection" id="media_collection">
				<?php					foreach ($collections as $dirname => $description) {
						echo '<option value="',htmlspecialchars($dirname,ENT_QUOTES,_CHARSET),'"';
						if ($dirname == $currentCollection) {
							echo ' selected="selected"';
						}
						echo '>',htmlspecialchars($description,ENT_QUOTES,_CHARSET),'</option>';
					}
				?>
			</select>
			<input type="submit" name="action" value="<?php echo htmlspecialchars(_MEDIA_COLLECTION_SELECT,ENT_QUOTES,_CHARSET) ?>" title="<?php echo htmlspecialchars(_MEDIA_COLLECTION_TT,ENT_QUOTES,_CHARSET)?>" />
			<input type="submit" name="action" value="<?php echo htmlspecialchars(_MEDIA_UPLOAD_TO,ENT_QUOTES,_CHARSET) ?>" title="<?php echo htmlspecialchars(_MEDIA_UPLOADLINK,ENT_QUOTES,_CHARSET) ?>" />
			<?php $manager->addTicketHidden() ?>
		</div></form>
	<?php	} else {
	?>
		<form method="post" action="media.php" style="float:right"><div>
			<input type="hidden" name="collection" value="<?php echo htmlspecialchars($currentCollection,ENT_QUOTES,_CHARSET)?>" />
			<input type="submit" name="action" value="<?php echo htmlspecialchars(_MEDIA_UPLOAD_NEW,ENT_QUOTES,_CHARSET) ?>" title="<?php echo htmlspecialchars(_MEDIA_UPLOADLINK,ENT_QUOTES,_CHARSET) ?>" />
			<?php $manager->addTicketHidden() ?>
		</div></form>
	<?php	} // if sizeof

	$filter = requestVar('filter');
	$offset = intRequestVar('offset');
	$arr = MEDIA::getMediaListByCollection($currentCollection, $filter);

	?>
		<form method="post" action="media.php"><div>
			<label for="media_filter"><?php echo htmlspecialchars(_MEDIA_FILTER_LABEL,ENT_QUOTES,_CHARSET)?></label>
			<input id="media_filter" type="text" name="filter" value="<?php echo htmlspecialchars($filter,ENT_QUOTES,_CHARSET)?>" />
			<input type="submit" name="action" value="<?php echo htmlspecialchars(_MEDIA_FILTER_APPLY,ENT_QUOTES,_CHARSET) ?>" />
			<input type="hidden" name="collection" value="<?php echo htmlspecialchars($currentCollection,ENT_QUOTES,_CHARSET)?>" />
			<input type="hidden" name="offset" value="<?php echo intval($offset)?>" />
		</div></form>

	<?php

	?>
		<table width="100%">
		<caption><?php echo _MEDIA_COLLECTION_LABEL . htmlspecialchars($collections[$currentCollection],ENT_QUOTES,_CHARSET)?></caption>
		<tr>
		 <th><?php echo _MEDIA_MODIFIED?></th><th><?php echo _MEDIA_FILENAME?></th><th><?php echo _MEDIA_DIMENSIONS?></th>
		</tr>

	<?php

	$idxStart = 0;
	$idxEnd = 0;
	
	if (sizeof($arr)>0) {

		if (($offset + $CONF['MediaPerPage']) >= sizeof($arr))
			$offset = sizeof($arr) - $CONF['MediaPerPage'];

		if ($offset < 0) $offset = 0;

		$idxStart = $offset;
		$idxEnd = $offset + $CONF['MediaPerPage'];
		$idxNext = $idxEnd;
		$idxPrev = $idxStart - $CONF['MediaPerPage'];

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

			// strings for javascript
			$jsCurrentCollection = str_replace("'","\\'",$currentCollection);
			$jsFileName = str_replace("'","\\'",$obj->filename);

			if ($filetype != 0) {
				// image (gif/jpg/png/swf)
				echo "<td><a href=\"media.php\" onclick=\"chooseImage('", htmlspecialchars($jsCurrentCollection,ENT_QUOTES,_CHARSET), "','", htmlspecialchars($jsFileName,ENT_QUOTES,_CHARSET), "',"
							   . "'", htmlspecialchars($width,ENT_QUOTES,_CHARSET), "','" , htmlspecialchars($height,ENT_QUOTES,_CHARSET), "'"
							   . ")\" title=\"" . htmlspecialchars($obj->filename,ENT_QUOTES,_CHARSET). "\">"
							   . htmlspecialchars(shorten($obj->filename,25,'...'),ENT_QUOTES,_CHARSET)
							   ."</a>";
				echo ' (<a href="', htmlspecialchars($CONF['MediaURL'] . $currentCollection . '/' . $obj->filename,ENT_QUOTES,_CHARSET), '" onclick="window.open(this.href); return false;" title="',htmlspecialchars(_MEDIA_VIEW_TT,ENT_QUOTES,_CHARSET),'">',_MEDIA_VIEW,'</a>)';
				echo "</td>";
			} else {
				// no image (e.g. mpg)
				echo "<td><a href='media.php' onclick=\"chooseOther('" , htmlspecialchars($jsCurrentCollection,ENT_QUOTES,_CHARSET), "','", htmlspecialchars($jsFileName,ENT_QUOTES,_CHARSET), "'"
							   . ")\" title=\"" . htmlspecialchars($obj->filename,ENT_QUOTES,_CHARSET). "\">"
							   . htmlspecialchars(shorten($obj->filename,30,'...'),ENT_QUOTES,_CHARSET)
							   ."</a></td>";

			}
			echo '<td>' , htmlspecialchars($width,ENT_QUOTES,_CHARSET) , 'x' , htmlspecialchars($height,ENT_QUOTES,_CHARSET) , '</td>';
			echo '</tr>';
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
	global $CONF, $member, $manager;

	$currentCollection = requestVar('collection');

	$collections = MEDIA::getCollectionList();

	media_head();
	?>
	<h1><?php echo _UPLOAD_TITLE?></h1>

	<p><?php echo _UPLOAD_MSG?></p>

	<form method="post" enctype="multipart/form-data" action="media.php">
	<div>
	  <input type="hidden" name="action" value="uploadfile" />
	  <?php $manager->addTicketHidden() ?>
	  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $CONF['MaxUploadSize']?>" />
	  File:
	  <br />
	  <input name="uploadfile" type="file" size="40" />
	<?php		if (sizeof($collections) > 1) {
	?>
		<br /><br /><label for="upload_collection">Collection:</label>
		<br /><select name="collection" id="upload_collection">
			<?php				foreach ($collections as $dirname => $description) {
					echo '<option value="',htmlspecialchars($dirname,ENT_QUOTES,_CHARSET),'"';
					if ($dirname == $currentCollection) {
						echo ' selected="selected"';
					}
					echo '>',htmlspecialchars($description,ENT_QUOTES,_CHARSET),'</option>';
				}
			?>
		</select>
	<?php		} else {
	?>
		<input name="collection" type="hidden" value="<?php echo htmlspecialchars(requestVar('collection'),ENT_QUOTES,_CHARSET)?>" />
	<?php		} // if sizeof
	?>
	<br /><br />
	<?php
	$data = array();
	$manager->notify('MediaUploadFormExtras', $data);
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
	global $DIR_MEDIA, $member, $CONF;

	$uploadInfo = postFileInfo('uploadfile');

	$filename = $uploadInfo['name'];
	$filetype = $uploadInfo['type'];
	$filesize = $uploadInfo['size'];
	$filetempname = $uploadInfo['tmp_name'];
	$fileerror = intval($uploadInfo['error']);
	
	// clean filename of characters that may cause trouble in a filename using cleanFileName() function from globalfunctions.php
	$filename = cleanFileName($filename);
	if ($filename === false) 
		media_doError(_ERROR_BADFILETYPE);
	
	switch ($fileerror)
	{
		case 0: // = UPLOAD_ERR_OK
			break;
		case 1: // = UPLOAD_ERR_INI_SIZE
		case 2:	// = UPLOAD_ERR_FORM_SIZE
			media_doError(_ERROR_FILE_TOO_BIG);
		case 3: // = UPLOAD_ERR_PARTIAL
		case 4: // = UPLOAD_ERR_NO_FILE
		case 6: // = UPLOAD_ERR_NO_TMP_DIR
		case 7: // = UPLOAD_ERR_CANT_WRITE
		default:
			// include error code for debugging
			// (see http://www.php.net/manual/en/features.file-upload.errors.php)
			media_doError(_ERROR_BADREQUEST . ' (' . $fileerror . ')');
	}

	if ($filesize > $CONF['MaxUploadSize'])
		media_doError(_ERROR_FILE_TOO_BIG);

	// check file type against allowed types
	$ok = 0;
	$allowedtypes = explode (',', $CONF['AllowedTypes']);
	foreach ( $allowedtypes as $type )
	{
		//if (eregi("\." .$type. "$",$filename)) $ok = 1;
		if (preg_match("#\." .$type. "$#i",$filename)) $ok = 1;
	}
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
			<input name="collection" value="<?php echo htmlspecialchars(requestVar('collection'),ENT_QUOTES,_CHARSET)?>" type="hidden" />
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
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Nucleus Media</title>
		<link rel="stylesheet" type="text/css" href="styles/popups.css" />
		<script type="text/javascript">
			var type = 0;
			function setType(val) { type = val; }

			function chooseImage(collection, filename, width, height) {
				window.opener.focus();
				window.opener.includeImage(collection,
										   filename,
										   type == 0 ? 'inline' : 'popup',
										   width,
										   height
										   );
				window.close();
			}

			function chooseOther(collection, filename) {
				window.opener.focus();
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
