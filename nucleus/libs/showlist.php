<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * Functions to create lists of things inside the admin are
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

// can take either an array of objects, or an SQL query
function showlist($data, $type, $template)
{
    if (is_array($data)) {
        return showlist_by_array($data, $type, $template);
    } else {
        return showlist_by_query($data, $type, $template);
    }
}

function showlist_by_array($query, $type, $template)
{
    if (count($query) == 0) {
        return 0;
    }

    call_user_func("listplug_{$type}", $template, 'HEAD');

    foreach ($query as $currentObj) {
        $template['current'] = $currentObj;
        if (isset($template['current']->burl)
            && strlen($template['current']->burl) == 0
            && isset($template['current']->bnumber)) {
            $template['current']->burl
                = createBlogidLink($template['current']->bnumber);
        }
        call_user_func("listplug_{$type}", $template, 'BODY');
    }

    call_user_func("listplug_{$type}", $template, 'FOOT');

    return count($query);
}

function showlist_by_query($query, $type, $template)
{
    $res = sql_query($query);

    if ( ! $res) {
        return 0;
    }

    // don't do anything if there are no results
    $numrows = 0;

    call_user_func("listplug_{$type}", $template, 'HEAD');

    while ($template['current'] = sql_fetch_object($res)) {
        $numrows++;
        if (isset($template['current']->burl)
            && strlen($template['current']->burl) == 0
            && isset($template['current']->bnumber)) {
            $template['current']->burl
                = createBlogidLink($template['current']->bnumber);
        }
        call_user_func("listplug_{$type}", $template, 'BODY');
    }

    call_user_func("listplug_{$type}", $template, 'FOOT');

    sql_free_result($res);

    // return amount of results
    return $numrows;
}

function listplug_select($template, $type)
{
    if ($type == 'HEAD') {
        $ph['name']       = ifset($template['name']);
        $ph['tabindex']   = ifset($template['tabindex']);
        $ph['javascript'] = ifset($template['javascript']);
        $ph['extra']      = ifset($template['extra']);
        $ph['extraval']   = ifset($template['extraval']);
        echo parseHtml('<select name="{%name%}" tabindex="{%tabindex%}" {%javascript%}>',
            $ph);

        if ($ph['extra']) {
            echo parseHtml('<option value="{%extraval%}">{%extra%}</option>',
                $ph);
        }
    } elseif ($type == 'BODY') {
        $current        = $template['current'];
        $ph             = array();
        $ph['value']    = $current->value;
        $ph['selected'] = (isset($template['selected'])
                           && $template['selected'] == $current->value)
            ? 'selected' : '';
        if (isset($template['shorten']) && $template['shorten'] > 0) {
            $ph['text']  = shorten($current->text, $template['shorten'],
                $template['shortenel']);
            $ph['title'] = $current->value;
        } else {
            $ph['text']  = $current->text;
            $ph['title'] = '';
        }
        echo parseHtml('<option value="{%value:hsc%}" {%selected%} title="{%title:hsc%}">{%text:hsc%}</option>',
            $ph);
    } elseif ($type == 'FOOT') {
        echo '</select>';
    }
}

function listplug_table($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<table>";
            echo "<thead><tr>";
            // print head
            $rs = call_user_func("listplug_table_" . $template['content'],
                $template, 'HEAD');
            if ($rs) {
                echo $rs;
            }
            echo "</tr></thead><tbody>";
            break;
        case 'BODY':
            // print tabletype specific thingies
            echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);">';
            $rs = call_user_func("listplug_table_" . $template['content'],
                $template, 'BODY');
            if ($rs) {
                echo $rs;
            }
            echo "</tr>";
            break;
        case 'FOOT':
            call_user_func("listplug_table_" . $template['content'], $template,
                'FOOT');
            echo "</tbody></table>";
            break;
    }
}

