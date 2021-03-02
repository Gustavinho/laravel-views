# Changelog

## [2.2] - 2021-03-01
### Added
- New list view
- New detail view with
  - Default component
  - Default component customization
  - Multiple components
  - Actions
- Feature to set the width for each column in the TableView
- Documentation for the new detail view
- New `attributes-list` component
- New `layout` component

### Changed
- The `title` action now is included as an attribute in the `a` tag for each action.
- Internal refactors
  - Base `DataView` class with all the features to manage the data (filters, search, actions, pagination etc) on the table, grid, and list view.
- Refactored actions feature to be reused as a trait
- Refactored actions test to be reused as a trait

### Fixed
- Bug with pagination and filters, the pagination was not being reset after a new search

## [2.1] - 2021-01-10
### Added
- Option to customize which assets will be imported
- The current view instance is passed as a param to the action to be executed

### Changed
- The filter button was changed by an icon button
- Updated documentation
  - Added how to purge `laravel-views` styles
  - Added how to render components using `Livewire`


## [2.0] - 2020-09-13
### Added
- Added compatibility for Laravel Livewire 2.x

## [1.1] - 2020-09-03
### Added
- New `GridView` class.
- Confirmation message on actions.
- Search input with support for relational fields.
- Sort table view columns
- More UI components for table and grid view.
  - Link
  - Icons

## [1.0.6] - 2020-08-22
- Fixed typos
- Fixed filter stub file name

## [1.0.5] - 2020-08-09
### Fixed
- Fixed default behavior clicking on actions adding a prevent directive

## [1.0.4] - 2020-07-26
### Fixed
- Fixed some typos and syntax errors
- Fixed the query builder wrapping the table view search

## [1.0.3] - 2020-07-18
### Fixed
- Fixed a bug using multiple redirect actions on the same table
- Fixed some typos on the documentation

### Added
- Added road map to the documentation
- Added contribution guide to the documentation

### Changed
- Moved helpers load to composer

## [1.0.2] - 2020-07-13
### Fixed
- Added support for newer livewire versions
- Fixed some typos on the documentation
- Fixed assets URL

## [1.0.1] - 2020-06-27
### Added
- Added the changelog file
- Added a overflow-y utility to the table view layout
- Added missing `renderIf` documentation to the actions by row section
### Changed
- Changed inputs border color
### Fixed
- Fixed some broken links on the documentation
- Bumped websocket-extensions from 0.1.3 to 0.1.4

## [1.0.0] - 2020-06-14
### Added
- Created base LaravelViews class
- Created the TableView component
 - Search inpurt feature
 - Customizable filters
 - Actions by row
- Definied components customization