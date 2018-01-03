<?php

namespace CleaniqueCoders\Console\Tests\Commands;

use Symfony\Component\Console\Tester\CommandTester;

/**
 * Root directory file content test.
 */
class SrcDirectoryFileContentTest extends SkeletonCommandTest
{
    /** @test */
    public function skeleton_command_creates_support_helper_file_with_correct_content()
    {
        $this->commandTester->execute([
            'command' => $this->command->getName(),
            'vendor'  => 'Cleanique Coders',
            'package' => 'My Console',
        ]);

        $this->assertFileExists('cleanique-coders/my-console/src/Support/helpers.php');

        $supportHelperPhpContent = "<?php\n";

        $this->assertEquals($supportHelperPhpContent, file_get_contents('cleanique-coders/my-console/src/Support/helpers.php'));
    }

}
