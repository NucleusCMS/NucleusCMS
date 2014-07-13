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
function showlist($query, $type, $template) {

	if (is_array($query)) {
		if (sizeof($query) == 0)
			return 0;

		call_user_func('listplug_' . $type, $template, 'HEAD');

		foreach ($query as $currentObj) {
			$template['current'] = $currentObj;
			call_user_func('listplug_' . $type, $template, 'BODY');
		}

		call_user_func('listplug_' . $type, $template, 'FOOT');

		return sizeof($query);

	} else {
		$res = sql_query($query);

		// don't do anything if there are no results
		$numrows = sql_num_rows($res);
		if ($numrows == 0)
			return 0;

		call_user_func('listplug_' . $type, $template, 'HEAD');

		while($template['current'] = sql_fetch_object($res))
			call_user_func('listplug_' . $type, $template, 'BODY');

		call_user_func('listplug_' . $type, $template, 'FOOT');

		sql_free_result($res);

		// return amount of results
		return $numrows;
	}
}

function listplug_select($template, $type) {
	switch($type) {
		case 'HEAD':
			echo '<select name="' . ifset($template['name']) . '" tabindex="' . ifset($template['tabindex']) . '" ' . ifset($template['javascript']) . '>';

			// add extra row if needed
			if (ifset($template['extra'])) {
				echo '<option value="', ifset($template['extraval']), '">', $template['extra'], '</option>';
			}

			break;
		case 'BODY':
			$current = $template['current'];

			echo '<option value="' . htmlspecialchars($current->value,ENT_QUOTES,_CHARSET) . '"';
			if ($template['selected'] == $current->value)
				echo ' selected="selected" ';
			if (isset($template['shorten']) && $template['shorten'] > 0) {
				echo ' title="'. htmlspecialchars($current->text,ENT_QUOTES,_CHARSET).'"';
				$current->text = shorten($current->text, $template['shorten'], $template['shortenel']);
			}
			echo '>' . htmlspecialchars($current->text,ENT_QUOTES,_CHARSET) . '</option>';
			break;
		case 'FOOT':
			echo '</select>';
			break;
	}
}

function listplug_table($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<table>";
			echo "<thead><tr>";
			// print head
			call_user_func("listplug_table_" . $template['content'] , $template, 'HEAD');
			echo "</tr></thead><tbody>";
			break;
		case 'BODY':
			// print tabletype specific thingies
			echo "<tr onmouseover='focusRow(this);' onmouseout='blurRow(this);'>";
			call_user_func("listplug_table_" . $template['content'] , $template,  'BODY');
			echo "</tr>";
			break;
		case 'FOOT':
			call_user_func("listplug_table_" . $template['content'] , $template,  'FOOT');
			echo "</tbody></table>";
			break;
	}
}

function listplug_table_memberlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo '<th>' . _LIST_MEMBER_NAME . '</th><th>' . _LIST_MEMBER_RNAME . '</th><th>' . _LIST_MEMBER_URL . '</th><th>' . _LIST_MEMBER_ADMIN;
			help('superadmin');
			echo "</th><th>" . _LIST_MEMBER_LOGIN;
			help('canlogin');
			echo "</th><th colspan='2'>" . _LISTS_ACTIONS. "</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>';
			$id = listplug_nextBatchId();
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->mnumber,'" />';
			echo '<label for="batch',$id,'">';
			echo "<a href='mailto:", htmlspecialchars($current->memail,ENT_QUOTES,_CHARSET), "' tabindex='".$template['tabindex']."'>", htmlspecialchars($current->mname,ENT_QUOTES,_CHARSET), "</a>";
			echo '</label>';
			echo '</td>';
			echo '<td>', htmlspecialchars($current->mrealname,ENT_QUOTES,_CHARSET), '</td>';
			echo "<td><a href='", htmlspecialchars($current->murl,ENT_QUOTES,_CHARSET), "' tabindex='", $template['tabindex'] , "'>", htmlspecialchars($current->murl,ENT_QUOTES,_CHARSET), "</a></td>";
			echo '<td>', ($current->madmin ? _YES : _NO),'</td>';
			echo '<td>', ($current->mcanlogin ? _YES : _NO), '</td>';
			echo "<td><a href='index.php?action=memberedit&amp;memberid=$current->mnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=memberdelete&amp;memberid=$current->mnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";
			break;
	}
}

