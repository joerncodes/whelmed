<?php

namespace App\Action\Project;

use App\Repository\ProjectRepository;
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

        $content = $this->twig->render('page/project/project-view.html.twig', compact('project'));

        return new Response($content);
    }
}
