<?php

namespace App\Service\Lock;

use App\Entity\Lock\Lock;
use DateTime;
use LaravelDoctrine\ORM\Facades\EntityManager;

class LockService
{
    public function __construct(
        private int $lockTime,
    ) {
    }

    public function isLocked(?Lock $lock): bool
    {
        return $lock && $lock->getLockedUntil() > new DateTime;
    }

    public function isUnlocked(?Lock $lock): bool
    {
        return !$this->isLocked($lock);
    }

    public function lock(Lock $lock): void
    {
        $lockedUntil = (new DateTime())->modify(sprintf('+%s minutes', $this->lockTime));

        $this->storeLockTime($lock, $lockedUntil);
    }

    public function unLock(Lock $lock): void
    {
        $this->storeLockTime($lock, new DateTime());
    }

    private function storeLockTime(Lock $lock, DateTime $lockedUntil): void
    {
        $lock->setLockedUntil($lockedUntil);

        EntityManager::persist($lock);
        EntityManager::flush();
    }
}
