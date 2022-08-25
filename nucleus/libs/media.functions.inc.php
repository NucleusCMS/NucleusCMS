<?php

// select a file
function media_select()
{
    global $member, $CONF, $DIR_MEDIA, $manager;

    // show 10 files + navigation buttons
    // show msg when no files
    // show upload form
    // files sorted according to last modification date

    // currently selected collection
    $currentCollection = (string) requestVar('collection');
    if (!$currentCollection || !@is_dir($DIR_MEDIA . $currentCollection)) {
        $currentCollection = $member->getID();
    }

    // avoid directory travarsal and accessing invalid directory
    if (!MEDIA::isValidCollection($currentCollection)) {
        media_doError(_ERROR_DISALLOWED);
    }

    media_head();

    // get collection list
    $collections = MEDIA::getCollectionList();

    if (count($collections) > 1) {
        ?>
        <form method="post" action="media.php">
            <div>
                <label for="media_collection"><?php echo hsc(_MEDIA_COLLECTION_LABEL) ?></label>
                <select name="collection" id="media_collection">
                    <?php foreach ($collections as $dirname => $description) {
                        echo '<option value="', hsc($dirname), '"';
                        if ($dirname == $currentCollection) {
                            echo ' selected="selected"';
                        }
                        echo '>', hsc($description), '</option>';
                    }
        ?>
                </select>
                <input type="submit" name="action" value="<?php echo hsc(_MEDIA_COLLECTION_SELECT) ?>" title="<?php echo hsc(_MEDIA_COLLECTION_TT) ?>" />
                <input type="submit" name="action" value="<?php echo hsc(_MEDIA_UPLOAD_TO) ?>" title="<?php echo hsc(_MEDIA_UPLOADLINK) ?>" />
                <?php $manager->addTicketHidden() ?>
            </div>
        </form>
    <?php    } else {
        ?>
        <form method="post" action="media.php" style="float:right">
            <div>
                <input type="hidden" name="collection" value="<?php echo hsc($currentCollection) ?>" />
                <input type="submit" name="action" value="<?php echo hsc(_MEDIA_UPLOAD_NEW) ?>" title="<?php echo hsc(_MEDIA_UPLOADLINK) ?>" />
                <?php $manager->addTicketHidden() ?>
            </div>
        </form>
    <?php    } // if sizeof

    $filter = requestVar('filter');
    $offset = intRequestVar('offset');
    $arr    = MEDIA::getMediaListByCollection($currentCollection, $filter);

    ?>
    <form method="post" action="media.php">
        <div>
            <label for="media_filter"><?php echo hsc(_MEDIA_FILTER_LABEL) ?></label>
            <input id="media_filter" type="text" name="filter" value="<?php echo hsc($filter) ?>" />
            <input type="submit" name="action" value="<?php echo hsc(_MEDIA_FILTER_APPLY) ?>" />
            <input type="hidden" name="collection" value="<?php echo hsc($currentCollection) ?>" />
            <input type="hidden" name="offset" value="<?php echo intval($offset) ?>" />
        </div>
    </form>

    <?php

    ?>
    <table width="100%">
        <caption><?php echo _MEDIA_COLLECTION_LABEL . hsc($collections[$currentCollection]) ?></caption>
        <tr>
            <th><?php echo _MEDIA_MODIFIED ?></th>
            <th><?php echo _MEDIA_FILENAME ?></th>
            <th><?php echo _MEDIA_DIMENSIONS ?></th>
        </tr>

        <?php

        $idxStart = 0;
    $idxEnd       = 0;

    if (count($arr) > 0) {
        if (($offset + $CONF['MediaPerPage']) >= count($arr)) {
            $offset = count($arr) - $CONF['MediaPerPage'];
        }

        if ($offset < 0) {
            $offset = 0;
        }

        $idxStart = $offset;
        $idxEnd   = $offset + $CONF['MediaPerPage'];
        $idxNext  = $idxEnd;
        $idxPrev  = $idxStart - $CONF['MediaPerPage'];

        if ($idxPrev < 0) {
            $idxPrev = 0;
        }

        if ($idxEnd > count($arr)) {
            $idxEnd = count($arr);
        }

        error_reporting(error_reporting(0));
        for ($i = $idxStart; $i < $idxEnd; $i++) {
            $obj  = $arr[$i];
            $size = @GetImageSize($DIR_MEDIA . $currentCollection . '/' . $obj->filename);
            echo "<tr>";
            if ($size[2] != 0) { // image (gif/jpg/png/swf)
                $image_url = $CONF['MediaURL'] . $currentCollection . '/' . $obj->filename;
                echo sprintf(
                    '<td>%s</td>',
                    date("Y-m-d", $obj->timestamp)
                );
                echo '<td>';
                echo sprintf(
                    '<a href="media.php" onclick="chooseImage(%s)" title="%s">%s</a>',
                    sprintf(
                        "'%s','%s','%s','%s'",
                        hsc(str_replace("'", "\\'", $currentCollection)),
                        hsc(str_replace("'", "\\'", $obj->filename)),
                        hsc($size[0]),
                        hsc($size[1])
                    ),
                    hsc($obj->filename),
                    hsc(shorten($obj->filename, 25, '...'))
                );
                echo sprintf(
                    ' (<a href="%s" onclick="window.open(this.href); return false;" title="%s">%s</a>)',
                    hsc($image_url),
                    hsc(_MEDIA_VIEW_TT),
                    _MEDIA_VIEW
                );
                echo '</td>';
            } else {
                echo "<td>" . date("Y-m-d", $obj->timestamp) . "</td>";
                echo sprintf(
                    '<td><a href="media.php" onclick="chooseOther(%s)" title="%s">%s</a></td>',
                    sprintf(
                        "'%s','%s'",
                        hsc(str_replace("'", "\\'", $currentCollection)),
                        hsc(str_replace("'", "\\'", $obj->filename))
                    ),
                    hsc($obj->filename),
                    hsc(shorten($obj->filename, 30, '...'))
                );
            }
            echo sprintf('<td>%sx%s</td>', hsc($size[0]), hsc($size[1]));
            echo '</tr>';
        }
    } // if (sizeof($arr)>0)
    ?>

    </table>
    <?php
    if ($idxStart > 0) {
        echo "<a href='media.php?offset={$idxPrev}&amp;collection=" . urlencode($currentCollection) . "'>" . _LISTS_PREV . "</a> ";
    }
    if ($idxEnd < count($arr)) {
        echo "<a href='media.php?offset={$idxNext}&amp;collection=" . urlencode($currentCollection) . "'>" . _LISTS_NEXT . "</a> ";
    }

    ?>
    <input id="typeradio0" type="radio" name="typeradio" onclick="setType(0);" checked="checked" /><label for="typeradio0"><?php echo _MEDIA_INLINE ?></label>
    <input id="typeradio1" type="radio" name="typeradio" onclick="setType(1);" /><label for="typeradio1"><?php echo _MEDIA_POPUP ?></label>
    <?php
    media_foot();
}

