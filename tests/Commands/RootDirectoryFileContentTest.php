<?php

namespace CleaniqueCoders\Console\Tests\Commands;

use Symfony\Component\Console\Tester\CommandTester;

/**
 * Root directory file content test.
 */
class RootDirectoryFileContentTest extends SkeletonCommandTest
{
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
