<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class Inbox extends Base
{
    public function getTaskList(): TaskList
    {
        return $this->executeQuery(
            $this->queryBuilder
                ->select('t')
                ->from(Task::class, 't')
                ->where(
                    $this->queryBuilder->expr()->isNull('t.project')
                )
        );
    }
}
