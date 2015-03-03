<?php

namespace DrupalContainer;

use Composer\Script\Event as ComposerEvent;

class Composer
{
    const MODULE_NAME = 'drupal_container';
    const MODULE_PATH = '/sites/all/';
    const LOCK_FILE   = <<<FILE
<?php

return '%s';
FILE;


    /**
     * @param ComposerEvent $event
     */
    public static function postInstall(ComposerEvent $event)
    {
        return self::installDrupalModule($event);
    }

    /**
     * @param ComposerEvent $event
     */
    public static function postUpdate(ComposerEvent $event)
    {
        return self::installDrupalModule($event);
    }

    /**
     * @param ComposerEvent $event
     * @throws \Exception
     */
    private static function installDrupalModule(ComposerEvent $event)
    {
        $drupalContainerInstallLock = self::getCurrentWorkingDirectory() . '.drupalcontainer.lock';

        if (!file_exists($drupalContainerInstallLock)) {
            do {
                self::askInstallQuestion();
            } while (!$drupalModulePath = self::readAndValidateResponse());

            if (!is_dir($drupalModulePath . self::MODULE_PATH)) {
                throw new \Exception($drupalModulePath . self::MODULE_PATH . ' does not exist.');
            }

            $drupalModulePath = sprintf('%s%s/%s/',
                $drupalModulePath,
                self::MODULE_PATH,
                'modules');

            if (!is_dir($drupalModulePath)) {
                mkdir($drupalModulePath, 0775, true);
            }

            $drupalModulePath .= self::MODULE_NAME;
        } else {
            $drupalModulePath = include $drupalContainerInstallLock;
        }

        $modulePath = realpath(__DIR__) . '/Module';

        if (!file_exists($drupalModulePath)) {
            symlink($modulePath, $drupalModulePath);
            echo 'Installed to: ' . $drupalModulePath . PHP_EOL;
        }

        file_put_contents($drupalContainerInstallLock, sprintf(self::LOCK_FILE, $drupalModulePath));
    }

    private static function readAndValidateResponse()
    {
        $drupalModulePath = self::getCurrentWorkingDirectory() . trim(fgets(STDIN));

        if (is_dir($drupalModulePath)) {
            return $drupalModulePath;
        }

        return false;
    }

    private static function askInstallQuestion()
    {
        $question = <<<QUESTION
###################################################
# DRUPAL CONTAINER INSTALL                        #
###################################################
Please give the relative path to the drupal install

CWD[%s]:
QUESTION;

        printf($question, self::getCurrentWorkingDirectory());
    }

    private static function getCurrentWorkingDirectory()
    {
        return getcwd() . '/';
    }
}
