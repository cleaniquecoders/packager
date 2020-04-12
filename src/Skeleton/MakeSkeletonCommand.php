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
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->vendor            = $vendor            = $input->getArgument('vendor');
        $this->package           = $package           = $input->getArgument('package');
        $this->path              = $path              = $input->getArgument('path') ? $input->getArgument('path') : getcwd();
        $this->path              = $path              = ('.' == $path) ? getcwd() : $path;
        $this->directory         = $directory         = $path . DIRECTORY_SEPARATOR . $this->getDirectoryName($vendor, $package);
        $this->package_path      = $this->directory . DIRECTORY_SEPARATOR;
        $this->package_src_path  = $this->package_path . 'src' . DIRECTORY_SEPARATOR;
        $this->package_test_path = $this->package_path . 'tests' . DIRECTORY_SEPARATOR;

        $output->writeln('<info>Creating your Laravel Package Skeleton...</info>');

        /* 0. Verify Directory */
        $this->verifyPackageDoesntExist($directory);

        /* 1. Copy Stub */
        $this->copyStubs();

        /* 2. Update Package Name and Autoload */
        $this->updatePackageNameAndAutoload();

        /* 3. Update Service Provider  */
        $this->updateServiceProvider();

        /* 4. Update Facade */
        $this->updateFacade();

        /* 5. Update TestCase.php */
        $this->updateTestCase();

        /* 6. Update README.md */
        $this->updateReadme();

        /* 7. Initialise Git, install composer dependencies */
        $this->initRepository();

        $output->writeln('<info>Your package directory name: ' . $directory . '</info>');
        $output->writeln('<comment>Your Laravel Package Skeleton is ready!</comment>');

        return 0;
    }

    private function replace($these, $withThese, $file)
    {
        $this->filesystem->put(
            $file,
            str_replace(
                $these,
                $withThese,
                $this->filesystem->get($file)
            )
        );
    }

    /** 1. Copy Stub */
    private function copyStubs()
    {
        $stubsDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'stubs';
        $this->filesystem->copyDirectory($stubsDir, $this->directory);
    }

    /** 2. Update Package Name and Autoload */
    private function updatePackageNameAndAutoload()
    {
        $composerJson = $this->package_path . 'composer.json';
        $this->replace(
            [
                'DummyPackageName',
                'DummyAutoLoad',
                'PackagerDummyServiceProvider',
            ],
            [
                $this->getQualifiedPackageName($this->vendor, $this->package),
                $this->getAutoLoadName($this->vendor, $this->package),
                $this->getQualifiedClassName($this->package) . 'ServiceProvider',
            ],
            $composerJson
        );
    }

    /** 3. Update Service Provider  */
    private function updateServiceProvider()
    {
        $dummyProvider   = $this->package_src_path . 'PackagerDummyServiceProvider.php';
        $packageProvider = $this->package_src_path . $this->getQualifiedClassName($this->package) . 'ServiceProvider.php';
        $this->filesystem->move($dummyProvider, $packageProvider, true);
        $this->replace(
            [
                'DummyNamespace',
                'DummyClassName',
            ],
            [
                $this->getQualifiedNamespace($this->vendor, $this->package),
                $this->getQualifiedClassName($this->package),
            ],
            $packageProvider
        );
    }

    /** 4. Update Facade  */
    private function updateFacade()
    {
        $dummyFacade = $this->package_src_path . 'PackagerDummyFacade.php';
        $facade      = $this->package_src_path . $this->getQualifiedClassName($this->package) . 'Facade.php';

        $this->filesystem->move($dummyFacade, $facade, true);
        $this->replace(
            [
                'PackageName',
                'DummyNamespace',
                'DummyClassName',
                'FacadeName',
            ],
            [
                $this->getPackageName($this->package),
                $this->getQualifiedNamespace($this->vendor, $this->package),
                $this->getQualifiedClassName($this->package),
                $this->getQualifiedFacadeName($this->package),
            ],
            $facade
        );
    }

    /** 5. Update TestCase.php */
    private function updateTestCase()
    {
        $files = [
            $this->package_test_path . 'TestCase.php',
            $this->package_test_path . 'Traits' . DIRECTORY_SEPARATOR . 'SeedTrait.php',
            $this->package_test_path . 'Traits' . DIRECTORY_SEPARATOR . 'TestCaseTrait.php',
            $this->package_test_path . 'Traits' . DIRECTORY_SEPARATOR . 'UserTrait.php',
        ];

        foreach ($files as $file) {
            $this->replace(
                [
                    'DummyNamespace',
                    'DummyClassName',
                ],
                [
                    $this->getQualifiedNamespace($this->vendor, $this->package),
                    $this->getQualifiedClassName($this->package),
                ],
                $file
            );
        }
    }

    /** 6. Update README.md */
    private function updateReadme()
    {
        $this->replace(
            [
                'DummyPackageName',
                'PackageName',
                'DummyNamespace',
                'DummyClassName',
                'FacadeName',
            ],
            [
                $this->getQualifiedPackageName($this->vendor, $this->package),
                $this->getPackageName($this->package),
                $this->getQualifiedNamespace($this->vendor, $this->package),
                $this->getQualifiedClassName($this->package),
                $this->getQualifiedFacadeName($this->package),
            ],
            $this->package_path . 'README.md'
        );
    }

    /** 7. Initialise Git, install composer dependencies */
    private function initRepository()
    {
        chdir($this->directory);
        $this->gitInit();
        $this->composerUpdate();
        $this->gitCommitUpdateDependecies();
    }
}
