<h2>{{ _DELETE_CONFIRM }}</h2>

<p>{{ _CONFIRMTXT_TEAM1 }}<b>{{ $teammem->getDisplayName() }}</b>{{ _CONFIRMTXT_TEAM2 }} : <b>{{ strip_tags($blog->getName()) }}</b>
</p>

<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="teamdeleteconfirm" />
        <?php $manager->addTicketHidden() ?>
        <input type="hidden" name="memberid" value="{{ $memberid }}" />
        <input type="hidden" name="blogid" value="{{ $blogid }}" />
        <input type="submit" tabindex="10" value="{{ _DELETE_CONFIRM_BTN }}" />
    </div>
</form>