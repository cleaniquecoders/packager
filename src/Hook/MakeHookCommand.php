<?php

namespace CleaniqueCoders\Console\Hook;

use CleaniqueCoders\Console\Commander;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeHookCommand extends Commander
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('hook')
            ->setDescription('Hook package to a Laravel project locally')
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('to', InputArgument::REQUIRED);
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name      = $input->getArgument('name');
        $pathOrUrl = $input->getArgument('to');

        $status = $this->composerLink(Str::snake($name), $pathOrUrl);

        if ($status) {
            $output->writeln('<info>Packaged linked.</info>');
        } else {
            $output->writeln('<comment>Unable to link the package.</comment>');
        }
    }
}
