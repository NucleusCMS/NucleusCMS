<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
 * Copyright (C) 2002 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 *
 * This script will import a Blogger blog into a Nucleus blog, using
 * a easy to use wizard.
 *
 * Notes:
 *   - Templates are not converted
 *   - Nucleus should already be installed
 *	 - Members should exist for all teammembers
 *
 */

include("../../config.php");
include("functions.inc.php");
include($DIR_LIBS . "ADMIN.php");
include($DIR_LIBS . "MEDIA.php");

$thisFile = 'blogger.php';
$xmlFile = 'blogger.xml';

if (!$member->isLoggedIn($thisFile)) {
	convert_showLogin();
}

if (!$member->isAdmin()) {
	convert_doError('Only Super-Admins are allowed to perform blog conversions');
}

// include PRAX lib (to read XML files easily)
include ('PRAX.php');

switch($action) {
	case 'selectBlog':
		bc_selectBlog(); break;
	case 'assignMembers':
		bc_assignMembers(); break;
	case 'showOverview':
		bc_showOverview(); break;
	case 'doConvert':	
		bc_doConversion(); break;
	case 'login': // drop through
	default:
		bc_BloggerToXml(); 
}

// step 1: get the Blogger Blog ID 
function bc_BloggerToXml() {
	global $xmlFile, $thisFile;
	
	convert_head();
	
	?>
		<h1>Step 1: Exporting to a file</h1>
	
		<p>
		The first step in the conversion is to export all your Blogger entries into one single file. This is done by logging in in Blogger and by temporary changing your settings and templates. 
		<br />The full procedure is explained below:
		</p>
		
		<h2>Exporting</h2>
		
		<div class="note"><b>Note:</b> If you intend to keep using your weblog afterwards, write down the changes you made, so they can be undone afterwards. For the templates, copy paste the old ones in a textfile.</div>

		<ol>
			<li>
				Log into <a href="http://www.blogger.com/">Blogger</a> and go to the blog you want to export.
			</li>
			<li>
				Change the template of your blog to the following:
				
				<pre><code>&lt;?xml version="1.0"?&gt;

&lt;blog xmlns="http://nucleuscms.org/ns/import1.0" version="1.0">&gt;

 &lt;Blogger&gt;

  &lt;item id="&lt;$BlogItemNumber$&gt;"&gt;
   &lt;title&gt;&lt;BlogItemTitle&gt;&lt;$BlogItemTitle$&gt;&lt;/BlogItemTitle&gt;&lt;/title&gt;
   &lt;body&gt;&lt;![CDATA[&lt;$BlogItemBody$&gt;]]&gt;&lt;/body&gt;
   &lt;timestamp type="blogger"&gt;&lt;$BlogItemDateTime$&gt;&lt;/timestamp&gt;
   &lt;author&gt;&lt;$BlogItemAuthor$&gt;&lt;/author&gt;
  &lt;/item&gt;

 &lt;/Blogger&gt; 

&lt;/blog&gt;</code></pre>
				Don't forget to save changes!
			</li>
			<li>
				Go to the settings and change the following options:
				<ul>
					<li>
						Blog filename: <strong><?php echo $xmlFile?></strong>
					</li>
					<li>
						Show <b>900</b> <b>day's posts</b> on main page
					</li>
					<li>
						Date/Time Format: <b>MM/DD/YYYY HH:MM:SS AM|PM</b> (that option is not listed as such, instead it has the current date filled in)
					</li>
					<li>
						Archive Frequency: <b>No Archive</b>
					</li>
				</ul>
			</li>
			<li>
				Save the settings and publish your blog. You'll end up with a <?php echo $xmlFile;?> file on your server containing all of your blog items.
			</li>
			<li>
				If you're running blogspot, you'll need to edit this file and take out the advertising banner code.
			</li>
		</ol>
		
		<h2>Importing</h2>
		
		<p>You now have a file called <code><?php echo $xmlFile?></code>. Upload it in the same directory as the convert files (<code>/nucleus/convert</code>) and continue to the next step.</p>
		
		<p>
		<form method="post" action="<?php echo $thisFile;?>">
		<input type="submit" value="Next Step: Select Blog" />
		<input type="hidden" name="action" value="selectBlog" />
		</form>
		</p>
		
	<?php	
	convert_foot();
}

