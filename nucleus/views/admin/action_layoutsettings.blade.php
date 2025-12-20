<p><a href="index.php?action=overview">({{ _BACKHOME }})</a></p>

<section class="dashboard-section">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        {{ _LAYOUT_SETTINGS_TITLE }}
    </h2>
    <p class="layout-settings-lead">{{ _LAYOUT_SETTINGS_DESCRIPTION }}</p>

    <div class="layout-settings-grid">
        <a href="index.php?action=skinoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _LAYOUT_SETTINGS_SKINS }}</div>
                <div class="layout-card-text">{{ _LAYOUT_SETTINGS_SKINS_DESC }}</div>
            </div>
        </a>

        <a href="index.php?action=templateoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _LAYOUT_SETTINGS_TEMPLATES }}</div>
                <div class="layout-card-text">{{ _LAYOUT_SETTINGS_TEMPLATES_DESC }}</div>
            </div>
        </a>

        <a href="index.php?action=skinieoverview" class="layout-card">
            <div class="layout-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            </div>
            <div class="layout-card-body">
                <div class="layout-card-title">{{ _LAYOUT_SETTINGS_IMPORT }}</div>
                <div class="layout-card-text">{{ _LAYOUT_SETTINGS_IMPORT_DESC }}</div>
            </div>
        </a>
    </div>
</section>
