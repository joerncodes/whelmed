<?php

namespace App\Domain\Task\Score;

use App\Entity\Task;

class Completed implements TaskScoreInterface
{
    public function getScore(Task $task): int
    {
        return $task->isCompleted() ? -16 : 0;
    }
}
