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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 *
 */

	include('upgrade.functions.php');

	// begin if: make sure user is logged in
	if ( !$member->isLoggedIn() )
	{
		upgrade_showLogin('index.php');
	} // end if

	// begin if: make sure user is an admin
	if ( !$member->isAdmin() )
	{
		upgrade_error('Only super administrators are allowed to perform upgrades');
	} // end if

	upgrade_head();
?>

	<h1> Upgrade Nucleus </h1>

	<div class="note">
		<p> <strong>Note:</strong> If you just installed Nucleus for the first time and are not upgrading from an earlier version, you will not need these files. </p>
	</div>

	<p> Database updates may be required when upgrading from an earlier version of Nucleus. This tool allows you to automate these updates. </p>

<?php
	// calculate current version
	if ( !upgrade_checkinstall(96) )
	{
		$current = 95;
	}
	else if ( !upgrade_checkinstall(100) )
	{
		$current = 96;
	}
	else if ( !upgrade_checkinstall(110) )
	{
		$current = 100;
	}
	else if ( !upgrade_checkinstall(150) )
	{
		$current = 110;
	}
	else if ( !upgrade_checkinstall(200) )
	{
		$current = 150;
	}
	else if ( !upgrade_checkinstall(250) )
	{
		$current = 200;
	}
	else if ( !upgrade_checkinstall(300) )
	{
		$current = 250;
	}
	else if ( !upgrade_checkinstall(310) )
	{
		$current = 300;
	}
	else if ( !upgrade_checkinstall(320) )
	{
		$current = 310;
	}
	else if ( !upgrade_checkinstall(330) )
	{
		$current = 320;
	}
	else if ( !upgrade_checkinstall(340) )
	{
		$current = 330;
	}
	else if ( !upgrade_checkinstall(350) )
	{
		$current = 340;
	}
	else if ( !upgrade_checkinstall(360) )
	{
		$current = 350;
	}
	else if ( !upgrade_checkinstall(400)  )
	{
		$current = 360;
	}
	else
	{
		$current = 400;
	}
	
	if ( $current == 400 )
	{
?>
	<p class="ok"> No database updates required! The database has already been updated to the latest version of Nucleus. </p>
<?php
	}
	else
	{
?>
	<p class="warning"> <a href="upgrade.php?from=<?php echo $current?>">Click here to upgrade the database to Nucleus v3.6</a>. </p>
<?php
	}
?>

	<div class="note">
		<p> <strong>Note:</strong> It is strongly recommended that you create a database backup <em>before</em> performing upgrades. </p>
	</div>

	<h1> Manual Updates </h1>
	<p> Some updates need to be performed manually. Instructions are given below (if any). </p>

