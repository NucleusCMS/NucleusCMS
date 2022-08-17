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
 * Media classes for nucleus
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

define('PRIVATE_COLLECTION', 'Private Collection');
define('READ_ONLY_MEDIA_FOLDER', '(Read Only)');

/**
 * Represents the media objects for a certain member
 */
class MEDIA
{

    /**
     * Gets the list of collections available to the currently logged
     * in member
     *
     * @returns array of dirname => display name
     */
    public static function getCollectionList($exceptReadOnly = false)
    {
        global $member, $DIR_MEDIA;

        $collections = array();

        // add private directory for member
        $collections[$member->getID()] = PRIVATE_COLLECTION;

        // add global collections
        if (! is_dir($DIR_MEDIA)) {
            return $collections;
        }

        $dirhandle = opendir($DIR_MEDIA);
        while ($dirname = readdir($dirhandle)) {
            // only add non-numeric (numeric=private) dirs
            if (@is_dir($DIR_MEDIA . $dirname)
                && (!str_starts_with($dirname, '.')) //  . ..  and other dot started folder
                && ($dirname !== 'CVS')
                && ( ! is_numeric($dirname))) {
                if (@is_writable($DIR_MEDIA . $dirname)) {
                    $collections[$dirname] = $dirname;
                } else {
                    if ($exceptReadOnly == false) {
                        $collections[$dirname] = $dirname . ' '
                                                 . READ_ONLY_MEDIA_FOLDER;
                    }
                }
            }
        }
        closedir($dirhandle);

        return $collections;
    }

    /**
     * Returns an array of MEDIAOBJECT objects for a certain collection
     *
     * @param $collection
     *        name of the collection
     * @param $filter
     *        filter on filename (defaults to none)
     */
    public static function getMediaListByCollection($collection, $filter = '')
    {
        global $DIR_MEDIA;

        $filelist = array();

        // 1. go through all objects and add them to the filelist

        $mediadir = $DIR_MEDIA . $collection . '/';

        // return if dir does not exist
        if (! is_dir($mediadir)) {
            return $filelist;
        }

        $dirhandle = opendir($mediadir);
        while ($filename = readdir($dirhandle)) {
            if (str_starts_with($filename, '.')
               || str_ends_with($filename, '.tmp')
               || preg_match('/^(Thumbs\.db|desktop\.ini)$/i', $filename) // windows hidden system files
                ) {
                continue;
            }
            // only add files that match the filter
            if (! @is_dir($filename)
                 && MEDIA::checkFilter($filename, $filter)) {
                $filelist[] = new MEDIAOBJECT(
                    $collection,
                    $filename,
                    filemtime($mediadir . $filename)
                );
            }
        }
        closedir($dirhandle);

        // sort array so newer files are shown first
        usort($filelist, 'sort_media');

        return $filelist;
    }

    public static function checkFilter($strText, $strFilter)
    {
        if ($strFilter == '') {
            return 1;
        }
        return is_int(strpos(strtolower($strText), strtolower($strFilter)));
    }

    /**
     * checks if a collection exists with the given name, and if it's
     * allowed for the currently logged in member to upload files to it
     */
    public static function isValidCollection(
        $collectionName,
        $exceptReadOnly = false
    ) {
        global $member, $DIR_MEDIA;

        if (!is_string($collectionName)) {
            $collectionName = (string) $collectionName;
        }
        // allow creating new private directory
        if ($collectionName === (string)$member->getID()) {
            return true;
        }

        $collections = MEDIA::getCollectionList($exceptReadOnly);
        $dirname     = $collections[$collectionName];
        if ($dirname == null || $dirname === PRIVATE_COLLECTION) {
            return false;
        }

        // other collections should exist and be writable
        $collectionDir = $DIR_MEDIA . $collectionName;
        if ($exceptReadOnly) {
            return (@is_dir($collectionDir) && @is_writable($collectionDir));
        }

        // other collections should exist
        return @is_dir($collectionDir);
    }

