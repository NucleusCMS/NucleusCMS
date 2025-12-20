<p><a href="index.php?action=overview">({{ _BACKHOME }})</a></p>

@if ($msg)
<p>{{ $msg }}</p>
@endif

<div class="dashboard-section manage-section">
    <div class="manage-header">
        <div class="manage-meta">PHP : {{ \phpversion() }}</div>
    </div>
    <h2>{{ _MANAGE_GENERAL }}</h2>
    <p class="layout-settings-lead">{{ _MANAGE_PAGE_LEAD }}</p>

    <div class="layout-settings-grid manage-links-grid">
        <a href="index.php?action=settingsedit" class="layout-card">
            <div class="layout-card-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _OVERVIEW_SETTINGS }}</div>
                <div class="layout-card-text">{{ _QMENU_MANAGE_SETTINGS }}</div>
            </div>
        </a>

        <a href="index.php?action=systemoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2" ry="2"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="7" y1="15" x2="7" y2="15"/><line x1="11" y1="15" x2="11" y2="15"/><line x1="15" y1="15" x2="15" y2="15"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _QMENU_MANAGE_SYSTEM }}</div>
                <div class="layout-card-text">{{ _OVERVIEW_SYSTEMTITLE }}</div>
            </div>
        </a>

        <a href="index.php?action=actionlog" class="layout-card">
            <div class="layout-card-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5h18"/><path d="M9 3v2"/><path d="M15 3v2"/><rect x="3" y="7" width="18" height="14" rx="2" ry="2"/><path d="M7 11h10"/><path d="M7 15h6"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _OVERVIEW_VIEWLOG }}</div>
                <div class="layout-card-text">{{ _QMENU_MANAGE_LOG }}</div>
            </div>
        </a>

        <a href="index.php?action=systemlog" class="layout-card">
            <div class="layout-card-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18"/><path d="M9 3v2"/><path d="M15 3v2"/><rect x="3" y="5" width="18" height="16" rx="2" ry="2"/><path d="M7 11h6"/><path d="M7 15h10"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _SYSTEMLOG_TITLE }}</div>
                <div class="layout-card-text">{{ _SYSTEMLOG_TITLE }}</div>
            </div>
        </a>
    </div>
</div>
