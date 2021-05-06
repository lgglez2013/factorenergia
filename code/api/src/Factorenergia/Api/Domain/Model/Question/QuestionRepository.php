<?php


namespace Factorenergia\Api\Domain\Model\Question;


interface QuestionRepository
{
    public function findByCustom(string $tag, string $title, string $link): QuestionCollection;
    public function insert(Question $question): void;
}