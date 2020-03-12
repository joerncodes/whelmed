<?php

namespace App\Action\Perspective;

use App\Domain\Query\Task\Flagged as FlaggedQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class Flagged extends Base
{
    /**
     * @Route("/perspective/flagged", name="perspective.flagged")
     */
    public function __invoke(FlaggedQuery $query): Response
    {
        $title = 'Flagged';
        $description = 'Ths perspective shows all flagged tasks.';

        return $this->getPerspectiveContent($query, $title, $description);
    }
}
