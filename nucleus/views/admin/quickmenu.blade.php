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
        <div class="section-heading sr-only">{{ _QMENU_HOME }}</div>
        <ul class="quickmenu-links">
            <li><a href="index.php?action=overview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg><span>{{ _QMENU_HOME }}</span></a></li>
        </ul>
    </section>

    <section class="quickmenu-section">
        <div class="section-heading">ADMIN</div>
        <ul id="qmenu_own" class="quickmenu-links">
            <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=overview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg><span>{{ _QMENU_USER_HOME }}</span></a></li>
            <li><a href="index.php?action=browseownitems"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg><span>{{ _QMENU_USER_ITEMS }}</span></a></li>
            <li><a href="index.php?action=browseowncomments"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><span>{{ _QMENU_USER_COMMENTS }}</span></a></li>
        </ul>
    </section>

    @if ($member->isAdmin())
        <section class="quickmenu-section">
            <div class="section-heading">{{ _QMENU_MANAGE }}</div>

            <ul id="qmenu_manage" class="quickmenu-links">
                <li><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=manage"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg><span>{{ _OVERVIEW_MANAGE }}</span></a></li>
                <li><a href="index.php?action=usermanagement"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg><span>{{ _QMENU_MANAGE_MEMBERS }}</span></a></li>
                <li><a href="index.php?action=createnewlog"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg><span>{{ _QMENU_MANAGE_NEWBLOG }}</span></a></li>
            @if ($IsMysql)
                <li><a href="index.php?action=backupoverview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg><span>{{ _QMENU_MANAGE_BACKUPS }}</span></a></li>
            @endif
                <li><a href="index.php?action=pluginlist"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="9"/><rect x="14" y="7" width="3" height="5"/></svg><span>{{ _QMENU_MANAGE_PLUGINS }}</span></a></li>
            </ul>
        </section>

        <section class="quickmenu-section">
            <div class="section-heading">{{ _QMENU_LAYOUT }}</div>
            <ul id="qmenu_layuot" class="quickmenu-links">
                <li><a href="index.php?action=skinoverview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg><span>{{ _QMENU_LAYOUT_SKINS }}</span></a></li>
                <li><a href="index.php?action=templateoverview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg><span>{{ _QMENU_LAYOUT_TEMPL }}</span></a></li>
                <li><a href="index.php?action=skinieoverview"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg><span>{{ _QMENU_LAYOUT_IEXPORT }}</span></a></li>
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
                    <li><a href="{{ $aInfo['url'] }}" title="{{ $aInfo['tooltip'] }}"><svg class="menu-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="9"/><rect x="14" y="7" width="3" height="5"/></svg><span>{{ $aInfo['title'] }}</span></a></li>
                @endforeach
                </ul>
            </section>
        @endif

@endif
</div>
