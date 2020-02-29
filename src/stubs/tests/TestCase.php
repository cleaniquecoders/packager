<?php

namespace DummyNamespace\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use Traits\TestCaseTrait;

    /**
     * Load Package Service Provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array List of Service Provider
     */
    protected function getPackageProviders($app)
    {
        return [
            \DummyNamespace\DummyClassNameServiceProvider::class,
        ];
    }
}
