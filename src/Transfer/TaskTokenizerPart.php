<?php

namespace App\Transfer;

use App\Entity\Task;

class TaskTokenizerPart
{
    /**
     * @var string
     */
    private $taskTitle;

    /**
     * @var Task
     */
    private $task;

    public function __construct(string $taskTitle, Task $task)
    {
        $this->taskTitle = $taskTitle;
        $this->task = $task;
    }

    /**
     * @return string
     */
    public function getTaskTitle(): string
    {
        return $this->taskTitle;
    }

    /**
     * @param string $taskTitle
     * @return TaskTokenizerPart
     */
    public function setTaskTitle(string $taskTitle): TaskTokenizerPart
    {
        $this->taskTitle = $taskTitle;
        return $this;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     * @return TaskTokenizerPart
     */
    public function setTask(Task $task): TaskTokenizerPart
    {
        $this->task = $task;
        return $this;
    }
}