/**
 * Shows a screen where you can select the file to upload
 */
function media_choose()
{
    global $CONF, $manager;

    $currentCollection = requestVar('collection');

    $collections = MEDIA::getCollectionList();

    media_head();
    ?>
    <h1><?php echo _UPLOAD_TITLE ?></h1>

    <p><?php echo _UPLOAD_MSG ?></p>

    <form method="post" enctype="multipart/form-data" action="media.php">
        <div>
            <input type="hidden" name="action" value="uploadfile" />
            <?php $manager->addTicketHidden() ?>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $CONF['MaxUploadSize'] ?>" />
            File:
            <br />
            <input name="uploadfile" type="file" size="40" />
            <?php if (count($collections) > 1) {
                ?>
                <br /><br /><label for="upload_collection">Collection:</label>
                <br /><select name="collection" id="upload_collection">
                    <?php foreach ($collections as $dirname => $description) {
                        echo '<option value="', hsc($dirname), '"';
                        if ($dirname == $currentCollection) {
                            echo ' selected="selected"';
                        }
                        echo '>', hsc($description), '</option>';
                    }
                ?>
                </select>
            <?php        } else {
                ?>
                <input name="collection" type="hidden" value="<?php echo hsc(requestVar('collection')) ?>" />
            <?php        } // if sizeof
    ?>
            <br /><br />
            <?php
    $data = array();
    $manager->notify('MediaUploadFormExtras', $data);
    ?>
            <br /><br />
            <input type="submit" value="<?php echo _UPLOAD_BUTTON ?>" onclick="if (this.form.uploadfile.value == '') { alert('Select a file before clicking'); return false; }" />
        </div>
    </form>

    <?php
    media_foot();
}

