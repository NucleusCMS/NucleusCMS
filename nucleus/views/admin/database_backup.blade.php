<h3>{{ _BACKUP_TITLE }}</h3>

<p>{{ _BACKUP_INTRO }}</p>

<form method="post" action="index.php">
    <input type="hidden" name="action" value="backupcreate" />
    {!! $manager->getHtmlInputTicketHidden() !!}

    <p>
        <input type="radio" name="gzip" value="1" checked="checked" id="gzip_yes" tabindex="410" />
        <label for="gzip_yes">{{ _BACKUP_ZIP_YES }}</label>
        <br />
        <input type="radio" name="gzip" value="0" id="gzip_no" tabindex="420" />
        <label for="gzip_no">{{ _BACKUP_ZIP_NO }}</label>
        <br /><br />
        <input type="submit" value="{{ _BACKUP_BTN }}" tabindex="430" class="btn-primary" />
    </p>
</form>

<div class="note">{{ _BACKUP_NOTE }}</div>

<h3>{{ _RESTORE_TITLE }}</h3>

<div class="note">{{ _RESTORE_NOTE }}</div>

<p>{{ _RESTORE_INTRO }}</p>

<form method="post" action="index.php" enctype="multipart/form-data">
    <input type="hidden" name="action" value="backuprestore" />
    {!! $manager->getHtmlInputTicketHidden() !!}

    <p>
        <input name="backup_file" type="file" tabindex="440" />
        <br /><br />
        <input type="submit" value="{{ _RESTORE_BTN }}" tabindex="450" class="btn-primary" />
        <br /><br />
        <input type="checkbox" name="letsgo" value="1" id="letsgo" tabindex="460" />
        <label for="letsgo">{{ _RESTORE_IMSURE }}</label>
        <br />
        <span class="warning">{{ _RESTORE_WARNING }}</span>
    </p>
</form>
