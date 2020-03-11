<?php

namespace App\Action\Project;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

abstract class Base
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var Environment
     */
    protected $twig;

    public function __construct(ProjectRepository $repository, Environment $twig)
    {
        $this->repository = $repository;
        $this->twig = $twig;
    }

    protected function getViewParameters(): array
    {
        $projectList = $this->repository->getProjectList();
        return compact('projectList');
    }

    protected function getProjectOrFail(string $uuid): \App\Entity\Base
    {
        try {
            return $this->repository->findOneByUuidOrFail(Uuid::fromString($uuid));
        } catch (InvalidUuidStringException | NoResultException $e) {
            throw new NotFoundHttpException();
        }
    }
}