function listplug_table_memberlist($template, $type)
{
    global $member;

    if ($type == 'HEAD') {
        $tpl
                        = '<th>{%name%}</th><th>{%rname%}</th><th>{%url%}</th><th>{%admin%}{%help%}</th><th>{%login%}{%canlogin%}</th><th colspan="3">{%actions%}</th>';
        $ph['name']     = _LIST_MEMBER_NAME;
        $ph['rname']    = _LIST_MEMBER_RNAME;
        $ph['url']      = _LIST_MEMBER_URL;
        $ph['admin']    = _LIST_MEMBER_ADMIN;
        $ph['login']    = _LIST_MEMBER_LOGIN;
        $ph['help']     = helpHtml('superadmin');
        $ph['canlogin'] = helpHtml('canlogin');
        $ph['actions']  = _LISTS_ACTIONS;

        return parseHtml($tpl, $ph);
    } elseif ($type == 'BODY') {
        $current          = $template['current'];
        $ph               = (array)$template['current'];
        $ph['id']         = listplug_nextBatchId();
        $ph['tabindex']   = $template['tabindex'];
        $ph['madmin?']    = $current->madmin ? _YES : _NO;
        $ph['mcanlogin?'] = $current->mcanlogin ? _YES : _NO;
        $ph['edit']       = _LISTS_EDIT;
        $ph['delete']     = _LISTS_DELETE;
        $ph['halting']    = _LISTS_HALTING;
        $ph['halt']       = _LISTS_HALT;

        $td    = array();
        $td[0]
               = '<input type="checkbox" id="batch{%id%}" name="batch[{%id%}]" value="{%mnumber%}" />';
        $td[0] .= '<label for="batch{%id%}"><a href="mailto:{%memail:hsc%}" tabindex="{%tabindex%}">{%mname:hsc%}</a></label>';
        $td[1] = '{%mrealname:hsc%}';
        $td[2]
               = '<a href="{%murl:hsc%}" tabindex="{%tabindex%}">{%murl:hsc%}</a>';
        $td[3] = '{%madmin?%}';
        $td[4] = '{%mcanlogin?%}';
        $td[5]
               = '<a href="index.php?action=memberedit&amp;memberid={%mnumber%}" tabindex="{%tabindex%}">{%edit%}</a>';
        $td[6]
               = '<a href="index.php?action=memberdelete&amp;memberid={%mnumber%}" tabindex="{%tabindex%}">{%delete%}</a>';

        if ($member->id == $current->mnumber) {
            $td[7] = '-';
        } elseif (isset($current->mhalt) && ($current->mhalt)) {
            $td[7] = '{%halting:hsc%}';
        } else {
            $td[7]
                = '<a href="index.php?action=memberhalt&amp;memberid={%mnumber%}" tabindex="{%tabindex%}">{%halt:hsc%}</a>';
        }

        $tpl = array();
        foreach ($td as $v) {
            $tpl[] = '<td>' . $v . '</td>';
        }

        return parseHtml(join("\n", $tpl), $ph);
    }
}

function listplug_table_teamlist($template, $type)
{
    global $manager;
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LIST_MEMBER_NAME . "</th><th>" . _LIST_MEMBER_RNAME
                 . "</th><th>" . _LIST_TEAM_ADMIN;
            help('teamadmin');
            echo "</th><th colspan='2'>" . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>';
            $id = listplug_nextBatchId();
            echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->tmember, '" />';
            echo '<label for="batch', $id, '">';
            echo "<a href='mailto:", hsc($current->memail), "' tabindex='"
                                                            . $template['tabindex']
                                                            . "'>", hsc($current->mname), "</a>";
            echo '</label>';
            echo '</td>';
            echo '<td>', hsc($current->mrealname), '</td>';
            echo '<td>', ($current->tadmin ? _YES : _NO), '</td>';
            echo "<td><a href='index.php?action=teamdelete&amp;memberid=$current->tmember&amp;blogid=$current->tblog' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";

            $url = 'index.php?action=teamchangeadmin&memberid='
                   . intval($current->tmember) . '&blogid='
                   . intval($current->tblog);
            $url = $manager->addTicketToUrl($url);
            echo "<td><a href='", hsc($url), "' tabindex='"
                                             . $template['tabindex'] . "'>"
                                             . _LIST_TEAM_CHADMIN . "</a></td>";
            break;
    }
}

