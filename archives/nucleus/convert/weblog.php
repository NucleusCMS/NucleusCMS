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
 * This script will import a Blogger blog into a Nucleus blog, using
 * a easy to use wizard.
 *
 * Notes:
 *   - Templates are not converted
 *   - Nucleus should already be installed
 *	 - Members should exist for all teammembers
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2006 The Nucleus Group
 */

include("../../config.php");
include("functions.inc.php");
include($DIR_LIBS . "ADMIN.php");
include($DIR_LIBS . "MEDIA.php");

if (!$member->isLoggedIn()) {
	convert_showLogin('weblog.php');
}

if (!$member->isAdmin()) {
	convert_doError('Only Super-Admins are allowed to perform blog conversions');
}

$ver = convert_getNucleusVersion();
if ($ver > 210)
	convert_doError("You should check the Nucleus website for updates to this convert tool. This one might not work with your current Nucleus installation.");

// include PRAX lib (to read XML files easily)
include ('PRAX.php');

switch($action) {
	case "login": // drop through
	default:
		bc_getBloggerBlogID();
}

// step 1: get the Blogger Blog ID
function bc_getBloggerBlogID() {
	global $HTTP_SERVER_VARS, $PHP_SELF;

	convert_head();

	?>
		<div class="note">
		<em>Thanks to <a href="http://www.gagaweb.com/">Eric Driesen</a> for providing this we::blog template.</em>
		<br :>
		<b>Note:</b> This conversion tool will <b>NOT</b> convert your comments.
		</div>

		<h1>Step 1: Exporting to a file</h1>

		<p>
		The first step in the conversion is to export all your <a href="http://www.danchan.com/weblog">we::blog</a> entries into one single file.
		<br />The full procedure is explained below:
		</p>

		<h2>Exporting</h2>

		<div class="note"><b>Note:</b> If you intend to keep using your weblog afterwards, write down the changes you made, so they can be undone afterwards. For the templates, copy paste the old ones in a textfile.</div>

		<ol>
			<li>
				Change the template of your blog to the following:

				<pre>&lt;!-- Your weblog template --&gt;
&lt;html&gt;
&lt;head&gt;
&lt;title&gt;GaGa WebCam Log&lt;/title&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"&gt;

&lt;!-- ********************************************************************************** --&gt;
&lt;!-- DO NOT REMOVE OR CHANGE ANYTHING BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING --&gt;
&lt;!-- ********************************************************************************** --&gt;
&lt;!--
&lt;weblog&gt;
  translate          {:-)}                {&lt;img src="/weblog/image/emoticon/smiley.gif"&gt;}

  translate_template {[#edit]}           {[IF $edit_link][&lt;a href="[$edit_link]"&gt;edit&lt;/a&gt;][ENDIF]}
  translate_template {[#date_header]}    {[IF $date_header]&lt;p class="commentdateheader"&gt;[$post_day]/[$post_month]/[$post_year]&lt;/p&gt;[ENDIF]}
  translate_template {[#comments_page]}  {[IF $generation]}
  translate_template {[/#comments_page]} {[ENDIF]}
  translate_template {[#main_page]}      {[IF $generation][ELSE]}
  translate_template {[/#main_page]}     {[ENDIF]}
  translate_template {[#messages]}       {[LOOP $messages]}
  translate_template {[/#messages]}      {[ENDLOOP]}
  translate_template {[#archives]}       {[LOOP $archives]}
  translate_template {[/#archives]}      {[ENDLOOP]}
  translate_template {[#hidden_message]}
  {
	[IF $message_status_hide]
	  [IF $is_owner]
		&lt;p class="commenttitle" id="[$message_id]"&gt;&lt;font color="#FF0000" face="tahoma"&gt;::HIDDEN::&lt;/font&gt;
		[IF $comment_link]&lt;a class="navigate" href="[$comment_link]"&gt;[ENDIF][$message_title][IF $comment_link]&lt;/a&gt;[ENDIF]
		[IF $edit_link][&lt;a class="navigate" href="[$edit_link]"&gt;edit&lt;/a&gt;][ENDIF]&lt;/p&gt;
	  [ENDIF]
	[ENDIF]
  }
  translate_template {[#visible_message]}  {[IF $message_status_hide][ELSE]}
  translate_template {[/#visible_message]} {[ENDIF]}
  translate_template {[#post]} {[IF $add_comment_link]&lt;br&gt;&lt;p class="addcomment"&gt;[ &lt;a class="navigate" href="[$add_comment_link]"&gt;[IF $generation]add a comment[ELSE]post a message[ENDIF]&lt;/a&gt; ]&lt;/p&gt;[ENDIF]}
  translate_template {[#comment]}
  {
	[IF $comment_link]
	&lt;a class="navigate" href="[$comment_link]"&gt;&lt;nobr&gt;[$num_comments] comments&lt;/nobr&gt;&lt;/a&gt;
	[ENDIF]
  }
  translate_template {[#post_datetime]} {[$post_month]/[$post_day]/[$post_year] [$post_hour]:[$post_minute] PM}
  translate_template {[#mod_datetime]} {[$mod_month_abbrev] [$mod_day], [$mod_year] at [$mod_hour]:[$mod_minute]}

  share	       { template; }
  generation.0 { comments: yes; show_depth: 1; max_comments: 1000; max_days: 365; sort_comments: new_to_old; sort_days: new_to_old; permissions: owner; }
  generation.1 { comments: yes; show_depth: 1; max_comments: 1000; max_days: 365; sort_comments: new_to_old; sort_days: new_to_old; permissions: all; }
  generation.2 { comments: no; }
  generation.open { comments: yes; show_depth: 16; max_comments: 1000; }
  timezone { +2 }
&lt;/weblog&gt;
--&gt;
&lt;!-- ********************************************************************************** --&gt;
&lt;!-- DO NOT REMOVE OR CHANGE ANYTHING ABOVE THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING --&gt;
&lt;!-- ********************************************************************************** --&gt;

&lt;/head&gt;

&lt;body&gt;
&lt;style type = "text/css"&gt;
	&lt;!--
	  .pagetitle  { font-family: Comic Sans MS; font-size: 10pt; font-weight: bold; color: #000000; margin-top: 0px; margin-bottom: 0px;  margin-left: 0px; margin-right: 0px }
	  .pagebody   { font-family: Comic Sans MS; font-size: 9pt; color: #000000; margin-top: 0px; margin-bottom: 0px;  margin-left: 0px; margin-right: 0px }
	  .pagebyline	{ font-family: Comic Sans MS; font-size: 8pt; color: #666666; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px }

	  .addcomment { font-family: Comic Sans MS; font-size: 8pt; font-weight: bold; color: #000000; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px }

	  .commenttitle  { font-family: Comic Sans MS; font-size: 10pt; font-weight: bold; color: #000000;  margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px }
	  .commentbody   { font-family: Comic Sans MS; font-size: 9pt; color: #000000; margin-top: 0px;  margin-bottom: 0px;   margin-left: 0px; margin-right: 0px }
	  .commentbyline { font-family: Comic Sans MS; font-size: 8pt; color: #666666; margin-top: 0px;  margin-bottom: 10px;  margin-left: 0px; margin-right: 0px }
	  .commentdateheader { font-family: Comic Sans MS; font-size: 8pt; color: #000000; margin-top: 0px; margin-bottom: 0px;   margin-left: 0px; margin-right: 0px }

	  .navigate { font-family: Comic Sans MS; font-size: 8pt; font-weight: bold; color: #000000 }

	  .responseto { font-family: Comic Sans MS; font-size: 8pt; color: #666666; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right:0px }

	  a.navigate:link     { color: rgb(0,102,153); text-decoration : underline; }
	  a.navigate:visited  { color: rgb(0,153,102); text-decoration : underline; }
	  a.navigate:hover    { color: rgb(0,102,102); text-decoration : underline; }
	--&gt;
  &lt;/style&gt;
&lt;!-- the contents of the weblog --&gt;

&lt;!-- main weblog page --&gt;





&lt;?xml version="1.0"?&gt;
[#main_page]
&lt;bloggerblog&gt;


[#messages][#visible_message]
  &lt;blogentry&gt;
   &lt;body&gt;&lt;![CDATA[[$message_body]]]&gt;&lt;/body&gt;
   &lt;title&gt;[$message_title]&lt;/title&gt;
   &lt;date&gt;[$post_month]/[$post_day]/[$post_year] [$post_hour_dd]:[$post_minute]:[$post_second] [$post_time_ap]m&lt;/date&gt;
   &lt;author&gt;[$author_nickname]&lt;/author&gt;
  &lt;/blogentry&gt;

 [/#visible_message]
[/#messages]
&lt;/bloggerblog&gt;
[/#main_page]

&lt;/body&gt;
&lt;/html&gt;</pre>
				Don't forget to save changes!
			</li>
			<li>Save the generated page as <tt>blogger.xml</tt></li>
			<li>Edit <tt>blogger.xml</tt> and remove the header and footer of the file (the file should start with <code>&lt;bloggerblog&gt;</code> and end with <code>&lt;/bloggerblog&gt;</code>)</li>
		</ol>

		<h2>Importing</h2>

		<p>
		Now you have a file called <b>blogger.xml</b>. Upload it in the same directory as the convert files (<tt>/nucleus/convert</tt>) and continue to the next step.
		</p>

		<p>
		<form method="post" action="blogger.php">
		<input type="submit" value="Next Step: Assign Members to Authors" />
		<input type="hidden" name="action" value="assignMembers" />
		</form>
		</p>

		<div class="note">Note: the next steps are the same as for Blogger.com blogs, so don't be surprised to see Blogger.com mentioned.</div>

	<?php
	convert_foot();
}



?>