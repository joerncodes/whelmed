<?php

namespace App\Action\Task\Modify;

use Symfony\Component\Routing\Annotation\Route;

class Flag extends Base
{
    /**
     * @Route("/task/flag/{uuid}", name="task.flag")
     */
    public function __invoke(string $uuid)
    {
        $task = $this->getTaskOrFail($uuid)
            ->setFlagged(true);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
