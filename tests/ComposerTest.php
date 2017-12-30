<?php

namespace CleaniqueCoders\Console\Tests;

use Illuminate\Support\Str;

/**
 *
 */
class ComposerTest extends TestCase
{
    /** @test */
    public function is_composer_installed()
    {
        $this->assertTrue(Str::contains($this->commander->findComposer(), 'composer'));
    }

    /** @test */
    public function is_composer_exist()
    {
        $this->assertTrue(!is_null($this->commander));
    }

    /** @test */
    public function is_composer_config_exist()
    {
        $composerJson = $this->commander->getComposerConfig(__DIR__ . '/../');
        $this->assertTrue(!is_null($composerJson));
    }
}
