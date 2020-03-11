<?php

namespace App\Action\Task\Modify;

use App\Action\Task\Base;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Flag extends Base
{
    /**
     * @Route("/task/flag/{uuid}", name="task.flag")
     */
    public function __invoke(Request $request, string $uuid)
    {
        $task = $this->getTaskOrFail($uuid);
        $task->setFlagged(true);

        $this->repository->saveAndFlush($task);

        return new RedirectResponse(
            $request->headers->get('referer')
        );
    }
}
