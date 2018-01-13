<?php

namespace CleaniqueCoders\Console\Traits;

trait GitTrait
{
    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    public function gitInit()
    {
        if ($this->gitInstalled()) {
            exec('git init && git add . && git commit -m "Initial Commits"');
        }
    }

    /**
     * Check if git is installed
     * @return bool
     */
    public function gitInstalled()
    {
        return !empty(exec("which git"));
    }
}
