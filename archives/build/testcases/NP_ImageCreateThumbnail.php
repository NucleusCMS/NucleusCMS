<?php

class NP_ImageCreateThumbnail extends NucleusPlugin {

   /* 
	* Nucleus Plugin
	*
	* Copyright 2007 by Kai Greve
	* 
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
	* 
	*
	* NP_ImageCreateThumbnail creates a thumbnail after an image is uploaded,
	* it demonstrates the uages of the PostMediaUpload event	 		
	*
	* History:
	* v0.01: 2007-01-01
	* 	- initial release	
	* 
	*/

	function getName() 		  { return 'NP_ImageCreateThumbnail'; }
	function getAuthor()  	  { return 'Kai Greve'; }
	function getURL()  		  { return 'http://www.nucleuscms.org/'; }
	function getVersion() 	  { return '0.01'; }
	function getDescription() { return 'Generates Thumbnails after an image is uploaded.';	}
	
	function getMinNucleusVersion() { return 330; }

	function supportsFeature($what) {
		switch($what)
		{ case 'SqlTablePrefix':
				return 1;
			default:
				return 0; }
	}

	function install() {
		$this->createOption ('thumbsize', 'Maximal width (landscape format) or height (portrait format) for Thumbnails', 'text', '150');
	}

	function unInstall() {
	}

	function getEventList() {
		return array('PostMediaUpload');
	}


	function event_PostMediaUpload(&$data) {
		
		$collection = $data['collection'];
    	$mediadir = $data['mediadir'];
    	$filename = $data['filename'];
    	$fullpath = $mediadir.$filename;
    	
    	// evaluate the filetype from the filename
		$filetype = strtolower(substr($filename, strpos($filename, ".")+1));
		
		// filetype is jpeg
		if ($filetype=='jpg' || $filetype=='jpeg') {
		
			$size = getimagesize($fullpath);
			
			$ratio = $size[1]/$size[0]; // ratio = height / width
			
			if ($ratio < 1) {
				$new_height = $this->getOption('thumbsize') * $size[1]/$size[0];
				$new_width = $this->getOption('thumbsize');
			}
			else {
				$new_height = $this->getOption('thumbsize');
				$new_width = $this->getOption('thumbsize') * $size[0]/$size[1];
			}			

       		$image_orig = imagecreatefromjpeg($fullpath);
			$image_new = imagecreatetruecolor($new_width, $new_height);
		
			imagecopyresampled($image_new, $image_orig, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);

			$thumbfilename = substr($fullpath, 0, strpos($fullpath, ".")).'_thumb.'.$filetype;
				
			imagejpeg ($image_new , $thumbfilename);
				
			// clear the memory
			imagedestroy($image_orig);
			imagedestroy($image_new);
		}
		
		// filetype is png
		if ($filetype=='png') {
		
			$size = getimagesize($fullpath);
			
			$ratio = $size[1]/$size[0]; // ratio = height / width
			
			if ($ratio < 1) {
				$new_height = $this->getOption('thumbsize') * $size[1]/$size[0];
				$new_width = $this->getOption('thumbsize');
			}
			else {
				$new_height = $this->getOption('thumbsize');
				$new_width = $this->getOption('thumbsize') * $size[0]/$size[1];
			}			

       		$image_orig = imagecreatefrompng($fullpath);
			$image_new = imagecreatetruecolor($new_width, $new_height);
		
			imagecopyresampled($image_new, $image_orig, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);

			$thumbfilename = substr($fullpath, 0, strpos($fullpath, ".")).'_thumb.'.$filetype;
				
			imagepng ($image_new , $thumbfilename);
				
			// clear the memory
			imagedestroy($image_orig);
			imagedestroy($image_new);
		}
	}
}

?>
