<?php

namespace Citadel\Levels\Core\Service;

use Citadel\Levels\Core\Entity\UserXp;
use Citadel\Levels\Core\Repository\UserXpRepository;
use Forumify\Core\Entity\User;
use Forumify\Plugin\Service\PluginVersionChecker;

class XpService
{

    public function __construct(
        private readonly UserXpRepository $repository,
        private readonly PluginVersionChecker $pluginVersionChecker,
    ){}

    public function addXp(User $user, int $amount): void
    {
        $hasLicense = $this->pluginVersionChecker->isVersionInstalled('citadel/levels', 'premium');
        if($hasLicense) {
            $userXp = $this->repository->findOneBy(['user' => $user]);

            if(!$userXp) {
                $userXp = new UserXp();
                $userXp->setUser($user);
            }

            $userXp->setXp($userXp->getXp() + $amount);
            $this->repository->save($userXp);
        }
    }

}