function listplug_table_teamlist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD':
			echo "<th>"._LIST_MEMBER_NAME."</th><th>"._LIST_MEMBER_RNAME."</th><th>"._LIST_TEAM_ADMIN;
			help('teamadmin');
			echo "</th><th colspan='2'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>';
			$id = listplug_nextBatchId();
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->tmember,'" />';
			echo '<label for="batch',$id,'">';
			echo "<a href='mailto:", htmlspecialchars($current->memail,ENT_QUOTES,_CHARSET), "' tabindex='".$template['tabindex']."'>", htmlspecialchars($current->mname,ENT_QUOTES,_CHARSET), "</a>";
			echo '</label>';
			echo '</td>';
			echo '<td>', htmlspecialchars($current->mrealname,ENT_QUOTES,_CHARSET), '</td>';
			echo '<td>', ($current->tadmin ? _YES : _NO) , '</td>';
			echo "<td><a href='index.php?action=teamdelete&amp;memberid=$current->tmember&amp;blogid=$current->tblog' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";

			$url = 'index.php?action=teamchangeadmin&memberid=' . intval($current->tmember) . '&blogid=' . intval($current->tblog);
			$url = $manager->addTicketToUrl($url);
			echo "<td><a href='",htmlspecialchars($url,ENT_QUOTES,_CHARSET),"' tabindex='".$template['tabindex']."'>"._LIST_TEAM_CHADMIN."</a></td>";
			break;
	}
}

function listplug_table_pluginlist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD':
			echo '<th>'._LISTS_INFO.'</th><th>'._LISTS_DESC.'</th>';
			echo '<th style="white-space:nowrap">'._LISTS_ACTIONS.'</th>';
			break;
		case 'BODY':
			$current = $template['current'];

			$plug =& $manager->getPlugin($current->pfile);
			if ($plug) {
				echo '<td>';
					echo '<strong>' , htmlspecialchars($plug->getName(),ENT_QUOTES,_CHARSET) , '</strong><br />';
					echo _LIST_PLUGS_AUTHOR, ' ' , htmlspecialchars($plug->getAuthor(),ENT_QUOTES,_CHARSET) , '<br />';
					echo _LIST_PLUGS_VER, ' ' , htmlspecialchars($plug->getVersion(),ENT_QUOTES,_CHARSET) , '<br />';
					if ($plug->getURL())
					echo '<a href="',htmlspecialchars($plug->getURL(),ENT_QUOTES,_CHARSET),'" tabindex="'.$template['tabindex'].'">',_LIST_PLUGS_SITE,'</a><br />';
				echo '</td>';
				echo '<td>';
					echo _LIST_PLUGS_DESC .'<br/>'. encode_desc($plug->getDescription());
					if (sizeof($plug->getEventList()) > 0) {
						echo '<br /><br />',_LIST_PLUGS_SUBS,'<br />',htmlspecialchars(implode($plug->getEventList(),', '),ENT_QUOTES,_CHARSET);
						// check the database to see if it is up-to-date and notice the user if not
					}
					if (!$plug->subscribtionListIsUptodate()) {
						echo '<br /><br /><strong>',_LIST_PLUG_SUBS_NEEDUPDATE,'</strong>';
					}
					if (sizeof($plug->getPluginDep()) > 0) {
						echo '<br /><br />',_LIST_PLUGS_DEP,'<br />',htmlspecialchars(implode($plug->getPluginDep(),', '),ENT_QUOTES,_CHARSET);
					}
// <add by shizuki>
				// check dependency require
				$req = array();
				$res = sql_query('SELECT pfile FROM ' . sql_table('plugin'));
				while($o = sql_fetch_object($res)) {
					$preq =& $manager->getPlugin($o->pfile);
					if ($preq) {
						$depList = $preq->getPluginDep();
						foreach ($depList as $depName) {
							if ($current->pfile == $depName) {
								$req[] = $o->pfile;
							}
						}
					}
				}
				if (count($req) > 0) {
					echo '<h4 class="plugin_dependreq_title">' . _LIST_PLUGS_DEPREQ . "</h4>\n";
					echo '<p class="plugin_dependreq_text">';
					echo htmlspecialchars(implode(', ', $req),ENT_QUOTES,_CHARSET);
					echo "</p>\n";
				}
// </add by shizuki>
				echo '</td>';
			} else {
				echo '<td colspan="2">' . sprintf(_PLUGINFILE_COULDNT_BELOADED, htmlspecialchars($current->pfile,ENT_QUOTES,_CHARSET)) . '</td>';
			}
			echo '<td>';

				$baseUrl = 'index.php?plugid=' . intval($current->pid) . '&action=';
				$url = $manager->addTicketToUrl($baseUrl . 'pluginup');
				echo "<a href='",htmlspecialchars($url,ENT_QUOTES,_CHARSET),"' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_UP,"</a>";
				$url = $manager->addTicketToUrl($baseUrl . 'plugindown');
				echo "<br /><a href='",htmlspecialchars($url,ENT_QUOTES,_CHARSET),"' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_DOWN,"</a>";
				echo "<br /><a href='index.php?action=plugindelete&amp;plugid=$current->pid' tabindex='".$template['tabindex']."'>",_LIST_PLUGS_UNINSTALL,"</a>";
				if ($plug && ($plug->hasAdminArea() > 0))
					echo "<br /><a href='".htmlspecialchars($plug->getAdminURL(),ENT_QUOTES,_CHARSET)."'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_ADMIN,"</a>";
				if ($plug && ($plug->supportsFeature('HelpPage') > 0))
					echo "<br /><a href='index.php?action=pluginhelp&amp;plugid=$current->pid'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_HELP,"</a>";
				if (quickQuery('SELECT COUNT(*) AS result FROM '.sql_table('plugin_option_desc').' WHERE ocontext=\'global\' and opid='.$current->pid) > 0)
					echo "<br /><a href='index.php?action=pluginoptions&amp;plugid=$current->pid'  tabindex='".$template['tabindex']."'>",_LIST_PLUGS_OPTIONS,"</a>";
			echo '</td>';
			break;
	}
}

