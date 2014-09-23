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
function showlist($query, $type, $vars, $template_name = '')
{
	$contents = '';
	
	/* count */
	if ( is_string($query) )
	{
		$resource = DB::getResult($query);
	}
	else
	{
		$resource = $query;
	}
	
	/* HEAD */
	$contents .= call_user_func("listplug_{$type}", $vars, 'HEAD', $template_name);
	
	/* BODY */
	foreach ( $resource as $row )
	{
		$vars['current'] = $row;
		$contents .= call_user_func("listplug_{$type}", $vars, 'BODY', $template_name);
	}
	
	/* FOOT */
	$contents .= call_user_func("listplug_{$type}", $vars, 'FOOT', $template_name);
	
	/* close SQL resource */
	if ( is_string($query) )
	{
		$resource->closeCursor();
	}
	
	return $contents;
}

function listplug_select($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_SELECT_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_SELECT_HEAD']) )
			{
				$template = '<select name="<%name%>" tabindex="<%tabindex%>" <%javascript%>>'."\n"
				          . "<%extraoption%>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_SELECT_HEAD'];
			}
			$data = array(
				'name'			=> $vars['name'],
				'tabindex'		=> $vars['tabindex'],
				'javascript'	=> !array_key_exists('javascript', $vars) ? '' : $vars['javascript'],
				'extraoption'	=> !array_key_exists('extra', $vars) ? '' : "<option value=\"\">{$vars['extra']}</option>"
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_SELECT_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_SELECT_BODY']) )
			{
				$template = '<option value="<%value%>" <%selected%> title="<%title%>"><%option%></option>'."\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_SELECT_BODY'];
			}
			$data = array(
				'value'		=> Entity::hsc($current['value']),
				'selected'	=> ($vars['selected'] == $current['value']) ? 'selected="selected"' : '',
			);
			if ( array_key_exists('shorten', $vars) && $vars['shorten'] > 0 )
			{
				$data['title'] = Entity::hsc($current['text']);
				$data['option'] = Entity::hsc(Entity::shorten($current['text'], $vars['shorten'], $vars['shortenel']));
			}
			else
			{
				$data['title'] = '';
			}
			$data['option'] = Entity::hsc($current['text']);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_SELECT_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_SELECT_FOOT']) )
			{
				$template = "</select>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_SELECT_FOOT'];
			}
			$data = array();
			break;
	}
	
	return Template::fill($template, $data);
}

function listplug_table($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_HEAD']) )
			{
				$template = "<table frame=\"box\" rules=\"all\" summary=\"{$vars['content']}\">\n"
				          . "<thead>\n"
				          . "<tr>\n"
				          . "<%typehead%>\n"
				          . "</tr>\n"
				          . "</thead>\n"
				          . "<tbody>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_HEAD'];
			}
			$data = array(
				'summary'	=>	$vars['content'],
				'typehead' => call_user_func("listplug_table_" . $vars['content'] , $vars, 'HEAD', $template_name)
			);
			break;
		case 'BODY':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BODY']) )
			{
				$template = '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);">'."\n"
				          . "<%typebody%>\n"
				          . "</tr>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BODY'];
			}
			// tabletype specific thingies
			$data = array(
				'typebody' => call_user_func("listplug_table_" . $vars['content'] , $vars, 'BODY', $template_name)
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_FOOT']) )
			{
				$template = "<%typefoot%>\n"
				          . "</tbody>\n"
				          . "</table>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_FOOT'];
			}
			// tabletype specific thingies
			$data = array(
				'typefoot' => call_user_func("listplug_table_" . $vars['content'] , $vars, 'FOOT', $template_name)
			);
			break;
	}
	
	return Template::fill($template, $data);
}

