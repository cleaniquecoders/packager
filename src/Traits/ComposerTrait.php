<?php

namespace CleaniqueCoders\Console\Traits;

trait ComposerTrait
{
    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    public function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" composer.phar';
        }

        return 'composer';
    }

    /**
     * Get Composer Configuration.
     *
     * @param string $path
     *
     * @return json
     */
    public function getComposerConfig($path)
    {
        $composerJson = file_get_contents($path . DIRECTORY_SEPARATOR . 'composer.json');

        return json_decode($composerJson);
    }

    /**
     * Get Qualified Namespace from Path Given.
     *
     * @param string $path
     *
     * @return string
     */
    public function getQualifiedNamespaceFromPath($path)
    {
        $json               = $this->getComposerConfig($path);
        $qualifiedNamespace = key((array) $json->autoload->{'psr-4'});

        return $qualifiedNamespace;
    }

    /**
     * Install Package Dependencies.
     */
    public function composerInstall()
    {
        if ('testing' != env('APP_ENV')) {
            exec($this->findComposer() . ' install --no-progress --no-suggest');
        }
    }

    /**
     * Link local package to target project.
     *
     * @see http://calebporzio.com/bash-alias-composer-link-use-local-folders-as-composer-dependancies/
     *
     * @param string $name
     * @param string $pathOrUrl
     */
    public function composerLink($name, $pathOrUrl)
    {
        if ('testing' != env('APP_ENV')) {
            exec($this->findComposer() . ' config repositories.' . $name . ' \'{"type": "path", "url": "' . $pathOrUrl . '"}\' --file composer.json');
            return true;
        }

        return false;
    }
}
