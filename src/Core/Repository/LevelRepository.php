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
}