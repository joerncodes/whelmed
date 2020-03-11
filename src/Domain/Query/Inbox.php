<?php

namespace App\Domain\Query;

use App\Domain\Task\TaskList;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class Inbox
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->queryBuilder = $em->createQueryBuilder();
    }

    public function getTaskList(): TaskList
    {
        $result = $this->queryBuilder
            ->select('t')
            ->from(Task::class, 't')
            ->where(
                $this->queryBuilder->expr()->isNull('t.project')
            )
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();

        return new TaskList($result);
    }
}
