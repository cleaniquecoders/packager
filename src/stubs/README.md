
[![Build Status](https://travis-ci.org/DummyPackageName.svg?branch=master)](https://travis-ci.org/DummyPackageName) [![Latest Stable Version](https://poser.pugx.org/DummyPackageName/v/stable)](https://packagist.org/packages/DummyPackageName) [![Total Downloads](https://poser.pugx.org/DummyPackageName/downloads)](https://packagist.org/packages/DummyPackageName) [![License](https://poser.pugx.org/DummyPackageName/license)](https://packagist.org/packages/DummyPackageName)

## About Your Package

Tell people about your package

## Installation

1. In order to install `DummyPackageName` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require DummyPackageName
```

2. Then in your `config/app.php` add the following to the providers array:

```php
DummyNamespace\DummyClassNameServiceProvider::class,
```

3. In the same `config/app.php` add the following to the aliases array:

```php
'FacadeName' => DummyNamespace\DummyClassNameFacade::class,
```

## Usage

## Test

To run the test, type `vendor/bin/phpunit` in your terminal.

To have codes coverage, please ensure to install PHP XDebug then run the following command:

```
$ vendor/bin/phpunit -v --coverage-text --colors=never --stderr
```

## Contributions

Everyone are welcome to contribute to this package. However, it's a good practice to provide:

1. The problem you solved
2. Provide test
3. Documentation

Without these 3, you may add extra work for the maintainer.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).