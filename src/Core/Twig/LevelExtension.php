<?php

namespace Citadel\Levels\Core\Twig;

use Citadel\Levels\Core\Entity\Level;
use Citadel\Levels\Core\Repository\LevelRepository;
use Citadel\Levels\Core\Repository\UserXpRepository;
use Forumify\Core\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LevelExtension extends AbstractExtension
{
    public function __construct(
        private readonly LevelRepository $levels,
        private UserXpRepository $userXpRepository
    ){}

    public function getFunctions()
    {
        return [
            new TwigFunction('level', [$this, 'getUserLevel']),
            new TwigFunction('xp', [$this, 'getUserXp']),
        ];
    }

    public function getUserLevel(User $user): ?Level
    {
        $xp = $this->getUserXp($user);
        return $this->levels->findByXp($xp);
    }

    public function getUserXp(User $user): int
    {
        $userXp = $this->userXpRepository->findOneBy(['user' => $user]);
        return $userXp?->getXp() ?? 0;
    }
}