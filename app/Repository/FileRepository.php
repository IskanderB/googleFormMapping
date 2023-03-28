<?php

namespace App\Repository;

use App\Entity\File\File;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class FileRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(File::class));
    }
}
