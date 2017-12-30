<?php

namespace CleaniqueCoders\Console;

use CleaniqueCoders\Console\Traits\ComposerTrait;
use CleaniqueCoders\Console\Traits\ProjectTrait;
use CleaniqueCoders\Console\Traits\QualifiedClassNameTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;

class Commander extends Command
{
    use ComposerTrait, ProjectTrait, QualifiedClassNameTrait;

    /**
     * Filesystem
     * @var Symfony\Component\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->filesystem = new Filesystem;
    }
}
