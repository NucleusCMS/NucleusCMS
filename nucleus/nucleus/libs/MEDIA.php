<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * Media classes for nucleus
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2012 The Nucleus Group
 * @version $Id$
 */

define('PRIVATE_COLLECTION', 		'Private Collection');
define('READ_ONLY_MEDIA_FOLDER',	'(Read Only)');

class Media
{
	static public $thumbdir = '.thumb';
	static public $algorism = 'md5';
	static public $image_mime = array(
		'image/jpeg'	=> '.jpeg',
		'image/png'		=> '.png',
		'image/gif'		=> '.gif',
	);
	
	/**
	 * Media::getCollectionList()
	 * Gets the list of collections available to the currently logged
	 * in member
	 * 
	 * @param	boolean	$exceptReadOnly
	 * @return array	dirname => display name
	 */
	static public function getCollectionList($exceptReadOnly = FALSE)
	{
		global $member, $DIR_MEDIA;
		
		$collections = array();
		
		// add private directory for member
		$collections[$member->getID()] = PRIVATE_COLLECTION;
		
		// add global collections
		if ( !is_dir($DIR_MEDIA) )
		{
			return $collections;
		}
		
		$dirhandle = opendir($DIR_MEDIA);
		while ( $dirname = readdir($dirhandle) )
		{
			// only add non-numeric (numeric=private) dirs
			if ( @is_dir($DIR_MEDIA . $dirname) &&
				($dirname != '.') &&
				($dirname != '..') &&
				($dirname != self::$thumbdir) &&
				(!is_numeric($dirname)) )
				{
				if ( @is_writable($DIR_MEDIA . $dirname) )
				{
					$collections[$dirname] = $dirname;
				}
				else if ( $exceptReadOnly == FALSE )
				{
					$collections[$dirname] = $dirname . ' ' . READ_ONLY_MEDIA_FOLDER;
				}
			}
		}
		closedir($dirhandle);
		
		return $collections;
	}
	
	/**
	 * Media::getMediaListByCollection()
	 * Returns an array of MediaObject objects for a certain collection
	 *
	 * @param	string	$collection	name of the collection
	 * @param	string	$filter		filter on filename (defaults to none)
	 * @return	void
	 */
	static public function getMediaListByCollection($collection, $filter = '')
	{
		global $CONF, $DIR_MEDIA;
		
		$filelist = array();
		
		// 1. go through all objects and add them to the filelist
		$mediadir = $DIR_MEDIA . $collection . '/';
		
		// return if dir does not exist
		if ( !is_dir($mediadir) )
		{
			return $filelist;
		}
		
		$dirhandle = opendir($mediadir);
		while ( $filename = readdir($dirhandle) )
		{
			// only add files that match the filter
			if ( !is_dir($mediadir . $filename) && self::checkFilter($filename, $filter) )
			{
				array_push($filelist, new MediaObject($collection, $filename, $DIR_MEDIA));
			}
		}
		closedir($dirhandle);
		
		/* sort array */
		if ( !$CONF['MediaPrefix'] )
		{
			usort($filelist,  array(__CLASS__, 'sort_media_by_timestamp'));
		}
		else
		{
			usort($filelist,  array(__CLASS__, 'sort_media_by_filename'));
		}
		
		return $filelist;
	}
	
	/**
	 * Media::checkFilter()
	 * 
	 * @param	string	$strText
	 * @param	string	$strFilter
	 * @return	boolean
	 */
	static public function checkFilter($strText, $strFilter)
	{
		if ( $strFilter == '' )
		{
			return 1;
		}
		else
		{
			return is_integer(i18n::strpos(strtolower($strText), strtolower($strFilter)));
		}
	}
	
	/**
	 * Media::isValidCollection()
	 * checks if a collection exists with the given name, and if it's
	 * allowed for the currently logged in member to upload files to it
	 * 
	 * @param	string	$collectionName
	 * @param	string	$exceptReadOnly
	 * @return	boolean
	 */
	static public function isValidCollection($collectionName, $exceptReadOnly = FALSE)
	{
		global $member, $DIR_MEDIA;
		
		// allow creating new private directory
		if ( $collectionName === (string)$member->getID() )
		{
			return TRUE;
		}
		
		$collections = self::getCollectionList($exceptReadOnly);
		$dirname = $collections[$collectionName];
		
		if ( $dirname == NULL || $dirname === PRIVATE_COLLECTION )
		{
			return FALSE;
		}
		
		// other collections should exist and be writable
		$collectionDir = $DIR_MEDIA . $collectionName;
		if ( $exceptReadOnly )
		{
			return ( @is_dir($collectionDir) && @is_writable($collectionDir) );
		}
		
		// other collections should exist
		return @is_dir($collectionDir);
	}
	
