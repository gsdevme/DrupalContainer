<?php

namespace DrupalContainer;

use Composer\Script\Event as ComposerEvent;

class Composer
{
    public static function postInstall(ComposerEvent $event)
    {
        echo 'it works';
    }
}
