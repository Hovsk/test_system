<?php

namespace App\Controller;

use App\Entity\TestResult;
use App\Form\QuestionType;
use App\Service\TestServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public const NUMBER_OF_SHOWING_QUESTIONS = 4;

    public function __construct(private TestServiceInterface $testService)
    {
    }

    #[Route('/', name: 'show')]
    public function show(Request $request, SessionInterface $session): Response
    {
        $questions = $this->getOrCreateQuestions($session);

        $form = $this->createQuestionsForm($questions);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->handleValidFormSubmission($form, $questions, $session);
        }

        return $this->render('test/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function getOrCreateQuestions(SessionInterface $session): array
    {
        if ($session->has('questions')) {
            return $session->get('questions');
        }

        $questions = $this->testService->getRandomQuestions(self::NUMBER_OF_SHOWING_QUESTIONS);
        $session->set('questions', $questions);

        return $questions;
    }

    private function handleValidFormSubmission($form, array $questions, SessionInterface $session): Response
    {
        $resultsDTO = $this->testService->processFormSubmission($form, $questions);

        $session->remove('questions');

        return $this->redirectToRoute('app_test_results', ['id' => $resultsDTO->getResultId()]);
    }

    #[Route('/results/{id}', name: 'app_test_results')]
    public function results(TestResult $testResult): Response
    {
        return $this->render('test/results.html.twig', [
            'result' => $testResult,
        ]);
    }

    private function createQuestionsForm(array $questions): FormInterface
    {
        $formBuilder = $this->createFormBuilder();

        foreach ($questions as $question) {
            $formBuilder->add($question->getId(), QuestionType::class, [
                'label' => $question->getText(),
                'question' => $question,
            ]);
        }

        return $formBuilder->getForm();
    }
}