<?php
	$from = intGetVar('from');

	if ( !$from )
	{
		$from = $current;
	}

	$sth = 0;

	if ( !$DIR_MEDIA )
	{
		upgrade_manual_96();
		$sth = 1;
	}

	if ( !$DIR_SKINS )
	{
		upgrade_manual_200();
		$sth = 1;
	}

	// upgrades from pre-340 version need to be told of recommended .htaccess files for the media and skins folders. these .htaccess files are included in new installs of 340 or higher
	if ( in_array($from, array(95, 96)) || $from < 340 )
	{
		upgrade_manual_340();
		$sth = 1;
	}

	// upgrades from pre-350 version need to be told of deprecation of PHP4 support and two new plugins included with 3.5 and higher
	if ( in_array($from, array(95, 96)) || $from < 350 )
	{
		upgrade_manual_350();
		$sth = 1;
	}

	if ( $sth == 0 )
	{
		echo '<p class="ok"> No manual changes needed. This must be your lucky day! </p>';
	}

	upgrade_foot();


	/**
	 * 
	 * @param int $version
	 */
	function upgrade_todo($version)
	{
		return upgrade_checkinstall($version) ? "(<span class='ok'>installed</span>)" : "(<span class='warning'>not yet installed</span>)";
	}


	/**
	 * Manual update instructions for version 0.96
	 */
	function upgrade_manual_96()
	{
		global $DIR_NUCLEUS;

		$guess = str_replace('/nucleus/', '/media/', $DIR_NUCLEUS);
?>
	<h2> Changes needed for Nucleus 0.96 </h2>
	<p> A manual addition needs to be made to <em>config.php</em>, in order to get the media functions to work. Here's what to add: </p>
	<pre>
	// path to media dir
	$DIR_MEDIA = '<strong><?php echo i18n;;hsc($guess)?></strong>';
	</pre>

	<p> Also, it will be necessary to create that directory yourself. If you want to make file upload possible, you should set the permissions of the media/ directory to 777 (see the documentation/tips.html in Nucleus 0.96+ for a quick guide on setting permissions). </p>

<?php
	} // end function upgrade_manual_96()


	/**
	 * Manual update instructions for version 2.0 and before
	 */
	function upgrade_manual_200()
	{
		global $DIR_NUCLEUS;

		$guess = str_replace("/nucleus/", "/skins/", $DIR_NUCLEUS);
?>
	<h2> Changes needed for Nucleus 2.0 </h2>
	<p> A manual addition needs to be made to <i>config.php</i>, in order to get imported skins to work correctly. Here's what to add: </p>
	<pre>
	// extra skin files for imported skins
	$DIR_SKINS = '<strong><?php echo i18n;;hsc($guess)?></strong>';
	</pre>

	<p> Also, it will be necessary to create this directory yourself. Downloaded skins can then be expanded into that directory and be imported from inside the Nucleus admin area. </p>

	<h3> RSS 2.0 and RSD skin </h3>

	<p> When a fresh version of Nucleus 2.0 is installed, an RSS 2.0 (Really Simple Syndication) syndication skin is also installed, as well as an RSD skin (Really Simple Discovery). The files <code>xml-rss2.php</code> and <code>rsd.php</code> are available in the upgrade, however the skin itself needs to be installed manually. After you've uploaded the contents of the <code>upgrade-files</code>, open <code>admin area &gt; nucleus management &gt; skin import</code>. From there, you can install both skins. (Unless you don't want them installed, that is) </p>

<?php
	} // end function upgrade_manual_200()


	/**
	 * Manual update instructions for version 3.4 and before
	 */
	function upgrade_manual_340()
	{
		global $DIR_NUCLEUS;
?>
	<h2> Changes needed for Nucleus 3.4 </h2>
	<p> It is recommended that you apply some restrictions to what you allow the web server to do with files in the <i>media</i> and <i>skins</i> folders. These restrictions are not necessary to the functioning of the software, nor to the security of the software. However, they can be an important help under the security principle of denying any access that is not required. </p>

	<p> Instructions for applying the restrictions are found in the following two files on your server: </p>
	<ul>
		<li> <a href="../../extra/media/readme.txt">extra/media/readme.txt</a> </li>
		<li> <a href="../../extra/skins/readme.txt">extra/skins/readme.txt</a> </li>
	</ul>

<?php
	} // end function upgrade_manual_340()


	/**
	 * Manual update instructions for version 3.5 and before
	 */
	function upgrade_manual_350()
	{
		global $DIR_NUCLEUS;
?>
	<h2> Important Notices for Nucleus 3.5 </h2>

<?php
	// Give user warning if they are running old version of PHP
	if ( phpversion() < '5' )
	{
		echo '<p> WARNING: You are running NucleusCMS on a older version of PHP that is no longer supported by NucleusCMS. Please upgrade to PHP5! </p>';
	}
?>

	<p> Two new plugins have been included with version 3.5. You may want to consider installing them from the Plugins page of the admin area. </p>
	<ul>
		<li> <strong>NP_Text</strong>: Allows you to use internationalized skins to simplify translation. </li>
		<li> <strong>NP_SecurityEnforcer</strong>: Enforces some security properties like password complexity and maximum failed login attempts. Note that it is disabled by default and must be enabled after installation. </li>
	</ul>

<?php
	} // end function upgrade_manual_350()
