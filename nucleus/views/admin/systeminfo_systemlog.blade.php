<h3>{{ _SYSTEMLOG_TITLE }}</h3>

<div class="systemlog-controls">
    <h4>{{ _SYSTEMLOG_CLEAR_TITLE }}</h4>
    <form action="index.php?action=clearsystemlog" method="post">
        {!! $manager->getHtmlInputTicketHidden() !!}
        <input type="submit" value="{{ _SYSTEMLOG_CLEAR_TEXT }}" onclick="return confirm('{{ _SYSTEMLOG_CLEAR_CONFIRM ?? '本当にクリアしますか？' }}');" />
    </form>
</div>

@php
$query = sprintf("SELECT * FROM %s ORDER BY timestamp_utc DESC", sql_table('systemlog'));
// display first 100 entries
$query .= ' LIMIT 100';

$template['content'] = 'systemloglist';
$amount = showlist_by_query($query, 'table', $template);
@endphp

@if ($amount == 0)
<p>{{ _SYSTEMLOG_EMPTY ?? 'システムログがありません。' }}</p>
@endif

<p class="note">{{ _SYSTEMLOG_NOTE ?? '最新の100件のみ表示されます。' }}</p>
