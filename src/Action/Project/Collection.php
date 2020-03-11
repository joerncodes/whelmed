<?php

namespace App\Action\Project;

use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Collection extends Base
{
    /**
     * @Route("/projects", name="project.collection")
     */
    public function __invoke(): Response
    {
        $content = $this->twig->render(
            'page/project/project-collection.html.twig',
            $this->getViewParameters()
        );

        return new Response($content);
    }
}