function bc_selectBlog() {
	global $CONF, $xmlFile, $thisFile;
	
	// some checks
	if (!file_exists($xmlFile))
		convert_doError($xmlFile . " not found. Make sure it is in the correct directory");
	if (!is_readable($xmlFile))
		convert_doError($xmlFile ." file is not readable. Make sure the file permissions are set correctly so PHP can access it.");

	convert_head();
	
	$oImport = new BlogImport();

	?>
	
	<h1>Step 2: Select Destination Blog</h1>
			
		<form method="post" action="<?php echo $thisFile;?>"><div>

	<?php 
		echo $oImport->getHtmlCode('ConvertSelectBlog'); 
	?>
				
		<p>
			<input type="submit" value="Next Step: Assign Members" />
			<input type="hidden" name="action" value="assignMembers" />
			(Could take quite a while. Press the button only once)
		</p>
		
		</div></form>
		
	<?php	
	convert_foot();


}

function bc_assignMembers() {
	global $xmlFile, $thisFile;
	global $CONF;
	
	// some checks
	if (!file_exists($xmlFile))
		convert_doError($xmlFile . " not found. Make sure it is in the correct directory");
	if (!is_readable($xmlFile))
		convert_doError($xmlFile ." file is not readable. Make sure the file permissions are set correctly so PHP can access it.");
		
	convert_head();

	?>
		<form method="post" action="<?php echo $thisFile;?>"><div>

		<h1>Step 3: Assign members and Categories</h1>

	<?php 
	
		// create blog if requested	
		$blogid = BlogImport::getBlogIdFromRequest();
		
		// read author and category names
		$oImport = new BlogImport($blogid, array('ReadNamesOnly' => 1));
		$oImport->importXmlFile($xmlFile);
		
		echo $oImport->getHtmlCode('ConvertSelectMembers');
//		echo $oImport->getHtmlCode('ConvertSelectCategories'); 		
	?>
		
		<p>
			<input type="submit" value="Start Conversion" />
			<input type="hidden" name="blogid" value="<?php echo intval($blogid) ?>" />
			<input type="hidden" name="action" value="doConvert" /> (Could take quite a while. Press the button only once)
		</p>
		
		</div></form>
	<?php	
	convert_foot();

}


