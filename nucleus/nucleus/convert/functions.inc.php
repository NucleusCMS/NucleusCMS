<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  */

	// make sure the request variables get reqistered in the global scope
	// Doing this should be avoided on code rewrite (this is a potential security risk)
	if ((phpversion() >= "4.1.0") && (ini_get("register_globals") == 0)) {
		import_request_variables("gp",'');
	}

	/** this function gets the nucleus version, even if the getNucleusVersion
	 * function does not exist yet
	 * return 96 for all versions < 100
	 */
	function convert_getNucleusVersion() {
		if (!function_exists('getNucleusVersion')) return 96;
		return getNucleusVersion();
	}


	function convert_addToItem($title, $body, $more, $blogid, $authorid, $timestamp, $closed, $category, $karmapos, $karmaneg) {
		$title = trim(addslashes($title));
		$body = trim(addslashes($body));
		$more = trim(addslashes($more));
				
		$query = 'INSERT INTO '.sql_table('item').' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IKARMAPOS, IKARMANEG, ICAT) '
		       . "VALUES ('$title', '$body', '$more', $blogid, $authorid, '$timestamp', $closed, $karmapos, $karmaneg,  $category)";
		       
		mysql_query($query) or die("Error while executing query: " . $query);		       		       
		
		return mysql_insert_id();
	}
	
	function convert_addToBlog($name, $shortname, $ownerid) {
		$name = addslashes($name);
		$shortname = addslashes($shortname);
		
		// create new category first
		mysql_query('INSERT INTO '.sql_table('category')." (CNAME, CDESC) VALUES ('General','Items that do not fit in another categort')");
		$defcat = mysql_insert_id();

		$query = 'INSERT INTO '.sql_table('blog')." (BNAME, BSHORTNAME, BCOMMENTS, BMAXCOMMENTS, BDEFCAT) VALUES ('$name','$shortname',1 ,0, $defcat)";
		mysql_query($query) or die("Error while executing query: " . $query);
		$id = mysql_insert_id();
		
		convert_addToTeam($id,$ownerid,1);
	
		
		return $id;
	}
	
	function convert_addToComments($name, $url, $body, $blogid, $itemid, $memberid, $timestamp, $host) {
		$name = addslashes($name);
		$url = addslashes($url);
		$body = trim(addslashes($body));
		$host = addslashes($host);
		
		$query = 'INSERT INTO '.sql_table('comment')
			   . ' (CUSER, CMAIL, CMEMBER, CBODY, CITEM, CTIME, CHOST, CBLOG) '
		       . "VALUES ('$name', '$url', $memberid, '$body', $itemid, '$timestamp', '$host', $blogid)";

		mysql_query($query) or die("Error while executing query: " . $query);
		
		return mysql_insert_id();		       
	}
	
	function convert_addToTeam($blogid, $memberid, $admin) {
	
		$query = 'INSERT INTO '.sql_table('team').' (TMEMBER, TBLOG, TADMIN) '
		       . "VALUES ($memberid, $blogid, $admin)";

		mysql_query($query) or die("Error while executing query: " . $query);
		
		return mysql_insert_id();		       
	}	
	
	function convert_showLogin($type) {
		convert_head();
	?>
		<h1>Please Log in First</h1>
		<p>Enter your data below:</p>
		
		<form method="post" action="<?php echo $type?>">

			<ul>
				<li>Name: <input name="login" /></li>
				<li>Password <input name="password" type="password" /></li>
			</ul>

			<p>
				<input name="action" value="login" type="hidden" />
				<input type="submit" value="Log in" />
			</p>
		
		</form>
	<?php		convert_foot();
		exit;
	}
	
	function convert_head() {
	?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html>
		<head>
			<title>Nucleus Convert</title>
			<style><!--
				@import url('../styles/manual.css');
			--></style>
		</head>
		<body>		
	<?php	}

	function convert_foot() {
	?>
		</body>
		</html>	
	<?php	}	
	
	function convert_doError($msg) {
		convert_head();
		?>
		<h1>Error!</h1>

		<p>Message was:</p>
		
		<blockquote><div>
		<?php echo $msg?>
		</div></blockquote>

		<p><a href="index.php" onclick="history.back();">Go Back</a></p>
		<?php
		convert_foot();
		exit;
	}
	
	function endsWithSlash($s) {
		return (strrpos($s,'/') == strlen($s) - 1);
	}	
	

?>