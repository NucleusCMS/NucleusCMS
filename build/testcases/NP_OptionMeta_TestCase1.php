<?php
/**
 * :mode=php:tabSize=4:indentSize=4:noTabs=false:
 * :folding=indent:collapseFolds=0:wrap=none:maxLineLen=85:
 *
 * NP_OptionMeta_TestCase1.php
 * Copyright (C) 2004 Jeroen Budts
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * see http://nucleuscms.org/license.txt for license
 */
class NP_OptionMeta_TestCase1 extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
	// name of plugin
	function getName() {
		return 'NP_OptionMeta_TestCase1';
	}
	
	// author of plugin
	function getAuthor() {
		return 'TeRanEX';
	}
	// an URL to the plugin website
	function getURL() {
		return 'http://budts.be/weblog/';
	}
	
	// version of the plugin
	function getVersion() {
		return '0.1';
	}
	
	// a description to be shown on the installed plugins listing
	function getDescription() {
		return 'A plugin to test the option meta: numerical, readonly';
	}
	
	function getEventList() { return array('PrePluginOptionsUpdate'); }
	
	//supported features
	function supportsFeature($what) {
		switch($what) {
			case 'SqlTablePrefix':
				return 1;
			default:
				return 0;
		}
	}
  
	function install() {
		// plugin options
		$this->createOption('NumericTextOption1', 'Numeric text option', 'text', '', 'numerical=true');
		$this->createOption('ReadonlyTextOption1', 'Readonly text option', 'text', '', 'access=readonly');
		$this->createOption('ReadonlyNumericalTextOption1', 'Readonly, Numerical text option', 'text', '', 'access=readonly;numerical=true');
		$this->createOption('ReadonlyTextAreaOption1', 'Readonly textarea option', 'textarea', 'This textarea is readonly (at least it should be :-p)', 'access=readonly');
		// itemoptoins
		$this->createItemOption('NumericTextOption1', 'Numeric text option', 'text', '', 'numerical=true');
		$this->createItemOption('ReadonlyTextOption1', 'Readonly text option', 'text', '', 'access=readonly');
		$this->createItemOption('ReadonlyNumericalTextOption1', 'Readonly, Numerical text option', 'text', '', 'access=readonly;numerical=true');
		$this->createItemOption('ReadonlyTextAreaOption1', 'Readonly textarea option', 'textarea', 'This textarea is readonly (at least it should be :-p)', 'access=readonly');
	}
  
    function event_PrePluginOptionsUpdate(&$data) {
		if (($this->getID() == $data['plugid']) && ($data['optionname'] == 'ReadonlyTextOption1')) {
				$data['value'] = date('Y-m-d H:i:s');
		}
	}
}
?>
