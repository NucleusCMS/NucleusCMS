<h2>{{ _LOGIN }}</h2>

{{ $msg }}

<form action="index.php" method="post">
    <p>
        {{ _LOGIN_NAME }} <br /><input name="login" tabindex="10" class="login-input" maxlength="32" required />
        <br />
        {{ _LOGIN_PASSWORD }} <br /><input name="password" tabindex="20" class="login-input" maxlength="40" type="password" required />
        <br />
        <input name="action" value="login" type="hidden" />
        <br />
        <input type="submit" value="{{ _LOGIN }}" tabindex="30" />
        <br />
        <small>
            <input type="checkbox" value="1" name="remember" tabindex="40" id="remember" /><label for="remember">{{ _LOGIN_REMEMBER }}</label>
            <br /><a href="{{ ADMIN::getAdminRootURI() }}index.php?action=lost_pwd">{{ _LOGIN_FORGOT }}</a>
        </small>
        @if($passRequestVars) @php \passRequestVars(); @endphp @endif
    </p>
</form>