function listplug_table_plugoptionlist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD':
			echo '<th>'._LISTS_INFO.'</th><th>'._LISTS_VALUE.'</th>';
			break;
		case 'BODY':
			$current = $template['current'];
			listplug_plugOptionRow($current);
			break;
		case 'FOOT':
			?>
			<tr>
				<th colspan="2"><?php echo _PLUGS_SAVE?></th>
			</tr><tr>
				<td><?php echo _PLUGS_SAVE?></td>
				<td><input type="submit" value="<?php echo _PLUGS_SAVE?>" /></td>
			</tr>
			<?php			break;
	}
}

function listplug_plugOptionRow($current) {
	$varname = 'plugoption['.$current['oid'].']['.$current['contextid'].']';
	// retreive the optionmeta
	$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);

	// only if it is not a hidden option write the controls to the page
	if (!array_key_exists('access', $meta) || $meta['access'] != 'hidden') {
		echo '<td>',htmlspecialchars($current['description']?$current['description']:$current['name'],ENT_QUOTES,_CHARSET),'</td>';
		echo '<td>';
		switch($current['type']) {
			case 'yesno':
				ADMIN::input_yesno($varname, $current['value'], 0, 'yes', 'no');
				break;
			case 'password':
				echo '<input type="password" size="40" maxlength="128" name="',htmlspecialchars($varname,ENT_QUOTES,_CHARSET),'" value="',htmlspecialchars($current['value'],ENT_QUOTES,_CHARSET),'" />';
				break;
			case 'select':
				echo '<select name="'.htmlspecialchars($varname,ENT_QUOTES,_CHARSET).'">';
				$aOptions = NucleusPlugin::getOptionSelectValues($current['typeinfo']);
				$aOptions = explode('|', $aOptions);
				for ($i=0; $i<(count($aOptions)-1); $i+=2) {
					echo '<option value="'.htmlspecialchars($aOptions[$i+1],ENT_QUOTES,_CHARSET).'"';
					if ($aOptions[$i+1] == $current['value'])
						echo ' selected="selected"';
					echo '>'.htmlspecialchars($aOptions[$i],ENT_QUOTES,_CHARSET).'</option>';
				}
				echo '</select>';
				break;
			case 'textarea':
				//$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
				echo '<textarea class="pluginoption" cols="30" rows="5" name="',htmlspecialchars($varname,ENT_QUOTES,_CHARSET),'"';
				if ($meta['access'] == 'readonly') {
					echo ' readonly="readonly"';
				}
				echo '>',htmlspecialchars($current['value'],ENT_QUOTES,_CHARSET),'</textarea>';
				break;
			case 'text':
			default:
				//$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);

				echo '<input type="text" size="40" maxlength="128" name="',htmlspecialchars($varname,ENT_QUOTES,_CHARSET),'" value="',htmlspecialchars($current['value'],ENT_QUOTES,_CHARSET),'"';
				if (array_key_exists('datatype', $meta) && $meta['datatype'] == 'numerical') {
					echo ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
				}
				if (array_key_exists('access', $meta) && $meta['access'] == 'readonly') {
					echo ' readonly="readonly"';
				}
				echo ' />';
		}
		if (array_key_exists('extra', $current)) {
			echo $current['extra'];
		}
		echo '</td>';
	}
}

