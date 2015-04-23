<?php

namespace DrupalContainer\Composer\Commands;

use DrupalContainer\Composer\FileSystem\DrupalWebDirectoryResolver;
use DrupalContainer\Composer\Question\QuestionFactory;
use DrupalContainer\Composer\Question\Questions\DrupalRootDirectory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console;

class Install extends Console\Command\Command
{

    private $drupalRootDirectoryQuestion;
    private $questionFactory;

    /**
     * @inheritdoc
     */
    public function __construct(
        QuestionFactory $questionFactory,
        DrupalRootDirectory $drupalRootDirectoryQuestion
    )
    {
        $this->drupalRootDirectoryQuestion = $drupalRootDirectoryQuestion;
        $this->questionFactory             = $questionFactory;

        parent::__construct();
    }

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
        /** @var \Symfony\Component\Console\Helper\QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $resolver = new DrupalWebDirectoryResolver();
        $folder   = $resolver->resolve(getcwd());

        if ($folder === null) {
            throw new \RuntimeException(__CLASS__ . ' can not find your drupal install path, please ensure its
            reachable relative from the composer.json');
        }

        $output->writeln(sprintf('<info>%s</info>', 'Found Drupal Install:'));
        $output->writeln(sprintf('<error>%s</error>', $folder));

        $question = $this->questionFactory->create($this->drupalRootDirectoryQuestion);
        $answer   = $helper->ask($input, $output, $question);

        if($answer === 'No'){
            throw new \Exception('Failed to find the correct drupal path, you can run bin/drupal-container composer:install to retry');
        }

        // dirty
        mkdir($folder . '/sites/all/modules/drupal_container/', 0775, true);
        $module = __DIR__ . '/../../Drupal/Module/';

        copy($module . 'drupal_container.info', $folder  . '/sites/all/modules/drupal_container/drupal_container.info');
        copy($module . 'drupal_container.install', $folder  . '/sites/all/modules/drupal_container/drupal_container.install');
        copy($module . 'drupal_container.module', $folder  . '/sites/all/modules/drupal_container/drupal_container.module');

        $output->writeln(sprintf('<info>%s</info>', 'Module Installed'));
    }
}
