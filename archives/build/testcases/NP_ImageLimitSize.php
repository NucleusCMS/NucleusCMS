<?php

class NP_ImageLimitSize extends NucleusPlugin {
/*
 Nucleus Plugin
 
 History:
 	v0.01 (2006-12-30):
		- release for testing purposes (demonstrates the usage of the PreMediaUpload event)

*/

	function getName() 		  { return 'NP_ImageLimitSize'; }
	function getAuthor()  	  { return 'Kai Greve'; }
	function getURL()  		  { return 'http://www.nucleuscms.org/'; }
	function getVersion() 	  { return '0.01'; }
	function getDescription() { return 'Rescales an image (jpg/png) during the upload if it is bigger then a maximum with.'; }

	function getMinNucleusVersion() { return 330; }

	function supportsFeature($what) {
		switch($what)
		{ case 'SqlTablePrefix':
				return 1;
			default:
				return 0; }
	}

	function install() {
		$this->createOption('maxwidth', 'Maximal width for images', 'text', '450');	
	}

	function unInstall() {
	}

	function getEventList() {
		return array('PreMediaUpload');
	}

	function event_PreMediaUpload(&$data) {

		$collection = $data['collection'];
		$uploadfile = $data['uploadfile'];
		$filename = $data['filename'];
		
		// evaluate the filetype from the filename
		$filetype = strtolower(substr($filename, strpos($filename, ".")+1));
		
		// filetype is jpeg
		if ($filetype=='jpg' || $filetype=='jpeg') {
		
			$size=getimagesize($data['uploadfile']);
			
			// size[0] is the image width 		
			if ($size[0]>$this->getOption('maxwidth')) {

				$newheight =  $this->getOption('maxwidth') * $size[1]/$size[0];
        		$image_orig = imagecreatefromjpeg($uploadfile);
				$image_new = imagecreatetruecolor($this->getOption('maxwidth'), $newheight);
		
				imagecopyresampled($image_new, $image_orig, 0, 0, 0, 0, $this->getOption('maxwidth'), $newheight, $size[0], $size[1]);

				imagejpeg ($image_new , $uploadfile);
				
				// clear the memory
				imagedestroy($image_orig);
				imagedestroy($image_new);
		
			}
		}
		
		// filetype is png
		if ($filetype=='png') {
		
			$size=getimagesize($data['uploadfile']);
		
			// size[0] is the image width
			if ($size[0]>$this->getOption('maxwidth')) {
		
				$newheight =  $this->getOption('maxwidth') * $size[1]/$size[0];
        		$image_orig = imagecreatefrompng($uploadfile);
				$image_new = imagecreatetruecolor($this->getOption('maxwidth'), $newheight);

				imagecopyresampled($image_new, $image_orig, 0, 0, 0, 0, $this->getOption('maxwidth'), $newheight, $size[0], $size[1]);
		
				imagepng ( $image_new , $uploadfile);
				
				// clear the memory
				imagedestroy($image_orig);
				imagedestroy($image_new);

			}
		}
	}
}

?>
