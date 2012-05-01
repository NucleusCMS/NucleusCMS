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
 *	This class contains two classes that can be used for importing and
 *	exporting Nucleus skins: SKINIMPORT and SKINEXPORT
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class SkinImport
{
	// hardcoded value (see constructor). When 1, interesting info about the
	// parsing process is sent to the output
	private $debug;
	
	// parser/file pointer
	private $parser;
	private $fp;
	
	// parset internal charset, US-ASCII/ISO-8859-1/UTF-8
	private $parse_charset = 'UTF-8';
	
	// which data has been read?
	private $metaDataRead;
	private $allRead;
	
	// extracted data
	private $skins;
	private $templates;
	private $info;
	
	// to maintain track of where we are inside the XML file
	private $inXml;
	private $inData;
	private $inMeta;
	private $inSkin;
	private $inTemplate;
	private $currentName;
	private $currentPartName;
	private $cdata;
	
	/**
	 * constructor initializes data structures
	 */
	public function __construct()
	{
		// disable magic_quotes_runtime if it's turned on
		//set_magic_quotes_runtime(0);
		if ( version_compare(PHP_VERSION, '5.3.0', '<') )
		{
			ini_set('magic_quotes_runtime', '0');
		}
		
		// debugging mode?
		$this->debug = 0;
		
		$this->reset();
		return;
	}
	
	public function __destruct()
	{
		return;
	}
	
	public function reset()
	{
		if ( $this->parser )
		{
			xml_parser_free($this->parser);
		}
		
		// XML file pointer
		$this->fp = 0;
		
		// which data has been read?
		$this->metaDataRead = 0;
		$this->allRead = 0;
		
		// to maintain track of where we are inside the XML file
		$this->inXml = 0;
		$this->inData = 0;
		$this->inMeta = 0;
		$this->inSkin = 0;
		$this->inTemplate = 0;
		$this->currentName = '';
		$this->currentPartName = '';
		
		// character data pile
		$this->cdata = '';
		
		// list of skinnames and templatenames (will be array of array)
		$this->skins = array();
		$this->templates = array();
		
		// extra info included in the XML files (e.g. installation notes)
		$this->info = '';
		
		// init XML parser, this parser deal with characters as encoded by UTF-8
		$this->parser = xml_parser_create($this->parse_charset);
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'start_element', 'end_element');
		xml_set_character_data_handler($this->parser, 'character_data');
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
		
		return;
	}
	
	/**
	 * Reads an XML file into memory
	 *
	 * @param $filename
	 *		Which file to read
	 * @param $metaOnly
	 *		Set to 1 when only the metadata needs to be read (optional, default 0)
	 */
	public function readFile($filename, $metaOnly = 0)
	{
		// open file
		$this->fp = @fopen($filename, 'r');
		if ( !$this->fp )
		{
			return _SKINIE_ERROR_FAILEDOPEN_FILEURL;
		}
		
		// here we go!
		$this->inXml = 1;
		
		$tempbuffer = null;
		
		while ( !feof($this->fp) )
		{
			$tempbuffer .= fread($this->fp, 4096);
		}
		fclose($this->fp);
		
		/*
		 * NOTE: conver character set.
		 * We hope all characters in the file also includes UTF-8 coded character set,
		 *  because this PHP extension implements support for James Clark's expat in PHP
		 *   and it supports juust US-ASCII, ISO-8859-1, UTF-8 character coding scheme.
		 */
		if ( i18n::get_current_charset() != $this->parse_charset )
		{
			$tempbuffer = i18n::convert($tempbuffer, i18n::get_current_charset(), $this->parse_charset);
		}
		
		$temp = tmpfile();
		fwrite($temp, $tempbuffer);
		rewind($temp);
		
		while ( ($buffer = fread($temp, 4096) )
		 && (!$metaOnly || ($metaOnly && !$this->metaDataRead)) )
		 {
			$err = xml_parse( $this->parser, $buffer, feof($temp) );
			if ( !$err && $this->debug )
			{
				echo 'ERROR: ', xml_error_string(xml_get_error_code($this->parser)), '<br />';
			}
		}
		
		// all done
		$this->inXml = 0;
		fclose($temp);
		
		return;
	}
	
	/**
	 * Returns the list of skin names
	 */
	public function getSkinNames()
	{
		return array_keys($this->skins);
	}
	
	/**
	 * Returns the list of template names
	 */
	public function getTemplateNames()
	{
		return array_keys($this->templates);
	}
	
	/**
	 * Returns the extra information included in the XML file
	 */
	public function getInfo()
	{
		return $this->info;
	}
	
	/**
	 * Writes the skins and templates to the database
	 *
	 * @param $allowOverwrite
	 *		set to 1 when allowed to overwrite existing skins with the same name
	 *		(default = 0)
	 */
	public function writeToDatabase($allowOverwrite = 0)
	{
		$existingSkins = $this->checkSkinNameClashes();
		$existingTemplates = $this->checkTemplateNameClashes();
		$invalidSkinNames = $this->checkSkinNamesValid();
		$invalidTemplateNames = $this->checkTemplateNamesValid();
		
		// if there are invalid skin or template names, stop executioin and return and error
		if ( (sizeof($invalidSkinNames) > 0) || (sizeof($invalidTemplateNames) > 0) )
		{
			$inames_error = "<p>"._SKINIE_INVALID_NAMES_DETECTED."</p>\n";
			$inames_error .= "<ul>";
			foreach( $invalidSkinNames as $sName )
			{
				$inames_error .= "<li>".Entity::hsc($sName)."</li>";
			}
			foreach( $invalidTemplateNames as $sName )
			{
				$inames_error .= "<li>".Entity::hsc($sName)."</li>";
			}
			$inames_error .= "</ul>";
			return $inames_error;
		}
		
		// if not allowed to overwrite, check if any nameclashes exists
		if ( !$allowOverwrite )
		{
			if ( (sizeof($existingSkins) > 0) || (sizeof($existingTemplates) > 0) )
			{
				return _SKINIE_NAME_CLASHES_DETECTED;
			}
		}
		
		foreach ( $this->skins as $skinName => $data )
		{
			// 1. if exists: delete all part data, update desc data
			//    if not exists: create desc
			if ( in_array($skinName, $existingSkins) )
			{
				$skinObj = SKIN::createFromName($skinName);
				
				// delete all parts of the skin
				$skinObj->deleteAllParts();
				
				// update general info
				$skinObj->updateGeneralInfo(
					$skinName,
					$data['description'],
					$data['type'],
					$data['includeMode'],
					$data['includePrefix']
				);
			}
			else
			{
				$skinid = SKIN::createNew(
					$skinName,
					$data['description'],
					$data['type'],
					$data['includeMode'],
					$data['includePrefix']
				);
				$skinObj = new SKIN($skinid);
			}
			
			// 2. add parts
			foreach ( $data['parts'] as $partName => $partContent )
			{
				$skinObj->update($partName, $partContent);
			}
		}
		
		foreach ( $this->templates as $templateName => $data )
		{
			// 1. if exists: delete all part data, update desc data
			//    if not exists: create desc
			if ( in_array($templateName, $existingTemplates) )
			{
				$templateObj = Template::createFromName($templateName);
				
				// delete all parts of the template
				$templateObj->deleteAllParts();
				
				// update general info
				$templateObj->updateGeneralInfo($templateName, $data['description']);
			}
			else
			{
				$templateid = Template::createNew($templateName, $data['description']);
				$templateObj = new Template($templateid);
			}
			
			// 2. add parts
			foreach ( $data['parts'] as $partName => $partContent )
			{
				$templateObj->update($partName, $partContent);
			}
		}
		return;
	}
	
	/**
	  * returns an array of all the skin nameclashes (empty array when no name clashes)
	  */
	public function checkSkinNameClashes()
	{
		$clashes = array();
		
		foreach ( $this->skins as $skinName => $data )
		{
			if ( SKIN::exists($skinName) )
			{
				array_push($clashes, $skinName);
			}
		}
		return $clashes;
	}
	
	/**
	  * returns an array of all the template nameclashes
	  * (empty array when no name clashes)
	  */
	public function checkTemplateNameClashes()
	{
		$clashes = array();
		
		foreach ( $this->templates as $templateName => $data )
		{
			if ( Template::exists($templateName) )
			{
				array_push($clashes, $templateName);
			}
		}
		return $clashes;
	}
	
	/**
	  * returns an array of all the invalid skin names (empty array when no invalid names )
	  */
	private function checkSkinNamesValid()
	{
		$notValid = array();
		
		foreach ( $this->skins as $skinName => $data )
		{
			if ( !isValidSkinName($skinName) )
			{
				array_push($notValid, $skinName);
			}
		}
		return $notValid;
	}
	
	/**
	  * returns an array of all the invalid template names (empty array when no invalid names )
	  */
	private function checkTemplateNamesValid()
	{
		$notValid = array();
		
		foreach ( $this->templates as $templateName => $data )
		{
			if ( !isValidTemplateName($templateName) )
			{
				array_push($notValid, $templateName);
			}
		}
		return $notValid;
	}
	
	/**
	 * Called by XML parser for each new start element encountered
	 */
	private function start_element($parser, $name, $attrs)
	{
		foreach( $attrs as $key=>$value )
		{
			if ( $this->parse_charset != i18n::get_current_charset() )
			{
				$name = i18n::convert($name, $this->parse_charset, i18n::get_current_charset());
				$value = i18n::convert($value, $this->parse_charset, i18n::get_current_charset());
			}
			
			$attrs[$key] = $value;
		}
		
		if ( $this->debug )
		{
			echo 'START: ', Entity::hsc($name), '<br />';
		}
		
		switch ( $name )
		{
			case 'nucleusskin':
				$this->inData = 1;
				break;
			case 'meta':
				$this->inMeta = 1;
				break;
			case 'info':
				// no action needed
				break;
			case 'skin':
				if ( !$this->inMeta )
				{
					$this->inSkin = 1;
					$this->currentName = $attrs['name'];
					$this->skins[$this->currentName]['type'] = $attrs['type'];
					$this->skins[$this->currentName]['includeMode'] = $attrs['includeMode'];
					$this->skins[$this->currentName]['includePrefix'] = $attrs['includePrefix'];
					$this->skins[$this->currentName]['parts'] = array();
				}
				else
				{
					$this->skins[$attrs['name']] = array();
					$this->skins[$attrs['name']]['parts'] = array();
				}
				break;
			case 'template':
				if ( !$this->inMeta )
				{
					$this->inTemplate = 1;
					$this->currentName = $attrs['name'];
					$this->templates[$this->currentName]['parts'] = array();
				}
				else
				{
					$this->templates[$attrs['name']] = array();
					$this->templates[$attrs['name']]['parts'] = array();
				}
				break;
			case 'description':
				// no action needed
				break;
			case 'part':
				$this->currentPartName = $attrs['name'];
				break;
			default:
				echo _SKINIE_SEELEMENT_UNEXPECTEDTAG . Entity::hsc($name) . '<br />';
				break;
		}
		// character data never contains other tags
		$this->clear_character_data();
		return;
	}
	
	/**
	  * Called by the XML parser for each closing tag encountered
	  */
	private function end_element($parser, $name)
	{
		if ( $this->debug )
		{
			echo 'END: ' . Entity::hsc($name) . '<br />';
		}
		
		if ( $this->parse_charset != i18n::get_current_charset() )
		{
			$name = i18n::convert($name, $this->parse_charset, i18n::get_current_charset());
			$charset_data = i18n::convert($this->get_character_data(), $this->parse_charset, i18n::get_current_charset());
		}
		else
		{
			$charset_data = $this->get_character_data();
		}
		
		switch ( $name )
		{
			case 'nucleusskin':
				$this->inData = 0;
				$this->allRead = 1;
				break;
			case 'meta':
				$this->inMeta = 0;
				$this->metaDataRead = 1;
				break;
			case 'info':
				$this->info = $charset_data;
			case 'skin':
				if ( !$this->inMeta )
				{
					$this->inSkin = 0;
				}
				break;
			case 'template':
				if ( !$this->inMeta )
				{
					$this->inTemplate = 0;
				}
				break;
			case 'description':
				if ( $this->inSkin )
				{
					$this->skins[$this->currentName]['description'] = $charset_data;
				}
				else
				{
					$this->templates[$this->currentName]['description'] = $charset_data;
				}
				break;
			case 'part':
				if ( $this->inSkin )
				{
					$this->skins[$this->currentName]['parts'][$this->currentPartName] = $charset_data;
				}
				else
				{
					$this->templates[$this->currentName]['parts'][$this->currentPartName] = $charset_data;
				}
				break;
			default:
				echo _SKINIE_SEELEMENT_UNEXPECTEDTAG . Entity::hsc($name) . '<br />';
				break;
		}
		$this->clear_character_data();
		return;
	}
	
	/**
	 * Called by XML parser for data inside elements
	 */
	private function character_data ($parser, $data)
	{
		if ( $this->debug )
		{
			echo 'NEW DATA: ' . Entity::hsc($data) . '<br />';
		}
		$this->cdata .= $data;
		return;
	}
	
	/**
	 * Returns the data collected so far
	 */
	private function get_character_data()
	{
		return $this->cdata;
	}
	
	/**
	 * Clears the data buffer
	 */
	private function clear_character_data()
	{
		$this->cdata = '';
		return;
	}
	
	/**
	 * Static method that looks for importable XML files in subdirs of the given dir
	 */
	static public function searchForCandidates($dir)
	{
		$candidates = array();
		
		$dirhandle = opendir($dir);
		while ( $filename = readdir($dirhandle) )
		{
			if ( @is_dir($dir . $filename) && ($filename != '.') && ($filename != '..') )
			{
				$xml_file = $dir . $filename . '/skinbackup.xml';
				if ( file_exists($xml_file) && is_readable($xml_file) )
				{
					//$xml_file;
					$candidates[$filename] = $filename;
				}
				
				// backwards compatibility
				$xml_file = $dir . $filename . '/skindata.xml';
				if ( file_exists($xml_file) && is_readable($xml_file) )
				{
					//$xml_file;
					$candidates[$filename] = $filename;
				}
			}
		}
		closedir($dirhandle);
		return $candidates;
	}
}

