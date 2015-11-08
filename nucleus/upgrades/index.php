<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS
 * Copyright (C) 2003-2015 The Nucleus Group　Japan (http://japan.nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group  (http://nucleuscms.org/)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

include('upgrade.functions.php');

load_upgrade_lang();

// check if logged in etc
if (!$member->isLoggedIn()) {
	upgrade_showLogin('index.php');
}

if (!$member->isAdmin()) {
	upgrade_error(_UPG_TEXT_ONLY_SUPER_ADMIN);
}

$echo = array();
$echo[] = "\n<h1>"  . _UPG_TEXT_UPGRADE_SCRIPTS . "</h1>\n";

?>

<div class="note">
<b>Note:</b> <?php $echo[] = _UPG_TEXT_NOTE01NEW; ?>
</div>

<p><?php $echo[] = _UPG_TEXT_NOTE02; ?></p>

<?php	// calculate current version
if     (!upgrade_checkinstall(250)) $current = 200;
elseif (!upgrade_checkinstall(300)) $current = 250;
elseif (!upgrade_checkinstall(310)) $current = 300;
elseif (!upgrade_checkinstall(320)) $current = 310;
elseif (!upgrade_checkinstall(330)) $current = 320;
elseif (!upgrade_checkinstall(331)) $current = 330;
elseif (!upgrade_checkinstall(340)) $current = 331;
elseif (!upgrade_checkinstall(350)) $current = 340;
elseif (!upgrade_checkinstall(360)) $current = 350;
elseif (!upgrade_checkinstall(370)) $current = 360;
elseif (!upgrade_checkinstall(371)) $current = 370;
else                                $current = 371;

if ($current == 371)
	$echo[] = '<p class="ok">' . _UPG_TEXT_NO_AUTOMATIC_UPGRADES_REQUIRED . "</p> \n";
else {
	if (phpversion() < '5.0.0') {
		$echo[] = '<p class="deprecated">' . _UPG_TEXT_WARN_DEPRECATED_PHP4_STOP ."</p>\n";
	}
	$echo[] = sprintf('<p class="warning"><a href="upgrade.php?from=%s">%s</a></p>', $current , _UPG_TEXT_CLICK_HERE_TO_UPGRADE);
}

ob_start();

$echo[] = "<div class=\"note\">\n";
$echo[] = sprintf("<b>%s:</b> %s\n" , _UPG_TEXT_NOTE50_WARNING , _UPG_TEXT_NOTE50_MAKE_BACKUP);
$echo[] = "</div>\n";

$echo[] = "<h1>" . _UPG_TEXT_NOTE50_MANUAL_CHANGES ."</h1>\n";
$echo[] = "<p>" . _UPG_TEXT_NOTE50_MANUAL_CHANGES_01 ."</p>\n";

	
$from = intGetVar('from');
if (!$from) $from = $current;

$sth = 0;

if (in_array($from,array(95,96)) || $from < 366)
	$sth += upgrade_manual_366();

if (!$DIR_MEDIA)
	$sth += upgrade_manual_96();

if (!$DIR_SKINS)
	$sth += upgrade_manual_20();

// from v3.3, atom feed supports 1.0 and blogsetting is added
if($from<330)
	$sth += upgrade_manual_atom1_0();

// upgrades from pre-340 version need to be told of recommended .htaccess files for the media and skins folders.
// these .htaccess files are included in new installs of 340 or higher
if (in_array($from,array(95,96)) || $from < 340)
	$sth += upgrade_manual_340();

// upgrades from pre-350 version need to be told of deprecation of PHP4 support and two new plugins 
// included with 3.51 and higher
if (in_array($from,array(95,96)) || $from < 350)
	$sth += upgrade_manual_350();

$content = ob_get_clean();

if (0<$sth) $echo[] = $content;

upgrade_head();
echo join('',$echo);
upgrade_foot();

function upgrade_todo($ver) {
	return upgrade_checkinstall($ver) ? "(<span class='ok'>". _UPG_TEXT_60_INSTALLED ."</span>)" : "(<span class='warning'>". _UPG_TEXT_60_NOT_INSTALLED ."</span>)";
}

function upgrade_manual_96() {
	global $DIR_NUCLEUS;

	$guess = str_replace("/nucleus/","/media/",$DIR_NUCLEUS);
?>
	<h2><?php echo sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS , '0.96'); ?></h2>
	<p><?php echo _UPG_TEXT_V096MEDIA; ?>:</p>
	<pre>
	// path to media dir
	$DIR_MEDIA = '<b><?php echo hsc($guess)?></b>';
	</pre>

	<p><?php echo _UPG_TEXT_V096MEDIA02; ?></p>

<?php
	return 1;
}

