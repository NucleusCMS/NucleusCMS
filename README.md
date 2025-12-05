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

The installer is protected by Basic Authentication. **Before running the installer, copy `install/install-config.sample.php` to `install/install-config.php` and set your own username and password** for the installer prompt. Keep these credentials secure and change them after installation if you no longer need the protection.

# Docker (local install)

You can run NucleusCMS locally with Docker to install and try the CMS quickly.

1. Prepare installer credentials (copy the sample if the file does not exist):

   ```sh
   cp install/install-config.sample.php install/install-config.php
   ```

2. Build and start the stack with the bundled `compose.yaml`:

   ```sh
   docker compose up --build
   ```

3. In your browser, open [http://localhost/install](http://localhost/install). When the Basic Auth prompt appears, enter the username and password you set in `install/install-config.php`.

4. In the installer, enter the following database settings (the MySQL container listens as `db` on the internal network):

   * Host: `db`
   * Database: `nucleus`
   * Username: `nucleus`
   * Password: `nucleus`

   The MySQL root password is `nucleus-root` if you need it for administration.

5. The `db_data` volume keeps database files between restarts, and your working directory is mounted into the web container for easy edits.

If the installer reports a connection error, make sure the database credentials entered in Step 3 match the values in `compose.yaml`. When reusing an old `db_data` volume with different credentials, reset it with `docker compose down -v` and start again.

# Developer guide

For Composer packaging steps and other developer-oriented notes, see [DEVELOPER.md](./DEVELOPER.md).

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