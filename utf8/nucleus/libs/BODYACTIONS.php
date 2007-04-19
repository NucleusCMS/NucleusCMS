<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * A class to parses plugin calls inside items
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: BODYACTIONS.php,v 1.6 2007-04-19 06:13:50 kimitake Exp $
 * @version $NucleusJP: BODYACTIONS.php,v 1.5 2007/03/22 03:30:14 kmorimatsu Exp $
 */

class BODYACTIONS extends BaseActions {

	var $currentItem;

	var $template;

	function BODYACTIONS () {
		$this->BaseActions();	
	}
	
	function setCurrentItem(&$item) {
		$this->currentItem =& $item;
	}
	
	function setTemplate($template) {
		$this->template =& $template;
	}

	function getDefinedActions() {
		return array('image', 'media', 'popup', 'plugin');
	}

	function parse_plugin($pluginName) {
		global $manager;

		// only continue when the plugin is really installed
		if (!$manager->pluginInstalled('NP_' . $pluginName)) {
			return;
		}

		$plugin =& $manager->getPlugin('NP_' . $pluginName);
		if (!$plugin) return;

		// get arguments
		$params = func_get_args();

		// remove plugin name
		array_shift($params);

		// add item reference (array_unshift didn't work)
		$params = array_merge(array(&$this->currentItem),$params);

		call_user_func_array(array(&$plugin,'doItemVar'), $params);
	}
	
	function parse_image() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createImageCode'),$args);
	}
	
	function createImageCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['link']			= htmlspecialchars($CONF['MediaURL']. $filename ,ENT_QUOTES);
		$vars['text']			= htmlspecialchars($text ,ENT_QUOTES);
		$vars['image'] = '<img src="' . $vars['link'] . '" width="' . $width . '" height="' . $height . '" alt="' . $vars['text'] . '" title="' . $vars['text'] . '" />';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';


		echo TEMPLATE::fill($this->template['IMAGE_CODE'],$vars);;

	}
	
	function parse_media() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createMediaCode'),$args);
	}

	function createMediaCode($filename, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename ,ENT_QUOTES);
		$vars['text']			= htmlspecialchars($text ,ENT_QUOTES);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['text'] . '</a>';

		echo TEMPLATE::fill($this->template['MEDIA_CODE'],$vars);;
	}


	function parse_popup() {
		// image/popup calls have arguments separated by |
		$args = func_get_args();
		$args = explode('|',implode($args,', '));
		call_user_func_array(array(&$this,'createPopupCode'),$args);
	}

	function createPopupCode($filename, $width, $height, $text = '') {
		global $CONF;

		// select private collection when no collection given
		if (!strstr($filename,'/')) {
			$filename = $this->currentItem->authorid . '/' . $filename;
		}

		$windowwidth = $width;
		$windowheight = $height;

		$vars['rawpopuplink'] 	= $CONF['Self'] . "?imagepopup=" . htmlspecialchars($filename,ENT_QUOTES) . "&amp;width=$width&amp;height=$height&amp;imagetext=" . urlencode(htmlspecialchars($text));
		$vars['popupcode'] 		= "window.open(this.href,'imagepopup','status=no,toolbar=no,scrollbars=no,resizable=yes,width=$windowwidth,height=$windowheight');return false;";
		$vars['popuptext'] 		= htmlspecialchars($text,ENT_QUOTES);
		$vars['popuplink'] 		= '<a href="' . $vars['rawpopuplink']. '" onclick="'. $vars['popupcode'].'" >' . $vars['popuptext'] . '</a>';
		$vars['width'] 			= $width;
		$vars['height']			= $height;
		$vars['text']			= $text;
		$vars['link']			= htmlspecialchars($CONF['MediaURL'] . $filename ,ENT_QUOTES);
		$vars['media'] 			= '<a href="' . $vars['link'] . '">' . $vars['popuptext'] . '</a>';

		echo TEMPLATE::fill($this->template['POPUP_CODE'],$vars);
	}

}
?>
