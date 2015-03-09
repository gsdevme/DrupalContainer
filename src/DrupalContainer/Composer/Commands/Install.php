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

        if ($folder !== null) {

            $output->writeln(sprintf('<info>%s</info>', 'Found Drupal Install:'));
            $output->writeln(sprintf('<error>%s</error>', $folder));

            $question = $this->questionFactory->create($this->drupalRootDirectoryQuestion);
            $helper->ask($input, $output, $question);
        }
    }
}
