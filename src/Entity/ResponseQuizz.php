<?php

namespace App\Entity;

use App\Repository\ResponseQuizzRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseQuizzRepository::class)]
class ResponseQuizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $textResponseQuizz = null;

    #[ORM\Column]
    private ?bool $isTrue = null;

    #[ORM\ManyToOne(inversedBy: 'responseQuizzs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTextResponseQuizz(): ?string
    {
        return $this->textResponseQuizz;
    }

    public function setTextResponseQuizz(string $textResponseQuizz): static
    {
        $this->textResponseQuizz = $textResponseQuizz;

        return $this;
    }

    public function isIsTrue(): ?bool
    {
        return $this->isTrue;
    }

    public function setIsTrue(bool $isTrue): static
    {
        $this->isTrue = $isTrue;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }
}
