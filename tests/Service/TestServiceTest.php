<?php

namespace App\Tests\Service;

use App\Entity\Question;
use App\Factory\TestResultFactory;
use App\Repository\QuestionRepository;
use App\Repository\TestResultRepository;
use App\Service\TestService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestServiceTest extends TestCase
{
    private MockObject $questionRepository;
    private MockObject $testResultRepository;
    private MockObject $testResultFactory;
    private TestService $testService;

    protected function setUp(): void
    {
        $this->questionRepository = $this->createMock(QuestionRepository::class);
        $this->testResultRepository = $this->createMock(TestResultRepository::class);
        $this->testResultFactory = $this->createMock(TestResultFactory::class);

        $this->testService = new TestService(
            $this->questionRepository,
            $this->testResultRepository,
            $this->testResultFactory
        );
    }

    /**
     * @dataProvider getRandomQuestionsDataProvider
     */
    public function testGetRandomQuestions(int $totalQuestions, int $limit): void
    {
        $questions = $this->createQuestions($totalQuestions);
        $this->questionRepository
            ->method('findAllWithAnswers')
            ->willReturn($questions);

        $result = $this->testService->getRandomQuestions($limit);

        $expectedCount = min($totalQuestions, $limit);
        $this->assertCount($expectedCount, $result);
        $this->assertContainsOnlyInstancesOf(Question::class, $result);
    }

    public function getRandomQuestionsDataProvider(): \Generator
    {
        yield 'Limit less than total' => [10, 4];
        yield 'Limit equal to total' => [5, 5];
        yield 'Limit more than total' => [3, 5];
        yield 'Zero questions' => [0, 5];
    }

    private function createQuestions(int $count): array
    {
        $questions = [];
        for ($i = 1; $i <= $count; ++$i) {
            $questions[] = new Question();
        }

        return $questions;
    }
}
