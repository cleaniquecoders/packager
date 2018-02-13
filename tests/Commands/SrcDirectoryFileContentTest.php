<?php

namespace CleaniqueCoders\Console\Tests\Commands;

/**
 * Root directory file content test.
 */
class SrcDirectoryFileContentTest extends SkeletonCommandTest
{
    /** @test */
    public function skeleton_command_has_support_helper_file_with_correct_content()
    {
        $this->assertFileExists($this->package_path . '/src/Support/helpers.php');

        $supportHelperPhpContent = "<?php\n";

        $this->assertEquals($supportHelperPhpContent, file_get_contents($this->package_path . '/src/Support/helpers.php'));
    }
}
