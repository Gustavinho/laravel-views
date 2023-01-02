# Changelog
## [2.4.1] - 2023-01-02
### Fixed
- Fixed a bug displaying error alerts as success
- Fixed a bug with XSS injections
- Fixed a bug using dynamic tailwindcss classes
- Fixed a bug resetting the value with the the inline editing
- Removed `doc` files from this repo
## [2.4.0] - 2021-09-29
### Added
- Inline editing component
- New tooltip component
- Added new loading indicator next to the toolbar
## Changed
- Added tooltips to the icon actions.
## [2.3.0] - 2021-06-26
### Added
- Default value for filters
- Sortable list and grid views
- Bulk actions to the table, list, and grid views on the current page
- Customized JS scripts
- Model class property to the table, list, and grid views

### Changed
- Internal refactors
- UI improvements

## [2.2.5] - 2021-05-29
### Fixed
- Added a `min-h-screen` to all the views to avoid the filters menu cutting off when thre are not so much data.
## [2.2.4] - 2021-05-16
### Fixed
- Fixed alert container to avoid blocking the UI elements.
- Fixed filers button positioning when there isn't a search textinput

## [2.2.3] - 2021-04-14
### Changed
- Live demo URL in the docs
## [2.2.2] - 2021-04-10
### Fixed
- Changed `$model->getKey()` insted of hardcoded `$model->id`

## [2.2.1] - 2021-03-29
### Fixed
- Added `detail-view`, `grid-view` and `list-view` to the views to be published.

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