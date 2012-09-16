<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 * @version $Id$
 */

// try to set a long timeout time
@set_time_limit(1200);

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
	 *			$aOptions['PreserveIds'] = 1 (NOT IMPLEMENTED)
	 *				try to use the same ID for the nucleus item as the ID listed
	 *				in the XML
	 *			$aOptions['ReadNamesOnly']
	 *				Reads all category names and author names (items
	 *				only) into $aAuthorNames and $aCategoryNames
	 * @param aMapUserToNucleusId
	 *		Array with mapping from user names (as listed in the XML file) to
	 *		Nucleus member Ids. '_default' lists the default user.
	 *			example: array('karma' => 1, 'xiffy' => 2, 'roel' => 3, '_default' => 1)
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
	function BlogImport($iBlogId = -1, $aOptions = array('ReadNamesOnly' => 0), $aMapUserToNucleusId = array(), $aMapCategoryToNucleusId = array(), $strCallback = '') {
		global $manager;

		$this->iBlog					= $iBlogId;
		if ($iBlogId != -1)
			$this->oBlog				=& $manager->getBlog($iBlogId);
		else
			$this->oBlog				= 0;
		$this->aOptions					= $aOptions;
		$this->aMapUserToNucleusId		= $aMapUserToNucleusId;
		$this->aMapCategoryToNucleusId	= $aMapCategoryToNucleusId;
		$this->strCallback				= $strCallback;
		$this->aMapIdToNucleusId		= array();

		$this->bReadNamesOnly			= $this->aOptions['ReadNamesOnly'] == 1;
		$this->aCategoryNames			= array();
		$this->aAuthorNames				= array();


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
		$this->aCurrentItem = $this->_blankItem();
		$this->aCurrentComment = $this->_blankComment();

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
		return '0.2';
	}

	/**
	 * Returns an array with all the author names used in the file (only
	 * the authors of items are included)
	 *
	 * @require importXmlFile should be called prior to calling this
	 */
	function getAuthorNames() {
		return $this->aAuthorNames;
	}

	/**
	 * Returns an array with all the category names used in the file
	 *
	 * @require importXmlFile should be called prior to calling this
	 */
	function getCategoryNames() {
		return $this->aCategoryNames;
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

		flush();

		if (!$this->bValid)
			return $this->setErrorMessage('BlogImport object is invalid');
		if (!@file_exists($strXmlFile))
			return $this->setErrorMessage($strXmlFile . ' does not exist');
		if (!@is_readable($strXmlFile))
			return $this->setErrorMessage($strXmlFile . ' is not readable');

		// open file
		$this->fp = @fopen($strXmlFile, 'r');
		if (!$this->fp)
			return $this->setErrorMessage('Failed to open file/URL');

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

		return 1;
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

		// - do some logic to determine nucleus users and categories
		// * find member id
		// * find blog id
		// * find category id
		$aData['nucleus_blogid']	= $this->iBlog;
		$aData['nucleus_catid'] 	= $this->_findCategoryId($aData['category']);
		$aData['nucleus_memberid'] 	= $this->_findMemberId($aData['author']);
		if ($aData['nucleus_memberid'] == 0) {
			$aData['nucleus_memberid'] = $this->aMapUserToNucleusId['_default'];
		}

		// - apply logic to comments
		foreach (array_keys($aData['comments']) as $key) {
			// * find member id
			$aData['comments'][$key]['nucleus_memberid']
				= $this->_findMemberId($aData['comments'][$key]['author']);
			// * extract authorid
			if ($aData['comments'][$key]['nucleus_memberid'] == 0) {
				$url = $aData['comments'][$key]['url'];
				$email = $aData['comments'][$key]['email'];
				$authid = $aData['comments'][$key]['authorid'];

				if (!$authid && $url)
					$aData['comments'][$key]['authorid'] = $url;
				else if (!$authid && $email)
					$aData['comments'][$key]['authorid'] = $email;
			}
		}

		// - call callback
		if ($this->strCallback && function_exists($this->strCallback)) {
			$data = array(&$aData);
			call_user_func_array($this->strCallback, $data);
		}

		if ($this->bDebug) {
			echo '<pre>';
			print_r($aData);
			echo '</pre>';
		}

		// - insert item into nucleus database
		$iNewId = $this->sql_addToItem(
			$aData['title'],
			$aData['body'],
			$aData['extended'],
			$aData['nucleus_blogid'],
			$aData['nucleus_memberid'],
			$aData['timestamp'],
			($aData['itemstatus'] == 'open') ? 0 : 1,
			$aData['nucleus_catid'],
			$aData['posvotes'],
			$aData['negvotes']
		);

		// - store id mapping if needed
		$aData['nucleus_id'] = $iNewId;
		if ($aData['nucleus_id'] != $aData['id'])
			$this->aMapIdToNucleusId[$aData['id']] = $aData['nucleus_id'];

		// - insert comments into nucleus database
		foreach ($aData['comments'] as $comment) {
			$cId = $this->sql_addToComments(
				$comment['author'],
				$comment['authorid'],
				$comment['body'],
				$aData['nucleus_blogid'],
				$aData['nucleus_id'],
				$comment['nucleus_memberid'],
				$comment['timestamp'],
				$comment['host'],
				$comment['ip']
			);
		}

		echo ' .'; // progress indicator
		flush();

		return 1;
	}

	function getHtmlCode($what) {
		ob_start();
		switch($what) {
// ----------------------------------------------------------------------------------------
			case 'NucleusMemberOptions':
				$res = sql_query('SELECT mname as text, mnumber as value FROM '.sql_table('member'));
				while ($o = mysql_fetch_object($res)) {
					echo '<option value="'.htmlspecialchars($o->value).'">'.htmlspecialchars($o->text).'</option>';
				}
				break;
// ----------------------------------------------------------------------------------------
			case 'NucleusBlogSelect':
				$query =  'SELECT bname as text, bnumber as value FROM '.sql_table('blog');
				$template['name'] = 'blogid';
				$template['selected'] = $CONF['DefaultBlog'];
				showlist($query,'select',$template);
				break;
// ----------------------------------------------------------------------------------------
			case 'ConvertSelectMembers':
			?>
				<h2>Assign Members to Authors</h2>

				<p>
				Below is a list of all the authors that Nucleus could discover (only authors that have posted at least one entry are listed). Please assign a Nucleus Member to all of these authors.
				</p>


				<table>
				<tr>
					<th>Author</th>
					<th>Nucleus Member</th>
					<th>Blog Admin?</th>
				</tr>

				<?php

				$authors = $this->getAuthorNames();

				// get HTML code for selection list
				$optionsHtml = $this->getHtmlCode('NucleusMemberOptions');
				$idx = 0;
				while ($a_name = array_pop($authors)) {
					?>
						<tr>
							<td>
								<strong><?php echo $a_name?></strong>
								<input name="author[<?php echo $idx?>]" value="<?php echo htmlspecialchars($a_name)?>" type="hidden"
							</td>
							<td>
								<select name="memberid[<?php echo $idx?>]">
									<?php echo $optionsHtml; ?>
								</select>
							</td>
							<td>
								<input name="admin[<?php echo $idx?>]" type="checkbox" value="1" id="admin<?php echo $idx?>" /><label for="admin<?php echo $idx?>">Blog Admin</label>
							</td>
						</tr>
					<?php	$idx++;
				} // while

				?>
					<tr>
						<td><em>Default Member</em></td>
						<td>
							<input name="author[<?php echo $idx?>]" value="_default" type="hidden"
							<select name="memberid[<?php echo $idx?>]">
								<?php echo $optionsHtml; ?>
							</select>
							<td><input name="admin[<?php echo $idx?>]" type="hidden" value="0" id="admin<?php echo $idx?>" /></td>
						</td>

					</tr>
				</table>
				<input type="hidden" name="authorcount" value="<?php echo ++$idx?>" />
			<?php
				break;
// ----------------------------------------------------------------------------------------
			case 'ConvertSelectCategories':
			?>
				<h2>Assign Categories</h2>

				<p>
				Below is a list of all the categories that Nucleus could discover (only categories that have been used at least once are listed). Please assign a Nucleus Category to all of these categories.
				</p>


				<table>
				<tr>
					<th>Category</th>
					<th>Nucleus Category</th>
				</tr>

				<?php

				$catnames = $this->getCategoryNames();

				// get HTML code for selection list
				$optionsHtml = $this->getHtmlCode('NucleusCategoryOptions');
				$idx = 0;
				while ($a_name = array_pop($catnames)) {
					?>
						<tr>
							<td>
								<strong><?php echo $a_name?></strong>
								<input name="category[<?php echo $idx?>]" value="<?php echo htmlspecialchars($a_name)?>" type="hidden"
							</td>
							<td>
								<select name="catid[<?php echo $idx?>]">
									<?php echo $optionsHtml; ?>
								</select>
							</td>
						</tr>
					<?php	$idx++;
				} // while
				?>
				</table>
				<input type="hidden" name="catcount" value="<?php echo $idx?>" />
			<?php
				break;
// ----------------------------------------------------------------------------------------
			case 'ConvertSelectBlog':
			?>
				<h2>Choose Destination Weblog</h2>

				<p>
				There are two options: you can either choose an existing blog to add the entries into, or you can choose to create a new weblog.
				</p>

				<div>
					<input name="createnew" value="0" type="radio" checked='checked' id="createnew_no" /><label for="createnew_no">Choose existing weblog to add to:</label>

					<?php echo $this->getHtmlCode('NucleusBlogSelect'); ?>
				</div>
				<div>
					<input name="createnew" value="1" type="radio" id="createnew_yes" /><label for="createnew_yes">Create new weblog</label>
					<ul>
						<li>New blog name: <input name="newblogname" /></li>
						<li>Blog owner:
							<select name="newowner">
								<?php echo $this->getHtmlCode('NucleusMemberOptions'); ?>
							</select>
						</li>
					</ul>
				</div>
			<?php
				break;
// ----------------------------------------------------------------------------------------
			case 'ConvertStart':
			?>
				<h2>Do the conversion!</h2>

				<p>
				<input type="submit" value="Step 3: Do the conversion!" />
				<input type="hidden" name="action" value="doConversion" />
				</p>

				<div class="note">
				<strong>Note:</strong> Clicking the button once is enough, even if it takes a while to complete.
				</div>
			<?php
				break;
		}
		$htmlCode = ob_get_contents();
		ob_end_clean();
		return $htmlCode;
	}

	/**
	 * Create blog if needed
	 * (request vars: blogid, createnew, newblogname, newowner)
	 *
	 * (static!)
	 */
	function getBlogIdFromRequest() {
		$createnew 		= intPostVar('createnew');
		$newowner 		= intPostVar('newowner');
		$newblogname 	= postVar('newblogname');
		$blogid			= intPostVar('blogid');

		if ($createnew == 1) {
			// choose unique name
			$shortname = 'import';
			if (BLOG::exists($shortname)) {
				$idx = 1;
				while (BLOG::exists($shortname . $idx))
					$idx++;
				$shortname = $shortname . $idx;
			}

			$nucleus_blogid = BlogImport::sql_addToBlog($newblogname, $shortname, $newowner);

			echo '<h2>Creating new blog</h2>';
			echo '<p>Your new weblog has been created.</p>';

			return $nucleus_blogid;
		} else {
			return $blogid;
		}

	}

	function getFromRequest($what) {
		$aResult = array();

		switch ($what) {
			case 'authors':
				$authorcount = intPostVar('authorcount');

				$author = requestArray('author');
				$memberid = requestIntArray('memberid');
				$isadmin = requestIntArray('admin');

				for ($i=0;$i<$authorcount;$i++) {
					$authorname = undoMagic($author[$i]);

					// add authors to team
					$this->oBlog->addTeamMember(intval($memberid[$i]),intval($isadmin[$i]));

					$aResult[$authorname] = $memberid[$i];
				}

				$this->aMapUserToNucleusId = $aResult;
				break;
			case 'categories':
				// TODO
				$this->aMapCategoryToNucleusId = $aResult;
				break;
		}

		return $aResult;
	}

	function _findCategoryId($name) {
		$catid = @$this->aMapCategoryToNucleusId[$name];
		if (!$catid && $this->oBlog)
			// get default category for weblog
			$catid = $this->oBlog->getDefaultCategory();
		return $catid;
	}

	function _findMemberId($name) {
		$memberid = intval(@$this->aMapUserToNucleusId[$name]);
		return $memberid;
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
				$this->aCurrentItem = $this->_blankItem($attrs['id']);
				if (@$attrs['commentsOnly'] == 'true')
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
					$this->aCurrentComment = $this->_blankComment($attrs['id']);
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
				if (!$this->bReadNamesOnly) {
					// write to database
					// TODO: check if succes or failure
					$this->importOneItem($this->aCurrentItem);
				}
				$this->inItem = 0;

				// initialize item structure
				$this->aCurrentItem = $this->_blankItem();
				break;
			case 'timestamp':
				$timestamp = $this->getTime($this->getCharacterData(), $this->currentTSFormat);
				if ($this->inComment)
					$this->aCurrentComment['timestamp'] = $timestamp;
				else if ($this->inItem)
					$this->aCurrentItem['timestamp'] = $timestamp;
				break;
			case 'author':
				if ($this->inItem && !$this->inComment)
					$this->_addAuthorName($this->getCharacterData());
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
				$this->_addCategoryName($this->getCharacterData());
				if ($this->inItem && !$this->aCurrentItem['category']) {
					$this->aCurrentItem['category'] = $this->getCharacterData();
				}
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
					$this->aCurrentComment = $this->_blankComment();
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
	 *			'blogger': for blogger import: MM/DD/YYYY hh:MM:SS AM
	 */
	function getTime($strTime, $strFormat = 'unix') {
		$strFormat = strtolower($strFormat);
		switch($strFormat) {
			case 'unix':
				return intval($strTime);
			case 'blogger':
				// 7/24/2000 11:27:13 AM
				if (eregi("(.*)/(.*)/(.*) (.*):(.*):(.*) (.*)",$strTime,$regs) != false) {
					if (($regs[7] == "PM") && ($regs[4] != "12"))
						$regs[4] += 12;

					return mktime($regs[4],$regs[5],$regs[6],$regs[1],$regs[2],$regs[3]);
				} else {
					return 0;
				}
		}
	}


	function _blankItem($id = -1) {
		return array(
				'id' 			=> $id,
				'commentsOnly' 	=> 0,
				'timestamp' 	=> time(),
				'author' 		=> '',
				'title' 		=> '',
				'body' 			=> '',
				'extended' 		=> '',
				'category'		=> '',
				'itemstatus' 	=> 'open',
				'posvotes' 		=> 0,
				'negvotes'		=> 0,
				'comments'		=> array()
		);
	}

	function _blankComment($id = -1) {
		return array(
				'id' 			=> $id,
				'timestamp' 	=> time(),
				'author' 		=> '',
				'title' 		=> '',
				'body' 			=> '',
				'email' 		=> '',
				'url'			=> '',
				'authorid' 		=> '',
				'host' 			=> '',
				'ip'			=> ''
		);
	}

	function _addAuthorName($name) {
		if (!in_array($name, $this->aAuthorNames))
			array_push($this->aAuthorNames, $name);
	}

	function _addCategoryName($name) {
		if (!in_array($name, $this->aCategoryNames))
			array_push($this->aCategoryNames, $name);
	}

	function sql_addToItem($title, $body, $more, $blogid, $authorid, $timestamp, $closed, $category, $karmapos, $karmaneg) {
		$title 		= trim(addslashes($title));
		$body 		= trim(addslashes($body));
		$more 		= trim(addslashes($more));
		$timestamp 	= date("Y-m-d H:i:s", $timestamp);

		$query = 'INSERT INTO '.sql_table('item').' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IKARMAPOS, IKARMANEG, ICAT) '
			   . "VALUES ('$title', '$body', '$more', $blogid, $authorid, '$timestamp', $closed, $karmapos, $karmaneg,  $category)";

		mysql_query($query) or die("Error while executing query: " . $query);

		return mysql_insert_id();
	}

	function sql_addToBlog($name, $shortname, $ownerid) {
		$name 		= addslashes($name);
		$shortname 	= addslashes($shortname);

		// create new category first
		mysql_query('INSERT INTO '.sql_table('category')." (CNAME, CDESC) VALUES ('General','Items that do not fit in another category')");
		$defcat = mysql_insert_id();

		$query = 'INSERT INTO '.sql_table('blog')." (BNAME, BSHORTNAME, BCOMMENTS, BMAXCOMMENTS, BDEFCAT) VALUES ('$name','$shortname',1 ,0, $defcat)";
		mysql_query($query) or die("Error while executing query: " . $query);
		$id = mysql_insert_id();

		// update category row so it links to blog
		mysql_query('UPDATE ' . sql_table('category') . ' SET cblog=' . intval($id). ' WHERE catid=' . intval($defcat));

		BlogImport::sql_addToTeam($id,$ownerid,1);


		return $id;
	}

	function sql_addToComments($name, $url, $body, $blogid, $itemid, $memberid, $timestamp, $host, $ip='') {
		$name 		= addslashes($name);
		$url 		= addslashes($url);
		$body 		= trim(addslashes($body));
		$host 		= addslashes($host);
		$ip 		= addslashes($ip);
		$timestamp 	= date("Y-m-d H:i:s", $timestamp);

		$query = 'INSERT INTO '.sql_table('comment')
			   . ' (CUSER, CMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CBLOG, CIP) '
			   . "VALUES ('$name', '$url', $memberid, '$body', $itemid, '$timestamp', '$host', $blogid, '$ip')";

		mysql_query($query) or die("Error while executing query: " . $query);

		return mysql_insert_id();
	}

	function sql_addToTeam($blogid, $memberid, $admin) {

		$query = 'INSERT INTO '.sql_table('team').' (TMEMBER, TBLOG, TADMIN) '
			   . "VALUES ($memberid, $blogid, $admin)";

		mysql_query($query) or die("Error while executing query: " . $query);

		return mysql_insert_id();
	}



}

