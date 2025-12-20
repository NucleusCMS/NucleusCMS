<h3>{{ _ACTIONLOG_TITLE }}</h3>

<div class="actionlog-controls">
    <h4>{{ _ACTIONLOG_CLEAR_TITLE }}</h4>
    <form action="index.php?action=clearactionlog" method="post">
        {!! $manager->getHtmlInputTicketHidden() !!}
        <input type="submit" value="{{ _ACTIONLOG_CLEAR_TEXT }}" onclick="return confirm('{{ _ACTIONLOG_CLEAR_CONFIRM ?? '本当にクリアしますか？' }}');" />
    </form>
</div>

@php
// cut big message
$colmessage = "CASE WHEN CHAR_LENGTH(message) < 2000 THEN message
               ELSE CONCAT(SUBSTRING(message, 1, 2000), ' ...') END as 'message' ";
$query = sprintf(
    "SELECT timestamp, %s FROM %s ORDER BY timestamp DESC",
    $colmessage,
    sql_table('actionlog')
);
$template['content'] = 'actionlist';
$amount = showlist_by_query($query, 'table', $template);
@endphp

@if ($amount == 0)
<p>{{ _ACTIONLOG_EMPTY ?? '管理操作履歴がありません。' }}</p>
@endif
