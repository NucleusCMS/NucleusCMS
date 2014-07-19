<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2013 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
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

<p>Nucleus CMSはバージョンアップ毎に、データベースのテーブル構造を少しずつ変えています。このスクリプト集は、古いバージョンの Nucleus からアップグレードする際に必要な、データベーステーブルのアップグレードを行います。</p>

<?php	// calculate current version
	if (!upgrade_checkinstall(96)) $current = 95;
	else	if (!upgrade_checkinstall(100)) $current = 96;
	else	if (!upgrade_checkinstall(110)) $current = 100;
	else	if (!upgrade_checkinstall(150)) $current = 110;
	else	if (!upgrade_checkinstall(200)) $current = 150;
	else	if (!upgrade_checkinstall(250)) $current = 200;
	else	if (!upgrade_checkinstall(300)) $current = 250;
	else	if (!upgrade_checkinstall(310)) $current = 300;
	else	if (!upgrade_checkinstall(320)) $current = 310;
	else	if (!upgrade_checkinstall(330)) $current = 320;
	else	if (!upgrade_checkinstall(331)) $current = 330;
	else	if (!upgrade_checkinstall(340)) $current = 331;
	else	if (!upgrade_checkinstall(350)) $current = 340;
	else	if (!upgrade_checkinstall(360)) $current = 350;
	else	$current = 360;
	
	if ($current == 360) {
?>
<p class="ok">自動でできるアップグレードはありません。データベースは既に最新の Nucleus 用にアップデートされています。</p> 	 
<?php
	} else {
		if (phpversion() < '5.0.0') {
?>		
<p class="deprecated">警告！ 動作しているPHPのバージョンが古く、正常な動作を保証できません。アップグレード作業を中止して、PHP5以上が使えないかどうか、サーバ管理者に確認して下さい。</p>
<?php		
		}
?>
<p class="warning"><a href="upgrade.php?from=<?php echo $current?>">ここをクリックしてデータベースを Nucleus v3.62 用にアップグレードします</a></p>
<?php
	 }
?>

<div class="note">
<b>注意:</b> 作業中、各ステップごとにデータベースのバックアップを忘れないようにして下さい。

</div>

<h1>手動変更</h1>

<p>いくつかの変更は手動で行う必要があります。下記にその手順を示します。</p>

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
	upgrade_manual_20();
	$sth = 1;
}

// from v3.3, atom feed supports 1.0 and blogsetting is added
$sth = upgrade_manual_atom1_0();

// upgrades from pre-340 version need to be told of recommended .htaccess files for the media and skins folders.
// these .htaccess files are included in new installs of 340 or higher
if (in_array($from,array(95,96)) || $from < 340) {
	upgrade_manual_340();
	$sth = 1;
} 

// upgrades from pre-350 version need to be told of deprecation of PHP4 support and two new plugins 
// included with 3.51 and higher
if (in_array($from,array(95,96)) || $from < 350) {
	upgrade_manual_350();
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
	$DIR_MEDIA = '<b><?php echo hsc($guess)?></b>';
	</pre>

	<p>
	また、ディレクトリもあなた自身の手で作る必要があります。もしファイルのアップロードを可能にしたいのであれば、media/ ディレクトリのパーミッションを777にします。（Nucleus 0.96+ のためのパーミッションの設定に関するクイックガイドが documentation/tips.html にあります）
	</p>

<?php }

function upgrade_manual_200() {
	global $DIR_NUCLEUS;

	$guess = str_replace("/nucleus/","/skins/",$DIR_NUCLEUS);
?>
	<h2>Nucleus 2.0 用に必要な変更</h2>
	<p>
		スキンの取り込み機能を使用するために<i>config.php</i>を手動で変更する必要があります。下記の通り追加します:
	</p>
	<pre>
	// extra skin files for imported skins
	$DIR_SKINS = '<b><?php echo hsc($guess)?></b>';
	</pre>

	<p>また、ディレクトリもあなた自身の手で作る必要があります。これでダウンロードしたスキンを上記ディレクトリに展開したり、Nucleus 管理画面から取り込んだりできるようになります。</p>

	<h3>RSS 2.0 と RSD スキン</h3>

	<p>Nucleus 2.0 を新規にインストールしたとき、RSD(Really Simple Discovery) 用のスキンの他に、RSS 2.0(Really Simple Syndication)用のスキンもまたインストールされます。<code>xml-rss2.php</code> と <code>rsd.php</code> の両ファイルはアップグレードされますが、スキンに関しては手動でインストールする必要があります。<code>upgrade-files</code>の中身をアップロードしたあと、管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから両スキンをインストールすることができます（もしインストールするつもりがなければ、しなくても結構です）。</p>

<?php }

