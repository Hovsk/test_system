<?php

namespace App\Service;

use App\DTO\TestResultDTO;
use Symfony\Component\Form\FormInterface;

interface TestServiceInterface
{
    public function getRandomQuestions(int $limit): array;
    public function processFormSubmission(FormInterface $form, array $questions): TestResultDTO;
}