function listplug_table_pluginlist($template, $type)
{
    global $manager;
    switch ($type) {
        case 'HEAD':
            echo '<th>' . _LISTS_INFO . '</th><th>' . _LISTS_DESC . '</th>';
            echo '<th style="white-space:nowrap">' . _LISTS_ACTIONS . '</th>';
            break;
        case 'BODY':
            $current = $template['current'];

            $plug =& $manager->getPlugin($current->pfile);
            if ($plug) {
                echo '<td>';
                echo '<strong>', hsc($plug->getName()), '</strong><br />';
                if ($plug->getAuthor() !== 'Undefined') {
                    echo _LIST_PLUGS_AUTHOR, ' ', hsc($plug->getAuthor()), '<br />';
                }
                echo _LIST_PLUGS_VER, ' ', hsc($plug->getVersion()), '<br />';
                if ($plug->getURL() && $plug->getURL() !== 'Undefined') {
                    echo '<a href="', hsc($plug->getURL()), '" tabindex="'
                                                            . $template['tabindex']
                                                            . '">', _LIST_PLUGS_SITE, '</a>';
                }
                echo '</td>';
                echo '<td>';
                // plugin update check
                $update_info = $plug->checkRemoteUpdate();
                if ($update_info['result']) {
                    $dl_url = $update_info['download'];
                    echo "<strong style='color: red'>"
                         . hsc(_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE)
                         . "</strong><br />";
                    echo "Latest version: " . hsc($update_info['version'])
                         . "<br />";
                    if ( ! empty($update_info['download'])) {
                        printf('Get URL : <a href="%s" target="_blank">%s</a><br />',
                            hsc($update_info['download']),
                            hsc($update_info['download']));
                    }
                    echo "<br />";
                }
                // plugin Description
                echo hsc($plug->getDescription());
                $pl_event_list = $plug->_getEventList();
                if (count($pl_event_list) > 0) {
                    echo '<br /><br />', _LIST_PLUGS_SUBS, '<br />', hsc(implode(', ',
                        $pl_event_list));
                    // check the database to see if it is up-to-date and notice the user if not
                }
                if ( ! $plug->subscribtionListIsUptodate()) {
                    echo '<br /><br /><strong>', _LIST_PLUG_SUBS_NEEDUPDATE, '</strong>';
                }
                if (count($plug->getPluginDep()) > 0) {
                    echo '<br /><br />', _LIST_PLUGS_DEP, '<br />', hsc(implode(', ',
                        $plug->getPluginDep()));
                }
                // <add by shizuki>
                // check dependency require
                $req = array();
                $res = sql_query('SELECT pfile FROM ' . sql_table('plugin'));
                while ($o = sql_fetch_object($res)) {
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
                    echo '<h4 class="plugin_dependreq_title">'
                         . _LIST_PLUGS_DEPREQ . "</h4>\n";
                    echo '<p class="plugin_dependreq_text">';
                    echo hsc(implode(', ', $req));
                    echo "</p>\n";
                }
                // </add by shizuki>
                echo '</td>';
            } else {
                echo '<td colspan="2">' . sprintf(_PLUGINFILE_COULDNT_BELOADED,
                        hsc($current->pfile)) . '</td>';
            }
            echo '<td style="white-space:nowrap;">';

            $baseUrl = 'index.php?plugid=' . intval($current->pid) . '&action=';
            $url     = $manager->addTicketToUrl($baseUrl . 'pluginup');
            echo "<a href='", hsc($url), "' tabindex='" . $template['tabindex']
                                         . "'>", _LIST_PLUGS_UP, "</a>";
            $url = $manager->addTicketToUrl($baseUrl . 'plugindown');
            echo " | <a href='", hsc($url), "' tabindex='"
                                            . $template['tabindex']
                                            . "'>", _LIST_PLUGS_DOWN, "</a>";
            echo "<br /><a href='index.php?action=plugindelete&amp;plugid=$current->pid' tabindex='"
                 . $template['tabindex'] . "'>", _LIST_PLUGS_UNINSTALL, "</a>";
            if ($plug && ($plug->hasAdminArea() > 0)) {
                if ($plug->supportsFeature('pluginadmin')) {
                    $url = $manager->addTicketToUrl($baseUrl . 'pluginadmin');
                    printf("<br /><a href='%s' tabindex='%s'>%s</a>", $url,
                        $template['tabindex'], _LIST_PLUGS_ADMIN);
                } else {
                    echo "<br /><a href='" . hsc($plug->getAdminURL())
                         . "'  tabindex='" . $template['tabindex']
                         . "'>", _LIST_PLUGS_ADMIN, "</a>";
                }
            }
            if ($plug && ($plug->supportsFeature('HelpPage') > 0)) {
                echo "<br /><a href='index.php?action=pluginhelp&amp;plugid=$current->pid'  tabindex='"
                     . $template['tabindex'] . "'>", _LIST_PLUGS_HELP, "</a>";
            }
            if (quickQuery('SELECT COUNT(*) AS result FROM '
                           . sql_table('plugin_option_desc')
                           . ' WHERE ocontext=\'global\' and opid='
                           . $current->pid) > 0) {
                echo "<br /><a href='index.php?action=pluginoptions&amp;plugid=$current->pid'  tabindex='"
                     . $template['tabindex']
                     . "'>", _LIST_PLUGS_OPTIONS, "</a>";
            }
            echo '</td>';
            break;
    }
}

function listplug_table_plugoptionlist($template, $type)
{
    global $manager;
    switch ($type) {
        case 'HEAD':
            echo '<th>' . _LISTS_INFO . '</th><th>' . _LISTS_VALUE . '</th>';
            break;
        case 'BODY':
            $current = $template['current'];
            listplug_plugOptionRow($current);
            break;
        case 'FOOT':
            ?>
            <tr>
                <th colspan="2"><?php
                    echo _PLUGS_SAVE ?></th>
            </tr>
            <tr>
                <td><?php
                    echo _PLUGS_SAVE ?></td>
                <td><input type="submit" value="<?php
                    echo _PLUGS_SAVE ?>"/></td>
            </tr>
            <?php
            break;
    }
}

