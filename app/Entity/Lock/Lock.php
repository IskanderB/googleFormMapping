<?php

namespace App\Entity\Lock;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Lock
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    private DateTime $lockedUntil;

    public function __construct()
    {
        $this->lockedUntil = new DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getLockedUntil(): DateTime
    {
        return $this->lockedUntil;
    }

    /**
     * @param DateTime $lockedUntil
     * @return Lock
     */
    public function setLockedUntil(DateTime $lockedUntil): Lock
    {
        $this->lockedUntil = $lockedUntil;
        return $this;
    }
}
