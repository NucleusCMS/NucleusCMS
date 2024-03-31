#!/user/local/bin/bash
(
    export PATH="$PATH:/usr/local/php/bin:/usr/local/php/8.3/bin";
    export COMPOSER_HOME="$PWD/composer";
    export COMPOSER_VENDOR_DIR="$PWD/vendor";
    php "$PWD/composer.phar" "$@"
)
