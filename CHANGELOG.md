# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Upgraded to Laravel 13.
- Added `serializable_classes` config to cache.

### Changed

- Upgraded `laravel/framework` to `^13.0`.
- Upgraded `laravel/tinker` to `^3.0`.
- Upgraded `livewire/livewire` to `^4.0`.
- Upgraded `laradumps/laradumps` to `^5.0`.
- Upgraded `pestphp/pest` to `^4.0`.
- Upgraded `pestphp/pest-plugin-laravel` to `^4.0`.
- Upgraded `pestphp/pest-plugin-type-coverage` to `^4.0`.
- Upgraded `phpstan/phpstan` to `^2.1`.
- Added `phpunit/phpunit` to `^12.0`.

## [1.0.4] - 2026-04-08

### Added

- Updated composer and npm packages.

## [1.0.3] - 2025-07-18

### Added

- Lint and test worflow.
- Automaticaly generate IDE helper files using vite.

### Changed

- Added Unit directory to pest extend.
- `vite` version bump to 7.x.
- Replaced `pnpm` in favor of `npm` for tests on ci.
- Revamped user settings and add user button component to the main layout header.
- Used Inter font as a package.
- Updated npm packages.
- Updated validation custom attributes.
- Lowered phpstan level to 5.

### Fixed

- Add dark theme attribute to the root element.
- Delete user image on user deletion.

## [1.0.2] 2025-04-12

### Added

- Added User model test.
- Added pt_PT language files.
- Added log files web viewer.

## [1.0.1] 2025-04-04

### Added

- Account photos now use Intervention Image for processing.
- Added tests to validate uploaded account photo size and dimensions.
- Added this CHANGELOG file.

### Changed

- Updated project dependencies to the latest versions.
- Updated welcome page styling to use Tabler UI kit.

### Removed

- Removed Tailwind CSS.

### Fixed

- Fixed account photo upload test.

## [1.0.0] - 2025-03-31

### Added

- Integrated Larastan, Pint, Prettier, Rector, Debugbar, and Laradumps.
- Integrated Tabler UI kit and dashboard template.
- Added user user registration, authentication, password reset, email verification and password confirmation settings management.
- Added unit and feature tests.
- Implemented a GitHub testing workflow.

[unreleased]: https://github.com/santosvilanculos/cuirass/compare/v1.0.3...HEAD
[1.0.4]: https://github.com/santosvilanculos/cuirass/compare/v1.0.3...v1.0.4
[1.0.3]: https://github.com/santosvilanculos/cuirass/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/santosvilanculos/cuirass/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/santosvilanculos/cuirass/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/santosvilanculos/cuirass/releases/tag/v1.0.0
