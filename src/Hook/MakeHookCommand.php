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

        $package = realpath($package);
        $project = realpath($project);

        $this->verifyPackageAndProjectDoesExist($project, $package);
        $output->writeln('<info>Package and Project exist, now hook up the package to Laravel Project</info>');

        $composerJson = file_get_contents($project . DIRECTORY_SEPARATOR . 'composer.json');
        $output->writeln('<info>Getting Laravel\'s</info> <comment>composer.json</comment> <info>content.</info>');
        $json = json_decode($composerJson);

        $packageNamespace = $this->getQualifiedNamespaceFromPath($package);
        $json->autoload->{'psr-4'}->{$packageNamespace} = $package . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

        $composerJson = json_encode($json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $output->writeln('<info>Updating Laravel\'s</info> <comment>composer.json</comment> <info>autoload PSR-4.</info>');
        file_put_contents($project . DIRECTORY_SEPARATOR . 'composer.json', $composerJson);

        // Update Service Provider
        $configApp = file_get_contents($project . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'app.php');
        $dummy = "/*
         * Package Service Providers...
         */";
        $explode = explode(DIRECTORY_SEPARATOR, $package);
        $packageName = str_replace('-', ' ', $explode[count($explode) - 1]);
        $packageName = ucwords($packageName);
        $serviceProvider = $dummy . "\n         {$packageNamespace}{$packageName}ServiceProvider::class,";
        $configApp = str_replace($dummy, $serviceProvider, $configApp);

        $output->writeln('<info>Updating Laravel\'s</info> <comment>config/app.php</comment> providers.');
        file_put_contents($project . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'app.php', $configApp);
    }
}
