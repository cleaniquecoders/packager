<?php

namespace DummyNamespace\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // $this->loadLaravelMigrations(['--database' => 'testbench']);

        // $this->artisan('migrate', ['--database' => 'testbench']);
    }

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

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
