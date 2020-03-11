<?php

namespace App\Domain\Query;

use App\Domain\Task\TaskList;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class Flagged implements QueryInterface
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
                $this->queryBuilder->expr()->eq('t.flagged', true)
            )
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();

        return new TaskList($result);
    }
}
