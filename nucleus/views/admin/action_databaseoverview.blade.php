<div class="database-overview-wrapper">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <ellipse cx="12" cy="5" rx="9" ry="3"/>
            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
        </svg>
        {{ _DATABASE_MANAGEMENT_TITLE }}
    </h2>

    <div id="database-tabs" class="database-tabs">
        <ul>
            <li><a href="#tab_db_info" tabindex="300">{{ _DATABASE_INFO_TAB }}</a></li>
            <li><a href="#tab_tables" tabindex="310">{{ _DATABASE_TABLES_TAB }}</a></li>
            <li><a href="#tab_optimize" tabindex="320">{{ _DATABASE_OPTIMIZE_TAB }}</a></li>
            @if ($IsMysql)
            <li><a href="#tab_backup" tabindex="330">{{ _DATABASE_BACKUP_TAB }}</a></li>
            @endif
        </ul>

        <!-- Database Info Tab -->
        <div id="tab_db_info" class="contentblock">
            <h3>{{ _DATABASE_INFO_HEADING }}</h3>

            <table class="database-info-table">
                <tr>
                    <th colspan="2">{{ _DATABASE_GENERAL_INFO }}</th>
                </tr>
                <tr>
                    <td width="30%">{{ _DATABASE_DRIVER }}</td>
                    <td>{{ $dbInfo['driver'] }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_NAME }}</td>
                    <td>{{ $dbInfo['database'] }}</td>
                </tr>
                @if ($IsMysql && !empty($dbInfo['host']))
                <tr>
                    <td>{{ _DATABASE_HOST }}</td>
                    <td>{{ $dbInfo['host'] }}</td>
                </tr>
                @endif
                <tr>
                    <td>{{ _DATABASE_TABLE_PREFIX }}</td>
                    <td>{{ $dbInfo['prefix'] }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_VERSION }}</td>
                    <td>{{ $dbInfo['version'] }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_CLIENT_VERSION }}</td>
                    <td>{{ $dbInfo['client_version'] }}</td>
                </tr>
            </table>

            @if ($IsMysql)
            <table class="database-info-table">
                <tr>
                    <th colspan="2">{{ _DATABASE_SIZE_INFO }}</th>
                </tr>
                <tr>
                    <td width="30%">{{ _DATABASE_TABLE_COUNT }}</td>
                    <td>{{ $dbInfo['table_count'] ?? 0 }} {{ _DATABASE_TABLES }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_TOTAL_SIZE }}</td>
                    <td>{{ number_format($dbInfo['total_size'] ?? 0) }} bytes ({{ number_format(($dbInfo['total_size'] ?? 0) / 1024 / 1024, 2) }} MB)</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_DATA_SIZE }}</td>
                    <td>{{ number_format($dbInfo['data_size'] ?? 0) }} bytes ({{ number_format(($dbInfo['data_size'] ?? 0) / 1024 / 1024, 2) }} MB)</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_INDEX_SIZE }}</td>
                    <td>{{ number_format($dbInfo['index_size'] ?? 0) }} bytes ({{ number_format(($dbInfo['index_size'] ?? 0) / 1024 / 1024, 2) }} MB)</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_FREE_SIZE }}</td>
                    <td>{{ number_format($dbInfo['free_size'] ?? 0) }} bytes ({{ number_format(($dbInfo['free_size'] ?? 0) / 1024 / 1024, 2) }} MB)</td>
                </tr>
            </table>
            @elseif ('sqlite' === $DB_DRIVER_NAME)
            <table class="database-info-table">
                <tr>
                    <th colspan="2">{{ _DATABASE_SIZE_INFO }}</th>
                </tr>
                <tr>
                    <td width="30%">{{ _DATABASE_TABLE_COUNT }}</td>
                    <td>{{ $dbInfo['table_count'] ?? 0 }} {{ _DATABASE_TABLES }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_FILE_PATH }}</td>
                    <td>{{ $dbInfo['file_path'] ?? '' }}</td>
                </tr>
                <tr>
                    <td>{{ _DATABASE_FILE_SIZE }}</td>
                    <td>{{ number_format($dbInfo['file_size'] ?? 0) }} bytes ({{ number_format(($dbInfo['file_size'] ?? 0) / 1024 / 1024, 2) }} MB)</td>
                </tr>
            </table>
            @endif
        </div>

        <!-- Tables Tab -->
        <div id="tab_tables" class="contentblock">
            <h3>{{ _DATABASE_TABLES_HEADING }}</h3>

            @if (count($tables) > 0)
            <table class="database-tables-list">
                <thead>
                    <tr>
                        <th>{{ _DATABASE_TABLE_NAME }}</th>
                        <th>{{ _DATABASE_TABLE_ENGINE }}</th>
                        <th>{{ _DATABASE_TABLE_ROWS }}</th>
                        @if ($IsMysql)
                        <th>{{ _DATABASE_TABLE_DATA_SIZE }}</th>
                        <th>{{ _DATABASE_TABLE_INDEX_SIZE }}</th>
                        <th>{{ _DATABASE_TABLE_OVERHEAD }}</th>
                        <th>{{ _DATABASE_TABLE_COLLATION }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($tables as $table)
                    <tr>
                        <td><strong>{{ $table['name'] }}</strong></td>
                        <td>{{ $table['engine'] }}</td>
                        <td>{{ number_format($table['rows']) }}</td>
                        @if ($IsMysql)
                        <td>{{ number_format($table['data_length']) }}</td>
                        <td>{{ number_format($table['index_length']) }}</td>
                        <td>{{ number_format($table['data_free']) }}</td>
                        <td>{{ $table['collation'] }}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p>{{ _DATABASE_NO_TABLES }}</p>
            @endif
        </div>

        <!-- Optimize/Repair Tab -->
        <div id="tab_optimize" class="contentblock">
            @include('admin.database_optimize_repair')
        </div>

        <!-- Backup Tab (MySQL only) -->
        @if ($IsMysql)
        <div id="tab_backup" class="contentblock">
            @include('admin.database_backup')
        </div>
        @endif
    </div>
</div>

<script>
// workaround for ui-tabs bug : if a <base> tag is present in the <head> section
if ($('base')[0] && $('base')[0].href) {
    $('#database-tabs ul li a').each(function () {
        var url = document.location.href.split('#');
        if ($(this).attr('href').match(/^#/)) {
            $(this).attr('href', url[0] + $(this).attr('href'));
        }
    });
}
$("#database-tabs").tabs();
</script>
