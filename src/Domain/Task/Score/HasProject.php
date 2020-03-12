<?php

namespace App\Domain\Task\Score;

use App\Entity\Task;

class HasProject implements TaskScoreInterface
{
    public function getScore(Task $task): int
    {
        return $task->getProject() !== null ? 2 : 0;
    }
}
