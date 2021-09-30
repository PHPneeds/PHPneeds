# Changelog

## [Unreleased](https://github.com/mertowitch/PHPneeds/compare/v0.4.0...HEAD)

## [v0.4.0](https://github.com/mertowitch/PHPneeds/compare/v0.3.2...v0.4.0) - 2021-09-30
### Added
- [**User class**](/libs/User.php) added
- "PREFIX" added to [Redis class](/libs/Redis.php) and [Redis config](/confs/conf.redis.php)
- "TABLES" schema added to [Database config](/confs/conf.db.default.php)
- "/tools/database/**create_table_users.php**" added
- "/tools/database/**create_user_admin.php**" added


- new methods added to [Database class](/libs/Database.php)
  - ->createTable( string $tableName ): bool
  - ->isTableExist( string $tableName ): bool
  - ->getSchema( string $tableName ): object


- new methods added to [User class](/libs/User.php)
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


## [v0.3.2](https://github.com/mertowitch/PHPneeds/compare/v0.3.1...v0.3.2) - 2021-09-20
### Changed
- README.md updated ([detail](https://github.com/mertowitch/PHPneeds/compare/v0.3.1...v0.3.2))
- Database class changed ([detail](https://github.com/mertowitch/PHPneeds/compare/v0.3.1...v0.3.2))
- Session class changed ([detail](https://github.com/mertowitch/PHPneeds/compare/v0.3.1...v0.3.2))

## [v0.3.1](https://github.com/mertowitch/PHPneeds/compare/v0.3.0...v0.3.1) - 2021-09-17
### Changed
- composer.json updated
