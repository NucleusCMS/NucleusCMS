<h2>{{ _EDITC_TITLE }}</h2>

<form action="index.php" method="post">
    <div>
        <input type="hidden" name="action" value="commentupdate" />
        @php $manager->addTicketHidden(); @endphp
        <input type="hidden" name="commentid" value="{{ $comment['commentid'] }}" />
        <table>
            <tr>
                <th colspan="2">{{ _EDITC_TITLE }}</th>
            </tr>
            <tr>
                <td>{{ _EDITC_WHO }}</td>
                <td>@if ($comment['member'])
                        {{ $comment['member'] }} ({{ _EDITC_MEMBER }})
                    @else
                        {{ $comment['user'] }} ({{ _EDITC_NONMEMBER }})
                    @endif
                </td>
            </tr>
            <tr>
                <td>{{ _EDITC_WHEN }}</td>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <td>{{ _EDITC_HOST }}</td>
                <td>{{ $comment['host'] }}</td>
            </tr>
            <tr>
                <td>{{ _EDITC_URL }}</td>
                <td><input type="text" name="url" size="30" tabindex="6" value="{{ $comment['userid'] }}" /></td>
            </tr>
            <tr>
                <td>{{ _EDITC_EMAIL }}</td>
                <td><input type="text" name="email" size="30" tabindex="8" value="{{ $comment['email'] }}" /></td>
            </tr>
            <tr>
                <td>{{ _EDITC_TEXT }}</td>
                <td>
                    <textarea name="body" tabindex="10" rows="10" cols="50">{{ $comment['body'] }}</textarea>
                </td>
            </tr>
            <tr>
                <td>{{ _EDITC_EDIT }}</td>
                <td><input type="submit" tabindex="20" value="{{ _EDITC_EDIT }}" onclick="return checkSubmit();" /></td>
            </tr>
        </table>
    </div>
</form>
        