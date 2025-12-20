<div class="systeminfo-wrapper">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
            <line x1="8" y1="21" x2="16" y2="21"/>
            <line x1="12" y1="17" x2="12" y2="21"/>
        </svg>
        {{ _SYSTEMINFO_TITLE }}
    </h2>

    <div id="systeminfo-tabs" class="systeminfo-tabs">
        <ul>
            <li><a href="#tab_environment" tabindex="500">{{ _SYSTEMINFO_ENVIRONMENT_TAB }}</a></li>
            <li><a href="#tab_actionlog" tabindex="510">{{ _SYSTEMINFO_ACTIONLOG_TAB }}</a></li>
            @if ($systemlogAvailable)
            <li><a href="#tab_systemlog" tabindex="520">{{ _SYSTEMINFO_SYSTEMLOG_TAB }}</a></li>
            @endif
        </ul>

        <!-- Environment Tab -->
        <div id="tab_environment" class="contentblock">
            @include('admin.systeminfo_environment')
        </div>

        <!-- Action Log Tab -->
        <div id="tab_actionlog" class="contentblock">
            @include('admin.systeminfo_actionlog')
        </div>

        <!-- System Log Tab -->
        @if ($systemlogAvailable)
        <div id="tab_systemlog" class="contentblock">
            @include('admin.systeminfo_systemlog')
        </div>
        @endif
    </div>
</div>

<script>
// workaround for ui-tabs bug
if ($('base')[0] && $('base')[0].href) {
    $('#systeminfo-tabs ul li a').each(function () {
        var url = document.location.href.split('#');
        if ($(this).attr('href').match(/^#/)) {
            $(this).attr('href', url[0] + $(this).attr('href'));
        }
    });
}
$("#systeminfo-tabs").tabs();
</script>
