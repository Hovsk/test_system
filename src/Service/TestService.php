<?php

namespace App\Service;

use App\DTO\TestResultDTO;
use App\Entity\Question;
use App\Entity\TestResult;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class TestService
{
    private QuestionRepository $questionRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        QuestionRepository $questionRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->questionRepository = $questionRepository;
        $this->entityManager = $entityManager;
    }

    public function getRandomQuestions(int $limit): array
    {
        $questions = $this->questionRepository->findAllWithAnswers();
        shuffle($questions);

        return array_slice($questions, 0, $limit);
    }

    public function processFormSubmission(FormInterface $form, array $questions): TestResultDTO
    {
        $correctQuestionIds = [];
        $incorrectQuestionIds = [];

        foreach ($questions as $question) {
            $correctAnswerIds = $this->getCorrectAnswerIds($question);
            $submittedAnswerIds = $this->getSubmittedAnswerIds($form, $question);

            if ($this->areAnswersCorrect($correctAnswerIds, $submittedAnswerIds)) {
                $correctQuestionIds[] = $question->getId();
            } else {
                $incorrectQuestionIds[] = $question->getId();
            }
        }

        $testResult = $this->createTestResult($correctQuestionIds, $incorrectQuestionIds);

        return new TestResultDTO($testResult);
    }

    private function getCorrectAnswerIds(Question $question): array
    {
        return $question->getCorrectAnswers()->first()->getCorrectCombinations();
    }

    private function getSubmittedAnswerIds(FormInterface $form, Question $question): array
    {
        $submittedAnswers = [];

        foreach ($question->getAnswers() as $answer) {
            if ($form->get($question->getId())->get($answer->getId())->getData()) {
                $submittedAnswers[] = $answer->getId();
            }
        }

        return $submittedAnswers;
    }

    private function areAnswersCorrect(array $correctAnswers, array $submittedAnswers): bool
    {
        return empty(array_diff($correctAnswers, $submittedAnswers))
            && empty(array_diff($submittedAnswers, $correctAnswers));
    }

    private function createTestResult(array $correctAnswers, array $incorrectAnswers): TestResult
    {
        $testResult = new TestResult();
        $testResult->setResults([
            'correct' => $correctAnswers,
            'incorrect' => $incorrectAnswers,
        ]);

        $this->entityManager->persist($testResult);
        $this->entityManager->flush();

        return $testResult;
    }
}
