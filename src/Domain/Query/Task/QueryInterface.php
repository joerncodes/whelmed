<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;

interface QueryInterface
{
    public function getTaskList(): TaskList;
}
