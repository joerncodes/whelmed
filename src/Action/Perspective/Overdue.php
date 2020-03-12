<?php

namespace App\Action\Perspective;

use App\Domain\Query\Task\Flagged as FlaggedQuery;
use App\Domain\Query\Task\Overdue as OverdueQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Overdue extends Base
{
    /**
     * @Route("/perspective/overdue", name="perspective.overdue")
     */
    public function __invoke(OverdueQuery $query): Response
    {
        $title = 'Overdue';
        $description = 'Show all tasks that have a due date in the past (and not yet completed).';

        return $this->getPerspectiveContent($query, $title, $description);
    }

}
