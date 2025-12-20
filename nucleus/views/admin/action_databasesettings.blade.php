<p><a href="index.php?action=overview">({{ _BACKHOME }})</a></p>

<section class="dashboard-section">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v6c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 11v6c0 1.66 4 3 9 3s9-1.34 9-3v-6"/></svg>
        {{ _DATABASE_SETTINGS_TITLE }}
    </h2>
    <p class="layout-settings-lead">{{ _DATABASE_SETTINGS_DESCRIPTION }}</p>

    <div class="layout-settings-grid">
        <a href="index.php?action=backupoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v6c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 11v6c0 1.66 4 3 9 3s9-1.34 9-3v-6"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _DATABASE_SETTINGS_BACKUP }}</div>
                <div class="layout-card-text">{{ _DATABASE_SETTINGS_BACKUP_DESC }}</div>
                <span class="layout-card-link">
                    {{ _LAYOUT_SETTINGS_OPEN }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </div>
        </a>

        <a href="index.php?action=optimizeoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3"/><path d="M12 18v3"/><path d="M16.95 7.05l2.12-2.12"/><path d="M4.93 19.07l2.12-2.12"/><path d="M21 12h-3"/><path d="M6 12H3"/><path d="M16.95 16.95l2.12 2.12"/><path d="M4.93 4.93l2.12 2.12"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _DATABASE_SETTINGS_OPTIMIZE }}</div>
                <div class="layout-card-text">{{ _DATABASE_SETTINGS_OPTIMIZE_DESC }}</div>
                <span class="layout-card-link">
                    {{ _LAYOUT_SETTINGS_OPEN }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </div>
        </a>
    </div>
</section>
