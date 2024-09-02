<?php

namespace App\Factory;

use App\Entity\TestResult;

class TestResultFactory
{
    public function create(array $correctAnswers, array $incorrectAnswers): TestResult
    {
        $testResult = new TestResult();
        $testResult->setResults([
            'correct' => $correctAnswers,
            'incorrect' => $incorrectAnswers,
        ]);

        return $testResult;
    }
}