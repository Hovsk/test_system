<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $text;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question', cascade: ['persist'], orphanRemoval: true)]
    private Collection $answers;

    #[ORM\OneToMany(targetEntity: CorrectAnswer::class, mappedBy: 'question', cascade: ['persist'], orphanRemoval: true)]
    private Collection $correctAnswers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->correctAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getCorrectAnswers(): Collection
    {
        return $this->correctAnswers;
    }

    public function addCorrectAnswer(CorrectAnswer $correctAnswer): self
    {
        if (!$this->correctAnswers->contains($correctAnswer)) {
            $this->correctAnswers[] = $correctAnswer;
            $correctAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeCorrectAnswer(CorrectAnswer $correctAnswer): self
    {
        if ($this->correctAnswers->removeElement($correctAnswer)) {
            if ($correctAnswer->getQuestion() === $this) {
                $correctAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
