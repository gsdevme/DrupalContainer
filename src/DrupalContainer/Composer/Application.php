<?php

namespace DrupalContainer\Composer;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends SymfonyApplication
{
    private $container;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $this->container = new ContainerBuilder();

        parent::__construct('DrupalContainer', '0.1');
    }

    /**
     * @inheritdoc
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        parent::doRun($input, $output);
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultInputDefinition()
    {
        return new InputDefinition([
            new InputArgument('command', InputArgument::REQUIRED, 'The command to execute'),
            new InputOption('--version', '-V', InputOption::VALUE_NONE, 'Display this application version.'),
        ]);
    }
}
