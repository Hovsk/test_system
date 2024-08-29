<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function findAllWithAnswers(): array
    {
        return $this->createQueryBuilder('q')
            ->leftJoin('q.answers', 'a')
            ->leftJoin('q.correctAnswers', 'ca')
            ->addSelect('ca')
            ->addSelect('a')
            ->getQuery()
            ->getResult();
    }
}
