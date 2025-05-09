<?php

namespace Citadel\Levels\Core\Repository;

use Citadel\Levels\Core\Entity\Level;
use Citadel\Levels\Core\Entity\UserXp;
use Forumify\Core\Repository\AbstractRepository;

class UserXpRepository extends AbstractRepository
{

    public static function getEntityClass(): string
    {
        return UserXp::class;
    }
}
