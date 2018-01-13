<?php

namespace CleaniqueCoders\Console\Tests;

use CleaniqueCoders\Console\Tests\Stubs\Commander;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $commander;
    protected $base_path;
    protected $vendor_path;
    protected $package_path;
    protected $vendor_name  = 'Cleanique Coders';
    protected $package_name = 'My Console';

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->commander    = new Commander;
        $this->base_path    = realpath(__DIR__ . '/../');
        $this->vendor_path  = $this->base_path . DIRECTORY_SEPARATOR . $this->commander->getPackageName($this->vendor_name);
        $this->package_path = $this->vendor_path . DIRECTORY_SEPARATOR . $this->commander->getPackageName($this->package_name);
    }
}
