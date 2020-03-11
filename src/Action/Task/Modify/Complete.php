<?php

namespace App\Action\Task\Modify;

use App\Action\Task\Base;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Complete extends Base
{
    /**
     * @Route("/task/complete/{uuid}", name="task.complete")
     */
    public function __invoke(Request $request, string $uuid)
    {
        $task = $this->getTaskOrFail($uuid);
        $task->setCompletedDate(new \DateTime());

        $this->repository->saveAndFlush($task);

        return new RedirectResponse(
            $request->headers->get('referer')
        );
    }
}
