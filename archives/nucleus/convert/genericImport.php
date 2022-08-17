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
 * This script is intended to be used in conjunction with one
 * of the specific convert tools that exist for different
 * blogging tools
 *
 * Here's how everything works together
 *		Step 1:
 *			- bloggerToXml.php:		Blogger -> generic XML
 *			- pMachineToXml.php		pMachine -> generic XML
 *			- MovableTypeToXml.php	MT -> generic XML
 *		Step 1:
 *			- genericImport.php		generic XML -> Nucleus
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 */

include("../../config.php");
include("functions.inc.php");
include($DIR_LIBS . "ADMIN.php");
include($DIR_LIBS . "MEDIA.php");

if (!$member->isLoggedIn()) {
	convert_showLogin('genericImport.php');
}

if (!$member->isAdmin()) {
	convert_doError('Only Super-Admins are allowed to perform blog conversions');
}

$ver = convert_getNucleusVersion();
if ($ver > 250)
	convert_doError("You should check the Nucleus website for updates to this convert tool. This one might not work with your current Nucleus installation.");

// include PRAX lib (to read XML files easily)
include ('PRAX.php');

switch($action) {
	case "assignMembers":
		gi_assignMembers(); break;
	case "doConversion":
		gi_doConversion(); break;
	case "login": // drop through
	default:
		gi_chooseXmlFile();
}

// step 1: Let the user choose which XML file she wants to import
function gi_chooseXmlFile() {
	global $HTTP_SERVER_VARS, $PHP_SELF;

	convert_head();

	?>

		<h1>Step 1: Choose File To Import</h1>

		<p>
		You're about to import the contents of a weblog that was created with another blogging tool than Nucleus.
		</p>

		<h2>Export to generic XML</h2>

		<p>
		Before you can start the actual import process, you'll need to export the contents from your (non-Nucleus) weblog into a generic XML file using one of the conversion scripts listed below. Such scripts are available for a variety of blog scripts:
		</p>

		<ul>
			<li><a href="bloggerToXml.php">Blogger</a> <strong>(not implemented yet)</strong></li>
			<li><a href="pMachineToXml.php">pMachine</a> <strong>(not implemented yet)</strong></li>
			<li><strong>(to be worked out)</strong></li>
		</ul>

		<h2>Import from generic XML</h2>

		<p>
		You'll end up with an XML file (e.g. <code>export.xml</code>). Upload this file to the same directory as the convert files (<code>/nucleus/convert/</code>) and reload this page. Your file should appear in the selection box below.
		</p>

		<p>
			<strong>(to be worked out)</strong>

			<form method="post" action="genericImport.php"><div>
			<input type="submit" value="Next Step: Assign Members to Authors" />
			<input type="hidden" name="action" value="assignMembers" />
			</div></form>
		</p>

	<?php
	convert_foot();
}


function gi_assignMembers() {
	global $CONF;

	// some checks
	if (!file_exists('export.xml'))
		convert_doError("export.xml not found. Make sure it is in the correct directory");
	if (!is_readable('export.xml'))
		convert_doError("The export.xml file is not readable. Make sure the file permissions are set correctly so PHP can access it.");

	convert_head();

	?>
		<form method="post" action="genericImport.php">


		<h1>Step 2: Assign Members to Authors</h1>

		<p>
		Below is a list of all the authors that Nucleus could discover (only authors that have posted at least one entry are listed). Please assign a Nucleus Member to all of these authors.
		</p>


		<table>
		<tr>
			<th>Tool Author</th>
			<th>Nucleus Member</th>
			<th>Blog Admin?</th>
		</tr>

	<?php		// TODO

	?>
		</table>

		<h1>Choose Destination Weblog</h1>

		<p>
		There are two options: you can either choose an existing blog to add the imported entries into, or you can choose to create a new weblog.
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


function gi_doConversion() {
	// TODO
}



?>