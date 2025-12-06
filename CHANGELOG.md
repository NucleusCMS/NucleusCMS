# Changelog

All notable changes to NucleusCMS will be documented in this file.

## [3.8.0] - 2024-12-06

### Added
- SQLite and PostgreSQL database support (in addition to MySQL/MariaDB)
- Optimized Composer autoloader for improved performance (classmap-authoritative)
- `.gitattributes` configuration to exclude vendor directory from Git archives
- Detailed installation instructions with step-by-step guide
- Improved installer error messages with specific instructions

### Changed
- **Reduced package size from 8.5MB to 2.2MB** (74% reduction)
- Replaced `cebe/markdown` (86KB) with lighter `erusev/parsedown` (57KB)
- System requirements: PHP 8.1 - 8.3 (updated from 7.x)
- Database abstraction now uses `doctrine/dbal` only (removed `doctrine/orm`)
- Simplified installation message for non-technical users

### Removed
- **XML-RPC API support** (Blogger API, MetaWeblog API, Movable Type API)
  - Remote blog posting via desktop/mobile apps no longer supported
  - Affected apps: Windows Live Writer, MarsEdit, BlogPress, etc.
  - If you need this feature, use version 3.7.x instead
- `phpxmlrpc/phpxmlrpc` package (558KB)
- `symfony/cache` package (900KB) - was unused
- `doctrine/orm` package (2.2MB) - only DBAL features were used
- Test directories and documentation files from vendor packages (600KB)
- `extra/xmlrpc/` directory
- `nucleus/libs/xmlrpc_server/` directory

### Optimizations
- Vendor directory optimized: removed development files (tests, docs, config files)
- Generated optimized autoloader classmap (468 classes mapped)
- Total vendor package reduction: 6.3MB (74%)

### Dependencies
Current Composer packages (2.2MB total):
- `doctrine/dbal` ^4 (1.8MB) - Database abstraction layer
- `eftec/bladeone` ^4 (194KB) - Admin template engine
- `erusev/parsedown` ^1.7 (57KB) - Markdown parser

### Breaking Changes
⚠️ **XML-RPC API Removed**: If you use remote blog posting applications, they will no longer work after upgrading to v3.8. Consider using the web admin interface or stay on v3.7.x if this feature is essential.

## [3.7.x] - Previous Versions

For changes in earlier versions, refer to the project's Git history or previous release notes.
