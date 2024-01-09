<h2>{{ _DELETE_CONFIRM }}</h2>

<p>{{ _CONFIRMTXT_COMMENT }}</p>

<div class="note">
    <b>{{ _EDITC_WHO }}:</b> {{ $author }}
    <br />
    <b>{{ _EDITC_TEXT }}:</b> {{ $body }}
</div>

<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="commentdeleteconfirm" />
       @php $manager->addTicketHidden(); @endphp
        <input type="hidden" name="commentid" value="{{ $commentid }}" />
        <input type="submit" tabindex="10" value="{{ _DELETE_CONFIRM_BTN }}" />
    </div>
</form>