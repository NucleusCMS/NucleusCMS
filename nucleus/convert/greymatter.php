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
 * This script will convert a GreyMatter blog to a Nucleus blog, using
 * a easy to use wizard.
 *
 * Last Modified: August 20, 2002
 *
 * Notes:
 *   - templates are not converted
 *   - Nucleus should already be installed
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 */

include("../../config.php");
include("functions.inc.php");
include($DIR_LIBS . "ADMIN.php");
include($DIR_LIBS . "MEDIA.php");

if (!$member->isLoggedIn()) {
	convert_showLogin('greymatter.php');
}

if (!$member->isAdmin()) {
	convert_doError('Only Super-Admins are allowed to perform blog conversions');
}

$ver = convert_getNucleusVersion();
if ($ver > 210)
	convert_doError("You should check the Nucleus website for updates to this convert tool. This one might not work with your current Nucleus installation.");

switch($action) {
	case "assignMembers":
		gmc_assignMembers(); break;
	case "showOverview":
		gmc_showOverview(); break;
	case "doConversion":
		gmc_doConversion(); break;
	case "login": // drop through
	default:
		gmc_askGreyPath();
}

function gmc_askGreyPath() {
	global $HTTP_SERVER_VARS, $PHP_SELF;

	convert_head();

	// try to guess greymatter path
	$guess = $HTTP_SERVER_VARS["PATH_TRANSLATED"];
	$guess = str_replace("/nucleus/convert","",$guess);
	$guess = str_replace("greymatter.php","",$guess);
	$guess = str_replace("\\","/",$guess);
	// add slash at end if necessary
	if (!endsWithSlash($guess)) $guess .= '/';

	if (file_exists($guess . 'gm-authors.cgi'))
		$guess = $guess;
	else if (file_exists($guess . 'gm/gm-authors.cgi'))
		$guess = $guess . 'gm/';
	else if (file_exists($guess . 'greymatter/gm-authors.cgi'))
		$guess = $guess . 'greymatter/';
	else if (file_exists($guess . '../gm-authors.cgi'))
		$guess = $guess . '../';
	else if (file_exists($guess . '../gm/gm-authors.cgi'))
		$guess = $guess . '../gm/';
	else if (file_exists($guess . '../greymatter/gm-authors.cgi'))
		$guess = $guess . '../greymatter/';


	?>
		<h1>Before you start</h1>

		<p>
		Before you start converting, make sure that you have created Nucleus Member accounts for all your GreyMatter authors. You'll be asked to assign Nucleus member accounts to GreyMatter authors in the next step.
		</p>

		<p>
		If you used {{popup}} tags in GreyMatter to create popup windows with images, make sure you've set the mediadir correctly and that has the correct filepermissions to allow upload. (Nucleus will copy your images to that directory)
		</p>

		<h1>Greymatter Path</h1>

		<form method="post" action="greymatter.php">

		<p>
		Please enter the path in which the GreyMatter script is installed below. The current value is a guess by Nucleus. The GreyMatter data path will be extracted from the GM config in the next step.
		<br />
		<b>Note:</b> The path should end with a slash!
		</p>

		<ul>
			<li>GreyMatter path: <input name="grey_scriptpath" size="60" value="<?php echo htmlspecialchars($guess)?>" /></li>
		</ul>

		<p>
		<input type="submit" value="Next Step: Assign Members to Authors" />
		<input type="hidden" name="action" value="assignMembers" />
		</p>

		</form>
	<?php
	convert_foot();
}

