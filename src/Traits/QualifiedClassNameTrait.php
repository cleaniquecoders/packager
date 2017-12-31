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

    public function getPackageName($package)
    {
        return strtolower($this->cleanupName($package));
    }

    public function getVendorName($vendor)
    {
        return strtolower($this->cleanupName($vendor));
    }

    public function getQualifiedPackageName($vendor, $package)
    {
        return $this->getVendorName($vendor) . '/' . $this->getPackageName($package);
    }

    public function getQualifiedNamespace($vendor, $package)
    {
        return Str::studly($vendor) . '\\' . Str::studly($package);
    }

    public function getDirectoryName($vendor, $package)
    {
        return $this->getVendorName($vendor) . DIRECTORY_SEPARATOR . $this->getPackageName($package);
    }

    public function getAutoLoadName($vendor, $package)
    {
        return Str::studly($vendor) . '\\\\' . Str::studly($package);
    }

    public function getQualifiedFacadeName($package)
    {
        return Str::studly($package);
    }
}
