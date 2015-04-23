<?php

namespace DrupalContainer\Composer\Question;

interface ChoiceQuestionInterface extends QuestionInterface
{
    /**
     * @return array
     */
    public function getChoiceArray();
}
