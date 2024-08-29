<?php

namespace App\Tests\Service;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\TestService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestServiceTest extends TestCase
{
    private MockObject $questionRepository;
    private TestService $testService;

    protected function setUp(): void
    {
        $this->questionRepository = $this->createMock(QuestionRepository::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $this->testService = new TestService($this->questionRepository, $entityManager);
    }

    /**
     * @dataProvider randomQuestionsProvider
     */
    public function testGetRandomQuestionsReturnsLimitedQuestions(
        array $questions,
        int $limit,
        int $expectedCount
    ): void {
        $this->questionRepository
            ->expects($this->once())
            ->method('findAllWithAnswers')
            ->willReturn($questions);

        $result = $this->testService->getRandomQuestions($limit);

        $this->assertCount($expectedCount, $result);
    }

    public function randomQuestionsProvider(): \Generator
    {
        yield 'limit is 1, only one question returned' => [
            [$this->createMock(Question::class), $this->createMock(Question::class)],
            1,
            1,
        ];

        yield 'limit exceeds questions count, all questions returned' => [
            [$this->createMock(Question::class), $this->createMock(Question::class)],
            5,
            2,
        ];
    }
}
