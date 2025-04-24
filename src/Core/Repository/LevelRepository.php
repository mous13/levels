<?php

namespace Citadel\Levels\Core\Repository;

use Citadel\Levels\Core\Entity\Level;
use Forumify\Core\Repository\AbstractRepository;

class LevelRepository extends AbstractRepository
{

    public static function getEntityClass(): string
    {
        return Level::class;
    }

    public function findByXp(int $xp): ?Level
    {
        return $this->createQueryBuilder('l')
            ->where('l.xpThreshold <= :xp')
            ->setParameter('xp', $xp)
            ->orderBy('l.xpThreshold', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.xpThreshold', 'DESC')
            ->getQuery()
            ->getResult();
    }
}