## About Your Package

Tell people about your package

## Installation

1. In order to install PackageName in your Laravel project, just run the *composer require* command from your terminal:

```
composer require DummyPackageName
```

2. Then in your `config/app.php` add the following to the providers array:

```php
DummyNamespace\DummyClassNameServiceProvider::class,
```

3. In the same `config/app.php` add the following to the aliases array:

```php
'PackageName' => DummyNamespace\DummyClassNameFacade::class,
```

## Usage

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).