<?php

namespace App\Action\Task\Modify;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class Incomplete extends Base
{
    /**
     * @Route("/task/incomplete/{uuid}", name="task.incomplete")
     */
    public function __invoke(string $uuid): RedirectResponse
    {
        $task = $this->getTaskOrFail($uuid)
                ->setCompletedDate(null);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
