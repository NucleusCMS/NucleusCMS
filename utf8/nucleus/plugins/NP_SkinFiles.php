<?php

/*                                       */
/* NP_SkinFiles                          */
/* ------------------------------------  */
/* A simple skin files manager           */
/*                                       */
/* code by Jeff MacMichael               */
/* http://wiki.gednet.com/               */
/*                                       */

/* Changes:
 * v0.91 ged - added ICO, PHPx files, fixed/added some icons
 *           - changed perms on file or folder creation or upload to 0755 from 0640
 *           - changed 'cancel' links for delete actions to $parent dir from http_referer
 *           - changed order of links next to files... moved 'del' over a bit.  ;)
 * v0.92 ged - changed order of links next to dirs
 *             $privateskins = FALSE by default
 * v1.0  ged - fixed security catch so it actually quits the script
 *             "columnated" the files & dirs display for easier viewing
 *             Made the edit cancel link more intuitive
 * v1.01 ged - fixed event_QuickMenu to properly skip for non-admins
 *             lined up columns for directories & added <tr> highlights
 */

class NP_SkinFiles extends NucleusPlugin {

	function getName() 		{ return 'SkinFiles'; }
	function getAuthor()  	{ return 'Jeff MacMichael'; }
	function getURL()  		{ return 'http://wiki.gednet.com/'; }
	function getVersion() 	{ return '1.01'; }
	function getDescription() { return 'A simple file manager for skins.';	}

	function supportsFeature($what) {
		switch($what)
		{ case 'SqlTablePrefix':
				return 1;
			default:
				return 0; }
	}

	function install() {
	}
	
	function unInstall() {
	}

	function getEventList() {
		return array('QuickMenu');
	}
	
	function hasAdminArea() {
		return 1;
	}
	
	function event_QuickMenu(&$data) {
		global $member, $nucleus, $blogid;
		// only show to admins
		if (preg_match("/MD$/", $nucleus['version'])) {
			$isblogadmin = $member->isBlogAdmin(-1);
		} else {
			$isblogadmin = $member->isBlogAdmin($blogid);
		}
		if (!($member->isLoggedIn() && ($member->isAdmin() | $isblogadmin))) return;
		array_push(
			$data['options'], 
			array(
				'title' => 'Skin Files',
				'url' => $this->getAdminURL(),
				'tooltip' => 'Manage skin files'
			)
		);
	}
}
?>