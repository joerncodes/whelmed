<?php

namespace App\Api\Task\Modify;

use App\Api\Response\NotFound;
use App\Api\Response\Success;
use App\Domain\Query\Task\ByUuid;
use App\Repository\TaskRepository;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Routing\Annotation\Route;

class Unflag
{
    /**
     * @Route("/api/v1/task/{uuid}/unflag", methods={"PUT"})
     */
    public function __invoke(ByUuid $byUuid, TaskRepository $repository, $uuid)
    {
        try
        {
            $task = $byUuid->get(Uuid::fromString($uuid))->setFlagged(false);
            $repository->saveAndFlush($task);

            return new Success(['message' => 'Task successfully unflagged.','results' => $task]);
        }
        catch(NoResultException $e) {
            return new NotFound();
        }
    }
}
