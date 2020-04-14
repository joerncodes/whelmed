<?php

namespace App\Api\Perspective;

use App\Api\Response\Success;
use App\Domain\Query\Task\Flagged as FlaggedQuery;
use Symfony\Component\Routing\Annotation\Route;

class Flagged
{
    /**
     * @Route("/api/v1/perspective/flagged", methods={"GET"})
     */
    public function __invoke(FlaggedQuery $flaggedQuery)
    {
        return new Success(['results' => $flaggedQuery->getTaskList()]);
    }
}