function gmc_assignMembers() {
	global $HTTP_POST_VARS, $CONF;

	// get data from form
	$grey_scriptpath = stripslashes($HTTP_POST_VARS['grey_scriptpath']);
	$grey_scriptpath = str_replace("\\","/",$grey_scriptpath);

	// some checks
	if (!is_dir($grey_scriptpath))
		convert_doError("Given GreyMatter Path does not exist");
	if (!endsWithSlash($grey_scriptpath))
		convert_doError("Given GreyMatter Path does not end with a slash");
	$grey_configfile = $grey_scriptpath . 'gm-config.cgi';
	if (!is_readable($grey_configfile))
		convert_doError("GreyMatter configfile ($grey_configfile) is not readable. Make sure the path is correct and the file permissions are set correctly so PHP can access it.");

	// get datapath out of configfile
	$filehandle = fopen($grey_configfile,'r');
		$skip = fgets($filehandle,4096);
		$grey_datapath = chop(fgets($filehandle,4096)) . '/';
		$skip = fgets($filehandle,4096);
		$grey_dataurl = chop(fgets($filehandle,4096)) . '/';
	fclose($filehandle);

	if (!is_dir($grey_datapath))
		convert_doError("GreyMatter Data Path extracted from GreyMatter configuration does not exist. Please check your GreyMatter settings.");

	$grey_authorfile = $grey_scriptpath . 'gm-authors.cgi';

	if (!is_readable($grey_authorfile))
		convert_doError("GreyMatter authorfile ($grey_authorfile) is not readable. Make sure the path is correct and the file permissions are set correctly so PHP can access it.");

	convert_head();

	?>
		<form method="post" action="greymatter.php">


		<h1>Assign Members to Authors</h1>

		<p>
		Below is a list of all the GreyMatter authors that Nucleus could discover. Please assign a Nucleus Member to all of these authors.
		</p>


		<table>
		<tr>
			<th>GreyMatter Author</th>
			<th>Nucleus Member</th>
			<th>Blog Admin?</th>
		</tr>

		<?php
$filehandle = fopen($grey_authorfile,'r');
	$idx = 1;
while ($author = fgets($filehandle,4096)) {
	list ($a_name, $a_pwd, $a_email, $a_url, $a_data, $a_entries, $a_entryaccess, $a_entryeditaccess, $a_configureaccess, $templateaccess, $a_authoraccess, $a_rebuildaccess, $a_cplogaccess, $bookmarkletaccess, $uploadaccess, $loginaccess) = explode ("|", $author);
	?>
		<tr>
			<td>
				<b><?php echo $a_name?></b>
				<input name="author[<?php echo $idx?>]" value="<?php echo htmlspecialchars($a_name)?>" type="hidden"
			</td>
			<td>
		<?php			// TODO: avoid doing this query multiple times
			$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');

			$template['name'] = 'memberid[' . $idx . ']';
			showlist($query,'select',$template);
		?>
			</td>
			<td>
				<input name="admin[<?php echo $idx?>]" type="checkbox" value="1" id="admin<?php echo $idx?>" <?php					if ($a_configureaccess == 'Y') echo "checked='checked'";
				?>
				/><label for="admin<?php echo $idx?>">Blog Admin</label>
			</td>
		</tr>
	<?php	$idx++;
} // while

fclose($filehandle);

		?>
		<tr>
			<td>
				<i>(users not listed in gm-authors.cgi)</i>
				<input name="author[0]" value="_other_" type="hidden" />
			</td>
			<td>
				<?php					// TODO: avoid doing this query multiple times
					$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');

					$template['name'] = 'memberid[0]';
					showlist($query,'select',$template);
				?>
			</td>
			<td>
				<input name="admin[0]" type="checkbox" value="1" id="admin0" /><label for="admin0">Blog Admin</label>
			</td>
		</tr>
		</table>


		<h1>Choose Destination Weblog</h1>

		<p>
		There are two options: you can either choose an existing blog to add the greymatter entries into, or you can choose to create a new weblog.
		</p>

		<div>
			<input name="createnew" value="0" type="radio" checked='checked' label="createnew_no" /><label for="createnew_no">Choose existing weblog to add to</label>:

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
				<?php					// TODO: avoid doing this query multiple times
					$query =  'SELECT mname as text, mnumber as value FROM '.sql_table('member');

					$template['name'] = 'newowner';
					showlist($query,'select',$template);
				?>
				</li>
			</ul>
		</div>

		<h1>Do the conversion!</h1>
		<p>
		<input type="hidden" name="authorcount" value="<?php echo $idx?>" />
		<input type="hidden" name="grey_scriptpath" value="<?php echo htmlspecialchars($grey_scriptpath)?>" />
		<input type="hidden" name="grey_datapath" value="<?php echo htmlspecialchars($grey_datapath)?>" />
		<input type="hidden" name="grey_dataurl" value="<?php echo htmlspecialchars($grey_dataurl)?>" />
		<input type="submit" value="Do the conversion!" />
		<input type="hidden" name="action" value="doConversion" />
		</p>

		</form>
	<?php
	convert_foot();

}

