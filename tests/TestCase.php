<?php

namespace CleaniqueCoders\Console\Tests;

use CleaniqueCoders\Console\Tests\Stubs\Commander;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $commander;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->commander = new Commander;
    }
}
