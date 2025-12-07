NucleusCMS 3.80
==========

# About

Nucleus is a Content Management System (CMS)

# System Requirements

* Web server: Apache2
* PHP: 8.1 - 8.3
* Database: MySQL / MariaDB / SQLite / PostgreSQL

# Documentation

[nucleus/documentation/index.html](./nucleus/documentation/index.html)

# Installation

## For Users

1. **Download** the complete package from [Releases](https://github.com/NucleusCMS/NucleusCMS/releases)
   - Download `NucleusCMS-x.x.x-complete.zip` (includes all dependencies)

2. **Extract** the zip file on your computer

3. **Upload** all files to your web server via FTP

4. **Configure installer authentication**:
   - Rename `install/install-config.sample.php` to `install/install-config.php`
   - Edit the file and set your username and password
   - Choose authentication mode (BASIC or IP)

5. **Run installer**:
   - Access `http://yoursite.com/install/` in your browser
   - Enter the username/password you set in step 4
   - Follow the on-screen instructions

> Security note: The admin area now only warns about the installer auth file `install/install-config.php` being left on the server. Remove it (or rotate the credentials) when installation or upgrade is complete.

**No command-line or Composer knowledge required!**

## For Developers

If you're developing NucleusCMS or installing from Git, see [DEVELOPER.md](./DEVELOPER.md).

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