# People

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aa76029e3e4c471d91370e29534f436f)](https://www.codacy.com/app/laravel-enso/People?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/people&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://github.styleci.io/repos/151952913/shield?branch=master)](https://github.styleci.io/repos/151952913)
[![License](https://poser.pugx.org/laravel-enso/people/license)](https://packagist.org/packages/laravel-enso/people)
[![Total Downloads](https://poser.pugx.org/laravel-enso/people/downloads)](https://packagist.org/packages/laravel-enso/people)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/people/version)](https://packagist.org/packages/laravel-enso/people)

Person management dependency for [Laravel Enso](https://github.com/laravel-enso/Enso).

This package works exclusively within the [Enso](https://github.com/laravel-enso/Enso) ecosystem.

The front end assets that utilize this api are present in the [ui](https://github.com/enso-ui/ui) package.

For live examples and demos, you may visit [laravel-enso.com](https://www.laravel-enso.com)

[![Screenshot](https://laravel-enso.github.io/people/screenshots/bulma_001_thumb.png)](https://laravel-enso.github.io/people/screenshots/bulma_001.png)

[![Screenshot](https://laravel-enso.github.io/people/screenshots/bulma_002_thumb.png)](https://laravel-enso.github.io/people/screenshots/bulma_002.png)

<sup>click on the photo to view a large size screenshot</sup>

## Installation

Comes pre-installed in Enso.

## Features

- separates the people centric operations from the core application user model
- allows the management of people and their details
- integrates with and extends the application user
- is built upon the premise that all the application users are people, but some people may not be application users
- can be reused and integrated with other modules which might handle categories of people (e.g. company people)
- a `PersonFactory` is included by default in the package
- a policy is used to ensure that a person email update cannot be performed if the person is linked to an user
- custom validations may be added through the package configuration
- the people server-side select functionality is included by default
- the included `IsPerson` trait can be used on other models that have a `person` relationship and require email synchronization
- enums are used for person genders and titles  

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/backend/people.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
