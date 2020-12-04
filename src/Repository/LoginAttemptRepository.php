<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\LoginAttempt;
use Doctrine\Persistence\ManagerRegistry;


class LoginAttemptRepository extends ServiceEntityRepository
{
    const DELAY_IN_MINUTES = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoginAttempt::class);
    }

    public function countRecentLoginAttempts(string $email): int
    {
        $timeAgo = new \DateTimeImmutable(sprintf('-%d minutes', self::DELAY_IN_MINUTES));

        return $this->createQueryBuilder('la')
            ->select('COUNT(la)')
            ->where('la.date >= :date')
            ->andWhere('la.email = :email')
            ->getQuery()
            ->setParameters([
                'date' => $timeAgo,
                'email' => $email
            ])
            ->getSingleScalarResult();
    }
}