function listplug_plugOptionRow($current)
{
    $varname = 'plugoption[' . $current['oid'] . '][' . $current['contextid']
               . ']';
    // retreive the optionmeta
    $meta = NucleusPlugin::getOptionMeta($current['typeinfo']);

    // only if it is not a hidden option write the controls to the page
    if ( ! array_key_exists('access', $meta) || $meta['access'] != 'hidden') {
        echo '<td>', hsc($current['description'] ? $current['description']
            : $current['name']), '</td>';
        echo '<td>';
        switch ($current['type']) {
            case 'yesno':
                ADMIN::input_yesno($varname, $current['value'], 0, 'yes', 'no');
                break;
            case 'password':
                echo '<input type="password" size="40" maxlength="128" name="', hsc($varname), '" value="', hsc($current['value']), '" />';
                break;
            case 'select':
                echo '<select name="' . hsc($varname) . '">';
                $aOptions
                          = NucleusPlugin::getOptionSelectValues($current['typeinfo']);
                $aOptions = explode('|', $aOptions);
                for ($i = 0; $i < (count($aOptions) - 1); $i += 2) {
                    echo '<option value="' . hsc($aOptions[$i + 1]) . '"';
                    if ($aOptions[$i + 1] == $current['value']) {
                        echo ' selected="selected"';
                    }
                    echo '>' . hsc($aOptions[$i]) . '</option>';
                }
                echo '</select>';
                break;
            case 'textarea':
                //$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);
                echo '<textarea class="pluginoption" cols="30" rows="5" name="', hsc($varname), '"';
                if (array_key_exists('access', $meta)
                    && $meta['access'] == 'readonly') {
                    echo ' readonly="readonly"';
                }
                echo '>', hsc($current['value']), '</textarea>';
                break;
            case 'text':
            default:
                //$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);

                echo '<input type="text" size="40" maxlength="128" name="', hsc($varname), '" value="', hsc($current['value']), '"';
                if (array_key_exists('datatype', $meta)
                    && $meta['datatype'] == 'numerical') {
                    echo ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
                }
                if (array_key_exists('access', $meta)
                    && $meta['access'] == 'readonly') {
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

function listplug_table_itemlist($template, $type)
{
    global $CONF;
    $cssclass = null;

    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LIST_ITEM_INFO . "</th><th>" . _LIST_ITEM_CONTENT
                 . "</th><th style=\"white-space:nowrap\" colspan='1'>"
                 . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];
            $current->itime
                     = strtotime($current->itime);    // string -> unix timestamp
            if ($current->itime < 0) {
                $current->itime = 0;
            }

            if ($current->idraft == 1) {
                $cssclass = "class='draft'";
            }

            // (can't use offset time since offsets might vary between blogs)
            if ($current->itime > $template['now']) {
                $cssclass = "class='future'";
            }

            $action = requestVar('action');
            $style  = ($action !== 'pluginlist') ? 'style="white-space:nowrap"'
                : '';
            echo "<td {$cssclass} {$style}>";
            if ($action !== 'itemlist') {
                echo _LIST_ITEM_BLOG . ' ' . hsc($current->bshortname)
                     . '<br />';
            }
            echo _LIST_ITEM_CAT . ' ' . hsc($current->cname) . '<br />';
            if ($action !== 'browseownitems') {
                echo _LIST_ITEM_AUTHOR . ' ' . hsc($current->mname) . '<br />';
            }
            if ($current->itime) {
                echo date('Y-m-d', $current->itime) . ' ' . date('H:i',
                        $current->itime);
            } else {
                echo '0000-00-00 00:00';
            }
            echo "</td>";
            echo "<td $cssclass>";

            $id = listplug_nextBatchId();

            echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->inumber, '" />';
            echo '<label for="batch', $id, '">';
            echo "<b>" . hsc(strip_tags($current->ititle)) . "</b>";
            echo '</label>';
            echo "<br />";


            $current->ibody = strip_tags($current->ibody);
            $current->ibody = hsc(shorten($current->ibody, 300, '...'));

            $COMMENTS = new COMMENTS($current->inumber);
            echo "$current->ibody</td>";
            echo "<td  style=\"white-space:nowrap\" $cssclass>";
            echo "<a href='index.php?action=itemedit&amp;itemid={$current->inumber}'>"
                 . _LISTS_EDIT . "</a>";
            echo " / <a href='index.php?action=itemmove&amp;itemid={$current->inumber}'>"
                 . _LISTS_MOVE . "</a>";
            global $manager;
            $cloneUrl = $manager->addTicketToUrl($CONF['AdminURL']
                                                 . 'index.php?action=itemclone&itemid='
                                                 . $current->inumber);
            echo " / <a href='{$cloneUrl}'>" . _LISTS_CLONE . "</a>";
            echo " / <a href='index.php?action=itemdelete&amp;itemid={$current->inumber}'>"
                 . _LISTS_DELETE . "</a><br />";
            printf(" <a href='%s' target=\"_blank\">%s</a><br />",
                createItemLink($current->inumber), _LISTS_VIEW);
            // evaluate amount of comments for the item
            $camount = $COMMENTS->amountComments();
            if ($camount > 0) {
                echo "<a href='index.php?action=itemcommentlist&amp;itemid=$current->inumber'>";
                echo "( " . sprintf(_LIST_ITEM_COMMENTS,
                        $COMMENTS->amountComments()) . " )</a>";
            } else {
                echo _LIST_ITEM_NOCONTENT;
            }
            echo "</td>";
            break;
    }
}

// for batch operations: generates the index numbers for checkboxes
function listplug_nextBatchId()
{
    static $id = 0;

    return $id++;
}

function listplug_table_commentlist($template, $type)
{
    static $amountComments = array();
    global $action;

    $colspan = 3;
    if ($action == 'blogcommentlist') {
        $colspan++;
    }

    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_INFO . "</th><th>" . _LIST_COMMENT
                 . "</th><th colspan='" . $colspan . "'>" . _LISTS_ACTIONS
                 . "</th>";
            break;
        case 'BODY':
            global $member;
            $current = $template['current'];
            $current->ctime
                     = strtotime($current->ctime);    // string -> unix timestamp
            if ( ! isset($current->is_badmin) || $current->is_badmin) {
                $show_action_link                 = 1;
                $show_action_link_itemcommentlist = ($action
                                                     == 'blogcommentlist');
            } else {
                $current->iauthor                 = intval($current->iauthor);
                $current->cmember                 = intval($current->cmember);
                $show_action_link                 = ($current->cmember
                                                     == $member->id)
                                                    || ($current->iauthor
                                                        == $member->id);
                $show_action_link_itemcommentlist = ($action
                                                     == 'blogcommentlist')
                                                    && ($current->iauthor
                                                        == $member->id);
            }

            echo '<td>';
            echo date("Y-m-d@H:i", $current->ctime);
            echo '<br />';
            if ($current->mname) {
                echo hsc($current->mname), ' ', _LIST_COMMENTS_MEMBER;
            } else {
                echo hsc($current->cuser);
            }
            if ($current->cmail != '') {
                echo '<br />';
                echo hsc($current->cmail);
            }
            if (isset($current->cemail) && ($current->cemail != '')) {
                echo '<br />';
                echo hsc($current->cemail);
            }
            echo '</td>';

            $current->cbody = strip_tags($current->cbody);
            $current->cbody = hsc(shorten($current->cbody, 300, '...'));

            echo '<td>';
            $id = listplug_nextBatchId();
            if ($show_action_link) {
                echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->cnumber, '" />';
            }
            echo '<label for="batch', $id, '">';
            echo $current->cbody;
            echo '</label>';
            echo '</td>';

            if ($show_action_link) {
                echo "<td style=\"white-space:nowrap\"><a href='index.php?action=commentedit&amp;commentid=$current->cnumber'>"
                     . _LISTS_EDIT . "</a></td>";
                echo "<td style=\"white-space:nowrap\"><a href='index.php?action=commentdelete&amp;commentid=$current->cnumber'>"
                     . _LISTS_DELETE . "</a></td>";
            } else {
                echo "<td style=\"white-space:nowrap\">&nbsp;</td>";
                echo "<td style=\"white-space:nowrap\">&nbsp;</td>";
            }
            if ($template['canAddBan']) {
                echo "<td style=\"white-space:nowrap\"><a href='index.php?action=banlistnewfromitem&amp;itemid=$current->citem&amp;ip=", hsc($current->cip), "' title='", hsc($current->chost), "'>"
                                                                                                                                                                                                . _LIST_COMMENT_BANIP
                                                                                                                                                                                                . "</a></td>";
            }

            // add link
            if ($action == 'blogcommentlist') {
                if ($show_action_link_itemcommentlist) {
                    if ( ! isset($amountComments[$current->citem])) {
                        $COMMENTS = new COMMENTS($current->citem);
                        $amountComments[$current->citem]
                                  = $COMMENTS->amountComments();
                    }
                    echo '<td style=" word-break: break-all">';
                    $s = sprintf('(%d) %s', $amountComments[$current->citem],
                        _LIST_COMMENT_LIST_FOR_ITEM);
                    $s = sprintf(_LIST_BACK_TO, $s);
                    printf('<a href="index.php?action=itemcommentlist&itemid=%d">%s</a></td>'
                        , $current->citem, $s);
                    echo '</td>';
                } else {
                    echo '<td>&nbsp;</td>';
                }
            }
            // end link

            break;
    }
}


function listplug_table_bloglist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _NAME . "</th><th colspan='7'>" . _LISTS_ACTIONS
                 . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo "<td title='blogid:$current->bnumber shortname:$current->bshortname'><a href='$current->burl'><img src='images/globe.gif' width='13' height='13' alt='"
                 . _BLOGLIST_TT_VISIT . "' /></a> " . hsc($current->bname)
                 . "</td>";
            echo "<td><a href='index.php?action=createitem&amp;blogid=$current->bnumber' title='"
                 . _BLOGLIST_TT_ADD . "'>" . _BLOGLIST_ADD . "</a></td>";
            echo "<td><a href='index.php?action=itemlist&amp;blogid=$current->bnumber' title='"
                 . _BLOGLIST_TT_EDIT . "'>" . _BLOGLIST_EDIT . "</a></td>";
            echo "<td><a href='index.php?action=blogcommentlist&amp;blogid=$current->bnumber' title='"
                 . _BLOGLIST_TT_COMMENTS . "'>" . _BLOGLIST_COMMENTS
                 . "</a></td>";

            if ($current->tadmin == 1) {
                echo "<td><a href='index.php?action=blogsettings&amp;blogid=$current->bnumber' title='"
                     . _BLOGLIST_TT_SETTINGS . "'>" . _BLOGLIST_SETTINGS
                     . "</a></td>";
                echo "<td><a href='index.php?action=banlist&amp;blogid=$current->bnumber' title='"
                     . _BLOGLIST_TT_BANS . "'>" . _BLOGLIST_BANS . "</a></td>";
            }

            if ($template['superadmin']) {
                echo "<td><a href='index.php?action=deleteblog&amp;blogid=$current->bnumber' title='"
                     . _BLOGLIST_TT_DELETE . "'>" . _BLOGLIST_DELETE
                     . "</a></td>";
            }


            break;
    }
}

