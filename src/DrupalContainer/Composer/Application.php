<?php

namespace DrupalContainer\Composer;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Application extends SymfonyApplication
{
    const TITLE = <<<TITLE
=================================================
#################################################
# Drupal Container Composer Installer           #
#################################################
=================================================

TITLE;


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
        $this->loadServices();
        $this->addServiceCommands();

        $output->writeln(sprintf('<comment>%s</comment>', self::TITLE));

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


    /**
     * Add all the commands from the command_services.xml to the application
     */
    private function addServiceCommands()
    {
        $commands = $this->container->findTaggedServiceIds('drupal_container.command');
        foreach ($commands as $id => $v) {
            /** @var \Symfony\Component\Console\Command\Command $command */
            $command = $this->container->get($id);
            $this->add($command);
        }
    }

    /**
     * Load the services.xml
     */
    private function loadServices()
    {
        $xmlFileLoader = new XmlFileLoader($this->container, new FileLocator(__DIR__ . '/config'));
        $xmlFileLoader->load('command-services.xml');
        $xmlFileLoader->load('services.xml');
    }
}
