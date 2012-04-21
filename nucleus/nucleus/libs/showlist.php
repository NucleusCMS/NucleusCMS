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
 * Functions to create lists of things inside the admin are
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */


// can take either an array of objects, or an SQL query
function showlist($query, $type, $template)
{
	if ( is_array($query) )
	{
		if ( sizeof($query) == 0 )
		{
			return 0;
		}
		
		call_user_func("listplug_{$type}", $template, 'HEAD');
		
		foreach ( $query as $currentObj )
		{
			$template['current'] = $currentObj;
			call_user_func("listplug_{$type}", $template, 'BODY');
		}
		
		call_user_func("listplug_{$type}", $template, 'FOOT');
		
		return sizeof($query);
	}
	else
	{
		$res = sql_query($query);
		
		// don't do anything if there are no results
		$numrows = sql_num_rows($res);
		if ( $numrows == 0 )
		{
			return 0;
		}
		call_user_func("listplug_{$type}", $template, 'HEAD');
		
		while( $template['current'] = sql_fetch_object($res) )
		{
			call_user_func("listplug_{$type}", $template, 'BODY');
		}
		
		call_user_func("listplug_{$type}", $template, 'FOOT');
		
		sql_free_result($res);
		
		// return amount of results
		return $numrows;
	}
}

function listplug_select($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<select name="' . ifset($template['name']) . '" tabindex="' . ifset($template['tabindex']) . '" ' . ifset($template['javascript']) . ">\n";
			
			// add extra row if needed
			if ( ifset($template['extra']) )
			{
				echo '<option value="', ifset($template['extraval']), '">', $template['extra'], "</option>\n";
			}
			
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<option value="' . Entity::hsc($current->value) . '"';
			if ( $template['selected'] == $current->value )
			{
				echo ' selected="selected" ';
			}
			if ( isset($template['shorten']) && $template['shorten'] > 0 )
			{
				echo ' title="'. Entity::hsc($current->text).'"';
				$current->text = Entity::hsc(Entity::shorten($current->text, $template['shorten'], $template['shortenel']));
			}
			echo '>' . Entity::hsc($current->text) . "</option>\n";
			break;
		case 'FOOT':
			echo '</select>';
			break;
	}
	return;
}

function listplug_table($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo "\n\n";
			echo "<table frame=\"box\" rules=\"all\" summary=\"{$template['content']}\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			// print head
			call_user_func("listplug_table_{$template['content']}" , $template, 'HEAD');
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tbody>\n";
			break;
		case 'BODY':
			// print tabletype specific thingies
			echo "<tr>\n";
			call_user_func("listplug_table_{$template['content']}" , $template,  'BODY');
			echo "</tr>\n";
			break;
		case 'FOOT':
			call_user_func("listplug_table_{$template['content']}" , $template,  'FOOT');
			echo "</tbody>\n";
			echo "</table>\n";
			echo "\n";
			break;
	}
	return;
}