// some sort of version checking
$ver = convert_getNucleusVersion();
if ($ver > 250)
	convert_doError("You should check the Nucleus website for updates to this convert tool. This one might not work with your current Nucleus installation.");

	// make sure the request variables get reqistered in the global scope
	// Doing this should be avoided on code rewrite (this is a potential security risk)
	if ((phpversion() >= "4.1.0") && (ini_get("register_globals") == 0)) {
		@import_request_variables("gp",'');
	}

	/** this function gets the nucleus version, even if the getNucleusVersion
	 * function does not exist yet
	 * return 96 for all versions < 100
	 */
	function convert_getNucleusVersion() {
		if (!function_exists('getNucleusVersion')) return 96;
		return getNucleusVersion();
	}

	// TODO: remove this function (replaced by BlogImport::sql_addToItem)
	function convert_addToItem($title, $body, $more, $blogid, $authorid, $timestamp, $closed, $category, $karmapos, $karmaneg) {
		$title = trim(addslashes($title));
		$body = trim(addslashes($body));
		$more = trim(addslashes($more));

		$query = 'INSERT INTO '.sql_table('item').' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IKARMAPOS, IKARMANEG, ICAT) '
			   . "VALUES ('$title', '$body', '$more', $blogid, $authorid, '$timestamp', $closed, $karmapos, $karmaneg,  $category)";

		mysql_query($query) or die("Error while executing query: " . $query);

		return mysql_insert_id();
	}


	// TODO: remove this function (replaced by BlogImport::sql_addToBlog)
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

	// TODO: remove this function (replaced by BlogImport::sql_addToComments)
	function convert_addToComments($name, $url, $body, $blogid, $itemid, $memberid, $timestamp, $host, $ip='') {
		$name = addslashes($name);
		$url = addslashes($url);
		$body = trim(addslashes($body));
		$host = addslashes($host);
		$ip = addslashes($ip);

		$query = 'INSERT INTO '.sql_table('comment')
			   . ' (CUSER, CMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CBLOG, CIP) '
			   . "VALUES ('$name', '$url', $memberid, '$body', $itemid, '$timestamp', '$host', $blogid, '$ip')";

		mysql_query($query) or die("Error while executing query: " . $query);

		return mysql_insert_id();
	}

	// TODO: remove this function (replaced by BlogImport::sql_addToTeam)
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