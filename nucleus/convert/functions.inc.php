<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  */
  	
/**
 * Generic class that can import XML files with either blog items or comments
 * to be imported into a Nucleus blog
 * 
 */
class BlogImport {

	/** 
	 * Creates a new BlogImport object
	 *
	 *
	 * @param iBlogId
	 *		Nucleus blogid to which the content of the XML file must be added
	 * @param aOptions
	 *		Import options
	 *			$aOptions['PreserveIds'] = 1
	 *				try to use the same ID for the nucleus item as the ID listed 
	 *				in the XML
	 *			$aOptions['DefaultUser'] 
	 *				Sets the default user to assign the items to, if no ID can be
	 *				found in $aMapUserToNucleusId
	 * @param aMapUserToNucleusId
	 *		Array with mapping from user names (as listed in the XML file) to 
	 *		Nucleus member Ids.
	 *			example: array('karma' => 1, 'xiffy' => 2, 'roel' => 3)
	 * @param aMapCategoryToNucleusId
	 * 		Similar to $aMapUserToNucleusId, but this array maps category names to
	 *		category ids. Please note that the category IDs need to come from the
	 *		same blog as $iBlogId
	 *			example: array('general' => 11, 'funny' => 33)
	 * @param strCallback
	 *		name of a callback function to be called on each item. Such a callback
	 *		function should have a format like:
	 *			function myCallback(&$data)
	 *		where $data is an associative array with all item data ('title','body',
	 *		...)
	 */
	function BlogImport($iBlogId, $aOptions, $aMapUserToNucleusId, $aMapCategoryToNucleusId, $strCallback) {
	
		$this->iBlog					= $iBlogId;
		$this->aOptions					= $aOptions;
		$this->aMapUserToNucleusId		= $aMapUserToNucleusId;
		$this->aMapCategoryToNucleusId	= $aMapCategoryToNucleusId;
		$this->strCallback				= $strCallback;
		$this->aMapIdToNucleusId		= array();
		
		// disable magic_quotes_runtime if it's turned on
		set_magic_quotes_runtime(0);
	
		// debugging mode?
		$this->bDebug = 0;
		
		// XML file pointer
		$this->fp = 0;		
		
		// to maintain track of where we are inside the XML file
		$this->inXml 		= 0;
		$this->inData 		= 0;
		$this->inItem 		= 0;
		$this->inComment	= 0;
		$this->aCurrentItem = array();
		$this->aCurrentComment = array();
		
		// character data pile
		$this->cdata = '';
		
		// init XML parser
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'startElement', 'endElement');
		xml_set_character_data_handler($this->parser, 'characterData');
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
	
		// TODO: add data checking
		$this->bValid 					= 1;
		