function listplug_table_shortblognames($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _EBLOG_SHORTNAME . "</th><th>" . _EBLOG_NAME
                 . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->bshortname), '</td>';
            echo '<td>', hsc($current->bname), '</td>';

            break;
    }
}

function listplug_table_shortnames($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _NAME . "</th><th>" . _LISTS_DESC . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->name), '</td>';
            echo '<td>', hsc($current->description), '</td>';

            break;
    }
}


function listplug_table_categorylist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_NAME . "</th>"
                 . "<th>" . _LISTS_ORDER . "</th>"
                 . "<th>" . _LISTS_ITEM_COUNT . "</th>"
                 . "<th>" . _LISTS_DESC . "</th><th colspan='2'>"
                 . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>';
            $id = listplug_nextBatchId();
            echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->catid, '" />';
            echo '<label for="batch', $id, '">';
            echo hsc($current->cname);
            echo '</label>';
            echo '</td>';

            echo '<td>', hsc($current->corder), '</td>';
            echo '<td>', hsc($current->icount), '</td>';
            echo '<td>', hsc($current->cdesc), '</td>';
            echo "<td><a href='index.php?action=categorydelete&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";
            echo "<td><a href='index.php?action=categoryedit&amp;blogid=$current->cblog&amp;catid=$current->catid' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_EDIT . "</a></td>";

            break;
    }
}