function listplug_table_memberlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LIST_MEMBER_NAME . "</th>\n";
			echo '<th>' . _LIST_MEMBER_RNAME . "</th>\n";
			echo '<th>' . _LIST_MEMBER_URL . "</th>\n";
			echo '<th>' . _LIST_MEMBER_ADMIN . "</th>\n";
			help('superadmin');
			echo "</th>\n";
			echo '<th>' . _LIST_MEMBER_LOGIN;
			help('canlogin');
			echo "</th>\n";
			echo '<th colspan="2">' . _LISTS_ACTIONS. "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			echo '<td>';
			$id = listplug_nextBatchId();
			echo "<input type=\"checkbox\" id=\"batch{$id}\" name=\"batch[{$id}]\" value=\"{$current->mnumber}\" />\n";
			echo "<label for=\"batch{$id}\">\n";
			echo '<a href="mailto:' . Entity::hsc($current->memail) . '" tabindex="' . $template['tabindex'] . '">' . Entity::hsc($current->mname), "</a>\n";
			echo "</label>\n";
			echo "</td>";
			echo "<td>" . Entity::hsc($current->mrealname) . "</td>\n";
			echo '<td><a href="' . Entity::hsc($current->murl) . '" tabindex="' . $template['tabindex'] . '">' . Entity::hsc($current->murl) . "</a></td>\n";
			echo '<td>' . ($current->madmin ? _YES : _NO) . "</td>\n";
			echo '<td>' . ($current->mcanlogin ? _YES : _NO) . "</td>\n";
			echo '<td><a href="index.php?action=memberedit&amp;memberid=$current->mnumber" tabindex="' . $template['tabindex'] . '">' . _LISTS_EDIT . "</a></td>\n";
			echo '<td><a href="index.php?action=memberdelete&amp;memberid=$current->mnumber" tabindex="' . $template['tabindex'].'">' . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_teamlist($template, $type)
{
	global $manager;
	switch( $type )
	{
		case 'HEAD':
			echo "<th>" . _LIST_MEMBER_NAME . "</th>\n";
			echo "<th>" . _LIST_MEMBER_RNAME . "</th>\n";
			echo "<th>" . _LIST_TEAM_ADMIN . "</th>\n";
			help('teamadmin');
			echo "</th>\n";
			echo "<th colspan=\"2\">"._LISTS_ACTIONS."</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			
			echo '<td>';
			$id = listplug_nextBatchId();
			echo "<input type=\"checkbox\" id=\"batch{$id}\" name=\"batch[{$id}]\" value=\"{$current->tmember}\" />\n";
			echo '<label for="batch',$id,'">';
			echo '<a href="mailto:' . Entity::hsc($current->memail) . '" tabindex="' . $template['tabindex'] . '">' . Entity::hsc($current->mname), "</a>\n";
			echo "</label>\n";
			echo "</td>";
			echo '<td>', Entity::hsc($current->mrealname), "</td>\n";
			echo '<td>', ($current->tadmin ? _YES : _NO) , "</td>\n";
			echo "<td><a href=\"index.php?action=teamdelete&amp;memberid=$current->tmember&amp;blogid={$current->tblog}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_DELETE . "</a></td>\n";
			
			$url = "index.php?action=teamchangeadmin&memberid={$current->tmember}&blogid={$current->tblog}";
			$url = $manager->addTicketToUrl($url);
			echo '<td><a href="' . Entity::hsc($url) . '" tabindex="' . $template['tabindex'] . '">' . _LIST_TEAM_CHADMIN . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_pluginlist($template, $type)
{
	global $manager;
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_INFO . "</th>\n";
			echo '<th>' . _LISTS_DESC . "</th>\n";
			echo '<th>' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			
			$plug =& $manager->getPlugin($current->pfile);
			if ( $plug )
			{
				echo "<td>\n";
				echo '<h3>' . Entity::hsc($plug->getName()) . "</h3>\n";
				
				echo "<dl>\n";
				if ( $plug->getAuthor() )
				{
					echo '<dt>' . _LIST_PLUGS_AUTHOR . "</dt>\n";
					echo '<dd>' . Entity::hsc($plug->getAuthor()) , "</dd>\n";
				}
				
				if ( $plug->getVersion() )
				{
					echo '<dt>' . _LIST_PLUGS_VER, "</dt>\n";
					echo '<dd>' . Entity::hsc($plug->getVersion()) . "</dd>\n";
				}
				
				if ( $plug->getURL() )
				{
					echo '<dt>' . _LIST_PLUGS_SITE . "<dt>\n";
					echo '<dd><a href="' .  Entity::hsc($plug->getURL()) . '" tabindex="' . $template['tabindex'] . '">リンク</a></dd>' . "\n";
				}
				echo "</dl>\n";
				echo "</td>\n";
				
				echo "<td>\n";
				echo "<dl>\n";
				echo '<dt>' . _LIST_PLUGS_DESC ."</dt>\n";
				echo '<dd>' . Entity::hen($plug->getDescription()) ."</dd>\n";
				if ( sizeof($plug->getEventList()) > 0 )
				{
					echo '<dt>' . _LIST_PLUGS_SUBS ."</dt>\n";
					echo '<dd>' . Entity::hsc(implode(', ', $plug->getEventList())) ."</dd>\n";
				}
				
				if ( sizeof($plug->getPluginDep()) > 0 )
				{
					echo '<dt>' . _LIST_PLUGS_DEP ."</dt>\n";
					echo '<dd>' . Entity::hsc(implode(', ', $plug->getPluginDep())) ."</dd>\n";
				}
				
				/* check dependency */
				$req = array();
				$res = sql_query('SELECT pfile FROM ' . sql_table('plugin'));
				while( $o = sql_fetch_object($res) )
				{
					$preq =& $manager->getPlugin($o->pfile);
					if ( $preq )
					{
						$depList = $preq->getPluginDep();
						foreach ( $depList as $depName )
						{
							if ( $current->pfile == $depName )
							{
								$req[] = $o->pfile;
							}
						}
					}
				}
				
				if ( count($req) > 0 )
				{
					echo '<dt>' . _LIST_PLUGS_DEPREQ . "</dt>\n";
					echo '<dd>' . Entity::hsc(implode(', ', $req)) . "</dd>\n";
				}
				
				/* check the database to see if it is up-to-date and notice the user if not */
				if ( !$plug->subscribtionListIsUptodate() )
				{
					echo '<dt>' . 'NOTICE:' . "</dt>\n";
					echo '<dd>' . _LIST_PLUG_SUBS_NEEDUPDATE . "</dd>\n";
				}
				
				echo "</dl>\n";
				echo "</td>\n";
			}
			else
			{
				echo '<td colspan="2">' . sprintf(_PLUGINFILE_COULDNT_BELOADED, Entity::hsc($current->pfile)) . "</td>\n";
			}
			
			echo "<td>\n";
			echo "<ul>\n";
			$current->pid = (integer) $current->pid;
			
			$url = Entity::hsc($manager->addTicketToUrl("index.php?plugid={$current->pid}&action=pluginup"));
			echo "<li><a href=\"{$url}\" tabindex=\"{$template['tabindex']}\">" , _LIST_PLUGS_UP , "</a></li>\n";
			
			$url = Entity::hsc($manager->addTicketToUrl("index.php?plugid={$current->pid}&action=plugindown"));
			echo "<li><a href=\"{$url}\" tabindex=\"{$template['tabindex']}\">" . _LIST_PLUGS_DOWN , "</a></li>\n";
			echo "<li><a href=\"index.php?action=plugindelete&amp;plugid={$current->pid}\" tabindex=\"{$template['tabindex']}\">" . _LIST_PLUGS_UNINSTALL , "</a></li>\n";
			
			if ( $plug && ($plug->hasAdminArea() > 0) )
			{
				echo '<li><a href="' , Entity::hsc($plug->getAdminURL()) , '" tabindex="' , $template['tabindex'] , '">' , _LIST_PLUGS_ADMIN , "</a></li>\n";
			}
			
			if ( $plug && ($plug->supportsFeature('HelpPage') > 0) )
			{
				echo "<li><a href=\"index.php?action=pluginhelp&amp;plugid={$current->pid}\" tabindex=\"{$template['tabindex']}\">" . _LIST_PLUGS_HELP , "</a></li>\n";
			}
			
			$query = "SELECT COUNT(*) AS result FROM %s WHERE ocontext='global' and opid=%s;";
			$query = sprintf($query, sql_table('plugin_option_desc'), (integer) $current->pid);
			if ( quickQuery($query) > 0 )
			{
				echo "<li><a href=\"index.php?action=pluginoptions&amp;plugid={$current->pid}\" tabindex=\"{$template['tabindex']}\">" . _LIST_PLUGS_OPTIONS . "</a></li>\n";
			}
			echo "</ul>\n";
			echo "</td>\n";
			break;
	}
	return;
}

function listplug_table_plugoptionlist($template, $type)
{
	global $manager;
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_INFO . "</th>\n";
			echo '<th>' . _LISTS_VALUE . "</th>\n";
			break;
		case 'BODY':
			listplug_plugOptionRow($template['current']);
			break;
		case 'FOOT':
			echo "<tr>\n";
			echo '<th colspan="2">' . _PLUGS_SAVE . "</th>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td>" . _PLUGS_SAVE . "</td>\n";
			echo "<td><input type=\"submit\" value=\"".  _PLUGS_SAVE . "\" /></td>\n";
			echo "</tr>\n";
			break;
	}
	return;
}

