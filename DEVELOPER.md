# Developer guide

This document collects notes that are primarily relevant to developers and package maintainers.

## Composer dependencies

NucleusCMS uses Composer for some libraries, but end users do not need to run Composer themselves if you ship a packaged build. To bundle the dependencies:

1. On a development machine with Composer installed, run `composer install --no-dev --optimize-autoloader` in the project root.
2. Keep the generated `composer.lock` under version control so the exact dependency versions are tracked.
3. Include the resulting `vendor/` directory in your release archive or installer so users who cannot use Composer still receive the required libraries.
4. Rebuild the `vendor/` directory whenever `composer.json` or `composer.lock` changes to keep shipped libraries in sync.

## Installer access for local development

The installer uses Basic Authentication. For local work, set a username and password in `install/install-config.php` before running the installer. Avoid committing real credentials to version control and rotate them after use.