function listplug_table_templatelist($template, $type)
{
    global $manager;
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_NAME . "</th><th>" . _LISTS_DESC
                 . "</th><th colspan='3'>" . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo "<td>", hsc($current->tdname), "</td>";
            echo "<td>", hsc($current->tddesc), "</td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templateedit&amp;templateid=$current->tdnumber' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_EDIT . "</a></td>";

            $url
                = $manager->addTicketToUrl('index.php?action=templateclone&templateid='
                                           . intval($current->tdnumber));
            echo "<td style=\"white-space:nowrap\"><a href='", hsc($url), "' tabindex='"
                                                                          . $template['tabindex']
                                                                          . "'>"
                                                                          . _LISTS_CLONE
                                                                          . "</a></td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templatedelete&amp;templateid=$current->tdnumber' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";

            break;
    }
}

function listplug_table_skinlist($template, $type)
{
    global $CONF, $DIR_SKINS, $manager, $DB_DRIVER_NAME;
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_NAME . "</th><th>" . _LISTS_DESC
                 . "</th><th colspan='3'>" . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>';

            // use a special style for the default skin
            if ($current->sdnumber == $CONF['BaseSkin']) {
                echo '<strong>', hsc($current->sdname), '</strong>';
            } else {
                echo hsc($current->sdname);
            }

            echo '<br /><br />';
            echo _LISTS_TYPE, ': ', hsc($current->sdtype);
            echo '<br />', _LIST_SKINS_INCMODE, ' ', (($current->sdincmode
                                                       == 'skindir')
                ? _PARSER_INCMODE_SKINDIR : _PARSER_INCMODE_NORMAL);
            if ($current->sdincpref) {
                echo '<br />', _LIST_SKINS_INCPREFIX, ' ', hsc($current->sdincpref);
            }

            // add preview image when present
            if ($current->sdincpref
                && @ is_file($DIR_SKINS . $current->sdincpref
                             . 'preview.png')) {
                echo '<br /><br />';

                $hasEnlargement = @ is_file($DIR_SKINS . $current->sdincpref
                                            . 'preview-large.png');
                if ($hasEnlargement) {
                    echo '<a href="', $CONF['SkinsURL'], hsc($current->sdincpref), 'preview-large.png" title="'
                                                                                   . _LIST_SKIN_PREVIEW_VIEWLARGER
                                                                                   . '">';
                }

                $imgAlt = sprintf(_LIST_SKIN_PREVIEW, hsc($current->sdname));
                echo '<img class="skinpreview" src="', $CONF['SkinsURL'], hsc($current->sdincpref), 'preview.png" width="100" height="75" alt="'
                                                                                                    . $imgAlt
                                                                                                    . '" />';

                if ($hasEnlargement) {
                    echo '</a>';
                }

                if (@ is_file($DIR_SKINS . $current->sdincpref
                              . 'readme.html')) {
                    $url         = $CONF['SkinsURL'] . hsc($current->sdincpref)
                                   . 'readme.html';
                    $readmeTitle = sprintf(_LIST_SKIN_README,
                        hsc($current->sdname));
                    echo '<br /><a href="' . $url . '" title="' . $readmeTitle
                         . '">' . _LIST_SKIN_README_TXT . '</a>';
                }
            }

            echo "</td>";


            echo "<td>", hsc($current->sddesc);
            echo '<div style="height: auto; width: 100%; overflow: auto; max-height: 250px;">';
            // show list of defined parts
            if ($DB_DRIVER_NAME == 'mysql') {
                $order
                    = " ORDER BY FIELD(stype, 'member', 'imagepopup', 'error', 'search', 'archive', 'archivelist', 'item', 'index') DESC, stype ASC";
            } else {
                $tmp_items = array(
                    'member',
                    'imagepopup',
                    'error',
                    'search',
                    'archive',
                    'archivelist',
                    'item',
                    'index',
                );
                $tmp_ct    = count($tmp_items);
                $order     = "";
                for ($i = 0; $i < $tmp_ct; $i++) {
                    $order .= sprintf(" WHEN '%s' THEN %d", $tmp_items[$i],
                        $tmp_ct - $i);
                } // DESC
                $order = " ORDER BY CASE stype ${order} END , stype ASC";
            }
            $has_spartstype = sql_existTableColumnName(sql_table('skin'),
                'spartstype');
            $sql            = sprintf("SELECT stype FROM `%s` WHERE sdesc=%d ",
                sql_table('skin'), $current->sdnumber);
            if ($has_spartstype) {
                $sql .= " AND spartstype='parts' ";
            }
            $sql   .= $order;
            $r     = sql_query($sql);
            $types = array();
            $parts = array(array(), array());
            while ($o = sql_fetch_object($r)) {
                $types[] = $o->stype;
            }
            if (count($types) > 0) {
                $friendlyNames = SKIN::getFriendlyNames();
                for ($i = 0; $i < count($types); $i++) {
                    $type = $types[$i];
                    if (in_array($type,
                        array(
                            'index',
                            'item',
                            'archivelist',
                            'archive',
                            'search',
                            'error',
                            'member',
                            'imagepopup',
                        ))) {
                        $parts[0][] = '<li>' . helpHtml('skinpart' . $type)
                                      . ' <a href="index.php?action=skinedittype&amp;skinid='
                                      . $current->sdnumber . '&amp;type='
                                      . $type . '" tabindex="'
                                      . $template['tabindex'] . '">'
                                      . htmlspecialchars($friendlyNames[$type])
                                      . "</a></li>";
                    } else {
                        $parts[1][] = '<li>' . helpHtml('skinpartspecial')
                                      . ' <a href="index.php?action=skinedittype&amp;skinid='
                                      . $current->sdnumber . '&amp;type='
                                      . $type . '" tabindex="'
                                      . $template['tabindex'] . '">'
                                      . htmlspecialchars($friendlyNames[$type])
                                      . "</a></li>";
                    }
                }
                if (count($parts[0]) > 0) {
                    echo _SKIN_PARTS_TITLE . ' <ul>' . implode($parts[0])
                         . '</ul>';
                }
                if (count($parts[1])
                    > 0) //                    echo _SKIN_PARTS_SPECIAL . ' <ul>'.implode($parts[1]).'</ul>';
                {
                    printf("<div style='display: inline-block; vertical-align: top; padding-left: 20px;'>%s</div>",
                        _SKIN_PARTS_SPECIAL . ' <ul>' . implode($parts[1])
                        . '</ul>');
                }
            }
            // skin page
            $sql
                = sprintf("SELECT stype FROM `%s` WHERE sdesc=%d AND spartstype='specialpage' ",
                    sql_table('skin'),
                    $current->sdnumber) . $order;
            if ($has_spartstype) {
                $res = sql_query($sql);
            } else {
                $res = false;
            }
            $names = array();
            if ($has_spartstype && $res) {
                while ($o = sql_fetch_object($res)) {
                    $names[] = $o->stype;
                }
            }
            if (count($names) > 0) {
                printf("<div style='display: inline-block; vertical-align: top; padding-left: 20px;'>%s",
                    _SKIN_PARTS_SPECIAL_PAGE);
                echo "<ul>";
                for ($i = 0; $i < count($names); $i++) {
                    // todo: edit link ?
                    $editurl
                        = sprintf('index.php?action=skinedittype&amp;skinid=%d&amp;partstype=specialpage&amp;type=%s',
                        $current->sdnumber, $names[$i]);
                    printf("<li>%s <a href='%s' tabindex='%d'>%s</a></li>",
                        helpHtml('skinpartspecialpage'), $editurl,
                        $template['tabindex'], escapeHTML($names[$i]));
                }
                echo "</ul>";
                echo "</div>";
            }


            echo '</div>';
            echo "</td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skinedit&amp;skinid=$current->sdnumber' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_EDIT . "</a></td>";

            $url = $manager->addTicketToUrl('index.php?action=skinclone&skinid='
                                            . intval($current->sdnumber));
            echo "<td style=\"white-space:nowrap\"><a href='", hsc($url), "' tabindex='"
                                                                          . $template['tabindex']
                                                                          . "'>"
                                                                          . _LISTS_CLONE
                                                                          . "</a></td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skindelete&amp;skinid=$current->sdnumber' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";

            break;
    }
}

