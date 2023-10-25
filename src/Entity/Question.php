<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    private int $quizzId;

    private int $questionOrder;

    private string $text;

    private array $responses = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getQuizzId(): ?int
    {
        return $this->quizzId;
    }

    public function setQuizzId(int $quizzId): static
    {
        $this->quizzId = $quizzId;

        return $this;
    }

    public function getQuestionOrder(): ?int
    {
        return $this->questionOrder;
    }

    public function setQuestionOrder(int $questionOrder): static
    {
        $this->questionOrder = $questionOrder;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getResponses(): array
    {
        return $this->responses;
    }

    public function setResponses(array $responses): static
    {
        $this->responses = $responses;

        return $this;
    }
}
