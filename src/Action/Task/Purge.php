<?php

namespace App\Action\Task;

use App\Domain\Query\Task\Completed;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class Purge
{
    /**
     * @Route("/tasks/purge", name="tasks.purge")
     */
    public function __invoke(Completed $query, Environment $twig)
    {
        $taskList = $query->getTaskList();

        $content = $twig->render(
            'page/task/purge.html.twig',
            compact('taskList')
        );

        return new Response($content);
    }
}
