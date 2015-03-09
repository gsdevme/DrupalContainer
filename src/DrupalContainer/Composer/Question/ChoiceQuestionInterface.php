<?php

namespace DrupalContainer\Composer\Question;

interface ChoiceQuestionInterface extends QuestionInterface
{
    public function getChoiceArray();
}
