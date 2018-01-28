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

        $composerJsonContent = "{
    \"name\": \"cleanique-coders/my-console\",
    \"description\": \"Built with Laravel Standalone Package Creator\",
    \"keywords\": [\"package\", \"laravel\"],
    \"license\": \"MIT\",
    \"authors\": [
        {
            \"name\": \"Nasrul Hazim\",
            \"email\": \"nasrulhazim.m@gmail.com\"
        }
    ],
    \"autoload\": {
        \"psr-4\": {
            \"CleaniqueCoders\\\\MyConsole\\\\\": \"src/\"
        },
        \"files\": [
            \"src/Support/helpers.php\"
        ]
    },
    \"autoload-dev\": {
        \"psr-4\": {
            \"CleaniqueCoders\\\\MyConsole\\\\Tests\\\\\": \"tests/\"
        }
    },
    \"require\": {
        \"php\": \">=7.0.0\",
        \"illuminate/support\": \"^5.5\"
    },
    \"require-dev\": {
        \"phpunit/phpunit\": \"^6.5\",
        \"orchestra/testbench\": \"~3.0\",
        \"codedungeon/phpunit-result-printer\": \"^0.4.4\"
    },
    \"config\": {
        \"sort-packages\": true
    },
    \"minimum-stability\": \"dev\",
    \"prefer-stable\": true
}";
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

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).";

        $this->assertEquals($readmeMdContent, file_get_contents('README.md'));
    }
}
