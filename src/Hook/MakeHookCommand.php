<?php

namespace CleaniqueCoders\Console\Hook;

use CleaniqueCoders\Console\Commander;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeHookCommand extends Commander
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('hook')
            ->setDescription('Hook Package to a Laravel Project')
            ->addArgument('from', InputArgument::REQUIRED)
            ->addArgument('to', InputArgument::REQUIRED);
    }
    /**
     * Execute the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $package = $input->getArgument('from');
        $project = $input->getArgument('to');

        // Definitions
        $package = realpath($package);
        $project = realpath($project);

        $output->writeln('<info>Project Path: </info>' . $project);
        $output->writeln('<info>Package Path: </info>' . $package);

        // Verify Project and Package Existence
        $this->verifyPackageAndProjectDoesExist($project, $package);
        $output->writeln('<info>Package and Project exist, now hook up the package to project</info>');

        // Getting project composer.json file
        $output->writeln('<info>Getting project\'s composer.json content.</info>');
        $json = $this->getComposerConfig($project);

        // Getting package namespace
        $packageNamespace = $this->getQualifiedNamespaceFromPath($package);
        $output->writeln('<info>Package Namespace: </info>' . $packageNamespace);
        $json->autoload->{'psr-4'}->{$packageNamespace} = $package . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

        // Update Project's composer.json
        $output->writeln('<info>Updating project\'s</info> <comment>composer.json</comment> <info>autoload PSR-4.</info>');
        $composerJson = json_encode($json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        file_put_contents($project . DIRECTORY_SEPARATOR . 'composer.json', $composerJson);

        // Update Project's Service Provider
        $output->writeln('<info>Updating project\'s</info> <comment>config/app.php</comment> <info>providers.</info>');
        $configApp = file_get_contents($project . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'app.php');
        $dummy     = "/*
         * Package Service Providers...
         */";

        $p     = $package . '/src/*ServiceProvider.php';
        $files = glob($p);
        if (count($files) > 0) {
            $serviceProvider = $dummy . "\n         " . $packageNamespace . str_replace(
                [$package . '/src/', '.php'],
                ['', '::class'],
                $files[0]) . ",";
            $configApp = str_replace($dummy, $serviceProvider, $configApp);
            file_put_contents($project . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'app.php', $configApp);
        } else {
            $output->writeln('<error>No service provider found in target package.</error>');
            $output->writeln('<comment>You may add it manually into your project\'s config/app.php file.</comment>');
        }
    }
}
