<?php

namespace CleaniqueCoders\Console;

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
        return $this->cleanupName(ucwords($package));
    }

    protected function getQualifiedNamespace($vendor, $package)
    {
        return $this->cleanupName(ucwords($vendor)) . '\\' . $this->cleanupName(ucwords($package));
    }

    public function getDirectoryName($vendor, $package)
    {
        return strtolower($this->cleanupName($vendor)) . DIRECTORY_SEPARATOR . strtolower($this->cleanupName($package));
    }

    public function getAutoLoadName($vendor, $package)
    {
        return $this->cleanupName(ucwords($vendor)) . '\\\\' . $this->cleanupName(ucwords($package)) . '\\\\';
    }
    /**
     * Verify that the application does not already exist.
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
