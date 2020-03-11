<?php

namespace App\Domain\Query;

use App\Domain\Task\TaskList;

interface QueryInterface
{
    public function getTaskList(): TaskList;
}
