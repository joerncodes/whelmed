<?php

namespace App\Action\Task;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Complete extends Base
{
    /**
     * @Route("/task/complete/{uuid}", name="task.complete")
     */
    public function __invoke(TaskRepository $taskRepository, string $uuid)
    {
        $task = $this->getTaskOrFail($uuid);
        $task->setCompletedDate(new \DateTime());

        $this->repository->saveAndFlush($task);

        $content = $this->twig->render('page/task/task-completed.html.twig', compact('task'));

        return new Response($content);
    }
}
