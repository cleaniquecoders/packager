<?php

namespace CleaniqueCoders\Console\Tests\Commands;

/**
 * Skeleton command generated files test.
 */
class SkeletonGeneratedFilesTest extends SkeletonCommandTest
{
    /** @test */
    public function skeleton_command_generates_files_with_correct_directory_and_file_names()
    {
        $output = $this->commandTester->getDisplay();

        // Check for console command output
        $this->assertStringContainsString('Your Laravel Package Skeleton is ready!', $output);

        // Check that generated files are exist on /src directory
        $this->assertFileExists($this->package_path . '/src/Support/helpers.php');
        $this->assertFileExists($this->package_path . '/src/MyConsoleFacade.php');
        $this->assertFileExists($this->package_path . '/src/MyConsoleServiceProvider.php');

        // Check that generated files are exist on /tests directory
        $this->assertFileExists($this->package_path . '/tests/Traits/SeedTrait.php');
        $this->assertFileExists($this->package_path . '/tests/Traits/TestCaseTrait.php');
        $this->assertFileExists($this->package_path . '/tests/Traits/UserTrait.php');
        $this->assertFileExists($this->package_path . '/tests/TestCase.php');

        // Check that generated files are exist on package root directory
        $this->assertDirectoryExists($this->package_path . '/.git');
        $this->assertFileExists($this->package_path . '/.gitignore');
        $this->assertFileExists($this->package_path . '/LICENSE.txt');
        $this->assertFileExists($this->package_path . '/README.md');
        $this->assertFileExists($this->package_path . '/composer.json');
        $this->assertFileExists($this->package_path . '/phpunit.xml');
    }

    /** @test */
    public function skeleton_command_checks_if_package_already_exists()
    {
        $output = $this->commandTester->getDisplay();

        // Check for console command output
        $this->assertStringContainsString('Your Laravel Package Skeleton is ready!', $output);

        // Expect "PackageException" will thrown if same command executed.
        $this->expectException(\CleaniqueCoders\Console\Exceptions\PackageException::class);

        // Execute same command second time
        $this->createPackage();
    }
}
