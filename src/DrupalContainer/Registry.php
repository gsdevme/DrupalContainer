<?php

namespace DrupalContainer;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Registry
{
    /**
     * @var ContainerInterface
     */
    private static $container;

    /**
     * @return ContainerInterface
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * @param ContainerInterface $container
     */
    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }
}
