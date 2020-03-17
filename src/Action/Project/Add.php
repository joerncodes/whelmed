<?php

namespace App\Action\Project;

use App\Entity\Project;
use App\Form\Type\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class Add
{
    /**
     * @var FormFactory
     */
    private $formFactory;
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    private $user;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        $formFactory,
        ProjectRepository $repository,
        Security $security,
        Environment $twig,
        UrlGeneratorInterface $router
    ) {
        $this->formFactory = $formFactory;
        $this->repository = $repository;
        $this->user = $security->getUser();
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("/project/add", name="project.add")
     */
    public function __invoke(Request $request): Response
    {
        $project = new Project();

        $form = $this->formFactory->create(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            /** @var Project $project */
            $project->setUser($this->user);
            $this->repository->saveAndFlush($project);

            return new RedirectResponse(
                $this->router->generate('project.view', [ 'uuid' => $project->getUuid()])
            );
        }

        $content = $this->twig->render(
            'organism/project/form.html.twig',
            [
                'project' => $project,
                'form' => $form->createView()
            ]
        );

        return new Response($content);
    }
}
