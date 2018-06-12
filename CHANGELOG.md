# Changelog
All notable changes to this project will be documented in this file.

## [1.1.3] - 2018-06-12

### Fixed
- removed file system debugging

## [1.1.2] - 2018-02-27

### Fixed
- missing `.htaccess` inside assets directory, required by contao 4 in order to create symlink inside `web/system/modules` directory

## [1.1.1] - 2018-02-07

### Fixed
- handle with contao 4 `esi` tags

## [1.1.0] - 2018-02-07

### Fixed
- contao 4 compatibilty (see: https://github.com/heimrichhannot/contao-hyphenator/issues/1) by replacing `bariew/phpquery` with `wa72/htmlpagedom`

### Changed
- licence model name from `LGPL-3.0+` to `LGPL-3.0-or-later`