function listplug_table_memberlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_HEAD']) )
			{
				$template = "<th><%colmembername%></th>\n"
				          . "<th><%colmemberrname%></th>\n"
				          . "<th><%colmemberurl%></th>\n"
				          . "<th><%colmemberadmin%><%helplink(superadmin)%></th>\n"
				          . "<th><%colmemberlogin%><%helplink(canlogin)%></th>\n"
				          . '<th colspan="2"><%colactions%></th>'."\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_HEAD'];
			}
			$data = array(
				'colmembername'		=> _LIST_MEMBER_NAME,
				'colmemberrname'	=> _LIST_MEMBER_RNAME,
				'colmemberurl'		=> _LIST_MEMBER_URL,
				'colmemberadmin'	=> _LIST_MEMBER_ADMIN,
				'colmemberlogin'	=> _LIST_MEMBER_LOGIN,
				'colactions'		=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_BODY']) )
			{
				$template = "<td>\n"
				          . '<input type="checkbox" id="batch<%id%>" name="batch[<%id%>]" value="<%memberid%>" />'."\n"
				          . '<label for="batch<%id%>">'."\n"
				          . '<a href="mailto:<%mailaddress%>" tabindex="<%tabindex%>"><%name%></a>'."\n"
				          . "</label>\n</td>\n"
				          . "<td><%realname%></td>\n"
				          . '<td><a href="<%url%>" tabindex="<%tabindex%>"><%url%></a></td>'."\n"
				          . "<td><%admin%></td>\n"
				          . "<td><%login%></td>\n"
				          . '<td><a href="index.php?action=memberedit&amp;memberid=<%memberid%>" tabindex="<%tabindex%>"><%editbtn%></a></td>'."\n"
				          . '<td><a href="index.php?action=memberdelete&amp;memberid=<%memberid%>" tabindex="<%tabindex%>"><%deletebtn%></a></td>'."\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_BODY'];
			}
			$data = array(
				'id'			=> listplug_nextBatchId(),
				'memberid'		=> $current['mnumber'],
				'mailaddress'	=> Entity::hsc($current['memail']),
				'tabindex'		=> $vars['tabindex'],
				'name'			=> Entity::hsc($current['mname']),
				'realname'		=> Entity::hsc($current['mrealname']),
				'url'			=> Entity::hsc($current['murl']),
				'admin'			=> $current['madmin'] ? _YES : _NO,
				'login'			=> $current['mcanlogin'] ? _YES : _NO,
				'editbtn'		=> _LISTS_EDIT,
				'deletebtn'		=> _LISTS_DELETE,
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_MEMBLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_FOOT']) )
			{
				$template = "";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_MEMBLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_teamlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_HEAD']) )
			{
				$template = "<th><%colmembername%></th>\n"
				          . "<th><%colmemberrname%></th>\n"
				          . "<th><%colteamadmin%><%helplink(teamadmin)%></th>\n"
				          . '<th colspan="2"><%colactions%></th>'."\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_HEAD'];
			}
			$data = array(
				'colmembername'		=> _LIST_MEMBER_NAME,
				'colmemberrname'	=> _LIST_MEMBER_RNAME,
				'colteamadmin'		=> _LIST_TEAM_ADMIN,
				'colactions'		=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_BODY']) )
			{
				$template = "<td>\n"
				          . "<input type=\"checkbox\" id=\"batch<%id%>\" name=\"batch[<%id%>]\" value=\"<%memberid%>\" />\n"
				          . "<label for=\"batch<%id%>\">\n"
				          . "<a href=\"mailto:<%mailaddress%>\" tabindex=\"<%tabindex%>\"><%name%></a>\n"
				          . "</label>\n</td>\n"
				          . "<td><%realname%></td>\n"
				          . "<td><%admin%></td>\n"
				          . "<td><a href=\"index.php?action=teamdelete&amp;memberid=<%memberid%>&amp;blogid=<%blogid%>\" tabindex=\"<%tabindex%>\"><%deletebtn%></a></td>\n"
				          . "<td><a href=\"<%chadminurl%>\" tabindex=\"<%tabindex%>\"><%chadminbtn%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_BODY'];
			}
			$url  = 'index.php?action=teamchangeadmin&memberid=' . intval($current['tmember']) . '&blogid=' . intval($current['tblog']);
			$url  = $manager->addTicketToUrl($url);
			$data = array(
					'id'			=> listplug_nextBatchId(),
					'memberid'		=> $current['tmember'],
					'mailaddress'	=> Entity::hsc($current['memail']),
					'tabindex'		=> $vars['tabindex'],
					'name'			=> Entity::hsc($current['mname']),
					'realname'		=> Entity::hsc($current['mrealname']),
					'admin'			=> ($current['tadmin'] ? _YES : _NO),
					'blogid'		=> $current['tblog'],
					'deletebtn'		=> '<%text(_LISTS_DELETE)%>',
					'chadminurl'	=> Entity::hsc($url),
					'chadminbtn'	=> '<%text(_LIST_TEAM_CHADMIN)%>'
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TEAMLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_FOOT']) )
			{
				$template = "";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TEAMLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_pluginlist($vars, $type, $template_name = '')
{
	static $plugins = array();
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HEAD']) )
			{
				$template = "<th><%colinfo%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th colspan=\"2\"><%colactions%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HEAD'];
			}
			$data = array(
				'colinfo'    => _LISTS_INFO,
				'coldesc'    => _LISTS_DESC,
				'colactions' => _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			
			$plug =& $manager->getPlugin($current['pfile']);
			if ( $plug )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_BODY']) )
				{
					$template = "<td>\n"
					          . "<strong><%plugname%></strong><br />\n"
					          . "<%autherlabel%> <%plugauther%><br />\n"
					          . "<%versionlabel%> <%plugversion%><br />\n"
					          . "<%pluggeturl%><br />\n"
					          . "</td>\n"
					          . "<td>\n"
					          . "<%desclabel%><br /><%plugdesc%>\n"
					          . "<%eventlist%>\n"
					          . "<%needupdate%>\n"
					          . "<%dependlist%>\n"
					          . "<%depreqlist%>\n"
					          . "</td>\n";
				}
				else
				{
					$template = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_BODY'];
				}
				$data = array(
					'plugname'		=> Entity::hsc($plug->getName()),
					'autherlabel'	=> _LIST_PLUGS_AUTHOR,
					'plugauther'	=> Entity::hsc($plug->getAuthor()),
					'versionlabel'	=> _LIST_PLUGS_VER,
					'plugversion'	=> Entity::hsc($plug->getVersion()),
					'tabindex'		=> $vars['tabindex'],
					'desclabel'		=> _LIST_PLUGS_DESC,
					'plugdesc'		=> Entity::hen($plug->getDescription()),
				);
				if ( $plug->getURL() )
				{
					if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_GURL', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_GURL']) )
					{
						$subTpl = "<a href=\"<%plugurl%>\" tabindex=\"<%tabindex%>\"><%plugsite%></a>";
					}
					else
					{
						$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_GURL'];
					}
					$subData = array(
						'plugurl'	=> Entity::hsc($plug->getURL()),
						'tabindex'	=> $vars['tabindex'],
						'plugsite'	=> _LIST_PLUGS_SITE,
					);
					$data['pluggeturl'] = Template::fill($subTpl, $subData);
				}
				else
				{
					$data['pluggeturl'] = '';
				}
				if ( count($plug->getEventList()) > 0 )
				{
					if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGEVENTLIST', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGEVENTLIST']) )
					{
						$subTpl = "<br /><br /><%evntlstlbl%><br /><%eventlist%>";
					}
					else
					{
						$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGEVENTLIST'];
					}
					$subData = array(
						'evntlstlbl'	=> _LIST_PLUGS_SUBS,
						'eventlist'		=> Entity::hsc(implode(', ', $plug->getEventList())),
					);
					$data['eventlist'] = Template::fill($subTpl, $subData);
				}
				else
				{
					$data['eventlist'] = '';
				}
				if ( !$plug->subscribtionListIsUptodate() )
				{
					if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGNEDUPDATE', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGNEDUPDATE']) )
					{
						$subTpl = "<br /><br /><strong><%updatealert%></strong>";
					}
					else
					{
						$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGNEDUPDATE'];
					}
					$subData = array(
						'updatealert' => _LIST_PLUG_SUBS_NEEDUPDATE,
					);
					$data['needupdate'] = Template::fill($subTpl, $subData);
				}
				else
				{
					$data['needupdate'] = '';
				}
				if ( count($plug->getPluginDep() ) > 0)
				{
					if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPEND', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPEND']) )
					{
						$subTpl = "<br /><br /><%deplistlbl%><br /><%dependlist%>";
					}
					else
					{
						$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPEND'];
					}
					$subData = array(
						'deplistlbl' => _LIST_PLUGS_DEP,
						'dependlist' => Entity::hsc(implode(', ', $plug->getPluginDep())),
					);
					$data['dependlist'] = Template::fill($subTpl, $subData);
				}
				else
				{
					$data['dependlist'] = '';
				}
				/* check dependency */
				if ( empty($plugins) )
				{
					$plugins = DB::getResult('SELECT pfile FROM ' . sql_table('plugin'));
				}
				$req = array();
				foreach ( $plugins as $plugin )
				{
					$preq =& $manager->getPlugin($plugin['pfile']);
					if ( $preq )
					{
						$depList = $preq->getPluginDep();
						foreach ( $depList as $depName )
						{
							if ( $current['pfile'] == $depName )
							{
								$req[] = $plugin['pfile'];
							}
						}
					}
				}
				
				if ( count($req) > 0 )
				{
					if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPREQ', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPREQ']) )
					{
						$subTpl = "<br /><br /><%deprlstlbl%><br /><%depreqlist%>";
					}
					else
					{
						$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGIN_DEPREQ'];
					}
					$subData = array(
						'deprlstlbl' => _LIST_PLUGS_DEPREQ,
						'depreqlist' => Entity::hsc(implode(', ', $req)),
					);
					$data['depreqlist'] = Template::fill($subTpl, $subData);
				}
				else
				{
					$data['depreqlist'] = '';
				}
			}
			else
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLISTFALSE', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLISTFALSE']) )
				{
					$template = "<td colspan=\"2\"><%noplugalert%></td>\n";
				}
				else
				{
					$template = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLISTFALSE'];
				}
				$data = array(
					'noplugalert' => sprintf(_PLUGINFILE_COULDNT_BELOADED, Entity::hsc($current['pfile'])),
				);
			}
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ACTN', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ACTN']) )
			{
				$template .= "<td>\n"
				           . "<a href=\"<%actionupurl%>\" tabindex=\"<%tabindex%>\"><%actionuptxt%></a><br />\n"
				           . "<a href=\"<%actiondownurl%>\" tabindex=\"<%tabindex%>\"><%actiondowntxt%></a><br />\n"
				           . "<a href=\"<%actuninsturl%>\" tabindex=\"<%tabindex%>\"><%actuninsttxt%></a><br />"
				           . "<%plugadminurl%>\n"
				           . "<%plughelpurl%>\n"
				           . "<%plugoptsetting%>\n"
				           . "</td>\n";
			}
			else
			{
				$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ACTN'];
			}
			
			$baseUrl	= 'index.php?plugid=' . $current['pid'] . '&action=';
			$upUrl		= $manager->addTicketToUrl($baseUrl . 'pluginup');
			$downUrl	= $manager->addTicketToUrl($baseUrl . 'plugindown');
			
			$data['actionuptxt']	= _LIST_PLUGS_UP;
			$data['actionupurl']	= Entity::hsc($upUrl);
			$data['actiondowntxt']	= _LIST_PLUGS_DOWN;
			$data['actiondownurl']	= Entity::hsc($downUrl);
			$data['actuninsttxt']	= _LIST_PLUGS_UNINSTALL;
			$data['actuninsturl']	= 'index.php?action=plugindelete&amp;plugid=' . $current['pid'];
			
			if ( $plug && ($plug->hasAdminArea() > 0) )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ADMN', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ADMN']) )
				{
					$subTpl = "<a href=\"<%actadminurl%>\" tabindex=\"<%tabindex%>\"><%actadmintxt%></a><br />\n";
				}
				else
				{
					$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_ADMN'];
				}
				$subData = array(
					'actadminurl'	=> Entity::hsc($plug->getAdminURL()),
					'tabindex'		=> $vars['tabindex'],
					'actadmintxt'	=> _LIST_PLUGS_ADMIN,
				);
				$data['plugadminurl'] = Template::fill($subTpl, $subData);
			}
			else
			{
				$data['plugadminurl'] = '';
			}
			if ( $plug && ($plug->supportsFeature('HelpPage') > 0) )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HELP', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HELP']) )
				{
					$subTpl = "<a href=\"<%acthelpurl%>\" tabindex=\"<%tabindex%>\"><%acthelptxt%></a><br />\n";
				}
				else
				{
					$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_HELP'];
				}
				$subData = array(
					'acthelpurl'	=> 'index.php?action=pluginhelp&amp;plugid=' . $current['pid'],
					'tabindex'		=> $vars['tabindex'],
					'acthelptxt'	=> _LIST_PLUGS_HELP,
				);
				$data['plughelpurl'] = Template::fill($subTpl, $subData);
			}
			else
			{
				$data['plughelpurl'] = '';
			}
			$optQuery = 'SELECT '
			          . '    COUNT(*) AS result '
			          . 'FROM '
			          .      sql_table('plugin_option_desc') . ' '
			          . 'WHERE '
			          . '    ocontext = "global" '
			          . 'AND opid     = %d';
			$pOptions = DB::getValue(sprintf($optQuery, $current['pid']));
			if ( $pOptions > 0 )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGOPTSETURL', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGOPTSETURL']) )
				{
					$subTpl = "<a href=\"<%actoptionurl%>\" tabindex=\"<%tabindex%>\"><%actoptiontxt%></a>\n";
				}
				else
				{
					$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGOPTSETURL'];
				}
				$subData = array(
					'actoptionurl'	=> 'index.php?action=pluginoptions&amp;plugid=' . $current['pid'],
					'tabindex'		=> $vars['tabindex'],
					'actoptiontxt'	=> _LIST_PLUGS_OPTIONS,
				);
				$data['plugoptsetting'] = Template::fill($subTpl, $subData);
			}
			else
			{
				$data['plugoptsetting'] = '';
			}
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_FOOT']) )
			{
				$template = "";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_PLUGLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_plugoptionlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_POPTLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_HEAD']) )
			{
				$template = "<th><%colinfo%></th>\n"
				          . "<th><%colvalue%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_HEAD'];
			}
			$data = array(
				'colinfo'	=> _LISTS_INFO,
				'colvalue'	=> _LISTS_VALUE,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			$template = listplug_plugOptionRow($current, $template_name);
			$data = array();
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_POPTLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_FOOT']) )
			{
				$template = "<tr>\n"
				          . "<th colspan=\"2\"><%savetext%></th>\n"
				          . "</tr>\n"
				          . "<tr>\n"
				          . "<td><%savetext%></td>\n"
				          . "<td><input type=\"submit\" value=\"<%savetext%>\" /></td>\n"
				          . "</tr>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_FOOT'];
			}
			$data = array(
				'savetext' => _PLUGS_SAVE,
			);
			break;
	}
	
	return Template::fill($template, $data);
}