		// data structures
		$this->strErrorMessage			= '';
		
	}
	
	/**
	 * Gets the import library version
	 */
	function getVersion() {
		return '0.1';
	}
	
	/**
	 * Imports an XML file into a given blog
	 *	
	 * also fills $this->aMapIdToNucleusId
	 *		array with info for each item having a Nucleus ID that is different 
	 *		from the original ID 
	 *			example: array(9999 => 1, 1234 => 2, 12 => 3)
     *
	 * @param strXmlFile
	 *		Location of the XML file. The XML file must be in the correct 
	 *		Nucleus import format
	 * @returns
	 *		0 on failure. Use getLastError() to get error message
	 *		1 on success	 
	 *
	 */
	function importXmlFile($strXmlFile) {
		$this->resetErrorMessage();
		
		if (!$this->bValid) 
			return $this->setErrorMessage('BlogImport object is invalid');
		if (!@file_exists($strXmlFile))
			return $this->setErrorMessage($strXmlFile . ' does not exist');
		if (!@is_readable($strXmlFile))
			return $this->setErrorMessage($strXmlFile . ' is not readable');

		// open file
		$this->fp = @fopen($filename, 'r');
		if (!$this->fp) 
			return^$this->setErrorMessage('Failed to open file/URL');
		
		// here we go!
		$this->inXml = 1;
		
		// parse file contents
		while ($buffer = fread($this->fp, 4096)) {
			$err = xml_parse( $this->parser, $buffer, feof($this->fp) );
			if (!$err && $this->bDebug) 
				echo 'ERROR: ', xml_error_string(xml_get_error_code($this->parser)), '<br />';
		}
			
		// all done
		$this->inXml = 0;
		fclose($this->fp);
			
		
		// TODO
		return $this->setErrorMessage('Not implemented');		
	}

	/**
	 * Identical to importXmlFile, but takes an almost-ready-for-addition array
	 *
	 * @param aData
	 *		Array with item data, as prepared by import_fromXML
     *
	 * @returns
	 *		0 on failure. Use getLastError() to get error message
	 *		1 on success
	 */
	function importOneItem(&$aData) {
		$this->resetErrorMessage();
		
		// TODO
		return $this->setErrorMessage('Not implemented');
	}
	
	/**
	 * Returns the last error message. Use it to find out the reason for failure
	 */
	function getLastError() {
		return $this->strErrorMessage;
	}
	function resetErrorMessage() {
		$this->strErrorMessage = '';
	}
	function setErrorMessage($strMsg) {
		$this->strErrorMessage = $strMsg;
		return 0;
	}
	
	/**
	 * Called by XML parser for each new start element encountered
	 */
	function startElement($parser, $name, $attrs) {
		if ($this->bDebug) echo 'START: ', $name, '<br />';
		
		switch ($name) {
			case 'blog':
				$this->inData = 1;
				$this->strImportFileVersion = $attrs['version'];
				// TODO: check version number				
				break;
			case 'item':
				$this->inItem = 1;
				$this->aCurrentItem = array('id' => $attrs['id']);
				if ($attrs['commentsOnly'] == 'true') 
					$this->aCurrentItem['commentsOnly'] = 1;
				else
					$this->aCurrentItem['commentsOnly'] = 0;
				break;
			case 'timestamp':
				if ($this->inItem || $this->inComment) {
					// store time format
					$this->currentTSFormat = $attrs['type'];
				}
				break;
			case 'author':				
			case 'title':
			case 'body':			
			case 'extended':			
			case 'category':			
			case 'itemstatus':			
			case 'posvotes':			
			case 'negvotes':			
				// nothing to do
				break;			
			case 'comment':
				if ($this->inItem) {
					$this->inComment = 1;
					$this->aCurrentComment = array('id' => $attrs['id']);
				}
				break;
			case 'email':
			case 'url':
			case 'authorid':
			case 'host':
			case 'ip':
				// nothing to do
				break;
			default:
				echo 'UNEXPECTED TAG: ' , $name , '<br />';
				break;
		}
		
		// character data never contains other tags
		$this->clearCharacterData(); 
		
	}

	/**
	  * Called by the XML parser for each closing tag encountered
	  */
	function endElement($parser, $name) {
		if ($this->bDebug) echo 'END: ', $name, '<br />';
		
		switch ($name) {
			case 'blog':
				$this->inData = 0;
				break;
			case 'item':
				// TODO: write current item to database (including comments)
				$this->inItem = 0;
				$this->aCurrentItem = array();
				break;
			case 'timestamp':
				$timestamp = $this->getTime($this->getCharacterData(), $this->currentTSFormat);
				if ($this->inComment) 
					$this->aCurrentComment['timestamp'] = $timestamp;
				else if ($this->inItem) 
					$this->aCurrentItem['timestamp'] = $timestamp;
				break;
			case 'author':
				if ($this->inComment) 
					$this->aCurrentComment['author'] = $this->getCharacterData();
				else if ($this->inItem) 
					$this->aCurrentItem['author'] = $this->getCharacterData();
				break;
			case 'title':
				if ($this->inComment) 
					$this->aCurrentComment['title'] = $this->getCharacterData();
				else if ($this->inItem) 
					$this->aCurrentItem['title'] = $this->getCharacterData();
				break;				
			case 'body':
				if ($this->inComment) 
					$this->aCurrentComment['body'] = $this->getCharacterData();
				else if ($this->inItem) 
					$this->aCurrentItem['body'] = $this->getCharacterData();
				break;	
			case 'extended':
				if ($this->inItem) 
					$this->aCurrentItem['extended'] = $this->getCharacterData();
				break;				
			case 'category':
				if ($this->inItem && !$this->aCurrentItem['category']) 
					$this->aCurrentItem['category'] = $this->getCharacterData();
				break;				
			case 'itemstatus':
				if ($this->inItem) 
					$this->aCurrentItem['itemstatus'] = $this->getCharacterData();
				break;				
			case 'posvotes':
				if ($this->inItem) 
					$this->aCurrentItem['posvotes'] = $this->getCharacterData();
				break;					
			case 'negvotes':
				if ($this->inItem) 
					$this->aCurrentItem['negvotes'] = $this->getCharacterData();
				break;					
			case 'comment':
				if ($this->inComment) {
					array_push($this->aCurrentItem['comments'], $this->aCurrentComment);
					$this->aCurrentComment = array();
					$this->inComment = 0;
				}
				break;								
			case 'email':
				if ($this->inComment) 
					$this->aCurrentComment['email'] = $this->getCharacterData();
				break;						
			case 'url':
				if ($this->inComment) 
					$this->aCurrentComment['url'] = $this->getCharacterData();
				break;						
			case 'authorid':
				if ($this->inComment) 
					$this->aCurrentComment['authorid'] = $this->getCharacterData();
				break;						
			case 'host':
				if ($this->inComment) 
					$this->aCurrentComment['host'] = $this->getCharacterData();
				break;						
			case 'ip':
				if ($this->inComment) 
					$this->aCurrentComment['ip'] = $this->getCharacterData();
				break;						
			default:
				echo 'UNEXPECTED TAG: ' , $name, '<br />';
				break;
		}
		$this->clearCharacterData();

	}
	
	/**
	 * Called by XML parser for data inside elements
	 */
	function characterData ($parser, $data) {
		if ($this->bDebug) echo 'NEW DATA: ', htmlspecialchars($data), '<br />';
		$this->cdata .= $data;
	}
	
	/**
	 * Returns the data collected so far
	 */
	function getCharacterData() {
		return $this->cdata;
	}
	
	/**
	 * Clears the data buffer
	 */
	function clearCharacterData() {
		$this->cdata = '';
	}
	
	/**
	 * Parses a given string into a unix timestamp. 
	 *
	 * @param strTime
	 *		String, formatted as given in $strFormat
	 * @param strFormat
	 *		Multiple date formats are supported:
	 *			'unix': plain unix timestamp (numeric)
	 */
	function getTime($strTime, $strFormat = 'unix') {
		$strFormat = strtolower($strFormat);
		switch($strFormat) {
			case 'unix':
				return intval($strTime);
				break;
		}
	}
	

}

