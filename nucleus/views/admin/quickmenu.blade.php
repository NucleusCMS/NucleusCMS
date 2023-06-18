<div id="quickmenu">
@if($IsIntroMenu)
   <h2>{{ _QMENU_INTRO }}</h2>{!! _QMENU_INTRO_TEXT !!}
@elseif($IsActivationMenu)
   <h2>{{ _QMENU_ACTIVATE }}</h2>{!! _QMENU_ACTIVATE_TEXT !!}
@endif

@if($IsLoggedinMenu)
    <ul>
        <li><a href="index.php?action=overview">{{ _QMENU_HOME }}</a></li>
    </ul>

    <h2>{{ _QMENU_ADD }}</h2>
    <form method="get" action="index.php"><div>
        <input type="hidden" name="action" value="createitem" />
        @php
            $showAll = \requestVar('showall');
            if (($member->isAdmin()) && ('yes' == $showAll)) {
                // Super-Admins have access to all blogs! (no add item support though)
                $query = sprintf("SELECT bnumber as value, bname as text FROM %s ORDER BY bname", sql_table('blog'));
            } else {
                $query = sprintf("SELECT bnumber as value, bname as text FROM %s, %s WHERE tblog=bnumber and tmember=%s ORDER BY bname", sql_table('blog'), sql_table('team'), $member->getID());
            }
            $template['name']       = 'blogid';
            $template['tabindex']   = 15000;
            $template['extra']      = _QMENU_ADD_SELECT;
            $template['selected']   = -1;
            $template['shorten']    = 10;
            $template['shortenel']  = '';
            $template['javascript'] = 'onchange="return form.submit()"';
            showlist_by_query($query, 'select', $template);
        @endphp
        </div></form>

        <h2 class="accordion">{{ $member->getDisplayName() }}</h2>
        <ul id="qmenu_own">
            <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=overview">{{ _QMENU_USER_HOME }}</a></li>
            <li><a href="index.php?action=browseownitems">{{ _QMENU_USER_ITEMS }}</a></li>
            <li><a href="index.php?action=browseowncomments">{{ _QMENU_USER_COMMENTS }}</a></li>
            <li><a href="index.php?action=editmembersettings">{{ _QMENU_USER_SETTINGS }}</a></li>
        </ul>

    @if ($member->isAdmin())
        <h2 class="accordion">{{ _QMENU_MANAGE }}</h2>

        <ul id="qmenu_manage">
            <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=manage">{{ _OVERVIEW_MANAGE }}</a></li>
            <li><a href="index.php?action=usermanagement">{{ _QMENU_MANAGE_MEMBERS }}</a></li>
            <li><a href="index.php?action=createnewlog">{{ _QMENU_MANAGE_NEWBLOG }}</a></li>
        @if ($IsMysql)
            <li><a href="index.php?action=backupoverview">{{ _QMENU_MANAGE_BACKUPS }}</a></li>
        @endif
            <li><a href="index.php?action=pluginlist">{{ _QMENU_MANAGE_PLUGINS }}</a></li>
        </ul>

        <h2 class="accordion">{{ _QMENU_LAYOUT }}</h2>
        <ul id="qmenu_layuot">
            <li><a href="index.php?action=skinoverview">{{ _QMENU_LAYOUT_SKINS }}</a></li>
            <li><a href="index.php?action=templateoverview">{{ _QMENU_LAYOUT_TEMPL }}</a></li>
            <li><a href="index.php?action=skinieoverview">{{ _QMENU_LAYOUT_IEXPORT }}</a></li>
        </ul>
    @endif

        @php
            $aPluginExtras = [];
            $param         = [
                'options' => &$aPluginExtras,
            ];
            $manager->notify('QuickMenu', $param);
        @endphp
        
        @if (count($aPluginExtras) > 0)
            <h2 class="accordion">{{ _QMENU_PLUGINS }}</h2>
            <ul id="qmenu_plugins">
            @foreach ($aPluginExtras as $aInfo)
                <li><a href="{{ $aInfo['url'] }}" title="{{ $aInfo['tooltip'] }}">{{ $aInfo['title'] }}</a></li>
            @endforeach
            </ul>
        @endif

@endif
</div> <!-- content / quickmenu container -->
