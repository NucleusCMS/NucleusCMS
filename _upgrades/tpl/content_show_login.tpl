    <h1>{%_UPG_TEXT_PLEASE_LOGIN%}</h1>
    <p>{%_UPG_TEXT_ENTER_YOUR_DATA%}:</p>

    <form method="post" action="{%type%}">
        <ul>
            <li>{%_UPG_TEXT_NAME%}: <input name="login" /></li>
            <li>{%_UPG_TEXT_PASSWORD%} <input name="password" type="password" /></li>
        </ul>
        <p>
            <input name="action" value="login" type="hidden" />
            <input type="submit" value="{%_UPG_TEXT_LOGIN%}" />
        </p>
    </form>
