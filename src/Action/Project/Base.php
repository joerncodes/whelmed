<?php

namespace App\Action\Project;

use App\Domain\Query\Project\All;
use App\Domain\Query\Project\ByUuid;
use App\Domain\Task\TaskList;
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
    protected $allQuery;
    /**
     * @var ByUuid
     */
    protected $byUuid;
    /**
     * @var TaskList
     */
    protected $taskList;

    public function __construct(All $allQuery, ByUuid $byUuid, Environment $twig, TaskList $taskList)
    {
        $this->twig = $twig;
        $this->allQuery = $allQuery;
        $this->byUuid = $byUuid;
        $this->taskList = $taskList;
    }

    protected function getViewParameters(): array
    {
        return [];
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
