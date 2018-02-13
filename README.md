[![Build Status](https://travis-ci.org/cleaniquecoders/packager.svg?branch=master)](https://travis-ci.org/cleaniquecoders/packager) [![Latest Stable Version](https://poser.pugx.org/cleaniquecoders/packager/v/stable)](https://packagist.org/packages/cleaniquecoders/packager) [![Total Downloads](https://poser.pugx.org/cleaniquecoders/packager/downloads)](https://packagist.org/packages/cleaniquecoders/packager) [![License](https://poser.pugx.org/cleaniquecoders/packager/license)](https://packagist.org/packages/cleaniquecoders/packager)

# Packager

Laravel Standalone Package Creator

## About Packager

Packager is a package to create your package directory structure, setup namespace, service provider, PSR-4 autoload easily.

## Installation

```
composer global require cleaniquecoders/packager
```

## Usage

Please refer to [Wiki](https://github.com/cleaniquecoders/packager/wiki)

## Contributing

Thank you for considering contributing to the Laravel Standalone Package Creator!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

Laravel Standalone Package Creator follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Standalone Package Creator, please send an e-mail to Nasrul Hazim at nasrul@cleaniquecoders.com. All security vulnerabilities will be promptly addressed.

## Test

To run the test, type `vendor/bin/phpunit` in your terminal.

To have codes coverage, please ensure to install PHP XDebug then run the following command:

```
$ vendor/bin/phpunit -v --coverage-text --colors=never --stderr
```

## License

The Laravel Standalone Package Creator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
