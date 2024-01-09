<h3>{{ _ADMIN_SYSTEMOVERVIEW_PHPANDDB }}</h3>

<table>
    <tr>
        <th colspan="2">{{ _ADMIN_SYSTEMOVERVIEW_VERSIONS }}</th>
    </tr><tr>
        <td width="50%">{{ _ADMIN_SYSTEMOVERVIEW_PHPVERSION }}</td>
        <td>{{ \phpversion() }}</td>
    </tr><tr>
        <td>{{ _ADMIN_SYSTEMOVERVIEW_DBANDVERSION }}</td>
        <td>
            @if ('mysql' == $DB_DRIVER_NAME)
                MySQL
            @else
                {{ $DB_DRIVER_NAME }}
            @endif
            : {{ \sql_get_server_info() }} ({{ \sql_get_client_info() }})
        </td>
    </tr>
    <tr><!-- Database Driver -->
        <td>{{ _ADMIN_SYSTEMOVERVIEW_DBDRIVER }}</td>
        <td>pdo</td>
    </tr>

    @if ('mysql' === $DB_DRIVER_NAME)
    <tr><!-- Database charset -->
        <td>Database charset</td>
        <td>{{ $db_charset }}</td>
    </tr>
    @endif
</table>

<!-- Important PHP settings -->
<table>
    <tr>
        <th colspan="2">{{ _ADMIN_SYSTEMOVERVIEW_SETTINGS }}</th>
    </tr>
    <tr>
        <td width="50%">default_charset</td>
        <td>{{ $default_charset }}</td>
    </tr>
    <tr>
        <td>date.timezone</td>
        <td>{{ ini_get('date.timezone') ?? 'none' }}</td>
    </tr>
</table>

<!-- Information about GD library -->
@php
    $gdinfo = gd_info();
@endphp
<table>
    <tr>
        <th colspan="2">{{ _ADMIN_SYSTEMOVERVIEW_GDLIBRALY }}</th>
    </tr>
@foreach ($gdinfo as $key => $value)
    <tr>
        <td width="50%">{{ $key }}</td>
        <td>@if(is_bool($value)) {{ $value ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE }}
            @else {{ $value }} @endif
        </td>
    </tr>
@endforeach
</table>

<!-- Check if special modules are loaded -->
@php
    ob_start();
    phpinfo(INFO_MODULES);
    $im = ob_get_clean();
    $modrewrite = ('' != strstr($im, 'mod_rewrite')) ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE;
@endphp
<table>
    <tr>
        <th colspan="2">{{ _ADMIN_SYSTEMOVERVIEW_MODULES }}</th>
    </tr>
    <tr>
        <td width="50%">mod_rewrite</td>
        <td>{{ $modrewrite }}</td>
    </tr>
</table>

<!-- PHP extensions -->
@php
    $extensions = get_loaded_extensions();
    sort($extensions, SORT_STRING | SORT_FLAG_CASE);
@endphp
<table>
    <tr>
        <th colspan="2">PHP extensions</th>
    </tr>
    <tr>
        <td width="50%">Loaded extensions</td>
        <td>{{ \implode(', ', $extensions) }}</td>
    </tr>
</table>

<!-- Tidy -->
<table>
    <tr>
        <th colspan="2">Tidy</th>
    </tr>
    <tr>
        <td width="50%">Tidy</td>
        <td>{{ extension_loaded('tidy') ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE }}</td>
    </tr>
@if (function_exists('tidy_get_release'))
    @php
        $m        = [];
        $tidy_ver = preg_match('/Tidy Version.+?>\s*([0-9\.]+)\s*</ims', $im, $m) ? $m[1] : '';
        $tidy_support_HTML5 = strtotime(str_replace(['.'], '/', tidy_get_release())) >= strtotime('2015/06/30');
    @endphp
    @if ($tidy_ver)
    <tr><td>libTidy Version</td><td>{{ $tidy_ver }}</td></tr>
    @endif
    <tr><td>libTidy Release</td><td>{{ \tidy_get_release() }}</td></tr>
    <tr><td>Support HTML5</td><td>{{ $tidy_support_HTML5 ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE }}</td></tr>
