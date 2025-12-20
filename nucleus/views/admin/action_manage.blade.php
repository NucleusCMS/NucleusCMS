<p><a href="index.php?action=overview">({{ _BACKHOME }})</a></p>

@if ($msg)
<p>{{ $msg }}</p>
@endif

<div style='float:none; clear: both;'></div>
<div style='float:right; padding: 1em;'>PHP : {{ \phpversion() }}</div>

<div style='float:left; padding: 0 1em;'>
    <h2>{{ _MANAGE_GENERAL }}</h2>
    <ul>
        <li><a href="index.php?action=usermanagement">{{ _OVERVIEW_MEMBERS }}</a></li>
        <li><a href="index.php?action=settingsedit">{{ _OVERVIEW_SETTINGS }}</a></li>
        <li><a href="index.php?action=systemoverview">{{ _QMENU_MANAGE_SYSTEM }}</a></li>
        <li><a href="index.php?action=actionlog">{{ _OVERVIEW_VIEWLOG }}</a></li>
        <li><a href="index.php?action=systemlog">{{ _SYSTEMLOG_TITLE }}</a></li>
        <li><a href="index.php?action=composeroverview">{{ _OVERVIEW_COMPOSER }}</a></li>
    </ul>
</div>

<div style='float:none; clear: both; padding: 0 1em;'>
    <h2>{{ _LINKS }}</h2>
    <ul>{!! preg_replace("#<a #","<a target='_blank' rel='noreferrer' ", $_MANAGE_LINKS_ITEMS) !!}</ul>
</div>
