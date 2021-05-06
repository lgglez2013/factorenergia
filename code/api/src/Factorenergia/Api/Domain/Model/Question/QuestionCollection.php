<?php


namespace Factorenergia\Api\Domain\Model\Question;


use Factorenergia\Api\Domain\Collection\ObjectCollection;

class QuestionCollection extends ObjectCollection
{
    protected function className(): string
    {
        return Question::class;
    }

}