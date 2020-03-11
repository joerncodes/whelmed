<?php

namespace App\Action\Task;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

abstract class Base
{
    /**
     * @var TaskRepository
     */
    protected $repository;
    /**
     * @var Environment
     */
    protected $twig;

    public function __construct(TaskRepository $repository, Environment $twig)
    {
        $this->repository = $repository;
        $this->twig = $twig;
    }

    protected function getTaskOrFail(string $uuid): Task
    {
        try
        {
            return $this->repository->findOneByUuidOrFail(Uuid::fromString($uuid));
        }
        catch(InvalidUuidStringException | NoResultException $e) {
            throw new NotFoundHttpException();
        }
    }
}