function listplug_plugOptionRow($current)
{
	$varname = "plugoption[{$current['oid']}][{$current['contextid']}]";
	
	// retreive the optionmeta
	$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
	
	// only if it is not a hidden option write the controls to the page
	if ( in_array('access', $meta) && $meta['access'] == 'hidden' )
	{
		return;
	}
	
	if ( !$current['description'] )
	{
		echo '<td>' , Entity::hsc($current['name']) . "</td>\n";
	}
	else
	{
		if ( !defined($current['description']) )
		{
			echo '<td>' , Entity::hsc($current['description']) . "</td>\n";
		}
		else
		{
			echo '<td>' , Entity::hsc(constant($current['description'])) . "</td>\n";
		}
	}
	echo "<td>\n";
	switch($current['type'])
	{
		case 'yesno':
			Admin::input_yesno($varname, $current['value'], 0, 'yes', 'no');
			break;
		case 'password':
			echo '<input type="password" size="40" maxlength="128" name="',Entity::hsc($varname),'" value="',Entity::hsc($current['value']),"\" />\n";
			break;
		case 'select':
			echo '<select name="'.Entity::hsc($varname)."\">\n";
			$options = NucleusPlugin::getOptionSelectValues($current['typeinfo']);
			$options = preg_split('/\|/', $options);
			
			for ( $i=0; $i<(count($options)-1); $i+=2 )
			{
				if ($options[$i+1] == $current['value'])
				{
					echo '<option value="' . Entity::hsc($options[$i+1]) . '" selected="selected">';
				}
				else
				{
					echo '<option value="' . Entity::hsc($options[$i+1]) . '">';
				}
				if ( defined($options[$i]) )
				{
					echo Entity::hsc(constant($options[$i]));
				}
				else
				{
					echo Entity::hsc($options[$i]);
				}
				echo "</option>\n";
			}
			echo "</select>\n";
			
			break;
		case 'textarea':
			//$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
			if ( array_key_exists('access', $meta) && $meta['access'] == 'readonly' )
			{
				echo '<textarea class="pluginoption" cols="30" rows="5" name="' . Entity::hsc($varname) . "\" readonly=\"readonly\">\n";
			}
			else
			{
				echo '<textarea class="pluginoption" cols="30" rows="5" name="' . Entity::hsc($varname) . "\">\n";
			}
			echo Entity::hsc($current['value']) . "\n";
			echo "</textarea>\n";
			break;
		case 'text':
		default:
			//$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
			echo '<input type="text" size="40" maxlength="128" name="',Entity::hsc($varname),'" value="',Entity::hsc($current['value']),'"';
			if ( array_key_exists('datatype', $meta) && $meta['datatype'] == 'numerical' )
			{
				echo ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
			}
			if ( array_key_exists('access', $current) && $meta['access'] == 'readonly')
			{
				echo ' readonly="readonly"';
			}
			echo " />\n";
	}
	if ( array_key_exists('extra', $current) )
	{
		echo $current['extra'];
	}
	echo "</td>\n";
	
	return;
}

