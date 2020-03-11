<?php

namespace App\Action\Task;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class All extends Base
{
    /**
     * @Route("/", name="task.all")
     * @return Response
     */
    public function __invoke()
    {
        $response = '';
        $tasks = $this->repository->findAllTasks()->getTasks();

        $content = $this->twig->render('page/task/tasks-all.html.twig', compact('tasks'));

        return new Response($content);
    }
}