function listplug_table_draftlist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_BLOG . "</th><th>" . _LISTS_TITLE
                 . "</th><th colspan='2'>" . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->bshortname), '</td>';
            echo '<td>', hsc(strip_tags($current->ititle)), '</td>';
            echo "<td><a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"
                 . _LISTS_EDIT . "</a></td>";
            echo "<td><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"
                 . _LISTS_DELETE . "</a></td>";

            break;
    }
}

function listplug_table_otherdraftlist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _LISTS_BLOG . "</th><th>" . _LISTS_TITLE . "</th><th>"
                 . _LISTS_AUTHOR . "</th><th colspan='2'>" . _LISTS_ACTIONS
                 . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->bshortname), '</td>';
            echo '<td>', hsc(strip_tags($current->ititle)), '</td>';
            echo '<td>', hsc($current->mname), '</td>';
            echo "<td><a href='index.php?action=itemedit&amp;itemid=$current->inumber'>"
                 . _LISTS_EDIT . "</a></td>";
            echo "<td><a href='index.php?action=itemdelete&amp;itemid=$current->inumber'>"
                 . _LISTS_DELETE . "</a></td>";

            break;
    }
}

function listplug_table_actionlist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo '<th>' . _LISTS_TIME . '</th><th>' . _LIST_ACTION_MSG
                 . '</th>';
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->timestamp), '</td>';
            echo '<td>', hsc($current->message), '</td>';

            break;
    }
}

