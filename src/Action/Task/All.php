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
        $taskList= $this->repository->findAllTasks();

        $title = 'All tasks';

        $content = $this->twig->render('page/task/task-list.html.twig', compact('taskList', 'title'));

        return new Response($content);
    }
}
