<?php

namespace App\Repository;

use App\Entity\Row\Row;
use App\Entity\Task\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class RowRepository extends EntityRepository
{
    use PaginatesFromParams;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Row::class));
    }

    public function exists(Task $task, array $content): bool
    {
        return (bool) $this
            ->createQueryBuilder('r')
            ->where('r.task = :task AND r.content = :content')
            ->setParameters([
                'task' => $task,
                'content' => json_encode($content),
            ])
            ->getQuery()
            ->getResult();
    }

    public function getRows(Task $task, int $page = 1, int $limit = 10): LengthAwarePaginator
    {
        $query = $this
            ->createQueryBuilder('r')
            ->where('r.task = :task')
            ->setParameter('task', $task)
            ->orderBy('r.id', 'DESC')
            ->getQuery();

        return $this->paginate($query, $limit, $page);
    }
}
