<?php

namespace CleaniqueCoders\Console\Tests;

use Illuminate\Support\Str;

/**
 * Test Root Namespace, class name, service provider, autoload
 */
class ClassNameTest extends TestCase
{
    /** @test */
    public function has_sluggable_name()
    {
        $this->assertTrue(Str::contains('cleanique-coders', $this->commander->cleanupName('Cleanique Coders')));
    }

    /** @test */
    public function has_qualified_class_name()
    {
        $this->assertTrue(
            Str::contains(
                'CleaniqueCoders',
                $this->commander->getQualifiedClassName('Cleanique Coders')
            )
        );
    }

    /** @test */
    public function has_qualified_package_name()
    {
        $this->assertTrue(
            Str::contains(
                'cleanique-coders/console',
                $this->commander->getQualifiedPackageName(
                    'Cleanique Coders',
                    'Console'
                )
            )
        );
    }

    /** @test */
    public function has_qualified_namespace()
    {
        $this->assertTrue(
            Str::contains(
                'CleaniqueCoders\Console',
                $this->commander->getQualifiedNamespace(
                    'Cleanique Coders',
                    'Console'
                )
            )
        );
    }

    /** @test */
    public function has_directory_name()
    {
        $this->assertTrue(
            Str::contains(
                'cleanique-coders' . DIRECTORY_SEPARATOR . 'console',
                $this->commander->getDirectoryName(
                    'Cleanique Coders',
                    'Console'
                )
            )
        );
    }

    /** @test */
    public function has_autoload_name()
    {
        $this->assertTrue(
            Str::contains(
                'CleaniqueCoders\\\\Console',
                $this->commander->getAutoLoadName(
                    'Cleanique Coders',
                    'Console'
                )
            )
        );
    }
}
