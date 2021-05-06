<?php


namespace Factorenergia\Api\Application\Response\Question;


use Factorenergia\Api\Domain\Model\Question\QuestionCollection;

class QuestionCollectionResponse
{
    private array $questions;

    public function __construct(QuestionCollection $questionCollection)
    {
        $this->questions = [];
        foreach ($questionCollection->getCollection() as $question) {
            $this->questions[] = new QuestionResponse($question);
        }
    }

    public function questions(): array
    {
        return $this->questions;
    }

    public function toArray()
    {
        return array_map(function ($question) {
            return $question->toArray();
        }, $this->questions());
    }
}