    /**
     * Adds an uploaded file to the media archive
     *
     * @param   collection
     *        collection
     * @param   uploadfile
     *        the postFileInfo(..) array
     * @param   filename
     *        the filename that should be used to save the file as
     *        (date prefix should be already added here)
     */
    public static function addMediaObject($collection, $uploadfile, $filename)
    {
        global $DIR_MEDIA, $manager;

        if (!self::checkMemberHasUploadRights()) {
            return _ERROR_DISALLOWEDUPLOAD;
        }

        // clean filename of characters that may cause trouble in a filename using cleanFileName() function from globalfunctions.php
        $filename = cleanFileName($filename);
        // should already have tested for allowable types before calling this method. This will only catch files with no extension at all
        if ($filename === false || str_starts_with(trim($filename), '.')) {
            return _ERROR_BADFILETYPE;
        }

        // check exist && not root dir
        $mediadir = !empty($DIR_MEDIA) ? str_replace('\\', '/', @realpath($DIR_MEDIA)) : false;
        if ($mediadir === false
           || str_ends_with($mediadir, '/') // rootdir
           || !@is_dir($mediadir)
        ) {
            return _ERROR_DISALLOWED;
//            return __ERROR.': '._SETTINGS_MEDIADIR;
        }
        $DIR_MEDIA = $mediadir . '/';

        $param = array(
            'collection' => &$collection,
            'uploadfile' => $uploadfile,
            'filename'   => &$filename,
        );
        $manager->notify('PreMediaUpload', $param);

        $collection = str_replace('\\', '/', (string) $collection);
        // don't allow uploads to unknown or forbidden collections
        $exceptReadOnly = true;
        if (! MEDIA::isValidCollection($collection, $exceptReadOnly)) {
            return _ERROR_DISALLOWED;
        }

        // check dir permissions (try to create dir if it does not exist)
        $mediadir .= '/' . $collection;

        // try to create new private media directories if needed
        if (! @is_dir($mediadir) && is_numeric($collection)) {
            $oldumask = umask(0000);
            if (! mkdir($mediadir, 0777) && ! is_dir($mediadir)) {
                return _ERROR_BADPERMISSIONS;
            }
            umask($oldumask);
        }

        // if dir still not exists, the action is disallowed
        if (! @is_dir($mediadir)) {
            return _ERROR_DISALLOWED;
        }

        if (! is_writable($mediadir)) {
            return _ERROR_BADPERMISSIONS;
        }

        // add trailing slash (don't add it earlier since it causes mkdir to fail on some systems)
        $mediadir .= '/';

        if (is_file($mediadir . $filename)) {
            return _ERROR_UPLOADDUPLICATE;
        }

        if (!self::checkFileData($uploadfile, $mediadir . $filename)) {
            return _ERROR_BADFILETYPE;
        }

        // move file to directory
        if (is_uploaded_file($uploadfile)) {
            if (! @move_uploaded_file($uploadfile, $mediadir . $filename)) {
                return _ERROR_UPLOADMOVEP;
            }
        } else {
            if (! copy($uploadfile, $mediadir . $filename)) {
                return _ERROR_UPLOADCOPY;
            }
        }

        // chmod uploaded file
        $oldumask = umask(0000);
        @chmod($mediadir . $filename, 0644);
        umask($oldumask);

        $param = array(
            'collection' => $collection,
            'mediadir'   => $mediadir,
            'filename'   => $filename,
        );
        $manager->notify('PostMediaUpload', $param);

        return '';
    }

    /**
     * Adds an uploaded file to the media dir.
     *
     * @param $collection
     *        collection to use
     * @param $filename
     *        the filename that should be used to save the file as
     *        (date prefix should be already added here)
     * @param &$data
     *        File data (binary)
     *
     * NOTE: does not check if $collection is valid.
     */
    public static function addMediaObjectRaw($collection, $filename, &$data)
    {
        global $DIR_MEDIA, $CONF;

        if (!self::checkMemberHasUploadRights()) {
            return _ERROR_DISALLOWEDUPLOAD;
        }

        if (strlen($data) == 0 || (int) $CONF['MaxUploadSize'] < strlen($data)) {
            return _ERROR_DISALLOWED;
        }
        
        // check exist && not root dir
        $mediadir = !empty($DIR_MEDIA) ? str_replace('\\', '/', @realpath($DIR_MEDIA)) : false;
        if ($mediadir === false
           || str_ends_with($mediadir, '/') // rootdir
           || !@is_dir($mediadir)
        ) {
            return _ERROR_DISALLOWED;
//            return __ERROR.': '._SETTINGS_MEDIADIR;
        }
        
        // create tmpdir
        $tmpdir = "{$mediadir}/.ht.tmp.dir"; // Normal apache configuration disallows web access starting with .ht
        if (!@file_exists($tmpdir)) {
            @mkdir($tmpdir);
            if (@is_dir($tmpdir) && !@is_file($tmpdir . '/.htaccess')) {
                if (isset($_SERVER['SERVER_SOFTWARE']) && preg_match('|^\s*Apache/(\d\.\d)\.|i', $_SERVER['SERVER_SOFTWARE'], $m)) {
                    if ((float) $m[1] < 2.4) {
                        @file_put_contents($tmpdir . '/.htaccess', "Order allow,deny\ndeny from all\n");
                    } else {
                        @file_put_contents($tmpdir . '/.htaccess', "Require all denied\n");
                    }
                }
            }
        }
        if (!@is_dir($tmpdir) || !is_writable($tmpdir)) {
            return _ERROR_UPLOADFAILED;
        }
        
        // Clean files : on debug , PHP timeout , other reason
        foreach (glob($tmpdir . "/tmp*.tmp") as $filename) {
            $t = filemtime($filename);
            if ($t !== false && ($t < time() - 3*60)) {
                // 3 minutes passed
                @unlink($filename);
            }
        }
        
        // Send to the addMediaObject function for event processing and various checks
        // create tmpfile
        $tmp_filename = tempnam("{$tmpdir}/", sprintf('tmp-%s-', date('YmdHis'))); // prefix Windows[0-3], Other[0-63]
        if ($tmp_filename === false) {
            return _ERROR_UPLOADFAILED;
        }
        $handle = @fopen($tmp_filename, "w");
        if (!$handle) {
            return _ERROR_UPLOADFAILED;
        }
        $res = _ERROR_UPLOADFAILED;
        try {
            $len = @fwrite($handle, $data);
            @fclose($handle);
            if ($len !== false && $len === strlen($data)) {
                $res = self::addMediaObject($collection, $tmp_filename, $filename);
            }
        } finally { // PHP[5.5-]  5.5\php -nr "try{}finally{}"
            if (@is_file($tmp_filename)) {
                @unlink($tmp_filename);
            }
        }
        return $res;
    }

