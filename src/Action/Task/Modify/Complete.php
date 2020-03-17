<?php

namespace App\Action\Task\Modify;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class Complete extends Base
{
    /**
     * @Route("/task/complete/{uuid}", name="task.complete")
     */
    public function __invoke(string $uuid): RedirectResponse
    {
        $task = $this->getTaskOrFail($uuid)
                ->setCompletedDate(new \DateTime())
                ->setFlagged(false);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