function listplug_table_itemlist($template, $type) {
	$cssclass = null;

	switch($type) {
		case 'HEAD':
			echo "<th>"._LIST_ITEM_INFO."</th><th>"._LIST_ITEM_CONTENT."</th><th style=\"white-space:nowrap\" colspan='1'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->itime = strtotime($current->itime);	// string -> unix timestamp

			if ($current->idraft == 1)
				$cssclass = "class='draft'";

			// (can't use offset time since offsets might vary between blogs)
			if ($current->itime > $template['now'])
				$cssclass = "class='future'";

			echo "<td $cssclass>",_LIST_ITEM_BLOG,' ', htmlspecialchars($current->bshortname,ENT_QUOTES,_CHARSET);
			echo "    <br />",_LIST_ITEM_CAT,' ', htmlspecialchars($current->cname,ENT_QUOTES,_CHARSET);
			echo "    <br />",_LIST_ITEM_AUTHOR, ' ', htmlspecialchars($current->mname,ENT_QUOTES,_CHARSET);
			echo "    <br />",_LIST_ITEM_DATE," " . date("Y-m-d",$current->itime);
			echo "<br />",_LIST_ITEM_TIME," " . date("H:i",$current->itime);
			echo "</td>";
			echo "<td $cssclass>";

			$id = listplug_nextBatchId();

			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->inumber,'" />';
			echo '<label for="batch',$id,'">';
			echo "<b>" . htmlspecialchars(strip_tags($current->ititle),ENT_QUOTES,_CHARSET) . "</b>";
			echo '</label>';
			echo "<br />";


			$current->ibody = strip_tags($current->ibody);
			$current->ibody = htmlspecialchars(shorten($current->ibody,300,'...'),ENT_QUOTES,_CHARSET);

			$COMMENTS = new COMMENTS($current->inumber);
			echo "$current->ibody</td>";
			echo "<td  style=\"white-space:nowrap\" $cssclass>";
			echo 	"<a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"._LISTS_EDIT."</a>";
			// evaluate amount of comments for the item
			$camount = $COMMENTS->amountComments();
			if ($camount>0) {
				echo "<br /><a href='index.php?action=itemcommentlist&amp;itemid=$current->inumber'>";
				echo "( " . sprintf(_LIST_ITEM_COMMENTS, $COMMENTS->amountComments())." )</a>";
			}
			else {
				echo "<br />" . _LIST_ITEM_NOCONTENT;
			}
			echo    "<br /><a href='index.php?action=itemmove&amp;itemid=$current->inumber'>"._LISTS_MOVE."</a>";
			echo    "<br /><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"._LISTS_DELETE."</a>";
			echo "</td>";
			break;
	}
}

// for batch operations: generates the index numbers for checkboxes
function listplug_nextBatchId() {
	static $id = 0;
	return $id++;
}