function listplug_table_itemlist($template, $type)
{
	$cssclass = '';
	
	switch( $type )
	{
		case 'HEAD':
			echo "<th>"._LIST_ITEM_INFO."</th>\n";
			echo "<th>"._LIST_ITEM_CONTENT."</th>\n";
			echo "<th colspan='1'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];
			// string -> unix timestamp
			$current->itime = strtotime($current->itime);
			
			if ( $current->idraft == 1 )
			{
				$cssclass = " class='draft'";
			}
			
			// (can't use offset time since offsets might vary between blogs)
			if ( $current->itime > $template['now'] )
			{
				$cssclass = " class='future'";
			}
			
			echo "<td{$cssclass}>\n";
			echo "<dl>\n";
			echo '<dt>' . _LIST_ITEM_BLOG . "</dt>\n";
			echo '<dd>' . Entity::hsc($current->bshortname) . "</dd>\n";
			echo '<dt>' . _LIST_ITEM_CAT . "</dt>\n";
			echo '<dd>' . Entity::hsc($current->cname) . "</dd>\n";
			echo '<dt>' . _LIST_ITEM_AUTHOR . "</dt>\n";
			echo '<dd>' . Entity::hsc($current->mname) . "</dd>\n";
			echo '<dt>' . _LIST_ITEM_DATE . "</dt>\n";
			echo '<dd>' . date("Y-m-d",$current->itime) . "</dd>\n";
			echo '<dt>' . _LIST_ITEM_TIME . "</dt>\n";
			echo '<dd>' . date("H:i",$current->itime) . "</dd>\n";
			echo "</dl>\n";
			echo "</td>\n";
			
			$id = listplug_nextBatchId();
			
			echo "<td{$cssclass}>\n";
			echo "<h3>\n";
			echo "<input type=\"checkbox\" id=\"batch{$id}\" name=\"batch[{$id}]\" value=\"{$current->inumber}\" />\n";
			echo "<label for=\"batch{$id}\">" . Entity::hsc(strip_tags($current->ititle)) . "</label>\n";
			echo "</h3>\n";
			
			$current->ibody = strip_tags($current->ibody);
			$current->ibody = Entity::hsc(Entity::shorten($current->ibody, 300, '...'));
			echo "<p>$current->ibody</p>\n";
			echo "</td>\n";
			
			echo "<td{$cssclass}>\n";
			echo "<ul>\n";
			echo "<li><a href=\"index.php?action=itemedit&amp;itemid={$current->inumber}\">" . _LISTS_EDIT . "</a></li>\n";
			
			// evaluate amount of comments for the item
			$COMMENTS = new Comments($current->inumber);
			$camount = $COMMENTS->amountComments();
			if ( $camount > 0 )
			{
				echo "<li><a href=\"index.php?action=itemcommentlist&amp;itemid=$current->inumber\">( ";
				echo sprintf(_LIST_ITEM_COMMENTS, $COMMENTS->amountComments()) . " )</a></li>\n";
			}
			else
			{
				echo '<li>' . _LIST_ITEM_NOCONTENT . "</li>\n";
			}
			
			echo "<li><a href=\"index.php?action=itemmove&amp;itemid={$current->inumber}\">" . _LISTS_MOVE . "</a></li>\n";
			echo "<li><a href=\"index.php?action=itemdelete&amp;itemid={$current->inumber}\">" . _LISTS_DELETE . "</a></li>\n";
			echo "</ul>\n";
			echo "</td>\n";
			break;
	}
	return;
}

