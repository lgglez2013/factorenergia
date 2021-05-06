<?php


namespace Factorenergia\Api\Infrastructure\Persistence\Doctrine\Entity;


class Question
{
    private string $id;
    private string $title;
    private string $link;
    private string $tag;
    private \DateTimeInterface $createdAt;
    private \DateTimeInterface $updatedAt;

    public function __construct(string $id, string $title, string $link, string $tag, \DateTimeInterface $createdAt, \DateTimeInterface $updatedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->tag = $tag;
        $this->link = $link;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function createdAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

}