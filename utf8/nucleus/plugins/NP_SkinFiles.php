<?php

class NP_SkinFiles extends NucleusPlugin {

   /* ==========================================================================================
	* Nucleus SkinFiles Plugin
	*
	* Copyright 2005-2009 by Jeff MacMichael and Niels Leenheer
	*
	* @version $Id$
	* @version $NucleusJP: NP_SkinFiles.php,v 1.4 2007/02/04 06:28:46 kimitake Exp $
	*
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
	*
	* Changes:
	* v0.91 ged   - added ICO, PHPx files, fixed/added some icons
	*             - changed perms on file or folder creation or upload to 0755 from 0640
	*             - changed 'cancel' links for delete actions to $parent dir from http_referer
	*             - changed order of links next to files... moved 'del' over a bit.  ;)
	* v0.92 ged   - changed order of links next to dirs
	*               $privateskins = FALSE by default
	* v1.0  ged   - fixed security catch so it actually quits the script
	*               "columnated" the files & dirs display for easier viewing
	*               Made the edit cancel link more intuitive
	* v1.01 ged   - fixed event_QuickMenu to properly skip for non-admins
	*               lined up columns for directories & added <tr> highlights
	* v2.00 rakaz - Almost complete rewrite
	* v2.01 yama  - modified form button for IE
	* v2.02 kimitake - multilingual support, modified form button for IE
	* v2.03 yama - CSS out source. and textarea width bug fix for IE. And some lang add.And add routine empty file delete.
	*/


	function getName() {
		return 'SkinFiles';
	}

	function getAuthor() {
		return 'Misc authors';
	}

	function getURL() {
		return 'http://wakka.xiffy.nl/skinfiles';
	}

	function getVersion() {
		return '2.03test';
	}

	function getDescription() {
		return _SKINFILES_01;
	}

	function supportsFeature($what) {
		switch($what) {
			case 'SqlTablePrefix':
			case 'HelpPage':
				return 1;
			default:
				return 0;
		}
	}

	function install() {
		$this->createOption(
			'generate_backup',
			_SKINFILES_OPT_GENBACKUP,
			'yesno',
			'yes'
		);
		$this->createOption(
			'backup_prefix',
			_SKINFILES_OPT_BACKUPPREFIX,
			'text',
			'bkup_'
		);
	}
	
	function unInstall() {
	}

	function getEventList() {
		return array(
			'QuickMenu',
			'AdminPrePageHead'
		);
	}
	
	function hasAdminArea() {
		return 1;
	}

	function init() {
		// include language file for this plugin
		$language = preg_replace( '@\\|/@', '', getLanguageName());
		if (file_exists($this->getDirectory().$language.'.php'))
			include_once($this->getDirectory().$language.'.php');
		else
			include_once($this->getDirectory().'english.php');
	}
	
	function event_QuickMenu(&$data) {
		global $member;

		// only show to admins
		if (!($member->isLoggedIn() && $member->isAdmin())) return;

		array_push(
			$data['options'], 
			array(
				'title'   => _SKINFILES_TITLE,
				'url'     => $this->getAdminURL(),
				'tooltip' => _SKINFILES_TOOLTIP
			)
		);
	}


// start add yama.kyms
	function event_AdminPrePageHead(&$data) {
		global $CONF;
		$path = $CONF['PluginURL'];
		if ($data['action'] != 'plugin_SkinFiles') return;
		
			$data['extrahead'] .= <<< EOS

<link rel="stylesheet" type="text/css" href="{$path}skinfiles/style.css" />


EOS;
		}
		


// end add yama.kyms


}

?>