function listplug_plugOptionRow($current, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	$varname = "plugoption[{$current['oid']}][{$current['contextid']}]";
	
	// retreive the optionmeta
	$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
	
	// only if it is not a hidden option write the controls to the page
	if ( in_array('access', $meta) && $meta['access'] == 'hidden' )
	{
		return false;
	}
	else
	{
		if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_POPTLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_BODY']) )
		{
			$template = "<td><%description%></td>\n"
			          . "<td>\n";
		}
		else
		{
			$template = $templates['SHOWLIST_LISTPLUG_TABLE_POPTLIST_BODY'];
		}
		
		$data = array();
		
		switch($current['type'])
		{
			case 'yesno':
				$template .= listplug_input_yesno($varname, $current['value'], 0, 'yes', 'no', _YES, _NO, 0, $template_name, 1);
				break;
			case 'password':
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OPWORD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OPWORD']) )
				{
					$template .= '<input type="password" size="40" maxlength="128" name="<%varname%>" value="<%value%>" />' . "\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OPWORD'];
				}
				$data = array(
					'varname'	=> Entity::hsc($varname),
					'value'		=> Entity::hsc($current['value']),
				);
				break;
			case 'select':
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEP', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEP']) )
				{
					$template .= '<select name="<%varname%>">' . "\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEP'];
				}
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEO', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEO']) )
				{
					$subTpl = '<option value="<%value%>"<%selected%>><%optname%></option>' . "\n";
				}
				else
				{
					$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEO'];
				}
				$options = NucleusPlugin::getOptionSelectValues($current['typeinfo']);
				$options = preg_split('#\|#', $options);
				
				for ( $i=0; $i<(count($options)-1); $i+=2 )
				{
					$name	= $options[$i];
					$value	= $options[$i+1];
					if ( defined($name) )
					{
						$name = constant($name);
					}
					
					$subData = array(
						'optname'	=> Entity::hsc($name),
						'value'		=> Entity::hsc($value)
					);
					if ($value != $current['value'])
					{
						$subData['selected'] = '';
					}
					else
					{
						$subData['selected'] = ' selected="selected"';
					}
					$template .= Template::fill($subTpl, $subData);
				}
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEC', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEC']) )
				{
					$template .= "</select>\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OSELEC'];
				}
				$data['varname'] = Entity::hsc($varname);
				break;
			case 'textarea':
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OTAREA', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OTAREA']) )
				{
					$template .= '<textarea class="pluginoption" cols="30" rows="5" name="<%varname%>"<%readonly%>><%value%></textarea>' . "\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OTAREA'];
				}
				$data = array(
					'varname'	=> Entity::hsc($varname),
					'value'		=> Entity::hsc($current['value'])
				);
				if ( !array_key_exists('access', $current) || $current['access'] != 'readonly')
				{
					$data['readonly'] = '';
				}
				else
				{
					$data['readonly'] = ' readonly="readonly"';
				}
				break;
			case 'text':
			default:
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OITEXT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OITEXT']) )
				{
					$template .= '<input type="text" size="40" maxlength="128" name="<%varname%>" value="<%value%>"<%datatype%><%readonly%> />'."\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OITEXT'];
				}
				$data = array(
					'varname'	=> Entity::hsc($varname),
					'value'		=> Entity::hsc($current['value'])
				);
				if ( !array_key_exists('datatype', $current) || $current['datatype'] != 'numerical')
				{
					$data['datatype'] = '';
				}
				else
				{
					$data['datatype'] = ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
				}
				if ( !array_key_exists('access', $current) || $current['access'] != 'readonly')
				{
					$data['readonly'] = '';
				}
				else
				{
					$data['readonly'] = ' readonly="readonly"';
				}
		}
		
		if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLUGOPTN_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_PLUGOPTN_FOOT']) )
		{
			$template .= "<%extra%></td>\n";
		}
		else
		{
			$template .= $templates['SHOWLIST_LISTPLUG_TABLE_PLUGOPTN_FOOT'];
		}
		
		if ( !array_key_exists('extra', $current) )
		{
			$data['extra'] = '';
		}
		else
		{
			$data['extra'] = Entity::hsc($current['extra']);
		}
		
		if ( !array_key_exists('description', $current) )
		{
			$data['description'] = Entity::hsc($current['name']);
		}
		else if ( !defined($current['description']) )
		{
			$data['description'] = Entity::hsc($current['description']);
		}
		else
		{
			$data['description'] = Entity::hsc(constant($current['description']));
		}
	}
	return Template::fill($template, $data, 1);
}

/**
 * listplug_templateEditRow()
 * 
 * @param	array	$content		content of target template
 * @param	string	$desc			description of target template
 * @param	string	$name			name of target template
 * @param	string	$help			help text
 * @param	integer	$tabindex		a number for tab index
 * @param	boolean	$big			large or small textarea
 * @param	array	$template_name	name of template for filling
 * @return	void
 */
function listplug_templateEditRow($content, $desc, $name, $help = '', $tabindex = 0, $big = 0, $template_name = '')
{
	global $manager;
	
	static $count = 0;
	
	$tmplt = array();
	$base  = array();
	
	$templates = array();
	if ( $template_name )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	$data = array(
		'description'	=> $desc,
		'help'			=> empty($help) ? '' : helpHtml('template' . $help),
		'count'			=> $count++,
		'name'			=> $name,
		'tabindex'		=> $tabindex,
		'rows'			=> $big ? 10 : 5,
	);
	
	$message = '';
	
	/* row head */
	if ( !array_key_exists('TEMPLATE_EDIT_ROW_HEAD', $templates) || empty($tmplt['TEMPLATE_EDIT_ROW_HEAD']) )
	{
		$template = "<tr>\n"
		          . "<td><%description%><%help%></td>\n"
		          . '<td id="td<%count%>">'."\n"
		          . '<textarea class="templateedit" name="<%name%>" tabindex="<%tabindex%>" cols="50" rows="<%rows%>" id="textarea<%count%>">';
	}
	else
	{
		$template = $tmplt['TEMPLATE_EDIT_ROW_HEAD'];
	}
	$message .= TEMPLATE::fill($template, $data);
	
	/* row content */
	$message .= ENTITY::hsc($content);
	
	/* row tail */
	if ( !array_key_exists('TEMPLATE_EDIT_ROW_TAIL', $templates) || empty($tmplt['TEMPLATE_EDIT_ROW_TAIL']) )
	{
		$template = "</textarea>\n"
		          . "</td>\n"
		          . "</tr>\n";
	}
	else
	{
		$template = $tmplt['TEMPLATE_EDIT_ROW_TAIL'];
	}
	$message .= TEMPLATE::fill($template, $data);
	
	return $message;
}

