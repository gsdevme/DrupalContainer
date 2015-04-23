<?php

namespace DrupalContainer;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application
{
    private $container;
    private $drupal;
    private $configuration;

    /**
     * @param $drupal
     * @param $conf
     */
    public function __construct($drupal, &$conf)
    {
        $this->drupal        = $drupal;
        $this->configuration = $conf;
    }

    /**
     * Boots the application
     */
    public function boot()
    {
        $this->container = new ContainerBuilder();

        $loader = new YamlFileLoader($this->container, new FileLocator([
            $this->drupal . '/config/',
            $this->drupal . '/../config/',
            $this->drupal . '/sites/config',
            $this->drupal . '/sites/all/config',
            $this->drupal . '/sites/default/config',
        ]));

        $loader->load('services.yml');
        $loader->load('parameters.yml');

        $this->container->set('drupal.root', $this->drupal);
        $this->container->set('drupal.configuration', $this->configuration);

        $this->container->compile();
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
