<?php

namespace CleaniqueCoders\Console\Traits;

use CleaniqueCoders\Console\Exceptions\LaravelProjectException;
use CleaniqueCoders\Console\Exceptions\PackageException;

trait ProjectTrait
{
    /**
     * Verify Package and Project Existence
     * @param  string $package Path to Package
     * @param  string $project Path to Project
     * @return void
     */
    public function verifyPackageAndProjectDoesExist($package, $project)
    {
        $this->verifyProjectDoesExist($project);
        $this->verifyPackageDoesExist($package);
    }

    /**
     * Verify that the Laravel Project exist.
     *
     * @param  string  $directory
     * @return void
     */
    protected function verifyProjectDoesExist($directory)
    {
        if (!is_dir($directory)) {
            throw new LaravelProjectException('Laravel Project does not exists!');
        }
    }

    /**
     * Verify that the package does not already exist.
     *
     * @param  string  $directory
     * @return void
     */
    protected function verifyPackageDoesExist($directory)
    {
        if (!is_dir($directory)) {
            throw new LaravelProjectException('Package does not exists!');
        }
    }

    /**
     * Verify that the package does not already exist.
     *
     * @param  string  $directory
     * @return void
     */
    protected function verifyPackageDoesntExist($directory)
    {
        if ((is_dir($directory) || is_file($directory)) && $directory != getcwd()) {
            throw new PackageException('Package already exists!');
        }
    }
}
