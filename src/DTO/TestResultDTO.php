<?php

namespace App\DTO;

use App\Entity\TestResult;

class TestResultDTO
{
    private int $resultId;
    private array $correctAnswers;
    private array $incorrectAnswers;

    public function __construct(TestResult $testResult)
    {
        $this->resultId = $testResult->getId();

        $results = $testResult->getResults();
        $this->correctAnswers = $results['correct'];
        $this->incorrectAnswers = $results['incorrect'];
    }

    public function getResultId(): int
    {
        return $this->resultId;
    }

    public function getCorrectAnswers(): array
    {
        return $this->correctAnswers;
    }

    public function getIncorrectAnswers(): array
    {
        return $this->incorrectAnswers;
    }
}
