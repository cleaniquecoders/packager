<?php

namespace DummyNamespace\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DummyNamespace\DummyClassNameServiceProvider::class,
        ];
    }
}
