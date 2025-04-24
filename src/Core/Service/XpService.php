<?php

namespace Citadel\Levels\Core\Service;

use Citadel\Levels\Core\Entity\UserXp;
use Citadel\Levels\Core\Repository\UserXpRepository;
use Forumify\Core\Entity\User;

class XpService
{

    public function __construct(
        private readonly UserXpRepository $repository,
    ){}

    public function addXp(User $user, int $amount): void
    {
        $userXp = $this->repository->findOneBy(['user' => $user]);

        if(!$userXp) {
            $userXp = new UserXp();
            $userXp->setUser($user);
        }

        $userXp->setXp($userXp->getXp() + $amount);
        $this->repository->save($userXp);
    }

}