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
                    <button type="button" class="login-form__link" id="forgot-password-trigger">{{ _LOGIN_FORGOT }}</button>
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

    <div class="modal" id="forgot-password-modal" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal__backdrop" data-modal-close></div>
        <div class="modal__dialog" role="document">
            <header class="modal__header">
                <h2 class="modal__title">{{ _LOGIN_FORGOT }}</h2>
                <button type="button" class="modal__close" aria-label="{{ _CLOSE }}" data-modal-close>&times;</button>
            </header>
            <div class="modal__body">
                <p class="modal__lead">{{ _ADMIN_LOST_PSWD_TEXT_1 }}</p>
                <form method="post" action="../action.php" class="modal__form" id="forgot-password-form">
                    <label class="modal__label" for="nucleus_pf_username">{{ _ADMIN_LOST_PSWD_TEXT_USENAME }}</label>
                    <input class="modal__input" type="text" name="name" id="nucleus_pf_username" required />

                    <label class="modal__label" for="nucleus_pf_email">{{ _ADMIN_LOST_PSWD_TEXT_EMAIL }}</label>
                    <input class="modal__input" type="email" name="email" id="nucleus_pf_email" required />

                    <input type="hidden" name="action" value="forgotpassword" />
                    <button type="submit" class="modal__submit">{{ _ADMIN_LOST_PSWD_TEXT_3 }}</button>
                </form>
                <p class="modal__note">{{ _ADMIN_LOST_PSWD_TEXT_2 }}</p>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('forgot-password-modal');
            const trigger = document.getElementById('forgot-password-trigger');
            const closers = modal.querySelectorAll('[data-modal-close]');

            const openModal = () => {
                modal.setAttribute('aria-hidden', 'false');
                modal.classList.add('is-visible');
                const firstInput = modal.querySelector('input');
                if (firstInput) firstInput.focus();
            };

            const closeModal = () => {
                modal.setAttribute('aria-hidden', 'true');
                modal.classList.remove('is-visible');
                trigger.focus();
            };

            trigger.addEventListener('click', openModal);
            closers.forEach((el) => el.addEventListener('click', closeModal));
            modal.addEventListener('click', (event) => {
                if (event.target === modal) closeModal();
            });
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('is-visible')) {
                    closeModal();
                }
            });
        })();
    </script>
</body>
</html>
