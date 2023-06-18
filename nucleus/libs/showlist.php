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
    if (0 == count($query)) {
        return 0;
    }

    call_user_func("listplug_{$type}", $template, 'HEAD');

    foreach ($query as $currentObj) {
        $template['current'] = $currentObj;
        if (isset($template['current']->burl)
            && 0 == strlen($template['current']->burl)
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
    if (isset($template['tabindex'])) {
        ADMIN::getTabIndex(max(0, (int) $template['tabindex'] - 1));
    }

    // don't do anything if there are no results
    $numrows = 0;

    call_user_func("listplug_{$type}", $template, 'HEAD');

    while ($template['current'] = sql_fetch_object($res)) {
        $numrows++;
        if (isset($template['current']->burl)
            && 0 == strlen($template['current']->burl)
            && isset($template['current']->bnumber)) {
            $template['current']->burl
                = createBlogidLink($template['current']->bnumber);
        }
        // unset values : Protect password ...
        foreach (['mpassword', 'mcookiekey','mtoken'] as $key) {
            if (property_exists($template['current'], $key)) {
                unset($template['current']->$key);
            }
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
    if ('HEAD' == $type) {
        $ph['name']       = ifset($template['name']);
        $ph['tabindex']   = ifset($template['tabindex']);
        $ph['javascript'] = ifset($template['javascript']);
        $ph['extra']      = ifset($template['extra']);
        $ph['extraval']   = ifset($template['extraval']);
        echo parseHtml(
            '<select name="{%name%}" tabindex="{%tabindex%}" {%javascript%}>',
            $ph
        );

        if ($ph['extra']) {
            echo parseHtml(
                '<option value="{%extraval%}">{%extra%}</option>',
                $ph
            );
        }
    } elseif ('BODY' == $type) {
        $current        = $template['current'];
        $ph             = [];
        $ph['value']    = $current->value;
        $ph['selected'] = (isset($template['selected'])
                           && $template['selected'] == $current->value)
            ? 'selected' : '';
        if (isset($template['shorten']) && $template['shorten'] > 0) {
            $ph['text'] = shorten(
                $current->text,
                $template['shorten'],
                $template['shortenel']
            );
            $ph['title'] = $current->value;
        } else {
            $ph['text']  = $current->text;
            $ph['title'] = '';
        }
        echo parseHtml(
            '<option value="{%value:hsc%}" {%selected%} title="{%title:hsc%}">{%text:hsc%}</option>',
            $ph
        );
    } elseif ('FOOT' == $type) {
        echo '</select>';
    }
}

function listplug_table($template, $type)
{
    $content   = $template['content'];
    $func_name = "listplug_table_" . $template['content'];
    switch ($type) {
        case 'HEAD':
            printf("<table class='%s'><thead><tr>\n", escapeHTML(strtolower($content)));
            echo call_user_func($func_name, $template, $type) ?? '';
            echo "</tr></thead><tbody>";
            break;
        case 'BODY':
            echo '<tr onmouseover="focusRow(this);" onmouseout="blurRow(this);">';
            echo call_user_func($func_name, $template, $type) ?? '';
            echo "</tr>";
            break;
        case 'FOOT':
            echo call_user_func($func_name, $template, $type) ?? '';
            echo "</tbody></table>";
            break;
    }
}

function listplug_table_memberlist($template, $type)
{
    global $member;

    $params = [
       'member'   => $member,
       'template' => $template,
       'type'     => $type,
       'current'  => $template['current'] ?? null,
    ];

    echo \parseBlade('admin.showlist.listplug_table_memberlist', $params), "\n";
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
            echo "<td><a href='index.php?action=teamdelete&amp;memberid={$current->tmember}&amp;blogid={$current->tblog}' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";

            $url = 'index.php?action=teamchangeadmin&memberid='
                   . (int) ($current->tmember) . '&blogid='
                   . (int) ($current->tblog);
            $url = $manager->addTicketToUrl($url);
            echo "<td><a href='", hsc($url), "' tabindex='"
                                             . $template['tabindex'] . "'>"
                                             . _LIST_TEAM_CHADMIN . "</a></td>";
            break;
    }
}

function listplug_table_pluginlist($template, $type)
{
    static $enable_remote_update = null;
    global $manager, $member;
    switch ($type) {
        case 'HEAD':
            echo '<th>' . _LISTS_INFO . '</th><th>' . _LISTS_DESC . '</th>';
            echo '<th style="white-space:nowrap">' . _LISTS_ACTIONS . '</th>';
            break;
        case 'BODY':
            if (null === $enable_remote_update) {
                $enable_remote_update = CONF::asBool('ENABLE_PLUGIN_UPDATE_CHECK') && (int) $member->getOption('system', 'enable_remote_update', '1');
            }
            $current = $template['current'];

            $np_name = $current->pfile;
            // [Note] : Waking up a buggy plugin may cause a hang
            $plug = & $manager->getPlugin($np_name);
            if ($plug) {
                $canRemoteDownload = $enable_remote_update && ADMIN::canRemoteDownload($np_name);
                echo '<td>';
                echo '<strong>', hsc($plug->getName()), '</strong><br />';
                if ('Undefined' !== $plug->getAuthor()) {
                    echo _LIST_PLUGS_AUTHOR, ' ', hsc($plug->getAuthor()), '<br />';
                }
                echo _LIST_PLUGS_VER, ' ', hsc($plug->getVersion()), '<br />';
                $getURL = $canRemoteDownload ? 'https://github.com/NucleusCMS/' . $plug->getClassName() : $plug->getURL();
                if ($getURL && 'Undefined' !== $getURL) {
                    printf('<a href="%s" tabindex="%d"', hsc($getURL), $template['tabindex']);
                    printf(' target="_blank" rel="noreferrer">%s</a>', _LIST_PLUGS_SITE);
                }
                echo '</td>';

                echo '<td>';
                // check plugin dir
                global $DIR_PLUGINS;
                if (2 === $plug->plugin_dir_type
                   && (@is_file("{$DIR_PLUGINS}{$np_name}.php") || @is_dir($DIR_PLUGINS.$np_name))
                ) {
                    echo "<div style='float: left'><strong style='color: red'>"
                         . escapeHTML(_ADMIN_TEXT_CONFLICT_DELETE_OLD_PLUGIN)
                         . "</strong><br /><ul>";
                    if (@is_file("{$DIR_PLUGINS}{$np_name}.php")) {
                        printf("<li>%s<br />(%s)</li>", escapeHTML("{$np_name}.php"), escapeHTML($DIR_PLUGINS.$np_name.'php'));
                    }
                    if (@is_dir($DIR_PLUGINS.$np_name)) {
                        printf("<li>%s<br />(%s)</li>", escapeHTML($np_name), escapeHTML($DIR_PLUGINS.$np_name));
                    }

                    echo "</ul></div>";
                }
                if ($enable_remote_update) {
                    // plugin update check
                    $update_info = $plug->checkRemoteUpdate();
                    if ($update_info['result']) {
                        echo "<div style='float: left'><strong style='color: red'>"
                             . hsc(_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE)
                             . "</strong><br />";
                        echo "Latest version: " . hsc($update_info['version'])
                             . "<br /></div>";
                        if (class_exists('ZipArchive') && $canRemoteDownload) {
                            // リモートからダウンロード
                            echo "<form method='post' action='index.php'><div style='float: right'>\n";
                            echo "  <input type='hidden' name='action' value='plugindownload' />\n";
                            printf("  <input type='hidden' name='pluginname' value='%s' />\n", escapeHTML($np_name));
                            echo "  " . $manager->getHtmlInputTicketHidden() . "\n";
                            echo sprintf("  <input type='submit' tabindex='40' value='%s' />\n", _ADMIN_TEXT_REMOTE_AUTO_UPDATE);
                            echo "</div></form>\n";
                        } else {
                            if ( ! empty($update_info['download'])) {
                                echo '<div style="float: left; padding: 1.5em 1em;">Get URL : ';
                                printf(
                                    '<a href="%s" target="_blank" rel="noreferrer">%s</a></div><br />',
                                    hsc($update_info['download']),
                                    hsc($update_info['download'])
                                );
                            }
                        }
                        echo "<br style='clear:both' /><br />";
                    }
                }
                // plugin Description
                echo "<div style='float: left;'>";
                echo hsc($plug->getDescription());
                $pl_event_list = $plug->_getEventList();
                if (count($pl_event_list) > 0) {
                    echo '<br /><br />', _LIST_PLUGS_SUBS, '<br />', hsc(implode(
                        ', ',
                        $pl_event_list
                    ));
                    // check the database to see if it is up-to-date and notice the user if not
                }
                if ( ! $plug->subscribtionListIsUptodate()) {
                    echo '<br /><br /><strong>', _LIST_PLUG_SUBS_NEEDUPDATE, '</strong>';
                }
                if (count($plug->getPluginDep()) > 0) {
                    echo '<br /><br />', _LIST_PLUGS_DEP, '<br />', hsc(implode(
                        ', ',
                        $plug->getPluginDep()
                    ));
                }
                // <add by shizuki>
                // check dependency require
                $req = [];
                $res = sql_query('SELECT pfile FROM ' . sql_table('plugin'));
                while ($o = sql_fetch_object($res)) {
                    $preq = &$manager->getPlugin($o->pfile);
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
                echo '</div></td>';
            } else {
                echo '<td colspan="2">' . sprintf(
                    _PLUGINFILE_COULDNT_BELOADED,
                    hsc($current->pfile)
                ) . '</td>';
            }
            echo '<td style="white-space:nowrap;">';

            $baseUrl = 'index.php?plugid=' . (int) ($current->pid) . '&action=';
            $url     = $manager->addTicketToUrl($baseUrl . 'pluginup');
            echo "<a href='", hsc($url), "' tabindex='" . $template['tabindex']
                                         . "'>", _LIST_PLUGS_UP, "</a>";
            $url = $manager->addTicketToUrl($baseUrl . 'plugindown');
            echo " | <a href='", hsc($url), "' tabindex='"
                                            . $template['tabindex']
                                            . "'>", _LIST_PLUGS_DOWN, "</a>";
            echo "<br /><a href='index.php?action=plugindelete&amp;plugid={$current->pid}' tabindex='"
                 . $template['tabindex'] . "'>", _LIST_PLUGS_UNINSTALL, "</a>";
            if ($plug && ($plug->hasAdminArea() > 0)) {
                // NOTE: MARKER_PLUGINS_PLUGINADMIN_FUEATURE
                if ($plug->supportsFeature('pluginadmin')) {
                    $url = $manager->addTicketToUrl($baseUrl . 'pluginadmin');
                    printf(
                        "<br /><a href='%s' tabindex='%s'>%s</a>",
                        $url,
                        $template['tabindex'],
                        _LIST_PLUGS_ADMIN
                    );
                } elseif (CONF::asBool('ENABLE_PLUGIN_ADMIN_V1', true)) {
                    echo "<br /><a href='" . hsc($plug->getAdminURL())
                         . "'  tabindex='" . $template['tabindex']
                         . "'>", _LIST_PLUGS_ADMIN, "</a>";
                }
            }
            if ($plug && ($plug->supportsFeature('HelpPage') > 0)) {
                echo "<br /><a href='index.php?action=pluginhelp&amp;plugid={$current->pid}'  tabindex='"
                     . $template['tabindex'] . "'>", _LIST_PLUGS_HELP, "</a>";
            }
            if (quickQuery('SELECT COUNT(*) AS result FROM '
                           . sql_table('plugin_option_desc')
                           . ' WHERE ocontext=\'global\' and opid='
                           . $current->pid) > 0) {
                echo "<br /><a href='index.php?action=pluginoptions&amp;plugid={$current->pid}'  tabindex='"
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
    if ( ! array_key_exists('access', $meta) || 'hidden' != $meta['access']) {
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
                    && 'readonly' == $meta['access']) {
                    echo ' readonly="readonly"';
                }
                echo '>', hsc($current['value']), '</textarea>';
                break;
            case 'text':
            default:
                //$meta = NucleusPlugin::getOptionMeta($current['typeinfo']);

                echo '<input type="text" size="40" maxlength="128" name="', hsc($varname), '" value="', hsc($current['value']), '"';
                if (array_key_exists('datatype', $meta)
                    && 'numerical' == $meta['datatype']) {
                    echo ' onkeyup="checkNumeric(this)" onblur="checkNumeric(this)"';
                }
                if (array_key_exists('access', $meta)
                    && 'readonly' == $meta['access']) {
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
    global $CONF, $manager;
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

            if (1 == $current->idraft) {
                $cssclass = "class='draft'";
            }

            // (can't use offset time since offsets might vary between blogs)
            if ($current->itime > $template['now']) {
                $cssclass = "class='future'";
            }

            $action = requestVar('action');
            $style  = ('pluginlist' !== $action) ? 'style="white-space:nowrap"'
                : '';
            echo "<td {$cssclass} {$style}>";
            if ('itemlist' !== $action) {
                echo _LIST_ITEM_BLOG . ' ' . hsc($current->bshortname)
                     . '<br />';
            }
            echo _LIST_ITEM_CAT . ' ' . hsc($current->cname) . '<br />';
            if ('browseownitems' !== $action) {
                echo _LIST_ITEM_AUTHOR . ' ' . hsc($current->mname) . '<br />';
            }
            if ($current->itime) {
                echo date('Y-m-d', $current->itime) . ' ' . date(
                    'H:i',
                    $current->itime
                );
            } else {
                echo '0000-00-00 00:00';
            }
            echo "</td>";

            // Title and Body
            echo "<td {$cssclass}>";

            $id = listplug_nextBatchId();

            echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->inumber, '" />';
            echo '<label for="batch', $id, '">';
            echo "<b>" . hsc(strip_tags($current->ititle)) . "</b>";
            echo '</label>';
            echo "<br />";

            $current->ibody = strip_tags($current->ibody);
            $current->ibody = hsc(shorten($current->ibody, 300, '...'));

            $COMMENTS = new COMMENTS($current->inumber);
            echo "{$current->ibody}</td>";

            $style0 = 'float:left; display: inline-block; padding: 0.5em;';
            $style1 = "white-space:nowrap; {$style0}";
            $style2 = "word-break: break-all; {$style0}";

            // [Action]
            echo "<td {$cssclass}>";
            // echo "<td  style=\"white-space:nowrap\" {$cssclass}>";

            $elements   = [];
            $elements[] = [sprintf("index.php?action=itemedit&amp;itemid=%d", $current->inumber), _LISTS_EDIT];
            $elements[] = [sprintf("index.php?action=itemmove&amp;itemid=%d", $current->inumber), _LISTS_MOVE];

            // Clone
            $cloneUrl = $manager->addTicketToUrl($CONF['AdminURL']
                                                 . 'index.php?action=itemclone&itemid='
                                                 . $current->inumber);
            $elements[] = [$cloneUrl, _LISTS_CLONE];

            // Delete
            $elements[] = [sprintf("index.php?action=itemdelete&amp;itemid=%d", $current->inumber), _LISTS_DELETE];

            // View
            $elements[] = [createItemLink($current->inumber), _LISTS_VIEW];

            // Comments
            $camount = $COMMENTS->amountComments();
            if ($camount > 0) {
                $elements[] = [sprintf("index.php?action=itemcommentlist&amp;itemid=%d", $current->inumber),
                            sprintf(_LIST_ITEM_COMMENTS, $COMMENTS->amountComments()),
                    ];
            } else {
                $elements[] = ['', _LIST_ITEM_NOCONTENT];
            }

            // Output
            foreach ($elements as $element) {
                $style = $style1;
                if (empty($element[0])) {
                    $style = $style2;
                    printf('<div style="%s">%s</div>', $style, escapeHTML($element[1]));
                    continue;
                }
                if (str_contains($element[0], 'itemcommentlist')) {
                    $style = $style2;
                }
                if (_LISTS_VIEW === $element[1]) {
                    echo "<br style='clear: both;' />";
                    printf('<div style="%s"><a href="%s" target="_blank">%s</a></div>', $style, $element[0], escapeHTML($element[1]));
                } else {
                    printf('<div style="%s"><a href="%s">%s</a></div>', $style, $element[0], escapeHTML($element[1]));
                }
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
    static $amountComments = [];
    global $action, $manager;

    switch ($type) {
        case 'HEAD':
            printf(
                '<th>%s</th><th style="min-width: 30%%">%s</th><th>%s</th>',
                _LISTS_INFO,
                _LIST_COMMENT,
                _LISTS_ACTIONS
            );
            break;
        case 'BODY':
            global $member;
            $current = $template['current'];
            $current->ctime
                     = strtotime($current->ctime);    // string -> unix timestamp
            if ( ! isset($current->is_badmin) || $current->is_badmin) {
                $show_action_link                 = 1;
                $show_action_link_itemcommentlist = ('blogcommentlist'
                                                     == $action);
            } else {
                $current->iauthor = (int) ($current->iauthor);
                $current->cmember = (int) ($current->cmember);
                $show_action_link = ($current->cmember
                                                     == $member->id)
                                                    || ($current->iauthor
                                                        == $member->id);
                $show_action_link_itemcommentlist = ('blogcommentlist'
                                                     == $action)
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
            if ('' != $current->cmail) {
                echo '<br />';
                echo hsc($current->cmail);
            }
            if (isset($current->cemail) && ('' != $current->cemail)) {
                echo '<br />';
                echo hsc($current->cemail);
            }
            echo '</td>';

            $current->cbody = strip_tags($current->cbody);
            $current->cbody = hsc(shorten($current->cbody, 300, '...'));

            echo '<td><div style="display: inline-block;white-space: nowrap;">';
            $id = listplug_nextBatchId();
            if ($show_action_link) {
                echo '<input type="checkbox" id="batch', $id, '" name="batch[', $id, ']" value="', $current->cnumber, '" />';
            }
            echo '<label for="batch', $id, '">';
            printf(' ID[%d]<br />', $current->cnumber);
            echo '</label>';
            echo '</div><div>';
            echo $current->cbody;
            echo '</div></td>';

            echo '<td><div>';
            $style0 = 'float:left; display: inline-block; padding: 0.5em;';
            $style1 = "white-space:nowrap; {$style0}";
            $style2 = "word-break: break-all; {$style0}";
            if ($show_action_link) {
                echo "<div style=\"{$style1}\"><a href='index.php?action=commentedit&amp;commentid={$current->cnumber}'>"
                     . _LISTS_EDIT . "</a></div>";
                echo "<div style=\"{$style1}\"><a href='index.php?action=commentdelete&amp;commentid={$current->cnumber}'>"
                     . _LISTS_DELETE . "</a></div>";
            }
            if ($template['canAddBan']) {
                echo "<div style=\"{$style1}\"><a href='index.php?action=banlistnewfromitem&amp;itemid={$current->citem}&amp;ip=", hsc($current->cip), "' title='", hsc($current->chost), "'>"
                    . _LIST_COMMENT_BANIP
                    . "</a></div>";
            }

            // add link
            if ('blogcommentlist' == $action) {
                if ($show_action_link_itemcommentlist) {
                    global $manager;
                    if ( ! isset($amountComments[$current->citem])) {
                        $COMMENTS = new COMMENTS($current->citem);
                        $amountComments[$current->citem]
                                  = $COMMENTS->amountComments();
                    }
                    echo "<br style='clear: both;' /><hr style='border-style: dashed;'>";
                    echo "<div style=\"{$style2}\">";
                    printf(
                        '<a href="index.php?action=itemcommentlist&itemid=%d">%s</a> (%d) ',
                        $current->citem,
                        escapeHTML(sprintf(_LIST_BACK_TO, _LIST_COMMENT_LIST_FOR_ITEM)),
                        $amountComments[$current->citem]
                    );
                    echo '</div>';
                    echo "<br style='clear: both;' />";
                    echo "<div style=\"{$style2}\">";
                    $item = & $manager->getItem($current->citem, 1, 1);
                    printf(
                        ' %s: %s<br />',
                        escapeHTML(_LISTS_TITLE),
                        escapeHTML($item['title'])
                    );
                    echo '</div>';
                    unset($item);
                }
            }
            // end link
            echo '</div></td>';

            break;
    }
}

function listplug_table_bloglist($template, $type)
{
    switch ($type) {
        case 'HEAD':
            echo "<th>" . _NAME . "</th>";
            echo "<th colspan='2'>" . _LISTS_ACTIONS . "</th>";
            break;
        case 'BODY':
            $current = $template['current'];

            $query = 'SELECT COUNT(*) AS result '
               . ' FROM ' . sql_table('item') . ' AS i'
               . sprintf(' WHERE i.iblog = %d ', (int) ($current->bnumber));
            $blog_amountItems = quickQuery($query);

            $query = 'SELECT COUNT(*) AS result '
               . ' FROM ' . sql_table('comment') . ' AS c'
               . sprintf(' WHERE c.cblog = %d ', (int) ($current->bnumber));
            $blog_amountComments = quickQuery($query);

            // Name
            echo "<td title='blogid:{$current->bnumber} shortname:{$current->bshortname}'><a href='{$current->burl}'><img src='images/globe.gif' width='13' height='13' alt='"
                 . _BLOGLIST_TT_VISIT . "' /></a> " . hsc($current->bname)
                 . "</td>";

            $style0 = 'float:left; display: inline-block; padding: 0.5em;';
            $style1 = "white-space:nowrap; {$style0}";
            //            $style2 = "word-break: break-all; {$style0}";

            // Action
            $elements   = [];
            $elements[] = [sprintf("index.php?action=createitem&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_ADD, _BLOGLIST_ADD]];
            $elements[] = [sprintf("index.php?action=itemlist&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_EDIT, _BLOGLIST_EDIT], " ({$blog_amountItems})"];
            $elements[] = [sprintf("index.php?action=blogcommentlist&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_COMMENTS, _BLOGLIST_COMMENTS], " ({$blog_amountComments})"];

            $Groups   = [$elements];
            $elements = [];

            if (1 == $current->tadmin) {
                $elements[] = [sprintf("index.php?action=blogsettings&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_SETTINGS, _BLOGLIST_SETTINGS]];
                $elements[] = [sprintf("index.php?action=banlist&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_BANS, _BLOGLIST_BANS]];
            }

            if ($template['superadmin']) {
                $elements[] = [sprintf("index.php?action=deleteblog&amp;blogid=%d", $current->bnumber), [_BLOGLIST_TT_DELETE, _BLOGLIST_DELETE]];
            }
            $Groups[] = $elements;

            foreach ($Groups as $elements) {
                echo "<td>";
                // Output
                foreach ($elements as $element) {
                    $style = $style1;
                    printf(
                        '<div style="%s"><a href="%s" title="%s">%s</a>%s</div>',
                        $style,
                        $element[0],
                        escapeHTML($element[1][0]),
                        escapeHTML($element[1][1]),
                        isset($element[2]) ? escapeHTML($element[2]) : ""
                    );
                }
                echo "</td>";
            }
            if (1 === count($Groups)) {
                echo "<td>&nbsp;</td>";
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
            echo "<td><a href='index.php?action=categorydelete&amp;blogid={$current->cblog}&amp;catid={$current->catid}' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";
            echo "<td><a href='index.php?action=categoryedit&amp;blogid={$current->cblog}&amp;catid={$current->catid}' tabindex='"
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
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templateedit&amp;templateid={$current->tdnumber}' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_EDIT . "</a></td>";

            $url
                = $manager->addTicketToUrl('index.php?action=templateclone&templateid='
                                           . (int) ($current->tdnumber));
            echo "<td style=\"white-space:nowrap\"><a href='", hsc($url), "' tabindex='"
                                                                          . $template['tabindex']
                                                                          . "'>"
                                                                          . _LISTS_CLONE
                                                                          . "</a></td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=templatedelete&amp;templateid={$current->tdnumber}' tabindex='"
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
            echo '<br />', _LIST_SKINS_INCMODE, ' ', (('skindir'
                                                       == $current->sdincmode)
                ? _PARSER_INCMODE_SKINDIR : _PARSER_INCMODE_NORMAL);
            if ($current->sdincpref) {
                echo '<br />', _LIST_SKINS_INCPREFIX, ' ', hsc($current->sdincpref);
            }

            // add preview image when present
            if ($current->sdincpref
                && @is_file($DIR_SKINS . $current->sdincpref
                             . 'preview.png')) {
                echo '<br /><br />';

                $hasEnlargement = @is_file($DIR_SKINS . $current->sdincpref
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

                if (@is_file($DIR_SKINS . $current->sdincpref
                              . 'readme.html')) {
                    $url = $CONF['SkinsURL'] . hsc($current->sdincpref)
                                   . 'readme.html';
                    $readmeTitle = sprintf(
                        _LIST_SKIN_README,
                        hsc($current->sdname)
                    );
                    echo '<br /><a href="' . $url . '" title="' . $readmeTitle
                         . '">' . _LIST_SKIN_README_TXT . '</a>';
                }
            }

            echo "</td>";

            echo "<td>", hsc($current->sddesc);
            echo '<div style="height: auto; width: 100%; overflow: auto; max-height: 250px;">';
            // show list of defined parts
            if ('mysql' == $DB_DRIVER_NAME) {
                $order
                    = " ORDER BY FIELD(stype, 'member', 'imagepopup', 'error', 'search', 'archive', 'archivelist', 'item', 'index') DESC, stype ASC";
            } else {
                $tmp_items = [
                    'member',
                    'imagepopup',
                    'error',
                    'search',
                    'archive',
                    'archivelist',
                    'item',
                    'index',
                ];
                $tmp_ct = count($tmp_items);
                $order  = "";
                for ($i = 0; $i < $tmp_ct; $i++) {
                    $order .= sprintf(
                        " WHEN '%s' THEN %d",
                        $tmp_items[$i],
                        $tmp_ct - $i
                    );
                } // DESC
                $order = " ORDER BY CASE stype {$order} END , stype ASC";
            }
            $has_spartstype = sql_existTableColumnName(
                sql_table('skin'),
                'spartstype'
            );
            $sql = sprintf(
                "SELECT stype FROM `%s` WHERE sdesc=%d ",
                sql_table('skin'),
                $current->sdnumber
            );
            if ($has_spartstype) {
                $sql .= " AND spartstype='parts' ";
            }
            $sql .= $order;
            $r     = sql_query($sql);
            $types = [];
            $parts = [[], []];
            while ($o = sql_fetch_object($r)) {
                $types[] = $o->stype;
            }
            if (count($types) > 0) {
                $friendlyNames = SKIN::getFriendlyNames();
                for ($i = 0; $i < count($types); $i++) {
                    $type = $types[$i];
                    if (in_array(
                        $type,
                        [
                            'index',
                            'item',
                            'archivelist',
                            'archive',
                            'search',
                            'error',
                            'member',
                            'imagepopup',
                        ]
                    )) {
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
                    echo _SKIN_PARTS_TITLE . ' <ul>' . implode('', $parts[0])
                         . '</ul>';
                }
                if (count($parts[1])
                    > 0) { //                    echo _SKIN_PARTS_SPECIAL . ' <ul>'.implode($parts[1]).'</ul>';
                    printf(
                        "<div style='display: inline-block; vertical-align: top; padding-left: 20px;'>%s</div>",
                        _SKIN_PARTS_SPECIAL . ' <ul>' . implode('', $parts[1])
                        . '</ul>'
                    );
                }
            }
            // skin page
            $sql
                = sprintf(
                    "SELECT stype FROM `%s` WHERE sdesc=%d AND spartstype='specialpage' ",
                    sql_table('skin'),
                    $current->sdnumber
                ) . $order;
            if ($has_spartstype) {
                $res = sql_query($sql);
            } else {
                $res = false;
            }
            $names = [];
            if ($has_spartstype && $res) {
                while ($o = sql_fetch_object($res)) {
                    $names[] = $o->stype;
                }
            }
            if (count($names) > 0) {
                printf(
                    "<div style='display: inline-block; vertical-align: top; padding-left: 20px;'>%s",
                    _SKIN_PARTS_SPECIAL_PAGE
                );
                echo "<ul>";
                for ($i = 0; $i < count($names); $i++) {
                    // todo: edit link ?
                    $editurl
                        = sprintf(
                            'index.php?action=skinedittype&amp;skinid=%d&amp;partstype=specialpage&amp;type=%s',
                            $current->sdnumber,
                            $names[$i]
                        );
                    printf(
                        "<li>%s <a href='%s' tabindex='%d'>%s</a></li>",
                        helpHtml('skinpartspecialpage'),
                        $editurl,
                        $template['tabindex'],
                        escapeHTML($names[$i])
                    );
                }
                echo "</ul>";
                echo "</div>";
            }

            echo '</div>';
            echo "</td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skinedit&amp;skinid={$current->sdnumber}' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_EDIT . "</a></td>";

            $url = $manager->addTicketToUrl('index.php?action=skinclone&skinid='
                                            . (int) ($current->sdnumber));
            echo "<td style=\"white-space:nowrap\"><a href='", hsc($url), "' tabindex='"
                                                                          . $template['tabindex']
                                                                          . "'>"
                                                                          . _LISTS_CLONE
                                                                          . "</a></td>";
            echo "<td style=\"white-space:nowrap\"><a href='index.php?action=skindelete&amp;skinid={$current->sdnumber}' tabindex='"
                 . $template['tabindex'] . "'>" . _LISTS_DELETE . "</a></td>";

            break;
    }
}

function listplug_table_draftlist($template, $type)
{
    if (empty($template) || empty($template['content']) || empty($type) || ! in_array($type, ['HEAD', 'BODY'])) {
        return;
    }
    $blade_params = [
       'current'     => $template['current'] ?? null,
       'type'        => $type,
       'show_author' => 'otherdraftlist' === $template['content'],
    ];
    echo \parseBlade('admin.showlist.listplug_table_draftlist', $blade_params), "\n";
}

function listplug_table_otherdraftlist($template, $type)
{
    listplug_table_draftlist($template, $type);
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
            echo "<td><div style='overflow-wrap: anywhere; max-height: 10em; overflow: auto;'>", hsc($current->message), '</div></td>';

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
            echo "<td><a href='index.php?action=banlistdelete&amp;blogid=", (int) ($current->blogid), "&amp;iprange=", hsc($current->iprange), "'>", _LISTS_DELETE, "</a></td>";
            break;
    }
}

function listplug_table_systemloglist($template, $type)
{
    $lines = [];
    switch ($type) {
        case 'HEAD':
            $lines[] = '<th>' . _LISTS_TIME . '</th>';
            //            $lines[] =  '<th>logyear<br />logid</th>';
            //            $lines[] =  '<th>logtype<br />subtype</th>';
            $lines[] = '<th>' . _LIST_ACTION_MSG . '</th>';
            break;
        case 'BODY':
            $current    = $template['current'];
            $local_time = date(
                'Y-m-d H:i:s',
                strtotime($current->timestamp_utc . ' UTC')
            );
            $lines[] = '<td>' . hsc($local_time) . '</td>';
            //            $lines[] = sprintf('<td>%s<br />%s</td>', hsc($current->logyear), hsc($current->logid));
            //            $lines[] = sprintf('<td>%s<br />%s</td>', hsc($current->logtype), hsc($current->subtype));
            $lines[] = sprintf(
                '<td>%s</td>',
                hsc(substr($current->message, 0, 300))
            );

            break;
    }
    echo implode("\n", $lines);
}
