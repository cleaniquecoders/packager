<?php

namespace CleaniqueCoders\Console\Skeleton;

use CleaniqueCoders\Console\Commander;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeSkeletonCOmmand extends Commander
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('skeleton')
            ->setDescription('Create a new Laravel Package')
            ->addArgument('vendor', InputArgument::REQUIRED)
            ->addArgument('package', InputArgument::REQUIRED);
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
        $vendor = $input->getArgument('vendor');
        $package = $input->getArgument('package');
        $directory = getcwd() . DIRECTORY_SEPARATOR . $this->getDirectoryName($vendor, $package);

        $this->verifyPackageDoesntExist($directory);

        // create directory
        // copy stubs
        // update package name
        // update namespace

        $output->writeln('<info>Creating your Laravel Package Skeleton...</info>');
        $output->writeln('<info>Your qualified package name: ' . $this->getQualifiedName($vendor, $package) . '</info>');
        $output->writeln('<info>Your qualified class namespace: ' . $this->getQualifiedNamespace($vendor, $package) . '</info>');
        $output->writeln('<info>Your PSR-4 autoload: ' . $this->getAutoLoadName($vendor, $package) . '</info>');
        $output->writeln('<info>Your package directory name: ' . $directory . '</info>');

        $output->writeln('<comment>Your Laravel Package Skeleton is ready!</comment>');
    }
}
