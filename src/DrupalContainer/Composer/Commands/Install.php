<?php

namespace DrupalContainer\Composer\Commands;

use Symfony\Component\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use DrupalContainer\Composer\FileSystem\DrupalWebDirectoryResolver;

class Install extends Console\Command\Command
{

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('composer:install')
            ->setDescription('Installs the Drupal Module');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $resolver = new DrupalWebDirectoryResolver();
        $resolver->resolve(getcwd());
    }
}