function upgrade_manual_200() {
	global $DIR_NUCLEUS;

	$guess = str_replace("/nucleus/","/skins/",$DIR_NUCLEUS);
?>
	<h2><?php echo sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS , '2.0'); ?></h2>
	<p><?php echo _UPG_TEXT_V200_01; ?>:</p>
	<pre>
	// extra skin files for imported skins
	$DIR_SKINS = '<b><?php echo hsc($guess)?></b>';
	</pre>
<?php
	echo "<p>". _UPG_TEXT_V200_02 . "</p>\n";

	echo "<h3>". _UPG_TEXT_V200_RSS_RSD . "</h3>\n";

	echo "<p>". _UPG_TEXT_V200_04 . "</p>\n";

	return 1;
}

function upgrade_manual_340() {
	global $DIR_NUCLEUS;

	echo "<h2>" . sprintf(_UPG_TEXT_CHANGES_NEEDED_FOR_NUCLEUS , '3.4') . "</h2>\n";

	echo "<p>" . _UPG_TEXT_V340_01 . "</p>\n";

?>	
	<p>
		<?php echo _UPG_TEXT_V340_02; ?>：
		<ul>
			 <li><a href="../../extra/htaccess/media/readme.ja.txt">extra/htaccess/media/readme.ja.txt</a></li>
			 <li><a href="../../extra/htaccess/skins/readme.ja.txt">extra/htaccess/skins/readme.ja.txt</a></li>
		</ul>
	</p>
	
<?php
	return 1;
}

function upgrade_manual_350() {
	if (phpversion() < '5') {
		echo '<h2>'. _UPG_TEXT_V350_01_IMPORTANT .'</h2>';
		echo '<p>' . _UPG_TEXT_WARN_PHP_IS_OLD . '</p>';
		return 1;
	}
}

function upgrade_manual_366() {
	$content = @file_get_contents('../../action.php');
	if(strpos($content,'=&')!==false) {
		echo '<h2>' . _UPG_TEXT_V366_01 . '</h2>';
		echo '<p>' . _UPG_TEXT_V366_02_UPDATE_ACTION_PHP .'</p>';
		return 1;
	}
}

function upgrade_manual_atom1_0() {

	$sth += 0;

	// atom 1.0
	$query = sprintf('SELECT sddesc FROM %s WHERE sdname="feeds/atom"',sql_table('skin_desc'));
	$res = sql_query($query);
	while ($o = sql_fetch_object($res)) {
		if ($o->sddesc=='Atom 0.3 weblog syndication')
		{
			$sth += 1;
?>
<h2>Atom 1.0</h2>
<p><?php echo _UPG_TEXT_ATOM1_01; ?></p>

<p><?php echo _UPG_TEXT_ATOM1_02; ?></p>

<p><?php echo _UPG_TEXT_ATOM1_03; ?></p>

<?php
			}
	}

	// default skin
	$query = sprintf('SELECT tdnumber FROM %s WHERE tdname="default/index"',sql_table('template_desc'));
	$res = sql_query($query);
	$tdnumber = 0;
	$o = sql_fetch_object($res);
	$tdnumber = $o->tdnumber;
	if (0<$tdnumber)
	{
		$query = sprintf("SELECT tpartname FROM %s WHERE tdesc=%s AND tpartname='BLOGLIST_LISTITEM'",sql_table('template'),$tdnumber);
		$res = sql_query($query);
		if (!sql_fetch_object($res)) {
			$sth += 1;
?>
<h2><?php echo _UPG_TEXT_ATOM1_04; ?></h2>
<p><?php echo _UPG_TEXT_ATOM1_05; ?></p>

<p><?php echo _UPG_TEXT_ATOM1_06; ?></p>

<p><?php echo _UPG_TEXT_ATOM1_07; ?></p>
<?php
		}
	}
	return $sth;
}