function listplug_table_commentlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_INFO."</th><th>"._LIST_COMMENT."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];
			$current->ctime = strtotime($current->ctime);	// string -> unix timestamp

			echo '<td>';
			echo date("Y-m-d@H:i",$current->ctime);
			echo '<br />';
			if ($current->mname)
				echo htmlspecialchars($current->mname,ENT_QUOTES,_CHARSET) ,' ', _LIST_COMMENTS_MEMBER;
			else
				echo htmlspecialchars($current->cuser,ENT_QUOTES,_CHARSET);
			if ($current->cmail != '') {
                                echo '<br />';
                                echo htmlspecialchars($current->cmail,ENT_QUOTES,_CHARSET);
                        }
			if ($current->cemail != '') {
                                echo '<br />';
                                echo htmlspecialchars($current->cemail,ENT_QUOTES,_CHARSET);
                        }
			echo '</td>';

			$current->cbody = strip_tags($current->cbody);
			$current->cbody = htmlspecialchars(shorten($current->cbody, 300, '...'),ENT_QUOTES,_CHARSET);

			echo '<td>';
			$id = listplug_nextBatchId();
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->cnumber,'" />';
			echo '<label for="batch',$id,'">';
			echo $current->cbody;
			echo '</label>';
			echo '</td>';

			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=commentedit&amp;commentid=$current->cnumber'>"._LISTS_EDIT."</a></td>";
			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=commentdelete&amp;commentid=$current->cnumber'>"._LISTS_DELETE."</a></td>";
			if ($template['canAddBan'])
				echo "<td style=\"white-space:nowrap\"><a href='index.php?action=banlistnewfromitem&amp;itemid=$current->citem&amp;ip=", htmlspecialchars($current->cip,ENT_QUOTES,_CHARSET), "' title='", htmlspecialchars($current->chost,ENT_QUOTES,_CHARSET), "'>"._LIST_COMMENT_BANIP."</a></td>";
			break;
	}
}


function listplug_table_bloglist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>" . _NAME . "</th><th colspan='7'>" ._LISTS_ACTIONS. "</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo "<td title='blogid:$current->bnumber shortname:$current->bshortname'><a href='$current->burl'><img src='images/globe.gif' width='13' height='13' alt='". _BLOGLIST_TT_VISIT."' /></a> " . htmlspecialchars($current->bname,ENT_QUOTES,_CHARSET) . "</td>";
			echo "<td><a href='index.php?action=createitem&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_ADD ."'>" . _BLOGLIST_ADD . "</a></td>";
			echo "<td><a href='index.php?action=itemlist&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_EDIT."'>". _BLOGLIST_EDIT."</a></td>";
			echo "<td><a href='index.php?action=blogcommentlist&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_COMMENTS."'>". _BLOGLIST_COMMENTS."</a></td>";
			echo "<td><a href='index.php?action=bookmarklet&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_BMLET."'>". _BLOGLIST_BMLET . "</a></td>";

			if ($current->tadmin == 1) {
				echo "<td><a href='index.php?action=blogsettings&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_SETTINGS . "'>" ._BLOGLIST_SETTINGS. "</a></td>";
				echo "<td><a href='index.php?action=banlist&amp;blogid=$current->bnumber' title='" . _BLOGLIST_TT_BANS. "'>". _BLOGLIST_BANS."</a></td>";
			}

			if ($template['superadmin']) {
				echo "<td><a href='index.php?action=deleteblog&amp;blogid=$current->bnumber' title='". _BLOGLIST_TT_DELETE."'>" ._BLOGLIST_DELETE. "</a></td>";
			}



			break;
	}
}

function listplug_table_shortblognames($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>" . _EBLOG_SHORTNAME . "</th><th>" . _EBLOG_NAME. "</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>' , htmlspecialchars($current->bshortname,ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>' , htmlspecialchars($current->bname,ENT_QUOTES,_CHARSET) , '</td>';

			break;
	}
}

function listplug_table_shortnames($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>" . _NAME . "</th><th>" . _LISTS_DESC. "</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>' , htmlspecialchars($current->name,ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>' , htmlspecialchars($current->description,ENT_QUOTES,_CHARSET) , '</td>';

			break;
	}
}


