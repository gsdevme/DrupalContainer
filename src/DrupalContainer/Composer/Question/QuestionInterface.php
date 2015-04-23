<?php

namespace DrupalContainer\Composer\Question;

interface QuestionInterface
{

    /**
     * @return string
     */
    public function getQuestion();

    /**
     * @return string|null
     */
    public function getDefaultAnswer();

    /**
     * @return string|null
     */
    public function getErrorMessage();

    /**
     * @return array|null
     */
    public function getAutocompleterValues();
}
