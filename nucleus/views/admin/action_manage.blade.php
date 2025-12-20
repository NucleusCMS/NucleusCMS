<p><a href="index.php?action=overview">({{ _BACKHOME }})</a></p>

@if ($msg)
<p>{{ $msg }}</p>
@endif

<div class="manage-overview">
    <div style='float:right; padding: 1em;'>PHP : {{ \phpversion() }}</div>

    <h2>{{ _MANAGE_TITLE }}</h2>
    <p class="manage-description">{{ _MANAGE_DESCRIPTION }}</p>

    <div class="manage-sections">
        <div class="manage-section">
            <h3>{{ _MANAGE_GENERAL }}</h3>
            <ul>
                <li><a href="index.php?action=usermanagement">{{ _OVERVIEW_MEMBERS }}</a></li>
                <li><a href="index.php?action=settingsedit">{{ _OVERVIEW_SETTINGS }}</a></li>
                <li><a href="index.php?action=systeminfo">{{ _SYSTEMINFO_TITLE }}</a> <span class="badge-new">NEW</span></li>
                <li><a href="index.php?action=databaseoverview">{{ _DATABASE_MANAGEMENT_TITLE }}</a> <span class="badge-new">NEW</span></li>
            </ul>
        </div>

        <div class="manage-section">
            <h3>{{ _MANAGE_SKINS }}</h3>
            <ul>
                <li><a href="index.php?action=layoutsettings">{{ _QMENU_LAYOUT_SETTINGS }}</a></li>
                <li><a href="index.php?action=skinoverview">{{ _OVERVIEW_SKINS }}</a></li>
                <li><a href="index.php?action=templateoverview">{{ _OVERVIEW_TEMPLATES }}</a></li>
                <li><a href="index.php?action=skinieoverview">{{ _OVERVIEW_SKINIMPORT }}</a></li>
            </ul>
        </div>

        <div class="manage-section">
            <h3>{{ _MANAGE_EXTRA }}</h3>
            <ul>
                <li><a href="index.php?action=pluginlist">{{ _OVERVIEW_PLUGINS }}</a></li>
            </ul>
        </div>

        <div class="manage-section">
            <h3>{{ _LINKS }}</h3>
            <ul>{!! preg_replace("#<a #","<a target='_blank' rel='noreferrer' ", $_MANAGE_LINKS_ITEMS) !!}</ul>
        </div>
    </div>
</div>

<style>
.manage-overview {
    clear: both;
}

.manage-description {
    color: #666;
    margin-bottom: 2em;
}

.manage-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2em;
    margin-top: 2em;
}

.manage-section h3 {
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5em;
    margin-bottom: 1em;
}

.manage-section ul {
    list-style-type: none;
    padding-left: 0;
}

.manage-section ul li {
    margin: 0.5em 0;
}

.badge-new {
    background: #28a745;
    color: white;
    padding: 0.2em 0.5em;
    border-radius: 3px;
    font-size: 0.75em;
    font-weight: bold;
    margin-left: 0.5em;
}
</style>