/**
 * accepts a file for upload
 */
function media_upload()
{
    global $CONF;

    $uploadInfo = postFileInfo('uploadfile');

    $filename     = $uploadInfo['name'];
    $filetype     = $uploadInfo['type'];
    $filesize     = $uploadInfo['size'];
    $filetempname = $uploadInfo['tmp_name'];
    $fileerror    = intval($uploadInfo['error']);

    // clean filename of characters that may cause trouble in a filename using cleanFileName() function from globalfunctions.php
    $filename = cleanFileName($filename);
    if ($filename === false) {
        media_doError(_ERROR_BADFILETYPE);
    }

    switch ($fileerror) {
        case 0: // = UPLOAD_ERR_OK
            break;
        case 1: // = UPLOAD_ERR_INI_SIZE
        case 2:    // = UPLOAD_ERR_FORM_SIZE
            media_doError(_ERROR_FILE_TOO_BIG);
            // no break
        case 3: // = UPLOAD_ERR_PARTIAL
        case 4: // = UPLOAD_ERR_NO_FILE
        case 6: // = UPLOAD_ERR_NO_TMP_DIR
        case 7: // = UPLOAD_ERR_CANT_WRITE
        default:
            // include error code for debugging
            // (see http://www.php.net/manual/en/features.file-upload.errors.php)
            media_doError(_ERROR_BADREQUEST . ' (' . $fileerror . ')');
    }

    if ($filesize > $CONF['MaxUploadSize']) {
        media_doError(_ERROR_FILE_TOO_BIG);
    }

    // check file type against allowed types
    $ok           = 0;
    $allowedtypes = MEDIA::getAllowedTypes();
    foreach ($allowedtypes as $type) {
        //if (eregi("\." .$type. "$",$filename)) $ok = 1;
        if (preg_match("#\." . $type . "$#i", $filename)) {
            $ok = 1;
        }
    }
    if (!$ok) {
        media_doError(_ERROR_BADFILETYPE);
    }

    if (!is_uploaded_file($filetempname)) {
        media_doError(_ERROR_BADREQUEST);
    }

    // prefix filename with current date (YYYY-MM-DD-)
    // this to avoid nameclashes
    if ($CONF['MediaPrefix']) {
        $filename = date("Ymd-", time()) . $filename;
    }

    $collection = requestVar('collection');
    $res        = MEDIA::addMediaObject($collection, $filetempname, $filename);

    if ($res != '') {
        media_doError($res);
    }

    // shows updated list afterwards
    media_select();
}

function media_loginAndPassThrough()
{
    media_head();
    ?>
    <h1><?php echo _LOGIN_PLEASE ?></h1>

    <form method="post" action="media.php">
        <div>
            <input name="action" value="login" type="hidden" />
            <input name="collection" value="<?php echo hsc(requestVar('collection')) ?>" type="hidden" />
            <?php echo _LOGINFORM_NAME ?>: <input name="login" />
            <br /><?php echo _LOGINFORM_PWD ?>: <input name="password" type="password" />
            <br /><input type="submit" value="<?php echo _LOGIN ?>" />
        </div>
    </form>
    <p><a href="media.php" onclick="window.close();"><?php echo _POPUP_CLOSE ?></a></p>
    <?php media_foot();
    exit;
}

function media_doError($msg)
{
    media_head();
    ?>
    <h1><?php echo _ERROR ?></h1>
    <p><?php echo $msg ?></p>
    <p><a href="media.php" onclick="history.back()"><?php echo _BACK ?></a></p>
    <?php media_foot();
    exit;
}

function media_head()
{
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Nucleus Media</title>
        <link rel="stylesheet" type="text/css" href="styles/popups.css" />
        <script type="text/javascript">
            var type = 0;

            function setType(val) {
                type = val;
            }

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

function media_foot()
{
    ?>
    </body>
    </html>
    <?php
}
