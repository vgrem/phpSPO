# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [Unreleased]

## [3.1.2] - 2024-04-21

### Added

- `GraphServiceClient::withUserCredentials` and `GraphServiceClient::withClientSecret` methods introduced

### Fixed

-  #337: Don't try to retrieve next set of items when using an iterator, if no next items are expected to exist

## [3.0.3] - 2023-07-15

### Added

- SharePoint document set support

### Fixed

- Fix SharePoint upload with small files (#328)
- SharePoint web resource URL computation


## [3.0.2] - 2023-03-03

### Fixed

- Autoloading for SharePoint/Publishing/ classes
- Fix OneDrive createFolder()

## [3.0.1] - 2023-01-21

### Breaking

- ClientObjectCollection::get() only returns a limited set of data.
  Use getAll() now instead.

### Added

- Update SharePoint models to version 16.0.22921.12007
- Update SharePoint models to version 16.0.23207.12005
- Add CC recipients in outlook messages (#300)
- New functions in Http\Response (#304)
- SharePoint/Field::enableIndex() method
- SharePoint/ClientContext::getGroupSiteManager(), ::getPeopleManager(),
  ::getSiteManager(), ::getSearch() and getTaxonomy()
- SharePoint/Search/SearchService::export()
- Example for obtaining fields of a list (#307)
- Example to list all lists (#316)
- Examples to read large lists, update list items and create indexes

### Fixed

- Sending mails with attachments (#301)
- Option merging in Http\Requests::setDefaultOptions (#319)

### Removed

- Http\Requests::execute() $headers parameter (#304)
- state from ClientRequest


## [3.0.0] - 2022-10-07

### Breaking

- Support for PHP version < 7.1.0

### Added

- Support for confidential clients (#286)
- Throw exception on outdated client credentials (#283)

### Fixed

- Fix deprecations on PHP 8 (#298)
- Validate each individual server response (#287)
- Do not throw exception on all 4xx responses (#288)
