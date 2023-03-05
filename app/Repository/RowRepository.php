<?php

namespace App\Repository;

use App\Entity\Row;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class RowRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Row::class));
    }

    public function exists(Task $task, string $content): bool
    {
        return (bool) $this->findOneBy([
            'content' => $content,
            'task' => $task,
        ]);
    }
}
