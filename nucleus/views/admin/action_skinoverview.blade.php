<p><a href="index.php?action=manage">({{ _BACKTOMANAGE }})</a></p>

<h2>{{ _SKIN_EDIT_TITLE }}</h2>

<h3>{{ _SKIN_AVAILABLE_TITLE }}</h3>

@php
    $query    = sprintf("SELECT * FROM %s ORDER BY sdname", sql_table('skin_desc'));
    $template = [
        'content'  => 'skinlist',
        'tabindex' => 10,
    ];
    showlist_by_query($query, 'table', $template);
@endphp

<h3>{{ _SKIN_NEW_TITLE }}</h3>

<form method="post" action="index.php">
    <div>
        <input name="action" value="skinnew" type="hidden" />
        @php $manager->addTicketHidden(); @endphp
        <table>
            <tr>
                <td>{{ _SKIN_NAME }} @php help('shortnames'); @endphp</td>
                <td><input name="name" tabindex="10010" maxlength="20" size="20" required pattern="{{ $pattern_skin_name }}" /></td>
            </tr>
            <tr>
                <td>{{ _SKIN_DESC }}</td>
                <td><input name="desc" tabindex="10020" maxlength="200" /></td>
            </tr>
            <tr>
                <td>{{ _SKIN_CREATE }}</td>
                <td><input type="submit" tabindex="10030" value="{{ _SKIN_CREATE_BTN }}" onclick="return checkSubmit();" /></td>
            </tr>
        </table>
    </div>
</form>