@endif
</table>

<!-- Information about the used core system -->
<h3>{{ _ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM }}</h3>
<table>
    <tr>
        <th colspan="2">{{ CORE_APPLICATION_NAME }}</th>
    </tr><tr>
        <td width="50%">{{ _ADMIN_SYSTEMOVERVIEW_CORE_VERSION }}</td>
            <td>{{ CORE_APPLICATION_VERSION_DISPLAY }}</td>
    </tr><tr>
        <td width="50%">{{ _ADMIN_SYSTEMOVERVIEW_CORE_VERSION }} ID</td>
            <td>{{ CORE_APPLICATION_VERSION_ID }}</td>
    </tr><tr>
        <td width="50%">{{ _ADMIN_SYSTEMOVERVIEW_CORE_PATCHLEVEL }}</td>
        <td>{{ \getNucleusPatchLevel() }}</td>
    </tr>
    <tr>
        <td width="50%">{{ _ADMIN_SYSTEMOVERVIEW_CORE_DB_VERSION }}</td>
        <td>{{ $CONF['DatabaseVersion'] }}</td>
    </tr>
    <tr>
        <td width="50%">_CHARSET</td>
        <td>{{ _CHARSET }}</td>
    </tr>
</table>

<!-- Important settings of the installation -->
<div style='height: 15.5em; overflow: auto' id='div_imp1'>
<table>
    <tr>
        <th colspan="2" style="position:sticky;top:0;left:0;">{{ _ADMIN_SYSTEMOVERVIEW_CORE_SETTINGS }}
            {!! sprintf("<span onclick='%s'> [+]</span>", 'this.style.display = "none";  document.getElementById("div_imp1").style.height = "auto";') !!}
        </th>
    </tr>
@php
    $items   = []; // name , value[, style sheet]
    $items[] = ["\$CONF['Self']", $CONF['Self']];
    $items[] = ["\$CONF['ItemURL']", $CONF['ItemURL']];
    $items[] = ["\$CONF['alertOnHeadersSent']", ($CONF['alertOnHeadersSent'] ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE)];
    $items[] = [
        "\$CONF['debug'], isDebugMode()", (isDebugMode() ? _ADMIN_SYSTEMOVERVIEW_ENABLE : _ADMIN_SYSTEMOVERVIEW_DISABLE),
        (isDebugMode() ? 'color:red' : ''),
    ];
@endphp
@foreach ($items as $item)
    <tr>
        <td width="50%">{{ $item[0] }}</td>
        @php $style = (isset($item[2]) && strlen($item[2]) > 0) ? " style='{$item[2]}'" : ''; @endphp
        <td{!! $style !!}>{{ $item[1] }}</td>
    </tr>
@endforeach

    <!-- Other settings of the installation -->
    @php
        ksort($CONF);
        $items            = ['Self', 'ItemURL', 'alertOnHeadersSent', 'debug', 'AdminEmail'];
        $items_warn_false = ['alertOnSecurityRisk'];
        $items_warn_true  = [];
    @endphp
    @foreach ($CONF as $k => $v)
        @if ( ! in_array($k, $items))
        @php
            $style = '';
            if ((in_array($k, $items_warn_true) && $v)
                ||
                (in_array($k, $items_warn_false) && ! $v)
            ) {
                $style = " style='color:red'";
            }
            $v_escaped = hsc($v);
            if (str_contains($v, "\n")) {
                $style = " style='overflow-wrap: anywhere; max-height: 10em; overflow: auto;'";
                $v_scaped = str_replace("\n", "<br>\n", $v_escaped);
            }
        @endphp
        <tr>
            <td width="50%">{{ $k }}</td>
            <td{{ $style }}>{!! $v_escaped !!}</td>
        </tr>
        @endif
    @endforeach
</table>
</div>

<!-- Mysql Emulate Functions -->
{!! $MysqlEmulateInfo !!}


<h3>{{ _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK }}</h3>

{{ _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT }}
@if ( ! empty($checkURL))
    <a href="{{ $checkURL }}">{{ _ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE }}</a>
@endif