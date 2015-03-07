<?php

namespace DrupalContainer\Composer\FileSystem;

use RecursiveDirectoryIterator;
use RecursiveCallbackFilterIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class DrupalWebDirectoryResolver
{
    const SEARCH_STRING = "define('DRUPAL_ROOT', getcwd());\n";

    private $flags;

    public function __construct()
    {
        $this->flags = RecursiveDirectoryIterator::KEY_AS_FILENAME |
            RecursiveDirectoryIterator::CURRENT_AS_FILEINFO |
            RecursiveDirectoryIterator::SKIP_DOTS;
    }

    /**
     * @param $directory
     * @return null|string
     */
    public function resolve($directory)
    {
        $directoryIterator         = new RecursiveDirectoryIterator($directory, $this->flags);
        $directoryCallbackIterator = new RecursiveCallbackFilterIterator($directoryIterator, [$this, 'recursiveDirectoryFilter']);

        return $this->filterToDrupalInstallFolder(new RecursiveIteratorIterator($directoryCallbackIterator));
    }

    /**
     * @param SplFileInfo $fileInfo
     * @return bool
     */
    public function recursiveDirectoryFilter(SplFileInfo $fileInfo)
    {
        if ($fileInfo->isFile()) {
            return $fileInfo->getFilename() === 'index.php';
        }

        return (substr($fileInfo->getFilename(), 0, 1) !== '.');
    }

    /**
     * @param RecursiveIteratorIterator $iterator
     * @return string|null
     */
    private function filterToDrupalInstallFolder(RecursiveIteratorIterator $iterator)
    {
        /** @var SplFileInfo $fileInfo */
        foreach ($iterator as $fileInfo) {
            $file = $fileInfo->openFile('r');

            while (!$file->eof()) {
                if ($file->fgets() === self::SEARCH_STRING) {
                    return $file->getPath() . '/';
                }
            }
        }
    }
}
