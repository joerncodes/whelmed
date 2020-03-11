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

class View
{
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(TaskRepository $repository, Environment $twig)
    {
        $this->repository = $repository;
        $this->twig = $twig;
    }

    /**
     * @Route("/task/{uuid}", name="task.view")
     */
    public function __invoke(string $uuid)
    {
        try
        {
            $task = $this->repository->findOneByUuidOrFail(Uuid::fromString($uuid));
        }
        catch(InvalidUuidStringException | NoResultException $e) {
            throw new NotFoundHttpException();
        }

        $content = $this->twig->render('page/task/task-view.html.twig', compact('task'));

        return new Response($content);
    }
}
