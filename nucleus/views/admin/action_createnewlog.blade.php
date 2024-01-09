<p><a href="index.php?action=manage">({{ _BACKTOMANAGE }})</a></p>

<h2>{{ _EBLOG_CREATE_TITLE }}</h2>

<h3>{{ _ADMIN_NOTABILIA }}</h3>

<p>{{ _ADMIN_PLEASE_READ }}</p>

<p>{{ _ADMIN_HOW_TO_ACCESS }}</p>

<ol>
    <li>{{ _ADMIN_SIMPLE_WAY }}</li>
    <li>{{ _ADMIN_ADVANCED_WAY }}</li>
</ol>

<h3>{{ _ADMIN_HOW_TO_CREATE }}</h3>

<p>{{ _EBLOG_CREATE_TEXT }}</p>

<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="addnewlog" />
        @php $manager->addTicketHidden(); @endphp
        <table style="table-layout: fixed">
            <tr>
                <td>{{ _EBLOG_NAME }}</td>
                <td><input name="name" tabindex="10" size="40" maxlength="60" /></td>
            </tr>
            <tr>
                <td>{{ _EBLOG_SHORTNAME }}
                    @php \help('shortblogname'); @endphp
                </td>
                <td><input name="shortname" tabindex="20" maxlength="15" size="15"
                           required autocomplete="off" pattern="{{ $pattern_blog_name }}" /></td>
            </tr>
            <tr>
                <td>{{ _EBLOG_DESC }}</td>
                <td><input name="desc" tabindex="30" maxlength="200" /></td>
            </tr>
            <tr>
                <td>{{ _EBLOG_DEFSKIN }}
                    @php \help('blogdefaultskin'); @endphp
                </td>
                <td>
                @php 
                    $query = sprintf("SELECT sdname as text, sdnumber as value FROM %s", sql_table('skin_desc'));
                    $template                  = [];
                    $template['name']          = 'defskin';
                    $template['tabindex']      = 50;
                    $template['selected']      = CONF::asStr('BaseSkin');  // set default selected skin to be globally defined base skin
                    showlist_by_query($query, 'select', $template);
                @endphp
                </td>
            </tr>
            <tr>
                <td>{{ _EBLOG_OFFSET }}
                    @php \help('blogtimeoffset'); @endphp
                    <br />{{ _EBLOG_STIME }} <b>{{ $blog_offset }}</b>
                </td>
                <td><input name="timeoffset" tabindex="110" size="3" value="0" /></td>
            </tr>
            <tr>
                <td>{{ _EBLOG_ADMIN }}
                    @php \help('teamadmin'); @endphp
                </td>
                <td>{{ _EBLOG_ADMIN_MSG }}</td>
            </tr>
            <tr>
                <td>{!! _EBLOG_DISABLECOMMENTS !!}
                </td>
                <td>@php $oAdmin?->input_yesno('comments', 1, 150); @endphp</td>
            </tr>
            <tr>
                <td>{{ _EBLOG_ANONYMOUS }}
                </td>
                <td>@php $oAdmin?->input_yesno('public', 0, 151); @endphp</td>
            </tr>
            <tr>
                <td>{{ _EBLOG_REQUIREDEMAIL }}
                </td>
                <td>@php $oAdmin?->input_yesno('reqemail', 0, 152); @endphp</td>
            </tr>
            <tr>
                <td>{{ _EBLOG_CREATE }}</td>
                <td><input type="submit" tabindex="200" value="{{ _EBLOG_CREATE_BTN }}"
                           onclick="if (this.form.shortname.value.length==0) { alert('{{ $alert_text }}'); return false; } return checkSubmit();" /></td>
            </tr>
        </table>
    </div>
</form>
