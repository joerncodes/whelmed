<?php

namespace App\Action\Project;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class View extends Base
{
    /**
     * @Route("/project/{uuid}", name="project.view")
     */
    public function __invoke(string $uuid): Response
    {
        $project = $this->getProjectOrFail($uuid);
        $project->setTaskList(
            $this->taskList->setTasks($project->getTasks()->toArray())
        );

        $content = $this->twig->render(
            'page/project/project-view.html.twig',
            $this->getViewParameters() + compact('project')
        );

        return new Response($content);
    }
}
