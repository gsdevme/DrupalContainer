<?php

namespace DrupalContainer\Composer\Question\Questions;

use DrupalContainer\Composer\Question\ChoiceQuestionInterface;

class DrupalRootDirectory implements ChoiceQuestionInterface
{

    /**
     * @inheritdoc
     */
    public function getQuestion()
    {
        return 'Is this your Drupal root directory?';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultAnswer()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage()
    {
        return 'Selection %s is invalid';
    }

    /**
     * @inheritdoc
     */
    public function getChoiceArray()
    {
        return [
            'Yes' => 'Yes, install the Drupal module to this location',
            'No'  => 'No, will prompt for the relative path'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutocompleterValues()
    {
        return ['Yes', 'No'];
    }
}
