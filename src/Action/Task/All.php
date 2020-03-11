<?php

namespace App\Action\Task;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class All
{
    /**
     * @Route("/", name="task.all")
     * @param TaskRepository $repository
     * @return Response
     */
    public function __invoke(TaskRepository $repository, Environment $twig)
    {
        $response = '';
        $tasks = $repository->findAll();

        $content = $twig->render('page/task/tasks-all.html.twig', compact('tasks'));

        return new Response($content);
    }
}
