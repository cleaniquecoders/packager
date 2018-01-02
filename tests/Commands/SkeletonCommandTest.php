<?php

namespace CleaniqueCoders\Console\Tests\Commands;

use CleaniqueCoders\Console\Skeleton\MakeSkeletonCommand;
use CleaniqueCoders\Console\Tests\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Packager skeleton command test.
 */
class SkeletonCommandTest extends TestCase
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

    /** @test */
    public function skeleton_command_generates_files_with_correct_directory_and_file_names()
    {
        // Execute 'packager skeleton "Cleanique Coders" "My Console"' command
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => 'Cleanique Coders',
            'package' => 'My Console',
        ]);

        $output = $this->commandTester->getDisplay();

        // Check for console command output
        $this->assertContains('Your Laravel Package Skeleton is ready!', $output);

        // Check that generated files are exist on /src directory
        $this->assertFileExists('cleanique-coders/my-console/src/Support/helpers.php');
        $this->assertFileExists('cleanique-coders/my-console/src/MyConsoleFacade.php');
        $this->assertFileExists('cleanique-coders/my-console/src/MyConsoleServiceProvider.php');

        // Check that generated files are exist on /tests directory
        $this->assertFileExists('cleanique-coders/my-console/tests/TestCase.php');

        // Check that generated files are exist on package root directory
        $this->assertFileExists('cleanique-coders/my-console/.gitignore');
        $this->assertFileExists('cleanique-coders/my-console/LICENSE.txt');
        $this->assertFileExists('cleanique-coders/my-console/README.md');
        $this->assertFileExists('cleanique-coders/my-console/composer.json');
        $this->assertFileExists('cleanique-coders/my-console/phpunit.xml');
    }

    /** @test */
    public function skeleton_command_checks_if_package_already_exists()
    {
        // Execute 'packager skeleton "Cleanique Coders" "My Console"' command
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => 'Cleanique Coders',
            'package' => 'My Console',
        ]);

        $output = $this->commandTester->getDisplay();

        // Check for console command output
        $this->assertContains('Your Laravel Package Skeleton is ready!', $output);

        // Expect "PackageException" will thrown if same command executed.
        $this->expectException('CleaniqueCoders\Console\Exceptions\PackageException');

        // Execute same command second time
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => 'Cleanique Coders',
            'package' => 'My Console',
        ]);
    }
}
