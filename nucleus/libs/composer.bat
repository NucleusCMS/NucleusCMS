@echo off
setlocal
set "PATH=%PATH%;C:\Program Files\php;C:\Program Files\php\8.3"
set "COMPOSER_HOME=%CD%\composer"
set "COMPOSER_VENDOR_DIR=%CD%\vendor"
php composer.phar %*
endlocal
