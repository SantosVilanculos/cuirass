# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

No changes yet.

## [1.0.1] 2025-04-04

### Added

- Account photos now use Intervention Image for processing.
- Added tests to validate uploaded account photo size and dimensions.
- Disabled model lazy loading when not in production.
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
- Added user authentication and settings management.
- Added unit and feature tests.
- Implemented a GitHub testing workflow.

[unreleased]: https://github.com/santosvilanculos/cuirass/compare/v1.0.1...HEAD
[1.0.1]: https://github.com/santosvilanculos/cuirass/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/santosvilanculos/cuirass/releases/tag/v1.0.0
