<?php

namespace CleaniqueCoders\Console;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;

class Commander extends Command
{
    protected $filesystem;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->filesystem = new Filesystem;
    }

    protected function cleanupName($value)
    {
        $value = str_replace(' ', '-', $value); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $value); // Removes special chars.
    }

    protected function getQualifiedName($vendor, $package)
    {
        return strtolower($this->cleanupName($vendor)) . '/' . strtolower($this->cleanupName($package));
    }

    protected function getQualifiedClassName($package)
    {
        return $this->cleanupName(str_replace(' ', '', ucwords($package)));
    }

    protected function getQualifiedNamespace($vendor, $package)
    {
        return $this->cleanupName(str_replace(' ', '', ucwords($vendor))) . '\\' . $this->cleanupName(str_replace(' ', '', ucwords($package)));
    }

    protected function getQualifiedNamespaceFromPath($path)
    {
        $explode = explode(DIRECTORY_SEPARATOR, $path);
        $vendor = str_replace('-', ' ', $explode[count($explode) - 2]);
        $package = str_replace('-', ' ', $explode[count($explode) - 1]);
        return $this->getQualifiedNamespace($vendor, $package) . '\\';
    }

    public function getDirectoryName($vendor, $package)
    {
        return strtolower($this->cleanupName($vendor)) . DIRECTORY_SEPARATOR . strtolower($this->cleanupName($package));
    }

    public function getAutoLoadName($vendor, $package)
    {
        return $this->cleanupName(str_replace(' ', '', ucwords($vendor))) . '\\\\' . $this->cleanupName(str_replace(' ', '', ucwords($package))) . '\\\\';
    }

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
            throw new RuntimeException('Laravel Project does not exists!');
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
            throw new RuntimeException('Package does not exists!');
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
            throw new RuntimeException('Package already exists!');
        }
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" composer.phar';
        }
        return 'composer';
    }
}
