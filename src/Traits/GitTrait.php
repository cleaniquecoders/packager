<?php

namespace CleaniqueCoders\Console\Traits;

trait GitTrait
{
    /**
     * Initiliase git repository.
     *
     * @return void
     */
    public function gitInit()
    {
        if ($this->gitInstalled()) {
            exec('git init && git add . && git commit -m "Initial Commits"');
        }
    }

    /**
     * Commit composer.lock on update dependencies.
     *
     * @return void
     */
    public function gitCommitUpdateDependecies()
    {
        if ($this->gitInstalled()) {
            exec('git add composer.lock && git commit -m "Upadate dependencies"');
        }
    }

    /**
     * Check if git is installed.
     */
    public function gitInstalled(): bool
    {
        return ! empty(exec('which git'));
    }
}