// for batch operations: generates the index numbers for checkboxes
function listplug_nextBatchId()
{
	static $id = 0;
	return $id++;
}

function listplug_table_commentlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_INFO . "</th>\n";
			echo '<th>' . _LIST_COMMENT . "</th>\n";
			echo '<th colspan="3">' . _LISTS_ACTIONS . "</th>";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->ctime = strtotime($current->ctime);	// string -> unix timestamp
			
			echo "<td>\n";
			echo "<ul>\n";
			echo '<li>' . date("Y-m-d@H:i",$current->ctime) . "</li>\n";
			if ( isset($current->mname) )
			{
				echo '<li>' . Entity::hsc($current->mname) ,' ', _LIST_COMMENTS_MEMBER . "</li>\n";
			}
			else
			{
				echo '<li>' . Entity::hsc($current->cuser) . "</li>\n";
			}
			if ( isset($current->cmail) && $current->cmail )
			{
				echo '<li>' . Entity::hsc($current->cmail) . "</li>\n";
			}
			if ( isset($current->cemail) && $current->cemail )
			{
				echo '<li>' . Entity::hsc($current->cemail) . "</li>\n";
			}
			echo "</ul>\n";
			echo "</td>\n";

			$id = listplug_nextBatchId();
			
			echo '<td>';
			echo "<input type=\"checkbox\" id=\"batch{$id}\" name=\"batch[{$id}\" value=\"{$current->cnumber}\" />\n";
			echo "<label for=\"batch{$id}\">\n";
			$current->cbody = strip_tags($current->cbody);
			$current->cbody = Entity::hsc(Entity::shorten($current->cbody, 300, '...'));
			echo $current->cbody;
			echo '</label>';
			echo '</td>';
			
			echo '<td><a href="index.php?action=commentedit&amp;commentid=' . $current->cnumber . '">' . _LISTS_EDIT . "</a></td>\n";
			echo '<td><a href="index.php?action=commentdelete&amp;commentid=' . $current->cnumber . '">' . _LISTS_DELETE . "</a></td>\n";
			if ( $template['canAddBan'] )
			{
				echo '<td><a href="index.php?action=banlistnewfromitem&amp;itemid=' . $current->citem . '&amp;ip=' . Entity::hsc($current->cip), '" title="' . Entity::hsc($current->chost) . '">' . _LIST_COMMENT_BANIP . "</a></td>\n";
			}
			break;
	}
	return;
}