    public static function getAllowedTypes()
    {
        global $CONF;
        $except = array(); // Add forbidden type here in lower case
        $allowedtypes = preg_split('|[,\s]+|', str_replace('.', ',', strtolower(trim((string) $CONF['AllowedTypes']))));
        if (false !== $allowedtypes) {
            $allowedtypes = array_unique(array_diff($allowedtypes, array('', 'htaccess', 'htpassword', 'tmp'), $except));
            sort($allowedtypes);
            return $allowedtypes;
        }
        return array();
    }

    public static function checkAllowedFilename($filename)
    {
        $basename = basename((string) $filename);
        if ($basename === ''
            || str_starts_with($basename, '.')
            || str_contains($filename, '..')
            || preg_match('/\.(conf|config|cgi|php|phar)$/i', $basename)
        ) {
            return false;
        }
        $ext = file_get_extension($basename);
        if (!$ext || !in_array($ext, self::getAllowedTypes())) {
            return false;
        }
        return true;
    }

    public static function checkFileData($src_filename, $new_filename)
    {
        global $CONF;
        if (!self::checkAllowedFilename($new_filename)) {
            return false;
        }
        if (! @is_file($src_filename) || @filesize($src_filename) < 1) {
            return false;
        }
        $ext = file_get_extension($new_filename);
        $type = array(
            'image' => array('jpg','jpeg','gif','png','tiff','bmp','ico','swf'),
            'movie' => array('mpg','avi','mov','mp3'),
        );
        if (defined('IMAGETYPE_WEBP')) {
            $type['image'][] = 'webp';
        }

        $fp = @fopen($src_filename, "rb");
        if (!$fp) {
            return false;
        }
        $buffer = fread($fp, 200);
        fclose($fp);

        $is_binary = ($buffer !== false) && (strpos($buffer, chr(0)) !== false);
        if (!$is_binary && in_array($ext, array_merge($type['image'], $type['movie']))) {
            return false;
        }
        if ($is_binary || in_array($ext, array_merge($type['image'], $type['movie']))) {
            if (str_starts_with($buffer, "#!")
                || str_contains($buffer, 'This program must be run under')
                || stripos($buffer, 'rewrite') !== false
                || stripos($buffer, 'handler') !== false
                || stripos($buffer, '<Files') !== false
            ) {
                return false;
            }
        }

        if (in_array($ext, $type['image'])) {
            $image_type = @exif_imagetype($src_filename);
            if ($image_type === false) {
                return false;
            }
//            if ($image_type == IMAGETYPE_JPEG) {
//                // IMAGETYPE_JPEG
//                // Todo: jpeg : remove exif GPS tag
//            }
        }

        return true;
    }

    public static function checkMemberHasUploadRights()
    {
        global $member, $CONF;
        if (!$member || !is_object($member) || !($member instanceof MEMBER) || !$member->isLoggedIn()) {
            return false;
        }
        if (!$member->isAdmin()) {
            if (false === (bool)$CONF['AllowUpload']) {
                return false;
            }
            $ct = (int) quickQuery(sprintf(
                'SELECT count(*) AS result FROM `%s` WHERE tmember=%d LIMIT 1',
                sql_table('team'),
                $member->getID()
            ));
            if ($ct == 0) {
                return false;
            }
        }
        return true;
    }
}

/**
 * Represents the characteristics of one single media-object
 *
 * Description of properties:
 *  - filename: filename, without paths
 *  - timestamp: last modification (unix timestamp)
 *  - collection: collection to which the file belongs (can also be a owner ID,
 *  for private collections)
 *  - private: true if the media belongs to a private member collection
 */
class MEDIAOBJECT
{

    public $private;
    public $collection;
    public $filename;
    public $timestamp;

    function __construct($collection, $filename, $timestamp)
    {
        $this->private    = is_numeric($collection);
        $this->collection = $collection;
        $this->filename   = $filename;
        $this->timestamp  = $timestamp;
    }
}

/**
 * User-defined sort method to sort an array of MEDIAOBJECTS
 */
function sort_media($a, $b)
{
    if ($a->timestamp == $b->timestamp) {
        return 0;
    }

    return ($a->timestamp > $b->timestamp) ? -1 : 1;
}