function gmc_doConversion() {
	global $HTTP_POST_VARS;

	// 1. get all data

	$authorcount = intval($HTTP_POST_VARS['authorcount']);
	$author = $HTTP_POST_VARS['author'];

	for ($i=0;$i<$authorcount;$i++) {
		$key = $author[$i];
		$memberid[$key] = intval($HTTP_POST_VARS['memberid'][$i]);
		$isadmin[$key] = intval($HTTP_POST_VARS['admin'][$i]);
	}

	$grey_scriptpath = stripslashes($HTTP_POST_VARS['grey_scriptpath']);
	$grey_datapath = stripslashes($HTTP_POST_VARS['grey_datapath']);
	$grey_dataurl = stripslashes($HTTP_POST_VARS['grey_dataurl']);

	// needed in gm_popup
	global $grey_datapath;

	$createnew = intval($HTTP_POST_VARS['createnew']);
	$newblogname = stripslashes($HTTP_POST_VARS['newblogname']);
	$newowner = intval($HTTP_POST_VARS['newowner']);

	$nucleus_blogid = intval($HTTP_POST_VARS['blogid']);


	// 2. check the data

	convert_head();

	?>
		<h1>Converting...</h1>

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
		$shortname = 'greymatter';
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
	$blog = new BLOG($nucleus_blogid);
	global $catid;
	$catid = $blog->getDefaultCategory();
	for ($i=0;$i<$authorcount;$i++)
		$blog->addTeamMember($memberid[$author[$i]],$isadmin[$author[$i]]);

	// go through all files
	$dirhandle = opendir($grey_datapath);
	while ($filename = readdir($dirhandle)) {
		if (ereg("\.cgi$",$filename)) {
			gmc_convertOneFile($grey_datapath . $filename, $nucleus_blogid, $memberid);
		}
	}
	closedir($dirhandle);

	echo "<pre>All done!</pre>";

	convert_foot();

}

/**
  * Converts one GreyMatter entry into a Nucleus Item
  */
function gmc_convertOneFile($filename, $nucleus_blogid, $memberid) {
	global $catid;

	echo "<pre>";

	$filehandle = fopen($filename,'r');

	$entry_info = fgets($filehandle,4096);	// entry info
	$entry_karma = fgets($filehandle,4096); // ips of karma voters (ignore)
	$entry_body = fgets($filehandle,4096);  // body
	$entry_more = fgets($filehandle,4096);  // extended

	// decode information
	$entry_info = str_replace("|*|","\n",$entry_info);
	$entry_body = str_replace("|*|","\n",$entry_body);
	$entry_more = str_replace("|*|","\n",$entry_more);

	list ($e_number, $e_author, $e_title, $e_wday, $e_mon, $e_mday, $e_year, $e_hour, $e_min, $e_sec, $e_ampm, $e_karmapos, $e_karmaneg, $e_commentcount, $e_allowkarma, $e_allowcomments, $e_openclosed) = explode ("|", $entry_info);

	if (($e_ampm == "PM") && ($e_hour != 12 ))
		$e_hour = $e_hour + 12;

	if ($e_allowcomments == "yes")
		$e_closed = 0;
	else
		$e_closed = 1;

	$e_timestamp = mktime($e_hour, $e_min, $e_sec, $e_mon, $e_mday, $e_year);
	$e_timestamp = date("Y-m-d H:i:s",$e_timestamp);



	$nucl_id = $memberid[$e_author];
	if (intval($nucl_id) == 0)
		$nucl_id = $memberid['_other_'];

	// handle {{link, {{linkmo, {{email and {{emailmo
	$e_title = gm_parsecommands($e_title,$nucl_id);
	$entry_body = gm_parsecommands($entry_body,$nucl_id);
	$entry_more = gm_parsecommands(trim($entry_more),$nucl_id);

	echo "Title: <b>$e_title</b><br />";
	echo "\tGreyMatter Author = $e_author<br />";
	echo "\tNucleus Memberid = $nucl_id<br />";
	echo "\tKarma: $e_karmapos+/$e_karmaneg-<br />";


	// add to nucleus_item table
	$nucleus_itemid = convert_addToItem($e_title, $entry_body, $entry_more, $nucleus_blogid, $nucl_id, $e_timestamp, $e_closed, $catid, $e_karmapos, $e_karmaneg);


	echo "\tComments: <br/>";

	while ($comment = fgets($filehandle,4096)) {
		// echo "\t\tConverting comment: $comment<br />";

		// decode
		$comment = str_replace("|*|","\n",$comment);
		list ($c_author, $c_ip, $c_email, $c_url, $c_wday, $c_mon, $c_mday, $c_year, $c_hour, $c_min, $c_sec, $c_ampm, $c_body) = explode("|",$comment);

		echo "\t\tConverting comment by <i>$c_author</i><br />";

		// make hrefs out of links
		$c_body = eregi_replace("(http://([a-zA-Z0-9]|\.|/|~|%|&|\?|\@|\=|_|\+|\:|;|-)*)","<a href='\\0'>http://.../</a>",$c_body);

		// special markup commands
		$c_body = gm_parsecommands($c_body,0);

		if ($c_ampm == "PM")
			$c_hour = $c_hour + 12;
		$c_timestamp = mktime($c_hour, $c_min, $c_sec, $c_mon, $c_mday, $c_year);
		$c_timestamp = date("Y-m-d H:i:s",$c_timestamp);

		// choose url or email to pass as userid
		if (stristr($c_url,'http://') != false)
			$c_userid = $c_url;
		else
			$c_userid = $c_email;

		// add to comments
		convert_addToComments($c_author, $c_userid, $c_body, $nucleus_blogid, $nucleus_itemid, 0, $c_timestamp, $c_ip);

	}


	fclose($filehandle);

	echo "</pre>";
}

