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
    protected $packageDirectory;

    public function setUp()
    {
        parent::setUp();

        $application = new Application();
        $application->add(new MakeSkeletonCommand());

        $this->command       = $application->find('skeleton');
        $this->commandTester = new CommandTester($this->command);

        $this->createPackage();
    }

    public function tearDown()
    {
        exec('rm -rf ' . $this->vendor_path);

        parent::tearDown();
    }

    public function createPackage()
    {
        if (getcwd() != $this->base_path) {
            chdir($this->base_path);
        }
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => $this->vendor_name,
            'package' => $this->package_name,
        ]);
    }
}
