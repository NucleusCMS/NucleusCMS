<!DOCTYPE html>
<html lang="{{ _LANG_CODE }}">
<head>
{!! $head !!}
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <div class="brand">
                <div class="brand-mark">N</div>
                <div class="brand-text">
                    <div class="brand-name">{{ $SiteName }}</div>
                    <div class="brand-subtitle">My Nucleus CMS</div>
                </div>
            </div>
            <div class="header-meta">
                @php $oAdmin->loginname(); @endphp
            </div>
        </header>
        <div class="app-body">
            <aside class="app-sidebar">
                <div class="sidebar-inner">
                    @php $oAdmin->quickmenu(); @endphp
                </div>
            </aside>
            <main id="content" class="app-content">
                @if ($oAdmin->hasSystemInfoMessages())
                    <div class="system-info-messages">
                        @foreach ($oAdmin->getSystemInfoMessages() as $info)
                            <div class="system-info-message system-info-{{ $info[0] }}">{!! $info[1] !!}</div>
                        @endforeach
                    </div>
                @endif
                {!! $content !!}
            </main>
        </div>
        <footer class="app-footer">
            {!! $foot !!}
        </footer>
    </div>
</body>
</html>