// returns $text with special greymatter markup commands expanded.
function gm_parsecommands($text, $authorid ) {
	// special markup characters
	//  **bold text** -> <b>bold text</b>
	//  __underlined text__ -> <u>underlined text</u>
	//  \\italic text\\ -> <i>italic text</i>
	$to_replace = array(
		"/\*\*(.*?)\*\*/is",
		"/\\\\(.*?)\\\\/is",
		"/__(.*?)__/is"
	);
	$replace_by = array(
		"<b>\\1</b>",
		"<i>\\1</i>",
		"<u>\\1</u>"
	);
	$text = preg_replace($to_replace, $replace_by, $text);

	// {{link url}}
	// {{link url text}}
	// {{linkmo url text|mouseover text}}
	// {{email address}}
	// {{email address text}}
	// {{emailmo address text|mouseover text}}
	// {{popup
	if (strstr($text,"{{link") || stristr($text,"{{email") || stristr($text,"{{popup")) {
		$to_replace = array(
			"/({{linkmo) (http|https|ftp)(:\/\/\S+?) (.+?)(\|)(.+?)(}})/ies",
			"/({{link) (http|https|ftp)(:\/\/\S+?)(}})/is",
			"/({{link) (http|https|ftp)(:\/\/\S+?) (.+?)(}})/is",
			"/({{emailmo) (\S+\@\S+?) (.+?)(\|)(.+?)(}})/ies",
			"/({{email) (\S+\@\S+?)(}})/is",
			"/({{email) (\S+\@\S+?) (.+?)(}})/is",
			"/{{popup (\S+) (.+?) (\d+)x(\d+)}}(.*?)<\/a>/ies"
		);
		$replace_by = array(
			// linkmo
			'gm_linkmo("\\2\\3","\\6","\\4")',
			// link
			"<a href='\\2\\3'>\\2\\3</a>",
			"<a href='\\2\\3'>\\4</a>",
			// emailmo
			'gm_linkmo("mailto:\\2","\\5","\\3")',
			// email
			"<a href='mailto:\\2'>\\2</a>",
			"<a href='mailto:\\2'>\\3</a>",
			// popup
			'gm_popup("\\1",$authorid,"\\5",\\3,\\4)'
		);
		$text = preg_replace($to_replace, $replace_by, $text);
	}

	// newlines (greymatter renders newlines as linebreaks)
	$text = ereg_replace("\n","<br />",$text); // newlines

	return $text;
}

// makes sure quotes are escaped in javascript strings
// php seems to quote the arguments as the get passed to this method by preg_replace
// with /e modifier
function gm_linkmo($url, $mouseover, $text) {
	// remove slashes from text (not needed there)
	$text = stripslashes($text);

	// replace " by \' in mouseover (to avoid error)
	$mouseover = str_replace('"',"\'",$mouseover);

	return '<a href="' . $url . '" onmouseover="window.status=\'' . $mouseover .  '\';return true" onmouseout="window.status=\'\';return true">'.$text.'</a>';
}

// converts GM {{popup command into a link to the image
function gm_popup($filename, $authorid, $text, $width, $height) {
	global $grey_datapath;

	$res = MEDIA::addMediaObject(MEMBER::createFromID($authorid), "$grey_datapath$filename", $filename);

	if ($res != "")
		die("error copying media files: $res");

	// TODO: copy file to media directory
	// TODO: create %popup(...)% code instead

	$text = htmlspecialchars(stripslashes($text));

	return "<%popup($filename|$width|$height|$text)%>";
}



?>