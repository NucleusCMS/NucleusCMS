<h2>{{ _DELETE_CONFIRM }}</h2>

<p>
{{ _CONFIRMTXT_SKIN }}<b>{{ $name }}</b> ({{ $desc }})
</p>

<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="skindeleteconfirm" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="skinid" value="{{ $skinid }}" />
        <input type="submit" tabindex="10" value="{{ _DELETE_CONFIRM_BTN }}" />
    </div>
</form>