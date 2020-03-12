<?php

namespace App\Domain\Task\Score;

use App\Entity\Task;

class Flagged implements TaskScoreInterface
{
    public function getScore(Task $task): int
    {
        return $task->isFlagged() ? 4 : 0;
    }
}