function listplug_table_bloglist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _NAME . "</th>\n";
			echo '<th colspan="7">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->bname = Entity::hsc($current->bname);
			
			echo "<td title=\"blogid:{$current->bnumber} shortname:{$current->bshortname}\"><a href=\"{$current->burl}\"><img src=\"images/globe.gif\" width=\"13\" height=\"13\" alt=\"". _BLOGLIST_TT_VISIT."\" /></a>{$current->bname}</td>\n";
			echo "<td><a href=\"index.php?action=createitem&amp;blogid={$current->bnumber}\" title=\"" . _BLOGLIST_TT_ADD ."\">" . _BLOGLIST_ADD . "</a></td>\n";
			echo "<td><a href=\"index.php?action=itemlist&amp;blogid={$current->bnumber}\" title=\"". _BLOGLIST_TT_EDIT."\">". _BLOGLIST_EDIT."</a></td>\n";
			echo "<td><a href=\"index.php?action=blogcommentlist&amp;blogid={$current->bnumber}\" title=\"". _BLOGLIST_TT_COMMENTS."\">". _BLOGLIST_COMMENTS."</a></td>\n";
			echo "<td><a href=\"index.php?action=bookmarklet&amp;blogid={$current->bnumber}\" title=\"". _BLOGLIST_TT_BMLET."\">". _BLOGLIST_BMLET . "</a></td>\n";
			
			if ( $current->tadmin == 1 )
			{
				echo "<td><a href=\"index.php?action=blogsettings&amp;blogid={$current->bnumber}\" title=\"" . _BLOGLIST_TT_SETTINGS . "\">" . _BLOGLIST_SETTINGS . "</a></td>\n";
				echo "<td><a href=\"index.php?action=banlist&amp;blogid={$current->bnumber}\" title=\"" . _BLOGLIST_TT_BANS . "\">" . _BLOGLIST_BANS . "</a></td>\n";
			}
			
			if ( $template['superadmin'] )
			{
				echo "<td><a href=\"index.php?action=deleteblog&amp;blogid={$current->bnumber}\" title=\"". _BLOGLIST_TT_DELETE."\">" ._BLOGLIST_DELETE. "</a></td>\n";
			}
			break;
	}
	return;
}

function listplug_table_shortblognames($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _EBLOG_SHORTNAME . "</th>\n";
			echo '<th>' . _EBLOG_NAME. "</th>";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->bshortname = Entity::hsc($current->bshortname);
			$current->bname = Entity::hsc($current->bname);
			
			echo "<td>{$current->bshortname}</td>\n";
			echo "<td>{$current->bname}</td>\n";
			break;
	}
	return;
}

function listplug_table_shortnames($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _NAME . "</th>\n";
			echo '<th>' . _LISTS_DESC. "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->name = Entity::hsc($current->name);
			$current->description = Entity::hsc($current->description);
			
			echo "<td>{$current->name}</td>\n";
			echo "<td>{$current->description}</td>\n";
			break;
	}
	return;
}


function listplug_table_categorylist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_NAME . "</th>";
			echo '<th>' . _LISTS_DESC."</th>\n";
			echo '<th colspan="2">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$id = listplug_nextBatchId();
			
			$current = $template['current'];
			$current->cname = Entity::hsc($current->cname);
			$current->cdesc = Entity::hsc($current->cdesc);
			
			echo "<td>\n";
			echo "<input type=\"checkbox\" id=\"batch{$id}\" name=\"batch[{$id}]\" value=\"{$current->catid}\" />\n";
			echo "<label for=\"batch{$id}\">{$current->cname}</label>\n";
			echo "</td>\n";
			echo "<td>{$current->cdesc}</td>\n";
			echo "<td><a href=\"index.php?action=categoryedit&amp;blogid={$current->cblog}&amp;catid={$current->catid}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_EDIT . "</a></td>\n";
			echo "<td><a href=\"index.php?action=categorydelete&amp;blogid={$current->cblog}&amp;catid={$current->catid}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_templatelist($template, $type)
{
	global $manager;
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_NAME . "</th>\n";
			echo '<th>' . _LISTS_DESC . "</th>\n";
			echo '<th colspan="3">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->tdnumber = (integer) $current->tdnumber;
			$current->tdname = Entity::hsc($current->tdname);
			$current->tddesc = Entity::hsc($current->tddesc);
			
			$url = "index.php?action=templateclone&templateid={$current->tdnumber}";
			$url = Entity::hsc($manager->addTicketToUrl($url));
			
			echo "<td>{$current->tdname}</td>\n";
			echo "<td>{$current->tddesc}</td>\n";
			echo "<td>\n";
			echo "<a href=\"index.php?action=templateedit&amp;templateid={$current->tdnumber}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_EDIT . "</a>\n";
			echo "</td>\n";
			echo "<td>\n";
			echo "<a href=\"{$url}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_CLONE . "</a>\n";
			echo "</td>\n";
			echo "<td>\n";
			echo "<a href=\"index.php?action=templatedelete&amp;templateid={$current->tdnumber}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_DELETE . "</a>\n";
			echo "</td>\n";
			break;
	}
	return;
}

