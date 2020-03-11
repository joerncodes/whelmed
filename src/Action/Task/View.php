<?php

namespace App\Action\Task;

use App\Repository\TaskRepository;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class View extends Base
{
    /**
     * @Route("/task/{uuid}", name="task.view")
     */
    public function __invoke(string $uuid)
    {
        $task = $this->getTaskOrFail($uuid);

        $content = $this->twig->render('page/task/task-view.html.twig', compact('task'));

        return new Response($content);
    }
}
