<?php

namespace CleaniqueCoders\Console\Tests;

/**
 *
 */
class GitTest extends TestCase
{
    /** @test */
    public function is_git_installed()
    {
        $this->assertTrue($this->commander->gitInstalled());
    }
}
