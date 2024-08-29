<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CorrectAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'json')]
    private array $correctCombinations = [];

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'correctAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorrectCombinations(): array
    {
        return $this->correctCombinations;
    }

    public function setCorrectCombinations(array $correctCombinations): self
    {
        $this->correctCombinations = $correctCombinations;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