function bc_doConversion() {
	global $xmlFile, $thisFile;

	// some checks
	if (!file_exists($xmlFile))
		convert_doError($xmlFile . " not found. Make sure it is in the correct directory");
	if (!is_readable($xmlFile))
		convert_doError($xmlFile ." file is not readable. Make sure the file permissions are set correctly so PHP can access it.");
		
	convert_head();		
	
	echo '<h1>Step 4: Conversion</h1>';

	echo '<h2>Importing...</h2>';	
	echo '<p>Hold on while your blog is imported...</p>';
	
	// 1. get all data
	$blogid = BlogImport::getBlogIdFromRequest();
	$oImport = new BlogImport($blogid);
	
	$oImport->getFromRequest('authors');
	$oImport->getFromRequest('categories');	
	$oImport->strCallback = '';	// don't use a callback method

	echo '<div>';
	$bOk = $oImport->importXmlFile($xmlFile);
	echo '</div>';

	// 2. import data...
	if (!$bOk) {
		echo '<p class="error">Error on import: ' . $oImport->getLastError() . '</p>';
		exit;
	}
	
	echo '<p>Successfully imported items</p>';
	
	echo '<h2>Mappings</h2>';
	echo '<pre>';
	print_r($oImport->aMapIdToNucleusId);
	echo '</pre>';
	
	convert_foot();
	/*
	for ($i=0;$i<$authorcount;$i++) {
		$key = $author[$i];
		$memberid[$key] = intval($HTTP_POST_VARS['memberid'][$i]);
		$isadmin[$key] = intval($HTTP_POST_VARS['admin'][$i]);
	}

	$createnew = intval($HTTP_POST_VARS['createnew']);
	$newblogname = stripslashes($HTTP_POST_VARS['newblogname']);
	$newowner = intval($HTTP_POST_VARS['newowner']);
	
	$nucleus_blogid = intval($HTTP_POST_VARS['blogid']);

	
	// 2. check data

	convert_head();
	
	?>
		<h1>Step 3: Converting...</h1>
		
		<p>
		Please be patient. Don't hit reload! The conversion progress should be showing below.
		</p>
	<?php	
	// try to extend time limit 
	// surpress error messages when not allowed to do so
	@set_time_limit(1200);

	echo "<pre>";
	
	echo "Authors: <br/>";
	for ($i=0;$i<$authorcount;$i++) {
		echo  "\tAuthor=" . $author[$i];
		echo " ID=" . $memberid[$author[$i]];
		echo " ADMIN=" . $isadmin[$author[$i]];
		echo "<br />";
	}
	echo "Create New Weblog = $createnew (name='$newblogname', owner=$newowner, dest=$nucleus_blogid)<br />";

	echo "</pre>";

	// create blog
	if ($createnew == 1) {
		// choose unique name
		$shortname = 'blogger';
		if (BLOG::exists($shortname)) {
			$idx = 1;
			while (BLOG::exists($shortname . $idx))
				$idx++;
			$shortname = $shortname . $idx;
		}

		$nucleus_blogid = convert_addToBlog($newblogname, $shortname, $newowner);
		echo "<pre>New blog created</pre>";
	} 
	
	// add authors to blog team
	$b = new BLOG($nucleus_blogid);
	global $catid;
	$catid = $b->getDefaultCategory();
	
	for ($i=0;$i<$authorcount;$i++) 
		$b->addTeamMember($memberid[$author[$i]],$isadmin[$author[$i]]);
	

	// 3. go through file

	$blog = new RAX();
	$blog->openfile('blogger.xml'); 
	$blog->record_delim = 'blogentry';
	$blog->parse();

	while ( $entry = $blog->readRecord() )  {
		$row = $entry->getRow();

		bc_convertOneItem($row, $memberid, $nucleus_blogid);
	}

	$blog->close();	// close the file
	
	echo "<pre>All done!</pre>";
	*/
	convert_foot();

}
/*
function bc_convertOneItem($row, $memberid, $nucleus_blogid) {
	global $catid;
	
	$nucl_id = $memberid[$row['author']];

	$timestamp = date("Y-m-d H:i:s",bc_transformDate($row['date']));	

	echo "<pre>";
	echo "<b>body</b>:" .  htmlspecialchars(substr($row['body'],0,20)) . "...(time: " . $timestamp . ") \n";
	echo "<b>author</b>: " . $row['author'] ;
	echo " (nucleus-id: " . $nucl_id . ")";
	echo "</pre>";

	$title = $row['title']; // use the title when it is in the XML file
	convert_addToItem($title, $row['body'], '', $nucleus_blogid, $nucl_id, $timestamp, 0, $catid, 0, 0);	
	
}

function bc_transformDate($date) {
	// 7/24/2000 11:27:13 AM
	if (eregi("(.*)/(.*)/(.*) (.*):(.*):(.*) (.*)",$date,$regs) != false) {
		if (($regs[7] == "PM") && ($regs[4] != "12"))
			$regs[4] += 12;
		return mktime($regs[4],$regs[5],$regs[6],$regs[1],$regs[2],$regs[3]);

	} else {
		return 0;
	}

}
*/




?>