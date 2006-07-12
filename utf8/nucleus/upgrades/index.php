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
  * $Id: index.php,v 1.6 2006-07-12 07:11:49 kimitake Exp $
  * $NucleusJP: index.php,v 1.5 2005/03/19 07:20:28 kimitake Exp $
  */

include('upgrade.functions.php'); 
  
// check if logged in etc
if (!$member->isLoggedIn()) {
  upgrade_showLogin('index.php');
}

if (!$member->isAdmin()) {
  upgrade_error('Super-admin（最高管理者）のみがアップグレードを実行できます。');
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
    メディア機能を使用するために<i>config.php</i>を手動で変更する必要があります。下記の通り追加します:
  </p>
  <pre>
  // path to media dir
  $DIR_MEDIA = '<b><?php echo htmlspecialchars($guess)?></b>';
  </pre>
  
  <p>
  また、ディレクトリもあなた自身の手で作る必要があります。もしファイルのアップロードを可能にしたいのであれば、media/ ディレクトリのパーミッションを777にします。（Nucleus 0.96+ のためのパーミッションの設定に関するクイックガイドが documentation/tips.html にあります）
  </p>
  
<?php }

function upgrade_manual_20() {
  global $DIR_NUCLEUS;
  
  $guess = str_replace("/nucleus/","/skins/",$DIR_NUCLEUS);
?>
  <h2>Nucleus 2.0 用に必要な変更</h2>
  <p>
    スキンの取り込み機能を使用するために<i>config.php</i>を手動で変更する必要があります。下記の通り追加します:
  </p>
  <pre>
  // extra skin files for imported skins
  $DIR_SKINS = '<b><?php echo htmlspecialchars($guess)?></b>';
  </pre>
  
  <p>また、ディレクトリもあなた自身の手で作る必要があります。これでダウンロードしたスキンを上記ディレクトリに展開したり、Nucleus 管理画面から取り込んだりできるようになります。</p>
  
  <h3>RSS 2.0 と RSD スキン</h3>
  
  <p>Nucleus 2.0 を新規にインストールしたとき、RSD(Really Simple Discovery) 用のスキンの他に、RSS 2.0(Really Simple Syndication)用のスキンもまたインストールされます。<code>xml-rss2.php</code> と <code>rsd.php</code> の両ファイルはアップグレードされますが、スキンに関しては手動でインストールする必要があります。<code>upgrade-files</code>の中身をアップロードしたあと、管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから両スキンをインストールすることができます（もしインストールするつもりがなければ、しなくても結構です）。</p>
  
<?php }

function upgrade_manual_php405() {
?>
<h2>PHP のバージョンが 4.0.3, 4.0.4 または 4.0.5 の場合に必要となる変更</h2>
<p>
  PHP のバージョンが 4.0.6 より以前の場合、変更が必要なファイルが２つあります。PHP のバージョンを 4.0.6 や 4.2.2+以降のものにアップグレードした方がいいでしょう（4.0.6 や 4.2.2 以前のものにはセキュリティー問題があります）。もし PHP のアップグレードが困難もしくは、する予定がない場合は、以下のファイルを変更して下さい。
</p>
<ul>
  <li>nucleus/libs/PARSER.php のコードが下記のようになっていることを確認して下さい。（84行目から）:
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
    <li>nucleus/libs/PARSER.php のコードが下記のようになっていることを確認して下さい。（75行目から）:
    <pre>
// $params = array_map('trim',$params);
foreach ($params as $key =&gt; $value) { $params[$key] = trim($value); }
    </pre>
    </li>
  </ul>
  
<?php }

?>
