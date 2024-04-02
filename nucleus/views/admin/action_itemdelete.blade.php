<h2>{{ _DELETE_CONFIRM }}</h2>

<p>{{ _CONFIRMTXT_ITEM }}</p>

<div>
    <div class="note">
        <b>"{{ $title }}"</b>
        <br />
        {{ $body }}
    </div>
</div>
<div>
    <form method="post" action="index.php">
        <input type="hidden" name="action" value="itemdeleteconfirm" />
        <?php $manager->addTicketHidden(); ?>
        <input type="hidden" name="itemid" value="{{ $itemid }}" />
        <div class="confirm">
        <input type="submit" value="{{ _ADMIN_TEXT_BTN_EXECUTE }}" tabindex="10" />
        </div>
    </form>
    <div class="confirm">
    <input type="button" onclick="history.back();" value="{{ _ADMIN_TEXT_BTN_CANCEL }}">
    </div>
</div>