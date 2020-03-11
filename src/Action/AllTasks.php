<?php

namespace App\Action;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllTasks
{
    /**
     * @Route("/")
     * @param TaskRepository $repository
     * @return Response
     */
    public function __invoke(TaskRepository $repository)
    {
        $response = '';
        $tasks = $repository->findAll();
        foreach($tasks as $task) {
            $response .= $task->getTitle();
            if($task->isCompleted()) {
                $response .= ' (completed)';
            }
            $response .= '<br>';
        }

        return new Response($response);
    }
}
