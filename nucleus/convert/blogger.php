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

if (!$member->isLoggedIn()) {
	convert_showLogin('blogger.php');
}

if (!$member->isAdmin()) {
	convert_doError('Only Super-Admins are allowed to perform blog conversions');
}

$ver = convert_getNucleusVersion();
if ($ver > 210)
	convert_doError("You should check the Nucleus website for updates to this convert tool. This one might not work with your current Nucleus installation.");

// include PRAX lib (to read XML files easily)
include ('PRAX.php');

switch($action) {
	case "assignMembers":
		bc_assignMembers(); break;
	case "showOverview":
		bc_showOverview(); break;
	case "doConversion":	
		bc_doConversion(); break;
	case "login": // drop through
	default:
		bc_getBloggerBlogID(); 
}

// step 1: get the Blogger Blog ID 
function bc_getBloggerBlogID() {
	global $HTTP_SERVER_VARS, $PHP_SELF;

	convert_head();
	
	?>
		<div class="note">
		<b>Note:</b> This conversion tool was written for Free Blogger blogs. If you use it for BloggerPro blogs, you'll lose the titles of your posts (as I currently have no information on the templating system of BloggerPro)
		</div>
		
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
				
				<pre>
&lt;?xml version="1.0"?&gt;

&lt;bloggerblog&gt;

 &lt;Blogger&gt;

  &lt;blogentry&gt;
   &lt;body&gt;&lt;![CDATA[&lt;$BlogItemBody$&gt;]]&gt;&lt;/body&gt;
   &lt;date&gt;&lt;$BlogItemDateTime$&gt;&lt;/date&gt;
   &lt;author&gt;&lt;$BlogItemAuthor$&gt;&lt;/author&gt;
  &lt;/blogentry&gt;

 &lt;/Blogger&gt; 

&lt;/bloggerblog&gt;
				</pre>
				Don't forget to save changes!
			</li>
			<li>
				Go to the settings and change the following options:
				<ul>
					<li>
						Blog filename: <b>blogger.xml</b>
					</li>
					<li>
						Show <b>900</b> <b>day's posts</b> on main page
					</li>
					<li>
						Date/Time Format: <b>DD/MM/YYYY HH:MM:SS AM|PM</b> (that option is not listed as such, instead it has the current date filled in)
					</li>
					<li>
						Archive Frequency: <b>No Archive</b>
					</li>
				</ul>
			</li>
			<li>
				Save the settings and publish your blog. You'll end up with a blogger.xml file on your server containing all of your blog items.
			</li>
		</ol>
		
		<h2>Importing</h2>
		
		<p>
		Now you have a file called <b>blogger.xml</b>. Upload it in the same directory as the convert files (/nucleus/convert) and continue to the next step.
		</p>
		
		<p>
		<form method="post" action="blogger.php">
		<input type="submit" value="Next Step: Assign Members to Authors" />
		<input type="hidden" name="action" value="assignMembers" />
		</form>
		</p>
		
	<?php	
	convert_foot();
}


function bc_assignMembers() {
	global $HTTP_POST_VARS, $CONF;
	
	// some checks
	if (!file_exists('blogger.xml'))
		convert_doError("blogger.xml not found. Make sure it is in the correct directory");
	if (!is_readable('blogger.xml'))
		convert_doError("The blogger.xml file is not readable. Make sure the file permissions are set correctly so PHP can access it.");
		
	convert_head();
	
	?>
		<form method="post" action="blogger.php">
		
		
		<h1>Step 2: Assign Members to Authors</h1>
		
		<p>
		Below is a list of all the authors that Nucleus could discover (only authors that have posted at least one entry are listed). Please assign a Nucleus Member to all of these authors.
		</p>
		

		<table>
		<tr>
			<th>Blogger Author</th>
			<th>Nucleus Member</th>
			<th>Blog Admin?</th>
		</tr>
	
		<?php		
		$blog = new RAX();
		$blog->openfile('blogger.xml'); 
		$blog->record_delim = 'blogentry';
		$blog->parse();

		$authors = array();

		while ( $entry = $blog->readRecord() )  {
			$row = $entry->getRow();

			// handle one item
			if (!in_array($row['author'],$authors))
				array_push($authors,$row['author']);
		
		}

		$blog->close();	// close the file
		$idx = 0;

while ($a_name = array_pop($authors)) {
	?>
		<tr>
			<td>
				<b><?php echo $a_name?></b>
				<input name="author[<?php echo $idx?>]" value="<?php echo htmlspecialchars($a_name)?>" type="hidden"
			</td>
			<td>
		<?php			$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');

			$template['name'] = 'memberid[' . $idx . ']';
			showlist($query,'select',$template);		
		?>
			</td>
			<td>
				<input name="admin[<?php echo $idx?>]" type="checkbox" value="1" id="admin<?php echo $idx?>" /><label for="admin<?php echo $idx?>">Blog Admin</label>
			</td>
		</tr>
	<?php	$idx++;
} // while

		
		?>
		</table>
		
		
		<h1>Choose Destination Weblog</h1>
		
		<p>
		There are two options: you can either choose an existing blog to add the blogger entries into, or you can choose to create a new weblog.
		</p>
		
		<div>
			<input name="createnew" value="0" type="radio" checked='checked' id="createnew_no" /><label for="createnew_no">Choose existing weblog to add to:</label>
			
			<?php					$query =  'SELECT bname as text, bnumber as value FROM '.sql_table('blog');
					$template['name'] = 'blogid';
					$template['selected'] = $CONF['DefaultBlog'];
					showlist($query,'select',$template);				
			?>
		</div>
		<div>
			<input name="createnew" value="1" type="radio" id="createnew_yes" /><label for="createnew_yes">Create new weblog</label>
			<ul>
				<li>New blog name: <input name="newblogname" /></li>
				<li>Blog owner: 
				<?php					$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');

					$template['name'] = 'newowner';
					showlist($query,'select',$template);		
				?>
				</li>
			</ul>
		</div>		
		
		<h1>Do the conversion!</h1>
		<p>
		<input type="hidden" name="authorcount" value="<?php echo $idx?>" />
		<input type="submit" value="Step 3: Do the conversion!" />
		<input type="hidden" name="action" value="doConversion" />
		</p>
		
		<div class="note">
		<b>Note:</b> Clicking the button once is enough, even if it takes a while to complete.
		</div>
		
		</form>
	<?php	
	convert_foot();

}


function bc_doConversion() {
	global $HTTP_POST_VARS;
	
	// 1. get all data
	$authorcount = intval($HTTP_POST_VARS['authorcount']);
	$author = $HTTP_POST_VARS['author'];
	
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
	

	// 3. go through blogger.xml file

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
	
	convert_foot();

}

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





?>