function listplug_table_categorylist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='2'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>';
			$id = listplug_nextBatchId();
			echo '<input type="checkbox" id="batch',$id,'" name="batch[',$id,']" value="',$current->catid,'" />';
			echo '<label for="batch',$id,'">';
			echo htmlspecialchars($current->cname,ENT_QUOTES,_CHARSET);
			echo '</label>';
			echo '</td>';

			echo '<td>', htmlspecialchars($current->cdesc,ENT_QUOTES,_CHARSET), '</td>';
			echo "<td><a href='index.php?action=categorydelete&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";
			echo "<td><a href='index.php?action=categoryedit&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";

			break;
	}
}


function listplug_table_templatelist($template, $type) {
	global $manager;
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo "<td>" , htmlspecialchars($current->tdname,ENT_QUOTES,_CHARSET), "</td>";
			echo "<td>" , htmlspecialchars($current->tddesc,ENT_QUOTES,_CHARSET), "</td>";
			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templateedit&amp;templateid=$current->tdnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";

			$url = $manager->addTicketToUrl('index.php?action=templateclone&templateid=' . intval($current->tdnumber));
			echo "<td style=\"white-space:nowrap\"><a href='",htmlspecialchars($url,ENT_QUOTES,_CHARSET),"' tabindex='".$template['tabindex']."'>"._LISTS_CLONE."</a></td>";
			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templatedelete&amp;templateid=$current->tdnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";

			break;
	}
}

function listplug_table_skinlist($template, $type) {
	global $CONF, $DIR_SKINS, $manager;
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_NAME."</th><th>"._LISTS_DESC."</th><th colspan='3'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>';

			// use a special style for the default skin
			if ($current->sdnumber == $CONF['BaseSkin']) {
				echo '<strong>',htmlspecialchars($current->sdname,ENT_QUOTES,_CHARSET),'</strong>';
			} else {
				echo htmlspecialchars($current->sdname,ENT_QUOTES,_CHARSET);
			}

			echo '<br /><br />';
			echo _LISTS_TYPE ,': ' , htmlspecialchars($current->sdtype,ENT_QUOTES,_CHARSET);
			echo '<br />', _LIST_SKINS_INCMODE , ' ' , (($current->sdincmode=='skindir') ?_PARSER_INCMODE_SKINDIR:_PARSER_INCMODE_NORMAL);
			if ($current->sdincpref) echo '<br />' , _LIST_SKINS_INCPREFIX , ' ', htmlspecialchars($current->sdincpref,ENT_QUOTES,_CHARSET);

			// add preview image when present
			if ($current->sdincpref && @file_exists($DIR_SKINS . $current->sdincpref . 'preview.png'))
			{
				echo '<br /><br />';

				$hasEnlargement = @file_exists($DIR_SKINS . $current->sdincpref . 'preview-large.png');
				if ($hasEnlargement)
					echo '<a href="',$CONF['SkinsURL'], htmlspecialchars($current->sdincpref,ENT_QUOTES,_CHARSET),'preview-large.png" title="' . _LIST_SKIN_PREVIEW_VIEWLARGER . '">';

				$imgAlt = sprintf(_LIST_SKIN_PREVIEW, htmlspecialchars($current->sdname,ENT_QUOTES,_CHARSET));
				echo '<img class="skinpreview" src="',$CONF['SkinsURL'], htmlspecialchars($current->sdincpref,ENT_QUOTES,_CHARSET),'preview.png" width="100" height="75" alt="' . $imgAlt . '" />';

				if ($hasEnlargement)
					echo '</a>';

				if (@file_exists($DIR_SKINS . $current->sdincpref . 'readme.html'))
				{
					$url         = $CONF['SkinsURL'] . htmlspecialchars($current->sdincpref,ENT_QUOTES,_CHARSET) . 'readme.html';
					$readmeTitle = sprintf(_LIST_SKIN_README, htmlspecialchars($current->sdname,ENT_QUOTES,_CHARSET));
					echo '<br /><a href="' . $url . '" title="' . $readmeTitle . '">' . _LIST_SKIN_README_TXT . '</a>';
				}


			}

			echo "</td>";


			echo "<td>" , htmlspecialchars($current->sddesc,ENT_QUOTES,_CHARSET);
				// show list of defined parts
				$r = sql_query('SELECT stype FROM '.sql_table('skin').' WHERE sdesc='.$current->sdnumber . ' ORDER BY stype');
				$types = array();
				while ($o = sql_fetch_object($r))
					array_push($types,$o->stype);
				if (sizeof($types) > 0) {
					$friendlyNames = SKIN::getFriendlyNames();
					for ($i=0;$i<sizeof($types);$i++) {
						$type = $types[$i];
						if (in_array($type, array('index', 'item', 'archivelist', 'archive', 'search', 'error', 'member', 'imagepopup'))) {
							$types[$i] = '<li>' . helpHtml('skinpart'.$type) . ' <a href="index.php?action=skinedittype&amp;skinid='.$current->sdnumber.'&amp;type='.$type.'" tabindex="'.$template['tabindex'].'">' . htmlspecialchars($friendlyNames[$type],ENT_QUOTES,_CHARSET) . "</a></li>";
						} else {
							$types[$i] = '<li>' . helpHtml('skinpartspecial') . ' <a href="index.php?action=skinedittype&amp;skinid='.$current->sdnumber.'&amp;type='.$type.'" tabindex="'.$template['tabindex'].'">' . htmlspecialchars($friendlyNames[$type],ENT_QUOTES,_CHARSET) . "</a></li>";
						}
					}
					echo '<br /><br />',_LIST_SKINS_DEFINED,' <ul>',implode($types,'') ,'</ul>';
				}
			echo "</td>";
			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skinedit&amp;skinid=$current->sdnumber' tabindex='".$template['tabindex']."'>"._LISTS_EDIT."</a></td>";

			$url = $manager->addTicketToUrl('index.php?action=skinclone&skinid=' . intval($current->sdnumber));
			echo "<td style=\"white-space:nowrap\"><a href='",htmlspecialchars($url,ENT_QUOTES,_CHARSET),"' tabindex='".$template['tabindex']."'>"._LISTS_CLONE."</a></td>";
			echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skindelete&amp;skinid=$current->sdnumber' tabindex='".$template['tabindex']."'>"._LISTS_DELETE."</a></td>";

			break;
	}
}

