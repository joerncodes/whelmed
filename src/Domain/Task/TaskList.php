<?php

namespace App\Domain\Task;

use App\Domain\Task\Score\TaskScore;
use App\Entity\Task;
use Webmozart\Assert\Assert;

class TaskList implements \JsonSerializable
{
    /**
     * @var array
     */
    private $tasks;
    /**
     * @var TaskScore
     */
    private $taskScore;

    public function __construct(TaskScore $taskScore)
    {
        $this->taskScore = $taskScore;
    }

    private function sort()
    {
        $taskScore = $this->taskScore;

        usort($this->tasks, function (Task $a, Task $b) use ($taskScore): bool {
            $aScore = $taskScore->getScore($a);
            $bScore = $taskScore->getScore($b);

            if ($aScore === $bScore) {
                return 0;
            }

            return $aScore < $bScore;
        });
    }

    public function setTasks(array $tasks): self
    {
        Assert::allIsInstanceOf($tasks, Task::class);
        $this->tasks = $tasks;
        $this->sort();

        return $this;

        /*
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

            if ($a->isCompleted()) {
                $aScore += 16;
            }
            if ($b->isCompleted()) {
                $bScore += 16;
            }

            if ($a->getTitle() < $b->getTitle()) {
                $bScore += 1;
            } elseif ($b->getTitle() < $a->getTitle()) {
                $aScore += 1;
            }


            return $aScore > $bScore;
        });
            */
    }

    public function getIncomplete(): array
    {
        $incomplete = [];
        foreach ($this->tasks as $task) {
            if (!$task->isCompleted()) {
                $incomplete[]  = $task;
            }
        }
        return $incomplete;
    }

    public function getCompleted(): array
    {
        $completed = [];
        foreach ($this->tasks as $task) {
            if ($task->isCompleted()) {
                $completed[]  = $task;
            }
        }
        return $completed;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function jsonSerialize()
    {
        return [
            'count' => count($this->tasks),
            'tasks' => $this->tasks,
        ];
    }
}
