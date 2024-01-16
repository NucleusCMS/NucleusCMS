<!DOCTYPE html>
<html lang="{{ _LANG_CODE }}">
<head>
    <meta charset="{{ _CHARSET }}" />
    <meta name="robots" content="noindex, nofollow, noarchive" />
    <title>{{ $SiteName }} - Admin</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" title="Nucleus Admin Default" type="text/css" href="{{ $baseUrl }}styles/admin_{{ $AdminCSS }}.css" />
    <link rel="stylesheet" title="Nucleus Admin Default" type="text/css" href="{{ $baseUrl }}styles/addedit.css" />
    <link rel="stylesheet" title="Nucleus Admin Default" type="text/css" href="{{ $baseUrl }}styles/admin_quickmenu.css" />
    <script src="{{ $baseUrl }}javascript/jquery/jquery.min.js"></script>
    <script src="{{ $baseUrl }}javascript/jquery/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="{{ $baseUrl }}javascript/jquery/jquery.cookie.js"></script>
    <script src="{{ $baseUrl }}javascript/edit.js"></script>
    @if ('createitem' == $oAdmin->action || 'itemedit' == $oAdmin->action)
        <link rel="stylesheet" href="{{ $baseUrl }}styles/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="{{ $baseUrl }}styles/jquery-ui/jquery-ui.structure.min.css">
        @if (_LOCALE == 'ja_JP')
            <link rel="stylesheet" href="{{ $baseUrl }}styles/jquery-ui/ui.datepicker-ja.css">
            <script src="{{ $baseUrl }}javascript/jquery/i18n/jquery.ui.datepicker-ja.js"></script>
        @endif
        <script src="{{ $baseUrl }}javascript/jquery/jquery-ui.min.js"></script>
        <script src="{{ $baseUrl }}javascript/edit_public_date.js"></script>
    @endif
    <script src="{{ $baseUrl }}javascript/admin.js"></script>
    <script src="{{ $baseUrl }}javascript/admin_menu.js"></script>
    <script src="{{ $baseUrl }}javascript/compatibility.js"></script>
    <script src="{{ $baseUrl }}javascript/jquery/ui/core_widget_tabs.min.js"></script>
    <script src="{{ $baseUrl }}javascript/admin_quickmenu.js"></script>
    {!! $extrahead !!}
</head>
<body>
    <div id="adminwrapper">
        <div class="header">
            <h1>{{ $SiteName }}</h1>
        </div>
        <div id="container">
            <div id="content">
                @php $oAdmin->loginname(); @endphp