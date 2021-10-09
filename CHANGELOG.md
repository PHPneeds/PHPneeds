# Changelog

## [Unreleased](https://github.com/PHPneeds/PHPneeds/compare/v1.1.0...HEAD)

## [v1.1.0](https://github.com/PHPneeds/PHPneeds/compare/v1.0.1...v1.1.0) - 2021-10-09
### Added
- Image class and config file
- Directories added:
  - storage/images/**cache**
  - storage/images/**origin**

### Changed
- Image object added to /common/**init.php**
- Namespace syntax changed in /common/**init.php**

### Fixed
- Some fixes

## [v1.0.1](https://github.com/PHPneeds/PHPneeds/compare/v1.0.0...v1.0.1) - 2021-10-03
### Fixed
- Error handling on Database and Redis ojbect creation in init.php

## [v1.0.0](https://github.com/PHPneeds/PHPneeds/compare/v0.4.0...v1.0.0) - 2021-10-02
### Added
- **jquery 3.6.0** added to /public/assets/vendor/jquery
- **bootstrap 5.1.1** added to /public/assets/vendor/bootstrap


- New directories:
  - /public/assets/**css**/
  - /public/assets/**js**/
  - /public/assets/**vendor**/

### Changed
- config filenames extensions changed to ".sample"
- composer.json

### Removed
- "**/libs/***" directory (separated to **PHPneeds/Libs** library)

## [v0.4.0](https://github.com/PHPneeds/PHPneeds/compare/v0.3.2...v0.4.0) - 2021-09-30
### Added
- User class added
- "PREFIX" added to Redis class and Redis config
- "TABLES" schema added to [Database config](/confs/conf.db.default.php.sample)
- "/tools/database/**create_table_users.php**" added
- "/tools/database/**create_user_admin.php**" added


- new methods added to **Database class**
  - ->createTable( string $tableName ): bool
  - ->isTableExist( string $tableName ): bool
  - ->getSchema( string $tableName ): object


- new methods added to **User class**
  - ->login( string $username, string $password ): bool
  - ->_verifyCredential( string $username, string $password ): bool
  - ->createUser( string $username, string $password ): bool
  - ->changePassword( string $username, string $newPassword ): bool

### Changed
- **User object** added to [init.php](/common/init.php)
- **/images** directory moved to [/public/assets/images](/public/assets/images)
- Some edits on;
  - README.md
  - CHANGELOG.md


## [v0.3.2](https://github.com/PHPneeds/PHPneeds/compare/v0.3.1...v0.3.2) - 2021-09-20
### Changed
- README.md updated ([detail](https://github.com/PHPneeds/PHPneeds/compare/v0.3.1...v0.3.2))
- Database class changed ([detail](https://github.com/PHPneeds/PHPneeds/compare/v0.3.1...v0.3.2))
- Session class changed ([detail](https://github.com/PHPneeds/PHPneeds/compare/v0.3.1...v0.3.2))

## [v0.3.1](https://github.com/PHPneeds/PHPneeds/compare/v0.3.0...v0.3.1) - 2021-09-17
### Changed
- composer.json updated
