<?php

namespace App\Action\Perspective;

use App\Domain\Query\Task\Base as BaseQuery;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

abstract class Base
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    protected function getPerspectiveContent(BaseQuery $query, string $title, string $description): Response
    {
        $taskList = $query->getTaskList();

        $content = $this->twig->render(
            'page/task/task-list.html.twig',
            compact('title', 'description', 'taskList')
        );

        return new Response($content);
    }
}