function listplug_table_skinlist($template, $type)
{
	global $CONF, $DIR_SKINS, $manager;
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_NAME . "</th>\n";
			echo '<th>' . _LISTS_DESC . "</th>\n";
			echo '<th colspan="3">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->sdnumber = (integer) $current->sdnumber;
			$current->sdname = Entity::hsc($current->sdname);
			$current->sdtype = Entity::hsc($current->sdtype);
			
			echo "<td>\n";
			
			// use a special style for the default skin
			if ( $current->sdnumber == $CONF['BaseSkin'] )
			{
				echo '<h3 id="base_skin">' . $current->sdname . "</h3>\n";
			}
			else
			{
				echo '<h3>' . $current->sdname . "</h3>\n";
			}
			
			echo "<dl>\n";
			echo '<dt>' . _LISTS_TYPE . "</dt>\n";
			echo '<dd>' . $current->sdtype . "</dd>\n";
			
			echo '<dt>' . _LIST_SKINS_INCMODE . "</dt>\n";
			
			if ( $current->sdincmode == 'skindir' )
			{
				echo '<dd>' . _PARSER_INCMODE_SKINDIR . "</dd>\n";
			}
			else
			{
				echo '<dd>' . _PARSER_INCMODE_NORMAL . "</dd>\n";
			}
			
			if ( $current->sdincpref )
			{
				echo '<dt>' . _LIST_SKINS_INCPREFIX . "</dt>\n";
				echo '<dd>' . Entity::hsc($current->sdincpref) . "</dd>\n";
			}
			echo "</dl>\n";
			
			// add preview image when present
			if ( $current->sdincpref && @file_exists("{$DIR_SKINS}{$current->sdincpref}preview.png") )
			{
				echo "<p>\n";
				
				$alternatve_text = sprintf(_LIST_SKIN_PREVIEW, $current->sdname);
				$has_enlargement = @file_exists($DIR_SKINS . $current->sdincpref . 'preview-large.png');
				if ( $has_enlargement )
				{
					echo '<a href="',$CONF['SkinsURL'], Entity::hsc($current->sdincpref),'preview-large.png" title="' . _LIST_SKIN_PREVIEW_VIEWLARGER . "\">\n";
					echo '<img class="skinpreview" src="',$CONF['SkinsURL'], Entity::hsc($current->sdincpref),'preview.png" width="100" height="75" alt="' . $alternatve_text . "\" />\n";
					echo "</a><br />\n";
				}
				else
				{
					echo '<img class="skinpreview" src="',$CONF['SkinsURL'], Entity::hsc($current->sdincpref),'preview.png" width="100" height="75" alt="' . $alternatve_text . "\" /><br />\n";
				}
				
				if ( @file_exists("{$DIR_SKINS}{$current->sdincpref}readme.html") )
				{
					$url = $CONF['SkinsURL'] . Entity::hsc($current->sdincpref) . 'readme.html';
					$title = sprintf(_LIST_SKIN_README, $current->sdname);
					echo "<a href=\"{$url}\" title=\"{$title}\">" . _LIST_SKIN_README_TXT . "</a>\n";
				}
				
				echo "</p>\n";
			}
			
			echo "</td>\n";
			
			echo "<td>\n";
			echo '<p>' . Entity::hsc($current->sddesc) . "</p>\n";
			
			/* make list of registered skins */
			$query = "SELECT stype FROM %s WHERE sdesc=%d ORDER BY stype";
			$query = sprintf($query, sql_table('skin'), $current->sdnumber);
			$r = sql_query($query);
			$types = array();
			while ( $o = sql_fetch_object($r) )
			{
				array_push($types, $o->stype);
			}
			
			/* make list of defined skins */
			$skin = new Skin($current->sdnumber);
			$friendlyNames = $skin->getFriendlyNames();
			
			echo _LIST_SKINS_DEFINED;
			echo "<ul>\n";
			foreach ( $types as $type )
			{
				if ( !array_key_exists($type, $friendlyNames) )
				{
					$friendlyName = ucfirst($type);
					$article = 'skinpartspecial';
				}
				else
				{
					$friendlyName = $friendlyNames[$type];
					$article = "skinpart{$type}";
				}
				echo "<li>\n";
				echo helpHtml($article) . "\n";
				echo "<a href=\"index.php?action=skinedittype&amp;skinid={$current->sdnumber}&amp;type={$type}\" tabindex=\"{$template['tabindex']}\">";
				echo Entity::hsc($friendlyName);
				echo "</a>\n";
				echo "</li>\n";
			}
			echo "</ul>\n";
			
			echo "</td>";
			echo "<td>\n";
			echo "<a href=\nindex.php?action=skinedit&amp;skinid={$current->sdnumber}\n tabindex=\n{$template['tabindex']}>" . _LISTS_EDIT . "</a>\n";
			echo "</td>\n";
			
			$url = "index.php?action=skinclone&skinid={$current->sdnumber}";
			$url = Entity::hsc($manager->addTicketToUrl($url));
			echo "<td>\n";
			echo "<a href=\"{$url}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_CLONE . "</a>\n";
			echo "</td>\n";
			echo "<td>\n";
			echo "<a href=\"index.php?action=skindelete&amp;skinid={$current->sdnumber}\" tabindex=\"{$template['tabindex']}\">" . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_draftlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_BLOG . "</th>\n";
			echo '<th>' . _LISTS_TITLE . "</th>\n";
			echo '<th colspan="2">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->bshortname = Entity::hsc($current->bshortname);
			$current->ititle = Entity::hsc(strip_tags($current->ititle));
			
			echo "<td>{$current->bshortname}</td>\n";
			echo "<td>{$current->ititle}</td>\n";
			echo "<td><a href=\"index.php?action=itemedit&amp;itemid={$current->inumber}\">" . _LISTS_EDIT . "</a></td>\n";
			echo "<td><a href=\"index.php?action=itemdelete&amp;itemid={$current->inumber}\">" . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_otherdraftlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_BLOG . "</th>\n";
			echo '<th>' . _LISTS_TITLE . "</th>\n";
			echo '<th>' . _LISTS_AUTHOR . "</th>\n";
			echo '<th colspan="2">' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->bshortname = Entity::hsc($current->bshortname);
			$current->ititle = Entity::hsc(strip_tags($current->ititle));
			$current->mname = Entity::hsc($current->mname);
			
			echo "<td>{$current->bshortname}</td>\n";
			echo "<td>{$current->ititle}</td>\n";
			echo "<td>{$current->mname}</td>\n";
			echo "<td><a href=\"index.php?action=itemedit&amp;itemid={$current->inumber}\">" . _LISTS_EDIT . "</a></td>\n";
			echo "<td><a href=\"index.php?action=itemdelete&amp;itemid={$current->inumber}\">" . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}

function listplug_table_actionlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LISTS_TIME . "</th>\n";
			echo '<th>' . _LIST_ACTION_MSG . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->timestamp = Entity::hsc($current->timestamp);
			$current->message = Entity::hsc($current->message);
			
			echo "<td>{$current->timestamp}</td>\n";
			echo "<td>{$current->message}</td>\n";
			break;
	}
	return;
}

function listplug_table_banlist($template, $type)
{
	switch( $type )
	{
		case 'HEAD':
			echo '<th>' . _LIST_BAN_IPRANGE . "</th>\n";
			echo '<th>' . _LIST_BAN_REASON."</th>\n";
			echo '<th>' . _LISTS_ACTIONS . "</th>\n";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->blogid = (integer) $current->blogid;
			$current->iprange = Entity::hsc($current->iprange);
			$current->reason = Entity::hsc($current->reason);
			
			echo "<td>{$current->iprange}</td>\n";
			echo "<td>{$current->reason}</td>\n";
			echo "<td><a href=\"index.php?action=banlistdelete&amp;blogid=\"{$current->blogid}&amp;iprange=\"Entity::hsc($current->iprange}\">" . _LISTS_DELETE . "</a></td>\n";
			break;
	}
	return;
}
