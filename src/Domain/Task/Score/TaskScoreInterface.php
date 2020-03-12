<?php

namespace App\Domain\Task\Score;

use App\Entity\Task;

interface TaskScoreInterface
{
    public function getScore(Task $task): int;
}
