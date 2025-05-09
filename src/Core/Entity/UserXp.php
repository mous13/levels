<?php

namespace Citadel\Levels\Core\Entity;

use Citadel\Levels\Core\Repository\UserXpRepository;
use Doctrine\ORM\Mapping as ORM;
use Forumify\Core\Entity\IdentifiableEntityTrait;
use Forumify\Core\Entity\User;

#[ORM\Entity(repositoryClass: UserXpRepository::class)]
#[ORM\Table(name: "user_xp")]
class UserXp
{
    use IdentifiableEntityTrait;

    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private User $user;

    #[ORM\Column(type: "integer")]
    private int $xp = 0;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getXp(): int
    {
        return $this->xp;
    }

    public function setXp(int $xp): void
    {
        $this->xp = $xp;
    }
}
