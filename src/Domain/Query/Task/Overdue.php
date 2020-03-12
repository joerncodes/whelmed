<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;
use App\Entity\Task;

class Overdue extends Base
{
    public function getTaskList(): TaskList
    {
        $now = new \DateTimeImmutable();

        return $this->executeQuery(
            $this->queryBuilder
                ->select('t')
                ->from(Task::class, 't')
                ->andWhere(
                    $this->queryBuilder->expr()->lte('t.dueDate', ':now'),
                    $this->queryBuilder->expr()->isNull('t.completedDate')
                )
                ->setParameter('now', $now)
        );
    }
}
