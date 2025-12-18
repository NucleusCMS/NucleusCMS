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
                <div class="login-form__password">
                    <input id="login-password" name="password" tabindex="20" maxlength="40" type="password" class="login-form__input login-form__input--password" required />
                    <button type="button" class="password-toggle" id="password-toggle" aria-label="パスワードを表示" aria-pressed="false">
                        <svg viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false">
                            <path d="M12 5.5c4.5 0 8.4 2.9 10 6.5-1.6 3.6-5.5 6.5-10 6.5S3.6 15.6 2 12c1.6-3.6 5.5-6.5 10-6.5Zm0 2c-3.4 0-6.5 2.1-7.8 4.5 1.3 2.4 4.4 4.5 7.8 4.5s6.5-2.1 7.8-4.5C18.5 9.6 15.4 7.5 12 7.5Zm0 1.8a2.7 2.7 0 1 1 0 5.4 2.7 2.7 0 0 1 0-5.4Zm0 1.6a1.1 1.1 0 1 0 0 2.2 1.1 1.1 0 0 0 0-2.2Z"></path>
                        </svg>
                    </button>
                </div>

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
                    <label class="modal__label" for="nucleus_pf_email">{{ _ADMIN_LOST_PSWD_TEXT_EMAIL }}</label>
                    <input class="modal__input" type="email" name="email" id="nucleus_pf_email" required />

                    <input type="hidden" name="action" value="forgotpassword" />
                    <button type="submit" class="modal__submit">{{ _ADMIN_LOST_PSWD_TEXT_3 }}</button>
                </form>
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

            const passwordInput = document.getElementById('login-password');
            const passwordToggle = document.getElementById('password-toggle');
            const labelShow = 'パスワードを表示';
            const labelHide = 'パスワードを非表示';

            if (passwordInput && passwordToggle) {
                passwordToggle.addEventListener('click', () => {
                    const isHidden = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isHidden ? 'text' : 'password');
                    passwordToggle.setAttribute('aria-pressed', String(isHidden));
                    passwordToggle.setAttribute('aria-label', isHidden ? labelHide : labelShow);
                    passwordToggle.classList.toggle('is-active', isHidden);
                });
            }
        })();
    </script>
</body>
</html>