class SkinExport
{
	private $templates;
	private $skins;
	private $info;
	
	/**
	 * Constructor initializes data structures
	 */
	public function __construct()
	{
		// list of templateIDs to export
		$this->templates = array();
		
		// list of skinIDs to export
		$this->skins = array();
		
		// extra info to be in XML file
		$this->info = '';
	}
	
	/**
	 * Adds a template to be exported
	 *
	 * @param id
	 *		template ID
	 * @result false when no such ID exists
	 */
	public function addTemplate($id)
	{
		if ( !Template::existsID($id) )
		{
			return 0;
		}
		
		$this->templates[$id] = Template::getNameFromId($id);
		return 1;
	}
	
	/**
	 * Adds a skin to be exported
	 *
	 * @param id
	 *		skin ID
	 * @result false when no such ID exists
	 */
	public function addSkin($id)
	{
		if ( !SKIN::existsID($id) )
		{
			return 0;
		}
		
		$this->skins[$id] = SKIN::getNameFromId($id);
		return 1;
	}
	
	/**
	 * Sets the extra info to be included in the exported file
	 */
	public function setInfo($info)
	{
		$this->info = $info;
	}
	
	/**
	 * Outputs the XML contents of the export file
	 *
	 * @param $setHeaders
	 *		set to 0 if you don't want to send out headers
	 *		(optional, default 1)
	 */
	public function export($setHeaders = 1)
	{
		if ( $setHeaders )
		{
			// make sure the mimetype is correct, and that the data does not show up
			// in the browser, but gets saved into and XML file (popup download window)
			header('Content-Type: text/xml; charset=' . i18n::get_current_charset());
			header('Content-Disposition: attachment; filename="skinbackup.xml"');
			header('Expires: 0');
			header('Pragma: no-cache');
		}
		
		echo "<nucleusskin>\n";
		
		// meta
		echo "\t<meta>\n";
		// skins
		foreach ( $this->skins as $skinId => $skinName )
		{
			echo "\t\t" . '<skin name="' . Entity::hsc($skinName) . '" />' . "\n";
		}
		// templates
		foreach ( $this->templates as $templateId => $templateName )
		{
			echo "\t\t" . '<template name="' . Entity::hsc($templateName) . '" />' . "\n";
		}
		// extra info
		if ( $this->info )
		{
			echo "\t\t<info><![CDATA[" . $this->info . "]]></info>\n";
		}
		echo "\t</meta>\n\n\n";
		
		// contents skins
		foreach ($this->skins as $skinId => $skinName)
		{
			$skinId = intval($skinId);
			$skinObj = new SKIN($skinId);
			
			echo "\t" . '<skin name="' . Entity::hsc($skinName) . '" type="' . Entity::hsc($skinObj->getContentType()) . '" includeMode="' . Entity::hsc($skinObj->getIncludeMode()) . '" includePrefix="' . Entity::hsc($skinObj->getIncludePrefix()) . '">' . "\n";
			echo "\t\t<description>" . Entity::hsc($skinObj->getDescription()) . "</description>\n";
			
			$res = DB::getResult('SELECT stype, scontent FROM '. sql_table('skin') .' WHERE sdesc=' . $skinId);
			foreach ( $res as $row )
			{
				echo "\t\t" . '<part name="',Entity::hsc($row['stype']) . '">';
				echo '<![CDATA[' . $this->escapeCDATA($row['scontent']) . ']]>';
				echo "</part>\n\n";
			}
			echo "\t</skin>\n\n\n";
		}
		
		// contents templates
		foreach ( $this->templates as $templateId => $templateName )
		{
			$templateId = intval($templateId);
			
			echo "\t" . '<template name="' . Entity::hsc($templateName) . '">' . "\n";
			echo "\t\t<description>" . Entity::hsc(Template::getDesc($templateId)) . "</description>\n";
			
			$res = DB::getResult('SELECT tpartname, tcontent FROM '. sql_table('template') .' WHERE tdesc=' . $templateId);
			foreach ( $res as $row )
			{
				echo "\t\t" . '<part name="' . Entity::hsc($row['tpartname']) . '">';
				echo '<![CDATA[' . $this->escapeCDATA($row['tcontent']) . ']]>';
				echo "</part>\n\n";
			}
			
			echo "\t</template>\n\n\n";
		}
		echo '</nucleusskin>';
	}
	
	/**
	 * Escapes CDATA content so it can be included in another CDATA section
	 */
	private function escapeCDATA($cdata)
	{
		return preg_replace('/]]>/', ']]]]><![CDATA[>', $cdata);
	}
}