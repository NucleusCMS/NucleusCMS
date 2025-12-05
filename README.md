NucleusCMS 3.80
==========

# About

Nucleus is a Content Management System (CMS)

# Operating environment

* Web server: Apache2

* PHP: 8.1 - 8.3

* Database: MySQL / MariaDB


# Documentation

[nucleus/documentation/index.html](./nucleus/documentation/index.html)


# Install

Initial settings are required. Please read the documentation first.

# Composer dependencies

NucleusCMS uses Composer for some libraries, but end users do not need to run Composer themselves if you ship a packaged build. To bundle the dependencies:

1. On a development machine with Composer installed, run `composer install --no-dev --optimize-autoloader` in the project root.
2. Keep the generated `composer.lock` under version control so the exact dependency versions are tracked.
3. Include the resulting `vendor/` directory in your release archive or installer so users who cannot use Composer still receive the required libraries.
4. Rebuild the `vendor/` directory whenever `composer.json` or `composer.lock` changes to keep shipped libraries in sync.

# Upgrade

It will remain under maintenance until the upgrade is complete.

Please read the documentation first. Please access the upgrade URL.

<br>

# License

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  (see nucleus/documentation/index.html#license for more info)