<?php

namespace CleaniqueCoders\Console\Tests\Stubs;

use CleaniqueCoders\Console\Traits\ComposerTrait;
use CleaniqueCoders\Console\Traits\ProjectTrait;
use CleaniqueCoders\Console\Traits\QualifiedClassNameTrait;

/**
 *
 */
class Commander
{
    use ComposerTrait, ProjectTrait, QualifiedClassNameTrait;
}
