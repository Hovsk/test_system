<?php

namespace App\Service;

use App\DTO\TestResultDTO;
use App\Entity\Question;
use App\Factory\TestResultFactory;
use App\Repository\QuestionRepository;
use App\Repository\TestResultRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TestService implements TestServiceInterface
{
    public function __construct(
        private readonly QuestionRepository $questionRepository,
        private readonly TestResultRepository $testResultRepository,
        private readonly TestResultFactory $testResultFactory
    ) {
    }

    public function getRandomQuestions(int $limit): array
    {
        $questions = $this->questionRepository->findAllWithAnswers();
        shuffle($questions);

        return array_slice($questions, 0, $limit);
    }

    public function processFormSubmission(FormInterface $form, array $questions): TestResultDTO
    {
        $this->validateForm($form);

        if (empty($questions)) {
            throw new BadRequestHttpException('No questions provided.');
        }

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

        $testResult = $this->testResultFactory->create($correctQuestionIds, $incorrectQuestionIds);
        $this->testResultRepository->save($testResult);

        return new TestResultDTO($testResult);
    }

    private function validateForm(FormInterface $form): void
    {
        if (!$form->isSubmitted()) {
            throw new BadRequestHttpException('The form was not submitted.');
        }

        if (!$form->isValid()) {
            throw new BadRequestHttpException(
                'The form contains invalid data. Please check all fields and try again.'
            );
        }
    }

    private function getCorrectAnswerIds(Question $question): array
    {
        $correctAnswers = $question->getCorrectAnswers()->first();

        if (!$correctAnswers) {
            throw new \LogicException('No correct answers found for the question ID: ' . $question->getId());
        }

        return $correctAnswers->getCorrectCombinations();
    }

    private function getSubmittedAnswerIds(FormInterface $form, Question $question): array
    {
        $submittedAnswers = [];
        $formQuestion = $form->get($question->getId());

        foreach ($question->getAnswers() as $answer) {
            $formAnswer = $formQuestion->get($answer->getId());
            if ($formAnswer->getData()) {
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
}
