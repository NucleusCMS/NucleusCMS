<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002-2005 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * $Id: index.php,v 1.3 2005-03-17 08:57:28 kimitake Exp $
  * $NucleusJP$
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

<h1>アップグレードスクリプト集</h1>

<div class="note">
<b>Note:</b> もし古いバージョンの Nuclues からアップグレードしようとしているのでなければ（つまりまっさらな状態からインストールしたのであれば）、これらのスクリプト集は必要ありません。
</div>

<p>
古いバージョンの Nucleus からアップグレードするとき、データベーステーブルのアップグレードが必要です。
このアップグレードスクリプトを実行することでそれが可能となります。
</p>

<?php  // calculate current version
      if (!upgrade_checkinstall(96)) $current = 95;
  else  if (!upgrade_checkinstall(10)) $current = 96;
  else  if (!upgrade_checkinstall(11)) $current = 10;
  else  if (!upgrade_checkinstall(15)) $current = 11;  
  else  if (!upgrade_checkinstall(20)) $current = 15;    
  else  if (!upgrade_checkinstall(25)) $current = 20;      
  else  if (!upgrade_checkinstall(30)) $current = 25;      
  else  if (!upgrade_checkinstall(31)) $current = 30;      
  else  if (!upgrade_checkinstall(32)) $current = 31;      
  else  $current = 32;

  if ($current == 32) {
    ?>
      <p class="ok">自動でできるアップグレードはありません。データベースは既に最新の Nucleus 用にアップデートされています。</p>
    <?php  } else {
    ?>
      <p class="warning"><a href="upgrade.php?from=<?php echo $current?>">ここをクリックしてデータベースを Nucleus v3.2 用にアップグレードします</a></p>
    <?php  }
?>

<div class="note">
<b>注意:</b> 作業中、各ステップごとにデータベースのバックアップを忘れないようにして下さい。
</div>

<h1>手動変更</h1>

<p>いくつかの変更は手動で行う必要があります。下記にその手順を示します。</p>

<?php
$sth = 0;
if (!$DIR_MEDIA) {
  upgrade_manual_96();
  $sth = 1;
}
if (!$DIR_SKINS) {
  upgrade_manual_20();
  $sth = 1;
}

// some manual code changes are needed in order to get Nucleus to work on php version
// lower than 4.0.6
if (phpversion() < '4.0.6') {
  upgrade_manual_php405();
  $sth = 1;
}

if ($sth == 0)
  echo "<p class='ok'>手動変更は必要ありません。今日はラッキーな日ですね!</p>";  



upgrade_foot();

function upgrade_todo($ver) {
  return upgrade_checkinstall($ver) ? "(<span class='ok'>インストール済み</span>)" : "(<span class='warning'>インストールが必要</span>)";
}

function upgrade_manual_96() {
  global $DIR_NUCLEUS;
  
  $guess = str_replace("/nucleus/","/media/",$DIR_NUCLEUS);
?>
  <h2>Nucleus 0.96 用に必要な変更</h2>
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

function upgrade_manual_20() {
  global $DIR_NUCLEUS;
  
  $guess = str_replace("/nucleus/","/skins/",$DIR_NUCLEUS);
?>
  <h2>Nucleus 2.0 用に必要な変更</h2>
  <p>
    A manual addition needs to be made to <i>config.php</i>, in order to get imported skins to work correctly. Here's what to add:
  </p>
  <pre>
  // extra skin files for imported skins
  $DIR_SKINS = '<b><?php echo htmlspecialchars($guess)?></b>';
  </pre>
  
  <p>Also, it will be necessary to create this directory yourself. Downloaded skins can then be expanded into that directory and be imported from inside the Nucleus admin area.</p>
  
  <h3>RSS 2.0 and RSD スキン</h3>
  
  <p>When a fresh version of Nucleus 2.0 is installed, an RSS 2.0 (Really Simple Syndication) syndication skin is also installed, as well as an RSD skin (Really Simple Discovery). The files <code>xml-rss2.php</code> and <code>rsd.php</code> are available in the upgrade, however the skin itself needs to be installed manually. After you've uploaded the contents of the <code>upgrade-files</code>, open <code>admin area &gt; nucleus management &gt; skin import</code>. From there, you can install both skins. (Unless you don't want them installed, that is)</p>
  
<?php }

function upgrade_manual_php405() {
?>
<h2>PHP のバージョンが 4.0.3, 4.0.4 または 4.0.5 の場合に必要となる変更</h2>
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
