<?php

namespace App\Domain;

use App\Entity\Task;
use Webmozart\Assert\Assert;

class TaskList
{
    /**
     * @var array
     */
    private $tasks;

    public function __construct(array $tasks)
    {
        Assert::allIsInstanceOf($tasks, Task::class);
        $this->tasks = $tasks;

        usort($this->tasks, function($a, $b) {
            /** @var Task $a */
            /** @var Task $b */

            if($a->isCompleted() && $b->isCompleted()) {
                return 0;
            }

            if($a->isCompleted() && !$b->isCompleted()) {
                return 1;
            }

            return -1;
        });
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
