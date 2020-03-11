<?php

namespace App\Action\Task;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class All extends Base
{
    /**
     * @Route("/", name="task.all")
     * @return Response
     */
    public function __invoke()
    {
        $response = '';
        $tasks = $this->repository->findAll()->getTasks();

        $content = $this->twig->render('page/task/tasks-all.html.twig', compact('tasks'));

        return new Response($content);
    }
}
