# Packager

Laravel Standalone Package Creator

## About Packager

Packager is a package to create your package directory structure, setup namespace, service provider, PSR-4 autoload easily.

## Installation

```
composer global require cleaniquecoders/packager
```

## Usage

### New Package 

Go to your packages directory development, for instance:

```
cd /my/packages/
```

Then, create a new package skeleton with:

```
packager skeleton vendorName packageName 
```

### Hook

Hook command enabled a package to be loaded in target Laravel project. Following are the command syntax:

```
packager hook path/to/vendor/package path/to/laravel/project
```

With this hook command, your target package will be autoload in `composer.json` and the package service provider class will be inserted in `providers` key in `config/app.php`.

You may want to run `composer dumpautoload` to make sure the package service provider is loaded.

## Contributing

Thank you for considering contributing to the Laravel Standalone Package Creator! You can fork and make a pull request to contribute!

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Standalone Package Creator, please send an e-mail to Nasrul Hazim at nasrul@cleaniquecoders.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel Standalone Package Creator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).