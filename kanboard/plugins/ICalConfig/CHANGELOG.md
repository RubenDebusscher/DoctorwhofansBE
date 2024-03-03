# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

- Nothing so far

---

## Releases

## [v0.4.0](https://codeberg.org/abu/ICalConfig/releases/tag/v0.4.0) - 2023-04-28

### Added

- Insert VTIMEZONE component. The component is downloaded from tzurl.org and stored in a cookie for reuse.
- Add missing plugin function getCompatibleVersion().
- Add German translations.

## [v0.3.0](https://codeberg.org/abu/ICalConfig/releases/tag/v0.3.0) - 2023-03-27

### Added
- Option 'Do not add any TZID'.
- Option to edit Calendar Settings. Only visible if no Calendar plugin is installed.
- Option to create custom, multiple reminders.

### Changed
- Reordered settings

## [v0.2.0](https://codeberg.org/abu/ICalConfig/releases/tag/v0.2.0) - 2023-03-09

### Changed
- Reminders are now related to due/end date.

### Added
- Option 'Show as all-day events'
- More trigger for reminders. Possible selections are
    - 0, 5, 15, 30 minutes
    - 1, 2, 12 hours
    - 1, 2 days
    - 1 week

## [v0.1.0](https://codeberg.org/abu/ICalConfig/releases/tag/v0.1.0) - 2023-03-04

- Initial release
