<h3>{{ _DATABASE_OPTIMIZE_HEADING }}</h3>

@php
$DB_DRIVER_NAME = $DB_DRIVER_NAME ?? 'mysql';
@endphp

@if (in_array($DB_DRIVER_NAME, ['mysql', 'sqlite']))

    @if ('sqlite' === $DB_DRIVER_NAME)
        <p>{{ _ADMIN_FILESIZE }} : {{ $oAdmin->get_db_sqliteFileSizeText() }}</p>

        @if (isset($_POST['mode']) && 'optimize' == $_POST['mode'] && isset($_POST['step']) && 'start' == $_POST['step'])
            <div class="database-result">
                <p>{{ _ADMIN_OLD }} {{ _ADMIN_FILESIZE }} : {{ $oAdmin->get_db_sqliteFileSizeText() }}</p>
                @php
                    sql_query('VACUUM;');
                @endphp
                <p>{{ _ADMIN_NEW }} {{ _ADMIN_FILESIZE }} : {{ $oAdmin->get_db_sqliteFileSizeText() }}</p>
                <p><a href="index.php?action=databaseoverview#tab_optimize">{{ _BACKTOOVERVIEW }}</a></p>
            </div>
        @else
            <form method="post" action="index.php#tab_optimize">
                <input type="hidden" name="action" value="databaseoverview" />
                <input type="hidden" name="mode" value="optimize" />
                <input type="hidden" name="step" value="start" />
                <p><input type="submit" value="{{ _ADMIN_TITLE_OPTIMIZE }}" tabindex="20" /></p>
            </form>
        @endif

    @else
        {{-- MySQL optimization --}}
        @php
            $tables = [];
            $confirmOptimize = false;
            $has_big = false;
            $warn_size = 10 * pow(10, 6); // 10 MB

            $res = sql_query(sprintf("SHOW TABLE STATUS LIKE '%s%%'", sql_table('')));
            while ($res && ($row = sql_fetch_assoc($res)) && !empty($row)) {
                $tables[$row['Name']] = $row;
                if ('InnoDB' != $row['Engine']) {
                    if ((int)$row['Data_free'] > 0) {
                        $confirmOptimize = true;
                    }
                    if ((int)$row['Data_free'] > $warn_size) {
                        $has_big = true;
                    }
                }
            }
        @endphp

        @if (isset($_POST['mode']) && 'optimize' == $_POST['mode'] && isset($_POST['step']) && 'start' == $_POST['step'])
            <div class="database-result">
                <p><a href="index.php?action=databaseoverview#tab_optimize">{{ _BACKTOOVERVIEW }}</a></p>
                @php
                    // Perform optimization
                    $optimized_tables = [];
                    $innodb_tables = [];

                    foreach ($tables as $name => $info) {
                        if ((int)$info['Data_free'] > 0) {
                            if ('InnoDB' == $info['Engine']) {
                                $innodb_tables[] = $name;
                            } else {
                                $optimized_tables[] = $name;
                            }
                        }
                    }

                    $success = false;
                    if (count($optimized_tables) > 0) {
                        $sql = 'OPTIMIZE TABLE `' . implode('`, `', $optimized_tables) . '`';
                        $res = sql_query($sql);
                        echo '<h4>' . hsc(_ADMIN_EXEC_TITLE_OPTIMIZE) . '</h4>';
                        echo '<ul>';
                        while ($res && ($row = sql_fetch_assoc($res)) && !empty($row)) {
                            echo '<li>' . hsc($row['Table']) . ' : ' . hsc($row['Msg_text']) . '</li>';
                        }
                        echo '</ul>';
                        $success = true;
                    }

                    if (count($innodb_tables) > 0) {
                        echo '<p>' . hsc(_ADMIN_INNODB_NOTE) . '</p>';
                        echo '<ul>';
                        foreach ($innodb_tables as $table) {
                            echo '<li>' . hsc($table) . '</li>';
                        }
                        echo '</ul>';
                    }
                @endphp
            </div>

        @elseif ($confirmOptimize)
            @if ($has_big)
                <p style="color: #ff0000">{{ _ADMIN_PLEASE_OPTIMIZE }}</p>
            @endif

            <p>{{ _ADMIN_CONFIRM_TITLE_OPTIMIZE }}</p>

            <form method="post" action="index.php#tab_optimize">
                <input type="hidden" name="action" value="databaseoverview" />
                <input type="hidden" name="mode" value="optimize" />
                <input type="hidden" name="step" value="start" />
                <p><input type="submit" value="{{ _ADMIN_BTN_TITLE_OPTIMIZE }}" tabindex="20" /></p>
            </form>

            <table class="database-tables-list">
                <thead>
                    <tr>
                        <th>{{ _ADMIN_TABLENAME }}</th>
                        <th>{{ _SIZE }}</th>
                        <th>{{ _OVERHEAD }}</th>
                        <th>Engine</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tables as $name => $info)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ number_format($info['Data_length']) }}</td>
                        <td>{{ number_format($info['Data_free']) }}</td>
                        <td>{{ $info['Engine'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>{{ _DATABASE_NO_OPTIMIZATION_NEEDED }}</p>
        @endif
    @endif

@endif

{{-- Repair Section (MySQL only) --}}
@if ('mysql' === $DB_DRIVER_NAME)
    <h3>{{ _ADMIN_TITLE_REPAIR }}</h3>

    @php
        // Check tables
        $problem_tables = [];
        $res = sql_query(sprintf("SHOW TABLES LIKE '%s%%'", sql_table('')));
        $all_tables = [];
        while ($res && ($row = sql_fetch_array($res)) && !empty($row)) {
            $all_tables[] = $row[0];
        }

        if (count($all_tables)) {
            $sql = "CHECK TABLE `" . implode("`, `", $all_tables) . "`";
            $res = sql_query($sql);
            while ($res && ($row = sql_fetch_assoc($res)) && !empty($row)) {
                if ('status' == $row['Msg_type']) {
                    if ('OK' != $row['Msg_text'] && 'Table is already up to date' != $row['Msg_text']) {
                        $problem_tables[$row['Table']] = $row;
                    }
                }
            }
        }
    @endphp

    @if (isset($_POST['mode']) && 'repair' == $_POST['mode'] && isset($_POST['step']) && 'start' == $_POST['step'])
        <div class="database-result">
            <p>{{ _ADMIN_EXEC_TITLE_AUTO_REPAIR }}</p>
            <p><a href="index.php?action=databaseoverview#tab_optimize">{{ _BACKTOOVERVIEW }}</a></p>
            @php
                if (count($problem_tables) > 0) {
                    $sql = "REPAIR TABLE `" . implode("`, `", array_keys($problem_tables)) . "`";
                    $res = sql_query($sql);
                    echo '<ul>';
                    while ($res && ($row = sql_fetch_assoc($res)) && !empty($row)) {
                        echo '<li>' . hsc($row['Table']) . ' : ' . hsc($row['Msg_text']) . '</li>';
                    }
                    echo '</ul>';
                }
            @endphp
        </div>

    @elseif (count($problem_tables) > 0)
        <p>{{ _PROBLEMS_FOUND_ON_TABLE }}</p>
        <p>{{ _ADMIN_CONFIRM_TITLE_AUTO_REPAIR }}</p>

        <form method="post" action="index.php#tab_optimize">
            <input type="hidden" name="action" value="databaseoverview" />
            <input type="hidden" name="mode" value="repair" />
            <input type="hidden" name="step" value="start" />
            <p><input type="submit" value="{{ _ADMIN_BTN_TITLE_AUTO_REPAIR }}" tabindex="30" /></p>
        </form>

        <table class="database-tables-list">
            <thead>
                <tr>
                    <th>{{ _ADMIN_TABLENAME }}</th>
                    <th>{{ _MESSAGE }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($problem_tables as $name => $info)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $info['Msg_text'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>{{ _NO_PROBLEMS_FOUND }}</p>
    @endif
@endif
