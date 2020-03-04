<?php

namespace CleaniqueCoders\Console\Tests\Commands;

/**
 * Root directory file content test.
 */
class RootDirectoryFileContentTest extends SkeletonCommandTest
{
    /** @test */
    public function skeleton_command_has_composer_json_file_with_correct_content()
    {
        $this->assertFileExists($this->package_path . '/composer.json');

        $composerJsonContent = '{
    "name": "cleanique-coders/my-console",
    "description": "Built with Laravel Standalone Package Creator",
    "keywords": ["package", "laravel"],
    "license": "MIT",
    "authors": [
        {
            "name": "Nasrul Hazim",
            "email": "nasrulhazim.m@gmail.com"
        }
    ],
    "autoload": {
        "psr-4": {
            "CleaniqueCoders\\\\MyConsole\\\\": "src/"
        },
        "files": [
            "src/Support/helpers.php"
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "CleaniqueCoders\\\\MyConsole\\\\Tests\\\\": "tests/"
        }
    },
    "require": {
        "php": ">=7.3",
        "illuminate/support": "^5.5|^5.6|^5.7|^5.8|^6.0|^7.0",
        "illuminate/auth": "^5.5|^5.6|^5.7|^5.8|^6.0|^7.0"
    },
    "require-dev": {
        "orchestra/testbench": "3.5.*|3.6.*|3.7.*|3.8.*|4.*|5.*"
    },
    "extra": {
        "laravel": {
            "providers": [
                "CleaniqueCoders\\\\MyConsole\\\\MyConsoleServiceProvider"
            ]
        }
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}';
        $this->assertEquals($composerJsonContent, file_get_contents($this->package_path . '/composer.json'));
    }

    /** @test */
    public function skeleton_command_has_readme_md_file_with_correct_content()
    {
        $this->assertFileExists($this->package_path . '/README.md');

        $readmeMdContent = "
[![Build Status](https://travis-ci.org/cleanique-coders/my-console.svg?branch=master)](https://travis-ci.org/cleanique-coders/my-console) [![Latest Stable Version](https://poser.pugx.org/cleanique-coders/my-console/v/stable)](https://packagist.org/packages/cleanique-coders/my-console) [![Total Downloads](https://poser.pugx.org/cleanique-coders/my-console/downloads)](https://packagist.org/packages/cleanique-coders/my-console) [![License](https://poser.pugx.org/cleanique-coders/my-console/license)](https://packagist.org/packages/cleanique-coders/my-console)

## About Your Package

Tell people about your package

## Installation

1. In order to install `cleanique-coders/my-console` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require cleanique-coders/my-console
```

2. Then in your `config/app.php` add the following to the providers array:

```php
CleaniqueCoders\MyConsole\MyConsoleServiceProvider::class,
```

3. In the same `config/app.php` add the following to the aliases array:

```php
'MyConsole' => CleaniqueCoders\MyConsole\MyConsoleFacade::class,
```

## Usage

## Test

Run the following command:

```
$ vendor/bin/phpunit  --testdox --verbose
```

## Contributing

Thank you for considering contributing to the `cleanique-coders/my-console`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. \"Bug reports\" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`cleanique-coders/my-console` follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).";

        $this->assertEquals($readmeMdContent, file_get_contents('README.md'));
    }
}
