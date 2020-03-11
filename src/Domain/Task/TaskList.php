<?php

namespace App\Domain\Task;

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

        usort($this->tasks, function (Task $a, Task $b): bool {
            $aScore = $bScore = 0;

            if ($a->isFlagged()) {
                $bScore += 8;
            }
            if ($b->isFlagged()) {
                $aScore += 8;
            }

            if ($a->isCompleted() && !$b->isCompleted()) {
                $aScore += 4;
            } elseif ($b->isCompleted() && !$a->isCompleted()) {
                $bScore += 4;
            }

            if ($a->getProject() !== null && $b->getProject() === null) {
                $bScore += 2;
            } elseif ($b->getProject() !== null && $a->getProject() === null) {
                $aScore += 2;
            }

            if ($a->getTitle() < $b->getTitle()) {
                $bScore += 1;
            } elseif ($b->getTitle() < $a->getTitle()) {
                $aScore += 1;
            }


            return $aScore > $bScore;
        });
    }

    public function getIncomplete(): array
    {
        $incomplete = [];
        foreach($this->tasks as $task) {
            if(!$task->isCompleted()) {
                $incomplete[]  = $task;
            }
        }
        return $incomplete;
    }

    public function getCompleted(): array
    {
        $completed = [];
        foreach($this->tasks as $task) {
            if($task->isCompleted()) {
                $completed[]  = $task;
            }
        }
        return $completed;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
