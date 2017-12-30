<?php

namespace CleaniqueCoders\Console\Traits;

use Illuminate\Support\Str;

trait QualifiedClassNameTrait
{
    public function cleanupName($value)
    {
        return Str::slug($value, '-');
    }

    public function getQualifiedClassName($package)
    {
        return Str::studly($package);
    }

    public function getQualifiedPackageName($vendor, $package)
    {
        return strtolower($this->cleanupName($vendor)) . '/' . strtolower($this->cleanupName($package));
    }

    public function getQualifiedNamespace($vendor, $package)
    {
        return Str::studly($vendor) . '\\' . Str::studly($package);
    }

    public function getDirectoryName($vendor, $package)
    {
        return strtolower($this->cleanupName($vendor)) . DIRECTORY_SEPARATOR . strtolower($this->cleanupName($package));
    }

    public function getAutoLoadName($vendor, $package)
    {
        return Str::studly($vendor) . '\\\\' . Str::studly($package);
    }
}
