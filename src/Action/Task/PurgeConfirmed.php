<?php

namespace App\Action\Task;

use App\Domain\Query\Completed;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class PurgeConfirmed
{
    /**
     * @Route("/tasks/purge/confirmed", name="tasks.purge.confirmed")
     */
    public function __invoke(Completed $query, TaskRepository $repository, UrlGeneratorInterface $router)
    {
        $taskList = $query->getTaskList();

        foreach($taskList->getTasks() as $task) {
            $repository->remove($task);
        }
        $repository->flush();

        return new RedirectResponse(
            $router->generate('task.all')
        );
    }
}
