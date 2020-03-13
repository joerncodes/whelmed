<?php

namespace App\Domain\Task\Score;

use App\Entity\Task;
use App\Domain\Task\Score\TaskScoreInterface;
use Webmozart\Assert\Assert;

class TaskScore
{
    /**
     * @var iterable
     */
    private $taskScoreModifiers;

    public function __construct(iterable $taskScoreModifiers)
    {
        $this->taskScoreModifiers = $taskScoreModifiers;
        Assert::allIsInstanceOf($taskScoreModifiers, TaskScoreInterface::class);
    }

    public function getScore(Task $task): int
    {
        $score = 0;

        foreach ($this->taskScoreModifiers as $taskScoreModifier) {
            /** @var TaskScoreInterface $taskScoreModifier */
            $score += $taskScoreModifier->getScore($task);
        }

        return $score;
    }
}
