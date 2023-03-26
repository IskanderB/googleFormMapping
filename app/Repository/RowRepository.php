<?php

namespace App\Repository;

use App\Entity\Row\Row;
use App\Entity\Task\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class RowRepository extends EntityRepository
{
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

    public function getRows(Task $task)
    {
        $sql = <<<SQL
        SELECT r.id as id, r.content as content,
               jsonb_agg(
                   json_build_object(
                   'cloudId', f.cloud_id,
                   'originalName', f.original_name,
                   'storage', f.storage,
                   'path', f.path
                    )
               ) as documents
        FROM rows r
        LEFT JOIN documents d
        ON d.row_id = r.id
        LEFT JOIN files f
        ON f.id = d.file_id
        WHERE r.task_id = :task
        GROUP BY r.id, r.content
        SQL;


        $rsm = (new ResultSetMapping())
            ->addScalarResult('id', 'id', 'integer')
            ->addScalarResult('content', 'content', 'jsonb')
            ->addScalarResult('documents', 'documents', 'jsonb');

        return $this
            ->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->setParameter('task', $task->getId())
            ->getResult();
    }
}
