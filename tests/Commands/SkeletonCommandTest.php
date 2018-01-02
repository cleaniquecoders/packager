<?php

namespace CleaniqueCoders\Console\Tests\Commands;

use CleaniqueCoders\Console\Skeleton\MakeSkeletonCommand;
use CleaniqueCoders\Console\Tests\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Packager skeleton command base test.
 */
abstract class SkeletonCommandTest extends TestCase
{
    protected $command;
    protected $commandTester;

    public function setUp()
    {
        parent::setUp();

        $application = new Application();
        $application->add(new MakeSkeletonCommand());

        // Setup the console command tester
        $this->command = $application->find('skeleton');
        $this->commandTester = new CommandTester($this->command);
    }

    public function tearDown()
    {
        // Remove all generated package directory and files
        exec('rm -rf cleanique-coders');

        parent::tearDown();
    }
}
