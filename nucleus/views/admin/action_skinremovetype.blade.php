<h2>{{ _DELETE_CONFIRM }}</h2>

<p>
{{ $confirm_title }}
</p>
<p>
    <b>{{ $skintype }} ({{ $name }})</b> ({{ $desc }})
</p>

<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="skinremovetypeconfirm" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="skinid" value="{{ $skinid }}" />
        <input type="hidden" name="partstype" value="{{ $spartstype }}" />
        <input type="hidden" name="type" value="{{ $skintype }}" />
        <input type="submit" tabindex="10" value="{{ _DELETE_CONFIRM_BTN }}" />
    </div>
</form>