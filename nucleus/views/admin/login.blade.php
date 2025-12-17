<!DOCTYPE html>
<html lang="{{ _LANG_CODE }}">
<head>
    <meta charset="{{ _CHARSET }}" />
    <meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $SiteName }} - {{ _LOGIN }}</title>
    <link rel="stylesheet" href="{{ $baseUrl }}styles/login.css" />
</head>
<body class="login-page">
    <div class="login-shell">
        <div class="login-card">
            <div class="login-card__header">
                <h1 class="login-card__title">{{ $SiteName }}</h1>
            </div>
            @if ($msg)
                <div class="login-alert">{!! $msg !!}</div>
            @endif
            <form action="index.php" method="post" class="login-form">
                <label for="login-name" class="login-form__label">{{ _LOGIN_NAME }}</label>
                <input id="login-name" name="login" tabindex="10" maxlength="32" class="login-form__input" required />

                <label for="login-password" class="login-form__label">{{ _LOGIN_PASSWORD }}</label>
                <input id="login-password" name="password" tabindex="20" maxlength="40" type="password" class="login-form__input" required />

                <div class="login-form__options">
                    <label class="login-checkbox">
                        <input type="checkbox" value="1" name="shared" tabindex="40" />
                        <span>{{ _LOGIN_SHARED }}</span>
                    </label>
                    <a class="login-form__link" href="{{ ADMIN::getAdminRootURI() }}index.php?action=lost_pwd">{{ _LOGIN_FORGOT }}</a>
                </div>

                <input name="action" value="login" type="hidden" />
                @if($passRequestVars) @php \passRequestVars(); @endphp @endif

                <button type="submit" class="login-form__submit" tabindex="30">{{ _LOGIN }}</button>
            </form>
        </div>
        <footer class="login-footer">
            Nucleus CMS © 2002-2025
        </footer>
    </div>
</body>
</html>
