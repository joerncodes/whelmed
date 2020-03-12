<?php

namespace App\Action\Perspective;

use App\Domain\Query\Task\Inbox as InboxQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class Inbox extends Base
{
    /**
     * @Route("/perspective/inbox", name="perspective.inbox")
     */
    public function __invoke(InboxQuery $query): Response
    {
        $title = 'Inbox';
        $description = 'The Inbox perspective shows all tasks that do not belong to a project';

        return $this->getPerspectiveContent($query, $title, $description);
    }
}
