<?php


namespace Factorenergia\Api\Domain\Model\Question;



class Question
{
    private QuestionId $id;
    private string $title;
    private string $link;
    private string $tag;
    private \DateTimeImmutable $createdAt;
    private \DateTime $updatedAt;

    public function __construct(QuestionId $id, string $title, string $link, string $tag)
    {
        $this->id = $id;
        $this->title = $title;
        $this->tag = $tag;
        $this->link = $link;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function id(): QuestionId
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

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}