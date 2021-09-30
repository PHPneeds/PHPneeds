# Changelog

## [Unreleased](https://github.com/mertowitch/PHPneeds/compare/v0.3.2...HEAD)
### Added
- [**User class**](/libs/User.php) added
- "PREFIX" added to [Redis class](/libs/Redis.php) and [Redis config](/confs/conf.redis.php)
- "/tools/database/**create_table_users.php**" added
- new methods added to [Database class](/libs/Database.php)
  - ->createTable( string $tableName ): bool
  - ->isTableExist( string $tableName ): bool
  - ->getSchema( string $tableName ): object
- new methods added to **User class**
  - ->login( string $username, string $password ): bool
  - ->_verifyCredential( string $username, string $password ): bool
  - ->createUser( string $username, string $password ): bool

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