	/**
	 * Media::addMediaObject()
	 * Adds an uploaded file to the media archive
	 *
	 * @param	string	$collection	collection
	 * @param	array	$uploadfile	the postFileInfo(..) array
	 * @param	string	$filename	the filename that should be used to save the file as
	 * 								(date prefix should be already added here)
	 * @return	string	blank if success, message if failed
	 */
	static public function addMediaObject($collection, $uploadfile, $filename)
	{
		global $DIR_MEDIA, $manager;
		
		// clean filename of characters that may cause trouble in a filename using cleanFileName() function from globalfunctions.php
		$filename = cleanFileName($filename);
		
		// should already have tested for allowable types before calling this method. This will only catch files with no extension at all
		if ( $filename === FALSE )
		{
			return _ERROR_BADFILETYPE;
		}
		
		// trigger PreMediaUpload event
		$manager->notify('PreMediaUpload',array('collection' => &$collection, 'uploadfile' => $uploadfile, 'filename' => &$filename));
		
		// don't allow uploads to unknown or forbidden collections
		$exceptReadOnly = TRUE;
		if ( !self::isValidCollection($collection,$exceptReadOnly) )
		{
			return _ERROR_DISALLOWED;
		}
		
		// check dir permissions (try to create dir if it does not exist)
		$mediadir = $DIR_MEDIA . $collection;
		
		// try to create new private media directories if needed
		if ( !@is_dir($mediadir) && is_numeric($collection) )
		{
			$oldumask = umask(0000);
			if ( !@mkdir($mediadir, 0777) )
			{
				return _ERROR_BADPERMISSIONS;
			}
			umask($oldumask);
		}
		
		// if dir still not exists, the action is disallowed
		if ( !@is_dir($mediadir) )
		{
			return _ERROR_DISALLOWED;
		}
		
		if ( !is_writeable($mediadir) )
		{
			return _ERROR_BADPERMISSIONS;
		}
		
		// add trailing slash (don't add it earlier since it causes mkdir to fail on some systems)
		$mediadir .= '/';
		
		if ( file_exists($mediadir . $filename) )
		{
			return _ERROR_UPLOADDUPLICATE;
		}
		
		// move file to directory
		if ( is_uploaded_file($uploadfile) )
		{
			if ( !@move_uploaded_file($uploadfile, $mediadir . $filename) )
			{
				return _ERROR_UPLOADMOVEP;
			}
		}
		else
		{
			if ( !copy($uploadfile, $mediadir . $filename) )
			{
				return _ERROR_UPLOADCOPY ;
			}
		}
		
		// chmod uploaded file
		$oldumask = umask(0000);
		@chmod($mediadir . $filename, 0644);
		umask($oldumask);
		
		$manager->notify('PostMediaUpload',array('collection' => $collection, 'mediadir' => $mediadir, 'filename' => $filename));
		
		return '';
	}
	
	/**
	 * Media::addMediaObjectRaw()
	 * Adds an uploaded file to the media dir.
	 * 
	 * NOTE: does not check if $collection is valid.
	 * 
	 * @param	string	$collection	collection to use
	 * @param	string	$filename	the filename that should be used to save the file
	 * 								as (date prefix should be already added here)
	 * @param	&$data	File data (binary)
	 * @return	string	blank if success, message if failed
	 */
	static public function addMediaObjectRaw($collection, $filename, &$data)
	{
		global $DIR_MEDIA;
		
		// check dir permissions (try to create dir if it does not exist)
		$mediadir = $DIR_MEDIA . $collection;
		
		// try to create new private media directories if needed
		if ( !@is_dir($mediadir) && is_numeric($collection) )
		{
			$oldumask = umask(0000);
			if ( !@mkdir($mediadir, 0777) )
			{
				return _ERROR_BADPERMISSIONS;
			}
			umask($oldumask);
		}
		
		// if dir still not exists, the action is disallowed
		if ( !@is_dir($mediadir) )
		{
			return _ERROR_DISALLOWED;
		}
		
		if ( !is_writeable($mediadir) )
		{
			return _ERROR_BADPERMISSIONS;
		}
		
		// add trailing slash (don't add it earlier since it causes mkdir to fail on some systems)
		$mediadir .= '/';
		
		if ( file_exists($mediadir . $filename) )
		{
			return _ERROR_UPLOADDUPLICATE;
		}
		
		// create file
		$fh = @fopen($mediadir . $filename, 'wb');
		if ( !$fh )
		{
			return _ERROR_UPLOADFAILED;
		}
		$ok = @fwrite($fh, $data);
		@fclose($fh);
		if ( !$ok )
		{
			return _ERROR_UPLOADFAILED;
		}
		
		// chmod uploaded file
		$oldumask = umask(0000);
		@chmod($mediadir . $filename, 0644);
		umask($oldumask);
		
		return '';
	}
	
