<?php

namespace App\Api\Task;

use App\Api\Response\NotFound;
use App\Api\Response\Success;
use App\Domain\Query\Task\ByUuid;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Routing\Annotation\Route;

class View
{
    /**
     * @Route("/api/v1/task/{uuid}", methods={"GET"})
     */
    public function __invoke(ByUuid $byUuid, string $uuid)
    {
        try
        {
            return new Success(['results' => $byUuid->get(Uuid::fromString($uuid))]) ;
        } catch(NoResultException $e) {
            return new NotFound();
        }
    }
}
