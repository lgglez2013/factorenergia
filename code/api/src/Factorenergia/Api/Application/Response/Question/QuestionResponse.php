<?php


namespace Factorenergia\Api\Application\Response\Question;


use Factorenergia\Api\Domain\Model\Question\Question;

class QuestionResponse
{
    private string $id;
    private string $title;
    private string $link;
    private string $tag;

    public function __construct(Question $question)
    {
        $this->id = $question->id()->value();
        $this->title = $question->title();
        $this->link = $question->link();
        $this->tag = $question->tag();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function link(): string
    {
        return $this->link;
    }

    public function tag(): string
    {
        return $this->tag;
    }

    public function toArray()
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'link' => $this->link(),
            'tag' => $this->tag(),
        ];
    }
}