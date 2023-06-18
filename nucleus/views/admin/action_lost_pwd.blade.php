<h2>{{ _ADMIN_LOST_PSWD_TEXT_TITLE }}</h2>
<p>{{ _ADMIN_LOST_PSWD_TEXT_1 }}</p>
<form method="post" action="../action.php">
    <p>
        <label for="nucleus_pf_username">{{ _ADMIN_LOST_PSWD_TEXT_USENAME }}</label><br />
        <input type="text" name="name" id="nucleus_pf_username" /><br />

        <label for="nucleus_pf_email">{{ _ADMIN_LOST_PSWD_TEXT_EMAIL }}</label><br />
        <input type="text" name="email" id="nucleus_pf_email" /><br />
        <br />

        <input type="hidden" name="action" value="forgotpassword" />
        <input type="submit" value="{{ _ADMIN_LOST_PSWD_TEXT_3 }}" class="transparent" />
    </p>
</form>

<p>{{ _ADMIN_LOST_PSWD_TEXT_2 }}</p>