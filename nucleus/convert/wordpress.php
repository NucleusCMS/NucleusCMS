<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2005-2006 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/* Orginal author: Radek HULAN  */
/* http://hulan.cz/             */
/*                              */
/* Adapted to NucleusCMS from   */
/* Blog:CMS by Edmond Hui       */
/*                              */
/* This script will convert     */
/* your WP blog into            */
/* Nucleus CMS weblog           */
/*
  v1.1 - add robustness code for category creation and item adding (admun)
  v1.2 - add sql_table()
*/

include("../../config.php");

  function def($s){ 
    if (isset($_POST[$s])) 
      echo addslashes(stripslashes($_POST[$s])); 
    else {
      if (strstr($s,'host')) echo "localhost";
      if (strstr($s,'username')) echo "root";
      if (strstr($s,'wpprefix')) echo "wp_";
    }
  }
  
  function error($s){
    global $isok;
    $isok=false;
    echo "<h3>Error: $s</h3>";
  }
  
  // line breaks into properly formatted paragraphs
  function paragraph($text, $br = false) {
    $text=trim($text);
    $text = str_replace("\r",'',$text);
    $text = preg_replace('/&([^#])(?![a-z]{1,8};)/', '&amp;$1', $text);
    if ($text=="") return "";
    $text = $text . "\n"; // just to make things a little easier, pad the end
    $text = preg_replace('|<br/>\s*<br/>|', "\n\n", $text);
    $text = preg_replace('!(<(?:table|ul|ol|li|pre|form|blockquote|h[1-6])[^>]*>)!', "\n$1", $text); // Space things out a little
    $text = preg_replace('!(</(?:table|ul|ol|li|pre|form|blockquote|h[1-6])>)!', "$1\n", $text); // Space things out a little
    $text = preg_replace("/(\r\n|\r)/", "\n", $text); // cross-platform newlines 
    $text = preg_replace("/\n\n+/", "\n\n", $text); // take care of duplicates
    $text = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "\t<p>$1</p>\n", $text); // make paragraphs, including one at the end 
    $text = preg_replace('|<p>\s*?</p>|', '', $text); // under certain strange conditions it could create a P of entirely whitespace 
    $text = preg_replace("|<p>(<li.+?)</p>|", "$1", $text); // problem with nested lists
    // blockquote
    $text = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $text);
    $text = str_replace('</blockquote></p>', '</p></blockquote>', $text);
    // now the hard work
    $text = preg_replace('!<p>\s*(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)!', "$1", $text);
    $text = preg_replace('!(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*</p>|</div>"!', "$1", $text); 
    if ($br) $text = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $text); // optionally make line breaks
    $text = preg_replace('!(</?(?:table|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*<br/>!', "$1", $text);
    $text = preg_replace('!<br/>(\s*</?(?:p|li|div|th|pre|td|ul|ol)>)!', '$1', $text);
    // some cleanup
    $text = str_replace('</p><br />','</p>',$text);
    $text = str_replace("<br />\n</p>",'</p>',$text);
    return $text; 
  }

  function encoding($s){
    global $input;
    if (is_callable("iconv"))
      return iconv($input,'utf-8',$s);
    else 
      return $s;
  }
  
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='cs' lang='cs'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>WordPress to Nucleus CMS convertor</title>
<meta http-equiv='Pragma' content='no-cache' />
<meta http-equiv='Cache-Control' content='no-cache, must-revalidate' />
<meta http-equiv='Expires' content='-1' />
<style type="text/css">
body { font-size: 15px; color: #000000; margin: 0; padding: 0; border: 0; font-family: "Trebuchet MS", "Bitstream Vera Sans", verdana, lucida, arial,
helvetica, sans-serif; padding-bottom: 25px; background: #adbeef; }
#content{ width: 600px; margin: 15px auto 0 auto; padding: 0 20px 20px 20px; background: #ffffff; border: 1px solid #314864; border-top:1px solid #233447}
h1{margin:0 -20px 0 -20px;color:#FFF;font-size:x-large;font-weight:bold;background:#336699;padding:15px 0 15px 0; text-align:center }
h2{margin:20px 0 5px 0;color:green;font-size:medium}
h3{margin:20px 0 5px 0;color:red;font-size:medium}
li{margin:5px}
fieldset{padding:10px; text-align:right; margin:0 0 0 0}
a{text-decoration:none;color:blue}
a:hover{text-decoration:underline}
</style>
</head>
<body>
  <div id='content'>
  <h1><small>WordPress &raquo;&raquo;</small> Nucleus CMS <small>&raquo;&raquo; convertor</small></h1>

<?php
  if (!isset($_POST['convert'])) {
?>
  <p>This tool will convert your <a href='http://wordpress.org/'>WordPress blog</a>, into <a href='http://nucleuscms.org'> Nucleus CMS weblog</a>. First, install Nucleus, in a default install, and only after that run this tool. It will transfer all categories, posts, and comments into blog #1.</p>
<?php
  } else {

    $isok=true;
    
    // connect to WordPress database
  	$linkwp = @mysql_connect($_POST['wphost'],$_POST['wpusername'],$_POST['wppassword'],true);
    if($linkwp==false) 
      error("Cannot connect to WordPress DB..");
    else {
  	  @mysql_select_db($_POST['wpdatabase'],$linkwp) or error("Cannot select WordPress DB...");
  	}
	
    // connect to Nucleus CMS database
  	$linkblogcms = @mysql_connect($_POST['blogcmshost'],$_POST['blogcmsusername'],$_POST['blogcmspassword'],true);
    if($linkblogcms==false) 
      error("Cannot connect to Nucleus DB..");
    else {
  	  @mysql_select_db($_POST['blogcmsdatabase'],$linkblogcms) or error("Cannot select Nucleus DB...");
  	}
  	
  	if (!$isok) {
  	  echo "<p>Please correct these errors first!</p><hr />";
    } else {
      /*                 */
      /* transfer data ! */
      /*                 */
      $prefixwp=$_POST['wpprefix'];
      
      /* *********************************************** */
      echo "<h2>Getting encoding...</h2>";
      $query="select option_value from ".$prefixwp."options where option_name='blog_charset'";
      $querywp=mysql_query($query,$linkwp) or die($query);
      if ($row=mysql_fetch_object($querywp)) 
        $input=$row->option_value;
      else
        $input="utf-8";
      echo "<p>Encoding: $input</p>";

      /* *********************************************** */
      echo "<h2>Transfering categories...</h2>";
      mysql_query("delete from ". sql_table('category') . " where cdesc='@wordpress'",$linkblogcms);
      $q = mysql_query("SELECT count(*) as result FROM " . sql_table('category'));
      $total_row = mysql_fetch_object($q);
      $total_num = $total_row->result;
      $catdd = $total_num;
      $total_num++;

      $query="select cat_ID, cat_name from ".$prefixwp."categories order by cat_ID";
      $querywp=mysql_query($query,$linkwp) or die($query);
      echo "<p>rows to transfer: ".mysql_num_rows($querywp)."</p>";
      echo "<p>";
      $i=1;
      while ($row=mysql_fetch_object($querywp)) {
        echo $i++.", ";
        $query=
          "insert into " . sql_table('category') .
          " (catid,cblog,cname,cdesc)  values (".
          intval($total_num).",1,'".encoding($row->cat_name)."','@wordpress')";
        // echo $queryi . "<br/>";
        $result = mysql_query($query,$linkblogcms) or die($query);
        $total_num++;
      }
      echo "</p>";

      /* *********************************************** */
      echo "<h2>Transfering posts and comments...</h2>";
      mysql_query("delete from " . sql_table('comment') . " where chost='@wordpress'",$linkblogcms);
      $query="select ID,post_date,post_content,post_title from ".$prefixwp."posts where post_status='publish' order by ID";
      $querywp=mysql_query($query,$linkwp) or die($query);
      echo "<p>rows to transfer: ".mysql_num_rows($querywp)."</p>";
      echo "<p>";
      $i=1;
      while ($row=mysql_fetch_object($querywp)) {
        echo $i++.", ";
        // category id
        $query="select category_id from ".$prefixwp."post2cat where post_id=".$row->ID;
        $querywp_detail=mysql_query($query,$linkwp) or die($query);
        if ($row_detail=mysql_fetch_object($querywp_detail)) $cat=intval($row_detail->category_id)+$catdd; else $cat=1;
        // insert post
        $query=
          "insert into " . sql_table('item') . " ".
          "(ititle,ibody,iblog,iauthor,itime,icat) values (".
          "'".addslashes(encoding($row->post_title))."','".addslashes(paragraph(encoding(stripslashes($row->post_content)),false))."',1,1,'".$row->post_date."',$cat)";
        //echo $query . "<br/>";
        $result = mysql_query($query,$linkblogcms) or die($query);
        $itemid=mysql_insert_id($linkblogcms);
        // insert comments
        $query="select comment_author,comment_author_email,comment_author_url,comment_author_IP,comment_date,comment_content from ".$prefixwp."comments where comment_post_ID=".$row->ID;
        $querywp_detail=mysql_query($query,$linkwp) or die($query);
        while ($row_detail=mysql_fetch_object($querywp_detail)) {
          $url=$row_detail->comment_author_email;
          if (!empty($row_detail->comment_author_url)) $url=$row_detail->comment_author_url;
          $query=
            "insert into " . sql_table('comment') .
            " (cbody,cuser,cmail,cmember,citem,ctime,cip,cblog,chost) values (".
              "'".addslashes(paragraph(encoding(strip_tags(stripslashes($row_detail->comment_content))),true))."',".
              "'".encoding($row_detail->comment_author)."',".
              "'$url',".
              "0,".
              "$itemid,".
              "'".$row_detail->comment_date."',".
              "'".$row_detail->comment_author_IP."',".
              "1,".
              "'@wordpress')";
          $result = mysql_query($query,$linkblogcms) or die($query);
        }
      }
      echo "</p>";

      // done
      echo "<h2>Done! Enjoy your stay in Nucleus</h2>";
      die;
    }

	}
?>
  <form method='post' action='./wordpress.php'>

    <h2>WordPress (v1.0-1.5.1.3) Database Info</h2>
    <fieldset><legend>WP info</legend>
      <label>Host: <input type='text' name='wphost' size='50' value='<?php def('wphost'); ?>' /></label><br />
      <label>Username: <input type='text' name='wpusername' size='50' value='<?php def('wpusername'); ?>' /></label><br />
      <label>Password: <input type='text' name='wppassword' size='50' value='<?php def('wppassword'); ?>' /></label><br />
      <label>Database Name: <input type='text' name='wpdatabase' size='50' value='<?php def('wpdatabase'); ?>' /></label><br />
      <label>Table Prefix: <input type='text' name='wpprefix' size='50' value='<?php def('wpprefix'); ?>' /></label>
    </fieldset>

    <h2>New Nucleus:CMS Database Info</h2>
    <fieldset><legend>Nucleus:CMS info</legend>
      <label>Host: <input type='text' name='blogcmshost' size='50' value='<?php def('blogcmshost'); ?>' /></label><br />
      <label>Username: <input type='text' name='blogcmsusername' size='50' value='<?php def('blogcmsusername'); ?>' /></label><br />
      <label>Password: <input type='text' name='blogcmspassword' size='50' value='<?php def('blogcmspassword'); ?>' /></label><br />
      <label>Database Name: <input type='text' name='blogcmsdatabase' size='50' value='<?php def('blogcmsdatabase'); ?>' /></label><br />
    </fieldset>
    
    <h2>Submit</h2>
    <fieldset>
      <input type='submit' value='Convert data from WP into Nucleus CMS!' name='convert' />
    </fieldset>

  </form>
  </div>
</body></html>
