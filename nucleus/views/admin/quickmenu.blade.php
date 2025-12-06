<div id="quickmenu" class="quickmenu">
@if($IsIntroMenu)
   <div class="quickmenu-banner">
       <h2>{{ _QMENU_INTRO }}</h2>
       <p>{!! _QMENU_INTRO_TEXT !!}</p>
   </div>
@elseif($IsActivationMenu)
   <div class="quickmenu-banner">
       <h2>{{ _QMENU_ACTIVATE }}</h2>
       <p>{!! _QMENU_ACTIVATE_TEXT !!}</p>
   </div>
@endif

@if($IsLoggedinMenu)
    <section class="quickmenu-section">
        <div class="section-heading">{{ _QMENU_HOME }}</div>
        <ul class="quickmenu-links">
            <li><a href="index.php?action=overview">{{ _QMENU_HOME }}</a></li>
        </ul>
    </section>

    <section class="quickmenu-section">
        <div class="section-heading">{{ _QMENU_ADD }}</div>
        <form method="get" action="index.php" class="quickmenu-form"><div>
            <input type="hidden" name="action" value="createitem" />
            @php
                $showAll = \requestVar('showall');
                if (($member->isAdmin()) && ('yes' == $showAll)) {
                    // Super-Admins have access to all blogs! (no add item support though)
                    $query = sprintf("SELECT bnumber as value, bname as text FROM %s ORDER BY %s", sql_table('blog'), ADMIN::getSqlOrderBlog());
                } else {
                    $query = sprintf("SELECT bnumber as value, bname as text FROM %s, %s WHERE tblog=bnumber and tmember=%s ORDER BY %s", sql_table('blog'), sql_table('team'), $member->getID(), ADMIN::getSqlOrderBlog());
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
    </section>

    <section class="quickmenu-section">
        <div class="section-heading">{{ $member->getDisplayName() }}</div>
        <ul id="qmenu_own" class="quickmenu-links">
            <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=overview">{{ _QMENU_USER_HOME }}</a></li>
            <li><a href="index.php?action=browseownitems">{{ _QMENU_USER_ITEMS }}</a></li>
            <li><a href="index.php?action=browseowncomments">{{ _QMENU_USER_COMMENTS }}</a></li>
            <li><a href="index.php?action=editmembersettings">{{ _QMENU_USER_SETTINGS }}</a></li>
        </ul>
    </section>

    @if ($member->isAdmin())
        <section class="quickmenu-section">
            <div class="section-heading">{{ _QMENU_MANAGE }}</div>

            <ul id="qmenu_manage" class="quickmenu-links">
                <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=manage">{{ _OVERVIEW_MANAGE }}</a></li>
                <li><a href="index.php?action=usermanagement">{{ _QMENU_MANAGE_MEMBERS }}</a></li>
                <li><a href="index.php?action=createnewlog">{{ _QMENU_MANAGE_NEWBLOG }}</a></li>
            @if ($IsMysql)
                <li><a href="index.php?action=backupoverview">{{ _QMENU_MANAGE_BACKUPS }}</a></li>
            @endif
                <li><a href="index.php?action=pluginlist">{{ _QMENU_MANAGE_PLUGINS }}</a></li>
            </ul>
        </section>

        <section class="quickmenu-section">
            <div class="section-heading">{{ _QMENU_LAYOUT }}</div>
            <ul id="qmenu_layuot" class="quickmenu-links">
                <li><a href="index.php?action=skinoverview">{{ _QMENU_LAYOUT_SKINS }}</a></li>
                <li><a href="index.php?action=templateoverview">{{ _QMENU_LAYOUT_TEMPL }}</a></li>
                <li><a href="index.php?action=skinieoverview">{{ _QMENU_LAYOUT_IEXPORT }}</a></li>
            </ul>
        </section>
    @endif

        @php
            $aPluginExtras = [];
            $param         = [
                'options' => &$aPluginExtras,
            ];
            $manager->notify('QuickMenu', $param);
        @endphp

        @if (count($aPluginExtras) > 0)
            <section class="quickmenu-section">
                <div class="section-heading">{{ _QMENU_PLUGINS }}</div>
                <ul id="qmenu_plugins" class="quickmenu-links">
                @foreach ($aPluginExtras as $aInfo)
                    <li><a href="{{ $aInfo['url'] }}" title="{{ $aInfo['tooltip'] }}">{{ $aInfo['title'] }}</a></li>
                @endforeach
                </ul>
            </section>
        @endif

@endif
</div>
