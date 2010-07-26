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

// check if logged in etc
if (!$member->isLoggedIn()) {
  upgrade_showLogin('index.php');
}

if (!$member->isAdmin()) {
  upgrade_error('Only Super-Admins are allowed to perform upgrades');
}

upgrade_head();

?>

<h1>Upgrade Scripts</h1>

<div class="note">
<b>Note:</b> If you aren't upgrading from an old Nucleus version (you installed Nucleus from scratch), you won't need these files.
</div>

<p>
When upgrading from an older Nucleus version, upgrades to the database tables are required. This upgrade script allows you to automate these changes.
</p>

<?php  // calculate current version
	  if (!upgrade_checkinstall(96)) $current = 95;
  else  if (!upgrade_checkinstall(100)) $current = 96;
  else  if (!upgrade_checkinstall(110)) $current = 100;
  else  if (!upgrade_checkinstall(150)) $current = 110;
  else  if (!upgrade_checkinstall(200)) $current = 150;
  else  if (!upgrade_checkinstall(250)) $current = 200;
  else  if (!upgrade_checkinstall(300)) $current = 250;
  else  if (!upgrade_checkinstall(310)) $current = 300;
  else  if (!upgrade_checkinstall(320)) $current = 310;
  else  if (!upgrade_checkinstall(330)) $current = 320;
  else  if (!upgrade_checkinstall(340)) $current = 330;
  else  if (!upgrade_checkinstall(350)) $current = 340;
  else  if (!upgrade_checkinstall(360)) $current = 350;
  else  $current = 360;

  if ($current == 360) {
	?>
	  <p class="ok">No automatic upgrades required! The database tables have already been updated to the latest version of Nucleus.</p>
	<?php
  } else {
	?>
	  <p class="warning"><a href="upgrade.php?from=<?php echo $current?>">Click here to upgrade the database to Nucleus v3.6</a></p>
	<?php
  }
?>

<div class="note">
<b>Note:</b> Don't forget to make a backup of your database every once in a while!<br/>
It is suggested that you do so before upgrading the database in case things go wrong.
</div>

<h1>Manual changes</h1>

<p>Some changes need to be done manually. Instructions are given below (if any)</p>

<?php
$from = intGetVar('from');
if (!$from) 
	$from = $current;

$sth = 0;
if (!$DIR_MEDIA) {
  upgrade_manual_96();
  $sth = 1;
}
if (!$DIR_SKINS) {
  upgrade_manual_200();
  $sth = 1;
}

// some manual code changes are needed in order to get Nucleus to work on php version
// lower than 4.0.6
if (phpversion() < '4.0.6') {
  upgrade_manual_php405();
  $sth = 1;
}

// upgrades from pre-340 version need to be told of recommended .htaccess files for the media and skins folders.
// these .htaccess files are included in new installs of 340 or higher
if (in_array($from,array(95,96)) || $from < 340) {
  upgrade_manual_340();
  $sth = 1;
} 

// upgrades from pre-350 version need to be told of deprecation of PHP4 support and two new plugins 
// included with 3.5 and higher
if (in_array($from,array(95,96)) || $from < 350) {
  upgrade_manual_350();
  $sth = 1;
} 

if ($sth == 0)
  echo "<p class='ok'>No manual changes needed. This must be your lucky day!</p>";



upgrade_foot();

function upgrade_todo($ver) {
  return upgrade_checkinstall($ver) ? "(<span class='ok'>installed</span>)" : "(<span class='warning'>not yet installed</span>)";
}

function upgrade_manual_96() {
  global $DIR_NUCLEUS;

  $guess = str_replace("/nucleus/","/media/",$DIR_NUCLEUS);
?>
  <h2>Changes needed for Nucleus 0.96</h2>
  <p>
	A manual addition needs to be made to <i>config.php</i>, in order to get the media functions to work. Here's what to add:
  </p>
  <pre>
  // path to media dir
  $DIR_MEDIA = '<b><?php echo htmlspecialchars($guess)?></b>';
  </pre>

  <p>
  Also, it will be necessary to create that directory yourself. If you want to make file upload possible, you should set the permissions of the media/ directory to 777 (see the documentation/tips.html in Nucleus 0.96+ for a quick guide on setting permissions).
  </p>

<?php }