function listplug_table_draftlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_BLOG."</th><th>"._LISTS_TITLE."</th><th colspan='2'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>', htmlspecialchars($current->bshortname,ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>', htmlspecialchars(strip_tags($current->ititle),ENT_QUOTES,_CHARSET) , '</td>';
			echo "<td><a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"._LISTS_DELETE."</a></td>";

			break;
	}
}

function listplug_table_otherdraftlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo "<th>"._LISTS_BLOG."</th><th>"._LISTS_TITLE."</th><th>"._LISTS_AUTHOR."</th><th colspan='2'>"._LISTS_ACTIONS."</th>";
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>', htmlspecialchars($current->bshortname,ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>', htmlspecialchars(strip_tags($current->ititle),ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>', htmlspecialchars($current->mname,ENT_QUOTES,_CHARSET) , '</td>';
			echo "<td><a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"._LISTS_EDIT."</a></td>";
			echo "<td><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"._LISTS_DELETE."</a></td>";

			break;
	}
}

function listplug_table_actionlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo '<th>'._LISTS_TIME.'</th><th>'._LIST_ACTION_MSG.'</th>';
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>' , htmlspecialchars($current->timestamp,ENT_QUOTES,_CHARSET), '</td>';
			echo '<td>' , htmlspecialchars($current->message,ENT_QUOTES,_CHARSET), '</td>';

			break;
	}
}

function listplug_table_banlist($template, $type) {
	switch($type) {
		case 'HEAD':
			echo '<th>'._LIST_BAN_IPRANGE.'</th><th>'. _LIST_BAN_REASON.'</th><th>'._LISTS_ACTIONS.'</th>';
			break;
		case 'BODY':
			$current = $template['current'];

			echo '<td>' , htmlspecialchars($current->iprange,ENT_QUOTES,_CHARSET) , '</td>';
			echo '<td>' , htmlspecialchars($current->reason,ENT_QUOTES,_CHARSET) , '</td>';
			echo "<td><a href='index.php?action=banlistdelete&amp;blogid=", intval($current->blogid) , "&amp;iprange=" , htmlspecialchars($current->iprange,ENT_QUOTES,_CHARSET) , "'>",_LISTS_DELETE,"</a></td>";
			break;
	}
}

?>
