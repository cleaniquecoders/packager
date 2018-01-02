<?php

namespace CleaniqueCoders\Console\Tests\Commands;

use CleaniqueCoders\Console\Skeleton\MakeSkeletonCommand;
use CleaniqueCoders\Console\Tests\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Root directory file content test.
 */
class RootDirectoryFileContentTest extends TestCase
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
    public function skeleton_command_creates_composer_json_file_with_correct_content()
    {
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => 'Cleanique Coders',
            'package' => 'My Console',
        ]);

        $this->assertFileExists('cleanique-coders/my-console/composer.json');

        $composerJsonContent = "{
    \"name\": \"cleanique-coders/my-console\",
    \"description\": \"Built with Laravel Standalone Package Creator\",
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
        $this->assertEquals($composerJsonContent, file_get_contents('cleanique-coders/my-console/composer.json'));
    }
}