// *********************************************************************************************
// code below is old code and should be removed when switching to the new import framework
// *********************************************************************************************

	// make sure the request variables get reqistered in the global scope
	// Doing this should be avoided on code rewrite (this is a potential security risk)
	if ((phpversion() >= "4.1.0") && (ini_get("register_globals") == 0)) {
		import_request_variables("gp",'');
	}

	/** this function gets the nucleus version, even if the getNucleusVersion
	 * function does not exist yet
	 * return 96 for all versions < 100
	 */
	function convert_getNucleusVersion() {
		if (!function_exists('getNucleusVersion')) return 96;
		return getNucleusVersion();
	}


	function convert_addToItem($title, $body, $more, $blogid, $authorid, $timestamp, $closed, $category, $karmapos, $karmaneg) {
		$title = trim(addslashes($title));
		$body = trim(addslashes($body));
		$more = trim(addslashes($more));
				
		$query = 'INSERT INTO '.sql_table('item').' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IKARMAPOS, IKARMANEG, ICAT) '
		       . "VALUES ('$title', '$body', '$more', $blogid, $authorid, '$timestamp', $closed, $karmapos, $karmaneg,  $category)";
		       
		mysql_query($query) or die("Error while executing query: " . $query);		       		       
		
		return mysql_insert_id();
	}
	
	function convert_addToBlog($name, $shortname, $ownerid) {
		$name = addslashes($name);
		$shortname = addslashes($shortname);
		
		// create new category first
		mysql_query('INSERT INTO '.sql_table('category')." (CNAME, CDESC) VALUES ('General','Items that do not fit in another categort')");
		$defcat = mysql_insert_id();

		$query = 'INSERT INTO '.sql_table('blog')." (BNAME, BSHORTNAME, BCOMMENTS, BMAXCOMMENTS, BDEFCAT) VALUES ('$name','$shortname',1 ,0, $defcat)";
		mysql_query($query) or die("Error while executing query: " . $query);
		$id = mysql_insert_id();
		
		convert_addToTeam($id,$ownerid,1);
	
		
		return $id;
	}
	
	function convert_addToComments($name, $url, $body, $blogid, $itemid, $memberid, $timestamp, $host) {
		$name = addslashes($name);
		$url = addslashes($url);
		$body = trim(addslashes($body));
		$host = addslashes($host);
		
		$query = 'INSERT INTO '.sql_table('comment')
			   . ' (CUSER, CMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CBLOG) '
		       . "VALUES ('$name', '$url', $memberid, '$body', $itemid, '$timestamp', '$host', $blogid)";

		mysql_query($query) or die("Error while executing query: " . $query);
		
		return mysql_insert_id();		       
	}
	
	function convert_addToTeam($blogid, $memberid, $admin) {
	
		$query = 'INSERT INTO '.sql_table('team').' (TMEMBER, TBLOG, TADMIN) '
		       . "VALUES ($memberid, $blogid, $admin)";

		mysql_query($query) or die("Error while executing query: " . $query);
		
		return mysql_insert_id();		       
	}	
	
	function convert_showLogin($type) {
		convert_head();
	?>
		<h1>Please Log in First</h1>
		<p>Enter your data below:</p>
		
		<form method="post" action="<?php echo $type?>">

			<ul>
				<li>Name: <input name="login" /></li>
				<li>Password <input name="password" type="password" /></li>
			</ul>

			<p>
				<input name="action" value="login" type="hidden" />
				<input type="submit" value="Log in" />
			</p>
		
		</form>
	<?php		convert_foot();
		exit;
	}
	
	function convert_head() {
	?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>Nucleus Convert</title>
			<style><!--
				@import url('../styles/manual.css');
			--></style>
		</head>
		<body>		
	<?php	}

	function convert_foot() {
	?>
		</body>
		</html>	
	<?php	}	
	
	function convert_doError($msg) {
		convert_head();
		?>
		<h1>Error!</h1>

		<p>Message was:</p>
		
		<blockquote><div>
		<?php echo $msg?>
		</div></blockquote>

		<p><a href="index.php" onclick="history.back();">Go Back</a></p>
		<?php
		convert_foot();
		exit;
	}
	
	function endsWithSlash($s) {
		return (strrpos($s,'/') == strlen($s) - 1);
	}	
	

?>