function listplug_table_banlist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo '<th>' . _LIST_BAN_IPRANGE . '</th><th>' . _LIST_BAN_REASON
                 . '</th><th>' . _LISTS_ACTIONS . '</th>';
            break;
        case 'BODY':
            $current = $template['current'];

            echo '<td>', hsc($current->iprange), '</td>';
            echo '<td>', hsc($current->reason), '</td>';
            echo "<td><a href='index.php?action=banlistdelete&amp;blogid=", intval($current->blogid), "&amp;iprange=", hsc($current->iprange), "'>", _LISTS_DELETE, "</a></td>";
            break;
    }
}

function listplug_table_systemloglist($template, $type)
{
    $lines = array();
    switch ($type) {
        case 'HEAD':
            $lines[] = '<th>' . _LISTS_TIME . '</th>';
            //            $lines[] =  '<th>logyear<br />logid</th>';
            //            $lines[] =  '<th>logtype<br />subtype</th>';
            $lines[] = '<th>' . _LIST_ACTION_MSG . '</th>';
            break;
        case 'BODY':
            $current    = $template['current'];
            $local_time = date('Y-m-d H:i:s',
                strtotime($current->timestamp_utc . ' UTC'));
            $lines[]    = '<td>' . hsc($local_time) . '</td>';
            //            $lines[] = sprintf('<td>%s<br />%s</td>', hsc($current->logyear), hsc($current->logid));
            //            $lines[] = sprintf('<td>%s<br />%s</td>', hsc($current->logtype), hsc($current->subtype));
            $lines[] = sprintf('<td>%s</td>',
                hsc(substr($current->message, 0, 300)));

            break;
    }
    echo implode("\n", $lines);
}