function listplug_table_itemlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$cssclass  = '';
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_HEAD']) )
			{
				$template = "<th><%colinfo%></th>\n"
				          . "<th><%colcontent%></th>\n"
				          . '<th style="white-space:nowrap"><%colaction%></th>'."\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_HEAD'];
			}
			$data = array(
				'colinfo'		=> _LIST_ITEM_INFO,
				'colcontent'	=> _LIST_ITEM_CONTENT,
				'colaction'		=> _LISTS_ACTIONS
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			// string -> unix timestamp
			$current['itime'] = strtotime($current['itime']);
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_BODY']) )
			{
				$template = "<td<%cssclass%>>\n"
				          . "<%bshortlabel%> <%bshortnameval%><br />\n"
				          . "<%categorylabel%> <%categorynameval%><br />\n"
				          . "<%authorlabel%> <%authornameval%><br />\n"
				          . "<%itemdatelabel%> <%itemdateval%><br />\n"
				          . "<%itemtimelabel%> <%itemtimeval%>\n"
				          . "</td>\n"
				          . "<td<%cssclass%>>\n"
				          . "<input type=\"checkbox\" id=\"batch<%batchid%>\" name=\"batch[<%batchid%>]\" value=\"<%itemid%>\" />\n"
				          . "<label for=\"batch<%batchid%>\"><b><%itemtitle%></b></label><br />\n"
				          . "<%itembody%>\n"
				          . "</td>\n"
				          . "<td<%cssclass%>>\n"
				          . "<a href=\"index.php?action=itemedit&amp;itemid=<%itemid%>\"><%editbtn%></a><br />\n"
				          . "<a href=\"index.php?action=itemmove&amp;itemid=<%itemid%>\"><%movebtn%></a><br />\n"
				          . "<a href=\"index.php?action=itemdelete&amp;itemid=<%itemid%>\"><%delbtn%></a><br />\n"
				          . "<%camount%>\n"
				          . "</td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_BODY'];
			}
			$cssclass  = '';
			
			if ( $current['idraft'] == 1 )
			{
				$cssclass = ' class="draft"';
			}
			
			// (can't use offset time since offsets might vary between blogs)
			if ( $current['itime'] > $vars['now'] )
			{
				$cssclass = ' class="future"';
			}
			$body = strip_tags($current['ibody']);
			$data = array(
				'cssclass'			=> $cssclass,
				'bshortlabel'		=> _LIST_ITEM_BLOG,
				'bshortnameval'		=> Entity::hsc($current['bshortname']),
				'categorylabel'		=> _LIST_ITEM_CAT,
				'categorynameval'	=> Entity::hsc($current['cname']),
				'authorlabel'		=> _LIST_ITEM_AUTHOR,
				'authornameval'		=> Entity::hsc($current['mname']),
				'itemdatelabel'		=> _LIST_ITEM_DATE,
				'itemdateval'		=> date("Y-m-d",$current['itime']),
				'itemdatelabel'		=> _LIST_ITEM_TIME,
				'itemdateval'		=> date("H:i",$current['itime']),
				'batchid'			=> listplug_nextBatchId(),
				'itemid'			=> $current['inumber'],
				'itemtitle'			=> Entity::hsc(strip_tags($current['ititle'])),
				'itembody'			=> Entity::hsc(Entity::shorten($body, 300, '...')),
				'editbtn'			=> _LISTS_EDIT,
				'movebtn'			=> _LISTS_MOVE,
				'delbtn'			=> _LISTS_DELETE,
			);
			// evaluate amount of comments for the item
			$comment = new Comments($current['inumber']);
			$camount = $comment->amountComments();
			if ( $camount > 0 )
			{
				$data['camount'] = "<a href=\"index.php?action=itemcommentlist&amp;itemid={$current['inumber']}\">(" . sprintf(_LIST_ITEM_COMMENTS, $comment->amountComments()) . ")</a><br />\n";
			}
			else
			{
				$data['camount'] = _LIST_ITEM_NOCONTENT . "<br />\n";
			}
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ITEMLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ITEMLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

// for batch operations: generates the index numbers for checkboxes
function listplug_nextBatchId()
{
	static $id = 0;
	return $id++;
}

function listplug_table_commentlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_HEAD']) )
			{
				$template = "<th><%colinfo%></th>\n"
				          . "<th><%colcontent%></th>\n"
				          . "<th colspan=\"3\"><%colaction%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_HEAD'];
			}
			$data = array(
				'colinfo'		=> _LISTS_INFO,
				'colcontent'	=> _LIST_COMMENT,
				'colaction'		=> _LISTS_ACTIONS
			);
			break;
		case 'BODY':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_BODY']) )
			{
				$template = "<td><%commentdate%><br /><%commentator%><br /><%commentsite%><br /><%commentmail%><br /></td>\n"
				          . "<td>\n"
				          . "<input type=\"checkbox\" id=\"batch<%batchid%>\" name=\"batch[<%batchid%>]\" value=\"<%commentid%>\" />"
				          . "<label for=\"batch<%batchid%>\"><%commentbody%></label>\n"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">\n"
				          . "<a href=\"index.php?action=commentedit&amp;commentid=<%commentid%>\"><%editbtn%></a>\n"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">\n"
				          . "<a href=\"index.php?action=commentdelete&amp;commentid=<%commentid%>\"><%delbtn%></a>\n"
				          . "</td>\n"
				          . "<%addbanlist%>";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_BODY'];
			}
			$current = $vars['current'];
			$body = strip_tags($current['cbody']);
			$data = array(
				'commentdate'	=> date("Y-m-d@H:i", strtotime($current['ctime'])),
				'batchid'		=> listplug_nextBatchId(),
				'commentid'		=> $current['cnumber'],
				'commentbody'	=> Entity::hsc(Entity::shorten($current['cbody'], 300, '...')),
				'editbtn'		=> _LISTS_EDIT,
				'delbtn'		=> _LISTS_DELETE,
			);
			if ( isset($current['mname']) )
			{
				$data['commentator'] = Entity::hsc($current['mname']) . ' ' . _LIST_COMMENTS_MEMBER;
			}
			else
			{
				$data['commentator'] = Entity::hsc($current['cuser']);
			}
			if ( isset($current['cmail']) && $current['cmail'] )
			{
				$data['commentsite'] = Entity::hsc($current['cmail']);
			}
				else
			{
				$data['commentsite'] = '';
			}
			if ( isset($current['cemail']) && $current['cemail'] )
			{
				$data['commentmail'] = Entity::hsc($current['cemail']);
			}
				else
			{
				$data['commentmail'] = '';
			}
			if ( $vars['canAddBan'] )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_ABAN', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_ABAN']) )
				{
					$subTpl = "<td style=\"white-space:nowrap\">"
					        . "<a href=\"index.php?action=banlistnewfromitem&amp;itemid=<%itemid%>&amp;ip=<%banip%>\" title=\"<%banhost%>\"><%banbtn%></a>"
					        . "</td>\n";
				}
				else
				{
					$subTpl = $templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_ABAN'];
				}
				$subData = array(
					'itemid'	=> $current['citem'],
					'banip'		=> Entity::hsc($current['cip']),
					'banbtn'	=> _LIST_COMMENT_BANIP,
				);
				$data['addbanlist'] = Template::fill($subTpl, $subData);
			}
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CMNTLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_FOOT']) )
			{
				$template = "";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CMNTLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_bloglist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_HEAD']) )
			{
				$template = "<th><%blognames%></th>\n"
				          . "<th colspan=\"7\"><%actionshead%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_HEAD'];
			}
			$data = array(
				'blognames'   => _NAME,
				'actionshead' => _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_BODY']) )
			{
				$template = "<td title=\"blogid:<%blogid%> shortname:<%shortname%>\">\n"
				          . "<a href=\"<%blogurl%>\"><img src=\"images/globe.gif\" width=\"13\" height=\"13\" alt=\"<%iconalt%>\" /></a><%blogname%></td>\n"
				          . "<td><a href=\"index.php?action=createitem&amp;blogid=<%blogid%>\" title=\"<%ttaddtext%>\"><%addtext%></a></td>\n"
				          . "<td><a href=\"index.php?action=itemlist&amp;blogid=<%blogid%>\" title=\"<%ttedittext%>\"><%edittext%></a></td>\n"
				          . "<td><a href=\"index.php?action=blogcommentlist&amp;blogid=<%blogid%>\" title=\"<%ttcommenttext%>\"><%commenttext%></a></td>\n"
				          . "<td><a href=\"index.php?action=bookmarklet&amp;blogid=<%blogid%>\" title=\"<%ttbmlettext%>\"><%bmlettext%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_BODY'];
			}
			$data = array(
				'blogid'		=> $current['bnumber'],
				'shortname'		=> Entity::hsc($current['bshortname']),
				'blogurl'		=> $current['burl'],
				'blogname'		=> Entity::hsc($current['bname']),
				'ttaddtext'		=> _BLOGLIST_TT_ADD,
				'addtext'		=> _BLOGLIST_ADD,
				'ttedittext'	=> _BLOGLIST_TT_EDIT,
				'edittext'		=> _BLOGLIST_EDIT,
				'ttcommenttext'	=> _BLOGLIST_TT_COMMENTS,
				'commenttext'	=> _BLOGLIST_COMMENTS,
				'ttbmlettext'	=> _BLOGLIST_TT_BMLET,
				'bmlettext'		=> _BLOGLIST_BMLET,
			);
			if ( $current['tadmin'] == 1 )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM']) )
				{
					$template .= "<td><a href=\"index.php?action=blogsettings&amp;blogid=<%blogid%>\" title=\"<%ttsettingtext%>\"><%settingtext%></a></td>\n"
					           . "<td><a href=\"index.php?action=banlist&amp;blogid=<%blogid%>\" title=\"<%ttbanstext%>\"><%banstext%></a></td>\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM'];
				}
				$data['ttsettingtext']	= _BLOGLIST_TT_SETTINGS;
				$data['settingtext']	= _BLOGLIST_SETTINGS;
				$data['ttbanstext']		= _BLOGLIST_TT_BANS;
				$data['banstext']		= _BLOGLIST_BANS;
			}
			
			if ( $vars['superadmin'] )
			{
				if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLIST_BD_SADM', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLIST_BD_TADM']) )
				{
					$template .= "<td><a href=\"index.php?action=deleteblog&amp;blogid=<%blogid%>\" title=\"<%ttdeletetext%>\"><%deletetext%></a></td>\n";
				}
				else
				{
					$template .= $templates['SHOWLIST_LISTPLUG_TABLE_BLIST_BD_SADM'];
				}
				$data['ttdeletetext']	= _BLOGLIST_TT_DELETE;
				$data['deletetext']		= _BLOGLIST_DELETE;
			}
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_shortblognames($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_HEAD']) )
			{
				$template = "<th><%colshortname%></th>\n"
				          . "<th><%colblogname%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_HEAD'];
			}
			$data = array(
				'colshortname' => _EBLOG_SHORTNAME,
				'colblogname'  => _EBLOG_NAME,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_BODY']) )
			{
				$template = "<td><%bshortname%></td>\n"
				          . "<td><%blogname%></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_BODY'];
			}
			$data = array(
				'bshortname' => Entity::hsc($current['bshortname']),
				'blogname'   => Entity::hsc($current['bname']),
			);
			break;
		case 'FOOT':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_BLOGSNAM_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_shortnames($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_HEAD']) )
			{
				$template = "<th><%colname%></th>\n"
				          . "<th><%coldesc%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_HEAD'];
			}
			$data = array(
				'colname' => _NAME,
				'coldesc' => _LISTS_DESC,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_BODY']) )
			{
				$template = "<td><%name%></td>\n"
				          . "<td><%desc%></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_BODY'];
			}
			$data = array(
				'name' => Entity::hsc($current['name']),
				'desc' => Entity::hsc($current['description']),
			);
			break;
		case 'FOOT':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SHORTNAM_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SHORTNAM_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_categorylist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CATELIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_HEAD']) )
			{
				$template = "<th><%colname%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th colspan=\"2\"><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_HEAD'];
			}
			$data = array(
				'colname' => _LISTS_NAME,
				'coldesc' => _LISTS_DESC,
				'colact'  => _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CATELIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_BODY']) )
			{
				$template = "<td>\n"
				          . "<input type=\"checkbox\" id=\"batch<%batchid%>\" name=\"batch[<%batchid%>]\" value=\"<%catid%>\" />\n"
				          . "<label for=\"batch<%batchid%>\"><%catname%></label>\n"
				          . "</td>\n"
				          . "<td><%catdesc%></td>\n"
				          . "<td><a href=\"index.php?action=categoryedit&amp;blogid=<%blogid%>&amp;catid=<%catid%>\" tabindex=\"<%tabindex%>\"><%editbtn%></a></td>\n"
				          . "<td><a href=\"index.php?action=categorydelete&amp;blogid=<%blogid%>&amp;catid=<%catid%>\" tabindex=\"<%tabindex%>\"><%delbtn%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_BODY'];
			}
			
			$data = array(
				'batchid'	=> listplug_nextBatchId(),
				'catid'		=> intval($current['catid']),
				'catname'	=> Entity::hsc($current['cname']),
				'catdesc'	=> Entity::hsc($current['cdesc']),
				'blogid'	=> intval($current['cblog']),
				'tabindex'	=> intval($vars['tabindex']),
				'editbtn'	=> _LISTS_EDIT,
				'delbtn'	=> _LISTS_DELETE,
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_CATELIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_CATELIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_templatelist($vars, $type, $template_name = '')
{
	global $manager, $CONF;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_HEAD']) )
			{
				$template = "<th><%colname%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th colspan=\"3\"><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_HEAD'];
			}
			$data = array(
				'colname' => _LISTS_NAME,
				'coldesc' => _LISTS_DESC,
				'colact'  => _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_BODY']) )
			{
				$template = "<td><%templatename%></td>\n"
				          . "<td><%templatedesc%></td>\n"
				          . "<td style=\"white-space:nowrap\">"
				          . "<a href=\"<%editurl%>\" tabindex=\"<%tabindex%>\"><%editbtn%></a>\n"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">\n"
				          . "<a href=\"<%cloneurl%>\" tabindex=\"<%tabindex%>\"><%clonebtn%></a>\n"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">\n"
				          . "<a href=\"<%deleteurl%>\" tabindex=\"<%tabindex%>\"><%delbtn%></a>\n"
				          . "</td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_BODY'];
			}
			
			$data = array(
				'templatename'	=> Entity::hsc($current['tdname']),
				'templatedesc'	=> Entity::hsc($current['tddesc']),
				'templateid'	=> (integer) $current['tdnumber'],
				'tabindex'		=> (integer) $vars['tabindex'],
				
				'clonebtn'		=> _LISTS_CLONE,
				'cloneaction'	=> $vars['cloneaction'],
				'cloneurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['cloneaction']}&amp;templateid={$current['tdnumber']}",
				
				'delbtn'		=> _LISTS_DELETE,
				'deleteaction'	=> $vars['deleteaction'],
				'deleteurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['deleteaction']}&amp;templateid={$current['tdnumber']}",
				
				'editbtn'		=> _LISTS_EDIT,
				'editaction'	=> $vars['editaction'],
				'editurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['editaction']}&amp;templateid={$current['tdnumber']}"
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_TPLTLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_TPLTLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_skinlist($vars, $type, $template_name = '')
{
	global $CONF, $DIR_SKINS, $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SKINLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_HEAD']) )
			{
				$template = "<th><%colname%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th colspan=\"3\"><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_HEAD'];
			}
			$data = array(
				'colname'	=> _LISTS_NAME,
				'coldesc'	=> _LISTS_DESC,
				'colact'	=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SKINLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_BODY']) )
			{
				$template = "<td><%skinname%><br /><br />\n"
				          . "<%skintypelabel%> <%skintype%><br />\n"
				          . "<%incmodelabel%> <%incmode%><br />\n"
				          . "<%incpreflabel%> <%incpref%><br />\n"
				          . "<%skinthumb%>"
				          . "<%readme%></td>\n"
				          . "<td class=\"availableSkinTypes\"><%skindesc%><%skinparts%></td>\n"
				          . "<td style=\"white-space:nowrap\">"
				          . "<a href=\"index.php?action=skinedit&amp;skinid=<%skinid%>\" tabindex=\"<%tabindex%>\"><%editbtn%></a>"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">"
				          . "<a href=\"<%cloneurl%>\" tabindex=\"<%tabindex%>\"><%clonebtn%></a>"
				          . "</td>\n"
				          . "<td style=\"white-space:nowrap\">"
				          . "<a href=\"index.php?action=skindelete&amp;skinid=<%skinid%>\" tabindex=\"<%tabindex%>\"><%delbtn%></a>"
				          . "</td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_BODY'];
			}
			
			$data = array(
				'tabindex'		=> $vars['tabindex']++,
				
				'skinid'		=> (integer) $current['sdnumber'],
				'skindesc'		=> Entity::hsc($current['sddesc']),
				
				'skintypelabel'	=> _LISTS_TYPE,
				'skintype'		=> Entity::hsc($current['sdtype']),
				
				'incmodelabel'	=> _LIST_SKINS_INCMODE,
				'incmode'		=> ($current['sdincmode'] == 'skindir') ? _PARSER_INCMODE_SKINDIR : _PARSER_INCMODE_NORMAL,
				
				'incpreflabel'	=> ($current['sdincpref']) ? _SKIN_INCLUDE_PREFIX : '',
				'incpref'		=> ($current['sdincpref']) ? Entity::hsc($current['sdincpref']) : '',
				
				'editbtn'		=> _LISTS_EDIT,
				'editaction'	=> $vars['editaction'],
				'editurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['editaction']}&skinid={$current['sdnumber']}",
				
				'clonebtn'		=> _LISTS_CLONE,
				'cloneaction'	=> $vars['cloneaction'],
				'cloneurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['cloneaction']}&skinid={$current['sdnumber']}",
				
				'delbtn'		=> _LISTS_DELETE,
				'deleteaction'	=> $vars['deleteaction'],
				'deleteurl'		=> "{$CONF['AdminURL']}index.php?action={$vars['deleteaction']}&skinid={$current['sdnumber']}"
			);
			
			if ( $current['sdnumber'] != $vars['default'] )
			{
				$data['skinname'] = Entity::hsc($current['sdname']);
			}
			else
			{
				$data['skinname'] = '<strong>' . Entity::hsc($current['sdname']) . '</strong>';
			}
			
			// add preview image when present
			if ( $current['sdincpref'] && @file_exists("{$DIR_SKINS}{$current['sdincpref']}preview.png") )
			{
				$data['skinthumb'] = "<p>\n";
				
				$alternatve_text = sprintf(_LIST_SKIN_PREVIEW, $current['sdname']);
				$has_enlargement = @file_exists($DIR_SKINS . $current['sdincpref'] . 'preview-large.png');
				if ( $has_enlargement )
				{
					$data['skinthumb'] .= '<a href="' . $CONF['SkinsURL'] . Entity::hsc($current['sdincpref']) . 'preview-large.png" title="' . _LIST_SKIN_PREVIEW_VIEWLARGER . "\">\n";
				}
				$data['skinthumb'] .= '<img class="skinpreview" src="' . $CONF['SkinsURL'] . Entity::hsc($current['sdincpref']) . 'preview.png" width="100" height="75" alt="' . $alternatve_text . "\" />\n";
				if ( $has_enlargement )
				{
					$data['skinthumb'] .= "</a><br />\n";
				}
				
				if ( @file_exists("{$DIR_SKINS}{$current['sdincpref']}readme.html") )
				{
					$url = $CONF['SkinsURL'] . Entity::hsc($current['sdincpref']) . 'readme.html';
					$title = sprintf(_LIST_SKIN_README, $current['sdname']);
					$data['readme'] = "<a href=\"{$url}\" title=\"{$title}\">" . _LIST_SKIN_README_TXT . "</a>\n";
				}
				else
				{
					$data['readme'] ="";
				}
				
				$data['skinthumb'] .=  "</p>\n";
			}
			
			$skin =& $manager->getSkin($current['sdnumber'], $vars['handler']);
			$available_types = $skin->getAvailableTypes();
			
			$data['skinparts'] = _LIST_SKINS_DEFINED
			                   . "<ul>\n";
			foreach ( $available_types as $type => $label )
			{
				if ( $label === FALSE )
				{
					$label = ucfirst($type);
					$article = 'skinpartspecial';
				}
				else
				{
					$article = "skinpart{$type}";
				}
				$data['skinparts'] .= "<li>\n"
				                   . helpHtml($article) . "\n"
				                   . "<a href=\"{$CONF['AdminURL']}index.php?action={$vars['edittypeaction']}&amp;skinid={$current['sdnumber']}&amp;type={$type}\" tabindex=\"{$vars['tabindex']}\">"
				                   . Entity::hsc($label)
				                   . "</a>\n"
				                   . "</li>\n";
			}
			$data['skinparts'] .= "</ul>\n";
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_SKINLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_FOOT']) )
			{
				$template = "";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_SKINLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_draftlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_HEAD']) )
			{
				$template = "<th><%colblog%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th colspan=\"2\"><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_HEAD'];
			}
			$data = array(
				'colblog'	=> _LISTS_BLOG,
				'coldesc'	=> _LISTS_TITLE,
				'colact'	=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_BODY']) )
			{
				$template = "<td><%bshortname%></td>\n"
				          . "<td><%ititle%></td>\n"
				          . "<td><a href=\"index.php?action=itemedit&amp;itemid=<%itemid%>\"><%editbtn%></a></td>\n"
				          . "<td><a href=\"index.php?action=itemdelete&amp;itemid=<%itemid%>\"><%delbtn%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_BODY'];
			}
			$data = array(
				'bshortname'	=> Entity::hsc($current['bshortname']),
				'ititle'		=> Entity::hsc(strip_tags($current['ititle'])),
				'itemid'		=> intval($current['inumber']),
				'editbtn'		=> _LISTS_EDIT,
				'delbtn'		=> _LISTS_DELETE,
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_DRFTLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_DRFTLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_otherdraftlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_HEAD']) )
			{
				$template = "<th><%colblog%></th>\n"
				          . "<th><%coldesc%></th>\n"
				          . "<th><%colautr%></th>\n"
				          . "<th colspan=\"2\"><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_HEAD'];
			}
			$data = array(
				'colblog'	=> _LISTS_BLOG,
				'coldesc'	=> _LISTS_TITLE,
				'colautr'	=> _LISTS_AUTHOR,
				'colact'	=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_BODY']) )
			{
				$template = "<td><%bshortname%></td>\n"
				          . "<td><%ititle%></td>\n"
				          . "<td><%iauthor%></td>\n"
				          . "<td><a href=\"index.php?action=itemedit&amp;itemid=<%itemid%>\"><%editbtn%></a></td>\n"
				          . "<td><a href=\"index.php?action=itemdelete&amp;itemid=<%itemid%>\"><%delbtn%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_BODY'];
			}
			$data = array(
				'bshortname'	=> Entity::hsc($current['bshortname']),
				'ititle'		=> Entity::hsc(strip_tags($current['ititle'])),
				'iauthor'		=> Entity::hsc(strip_tags($current['mname'])),
				'itemid'		=> intval($current['inumber']),
				'editbtn'		=> _LISTS_EDIT,
				'delbtn'		=> _LISTS_DELETE,
			);
			break;
		case 'FOOT':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ODRFTLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_actionlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_HEAD']) )
			{
				$template = "<th><%coltime%></th>\n"
				          . "<th><%colmesg%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_HEAD'];
			}
			$data = array(
				'coltime' => _LISTS_TIME,
				'colmesg' => _LIST_ACTION_MSG,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_BODY']) )
			{
				$template = "<td><%timestamp%></td>\n"
				          . "<td><%message%></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_BODY'];
			}
			$data = array(
				'timestamp'	=> Entity::hsc($current['timestamp']),
				'message'	=> Entity::hsc($current['message']),
			);
			break;
		case 'FOOT':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_ACTNLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_ACTNLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

function listplug_table_banlist($vars, $type, $template_name = '')
{
	global $manager;
	
	$templates = array();
	if ( !empty($template_name) )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_IBANLIST_HEAD', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_HEAD']) )
			{
				$template = "<th><%iprange%></th>\n"
				          . "<th><%reason%></th>\n"
				          . "<th><%colact%></th>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_HEAD'];
			}
			$data = array(
				'iprange'	=> _LIST_BAN_IPRANGE,
				'reason'	=> _LIST_BAN_REASON,
				'colact'	=> _LISTS_ACTIONS,
			);
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_IBANLIST_BODY', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_BODY']) )
			{
				$template = "<td><%iprange%></td>\n"
				          . "<td><%reason%></td>\n"
				          . "<td><a href=\"index.php?action=banlistdelete&amp;blogid=<%blogid%>&amp;iprange=<%iprange%>\"><%delbtn%></a></td>\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_BODY'];
			}
			$data = array(
				'iprange'	=> Entity::hsc($current['iprange']),
				'reason'	=> Entity::hsc($current['reason']),
				'blogid'	=> intval($current['blogid']),
				'delbtn'	=> _LISTS_DELETE,
			);
			break;
		case 'FOOT':
			$current = $vars['current'];
			if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_IBANLIST_FOOT', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_FOOT']) )
			{
				$template = "\n";
			}
			else
			{
				$template = $templates['SHOWLIST_LISTPLUG_TABLE_IBANLIST_FOOT'];
			}
			$data = array();
			break;
	}
	return Template::fill($template, $data);
}

/**
 * listplug_list_normalskinlist()
 * 
 * @param	array	$vars			array for variables
 * @param	string	$type			HEAD/BODY/FOOT
 * @param	string	$template_name	name of template
 * @return	string	marked-up string
 */
function listplug_list_normalskinlist($vars, $type, $template_name = '')
{
	global $manager, $CONF;
	
	/* available variables as a default */
	$data = array(
		'skinid'	=> (integer) $vars['skinid'],
		'skinname'	=> Entity::hsc($vars['skinname']),
	);
	
	$templates = array();
	if ( $template_name )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch ( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('NORMALSKINLIST_HEAD', $templates) || empty($templates['NORMALSKINLIST_HEAD']) )
			{
				$template = "<ul>\n";
			}
			else
			{
				$template = $templates['NORMALSKINLIST_HEAD'];
			}
			
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('NORMALSKINLIST_BODY', $templates) || empty($templates['NORMALSKINLIST_BODY']) )
			{
				$template = "<li>"
				          . "<a href=\"<%editurl%>\" tabindex=\"<%tabindex%>\"><%skintypename%></a>"
				          . " <%help%>"
				          . "</li>\n";
			}
			else
			{
				$template = $templates['NORMALSKINLIST_BODY'];
			}
			
			$data['tabindex']		= $vars['tabindex']++;
			$data['skintype']		= $current['skintype'];
			$data['skintypename']	= $current['skintypename'];
			$data['editaction']		= $vars['editaction'];
			$data['editurl']		= "{$CONF['AdminURL']}?action={$vars['editaction']}&amp;skinid={$vars['skinid']}&amp;type={$current['skintype']}";
			/* TODO: removeaction? */
			/* TODO: customHelpHtml("skinpart{$skintype}-{$template_name}") */
			$data['help']			= '';
			break;
		case 'FOOT':
			if ( !array_key_exists('NORMALSKINLIST_FOOT', $templates) || empty($templates['NORMALSKINLIST_FOOT']) )
			{
				$template = "</ul>\n";
			}
			else
			{
				$template = $templates['NORMALSKINLIST_FOOT'];
			}
			
			break;
	}
	
	return Template::fill($template, $data);
}

/**
 * listplug_list_specialskinlist()
 * 
 * @param	array	$vars			array for variables
 * @param	string	$type			HEAD/BODY/FOOT
 * @param	string	$template_name	name of template
 * @return	string	marked-up string
 */
function listplug_list_specialskinlist($vars, $type, $template_name = '')
{
	global $manager, $CONF;
	
	/* available variables as a default */
	$data = array(
		'skinid'	=> (integer) $vars['skinid'],
		'skinname'	=> Entity::hsc($vars['skinname']),
	);
	
	/* retrieve templates */
	$templates = array();
	if ( $template_name )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	switch ( $type )
	{
		case 'HEAD':
			if ( !array_key_exists('SPECIALSKINLIST_HEAD', $templates) || empty($templates['SPECIALSKINLIST_HEAD']) )
			{
				$template = "<ul>\n";
			}
			else
			{
				$template = $templates['SPECIALSKINLIST_HEAD'];
			}
			break;
		case 'BODY':
			$current = $vars['current'];
			if ( !array_key_exists('SPECIALSKINLIST_BODY', $templates) || empty($templates['SPECIALSKINLIST_BODY']) )
			{
				$template = "<li>"
				          . "<a href=\"<%editurl%>\" tabindex=\"<%tabindex%>\">"
				          . "<%skintype%>"
				          . "</a>"
				          . " ("
				          . "<a href=\"<%removeurl%>\" tabindex=\"<%tabindex%>\" >"
				          . "<%text(_LISTS_DELETE)%>"
				          . "</a>"
				          . ")"
				          . "</li>\n";
			}
			else
			{
				$template = $templates['SPECIALSKINLIST_BODY'];
			}
			
			$data['tabindex']		= (integer) $vars['tabindex']++;
			$data['skintype']		= Entity::hsc($current['skintype']);
			$data['skintypename']	= Entity::hsc($current['skintypename']);
			$data['editaction']		= $vars['editaction'];
			$data['editurl']		= "{$CONF['AdminURL']}?action={$vars['editaction']}&amp;skinid={$vars['skinid']}&amp;type={$current['skintype']}";
			$data['removeaction']	= $vars['editaction'];
			$data['removeurl']		= "{$CONF['AdminURL']}?action={$vars['removeaction']}&amp;skinid={$vars['skinid']}&amp;type={$current['skintype']}";
			
			break;
		case 'FOOT':
			if ( !array_key_exists('SPECIALSKINLIST_FOOT', $templates) || empty($templates['SPECIALSKINLIST_FOOT']) )
			{
				$template = "</ul>\n";
			}
			else
			{
				$template = $templates['SPECIALSKINLIST_FOOT'];
			}
			break;
	}
	
	return Template::fill($template, $data);
}

/**
 * listplug_input_yesno()
 *
 * @param	string	$name			name of input element with radio type attribute
 * @param	string	$checkedval		value which should be checked
 * @param	integer	$tabindex		tabindex number
 * @param	string	$value1			value of radio 1
 * @param	string	$value2			value of radio 2
 * @param	string	$yesval			label for yes
 * @param	string	$noval			label for no
 * @param	boolean	$isAdmin		super admin or not
 * @param	string	$template_name	name of template
 * @param	boolean	$showlist		used in showlist or not
 * @return	string	marked-up string
 */
function listplug_input_yesno($name, $checkedval, $tabindex = 0,
	$value1 = 1, $value2 = 0, $yesval = _YES, $noval = _NO,
	$isAdmin = 0, $template_name = '', $showlist = FALSE)
{
	global $manager;
	
	$templates = array();
	if ( $template_name )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	if ( $name == 'admin' )
	{
		if ( !array_key_exists('INPUTYESNO_TEMPLATE_ADMIN', $templates) || empty($templates['INPUTYESNO_TEMPLATE_ADMIN']) )
		{
			$template = "<input type=\"radio\" id=\"<%yesid%>\" name=\"<%name%>\" value=\"<%yesval%>\" <%yescheckedval%> onclick=\"selectCanLogin(true);\" />\n"
			          . "<label for=\"<%yesid%>\"><%yesvaltext%></label>\n"
			          . "<input type=\"radio\" id=\"<%noid%>\" name=\"<%name%>\" value=\"<%noval%>\" <%nocheckedval%> <%disabled%> onclick=\"selectCanLogin(false);\" />\n"
			          . "<label for=\"<%noid%>\"><%novaltext%></label>\n";
		}
		else
		{
			$template = $templates['INPUTYESNO_TEMPLATE_ADMIN'];
		}
	}
	else
	{
		if ( array_key_exists('INPUTYESNO_TEMPLATE_NORMAL', $templates) && !empty($templates['INPUTYESNO_TEMPLATE_NORMAL']) )
		{
			$template = $templates['INPUTYESNO_TEMPLATE_NORMAL'];
		}
		else if ( $showlist && array_key_exists('SHOWLIST_LISTPLUG_TABLE_PLGOPT_OYESNO', $templates) && !empty($templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OYESNO']) )
		{
			$template = $templates['SHOWLIST_LISTPLUG_TABLE_PLGOPT_OYESNO'];
		}
		else
		{
		$template = "<input type=\"radio\" id=\"<%yesid%>\" name=\"<%name%>\" value=\"<%yesval%>\" <%yescheckedval%> />\n"
		          . "<label for=\"<%yesid%>\"><%yesvaltext%></label>\n"
		          . "<input type=\"radio\" id=\"<%noid%>\" name=\"<%name%>\" value=\"<%noval%>\" <%nocheckedval%> <%disabled%> />\n"
		          . "<label for=\"<%noid%>\"><%novaltext%></label>\n";
		}
	}
	
	$id		= preg_replace('#[|]#', '-', $name);
	$id1	= $id . $value1;
	$id2	= $id . $value2;
	$dat = array(
		'name'			=> Entity::hsc($name),
		'yesval'		=> Entity::hsc($value1),
		'noval'			=> Entity::hsc($value2),
		'yesid'			=> Entity::hsc($id1),
		'noid'			=> Entity::hsc($id2),
		'yesvaltext'	=> $yesval,
		'novaltext'		=> $noval,
		'yescheckedval'	=> ($checkedval == $value1) ? 'checked="checked" tabindex="' . $tabindex . '"': '',
		'nocheckedval'	=> ($checkedval != $value1) ? 'checked="checked" tabindex="' . $tabindex . '"': '',
		'disabled'		=> ($isAdmin && $name == 'canlogin') ? ' disabled="disabled"' : '',
	);
	
	return Template::fill($template, $dat);
}

/**
 * listplug_batchlist()
 * 
 * @param	string		$attr	item/member/team/category/comment
 * @param	resource	$query	SQL resorce
 * @param	string		$type	type for showlist()
 * @param	array		$vars	array for variables
 */
function listplug_batchlist($attr, $query, $type, $vars, $template_name)
{
	global $manager;
	
	/* HEAD */
	$content = "<form method=\"post\" action=\"index.php\">\n";
	
	/* BODY */
	$content .= showlist($query, $type, $vars, $template_name);
	
	/* FOOT */
	switch ( $attr )
	{
		case 'item':
			$options = array(
				'delete'	=> _BATCH_ITEM_DELETE,
				'move'		=> _BATCH_ITEM_MOVE
			);
			break;
		case 'member':
			$options = array(
				'delete'	=> _BATCH_MEMBER_DELETE,
				'setadmin'	=> _BATCH_MEMBER_SET_ADM,
				'unsetadmin' => _BATCH_MEMBER_UNSET_ADM
			);
			break;
		case 'team':
			$options = array(
				'delete' 	=> _BATCH_TEAM_DELETE,
				'setadmin'	=> _BATCH_TEAM_SET_ADM,
				'unsetadmin' => _BATCH_TEAM_UNSET_ADM,
			);
			break;
		case 'category':
			$options = array(
				'delete'	=> _BATCH_CAT_DELETE,
				'move'		=> _BATCH_CAT_MOVE,
			);
			break;
		case 'comment':
			$options = array(
				'delete'	=> _BATCH_COMMENT_DELETE,
			);
			break;
		default:
			$options = array();
			break;
	}
	
	$content .= "<p class=\"batchoperations\">\n"
	           . _BATCH_WITH_SEL
	           . "<select name=\"batchaction\">\n";
	
	foreach ( $options as $option => $label )
	{
		$content .= "<option value=\"{$option}\">{$label}</option>\n";
	}
	$content .= "</select>\n";
	
	if ( $attr == 'team' )
	{
		$content .= '<input type="hidden" name="blogid" value="' . intRequestVar('blogid') . '" />';
	}
	else if ( $attr == 'comment' )
	{
		$content .= '<input type="hidden" name="itemid" value="' . intRequestVar('itemid') . '" />';
	}
	
	$content .= '<input type="submit" value="' . _BATCH_EXEC . '" />'
	           . "("
	           . "<a href=\"\" onclick=\"if( event &amp;&amp; event.preventDefault ) event.preventDefault(); return batchSelectAll(1); \">" . _BATCH_SELECTALL . "</a>"
	           . " - "
	           . "<a href=\"\" onclick=\"if( event &amp;&amp; event.preventDefault ) event.preventDefault(); return batchSelectAll(0); \">" . _BATCH_DESELECTALL . "</a>"
	           . ")\n"
	           . "<input type=\"hidden\" name=\"action\" value=\"batch{$attr}\" />\n"
	           . '<input type="hidden" name="ticket" value="' . Entity::hsc($manager->getNewTicket()) . '" />' . "\n"
	           . "</p>\n"
	           . "</form>\n";
	
	return $content;
}

/**
 * listplug_navlist()
 * 
 * @param	string		$attr			item/member/team/category/comment
 * @param	resource	$query			SQL resorce
 * @param	string		$type			type for showlist()
 * @param	array		$vars			array for variables
 * @param	string		$template_name	name of template
 * @return	string		contents
 */
function listplug_navlist($attribute, $query, $type, $vars, $template_name)
{
	global $CONF, $manager;
	$dat['adminurl'] = $CONF['AdminURL'];
	
	$templates = array();
	if ( $template_name )
	{
		$templates =& $manager->getTemplate($template_name);
	}
	
	$dat['prev'] = $vars['start'] - $vars['amount'];
	if ( $dat['prev'] < $vars['minamount'] )
	{
		$dat['prev'] = $vars['minamount'];
	}
	
	$dat['next'] = $vars['start'] + $vars['amount'];
	
	$navi = "\n";
	if ( !array_key_exists('SHOWLIST_LISTPLUG_TABLE_NAVILIST', $templates) || empty($templates['SHOWLIST_LISTPLUG_TABLE_NAVILIST']) )
	{
		$navi .= "<table frame=\"box\" rules=\"all\" sumamry=\"navigation actions\" class=\"navigation\">\n"
		       . "<tr>\n";
		$navi .= "<td>\n"
		       . "<form method=\"post\" action=\"<%adminurl%>\">\n"
		       . "<input type=\"hidden\" name=\"start\" value=\"<%prev%>\" />\n"
		       . "<button type=\"submit\" name=\"action\" value=\"<%action%>\">&lt; &lt; <%listsprev%></button>\n"
		       . "<input type=\"hidden\" name=\"blogid\" value=\"<%blogid%>\" />\n"
		       . "<input type=\"hidden\" name=\"itemid\" value=\"<%itemid%>\" />\n"
		       . "<input type=\"hidden\" name=\"search\" value=\"<%search%>\" />\n"
		       . "<input type=\"hidden\" name=\"amount\" value=\"<%amount%>\" />\n"
		       . "</form>\n"
		       . "</td>\n";
		$navi .= "<td>\n"
		       . "<form method=\"post\" action=\"<%adminurl%>\">\n"
		       . "<input type=\"text\" name=\"amount\" size=\"3\" value=\"<%amount%>\" />\n"
		       . "<%listsperpage%>"
		       . "<input type=\"hidden\" name=\"start\" value=\"0\" />\n"
		       . "<button type=\"submit\" name=\"action\" value=\"<%action%>\">&gt; <%listschange%></button>\n"
		       . "<input type=\"hidden\" name=\"blogid\" value=\"<%blogid%>\" />\n"
		       . "<input type=\"hidden\" name=\"itemid\" value=\"<%itemid%>\" />\n"
		       . "<input type=\"hidden\" name=\"search\" value=\"<%search%>\" />\n"
		       . "<input type=\"hidden\" name=\"amount\" value=\"<%amount%>\" />\n"
		       . "</form>\n"
		       . "</td>\n";
		$navi .= "<td>\n"
		       . "<form method=\"post\" action=\"<%adminurl%>\">\n"
		       . "<input type=\"text\" name=\"search\" value=\"<%search%>\" size=\"7\" />\n"
		       . "<input type=\"hidden\" name=\"start\" value=\"0\" />\n"
		       . "<button type=\"submit\" name=\"action\" value=\"<%action%>\">&gt; <%listssearch%></button>\n"
		       . "<input type=\"hidden\" name=\"blogid\" value=\"<%blogid%>\" />\n"
		       . "<input type=\"hidden\" name=\"itemid\" value=\"<%itemid%>\" />\n"
		       . "<input type=\"hidden\" name=\"search\" value=\"<%search%>\" />\n"
		       . "<input type=\"hidden\" name=\"amount\" value=\"<%amount%>\" />\n"
		       . "</form>\n"
		       . "</td>\n";
		$navi .= "<td>\n"
		       . "<form method=\"post\" action=\"<%adminurl%>\">\n"
		       . "<input type=\"hidden\" name=\"start\" value=\"<%next%>\" />\n"
		       . "<button type=\"submit\" name=\"action\" value=\"<%action%>\"><%listsnext%>&gt; &gt; </button>\n"
		       . "<input type=\"hidden\" name=\"blogid\" value=\"<%blogid%>\" />\n"
		       . "<input type=\"hidden\" name=\"itemid\" value=\"<%itemid%>\" />\n"
		       . "<input type=\"hidden\" name=\"search\" value=\"<%search%>\" />\n"
		       . "<input type=\"hidden\" name=\"amount\" value=\"<%amount%>\" />\n"
		       . "</form>\n"
		       . "</td>\n";
		$navi .= "</tr>\n"
		       . "</table>\n";
	}
	else
	{
		$navi .= $templates['SHOWLIST_LISTPLUG_TABLE_NAVILIST'];
	}
	$dat['listsprev']		= _LISTS_PREV;
	$dat['listschange']		= _LISTS_CHANGE;
	$dat['listssearch']		= _LISTS_SEARCH;
	$dat['listsnext']		= _LISTS_NEXT;
	$dat['listsperpage']	= _LISTS_PERPAGE;
	/* HEAD */
	$template = Template::fill($navi, $dat);
	
	/* BODY */
	$template .= listplug_batchlist($attribute, $query, $type, $vars, $template_name);
	
	/* FOOT */
	$template .= Template::fill($navi, $dat);
	
	return $template;
}
