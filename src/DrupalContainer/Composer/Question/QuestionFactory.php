<?php

namespace DrupalContainer\Composer\Question;

use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class QuestionFactory
{
    /**
     * @param QuestionInterface $question
     * @return ChoiceQuestion|Question
     */
    public function create(QuestionInterface $question)
    {
        if ($question instanceof ChoiceQuestionInterface) {
            $consoleQuestion = new ChoiceQuestion($question->getQuestion(), $question->getChoiceArray(), $question->getDefaultAnswer());
        } else {
            $consoleQuestion = new Question($question->getQuestion(), $question->getDefaultAnswer());
        }

        if ($question->getErrorMessage() !== null) {
            $consoleQuestion->setErrorMessage($question->getErrorMessage());
        }

        if ($question->getAutocompleterValues() !== null) {
            $consoleQuestion->setAutocompleterValues($question->getAutocompleterValues());
        }

        return $consoleQuestion;
    }
}