	/**
	 * Media::responseResampledImage()
	 * send resampled image via HTTP
	 * 
	 * @param	object	$medium		Medium Object
	 * @exit
	 */
	static public function responseResampledImage($medium, $maxwidth=0, $maxheight=0)
	{
		if ( get_class($medium) !== 'Medium' )
		{
			header("HTTP/1.1 500 Internal Server Error");
			exit('Nucleus CMS: Fail to generate resampled image');
			return;
		}
		
		$resampledimage = $medium->getResampledBinary($maxwidth, $maxheight);
		if ( $resampledimage === FALSE )
		{
			unset($resampledimage);
			header("HTTP/1.1 503 Service Unavailable");
			exit('Nucleus CMS: Fail to generate resampled image');
			return;
		}
		
		header("Content-type: {$medium->mime}");
		echo $resampledimage;
		
		unset($resampledimage);
		
		exit;
	}
	
	/**
	 * Media::storeResampledImage()
	 * Store resampled image binary to filesystem as file
	 * 
	 * @param	object	$medium		medium Object
	 * @param	integer	$maxwidth	maximum width
	 * @param	integer	$maxheight	maximum height
	 * @param	string	$path		directory path for destination
	 * @param	string	$name		file name for destination
	 * @return	boolean
	 */
	static public function storeResampledImage($medium, $maxwidth=0, $maxheight=0, $path='', $name='')
	{
		global $DIR_MEDIA;
		
		if ( get_class($medium) !== 'Medium' )
		{
			return FALSE;
		}
		
		if ( $path !== '' )
		{
			$path = realpath($path);
			if ( !file_exists($path)
			  || strpos($path, $DIR_MEDIA) !== 0 )
			{
				return FALSE;
			}
		}
		else
		{
			$path = '$DIR_MEDIA/' . self::$thumbdir;
		}
		
		if ( $name === '' )
		{
			$name = $medium->getHashedname();
		}
		
		$resampledimage = $medium->getResampledBinary($maxwidth, $maxheight);
		if ( !$resampledimage )
		{
			unset($resampledimage);
			return FALSE;
		}
		
		$handle = @fopen("{$path}/{$name}", 'w');
		if ( !$handle )
		{
			unset ($resampledimage);
			return FALSE;
		}
		
		if ( !@fwrite($handle, $resampledimage) )
		{
			unset($resampledimage);
			@unlink("{$path}/{$name}");
			return FALSE;
		}
		
		unset($resampledimage);
		fclose($handle);
		
		if ( !@chmod("{$path}/{$name}", 0774) )
		{
			@unlink("{$path}/{$name}");
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * Media::sort_media_by_timestamp()
	 * User-defined sort method to sort an array of MediaObjects
	 * 
	 * @param	object	$a
	 * @param	object	$b
	 * @return	boolean
	 */
	static private function sort_media_by_timestamp($a, $b)
	{
		if ($a->timestamp == $b->timestamp) return 0;
		return ($a->timestamp > $b->timestamp) ? -1 : 1;
	}
	
	/**
	 * Media::sort_media_by_filename()
	 * User-defined sort method to sort an array of MediaObjects
	 * 
	 * @param	object	$a
	 * @param	object	$b
	 * @return	boolean
	 */
	static private function sort_media_by_filename($a, $b)
	{
		if ($a->filename == $b->filename) return 0;
		return ($a->filename > $b->filename) ? -1 : 1;
	}
}

class MediaObject
{
	public $mime = '';
	
	public $root = '';
	public $path = '';
	public $private;
	public $collection;
	public $filename = '';
	
	public $prefix = '';
	public $name = '';
	public $suffix = '';
	
	public $timestamp = 0;
	public $size = 0;
	
	public $width = 0;
	public $height = 0;
	public $resampledwidth = 0;
	public $resampledheight = 0;
	
	/**
	 * MediaObject::__construct()
	 * 
	 * @param	string		$collection	
	 * @param	string		$filename	
	 * @param	string		$root		fullpath to media directory
	 */
	public function __construct($collection, $filename, $root=0)
	{
		global $CONF, $DIR_MEDIA;
		
		/* for backward compatibility */
		if ( is_numeric($root) )
		{
			$root = $DIR_MEDIA;
		}
		
		$root = preg_replace('#/*$#', '', $root);
		
		/* get and validate fullpath for the medium */
		if ( !file_exists($root)
		  || FALSE === ($fullpath = realpath("{$root}/{$collection}/{$filename}"))
		  || strpos($fullpath, $root) !== 0
		  || !file_exists($fullpath) )
		{
			return FALSE;
		}
		
		/* store fundamentals */
		$this->root = $root;
		$this->private = (integer) $collection;
		$this->collection = $collection;
		$this->filename = basename($fullpath);
		$this->timestamp = filemtime($fullpath);
		
		/* store relative directory path from root directory for media */
		$this->path = preg_replace(array("#{$this->root}/#", "#/{$this->filename}#"), '', $fullpath);
		if ( $this->path === $this->name )
		{
			$this->path = ''; 
		}
		
		return;
	}
	
	/**
	 * MediaObject::refine()
	 * refine data
	 * 
	 * @param	void
	 * @return	void
	 */
	public function refine()
	{
		global $CONF;
		
		/* store size (byte order) */
		$this->size = filesize("{$this->root}/{$this->path}/{$this->filename}");
		
		/* get width and height if this is image binary */
		if ( FALSE === ($info = @getimagesize ("{$this->root}/{$this->path}/{$this->filename}")) )
		{
			$this->mime = 'application/octet-stream';
			$this->width = 0;
			$this->height = 0;
		}
		else
		{
			$this->mime = $info['mime'];
			$this->width = $info[0];
			$this->height = $info[1];
		}
		
		/* utilise Fileinfo subsystem if available */
		if ( defined('FILEINFO_MIME_TYPE') && function_exists ('finfo_open')
		  && (FALSE !== ($info = finfo_open(FILEINFO_MIME_TYPE))) )
		{
			$this->mime = finfo_file($info, "{$this->root}/{$this->path}/{$this->filename}");
		}
		
		/* store data with parsed filename */
		if ( preg_match('#^(.*)\.([a-zA-Z0-9]{2,})$#', $this->filename, $info) === 1 )
		{
			$this->name = $info[1];
			$this->suffix = $info[2];
			
			if ( $CONF['MediaPrefix'] && preg_match('#^([0-9]{8})\-(.*)$#', $this->name, $info) == 1 )
			{
				$this->prefix = preg_replace('#^([0-9]{4})([0-9]{2})([0-9]{2})$#', '$1/$2/$3', $info[1]);
				$this->name = $info[2];
			}
		}
		
		return;
	}
	
	/**
	 * MediaObject::setResampledSize()
	 * Set resampled size
	 * 
	 * @param	integer	$maxwidth
	 * @param	integer	$maxheight
	 * @return	boolean
	 */
	public function setResampledSize($maxwidth=0, $maxheight=0)
	{
		if ( ($maxwidth == 0) && ($maxheight == 0) )
		{
			return FALSE;
		}
		else if ( $this->width == 0 || $this->height  == 0 )
		{
			return FALSE;
		}
		else if ($this->width < $maxwidth && $this->height < $maxheight )
		{
			$this->resampledwidth = $this->width;
			$this->resampledheight = $this->height;
		}
		else if ( $maxheight == 0 || $this->width > $this->height )
		{
			$this->resampledheight = intval ($this->height * $maxwidth / $this->width);
			$this->resampledwidth = $maxwidth;
		}
		else if ( $maxwidth == 0 || $this->width <= $this->height )
		{
			$this->resampledwidth = intval ($this->width * $maxheight / $this->height);
			$this->resampledheight = $maxheight;
		}
		return TRUE;
	}
	
	/**
	 * MediaObject::getResampledBinary()
	 * Return resampled image binary
	 * 
	 * @param	void
	 * @return	mixed	binary if success, FALSE if failed
	 */
	public function getResampledBinary($maxwidth=0, $maxheight=0)
	{
		static $gdinfo = array();
		static $original;
		static $resampledimage;
		
		if ( !$this->setResampledSize($maxwidth, $maxheight) )
		{
			return FALSE;
		}
		
		if ( $gdinfo = array() )
		{
			$gdinfo = gd_info();
		}
		
		if ( $this->path !== '' )
		{
			$fullpath = "{$this->root}/{$this->path}/{$this->name}";
		}
		else
		{
			$fullpath = "{$this->root}/{$this->name}";
		}
		if ( !file_exists($fullpath) )
		{
			return FALSE;
		}
		
		if ( !array_key_exists($this->mime, Media::$image_mime)
		  || $this->width == 0
		  || $this->height == 0
		  || $this->resampledwidth == 0
		  || $this->resampledheight == 0 )
		{
			return FALSE;
		}
		
		/* check current available memory */
		$memorymax = trim(ini_get("memory_limit"));
		switch ( strtolower ($memorymax[strlen($memorymax)-1]) )
		{
			case 'g':
				$memorymax *= 1024;
			case 'm':
				$memorymax *= 1024;
			case 'k':
				$memorymax *= 1024;
		}
		
		/*
		 * this code is based on analyze if gd.c in php source code
		 * if you can read C/C++, please check these elements and notify us if you have some ideas
		 */
		if ( (memory_get_usage()
		   + ($this->resampledwidth * $this->resampledheight * 5 + $this->resampledheight * 24 + 10000)
		   + ($this->width * $this->height * 5 + $this->height * 24 + 10000))
		  > $memorymax )
		{
			return FALSE;
		}
		
		switch ( $this->mime )
		{
			case 'image/gif':
				if ( (!array_key_exists('GIF Read Support', $gdinfo) || !isset($gdinfo['GIF Read Support']))
				  || (!array_key_exists('GIF Create Support', $gdinfo) || !isset($gdinfo['GIF Create Support'])) )
				{
					return FALSE;
				}
				$function = 'imagecreatefromgif';
				break;
			case 'image/jpeg':
				if ( (!array_key_exists('JPEG Support', $gdinfo) || !isset($gdinfo['JPEG Support']))
				  && (!array_key_exists('JPG Support', $gdinfo) || !isset($gdinfo['JPG Support'])) )
				{
					return FALSE;
				}
				$function = 'imagecreatefromjpeg';
				break;
			case 'image/png':
				if ( !array_key_exists('PNG Support', $gdinfo) || !isset($gdinfo['PNG Support']) )
				{
					return FALSE;
				}
				$function = 'imagecreatefrompng';
				break;
			default:
				return FALSE;
		}
		
		if ( !is_callable($function) )
		{
			return FALSE;
		}
		
		$original = call_user_func_array($function, array(&$fullpath));
		if ( !$original )
		{
			return FALSE;
		}
		
		$resampledimage = imagecreatetruecolor($this->resampledwidth, $this->resampledheight);
		if ( !$resampledimage )
		{
			imagedestroy($original);
			return FALSE;
		}
		
		@set_time_limit(ini_get('max_execution_time'));
		if ( !ImageCopyResampled($resampledimage, $original, 0, 0, 0, 0, $this->resampledwidth, $this->resampledheight, $this->width, $this->height) )
		{
			return FALSE;
		}
		
		imagedestroy($original);
		
		ob_start();
		
		switch ( $this->mime )
		{
			case 'image/gif':
				imagegif($resampledimage);
				break;
			case 'image/jpeg':
				imagejpeg($resampledimage);
				break;
			case 'image/png':
				imagepng($resampledimage);
				break;
			case 'image/bmp':
			case 'image/x-ms-bmp':
				imagepng($resampledimage);
				break;
			default:
				return FALSE;
		}
		
		imagedestroy($resampledimage);
		
		return ob_get_clean();
	}
	
	public function getHashedName()
	{
		return (string) hash(Media::$algorism, "{$this->path}/{$this->name}", FALSE);
	}
}
