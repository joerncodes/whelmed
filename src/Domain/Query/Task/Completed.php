<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;
use App\Entity\Task;

class Completed extends Base
{
    public function getTaskList(): TaskList
    {
        $queryBuilder = $this->queryBuilder
            ->select('t')
            ->from(Task::class, 't')
            ->where(
                $this->queryBuilder->expr()->isNotNull('t.completedDate')
            )
        ;

        return $this->executeQuery($queryBuilder);
    }
}
