<?php

namespace App\Api\Task;

use App\Api\Response\Success;
use App\Domain\Query\Task\All as AllQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class All
{
    /**
     * @Route("/api/v1/tasks/all", methods={"GET"})
     */
    public function __invoke(AllQuery $allQuery)
    {
        return new Success(['results' => $allQuery->getTaskList()]);
    }
}
