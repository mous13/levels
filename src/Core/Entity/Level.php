<?php

namespace Citadel\Levels\Core\Entity;

use Citadel\Levels\Core\Repository\LevelRepository;
use Doctrine\ORM\Mapping as ORM;
use Forumify\Core\Entity\IdentifiableEntityTrait;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
#[ORM\Table(name: "levels")]
class Level
{
    use IdentifiableEntityTrait;

    #[ORM\Column]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $xpThreshold;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getXpThreshold(): int
    {
        return $this->xpThreshold;
    }

    public function setXpThreshold(int $xpThreshold): void
    {
        $this->xpThreshold = $xpThreshold;
    }
}