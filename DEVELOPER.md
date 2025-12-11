# Developer Guide

This document is for developers and package maintainers working with NucleusCMS source code.

## Getting Started

### Installing from Git

1. **Clone the repository**:
   ```sh
   git clone https://github.com/NucleusCMS/NucleusCMS.git
   cd NucleusCMS
   ```

2. **Install Composer dependencies**:
   ```sh
   cd nucleus/libs
   composer install --no-dev
   composer dump-autoload --optimize --classmap-authoritative --no-dev
   cd ../..
   ```

3. **Configure installer** (see README.md)

4. **Run installer** via web browser

## Composer Dependencies

NucleusCMS uses Composer to manage PHP libraries. The dependencies are:

* **doctrine/dbal** (^4): Database abstraction layer (MySQL, MariaDB, SQLite, PostgreSQL)
* **eftec/bladeone** (^4): Template engine for admin interface
* **erusev/parsedown** (^1.7): Markdown parser for plugin help files

### Managing Dependencies

**Adding a package**:
```sh
cd nucleus/libs
composer require vendor/package-name
composer dump-autoload --optimize --classmap-authoritative --no-dev
```

**Removing a package**:
```sh
cd nucleus/libs
composer remove vendor/package-name
composer dump-autoload --optimize --classmap-authoritative --no-dev
```

**Updating packages**:
```sh
cd nucleus/libs
composer update --no-dev
composer dump-autoload --optimize --classmap-authoritative --no-dev
```

### Autoloader Optimization

Always regenerate the optimized autoloader after changing dependencies:
```sh
cd nucleus/libs
composer dump-autoload --optimize --classmap-authoritative --no-dev
```

This creates a classmap for all classes, eliminating filesystem lookups and improving performance.

## Creating Release Packages

### For End Users (Complete Package with vendor)

1. **Ensure dependencies are installed and optimized**:
   ```sh
   cd nucleus/libs
   composer install --no-dev
   composer dump-autoload --optimize --classmap-authoritative --no-dev
   cd ../..
   ```

2. **Create the release archive**:
   ```sh
   # From project root
   zip -r NucleusCMS-3.8.0-complete.zip . \
     -x "*.git*" \
     -x "*.DS_Store" \
     -x "*node_modules*" \
     -x "archives/*"
   ```

3. **Upload to GitHub Releases** as `NucleusCMS-x.x.x-complete.zip`

**Important**: End users need the vendor directory included. The complete package should contain all dependencies.

### For Developers (Source Code Only)

GitHub automatically creates source archives from tags. These archives exclude:
- `nucleus/libs/vendor/` (via `.gitattributes`)
- `nucleus/libs/composer.lock` (via `.gitattributes`)

Developers cloning or downloading source code must run `composer install` themselves.

## Package Size Optimization

The vendor directory has been heavily optimized:

- **Size**: ~3.2MB after cleanup
- **Optimizations applied**:
  - Removed unused dependencies (symfony/cache, doctrine/orm, phpxmlrpc)
  - Removed test directories and documentation files from vendor packages
  - Optimized autoloader with classmap
  - Replaced cebe/markdown with lighter erusev/parsedown

### Cleanup Script for Distribution

Before creating a release package, run the cleanup script to remove unnecessary files from the vendor directory:

```sh
cd nucleus/libs
composer install --no-dev --prefer-dist --optimize-autoloader
bash cleanup-vendor.sh
cd ../..
```

The `cleanup-vendor.sh` script removes:

* Test directories (`tests/`, `test/`, `Tests/`, `Test/`)
* Documentation files (`docs/`, `CHANGELOG*`, `CONTRIBUTING*`, `*.md`)
* CI/CD configuration (`.github/`, `.travis.yml`, etc.)
* Development tools (`phpunit.xml*`, `phpstan.neon*`, etc.)
* Git files (`.gitignore`, `.gitattributes`)

**Note**: Always verify the application works correctly after running the cleanup script.

## Development Workflow

### Local Development Setup

1. Clone repository
2. Install dependencies: `composer install --no-dev`
3. Configure `install/install-config.php`
4. Use Docker (see README.md) or configure local Apache/PHP/MySQL
5. Run installer

### Before Committing

- Test your changes
- Ensure code follows project standards
- Do NOT commit `vendor/` directory (it's in `.gitignore`)
- Do NOT commit real credentials in `install/install-config.php`

### Installer Access for Local Development

The installer uses Basic Authentication. For local work:
1. Copy `install/install-config.sample.php` to `install/install-config.php`
2. Set a username and password
3. **Never commit** this file with real credentials
4. Change credentials after installation if needed

## UI Implementation Guidelines

For implementing consistent user interfaces in the admin area, see:
- [UI Implementation Guide](docs/UI_IMPLEMENTATION_GUIDE.md) (English)
- [UI実装ガイドライン](docs/UI_IMPLEMENTATION_GUIDE-ja.md) (日本語)

These guidelines cover:
- Tab UI implementation
- Form structure and security
- Button styles
- Table display
- Language definitions
