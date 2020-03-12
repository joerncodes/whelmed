<?php

namespace App\Action\Project;

use App\Domain\Query\Project\All;
use App\Domain\Query\Project\ByUuid;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

abstract class Base
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var All
     */
    private $allQuery;
    /**
     * @var ByUuid
     */
    private $byUuid;

    public function __construct(All $allQuery, ByUuid $byUuid, Environment $twig)
    {
        $this->twig = $twig;
        $this->allQuery = $allQuery;
        $this->byUuid = $byUuid;
    }

    protected function getViewParameters(): array
    {
        $projectList = $this->allQuery->getProjectList();
        return compact('projectList');
    }

    protected function getProjectOrFail(string $uuid): \App\Entity\Base
    {
        try {
            return $this->byUuid->get(Uuid::fromString($uuid));
        } catch (InvalidUuidStringException | NoResultException $e) {
            throw new NotFoundHttpException();
        }
    }
}
