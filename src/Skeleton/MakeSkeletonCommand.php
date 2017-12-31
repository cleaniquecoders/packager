<?php

namespace CleaniqueCoders\Console\Skeleton;

use CleaniqueCoders\Console\Commander;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeSkeletonCommand extends Commander
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
            ->addArgument('package', InputArgument::REQUIRED)
            ->addArgument('path', InputArgument::OPTIONAL);
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
        $vendor    = $input->getArgument('vendor');
        $package   = $input->getArgument('package');
        $path      = $input->getArgument('path') ? $input->getArgument('path') : getcwd();
        $path      = ($path == '.') ? getcwd() : $path;
        $directory = $path . DIRECTORY_SEPARATOR . $this->getDirectoryName($vendor, $package);

        $this->verifyPackageDoesntExist($directory);

        $output->writeln('<info>Creating your Laravel Package Skeleton...</info>');

        /** 1. Copy Stub */
        $stubsDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'stubs';
        $this->filesystem->copyDirectory($stubsDir, $directory);

        /** 2. Update Package Name and Autoload */
        $composerJson = $directory . DIRECTORY_SEPARATOR . 'composer.json';

        $this->filesystem->put($composerJson, str_replace(
            [
                "DummyPackageName",
                "DummyAutoLoad",
            ],
            [
                $this->getQualifiedPackageName($vendor, $package),
                $this->getAutoLoadName($vendor, $package),
            ],
            $this->filesystem->get($composerJson)
        ));

        /** 3. Update Service Provider  */
        $dummyProvider   = $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'PackagerDummyServiceProvider.php';
        $packageProvider = $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $this->getQualifiedClassName($package) . 'ServiceProvider.php';
        $this->filesystem->move($dummyProvider, $packageProvider, true);

        $this->filesystem->put($packageProvider, str_replace(
            [
                "DummyNamespace",
                "DummyClassName",
            ],
            [
                $this->getQualifiedNamespace($vendor, $package),
                $this->getQualifiedClassName($package),
            ],
            $this->filesystem->get($packageProvider)
        ));

        /** 4. Update Facade  */
        $dummyFacade = $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'PackagerDummyFacade.php';
        $facade      = $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $this->getQualifiedClassName($package) . 'Facade.php';
        $this->filesystem->move($dummyFacade, $facade, true);

        $this->filesystem->put($facade, str_replace(
            [
                "PackageName",
                "DummyNamespace",
                "DummyClassName",
                "FacadeName",
            ],
            [
                $this->getPackageName($package),
                $this->getQualifiedNamespace($vendor, $package),
                $this->getQualifiedClassName($package),
                $this->getQualifiedFacadeName($package),
            ],
            $this->filesystem->get($facade)
        ));

        /** 5. Update TestCase.php */
        $testCase = $directory . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'TestCase.php';
        $this->filesystem->put($testCase, str_replace(
            [
                "DummyNamespace",
                "DummyClassName",
            ],
            [
                $this->getQualifiedNamespace($vendor, $package),
                $this->getQualifiedClassName($package),
            ],
            $this->filesystem->get($testCase)
        ));

        /** 6. Update README.md */
        $readme = $directory . DIRECTORY_SEPARATOR . 'README.md';
        $this->filesystem->put($readme, str_replace(
            [
                "DummyPackageName",
            ],
            [
                $this->getQualifiedPackageName($vendor, $package),
            ],
            $this->filesystem->get($readme)
        ));

        $output->writeln('<info>Your package directory name: ' . $directory . '</info>');

        /**
         * @todo to make sure the following is automated
         */
        // exec('cd ' . $directory);
        // exec('git init');
        // exec('git add .');
        // exec('git commit -m "initial commits"');
        // exec($this->findComposer() . ' update');

        $output->writeln('<comment>Your Laravel Package Skeleton is ready!</comment>');
    }
}
