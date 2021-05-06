<?php


namespace Factorenergia\Api\Application\Request\Question;


class CreateQuestionRequest
{
    private string $title;
    private string $link;
    private string $tag;

    public function __construct(string $title, string $link, string $tag)
    {
        $this->title = $title;
        $this->link = $link;
        $this->tag = $tag;
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



}