function upgrade_manual_200() {
  global $DIR_NUCLEUS;

  $guess = str_replace("/nucleus/","/skins/",$DIR_NUCLEUS);
?>
  <h2>Changes needed for Nucleus 2.0</h2>
  <p>
	A manual addition needs to be made to <i>config.php</i>, in order to get imported skins to work correctly. Here's what to add:
  </p>
  <pre>
  // extra skin files for imported skins
  $DIR_SKINS = '<b><?php echo htmlspecialchars($guess)?></b>';
  </pre>

  <p>Also, it will be necessary to create this directory yourself. Downloaded skins can then be expanded into that directory and be imported from inside the Nucleus admin area.</p>

  <h3>RSS 2.0 and RSD skin</h3>

  <p>When a fresh version of Nucleus 2.0 is installed, an RSS 2.0 (Really Simple Syndication) syndication skin is also installed, as well as an RSD skin (Really Simple Discovery). The files <code>xml-rss2.php</code> and <code>rsd.php</code> are available in the upgrade, however the skin itself needs to be installed manually. After you've uploaded the contents of the <code>upgrade-files</code>, open <code>admin area &gt; nucleus management &gt; skin import</code>. From there, you can install both skins. (Unless you don't want them installed, that is)</p>

<?php }

function upgrade_manual_340() {
  global $DIR_NUCLEUS;

?>
  <h2>Changes needed for Nucleus 3.4</h2>
  <p>
	It is recommended that you apply some restrictions to what you allow the web server to do with files in the <i>media</i> and <i>skins</i> folders. These restrictions are not necessary to the functioning of the software, nor to the security of the software. However, they can be an important help under the security principle of denying any access that is not required.
  </p>
  
  <p>
    Instructions for applying the restrictions are found in the following two files on your server:
	<ul>
	   <li><a href="../../extra/media/readme.txt">extra/media/readme.txt</a></li>
	   <li><a href="../../extra/skins/readme.txt">extra/skins/readme.txt</a></li>
	</ul>
  </p>
  
<?php }

function upgrade_manual_350() {
  global $DIR_NUCLEUS;

?>
  <h2>Important Notices for Nucleus 3.5</h2>
  
<?php	// Give user warning if they are running old version of PHP
        if (phpversion() < '5') {
                echo '<p>WARNING: You are running NucleusCMS on a older version of PHP that is no longer supported by NucleusCMS. Please upgrade to PHP5!</p>';
        }
?>  
  
  <p>
    Two new plugins have been included with version 3.5. You may want to consider installing them from the Plugins page of the admin area.
	<ul>
	   <li><strong>NP_Text</strong>: Allows you to use internationalized skins to simplify translation.</li>
	   <li><strong>NP_SecurityEnforcer</strong>: Enforces some security properties like password complexity and maximum failed login attempts. Note that it is disabled by default and must be enabled after installation.</li>
	</ul>
  </p>

<?php }

function upgrade_manual_php405() {
?>
<h2>Changes needed when running PHP versions 4.0.3, 4.0.4 and 4.0.5</h2>
<p>
  There are two files that need to be changed when running PHP versions lower than 4.0.6. Even better would be to upgrade to PHP 4.0.6 or PHP 4.2.2+ (there are security issues with all PHP versions &lt; 4.0.6 and 4.2.2). If you're not able or not willing to upgrade, here's what to change:
</p>
<ul>
  <li>Make sure the code in nucleus/libs/PARSER.php is as follows (starting from line 84):
	<pre>

  if (in_array($actionlc, $this-&gt;actions) || $this-&gt;norestrictions ) {
	<strong>$this-&gt;call_using_array($action, $this-&gt;handler, $params);</strong>
  } else {
	// redirect to plugin action if possible
	if (in_array('plugin', $this-&gt;actions)
	  && $manager-&gt;pluginInstalled('NP_'.$action))
	  $this-&gt;doAction('plugin('.$action.
		$this-&gt;pdelim.implode($this-&gt;pdelim,$params).')');
	else
	  echo '&lt;b&gt;DISALLOWED (' , $action , ')&lt;/b&gt;';
  }


}
	 </pre>
	</li>
	<li>Make sure the code in nucleus/libs/PARSER.php is as follows (starting from line 75):
	<pre>
// $params = array_map('trim',$params);
foreach ($params as $key =&gt; $value) { $params[$key] = trim($value); }
	</pre>
	</li>
  </ul>

<?php }

?>
