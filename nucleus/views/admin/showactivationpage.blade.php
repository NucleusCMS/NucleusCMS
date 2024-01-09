<h2>{{ $title }}</h2>
<p>{{ $text }}</p>

@if ('' != $message)
<p class="error">{{ $message }}</p>
@endif

@if ($bNeedsPasswordChange)
<div>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="activatesetpwd" />
        @php $manager->addTicketHidden() @endphp
        <input type="hidden" name="key" value="{{ $key }}" />
        <table>
            <tr>
                <td>{{ _MEMBERS_PWD }}
                    <br /><small>{{ _MEMBERS_PASSWORD_INFO }} @php help('password'); @endphp</small>
                </td>
                <td><input type="password" maxlength="40" size="16" name="password" autocomplete="off" pattern="{{ $pattern_password }}" /></td>
            </tr>
            <tr>
                <td>{{ _MEMBERS_REPPWD }}</td>
                <td><input type="password" maxlength="40" size="16" name="repeatpassword" autocomplete="off" pattern="{{ $pattern_password }}" /></td>
            @php
                global $manager;
                $param = [
                    'type'   => 'activation',
                    'member' => $mem,
                ];
                $manager->notify('FormExtra', $param);
            @endphp
            </tr>
            <tr>
                <td>{{ _MEMBERS_SETPWD }}</td>
                <td><input type='submit' value='{{ _MEMBERS_SETPWD_BTN }}' /></td>
            </tr>
        </table>
    </form>
</div>
@endif