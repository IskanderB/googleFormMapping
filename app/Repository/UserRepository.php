<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(User::class));
    }

    public function getUsers(): array
    {
        return $this
            ->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'desc')
            ->getQuery()
            ->getResult();
    }
}
