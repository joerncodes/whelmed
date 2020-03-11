<?php

namespace App\Action\Perspective;

use App\Domain\Query\Inbox as InboxQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class Inbox
{
    /**
     * @Route("/perspective/inbox", name="perspective.inbox")
     */
    public function __invoke(InboxQuery $query, Environment $twig): Response
    {
        $taskList = $query->getTaskList();

        $title = 'Inbox';
        $description = 'The Inbox perspective shows all tasks that do not belong to a project';

        $content = $twig->render(
            'page/task/task-list.html.twig',
            compact('title', 'description', 'taskList')
        );

        return new Response($content);
    }
}
