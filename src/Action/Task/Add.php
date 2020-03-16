<?php

namespace App\Action\Task;

use App\Entity\Task;
use App\Form\Type\TaskType;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class Add
{
    private $formFactory;
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(
        $formFactory,
        TaskRepository $repository,
        Security $security,
        Environment $twig,
        UrlGeneratorInterface $router
    )
    {
        $this->formFactory = $formFactory;
        $this->repository = $repository;
        $this->user = $security->getUser();
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     * @Route("/task/add", name="task.add")
     */
    public function __invoke(Request $request): Response
    {
        $task = new Task();

        $form = $this->formFactory->create(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            /** @var Task $task*/
            $task->setUser($this->user);
            $this->repository->saveAndFlush($task);

            return new RedirectResponse(
                $this->router->generate('task.view', [ 'uuid' => $task->getUuid()])
            );
        }

        $content = $this->twig->render(
            'organism/task/form.html.twig',
            [
                'task' => $task,
                'form' => $form->createView()
            ]
        );

        return new Response($content);
    }
}
