<?php

namespace App\Action\Task;

use App\Domain\Query\Task\All as AllQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class All extends Base
{
    /**
     * @Route("/", name="task.all")
     * @return Response
     */
    public function __invoke(AllQuery $query)
    {
        $taskList = $query->getTaskList();

        $title = 'All tasks';

        $content = $this->twig->render('page/task/task-list.html.twig', compact('taskList', 'title'));

        return new Response($content);
    }
}