function upgrade_manual_340() {
	global $DIR_NUCLEUS;

?>
	<h2>Nucleus 3.4 用に必要な変更</h2>
	<p>
		<em>skins</em>ディレクトリと<em>media</em>ディレクトリに「.haccess」を設置して、アクセス制限をかけることが推奨されます。この変更は、Nucleusの機能やセキュリティに直接関係があるわけではありませんが、不正アクセスを防ぐ為の重要な助けになるでしょう。
	</p>
	
	<p>
		手順は以下の2つのファイルに書いてありますので参考にしてください：
		<ul>
			 <li><a href="../../extra/htaccess/media/readme.ja.txt">extra/htaccess/media/readme.ja.txt</a></li>
			 <li><a href="../../extra/htaccess/skins/readme.ja.txt">extra/htaccess/skins/readme.ja.txt</a></li>
		</ul>
	</p>
	
<?php }

function upgrade_manual_350() {
	global $DIR_NUCLEUS;

?>
	<h2>Nucleus 3.51に関する重要なお知らせ</h2>
	
<?php	// Give user warning if they are running old version of PHP
				if (phpversion() < '5') {
								echo '<p>警告：サーバで稼動しているPHPのバージョンが、NucleusCMSの動作保障外の古いバージョンのようです。PHP5以上にアップグレードしてください！</p>';
				}
}

function upgrade_manual_atom1_0() {

		$sth = 0;

		// atom 1.0
		$query = 'SELECT sddesc FROM ' . sql_table('skin_desc')
				. ' WHERE sdname="feeds/atom"';
		$res = mysql_query($query);
		while ($o = mysql_fetch_object($res)) {
				if ($o->sddesc=='Atom 0.3 weblog syndication')
				{
						$sth = 1;
?>
<h2>Atom 1.0</h2>
<p>Nucleus 3.3 から atom feed が 1.0 対応になりましたので、次の手順でスキン・テンプレートのアップグレードをして下さい。</p>

<p>管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから atom を選択し、読み込みボタンを押して上書きインストールしてください。</p>

<p>もし atom のスキンやテンプレートを変更している場合は、既存の内容をファイルに書き出して（skinbackup.xml というファイルが作成されます）、/skins/atom/skinbackup.xml （これが新しいファイル）と比較し、この新しいファイルを更新します。その後、前述の通り管理者画面からスキンの「読込/書出」を開いて同様にして上書きインストールして下さい。</p>

<?php
				}
		}

		// default skin
		$query = 'SELECT tdnumber FROM ' . sql_table('template_desc')
					 . ' WHERE tdname="default/index"';
		$res = mysql_query($query);
		$tdnumber = 0;
		while ($o = mysql_fetch_object($res)) {
				$tdnumber = $o->tdnumber;
		}
		if ($tdnumber>0)
		{
				$query = 'SELECT tpartname FROM ' . sql_table('template')
							 . ' WHERE tdesc=' . $tdnumber . ' AND tpartname="BLOGLIST_LISTITEM"';
				$res = mysql_query($query);
				if (!mysql_fetch_object($res)) {

						$sth = 1;
?>
<h2>Default スキン</h2>
<p>Nucleus 3.3 からいくつかのフォームの CSS が変更になっています。たとえば最初のページのログインフォームや、コメント投稿のためのフォームなど。このためフォームの表示が崩れるので、次の手順でDefault スキンのアップグレードをして下さい。</p>

<p>管理者画面を開き、管理ホームにあるスキンの「読込/書出」を開きます。そこから default を選択し、読み込みボタンを押して上書きインストールしてください。</p>

<p>もし default のスキンやテンプレートを変更している場合は、既存の内容をファイルに書き出して（skinbackup.xml というファイルが作成されます）、/skins/default/skinbackup.xml （これが新しいファイル）と比較し、この新しいファイルを更新します。その後、前述の通り管理者画面からスキンの「読込/書出」を開いて同様にして上書きインストールして下さい。</p>
<?php
				}
		}

		return $sth;
}

?>
