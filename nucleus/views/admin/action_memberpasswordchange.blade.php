<a href="{{ $back_uri }}">{{ $back_text }}</a>

<h2>{{ _MEMBERS_CHANGE_PASSWORD }}</h2>

<form method="post" action="index.php" name="memberpasswordchange"><div>

<input type="hidden" name="action" value="memberpasswordchangeconfirm" />
<input type="hidden" name="memberid" value="{{ $member->getID() }}" />
@php $manager->addTicketHidden(); @endphp
@php $member->addTokenHidden(); @endphp

<table>
    <tr>
        <th colspan="2">{{ _MEMBERS_SETPWD }}</th>
    </tr>
    <tr>
        <td width="40%">{{ _MEMBERS_DISPLAY }} @php help('shortnames'); @endphp</small></td>
        <td>{{ $member->getDisplayName() }}</td>
    </tr>
    <tr>
        <td>{{ _MEMBERS_REALNAME }}</td>
        <td>{{ $member->getRealName() }}</td>
    </tr>
    <tr>
        <td>{{ _MEMBERS_CURRENT_PASSWORD }} <span style="color:red; font-size: small; vertical-align: text-bottom;">*</span></td>
        <td><input type="password" tabindex="30" maxlength="40" size="16" name="currentpassword" autocomplete="on"  required pattern="{{ $pattern_password }}" /></td>
    </tr>
    <tr>
        <td>{{ _MEMBERS_NEW_PASSWORD }} <span style="color:red; font-size: small; vertical-align: text-bottom;">*</span><br />
            <small>{{ _MEMBERS_PASSWORD_INFO }} @php help('password'); @endphp</small></td>
        <td><input type="password" tabindex="30" maxlength="40" size="16" name="password" autocomplete="new-password" required pattern="{{ $pattern_password }}" /></td>
    </tr>
    <tr>
        <td>{{ _MEMBERS_REPPWD }} <span style="color:red; font-size: small; vertical-align: text-bottom;">*</span></td>
        <td><input type="password" tabindex="35" maxlength="40" size="16" name="repeatpassword" autocomplete="new-password" required pattern="{{ $pattern_password }}" /></td>
    </tr>
    <tr>
        <th colspan="2">{{ _MEMBERS_CHANGE_PASSWORD }}</th>
    </tr>
    <tr>
        <td>{{ _MEMBERS_SETPWD }}</td>
        <td><input type="submit" tabindex="90" value="{{ _MEMBERS_SETPWD_BTN }}" onclick="return checkSubmit(this);" /></td>
    </tr>
</table>

</div></form>