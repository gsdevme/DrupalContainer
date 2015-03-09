<?php

namespace DrupalContainer\Composer\Question;

interface ChoiceQuestionInterface extends QuestionInterface
{
    /**
     * @return array|null
     */
    public function getChoiceArray();
}
